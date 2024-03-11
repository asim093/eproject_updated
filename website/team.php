<?php
include "config.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SRS ELECTRICAL</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

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
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                    <small class="py-2"><i class="far fa-clock text-primary me-2"></i>Opening Hours: Mon - Tues : 6.00 am - 10.00 pm, Sunday Closed </small>
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
        <a href="http://localhost/eproject/website/index.php" class="nav-item nav-link">Home</a>
        <a href="http://localhost/eproject/website/about.php" class="nav-item nav-link">About</a>
        <a href="http://localhost/eproject/website/service.php" class="nav-item nav-link">Service</a>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Pages</a>
          <div class="dropdown-menu m-0">
            <a href="http://localhost/eproject/website/team.php" class="dropdown-item active">Our Team</a>
            <a href="appointment.php" class="dropdown-item">Appointment</a>
          </div>
        </div>
        <a href="http://localhost/eproject/website/contact.php" class="nav-item nav-link">Contact</a>
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


      <a href="appointment.php"
        class="btn btn-primary py-2 px-4 ms-3">Appointment</a>
    </div>
    </div>
  </nav>
  <!-- Navbar End -->


  <!-- login register form  -->

  <div class="popup-container" id="login-popup">
    <div class="popup">
      <form method="POST" action="login_register.php">
        <h2>
          <span>USER LOGIN</span>
          <button type="reset" onclick="popup('login-popup')">X</button>
        </h2>
        <input type="text" placeholder="E-mail or Username" name="email_username">
        <input type="password" placeholder="Password" name="password">
        <button type="submit" class="login-btn" name="login">LOGIN</button>
      </form>
    </div>
  </div>

  <div class="popup-container" id="register-popup">
    <div class="register popup">
      <form method="POST" action="login_register.php">
        <h2>
          <span>USER REGISTER</span>
          <button type="reset" onclick="popup('register-popup')">X</button>
        </h2>
        <input type="text" placeholder="Full Name" name="fullname">
        <input type="text" placeholder="Username" name="username">
        <input type="email" placeholder="E-mail" name="email">
        <input type="password" placeholder="Password" name="password">
        <button type="submit" class="register-btn" name="register">REGISTER</button>
      </form>
    </div>
  </div>
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
                <h1 class="display-3 text-white animated zoomIn">Testers</h1>
                <a href="" class="h4 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="" class="h4 text-white">Tester</a>
            </div>
        </div>
    </div>
    <!-- Hero End -->
  <!-- Team Start -->
  <div class="container-fluid py-5">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
          <div class="section-title bg-light rounded h-100 p-5">
            <h5
              class="position-relative d-inline-block text-primary text-uppercase"
            >
              Our Tester
            </h5>
            <h1 class="display-6 mb-4">
              Meet Our Certified & Experienced Tester
            </h1>
            <a href="appointment.html" class="btn btn-primary py-3 px-5"
              >Appointment</a
            >
          </div>
        </div>
        <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
          <div class="team-item">
            <div class="position-relative rounded-top" style="z-index: 1">
              <img
                class="img-fluid rounded-top w-100"
                src="./eproject-images/expert1.webp"
                alt=""
              />
              <div
                class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex"
              >
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-twitter fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-facebook-f fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-linkedin-in fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-instagram fw-normal"></i
                ></a>
              </div>
            </div>
            <div
              class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5"
            >
              <h4 class="mb-2"> John Doe</h4>
              <p class="text-primary mb-0">VoltMaster</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
          <div class="team-item">
            <div class="position-relative rounded-top" style="z-index: 1">
              <img
                class="img-fluid rounded-top w-100"
                src="./eproject-images/expert2.jpg"
                alt=""
              />
              <div
                class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex"
              >
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-twitter fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-facebook-f fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-linkedin-in fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-instagram fw-normal"></i
                ></a>
              </div>
            </div>
            <div
              class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5"
            >
              <h4 class="mb-2">Elizabeth Sandra</h4>
              <p class="text-primary mb-0">ConductaCheck</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
          <div class="team-item">
            <div class="position-relative rounded-top" style="z-index: 1">
              <img
                class="img-fluid rounded-top w-100"
                src="./eproject-images/expert3.jpg"
                alt=""
              />
              <div
                class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex"
              >
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-twitter fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-facebook-f fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-linkedin-in fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-instagram fw-normal"></i
                ></a>
              </div>
            </div>
            <div
              class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5"
            >
              <h4 class="mb-2">William Henry</h4>
              <p class="text-primary mb-0">ResistProbe</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
          <div class="team-item">
            <div class="position-relative rounded-top" style="z-index: 1">
              <img
                class="img-fluid rounded-top w-100"
                src="./eproject-images/expert4.jpg"
                alt=""
              />
              <div
                class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex"
              >
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-twitter fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-facebook-f fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-linkedin-in fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-instagram fw-normal"></i
                ></a>
              </div>
            </div>
            <div
              class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5"
            >
              <h4 class="mb-2">James Liam</h4>
              <p class="text-primary mb-0">InsulaGuard</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
          <div class="team-item">
            <div class="position-relative rounded-top" style="z-index: 1">
              <img
                class="img-fluid rounded-top w-100"
                src="./eproject-images/expert5.jpg"
                alt=""
              />
              <div
                class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex"
              >
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-twitter fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-facebook-f fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-linkedin-in fw-normal"></i
                ></a>
                <a class="btn btn-primary btn-square m-1" href="#"
                  ><i class="fab fa-instagram fw-normal"></i
                ></a>
              </div>
            </div>
            <div
              class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5"
            >
              <h4 class="mb-2">Carol Emily</h4>
              <p class="text-primary mb-0">GroundDetect Pro</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Team End -->
    

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
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                        <a class="text-light" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Popular Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                        <a class="text-light" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Get In Touch</h3>
                    <p class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="bi bi-envelope-open text-primary me-2"></i>info@example.com</p>
                    <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i>+012 345 67890</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Follow Us</h3>
                    <div class="d-flex">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-light py-4" style="background: #051225;">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-white border-bottom" href="#">Your Site Name</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a class="text-white border-bottom" href="https://htmlcodex.com">HTML Codex</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="lib/twentytwenty/jquery.event.move.js"></script>
    <script src="lib/twentytwenty/jquery.twentytwenty.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
    function popup(popup_name) {
      get_popup = document.getElementById(popup_name);
      if (get_popup.style.display == "flex") {
        get_popup.style.display = "none";
      }
      else {
        get_popup.style.display = "flex";
      }
    }
  </script>
</body>

</html>