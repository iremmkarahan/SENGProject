<?php
include 'partials/header.php';

// fetch facilities from database
$query = "SELECT * FROM facilities ORDER BY title";
$facilities = mysqli_query($connection, $query);

?>

<style>
   

   .facilities-header {
       
       margin: 0 0 2rem; /* Adjust margin top as it will be inside the new container */
       padding: 0 1rem;
       text-align: center;
   }

   .facilities-title {
       font-weight: bold;
       text-align: center;
       color: var(--dark);
   }

   .divider {
       width: 150px;
       height: 2px;
       background-color: var(--dark);
       margin: 0.5rem auto 1.5rem;
   }

   .facilities-description {
       text-align: center;
       max-width: 800px;
       margin: 0 auto;
       color: var(--gray);
   }

   /* New wrapper for main content */
   .facilities__main-content {
        background: var(--color-gray-900); /* Use a similar background as about/contact blocks */
        padding: 2.5rem;
        border-radius: var(--card-border-radius-3);
        box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.1); /* Add shadow */
        margin: 8rem auto 2rem; /* Center the block and add some vertical margin, adjust top margin to clear fixed header */
        max-width: 1200px; /* Limit width */
   }

   .facilities-container {
       max-width: 1200px;
       width: 100%; /* Ensure it takes full width of its parent */
       margin: 0; /* Remove auto margin as parent is centered */
       padding: 0 1rem;
       /* flex: 1; Removed as it's not a flex item anymore */
   }

   .facilities-grid {
       display: grid;
       grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
       gap: 2rem;
       padding: 2rem 0;
   }

   .facility-card {
       background-color: #DFF5F0;
       border-radius: 5px;
       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
       padding: 1.5rem;
       border-top: 4px solid var(--dark);
       transition: all 0.3s;
       position: relative;
   }

   .facility-card:hover {
       border-top-color: var(--teal);
       transform: scale(1.03);
   }

   .facility-title {
       font-weight: bold;
       color: var(--dark);
       margin-bottom: 0.5rem;
   }

   .facility-description {
       color: var(--gray);
       line-height: 1.5;
   }

   .admin-controls {
       position: absolute;
       top: 10px;
       right: 10px;
       display: flex;
       gap: 5px;
   }

   .admin-btn {
       padding: 5px 10px;
       border: none;
       border-radius: 3px;
       cursor: pointer;
       color: white;
       font-size: 12px;
   }

   .edit-btn {
       background-color: var(--primary);
   }

   .delete-btn {
       background-color: var(--danger);
   }

   .admin-panel {
       max-width: 800px;
       margin: 2rem auto; /* Keep margin here to center within facilities__main-content */
       padding: 1.5rem;
       background-color: #fff;
       border-radius: 5px;
       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
       width: 100%; /* Adjust width to fit within the new container with padding */
       box-sizing: border-box;
   }

   .form-group {
       margin-bottom: 1rem;
   }

   .form-group label {
       font-weight: bold;
       display: block;
       margin-bottom: 0.5rem;
       color: var(--dark);
   }

   .form-control {
       width: 100%;
       padding: 8px;
       border: 1px solid #ccc;
       border-radius: 4px;
       box-sizing: border-box;
   }

   .btn {
       padding: 10px 15px;
       border: none;
       border-radius: 4px;
       cursor: pointer;
       color: white;
       font-weight: bold;
   }

   .btn-success {
       background-color: var(--success);
   }

   .btn-primary {
       background-color: var(--primary);
   }

   .alert {
       padding: 1rem;
       border-radius: 5px;
       margin: 1rem auto;
       max-width: 800px;
   }

   .alert-success {
       background-color: #d4edda;
       color: #155724;
       border: 1px solid #c3e6cb;
   }

   .alert-danger {
       background-color: #f8d7da;
       color: #721c24;
       border: 1px solid #f5c6cb;
   }

   /* Responsive adjustments */
   @media (max-width: 768px) {
        .facilities__main-content {
            padding: 1.5rem; /* Adjust padding on smaller screens */
            margin-top: 6rem; /* Adjust top margin for smaller screens */
        }

        .admin-panel {
            padding: 1rem; /* Adjust admin panel padding */
        }

        .facilities-grid {
            gap: 1rem; /* Adjust grid gap */
        }
   }

</style>



<div class="page-wrapper">
    <?php if(isset($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>
    
    <?php if(isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <div class="facilities__main-content container">
        <div class="facilities-header">
            <h2 class="facilities-title">Our Facilities</h2>
            <div class="divider"></div>
        </div>

        <?php if($is_admin): ?>
            <div class="admin-panel">
                <h3>Add New Facility</h3>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="title">Facility Name</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon Path</label>
                        <input type="text" id="icon" name="icon" class="form-control" value="images/wifi.svg" required>
                    </div>
                    <button type="submit" name="add_facility" class="btn btn-success">Add Facility</button>
                </form>
            </div>
        <?php endif; ?>

        <div class="facilities-container">
            <div class="facilities-grid">
                <?php 
                if(mysqli_num_rows($facilities) > 0):
                    while($facility = mysqli_fetch_assoc($facilities)): 
                ?>
                    <div class="facility-card">
                        <?php if($is_admin): ?>
                            <div class="admin-controls">
                                <button class="admin-btn edit-btn" onclick="openEditModal(<?php echo $facility['id']; ?>)">Edit</button>
                                <a href="?delete=<?php echo $facility['id']; ?>" class="admin-btn delete-btn" onclick="return confirm('Are you sure you want to delete this facility?')">Delete</a>
                            </div>
                        <?php endif; ?>
                        <h5 class="facility-title"><?= $facility['title'] ?></h5>
                        <p class="facility-description"><?= $facility['description'] ?></p>
                    </div>
                <?php 
                    endwhile;
                else:
                ?>
                    <div class="alert alert-danger">No facilities found</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    

</div>


<?php
include 'partials/footer.php';
?>
