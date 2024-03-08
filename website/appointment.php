<?php
session_start();
include "config.php";
// include "appointment_check.php"; 

ini_set('display_errors', 1); // Enable error display
error_reporting(E_ALL); // Report all PHP errors

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are filled
    if (empty($_POST['service_category']) || empty($_POST['product_name']) || empty($_POST['user_name']) || empty($_POST['user_email']) || empty($_POST['appointment_date']) || empty($_POST['appointment_time'])) {
        echo "<script>alert('Please fill in all fields')</script>";
    } else {
        // Check if the user has already booked the maximum number of appointments
        $max_appointments = 6;
        $user_email = $_SESSION['email'] ?? '';
        if (!empty($user_email)) {
            $count_query = "SELECT COUNT(*) AS appointment_count FROM appointment WHERE user_email = ?";
            if ($stmt = $conn->prepare($count_query)) {
                $stmt->bind_param("s", $user_email);
                $stmt->execute();
                $count_result = $stmt->get_result();
                $count_row = $count_result->fetch_assoc();
                $appointment_count = $count_row['appointment_count'] ?? 0;
                $stmt->close();

                if ($appointment_count >= $max_appointments) {
                    echo "<script>alert('You have already booked the maximum number of appointments.')</script>";
                } else {
                    // Proceed with inserting the appointment into the database
                    $service_category = $_POST['service_category'];
                    $product_name = $_POST['product_name'];
                    $user_name = $_POST['user_name'];
                    $user_email = $_POST['user_email'];
                    $appointment_date = $_POST['appointment_date'];
                    $appointment_time = $_POST['appointment_time'];

                    $insert_query = "INSERT INTO appointment (service_category, product_name, user_name, user_email, appointment_date, appointment_time) VALUES (?, ?, ?, ?, ?, ?)";
                    if ($stmt = $conn->prepare($insert_query)) {
                        $stmt->bind_param("ssssss", $service_category, $product_name, $user_name, $user_email, $appointment_date, $appointment_time);
                        if ($stmt->execute()) {
                            $appointment_id = $stmt->insert_id;
                            $appointment_code = str_pad($appointment_id, 10, '0', STR_PAD_LEFT);
                            mysqli_query($conn, "UPDATE appointment SET id='$appointment_code' WHERE id='$appointment_id'");
                            echo "<script>alert('Your appointment has been booked successfully. Your appointment code is: $appointment_code')</script>";
                        } else {
                            echo "<script>alert('Error: Unable to book appointment.')</script>";
                        }
                        $stmt->close();
                    } else {
                        echo "<script>alert('Error: Unable to prepare statement for appointment insertion.')</script>";
                    }
                }
            } else {
                echo "<script>alert('Error: Unable to prepare statement for appointment count.')</script>";
            }
        } else {
            echo "<script>alert('Error: Unable to retrieve user email.')</script>";
        }
    }
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>alert('Please log in first')</script>";
    echo "<script>setTimeout(function() {
        window.location.href = 'http://localhost:80/eproject/website/index.php';
    }, 1000);</script>";
    exit();
}

// Retrieve categories from the database
$category_query = "SELECT name FROM category";
$category_result = mysqli_query($conn, $category_query);
$categories = mysqli_fetch_all($category_result, MYSQLI_ASSOC);

// Retrieve testers from the database
$tester_query = "SELECT tester_name FROM tester";
$tester_result = mysqli_query($conn, $tester_query);
$testers = mysqli_fetch_all($tester_result, MYSQLI_ASSOC);

$product_query = "SELECT product_name FROM product";
$product_result = mysqli_query($conn, $product_query);
$product_names = mysqli_fetch_all($product_result, MYSQLI_ASSOC);

