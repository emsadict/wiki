<?php
include 'db.php';
$years_query = "SELECT DISTINCT year FROM calendar ORDER BY year DESC";
$years_result = mysqli_query($conn, $years_query);
if ($row = mysqli_fetch_assoc($years_result)) {
    $year = $row['year']; // Fetch the year value from the database
}
// Function to generate random membership number like WUG12345
function generateMembershipNumber() {
    $randomNumber = rand(10000, 99999);
    return "WUG" . $randomNumber;
}

// Generate and store membership number in session
session_start();
if (!isset($_SESSION['membership_num'])) {
    $_SESSION['membership_num'] = generateMembershipNumber();
}
$membership_num = $_SESSION['membership_num'];

// Initialize variables
$errors = [];
$surname = $othernames = $phone = $email = $membership_category = $amount = "";

// Handle form submission

   
   
    // If no errors, redirect to pay.php
  
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']); // Clear errors after showing
?>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Membership Registration | WUGN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    <h2 class="text-center">Become a Member of WUGN</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="membershipForm" action="pay.php" method="POST">

        <input type="hidden" name="membership_num" value="<?php echo htmlspecialchars($membership_num); ?>">
        
        <input type="hidden" id="year" name="year" value="<?php echo $year; ?>">

        <div class="mb-3">
            <label class="form-label">Membership Number</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($membership_num); ?>" readonly>
        </div>
    
        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" class="form-control" name="surname" id="surname" value="<?php echo htmlspecialchars($surname); ?>">
        </div>

        <div class="mb-3">
            <label for="othernames" class="form-label">Other Names</label>
            <input type="text" class="form-control" name="othernames" id="othernames" value="<?php echo htmlspecialchars($othernames); ?>">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo htmlspecialchars($phone); ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>">
        </div>

        <div class="mb-3">
    <label for="membership_category" class="form-label">Membership Category</label>
    <select name="membership_category" id="membership_category" class="form-select" required>
        <option value="">Select Category</option>
        <?php
            $query2 = mysqli_query($conn, "SELECT * FROM payment_types WHERE category='membership'");
            while ($row2 = mysqli_fetch_array($query2)) {
                $selected = ($membership_category == $row2['id']) ? 'selected' : '';
                echo "<option value='".htmlspecialchars($row2['id'])."' 
                            data-amount='".htmlspecialchars($row2['amount'])."' 
                            data-type='".htmlspecialchars($row2['type'])."' 
                            data-category='".htmlspecialchars($row2['category'])."' 
                            $selected>
                            ".htmlspecialchars($row2['type'])."
                      </option>";
            }
        ?>
    </select>
</div>

<!-- Hidden fields to capture type and category -->
<input type="hidden" name="payment_type" id="payment_type">
<input type="hidden" name="payment_category" id="payment_category">


        <div class="mb-3">
            <label for="amount" class="form-label">Amount (₦)</label>
            <input type="text" name="amount" id="amount" class="form-control" value="<?php echo htmlspecialchars($amount); ?>" readonly>
        </div>

        <button type="submit" class="btn btn-primary w-100">Proceed to Payment</button>
    </form><br/>
    <center><h6>ALREADY REGISTERED? LOGIN  <a href="login.php">HERE </a></h6><c/enter>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Populate amount when membership category is selected
    document.getElementById('membership_category').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const amount = selectedOption.getAttribute('data-amount') || '';
        document.getElementById('amount').value = amount;
    });
</script>
<script>
document.getElementById('membership_category').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var type = selectedOption.getAttribute('data-type');
    var category = selectedOption.getAttribute('data-category');

    document.getElementById('payment_type').value = type;
    document.getElementById('payment_category').value = category;
});
</script>

</body>
</html>














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
                        <h1 class="kingster-page-title">PAGE</h1></div>
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
            <Center><h3>Upcoming Events</h3></Center>
            <hr />
            
                
                
                
          

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