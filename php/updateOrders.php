<?php
  include("../database.php");




// Get posted data from the form
$orderIds = $_POST['order_id']; // Order IDs for each item
$products = $_POST['product'];    // Product names
$prices = $_POST['price'];        // Prices
$quantities = $_POST['quantity']; // Quantities

// Prepare and execute update statements for each order item
$updates = []; // Array to hold updates

// Group updates by order ID
for ($i = 0; $i < count($orderIds); $i++) {
    $orderId = $orderIds[$i];
    if (!isset($updates[$orderId])) {
        $updates[$orderId] = [
            'products' => [],
            'prices' => [],
            'quantities' => []
        ];
    }
    
    // Store product details in the corresponding order ID group
    $updates[$orderId]['products'][] = $products[$i];
    $updates[$orderId]['prices'][] = $prices[$i];
    $updates[$orderId]['quantities'][] = $quantities[$i];
}

// Now update the database for each order ID group
foreach ($updates as $orderId => $details) {
    for ($j = 0; $j < count($details['products']); $j++) {
        // Prepare and execute update statement for each product in this order ID
        $stmt = $conn->prepare("UPDATE order_items SET product=?, price=?, quantity=? WHERE orders_id=?");
        $stmt->bind_param("sdii", $details['products'][$j], $details['prices'][$j], $details['quantities'][$j], $orderId);
        $stmt->execute();
    }
}

































  
/*   // Get posted data from the form
  $orderIds = $_POST['order_id']; // Order IDs for each item
  $products = $_POST['product'];    // Product names
  $prices = $_POST['price'];        // Prices
  $quantities = $_POST['quantity']; // Quantities
  
  // Prepare and execute update statements for each order item
  for ($i = 0; $i < count($orderIds); $i++) {
      $stmt = $conn->prepare("UPDATE order_items SET product=?, price=?, quantity=? WHERE orders_id=?");
      $stmt->bind_param("sdii", $products[$i], $prices[$i], $quantities[$i], $orderIds[$i]);
      $stmt->execute();
  } */
  
  
  // Redirect back to the edit page or another page after saving
  header("Location: ../aguilarTeam/UserProfile.php"); // Adjust this URL as needed
  exit;
?>