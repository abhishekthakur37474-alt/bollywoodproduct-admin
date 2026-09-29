<?php
include "config.php";

if (!empty($_POST["father_name_choice"])) {
    $table_name = $_POST['father_name_choice'];
   echo  $query = "select * from $table_name";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        ?>
         <script>
        
         document.getElementById("father_name_select_text").style.display="none";
          document.getElementById("father_name_select").style.display="block";
          document.getElementById("father_name_select_text").removeAttribute("name"); 
         
         </script>


         <?
        echo "<option value=''>-Select From $table_name-</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $name=$row['name'];
            $id=$row['id'];
            $nickname=$row['nickname'];
            $value=$name."( Nick Name:$nickname ,ID: $id)";
            echo '<option value="' . $row['id'] . '">' .$value .'</option>';
        }
    }
    else
    {
        echo '<option value="">-No Data Found-</option>';
    }
} 

