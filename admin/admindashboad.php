
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

// Fetch membership_category data and count each category
$sql = "SELECT mem_category, COUNT(*) AS count FROM biodata GROUP BY mem_category";
$result = $conn->query($sql);

$categories = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $categories[] = $row['mem_category'];
    $counts[] = $row['count'];
}
// STEP 2: Query gender counts
$sql = "SELECT gender, COUNT(*) as count FROM biodata GROUP BY gender";
$result = $conn->query($sql);

$genders = [];
$genderCounts = [];

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $genders[] = $row["gender"];
    $genderCounts[] = $row["count"];
  }
}

// Query to get payment totals grouped by payment_type
$queryl = "SELECT payment_type, SUM(amount) AS total_amount FROM payments  WHERE payment_status='PAID'GROUP BY payment_type";
$resultl = mysqli_query($conn, $queryl);

$categoriesl = [];
$amountsl = [];

while ($row = mysqli_fetch_assoc($resultl)) {
    $categoriesl[] = $row['payment_type'];
    $amountsl[] = $row['total_amount'];
}

// Encode data for JavaScript
$categories_jsonl = json_encode($categoriesl);
$amounts_jsonl = json_encode($amountsl);
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
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
            <?php include_once("card.php");?>
              <!-- Customers Card -->
            
            <!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
      <h5 class="card-title">Membership Registration by Gender <span>| Today</span></h5>
      <canvas id="pieChart" style="max-height: 400px;"></canvas>
      <script>
        document.addEventListener("DOMContentLoaded", () => {
          new Chart(document.querySelector('#pieChart'), {
            type: 'pie',
            data: {
              labels: <?php echo json_encode($genders); ?>, // e.g. ['Male', 'Female']
              datasets: [{
                label: 'Registered Members',
                data: <?php echo json_encode($genderCounts); ?>, // e.g. [120, 95]
                backgroundColor: [
                  'rgba(54, 162, 235, 0.5)', // Blue
                  'rgba(255, 99, 132, 0.5)'  // Pink
                ],
                borderColor: [
                  'rgb(54, 162, 235)',
                  'rgb(255, 99, 132)'
                ],
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    precision: 0
                  }
                }
              }
            }
          });
        });
      </script>
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
            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start"><h6>Filter</h6></li>
                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
            </div>

            <div class="card-body">
                <h5 class="card-title">Membership Registration as of <span>| Today</span> By Category</h5>
                <canvas id="barChart" style="max-height: 400px;"></canvas>
              
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#barChart'), {
                    type: 'bar',
                    data: {
                     // labels: ['Doctorate', 'Masters', 'PGD'],
                      labels: <?php echo json_encode($categories); ?>,
                      datasets: [{
                        label: 'Bar Chart',
                        //data: [65, 59, 80, 50 ],
                        data: <?php echo json_encode($counts); ?>,
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(255, 205, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(75, 192, 192)',
                          'rgb(54, 162, 235)',
                          'rgb(153, 102, 255)',
                          'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>
            </div>
        </div>
    </div>

    <!-- Right side column -->
    <div class="col-lg-6">
        <div class="card">
            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start"><h6>Filter</h6></li>
                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
            </div>

            <div class="card-body pb-0">
                <h5 class="card-title">Total Amount PAID &amp; Updates <span>| Today</span></h5>
                <div class="news">
                    <canvas id="lineChart" style="max-height: 400px;"></canvas>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                   
<script>
    document.addEventListener("DOMContentLoaded", () => {
        new Chart(document.querySelector('#lineChart'), {
            type: 'line',
            data: {
                labels: <?php echo $categories_jsonl; ?>,
                datasets: [{
                    label: 'Total Payments (NGN)',
                    data: <?php echo $amounts_jsonl; ?>,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
                </div>
            </div>
        </div>
    </div>
</div>
        
        
        
        

<div class="col-lg-4">

<!-- News & Updates Traffic -->
<div class="card">
  <div class="filter">
    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
      <li class="dropdown-header text-start">
        <h6>Filter</h6>
      </li>

      <li><a class="dropdown-item" href="#">Today</a></li>
      <li><a class="dropdown-item" href="#">This Month</a></li>
      <li><a class="dropdown-item" href="#">This Year</a></li>
    </ul>
  </div>

  <div class="card-body pb-0">
    <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>

    <div class="news">
    
    </div><!-- End sidebar recent posts-->

  </div>
</div>



<!-- End News & Updates -->

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