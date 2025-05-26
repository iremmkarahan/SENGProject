<?php
include 'partials/header.php'; // Include the header partial (navigation, styles, etc.)

// Check if 'id' is present in URL and fetch room data from database
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT); // Sanitize ID from query string
    $query = "SELECT * FROM rooms WHERE id=$id"; // Query to get room by ID
    $result = mysqli_query($connection, $query); // Execute query
    $room = mysqli_fetch_assoc($result); // Fetch room data as associative array
} else {
    // Redirect to home if no ID provided
    header('location: ' . ROOT_URL . 'home.php');
    die();
}
?>

<!-- ====================== SINGLE ROOM SECTION ====================== -->
<section class="singlepost">
    <div class="container singlepost__container">
        <!-- Room title -->
        <h2><?= $room['title'] ?></h2>

        <div class="post__author">
            <?php
            // Get author information from users table using author_id from the room
            $author_id = $room['author_id'];
            $author_query = "SELECT * FROM users WHERE id=$author_id";
            $author_result = mysqli_query($connection, $author_query);
            $author = mysqli_fetch_assoc($author_result);
            ?>
            <div class="post__author-avatar">
                <!-- Display author's avatar -->
                <img src="./images/<?= $author['avatar'] ?>">
            </div>
            <div class="post__author-info">
                <!-- Display author full name -->
                <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                <!-- Display formatted post date and time -->
                <small>
                    <?= date("M d, Y - H:i", strtotime($room['date_time'])) ?>
                </small>
            </div>
        </div>

        <!-- Room thumbnail -->
        <div class="singlepost__thumbnail">
            <img src="./images/<?= $room['thumbnail'] ?>">
        </div>

        <!-- Room description/body -->
        <p>
            <?= $room['body'] ?>
        </p>
    </div>
</section>
<!-- ====================== END OF SINGLE ROOM SECTION ====================== -->

<?php
include 'partials/footer.php'; // Include footer partial
?>
