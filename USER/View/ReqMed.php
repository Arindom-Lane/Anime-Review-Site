<?php
session_start();
include("../../HOME/Model/db.php");

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: ../../HOME/View/login.php');
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $poster = $_POST['poster'];
    $studio = $_POST['studio'];
    $producer = $_POST['producer'];
    $genre = $_POST['genre'];
    $duration = $_POST['duration'];
    $source = $_POST['source'];
    $description = $_POST['description'];
    $requested_by = $_SESSION['username'];

    if (!empty($title) && !empty($type) && !empty($poster) && !empty($studio) && !empty($producer) && !empty($genre) && !empty($duration) && !empty($source)) {

        $sql = "INSERT INTO requestmedia (title, type, poster, studio, producer, genre, duration, source, description, requested_by) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", $title, $type, $poster, $studio, $producer, $genre, $duration, $source, $description, $requested_by);

        if ($stmt->execute()) {
            echo '<script>alert("Request Sent Successfully!");</script>';
        } else {
            $_SESSION['CreateError'] = true;
        }
        $stmt->close();
    } else {
        echo '<script>alert("Please fill up all required sections!");</script>';
    }
}

if (isset($_SESSION['CreateError']) && $_SESSION['CreateError'] == true) {
    echo '<script>alert("Media Creation Error!");</script>';
    $_SESSION['CreateError'] = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="../Css/favourite.css">
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
                    <span class="profile-name" onclick="window.location.href='../../USER/View/userDashboard.php'">
                        <?php echo $_SESSION['username']; ?>
                    </span>
                    <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile"
                        onclick="window.location.href='../../USER/View/userDashboard.php'">
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
                $(document).ready(function () {
                    $('#search').on('input', function () {
                        var query = $(this).val();
                        if (query.length > 2) {
                            $.ajax({
                                url: '../../HOME/Controler/searchBarLogic.php',
                                method: 'POST',
                                data: {
                                    search: query
                                },
                                success: function (data) {
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
            <span>Welcome <?php echo $_SESSION['username']; ?></span>
        </div>
    </header>

    <main>
        <div class="leftSection">
            <div class="leftSide-Container">
                <div class="proImage-container">
                    <img src="<?PHP echo $_SESSION['profileImage']; ?>">
                </div>
                <div class="sidebar-row">
                    <span>ROLE</span>
                    <span class="status-online" style="color: Green;">Registered User</span>
                </div>
                <div class="sidebar-row">
                    <span>STATUS</span>
                    <span class="status-online" style="color: GREEN;">ONLINE</span>
                </div>
                <div class="editProfile">
                    <a href="UserEditProfile.php" class="editProfileHREF">Edit Profile</a>
                </div>
            </div>
        </div>

        <div class="rightsection">


            <div class="admin-box">
                <h2 class="main-header">Create Media</h2>
                <div class="media-overview">
                    <form method="POST" action="../../USER/View/ReqMed.php">
                        <input name="title" placeholder="Title">
                        <select name="type">
                            <option value="movie">Movie</option>
                            <option value="tvshow">TV Show</option>
                            <option value="manga">Manga</option>
                        </select>
                        <input name="poster" placeholder="Poster URL" class="Poster">
                        <input name="studio" placeholder="Studio" class="Studio">
                        <input name="producer" placeholder="Producer" class="Producer">
                        <input name="genre" placeholder="Genre" class="Genre">
                        <input name="duration" placeholder="Duration" class="Duration">
                        <input name="source" placeholder="Source" class="Source">
                        <textarea name="description" placeholder="Description. HTMl syntax (Optional)"
                            class="Description"></textarea>
                        <button type="submit" class="admin-save">Request Access</button>
                    </form>
                </div>
            </div>

            <script src="../Js/ReqMed.js"></script>
            <script src="../Js/homeJSCRIPT.js"></script>
    </main>
    <footer>
        <div class="footer-block">
            <div class="footer-links">
                <p style="border-bottom: 1px solid white; padding: 5px; width: 200px; margin: 0 auto;">Follow Us</p>
                <a href="https://github.com/Arindom-Lane">ARINDOM</a> <strong style="color: azure;">|</strong>
                <a href="https://github.com/ReDThunDeR33">ARKO</a> <strong style="color: azure;">|</strong>
                <a href="https://github.com/Arindom-Lane/Anime-Review-Site">PROJECT REPO</a>
                <img src="../../HOME/Images/github.png" alt="GitHub" class="github-icon"
                    onclick="window.location.href='https://github.com/Arindom-Lane/Anime-Review-Site'">
            </div>
        </div>
    </footer>
</body>

</html>