<?php
// upcoming_production_house_questions.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "config.php";

$sqld=mysqli_query($con, "delete from quiz_questions where quiz_question_generator_id='9'") or die(mysqli_error($con));
$sqlu=mysqli_query($con, "update quiz_question_generators set generated_date=now() where id='9'") or die(mysqli_error($con));

$currentYear = date('Y');
$currentMonth = date('n');
$currentDate = date('Y-m-d');

// Get upcoming films based on your date logic
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
WHERE 
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
ORDER BY f.year_release ASC
";

$result = mysqli_query($con, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

$questionNo = 1;

while ($film = mysqli_fetch_assoc($result)) {
    $film_id = (int)$film['film_id'];
    $film_name = $film['film_name'];
    $film_year = (int)$film['year_release'];
    $language = $film['language'] ?? 'Unknown';

    // Get production house(s) from film_production_and_distributing table
    $prodHouseQuery = "
        SELECT productionanddistribution.name
        FROM film_production_and_distributing fpd
        JOIN productionanddistribution ON FIND_IN_SET(productionanddistribution.id, fpd.film_production_company_name) > 0
        WHERE fpd.film_id = $film_id
    ";
    $prodHouseResult = mysqli_query($con, $prodHouseQuery);

    $productionHouses = [];
    while ($row = mysqli_fetch_assoc($prodHouseResult)) {
        $productionHouses[] = $row['name'];
    }

    if (empty($productionHouses)) {
        continue; // skip if no production house found
    }

    $correctAnswer = implode(', ', $productionHouses);

    // Prepare wrong options - from production houses in films ±2 years excluding correct answer
    $yearMin = $film_year - 2;
    $yearMax = $film_year + 2;

    $escapedCorrect = array_map(function($name) use ($con) {
        return mysqli_real_escape_string($con, $name);
    }, $productionHouses);
    $inClause = "'" . implode("','", $escapedCorrect) . "'";

    $wrongOptionsQuery = "
        SELECT DISTINCT productionanddistribution.name
        FROM film_production_and_distributing fpd
        JOIN productionanddistribution ON FIND_IN_SET(productionanddistribution.id, fpd.film_production_company_name) > 0
        JOIN film f ON fpd.film_id = f.id
        WHERE f.year_release BETWEEN $yearMin AND $yearMax
        AND productionanddistribution.name NOT IN ($inClause)
        LIMIT 50
    ";
    $wrongOptionsResult = mysqli_query($con, $wrongOptionsQuery);

    $availableHouses = [];
    while ($row = mysqli_fetch_assoc($wrongOptionsResult)) {
        $availableHouses[] = $row['name'];
    }

    $wrongOptions = [];
    if (count($productionHouses) === 1) {
        shuffle($availableHouses);
        $wrongOptions = array_slice($availableHouses, 0, 3);
    } else {
        shuffle($availableHouses);
        $chunks = array_chunk($availableHouses, count($productionHouses));
        foreach ($chunks as $chunk) {
            if (count($chunk) === count($productionHouses)) {
                $wrongOptions[] = implode(', ', $chunk);
            }
            if (count($wrongOptions) === 3) break;
        }
    }

    while (count($wrongOptions) < 3) {
        $wrongOptions[] = "Unknown Production House";
    }

    $options = $wrongOptions;
    $options[] = $correctAnswer;
    shuffle($options);
 
   
    $question= "Under which Production House the <strong>{$film_year} {$language}</strong> film <strong>{$film_name}</strong> has been made?";
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
$quiz_question_generator_id='9'; // Assuming a static ID for the quiz question generator
$quiz_category_id='9'; // Assuming a static ID for the quiz category
$difficulty = '10'; // Assuming a static difficulty level

$sql=mysqli_query($con, "INSERT INTO quiz_questions (quiz_question_generator_id, quiz_category_id, difficulty_level, question, option1, option2, option3, option4, answer, details, film_ids, date_reg) VALUES ('$quiz_question_generator_id', '$quiz_category_id', '$difficulty', '$question', '$option1', '$option2', '$option3', '$option4', '$correctOptionNumber', '$details', '$film_id', now())");

    if (!$sql) {
        echo "Error inserting question: " . mysqli_error($con) . "<br>";
    } else {
        echo "Question inserted successfully.<br>";
    }   
    
}
?>
