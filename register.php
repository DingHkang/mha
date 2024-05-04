<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body {
            font-family: 'Arial', sans-serif;
            background: #e8e8e8;
            margin: 0;
            padding: 0;
        }

        .wrap{
            margin: 0 auto;
            width: 80%;
        }
        .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            height: 50vh;
        }
        .register-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .input-group {
            width: 100%;
            margin-bottom: 1rem;
        }
        .input-group input {
            padding: 0.8rem;
            width: 100%;
            border: 2px solid #cccccc;
            border-radius: 8px;
            background: #f7f7f7;
            transition: border-color 0.3s;
        }
        .input-group input:focus {
            border-color: #777;
            outline: none;
        }
        .btnReg {
            display: block;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-image: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }
        .btnReg:hover {
            transform: translateY(-3px);
        }
        @media (max-width: 768px) {
            .register-container {
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
     <?php include('nav.php'); ?>
<div class="wrap">
     <div class="content">
            <div class="register-container">
                <h2>Register</h2>
                <form method="POST" action="register_process.php">
                    <div class="input-group">
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <button class="btnReg" type="submit">Register</button>
                </form>
            </div>
    </div>
</div>
</body>
</html>
