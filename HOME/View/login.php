<?php
session_start();
$error = false;
include("../Model/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn-create"])) {
    $name = $_POST["username"];
    $password = $_POST["password"];

    $verifySql = "SELECT * FROM users WHERE username = '$name'";
    $result = mysqli_query($conn, $verifySql);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user["password"])) {



            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $name;
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['userId'] = $user['user_id'];
            $_SESSION['profileImage'] = $user['profile_image_link'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];

            $chceckQuery = "SELECT * FROM user_settings WHERE user_id = " . $_SESSION['user_id'];
            $checkResult = mysqli_query($conn, $chceckQuery);


            if (mysqli_num_rows($checkResult) == 0) {
                $insertUserSettingQuery = "INSERT INTO user_settings (user_id, theme_mode) VALUES (" . $_SESSION['user_id'] . ", 'light')";
                mysqli_query($conn, $insertUserSettingQuery);
                $_SESSION['theme_mode'] = 'light';
            }

            header("Location: home.php");
            exit();
        } else {
            echo "<script>alert('Password invalid');</script>";
        }
    } else {
        $error = true;
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
            background-color: #f8d7da;
            /* Light red background */
            color: #721c24;
            /* Dark red text */
            border: 1px solid #f5c6cb;
            /* Soft red border */
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 0.5em;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F6F6F6;
            grid-auto-rows: auto;
            justify-items: center;
            align-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .signup-box {
            width: 350px;
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            background-color: #2e51a2;
            border-radius: .5em;
        }

        h2 {
            color: #f1f5feff;
            font-size: 18px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .feild {
            text-align: center;
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 5px;
            color: #eef2fbff;
        }

        input {
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
            width: 64%;
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

        .logo {
            width: 300px;
            height: auto;
            align-items: center;
            cursor: pointer;
            margin: 0 auto;
        }
        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(1px 0 0 white) drop-shadow(-1px 0 0 white) drop-shadow(0 1px 0 white) drop-shadow(0 -1px 0 white);
        }
    </style>
</head>

<body>
    <?php if ($error == true) { ?>
        <div class="error-bar">
            <?php echo "User not found"; ?>
        </div>
    <?php } ?>
    <div class="signup-box">
        <h2>Start Using MyAnimeList</h2>

        <form method="POST">
            <div class="logo">
                <img src="../Images/download.png">
            </div>
            <div class="feild">
                <label>User name</label>
                <input type="text" name="username" required>
            </div>

            <div class="feild">
                <label>Password</label>
                <input type="password" name="password" minlength="8" placeholder="minimum 8 character" required>
            </div>

            <button type="submit" name="btn-create" class="btn-create">Login</button>
        </form>
        <div class="divider">
            Doesn't have an account?<br>
            <a href="signUp.php" class="login-link">Sign Up</a>
            <a href="home.php" class="login-link">Go to home</a>
        </div>
    </div>

</body>

</html>