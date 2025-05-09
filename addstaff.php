<?php
session_start(); // Start session to store messages
include 'db_connect.php'; // Ensure this file contains the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staffId = strtoupper(trim($_POST['staff_id']));
    $staffDept = trim($_POST['staff_dept']);
    $staffEmail = strtolower(trim($_POST['staff_email']));
    $staffPhone = trim($_POST['staff_phone']);
    $staffQualification = ucfirst(trim($_POST['staff_qualification']));
    $staffDesignation = ucfirst(trim($_POST['staff_designation']));

    // Check if staff ID or Email already exists
    $checkSql = "SELECT * FROM staff_table WHERE staff_id = ? OR staff_email = ?";
    if ($stmt = $conn->prepare($checkSql)) {
        $stmt->bind_param("ss", $staffId, $staffEmail);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $_SESSION['error_message'] = "Error: A staff with this Staff ID or Email already exists!";
            header("Location: addstaff.php"); // Redirect back to form page
            exit;
        }
        $stmt->close();
    } else {
        $_SESSION['error_message'] = "Database error: " . $conn->error;
        header("Location: addstaff.php");
        exit;
    }

    // Extract the email username (before @) for file naming
    $emailUsername = strstr($staffEmail, '@', true); // Extracts part before '@'
    $emailUsername = preg_replace('/[^A-Za-z0-9]/', '_', $emailUsername); // Replace invalid filename characters

    // Handle File Upload
    $photoNewName = NULL; // Default if no file is uploaded
    if (isset($_FILES['staff_photo']) && $_FILES['staff_photo']['error'] == 0) {
        $targetDir = "uploads/staff_photos/"; // Central folder for all staff
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $passportPhoto = $_FILES['staff_photo']['name'];
        $photoTempName = $_FILES['staff_photo']['tmp_name'];
        $photoExt = strtolower(pathinfo($passportPhoto, PATHINFO_EXTENSION));
        $photoNewName = $emailUsername . "." . $photoExt; // Use extracted email username as filename
        $photoPath = $targetDir . $photoNewName;

        if (!move_uploaded_file($photoTempName, $photoPath)) {
            $_SESSION['error_message'] = "Error uploading file! Please try again.";
            header("Location: addstaff.php");
            exit;
        }
    }

    // Insert into staff_table
    $sql = "INSERT INTO staff_table (staff_id, staff_dept, staff_email, staff_phone, staff_qualification, staff_designation, staff_photo) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssss", $staffId, $staffDept, $staffEmail, $staffPhone, $staffQualification, $staffDesignation, $photoNewName);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Staff record added successfully!";
            header("Location: addstaff.php");
            exit;
        } else {
            $_SESSION['error_message'] = "Error: " . $stmt->error;
            header("Location: addstaff.php");
            exit;
        }
        $stmt->close();
    } else {
        $_SESSION['error_message'] = "Error: " . $conn->error;
        header("Location: addstaff.php");
        exit;
    }
}

// Fetch department options from both tables
$deptQuery = "
    SELECT dept_name AS department FROM dept_table 
    UNION 
    SELECT pg_title AS department FROM pages_table
";

$deptResult = $conn->query($deptQuery);
?>

<?php
//session_start(); // Start session to retrieve messages

$message = "";

// Check if there is a session message and assign it to $message
if (isset($_SESSION['error_message'])) {
    $message = "<div class='alert alert-danger text-center'>" . $_SESSION['error_message'] . "</div>";
    unset($_SESSION['error_message']); // Clear message after displaying
}

