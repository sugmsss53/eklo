<?php
session_start();
include 'connection.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION['username'] = $username;

            // Set a cookie for the session
            setcookie("username", $username, time() + (86400 * 30), "/"); // 86400 = 1 day

            header('Location: Home.php');
            exit();
        } else {
            $error_message = "Wrong Password";
        }
    } else {
        $error_message = "Login Failed";
    }
    $conn->close();
}
?>

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

        <div class="signup">
            <a href="register.php">New to Eklo? Signup</a>
        </div>
        <div class="forgot-password">
            <a href="forget_password.php">Forgot Password?</a>
        </div>
    </div>

    <?php if ($error_message): ?>
    <div class="error-container">
        <p class="error"><?php echo $error_message; ?></p>
    </div>
    <?php endif; ?>

</body>

</html>
