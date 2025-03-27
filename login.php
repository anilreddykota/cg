<?php
session_start();
require_once './controllers/badges.php';


// Signup("anilreddy8739@gmail.com","anilreddykota","admin","12345");


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $userData = Login($username, $password);

    if ($userData) {
        $_SESSION['user'] = $userData['id'];
        header('Location: create.php');
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(120deg, #3498db, #8e44ad);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 400px;
            padding: 40px;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeIn 0.8s forwards;
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-weight: 700;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 30px;
        }
        
        .input-group input {
            width: 100%;
            padding: 12px 15px;
            font-size: 16px;
            border: none;
            border-bottom: 2px solid #ddd;
            background: transparent;
            outline: none;
            transition: 0.3s;
        }
        
        .input-group label {
            position: absolute;
            top: 12px;
            left: 15px;
            color: #999;
            transition: 0.3s;
            pointer-events: none;
        }
        
        .input-group input:focus, 
        .input-group input:valid {
            border-bottom-color: #3498db;
        }
        
        .input-group input:focus + label,
        .input-group input:valid + label {
            top: -12px;
            font-size: 12px;
            color: #3498db;
        }
        
        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(120deg, #3498db, #8e44ad);
            border: none;
            border-radius: 50px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        
        .error {
            background: rgba(255, 0, 0, 0.1);
            color: #ff3333;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .floating-bg {
            position: absolute;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }
        
        @keyframes float {
            0% { transform: translate(0, 0) scale(1); opacity: 0; }
            10% { opacity: 0.8; }
            90% { opacity: 0.8; }
            100% { transform: translate(100px, -100px) scale(3); opacity: 0; }
        }
    </style>
</head>
<body>
    <?php for($i = 0; $i < 10; $i++): ?>
        <div class="floating-bg" style="
            left: <?= rand(0, 100) ?>%; 
            top: <?= rand(0, 100) ?>%;
            width: <?= rand(30, 80) ?>px;
            height: <?= rand(30, 80) ?>px;
            animation-duration: <?= rand(10, 25) ?>s;
            animation-delay: <?= rand(0, 5) ?>s;
        "></div>
    <?php endfor; ?>

    <div class="login-container">
        <h1>Welcome Back</h1>
        
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="post">
            <div class="input-group">
                <input type="text" name="username" id="username" required>
                <label for="username">Username</label>
            </div>
            
            <div class="input-group">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
            </div>
            
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        // Add floating background elements dynamically
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input');
            
            inputs.forEach(input => {
                // When an input field already has a value on page load
                if (input.value) {
                    input.nextElementSibling.classList.add('active');
                }
                
                // Handle animation when typing
                input.addEventListener('focus', () => {
                    input.nextElementSibling.classList.add('active');
                });
                
                input.addEventListener('blur', () => {
                    if (!input.value) {
                        input.nextElementSibling.classList.remove('active');
                    }
                });
            });
        });
    </script>
</body>
</html>
