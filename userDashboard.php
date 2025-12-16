<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="userDash.css">    

    
</head>
<body>
    <header>
        
        <div class="header-upper">
            <div class="logo">
                <img src="https://cdn.myanimelist.net/images/mal-logo-xsmall.png?v=1634263200">
            </div>
            <div class="profile">
                <div class="devider1"></div>
                <span class="profile-name">Hamim</span>
                <img src="https://avatars.githubusercontent.com/u/143287515?v=4" alt="Profile">
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
            <span>My Panel</span>
            <img src="https://cdn-icons-png.freepik.com/512/14911/14911421.png">
            <!-- <img src="https://cdn-icons-png.freepik.com/512/14627/14627394.png"> --> 
            <!-- for dark mode to bright mode converting logo img link-->
            
        </div>
    </header>
    <main>
        <div class="leftSection">
            <fieldset style="width: 100%; height: auto; padding:15px; border: 1px solid var(--color-border_white); background-color: white;">
                <div style="display: flex; justify-content: center; margin-bottom: 10px;">
                    <img src="https://avatars.githubusercontent.com/u/143287515?v=4" style="width: 100%; max-width: 200px; border-radius: 4px;">
                </div>
                
                <div style="font-size: 12px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span>Last Online</span>
                        <span style="color:green;">Now</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                        <span>Joined</span>
                        <span>Aug 11, 2023</span>
                    </div>

                    <div style="display: flex; gap: 5px; margin-bottom: 10px;">
                        <input type="button" value="Anime List" class="animebtn" style="flex: 1; background-color: var(--color-primary_brand); color: white; border: none; cursor: pointer; border-radius: 3px;">
                        <input type="button" value="Manga List" class="mangabtn" style="flex: 1; background-color: var(--color-primary_brand); color: white; border: none; cursor: pointer; border-radius: 3px;">
                    </div>

                    <div style="border-bottom: 1px solid var(--color-border_white); margin: 10px 0;"></div>
                    
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <input type="button" value="Statistics" class="statbtn">
                        <input type="button" value="History" class="statbtn">
                        <input type="button" value="Favorites" class="statbtn">
                    </div>

                    <br>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Reviews</span>
                        <span style="color:blue;">0</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Recommendations</span>
                        <span style="color:blue;">0</span>
                    </div>

                    <h1 style="font-size: 14px; margin-top: 15px; border-bottom: 1px solid #ccc; padding-bottom: 5px;">Friends <span style="color:blue;">(0)</span></h1>
                    <div class="friendcheck" style="height: 50px; background-color: #f9f9f9; margin-top: 5px;"></div> 
                </div>
                
                <div style="margin-top: 20px; text-align: center;">
                    <input type="button" value="Edit Profile" class="editbtn" style="padding: 5px 15px;">
                </div>
            </fieldset>
        </div>
            <div class="rightsection" >
                <div class="biography">
                    <h3>Biography</h3>
                    <p>No biography has been added.<a href="home.php" style="color: blue; text-decoration: underline;">click here to add</a></p>
                    <br>
                </div>
                <div class="stats">
                    <h2 style="border-bottom: 1px solid var(--color-border_white); margin: 10px 0;">Statistics</h2>
                </div>

            </div>

    </main>

</body>
</html>