<?php
session_start();
include 'db.php';
if (!isset($_SESSION['membership_num'])) {
    header('Location: login.php');
    exit();
}

$membership_num = $_SESSION['membership_num'];

// Handle biodata update
if (isset($_POST['update'])) {
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

    $query = mysqli_query($conn, "UPDATE biodata SET 
        firstname='$firstname', lastname='$lastname', email='$email', gender='$gender',
        phone='$phone', address='$address', city='$city', state='$state', country='$country',
        wikipedia_projects='$wikipedia_projects', wikipedia_account='$wikipedia_account',
        open_movement='$open_movement', wugn_activities='$wugn_activities',
        fan_club='$fan_club', other_usergroups='$other_usergroups', declaration='$declaration'
        WHERE regno='$membership_num'
    ");

    if ($query) {
        $success = "Biodata Updated Successfully!";
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
            <Center><h3>Update your Biodata</h3></Center>
            <hr />
            <div class="form-container">
        <form method="POST">
       
            <div class="col">
                <label>First Name *</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $biodata['first_name'] ?? ''; ?>" required>
            </div>
            <div class="col">
                <label>Last Name *</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $biodata['last_name'] ?? ''; ?>" required>
            </div>
        

        
            <label>Email *</label>
            <input type="email" name="email" class="form-control" value="<?php echo $biodata['email'] ?? ''; ?>" required>
        

        
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="Male" <?php if (($biodata['gender'] ?? '') == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if (($biodata['gender'] ?? '') == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Prefer not to Say" <?php if (($biodata['gender'] ?? '') == 'Prefer not to Say') echo 'selected'; ?>>Prefer not to Say</option>
            </select>
        

    
            <label>Phone Number *</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $biodata['phone'] ?? ''; ?>" required>
        

        
            <label>Street Address *</label>
            <input type="text" name="address" class="form-control" value="<?php echo $biodata['address'] ?? ''; ?>" required>
        

        
            
                <label>City *</label>
                <input type="text" name="city" class="form-control" value="<?php echo $biodata['city'] ?? ''; ?>" required>
           
            
                <label>State *</label>
                <input type="text" name="state" class="form-control" value="<?php echo $biodata['state'] ?? ''; ?>" required>
           
      

       
            <label>Country *</label>
            <input type="text" name="country" class="form-control" value="<?php echo $biodata['country'] ?? ''; ?>" required>
        

        
            <label>List your first three Wikimedia projects *</label>
            <input type="text" name="wikipedia_projects" class="form-control" value="<?php echo $biodata['wikipedia_projects'] ?? ''; ?>">
        

        
            <label>Do you have a Wikipedia account?</label>
            <input type="text" name="wikipedia_account" class="form-control" value="<?php echo $biodata['wikipedia_account'] ?? ''; ?>">
        

        
            <label>Are you involved in the open movement?</label>
            <textarea name="open_movement" class="form-control"><?php echo $biodata['open_movement'] ?? ''; ?></textarea>
        

        
            <label>Are you involved with WUGN Activities?</label>
            <select name="wugn_activities" class="form-control">
                <option value="Yes" <?php if (($biodata['wugn_activities'] ?? '') == 'Yes') echo 'selected'; ?>>Yes</option>
                <option value="No" <?php if (($biodata['wugn_activities'] ?? '') == 'No') echo 'selected'; ?>>No</option>
            </select>
       

        
            <label>Do you belong to a WUGN Fan Club/Network?</label>
            <input type="text" name="fan_club" class="form-control" value="<?php echo $biodata['fan_club'] ?? ''; ?>">
        

        
            <label>Are you a member of other Usergroups/communities in Nigeria?</label>
            <input type="text" name="other_usergroups" class="form-control" value="<?php echo $biodata['other_usergroups'] ?? ''; ?>">
        

        
            <label>Do you agree to the declaration?</label>
            <select name="declaration" class="form-control" required>
                <option value="Yes" <?php if (($biodata['declaration'] ?? '') == 'Yes') echo 'selected'; ?>>Yes</option>
                <option value="No" <?php if (($biodata['declaration'] ?? '') == 'No') echo 'selected'; ?>>No</option>
            </select>
        

        <button type="submit" name="update" class="btn btn-primary w-100">Update Biodata</button>
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
                            <h3 class="kingster-widget-title">Menu</h3><span class="clear"></span>
                            <ul>
                                



                            </ul>
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