<?php
session_start();
include("../Model/db.php");
$media_id = NULL;

if(isset($_GET['id'])){
    $media_id = $_GET['id'];
    $sql = "SELECT * FROM Media WHERE media_id = $media_id";
    $result = mysqli_query($conn,$sql);
    $media = mysqli_fetch_assoc($result);

    if(!$media){
        header("Location: home.php");
        exit();
    }
    
}
elseif(isset($_GET["title"])){
    $title = $_GET["title"];
    $sql = "SELECT * FROM Media WHERE title = '$title'";
    $result = mysqli_query($conn,$sql);
    $media = mysqli_fetch_assoc($result);
    

    if(!$media){
        header("Location: home.php");
        exit();
    }
    $media_id = $media['media_id'];
}
elseif(isset($_GET["idTopManga"])){
    $temp_id = $_GET["idTopManga"];
    $sql = "SELECT * FROM TopManga WHERE media_id = '$temp_id'";
    $result = mysqli_query($conn,$sql);
    $media = mysqli_fetch_assoc($result);
    $sql = "SELECT * FROM Media WHERE title = '$media[title]'";
    $result = mysqli_query($conn,$sql);
    $media = mysqli_fetch_assoc($result);

    if(!$media){
        header("Location: home.php");
        exit();
    }
    $media_id = $media['media_id'];
}
elseif(isset($_GET["idTopAnime"])){
    $temp_id = $_GET["idTopAnime"];
    
    $sql = "SELECT * FROM TopAnime WHERE media_id = '$temp_id'";
    $result = mysqli_query($conn,$sql);
    $media = mysqli_fetch_assoc($result);
    $sql = "SELECT * FROM Media WHERE title = '$media[title]'";
    $result = mysqli_query($conn,$sql);
    $media = mysqli_fetch_assoc($result);

    if(!$media){
        header("Location: home.php");
        exit();
    }
}

else{
    header("Location: home.php");
    exit();
}


$user_id = null;
$username = "";
$user_profile_pic = "https://icon-library.com/images/default-profile-icon/default-profile-icon-24.jpg"; 

if (isset($_SESSION['username'])) {
    $username = mysqli_real_escape_string($conn, $_SESSION['username']);
    
    $u_query = mysqli_query($conn, "SELECT user_id, profile_image_link FROM Users WHERE username = '$username'");
    if ($u_row = mysqli_fetch_assoc($u_query)) {
        $user_id = $u_row['user_id'];
        if (!empty($u_row['profile_image_link'])) {
            $user_profile_pic = $u_row['profile_image_link'];
        }
    }
}

$msg = "";

// --- 3. HANDLE WATCHLIST UPDATE ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_watchlist'])) {
    if ($user_id) {
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        
        $check_wl = mysqli_query($conn, "SELECT watchlist_id FROM Watchlist WHERE user_id = '$user_id' AND media_id = '$media_id'");
        
        if (mysqli_num_rows($check_wl) > 0) {
            $update_wl = "UPDATE Watchlist SET status = '$status' WHERE user_id = '$user_id' AND media_id = '$media_id'";
            mysqli_query($conn, $update_wl);
        } else {
            $insert_wl = "INSERT INTO Watchlist (user_id, media_id, status) VALUES ('$user_id', '$media_id', '$status')";
            mysqli_query($conn, $insert_wl);
        }
        // Redirect with ID
        header("Location: MediaPage.php?id=" . $media_id);
        exit();
    } else {
        header("Location: login.php");
        exit();
    }
}

