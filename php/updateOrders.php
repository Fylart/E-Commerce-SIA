<?php
include("../database.php");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get posted data from the form
$orderItemIds = $_POST['order_item_id']; // Unique IDs for each order item
$products = isset($_POST['product_hidden']) ? $_POST['product_hidden'] : []; // Get hidden product names
$prices = isset($_POST['price_hidden']) ? $_POST['price_hidden'] : []; // Get hidden prices
$quantities = $_POST['quantity']; // Quantities

// Prepare and execute update statements for each order item
for ($i = 0; $i < count($orderItemIds); $i++) {
    $stmt = $conn->prepare("UPDATE order_items SET product=?, price=?, quantity=? WHERE id=?");
    $stmt->bind_param("sdii", $products[$i], $prices[$i], $quantities[$i], $orderItemIds[$i]);
    $stmt->execute();
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Redirect back to the edit page or another page after saving
header("Location: ../aguilarTeam/UserProfile.php"); // Adjust this URL as needed
exit;
?>