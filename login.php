<!DOCTYPE html>
<html>
<head>
<title>Eklo Login</title>
<link rel="stylesheet" href="login.css">
</head>
<body>

<div class="container">
  <h2>Eklo Login</h2>
  <form method="post" action="index.html">
    <label for="uname">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="pword">Password:</label>
    <input type="password" id="pword" name="password" required>

    <label for="pword">confirm Password:</label>
    <input type="password" id="con_pass" name="con_pass" required>

    <button type="submit">Login</button>
  </form>
  <div class="forgot">
    <a href="#">Forgot password?</a>
  </div>
  <div class="signup">
    <a href="register.php">New to Eklo? Signup</a>
  </div>
</div>

</body>
</html>