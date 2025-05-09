<?php

require_once 'db.php';

$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

$stmt = $pdo->prepare("SELECT * FROM biodata WHERE regno LIKE ? OR surname LIKE ?");
$stmt->execute(['%' . $searchTerm . '%', '%' . $searchTerm . '%']);
$members = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member List</title>
</head>
<body>

<h1>Search Members</h1>
<form action="member_list.php" method="POST">
    <input type="text" name="search" placeholder="Search by Name or Registration Number" value="<?php echo $searchTerm; ?>">
    <button type="submit">Search</button>
</form>

<h2>Member Results</h2>
<table>
    <tr>
        <th>Reg No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>
    <?php foreach ($members as $member): ?>
    <tr>
        <td><?php echo $member['regno']; ?></td>
        <td><?php echo $member['surname'] . ' ' . $member['othername']; ?></td>
        <td><?php echo $member['email']; ?></td>
        <td><?php echo $member['phone']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
