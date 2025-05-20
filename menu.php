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
                                                             $queryStaff = "SELECT id, office FROM staff WHERE designation = 'Board of Trustee'";
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
                                                <li class="menu-item menu-item-has-children" data-size="15"><a href="excos.php" class="sf-with-ul-pre">Executive Members</a>
                                                    <ul class="sub-menu">
                                                    <?php
                                                             // Fetch staff members with designation 'Staff'
                                                             $queryStaff = "SELECT id, office FROM staff WHERE designation = 'Executive Committee'";
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
                                            <li class="menu-item" data-size="60"><a href="#">Apply To AFUED</a></li>
                                            <li class="menu-item" data-size="60"><a href="scholarships.html">Scholarships</a></li>
                                            <li class="menu-item" data-size="60"><a href="scholarships.html">College of Technology</a></li>
                                            <li class="menu-item" data-size="60"><a href="scholarships.html">Pre-Degree</a></li>
                                            <li class="menu-item" data-size="60"><a href="scholarships.html">Part-Time</a></li>
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