<?php
/**
 * gallery.php - Image Gallery Page
 * Reads all images from the uploads folder and displays them in a grid.
 */
require_once 'config/session.php';
include 'includes/header.php';
?>

<h1>Image Gallery</h1>

<?php
// Display flash messages (e.g. after a successful upload redirect)
if (!empty($_SESSION['flash_message'])) {
    $type = $_SESSION['flash_type'] ?? 'success';
    echo '<div class="alert alert-' . $type . '">' . htmlspecialchars($_SESSION['flash_message']) . '</div>';
    unset($_SESSION['flash_message']);
    unset($_SESSION['flash_type']);
}
?>

<p style="margin-bottom:20px;">
    <a href="index.php" class="btn btn-secondary">+ Upload New Image</a>
</p>

<?php
// Read all image files from the uploads directory
$upload_dir    = __DIR__ . '/uploads/';
$allowed_exts  = ['jpg', 'jpeg', 'png', 'gif'];
$images        = [];

if (is_dir($upload_dir)) {
    // Scan the directory for files
    $files = scandir($upload_dir);
    foreach ($files as $file) {
        // Skip . and .. directory entries
        if ($file === '.' || $file === '..') {
            continue;
        }
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, $allowed_exts)) {
            $images[] = $file;
        }
    }
}

// Display the gallery grid or an empty state message
if (!empty($images)) {
    echo '<div class="gallery-grid">';
    foreach ($images as $image) {
        $image_url = 'uploads/' . htmlspecialchars($image);
        echo '<div class="gallery-item">';
        echo '  <img src="' . $image_url . '" alt="' . htmlspecialchars($image) . '">';
        echo '  <p class="img-label">' . htmlspecialchars($image) . '</p>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p class="empty-message">No images uploaded yet. <a href="index.php">Upload your first image!</a></p>';
}
?>

<?php include 'includes/footer.php'; ?>
