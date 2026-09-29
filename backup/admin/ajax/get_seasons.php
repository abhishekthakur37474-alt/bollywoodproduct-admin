<?php
include "../config.php"; // or your config file
$series_id = intval($_GET['series_id']);
$result = mysqli_query($con, "SELECT * FROM tv_seasons WHERE tv_series_id = $series_id ORDER BY name");

echo '<option value="">Select Season</option>';
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='{$row['id']}'>Season {$row['season_no']} - {$row['name']}</option>";
}
?>
