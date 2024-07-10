<?php
session_start();
require 'vendor/autoload.php'; // Include Composer's autoloader
require 'includes/db.php';

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    echo "You must be logged in to upload an image.";
    exit();
}

// Handle image upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    // Get the logged-in username from the session
    $username = $_SESSION['username'];
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    $imageContentType = $_FILES['image']['type'];

    // Get the MongoDB database and collection
    $db = getMongoDB();
    $collection = $db->users;

    // Update user document with image data
    $updateResult = $collection->updateOne(
        ['username' => $username],
        ['$set' => ['profileImage' => [
            'data' => new MongoDB\BSON\Binary($imageData, MongoDB\BSON\Binary::TYPE_GENERIC),
            'contentType' => $imageContentType
        ]]]
    );

    if ($updateResult->getModifiedCount() > 0) {
        echo "Image uploaded successfully.";
    } else {
        echo "Failed to upload image.";
    }
}
?>
