<?php
// track_visit.php — include after session_start() and DB connection ($con)

// Make sure session is active
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Require DB connection $con (mysqli). If not set, stop tracking
if (!isset($con) || !($con instanceof mysqli)) {
    return;
}

// Only track if logged-in user
if (empty($_SESSION['id'])) {
    return;
}

$userId     = (int) $_SESSION['id'];
$pageUrl    = $_SERVER['REQUEST_URI'] ?? '';
$requestUri = strtolower(parse_url($pageUrl, PHP_URL_PATH));
$now        = date('Y-m-d H:i:s');
$userAgent  = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 1000);
$ip         = $_SERVER['REMOTE_ADDR'] ?? '';

// 1️⃣ Skip static files
$skipExtensions = [
    '.jpg', '.jpeg', '.png', '.gif', '.svg',
    '.css', '.js', '.ico', '.woff', '.woff2', '.ttf', '.eot', '.map', '.webp'
];
foreach ($skipExtensions as $ext) {
    if (substr($requestUri, -strlen($ext)) === $ext) {
        return; // don't track
    }
}

// 2️⃣ Skip specific API endpoints
$skipPatterns = [
    'fab-review-counts.php', // example JSON endpoint
    'datatable/',  
    'backend-search.php',
    'admin/photo/'         // DataTables AJAX
];
foreach ($skipPatterns as $pattern) {
    if (strpos($requestUri, $pattern) !== false) {
        return; // don't track
    }
}

// 3️⃣ Prevent duplicates within 10 seconds
if (!isset($_SESSION['last_visit_time'])) {
    $_SESSION['last_visit_time'] = [];
}
if (!isset($_SESSION['last_visit_time'][$pageUrl])) {
    $_SESSION['last_visit_time'][$pageUrl] = 0;
}
if (time() - $_SESSION['last_visit_time'][$pageUrl] < 10) {
    return; // visited same page in <10s, skip
}
$_SESSION['last_visit_time'][$pageUrl] = time();

// 4️⃣ Initialize buffers
if (!isset($_SESSION['visit_buffer'])) {
    $_SESSION['visit_buffer'] = []; // to write to DB later
}
if (!isset($_SESSION['visited_pages'])) {
    $_SESSION['visited_pages'] = []; // optional, for session-only history
}

// Store in visited_pages list (optional)
$_SESSION['visited_pages'][] = $pageUrl;

// Add to buffer
$_SESSION['visit_buffer'][] = [
    'user_id'    => $userId,
    'page_url'   => $pageUrl,
    'visit_time' => $now,
    'user_agent' => $userAgent,
    'ip_address' => $ip
];

// 5️⃣ Flush to DB when buffer reaches limit
$BUFFER_LIMIT = 10;

$flushVisits = function() use (&$con) {
    if (empty($_SESSION['visit_buffer'])) {
        return;
    }
    $buffer = $_SESSION['visit_buffer'];

    $con->begin_transaction();
    $stmt = $con->prepare(
        "INSERT INTO user_page_visits (user_id, page_url, visit_time, user_agent, ip_address) VALUES (?, ?, ?, ?, ?)"
    );
    if (!$stmt) {
        $con->rollback();
        return;
    }
    foreach ($buffer as $row) {
        $stmt->bind_param(
            'issss',
            $row['user_id'],
            $row['page_url'],
            $row['visit_time'],
            $row['user_agent'],
            $row['ip_address']
        );
        $stmt->execute();
    }
    $stmt->close();
    $con->commit();

    $_SESSION['visit_buffer'] = [];
};

if (count($_SESSION['visit_buffer']) >= $BUFFER_LIMIT) {
    $flushVisits();
}

// 6️⃣ Always flush at the end of script
register_shutdown_function(function() use ($flushVisits) {
    try {
        $flushVisits();
    } catch (Throwable $e) {
        // optional: error_log($e->getMessage());
    }
});
