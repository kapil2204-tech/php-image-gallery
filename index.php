<?php
/**
 * index.php - Image Upload Form
 * Displays the upload form and previous session upload info.
 */
require_once 'config/session.php';
include 'includes/header.php';
?>

<h1>Upload an Image</h1>

<?php
// Display any flash messages stored in session
if (!empty($_SESSION['flash_message'])) {
    $type = $_SESSION['flash_type'] ?? 'success';
    echo '<div class="alert alert-' . $type . '">' . htmlspecialchars($_SESSION['flash_message']) . '</div>';
    // Clear the flash message after displaying
    unset($_SESSION['flash_message']);
    unset($_SESSION['flash_type']);
}
?>

<div class="upload-card">
    <form id="upload-form" action="upload.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image-input">Select Image File</label>
            <input type="file" id="image-input" name="image" accept=".jpg,.jpeg,.png,.gif">
            <p id="file-name"></p>
            <small>Allowed: JPG, JPEG, PNG, GIF &mdash; Max size: 2MB</small>
        </div>
        <button type="submit" class="btn">Upload Image</button>
    </form>
</div>

<?php
// Show session-tracked uploads (images uploaded in this session)
if (!empty($_SESSION['uploaded_images'])) {
    echo '<div class="session-info">';
    echo '<strong>Images uploaded this session:</strong>';
    echo '<ul>';
    foreach ($_SESSION['uploaded_images'] as $imgName) {
        echo '<li>' . htmlspecialchars($imgName) . '</li>';
    }
    echo '</ul>';
    echo '</div>';
}
?>

<?php include 'includes/footer.php'; ?>
