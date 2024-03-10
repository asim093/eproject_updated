<?php
// Start session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result of Appointment</title>
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
        <h1>Result</h1>
        <table class="table">
            <tbody>
                <tr>
                    <th>Product Id</th>
                    <td><?php echo isset($_SESSION['product_id']) ? $_SESSION['product_id'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Test Date</th>
                    <td><?php echo isset($_SESSION['test_date']) ? $_SESSION['test_date'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Test Result</th>
                    <td><?php echo isset($_SESSION['test_result']) ? $_SESSION['test_result'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Defects Found</th>
                    <td><?php echo isset($_SESSION['defects_found']) ? $_SESSION['defects_found'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Suggestions</th>
                    <td><?php echo isset($_SESSION['suggestions']) ? $_SESSION['suggestions'] : ''; ?></td>
                </tr>
            </tbody>
        </table>        
        <form action="" method="Get">
            <button onclick="window.print();" type="submit" class="btn btn-primary btn-save">Save Changes</button>
        </form>
    </div>
</body>

</html>
