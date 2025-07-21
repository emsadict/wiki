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
                        <h1 class="kingster-page-title">BOARD MEMBERS PAGE</h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-sidebar-wrapper">
            <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                <div class="gdlr-core-pbf-sidebar-content gdlr-core-column-60 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color:rgba(158, 228, 207, 0.33) ;"></div>
                    <div class="gdlr-core-pbf-sidebar-content-inner">
<div class="gdlr-core-pbf-element">
    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">

            <!-- Upcoming Events -->
            <Center><h3>THE BOARD</h3></Center>
            <hr />                                        <?php 
            
$queryStaff = "SELECT * FROM staff WHERE designation = 'Board of Trustee'";
$resultStaff = $conn->query($queryStaff);

if ($resultStaff && $resultStaff->num_rows > 0): 
?>
    <div class="council-container">
        <?php while ($row = $resultStaff->fetch_assoc()): 
            $staffUrl = "staff_profile.php?id=" . $row['id'];
            $passport = !empty($row['passport']) ? "admin/uploads/{$row['passport']}" : "admin/uploads/default.jpg";
        ?>
        <div class="council-member">
            <a href="<?php echo $staffUrl; ?>">
                <img src="<?php echo $passport; ?>" alt="Passport" width="180" height="180" />
            </a>
            <h3>
                <a href="<?php echo $staffUrl; ?>">
                    <?php echo htmlspecialchars($row['title'] . " " . $row['name']); ?>
                </a>
            </h3>
            <p><strong><?php echo htmlspecialchars($row['board']); ?></strong></p>
            <p><?php echo htmlspecialchars($row['designation']); ?></p>
            <a class="details-button" href="<?php echo $staffUrl; ?>">More Detail</a>
        </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p>No Board of Trustee members found.</p>
<?php endif; ?>


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


    
.council-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    padding: 20px;
}

.council-member {
    border: 1px solid #ccc;
    padding: 15px;
    width: 250px;
    background: #f9f9f9;
    text-align: center;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: 0.3s ease;
}
.council-member:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.council-member img {
    border-radius: 30%;
    object-fit: contain;
    width: 150px;
    height: 150px;
    margin-bottom: 10px;
    object-position: top center;
}

.details-button {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 14px;
    background: linear-gradient(#091E3E, #091E3E);
    color: white;
    text-decoration: none;
    border-radius: 6px;
}
.details-button:hover {
    background-color: #073166;
}
.council-member h3 {
    font-size: 18px;  /* You can try 16px or smaller if needed */
    margin: 10px 0;
}

</style>


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