<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Delete booking from database
    $delete_booking_query = "DELETE FROM bookings WHERE id=$id LIMIT 1";
    $delete_booking_result = mysqli_query($connection, $delete_booking_query);

    if (!mysqli_errno($connection)) {
        $_SESSION['delete-booking-success'] = "Booking deleted successfully";
    } else {
        $_SESSION['delete-booking'] = "Failed to delete booking.";
    }
}

header('location: ' . ROOT_URL . 'admin/manage-bookings.php');
die();
