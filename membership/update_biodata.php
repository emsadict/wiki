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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Biodata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Update Your Biodata</h2>
    <?php if (isset($success)) { echo '<div class="alert alert-success">'.$success.'</div>'; } ?>
    <?php if (isset($error)) { echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>
    <form method="POST">
        <div class="row mb-3">
            <div class="col">
                <label>First Name *</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $biodata['first_name'] ?? ''; ?>" required>
            </div>
            <div class="col">
                <label>Last Name *</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $biodata['last_name'] ?? ''; ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Email *</label>
            <input type="email" name="email" class="form-control" value="<?php echo $biodata['email'] ?? ''; ?>" required>
        </div>

        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="Male" <?php if (($biodata['gender'] ?? '') == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if (($biodata['gender'] ?? '') == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Prefer not to Say" <?php if (($biodata['gender'] ?? '') == 'Prefer not to Say') echo 'selected'; ?>>Prefer not to Say</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Phone Number *</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $biodata['phone'] ?? ''; ?>" required>
        </div>

        <div class="mb-3">
            <label>Street Address *</label>
            <input type="text" name="address" class="form-control" value="<?php echo $biodata['address'] ?? ''; ?>" required>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>City *</label>
                <input type="text" name="city" class="form-control" value="<?php echo $biodata['city'] ?? ''; ?>" required>
            </div>
            <div class="col">
                <label>State *</label>
                <input type="text" name="state" class="form-control" value="<?php echo $biodata['state'] ?? ''; ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Country *</label>
            <input type="text" name="country" class="form-control" value="<?php echo $biodata['country'] ?? ''; ?>" required>
        </div>

        <div class="mb-3">
            <label>List your first three Wikimedia projects *</label>
            <input type="text" name="wikipedia_projects" class="form-control" value="<?php echo $biodata['wikipedia_projects'] ?? ''; ?>">
        </div>

        <div class="mb-3">
            <label>Do you have a Wikipedia account?</label>
            <input type="text" name="wikipedia_account" class="form-control" value="<?php echo $biodata['wikipedia_account'] ?? ''; ?>">
        </div>

        <div class="mb-3">
            <label>Are you involved in the open movement?</label>
            <textarea name="open_movement" class="form-control"><?php echo $biodata['open_movement'] ?? ''; ?></textarea>
        </div>

        <div class="mb-3">
            <label>Are you involved with WUGN Activities?</label>
            <select name="wugn_activities" class="form-control">
                <option value="Yes" <?php if (($biodata['wugn_activities'] ?? '') == 'Yes') echo 'selected'; ?>>Yes</option>
                <option value="No" <?php if (($biodata['wugn_activities'] ?? '') == 'No') echo 'selected'; ?>>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Do you belong to a WUGN Fan Club/Network?</label>
            <input type="text" name="fan_club" class="form-control" value="<?php echo $biodata['fan_club'] ?? ''; ?>">
        </div>

        <div class="mb-3">
            <label>Are you a member of other Usergroups/communities in Nigeria?</label>
            <input type="text" name="other_usergroups" class="form-control" value="<?php echo $biodata['other_usergroups'] ?? ''; ?>">
        </div>

        <div class="mb-3">
            <label>Do you agree to the declaration?</label>
            <select name="declaration" class="form-control" required>
                <option value="Yes" <?php if (($biodata['declaration'] ?? '') == 'Yes') echo 'selected'; ?>>Yes</option>
                <option value="No" <?php if (($biodata['declaration'] ?? '') == 'No') echo 'selected'; ?>>No</option>
            </select>
        </div>

        <button type="submit" name="update" class="btn btn-primary w-100">Update Biodata</button>
        <a href="logout.php" class="btn btn-danger w-100 mt-2">Logout</a>
    </form>
</div>
</body>
</html>
