<?php
/**
 * Session Configuration
 * Starts the session and initializes session variables for tracking uploads.
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize the uploaded images session array if it doesn't exist
if (!isset($_SESSION['uploaded_images'])) {
    $_SESSION['uploaded_images'] = [];
}
