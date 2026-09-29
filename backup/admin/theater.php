<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_POST["Submit"]) { 
    $pincode=mysqli_real_escape_string($con,$_POST['pincode']);
   $country_id=mysqli_real_escape_string($con,$_POST['country_id']);
    $city_id=mysqli_real_escape_string($con,implode(",",$_POST['city_id']));
    $state_id=mysqli_real_escape_string($con,$_POST['state_id']);  
    $chain_name=mysqli_real_escape_string($con,$_POST['chain_name']);
    $location=mysqli_real_escape_string($con,$_POST['location']);
     $url=mysqli_real_escape_string($con,$_POST['url']);
     $google_link=mysqli_real_escape_string($con,$_POST['google_link']);
     $single_screen=mysqli_real_escape_string($con,$_POST['single_screen']);
     $multiplex=mysqli_real_escape_string($con,$_POST['multiplex']);
     $dx=mysqli_real_escape_string($con,$_POST['dx']);
     $imax=mysqli_real_escape_string($con,$_POST['imax']);
     $cinema_name=mysqli_real_escape_string($con,$_POST['cinema_name']);
     $cinema_company_link=mysqli_real_escape_string($con,$_POST['cinema_company_link']);
     $mall_complex=mysqli_real_escape_string($con,$_POST['mall_complex']);
     $luxe=mysqli_real_escape_string($con,$_POST['luxe']);
     $dolby_cinema=mysqli_real_escape_string($con,$_POST['dolby_cinema']);
     $dolby_sound=mysqli_real_escape_string($con,$_POST['dolby_sound']);
     $if_yes=mysqli_real_escape_string($con,$_POST['if_yes']);
     $number_of_screens=mysqli_real_escape_string($con,$_POST['number_of_screens']);
     $sitting_capacity=mysqli_real_escape_string($con,$_POST['sitting_capacity']);
mysqli_query($con,"INSERT INTO theater (pincode,country_id,state_id,city_id,location,chain_name,url,cinema_company_link,google_link,single_screen,multiplex,dx,imax,cinema_name,mall_complex,luxe,dolby_cinema,dolby_sound,if_yes,number_of_screens,sitting_capacity)
VALUES ('$pincode','$country_id','$state_id','$city_id','$location','$chain_name','$url','$cinema_company_link','$google_link','$single_screen','$multiplex','$dx','$imax','$cinema_name','$mall_complex','$luxe','$dolby_cinema','$dolby_sound','$if_yes','$number_of_screens','$sitting_capacity')") or die(mysqli_error($con));
  
            header('location:theater.php?msg=success');
         }



           if($_POST["Update"]) {



 $id=mysqli_real_escape_string($con,$_POST['id']);
    $pincode=mysqli_real_escape_string($con,$_POST['pincode']);
   $country_id=mysqli_real_escape_string($con,$_POST['country_id']);
    $city_id=mysqli_real_escape_string($con,implode(",",$_POST['city_id']));
    $state_id=mysqli_real_escape_string($con,$_POST['state_id']);  
    $chain_name=mysqli_real_escape_string($con,$_POST['chain_name']);
    $location=mysqli_real_escape_string($con,$_POST['location']);
     $url=mysqli_real_escape_string($con,$_POST['url']);
 $google_link=mysqli_real_escape_string($con,$_POST['google_link']);
     $cinema_company_link=mysqli_real_escape_string($con,$_POST['cinema_company_link']);
  $single_screen=mysqli_real_escape_string($con,$_POST['single_screen']);
     $multiplex=mysqli_real_escape_string($con,$_POST['multiplex']);
     $dx=mysqli_real_escape_string($con,$_POST['dx']);
     $imax=mysqli_real_escape_string($con,$_POST['imax']);
     $cinema_name=mysqli_real_escape_string($con,$_POST['cinema_name']);
     $mall_complex=mysqli_real_escape_string($con,$_POST['mall_complex']);
     $luxe=mysqli_real_escape_string($con,$_POST['luxe']);
     $dolby_cinema=mysqli_real_escape_string($con,$_POST['dolby_cinema']);
     $dolby_sound=mysqli_real_escape_string($con,$_POST['dolby_sound']);
     $if_yes=mysqli_real_escape_string($con,$_POST['if_yes']);
     $number_of_screens=mysqli_real_escape_string($con,$_POST['number_of_screens']);
     $sitting_capacity=mysqli_real_escape_string($con,$_POST['sitting_capacity']);

            mysqli_query($con,"update theater set country_id='$country_id',pincode='$pincode',state_id='$state_id',city_id='$city_id',location='$location',chain_name='$cinema_chain',url='$url',google_link='$google_link',cinema_company_link='$cinema_company_link',single_screen='$single_screen',multiplex='$multiplex',dx='$dx',imax='$imax',cinema_name='$cinema_name',mall_complex='$mall_complex',luxe='$luxe',dolby_cinema='$dolby_cinema',dolby_sound='$dolby_sound',if_yes='$if_yes',number_of_screens='$number_of_screens',sitting_capacity='$sitting_capacity' where id='$id'") or die(mysql_error());
             header('location:theater.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con, "delete from theater where id='$_REQUEST[id]'");

header("location:theater.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Theater Management</title>
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
                  <h1>Theater</h1>
                  <small>Theater List</small>
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
                                 <h4>Add Theater</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <div class="form-group">
                                 <label>Select Cinema Chain Name</label>
                                <select class="form-control" id="cinema_chain" name="cinema_chain" required>
                                 <option value="">-Select Cinema Chain Name-</option>
                                 <?
                                $select_country="select * from cinema_chain ";
                                $exe_country=mysqli_query($con,$select_country);
                                while($read_country=mysqli_fetch_array($exe_country)){
                                   ?>
                                   <option value="<?echo $read_country["id"]?>"><?echo $read_country["name"]?></option>
                                   <? } ?>
                              
                                </select>
                              </div> 
                               <div class="form-group">
                                 <label>Cinema Name</label>
                                 <input type="text"  class="form-control" name="cinema_name" placeholder="Enter Cinema Name" />
                              </div>
                             <div class="form-group">
                                 <label>Select Country</label>
                                <select class="form-control" id="country_id" name="country_id" required>
                                 <option value="">-Select Country-</option>
                                 <?
                                $select_country="select * from  country1";
                                $exe_country=mysqli_query($con,$select_country);
                                while($read_country=mysqli_fetch_array($exe_country)){
                                   ?>
                                   <option value="<?echo $read_country["id"]?>"><?echo $read_country["country_name"]?></option>
                                   <? } ?>
                              
                                </select>
                              </div>  
                              <div class="form-group">
                                 <label>State</label>
                                 <select name="state_id" class="form-control">
                                  <option value="">-Select State-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from state1");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>" <? if($_GET['state_id']== $rowfr['id']){ echo "selected"; } ?>><? echo $rowfr['state']; ?></option>
                                  <? } ?>
                                 </select>
                            
                              </div>
                              <div class="form-group">
                                 <label>City</label><br/>
                                 <select name="city_id[]" class="form-control city"  multiple="multiple">
                                  <option value="">-Select City-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from city1");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>" <? if($_GET['city_id']== $rowfr['id']){ echo "selected"; } ?>><? echo $rowfr['city']; ?></option>
                                  <? } ?>
                                 </select>
                            
                              </div>
                               <div class="form-group">
                                 <label>Pincode</label>
                                 <select name="pincode" class="form-control">
                                  <option value="">-Select State-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from pincode");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>" <? if($_GET['pincode']== $rowfr['id']){ echo "selected"; } ?>><? echo $rowfr['pincode']; ?></option>
                                  <? } ?>
                                 </select>
                            
                              </div>
                              <div class="form-group">
                                 <label>Address</label>
                                 <textarea type="text" class="form-control" name="location" placeholder="Enter Location"  rows="4" cols="50"></textarea>
                              </div>
                              <div class="form-group">
                                 <label>Bookmy Show Link</label>
                                 <input type="text"  class="form-control" name="url" placeholder="Enter Link" />
                              </div>
                               <div class="form-group">
                                 <label>Cinema Company Official Link</label>
                                 <input type="text"  class="form-control" name="cinema_company_link"  placeholder="Enter Link" />
                              </div>
                               <div class="form-group">
                                 <label>Google Location Link</label>
                                 <input type="text"  class="form-control" name="google_link"  placeholder="Enter Link" />
                              </div>
                              
                              
                              <div class="form-group">
                                 <label>Select Mall/Complex Name</label>
                                <select class="form-control" id="mall/complex" name="mall/complex" required>
                                 <option value="">-Select Mall/Complex Name-</option>
                                 <?
                                $mall_complex="select * from mall_complex ";
                                $exe_mall_complex=mysqli_query($con,$mall_complex);
                                while($mall_complex=mysqli_fetch_array($exe_mall_complex)){
                                   ?>
                                   <option value="<?echo $mall_complex["id"]?>"><?echo $mall_complex["mall_complex_name"]?></option>
                                   <? } ?>
                              
                                </select>
                              </div>
                            <div class="form-group">
                                 <label>Single Screen</label>
                                 <select name="single_screen" class="form-control">
                                  <option value="">-Select-</option>
                                  <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                                  </select>
                           </div>
                           <div class="form-group">
                                 <label>Multiplex</label>
                                 <select name="multiplex" class="form-control">
                                  <option value="">-Select-</option>
                                  <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                                  </select>
                           </div>
                           <div class="form-group">
                                 <label>4DX</label>
                                 <select name="dx" class="form-control">
                                  <option value="No">No</option>
                                  <option value="Yes">Yes</option>
                                  
                                  </select>
                           </div>
                            <div class="form-group">
                                 <label>IMAX</label>
                                 <select name="imax" class="form-control">
                                  <option value="No">No</option>
                                  <option value="Yes">Yes</option>
                                  
                                  </select>
                           </div>
                           <div class="form-group">
                                 <label>LUXE</label>
                                 <select name="luxe" class="form-control">
                                  <option value="No">No</option>
                                  <option value="Yes">Yes</option>
                                  
                                  </select>
                           </div>
                           <div class="form-group">
                                 <label>Dolby Cinema</label>
                                 <select name="dolby_cinema" class="form-control">
                                  <option value="No">No</option>
                                  <option value="Yes">Yes</option>
                                  
                                  </select>
                           </div>
                           <div class="form-group">
                                 <label>Dolby Sound</label>
                                 <select name="dolby_sound" class="form-control">
                                  <option value="No">No</option>
                                  <option value="Yes">Yes</option>
                                  
                                  </select>
                           </div>
                           <div class="form-group">
                                 <label>If yes</label>
                                 <select name="if_yes" class="form-control">
                                  <option value="No">5.1</option>
                                  <option value="Yes">7.1</option>
                                  
                                  </select>
                           </div>
                           <div class="form-group">
                                 <label>Number of Screens</label>
                                 <input type="text"  class="form-control" name=" number_of_screens" placeholder="" />
                              </div>
                              <div class="form-group">
                                 <label>Total Sitting Capacity</label>
                                 <input type="text"  class="form-control" name="Sitting_capacity" placeholder="" />
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
$sql="select * from theater where id='$id2'";
$rs=mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs);

