<?php
    session_start();
    
 if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
    header('Location: login.php');
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="UserEditProfile.css">    
</head>
<body>
    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='home.php'">
                <img src="https://cdn.myanimelist.net/images/mal-logo-xsmall.png?v=1634263200">
            </div>
            <div class="profile">
                <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true): ?>
                <div class="devider1"></div>
                <span class="profile-name">
                    <?php echo $_SESSION['username']; ?>
                </span>
                <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile">
                <?php endif; ?>
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
            <span>Edit Profile</span>
            <img src="https://cdn-icons-png.freepik.com/512/14911/14911421.png" alt="Menu">
        </div>
    </header>
    <main>
        <form method="POST">
        <div class="feild">
            <label>Change User Name</label>
            <input type="text" name="username" required>
            <button type="submit" name="btn-create" class="btn-create-name">Edit</button>
        </div>
        
        <div class="feild">
            <label>Change Password</label>
            <input type="password"name="password" minlength="8" placeholder="minimum 8 character" required>
            <button type="submit" name="btn-create" class="btn-create-name">Edit</button>
        </div>
        <div class="feild">
            <label>Change Profile Image URL</label>
            <input type="text" name="profileImage" required>
            <button type="submit" name="btn-create" class="btn-create-name">Edit</button>
            
        </div>
        <div class="feild">
            <label>Change Email</label>
            <input type="text" name="email" required>
            <button type="submit" name="btn-create" class="btn-create">Edit</button>
        
        
    </form>
    </main>

    