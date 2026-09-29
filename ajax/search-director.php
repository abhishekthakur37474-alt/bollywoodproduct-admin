<?php
include('../../config.php');

header('Content-Type: application/json');

$search = $_POST['search'] ?? '';

if (strlen($search) < 2) {
    echo json_encode([]);
    exit;
}

/* ✅ Prepared statement (fast + safe) */
$stmt = $con->prepare("
    SELECT id, name, nickname
    FROM director
    WHERE name LIKE CONCAT('%', ?, '%')
    ORDER BY name ASC
    LIMIT 20
");

$stmt->bind_param("s", $search);
$stmt->execute();

$result = $stmt->get_result();

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        "id" => $row['id'],
        "text" => $row['name'] . " (Nick: " . $row['nickname'] . " ID:" . $row['id'] . ")"
    ];
}

echo json_encode($data);