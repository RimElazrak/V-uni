<?php
session_start();
if(isset($_SESSION["mail"]) || isset($_SESSION["role"])){


    if(isset($_POST["submitt"])){
$ppr= $_POST["ppr"];
$dept = $_POST["dept"];
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
$req_insert="INSERT INTO PROFESSEUR VALUES ('$id_membre', '$ppr', '$dept',null)";
$req_update="UPDATE MEMBRE SET DATE_NAISSANCE='$birthdate', TELEPHONE='$tel', CIN='$cin', NATIONALITE='$nat', PSEUDONYME='$pseudo', ETAT='C' WHERE ID_MEMBRE=$id_membre";

$res_insert=$mysqli->query($req_insert);
$res_update=$mysqli->query($req_update);

$req_profile="SELECT * FROM MEMBRE WHERE EMAIL='$mail'";
$res_profile=$mysqli->query($req_profile);

while ($profile=$res_profile->fetch_assoc()){
  $photo="assets/images/faces/".$profile['photo'];
  $fullname = ucwords($profile['PRENOM'])." ".strtoupper($profile['NOM']); 
}
if($mysqli){
        
  header('Location: filieres.php');
}
else{
  echo'<script> alert("ERROR : Data Not saved !!"); </script>';
}


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
  <title>Parametre du Profile</title>
  <!-- plugins:css -->
  <link rel="icon" type="image/png" href="../VUNI-logo.png">

  <link rel="stylesheet" href="../assets/vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">
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
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
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
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="../images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
     
      <!-- partial -->
      <div class="main-panel" style="width: calc(100% - 0px);" >
        <div class="content-wrapper"><br>
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
                  <h4 class="card-title">Bonjour professeur. Veuillez entrer vos informations ..</h4>
                  <div style="color:red; text-align:center; font-weight:bold;"></div>

                  <form id="example-vertical-wizard" name = "form" method="post">
                    <div>
                      <h3>Compte</h3>
                      <section>
                        <h4>Compte</h4>
                        <div class="form-group">
                          <label for="pseudo">Pseudonyme *</label>
                          <input id="pseudo" name="pseudo" type="text" placeholder="Pseudonyme" class="required form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="CIN">CIN *</label>
                          <input id="CIN" name="cin" placeholder="CIN" type="text" class="required form-control" required>
                        </div>

                        <div class="form-group">
                          <label for="ppr">PPR *</label>
                          <input id="ppr" name="ppr" placeholder="PPR" type="text" class="required form-control" required>
                        </div>

                        <div class="form-group">
                          <label for="dept">Département *</label>
                          <select name="dept" class="form-control required form-control">
                            <option value="">Choisir votre département</option>
                            <option value="smai">Math Info</option>
                            <option value="smpc">pHY CHi</option>
                            <option value="svtu">SVI / TU</option>
                          </select>
                          <small>(*) Mandatory</small>
                        </div>
                    </section>
                    
                    
                    <h3>Profile</h3>
                      <section>
                        <h4>Profile</h4>
                        
                        <div class="form-group">
                          <label for="nationality">Nationalité </label>
                          <input id="nationality" name="nationality" placeholder="Marocain(e)" type="text">
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
                      <h3>Finir</h3>
                      <section>
                        <h4>Finir</h4>
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
