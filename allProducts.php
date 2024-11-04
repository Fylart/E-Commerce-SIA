<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/allProducts.css">
    <title>Document</title>
</head>
<body>
    <?php
        include("database.php");
    ?>

    <div class="category">
        <div id="items">
            
            <?php
                $stmt = mysqli_prepare($conn, "SELECT name, price, imgDir FROM products ORDER BY id DESC");
/*                 mysqli_stmt_bind_param($stmt, "s", $email); */
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $name, $price, $imgDir);


                while (mysqli_stmt_fetch($stmt)) {

                    echo'<div class="item">';
                    echo"<a href='solo/{$name}.php' class='soloPage'>";
                       

                    echo "<img src='" . substr($imgDir, 3) . "' class='itemImg' onerror=\"this.onerror=null; this.src='images/Placeholder.webp';\">";
 
                    
                        echo'<h2>'. $name .'</h2>';
                    echo'</a>';
                    
                    echo'<h3 class="price">' . $price . '</h3>';
                    echo'<a href="" class="cart">ADD TO CART</a>';        
                    echo'</div>';
                }
            ?>
        </div>
    </div>
</body>
</html>