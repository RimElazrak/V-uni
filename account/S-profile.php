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
  

  // ========================================================================= ADDING A POST  

  if (isset($_POST["publier"])){                          
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
            //                             DISPLAYING POSTS IN FEED 
    
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
            }      $all_comments=null;                  
            $commentContent=$tempCom['CONTENU_COMM'];
            $commentDate=$tempCom['DATE_COMM'];
            $getCommentator="SELECT * from membre, commentaire where membre.ID_MEMBRE=commentaire.ID_MEMBRE and ID_COMM='$commentID'";
            $res_getCommentator=$mysqli->query($getCommentator);
            while ($temp=$res_getCommentator->fetch_assoc()){
              $commentatorName=ucwords( $temp['PRENOM'])." ".strtoupper($temp['NOM']);
              $commentatorPDP=$temp['photo'];
              
        
            }
            $viewComments.="

                
            <div id=\"hello\">
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
            <div class=\"border-bottom pt-2\"></div>
        </li></div>"; 
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
                    //++++++++++++POST AND COMMENTS GENERATED
              $viewPublication.="
                            <div class=\"profile-feed\" style=\"width:100%\">
                                <div class=\"col-md-8 grid-margin stretch-card\">
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
                                      <div class=\"border-top pt-2\"></div>
                                      <div class=\"d-flex justify-content-around\">
                                        <button type=\"button\" class=\"btn btn-inverse-danger btn-fw\">
                                              Like 
                                          <i class=\"fa fa-heart\"></i>
                                        </button>
                                        
                                        <button onclick=\"togglecomments()\" id = \"button4\" type=\"button\" class=\"btn btn-inverse-warning btn-fw\">
                                      Show comments <i class=\"fa fa-comment\"></i></button>
                                  </div>
                                  <div class=\"border-bottom pt-2\"></div>
                                      <div id=\"b$token\" style=\"padding-top: 20px \">  

                                      <form method=\"POST\" action=\"#\">
                                        <input type=\"hidden\" name=\"t$token\" value=\"$idpb\">
                                        <div class=\"add-items d-flex\">

                                            <input type=\"text\" required name=\"$token\" placeholder=\"Commenter\" class=\"form-control todo-list-input\">
                                            <button class=\"btn btn-primary mr-2\" type=\"submit\" value=\"$token\" name=\"commenter\"><i class=\"fa fa-paper-plane \" ></i> </button>
                                        </div>
                                      </form>
                                      
                                        <ul class=\"solid-bullet-list\">

                                        ".$viewComments."

                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div> ";

                $viewComments="";             //resetting comments 

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
                                <div class=\"col-md-8 grid-margin stretch-card\">
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
                                <div class=\"col-md-8 grid-margin stretch-card\">
                                  <div class=\"card\">
                                    <div class=\"card-body\">
                                      <div class=\"d-flex align-items-start profile-feed-item\" style=\"border:0px\">
                                        <img src=\"images/faces/$pdp\" alt=\"profile\" class=\"img-sm rounded-circle\">
                                        <div class=\"ml-4\">
                                          <h6>
                                            <b>$fullname</b>
                                            <small class=\"ml-4 text-muted\"><i class=\"far fa-clock mr-1\"></i>$date</small>
                                            <small class=\"ml-4 text-muted\"><i class=\"far fa-plus mr-1\"></i>$visib</small>

                                          </h6>
                                          <p style=\"margin-bottom: 5px\">
                                           $filieremembre . 
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
include('S-profile.html');
?>
