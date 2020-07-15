<?php 
  session_start();
    //======================= standard PHP FOR PAGE : USER DATA =================================

  $mysqli= new mysqli('127.0.0.1','root','','pfe');      
  $mail=$_SESSION["mail"];
  //$req_membre="SELECT ID_MEMBRE from MEMBRE where email='$mail'";
  $req_login="SELECT * FROM MEMBRE WHERE EMAIL='$mail'" ;
  $res=$mysqli->query($req_login);
  while($membre= $res->fetch_assoc())
  {
    $id_membre= $membre['ID_MEMBRE'];
    $role = $membre['role'];
  
  }
  $req_profile="SELECT * FROM MEMBRE WHERE EMAIL='$mail'";
  $req_filiere="SELECT FILIERE FROM ETUDIANT WHERE ID_MEMBRE ='$id_membre'";
  
  $res_profile=$mysqli->query($req_profile);
  $res_filiere=$mysqli->query($req_filiere);

  while ($profile=$res_profile->fetch_assoc()){
    $photo="../assets/images/faces/".$profile['photo'];
    $fullname = ucwords($profile['PRENOM'])." ".strtoupper($profile['NOM']);   
  }
//role
//======================= CUSTOM PHP FOR PAG = Classe info =====================================
  
if (isset($_GET["test1"]))
$cl = $_GET["test1"];
else if (isset($_SESSION['classe_name']))
  $cl=$_SESSION['classe_name'];
else
  $cl = NULL;

//fetch class ID CLASSE
$req_id="SELECT ID_CLASSE from CLASSE where NOM_CLASSE='$cl'";   
$res=$mysqli->query($req_id);
while($k= $res->fetch_assoc()){
  $id_classe= $k['ID_CLASSE'];
 
}

$req_desc="SELECT DESC_CLASSE FROM CLASSE WHERE NOM_CLASSE='$cl'";
$req_sem="SELECT SEMESTRE FROM CLASSE WHERE NOM_CLASSE='$cl'";

$res_desc=$mysqli->query($req_desc);
$res_sem=$mysqli->query($req_sem);

while ($desc=$res_desc->fetch_assoc()){
  $description = $desc['DESC_CLASSE'];   
}
   //extraire SEMESTRE a partir de la table CLASSE
while ($fs=$res_sem->fetch_assoc()){                     
  $sem = $fs['SEMESTRE'];                   
}

// EXTRAIRE LES ID CLASSE creer par le membre
//$req_list="SELECT * FROM CLASSE GROUP BY ID_CLASSE, ID_MEMBRE having ID_MEMBRE=$id_membre";  
// $req_list="SELECT ID_CLASSE FROM CLASSE WHERE ID_MEMBRE=$id_membre";
// $res_list=$mysqli->query($req_list);
include('nav_account.html');

?>



