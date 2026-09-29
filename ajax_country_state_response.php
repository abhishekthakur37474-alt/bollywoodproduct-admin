<?php
include "config.php";
if (!empty($_POST["id"])) {
    $id = $_POST['id'];
    $query = "select * from state1 where country_id='$id'";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        echo '<option value="">-Select State Now-</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['id'] . '">' . $row['state'] . '</option>';
        }
    }
    else
    {
        echo '<option value="">-No State Available-</option>';
    }
} 