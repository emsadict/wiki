<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "website_management";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>

   <style>

/* Custom styling for success button (green) */
.btn-success {
    background-color: #28a745 !important; /* Bootstrap default green */
    border-color: #218838 !important;
    color: #f7f7f7 !important;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
}

.btn-success:hover {
    background-color: #218838 !important;
    border-color: #1e7e34 !important;
}

/* Custom styling for danger button (red) */
.btn-danger {
    background-color: #dc3545 !important; /* Bootstrap default red */
    border-color: #c82333 !important;
    color: white !important;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
}

.btn-danger:hover {
    background-color: #c82333 !important;
    border-color: #bd2130 !important;
}

/* Custom styling for primary button (blue) */
.btn-primary {
    background-color: #007bff !important; /* Bootstrap default blue */
    border-color: #0056b3 !important;
    color: white !important;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
}

.btn-primary:hover {
    background-color: #0056b3 !important;
    border-color: #004085 !important;
}
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
                
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
                <div class="gdlr-core-page-builder-body">
                    <div class="gdlr-core-pbf-sidebar-wrapper ">
                        <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container" id="madewith">
                      

<div class="gdlr-core-pbf-sidebar-content gdlr-core-column-45 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
    <div class="gdlr-core-pbf-background-wrap" style="background-color: #f7f7f7;"></div>
    <div class="gdlr-core-pbf-sidebar-content-inner">
        <div class="gdlr-core-pbf-element">
            <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
                <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                  
                    <?php if (isset($_GET['message'])): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['message']); ?></div>
<?php endif; ?>

<h2>Manage Research Activities</h2>

<a href="create_research.php">+ Add New Research</a>

<table class="table table-bordered table-striped">
    <thead class="table-success">
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Title</th>
            <th>Principal Investigator</th>
            <th>Department</th>
          <!--  <th>School</th>  -->
          <!--  <th>Image</th>  -->
            <th>Thumbnail</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT id, date, title, principal_investigator, department, school, image, thumbnail FROM research_activities ORDER BY date DESC";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['date']}</td>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['principal_investigator']}</td>";
                echo "<td>{$row['department']}</td>";
               // echo "<td>{$row['school']}</td>";
               // echo "<td><img src='{$row['image']}' width='50' height='50'></td>";
                echo "<td><img src='{$row['thumbnail']}' width='50' height='50'></td>";
                echo "<td>
                        <a href='edit_research.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a> | 
                        <a href='delete_research.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")' class='btn btn-danger btn-sm'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No research activities found.</td></tr>";
        }
        ?>
    </tbody>
</table>

                    	 	 	 	 	
                </div>
            </div>
        </div>
    </div>
</div>



                            <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left  kingster-sidebar-area gdlr-core-column-15 gdlr-core-pbf-sidebar-padding  gdlr-core-line-height">
                                
                                <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                                    
                                    
                                    <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgb(206, 234, 221) ; margin-top:10px;">
                                        <?php include "adminsidemenu.php"; ?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

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
<?php
$conn->close();
?>