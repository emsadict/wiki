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

  $conn = new mysqli("localhost", "root", "", "oasis_college_database");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tables / General - NiceAdmin Bootstrap Template</title>
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

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 10 2024 with Bootstrap v5.3.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
      <h1>View Course Registration</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admindashboad.php">Dashboard</a></li>
          <li class="breadcrumb-item">Student Registration</li>
          <li class="breadcrumb-item active">Course Registration</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Course DE-Registartion</h5>

              <!-- Default Table -->
              
              <form method="POST" action="">
  <div class="row mb-3">
    <div class="col-md-6">
      <input type="text" name="matricno" class="form-control" placeholder="Enter Matric Number" value="<?php echo isset($_POST['matricno']) ? $_POST['matricno'] : ''; ?>">
    </div>
    <div class="col-md-3">
      <button type="submit" name="search" class="btn btn-primary">Search</button>
    </div>
  </div>
</form>

<!-- Table -->
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Matric No</th>
      <th>Level</th>
      <th>Session</th>
      <th>Semester</th>
      <th>Course Code</th>
      <th>Course Title</th>
      <th>Units</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Database connection
    $conn = new mysqli("localhost", "root", "", "oasis_college_database");

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Handle Delete Request
    if (isset($_POST['delete'])) {
      $matricno = $conn->real_escape_string($_POST['matricno']);
      $course_column = $conn->real_escape_string($_POST['course_column']);
      
      $delete_query = "UPDATE course_reg SET $course_column = '|||' WHERE matricno = '$matricno'";
      $conn->query($delete_query);
    }

    // Handle Search Request
    if (isset($_POST['search']) && !empty($_POST['matricno'])) {
      $matricno = $conn->real_escape_string($_POST['matricno']);

      $query = "SELECT * FROM course_reg WHERE matricno = '$matricno'";
      $result = $conn->query($query);

      if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_units = 0;
        $has_courses = false;

        for ($i = 1; $i <= 20; $i++) { // Iterate through course1 to course20 columns
          $course_column = "course$i";
          $course = $row[$course_column];
          
          if (!empty($course) && strpos($course, '|') !== false) { // Check for valid course data
            list($course_code, $course_title, $units, $status) = explode('|', $course);
            if (!empty($course_code) && !empty($course_title) && !empty($units) && !empty($status)) {
              $total_units += (int)$units;
              $has_courses = true;
              echo "<tr>
                      <td>{$row['matricno']}</td>
                      <td>{$row['level']}</td>
                      <td>{$row['session']}</td>
                      <td>{$row['semester']}</td>
                      <td>$course_code</td>
                      <td>$course_title</td>
                      <td>$units</td>
                      <td>$status</td>
                      <td>
                        <form method='POST' action=''>
                          <input type='hidden' name='matricno' value='$matricno'>
                          <input type='hidden' name='course_column' value='$course_column'>
                          <button type='submit' name='delete' class='btn btn-danger btn-sm'>Delete</button>
                        </form>
                      </td>
                    </tr>";
            }
          }
        }

        if ($has_courses) {
          echo "<tr>
                  <td colspan='6' class='text-end'><strong>Total Units:</strong></td>
                  <td colspan='3'><strong>$total_units</strong></td>
                </tr>";
        } else {
          echo "<tr><td colspan='9' class='text-center'>No valid courses found</td></tr>";
        }
      } else {
        echo "<tr><td colspan='9' class='text-center'>No records found</td></tr>";
      }
    } else {
      echo "<tr><td colspan='9' class='text-center'>Enter Matric Number to Search</td></tr>";
    }

    $conn->close();
    ?>
  </tbody>
</table>


              <!-- End Table -->

              <!-- End Table -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
              <!-- End Default Table Example -->
            </div>
          </div>

        </div>

            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php 
    include_once("footer.php");



   ?>
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
