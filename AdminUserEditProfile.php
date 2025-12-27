<?php
session_start();
include("db.php");


if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    
    header('Location: login.php');
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


if (isset($_POST["btn-create"])) {
    // Use DB values as defaults
    $name = isset($_POST["username"]) && $_POST["username"] !== "" ? $_POST["username"] : $targetData['username'];
    $profileImage = isset($_POST["profileImage"]) && $_POST["profileImage"] !== "" ? $_POST["profileImage"] : $targetData['profile_image_link'];


    if (!empty($_POST["password"])) {
        $password = $_POST["password"];
        $passwordQueryPart = ", `password` = '$password'";
    } else {
        $passwordQueryPart = "";
    }

    $query = "UPDATE `users` SET
              `username` = '$name'
              $passwordQueryPart,
              `profile_image_link` = '$profileImage'
              WHERE `user_id` = '$targetUserId'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $fetchTarget = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$targetUserId'");
        $targetData = mysqli_fetch_assoc($fetchTarget);

        if ((int)$targetUserId === (int)$_SESSION['userId']) {
            $_SESSION['username'] = $targetData['username'];
            if (isset($targetData['email'])) {
                $_SESSION['email'] = $targetData['email'];
            }
            $_SESSION['profileImage'] = $targetData['profile_image_link'];
        }

        $message = "Profile updated successfully!";
    } else {
        $error = "Query Failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="UserEditProfile.css">    
</head>
<body>
    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='home.php'">
                <img src="https://cdn.myanimelist.net/images/mal-logo-xsmall.png?v=1634263200">
            </div>
            <div class="profile" onclick="window.location.href='userDashboard.php'">
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
                <span>TOP ANIME</span>
                <span>TOP MANGA</span>
            </div>
            <div class="search-bar">
                <input class="search" type="text" placeholder="Search...">
            </div>
        </div>
        <div class="header-lower">
            <span>Edit Profile</span>
            <img src="https://cdn-icons-png.freepik.com/512/14911/14911421.png" alt="Menu">
        </div>
    </header>
    <main>
        <form method="POST">
        <div class="feild">
            <label>Change User Name</label>
            <input type="text" name="username" >
            <button type="submit" name="btn-create" class="btn-create-name">Edit</button>
        </div>
        
        <div class="feild">
            <label>Change Password</label>
            <input type="password"name="password" minlength="8" placeholder="minimum 8 character" >
            <button type="submit" name="btn-create" class="btn-create-name">Edit</button>
        </div>
        <div class="feild">
            <label>Change Profile Image URL</label>
            <input type="text" name="profileImage" >
            <button type="submit" name="btn-create" class="btn-create-name">Edit</button>
            
        </div>
        
    </form>

    <?php if(!$_SESSION['role'] == 'admin'): ?>
        <div class="show-details">
            <form method="POST">
                <input type="submit" name="btn-show-details" class="show details-btn" value="Show Details" >
                 <input type="submit" name="btn-hide-details" class="show details-btn" value="Hide Details" >
            </form>
        </div>
    <?php else: ?>
        <div class="show-details" >
                <a href="admin.php" class="show details-btn" style="text-decoration:none; text-align:center; display:inline-block;">Go Back</a>            </form>
        </div>
    <?php endif; ?>
       

    </main>

    