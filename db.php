<?php
$username = "root";
$password = "";
$server = 'localhost';
$db = 'myanimelist';

$conn = mysqli_connect($server, $username, $password, $db);

if ($conn) {
} else {
    echo "could not connect!<br><br>";
}
