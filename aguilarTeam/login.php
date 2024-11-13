<?php
session_start(); // Start session at the top
include 'db_connect.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $stored_password);
        $stmt->fetch();

        // Directly compare the stored plain text password with the input password
        if ($password === $stored_password) {
            // Set session variable for the logged-in user
            $_SESSION["id"] = $user_id;
            
            // Redirect to the profile page
            header("Location: UserProfile.php");
            exit();
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "No account found with that email.";
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
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Customer Log-in</title>
</head>
<body>
    <div class="login-page">
        <div class="logo-container">
            <img src="images/logo.png" alt="Logo" class="logo">
        </div>
        <div class="login-page">
            <div class="form">
                <div class="login-label-container">
                    <label class="login-label">LOGIN</label>
                </div>
                <form class="login-form" action="login.php" method="POST">
                    <input type="email" name="email" placeholder="Email" required/>
                    <input type="password" name="password" placeholder="Password" required/>
                    <button type="submit">SUBMIT</button>
                    <p class="message">Not registered? <a href="register.php">Create an account</a></p>
                    <p class="message">Are you an Admin? <a href="AdminLogin.php">ADMIN</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
