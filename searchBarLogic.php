<?php

include("db.php");

$searchedText = $_POST['search'] ?? '';
$query = "SELECT * FROM media WHERE title LIKE '%$searchedText%'";
$result = mysqli_query($conn, $query);
$output = '<ul class="search-results-list">'; 

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '<li>
                        <span class="result-title">' . htmlspecialchars($row["title"]) . '</span>
                        <img class="result-img" src="' . $row["poster_image_link"] . '" alt="poster">
                    </li>';
    }
    $output .= '</ul>';
} else {
    $output .= '<div class="search-item">No results found</div>';
}

echo $output;
?>  