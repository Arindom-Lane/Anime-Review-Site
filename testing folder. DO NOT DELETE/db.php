<?php
$username ="root";
$password = "";
$server = 'localhost';
$db = 'crud';

try{
    $con = mysqli_connect(
    $server, 
    $username, 
    $password,
    $db);
}
catch(Exception $e){
    echo "could not connect!<br><br>";
}
?>