<?php
include_once "../../db.php";
include_once "../../function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mainCategory = $_POST['mainCategory']; // Get the main category name

    // Prepare the SQL query to insert the main category
    $sql = "INSERT INTO mainCategories (main_category_name) VALUES (:mainCategory);";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameter
    $stmt->bindParam(':mainCategory', $mainCategory);

    // Execute the query
    if ($stmt->execute()) {
        echo "Main category added successfully!";
    } else {
        echo "Error adding main category.";
    }
}
