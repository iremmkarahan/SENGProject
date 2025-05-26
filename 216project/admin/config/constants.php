<?php
session_start();

// Your website’s base URL
define('ROOT_URL', 'http://hotelbookingweb.infinityfreeapp.com/');

// Database credentials (from InfinityFree)
define('DB_HOST', 'sql305.infinityfree.com');
define('DB_USER', 'if0_39084482');
define('DB_PASS', 'lwJcAzlIDB9SzA'); 
define('DB_NAME', 'if0_39084482_HotelBooking');

// Create database connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if (!$conn) {
    die(" Database connection failed: " . mysqli_connect_error());
}
?>