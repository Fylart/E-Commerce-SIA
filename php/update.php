<?php
    include("../database.php");
    // Check connection


    // Get posted data
    $ids = $_POST['id'];
    $names = $_POST['name'];
    $prices = $_POST['price'];
    $stocks = $_POST['stock'];
    $desc = $_POST['description'];

    // Prepare and execute update statements for each product
    for ($i = 0; $i < count($ids); $i++) {
        $stmt = $conn->prepare("UPDATE products SET name=?, price=?, stock=?, description = ? WHERE id=?");
        $stmt->bind_param("sdisi", $names[$i], $prices[$i], $stocks[$i], $desc[$i], $ids[$i]);
        $stmt->execute();
    }

    // Close connections
    $stmt->close();
    $conn->close();

    // Redirect back to edit page or display a success message
    header("Location: ../adminDashboard.php");
    exit;
?>