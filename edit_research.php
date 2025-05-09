<?php
include 'db_connect.php'; // Include database connection

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid Research ID.";
    exit;
}

$research_id = $_GET['id'];

// Fetch research details
$query = "SELECT * FROM research_activities WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $research_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Research not found.";
    exit;
}

$research = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $findings = $_POST['findings'];
    $objective = $_POST['objectives'];
    $principal_investigator = $_POST['principal_investigator'];
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $school = $_POST['school'];
    $qualifications = $_POST['qualifications'];
    $co_investigators = $_POST['co_investigators'];
    $designations = $_POST['co_designations'];
    $departments = $_POST['co_departments'];
    $schools = $_POST['co_schools'];
    $recommendations = $_POST['recommendations'];
    $other_info = $_POST['other_information'];

    // Handle image upload
    $image = $research['image'];
    $thumbnail = $research['thumbnail'];

    if (!empty($_FILES['image']['name'])) {
        $image = "uploads/" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    if (!empty($_FILES['thumbnail']['name'])) {
        $thumbnail = "uploads/" . basename($_FILES['thumbnail']['name']);
        move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnail);
    }

    // Update query
    $update_query = "UPDATE research_activities SET 
                     date=?, title=?, abstract=?, findings=?, objectives=?, 
                     principal_investigator=?, designation=?, department=?, school=?, qualifications=?, 
                     co_investigators=?, co_designations=?, co_departments=?, co_schools=?, 
                     image=?, thumbnail=?, recommendations=?, other_information=? 
                     WHERE id=?";

    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssssssssssssssssi", 
        $date, $title, $abstract, $findings, $objective, 
        $principal_investigator, $designation, $department, $school, $qualifications, 
        $co_investigators, $designations, $departments, $schools, 
        $image, $thumbnail, $recommendations, $other_info, $research_id
    );

    if ($stmt->execute()) {
        $message ="Research updated successfully!";
        header("Location: manage_research.php");
        exit;
    } else {
        $message = "Error updating research: " . $conn->error;
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
            <center><h2 style="float: center;">Edit Research</h2></center>
            <div class="form-container">
            <?php if (!empty($message)) { echo "$message"; } ?>
                <form action="" method="POST" enctype="multipart/form-data" style="padding: 40px; border: 2px;">
                <label>Date:</label>
        <input type="date" name="date" value="<?php echo $research['date']; ?>" required><br>

        <label>Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($research['title']); ?>" required><br>

        <label>Abstract:</label>
        <textarea name="abstract" required><?php echo htmlspecialchars($research['abstract']); ?></textarea><br>

        <label>Findings:</label>
        <textarea name="findings"><?php echo htmlspecialchars($research['findings']); ?></textarea><br>

        <label>Objective:</label>
        <textarea name="objective"><?php echo htmlspecialchars($research['objectives']); ?></textarea><br>

        <label>Principal Investigator:</label>
        <input type="text" name="principal_investigator" value="<?php echo htmlspecialchars($research['principal_investigator']); ?>" required><br>

        <label>Designation:</label>
        <input type="text" name="designation" value="<?php echo htmlspecialchars($research['designation']); ?>" required><br>

        <label>Department:</label>
        <input type="text" name="department" value="<?php echo htmlspecialchars($research['department']); ?>" required><br>

        <label>School:</label>
        <input type="text" name="school" value="<?php echo htmlspecialchars($research['school']); ?>" required><br>

        <label>Qualifications:</label>
        <input type="text" name="qualifications" value="<?php echo htmlspecialchars($research['qualifications']); ?>" required><br>

        <label>Co-Investigators:</label>
        <input type="text" name="co_investigators" value="<?php echo htmlspecialchars($research['co_investigators']); ?>"><br>

        <label>Designations:</label>
        <input type="text" name="designations" value="<?php echo htmlspecialchars($research['co_designations']); ?>"><br>

        <label>Departments:</label>
        <input type="text" name="departments" value="<?php echo htmlspecialchars($research['co_departments']); ?>"><br>

        <label>Schools:</label>
        <input type="text" name="schools" value="<?php echo htmlspecialchars($research['co_schools']); ?>"><br>

        <label>Recommendations:</label>
        <textarea name="recommendations"><?php echo htmlspecialchars($research['recommendations']); ?></textarea><br>

        <label>Other Information:</label>
        <textarea name="other_info"><?php echo htmlspecialchars($research['other_information']); ?></textarea><br>

        <label>Current Image:</label>
        <img src="<?php echo htmlspecialchars($research['image']); ?>" width="100"><br>
        <label>Upload New Image:</label>
        <input type="file" name="image"><br>

        <label>Current Thumbnail:</label>
        <img src="<?php echo htmlspecialchars($research['thumbnail']); ?>" width="100"><br>
        <label>Upload New Thumbnail:</label>
        <input type="file" name="thumbnail"><br>

        <button type="submit">Update Research</button>
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