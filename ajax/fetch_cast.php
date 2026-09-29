<?php
require '../config.php'; // or wherever your DB connect file is

$term = mysqli_real_escape_string($con, $_GET['q']);

$query = "SELECT id, name FROM cast WHERE name LIKE '%$term%' ORDER BY name LIMIT 20";
$result = mysqli_query($con, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        "id" => $row['id'],
        "text" => $row['name']
    ];
}

echo json_encode($data);
?>
