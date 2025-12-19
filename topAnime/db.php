<?php
$username ="root";
$password = "";
$server = 'localhost';
$db = 'myanimelist'; // Ensure your database name is 'myanimelist'

try {
    $con = mysqli_connect($server, $username, $password, $db);
}
catch(Exception $e) {
    echo "Could not connect to database!<br><br>";
}
?>