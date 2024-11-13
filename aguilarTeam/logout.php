<?php
// Start session
session_start();

// Include database connection if needed for logout actions
require 'db_connect.php';

// Clear all session data
$_SESSION = [];
session_unset(); // Unset session variables
session_destroy(); // Destroy the session

// Redirect to login page
header("Location: login.php");
exit(); // Ensure no further code is executed after redirection
?>
