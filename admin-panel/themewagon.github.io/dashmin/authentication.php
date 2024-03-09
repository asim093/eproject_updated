<?php

if(!isset($_SESSION['user'])){
    header('Location: signin.php');
    exit;
}
?>
