<?php
include("../../php/dbconnection.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../../css/style.css"> <!-- Link to CSS -->
    <title>Register Public</title>
</head>

<body>
    <div>
        <!-- Heading for the page -->
        <h2>Welcome to Gloucestershire Constabulary</h2> 
        <h3>Bicycle Theft Reduction Program - Signup Public</h3>
        
    <form id="registrationForm" action="../../php/user/signup.php" method="post">
        <label for="username"> Username </label>
        <input type="text" id="name" name="username" placeholder="Enter the Username" required>
        <br>

        <label for="email"> Email </label>
        <input type="email" id="email" name="email" placeholder="Enter the Email" required>
        <br>

        <label for="phone"> Phone Number </label>
        <input type="number" id="phone" name="phone" placeholder="Enter the Phone Number" required>
        <br>

        <label for="password"> Password </label>
        <input type="password" id="password" name="password" placeholder="Enter the Password" required>
        <br>

        <label for="password"> Confirm Password </label>
        <input type="password" id="c_password" name="c_password" placeholder="Enter the  Coonfirm Password" required>
        <br>

        <button type="submit" name="submit">Register Now</button>
    </form>
    
    <form action="../login.php">
        If you have already account please go to login!
    <button type="login">Login</button>
    </form>
</div>

<!-- JavaScript to handle asynchronous form submission -->
<!-- <script src="../../js/user/signup.js"></script> -->
</body>

</html>