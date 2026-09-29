<?php
require '../config.php'; // or wherever your DB connect file is

$term = mysqli_real_escape_string($con, $_GET['q']);

$query = "SELECT id, name, main_lang,year_release FROM film WHERE name LIKE '%$term%' ORDER BY name LIMIT 20";
$result = mysqli_query($con, $query);



$data = [];
while ($row = mysqli_fetch_assoc($result)) {
        $main_lang=explode(",",$row['main_lang']);
$main_language="";
foreach ($main_lang as $x) {
  $sqlld=mysqli_query($con, "select * from dubbing where id='$x'");
  $rowld=mysqli_fetch_array($sqlld);
  $main_language=$main_language.", ".$rowld['name'];
  //$main_language=$main_language.", ".$x;

}
 
$main_language=   substr($main_language, 2);
    $data[] = [
        "id" => $row['id'],
        "text" => $row['name']."-".$row['year_release']."-".$main_language
    ];
}

echo json_encode($data);
?>