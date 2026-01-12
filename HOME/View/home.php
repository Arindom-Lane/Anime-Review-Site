<?php
session_start();
include("../Model/db.php");

$stats = [
    'watching' => 0,
    'completed' => 0,
    'plan_to_watch' => 0,
    'dropped' => 0
];

if (isset($_SESSION["userId"]) && isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
    $userId = $_SESSION['userId'];

    $sql = "SELECT status, COUNT(*) as count 
            FROM Watchlist 
            WHERE user_id = '$userId' 
            GROUP BY status";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $stats[$row['status']] = $row['count'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList</title>
    <link rel="stylesheet" href="../Css/homeStyle.css">
    <link rel="stylesheet" href="../Css/searchBar.css">
</head>

<body>
    <div class="header-background"></div>
    <header>

        <div class="header-upper">
            <div class="logo" onclick="window.location.href='home.php'" style="cursor: pointer;">
                <img src="../Images/download.png">
            </div>
            <div class="profile">
                <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true): ?>
                    <?php if ($_SESSION['role'] ==  'registered'): ?>
                        <div class="devider1"></div>
                        <span class="profile-name" onclick="window.location.href='../../USER/View/userDashboard.php'">
                            <?php echo $_SESSION['username']; ?>
                        </span>
                        <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile" onclick="window.location.href='../../USER/View/userDashboard.php'">
                        <a href="../Controler/destorySession.php" class="login-link-Log-out">Log Out</a>
                    <?php else: ?>
                        <div class="devider1"></div>
                        <span class="profile-name" onclick="window.location.href='../../USER/View/userDashboard.php'">
                            <?php echo $_SESSION['username']; ?>
                        </span>
                        <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile" onclick="window.location.href='../../USER/View/userDashboard.php'">
                        <a href="../../ADMIN/View/admin.php" class="login-link">Dashboard</a>
                        <a href="../Controler/destorySession.php" class="login-link-Log-out">Log Out</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="signUp.php" class="login-link">Sign Up</a>
                    <a href="login.php" class="login-link">Login</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="header-middle">
            <div class="topButton">
                <span onclick="window.location.href='top-Anime.php'">TOP ANIME</span>
                <span onclick="window.location.href='top-Manga.php'">TOP MANGA</span>
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
                                    url: '../Controler/searchBarLogic.php',
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
                        $(body).click(function(e) {
                            if (!$(e.target).closest('.search-bar').length) {
                                $('#search-results').hide();
                            }
                        });
                    });
                </script>
            </div>
        </div>
        <div class="header-lower">
            <span>Home Page</span>

        </div>
    </header>

    <main>

        <div class="leftSection">

            <div class="MALxJAPANHeadLine">
                <h3>MALxJapan -More than just anime-</h3>
                <a href="https://mxj.myanimelist.net/">Visit MALxJAPAN</a>
            </div>
            <hr>
            <div class="MALxJAPANmainDiv">
                <?php
                $mxjQuery = 'SELECT * FROM articles LIMIT 3';
                $mxjResult = mysqli_query($conn, $mxjQuery);
                if (mysqli_num_rows($mxjResult) > 0) {
                    while ($row = mysqli_fetch_assoc($mxjResult)) {
                        echo '<div>';
                        echo '<img href="' . $row['article_url'] . '" src="' . $row['image_url'] . '" alt="Article Image">';
                        echo '<center><a href="' . $row['article_url'] . '">Read More</a></center><br>';
                        echo '</div>';
                    }
                }
                ?>
            </div>

            <h3>Currently Airing</h3>
            <hr>
            <div class="fallList-wrapper">
                <span class="left-arrowfallList">&lt;</span>
                <span class="right-arrowfallList">&gt;</span>
                <div class="fallList">
                    <?php
                    $currentQuery = 'SELECT media_id, title, poster_image_link FROM currentlyairingmedia LIMIT 15';
                    $result = mysqli_query($conn, $currentQuery);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <a href="MediaPage.php?title=<?php echo $row['title']; ?>">
                                <img src="<?php echo $row['poster_image_link']; ?>" alt="<?php echo $row['title']; ?>">
                            </a>
                    <?php
                        }
                    } else {
                        echo "<p>No media found.</p>";
                    }
                    ?>
                </div>
            </div>
            <br>
            <h3>Top Upcoming</h3>
            <hr>
            <div class="latest-wrapper">
                <span class="left-arrowlatest">&lt;</span>
                <span class="right-arrowlatest">&gt;</span>
                <div class="latestList">
                    <?php
                    $topUpcoming = 'SELECT * FROM TopUpcoming';
                    $topUpcomingResult = mysqli_query($conn, $topUpcoming);
                    if (mysqli_num_rows($topUpcomingResult) > 0) {
                        while ($row = mysqli_fetch_assoc($topUpcomingResult)) {
                            echo '<img href="MediaPage.php?title=' . $row['title'] . '" src="' . $row['poster_image_link'] . '" alt="Anime Image">';
                        }
                    } else {
                        echo "<p>No media found.</p>";
                    }
                    ?>
                </div>
            </div>
            <br>
            <h3>Most Popular Anime Trailers</h3>
            <hr>
            <div class="Trailers-wrapper">
                <span class="left-arrowTrailers">&lt;</span>
                <span class="right-arrowTrailers">&gt;</span>
                <div class="TrailersList">
                    <?php
                    $trailersQuery = 'SELECT * FROM trailers';
                    $trailersResult = mysqli_query($conn, $trailersQuery);
                    if (mysqli_num_rows($trailersResult) > 0) {
                        while ($row = mysqli_fetch_assoc($trailersResult)) {
                            echo '<a href="' . $row['video_url'] . '" target="_blank">';
                            echo '<img src="' . $row['image_url'] . '" alt="Trailer Image">';
                            echo '</a>';
                        }
                    } else {
                        echo "<p>No trailers found.</p>";
                    }
                    ?>
                </div>
            </div><br>
            <hr>



        </div>
        <div class="rightSection">
            <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true): ?>
                <div class="MyStats">
                    <div class="MyStatsHeading">
                        <h3>My Stats</h3>
                    </div>
                    <div class="MyStatsContent">
                        Watching: <?php echo $stats['watching']; ?><br>
                        Completed: <?php echo $stats['completed']; ?><br>
                        Plan to Watch: <?php echo $stats['plan_to_watch']; ?><br>
                        Dropped: <?php echo $stats['dropped']; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="topAiringAnime">
                    <div class="topAiringAnimeHeading">
                        <h3>Top Airing Anime</h3>
                        <span>More</span>
                    </div>
                    <div class="topAiringAnimeImagesGrid">
                        <div>
                            <h2>1</h2>
                            <img src="https://cdn.myanimelist.net/r/100x140/images/anime/1064/152251.webp?s=922394da72dc89aaca1e482d3700a90c">
                            <p>Sousou no Frieren 2nd Season</p>
                        </div>
                        <div>
                            <h2>3</h2>
                            <img src="https://cdn.myanimelist.net/images/anime/1982/153900.jpg">
                            <p>Jigokuraku 2nd Season</p>
                        </div>
                        <div>
                            <h2>3</h2>
                            <img src="https://cdn.myanimelist.net/images/anime/1653/153899.jpg">
                            <p>Youjo Senki II</p>
                        </div>
                        <div>
                            <h2>4</h2>
                            <img src="https://cdn.myanimelist.net/images/anime/1180/153379.jpg">
                            <p>Jujutsu Kaisen: Shimetsu Kaiyuu - Zenpen</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="mostPopuar">
                <div class="mostPopuarHeading">
                    <h3>Most Popular Anime</h3>
                    <span>.</span>
                </div>
                <div class="mostPopuarImagesGrid">
                    <div>
                        <h2>1</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/10/47347.jpg">
                        <div>Shingeki no Kyojin</div>
                    </div>
                    <div>
                        <h2>2</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/1223/96541.jpg">
                        <div>Fullmetal Alchemist: Brotherhood</div>
                    </div>
                    <div>
                        <h2>3</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/11/39717.jpg">
                        <div>Sword Art Online</div>
                    </div>
                    <div>
                        <h2>4</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/6/73245.jpg">
                        <div>One Punch Man</div>
                    </div>
                </div>
            </div>

            <div class="mostPopularManga">
                <div class="mostPopuarMangaHeading">
                    <h3>Most Popular Manga</h3>
                    <span>More</span>
                </div>
                <div class="mostPopularMangaImagesGrid">
                    <div>
                        <h2>1</h2>
                        <img src="https://cdn.myanimelist.net/images/manga/1/157897.jpg">
                        <span>Berserk</span>
                    </div>
                    <div>
                        <h2>2</h2>
                        <img src="https://cdn.myanimelist.net/images/manga/2/253146.jpg">
                        <span>One Piece</span>
                    </div>
                    <div>
                        <h2>3</h2>
                        <img src="https://cdn.myanimelist.net/images/manga/1/259070.jpg">
                        <span>Vagabond</span>
                    </div>
                    <div>
                        <h2>4</h2>
                        <img src="https://cdn.myanimelist.net/images/manga/3/258224.jpg">
                        <span>Monster</span>
                    </div>

                </div>
            </div>

        </div>
    </main>


    <footer>
        <div class="footer-block">
                <div class="footer-links">
                    <p>Follow Us</p>
                    <a href="https://github.com/Arindom-Lane">ARINDOM</a>
                    <a href="https://github.com/ReDThunDeR33">ARKO</a>
                    <a href="https://github.com/Arindom-Lane/Anime-Review-Site">PROJECT REPO</a>
                </div>

            <div class="copyright">
                MyAnimeList.net is a property of MyAnimeList Co., Ltd. ©2026 All Rights Reserved.
            </div>
            <div id="recaptcha-terms">
                This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank" rel="noopener noreferrer">Terms of Service</a> apply.
            </div>
        </div>
    </footer>

    <script src="../Js/homeJSCRIPT.js"></script>
</body>

</html>