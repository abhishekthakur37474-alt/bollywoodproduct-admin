<?php
include("config.php");

$data = [];

$sql = mysqli_query(
    $con,
    "SELECT id, name
     FROM lyricist
     ORDER BY id DESC"
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