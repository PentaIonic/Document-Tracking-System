<?php
session_start();
include '../../components/database/connection.php';

if (isset($_POST['signup'])) {
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $suffixName = $_POST['suffixName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $accountCode = generateUserCode('User');

    // Check password match
    if ($password != $confirmPassword) {
        $_SESSION['signup_error'] = 'Password mismatched!';
        header("Location: ../../../../portal/signup.php");
        exit();
    }

    // Hash password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $checkEmail = $conn->query("SELECT email FROM accounts WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['signup_error'] = 'Email is already used!';
        header("Location: ../../../../portal/signup.php");
        exit();
    }

    // Register user
    $conn->query("INSERT INTO `accounts` (`user_id`, `account_code`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `email`, `role`, `password`, `account_created`) 
                  VALUES (NULL, '$accountCode', '$firstName', '$middleName', '$lastName', '$suffixName', '$email', 'User', '$password', current_timestamp())");

    $conn->close();
    $_SESSION['success_register'] = 'Account registered successfully!';
    header("Location: ../../../../portal/login.php");
    exit();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM accounts WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_name'] = $user['first_name'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_code'] = $user['account_code'];

            // Redirect based on role
            if ($user['role'] === 'User') {
                header("Location: ../../../../user/index.php");
            } else if ($user['role'] === 'Super Admin') {
                header("Location: ../../../../admin/index.php");
            } else {
                header("Location: ../../../portal/admin_dashboard.php");
            }
            exit();
        }
    }

    $_SESSION['login_error'] = 'Incorrect email or password!';
    header("Location: ../../../../portal/login.php");
    exit();
}

function generateUserCode($user)
{
    $year = date("Y");
    $month = date("m");
    $day = date("d");

    $userCode = match ($user) {
        "Super Admin" => "SA",
        default => "USR"
    };

    $endCode = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
    return "{$userCode}-{$year}{$month}{$day}-{$endCode}";
}
?>