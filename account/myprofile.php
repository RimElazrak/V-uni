<?php
  session_start();                                                           
  if(isset($_SESSION["logged"])){                              
    
      $mysqli= new mysqli('127.0.0.1','root','','pfe');       // it will stock a big amount of posts
      $mail=$_SESSION["mail"];
      $req_membre="SELECT ID_MEMBRE from MEMBRE where email='$mail'";
      $res=$mysqli->query($req_membre);
      while($membre= $res->fetch_assoc())
        {
          $id_membre= $membre['ID_MEMBRE'];
        }
      $req_profile="SELECT * FROM MEMBRE WHERE EMAIL='$mail'";
      $req_filiere="SELECT FILIERE FROM ETUDIANT WHERE ID_MEMBRE ='$id_membre'";
    
      $res_profile=$mysqli->query($req_profile);
      $res_filiere=$mysqli->query($req_filiere);
    
      while ($profile=$res_profile->fetch_assoc()){
          $photo="assets/images/faces/".$profile['photo'];
          $fullname = ucwords($profile['PRENOM'])." ".strtoupper($profile['NOM']); 
        }
        
      while ($f=$res_filiere->fetch_assoc()){                     
          $filiere = $f['FILIERE'];                                               //extraire nom de filiere a partir de la table ETUDIANT
        }
        
     
  }  
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/portfolio.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:17:28 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Mon profile</title>
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
      <div class="main-panel" >
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
                Profile Settings
            </h3>
            
          </div>
          
          <!--vertical wizard-->

          <div class="row" >

            <div class="col-md-4 grid-margin stretch-card pricing-card">
              <div class="card border-primary border pricing-card-body">
                  <div class="card text-center">
                    <div class="card-body">
                        <img src="<?php echo $photo; ?>" class="img-lg rounded" alt="profile image"/>
                        <h4><?php  echo $fullname; ?></h4>
                        <p class="text-muted"><?php  if ($role="s"){echo "Student";} else{echo "Professor";}  ?></p>
                        <p class="text-muted"><?php  echo $filiere; ?>  |  S6 </p>
                        <p class="mt-4 card-text">
                                CAPTION // Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                Aenean commodo ligula eget dolor. Lorem
                        </p>
                        <div class="badge badge-pill badge-outline-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Student badge"><i class="fa fa-graduation-cap"></i></div>
                        <div class="badge badge-pill badge-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="registered user"><i class="fa fa-user"></i></div><br><br>
                        <div class="border-top pt-3">
                            <div class="row">
                                <div class="col-4">
                                    <h6>5896</h6>
                                    <p>Post</p>
                                </div>
                                <div class="col-4">
                                    <h6>1596</h6>
                                    <p>Followers</p>
                                </div>
                                <div class="col-4">
                                    <h6>7896</h6>
                                    <p>Likes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
                
            </div>
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Updates</h4>
                        <div class="py-4">
                        <p class="clearfix">
                          <span class="float-left">
                            Status
                          </span>
                          <span class="float-right text-muted">
                            Active
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Phone
                          </span>
                          <span class="float-right text-muted">
                            006 3435 22
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Mail
                          </span>
                          <span class="float-right text-muted">
                            Jacod@testmail.com
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Facebook
                          </span>
                          <span class="float-right text-muted">
                            <a href="#">David Grey</a>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Twitter
                          </span>
                          <span class="float-right text-muted">
                            <a href="#">@davidgrey</a>
                          </span>
                        </p>
                      </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="border-bottom text-center pb-4">
                        <img src="<?php echo $photo; ?>" alt="profile" class="img-lg rounded-circle mb-3">
                        <p>Bureau Oberhaeuser is a design bureau focused on Information- and Interface Design. </p>
                        
                      </div>
                      
                      <div class="border-bottom py-4">
                        <div class="d-flex mb-3">
                          <div class="progress progress-md flex-grow">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="55" style="width: 55%" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                        <div class="d-flex">
                          <div class="progress progress-md flex-grow">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="75" style="width: 75%" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="py-4">
                        <p class="clearfix">
                          <span class="float-left">
                            Status
                          </span>
                          <span class="float-right text-muted">
                            Completed
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Phone
                          </span>
                          <span class="float-right text-muted">
                            006 3435 22
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Mail
                          </span>
                          <span class="float-right text-muted">
                            Jacod@testmail.com
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Filiere
                          </span>
                          <span class="float-right text-muted">
                            <a href="#">David Grey</a>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Twitter
                          </span>
                          <span class="float-right text-muted">
                            <a href="#">@davidgrey</a>
                          </span>
                        </p>
                      </div>
                      <button class="btn btn-primary btn-block">Edit</button>
                    </div>
                    <div class="col-lg-8 pl-lg-5">
                      <div class="d-flex justify-content-between">
                        <div>
                          <h3><?php  echo $fullname; ?></h3>
                          <div class="d-flex align-items-center">
                            <h5 class="mb-0 mr-2 text-muted">SMI</h5>
                          </div>
                        </div>
                        <div>
                          <button class="btn btn-outline-secondary btn-icon">
                            <i class="far fa-envelope"></i>
                          </button>
                          <button class="btn btn-primary">Request</button>
                        </div>
                      </div>
                      <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          
                          <li class="nav-item">
                            <a class="nav-link active" href="#">
                              <i class="fas fa-file"></i>
                              Feed
                            </a>
                          </li>
                          
                        </ul>
                      </div>
                      <div class="profile-feed">
                        <div class="d-flex align-items-start profile-feed-item">
                          <img src="../assets/images/faces/face13.jpg" alt="profile" class="img-sm rounded-circle">
                          <div class="ml-4">
                            <h6>
                              Mason Beck
                              <small class="ml-4 text-muted"><i class="far fa-clock mr-1"></i>10 hours</small>
                            </h6>
                            <p>
                              There is no better advertisement campaign that is low cost and also successful at the same time.
                            </p>
                            <p class="small text-muted mt-2 mb-0">
                              <span>
                                <i class="fa fa-star mr-1"></i>4
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-comment mr-1"></i>11
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-mail-reply"></i>
                              </span>
                            </p>
                          </div>
                        </div>
                        <div class="d-flex align-items-start profile-feed-item">
                          <img src="../assets/images/faces/face16.jpg" alt="profile" class="img-sm rounded-circle">
                          <div class="ml-4">
                            <h6>
                              Willie Stanley
                              <small class="ml-4 text-muted"><i class="far fa-clock mr-1"></i>10 hours</small>
                            </h6>
                            <img src="../assets/images/samples/1280x768/12.jpg" alt="sample" class="rounded mw-100">                            
                            <p class="small text-muted mt-2 mb-0">
                              <span>
                                <i class="fa fa-star mr-1"></i>4
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-comment mr-1"></i>11
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-mail-reply"></i>
                              </span>
                            </p>
                          </div>
                        </div>
                        <div class="d-flex align-items-start profile-feed-item">
                          <img src="../assets/images/faces/face19.html" alt="profile" class="img-sm rounded-circle">
                          <div class="ml-4">
                            <h6>
                              Dylan Silva
                              <small class="ml-4 text-muted"><i class="far fa-clock mr-1"></i>10 hours</small>
                            </h6>
                            <p>
                              When I first got into the online advertising business, I was looking for the magical combination 
                              that would put my website into the top search engine rankings
                            </p>
                            <img src="../assets/images/samples/1280x768/5.jpg" alt="sample" class="rounded mw-100">                                                        
                            <p class="small text-muted mt-2 mb-0">
                              <span>
                                <i class="fa fa-star mr-1"></i>4
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-comment mr-1"></i>11
                              </span>
                              <span class="ml-2">
                                <i class="fa fa-mail-reply"></i>
                              </span>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
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
