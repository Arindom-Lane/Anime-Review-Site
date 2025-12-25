<?php
    session_start();
    
 if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
    header('Location: login.php');
 }
 elseif($_SESSION['role']=='registered'){
    header('Location: home.php');
 }
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">  
</head>
<body>
    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='home.php'">
                <img src="https://cdn.myanimelist.net/images/mal-logo-xsmall.png?v=1634263200">
            </div>
            <div class="profile">
                <a href="destorySession.php" class="login-link-Log-out">Log Out</a>
            </div>
        </div>
        <div class="header-middle">
            <div class="topButton">
                <span>TOP ANIME</span>
                <span>TOP MANGA</span>
            </div>
            <div class="search-bar">
                <input class="search" type="text" placeholder="Search...">
            </div>
        </div>
        <div class="header-lower">
            <span>UPDATE MEDIA</span>
            <img src="https://cdn-icons-png.freepik.com/512/14911/14911421.png" alt="Menu">
        </div>
    </header>
</body>
</html>