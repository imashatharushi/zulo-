<?php
// Include database connection file
include '../../../inc/db.php'; // Adjust path as necessary

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $accountStatus = isset($_POST['account_status']) ? 1 : 0; // If checkbox is checked, set to 1; otherwise, 0

    // SQL query to update the account status
    $sql = "UPDATE users SET account_status = :account_status WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':account_status', $accountStatus, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect back to the admin page or display a success message
        header("Location:  ../../../pages/admin/users.php"); // Change to your admin page
        exit;
    } else {
        echo 'Failed to update account status.';
    }
} else {
    echo 'Invalid input.';
}
