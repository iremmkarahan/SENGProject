
<?php
include 'partials/header.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voyago-FACILITIES</title>
    <style>
        /* CSS Variables */
        :root {
            --teal: #2ec1ac;
            --dark: #192a56;
            --light: #f8f9fa;
            --danger: #dc3545;
            --success: #28a745;
            --primary: #007bff;
            --gray: #6c757d;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--light);
            margin: 0;
            padding: 0;
        }

        /* Facilities Header Styles */
        .facilities-header {
            margin: 3rem auto;
            padding: 0 2rem;
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
        }

        /* Facilities Grid Layout */
        .facilities-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            padding: 1rem 0 3rem;
        }

        /* Facility Card Styles */
        .facility-card {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            border-top: 4px solid var(--dark);
            transition: all 0.3s;
            position: relative;
        }

        .facility-card:hover {
            border-top-color: var(--teal);
            transform: scale(1.03);
        }

        .facility-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .facility-icon {
            width: 40px;
            height: 40px;
        }

        .facility-title {
            margin: 0;
            margin-left: 1rem;
            font-weight: bold;
        }

        .facility-description {
            line-height: 1.5;
            color: #555;
        }

        /* Admin Panel Styles */
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

        /* Admin Form Styles */
        .admin-panel {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1.5rem;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .admin-panel h3 {
            color: var(--dark);
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: var(--teal);
            outline: none;
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

        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
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
            .facilities-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .facilities-grid {
                grid-template-columns: 1fr;
            }
            
            .facilities-header {
                margin: 2rem auto;
            }
        }
    </style>
</head>

<body>
    <!-- Display success/error messages -->
    <?php if(isset($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>
    
    <?php if(isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <div class="facilities-header">
        <h2 class="facilities-title">Our Facilities</h2>
        <div class="divider"></div>
        <p class="facilities-description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            <br> Nihil maxime laborum dicta voluptatum harum nemo vero corporis dolore saepe ex, ipsam placeat perferendis aperiam, expedita non animi id, repudiandae sapiente?
        </p>
    </div>

    <!-- Admin Panel - Only visible to admins -->
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

    <!-- Facilities Display -->
    <div class="facilities-container">
        <div class="facilities-grid">
            <?php 
            // Display facilities from database
            if(!empty($facilities)):
                foreach($facilities as $facility): 
            ?>
                <div class="facility-card">
                    <?php if($is_admin): ?>
                        <div class="admin-controls">
                            <button class="admin-btn edit-btn" onclick="openEditModal(<?php echo $facility['id']; ?>)">Edit</button>
                            <a href="?delete=<?php echo $facility['id']; ?>" class="admin-btn delete-btn" onclick="return confirm('Are you sure you want to delete this facility?')">Delete</a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="facility-header">
                        <img src="<?php echo htmlspecialchars($facility['icon']); ?>" class="facility-icon" alt="<?php echo htmlspecialchars($facility['title']); ?>">
                        <h5 class="facility-title"><?php echo htmlspecialchars($facility['title']); ?></h5>
                    </div>
                    <p class="facility-description">
                        <?php echo htmlspecialchars($facility['description']); ?>
                    </p>
                </div>
            <?php 
                endforeach; 
            else:
                // If no facilities in database, display sample facilities
                $sample_facilities = [
                    ['title' => 'WiFi', 'icon' => 'images/wifi.svg'],
                    ['title' => 'Swimming Pool', 'icon' => 'images/wifi.svg'],
                    ['title' => 'Room Service', 'icon' => 'images/wifi.svg'],
                    ['title' => 'Air Conditioning', 'icon' => 'images/wifi.svg'],
                    ['title' => 'Restaurant', 'icon' => 'images/wifi.svg'],
                    ['title' => 'Parking', 'icon' => 'images/wifi.svg']
                ];
                
                foreach($sample_facilities as $facility):
            ?>
                <div class="facility-card">
                    <div class="facility-header">
                        <img src="<?php echo $facility['icon']; ?>" class="facility-icon" alt="<?php echo $facility['title']; ?>">
                        <h5 class="facility-title"><?php echo $facility['title']; ?></h5>
                    </div>
                    <p class="facility-description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium quaerat dignissimos,
                        rerum dolorum exercitationem, optio illum ipsa pariatur ab autem quibusdam laboriosam
                        impedit hic tenetur reiciendis corporis. Dicta, dolor quae.
                    </p>
                </div>
            <?php 
                endforeach;
            endif; 
            ?>
        </div>
    </div>

    <!-- Edit Facility Modal (Only for admin) -->
    <?php if($is_admin): ?>
        <div id="editModal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
            <div style="background-color: white; margin: 10% auto; padding: 20px; width: 60%; max-width: 500px; border-radius: 5px;">
                <span onclick="closeEditModal()" style="float: right; cursor: pointer; font-size: 24px;">&times;</span>
                <h3>Edit Facility</h3>
                <form id="editForm" method="post" action="">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_title">Facility Name</label>
                        <input type="text" id="edit_title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <textarea id="edit_description" name="description" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_icon">Icon Path</label>
                        <input type="text" id="edit_icon" name="icon" class="form-control" required>
                    </div>
                    <button type="submit" name="edit_facility" class="btn btn-primary">Update Facility</button>
                </form>
            </div>
        </div>

        <script>
            // Edit facility functionality
            function openEditModal(id) {
                // This would normally fetch facility data from the server using AJAX
                // For simplicity, we're using a quick solution here
                <?php 
                echo "const facilities = " . json_encode($facilities) . ";";
                ?>
                
                const facility = facilities.find(f => f.id == id);
                
                if (facility) {
                    document.getElementById('edit_id').value = facility.id;
                    document.getElementById('edit_title').value = facility.title;
                    document.getElementById('edit_description').value = facility.description;
                    document.getElementById('edit_icon').value = facility.icon;
                    document.getElementById('editModal').style.display = 'block';
                }
            }
            
            function closeEditModal() {
                document.getElementById('editModal').style.display = 'none';
            }
            
            // Close modal if clicked outside
            window.onclick = function(event) {
                const modal = document.getElementById('editModal');
                if (event.target == modal) {
                    closeEditModal();
                }
            }
        </script>
    <?php endif; ?>

<?php
// Include footer
include 'partials/footer.php';
?>