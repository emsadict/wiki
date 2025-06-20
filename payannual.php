<?php 
session_start();
include 'db_connect.php';
if (!isset($_SESSION['membership_num'])) {
    header('Location: login.php');
    exit();
}

$membership_num = $_SESSION['membership_num'];
$current_year = date('Y');

// Step 1: Get member category
$biodataQuery = mysqli_query($conn, "SELECT mem_category FROM biodata WHERE regno='$membership_num'");
if (!$biodataQuery || mysqli_num_rows($biodataQuery) === 0) {
    die("Member not found.");
}
$biodata = mysqli_fetch_assoc($biodataQuery);
$category = $biodata['mem_category']; // Leave case as is

// Step 2: Check last annual payment
$paymentCheck = mysqli_query($conn, "SELECT * FROM payments WHERE membership_num='$membership_num' AND payment_type='membership' AND YEAR(date)='$current_year'");
$hasPaid = mysqli_num_rows($paymentCheck) > 0;

// Step 3: Get amount based on category

$duesQuery = mysqli_query($conn, "SELECT amount FROM payment_types WHERE category='membership' AND type='$category'");
if (!$duesQuery || mysqli_num_rows($duesQuery) === 0) {
    die("No dues amount found for this category.");
}
$dues = mysqli_fetch_assoc($duesQuery);
$amount = $dues['amount'] * 100; // Paystack works in kobo
?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
   <script src="https://js.paystack.co/v1/inline.js"></script>
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
                        <h1 class="kingster-page-title">PAY ANNUAL DUE</h1></div>
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
            <Center><h5>PAY YOUR ANNUAL DUE HERE</h5></Center>
            <hr />
                 <?php if ($hasPaid): ?>
        <h5>✅ You have already paid your annual due for <?= $current_year ?></h5>
    <?php else: ?>
        <h5>Annual Due for <?= ucfirst($category) ?>: ₦<?= number_format($amount / 100, 2) ?></h5>
        <button onclick="payWithPaystack()" id="pay-btn">💳 Pay Now</button>
    <?php endif; ?>

    

        </div>
    </div>
</div>

<style>
    #pay-btn {
    background-color: #2ecc71;
    border: none;
    color: white;
    padding: 12px 24px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

#pay-btn:hover {
    background-color: #27ae60;
}
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

    <script>
    function payWithPaystack() {
        var handler = PaystackPop.setup({
            key: 'pk_test_1d2af7bafefdf00bf8abbb18740392a67a7530ed',
            email: '<?= $_SESSION['user_email'] ?? 'user@example.com' ?>',
            amount: <?= $amount ?>,
            currency: 'NGN',
            ref: 'WGREF' + Math.floor((Math.random() * 1000000000) + 1),
            callback: function(response) {
                window.location.href = 'process_payment.php?reference=' + response.reference;
            },
            onClose: function() {
                alert('Payment cancelled');
            }
        });
        handler.openIframe();
    }
    </script>
</body>
</html>