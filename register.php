<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form id="registerForm" action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="index.html">Login here</a>.</p>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'includes/db.php';

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $db = getMongoDB();
    $collection = $db->users;

    $existingUser = $collection->findOne(['username' => $username]);

    if ($existingUser) {
        echo "<script>alert('Username already exists.'); window.location.href='register.php';</script>";
    } else {
        $collection->insertOne(['username' => $username, 'password' => $password]);
        echo "<script>alert('Registration successful.'); window.location.href='index.html';</script>";
    }
}
?>
