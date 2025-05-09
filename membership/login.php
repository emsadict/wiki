<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $membership_num = mysqli_real_escape_string($conn, $_POST['membership_num']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM membership_accounts WHERE membership_num='$membership_num' AND password='$password'");

    if (mysqli_num_rows($query) == 1) {
        $_SESSION['membership_num'] = $membership_num;
        header("Location: update_biodata.php");
        exit();
    } else {
        $error = "Invalid Membership Number or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Member Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Wikimedia Nigeria Membership Portal</h2>
    <?php if (isset($_GET['success'])) { echo '<div class="alert alert-success">Registration Successful! Please login.</div>'; } ?>
    <?php if (isset($error)) { echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>
    <form method="POST" action="">
        <div class="mb-3">
            <label>Membership Number</label>
            <input type="text" name="membership_num" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password (Transaction ID)</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
</br>
</br>
<center><h6>NOT REGISTERED? CREATE ACCOUNT <a href="index.php">HERE </a></h6></center>
    </form>
</div>
</body>
</html>
