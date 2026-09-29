<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $q = $_POST['search'];
    $searchTerm = '%' . $q . '%';

    $stmt = $con->prepare("
        SELECT frm.id, frm.name, f.year_release
        FROM film_rating_management AS frm
        JOIN film AS f ON frm.film_id = f.id
        WHERE frm.name LIKE ?
        ORDER BY frm.id
        LIMIT 30
    ");

    if ($stmt) {
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $year = $row['year_release'];

            // Highlight search text in bold
            $highlighted = '<strong>' . htmlspecialchars($q, ENT_QUOTES) . '</strong>';
            $final_name = str_ireplace($q, $highlighted, htmlspecialchars($name, ENT_QUOTES));
?>
<div class="show" align="left">
    <span class="name">
        <a href="edit_film_rating_details.php?id=<?php echo $id; ?>" style="color:#111111">
            <?php echo $final_name; ?> (<?php echo $year; ?>)
        </a>
    </span><br/>
    <a href="edit_film_rating_details.php?id=<?php echo $id; ?>" style="color:#0044de">Edit</a>,
    <a href="delete_film_rating_management.php?delete=<?php echo $id; ?>" style="color:#F00">Delete</a><br/>
</div>
<?php
        }
        $stmt->close();
    } else {
        echo "Query error: " . $con->error;
    }
}
?>
