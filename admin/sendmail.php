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

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

// Check if admin is logged in
if (isset($_POST['send_mail'])) {
    $from_email = "info@ugele.com.ng";
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $recipients = [];

    // ✅ Only use the textarea content
    if (!empty($_POST['recipients'])) {
        $manual = explode(",", $_POST['recipients']);
        foreach ($manual as $email) {
            $recipients[] = trim($email);
        }
    }

    $results = [];
    foreach ($recipients as $email) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'das101.truehost.cloud';
            $mail->SMTPAuth = true;
            $mail->Username = $from_email;
            $mail->Password = 'TcB44?BHDInnrDh8'; // replace with your SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($from_email, 'WUGN Admin');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
            $results[] = [$email, "SENT"];
        } catch (Exception $e) {
            $results[] = [$email, "NOT SENT: ".$mail->ErrorInfo];
        }
    }

    // Log into email_logs
    $recipients_str = implode(",", $recipients);
    $admin_user = $_SESSION['admin_username'];
    $system_info = $_SERVER['REMOTE_ADDR']." | ".$_SERVER['HTTP_USER_AGENT'];
    $status = "Completed";

    $stmt = $conn->prepare("INSERT INTO email_logs 
        (subject, body, recipients, from_email, sent_by_admin, system_info, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $subject, $body, $recipients_str, $from_email, $admin_user, $system_info, $status);
    $stmt->execute();

    $_SESSION['mail_results'] = $results;
    header("Location: show_results.php");
    exit();
}

// Fetch distinct states from biodata for the State dropdown
 $states = []; 
 $res = $conn->query("SELECT DISTINCT state FROM biodata ORDER BY state ASC"); 
 while ($row = $res->fetch_assoc()) 
    { 
        $states[] = $row['state'];
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
      <h5 class="card-title">Add a Executive Member</h5>
       <div class="form-container">
<form method="POST" action="" id="mailForm">
  
 <!-- Step 1: Choose filter type --> 
  <div class="mb-3"> <label>Fetch Emails By</label> 
  <select name="filter_type" id="filter_type" class="form-control" onchange="showOptions(this.value)"> 
    <option value="">-- Select Filter Type --</option> 
   <!-- <option value="executive">Staff / Executive</option> 
-->    <option value="category">Membership Category</option> 
    <option value="state">State</option> </select> </div> 
    <!-- Step 2: Options dropdown (changes depending on filter type) --> 
     <div class="mb-3" id="filter_options"></div> <!-- Recipients textarea --> 
     <div class="mb-3"> <label>Recipients</label> 
     <textarea name="recipients" id="recipients" rows="6" class="form-control"></textarea> 
     
     <button type="button" class="btn btn-secondary mt-2" onclick="fetchEmails()">Fetch Emails</button>

    </div> 
<!--
<div class="mb-3">
    <label>From Email</label>
    <input type="email" name="from_email" class="form-control" >
  </div> -->
  <input type="hidden" name="from_email" value="info@ugele.com.ng">

  <div class="mb-3">
    <label>Message Topic</label>
    <input type="text" name="subject" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Message Body</label>
    <textarea name="body" rows="8" class="form-control" required></textarea>
  </div>

  <button type="submit" name="send_mail" class="btn btn-primary">Send Mail</button>
</form>

<!-- Modal for feedback -->
<div class="modal fade" id="resultModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Mail Results</h5></div>
      <div class="modal-body" id="resultBody"></div>
      <div class="modal-footer">
        <a href="download_csv.php" class="btn btn-success">Download CSV</a>
      </div>
    </div>
  </div>
</div>

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
<!--fetch emails dynamically -->
<script>
function fetchEmails() {
  const executiveRoleEl = document.querySelector('[name="executive_role"]');
  const memCategoryEl   = document.querySelector('[name="mem_category"]');
  const stateEl         = document.querySelector('[name="state"]');
  const specificEmailEl = document.querySelector('[name="specific_email"]');

  const executiveRole = executiveRoleEl ? executiveRoleEl.value : "";
  const memCategory   = memCategoryEl ? memCategoryEl.value : "";
  const state         = stateEl ? stateEl.value : "";
  const specificEmail = specificEmailEl ? specificEmailEl.value : "";

  fetch('fetch_emails.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({
      executive_role: executiveRole,
      mem_category: memCategory,
      state: state,
      specific_email: specificEmail
    })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      document.getElementById('recipients').value = data.emails.join(", ");
    } else {
      alert("No emails found for the selected category.");
    }
  })
  .catch(err => console.error("AJAX error:", err));
}

</script>

<script> 
function showOptions(type) {
     let html = ""; if (type === "executive") 
     { html = ` <label>Executive Role</label> 
     <select name="executive_role" class="form-control"> 
     <option value="ALL">ALL</option> 
     <option value="Staff">Staff</option> 
     <option value="Executive Committee">Executive Committee</option> 
     <option value="Board of Trustee">Board of Trustee</option> 
     <option value="Secretary">Secretary</option> 
     <option value="Community Leader">Community Leader</option> 
     <option value="Campus Director">Campus Director</option> 
     </select> `; } else if (type === "category") 
     { html = ` <label>Membership Category</label> 
     <select name="mem_category" class="form-control"> 
     <option value="ALL">ALL</option> <option value="STUDENT">STUDENT</option> 
     <option value="REGULAR">REGULAR</option> 
     <option value="ASSOCIATE">ASSOCIATE</option> </select> `;
      } 
      else if (type === "state") 
      {
         html = ` <label>State</label> 
         <select name="state" class="form-control"> 
         <option value="ALL">ALL</option> 
         <?php foreach($states as $s): ?> 
         <option value="<?php echo htmlspecialchars($s); ?>"><?php echo htmlspecialchars($s); ?></option> 
         <?php endforeach; ?> </select> `; } document.getElementById("filter_options").innerHTML = html; } 
         </script>
</body>

</html>