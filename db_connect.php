<?php
// session_start(); // Ensure this is at the top, before any output

// Enable error reporting for debugging (disable in production)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Docker MySQL connection settings
$host = "db"; // Service name from docker-compose.yml
$username = "root"; // Root user
$password = "9144"; // MySQL root password
$db_name = "payroll_management";

// Create connection
$conn = mysqli_connect($host, $username, $password, $db_name);

// Check connection
if (!$conn) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
