<?php
require '../config/database.php';

if (isset($_POST['edit_facility'])) {
    // Get form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $icon = filter_var($_POST['icon'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validate input
    if (!$id || !$title || !$description || !$icon) {
        $_SESSION['edit-facility'] = "Invalid input or missing data.";
    } else {
        // Update facility in database
        $query = "UPDATE facilities SET title='$title', description='$description', icon='$icon' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-facility-success'] = "Facility updated successfully.";
        } else {
            $_SESSION['edit-facility'] = "Error updating facility: " . mysqli_error($connection);
        }
    }

    // Redirect back to facilities page (or manage page)
    header('location: ' . ROOT_URL . 'facilities.php');
    die();

} else {
    // If accessed directly, redirect to facilities page
    header('location: ' . ROOT_URL . 'facilities.php');
    die();
}
