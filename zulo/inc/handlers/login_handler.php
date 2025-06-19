<?php

include_once '../db.php';
include_once '../function.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pwd = $_POST['password'];


    loginUser($conn, $email, $pwd);
}
