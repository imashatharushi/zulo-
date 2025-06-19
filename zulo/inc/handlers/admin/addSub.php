<?php
include_once "../../db.php";
include_once "../../function.php";

// add sub catergories
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description']; // Get the description
    $categoryImageUrl = $_POST['categoryImageUrl']; // Get the image URL
    $subCategoryName = $_POST['subCategoryName']; // Get the sub-category name
    $categoryName = $_POST['categoryName']; // Get the selected category name

    // Prepare the SQL query to insert the category
    $sql = "INSERT INTO subCategories ( category_name,subCategoryName, description, category_imgUrl) VALUES (:categoryName, :subCategoryName, :description, :categoryImageUrl);";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':categoryImageUrl', $categoryImageUrl);
    $stmt->bindParam(':subCategoryName', $subCategoryName);
    $stmt->bindParam(':categoryName', $categoryName); // Bind the main category ID

    // Execute the query
    if ($stmt->execute()) {
        echo "<p class='text-success'>Category added successfully!</p>";
    } else {
        echo "<p class='text-danger'>Error adding category: " . implode(", ", $stmt->errorInfo()) . "</p>";
    }
}
