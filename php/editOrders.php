<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/products.css">
    <link rel="stylesheet" href="css/Index.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Document</title>
</head>
<body> -->
    <!-- header -->
   <!--  <header>
        <a href="#"><img src="../images/logo.png" alt="" class="logo"></a>

        <ul class="navlist">
            <li><a href="#">home</a></li>
            <li><a href="#">new</a></li>
            <li><a href="#">makeup</a></li>
            <li><a href="#">skincare</a></li>
            <li><a href="#">sale</a></li>
            <li><a href="#">about us</a></li>
        </ul>

        <div class="right-content">
            <a href="#"><img src="../images/search.png" alt="" class="search"></a>
            <a href="#"><img src="../images/profile.png" alt="" class="profile"></a>
            <a href="#"><img src="../images/cart.png" alt="" class="cart1"></a>
        </div>
    </header> -->
    <!-- end of header -->

    <link rel="stylesheet" href="../css/products.css">
    <link rel="stylesheet" href="../css/footer.css">


    <?php
    include("../database.php");

    // Get the user ID from session
    session_start();
    $userId = $_SESSION["id"];

    // Prepare the SQL statement to fetch order items for the user
    $sql = "
        SELECT order_items.orders_id, order_items.product, order_items.price, order_items.quantity
        FROM order_items
        JOIN orders ON order_items.orders_id = orders.id
        WHERE orders.user_id = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId); // Bind the user ID parameter

    // Execute the statement
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($orderId, $product, $price, $quantity);
    ?>

    <div id="parentProduct">
        <h1>EDIT ORDER ITEMS</h1>            
        <form action="updateOrders.php" method="POST">
            <table id="products">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Deletion</th> <!-- New Delete column -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch values and output data for each row with input fields
                    while ($stmt->fetch()) {
                        echo "<tr>";
                        echo "<td class='productData'>" . htmlspecialchars($orderId) . "</td>";
                        echo "<td class='productData'><input type='text' name='product[]' value='" . htmlspecialchars($product) . "' /></td>";
                        echo "<td class='productData'><input type='number' name='price[]' value='" . htmlspecialchars($price) . "' step='0.01' /></td>";
                        echo "<td class='productData'><input type='number' name='quantity[]' value='" . htmlspecialchars($quantity) . "' /></td>";
                        echo "<input type='hidden' name='order_id[]' value='" . htmlspecialchars($orderId) . "' />";
                        // Add a delete link in the new column
                        echo "<td class='productData'><a href='delete.php?id=" . htmlspecialchars($orderId) . "' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div style="text-align: right; margin-top: 20px;">
                <input type="submit" value="SAVE" id="save"/>
            </div>
        </form>
    </div>








        <?php
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    ?>
<!-- 
<footer>
        <div class="footer_row">
            <div>
                <a href="#"><img src="../images/logo.png" class="footer_logo"></a>
            </div>

            <div class="footer_info">
                <ul>
                    <li><a href="#">about us</a></li>
                    <br><br>
                    <li><a href="#">FAQS</a></li>
                </ul>
            </div>

            <div class="footer_info">
                <ul>
                    <li><a href="#">store locator</a></li>
                    <br><br>
                    <li><a href="#">shipping and returns</a></li>
                </ul>
            </div>

            <div class="footer_info">
                <ul>
                    <li><a href="#">privacy and policy</a></li>
                    <br><br>
                    <li><a href="#">terms and conditions</a></li>
                </ul>
            </div>

    
            <div class="footer_info">
                        <img src="../images/facebook.png" class="footer_facebook">
                        <img src="../images/instagram.png" class="footer_instagram">
                        <img src="../images/twitter.png" class="footer_twitter">  
            </div>
        </div> 
</footer>
 -->
<!-- </body>
</html>
 -->
