<?php
    include("database.php");
    // Get posted data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Prepare and execute insert statement
    $stmt = $conn->prepare("INSERT INTO products (name, price, stock) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $name, $price, $stock);
    $stmt->execute();

    // Close connections
    $stmt->close();
    $conn->close();

    // Redirect back to edit page after addition
    header("Location: adminDashboard.php");
    exit;
?>