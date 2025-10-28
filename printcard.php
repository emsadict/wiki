<?php
include 'db_connect.php';

if (!isset($_GET['regno'])) {
    echo "No registration number provided.";
    exit();
}

$regno = mysqli_real_escape_string($conn, $_GET['regno']);
$current_year = date("Y");

// Fetch details
$sql = "SELECT * FROM biodata WHERE regno = '$regno'";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) === 0) {
    echo "Member not found.";
    exit();
}
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Membership Card</title>
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.95);
            border: 2px solid black;
            padding: 20px 30px;
            width: 400px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.3);
            text-align: center;
            position: relative;
        }
        .close-button {
    margin-top: 10px;
    background-color: #e74c3c;
    border: none;
    color: white;
    padding: 8px 16px;
    font-size: 14px;
    cursor: pointer;
    border-radius: 4px;
}
.close-button:hover {
    background-color: #c0392b;
}


        .card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 2px solid black;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .print-button {
            margin-top: 20px;
             background-color:rgb(24, 165, 123);
    border: none;
    color: white;
    padding: 8px 16px;
    font-size: 14px;
    cursor: pointer;
    border-radius: 4px;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            .card, .card * {
                visibility: visible;
            }
            .card {
                position: absolute;
                top: 0;
                left: 0;
                width: 80%;
                box-shadow: none;
                margin: 0;
            }
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="card">
    <img src="uploads/passports/<?php echo $user['passport']; ?>" alt="Passport">
    <h2>Membership Card</h2>
    <p><strong>Name:</strong> <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></p>
    <p><strong>Membership No:</strong> <?php echo strtoupper($user['username']); ?></p>
    <p><strong>Category:</strong> <?php echo $user['mem_category']; ?></p>
    <p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>
    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
    <p><strong>Country:</strong> <?php echo $user['country']; ?></p>
    <p><strong>State:</strong> <?php echo $user['state']; ?></p>
    <p><strong>Gender:</strong> <?php echo $user['gender']; ?></p>
    <p><strong>Year:</strong> <?php echo $current_year; ?></p>
    <button class="print-button" onclick="window.print()">Print Card</button>
    <button class="close-button" onclick="window.close()">close</button>
</div>

</body>
</html>
