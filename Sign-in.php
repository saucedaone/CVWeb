<?php
// Database connection settings
$servername = "localhost"; // Change if necessary
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "resumeplatform"; // Change to your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user inputs
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitizeInput($_POST["name"]);
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);
    $re_password = sanitizeInput($_POST["re-password"]);

    // Check if passwords match
    if ($password !== $re_password) {
        echo "<script>swal('Error', 'Passwords do not match!', 'error');</script>";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>swal('Success', 'Registration successful!', 'success').then(() => { window.location.href = 'login.php'; });</script>";
        } else {
            echo "<script>swal('Error', 'Registration failed: " . $stmt->error . "', 'error');</script>";
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="create.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Sign-In</h1>
        <form action="Sign-in.php" method="POST">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Your full name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Your password" required>

            <label for="re-password">Re-enter Password</label>
            <input type="password" id="re-password" name="re-password" placeholder="Re-enter password" required>

            <button type="submit">Sign-In</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a>.</p> 
    </div>

    <div class="goback-button">
        <a href="Home.php" class="btn">Go Back</a>
    </div> 
</body>
</html>
