<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $comment_text = htmlspecialchars($_POST['comment_text']);
    $user_id = $_SESSION['user_id']; // assuming user_id is stored in session

    $sql = "INSERT INTO comments (post_id, user_id, comment_text, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $post_id, $user_id, $comment_text);

    if ($stmt->execute()) {
        header('Location: home.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>