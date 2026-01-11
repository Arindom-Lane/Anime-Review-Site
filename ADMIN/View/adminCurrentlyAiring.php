<?php
session_start();
include("../../HOME/Model/db.php");


if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true && $_SESSION['role'] != 'admin') {
    header('Location: ../../HOME/View/login.php');
    exit();
} elseif ($_SESSION['role'] == 'registered') {
    header('Location: ../../HOME/View/home.php');
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
                    $(body).click(function(e) {
                        if (!$(e.target).closest('.search-bar').length) {
                            $('#search-results').hide();
                        }
                    });
                });
            </script>
        </div>
        <div class="header-lower">
            <span>Welcome, <?php echo strtoupper($_SESSION['username']); ?></span>
            <form method="POST" action="../Controler/adminLogic.php">
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
                    <a href="../../USER/Controler/UserEditProfile.php" class="editProfileHREF">Edit Profile</a>
                </div>
            </div>
        </div>

        <div class="rightsection">
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
                            $result = mysqli_query($conn, "SELECT * FROM currentlyairingmedia WHERE CONCAT(title,media_id) LIKE '%$filterValue%'");

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
                                            <a href="adminEditCurrentlyAiringMedia.php?id=<?php echo $row['media_id']; ?>" name="editMediaData" class="editProfileHREF" style="width: 150px; height: auto; text-align: center; margin-right: 10px;">Edit</a>
                                            <a href="../Controler/adminDeleteCurrentlyAiringMedia.php?id=<?php echo $row['media_id']; ?>" ...>Delete</a>
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
                <h2 class="main-header">Add to currently Airing Media Table</h2>
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
                        <button type="submit" class="admin-save" name="create_media" onclick="return confirm('Insert this media?')">Save Media</button>
                    </form>
                </div>
            </div>
    </main>
</body>

</html>