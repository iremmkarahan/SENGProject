<?php

require_once 'config/database.php';
include 'partials/header.php';

// fetch bookings from database for the current user
$current_user_id = $_SESSION['user-id'];
$query = "SELECT * FROM booking WHERE author_id = $current_user_id ORDER BY checkindate DESC";
$booking = mysqli_query($connection, $query);
?>

<section class="dashboard">
    <?php if (isset($_SESSION['add-booking-success'])) : ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-booking-success'];
                unset($_SESSION['add-booking-success']);
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
            <h2>Manage Bookings</h2>
            <?php if (mysqli_num_rows($booking) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Checkin Date</th>
                            <th>Checkout Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($individual_booking = mysqli_fetch_assoc($booking)) : ?>
                            <tr>
                                <td><?= $individual_booking['firstname'] ?> <?= $individual_booking['lastname'] ?></td>
                                <td><?= $individual_booking['email'] ?></td>
                                <td><?= $individual_booking['checkindate'] ?></td>
                                <td><?= $individual_booking['checkoutdate'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-booking.php?id=<?= $individual_booking['id'] ?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-booking.php?id=<?= $individual_booking['id'] ?>" class="btn sm danger" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No bookings found" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>

<?php
include '../partials/footer.php';
?> 
