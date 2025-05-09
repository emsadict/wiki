<?php
session_start();
include 'db.php'; // Include your DB connection

$errors = [];

// Sanitize and validate POST data
$surname = trim($_POST['surname'] ?? '');
$othernames = trim($_POST['othernames'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$membership_category = trim($_POST['payment_category'] ?? '');

$payment_type = trim($_POST['payment_type'] ?? '');
$amount = trim($_POST['amount'] ?? '');
$membership_num = trim($_POST['membership_num'] ?? '');
$year = trim($_POST['year'] ?? date('Y'));

// Validate required fields
if (empty($surname)) $errors[] = "Surname is required.";
if (empty($othernames)) $errors[] = "Other names are required.";
if (empty($phone)) $errors[] = "Phone number is required.";
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
if (empty($membership_category)) $errors[] = "Membership category is required.";
if (empty($payment_type)) $errors[] = "Payment type is required.";
if (empty($amount) || !is_numeric($amount)) $errors[] = "Valid amount is required.";
if (empty($membership_num)) $errors[] = "Membership number is required.";

// If validation fails, redirect back
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: register.php");
    exit();
}

// ✅ Check if membership number OR phone already exists in membership_accounts
$check_member_query = "SELECT * FROM membership_accounts 
                       WHERE membership_num = '$membership_num' 
                       OR phone = '$phone' 
                       LIMIT 1";
$member_result = mysqli_query($conn, $check_member_query);

if (mysqli_num_rows($member_result) > 0) {
    $_SESSION['errors'][] = "Membership number or phone number already exists. Each member can only have one account.";
    header("Location: register.php");
    exit();
}

// ✅ Check if this person has ALREADY PAID for this type and year
$paid_check_query = "SELECT * FROM payments 
                     WHERE membership_num = '$membership_num' 
                     AND payment_type = '$payment_type' 
                     AND year = '$year' 
                     AND payment_status = 'PAID'";
$paid_result = mysqli_query($conn, $paid_check_query);
if (mysqli_num_rows($paid_result) > 0) {
    $_SESSION['errors'][] = "You have already completed this payment for the selected year.";
    header("Location: register.php");
    exit();
}

// ✅ Allow multiple unpaid attempts (do not block)
$transaction_id = "WUGN" . date("Y") . rand(1000, 9999);

// Insert into payments table (as unpaid attempt)
$insert_payment_query = "INSERT INTO payments (
    membership_num, membership_category, phone, email, 
    payment_type, amount, transaction_id, surname, othernames, 
    payment_status, year
) VALUES (
    '$membership_num', '$payment_type', '$phone', '$email',
    '$membership_category', '$amount', '$transaction_id', '$surname', '$othernames',
    'UNPAID', '$year'
)";

if (!mysqli_query($conn, $insert_payment_query)) {
    $_SESSION['errors'][] = "Error creating payment: " . mysqli_error($conn);
    header("Location: register.php");
    exit();
}

// Paystack Public Key
$paystack_public_key = "pk_test_1d2af7bafefdf00bf8abbb18740392a67a7530ed";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting to Paystack...</title>
</head>
<body>

<form id="paymentForm">
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
    let handler = PaystackPop.setup({
        key: '<?php echo $paystack_public_key; ?>',
        email: '<?php echo htmlspecialchars($email); ?>',
        amount: <?php echo (int)$amount * 100; ?>, // Convert to kobo
        currency: 'NGN',
        ref: 'WUGN_' + Math.floor((Math.random() * 1000000000) + 1),
        metadata: {
            custom_fields: [
                {
                    display_name: "Phone Number",
                    variable_name: "phone",
                    value: "<?php echo htmlspecialchars($phone); ?>"
                },
                {
                    display_name: "Membership Number",
                    variable_name: "membership_num",
                    value: "<?php echo htmlspecialchars($membership_num); ?>"
                }
            ]
        },
        callback: function(response) {
            // Redirect to callback page with reference and transaction ID
            window.location.href = "paystack-callback.php?reference=" + response.reference + "&transaction_id=<?php echo $transaction_id; ?>";
        },
        onClose: function() {
            alert('Transaction was cancelled');
            window.location.href = "register.php";
        }
    });
    handler.openIframe();
    </script>
</form>

</body>
</html>
