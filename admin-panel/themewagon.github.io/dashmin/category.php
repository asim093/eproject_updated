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
               /* add product page */
.form-group {
    margin: 1rem 0rem !important;
}

.container {
    margin-top: 5rem !important;
}

.form-container {
    border: 1px solid var(--primary);
    padding: 2rem;
    border-radius: 10px;
    background-color: var(--light) !important;
}

.add_product h2{
    color: var(--primary) !important;
}
.add_product input{
    border : 1px solid var(--secondary);
}
.add_product label{
    color : var(--secondary);
}
.add_product .form-select{
    border : 1px solid var(--secondary);
}
.add_product .table_btn_del{
    background-color: var(--secondary);
    padding: 3px 10px;
    transition: .3s ease-in-out;
    color : var(--light);
}
.add_product .table_btn_del:hover{
    background-color: var(--primary);
    padding: 3px 10px;
    transition: .3s ease-in-out;
    color : var(--light);
}
/* add product page */
    </style>
</head>

<body class="back_dark">
      <!-- Spinner Start -->
      <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index-2.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>SRS Admin</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="admin_content ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index-2.php" class="nav-item nav-link"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
             
                    <a href="table.php" class="nav-item nav-link "><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="category.php" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>Add Category</a>
                    <a href="addproduct.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Add product</a>
                    <a href="tester.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Add Tester</a>
                    <a href="appointments.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Appointments</a>
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div> -->
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


<?php include "navbar.php" ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-6 mx-auto my-5">
                <div class="form-container add_product charts">
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

                       
                       
                        <button type="submit" class="btn btn-md table_btn_del">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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