<?php
session_start();
include("../../HOME/Model/db.php");

if (isset($_POST['theme-toggle'])) {
    $newTheme = $_POST['theme-toggle'] == '1' ? 'dark' : 'light';
    $_SESSION['theme_mode'] = $newTheme;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: ../../HOME/View/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="../Css/userDash.css">
    <link rel="stylesheet" href="../../HOME/Css/topAnime-MangaPage.css">
    <link rel="stylesheet" href="../../HOME/Css/searchBar.css">
</head>

<body class="<?php echo (isset($_SESSION['theme_mode']) && $_SESSION['theme_mode'] === 'dark') ? 'dark-theme' : ''; ?>">
    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='../../HOME/View/home.php'">
                <img src="../../HOME/Images/download.png" alt="Logo">
            </div>
            <div class="profile">
                <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true): ?>
                    <div class="devider1"></div>
                    <span class="profile-name" onclick="window.location.href='userDashboard.php'">
                        <?php echo $_SESSION['username']; ?>
                    </span>
                    <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile"
                        onclick="window.location.href='../../USER/View/userDashboard.php'">
                    <a href="../../HOME/Controler/destorySession.php" class="login-link-Log-out">Log Out</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="header-middle">
            <div class="topButton">
                <span onclick="window.location.href='../../HOME/View/top-Anime.php'">TOP ANIME</span>
                <span onclick="window.location.href='../../HOME/View/top-Manga.php'">TOP MANGA</span>
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
                $(document).ready(function () {
                    $('#search').on('input', function () {
                        var query = $(this).val();
                        if (query.length > 2) {
                            $.ajax({
                                url: '../../HOME/Controler/searchBarLogic.php',
                                method: 'POST',
                                data: {
                                    search: query
                                },
                                success: function (data) {
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


                    <div class="sidebar-divider"></div>

                    <div class="sidebar-menu">
                        <input type="button" value="Favorites" class="statbtn" location="favouriteList.php"
                            onclick="window.location.href='favouriteList.php'">
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
            <div class="admin-box">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Poster</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $curr_user = $_SESSION['username'];
                        $u_sql = "SELECT user_id FROM Users WHERE username = '$curr_user'";
                        $u_res = mysqli_query($conn, $u_sql);
                        $u_row = mysqli_fetch_assoc($u_res);
                        $user_id = $u_row['user_id'];

                        $query = "SELECT m.*, w.status AS read_status FROM Watchlist w 
                                  JOIN Media m ON w.media_id = m.media_id 
                                  WHERE w.user_id = '$user_id' AND m.type = 'manga'";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $row) {
                                ?>
                                <tr>
                                    <td>
                                        <a href="../../HOME/View/MediaPage.php?id=<?php echo $row['media_id']; ?>"
                                            class="mediaClick">
                                            <strong><?php echo $row['title'] ?></strong><br><br>
                                            <?php echo substr($row['description'], 0, 150) . '...'; ?><br><br>
                                            <hr>
                                            <strong>Score:</strong> <?php echo $row['score'] ?>,
                                            <strong>Type:</strong> <?php echo $row['type'] ?>,
                                            <strong>Studio:</strong> <?php echo $row['studio'] ?>
                                            <hr>
                                        </a>
                                    </td>
                                    <td>
                                        <img src="<?php echo $row['poster_image_link'] ?>" alt="Poster"
                                            style="width:100px; height:auto;">
                                    </td>
                                    <td>
                                        <?php echo ucfirst(str_replace('_', ' ', $row['read_status'])); ?>
                                    </td>

                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="4" style="text-align:center;">Your manga list is currently empty.</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>


        </div>

    </main>
    <footer>
        <div class="footer-block">
            <div class="footer-links">
                <p style="border-bottom: 1px solid white; padding: 5px; width: 200px; margin: 0 auto;">Follow Us</p>
                <a href="https://github.com/Arindom-Lane">ARINDOM</a> <strong style="color: azure;">|</strong>
                <a href="https://github.com/ReDThunDeR33">ARKO</a> <strong style="color: azure;">|</strong>
                <a href="https://github.com/Arindom-Lane/Anime-Review-Site">PROJECT REPO</a>
                <img src="../../HOME/Images/github.png" alt="GitHub" class="github-icon"
                    onclick="window.location.href='https://github.com/Arindom-Lane/Anime-Review-Site'">
            </div>
        </div>
    </footer>
    <script src="../Js/favouriteList.js"></script>
    <script src="../Js/homeJSCRIPT.js"></script>
</body>

</html>