<?php
$username ="root";
$password = "";
$server = 'localhost';
$db = 'crud';

$con = mysqli_connect(
    $server, 
    $username, 
    $password,
    $db);

if ($con) {
    ?>
        <script>
            alert('connection Successful!')
        </script>
    <?php 
}
else {
    die('No connection').mysqli_connect_error();}




if(isset($_POST["sumit"])){
    $name = $_POST["name"];
    $degree = $_POST["qualification"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $reference = $_POST["references"];
    $age = $_POST["age"];

    $insertquery = "INSERT INTO `user`(`name`, `age`, `degree`, `mobile`, `email`, `reference`) VALUES ('$name','$age','$degree','$mobile','$email','$reference')";
    mysqli_query($con,$insertquery);
}
$result = mysqli_query($con,$insertquery);
if($result){   
    ?>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web Developer Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-container">
        <div class="sidebar">
            <div class="sidebar-content">
                <div class="icon-circle"></div>
                <h1>Welcome</h1>
                <p>Please fill all the details carefully. This form can change your life.</p>
                <button class="btn-check">Check Form</button>
            </div>
        </div>

        <div class="form-area">
            <h2>Apply for Web Developer Post</h2>
            <form action="index.php" method="POST" class="grid-form">
                <input type="text" name="name" placeholder="enter your name *" required>
                <input type="text" name="qualification" placeholder="enter your qualification *" required>
                <input type="text" name="mobile" placeholder="mobile number *" required>
                <input type="email" name="email" placeholder="email id *" required>
                <input type="number" name="age" placeholder="age *" required>
                <input type="text" name="references" placeholder="Any references *" required>
                <input type="text" value="Web Developer" readonly class="readonly-input">
                
                <div class="button-row">
                    <button type="submit" name="register" class="btn-register">Register</button>
                </div>
            </form>
        </div>
    </div>

    <div class="data-table">
        <h3>Current Applicants</h3>
        <table border="1" cellpadding="10">
            <tr>
                <th>Name</th>
                <th>Qualification</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            $result = $con->query("SELECT * FROM user");
            while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['degree'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>
                    <a href="index.php?delete=<?= $row['id'] ?>" style="color:red;">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>