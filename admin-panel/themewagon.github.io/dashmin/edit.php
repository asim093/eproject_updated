<?php
include "config.php";

if(isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $sql = "SELECT * FROM registered_users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
}

if(isset($_POST["submit"])) {
    $newUsername = $_POST["name"];
    $newEmail = $_POST["email"];
    
    $sql = "UPDATE registered_users SET username='$newUsername', email='$newEmail' WHERE id='$id'";
    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Edit Done'); window.location.href='http://localhost/eproject/admin-panel/themewagon.github.io/dashmin/table.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <!-- Display the form to edit user information -->
    <form action="" method="post">
        <input type="text" name="name" value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>">
        <input type="email" name="email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>">
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
