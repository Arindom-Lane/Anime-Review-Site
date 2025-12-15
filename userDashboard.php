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
        <div class="sidebar" >
            <fieldset style="width: 200px; height: auto; padding:5px;">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJI_DopBdbcgF7IJix80AH8Red7J1UtoDOaw&s">
            <div class="meta-row">
                <br>
                            <span style="position:absolute;">Last Online</span>
                            <span style="color:green; position:relative;left:160px;">Now</span>
                            <br>
                            <span style="position:absolute;">joined</span>
                            <span style="position:relative;left:110px;">Aug 11, 2023</span>
                            <br></br>
                            <input type="button" value="Anime List" class="animebtn">
                            <input type="button" value="Manga List" class="mangabtn">
                            <div style="border-bottom: 1px solid black ; width: auto; padding: 3px;"></div>
                            <input type="button" value="Statistics" class="statbtn">
                            <br>
                            <input type="button" value="History" class="statbtn">
                            <br>
                            <input type="button" value="Favorites" class="statbtn">
                            <br><br>
                            reviews<span style="color:blue;position:relative;left:127px;">0</span>
                            <br>
                            recommendations<span style="color:blue;position:relative;left:58px;">0</span>
                            <br>
                        <h1>Friends <span style="color:blue;position:relative;left:40px;">(0)</span></h1>
                        <div class="friendcheck"></div>
                        
                            
                        </div>
            </fieldset>
        </div>

    </main>

</body>
</html>