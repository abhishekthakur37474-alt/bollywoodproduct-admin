<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      } 
	   $id=$_GET["id"];
      $record="select * from film_directors_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
     $film_id=$read["film_id"];
	 $second_unit_director=$read["second_unit_director"];
	
	


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Film Directors Management</title>
      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <!-- Start Global Mandatory Style
         =====================================================================-->
      <!-- jquery-ui css -->
      <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <!-- Bootstrap -->
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <!-- Bootstrap rtl -->
      <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
      <!-- Lobipanel css -->
      <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
      <!-- Pace css -->
      <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
      <!-- Font Awesome -->
      <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <!-- Pe-icon -->
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <!-- Themify icons -->
      <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
      <!-- dataTables css -->
      <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
      <!-- End Global Mandatory Style
         =====================================================================-->
      <!-- Start Theme Layout Style
         =====================================================================-->
      <!-- Theme style -->
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
      <!-- Theme style rtl -->
      <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
      <!-- End Theme Layout Style
         =====================================================================-->

         <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({
  selector: 'textarea',
  height: 300,
  theme: 'modern',
  plugins: 'print preview fullpage   searchreplace autolink directionality   visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc   advlist lists textcolor wordcount     imagetools      contextmenu colorpicker textpattern help',
  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });</script>
   
   <script>
     function del()
     {
         var c=confirm('Are you sure delete this...?');
         if(c==true)
         {
             return true;
         }
         else{
             return false;
         }
     }
     
     </script>

   </head>
   <body class="hold-transition sidebar-mini">
   <!--preloader
      <div id="preloader">
         <div id="status"></div>
      </div>-->
      <!-- Site wrapper -->
      <div class="wrapper">
         <? include "topandleft.php"; ?>
         <!-- =============================================== -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-users"></i>
               </div>
               <div class="header-title">
                  <h1> Film Directors Management</h1>
                  <small> Film Directors List</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4> Film Directors Management List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="add_film_directors.php"> <i class="fa fa-plus"></i> Add Film Directos
                                 </a>  
                              </div>
                            
                           </div> 
                            <script type="text/javascript" src="jquery-1.8.0.min.js"></script>
                           <script type="text/javascript">
$(function(){
$(".search").keyup(function() 
{ 
var searchid = $(this).val();
var dataString = 'search='+ searchid;
if(searchid!='')
{
    $.ajax({
    type: "POST",
    url: "search_directors.php",
    data: dataString,
    cache: false,
    success: function(html)
    {
    $("#result").html(html).show();
    }
    });
}return false;    
});

jQuery("#result").live("click",function(e){ 
    var $clicked = $(e.target);
    var $name = $clicked.find('.name').html();
    var decoded = $("<div/>").html($name).text();
    $('#searchid').val(decoded);
});
jQuery(document).live("click", function(e) { 
    var $clicked = $(e.target);
    if (! $clicked.hasClass("search")){
    jQuery("#result").fadeOut(); 
    }
});
$('#searchid').click(function(){
    jQuery("#result").fadeIn();
});
});
</script>

<!-- <input type="text" class="search form-control" id="searchid" placeholder="Search for Film" style="width: 100%" />  
<div id="result"></div> -->


   <br/>

<select class="form-control select2" 
onchange="window.location.href=this.value;">

<option value="">Search Film</option>

