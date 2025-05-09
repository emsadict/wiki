
<?php
session_start();
// Database connection
$host = "localhost";
$user = "root"; // Change to your DB username
$password = ""; // Change to your DB password
$database = "membership_management"; // Change to your DB name

$conn = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true)
 {
    header("Location: adminlogin.php");
    exit();
}


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<?php include_once("header.php"); ?>

<!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include_once("sidebar.php"); ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admindashboad.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
            
              <!-- Customers Card -->
            
            <!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                

                <div class="card-body">
      <h5 class="card-title">Membership Registration by Gender <span>| Today</span></h5>
      
    </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- End Top Selling -->

          </div>
        </div>
            
            
            <!-- End Reports -->

            <!-- Recent Sales -->
          
            
            
           

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
     
        

        
        
        <div class="row">
    <!-- Left side column -->
    <div class="col-lg-6">
        <div class="card recent-sales overflow-auto">
            

            <div class="card-body">
                <h5 class="card-title">Membership Registration as of <span>| Today</span> By Category</h5>
                <canvas id="barChart" style="max-height: 400px;"></canvas>
              
              
            </div>
        </div>
    </div>

    <!-- Right side column -->
    <div class="col-lg-6">
        <div class="card">
           

            <div class="card-body pb-0">
                <h5 class="card-title">Total Amount PAID &amp; Updates <span>| Today</span></h5>
                <div class="news">
                    <canvas id="lineChart" style="max-height: 400px;"></canvas>
                   

                </div>
            </div>
        </div>
    </div>
</div>
        
        
        
        


        
        
        
        
        
        
        
        <!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->
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