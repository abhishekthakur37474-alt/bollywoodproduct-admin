<?php
include "config.php";


if (!empty($_POST["nominee_name_choice"])) {
    $table_name = $_POST['nominee_name_choice'];
     $query = "select * from $table_name order by name";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        ?>
         <script>
        
         document.getElementById("nominee_name_select_text").style.display="none";
          document.getElementById("nominee_name_select").style.display="block";
          document.getElementById("nominee_name_select_text").removeAttribute("name"); 
         
         </script>


         <?
        echo "<option value=''>-Select Nominee Name From $table_name-</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $print="(ID:".$row['id']." "."Nick Name:".$row['nickname'].")";
            echo '<option value="' . $row['name'] . '">' . $row['name'] .$print.'</option>';
        }
    }
    else
    {
        echo '<option value="">-No Data Found-</option>';
    }
} 





if (!empty($_POST["professionSelect"])) {

    $table_name = mysqli_real_escape_string($con, $_POST["professionSelect"]);

    $query = "SELECT * FROM `$table_name`";

    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {

        echo "<option value=''>-Select Name-</option>";

        while ($row = mysqli_fetch_assoc($result)) {

            echo '<option value="'.$row['name'].'">'.
                 $row['name'].
                 ' (ID:'.$row['id'].' Nick Name:'.$row['nickname'].')'.
                 '</option>';
        }

    } else {

        echo '<option value="">-No Data Found-</option>';
    }
}


if (!empty($_POST["spouse_name_choice"])) {
    $table_name = $_POST['spouse_name_choice'];
     $query = "select * from $table_name";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        ?>
        <!-- <script>
        
         document.getElementById("spouse_name_select_text").style.display="none";
          document.getElementById("spouse_name_select").style.display="block";
          document.getElementById("spouse_name_select_text").removeAttribute("name"); 
         
         </script>
         -->


         <?
        echo "<option value=''>-Select spouse Name From $table_name-</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $print="(ID:".$row['id']." "."Nick Name:".$row['nickname'].")";
            echo '<option value="' . $row['name'] . '">' . $row['name'] .$print.'</option>';
        }
    }
    else
    {
        echo '<option value="">-No Data Found-</option>';
    }
} 




if (!empty($_POST["son_name_choice"])) {
    $table_name = $_POST['son_name_choice'];
     $query = "select * from $table_name";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        ?>
       <!--  <script>
        
         document.getElementById("son_name_select_text").style.display="none";
          document.getElementById("son_name_select").style.display="block";
          document.getElementById("son_name_select_text").removeAttribute("name"); 
         
         </script>
-->

         <?
        echo "<option value=''>-Select son Name From $table_name-</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $print="(ID:".$row['id']." "."Nick Name:".$row['nickname'].")";
            echo '<option value="' . $row['name'] . '">' . $row['name'] .$print.'</option>';
        }
    }
    else
    {
        echo '<option value="">-No Data Found-</option>';
    }
} 



if (!empty($_POST["daughter_name_choice"])) {
    $table_name = $_POST['daughter_name_choice'];
     $query = "select * from $table_name";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        ?>
      <!--   <script>
        
         document.getElementById("daughter_name_select_text").style.display="none";
          document.getElementById("daughter_name_select").style.display="block";
          document.getElementById("daughter_name_select_text").removeAttribute("name"); 
         
         </script>
-->

         <?
        echo "<option value=''>-Select daughter Name From $table_name-</option>";
        while ($row = mysqli_fetch_assoc($result)) {
             $print="(ID:".$row['id']." "."Nick Name:".$row['nickname'].")";
            echo '<option value="' . $row['name'] . '">' . $row['name'] .$print.'</option>';
        }
    }
    else
    {
        echo '<option value="">-No Data Found-</option>';
    }
} 



if (!empty($_POST["brother_name_choice"])) {
    $table_name = $_POST['brother_name_choice'];
     $query = "select * from $table_name";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        ?>
    <!--     <script>
        
         document.getElementById("brother_name_select_text").style.display="none";
          document.getElementById("brother_name_select").style.display="block";
          document.getElementById("brother_name_select_text").removeAttribute("name"); 
         
         </script>
-->

         <?
        echo "<option value=''>-Select brother Name From $table_name-</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $print="(ID:".$row['id']." "."Nick Name:".$row['nickname'].")";
            echo '<option value="' . $row['name'] . '">' . $row['name'] .$print.'</option>';
        }
    }
    else
    {
        echo '<option value="">-No Data Found-</option>';
    }
} 




if (!empty($_POST["sister_name_choice"])) {
    $table_name = $_POST['sister_name_choice'];
     $query = "select * from $table_name";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        ?>
       <!--  <script>
        
         document.getElementById("sister_name_select_text").style.display="none";
          document.getElementById("sister_name_select").style.display="block";
          document.getElementById("sister_name_select_text").removeAttribute("name"); 
         
         </script>
-->

         <?
        echo "<option value=''>-Select sister Name From $table_name-</option>";
        while ($row = mysqli_fetch_assoc($result)) {
           $print="(ID:".$row['id']." "."Nick Name:".$row['nickname'].")";
            echo '<option value="' . $row['name'] . '">' . $row['name'] .$print.'</option>';
        }
    }
    else
    {
        echo '<option value="">-No Data Found-</option>';
    }
} 