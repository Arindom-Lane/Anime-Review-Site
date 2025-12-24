<?php
$username ="root";
$password = "";
$server = 'localhost';
$db = 'myanimelist';

$con = mysqli_connect($server, $username, $password, $db);

if ($con) {
} else {
    echo "could not connect!<br><br>";}
?>