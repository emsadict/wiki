<?php
session_start();

// DB connection
$host = "localhost";
$user = "root";
$password = "";
$database = "membership_management";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: adminlogin.php");
    exit();
}

// Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Validate ID
if ($id <= 0) {
    die("Invalid ID.");
}

// Optional: Fetch and delete passport image if stored
$result = $conn->query("SELECT passport FROM staff WHERE id = $id");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row['passport']) && file_exists("uploads/" . $row['passport'])) {
        unlink("uploads/" . $row['passport']);
    }
}

// Delete record
$stmt = $conn->prepare("DELETE FROM staff WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: manaexco.php?deleted=1");
    exit();
} else {
    echo "Error deleting record: " . $stmt->error;
}
?>
