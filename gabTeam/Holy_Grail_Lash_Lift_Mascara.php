<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="assets/css/HolyGrailLashLiftMascara.css" rel="stylesheet">

    <style>
        /* Cart Popup Styles */
        #cartPopup {
            position: fixed;
            top: 0;
            right: 0;
            width: 25%;
            height: 100%;
            background-color: #fff;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            padding: 20px;
            overflow-y: auto;
            z-index: 9999;
        }
        #cartPopup.open {
            transform: translateX(0);
        }
        #cartPopup .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        #cartPopup .cart-items {
            max-height: 70%;
            overflow-y: auto;
        }
        #cartPopup .cart-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        #cartPopup .close-btn {
            cursor: pointer;
            font-size: 1.5rem;
            color: #333;
        }
        .quantity-control {
            display: flex;
            align-items: center;
        }
        .quantity-control button {
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            padding: 5px;
            cursor: pointer;
        }
        .quantity-control input {
            width: 40px;
            text-align: center;
            border: 1px solid #ddd;
            margin: 0 5px;
        }
        .remove-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        /* Add styles for the proceed to checkout button */
        .checkout-btn {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .checkout-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<!-- Header Section -->
<header>
    <div class="nav-container">
        <div class="logo">
            <img src="img/Logo.png" alt="Logo">
        </div>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="#">home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">new</a></li>
                <li class="nav-item"><a class="nav-link" href="#">makeup</a></li>
                <li class="nav-item"><a class="nav-link" href="#">skincare</a></li>
                <li class="nav-item"><a class="nav-link" href="#">sale</a></li>
                <li class="nav-item"><a class="nav-link" href="#">about us</a></li>
            </ul>
        </nav>
        <div class="icons">
            <i class="bi bi-search"></i>
            <i class="bi bi-person-circle"></i>
            <i class="bi bi-cart" id="cartIcon" style="cursor: pointer;"></i>
        </div>
    </div>
</header>

<!-- Product Details Section -->
<section class="product-container container mt-4">
    <div class="row">
        <div class="col-md-6 product-image text-center">
            <img id="mainProductImage" src="img/Eyes/Holy Grail Lash Lift Mascara/IMG_0277.WEBP" alt="Product Image" class="img-fluid rounded">
            <div class="product-thumbnails d-flex justify-content-center mt-4">
                <img src="img/Eyes/Holy Grail Lash Lift Mascara/IMG_0279.WEBP" alt="Thumbnail 1" class="me-2 rounded" onclick="changeProductImage(this)">
                <img src="img/Eyes/Holy Grail Lash Lift Mascara/IMG_0280.WEBP" alt="Thumbnail 2" class="me-2 rounded" onclick="changeProductImage(this)">
                <img src="img/Eyes/Holy Grail Lash Lift Mascara/IMG_0281.WEBP" alt="Thumbnail 3" class="me-2 rounded" onclick="changeProductImage(this)">
            </div>
        </div>
        <div class="col-md-6 product-details">
            <h1 class="product-title">Holy Grail Lash Lift Mascara</h1>
            <p class="product-price">₱499.00</p>

            <div class="variant-section mb-3">
                <label class="variant-label">Variant</label>
                <select class="variant-select form-select">
                    <option value="" disabled selected>Select a variant</option>
                    <option value="variant1">Variant 1</option>
                    <option value="variant2">Variant 2</option>
                </select>
            </div>

            <button class="add-to-cart btn" onclick="addToCart('Holy Grail Lash Lift Mascara', 499, 'img/Eyes/Holy Grail Lash Lift Mascara/IMG_0277.WEBP')">Add to Cart</button>

            <div class="product-description mt-4">
                <p>A luxurious oil that deeply moisturizes and creates a calmer mood. A luxurious oil that wraps skin in moisture while eliciting true feelings of wellbeing. Moisturizes, Calms, Brightens.</p>
                <p class="section-title">Ingredients:</p>
                <p>Squalane, Aleurites Moluccanus Seed Oil, Macadamia Ternifolia Seed Oil, Oenothera Biennis Oil, Cannabigerol, Fragrance/Parfum.</p>
                <p class="section-title">How to use:</p>
                <p>Massage directly onto cleansed skin or layer over lotion to seal in extra moisture.</p>
            </div>
        </div>
    </div>
</section>

<script>  
    // Initialize cart from sessionStorage or set it to an empty array if not set  
    let cartItems = JSON.parse(sessionStorage.getItem('cart')) || [];  

    // Function to change product image on thumbnail click  
    function changeProductImage(thumbnail) {  
        const mainImage = document.getElementById("mainProductImage");  
        mainImage.src = thumbnail.src;  
    }  

    // Function to add item to cart with main image  
    function addToCart(product, price, imageSrc) {  
        const existingItemIndex = cartItems.findIndex(item => item.product === product);  
        if (existingItemIndex !== -1) {  
            cartItems[existingItemIndex].quantity += 1; // Increase quantity if product already in cart  
        } else {  
            cartItems.push({ product, price, quantity: 1, imageSrc }); // Add new item with image  
        }  
        updateCartPopup();  
        saveCartToSession();  
    }  

    // Update the cart popup with items  
    function updateCartPopup() {  
        const cartPopup = document.getElementById('cartPopup');  
        const cartItemsContainer = cartPopup.querySelector('.cart-items');  
        cartItemsContainer.innerHTML = ''; // Clear existing items  

        cartItems.forEach((item, index) => {  
            const cartItemElement = document.createElement('div');  
            cartItemElement.classList.add('cart-item');  
            cartItemElement.innerHTML = `   
                <img src="${item.imageSrc}" alt="${item.product}" style="width: 50px; height: 50px; margin-right: 10px;">  
                <span>${item.product}</span> - <span>₱${item.price}</span>  
                <div class="quantity-control">  
                    <button onclick="changeQuantity(${index}, -1)">-</button>  
                    <input type="text" value="${item.quantity}" readonly>  
                    <button onclick="changeQuantity(${index}, 1)">+</button>  
                </div>  
                <button class="remove-btn" onclick="removeItem(${index})">Remove</button>  
            `;  
            cartItemsContainer.appendChild(cartItemElement);  
        });  

        // Display the Proceed to Checkout button if there are items in the cart  
        const checkoutButton = document.getElementById('checkoutBtn');  
        if (cartItems.length > 0) {  
            checkoutButton.style.display = 'block';  
            const cartData = encodeURIComponent(JSON.stringify(cartItems));  
            document.querySelector('.checkout-btn').parentElement.href = `Payment.php?cartData=${cartData}`;  
        } else {  
            checkoutButton.style.display = 'none';  
        }  
    }  

    // Save cart to sessionStorage  
    function saveCartToSession() {  
        sessionStorage.setItem('cart', JSON.stringify(cartItems));  
    }  

    // Remove item from cart  
    function removeItem(index) {  
        cartItems.splice(index, 1);  
        updateCartPopup();  
        saveCartToSession();  
    }  

    // Change the quantity of an item  
    function changeQuantity(index, change) {  
        const newQuantity = cartItems[index].quantity + change;  
        if (newQuantity > 0) {  
            cartItems[index].quantity = newQuantity;  
            updateCartPopup();  
            saveCartToSession();  
        }  
    }  

    // Show cart popup when cart icon is clicked  
    document.getElementById('cartIcon').addEventListener('click', function () {  
        document.getElementById('cartPopup').classList.toggle('open');  
    });  
</script>

<!-- Cart Popup -->
<div id="cartPopup">
        <div class="cart-header">
            <h5>Your Cart</h5>
            <i class="bi bi-x-circle close-btn" onclick="document.getElementById('cartPopup').classList.remove('open');"></i>
        </div>
        <div class="cart-items"></div>
        <a href="Payment.php?cartData=">
            <button class="checkout-btn" id="checkoutBtn" style="display: none;">Proceed to Checkout</button>
        </a>
    </div>  

</body>
</html>
