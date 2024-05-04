 <?php include('nav.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index</title>
   <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .wrap{
            margin: 0 auto;
            width: 80%;
        }
        .login-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1), 0 4px 20px rgba(0, 0, 0, 0.06);
            width: 400px;
        }
        .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            height: 50vh;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .input-group {
            position: relative;
            margin-bottom: 1rem;
        }
        .input-group input {
            padding: 0.8rem;
            width: 100%;
            border: 2px solid #cccccc;
            border-radius: 8px;
            background: #f7f7f7;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.1);
            transition: border-color 0.3s;
        }
        .input-group input:focus {
            outline: none;
            border-color: #777;
        }
        .login-btn, .register-btn {
            display: block;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease-in-out;
        }
        .login-btn {
            background-image: linear-gradient(45deg, #667eea, #764ba2);
        }
        .login-btn:hover {
            transform: translateY(-3px);
        }
        .register-btn {
            background-color: #28a745;
            margin-top: 1rem;
        }
        .register-btn:hover {
            background-color: #1e6f32;
            transform: translateY(-3px);
        }
        .forgot-password {
            text-align: center;
            display: block;
            margin-top: 1rem;
            color: #333;
            text-decoration: none;
        }
        .social-buttons {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }
        .social-button {
            background: #fff;
            border: none;
            cursor: pointer;
            margin: 0 10px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s;
        }
        .social-button i {
            color: #555;
            font-size: 20px;
        }
        .social-button.facebook { background-color: #3b5998; }
        .social-button.facebook i { color: #fff; }
        .social-button.twitter { background-color: #55acee; }
        .social-button.twitter i { color: #fff; }
        .social-button.google { background-color: #dd4b39; }
        .social-button.google i { color: #fff; }
        .social-button:hover {
            transform: translateY(-2px);
        }
        @media (max-width: 768px) {
            .login-container {
                width: 100%;
            }
            .content {
                height: auto;
            }
            .wrap{
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
   
 <div class="wrap">
        <div class="content">
            <div class="login-container">
                <h2>Login</h2>
                <form method="POST" action="login_process.php">
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="login-btn">Login</button>
                    <button type="button" class="register-btn" onclick="window.location='register.php';">Register</button>
                </form>
                <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
                <div class="social-buttons">
                    <button class="social-button facebook" onclick="window.location='facebook_login_process.php';"><i class="fab fa-facebook-f"></i> F</button>
                    <button class="social-button twitter" onclick="window.location='twitter_login_process.php';"><i class="fab fa-twitter"></i> T</button>
                    <button class="social-button google" onclick="window.location='google_login_process.php';"><i class="fab fa-google"></i> G</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
