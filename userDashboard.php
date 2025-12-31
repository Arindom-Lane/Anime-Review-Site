<?php
session_start();
include("db.php"); 

// Initialize default stats
$animeStats = [
    'watching' => 0, 'completed' => 0, 'on_hold' => 0, 'dropped' => 0, 'plan_to_watch' => 0, 
    'total' => 0, 'mean_score' => 0.00
];
$mangaStats = [
    'reading' => 0, 'completed' => 0, 'on_hold' => 0, 'dropped' => 0, 'plan_to_read' => 0, 
    'total' => 0, 'mean_score' => 0.00
];

if ($conn) {
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $currentUser = mysqli_real_escape_string($conn, $_SESSION['username']);


    $user_sql = "SELECT * FROM users WHERE username = '$currentUser'";
    $user_result = mysqli_query($conn, $user_sql);
    
    if($user_row = mysqli_fetch_assoc($user_result)){
        if(isset($user_row['id'])){
            $userId = $user_row['id'];
        } elseif(isset($user_row['user_id'])){
            $userId = $user_row['user_id'];
        } else {
            die("Error: Could not find 'id' or 'user_id' column in your 'users' table. Please check your database structure.");
        }
    } else {
        die("User not found in database.");
    } 

    function getMediaStats($conn, $uId, $types) {
        $typeString = "'" . implode("','", $types) . "'";
        
        // 1. Get Counts per Status
        $sql = "SELECT w.status, COUNT(*) as count 
                FROM Watchlist w 
                JOIN Media m ON w.media_id = m.media_id 
                WHERE w.user_id = $uId AND m.type IN ($typeString) 
                GROUP BY w.status";
        
        $result = mysqli_query($conn, $sql);
        $data = [];
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[$row['status']] = $row['count'];
            }
        }

        // 2. Get Mean Score from Reviews
        $sqlScore = "SELECT AVG(r.rating) as mean_score
                     FROM Reviews r 
                     JOIN Media m ON r.media_id = m.media_id 
                     WHERE r.user_id = $uId AND m.type IN ($typeString)";
        
        $resultScore = mysqli_query($conn, $sqlScore);
        $meanScore = 0;
        
        if ($resultScore) {
            $rowScore = mysqli_fetch_assoc($resultScore);
            $meanScore = $rowScore['mean_score'];
        }

        return [
            'watching'      => isset($data['watching']) ? $data['watching'] : 0,
            'completed'     => isset($data['completed']) ? $data['completed'] : 0,
            'on_hold'       => isset($data['on_hold']) ? $data['on_hold'] : 0,
            'dropped'       => isset($data['dropped']) ? $data['dropped'] : 0,
            'plan_to_watch' => isset($data['plan_to_watch']) ? $data['plan_to_watch'] : 0,
            'total'         => array_sum($data),
            'mean_score'    => number_format((float)$meanScore, 2)
        ];
    }

    // --- EXECUTE FOR ANIME ---
    $animeStats = getMediaStats($conn, $userId, ['movie', 'tvshow']);

    // --- EXECUTE FOR MANGA ---
    $mangaData = getMediaStats($conn, $userId, ['manga']);
    
    // Map keys for Manga
    $mangaStats = [
        'reading'      => $mangaData['watching'],
        'completed'    => $mangaData['completed'],
        'on_hold'      => $mangaData['on_hold'],
        'dropped'      => $mangaData['dropped'],
        'plan_to_read' => $mangaData['plan_to_watch'],
        'total'        => $mangaData['total'],
        'mean_score'   => $mangaData['mean_score']
    ];
}

// --- COMMENT LOGIC ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
    $commentText = htmlspecialchars(trim($_POST['user_comment']));
    if (!empty($commentText)) {
        $userDisplay = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
        $newComment = [
            'id'   => uniqid(),
            'user' => $userDisplay, 
            'text' => $commentText,
            'date' => date('M d, Y H:i')
        ];
        if (!isset($_SESSION['post_comments'])) { $_SESSION['post_comments'] = []; }
        $_SESSION['post_comments'][] = $newComment;
    }
}

// --- CALCULATE BAR WIDTHS ---

