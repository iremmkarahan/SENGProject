<?php
include 'partials/header.php';
?>

<section class="dashboard">
    <div class="container dashboard__container">
        <aside>
            <ul>
                <li>
                    <a href="add-booking.php"><i class="uil uil-pen"></i>
                        <h5>Add Booking</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-booking.php"><i class="uil uil-postcard"></i>
                        <h5>Manage Bookings</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li>
                        <a href="add-room.php"><i class="uil uil-pen"></i>
                            <h5>Add Room</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-rooms.php"><i class="uil uil-postcard"></i>
                            <h5>Manage Rooms</h5>
                        </a>
                    </li>
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
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Admin Dashboard</h2>
            
        </main>
    </div>
</section>

<?php
include '../partials/footer.php';
?> <?php
include 'partials/header.php';
?>

<section class="dashboard">
    <div class="container dashboard__container">
        <aside>
            <ul>
                <li>
                    <a href="add-booking.php"><i class="uil uil-pen"></i>
                        <h5>Add Booking</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-booking.php"><i class="uil uil-postcard"></i>
                        <h5>Manage Bookings</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li>
                        <a href="add-room.php"><i class="uil uil-pen"></i>
                            <h5>Add Room</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-rooms.php"><i class="uil uil-postcard"></i>
                            <h5>Manage Rooms</h5>
                        </a>
                    </li>
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
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Admin Dashboard</h2>
            
        </main>
    </div>
</section>

<?php
include '../partials/footer.php';
?> 