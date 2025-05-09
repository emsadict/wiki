

<?php
session_start();
include "../db.php";
// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: adminlogin.php");
    exit();
}
$msg=$msg1=$msg2=$msg3=$msg4=$msg5=$msg6=$msg11=$msg7=$msg11=$msg8=$msg9=$msg10=$firstname=$lastname=$email=$mail=$date=$password=$c_password=$image=$name='';
 $id=$_GET['user'];

if (isset($id)) {
  $sql = "SELECT * FROM biodata  WHERE regno='$id' "; 
  $result = $conn->query($sql);
          $retrieve=mysqli_fetch_array($result);
          $id=$retrieve['regno'];
          $name=$retrieve['first_name'];
          $last=$retrieve['last_name'];
          $sex=$retrieve['sex'];
         // $dob=$retrieve['dob'];
         // $maritalstatus=$retrieve['maritalstatus'];
          $nationality=$retrieve['country'];
          $state=$retrieve['state'];
          $lg=$retrieve['city'];
          $mail=$retrieve['email'];
          $phoneno=$retrieve['phone'];
          $address=$retrieve['street_address'];
          $image=$retrieve['passport'];
          $category=$retrieve['mem_category'];
          //$dept=$retrieve['dept'];
          //$programme=$retrieve['programme'];
          //$title=$retrieve['title'];
          //$noksurname=$retrieve['noksurname'];
          //$nokoname=$retrieve['nokoname'];
          //$noktel=$retrieve['noktel'];
          //$nokemail=$retrieve['nokemail'];
        }
     
        

?>
<title>Profile Page</title>
<style type="text/css">
  #body-bg
  {
    background-color: #efefef;
     
  
  }
table {
  font-family: arial, sans-serif;
 /* border-collapse: collapse; */
  width: 80%;
  margin-right:auto;
  margin-left: auto;
  
 

}
.container {
  background-repeat: no-repeat;
  background-position: center;
  background-image: url(bglogo.jpg);
  background-position-y: 180px;
}
td, th {
  border: 1px solid #dddddd;
  text-align: right;
  width: 100px;
  padding: 7px;
  align-content: center;
  
  
 
}
td{
   margin-right:auto;
  margin-left: auto;

}
.center{
  margin-left: auto;
  margin-right: auto;
}
/*
tr:nth-child(even) {
  background-color: #dddddd;
  width: 100%;
}
*/
img{
  margin-left: 140px;
  position: center;
}
</style>



</head>
<body id='body-bg'>
<?php include_once("header.php")?>
<?php include_once("sidebar.php")?>
<div class='container text-primary' style='background-color:white; margin-top:80px; margin-bottom: 20px;width: 400px;height: 50px;margin-left: 400px;'>


  <center><button class="btn btn-outline-success" style='float: center;margin-top:5px; padding-right: 10px; margin-left: 5px;'  onClick="printdiv('printable_div_datapage');">PRINT DATAPAGE</button></center>
<!--
  <a><button onclick="window.print()" class='btn btn-outline-success' style='float: right;margin-top:5px; padding-right: 10px; margin-left: 5px;'>Print Page</button></a> -->
</div>

  <div id="printable_div_datapage" class='container text-primary' style='background-color:white; margin-top:20px; margin-bottom: 20px;width: 1000px;height: 1800px; margin-left: 400px;'>

<a href='components-alerts.php'><button class='btn btn-outline-warning' style='float: right;margin-top:20px; padding-right: 10px; margin-left: 5px;'>Back</button></a>
    <a href="logout.php"><button class='btn btn-outline-danger' style='float: right;margin-top:20px;margin-left: 10px;'>Logout</button></a>
 <center><h2 style="margin-left: 140px;"><?php  echo ucfirst($name. " ". $last); ?></h2></center> 
<center><img src="../pass/<?php  echo $image; ?>" class="img-fluid img-thumbnail" width="100" height="80"></center>
<center>
<h5><?php echo "$category"; ?></h5>
<h5><?php //echo "$dept"; ?></h5>
<h5><?php //echo "$programme"; ?></h5>
<h5><?php //echo "$title"; ?></h5>
</center>



  <table class="table-bordered center" style="border:1px solid black; margin-top:1px; width: 800px;">
         <tr>
            <th style="text-align:center;" colspan="2">Personal Details</th>
      
         </tr>
         <tr>
          <td>Reg No:   <b></b></td>
            <td style="text-align: left;"><b><?php echo "$id"; ?></b></td>
  
         </tr>
         <tr>
          <td>Names: <b></b></td>
            <td style="text-align: left;"><b> <?php echo "$name "."$last"; ?></b></td>
  
         </tr>
         <tr>
          <td>Sex: <b></b></td>
            <td style="text-align: left;"><b><?php echo "$sex"; ?></b></td>
                
         </tr>
         <tr>
          <td>Marital: <b></b></td>
            <td style="text-align: left;"><b> <?php echo "$maritalstatus"; ?></b></td>
     
         </tr>

          <tr>
            <td>Nationality:  <b></b></td>
            <td style="text-align: left;"><b> <?php echo "$nationality"; ?></b></td>
        
         </tr>

          <tr>
            <td>State:  <b></b></td>
            <td style="text-align: left;"><b> <?php echo "$state"; ?></b></td>
        
         </tr>
          <tr>
            <td>Local Govt.</b></td>
            <td style="text-align: left;"> <b> <?php echo "$lg"; ?></b></td>
    
         </tr>
          <tr>
            <td>Email:   <b></b></td>
            <td style="text-align: left;"><b><?php echo "$mail"; ?></b></td>
     
            
         </tr>
          <tr>
            <td>Phone: <b></b></td>
            <td style="text-align: left;"> <b> 0<?php echo "$phoneno"; ?></b></td>
   
         </tr>
          <tr>
            <td>Address:  <b></b></td>
            <td style="text-align: left;"><b> <?php echo "$address"; ?></b></td>
    
         </tr>
          
         
</table>

</br>



<table class="table-bordered center" style="border:1px solid black; margin-top:1px; width: 400px;">
  <th style="text-align:center;" colspan="2">NYSC</th>
            
            <tr>
              <td> NYSC Year</td>
              <td style="text-align: left;"> <?php echo "$nysc1"; ?></td>:
            </tr>

            <tr>
              <td> CERT.  NO</td>
              <td style="text-align: left;"> <?php echo "$nysc2"; ?></td>:
            </tr>    
</table>
<br><br>
<center><button class="btn btn-success"  onClick="printdiv('printable_div_datapage');">PRINT</button></center>

<script>
function printdiv(elem) {
  var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
  var footer_str = '</body></html>';
  var new_str = document.getElementById(elem).innerHTML;
  var old_str = document.body.innerHTML;
  document.body.innerHTML = header_str + new_str + footer_str;
  window.printPreview();
  document.body.innerHTML = old_str;
  return false;
}
</script>

</div>

<br>




<br>


<?php include_once("footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</div>
</body>
</html>
