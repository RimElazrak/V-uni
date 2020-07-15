<?php
session_start();

if(isset($_SESSION["logged"]) && isset($_GET["id"])){
  
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
  $postupdate=$_GET["id"];                      //id de la pub qui va etre modifiee
  $req_toUpdate="SELECT * FROM publication where ID_PUB='$postupdate'";
  $res_toUpdate=$mysqli->query($req_toUpdate);

  while($temp=$res_toUpdate->fetch_assoc()){                             //recuperer anciennes donnees de la pub afin qu'elles soient affichees
      $pubContent=$temp['CONTENU_PUB'];
      $pubTitle=$temp['TITRE_PUB'];
      $visiblePour=$temp['visibilite'];
  }
if (isset($_POST["update"])){
    $newtitle=$_POST["titre"];
    $newcontent=$_POST["contenu"];
    $newvisib=$_POST["visibilite"];
    $now = DateTime::createFromFormat('U.u', microtime(true));
    $current= $now->format("Y-m-d H:i:s");

    
    $req_update="UPDATE publication SET CONTENU_PUB='$newcontent', TITRE_PUB='$newtitle', DATE_PUB='$current', visibilite='$newvisib'  where ID_PUB='$postupdate'";
    $res_update=$mysqli->query($req_update);
    if ($res_update)
    echo "<SCRIPT>alert('Changement effectué');document.location='publications.php';</SCRIPT>";
    else
    echo "<SCRIPT>alert('Something's wrong');</SCRIPT>";
}

}
else {

    header('Location: ../home.php');
}
include('updatepost.html');
?>
