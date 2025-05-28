<?php
session_start();
// Database connection
$host = "localhost";
$user = "root"; // Change to your DB username
$password = ""; // Change to your DB password
$database = "membership_management"; // Change to your DB name
$alert='';
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

$success = "";
$error = "";
$alert = "";
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("Invalid ID.");
}

// Fetch current staff data
$staff = $conn->query("SELECT * FROM staff WHERE id = $id")->fetch_assoc();
if (!$staff) {
    die("Staff not found.");
}

// Fetch dropdown values
$categories = $conn->query("SELECT * FROM staff_categories");
$communities = $conn->query("SELECT * FROM communities");

// Update logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $profile = $_POST['profile'];
    $membership_category_id = $_POST['membership_category'];
    $campus = $_POST['campus'];
    $board = $_POST['board'];
    $exco = $_POST['exco'];
    $office = isset($_POST['office']) ? $_POST['office'] : null;
    $community_id = isset($_POST['community_id']) ? $_POST['community_id'] : null;

    // Get designation from membership category
    $catQuery = $conn->query("SELECT name FROM staff_categories WHERE id = $membership_category_id");
    $designation = ($catQuery && $catQuery->num_rows > 0) ? $catQuery->fetch_assoc()['name'] : '';

    // Handle passport upload
    $passport_name = $staff['passport']; // default to old passport
    if (!empty($_FILES['passport']['name'])) {
        $passport_filename = time() . '_' . basename($_FILES['passport']['name']);
        $passport_path = 'uploads/' . $passport_filename;
        if (move_uploaded_file($_FILES['passport']['tmp_name'], $passport_path)) {
            $passport_name = $passport_filename;
        }
    }

    // Update statement
    $stmt = $conn->prepare("UPDATE staff SET name=?, title=?, designation=?, profile=?, passport=?, membership_category_id=?, community_id=?, office=?, campus=?, board=?, exco=? WHERE id=?");
    $stmt->bind_param("sssssiissssi", $name, $title, $designation, $profile, $passport_name, $membership_category_id, $community_id, $office, $campus, $board, $exco, $id);

    if ($stmt->execute()) {
        $alert = '<div class="alert alert-success">Executive member updated successfully!</div>';
        header( "Location:manaexco.php");
        // Refresh staff data
        $staff = $conn->query("SELECT * FROM staff WHERE id = $id")->fetch_assoc();
    } else {
        $alert = '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<?php include_once("header.php"); ?>

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
      <h5 class="card-title">Edit Staff/Executive Member</h5>
       <div class="form-container">
            <?= $alert ?>
            <form action="edit_exco.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
                <label>Title</label>
                <select name="title" class="form-control" required>
                    <option value="">Select</option>
                    <?php foreach (['Mr', 'Mrs', 'Miss', 'Dr', 'Amb'] as $t): ?>
                        <option value="<?= $t ?>" <?= ($staff['title'] == $t) ? 'selected' : '' ?>><?= $t ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Full Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($staff['name']) ?>" class="form-control" required>

                <label>Profile / Citation</label>
                <textarea name="profile" class="form-control" required><?= htmlspecialchars($staff['profile']) ?></textarea>

                <label>Passport (Leave blank to keep current)</label>
                <input type="file" name="passport" class="form-control">
                <?php if (!empty($staff['passport'])): ?>
                    <img src="uploads/<?= $staff['passport'] ?>" height="80" style="margin-top:10px;">
                <?php endif; ?>

                <label>Membership Category</label>
                <select name="membership_category" class="form-control" required>
                    <option value="">Select</option>
                    <?php while ($row = $categories->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>" <?= ($staff['membership_category_id'] == $row['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label>Office (e.g. Secretary)</label>
                <input type="text" name="office" value="<?= htmlspecialchars($staff['office']) ?>" class="form-control">

                <label>Campus Name</label>
                <input type="text" name="campus" value="<?= htmlspecialchars($staff['campus']) ?>" class="form-control">

                <label>Executive Office</label>
                <input type="text" name="exco" value="<?= htmlspecialchars($staff['exco']) ?>" class="form-control">

                <label>Board Office</label>
                <input type="text" name="board" value="<?= htmlspecialchars($staff['board']) ?>" class="form-control">

                <label>Community</label>
                <select name="community_id" class="form-control">
                    <option value="">Select</option>
                    <?php while ($row = $communities->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>" <?= ($staff['community_id'] == $row['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <br>
                <button type="submit" class="btn btn-success">Update Executive Member</button>
                   

</form>
       </div>
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

  <script>
document.getElementById('membershipCategory').addEventListener('change', function () {
    const selectedText = this.options[this.selectedIndex].getAttribute('data-name');

    document.getElementById('officeField').style.display = (selectedText === 'Staff') ? 'block' : 'none';
    document.getElementById('communityField').style.display = (selectedText === 'Community Leader') ? 'block' : 'none';
    document.getElementById('campusField').style.display = (selectedText === 'Campus Director') ? 'block' : 'none';
    document.getElementById('boardField').style.display = (selectedText === 'Board of Trustee') ? 'block' : 'none';
    document.getElementById('excoField').style.display = (selectedText === 'Executive Committee') ? 'block' : 'none';
});
</script>

</body>

</html>