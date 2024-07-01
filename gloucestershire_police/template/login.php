<?php
include("../php/dbconnection.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css"> <!-- Link to CSS -->
    <title>Login - Gloucestershire Constabulary</title>
</head>
<body>
    <div>
        <!-- Heading for the page -->
        <h2>Welcome to Gloucestershire Constabulary</h2> 
        <h3>Bicycle Theft Reduction Program - Login</h3>

        <!-- Form for login -->
        <form id="loginForm" action="../php/login.php" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <br>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <br>

            <button type="submit" name="submit">Login Now</button>
            
        </form>

        <form action="./user/signup_user.php">
            If you are new user please register now?
            <button type="register">Register</button>
        </form>
    </div>
</body>
</html>
