<?php 
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
   <script src="https://js.paystack.co/v1/inline.js"></script>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                        <h1 class="kingster-page-title">DONATION PAGE</h1></div>
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
            <Center><h3>Donate to us</h3></Center>
            <hr />
            <!-- Display Success Message -->
    <div class="container mt-4">
    <!-- Check for Recent PAID Transactions -->
    <?php
    if (isset($_SESSION['transaction_id'])) {
        $transaction_id = $_SESSION['transaction_id'];
        $sql = "SELECT * FROM payments WHERE transaction_id = '$transaction_id' AND payment_status = 'PAID'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='alert alert-success'>
                    <strong>Success!</strong> Your donation was processed. this is your transaction id $transaction_id
                    <br><br>
                    <a href='receipt.php?transaction_id=$transaction_id' target='_blank' class='btn btn-warning' color='white'>
                        Print Your Receipt using the email you used to make the payment
                    </a>
                  </div>";
        }
    }
    ?>
</div>

                        <div class="form-container">
                            <form id="donationForm">
                                <label>Surname:</label>
                                <input type="text" id="surname" required><br>

                                <label>Other Names:</label>
                                <input type="text" id="othernames" required><br>

                                <label>Email:</label>
                                <input type="email" id="email" required><br>

                                <label>Phone:</label>
                                <input type="text" id="phone"><br>

                                <label>Amount (NGN):</label>
                                <input type="number" id="amount" required><br>

                                <button type="button" onclick="payWithPaystack()">Donate</button>
                            </form>
                        </div>
  

    <script>
function payWithPaystack() {
    var handler = PaystackPop.setup({
        key: 'pk_test_1d2af7bafefdf00bf8abbb18740392a67a7530ed', 
        email: document.getElementById("email").value,
        amount: document.getElementById("amount").value * 100, 
        currency: "NGN",
        callback: function(response) {
            saveTransaction(response.reference);
        },
        onClose: function() {
            alert("Transaction was not completed.");
        }
    });
    handler.openIframe();
}

function saveTransaction(transactionId) {
    var surname = document.getElementById("surname").value;
    var othernames = document.getElementById("othernames").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var amount = document.getElementById("amount").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save_payment.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            window.location.href = "donate.php";
        }
    };
    xhr.send("surname=" + surname + "&othernames=" + othernames + "&email=" + email +
             "&phone=" + phone + "&amount=" + amount + "&transaction_id=" + transactionId);
}
</script>          
          
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
    <!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>