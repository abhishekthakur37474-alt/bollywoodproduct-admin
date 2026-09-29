<?php 
include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Assumes $con is the mysqli connection

// Fetch all rows from temp_quiz_cast_questions where option1, option2, option3 are NOT blank
$sql = "SELECT * FROM temp_quiz_cast_questions WHERE TRIM(option1) != '' AND TRIM(option2) != '' AND TRIM(option3) != ''";
$res = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $question = mysqli_real_escape_string($con, $row['question']);
    $option1 = trim($row['option1']);
    $option2 = trim($row['option2']);
    $option3 = trim($row['option3']);
    $answer = trim($row['answer']);

    // Prepare options array: answer, option1, option2, option3
    $options = [
        ['text' => $answer, 'is_answer' => true],
        ['text' => $option1, 'is_answer' => false],
        ['text' => $option2, 'is_answer' => false],
        ['text' => $option3, 'is_answer' => false]
    ];

    // Shuffle options
    shuffle($options);

    // Find the new answer index (1-based)
    $answer_index = 1;
    foreach ($options as $idx => $opt) {
        if ($opt['is_answer']) {
            $answer_index = $idx + 1;
            break;
        }
    }

    // Prepare option values for insert/update
    $opt1 = mysqli_real_escape_string($con, $options[0]['text']);
    $opt2 = mysqli_real_escape_string($con, $options[1]['text']);
    $opt3 = mysqli_real_escape_string($con, $options[2]['text']);
    $opt4 = mysqli_real_escape_string($con, $options[3]['text']);

    // Other fields from temp_quiz_cast_questions
    $film_id = intval($row['film_id']);
    $film_ids = $film_id > 0 ? strval($film_id) : '';
    $years = mysqli_real_escape_string($con, $row['year_release']);
    $cast_ids = ''; // You can fill this if you want, e.g. from $row['cast']
    $quiz_question_generator_id = 11;
    $quiz_category_id = 11;
    $difficulty_level = 1;
    $details = '';
    $song_ids = '';
    $singer_ids = '';
    $language_ids = '';
    $country_ids = '';
    $music_director_ids = '';
    $lyricist_ids = '';
    $director_ids = '';
    $producer_ids = '';
    $production_house_ids = '';
    $date_reg = date('Y-m-d H:i:s');

    // Insert into quiz_questions
    $insert_sql = "
        INSERT INTO quiz_questions
        (quiz_question_generator_id, quiz_category_id, difficulty_level, question, option1, option2, option3, option4, answer, details, film_ids, song_ids, singer_ids, cast_ids, language_ids, country_ids, years, music_director_ids, lyricist_ids, director_ids, producer_ids, production_house_ids, date_reg)
        VALUES
        ($quiz_question_generator_id, $quiz_category_id, $difficulty_level, '$question', '$opt1', '$opt2', '$opt3', '$opt4', $answer_index, '$details', '$film_ids', '$song_ids', '$singer_ids', '$cast_ids', '$language_ids', '$country_ids', '$years', '$music_director_ids', '$lyricist_ids', '$director_ids', '$producer_ids', '$production_house_ids', '$date_reg')
    ";
    mysqli_query($con, $insert_sql);
}
