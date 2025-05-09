<?php
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $regno = $_GET['membership_num'];
    $transaction_id = $_GET['tid'];
  

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "membership_management";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch payment details
    $sql = "SELECT * FROM payments WHERE membership_num = ? AND transaction_id = ? AND payment_status = 'PAID'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $regno, $transaction_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $payment = $result->fetch_assoc();
    } else {
        echo "<script>alert('Payment does not exist or is not yet paid.');</script>";
        header("Location: fetch_receipt.php ");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: display_receipt.php");
    exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style>
<style type="text/css">
	body{
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size:12px;
		padding: 30px;
	}
	
	#waterMark{
	position:absolute;
	z-index:-10;
	top:25%;
	left:25%;
	width:405px;
	height:562px;
	
}
.receipt-table {
            width: 50%;
            margin-bottom: 20px;
            align: center;
            table-layout: center;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
        }
        th {
            text-align: right;
            padding: 10px;
            border: 2px solid black;
        }
        tr,  td {
            border: 2px solid black;
            padding: 10px;
           
            }
            .btn-primary{
            	 background-color: #0275d8;
            	 color:white; 
            	 border: none;
            	 padding: 10px 20px; 
            	 text-align: center; 
            	 text-decoration: none; 
            	 display: inline-block; 
            	 font-size: 16px; 
            	 cursor:pointer;
            }
            .btn-danger{
            		background-color:red; 
            		color:white;  
            		border: none;
            		padding: 10px 20px; 
            		text-align: center; 
            		text-decoration: none; 
            		display: inline-block; 
            		font-size: 16px; 
            		cursor:pointer
            }
   
</style>
<title>Wikimedia User Group Nigeria: <?php echo $payment["regno"]; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="include/style.css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <script src="include/jquery-1.7.2.min.js"></script>

       
</head>


    


<div id="waterMark"><img src="../images/logolarge.png" width="400" height="553"></div>

<div style="position:absolute; overflow:hidden; left:82%; top:100px; z-index:18; border: 1px solid #000000;">

</div>
<div class="container receipt-container">
<center>

	<?php
	echo
	'<tr>
			<td align="center" colspan="6">
				<span style="font-size:21px;font-weight:bold;">WIKIMEDIA USER GROUP </span><br /><br />
				<span style="font-size:17px;font-weight:bold;"> NIGERIA </span><br /><br />
					<img src="../images/200px-Wikimedia_Nigeria_User_Group.svg.png" width="100" align="bottom"/><br />
					<br />
						<p style="font-size:14px;font-weight:bold; padding-top:10px;">'.htmlspecialchars(strtoupper($payment["payment_type"])). " ". "e-Payment Receipt" .'</p><br />
			</td>
		</tr>';?>
<table class="table table-bordered receipt-table width="100%" >


<?php
		echo 
			'<tr>
            <th>Registration Number.:</th>
            <td>'.htmlspecialchars($payment["membership_num"]).'</td>
        </tr> ';
        echo 
			'<tr>
            <th>Surname.:</th>
            <td>'.htmlspecialchars($payment["surname"]).'</td>
        </tr> ';
        echo 
			'<tr>
            <th>Other Names.:</th>
            <td>'.htmlspecialchars($payment["othernames"]).'</td>
        </tr> ';

        echo '<tr>
            <th>Transaction ID.:</th>
            <td>'.htmlspecialchars($payment["transaction_id"]).'</td>
        </tr>';

        echo '<tr>
            <th>Year.:</th>
            <td>'.htmlspecialchars($payment["year"]).'</td>
        </tr>';

        echo ' <tr>
            <th>Email.:</th>
            <td>'.htmlspecialchars($payment["email"]).'</td>
        </tr>';

 		echo '<tr>
            <th>Phone.:</th>
            <td>'.htmlspecialchars($payment["phone"]).'</td>
        
        </tr>';

        echo '
        <tr>
            <th>Category.:</th>
            <td>'. htmlspecialchars($payment["membership_category"]).'</td>
        </tr>';

        echo '
        <tr>
            <th>Payment Type.:</th>
            <td>'.htmlspecialchars($payment["payment_type"]).'</td>
        </tr>
        ';
       
       echo '<tr>
            <th>Amount Paid.:</th>
            <td>'.number_format($payment["amount"], 2).' NGN</td>
        </tr> ';
       
        echo'
        <tr>
            <th>Status.:</th>
            <td>'.htmlspecialchars($payment["payment_status"]).'</td>
        </tr>
        ';

        echo '
        <tr rowspan="2">
            <th><button class="btn btn-primary" onclick="window.print()">Print</button></th>
            <td><button class="btn btn-danger" onclick="window.close()">Close</button></td>
        </tr>';
	

		?>			
						
</table>
<div class="container receipt-container">
</center>
</body>


</html>
