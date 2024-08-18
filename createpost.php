<?php
session_start();
include 'connection.php';

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $author = $_SESSION['username'];

    // Check if user exists
    $checkUserStmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $checkUserStmt->bind_param("s", $author);
    $checkUserStmt->execute();
    $checkUserResult = $checkUserStmt->get_result();

    if ($checkUserResult->num_rows === 0) {
        // Handle missing user (e.g., display an error message)
        echo "User not found.";
        exit;
    }

    $userId = $checkUserResult->fetch_assoc()['id'];

    // Prepare the statement
    $stmt = $conn->prepare("INSERT INTO posts (title, content, user_id, created_at) VALUES (?, ?, ?, NOW())");

    // Check for errors in statement preparation
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sss", $title, $content, $userId);

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: home.php');
        exit();
    } else {
        // Handle error, e.g., log the error, display a user-friendly message
        echo "Error inserting post: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Post</title>
    <link rel="stylesheet" href="createpost.css">
</head>
<body>
    <div class="container">
        <h2>Create a Post</h2>
        <form method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="5" required></textarea>

            <input type="submit" value="Post">
        </form>
    </div>
</body>
</html>