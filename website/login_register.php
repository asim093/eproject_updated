<?php
include "config.php";

session_start();

if (isset($_POST['register'])) {
    // Check if user already exists
    $user_exist_query = "SELECT * FROM `registered_users` WHERE `username` = ? OR `email` = ?";
    $stmt = mysqli_prepare($conn, $user_exist_query);
    mysqli_stmt_bind_param($stmt, "ss", $_POST['username'], $_POST['email']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $result_fetch = mysqli_fetch_assoc($result);
        if ($result_fetch['username'] == $_POST['username']) {
            echo "<script>alert('$result_fetch[username] - username already taken');</script>";
        } else {
            echo "<script>alert('$result_fetch[email] - Email already taken');</script>";
        }
    } else {
        // Insert new user
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO `registered_users`(`full_name`, `username`, `email`, `password`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $_POST['fullname'], $_POST['username'], $_POST['email'], $password);
        
        if(mysqli_stmt_execute($stmt)){
            echo "<script>alert('registration successful');</script>";
            echo "<script>window.location.href='http://localhost/eproject/website/index.php';</script>";
        } else {
            echo "<script>alert('registration failed');</script>";
            echo "<script>window.location.href='http://localhost/eproject/website/index.php';</script>";
        }
    }
}

// for login




if (isset($_POST['login'])) {
    $query = "SELECT * FROM `registered_users` WHERE `email` = ? OR `username` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $_POST['email_username'], $_POST['email_username']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $result_fetch = mysqli_fetch_assoc($result);
        if (password_verify($_POST['password'], $result_fetch['password'])) {
            // Set session variables
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $result_fetch['username'];
            $_SESSION['email'] = $result_fetch['email'];

          
            echo "<script>alert('Welcome, " . $_SESSION['username'] . "');</script>";

          
            echo "<script>window.location.href='http://localhost/eproject/website/index.php';</script>";
            exit(); 
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect password');</script>";
            echo "<script>window.location.href='http://localhost/eproject/website/index.php';</script>";
            exit();
        }
    } else {
        // User not found
        echo "<script>alert('Incorrect User Name or Password ');</script>";
        echo "<script>window.location.href='http://localhost/eproject/website/index.php';</script>";
        exit();
    }
}
?>