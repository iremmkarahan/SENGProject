<?php
require_once 'config/connect.php'; // Include database connection file

header('Content-Type: application/json'); // Set response type to JSON

// Get raw POST JSON data and decode it into a PHP array
$data = json_decode(file_get_contents('php://input'), true);

// If data was received
if ($data) {
    // Sanitize input to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $data['name']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $subject = mysqli_real_escape_string($conn, $data['subject']);
    $message = mysqli_real_escape_string($conn, $data['message']);
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode([
            'success' => false,
            'message' => 'All fields are required'
        ]);
        exit(); // Stop script if any field is empty
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email format'
        ]);
        exit(); // Stop script on invalid email
    }
    
    // Insert validated data into 'messages' table
    $query = "INSERT INTO messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    
    // Check if query was successful
    if (mysqli_query($conn, $query)) {
        echo json_encode([
            'success' => true,
            'message' => 'Message sent successfully!'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to send message. Please try again.'
        ]);
    }
} else {
    // If no data received in the request
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
}
