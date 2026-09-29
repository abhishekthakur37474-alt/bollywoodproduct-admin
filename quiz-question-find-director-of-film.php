<?php
// Assume mysqli connection $con is established
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "config.php";

$sqld=mysqli_query($con, "delete from quiz_questions where quiz_question_generator_id='6'") or die(mysqli_error($con));
$sqlu=mysqli_query($con, "update quiz_question_generators set generated_date=now() where id='6'") or die(mysqli_error($con));

$currentYear = date('Y');
$currentMonth = date('n'); // numeric month without leading zero
$currentDate = date('Y-m-d');

// Select films which are NOT upcoming (inverse of upcoming conditions)
$query = "
SELECT 
    f.id AS film_id,
    f.name AS film_name,
    f.youtube,
    f.year_release,
    f.month_release,
    f.date_release,
    f.main_lang,
    d.name AS language
FROM film f
LEFT JOIN dubbing d ON f.main_lang = d.id
WHERE NOT (
    f.year_release > $currentYear
    OR (
        f.year_release = $currentYear
        AND TRIM(f.month_release) != ''
        AND f.month_release > $currentMonth
    )
    OR (
        TRIM(f.year_release) != ''
        AND TRIM(f.month_release) != ''
        AND TRIM(f.date_release) != ''
        AND STR_TO_DATE(CONCAT(f.year_release, '-', LPAD(f.month_release, 2, '0'), '-', LPAD(f.date_release, 2, '0')), '%Y-%m-%d') > '$currentDate'
    )
    OR (
        f.year_release = $currentYear
        AND (TRIM(f.date_release) = '' OR f.date_release IS NULL)
        AND (TRIM(f.month_release) = '' OR f.month_release IS NULL)
    )
)
ORDER BY f.year_release DESC
";

$result = mysqli_query($con, $query);
$questionNo = 1;

while ($film = mysqli_fetch_assoc($result)) {
    $film_id = $film['film_id'];
    $film_name = $film['film_name'];
    $film_year = $film['year_release'];
    $language = $film['language'] ?? 'Unknown';

    // 1) Try to get directors from film_director table
    $dirQuery = "
        SELECT d.name
        FROM film_director fd
        JOIN director d ON fd.director_id = d.id
        WHERE fd.film_id = $film_id
    ";
    $dirResult = mysqli_query($con, $dirQuery);

    $directors = [];
    while ($row = mysqli_fetch_assoc($dirResult)) {
        $directors[] = $row['name'];
    }

    // 2) If no directors found, check film_directors_allot table (director field is CSV)
    if (empty($directors)) {
        $altQuery = "SELECT director FROM film_directors_allot WHERE film_id = $film_id LIMIT 1";
        $altResult = mysqli_query($con, $altQuery);
        if ($altRow = mysqli_fetch_assoc($altResult)) {
            $directorIds = $altRow['director']; // e.g. "3,5,8"
            if (!empty($directorIds)) {
                $idsArray = array_map('trim', explode(',', $directorIds));
                $idsEscaped = array_map(fn($id) => intval($id), $idsArray);
                $idsList = implode(',', $idsEscaped);

                // Fetch director names for these ids
                $altDirQuery = "SELECT name FROM director WHERE id IN ($idsList)";
                $altDirResult = mysqli_query($con, $altDirQuery);
                $directors = [];
                while ($drow = mysqli_fetch_assoc($altDirResult)) {
                    $directors[] = $drow['name'];
                }
            }
        }
    }

    // 3) If still no directors, skip this film
    if (empty($directors)) {
        continue;
    }

    $correctAnswer = implode(', ', $directors);

    // Prepare option pool from films released ±2 years, excluding correct directors
    $yearMin = $film_year - 2;
    $yearMax = $film_year + 2;

    $escapedCorrect = array_map(fn($n) => mysqli_real_escape_string($con, $n), $directors);
    $inClause = "'" . implode("','", $escapedCorrect) . "'";

    $poolQuery = "
        SELECT DISTINCT d.name
        FROM film_director fd
        JOIN director d ON fd.director_id = d.id
        JOIN film f ON fd.film_id = f.id
        WHERE f.year_release BETWEEN $yearMin AND $yearMax
        AND d.name NOT IN ($inClause)
    ";
    $poolResult = mysqli_query($con, $poolQuery);
    $availableDirectors = [];
    while ($prow = mysqli_fetch_assoc($poolResult)) {
        $availableDirectors[] = $prow['name'];
    }

    // Generate wrong options
    $wrongOptions = [];
    if (count($directors) === 1) {
        shuffle($availableDirectors);
        $wrongOptions = array_slice($availableDirectors, 0, 3);
    } else {
        shuffle($availableDirectors);
        $combinations = array_chunk($availableDirectors, count($directors));
        foreach ($combinations as $combo) {
            if (count($combo) == count($directors)) {
                $wrongOptions[] = implode(', ', $combo);
            }
            if (count($wrongOptions) == 3) break;
        }
    }

    $options = $wrongOptions;
    $options[] = $correctAnswer;
    shuffle($options);
 
   
    $question= "Who is the director of the <strong>{$film_year} {$language}</strong> film <strong>{$film_name}</strong>?";
    echo $question;
    echo "<br>";

   
   
    foreach ($options as $idx => $opt) {
          ${"option" . ($idx + 1)} = $opt;
        echo chr(65 + $idx) . ". " . htmlspecialchars($opt) . "<br>";
    }
    echo "<b>Correct Answer:</b> " . htmlspecialchars($correctAnswer) . "<br><hr>";

    $questionNo++;

    
    
$correctIndex = array_search($correctAnswer, $options); // returns 0-based index
$correctOptionNumber = $correctIndex + 1;
$details=$film['youtube'];
$film_id = $film['film_id'];
$quiz_question_generator_id='6'; // Assuming a static ID for the quiz question generator
$quiz_category_id='6'; // Assuming a static ID for the quiz category
$difficulty = '9'; // Assuming a static difficulty level

$sql=mysqli_query($con, "INSERT INTO quiz_questions (quiz_question_generator_id, quiz_category_id, difficulty_level, question, option1, option2, option3, option4, answer, details, film_ids, date_reg) VALUES ('$quiz_question_generator_id', '$quiz_category_id', '$difficulty', '$question', '$option1', '$option2', '$option3', '$option4', '$correctOptionNumber', '$details', '$film_id', now())");

    if (!$sql) {
        echo "Error inserting question: " . mysqli_error($con) . "<br>";
    } else {
        echo "Question inserted successfully.<br>";
    }   
    

}
?>
