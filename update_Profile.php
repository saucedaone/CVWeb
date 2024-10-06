

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="create.css">
</head>
<body>
<div class="container">


        <h1>Edit Profile</h1>
        <form id="editProfileForm" method="POST" action="update_Profile.php">
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <button type="submit">Update Profile</button>
        </form>
    </div>

    <div class="goback-button">
        <a href="Home.php" class="btn">Go Back</a>
    </div>
    
</body>
</html>