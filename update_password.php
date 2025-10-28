<?php
include 'db.php';

if (isset($_GET['membership_num'])) {
    $membership_num = mysqli_real_escape_string($conn, $_GET['membership_num']);
}

if (isset($_POST['update'])) {
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $membership_num = mysqli_real_escape_string($conn, $_POST['membership_num']);

    $update = mysqli_query($conn, "UPDATE membership_accounts SET password='$new_password' WHERE membership_num='$membership_num'");
    if ($update) {
        echo "<script>alert('Password updated successfully. You can now login.'); window.location.href='login.php';</script>";
        exit();
    } else {
        $error = "Failed to update password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
   <script src="https://cdn.tiny.cloud/1/t9taiaqmm14eridxhtuvgduaf2quietkuuzlox6uilkap6t7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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
                        <h1 class="kingster-page-title">MEMBERHSIP LOGIN PAGE</h1></div>
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
            <Center><h3>RESET YOUR PASSWORD HERE</h3></Center>
            <?php if (isset($_GET['success'])) { echo '<div class="alert alert-success">Registration Successful! Please login.</div>'; } ?>
           <?php if (isset($error)) { echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>

<!-- new notification from paymetn redirects-->
<!-- end of notification from payment redirects -->
            <hr />
            <div class="form-container">
            



<?php
include 'db.php';

if (isset($_GET['membership_num'])) {
    $membership_num = mysqli_real_escape_string($conn, $_GET['membership_num']);
}

if (isset($_POST['update'])) {
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $membership_num = mysqli_real_escape_string($conn, $_POST['membership_num']);

    $update = mysqli_query($conn, "UPDATE membership_accounts SET password='$new_password' WHERE membership_num='$membership_num'");
    if ($update) {
        echo "<script>alert('Password updated successfully. You can now login.'); window.location.href='login.php';</script>";
        exit();
    } else {
        $error = "Failed to update password.";
    }
}
?>

<h3>Set New Password</h3>
<?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
<form method="POST">
    <input type="hidden" name="membership_num" value="<?php echo htmlspecialchars($membership_num); ?>">
    <label>New Password</label>
    <input type="password" name="new_password" required>
    <button type="submit" name="update">Update Password</button>
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
                        
                            <?php include "loginmenu.php"; ?>
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
 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JavaScript (for interactive components like modals, dropdowns, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>




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