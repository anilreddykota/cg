<?php
// Define badges data
$badges = [
    'problem_solving' => [
        ['value' => '10 problems solved', 'text' => '✅ 10 problems solved'],
        ['value' => '25 problems solved', 'text' => '✅ 25 problems solved'],
        ['value' => '50 problems solved', 'text' => '✅ 50 problems solved'],
        ['value' => '100 problems solved', 'text' => '✅ 100 problems solved'],
        ['value' => '250 problems solved', 'text' => '✅ 250 problems solved'],
        ['value' => '500 problems solved', 'text' => '✅ 500 problems solved'],
    ],
    'product_building' => [
        ['value' => '1st product created', 'text' => '🚀 1st product created'],
        ['value' => '10 products created', 'text' => '🚀 10 products created'],
        ['value' => '100 products created', 'text' => '🚀 100 products created'],
    ],
    'consistency' => [
        ['value' => '5-day streak', 'text' => '📅 5-day streak'],
        ['value' => '10-day streak', 'text' => '📅 10-day streak'],
        ['value' => '50-day streak', 'text' => '📅 50-day streak'],
        ['value' => '100-day streak', 'text' => '📅 100-day streak'],
        ['value' => '365-day streak', 'text' => '📅 365-day streak'],
    ],
];

// Page header
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Badges</title>
    <style>
        main {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        h2 {
            color: #555;
            margin-top: 30px;
            text-transform: capitalize;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .badge-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
        }
        .badge {
            background-color: #f5f5f5;
            border-radius: 8px;
            padding: 12px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            font-size: 16px;
        }
        @media (max-width: 768px) {
            .badge-container {
                gap: 10px;
            }
            .badge {
                padding: 10px 15px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }
            h1 {
                font-size: 24px;
            }
            h2 {
                font-size: 20px;
            }
            .badge-container {
                gap: 8px;
            }
            .badge {
                padding: 8px 12px;
                font-size: 13px;
                flex: 1 1 calc(50% - 8px);
            }
        }

        /* Header styles */
        .site-header {
            background-color: #f8f9fa;
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .site-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo span {
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }

        nav {
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #007bff;
        }

        /* Footer styles */
        footer {
            margin-top: 50px;
            padding: 20px;
            background-color: #f8f9fa;
            text-align: center;
            border-top: 1px solid #eee;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        footer p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .site-header .container {
                flex-direction: column;
                gap: 10px;
            }
            
            nav {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
<header class="site-header">
        <div class="container">
            <div class="logo">
                <img src="./assets/logo.png" alt="Issuer Logo" height="40">
                <span>LinkedIn Series Certification</span>
            </div>
            <nav>
                <a href="./index.php">Home</a>
                <a href="./badges.php">Badges</a>
                <a href="#footer">Contact</a>
            </nav>
        </div>
    </header>
    <main>
    <h1>Available Badges</h1>

    <div style="margin-top: 40px; text-align: center;">
        <a href="./apply.php" style="display: inline-block; background-color: #4CAF50; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
            Apply for Badges
        </a>
    </div>
    
    <?php foreach ($badges as $category => $badgeList): ?>
        <h2><?= str_replace('_', ' ', $category) ?></h2>
        <div class="badge-container">
            <?php foreach ($badgeList as $badge): ?>
                <div class="badge"><?= $badge['text'] ?></div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
    </main>
    <footer>
    <div class="footer-logo" id="footer">
                    <img src="./assets/logo.png" alt="Issuer Logo" height="30">
                    <p>LinkedIn Series Certification</p>
                </div>
        <p>© <?php echo date('Y'); ?> Certificate Verification System. All rights reserved.</p>
        <p>For support, contact: anilreddy8739@gmail.com</p>
    </footer>
</body>
</html>