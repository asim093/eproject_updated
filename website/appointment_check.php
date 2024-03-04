<?php

include "config.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Display alert using JavaScript
    echo "<script>alert('Please log in first')</script>";

    // Delay the redirection using JavaScript
    echo "<script>setTimeout(function() {
        window.location.href = 'http://localhost/eproject/website/index.php';
    }, 1000);</script>";
    exit();
}
?>
