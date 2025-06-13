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
    $conn->query("INSERT INTO `accounts` (`user_id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `email`, `role`, `password`, `account_created`) 
                  VALUES (NULL, '$firstName', '$middleName', '$lastName', '$suffixName', '$email', 'User', '$password', current_timestamp())");

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
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];

            // Redirect based on role
            if ($user['role'] === 'User') {
                header("Location: ../../../../home.html");
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
?>