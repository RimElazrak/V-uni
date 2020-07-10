<?php
session_start();

    unset($_SESSION["mail"]);
    unset($_SESSION["logged"]);
    session_unset();

// destroy the session
session_destroy();
    //header("Location: ../home.php");
    header('location: http://localhost/pfe2/home.php', true, 307);
  
?>