function calculatePercentages($stats) {
    $total = $stats['total'];
    
    // Avoid division by zero
    if ($total == 0) {
        return [
            'watching' => 0, 'completed' => 0, 'on_hold' => 0, 
            'dropped' => 0, 'plan' => 0
        ];
    }

    // Return an array of percentages
    return [
        'watching'  => ($stats['watching'] / $total) * 100,
        'completed' => ($stats['completed'] / $total) * 100,
        'on_hold'   => ($stats['on_hold'] / $total) * 100,
        'dropped'   => ($stats['dropped'] / $total) * 100,
        // For manga, 'plan_to_read' maps to 'plan_to_watch' key logic here for simplicity
        'plan'      => ((isset($stats['plan_to_watch']) ? $stats['plan_to_watch'] : $stats['plan_to_read']) / $total) * 100,
    ];
}

// Get Anime Percentages
$animePct = calculatePercentages($animeStats);

// Get Manga Percentages
$mangaPct = calculatePercentages($mangaStats);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="userDash.css">
</head>

<body>
    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='home.php'">
                <img src="https://cdn.myanimelist.net/images/mal-logo-xsmall.png?v=1634263200">
            </div>
            <div class="profile">
                <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true): ?>
                    <div class="devider1"></div>
                    <span class="profile-name">
                        <?php echo $_SESSION['username']; ?>
                    </span>
                    <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile">
                    <a href="destorySession.php" class="login-link-Log-out">Log Out</a>
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
            <img src="https://cdn-icons-png.freepik.com/512/14911/14911421.png" alt="Menu">
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

                    <div class="list-btn-row">
                        <input type="button" value="Anime List" class="list-btn">
                        <input type="button" value="Manga List" class="list-btn">
                    </div>

                    <div class="sidebar-divider">

                        <div class="sidebar-menu">
                            <input type="button" value="Favorites" class="statbtn" onclick="window.location.href='favouriteList.php'">
                            <input type="button" value="Add Media Contribution" class="statbtn" onclick="window.location.href='ReqMed.php'">
                        </div>
                    </div>



                    <br>

                </div>

                <div class="edit-profile-wrapper" onclick="window.location.href='UserEditProfile.php'">
                    <input type="button" value="Edit Profile" class="editbtn">
                </div>
            </fieldset>
        </div>

        <!-- RIGHT MAIN CONTENT -->
                <!-- RIGHT MAIN CONTENT -->
        <div class="rightsection">
            <h2 class="main-header">Statistics</h2>

            <!-- Anime Stats -->
            <div class="stats-container">
                <div class="stats-data-col">
                    <div class="stats-header-row">
                        <h3>Anime Stats</h3>
                        <a href="#">All Anime Stats</a>
                    </div>

                    <div class="days-score-row">
                        <span>Days: <strong>0.0</strong></span>
                        <span>Mean Score: <strong><?php echo $animeStats['mean_score']; ?></strong></span>
                    </div>

                    <!-- ANIME PROGRESS BAR -->
                     <div class="main-progress-bar">
                        <div class="stat-bar-segment bg-watching" style="width: <?php echo $animePct['watching']; ?>%" title="Watching"></div>
                        <div class="stat-bar-segment bg-completed" style="width: <?php echo $animePct['completed']; ?>%" title="Completed"></div>
                        <div class="stat-bar-segment bg-onhold" style="width: <?php echo $animePct['on_hold']; ?>%" title="On-Hold"></div>
                        <div class="stat-bar-segment bg-dropped" style="width: <?php echo $animePct['dropped']; ?>%" title="Dropped"></div>
                        <div class="stat-bar-segment bg-plan" style="width: <?php echo $animePct['plan']; ?>%" title="Plan to Watch"></div>
                    </div>

                    <div class="stats-grid">
                        <ul class="status-legend">
                            <li><span class="dot watching"></span> Watching <span class="count"><?php echo $animeStats['watching']; ?></span></li>
                            <li><span class="dot completed"></span> Completed <span class="count"><?php echo $animeStats['completed']; ?></span></li>
                            <li><span class="dot onhold"></span> On-Hold <span class="count"><?php echo $animeStats['on_hold']; ?></span></li>
                            <li><span class="dot dropped"></span> Dropped <span class="count"><?php echo $animeStats['dropped']; ?></span></li>
                            <li><span class="dot plan"></span> Plan to Watch <span class="count"><?php echo $animeStats['plan_to_watch']; ?></span></li>
                        </ul>
                        <ul class="status-totals">
                            <li><span>Total Entries</span> <span><?php echo $animeStats['total']; ?></span></li>
                            <li><span>Rewatched</span> <span>0</span></li>
                            <li><span>Episodes</span> <span>0</span></li>
                        </ul>
                    </div>
                </div>

                <div class="stats-updates-col">
                    <div class="stats-header-row">
                        <h3>Last Anime Updates</h3>
                        <a href="#">Anime History</a>
                    </div>
                    <div class="update-item">
                        <div class="no-updates">
                            No updates yet. <a href="#">Edit list now.</a>
                            <!--
                <img src="https://cdn.myanimelist.net/images/anime/1697/151793.jpg" alt="Anime Image">
                <div class="update-info">
                    <a href="#" class="title-link">Spy x Family Season 3</a>
                    <div class="thin-progress-bar">
                        <div class="fill green" style="width: 100%;"></div>
                    </div>
                    <div class="update-meta">
                        <span>Watching <strong>13</strong>/13 · Scored -</span>
                        <span class="date">Dec 5, 9:37 AM</span>
                    </div> 
                </div>
