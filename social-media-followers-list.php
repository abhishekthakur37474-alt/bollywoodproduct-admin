<?
session_start();
include "config.php";
  date_default_timezone_set('Asia/Kolkata');
    $current_time=date('Y-m-d H:i:s');
if($_SESSION['admin']==""){
     header("location:index.php");
   
      } 
if($_POST["Submit"]) { 
    $cast_name= mysqli_real_escape_string($con,$_POST['cast_name']) ;
    $social_name=mysqli_real_escape_string($con,implode(",",$_POST['social_name']));
    $number_of_followers=mysqli_real_escape_string($con,implode(",",$_POST['number_of_followers']));
    $followers_format=mysqli_real_escape_string($con,implode(",",$_POST['followers_format']));
    $link=mysqli_real_escape_string($con,implode(",",$_POST['link']));
mysqli_query($con,"INSERT INTO `celebrity_social_stats` (`cast_id`,`platform_id`,`followers`,`followers_format`,`updated_at`,`links`) VALUES ('$cast_name','$social_name','$number_of_followers','$followers_format','$current_time','$link')") or die(mysqli_error($con));
  
            header('location:social-media-followers-list.php?msg=success');
    
}

           if($_POST["Update"]) {

    $id= $_POST['id'];
   
    $social_name=mysqli_real_escape_string($con,implode(",",$_POST['social_name']));
    $number_of_followers=mysqli_real_escape_string($con,implode(",",$_POST['number_of_followers']));
    $followers_format=mysqli_real_escape_string($con,implode(",",$_POST['followers_format']));
  $link=mysqli_real_escape_string($con,implode(",",$_POST['link']));

            mysqli_query($con,"update celebrity_social_stats set platform_id='$social_name',followers='$number_of_followers',followers_format='$followers_format',updated_at='$current_time',links='$link' where id='$id'") or die(mysqli_error($con));
             header('location:social-media-followers-list.php?msg=success');
 
 
}
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con, "delete from celebrity_social_stats where id='$_REQUEST[id]'");

