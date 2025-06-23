<?php
session_start();
include 'db.php';
/*
if (!isset($_SESSION['membership_num'])) {
    header('Location: login.php');
    exit();
}

$membership_num = $_SESSION['membership_num'];
$lockFields = false;

// Check if regno exists in updated_bio (lock fields if update_status = 1)
$updateCheck = mysqli_query($conn, "SELECT update_status FROM updated_bio WHERE regno='$membership_num'");
if ($updateCheck && mysqli_num_rows($updateCheck) > 0) {
    $updateRow = mysqli_fetch_assoc($updateCheck);
    if ($updateRow['update_status'] == 1) {
        $lockFields = true;
    }
}

// Fetch biodata
$biodata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biodata WHERE regno='$membership_num'"));

if (isset($_POST['update']) && !$lockFields) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']); // State is now available after update
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $wikipedia_projects = mysqli_real_escape_string($conn, $_POST['wikipedia_projects']);
    $wikipedia_account = mysqli_real_escape_string($conn, $_POST['wikipedia_account']);
    $open_movement = mysqli_real_escape_string($conn, $_POST['open_movement']);
    $wugn_activities = mysqli_real_escape_string($conn, $_POST['wugn_activities']);
    $fan_club = mysqli_real_escape_string($conn, $_POST['fan_club']);
    $other_usergroups = mysqli_real_escape_string($conn, $_POST['other_usergroups']);
    $declaration = mysqli_real_escape_string($conn, $_POST['declaration']);

    // Update biodata (store state first)
    $updateBiodata = mysqli_query($conn, "UPDATE biodata SET 
        first_name='$firstname', last_name='$lastname', email='$email', gender='$gender',
        phone='$phone', street_address='$address', city='$city', state='$state', country='$country',
        wikimedia_projects='$wikipedia_projects',
        involvement_open_movement='$open_movement', involvement_wugn_activities='$wugn_activities',
        fan_club_network='$fan_club', other_usergroups='$other_usergroups', agreement='$declaration'
        WHERE regno='$membership_num'
    ");

    if ($updateBiodata) {
        // Now that biodata is updated, generate membership number WG/state/4-digit
        do {
            $random_number = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
           $new_membership_num = "WG/" . strtoupper($state) . "/{$random_number}";
            $exists = mysqli_query($conn, "SELECT username  FROM biodata WHERE username='$new_membership_num' 
                UNION SELECT username FROM updated_bio WHERE username='$new_membership_num'")->num_rows;
        } while ($exists > 0);

        // Update biodata with generated membership number
        $updateMembership = mysqli_query($conn, "UPDATE biodata SET username='$new_membership_num' WHERE regno='$membership_num'");

        // Insert into updated_bio
        $updateBioQuery = mysqli_query($conn, "INSERT INTO updated_bio (regno, username,  update_status) 
            VALUES ('$membership_num',  '$new_membership_num', 1) 
            ON DUPLICATE KEY UPDATE update_status=1");

        $success = "Biodata Updated Successfully! Your Membership Number: $new_membership_num";
        $lockFields = true;
    } else {
        $error = "Failed to Update Biodata!";
    }
}
    */

if (!isset($_SESSION['membership_num'])) {
    header('Location: login.php');
    exit();
}

$membership_num = $_SESSION['membership_num'];
$lockFields = false;

// Check if regno exists in updated_bio (lock fields if update_status = 1)
$updateCheck = mysqli_query($conn, "SELECT update_status FROM updated_bio WHERE regno='$membership_num'");
if ($updateCheck && mysqli_num_rows($updateCheck) > 0) {
    $updateRow = mysqli_fetch_assoc($updateCheck);
    if ($updateRow['update_status'] == 1) {
        $lockFields = true;
    }
}

