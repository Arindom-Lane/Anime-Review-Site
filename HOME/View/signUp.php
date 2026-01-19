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
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
) {

    header('Content-Type: application/json');

    $response = ['success' => false, 'debug' => [], 'post' => $_POST];
    $name = $_POST["username"] ?? '';
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $password_confirm = $_POST["confirm_password"] ?? '';
    $profileImage = $_POST['profile_image_link'] ?? '';

    $response['debug'][] = "Step: values read";
    $response['debug'][] = "name: $name, email: $email";

    if ($password !== $password_confirm) {
        $response['error'] = "Passwords do not match.";
    } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email'")) > 0) {
        $response['error'] = "Email already exists!";
    } else {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($profileImage == '') {
            $profileImage = "https://icon-library.com/images/default-profile-icon/default-profile-icon-24.jpg";
        }
        $query = "INSERT INTO `users` (`username`, `email`, `password`, `profile_image_link`) VALUES ('$name','$email','$hashPassword','$profileImage')";
        $result = mysqli_query($conn, $query);

        $response['debug'][] = "Query: $query";
        if ($result) {
            $response['success'] = true;
        } else {
            $response['error'] = "Query Failed: " . mysqli_error($conn);
        }
    }
    echo json_encode($response);
    exit();
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
    <script>
        const name = document.getElementById('username');
        const emailValue = document.getElementById('email').value;
        const passwordValue = document.getElementById('password').value;
        const confirm_passwordValue = document.getElementById('confirm_password').value;

        const email_msg = document.getElementById('email-msg');
        const password_msg = document.getElementById('password-msg');
        const pass_msg = document.getElementById('pass-msg');
        const ajax_msg = document.getElementById('ajax-msg');



        name.addEventListener('input', function() {
            const nameValue = document.getElementById('username').value;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    if (nameValue.length < 4) {
                        email_msg.innerHTML = "Username must be at least 3 characters long.";
                    } else {
                        email_msg.innerHTML = "";
                    }
                }
            };
            xhttp.open("POST", "signUp.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("username=" + nameValue);
        });
    </script>
    <?php if ($exists == true) { ?>
        <div class="error-bar">
            Username/email already exists! Please choose another.
        </div>
    <?php } ?>
    <div class="signup-box">
        <h2>Start Using MyAnimeList</h2>

        <form id="signup-form" method="POST">
            <div class="logo">
                <img onclick="window.location.href='home.php'" src="../Images/download.png">
            </div>
            <div class="feild">
                <label>Username</label>
                <input type="text" name="username" id="username" maxlength="50" required>
            </div>
            <div class="feild">
                <label>Email</label>
                <input type="email" id="email" name="email" placeholder="e.g. abc@email.com" required>
                <div id="email-msg"></div>
            </div>

            <div class="feild">
                <label>Password</label>
                <input type="password" id="password" name="password" minlength="8" placeholder="minimum 8 character" required>
                <div id="password-msg"></div>
            </div>
            <div class="feild">
                <label>Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" minlength="8" placeholder="minimum 8 character" required>
                <div id="pass-msg"></div>
            </div>

            <div class="feild">
                <label>Profile Image Link (Optional)</label>
                <input type="url" name="profile_image_link" placeholder="Plase use a direct image link">
            </div><br>
            <button type="submit" name="btn-create" class="btn-create">Create Account</button>
            <div id="ajax-msg"></div>
        </form>

        <div class="divider">
            Already have an account?<br>
            <a href="login.php" class="login-link">Login</a>
        </div>
    </div>

</body>

</html>