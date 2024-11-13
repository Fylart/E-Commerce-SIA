<?php
require_once 'db.php'; // assuming you have a db.php file that connects to your database

$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$total_amount = $data['total_amount'];
$payment_method = $data['payment_method'];

// insert data into database
$sql = "INSERT INTO orders (user_id, total_amount, payment_method) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $user_id, $total_amount, $payment_method);
$stmt->execute();

// update order status
$sql = "UPDATE orders SET status = 'Paid' WHERE order_id = LAST_INSERT_ID()";
$stmt = $conn->prepare($sql);
$stmt->execute();

echo json_encode(['message' => 'Payment successful!']);
?>