
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


if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    // Fetch the event details from the database
    $query = "SELECT * FROM events WHERE id = $event_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $event = mysqli_fetch_assoc($result);
    } else {
        echo "Event not found.";
        exit;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $event_venue = $_POST['event_venue'];
    $facebook = $_POST['event_virtual_link_facebook'];
    $twitter = $_POST['event_virtual_link_twitter'];
    $zoom = $_POST['event_virtual_link_zoom'];
    $google_meet = $_POST['event_virtual_link_googlemeet'];
    $youtube = $_POST['event_virtual_link_youtube'];
    $others = $_POST['event_virtual_link_others'];

    // Image Upload Handling
    $event_image = $event['event_image']; // Keep existing image by default
    $event_thumbnail = $event['event_thumbnail']; // Keep existing thumbnail by default

    if (!empty($_FILES['event_image']['name'])) {
        $image_name = basename($_FILES["event_image"]["name"]);
        $target_file = "uploads/" . $image_name;
        move_uploaded_file($_FILES["event_image"]["tmp_name"], $target_file);
        $event_image = $image_name;
    }

    if (!empty($_FILES['event_thumbnail']['name'])) {
        $thumbnail_name = basename($_FILES["event_thumbnail"]["name"]);
        $target_file_thumb = "uploads/" . $thumbnail_name;
        move_uploaded_file($_FILES["event_thumbnail"]["tmp_name"], $target_file_thumb);
        $event_thumbnail = $thumbnail_name;
    }

    // Update event details in the database
    $update_query = "UPDATE events SET 
        title = '$title', 
        description = '$description', 
        event_date = '$event_date', 
        event_time = '$event_time', 
        event_venue = '$event_venue', 
        event_image = '$event_image', 
        event_thumbnail = '$event_thumbnail', 
        event_virtual_link_facebook = '$facebook', 
        event_virtual_link_twitter = '$twitter', 
        event_virtual_link_zoom = '$zoom', 
        event_virtual_link_googlemeet = '$google_meet', 
        event_virtual_link_youtube = '$youtube', 
        event_virtual_link_others = '$others' 
        WHERE id = $event_id";

    if (mysqli_query($conn, $update_query)) {
         $message ="<div class='alert alert-success'>Event updated successfully!</div>";
         header("Location: manage_event.php");
    } else {
        $message="<div class='alert alert-danger'>Error updating event: " . mysqli_error($conn) . "</div>";
    }
}

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
            <!-- Reports -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                <h5 class="card-title">EDIT EVENTS<span>| Today</span></h5>
                <center><h2 style="float: center;">Edit Event</h2></center>
            <div class="form-container">
            <?php if (!empty($message)) { echo "$message"; } ?>
                <form action="" method="POST" enctype="multipart/form-data" style="padding: 40px; border: 2px;">
                    <label>Title:</label>
                    <input type="text" name="title" value="<?php echo $event['title']; ?>" required><br>

                    <label>Description:</label><br>
                    <span class="wpcf7-form-control-wrap your-message">
                        <textarea name="description" id="message" required cols="40" rows="10" class="input1" aria-invalid="false"><?php echo $event['description']; ?></textarea><br>
                    </span>

                    <label>Event Date:</label><br>
                    <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>" required><br><br>

                    <label>Event Time:</label>
                    <input type="time" name="event_time" value="<?php echo $event['event_time']; ?>" required><br><br>

                    <label>Event Venue:</label>
                    <input type="text" name="event_venue" value="<?php echo $event['event_venue']; ?>" required><br><br>

                    <label>Current Event Image:</label><br>
                    <img src="uploads/<?php echo $event['event_image']; ?>" width="100"><br><br>

                    <label>New Event Image (Optional):</label>
                    <input type="file" name="event_image"><br><br>

                    <label>Current Event Thumbnail:</label><br>
                    <img src="uploads/<?php echo $event['event_thumbnail']; ?>" width="100"><br><br>

                    <label>New Event Thumbnail (Optional):</label>
                    <input type="file" name="event_thumbnail"><br><br>

                    <label>Facebook Link:</label>
                    <input type="url" name="event_virtual_link_facebook" value="<?php echo $event['event_virtual_link_facebook']; ?>"><br><br>

                    <label>Twitter Link:</label>
                    <input type="url" name="event_virtual_link_twitter" value="<?php echo $event['event_virtual_link_twitter']; ?>"><br><br>

                    <label>Zoom Link:</label>
                    <input type="url" name="event_virtual_link_zoom" value="<?php echo $event['event_virtual_link_zoom']; ?>"><br><br>

                    <label>Google Meet Link:</label>
                    <input type="url" name="event_virtual_link_googlemeet" value="<?php echo $event['event_virtual_link_googlemeet']; ?>"><br><br>

                    <label>YouTube Link:</label>
                    <input type="url" name="event_virtual_link_youtube" value="<?php echo $event['event_virtual_link_youtube']; ?>"><br><br>

                    <label>Other Virtual Link:</label>
                    <input type="url" name="event_virtual_link_others" value="<?php echo $event['event_virtual_link_others']; ?>"><br><br>

                    <button type="submit" class="btn btn-success" style="float:center;">Update Event</button>
                </form>
            </div>
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