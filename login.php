<!DOCTYPE html>
<html>

<head>
  <title>Eklo Login</title>
  <link rel="stylesheet" href="login.css">
</head>

<body>

  <div class="container">
    <h2>Eklo Login</h2>
    <form method="POST">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Login</button>
    </form>
    <?php
    include ('connection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = htmlspecialchars($_REQUEST['username']);
      $password = htmlspecialchars($_REQUEST['password']);

      $sql = "SELECT id, username, password FROM users WHERE username = '$username'";

      $result = $conn->query($sql);

      if ($result->num_rows == 1) {
        $row = $result-> fetch_assoc();
        if(password_verify($password, $row["password"])){
          header('Location: ' . 'index.html');
        } else{
          echo "<p class='error'>Wrong Password</p>";
        }
      } else {
        echo "Login Failed";
      }
      $conn->close();
    }

    ?>

    <div class="signup">
      <a href="register.php">New to Eklo? Signup</a>
    </div>
  </div>

</body>

</html>