header("location:social-media-followers-list.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Cast-Crew Social Media Followers</title>
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
 <link href="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
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
<style>
    	 .flexdatalist-alias
    {
        width:100%;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                  <h1>Cast  Social Media Followers Statistics</h1>
                  <small>Cast Social Media Followers List</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">

<? if($_GET['Action']=="Add"){ ?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Add Social Media Followers</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <div class="field_wrapper_multiple_role">
                               
                                     <div class="form-group">
                                <label>Cast/Crew Name:</label>
                               			
														 <input type='text'
       placeholder='Enter Cast/Crew Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='other_cast',
       data-value-property='value',
	   name='cast_name',
	   value=''
       style="width:100%;"
      
       />
	   <datalist id="other_cast" >
	    
	
   <? $sqlfr=mysqli_query($con, "select * from cast order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(ID:<? echo $rowfr['id']; ?>) Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
   
</datalist>						
                                </div>
                                <div class="form-group">
                                    <button type="button" 
        class="add_button_multiple_role btn btn-success pull-right">

    Add More Social Media

</button>
<br/>
                                <label>Select Social Media Name:</label>
                                <input type='text'
       placeholder='Enter Social Media Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='social_media_name',
       data-value-property='value',
	   name='social_name[]',
	   value=''
       style="width:100%;"
      
       />
	   <datalist id="social_media_name" >
	    
	
   <? $sqlfr=mysqli_query($con, "select * from social_media_name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
   
</datalist>						
                                </div>
                                  <div class="form-group">
                                      <label>Social Media Link:</label> 
                                      <input type="text" name="link[]" class="form-control"/>
                                </div>
                               <div class="form-group">

    <label>Number of Followers:</label>

    <div style="display:flex; gap:10px;">

        <!-- NUMBER -->
        <input type="number"
               name="number_of_followers[]"
               class="form-control"
               placeholder="Enter Followers"
               step="any"
               min="0"
               style="width:80%;" required/>

        <!-- FORMAT -->
        
        <select name="followers_format[]"
                class="form-control"
                style="width:20%;">

            <option value="">None</option>
            <option value="K">K</option>
            <option value="M">M</option>
            <option value="B">B</option>
            <option value="T">T</option>

        </select>

    </div>

</div>
                               
                                </div>
							  
							   

                              <div class="reset-button">

                                   <input type="submit" name="Submit"  class="btn btn-add"  value="Add Record">
                            
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>

<? } ?>











<? if($_GET['Action']=="Update"){  $id2=$_GET['id'];
$sql="select * from celebrity_social_stats  where id='$id2'";
$rs=mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs);
?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Update Social Media Followers Statistics</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                            <button type="button"
        class="add_button_multiple_role btn btn-success">

    Add More Social Media

</button>
                           <form class="col-sm-12" method="post" enctype="multipart/form-data"  >
                               <div class="field_wrapper_multiple_role">
                           <?php

$platform_id = explode(",", $row['platform_id']);

$followers = explode(",", $row['followers']);

$links = explode(",", $row['links']);

$followers_format= explode(",", $row['followers_format']);

for($i = 0; $i < count($platform_id); $i++) {

?>



    <hr/>
<div class="multiple_role_box">
    <?php if($i != 0) { ?>

        <a href="javascript:void(0);" 
           class="remove_button btn btn-danger">

           Remove

        </a>

        <br/><br/>

    <?php } ?>

    <div class="form-group">

        <label>Select Social Media Name:</label>

        <input type="text"
               placeholder="Enter Social Media Name"
               class="flexdatalist"
               data-min-length="1"
               data-value-property="value"
               list="social_media_name"
               name="social_name[]"
               value="<?php echo trim($platform_id[$i]); ?>"
               style="width:100%;" />

    </div>
     <div class="form-group">
                                      <label>Social Media Link:</label> 
                                      <input type="text" name="link[]" value="<?php echo trim($links[$i]); ?>" class="form-control"/>
                                </div>
  <div class="form-group">

    <label>Number of Followers:</label>

    <div style="display:flex; gap:10px;">

        <!-- NUMBER -->
        <input type="number"
               name="number_of_followers[]"
               class="form-control"
               placeholder="Enter Followers"
               step="any"
               min="0"
               style="width:80%;" value="<?php echo trim($followers[$i]); ?>" 
               required/>

        <!-- FORMAT -->
        
        <select name="followers_format[]"
                class="form-control"
                style="width:20%;">
             <option value="<?php echo trim($followers_format[$i]); ?>"><?php echo trim($followers_format[$i]); ?></option>
            <option value="">None</option>
            <option value="K">K</option>
            <option value="M">M</option>
            <option value="B">B</option>
            <option value="T">T</option>

        </select>

    </div>

</div>


   
</div>

<?php } ?>

<datalist id="social_media_name">

<?php

$sqlfr = mysqli_query($con, "SELECT * FROM social_media_name");

while($rowfr = mysqli_fetch_array($sqlfr)) {

?>

    <option value="<?php echo $rowfr['id']; ?>">
        <?php echo $rowfr['name']; ?>
    </option>

<?php } ?>

</datalist>
</div>							  

                              <input type="hidden" name="id" value="<? echo $row['id'];?>"  >
                             
                         
                              <div class="reset-button">

                                 <input type="submit" name="Update" class="btn btn-add"   value="Update">
                                  
                              </div>
                           </form>
                           <script>

$(document).ready(function(){

    // REMOVE FIELD
    $(document).on('click', '.remove_button', function(e){

        e.preventDefault();

        $(this).closest('.multiple_role_box').remove();

    });

});

</script>
<script>

$(document).ready(function(){

    var maxField = 10;

    var x = $('.multiple_role_box').length;

    // REMOVE OLD EVENT
    $('#add_more_social_media').off('click');

    // ADD MORE
    $('#add_more_social_media').on('click', function(e){

        e.preventDefault();

        if(x < maxField){

            x++;

            var html = `

            <div class="multiple_role_box">

                <hr/>

                <a href="javascript:void(0);"
                   class="remove_button btn btn-danger">

                   Remove

                </a>

                <br/><br/>

                <div class="form-group">

                    <label>Select Social Media Name:</label>

                    <input type="text"
                           placeholder="Enter Social Media Name"
                           class="flexdatalist"
                           data-min-length="1"
                           data-value-property="value"
                           list="social_media_name"
                           name="social_name[]"
                           style="width:100%;" />

                </div>
                                 <div class="form-group">
                                      <label>Social Media Link:</label> 
                                      <input type="text" name="link[]" class="form-control"/>
                                </div>
                <div class="form-group">

                    <label>Number of Followers:</label>

                    <div style="display:flex; gap:10px;">

                        <input type="number"
                               name="number_of_followers[]"
                               class="form-control"
                               step="any"
                               min="0"
                               style="width:80%;" />

                        <select name="followers_format[]"
                                class="form-control"
                                style="width:20%;">

                            <option value="">None</option>
                            <option value="K">K</option>
                            <option value="M">M</option>
                            <option value="B">B</option>
                            <option value="T">T</option>

                        </select>

                    </div>

                </div>

            </div>

            `;

            $('.field_wrapper_multiple_role').append(html);

            $('.flexdatalist').flexdatalist({

                minLength: 1,
                selectionRequired: true,
                valueProperty: 'value'

            });

        }

    });

    // REMOVE
    $(document).on('click', '.remove_button', function(e){

        e.preventDefault();

        $(this).closest('.multiple_role_box').remove();

        x--;

    });

});

</script>
                        </div>
                     </div>
                  </div>
               </div>

<? } ?>




<? if( $_GET['Action']==""){ ?>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Social Media Followers Statistics List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="social-media-followers-list.php?Action=Add"> <i class="fa fa-plus"></i> Add Social Media Followers
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
    url: "search_professional.php",
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

<input type="text" class="search form-control" id="searchid" placeholder="Search for Cast" style="width: 100%" />  
<div id="result"></div><br/>
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>Cast Name</th> 
                                         <th>Social Media Stats</th> 
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `celebrity_social_stats`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `celebrity_social_stats` order by id desc LIMIT $offset, $total_records_per_page");


 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                       <td>
                                       <? 
                                       $cast_id=$row['cast_id']; 
                                       $cast_data="select id,name from cast where id='$cast_id'";
                                       $cast_exe=mysqli_query($con,$cast_data);
                                       $read_cast_data=mysqli_fetch_array($cast_exe);
                                       echo $read_cast_data["name"];
                                       ?>
                                       
                                       </td> 
                                       <td>
                                          
                                           <?php

$social_name =explode(",",$row["platform_id"]);
$number_of_followers =explode(",",$row["followers"]);
$followers_format=explode(",",$row["followers_format"]);
for($i = 0; $i < count($social_name); $i++) {

    if(!empty($social_name[$i])) {

        // Fetch Social Media Name from ID
        $social_id = $social_name[$i];

        $query = mysqli_query($con, "SELECT name 
                                     FROM social_media_name 
                                     WHERE id = '$social_id'");

        $row1 = mysqli_fetch_assoc($query);

        echo $row1['name'].' : '.$number_of_followers[$i],$followers_format[$i].'<br><hr/>';

    }

}
?>
                                       </td> 
                                       <td>
                                         
                                          <a href="social-media-followers-list.php?Action=Update&id=<? echo $row['id'];?>" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                          <a  href="javascript:resume_id('<? echo $row['id']?>')" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
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
      <script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>

      <!-- End Theme label Script
         =====================================================================-->
<script>

$(document).ready(function(){

    var maxField_multiple_role = 10;

    var addButton_multiple_role = $('.add_button_multiple_role');

    var wrapper_multiple_role = $('.field_wrapper_multiple_role');

    var x = 1;

    var fieldHTML_multiple_role = `

    <div class="multiple_role_box">

        <hr/>

        <a href="javascript:void(0);" 
           class="remove_button btn btn-danger">

           Remove

        </a>

        <br/><br/>

        <div class="form-group">

            <label>Select Social Media Name:</label>

            <input type="text"
                   placeholder="Enter Social Media Name"
                   class="flexdatalist"
                   data-min-length="1"
                   data-value-property="value"
                   name="social_name[]"
                   list="social_media_name"
                   style="width:100%;" />

            <datalist id="social_media_name">

                <?php

                $sqlfr = mysqli_query($con, "SELECT * FROM social_media_name");

                while($rowfr = mysqli_fetch_array($sqlfr)){

                ?>

                    <option value="<?php echo $rowfr['id']; ?>">
                        <?php echo $rowfr['name']; ?>
                    </option>

                <?php } ?>

            </datalist>

        </div>
        <div class="form-group">
                                      <label>Social Media Link:</label> 
                                      <input type="text" name="link[]" class="form-control"/>
                                </div>
  <div class="form-group">
  <label>Number of Followers:</label>
        <div style="display:flex; gap:10px;">

          

            <input type="number"
                   name="number_of_followers[]"
                   class="form-control" style="width:70%;" required/>

      
        
         <select name="followers_format[]"
                class="form-control"
                style="width:20%;" required>

            <option value="">None</option>
            <option value="K">K</option>
            <option value="M">M</option>
            <option value="B">B</option>
            <option value="T">T</option>

        </select>
  </div>
    </div>
    </div>

    `;

    // ADD MORE
    $(addButton_multiple_role).click(function(){

        if(x < maxField_multiple_role){

            x++;

            var newField = $(fieldHTML_multiple_role);

            $(wrapper_multiple_role).append(newField);

            newField.find('.flexdatalist').flexdatalist({

                minLength: 1,
                selectionRequired: true,
                valueProperty: 'value'

            });

        }else{

            alert('Maximum '+maxField_multiple_role+' fields allowed');

        }

    });

    // REMOVE
    $(wrapper_multiple_role).on('click', '.remove_button', function(e){

        e.preventDefault();

        $(this).closest('.multiple_role_box').remove();

        x--;

    });

});

</script>
<script>
var newField = $(fieldHTML_multiple_role);

$(wrapper_multiple_role).append(newField);

newField.find('.flexdatalist').flexdatalist({
    minLength: 1,
    selectionRequired: true,
    valueProperty: 'value'
});
</script>
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
