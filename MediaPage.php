<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Piece - MyAnimeList.net</title>
    <link rel="stylesheet" href="MediaPage.css">
</head>
<body>

    <header>
         <div class="header-upper">
            <div class="logo" onclick="window.location.href='userDashboard.php'">
                <img src="https://cdn.myanimelist.net/images/mal-logo-xsmall.png?v=1634263200">
            </div>
            <div class="profile">
                <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true):?>
                    <?php if($_SESSION['role'] ==  'registered'): ?>
                        <div class="devider1"></div>
                        <span class="profile-name"  onclick="window.location.href='userDashboard.php'">   
                                <?php echo $_SESSION['username']; ?>
                        </span>
                        <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile" onclick="window.location.href='userDashboard.php'">
                            <a href="destorySession.php" class="login-link-Log-out">Log Out</a>
                    <?php else: ?>
                        <a href="admin.php" class="login-link">Dashboard</a>
                        <div class="devider1"></div>
                        <span class="profile-name" onclick="window.location.href='userDashboard.php'">
                            <?php echo $_SESSION['username']; ?>
                        </span>
                        <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile" onclick="window.location.href='userDashboard.php'">
                        <a href="destorySession.php" class="login-link-Log-out">Log Out</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="signUp.php" class="login-link">Sign Up</a>
                    <a href="login.php" class="login-link">Login</a>
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
            <span>One Piece</span>
            <img src="https://cdn-icons-png.freepik.com/512/14911/14911421.png">
            <!-- <img src="https://cdn-icons-png.freepik.com/512/14627/14627394.png"> --> 
            <!-- for dark mode to bright mode converting logo img link-->
            
        </div>
    </header>

    <main>
        <!-- LEFT SIDEBAR -->
        <div class="leftSection">
            <div class="sidebar-fieldset">
                <div class="user-avatar-container">
                    <img src="data:image/jpeg;base64,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" class="user-avatar-img" alt="User Avatar">
                </div>
                
                
                <div class="sidebar-content">
                    <div class="sidebar-row">
                        <h3>Edit Status</h3> 
                    </div>
                    <div class="sidebar-row joined-row">
                        <span>Status:</span>
                    <select name="fruits" id="fruits">
                        <option value="Waatching">Watching</option>
                        <option value="Completed">Completed</option>
                        <option value="On-Hold">On-Hold</option>
                        <option value="Dropped">Dropped</option>
                        <option value="Plan to Watch">Plan to Watch</option>
                    </select>

                    </div>
                </div>
                    
                    

                    <br>
                    
                </div>
                </div>
        </div>
        </main>
        

</body>
</html>