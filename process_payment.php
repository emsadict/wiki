<?php
session_start();
include 'db.php';

if (!isset($_SESSION['membership_num']) || !isset($_GET['reference'])) {
    die("Unauthorized access.");
}

$membership_num = $_SESSION['membership_num'];
$reference = $_GET['reference'];

// 1. Verify with Paystack
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer sk_test_58c756f536a0913d05397d08e13bc36de0fdd644",
        "Cache-Control: no-cache",
    ],
]);
$response = curl_exec($curl);
curl_close($curl);

$resp = json_decode($response, true);
if (!$resp['status'] || $resp['data']['status'] !== 'success') {
    die("Payment verification failed.");
}

// 2. Fetch additional member details
$memberQuery = mysqli_query($conn, "SELECT first_name, last_name, phone, email, mem_category FROM biodata WHERE regno='$membership_num'");
if (!$memberQuery || mysqli_num_rows($memberQuery) === 0) {
    die("Member details not found.");
}

$member = mysqli_fetch_assoc($memberQuery);
$surname = mysqli_real_escape_string($conn, $member['first_name']);
$othernames = mysqli_real_escape_string($conn, $member['last_name']);
$phone = mysqli_real_escape_string($conn, $member['phone']);
$email = mysqli_real_escape_string($conn, $member['email']);
$mem_category = mysqli_real_escape_string($conn, $member['mem_category']);
$year = date('Y');
$payment_status = 'PAID';
$amount_paid = $resp['data']['amount'] / 100;
$payment_type = 'membership';
$date = date('Y-m-d H:i:s');

// 3. Insert into payments table
$insert = mysqli_query($conn, "INSERT INTO payments (
    membership_num, surname, othernames, phone, email, membership_category, year, amount, payment_type, date, transaction_id, payment_status
) VALUES (
    '$membership_num', '$surname', '$othernames', '$phone', '$email', '$mem_category', '$year',
    '$amount_paid', '$payment_type', '$date', '$reference', '$payment_status'
)");

if ($insert) {
    echo "✅ Payment successful and recorded. Thank you!";
    header("Location:update_biodata.php");
} else {
    echo "Payment was verified but failed to save. Contact support.";
}
?>
