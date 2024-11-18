<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <title>Document</title>
</head>
<body> -->
    <link rel="stylesheet" href="../css/products.css">
    <link rel="stylesheet" href="../css/footer.css">
   <!--  <link rel="stylesheet" href="../css/header.css"> -->



    <?php
        include("../database.php");
       /*  include("../html/adminHeader.html"); */
    

        $userId = $_SESSION["id"];

        
                // Prepare the SQL statement
        $stmt = $conn->prepare("
        SELECT order_items.product, order_items.price, order_items.quantity
        FROM order_items
        JOIN orders ON order_items.orders_id = orders.id
        WHERE orders.user_id = ?
        ");
        $stmt->bind_param("i", $userId); // Bind the user ID parameter (assuming it's an integer)

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the order items details
        $orderItems = [];
        while ($row = $result->fetch_assoc()) {
        $orderItems[] = [
            'product' => $row['product'],
            'price' => $row['price'],
            'quantity' => $row['quantity']
        ]; // Store each item detail in an array
        }

        /* print_r($orderItems); */


    ?>








<div id="parentProduct">
    <table id="products">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Assuming $orderItems is already populated with product details
            foreach ($orderItems as $item) {
                echo "<tr>";
                    echo "<td class='productData'>" . htmlspecialchars($item['product']) . "</td>";
                    echo "<td class='productData'>$" . number_format($item['price'], 2) . "</td>";
                    echo "<td class='productData'>" . htmlspecialchars($item['quantity']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <div style="text-align: right; margin-top: 20px;">
        <a href="../php/editOrders.php" id="edit">EDIT</a>
    </div>
</div>














    <?php
        // Close the statement and connection
      /*   include("html/footer.html"); */
        $stmt->close();
        $conn->close();
    ?>
<!-- </body>
</html> -->


