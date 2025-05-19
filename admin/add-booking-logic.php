<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    // get form data
    $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
    $room_id = filter_var($_POST['room_id'], FILTER_SANITIZE_NUMBER_INT);
    $check_in = filter_var($_POST['check_in'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $check_out = filter_var($_POST['check_out'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // validate form data
    if (!$user_id || !$room_id || !$check_in || !$check_out || !$status) {
        $_SESSION['add-booking'] = "Please fill in all fields.";
    } else {
        // insert booking into database
        $query = "INSERT INTO bookings (user_id, room_id, check_in, check_out, status) VALUES ($user_id, $room_id, '$check_in', '$check_out', '$status')";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            // redirect to manage bookings page with success message
            $_SESSION['add-booking-success'] = "Booking added successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-bookings.php');
            die();
        } else {
            $_SESSION['add-booking'] = "Error adding booking: " . mysqli_error($connection);
        }
    }
}

// redirect back to add booking page if there was an error
if (isset($_SESSION['add-booking'])) {
    $_SESSION['add-booking-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/add-booking.php');
    die();
}
