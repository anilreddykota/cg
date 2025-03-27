<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Verification System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .hero {
            background: linear-gradient(135deg, #1e5799, #207cca);
            color: white;
            text-align: center;
            padding: 60px 20px;
            animation: fadeIn 1s ease-in-out;
        }
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            animation: slideInDown 1s ease-out;
        }
        .hero p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto 30px;
            animation: slideInUp 1.2s ease-out;
        }
        .cta-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s;
            animation: pulse 2s infinite;
        }
        .cta-button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
        }
        .feature {
            flex: 1;
            min-width: 250px;
            max-width: 350px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            animation: fadeIn 1s ease-in-out;
        }
        .feature:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .feature h3 {
            color: #207cca;
        }
        .how-it-works {
            background-color: #eef7ff;
            padding: 60px 20px;
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }
        .steps {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
        }
        .step {
            flex: 1;
            min-width: 200px;
            max-width: 300px;
            animation: fadeInUp 1s ease-out;
        }
        .step-number {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #207cca;
            color: white;
            border-radius: 50%;
            line-height: 40px;
            font-weight: bold;
            margin-bottom: 15px;
            transition: transform 0.3s;
        }
        .step:hover .step-number {
            transform: scale(1.2) rotate(360deg);
            transition: transform 0.8s;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            animation: fadeIn 2s ease-in-out;
        }
        
        /* Animation Keyframes */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideInDown {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        @keyframes slideInUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
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
        #badgeid {
            padding: 12px 20px;
            border: 2px solid #d8d8d8;
            border-radius: 4px;
            font-size: 1.1rem;
            margin-right: 10px;
            width: 220px;
            transition: border-color 0.3s, box-shadow 0.3s;
            outline: none;
        }

        #badgeid:focus {
            border-color: #207cca;
            box-shadow: 0 0 8px rgba(32, 124, 202, 0.5);
        }

        #badgeid::placeholder {
            color: #aaa;
        }

        @media (max-width: 600px) {
            #badgeid {
                width: 90%;
                margin-bottom: 15px;
            }
            
            .cta-button {
                display: block;
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
                <a href="../index.php">Home</a>
                <a href="./badges.php">Badges</a>
                <a href="#footer">Contact</a>
            </nav>
        </div>
    </header>
    <section class="hero">
        <h1>LinkedIn Series Certification</h1>
        <p>Instantly verify the authenticity of your certificates and badges with our secure verification system for .LinkedIn Series Certification</p>
        <input  placeholder="Enter BadgeID" id="badgeid"/>
        <a href="index.php" id="verifylink" class="cta-button">Verify Certificate Now</a>
    </section>

    <div class="container">
        <section class="features">
            <div class="feature" style="animation-delay: 0.2s;">
                <h3>Quick Verification</h3>
                <p>Verify your certificates in seconds using our easy-to-use online verification tool.</p>
            </div>
            <div class="feature" style="animation-delay: 0.4s;">
                <h3>100% Secure</h3>
                <p>Our verification system ensures the authenticity of all certificates and badges issued.</p>
            </div>
            <div class="feature" style="animation-delay: 0.6s;">
                <h3>Employer Trusted</h3>
                <p>Employers worldwide trust our verification system for credential validation.</p>
            </div>
        </section>
    </div>

    <section class="how-it-works">
        <div class="container">
            <h2>How It Works</h2>
            <div class="steps">
                <div class="step" style="animation-delay: 0.3s;">
                    <div class="step-number">1</div>
                    <h3>Enter Certificate ID</h3>
                    <p>Input your unique certificate or badge ID in our verification tool.</p>
                </div>
                <div class="step" style="animation-delay: 0.6s;">
                    <div class="step-number">2</div>
                    <h3>Instant Verification</h3>
                    <p>Our system quickly checks the validity of your credentials.</p>
                </div>
                <div class="step" style="animation-delay: 0.9s;">
                    <div class="step-number">3</div>
                    <h3>View Results</h3>
                    <p>Get detailed information about your certificate and its status.</p>
                </div>
            </div>
            <div style="margin-top: 40px;">
                <a href="index.php" class="cta-button">Verify Your Certificate</a>
            </div>
        </div>
    </section>

    <footer>
    <div class="footer-logo" id="footer">
                    <img src="./assets/logo.png" alt="Issuer Logo" height="30">
                    <p>LinkedIn Series Certification</p>
                </div>
        <p>© <?php echo date('Y'); ?> Certificate Verification System. All rights reserved.</p>
        <p>For support, contact: anilreddy8739@gmail.com</p>
    </footer>
</body>
<script>
    document.getElementById('badgeid').addEventListener('input', function() {
        const badgeId = this.value.trim();
        const verifyLink = document.getElementById('verifylink');
        
        if (badgeId) {
            verifyLink.href = 'verify?id=' + encodeURIComponent(badgeId);
        } else {
            verifyLink.href = 'index.php';
        }
    });
</script>
</html>
