<?php
require 'db_connect.php';

$pg_id = $_GET['id'];
$page = $conn->query("SELECT * FROM pages_table WHERE pg_id = $pg_id")->fetch_assoc();

if (isset($_GET['id'])) {
    $page_id = $_GET['id'];
    
    // Fetch page details from the database
    $query = "SELECT * FROM pages_table WHERE pg_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $pg_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $page = $result->fetch_assoc();
    } else {
        echo "<p>Page not found.</p>";
        exit;
    }
} else {
    echo "<p>Invalid Page ID.</p>";
    exit;
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



            <div class="kingster-page-title-wrap  kingster-style-custom kingster-left-align" style="background-image: url(uploads/<?php echo htmlspecialchars($page['dept_picture']); ?>) ; height:400px;">
                <div class="kingster-header-transparent-substitute"></div>
                <div class="kingster-page-title-overlay"></div>
                <div class="kingster-page-title-bottom-gradient"></div>
                <div class="kingster-page-title-container kingster-container">
                    <div class="kingster-page-title-content kingster-item-pdlr" style="padding-top: 200px ;padding-bottom: 60px ;">
                        <h1 class="kingster-page-title" style="font-size: 48px ;font-weight: 700 ;text-transform: none ;letter-spacing: 0px ;color: #ffffff ;"><?php echo htmlspecialchars($page['pg_title']); ?></h1></div>
                </div>
            </div>
            <div class="kingster-breadcrumbs">
                <div class="kingster-breadcrumbs-container kingster-container">
                    <div class="kingster-breadcrumbs-item kingster-item-pdlr"> <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to Kingster." href="index.html" class="home"><span property="name">Home</span></a>
                        <meta property="position" content="1">
                        </span>&gt;<span property="itemListElement" typeof="ListItem"><span property="name">School</span>
                        <meta property="position" content="2">
                        </span>
                    </div>
                </div>
            </div>
            

            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
                <div class="gdlr-core-page-builder-body">
                    <div class="gdlr-core-pbf-sidebar-wrapper " style="margin: 0px 0px 20px 0px;">
                        <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                            <div class="gdlr-core-pbf-sidebar-content  gdlr-core-column-45 gdlr-core-pbf-sidebar-padding gdlr-core-line-height gdlr-core-column-extend-left" style="padding: 0px 0px 30px 0px;">
                                <div class="gdlr-core-pbf-sidebar-content-inner">
                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr">
                                            <div class="gdlr-core-title-item-title-wrap clearfix">
                                                <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 29px ;font-weight: 600 ;letter-spacing: 0px ;text-transform: none ;"><?php echo htmlspecialchars($page['pg_title']); ?></h3></div>
                                        </div>
                                    </div>
                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align">
                                            <div class="gdlr-core-text-box-item-content" style="font-size: 16px ;text-transform: none ;">
                                                <p>We continues to adapt to new ways of teaching, new disciplines of study and new ways of learning. Your gift enriches the experience of all students by supporting efforts to recruit top faculty, expand academic programs and respond to the emerging needs of our campus and our world.</p>
                                                <p>Not only does Kingster University provide you the practical skills that is necessary to transition seamlessly into the workforce upon your graduation, but we also make sure that you will have a good sense of social justice so that you make the transition responsibly.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-image-item gdlr-core-item-pdlr gdlr-core-item-pdb  gdlr-core-center-align" style="padding-bottom: 75px ;">
                                            <div class="gdlr-core-image-item-wrap gdlr-core-media-image  gdlr-core-image-item-style-round" style="border-radius: 2px;-moz-border-radius: 2px;-webkit-border-radius: 2px;border-width: 6px; border-color:crimson"><img src="upload/unimed_gate.jpg" width="1000" height="296"  alt="" /></div>
                                        </div>
                                    </div>
                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr" style="padding-bottom: 40px ;">
                                            <div class="gdlr-core-title-item-title-wrap clearfix">
                                                <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 22px ;font-weight: 600 ;letter-spacing: 0px ;text-transform: none ;margin-right: 30px ;">Departments</h3>
                                                <div class="gdlr-core-title-item-divider gdlr-core-right gdlr-core-skin-divider" style="font-size: 22px ;border-bottom-width: 3px ;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
require 'db_connect.php'; // Include database connection

// Get school ID from the URL
$pg_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($pg_id > 0) {
    // Fetch pg_title from pages_table where pg_id = provided id
    $query = "SELECT pg_title FROM pages_table WHERE pg_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $pg_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pg_title = $row['pg_title'];

        // Now, fetch departments from dept_table where dept_school = pg_title
        $dept_query = "SELECT dept_id, dept_name FROM dept_table WHERE dept_school = ?";
        $dept_stmt = $conn->prepare($dept_query);
        $dept_stmt->bind_param("s", $pg_title);
        $dept_stmt->execute();
        $dept_result = $dept_stmt->get_result();

        if ($dept_result->num_rows > 0) {
            while ($dept_row = $dept_result->fetch_assoc()) {
                $dept_id = intval($dept_row['dept_id']); // Ensure it's an integer
                $dept_name = htmlspecialchars($dept_row['dept_name']); // Prevent XSS
                ?>
                <div class="gdlr-core-pbf-column gdlr-core-column-20">
                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="margin: 0px 0px 0px -7px;padding: 0px 0px 50px 0px;">
                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                            <div class="gdlr-core-pbf-element">
                                <div class="gdlr-core-feature-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-center-align">
                                    <div class="gdlr-core-feature-box gdlr-core-js gdlr-core-feature-box-type-outer" style="background-color: #192f59 ;border-width: 0px 0px 0px 0px;border-radius: 3px;-moz-border-radius: 3px;-webkit-border-radius: 3px;">
                                        <div class="gdlr-core-feature-box-background" style="background-image: url(upload/support-image-6.jpg) ;opacity: 0.14 ;"></div>
                                        <div class="gdlr-core-feature-box-content gdlr-core-sync-height-content">
                                            <h3 class="gdlr-core-feature-box-item-title" style="font-size: 16px ;font-weight: 600 ;">
                                                <a href="dept.php?dept_name=<?php echo $dept_name; ?>" style="color: white; text-decoration: none;">
                                                    <?php echo $dept_name; ?>
                                                </a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No departments found for this school.</p>";
        }
        $dept_stmt->close();
    } else {
        echo "<p>Invalid School ID.</p>";
    }
    $stmt->close();
} else {
    echo "<p>Invalid School ID.</p>";
}

$conn->close();
?>


                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr" style="padding-bottom: 40px ;">
                                            <div class="gdlr-core-title-item-title-wrap clearfix">
                                                <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 22px ;font-weight: 600 ;letter-spacing: 0px ;text-transform: none ;margin-right: 10px ;">Odosida Campus</h3>
                                                <div class="gdlr-core-title-item-divider gdlr-core-right gdlr-core-skin-divider" style="font-size: 22px ;border-bottom-width: 3px ;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="gdlr-core-video-widget-2" class="widget widget_gdlr-core-video-widget kingster-widget">
                                        <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-accordion-item gdlr-core-item-pdlr gdlr-core-item-pdb  gdlr-core-accordion-style-background-title-icon gdlr-core-left-align gdlr-core-icon-pos-right">
                                                    <div class="gdlr-core-accordion-item-tab clearfix  gdlr-core-active">
                                                        <div class="gdlr-core-accordion-item-icon gdlr-core-js gdlr-core-skin-icon "></div>
                                                        <div class="gdlr-core-accordion-item-content-wrapper">
                                                            <h4 class="gdlr-core-accordion-item-title gdlr-core-js  gdlr-core-skin-e-background gdlr-core-skin-e-content">Staff Directory</h4>
                                                            <div class="gdlr-core-accordion-item-content">
                                                                <p>Provided by the KU Institute of Education, this programme is available by distance learning, allowing you to study flexibly while balancing work and personal lifes.</p>
                                                                <p>The MSc Finance (EG. Banking) deepens your understanding of banks and financial markets, and how they relate to performance. It will help you to advance your career in finance and policy.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="gdlr-core-accordion-item-tab clearfix  ">
                                                        <div class="gdlr-core-accordion-item-icon gdlr-core-js gdlr-core-skin-icon "></div>
                                                        <div class="gdlr-core-accordion-item-content-wrapper">
                                                            <h4 class="gdlr-core-accordion-item-title gdlr-core-js  gdlr-core-skin-e-background gdlr-core-skin-e-content">Objectives</h4>
                                                            <div class="gdlr-core-accordion-item-content">
                                                                <p>Provided by the KU Institute of Education, this programme is available by distance learning, allowing you to study flexibly while balancing work and personal lifes.</p>
                                                                <p>The MSc Finance (EG. Banking) deepens your understanding of banks and financial markets, and how they relate to performance. It will help you to advance your career in finance and policy.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </br>
                                                    </br>
                                                    </br>
                                                  
                                                   
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="gdlr-core-pbf-sidebar-right gdlr-core-column-extend-right  kingster-sidebar-area gdlr-core-column-15 gdlr-core-pbf-sidebar-padding  gdlr-core-line-height" style="padding: 30px 0px 30px 0px;">
                                <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                                    <div id="text-15" class="widget widget_text kingster-widget">
                                        <h3 class="kingster-widget-title">Office of the Dean</h3><span class="clear"></span>
                                        <div class="gdlr-core-video-widget gdlr-core-media-image">
                                            <a class="gdlr-core-lightgallery gdlr-core-js " style="border-width: 10px;"><img src="uploads/<?php echo htmlspecialchars($page['head_picture']); ?>" width="400" height="400"   alt="" /></a>
                                            <h3 style="margin-bottom:2px;font-size: 30px ;font-weight: 600 ;letter-spacing: 0px ;text-transform: none ;color:rgb(3, 34, 33) ; text-align:center;"><?php echo htmlspecialchars($page['pg_head_name']); ?>
                                                   </h3>
                                                        <p style="margin-bottom: 5px;font-size: 18px ;font-weight: 200 ;color:rgb(61, 184, 155) ; text-align:center;"><?php echo htmlspecialchars($page['pg_h_qualification']); ?>
                                                    </p> 
                                                        <p style="font-size: 18px ;font-weight: 200 ;color:rgb(15, 13, 41) ; text-align:center;"><?php echo htmlspecialchars($page['pg_head_title']); ?>
                                                    </p>
                                        </div> <br >
                                        
                                        
                                        </div>

                                       
                                    </div>
                                    <div id="gdlr-core-video-widget-2" class="widget widget_gdlr-core-video-widget kingster-widget">
                                        <h3 class="kingster-widget-title">Video Presentation</h3><span class="clear"></span>
                                        

<div class="video-container">
    <iframe width="560" height="315" 
        src="https://www.youtube.com/embed/_sbHpl_jXd8?autoplay=1" 
        title="YouTube video player" 
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen>
       
    </iframe>
     <marquee behavior="scroll" direction="left" style="font-size: 20px; font-weight: bold; color: blue; margin-bottom: 10px;">
    University of Medical Sciences, Odosida Campus - You are Welcome!
</marquee>
</div>

                                    </div>
                                  
                                </div>
                                        
                            </div>
                        </div>
                    </div>
                    <div class="gdlr-core-pbf-wrapper " style="padding: 65px 0px 60px 0px;">
                        <div class="gdlr-core-pbf-background-wrap" style="background-color: #192f59 ;"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                                <div class="gdlr-core-pbf-column gdlr-core-column-30 gdlr-core-column-first">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="margin: -120px 0px 0px 0px;padding: 0px 55px 0px 0px;">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-image-item gdlr-core-item-pdlr gdlr-core-item-pdb  gdlr-core-center-align">
                                                    <div class="gdlr-core-image-item-wrap gdlr-core-media-image  gdlr-core-image-item-style-rectangle" style="border-width: 6px; border-color:crimson"><img src="upload/odosida_campus.jpg" width="1500" height="1000"  alt="" /></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-column gdlr-core-column-30">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="padding: -10px 30px 0px 0px;">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            <div class="gdlr-core-widget-box-shortcode " style="color: #ffffff ;padding: 10px 25px;background-color: #192f59 ;">
                                                <div class="gdlr-core-widget-box-shortcode-content">
                                                    </p>
                                                    <h3 style="font-size: 20px; color: #fff; margin-bottom: 15px;">School Contact Info</h3>
                                                    <p><span style="color:rgb(255, 255, 255); font-size: 16px; font-weight: 600;">Office of the The  Dean School of </span>
                                                        <br /> <span style="font-size: 15px;"><br /> 1810 Campus Way NE<br /> Bothell, WA 98011-8246</span></p>
                                                    <p><span style="font-size: 15px;">+1-2345-5432-45<br /> bsba@kuuniver.edu<br /> </span></p>
                                                   
                                                </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer>
                
                
			<?php include "footer.php";?>
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