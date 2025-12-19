<?php
include("db.php");

// Fetch data using your specific table columns
// We order by score to show the "Most Popular"
$query = "SELECT media_id, title, poster_image_link FROM media ORDER BY score DESC LIMIT 50";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="homeStyle.css"> 
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
    </header>

    <main style="padding: 20px;">
        <div class="sidebar-widget">
            <div class="widget-header">
                <h3>Most Popular Anime</h3>
                <a href="#" class="more-link">More</a>
            </div>

            <div class="anime-list">
                <?php 
                $rank = 1;
                while($row = mysqli_fetch_assoc($result)){ 
                ?>
                <div class="anime-item">
                    <span class="rank"><?php echo $rank; ?></span>
                    
                    <div class="poster-container">
                        <img src="<?php echo $row['poster_image_link']; ?>" alt="Poster">
                    </div>
                    
                    <div class="anime-info">
                        <span class="anime-title"><?php echo $row['title']; ?></span>
                    </div>
                </div>
                <?php 
                $rank++;
                } 
                ?>
            </div>
        </div>
    </main>
</body>
</html>