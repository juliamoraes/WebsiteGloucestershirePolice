<?php

// Check if the user is authenticated
if (!isset($_COOKIE['user_email']) || !isset($_COOKIE['user_id'])) {
    // If cookies are not set, redirect to the login page
    header("Location: ../login.php");
    exit();
}

// Check if the cookie is set
if(isset($_COOKIE['user_email'])) {
    $email = $_COOKIE['user_email'];
    // echo '<script>alert("Welcome back, ' . addslashes($email) . '");</script>';
} else {
    echo '<script>alert("No user email found in cookies.");</script>';
}

if(isset($_COOKIE['user_id'])) {
    $id = $_COOKIE['user_id'];
    // echo '<script>alert("Welcome back, ' . addslashes($id) . '");</script>';
} else {
    echo '<script>alert("No user id found in cookies.");</script>';
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/style.css"> <!-- Link to CSS -->
    <title>Fetch Lost Item Result</title>
</head>
<body>
    <h2>Welcome to Gloucestershire Constabulary</h2> 
    <h3>Bicycle Theft Reduction Program - Police Bike Status Dashboard</h3>
    <p><center>Your email is: <?php echo htmlspecialchars($email); ?></center></p>
    <p><center>Your ID is: <?php echo htmlspecialchars($id); ?></center></p>

    <!-- Form to update bike status -->
    <form id="updateStatusForm">
        <label for="bikeId">Bike ID:</label>
        <input type="text" id="bikeId" name="bikeId" required>
        
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="active">Active</option>
            <option value="found">Found</option>
        </select>
        
        <button type="submit">Update Status</button>
    </form>
    
    <!-- Logout button -->
    <form action="../../php/logout.php" method="post">
        <button type="logout" name="logout">Logout</button>
    </form>

    <?php
    // Include your database connection file
    include("../../php/dbconnection.php");

    // Fetch data from the bikes table
    $sql = "SELECT * FROM bikes";
    $result = mysqli_query($conn, $sql);

    // Check if there are any records
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>MPN</th><th>Brand</th><th>Model</th><th>Type</th><th>Size</th><th>Color</th><th>Gears</th><th>Brake</th><th>Suspension</th><th>Gender</th><th>Age Group</th><th>Image</th><th>User ID</th><th>Status</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['mpn']) . "</td>";
            echo "<td>" . htmlspecialchars($row['brand']) . "</td>";
            echo "<td>" . htmlspecialchars($row['model']) . "</td>";
            echo "<td>" . htmlspecialchars($row['type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['size']) . "</td>";
            echo "<td>" . htmlspecialchars($row['color']) . "</td>";
            echo "<td>" . htmlspecialchars($row['gears']) . "</td>";
            echo "<td>" . htmlspecialchars($row['brake']) . "</td>";
            echo "<td>" . htmlspecialchars($row['suspension']) . "</td>";
            echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
            echo "<td>" . htmlspecialchars($row['age_group']) . "</td>"; 
            echo "<td><img src='" . htmlspecialchars("./../../php/user/" . $row['image']) . "' width='100' height='100'></td>";
            echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found";
    }

    // Close database connection
    mysqli_close($conn);
    ?>

    <!-- Calling the external JavaScript file -->
    <script src="../../js/user/update_status.js"></script>
</body>
</html>
