<?php
session_start();

$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "PaymentDB";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$order_placed = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact_info = $_POST['contact'];  
    $region = $_POST['region'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $apartment = $_POST['apartment'];
    $postal_code = $_POST['postal'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $payment_method = $_POST['payment_method'];  

    $sql = "INSERT INTO users (contact_info) VALUES ('$contact_info')";
    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id;  

        $sql = "INSERT INTO delivery_info (user_id, region, first_name, last_name, address, apartment, postal_code, city, phone)
                VALUES ('$user_id', '$region', '$firstname', '$lastname', '$address', '$apartment', '$postal_code', '$city', '$phone')";
        $conn->query($sql);

        $sql = "INSERT INTO payment_methods (user_id, payment_method) VALUES ('$user_id', '$payment_method')";
        $conn->query($sql);

        $total_amount = 100.00;  
        $sql = "INSERT INTO orders (user_id, total_amount) VALUES ('$user_id', '$total_amount')";
        $conn->query($sql);

        $order_id = $conn->insert_id;

        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $product_name = $item['name'];
                $product_price = $item['price'];
                $quantity = $item['quantity'];
                $sql = "INSERT INTO order_items (order_id, product_name, product_price, quantity)
                        VALUES ('$order_id', '$product_name', '$product_price', '$quantity')";
                $conn->query($sql);
            }
        }

        $order_placed = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="assets/css/Payment.css" rel="stylesheet">

    <script>
        function showConfirmation() {
            let confirmation = confirm("Your order has been placed successfully! Click OK to continue.");
            if (confirmation) {
                window.location.href = document.referrer;  
            }
        }
    </script>
</head>
<body>

    <nav>
        <div class="logo">
            <img src="img/Logo.png" alt="Logo">
        </div>
        <div class="icons">  
            <i class="bi bi-search"></i>  
            <i class="bi bi-person-circle"></i>  
            <i class="bi bi-cart"></i>  
        </div>
    </nav>

    <section class="payment-container">
        <form method="POST" action="Payment.php">
            <div class="form-container">
                <h2 style="font-size: 16px;">Contact Information</h2>
                <input type="text" id="contact" name="contact" placeholder="Email or phone number" required>

                <h2 style="font-size: 16px;">Delivery Information</h2>
                <select id="region" name="region" required>
                    <option>Select region</option>
                    <option>Region 1</option>
                    <option>Region 2</option>
                </select>

                <input type="text" id="firstname" name="firstname" placeholder="First name" required>
                <input type="text" id="lastname" name="lastname" placeholder="Last name" required>
                <input type="text" id="address" name="address" placeholder="Address" required>
                <input type="text" id="apartment" name="apartment" placeholder="Apartment, suite, etc." required>
                <input type="text" id="postal" name="postal" placeholder="Postal Code" required>
                <input type="text" id="city" name="city" placeholder="City" required>
                <input type="text" id="phone" name="phone" placeholder="Phone" required>

                <h2 style="font-size: 16px;">Payment Method</h2>
                <div class="payment-methods">
                    <input type="radio" id="gcash" name="payment_method" value="GCash" required>
                    <label for="gcash">GCash</label>
                    <input type="radio" id="bpi" name="payment_method" value="BPI" required>
                    <label for="bpi">BPI</label>
                    <input type="radio" id="cod" name="payment_method" value="COD" required>
                    <label for="cod">Cash on Delivery</label>
                    <input type="radio" id="maya" name="payment_method" value="Maya" required>
                    <label for="maya">Maya</label>
                    <input type="radio" id="bdo" name="payment_method" value="BDO" required>
                    <label for="bdo">BDO</label>
                    <input type="radio" id="visa" name="payment_method" value="Visa" required>
                    <label for="visa">Visa</label>
                </div>
            </div>

            <div class="summary-container">
                <h2 style="font-size: 16px;">Order Summary</h2>
                <?php if (!empty($_SESSION['cart'])): ?>
                    <ul>
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                            <li><?= htmlspecialchars($item['name']) ?> - ₱<?= htmlspecialchars($item['price']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No items in your cart.</p>
                <?php endif; ?>
                <button type="submit" class="pay-now" onclick="showConfirmation()">Pay Now</button>
                <div class="copyright">All rights reserved © Pure Aura</div>
            </div>
        </form>
    </section>

    <?php
        if ($order_placed) {
            echo "<script>showConfirmation();</script>";
        }
    ?>

</body>
</html>
