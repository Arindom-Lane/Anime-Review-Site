<?php
session_start();
$error = false;

include("../../HOME/Model/db.php");

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

            $chceckQuery = "SELECT * FROM user_settings WHERE user_id = '" . $_SESSION['user_id'] . "'";
            $checkResult = mysqli_query($conn, $chceckQuery);


            if (mysqli_num_rows($checkResult) == 0) {
                $insertUserSettingQuery = "INSERT INTO user_settings (user_id, theme_mode) VALUES (" . $_SESSION['user_id'] . ", 'light')";
                mysqli_query($conn, $insertUserSettingQuery);
                $_SESSION['theme_mode'] = 'light';
            } else {
                $settingRow = mysqli_fetch_assoc($checkResult);
                if($settingRow['theme_mode'] == 'dark'){
                    $_SESSION['theme_mode'] = 'dark';
                }
                else{
                    $_SESSION['theme_mode'] = 'light';
                }
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

$bg = array(
        "../Images/1.gif",
        "../Images/2.gif",
        "../Images/3.gif",
        "../Images/4.gif",
        "../Images/5.jpg",
        "../Images/6.gif",
        "../Images/7.gif",
        "../Images/8.gif",
        "../Images/9.gif",
        "../Images/10.jpg",
        "../Images/11.gif",
        "../Images/11.jpg",
        "../Images/12.gif"
    );
    if(!isset($_COOKIE["bgImage"])){
        setcookie("bgImage", $bg[0], time() + 86400 * 30);
        $_COOKIE["bgImage"] = $bg[0];
    }

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ChangeBG"])){
    
    
    $index = array_search($_COOKIE["bgImage"], $bg);
    if($index === false || $index === count($bg) - 1){
        $index = 0;
    }
    else{
        $index++;
    }
    setcookie("bgImage", $bg[$index], time() + 86400 * 30);
    $_COOKIE["bgImage"] = $bg[$index];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Up</title>
    <link rel="stylesheet" href="../Css/logIn-SignUp.css">
</head>

<body>
    <form method="POST" class="change-background">
        <button type="submit" class="ChangeBG" name="ChangeBG">Change Background</button>
    </form>
    <img class="back" src="<?php echo $_COOKIE["bgImage"] ?? $bg[0]; ?>" alt="background image">
    <?php if ($error == true) { ?>
        <div class="error-bar">
            <?php echo "User not found"; ?>
        </div>
    <?php } ?>
    <div class="signup-box">
        <h2>Start Using MyAnimeList</h2>

        <form method="POST">
            <div class="feild">
                <label>User name</label>
                <input type="text" name="username" placeholder="Roni, tony...">
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