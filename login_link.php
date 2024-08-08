<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username=htmlspecialchars($_POST['username']);
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $con_pass=password_hash($_POST['con_pass'],PASSWORD_DEFAULT);
   
    
if (!empty($username) && !empty($password) && !empty($con_pass)) 
{
    if ($password === $con_pass) 
    {
        echo "PASSWORD MATCHES, YOU ARE WELCOME HERE<br>";
        echo"username is $username<br>";
        $hashed_password=password_hash($password,PASSWORD_DEFAULT);
        echo "Hashed password is : $hashed_password<br>";
        // echo "password is $password<br>";
        echo "Confirmation password is $con_pass";
    }
    else #($con_pass != $password)
    {
        echo "PASSWORD DOESN'T MATCHES, PLEASE TRY AGAIN";
    }
}
else 
    {
    echo "Please enter all the fields";
    }
}
?>