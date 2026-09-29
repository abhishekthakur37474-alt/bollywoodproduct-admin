<?php
// DB connection
include "config.php";

// Function to get difficulty level
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

$qno = 1;
$quiz_category_id = 1; // Use appropriate quiz category ID

// Get 100 songs ordered by least views
$result = mysqli_query($con, "
    SELECT * FROM film_song 
    WHERE youtube_view_count IS NOT NULL 
    ORDER BY youtube_view_count ASC 
    LIMIT 100
");

while (($song = mysqli_fetch_assoc($result)) && $qno <= 50) {
    $film_id = $song['film_id'];
    $title = mysqli_real_escape_string($con, $song['title']);
    $views = (int)$song['youtube_view_count'];
    $youtube_link = mysqli_real_escape_string($con, $song['youtube']);

    // Get film details
    $film_result = mysqli_query($con, "SELECT * FROM film WHERE id = $film_id");
    if (!$film_result || mysqli_num_rows($film_result) == 0) continue;
    $film = mysqli_fetch_assoc($film_result);
    $year = $film['year_release'];
    $filmname = $film['name'];

    // Get correct music director(s) for this film
    $md_res = mysqli_query($con, "
        SELECT md.name FROM music_director md 
        JOIN film_music_director fmd ON md.id = fmd.music_director_id 
        WHERE fmd.film_id = $film_id
    ");

    $music_directors = [];
    while ($md = mysqli_fetch_assoc($md_res)) {
        $music_directors[] = $md['name'];
    }
    if (empty($music_directors)) continue;

    $correct_answer = mysqli_real_escape_string($con, implode(', ', $music_directors));

    // Get 3 wrong music directors (not in this song, same year)
    $wrong_res = mysqli_query($con, "
        SELECT DISTINCT md.name FROM music_director md
        JOIN film_music_director fmd ON md.id = fmd.music_director_id
        JOIN film f ON f.id = fmd.film_id
        WHERE f.year_release = '$year' 
        AND fmd.music_director_id NOT IN (
            SELECT music_director_id FROM film_music_director WHERE film_id = $film_id
        )
        ORDER BY RAND() 
        LIMIT 3
    ");

    $wrong_options = [];
    while ($w = mysqli_fetch_assoc($wrong_res)) {
        $wrong_options[] = mysqli_real_escape_string($con, $w['name']);
    }
    if (count($wrong_options) < 3) continue;

    // Insert correct answer randomly among 4 options
    $options = $wrong_options;
    $correct_pos = rand(0, 3);
    array_splice($options, $correct_pos, 0, $correct_answer);

    $difficulty = getDifficultyLevel($views);
    $question_text = "Who composed the song <strong>\"$title\"</strong> from the $year film <strong>\"$filmname\"</strong>?";

    // Prepare options
    $option1 = $options[0];
    $option2 = $options[1];
    $option3 = $options[2];
    $option4 = $options[3];
    $answer = $correct_pos + 1;

    echo "<strong>Question $qno:</strong> Who composed the song <strong>\"$title\"</strong> from the $year film <strong>\"$filmname\"</strong>?<br>";
    foreach ($options as $i => $opt) {
        echo "Option " . ($i + 1) . ": $opt<br>";
    }
    // Insert question
   echo "<strong>Correct Ans:</strong> Option " . ($correct_pos + 1) . "<br>";
    echo "<strong>Difficulty Level:</strong> $difficulty (Views: $views)<br><hr>";


    $qno++;
}

mysqli_close($con);
?>
