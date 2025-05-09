<?php include "mobilemenu.php"; ?>
    <div class="kingster-body-outer-wrapper ">
        <div class="kingster-body-wrapper clearfix  kingster-with-frame">
           <?php include "headermenu.php" ?>
           <?php   include "menu.php";?>

           <?php
// Connect to the database
include('db_connect.php'); // Ensure this file contains database connection details

// Fetch the latest news article
$news_id = isset($_GET['id']) ? intval($_GET['id']) : 1; // Get article ID from URL
$sql = "SELECT title, author,  date, content, image FROM news WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $news_id);
$stmt->execute();
$result = $stmt->get_result();
$news = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
   <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JavaScript (for interactive components like modals, dropdowns, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
   .news-image img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    margin-top: 20px;
}
.scrollable-content {
        max-height: 600px; /* Adjust as needed */
        overflow-y: auto; /* Enables vertical scroll */
        padding: 10px;
        border: 1px solid #ddd;
        background:rgb(206, 234, 221);
    }

    /* Custom Scrollbar Styling */
    .scrollable-content::-webkit-scrollbar {
        width: 8px;
    }
    .scrollable-content::-webkit-scrollbar-track {
        background:rgb(24, 140, 107);
    }
    .scrollable-content::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }
    .scrollable-content::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

</head>

<body class="home page-template-default page page-id-2039 gdlr-core-body woocommerce-no-js tribe-no-js kingster-body kingster-body-front kingster-full  kingster-with-sticky-navigation  kingster-blockquote-style-1 gdlr-core-link-to-lightbox">



<div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="kingster-blog-title-wrap kingster-style-custom kingster-feature-image" 
         style="background-image: url(upload/<?php echo htmlspecialchars($news['image']); ?>); height:400px">
        <div class="kingster-header-transparent-substitute"></div>
        <div class="kingster-blog-title-overlay" style="opacity: 0.01;"></div>
        <div class="kingster-blog-title-bottom-overlay"></div>
        <div class="kingster-blog-title-container kingster-container">
            <div class="kingster-blog-title-content kingster-item-pdlr" 
                 style="padding-top: 200px; padding-bottom: 80px;">
                <header class="kingster-single-article-head clearfix">
                    <div class="kingster-single-article-date-wrapper post-date updated">
                        <div class="kingster-single-article-date-day"><?php echo date('d', strtotime($news['date'])); ?></div>
                        <div class="kingster-single-article-date-month"><?php echo date('M', strtotime($news['date'])); ?></div>
                    </div>
                    <div class="kingster-single-article-head-right">
                        <h1 class="kingster-single-article-title"><?php echo htmlspecialchars($news['title']); ?></h1>
                        <div class="kingster-blog-info-wrapper">
                            <div class="kingster-blog-info kingster-blog-info-font kingster-blog-info-author">
                                <span class="kingster-head">By</span>
                                <span class="fn"><a href="#" rel="author"><?php echo htmlspecialchars($news['author']); ?></a></span>
                            </div>
                            <div class="kingster-blog-info kingster-blog-info-font kingster-blog-info-category">
                                <a href="#" rel="tag"><?php //echo htmlspecialchars($news['category']); ?></a>
                            </div>
                            <div class="kingster-blog-info kingster-blog-info-font kingster-blog-info-tag">
                                <a href="#" rel="tag"><?php //echo htmlspecialchars($news['tags']); ?></a>
                            </div>
                            <!-- Display the image below the content -->
                        </div>
                    </div>
                </header>
            </div>
        </div>
    </div>
       <!-- Sidebar with Recent Posts -->
       <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left kingster-sidebar-area gdlr-core-column-15 gdlr-core-pbf-sidebar-padding gdlr-core-line-height">
                    <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                        <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgb(206, 234, 221) ;">
                            <h3 class="kingster-widget-title">Recent Posts</h3><span class="clear"></span>
                            <ul>
                                <?php
                                $recentPosts = $conn->query("SELECT id, title FROM news ORDER BY date DESC LIMIT 5");
                                while ($post = $recentPosts->fetch_assoc()):
                                ?>
                                    <li><a href="view_news.php?id=<?= $post['id']; ?>"><?= $post['title']; ?></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                </div>
<!-- Sidebar with contant Posts -->
    <div class="kingster-content-container kingster-container">
        <div class="kingster-sidebar-wrap clearfix kingster-line-height-0 kingster-sidebar-style-none">
            <div class="kingster-sidebar-center kingster-column-45 kingster-line-height">
                <div class="kingster-content-wrap kingster-item-pdlr clearfix">
                    <div class="kingster-content-area">
                        <article class="post">
                        <h5 class="kingster-single-article-title"><?php echo htmlspecialchars($news['title']); ?></h5>

                            <div class="kingster-single-article-content scrollable-content">
                                <?php echo nl2br($news['content']); ?>
                            </div>
                        </article>

                        <br >
                        <?php if (!empty($news['image'])) { ?>
                             <div class="news-image text-center" style="align-items: center;">
                             <img src="uploads/<?php echo htmlspecialchars($news['image']); ?>" alt="" class="img-fluid" width="705" height="70%">
                           </div>
                        <?php } ?>
 
                            <br />
                            <!-- Back Button -->
                            <div class="text-center mt-3">
                                <a href="javascript:history.back()" class="btn btn-success" style="color: #ddd;">Back</a>
                            </div>
                    </div>

                </div>
                
            </div>
        </div>

    </div>

   
</div>


            <?php  include "footer.php"; ?>
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