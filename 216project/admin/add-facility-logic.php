<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    // Get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validate input
    if (!$title) {
        $_SESSION['add-facility'] = "Please enter a facility title.";
    } elseif (!$description) {
        $_SESSION['add-facility'] = "Please enter a description.";
    } else {
        // Insert facility into database
        $query = "INSERT INTO facilities (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-facility-success'] = "Facility added successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-facilities.php');
            die();
        } else {
            $_SESSION['add-facility'] = "Error adding facility: " . mysqli_error($connection);
        }
    }

    // If there was an error, redirect back to add facility page
    if (isset($_SESSION['add-facility'])) {
        header('location: ' . ROOT_URL . 'admin/add-facility.php');
    die();
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add-facility.php');
    die();
}
