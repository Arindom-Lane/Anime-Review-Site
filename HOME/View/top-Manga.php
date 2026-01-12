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
    <script>
        const serverTheme = '<?php echo $_SESSION["theme_mode"] ?? "light"; ?>';
        
        localStorage.setItem('theme', serverTheme);

        if (serverTheme === 'dark') {
            document.documentElement.classList.add('dark-theme');
        } else {
            document.documentElement.classList.remove('dark-theme');
        }
    </script>
    <script src="../Js/homeJSCRIPT.js" defer></script>
    
</head>

<body>
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
                <span onclick="window.location.href='top-Anime.php'">TOP ANIME</span>
                <span class="TOPANIME">TOP MANGA</span>
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
                        <th>Staus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM TopManga");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                            <tr>
                                <td>
                                    <a class="mediaClick" href="MediaPage.php?idTopManga=<?php echo $row['media_id']; ?>">
                                        <strong><?php echo $row['title'] ?></strong><br><br>
                                        <?php echo $row['description'] ?><br><br>
                                        <hr>
                                        <strong>score:</strong> <?php echo $row['score'] ?>,
                                        <strong>type:</strong> <?php echo $row['type'] ?>,
                                        <strong>studio:</strong> <?php echo $row['studio'] ?>,
                                        <strong>source:</strong> <?php echo $row['source'] ?>
                                        <hr>
                                    </a>
                                </td>
                                <td><a href="MediaPage.php?id=<?php echo $row['media_id']; ?>"><img src="<?php echo $row['poster_image_link'] ?>" alt="Poster" style="width:100px; height:auto;"></a></td>
                                <td style="display: flex;">
                                    <a href="NONE .php?id=<?php echo $row['media_id']; ?>" name="editMediaData" class="editProfileHREF" style="width: 150px; height: auto; text-align: center; margin-right: 10px;">Edit</a>
                                </td>

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


</body>

</html>