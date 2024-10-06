
<?php

session_start(); 


    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        
        header('Location: login.php'); 
        exit;
    }



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "resumeplatform";

    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = trim($_POST['title']);
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $id_number = trim($_POST['id_number']);
    $gender = trim($_POST['gender']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $race = trim($_POST['race']);
    $nationality = trim($_POST['nationality']);
    $education = trim($_POST['education']);
    $experience = trim($_POST['experience']);
    $skills = trim($_POST['skills']);

   
    if (empty($title) || empty($name) || empty($surname) || empty($id_number) || empty($gender) ||
        empty($email) || empty($phone) || empty($address) || empty($race) || empty($nationality) ||
        empty($education) || empty($experience) || empty($skills)) {
        echo "All fields are required. Please fill in all fields.";
    } else {
       
        $sql = "INSERT INTO user_profiles (title, name, surname, id_number, gender, email, phone, address, race, nationality, education, experience, skills)
                VALUES ('$title', '$name', '$surname', '$id_number', '$gender', '$email', '$phone', '$address', '$race', '$nationality', '$education', '$experience', '$skills')";

    if ($conn->query($sql) === TRUE) {
   
    echo "<script>
            swal({
                title: 'Success!',
                text: 'New record created successfully',
                type: 'success',
                confirmButtonText: 'OK'
            }, function() {
                window.location.href = 'display.php'; // Change this to your desired page
            });
          </script>";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Platform</title>
    <link rel="stylesheet" href="create.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

</head>
<body>
    <div class="container">
        <h1>Create & Submit Your CV</h1>
        <form id="cvForm" method="POST" action="create.php">

        <label for="title">Title</label>
<div class="checkbox-group">
    <div>
        <input type="radio" id="mr" name="title" value="Mr" required>
        <label for="mr">Mr</label>
    </div>
    <div>
        <input type="radio" id="mrs" name="title" value="Mrs" required>
        <label for="mrs">Mrs</label>
    </div>
    <div>
        <input type="radio" id="miss" name="title" value="Miss" required>
        <label for="miss">Miss</label>
    </div>
</div>
            <label for="name">Full Names</label>
            <input type="text" id="name" name="name" placeholder="Your full name" required>

            <label for="surname">Surname</label>
            <input type="text" id="surname" name="surname" placeholder="Your Surname" required>

            <label for="id_number">ID Number</label>
            <input type="text" id="id_number" name="id_number" placeholder="ID Number" required>

            <label>Gender</label>
            <div class="checkbox-group">
                <div><input type="radio" id="male" name="gender" value="male" required>
                    <label for="male">Male</label></div>
                <div><input type="radio" id="female" name="gender" value="female" required>
                    <label for="female">Female</label></div>
                <div><input type="radio" id="other" name="gender" value="other" required>
                    <label for="other">Other</label></div>
            </div>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your email" required>

            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" placeholder="Your phone number" required>

            <label for="address">Street Address</label>
            <input type="text" id="address" name="address" placeholder="Street name" required>

            <label for="race">Race</label>
            <select id="race" name="race" required>
                <option value="" disabled selected>Select your Race</option>
                <option value="Black">Black</option>
                <option value="White">White</option>
                <option value="Indian">Indian</option>
                <option value="Afrikaans">Afrikaans</option>
                <option value="Other">Other</option>
            </select>

            <label for="nationality">Nationality</label>
            <select id="nationality" name="nationality" required>
                <option value="" disabled selected>Select your nationality</option>
                <option value="Botswana">Botswana</option>
                <option value="China">China</option>
                <option value="Germany">Germany</option>
                <option value="India">India</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Namibia">Namibia</option>
                <option value="Lesotho">Lesotho</option>
                <option value="SA">South Africa</option>
                <option value="US">United States</option>
                <option value="UK">United Kingdom</option>
                <option value="Other">Other</option>
            </select>

            <label for="education">Education</label>
            <textarea id="education" name="education" placeholder="Describe your educational background" required></textarea>

            <label for="experience">Work Experience</label>
            <textarea id="experience" name="experience" placeholder="Information on your professional experience" required></textarea>

            <label for="skills">Skills</label>
            <textarea id="skills" name="skills" placeholder="List your key skills" required></textarea>

            <button type="submit" name="submit">Submit CV</button>
        </form>
    </div>

    <div class="goback-button">
        <a href="Home.php" class="btn">Go Back</a>
    </div>
    
</body>
</html>


