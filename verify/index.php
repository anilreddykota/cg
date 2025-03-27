<?php
$filepath = '../controllers/badges.php';
if (!file_exists($filepath)) {
    die("File not found: " . $filepath);
}
require_once $filepath;

$id = isset($_GET['id']) ? $_GET['id'] : null;



$certificateDetails = getCertificateDeatils($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badge Verification</title>
  
</head>
<body>
    <header class="site-header">
        <div class="container">
            <div class="logo">
                <img src="../assets/logo.png" alt="Issuer Logo" height="40">
                <span>LinkedIn Series Certification</span>
            </div>
            <nav>
                <a href="../index.php">Home</a>
                <a href="../badges.php">Badges</a>
                <a href="../contact.php">Contact</a>
            </nav>
        </div>
    </header>

    <div class="container">        
        <?php if ($certificateDetails): ?>
            <div class="badge-container">
                <div class="issuer-brand">
                    <img src="../assets/logo.png" alt="Issuer Logo" class="issuer-logo">
                    <p class="issuer-name">LinkedIn Series Certification</p>
                </div>
                
                <h2>Certificate of Achievement</h2>
                <div class="badge-image">
                    <img src="../certificates/<?php echo str_replace(" ", "", $certificateDetails['badge_name']) ?>.png" alt="Badge Image">
                </div>

                <div class="certificate-content">
                    <p>This is to certify that</p>
                    <h3><?php echo htmlspecialchars($certificateDetails['holder']); ?></h3>
                    <p>has been awarded the badge</p>
                    <p class="badge-name"><?php echo htmlspecialchars($certificateDetails['badge_name']); ?></p>
                    <p>for demonstrating excellence in</p>
                    <h4 class="badge-type"><?php echo htmlspecialchars($certificateDetails['badge_type']); ?></h4>

                    <div class="badge-footer">
                   
                    <p>Issued on: <strong><?php echo htmlspecialchars(date('Y-m-d', strtotime($certificateDetails['issue_date']))); ?></strong></p>
                    <p>Badge ID: <strong><?php echo htmlspecialchars($certificateDetails['unique_id']); ?></strong></p>

                         
                    </div>
                </div>
                
                <div class="share-options">
                    <h4>Share your achievement:</h4>
                    <div class="share-buttons">
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn linkedin">
                            <img src="../assets/linkedin.png" alt="LinkedIn"> LinkedIn
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('I earned the ' . $certificateDetails['badge_name'] . ' badge from CodeGlad!'); ?>" target="_blank" class="share-btn twitter">
                            <img src="../assets/twitter.png" alt="Twitter"> Twitter
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn facebook">
                            <img src="../assets/facebook.png" alt="Facebook"> Facebook
                        </a>
                        <button onclick="copyToClipboard()" class="share-btn copy">
                            <img src="../assets/copy.png" alt="Copy Link"> Copy Link
                        </button>
                    </div>
                </div>
                
                <div class="download-section">
                    <a href="../download.php?id=<?php echo htmlspecialchars($id); ?>" class="download-btn">Download Certificate</a>
                </div>
            </div>
        <?php else: ?>
            <div class="error">
                <p>Invalid badge ID or no ID provided.</p>
                <p>Please check the URL and try again.</p>
            </div>
        <?php endif; ?>
    </div>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="../assets/logo.png" alt="Issuer Logo" height="30">
                    <p>LinkedIn Series Certification</p>
                </div>
                <div class="footer-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="https://linkedin.com/in/anilreddykota">Contact Us</a>
                </div>
               
            </div>
            <p class="copyright">© <?php echo date('Y'); ?> LinkedIn Series Certification. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function copyToClipboard() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                alert("Link copied to clipboard!");
            });
        }
    </script>

    <style>
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Styles */
        .site-header {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .site-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .logo img {
            margin-right: 10px;
        }
        
        nav a {
            margin-left: 20px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }
        
        nav a:hover {
            color: #007BFF;
        }
        .badge-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        
        h1 {
            text-align: center;
            margin: 30px 0;
            color: #333;
        }
        
        /* Badge Container Styles */
        .badge-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 30px;
            max-width: 800px;
            margin: 0 auto 50px;
            text-align: center;
        }
        
        .issuer-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .issuer-logo {
            height: 40px;
            margin-right: 10px;
        }
        
        .issuer-name {
            font-weight: bold;
            color: #555;
        }
        
        .badge-image img {
            max-width: 180px;
            height: auto;
            margin: 20px 0;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            padding: 5px;
            background: #f9f9f9;
        }
        
        .certificate-content {
            margin: 20px 0;
        }
        
        .badge-name {
            color: #28a745;
            margin: 10px 0;
        }
        
        .badge-type {
            color: #6c757d;
        }
        
        /* Share Options Styles */
        .share-options {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .share-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }
        
        .share-btn {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            border-radius: 30px;
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .share-btn img {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }
        
        .linkedin { background-color: #0077B5; }
        .twitter { background-color: #1DA1F2; }
        .facebook { background-color: #3b5998; }
        .copy {
            background-color: #6c757d;
            border: none;
            cursor: pointer;
        }
        
        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .download-section {
            margin-top: 30px;
        }
        
        .download-btn {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .download-btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        
        /* Error Styles */
        .error {
            background-color: #ffe6e6;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: 30px auto;
            text-align: center;
            color: #d9534f;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        /* Footer Styles */
        .site-footer {
            background-color: #333;
            color: #fff;
            padding: 40px 0 20px;
            margin-top: 50px;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }
        
        .footer-logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .footer-logo img {
            margin-right: 10px;
        }
        
        .footer-links {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .footer-links a {
            color: #ddd;
            text-decoration: none;
        }
        
        .footer-links a:hover {
            color: #fff;
            text-decoration: underline;
        }
        
        .footer-social {
            display: flex;
            gap: 15px;
        }
        
        .footer-social img {
            width: 24px;
            height: 24px;
            filter: brightness(0) invert(1);
            transition: transform 0.3s ease;
        }
        
        .footer-social img:hover {
            transform: scale(1.2);
        }
        
        .copyright {
            text-align: center;
            margin-top: 20px;
            color: #aaa;
            font-size: 0.9rem;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .site-header .container {
                flex-direction: column;
                gap: 15px;
            }
            
            nav {
                width: 100%;
                display: flex;
                justify-content: center;
                gap: 15px;
            }
            
            nav a {
                margin-left: 0;
            }
            
            .footer-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .share-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .share-btn {
                width: 200px;
            }
        }
        
        @media (max-width: 480px) {
            .badge-container {
                padding: 15px;
            }
            
            h1 {
                font-size: 1.5rem;
            }
            
            h2 {
                font-size: 1.3rem;
            }
            
            .badge-image img {
                max-width: 150px;
            }
        }
    </style>
</body>
</html>