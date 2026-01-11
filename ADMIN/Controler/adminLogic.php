<?php 
session_start();

include("../../HOME/Model/db.php");

$chceckQuery = "SELECT * FROM user_settings WHERE user_id = " . $_SESSION['user_id'];
$checkResult = mysqli_query($conn, $chceckQuery); 
$_SESSION['theme_mode'] = mysqli_fetch_assoc($checkResult)['theme_mode'];

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['theme-toggle'])) {
    if($_SESSION['theme_mode'] == 'light') {
        $updateThemeQuery = "UPDATE user_settings SET theme_mode = 'dark' WHERE user_id = " . $_SESSION['user_id'];
        mysqli_query($conn, $updateThemeQuery);
        $_SESSION['theme_mode'] = 'dark';
        

    } else {
        $updateThemeQuery = "UPDATE user_settings SET theme_mode = 'light' WHERE user_id = " . $_SESSION['user_id'];
        mysqli_query($conn, $updateThemeQuery);
        $_SESSION['theme_mode'] = 'light';

    }
}

header('Location: ../View/admin.php');
exit();

?>

