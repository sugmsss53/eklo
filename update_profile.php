<?php
session_start();
include 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$first_name = htmlspecialchars($_POST['first_name']);
$last_name = htmlspecialchars($_POST['last_name']);
$session_username = $_SESSION['username'];

// Prepare the statement
$stmt = $conn->prepare("UPDATE users SET username=?, email=?, first_name=?, last_name=? WHERE username=?");

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Statement preparation failed: ' . $conn->error]);
    exit();
}

// Bind parameters
$stmt->bind_param("sssss", $username, $email, $first_name, $last_name, $session_username);

// Execute the statement
if ($stmt->execute()) {
    // Update session username if changed
    if ($username !== $session_username) {
        $_SESSION['username'] = $username;
    }
    echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating profile: ' . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
