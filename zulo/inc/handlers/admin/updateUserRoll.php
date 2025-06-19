<?php
include_once "../../db.php";
include_once "../../function.php";

echo "hello";

if ($_GET["userId"] && $_GET["roll"]) {
    $userId = $_GET["userId"];
    $roll = $_GET["roll"];

    $sql = "UPDATE users SET roll = :roll WHERE user_id = :userId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':roll', $roll, PDO::PARAM_STR);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
}
