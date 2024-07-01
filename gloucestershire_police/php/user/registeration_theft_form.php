<?php
// Include your database connection file
include("../dbconnection.php");

// Check if the form is submitted
if (isset($_POST["submit"])) {
    
    // Check if file was uploaded successfully
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        // Retrieve form data and sanitize
        $mpn = mysqli_real_escape_string($conn, $_POST['mpn']);
        $brand = mysqli_real_escape_string($conn, $_POST['brand']);
        $model = mysqli_real_escape_string($conn, $_POST['model']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $size = mysqli_real_escape_string($conn, $_POST['size']);
        $color = mysqli_real_escape_string($conn, $_POST['color']);
        $gears = mysqli_real_escape_string($conn, $_POST['gears']);
        $brake = mysqli_real_escape_string($conn, $_POST['brake']);
        $suspension = mysqli_real_escape_string($conn, $_POST['suspension']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $age_group = mysqli_real_escape_string($conn, $_POST['age_group']);
        
        // Generate a unique ID
        function generateUniqueId() {
            return md5(uniqid(rand(), true));
        }

        $uniqueId = generateUniqueId();
        
        // Get user ID from cookie
        $user_id = $_COOKIE['user_id'];
        
        $status = "active";
        
        // Process file upload
        $target_dir = "uploads/";
        
        // Check if the uploads directory exists, create it if not
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

            // echo $_FILES["image"]["tmp_name"] . ' - ' . $target_file;

            // Insert data into database
            $sql = "INSERT INTO bikes (id, mpn, brand, model, type, size, color, gears, brake, suspension, gender, age_group, image, user_id, status) 
                    VALUES ('$uniqueId', '$mpn', '$brand', '$model', '$type', '$size', '$color', '$gears', '$brake', '$suspension', '$gender', '$age_group', '$target_file', '$user_id', '$status')";
            
            if (mysqli_query($conn, $sql)) {
                echo '<script>
                alert("New record Added Successfully");
                window.location.href = "../../template/user/register_form.php";
            </script>';
                
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo '<script>
            alert("Error to Upload File");
            window.location.href = "../../template/user/register_form.php";
        </script>';
        }
    } else {
        echo "File upload error: " . $_FILES['image']['error'];
    }
    
    // Close database connection
    mysqli_close($conn);
}
?>
