<?php
require 'config/database.php'; // Include database connection

// Check if signup form was submitted
if (isset($_POST['submit'])) {
    // Sanitize and validate input data from form
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar']; // Uploaded file from form
    $is_admin = filter_var($_POST['is_admin_signup'] ?? 0, FILTER_SANITIZE_NUMBER_INT); // Optional admin flag

    // Input validations
    if (!$firstname) {
        $_SESSION['signup'] = "Please enter your First Name";
    } elseif (!$lastname) {
        $_SESSION['signup'] = "Please enter your Last Name";
    } elseif (!$username) {
        $_SESSION['signup'] = "Please enter your Username";
    } elseif (!$email) {
        $_SESSION['signup'] = "Please enter your a valid email";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "Password should be 8+ characters";
    } elseif (!$avatar['name']) {
        $_SESSION['signup'] = "Please add avatar";
    } else {
        // Passwords must match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "Passwords do not match";
        } else {
            // Encrypt password securely
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            // Check for duplicate username or email
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Username or Email already exist";
            } else {
                // Handle avatar upload
                $time = time(); // Timestamp for unique filename
                $avatar_name = $time . $avatar['name']; // New filename
                $avatar_tmp_name = $avatar['tmp_name']; // Temporary path
                $avatar_destination_path = 'images/' . $avatar_name; // Final upload path

                // Validate file extension
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name); // Split filename
                $extention = end($extention); // Get extension
                if (in_array($extention, $allowed_files)) {
                    // Validate file size (must be < 1MB)
                    if ($avatar['size'] < 1000000) {
                        // Upload file to server
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['signup'] = "File size too big. Should be less than 1mb";
                    }
                } else {
                    $_SESSION['signup'] = "File should be png, jpg, or jpeg";
                }
            }
        }
    }

    // If there was an error, redirect back with form data
    if (isset($_SESSION['signup'])) {
        $_SESSION['signup-data'] = $_POST; // Save form data to refill on error
        header('location: ' . ROOT_URL . 'signup.php'); // Redirect to signup
        die();
    } else {
        // Insert new user into database
        $insert_user_query = "INSERT INTO users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=$is_admin";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        // On success, redirect to login page
        if (!mysqli_errno($connection)) {
            $_SESSION['signup-success'] = "Registration successful. Please log in";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    }
} else {
    // If accessed without form submission, redirect to signup page
    header('location: ' . ROOT_URL . 'signup.php');
    exit();
}
?>
