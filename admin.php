<?php
    session_start();
    
 if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
    header('Location: login.php');
 }
 elseif($_SESSION['role']=='registered'){
    header('Location: home.php');
 }
 
 if($_SESSION['CreateError'] == true){
    echo '<script>alert("Media Creation Error!");</script>';
    $_SESSION['CreateError'] = false;
}

 
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
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
            <span>Welcome <?PHP echo $_SESSION['username'];?></span>
            <img src="https://cdn-icons-png.freepik.com/512/14911/14911421.png" alt="Menu">
        </div>
    </header>

    <main>
        <div class="leftSection">
            <div class="leftSide-Container">
                <div class="proImage-container">
                    <img src="<?PHP echo $_SESSION['profileImage']; ?>">
                </div>
                <div class="sidebar-row">
                        <span>ROLE</span>
                        <span class="status-online" style="color: red;">SITE ADMIN</span>
                </div>
                <div class="sidebar-row">
                        <span>STATUS</span>
                        <span class="status-online" style="color: GREEN;">ONLINE</span>
                </div>
                <div class="editProfile">
                    <a href="wdad" class="editProfileHREF">Edit Profile</a>
                </div>
            </div>
        </div>


        <div class="rightsection">

        <div>
            
        </div>
            
            <div class="admin-box">
                <h2 class="main-header">Create Media</h2>
                <div class="media-overview">
                    <form method="POST" action="adminCreate.php">
                       <input name="title" placeholder="Title">
                        <select name="type">
                            <option value="movie">Movie</option>
                            <option value="tbshow">TV Show</option>
                            <option value="manga">Manga</option>
                        </select>
                        <input name="poster" placeholder="Poster URL" class="Poster">
                        <input name="studio" placeholder="Studio" class="Studio">
                        <input name="producer" placeholder="Producer" class="Producer">
                        <input name="genre" placeholder="Genre" class="Genre">
                        <input name="duration" placeholder="Duration" class="Duration">
                        <input name="source" placeholder="Source" class="Source">
                        <textarea name="description" placeholder="Description. HTMl syntax (Optional)" class="Description"></textarea>
                        <button type="submit" class="admin-save">Save Media</button> 
                    </form>
                </div>
            </div>
            <div class="admin-box">
                <h2 class="main-header">User Management</h2>
                <input type="text" placeholder="type user name" class="adminFindsUser">
                <button class="admin-save">Look Up</button>
                
            </div>
            <div class="admin-box">
                <h2 class="main-header">Create Media</h2>
                <div class="media-overview">
                    <form method="POST">
                       <input placeholder="Title">
                        <select>
                            <option>Movie</option>
                            <option>TV Show</option>
                            <option>Manga</option>
                        </select>
                        <input placeholder="Poster URL" class="Poster">
                        <input placeholder="Studio" class="Studio">
                        <input placeholder="Producer" class="Producer">
                        <input placeholder="Genre" class="Genre">
                        <input placeholder="Duration" class="Duration">
                        <input placeholder="Source" class="Source">
                        <textarea placeholder="Description" class="Description"></textarea>
                        <button type="submit" class="admin-save">Save Media</button> 
                    </form>
                </div>
            </div>
            

            
            
        <script src="userDashboard.js"></script>
    </main>
</body>
</html>
