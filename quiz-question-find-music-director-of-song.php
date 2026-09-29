<?php
// Assume mysqli connection $con is already established

ini_set('display_errors', 1);
error_reporting(E_ALL);

include "config.php";

if(isset($_GET['action']) && $_GET['action']=='First'){

$sqld=mysqli_query($con, "delete from quiz_questions where quiz_question_generator_id='2'") or die(mysqli_error($con));
$sqlu=mysqli_query($con, "update quiz_question_generators set generated_date=now() where id='2'") or die(mysqli_error($con));

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
$songQuery = "SELECT fs.id AS song_id, fs.title AS song_title, fs.youtube_view_count, fs.youtube, f.name AS film_name, f.year_release, f.year_release AS film_year, f.main_lang AS film_language
              FROM film_song fs 
              JOIN film f ON fs.film_id = f.id ";
$songResult = mysqli_query($con, $songQuery);

while ($song = mysqli_fetch_assoc($songResult)) {
    $song_id = $song['song_id'];
    $song_title = $song['song_title'];
    $film_year = $song['film_year'];
    $film_name = $song['film_name'];
    // Convert film_language from IDs (e.g., "3,45,22") to names (e.g., "English,Hindi,Bangla")
    $film_language_ids = explode(',', $song['film_language']);
    $film_language_names = [];
    foreach ($film_language_ids as $lang_id) {
        $lang_id = trim($lang_id);
        if ($lang_id === '') continue;
        $langQuery = mysqli_query($con, "SELECT name FROM dubbing WHERE id = '$lang_id' LIMIT 1");
        if ($langRow = mysqli_fetch_assoc($langQuery)) {
            $film_language_names[] = $langRow['name'];
        }
    }
    $film_language = implode(',', $film_language_names);
    $views = $song['youtube_view_count'];
    $difficulty = getDifficultyLevel($views);

    // Get correct music directors
    $mdQuery = "SELECT md.name 
                FROM song_music_director smd
                JOIN music_director md ON smd.music_director_id = md.id
                WHERE smd.song_id = $song_id";
    $mdResult = mysqli_query($con, $mdQuery);

    $musicDirectors = [];
    while ($row = mysqli_fetch_assoc($mdResult)) {
        $musicDirectors[] = $row['name'];
    }

    $correctAnswer = implode(', ', $musicDirectors);
    $escapedCorrect = array_map(fn($n) => mysqli_real_escape_string($con, $n), $musicDirectors);
    $inClause = "'" . implode("','", $escapedCorrect) . "'";

    // Pool of wrong music directors from nearby year films
    $yearMin = $film_year - 2;
    $yearMax = $film_year + 2;

    $poolQuery = "
        SELECT DISTINCT md.name
        FROM film_song fs
        JOIN film f ON fs.film_id = f.id
        JOIN song_music_director smd ON fs.id = smd.song_id
        JOIN music_director md ON smd.music_director_id = md.id
        WHERE f.year_release BETWEEN $yearMin AND $yearMax
        AND md.name NOT IN ($inClause)
    ";
    $poolResult = mysqli_query($con, $poolQuery);
    $availableMDs = [];
    while ($row = mysqli_fetch_assoc($poolResult)) {
        $availableMDs[] = $row['name'];
    }

    $wrongOptions = [];
    if (count($musicDirectors) === 1) {
        shuffle($availableMDs);
        $wrongOptions = array_slice($availableMDs, 0, 3);
    } else {
        shuffle($availableMDs);
        $combinations = array_chunk($availableMDs, count($musicDirectors));
        foreach ($combinations as $combo) {
            if (count($combo) == count($musicDirectors)) {
                $wrongOptions[] = implode(', ', $combo);
            }
            if (count($wrongOptions) == 3) break;
        }
    }

    // Combine and shuffle options
    $options = $wrongOptions;
    $options[] = $correctAnswer;
    shuffle($options);

    $question = "Who is the <strong style='color: #e916c9;'>music director (composer)</strong> of the song <strong style='color: #39FF14;'>{$song_title}</strong> from the <strong style='color: #fff;'>{$film_year}</strong> <strong style='color: #FFD700;'>{$film_language}</strong> film <strong style='color: #FFD700;'>{$film_name}</strong>?";

    // Print result 
    // $question = "Who is the Music Director (Composer) of the <strong style='color: #fff;'>{$film_year}</strong> <strong style='color: #FFD700;'>{$film_language}</strong> film song <strong style='color: #39FF14;'>{$song_title}</strong>?";
       
    echo $question;
    echo "<br>";
    foreach ($options as $idx => $opt) {
          ${"option" . ($idx + 1)} = $opt;
        echo chr(65 + $idx) . ". " . $opt . "<br>";
    }
    



$correctIndex = array_search($correctAnswer, $options); // returns 0-based index
$correctOptionNumber = $correctIndex + 1;
$details=$song['youtube'];
$song_id = $song['song_id'];
$quiz_question_generator_id='2'; // Assuming a static ID for the quiz question generator
$quiz_category_id='2'; // Assuming a static ID for the quiz category
// Escape all string inputs before using them in SQL

echo "<b>Correct Answer:</b> $correctAnswer<br>";
echo "<b>Correct Answer Index:</b> $correctOptionNumber<br>";
echo "<b>Difficulty Level:</b> $difficulty<br><hr>";

$question = mysqli_real_escape_string($con, $question);
$option1 = mysqli_real_escape_string($con, $option1);
$option2 = mysqli_real_escape_string($con, $option2);
$option3 = mysqli_real_escape_string($con, $option3);
$option4 = mysqli_real_escape_string($con, $option4);
$details = mysqli_real_escape_string($con, $details);
$song_id = mysqli_real_escape_string($con, $song_id);

// Run safe SQL query
$sql = mysqli_query($con, "INSERT INTO quiz_questions (
    quiz_question_generator_id, 
    quiz_category_id, 
    difficulty_level, 
    question, 
    option1, 
    option2, 
    option3, 
    option4, 
    answer, 
    details, 
    song_ids, 
    date_reg
) VALUES (
    '$quiz_question_generator_id', 
    '$quiz_category_id', 
    '$difficulty', 
    '$question', 
    '$option1', 
    '$option2', 
    '$option3', 
    '$option4', 
    '$correctOptionNumber', 
    '$details', 
    '$song_id', 
    NOW()
)");

    if (!$sql) {
        echo "Error inserting question: " . mysqli_error($con) . "<br>";
    } else {
        echo "Question inserted successfully.<br>";
    }   
    

    
}
echo "<script>alert('  $deleted_count Old Question Deleted and New Question Generated successfully!');window.location.href='quiz-question-find-music-director-of-song.php';</script>";
exit;

}
?>