?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>SRS ELCTRICAL</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Free HTML Templates" name="keywords">
  <meta content="Free HTML Templates" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap"
    rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
  <link href="lib/twentytwenty/twentytwenty.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <!-- Spinner Start -->
  <div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary m-1" role="status">
      <span class="sr-only">Loading...</span>
    </div>
    <div class="spinner-grow text-dark m-1" role="status">
      <span class="sr-only">Loading...</span>
    </div>
    <div class="spinner-grow text-secondary m-1" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <!-- Spinner End -->


  <!-- Topbar Start -->
  <div class="container-fluid bg-light ps-5 pe-0 d-none d-lg-block">
    <div class="row gx-0">
      <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
        <div class="d-inline-flex align-items-center">
          <small class="py-2"><i class="far fa-clock text-primary me-2"></i>Opening Hours: Mon -

 Tues : 6.00 am - 10.00
            pm, Sunday Closed </small>
        </div>
      </div>
      <div class="col-md-6 text-center text-lg-end">
        <div class="position-relative d-inline-flex align-items-center bg-primary text-white top-shape px-5">
          <div class="me-3 pe-3 border-end py-2">
            <p class="m-0"><i class="fa fa-envelope-open me-2"></i>info@example.com</p>
          </div>
          <div class="py-2">
            <p class="m-0"><i class="fa fa-phone-alt me-2"></i>+012 345 6789</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Topbar End -->


  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-lg-0">
    <a href="index.html" class="navbar-brand p-0">
      <h1>SRS</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-center bg-white nav_item" id="navbarCollapse">
      <div class="navbar-nav ms-auto">
        <a href="http://localhost:80/eproject/website/index.php" class="nav-item nav-link active">Home</a>
        <a href="http://localhost:80/eproject/website/about.php" class="nav-item nav-link">About</a>
        <a href="http://localhost:80/eproject/website/service.php" class="nav-item nav-link">Service</a>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
          <div class="dropdown-menu m-0">
            <a href="http://localhost:80/eproject/website/team.php" class="dropdown-item">Our Team</a>
            <a href="http://localhost:80/eproject/website/appointment.php" class="dropdown-item">Appointment</a>
          </div>
        </div>
        <a href="http://localhost:80/eproject/website/contact.php" class="nav-item nav-link">Contact</a>
      </div>

      <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Account</a>
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
          echo "<div class='dropdown-menu m-0'>";
          echo "<a href='user_logout.php' class='dropdown-item'>Logout</a>";
          echo "</div>";
        } else {
          echo "<div class='dropdown-menu m-0'>";
          echo "<a href='#' onclick=\"popup('login-popup')\" class='dropdown-item'>Login</a>";
          echo "<a href='#' onclick=\"popup('register-popup')\" class='dropdown-item'>Register</a>";
          echo "</div>";
        }
        ?>
      </div>
      <a href="appointment.php" class="btn btn-primary py-2 px-4 ms-3">Appointment</a>
    </div>
    </div>
  </nav>
  <!-- Navbar End -->


  <!-- Full Screen Search Start -->
  <div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
        <div class="modal-header border-0">
          <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex align-items-center justify-content-center">
          <div class="input-group" style="max-width: 600px;">
            <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
            <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Full Screen Search End -->


  <!-- Hero Start -->
  <div class="container-fluid bg-primary py-5 hero-header mb-5">
    <div class="row py-3">
      <div class="col-12 text-center">
        <h1 class="display-3 text-white animated zoomIn">Appointment</h1>
        <a href="" class="h4 text-white">Home</a>
        <i class="far fa-circle text-white px-2"></i>
        <a href="" class="h4 text-white">Appointment</a>
      </div>
    </div>
  </div>
  <!-- Hero End -->


  <!-- Appointment Start -->
  <div class="container-fluid shadow bg-primary bg-appointment my-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
      <div class="row gx-5">
        <div class="col-lg-6 py-5">
          <div class="py-5">
            <h1 class="display-5 text-white mb-4">
              Certified Excellence: Experience the Difference with Our Superior Tester
            </h1>
            <p class="text-white mb-0">
              Our team of electricians and technicians holds industry-recognized certifications, ensuring that we adhere
              to the highest levels of professionalism and expertise in every

 project we undertake. With extensive
              training and ongoing education, we stay at the forefront of advancements in the electrical field, allowing
              us to provide innovative solutions tailored to meet the unique needs of our clients.
            </p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="appointment-form h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn"
            data-wow-delay="0.6s">
            <h1 class="text-white mb-4">Make Appointment</h1>

            <form action="#" method="post">

              <div class="row g-3">
                <div class="col-md-6">
                  <select class="form-select mt-3" name="service_category" aria-label="Select Service"
                    style="height: 55px" required>
                    <option selected>Select Service</option>
                    <?php foreach ($categories as $category): ?>
                      <option value="<?php echo $category['name']; ?>">
                        <?php echo $category['name']; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <select class="form-select mt-3" name="product_name" aria-label="Select Product Name"
                    style="height: 55px" required>
                    <option selected>Select Product Name</option>
                    <?php foreach ($product_names as $product): ?>
                      <option value="<?php echo $product['product_name']; ?>">
                        <?php echo $product['product_name']; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="row g-3 mb-2">
                <div class="col-md-6">
                  <input type="text" class="form-control mt-3" name="user_name" placeholder="Your Name"
                    style="height: 55px"
                    value="<?php echo isset($_SESSION['logged_in']) && isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>"
                    required>
                </div>
                <div class="col-md-6">
                  <input type="email" class="form-control mt-3" name="user_email" placeholder="Your Email"
                    style="height: 55px"
                    value="<?php echo isset($_SESSION['logged_in']) && isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"
                    required>
                </div>
              </div>
              <div class="row g-3">
                <div class="col-12 col-sm-6 mt-4">
                  <div class="date" id="date1" data-target-input="nearest">
                    <input type="text" class="form-control bg-light border-0 datetimepicker-input"
                      name="appointment_date" placeholder="Appointment Date" data-target="#date1"
                      data-toggle="datetimepicker" style="height: 55px;" required />
                  </div>
                </div>

                <div class="col-12 col-sm-6 mt-4">
                  <div class="time" id="time1" data-target-input="nearest">
                    <input type="text" class="form-control bg-light border-0 datetimepicker-input"
                      name="appointment_time" placeholder="Appointment Time" data-target="#time1"
                      data-toggle="datetimepicker" style="height: 55px;" required />
                  </div>
                </div>
              </div>
              <div class="row g-3">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-dark w-100 py-3 mt-3">Make Appointment</button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Appointment End -->
  <!-- Appointment End -->


  <!-- Recent Appointments Start -->
