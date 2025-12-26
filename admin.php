<?php
    session_start();
    include("db.php");

 if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
    header('Location: login.php');
 }
 elseif($_SESSION['role']=='registered'){
    header('Location: home.php');
 }
 
 if($_SESSION['CreateError'] == true){
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
                    <a href="wdad" class="editProfileHREF">Edit Profile</a>
                </div>
            </div>
        </div>

        <div class="rightsection">

        <div class="admin-box">
            <h2>Meida Overview</h2>
            <div class="media-overview">
                <span>Users</span>
                <span>Media</span>
                <span>Anime</span>
                <span>Manga</span>
            </div>
        </div>
        <div class="admin-box">
            <h2 class="main-header">User Management</h2>
                <form method="GET">
                    <input type="search" name="search" style="min-width:400px;" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>">
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
                                if(isset($_GET['search'])){
                                    $filterValue = $_GET['search']; 
                                    $result = mysqli_query($conn,"SELECT * FROM users WHERE CONCAT(username,email,user_id) LIKE '%$filterValue%'");
                                    
                                    if(mysqli_num_rows($result) > 0){
                                        foreach($result as $row){
                                        ?>
                                            <tr>
                                                <td><?php echo $row['user_id'] ?></td>    
                                                <td><?php echo $row['username'] ?></td>    
                                                <td><?php echo $row['email'] ?></td> 
                                                <td> 
                                                    <a href="edit.php?id=<?php echo $row['user_id']; ?>">Edit</a> 
                                                    <a href="delete.php?id=<?php echo $row['user_id']; ?>" onclick="return confirm('Delete this user?')">Delete</a> 
                                                </td>   
                                            </tr>
                                        <?php 
                                        }}
                                    else{
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
        <div class="admin-box">
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
                    <button type="submit" class="admin-save">Save Media</button> 
                </form>
            </div>
        </div>

        
            
            
            
        <script src="userDashboard.js"></script>
    </main>
</body>
</html>
