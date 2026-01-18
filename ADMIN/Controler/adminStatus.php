<?php

include("../../HOME/Model/db.php");

$data = [
    "users" => mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users")),
    "media" => mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM media")),
    "tvShows" => mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM media WHERE type = 'tvShow'")),
    "manga" => mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM media WHERE type = 'manga'")),
];

header('Content-Type: application/json');
echo json_encode($data);