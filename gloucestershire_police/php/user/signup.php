<?php

include("../dbconnection.php"); // Added semicolon here

if (isset($_POST["submit"])) { // Fixed the incorrect variable name $POST to $_POST
  // Collect form data
  // Collect and sanitize form data
  $user = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $pass = mysqli_real_escape_string($conn, $_POST['password']);
  $c_pass = mysqli_real_escape_string($conn, $_POST['c_password']);
  $user_role = "user";

  // Check if username already exists
  $sql = "SELECT * FROM user WHERE username='$user'";
  $result = mysqli_query($conn, $sql);        
  $count_user = mysqli_num_rows($result);  

  // Check if email already exists
  $sql = "SELECT * FROM user WHERE email='$email'";
  $result = mysqli_query($conn, $sql);        
  $count_email = mysqli_num_rows($result);  
  
  // Generate a unique ID
  function generateUniqueId() {
    return md5(uniqid(rand(), true));
  }

  $uniqueId = generateUniqueId();


  if ($count_user == 0 && $count_email == 0) {  
      if ($pass == $c_pass) { // Corrected variable names from $password and $cpassword to $pass and $c_pass
          $hash = password_hash($pass, PASSWORD_DEFAULT); // Corrected variable name $password to $pass

          // Insert the new user into the database
          $sql = "INSERT INTO user(id , username, email, phone, password, role) VALUES('$uniqueId', '$user', '$email', '$phone', '$hash', '$user_role')";
          $result = mysqli_query($conn, $sql);
          
          if ($result) {
              header("Location: ../../template/login.php");
              exit(); // Added exit() after header redirection
          } else {
              echo '<script>alert("Error: Could not register user."); window.location.href = "../../user/signup_user.php";</script>';
          }
      } else { 
          echo  '<script>
                  alert("Passwords do not match");
                  window.location.href = "../../user/signup_user.php";
              </script>';
      }      
  } else {  
      if ($count_user > 0) {
          echo  '<script>
                  alert("Username already exists!!");
                  window.location.href = "../../user/signup_user.php";
              </script>';
      }
      if ($count_email > 0) {
          echo  '<script>
                  alert("Email already exists!!");
                  window.location.href = "../../user/signup_user.php";
              </script>';
      }
  }     
}
?>
