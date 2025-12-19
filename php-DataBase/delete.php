<?php
include("db.php");

if(isset($_POST['delete'])){
    setcookie('d_Id',$_POST['id'],time()+3600);
    $id =$_COOKIE['d_ID'];

    $result = mysqli_query($conn,'DELETE FORM applicants WHERE id=$id');

    if($result){
        header('Location: test.php?deleted=1');
        exit;
    }
    else{
        echo'Error deleting: '.mysqli_error($con);
    }
}
?>
