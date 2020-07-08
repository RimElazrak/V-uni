<?php  
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
        $req_id_member="SELECT ID_MEMBRE from MEMBRE where email='$mail'";
        $resm=$mysqli->query($req_id_member);
        while($mmbre= $resm->fetch_assoc()){
            $id_membre= $mmbre['ID_MEMBRE'];
        }

        $req_insert1="INSERT INTO classe (NOM_CLASSE, DESC_CLASSE,code,SEMESTRE,ID_MEMBRE) VALUES ('$cname', '$desc','$cpw','$csem',$id_membre)";
        $res_insert1=$mysqli->query($req_insert1);
                
        if($mysqli){
             echo'<script> alert("Data saved !!"); </script>';
            header('Location: classe.php');
        }
        else{
            echo'<script> alert("ERROR : Data Not saved !!"); </script>';
        }
    
    } 
    


    //=================================================Joining class==================================================
    if(isset($_POST['getdata'])){
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
            $req_insert2="INSERT INTO class_joined (ID_MEMBRE,ID_CLASSE) VALUES ($id_membre, $id_classe)";
            $res_insert2=$mysqli->query($req_insert2);
 
            header('Location: classe.php');
        }
        //insert data into class joined table 

        //1- get idclasse 


    }


/*if($result2 = mysqli_query($mysqli, $req_insert)){
            if(mysqli_num_rows($result2) > 0){
                
                while($row = mysqli_fetch_array($result2)){
                        $id=$row[0];  
                        //$req_update="UPDATE Professeur SET ID_CLASSE='$id' WHERE ID_MEMBRE=$id_membre" ;
                        echo $id;
                        // we need if cl in classes_made is full goes to next one 
                        // if row[1] = null do this else row[2] ..
                        $req_cl="INSERT INTO classes_made (ID_MEMBRE,ID_CLASSE0) VALUES ($id_membre, $id)" ;
                        $res_cl=$mysqli->query($req_update);
                }
                mysqli_free_result($result2);
            }
            else{
                echo "Error" ;
            }
        }*/





    //PROB dial ila ajouta classe a5ra i9der itajouta m3ah id a5or so l7el huwa f inscriptio twad m3ah had l9adiya dial itajuta id dialo f classes made 
       // $req_insert2="INSERT INTO classes_made (ID_MEMBRE) VALUES ($id_membre)";
        //$res_insert2=$mysqli->query($req_insert2);

        
        // ====================== inserting classe id in classes made table========== 
        // Fetch id_classe
       /* $req_id="SELECT ID_CLASSE from CLASSE where ID_MEMBRE=$id_membre";
        $res=$mysqli->query($req_id);
        while($cl= $res->fetch_assoc()){
            $id_classe= $cl['ID_CLASSE'];
        }
        echo 'id classe is  ';echo $id_classe;
        //to insert id classes into table clases_made
        
        $query="SELECT * from classes_made where id_membre=$id_membre";
        $result = mysqli_query($mysqli, $query)
        while($row = mysqli_fetch_array($result)){
                $indice = 0;
                $success = false;
                for($i = 0; $i < 10; $i++)
                { 
                    if ($row[$i]==null)
                    {   $success = true;
                        break;
                    }
                    $indice = $indice+1;
                }
                $classe='ID_CLASSE'.$indice;
                $req_insert3="INSERT INTO classes_made ($classe) VALUES ($id_classe)";
                $res_insert3=$mysqli->query($req_insert3);

            }
        
       LIST OF CLASSES FOR NAV LINK
        
        while($list = mysql_fetch_array($res_list)) { //is it res list or req test on both
    //for
    $list_class="<li class=\"nav-item\"> <a class=\"nav-link\" href=\"classe.php\">";
     echo $list; 
    $list_class2="</a></li>";
 }
        
        
        


 $query="SELECT * from classes_joined where id_membre=$id_membre";
            $result = mysqli_query($mysqli, $query);
            
            while($row = mysqli_fetch_array($result)){
                    $indice = 0;
                    $success = false;
                    for($i = 0; $i < 10; $i++)
                    { 
                        if ($row[$i]==null)
                        {   $success = true;
                            break;
                        }
                        $indice = $indice+1;
                    }
                    $classe='ID_CLASSE'.$indice;
                    $req_insert3="INSERT INTO classes_joined ($classe) VALUES ($id_classe)";
                    $res_insert3=$mysqli->query($req_insert3);

            }
        */
} 

?>



