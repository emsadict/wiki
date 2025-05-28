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

//Fetch all news posts
$sql = "SELECT * FROM staff ORDER BY created_at DESC";
$result = $conn->query($sql);
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

            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                <h5 class="card-title">Manage EXCO/Staff Member</h5>
                        

<table border="1" class="table table-bordered table-striped">
<thead class="table-success">   
<tr>
        <th>#</th>
        <th>Name</th>
        <th>Designation</th>
        <th>Image</th>
        <th>Office</th>
        
        <th>Action</th>
    </tr>
</thead>
    <?php 
    
    $counter = 1; // Start ID from 1
    while ($row = $result->fetch_assoc()) { ?>
        <tr>
        <td><?php echo $counter++; ?></td> <!-- Increment ID manually -->
        <td><?php echo htmlspecialchars($row['name']); ?></td>
            
        <td>
                       <?php
                           echo htmlspecialchars($row['designation']);

                           if ($row['designation'] === 'Campus Director' && !empty($row['campus'])) {
                               echo ' - ' . htmlspecialchars($row['campus']);
                           }

                           if ($row['designation'] === 'Community Leader' && !empty($row['community_name'])) {
                               echo ' - ' . htmlspecialchars($row['community_name']);
                           }
                       ?>
        </td>
            <td><img src="uploads/<?php echo $row['passport']; ?>" width="50"></td>
            <td>
                <?php
                    $output = [];

                    if (!empty($row['office'])) {
                        $output[] = substr(htmlspecialchars($row['office']), 0, 50);
                    }

                    if (!empty($row['exco'])) {
                        $output[] = htmlspecialchars($row['exco']);
                    }

                    if (!empty($row['board'])) {
                        $output[] = htmlspecialchars($row['board']);
                    }

                    echo implode(' | ', $output);
                ?>
            </td>
            <td>
            <button class="btn btn-success"><a style="color: #f7f7f7;" href="edit_exco.php?id=<?php echo $row['id']; ?>">Edit</a></button> |
            <button class="btn btn-danger"><a  style="color: #f7f7f7;" href="delete_exco.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a></button>
            </td>
        </tr>
    <?php } ?>

</table>

              </div>

              </div>
            </div><!-- End Recent Sales -->

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