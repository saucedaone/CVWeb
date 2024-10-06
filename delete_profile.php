<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resumeplatform";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['id'])) {
    $id = $_POST['id'];

    
    $sql = "DELETE FROM user_profiles WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: display.php");
        exit();
    } else {
        echo "Error deleting profile: " . $conn->error;
    }
} else {
    echo "No ID provided.";
}


$conn->close();
?>
