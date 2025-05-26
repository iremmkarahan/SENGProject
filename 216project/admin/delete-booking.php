<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch booking from database in order to delete thumbnail from images folder
    $current_user_id = $_SESSION['user-id'];
    $query = "SELECT * FROM booking WHERE id=$id AND author_id=$current_user_id";
    $result = mysqli_query($connection, $query);

    // make sure only 1 record was fetched
    if (mysqli_num_rows($result) == 1) {
        $booking = mysqli_fetch_assoc($result);

      
            

            // delete booking from database
            $delete_booking_query = "DELETE FROM booking WHERE id=$id LIMIT 1";
            $delete_booking_result = mysqli_query($connection, $delete_booking_query);

            if (!mysqli_errno($connection)) {
                $_SESSION['delete-booking-success'] = "Booking deleted successfully";
            } else {
                $_SESSION['delete-booking'] = "Failed to delete booking.";
            }
       
    }
}

header('location: ' . ROOT_URL . 'admin/manage-booking.php');
die();
