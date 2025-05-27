<?php
session_start();
include 'db.php';
if (!isset($_SESSION['membership_num'])) {
    header('Location: login.php');
    exit();
}

$membership_num = $_SESSION['membership_num'];

// Handle biodata update
if (isset($_POST['update'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $wikipedia_projects = mysqli_real_escape_string($conn, $_POST['wikipedia_projects']);
    $wikipedia_account = mysqli_real_escape_string($conn, $_POST['wikipedia_account']);
    $open_movement = mysqli_real_escape_string($conn, $_POST['open_movement']);
    $wugn_activities = mysqli_real_escape_string($conn, $_POST['wugn_activities']);
    $fan_club = mysqli_real_escape_string($conn, $_POST['fan_club']);
    $other_usergroups = mysqli_real_escape_string($conn, $_POST['other_usergroups']);
    $declaration = mysqli_real_escape_string($conn, $_POST['declaration']);

    $query = mysqli_query($conn, "UPDATE biodata SET 
        firstname='$firstname', lastname='$lastname', email='$email', gender='$gender',
        phone='$phone', address='$address', city='$city', state='$state', country='$country',
        wikipedia_projects='$wikipedia_projects', wikipedia_account='$wikipedia_account',
        open_movement='$open_movement', wugn_activities='$wugn_activities',
        fan_club='$fan_club', other_usergroups='$other_usergroups', declaration='$declaration'
        WHERE regno='$membership_num'
    ");

    if ($query) {
        $success = "Biodata Updated Successfully!";
    } else {
        $error = "Failed to Update Biodata!";
    }
}

// Fetch existing biodata
$biodata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biodata WHERE regno='$membership_num'"));