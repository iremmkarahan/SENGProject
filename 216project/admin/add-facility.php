<?php
include 'partials/header.php';

// get back form data if there was an error
$name = $_SESSION['add-facility-data']['name'] ?? null;

// delete add-facility-data session
unset($_SESSION['add-facility-data']);
?>


<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Facility</h2>
        <?php if (isset($_SESSION['add-facility'])): ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-facility'];
                    unset($_SESSION['add-facility']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-facility-logic.php" method="POST">
            <input type="text" name="title" placeholder="Facility Title">
            <textarea rows="10" name="description" placeholder="Facility Description"></textarea>
            <button type="submit" name="submit" class="btn">Add Facility</button>
        </form>
    </div>
</section>


<?php
include '../partials/footer.php';
?>
