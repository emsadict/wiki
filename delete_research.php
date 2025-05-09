<?php
include 'db_connect.php'; // Include database connection

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid Research ID.";
    exit;
}

$research_id = $_GET['id'];

// Fetch research details
$query = "SELECT * FROM research_activities WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $research_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Research not found.";
    exit;
}

$research = $result->fetch_assoc();

// Handle delete confirmation
if (isset($_POST['confirm_delete'])) {
    $delete_query = "DELETE FROM research_activities WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $research_id);

    if ($stmt->execute()) {
        echo "Research deleted successfully!";
        header("Location: manage_research.php");
        exit;
    } else {
        echo "Error deleting research: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Research</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Delete Research</h2>
    <p>Are you sure you want to delete the research titled "<strong><?php echo htmlspecialchars($research['title']); ?></strong>"?</p>

    <form method="post">
        <button type="submit" name="confirm_delete" style="background-color: red; text-decoration: none; padding: 10px 15px; color: white;">Yes, Delete</button>
        <a href="manage_research.php" style="margin-left: 20px; text-decoration: none; padding: 10px 15px; background-color: gray; color: white; border-radius: 5px;">Cancel</a>
    </form>
</body>
</html>
