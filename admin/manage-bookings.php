<?php
include 'partials/header.php';

// Fetch all bookings from the database (join with users and rooms to display names/numbers)
// Example: $bookings = mysqli_query($connection, "SELECT b.*, u.firstname, u.lastname, r.room_number FROM bookings b JOIN users u ON b.user_id = u.id JOIN rooms r ON b.room_id = r.id ORDER BY b.created_at DESC");
$bookings = []; // Placeholder - replace with actual database fetch

?>

<section class="dashboard">
    <div class="container dashboard__container">
        <!-- Sidebar Goes Here (similar to manage-users.php) -->
        <aside>
            <ul>
                 <li><a href="add-post.php"><i class="uil uil-pen"></i><h5>Add Post</h5></a></li>
                 <li><a href="index.php"><i class="uil uil-postcard"></i><h5>Manage Posts</h5></a></li>
                 <?php if(isset($_SESSION['user_is_admin'])): ?>
                 <li><a href="add-user.php"><i class="uil uil-user-plus"></i><h5>Add User</h5></a></li>
                 <li><a href="manage-users.php"><i class="uil uil-users-alt"></i><h5>Manage User</h5></a></li>
                 <li><a href="add-category.php"><i class="uil uil-edit"></i><h5>Add Category</h5></a></li>
                 <li><a href="manage-categories.php"><i class="uil uil-list-ul"></i><h5>Manage Categories</h5></a></li>
                 <li><a href="manage-bookings.php" class="active"><i class="uil uil-book-open"></i><h5>Manage Bookings</h5></a></li>
                 <li><a href="manage-reviews.php"><i class="uil uil-comment-alt-dots"></i><h5>Manage Reviews</h5></a></li>
                 <li><a href="manage-rooms.php"><i class="uil uil-building"></i><h5>Manage Rooms</h5></a></li>
                 <?php endif ?>
            </ul>
        </aside>

        <main>
            <h2>Manage Bookings</h2>
            <?php if (empty($bookings)) : ?>
                <div class="alert__message error"><p>No bookings found.</p></div>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>User</th>
                            <th>Room</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($booking = mysqli_fetch_assoc($bookings)) : // Replace while loop with foreach if using array placeholder ?>
                            <tr>
                                <td><?= htmlspecialchars($booking['id']) ?></td>
                                <td><?= htmlspecialchars($booking['firstname'] ?? '') . ' ' . htmlspecialchars($booking['lastname'] ?? '') ?></td> <?php // Assumes join with users table ?>
                                <td><?= htmlspecialchars($booking['room_number'] ?? '') ?></td> <?php // Assumes join with rooms table ?>
                                <td><?= htmlspecialchars($booking['check_in']) ?></td>
                                <td><?= htmlspecialchars($booking['check_out']) ?></td>
                                <td><?= htmlspecialchars(ucfirst($booking['status'])) ?></td>
                                <td>
                                    <a href="edit-booking.php?id=<?= $booking['id'] ?>" class="btn sm">Edit</a>
                                    <a href="delete-booking.php?id=<?= $booking['id'] ?>" class="btn sm danger" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </main>
    </div>
</section>

<?php
include 'partials/footer.php';
?> 