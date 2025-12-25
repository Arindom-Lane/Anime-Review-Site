<?php 
session_start();    
include("db.php");

$result = mysqli_query($conn,"SELECT * FROM Users WHERE user_id = $id");



?>