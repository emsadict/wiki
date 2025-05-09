<?php  
include "db_connect.php";
$sql = "SELECT id, title, content, image, author, date FROM news ORDER BY date DESC";
$result = $conn->query($sql);


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
           <?php include "headermenu.php"; ?>
           <?php include "menu.php"; ?>

            <div class="kingster-page-title-wrap  kingster-style-medium kingster-center-align">
                <div class="kingster-header-transparent-substitute"></div>
                <div class="kingster-page-title-overlay"></div>
                <div class="kingster-page-title-container kingster-container">
                    <div class="kingster-page-title-content kingster-item-pdlr">
                        <h1 class="kingster-page-title">NEWS  PAGE</h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-sidebar-wrapper">
            <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                <div class="gdlr-core-pbf-sidebar-content gdlr-core-column-45 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color:rgba(158, 228, 207, 0.53) ;"></div>
                    <div class="gdlr-core-pbf-sidebar-content-inner">
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
                                <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                                    
                                    <?php while($row = $result->fetch_assoc()): ?>
                                    <div class="gdlr-core-item-list gdlr-core-blog-full gdlr-core-item-mglr gdlr-core-style-left">
                                        <div class="gdlr-core-blog-thumbnail gdlr-core-media-image gdlr-core-opacity-on-hover gdlr-core-zoom-on-hover">
                                            <a href="post.php?id=<?= $row['id']; ?>">
                                                <img src="upload/<?= $row['image']; ?>" width="1280" height="919" alt="<?= $row['title']; ?>" />
                                            </a>
                                        </div>
                                        <div class="gdlr-core-blog-full-frame gdlr-core-skin-e-background">
                                            <div class="gdlr-core-blog-full-head clearfix">
                                                <div class="gdlr-core-blog-full-head-right">
                                                    <h3 class="gdlr-core-blog-title gdlr-core-skin-title" style="font-size: 27px; font-weight: 700;">
                                                        <a href="post.php?id=<?= $row['id']; ?>"><?= $row['title']; ?></a>
                                                    </h3>
                                                    <div class="gdlr-core-blog-info-wrapper gdlr-core-skin-divider">
                                                        <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-date">
                                                            <a href="#"><?= date("F j, Y", strtotime($row['date'])); ?></a>
                                                        </span>
                                                        <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-author">
                                                            <span class="gdlr-core-head">By</span> 
                                                            <a href="#"><?= $row['author']; ?></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-blog-content">
                                                <?= substr(strip_tags($row['content']), 0, 150); ?>...
                                                <div class="clear"></div>
                                                <a class="gdlr-core-excerpt-read-more gdlr-core-button gdlr-core-rectangle" href="view_news.php?id=<?= $row['id']; ?>">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endwhile; ?>

                                </div>
                            </div>
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

            </div>
        </div>
    </div>
</div>

<?php $conn->close(); ?>


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