<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_GET['Action']=="ShowHome"){
    $id= $_GET['id'] ;  
    $show_on_home= $_GET['show_on_home'] ;
$sql=mysqli_query($con, "update music_arranged set show_on_home='$show_on_home' where id='$id'")or die(mysqli_error($con));
header('location:music_arranged.php?msg=success');
}

if($_POST["Submit"]) { 
    $name=mysqli_real_escape_string($con,$_POST['name']) ; 
    $real_name= mysqli_real_escape_string($con,$_POST['real_name']) ; 
    $nickname= mysqli_real_escape_string($con,$_POST['nickname']) ;  
    $dob= mysqli_real_escape_string($con,$_POST['dob']) ;  
    $dod= mysqli_real_escape_string($con,$_POST['dod']) ;   
    $details= mysqli_real_escape_string($con,$_POST['details']) ;
    $nationality= mysqli_real_escape_string($con,$_POST['nationality']) ;
    $born_country= mysqli_real_escape_string($con,$_POST['born_country']) ;
    $born_city= mysqli_real_escape_string($con,$_POST['born_city']) ;
    $father= mysqli_real_escape_string($con,$_POST['father']) ;
    $mother= mysqli_real_escape_string($con,$_POST['mother']) ;
    $spouse= mysqli_real_escape_string($con,$_POST['spouse']) ;
    $son= mysqli_real_escape_string($con,$_POST['son']) ;
    $daughter= mysqli_real_escape_string($con,$_POST['daughter']) ; 
    $facebook= mysqli_real_escape_string($con,$_POST['facebook']) ; 
    $twitter= mysqli_real_escape_string($con,$_POST['twitter']) ; 
    $instagram= mysqli_real_escape_string($con,$_POST['instagram']) ; 


    $img=$_FILES['filstor']['name'];
    $tmpName=$_FILES['filstor']['tmp_name']; 
    if($img<>"")
         {
            $ext = strrchr($img, ".");
            $prefix=str_replace(" ","-",$name);
            $newName = $prefix ."-". substr(md5(rand() * time()), 0, 5) . $ext;
            move_uploaded_file($tmpName,"photo/".$newName);
         } 


 
mysqli_query($con,"INSERT INTO `music_arranged` ( `name`,`real_name`,`nickname`,`nationality`,`born_country`,`born_city`,`father`,`mother`,`spouse`,`son`,`daughter`,`facebook`,`twitter`,`instagram`,`dob`,`dod`, `photo`, `details`) VALUES (  '$name','$real_name','$nickname', '$nationality','$born_country','$born_city','$father','$mother','$spouse','$son','$daughter','$facebook','$twitter','$instagram', '$dob','$dod', '$newName', '$details')") or die(mysqli_error($con));
  
            header('location:music_arranged.php?msg=success');
         }



           if($_POST["Update"]) {




    $id= $_POST['id'];
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $real_name=mysqli_real_escape_string($con,$_POST['real_name']);
    $nickname= mysqli_real_escape_string($con,$_POST['nickname']) ;  
    $dob= mysqli_real_escape_string($con,$_POST['dob']) ;  
    $dod= mysqli_real_escape_string($con,$_POST['dod']) ;  
     $details= mysqli_real_escape_string($con,$_POST['details']) ;
     $nationality= mysqli_real_escape_string($con,$_POST['nationality']) ;
    $born_country= mysqli_real_escape_string($con,$_POST['born_country']) ;
    $born_city= mysqli_real_escape_string($con,$_POST['born_city']) ;
    $father= mysqli_real_escape_string($con,$_POST['father']) ;
    $mother= mysqli_real_escape_string($con,$_POST['mother']) ;
    $spouse= mysqli_real_escape_string($con,$_POST['spouse']) ;
    $son= mysqli_real_escape_string($con,$_POST['son']) ;
    $daughter= mysqli_real_escape_string($con,$_POST['daughter']) ; 
    $facebook= mysqli_real_escape_string($con,$_POST['facebook']) ; 
    $twitter= mysqli_real_escape_string($con,$_POST['twitter']) ; 
    $instagram= mysqli_real_escape_string($con,$_POST['instagram']) ;   
$img=$_FILES['filstor']['name'];
$tmpName=$_FILES['filstor']['tmp_name'];
$oldimg=$_POST['oldimg'];

 if($img<>"")
   {
      $ext = strrchr($img, ".");
            $prefix=str_replace(" ","-",$name);
            $newName = $prefix ."-". substr(md5(rand() * time()), 0, 5) . $ext;
            move_uploaded_file($tmpName,"photo/".$newName);


   @unlink("photo/".$oldimg); 
   move_uploaded_file($tmpName,"photo/".$newName);

 }

else
{
$newName=$oldimg;
}

            mysqli_query($con,"update music_arranged set   name='$name',real_name='$real_name',nickname='$nickname',nationality='$nationality',born_country='$born_country',born_city='$born_city',father='$father',mother='$mother',spouse='$spouse',son='$son',daughter='$daughter',facebook='$facebook',twitter='$twitter',instagram='$instagram',dob='$dob',dod='$dod',photo='$newName',details='$details'   where id='$id'") or die(mysqli_error($con));
             header('location:music_arranged.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con, "delete from music_arranged where id='$_REQUEST[id]'");

header("location:music_arranged.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Music Arranged Add Form</title>
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
                  <h1>Music Arranged</h1>
                  <small>Music Arranged List</small>
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
                                 <h4>Add Music Arranged</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <div class="form-group">
                                 <label>name</label>
                                 <input type="text" class="form-control" name="name" placeholder="Enter name"  >
                              </div>
                              <div class="form-group">
                                 <label>real_name</label>
                                 <input type="text" class="form-control" name="real_name" placeholder="Enter real_name"  >
                              </div>
 <div class="form-group">
                                 <label>Nick name</label>
                                 <input type="text" class="form-control" name="nickname" placeholder="Enter Nick name"  >
                              </div>   




<div class="form-group">
                                 <label>Nationality</label>
                                 <input type="text" class="form-control" name="nationality" placeholder="Enter nationality"  >
                              </div>
<div class="form-group">
                                 <label>Born Country</label>
                                 <input type="text" class="form-control" name="born_country" placeholder="Enter Born Country"  >
                              </div>
<div class="form-group">
                                 <label>Born City</label>
                                 <input type="text" class="form-control" name="born_city" placeholder="Enter Born City"  >
                              </div>
<div class="form-group">
                                 <label>Father</label>
                                 <input type="text" class="form-control" name="father" placeholder="Enter Father"  >
                              </div>
<div class="form-group">
                                 <label>Mother</label>
                                 <input type="text" class="form-control" name="mother" placeholder="Enter Mother"  >
                              </div>
<div class="form-group">
                                 <label>Spouse</label>
                                 <input type="text" class="form-control" name="spouse" placeholder="Enter Spouse"  >
                              </div>
<div class="form-group">
                                 <label>Son</label>
                                 <input type="text" class="form-control" name="son" placeholder="Enter Son"  >
                              </div>
<div class="form-group">
                                 <label>Daughter</label>
                                 <input type="text" class="form-control" name="daughter" placeholder="Enter Daughter"  >
                              </div>
<div class="form-group">
                                 <label>Facebook</label>
                                 <input type="text" class="form-control" name="facebook" placeholder="Enter Facebook"  >
                              </div>
<div class="form-group">
                                 <label>Twitter</label>
                                 <input type="text" class="form-control" name="twitter" placeholder="Enter Twitter"  >
                              </div>
<div class="form-group">
                                 <label>Instagram</label>
                                 <input type="text" class="form-control" name="instagram" placeholder="Enter Instagram"  >
                              </div>



                               <div class="form-group">
                                 <label>DOB</label>
                                 <input type="text" class="form-control" name="dob" placeholder="Enter DOB"  >
                              </div> <div class="form-group">
                                 <label>DOD</label>
                                 <input type="text" class="form-control" name="dod" placeholder="Enter DOD"  >
                              </div>                            <div class="form-group">
                                 <label>Image</label>
                                   <input type="file"  name="filstor"  class="form-control">
                                  
                              </div>
                              

     <div class="form-group">
                                 <label>Details</label>
                                 <textarea name="details" rows="25"></textarea> 
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
$sql="select * from music_arranged where id='$id2'";
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
                                 <h4>Update Music Arranged</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <div class="form-group">
                                 <label>name</label>
                                 <input type="text" name="name" class="form-control" placeholder="Update name" value="<? echo $row['name'];?>"   >
                              </div> 
                              <div class="form-group">
                                 <label>real_name</label>
                                 <input type="text" name="real_name" class="form-control" placeholder="Update real_name" value="<? echo $row['real_name'];?>"   >
                              </div> 
                              
<?   if($row['show_on_home']=="1"){ ?> 
                                        <a  class="btn btn-primary" href="music_arranged.php?id=<? echo $row['id']; ?>&show_on_home=0&Action=ShowHome" style="color:#fff; font-weight: bold">Hide</a>
                                        <? } else{ ?>
                                        <a  class="btn btn-primary" href="music_arranged.php?id=<? echo $row['id']; ?>&show_on_home=1&Action=ShowHome">Show</a>
                                        <? } ?>
 
                             <div class="form-group">
                                 <label>Nick name</label>
                                 <input type="text" name="nickname" class="form-control" placeholder="Update Nick name" value="<? echo $row['nickname'];?>"   >
                              </div>   

<div class="form-group">
                                 <label>Nationality</label>
                                 <input type="text" class="form-control" name="nationality" placeholder="Enter nationality"  value="<? echo $row['nationality'];?>" >
                              </div>
<div class="form-group">
                                 <label>Born Country</label>
                                 <input type="text" class="form-control" name="born_country" placeholder="Enter Born Country"  value="<? echo $row['born_country'];?>" >
                              </div>
<div class="form-group">
                                 <label>Born City</label>
                                 <input type="text" class="form-control" name="born_city" placeholder="Enter Born City"  value="<? echo $row['born_city'];?>" >
                              </div>
<div class="form-group">
                                 <label>Father</label>
                                 <input type="text" class="form-control" name="father" placeholder="Enter Father"  value="<? echo $row['father'];?>" >
                              </div>
<div class="form-group">
                                 <label>Mother</label>
                                 <input type="text" class="form-control" name="mother" placeholder="Enter Mother"  value="<? echo $row['mother'];?>"  >
                              </div>
<div class="form-group">
                                 <label>Spouse</label>
                                 <input type="text" class="form-control" name="spouse" placeholder="Enter Spouse"   value="<? echo $row['spouse'];?>">
                              </div>
<div class="form-group">
                                 <label>Son</label>
                                 <input type="text" class="form-control" name="son" placeholder="Enter Son"  value="<? echo $row['son'];?>" >
                              </div>
<div class="form-group">
                                 <label>Daughter</label>
                                 <input type="text" class="form-control" name="daughter" placeholder="Enter Daughter"  value="<? echo $row['daughter'];?>"  >
                              </div>
<div class="form-group">
                                 <label>Facebook</label>
                                 <input type="text" class="form-control" name="facebook" placeholder="Enter Facebook"   value="<? echo $row['facebook'];?>">
                              </div>
<div class="form-group">
                                 <label>Twitter</label>
                                 <input type="text" class="form-control" name="twitter" placeholder="Enter Twitter" value="<? echo $row['twitter'];?>"  >
                              </div>
<div class="form-group">
                                 <label>Instagram</label>
                                 <input type="text" class="form-control" name="instagram" placeholder="Enter Instagram"  value="<? echo $row['instagram'];?>" >
                              </div>

     <div class="form-group">
                                 <label>DOB</label>
                                 <input type="text" name="dob" class="form-control" placeholder="Update DOB" value="<? echo $row['dob'];?>"   >
                              </div><div class="form-group">
                                 <label>DOD</label>
                                 <input type="text" name="dod" class="form-control" placeholder="Update DOD" value="<? echo $row['dod'];?>"   >
                              </div>
                                 <div class="form-group">
                                 <label>Image</label>
                                 <img src="photo/<? echo $row['photo']; ?>" width="100"> 
                                   <input type="file"  name="filstor"  class="form-control">
                                    <input type="hidden" name="oldimg" value="<? echo $row['photo']; ?>">
                                  
                              </div>   
                              

     <div class="form-group">
                                 <label>Details</label>
                                 <textarea name="details" rows="25"><? echo $row['details'];?></textarea> 
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
                                 <h4>Music Arranged List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="music_arranged.php?Action=Add"> <i class="fa fa-plus"></i> Add Music Arranged
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
    url: "search_director.php",
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

<input type="text" class="search form-control" id="searchid" placeholder="Search for music_arranged" style="width: 100%" />  
<div id="result"></div>
 

<br><br>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>Name</th> <th>Nick Name</th> 
                                       <th>DOB</th> 
                                       <th>DOD</th> 

                                                                              <th>Show on Home Page</th> 
                                       <th>Photo</th> 
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `music_arranged`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `music_arranged` order by show_on_home desc LIMIT $offset, $total_records_per_page");


 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                       <td><? echo $row['name']; ?></td>                                        <td><? echo $row['nickname']; ?></td> 
                                       <td><? echo $row['dob']; ?></td> 
                                       <td><? echo $row['dod']; ?></td>    <td><?   if($row['show_on_home']=="1"){ ?> 
                                        <a href="music_arranged.php?id=<? echo $row['id']; ?>&show_on_home=0&Action=ShowHome" style="color:#F00">Hide</a>
                                        <? } else{ ?>
                                        <a href="music_arranged.php?id=<? echo $row['id']; ?>&show_on_home=1&Action=ShowHome">Show</a>
                                        <? } ?></td> 
                                      <td> <img src="photo/<? echo $row['photo']; ?>" width="50"></td>
                                       <td>
                                         
                                          <a href="music_arranged.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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