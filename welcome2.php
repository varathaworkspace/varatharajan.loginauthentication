<?php
session_start();
require 'includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}

$username = $_SESSION['username'];
$db = getMongoDB();
$collection = $db->users;

// Find the user in the database
$user = $collection->findOne(['username' => $username]);

$profileImage = null;
$contentType = null;
if ($user && isset($user['profileImage'])) {
    $profileImageBinary = $user['profileImage']['data'];
    $profileImage = base64_encode($profileImageBinary->getData());
    $contentType = $user['profileImage']['contentType'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .profile-image-container {
            display: flex;
            justify-content: flex-end;
        }
        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-image-container">
            <img src="<?php echo $profileImage ? 'data:' . $contentType . ';base64,' . $profileImage : 'img/avatar.jpeg'; ?>" class="profile-image" alt="Profile Image">
        </div>
        <h2>Welcome <?php echo htmlspecialchars($username); ?></h2>
        <p>You have successfully logged in.</p>
        <h2>Upload Profile Image</h2>
        <input type="file" id="image" accept="image/*">
        <button id="uploadButton">Upload Image</button>
        <p><a href="index.html">Go to Home</a></p>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>
