<header class="kingster-header-wrap kingster-header-style-plain  kingster-style-menu-right kingster-sticky-navigation kingster-style-fixed" data-navigation-offset="75px">
                <div class="kingster-header-background"></div>
                <div class="kingster-header-container  kingster-container">
                    <div class="kingster-header-container-inner clearfix">
                        <div class="kingster-logo  kingster-item-pdlr">
                            <div class="kingster-logo-inner">
                                <a class="" href="index.php"><img src="images/logo.png" alt="" /></a>
                            </div>
                        </div>
                        <div class="kingster-navigation kingster-item-pdlr clearfix ">
                            <div class="kingster-main-menu" id="kingster-main-menu">
                                <ul id="menu-main-navigation-1" class="sf-menu">
                                    <li class="menu-item menu-item-home menu-item-has-children kingster-normal-menu"><a href="index.php" class="sf-with-ul-pre">Home</a>
                                        
                                    </li>
                              
                                    <li class="menu-item current-menu-item menu-item-has-children kingster-mega-menu" ><a href="organogram.php" class="sf-with-ul-pre">Who we are</a>
                                        <div class="sf-mega sf-mega-full ">
                                            <ul class="sub-menu">
                                                <li class="menu-item menu-item-has-children" data-size="15"><a  href="board.php" class="sf-with-ul-pre">Board of Trustees</a>
                                                    <ul class="sub-menu">
                                                         <?php
                                                             // Fetch staff members with designation 'Staff'
                                                             $queryStaff = "SELECT id, office, board FROM staff WHERE designation = 'Board of Trustee'";
                                                             $resultStaff = $conn->query($queryStaff);

                                                             // Generate menu items dynamically
                                                             while ($row = $resultStaff->fetch_assoc()) {
                                                                 $staffName = htmlspecialchars($row['board']);
                                                                 $staffUrl = "staff_profile.php?id=" . $row['id']; // Link to profile page

                                                                 echo '<li class="menu-item"><a href="' . $staffUrl . '">' . $staffName . '</a></li>';
                                                             }
                                                             ?>
                                                    </ul>
                                                </li>
                                                <li class="menu-item menu-item-has-children" data-size="15"><a href="excos.php" class="sf-with-ul-pre">Executive Members</a>
                                                    <ul class="sub-menu">
                                                    <?php
                                                             // Fetch staff members with designation 'Staff'
                                                             $queryStaff = "SELECT id, office, exco FROM staff WHERE designation = 'Executive Committee'";
                                                             $resultStaff = $conn->query($queryStaff);

                                                             // Generate menu items dynamically
                                                             while ($row = $resultStaff->fetch_assoc()) {
                                                                 $staffName = htmlspecialchars($row['exco']);
                                                                 $staffUrl = "staff_profile.php?id=" . $row['id']; // Link to profile page

                                                                 echo '<li class="menu-item"><a href="' . $staffUrl . '">' . $staffName . '</a></li>';
                                                             }
                                                             ?>
                                                    </ul>
                                                </li>
                                               
                                                
                                                <li class="menu-item menu-item-has-children" data-size="15"><a href="staff.php" class="sf-with-ul-pre">Staff</a>
                                                <ul class="sub-menu">
                                                                    <?php
                                                                      // Fetch staff members with designation 'Staff'
                                                                      $queryStaff = "SELECT id, office FROM staff WHERE designation = 'Staff'";
                                                                      $resultStaff = $conn->query($queryStaff);

                                                                      // Generate menu items dynamically
                                                                      while ($row = $resultStaff->fetch_assoc()) {
                                                                          $staffName = htmlspecialchars($row['office']);
                                                                          $staffUrl = "staff_profile.php?id=" . $row['id']; // Link to profile page

                                                                          echo '<li class="menu-item"><a href="' . $staffUrl . '">' . $staffName . '</a></li>';
                                                                         }                                                                      
                                                                      ?>
                                                        
                                                    </ul>
                                                </li> 
                                                <li class="menu-item menu-item-has-children" data-size="15"><a href="communitylead.php" class="sf-with-ul-pre">Comunity Leaders & Club leaders</a>
                                                    <ul class="sub-menu">
                                                    
                                                    </ul>
                                                </li> 
                                            </ul>
                                        </div>
                                    </li>
                                    
                                     <li class="menu-item menu-item-has-children kingster-normal-menu"><a href="#" class="sf-with-ul-pre">Events/Programmes</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item" data-size="60"><a href="about-us.html">About KU</a></li>
                                            <li class="menu-item menu-item-has-children" data-size="60"><a href="blog-full-right-sidebar-with-frame.html" class="sf-with-ul-pre">Blog</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item menu-item-has-children"><a href="blog-full-right-sidebar-with-frame.html" class="sf-with-ul-pre">Blog Full</a>
                                                        <ul class="sub-menu">
                                                            <li class="menu-item"><a href="blog-full-right-sidebar-with-frame.html">Blog Full Right Sidebar With Frame</a></li>
                                                            <li class="menu-item"><a href="blog-full-left-sidebar-with-frame.html">Blog Full Left Sidebar With Frame</a></li>
                                                            <li class="menu-item"><a href="blog-full-both-sidebar-with-frame.html">Blog Full Both Sidebar With Frame</a></li>
                                                            <li class="menu-item"><a href="blog-full-right-sidebar.html">Blog Full Right Sidebar</a></li>
                                                            <li class="menu-item"><a href="blog-full-left-sidebar.html">Blog Full Left Sidebar</a></li>
                                                            <li class="menu-item"><a href="blog-full-both-sidebar.html">Blog Full Both Sidebar</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item menu-item-has-children"><a href="blog-grid-3-columns-no-space.html" class="sf-with-ul-pre">Blog Grid</a>
                                                        <ul class="sub-menu">
                                                            <li class="menu-item"><a href="blog-grid-2-columns.html">Blog Grid 2 Columns</a></li>
                                                            <li class="menu-item"><a href="blog-grid-3-columns.html">Blog Grid 3 Columns</a></li>
                                                            <li class="menu-item"><a href="blog-grid-4-columns.html">Blog Grid 4 Columns</a></li>
                                                            <li class="menu-item"><a href="blog-grid-2-columns-no-space.html">Blog Grid 2 Columns No Space</a></li>
                                                            <li class="menu-item"><a href="blog-grid-3-columns-no-space.html">Blog Grid 3 Columns No Space</a></li>
                                                            <li class="menu-item"><a href="blog-grid-4-columns-no-space.html">Blog Grid 4 Columns No Space</a></li>
                                                        </ul>
                                                    </li>

                                                    <li class="menu-item"><a href="standard-post-type.html">Single Post</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children" data-size="60"><a href="#" class="sf-with-ul-pre">Contact</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="contact.html">Contact</a></li>
                                                    <li class="menu-item"><a href="contact-2.html">Contact 2</a></li>
                                                    <li class="menu-item"><a href="contact-3.html">Contact 3</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children" data-size="60"><a href="portfolio-3-columns.html" class="sf-with-ul-pre">Portfolio</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item menu-item-has-children"><a class="sf-with-ul-pre">Portfolio Grid</a>
                                                        <ul class="sub-menu">
                                                            <li class="menu-item"><a href="portfolio-2-columns.html">Portfolio 2 Columns</a></li>
                                                            <li class="menu-item"><a href="portfolio-3-columns.html">Portfolio 3 Columns</a></li>
                                                            <li class="menu-item"><a href="portfolio-4-columns.html">Portfolio 4 Columns</a></li>
                                                            
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item menu-item-has-children"><a class="sf-with-ul-pre">Portfolio Masonry</a>
                                                        <ul class="sub-menu">
                                                            <li class="menu-item"><a href="portfolio-masonry-4-columns.html">Masonry 4 Columns</a></li>
                                                            <li class="menu-item"><a href="portfolio-masonry-3-columns.html">Masonry 3 Columns</a></li>
                                                            
                                                        </ul>
                                                    </li>

                                                 <li class="menu-item menu-item-has-children"><a class="sf-with-ul-pre" href="singleportfolio.html">Single Portfolio</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item" data-size="60"><a href="gallery.html">Gallery</a></li>
                                           
                                            <li class="menu-item" data-size="60"><a href="404.html">404 Page</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children kingster-normal-menu"><a href="#" class="sf-with-ul-pre">News</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item" data-size="60"><a href="blog.php">Update</a></li>
                                            <li class="menu-item" data-size="60"><a href="events.php">Events</a></li>

                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children kingster-normal-menu"><a href="#" class="sf-with-ul-pre">Membership</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item" data-size="60"><a href="membership.php">Memberhsip</a></li>
                                            <li class="menu-item" data-size="60"><a href="register.php">Become A Member</a></li>
                                           
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children kingster-normal-menu"><a href="#" class="sf-with-ul-pre">Donate to us</a>
                                        
                                    </li>
                                   
                                </ul>
                                <div class="kingster-navigation-slide-bar" id="kingster-navigation-slide-bar"></div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            
</header>