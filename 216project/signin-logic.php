<?php
require 'config/database.php';
session_start(); // Start the session (needed for using $_SESSION variables)

// Check if form was submitted
if (isset($_POST['submit'])) {
    // Sanitize form input values
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validate form inputs
    if (!$username_email) {
        $_SESSION['signin'] = "Username or Email required";
    } elseif (!$password) {
        $_SESSION['signin'] = "Password required";
    } else {
        // Query to find user by username or email
        $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        // If a user is found
        if ($fetch_user_result && mysqli_num_rows($fetch_user_result) == 1) {
            $user_record = mysqli_fetch_assoc($fetch_user_result); // Get user data
            $db_password = $user_record['password']; // Get hashed password from DB

            // Verify entered password against hashed password
            if (password_verify($password, $db_password)) {
                // Password is correct, set session user ID
                $_SESSION['user-id'] = $user_record['id'];

                // If user is admin, set admin session flag
                if (!empty($user_record['is_admin']) && $user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }

                // Redirect to admin dashboard
                header('Location: ' . ROOT_URL . 'admin/');
                exit();
            } else {
                // Password didn't match
                $_SESSION['signin'] = "Incorrect password";
            }
        } else {
            // No user found with given username/email
            $_SESSION['signin'] = "User not found";
        }
    }

    // If validation or login fails, store entered data and redirect back to sign-in page
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST; // Store form data to prefill form
        header('Location: ' . ROOT_URL . 'signin.php');
        exit();
    }
} else {
    // If accessed without submitting form, redirect to sign-in page
    header('Location: ' . ROOT_URL . 'signin.php');
    exit();
}
?>
