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
            <div class="logo">
                <img src="https://cdn.myanimelist.net/images/mal-logo-xsmall.png?v=1634263200">
            </div>
            <div class="profile">
                <div class="devider1"></div>
                <span class="profile-name">Hamim</span>
                <img src="https://avatars.githubusercontent.com/u/143287515?v=4" alt="Profile">
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
        <div class="leftSection">
            <fieldset style="width: 100%; height: auto; padding:15px; border: 1px solid var(--color-border_white); background-color: white;">
                <div style="display: flex; justify-content: center; margin-bottom: 10px;">
                    <img src="https://avatars.githubusercontent.com/u/143287515?v=4" style="width: 100%; max-width: 200px; border-radius: 4px;">
                </div>
                
                <div style="font-size: 12px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span>Last Online</span>
                        <span style="color:green;">Now</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                        <span>Joined</span>
                        <span>Aug 11, 2023</span>
                    </div>

                    <div style="display: flex; gap: 5px; margin-bottom: 10px;">
                        <input type="button" value="Anime List" class="animebtn" style="flex: 1; background-color: var(--color-primary_brand); color: white; border: none; cursor: pointer; border-radius: 3px;">
                        <input type="button" value="Manga List" class="mangabtn" style="flex: 1; background-color: var(--color-primary_brand); color: white; border: none; cursor: pointer; border-radius: 3px;">
                    </div>

                    <div style="border-bottom: 1px solid var(--color-border_white); margin: 10px 0;"></div>
                    
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <input type="button" value="Statistics" class="statbtn">
                        <input type="button" value="History" class="statbtn">
                        <input type="button" value="Favorites" class="statbtn">
                    </div>

                    <br>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Reviews</span>
                        <span style="color:blue;">0</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Recommendations</span>
                        <span style="color:blue;">0</span>
                    </div>

                    <h1 style="font-size: 14px; margin-top: 15px; border-bottom: 1px solid #ccc; padding-bottom: 5px;">Friends <span style="color:blue;">(0)</span></h1>
                    <div class="friendcheck" style="height: 50px; background-color: #f9f9f9; margin-top: 5px;"></div> 
                </div>
                
                <div style="margin-top: 20px; text-align: center;">
                    <input type="button" value="Edit Profile" class="editbtn" style="padding: 5px 15px;">
                </div>
            </fieldset>
        </div>
            <div class="rightsection">
    <div class="content-block">
        <p class="biography-text">No biography yet. <a href="#">Write it now.</a></p>
    </div>

    <h2 class="main-header">Statistics</h2>

    <div class="stats-container">
        <div class="stats-data-col">
            <div class="stats-header-row">
                <h3>Anime Stats</h3>
                <a href="#">All Anime Stats</a>
            </div>
            
            <div class="days-score-row">
                <span>Days: <strong>0.0</strong></span>
                <span>Mean Score: <strong>0.00</strong></span>
            </div>

            <div class="main-progress-bar">
                <div class="bar-fill green" style="width: 100%;"></div>
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
                <div class="bar-fill grey" style="width: 100%;"></div>
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
</div>

            </div>

    </main>

</body>
</html>