<?php 
  function sanitize($string, $force_lowercase = true, $anal = false) {
    $string = (string) $string; // Ensure it's a string

    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                    "â€”", "â€“", ",", "<", ".", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;
    return ($force_lowercase) ?
        (function_exists('mb_strtolower') ? mb_strtolower($clean, 'UTF-8') : strtolower($clean)) :
        $clean;
}

// pagination_helper.php
function paginateData($con, $table, $columns = '*', $where = [], $orderBy = '', $limit = 10, $page = 1) {
    $offset = ($page - 1) * $limit;
    $whereClause = '';
    $params = [];

    // Build WHERE clause
    if (!empty($where)) {
        $whereParts = [];
        foreach ($where as $key => $val) {
            $whereParts[] = "$key = '" . mysqli_real_escape_string($con, $val) . "'";
        }
        $whereClause = 'WHERE ' . implode(' AND ', $whereParts);
    }

    // Count total records
    $count_sql = "SELECT COUNT(*) AS total FROM $table $whereClause";
    $count_result = mysqli_query($con, $count_sql);
    $count_data = mysqli_fetch_assoc($count_result);
    $total_records = $count_data['total'];
    $total_pages = ceil($total_records / $limit);

    // Fetch records
    $orderSql = $orderBy ? "ORDER BY $orderBy" : '';
    $sql = "SELECT $columns FROM $table $whereClause $orderSql LIMIT $offset, $limit";
    $result = mysqli_query($con, $sql);

    return [
        'result' => $result,
        'total_pages' => $total_pages,
        'current_page' => $page,
        'total_records' => $total_records
    ];
}


// Function to fetch a single row by table and id
function getRowById($con, $table, $id) {
    $id = (int) $id;
    $result = mysqli_query($con, "SELECT * FROM `$table` WHERE id = $id");
    if (!$result) {
        die("Error fetching from $table: " . mysqli_error($con));
    }
    return mysqli_fetch_assoc($result);
}

function getAllRows($con, $table) {
    $result = mysqli_query($con, "SELECT * FROM `$table`");
    if (!$result) {
        die("Error fetching from $table: " . mysqli_error($con));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function getSelectedColumnsById($con, $table, $columns, $id) {
    $id = (int) $id;
    $cols = implode(',', array_map('mysqli_real_escape_string', array_fill(0, count($columns), $con), $columns));
    $result = mysqli_query($con, "SELECT $cols FROM `$table` WHERE id = $id");

    if (!$result) {
        die("Error fetching selected columns from $table: " . mysqli_error($con));
    }

    return mysqli_fetch_assoc($result);
}

function getAllRowsWithSelectedColumns($con, $table, $columns) {
    $cols = implode(',', array_map('mysqli_real_escape_string', array_fill(0, count($columns), $con), $columns));
    $result = mysqli_query($con, "SELECT $cols FROM `$table`");

    if (!$result) {
        die("Error fetching selected columns from $table: " . mysqli_error($con));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}








function getRowsWhereMulti($con, $table, $conditions = []) {
    $table = mysqli_real_escape_string($con, $table);
    
    $whereClauses = [];
    foreach ($conditions as $column => $value) {
        $columnEscaped = mysqli_real_escape_string($con, $column);
        $valueEscaped = mysqli_real_escape_string($con, $value);
        $whereClauses[] = "`$columnEscaped` = '$valueEscaped'";
    }

    $whereSql = '';
    if (!empty($whereClauses)) {
        $whereSql = 'WHERE ' . implode(' AND ', $whereClauses);
    }

    $query = "SELECT * FROM `$table` $whereSql";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error fetching from $table: " . mysqli_error($con));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}



function getRowsWhereMultiSelect($con, $table, $columns = ['*'], $conditions = []) {
    // Escape table name
    $table = mysqli_real_escape_string($con, $table);

    // Escape and format columns
    $columnsEscaped = array_map(function($col) use ($con) {
        return '`' . mysqli_real_escape_string($con, $col) . '`';
    }, $columns);
    $columnSql = implode(', ', $columnsEscaped);

    // Build WHERE clause
    $whereClauses = [];
    foreach ($conditions as $column => $value) {
        $columnEscaped = mysqli_real_escape_string($con, $column);
        $valueEscaped = mysqli_real_escape_string($con, $value);
        $whereClauses[] = "`$columnEscaped` = '$valueEscaped'";
    }

    $whereSql = '';
    if (!empty($whereClauses)) {
        $whereSql = 'WHERE ' . implode(' AND ', $whereClauses);
    }

    // Final query
    $query = "SELECT $columnSql FROM `$table` $whereSql";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error fetching from $table: " . mysqli_error($con));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}



function getRowsWhereInSet($con, $table, $column, $value) {
    $tableEscaped = mysqli_real_escape_string($con, $table);
    $columnEscaped = mysqli_real_escape_string($con, $column);
    $valueEscaped = mysqli_real_escape_string($con, $value);

    $query = "SELECT * FROM `$tableEscaped` WHERE FIND_IN_SET('$valueEscaped', `$columnEscaped`)";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error fetching from $table: " . mysqli_error($con));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function uploadFile($input_name, $alias = '', $type = 'image', $upload_dir = "../uploads/") {
    // Check if file is uploaded
    if (!isset($_FILES[$input_name]) || $_FILES[$input_name]['error'] !== 0) {
        return ['skip' => true]; // No file uploaded (use old file in update)
    }

    // MIME type validation
    $image_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $file_types = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation'
    ];

    $file_type = mime_content_type($_FILES[$input_name]['tmp_name']);

    if (
        ($type === 'image' && !in_array($file_type, $image_types)) ||
        ($type === 'file' && !in_array($file_type, $file_types)) ||
        ($type === 'both' && !in_array($file_type, array_merge($image_types, $file_types)))
    ) {
        return ['error' => "Invalid file type for $input_name. Only " . strtoupper($type) . " files are allowed."];
    }

    // Get original extension and sanitized alias
    $ext = pathinfo($_FILES[$input_name]['name'], PATHINFO_EXTENSION);
    $raw_alias = $alias !== '' ? $alias : pathinfo($_FILES[$input_name]['name'], PATHINFO_FILENAME);
    $sanitized_alias = sanitize($raw_alias); // Using your sanitize() function

    // Create unique filename
    $filename = strtolower($input_name) . '_' . $sanitized_alias . '_' . time() . '_' . uniqid() . '.' . $ext;
    $target_file = $upload_dir . $filename;

    // Attempt to move uploaded file
    if (!move_uploaded_file($_FILES[$input_name]['tmp_name'], $target_file)) {
        return ['error' => "Failed to upload file for $input_name."];
    }

    return ['filename' => $filename];
}

?>