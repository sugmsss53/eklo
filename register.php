<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form method="post">
            <label for="username">username</label>
            <input type="text" id="username" name="username" required>

            <label for="email">email</label>
            <input type="email" id="email" name="email" required placeholder="email@example.com">

            <label for="Password">Password</label>
            <input type="Password" id="password" name="password" required>

            <label for="Password">Re Enter Password</label>
            <input type="Password" id="re_password" name="re_password" required>

            <label for="first_name">first name</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">last name</label>
            <input class="form-input" type="text" id="last_name" name="last_name" required>
            <input type="submit" value="Submit">

        </form>
        <?php
        include 'connection.php';
        echo $_SERVER["REQUEST_METHOD"];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = array();
            $f_name = htmlspecialchars($_REQUEST['first_name']);
            $l_name = htmlspecialchars($_REQUEST['last_name']);
            $email = htmlspecialchars($_REQUEST['email']);
            $username = htmlspecialchars($_REQUEST['username']);
            $password = htmlspecialchars($_REQUEST['password']);
            $re_password = htmlspecialchars($_REQUEST['re_password']);
            if ($password != $re_password) {
                array_push($errors, "Passwords Do not match");
            }
            if (count($errors) > 0) {
                echo "<ul>";
                foreach ($errors as $error) {
                    echo "<li class='error'> $error </li>";
                }
                echo "</ul>";
            } else {
                $pass_hash=password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (first_name, last_name, email, password, username)
                        VALUES ('$f_name', '$l_name', '$email', '$pass_hash', '$username')";

                if ($conn->query($sql) === TRUE) {
                    echo "Registration Successful";
                    header('Location: ' . 'login.php');
                    die();
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();
            }
        }
        ?>
    </div>
</body>

</html>