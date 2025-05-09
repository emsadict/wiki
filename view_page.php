<?php
require 'db_connect.php';

$pg_id = $_GET['id'];
$page = $conn->query("SELECT * FROM pages_table WHERE pg_id = $pg_id")->fetch_assoc();

$category = $page['pg_category'];

if ($category == "VCO-unit") {
    require 'templates/vco_template.php';
} elseif ($category == "Directorates") {
    require 'templates/directorate_template.php';
} else {
    require 'templates/default_template.php';
}
?>
