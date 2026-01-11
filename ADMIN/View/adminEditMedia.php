<?php
session_start();
include("../../HOME/Model/db.php");

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {

    header('Location: ../../HOME/View/login.php');
    exit();
}


if (isset($_GET['id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $mediaId = intval($_GET['id']);
    $targetUserId = mysqli_query($conn, "SELECT * FROM media WHERE media_id = $mediaId");
    $targetData = mysqli_fetch_assoc($targetUserId);
    if (!$targetData) {
        $_SESSION['editMediaMessage'] = "error";
        header('Location: admin.php');
        exit();
    }
} else {
    $_SESSION['editMediaMessage'] = "error";
    header('Location: admin.php');
    exit();
}





if (mysqli_num_rows($targetUserId) > 0) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST["title"];
        $type = $_POST["type"];
        $poster = $_POST["poster_image_link"];
        $studio = $_POST["studio"];
        $producer = $_POST["producer"];
        $genre = $_POST["genre"];
        $duration = $_POST["duration"];
        $source = $_POST["source"];
        $description = $_POST["description"];

        $updateQuery = "UPDATE media SET 
                        title='$title', 
                        description='$description', 
                        type='$type', 
                        poster_image_link='$poster', 
                        producer='$producer', 
                        studio='$studio', 
                        source='$source', 
                        genre='$genre', 
                        duration='$duration' 
                        WHERE media_id='$mediaId'";

        if (mysqli_query($conn, $updateQuery)) {
            $_SESSION['editMediaMessage'] = "success";
            header("Location: admin.php");
            exit();
        } else {
            $_SESSION['editMediaMessage'] = "error";
            header("Location: admin.php");
            exit();
        }
    }
} else {
    header('Location: admin.php');
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="../Css/admin.css">
    <link rel="stylesheet" href="../../HOME/Css/searchBar.css">
    <script src="../Js/admin.js" defer></script>
</head>

<body>
    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='../../HOME/View/home.php'">
                <img src="../../HOME/Images/download.png" alt="Logo">
            </div>
            <div class="profile">
                <a href="admin.php" class="login-link">Dashboard</a>
                <a href="../../HOME/Controler/destorySession.php" class="login-link-Log-out">Log Out</a>
            </div>
        </div>
        <div class="header-middle">
            <div class="topButton">
                <span onclick="window.location.href='admin.php'"> く </span>
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
        </div>
        <div class="header-lower">
            <span>Welcome <?php echo $_SESSION['username']; ?></span>
            <img src="https://cdn-icons-png.freepik.com/512/14911/14911421.png" alt="Menu" id="theme-toggle">
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
                    <span class="status-online" style="color: red;">SITE ADMIN</span>
                </div>
                <div class="sidebar-row">
                    <span>STATUS</span>
                    <span class="status-online" style="color: GREEN;">ONLINE</span>
                </div>
                <div class="editProfile">
                    <a href="../../USER/Controler/UserEditProfile.php" class="editProfileHREF">Edit Profile</a>
                </div>
            </div>
        </div>
        <div class="rightsection">
            <div class="admin-box">
                <h2 class="main-header">Edit Media</h2>
                <div class="media-overview">
                    <form method="POST">
                        <input name="title" placeholder="Title" value="<?php echo $targetData["title"]; ?>">
                        <select name="type">
                            <option value="movie" <?php if ($targetData['type'] === 'movie') {
                                                        echo 'selected';
                                                    } ?>>Movie</option>
                            <option value="tvshow" <?php if ($targetData['type'] === 'tvshow') {
                                                        echo 'selected';
                                                    } ?>>TV Show</option>
                            <option value="manga" <?php if ($targetData['type'] === 'manga') {
                                                        echo 'selected';
                                                    } ?>>Manga</option>
                        </select>
                        <input name="poster_image_link" placeholder="Poster URL" class="Poster" value="<?php echo $targetData["poster_image_link"]; ?>">
                        <input name="studio" placeholder="Studio" class="Studio" value="<?php echo $targetData["studio"]; ?>">
                        <input name="producer" placeholder="Producer" class="Producer" value="<?php echo $targetData["producer"]; ?>">
                        <input name="genre" placeholder="Genre" class="Genre" value="<?php echo $targetData["genre"]; ?>">
                        <input name="duration" placeholder="Duration" class="Duration" value="<?php echo $targetData["duration"]; ?>">
                        <input name="source" placeholder="Source" class="Source" value="<?php echo $targetData["source"]; ?>">
                        <textarea name="description" placeholder="Description. HTMl syntax (Optional)" class="Description"><?php echo $targetData["description"]; ?></textarea>
                        <button type="submit" class="admin-save" onclick="return confirm('Insert this media?')">Save Media</button>
                    </form>
                </div>
            </div>
            <center>
                <a href="admin.php" class="editProfileHREF" style="width: 250px; height: auto; font-size: 17px;">Back to Dashboard</a>
            </center>
        </div>

    </main>
</body>

</html>