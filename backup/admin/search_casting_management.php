<?php
include('config.php');

if(isset($_POST['search'])) {

    $q = trim($_POST['search']);

    if($q == ''){
        exit;
    }

    // 🔹 Basic security
    $q = mysqli_real_escape_string($con, $q);

    // 🔹 Optimized JOIN query
    $sql = mysqli_query($con, "
        SELECT f.name, fcm.id
        FROM film f
        INNER JOIN film_casting_management_allot fcm 
            ON f.id = fcm.film_id
        WHERE f.name LIKE '%$q%'
        ORDER BY fcm.id DESC
        LIMIT 5
    ") or die(mysqli_error($con));

    // 🔹 No result
    if(mysqli_num_rows($sql) == 0){
        echo "<div class='show'>No results found</div>";
        exit;
    }

    while($row = mysqli_fetch_assoc($sql)) {

        $id = $row['id'];
        $name = $row['name'];

        // 🔹 Highlight search text
        $final_name = str_ireplace(
            $q,
            '<strong>'.$q.'</strong>',
            $name
        );
        ?>

        <div class="show" align="left" style="padding:8px; border-bottom:1px solid #eee;">
            
            <!-- 🔹 Film Name -->
            <span class="name">
                <a href="edit_film_casting.php?id=<?php echo $id; ?>" 
                   style="color:#111111; text-decoration:none;">
                   
                   <?php echo $final_name; ?>
                </a>
            </span>

            <br/>

            <!-- 🔹 Actions -->
            <a href="edit_film_casting.php?id=<?php echo $id; ?>" style="color:#0044de;">
                Edit
            </a> 

            | 

            <a href="delete_film_casting.php?delete=<?php echo $id; ?>" style="color:#F00;">
                Delete
            </a>

        </div>

        <?php
    }
}
?>