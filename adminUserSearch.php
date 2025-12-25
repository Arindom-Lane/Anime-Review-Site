<?php 
session_start();
include("db.php");

$q = $_GET['q'];
$result = mysqli_query($conn,"SELECT user_id, username FROM Users WHERE username LIKE '%$q%' limi 10");

while ($row = mysqli_fetch_array($result)) {
    echo "<div onclick='adminGetUser.php(".$row['user_id'].")'>".$row['username']."</div>";

}
?>