<?php

include 'db_connect.php';

// Pagination setup
$limit = 3; // Number of events per page
$page = isset($_GET['page']) && $_GET['page'] > 0 ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Get current date
$current_date = date('Y-m-d');

// Count total events for pagination
$total_upcoming = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM events WHERE event_date >= '$current_date'"));
$total_past = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM events WHERE event_date < '$current_date'"));

$total_pages_upcoming = max(ceil($total_upcoming / $limit), 1);
$total_pages_past = max(ceil($total_past / $limit), 1);

// Redirect to first page if the current page is out of range
if ($page > $total_pages_upcoming && $page > $total_pages_past) {
    header("Location: all_events.php?page=1");
    exit();
}

// Fetch upcoming events
$upcoming_query = "SELECT * FROM events WHERE event_date >= '$current_date' ORDER BY event_date ASC LIMIT $limit OFFSET $offset";
$upcoming_result = mysqli_query($conn, $upcoming_query);

// Fetch past events
$past_query = "SELECT * FROM events WHERE event_date < '$current_date' ORDER BY event_date DESC LIMIT $limit OFFSET $offset";
$past_result = mysqli_query($conn, $past_query);
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
                        <h1 class="kingster-page-title">EVENTS PAGE</h1></div>
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
            <Center><h3>Upcoming Events</h3></Center>
            <hr />
            <?php if (mysqli_num_rows($upcoming_result) > 0): ?>
                <?php while ($event = mysqli_fetch_assoc($upcoming_result)): ?>
                    <div class="event-box">
                        <h3><?php echo ucfirst($event['title']); ?></h3>
                        <p><?php echo $event['description']; ?></p>
                        <p><strong>Date:</strong> <?php echo $event['event_date']; ?></p>
                        <p><strong>Time:</strong> <?php echo $event['event_time']; ?></p>
                        <p><strong>Venue:</strong> <?php echo $event['event_venue']; ?></p>
                        <img src="uploads/<?php echo $event['event_thumbnail']; ?>" width="150">
                        <br>
                        <div class="pagination">
                        <a href="mainevent.php?id=<?php echo $event['id']; ?>" class="btn btn-primary">View Event</a>
                        </div>
                    </div>
                <?php endwhile; ?>
                
                <!-- Pagination for Upcoming Events -->
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="events.php?page=<?php echo $page - 1; ?>" class="btn btn-success">Previous</a>
                    <?php endif; ?>
                    
                    <?php if ($page < $total_pages_upcoming): ?>
                        <a href="events.php?page=<?php echo $page + 1; ?>" class="btn btn-success">Next</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p>No upcoming events found.</p>
            <?php endif; ?>

            <hr>

            <!-- Past Events -->
            <h2>Past Events</h2>
            <hr />
            <?php if (mysqli_num_rows($past_result) > 0): ?>
                <?php while ($event = mysqli_fetch_assoc($past_result)): ?>
                    <div class="event-box">
                        <h3><?php echo $event['title']; ?></h3>
                        <p><?php echo $event['description']; ?></p>
                        <p><strong>Date:</strong> <?php echo $event['event_date']; ?></p>
                        <p><strong>Time:</strong> <?php echo $event['event_time']; ?></p>
                        <p><strong>Venue:</strong> <?php echo $event['event_venue']; ?></p>
                        <img src="uploads/<?php echo $event['event_thumbnail']; ?>" width="150">
                        <br>
                        <a href="mainevent.php?id=<?php echo $event['id']; ?>" class="btn btn-primary">View Event</a>
                    </div>
                <?php endwhile; ?>

                <!-- Pagination for Past Events -->
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="events.php?page=<?php echo $page - 1; ?>" class="btn btn-primary">Previous</a>
                    <?php endif; ?>
                    
                    <?php if ($page < $total_pages_past): ?>
                        <a href="events.php?page=<?php echo $page + 1; ?>" class="btn btn-light">Next</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p>No past events found.</p>
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
                
                <!-- Sidebar with Recent Posts -->
                <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left kingster-sidebar-area gdlr-core-column-15 gdlr-core-pbf-sidebar-padding gdlr-core-line-height">
                    <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                        <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgb(206, 234, 221) ;">
                            <h3 class="kingster-widget-title">EVENTS</h3><span class="clear"></span>
                            <ul>
                                <?php
                                $recentPosts = $conn->query("SELECT id, title FROM events ORDER BY event_date DESC LIMIT 10");
                                while ($post = $recentPosts->fetch_assoc()):
                                ?>
                                    <li><a href="mainevent.php?id=<?= $post['id']; ?>"><?= $post['title']; ?></a></li>
                                <?php endwhile; ?>
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
            "home_url": "index.html"
        };
    </script>
    <script type='text/javascript' src='js/plugins.min.js'></script>
</body>
</html>