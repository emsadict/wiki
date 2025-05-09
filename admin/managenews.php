
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
$sql = "SELECT * FROM news ORDER BY created_at DESC";
$result = $conn->query($sql);

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<?php include_once("header.php"); ?>
<style>

/* Custom styling for success button (green) */
.btn-success {
    background-color: #28a745 !important; /* Bootstrap default green */
    border-color: #218838 !important;
    color: #f7f7f7 !important;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
}

.btn-success:hover {
    background-color: #218838 !important;
    border-color: #1e7e34 !important;
}

/* Custom styling for danger button (red) */
.btn-danger {
    background-color: #dc3545 !important; /* Bootstrap default red */
    border-color: #c82333 !important;
    color: white !important;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
}

.btn-danger:hover {
    background-color: #c82333 !important;
    border-color: #bd2130 !important;
}

/* Custom styling for primary button (blue) */
.btn-primary {
    background-color: #007bff !important; /* Bootstrap default blue */
    border-color: #0056b3 !important;
    color: white !important;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
}

.btn-primary:hover {
    background-color: #0056b3 !important;
    border-color: #004085 !important;
}
    </style>
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
            <!-- Reports -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                <h5 class="card-title">Manage News<span>| Today</span></h5>

                <h2>Manage News</h2>

<table border="1" class="table table-bordered table-striped">
<thead class="table-success">   
<tr>
        <th>ID</th>
        <th>News Title</th>
        <th>Content</th>
        <th>Image</th>
        
        <th>Action</th>
    </tr>
</thead>
    <?php 
    
    $counter = 1; // Start ID from 1
    while ($row = $result->fetch_assoc()) { ?>
        <tr>
        <td><?php echo $counter++; ?></td> <!-- Increment ID manually -->
        <td><?php echo htmlspecialchars($row['title']); ?></td>
            
        <td><?php echo substr(htmlspecialchars($row['content']), 0, 50) . '...'; ?></td>
            <td><img src="uploads/<?php echo $row['image']; ?>" width="50"></td>
            
            <td>
            <button class="btn btn-success"><a style="color: #f7f7f7;" href="edit_news.php?id=<?php echo $row['id']; ?>">Edit</a></button> |
            <button class="btn btn-danger"><a  style="color: #f7f7f7;" href="delete_news.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a></button>
            </td>
        </tr>
    <?php } ?>

</table>

               </div>
              </div>
            </div><!-- End Recent Sales -->

            <!-- End Top Selling -->

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