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

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Face/Creme Cushion Blush/IMG_0305.WEBP" class='itemImg'>
                <h2>Cream Blush</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>


        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Skin/Face Sculpting Microcurrent Spheres/IMG_0325.WEBP" class='itemImg'>
                <h2>Face Sculpting</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Eyes/Holy Grail Lash Lift Mascara/IMG_0277.WEBP" class='itemImg'>
                <h2>Holy Grail Lash Lift Mascara</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Eyes/Holy Grail Microblade Brow Renew Shaping Gel/IMG_0282.WEBP" class='itemImg'>
                <h2>Holy Grail Microblade</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Skin/Hyaluronic + B3 Boost Brightening Eye Cream/IMG_0334.WEBP" class='itemImg'>
                <h2>Hyaluronic + B3 Boost</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Skin/Hydration Microencapsulated Moisturiser/IMG_0329.WEBP" class='itemImg'>
                <h2>Moisturiser</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Lips/Lip Cream Weightless Matte Color/IMG_0317.WEBP" class='itemImg'>
                <h2>Lip Cream Weightless</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Lips/Lip treatment hydrating balm/IMG_0309.WEBP" class='itemImg'>
                <h2>Lip treatment</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Face/Multi-tasking Serum Concealer/IMG_0297.WEBP" class='itemImg'>
                <h2>Serum Concealer</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Face/Off Duty Soft Focus Creme Bronzer/IMG_0301.WEBP" class='itemImg'>
                <h2>Off Duty Soft FocusCreme</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Lips/Perfect Aura Iconic 2in1 Blush and Lip Cream/IMG_0321.WEBP" class='itemImg'>
                <h2>Perfect Aura Iconic</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Eyes/Perfect Brows Brow Grip/IMG_0285.WEBP" class='itemImg'>
                <h2>Perfect Brows Brow Grip</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Eyes/Satin & Shimmer Duet eyeshadow/IMG_0289.WEBP" class='itemImg'>
                <h2>Satin & Shimmer Duet</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Skin/Skin Clarity Exfoliating Cleanser/IMG_0336.WEBP" class='itemImg'>
                <h2>Skin Clarity Exfoliating</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

        <div class="item">
            <a href="" class="soloPage">
                <img src="gabTeam/img/Face/Softlight skin smoothing Liquid Foundation/IMG_0293.WEBP" class='itemImg'>
                <h2>Softlight skin smoothing</h2>
            </a>

            <h3 class="price">₱499.00</h3>
            <a href="" class="cart">ADD TO CART</a>
        </div>

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