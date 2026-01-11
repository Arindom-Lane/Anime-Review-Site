<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="UserEditProfile.css">  
    <link rel="stylesheet" href="searchBar.css">  
</head>
<body>
    <header>
        <div class="header-upper">
            <div class="logo" onclick="window.location.href='home.php'">
                <img src="download.png" alt="Logo">
            </div>
            <div class="profile">
                <?php if (isset($_SESSION['username']) && $_SESSION['loggedIn'] === true): ?>
                <div class="devider1"></div>
                <span class="profile-name">
                    <?php echo $_SESSION['username']; ?>
                </span>
                <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile">
                <a href="destorySession.php" class="login-link-Log-out">Log Out</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="header-middle">
            <div class="topButton">
                <span>TOP ANIME</span>
                <span>TOP MANGA</span>
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
                });
            </script>
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
        <div class="feild">
            <label>Change Email</label>
            <input type="text" name="email" >
            <button type="submit" name="btn-create" class="btn-create">Edit</button>
        </div>  
    </form>

    <div class="show-details">
            <form method="POST">
                <input type="submit" name="btn-show-details" class="show details-btn" value="Show Details" >
                 <input type="submit" name="btn-hide-details" class="show details-btn" value="Hide Details" >
            </form>
        </div>

        <?php if ($showDetails && isset($_SESSION['username'])): ?>
            <div class="user-details-box" >
                <h3>Your Profile Details</h3>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                
                <?php if (isset($_SESSION['email'])): ?>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
                <?php endif; ?>

                <div style="margin-top: 10px;">
                    <p><strong>Profile Image:</strong></p>
                    <img src="<?php echo htmlspecialchars($_SESSION['profileImage']); ?>" alt="Profile" >
                </div>
            </div>
        <?php endif; ?>
    </main>

    </body>
</html>
