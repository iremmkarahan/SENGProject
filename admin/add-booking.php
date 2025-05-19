<?php
include 'partials/header.php';

// Fetch users and rooms from database to populate dropdowns
// Example: $users = mysqli_query($connection, "SELECT id, firstname, lastname FROM users");
// Example: $rooms = mysqli_query($connection, "SELECT id, room_number, type FROM rooms");
$users = []; // Placeholder - replace with actual database fetch
$rooms = []; // Placeholder - replace with actual database fetch

// Get back form data if form was invalid
$user_id = $_SESSION['add-booking-data']['user_id'] ?? null;
$room_id = $_SESSION['add-booking-data']['room_id'] ?? null;
$check_in = $_SESSION['add-booking-data']['check_in'] ?? null;
$check_out = $_SESSION['add-booking-data']['check_out'] ?? null;
$status = $_SESSION['add-booking-data']['status'] ?? null;

// Delete form data session
unset($_SESSION['add-booking-data']);

?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Booking</h2>
        <?php if (isset($_SESSION['add-booking'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-booking'];
                    unset($_SESSION['add-booking']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="add-booking-logic.php" method="POST">
            <select name="user_id" required>
                <option value="">Select User</option>
                <?php while ($user = mysqli_fetch_assoc($users)) : // Replace while with foreach if using array placeholder ?>
                    <option value="<?= $user['id'] ?>" <?= ($user_id == $user['id']) ? 'selected' : '' ?>><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></option>
                <?php endwhile; ?>
            </select>
            <select name="room_id" required>
                <option value="">Select Room</option>
                <?php while ($room = mysqli_fetch_assoc($rooms)) : // Replace while with foreach if using array placeholder ?>
                    <option value="<?= $room['id'] ?>" <?= ($room_id == $room['id']) ? 'selected' : '' ?>><?= htmlspecialchars('Room ' . $room['room_number'] . ' (' . $room['type'] . ')') ?></option>
                <?php endwhile; ?>
            </select>
            <input type="date" name="check_in" value="<?= $check_in ?>" required>
            <input type="date" name="check_out" value="<?= $check_out ?>" required>
            <select name="status" required>
                <option value="pending" <?= ($status == 'pending') ? 'selected' : '' ?>>Pending</option>
                <option value="confirmed" <?= ($status == 'confirmed') ? 'selected' : '' ?>>Confirmed</option>
                <option value="cancelled" <?= ($status == 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
            </select>
            <button type="submit" name="submit" class="btn">Add Booking</button>
        </form>
    </div>
</section>

<?php
include 'partials/footer.php';
?>
