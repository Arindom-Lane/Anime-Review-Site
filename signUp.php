<?php 
include("db.php");
$exists = false;

    if(isset($_POST["btn-create"])){
        $name = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $profileImage = $_POST['profile_image_link'];

 
        if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users` WHERE `username` = '$name'")) > 0){
            $exists = true;
        }
        
        elseif(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users` WHERE `email` = '$email'")) > 0){
            $exists = true;
        }

        else{
            $query = "INSERT INTO `users`( `username`, `email`, `password`, `profile_image_link`) VALUES ('$name','$email','$password','$profileImage')";
        $result = mysqli_query($conn, $query);

        if($result){
            header("Location: login.php?");
            exit();
        }
        else {
            die("Query Failed: " . mysqli_error($conn));
        }
        }        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sing Up</title>
    <style>
        .error-bar {
            background-color: #f8d7da; /* Light red background */
            color: #721c24;            /* Dark red text */
            border: 1px solid #f5c6cb; /* Soft red border */
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 0.5em;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }
        body{
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F6F6F6;
            grid-auto-rows: auto;
            justify-items: center;
            align-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .signup-box{
            width: 350px;
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            background-color: #2e51a2;
            border-radius: .5em;
        }
        h2{
            color: #f1f5feff;
            font-size: 18px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .feild {
            text-align: center;
            margin-bottom: 15px;
        }
        label{
            display: block;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 5px;
            color: #eef2fbff;
        }
        input{
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: .5em;
        }
        input:focus {
            border-color: #4a78e4ff;
            outline: none;
        }
        .btn-create {
            width: 60%;
            padding: 10px;
            background-color: #ebebeb;
            border: 1px solid #2f48a1ff;
            font-weight: bold;
            cursor: pointer;
            border-radius: .5em;
        }

        .btn-create:hover {
            background-color: #d2dfffff;
        }

        .login-link {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 25px;
            background-color: #f0f4ffff;
            color: black;
            text-decoration: none;
            font-weight: bold;
            font-size: 13px;
            border-radius: .5em;
        }

        .login-link:hover {
            background-color: #d2dfffff;
        }

        .divider {
            margin-top: 15px;
            font-size: 12px;
            color: #ffffffff;
        }
    </style>
</head>
<body>
    <?php if($exists == true){ ?>
        <div class="error-bar">
            Username/email already exists! Please choose another.
        </div>
    <?php } ?>
    <div class="signup-box">
    <h2>Start Using MyAnimeList</h2>

    <form method="POST">
        <img  src="download.png">
        <div class="feild">
            <label>Username</label>
            <input type="text"name="username" maxlength="50"  required>
        </div>
            <div class="feild">
            <label>Email</label>
            <input type="email" name="email" placeholder="e.g. abc@email.com" required>
        </div>
        
        <div class="feild">
            <label>Password</label>
            <input type="password"name="password" minlength="8" placeholder="minimum 8 character" required>
        </div>
        
        <div class="feild">
            <label>Profile Image Link (Optional)</label>
            <input type="url"name="profile_image_link" placeholder="Plase use a direct image link">
        </div><br>
        <button type="submit" name="btn-create" class="btn-create">Create Account</button>
    </form>

    <div class="divider">
        Already have an account?<br>
        <a href="login.php" class="login-link">Login</a>
    </div>
</div>
    
</body>
</html>