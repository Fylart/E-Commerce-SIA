<?php
session_start();

// Handle incoming cart data from GET request
if (isset($_GET['cartData'])) {
    $cartData = json_decode(urldecode($_GET['cartData']), true);
    $_SESSION['cart'] = $cartData; // Store it in the session for further processing
} elseif (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Initialize if no cart data is provided
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'ecom');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user information based on session
$user_info = [];
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $query = "SELECT id, email, firstName, lastName, address FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($id, $email, $first_name, $last_name, $address);

    if ($stmt->fetch()) {
        $user_info = [
            'id' => $id,
            'email' => $email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'address' => $address,
        ];
    }
    $stmt->close();
}

$order_placed = false;
$orders_id = null; // Initialize orders_id

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $region = $_POST['region'];
    $apartment = $_POST['apartment'];
    $postal_code = $_POST['postal'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $payment_method = $_POST['payment_method'];
    $user_id = $user_info['id'];

    // Insert data into orders table
    $stmt = $conn->prepare("INSERT INTO orders (user_id, region, apartment, postal_code, city, phone, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $user_id, $region, $apartment, $postal_code, $city, $phone, $payment_method);

    if ($stmt->execute()) {
        // Get the last inserted orders ID
        $orders_id = $stmt->insert_id;
        $order_placed = true;

        // Now insert each item in the cart into order_items table
        $orderItemsStmt = $conn->prepare("INSERT INTO order_items (orders_id, product, price, quantity, region) VALUES (?, ?, ?, ?, ?)");

        foreach ($_SESSION['cart'] as $item) {
            $product_name = $item['product'];
            $product_price = $item['price'];
            $product_quantity = $item['quantity'];
            $region = $_POST['region']; // Get the selected region

            $orderItemsStmt->bind_param("issii", $orders_id, $product_name, $product_price, $product_quantity, $region);
            $orderItemsStmt->execute();
        }

        $orderItemsStmt->close();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="assets/css/payment.css">
</head>
<body>

<div class="payment-container">
    <!-- Left Card: Payment Form -->
    <form method="post" action="" class="card form-container">
        <h2>Delivery Information</h2>
        <input type="text" id="firstname" name="first_name" value="<?= htmlspecialchars($user_info['first_name'] ?? '') ?>" placeholder="First Name" required>
        <input type="text" id="lastname" name="last_name" value="<?= htmlspecialchars($user_info['last_name'] ?? '') ?>" placeholder="Last Name" required>
        <input type="text" id="address" name="address" value="<?= htmlspecialchars($user_info['address'] ?? '') ?>" placeholder="Address" required>
        
        <select id="region" name="region" required>
            <option value="" disabled selected>Select region</option>
            <?php
            $regions = ['Region 1', 'Region 2'];
            foreach ($regions as $region) {
                echo "<option value='$region'>$region</option>";
            }
            ?>
        </select>
        <input type="text" id="apartment" name="apartment" placeholder="Apartment, suite, etc." required>
        <input type="text" id="postal" name="postal" placeholder="Postal Code" required>
        <input type="text" id="city" name="city" placeholder="City" required>
        <input type="text" id="phone" name="phone" placeholder="Phone Number" required>

        <h2>Payment Method</h2>
        <div class="payment-methods">
            <label for="gcash">GCash</label>
            <input type="radio" id="gcash" name="payment_method" value="GCash" required>
            <label for="bpi">BPI</label>
            <input type="radio" id="bpi" name="payment_method" value="BPI" required>
            <label for="cod">Cash on Delivery</label>
            <input type="radio" id="cod" name="payment_method" value="COD" required>
            <label for="maya">Maya</label>
            <input type="radio" id="maya" name="payment_method" value="Maya" required>
            <label for="bdo">BDO</label>
            <input type="radio" id="bdo" name="payment_method" value="BDO" required>
            <label for="visa">Visa</label>
            <input type="radio" id="visa" name="payment_method" value="Visa" required>
        </div>

        <button type="submit" class="pay-now">Pay Now</button>
    </form>

    <!-- Right Card: Order Summary -->
    <div class="card summary-container">
        <h2>Order Summary</h2>
        <?php if (!empty($_SESSION['cart'])): ?>
            <ul class="order-summary">
                <?php
                $total_amount = 0;
                foreach ($_SESSION['cart'] as $item):
                    $product_name = htmlspecialchars($item['product'] ?? 'Unknown Product');
                    $product_price = htmlspecialchars($item['price'] ?? 0);
                    $quantity = htmlspecialchars($item['quantity'] ?? 1);
                    $image_src = htmlspecialchars($item['imageSrc'] ?? '');
                    $total_amount += $product_price * $quantity;
                ?>
                    <li>
                        <img src="<?= $image_src ?>" alt="<?= $product_name ?>" style="width: 100px; height: 100px; margin-right: 10px;">
                        <?= $product_name ?> - ₱<?= number_format($product_price, 2) ?> x <?= $quantity ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <h3>Total: ₱<?php echo number_format($total_amount, 2); ?></h3>
        <?php else: ?>
            <p>No items in your cart.</p>
        <?php endif; ?>
    </div>
</div>

<?php  
// Show confirmation if the order was placed successfully  
if ($order_placed && $orders_id !== null) {  
    echo "<script>alert('Order placed successfully! Your Order ID is: $orders_id.');</script>";  
}  
?>

</body>
</html>