<div class="container my-5">
    <h2 class="text-center mb-4">Recent Appointments</h2>
    <div class="row">
        <?php
        // Execute the query to fetch recent appointments
        $recent_appointments_query = "SELECT * FROM appointment ORDER BY appointment_date DESC LIMIT 5";
        $recent_appointments_result = mysqli_query($conn, $recent_appointments_query);

        // Check if there are any recent appointments
        if (mysqli_num_rows($recent_appointments_result) > 0) {
            // Loop through each recent appointment and display it
            while ($row = mysqli_fetch_assoc($recent_appointments_result)) {
        ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Appointment ID: <?php echo $row['id']; ?></h5>
                            <p class="card-text">Service Category: <?php echo $row['service_category']; ?></p>
                            <p class="card-text">Product Name: <?php echo $row['product_name']; ?></p>
                            <p class="card-text">User Name: <?php echo $row['user_name']; ?></p>
                            <p class="card-text">Appointment Date: <?php echo $row['appointment_date']; ?></p>
                            <p class="card-text">Appointment Time: <?php echo $row['appointment_time']; ?></p>
                            <!-- View and Edit buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                <a href="view_appointment.php?id=<?php echo $row['id']; ?>" class="btn btn-primary me-md-2">View</a>
                                <a href="edit_appointment.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='col-12'><p class='text-center'>No recent appointments found.</p></div>";
        }
        ?>
    </div>
</div>
<!-- Recent Appointments End -->



  <!-- Newsletter Start -->
  <div class="container-fluid position-relative pt-5 wow fadeInUp" data-wow-delay="0.1s" style="z-index: 1;">
    <div class="container">
      <div class="bg-primary p-5">
        <form class="mx-auto" style="max-width: 600px;">
          <div class="input-group">
            <input type="text" class="form-control border-white p-3" placeholder="Your Email">
            <button class="btn btn-dark px-4">Sign Up</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Newsletter End -->


  <!-- Footer Start -->
  <div class="container-fluid bg-dark text-light py-5 wow fadeInUp" data-wow-delay="0.3s" style="margin-top: -75px;">
    <div class="container pt-5">
      <div class="row g-5 pt-4">
        <div class="col-lg-3 col-md-6">
          <h3 class="text-white mb-4">Quick Links</h3>
          <div class="d-flex flex-column justify-content-start">
            <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
            <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right

 text-primary me-2"></i>About Us</a>
            <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Services</a>
            <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Blog</a>
            <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <h3 class="text-white mb-4">Contact Info</h3>
          <p class="mb-1"><i class="bi bi-geo-alt-fill text-primary me-2"></i>123 Street, New York, USA</p>
          <p class="mb-1"><i class="bi bi-envelope-fill text-primary me-2"></i>info@example.com</p>
          <p class="mb-1"><i class="bi bi-telephone-fill text-primary me-2"></i>+012 345 6789</p>
          <p class="mb-1"><i class="bi bi-clock-fill text-primary me-2"></i>Mon - Fri: 9:00 AM - 6:00 PM</p>
        </div>
        <div class="col-lg-3 col-md-6">
          <h3 class="text-white mb-4">Our Services</h3>
          <div class="d-flex flex-column justify-content-start">
            <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Electrical Repair</a>
            <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Lighting
              Installation</a>
            <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Wiring and Rewiring</a>
            <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Electrical Panel
              Upgrades</a>
            <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Commercial Electrical
              Services</a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <h3 class="text-white mb-4">Connect With Us</h3>
          <div class="d-flex flex-column justify-content-start">
            <a class="text-light mb-2" href="#"><i class="bi bi-facebook text-primary me-2"></i>Facebook</a>
            <a class="text-light mb-2" href="#"><i class="bi bi-twitter text-primary me-2"></i>Twitter</a>
            <a class="text-light mb-2" href="#"><i class="bi bi-instagram text-primary me-2"></i>Instagram</a>
            <a class="text-light mb-2" href="#"><i class="bi bi-linkedin text-primary me-2"></i>Linkedin</a>
            <a class="text-light mb-2" href="#"><i class="bi bi-youtube text-primary me-2"></i>Youtube</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer End -->


  <!-- Bottom Start -->
  <div class="container-fluid bg-primary py-4">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <p class="mb-0 text-light">&copy; 2023 Your Company. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Bottom End -->

  <!-- Go to Top Start -->
  <a href="#" class="btn btn-primary btn-lg back-to-top"><i class="bi bi-arrow-up"></i></a>
  <!-- Go to Top End -->

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/owl.carousel/2.3.4/owl.carousel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/en-au.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>
  
</body>

</html>