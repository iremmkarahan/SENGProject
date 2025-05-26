<?php
session_start(); // Start the session (must be done before modifying session data)

// Destroy all session data (logs the user out)
session_destroy();

// Redirect user to login page after logout
header('location: ' . ROOT_URL . 'signin.php');
die(); // Ensure script stops executing after redirection
?>
