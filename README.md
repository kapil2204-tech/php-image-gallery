# PHP Image Upload and Gallery Application

| Field | Details |
|------|--------|
| Name | Kapil Chauhan |
| Enrollment Number | 250905091004 |
| Subject | Fundamentals of Web Development (FWD) |
| ALA | PHP File Upload and Image Gallery |

## Project Overview

This is a simple PHP Image Upload and Gallery Application created for an academic assignment. It demonstrates core PHP concepts including file handling, form processing, input validation, and session management. The project is built using pure PHP, HTML, CSS, and vanilla JavaScript — no frameworks or external libraries.

---

## Features Implemented

- **Image Upload Form** – A clean HTML form that accepts image file uploads via POST request.
- **File Validation** – Server-side validation for file type, MIME type, and file size.
- **PHP File Upload Handling** – Uses `move_uploaded_file()` to securely store uploaded images in the `uploads/` directory.
- **Session Tracking** – PHP sessions track which images were uploaded during the current user session.
- **Dynamic Gallery Display** – The gallery page dynamically reads all images from the `uploads/` folder and renders them in a responsive grid.

---

## Validation Rules

| Rule | Details |
|------|---------|
| Allowed file types | JPG, JPEG, PNG, GIF |
| Maximum file size | 2 MB |
| MIME type check | Verifies actual file content matches image type |

Files that do not meet these rules are rejected with a clear error message.

---

## Folder Structure

```
php-image-gallery/
├── config/
│   └── session.php          # Session initialization and tracking
├── uploads/                 # Uploaded images are stored here
├── assets/
│   ├── css/
│   │   └── style.css        # Stylesheet
│   └── js/
│       └── script.js        # Minimal JavaScript
├── includes/
│   ├── header.php           # Reusable header with navigation
│   └── footer.php           # Reusable footer
├── index.php                # Upload form page
├── upload.php               # Upload processing logic
├── gallery.php              # Image gallery page
└── README.md                # This file
```

---

## How to Run the Project

1. **Install Laragon** – Download and install Laragon from [laragon.org](https://laragon.org).
2. **Place the project** – Copy the `php-image-gallery` folder into:
   ```
   C:\laragon\www\
   ```
3. **Start Laragon** – Open Laragon and click **Start All** to start Apache and MySQL.
4. **Open in browser** – Visit:
   ```
   http://localhost/php-image-gallery
   ```

> **Note:** The `uploads/` folder must be writable by the web server. On a local Laragon setup this is typically fine out of the box.

---

## Screenshots for Submission

Capture the following screenshots for your university portal submission:

1. **Upload form page** – Open `http://localhost/php-image-gallery` and screenshot the form.
2. **Image upload success** – Upload a valid image and screenshot the gallery page with the success message.
3. **Gallery page displaying images** – Screenshot the gallery grid with your uploaded images.
4. **Validation error example** – Try uploading an invalid file (e.g., a `.txt` file or a file larger than 2MB) and screenshot the error message.

---

## GitHub Preparation

Ensure the repository contains:

- Complete source code (all PHP, CSS, JS files)
- The `uploads/` folder (can be empty)
- This `README.md`

Keep file names clean and organized as shown in the folder structure above.

---

## Technologies Used

- PHP (Core PHP — no frameworks)
- HTML5
- CSS3
- Vanilla JavaScript
