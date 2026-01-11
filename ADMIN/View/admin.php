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
    <link rel="stylesheet" href="searchBar.css">
    <script src="admin.js" defer></script>

</head>

<body>

    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='home.php'">
                <img src="download.png" alt="Logo">
            </div>
            <div class="profile">
                <a href="destorySession.php" class="login-link-Log-out">Log Out</a>
            </div>
        </div>
        <div class="header-middle">
            <div class="topButton">
                <span onclick="window.location.href='adminMediaControl.php'">Media Control</span>
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
                                url: 'searchBarLogic.php',
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
                    <a href="userDashboard.php" class="editProfileHREF">User Profile</a>
                </div>
            </div>
        </div>

        <div class="rightsection">

            <div class="admin-box"> <!-- show media count div-->
                <h2>Site Overview</h2>
                <div class="media-overview">
                    <span>Users: <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users")); ?></span>
                    <span>Media: <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM media")); ?></span>
                    <span>TV-shows: <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM media WHERE type = 'tvshow'")); ?></span>
                    <span>Mangas: <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM media WHERE type = 'manga'")); ?></span>
                </div>
            </div>
            <div class="admin-box"><!-- User Management div-->
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
            <div class="admin-box"> <!-- DB CONTROL DIV  -->
                <h2>DB & Home Page Control Board</h2>
                <br>
                <button class="greyButton" onclick="window.location.href='adminCurrentlyAiring.php'">Currently Airing</button>
                <button class="greyButton">Top Upcoming</button>
                <button class="greyButton" onclick="window.location.href='adminArticles.php'">Articles</button>
                <button class="greyButton" onclick="window.location.href='adminTrailers.php'">Trailers</button>
            </div>

        </div>

    </main>
</body>

</html>