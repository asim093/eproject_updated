<?php
session_start(); 

include "config.php";

if(isset($_POST['signin'])){
    $user = $_POST['email']; 
    $pass = $_POST['password']; 

    $sql = "SELECT * FROM user WHERE email = '$user' AND password = '$pass'";
    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die(mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($query); 

    if($row){
        if($row['userrole'] == '1'){
            $_SESSION['user'] = $user;
            header('Location: http://localhost/eproject/admin-panel/themewagon.github.io/dashmin/index-2.php'); 
            exit();
        } elseif($row['userrole'] == '2'){
            $_SESSION['user'] = $user;
            header('Location: http://localhost/eproject/admin-panel/themewagon.github.io/dashmin/tester-dashboard.php'); 
            exit();
        } else {
            header('Location: http://localhost:80/eproject/admin-panel/themewagon.github.io/dashmin/signin.php');
            exit();
        }
    } else {
        echo "Login failed";
        header('Location: http://localhost/eproject/admin-panel/themewagon.github.io/dashmin/signin.php'); // Corrected the location URL and capitalized 'Location'
        exit(); 
    }
}
?>
