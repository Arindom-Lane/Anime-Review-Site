<?php

include("../Model/db.php");

$searchedText = $_POST['search'] ?? '';
$query = "SELECT * FROM media WHERE title LIKE '%$searchedText%'";
$result = mysqli_query($conn, $query);
$output = '<ul class="search-results-list">'; 

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '<li>
                        <a style="text-decoration: none;" href="../../HOME/View/MediaPage.php?id=' . $row['media_id'] . '" class="search-item-link">
                            <div class="search-item">
                            <span class="search-item-title">' . htmlspecialchars($row['title']) . '</span>
                                <img src="' . $row['poster_image_link'] . '" alt="' . htmlspecialchars($row['title']) . ' Poster" class="search-item-image">
                                
                            </div>
                        </a>
                    </li>';
    }
    $output .= '</ul>';
} else {
    $output .= '<div class="search-item">No results found</div>';
}

echo $output;
?>  