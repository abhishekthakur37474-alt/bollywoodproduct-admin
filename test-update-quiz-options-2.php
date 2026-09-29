<?php
include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);


function getRandomCastIdBySimilarYear($con, $film_id) {
    // Step 1: Get the film's year_release
    $film_sql = "SELECT year_release FROM film WHERE id = " . intval($film_id) . " LIMIT 1";
    $film_res = mysqli_query($con, $film_sql);
    if (!$film_res || !($film_row = mysqli_fetch_assoc($film_res))) {
        return null; // Film not found
    }
    $year_release = (int)$film_row['year_release'];
    $min_year = $year_release - 5;
    $max_year = $year_release + 5;

    // Step 2: Find films in the year range (excluding the original film)
    $films_sql = "SELECT id FROM film WHERE year_release BETWEEN $min_year AND $max_year AND id != " . intval($film_id);
    $films_res = mysqli_query($con, $films_sql);
    $film_ids = [];
    while ($row = mysqli_fetch_assoc($films_res)) {
        $film_ids[] = $row['id'];
    }
    if (empty($film_ids)) {
        return null; // No similar films found
    }

    // Step 3: Find lead cast for these films
    $film_id_list = implode(',', array_map('intval', $film_ids));
    //echo $film_id_list;
    $lead_cast_sql = "SELECT film_lead_cast_id as cast_id FROM film_lead_cast WHERE film_id IN ($film_id_list)";
    $lead_cast_res = mysqli_query($con, $lead_cast_sql);
    $cast_ids = [];
    while ($row = mysqli_fetch_assoc($lead_cast_res)) {
        $cast_ids[] = $row['cast_id'];
    }
    if (empty($cast_ids)) {
        return null; // No lead cast found
    }

    // Step 4: Pick a random cast_id
    $cast_ids = array_unique($cast_ids);
    $random_key = array_rand($cast_ids);
    return $cast_ids[$random_key];
}

function printCastNameById($con, $cast_id) {
    $cast_id = intval($cast_id);
    $sql = "SELECT name FROM cast WHERE id = $cast_id LIMIT 1";
    $res = mysqli_query($con, $sql);
    if ($res && $row = mysqli_fetch_assoc($res)) {
        echo $row['name'];
    } else {
        echo "Cast not found";
    }
}


 
function getCastOptions($con, $film_id, $exclude_cast_id = []) {
    $option_cast_id = [];
    $max_attempts = 50;
    $attempts = 0;

    // Helper: get random cast id by similar year (assume this function exists)
    while (count($option_cast_id) < 6 && $attempts < $max_attempts) {
        $next_cast_id = getRandomCastIdBySimilarYear($con, $film_id);

        if (!$next_cast_id) {
            break;
        }

        if (!in_array($next_cast_id, $exclude_cast_id) && !in_array($next_cast_id, array_column($option_cast_id, 'id'))) {
            // Fetch cast name
            $cast_id_int = intval($next_cast_id);
            $sql = "SELECT name FROM cast WHERE id = $cast_id_int LIMIT 1";
            $res = mysqli_query($con, $sql);
            $name = "Cast not found";
            if ($res && $row = mysqli_fetch_assoc($res)) {
                $name = $row['name'];
            }
            $option_cast_id[] = [
                'id' => $cast_id_int,
                'name' => $name
            ];
            $exclude_cast_id[] = $cast_id_int;
        }
        $attempts++;
    }

    $option1 = '';
    $option2 = '';
    $option3 = '';

    if (count($option_cast_id) >= 6) {
        $option1 = $option_cast_id[0]['name'] . ', ' . $option_cast_id[1]['name'];
        $option2 = $option_cast_id[2]['name'] . ', ' . $option_cast_id[3]['name'];
        $option3 = $option_cast_id[4]['name'] . ', ' . $option_cast_id[5]['name'];
    }

    return [
        'option1' => $option1,
        'option2' => $option2,
        'option3' => $option3
    ];
}
 
