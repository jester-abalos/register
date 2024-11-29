<?php
require './connection.php'; // Ensure this connects to MongoDB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        try {
            // Use the MongoDB users collection
            $collection = $database->selectCollection('users');

            // Insert user data into the MongoDB collection
            $result = $collection->insertOne([
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword,
            ]);

            // Redirect on success
            header('Location: login.php');
            exit;
        } catch (Exception $e) {
            echo "Error: Could not register user. " . $e->getMessage();
        }
    } else {
        echo "Error: All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form class="form" action="register.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit">Register</button> 
        </form>
    </div>
</body>
</html>

