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

        label {
            color: var(--primary);
        }

        input {
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

        .charts {
            box-shadow: 0px 1px 18px 0px rgba(62, 25, 129, 0.82) inset;
            -webkit-box-shadow: 0px 1px 18px 0px rgba(62, 25, 129, 0.82) inset;
            -moz-box-shadow: 0px 1px 18px 0px rgba(62, 25, 129, 0.82) inset;
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
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Service Category</th>
                            <td><?php echo $appointment['service_category']; ?></td>
                        </tr>
                        <tr>
                            <th>Product Name</th>
                            <td><?php echo $appointment['product_name']; ?></td>
                        </tr>
                        <tr>
                            <th>User Name</th>
                            <td><?php echo $appointment['user_name']; ?></td>
                        </tr>
                        <tr>
                            <th>User Email</th>
                            <td><?php echo $appointment['user_email']; ?></td>
                        </tr>
                        <tr>
                            <th>Appointment Date</th>
                            <td><?php echo $appointment['appointment_date']; ?></td>
                        </tr>
                        <tr>
                            <th>Appointment Time</th>
                            <td><?php echo $appointment['appointment_time']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <form action="update_appointment.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $appointment_id; ?>">
                    <button onclick="window.print();" type="submit" class="btn btn-primary btn-save">Save Changes</button>
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
