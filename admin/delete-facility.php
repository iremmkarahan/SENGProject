<?php
require 'config/database.php';

if (isset($_GET['delete'])) {
    $id = filter_var($_GET['delete'], FILTER_SANITIZE_NUMBER_INT);

    // Delete facility from database
    $delete_facility_query = "DELETE FROM facilities WHERE id=$id LIMIT 1";
    $delete_facility_result = mysqli_query($connection, $delete_facility_query);

    if (!mysqli_errno($connection)) {
        $_SESSION['delete-facility-success'] = "Facility deleted successfully";
    } else {
        $_SESSION['delete-facility'] = "Failed to delete facility.";
    }
}

// Redirect back to facilities page
header('location: ' . ROOT_URL . 'facilities.php');
die();
