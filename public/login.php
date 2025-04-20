<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    form {
      background: white;
      padding: 2rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      border-radius: 8px;
      display: flex;
      flex-direction: column;
      gap: 1rem;
      width: 300px;
    }
    input {
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button {
      padding: 0.75rem;
      background: #00796b;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background: rgb(1, 72, 64);
    }
    .secondary-button {
      background: #ccc;
      color: #333;
    }
    .secondary-button:hover {
      background: #bbb;
    }
  </style>
</head>
<body>
  <form method="post" action="do_login.php">
    <h2>Login</h2>
    <input type="text" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Login</button>
    <a href="register.php">
      <button type="button" class="secondary-button">Register</button>
    </a>
  </form>
</body>
</html>
