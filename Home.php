<?php
session_start(); // Start the session at the top of the file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Your CV Website</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div>
        <nav class="navbar">
            <img src="Source Logo 2-1.png" alt="Website Logo" class="logo">
            <ul>
                <li><a href="display.php">Profile</a></li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li><a href="logout.php">Logout</a></li> <!-- Display logout if logged in -->
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="Sign-in.php">Sign In</a></li>
                <?php endif; ?>
                <li><a href="About.php">About</a></li>
            </ul>
        </nav>
    </div>
    
    <div class="welcome-container">
        <h1>Welcome to Your CV Website</h1>
        <p>This platform allows you to easily manage your curriculum vitae (CV). You can add, update, and delete your CV details anytime.</p>
        <p>Established in 2024, we aim to simplify your career journey.</p>
        <p>Get started by clicking the button below!</p>
    </div>
    
    <a href="Create.php" class="start-button">Start Now</a>

</body>
</html>
