<?php
include("config.php");

$data = [];

$sql = mysqli_query(
    $con,
    "SELECT id, music_label
     FROM music_label
     ORDER BY id DESC"
);

while ($row = mysqli_fetch_assoc($sql)) {

    $data[] = [
        'id'         => $row['id'],
        'music_label' => $row['music_label']
    ];

}

header('Content-Type: application/json; charset=utf-8');

echo json_encode($data);
?>