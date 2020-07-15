<!---                       THIS IS THE ACCOUNT CREATION PAGE. IT IS FOR BOTH STUDENTS AND PRFESSORS            -->

<?php
session_start();
$success="";
$secret="";
if(isset($_POST["register"])){                  //if user clicks on sign up button

$nom= $_POST["nom"];
$prenom= $_POST["prenom"];
$mail = $_POST["mail"];
$pw=$_POST["pw"];

$role=$_POST["role"];
$_SESSION["role"]=$role;
$mysqli= new mysqli('127.0.0.1','root','','pfe');
$req_register="INSERT INTO membre  VALUES (NULL, '$nom', '$prenom', NULL, '$mail', '$pw', NULL, NULL, NULL, NULL, '$role','I','profile.png')";
                    //profile.png is the default profile picture, just like Facebook's very own blank face picture.

if ($role=="s"){                                //redirecting to students' registration page
    $res=$mysqli->query($req_register);
    if ($res){
    $_SESSION["mail"]=$mail;                
    header('Location: account/settings.php');
   // $success= '<script type="text/javascript">window.onload = JSalertsuccess();
    
    }
        else
    $success= '<script type="text/javascript">window.onload = JSalerterror();</script>';
}
if ($role=="p"){                                //redirecting to professors' registration page
    $res=$mysqli->query($req_register);
    if ($res){
    $_SESSION["mail"]=$mail;
    header('Location: account/psettings.php');
   // $success= '<script type="text/javascript">window.onload = JSalertsuccess();
    
    }
        else
    $success= '<script type="text/javascript">window.onload = JSalerterror();</script>';
}


if ($role!="s" && $role!="p"){

    $success= '<script type="text/javascript">window.onload = JSalerterror();</script>';
    
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Started with V-UNI</title>
 	<style type="text/css" >	
     <?php
         include 'assets/css/homepagestyle.css'; 
     ?>
    <?php
         include 'assets/bootstrap/css/bootstrap.min.css';
    ?>
    <?php
    	include 'assets/css/main.css';
    ?>
 	 </style>
  <script src="https://www.jquery-az.com/javascript/alert/dist/sweetalert-dev.js"></script>
  <link rel="icon" type="image/png" href="VUNI-logo.png">

  <link rel="stylesheet" href="https://www.jquery-az.com/javascript/alert/dist/sweetalert.css">
  <script type="text/javascript">
</script> <script type="text/javascript">
function JSalertsuccess(){
	swal("Terminé!", "Votre compte a été crée", "success");
}
function JSalerterror(){
	swal("Erreur!", "Erreur rencontrée", "error");
}</script>
</head>
<body style="background-color:  #EEEEEE;">     
    <?php 
        include 'assets/menu.php';
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
                        <!-- <div style="color:red; text-align:center; font-weight:bold;"><?php echo $success;?></div>-->
                            <div class="col-md-5" id="hello">
                                <form  action="#" method="post">
                                    <input type="text" name="nom" placeholder="First name" required />
                                    <input type="text" name="prenom" placeholder="Last name" required/>
                                    <input type="email" name="mail" placeholder="Mail" required/>
                                    <input type="password" name="pw" placeholder="Password" required/>
                                    <!--think about typing the password twice -->
                                    <select name="role" id="select_role" required>
                                        <option value="">choose your title</option>
                                        <option value="p">Professor</option>
                                        <option value="s">Student</option>
                                    </select>
                                    <input type="submit" name="register" value="Sign Up" />
                                    <p style= "margin-top:10px">Already a member? Log in <a href="home.php">here</a></p>
                                   
                                </form>
                            </div>

                        </div>
                    </div>
                      <!----------------------------------------------->
                      <div class=" hidden-lg-down" id= "pic">
                             <img src = "assets/img/p.svg">
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