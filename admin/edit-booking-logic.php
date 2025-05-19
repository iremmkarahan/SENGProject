<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    // get form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
    $room_id = filter_var($_POST['room_id'], FILTER_SANITIZE_NUMBER_INT);
    $check_in = filter_var($_POST['check_in'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $check_out = filter_var($_POST['check_out'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // validate form data
    if (!$id || !$user_id || !$room_id || !$check_in || !$check_out || !$status) {
        $_SESSION['edit-booking'] = "Please fill in all fields.";
    } else {
        // update booking in database
        $query = "UPDATE bookings SET user_id=$user_id, room_id=$room_id, check_in='$check_in', check_out='$check_out', status='$status' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            // redirect to manage bookings page with success message
            $_SESSION['edit-booking-success'] = "Booking updated successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-bookings.php');
            die();
        } else {
            $_SESSION['edit-booking'] = "Error updating booking: " . mysqli_error($connection);
        }
    }
}

// redirect back to edit booking page if there was an error
if (isset($_SESSION['edit-booking'])) {
    // Optionally store data for sticky form if needed, but for edits, fetching from DB is better
    // $_SESSION['edit-booking-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/edit-booking.php?id=' . $id);
    die();
}

// Redirect to manage page if accessed directly without submit (optional)
// header('location: ' . ROOT_URL . 'admin/manage-bookings.php');
// die();
