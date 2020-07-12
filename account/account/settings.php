<?php
session_start();
if(isset($_SESSION["mail"]) || isset($_SESSION["role"])){


if(isset($_POST["submitt"])){
$cne= $_POST["cne"];
$apogee= $_POST["apogee"];
$filiere = $_POST["filiere"];
$birthdate=$_POST["birthdate"];
$tel=$_POST["telephone"];
$cin=$_POST["cin"];
$nat=$_POST["nationality"];
$pseudo=$_POST["pseudo"];
$success="";
$role=$_SESSION["role"];
$mail=$_SESSION["mail"];
$mysqli= new mysqli('127.0.0.1','root','','pfe');

$req_membre="SELECT ID_MEMBRE from MEMBRE where email='$mail'";
$res=$mysqli->query($req_membre);
        while($membre= $res->fetch_assoc()){
            $id_membre= $membre['ID_MEMBRE'];
        }

$req_insert="INSERT INTO ETUDIANT VALUES ($id_membre, '$cne', '$apogee','$filiere',null)";
$req_update="UPDATE MEMBRE SET DATE_NAISSANCE='$birthdate', TELEPHONE='$tel', CIN='$cin', NATIONALITE='$nat', PSEUDONYME='$pseudo', ETAT='C' WHERE ID_MEMBRE=$id_membre" ;

$res_insert=$mysqli->query($req_insert);
$res_update=$mysqli->query($req_update);

header('Location: filieres.php');

}
}
else {

    echo '<script type="text/javascript"> alert("Sorry!  Register First!"); window.location="signup.php" </script>';
}

?>

<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/forms/wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:25 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Paramètres du Profil</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">
  <link rel="shortcut icon" href="assets/images/V-logo-mini.svg" />
  <link rel="shortcut icon" href="../assets/images/V-logo-mini.svg" />

  <!--<link rel="stylesheet" href="css/style.css">  

-->
    <style>
        <?php
         include '../assets/css/style.css'; 
     ?>
     
    </style>
    

    <script type="text/javascript">
        function JSalertsuccess(){
    	    swal("Terminé!", "VOTRE COMPTE A ETE CREE", "success");
        }
        function JSalerterror(){
	        swal("Erreur!", "ERREUR RENCONTREE", "error");
        }
    </script>
</head>

<body class="boxed-layout">
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    
    <!-- model -->
   
    <?php include ('nav/nav_account.php') ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="fas fa-fill-drip"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close fa fa-times"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close fa fa-times"></i>
        <ul class="nav nav-tabs" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
         
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task-todo">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
              </ul>
            </div>
            <div class="events py-4 border-bottom px-3">
              <div class="wrapper d-flex mb-2">
                <i class="fa fa-times-circle text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
              <p class="text-gray mb-0">build a js based app</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="fa fa-times-circle text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->

          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
     
      <!-- partial -->
      <div class="main-panel" style="width: calc(100% - 0px);" >
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
                Profile Settings
            </h3>
            
          </div>
          
          <!--vertical wizard-->
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card" style="height: 700px;" >
                <div class="card-body" style="height: 500px;">
                  <h4 class="card-title">Fill in your Information to Complete building your Account </h4>
                  <div style="color:red; text-align:center; font-weight:bold;"></div>

                  <form id="example-vertical-wizard" name = "form" method="post">
                    <div>
                      <h3>Account</h3>
                      <section>
                        <h4>Account</h4>
                        
                        <div class="form-group">
                          <label for="CIN">CIN *</label>
                          <input id="CIN" name="cin" placeholder="CIN" type="text" class="required form-control" required>
                        </div>

                        <div class="form-group">
                          <label for="CNE">CNE *</label>
                          <input id="CNE" name="cne" placeholder="CNE" type="text" class="required form-control" required>
                        </div>
                        
                        <div class="form-group">
                          <label for="APOGEE">APOGEE *</label>
                          <input id="APOGEE" name="apogee" placeholder="APOGEE"  type="text" class="required form-control" required>
                        
                      </div>
                      <div class="form-group">
                          <label for="filiere">Filiére *</label>
                          <select name="filiere" class="form-control required form-control">
                            <option value="">Choisir votre filière</option>
                            <option value="mi">SMI</option>
                            <option value="sma">SMA</option>
                            <option value="smp">SMP</option>
                            <option value="smc">SMC</option>
                            <option value="svi">SVI</option>
                        </select>
                        <small>(*) Mandatory</small>
                      </div>
                    </section>
                    
                    
                    <h3>Profile</h3>
                      <section>
                        <h4>Profile</h4>
                        <div class="form-group">
                          <label for="pseudo">Pseudonyme *</label>
                          <input id="pseudo" name="pseudo" type="text" placeholder="Pseudonyme" class="required form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="telephone">Téléphone </label>
                          <input id="telephone" name="telephone" placeholder="06 1234 567" type="text">
                        </div>
                       <div class="form-group">
                          <label for="birthdate">birthdate *</label>
                          
                            <input type="date" class="form-control required form-control " name="birthdate" required>
                          
                          <small>(*) Mandatory</small>
                        </div>
                         

                        
                      </section>
                      <h3>Finish</h3>
                      <section>
                        <h4>Finish</h4>
                        <div class="form-check"  id = "h">
                          <label class="form-check-label" >
                            <input input type="checkbox" name="agree" id="agree" required="" aria-required="true" class="checkbox">
                            I agree with the Terms and Conditions.
                          </label>
                        </div>
                      </section>
                  
                  
                     
                    </div>
                  </form>
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
  <!-- inject:js -->
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../assets/js/wizard.js"></script>
  <script src="../assets/js/test.js"></script>
  <script src="../assets/js/formpickers.js"></script>
  <!-- End custom js for this page-->
</body>


<!-- Mirrored from www.urbanui.com/melody/template/pages/forms/wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:26 GMT -->
</html>
