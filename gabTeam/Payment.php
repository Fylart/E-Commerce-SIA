<?php
session_start();

$order_placed = false;
$payment_method = '';
if (isset($_GET['cartData'])) {  
    $cartData = json_decode(urldecode($_GET['cartData']), true);  
    $_SESSION['cart'] = $cartData; // Save cart data in session  
} else {  
    $_SESSION['cart'] = []; // Initialize if no cart data is provided  
}  
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

    // Simulate order placed without DB interaction
    $order_placed = true;
}
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

        function selectPaymentMethod(method) {
            document.getElementById('payment_method').value = method;
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
                    <img src="img/payment-img/gcash.png" alt="GCash" onclick="selectPaymentMethod('GCash')">
                    <img src="img/payment-img/bpi.png" alt="BPI" onclick="selectPaymentMethod('BPI')">
                    <img src="img/payment-img/cod.png" alt="Cash on Delivery" onclick="selectPaymentMethod('COD')">
                    <img src="img/payment-img/maya.png" alt="Maya" onclick="selectPaymentMethod('Maya')">
                    <img src="img/payment-img/bdo.png" alt="BDO" onclick="selectPaymentMethod('BDO')">
                    <img src="img/payment-img/visa.png" alt="Visa" onclick="selectPaymentMethod('Visa')">
                </div>
                <input type="hidden" name="payment_method" id="payment_method">
            </div>
        </form>

        <div class="summary-container">
                <h2 style="font-size: 16px;">Order Summary</h2>
                <?php if (!empty($_SESSION['cart'])): ?>  
    <ul class="order-summary">  
        <?php  
        $total_amount = 0;  
        foreach ($_SESSION['cart'] as $item):   
            // Change "name" to "product" since that's what you set in the cart  
            $product_name = htmlspecialchars($item['product'] ?? 'Unknown Product');  
            $product_price = htmlspecialchars($item['price'] ?? 0);  
            $quantity = htmlspecialchars($item['quantity'] ?? 1);  
            $image_src = htmlspecialchars($item['imageSrc'] ?? ''); // Ensure to use the imageSrc key  

            $total_amount += $product_price * $quantity;  
        ?>  
            <li>  
                <img src="<?= $image_src ?>" alt="<?= $product_name ?>" style="width: 100px; height: 100px; margin-right: 10px;">  
                <?= $product_name ?> - ₱<?= number_format($product_price, 2) ?> x <?= $quantity ?>  
            </li>  
        <?php endforeach; ?>  
    </ul>  
    <h3>Total: ₱<?php echo number_format($total_amount, 2); ?></h3>
    <button type="button" class="pay-now">Pay Now</button>  
<?php else: ?>  
    <p>No items in your cart.</p>  
<?php endif; ?>
    </section>
    <?php
        if ($order_placed) {
            echo "<script>showConfirmation();</script>";
        }
    ?>
</div>
</body>
</html>
