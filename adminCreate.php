<?php
session_start();
include("db.php");
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $type = $_POST["type"];
    $poster = $_POST["poster"];
    $studio = $_POST["studio"];
    $producer = $_POST["producer"];
    $genre = $_POST["genre"];
    $duration = $_POST["duration"];
    $source = $_POST["source"];
    $description = $_POST["description"];

    $query = "INSERT INTO Media (title, description, type, poster_image_link, producer, studio, source, genre, duration) 
              VALUES ('$title', '$description', '$type', '$poster', '$producer', '$studio', '$source', '$genre', '$duration')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['CreateError'] = "success";
        header("Location: admin.php?");
        exit();
    } else {
        $_SESSION["CreateError"] = "error";
        header("Location: admin.php");
        exit();
    }
}
