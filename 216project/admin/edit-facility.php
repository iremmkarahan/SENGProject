<?php
include 'partials/header.php';



if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM facilities WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $facility = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/');
    die();
}
?>



<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Facility</h2>
        <form action="<?= ROOT_URL ?>admin/edit-facility-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $facility['id'] ?>">
            <input type="text" name="title" value="<?= $facility['title'] ?>" placeholder="Title">
            <input type="text" name="description" value="<?= $facility['description'] ?>" placeholder="Description">
            
            <button type="submit" name="submit" class="btn">Update Facility</button>
        </form>
    </div>
</section>


<?php
include '../partials/footer.php';
?>