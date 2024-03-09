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
            $_SESSION['user'] = $row['userrole'];
            // echo $_SESSION['user'] ;
            echo "<script>window.location.href = 'http://localhost/eproject/admin-panel/themewagon.github.io/dashmin/index-2.php';</script>";
            // exit();
        } elseif($row['userrole'] == '2'){
            $_SESSION['user'] = $row['userrole'];
            echo "<script>window.location.href = 'http://localhost/eproject/admin-panel/themewagon.github.io/dashmin/tester-dashboard.php';</script>";
            exit();
        } else {
            echo "<script>window.location.href = 'http://localhost/eproject/admin-panel/themewagon.github.io/dashmin/signin.php';</script>";
            exit();
        }
    } else {
        echo "Login failed";
        echo "<script>window.location.href = 'http://localhost/eproject/admin-panel/themewagon.github.io/dashmin/signin.php';</script>";
        exit(); 
    }
}
?>
