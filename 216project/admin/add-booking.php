<?php
include 'partials/header.php';

// fetch categories from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

// get back form data if form was invalid
$firstname = $_SESSION['add-booking-data']['firstname'] ?? null;
$lastname = $_SESSION['add-booking-data']['lastname'] ?? null;
$email = $_SESSION['add-booking-data']['email'] ?? null;
$checkindate = $_SESSION['add-booking-data']['checkindate'] ?? null;
$checkoutdate = $_SESSION['add-booking-data']['checkoutdate'] ?? null;

// delete form data session
unset($_SESSION['add-booking-data']);
?>



<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Booking</h2>
        <?php if (isset($_SESSION['add-booking'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-booking'];
                    unset($_SESSION['add-booking']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-booking-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="First Name">
            <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name">
            <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <input type="date" name="checkindate" value="<?= $checkindate ?>" placeholder="Check-in Date">
            <input type="date" name="checkoutdate" value="<?= $checkoutdate ?>" placeholder="Check-out Date">
    
    
            <button type="submit" name="submit" class="btn">Add Booking</button>
        </form>
    </div>
</section>


<?php
include '../partials/footer.php';
?>
