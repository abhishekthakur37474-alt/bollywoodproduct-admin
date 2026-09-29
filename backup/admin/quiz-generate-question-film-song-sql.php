<?php
include "config.php";

// Helper functions
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

function escape($con, $val) {
    return mysqli_real_escape_string($con, $val);
}

function getIdList($con, $query, $id_field) {
    $result = mysqli_query($con, $query);
    $ids = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $ids[] = $row[$id_field];
    }
    return $ids;
}

$qno = 1;
$max_questions = 5119;
$quiz_category_id = 1;

$result = mysqli_query($con, "SELECT * FROM film_song WHERE youtube_view_count IS NOT NULL");
while ($song = mysqli_fetch_assoc($result)) {
    if ($qno > $max_questions) break;

    $song_id = $song['id'];
    $film_id = $song['film_id'];
    $title = escape($con, $song['title']);
    $views = (int)$song['youtube_view_count'];
    $youtube_link = escape($con, $song['youtube']);

    $film_res = mysqli_query($con, "SELECT * FROM film WHERE id = $film_id");
    if (!$film_res || mysqli_num_rows($film_res) == 0) continue;
    $film = mysqli_fetch_assoc($film_res);
    $film_name = escape($con, $film['name']);
    $year = $film['year_release'];

    // Country IDs
    $country_ids = array_filter(array_map('trim', explode(',', $film['country_ids'])));

    // Language ID
    $language_ids = [$film['main_lang']];

    // Wrong options
    $options_res = mysqli_query($con, "
        SELECT name FROM film 
        WHERE year_release = '$year' AND id != '$film_id' 
        ORDER BY RAND() LIMIT 3
    ");
    $wrong_options = [];
    while ($opt = mysqli_fetch_assoc($options_res)) {
        $wrong_options[] = escape($con, $opt['name']);
    }
    if (count($wrong_options) < 3) continue;

    $options = $wrong_options;
    $correct_pos = rand(0, 3);
    array_splice($options, $correct_pos, 0, $film_name);
    $difficulty = getDifficultyLevel($views);
    $question = "Which film features the <strong>$year</strong> song <strong>\"$title\"</strong>?";

    // Metadata IDs
    $singer_ids = getIdList($con, "SELECT s.id FROM song_singer ss JOIN singer s ON ss.singer_id = s.id WHERE ss.song_id = $song_id", 'id');
    $cast_ids = getIdList($con, "SELECT a.id FROM song_cast sc JOIN cast a ON sc.cast_id = a.id WHERE sc.song_id = $song_id", 'id');
    $music_director_ids = getIdList($con, "SELECT m.id FROM song_music_director sm JOIN music_director m ON sm.music_director_id = m.id WHERE sm.song_id = $song_id", 'id');
    $lyricist_ids = getIdList($con, "SELECT l.id FROM song_lyricist sl JOIN lyricist l ON sl.lyricist_id = l.id WHERE sl.song_id = $song_id", 'id');
    $director_ids = getIdList($con, "SELECT d.id FROM film_director fd JOIN director d ON fd.director_id = d.id WHERE fd.film_id = $film_id", 'id');
    $producer_ids = getIdList($con, "SELECT p.id FROM film_producer fp JOIN producer p ON fp.producer_id = p.id WHERE fp.film_id = $film_id", 'id');

    $production_house_ids = [];
    $prod_query = "SELECT film_production_company_name, film_distributing_company_name FROM film_production_and_distributing WHERE film_id = $film_id LIMIT 1";
    $prod_res = mysqli_query($con, $prod_query);
    if ($prod = mysqli_fetch_assoc($prod_res)) {
        $company_ids = array_filter([
            $prod['film_production_company_name'],
            $prod['film_distributing_company_name']
        ]);
        foreach ($company_ids as $cid) {
            $production_house_ids[] = $cid;
        }
    }

    $option1 = escape($con, $options[0]);
    $option2 = escape($con, $options[1]);
    $option3 = escape($con, $options[2]);
    $option4 = escape($con, $options[3]);
    $answer = $correct_pos + 1;

    // Commented output block
    /*
    echo "<strong>Q$qno:</strong> $question<br>";
    echo "Options: [$option1, $option2, $option3, $option4]<br>";
    echo "<strong>Answer:</strong> Option $answer | <strong>Difficulty:</strong> $difficulty (Views: $views)<br><br>";
    */

    // Generate SQL INSERT
    $sql = "INSERT INTO quiz_questions (
        quiz_category_id, difficulty_level, question,
        option1, option2, option3, option4, answer, details,
        film_ids, song_ids, singer_ids, cast_ids, language_ids,
        country_ids, years, music_director_ids, lyricist_ids,
        director_ids, producer_ids, production_house_ids
    ) VALUES (
        $quiz_category_id, $difficulty, '" . escape($con, $question) . "',
        '$option1', '$option2', '$option3', '$option4', $answer, '',
        '$film_id', '$song_id', '" . implode(',', $singer_ids) . "',
        '" . implode(',', $cast_ids) . "', '" . implode(',', $language_ids) . "',
        '" . implode(',', $country_ids) . "', '$year',
        '" . implode(',', $music_director_ids) . "',
        '" . implode(',', $lyricist_ids) . "',
        '" . implode(',', $director_ids) . "',
        '" . implode(',', $producer_ids) . "',
        '" . implode(',', $production_house_ids) . "'
    );";

    echo $sql . "<br><br>";
    $qno++;
}
mysqli_close($con);
?>
