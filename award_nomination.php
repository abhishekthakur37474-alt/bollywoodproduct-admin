<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }


    if(isset($_POST["UpdateSequence"]) ) {
   $id=$_POST['id'];
   $parent_id=$_POST['parent_id'];
   $sl_no=$_POST['sl_no'];
   for($i = 0, $l = count($id); $i < $l; ++$i) {
     $idd= $id[$i];
     $sl= $sl_no[$i];
     $sql=mysqli_query($con, "update award_nomination set sl_no='$sl' where id='$idd'");
   } 
    header("location:award_nomination.php?Done");
 
 }



if($_POST["Submit"]) { 
    $award_name_id= $_POST['award_name_id'] ;  
    $award_category_id= $_POST['award_category_id'] ;  
    $award_year_id= $_POST['award_year_id'] ;  
    $is_winner= $_POST['is_winner'] ;  
    $film_id= $_POST['film_id'] ;  
    $film_song_id= $_POST['film_song_id'] ;  
    $videosong_id= $_POST['videosong_id'] ;  
    $nomination_table_name= $_POST['nomination_table_name'] ;  
    $nomination_table_id= $_POST['nomination_table_id'] ;  
    $nomination_name= $_POST['nomination_name'] ;  
 
 if($nomination_table_name<>""){
   $sqlnn=mysqli_query($con, "select name from ".$nomination_table_name." where id=".$nomination_table_id);
   $rownn=mysqli_fetch_array($sqlnn);
   $nomination_name=$rownn['name'];
 }
 

 
mysqli_query($con,"INSERT INTO `award_nomination` ( `award_name_id` , `award_category_id` , `award_year_id`, nomination_table_name, nomination_table_id, nomination_name, is_winner, film_id, film_song_id, videosong_id ) VALUES (  '$award_name_id','$award_category_id', '$award_year_id', '$nomination_table_name', '$nomination_table_id', '$nomination_name', '$is_winner', '$film_id', '$film_song_id', '$videosong_id')") or die(mysqli_error($con));
  
            header('location:award_nomination.php?Action=Add&award_name_id='.$award_name_id.'&award_year_id='.$award_year_id.'&award_category_id='.$award_category_id);
         }



           if($_POST["Update"]) {




    $id= $_POST['id'];
    $award_name= $_POST['award_name'] ;  
    $award_category= $_POST['award_category'] ;  
    $award_year= $_POST['award_year'] ;  
  
            mysqli_query($con,"update award_nomination set   award_name='$award_name', award_category='$award_category', award_year='$award_year'  where id='$id'") or die(mysql_error());
             header('location:award_nomination.php?msg=success');
         }
  
   if($_GET['Action']=="Delete"){

    $id= $_GET['id'] ;  
    $award_name_id= $_GET['award_name_id'] ;  
    $award_category_id= $_GET['award_category_id'] ;  
    $award_year_id= $_GET['award_year_id'] ;  

mysqli_query($con, "delete from award_nomination where id='$id'");

header('location:award_nomination.php?Action=Add&award_name_id='.$award_name_id.'&award_year_id='.$award_year_id.'&award_category_id='.$award_category_id);
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>award Management</title>
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
                  <h1>award</h1>
                  <small>award List</small>
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
                                 <h4>Add award</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                                <div class="form-group">
                                 <label>Award name : </label>
                                 <?php if(!isset($_GET['award_name_id'])){ ?>
                                 <select name="award_name"  class="form-control"  onChange="window.document.location.href=this.options[this.selectedIndex].value;">
                                     <option value="award_nomination.php?Action=Add"></option>
                                    <?php $sqla=mysqli_query($con, "select * from award_name");
                                    while($rowa=mysqli_fetch_array($sqla)){?>
                                       <option value="award_nomination.php?Action=Add&award_name_id=<?php echo $rowa['id']; ?>"><?php echo $rowa['name']; ?></option>
                                    <?php } ?>
                                 </select> 
                              <?php } else { ?>

<?php $award_name_id=$_GET['award_name_id'];
$sqlawi=mysqli_query($con, "select * from award_name where id='$award_name_id'");
$rowawi=mysqli_fetch_array($sqlawi);
echo $rowawi['name']; ?> (<a href="award_nomination.php?Action=Add" style="color:#F00; text-decoration: underline;">Reset</a>)
                              <?php } ?>





                              </div>
  <div class="form-group">
                                 <label>Award Year : </label>
  <?php if(!isset($_GET['award_year_id'])){ ?>
                                 <select name="award_year"  class="form-control"  onChange="window.document.location.href=this.options[this.selectedIndex].value;">
                                     <option value="award_nomination.php?Action=Add&award_name_id=<?php echo $_GET['award_name_id']; ?>"></option>


                                    <?php 
$award_name_id=$_GET['award_name_id'];
                                    $sqla=mysqli_query($con, "select * from award_year where award_name_id='$award_name_id'");
                                    while($rowa=mysqli_fetch_array($sqla)){?>
                                       <option value="award_nomination.php?Action=Add&award_name_id=<?php echo $_GET['award_name_id']; ?>&award_year_id=<?php echo $rowa['id']; ?>"><?php echo $rowa['award_year']; ?></option>
                                    <?php } ?>

                                 </select> 


                                   <?php } else { ?>

<?php $award_year_id=$_GET['award_year_id'];
$sqlayi=mysqli_query($con, "select * from award_year where id='$award_year_id'");
$rowayi=mysqli_fetch_array($sqlayi);
echo $rowayi['award_year']; ?> (<a href="award_nomination.php?Action=Add&award_name_id=<?php echo $_GET['award_name_id']; ?>" style="color:#F00; text-decoration: underline;">Reset</a>)
                              <?php } ?>


                              </div>

                
  <div class="form-group">
                                 <label>Award Category : </label>
  <?php if(!isset($_GET['award_category_id'])){ ?>
                                 <select name="award_category_id"  class="form-control"  onChange="window.document.location.href=this.options[this.selectedIndex].value;">
                                    <option value="award_nomination.php?Action=Add&award_name_id=<?php echo $_GET['award_name_id']; ?>&award_year_id=<?php echo $rowa['id']; ?>"></option>
                                    <?php $sqla=mysqli_query($con, "select * from award_category where parent_id!='0'");
                                    while($rowa=mysqli_fetch_array($sqla)){?>
                                       <option value="award_nomination.php?Action=Add&award_name_id=<?php echo $_GET['award_name_id']; ?>&award_year_id=<?php echo $_GET['award_year_id']; ?>&award_category_id=<?php echo  $rowa['id']; ?>"><?php echo $rowa['name']; ?></option>
                                    <?php } ?>

                                 </select> 

                                   <?php } else { ?>

<?php $award_category_id=$_GET['award_category_id'];
$sqlaci=mysqli_query($con, "select * from award_category where id='$award_category_id'");
$rowaci=mysqli_fetch_array($sqlaci);
echo $rowaci['name']; ?> (<a href="award_nomination.php?Action=Add&award_name_id=<?php echo $_GET['award_name_id']; ?>&award_year_id=<?php echo $rowa['id']; ?>" style="color:#F00; text-decoration: underline;">Reset</a>)
                              <?php } ?>


                              </div>


  <?php if(isset($_GET['award_category_id'])){ ?>

<div id="nominee" style="display: block;border: 1px solid black;padding: 14px;">

 

  <div class="tab-content">

    <div id="mainfather" class="tab-pane fade in active"> 

     <div class="mb-3 input-group repeatDiv" id="repeatDiv">


                <div class="form-group">

                                 <label>Nomination Name</label> <a href="#nominee_name" data-toggle="collapse" class="nominee_data_link">Select Data From Database</a>

  <div id="nominee_name" class="collapse nominee_data">

  <select class="form-control nominee_name_data" id="nominee_name_choice" name="nomination_table_name">

  <option value="">-Select Profession-</option>

   <? $choice=mysqli_query($con, "select * from profession order by profession_name");

                                  while($choice_exe=mysqli_fetch_array($choice)){ ?>



<option value="<? echo $choice_exe['table_name']; ?>"><? echo $choice_exe['profession_name']; ?></option>

                                  <? } ?>

  

  </select>

  </div>

  <input type="text" name="nomination_name" class="form-control nominee_manual_data" id="nominee_name_select_text"  placeholder="Enter Nomination" />

                                 <select class="form-control nominee nominee_data_from " id="nominee_name_select" name="nomination_table_id" placeholder="Enter Nomination" style="display:none;" >

                        

                         </select>


                         </div>

                         

                      

                           <div class="form-group">

                       <label>Is Winner</label>                       

                       <select class="form-control" id="Sequel" name="is_winner" >
                                      <option value="No">No</option>
                                     <option value="Yes">Yes</option>

                                </select>
                                 </div> 
            

<div class="form-group">
                                 <label>Film Name</label>

                                 <select name="film_id"  class="form-control js-select-2">

                                     <option value=""></option> 
                                  <?php $sqlf=mysqli_query($con, "select * from film");
                                  while($rowf=mysqli_fetch_array($sqlf)){ 
                                    $lang_code=$rowf["main_lang"];
                                    $lang_q="select * from dubbing where id='$lang_code'";
                                    $exe_lang=mysqli_query($con,$lang_q);
                                    $read_lang=mysqli_fetch_array($exe_lang);
                                    
                                    ?>


                                       <option value="<?php echo $rowf['id']; ?>"><?php echo $rowf['name']; ?>  (<?php echo $rowf['year_release']; ?>-<? echo $read_lang["name"];?>)</option> 
                                     <?php } ?>
                                 </select> 
                              </div>   



<div class="form-group">
                                 <label>Film Song</label>

                                 <select name="film_song_id"  class="form-control js-select-2">

                                     <option value=""></option> 
                                  <?php $sqlf=mysqli_query($con, "select * from film_song");
                                  while($rowf=mysqli_fetch_array($sqlf)){ ?>


                                       <option value="<?php echo $rowf['id']; ?>"><?php echo $rowf['title']; ?></option> 
                                     <?php } ?>
                                 </select> 
                              </div>   


<div class="form-group">
                                 <label>Music Videos</label>

                                 <select name="videosong_id"  class="form-control js-select-2">

                                     <option value=""></option> 
                                  <?php $sqlf=mysqli_query($con, "select * from videosong");
                                  while($rowf=mysqli_fetch_array($sqlf)){ ?>


                                       <option value="<?php echo $rowf['id']; ?>"><?php echo $rowf['title']; ?></option> 
                                     <?php } ?>
                                 </select> 
                              </div>   


            </div>


    </div>

    
  </div>


</div>
<?php } ?>



                              <div class="reset-button">

                                 <input type="hidden" name="award_name_id" value="<?php echo $_GET['award_name_id']; ?>">
                                 <input type="hidden" name="award_year_id" value="<?php echo $_GET['award_year_id']; ?>">
                                 <input type="hidden" name="award_category_id" value="<?php echo $_GET['award_category_id']; ?>">

                                   <input type="submit" name="Submit"  class="btn btn-add"  value="Add Record">
                            
                              </div>
                           </form>
<br><br>
                
              <?php if(isset($_GET['award_category_id'])){ ?>
                              <form name="form1" method="post" action="">
               <table class="table table-bordered"> 
                  <tr>
                     <th>Sl No</th> 
                     <th>Type</th>
                     <th>Table id</th>
                     <th>Name</th>
                     <th>Winner?</th>
                     <th>Film Name<br>
                        Film Song<br>
                     Videosong</th>
                  </tr>

<?php 
$award_name_id=$_GET['award_name_id'];
$award_year_id=$_GET['award_year_id'];
$award_category_id=$_GET['award_category_id'];

$sqln=mysqli_query($con, "select * from award_nomination where award_name_id='$award_name_id' and award_year_id='$award_year_id' and award_category_id='$award_category_id'");
while($rown=mysqli_fetch_array($sqln)){ ?>
   <tr>
     
                                            <td> <input type="text" name="sl_no[]" value="<?php    echo $row['sl_no'];   ?>" style="width: 30px;">

<input type="hidden" name="id[]" value="<?php    echo $row['id'];   ?>"></td> 
      <td><?php echo $rown['nomination_table_name']; 
$nomination_table_name=$rown['nomination_table_name'];
$nomination_table_id=$rown['nomination_table_id'];
$sqlntn=mysqli_query($con, "select * from ".$nomination_table_name." where id=".$nomination_table_id);
$rowntn=mysqli_fetch_array($sqlntn);
   ?></td>
      <td><?php echo $rowntn['name']; ?>(<?php echo $rown['nomination_table_id']; ?>)</td>
      <td><?php echo $rown['nomination_name']; ?></td> 
      <td><?php echo $rown['is_winner']; ?></td>
      <td>
         <?php $film_id= $rown['film_id'];
         $sqlf=mysqli_query($con, "select * from film where id='$film_id'");
         $rowf=mysqli_fetch_array($sqlf);
         echo $rowf['name']; ?><br>
         <?php $film_song_id= $rown['film_song_id'];
         $sqlfs=mysqli_query($con, "select * from film_song where id='$film_song_id'");
         $rowfs=mysqli_fetch_array($sqlfs);
         echo $rowfs['title']; ?><br>
         <?php $videosong_id= $rown['videosong_id'];
         $sqlv=mysqli_query($con, "select * from videosong where id='$videosong_id'");
         $rowv=mysqli_fetch_array($sqlv);
         echo $rowv['title']; ?><br>
         

      </td>

      <td>&nbsp;&nbsp;<a href="award_nomination.php?Action=Delete&award_name_id=<?php echo $_GET['award_name_id']; ?>&award_year_id=<?php echo $_GET['award_year_id']; ?>&award_category_id=<?php echo $_GET['award_category_id']; ?>&id=<?php echo $rown['id']; ?>" class="btn btn-danger">Delete</a></td>
   </tr>

<?php } ?>
</table>
 
 <input type="submit" name="UpdateSequence" value="UpdateSequence" class="btn btn-success"> 
 </form>


<?php } ?>




                        </div>
                     </div>
                  </div>
               </div>

<? } ?>











