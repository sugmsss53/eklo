<?php
// Include your database connection code
include 'connection.php';

$data = json_decode(file_get_contents('php://input'), true);
$text = $data['text'];
$user_id = $data['user_id'];

if ($text && $user_id) {
    $stmt = $pdo->prepare("INSERT INTO blogs (user_id, text) VALUES (:user_id, :text)");
    $stmt->execute(['user_id' => $user_id, 'text' => $text]);
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No message provided']);
}
?>
