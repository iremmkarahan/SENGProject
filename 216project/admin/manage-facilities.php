<?php


include 'partials/header.php';

// fetch facilities from database
$query = "SELECT * FROM facilities ORDER BY title";
$facilities = mysqli_query($connection, $query);
?>

<section class="dashboard">
    <?php if (isset($_SESSION['add-facility-success'])) : ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-facility-success'];
                unset($_SESSION['add-facility-success']);
                ?>
            </p>
        </div>
    <?php endif ?>

    <?php if (isset($_SESSION['edit-facility-success'])) : ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-facility-success'];
                unset($_SESSION['edit-facility-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-facility'])) : ?>
         <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-facility'];
                unset($_SESSION['edit-facility']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-facility'])) : ?>
         <div class="alert__message error container">
            <p>
                <?= $_SESSION['delete-facility'];
                unset($_SESSION['delete-facility']);
                ?>
            </p>
        </div>
    <?php endif ?>

    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="add-booking.php"><i class="uil uil-user-plus"></i>
                        <h5>Add Booking</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-booking.php"><i class="uil uil-building"></i>
                        <h5>Manage Bookings</h5>
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
                            <h5>Manage User</h5>
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
                        <a href="manage-facilities.php"><i class="uil uil-building"></i>
                            <h5>Manage Facilities</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-room.php"><i class="uil uil-pen"></i>
                            <h5>Add Room</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-rooms.php" class="active"><i class="uil uil-postcard"></i>
                            <h5>Manage Rooms</h5>
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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($facility = mysqli_fetch_assoc($facilities)) : ?>
                            <tr>
                                <td><?= $facility['title'] ?></td>
                                <td><?= substr($facility['description'], 0, 50) ?>...</td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-facility.php?id=<?= $facility['id'] ?>" class="btn sm">Edit</a></td>
                                <td>
                                    <form action="<?= ROOT_URL ?>admin/delete-facility.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="delete" value="<?= $facility['id'] ?>">
                                        <button type="submit" class="btn sm danger" onclick="return confirm('Are you sure you want to delete this facility?')">Delete</button>
                                    </form>
                                </td>
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
