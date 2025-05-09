<?php
include 'db_connect.php'; // Include database connection

// Define pagination variables
$limit = 5; // Number of researches per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure the page number is at least 1
$offset = ($page - 1) * $limit;

// Fetch total number of research activities
$totalQuery = "SELECT COUNT(*) AS total FROM research_activities";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalResearches = $totalRow['total'];
$totalPages = ceil($totalResearches / $limit);

// Fetch research activities with pagination
$query = "SELECT id, title, abstract, principal_investigator, image, date FROM research_activities 
          ORDER BY date DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($query);
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
                        <h1 class="kingster-page-title">RESEARCH ACTIVITIES PAGE</h1></div>
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
            <h3>Research Activities in AFUED</h3>
            <hr />
            <div class="container">
       

        <?php if ($result->num_rows > 0): ?>
            <div class="research-list">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="event-box">
                    <div class="research-item">
                        <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Research Image" width="150">
                        <div class="research-details">
                            <h3><?php echo ucfirst(htmlspecialchars($row['title'])); ?></h3>
                            <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($row['date'])); ?></p>
                            <p><strong>Principal Investigator:</strong> <?php echo htmlspecialchars($row['principal_investigator']); ?></p>
                            <p><?php echo nl2br(htmlspecialchars(substr($row['abstract'], 0, 150))) . '...'; ?></p>
                            <a href="view_research.php?id=<?php echo $row['id']; ?>" class="view-btn">View Details</a>
                        </div>
                    </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Pagination Controls -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="researchs.php?page=<?php echo $page - 1; ?>" class="pagination-btn">Previous</a>
                <?php endif; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="researchs.php?page=<?php echo $page + 1; ?>" class="pagination-btn">Next</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>No research activities found.</p>
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
</style>


                
              

            </div>
            
        </div>
    </div>
      <!-- Sidebar with Recent Posts -->
      <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left kingster-sidebar-area gdlr-core-column-15 gdlr-core-pbf-sidebar-padding gdlr-core-line-height">
                    <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                        <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgb(206, 234, 221) ;">
                            <h3 class="kingster-widget-title">Research Activities</h3><span class="clear"></span>
                            <ul>
                                <?php
                                $recentPosts = $conn->query("SELECT id, title FROM  research_activities  ORDER BY date DESC LIMIT 10");
                                while ($post = $recentPosts->fetch_assoc()):
                                ?>
                                    <li><a href="view_research.php?id=<?= $post['id']; ?>"><?= $post['title']; ?></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                </div>
</div>


<?php mysqli_close($conn); ?>


           
                <?php  include "footer.php";?>
          
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