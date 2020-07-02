<!--    THIS IS THE INDEX OF THE WEBSITE, SIMILAR TO FACEBOOK'S HOMEPAGE. IF U PAY ATTENTION TO FB'S URL, U WILL FIND profile.php :)  -->

<?php
session_start();                                                           
if(isset($_SESSION["logged"])){
  $viewPublication="";         // this variable will be used to stock dynamic html content that has posts of users.
  $viewComments="";             // this variable will be used to stock dynamic html content that has comments of users.
  
  $deleteComment="";          //this will include the DELETE COMMENT button if the user wishes to delete his own comment(s)
  $additionalMenu="";                   // if the user is a professor, a new item on the panel will appear
  if ($_SESSION["role"]=="p"){
    $additionalMenu="
    <li class=\"nav-item\">
    <a class=\"nav-link\" data-toggle=\"collapse\" href=\"#page-layouts2\" aria-expanded=\"false\" aria-controls=\"page-layouts2\">
      <i class=\"fab fa-trello menu-icon\"></i>
      <span class=\"menu-title\">Gestion des classes</span>
      <i class=\"menu-arrow\"></i>
    </a>
    <div class=\"collapse\" id=\"page-layouts2\">
      <ul class=\"nav flex-column sub-menu\">
        <li class=\"nav-item d-none d-lg-block\"> <a class=\"nav-link\" href=\"classe.php\">Classes</a></li>
        <!--make a menu of classes (a student can be in more than one class) -->
        <li class=\"nav-item\"> <a class=\"nav-link\" href=\"profile.php\">Etudiants</a></li>
        <li class=\"nav-item d-none d-lg-block\"> <a class=\"nav-link\" href=\"profile.php\">Toutes les publications</a></li>
      </ul>
    </div>
  </li>";
  }
  
function getName($n) {                  // generating random input names  FOR UNIQUE ID'S FOR POSTS OR COMMENTS (FRONTEND)
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  $randomString = ''; 

  for ($i = 0; $i < $n; $i++) { 
      $index = rand(0, strlen($characters) - 1); 
      $randomString .= $characters[$index]; 
  } 
  
  return $randomString; 

}   

  
                                
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
  $req_classe = "SELECT ID_CLASSE FROM faire_partie_de WHERE ID_MEMBRE ='$id_membre'";

  $res_profile=$mysqli->query($req_profile);
  $res_filiere=$mysqli->query($req_filiere);

  while ($profile=$res_profile->fetch_assoc()){
      $photo="images/faces/".$profile['photo'];
      $fullname = ucwords($profile['PRENOM'])." ".strtoupper($profile['NOM']);   
    }
    
  while ($f=$res_filiere->fetch_assoc()){                     
      $filiere = $f['FILIERE'];                                               //extraire nom de filiere a partir de la table ETUDIANT
    }
    $req_idfiliere="SELECT ID_FILIERE FROM FILIERE WHERE nom='$filiere'";     //recuperer id a partir de la requete precedente 
    $res_idfiliere=$mysqli->query($req_idfiliere);
    while ($idf=$res_idfiliere->fetch_assoc()){
      $id_filiere=$idf['ID_FILIERE'];
    
    }
  
                                          
  if (isset($_POST["publier"])){                                              //ADDING A POST
        $contenu=$_POST["contenu"];
        $visibilite=$_POST["visibilite"];
        $titre=$_POST["titre"];
        $now = DateTime::createFromFormat('U.u', microtime(true));
        $current= $now->format("Y-m-d H:i:s");

        $req_pub = "INSERT INTO publication VALUES (NULL, '$contenu', '$titre','$current', '$id_membre','$visibilite')";
        $res_pub = $mysqli->query($req_pub);
        $req_idpub = "SELECT ID_PUB FROM publication where id_membre='$id_membre' order by DATE_PUB desc LIMIT 1";    //recuperer une seule et derniere pub
        $res_idpub=$mysqli->query($req_idpub);
        while ($pb=$res_idpub->fetch_assoc())
        {
           $id_publication=$pb['ID_PUB'];
        }
        $req_pubView="INSERT INTO pubview VALUES(NULL, '$id_publication', '$id_membre', '$classe', '$id_filiere')";
        $res_pubView=$mysqli->query($req_pubView);

    }
    
    if(isset($_POST["commenter"])){                         //ADDING A COMMENT
      $now = DateTime::createFromFormat('U.u', microtime(true));
      $current= $now->format("Y-m-d H:i:s");
      $comment=$_POST["commenter"];
      $commentct=$_POST["$comment"];        //comment content
      //$tempo= "post".$token;
      $postid=$_POST["t$comment"];
      $req_cmnt="INSERT INTO commentaire VALUES(NULL, '$commentct', '$current', '$id_membre', '$postid')";
      $res_cmnt=$mysqli->query($req_cmnt);
      //echo "<SCRIPT>alert('$postid');</SCRIPT>";
     
      
    }
                //DELETING COMMENTS (not working)
              if (isset($_GET["deletecomment"]))
              
                {
              echo "<SCRIPT>alert('hhhhhhhh');</SCRIPT>"; 
              $commentToDelete= $_GET["id"];
              $verifyMember="SELECT ID_MEMBRE FROM commentaire where ID_COMM='$commentToDelete' ";
               $res_verifyMember=$mysqli->query($verifyMember);
               while ($member_to_delete_comment=$res_verifyMember->fetch_assoc())
               {
                 $THEmember = $member_to_delete_comment['ID_MEMBRE'];
               }
                   
               if ($THEmember==$id_membre){
                   $req_deleteComment = "DELETE FROM commentaire WHERE ID_COMMENT='$commentToDelete' ";
         
                   $res_deleteComment=$mysqli->query($req_deleteComment);
                   if($res_deleteComment){
         
                     echo "<SCRIPT>alert('Comment deleted SUCCeSSFULLY');document.location='profile.php';</SCRIPT>";
         
                   }
                 }
                 else 
                 echo "<SCRIPT>alert('YOU CANNOT DELETE THE comment BECAUSE YOU ARE NOT ITS OWNER');document.location='profile.php';</SCRIPT>";
             }
   
    //                                              DISPLAYING POSTS IN FEED 
    
    $displaypub= "SELECT * FROM pubview, publication WHERE publication.ID_PUB=pubview.ID_PUB ";// 11 (classe) , 12 (Filiere)
    $res_displaypub=$mysqli->query($displaypub);
              
    while ($displaypubID=$res_displaypub->fetch_assoc())
        { 
          $idpb=$displaypubID['ID_PUB'];
          $idm=$displaypubID['ID_MEMBRE'];
          $idf=$displaypubID['ID_FILIERE'];

          $req_pubs="SELECT * from publication where ID_PUB='$idpb' ";
          $res_pubs=$mysqli->query($req_pubs);
         
         
          //                                             DISPLAYING COMMENTS FOR POSTS
          $getComments="SELECT * from commentaire WHERE ID_PUB='$idpb'";
          $res_getComments=$mysqli->query($getComments);

          while ($tempCom=$res_getComments->fetch_assoc()){
            $commentID=$tempCom['ID_COMM'];
            if ($id_membre==$tempCom['ID_MEMBRE']){                       //for a user to delete his own comments
              $deleteComment="<a href=\"profile.php?id=$commentID&action=deletecomment\" style=\"text-decoration:none; font-family:inherit; padding-top: 20px ;font-weight: inherit\">Delete comment</a>";
            }                        
            $commentContent=$tempCom['CONTENU_COMM'];
            $commentDate=$tempCom['DATE_COMM'];
            $getCommentator="SELECT * from membre, commentaire where membre.ID_MEMBRE=commentaire.ID_MEMBRE and ID_COMM='$commentID'";
            $res_getCommentator=$mysqli->query($getCommentator);
            while ($temp=$res_getCommentator->fetch_assoc()){
              $commentatorName=ucwords($temp['PRENOM'])." ".strtoupper($temp['NOM']);
              $commentatorPDP=$temp['photo'];
              
            }
            
            
            $viewComments.="
            <li>
            <img class=\"img-sm rounded-circle image-layer-item\" src=\"images/faces/$commentatorPDP\" alt=\"profile\">
            <label for=\"exampleTextarea1\" style=\"font-weight: 700; margin-left: 7px;\">$commentatorName</label>
        
            <h5>
              <span class=\"float-right text-muted font-weight-normal small\">$commentDate<br>
              "
              .$deleteComment."  
              </span>
            </h5>
            <p class=\"text-muted\">$commentContent</p>
            
        </li>";

            $deleteComment="";
            
          }

          while ($pubs=$res_pubs->fetch_assoc())
            {
              $content=$pubs['CONTENU_PUB'];
              $title=$pubs['TITRE_PUB'];
              $date=$pubs['DATE_PUB'];
              $visib=$pubs['visibilite'];

              $req_getfullname="SELECT NOM, PRENOM, photo, FILIERE from MEMBRE, ETUDIANT WHERE MEMBRE.ID_MEMBRE=ETUDIANT.ID_MEMBRE AND MEMBRE.ID_MEMBRE='$idm'";

              $res_getfullname=$mysqli->query($req_getfullname);
              while ($info_membre=$res_getfullname->fetch_assoc())
              {
                $full_name=ucwords($info_membre['PRENOM'])." ".strtoupper($info_membre['NOM']);
                $pdp=$info_membre['photo'];
                $filiere_membre=$info_membre['FILIERE'];
                      
              }

                
            }

              
              $token=getName(5);                   //for unique comment id's, this function generates a random string that will act as th name
                                                   //of a hidden input and the button to get the comment
              $viewPublication.="
                            <!-- i3ada -->
                            <div class=\"profile-feed\" style=\"width:100%\">
                                <div class=\"col-12 grid-margin\">
                                  <div class=\"card\">
                                    <div class=\"card-body\">
                                      <div class=\"d-flex align-items-start profile-feed-item\" style=\"border:0px\">
                                        <img src=\"images/faces/$pdp\" alt=\"profile\" class=\"img-sm rounded-circle\">
                                        <div class=\"ml-4\">
                                          <h6>
                                            <b>$full_name</b>
                                            <small class=\"ml-4 text-muted\"><i class=\"far fa-clock mr-1\"></i>$date</small>
                                            <small class=\"ml-4 text-muted\"><i class=\"far fa-plus mr-1\"></i>$visib</small>

                                          </h6>
                                          <p style=\"margin-bottom: 5px\">
                                           $filiere_membre . 
                                          </p>
                                          <h5 style=\"font-size: 0.95rem\">$title</h5>
                                          <p style=\"padding-top: 7px; font-size: 1.2rem\">$content</p>
                            
                                        </div>
                                      </div>
                                      
                                      <form method=\"POST\" style = \"margin-left: 7%\" action=\"#\">
                                        <input type=\"hidden\" name=\"t$token\" value=\"$idpb\">
                                        <input type=\"text\" required name=\"$token\" placeholder=\"Commenter\" style=\"height:50px;width:450px;word-break:break-word; overflow: auto; border: 0; padding-bottom: 5px\">
                                        <button class=\"btn btn-primary mr-2\" type=\"submit\" value=\"$token\" name=\"commenter\">Commenter</button>
                                      </form>
                                      <button onclick=\"togglecomments('$token', 'b$token')\" id=\"$token\" class=\"btn btn-link btn-rounded btn-fw\">Commentaires</button>
                                      <div id=\"b$token\" style=\"padding-top: 20px \">
                                        <ul class=\"solid-bullet-list\">

                                        ".$viewComments."

                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div> ";

                $viewComments="";                                     //resetting comments 

        }
              

                          //choice is from side panel
    if(isset($_GET["classe"]))
    {
      $viewPublication="";
        $getclasse=$_GET["classe"];
          if($getclasse==$classe){
            $displaypub="SELECT * from pubview, publication where publication.ID_PUB=pubview.ID_PUB AND ID_CLASSE='$getclasse'
            AND visibilite=\"classe\"";// 11 (classe) , 12 (Filiere)
            $res_displaypub=$mysqli->query($displaypub);
              
            while ($displaypubID=$res_displaypub->fetch_assoc()){ // 2 fois

              $idpb=$displaypubID['ID_PUB']; //=11
              $idm=$displaypubID['ID_MEMBRE'];
              $idf=$displaypubID['ID_FILIERE'];

              $req_pubs="SELECT * from publication where ID_PUB='$idpb' AND visibilite=\"classe\"";// result 1
              $res_pubs=$mysqli->query($req_pubs);
              while ($pubs=$res_pubs->fetch_assoc()){ // data pub 11
              $content=$pubs['CONTENU_PUB'];
              $title=$pubs['TITRE_PUB'];
              $date=$pubs['DATE_PUB'];
              $visib=$pubs['visibilite'];

              $req_getfullname="SELECT NOM, PRENOM, photo, FILIERE from MEMBRE, ETUDIANT WHERE MEMBRE.ID_MEMBRE=ETUDIANT.ID_MEMBRE AND MEMBRE.ID_MEMBRE='$idm'";

              $res_getfullname=$mysqli->query($req_getfullname);
              while ($info_membre=$res_getfullname->fetch_assoc()){
                $full_name=ucwords($info_membre['PRENOM'])." ".strtoupper($info_membre['NOM']);
                $pdp=$info_membre['photo'];
                $filiere_membre=$info_membre['FILIERE'];
                      
                }
              }
                      

                            $viewPublication.="
                            <!-- i3ada -->
                            <div class=\"profile-feed\" style=\"width:100%\">
                                <div class=\"col-12 grid-margin\">
                                  <div class=\"card\">
                                    <div class=\"card-body\">
                                      <div class=\"d-flex align-items-start profile-feed-item\" style=\"border:0px\">
                                        <img src=\"images/faces/$pdp\" alt=\"profile\" class=\"img-sm rounded-circle\">
                                        <div class=\"ml-4\">
                                          <h6>
                                            <b>$full_name</b>
                                            <small class=\"ml-4 text-muted\"><i class=\"far fa-clock mr-1\"></i>$date</small>
                                            <small class=\"ml-4 text-muted\"><i class=\"far fa-plus mr-1\"></i>$visib</small>

                                          </h6>
                                          <p style=\"margin-bottom: 5px\">
                                            $classe - $filiere_membre . 
                                          </p>
                                          <h5 style=\"font-size: 0.95rem\">$title</h5>
                                          <p style=\"padding-top: 7px; font-size: 1.2rem\">$content</p>
                            
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div> ";

              }
              
          
          }
          else {
            header('Location: profile.php');
            
          }

    }
   
    if(isset($_GET["filiere"]))
    {   
      $viewPublication="";
        $getfiliere=$_GET["filiere"];
          if($getfiliere==$id_filiere){
            $displaypub="SELECT * from pubview, publication where publication.ID_PUB=pubview.ID_PUB AND ID_FILIERE='$getfiliere'
            AND visibilite=\"fil\"";// voir enum dans la base de donnees
            $res_displaypub=$mysqli->query($displaypub);
              
            while ($displaypubID=$res_displaypub->fetch_assoc()){ // 2 fois

              $idpb=$displaypubID['ID_PUB']; //=11
              $idm=$displaypubID['ID_MEMBRE'];
              //$idf=$displaypubID['ID_FILIERE'];

              $req_pubs="SELECT * from publication where ID_PUB='$idpb' AND visibilite=\"fil\"";// result 1
              $res_pubs=$mysqli->query($req_pubs);
              while ($pubs=$res_pubs->fetch_assoc()){ // data pub 11
              $content=$pubs['CONTENU_PUB'];
              $title=$pubs['TITRE_PUB'];
              
              $date=$pubs['DATE_PUB'];
              $visib=$pubs['visibilite'];

              $req_getfullname="SELECT NOM, PRENOM, photo, FILIERE from MEMBRE, ETUDIANT WHERE MEMBRE.ID_MEMBRE=ETUDIANT.ID_MEMBRE AND MEMBRE.ID_MEMBRE='$idm'";

              $res_getfullname=$mysqli->query($req_getfullname);
              while ($info_membre=$res_getfullname->fetch_assoc()){
                $full_name=ucwords($info_membre['PRENOM'])." ".strtoupper($info_membre['NOM']);
                $pdp=$info_membre['photo'];
                $filiere_membre=$info_membre['FILIERE'];
                      
                }
              }
                          $viewPublication.="
                            <!-- i3ada -->
                            <div class=\"profile-feed\" style=\"width:100%\">
                                <div class=\"col-12 grid-margin\">
                                  <div class=\"card\">
                                    <div class=\"card-body\">
                                      <div class=\"d-flex align-items-start profile-feed-item\" style=\"border:0px\">
                                        <img src=\"images/faces/$pdp\" alt=\"profile\" class=\"img-sm rounded-circle\">
                                        <div class=\"ml-4\">
                                          <h6>
                                            <b>$full_name</b>
                                            <small class=\"ml-4 text-muted\"><i class=\"far fa-clock mr-1\"></i>$date</small>
                                            <small class=\"ml-4 text-muted\"><i class=\"far fa-plus mr-1\"></i>$visib</small>

                                          </h6>
                                          <p style=\"margin-bottom: 5px\">
                                           $filiere_membre . 
                                          </p>
                                          <h5 style=\"font-size: 0.95rem\">$title</h5>
                                          <p style=\"padding-top: 7px; font-size: 1.2rem\">$content</p>
                            
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div> ";
                              

              }
          }
          else {
            header('Location: profile.php');
            
          }

    }

        //le cas de $_GET["all"] pour toutes les publications n'est pas nécessaire
}
else {

    header('Location: ../home.php');
}

