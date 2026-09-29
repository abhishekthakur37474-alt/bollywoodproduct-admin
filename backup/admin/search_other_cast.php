<?php
include('config.php');

if ($_POST) {
    $q = trim(mysqli_real_escape_string($con, $_POST['search']));

    // Fetch films that match search term
    $sql_film = "
        SELECT id, name, year_release, main_lang 
        FROM film 
        WHERE name LIKE '%$q%' 
        ORDER BY id 
       
    ";
    $res_film = mysqli_query($con, $sql_film) or die(mysqli_error($con));

    if (mysqli_num_rows($res_film) > 0) {
        while ($film = mysqli_fetch_assoc($res_film)) {
            $film_id = $film['id'];
            $film_name = $film['name'];

            // Get film languages
            $main_lang_ids = explode(",", $film['main_lang']);
            $lang_names = [];
            foreach ($main_lang_ids as $lang_id) {
                $lang_id = trim($lang_id);
                if ($lang_id != '') {
                    $lang_query = mysqli_query($con, "SELECT name FROM dubbing WHERE id='$lang_id' LIMIT 1");
                    if ($lang_row = mysqli_fetch_assoc($lang_query)) {
                        $lang_names[] = $lang_row['name'];
                    }
                }
            }
            $main_language = implode(", ", $lang_names);

            // Get film cast
            $sql_cast = "
                SELECT fc.id AS fc_id, c.name AS cast_name
                FROM film_cast fc
                INNER JOIN `cast` c ON fc.cast_id = c.id
                WHERE fc.film_id = '$film_id'
                ORDER BY fc.id
            ";
            $res_cast = mysqli_query($con, $sql_cast) or die(mysqli_error($con));

            while ($cast = mysqli_fetch_assoc($res_cast)) {
                $fc_id = $cast['fc_id'];
                $cast_name = $cast['cast_name'];

                // Highlight match in film name
                $highlighted_name = preg_replace("/($q)/i", "<strong>$1</strong>", htmlspecialchars($film_name));

                echo '<div class="show" align="left">
                    <span class="name">
                        <a href="edit_film_other_cast_details.php?id=' . $fc_id . '" style="color:#111111">'
                            . $highlighted_name . ' - ' . htmlspecialchars($film['year_release']) . ' - ' . htmlspecialchars($main_language) .
                        '</a> <b>(' . htmlspecialchars($cast_name) . ')</b><br/>
                        <a href="edit_film_other_cast_details.php?id=' . $fc_id . '" style="color:#0044de">Edit</a>, 
                        <a href="delete_film_other_cast_details.php?delete=' . $fc_id . '" style="color:#F00">Delete</a>
                    </span>
                </div>';
            }
        }
    } else {
        echo "<div style='color:red'>No results found.</div>";
    }
}
?>
