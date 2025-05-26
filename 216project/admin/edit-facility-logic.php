<?php
require 'config/database.php';

// make sure edit facility button was clicked
if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   
    // Validate input values
    if (!$title) {
        $_SESSION['edit-facility'] = "Please enter a title.";
    } elseif (!$description) {
        $_SESSION['edit-facility'] = "Please enter a description.";
    }

    // Redirect back to edit page if there was any error
    if (isset($_SESSION['edit-facility'])) {
        header('location: ' . ROOT_URL . 'admin/edit-facility.php?id=' . $id);
        die();
    } else {
        // Update facility in database
        $query = "UPDATE facilities SET title='$title', description='$description' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-facility'] = "Failed to update facility: " . mysqli_error($connection);
            // Redirect back to edit page on database error
            header('location: ' . ROOT_URL . 'admin/edit-facility.php?id=' . $id);
            die();
        } else {
            $_SESSION['edit-facility-success'] = "Facility updated successfully";
            // Redirect to manage facilities page on success
            header('location: ' . ROOT_URL . 'admin/manage-facilities.php');
            die();
        }
    }
} else {
    // If the button was not clicked, redirect to manage facilities page
    header('location: ' . ROOT_URL . 'admin/manage-facilities.php');
    die();
}
