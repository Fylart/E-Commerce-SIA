<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/products.css">
    <link rel="stylesheet" href="css/Index.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <title>Document</title>
</head>
<body>
    <!-- dito yung issue tine -->
    <?php
        include("../database.php");
        include("../html/header.html");
        // Prepare the SQL statement
        $sql = "SELECT id, name, price, stock, description FROM products ORDER BY id DESC";
        $stmt = $conn->prepare($sql);

        // Execute the statement
        $stmt->execute();

        // Bind result variables
        $stmt->bind_result($id, $name, $price, $stock, $desc);
        ?>

        <div id="parentProduct">
            <h1>ADD NEW PRODUCT</h1>


            
<!--             <form action="add.php" method="POST">
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
            </form> -->


            <form action="addSoloTest.php" method="POST" enctype="multipart/form-data">
                <div style="text-align: right; margin-top: 20px;">
                    <input type="submit" value="Add Product" id="save"/>
                </div>
                <table id="products">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class='productData'><input type="file" name="fileToUpload" id="fileToUpload" required/></td>
                            <td class='productData'><input type="text" name="name" required /></td>
                            <td class='productData'><input type="number" name="price" step="0.01" required /></td>
                            <td class='productData'><input type="number" name="stock" required /></td>
                            <td class='productData'><input type="text" name="desc" required /></td>
                        </tr>
                    </tbody>
                </table>

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
                                <th>Description</th>
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
                                echo "<td class='productData'><input type='text' name='description[]' value='" . htmlspecialchars($desc) . "' /></td>";
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
        include("../html/footer.html");
        $stmt->close();
        $conn->close();
    ?>
</body>
</html>

