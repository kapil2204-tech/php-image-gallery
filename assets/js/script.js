/**
 * script.js
 * Minimal JavaScript for the PHP Image Gallery project.
 * Displays selected file name and validates file selection on client side.
 */

// Show file name when user selects a file
document.addEventListener('DOMContentLoaded', function () {
    var fileInput = document.getElementById('image-input');
    var fileNameDisplay = document.getElementById('file-name');

    if (fileInput && fileNameDisplay) {
        fileInput.addEventListener('change', function () {
            if (fileInput.files.length > 0) {
                var fileName = fileInput.files[0].name;
                fileNameDisplay.textContent = 'Selected file: ' + fileName;
            } else {
                fileNameDisplay.textContent = '';
            }
        });
    }

    // Simple alert to confirm form submission
    var uploadForm = document.getElementById('upload-form');
    if (uploadForm) {
        uploadForm.addEventListener('submit', function () {
            var fileInput = document.getElementById('image-input');
            if (!fileInput || fileInput.files.length === 0) {
                alert('Please select an image file before uploading.');
                return false; // Prevent form submission if no file selected
            }
        });
    }
});
