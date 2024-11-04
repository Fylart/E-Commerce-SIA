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
</head>
<body>

    <!-- Navbar Section -->
    <nav>
        <div class="logo">
            <img src="img/Logo.png" alt="Logo"> <!-- Replace "logo.png" with the path to your logo image -->
        </div>
        <div class="icons">  
                <i class="bi bi-search"></i>  
                <i class="bi bi-person-circle"></i>  
                <i class="bi bi-cart"></i>  
            </div>
    </nav>

    <!-- Payment Section -->
    <section class="payment-container">
        <!-- Delivery Form -->
        <div class="form-container">
            <h2 style="font-size: 16px;">Contact Information</h2>
            <input type="text" id="contact" placeholder="Email or phone number">

            <h2 style="font-size: 16px;">Delivery Information</h2>
            <select id="region">
                <option>Select region</option>
                <option>Region 1</option>
                <option>Region 2</option>
            </select>

            <input type="text" id="firstname" placeholder="First name">
            <input type="text" id="lastname" placeholder="Last name">
            <input type="text" id="address" placeholder="Address">
            <input type="text" id="apartment" placeholder="Apartment, suite, etc.">
            <input type="text" id="postal" placeholder="Postal Code">
            <input type="text" id="city" placeholder="City">
            <input type="text" id="phone" placeholder="Phone">

            <h2 style="font-size: 16px;">Payment Method</h2>
            <div class="payment-methods">
                <img src="img/payment-img/gcash.png" alt="GCash"> <!-- Replace with actual image path -->
                <img src="img/payment-img/bpi.png" alt="BPI"> <!-- Replace with actual image path -->
                <img src="img/payment-img/cod.png" alt="Cash on Delivery"> <!-- Replace with actual image path -->
                <img src="img/payment-img/maya.png" alt="Maya"> <!-- Replace with actual image path -->
                <img src="img/payment-img/bdo.png" alt="BDO"> <!-- Replace with actual image path -->
                <img src="img/payment-img/visa.png" alt="Visa"> <!-- Replace with actual image path -->
            </div>
        </div>

        <!-- Order Summary -->
        <div class="summary-container">
            <h2 style="font-size: 16px;">Order Summary</h2>
            <p>No items in your cart.</p>
            <button class="pay-now">Pay Now</button>
            <div class="copyright">All rights reserved © Pure Aura</div> <!-- Copyright text directly below button -->
        </div>
    </section>

</body>
</html>
