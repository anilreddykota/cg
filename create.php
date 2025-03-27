<?php
// Set headers to prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


require_once './controllers/badges.php';
$error = '';
$success = false;
$certificate_path = '';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $holder = isset($_POST['holder']) ? trim($_POST['holder']) : '';
    $badge_name = isset($_POST['badge_name']) ? trim($_POST['badge_name']) : '';
    $badge_type = isset($_POST['badge_type']) ? trim($_POST['badge_type']) : '';
    $issue_date = isset($_POST['issue_date']) ? trim($_POST['issue_date']) : date('Y-m-d');
    $unique_id = uniqid();

    // Validate inputs
    if (empty($holder) || empty($badge_name) || empty($badge_type)) {
        $error = 'Please fill in all required fields.';
    } else {
        // Generate the certificate
        $certificate = generateCertificate($holder, $badge_name, $badge_type, $issue_date, $unique_id);

        if ($certificate) {
            // Store success info in session
            session_start();
            $_SESSION['success'] = true;
            $_SESSION['certificate_path'] = $certificate;

            // Redirect to prevent form resubmission
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}

// Check for session data (from successful submission)
if (isset($_SESSION['success']) && $_SESSION['success'] === true) {
    $success = true;
    $certificate_path = $_SESSION['certificate_path'];

    // Clear session data after using it
    $_SESSION['success'] = false;
    $_SESSION['certificate_path'] = '';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        .success {
            color: green;
            margin-bottom: 15px;
        }

        .certificate-preview {
            margin-top: 20px;
            text-align: center;
        }

        .certificate-preview img {
            max-width: 100%;
            border: 1px solid #ddd;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .d-none {
            display: none;
        }

        .certificate-actions {
            margin-top: 20px;
            text-align: center;
        }

        .certificate-actions a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 15px;
            background-color: #337ab7;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .certificate-actions a:hover {
            background-color: #286090;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            input[type="text"],
            input[type="date"] {
                padding: 8px;
            }

            .certificate-actions a {
                display: block;
                margin: 10px 0;
            }
        }

        .d-flex {
            display: flex;
            flex-direction: row;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Certificate Generator</h1> 
        <nav style="margin-bottom: 20px; text-align: center;">
            <a href="index.php" style="margin-right: 10px; padding: 8px 15px; background-color: #337ab7; color: white; text-decoration: none; border-radius: 4px;">Home</a>
            <a href="create.php" style="margin-right: 10px; padding: 8px 15px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px;">Create Certificate</a>
            <a href="issued.php" style="padding: 8px 15px; background-color: #337ab7; color: white; text-decoration: none; border-radius: 4px;">View Issued Certificates</a>
            <a href="logout.php" style="margin-left: 10px; padding: 8px 15px; background-color: #d9534f; color: white; text-decoration: none; border-radius: 4px;">Logout</a>
        </nav>
        <div class="view-toggle">
            <a href="#" id="toggle-certificates">View Certificate Gallery ▼</a>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            const toggleLink = document.getElementById('toggle-certificates');
            const certificateSection = document.querySelector('.all-certificates');
            
            // Hide certificates section initially
            certificateSection.style.display = 'none';
            
            toggleLink.addEventListener('click', function(e) {
            e.preventDefault();
            if (certificateSection.style.display === 'none') {
            certificateSection.style.display = 'block';
            this.innerHTML = 'Hide Certificate Gallery ▲';
            } else {
            certificateSection.style.display = 'none';
            this.innerHTML = 'View Certificate Gallery ▼';
            }
            });
            });
        </script>
        <style>
            .view-toggle {
            text-align: center;
            margin-bottom: 20px;
            }
            .view-toggle a {
            display: inline-block;
            padding: 8px 15px;
            background-color: #337ab7;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            }
            .view-toggle a:hover {
            background-color: #286090;
            }
        </style>

        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success">Certificate generated successfully!</div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-group">
                <label for="holder">Certificate Holder Name*:</label>
                <input type="text" id="holder" name="holder" required>
            </div>
            <div class="d-flex">



                <div class="form-group">
                    <label for="badge_type">Badge Type*:</label>
                    <select id="badge_type" name="badge_type" required>
                        <option value="problem_solving">🏅 Problem-Solving Badges</option>
                        <option value="product_building">💡 Product-Building Badges</option>
                        <option value="consistency">🔥 Consistency Badges</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="badge_name">Badge Name*:</label>
                    <select id="badge_name" name="badge_name" required></select>
                </div>
            </div>

            <div class="form-group">
                <label for="issue_date">Issue Date:</label>
                <input type="date" id="issue_date" name="issue_date" value="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="form-group d-none">
                <label for="unique_id">Unique ID (optional):</label>
                <input type="text" id="unique_id" name="unique_id" placeholder="Leave blank for auto-generated ID">
            </div>

            <button type="submit">Generate Certificate</button>
        </form>

        <?php if ($success && file_exists($certificate_path)): ?>
            <div class="certificate-preview">
                <h2>Certificate Preview</h2>
                <img src="<?php echo $certificate_path; ?>" alt="Generated Certificate">

                <div class="certificate-actions">
                    <a href="?download=<?php echo basename($certificate_path, '.png'); ?>">Download Certificate</a>
                    <a href="<?php echo $certificate_path; ?>" target="_blank">View Full Size</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="all-certificates">
        <h2>All Generated Certificates</h2>
        <div class="certificates-grid">
            <?php
            $certificates_dir = './certificates/';
            if (is_dir($certificates_dir)) {
                $certificates = glob($certificates_dir . '*.png');
                if (count($certificates) > 0) {
                    foreach ($certificates as $cert) {
                        $filename = basename($cert);
                        $timestamp = filemtime($cert);
                        $date = date('Y-m-d H:i:s', $timestamp);
                        echo '<div class="certificate-item">';
                        echo '<img src="' . $cert . '" alt="Certificate">';
                        echo '<div class="certificate-info">';
                        echo '<p>' . $filename . '</p>';
                        echo '<p>Created: ' . $date . '</p>';
                        echo '<a href="?download=' . basename($cert, '.png') . '">Download</a>';
                        echo '<a href="' . $cert . '" target="_blank">View</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No certificates have been generated yet.</p>';
                }
            } else {
                echo '<p>Certificates directory not found.</p>';
            }
            ?>
        </div>
        <style>
            .all-certificates {
                margin-top: 40px;
                border-top: 1px solid #ddd;
                padding-top: 20px;
            }
            .certificates-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 20px;
                margin-top: 20px;
            }
            .certificate-item {
                border: 1px solid #ddd;
                border-radius: 5px;
                overflow: hidden;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .certificate-item img {
                width: 100%;
                height: auto;
            }
            .certificate-info {
                padding: 10px;
                background: #f9f9f9;
            }
            .certificate-info p {
                margin: 5px 0;
                font-size: 14px;
            }
            .certificate-info a {
                display: inline-block;
                margin-right: 10px;
                padding: 5px 10px;
                background: #337ab7;
                color: white;
                text-decoration: none;
                border-radius: 3px;
                font-size: 12px;
            }
            .certificate-info a:hover {
                background: #286090;
            }
        </style>
    </div>
</body>
<script>
    const badgeData = {
        problem_solving: [{
                value: "10 problems solved",
                text: "✅ 10 problems solved"
            },
            {
                value: "25 problems solved",
                text: "✅ 25 problems solved"
            },
            {
                value: "50 problems solved",
                text: "✅ 50 problems solved"
            },
            {
                value: "100 problems solved",
                text: "✅ 100 problems solved"
            },
            {
                value: "250 problems solved",
                text: "✅ 250 problems solved"
            },
            {
                value: "500 problems solved",
                text: "✅ 500 problems solved"
            },
        ],
        product_building: [{
                value: "1st product created",
                text: "🚀 1st product created"
            },
            {
                value: "10 products created",
                text: "🚀 10 products created"
            },
            {
                value: "100 products created",
                text: "🚀 100 products created"
            },
        ],
        consistency: [{
                value: "5-day streak",
                text: "📅 5-day streak"
            },
            {
                value: "10-day streak",
                text: "📅 10-day streak"
            },
            {
                value: "50-day streak",
                text: "📅 50-day streak"
            },
            {
                value: "100-day streak",
                text: "📅 100-day streak"
            },
            {
                value: "365-day streak",
                text: "📅 365-day streak"
            },
        ],
    };

    const badgeTypeSelect = document.getElementById("badge_type");
    const badgeNameSelect = document.getElementById("badge_name");

    function updateBadgeNames() {
        const selectedType = badgeTypeSelect.value;
        badgeNameSelect.innerHTML = ""; // Clear previous options

        badgeData[selectedType].forEach(badge => {
            const option = document.createElement("option");
            option.value = badge.value;
            option.textContent = badge.text;
            badgeNameSelect.appendChild(option);
        });
    }

    // Initialize the dropdown on page load
    badgeTypeSelect.addEventListener("change", updateBadgeNames);
    updateBadgeNames(); // Populate initially
</script>

</html>