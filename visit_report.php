<?php
session_start();
include 'config.php'; // must have $con (mysqli connection)

// Validate and sanitize GET param
if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    die("Invalid or missing user_id.");
}
$user_id = (int) $_GET['user_id'];

// Query visits for this user
$sql = "SELECT page_url, visit_time, user_agent, ip_address
        FROM user_page_visits
        WHERE user_id = $user_id
        ORDER BY visit_time DESC";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Page Visit Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h3>User Visit Report (User ID: <?php echo htmlspecialchars($user_id); ?>)</h3>

<?php if (mysqli_num_rows($result) > 0): ?>
<div class="table-responsive mt-3">
    <table class="table table-bordered table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Page URL</th>
                <th>Visit Time</th>
                <th>User Agent</th>
                <th>IP Address</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)):
            ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo htmlspecialchars($row['page_url']); ?></td>
                <td><?php echo htmlspecialchars($row['visit_time']); ?></td>
                <td><?php echo htmlspecialchars($row['user_agent']); ?></td>
                <td><?php echo htmlspecialchars($row['ip_address']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php else: ?>
<div class="alert alert-info mt-3">No visits recorded for this user.</div>
<?php endif; ?>

</body>
</html>
<?php
mysqli_free_result($result);
?>
