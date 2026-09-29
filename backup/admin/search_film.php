<?php
include('config.php');

if (isset($_POST['search'])) {

    $q = $_POST['search'];
    $search = "%" . $q . "%";

    // JOIN dubbing table to get language name
    $stmt = $con->prepare("
    SELECT 
        film.id, 
        film.name, 
        film.season, 
        film.year_release, 
        dubbing.name AS language_name
    FROM film
    LEFT JOIN dubbing 
        ON dubbing.id = COALESCE(NULLIF(film.main_lang, ''), film.dubbing)
    WHERE film.name LIKE ?
    ORDER BY film.id
    LIMIT 60
");

    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {

        $id = $row['id'];
        $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
        $season = htmlspecialchars($row['season'], ENT_QUOTES, 'UTF-8');
        $year_release = htmlspecialchars($row['year_release'], ENT_QUOTES, 'UTF-8');
        $language = htmlspecialchars($row['language_name'], ENT_QUOTES, 'UTF-8');

        // Highlight search term safely
        $safe_q = htmlspecialchars($q, ENT_QUOTES, 'UTF-8');
        $b_name = '<strong>' . $safe_q . '</strong>';
        $final_name = str_ireplace($safe_q, $b_name, $name);
        ?>
        
        <div class="show" align="left">
            
            <span class="name">
                <a href="edit_film_basic_details.php?id=<?php echo $id; ?>" style="color:#111111">
                    <?php echo $final_name; ?>
                </a>
            </span>

            <?php if (!empty($season)) { ?>
                <span style="color:#666;"> (Season: <?php echo $season; ?>)</span>
            <?php } ?>

            <?php if (!empty($year_release)) { ?>
                <span style="color:#666;"> | Year: <?php echo $year_release; ?></span>
            <?php } ?>

            <?php if (!empty($language)) { ?>
                <span style="color:#666;"> | Language: <?php echo $language; ?></span>
            <?php } ?>

            <br/>

            <a href="edit_film_basic_details.php?id=<?php echo $id; ?>" style="color:#0044de">Edit</a>, 
            <a href="delete_film_basic_detail.php?delete=<?php echo $id; ?>" style="color:#F00">Delete</a>

            <br/>
        </div>

        <?php
    }

    $stmt->close();
}
?>