<h3>Music Director of Song Quiz Questions </h3>

<a href="quiz-question-find-music-director-of-song.php?action=First">Delete Old and Generate New Questions </a>
<br><br>



<br>
<h2 style="text-align: center;">Initial 10 Questions</h2>

<br>

<?php
// Connect to the database (assume $conn is already available, otherwise add your connection code here)
$query = "SELECT difficulty_level, question, option1, option2, option3, option4, answer, film_ids, cast_ids 
          FROM quiz_questions 
          WHERE quiz_question_generator_id=2 
          LIMIT 10";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>
            <th>Difficulty Level</th>
            <th>Question</th>
            <th>Option 1</th>
            <th>Option 2</th>
            <th>Option 3</th>
            <th>Option 4</th>
            <th>Answer</th>
            <th>Film IDs</th>
            <th>Cast IDs</th>
          </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['difficulty_level']) . "</td>";
        echo "<td style='background-color:#000; color:#fff'>" . $row['question'] . "</td>";
        echo "<td>" . htmlspecialchars($row['option1']) . "</td>";
        echo "<td>" . htmlspecialchars($row['option2']) . "</td>";
        echo "<td>" . htmlspecialchars($row['option3']) . "</td>";
        echo "<td>" . htmlspecialchars($row['option4']) . "</td>";
        echo "<td>" . htmlspecialchars($row['answer']) . "</td>";
        echo "<td>" . htmlspecialchars($row['film_ids']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cast_ids']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No quiz questions found for generator ID 2.";
}
?>

<br>
<h2 style="text-align: center;">Random 10 Questions</h2>
<br>

<?php
// Connect to the database (assume $conn is already available, otherwise add your connection code here)
$query = "SELECT difficulty_level, question, option1, option2, option3, option4, answer, film_ids, cast_ids 
          FROM quiz_questions 
          WHERE quiz_question_generator_id=2 order by rand()
          LIMIT 10";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>
            <th>Difficulty Level</th>
            <th>Question</th>
            <th>Option 1</th>
            <th>Option 2</th>
            <th>Option 3</th>
            <th>Option 4</th>
            <th>Answer</th>
            <th>Film IDs</th>
            <th>Cast IDs</th>
          </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['difficulty_level']) . "</td>";
        echo "<td style='background-color:#000; color:#fff'>" . $row['question']. "</td>";
        echo "<td>" . htmlspecialchars($row['option1']) . "</td>";
        echo "<td>" . htmlspecialchars($row['option2']) . "</td>";
        echo "<td>" . htmlspecialchars($row['option3']) . "</td>";
        echo "<td>" . htmlspecialchars($row['option4']) . "</td>";
        echo "<td>" . htmlspecialchars($row['answer']) . "</td>";
        echo "<td>" . htmlspecialchars($row['film_ids']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cast_ids']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No quiz questions found for generator ID 2.";
}
?>


