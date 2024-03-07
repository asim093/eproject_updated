<!-- dropdown show  -->
<?php
include "config.php";

$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);

$categories = array();
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
}
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $productName = $_POST["productName"];
        $productID = $_POST["productid"];
        $producttype = $_POST["producttype"];

        $sql = "INSERT INTO product (product_id , product_name , product_type) VALUES ('$productID', '$productName' , '$producttype')";
        $result = mysqli_query($conn, $sql);

        
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/style.css" rel="stylesheet">
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

<body>

    <?php include "navbar.php" ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-6 mx-auto my-5">
                <div class="form-container charts add_product">
                    <h2>Add Product </h2>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" id="productName" name="productName" class="form-control" required>

                        </div>

                        <div class="form-group">
                            <label for="product_id">Product id</label>
                            <input type="text" id="product_id" name="productid" class="form-control" required>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                                name="producttype" autocomplete="off">
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['name']; ?>">
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="floatingSelect">Category</label>
                        </div>

                        <button type="submit" name="submit" class="btn table_btn_del">Add Category</button>
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