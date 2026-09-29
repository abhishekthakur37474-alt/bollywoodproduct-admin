<?php
include('config.php');

// Make sure row_index is set, even if it's 0
if (!isset($_POST['row_index'])) {
    die("Row index not sent");
}

$film_id = $_POST['film_id'];
$row_id = $_POST['edit_id'];
$row_index = intval($_POST['row_index']); // this will be 0 if "0" is passed

// Fetch current data
$q = mysqli_query($con, "SELECT * FROM film_box_office_management WHERE film_id='$film_id' LIMIT 1");
$read = mysqli_fetch_array($q);

$fields = ['day_number', 'country', 'currency_code', 'currency_format', 'language', 'nett', 'gross', 'overseas'];
$updated_values = [];

foreach ($fields as $field) {
    $items = explode(',', $read[$field]);

    if (array_key_exists($row_index, $items)) {
        unset($items[$row_index]);
        $items = array_values($items); // reindex
        $updated_values[$field] = implode(',', $items);
    } else {
        $updated_values[$field] = $read[$field]; // no change
    }
}

// Update the row
$update_sql = "
    UPDATE film_box_office_management SET
        day_number = '{$updated_values['day_number']}',
        country = '{$updated_values['country']}',
        currency_code = '{$updated_values['currency_code']}',
        currency_format = '{$updated_values['currency_format']}',
        language = '{$updated_values['language']}',
        nett = '{$updated_values['nett']}',
        gross = '{$updated_values['gross']}',
        overseas = '{$updated_values['overseas']}'
    WHERE film_id = '$film_id'
";

if (mysqli_query($con, $update_sql)) {
    header("Location: edit_film_box_office_details.php?id=$row_id");
    exit;
} else {
    echo "Error updating record: " . mysqli_error($con);
}
?>
