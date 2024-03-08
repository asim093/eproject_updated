<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: var(--dark);
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: var(--primary);
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }
        label{
            color: var(--primary);
        }
        input{
            border: 1px solid var(--secondary) !important;
            color: var(--secondary) !important;
        }
        .btn-save {
            margin-top: 20px;
            background-color: var(--secondary);
            transition: 0.3s ease-in-out;
        }
        .btn-save:hover {
            margin-top: 20px;
            background-color: var(--primary);
            transition: 0.3s ease-in-out;
        }
        .charts{
    box-shadow: 0px 1px 18px 0px rgba(62,25,129,0.82) inset;
    -webkit-box-shadow: 0px 1px 18px 0px rgba(62,25,129,0.82) inset;
    -moz-box-shadow: 0px 1px 18px 0px rgba(62,25,129,0.82) inset;   
}
    </style>
</head>

<body>
    <div class="container charts">
        <h1>Edit Appointment</h1>
        <?php
        include "config.php";

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $appointment_id = mysqli_real_escape_string($conn, $_GET['id']);

            $appointment_query = "SELECT * FROM appointment WHERE id = '$appointment_id'";
            $appointment_result = mysqli_query($conn, $appointment_query);

            if (mysqli_num_rows($appointment_result) == 1) {
                $appointment = mysqli_fetch_assoc($appointment_result);
        ?>
                <form action="update_appointment.php" method="post">
                    <div class="form-group">
                        <label for="service_category">Service Category</label>
                        <input type="text" class="form-control" id="service_category" name="service_category" value="<?php echo $appointment['service_category']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $appointment['product_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="user_name">User Name</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $appointment['user_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="user_email">User Email</label>
                        <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo $appointment['user_email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment_date">Appointment Date</label>
                        <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="<?php echo $appointment['appointment_date']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment_time">Appointment Time</label>
                        <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="<?php echo $appointment['appointment_time']; ?>" required>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $appointment_id; ?>">
                    <button type="submit" class="btn btn-primary btn-save">Save Changes</button>
                </form>
        <?php
            } else {
                echo "<p>Appointment not found.</p>";
            }
        } else {
            echo "<p>No appointment ID specified.</p>";
        }
        ?>
    </div>
</body>

</html>