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
    <link rel="stylesheet" href="userDash.css">  
    <link rel="stylesheet" href="searchBar.css">  
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
                <span class="profile-name" onclick="window.location.href='userDashboard.php'">
                    <?php echo $_SESSION['username']; ?>
                </span>
                <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile">
                <a href="destorySession.php" class="login-link-Log-out">Log Out</a>
                <?php endif; ?>
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
            <span>My Panel</span>
            <img src="https://cdn-icons-png.freepik.com/512/14911/14911421.png" alt="Menu">
        </div>
    </header>

    <main>
        <!-- LEFT SIDEBAR -->
        <div class="leftSection">
            <fieldset class="sidebar-fieldset">
                <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true): ?>
                <div class="user-avatar-container">
                    <img src="<?php echo $_SESSION['profileImage']; ?>" class="user-avatar-img" alt="User Avatar">
                </div>
                <?php endif; ?>
                
                <div class="sidebar-content">
                    <div class="sidebar-row">
                        <span>Last Online</span>
                        <span class="status-online">Now</span>
                    </div>
                    <div class="sidebar-row joined-row">
                        <span>Joined</span>
                        <span>Aug 11, 2023</span>
                    </div>

                    <div class="list-btn-row">
                        <input type="button" value="Anime List" class="list-btn">
                        <input type="button" value="Manga List" class="list-btn">
                    </div>

                    <div class="sidebar-divider"></div>
                    
                    <div class="sidebar-menu">
                        <input type="button" value="Favorites" class="statbtn">
                    </div>

                    <br>
                    
                </div>
                
                <div class="edit-profile-wrapper" onclick="window.location.href='UserEditProfile.php'">
                    <input type="button" value="Edit Profile" class="editbtn">
                </div>
            </fieldset>
        </div>

        <!-- RIGHT MAIN CONTENT -->
        <div class="rightsection">
            <div class="Edit">
                <a href="#">Edit Favourites</a>
            </div>
            <br></br>
            <div class="favourite-list">
                <p>Your favourite list is currently empty.</p>
                </div> 
                 
                
        </div>
            
        <script src="userDashboard.js"></script>
    </main>
</body>
</html>
