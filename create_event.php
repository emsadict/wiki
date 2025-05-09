<?php
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connect.php'; // Include your database connection file

    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $event_venue = $_POST['event_venue'];
    $facebook = $_POST['event_virtual_link_facebook'] ?? null;
    $twitter = $_POST['event_virtual_link_twitter'] ?? null;
    $zoom = $_POST['event_virtual_link_zoom'] ?? null;
    $googlemeet = $_POST['event_virtual_link_googlemeet'] ?? null;
    $youtube = $_POST['event_virtual_link_youtube'] ?? null;
    $others = $_POST['event_virtual_link_others'] ?? null;

    // File upload handling
    $target_dir = "uploads/"; // Directory to store images
    $event_image = $target_dir . basename($_FILES["event_image"]["name"]);
    $event_thumbnail = $target_dir . basename($_FILES["event_thumbnail"]["name"]);

    if (move_uploaded_file($_FILES["event_image"]["tmp_name"], $event_image) &&
        move_uploaded_file($_FILES["event_thumbnail"]["tmp_name"], $event_thumbnail)) {
        
        $sql = "INSERT INTO events (title, description, event_date, event_time, event_venue, 
                                  event_image, event_thumbnail, event_virtual_link_facebook, 
                                  event_virtual_link_twitter, event_virtual_link_zoom, 
                                  event_virtual_link_googlemeet, event_virtual_link_youtube, 
                                  event_virtual_link_others) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssss", $title, $description, $event_date, $event_time, 
                          $event_venue, $event_image, $event_thumbnail, $facebook, 
                          $twitter, $zoom, $googlemeet, $youtube, $others);
        
        if ($stmt->execute()) {
            $message = "Event posted successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }
    } else {
        $message = "Failed to upload images.";
    }
}
?>





<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
   <script src="https://cdn.tiny.cloud/1/t9taiaqmm14eridxhtuvgduaf2quietkuuzlox6uilkap6t7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>
<script>
tinymce.init({
    selector: '#message', // Target the textarea
    menubar: false, // Hide menu bar (optional)
    plugins: 'lists link image code', // Add desired plugins
    toolbar: 'bold italic underline | bullist numlist | link image | code', // Customize toolbar
    height: 250, // Adjust height
    branding: false // Hide "Powered by TinyMCE"
});
</script>

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
                            <div class="gdlr-core-pbf-sidebar-content  gdlr-core-column-45 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                                <div class="gdlr-core-pbf-background-wrap" style="background-color:rgba(158, 228, 207, 0.53) ;"></div>
                                <div class="gdlr-core-pbf-sidebar-content-inner">
                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix  gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px ;">
                                            <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                                                       <center><h2>Post Upcoming Event</h2></center>
                                                              <hr />  
                                                           <?php if (!empty($message)) { echo "<div class='alert alert-success text-center'>$message</div>"; } ?>
                                                           <div class="form-container">
                                                           <form action="create_event.php" method="POST" class="" enctype="multipart/form-data" style="padding: 40px; border: 2px;">
                                                           <label>Title:</label>
                                                           <input type="text" name="title" required><br>

                                                           <label>Description:</label><br>
                                                           <span class="wpcf7-form-control-wrap your-message">
                                                           <textarea name="description" id="message" required cols="40" rows="10" class="input1" aria-invalid="false"></textarea><br>
                                                           </span>
                                                           <label>Event Date:</label><br>
                                                           <input type="date" name="event_date" required><br><br>

                                                           <label>Event Time:</label>
                                                           <input type="time" name="event_time" required><br><br>

                                                           <label>Event Venue:</label>
                                                           <input type="text" name="event_venue" required><br><br>

                                                           <label>Event Image:</label>
                                                           <input type="file" name="event_image" required><br><br>

                                                           <label>Event Thumbnail:</label>
                                                           <input type="file" name="event_thumbnail" required><br><br>

                                                           <label>Facebook Link:</label>
                                                           <input type="url" name="event_virtual_link_facebook"><br><br>

                                                           <label>Twitter Link:</label>
                                                           <input type="url" name="event_virtual_link_twitter"><br><br>

                                                           <label>Zoom Link:</label>
                                                           <input type="url" name="event_virtual_link_zoom"><br><br>

                                                           <label>Google Meet Link:</label>
                                                           <input type="url" name="event_virtual_link_googlemeet"><br><br>

                                                           <label>YouTube Link:</label>
                                                           <input type="url" name="event_virtual_link_youtube"><br><br>

                                                           <label>Other Virtual Link:</label>
                                                           <input type="url" name="event_virtual_link_others"><br><br>

                                                           <button type="submit" class=" btn btn-success"style="float:center;">Post Event</button>
                                                       </form>
                                                           </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left  kingster-sidebar-area gdlr-core-column-15 gdlr-core-pbf-sidebar-padding  gdlr-core-line-height">
                                
                                <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                                    <button class="btn btn-success"> Back to admin</button> <br />
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
            "home_url": "index.html"
        };
    </script>
    <script type='text/javascript' src='js/plugins.min.js'></script>
</body>
</html>