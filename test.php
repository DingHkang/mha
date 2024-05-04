<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>3D Login Page</title>
<style>
  body {
    font-family: 'Arial', sans-serif;
    background: #e8e8e8;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }
  .login-container {
    background: #ffffff;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1), 0 4px 20px rgba(0, 0, 0, 0.06);
    width: 350px;
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
  .login-btn {
    display: block;
    width: 100%;
    padding: 0.8rem;
    border: none;
    border-radius: 8px;
    background-image: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
    transition: transform 0.2s ease-in-out;
  }
  .login-btn:hover {
    transform: translateY(-3px);
  }
  .forgot-password {
    text-align: center;
    display: block;
    margin-top: 1rem;
    color: #333;
    text-decoration: none;
  }
</style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form>
      <div class="input-group">
        <input type="text" id="username" name="username" placeholder="Username" required>
      </div>
      <div class="input-group">
        <input type="password" id="password" name="password" placeholder="Password" required>
      </div>
      <button type="submit" class="login-btn">Login</button>
    </form>
    <a href="#" class="forgot-password">Forgot Password?</a>
  </div>
</body>
</html>
