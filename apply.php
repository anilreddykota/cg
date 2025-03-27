<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .site-header {
            background-color: #0073b1;
            color: white;
            padding: 10px 20px;
        }
        .site-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .site-header .logo {
            display: flex;
            align-items: center;
        }
        .site-header .logo img {
            margin-right: 10px;
        }
        .site-header nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        .site-header nav a:hover {
            text-decoration: underline;
        }
        .footer-logo {
            text-align: center;
            margin: 20px 0;
        }
        footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px 20px;
            font-size: 14px;
        }
        footer p {
            margin: 5px 0;
        }
        iframe {
            width: 100%;
            max-width: 640px;
            height: auto;
            aspect-ratio: 640 / 986;
            border: none;
            display: block;
            margin: 0 auto;
        }
        h1{
            text-align: center;
            margin-top: 20px;
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
                <a href="../index.php">Home</a>
                <a href="./badges.php">Badges</a>
                <a href="#footer">Contact</a>
            </nav>
        </div>
    </header>
    <h1>Application Form</h1>
    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSeFNkFVUPF4QHSAGa3vbyRixgpQoTY7UzLxDW9Oz8kIk6Mgqg/viewform?embedded=true" width="640" height="986" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
        <div class="footer-logo" id="footer">
                    <img src="./assets/logo.png" alt="Issuer Logo" height="30">
                    <p>LinkedIn Series Certification</p>
                </div>
        <footer>
            <p>© <?php echo date('Y'); ?> Certificate Verification System. All rights reserved.</p>
            <p>For support, contact: anilreddy8739@gmail.com</p>
        </footer>
    </body>
</html>