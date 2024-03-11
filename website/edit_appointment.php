<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tester Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: var(--dark);
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

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 24px;
            color: var(--secondary);
            margin-bottom: 20px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #dee2e6;
            padding: 8px;
        }

        .data-table th {
            background-color: var(--secondary);
            color: white;
        }

        .success-message {
            color: green;
            text-align: center;
        }

        .failure-message {
            color: red;
            text-align: center;
        }

        button {
            margin: 1rem;
            border-radius: 0.5rem;
            background-color: black;
            color: white;
            transition: 0.3s ease;
            padding: 0.5rem 1rem;
        }

        button:hover {
            background-color: white;
            color: black;

        }
    </style>
</head>

<body>
    <div class="container charts">
        <h1>Tester Report</h1>
        <?php
        include "config.php";

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $appointment_id = mysqli_real_escape_string($conn, $_GET['id']);

            $appointment_query = "SELECT * FROM appointment WHERE id = '$appointment_id'";
            $appointment_result = mysqli_query($conn, $appointment_query);

            if (mysqli_num_rows($appointment_result) == 1) {
                $appointment = mysqli_fetch_assoc($appointment_result);

                // Fetch tester result
                $tester_query = "SELECT * FROM results WHERE product_id = '$appointment_id'";
                $tester_result = mysqli_query($conn, $tester_query);
                ?>
                <div class="section">
                    <h2 class="section-title">Appointment Details</h2>
                    <table class="data-table">
                        <tr>
                            <th>Appointment ID</th>
                            <td>
                                <?php echo $appointment['id']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Service Category</th>
                            <td>
                                <?php echo $appointment['service_category']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Product Name</th>
                            <td>
                                <?php echo $appointment['product_name']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>User Name</th>
                            <td>
                                <?php echo $appointment['user_name']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>User Email</th>
                            <td>
                                <?php echo $appointment['user_email']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Appointment Date</th>
                            <td>
                                <?php echo $appointment['appointment_date']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Appointment Time</th>
                            <td>
                                <?php echo $appointment['appointment_time']; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="section">
                    <h2 class="section-title">Tester Result</h2>
                    <?php if (mysqli_num_rows($tester_result) > 0) { ?>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Tester Name</th>
                                    <th>Test Date</th>
                                    <th>Test Result</th>
                                    <th>Defects Found</th>
                                    <th>Suggestions</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($tester_result)) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['product_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $appointment['tester_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['test_date']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['test_result']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['defects_found']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['suggestions']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['created_at']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <p class="para"></p>

                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p class="failure-message">No tester result found.</p>
                    <?php } ?>
                </div>

                <?php
                // Reset the internal pointer of $tester_result
                mysqli_data_seek($tester_result, 0);

                if (mysqli_num_rows($tester_result) > 0) {
                    $test_result = mysqli_fetch_assoc($tester_result)['test_result'];
                    if ($test_result == 'Pass') {
                        echo '<p class="success-message">The product testing is complete and it has passed all tests. It will be sent for further testing procedures held by the CPRI and get it approved for release into the market.</p>';
                    } elseif ($test_result == 'Fail') {
                        echo '<p class="failure-message">The product testing has failed. It will be sent for re-making.</p>';
                    }
                } else {
                    echo '<p class="failure-message">No tester result found.</p>';
                }
            } else {
                echo '<p>Appointment not found.</p>';
            }
        } else {
            echo '<p>No appointment ID specified.</p>';
        }
        ?>
        <button onclick="window.print();">Download PDF</button>

    </div>
</body>

<script>
    var paragraph = document.querySelector(".para");
    var result = '<?php echo $test_result; ?>';
    console.log("Test result:", result);
    if (result.trim().toLowerCase() === "pass") {
        paragraph.innerText = "The product testing is complete and it has passed all tests. It will be sent for further testing procedures held by the CPRI and get it approved for release into the market.";
    } else if (result.trim().toLowerCase() === "fail") {
        paragraph.innerText = "The product testing has failed. It will be sent for re-making.";
    } else {
        paragraph.innerText = "Unknown test result: " + result;
    }
</script>


</html>