<?php
require 'config/constants.php'; // Include constant definitions (like ROOT_URL)

// Retrieve previous input values from session if they exist (to pre-fill form after error)
$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

// Clear the old signin-data from the session after retrieving it
unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOYAGO</title>

    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">

    <!-- ICONSCOUT CDN (for icons used in UI) -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- GOOGLE FONT (Montserrat) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>

    <!-- Sign In Form Section -->
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Sign In</h2>

            <!-- Show success message after signup, if exists -->
            <?php if (isset($_SESSION['signup-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']); // Remove message after displaying
                        ?>
                    </p>
                </div>

            <!-- Show error message for failed login, if exists -->
            <?php elseif (isset($_SESSION['signin'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['signin'];
                        unset($_SESSION['signin']); // Remove error message after displaying
                        ?>
                    </p>
                </div>
            <?php endif ?>

            <!-- Sign In Form -->
            <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
                <!-- Prefill username/email input if value exists in session -->
                <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Username or Email">

                <!-- Prefill password input if value exists in session -->
                <input type="password" name="password" value="<?= $password ?>" placeholder="Password">

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn">Sign In</button>

                <!-- Link to signup page -->
                <small>Don't have account? <a href="signup.php">Sign Up</a></small>
            </form>
        </div>
    </section>

</body>

</html>
