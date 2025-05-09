<?php
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "membership_management";




//$servername = "localhost";
//$username = "zlyclnqu_root"; // Change if necessary
//$password = "adeyemiuniversity"; // Change if necessary
//$dbname = "zlyclnqu_website_management";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
