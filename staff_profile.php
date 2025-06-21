<?php 
include 'db_connect.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid staff ID.");
}

$id = (int) $_GET['id'];

// Fetch staff details
$query = mysqli_query($conn, "SELECT * FROM staff WHERE id = $id");
if (!$query || mysqli_num_rows($query) === 0) {
    die("Staff member not found.");
}

$staff = mysqli_fetch_assoc($query);
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
                        <h1 class="kingster-page-title">PROFILE PAGE</h1></div>
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
            <Center><h3>PROFILE</h3></Center>
            <title><?php echo htmlspecialchars($staff['name']); ?> - Profile</title>
            <hr />
            
                <div class="profile-container">
    <img class="profile-img" src="./admin/uploads/<?php echo htmlspecialchars($staff['passport']); ?>" alt="Passport">

    <div class="profile-details">
        <h2><?php echo htmlspecialchars($staff['title'] . ' ' . $staff['name']); ?></h2>
        <p><span class="label">Designation:</span> <?php echo htmlspecialchars($staff['designation']); ?></p>
        <?php if (!empty($staff['office'])): ?>
            <p><span class="label">Office:</span> <?php echo htmlspecialchars($staff['office']); ?></p>
        <?php endif; ?>
        <?php if (!empty($staff['exco'])): ?>
            <p><span class="label">Executive Role:</span> <?php echo htmlspecialchars($staff['exco']); ?></p>
        <?php endif; ?>
        <?php if (!empty($staff['board'])): ?>
            <p><span class="label">Board Role:</span> <?php echo htmlspecialchars($staff['board']); ?></p>
        <?php endif; ?>
        <?php if (!empty($staff['profile'])): ?>
            <p><span class="label">Profile:</span><br><?php echo nl2br(htmlspecialchars($staff['profile'])); ?></p>
        <?php endif; ?>
    </div>
<p><span class="label">Designation:</span> <?php echo htmlspecialchars($staff['designation']); ?></p>

<?php
$designation = strtolower(trim($staff['designation']));

switch ($designation) {
    case 'staff':
        if (!empty($staff['office'])) {
            echo '<p><span class="label">Office:</span> ' . htmlspecialchars($staff['office']) . '</p>';
        }
        break;

    case 'campus director':
        if (!empty($staff['campus'])) {
            echo '<p><span class="label">Campus:</span> ' . htmlspecialchars($staff['campus']) . '</p>';
        }
        break;

    case 'executive committee':
        if (!empty($staff['exco'])) {
            echo '<p><span class="label">Executive Committee Role:</span> ' . htmlspecialchars($staff['exco']) . '</p>';
        }
        break;

    case 'board of trustee':
        if (!empty($staff['board'])) {
            echo '<p><span class="label">Board Role:</span> ' . htmlspecialchars($staff['board']) . '</p>';
        }
        break;

    default:
        echo '<p><em>No specific role detail available for this designation.</em></p>';
}
?>

    <a class="back-link" href="javascript:history.back()">← Back</a>
</div>
                
                
          

        </div>
    </div>
</div>

<style>
    
    
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            margin: 40px;
            color: #333;
        }
        .profile-container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        .passport {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #ccc;
        }
        .info {
            margin-top: 20px;
        }
        .info h2 {
            margin: 10px 0 5px;
        }
        .info p {
            margin: 4px 0;
            font-size: 16px;
        }
        .back-link {
            margin-top: 30px;
            display: inline-block;
            background-color: #2c3e50;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
        }
        .back-link:hover {
            background-color: #1a252f;
        }
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