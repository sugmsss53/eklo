<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgot_password.css">
</head>

<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form method="POST">
            <label for="email">Enter your email:</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="Submit">
        </form>
        <?php
        include 'connection.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = htmlspecialchars($_POST['email']);
            $sql = "SELECT id FROM users WHERE email = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                echo "Password reset link has been sent to your email.";
                // Implement actual email sending in a production environment
            } else {
                echo "No account found with that email.";
            }
            $conn->close();
        }
        ?>
    </div>
</body>

</html>
