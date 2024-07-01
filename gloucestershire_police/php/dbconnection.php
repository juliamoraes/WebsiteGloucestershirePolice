<?php
$servername = "localhost"; // Your database server
$username = "juliadatabase"; // Your database username
$password = "julia@123@database"; // Your database password
$dbname = "juliadatabase"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connection Successfully!"
?>