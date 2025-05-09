<?php
require 'db_connect.php';

// Fetch pages that do not exist in page_details
$query = "SELECT p.pg_id, p.pg_title, p.pg_category 
          FROM pages_table p 
          LEFT JOIN page_details d ON p.pg_id = d.pg_id 
          WHERE d.pg_id IS NULL";

$result = $conn->query($query);
$pages = $result->fetch_all(MYSQLI_ASSOC);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pg_id = $_POST['pg_id'];
    $pg_category = $_POST['pg_category'];
    $pg_intro = $_POST['pg_intro'];
    $pg_objective = $_POST['pg_objective'];
    $pg_phone = $_POST['pg_phone'];
    $pg_email = $_POST['pg_email'];

    // Insert into page_details
    $sql = "INSERT INTO page_details (pg_id, pg_category, pg_intro, pg_objective, pg_phone, pg_email) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $pg_id, $pg_category, $pg_intro, $pg_objective, $pg_phone, $pg_email);

    if ($stmt->execute()) {
        echo "<script>alert('Page details created successfully!'); window.location.href='create_page_details.php';</script>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
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
                        <h1 class="kingster-page-title">UPDATE PAGE DETAILS</h1></div>
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
        <script>
        function updateCategory(select) {
            document.getElementById("pg_category").value = select.options[select.selectedIndex].getAttribute("data-category");
        }
    </script>
       
<div class="form-container" >
<Center><h2>UPDATE PAGE DETAILS</h2></Center>
<form method="POST">
    <label>Select Page:</label><br>
    <select name="pg_id" required onchange="updateCategory(this)">
        <option value="">-- Select Page --</option>
        <?php foreach ($pages as $page) : ?>
            <option value="<?= $page['pg_id'] ?>" data-category="<?= ucfirst($page['pg_category']) ?>">
                <?= ucfirst(htmlspecialchars($page['pg_title'])) ?> (<?= ucfirst(htmlspecialchars($page['pg_category'])) ?>)
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Category:</label><br>
    <input type="text" name="pg_category" id="pg_category" readonly required><br>

    <label>Introduction:</label><br>
    <textarea name="pg_intro" required></textarea><br>

    <label>Objective:</label><br>
    <textarea name="pg_objective" required></textarea><br>

    <label>Phone:</label><br>
    <input type="text" name="pg_phone" required><br>

    <label>Email:</label><br>
    <input type="email" name="pg_email" required><br>

    <button type="submit">Create Page Details</button>
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