<?php 
ob_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
   
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
                        <h1 class="kingster-page-title">Print Memberhip Card</h1></div>
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
            <Center><h3>PRINT YOUR MEMBERHSIP CARD</h3></Center>
            <hr />
            <!-- heere -->
                <?php

// Get current year
$current_year = date("Y");

// Only run this block if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_value'])) {

    // Make sure you have your database connection set up here
    $user_input = mysqli_real_escape_string($conn, $_POST['search_value']);

    // Fetch user details from biodata
    $sql = "SELECT * FROM biodata WHERE regno = '$user_input' OR username = '$user_input'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $regno = $user_data['regno'];
        $username = $user_data['username'];
        $name = $user_data['first_name'] . ' ' . $user_data['last_name'];
        $dept = $user_data['mem_category'];
        
        // Check for membership payment
        $payment_check = "SELECT * FROM payments WHERE (membership_num = '$regno' OR membership_num = '$username') AND YEAR(date) = '$current_year' AND payment_type = 'membership'";
        $payment_result = mysqli_query($conn, $payment_check);

        if ($payment_result && mysqli_num_rows($payment_result) > 0) {
            echo "<div style='text-align: center; margin-top: 20px; padding: 20px;'>
        <a href='printcard.php?regno=" . urlencode($regno) . "' target='_blank'>
            <button class='btn btn-success'>Open Membership Card</button>
        </a>
      </div>";
        } else {
            echo "<div style='color: red; font-weight: bold;'>No membership payment found for $current_year, Hence you can not print membership card!</div>";
        }
    } else {
        echo "<div style='color: red; font-weight: bold;'>User not found!</div>";
    }
}
?>

<!-- Search Form -->
<form method="POST" action="card.php">
    <label>Enter Reg No or Username:</label>
    <input type="text" name="search_value" required>
    <input type="submit" value="Search">
</form>

<div style="text-align: center; margin-top: 15px;">
    <a href="update_biodata.php" style="text-decoration: none; color: blue;">
        ← Back to Biodata Page
    </a>
</div>


            <!--end -->
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

<?php //mysqli_close($conn); ?>


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