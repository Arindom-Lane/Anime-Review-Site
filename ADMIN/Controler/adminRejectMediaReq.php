<?php

include("../../HOME/Model/db.php");
$id = $_GET["id"];
$delete = mysqli_query($conn,"DELETE FROM requestmedia WHERE id = '$id'");
        header("Location: ../View/admin.php");