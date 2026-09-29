<?php
include('config.php');

if(isset($_POST['search'])) {

    $q = trim($_POST['search']);

    if($q == '' || strlen($q) < 2){
        exit;
    }

    $like_full   = "%$q%";
    $like_start  = "$q%";
    $like_space  = "% $q%";

    $stmt = $con->prepare("
        SELECT 
            id, 
            name, 
            profile_unique_id, 
            nickname
        FROM cast 
        WHERE name LIKE ? 
           OR nickname LIKE ?
        ORDER BY 
            CASE 
                WHEN name = ? THEN 1
                WHEN name LIKE ? THEN 2
                WHEN nickname LIKE ? THEN 3
                WHEN name LIKE ? THEN 4
                ELSE 5
            END,
            name ASC
        LIMIT 50
    ");

    $stmt->bind_param(
        "ssssss",
        $like_full,
        $like_full,
        $q,
        $like_start,
        $like_start,
        $like_space
    );

    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0){
        echo "<div class='show'>No results found</div>";
        exit;
    }

    while($row = $result->fetch_assoc()) {

        $id = $row['id'];
        $name = $row['name'];
        $nick_name = $row['nickname'];
        $profile_unique_id = $row['profile_unique_id'];

        // 🔹 Producer-style display
        $display_text = "ID: ".$id." - ".$name;

        if(!empty($nick_name)){
            $display_text .= " (".$nick_name.")";
        }

        // 🔹 Safe output
        $safe_text = htmlspecialchars($display_text, ENT_QUOTES, 'UTF-8');
        $safe_q = htmlspecialchars($q, ENT_QUOTES, 'UTF-8');

        // 🔥 Highlight
        $final_name = str_ireplace(
            $safe_q,
            '<strong>'.$safe_q.'</strong>',
            $safe_text
        );
        ?>

        <div class="show" style="padding:8px;border-bottom:1px solid #ddd;">

            <a href="crew-details-edit.php?Action=Update&id=<?php echo $id; ?>&profile=cast&profile_unique_id=<?php echo $profile_unique_id; ?>"  
               style="color:#111;text-decoration:none;">

               <?php echo $final_name; ?>

            </a>

            <br/>

            <a href="crew-details-edit.php?Action=Update&id=<?php echo $id; ?>&profile=cast&profile_unique_id=<?php echo $profile_unique_id; ?>" 
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

    $stmt->close();
}
?>