<?php
include 'partials/header.php';

// fetch facilities from database
$query = "SELECT * FROM facilities ORDER BY name";
$facilities = mysqli_query($connection, $query);
?>



<section class="dashboard">
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="add-post.php"><i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php"><i class="uil uil-postcard"></i>
                        <h5>Manage Posts</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li>
                        <a href="add-user.php"><i class="uil uil-user-plus"></i>
                            <h5>Add User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage Users</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php"><i class="uil uil-edit"></i>
                            <h5>Add Category</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php"><i class="uil uil-list-ul"></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-facility.php"><i class="uil uil-plus"></i>
                            <h5>Add Facility</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-facilities.php" class="active"><i class="uil uil-building"></i>
                            <h5>Manage Facilities</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Facilities</h2>
            <?php if (mysqli_num_rows($facilities) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($facility = mysqli_fetch_assoc($facilities)) : ?>
                            <tr>
                                <td><?= $facility['name'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-facility.php?id=<?= $facility['id'] ?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-facility.php?id=<?= $facility['id'] ?>" class="btn sm danger">Delete</a></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No facilities found" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>


<?php
include '../partials/footer.php';
?> 