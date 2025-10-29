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


// Handle account creation
// Handle account creation
if (isset($_POST['create_account'])) {
    $membership_num = mysqli_real_escape_string($conn, $_POST['membership_num']);
    $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $othernames = mysqli_real_escape_string($conn, $_POST['othernames']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mem_category = mysqli_real_escape_string($conn, $_POST['membership_category']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    $hashed_password = password_hash($transaction_id, PASSWORD_DEFAULT);

    // Insert into membership_accounts
    $insert_account = mysqli_query($conn, "
        INSERT INTO membership_accounts (membership_num, password, phone)
        VALUES ('$membership_num', '$hashed_password', '$phone')
    ");

    // Insert into biodata
    $insert_biodata = mysqli_query($conn, "
        INSERT INTO biodata (regno, username, first_name, last_name, email, phone, mem_category, date)
        VALUES ('$membership_num', '$membership_num', '$othernames', '$surname', '$email', '$phone', '$mem_category', '$date')
    ");

    if ($insert_account && $insert_biodata) {
        echo "<script>alert('Account and biodata created for $membership_num'); window.location.href='createacc.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to create account or biodata for $membership_num');</script>";
    }
}

// Fetch eligible payments
$sql = "
    SELECT p.*
    FROM payments p
    LEFT JOIN membership_accounts m ON p.membership_num = m.membership_num
    WHERE p.payment_type = 'membership'
      AND p.payment_status = 'PAID'
      AND m.membership_num IS NULL
";
$result = mysqli_query($conn, $sql);

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<?php include_once("header.php"); ?>
<style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        form {
            margin: 0;
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

        <!-- Left side columns -->
            
              <!-- Customers Card -->
            
            <!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                

                <div class="card-body">
      <h5 class="card-title">Create Account </span></h5>
                    <body>
    <h2>Eligible Memberships for Account Creation</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Membership Number</th>
                <th>Membership Category</th>
                <th>Year</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Date</th>
                <th>Payment Type</th>
                <th>Amount</th>
                <th>Transaction ID</th>
                <th>Surname</th>
                <th>Other Names</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['membership_num']); ?></td>
                    <td><?php echo htmlspecialchars($row['membership_category']); ?></td>
                    <td><?php echo htmlspecialchars($row['year']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['payment_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['amount']); ?></td>
                    <td><?php echo htmlspecialchars($row['transaction_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['surname']); ?></td>
                    <td><?php echo htmlspecialchars($row['othernames']); ?></td>
                    <td><?php echo htmlspecialchars($row['payment_status']); ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="membership_num" value="<?php echo $row['membership_num']; ?>">
                            <input type="hidden" name="transaction_id" value="<?php echo $row['transaction_id']; ?>">
                            <input type="hidden" name="phone" value="<?php echo $row['phone']; ?>">
                            <input type="hidden" name="surname" value="<?php echo $row['surname']; ?>">
                            <input type="hidden" name="othernames" value="<?php echo $row['othernames']; ?>">
                            <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                            <input type="hidden" name="membership_category" value="<?php echo $row['membership_category']; ?>">
                            <input type="hidden" name="date" value="<?php echo $row['date']; ?>">
                            <button type="submit" name="create_account">Create Account</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No eligible records found for account creation.</p>
    <?php endif; ?>
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
   

    <!-- Right side column -->
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