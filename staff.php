<?php 
include 'db_connect.php';


// Fetch staff members with designation 'Staff'
                                                            
                                                             
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
                        <h1 class="kingster-page-title">STAFF MEMBERS PAGE</h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-sidebar-wrapper">
            <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                <div class="gdlr-core-pbf-sidebar-content gdlr-core-column-45 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color:rgba(158, 228, 207, 0.33) ;"></div>
                    <div class="gdlr-core-pbf-sidebar-content-inner">
<div class="gdlr-core-pbf-element">
    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">

            <!-- Upcoming Events -->
            <Center><h3>THE BOARD</h3></Center>
            <hr />                                        <?php 
                                                            $queryStaff = "SELECT * FROM staff WHERE designation = 'Staff'";
                                                             $resultStaff = $conn->query($queryStaff);

            // Generate menu items dynamically
                                                             while ($row = $resultStaff->fetch_assoc()) {
                                                                 $stafftitle = htmlspecialchars($row['board']);
                                                                  $stafftitle2 = htmlspecialchars($row['title']);
                                                                 $staffName = htmlspecialchars($row['name']);
                                                                 $staffdesign = htmlspecialchars($row['profile']);
                                                                 $staffdesign2 = htmlspecialchars($row['designation']);
                                                                 $staffpassprot = htmlspecialchars($row['passport']);
                                                                 $staffUrl = "staff_profile.php?id=" . $row['id']; // Link to profile page
                                                                 
                                                                 //echo '<li class="menu-item"><a href="' . $staffUrl . '">' . $staffName . '</a></li>';
                                                             }
            
                                                               ?>
                                                <div class="gdlr-core-tab-item-content " data-tab-id="4" >
                                                    
                                                    <div class="gdlr-core-personnel-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-personnel-item-style-medium gdlr-core-personnel-style-medium" style="height: 600px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
                                                    

                                                     <div class="gdlr-core-personnel-list-column gdlr-core-column-60 gdlr-core-column-first gdlr-core-item-pdlr">
                                                                       <div class="gdlr-core-personnel-list clearfix">
                                                                           <div class="gdlr-core-personnel-list-image gdlr-core-media-image gdlr-core-opacity-on-hover gdlr-core-zoom-on-hover">
                                                                               <a href="#"><img src="./admin/uploads/<?php echo $staffpassprot; ?>" alt="" width="500" height="500" title="personnel-1" /></a>
                                                                           </div>
                                                                           <div class="gdlr-core-personnel-list-content-wrap">
                                                                               <h3 class="gdlr-core-personnel-list-title" style="font-size: 23px; font-weight: 700;">

                                                                                   <a href="#"><?php  echo '<li class="menu-item" style="list-style-type: none;><a href="' . $staffUrl . '">'. $stafftitle2 .' '. $staffName . '</a></li>';  ?></a>

                                                                                   <a href="#"></a>

                                                                               </h3>
                                                                               <div class="gdlr-core-personnel-list-position gdlr-core-info-font gdlr-core-skin-caption" style="font-size: 16px;"><?php  echo '<li class="menu-item" style="list-style-type: none;><a href="' . $staffUrl . '">' . $staffdesign . '</a></li>';  ?></div>
                                                                               <div class="gdlr-core-personnel-list-position gdlr-core-info-font gdlr-core-skin-caption" style="font-size: 16px;"><?php  echo '<li class="menu-item" style="list-style-type: none;><a href="' . $staffUrl . '">' . $staffdesign2. '</a></li>';  ?></div>
                                                                               <div class="gdlr-core-personnel-info">
                                                                                <!--
                                                                                   <div class="kingster-personnel-info-list kingster-type-email">
                                                                                       <i class="kingster-personnel-info-list-icon fa fa-envelope-open"></i>
                                                                                   </div>
                                                            -->
                                                                               </div>

                                                                               <a class="gdlr-core-personnel-list-button gdlr-core-button"  href="" style="background: linear-gradient(#091E3E, #091E3E);">More Detail</a>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                    </div>
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
                            <h3 class="kingster-widget-title">Menu</h3><span class="clear"></span>
                            <ul>
                                



                            </ul>
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
            "home_url": "index.php"
        };
    </script>
    <script type='text/javascript' src='js/plugins.min.js'></script>
</body>
</html>