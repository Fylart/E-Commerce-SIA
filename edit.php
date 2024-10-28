<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/products.css">
    <title>Document</title>
</head>
<body>
    <?php
        include("database.php");
        // Prepare the SQL statement
        $sql = "SELECT id, name, price, stock FROM products ORDER BY id DESC";
        $stmt = $conn->prepare($sql);

        // Execute the statement
        $stmt->execute();

        // Bind result variables
        $stmt->bind_result($id, $name, $price, $stock);
        ?>

        <div id="parentProduct">
            <h1>ADD NEW PRODUCT</h1>
            <form action="add.php" method="POST">
                <table id="products">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class='productData'><input type="text" name="name" required /></td>
                            <td class='productData'><input type="number" name="price" step="0.01" required /></td>
                            <td class='productData'><input type="number" name="stock" required /></td>
                        </tr>
                    </tbody>
                </table>
                <div style="text-align: right; margin-top: 20px;">
                    <input type="submit" value="Add Product" id="save"/>
                </div>
            </form>
        </div>


        <hr> <!-- Horizontal rule for separation -->

        <div id="parentProduct">
            <h1>EDIT PRODUCT</h1>            
            <form action="update.php" method="POST">
                <table id="products">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Deletion</th> <!-- New Delete column -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch values and output data for each row with input fields
                            while ($stmt->fetch()) {
                                echo "<tr>";
                                echo "<td class='productData'>" . htmlspecialchars($id) . "</td>";
                                echo "<td class='productData'><input type='text' name='name[]' value='" . htmlspecialchars($name) . "' /></td>";
                                echo "<td class='productData'><input type='number' name='price[]' value='" . htmlspecialchars($price) . "' step='0.01' /></td>";
                                echo "<td class='productData'><input type='number' name='stock[]' value='" . htmlspecialchars($stock) . "' /></td>";
                                echo "<input type='hidden' name='id[]' value='" . htmlspecialchars($id) . "' />";
                                                // Add a delete link in the new column
                                echo "<td class='productData'><a href='delete.php?id=" . htmlspecialchars($id) . "' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a></td>";
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



        

        <!-- Form to add a new product -->





        <?php
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    ?>
</body>
</html>

