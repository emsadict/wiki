<?php
require 'db_connect.php';

// Check if pg_id is set and valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Page ID");
}

$pg_id = $_GET['id'];

// Fetch Page Details
$query = "SELECT * FROM page_details WHERE pg_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $pg_id);
$stmt->execute();
$result = $stmt->get_result();
$details = $result->fetch_assoc();

// If page details do not exist, show error and redirect
if (!$details) {
    echo "<script>alert('Page details do not exist. Redirecting to create page details...'); window.location.href='create_page_details.php?id=$pg_id';</script>";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pg_intro = $_POST['pg_intro'];
    $pg_objective = $_POST['pg_objective'];
    $pg_phone = $_POST['pg_phone'];
    $pg_email = $_POST['pg_email'];

    $sql = "UPDATE page_details 
            SET pg_intro=?, pg_objective=?, pg_phone=?, pg_email=? 
            WHERE pg_id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $pg_intro, $pg_objective, $pg_phone, $pg_email, $pg_id);

    if ($stmt->execute()) {
        $message = "<p style='color: green;'>Page details updated successfully!</p>";
    } else {
        $message = "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}
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
                        <h1 class="kingster-page-title">EVENTS PAGE</h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-sidebar-wrapper">
            <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                <div class="gdlr-core-pbf-sidebar-content gdlr-core-column-45 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color:rgba(158, 228, 207, 0.53) ;"></div>
                    <div class="gdlr-core-pbf-sidebar-content-inner">
<div class="gdlr-core-pbf-element">
    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">

        <Center><h2>Edit Page Details</h2></Center>
        <div class="form-container">
<form method="POST">
    <label>Introduction:</label>
    <textarea name="pg_intro" required><?= $details['pg_intro'] ?></textarea><br>

    <label>Objective:</label>
    <textarea name="pg_objective" required><?= $details['pg_objective'] ?></textarea><br>

    <label>Phone:</label>
    <input type="text" name="pg_phone" value="<?= $details['pg_phone'] ?>" required><br>

    <label>Email:</label>
    <input type="email" name="pg_email" value="<?= $details['pg_email'] ?>" required><br>

    <input type="submit" value="Update Page Details">
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