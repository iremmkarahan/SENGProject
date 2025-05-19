<?php
include 'partials/header.php';

// fetch facility from database
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM facilities WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $facility = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/manage-facilities.php');
    die();
}
?>


<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Facility</h2>
        <form action="<?= ROOT_URL ?>admin/edit-facilities-logic.php" method="POST">
            <input type="hidden" name="id" value="<?= $facility['id'] ?>">
            <input type="text" name="name" value="<?= $facility['name'] ?>" placeholder="Facility Name">
            <button type="submit" name="submit" class="btn">Update Facility</button>
        </form>
    </div>
</section>


<?php
include '../partials/footer.php';
?> 