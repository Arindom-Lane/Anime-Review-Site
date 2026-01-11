<?php
session_start();
include("../../HOME/Model/db.php");

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true && $_SESSION['role'] != 'admin') {
    header('Location: ../../HOME/View/login.php');
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_article'])) {
    $image_url = $_POST['image_url'];
    $article_url = $_POST['article_url'];

    $insertQuery = "INSERT INTO articles (image_url, article_url) VALUES ($image_url, $article_url)";

    if ($stmt->execute()) {
        $_SESSION['CreateError'] = "success";
    } else {
        $_SESSION['CreateError'] = "error";
    }
    $stmt->close();
    header('Location: adminArticles.php');
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
            <div class="logo" onclick="window.location.href='home.php'">
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
            </div>
        </div>

        <div class="rightsection">
            <div class="admin-box"><!-- Media Management -->
                <h2 class="main-header">Articles Management</h2>
                <form method="GET">
                    <input type="search" name="searchMedia" style="min-width:400px;" placeholder="Movie, TV-show, Manga.." required value="<?php if (isset($_GET['searchMedia'])) {
                                                                                                                                            } ?>">
                    <button type="submit" class="lookUp" style="margin-left:15px;">Look Up</button>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th>Article ID</th>
                            <th>Image Preview</th>
                            <th>Article Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 5px;">

                        <?php
                        if (isset($_GET['searchMedia'])) {
                            $filterValue = $_GET['searchMedia'];
                            $result = mysqli_query($conn, "SELECT * FROM articles WHERE articles_id LIKE '%$filterValue%' OR article_url LIKE '%$filterValue%'");
                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $row) {
                        ?>
                                    <tr>
                                        <td><?php echo $row['articles_id'] ?></td>
                                        <td><img src="<?php echo $row['image_url'] ?>" style="width:100px; height:auto;"></td>
                                        <td><a href="<?php echo $row['article_url'] ?>" target="_blank">View Article</a></td>
                                        <td style="display: flex;">
                                            <a href="../Controler/adminDeleteArticles.php?id=<?php echo $row['articles_id']; ?>" class="editProfileHREF" onclick="return confirm('Delete article?')">Delete</a>
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
                    <form method="POST">
                        <input name="image_url" placeholder="Image URL" required>
                        <input name="article_url" placeholder="Article URL" required>
                        <button type="submit" class="admin-save" name="create_article">Save Article</button>
                    </form>
                </div>
            </div>
    </main>
</body>

</html>