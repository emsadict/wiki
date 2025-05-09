<?php
// Database connection
include "db_connect.php";
// Fetch news details by ID
$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id = $id";
$result = $conn->query($sql);
$news = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    
    // Check if a new image is uploaded
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        
        $update_sql = "UPDATE news SET title='$title', content='$content', image='$image' WHERE id=$id";
    } else {
        $update_sql = "UPDATE news SET title='$title', content='$content' WHERE id=$id";
    }

    if ($conn->query($update_sql) === TRUE) {
        echo "News updated successfully!";
        header("Location: manage_news.php");
    } else {
        echo "Error updating news: " . $conn->error;
    }
}

$conn->close();
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
                                                
                                           <center> <h2>Edit News</h2></center>
                                            <div class="form-container">
                                            <?php if (!empty($message)) { echo "<div class='alert alert-success text-center'>$message</div>"; } ?>
                                                          <form action="" method="POST" enctype="multipart/form-data">
                                                              <label>Title:</label>
                                                              <input type="text" name="title" value="<?php echo $news['title']; ?>" required><br><br>

                                                              <label>Content:</label><br>
                                                              <textarea name="content" id="message"  rows="5" required><?php echo $news['content']; ?></textarea><br><br>

                                                              <label>Current Image:</label><br>
                                                               <img src="uploads/<?php echo $news['image']; ?>" width="100"><br><br>

                                                              <label>New Image (Optional):</label>
                                                              <input type="file" name="image"><br><br>

                                                              <button type="submit">Update News</button>
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