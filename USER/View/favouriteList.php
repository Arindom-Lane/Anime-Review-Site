<?php
session_start();
include("../../HOME/Model/db.php");

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: ../../HOME/View/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="../Css/userDash.css"> 
    <link rel="stylesheet" href="../../HOME/Css/topAnime-MangaPage.css"> 
    <link rel="stylesheet" href="../../HOME/Css/searchBar.css">  
</head>
<body>
    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='../../HOME/View/home.php'">
                <img src="../../HOME/Images/download.png" alt="Logo">
            </div>
            <div class="profile">
                <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true): ?>
                <div class="devider1"></div>
                <span class="profile-name" onclick="window.location.href='userDashboard.php'">
                    <?php echo $_SESSION['username']; ?>
                </span>
                <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile">
                <a href="../../HOME/Controler/destorySession.php" class="login-link-Log-out">Log Out</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="header-middle">
            <div class="topButton">
                <span>TOP ANIME</span>
                <span>TOP MANGA</span>
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

                    <div class="sidebar-divider"></div>
                    
                    <div class="sidebar-menu">
                        <input type="button" value="Favorites" class="statbtn">
                    </div>

                    <br>
                    
                </div>
                
                <div class="edit-profile-wrapper" onclick="window.location.href='UserEditProfile.php'">
                    <input type="button" value="Edit Profile" class="editbtn">
                </div>
            </fieldset>
        </div>

        <!-- RIGHT MAIN CONTENT -->
        <div class="rightsection">
                        <div class="admin-box">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Poster</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $curr_user = $_SESSION['username'];
                        $u_sql = "SELECT user_id FROM Users WHERE username = '$curr_user'";
                        $u_res = mysqli_query($conn, $u_sql);
                        $u_row = mysqli_fetch_assoc($u_res);
                        $user_id = $u_row['user_id'];

                        $query = "SELECT m.* FROM Favorites f 
                                  JOIN Media m ON f.media_id = m.media_id 
                                  WHERE f.user_id = '$user_id'";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $row) {
                        ?>
                                <tr>
                                    <td>
                                        <a href="../../HOME/View/MediaPage.php?id=<?php echo $row['media_id']; ?>" class="mediaClick">
                                        <strong><?php echo $row['title'] ?></strong><br><br>
                                        <?php echo substr($row['description'], 0, 150) . '...'; ?><br><br>
                                        <hr>
                                        <strong>Score:</strong> <?php echo $row['score'] ?>,
                                        <strong>Type:</strong> <?php echo $row['type'] ?>,
                                        <strong>Studio:</strong> <?php echo $row['studio'] ?>
                                        <hr>
                                        </a>
                                    </td>
                                    <td>
                                        <img src="<?php echo $row['poster_image_link'] ?>" alt="Poster" style="width:100px; height:auto;">
                                    </td>
                                    <td style="text-align:center;">
                                        <a href="../../HOME/View/MediaPage.php?id=<?php echo $row['media_id']; ?>" style="text-decoration:none; color:blue; font-weight:bold;">View Page</a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="3" style="text-align:center;">Your favourite list is currently empty.</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div> 
                 
                
        </div>
            
    </main>
    
    <script src="../Js/favouriteList.js"></script>
    <script src="../Js/homeJSCRIPT.js"></script>
</body>
</html>
