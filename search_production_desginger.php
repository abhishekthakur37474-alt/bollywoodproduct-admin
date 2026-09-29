<?php
include('config.php');

if(isset($_POST['search'])) {

    $q = trim($_POST['search']);

    if($q == ''){
        exit;
    }

    $q = mysqli_real_escape_string($con, $q);

    $sql = mysqli_query($con,"
        SELECT id,name,profile_unique_id
        FROM production_designer
        WHERE name LIKE '%$q%'
        ORDER BY id DESC
        LIMIT 30
    ");

    if(mysqli_num_rows($sql)==0){
        echo "<div class='show'>No results found</div>";
        exit;
    }

    while($row=mysqli_fetch_assoc($sql)) {

        $id = $row['id'];
        $name = $row['name'];
        $profile_unique_id = $row['profile_unique_id'];

        // Same as producer code
        $display_text = "ID: ".$id." - ".$name;

        // Highlight search text
        $final_name = str_ireplace(
            $q,
            '<strong>'.$q.'</strong>',
            $display_text
        );
?>

<div class="show" style="padding:8px;border-bottom:1px solid #ddd;">

<a href="crew-details-edit.php?Action=Update&id=<?php echo $id; ?>&profile=production_designer&profile_unique_id=<?php echo $profile_unique_id; ?>"
style="color:#111;text-decoration:none;">

<?php echo $final_name; ?>

</a>

<br/>

<a href="crew-details-edit.php?Action=Update&id=<?php echo $id; ?>&profile=production_designer&profile_unique_id=<?php echo $profile_unique_id; ?>"
style="color:#0044de;">
Edit
</a>

|

<a href="javascript:resume_id('<?php echo $id; ?>')" style="color:#F00;">
Delete
</a>

</div>

<?php
    }
}
?>