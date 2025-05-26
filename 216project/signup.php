<?php
require 'config/database.php'; // Includes database connection settings

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Get and sanitize form inputs
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    // Get avatar if it was uploaded
    $avatar = $_FILES['avatar'];

    // Validate inputs
    if (!$firstname) {
        $_SESSION['signup'] = "Please enter your first name";
    } elseif (!$lastname) {
        $_SESSION['signup'] = "Please enter your last name";
    } elseif (!$username) {
        $_SESSION['signup'] = "Please enter a username";
    } elseif (!$email) {
        $_SESSION['signup'] = "Please enter a valid email";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "Password must be at least 8 characters";
    } elseif (!$avatar['name']) {
        $_SESSION['signup'] = "Please upload an avatar";
    } else {
        // Check if passwords match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "Passwords do not match";
        } else {
            // Hash the password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            // Check for duplicate username or email
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Username or email already exists";
            } else {
                // Handle avatar upload
                $time = time(); // unique time-based filename
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

                // File extension validation
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $ext = explode('.', $avatar_name);
                $file_ext = end($ext);
                if (in_array($file_ext, $allowed_files)) {
                    // Check file size (max 1MB)
                    if ($avatar['size'] < 1000000) {
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['signup'] = "File size too big. Should be less than 1MB";
                    }
                } else {
                    $_SESSION['signup'] = "Invalid file type. Please upload PNG, JPG or JPEG";
                }
            }
        }
    }

    // If no error messages, insert new user into the database
    if (isset($_SESSION['signup'])) {
        // Save submitted data to session to refill the form
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-user.php');
        die();
    } else {
        // Insert user into database
        $insert_user_query = "INSERT INTO users SET 
                                firstname='$firstname', 
                                lastname='$lastname', 
                                username='$username', 
                                email='$email', 
                                password='$hashed_password', 
                                avatar='$avatar_name', 
                                is_admin=$is_admin";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {
            // Redirect on success
            $_SESSION['add-user-success'] = "New user $firstname $lastname added successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-users.php');
            die();
        }
    }
}
?>
