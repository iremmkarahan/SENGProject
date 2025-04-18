<?php
session_start();  // Start a session to store user data after login

// Include the database connection file
require 'db.php';  // Make sure db.php exists and is correctly set up

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username); // "s" means string type
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // Fetch the user data as an associative array

    // Check if user exists and the password matches
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, login successful
        $_SESSION['user_id'] = $user['id']; // Store user ID in the session
        $_SESSION['username'] = $user['username']; // Store username in the session

        // Redirect to homepage or dashboard
        header("Location: index.html");
        exit();
    } else {
        // Invalid credentials
        echo "<p style='color: red;'>Invalid username or password.</p>";
    }
}
?>