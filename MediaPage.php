<?php
session_start();
include("db.php");
/*
if (!isset($_GET['id'])) {
    header("Location: home.php");
    exit();
}

$media_id = intval($_GET['id']);


$user_id = null;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $u_query = mysqli_query($conn, "SELECT user_id FROM Users WHERE username = '$username'");
    if ($u_row = mysqli_fetch_assoc($u_query)) {
        $user_id = $u_row['user_id'];
    }
}
*/
$user_id = 7;
$media_id = 10; // For testing purposes
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_watchlist'])) {
    $status = $_POST['status'];
    $check_wl = mysqli_query($conn, "SELECT watchlist_id FROM Watchlist WHERE user_id = '$user_id' AND media_id = '$media_id'");
    
    if (mysqli_num_rows($check_wl) > 0) {
        $update_wl = "UPDATE Watchlist SET status = '$status' WHERE user_id = '$user_id' AND media_id = '$media_id'";
        mysqli_query($conn, $update_wl);
    } else {
        $insert_wl = "INSERT INTO Watchlist (user_id, media_id, status) VALUES ('$user_id', '$media_id', '$status')";
        mysqli_query($conn, $insert_wl);
    }
    header("Location: MediaPage.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    $rating = intval($_POST['rating']);
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);
    
    $insert_review = "INSERT INTO Reviews (user_id, media_id, review_text, rating, status) VALUES ('$user_id', '$media_id', '$review_text', '$rating', 'approved')";
    if(mysqli_query($conn, $insert_review)){
         $msg = "Review added!";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['toggle_favorite'])) {
    header("Location: MediaPage.php");
    exit();
}

$query = "SELECT * FROM Media WHERE media_id = '$media_id'";
$result = mysqli_query($conn, $query);
$media = mysqli_fetch_assoc($result);

$current_status = "plan_to_watch";
$wl_query = mysqli_query($conn, "SELECT status FROM Watchlist WHERE user_id = '$user_id' AND media_id = '$media_id'");
if ($row = mysqli_fetch_assoc($wl_query)) {
    $current_status = $row['status'];
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
    <link rel="stylesheet" href="homeStyle.css">
    <link rel="stylesheet" href="searchBar.css">
    <link rel="stylesheet" href="MediaPage.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='userDashboard.php'">
                <img src="https://cdn.myanimelist.net/images/mal-logo-xsmall.png?v=1634263200">
            </div>
            <div class="profile">
                <div class="devider1"></div>
                <span class="profile-name">User #7</span>
                <img src="https://icon-library.com/images/default-profile-icon/default-profile-icon-24.jpg" alt="Profile">
                <a href="#" class="login-link-Log-out">Log Out</a>
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
            <span><?php echo htmlspecialchars($media['title']); ?></span>
        </div>
    </header>

    <main>
        <!-- LEFT SIDEBAR: User Actions (Poster, Status, Favorite, Review Form) -->
        <div class="leftSection">
            
            <div class="media-poster-container">
                <img src="<?php echo htmlspecialchars($media['poster_image_link']); ?>" alt="Poster" class="media-poster">
            </div>

            <div class="sidebar-fieldset">
                <div class="sidebar-header"><h3>Edit Status</h3></div>
                <form method="POST">
                    <select name="status" class="status-select">
                        <option value="plan_to_watch" <?php if($current_status == 'plan_to_watch') echo 'selected'; ?>>Plan to Watch</option>
                        <option value="watching" <?php if($current_status == 'watching') echo 'selected'; ?>>Watching</option>
                        <option value="completed" <?php if($current_status == 'completed') echo 'selected'; ?>>Completed</option>
                        <option value="dropped" <?php if($current_status == 'dropped') echo 'selected'; ?>>Dropped</option>
                    </select>
                    <button type="submit" name="update_watchlist" class="btn-action btn-blue">Update Status</button>
                </form>
            </div>

             <div class="sidebar-fieldset" style="margin-top: 10px;">
                <form method="POST">
                     <button type="submit" name="toggle_favorite" class="btn-action btn-pink">
                        <i class="fas fa-heart"></i> Add to Favorites
                     </button>
                </form>
            </div>

            <div class="sidebar-fieldset" style="margin-top: 10px;">
                <div class="sidebar-header"><h3>Rate & Review</h3></div>
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
                                    <img src="<?php echo $review['profile_image_link']; ?>" alt="User">
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