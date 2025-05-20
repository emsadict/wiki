<?php
session_start();
// Database connection
$host = "localhost";
$user = "root"; // Change to your DB username
$password = ""; // Change to your DB password
$database = "membership_management"; // Change to your DB name

$conn = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true)
 {
    header("Location: adminlogin.php");
    exit();
}

$year = $_POST['year'] ?? 'all';
$category = $_POST['membership_category'] ?? 'all';
$state = $_POST['state'] ?? 'all';

$where = [];

if ($year !== 'all') {
    $where[] = "payments.year = '" . $conn->real_escape_string($year) . "'";
}
if ($category !== 'all') {
    $where[] = "payments.membership_category = '" . $conn->real_escape_string($category) . "'";
}
if ($state !== 'all') {
    $where[] = "biodata.state = '" . $conn->real_escape_string($state) . "'";
}

$whereClause = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$sql = "SELECT payments.membership_num, payments.membership_category, payments.year, 
               biodata.first_name, biodata.last_name, biodata.email, biodata.phone, 
               biodata.state, biodata.country
        FROM payments
        INNER JOIN biodata ON payments.membership_num = biodata.regno
        $whereClause
        ORDER BY biodata.state, payments.membership_category, payments.year";

$result = $conn->query($sql);

// Set headers to download as CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=filtered_members.csv');

$output = fopen('php://output', 'w');

if ($result->num_rows > 0) {
    // Write headers
    fputcsv($output, array_keys($result->fetch_assoc()));
    $result->data_seek(0); // Reset pointer

    // Write data
    while($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
} else {
    fputcsv($output, ["No records found."]);
    header('Location:tables-data.php');
}

fclose($output);
exit;
?>
