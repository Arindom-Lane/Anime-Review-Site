<?php
session_start();
include("db.php");
$media_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Media Page - MyAnimeList</title>
    <link rel="stylesheet" href="MediaPage.css">
</head>
<body>
    <header>
        <div class="header-upper">
            <div class="logo">LOGO</div>
            <div class="profile">User Profile</div>
        </div>
        <div class="header-middle">
            <span>TOP ANIME</span>
        </div>
        <div class="header-lower">
            <span>Media Title Placeholder</span>
        </div>
    </header>
    <main>
    </main>
</body>
</html>