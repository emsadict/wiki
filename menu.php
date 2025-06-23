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
                                        </div>
                                    </li>
                                    
                                     <li class="menu-item menu-item-has-children kingster-normal-menu"><a href="#" class="sf-with-ul-pre">Events/Programmes</a>
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
                                                 <li class="menu-item"><a href="trian.php">Training</a></li>
                                                 
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
                                <div class="kingster-navigation-slide-bar" id="kingster-navigation-slide-bar"></div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            
</header>