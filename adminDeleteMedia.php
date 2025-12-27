<?php 
    include("db.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = mysqli_query($conn,"DELETE FROM `media` WHERE media_id = '$id'");
        if($query){
            header("Location: admin.php");
        }
            else{echo "<script>alert('ERROR!');</script>";
            }
    }
?> 