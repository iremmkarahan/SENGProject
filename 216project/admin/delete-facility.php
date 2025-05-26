<?php
require 'config/database.php';
session_start(); // Required if you're setting session messages

// Check if delete request is sent via POST
if (isset($_POST['delete'])) {
    // Sanitize the facility ID
    $id = filter_var($_POST['delete'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch the facility to verify it exists (optional but good practice)
    $query = "SELECT * FROM facilities WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) === 1) {
        // Facility exists, now delete it
        $delete_facility_query = "DELETE FROM facilities WHERE id = $id LIMIT 1";
        $delete_facility_result = mysqli_query($connection, $delete_facility_query);

        if (!mysqli_errno($connection)) {
            // Success message
            $_SESSION['delete-facility-success'] = "Facility deleted successfully.";
        } else {
            // DB error occurred
            $_SESSION['delete-facility'] = "Failed to delete facility.";
        }
    } else {
        // Facility not found
        $_SESSION['delete-facility'] = "Facility does not exist.";
    }
} else {
    // Invalid access attempt
    $_SESSION['delete-facility'] = "Invalid request.";
}

// Redirect to manage facilities page
header('Location: ' . ROOT_URL . 'admin/manage-facilities.php');
exit();
?>