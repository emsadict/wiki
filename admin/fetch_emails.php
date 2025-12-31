<?php
session_start();
include "../db.php";

header('Content-Type: application/json'); // ensure JSON output

$emails = [];

// Specific email
if (!empty($_POST['specific_email'])) {
    $emails[] = $_POST['specific_email'];
}

// Executive role from staff table (designation column)
if (!empty($_POST['executive_role'])) {
    $designation = $conn->real_escape_string($_POST['executive_role']);
    if ($designation === "ALL") {
        $res = $conn->query("SELECT email FROM staff");
    } else {
      $designation = $conn->real_escape_string($_POST['executive_role']);
if ($designation === "ALL") {
    $res = $conn->query("SELECT email FROM staff");
} else {
    $res = $conn->query("SELECT email FROM staff WHERE designation='$designation'");
}

    }
    while ($row = $res->fetch_assoc()) {
        $emails[] = $row['email'];
    }
}

// Membership category / state from biodata
if (!empty($_POST['mem_category']) || !empty($_POST['state'])) {
    $query = "SELECT email FROM biodata WHERE 1=1";
    if (!empty($_POST['mem_category']) && $_POST['mem_category'] != 'ALL') {
        $cat = $conn->real_escape_string($_POST['mem_category']);
        $query .= " AND mem_category='$cat'";
    }
    if (!empty($_POST['state']) && $_POST['state'] != 'ALL') {
        $state = $conn->real_escape_string($_POST['state']);
        $query .= " AND state='$state'";
    }
    $res = $conn->query($query);
    while ($row = $res->fetch_assoc()) {
        $emails[] = $row['email'];
    }
}

echo json_encode([
    'success' => count($emails) > 0,
    'emails' => $emails
]);

