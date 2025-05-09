<?php
session_start();
include 'db.php';

// Paystack Secret Key
$paystack_secret_key = 'sk_test_58c756f536a0913d05397d08e13bc36de0fdd644';

// Get reference and transaction_id from URL
$ref = $_GET['reference'];
$transaction_id = $_GET['transaction_id']; // This is YOUR generated ID

// Verify payment with Paystack
$url = "https://api.paystack.co/transaction/verify/" . rawurlencode($ref);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $paystack_secret_key",
    "Cache-Control: no-cache",
]);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if ($result['status'] && $result['data']['status'] == 'success') {
    // Payment was successful

    // Fetch payment record using transaction_id only
    $fetch_payment_query = "SELECT * FROM payments WHERE transaction_id = '$transaction_id' AND year = YEAR(CURDATE())";
    $fetch_payment_result = mysqli_query($conn, $fetch_payment_query);

    if (mysqli_num_rows($fetch_payment_result) == 0) {
        echo "Payment record not found in database.";
        exit();
    }

    $payment_data = mysqli_fetch_assoc($fetch_payment_result);

    $membership_num = $payment_data['membership_num'];
    $surname = $payment_data['surname'];
    $othernames = $payment_data['othernames'];
    $phone = $payment_data['phone'];
    $email = $payment_data['email'];
    $membership_category = $payment_data['membership_category'];
    $payment_type = $payment_data['payment_type'];
    $year = $payment_data['year'];
    $date = date("Y-m-d H:i:s");

    // Update the payment status in the payments table
    $update_payment_query = "UPDATE payments 
                             SET payment_status = 'PAID', 
                                 date = '$date' 
                             WHERE transaction_id = '$transaction_id' 
                             AND membership_num = '$membership_num' 
                             AND year = '$year'";

    if (!mysqli_query($conn, $update_payment_query)) {
        echo "Error updating payment record: " . mysqli_error($conn);
        exit();
    }

    // Insert into membership_accounts if not existing
    $check_account_query = "SELECT * FROM membership_accounts WHERE membership_num = '$membership_num'";
    $check_account_result = mysqli_query($conn, $check_account_query);

    if (mysqli_num_rows($check_account_result) == 0) {
        $hashed_password = password_hash($transaction_id, PASSWORD_BCRYPT);

        $insert_account_query = "INSERT INTO membership_accounts (membership_num, password, phone, date) 
                                 VALUES ('$membership_num', '$hashed_password', '$phone', '$date')";

        if (!mysqli_query($conn, $insert_account_query)) {
            echo "Error inserting account record: " . mysqli_error($conn);
            exit();
        }
    }

    // Insert into biodata if not existing
    $check_biodata_query = "SELECT * FROM biodata WHERE regno = '$membership_num'";
    $check_biodata_result = mysqli_query($conn, $check_biodata_query);

    if (mysqli_num_rows($check_biodata_result) == 0) {
        $insert_biodata_query = "INSERT INTO biodata (regno, first_name, last_name, email, phone, mem_category) 
                                 VALUES ('$membership_num', '$surname', '$othernames', '$email', '$phone', '$membership_category')";

        if (!mysqli_query($conn, $insert_biodata_query)) {
            echo "Error inserting biodata record: " . mysqli_error($conn);
            exit();
        }
    }

    // Clear session if any
    session_unset();
    session_destroy();

    // Redirect to login page
    header("Location: login.php?success=1");
    exit();

} else {
    echo "Payment Failed or Verification Error!";
}
?>
