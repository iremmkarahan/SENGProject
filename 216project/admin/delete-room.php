<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch room from database in order to delete thumbnail from images folder
    $query = "SELECT * FROM rooms WHERE id=$id";
    $result = mysqli_query($connection, $query);

    // make sure only 1 record/room was fetched
    if (mysqli_num_rows($result) == 1) {
        $room = mysqli_fetch_assoc($result);
        $thumbnail_name = $room['thumbnail'];
        $thumbnail_path = '../images/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);

            // delete room from database
            $delete_room_query = "DELETE FROM rooms WHERE id=$id LIMIT 1";
            $delete_room_result = mysqli_query($connection, $delete_room_query);

            if (!mysqli_errno($connection)) {
                $_SESSION['delete-room-success'] = "Room deleted successfully";
            }
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-rooms.php');
die();
