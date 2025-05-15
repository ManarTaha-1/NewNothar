<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../config.php';

$saved_username = $_COOKIE['remembered_username'] ?? '';
$saved_email = $_COOKIE['remembered_email'] ?? '';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required!";
    } elseif (!preg_match("/^[a-zA-Z0-9\s]+$/", $username)) {
        $error = "Username can only contain letters, numbers, and spaces!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    }

    if (empty($error)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND email = ?");
        $stmt->execute([$username, $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];

            if ($remember) {
                setcookie('remembered_username', $username, time() + (86400 * 7), "/");
                setcookie('remembered_email', $email, time() + (86400 * 7), "/");
            } else {
                setcookie('remembered_username', '', time() - 3600, "/");
                setcookie('remembered_email', '', time() - 3600, "/");
            }

            header("Location: " . ($user['user_type'] === 'admin' ? "../pages/admin_dashboard.php" : "../pages/index.php"));
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid username, email or password.";
            header("Location: ../pages/index.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = $error;
        header("Location: ../pages/index.php");
        exit();
    }
}
?>
