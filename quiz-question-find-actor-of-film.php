<?php
// previous_actor_questions.php
// Question: Which actor has performed in the {year} {language} film {film name}?
// For previous (non-upcoming) films


// Who among these played one of the lead roles in the {film year} {film language} film {film name}? 

// --
// find film_id, no_of_film_lead_cast_id from (table film_lead_cast->id,film_id, film_lead_cast_id) which film has at least 2 different film_lead_cast_id

// SELECT film_id, COUNT(DISTINCT film_lead_cast_id) AS no_of_film_lead_cast_id FROM film_lead_cast GROUP BY film_id HAVING COUNT(DISTINCT film_lead_cast_id) >= 2;


// function getTwoCombinations($con, $no_of_film_lead_cast_id) {
//     if ($no_of_film_lead_cast_id < 2) return 0;
//     return ($no_of_film_lead_cast_id * ($no_of_film_lead_cast_id - 1)) / 2;
// }

// $two_combinations = getTwoCombinations($con, $no_of_film_lead_cast_id);


// create question-> from film table(film->id, name, main_lang(comma saperated ids of table dubbing->id,name), year_release)
// "Who among these played one of the lead roles in the {film_year} {film_language} film {film_name}?"





// Create Answer cast_ids (comma saperated id)-> 
// loop from where $quiz_question_generator_id=11 from table quiz_questions->id, $quiz_question_generator_id,cast_ids, film_ids as film_id

// find film_lead_cast_id for given film_id from (table film_lead_cast->id,film_id, film_lead_cast_id)

// --


// - create group of two film cast and name it as answer_combination (if only 2 film_lead_cast_id)
// - (if more than 2 film_lead_cast_id)
// 	-create set of 2 cast_id and save in answer_combination arry 1
// 	-create for all possible combination and save it as answer_combination array next next next

    
// - update quiz_questions->cast_ids with answer_combination each array (first entry for first combinaton then second for second) for each same film id




// -------------

//  loop table quiz_questions->id, option1, cast_ids

// get option1 value of cast_ids(comma saperated ids of table cast->(id,name) and convert into comma saperated $name
// update field of option1 



 


// --------------------------------
// // -- now options
// loop quiz_questions and find film_id from quiz_questions->film_ids

 


// find selected_film_ids with has (year_release +- 5 for release_year of given film_id)

// create combination of skip_cast_ids and add all list of (film_lead_cast_id)  for given film_id from (table film_lead_cast->id,film_id, film_lead_cast_id)
// add more in  skip_cast_ids and add all list of (cast_id) for given film_id from (table film_cast->id,film_id, cast_id)
// filter only unique value from skip_cast_ids

// create options_cast_ids (loop until we get 6 unique cast_ids)
// { 
// find film_lead_cast_id as selected_film_lead_cast_id from (table film_lead_cast->id,film_id, film_lead_cast_id)
// add to options_cast_ids if( selected_film_lead_cast_id does not exist in  skip_cast_ids)
// repeat till we get 6 options_cast_ids
// } if do not get 6 options then fill remaining with 0 (cast_name will be blank)

// create 2 2 set for options_cast_ids from  (table film_cast->id,film_id, cast_id)
// create value 
// option2 = (2 comma saperated name)
// option3 = (2 another comma saperated name)
// option4 = (2 another comma saperated name)






// loop through quiz_questions 
// randomize the position of 

 
// option1  (this is correct answer)
// option2
// option3
// option4

// and save it as
// option1
// option2
// option3
// option4
// answer(it will be number 1,2,3 or 4)  

// update the database
// delete from database which has blank entry in option1 or option2 or option3 or option4


// ------

// updating difficulty_level
// loop through quiz_questions 

// for a given 2 cast id from  cast_ids find sum of their films as average_film_by_answer_cast from  (table film_lead_cast->id,film_id, film_lead_cast_id)
// find average and update average_film_by_answer_cast by dividing it by 2

// use this logic to return difficulty_level
// level - logic (average_film_by_answer_cast)
// 1 - if average_film_by_answer_cast> 76 and above
// 2 - 50-75
// 3 - 41-50
// 4 - 21-40
// 5 - 11-20
// 6 - 6-10
// 7 - 4-5
// 8 - 3
// 9 - 2
// 10 - 1

// update quiz_questions->difficulty_level with difficulty_level





















ini_set('display_errors', 1);
error_reporting(E_ALL);

include "config.php";
 

