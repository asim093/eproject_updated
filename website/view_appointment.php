<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointment</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #343a40;
            margin-bottom: 30px;
            text-align: center;
        }

        .appointment-card {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .btn-edit {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>View Appointment</h1>
        <?php
        include "config.php";

        // Check if an appointment ID is provided
        if (isset($_GET['id'])) {
            $appointment_id = $_GET['id'];

            // Retrieve the appointment from the database
            $appointment_query = "SELECT * FROM appointment WHERE id = $appointment_id";
            $appointment_result = mysqli_query($conn, $appointment_query);

            if (mysqli_num_rows($appointment_result) > 0) {
                $appointment = mysqli_fetch_assoc($appointment_result);
        ?>
                <div class="appointment-card">
                    <div class="card-header">
                        Appointment ID: <?php echo $appointment['id']; ?>
                    </div>
                    <div class="card-body">
                        <p><strong>Service Category:</strong> <?php echo $appointment['service_category']; ?></p>
                        <p><strong>Product Name:</strong> <?php echo $appointment['product_name']; ?></p>
                        <p><strong>User Name:</strong> <?php echo $appointment['user_name']; ?></p>
                        <p><strong>User Email:</strong> <?php echo $appointment['user_email']; ?></p>
                        <p><strong>Appointment Date:</strong> <?php echo $appointment['appointment_date']; ?></p>
                        <p><strong>Appointment Time:</strong> <?php echo $appointment['appointment_time']; ?></p>
                        <a href="edit_appointment.php?id=<?php echo $appointment['id']; ?>" class="btn btn-primary btn-edit">Edit</a>
                    </div>
                </div>
        <?php
            } else {
                echo "<p>No appointment found with the provided ID.</p>";
            }
        } else {
            echo "<p>No appointment ID provided.</p>";
        }
        ?>
    </div>
</body>

</html>