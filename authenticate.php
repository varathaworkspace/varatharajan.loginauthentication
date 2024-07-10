<?php
session_start();

// Ensure the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'includes/db.php';

    // Get the submitted form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Get the MongoDB database and collection
    $db = getMongoDB();
    $collection = $db->users;

    // Find the user in the database
    $user = $collection->findOne(['username' => $username]);

    echo "<br>" . "User Data (username): " . json_encode($user['username']) . "<br>";
    echo "<br>" . "User Data (password): " . json_encode($user['password']) . "<br>";
        
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // (Bcrypt or Argon2i)
    // $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // (Bcrypt or Argon2i)
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // (Bcrypt or Argon2i)
    echo "<br>" . "hashed" . $hashedPassword;

    // Check if the user exists and verify the password
    if ($user['username'] ==  $username && password_verify($password, $user['password'])) {
    // if ($user['username'] ==  $username && $user['password'] == $password) {
        // Authentication successful: set session variable
        $_SESSION['username'] = $username;
        // Redirect to the welcome page upon successful login
        header('Location: welcome2.php');
        // exit();
    } else {
        // Authentication failed: redirect back to login page with error message
        $_SESSION['error_message'] = 'Invalid username or password.';
        // echo "<br>" . "Nooooooooo" . json_encode($user['password']) . "<br>";
        echo "<script>alert('Invalid username or password.'); window.location.href='index.html';</script>";
        // header('Location: login.php');
        // exit();
    }
} else {
    // Redirect back to the login page if the form was not submitted via POST
    header('Location: login.php');
    exit();
}
?>