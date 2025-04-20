<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
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
      background: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background: #45a049;
    }
  </style>
</head>
<body>
  <form method="post" action="do_login.php">
    <h2>Login</h2>
    <input type="text" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Login</button>
  </form>
</body>
</html>
