<?php

include_once '../db.php';
include_once '../function.php';

if (isset($_POST['submit'])) {
    // removing white spaces and assign values to the variables
    $fName = trim($_POST['fname']);
    $lName = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $pwd = trim($_POST['password']);
    $phoneNum = trim($_POST['phoneNum']);
    $streetAddress = trim($_POST['streetAddress']);
    $city = trim($_POST['city']);
    $province = trim($_POST['province']);
    $zipCode = trim($_POST['zipCode']);

    // check , is input -> empty ? invalid ? exists ? 
    $emptyInput = emptyInputSignup($fName, $lName, $email, $pwd, $phoneNum, $streetAddress, $city, $province, $zipCode);
    $invalidEmail = invalidEmail($email);
    $emailExists = emailExists($conn, $email);

    if ($emptyInput !== false || $invalidEmail !== false || $emailExists !== false) {
        if ($emailExists) {
            header("Location: ../../pages/login.php?error=emailExists");
            exit();
        } else {
            header("Location: ../../pages/login.php?error=invalidInputs");
            exit();
        }
        } else {
            createUser($conn, $fName, $lName, $email, $pwd, $phoneNum, $streetAddress, $city, $province, $zipCode);
            exit();
        }
    }
    


