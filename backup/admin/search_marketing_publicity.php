<?php
include('config.php');

if(isset($_POST['search']))
{
    $q = trim($_POST['search']);

    if($q == ''){
        exit;
    }

    // 🔹 Secure input
    $q = mysqli_real_escape_string($con, $q);

    $sql_res = mysqli_query($con,"
        SELECT id, name, profile_unique_id  
        FROM marketing_publicity 
        WHERE name LIKE '%$q%'   
        ORDER BY id DESC 
        LIMIT 30
    ") or die(mysqli_error($con));

    if(mysqli_num_rows($sql_res) == 0){
        echo "<div class='show'>No results found</div>";
        exit;
    }

    while($row = mysqli_fetch_assoc($sql_res))
    {
        $id = $row['id'];
        $name = $row['name']; 
        $profile_unique_id = $row["profile_unique_id"];

        // 🔹 Add ID (same UI style)
        $name_with_id = $name . " - ID: " . $id;

        // 🔹 Highlight search
        $b_name = '<strong>'.$q.'</strong>'; 
        $final_name = str_ireplace($q, $b_name, $name_with_id); 
?>
<div class="show" align="left">
 <span class="name">
    <a href="crew-details-edit.php?Action=Update&id=<?php echo $id ;?>&profile=marketing_publicity&profile_unique_id=<?php echo $profile_unique_id ;?>"  style="color:#111111">
        <?php echo $final_name; ?>
    </a>
 </span>&nbsp;<br/>

 <a href="crew-details-edit.php?Action=Update&id=<?php echo $id ;?>&profile=marketing_publicity&profile_unique_id=<?php echo $profile_unique_id ;?>" style="color:#0044de">
    Edit
 </a>, 

 <a href="javascript:resume_id('<?php echo $id?>')"  style="color:#F00">
    Delete
 </a><br/>
</div>
<?php
    }
}
?>