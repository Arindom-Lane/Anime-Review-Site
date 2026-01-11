<?php
include("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $userCheck = mysqli_query($conn,"SELECT role FROM users WHERE user_id = '$id'");
    if($userCheck){
        $userData = mysqli_fetch_assoc($userCheck);
        if($userData['role'] === 'admin'){
            echo "<script>alert('Cannot delete admin users!'); window.location.href='admin.php';</script>";
            exit();
        }
    }
    $query = mysqli_query($conn, "DELETE FROM `users` WHERE user_id = '$id'");
    if ($query) {
        header("Location: admin.php");
    } else {
        echo "<script>alert('ERROR!');</script>";
    }
}
