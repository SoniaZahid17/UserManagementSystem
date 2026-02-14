<?php
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($username && $email && $password) {

        // save user into text file
        $data = $username . "," . $email . "," . password_hash($password, PASSWORD_DEFAULT) . "\n";
        file_put_contents("users.txt", $data, FILE_APPEND);

        $message = "Signup successful! You can now login.";
    } else {
        $message = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Signup</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
}

.signup-container {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(15px);
    padding: 40px;
    width: 350px;
    border-radius: 15px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    color: #fff;
    text-align: center;
}

.signup-container h2 {
    margin-bottom: 25px;
    font-weight: 600;
}

.input-group {
    margin-bottom: 20px;
    text-align: left;
}

.input-group label {
    font-size: 14px;
    margin-bottom: 5px;
    display: block;
}

.input-group input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: none;
    outline: none;
    font-size: 14px;
}

.btn {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: #ffffff;
    color: #764ba2;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.btn:hover {
    background: #f1f1f1;
    transform: scale(1.05);
}

.message {
    background: rgba(0, 255, 0, 0.2);
    padding: 8px;
    border-radius: 5px;
    margin-bottom: 15px;
    font-size: 14px;
    color: #fff;
}

.footer-text {
    margin-top: 15px;
    font-size: 13px;
}

.footer-text a {
    color: #fff;
    text-decoration: underline;
}
</style>
</head>
<body>

<div class="signup-container">
    <h2>Create Account</h2>

    <?php if ($message): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn">Sign Up</button>
    </form>

    <div class="footer-text">
        Already have an account? <a href="login.php">Login</a>
    </div>
</div>

</body>
</html>
