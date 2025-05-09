<?php 
session_start();
include "../db.php";
// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: adminlogin.php");
    exit();
}

// Database connection
//$conn = new mysqli("localhost", "ehqatfmh_oasis", "oasis 2024@@", "ehqatfmh_oasis_college_database");
//if ($conn->connect_error) {
  //  die("Connection failed: " . $conn->connect_error);
//}

// Initialize variables
$message = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $username = $conn->real_escape_string(trim($_POST['username']));
    $new_password = $conn->real_escape_string(trim($_POST['new_password']));
    $re_new_password = $conn->real_escape_string(trim($_POST['renew_password']));

    // Validate form inputs
    if (empty($username) || empty($new_password) || empty($re_new_password)) {
        $message = "<div class='alert alert-danger'>All fields are required.</div>";
    } elseif ($new_password !== $re_new_password) {
        $message = "<div class='alert alert-danger'>Passwords do not match.</div>";
    } else {
        // Hash the new password using MD5
        // $hashed_password = md5($new_password);
        $new_password=$new_password;
        // Check if user exists
        $checkUserQuery = "SELECT * FROM membership_accounts  WHERE membership_num = '$username'";
        $result = $conn->query($checkUserQuery);

        if ($result && $result->num_rows > 0) {
            // Update the password
            $updateQuery = "UPDATE membership_accounts SET password = '$new_password' WHERE membership_num = '$username'";
            if ($conn->query($updateQuery) === TRUE) {
                $message = "<div class='alert alert-success'>Password updated successfully for user: $username.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Error updating password: " . $conn->error . "</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>User not found.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Reset User Account - Wikimedia </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Nunito|Poppins" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- Header -->
  <?php include_once("header.php"); ?>
  <!-- End Header -->

  <!-- Sidebar -->
  <?php include_once("sidebar.php"); ?>
  <!-- End Sidebar -->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Reset Student Account</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admindashboad.php">Dashboard</a></li>
          <li class="breadcrumb-item">User Account</li>
          <li class="breadcrumb-item active">Change Password</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-6 mx-auto">
          <div class="card">
            <div class="card-body pt-3">
              <h5 class="card-title">Change Password</h5>
              <?php if ($message): ?>
                <?= $message ?>
              <?php endif; ?>
              <form method="POST" action="">
                <div class="row mb-3">
                  <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="username" type="text" class="form-control" id="username" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="new_password" type="password" class="form-control" id="new_password" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renew_password" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renew_password" type="password" class="form-control" id="renew_password" required>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- Footer -->
  <?php include_once("footer.php"); ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>