$chain_id=$row['chain_name']; 
$chain_name_q="select * from cinema_chain where id='$chain_id'";
$chain_name_exe=mysqli_query($con,$chain_name_q);
$read_chain_name=mysqli_fetch_array($chain_name_exe);

$country_id=$row['country_id']; 
$country_name_q="select * from country1 where id='$country_id'";
$country_name_exe=mysqli_query($con,$country_name_q);
$read_country_name=mysqli_fetch_array($country_name_exe);

$state_id=$row['state_id']; 
$state_name_q="select * from state1 where id='$state_id'";
$state_name_exe=mysqli_query($con,$state_name_q);
$read_state_name=mysqli_fetch_array($state_name_exe);

$pincode=$row['pincode']; 
$pincode_q="select * from pincode where id='$pincode'";
$pincode_q_exe=mysqli_query($con,$pincode_q);
$read_pincode_name=mysqli_fetch_array($pincode_q_exe);
                                     
?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Update Theater</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                                  <div class="form-group">
                                 <label>Select Cinema Chain Name</label>
                                <select class="form-control" id="cinema_chain" name="cinema_chain" required>
                                 <option value="<? echo $read_chain_name['id'];?>"><? echo $read_chain_name["name"];?></option>
                                 <?
                                $select_country="select * from cinema_chain";
                                $exe_country=mysqli_query($con,$select_country);
                                while($read_country=mysqli_fetch_array($exe_country)){
                                   ?>
                                   <option value="<?echo $read_country["id"]?>"><?echo $read_country["name"]?></option>
                                   <? } ?>
                              
                                </select>
                              </div> 
                              <div class="form-group">
                                 <label>Cinema Name</label>
                                 <input type="text"  class="form-control" name="cinema_name" value="<? echo $row["cinema_name"]?>" placeholder="Enter Cinema Name" />
                              </div>
                             <div class="form-group">
                                 <label>Select Country</label>
                                <select class="form-control" id="country_id" name="country_id" required>
                                 <option value="<? echo $read_country_name['id']; ?>"><? echo $read_country_name["country_name"]; ?> </option>
                                 <?
                                $select_country="select * from  country1";
                                $exe_country=mysqli_query($con,$select_country);
                                while($read_country=mysqli_fetch_array($exe_country)){
                                   ?>
                                   <option value="<?echo $read_country["id"]?>"><?echo $read_country["country_name"]?></option>
                                   <? } ?>
                              
                                </select>
                              </div>  
                              <div class="form-group">
                                 <label>State</label>
                                 <select name="state_id" class="form-control">
                                  <option value="<? echo $read_state_name['id'];?>"><? echo $read_state_name["state"];?></option>
                                  <? $sqlfr=mysqli_query($con, "select * from state1");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>" <? if($_GET['state_id']== $rowfr['id']){ echo "selected"; } ?>><? echo $rowfr['state']; ?></option>
                                  <? } ?>
                                 </select>
                            
                              </div>
                              <div class="form-group">
                                 <label>City</label><br/>
                                 <select name="city_id[]" class="form-control city" multiple="multiple">
                                <?
                                  $city_id=explode(",",$row['city_id']);
                                  foreach($city_id as $city){
$city_name_q="select * from city1 where id='$city'";
$city_name_exe=mysqli_query($con,$city_name_q);
 $read_city_name=mysqli_fetch_array($city_name_exe);
?>
                                  <option value="<? echo $read_city_name['id'];?>" selected><? echo $read_city_name["city"];?></option>
                                  <? } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from city1");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>" <? if($_GET['city_id']== $rowfr['id']){ echo "selected"; } ?>><? echo $rowfr['city']; ?></option>
                                  <? } ?>
                                 </select>
                            
                              </div>
                               <div class="form-group">
                                 <label>Pincode</label>
                                 <select name="pincode" class="form-control">
                                  <option value="<? echo $read_pincode_name["id"];?>"><? echo $read_pincode_name["pincode"];?></option>
                                  <? $sqlfr=mysqli_query($con, "select * from pincode");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>" <? if($_GET['pincode']== $rowfr['id']){ echo "selected"; } ?>><? echo $rowfr['pincode']; ?></option>
                                  <? } ?>
                                 </select>
                            
                              </div>
                              <div class="form-group">
                                 <label>Bookmy Show Link</label>
                                 <input type="text"  class="form-control" name="url" value="<? echo $row['url'];?>" placeholder="Enter Link" />
                              </div>
                               <div class="form-group">
                                 <label>Cinema Company Offical Link</label>
                                 <input type="text"  class="form-control" name="cinema_company_link" value="<? echo $row['cinema_company_link'];?>" placeholder="Enter Link" />
                              </div>
                               <div class="form-group">
                                 <label>Google Location Link</label>
                                 <input type="text"  class="form-control" name="google_link" value="<? echo $row['google_link'];?>" placeholder="Enter Link" />
                              </div>
                              <div class="form-group">
                                 <label>Address</label>
                                 <textarea type="text" class="form-control" name="location" placeholder="Enter Location"  rows="4" cols="50"><? echo $row['location'];?></textarea>
                              </div>
                           	 <div class="form-group">
                                 <label>Single Screen</label>
                                 <select name="single_screen" class="form-control">
                                  <option value="<? echo $row['single_screen'];?>"><? echo $row['single_screen'];?></option>
                                  <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                                  </select>
                           </div>
                           <div class="form-group">
                                 <label>Multiplex</label>
                                 <select name="multiplex" class="form-control">
                                  <option value="<? echo $row['multiplex'];?>"><? echo $row['multiplex'];?></option>
                                  <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                                  </select>
                           </div>
                           <div class="form-group">
                                 <label>4DX</label>
                                 <select name="dx" class="form-control">
                                  <option value="<? echo $row['dx'];?>"><? echo $row['dx'];?></option>
                                  <option value="No">No</option>
                                  <option value="Yes">Yes</option>
                                  
                                  </select>
                           </div>
                            <div class="form-group">
                                 <label>IMAX</label>
                                 <select name="imax" class="form-control">
                                  <option value="<? echo $row['imax'];?>"><? echo $row['imax'];?></option>
                                  <option value="No">No</option>
                                  <option value="Yes">Yes</option>
                                  
                                  </select>
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
                                 <h4>Theater List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="theater.php?Action=Add"> <i class="fa fa-plus"></i> Add Theater
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
    url: "search_theater.php",
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

