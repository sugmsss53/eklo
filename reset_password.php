<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="reset_password.css">
</head>

<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form method="post">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">

            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirm New Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Reset Password</button>
        </form>
        <div class="back-to-login">
            <a href="login.php">Back to Login</a>
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'connection.php';

            $token = htmlspecialchars($_POST['token']);
            $new_password = htmlspecialchars($_POST['new_password']);
            $confirm_password = htmlspecialchars($_POST['confirm_password']);

            if ($new_password !== $confirm_password) {
                echo "<div class='error-container'><p class='error'>Passwords do not match.</p></div>";
            } else {
                $sql = "SELECT * FROM password_resets WHERE token='$token' AND expiry > NOW()";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $email = $row['email'];
                    $pass_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $sql = "UPDATE users SET password='$pass_hash' WHERE email='$email'";
                    if ($conn->query($sql) === TRUE) {
                        $sql = "DELETE FROM password_resets WHERE token='$token'";
                        $conn->query($sql);
                        echo "<div class='success-container'><p class='success'>Password has been reset successfully. You can now <a href='login.php'>login</a>.</p></div>";
                    } else {
                        echo "<div class='error-container'><p class='error'>Error resetting password.</p></div>";
                    }
                } else {
                    echo "<div class='error-container'><p class='error'>Invalid or expired token.</p></div>";
                }
            }
            $conn->close();
        }
        ?>
    </div>
</body>

</html>
