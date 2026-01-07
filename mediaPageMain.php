<?php
session_start();
include("db.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM currentlyairingmedia WHERE media_id = $id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

    if(!$row){
        echo "Media not found.";
        header("Location: home.php");
        exit();
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="admin.css">
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
                <a href="destorySession.php" class="login-link-Log-out">Log Out</a>
            </div>
        </div>
        <div class="header-middle">
            <div class="topButton">
                <span onclick="window.location.href='top-Anime.php'">TOP ANIME</span>
                <span onclick="window.location.href='top-Manga.php'">TOP MANGA</span>
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
                    $(body).click(function(e) {
                        if (!$(e.target).closest('.search-bar').length) {
                            $('#search-results').hide();
                        }
                    });
                });
            </script>
        </div>
        <div class="header-lower">
            <span><strong><?php echo $row['title']; ?></strong></span>
            <form method="POST" action="adminLogic.php">
                <?php if (isset($_SESSION['theme_mode'])): ?>
                    <script>
                        localStorage.setItem('theme', '<?php echo $_SESSION['theme_mode']; ?>');
                    </script>
                <?php endif; ?>
                <button type="submit" name="theme-toggle" id="theme-toggle" class="login-link" value="1">
                    <?php if (isset($_SESSION['theme_mode']) && $_SESSION['theme_mode'] == 'dark') {
                        echo '☀️';
                    } else {
                        echo '🌙';
                    } ?>
                </button>
            </form>
        </div>
    </header>
    <!-- <div class="admin-box"></div> -->
     
</body>
</html>