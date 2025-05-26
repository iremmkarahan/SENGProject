<?php
include 'partials/header.php';

// fetch categories from database
$category_query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $category_query);


// fetch room data from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM booking WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $booking = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/');
    die();
}
?>



<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Booking</h2>
        <form action="<?= ROOT_URL ?>admin/edit-booking-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $booking['id'] ?>">
            <input type="text" name="firstname" value="<?= $booking['firstname'] ?>" placeholder="First Name">
            <input type="text" name="lastname" value="<?= $booking['lastname'] ?>" placeholder="Last Name">
            <input type="email" name="email" value="<?= $booking['email'] ?>" placeholder="Email">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $booking['category_id'] ? 'selected' : '' ?>><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <input type="date" name="checkindate" value="<?= $booking['checkindate'] ?>" placeholder="Check-in Date">
            <input type="date" name="checkoutdate" value="<?= $booking['checkoutdate'] ?>" placeholder="Check-out Date">
        
        
            <button type="submit" name="submit" class="btn">Update Booking</button>
        </form>
    </div>
</section>


<?php
include '../partials/footer.php';
?>