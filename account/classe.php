<?php
session_start();
$mysqli= new mysqli('127.0.0.1','root','','pfe'); 
 if (isset($_GET["test1"]))
 {
  $_SESSION["class_name"] = $_GET["test1"];
  $cname = $_GET["test1"];
 }
 $req_cid = "SELECT ID_CLASSE FROM CLASSE WHERE NOM_CLASSE='$cname'";
      $res_cid = $mysqli->query($req_cid);
      while($C= $res_cid->fetch_assoc())
      {
        $id_classe1= $C['ID_CLASSE'];
      }  
  if(isset($_SESSION["logged"])){
    $mysqli= new mysqli('127.0.0.1','root','','pfe');       
    $mail=$_SESSION["mail"];
    $viewPublication="";         // this variable will be used to stock dynamic html content that has posts of users.
    $viewComments="";             // this variable will be used to stock dynamic html content that has comments of users.
   //$filiere_id = $_GET["idfiliere"];   //id récupéré à partir de la page Filieres afin d'afficher les publications de la filière dont l'id est idfiliere
    $deleteComment="";          //this will include the DELETE COMMENT button if the user wishes to delete his own comment(s)
    $additionalMenu="";                   // test / if the user is a professor, a new item on the panel will appear 
   // $rand=rand();
    //$_SESSION['rand']=$rand;
  function getName($n) {                  // generating random input names  FOR UNIQUE ID'S FOR POSTS OR COMMENTS (FRONTEND)
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
    
    return $randomString; 
  
  }   
                            
  
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
   
      if(isset($_POST["commenter"]) ){  
       // echo "aaaaaaaaaaaaaaaaaaaa"    ;                   //ADDING A COMMENT
        $now = DateTime::createFromFormat('U.u', microtime(true));
        $current= $now->format("Y-m-d H:i:s");
        $comment=$_POST["commenter"];
        $commentct=$_POST["$comment"];        //comment content
        //$tempo= "post".$token;
        $postid=$_POST["t$comment"];
       // echo "aaaaaaaaaa";
        $req_cmnt="INSERT INTO commentaire VALUES(NULL, '$commentct', '$current', '$id_membre', '$postid')";
        $res_cmnt=$mysqli->query($req_cmnt);
        header('Location: ' . basename($_SERVER['PHP_SELF'])."?test1=$cname");
        exit();
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
                
  
                  
     
      //    publications de la filiere choisie après avoir récupéré l'id à partir de la page Filières
        //$viewPublication="";  
        $displaypub="SELECT * from publication where  id_classe='$id_classe1' order by DATE_PUB DESC " ;// voir enum dans la base de donnees
           //  $displaypub="SELECT * from pubview, publication where publication.ID_PUB=pubview.ID_PUB AND ID_FILIERE='$filiere_id' AND visibilite=\"fil\"";// voir enum dans la base de donnees
              $res_displaypub=$mysqli->query($displaypub);
                
              while ($displaypubID=$res_displaypub->fetch_assoc())
              {
                $idpb=$displaypubID['ID_PUB']; //=11
                $idm=$displaypubID['ID_MEMBRE'];
              //  echo $idpb."</br>";
                //$idf=$displaypubID['ID_FILIERE'];
  
                $req_pubs="SELECT * from publication where ID_PUB=$idpb order by DATE_PUB DESC";// result 1
                $res_pubs=$mysqli->query($req_pubs);
                
                $getComments="SELECT * from commentaire WHERE ID_PUB='$idpb'";
                $res_getComments=$mysqli->query($getComments);
  
                while ($tempCom=$res_getComments->fetch_assoc())        //comments code scope
                {
                  $commentID=$tempCom['ID_COMM'];
                  if ($id_membre==$tempCom['ID_MEMBRE'])     //for a user to delete his own comments
                  {                      
                    $deleteComment="<a href=\"classe.php?id=$commentID&action=deletecomment\" style=\"text-decoration:none; font-family:inherit; padding-top: 20px ;font-weight: inherit\">Delete comment</a>";
                  }                        
                  $commentContent=$tempCom['CONTENU_COMM'];
                  $commentDate=$tempCom['DATE_COMM'];
                  $getCommentator="SELECT * from membre, commentaire where membre.ID_MEMBRE=commentaire.ID_MEMBRE and ID_COMM='$commentID'";
                  $res_getCommentator=$mysqli->query($getCommentator);
                  while ($temp=$res_getCommentator->fetch_assoc())
                  {
                    $commentatorName=ucwords($temp['PRENOM'])." ".strtoupper($temp['NOM']);
                    $commentatorPDP="../assets/images/faces/".$temp['photo'];
                
                  }
                  $viewComments.="
              <li>
              <img class=\"img-sm rounded-circle image-layer-item\" src=\"$commentatorPDP\" alt=\"profile\">
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
               
                                                          //resetting viewComments SO AS NOT TO OVERWRITE COMMENTS
  
  
         while ($pubs=$res_pubs->fetch_assoc())
        { // data pub 11
          //echo "1";
          $content=$pubs['CONTENU_PUB'];
          $title=$pubs['TITRE_PUB'];
          $date=$pubs['DATE_PUB'];
          //$visib=$pubs['visibilite'];
          $id_m = $pubs['ID_MEMBRE'];
          //echo $id_m;
          $req_getfullname="SELECT NOM, PRENOM, photo from MEMBRE WHERE MEMBRE.ID_MEMBRE='$id_m'";
          $res_getfullname=$mysqli->query($req_getfullname);
          while ($info_membre=$res_getfullname->fetch_assoc())
          {
            $full_name=ucwords($info_membre['PRENOM'])." ".strtoupper($info_membre['NOM']);
            $pdp= "../assets/images/faces/".$info_membre['photo'];
            //$filiere_membre=$info_membre['FILIERE'];
                
        
          
         
        
        
        $token=getName(5);  //for unique comment id's, this function generates a random string that will act as th name of a hidden input and the button to get the comment
        $viewPublication.="
                      <!-- i3ada -->
                        <div class = 'llo'>
                          <div class='row'>
                            <div class=\"card\">
                              <div class=\"card-body\">
                                <div class=\"d-flex align-items-start profile-feed-item\" style=\"border:0px\">
                                  <img src=\"$pdp\" alt=\"profile\" class=\"img-sm rounded-circle\">
                                  <div class=\"ml-4\">
                                    <h6>
                                      <b>$full_name</b>
                                      <small class=\"ml-4 text-muted\"><i class=\"far fa-clock mr-1\"></i>$date</small>
                                  
  
                                    </h6>
                                    <br>
                                    <h5 style=\"font-size: 0.95rem\">$title</h5>
                                    <p style=\"padding-top: 7px; font-size: 1.2rem\">$content</p>
                      
                                  </div>
                                </div>
                                
                                <form id ='s$token' method=\"POST\" style = \"margin-left: 7%\"  action='#' >
                                <input type=\"hidden\" name=\"t$token\" value=\"$idpb\">
                               
                          
                                <div class=\"add-items d-flex\">
                                  <input type=\"text\" required name=\"$token\" placeholder=\"Commenter\"class=\"form-control todo-list-input\" style=\"height:50px;width:450px;word-break:break-word; overflow: auto; border: 0; padding-bottom: 5px\">
                                  <button  class=\"btn btn-primary mr-2\" type=\"submit\" value=\"$token\" name=\"commenter\"><i class=\"fa fa-paper-plane \" ></i></button>
                                </div>
  
                                </form>
                                <div class='d-flex justify-content-around'>
                                <button type='button' class='btn btn-inverse-danger btn-fw'>
                                  Like 
                                  <i class='fa fa-heart'></i>
                                </button>
                                <button onclick='togglecommentws(\"$token\",\"b$token\")' id = \"$token\" type='button' class='btn btn-inverse-warning btn-fw'>
                                  Show comments <i class='fa fa-comment'></i></button>
                                
                              </div>
                          
                                <div  id= 'b$token' style='padding-top: 20px; display :none'>
                                 
                                  <ul  class=\"solid-bullet-list\">
  
                                  ".$viewComments."
  
                                  </ul>
                             
                                 
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>
                          </br>
                        
                       ";
          $viewComments="";
        }
  
              
          
      } ///////////////////////
      //*/
  
          //le cas de $_GET["all"] pour toutes les publications n'est pas nécessaire
  }
  }

include('classe.html');
?>
