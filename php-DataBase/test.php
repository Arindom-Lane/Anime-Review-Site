<?php
    include("db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web Developer Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form style="display:grid;"><label>name</label>
    <input type="text" name="name" placeholder="enter your name *" required>
    <label>qualification</label>
    <input type="text" name="qualification" placeholder="enter your qualification *" required>
    <label>mobile</label>
    <input type="text" name="mobile" placeholder="mobile number *" required>
    <label>email</label>
    <input type="email" name="email" placeholder="email id *" required>
    <label>age</label>
    <input type="number" name="age" placeholder="age *" required>
    <label>references</label>
    <input type="text" name="references" placeholder="Any references *" required>
    <label>Gender</label>
    <select>
        <option>Select</option>
        <option>Male</option>
        <option>Female</option>
        <option>Others</option>
    </select>
    <br>
    <input type="submit" style="background-color: aquamarine;"></form>
</body>
</html>