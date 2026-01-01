<?php
    session_start();
    include("db.php");

 if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
    header('Location: login.php');
 }
 
 if(isset($_SESSION['CreateError']) && $_SESSION['CreateError'] == true){
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
    <link rel="stylesheet" href="searchBar.css">
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
<div class="search-bar">
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <form method="POST">
                    <input class="search" id="search" type="text" name="search" placeholder="Search...">
                </form>
                <div class="search-results" id="search-results">
                   
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('#search').on('input', function() {
                        var query = $(this).val();
                        if (query.length > 2) {
                            $.ajax({
                                url: 'searchBarLogic.php',
                                method: 'POST',
                                data: {
                                    search: query
                                },
                                success: function(data) {
                                    $('#search-results').html(data).show();
                                }
                            });
                        } else {
                            $('#search-results').hide();
                        }
                    });
                });
            </script>            </div>
        </div>
        <div class="header-lower">
            <span>Welcome <?php echo $_SESSION['username'];?></span>
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
                        <span class="status-online" style="color: Green;">Registered User</span>
                </div>
                <div class="sidebar-row">
                        <span>STATUS</span>
                        <span class="status-online" style="color: GREEN;">ONLINE</span>
                </div>
                <div class="editProfile">
                    <a href="UserEditProfile.php" class="editProfileHREF">Edit Profile</a>
                </div>
            </div>
        </div>

        <div class="rightsection">

        
        <div class="admin-box">
            <h2 class="main-header">Create Media</h2>
            <div class="media-overview">
                <form method="POST" action="adminCreate.php">
                   <input name="title" placeholder="Title">
                    <select name="type">
                        <option value="movie">Movie</option>
                        <option value="tvshow">TV Show</option>
                        <option value="manga">Manga</option>
                    </select>
                    <input name="poster" placeholder="Poster URL" class="Poster">
                    <input name="studio" placeholder="Studio" class="Studio">
                    <input name="producer" placeholder="Producer" class="Producer">
                    <input name="genre" placeholder="Genre" class="Genre">
                    <input name="duration" placeholder="Duration" class="Duration">
                    <input name="source" placeholder="Source" class="Source">
                    <textarea name="description" placeholder="Description. HTMl syntax (Optional)" class="Description"></textarea>
                    <button type="submit" class="admin-save">Request Access</button> 
                </form>
            </div>
        </div>

        
            
            
            
        <script src="userDashboard.js"></script>
    </main>
</body>
</html>
