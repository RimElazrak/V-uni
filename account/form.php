<?php  
// formulaire d'ajout et rejoindre classe ***************
session_start();
if(isset($_SESSION["mail"]) || isset($_SESSION["role"])){

    $mysqli= new mysqli('127.0.0.1','root','','pfe');
    //  CREATING CLASS
    if(isset($_POST['insertdata'])){
        $cname=$_POST['cname'];
        $_SESSION["classe_name"]=$cname;
        $desc= $_POST['description'];
        $mail= $_SESSION['mail'];
    
        $csem= $_POST['csem'];
        $cpw= $_POST['cpw'];
        echo $mail;
        //fetch id member
        $url = $_SERVER['REQUEST_URI'];
        $req_id_member="SELECT ID_MEMBRE from MEMBRE where email='$mail'";
        
        $resm=$mysqli->query($req_id_member);
        while($mmbre= $resm->fetch_assoc()){
            $id_membre= $mmbre['ID_MEMBRE'];
        }
        $req_check_name = "SELECT * FROM classe WHERE NOM_CLASSE= '$cname'";
        $res_check = mysqli_query($mysqli, $req_check_name);
        if (mysqli_num_rows($res_check) == 0)
        {
        $req_insert1="INSERT INTO classe (NOM_CLASSE, DESC_CLASSE,code,SEMESTRE,ID_MEMBRE) VALUES ('$cname', '$desc','$cpw','$csem',$id_membre)";
        $res_insert1=$mysqli->query($req_insert1);
        }       
        if($mysqli){
             echo'<script> alert("Data saved !!"); </script>';
            header('Location: classe.php?test1='.$cname);
        }
        else{
            echo'<script> alert("ERROR : Data Not saved !!"); </script>';
            header('location : '.$url);
        
        }
    
    } 
    


    //=================================================Joining class==================================================
    if(isset($_POST['getdata'])){
        $cname= $_POST['cname'];
        $pw= $_POST['cpw'];
        $_SESSION["classe_name"]=$cname;
        $mail= $_SESSION['mail'];
        $url =  $_SERVER['HTTP_REFERER'];
        $req_id_member="SELECT ID_MEMBRE from MEMBRE where email='$mail'";
        $resm=$mysqli->query($req_id_member);
        while($mmbre= $resm->fetch_assoc()){
            $id_membre= $mmbre['ID_MEMBRE'];
        }
        //check if lass exists if it does redirect OR CHECK WITH IDCLASSE
        
        $req_classe_info="SELECT * FROM classe WHERE NOM_CLASSE='$cname' AND code='$pw' LIMIT 1" ;
        //fetch the id classe
        $res_classe_info=$mysqli->query($req_classe_info);
        while($clid= $res_classe_info->fetch_assoc()){
            $id_classe= $clid['ID_CLASSE'];
        }
        
        // no classe found i e 0 lines returned
        if ($res_classe_info->num_rows==0){                       
            echo'<script> alert("Classe name or password incorrect !!!"); </script>';
            //header('Location: profile.php');
            header('location : '.$url);
        }
        else{
            // inserting into classes_joined 
            $req_insert2="INSERT INTO class_joined (ID_MEMBRE,ID_CLASSE,nom_classe) VALUES ($id_membre, $id_classe, '$cname')";
            $res_insert2=$mysqli->query($req_insert2);
 
            header('Location: classe.php?test1='.$cname);
        }
     

    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // --------------------------------------- publie------------------------------//
    if (isset($_POST["publier"])){   
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
    
        $req_pub = "INSERT INTO publication VALUES (NULL, '$contenu', '$titre','$current', '$id_membre','1', NULL)";         //we are in a branch page, new posts will be in that selected branch
        $res_pub = $mysqli->query($req_pub);
    
      
        if($mysqli){
          
           header('Location: ../profile.php?idfiliere=1 ');
       }
    }
} 


?>