-->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manga Stats -->
            <div class="stats-container manga-section">
                <div class="stats-data-col">
                    <div class="stats-header-row">
                        <h3>Manga Stats</h3>
                        <a href="#">All Manga Stats</a>
                    </div>

                    <div class="days-score-row">
                        <span>Days: <strong>0.0</strong></span>
                        <span>Mean Score: <strong><?php echo $mangaStats['mean_score']; ?></strong></span>
                    </div>

                    <div class="main-progress-bar">
                        <div class="bar-fill grey width-100"></div>
                    </div>

                    <div class="stats-grid">
                        <ul class="status-legend">
                            <li><span class="dot watching"></span> Reading <span class="count"><?php echo $mangaStats['reading']; ?></span></li>
                            <li><span class="dot completed"></span> Completed <span class="count"><?php echo $mangaStats['completed']; ?></span></li>
                            <li><span class="dot onhold"></span> On-Hold <span class="count"><?php echo $mangaStats['on_hold']; ?></span></li>
                            <li><span class="dot dropped"></span> Dropped <span class="count"><?php echo $mangaStats['dropped']; ?></span></li>
                            <li><span class="dot plan"></span> Plan to Read <span class="count"><?php echo $mangaStats['plan_to_read']; ?></span></li>
                        </ul>
                        <ul class="status-totals">
                            <li><span>Total Entries</span> <span><?php echo $mangaStats['total']; ?></span></li>
                            <li><span>Reread</span> <span>0</span></li>
                            <li><span>Chapters</span> <span>0</span></li>
                            <li><span>Volumes</span> <span>0</span></li>
                        </ul>
                    </div>
                </div>

                <div class="stats-updates-col">
                    <div class="stats-header-row">
                        <h3>Last Manga Updates</h3>
                        <a href="#">Manga History</a>
                    </div>
                    <div class="no-updates">
                        No updates yet. <a href="#">Edit list now.</a>
                    </div>
                </div>
            </div>
            <div>

                <h2>Comments</h2>
                <form action="" method="POST">
                    <textarea name="user_comment" class="comment-box" placeholder="Add a comment..." rows="4" required></textarea>
                    <br>
                    <button type="submit" name="submit_comment" class="editbtn" style="margin-top: 10px; cursor: pointer;">
                        Post Comment
                    </button>
                </form>

                <div class="comments-display" style="margin-top: 20px;">
                    <?php
                    if (isset($_SESSION['post_comments']) && !empty($_SESSION['post_comments'])) {
                        $comments = array_reverse($_SESSION['post_comments']);

                        foreach ($comments as $comment) {
                            echo '<div class="comment-item" >';
                            echo '<div class="comment-header">';
                            echo '<div><strong>' . $comment['user'] . '</strong> <span class="comment-date">(' . $comment['date'] . ')</span></div>';


                            if ($comment['user'] === $_SESSION['username']) {
                                echo '<form action="" method="POST" class="delete-form">';
                                echo '<input type="hidden" name="comment_id" value="' . $comment['id'] . '">';
                                echo '<button type="submit" name="delete_comment" class="delete-btn">Delete</button>';
                                echo '</form>';
                            }
                            echo '</div>';
                            echo '<p class="comment-text">' . $comment['text'] . '</p>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>



        </div>
        </div>

        <script src="userDashboard.js"></script>
    </main>
</body>

</html>