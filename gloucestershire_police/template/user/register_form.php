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
    <link rel="stylesheet" type="text/css" href="../../css/style.css"> <!-- Link to CSS -->
    <title>Register Record</title>
</head>

<body>
    <div>
        <!-- Heading for the page -->
        <h2>Welcome to Gloucestershire Constabulary</h2> 
        <h3>Bicycle Theft Reduction Program - Add Record for Public Theft Bicycle</h3>
        <p><center>Your email is: <?php echo htmlspecialchars($email); ?></center></p>
        <p><center>Your id is: <?php echo htmlspecialchars($id); ?></center></p>

        <form enctype="multipart/form-data" id="registerationTheftBikeForm" action="../../php/user/registeration_theft_form.php" method="post">

            <label for="mpn"> Manufacturer Part Number (MPN) : </label>
            <input type="text" id="mpn" name="mpn" placeholder="Enter the Mpn" required>
            <br>

            <label for="brand"> Brand Raleigh  </label>
            <input type="text" id="brand" name="brand" placeholder="Enter the Brand Raleigh" required>
            <br>

            <label for="model"> Model Motus  </label>
            <input type="text" id="model" name="model" placeholder="Enter the Model Motus" required>
            <br>

            <label for="type"> Type  </label>
            <input type="text" id="type" name="type" placeholder="Enter the Type" required>
            <br>

            <label for="size"> Wheel Size </label>
            <input type="text" id="size" name="size" placeholder="Enter the Wheel Size" required>
            <br>

            <label for="color"> Colour </label>
            <input type="text" id="color" name="color" placeholder="Enter the Colour" required>
            <br>

            <label for="gears"> Number of Gears </label>
            <input type="number" id="gears" name="gears" placeholder="Enter the Gears" required>
            <br>

            <label for="brake"> Brake Type </label>
            <input type="text" id="brake" name="brake" placeholder="Enter the Brake" required>
            <br>

            <label for="suspension"> Suspension </label>
            <input type="text" id="suspension" name="suspension" placeholder="Enter the Suspension" required>
            <br>

            <div>
                <label for="gender"> Gender </label>
                <select id="gender" name="gender" required>
                    <option value="">-- Please choose --</option> <!-- Default empty value -->
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="unisex">Unisex</option>
                </select>
                <br>
            </div>

            <div>
                <label for="age_group">Age Group:</label>
                <select id="age_group" name="age_group" required>
                    <option value="">-- Select Age Group --</option>
                    <option value="0-12">0-12</option>
                    <option value="13-17">13-17</option>
                    <option value="18-24">18-24</option>
                    <option value="25-34">25-34</option>
                    <option value="35-44">35-44</option>
                    <option value="45-54">45-54</option>
                    <option value="55-64">55-64</option>
                    <option value="65+">65+</option>
                </select>
            </div>

            <label for="image">Select Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <button type="submit" name="submit">Register Now</button>
        </form>

        <!-- Logout button -->
        <form action="../../php/logout.php" method="post">
            <button type="logout" name="logout">Logout</button>
        </form>
    </div>
    <?php
// Include your database connection file
include("../../php/dbconnection.php");

// Fetch the user_id from the cookie
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    echo "No user ID found in cookies.";
    exit;
}

// Prepare the SQL statement to fetch data for the specific user_id
$sql = "SELECT * FROM bikes WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // "i" indicates the type is integer
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any records
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>MPN</th><th>Brand</th><th>Model</th><th>Type</th><th>Size</th><th>Color</th><th>Gears</th><th>Brake</th><th>Suspension</th><th>Gender</th><th>Age Group</th><th>Image</th><th>User ID</th><th>Status</th></tr>";
    while ($row = $result->fetch_assoc()) {
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
        // Simple label for status
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found";
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
</body>

</html>