<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $author = $_SESSION['user'];

    $imageName = null;

    // Handle image upload if provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $originalName = basename($_FILES['image']['name']);
        $targetDir = "uploads/";
        $uniqueName = time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "", $originalName); // sanitize filename
        $targetFile = $targetDir . $uniqueName;

        // Create uploads directory if not exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (move_uploaded_file($imageTmpPath, $targetFile)) {
            $imageName = $targetFile;
        }
    }

    // Insert with image path if available
    $stmt = $pdo->prepare("INSERT INTO news (title, content, category, author, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $content, $category, $author, $imageName]);

    header("Location: dashboard.php");
    exit;
}
?>
