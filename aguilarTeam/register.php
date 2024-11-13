<?php
include 'db_connect.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password']; // No hashing applied

    $sql = "INSERT INTO users (firstName, lastName, address, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $firstName, $lastName, $address, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php"); //redirrect to login if registration is successful!
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <title>Register Account</title>
</head>
<body>
    <div class="login-page">
        <div class="logo-container">
            <img src="images/logo.png" alt="Logo" class="logo">
        </div>
        <div class="login-page">
            <div class="form">
                <div class="login-label-container">
                    <label class="login-label">CREATE ACCOUNT</label>
                </div>
                <form class="register-form" action="register.php" method="POST">
                    <input type="text" name="firstname" placeholder="First Name" required/>
                    <input type="text" name="lastname" placeholder="Last Name" required/>
                    <input type="text" name="address" placeholder="Address" required>
                    <input type="email" name="email" placeholder="Email" required/>
                    <input type="password" name="password" placeholder="Password" required/>
                    <button type="submit">SUBMIT</button>
                    <p class="message">Already registered? <a href="login.php">Sign In</a></p>
                    <p class="message">Are you an Admin? <a href="AdminLogin.php">ADMIN</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
