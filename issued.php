<?php


require_once './controllers/badges.php';
$error = '';
$success = false;
$certificate_path = '';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// get from the query string
$query = $_GET['query'] ?? '';
$sort = $_GET['sort'] ?? 'ASC';
$limit = $_GET['limit'] ?? 10;



$certificates = getCertificates($query, $sort,$limit);

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
        .search-sort-limit {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-sort-limit .form-group {
            flex: 1;
            margin-right: 10px;
        }

        .search-sort-limit .form-group:last-child {
            margin-right: 0;
        }

        .search-sort-limit label {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .search-sort-limit input[type="text"],
        .search-sort-limit input[type="number"],
        .search-sort-limit select {
            padding: 8px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .search-sort-limit {
            flex-direction: column;
            }

            .search-sort-limit .form-group {
            margin-right: 0;
            margin-bottom: 10px;
            }

            .search-sort-limit .form-group:last-child {
            margin-bottom: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Issued Certificates</h1> 
        <nav style="margin-bottom: 20px; text-align: center;">
            <a href="index.php" style="margin-right: 10px; padding: 8px 15px; background-color: #337ab7; color: white; text-decoration: none; border-radius: 4px;">Home</a>
            <a href="create.php" style="margin-right: 10px; padding: 8px 15px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px;">Create Certificate</a>
            <a href="issued.php" style="padding: 8px 15px; background-color: #337ab7; color: white; text-decoration: none; border-radius: 4px;">View Issued Certificates</a>
            <a href="logout.php" style="margin-left: 10px; padding: 8px 15px; background-color: #d9534f; color: white; text-decoration: none; border-radius: 4px;">Logout</a>
        </nav>
        <form method="get" action="issued.php" class="search-sort-limit">
            <div class="form-group">
            <label for="query">Search:</label>
            <input type="text" id="query" name="query" value="<?php echo htmlspecialchars($query); ?>" placeholder="Search by name or ID">
            </div>
          
            <div class="form-group">
            <label for="limit">Results Per Page:</label>
            <input type="number" id="limit" name="limit" value="<?php echo htmlspecialchars($limit); ?>" min="1" max="100">
            </div>
            <button type="submit">Apply Filters</button>
        </form>

        <?php if (!empty($certificates)): ?>
            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Badge Name</th>
                <th>Badge Type</th>
                <th>Date Issued</th>
                <th>Unique ID</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($certificates as $certificate): ?>
                <tr>
                    <td><?php echo htmlspecialchars($certificate['id']); ?></td>
                    <td><?php echo htmlspecialchars($certificate['holder']); ?></td>
                    <td><?php echo htmlspecialchars($certificate['badge_name'])?></td>
                    <td><?php echo htmlspecialchars($certificate['badge_type']); ?></td>
                    <td><?php echo htmlspecialchars($certificate['issue_date']); ?></td>
                    <td><?php echo htmlspecialchars($certificate['unique_id']); ?></td>
                    <td>
                    <a href="verify?id=<?php echo urlencode($certificate['unique_id']); ?>" style="color: #337ab7;">View</a> |
                    <a href="download.php?id=<?php echo urlencode($certificate['unique_id']); ?>" style="color: #4CAF50;">Download</a>
                    <a href="delete.php?id=<?php echo urlencode($certificate['id']); ?>" style="color: #d9534f;">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; color: #d9534f;">No certificates found.</p>
        <?php endif; ?>
      
       

      
</body>


</html>