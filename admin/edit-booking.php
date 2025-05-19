<?php
include 'partials/header.php';

// Fetch users and rooms from database to populate dropdowns
// Example: $users = mysqli_query($connection, "SELECT id, firstname, lastname FROM users");
// Example: $rooms = mysqli_query($connection, "SELECT id, room_number, type FROM rooms");
$users = []; // Placeholder - replace with actual database fetch
$rooms = []; // Placeholder - replace with actual database fetch

// Fetch booking data from database if id is set
$booking = null; // Placeholder - replace with actual database fetch
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // Example: $query = "SELECT * FROM bookings WHERE id=$id";
    // Example: $result = mysqli_query($connection, $query);
    // Example: $booking = mysqli_fetch_assoc($result);
} 
// Redirect if booking not found or ID not set
// if (!$booking) {
//     header('location: ' . ROOT_URL . 'admin/manage-bookings.php');
//     die();
// }

?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Booking</h2>
        <form action="edit-booking-logic.php" method="POST">
            <input type="hidden" name="id" value="<?= $booking['id'] ?? '' ?>">
            <select name="user_id" required>
                <option value="">Select User</option>
                <?php while ($user = mysqli_fetch_assoc($users)) : // Replace while with foreach if using array placeholder ?>
                    <option value="<?= $user['id'] ?>" <?= (isset($booking['user_id']) && $booking['user_id'] == $user['id']) ? 'selected' : '' ?>><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></option>
                <?php endwhile; ?>
            </select>
            <select name="room_id" required>
                <option value="">Select Room</option>
                <?php while ($room = mysqli_fetch_assoc($rooms)) : // Replace while with foreach if using array placeholder ?>
                    <option value="<?= $room['id'] ?>" <?= (isset($booking['room_id']) && $booking['room_id'] == $room['id']) ? 'selected' : '' ?>><?= htmlspecialchars('Room ' . $room['room_number'] . ' (' . $room['type'] . ')') ?></option>
                <?php endwhile; ?>
            </select>
            <input type="date" name="check_in" value="<?= $booking['check_in'] ?? '' ?>" required>
            <input type="date" name="check_out" value="<?= $booking['check_out'] ?? '' ?>" required>
            <select name="status" required>
                <option value="pending" <?= (isset($booking['status']) && $booking['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                <option value="confirmed" <?= (isset($booking['status']) && $booking['status'] == 'confirmed') ? 'selected' : '' ?>>Confirmed</option>
                <option value="cancelled" <?= (isset($booking['status']) && $booking['status'] == 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
            </select>
            <button type="submit" name="submit" class="btn">Update Booking</button>
        </form>
    </div>
</section>

<?php
include 'partials/footer.php';
?>
