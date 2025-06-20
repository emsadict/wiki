<?php
$conn = new mysqli("localhost", "root", "", "membership_management");

if ($_GET["id"]) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM payments WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Receipt</title>
            <style>
                body { font-family: Arial, sans-serif; }
                .receipt { border: 1px solid #000; padding: 20px; width: 300px; }
                .receipt h2 { text-align: center; }
                .print-btn { margin-top: 20px; text-align: center; }
            </style>
        </head>
        <body>
            <div class="receipt">
                <h2>Payment Receipt</h2>
                <p><strong>Name:</strong> <?php echo $row["surname"] . " " . $row["othernames"]; ?></p>
                <p><strong>Email:</strong> <?php echo $row["email"]; ?></p>
                <p><strong>Phone:</strong> <?php echo $row["phone"]; ?></p>
                <p><strong>Amount:</strong> <?php echo $row["amount"]; ?> NGN</p>
                <p><strong>Transaction ID:</strong> <?php echo $row["transaction_id"]; ?></p>
                <p><strong>Payment Type:</strong> <?php echo $row["payment_type"]; ?></p>
                <p><strong>Date:</strong> <?php echo $row["date"]; ?></p>
                <p><strong>Status:</strong> <?php echo $row["payment_status"]; ?></p>

                <div class="print-btn">
                    <button onclick="window.print()">Print Receipt</button>
                </div>
            </div>
        </body>
        </html>

        <?php
    } else {
        echo "Receipt not found!";
    }
} else {
    echo "Invalid request!";
}
?>
