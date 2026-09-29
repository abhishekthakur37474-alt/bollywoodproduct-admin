<?php
include('config.php');

if ($_POST) {

    $q = trim($_POST['search']);

    if (!empty($q)) {

        $search = mysqli_real_escape_string($con, $q);

        $sql = "
            SELECT 
                flc.id AS lead_cast_entry_id,

                f.id AS film_id,
                f.name AS film_name,
                f.year_release,
                f.season,

                c.id AS cast_id,
                c.name AS cast_name

            FROM film_lead_cast flc

            INNER JOIN film f 
                ON flc.film_id = f.id

            INNER JOIN `cast` c 
                ON flc.film_lead_cast_id = c.id

            WHERE f.name LIKE '%$search%'

            ORDER BY f.id DESC

            LIMIT 30
        ";

        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

                $lead_id = (int)$row['lead_cast_entry_id'];

                $film_id   = (int)$row['film_id'];
                $film_name = htmlspecialchars($row['film_name']);

                $year   = trim($row['year_release']);
                $season = trim($row['season']);

                $cast_id   = (int)$row['cast_id'];
                $cast_name = htmlspecialchars($row['cast_name']);

                // Film title format
                $film_title = $film_name;

                if (!empty($year)) {
                    $film_title .= ' (' . htmlspecialchars($year) . ')';
                }

                if (!empty($season)) {
                    $film_title .= ' Season ' . htmlspecialchars($season);
                }

                // Highlight search text
                $highlighted_name = preg_replace(
                    "/" . preg_quote($q, '/') . "/i",
                    "<strong>$0</strong>",
                    $film_title
                );

                echo '
                <div class="show" align="left">

                    <span class="name">

                        <a href="edit_film_lead_cast_details.php?id='.$lead_id.'" style="color:#111111">

                            ['.$film_id.'] '.$highlighted_name.'

                            (' .$cast_id. ' - '.$cast_name.')

                        </a>

                    </span>

                    <br/>

                    <a href="edit_film_lead_cast_details.php?id='.$lead_id.'" style="color:#0044de">
                        Edit
                    </a>

                    ,

                    <a 
                        href="delete_film_lead_cast_details.php?delete='.$lead_id.'" 
                        style="color:#F00"
                        onclick="return confirm(\'Are you sure?\')"
                    >
                        Delete
                    </a>

                    <br/>

                </div>';
            }

        } else {

            echo "<div style='color:red'>No results found.</div>";

        }
    }
}
?>