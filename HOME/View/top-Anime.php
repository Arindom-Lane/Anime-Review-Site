<?php
session_start();
include("../Model/db.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="../Css/topAnime-MangaPage.css">
    <link rel="stylesheet" href="../Css/searchBar.css">

    <script src="../Js/homeJSCRIPT.js" defer></script>

</head>

<body>
    <?php if (isset($_SESSION['theme_mode'])): ?>
        <script>
            localStorage.setItem('theme', '<?php echo $_SESSION['theme_mode']; ?>');
            const serverTheme = localStorage.getItem('theme');
            if (serverTheme === 'dark') {
                document.documentElement.classList.add('dark-theme');
            } else {
                document.documentElement.classList.remove('dark-theme');
            }
        </script>
    <?php endif; ?>

    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='home.php'">
                <img src="../Images/download.png" alt="Logo">
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
                <span class="TOPANIME">TOP ANIME</span>
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
        </div>
    </header>

    <main>
        <div class="admin-box">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Poster</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM TopAnime");
                    if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                    ?>
                            <tr>
                                <td>
                                    <a href="MediaPage.php?idTopAnime=<?php echo $row['media_id']; ?>" class="mediaClick">
                                        <strong><?php echo $row['title'] ?></strong><br><br>
                                        <?php echo $row['description'] ?><br><br>
                                        <hr>
                                        <strong>score:</strong> <?php echo $row['score'] ?>,
                                        <strong>type:</strong> <?php echo $row['type'] ?>,
                                        <strong>studio:</strong> <?php echo $row['studio'] ?>,
                                        <strong>source:</strong> <?php echo $row['source'] ?>
                                        <hr>
                                </td>
                                <td><img src="<?php echo $row['poster_image_link'] ?>" alt="Poster" style="width:100px; height:auto;"></td>

                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">No record is found</td>
                        </tr>
                    <?php
                    }

                    ?>
                </tbody>
            </table>
        </div>


    </main>

    <footer>
        <div class="footer-block">
            <div class="footer-links">
                <p style="border-bottom: 1px solid white; padding: 5px; width: 200px; margin: 0 auto;">Follow Us</p>
                <a href="https://github.com/Arindom-Lane">ARINDOM</a> <strong style="color: azure;">|</strong>
                <a href="https://github.com/ReDThunDeR33">ARKO</a> <strong style="color: azure;">|</strong>
                <a href="https://github.com/Arindom-Lane/Anime-Review-Site">PROJECT REPO</a>
                <img src="../Images/github.png" alt="GitHub" class="github-icon" onclick="window.location.href='https://github.com/Arindom-Lane/Anime-Review-Site'">
            </div>
        </div>
    </footer>
</body>

</html>