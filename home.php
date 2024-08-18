<?php
session_start();
include 'connection.php';

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch posts from the database
$sql = "SELECT id, title, content, user_id, created_at FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === FALSE) {
    die("Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eklo - Home</title>
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
            <div class="header">
                <div class="search-bar-container">
                    <input type="text" class="search-input" placeholder="Search Eklo">
                </div>
                <div>
                    <a class="link-btn" href="createpost.php">Create a Post</a>
                    <a class="link-btn" href="profile.php">Profile</a>
                    <a class="link-btn" id="logout-link" href="logout.php">Logout</a>
                </div>
            </div>
            <h2>Welcome to Eklo!</h2>
            <p>Find and share letters on various topics. Explore our latest posts and join the conversation.</p>
            <div class="posts">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $post_id = $row['id'];
                        echo "<div class='post'>
                            <h3>" . htmlspecialchars($row['title']) . "</h3>
                            <p>" . nl2br(htmlspecialchars($row['content'])) . "</p>
                            <p><strong>Posted on:</strong> " . htmlspecialchars($row['created_at']) . "</p>
                            <!-- Voting Form -->
                            <form method='post' class='vote-form' action='vote.php'>
                                <input type='hidden' name='post_id' value='$post_id'>
                                <button type='submit' name='vote' value='up'>Upvote</button>
                                <button type='submit' name='vote' value='down'>Downvote</button>
                            </form>
                            <!-- Comment Form -->
                            <form method='post' class='comment-form' action='comment.php'>
                                <input type='hidden' name='post_id' value='$post_id'>
                                <textarea name='comment_text' placeholder='Add a comment...' required></textarea>
                                <button type='submit'>Submit Comment</button>
                            </form>
                            <!-- Display Comments -->
                            <div class='comments'>
                                " . displayComments($conn, $post_id) . "
                            </div>
                        </div>";
                    }
                } else {
                    echo "<p>No posts available.</p>";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
    <script src="js/script1.js"></script>
</body>
</html>

<?php
function displayComments($conn, $post_id) {
    $sql = "SELECT comment_text, user_id, created_at FROM comments WHERE post_id='$post_id' ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $output = '';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= "<div class='comment'>
                <p><strong>" . htmlspecialchars($row['user_id']) . ":</strong> " . htmlspecialchars($row['comment_text']) . "</p>
                <p><small>Posted on " . htmlspecialchars($row['created_at']) . "</small></p>
            </div>";
        }
    } else {
        $output .= "<p>No comments yet.</p>";
    }

    return $output;
}
?>