// --- 4. HANDLE REVIEW SUBMISSION ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    if ($user_id) {
        $rating = intval($_POST['rating']);
        $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);
        
        $insert_review = "INSERT INTO Reviews (user_id, media_id, review_text, rating, status) VALUES ('$user_id', '$media_id', '$review_text', '$rating', 'approved')";
        if(mysqli_query($conn, $insert_review)){
             $msg = "Review added!";
        }
    } else {
        header("Location: login.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['toggle_favorite'])) {
    if ($user_id) {
        $check_fav = mysqli_query($conn, "SELECT favorite_id FROM Favorites WHERE user_id = '$user_id' AND media_id = '$media_id'");
        
        if (mysqli_num_rows($check_fav) > 0) {
            mysqli_query($conn, "DELETE FROM Favorites WHERE user_id = '$user_id' AND media_id = '$media_id'");
        } else {
            mysqli_query($conn, "INSERT INTO Favorites (user_id, media_id) VALUES ('$user_id', '$media_id')");
        }
        header("Location: MediaPage.php?id=" . $media_id);
    } else {
        header("Location: login.php");
        exit();
    }
}




$current_status = "plan_to_watch";
$is_favorite = false;

if ($user_id) {
    $wl_query = mysqli_query($conn, "SELECT status FROM Watchlist WHERE user_id = '$user_id' AND media_id = '$media_id'");
    if ($row = mysqli_fetch_assoc($wl_query)) {
        $current_status = $row['status'];
    }

    $fav_query = mysqli_query($conn, "SELECT favorite_id FROM Favorites WHERE user_id = '$user_id' AND media_id = '$media_id'");
    if (mysqli_num_rows($fav_query) > 0) {
        $is_favorite = true;
    }
}

$reviews_query = "SELECT r.*, u.username, u.profile_image_link 
                  FROM Reviews r 
                  JOIN Users u ON r.user_id = u.user_id 
                  WHERE r.media_id = '$media_id' 
                  ORDER BY r.created_at DESC";
$reviews_result = mysqli_query($conn, $reviews_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($media['title']); ?> - MyAnimeList</title>
    <link rel="stylesheet" href="../Css/homeStyle.css">
    <link rel="stylesheet" href="../Css/searchBar.css">
    <link rel="stylesheet" href="../Css/MediaPage.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='home.php'">
                <img src="../Images/download.png" alt="Logo">
            </div>
            <div class="profile">
                <div class="devider1"></div>
                <?php if ($user_id): ?>
                    <span class="profile-name" onclick="window.location.href='../../USER/View/userDashboard.php'"><?php echo htmlspecialchars($username); ?></span>
                    <img src="<?php echo htmlspecialchars($user_profile_pic); ?>" alt="Profile" onclick="window.location.href='../../USER/View/userDashboard.php'">
                    <a href="../Controler/destorySession.php" class="login-link-Log-out">Log Out</a>
                <?php else: ?>
                    <a href="login.php" class="login-link">Log In</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="header-middle">
            <div class="topButton">
                <span onclick="window.location.href='top-Anime.php'">TOP ANIME</span>
                <span onclick="window.location.href='top-Manga.php'">TOP MANGA</span>
            </div>
             <div class="search-bar">
                <input class="search" type="text" placeholder="Search...">
            </div>
        </div>
        <div class="header-lower">
            <span><?php echo htmlspecialchars($media['title']); ?></span>
        </div>
    </header>

    <main>
        <!-- LEFT SIDEBAR -->
        <div class="leftSection">
            
            <div class="media-poster-container">
                <img src="<?php echo htmlspecialchars($media['poster_image_link']); ?>" alt="Poster" class="media-poster">
            </div>

            <!-- WATCHLIST STATUS -->
            <div class="sidebar-fieldset">
                <div class="sidebar-header"><h3>Edit Status</h3></div>
                <?php if ($user_id): ?>
                <form method="POST">
                    <select name="status" class="status-select">
                        <option value="plan_to_watch" <?php if($current_status == 'plan_to_watch') echo 'selected'; ?>>Plan to Watch</option>
                        <option value="watching" <?php if($current_status == 'watching') echo 'selected'; ?>><?php if ($media['type'] == 'movie' || $media['type'] == 'tvshow') echo 'Watching'; else echo 'Reading'; ?></option>
                        <option value="completed" <?php if($current_status == 'completed') echo 'selected'; ?>>Completed</option>
                        <option value="dropped" <?php if($current_status == 'dropped') echo 'selected'; ?>>Dropped</option>
                    </select>
                    <button type="submit" name="update_watchlist" class="btn-action btn-blue">Update Status</button>
                </form>
                <?php else: ?>
                    <p style="font-size:12px; text-align:center;">Please <a href="login.php" style="color:blue;">login</a> to update status.</p>
                <?php endif; ?>
            </div>

             <!-- FAVORITES BUTTON -->
             <div class="sidebar-fieldset" style="margin-top: 10px;">
                <?php if ($user_id): ?>
                <form method="POST">
                     <button type="submit" name="toggle_favorite" class="btn-action btn-pink">
                        <i class="<?php echo $is_favorite ? 'fas' : 'far'; ?> fa-heart"></i> 
                        <?php echo $is_favorite ? 'Remove Favorite' : 'Add to Favorites'; ?>
                     </button>
                </form>
                <?php else: ?>
                    <button class="btn-action btn-pink" onclick="window.location.href='login.php'">Add to Favorites</button>
                <?php endif; ?>
            </div>

            <!-- REVIEW FORM -->
            <div class="sidebar-fieldset" style="margin-top: 10px;">
                <div class="sidebar-header"><h3>Rate & Review</h3></div>
                <?php if ($user_id): ?>
                <form method="POST">
                    <div style="margin-bottom:8px;">
                        <label style="font-size:11px; font-weight:bold;">Your Score:</label>
                        <select name="rating" class="status-select">
                            <option value="10">(10) Masterpiece</option>
                            <option value="9">(9) Great</option>
                            <option value="8">(8) Very Good</option>
                            <option value="7">(7) Good</option>
                            <option value="6">(6) Fine</option>
                            <option value="5">(5) Average</option>
                            <option value="4">(4) Bad</option>
                            <option value="3">(3) Very Bad</option>
                            <option value="2">(2) Horrible</option>
                            <option value="1">(1) Appalling</option>
                        </select>
                    </div>
                    <textarea name="review_text" class="sidebar-textarea" placeholder="Write review..." required></textarea>
                    <button type="submit" name="submit_review" class="btn-action btn-blue">Submit Review</button>
                    <?php if($msg) echo "<div style='color:green; font-size:11px; margin-top:5px; text-align:center;'>$msg</div>"; ?>
                </form>
                <?php else: ?>
                    <p style="font-size:12px; text-align:center;">Please <a href="login.php" style="color:blue;">login</a> to review.</p>
                <?php endif; ?>
            </div>

        </div>

        <div class="rightSection">
            
            <div class="media-header-bar">
                <div class="score-container">
                    <span class="score-label">SCORE</span>
                    <span class="score-value"><?php echo $media['score'] ? $media['score'] : 'N/A'; ?></span>
                    <span class="score-users">scored by users</span>
                </div>
                <div class="rank-container">
                    Ranked <strong>#<?php echo $media_id; ?></strong>
                </div>
            </div>

            <div class="content-block">
                <h2 class="section-heading">Synopsis</h2>
                <p class="synopsis-text">
                    <?php echo nl2br(htmlspecialchars($media['description'])); ?>
                </p>
            </div>

            <div class="content-block">
                <h2 class="section-heading">Details</h2>
                <div class="details-grid">
                    <div class="detail-item"><strong>Type:</strong> <?php echo htmlspecialchars($media['type']); ?></div>
                    <div class="detail-item"><strong>Episodes:</strong> <?php echo htmlspecialchars($media['duration']); ?></div>
                    <div class="detail-item"><strong>Status:</strong> <?php echo htmlspecialchars($media['status']); ?></div>
                    <div class="detail-item"><strong>Aired:</strong> <?php echo htmlspecialchars($media['aired_date']); ?></div>
                    <div class="detail-item"><strong>Producers:</strong> <?php echo htmlspecialchars($media['producer']); ?></div>
                    <div class="detail-item"><strong>Studios:</strong> <?php echo htmlspecialchars($media['studio']); ?></div>
                    <div class="detail-item"><strong>Source:</strong> <?php echo htmlspecialchars($media['source']); ?></div>
                    <div class="detail-item"><strong>Genres:</strong> <?php echo htmlspecialchars($media['genre']); ?></div>
                </div>
            </div>

            <div class="content-block">
                <h2 class="section-heading">User Reviews</h2>
                <div class="reviews-list">
                    <?php if (mysqli_num_rows($reviews_result) > 0): ?>
                        <?php while ($review = mysqli_fetch_assoc($reviews_result)): ?>
                            <div class="review-item">
                                <div class="review-avatar">
                                    <img src="<?php echo !empty($review['profile_image_link']) ? $review['profile_image_link'] : 'https://icon-library.com/images/default-profile-icon/default-profile-icon-24.jpg'; ?>" alt="User">
                                </div>
                                <div class="review-content">
                                    <div class="review-meta">
                                        <span class="review-author"><?php echo htmlspecialchars($review['username']); ?></span>
                                        <div class="review-rating-badge"><?php echo $review['rating']; ?></div>
                                        <span class="review-date"><?php echo date('M d, Y', strtotime($review['created_at'])); ?></span>
                                    </div>
                                    <div class="review-body">
                                        <?php echo nl2br(htmlspecialchars($review['review_text'])); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p style="color:#777;">No reviews yet.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </main>
</body>
</html>