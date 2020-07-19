<?php
  session_start();                                                           
  if(isset($_SESSION["logged"])){                              
    
      $mysqli= new mysqli('127.0.0.1','root','','pfe');       // it will stock a big amount of posts
      $mail=$_SESSION["mail"];
    /*  $req_membre="SELECT ID_MEMBRE from MEMBRE where email='$mail'";
      $res=$mysqli->query($req_membre);
      while($membre= $res->fetch_assoc())
        {
          $id_membre= $membre['ID_MEMBRE'];
        
        }*/
        $role1 = $_SESSION["role"];
        $phone = $_SESSION['phone'];
        $natio = $_SESSION['NATIONALITE'];
        $id_membre = $_SESSION['id_membre'];
        if ($_SESSION['role'] == "s") {
        $cne = $_SESSION['cne'];
        $appoge = $_SESSION['appoge'];
        }
        else
        {
          $req_pro = "SELECT * FROM professeur WHERE ID_MEMBRE =$id_membre";
          $res_pro = $mysqli->query($req_pro);
          while($pro=$res_pro->fetch_assoc()) {
            $ppr = $pro['PPR'];
            $Departement = $pro['DEPARTEMENT'];
          }
          $cne = NULL;
          $appoge = NULL;
        }
    
      $req_profile="SELECT * FROM MEMBRE WHERE EMAIL='$mail'";
      $req_filiere="SELECT FILIERE FROM ETUDIANT WHERE ID_MEMBRE =$id_membre";
    
      $res_profile=$mysqli->query($req_profile);
      $res_filiere=$mysqli->query($req_filiere);
    
      while ($profile=$res_profile->fetch_assoc()){
          $photo="assets/images/faces/".$profile['photo'];
          $fullname = ucwords($profile['PRENOM'])." ".strtoupper($profile['NOM']); 
        }
        
      while ($f=$res_filiere->fetch_assoc()){                     
          $filiere = $f['FILIERE'];                                               //extraire nom de filiere a partir de la table ETUDIANT
        }
        
     
  }  
  include('myprofile.html');
?>
