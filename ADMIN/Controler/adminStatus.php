<?php

include("../../HOME/Model/db.php");

$data = [
    "users" => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Users")),
    "media" => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Media")),
    "tvShows" => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Media WHERE type = 'tvShow'")),
    "manga" => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Media WHERE type = 'manga'")),
];

header('Content-Type: application/json');
echo json_encode($data);