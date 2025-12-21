<?php
$username ="root";
$password = "";
$server = 'localhost';
$db = 'myanimelist';

try{
    $conn = mysqli_connect(
    $server, 
    $username, 
    $password,
    $db);
}
catch(Exception $e){
    echo "<br>could not connect!<br><br>";
}
?>