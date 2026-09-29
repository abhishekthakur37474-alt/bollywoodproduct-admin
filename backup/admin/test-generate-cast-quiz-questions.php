<?php
include 'config.php'; // DB connection

// Step 1: Get all films with more than 2 lead actors
$film_sql = "
    SELECT f.id AS film_id, f.name AS film_name, f.year_release, f.main_lang
    FROM film f
    JOIN film_lead_cast flc ON flc.film_id = f.id
    GROUP BY f.id
    HAVING COUNT(DISTINCT flc.film_lead_cast_id) > 2
";
$film_result = mysqli_query($con, $film_sql);

while ($film = mysqli_fetch_assoc($film_result)) {
    $film_id = $film['film_id'];
    $film_name = $film['film_name'];
    $year = $film['year_release'];
    $main_lang_ids = explode(',', $film['main_lang']);

    // Step 2: Get language names
    $lang_names = [];
    foreach ($main_lang_ids as $lang_id) {
        $lang_res = mysqli_query($con, "SELECT name FROM dubbing WHERE id = '$lang_id'");
        if ($row = mysqli_fetch_assoc($lang_res)) {
            $lang_names[] = $row['name'];
        }
    }
    $language_string = implode(', ', $lang_names);

    // Step 3: Get lead actors (cast_id + name + language)
    $lead_actors = [];
    $lead_actor_ids = [];
    $lead_res = mysqli_query($con, "
        SELECT flc.film_lead_cast_id AS cast_id, c.name
        FROM film_lead_cast flc
        JOIN cast c ON flc.film_lead_cast_id = c.id
        WHERE flc.film_id = '$film_id'
    ");
    while ($row = mysqli_fetch_assoc($lead_res)) {
        $lead_actors[] = $row['cast_id'] . ': ' . $row['name'];
        $lead_actor_ids[] = $row['cast_id'];
    }

    $no_of_lead_actors = count($lead_actors);
    if ($no_of_lead_actors < 3) continue; // Skip if less than 3

    // Step 4: Get all cast for this film
    $all_cast = [];
    $cast_res = mysqli_query($con, "
        SELECT fc.cast_id, c.name
        FROM film_cast fc
        JOIN cast c ON fc.cast_id = c.id
        WHERE fc.film_id = '$film_id'
    ");
    while ($row = mysqli_fetch_assoc($cast_res)) {
        $all_cast[] = $row['cast_id'] . ': ' . $row['name'];
    }

    $no_of_cast = count($all_cast);
    $lead_actors_str = implode(', ', $lead_actors);
    $cast_str = implode(', ', $all_cast);

    // Step 5: Create base question
    $question = "Who among these played lead roles in the {$year} {$film_name} {$language_string} Film?";

    // Step 6: Generate all 2-combinations of lead actors (as names only for answer)
    $actor_names = array_map(function($item) {
        $parts = explode(':', $item, 2);
        return trim($parts[1]);
    }, $lead_actors);

    for ($i = 0; $i < $no_of_lead_actors; $i++) {
        for ($j = $i + 1; $j < $no_of_lead_actors; $j++) {
            $answer = $actor_names[$i] . ', ' . $actor_names[$j];

            // Step 7: Generate wrong options (random cast pairs not in answer)
            $exclude_names = [$actor_names[$i], $actor_names[$j]];

            $wrong_options = [];
            $option_attempts = 0;

            while (count($wrong_options) < 3 && $option_attempts < 20) {
                $option_attempts++;
                // Randomly get 2 cast from same language who are not in answer
                $rand_sql = "
                    SELECT DISTINCT c1.name AS name1, c2.name AS name2
                    FROM cast c1, cast c2
                    WHERE c1.id != c2.id
                      AND c1.name NOT IN ('" . implode("','", $exclude_names) . "')
                      AND c2.name NOT IN ('" . implode("','", $exclude_names) . "')
                      AND EXISTS (
                          SELECT 1 FROM film_lead_cast flc1
                          WHERE flc1.film_lead_cast_id = c1.id
                            AND flc1.movie_language IN ('" . implode("','", $lang_names) . "')
                      )
                      AND EXISTS (
                          SELECT 1 FROM film_lead_cast flc2
                          WHERE flc2.film_lead_cast_id = c2.id
                            AND flc2.movie_language IN ('" . implode("','", $lang_names) . "')
                      )
                    ORDER BY RAND()
                    LIMIT 1
                ";

                $rand_res = mysqli_query($con, $rand_sql);
                if ($rand_row = mysqli_fetch_assoc($rand_res)) {
                    $option = $rand_row['name1'] . ', ' . $rand_row['name2'];
                    if (!in_array($option, $wrong_options)) {
                        $wrong_options[] = $option;
                    }
                }
            }

            // Pad with empty if less than 3
            while (count($wrong_options) < 3) {
                $wrong_options[] = '';
            }

            // Step 8: Insert into temp_quiz_cast_questions
            $insert_main = "
                INSERT INTO temp_quiz_cast_questions
                    (film_id, film_name, year_release, languages, no_of_lead_actors, lead_actors, question, answer, no_of_cast, cast)
                VALUES (
                    '$film_id',
                    '" . mysqli_real_escape_string($con, $film_name) . "',
                    '$year',
                    '" . mysqli_real_escape_string($con, $language_string) . "',
                    '$no_of_lead_actors',
                    '" . mysqli_real_escape_string($con, $lead_actors_str) . "',
                    '" . mysqli_real_escape_string($con, $question) . "',
                    '" . mysqli_real_escape_string($con, $answer) . "',
                    '$no_of_cast',
                    '" . mysqli_real_escape_string($con, $cast_str) . "'
                )
            ";
            mysqli_query($con, $insert_main);
            $temp_question_id = mysqli_insert_id($con);

            // Step 9: Insert into temp_quiz_cast_question_list
            $insert_list = "
                INSERT INTO temp_quiz_cast_question_list
                    (temp_quiz_cast_questions_id, film_id, question, answer, option1, option2, option3)
                VALUES (
                    '$temp_question_id',
                    '$film_id',
                    '" . mysqli_real_escape_string($con, $question) . "',
                    '" . mysqli_real_escape_string($con, $answer) . "',
                    '" . mysqli_real_escape_string($con, $wrong_options[0]) . "',
                    '" . mysqli_real_escape_string($con, $wrong_options[1]) . "',
                    '" . mysqli_real_escape_string($con, $wrong_options[2]) . "'
                )
            ";
            mysqli_query($con, $insert_list);
        }
    }
}

echo "Quiz questions and options inserted successfully.";
?>
