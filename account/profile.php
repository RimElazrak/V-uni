<!--    THIS IS THE INDEX OF THE WEBSITE, SIMILAR TO FACEBOOK'S HOMEPAGE. IF U PAY ATTENTION TO FB'S URL, U WILL FIND profile.php :)  -->

<?php
session_start();                                                           
if(isset($_SESSION["logged"])){
  $viewPublication="";         // this variable will be used to stock dynamic html content that has posts of users.
  $viewComments="";             // this variable will be used to stock dynamic html content that has comments of users.
  
  $deleteComment="";          //this will include the DELETE COMMENT button if the user wishes to delete his own comment(s)
  $additionalMenu="";                   // test / if the user is a professor, a new item on the panel will appear 
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
  $req_classe = "SELECT ID_CLASSE FROM ETUDIANT WHERE ID_MEMBRE ='$id_membre'";

  $res_profile=$mysqli->query($req_profile);
  $res_filiere=$mysqli->query($req_filiere);
  $res_classe=$mysqli->query($req_classe);

  while ($profile=$res_profile->fetch_assoc()){
      $pdp="images/faces/".$profile['photo'];
      $full_name = ucwords($profile['PRENOM'])." ".strtoupper($profile['NOM']);   
    }
    
  while ($f=$res_filiere->fetch_assoc()){                     
      $filiere = $f['FILIERE'];                                       //extraire nom de filiere a partir de la table ETUDIANT (ma m7tajinhach had sa3a)
    }
   /*  $req_idfiliere="SELECT ID_FILIERE FROM FILIERE WHERE nom='$filiere'";     //recuperer id a partir de la requete precedente 
    $res_idfiliere=$mysqli->query($req_idfiliere);
    while ($idf=$res_idfiliere->fetch_assoc()){
      $id_filiere=$idf['ID_FILIERE'];
    }
 while ($cl = $res_classe->fetch_assoc()){
    $classe=$cl['ID_CLASSE'];
  }*/

                                                          //ADDING A POST    
  if (isset($_POST["publier"])){                          
        $contenu=$_POST["contenu"];
        $visibilite=$_POST["visibilite"];
        $titre=$_POST["titre"];
        $now = DateTime::createFromFormat('U.u', microtime(true));
        $current= $now->format("Y-m-d H:i:s");

        $req_pub = "INSERT INTO publication VALUES (NULL, '$contenu', '$titre','$current', '$id_membre','$visibilite')";            //test 
        $res_pub = $mysqli->query($req_pub);

        $req_idpub = "SELECT ID_PUB FROM publication where ID_MEMBRE='$id_membre' order by DATE_PUB desc LIMIT 1";    //recuperer une seule et derniere pub
        $res_idpub=$mysqli->query($req_idpub);
        while ($pb=$res_idpub->fetch_assoc())
        {
           $id_publication=$pb['ID_PUB'];
        }
          // pubview ma khdamach
        $req_pubView="INSERT INTO pubview VALUES(NULL, '$id_publication', '$id_membre', NULL, NULL)";
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
              //deleting comments (100% working)
              if (isset($_GET["action"])) 
              
                {
                  
             // echo "<SCRIPT>alert('hhhhhhhh');</SCRIPT>"; 
              $commentToDelete= $_GET["id"];
              $verifyMember="SELECT ID_MEMBRE FROM commentaire where ID_COMM='$commentToDelete' ";
               $res_verifyMember=$mysqli->query($verifyMember);
               while ($member_to_delete_comment=$res_verifyMember->fetch_assoc())
               {
                 $THEmember = $member_to_delete_comment['ID_MEMBRE'];
               }
                   
               if ($THEmember==$id_membre){
                   $req_deleteComment = "DELETE FROM commentaire WHERE ID_COMM='$commentToDelete' ";
         
                   $res_deleteComment=$mysqli->query($req_deleteComment);
                   if($res_deleteComment){
         
                     echo "<SCRIPT>alert('Comment deleted SUCCeSSFULLY');document.location='profile.php';</SCRIPT>";
         
                   }
                 }
                 else 
                 echo "<SCRIPT>alert('YOU CANNOT DELETE THE comment BECAUSE YOU ARE NOT ITS OWNER');document.location='profile.php';</SCRIPT>";
             }
   
    //                                              DISPLAYING POSTS IN FEED 
    
    $displaypub= "SELECT * FROM publication WHERE visibilite='all'; ";//test
    $res_displaypub=$mysqli->query($displaypub);
              
    while ($displaypubID=$res_displaypub->fetch_assoc())
        { 
          $idpb=$displaypubID['ID_PUB'];
          $idm=$displaypubID['ID_MEMBRE'];

          $req_pubs="SELECT * from publication where ID_PUB='$idpb' ";
          $res_pubs=$mysqli->query($req_pubs);
         
         
                          //                                      DISPLAYING COMMENTS FOR POSTS
          $getComments="SELECT * from commentaire WHERE ID_PUB='$idpb'";
          $res_getComments=$mysqli->query($getComments);

          while ($tempCom=$res_getComments->fetch_assoc())        //comments code scope
          {
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

              $req_getfullname="SELECT NOM, PRENOM, photo from MEMBRE, ETUDIANT WHERE MEMBRE.ID_MEMBRE=ETUDIANT.ID_MEMBRE AND MEMBRE.ID_MEMBRE='$idm'";

              $res_getfullname=$mysqli->query($req_getfullname);
              while ($info_membre=$res_getfullname->fetch_assoc())
              {
                $full_name=ucwords($info_membre['PRENOM'])." ".strtoupper($info_membre['NOM']);
                $pdp=$info_membre['photo'];       
              }
                
            }

              $token=getName(5);  //for unique comment id's, this function generates a random string that will act as th name of a hidden input and the button to get the comment
              $viewPublication.="
                            <!-- i3ada -->
                            
                                <div class=\"col-8 grid-margin stretch-card\">
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
                                          <br>
                                          <h5 style=\"font-size: 0.95rem\">$title</h5>
                                          <p style=\"padding-top: 7px; font-size: 1.2rem\">$content</p>
                            
                                        </div>
                                      </div>
                                      
                                      <form method=\"POST\" style = \"margin-left: 7%\" action=\"#\">
                                        <input type=\"hidden\" name=\"t$token\" value=\"$idpb\">
                                        <div class=\"add-items d-flex\">
                                          <input type=\"text\" required name=\"$token\" placeholder=\"Commenter\"class=\"form-control todo-list-input\" style=\"height:50px;width:450px;word-break:break-word; overflow: auto; border: 0; padding-bottom: 5px\">
                                          <button class=\"btn btn-primary mr-2\" type=\"submit\" value=\"$token\" name=\"commenter\"><i class=\"fa fa-paper-plane \" ></i></button>
                                        </div>
                                        
                                      </form>
                                      <button onclick=\"togglecomments('$token', 'b$token')\" id=\"$token\" class=\"btn btn-link btn-rounded btn-fw\">Commentaires<i class=\"fa fa-comment\"></i></button>
                                      <div id=\"b$token\" style=\"padding-top: 20px \">
                                        <ul class=\"solid-bullet-list\">

                                        ".$viewComments."

                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              
                             ";

                $viewComments="";                                     //resetting viewComments SO AS NOT TO OVERWRITE COMMENTS

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

              $idpb=$displaypubID['ID_PUB']; 
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
   
    if(isset($_GET["filiere"]))                 //rim
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
                //$filiere_membre=$info_membre['FILIERE'];
                      
                }
              }
                          $viewPublication.="
                            <!-- i3ada -->
                            <div class=\"row\">
                            <div class=\"profile-feed\" >
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
                                </div></div>
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
  <link rel="shortcut icon" href="../assets/images/V.png" />
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
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../assets/js/dashboard.js"></script>
  <!-- End custom js for this page-->
 
  <!-- Custom js for this page-->
 <script src="../assets/js/formpickers.js"></script>
 <script src="../assets/js/form-addons.js"></script>
 <script src="../assets/js/x-editable.js"></script>
 <script src="../assets/js/dropify.js"></script>
 <script src="../assets/js/dropzone.js"></script>
 <script src="../assets/js/jquery-file-upload.js"></script>
 <script src="../assets/js/formpickers.js"></script>
 <script src="../assets/js/form-repeater.js"></script>
 <script src="../assets/js/test.js"></script>
 <script src="../assets/js/modal-demo.js"></script>
 <!-- End custom js for this page-->

  <input type="file" multiple="multiple" class="dz-hidden-input" style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">


  <!-- End custom js for this page-->
</head>

<body class="boxed-layout">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include ('nav/nav_account.php') ?>

      <!-- partial -->
      <div class="main-panel">          
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <!-- filiere dial l user  -->
              Filieres
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="filieres.php">Filiere</a></li>
                <li class="breadcrumb-item active" aria-current="page">SMI</li>
              </ol>
            </nav>
          </div>

          <div class="col-md-4 grid-margin stretch-card" style="float: right;  ">
           
            <div class="card">
              <div class="card-body">
                <!-- Dummy Modal Starts -->
                <!-- Dummy Modal Ends -->
                <!-- Add Post -->
                <div class="text-center">
                  <button type="button" class="btn btn-secondary btn-lg btn-block"data-toggle="modal" data-target="#exampleModal-bla">
                    Add new post...
                    <i class="btn-icon-append fas fa-plus"></i>
                  </button>
                </div>
                <div class="modal fade" id="exampleModal-bla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-bla" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog" role="document">
                  
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-bla">ADD TEXT A?D FILES </h5>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <DIV class="card">
                          <div class="card-body">
                          <h4 class="card-title">Basic Tab</h4>
                          <p class="card-description">Horizontal bootstrap tab</p>
                          <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#text-1" role="tab" aria-controls="home-1" aria-selected="true">text</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false">Add file</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-1" role="tab" aria-controls="contact-1" aria-selected="false">le3ba 5ra</a>
                            </li>
                          </ul>

                          <div class="tab-content">
                            <div class="tab-pane fade active show" id="text-1" role="tabpanel" aria-labelledby="home-tab">
                              <div class="media">
                                
                                <div class="media-body">
                                  <textarea id="maxlength-textarea" class="form-control" maxlength="200" rows="7" placeholder="Type something..."></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                              <div class="media">
                                <div class="media-body">
                                  <div class="form-group">
                              
                                    <!-- Upload image -->
                                    
                                    <div id="fileuploader">
                                    <div class="ajax-upload-dragdrop" style="vertical-align: top; width: 400px;">
                                    <div class="ajax-file-upload" style="position: relative; overflow: hidden; cursor: default;">
                                      Upload
                                      <form method="POST" action="YOUR_FILE_UPLOAD_URL" enctype="multipart/form-data" style="margin: 0px; padding: 0px;">
                                        <input type="file" id="ajax-upload-id-1590863929165" name="myfile[]" accept="*" multiple="" style="position: absolute; cursor: pointer; top: 0px; width: 100%; height: 100%; left: 0px; z-index: 100; opacity: 0;">
                                      </form>
                                    </div>
                                    <span><b>Drag &amp; Drop Files</b></span>
                                    </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="contact-1" role="tabpanel" aria-labelledby="contact-tab">
                              <h4>Contact us </h4>
                              <p>
                                Feel free to contact us if you have any questions!
                              </p>
                              <p>
                                <i class="fa fa-phone text-info"></i>
                                +123456789
                              </p>
                              <p>
                                <i class="far fa-envelope-open text-success"></i>
                                contactus@example.com
                              </p>
                            </div>
                          </div>
                        </div>
                        </DIV>
                        
                      </div>
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Ends -->
              </div>
                
              <div class="border-bottom pt-2">
                <!-- seperation line -->
              </div> 
              <br>

              <!--  Calendar  -->

              <div class="card-body">
                <h4 class="card-title">
                  <i class="fas fa-calendar-alt"></i>
                  Calendar
                </h4>
                <div id="inline-datepicker-example" class="datepicker"></div>
              </div>
                
              
            </div>
          </div>

        
          
          <div class="col-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="media">
                  <img src="<?php echo $pdp; ?>" alt="image" class="img-sm mr-3 rounded-circle">
                  <div class="media-body">
                    <h6 class="mb-1"><?php  echo $full_name; ?></h6>
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
                          <input type="hidden"  name="vis" value="filiere">

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
          
        
        
        <?php
            echo $viewPublication;
            ?>
        
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
