<?php 

include("../../HOME/Model/db.php");
$id = $_GET["id"];
$result = mysqli_query($conn,"SELECT * FROM requestmedia WHERE id = '$id'");

$row = mysqli_fetch_array($result);

$mediaQuery = mysqli_query($conn, "INSERT INTO `media`( `title`, `description`, `poster_image_link`, `score`, `type`, `studio`, `source`) VALUES ('".$row['title']."','".$row['description']."','".$row['poster_image_link']."','".$row['score']."','".$row['type']."','".$row['studio']."','".$row['source']."')");
$delete = mysqli_query($conn,"DELETE FROM requestmedia WHERE id = '$id'");
        header("Location: ../View/admin.php");
?>