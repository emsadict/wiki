<?php
session_start();
header('Content-Type: application/json');

// 1. Database Connection (using your existing setup)
$host = "localhost";
$user = "root";
$password = "";
$database = "membership_management";
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Database connection failed']));
}

// 2. Admin Authentication (using your existing session check)
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    die(json_encode(['error' => 'Unauthorized: Admin login required']));
}

// 3. CSRF Protection (recommended addition)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SERVER['HTTP_X_CSRF_TOKEN']) || 
        !isset($_SESSION['csrf_token']) ||
        $_SERVER['HTTP_X_CSRF_TOKEN'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        die(json_encode(['error' => 'CSRF token validation failed']));
    }
}

// 4. File Upload Handling (secure version)
$upload_dir = __DIR__ . '/uploads/';
$max_size = 2 * 1024 * 1024; // 2MB
$allowed_types = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/gif' => 'gif',
    'image/webp' => 'webp'
];

try {
    // Validate upload directory
    if (!file_exists($upload_dir)) {
        if (!mkdir($upload_dir, 0755, true)) {
            throw new Exception('Could not create upload directory');
        }
    }

    // Validate file upload
    if (!isset($_FILES['file']['error']) || is_array($_FILES['file']['error'])) {
        throw new Exception('Invalid file parameters');
    }

    // Check for upload errors
    switch ($_FILES['file']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new Exception('No file was uploaded');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new Exception('File exceeds size limit');
        default:
            throw new Exception('File upload error');
    }

    // Validate file size
    if ($_FILES['file']['size'] > $max_size) {
        throw new Exception('File too large (max 2MB)');
    }

    // Validate file type
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($_FILES['file']['tmp_name']);

    if (!array_key_exists($mime_type, $allowed_types)) {
        throw new Exception('Invalid file type');
    }

    // Generate secure filename
    $extension = $allowed_types[$mime_type];
    $filename = sprintf('%s.%s', bin2hex(random_bytes(8)), $extension);
    $destination = $upload_dir . $filename;

    // Verify image content
    if (!getimagesize($_FILES['file']['tmp_name'])) {
        throw new Exception('Invalid image file');
    }

    // Move uploaded file
    if (!move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
        throw new Exception('Failed to save file');
    }

    // Return success response
    echo json_encode([
        'location' => '/uploads/' . $filename,
        'filename' => $filename
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}

$conn->close();
?>