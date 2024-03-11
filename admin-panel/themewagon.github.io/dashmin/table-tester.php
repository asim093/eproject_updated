<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tester_name = $_POST['tester_name'];
    
    $appointment_id = $_GET['id'];
    
    $insert_query = "UPDATE appointment SET tester_name = ? WHERE id = ?";
    
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("si", $tester_name, $appointment_id);
    
    // Execute the insert statement
    if ($stmt->execute()) {
        header("Location: appointments.php");
        exit();
    } else {
        echo "Error inserting record: " . $conn->error;
    }
}

$testers_query = "SELECT * FROM tester"; 
$testers_result = $conn->query($testers_query);
$testers = [];
if ($testers_result->num_rows > 0) {
    while ($row = $testers_result->fetch_assoc()) {
        $testers[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Tester</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            font-weight: bold;
            margin-bottom: 10px;
        }
        select {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            box-sizing: border-box;
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M7 10l5 5 5-5z" /></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
        }
        select:focus {
            outline: none;
            border-color: #007bff;
        }
        button {
            padding: 12px 24px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Assign Tester</h2>
        <form method="post">
            <label for="tester">Select Tester:</label>
            <div class="custom-select">
                <select name="tester_name" id="tester">
                    <?php foreach ($testers as $tester): ?>
                        <option value="<?php echo $tester['tester_name']; ?>"><?php echo $tester['tester_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Assign Tester</button>
        </form>
    </div>
</body>
</html>

