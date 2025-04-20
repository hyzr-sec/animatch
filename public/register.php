<!-- aaaaaaaaaaa -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <main class="form-container">
    <h2>Create an Account</h2>
    <form method="post" action="do_register.php" enctype="multipart/form-data">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="text" name="phone" placeholder="Phone">
      <input type="text" name="address" placeholder="Address">
      <textarea name="description" placeholder="Tell us about yourself..."></textarea>
      <label for="social_status">Social Status</label>
      <select name="social_status">
        <option value="single">Single</option>
        <option value="married">Married</option>
        <option value="divorced">Divorced</option>
        <option value="other">Other</option>
      </select>
      <label>Upload Profile Picture</label>
      <input type="file" name="profile_pic" accept="image/*">
      <button type="submit">Register</button>
    </form>
  </main>
</body>
</html>
