<?php
require "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'], $_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        try {
            // Access the users collection
            $collection = $database->selectCollection('users');

            // Find the user by email
            $user = $collection->findOne(['email' => $email]);

            if ($user) {
                // Verify the hashed password
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['email'] = $email; // Save email in session
                    echo "You are logged in.";
                    exit;
                } else {
                    echo "Incorrect email or password.";
                }
            } else {
                echo "Incorrect email or password.";
            }
        } catch (Exception $e) {
            echo "Error: Could not connect to the database. " . $e->getMessage();
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="logincontainer">
        <div class="form">
            <h1>Login</h1>
            <form action="login.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Email" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" required><br>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>

