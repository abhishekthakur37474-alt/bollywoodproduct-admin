<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
 

if($_POST["Submit"]) { 
    $binaca_geetmala_id = $_POST['binaca_geetmala_id'] ;  
    $song_rank= $_POST['song_rank'] ;  
    $song_id= $_POST['song_id'] ;    
    $is_sartaj_song= $_POST['is_sartaj_song'] ;   
    $broadcast_date= $_POST['broadcast_date'] ;   
 

 
mysqli_query($con,"INSERT INTO `binaca_geetmala_songs` ( binaca_geetmala_id, song_rank, song_id, is_sartaj_song, broadcast_date ) VALUES (  '$binaca_geetmala_id', '$song_rank' , '$song_id'  , '$is_sartaj_song' , '$broadcast_date'    )") or die(mysqli_error($con));
  
            header('location:binaca_geetmala_songs.php?Action=Add&binaca_geetmala_id='.$binaca_geetmala_id);
         }



           if($_POST["Update"]) {




    $id= $_POST['id']; 
    $binaca_geetmala_id = $_POST['binaca_geetmala_id'] ;  
    $song_rank= $_POST['song_rank'] ;  
    $song_id= $_POST['song_id'] ;    
    $is_sartaj_song= $_POST['is_sartaj_song'] ;    
    $broadcast_date= $_POST['broadcast_date'] ;  
 
            mysqli_query($con,"update binaca_geetmala_songs set   binaca_geetmala_id='$binaca_geetmala_id', song_rank='$song_rank' , song_id='$song_id'   , is_sartaj_song='$is_sartaj_song'  , broadcast_date='$broadcast_date'    where id='$id'") or die(mysqli_error($con));
             header('location:binaca_geetmala_songs.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){  
mysqli_query($con, "delete from binaca_geetmala_songs where id='$_REQUEST[id]'");

header("location:binaca_geetmala_songs.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>binaca_geetmala_songs Management</title>
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

      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
       <script src="https://cdn.tiny.cloud/1/qyhq7trksx7i1gpmasi3h8szpuzmiuj9c3epa0k2hjpuszlk/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
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
                  <h1>binaca_geetmala_songs</h1>
                  <small>binaca_geetmala_songs List</small>
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
                                 <h4>Add binaca_geetmala_songs</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                            
   <div class="form-group">
                                 <label>Binaca Geetmala Year</label>
                                                           
<select name="binaca_geetmala_id" class="form-control" > 
   <option value=""></option>

   <?php $sqlbg=mysqli_query($con, "select * from binaca_geetmala");
   while($rowbg=mysqli_fetch_array($sqlbg)){ ?>
      <option value="<?php echo $rowbg['id']; ?>" <?php if($rowbg['id']==$_GET['binaca_geetmala_id']){echo "selected"; } ?>><?php echo $rowbg['year']; ?></option>
   <?php } ?> 
</select>
                              </div>

     <div class="form-group">
                                 <label>Song Rank</label>
                                 <input type="text" name="song_rank" class="form-control" placeholder="Add Song Rank" value="<? echo $row['song_rank'];?>"   >
                              </div>

   <div class="form-group">
                                 <label>Song</label>
                                                           
<select name="song_id" class="form-control js-example-basic-single"  >
   <option value=""></option>
   <?php $sqlsong=mysqli_query($con, "select * from film_song");
   while($rowsong=mysqli_fetch_array($sqlsong)){ ?>
      <option value="<?php echo $rowsong['id']; ?>"><?php echo $rowsong['title']; ?></option>
   <?php } ?> 
</select>
                              </div>

                             
                            

  <div class="form-group">
                                 <label>Is Sartaj Song</label>
                   
                   <select name="is_sartaj_song" class="form-control" >
                     
                      <option value="No">No</option>
                       <option value="Yes">Yes</option>
                   </select>
                              </div>                          

  <div class="form-group">
                                 <label>Broadcast Date</label>
                   
                   <select name="broadcast_date" class="form-control" >
                       <option value="0" <?php if($row['broadcast_date']=="0"){ echo "selected"; } ?>>Single Part</option>
                      <option value="1">Broadcast Date 1</option>
                      <option value="2">Broadcast Date 2</option> 
                   </select>
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
$sql="select * from binaca_geetmala_songs where id='$id2'";
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
                                 <h4>Update binaca_geetmala_songs</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                                   
    <div class="form-group">
                                 <label>Binaca Geetmala Year</label>
                                                           
<select name="binaca_geetmala_id" class="form-control"  > 
   <?php $sqlbg=mysqli_query($con, "select * from binaca_geetmala");
   while($rowbg=mysqli_fetch_array($sqlbg)){ ?>
      <option value="<?php echo $rowbg['id']; ?>" <?php if($rowbg['id']==$row['binaca_geetmala_id']){echo "selected"; } ?>><?php echo $rowbg['year']; ?></option>
   <?php } ?> 
</select>
                              </div>

     <div class="form-group">
                                 <label>Song Rank</label>
                                 <input type="text" name="song_rank" class="form-control" placeholder="Add Song Rank" value="<? echo $row['song_rank'];?>"   >
                              </div>

   <div class="form-group">
                                 <label>Song</label>
                                                           
<select name="song_id" class="form-control js-example-basic-single" >
   <option value=""></option>
   <?php $sqlsong=mysqli_query($con, "select * from film_song");
   while($rowsong=mysqli_fetch_array($sqlsong)){ ?>
      <option value="<?php echo $rowsong['id']; ?>" <?php if($rowsong['id']==$row['song_id']){echo "selected"; } ?>><?php echo $rowsong['title']; ?></option>
   <?php } ?> 
</select>
                              </div>

                             
                            

  <div class="form-group">
                                 <label>Is Sartaj Song</label>
                   
                   <select name="is_sartaj_song" class="form-control" >
                     
                      <option value="No" <?php if($row['is_sartaj_song']=="No"){ echo "selected"; } ?>>No</option>
                       <option value="Yes" <?php if($row['is_sartaj_song']=="Yes"){ echo "selected"; } ?>>Yes</option>
                   </select>
                              </div>

  
  <div class="form-group">
                                 <label>Broadcast Date</label>
                   
                   <select name="broadcast_date" class="form-control" >
                     
                      <option value="0" <?php if($row['broadcast_date']=="0"){ echo "selected"; } ?>>Single Part</option>
                      <option value="1" <?php if($row['broadcast_date']=="1"){ echo "selected"; } ?>>Broadcast Date 1</option>
                      <option value="2" <?php if($row['broadcast_date']=="2"){ echo "selected"; } ?>>Broadcast Date 2</option> 
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
                                 <h4>binaca_geetmala_songs List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="binaca_geetmala_songs.php?Action=Add"> <i class="fa fa-plus"></i> Add binaca_geetmala_songs
                                 </a>  
                              </div>
                            
                           </div>


  
 
 <select  name="song_id" class="form-control js-example-basic-single"  onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <?php $sqlbgs=mysqli_query($con, "select * from binaca_geetmala_songs");
    while($rowbgs=mysqli_fetch_array($sqlbgs)){ 
      $song_id=$rowbgs['song_id'];
      $sqls=mysqli_query($con, "select * from film_song where id='$song_id'");
      $rows=mysqli_fetch_array($sqls);
     
      ?>
      <option value="binaca_geetmala_songs.php?Action=Update&id=<?php echo $rowbgs['id']; ?>"><?php echo $rows['title']; ?></option>
    <?php } ?>

 </select>

<br><br>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>Year</th>  
                                       <th>Song Rank</th>  
                                       <th>Song (Film)</th>  
                                       <th>Is Sartaj Song</th>
                                       <th>BroadcastDate</th>
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `binaca_geetmala_songs`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `binaca_geetmala_songs` order by id desc LIMIT $offset, $total_records_per_page");
 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                       <td><? 


                                       $binaca_geetmala_id = $row['binaca_geetmala_id'];
$sqlbg=mysqli_query($con, "select * from binaca_geetmala where id='$binaca_geetmala_id'");
$rowbg=mysqli_fetch_array($sqlbg);
echo $rowbg['year']; 
                                        ?></td> 
                                       <td><? echo $row['song_rank']; ?></td> 
                                       <td><? $song_id= $row['song_id'];
$sql_song=mysqli_query($con, "select * from film_song where id='$song_id'");
$row_song=mysqli_fetch_array($sql_song);
$film_id=$row_song['film_id'];
$sql_film=mysqli_query($con, "select * from film where id='$film_id'");
$row_film=mysqli_fetch_array($sql_film);

echo $row_song['title']; ?> [<?php echo $row_film['name']; ?>]</td> 

                                       <td><? echo $row['is_sartaj_song']; ?></td> 
                                       <td><? echo $row['broadcast_date']; ?></td> 
                                        <td>


                                  
                                          <a href="binaca_geetmala_songs.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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
         <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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


$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

</script>