<?php
function log_audit($conn, $admin_user, $action) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $system_info = $_SERVER['HTTP_USER_AGENT'];

    // Optional: geolocation lookup
    $geo = "Unknown";
    $geoData = @file_get_contents("http://ip-api.com/json/$ip");
    if ($geoData) {
        $geoJson = json_decode($geoData, true);
        if ($geoJson['status'] === 'success') {
            $geo = $geoJson['city'] . ", " . $geoJson['country'];
        }
    }

    $stmt = $conn->prepare("INSERT INTO audit_trail 
        (admin_user, action, ip_address, geolocation, system_info) 
        VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $admin_user, $action, $ip, $geo, $system_info);
    $stmt->execute();
}
