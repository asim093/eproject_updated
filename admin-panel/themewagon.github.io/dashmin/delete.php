<?php
include "config.php";

if(isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    $sql = "DELETE FROM registered_users WHERE id = '$id'";
    
    if(mysqli_query($conn, $sql)) {
        echo "<script>
            alert('User deleted successfully');
            window.location.href= 'http://localhost:80/eproject/admin-panel/themewagon.github.io/dashmin/table.php';
        </script>";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    
    header("Location: http://localhost:80/eproject/admin-panel/themewagon.github.io/dashmin/table.php");
    exit();
}
?>
