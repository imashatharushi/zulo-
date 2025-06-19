<?php
function stmtFailed($stmt)
{
    if (!$stmt) {
        header('Location: $_SERVER["PHP_SELF"]?error=stmtFailed');
        exit();
    }
}

function emptyInputSignup($fName, $lName, $email, $pwd, $phoneNum, $streetAddress, $city, $province, $zipCode)
{
    $isEmpty = null;

    if (empty($fName) || empty($lName) || empty($email) || empty($pwd) || empty($phoneNum) || empty($streetAddress) || empty($city) || empty($province) || empty($zipCode)) {
        $isEmpty = true;
    } else {
        $isEmpty = false;
    }

    return $isEmpty;
}

function invalidEmail($email)
{
    $IsInvalid = null;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $IsInvalid = true;
    } else {
        $IsInvalid = false;
    }

    return $IsInvalid;
}

function emailExists($conn, $email)
{
    $sql = "SELECT * FROM users WHERE email = :email;";

    $stmt = $conn->prepare($sql);
    stmtFailed($stmt);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        return true;
    } else {
        return false;
    }
}

function createUser($conn, $fName, $lName, $email, $pwd, $phoneNum, $streetAddress, $city, $province, $zipCode)
{

    $sql = "INSERT INTO users (first_name, last_name, email, password, phone_number, address, city, postal_code, province) 
            VALUES (:fName, :lName, :email, :pwd, :phoneNum, :streetAddress, :city, :zipCode, :province);";

    $stmt = $conn->prepare($sql);
    stmtFailed($stmt);

    // password hash 
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);


    $stmt->bindParam(':fName', $fName);
    $stmt->bindParam(':lName', $lName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pwd', $hashedPwd);
    $stmt->bindParam(':phoneNum', $phoneNum);
    $stmt->bindParam(':streetAddress', $streetAddress);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':zipCode', $zipCode);
    $stmt->bindParam(':province', $province);


    if ($stmt->execute()) {
        header('Location:../../../../zulo/');
    }

    exit();
}

function loginUser($conn, $email, $pwd)
{
    $sql = "SELECT * FROM users WHERE email = :email";

    $stmt = $conn->prepare($sql);
    stmtFailed($stmt);

    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $pwdHashed = $row['password'];

        // Verify the password
        if (password_verify($pwd, $pwdHashed)) {
            if ($row["account_status"] == 0) {
                header("Location:../../../../zulo/pages/suspend.php");
                exit();
            }

            session_start();
            $_SESSION["email"] = $row["email"];
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["firstName"] = $row["first_name"];


            header("Location:../../../../zulo/index.php");
        } else {
            header("Location:../../../../zulo/pages/login.php?error=password");
            exit();
        }
    } else {
        header("Location:../../../../zulo/pages/login.php?error=invalidInput");
    }
}
