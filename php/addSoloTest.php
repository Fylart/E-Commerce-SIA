<?php
    include("../database.php");
    // Get posted data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $desc = $_POST['desc'];

    // Prepare and execute insert statement
    $stmt = $conn->prepare("INSERT INTO products (name, price, stock, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdis", $name, $price, $stock,$desc);
    $stmt->execute();

    // Specify the path and name of the new HTML file
    $fileName = '../solo/' . $name . '.php';
    
    // Open the file for writing (this will create the file if it doesn't exist)
    $fileHandle = fopen($fileName, 'w') or die('Unable to open file!');



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
                \$sql = "SELECT id, name, price, stock, description FROM products WHERE name = '{\$currentFileName}' ORDER BY id DESC";
                \$stmt = \$conn->prepare(\$sql);

                // Execute the statement
                \$stmt->execute();

                // Bind result variables
                \$stmt->bind_result(\$id, \$name, \$price, \$stock, \$desc);
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
                        <img id="mainProductImage" src="img/Lips/Lip treatment hydrating balm/IMG_0309.WEBP" alt="Product Image" class="img-fluid rounded">
                        <div class="product-thumbnails d-flex justify-content-center mt-4">
                            <img src="img/Lips/Lip treatment hydrating balm/IMG_0310.WEBP" alt="Thumbnail 1" class="me-2 rounded" onclick="changeProductImage(this)">
                            <img src="img/Lips/Lip treatment hydrating balm/IMG_0311.WEBP" alt="Thumbnail 2" class="me-2 rounded" onclick="changeProductImage(this)">
                            <img src="img/Lips/Lip treatment hydrating balm/IMG_0312.WEBP" alt="Thumbnail 3" class="me-2 rounded" onclick="changeProductImage(this)">
                        </div>
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


    // Write content to the file
    fwrite($fileHandle, $content);
    
    // Close the file handle
    fclose($fileHandle);

    echo "File '$fileName' created successfully.";

    $stmt->close();
    $conn->close();

    // Redirect back to edit page after addition
    header("Location: ../adminDashboard.php");
    exit;


?>