<?php
include('config.php');

if ($_POST && !empty($_POST['search'])) {
    $q = trim($_POST['search']);

    // Fetch currency records where country ID matches search in country name
    $sql_res = mysqli_query($con, "
        SELECT cm.id, cm.country, c1.country_name 
        FROM currency_master cm 
        LEFT JOIN country1 c1 ON cm.country = c1.id 
        WHERE c1.country_name LIKE '%$q%' 
        ORDER BY cm.id 
        LIMIT 30
    ") or die(mysqli_error($con));

    while ($row = mysqli_fetch_array($sql_res)) {
        $id = $row['id'];
        $countryName = $row['country_name'];

        // Highlight matched part
        $b_name = '<strong>' . $q . '</strong>';
        $final_name = str_ireplace($q, $b_name, $countryName);
        ?>
        <div class="show" align="left">
            <span class="name">
                <a href="currency-master.php?Action=Update&id=<?= $id ?>" style="color:#111111">
                    <?= $final_name ?>
                </a>
            </span>
            <br/>
            <a href="currency-master.php?Action=Update&id=<?= $id ?>" style="color:#0044de">Edit</a>,
            <a href="javascript:resume_id('<?= $id ?>')" style="color:#F00">Delete</a>
            <br/>
        </div>
        <?php
    }
}
?>
