<?php
// Database connection
include "db_connect.php";
// Fetch news details by ID
// Check if an event ID is provided
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    // Fetch the event details from the database
    $query = "SELECT * FROM events WHERE id = $event_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $event = mysqli_fetch_assoc($result);
    } else {
        echo "Event not found.";
        exit;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $event_venue = $_POST['event_venue'];
    $facebook = $_POST['event_virtual_link_facebook'];
    $twitter = $_POST['event_virtual_link_twitter'];
    $zoom = $_POST['event_virtual_link_zoom'];
    $google_meet = $_POST['event_virtual_link_googlemeet'];
    $youtube = $_POST['event_virtual_link_youtube'];
    $others = $_POST['event_virtual_link_others'];

    // Image Upload Handling
    $event_image = $event['event_image']; // Keep existing image by default
    $event_thumbnail = $event['event_thumbnail']; // Keep existing thumbnail by default

    if (!empty($_FILES['event_image']['name'])) {
        $image_name = basename($_FILES["event_image"]["name"]);
        $target_file = "uploads/" . $image_name;
        move_uploaded_file($_FILES["event_image"]["tmp_name"], $target_file);
        $event_image = $image_name;
    }

    if (!empty($_FILES['event_thumbnail']['name'])) {
        $thumbnail_name = basename($_FILES["event_thumbnail"]["name"]);
        $target_file_thumb = "uploads/" . $thumbnail_name;
        move_uploaded_file($_FILES["event_thumbnail"]["tmp_name"], $target_file_thumb);
        $event_thumbnail = $thumbnail_name;
    }

    // Update event details in the database
    $update_query = "UPDATE events SET 
        title = '$title', 
        description = '$description', 
        event_date = '$event_date', 
        event_time = '$event_time', 
        event_venue = '$event_venue', 
        event_image = '$event_image', 
        event_thumbnail = '$event_thumbnail', 
        event_virtual_link_facebook = '$facebook', 
        event_virtual_link_twitter = '$twitter', 
        event_virtual_link_zoom = '$zoom', 
        event_virtual_link_googlemeet = '$google_meet', 
        event_virtual_link_youtube = '$youtube', 
        event_virtual_link_others = '$others' 
        WHERE id = $event_id";

    if (mysqli_query($conn, $update_query)) {
         $message ="<div class='alert alert-success'>Event updated successfully!</div>";
    } else {
        $message="<div class='alert alert-danger'>Error updating event: " . mysqli_error($conn) . "</div>";
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
    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
            <center><h2 style="float: center;">Edit Event</h2></center>
            <div class="form-container">
            <?php if (!empty($message)) { echo "$message"; } ?>
                <form action="" method="POST" enctype="multipart/form-data" style="padding: 40px; border: 2px;">
                    <label>Title:</label>
                    <input type="text" name="title" value="<?php echo $event['title']; ?>" required><br>

                    <label>Description:</label><br>
                    <span class="wpcf7-form-control-wrap your-message">
                        <textarea name="description" id="message" required cols="40" rows="10" class="input1" aria-invalid="false"><?php echo $event['description']; ?></textarea><br>
                    </span>

                    <label>Event Date:</label><br>
                    <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>" required><br><br>

                    <label>Event Time:</label>
                    <input type="time" name="event_time" value="<?php echo $event['event_time']; ?>" required><br><br>

                    <label>Event Venue:</label>
                    <input type="text" name="event_venue" value="<?php echo $event['event_venue']; ?>" required><br><br>

                    <label>Current Event Image:</label><br>
                    <img src="uploads/<?php echo $event['event_image']; ?>" width="100"><br><br>

                    <label>New Event Image (Optional):</label>
                    <input type="file" name="event_image"><br><br>

                    <label>Current Event Thumbnail:</label><br>
                    <img src="uploads/<?php echo $event['event_thumbnail']; ?>" width="100"><br><br>

                    <label>New Event Thumbnail (Optional):</label>
                    <input type="file" name="event_thumbnail"><br><br>

                    <label>Facebook Link:</label>
                    <input type="url" name="event_virtual_link_facebook" value="<?php echo $event['event_virtual_link_facebook']; ?>"><br><br>

                    <label>Twitter Link:</label>
                    <input type="url" name="event_virtual_link_twitter" value="<?php echo $event['event_virtual_link_twitter']; ?>"><br><br>

                    <label>Zoom Link:</label>
                    <input type="url" name="event_virtual_link_zoom" value="<?php echo $event['event_virtual_link_zoom']; ?>"><br><br>

                    <label>Google Meet Link:</label>
                    <input type="url" name="event_virtual_link_googlemeet" value="<?php echo $event['event_virtual_link_googlemeet']; ?>"><br><br>

                    <label>YouTube Link:</label>
                    <input type="url" name="event_virtual_link_youtube" value="<?php echo $event['event_virtual_link_youtube']; ?>"><br><br>

                    <label>Other Virtual Link:</label>
                    <input type="url" name="event_virtual_link_others" value="<?php echo $event['event_virtual_link_others']; ?>"><br><br>

                    <button type="submit" class="btn btn-success" style="float:center;">Update Event</button>
                </form>
            </div>
        </div>
    </div>
</div>
                                </div>
                            </div>
                            <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left  kingster-sidebar-area gdlr-core-column-15 gdlr-core-pbf-sidebar-padding  gdlr-core-line-height">
                                
                                <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                                    
                                    
                                    <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget">
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