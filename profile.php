<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

// Fetch user details
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="container">
        <h2>Profile</h2>
        <div class="profile-info">
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        </div>
        
        <!-- Update Profile Form -->
        <h2>Update Profile</h2>
        <form id="update-profile-form">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>

            <input type="submit" value="Update Profile">
            <div id="update-message"></div>
        </form>
    </div>

    <script src="js/profile.js"></script>
</body>
</html>
<?php $conn->close(); ?>
