<?php  

    $mysqli= new mysqli('127.0.0.1','root','','pfe');
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<?php
    $query = $_GET['query']; 
    // gets value sent over search form
        $req_search="SELECT * FROM membre WHERE (`Nom` LIKE '%".$query."%') OR (`Prenom` LIKE '%".$query."%' ) OR (`PSEUDONYME` LIKE '%".$query."%')";
        $res_search=mysqli_query($mysqli, $req_search);
        if ($res_search->num_rows>0){                       

            while($results = mysqli_fetch_array($res_search)){
                echo "<p><h3>".$results[1]."</h3>".$results[2]."</p>";

            }
        }
       
        else{ // if there is no matching rows do following
            echo "No results";
        }
         
   
?>
</body>
</html> 
