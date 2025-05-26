<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id'];
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $checkindate = filter_var($_POST['checkindate'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $checkoutdate = filter_var($_POST['checkoutdate'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);

    // set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;

    // validate form data
    if (!$firstname) {
        $_SESSION['add-booking'] = "Please enter your First Name";
    } elseif (!$lastname) {
        $_SESSION['add-booking'] = "Please enter your Last Name";
    } elseif (!$email) {
        $_SESSION['add-booking'] = "Please enter your a valid email";
    } 
    elseif (!$category_id) {
        $_SESSION['add-booking'] = "Select booking category";
    }
    elseif (!$checkindate) {
        $_SESSION['add-booking'] = "Choose check-in date";
    }
    elseif (!$checkoutdate) {
        $_SESSION['add-booking'] = "Choose check-out date";
    } else {
        // insert booking into database
        $query = "INSERT INTO booking (firstname, lastname, email, category_id, checkindate, checkoutdate, author_id, is_featured) VALUES ('$firstname', '$lastname', '$email', $category_id, '$checkindate', '$checkoutdate', $author_id, $is_featured)";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-booking-success'] = "New Booking added successfully";
            header('location: ' . ROOT_URL . 'admin/manage-booking.php');
            die();
        } else {
            $_SESSION['add-booking'] = "Error adding booking: " . mysqli_error($connection);
        }
    }

    // redirect back (with form data) to add-booking  if there is any problem
    if (isset($_SESSION['add-booking'])) {
        $_SESSION['add-booking-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-booking.php');
        die();
    }
}

header('location: ' . ROOT_URL . 'admin/add-booking.php');
die();
