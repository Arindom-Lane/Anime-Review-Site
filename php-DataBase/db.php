<?php
$username ="root";
$password = "";
$server = 'localhost';
$db = 'crud';

try{
    $con = mysqli_connect(
    $server, 
    $username, 
    $password,
    $db);
}
catch(Exception $e){
    echo "could not connect!<br><br>";
}


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

?>