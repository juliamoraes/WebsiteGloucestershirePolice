<?php
// Include your database connection file
include("../dbconnection.php");

if (isset($_POST["submit"])) {
    // Retrieve and sanitize form data
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $c_pass = mysqli_real_escape_string($conn, $_POST['c_password']);
    $phone = "000000";
    $user_role = "admin";

    
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
            //   header("Location: ../../template/login.php");
            //   exit(); // Added exit() after header redirection
            echo '<script>alert("Police Register Successfully"); window.location.href = "../../template/super_admin/police_registeration.php";</script>';
          } else {
              echo '<script>alert("Error: Could not register user."); window.location.href = "../../template/super_admin/police_registeration.php";</script>';
          }
      } else { 
          echo  '<script>
                  alert("Passwords do not match");
                  window.location.href = "../../template/super_admin/police_registeration.php";
              </script>';
      }      
  } else {  
      if ($count_user > 0) {
          echo  '<script>
                  alert("Username already exists!!");
                  window.location.href = "../../template/super_admin/police_registeration.php";
              </script>';
      }
      if ($count_email > 0) {
          echo  '<script>
                  alert("Email already exists!!");
                  window.location.href = "../../template/super_admin/police_registeration.php";
              </script>';
      }
  }     

}
?>
