<?php
// Include your database connection file
include("../dbconnection.php");

// Check if the request contains the ID and status parameters
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    // Update the status in the database
    $sql = "UPDATE bikes SET status = '$status' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}

// Close database connection
mysqli_close($conn);
?>