?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/ui-features/dragula.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:06:24 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Profile</title>
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
  <script src="../assets/js/dragula.js"></script>
  <script src="../assets/js/test2.js"></script>             <!-- show and hide comments -->
  <!-- End custom js for this page-->
</head>

<body class="boxed-layout">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="profile.php"><img src="../assets/images/V-logo.svg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="profile.php"><img src="../assets/images/V-logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fas fa-bars"></span>
        </button>
        <ul class="navbar-nav">
          <li class="nav-item nav-search d-none d-md-flex">
            <div class="nav-link">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-search"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="Search" aria-label="Search">
              </div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          

          <li class="nav-item dropdown d-none d-lg-flex">
            <div class="nav-link">
              <span class="dropdown-toggle btn btn-outline-dark" id="languageDropdown" data-toggle="dropdown">Classroom</span>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                <a class="dropdown-item font-weight-medium" href="#" data-toggle="modal" data-target="#exampleModal-2">
                  Add
                  
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item font-weight-medium" href="#">
                  Join
                </a>
                
              </div>
              


            </div>
            
          </li>
              
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="fas fa-bell mx-0"></i>
              <span class="count">16</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 16 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-danger">
                    <i class="fas fa-exclamation-circle mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="fas fa-wrench mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="far fa-envelope mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-envelope mx-0"></i>
              <span class="count">25</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 7 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium">David Grey
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            <img src="<?php echo $photo; ?>" alt="profile"/>            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="fas fa-cog text-primary"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item">
                <i class="fas fa-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link" href="#">
              <i class="fas fa-ellipsis-h"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="fas fa-bars"></span>
        </button>
      </div>
    </nav>

    <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel-2">Add a Class</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
            

            <form class="forms-sample" action="form.php"  method="POST" id="editForm" role="form">
             <div class="modal-body">
              <div class="form-group">
                <label class="nameInput">Class Name *</label>
                
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@</span>
                    </div>
                    <input name="cname" type="text" class="form-control" id="nameInput" placeholder="Classname" aria-label="Classname" required>
                  </div>
              </div>
              
              <div class="form-group">
                <label for="descInput">Description</label>
                <input name="description" type="text" class="form-control" id="descInput" placeholder="Descriptio" >
              </div>
              
              <div class="form-group">
                <label for="semInput">Semestre</label>
                <select  name="csem" class="form-control form-control-lg" id="semInput">
                  <option value="">Quelle semestre..?</option>
                  <option value="S1 - S2">S1 - S2</option>
                  <option value="S3 - S4">S3 - S4</option>
                  <option value="S5 - S6">S5 - S6</option>

                </select>
              </div>
             
              <div class="form-group">
                <label for="exampleInputConfirmPassword1">Password *</label>
                <input name="cpw" type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password" required>
              </div>

              <div class="form-group">
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Agree to terms and conditions
                  <i class="input-helper"></i><i class="input-helper"></i></label>
                </div>
              </div>
            
              </div>
              <div class="modal-footer">
                <button type="submit" name="insertdata" class="btn btn-primary mr-2">submit</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
              </div>
            </form>
       
       
        </div>
      </div>
    </div>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
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
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
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
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
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
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <img src="<?php echo $photo; ?>" alt="image"/>
              </div>
              <div class="profile-name">
                <p class="name">
                  <?php echo $fullname; ?>
                </p>
                <p class="designation">                                               <!--  this is the role of the user: student, professor or administrator        -->
                  Super Admin                                                         <!--  change it to $something        -->
                </p>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index-2.html">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="publications.php">
              <i class="fa fa-puzzle-piece menu-icon"></i>
              <span class="menu-title">Gestion des publications</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
              <i class="fab fa-trello menu-icon"></i>
              <span class="menu-title">Publications</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="profile.php?classe=<?php echo $classe; ?>">Classes</a></li>
                <!--make a menu of classes (a student can be in more than one class) -->
                <li class="nav-item"> <a class="nav-link" href="profile.php?filiere=<?php echo $id_filiere; ?>">Filière</a></li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="profile.php">Toutes les publications</a></li>
              </ul>
            </div>
          </li>
          <?php
          echo $additionalMenu;
          ?>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">          
        <div class="content-wrapper">
          <div class="page-header">
            
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">UI Elements</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dragula</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="card rounded mb-2" style="border:0px">
                            <div class="card-body p-3">
                              <div class="media">
                                <img src="<?php echo $photo; ?>" alt="image" class="img-sm mr-3 rounded-circle">
                                <div class="media-body">
                                  <h6 class="mb-1"><?php  echo $fullname; ?></h6>
                                  <p class="mb-0 text-muted" style = "padding-bottom: 5px">
                                    <?php echo strtoupper($filiere);     ?>                           
                                  </p>
                                  
                                  <div class="form-group">
                                    <form method="POST" action="#">
                                  <select name="visibilite" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Publier pour:
                                  <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -2px, 0px); top: 0px; left: 0px; will-change: transform;">
                                      <option value="all" class="dropdown-item">Tout le monde</option>
                                      <option value="classe" class="dropdown-item">Classe</option>
                                      <option value="fil" class="dropdown-item">Filière</option>
                                  </select>
                                  
                                </div>
                                    <br>
                                
                                  <div class="form-group">
                                  <label for="exampleInputCity1" style="margin-top: -10px">Titre</label>
                                  <input type="text" required name="titre" class="form-control" id="exampleInputCity1">
                                  <label for="exampleTextarea1" style="padding-top: 8px">Publication</label>
                                    <textarea name="contenu" required class="form-control" id="exampleTextarea1" rows="4"></textarea>

                                  </div>

                                  <div class="form-group">
                                  <button type="submit" name="publier" class="btn btn-primary mr-2">Publier</button>
                                                       
                                    <input type="file" name="img[]" class="file-upload-default">                                      
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button> 
                                        
                                        
                                  </div>
                                  </form>
                                </div>                              
                              </div>
                            </div>
                          </div>
                  
                </div>
              </div>
            </div>
            <?php
            echo $viewPublication;
            ?>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
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
 
</body>


<!-- Mirrored from www.urbanui.com/melody/template/pages/ui-features/dragula.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:06:26 GMT -->
</html>
