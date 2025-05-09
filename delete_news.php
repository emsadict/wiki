<?php
include "db_connect.php";
// Delete news by ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get the image filename to delete from server
    $sql = "SELECT image FROM news WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row && file_exists("uploads/" . $row['image'])) {
        unlink("uploads/" . $row['image']);
    }
    
    $delete_sql = "DELETE FROM news WHERE id = $id";
    
    if ($conn->query($delete_sql) === TRUE) {
        echo "News deleted successfully!";
        header("Location: manage_news.php");
    } else {
        echo "Error deleting news: " . $conn->error;
    }
}

$conn->close();
?>