<?php
$sql = mysqli_query($con, "
    SELECT 
        fda.id AS fda_id,
        f.name,
        f.year_release,
        f.main_lang,
        GROUP_CONCAT(d.name SEPARATOR ', ') AS languages
    FROM film_directors_allot fda
    JOIN film f ON f.id = fda.film_id
    LEFT JOIN dubbing d 
        ON FIND_IN_SET(d.id, f.main_lang)
    GROUP BY fda.id
    ORDER BY f.name ASC
");

while($row = mysqli_fetch_assoc($sql)) {
?>

<option value="edit_film_directors.php?id=<?php echo $row['fda_id']; ?>">
    <?php echo $row['name']; ?> - 
    <?php echo $row['year_release']; ?> - 
    <?php echo $row['languages']; ?>
</option>

<?php } ?>

</select><br>
 
                           
                           <br/>
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                    <th>S.N</th>
                                    <th>Film Name</th>
                                    <th>Directos</th>
                                     <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                    <? 


if (isset($_GET['page_no']) && $_GET['page_no']!="") {
  $page_no = $_GET['page_no'];
  } else {
    $page_no = 1;
        }

  $total_records_per_page = 10;
    $offset = ($page_no-1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2"; 

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `film_directors_allot`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `film_directors_allot` order by id desc LIMIT $offset, $total_records_per_page");


                                       $sn=1;
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           <td><?php echo $sn;?></td>
                                           <td>
										    <?php 
                                    
                                    $film_id=$row["film_id"];
										 $film_data_query="select * from film where id='$film_id'";
										 $film_data_exe=mysqli_query($con,$film_data_query);
										 $film_name_read=mysqli_fetch_array($film_data_exe);
                                     ?>
                                     <?php echo $film_name_read["name"];?>
                                    
										   </td>
                                      
                                       <td>
                                           <table class="table table-bordered table-striped table-hover">
                                               <tr>
                                               <th>Directors:</th>
                                               <td><?php
$film_director_id = explode(",", $row["director"]);

foreach ($film_director_id as $director_id) {
    $director_data_query = "select * from director where id='$director_id'";
    $director_data_exe = mysqli_query($con, $director_data_query);
  
        $director_name_read = mysqli_fetch_array($director_data_exe);
        echo $director_name_read["name"],"<br/>";
    }

?>
                                     </td>
									 
                                               </tr>
                                                <tr>
                                               <th>Direction Team:</th>
                                               <td><?php
$film_direction_team_id = explode(",", $row["direction_team"]);

foreach ($film_direction_team_id as $film_direction_team_id1) {
    $director_data_query = "select * from director where id='$film_direction_team_id1'";
    $director_data_exe = mysqli_query($con, $director_data_query);
  
        $director_name_read = mysqli_fetch_array($director_data_exe);
        echo $director_name_read["name"],"<br/>";
    }

?>
                                     </td>
									 
                                               </tr>
                                               <tr>
                                               <th>Co-Director:</th>
                                               <td>
											   <?php
$co_director = explode(",", $row["co_director"]);

foreach ($co_director as $co_director_id) {
    $co_director_data_query = "select * from director where id='$co_director_id'";
    $co_director_data_exe = mysqli_query($con, $co_director_data_query);
  
        $co_director_name_read = mysqli_fetch_array($co_director_data_exe);
        echo $co_director_name_read["name"],"<br/>";
    }

?>
											 </td>
                                               </tr>
                                               <tr>
                                               <th>Associate Director:</th>
                                               <td>
											   <?php
$associate_director = explode(",", $row["associate_director"]);

foreach ($associate_director as $associate_director_id) {
    $associate_director_data_query = "select * from director where id='$associate_director_id'";
    $associate_director_data_exe = mysqli_query($con, $associate_director_data_query);
  
        $associate_director_name_read = mysqli_fetch_array($associate_director_data_exe);
        echo $associate_director_name_read["name"],"<br/>";
    }

?>
											  </td>
                                               </tr>
                                               <tr>
                                               <th>Assistant Director:</th>
                                               <td>
											   <?php
$assistant_director = explode(",", $row["assistant_director"]);

foreach ($assistant_director as $assistant_director_id) {
    $assistant_director_data_query = "select * from director where id='$assistant_director_id'";
    $assistant_director_data_exe = mysqli_query($con, $assistant_director_data_query);
  
        $assistant_director_name_read = mysqli_fetch_array($assistant_director_data_exe);
        echo $assistant_director_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Additional Assistant Director:</th>
                                               <td>
											   <?php
$additional_assistant_director = explode(",", $row["additional_assistant_director"]);

foreach ($additional_assistant_director as $additional_assistant_director_id) {
    $additional_assistant_director_data_query = "select * from director where id='$additional_assistant_director_id'";
    $additional_assistant_director_data_exe = mysqli_query($con, $additional_assistant_director_data_query);
  
        $additional_assistant_director_name_read = mysqli_fetch_array($additional_assistant_director_data_exe);
        echo $additional_assistant_director_name_read["name"],"<br/>";
    }

     ?>
											  </td>
                                               </tr>
                                               <tr>
                                               <th>Creative Director:</th>
                                               <td>
											     <?php
$creative_director = explode(",", $row["creative_director"]);

foreach ($creative_director as $creative_director_id) {
    $creative_director_data_query = "select * from director where id='$creative_director_id'";
    $creative_director_data_exe = mysqli_query($con, $creative_director_data_query);
  
        $creative_director_name_read = mysqli_fetch_array($creative_director_data_exe);
        echo $creative_director_name_read["name"],"<br/>";
    }

?>
											   
											 </td>
                                               </tr>
<tr>
                                               <th>Technical Director:</th>
                                               <td>
<?php
$technical_director = explode(",", $row["technical_director"]);

foreach ($technical_director as $technical_director_id) {
    $technical_director_data_query = "select * from director where id='$technical_director_id'";
    $technical_director_data_exe = mysqli_query($con, $technical_director_data_query);
  
        $technical_director_name_read = mysqli_fetch_array($technical_director_data_exe);
        echo $technical_director_name_read["name"],"<br/>";
    }

?>
											  
											   </td>
                                               </tr>
 <tr>
                                               <th>Chief Associat Directors:</th>
                                               <td><?php
$chief_associate_director = explode(",", $row["chief_associate_director"]);

foreach ($chief_associate_director as $chief_associate_director_id) {
    $chief_associate_director_data_query = "select * from director where id='$chief_associate_director_id'";
    $chief_associate_director_data_exe = mysqli_query($con, $chief_associate_director_data_query);
  
        $chief_associate_director_name_read = mysqli_fetch_array($chief_associate_director_data_exe);
        echo $chief_associate_director_name_read["name"],"<br/>";
    }

?></td>
                                               </tr>
                                                <tr>
                                               <th>Chief Assistant Directors:</th>
                                               <td>
<?php
$chief_assistant_director = explode(",", $row["chief_assistant_director"]);

foreach ($chief_assistant_director as $chief_assistant_director_id) {
    $chief_assistant_director_data_query = "select * from director where id='$chief_assistant_director_id'";
    $chief_assistant_director_data_exe = mysqli_query($con, $chief_assistant_director_data_query);
  
        $chief_assistant_director_name_read = mysqli_fetch_array($chief_assistant_director_data_exe);
        echo $chief_assistant_director_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                                                              
                                                <tr>                                               <tr>
                                               <th>First Assistant Director:</th>
                                               <td>
											   <?php
$first_assistant_director = explode(",", $row["first_assistant_director"]);

foreach ($first_assistant_director as $first_assistant_director_id) {
    $first_assistant_director_data_query = "select * from director where id='$first_assistant_director_id'";
    $first_assistant_director_data_exe = mysqli_query($con, $first_assistant_director_data_query);
  
        $first_assistant_director_name_read = mysqli_fetch_array($first_assistant_director_data_exe);
        echo $first_assistant_director_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Second Assistant Director:</th>
                                               <td>
											    <?php
$second_assistant_director = explode(",", $row["second_assistant_director"]);

foreach ($second_assistant_director as $second_assistant_director_id) {
    $second_assistant_director_data_query = "select * from director where id='$second_assistant_director_id'";
    $second_assistant_director_data_exe = mysqli_query($con, $second_assistant_director_data_query);
  
        $second_assistant_director_name_read = mysqli_fetch_array($second_assistant_director_data_exe);
        echo $second_assistant_director_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Third Assistant Director:</th>
                                               <td>
											    <?php
$third_assistant_director = explode(",", $row["third_assistant_director"]);

foreach ($third_assistant_director as $third_assistant_director_id) {
    $third_assistant_director_data_query = "select * from director where id='$third_assistant_director_id'";
    $third_assistant_director_data_exe = mysqli_query($con, $third_assistant_director_data_query);
  
        $third_assistant_director_name_read = mysqli_fetch_array($third_assistant_director_data_exe);
        echo $third_assistant_director_name_read["name"],"<br/>";
    }

?>
											   
											  </td>
                                               </tr>
                                                <tr>
                                               <th>Second Second Assistant Director:</th>
                                               <td>
											   <?php
$second_second_assistant_director = explode(",", $row["second_second_assistant_director"]);

foreach ($second_second_assistant_director as $second_second_assistant_director_id) {
    $second_second_assistant_director_data_query = "select * from director where id='$second_second_assistant_director_id'";
    $second_second_assistant_director_data_exe = mysqli_query($con, $second_second_assistant_director_data_query);
  
        $second_second_assistant_director_name_read = mysqli_fetch_array($second_second_assistant_director_data_exe);
        echo $second_second_assistant_director_name_read["name"],"<br/>";
    }

?>
											 </td>
                                               </tr>
                                                <tr>
                                               <th>Trainee Assistant Director:</th>
                                               <td>
											   <?php
$tainee_assistant_director = explode(",", $row["tainee_assistant_director"]);

foreach ($tainee_assistant_director as $tainee_assistant_director_id) {
    $tainee_assistant_director_data_query = "select * from director where id='$tainee_assistant_director_id'";
    $tainee_assistant_director_data_exe = mysqli_query($con, $tainee_assistant_director_data_query);
  
        $tainee_assistant_director_name_read = mysqli_fetch_array($tainee_assistant_director_data_exe);
        echo $tainee_assistant_director_name_read["name"],"<br/>";
    }

?>
											 </td>
                                               </tr>
                                               <tr>
                                               <th>Director Assistant:</th>
                                               <td>
											   <?php
$director_assistant = explode(",", $row["director_assistant"]);

foreach ($director_assistant as $director_assistant_id) {
    $director_assistant_data_query = "select * from director where id='$director_assistant_id'";
    $director_assistant_data_exe = mysqli_query($con, $director_assistant_data_query);
  
        $director_assistant_name_read = mysqli_fetch_array($director_assistant_data_exe);
        echo $director_assistant_name_read["name"],"<br/>";
    }

?>
											 </td>
                                               </tr>
                                                <tr>
                                               <th>Second Unit Directors:</th>
                                               <td>
											   
											   <?php
$second_unit_director = explode(",", $row["second_unit_director"]);

foreach ($second_unit_director as $second_unit_director_id) {
    $second_unit_director_data_query = "select * from director where id='$second_unit_director_id'";
    $second_unit_director_data_exe = mysqli_query($con, $second_unit_director_data_query);
  
        $second_unit_director_name_read = mysqli_fetch_array($second_unit_director_data_exe);
        echo $second_unit_director_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                <tr>
                                               <th>First Assistant Diretor-Second Unit:</th>
                                               <td>
											   <?php
$first_assistant_director_second_unit = explode(",", $row["first_assistant_director_second_unit"]);

foreach ($first_assistant_director_second_unit as $first_assistant_director_second_unit_id) {
    $first_assistant_director_second_unit_data_query = "select * from director where id='$first_assistant_director_second_unit_id'";
    $first_assistant_director_second_unit_data_exe = mysqli_query($con, $first_assistant_director_second_unit_data_query);
  
        $first_assistant_director_second_unit_name_read = mysqli_fetch_array($first_assistant_director_second_unit_data_exe);
        echo $first_assistant_director_second_unit_name_read["name"],"<br/>";
    }

?>
											 </td>
                                               </tr>
                                               <tr>
                                               <th>Second Assistant Diretor-Second Unit:</th>
                                               <td>
											   <?php
$second_assistant_director_second_unit = explode(",", $row["second_assistant_director_second_unit"]);

foreach ($second_assistant_director_second_unit as $second_assistant_director_second_unit_id) {
    $second_assistant_director_second_unit_data_query = "select * from director where id='$second_assistant_director_second_unit_id'";
    $second_assistant_director_second_unit_data_exe = mysqli_query($con, $second_assistant_director_second_unit_data_query);
  
        $second_assistant_director_second_unit_name_read = mysqli_fetch_array($second_assistant_director_second_unit_data_exe);
        echo $second_assistant_director_second_unit_name_read["name"],"<br/>";
    }

?>
											 </td>
                                               </tr>
                                               <tr>
                                               <th>Dialogue Director:</th>
                                               <td>
											   <?php
$dialogue_director = explode(",", $row["dialogue_director"]);

foreach ($dialogue_director as $dialogue_director_id) {
    $dialogue_director_data_query = "select * from director where id='$dialogue_director_id'";
    $dialogue_director_data_exe = mysqli_query($con, $dialogue_director_data_query);
  
        $dialogue_director_name_read = mysqli_fetch_array($dialogue_director_data_exe);
        echo $dialogue_director_name_read["name"],"<br/>";
    }

?>
											 </td>
                                               </tr>
                                            </table>
                                         
                                          
                                       </td>
                                       <td>
                                         
                                          <a href="edit_film_directors.php?id=<? echo $row['id'];?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
                                          <a  href="delete_film_director_management.php?delete=<? echo $row['id'];?>" onclick="return del();" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
                                       </td>
                                    </tr>

                                     <? $sn++;} ?>
                                    
                                 </tbody>
                              </table>



<div style='padding: 10px 20px 0px; border-top: ded 1px #CCC;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>

<ul class="pagination">
  <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
  <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
  </li>
       
    <?php 
  if ($total_no_of_pages <= 10){     
    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
      if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }
        }
  }
  elseif($total_no_of_pages > 10){
    
  if($page_no <= 4) {     
   for ($counter = 1; $counter < 8; $counter++){     
      if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }
        }
    echo "<li><a>...</a></li>";
    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
    }

   elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {     
    echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {     
           if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }                  
       }
       echo "<li><a>...</a></li>";
     echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
     echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
    
    else {
        echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }                   
                }
            }
  }
?>
    
  <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
  </li>
    <?php if($page_no < $total_no_of_pages){
    echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
    } ?>
</ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

           
               <!-- customer Modal1 -->
              
               <!-- /.modal -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <strong>Copyright &copy; 2016-2017 <a href="#">Bollywood Product</a>.</strong> All rights reserved.
         </footer>
      </div>
      <!-- ./wrapper -->
      <!-- Start Core Plugins
         =====================================================================-->
      <!-- jQuery -->
      <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
      <!-- jquery-ui --> 
      <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <!-- Bootstrap -->
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <!-- lobipanel -->
      <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <!-- Pace js -->
      <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <!-- table-export js -->
      <script src="assets/plugins/table-export/tableExport.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/jquery.base64.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/html2canvas.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/sprintf.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/jspdf.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/base64.js" type="text/javascript"></script>
      <!-- dataTables js -->
      <script src="assets/plugins/datatables/dataTables.min.js" type="text/javascript"></script>
      <!-- SlimScroll -->
      <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <!-- FastClick -->
      <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
      <!-- CRMadmin frame -->
      <script src="assets/dist/js/custom.js" type="text/javascript"></script>
      <!-- End Core Plugins
         =====================================================================-->
      <!-- Start Theme label Script
         =====================================================================-->
      <!-- Dashboard js -->
      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
      <!-- End Theme label Script
         =====================================================================-->

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

 

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


   </body>
 
</html>

<script type="text/javascript"> 

$(document).ready(function() {
    $('.select2').select2();
});
</script>

<script type="text/javascript">
function resume_id(res_id){

var agree=confirm("This will record.  Are you sure you wish to continue?");
if (agree) {
window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>?remove=yes&id='+res_id;
window.submit();
}
else {
   
}
}

</script>