<?php
// register_logic.php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['register_error'] = "All fields are required!";
    } elseif (!preg_match("/^[a-zA-Z0-9\s]+$/", $username)) {
        $_SESSION['register_error'] = "Username can only contain letters, numbers, and spaces!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['register_error'] = "Invalid email format!";
    } elseif (strlen($password) < 6 || !preg_match('/[0-9]/', $password)) {
        $_SESSION['register_error'] = "Password must be at least 6 characters and contain at least one number!";
    } elseif ($password !== $confirm_password) {
        $_SESSION['register_error'] = "Passwords do not match!";
    } else {
        $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            $_SESSION['trigger_login'] = true;
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password]);
            $_SESSION['success'] = "Registration successful! Please login.";
            $_SESSION['trigger_login'] = true;
        }
    }

    header("Location: index.php");
    exit();
}
?>
