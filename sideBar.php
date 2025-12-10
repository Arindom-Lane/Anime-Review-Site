<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    <title>My AnimeList Dashboard</title>
    <link rel="stylesheet" href="style.css">    
    
</head>
<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img class="image1" src="./download.png" alt="App Logo"> 
                    <h2>My<span class="danger">AnimeList</span></h2>
                </div>
                <div class="close" id="close-Btn">
                    <span class="material-symbols-rounded">
                        close
                    </span>
                </div>
            </div>
            <div class="sideBar">
                <a href="a">
                    <span class="material-symbols-rounded">
                        dashboard       
                    </span>
                    <h2>Dashboard</h2>

                    <span class="material-symbols-rounded">
                    support_agent
                    </span>
                    <h2>Customer</h2>

                    <span class="material-symbols-rounded">
                    orders
                    </span>
                    <h2>Order</h2>

                    <span class="material-symbols-rounded">
analytics
</span>
                    <h2>Analytics</h2>

                    <span class="material-symbols-rounded">
inbox
</span>
                    <h2>Messages</h2>

                    <span class="material-symbols-rounded">
box
</span>
                    <h2>Product</h2>
                </a>
            </div>
            
            </aside>
    </div>
    
    <script>
        // Optional: specific script to make the close button work
        const closeBtn = document.getElementById('close-Btn');
        closeBtn.addEventListener('click', () => {
            console.log('Close button clicked');
        });
    </script>
</body>
</html>