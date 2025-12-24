<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="homeStyle.css">    

    
</head>
<body>
    <header>
        
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='userDashboard.php'">
                <img src="https://cdn.myanimelist.net/images/mal-logo-xsmall.png?v=1634263200">
            </div>
            <div class="profile">
                <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true):?>
                <div class="devider1" onclick="window.location.href='userDashboard.php'"></div>
                <span class="profile-name" onclick="window.location.href='userDashboard.php'">
                    <?php echo $_SESSION['username']; ?>
                </span>
                <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile" onclick="window.location.href='userDashboard.php'">
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
        
        <div class="leftSection">
        
        <div class="MALxJAPANHeadLine">
            <h3>MALxJapan -More than just anime-</h3>
            <a href="https://mxj.myanimelist.net/">Visit MALxJAPAN</a>
        </div><hr>
        <div class="MALxJAPANmainDiv">
            <div>
                <img src="https://mxj.myanimelist.net/img/projects/Sparks_of_Tomorrow/354x220.png">
                <a href="https://mxj.myanimelist.net/Sparks_of_Tomorrow">Unveil the World of Sparks of Tomorrow & Win Prizes!</a>

            </div>
            <div>
                <img src="https://cdn.myanimelist.net/resources/mxj_panel/2025/20251027221823_MxJ%20exposure-354x220@2x.png">
                <a href="https://mhwc.myanimelist.net/202510/?utm_source=MAL&utm_medium=top_mxj_frontierworks&utm_content=announce1">MyAnimeList x Honeyfeed Writing Contest 2025 - Twilight Frontiers Presented by Frontier Works</a>

            </div>
            <div>
                <img src="https://cdn.myanimelist.net/resources/mxj_panel/2024/20241121005050_354x220@2x.png">
                <a href="https://mxj.myanimelist.net/conbiz?utm_source=MAL&utm_medium=top_mxj_conbiz">Watch "ConBiz!" ー a new Japanese business entertainment program</a>

            </div>
        </div>

        <h3>Fall 2025 Anime</h3><hr>
        <div class="fallList-wrapper">
            <span class="left-arrowfallList">&lt;</span>
            <span class="right-arrowfallList">&gt;</span>
                <div class="fallList">

                    <img src="https://cdn.myanimelist.net/images/anime/1168/148347.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1697/151793.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1959/151055.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1140/152364.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1190/151754.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1276/151118.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1206/151772.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1699/151694.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1364/151767.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1830/145051.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1163/151246.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1721/151097.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1011/152084.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1651/152063.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1864/151837.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1015/151233.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1264/152012.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1257/152233.jpg">
                </div>
        </div>
        <br>
        <h3>Latest Updated Episode Videos</h3><hr>
        <div class="latest-wrapper">
            <span class="left-arrowlatest">&lt;</span>
            <span class="right-arrowlatest">&gt;</span>
                <div class="latestList">

                    <img src="https://cdn.myanimelist.net/images/anime/1168/148347.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1697/151793.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1959/151055.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1140/152364.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1190/151754.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1276/151118.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1206/151772.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1699/151694.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1364/151767.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1830/145051.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1163/151246.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1721/151097.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1011/152084.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1651/152063.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1864/151837.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1015/151233.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1264/152012.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1257/152233.jpg">
                </div>
        </div>
        <br>
        <h3>Most Popular Anime Trailers</h3><hr>
        <div class="Trailers-wrapper">
            <span class="left-arrowTrailers">&lt;</span>
            <span class="right-arrowTrailers">&gt;</span>
                <div class="TrailersList">

                    <img src="https://i.ytimg.com/vi/WJkJTb8T-8E/maxresdefault.jpg">
                    <img src="https://i.ytimg.com/vi/ATJYac_dORw/hq720.jpg?sqp=-oaymwEnCNAFEJQDSFryq4qpAxkIARUAAIhCGAHYAQHiAQoIGBACGAY4AUAB&rs=AOn4CLCFg_a8bomx8r7HLZEPf_HriNAkhA">
                    <img src="https://img.youtube.com/vi/pv8A7eubPQQ/maxresdefault.jpg">
                    <img src="https://img.youtube.com/vi/FHgm89hKpXU/maxresdefault.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1190/151754.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1276/151118.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1206/151772.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1699/151694.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1364/151767.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1830/145051.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1163/151246.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1721/151097.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1011/152084.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1651/152063.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1864/151837.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1015/151233.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1264/152012.jpg">
                    <img src="https://cdn.myanimelist.net/images/anime/1257/152233.jpg">
                </div>
        </div><br><hr>
        


        </div>
        <div class="rightSection">
            <div class="MyStats"></div>
            <div class="topAiringAnime">
                <div class="topAiringAnimeHeading">
                    <h3>Top Airing Anime</h3>
                    <span>More</span>
                </div>
                <div class="topAiringAnimeImagesGrid">
                    <div>
                        <h2>1</h2>
                        <img src="https://cdn.myanimelist.net/r/100x140/images/anime/1064/152251.webp?s=922394da72dc89aaca1e482d3700a90c">
                        <span>Sousou no Frieren 2nd Season</span>
                    </div>
                    <div>
                        <h2>3</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/1982/153900.jpg">
                        <span>Jigokuraku 2nd Season</span>
                    </div>
                    <div>
                        <h2>3</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/1653/153899.jpg">
                        <span>Youjo Senki II</span>
                    </div>
                    <div>
                        <h2>4</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/1180/153379.jpg">
                        <span>Jujutsu Kaisen: Shimetsu Kaiyuu - Zenpen</span>
                    </div>
                </div>
            </div>

            <div class="topUpcoming">
                <div class="topUpcomingHeading">
                    <h3>Top Upcoming Anime</h3>
                    <span>More</span>
                </div>
                <div class="topUpcomingImagesGrid">
                    <div>
                        <h2>1</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/1706/144725.jpg">
                        <span>Re:Zero kara Hajimeru Isekai Seikatsu 3rd Season</span>
                    </div>
                    <div>
                        <h2>2</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/1026/146459.jpg">
                        <span>Sakamoto Days</span>
                    </div>
                    <div>
                        <h2>3</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/1584/143719.jpg">
                        <span>Dandadan</span>
                    </div>
                    <div>
                        <h2>4</h2>
                        <img src="https://m.media-amazon.com/images/M/MV5BNWFlNmJkN2YtNGRiZS00NjExLTlmNmEtYzdiMTdiZmMzYzAwXkEyXkFqcGc@._V1_FMjpg_UY3000_.jpg">
                        <span>Blue Lock 2nd Season</span>
                    </div>
                </div>
            </div>

            <div class="mostPopuar">
                <div class="mostPopuarHeading">
                    <h3>Most Popular Anime</h3>
                    <span>More</span>
                </div>
                <div class="mostPopuarImagesGrid">
                    <div>
                        <h2>1</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/10/47347.jpg">
                        <span>Shingeki no Kyojin</span>
                    </div>
                    <div>
                        <h2>2</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/1223/96541.jpg">
                        <span>Fullmetal Alchemist: Brotherhood</span>
                    </div>
                    <div>
                        <h2>3</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/11/39717.jpg">
                        <span>Sword Art Online</span>
                    </div>
                    <div>
                        <h2>4</h2>
                        <img src="https://cdn.myanimelist.net/images/anime/6/73245.jpg">
                        <span>One Punch Man</span>
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
        
    <script src="homeJSCRIPT.js"></script>
</body>
</html>