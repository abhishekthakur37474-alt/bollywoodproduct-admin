<?php
include("config.php");

$data = [];

$sql = mysqli_query(
    $con,
    "SELECT id, name
     FROM music_arranged
     ORDER BY name ASC"
);

while ($row = mysqli_fetch_assoc($sql)) {

    $data[] = [
        'id'   => $row['id'],
        'name' => $row['name']
    ];

}

header('Content-Type: application/json; charset=utf-8');

echo json_encode($data);
?>