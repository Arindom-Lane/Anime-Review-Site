<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f2f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .signup-box{
            width: 350px;
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            background-color: #dfe6edff;
            border-radius: .5em;
        }
        h2{
            color: #2e51a2;
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
            color: #1c3777ff;
        }
        input{
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: .5em;
        }
        input:focus {
            border-color: #2e51a2;
            outline: none;
        }
        .btn-create {
            width: 60%;
            padding: 10px;
            background-color: #ebebeb;
            border: 1px solid #ccc;
            font-weight: bold;
            cursor: pointer;
            border-radius: .5em;
        }

        .btn-create:hover {
            background-color: #dcdcdc;
        }

        .login-link {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 25px;
            background-color: #2e51a2;
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 13px;
            border-radius: .5em;
        }

        .login-link:hover {
            background-color: #1e3a7a;
        }

        .divider {
            margin-top: 15px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="signup-box">
    <h2>Start Using MyAnimeList</h2>

    <form method="POST">
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
            <input type="text"name="profile_image_link" placeholder="Plase use a direct image link" required>
        </div><br>
        <button type="submit" class="btn-create">Create Account</button>
    </form>

    <div class="divider">
        Already have an account?<br>
        <a href="login.html" class="login-link">Login</a>
    </div>
</div>
    
</body>
</html>