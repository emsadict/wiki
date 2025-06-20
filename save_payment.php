<?php
session_start();
$conn = new mysqli("localhost", "root", "", "membership_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surname = $_POST["surname"];
    $othernames = $_POST["othernames"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $amount = $_POST["amount"];
    $transaction_id = $_POST["transaction_id"];
    $date = date("Y-m-d H:i:s");
    $year = date("Y"); // Automatically set the year field
    $payment_type = "Donation"; // Set payment type to "Donation"

    // Paystack secret key (store securely in .env)
    $secret_key = "sk_test_58c756f536a0913d05397d08e13bc36de0fdd644"; // Replace with your actual Paystack secret key

    // Verify transaction with Paystack
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.paystack.co/transaction/verify/" . $transaction_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $secret_key",
        "Content-Type: application/json"
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response);

    // Check if payment was successful
    if ($result->status && $result->data->status === "success") {
        $payment_status = "PAID"; // Set status to PAID for successful payments
        $_SESSION['transaction_id'] = $transaction_id;
    } else {
        $payment_status = "UNPAID"; // Set status to UNPAID for failed transactions
    }

    // Save payment in the database
    $sql = "INSERT INTO payments (surname, othernames, email, phone, amount, transaction_id, date, payment_status, year, payment_type) 
            VALUES ('$surname', '$othernames', '$email', '$phone', '$amount', '$transaction_id', '$date', '$payment_status', '$year', '$payment_type')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to donate.php with a success message
        
        $_SESSION['success_message'] = "Your donation was successful! <a href='receipt.php?transaction_id=$transaction_id'>Print your receipt here</a>";
        header("Location: donate.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
