<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Piece - MyAnimeList.net</title>
    <link rel="stylesheet" href="MediaPage.css">
</head>
<body>

    <header>
         <div class="header-upper">
            <div class="logo" onclick="window.location.href='userDashboard.php'">
                <img src="https://cdn.myanimelist.net/images/mal-logo-xsmall.png?v=1634263200">
            </div>
            <div class="profile">
                <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true):?>
                    <?php if($_SESSION['role'] ==  'registered'): ?>
                        <div class="devider1"></div>
                        <span class="profile-name"  onclick="window.location.href='userDashboard.php'">   
                                <?php echo $_SESSION['username']; ?>
                        </span>
                        <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile" onclick="window.location.href='userDashboard.php'">
                            <a href="destorySession.php" class="login-link-Log-out">Log Out</a>
                    <?php else: ?>
                        <a href="admin.php" class="login-link">Dashboard</a>
                        <div class="devider1"></div>
                        <span class="profile-name" onclick="window.location.href='userDashboard.php'">
                            <?php echo $_SESSION['username']; ?>
                        </span>
                        <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile" onclick="window.location.href='userDashboard.php'">
                        <a href="destorySession.php" class="login-link-Log-out">Log Out</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="signUp.php" class="login-link">Sign Up</a>
                    <a href="login.php" class="login-link">Login</a>
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
            <img src="https://cdn-icons-png.freepik.com/512/14911/14911421.png">
            <!-- <img src="https://cdn-icons-png.freepik.com/512/14627/14627394.png"> --> 
            <!-- for dark mode to bright mode converting logo img link-->
            
        </div>
    </header>

    <main>
        <!-- LEFT SECTION: SIDEBAR (Poster, Info, Stats) -->
        <div class="leftSection">
            <img src="https://cdn.myanimelist.net/images/anime/6/73245.jpg" alt="One Piece Poster" class="anime-cover">
            
            <div class="action-btn blue">Add to My List</div>
            <div class="action-btn">Add to Favorites</div>
            
            <div class="sidebar-header">Alternative Titles</div>
            <div class="info-row"><span class="info-label">Synonyms:</span> OP</div>
            <div class="info-row"><span class="info-label">Japanese:</span> ONE PIECE</div>
            <div class="info-row"><span class="info-label">English:</span> One Piece</div>

            <div class="sidebar-header">Information</div>
            <div class="info-row"><span class="info-label">Type:</span> <a href="#">TV</a></div>
            <div class="info-row"><span class="info-label">Episodes:</span> Unknown</div>
            <div class="info-row"><span class="info-label">Status:</span> Currently Airing</div>
            <div class="info-row"><span class="info-label">Aired:</span> Oct 20, 1999 to ?</div>
            <div class="info-row"><span class="info-label">Premiered:</span> <a href="#">Fall 1999</a></div>
            <div class="info-row"><span class="info-label">Broadcast:</span> Sundays at 09:30 (JST)</div>
            <div class="info-row"><span class="info-label">Producers:</span> <a href="#">Fuji TV</a>, <a href="#">TAP</a></div>
            <div class="info-row"><span class="info-label">Licensors:</span> <a href="#">Funimation</a>, <a href="#">4Kids</a></div>
            <div class="info-row"><span class="info-label">Studios:</span> <a href="#">Toei Animation</a></div>
            <div class="info-row"><span class="info-label">Source:</span> Manga</div>
            <div class="info-row"><span class="info-label">Genres:</span> <a href="#">Action</a>, <a href="#">Adventure</a>, <a href="#">Fantasy</a></div>
            <div class="info-row"><span class="info-label">Duration:</span> 24 min.</div>
            <div class="info-row"><span class="info-label">Rating:</span> PG-13 - Teens 13 or older</div>

            <div class="sidebar-header">Statistics</div>
            <div class="info-row"><span class="info-label">Score:</span> 8.73 (scored by 1,488,822 users)</div>
            <div class="info-row"><span class="info-label">Ranked:</span> #52</div>
            <div class="info-row"><span class="info-label">Popularity:</span> #17</div>
            <div class="info-row"><span class="info-label">Members:</span> 2,613,361</div>
            <div class="info-row"><span class="info-label">Favorites:</span> 246,502</div>
        </div>

        <!-- RIGHT SECTION: MAIN CONTENT (Synopsis, Relations, Characters) -->
        <div class="rightSection">
            
            <div class="stats-container">
                <div class="score-box">
                    <span class="score-label">Score</span>
                    <span class="score-value">8.73</span>
                    <div style="font-size:9px;">1,488,822 users</div>
                </div>
                <div class="stats-details">
                    <span>Ranked <strong>#52</strong></span>
                    <span>Popularity <strong>#17</strong></span>
                    <span>Members <strong>2,613,361</strong></span>
                </div>
            </div>

            <div class="content-header">
                <h2>Synopsis</h2>
                <a href="#" class="edit-link">Edit</a>
            </div>
            <div class="synopsis">
                <p>Barely surviving in a barrel after passing through a terrible whirlpool at sea, carefree Monkey D. Luffy ends up aboard a ship under attack by fearsome pirates. Despite being a naive-looking teenager, he is not to be underestimated. Unmatched in battle, Luffy is a pirate himself who resolutely pursues the coveted One Piece treasure and the title of King of the Pirates that comes with it.</p>
                <br>
                <p>The late King of the Pirates, Gol D. Roger, stirred up the world before his death by disclosing the whereabouts of his hoard of riches and daring everyone to obtain it. Ever since then, countless powerful pirates have sailed dangerous seas for the prized One Piece only to never return. Although Luffy lacks a crew and a proper ship, he is endowed with a superhuman ability and an unbreakable spirit that make him not only a formidable adversary but also an inspiration to many.</p>
            </div>

            <div class="content-header">
                <h2>Related Entries</h2>
                <a href="#" class="edit-link">Edit</a>
            </div>
            <table class="related-table">
                <tr>
                    <td class="related-cat">Adaptation:</td>
                    <td><a href="#">One Piece</a> (Manga), <a href="#">One Piece</a> (Light Novel)</td>
                </tr>
                <tr>
                    <td class="related-cat">Side story:</td>
                    <td><a href="#">One Piece: Taose! Kaizoku Ganzack</a>, <a href="#">One Piece Movie 01</a></td>
                </tr>
                <tr>
                    <td class="related-cat">Character:</td>
                    <td><a href="#">Nissan Serena x One Piece 3D: Mugiwara Chase - Sennyuu!! Sauzando Sani-gou</a></td>
                </tr>
            </table>

            
            

                
                        <img src="https://cdn.myanimelist.net/r/42x62/images/voiceactors/3/65482.jpg?s=a76d1e90956b6b3e21b79f2257d07963" class="char-img">
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>