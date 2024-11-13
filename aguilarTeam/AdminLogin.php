<?php
$host = "localhost"; // Database configuration
$user = "root";
$password = "";
$db = "user";

session_start(); // Start a session

$data = mysqli_connect($host, $user, $password, $db); // Connect to the database


if ($data === false) {
    die("Connection error"); // Check if the connection was successful
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["email"]; // Retrieve the email and password from the form submission
    $password = $_POST["password"];

    $sql = "SELECT * FROM login WHERE email='$username' AND password='$password'"; // Query the database to check if the entered email and password match an admin user
    $result = mysqli_query($data, $sql);
    $row = mysqli_fetch_array($result);

    if ($row && $row["email"] == "admin@admin.com" && $row["password"] == "admin123") {
        $_SESSION["email"] = $username;
        header("Location: homeAdmin.php");
        exit();
    } else {
        echo "Username or password incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Admin Log-in</title>
</head>
<body>
    <div class="login-page">
        <div class="logo-container">
            <img src="images/logo.png" alt="Logo" class="logo"> <!--LOGO HERE-->
        </div>
        <div class="login-page">
            <div class="form">
                <div class="login-label-container">
                    <label class="login-label">ADMIN LOGIN</label>
                </div>
                <div class="login-label-container">
                    <a class="subtitle-label">Enter your email and password</a>
                </div>

                <form class="login-form" action="AdminLogin.php" method="POST"> 
                    <input type="email" name="email" placeholder="Email" required /> <!--email-->
                    <input type="password" name="password" placeholder="Password" required /> <!--users password-->
                    <button type="submit">SUBMIT</button>
                    <p class="message">Want to Register as User? <a href="register.php">Create an account</a></p>
                    <p class="message">Have Users Account Already? <a href="login.php">Sign In</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
