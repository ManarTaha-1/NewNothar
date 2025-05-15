<?php
// Database Configuration

// Database credentials
$host = 'localhost';   
$dbname = 'articles';   
$username = 'root';  // Your database username
$password = '';  // Your database password

// PDO options for error handling and fetch style
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES => false, // Disables emulation of prepared statements (for better security)
];

// Try to establish a database connection using PDO
try {
    // Create PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
} catch (PDOException $e) {
    // If connection fails, show error message and stop execution
    echo "Database connection failed: " . $e->getMessage();
    exit();
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Helper function for checking if a user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Helper function for getting the currently logged-in user's info
function getCurrentUser() {
    global $pdo;
    if (isLoggedIn()) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetch();
    }
    return null;
}

?>



