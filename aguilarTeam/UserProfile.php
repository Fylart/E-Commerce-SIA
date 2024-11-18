<?php
session_start(); // Start session at the top
require 'db_connect.php'; // Include the database connection file

// Check if the user is logged in
if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];

    // Fetch user data based on the logged-in user ID
    $stmt = $conn->prepare("SELECT firstname, lastname, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($firstname, $lastname, $email);
    $stmt->fetch();
    $stmt->close();
} else {
    // If no session is set, redirect to login page
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo">
                <img src="images/logo.png" alt="Logo">
            </div>
            <div class="nav">
                <li>
                    <img src="images/profile-icon.png" alt="Profile Icon">
                    <ul class="dropdown">
                        <li><a href="logout.php">LOG OUT</a></li>
                    </ul>
                </li>
                <a href="../allProducts.php" class="store-button">Go to store</a>
            </div>
        </header>

        <main class="profile">
            <h2>Profile</h2>
            <div class="profile-info">
                <div class="field">
                    <label>Name</label>
                    <div class="value">
                        <?php echo htmlspecialchars($firstname . " " . $lastname); ?>
                    </div>
                </div>
                <div class="field">
                    <label>Email</label>
                    <div class="value">
                        <?php echo htmlspecialchars($email); ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <h1 style="text-align:center; margin-top:2rem; font-size:3rem;">ORDERS</h1>

    <?php
        include("../php/adminDashboardOrders.php");
    ?>
</body>
</html>