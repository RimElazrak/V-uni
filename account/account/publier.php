<?php  
session_start();
if(isset($_SESSION["mail"]) || isset($_SESSION["role"])){

    $mysqli= new mysqli('127.0.0.1','root','','pfe');
    //  CREATING CLASS
  /*  if(isset($_POST['insertdata'])){
        $cname=$_POST['cname'];
        $_SESSION["classe_name"]=$cname;
        $desc= $_POST['description'];
        $mail= $_SESSION['mail'];
    
        $csem= $_POST['csem'];
        $cpw= $_POST['cpw'];
        echo $mail;
        //fetch id member

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
            header('Location: classe.php');
        }
        else{
            echo'<script> alert("ERROR : Data Not saved !!"); </script>';
        }
    
    } */
    


    //=================================================Joining class==================================================
   /* if(isset($_POST['getdata'])){
        $cname= $_POST['cname'];
        $pw= $_POST['cpw'];
        $_SESSION["classe_name"]=$cname;
        $mail= $_SESSION['mail'];
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
        }
        else{
            // inserting into classes_joined 
            $req_insert2="INSERT INTO class_joined (ID_MEMBRE,ID_CLASSE,nom_classe) VALUES ($id_membre, $id_classe, '$cname')";
            $res_insert2=$mysqli->query($req_insert2);
 
            header('Location: classe.php');
        }
        //insert data into class joined table 

        //1- get idclasse 


    }*/
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
        $id_filiere = $_GET['id_f'];
        $req_pub = "INSERT INTO publication VALUES (NULL, '$contenu', '$titre','$current', '$id_membre','$id_filiere', NULL)";         //we are in a branch page, new posts will be in that selected branch
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
          
           header('Location: ../profile.php?idfiliere= '.$id_filiere );
       }
    }
    //************************************************ posting comments ******************************* */
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
      if($mysqli){
          
        header('Location: ../profile.php?idfiliere= '.$id_filiere );
    }
     
      
    }

} 


?>



