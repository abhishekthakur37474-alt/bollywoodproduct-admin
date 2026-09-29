<?php
// upcoming_actor_questions.php
// Question: Which actor has performed in the {year} {language} film {film name}?
// For upcoming films, single actor with popularity-based options

ini_set('display_errors', 1);
error_reporting(E_ALL);

include "config.php";

$currentYear = (int)date('Y');
$currentMonth = (int)date('n');
$currentDate = date('Y-m-d');

// Select upcoming films based on your logic:
$query = "
SELECT 
    f.id AS film_id,
    f.name AS film_name,
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
        TRIM(f.date_release) != ''
        AND STR_TO_DATE(CONCAT(f.year_release, '-', LPAD(f.month_release, 2, '0'), '-', LPAD(f.date_release, 2, '0')), '%Y-%m-%d') > '$currentDate'
    )
    OR (
        f.year_release = $currentYear
        AND (TRIM(f.date_release) = '' OR f.date_release IS NULL)
        AND (TRIM(f.month_release) = '' OR f.month_release IS NULL)
    )
ORDER BY f.year_release ASC, f.month_release ASC, f.date_release ASC
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

    // Fetch ONE random actor (cast) from film_cast table
    $castQuery = "
        SELECT c.id, c.name
        FROM film_cast fc
        JOIN cast c ON fc.cast_id = c.id
        WHERE fc.film_id = $film_id
        ORDER BY RAND()
        LIMIT 1
    ";
    $castResult = mysqli_query($con, $castQuery);

    if (!$castResult || mysqli_num_rows($castResult) == 0) {
        // No actor found, skip this film
        continue;
    }

    $actor = mysqli_fetch_assoc($castResult);
    $correctCastId = (int)$actor['id'];
    $correctCastName = $actor['name'];

    // Calculate popularity of correct actor (count films acted in)
    $popularityQuery = "
        SELECT COUNT(DISTINCT film_id) AS film_count
        FROM film_cast
        WHERE cast_id = $correctCastId
    ";
    $popularityResult = mysqli_query($con, $popularityQuery);
    $popularityRow = mysqli_fetch_assoc($popularityResult);
    $popularity = (int)$popularityRow['film_count'];

    if ($popularity == 0) {
        // Avoid division by zero or weird range, skip
        continue;
    }

    // Calculate ±30% popularity range
    $lowerBound = floor($popularity * 0.7);
    $upperBound = ceil($popularity * 1.3);

    // Get wrong options: actors with popularity in range but exclude correct actor
    $wrongOptionsQuery = "
        SELECT c.id, c.name, COUNT(DISTINCT fc.film_id) AS film_count
        FROM cast c
        JOIN film_cast fc ON c.id = fc.cast_id
        WHERE c.id != $correctCastId
        GROUP BY c.id
        HAVING film_count BETWEEN $lowerBound AND $upperBound
        ORDER BY RAND()
        LIMIT 10
    ";
    $wrongOptionsResult = mysqli_query($con, $wrongOptionsQuery);

    $wrongOptions = [];
    while ($row = mysqli_fetch_assoc($wrongOptionsResult)) {
        $wrongOptions[] = $row['name'];
    }

    // If not enough wrong options, fetch some random actors excluding correct one
    if (count($wrongOptions) < 3) {
        $needed = 3 - count($wrongOptions);
        $fallbackQuery = "
            SELECT c.name
            FROM cast c
            WHERE c.id != $correctCastId
            ORDER BY RAND()
            LIMIT $needed
        ";
        $fallbackResult = mysqli_query($con, $fallbackQuery);
        while ($row = mysqli_fetch_assoc($fallbackResult)) {
            $wrongOptions[] = $row['name'];
        }
    }

    // Pick exactly 3 wrong options
    $wrongOptions = array_slice($wrongOptions, 0, 3);

    // Prepare options and shuffle
    $options = $wrongOptions;
    $options[] = $correctCastName;
    shuffle($options);

    // Output question and options
    echo "<b>Question {$questionNo}:</b> Which actor has performed in the {$film_year} {$language} film {$film_name}?<br>";
    foreach ($options as $idx => $opt) {
        echo chr(65 + $idx) . ". " . htmlspecialchars($opt) . "<br>";
    }
    echo "<b>Correct Answer:</b> " . htmlspecialchars($correctCastName) . "<br><hr>";

    $questionNo++;
}