// Fetch current biodata
$biodata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biodata WHERE regno='$membership_num'"));
$wikipedia_account="";
if (isset($_POST['update']) && !$lockFields) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $wikipedia_projects = mysqli_real_escape_string($conn, $_POST['wikipedia_projects']);
    $wikipedia_account = mysqli_real_escape_string($conn, $_POST['wikipedia_account']);
    $open_movement = mysqli_real_escape_string($conn, $_POST['open_movement']);
    $wugn_activities = mysqli_real_escape_string($conn, $_POST['wugn_activities']);
    $fan_club = mysqli_real_escape_string($conn, $_POST['fan_club']);
    $other_usergroups = mysqli_real_escape_string($conn, $_POST['other_usergroups']);
    $declaration = mysqli_real_escape_string($conn, $_POST['declaration']);

    // Passport handling
    $passportFileName = $biodata['passport']; // fallback to current if no new file
    if (isset($_FILES['passport']) && $_FILES['passport']['error'] === UPLOAD_ERR_OK) {
        $fileSize = $_FILES['passport']['size'];
        $ext = strtolower(pathinfo($_FILES['passport']['name'], PATHINFO_EXTENSION));

        if ($fileSize <= 102400 && in_array($ext, ['jpg', 'jpeg', 'png'])) { // 100KB max
            $uploadDir = 'uploads/passports/';
            $newFilename = uniqid('passport_', true) . '.' . $ext;
            $targetPath = $uploadDir . $newFilename;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($_FILES['passport']['tmp_name'], $targetPath)) {
                $passportFileName = $targetPath;
            }
        } else {
            $error = "Passport upload failed: must be JPG/PNG and ≤ 100KB.";
        }
    }

    // Update biodata
    $updateBiodata = mysqli_query($conn, "UPDATE biodata SET 
        first_name='$firstname', last_name='$lastname', email='$email', gender='$gender',
        phone='$phone', street_address='$address', city='$city', state='$state', country='$country',
        wikimedia_projects='$wikipedia_projects', involvement_open_movement='$open_movement',
        involvement_wugn_activities='$wugn_activities', fan_club_network='$fan_club',
        other_usergroups='$other_usergroups', agreement='$declaration', passport='$passportFileName'
        WHERE regno='$membership_num'
    ");

    if ($updateBiodata) {
        // Generate username if none exists
        if (empty($biodata['username'])) {
            do {
                $random_number = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
                $new_membership_num = "WG/" . strtoupper($state) . "/$random_number";
                $exists = mysqli_query($conn, "SELECT username FROM biodata WHERE username='$new_membership_num'
                    UNION SELECT username FROM updated_bio WHERE username='$new_membership_num'")->num_rows;
            } while ($exists > 0);

            mysqli_query($conn, "UPDATE biodata SET username='$new_membership_num' WHERE regno='$membership_num'");
            mysqli_query($conn, "INSERT INTO updated_bio (regno, username, update_status) 
                VALUES ('$membership_num', '$new_membership_num', 1)
                ON DUPLICATE KEY UPDATE update_status=1");
            $success = "Biodata Updated Successfully! Your Membership Number: $new_membership_num";
        } else {
            mysqli_query($conn, "INSERT INTO updated_bio (regno, username, update_status) 
                VALUES ('$membership_num', '{$biodata['username']}', 1)
                ON DUPLICATE KEY UPDATE update_status=1");
            $success = "Biodata Updated Successfully!";
        }

        $lockFields = true;
        $biodata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biodata WHERE regno='$membership_num'"));
    } else {
        $error = "Failed to Update Biodata!";
    }
}

// Fetch existing biodata
$biodata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biodata WHERE regno='$membership_num'"));
?>
<?php 
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <h1 class="kingster-page-title">Update Biodata</h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-sidebar-wrapper">
            <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                <div class="gdlr-core-pbf-sidebar-content gdlr-core-column-45 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color:rgba(158, 228, 207, 0.33) ;"></div>
                    <div class="gdlr-core-pbf-sidebar-content-inner">
<div class="gdlr-core-pbf-element">
    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">

            <!-- Upcoming Events -->
            <?php if (isset($success)) { echo '<div class="alert alert-success">'.$success.'</div>'; } ?>
            <?php if (isset($error)) { echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>
           <?php  echo "<h5 style='color:green; align:center;float:center;'><center>Your Membership Number: " . strtoupper(($biodata['username']) ?? 'Not Assigned Yet') . "</center></h5>"; ?>

            <?php
                $message = "<h3>Update your Biodata</h3>"; // Default message

                // Check if regno exists in updated_bio (update_status = 1)
                $updateCheck = mysqli_query($conn, "SELECT update_status FROM updated_bio WHERE regno='$membership_num'");
                if ($updateCheck && mysqli_num_rows($updateCheck) > 0) {
                $message = "<h3>You have updated your biodata</h3>"; // Change message if already updated
                }

               echo "<center>{$message}</center>";
            ?>
            <hr />
            <div class="form-container">
        <form method="POST" enctype="multipart/form-data">
       
            <div class="col">
                <label>First Name *</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $biodata['first_name'] ?? ''; ?>" <?php echo $lockFields ? 'disabled' : ''; ?> required>
            </div>
            <div class="col">
                <label>Last Name *</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $biodata['last_name'] ?? ''; ?>" <?php echo $lockFields ? 'disabled' : ''; ?> required>
            </div>
        

        
            <label>Email *</label>
            <input type="email" name="email" class="form-control" value="<?php echo $biodata['email'] ?? ''; ?>" <?php echo $lockFields ? 'disabled' : ''; ?> required>
        

        
            <label>Gender</label>
            <select name="gender" class="form-control" <?php echo $lockFields ? 'disabled' : ''; ?>>
                <option value="Male" <?php if (($biodata['gender'] ?? '') == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if (($biodata['gender'] ?? '') == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Prefer not to Say" <?php if (($biodata['gender'] ?? '') == 'Prefer not to Say') echo 'selected'; ?>>Prefer not to Say</option>
            </select>
                
            <?php if (!empty($biodata['passport'])): ?>
    <div style="margin-bottom: 10px;">
        <img src="<?php echo $biodata['passport']; ?>" alt="Passport" style="width: 120px; border: 1px solid #ccc;">
    </div>
         <?php endif; ?>

                <label>Upload Passport Photo</label>
               <input type="file" name="passport" class="form-control" <?php echo $lockFields ? 'disabled' : ''; ?>>
    
            <label>Phone Number *</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $biodata['phone'] ?? ''; ?>" <?php echo $lockFields ? 'disabled' : ''; ?> required>
        

        
            <label>Street Address *</label>
            <input type="text" name="address" class="form-control" value="<?php echo $biodata['street_address'] ?? ''; ?>" <?php echo $lockFields ? 'disabled' : ''; ?> required>
        

        
            
                <label>City *</label>
                <input type="text" name="city" class="form-control" value="<?php echo $biodata['city'] ?? ''; ?>" <?php echo $lockFields ? 'disabled' : ''; ?> required>
           
            
                <label>State *</label>
                <input type="text" name="state" class="form-control" value="<?php echo $biodata['state'] ?? ''; ?>" <?php echo $lockFields ? 'disabled' : ''; ?> required>
           
      

       
            <label>Country *</label>
            <input type="text" name="country" class="form-control" value="<?php echo $biodata['country'] ?? ''; ?>" <?php echo $lockFields ? 'disabled' : ''; ?> required>
        

        
            <label>List your first three Wikimedia projects *</label>
            <input type="text" name="wikipedia_projects" class="form-control" value="<?php echo $biodata['wikimedia_projects'] ?? ''; ?>"<?php echo $lockFields ? 'disabled' : ''; ?> required>
        

         
        
            <label>Are you involved in the open movement?</label>
            <textarea name="open_movement" class="form-control" <?php echo $lockFields ? 'disabled' : ''; ?>><?php echo $biodata['involvement_open_movement'] ?? ''; ?></textarea >
        

        
            <label>Are you involved with WUGN Activities?</label>
            <select name="wugn_activities" class="form-control" <?php echo $lockFields ? 'disabled' : ''; ?>>
                <option value="Yes" <?php if (($biodata['wugn_activities'] ?? '') == 'Yes') echo 'selected'; ?>>Yes</option>
                <option value="No" <?php if (($biodata['wugn_activities'] ?? '') == 'No') echo 'selected'; ?>>No</option>
            </select>
       

        
            <label>Do you belong to a WUGN Fan Club/Network?</label>
            <input type="text" name="fan_club" class="form-control" value="<?php echo $biodata['fan_club_network'] ?? ''; ?>"<?php echo $lockFields ? 'disabled' : ''; ?>>
        

        
            <label>Are you a member of other Usergroups/communities in Nigeria?</label>
            <input type="text" name="other_usergroups" class="form-control" value="<?php echo $biodata['other_usergroups'] ?? ''; ?>"<?php echo $lockFields ? 'disabled' : ''; ?>>
        

        
            <label>Do you agree to the declaration?</label>
            <select name="declaration" class="form-control" <?php echo $lockFields ? 'disabled' : ''; ?>>
                <option value="Yes" <?php if (($biodata['declaration'] ?? '') == 'Yes') echo 'selected'; ?>>Yes</option>
                <option value="No" <?php if (($biodata['declaration'] ?? '') == 'No') echo 'selected'; ?>>No</option>
            </select>
        

        <button type="submit" name="update" class="btn btn-primary w-100"<?php echo $lockFields ? 'disabled' : ''; ?>>Update Biodata</button>
        <a href="logout.php" class="btn btn-danger w-100 mt-2">Logout</a>

        
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
                            <?php include "regsidemenu.php"; ?>
                            <br>
                           
                                     <?php
$showPaymentTable = false;

// Check the latest payment date for regno
$paymentCheck = mysqli_query($conn, "SELECT date FROM payments WHERE membership_num='$membership_num' ORDER BY date DESC LIMIT 1");

if ($paymentCheck && mysqli_num_rows($paymentCheck) > 0) {
    $paymentRow = mysqli_fetch_assoc($paymentCheck);
    $lastPaymentDate = strtotime($paymentRow['date']);
    $currentDate = time();

    // Check if 365 days have passed
    if (($currentDate - $lastPaymentDate) >= (365 * 24 * 60 * 60)) {
        $showPaymentTable = true;
    }
}

// Show payment status
if ($showPaymentTable) {
    echo "<center><h5 style='color:#ffff; hover:red;' class='kingster-widget-title'><a href='payannual.php' style='color:#ffff;'>Pay Your Annual Due</a></h5></center>";
} else {
    echo "<center><h3 class='kingster-widget-title'>Annual Due for the year is Paid ✅ </h3></center>";
}

$categoryCheck = mysqli_query($conn, "SELECT mem_category FROM biodata WHERE regno = '$membership_num' OR username = '$membership_num'");

if ($categoryCheck && mysqli_num_rows($categoryCheck) > 0) {
    $categoryRow = mysqli_fetch_assoc($categoryCheck);
    $mem_category = strtolower($categoryRow['mem_category']);

    if ($mem_category == 'student') {
        echo '
        <div style="text-align: center; margin-top: 25px;">
            <a href="#" onclick="document.getElementById(\'ref-box\').style.display=\'block\'">
                📩 Request Reference Letter
            </a>
            <div id="ref-box" style="display: none; margin-top: 10px;">
                Email us at <strong>info@wikimedia.org.ng</strong><br>
                or fill out this <a href="https://forms.gle/your-google-form-link" target="_blank">Google Form</a>.
            </div>
        </div>';
    }
}

?>


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
            "home_url": "index.php"
        };
    </script>
    <script type='text/javascript' src='js/plugins.min.js'></script>
</body>
</html>