<?php
require '../config/database.php';

if (isset($_POST['add_facility'])) {
    // Get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $icon = filter_var($_POST['icon'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Assuming icon is a path/filename

    // Validate input
    if (!$title) {
        $_SESSION['add-facility'] = "Please enter a facility title.";
    } elseif (!$description) {
        $_SESSION['add-facility'] = "Please enter a description.";
    } elseif (!$icon) {
         $_SESSION['add-facility'] = "Please provide an icon path.";
    } else {
        // Insert facility into database
        $query = "INSERT INTO facilities (title, description, icon) VALUES ('$title', '$description', '$icon')";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-facility-success'] = "Facility added successfully.";
        } else {
            $_SESSION['add-facility'] = "Error adding facility: " . mysqli_error($connection);
        }
    }

    // Redirect back to facilities page (or manage page if you create one)
    header('location: ' . ROOT_URL . 'facilities.php');
    die();

} else {
    // If accessed directly, redirect to facilities page
    header('location: ' . ROOT_URL . 'facilities.php');
    die();
}
