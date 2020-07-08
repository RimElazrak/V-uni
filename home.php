<!--                        THIS IS THE LOGGING IN PAGE          -->

<?php
    session_start();
    if (isset($_POST["login"])){                        //clicking on login button
    
    $mail=$_POST["mail"];
    $pw=$_POST["pw"];
    $mysqli= new mysqli('127.0.0.1','root','','pfe');
    $req_login="SELECT * FROM MEMBRE WHERE EMAIL='$mail' AND PWD='$pw' LIMIT 1" ;
    $res_login=$mysqli->query($req_login);
    if ($res_login->num_rows==0){                       // no user found from 0 lines returned
        echo'<script> alert("Utilisateur non trouvé !!!"); </script>';
    }
    else
    {
        $_SESSION["mail"]=$mail;
        $_SESSION["logged"]="success";

         //$check="SELECT * FROM MEMBRE WHERE EMAIL='$mail' LIMIT 1";
         //$res_check=$mysqli->query($check);
         while ($membre=$res_login->fetch_assoc()){
            $etat= $membre['etat'];                  //etat and role are columns in the MEMBRE table. etat stands for the state of the account.
            $role= $membre['role'];                   //role stands for the role of the member, which could be a professor or a student.
            $_SESSION["role"]=$role;
            if ($etat=="I" && $role=="p")                //I for incomplete, C for complete. 
                header('Location: account/psettings.php');         //p for professor, , s for student.
            if ($etat=="I" && $role=="s")
                header('Location: account/settings.php');
            if ($etat=="C" && $role=="p")
                //classe 
                header('Location: account/filieres.php');                
            if ($etat=="C" && $role=="s")
                header('Location: account/filieres.php');
         }
    }       
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/img/VUNI-icon.png">

    <title>Welcome to V-UNI</title>
     <style type="text/css" >
     <?php 
         include 'assets/css/homepagestyle.css';
      ?>
     
     <?php 
        include 'assets/bootstrap/css/bootstrap.min.css';
     ?>
     </style>

</head>
<body style="background-color:  #EEEEEE;" >  
    <?php 
        include 'Menu2.php';
    ?>
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row">
                
                <!-------------------------------------------->
                <div class="col-5" id = "vuni">
                    <div class="row">
                        <img src="assets/img/Group4.svg" alt="VUNI" >
                    </div>
                        <!------------------------------------------->
                    <div class="row">
                        <div class="col-md-7" id="hello">
                            <form  action="#" method="post">
                                <input type="text" name="mail" placeholder="Adresse mail" />
                                <input type="password" name="pw" placeholder="Mot de passe" />
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input">
                                          Keep me signed in
                                        <i class="input-helper"></i></label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>
                                <input type="submit" name="login" value="Login" />
                                
                                <div style="font-weight: 500 !important; text-align: center !important;" >
                                  Don't have an account? 
                                  <a href="signup.php" style=" color: #f7b924 !important;">Create</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                      <!----------------------------------------------->
                <div class=" hidden-lg-down" id= "pic">
                    <img src="assets/img/photo.svg" alt="">
                </div>

                  <!--    <div class="row">
                    <div class="col-xs-8" id ="2ndorw">
                        <div class = "col-sm-7" id="form">
                          
                        </div >
                         
                    </div>
                      </div> -->
                <!---------- right img----------------------->
                
                  <div class="row" id = "pic">
                </div>
            </div>
        </div>
    </div>
</body>
</html>