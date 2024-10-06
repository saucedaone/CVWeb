<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resumeplatform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store data in session variables
            $_SESSION['loggedin'] = true; // Set this after successful login
            $_SESSION['username'] = $user['name']; // Store username or any other relevant information

            // Redirect to a different page (e.g., dashboard)
            header("Location: display.php");
            exit;
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        // User does not exist
        echo "<script>alert('No user found with this email.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="create.css">
</head>
<body>
    <div class="container">
        <div class="success-message">
            <h1>Login</h1>
            <form action="login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your email" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password" required>

                <button type="submit" class="success-message">Login</button>
            </form>

            <p class="success-message p">Don't have an account? <a href="Sign-in.php">Sign up here</a>.</p>
        </div>

        <div class="goback-button">
            <a href="Home.php" class="btn">Go Back</a>
        </div>
    </div>
</body>
</html>

