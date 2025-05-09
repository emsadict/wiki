
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
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST["title"]);
    $description = htmlspecialchars($_POST["description"]);

    // Allowed formats
    $allowed_types = ["image/jpeg", "image/png", "image/svg+xml", "image/jpg"];

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $image_type = mime_content_type($_FILES["image"]["tmp_name"]);

        if (in_array($image_type, $allowed_types)) {
            $upload_dir = "uploads/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Generate unique filename
            $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $filename = uniqid("img_") . "." . $extension;
            $target_file = $upload_dir . $filename;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Insert data into the database
                $query = "INSERT INTO imagegallery (title, description, image_path) VALUES ('$title', '$description', '$filename')";
                if ($conn->query($query)) {
                    echo "<script>alert('Image uploaded successfully!'); window.location='upload2.php';</script>";
                } else {
                    echo "<script>alert('Database error: " . $conn->error . "');</script>";
                }
            } else {
                echo "<script>alert('Error moving uploaded file.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file type! Only JPG, JPEG, PNG, SVG allowed.');</script>";
        }
    } else {
        echo "<script>alert('No file uploaded or an error occurred.');</script>";
    }
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
  <style>
.form-container {
    width: 100%; /* Adjust width as needed */
    max-width: 800px; /* Prevents the form from being too wide */
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
             <h5 class="card-title">Post Image to big slider</h5>
             <div class="form-container">
             <form action="upload2.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Image Title:</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Choose an Image:</label>
                <input type="file" class="form-control" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload Image</button>
        </form>
             </div>
           </div>

              </div>
            </div><!-- End Recent Sales -->

          

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