if (isset($_SESSION['success_message'])) {
    $message = "<div class='alert alert-success text-center'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Clear message after displaying
}
?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="home page-template-default page page-id-2039 gdlr-core-body woocommerce-no-js tribe-no-js kingster-body kingster-body-front kingster-full  kingster-with-sticky-navigation  kingster-blockquote-style-1 gdlr-core-link-to-lightbox">
<?php include "mobilemenu.php"; ?>
    <div class="kingster-body-outer-wrapper ">
        <div class="kingster-body-wrapper clearfix  kingster-with-frame">
           <?php include "headermenu.php" ?>
           <?php   include "menu.php";?>
            <div class="kingster-page-title-wrap  kingster-style-medium kingster-center-align">
                <div class="kingster-header-transparent-substitute"></div>
                <div class="kingster-page-title-overlay"></div>
                <div class="kingster-page-title-container kingster-container">
                    <div class="kingster-page-title-content kingster-item-pdlr">
                        <h1 class="kingster-page-title">ADD A STAFF MEMBER</h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-sidebar-wrapper">
            <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container"id="madewith">
                <div class="gdlr-core-pbf-sidebar-content gdlr-core-column-45 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color:rgba(158, 228, 207, 0.53) ;"></div>
                    <div class="gdlr-core-pbf-sidebar-content-inner">
<div class="gdlr-core-pbf-element">
    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">

            <!-- Upcoming Events -->
            <?php if (!empty($message)) { echo $message; } ?>
            <div class="form-container" >
            <center><h3>Create New Staff</h3></center>
            <hr />
            
            <form action="" method="POST" enctype="multipart/form-data">
        <label>Staff ID:</label>
        <input type="text" name="staff_id" required><br><br>

        <label>Department/Unit:</label>
        <!-- Select dropdown for department -->
<select name="staff_dept" class="form-control" required>
    <option value="">Select Department</option>
    <?php while ($row = $deptResult->fetch_assoc()): ?>
        <option value="<?php echo htmlspecialchars($row['department']); ?>">
            <?php echo ucfirst(htmlspecialchars($row['department'])); ?>
        </option>
    <?php endwhile; ?>
</select><br><br>

        <label>Email:</label>
        <input type="email" name="staff_email" required><br><br>

        <label>Phone:</label>
        <input type="text" name="staff_phone" required><br><br>

        <label>Qualification:</label>
        <input type="text" name="staff_qualification" required><br><br>

        <label>Designation:</label>
        <input type="text" name="staff_designation" required><br><br>

        <label>Passport Photograph:</label>
        <input type="file" name="staff_photo" accept="image/*" required><br><br>

        <button type="submit">Submit</button>
    </form>
            </div>

        </div>
    </div>
</div>

<style>
    .event-box {
        background-color: #f7f7f7;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px ;
        border:rgb(108, 27, 27) 4px solid;
        align-items: center;
    }
    .pagination {
        margin-top: 10px;
        padding: 10px;
    }
    .pagination a {
        margin: 2px;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-decoration: none;
        background-color:rgb(20, 141, 106);
        color: #f7f7f7;
    }
    .pagination a:hover {
        background-color:rgb(5, 125, 79);
        color: white;
    }
</style>


</div>
                </div>
                
                <!-- Sidebar with Recent Posts -->
                <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left kingster-sidebar-area gdlr-core-column-15 gdlr-core-pbf-sidebar-padding gdlr-core-line-height">
                    <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                        <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgb(206, 234, 221) ;">
                        <?php include "pagesidebar.php"; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php mysqli_close($conn); ?>


            <footer>
                <?php  include "footer.php";?>
            </footer>
        </div>
    </div>


	<script type='text/javascript' src='js/jquery/jquery.js'></script>
    <script type='text/javascript' src='js/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='plugins/goodlayers-core/plugins/combine/script.js'></script>
    <script type='text/javascript'>
        var gdlr_core_pbf = {
            "admin": "",
            "video": {
                "width": "640",
                "height": "360"
            },
            "ajax_url": "#"
        };
    </script>
    <script type='text/javascript' src='plugins/goodlayers-core/include/js/page-builder.js'></script>
    <script type='text/javascript' src='js/jquery/ui/effect.min.js'></script>
    <script type='text/javascript'>
        var kingster_script_core = {
            "home_url": "index.html"
        };
    </script>
    <script type='text/javascript' src='js/plugins.min.js'></script>
</body>
</html>