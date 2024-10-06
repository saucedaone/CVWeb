<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resumeplatform";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id = $_POST['id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $title = $_POST['title'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $id_number = $_POST['id_number'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $race = $_POST['race'];
    $nationality = $_POST['nationality'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $skills = $_POST['skills'];

    
    $sql = "UPDATE user_profiles SET 
            title='$title', name='$name', surname='$surname', 
            id_number='$id_number', gender='$gender', email='$email', 
            phone='$phone', address='$address', race='$race', 
            nationality='$nationality', education='$education', 
            experience='$experience', skills='$skills' 
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully!";
       
        header("Location: display.php");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
} else {
   
    $sql = "SELECT * FROM user_profiles WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No profile found with ID: $id";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
       body {
            font-family: 'Roboto', sans-serif;
            background-image: url('editProfilebackground.jpg'); 
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 20px;
            color: white; 
        }
        h1 {
            text-align: center;
            color: Black;
            
        }
        form {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            margin: 20px auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border 0.3s;
        }
        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #007bff;
            outline: none;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        @media (max-width: 600px) {
            form {
                width: 90%;
                padding: 15px;
            }
        }

        .go-back {
    display: block;
    margin: 20px auto; 
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border-radius: 4px;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.3s;
    max-width: 150px; 
}

.go-back:hover {
    background-color: #0056b3;
}

.update_button {
    display: block; 
    margin: 20px auto;
    padding: 15px 25px; 
    font-size: 18px; 
    background-color: #5cb85c;
    color: white;
    text-decoration: none; 
    border-radius: 4px;
    text-align: center; 
}

    </style>
</head>
<body>

<h1>Edit Profile</h1>

<form method="POST" action="edit_profile.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    
    <label for="title">Title:</label>
    <input type="text" name="title" value="<?php echo $row['title']; ?>" required>
    
    <label for="name">First Name:</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

    <label for="surname">Last Name:</label>
    <input type="text" name="surname" value="<?php echo $row['surname']; ?>" required>

    <label for="id_number">ID Number:</label>
    <input type="text" name="id_number" value="<?php echo $row['id_number']; ?>" required>

    <label for="gender">Gender:</label>
    <input type="text" name="gender" value="<?php echo $row['gender']; ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>

    <label for="address">Address:</label>
    <input type="text" name="address" value="<?php echo $row['address']; ?>" required>

    <label for="race">Race:</label>
    <input type="text" name="race" value="<?php echo $row['race']; ?>" required>

    <label for="nationality">Nationality:</label>
    <input type="text" name="nationality" value="<?php echo $row['nationality']; ?>" required>

    <label for="education">Education:</label>
    <input type="text" name="education" value="<?php echo $row['education']; ?>" required>

    <label for="experience">Experience:</label>
    <input type="text" name="experience" value="<?php echo $row['experience']; ?>" required>

    <label for="skills">Skills:</label>
    <input type="text" name="skills" value="<?php echo $row['skills']; ?>" required>

    <input type="submit" name="update" class="update_button" value="Update Profile">
</form>


<a href="display.php" class="go-back">Go Back</a>

</body>
</html>
