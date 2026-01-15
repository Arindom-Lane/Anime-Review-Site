<?php
include("../Model/db.php");
$exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn-create"])) {
    $name = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_confirm = $_POST["confirm_password"];
    $profileImage = $_POST['profile_image_link'];

    if ($password !== $password_confirm) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
    } else {

        $hassPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($profileImage == '') {
            $profileImage = "https://icon-library.com/images/default-profile-icon/default-profile-icon-24.jpg";
        } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email'")) > 0) {
            $exists = true;
        } else {
            $query = "INSERT INTO `users`( `username`, `email`, `password`, `profile_image_link`) VALUES ('$name','$email','$hassPassword','$profileImage')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                header("Location: login.php?");
                exit();
            } else {
                die("Query Failed: " . mysqli_error($conn));
            }
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
    
    <link rel="stylesheet" href="../Css/logIn-SignUp.css">
</head>

<body>
    <?php if ($exists == true) { ?>
        <div class="error-bar">
            Username/email already exists! Please choose another.
        </div>
    <?php } ?>
    <div class="signup-box">
        <h2>Start Using MyAnimeList</h2>

        <form method="POST">
            <div class="logo">
                <img onclick="window.location.href='home.php'" src="../Images/download.png">
            </div>
            <div class="feild">
                <label>Username</label>
                <input type="text" name="username" maxlength="50" required>
            </div>
            <div class="feild">
                <label>Email</label>
                <input type="email" name="email" placeholder="e.g. abc@email.com" required>
            </div>

            <div class="feild">
                <label>Password</label>
                <input type="password" name="password" minlength="8" placeholder="minimum 8 character" required>
            </div>
            <div class="feild">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" minlength="8" placeholder="minimum 8 character" required>
            </div>

            <div class="feild">
                <label>Profile Image Link (Optional)</label>
                <input type="url" name="profile_image_link" placeholder="Plase use a direct image link">
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