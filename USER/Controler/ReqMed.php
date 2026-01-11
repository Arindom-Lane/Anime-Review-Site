<?php
    session_start();
    include("db.php");

 if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
    header('Location: login.php');
 }
 
 if(isset($_SESSION['CreateError']) && $_SESSION['CreateError'] == true){
    echo '<script>alert("Media Creation Error!");</script>';
    $_SESSION['CreateError'] = false;
}

?>
