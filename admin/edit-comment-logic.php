<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    // get form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // validate form data
    if (!$id || !$body) {
        $_SESSION['edit-comment'] = "Comment body cannot be empty.";
    } else {
        // update comment in database
        $query = "UPDATE comments SET body='$body' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            // redirect to manage comments page with success message
            $_SESSION['edit-comment-success'] = "Comment updated successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-comments.php');
            die();
        } else {
            $_SESSION['edit-comment'] = "Error updating comment: " . mysqli_error($connection);
        }
    }
}

// redirect back to edit comment page if there was an error (or to manage if no ID)
if (isset($_SESSION['edit-comment'])) {
     // Optionally store data for sticky form if needed, but for edits, fetching from DB is better
    // $_SESSION['edit-comment-data'] = $_POST;
     $id = $_POST['id'] ?? ''; // Get ID for redirection if available
     header('location: ' . ROOT_URL . 'admin/edit-comment.php?id=' . $id);
     die();
}

// Redirect to manage page if accessed directly without submit (optional)
// header('location: ' . ROOT_URL . 'admin/manage-comments.php');
// die(); 