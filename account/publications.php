<?php
session_start();

if(isset($_SESSION["logged"])){
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
  $viewPublication="";
  $mysqli= new mysqli('127.0.0.1','root','','pfe');
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
  $res_classe=$mysqli->query($req_classe);

  while ($profile=$res_profile->fetch_assoc()){
      $photo="images/faces/".$profile['photo'];
      $fullname = ucwords($profile['PRENOM'])." ".strtoupper($profile['NOM']);   
    }
    
  while ($f=$res_filiere->fetch_assoc()){                     
      $filiere = $f['FILIERE'];                           //extraire nom de filiere a partir de la table ETUDIANT
    }
    $req_idfiliere="SELECT ID_FILIERE FROM FILIERE WHERE nom='$filiere'";           //recuperer id a partir de la requete precedente 
    $res_idfiliere=$mysqli->query($req_idfiliere);
    while ($idf=$res_idfiliere->fetch_assoc()){
      $id_filiere=$idf['ID_FILIERE'];
    
    }
  while ($cl = $res_classe->fetch_assoc()){
    $classe=$cl['ID_CLASSE'];
  }


  if(isset($_GET["id"]) && isset($_GET["action"])){                 //pour modifier ou supprimer une publication
    if($_GET["action"]=='update'){
      echo "this post ".$_GET["id"]." will be deleted";

    }
    if($_GET["action"]=='delete'){
     $tobeDeleted = $_GET["id"];
     $verifyMember="SELECT ID_MEMBRE FROM publication where ID_PUB='$tobeDeleted' LIMIT 1 ";            //limit to one post bc the user can have more than one post
      $res_verifyMember=$mysqli->query($verifyMember);
      while ($member_to_delete_post=$res_verifyMember->fetch_assoc())
      {
        $THEmember = $member_to_delete_post['ID_MEMBRE'];
      }
          
      if ($THEmember==$id_membre){
          $req_deletePost = "DELETE FROM publication WHERE ID_PUB='$tobeDeleted' ";

          $res_deletePost=$mysqli->query($req_deletePost);
          if($res_deletePost){

            echo "<SCRIPT>alert('DELETED SUCCeSSFULLY');document.location='publications.php';</SCRIPT>";

          }
        }
        else 
        echo "<SCRIPT>alert('YOU CANNOT DELETE THE POST BECAUSE YOU ARE NOT ITS OWNER');document.location='publications.php';</SCRIPT>";
    }
  }


    
        $displaypub="SELECT * from pubview, publication where publication.ID_PUB=pubview.ID_PUB and publication.ID_MEMBRE='$id_membre'";// 11 (classe) , 12 (Filiere)
            $res_displaypub=$mysqli->query($displaypub);
              
            while ($displaypubID=$res_displaypub->fetch_assoc()){ // 2 fois

              $idpb=$displaypubID['ID_PUB']; //=11
              $idm=$displaypubID['ID_MEMBRE'];
              $idf=$displaypubID['ID_FILIERE'];

              $req_pubs="SELECT * from publication where ID_PUB='$idpb' ";// result 1
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
                                          <a href=\"publications.php?id=$idpb&action=delete\" style=\"text-decoration:none; font-family: inherit; font-weight: inherit\">Supprimer la publication</a>  || 
                                          <a href=\"updatepost.php?id=$idpb\" style=\"text-decoration:none; font-family: inherit; font-weight: inherit\">Modifier la publcation</a> 
                                        </div>
                                        
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div> ";

              }
 

}
else {

    header('Location: ../home.php');
}
include('publications.html');
?>
