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
                <span>TOP ANIME</span>
                <span>TOP MANGA</span>
            </div>
            <div class="search-bar">
                <input class="search" type="text" placeholder="Search...">
            </div>
        </div>

    </header>

    <main>


    </main>


</body>

</html>