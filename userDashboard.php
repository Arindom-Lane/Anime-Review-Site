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
                        <input type="button" value="Favorites" class="statbtn" onclick="window.location.href='favouriteList.php'">
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
            <div class="content-block">
                <span class="biography-text">No biography yet. </span>
                <a href="#">Write it now.</a>
            </div>

            <h2 class="main-header">Statistics</h2>

            <!-- Anime Stats -->
            <div class="stats-container">
                <div class="stats-data-col">
                    <div class="stats-header-row">
                        <h3>Anime Stats</h3>
                        <a href="#">All Anime Stats</a>
                    </div>
                    
                    <div class="days-score-row">
                        <span>Days: <strong>0</strong></span>
                        <span>Mean Score: <strong>0.00</strong></span>
                    </div>

                    <div class="main-progress-bar">
                        <div class="bar-fill green width-100"></div>
                    </div>

                    <div class="stats-grid">
                        <ul class="status-legend">
                            <li><span class="dot watching"></span> Watching <span class="count">0</span></li>
                            <li><span class="dot completed"></span> Completed <span class="count">0</span></li>
                            <li><span class="dot onhold"></span> On-Hold <span class="count">0</span></li>
                            <li><span class="dot dropped"></span> Dropped <span class="count">0</span></li>
                            <li><span class="dot plan"></span> Plan to Watch <span class="count">0</span></li>
                        </ul>
                        <ul class="status-totals">
                            <li><span>Total Entries</span> <span>0</span></li>
                            <li><span>Rewatched</span> <span>0</span></li>
                            <li><span>Episodes</span> <span>0</span></li>
                        </ul>
                    </div>
                </div>

                <div class="stats-updates-col">
                    <div class="stats-header-row">
                        <h3>Last Anime Updates</h3>
                        <a href="#">Anime History</a>
                    </div>

                    <div class="update-item">
                        <div class="no-updates">
                            No updates yet. <a href="#">Edit list now.</a> 
                            <!--
                <img src="https://cdn.myanimelist.net/images/anime/1697/151793.jpg" alt="Anime Image">
                <div class="update-info">
                    <a href="#" class="title-link">Spy x Family Season 3</a>
                    <div class="thin-progress-bar">
                        <div class="fill green" style="width: 100%;"></div>
                    </div>
                    <div class="update-meta">
                        <span>Watching <strong>13</strong>/13 · Scored -</span>
                        <span class="date">Dec 5, 9:37 AM</span>
                    </div> 
                </div>
-->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manga Stats -->

            <div class="stats-container manga-section">
                <div class="stats-data-col">
                    <div class="stats-header-row">
                        <h3>Manga Stats</h3>
                        <a href="#">All Manga Stats</a>
                    </div>
                    
                    <div class="days-score-row">
                        <span>Days: <strong>0.0</strong></span>
                        <span>Mean Score: <strong>0.00</strong></span>
                    </div>

                    <div class="main-progress-bar">
                        <div class="bar-fill grey width-100"></div>
                    </div>

                    <div class="stats-grid">
                        <ul class="status-legend">
                            <li><span class="dot watching"></span> Reading <span class="count">0</span></li>
                            <li><span class="dot completed"></span> Completed <span class="count">0</span></li>
                            <li><span class="dot onhold"></span> On-Hold <span class="count">0</span></li>
                            <li><span class="dot dropped"></span> Dropped <span class="count">0</span></li>
                            <li><span class="dot plan"></span> Plan to Read <span class="count">0</span></li>
                        </ul>
                        <ul class="status-totals">
                            <li><span>Total Entries</span> <span>0</span></li>
                            <li><span>Reread</span> <span>0</span></li>
                            <li><span>Chapters</span> <span>0</span></li>
                            <li><span>Volumes</span> <span>0</span></li>
                        </ul>
                    </div>
                </div>

                <div class="stats-updates-col">
                    <div class="stats-header-row">
                        <h3>Last Manga Updates</h3>
                        <a href="#">Manga History</a>
                    </div>
                    <div class="no-updates">
                        No updates yet. <a href="#">Edit list now.</a>
                    </div>
                </div>
            </div>
            <div>
                
                <h2>Comments</h2>
                <textarea class="comment-box" placeholder="Add a comment..." rows="4"></textarea>
            </div>

            
            
            </div>
        </div>
            
        <script src="userDashboard.js"></script>
    </main>
</body>
</html>
