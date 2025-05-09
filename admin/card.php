<?php 
//session_start();
include "../db.php";
// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: adminlogin.php");
    exit();
}

$query = "SELECT COUNT(*) as total FROM biodata";
$result = $conn->query($query);



//total student members 
$query1 = "SELECT COUNT(*) as total FROM biodata where mem_category='student'";
$result1 = $conn->query($query1);

$query2 = "SELECT COUNT(*) as total FROM biodata where mem_category='Regular'";
$result2 = $conn->query($query2);

$query3 = "SELECT COUNT(*) as total FROM biodata where mem_category='Associate'";
$result3 = $conn->query($query3);

if ($result) {
    $data = $result->fetch_assoc();
    //echo "Total Members: " . $data['total'];
} else {
    echo "Query failed: " . $conn->error;
}


if ($result1) {
  $data1 = $result1->fetch_assoc();
  //echo "Total Members: " . $data['total'];
} else {
  echo "Query failed: " . $conn->error;
}


if ($result2) {
  $data2 = $result2->fetch_assoc();
  //echo "Total Members: " . $data['total'];
} else {
  echo "Query failed: " . $conn->error;
}


if ($result3) {
  $data3 = $result3->fetch_assoc();
  //echo "Total Members: " . $data['total'];
} else {
  echo "Query failed: " . $conn->error;
}
?>
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">

               

                <div class="card-body">
                  <h5 class="card-title">All   <span>| Members</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php //echo "Total Screened:<br />" .$row; 
                      
                      echo "<center>Total Members: <br/> " . $data['total'] . "</center>";
                      ?></h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card revenue-card">

                

                <div class="card-body">
                  <h5 class="card-title">Students  <span>| Members</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                     <!-- <i class="bi bi-currency-dollar"></i> -->
                     <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php 
                             echo "<center>Students Members: <br/> " . $data1['total'] . "</center>";
                           ?>
                      </h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->
             <!-- Revenue Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card revenue-card">

                

                <div class="card-body">
                  <h5 class="card-title">All Regular <span>| Members</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                     <!-- <i class="bi bi-currency-dollar"></i> -->
                     <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
                                          echo "<center>Regular Members: <br/> " . $data2['total'] . "</center>";
                           ?>
                      </h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-3 col-xl-12">

              <div class="card info-card customers-card">

                

                <div class="card-body">
                  <h5 class="card-title">All Associate<span>| Members</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-2">
                      <h6><?php 
                                 echo "<center>Associate Members: <br/> " . $data3['total'] . "</center>";
                             
                           ?></h6>

                    </div>
                  </div>

                </div>

              </div>

            </div>


              <!-- new -->
              <div class="col-xxl-3 col-xl-12">

              <div class="card info-card customers-card">

                

                <div class="card-body">
                  <h5 class="card-title">Executive<span>| Members</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-2">
                      <h6><?php 

                            
                           ?></h6>
                           <!--
                      <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>
                                -->
                    </div>
                  </div>

                </div>

          

                
              </div>

            </div>

            <div class="col-xxl-3 col-xl-12">

              <div class="card info-card customers-card">

               
                <div class="card-body">
                  <h5 class="card-title">Staff<span>| Members</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-2">
                      <h6><?php 

                            
                           ?></h6>
                           <!--
                      <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>
                                -->
                    </div>
                  </div>

                </div>

          

                
              </div>

            </div>