<input type="text" class="search form-control" id="searchid" placeholder="Search for Theater Chain Name" style="width: 100%" />  
<div id="result"></div>
 

<br><br>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                    <th>S.N</th>
                                       <th>Cinema Chain</th> 
                                        <th>Cinema Name</th> 
                                       <th>Country</th> 
                                       <th>State</th>
                                       <th>City</th>
                                       <th>Pin Code</th>
                                       <th>Address</th>
                                       <th>Links</th>
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `theater`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `theater` order by id desc LIMIT $offset, $total_records_per_page");
$sn=1;
 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           <th><? echo $sn ?></th>
                                       <td>
                                       <? 
                                       
                                       $chain_id=$row['chain_name']; 
                                       $chain_name_q="select * from cinema_chain where id='$chain_id'";
                                       $chain_name_exe=mysqli_query($con,$chain_name_q);
                                       $read_chain_name=mysqli_fetch_array($chain_name_exe);
                                       echo $read_chain_name["name"];
                                       
                                       ?>
                                       </td> 
                                       <? echo $row['cinema_name']; ?>
                                       <td>
                                       </td>
                                      <td><? 
                                      $country_id=$row['country_id']; 
                                       $country_name_q="select * from country1 where id='$country_id'";
                                       $country_name_exe=mysqli_query($con,$country_name_q);
                                       $read_country_name=mysqli_fetch_array($country_name_exe);
                                       echo $read_country_name["country_name"];
                                      
                                       ?></td>
                                       <td>
                                       <? 
                                      $state_id=$row['state_id']; 
                                       $state_name_q="select * from state1 where id='$state_id'";
                                       $state_name_exe=mysqli_query($con,$state_name_q);
                                       $read_state_name=mysqli_fetch_array($state_name_exe);
                                       echo $read_state_name["state"];
                                      
                                       ?>
                                       </td>
                                        <td> <? 
                                      $city_id=explode(",",$row['city_id']);
                                      foreach($city_id as $city){
                                       $city_name_q="select * from city1 where id='$city'";
                                       $city_name_exe=mysqli_query($con,$city_name_q);
                                       $read_city_name=mysqli_fetch_array($city_name_exe);
                                      echo $read_city_name["city"],'<br/>';
                                      }
                                      
                                       ?></td>
                                         <td> <? 
                                      $pincode=$row['pincode']; 
                                       $pincode_q="select * from pincode where id='$pincode'";
                                       $pincode_q_exe=mysqli_query($con,$pincode_q);
                                       $read_pincode_name=mysqli_fetch_array($pincode_q_exe);
                                       echo $read_pincode_name["pincode"];
                                      
                                       ?></td>
                                          <td><? echo $row['location']; ?></td>
                                           <td>
                                          <b>Google Location:</b><a href="http://maps.google.com/?q=<? echo $row['google_link']; ?>" target="_blank">Google Direction</a><br/>

                                           <b>Bookmy Show:</b><a href="<? echo $row['url']; ?>" target="_blank">Bookmy Show</a><br/>
                                           <b>Cinema Company:</b><a href="<? echo $row['cinema_company_link']; ?>" target="_blank">Cinema Company </a><br/>
                                           
                                           </td>
                                       <td>
                                          <a href="theater.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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
                 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <!-- End Theme label Script
         =====================================================================-->
   </body>
 
</html>

<script>
 $(document).ready(function() {
    $('.city').select2();
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