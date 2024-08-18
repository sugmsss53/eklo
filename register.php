<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="register.css">
    <script>
        function showLoader() {
            document.getElementById('submit-btn').disabled = true;
            document.getElementById('loader').style.display = 'inline-block';
        }
    </script>
</head>

<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form method="post" onsubmit="showLoader()">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="email@example.com">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="re_password">Re-enter Password</label>
            <input type="password" id="re_password" name="re_password" required>

            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>

            <button type="submit" id="submit-btn">Submit
                <span id="loader" class="loader" style="display:none;"></span>
            </button>
        </form>
        <?php
        include 'connection.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = array();
            $f_name = htmlspecialchars($_REQUEST['first_name']);
            $l_name = htmlspecialchars($_REQUEST['last_name']);
            $email = htmlspecialchars($_REQUEST['email']);
            $username = htmlspecialchars($_REQUEST['username']);
            $password = htmlspecialchars($_REQUEST['password']);
            $re_password = htmlspecialchars($_REQUEST['re_password']);
            if ($password != $re_password) {
                array_push($errors, "Passwords do not match");
            }
            if (count($errors) > 0) {
                echo "<div class='error-container'>";
                foreach ($errors as $error) {
                    echo "<p class='error'> $error </p>";
                }
                echo "</div>";
            } else {
                $pass_hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (first_name, last_name, email, password, username)
                        VALUES ('$f_name', '$l_name', '$email', '$pass_hash', '$username')";

                if ($conn->query($sql) === TRUE) {
                    echo "<p class='success'>Registration Successful</p>";
                    header('Location: ' . 'login.php');
                    die();
                } else {
                    echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
                }
                $conn->close();
            }
        }
        ?>
    </div>
</body>

</html>
