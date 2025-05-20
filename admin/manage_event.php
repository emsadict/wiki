
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

      <?php
                             $query = "SELECT * FROM events";
                             $result = mysqli_query($conn, $query);
                             ?>

            <!-- Reports -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                <h5 class="card-title">Manage Events<span>| Today</span></h5>
                <h2>Manage Events</h2>
                    <?php if (isset($_GET['message'])): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['message']); ?></div>
<?php endif; ?>

                    <table class="table table-bordered table-striped">
                        <thead class="table-success">
                            <tr>
                                <th>ID</th>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Venue</th>
                                <th>Social Media Links</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                             $counter = 1; // Start ID from 1
                            while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?php  echo $counter++; ?></td>
                                    <td><?= $row['title']; ?></td>
                                    <td><?= $row['event_date']; ?></td>
                                    <td><?= $row['event_time']; ?></td>
                                    <td><?= $row['event_venue']; ?></td>
                                    <td>
                                        <?php if (!empty($row[' event_virtual_link_facebook'])): ?>
                                            <a href="<?= $row[' event_virtual_link_facebook']; ?>" target="_blank">Facebook</a> |
                                        <?php endif; ?>
                                        <?php if (!empty($row['event_virtual_link_twitter'])): ?>
                                            <a href="<?= $row['event_virtual_link_twitter']; ?>" target="_blank">Twitter</a> |
                                        <?php endif; ?>
                                        <?php if (!empty($row['event_virtual_link_zoom'])): ?>
                                            <a href="<?= $row['event_virtual_link_zoom']; ?>" target="_blank">Zoom</a> |
                                        <?php endif; ?>
                                        <?php if (!empty($row['event_virtual_link_youtube'])): ?>
                                            <a href="<?= $row['event_virtual_link_youtube']; ?>" target="_blank">YouTube</a> |
                                        <?php endif; ?>
                                        <?php if (!empty($row['event_virtual_link_googlemeet'])): ?>
                                            <a href="<?= $row['event_virtual_link_googlemeet']; ?>" target="_blank">Google Meet</a>
                                        <?php endif; ?>
                                        <?php if (!empty($row['event_virtual_link_others'])): ?>
                                            <a href="<?= $row['event_virtual_link_others']; ?>" target="_blank">Others</a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit_event.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="deletevent.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
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

    $conn->close();

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