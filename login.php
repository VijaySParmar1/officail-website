<?php
include "db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Database|Impetus Consulting Associates Pvt Ltd</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="index.php" class="navbar-brand p-0">
                    <img src="img/ICA_logo.png" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                
            </nav>

            <div class="container-xxl bg-primary page-header">
                <div class="container text-center">
                    <h1 class="text-white animated zoomIn mb-3">HR Login</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Login</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Contact Start -->
          <?php
                // Check if form is submitted
                if(isset($_POST['submit'])){
                    // Retrieve username and password from form
                    $username = $_POST['username'];
                    $password = $_POST['password'];
            
                    // Check if username and password fields are not empty
                    if(empty($username) || empty($password)){
                        $error = "Please enter your username and password.";
                    } else {
                        // Query to retrieve username and password from database
                        $query = "SELECT * FROM hrlogin WHERE username='$username' AND password='$password'";
                        $result = mysqli_query($connection, $query);
            
                        // Check if query returns any rows
                        if(mysqli_num_rows($result) == 1){
                            // Redirect to database.php
                            header("Location: database.php");
                            exit();
                        } else {
                            $error = "Incorrect username or password.";
                        }
                    }
                }
            ?>

                    <!-- Login form -->
                    <div class="container my-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8 col-sm-10">
                                <h2 class="text-center mb-4">Login</h2>
                                <?php if(isset($error)){ ?>
                                    <div class="alert alert-danger"><?php echo $error; ?></div>
                                <?php } ?>
                                <form method="post">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" required>
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="bi bi-eye"></i></button>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary w-100 mb-3">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        // Show/hide password
                        const togglePassword = document.getElementById('togglePassword');
                        const password = document.getElementById('password');
                        togglePassword.addEventListener('click', function() {
                            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                            password.setAttribute('type', type);
                            this.innerHTML = password.getAttribute('type') === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
                        });
                    </script>

        <!-- Contact End -->
        

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 6rem;">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Reg Address</h5>
                        <p><i class="fa fa-map-marker-alt me-3"></i> Nandpuri, Malviya Nagar, Jaipur, Rajasthan</p>
                        <h5 class="text-white mb-4">Corporate Office</h5>
                        <p><i class="fa fa-map-marker-alt me-3"></i> Basement, 9/132, Chitrakooot, Vaishali Nagar, Jaipur, Rajasthan 302021</p>
                        <p><i class="fa fa-envelope me-3"></i>contactus@icaimpetus.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Quick Link</h5>
                        <a class="btn btn-link" href="about.php">About Us</a>
                        <a class="btn btn-link" href="contact.php">Contact Us</a>
                        <a class="btn btn-link" href="index.php">Privacy Policy</a>
                        <!--<a class="btn btn-link" href="index.php">Terms & Condition</a>-->
                        <a class="btn btn-link" href="career.php">Career</a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Popular Link</h5>
                        <a class="btn btn-link" href="quote.php">Quote</a>
                        <!--<a class="btn btn-link" href="contact.php">Contact Us</a>-->
                        <a class="btn btn-link" href="service.php">Services</a>
                        <a class="btn btn-link" href="testimonial.php">Testimonial</a>
                        <a class="btn btn-link" href="team.php">Teams</a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Why Impetus?</h5>
                        <p>"We don't only provide the solution. We also provide the right vision to solve anything which comes your way."</p>
                        <div class="position-relative w-100 mt-3">
                            <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="Your Email" style="height: 48px;">
                            <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-paper-plane text-primary fs-4"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Impetus Consulting Associates Pvt Ltd</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="https://icaimpetus.com/">Impetus Consulting Associates Pvt Ltd</a>
                            <br>Distributed By: <a class="border-bottom" href="https://icaimpetus.com/" target="_blank">Impetus Consulting Associates Pvt Ltd</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script>
        $(document).ready(function () {
        $('#example').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>


