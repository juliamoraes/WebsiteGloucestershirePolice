<?php
include("./dbconnection.php"); // Ensure the path to dbconnection.php is correct

if (isset($_POST["submit"])) {
    echo '<script>alert("Form submitted");</script>';
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);   

    // Check if email already exists
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // echo '<script>alert("Query executed");</script>';

        // Check if any rows were returned
        $num_rows = mysqli_num_rows($result);
        // echo '<script>alert("Number of rows: ' . $num_rows . '");</script>';

        if ($num_rows > 0) {
            $user = mysqli_fetch_assoc($result);

            if ($user['role'] == "user"){
            $hashed_password = $user['password']; // Access the hashed password from the result

            // Verify the password
            if (password_verify($pass, $hashed_password)) {
                // Set a cookie to store the email
                setcookie("user_email", $email, time() + (86400 * 30), "/"); // Cookie lasts for 30 days
                setcookie("user_id", $user['id'], time() + (86400 * 30), "/"); // Cookie lasts for 30 days
                echo '<script>alert("Login successful!");</script>';
                header("Location: ../template/user/register_form.php"); // Redirect to the next page
                exit();
            } else {
                echo '<script>alert("Invalid password."); window.location.href = "../template/login.php";</script>';
            }
        } elseif($user['role'] == "super-admin"){
            $hashed_password = $user['password']; // Access the hashed password from the result

            // Verify the password
            if (password_verify($pass, $hashed_password)) {
                // Set a cookie to store the email
                setcookie("user_email", $email, time() + (86400 * 30), "/"); // Cookie lasts for 30 days
                setcookie("user_id", $user['id'], time() + (86400 * 30), "/"); // Cookie lasts for 30 days
                echo '<script>alert("Login successful!");</script>';
                header("Location: ../template/super_admin/police_registeration.php"); // Redirect to the next page
                exit();
            } else {
                echo '<script>alert("Invalid password."); window.location.href = "../template/login.php";</script>';
                exit();
            }
        } elseif($user['role'] == "admin"){
            $hashed_password = $user['password']; // Access the hashed password from the result

            // Verify the password
            if (password_verify($pass, $hashed_password)) {
                // Set a cookie to store the email
                setcookie("user_email", $email, time() + (86400 * 30), "/"); // Cookie lasts for 30 days
                setcookie("user_id", $user['id'], time() + (86400 * 30), "/"); // Cookie lasts for 30 days
                echo '<script>alert("Login successful!");</script>';
                header("Location: ../template/admin/police_report.php"); // Redirect to the next page
                exit();
            } else {
                echo '<script>alert("Invalid password."); window.location.href = "../template/login.php";</script>';
                exit();
            }
        }
        } else {
            echo '<script>alert("No user found with that email."); window.location.href = "../template/login.php";</script>';
            exit();
        }
    } else {
        echo '<script>alert("Query failed: ' . addslashes(mysqli_error($conn)) . '");</script>';
    }
}
?>
