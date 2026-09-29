<?php
// DB connection
include "config.php";

// Function to get difficulty level based on views
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
$quiz_category_id = 4; // Example: 4 for actor-based questions

// Get 100 songs ordered by least views
$result = mysqli_query($con, "
    SELECT * FROM film_song 
    WHERE youtube_view_count IS NOT NULL 
    ORDER BY rand()
    LIMIT 100
");

while (($song = mysqli_fetch_assoc($result)) && $qno <= 50) {
    $song_id = $song['id'];
    $film_id = $song['film_id'];
    $title = mysqli_real_escape_string($con, $song['title']);
    $views = (int)$song['youtube_view_count'];
    $youtube_link = mysqli_real_escape_string($con, $song['youtube']);

    // Get film details
    $film_result = mysqli_query($con, "SELECT * FROM film WHERE id = $film_id");
    if (!$film_result || mysqli_num_rows($film_result) == 0) continue;
    $film = mysqli_fetch_assoc($film_result);
    $film_name = mysqli_real_escape_string($con, $film['name']);

    // Get correct cast for the song
    $cast_res = mysqli_query($con, "
        SELECT c.name FROM cast c
        JOIN song_cast sc ON c.id = sc.cast_id
        WHERE sc.song_id = $song_id
    ");

    $cast_names = [];
    while ($c = mysqli_fetch_assoc($cast_res)) {
        $cast_names[] = $c['name'];
    }

    if (empty($cast_names)) continue;

    $correct_answer = mysqli_real_escape_string($con, implode(', ', $cast_names));

    // Get 3 wrong cast members not in this song
    $wrong_res = mysqli_query($con, "
        SELECT DISTINCT name FROM cast 
        WHERE id NOT IN (
            SELECT cast_id FROM song_cast WHERE song_id = $song_id
        )
        ORDER BY RAND()
        LIMIT 3
    ");

    $wrong_options = [];
    while ($w = mysqli_fetch_assoc($wrong_res)) {
        $wrong_options[] = mysqli_real_escape_string($con, $w['name']);
    }

    if (count($wrong_options) < 3) continue;

    // Combine options
    $options = $wrong_options;
    $correct_pos = rand(0, 3);
    array_splice($options, $correct_pos, 0, $correct_answer);

    $difficulty = getDifficultyLevel($views);
    $question_text = "Which actor can be seen in the song '<strong>$title</strong>' from the film <strong>$film_name</strong>?";

    // Prepare options
    $option1 = $options[0];
    $option2 = $options[1];
    $option3 = $options[2];
    $option4 = $options[3];
    $answer = $correct_pos + 1;

    // Print question for preview
    echo "<strong>Question $qno:</strong> $question_text<br>";
    foreach ($options as $i => $opt) {
        echo "Option " . ($i + 1) . ": $opt<br>";
    }
    echo "<strong>Correct Ans:</strong> Option $answer<br>";
    echo "<strong>Difficulty Level:</strong> $difficulty (Views: $views)<br><hr>";

    // Optional: Insert into database
    /*
    $insertSQL = "INSERT INTO quiz_questions 
    (quiz_category_id, difficulty_level, question, option1, option2, option3, option4, answer, details)
    VALUES 
    ($quiz_category_id, $difficulty, '$question_text', '$option1', '$option2', '$option3', '$option4', $answer, '$youtube_link')";
    
    mysqli_query($con, $insertSQL);
    */

    $qno++;
}

mysqli_close($con);
?>
