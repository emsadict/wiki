<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "membership_management";
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tables = [];
$res = $conn->query("SHOW TABLES");
while ($row = $res->fetch_array()) {
    $tables[] = $row[0];
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="db_backup.csv"');

$out = fopen('php://output', 'w');

foreach ($tables as $table) {
    fputcsv($out, ["=== TABLE: $table ==="]);
    $result = $conn->query("SELECT * FROM `$table`");
    $fields = $result->fetch_fields();
    $headers = [];
    foreach ($fields as $f) $headers[] = $f->name;
    fputcsv($out, $headers);

    while ($row = $result->fetch_assoc()) {
        fputcsv($out, $row);
    }
    fputcsv($out, []); // blank line between tables
}

fclose($out);
exit;
?>
