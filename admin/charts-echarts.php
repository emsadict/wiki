<?php 
session_start();
include "../db.php";
// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: adminlogin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Reprint Student Receipts</title>
  <link href="assets/img/favicon.ico" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <?php include_once("header.php"); ?>
  <?php include_once("sidebar.php"); ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Reprint Student Receipts</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admindashboad.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Reprint User Receipts</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">User Receipts</h5>

              <form method="POST" action="">
                <div class="mb-3">
                  <label for="regno" class="form-label">Enter User Registration Number</label>
                  <input type="text" class="form-control" id="regno" name="regno" placeholder="User Registration Number" required>
                </div>
                <button type="submit" class="btn btn-primary">Load Invoices</button>
              </form>

              <div class="table-responsive mt-4">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['regno'])) {
                    $regno = trim($_POST['regno']);
                    $conn = new mysqli("localhost", "root", "", "membership_management");
                    
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT membership_num, membership_category, surname, othernames, payment_type, amount, year, email, phone, payment_status, date, transaction_id 
                            FROM payments 
                            WHERE membership_num = ? AND payment_status = 'PAID'";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $regno);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        echo "<table class='table'>
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Reg No</th>
                                        <th>Surname</th>
                                        <th>Other Names</th>
                                        <th>Fee Type</th>
                                        <th>Amount</th>
                                        <th>Year</th>
                                        <th>Category</th>
                                        
                                        <th>Date</th>
                                        <th>Transaction ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        $sn = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$sn}</td>
                                    <td>{$row['membership_num']}</td>
                                    <td>{$row['surname']}</td>
                                    <td>{$row['othernames']}</td>
                                    <td>{$row['payment_type']}</td>
                                    <td>{$row['amount']}</td>
                                    <td>{$row['year']}</td>
                                    <td>{$row['membership_category']}</td>
                                    
                                    <td>{$row['date']}</td>
                                    <td>{$row['transaction_id']}</td>
                                    <td>
                                        <a href='receiptadminprint.php?membership_num={$regno}&tid={$row['transaction_id']}' class='btn btn-success btn-sm' target='_blank'>Print Receipt</a>
                                    </td>
                                  </tr>";
                            $sn++;
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<div class='alert alert-warning'>No paid invoices found for this  user.</div>";
                    }
                    $stmt->close();
                    $conn->close();
                }
                ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include_once("footer.php"); ?>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>
