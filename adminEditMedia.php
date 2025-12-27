<?php 
session_start();
include("db.php");


if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    
    header('Location: login.php');
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
    <link rel="stylesheet" href="admin.css">    
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
                <span>TOP ANIME</span>
                <span>TOP MANGA</span>
            </div>
            <div class="search-bar">
                <input class="search" type="text" placeholder="Search...">
            </div>
        </div>
        <div class="header-lower">
            <span>Welcome <?php echo $_SESSION['username'];?></span>
            <img src="https://cdn-icons-png.freepik.com/512/14911/14911421.png" alt="Menu">
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
                    <a href="UserEditProfile.php" class="editProfileHREF">Edit Profile</a>
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
                        <option value="movie" <?php if($targetData['type'] === 'movie'){ echo 'selected'; } ?>>Movie</option>
                        <option value="tvshow" <?php if($targetData['type'] === 'tvshow'){ echo 'selected'; } ?>>TV Show</option>
                        <option value="manga" <?php if($targetData['type'] === 'manga'){ echo 'selected'; } ?>>Manga</option>
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
        </div>
</main>
</body>
</html>