<?php
include("db.php");
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = mysqli_query($conn, "DELETE FROM `trailers` WHERE trailers_id = '$id'");
    if ($query) {
        $_SESSION['DeleteMediaSuccess'] = "deleted";
        header("Location: admin.php");
    } else {
        $_SESSION["DeleteMediaSuccess"] = "error";
        echo "<script>alert('ERROR!');</script>";
    }
}
