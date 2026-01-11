<?php
session_start();
include("../../HOME/Model/db.php");



if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {

    header('Location: ../../HOME/View/login.php');
    exit();
}


if (isset($_GET['id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $targetUserId = mysqli_real_escape_string($conn, $_GET['id']);
} else {
    header('Location: admin.php');
    exit();
}


$fetchTarget = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$targetUserId'");
$targetData = mysqli_fetch_assoc($fetchTarget);

$message = "";
$error = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["btn-create"])) {

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $profileImage = mysqli_real_escape_string($conn, $_POST["profileImage"]);

    $query = "UPDATE users SET username = '$username', email = '$email', profile_image_link = '$profileImage' WHERE user_id = '$targetUserId'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $_SESSION['editUserMessage'] = "success";
        header("Location: admin.php");
        exit();
    } else {
        $_SESSION["editUserMessage"] = "error";
        die("Error updating profile: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <script src="../Js/admin.js" defer></script>
    <link rel="stylesheet" href="../Css/AdminUserEditProfile.css">
    <link rel="stylesheet" href="../../HOME/Css/searchBar.css">
    <link rel="stylesheet" href="../Css/admin.css">

</head>

<body>
    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='home.php'">
                <img src="../../HOME/Images/download.png" alt="Logo">
            </div>
            <div class="profile" onclick="window.location.href='../../USER/Controler/userDashboard.php'">
                <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true): ?>
                    <div class="devider1"></div>
                    <span class="profile-name">
                        <?php echo $_SESSION['username']; ?>
                    </span>
                    <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile">
                <?php endif; ?>
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
            <span>Edit Profile</span>
        </div>
    </header>
    <main>
        <form method="POST">
            <div class="feild">
                <label>Change User Name</label>
                <input type="text" name="username" placeholder="<?php echo $targetData['username'] ?>" value="<?php echo $targetData['username'] ?>">
                <button type="submit" name="btn-create" class="btn-create-name">Edit</button>
            </div>

            <div class="feild">
                <label>Change Email</label>
                <input type="email" name="email" minlength="8" placeholder="<?php echo $targetData['email']; ?>" value="<?php echo $targetData['email']; ?>">
                <button type="submit" name="btn-create" class="btn-create-name">Edit</button>
            </div>
            <div class="feild">
                <label>Change Profile Image URL</label>
                <input type="text" name="profileImage" value="<?php echo $targetData['profile_image_link']; ?>">
                <button type="submit" name="btn-create" class="btn-create-name">Edit</button>
            </div>
        </form>
    </main>
</body>

</html>