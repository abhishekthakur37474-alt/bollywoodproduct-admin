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

function getIdNameList($con, $query, $id_field, $name_field) {
    $result = mysqli_query($con, $query);
    $items = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row[$id_field] . " (" . $row[$name_field] . ")";
    }
    return $items;
}

// Init
$qno = 1;
$max_questions = 50;
$quiz_category_id = 1;

$result = mysqli_query($con, "SELECT * FROM film_song WHERE youtube_view_count IS NOT NULL limit 50");
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

    // Get Country Names
    $countries = [];
    $country_ids = explode(',', $film['country_ids']);
    foreach ($country_ids as $cid) {
        $cid = trim($cid);
        if ($cid != '') {
            $res = mysqli_query($con, "SELECT id, country_name FROM country1 WHERE id = '$cid'");
            if ($row = mysqli_fetch_assoc($res)) {
                $countries[] = $row['country_name'];
            }
        }
    }

    // Get Language Name
    $language_name = '';
    $lang_id = $film['main_lang'];
    $res = mysqli_query($con, "SELECT name FROM dubbing WHERE id = '$lang_id'");
    if ($row = mysqli_fetch_assoc($res)) {
        $language_name = $row['name'];
    }

    // Wrong options (films from the same year)
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

    // Metadata
    $singers = getIdNameList($con, "SELECT s.id, s.name FROM song_singer ss JOIN singer s ON ss.singer_id = s.id WHERE ss.song_id = $song_id", 'id', 'name');
    $cast = getIdNameList($con, "SELECT a.id, a.name FROM song_cast sc JOIN cast a ON sc.cast_id = a.id WHERE sc.song_id = $song_id", 'id', 'name');
    $music_directors = getIdNameList($con, "SELECT m.id, m.name FROM song_music_director sm JOIN music_director m ON sm.music_director_id = m.id WHERE sm.song_id = $song_id", 'id', 'name');
    $lyricists = getIdNameList($con, "SELECT l.id, l.name FROM song_lyricist sl JOIN lyricist l ON sl.lyricist_id = l.id WHERE sl.song_id = $song_id", 'id', 'name');
    $directors = getIdNameList($con, "SELECT d.id, d.name FROM film_director fd JOIN director d ON fd.director_id = d.id WHERE fd.film_id = $film_id", 'id', 'name');
    $producers = getIdNameList($con, "SELECT p.id, p.name FROM film_producer fp JOIN producer p ON fp.producer_id = p.id WHERE fp.film_id = $film_id", 'id', 'name');

    $production_houses = [];
    $prod_query = "SELECT film_production_company_name, film_distributing_company_name FROM film_production_and_distributing WHERE film_id = $film_id LIMIT 1";
    $prod_res = mysqli_query($con, $prod_query);
    if ($prod = mysqli_fetch_assoc($prod_res)) {
        $company_ids = array_filter([
            $prod['film_production_company_name'],
            $prod['film_distributing_company_name']
        ]);
        foreach ($company_ids as $cid) {
            $res = mysqli_query($con, "SELECT id, name FROM productionanddistribution WHERE id = '$cid'");
            if ($row = mysqli_fetch_assoc($res)) {
                $production_houses[] = $row['id'] . " (" . $row['name'] . ")";
            }
        }
    }

    $option1 = $options[0];
    $option2 = $options[1];
    $option3 = $options[2];
    $option4 = $options[3];
    $answer = $correct_pos + 1;

    // Display Output
    echo "<strong>Q$qno:</strong> $question<br>";
    echo "Options: [$option1, $option2, $option3, $option4]<br>";
    echo "<strong>Answer:</strong> Option $answer | <strong>Difficulty:</strong> $difficulty (Views: $views)<br><br>";

    echo "<strong>Metadata</strong><br>";
    echo "🎬 Film ID: $film_id ($film_name)<br>";
    echo "🎵 Song ID: $song_id ($title)<br>";
    echo "🧑‍🎤 Singers: " . implode(', ', $singers) . "<br>";
    echo "🎭 Cast: " . implode(', ', $cast) . "<br>";
    echo "🎬 Directors: " . implode(', ', $directors) . "<br>";
    
    echo "💰 Producers: " . implode(', ', $producers) . "<br>";
    echo "🌐 Language: $language_name<br>";
    echo "📅 Year: $year<br>"; 
    echo "🗺️ Country: " . implode(', ', $countries) . "<br>";

    echo "🎼 Music Directors: " . implode(', ', $music_directors) . "<br>";
    echo "✍️ Lyricists: " . implode(', ', $lyricists) . "<br>";
    echo "🏢 Production Houses: " . implode(', ', $production_houses) . "<br><hr>";

    $qno++;
}
mysqli_close($con);
?>