<?php
// previous_producer_questions.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "config.php";

$sqld=mysqli_query($con, "delete from quiz_questions where quiz_question_generator_id='7'") or die(mysqli_error($con));
$sqlu=mysqli_query($con, "update quiz_question_generators set generated_date=now() where id='7'") or die(mysqli_error($con));

$currentYear = date('Y');
$currentMonth = date('n'); 
$currentDate = date('Y-m-d');

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

    // 1) Try to get producers from film_producer table
    $prodQuery = "
        SELECT p.name
        FROM film_producer fp
        JOIN producer p ON fp.producer_id = p.id
        WHERE fp.film_id = $film_id
    ";
    $prodResult = mysqli_query($con, $prodQuery);

    $producers = [];
    while ($row = mysqli_fetch_assoc($prodResult)) {
        $producers[] = $row['name'];
    }

    // 2) If no producers found, check film_producer_allot table
    if (empty($producers)) {
        $altQuery = "SELECT film_producer_name FROM film_producer_allot WHERE film_id = $film_id LIMIT 1";
        $altResult = mysqli_query($con, $altQuery);
        if ($altRow = mysqli_fetch_assoc($altResult)) {
            $producerIds = $altRow['film_producer_name']; // CSV of IDs e.g. "23,45,39"
            if (!empty($producerIds)) {
                $idsArray = array_map('trim', explode(',', $producerIds));
                $idsEscaped = array_map(fn($id) => intval($id), $idsArray);
                $idsList = implode(',', $idsEscaped);

                $altProdQuery = "SELECT name FROM producer WHERE id IN ($idsList)";
                $altProdResult = mysqli_query($con, $altProdQuery);
                $producers = [];
                while ($prow = mysqli_fetch_assoc($altProdResult)) {
                    $producers[] = $prow['name'];
                }
            }
        }
    }

    // Skip if still no producers
    if (empty($producers)) {
        continue;
    }

    $correctAnswer = implode(', ', $producers);

    // Options pool: producers from films ±2 years excluding correct
    $yearMin = $film_year - 2;
    $yearMax = $film_year + 2;

    $escapedCorrect = array_map(fn($n) => mysqli_real_escape_string($con, $n), $producers);
    $inClause = "'" . implode("','", $escapedCorrect) . "'";

    $poolQuery = "
        SELECT DISTINCT p.name
        FROM film_producer fp
        JOIN producer p ON fp.producer_id = p.id
        JOIN film f ON fp.film_id = f.id
        WHERE f.year_release BETWEEN $yearMin AND $yearMax
        AND p.name NOT IN ($inClause)
    ";
    $poolResult = mysqli_query($con, $poolQuery);
    $availableProducers = [];
    while ($prow = mysqli_fetch_assoc($poolResult)) {
        $availableProducers[] = $prow['name'];
    }

    // Generate wrong options
    $wrongOptions = [];
    if (count($producers) === 1) {
        shuffle($availableProducers);
        $wrongOptions = array_slice($availableProducers, 0, 3);
    } else {
        shuffle($availableProducers);
        $combinations = array_chunk($availableProducers, count($producers));
        foreach ($combinations as $combo) {
            if (count($combo) == count($producers)) {
                $wrongOptions[] = implode(', ', $combo);
            }
            if (count($wrongOptions) == 3) break;
        }
    }

    $options = $wrongOptions;
    $options[] = $correctAnswer;
    shuffle($options);
 
    $question= "Who is the producer of the <strong>{$film_year} {$language}</strong> film <strong>{$film_name}</strong>?";
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
$quiz_question_generator_id='7'; // Assuming a static ID for the quiz question generator
$quiz_category_id='7'; // Assuming a static ID for the quiz category
$difficulty = '9'; // Assuming a static difficulty level

$sql=mysqli_query($con, "INSERT INTO quiz_questions (quiz_question_generator_id, quiz_category_id, difficulty_level, question, option1, option2, option3, option4, answer, details, film_ids, date_reg) VALUES ('$quiz_question_generator_id', '$quiz_category_id', '$difficulty', '$question', '$option1', '$option2', '$option3', '$option4', '$correctOptionNumber', '$details', '$film_id', now())");

    if (!$sql) {
        echo "Error inserting question: " . mysqli_error($con) . "<br>";
    } else {
        echo "Question inserted successfully.<br>";
    }   
    

}
?>
