<?php
session_start();

include "config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_id = $_POST['product_id'];
    $tester_name = $_POST['tester_name'];
    $test_date = $_POST['test_date'];
    $test_result = $_POST['test_result'];
    $defects_found = $_POST['defects_found'];
    $suggestions = $_POST['suggestions'];

    // Insert data into the results table
    $insert_query = "INSERT INTO results (product_id, tester_name, test_date, test_result, defects_found, suggestions) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("isssss", $product_id, $tester_name, $test_date, $test_result, $defects_found, $suggestions);

    // Execute the insert statement
    if ($stmt->execute()) {
        // Show an alert upon successful submission
        echo "<script>alert('Test result submitted successfully.');</script>";
        // Redirect to the same page after successful insertion
        echo "<script>window.location = window.location.href;</script>";  
        exit();
    } else {
        // Show an alert if insertion fails
        echo "<script>alert('Failed to submit test result.');</script>";
    }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Test Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
            max-width: 100%;
        }

        h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            resize: vertical;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if(isset($_SESSION['id'])): ?>
        <h2>Product ID: <?php echo $_POST['row']; ?></h2>
        <?php endif; ?>
        <h2>Submit Test Result</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <label for="product_id">Product ID:</label>
                <input type="text" name="product_id" id="product_id" required>
            </div>
            <div>
                <label for="tester_name">Tester Name:</label>
                <input type="text" name="tester_name" id="tester_name" required>
            </div>
            <div>
                <label for="test_date">Test Date:</label>
                <input type="date" name="test_date" id="test_date" required>
            </div>
            <div>
                <label for="test_result">Test Result:</label>
                <textarea name="test_result" id="test_result" rows="4" required></textarea>
            </div>
            <div>
                <label for="defects_found">Defects Found:</label>
                <textarea name="defects_found" id="defects_found" rows="4"></textarea>
            </div>
            <div>
                <label for="suggestions">Suggestions:</label>
                <textarea name="suggestions" id="suggestions" rows="4"></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>