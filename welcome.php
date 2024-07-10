<?php
session_start();

// Check if $_SESSION['username'] is set
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

// Use $username in your HTML
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .profile-container {
            position: relative;
            width: 100px;
            /* Adjust size as needed */
            height: 100px;
            /* Adjust size as needed */
            border-radius: 50%;
            /* Makes it circular */
            overflow: hidden;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .default-avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-link {
            position: absolute;
            top: 10px;
            right: 10px;
            text-decoration: none;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="#" class="profile-link">Profile</a>
        <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
        <p>You have successfully logged in.</p>
        <div class="profile-container">
            <?php
            // Path to the uploaded image (adjust this path as per your project structure)
            $imagePath = 'uploads/' . $_SESSION['username'] . '.jpg';

            // Check if the file exists
            if (file_exists($imagePath)) {
                echo '<img src="' . $imagePath . '" alt="Profile Image" class="profile-image">';
            } else {
                echo '<img src="img/avatar.jpeg" alt="Default Avatar" class="default-avatar">';
            }
            ?>
        </div>
        <h2>Upload Profile Image</h2>
        <input type="file" id="image" accept="image/*">
        <button id="uploadButton">Upload Image</button>
        <div class="profile-container">
            <?php
            // Retrieve base64 encoded image from MongoDB
            $base64Image = ''; // Replace with your actual retrieval code from MongoDB
            
            if (!empty($base64Image)) {
                echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Profile Image" class="profile-image">';
            } else {
                echo '<img src="img/avatar.jpeg" alt="Default Avatar" class="default-avatar">';
            }
            ?>
        </div>
        <p><a href="index.html">Go to Home</a></p>
    </div>
    <script src="js/scripts.js"></script>
</body>

</html>
<!-- ---------------------------- -->