<?php  
session_start();
if(isset($_SESSION["mail"]) || isset($_SESSION["role"])){

    $mysqli= new mysqli('127.0.0.1','root','','pfe');
   
    // --------------------------------------- posting in f------------------------------//
    if (isset($_GET['id_f']))
      $id_filiere = $_GET['id_f'];
    if (isset($_POST["fpublier"])){   
        $mail=$_SESSION["mail"];
        $req_membre="SELECT ID_MEMBRE from MEMBRE where email='$mail'";
        $res=$mysqli->query($req_membre);
        while($membre= $res->fetch_assoc())
          {
            $id_membre= $membre['ID_MEMBRE'];
          }              
        $contenu=$_POST["contenu"];
        //$visibilite=$_POST["visibilite"];
        $titre=$_POST["titre"];
        $now = DateTime::createFromFormat('U.u', microtime(true));
        $current= $now->format("Y-m-d H:i:s");
        
        $req_pub = "INSERT INTO publication VALUES (NULL, '$contenu', '$titre','$current', '$id_membre','$id_filiere', NULL)";         //we are in a branch page, new posts will be in that selected branch
        $res_pub = $mysqli->query($req_pub);
    
        if($mysqli){
          
           header('Location: ../profile.php?idfiliere= '.$id_filiere );
       }
    }
    //************************************************ posting comments in f ******************************* */

/////////////////////// posting in class //////////////////////// 
    if (isset($_POST["cpublier"])){   
      $mail=$_SESSION["mail"];
      $req_membre="SELECT ID_MEMBRE from MEMBRE where email='$mail'";
      $res=$mysqli->query($req_membre);
      while($membre= $res->fetch_assoc())
        {
          $id_membre= $membre['ID_MEMBRE'];
        }              
      $contenu=$_POST["contenu"];
      //$visibilite=$_POST["visibilite"];
      $titre=$_POST["titre"];
      $now = DateTime::createFromFormat('U.u', microtime(true));
      $current= $now->format("Y-m-d H:i:s");
     // $id_filiere = $_GET['id_f'];
     $cname = $_SESSION['class_name'];
      $req_cid = "SELECT ID_CLASSE FROM CLASSE WHERE NOM_CLASSE='$cname'";
      $res_cid = $mysqli->query($req_cid);
      while($C= $res_cid->fetch_assoc())
      {
        $id_classe1= $C['ID_CLASSE'];
      }  
      $req_pub = "INSERT INTO publication VALUES (NULL, '$contenu', '$titre','$current', '$id_membre',NULL,'$id_classe1' )";         //we are in a branch page, new posts will be in that selected branch
      $res_pub = $mysqli->query($req_pub);
  
    /*  $req_idpub = "SELECT ID_PUB FROM publication where ID_MEMBRE='$id_membre' order by DATE_PUB desc LIMIT 1";    //recuperer une seule et derniere pub
      $res_idpub=$mysqli->query($req_idpub);
      while ($pb=$res_idpub->fetch_assoc())
      {
         $id_publication=$pb['ID_PUB'];
      }*/
      //header("location : profile.php?idfiliere=1");
        // pubview ma khdamach
    /*  $req_pubView="INSERT INTO pubview (id_pub,id_membre,id_classe,id_filiere) VALUES('$id_publication', '$id_membre', NULL, '$filiere_id')";
      $res_pubView=$mysqli->query($req_pubView);*/
      if($mysqli){
       
        
         header('Location: ../classe.php?test1='.$cname );
     }
 
}
} 


?>



