<?php
session_start();
include 'db.php'; // Include your database connection

// Validate POST data
$errors = [];

$surname = trim($_POST['surname'] ?? '');
$othernames = trim($_POST['othernames'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$membership_category = trim($_POST['membership_category'] ?? '');
$payment_type = trim($_POST['payment_type'] ?? '');
$amount = trim($_POST['amount'] ?? '');
$membership_num = trim($_POST['membership_num'] ?? '');
$year = trim($_POST['year'] ?? '');  // Get the hidden year value

// Validate required fields...
if (empty($surname)) {
    $errors[] = "Surname is required.";
}
if (empty($othernames)) {
    $errors[] = "Other Names are required.";
}
// (other validation checks)

// If there are errors, redirect back to index.php
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: index.php');
    exit();
}

// No errors, continue with Paystack payment setup

// Use the amount user selected
$amount = (float) $_POST['amount'] * 100; // Paystack expects amount in kobo

// Insert into payments table with status "UNPAID"
$payment_status = 'UNPAID'; // Set initial payment status as 'UNPAID'
$insert_payment_query = "INSERT INTO payments (membership_num, membership_category, phone, email, payment_type, amount, transaction_id, surname, othernames, payment_status, year) 
                         VALUES ('$membership_num','$membership_category','$phone','$email','$payment_type','$amount', 'transaction_id','$surname', '$othernames', '$payment_status', '$year')";

// Continue with the rest of the code...





<?php
session_start();
include 'db.php'; // Include your database connection

// Validate POST data
$errors = [];

$surname = trim($_POST['surname'] ?? '');
$othernames = trim($_POST['othernames'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$membership_category = trim($_POST['membership_category'] ?? '');
$payment_type =  trim($_POST['payment_type'] ?? '');
$amount = trim($_POST['amount'] ?? '');
$membership_num = trim($_POST['membership_num'] ?? '');
$year = trim($_POST['year'] ?? '');

// Validate input fields as before...

// Check if payment already exists for this payment type and year
$check_payment_query = "SELECT * FROM payments WHERE membership_num = '$membership_num' AND payment_type = '$payment_type' AND year = '$year' AND payment_status = 'UNPAID'";
$check_payment_result = mysqli_query($conn, $check_payment_query);

if (mysqli_num_rows($check_payment_result) > 0) {
    $_SESSION['errors'][] = "Payment for this membership type already exists for the selected year.";
    header('Location: index.php');
    exit();
}

// Get the current year
$year = date("Y");

// Generate a random 4-digit number
$randomNumber = rand(1000, 9999);

// Construct the transaction ID in the desired format
$transaction_id = "WUGN" . $year . $randomNumber;

// Insert into payments table with status "UNPAID"
$payment_status = 'UNPAID'; // Set initial payment status as 'UNPAID'
$insert_payment_query = "INSERT INTO payments (membership_num, membership_category, phone, email, payment_type, amount, transaction_id, surname, othernames, payment_status, year) 
                         VALUES ('$membership_num', '$membership_category', '$phone', '$email', '$payment_type', '$amount', '$transaction_id', '$surname', '$othernames', '$payment_status', '$year')";

if (!mysqli_query($conn, $insert_payment_query)) {
    $_SESSION['errors'][] = "Error inserting payment record: " . mysqli_error($conn);
    header('Location: index.php');
    exit();
}

// Paystack Public Key (as before)
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
        amount: <?php echo (int) $amount; ?>,
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
            // Payment successful
            window.location.href = "paystack-callback.php?reference=" + response.reference + "&transaction_id=<?php echo $transaction_id; ?>";
        },
        onClose: function() {
            alert('Payment cancelled.');
            window.location.href = "index.php";
        }
    });
    handler.openIframe();
    </script>
</form>

</body>
</html>
