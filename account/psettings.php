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
                        $id_membre= $membre['ID_MEMBRE'];
                        $PDP=$membre['photo'];
                        $_SESSION['phone'] = $membre['TELEPHONE'];
                        $_SESSION['NATIONALITE'] =  $membre['NATIONALITE'];
            
                        $_SESSION['fullname'] = ucwords($membre['PRENOM'])." ".strtoupper($membre['NOM']);
                         }
                          if ($_SESSION['etat'] == "c")
                        {
                            $req_update1="UPDATE PROFESSEUR SET PPR='$ppr', DEPARTEMENT='$dept'";
                            $res_update1=$mysqli->query($req_update1);
                        }
                        else
                        {                      
$req_insert="INSERT INTO professeur VALUES ('$id_membre', '$ppr', '$dept')";
$res_insert=$mysqli->query($req_insert);
                      }
$req_update="UPDATE MEMBRE SET DATE_NAISSANCE='$birthdate', TELEPHONE='$tel', CIN='$cin', NATIONALITE='$nat', PSEUDONYME='$pseudo', ETAT='C' WHERE ID_MEMBRE=$id_membre";


$res_update=$mysqli->query($req_update);

$req_profile="SELECT * FROM MEMBRE WHERE EMAIL='$mail'";
$res_profile=$mysqli->query($req_profile);

while ($profile=$res_profile->fetch_assoc()){
  $photo="../assets/images/faces/".$profile['photo'];
  $fullname = ucwords($profile['PRENOM'])." ".strtoupper($profile['NOM']); 
}
if($mysqli){
  $_SESSION['etat'] = "c";
  $req_filiere="SELECT FILIERE FROM ETUDIANT WHERE ID_MEMBRE ='$id_membre'";
$res_f=$mysqli->query($req_filiere);
while ($f = $res_f->fetch_assoc())
{   
    $filiere = $f['FILIERE'];
    $_SESSION['cne'] = $f['CNE'];
    $_SESSION['appoge'] = $f['APOGEE'];
   
}
$_SESSION['filiere'] = $filiere;
$_SESSION['id_membre'] = $id_membre;
  $_SESSION["logged"]="success";
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


include('psettings.html');
?>
