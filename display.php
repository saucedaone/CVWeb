<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Details</title>
    <style>
    
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-align: center;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('Profile background.jpg');
            background-size: cover; 
            background-position: center; 
            padding: 20px;
            color: white; 
        }
        .container {
            display: inline flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .profile-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            width: 300px;
            transition: transform 0.3s;
            position: relative;
        }

        .profile-card:hover {
            transform: translateY(-10px);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 15px;
        }

        .profile-header h2 {
            font-size: 1.5em;
            color: #333;
        }

        .profile-header p {
            color: #777;
        }

        .profile-details {
            list-style-type: none;
            padding: 0;
            color: #555;
        }

        .profile-details li {
            margin: 8px 0;
            font-size: 0.9em;
        }

        .profile-details li strong {
            color: #333;
        }

        .profile-actions {
            margin-top: 20px;
            text-align: center;
        }

        .profile-actions button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 0.9em;
            cursor: pointer;
            border-radius: 5px;
            margin: 5px;
            transition: background-color 0.3s;
        }

        .profile-actions button:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
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


    </style>
</head>
<body>

<h1>Profile Details</h1>
<div class="container">
    <?php
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "resumeplatform";

    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

  
    $sql = "SELECT id, title, name, surname, id_number, gender, email, phone, address, race, nationality, education, experience, skills FROM user_profiles";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            echo '<div class="profile-card">';
            echo '<div class="profile-header">';
            echo '<h2>' . $row['title'] . " " . $row['name'] . " " . $row['surname'] . '</h2>';
            echo '<p>' . $row['email'] . '</p>';
            echo '</div>';
            echo '<ul class="profile-details">';
            echo '<li><strong>ID Number:</strong> ' . $row['id_number'] . '</li>';
            echo '<li><strong>Gender:</strong> ' . $row['gender'] . '</li>';
            echo '<li><strong>Phone:</strong> ' . $row['phone'] . '</li>';
            echo '<li><strong>Address:</strong> ' . $row['address'] . '</li>';
            echo '<li><strong>Race:</strong> ' . $row['race'] . '</li>';
            echo '<li><strong>Nationality:</strong> ' . $row['nationality'] . '</li>';
            echo '<li><strong>Education:</strong> ' . $row['education'] . '</li>';
            echo '<li><strong>Experience:</strong> ' . $row['experience'] . '</li>';
            echo '<li><strong>Skills:</strong> ' . $row['skills'] . '</li>';
            echo '</ul>';

           
            echo '<div class="profile-actions">';
            echo '<form method="POST" action="edit_profile.php" style="display:inline-block;">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit">Edit</button>';
            echo '</form>';

            echo '<form method="POST" action="delete_profile.php" style="display:inline-block;">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" class="delete-btn">Delete</button>';
            echo '</form>';
            echo '</div>';

            echo '</div>';
        }
    } else {
        echo "No profiles found.";
    }

    
    $conn->close();
    ?>
</div>



<a href="Home.php" class="go-back">Go Back</a>

</body>
</html>
