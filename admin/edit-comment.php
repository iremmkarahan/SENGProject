<?php
include 'partials/header.php';

// Fetch comment data from database if id is set
$comment = null; // Placeholder - replace with actual database fetch
// Fetch post and user info for context (optional but good practice)
$post_title = ''; // Placeholder
$user_name = ''; // Placeholder

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // Example: $query = "SELECT c.*, u.firstname, u.lastname, p.title FROM comments c JOIN users u ON c.user_id = u.id JOIN posts p ON c.post_id = p.id WHERE c.id=$id";
    // Example: $result = mysqli_query($connection, $query);
    // Example: $comment = mysqli_fetch_assoc($result);
    
    // if ($comment) {
    //     $post_title = $comment['title'];
    //     $user_name = $comment['firstname'] . ' ' . $comment['lastname'];
    // }
}
// Redirect if comment not found or ID not set
// if (!$comment) {
//     header('location: ' . ROOT_URL . 'admin/manage-comments.php');
//     die();
// }

?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Comment</h2>
        <?php if ($post_title || $user_name): ?>
             <p>Editing comment on post: <strong><?= htmlspecialchars($post_title) ?></strong> by user: <strong><?= htmlspecialchars($user_name) ?></strong></p>
        <?php endif; ?>
       
        <form action="edit-comment-logic.php" method="POST">
            <input type="hidden" name="id" value="<?= $comment['id'] ?? '' ?>">
            <textarea name="body" rows="4" placeholder="Comment Body" required><?= $comment['body'] ?? '' ?></textarea>
            <button type="submit" name="submit" class="btn">Update Comment</button>
        </form>
    </div>
</section>

<?php
include 'partials/footer.php';
?> 