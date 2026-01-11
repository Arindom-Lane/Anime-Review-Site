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
    if (isset($_POST['create_media'])) {
        $query = "INSERT INTO currentlyairingmedia (title, description, type, poster_image_link, producer, studio, source, genre, duration) 
              VALUES ('$title', '$description', '$type', '$poster', '$producer', '$studio', '$source', '$genre', '$duration')";

        if (mysqli_query($conn, $query)) {
            $_SESSION['CreateError'] = "success";
            $query2 = mysqli_query($conn, "INSERT INTO Media (
                title, description, type, poster_image_link, score, status,
                aired_date, producer, studio, source, genre, duration
            )
            SELECT
                c.title, c.description, c.type, c.poster_image_link, c.score, c.status,
                c.aired_date, c.producer, c.studio, c.source, c.genre, c.duration
            FROM currentlyairingmedia c
            LEFT JOIN Media m ON m.title = c.title
            WHERE m.media_id IS NULL;
            ");
            header("Location: admin.php?");
            exit();
        } else {
            $_SESSION["CreateError"] = "error";
            header("Location: admin.php");
            exit();
        }
    }

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
