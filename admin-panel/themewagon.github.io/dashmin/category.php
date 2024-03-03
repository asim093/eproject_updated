<?php
include "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryName = $_POST["categoryName"];
    $categoryID = $_POST["categoryid"];

    $sql = "INSERT INTO category (category_id , name) VALUES ('" . $categoryID . "','" . $categoryName . "')";
    $result = mysqli_query($conn, $sql);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Document</title>
    <style>
        .form-group {
            margin: 1rem 0rem !important;
        }

        .container {
            margin-top: 5rem !important;
        }

        .form-container {
            border: 1px solid gray;
            padding: 2rem;
            border-radius: 10px;
        }
    </style>
</head>

<body>
<?php include "navbar.php" ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-6 mx-auto my-5">
                <div class="form-container">
                    <h2>Add Product Category</h2>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" id="categoryName" name="categoryName" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category id</label>
                            <input type="text" id="category_id" name="categoryid" class="form-control" required>
                        </div>

                       
                       
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include "sidebar.php" ?>
<?php include "footer.php" ?>
    <!-- JavaScript Libraries -->
    <script src="../../code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="../../cdn.jsdelivr.net/npm/bootstrap%405.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>