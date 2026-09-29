<?php
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

$qno = 1;
$quiz_category_id = 5;

$result = mysqli_query($con, "
    SELECT * FROM film_song 
    WHERE youtube_view_count IS NOT NULL 
    ORDER BY RAND()
    LIMIT 100
");

while (($song = mysqli_fetch_assoc($result)) && $qno <= 50) {
    $song_id = $song['id'];
    $film_id = $song['film_id'];
    $title = mysqli_real_escape_string($con, $song['title']);
    $views = (int)$song['youtube_view_count'];
    $youtube_link = mysqli_real_escape_string($con, $song['youtube']);

    $film_result = mysqli_query($con, "SELECT * FROM film WHERE id = $film_id");
    if (!$film_result || mysqli_num_rows($film_result) == 0) continue;
    $film = mysqli_fetch_assoc($film_result);
    $film_name = mysqli_real_escape_string($con, $film['name']);
    $year = $film['year_release'];

    // Get correct singers and gender
    $correct_res = mysqli_query($con, "
        SELECT s.id, s.name, s.gender FROM singer s
        JOIN song_singer ss ON s.id = ss.singer_id
        WHERE ss.song_id = $song_id
    ");

    $correct_singers = [];
    $correct_ids = [];
    $gender = null;
    while ($s = mysqli_fetch_assoc($correct_res)) {
        $correct_singers[] = $s['name'];
        $correct_ids[] = $s['id'];
        if ($s['gender']) {
            if ($gender === null) $gender = $s['gender'];
            elseif ($gender !== $s['gender']) { $gender = null; break; } // mixed gender → skip
        }
    }

    $singer_count = count($correct_singers);
    if ($singer_count === 0 || ($gender === null && $singer_count > 1)) continue;

    $correct_answer = mysqli_real_escape_string($con, implode(', ', $correct_singers));
    $wrong_options = [];

    // Try same film first
    $gender_clause = ($gender !== null) ? "AND s.gender = '$gender'" : "";

    $wrong_same_film_res = mysqli_query($con, "
        SELECT DISTINCT s.id, s.name FROM singer s
        JOIN song_singer ss ON s.id = ss.singer_id
        JOIN film_song fs ON fs.id = ss.song_id
        WHERE fs.film_id = $film_id AND s.id NOT IN (" . implode(',', $correct_ids) . ") $gender_clause
    ");

    $wrong_singers_pool = [];
    while ($ws = mysqli_fetch_assoc($wrong_same_film_res)) {
        $wrong_singers_pool[] = $ws;
    }

    // If not enough, get from same year
    if (count($wrong_singers_pool) < ($singer_count * 6)) { // aiming to make 3 options of same size
        $year_pool_res = mysqli_query($con, "
            SELECT DISTINCT s.id, s.name FROM singer s
            JOIN song_singer ss ON s.id = ss.singer_id
            JOIN film_song fs ON fs.id = ss.song_id
            JOIN film f ON fs.film_id = f.id
            WHERE f.year_release = $year AND s.id NOT IN (" . implode(',', $correct_ids) . ") $gender_clause
        ");
        while ($ys = mysqli_fetch_assoc($year_pool_res)) {
            $wrong_singers_pool[] = $ys;
        }
    }

    // Build wrong options (each option = 1 or 2 singers based on correct count)
    $used_ids = $correct_ids;
    shuffle($wrong_singers_pool);

    $max_attempts = 50;
    $attempt = 0;
    while (count($wrong_options) < 3 && $attempt++ < $max_attempts) {
        $combo = [];
        $combo_ids = [];

        foreach ($wrong_singers_pool as $ws) {
            if (in_array($ws['id'], $used_ids)) continue;
            $combo[] = $ws['name'];
            $combo_ids[] = $ws['id'];
            if (count($combo) == $singer_count) break;
        }

        if (count($combo) == $singer_count) {
            $wrong_options[] = mysqli_real_escape_string($con, implode(', ', $combo));
            $used_ids = array_merge($used_ids, $combo_ids);
        }
    }

    if (count($wrong_options) < 3) continue;

    // Final options
    $options = $wrong_options;
    $correct_pos = rand(0, 3);
    array_splice($options, $correct_pos, 0, $correct_answer);

    $difficulty = getDifficultyLevel($views);
    $question_text = "Name the playback singer of the song '<strong>$title</strong>' from the film <strong>$film_name ($year)</strong>.";

    $option1 = $options[0];
    $option2 = $options[1];
    $option3 = $options[2];
    $option4 = $options[3];
    $answer = $correct_pos + 1;

    echo "<strong>Question $qno:</strong> $question_text<br>";
    echo "Option 1: $option1<br>";
    echo "Option 2: $option2<br>";
    echo "Option 3: $option3<br>";
    echo "Option 4: $option4<br>";
    echo "<strong>Correct Ans:</strong> Option $answer<br>";
    echo "<strong>Difficulty Level:</strong> $difficulty (Views: $views)<br><hr>";

    // Optional Insert:
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
