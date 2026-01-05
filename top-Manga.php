<?php
session_start();
include("db.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="topAnime-MangaPage.css">
    <link rel="stylesheet" href="searchBar.css">
    <script src="admin.js" defer></script>
</head>

<body>
    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='home.php'">
                <img src="https://cdn.myanimelist.net/images/mal-logo-xsmall.png?v=1634263200">
            </div>
            <div class="profile">
                <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true): ?>
                    <?php if ($_SESSION['role'] ==  'registered'): ?>
                        <div class="devider1"></div>
                        <span class="profile-name" onclick="window.location.href='userDashboard.php'">
                            <?php echo $_SESSION['username']; ?>
                        </span>
                        <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile" onclick="window.location.href='userDashboard.php'">
                        <a href="destorySession.php" class="login-link-Log-out">Log Out</a>
                    <?php else: ?>

                        <div class="devider1"></div>

                        <span class="profile-name" onclick="window.location.href='userDashboard.php'">
                            <?php echo $_SESSION['username']; ?>
                        </span>
                        <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile" onclick="window.location.href='userDashboard.php'">
                        <a href="admin.php" class="login-link">Dashboard</a>
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
                    $result = mysqli_query($conn, "SELECT m.* FROM Top_Mangas t INNER JOIN Media m ON t.media_id = m.media_id ORDER BY m.score DESC");
                    if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                    ?>
                            <tr>
                                <td><strong><?php echo $row['title'] ?></strong><br><br>
                                    <?php echo $row['description'] ?><br><br>
                                    <hr>
                                    <strong>score:</strong> <?php echo $row['score'] ?>,
                                    <strong>type:</strong> <?php echo $row['type'] ?>,                                
                                    <strong>studio:</strong> <?php echo $row['studio'] ?>,
                                    <strong>source:</strong> <?php echo $row['source'] ?>
                                    <hr>
                                </td>
                                <td><img src="<?php echo $row['poster_image_link'] ?>" alt="Poster" style="width:100px; height:auto;"></td>
                                <td style="display: flex;">
                                    <a href="NONE .php?id=<?php echo $row['media_id']; ?>" name="editMediaData" class="editProfileHREF" style="width: 150px; height: auto; text-align: center; margin-right: 10px;">Edit</a>
                                    <a href=" .php?id=<?php echo $row['media_id']; ?>" class="editProfileHREF" style="width: 150px; height: auto; text-align: center;" onclick="return confirm('Delete this media?')">Delete</a>
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