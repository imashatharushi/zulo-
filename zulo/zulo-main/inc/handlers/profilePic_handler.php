<?php 
session_start();
include_once "../../inc/db.php";  // Ensure this file contains the DB connection

if (isset($_SESSION["user_id"])) {
    $userID = $_SESSION["user_id"];  // Get the logged-in user's ID

    if (isset($_POST['uploadImg'])) {
        
        if (isset($_FILES['uploadImg']) && $_FILES['uploadImg']['error'] === UPLOAD_ERR_OK) {
            $fileName = $_FILES["uploadImg"]["name"];
            $fileType = $_FILES["uploadImg"]["type"];
            $tmpName = $_FILES["uploadImg"]["tmp_name"];
            
            $targetDir = "../../assets/img/userProfile/";
            $safeFileName = basename($fileName);
            $targetFile = $targetDir . $safeFileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($tmpName, $targetFile)) {
                echo "The file " . $safeFileName . " has been uploaded successfully.";

                // Update the users table with the image name
                try {
                    // Prepare the SQL query
                    $query = "UPDATE users SET image = :image WHERE user_id = :user_id";
                    $stmt = $conn->prepare($query);
                    
                    // Bind parameters
                    $stmt->bindParam(':image', $safeFileName);
                    $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);

                    // Execute the query
                    if ($stmt->execute()) {
                        header("location:../../pages/profile");
                    } else {
                        echo "Error updating user profile image name.";
                    }
                } catch (PDOException $e) {
                    echo "Database error: " . $e->getMessage();
                }

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "No file was uploaded or there was an error.";
        }
    }
} else {
    echo "User not logged in.";
}
?>
