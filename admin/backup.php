<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "membership_management";
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all tables
$tables = [];
$res = $conn->query("SHOW TABLES");
while ($row = $res->fetch_array()) {
    $tables[] = $row[0];
}

// Build SQL dump
$output = "";
foreach ($tables as $table) {
    $result = $conn->query("SELECT * FROM `$table`");
    $num_fields = $result->field_count;

    $output .= "DROP TABLE IF EXISTS `$table`;\n";
    $row2 = $conn->query("SHOW CREATE TABLE `$table`")->fetch_row();
    $output .= $row2[1] . ";\n\n";

    while ($row = $result->fetch_assoc()) {
        $vals = array_map([$conn, 'real_escape_string'], array_values($row));
        $output .= "INSERT INTO `$table` VALUES ('" . implode("','", $vals) . "');\n";
    }
    $output .= "\n\n";
}

// Send as download
header('Content-Type: application/sql');
header('Content-Disposition: attachment; filename="db_backup.sql"');
echo $output;
exit;
?>
