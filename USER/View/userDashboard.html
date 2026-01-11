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
                <img src="download.png" alt="Logo">
            </div>
            <div class="profile">
                <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true): ?>
                    <div class="devider1"></div>
                    <span class="profile-name">
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
            </script>
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

                    <div class="sidebar-divider">

                        <div class="sidebar-menu">
                            <input type="button" value="Favorites" class="statbtn" onclick="window.location.href='favouriteList.php'">
                            <input type="button" value="Add Media Contribution" class="statbtn" onclick="window.location.href='ReqMed.php'">
                        </div>
                    </div>



                    <br>

                </div>

                <div class="edit-profile-wrapper" onclick="window.location.href='UserEditProfile.php'">
                    <input type="button" value="Edit Profile" class="editbtn">
                </div>
            </fieldset>
        </div>

        <!-- RIGHT MAIN CONTENT -->
                <!-- RIGHT MAIN CONTENT -->
        <div class="rightsection">
            <h2 class="main-header">Statistics</h2>

            <!-- Anime Stats -->
            <div class="stats-container">
                <div class="stats-data-col">
                    <div class="stats-header-row">
                        <h3>Anime Stats</h3>
                        <a href="#">All Anime Stats</a>
                    </div>

                    <div class="days-score-row">
                        <span>Days: <strong>0.0</strong></span>
                        <span>Mean Score: <strong><?php echo $animeStats['mean_score']; ?></strong></span>
                    </div>

                    <!-- ANIME PROGRESS BAR -->
                     <div class="main-progress-bar">
                        <div class="stat-bar-segment bg-watching" style="width: <?php echo $animePct['watching']; ?>%" title="Watching"></div>
                        <div class="stat-bar-segment bg-completed" style="width: <?php echo $animePct['completed']; ?>%" title="Completed"></div>
                        <div class="stat-bar-segment bg-onhold" style="width: <?php echo $animePct['on_hold']; ?>%" title="On-Hold"></div>
                        <div class="stat-bar-segment bg-dropped" style="width: <?php echo $animePct['dropped']; ?>%" title="Dropped"></div>
                        <div class="stat-bar-segment bg-plan" style="width: <?php echo $animePct['plan']; ?>%" title="Plan to Watch"></div>
                    </div>

                    <div class="stats-grid">
                        <ul class="status-legend">
                            <li><span class="dot watching"></span> Watching <span class="count"><?php echo $animeStats['watching']; ?></span></li>
                            <li><span class="dot completed"></span> Completed <span class="count"><?php echo $animeStats['completed']; ?></span></li>
                            <li><span class="dot onhold"></span> On-Hold <span class="count"><?php echo $animeStats['on_hold']; ?></span></li>
                            <li><span class="dot dropped"></span> Dropped <span class="count"><?php echo $animeStats['dropped']; ?></span></li>
                            <li><span class="dot plan"></span> Plan to Watch <span class="count"><?php echo $animeStats['plan_to_watch']; ?></span></li>
                        </ul>
                        <ul class="status-totals">
                            <li><span>Total Entries</span> <span><?php echo $animeStats['total']; ?></span></li>
                           
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
                        <span>Mean Score: <strong><?php echo $mangaStats['mean_score']; ?></strong></span>
                    </div>

                    <!-- MANGA PROGRESS BAR -->
                    <div class="main-progress-bar">
                        <div class="stat-bar-segment bg-watching" style="width: <?php echo $mangaPct['watching']; ?>%" title="Reading"></div>
                        <div class="stat-bar-segment bg-completed" style="width: <?php echo $mangaPct['completed']; ?>%" title="Completed"></div>
                        <div class="stat-bar-segment bg-onhold" style="width: <?php echo $mangaPct['on_hold']; ?>%" title="On-Hold"></div>
                        <div class="stat-bar-segment bg-dropped" style="width: <?php echo $mangaPct['dropped']; ?>%" title="Dropped"></div>
                        <div class="stat-bar-segment bg-plan" style="width: <?php echo $mangaPct['plan']; ?>%" title="Plan to Read"></div>
                    </div>

                    <div class="stats-grid">
                        <ul class="status-legend">
                            <li><span class="dot watching"></span> Reading <span class="count"><?php echo $mangaStats['reading']; ?></span></li>
                            <li><span class="dot completed"></span> Completed <span class="count"><?php echo $mangaStats['completed']; ?></span></li>
                            <li><span class="dot onhold"></span> On-Hold <span class="count"><?php echo $mangaStats['on_hold']; ?></span></li>
                            <li><span class="dot dropped"></span> Dropped <span class="count"><?php echo $mangaStats['dropped']; ?></span></li>
                            <li><span class="dot plan"></span> Plan to Read <span class="count"><?php echo $mangaStats['plan_to_read']; ?></span></li>
                        </ul>
                        <ul class="status-totals">
                            <li><span>Total Entries</span> <span><?php echo $mangaStats['total']; ?></span></li>
                            
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
                <form action="" method="POST">
                    <textarea name="user_comment" class="comment-box" placeholder="Add a comment..." rows="4" required></textarea>
                    <br>
                    <button type="submit" name="submit_comment" class="editbtn" style="margin-top: 10px; cursor: pointer;">
                        Post Comment
                    </button>
                </form>

                <div class="comments-display" style="margin-top: 20px;">
                    <?php
                    if (isset($_SESSION['post_comments']) && !empty($_SESSION['post_comments'])) {
                        $comments = array_reverse($_SESSION['post_comments']);

                        foreach ($comments as $comment) {
                            echo '<div class="comment-item" >';
                            echo '<div class="comment-header">';
                            echo '<div><strong>' . $comment['user'] . '</strong> <span class="comment-date">(' . $comment['date'] . ')</span></div>';


                            if ($comment['user'] === $_SESSION['username']) {
                                echo '<form action="" method="POST" class="delete-form">';
                                echo '<input type="hidden" name="comment_id" value="' . $comment['id'] . '">';
                                echo '<button type="submit" name="delete_comment" class="delete-btn">Delete</button>';
                                echo '</form>';
                            }
                            echo '</div>';
                            echo '<p class="comment-text">' . $comment['text'] . '</p>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>



        </div>
        </div>

        <script src="userDashboard.js"></script>
    </main>
</body>

</html>
