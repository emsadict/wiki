<?php 
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
                        <h1 class="kingster-page-title">RECEIPT REPRINT PAGE</h1></div>
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
            <Center><h3>RECEIPT REPRINT</h3></Center>
            <hr />
            <!-- begining -->
              
    <div class="form-container">
    <form method="POST">
        <label>Enter Email or Membership Number:</label>
        <input type="text" name="search_value" required>
        <input type="submit" value="Search">
    </form>
    </div>
    <?php
    // Database connection
    $conn = new mysqli("localhost", "root", "", "membership_management");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search_value = $_POST["search_value"];

        // Fetch payment records by email or membership number
        $sql = "SELECT * FROM payments WHERE email = '$search_value' OR membership_num = '$search_value'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>S/N</th><th>Surname</th><th>Other Names</th><th>Payment Type</th><th>Date</th><th>Action</th></tr>";
            $sn = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$sn}</td>
                        <td>{$row['surname']}</td>
                        <td>{$row['othernames']}</td>
                        <td>{$row['payment_type']}</td>
                        <td>{$row['date']}</td>
                        <td><a href='print_receipt.php?id={$row['id']}' target='_blank'>Print Receipt</a></td>
                      </tr>";
                $sn++;
            }
            echo "</table>";
        } else {
            echo "No payment records found!";
        }
    }
    ?>
            <!-- end -->
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
                                
                                        <li> <a href="blog.php">News</a></li>
                                            <li> <a href="events.php">Events</a></li>
                                           <li> <a href="receipt.php">Print e-Reciep of Payment</a></li>
                                           <li> <a href="login.php">Back to Membership Login </a></li>
                                           <li> <a href="update_biodata.php">Return to Dashboard</a></li>
                                           <li> <a href="logout.php">Log Out</a></li>
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