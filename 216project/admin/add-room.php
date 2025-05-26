<?php
include 'partials/header.php';

// fetch categories from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

// get back form data if form was invalid
$title = $_SESSION['add-room-data']['title'] ?? null;
$body = $_SESSION['add-room-data']['body'] ?? null;

// delete form data session
unset($_SESSION['add-room-data']);
?>



<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Room</h2>
        <?php if (isset($_SESSION['add-room'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-room'];
                    unset($_SESSION['add-room']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-room-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea rows="10" name="body" placeholder="Body"><?= $body ?></textarea>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <div class="form__control inline">
                    <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                    <label for="is_featured">Featured</label>
                </div>
            <?php endif ?>
            <div class="form__control">
                <label for="thumbnail">Add Image</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Add Room</button>
        </form>
    </div>
</section>


<?php
include '../partials/footer.php';
?>
