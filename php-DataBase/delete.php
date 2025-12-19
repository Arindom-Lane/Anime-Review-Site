<?php
include("db.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $query = mysqli_query($con,"DELETE FROM applicants WHERE id=$id");
    
    if($query){
        header("Location: test.php?updated=1");
        exit();
    }
    else{exit();}}
?>
