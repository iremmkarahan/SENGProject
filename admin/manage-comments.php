<?php
include 'partials/header.php';

// Fetch all comments from the database (join with users and posts to display names/titles)
// Example: $comments = mysqli_query($connection, "SELECT c.*, u.firstname, u.lastname, p.title FROM comments c JOIN users u ON c.user_id = u.id JOIN posts p ON c.post_id = p.id ORDER BY c.created_at DESC");
$comments = []; // Placeholder - replace with actual database fetch

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
                 <li><a href="manage-bookings.php"><i class="uil uil-book-open"></i><h5>Manage Bookings</h5></a></li>
                 <li><a href="manage-reviews.php"><i class="uil uil-comment-alt-dots"></i><h5>Manage Reviews</h5></a></li>
                 <li><a href="manage-rooms.php"><i class="uil uil-building"></i><h5>Manage Rooms</h5></a></li>
                 <li><a href="manage-comments.php" class="active"><i class="uil uil-comment"></i><h5>Manage Comments</h5></a></li>
                 <?php endif ?>
            </ul>
        </aside>

        <main>
            <h2>Manage Comments</h2>
            <?php if (empty($comments)) : ?>
                <div class="alert__message error"><p>No comments found.</p></div>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Comment ID</th>
                            <th>Post Title</th>
                            <th>User</th>
                            <th>Comment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($comment = mysqli_fetch_assoc($comments)) : // Replace while loop with foreach if using array placeholder ?>
                            <tr>
                                <td><?= htmlspecialchars($comment['id']) ?></td>
                                <td><?= htmlspecialchars($comment['title'] ?? '') ?></td> <?php // Assumes join with posts table ?>
                                <td><?= htmlspecialchars($comment['firstname'] ?? '') . ' ' . htmlspecialchars($comment['lastname'] ?? '') ?></td> <?php // Assumes join with users table ?>
                                <td><?= htmlspecialchars($comment['body']) ?></td>
                                <td>
                                    <a href="edit-comment.php?id=<?= $comment['id'] ?>" class="btn sm">Edit</a>
                                    <a href="delete-comment.php?id=<?= $comment['id'] ?>" class="btn sm danger" onclick="return confirm('Are you sure you want to delete this comment?');">Delete</a>
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