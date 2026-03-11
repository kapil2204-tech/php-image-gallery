<?php
/**
 * upload.php - Image Upload Processing
 * Handles POST form submission, validates the uploaded file,
 * stores it in the uploads directory, and tracks it in the session.
 */
require_once 'config/session.php';

// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// ---- Configuration ----
$upload_dir    = __DIR__ . '/uploads/';
$allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
$max_size      = 2 * 1024 * 1024; // 2MB in bytes

// ---- Check if file was submitted ----
if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
    $_SESSION['flash_message'] = 'No file was selected. Please choose an image to upload.';
    $_SESSION['flash_type']    = 'error';
    header('Location: index.php');
    exit;
}

$file = $_FILES['image'];

// ---- Check for PHP upload errors ----
if ($file['error'] !== UPLOAD_ERR_OK) {
    $error_messages = [
        UPLOAD_ERR_INI_SIZE   => 'File exceeds the server upload size limit.',
        UPLOAD_ERR_FORM_SIZE  => 'File exceeds the form upload size limit.',
        UPLOAD_ERR_PARTIAL    => 'The file was only partially uploaded.',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder on server.',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to the server.',
        UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the upload.',
    ];
    $msg = $error_messages[$file['error']] ?? 'An unknown upload error occurred.';
    $_SESSION['flash_message'] = $msg;
    $_SESSION['flash_type']    = 'error';
    header('Location: index.php');
    exit;
}

// ---- Validate file extension ----
$original_name = basename($file['name']);
$extension     = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

if (!in_array($extension, $allowed_types)) {
    $_SESSION['flash_message'] = 'Invalid file type "' . htmlspecialchars($extension) . '". Allowed types: JPG, JPEG, PNG, GIF.';
    $_SESSION['flash_type']    = 'error';
    header('Location: index.php');
    exit;
}

// ---- Validate MIME type (extra security check) ----
$allowed_mimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
$finfo         = finfo_open(FILEINFO_MIME_TYPE);
$mime_type     = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (!in_array($mime_type, $allowed_mimes)) {
    $_SESSION['flash_message'] = 'File content does not match a valid image type.';
    $_SESSION['flash_type']    = 'error';
    header('Location: index.php');
    exit;
}

// ---- Validate file size (max 2MB) ----
if ($file['size'] > $max_size) {
    $_SESSION['flash_message'] = 'File size exceeds the 2MB limit. Please upload a smaller image.';
    $_SESSION['flash_type']    = 'error';
    header('Location: index.php');
    exit;
}

// ---- Generate a unique filename to avoid overwriting existing files ----
$new_filename = uniqid('img_', true) . '.' . $extension;
$destination  = $upload_dir . $new_filename;

// ---- Move uploaded file to uploads directory ----
if (move_uploaded_file($file['tmp_name'], $destination)) {
    // Track this upload in the session
    $_SESSION['uploaded_images'][] = $new_filename;

    $_SESSION['flash_message'] = 'Image uploaded successfully! File saved as: ' . $new_filename;
    $_SESSION['flash_type']    = 'success';

    // Redirect to gallery to view the uploaded image
    header('Location: gallery.php');
    exit;
} else {
    $_SESSION['flash_message'] = 'Failed to save the uploaded file. Please check folder permissions.';
    $_SESSION['flash_type']    = 'error';
    header('Location: index.php');
    exit;
}
