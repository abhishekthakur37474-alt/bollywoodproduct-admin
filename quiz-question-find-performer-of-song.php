<?php
// Assume mysqli connection $con is already established

ini_set('display_errors', 1);
error_reporting(E_ALL);

include "config.php";

function getDifficultyLevel($views) {
    if ($views > 100000000) return 1;
    if ($views > 50000000) return 2;
    if ($views > 20000000) return 3;
    if ($views > 10000000) return 4;
    if ($views > 5000000) return 5;
    if ($views > 2000000) return 6;
    if ($views > 1000000) return 7;
    if ($views > 500000) return 8;
    if ($views > 100000) return 9;
    return 10;
}

// Fetch all songs with film and views
$songQuery = "SELECT fs.id AS song_id, fs.title AS song_title, fs.youtube_view_count, f.name AS film_name, f.year_release AS film_year
              FROM film_song fs 
              JOIN film f ON fs.film_id = f.id";
$songResult = mysqli_query($con, $songQuery);

while ($song = mysqli_fetch_assoc($songResult)) {
    $song_id = $song['song_id'];
    $song_title = $song['song_title'];
    $film_year = $song['film_year'];
    $views = $song['youtube_view_count'];
    $difficulty = getDifficultyLevel($views);

    // Get correct performers (cast)
    $castQuery = "SELECT c.name 
                  FROM song_cast sc
                  JOIN cast c ON sc.cast_id = c.id
                  WHERE sc.song_id = $song_id";
    $castResult = mysqli_query($con, $castQuery);

    $performers = [];
    while ($row = mysqli_fetch_assoc($castResult)) {
        $performers[] = $row['name'];
    }

    $correctAnswer = implode(', ', $performers);
    $escapedCorrect = array_map(fn($n) => mysqli_real_escape_string($con, $n), $performers);
    $inClause = "'" . implode("','", $escapedCorrect) . "'";

    // Pool of wrong performers from ±2 years
    $yearMin = $film_year - 2;
    $yearMax = $film_year + 2;

    $poolQuery = "
        SELECT DISTINCT c.name
        FROM film_song fs
        JOIN film f ON fs.film_id = f.id
        JOIN song_cast sc ON fs.id = sc.song_id
        JOIN cast c ON sc.cast_id = c.id
        WHERE f.year_release BETWEEN $yearMin AND $yearMax
        AND c.name NOT IN ($inClause)
    ";
    $poolResult = mysqli_query($con, $poolQuery);
    $availableCast = [];
    while ($row = mysqli_fetch_assoc($poolResult)) {
        $availableCast[] = $row['name'];
    }

    $wrongOptions = [];
    if (count($performers) === 1) {
        shuffle($availableCast);
        $wrongOptions = array_slice($availableCast, 0, 3);
    } else {
        shuffle($availableCast);
        $combinations = array_chunk($availableCast, count($performers));
        foreach ($combinations as $combo) {
            if (count($combo) == count($performers)) {
                $wrongOptions[] = implode(', ', $combo);
            }
            if (count($wrongOptions) == 3) break;
        }
    }

    // Combine and shuffle options
    $options = $wrongOptions;
    $options[] = $correctAnswer;
    shuffle($options);

    // Print result
    echo "<b>Question:</b> Who is the performer in this {$film_year} year {$song_title}?<br>";
    foreach ($options as $idx => $opt) {
        echo chr(65 + $idx) . ". " . $opt . "<br>";
    }
    echo "<b>Correct Answer:</b> $correctAnswer<br>";
    echo "<b>Difficulty Level:</b> $difficulty<br><hr>";
}
?>
