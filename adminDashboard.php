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
        <table id="products">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch values and output data for each row
                    while ($stmt->fetch()) {
                        echo "<tr>";
                            echo "<td class='productData'>" . htmlspecialchars($id) . "</td>";
                            echo "<td class='productData'>" . htmlspecialchars($name) . "</td>";
                            echo "<td class='productData'>$" . number_format($price, 2) . "</td>";
                            echo "<td class='productData'>" . htmlspecialchars($stock) . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <div style="text-align: right; margin-top: 20px;">
            <a href="php/edit.php" id="edit">EDIT</a>
        </div>
    </div>



    <?php
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    ?>
</body>
</html>


