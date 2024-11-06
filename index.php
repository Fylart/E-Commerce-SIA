<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Index.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <title>Document</title>
</head>
<body>
    <!-- header -->
    <header>
        <a href="#"><img src="images/logo.png" alt="" class="logo"></a>

        <ul class="navlist">
            <li><b><a href="index.php">home</a></b></li>
            <li><a href="new.php">new</a></li>
            <li><a href="makeup.php">makeup</a></li>
            <li><a href="skincare.php">skincare</a></li>
            <li><a href="allProducts.php">product</a></li>
            <li><a href="aboutus.php">about us</a></li>
        </ul>

        <div class="right-content">
            <a href="#"><img src="images/search.png" alt="" class="search"></a>
            <a href="#"><img src="images/profile.png" alt="" class="profile"></a>
            <a href="#"><img src="images/cart.png" alt="" class="cart1"></a>
        </div>
        </header>
    <!-- end of header -->
    <?php
    
    include("html/index.html");
    include("html/footer.html");
    ?>
</body>
</html> 