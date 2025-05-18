<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Get image URL before deletion
    $stmt = $pdo->prepare("SELECT image_url FROM articles WHERE id = ?");
    $stmt->execute([$id]);
    $article = $stmt->fetch();

    if ($article) {
        $imagePath = $article['image_url'];
        $fullImagePath = __DIR__ . '/' . $imagePath;

        // Delete the article
        $deleteStmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
        $deleteStmt->execute([$id]);

        // Delete the image from server if it exists
        if (file_exists($fullImagePath)) {
            unlink($fullImagePath);
        }

        header("Location: pages/admin_dashboard.php?deleted=1");
        exit;
    } else {
        echo "Article not found.";
    }
} else {
    echo "Invalid request.";
}
