<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      } 
?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>View All Profile Management</title>
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
		 
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


  <script src="https://cdn.tiny.cloud/1/qyhq7trksx7i1gpmasi3h8szpuzmiuj9c3epa0k2hjpuszlk/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>

<link href="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
<style>
.flexdatalist-alias
{
	width:100%;
}
</style>
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
                  <h1>View All Profile Management</h1>
                  <small>Cast/Crew List</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">


<? if( $_GET['Action']==""){ ?>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>View All Profile List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="crew_details.php"> <i class="fa fa-plus"></i> Add cast
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
    url: "search_all_cast_crew.php",
    data: dataString,
    cache: false,
    success: function(html)
    {
    $("#result").html(html).show();
    }
    });
}else
{
     $("#result").html('').hide(); // Clear and hide results

}   
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

<input type="text" class="search form-control" id="searchid" placeholder="Explore All Cast & Crew By Name..." style="width: 100%" /> 
<div id="result"></div>

 <div class="form search-box">
 </div>


<br><br>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                      <th>Profile Type</th> 
                                       <th>Name</th> 
                                       <th>Father Name</th>
                                       <th>Nationality</th>
                                       <th>DOB</th>
                                       <th>DOD</th>
                                       <th>Photo</th> 
                                       <th>Profile Unique ID</th> 
                                     
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                    <? 


if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = (int)$_GET['page_no'];
} else {
    $page_no = 1;
}

$total_records_per_page = 100;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = 2;

