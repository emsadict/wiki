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
                        <?php
                             $query = "SELECT * FROM events";
                             $result = mysqli_query($conn, $query);
                             ?>

<div class="gdlr-core-pbf-sidebar-content gdlr-core-column-45 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
    <div class="gdlr-core-pbf-background-wrap" style="background-color: #f7f7f7;"></div>
    <div class="gdlr-core-pbf-sidebar-content-inner">
        <div class="gdlr-core-pbf-element">
            <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
                <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                    <h2>Manage Events</h2>
                    <?php if (isset($_GET['message'])): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['message']); ?></div>
<?php endif; ?>

                    <table class="table table-bordered table-striped">
                        <thead class="table-success">
                            <tr>
                                <th>ID</th>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Venue</th>
                                <th>Social Media Links</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                             $counter = 1; // Start ID from 1
                            while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?php  echo $counter++; ?></td>
                                    <td><?= $row['title']; ?></td>
                                    <td><?= $row['event_date']; ?></td>
                                    <td><?= $row['event_time']; ?></td>
                                    <td><?= $row['event_venue']; ?></td>
                                    <td>
                                        <?php if (!empty($row[' event_virtual_link_facebook'])): ?>
                                            <a href="<?= $row[' event_virtual_link_facebook']; ?>" target="_blank">Facebook</a> |
                                        <?php endif; ?>
                                        <?php if (!empty($row['event_virtual_link_twitter'])): ?>
                                            <a href="<?= $row['event_virtual_link_twitter']; ?>" target="_blank">Twitter</a> |
                                        <?php endif; ?>
                                        <?php if (!empty($row['event_virtual_link_zoom'])): ?>
                                            <a href="<?= $row['event_virtual_link_zoom']; ?>" target="_blank">Zoom</a> |
                                        <?php endif; ?>
                                        <?php if (!empty($row['event_virtual_link_youtube'])): ?>
                                            <a href="<?= $row['event_virtual_link_youtube']; ?>" target="_blank">YouTube</a> |
                                        <?php endif; ?>
                                        <?php if (!empty($row['event_virtual_link_googlemeet'])): ?>
                                            <a href="<?= $row['event_virtual_link_googlemeet']; ?>" target="_blank">Google Meet</a>
                                        <?php endif; ?>
                                        <?php if (!empty($row['event_virtual_link_others'])): ?>
                                            <a href="<?= $row['event_virtual_link_others']; ?>" target="_blank">Others</a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit_event.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="deletevent.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
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