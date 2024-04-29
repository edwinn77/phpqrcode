<?php
require_once 'database.php'; // Ensure this file correctly initializes $conn

$qrimage = $_POST['qrimage'] ?? '';
$time_out = date('Y-m-d H:i:s'); // Capture the current time as time out

// Use a prepared statement to update the time out
$stmt = $conn->prepare("UPDATE qrcode SET time_out = ? WHERE qrimage = ?");
$stmt->bind_param("ss", $time_out, $qrimage);
$success = $stmt->execute();

if ($success) {
    echo "Time out updated successfully";
} else {
    echo "Error updating time out: " . htmlspecialchars($conn->error);
}

$stmt->close();
$conn->close();
?>
