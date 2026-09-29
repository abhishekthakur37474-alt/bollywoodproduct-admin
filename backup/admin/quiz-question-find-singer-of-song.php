<?php
// Assume mysqli connection $con is already established

ini_set('display_errors', 1);
error_reporting(E_ALL);

include "config.php";
if(isset($_GET['action']) && $_GET['action']=='First'){


$sqld=mysqli_query($con, "delete from quiz_questions where quiz_question_generator_id='1'") or die(mysqli_error($con));
$sqlu=mysqli_query($con, "update quiz_question_generators set generated_date=now() where id='1'") or die(mysqli_error($con));


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
 

$songQuery = "
SELECT 
  fs.id AS song_id, 
  fs.title AS song_title, 
  fs.youtube_view_count,  
  fs.youtube, 
  f.name AS film_name, 
  f.year_release AS film_year,
  GROUP_CONCAT(sl.name SEPARATOR ', ') AS song_language
FROM film_song fs 
JOIN film f ON fs.film_id = f.id
LEFT JOIN songlanguage slmap ON slmap.song_id = fs.id
LEFT JOIN song_language sl ON sl.id = slmap.language_id
GROUP BY fs.id 
";

$songResult = mysqli_query($con, $songQuery);

while ($song = mysqli_fetch_assoc($songResult)) {
    $song_id = $song['song_id'];
    $song_title = $song['song_title'];
    $song_language = $song['song_language'];
    $film_year = $song['film_year'];
    $film_name = $song['film_name'];
    $views = $song['youtube_view_count'];
    $difficulty = getDifficultyLevel($views);

    // Get correct singers
    $singerQuery = "SELECT s.name 
                    FROM song_singer ss 
                    JOIN singer s ON ss.singer_id = s.id 
                    WHERE ss.song_id = $song_id";
    $singerResult = mysqli_query($con, $singerQuery);

    $singers = [];
    while ($row = mysqli_fetch_assoc($singerResult)) {
        $singers[] = $row['name'];
    }

    $correctAnswer = implode(', ', $singers);
    $escapedCorrect = array_map(fn($n) => mysqli_real_escape_string($con, $n), $singers);
    $inClause = "'" . implode("','", $escapedCorrect) . "'";

    // Build a pool of singers from films released ±2 years
    $yearMin = $film_year - 2;
    $yearMax = $film_year + 2;

    $poolQuery = "
        SELECT DISTINCT s.name
        FROM film_song fs
        JOIN film f ON fs.film_id = f.id
        JOIN song_singer ss ON fs.id = ss.song_id
        JOIN singer s ON ss.singer_id = s.id
        WHERE f.year_release BETWEEN $yearMin AND $yearMax
        AND s.name NOT IN ($inClause)
    ";
    $poolResult = mysqli_query($con, $poolQuery);
    $availableSingers = [];
    while ($row = mysqli_fetch_assoc($poolResult)) {
        $availableSingers[] = $row['name'];
    }

    $wrongOptions = [];
    if (count($singers) === 1) {
        shuffle($availableSingers);
        $wrongOptions = array_slice($availableSingers, 0, 3);
    } else {
        shuffle($availableSingers);
        $combinations = array_chunk($availableSingers, count($singers));
        foreach ($combinations as $combo) {
            if (count($combo) == count($singers)) {
                $wrongOptions[] = implode(', ', $combo);
            }
            if (count($wrongOptions) == 3) break;
        }
    }

    // Combine and shuffle options
    $options = $wrongOptions;
    $options[] = $correctAnswer;
    shuffle($options);


    $question = 'Who is the <strong style="color:rgb(255, 0, 255);">singer</strong> of the song <strong style="color: #FFD700;">' . $song_title . '</strong> from the <strong style="color: #0dcaf0;">' . $film_year . '</strong> <strong style="color: #fff;">' . $song_language . '</strong> film <strong style="color: #39FF14;">' . $film_name . '</strong>?';
    // Print result
    // $question = 'Who is the singer of the <strong style="color: #fff;">' . $song_language . '</strong> song <strong style="color: #FFD700;">' . $song_title . '</strong> from the film <strong style="color: #39FF14;">' . $film_name . '</strong> (<strong style="color: #0dcaf0;">' . $film_year . '</strong>)?';
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
$quiz_question_generator_id='1'; // Assuming a static ID for the quiz question generator
$quiz_category_id='1'; // Assuming a static ID for the quiz category

echo "<b>Correct Answer:</b> $correctAnswer<br>";
echo "<b>Correct Answer Index:</b> $correctOptionNumber<br>";
echo "<b>Difficulty Level:</b> $difficulty<br><hr>";
$sql=mysqli_query($con, "INSERT INTO quiz_questions (quiz_question_generator_id, quiz_category_id, difficulty_level, question, option1, option2, option3, option4, answer, details, song_ids, date_reg) VALUES ('$quiz_question_generator_id', '$quiz_category_id', '$difficulty', '$question', '$option1', '$option2', '$option3', '$option4', '$correctOptionNumber', '$details', '$song_id', now())");

    if (!$sql) {
        echo "Error inserting question: " . mysqli_error($con) . "<br>";
    } else {
        echo "Question inserted successfully.<br>";
    }   
    

}

echo "<script>alert('  $deleted_count Old Question Deleted and New Question Generated successfully!');window.location.href='quiz-question-find-singer-of-song.php';</script>";
exit;
}
?>



<h3>Singer of Song Quiz Questions </h3>

<a href="quiz-question-find-singer-of-song.php?action=First">Delete Old and Generate New Questions </a>
<br><br>



<br>
<h2 style="text-align: center;">Initial 10 Questions</h2>

<br>

<?php
// Connect to the database (assume $conn is already available, otherwise add your connection code here)
$query = "SELECT difficulty_level, question, option1, option2, option3, option4, answer, film_ids, cast_ids 
          FROM quiz_questions 
          WHERE quiz_question_generator_id=1 
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
    echo "No quiz questions found for generator ID 1.";
}
?>

<br>
<h2 style="text-align: center;">Random 10 Questions</h2>
<br>

<?php
// Connect to the database (assume $conn is already available, otherwise add your connection code here)
$query = "SELECT difficulty_level, question, option1, option2, option3, option4, answer, film_ids, cast_ids 
          FROM quiz_questions 
          WHERE quiz_question_generator_id=1 order by rand()
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
    echo "No quiz questions found for generator ID 1.";
}
?>

