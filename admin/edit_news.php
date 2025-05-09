
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

// Fetch news details by ID
$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id = $id";
$result = $conn->query($sql);
$news = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    
    // Check if a new image is uploaded
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        
        $update_sql = "UPDATE news SET title='$title', content='$content', image='$image' WHERE id=$id";
    } else {
        $update_sql = "UPDATE news SET title='$title', content='$content' WHERE id=$id";
    }

    if ($conn->query($update_sql) === TRUE) {
        $message= "News updated successfully!";
        header("Location: managenews.php");
    } else {
        echo "Error updating news: " . $conn->error;
    }
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
.form-container {
    width: 100%; /* Adjust width as needed */
    max-width: 1000px; /* Prevents the form from being too wide */
    padding: 20px;
    background: #f9f9f9; /* Light background */
    border-radius: 15px; /* Rounded border */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Optional shadow */
    margin: 20px auto; /* Centers the form */
}

.form-container input, 
.form-container textarea,
.form-container option,
.form-container select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 8px; /* Rounds input fields */
}

.form-container button {
    display: block;
    width: 50%; /* Adjust width */
    padding: 10px;
    background: #28a745; /* Green color */
    color: white;
    border: none;
    border-radius: 8px; /* Rounded button */
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    margin: 0 auto; /* Centers the button */
}

.form-container button:hover {
    background: #218838;
}
#madewith{
	max-width: 1600px;;
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

            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
               <h5 class="card-title">Edit News<span>| Today</span></h5>

               <center> <h2>Edit News</h2></center>
                                            <div class="form-container">
                                            <?php if (!empty($message)) { echo "<div class='alert alert-success text-center'>$message</div>"; } ?>
                                                          <form action="" method="POST" enctype="multipart/form-data">
                                                              <label>Title:</label>
                                                              <input type="text" name="title" value="<?php echo $news['title']; ?>" required><br><br>

                                                              <label>Content:</label><br>
                                                              <textarea name="content" id="message"  rows="5" required><?php echo $news['content']; ?></textarea><br><br>

                                                              <label>Current Image:</label><br>
                                                               <img src="uploads/<?php echo $news['image']; ?>" width="100"><br><br>

                                                              <label>New Image (Optional):</label>
                                                              <input type="file" name="image"><br><br>

                                                              <button type="submit">Update News</button>
                                                          </form>
                                            </div>

               </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- End Top Selling -->

          </div>
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