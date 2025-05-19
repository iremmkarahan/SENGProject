<?php
// ... existing header include and post fetching logic ...

// Assuming the post content is displayed here.
// FIND THE END OF YOUR POST CONTENT SECTION AND INSERT THE COMMENTS SECTION AFTER IT.
// For example, if your post content ends with a closing article or div tag, place the comments section after it.

?>

<!-- ============================================================================== COMMENTS SECTION ================================================================================== -->
<section class="comments__section">
    <div class="container comments__container">
        <h3>Comments</h3>

        <!-- Comment Form -->
        <?php if (isset($_SESSION['user-id'])) : // Show form only if user is logged in ?>
        <div class="comment__form">
            <h4>Leave a Comment</h4>
            <?php if (isset($_SESSION['add-comment'])) : ?>
                <div class="alert__message error">
                    <p><?= $_SESSION['add-comment']; unset($_SESSION['add-comment']); ?></p>
                </div>
            <?php elseif (isset($_SESSION['add-comment-success'])) : ?>
                 <div class="alert__message success">
                    <p><?= $_SESSION['add-comment-success']; unset($_SESSION['add-comment-success']); ?></p>
                </div>
            <?php endif; ?>
            <form action="add-comment-logic.php" method="POST">
                <input type="hidden" name="post_id" value="<?= $post['id'] ?? '' ?>"> <?php // Pass post ID ?>
                <textarea name="body" rows="4" placeholder="Your Comment" required></textarea>
                <button type="submit" name="submit" class="btn sm">Post Comment</button>
            </form>
        </div>
        <?php else : ?>
             <div class="alert__message error"><p>Please log in to leave a comment.</p></div>
        <?php endif; ?>

        <!-- Display Existing Comments -->
        <div class="comments__display">
            <?php
            // Fetch comments for this post
            // Example: $comments_query = "SELECT c.*, u.firstname, u.lastname FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = " . ($post['id'] ?? 0) . " ORDER BY c.created_at DESC";
            // Example: $comments_result = mysqli_query($connection, $comments_query);
            $comments = []; // Placeholder - Replace with actual database fetch
            ?>
            
            <?php if (empty($comments)) : ?>
                 <p>No comments yet. Be the first to comment!</p>
            <?php else : ?>
                <?php while($comment = mysqli_fetch_assoc($comments)) : // Replace while with foreach if using array placeholder ?>
                    <div class="comment">
                         <div class="comment__author-avatar">
                            <!-- User Avatar - Assuming you have avatar data in users table -->
                            <img src="<?= ROOT_URL . 'images/' . ($comment['avatar'] ?? 'default-avatar.jpg') ?>">
                         </div>
                        <div class="comment__details">
                            <h5><?= htmlspecialchars($comment['firstname'] ?? '') . ' ' . htmlspecialchars($comment['lastname'] ?? '') ?></h5>
                            <small><?= date("M d, Y - H:i", strtotime($comment['created_at'])) ?></small>
                            <p><?= htmlspecialchars($comment['body']) ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
// ... existing footer include ...
?> 