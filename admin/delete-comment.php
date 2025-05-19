<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Delete comment from database
    $delete_comment_query = "DELETE FROM comments WHERE id=$id LIMIT 1";
    $delete_comment_result = mysqli_query($connection, $delete_comment_query);

    if (!mysqli_errno($connection)) {
        $_SESSION['delete-comment-success'] = "Comment deleted successfully";
    } else {
        $_SESSION['delete-comment'] = "Failed to delete comment.";
    }
}

header('location: ' . ROOT_URL . 'admin/manage-comments.php');
die(); 