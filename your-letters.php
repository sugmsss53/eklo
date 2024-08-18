<?php
// your-letters.php
include('connection.php');
session_start();

$user_id = $_SESSION['user_id'];

// Fetch user's letters from the database
$query = "SELECT * FROM letters WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Letters</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="header">
                <h1 class="logo">Eklo</h1>
            </div>
            <nav class="nav">
                <ul>
                    <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="popular.php" class="nav-link">Popular Letters</a></li>
                    <li class="nav-item"><a href="about.php" class="nav-link">About Eklo</a></li>
                    <li class="nav-item"><a href="see-more.php" class="nav-link">See More</a></li>
                    <li class="nav-item"><a href="help.php" class="nav-link">Help</a></li>
                    <li class="nav-item"><a href="your-letters.php" class="nav-link">Your Letters</a></li>
                    <li class="nav-item"><a href="sad-letters.php" class="nav-link">Sad Letters</a></li>
                    <li class="nav-item"><a href="happy-letters.php" class="nav-link">Happy Letters</a></li>
                </ul>
            </nav>
        </div>
        <div class="content">
            <h2>Your Letters</h2>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="post">
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p><?php echo htmlspecialchars($row['content']); ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
