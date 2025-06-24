<div class="kingster-mobile-header-wrap">
        <div class="kingster-mobile-header kingster-header-background kingster-style-slide kingster-sticky-mobile-navigation " id="kingster-mobile-header">
            <div class="kingster-mobile-header-container kingster-container clearfix">
                <div class="kingster-logo  kingster-item-pdlr">
                    <div class="kingster-logo-inner">
                        <a class="" href="index.php"><img src="images/logo.png" alt="" /></a>
                    </div>
                </div>
                <div class="kingster-mobile-menu-right">
                    <div class="kingster-main-menu-search" id="kingster-mobile-top-search"><i class="fa fa-search"></i></div>
                    <div class="kingster-top-search-wrap">
                        <div class="kingster-top-search-close"></div>
                        <div class="kingster-top-search-row">
                            <div class="kingster-top-search-cell">
                                <form role="search" method="get" class="search-form" action="#">
                                    <input type="text" class="search-field kingster-title-font" placeholder="Search..." value="" name="s">
                                    <div class="kingster-top-search-submit"><i class="fa fa-search"></i></div>
                                    <input type="submit" class="search-submit" value="Search">
                                    <div class="kingster-top-search-close"><i class="icon_close"></i></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="kingster-mobile-menu"><a class="kingster-mm-menu-button kingster-mobile-menu-button kingster-mobile-button-hamburger" href="#kingster-mobile-menu"><span></span></a>
                        <div class="kingster-mm-menu-wrap kingster-navigation-font" id="kingster-mobile-menu" data-slide="right">
                            <ul id="menu-main-navigation" class="m-menu">
                                <li class="menu-item menu-item-home current-menu-item menu-item-has-children"><a href="index.php">Home</a>
                                    
                                </li>
                                <li class="menu-item menu-item-has-children"><a href="#">Who we are</a>
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
                                                    <?php
                                                                      // Fetch staff members with designation 'Staff'
                                                                      $queryStaff = "SELECT id, campus FROM staff WHERE designation = 'Campus Director'";
                                                                      $resultStaff = $conn->query($queryStaff);

                                                                      // Generate menu items dynamically
                                                                      while ($row = $resultStaff->fetch_assoc()) {
                                                                          $staffName = htmlspecialchars($row['campus']);
                                                                          $staffUrl = "staff_profile.php?id=" . $row['id']; // Link to profile page

                                                                          echo '<li class="menu-item"><a href="' . $staffUrl . '">' . $staffName . '</a></li>';
                                                                         }                                                                      
                                                                      ?>
                                                    </ul>
                                                </li> 
                                            </ul>
                                </li>
                                <li class="menu-item menu-item-has-children"><a href="bachelor-of-science-in-business-administration.html">Events/Programmes</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item menu-item-has-children" data-size="60"><a href="#" class="sf-with-ul-pre">Advocacy</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="whr.php">Wiki for Human Right</a></li>
                                                    <li class="menu-item"><a href="mba.php">My Beautiful Africa</a></li>
                                                    <li class="menu-item"><a href="nrac.php">New reader Awareness Campaign</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children" data-size="60"><a href="#" class="sf-with-ul-pre">Gender-gap initiative</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="dint.php">Decolonize the Internet</a></li>
                                                    <li class="menu-item"><a href="wikigap.php">Wiki-GAP</a></li>
                                                    <li class="menu-item"><a href="wikinw.php">Wiki for Naija  Women</a></li>
                                                    <li class="menu-item"><a href="visibility.php">visibility Project</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children" data-size="60"><a href="education.php" class="sf-with-ul-pre">Education</a>
                                                <ul class="sub-menu">
                                                 <li class="menu-item"><a href="wikisch.php">Wiki in School</a></li>
                                                 <li class="menu-item"><a href="wfc.php">Wiki Fans Club</a></li>
                                                 
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children" data-size="60"><a href="glamini.php" class="sf-with-ul-pre">GLAM initiative</a>
                                                <ul class="sub-menu">
                                                 <li class="menu-item"><a href="oralhis.php">Oral History Documentation</a></li>
                                                 <li class="menu-item"><a href="finglam.php">Finding GLAM</a></li>
                                                 
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children" data-size="60"><a href="capacity.php" class="sf-with-ul-pre">Capacity Training</a>
                                                <ul class="sub-menu">
                                                 <li class="menu-item"><a href="train.php">Training</a></li>
                                                 
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children" data-size="60"><a href="allconferences.php" class="sf-with-ul-pre">Conferences</a>
                                                <ul class="sub-menu">
                                                 <li class="menu-item"><a href="wikiindaba.php">Wiki in Daba 2019</a></li>
                                                 <li class="menu-item"><a href="wikimaster.php">Wiki Master Conference 2018</a></li>
                                                 <li class="menu-item"><a href="wikimania.php">Wikimania</a></li>
                                                 <li class="menu-item"><a href="conference.php">Upcoming Conferences</a></li>
                                                </ul>
                                            </li>
                                    
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
                                    <li class="menu-item menu-item-has-children kingster-normal-menu"><a href="donate.php" class="sf-with-ul-pre">Donate to us</a>
                                        
                                    </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>