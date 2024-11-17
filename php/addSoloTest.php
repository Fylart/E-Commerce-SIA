<?php
    include("../database.php");
    // Get posted data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $desc = $_POST['desc'];




    /* this is for storing the image */
    // Directory where the uploaded images will be saved
    $target_dir = "../images/"; // Ensure this folder exists and has write permissions
    $original_file_name = basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($original_file_name, PATHINFO_EXTENSION));

    // Initialize the target file path
    $target_file = $target_dir . $original_file_name;
    $uploadOk = 1;

    // Check if the form was submitted
    // Check if the uploaded file is an actual image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check for existing files and append a number if necessary
    $counter = 1;
    while (file_exists($target_file)) {
        // Create a new filename with an incremented number
        $target_file = $target_dir . pathinfo($original_file_name, PATHINFO_FILENAME) . "($counter)." . $imageFileType;
        $counter++;
    }

    // Check file size (optional)
    if ($_FILES["fileToUpload"]["size"] > 50000000) { // Limit size to 500KB
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if everything is ok to upload
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($target_file)) . " has been uploaded.";
            /* echo "<br>" . $target_file . "<br>"; */
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Your file was not uploaded due to errors.";
    }





    // Prepare and execute insert statement
    $stmt = $conn->prepare("INSERT INTO products (name, price, stock, description, imgDir) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdiss", $name, $price, $stock,$desc, $target_file);
    $stmt->execute();





    /* This is for create file for the solo page */
    // Specify the path and name of the new HTML file
    $fileName = '../solo/' . $name . '.php';
    
    // Open the file for writing (this will create the file if it doesn't exist)
    $fileHandle = fopen($fileName, 'w') or die('Unable to open file!');

   /*  $content = <<<EOD
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Product Details</title>
            <link rel="stylesheet" href="../css/soloProduct.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        </head>
        <body>
            <?php
                include("../database.php");
                \$currentFileName = basename(__FILE__, '.php');

                // Prepare the SQL statement
                \$sql = "SELECT id, name, price, stock, description, imgDir FROM products WHERE name = '{\$currentFileName}' ORDER BY id DESC";
                \$stmt = \$conn->prepare(\$sql);

                // Execute the statement
                \$stmt->execute();

                // Bind result variables
                \$stmt->bind_result(\$id, \$name, \$price, \$stock, \$desc, \$imgDir);
                \$stmt->fetch();
            ?>

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
                        <i class="bi bi-cart"></i>
                    </div>
                </div>
            </header>

            <!-- Product Details Section -->
            <section class="product-container container mt-4">
                <div class="row">
                    <div class="col-md-6 product-image text-center">
                        <img id="mainProductImage" 
                        src="
                                <?php
                                    echo htmlspecialchars(\$imgDir);
                                
                                ?>
                            " 
                        alt="Product Image" class="img-fluid rounded">
                    </div>
                    <div class="col-md-6 product-details">
                        <h1 class="product-title">
                            <?php
                                echo htmlspecialchars(\$name);
                            ?>
                        </h1>
                        <p class="product-price">
                            <?php
                                echo '₱ ' . htmlspecialchars(\$price);
                            ?>
                        </p>

                        <div class="variant-section mb-3">
                            <label class="variant-label">Variant</label>
                            <select class="variant-select form-select">
                                <option value="" disabled selected>Select a variant</option>
                                <option value="variant1">Variant 1</option>
                                <option value="variant2">Variant 2</option>
                            </select>
                        </div>

                        <!-- Add to Cart Button -->
                        <button class="add-to-cart">Add to Cart</button>

                        <div class="">
                            <p class="section-title">Description:</p>

                            <?php
                                // Fetch values and output data for each row
                                echo "<p>" . htmlspecialchars(\$desc) . "</p>";

                            ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- JavaScript for Image Change -->
            <script>
                function changeProductImage(thumbnail) {
                    var mainImage = document.getElementById("mainProductImage");
                    var tempSrc = mainImage.src;
                    mainImage.src = thumbnail.src;
                    thumbnail.src = tempSrc;
                }
            </script>

            <!-- Footer Section -->
            <footer class="footer">   
                <div class="footer-logo">  
                    <img src="img/Logo.png" alt="Logo" style="width: 80px;">  
                </div>  
                <div class="container text-center">    
                    <ul class="footer-links mt-3 list-unstyled d-flex justify-content-center">  
                        <li class="mx-3"><a href="#">about us</a></li>  
                        <li class="mx-3"><a href="#">store locator</a></li>  
                        <li class="mx-3"><a href="#">privacy policy</a></li>  
                        <li class="mx-3"><a href="#">FAQS</a></li>  
                        <li class="mx-3"><a href="#">shipping and returns</a></li>  
                        <li class="mx-3"><a href="#">terms and conditions</a></li>  
                    </ul>    
                </div>
                <div class="social-icons">  
                    <i class="bi bi-facebook"></i>  
                    <i class="bi bi-instagram"></i>  
                    <i class="bi bi-twitter"></i>  
                </div>  
            </footer>  

            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>  
        </html>
    EOD;
 */


 
