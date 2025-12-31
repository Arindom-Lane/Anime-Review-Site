<?php
session_start();
include("db.php");

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true && $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
} elseif ($_SESSION['role'] == 'registered') {
    header('Location: home.php');
}

if (isset($_SESSION['CreateError'])) {
    if ($_SESSION['CreateError'] == "success") {
        echo "<script>alert('Media created successfully!');</script>";
    } elseif ($_SESSION['CreateError'] == "error") {
        echo "<script>alert('Error creating media. Please try again later.');</script>";
    }
    unset($_SESSION['CreateError']);
}
if (isset($_SESSION['DeleteMediaSuccess'])) {
    if ($_SESSION['DeleteMediaSuccess'] == "deleted") {
        echo "<script>alert('Media deleted successfully!');</script>";
    } elseif ($_SESSION['DeleteMediaSuccess'] == "error") {
        echo "<script>alert('Error deleting media. Please try again later.');</script>";
    }
    unset($_SESSION['DeleteMediaSuccess']);
}
if (isset($_SESSION['editMediaMessage'])) {
    if ($_SESSION['editMediaMessage'] == "success") {
        echo "<script>alert('Media updated successfully!');</script>";
    } elseif ($_SESSION['editMediaMessage'] == "error") {
        echo "<script>alert('Error updating media. Please try again later.');</script>";
    }
    unset($_SESSION['editMediaMessage']);
}
if (isset($_SESSION['editUserMessage'])) {
    if ($_SESSION['editUserMessage'] == "success") {
        echo "<script>alert('User updated successfully!');</script>";
    } elseif ($_SESSION['editUserMessage'] == "error") {
        echo "<script>alert('Error updating user. Please try again later.');</script>";
    }
    unset($_SESSION['editUserMessage']);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="admin.css">
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
                <span>TOP ANIME</span>
                <span>TOP MANGA</span>
            </div>
            <div class="search-bar">
                <input class="search" type="text" placeholder="Search...">
            </div>
        </div>
        <div class="header-lower">
            <span>Welcome, <?php echo strtoupper($_SESSION['username']); ?></span>
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
            <div class="admin-box"> <!-- show media count -->
                <h2>Meida Overview</h2>
                <div class="media-overview">
                    <span>Users</span>
                    <span>Media</span>
                    <span>Anime</span>
                    <span>Manga</span>
                </div>
            </div>
            <div class="admin-box"><!-- User Management -->
                <h2 class="main-header">User Management</h2>
                <form method="GET">
                    <input type="search" name="search" style="min-width:400px;" placeholder="User name, Email.." required value="<?php if (isset($_GET['search'])) {
                                                                                                                                        echo $_GET['search'];
                                                                                                                                    } ?>">
                    <button type="submit" class="lookUp" style="margin-left:15px;">Look Up</button>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Mail</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($_GET['search'])) {
                            $filterValue = $_GET['search'];
                            $result = mysqli_query($conn, "SELECT * FROM users WHERE CONCAT(username,email,user_id) LIKE '%$filterValue%'");
                            unset($filterValue);
                            if (mysqli_num_rows(result: $result) > 0) {
                                foreach ($result as $row) {
                        ?>
                                    <tr>
                                        <td><?php echo $row['user_id'] ?></td>
                                        <td><?php echo $row['username'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td style="display: flex;">
                                            <a href="AdminUserEditProfile.php?id=<?php echo $row['user_id']; ?>" class="editProfileHREF" style="width: 150px; height: auto; text-align: center; margin-right: 10px;">Edit</a>
                                            <a href="adminDeleteUser.php?id=<?php echo $row['user_id']; ?>" class="editProfileHREF" style="width: 150px; height: auto; text-align: center;" onclick="return confirm('Delete this user?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="4">No record is found</td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="admin-box"><!-- Media Management -->
                <h2 class="main-header">Media Management</h2>
                <form method="GET">
                    <input type="search" name="searchMedia" style="min-width:400px;" placeholder="Movie, TV-show, Manga.." required value="<?php if (isset($_GET['searchMedia'])) {
                                                                                                                                                echo $_GET['searchMedia'];
                                                                                                                                            } ?>">
                    <button type="submit" class="lookUp" style="margin-left:15px;">Look Up</button>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Poster</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 5px;">

                        <?php
                        if (isset($_GET['searchMedia'])) {
                            $filterValue = $_GET['searchMedia'];
                            $result = mysqli_query($conn, "SELECT * FROM media WHERE CONCAT(title,media_id) LIKE '%$filterValue%'");

                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $row) {
                        ?>
                                    <tr>
                                        <td><strong><?php echo $row['title'] ?></strong><br><br>
                                            <?php echo $row['description'] ?><br><br>
                                            <hr>
                                            <strong>type:</strong> <?php echo $row['type'] ?>,
                                            <strong>score:</strong> <?php echo $row['score'] ?>,
                                            <strong>studio:</strong> <?php echo $row['studio'] ?>,
                                            <strong>source:</strong> <?php echo $row['source'] ?>
                                            <hr><br><br>

                                        </td>
                                        <td><img src="<?php echo $row['poster_image_link'] ?>" alt="Poster" style="width:100px; height:auto;"></td>
                                        <td style="display: flex;">
                                            <a href="adminEditMedia.php?id=<?php echo $row['media_id']; ?>" name="editMediaData" class="editProfileHREF" style="width: 150px; height: auto; text-align: center; margin-right: 10px;">Edit</a>
                                            <a href="adminDeleteMedia.php?id=<?php echo $row['media_id']; ?>" class="editProfileHREF" style="width: 150px; height: auto; text-align: center;" onclick="return confirm('Delete this media?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="4">No record is found</td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="admin-box"><!-- Create media form -->
                <h2 class="main-header">Create Media</h2>
                <div class="media-overview">
                    <form method="POST" action="adminCreate.php">
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
                        <textarea name="description" placeholder="Description. HTMl syntax (Optional)" class="Description"></textarea>
                        <button type="submit" class="admin-save" onclick="return confirm('Insert this media?')">Save Media</button>
                    </form>
                </div>
            </div>
    </main>
</body>

</html>