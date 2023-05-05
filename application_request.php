
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Database | Impetus Consulting Associates Pvt Ltd</title>
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
                    <!--<h1 class="m-0">BizConsult</h1>-->
                    <img src="img/ICA_logo.png" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="database.php" class="nav-item nav-link">Home</a>
                        <a href="quote_request.php" class="nav-item nav-link">Quote</a>
                        <a href="contact_request.php" class="nav-item nav-link">Contact us</a>
                        <a href="application_request".php" class="nav-item nav-link active">Job Applications</a>
                        <a href="logout.php" class="nav-item nav-link">Logout</a>
                    </div>
                    <!--<a href="" class="btn btn-light rounded-pill text-primary py-2 px-4 ms-lg-5">Free Quote</a>-->
                </div>
            </nav>

            <div class="container-xxl bg-primary page-header">
                <div class="container text-center">
                    <h1 class="text-white animated zoomIn mb-3">Admin Database</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Job Applications</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Contact Start -->
        <div class="container">
          <h4>Applicant Details</h4>
          <form method='post' action='download.php'><br>
            <input type='submit' name='all' value='Download All Records' class="btn btn-primary float-right">
          </form><br>
        <table class="table table-bordered" id="example">
            <thead>
              <tr>
                <th><input type="checkbox" id="check_all"></th>
                <th>SN</th>
                <th>ID</th>
                <th>Industry</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Resume</th>
                <th>Cover</th>
              </tr>
            </thead>
            <tbody>
              <?php
                //Include your database connection file here
                include 'db.php';
        
                //Fetch data from the database
                $sql = "SELECT * FROM job";
                $result = mysqli_query($connection, $sql);
                
                //Display the data in the table
                $serial_no = 1;
                while($row = mysqli_fetch_assoc($result)){
                  echo "<tr>";
                  echo "<td><input type='checkbox' class='checkbox' name='checkbox[]' value='".$row['id']."'></td>";
                  echo "<td>".$serial_no."</td>";
                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['industry']."</td>";
                  echo "<td>".$row['name']."</td>";
                  echo "<td>".$row['email']."</td>";
                  echo "<td>".$row['phone']."</td>";
                  echo "<td><a href='resume/".$row['resume']."' download>Download</a></td>";
                  echo "<td><a href='cover/".$row['cover']."'>Download</a></td>";
                  echo "</tr>";
                  $serial_no++;
                }
                ?>
            </tbody>
          </table>
        
          <button id="select_all" class="btn btn-primary">Select All</button>
          <button id="delete_selected" class="btn btn-danger">Delete Selected</button>
          <button id="download_selected" class="btn btn-primary">Download Selected</button>
        </div>
        
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
              // Select/Deselect all checkboxes
              $("#check_all").change(function () {
                $(".checkbox").prop('checked', $(this).prop("checked"));
              });
                        
              // Download selected button
              $("#download_selected").click(function () {
                  var selected = [];
                  $("input[name='checkbox[]']:checked").each(function() {
                    selected.push($(this).val());
                  });
                  if(selected.length === 0){
                    alert("Please select row(s) you want to download.");
                    return;
                  }
                  var url = "download.php?ids=" + selected.join(',');
                  window.location.href = url;
                });

            </script>
            <script>
            // Select and un select button
            $(document).ready(function() {
              $("#select_all").click(function() {
                if ($(".checkbox:not(:checked)").length === 0) {
                  // If all checkboxes are already checked, uncheck them all
                  $(".checkbox").prop("checked", false);
                  $("#select_all").text("Select All");
                } else {
                  // Otherwise, check all checkboxes
                  $(".checkbox").prop("checked", true);
                  $("#select_all").text("Unselect All");
                }
              });
            
              $("#unselect_all").click(function() {
                $(".checkbox").prop("checked", false);
                $("#select_all").text("Select All");
              });
            
              // Show/hide the "Unselect All" button based on checkbox state
              $(".checkbox").change(function() {
                if ($(".checkbox:not(:checked)").length === 0) {
                  $("#select_all").text("Unselect All");
                  $("#unselect_all").show();
                } else {
                  $("#select_all").text("Select All");
                  $("#unselect_all").hide();
                }
              });
            });

            </script>
                                                    
            <script>
              // Delete selected button
              
                        $("#delete_selected").prop("disabled", true);
                        
                        $("input[name='checkbox[]']").change(function() {
                          if ($("input[name='checkbox[]']:checked").length > 0) {
                            $("#delete_selected").prop("disabled", false);
                          } else {
                            $("#delete_selected").prop("disabled", true);
                          }
                        });
                        
                        $("#delete_selected").click(function () {
                          var selected = [];
                          $("input[name='checkbox[]']:checked").each(function() {
                            selected.push($(this).val());
                          });
                          if(selected.length === 0){
                            alert("Please select row(s) you want to delete.");
                            return;
                          }
                          if(confirm("Are you sure you want to delete the selected row(s)?")){
                            $.ajax({
                              url: "delete.php",
                              type: "POST",
                              data: {ids: selected.join(','), delete: 1},
                              success: function(response) {
                                // Redirect to the previous page
                                window.location.href = "application_request.php";
                              },
                              error: function(jqXHR, textStatus, errorThrown) {
                                // Display an error message
                                alert("Error deleting candidates: " + errorThrown);
                              }
                            });
                          }
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