function generateExcludeCastId($con, $film_id) {
    $exclude_cast_id = [];

    // Get cast_id from film_cast
    $sql1 = "SELECT cast_id FROM film_cast WHERE film_id = " . intval($film_id);
    $res1 = mysqli_query($con, $sql1);
    while ($row = mysqli_fetch_assoc($res1)) {
        $exclude_cast_id[] = $row['cast_id'];
    }

    // Get film_lead_cast_id from film_lead_cast
    $sql2 = "SELECT film_lead_cast_id FROM film_lead_cast WHERE film_id = " . intval($film_id);
    $res2 = mysqli_query($con, $sql2);
    while ($row = mysqli_fetch_assoc($res2)) {
        $exclude_cast_id[] = $row['film_lead_cast_id'];
    }

    // Remove duplicates and reindex
    $exclude_cast_id = array_values(array_unique($exclude_cast_id));

    return $exclude_cast_id;
}


// Example usage:
$film_id = 28;
$exclude_cast_id = generateExcludeCastId($con, $film_id);
$options = getCastOptions($con, $film_id, $exclude_cast_id);

echo "<b>Option 1:</b> {$options['option1']}<br>";
echo "<b>Option 2:</b> {$options['option2']}<br>";
echo "<b>Option 3:</b> {$options['option3']}<br>";


// Fetch all rows from temp_quiz_cast_questions
$sql = "SELECT id, film_id FROM temp_quiz_cast_questions";
$res = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $id = $row['id'];
    $film_id = $row['film_id'];

    // Generate exclude cast IDs for this film
    $exclude_cast_id = generateExcludeCastId($con, $film_id);

    // Generate options using the above logic
    $options = getCastOptions($con, $film_id, $exclude_cast_id);

    // Prepare values for update (escape for SQL)
    $option1 = mysqli_real_escape_string($con, $options['option1']);
    $option2 = mysqli_real_escape_string($con, $options['option2']);
    $option3 = mysqli_real_escape_string($con, $options['option3']);

    // Update the table with generated options
    $update_sql = "
        UPDATE temp_quiz_cast_questions
        SET option1 = '$option1', option2 = '$option2', option3 = '$option3'
        WHERE id = $id
        LIMIT 1
    ";
    mysqli_query($con, $update_sql);
}
// This function updates only blank option1, option2, or option3 fields in temp_quiz_cast_questions
function updateBlankQuizOptions($con) {
    $sql = "SELECT id, film_id, option1, option2, option3 FROM temp_quiz_cast_questions";
    $res = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $film_id = $row['film_id'];
        $current_option1 = $row['option1'];
        $current_option2 = $row['option2'];
        $current_option3 = $row['option3'];

        // Check if any option is blank
        if (trim($current_option1) === '' || trim($current_option2) === '' || trim($current_option3) === '') {
            // Generate exclude cast IDs for this film
            $exclude_cast_id = generateExcludeCastId($con, $film_id);

            // Generate options using the above logic
            $options = getCastOptions($con, $film_id, $exclude_cast_id);

            // Prepare values for update (escape for SQL)
            $option1 = trim($current_option1) === '' ? mysqli_real_escape_string($con, $options['option1']) : $current_option1;
            $option2 = trim($current_option2) === '' ? mysqli_real_escape_string($con, $options['option2']) : $current_option2;
            $option3 = trim($current_option3) === '' ? mysqli_real_escape_string($con, $options['option3']) : $current_option3;

            // Update only the blank options
            $update_sql = "
                UPDATE temp_quiz_cast_questions
                SET option1 = '$option1', option2 = '$option2', option3 = '$option3'
                WHERE id = $id
                LIMIT 1
            ";
            mysqli_query($con, $update_sql);
        }
    }
}

// Call the function to update blank options
updateBlankQuizOptions($con);