/* COUNT TOTAL RECORDS */
$count_query = mysqli_query($con, "
    SELECT COUNT(*) AS total_records
    FROM (
        SELECT id FROM cast
        UNION ALL
        SELECT id FROM director
        UNION ALL
        SELECT id FROM producer
         UNION ALL
        SELECT id FROM actiondirector
         UNION ALL
        SELECT id FROM additionalcontributors
         UNION ALL
        SELECT id FROM choreographer
         UNION ALL
        SELECT id FROM cinematographer
        UNION ALL
        SELECT id FROM casting
         UNION ALL
        SELECT id FROM costumes
        UNION ALL
        SELECT id FROM film_editor
        UNION ALL
        SELECT id FROM lyricist
        UNION ALL
        SELECT id FROM location_manager
        UNION ALL
        SELECT id FROM music_director
        UNION ALL
        SELECT id FROM mix
        UNION ALL
        SELECT id FROM music_programmer
        UNION ALL
        SELECT id FROM master
        UNION ALL
        SELECT id FROM music_producer
        UNION ALL
        SELECT id FROM music_arranged
        UNION ALL
        SELECT id FROM makeup
        UNION ALL
        SELECT id FROM marketing_publicity
        UNION ALL
        SELECT id FROM production_designer
        UNION ALL
        SELECT id FROM productionanddistribution
        UNION ALL
        SELECT id FROM productionandmanagement
        UNION ALL
        SELECT id FROM special_effect_manager
        UNION ALL
        SELECT id FROM singer
        UNION ALL
        SELECT id FROM screenplay
        UNION ALL
        SELECT id FROM sound
        UNION ALL
        SELECT id FROM visualeffects
    ) AS profiles
");

$count_row = mysqli_fetch_assoc($count_query);
$total_records = $count_row['total_records'];

$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1;



/* FETCH PAGINATED RECORDS */
$result = mysqli_query($con, "
    SELECT *
    FROM (
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'cast' AS profile_type
        FROM cast

        UNION ALL

        SELECT
            id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'director' AS profile_type
        FROM director

        UNION ALL

        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'producer' AS profile_type
        FROM producer
        
        UNION ALL

        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'actiondirector' AS profile_type
        FROM actiondirector
        
          UNION ALL

        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'additionalcontributors' AS profile_type
        FROM additionalcontributors
        
        UNION ALL

        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'choreographer' AS profile_type
        FROM choreographer
        
         UNION ALL

        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'cinematographer' AS profile_type
        FROM cinematographer
        
         UNION ALL

        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'casting' AS profile_type
        FROM casting
        
         UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'costumes' AS profile_type
        FROM costumes
        
         UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'film_editor' AS profile_type
        FROM film_editor
        
        UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'lyricist' AS profile_type
        FROM lyricist
        
        UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'location_manager' AS profile_type
        FROM location_manager
        
         UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'music_director' AS profile_type
        FROM music_director
        
        UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'mix' AS profile_type
        FROM mix
        
        UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'music_programmer' AS profile_type
        FROM music_programmer
        
        UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'master' AS profile_type
        FROM master
        
         UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'music_producer' AS profile_type
        FROM music_producer
        
        UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'music_arranged' AS profile_type
        FROM music_arranged
        
         UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'makeup' AS profile_type
        FROM makeup
        
         UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'marketing_publicity' AS profile_type
        FROM marketing_publicity
        
        UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'production_designer' AS profile_type
        FROM production_designer
        
         UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'productionanddistribution' AS profile_type
        FROM productionanddistribution
        
        UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'productionandmanagement' AS profile_type
        FROM productionandmanagement
        
        UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'special_effect_manager' AS profile_type
        FROM special_effect_manager
        
         UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'singer' AS profile_type
        FROM singer
        
        UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'screenplay' AS profile_type
        FROM screenplay
        
        UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'sound' AS profile_type
        FROM sound
        
        UNION ALL
         
        SELECT
           id, name, real_name, nickname, nationality, father, photo, birth_date, birth_month, birth_year, profile_unique_id,death_date,death_month,death_year,
            'visualeffects' AS profile_type
        FROM visualeffects
    ) AS profiles

    ORDER BY name ASC
    LIMIT $offset, $total_records_per_page
");


 
                                    while($row=mysqli_fetch_array($result)){ 
                                    
$profile_labels = array(
    'cast' => 'Cast',
    'director' => 'Director',
    'producer' => 'Producer',
    'sound' => 'Sound',
    'visualeffects' => 'Visual Effects',
    'marketing_publicity' => 'Marketing Publicity',
    'music_director' => 'Music Director',
    'writer' => 'Writer',
    'singer' => 'Singer',
    'editor' => 'Editor',
    'cinematographer' => 'Cinematographer'
);
     $profile_type = $row['profile_type'];  
     $id=$row["id"];
     $profile_unique_id=$row['profile_unique_id'];
                                    ?>
                                    <tr>
                                         <td><? echo isset($profile_labels[$profile_type])
    ? $profile_labels[$profile_type]
    : ucwords(str_replace('_', ' ', $profile_type)); ?></td>    
                                       <td>
                                           <b>Name:</b><? echo $row['name']; ?><br/>
                                           <b>Real Name:</b><? echo $row['real_name']; ?><br/>
                                           <b>Nick Name:</b><? echo $row['nickname']; ?><br/>
                                       </td>
                                      
                                       <td><? echo $row['father']; ?></td> 
                                       <td><? echo $row['nationality']; ?></td>
                                     
                                       <td>


                                          <? if($row['birth_date']!="" or $row['birth_date']!="00"){ echo $row['birth_date'];} ?> 

<? if($row['birth_month']!="" or $row['birth_month']!="00"){ 
 $monthNum= ltrim($row['birth_month'], '0');  
 if($monthNum!=0){ 
echo date('F', mktime(0, 0, 0, $monthNum, 10)); } }?> 

<?   if($row['birth_year']!="" or $row['birth_year']!="0000"){ 
       echo $rowf['birth_year']; 
} ?> 
                                          

                                       </td> 
                                       <td>


                                          <? if($row['death_date']!="" or $row['death_date']!="00"){ echo $row['death_date'];} ?> 

<? if($row['death_month']!="" or $row['death_month']!="00"){ 
 $monthNum= ltrim($row['death_month'], '0');  
 if($monthNum!=0){ 
echo date('F', mktime(0, 0, 0, $monthNum, 10)); }}?> 

<?   if($row['death_year']!="" or $row['death_year']!="0000"){ 
       echo $rowf['death_year']; 
} ?> 
                                    
                                       </td> 
                                      <td> <img src="photo/<? echo $row['photo']; ?>" width="50"></td>
                                       <td><? echo $row['profile_unique_id']; ?></td>
                                     
                                       <td>
                                           <a href="crew-details-edit.php?Action=Update&id=<?php echo $id; ?>&profile=<?php echo $profile_type; ?>&profile_unique_id=<?php echo $profile_unique_id; ?>" 
               style="color:#0044de;">
               Edit
            </a> 

            | 

            <a href="common-delete-cast-crew.php?Action=delete&id=<?php echo $id; ?>&profile=<?php echo $profile_type; ?>&profile_unique_id=<?php echo $profile_unique_id; ?>" 
               style="color:#F00;">
               Delete
            </a>

                                       </td>
                                    </tr>

                                     <? } ?>
                                    
                                 </tbody>
                              </table>



<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
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

            <? } ?>
               <!-- customer Modal1 -->
              
               <!-- /.modal -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <strong>Copyright &copy; 2018-22023 <a href="#">Bollywood Product</a>.</strong> All rights reserved.
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

<script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>
<script>
$('.flexdatalist').flexdatalist({
     minLength: 1,
	 selectionRequired: true,
	  valueProperty: 'value'
});
</script>

<script>
  $(document).ready(function() {
    $('.main_language').select2();
});
</script>

<script>
  $(document).ready(function() {
    $('.orignal_language').select2();
});
</script>
		 
		 
		 <script>
$(document).ready(function(){

    var maxField3 = 10; //Input fields increment limitation
    var addButton3 = $('.add_button_father'); //Add button selector
    var wrapper3 = $('.field_wrapper3_father'); //Input field wrapper
    var fieldHTML3 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                         '<div class="form-group">'+
                                 '<label>Father Name</label>'+
                                 '<input type="text" class="form-control" name="father[]" placeholder="Enter Father">'+
								 
								 '</div>'+
							   '<div class="form-group">'+
							  '<label>Father/Step Father</label>'+
							  
							  '<select class="form-control" id="Sequel" name="real_step_father[]" >'+
                                     '<option value="Father">Father</option>'+
                                     '<option value="Step Father"> Step Father</option>'+
                                   
                                '</select>'+
                                 
   
                                 
                              '</div>'+
							  
							  ' <div class="form-group">'+
							   
							   '<h4><B>Date Of Birth</B></h4>'+
							  '<label>Date</label>'+
                                 
   '<input type="text" class="" name="fatherDOB_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="fatherDOB_moth[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="fatherDOB_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							   '<BR/>'+
							    '<div class="form-group">'+
							   
							   '<h4><B>Date Of Death</B></h4>'+
							  '<label>Date</label>'+
                                 
   '<input type="text" class="" name="fatherDOD_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="fatherDOD_moth[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="fatherDOD_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							  
							
                                
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton3).click(function(){
        //Check maximum number of input fields
        if(x < maxField3){ 
            x++; //Increase field counter
            $(wrapper3).append(fieldHTML3); //Add field html
         
           
        }else{
            alert('A maximum of '+maxField2+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper3).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>





 <script>
$(document).ready(function(){

    var maxField4 = 10; //Input fields increment limitation
    var addButton4 = $('.add_button_mother'); //Add button selector
    var wrapper4 = $('.field_wrapper3_mother'); //Input field wrapper
    var fieldHTML4 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                         
							    '<div class="form-group">'+
                                 '<label>Mother Name</label>'+
                                 '<input type="text" class="form-control" name="mother[]" placeholder="Enter Mother">'+
								 
								 '</div>'+
							   '<div class="form-group">'+
							  '<label>Mother/Step Mother</label>'+
							  
							  '<select class="form-control" id="Sequel" name="real_step_mother[]">'+
                                      '<option value="Mother">Mother</option>'+
                                     '<option value="Step Mother"> Step Mother</option>'+
                                   
                                '</select>'+
                                 
                                 
                              '</div>'+
							  
							'<div class="form-group">'+
							  '<h4><B>Date Of Birth</B></h4>'+
							  '<label>Date</label>'+
                                 
   '<input type="text" class="" name="motherDOB_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="motherDOB_moth[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="motherDOB_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							   '<BR/>'+
							  '<div class="form-group">'+
							  '<h4><B>Date Of Death</B></h4>'+
							  '<label>Date</label>'+
                                 
   '<input type="text" class="" name="motherDOD_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="motherDOD_moth[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="motherDOD_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							  
							  
							
                                
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton4).click(function(){
        //Check maximum number of input fields
        if(x < maxField4){ 
            x++; //Increase field counter
            $(wrapper4).append(fieldHTML4); //Add field html
         
           
        }else{
            alert('A maximum of '+maxField4+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper4).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>

<script>
$(document).ready(function(){

    var maxField5 = 10; //Input fields increment limitation
    var addButton5 = $('.add_button_spouse'); //Add button selector
    var wrapper5 = $('.field_wrapper_spouse'); //Input field wrapper
    var fieldHTML5 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                         
							    '<div class="form-group">'+
                                '<label>'+
								 '<input type="radio" name="Spouse_Partner[]" value="Spouse">Spouse'+
'<input type="radio" name="Spouse_Partner[]" value="Partner">Partner'+
								 '</label>'+
                                '<input type="text" class="form-control" name="spouse[]" placeholder="Enter Spouse">'+
                              '</div>'+
							  
  '<div class="form-group  ">'+
  
							   '<h4><B>Marriage Date</B></h4>'+
							    '<label>Date</label>'+
                                 
   '<input type="text" class="" name="marriage_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="marriage_moth[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="marriage_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							  
							    '<BR/>'+
							  
							  '<div class="form-group  ">'+
							  '<h4><B>Separation Date</B></h4>'+
							 
							    '<label>Date</label>'+
                                 
   '<input type="text" class="" name="separation_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="separation_moth[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="separation_year[]"   placeholder="Year"  >'+
                                 
								 
                              '</div>'+
							   '<BR/>'+

							   '<div class="form-group  ">'+
							  '<h4><B>Divorce Date</B></h4>'+
							    '<label>Date</label>'+
                                 
   '<input type="text" class="" name="divorce_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="divorce_moth[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="divorce_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							   '<BR/>'+
							    '<div class="form-group">'+
							  '<h4><B>Date Of Death</B></h4>'+
							
							    '<label>Date</label>'+
                                 
   '<input type="text" class="" name="spouseDOD_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="spouseDOD_moth[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="spouseDOD_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							  
							  '<h4> No. Of Children</h4>'+
							  '<br/>'+
							  '<div class="form-group  ">'+
							   '<label>son</label>'+
                                 
   '<input type="text" class="form-control" name="total_son[]"   placeholder="No of son"  >'+
							  
							'</div>'+
							 '<div class="form-group  ">'+
							   '<label>Daughter</label>'+
                                 
   '<input type="text" class="form-control" name="total_Daughter[]"   placeholder="No of Daughter" >'+
							  
							'</div>'+
							'<div class="form-group  ">'+
							   '<label>Spouse/Partner Total No. Of Children</label>'+
                                 
   '<input type="text" class="form-control" name="spouse_total_children[]"   placeholder="No of Daughter"  >'+
							  
							'</div>'+
							
                                
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton5).click(function(){
        //Check maximum number of input fields
        if(x < maxField5){ 
            x++; //Increase field counter
            $(wrapper5).append(fieldHTML5); //Add field html
         
           
        }else{
            alert('A maximum of '+maxField5+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper5).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>


<script>
$(document).ready(function(){

    var maxField6 = 10; //Input fields increment limitation
    var addButton6 = $('.add_button_son'); //Add button selector
    var wrapper6 = $('.field_wrapper_son'); //Input field wrapper
    var fieldHTML6 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                         
							   '<div class="form-group">'+
                                ' <label>Son</label>'+
                                 '<input type="text" class="form-control" name="son[]" placeholder="Enter Son"  >'+
                              '</div>'+
							  
							    '<div class="form-group">'+
							   '<label>'+
							  '<input type="radio" name="son_mother_father[]" value="Father">Father'+
'<input type="radio" name="son_mother_father[]" value="Mother">Mother'+
							  '</label>'+
                                 '<input type="text" class="form-control" name="son_relation[]" placeholder="Enter Mother/Father Name"  >'+
                              '</div>'+
							  
   '<div class="form-group  ">'+
							 '<h4><B>Date Of Birth</B></h4>'+
							    '<label>Date</label>'+
                                 
   '<input type="text" class="" name="sonDOB_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="sonDOB_month[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="sonDOB_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							   '<br/>'+
							  
							   '<div class="form-group  ">'+
							 '<h4><B>Date Of Death</B></h4>'+
							    '<label>Date</label>'+
                                 
   '<input type="text" class="" name="sonDOD_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="sonDOD_month[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="sonDOD_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							
                                
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton6).click(function(){
        //Check maximum number of input fields
        if(x < maxField6){ 
            x++; //Increase field counter
            $(wrapper6).append(fieldHTML6); //Add field html
         
           
        }else{
            alert('A maximum of '+maxField6+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper6).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>



<script>
$(document).ready(function(){

    var maxField7 = 10; //Input fields increment limitation
    var addButton7 = $('.add_button_daughter'); //Add button selector
    var wrapper7 = $('.field_wrapper_daughter'); //Input field wrapper
    var fieldHTML7 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                         
							   '<div class="form-group">'+
                                ' <label>Daughter</label>'+
                                 '<input type="text" class="form-control" name="daughter[]" placeholder="Enter daughter"  >'+
                              '</div>'+
							  
							   '<div class="form-group">'+
							   '<label>'+
							  '<input type="radio" name="daughter_mother_father[]" value="Father">Father'+
'<input type="radio" name="daughter_mother_father[]" value="Mother">Mother'+
							  '</label>'+
                                 '<input type="text" class="form-control" name="daughter_relation[]" placeholder="Enter Mother/Father Name"  >'+
                              '</div>'+
							  
							  
   '<div class="form-group  ">'+
							'<h4><B>Date Of Birth</B></h4>'+
							    '<label>Date</label>'+
                                 
   '<input type="text" class="" name="daughterDOB_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="daughterDOB_month[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="daughterDOB_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							  
							  
							  
							    '<div class="form-group  ">'+
							'<h4><B>Date Of Death</B></h4>'+
							    '<label>Date</label>'+
                                 
   '<input type="text" class="" name="daughterDOD_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="daughterDOD_month[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="daughterDOD_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							
                                
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton7).click(function(){
        //Check maximum number of input fields
        if(x < maxField7){ 
            x++; //Increase field counter
            $(wrapper7).append(fieldHTML7); //Add field html
         
           
        }else{
            alert('A maximum of '+maxField7+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper7).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>



<script>
$(document).ready(function(){

    var maxField8 = 10; //Input fields increment limitation
    var addButton8 = $('.add_button_brother'); //Add button selector
    var wrapper8 = $('.field_wrapper_brother'); //Input field wrapper
    var fieldHTML8 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                         
							   '<div class="form-group">'+
                                ' <label>Brother</label>'+
                                 '<input type="text" class="form-control" name="brother[]" placeholder="Enter brother"  >'+
                              '</div>'+
							  
							   '<div class="form-group">'+
							  '<label>'+
							  '<input type="radio" name="brother_mother_father[]" value="Father">Father'+
'<input type="radio" name="brother_mother_father[]" value="Mother">Mother'+
							  '</label>'+
                                 '<input type="text" class="form-control" name="brother_relation[]" placeholder="Enter Mother/Father Name"  >'+
                              '</div>'+
							  
							  
   '<div class="form-group  ">'+
							'<h4><B>Date Of Birth</B></h4>'+
							    '<label>Date</label>'+
                                 
   '<input type="text" class="" name="brotherDOB_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="brotherDOB_month[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="brotherDOB_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							  
							  
							  
							    '<div class="form-group  ">'+
							'<h4><B>Date Of Death</B></h4>'+
							    '<label>Date</label>'+
                                 
   '<input type="text" class="" name="brotherDOD_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="brotherDOD_month[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="brotherDOD_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							
                                
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton8).click(function(){
        //Check maximum number of input fields
        if(x < maxField8){ 
            x++; //Increase field counter
            $(wrapper8).append(fieldHTML8); //Add field html
         
           
        }else{
            alert('A maximum of '+maxField8+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper8).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>




<script>
$(document).ready(function(){

    var maxField9 = 10; //Input fields increment limitation
    var addButton9 = $('.add_button_sister'); //Add button selector
    var wrapper9 = $('.field_wrapper_sister'); //Input field wrapper
    var fieldHTML9 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                         
							   '<div class="form-group">'+
                                ' <label>Sister</label>'+
                                 '<input type="text" class="form-control" name="sister[]" placeholder="sister brother"  >'+
                              '</div>'+
							  
							   '<div class="form-group">'+
							 '<label>'+
							  '<input type="radio" name="sister_mother_father[]" value="Father">Father'+
'<input type="radio" name="sister_mother_father[]" value="Mother">Mother'+
							  '</label>'+
                                 '<input type="text" class="form-control" name="sister_relation[]" placeholder="Enter Mother/Father Name"  >'+
                              '</div>'+
							  
							  
   '<div class="form-group  ">'+
							'<h4><B>Date Of Birth</B></h4>'+
							    '<label>Date</label>'+
                                 
   '<input type="text" class="" name="sisterDOB_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="sisterDOB_month[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="sisterDOB_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							  
							  
							  
							    '<div class="form-group  ">'+
							'<h4><B>Date Of Death</B></h4>'+
							    '<label>Date</label>'+
                                 
   '<input type="text" class="" name="sisterDOD_date[]"   placeholder="Date"  >'+
   '<label>Month</label>'+
                                 
   '<input type="text" class="" name="sisterDOD_month[]"   placeholder="Month"  >'+
   '<label>Year</label>'+
                                 
   '<input type="text" class="" name="sisterDOD_year[]"   placeholder="Year"  >'+
                                 
                              '</div>'+
							
                                
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton9).click(function(){
        //Check maximum number of input fields
        if(x < maxField9){ 
            x++; //Increase field counter
            $(wrapper9).append(fieldHTML9); //Add field html
         
           
        }else{
            alert('A maximum of '+maxField9+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper9).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){

    function performSearch(inputElement) {
        var inputVal = inputElement.val();
        var resultDropdown = inputElement.siblings(".result1");
        if(inputVal.length){
            $.get("search_all_cast_crew.php", {term: inputVal})
            .done(function(data){
                resultDropdown.html(data);
            });
        } else {
            resultDropdown.empty();
        }
    }

    // Run search on keyup/input
    $('.search-box input[type="text"]').on("keyup input", function(){
      if ($(this).is(':focus')) { // Check if the input is focused
            performSearch($(this));
        }
        //performSearch($(this));
    });
	
   // Check for non-empty input on page load
    $('.search-box input[type="text"]').each(function() {
        if ($(this).val().length) {
            performSearch($(this));
        }
    });

    // Set input value when suggestion is clicked
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
	
	 // Polling mechanism to check for changes in the input field
    let lastValue = '';
    const inputField = $('.search-box input[type="text"]');
    setInterval(function() {
        const currentValue = inputField.val();
        if (currentValue !== lastValue) {
            lastValue = currentValue;
            performSearch(inputField);
        }
    }, 500); // Check every 500 milliseconds
	
	
});
</script>

   