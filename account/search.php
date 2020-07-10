<?php  

    $mysqli= new mysqli('127.0.0.1','root','','pfe');
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/portfolio.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:17:28 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Search Results</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../assets/images/V-logo-mini.svg" />
</head>

<body class="boxed-layout">
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include ('nav/nav_account.php') ?>


      <!-- partial -->
      <div class="main-panel" ><br><br><br>
        <div class="content-wrapper">
          <div class="page-header"> <h2>Search Results</h2></div>
          
        

         
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <?php
          
                      $query = $_GET['query']; 
                      // gets value sent over search form
                      $req_search="SELECT * FROM membre WHERE (`Nom` LIKE '%".$query."%') OR (`Prenom` LIKE '%".$query."%' ) OR (`PSEUDONYME` LIKE '%".$query."%')";
                      $res_search=mysqli_query($mysqli, $req_search);
                      if ($res_search->num_rows>0){                       

                        while($results = mysqli_fetch_array($res_search)){
                            echo "
                            <div class=\"col-md-6 grid-margin stretch-card\">
                              <div class=\"card\">
                                  <div class=\"card-body\">
                                      <div class=\"d-flex flex-row\">
                                          <img src=\"../assets/images/faces/$results[12]\" class=\"img-lg rounded\" alt=\"profile image\">
                                          <div class=\"ml-3\">
                                              <h6>$results[1].$results[2]</h6>
                                              <p class=\"text-muted\">Pseudo : $results[9]</p>
                                              <p class=\"text-muted\">$results[4]</p>
                                              <p class=\"mt-2 text-primary font-weight-bold\">$results[10]TUDENT</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          ";
                        }
                      }
                      
                      else{ // if there is no matching rows do following
                          echo "No results";
                      } 
                    ?>
                  
                    
                  </div>
                </div>
              </div>
            </div>
          </div>      
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="far fa-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>
  <!-- endinject -->
  <script src="../assets/js/tooltips.js"></script>
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/portfolio.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:17:28 GMT -->
</html>