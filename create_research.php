<?php

include 'db_connect.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $date = $_POST['date'];
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $objectives = $_POST['objectives'];
    $principal_investigator = $_POST['principal_investigator'];
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $school = $_POST['school'];
    $qualifications = $_POST['qualifications'];
    $co_investigators = $_POST['co_investigators'];
    $co_designations = $_POST['co_designations'];
    $co_departments = $_POST['co_departments'];
    $co_schools = $_POST['co_schools'];
    $co_qualifications = $_POST['co_qualifications'];
    $findings = $_POST['findings'];
    $recommendations = $_POST['recommendations'];
    $other_information = $_POST['other_information'];

    // Handle Image Upload
    $image = "";
    if (!empty($_FILES['image']['name'])) {
        $image = "uploads/" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    // Handle Thumbnail Upload
    $thumbnail = "";
    if (!empty($_FILES['thumbnail']['name'])) {
        $thumbnail = "uploads/" . basename($_FILES['thumbnail']['name']);
        move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnail);
    }

    // Insert data into database
    $query = "INSERT INTO research_activities 
              (date, title, abstract, objectives, image, thumbnail, principal_investigator, designation, department, school, qualifications, 
              co_investigators, co_designations, co_departments, co_schools, co_qualifications, findings, recommendations, other_information) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssssssssssss", $date, $title, $abstract, $objectives, $image, $thumbnail, 
                      $principal_investigator, $designation, $department, $school, $qualifications, 
                      $co_investigators, $co_designations, $co_departments, $co_schools, $co_qualifications, 
                      $findings, $recommendations, $other_information);
    
    if ($stmt->execute()) {
        $message= "Research activity successfully created!";
    } else {
        $message= "Error: " . $stmt->error . "";
    }
    
    $stmt->close();
    $conn->close();
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
                                                        <center>   <h2>Post Research Activity</h2></center>
                                                              <hr />  
                                                           <?php if (!empty($message)) { echo "<div class='alert alert-success text-center'>$message</div>"; } ?>
                                                           <div class="form-container">
                                                           <form action="create_research.php" method="POST" enctype="multipart/form-data">
        <label>Date:</label>
        <input type="date" name="date" required><br>

        <label>Title:</label>
        <input type="text" name="title" required><br>

        <label>Abstract:</label>
        <textarea name="abstract" required></textarea><br>

        <label>Objectives:</label>
        <textarea name="objectives" required></textarea><br>

        <label>Principal Investigator:</label>
        <input type="text" name="principal_investigator" required><br>

        <label>Designation:</label>
        <input type="text" name="designation" required><br>

        <label>Department:</label>
        <input type="text" name="department" required><br>

        <label>School:</label>
        <input type="text" name="school" required><br>

        <label>Qualifications:</label>
        <input type="text" name="qualifications" required><br>

        <label>Co-Investigators (comma-separated):</label>
        <input type="text" name="co_investigators"><br>

        <label>Co-Designations (comma-separated):</label>
        <input type="text" name="co_designations"><br>

        <label>Co-Departments (comma-separated):</label>
        <input type="text" name="co_departments"><br>

        <label>Co-Schools (comma-separated):</label>
        <input type="text" name="co_schools"><br>

        <label>Co-Qualifications (comma-separated):</label>
        <input type="text" name="co_qualifications"><br>

        <label>Findings:</label>
        <textarea name="findings" required></textarea><br>

        <label>Recommendations:</label>
        <textarea name="recommendations" required></textarea><br>

        <label>Other Information:</label>
        <textarea name="other_information"></textarea><br>

        <label>Upload Image:</label>
        <input type="file" name="image"><br>

        <label>Upload Thumbnail:</label>
        <input type="file" name="thumbnail"><br>

        <button type="submit">Create Research</button>
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