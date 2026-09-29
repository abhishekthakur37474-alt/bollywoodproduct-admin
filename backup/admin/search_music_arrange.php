<?php
include('config.php');

if(isset($_POST['search'])) {

    $q = trim($_POST['search']);

    // 🔹 Stop empty input
    if($q == ''){
        exit;
    }

    // 🔹 Secure input
    $q = mysqli_real_escape_string($con, $q);

    $sql_res = mysqli_query($con, "
        SELECT id, name, profile_unique_id  
        FROM music_arranged 
        WHERE name LIKE '%$q%'  
        ORDER BY id DESC 
        LIMIT 30
    ") or die(mysqli_error($con));

    // 🔹 No results
    if(mysqli_num_rows($sql_res) == 0){
        echo "<div class='show'>No results found</div>";
        exit;
    }

    while($row = mysqli_fetch_assoc($sql_res)) {

        $id = $row['id'];
        $name = $row['name'];
        $profile_unique_id = $row['profile_unique_id'];

        // 🔹 Highlight search
        $final_name = str_ireplace(
            $q,
            '<strong>'.$q.'</strong>',
            $name
        );
        ?>

        <div class="show" align="left" style="padding:8px; border-bottom:1px solid #eee;">
            
            <span class="name">
                <a href="crew-details-edit.php?Action=Update&id=<?php echo $id; ?>&profile=music_arranged&profile_unique_id=<?php echo $profile_unique_id; ?>" 
                   style="color:#111111; text-decoration:none;">
                   
                   <!-- ✅ ID + Name -->
                   <?php echo "ID: ".$id." - ".$final_name; ?>
                </a>
            </span>

            <br/>

            <a href="crew-details-edit.php?Action=Update&id=<?php echo $id; ?>&profile=music_arranged&profile_unique_id=<?php echo $profile_unique_id; ?>" 
               style="color:#0044de;">
               Edit
            </a> 

            | 

            <a href="javascript:resume_id('<?php echo $id; ?>')" 
               style="color:#F00;">
               Delete
            </a>

        </div>

        <?php
    }
}
?>