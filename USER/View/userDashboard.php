<?php
session_start();
include("../../HOME/Model/db.php"); 

if (isset($_POST['theme-toggle'])) {
    if (!isset($_SESSION['theme_mode']) || $_SESSION['theme_mode'] == 'light') {
        $_SESSION['theme_mode'] = 'dark';
    } else {
        $_SESSION['theme_mode'] = 'light';
    }
    // Refresh to apply changes and prevent form resubmission
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

// Initialize default stats
$animeStats = [
    'watching' => 0, 'completed' => 0, 'dropped' => 0, 'plan_to_watch' => 0, 
    'total' => 0, 'mean_score' => 0.00
];
$mangaStats = [
    'reading' => 0, 'completed' => 0, 'dropped' => 0, 'plan_to_read' => 0, 
    'total' => 0, 'mean_score' => 0.00
];

if ($conn) {
    if (!isset($_SESSION['username'])) {
        header("Location: ../../HOME/View/login.php");
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
            'watching' => 0, 'completed' => 0, 
            'dropped' => 0, 'plan' => 0
        ];
    }

    // FIX: Check if 'watching' key exists, otherwise use 'reading' (for Manga)
    $watchingCount = isset($stats['watching']) ? $stats['watching'] : (isset($stats['reading']) ? $stats['reading'] : 0);
    
    // FIX: Check if 'plan_to_watch' key exists, otherwise use 'plan_to_read'
    $planCount = isset($stats['plan_to_watch']) ? $stats['plan_to_watch'] : (isset($stats['plan_to_read']) ? $stats['plan_to_read'] : 0);

    // Return an array of percentages
    return [
        'watching'  => ($watchingCount / $total) * 100,
        'completed' => ($stats['completed'] / $total) * 100,
        'dropped'   => ($stats['dropped'] / $total) * 100,
        'plan'      => ($planCount / $total) * 100,
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
    <link rel="stylesheet" href="../Css/userDash.css">
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
                    <span class="profile-name">
                        <?php echo $_SESSION['username']; ?>
                    </span>
                    <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile" onclick="window.location.href='../../USER/View/userDashboard.php'">
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
                $(document).ready(function() {
                    $('#search').on('input', function() {
                        var query = $(this).val();
                        if (query.length > 2) {
                            $.ajax({
                                url: '../../HOME/Controler/searchBarLogic.php',
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
        <div class="header-lower">
            <span>My Panel</span>
            
            <form method="POST">
                <button type="submit" name="theme-toggle" class="login-link" style="background:none; border:none; font-size: 20px; cursor: pointer;">
                    <?php if (isset($_SESSION['theme_mode']) && $_SESSION['theme_mode'] == 'dark') {
                        echo '☀️';
                    } else {
                        echo '🌙';
                    } ?>
                </button>
            </form>
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
                    </div>

                    <div class="days-score-row">
                        <span>Mean Score: <strong><?php echo $animeStats['mean_score']; ?></strong></span>
                    </div>

                    <!-- ANIME PROGRESS BAR -->
                     <div class="main-progress-bar">
                        <div class="stat-bar-segment bg-watching" style="width: <?php echo $animePct['watching']; ?>%" title="Watching"></div>
                        <div class="stat-bar-segment bg-completed" style="width: <?php echo $animePct['completed']; ?>%" title="Completed"></div>
                        <div class="stat-bar-segment bg-dropped" style="width: <?php echo $animePct['dropped']; ?>%" title="Dropped"></div>
                        <div class="stat-bar-segment bg-plan" style="width: <?php echo $animePct['plan']; ?>%" title="Plan to Watch"></div>
                    </div>

                    <div class="stats-grid">
                        <ul class="status-legend">
                            <li><span class="dot watching"></span> Watching <span class="count"><?php echo $animeStats['watching']; ?></span></li>
                            <li><span class="dot completed"></span> Completed <span class="count"><?php echo $animeStats['completed']; ?></span></li>
                            <li><span class="dot dropped"></span> Dropped <span class="count"><?php echo $animeStats['dropped']; ?></span></li>
                            <li><span class="dot plan"></span> Plan to Watch <span class="count"><?php echo $animeStats['plan_to_watch']; ?></span></li>
                        </ul>
                        <ul class="status-totals">
                            <li><span>Total Entries</span> <span><?php echo $animeStats['total']; ?></span></li>
                           
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
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manga Stats -->
            <div class="stats-container manga-section">
                <div class="stats-data-col">
                    <div class="stats-header-row">
                        <h3>Manga Stats</h3>
                    </div>

                    <div class="days-score-row">
                        <span>Mean Score: <strong><?php echo $mangaStats['mean_score']; ?></strong></span>
                    </div>

                    <!-- MANGA PROGRESS BAR -->
                    <div class="main-progress-bar">
                        <div class="stat-bar-segment bg-watching" style="width: <?php echo $mangaPct['watching']; ?>%" title="Reading"></div>
                        <div class="stat-bar-segment bg-completed" style="width: <?php echo $mangaPct['completed']; ?>%" title="Completed"></div>
                        <div class="stat-bar-segment bg-dropped" style="width: <?php echo $mangaPct['dropped']; ?>%" title="Dropped"></div>
                        <div class="stat-bar-segment bg-plan" style="width: <?php echo $mangaPct['plan']; ?>%" title="Plan to Read"></div>
                    </div>

                    <div class="stats-grid">
                        <ul class="status-legend">
                            <li><span class="dot watching"></span> Reading <span class="count"><?php echo $mangaStats['reading']; ?></span></li>
                            <li><span class="dot completed"></span> Completed <span class="count"><?php echo $mangaStats['completed']; ?></span></li>
                            <li><span class="dot dropped"></span> Dropped <span class="count"><?php echo $mangaStats['dropped']; ?></span></li>
                            <li><span class="dot plan"></span> Plan to Read <span class="count"><?php echo $mangaStats['plan_to_read']; ?></span></li>
                        </ul>
                        <ul class="status-totals">
                            <li><span>Total Entries</span> <span><?php echo $mangaStats['total']; ?></span></li>
                            
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

        <script src="../Js/userDashboard_search.js"></script>
        <script src="../Js/homeJSCRIPT.js"></script>
    </main>
</body>

</html>
