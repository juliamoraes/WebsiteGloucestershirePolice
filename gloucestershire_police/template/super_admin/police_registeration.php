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
    <title>Register Police</title>
</head>

<body>
    <div>
        <!-- Heading for the page -->
        <h2>Welcome to Gloucestershire Constabulary</h2> 
        <h3>Bicycle Theft Reduction Program - Police Registeration Dashboard</h3>
        <p><center>Your email is: <?php echo htmlspecialchars($email); ?></center></p>
        <p><center>Your id is: <?php echo htmlspecialchars($id); ?></center></p>

    <form action="../../php/super_admin/police_registeration.php" method="post">
        <label for="username"> Police Full Name </label>
        <input type="text" id="name" name="username" placeholder="Enter the Username" required>
        <br>

        <label for="email"> Police Email </label>
        <input type="email" id="email" name="email" placeholder="Enter the Email" required>
        <br>

        <label for="password"> Police Password </label>
        <input type="password" id="password" name="password" placeholder="Enter the Password" required>
        <br>

        <label for="password"> Police Confirm Password </label>
        <input type="password" id="c_password" name="c_password" placeholder="Enter the  Coonfirm Password" required>
        <br>

        <button type="submit" name="submit">Register Now</button>
    </form>

    <!-- Logout button -->
    <form action="../../php/logout.php" method="post">
        <button type="logout" name="logout">Logout</button>
    </form>
</div>
</body>

</html>