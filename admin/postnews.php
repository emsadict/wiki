
<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
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


//post news section

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<script>alert('Form Submitted');</script>";

    // Database connection
    
       
    
    
    // Sanitize inputs
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $author = $conn->real_escape_string($_POST['author']);

    // Handle featured image upload
    $image_path = '';
    if (isset($_FILES['image'])) {
        $target_dir = "uploads/";
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid('featured_') . '.' . $ext;
        $target_file = $target_dir . $new_filename;
        
        // Validate image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_path = $new_filename;
            } else {
                $message = "Error uploading featured image.";
            }
        } else {
            $message = "File is not an image.";
        }
    }

    if (empty($message)) {
        // Insert into database
        $sql = "INSERT INTO news (title, content, image, author) 
                VALUES ('$title', '$content', '$image_path', '$author')";
        
        if ($conn->query($sql) === TRUE) {
            $message = "News post added successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
    
    $conn->close();
}

?>


<!DOCTYPE html>
<html lang="en">
<?php include_once("header.php"); ?>
<!-- Your form HTML here -->

<!-- Place this right before </body> -->

</body>
<!-- End Header -->
<style>
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
  <!-- ======= Sidebar ======= -->
  <?php include_once("sidebar.php"); ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admindashboard.php">back to admin home</a></li>
          <li class="breadcrumb-item active">Post News</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

            <!-- Reports -->
        <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                <h5 class="card-title">POST NEWS<span>| Today</span></h5>
                <div class="form-container">
                <form action="postnews.php" method="POST" enctype="multipart/form-data">
                                <label>Title:</label>
                                <input type="text" name="title" required><br><br>

                                <label>Content:</label><br>
                                <textarea name="content" rows="10" id="message" cols="700" required></textarea><br><br>

                                <label>Author:</label>
                                <input type="text" name="author" required><br><br>

                                <label>Featured Image:</label>
                                <input type="file" name="image" required><br><br>

                                <button type="submit">Create Post</button>
                </form>

                           
                </div>
                </div>

            </div>
        </div>
            <!-- End Recent Sales -->

            <!-- End Top Selling -->

          </div>
        
            
            
           
          
            
            
           

          </div>
        </div><!-- End Left side columns -->

        
     
        

        
 ->

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