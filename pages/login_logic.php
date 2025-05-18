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
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);
    $redirect = $_POST['redirect'] ?? '../pages/index.php';
 
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required!";
    }  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    }
 
    if (empty($error)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];
 
            if ($remember) {
                setcookie('remembered_email', $email, time() + (86400 * 7), "/");
            } else {
                setcookie('remembered_email', '', time() - 3600, "/");
            }
 
            if ($user['user_type'] === 'admin') {
                header("Location: ../pages/admin_dashboard.php");
            } else {
                header("Location: $redirect");
            }
            exit();
        } else {
       
            $_SESSION['login_error'] = "Invalid username, email or password.";
            header("Location: $redirect");
            exit();
        }
    } else {
    
        $_SESSION['login_error'] = $error;
        header("Location: $redirect");
        exit();
    }
}
?>
