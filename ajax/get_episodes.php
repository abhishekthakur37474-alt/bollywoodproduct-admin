<?php
include "../config.php";
$season_id = intval($_GET['season_id']);
$result = mysqli_query($con, "SELECT * FROM tv_episodes WHERE tv_season_id = $season_id ORDER BY episode_no");

echo '<option value="">Select Episode</option>';
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='{$row['id']}'>Episode {$row['episode_no']} - {$row['name']}</option>";
}
?>
