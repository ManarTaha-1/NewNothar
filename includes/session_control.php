<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!function_exists('isLoggedIn')) {
    function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
}


// Check if user is admin
function isAdmin() {
    return isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin';
}

// Require login or redirect
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ../pages/index.php'); 
        exit();
    }
}

// Require admin or redirect
function requireAdmin() {
    if (!isAdmin()) {
        header('Location: ../pages/index.php'); 
        exit();
    }
}

// Log the user out
function logoutUser() {
    
    $_SESSION = [];
    session_unset();
    session_destroy();

    // clear cookies 
    setcookie('remembered_username', '', time() - 3600, "/");
    setcookie('remembered_email', '', time() - 3600, "/");

    $redirect = $_POST['redirect'] ?? '../pages/index.php';
    header("Location: $redirect");
    exit();
}