if(isset($_GET['action']) && $_GET['action']=='First'){
$sqld=mysqli_query($con, "delete from quiz_questions where quiz_question_generator_id='11'") or die(mysqli_error($con));
$deleted_count = mysqli_affected_rows($con);


echo "Number of records deleted: " . $deleted_count . "<br>";
$sqlu=mysqli_query($con, "update quiz_question_generators set generated_date=now() where id='11'") or die(mysqli_error($con));
echo "Question Generated Time Updated  Successfully";

echo "<script>alert('  $deleted_count Actor Quiz Questions deleted successfully!');window.location.href='quiz-question-find-actor-of-film.php';</script>";
exit;


}














if(isset($_GET['action']) && $_GET['action']=='Second'){
// Function to calculate 2-combinations (nC2)
function getTwoCombinations($con, $no_of_film_lead_cast_id) {
    if ($no_of_film_lead_cast_id < 2) return 0;
    return ($no_of_film_lead_cast_id * ($no_of_film_lead_cast_id - 1)) / 2;
}

// Fetch films with at least 2 different lead cast members
$sql = "
    SELECT f.id AS film_id, f.name AS film_name, f.main_lang, f.year_release,f.type,
           COUNT(DISTINCT flc.film_lead_cast_id) AS lead_count
    FROM film f
    JOIN film_lead_cast flc ON f.id = flc.film_id
    GROUP BY f.id
    HAVING lead_count >= 2
";

$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $film_id = $row['film_id'];
        $film_name = $row['film_name'];
        $main_lang = $row['main_lang']; // Comma-separated IDs
        $year = $row['year_release'];
        $type = $row['type'];
        $lead_count = $row['lead_count'];

        // Convert language IDs to names
        $lang_names = '';
        if (!empty($main_lang)) {
            $lang_ids = explode(',', $main_lang);
            $in = implode(',', array_map('intval', $lang_ids));
            $lang_sql = "SELECT name FROM dubbing WHERE id IN ($in)";
            $lang_result = mysqli_query($con, $lang_sql);
            $names = [];
            while ($lang_row = mysqli_fetch_assoc($lang_result)) {
                $names[] = $lang_row['name'];
            }
            $lang_names = implode(', ', $names);
        }

        // Generate the question
        // Add color styling for $year (Yellow), $lang_names (Purple), $type (Fluorescent Sky Blue), $film_name (Fluorescent Green)
        $year_colored = "<span style='color:yellow;'>$year</span>";
        $lang_names_colored = "<span style='color:purple;'>$lang_names</span>";
        $type_colored = "<span style='color:#00e6ff;'>$type</span>"; // Fluorescent sky blue
        $film_name_colored = "<span style='color:#39ff14;'>$film_name</span>"; // Fluorescent green
        $question = "Who among these played one of the lead roles in the $year_colored $lang_names_colored $type_colored $film_name_colored?";

        // Calculate number of combinations
        $two_combinations = getTwoCombinations($con, $lead_count);

        // Insert that question into `quiz_questions` table multiple times
        for ($i = 0; $i < $two_combinations; $i++) {
            $insert_sql = "INSERT INTO quiz_questions (quiz_question_generator_id, quiz_category_id, question, film_ids)
                           VALUES (11, 11, ?, ?)";
            $stmt = mysqli_prepare($con, $insert_sql);
            mysqli_stmt_bind_param($stmt, 'ss', $question, $film_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    echo "Questions inserted successfully.";
} else {
    echo "No eligible films found.";
}

// Count how many questions were inserted in this run
if ($result && mysqli_num_rows($result) > 0) {
    // $two_combinations is the number of questions per film
    // $result is the set of eligible films
    $num_films = mysqli_num_rows($result);
    // But we already looped through $result above, so $result is exhausted.
    // Instead, let's count total inserted by querying the DB for this run.
    // If you want to count in this loop, accumulate a counter:
    $total_inserted = 0;
    mysqli_data_seek($result, 0); // rewind result set
    while ($row = mysqli_fetch_assoc($result)) {
        $lead_count = $row['lead_count'];
        $total_inserted += getTwoCombinations($con, $lead_count);
    }
    echo "<br>Total questions inserted: $total_inserted<br>";
}

echo "<script>alert('  $total_inserted Actor Quiz Questions inserted successfully!');window.location.href='quiz-question-find-actor-of-film.php';</script>";
exit;

}

 


 
// sleep(10); // Slower but safer for shared hosting




if(isset($_GET['action']) && $_GET['action']=='Third'){

// Step 1: Fetch all questions with generator_id = 11 and group by film_id
$sql = "SELECT id, film_ids FROM quiz_questions WHERE quiz_question_generator_id = 11 ORDER BY film_ids, id ASC";
$result = mysqli_query($con, $sql);

$questions_by_film = [];

while ($row = mysqli_fetch_assoc($result)) {
    $film_id = $row['film_ids'];
    $questions_by_film[$film_id][] = $row['id'];
}

// Step 2: For each film, get cast combinations and update each question
foreach ($questions_by_film as $film_id => $question_ids) {
    // Get all lead cast IDs for this film
    $cast_ids = [];
    $cast_sql = "SELECT DISTINCT film_lead_cast_id FROM film_lead_cast WHERE film_id = $film_id";
    $cast_result = mysqli_query($con, $cast_sql);
    while ($cast_row = mysqli_fetch_assoc($cast_result)) {
        $cast_ids[] = $cast_row['film_lead_cast_id'];
    }

    // Generate all 2-combinations
    $answer_combinations = [];
    $count = count($cast_ids);
    for ($i = 0; $i < $count - 1; $i++) {
        for ($j = $i + 1; $j < $count; $j++) {
            $answer_combinations[] = $cast_ids[$i] . ',' . $cast_ids[$j];
        }
    }

    // Step 3: Update each question with a corresponding combination
    for ($i = 0; $i < count($question_ids) && $i < count($answer_combinations); $i++) {
        $q_id = $question_ids[$i];
        $cast_pair = $answer_combinations[$i];

        $update_sql = "UPDATE quiz_questions SET cast_ids = ? WHERE id = ?";
        $stmt = mysqli_prepare($con, $update_sql);
        mysqli_stmt_bind_param($stmt, 'si', $cast_pair, $q_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

echo "Cast ID combinations updated successfully.";

echo "<script>alert('  Actor Quiz Answer inserted successfully!');window.location.href='quiz-question-find-actor-of-film.php';</script>";


}



// sleep(10); // Slower but safer for shared hosting

















if(isset($_GET['action']) && $_GET['action']=='Forth'){
 
function getLeadFilmCount($con, $cast_id) {
    $sql = "SELECT COUNT(DISTINCT film_id) as film_count FROM film_cast WHERE cast_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $cast_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    return $count ?: 0;
}

function getDifficultyLevel($avg) {
    if ($avg >= 76) return 1;
    if ($avg >= 50) return 2;
    if ($avg >= 41) return 3;
    if ($avg >= 21) return 4;
    if ($avg >= 11) return 5;
    if ($avg >= 6)  return 6;
    if ($avg >= 4)  return 7;
    if ($avg == 3)  return 8;
    if ($avg == 2)  return 9;
    return 10; // avg == 1 or 0
}

// Step: Loop through quiz_questions where cast_ids are set
$sql = "SELECT id, cast_ids FROM quiz_questions WHERE cast_ids IS NOT NULL AND cast_ids != ''";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $cast_ids = explode(',', $row['cast_ids']);
    if (count($cast_ids) != 2) continue; // must be 2 cast IDs

    $cast1 = (int)$cast_ids[0];
    $cast2 = (int)$cast_ids[1];

    // Step: Get film counts
    $count1 = getLeadFilmCount($con, $cast1);
 
    $count2 = getLeadFilmCount($con, $cast2);
 
    // Step: Average
    $avg = ($count1 + $count2) / 2;
   
    // Step: Difficulty level based on average
    $difficulty = getDifficultyLevel($avg);
   
    // Step: Update difficulty_level
    $update_sql = "UPDATE quiz_questions SET difficulty_level = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $update_sql);
    mysqli_stmt_bind_param($stmt, 'ii', $difficulty, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Optional: Sleep every 100 to avoid overload
    static $counter = 0;
    if (++$counter % 100 === 0) sleep(1);
}

echo "Difficulty levels updated successfully.";
 echo "<script>alert('Difficulty levels updated successfully!');window.location.href='quiz-question-find-actor-of-film.php';</script>";

}




if(isset($_GET['action']) && $_GET['action']=='Fifth'){
 
// Step 1: Get all quiz questions with cast_ids
$sql = "SELECT id, cast_ids FROM quiz_questions WHERE quiz_question_generator_id = 11 AND cast_ids IS NOT NULL AND cast_ids != ''";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $question_id = $row['id'];
    $cast_ids = $row['cast_ids'];

    // Split cast_ids by comma
    $ids = explode(',', $cast_ids);
    $names = [];

    // Fetch each cast name
    foreach ($ids as $cast_id) {
        $cast_id = intval($cast_id);
        $name_sql = "SELECT name FROM cast WHERE id = $cast_id LIMIT 1";
        $name_result = mysqli_query($con, $name_sql);
        if ($name_row = mysqli_fetch_assoc($name_result)) {
            $names[] = $name_row['name'];
        }
    }

    // Join names into comma-separated string
    $option1 = implode(', ', $names);

    // Update option1 in quiz_questions
    $update_sql = "UPDATE quiz_questions SET option1 = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $update_sql);
    mysqli_stmt_bind_param($stmt, 'si', $option1, $question_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

echo "Option1 updated with cast names successfully.";
echo "<script>alert('Option1 updated with cast names successfully.');window.location.href='quiz-question-find-actor-of-film.php';</script>";

}



// sleep(10); // Slower but safer for shared hosting




if(isset($_GET['action']) && $_GET['action']=='Sixth'){
 
function getCastName($con, $id) {
    $sql = "SELECT name FROM cast WHERE id = $id LIMIT 1";
    $res = mysqli_query($con, $sql);
    if ($row = mysqli_fetch_assoc($res)) {
        return $row['name'];
    }
    return '';
}

// Step 1: Loop through all quiz questions
$qsql = "SELECT id, film_ids FROM quiz_questions WHERE quiz_question_generator_id = 11 ORDER BY id ASC";
$qresult = mysqli_query($con, $qsql);

while ($qrow = mysqli_fetch_assoc($qresult)) {
    $question_id = $qrow['id'];
    $film_id = $qrow['film_ids'];

    // Step 2: Get release year of this film
    $film_sql = "SELECT year_release FROM film WHERE id = $film_id";
    $film_res = mysqli_query($con, $film_sql);
    $film_row = mysqli_fetch_assoc($film_res);
    $year = $film_row['year_release'];

    $min_year = $year - 5;
    $max_year = $year + 5;

    // Step 3: Get film IDs in selected year range (excluding the same film)
    $film_ids_sql = "SELECT id FROM film WHERE year_release BETWEEN $min_year AND $max_year AND id != $film_id";
    $film_ids_res = mysqli_query($con, $film_ids_sql);
    $selected_film_ids = [];
    while ($row = mysqli_fetch_assoc($film_ids_res)) {
        $selected_film_ids[] = $row['id'];
    }

    // Step 4: Build skip_cast_ids
    $skip_cast_ids = [];

    // From film_lead_cast
    $lead_sql = "SELECT DISTINCT film_lead_cast_id FROM film_lead_cast WHERE film_id = $film_id";
    $lead_res = mysqli_query($con, $lead_sql);
    while ($row = mysqli_fetch_assoc($lead_res)) {
        $skip_cast_ids[] = $row['film_lead_cast_id'];
    }

    // From film_cast
    $cast_sql = "SELECT DISTINCT cast_id FROM film_cast WHERE film_id = $film_id";
    $cast_res = mysqli_query($con, $cast_sql);
    while ($row = mysqli_fetch_assoc($cast_res)) {
        $skip_cast_ids[] = $row['cast_id'];
    }

    $skip_cast_ids = array_unique($skip_cast_ids);

    // Step 5: Collect 6 valid option cast IDs
    $options_cast_ids = [];
    shuffle($selected_film_ids); // randomize films

    foreach ($selected_film_ids as $fid) {
        $option_sql = "SELECT DISTINCT cast_id FROM film_cast WHERE film_id = $fid";
        $option_res = mysqli_query($con, $option_sql);
        while ($opt = mysqli_fetch_assoc($option_res)) {
            $cid = $opt['cast_id'];
            if (!in_array($cid, $skip_cast_ids) && !in_array($cid, $options_cast_ids)) {
                $options_cast_ids[] = $cid;
                if (count($options_cast_ids) >= 6) break 2;
            }
        }
    }

    // Pad if not enough options
    while (count($options_cast_ids) < 6) {
        $options_cast_ids[] = 0; // 0 will give blank cast name
    }

    // Step 6: Create 3 sets of 2-2 combinations
    $option2_ids = array_slice($options_cast_ids, 0, 2);
    $option3_ids = array_slice($options_cast_ids, 2, 2);
    $option4_ids = array_slice($options_cast_ids, 4, 2);

    $option2 = implode(', ', array_map(function($id) use ($con) {
        return getCastName($con, $id);
    }, $option2_ids));

    $option3 = implode(', ', array_map(function($id) use ($con) {
        return getCastName($con, $id);
    }, $option3_ids));

    $option4 = implode(', ', array_map(function($id) use ($con) {
        return getCastName($con, $id);
    }, $option4_ids));

    // Step 7: Update question with options
    $update_sql = "UPDATE quiz_questions SET option2 = ?, option3 = ?, option4 = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $update_sql);
    mysqli_stmt_bind_param($stmt, 'sssi', $option2, $option3, $option4, $question_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

echo "Option2, Option3, Option4 updated successfully.";
echo "<script>alert('Option2, Option3, Option4 updated successfully.');window.location.href='quiz-question-find-actor-of-film.php';</script>";

}




// sleep(10); // Slower but safer for shared hosting


 
if(isset($_GET['action']) && $_GET['action']=='Seventh'){
 
//Step 1: Delete all incomplete rows with any blank option
$delete_sql = "
    DELETE FROM quiz_questions 
    WHERE option1 = '' OR option1 IS NULL
       OR option2 = '' OR option2 IS NULL
       OR option3 = '' OR option3 IS NULL
       OR option4 = '' OR option4 IS NULL and quiz_question_generator_id='11'
";
mysqli_query($con, $delete_sql);

echo "<script>alert('Delete all incomplete rows with any blank option');window.location.href='quiz-question-find-actor-of-film.php';</script>";

}



if(isset($_GET['action']) && $_GET['action']=='Eighth'){


//Step 2: Fetch remaining questions
$fetch_sql = "SELECT id, option1, option2, option3, option4 FROM quiz_questions";
$result = mysqli_query($con, $fetch_sql);

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];

    // Original correct answer
    $correct_text = $row['option1'];

    // Shuffle options
    $options = [
        $row['option1'],
        $row['option2'],
        $row['option3'],
        $row['option4'],
    ];

    shuffle($options);

    // Determine new position of original correct answer
    $answer_index = array_search($correct_text, $options); // 0-based
    $answer = $answer_index + 1; // 1-based (1 to 4)

    // Update the question
    $update_sql = "
        UPDATE quiz_questions 
        SET option1 = ?, option2 = ?, option3 = ?, option4 = ?, answer = ?
        WHERE id = ?
    ";
    $stmt = mysqli_prepare($con, $update_sql);
    mysqli_stmt_bind_param($stmt, 'ssssii', $options[0], $options[1], $options[2], $options[3], $answer, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

echo "Options shuffled and answers updated. Blank entries deleted.";

echo "<script>alert('Options shuffled and answers updated.');window.location.href='quiz-question-find-actor-of-film.php';</script>";

}

// sleep(20); // Slower but safer for shared hosting





// ?>
<br><br>
<h3>Actor Quiz Questions </h3>

<a href="quiz-question-find-actor-of-film.php?action=First">Delete Old Questions</a>
<br><br>

<a href="quiz-question-find-actor-of-film.php?action=Second">Create  Questions</a>
<br><br>

<a href="quiz-question-find-actor-of-film.php?action=Third">Create   Answer</a>
<br><br>

<a href="quiz-question-find-actor-of-film.php?action=Forth">Create  Difficulty Level</a>
<br><br>

<a href="quiz-question-find-actor-of-film.php?action=Fifth">Update Option1 with Real Cast Names</a>
<br><br>

<a href="quiz-question-find-actor-of-film.php?action=Sixth">Update Option2, 3, 4 with   Cast Names</a>

<br><br>

<a href="quiz-question-find-actor-of-film.php?action=Seventh">Delete all incomplete rows with any blank option</a>



<br><br>

<a href="quiz-question-find-actor-of-film.php?action=Eighth">Options shuffled and answers updated</a>


<br>
<h2 style="text-align: center;">Initial 10 Questions</h2>

<br>

<?php
// Connect to the database (assume $conn is already available, otherwise add your connection code here)
$query = "SELECT difficulty_level, question, option1, option2, option3, option4, answer, film_ids, cast_ids 
          FROM quiz_questions 
          WHERE quiz_question_generator_id=11 
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
        echo "<td>" . $row['question'] . "</td>";
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
    echo "No quiz questions found for generator ID 11.";
}
?>



<br>
<h2 style="text-align: center;">Random 10 Questions</h2>
<br>

<?php
// Connect to the database (assume $conn is already available, otherwise add your connection code here)
$query = "SELECT difficulty_level, question, option1, option2, option3, option4, answer, film_ids, cast_ids 
          FROM quiz_questions 
          WHERE quiz_question_generator_id=11 order by rand()
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
        echo "<td>" . $row['question']. "</td>";
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
    echo "No quiz questions found for generator ID 11.";
}
?>




