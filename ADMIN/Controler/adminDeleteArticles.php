<?php
include("../../HOME/Model/db.php");

session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = mysqli_query($conn, "DELETE FROM `articles` WHERE articles_id = '$id'");
    if ($query) {
        $_SESSION['DeleteMediaSuccess'] = "deleted";
        header("Location: ../View/admin.php");
    } else {
        $_SESSION["DeleteMediaSuccess"] = "error";
        echo "<script>alert('ERROR!');</script>";
    }
}
