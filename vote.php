<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $vote_type = $_POST['vote'];
    $user_id = $_SESSION['user_id']; // assuming user_id is stored in session

    // Check if the user has already voted on this post
    $sql = "SELECT * FROM votes WHERE user_id=? AND post_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User has already voted, update the vote
        $sql = "UPDATE votes SET vote_type=? WHERE user_id=? AND post_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $vote_type, $user_id, $post_id);
    } else {
        // Insert new vote
        $sql = "INSERT INTO votes (user_id, post_id, vote_type) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $user_id, $post_id, $vote_type);
    }

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