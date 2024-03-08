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
    <link rel="stylesheet" href="./css/style.css">
    <title>Edit User</title>
    <style>
     body{
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: sans-serif;
     }
     form{
        background-color: var(--light);
        text-align: center;
        padding: 20px;
        border-radius: 10px;
        width: 500px;
     }
     form h1{
        color: var(--primary);
        font-size: 35px;
     }
     form label{
        color: var(--secondary);
        font-size: 20px;
        
     }
     form input{
        padding: 10px 10px;
        width: 250px;
        border-radius: 5px;
        outline: none;
        border: 1px solid var(--secondary);
        color: var(--secondary);
        margin: 20px 0;
        font-size: 18px;
     }
     button{
        padding: 10px 20px;
        background-color: var(--primary);
        color: var(--light);
        border: none;
        border-radius: 4px;
        transition: .3s ease-in-out;
        cursor: pointer;
     }
     button:hover{
        background-color: var(--secondary);
        transition: .3s ease-in-out;
     }
    </style>
</head>
<body>
    <!-- Display the form to edit user information -->
    <form action="" method="post" class="charts">
        <h1>Edit User</h1>
        <label for="">User Name</label> <br>
        <input type="text" name="name" value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>"> <br>
        <label for="">User Email</label> <br>
        <input type="email" name="email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>"> <br>
        <button type="submit"  name="submit">Submit</button>
    </form>
</body>
</html>
