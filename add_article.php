<?php
// Your PDO connection
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $category = $_POST['category'] ?? '';
    $imagePath = '';

    // Check if image was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'images/'; // Make sure this folder exists and is writable
        $originalName = basename($_FILES['image']['name']);
        $uniqueName = uniqid() . '_' . $originalName;
        $uploadPath = $uploadDir . $uniqueName;

        // Move uploaded file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $imagePath = $uploadPath; // Store this in DB
        } else {
            echo "Error uploading image.";
            exit;
        }
    }

    // Insert if all fields are filled
    if ($title && $content && $category && $imagePath) {
        $stmt = $pdo->prepare("INSERT INTO articles (title, content, category, image_url) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $content, $category, $imagePath]);

        // Redirect back to admin dashboard
        header("Location: pages/admin_dashboard.php?success=1");
        exit;
    } else {
        echo "Please fill in all fields.";
    }
}
?>

