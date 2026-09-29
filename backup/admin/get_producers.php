<?php
include "config.php";

$search = $_GET['query'] ?? '';
$limit = 20; 
$query = "SELECT id, name, nickname FROM producer WHERE name LIKE '%$search%' ORDER BY name LIMIT $limit";
$result = mysqli_query($con, $query);

$producers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $producers[] = $row;
}

echo json_encode($producers);
?>