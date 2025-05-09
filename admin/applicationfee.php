<?php 
session_start();
    include_once("../fun.inc.php");
    if(!isset($_SESSION['spgs_auth']))
    {

    header("location: index.php");
    }
   else{

    $spgs_auth=$_SESSION['spgs_auth'];

    $user=$spgs_auth[1];

      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Payment Records </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <?php include_once("header.php"); ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include_once("sidebar.php"); ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>View Application Fee Payment Records</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admindashboad.php">Dashboard</a></li>
          <li class="breadcrumb-item">Payments</li>
          <li class="breadcrumb-item active">Application Fee Payment Records</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Application Fee Payment Records</h5>

              <!-- Search Form -->
              <form method="POST" action="">
                <div class="row mb-3">
                  <div class="col-md-6">
                    <input type="text" name="regno" class="form-control" placeholder="Enter Registration Number" value="<?php echo isset($_POST['regno']) ? $_POST['regno'] : ''; ?>">
                  </div>
                  <div class="col-md-3">
                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                  </div>
                </div>
              </form>
              <!-- End Search Form -->

              <!-- Table -->
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Reg No</th>
                    <th>Surname</th>
                    <th>Other Names</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Transaction ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Database connections
                  $conn1 = new mysqli("localhost", "root", "", "oasis_college_database");
                  $conn2 = new mysqli("localhost", "root", "", "oasis_college_payments");

                  if ($conn1->connect_error || $conn2->connect_error) {
                    die("Connection failed: " . $conn1->connect_error . " / " . $conn2->connect_error);
                  }

                 $query = "SELECT regno, surname, onames, phoneno, email, amount, transaction_id, session, status, payment_date 
          FROM oasis_college_payments.payment  WHERE status = 'PAID' AND  payment_type = 'Application Fee'";

if (isset($_POST['search']) && !empty($_POST['regno'])) {
    $regno = $conn2->real_escape_string($_POST['regno']); // Use conn2 for escaping since it's used in the query
    $query .= " AND regno = '$regno'";
}

$query .= " ORDER BY faculty, level, payment_date";


                  $result = $conn2->query($query);
                  $i = 0;
                  if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>". $i = $i + 1;"</td>";
                      echo "<td>" . $row['regno'] . "</td>";
                      echo "<td>" . $row['surname'] . "</td>";
                      echo "<td>" . $row['onames'] . "</td>";
                      echo "<td>" . $row['phoneno'] . "</td>";
                      echo "<td>" . $row['email'] . "</td>";
                      echo "<td>" . $row['transaction_id'] . "</td>";
                       echo "<td>" . $row['amount'] . "</td>";
                      echo "<td>" . $row['status'] . "</td>";
                      echo "<td>" . $row['payment_date'] . "</td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='7' class='text-center'>No records found</td></tr>";
                  }

                  $conn1->close();
                  $conn2->close();
                  ?>
                </tbody>
              </table>
              <!-- End Table -->

            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include_once("footer.php"); ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
