<?php
session_start(); // Start or resume the session

require 'database.php'; // Database connection

// Extract POST data
$name = $_POST['name'] ?? '';
$adultQuantity = $_POST['adult_quantity'] ?? 0;
$childrenQuantity = $_POST['children_quantity'] ?? 0;
$seniorQuantity = $_POST['senior_quantity'] ?? 0;
$disabledQuantity = $_POST['disabled_quantity'] ?? 0;
$foreignerQuantity = $_POST['foreigner_quantity'] ?? 0;
$totalPrice = $_POST['total_price'] ?? 0.0;

// Prepare SQL statement for the remaining categories
$sql = "INSERT INTO ticket_purchase (name, adult_quantity, children_quantity, senior_quantity, disabled_quantity, foreigner_quantity, total_price) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siiiiid", $name, $adultQuantity, $childrenQuantity, $seniorQuantity, $disabledQuantity, $foreignerQuantity, $totalPrice);

if ($stmt->execute()) {
    $_SESSION['ticket_purchase_id'] = $conn->insert_id; // Store the ID in the session
    echo json_encode(['success' => true, 'message' => 'Data inserted successfully', 'id' => $conn->insert_id]);
} else {
    echo json_encode(['success' => false, 'message' => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
