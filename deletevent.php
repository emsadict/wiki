<?php
include 'db_connect.php'; // Include database connection

// Check if an event ID is provided
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    // Fetch the event details to get file paths
    $query = "SELECT event_image, event_thumbnail FROM events WHERE id = $event_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $event = mysqli_fetch_assoc($result);

        // Delete event images from the server
        if (!empty($event['event_image']) && file_exists("uploads/" . $event['event_image'])) {
            unlink("uploads/" . $event['event_image']);
        }
        if (!empty($event['event_thumbnail']) && file_exists("uploads/" . $event['event_thumbnail'])) {
            unlink("uploads/" . $event['event_thumbnail']);
        }

        // Delete the event from the database
        $delete_query = "DELETE FROM events WHERE id = $event_id";
        if (mysqli_query($conn, $delete_query)) {
            // Redirect to manage_events.php after successful deletion
            header("Location: manage_event.php?message=Event deleted successfully");
            exit();
        } else {
            header("Location: manage_event.php?message=Error deleting event");
            exit();
        }
    } else {
        header("Location: manage_event.php?message=Event not found");
        exit();
    }
} else {
    header("Location: manage_event.php?message=No event ID provided");
    exit();
}
?>