<? if($_GET['Action']=="Update"){  $id2=$_GET['id'];
$sql="select * from award_nomination where id='$id2'";
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
                                 <h4>Update award</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <div class="form-group">
                                 <label>Award name</label>

                                 <select name="award_name"  class="form-control">
                                    <?php $sqla=mysqli_query($con, "select * from award_name");
                                    while($rowa=mysqli_fetch_array($sqla)){?>
                                       <option value="<?php echo $rowa['id']; ?>"><?php echo $rowa['name']; ?></option>
                                    <?php } ?>

                                 </select> 
                              </div>
                     <div class="form-group">
                                 <label>Award Category</label>

                                 <select name="award_category"  class="form-control">
                                    <?php $sqla=mysqli_query($con, "select * from award_category");
                                    while($rowa=mysqli_fetch_array($sqla)){?>
                                       <option value="<?php echo $rowa['id']; ?>"><?php echo $rowa['name']; ?></option>
                                    <?php } ?>

                                 </select> 
                              </div>




<div class="form-group">
                                 <label>Nominee Type</label>

                                 <select name="nominee_type"  class="form-control">
                                  
                                       <option value="film">Film</option> 
                                       <option value="song">Song</option> 
                                       <option value="director">Director</option> 
                                       <option value="music_director">Music Director</option> 
                                       <option value="lyricist">Lyricist</option> 

                                 </select> 
                              </div>



                     <div class="form-group">
                                 <label>Award Year</label>
                                 <input type="number" name="award_year" class="form-control" placeholder="Update Award Year" value="<? echo $row['award_year'];?>"   >
                              </div>

 
                             
                              <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="reset-button">

                                 <input type="submit" name="Update" class="btn btn-add"   value="Update">
                                  
                              </div>
                           </form>
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
                                 <h4>award List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="award_nomination.php?Action=Add"> <i class="fa fa-plus"></i> Add award
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
    url: "search_award.php",
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

<input type="text" class="search form-control" id="searchid" placeholder="Search for award Film" style="width: 100%" />  
<div id="result"></div>
 

<br><br>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>Award Name</th>  
                                       <th> Category</th>  
                                       <th> Organiser</th>  
                                       <th> Year</th>  
                                       <th> Nominee Type</th>  
                                       <th> Nominee</th>  
                                       <th> Winner </th>  
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `award_nomination`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `award_nomination` order by id desc LIMIT $offset, $total_records_per_page");
 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                       <td><? $award_name= $row['award_name'];
$sqla=mysqli_query($con, "select * from award_name where id ='$award_name'");
$rowa=mysqli_fetch_array($sqla);
echo $rowa['name'];

                                        ?></td> 
                                       <td><? echo $rowa['organiser']; ?></td> 
                                       <td><? $award_category= $row['award_category'];
$sqla=mysqli_query($con, "select * from award_category where id ='$award_category'");
$rowa=mysqli_fetch_array($sqla);
echo $rowa['name'];

                                        ?></td> 
                                       <td><? echo $row['award_year']; ?></td> 
                                       <td><? echo $row['nominee_type']; ?></td> 
                                       <td><? echo $row['nominee_id']; ?></td> 
                                       <td><? echo $row['is_winner']; ?></td> 
                                        <td>
                                          <a href="award_nomination.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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





<script>



$(document).ready(function() { 

   $("#nominee_name_choice").on('change', function() {

        var nominee_name_choice = $(this).val();



        $.ajax({

            method: "POST",

            url: "ajax_data_bind.php",

            data: {

                nominee_name_choice: nominee_name_choice

            },

            datatype: "html",

            success: function(data) {

                $("#nominee_name_select").html(data);

               $('.nominee').select2();



            }

        });

    });

   
 
    

   

   

});
 

</script>


 