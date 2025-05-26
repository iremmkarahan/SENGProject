<?php
require 'config/database.php';

// make sure edit booking button was clicked
if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
   
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $checkindate = filter_var($_POST['checkindate'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $checkoutdate = filter_var($_POST['checkoutdate'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
   

    // set is_featured to 0 if it was unchecked
    $is_featured = $is_featured == 1 ?: 0;

    // check and validate input values
    if (!$firstname) {
        $_SESSION['edit-booking'] = "Please enter your First Name";
    } elseif (!$lastname) {
        $_SESSION['edit-booking'] = "Please enter your Last Name";
    } elseif (!$email) {
        $_SESSION['edit-booking'] = "Please enter your a valid email";
    } elseif (!$category_id) {
        $_SESSION['edit-booking'] = "Select booking category";
    } elseif (!$checkindate) {
        $_SESSION['edit-booking'] = "Choose check-in date";
    } elseif (!$checkoutdate) {
        $_SESSION['edit-booking'] = "Choose check-out date";
    } else {
    
        // get current user id and fetch booking from database
        $current_user_id = $_SESSION['user-id'];
        $query = "SELECT * FROM booking WHERE id=$id AND author_id=$current_user_id";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 1) {
            // set is_featured of all bookings to 0 if is_featured for this booking is 1
            if ($is_featured == 1) {
                $zero_all_is_featured_query = "UPDATE booking SET is_featured=0";
                $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
            }

            // update booking in database
            $query = "UPDATE booking SET firstname='$firstname', lastname='$lastname', email='$email', category_id=$category_id, checkindate='$checkindate', checkoutdate='$checkoutdate', is_featured=$is_featured WHERE id=$id LIMIT 1";
            $result = mysqli_query($connection, $query);

            if (!mysqli_errno($connection)) {
                $_SESSION['edit-booking-success'] = "Booking updated successfully";
            } else {
                $_SESSION['edit-booking'] = "Failed to update booking.";
            }
        } else {
             $_SESSION['edit-booking'] = "Booking not found or you don't have permission to edit it.";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/');
die();