$content = <<<EOD
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Details</title>
        <link rel="stylesheet" href="../css/soloProduct.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php
            include("../database.php");
            \$currentFileName = basename(__FILE__, '.php');

            // Prepare the SQL statement
            \$sql = "SELECT id, name, price, stock, description, imgDir FROM products WHERE name = '{\$currentFileName}' ORDER BY id DESC";
            \$stmt = \$conn->prepare(\$sql);

            // Execute the statement
            \$stmt->execute();

            // Bind result variables
            \$stmt->bind_result(\$id, \$name, \$price, \$stock, \$desc, \$imgDir);
            \$stmt->fetch();
        ?>

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
                    <i class="bi bi-cart"  id="cartIcon"></i>
                </div>
            </div>
        </header>

        <!-- Product Details Section -->
        <section class="product-container container mt-4">
            <div class="row">
                <div class="col-md-6 product-image text-center">
                    <img id="mainProductImage" 
                    src="
                            <?php
                                echo htmlspecialchars(\$imgDir);
                            
                            ?>
                        " 
                    alt="Product Image" class="img-fluid rounded">
                </div>
                <div class="col-md-6 product-details">
                    <h1 class="product-title">
                        <?php
                            echo htmlspecialchars(\$name);
                        ?>
                    </h1>
                    <p class="product-price">
                        <?php
                            echo '₱ ' . htmlspecialchars(\$price);
                        ?>
                    </p>

                    <div class="variant-section mb-3">
                        <label class="variant-label">Variant</label>
                        <select class="variant-select form-select">
                            <option value="" disabled selected>Select a variant</option>
                            <option value="variant1">Variant 1</option>
                            <option value="variant2">Variant 2</option>
                        </select>
                    </div>

                    <!-- Add to Cart Button -->
                    <!-- dito mag babago gar -->
                    <button class="btn add-to-cart"  onclick="addToCart('<?php echo htmlspecialchars(\$name);?>', '<?php echo htmlspecialchars(\$price);?>', '<?php echo htmlspecialchars(\$imgDir); ?>')" style="background-color: #6f4d57; color: #FFFFFF; padding: 10px 20px; font-size: 16px; border: none; border-radius: 20px; cursor: pointer; display: block; width: 100%;">Add to Cart</button>

                    <div class="">
                        <p class="section-title">Description:</p>

                        <?php
                            // Fetch values and output data for each row
                            echo "<p>" . htmlspecialchars(\$desc) . "</p>";

                        ?>
                    </div>
                </div>
            </div>
        </section>


        <!-- Footer Section -->
        <footer class="footer">   
            <div class="footer-logo">  
                <img src="img/Logo.png" alt="Logo" style="width: 80px;">  
            </div>  
            <div class="container text-center">    
                <ul class="footer-links mt-3 list-unstyled d-flex justify-content-center">  
                    <li class="mx-3"><a href="#">about us</a></li>  
                    <li class="mx-3"><a href="#">store locator</a></li>  
                    <li class="mx-3"><a href="#">privacy policy</a></li>  
                    <li class="mx-3"><a href="#">FAQS</a></li>  
                    <li class="mx-3"><a href="#">shipping and returns</a></li>  
                    <li class="mx-3"><a href="#">terms and conditions</a></li>  
                </ul>    
            </div>
            <div class="social-icons">  
                <i class="bi bi-facebook"></i>  
                <i class="bi bi-instagram"></i>  
                <i class="bi bi-twitter"></i>  
            </div>  
        </footer>  

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
        
        <script>
            // Show cart popup when cart icon is clicked  
            document.getElementById('cartIcon').addEventListener('click', function () {  
                document.getElementById('cartPopup').classList.toggle('open');  
            }); 

            // Initialize cart from sessionStorage or set it to an empty array if not set  
            let cartItems = JSON.parse(sessionStorage.getItem('cart')) || [];  


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
                        <img src="\${item.imageSrc}" alt="\${item.product}" style="width: 50px; height: 50px; margin-right: 10px;">  
                        <span>\${item.product}</span> - <span>₱\${item.price}</span>  
                        <div class="quantity-control">  
                            <button onclick="changeQuantity(\${index}, -1)">-</button>  
                            <input type="text" value="\${item.quantity}" readonly>  
                            <button onclick="changeQuantity(\${index}, 1)">+</button>  
                        </div>  
                        <button class="remove-btn" onclick="removeItem(\${index})">Remove</button>  
                    `;  
                    cartItemsContainer.appendChild(cartItemElement);  
                });  

                // Display the Proceed to Checkout button if there are items in the cart  
                const checkoutButton = document.getElementById('checkoutBtn');  
                
                
                if (cartItems.length > 0) {  
                    checkoutButton.style.display = 'block';  
                    const cartData = encodeURIComponent(JSON.stringify(cartItems));  
                    document.querySelector('.checkout-btn').parentElement.href = `..\\\gabTeam\\\Payment.php?cartData=\${cartData}`;  
                } else {  
                    checkoutButton.style.display = 'none';  
                }  
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

            // Remove item from cart  
            function removeItem(index) {  
                cartItems.splice(index, 1);  
                updateCartPopup();  
                saveCartToSession();  
            }  

            
            // Save cart to sessionStorage  
            function saveCartToSession() {  
                sessionStorage.setItem('cart', JSON.stringify(cartItems));  
            }  


            


        </script>




        <div id="cartPopup">
            <div class="cart-header">
                <h5>Your Cart</h5>
                <!-- close button -->
                <i class="bi bi-x-circle close-btn" onclick="document.getElementById('cartPopup').classList.remove('open');"></i>
            </div>
            <div class="cart-items"></div>
            <a href="Payment.php?cartData=">
                <button class="checkout-btn" id="checkoutBtn" style="display: none;">Proceed to Checkout</button>
            </a>
        </div>  



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
    </body>  
    </html>
EOD;
  


    // Write content to the file
    fwrite($fileHandle, $content);
    
    // Close the file handle
    fclose($fileHandle);

    echo "File '$fileName' created successfully.";





    /* this is the end of database */
    $stmt->close();
    $conn->close();

    // Redirect back to edit page after addition
    header("Location: ../adminDashboard.php");
    exit;


?>