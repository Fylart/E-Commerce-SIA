<?php
    include("../database.php");

    // Get the ID from the query string
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Prepare and execute delete statement
        $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Close connections
        $stmt->close();
    }

    // Redirect back to edit page after deletion
    header("Location: ../adminDashboard.php");
    exit;
?>