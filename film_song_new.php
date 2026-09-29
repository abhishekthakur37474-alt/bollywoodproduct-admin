<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_POST["Submit"]) {
$singer_id= mysqli_real_escape_string($con,implode(",",$_POST['singer_id']));
$language= mysqli_real_escape_string($con,implode(",",$_POST['language']));
$genre= mysqli_real_escape_string($con,implode(",",$_POST['genre']));
$music_director= mysqli_real_escape_string($con,implode(",",$_POST['music_director']));
$music_producer= mysqli_real_escape_string($con,implode(",",$_POST['music_producer']));
$composer= mysqli_real_escape_string($con,implode(",",$_POST['composer']));
$arranged= mysqli_real_escape_string($con,implode(",",$_POST['arranged']));
$programmer= mysqli_real_escape_string($con,implode(",",$_POST['programmer']));
$mixed= mysqli_real_escape_string($con,implode(",",$_POST['mixed']));
$matered= mysqli_real_escape_string($con,implode(",",$_POST['matered']));
$lyricist= mysqli_real_escape_string($con,implode(",",$_POST['lyricist']));
$additional_lyrics= mysqli_real_escape_string($con,implode(",",$_POST['additional_lyrics']));
$rap= mysqli_real_escape_string($con,implode(",",$_POST['rap']));
$choreographer= mysqli_real_escape_string($con,implode(",",$_POST['choreographer']));
$performance= mysqli_real_escape_string($con,implode(",",$_POST['performance']));
$label= mysqli_real_escape_string($con,implode(",",$_POST['label']));
$award= $_POST['award'] ;
$song_upload_date= $_POST['song_upload_date'] ;
$song_upload_month= $_POST['song_upload_month'] ;
$song_upload_year= $_POST['song_upload_year'] ;
$best_song= $_POST['best_song'] ;
$youtube_upload_date= $_POST['youtube_upload_date'] ;
$youtube_upload_month= $_POST['youtube_upload_month'] ;
$youtube_upload_year= $_POST['youtube_upload_year'] ;
$youtube_video_viwe= $_POST['youtube_video_viwe'] ;
$original_credit= $_POST['original_credit'] ;
$original_lyricist= mysqli_real_escape_string($con,implode(",",$_POST['original_lyricist']));
$original_singer= mysqli_real_escape_string($con,implode(",",$_POST['original_singer']));
$original_music= mysqli_real_escape_string($con,implode(",",$_POST['original_music']));
$original_release_date= $_POST['original_release_date'] ;
$original_release_year= $_POST['original_release_year'] ;


    $title= $_POST['title'] ;
    $youtube= $_POST['youtube'] ;  
    $eng_lyrics= $_POST['eng_lyrics'] ;
    $hin_lyrics= $_POST['hin_lyrics'] ;  
    $img=$_FILES['filstor']['name'];
    $tmpName=$_FILES['filstor']['tmp_name']; 
    if($img<>"")
         {
            $ext = strrchr($img, ".");
            $prefix=str_replace(" ","-",$name);
            $newName = $prefix ."-". substr(md5(rand() * time()), 0, 5) . $ext;
            move_uploaded_file($tmpName,"photo/".$newName);
         } 


 
 mysqli_query($con,"INSERT INTO `videosong` ( `singer_id`, `title`, `photo`, `youtube`, `eng_lyrics`,`hin_lyrics`,`language`,`genre`,`music_director`,`composer`,`arranged`,`programmer`,`mixed`,`matered`,`lyricist`,`additional_lyrics`,`rap`,`choreographer`,`performance`,`label`,`award`,`song_upload_date`,`song_upload_month`,`song_upload_year`,`best_song`,`youtube_upload_date`,`youtube_upload_month`,`youtube_upload_year`,`youtube_video_viwe`,`original_credit`,`original_singer`,`original_lyricist`,`original_music`,`original_release_date`,`original_release_year`,`music_producer`) VALUES ( '$singer_id', '$title', '$newName', '$youtube', '$eng_lyrics','$hin_lyrics','$language','$genre','$music_director','$composer','$arranged','$programmer','$mixed','$matered','$lyricist','$additional_lyrics','$rap','$choreographer','$performance','$label','$award','$song_upload_date','$song_upload_month','$song_upload_year','$best_song','$youtube_upload_date','$youtube_upload_month','$youtube_upload_year','$youtube_video_viwe','$original_credit','$original_singer','$original_lyricist','$original_music','$original_release_date','$original_release_year','$music_producer')") or die(mysqli_error($con));
  
            header('location:videosong.php?msg=success');
         }



           if($_POST["Update"]) {

    $id= $_POST['id'];
   $singer_id= mysqli_real_escape_string($con,implode(",",$_POST['singer_id']));
$language= mysqli_real_escape_string($con,implode(",",$_POST['language']));
$genre= mysqli_real_escape_string($con,implode(",",$_POST['genre']));
$music_director= mysqli_real_escape_string($con,implode(",",$_POST['music_director']));
$music_producer= mysqli_real_escape_string($con,implode(",",$_POST['music_producer']));
$composer= mysqli_real_escape_string($con,implode(",",$_POST['composer']));
$arranged= mysqli_real_escape_string($con,implode(",",$_POST['arranged']));
$programmer= mysqli_real_escape_string($con,implode(",",$_POST['programmer']));
$mixed= mysqli_real_escape_string($con,implode(",",$_POST['mixed']));
$matered= mysqli_real_escape_string($con,implode(",",$_POST['matered']));
$lyricist= mysqli_real_escape_string($con,implode(",",$_POST['lyricist']));
$additional_lyrics= mysqli_real_escape_string($con,implode(",",$_POST['additional_lyrics']));
$rap= mysqli_real_escape_string($con,implode(",",$_POST['rap']));
$choreographer= mysqli_real_escape_string($con,implode(",",$_POST['choreographer']));
$performance= mysqli_real_escape_string($con,implode(",",$_POST['performance']));
$label= mysqli_real_escape_string($con,implode(",",$_POST['label']));
$award= $_POST['award'] ;
$song_upload_date= $_POST['song_upload_date'] ;
$song_upload_month= $_POST['song_upload_month'] ;
$song_upload_year= $_POST['song_upload_year'] ;
$best_song= $_POST['best_song'] ;
$youtube_upload_date= $_POST['youtube_upload_date'] ;
$youtube_upload_month= $_POST['youtube_upload_month'] ;
$youtube_upload_year= $_POST['youtube_upload_year'] ;
$youtube_video_viwe= $_POST['youtube_video_viwe'] ;
$original_credit= $_POST['original_credit'] ;
$original_lyricist= mysqli_real_escape_string($con,implode(",",$_POST['original_lyricist']));
$original_singer= mysqli_real_escape_string($con,implode(",",$_POST['original_singer']));
$original_music= mysqli_real_escape_string($con,implode(",",$_POST['original_music']));
$original_release_date= $_POST['original_release_date'] ;
$original_release_year= $_POST['original_release_year'] ;
    $eng_lyrics= $_POST['eng_lyrics'] ;
    $hin_lyrics= $_POST['hin_lyrics'] ;
    $title= $_POST['title'] ; 
    $youtube= $_POST['youtube'] ; 
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

            mysqli_query($con,"update videosong set music_producer='$music_producer',singer_id='$singer_id',language='$language',genre='$genre',music_director='$music_director',composer='$composer',arranged='$arranged',programmer='$programmer',mixed='$mixed',matered='$matered',lyricist='$lyricist',additional_lyrics='$additional_lyrics',rap='$rap',choreographer='$choreographer',performance='$performance',label='$label',award='$award',song_upload_date='$song_upload_date',song_upload_month='$song_upload_month',song_upload_year='$song_upload_year',best_song='$best_song',youtube_upload_date='$youtube_upload_date',youtube_upload_month='$youtube_upload_month',youtube_upload_year='$youtube_upload_year',youtube_video_viwe='$youtube_video_viwe',title='$title',youtube='$youtube',photo='$newName',eng_lyrics='$eng_lyrics',hin_lyrics='$hin_lyrics',original_credit='$original_credit',original_singer='$original_singer',original_lyricist='$original_lyricist',original_music='$original_music',original_release_date='$original_release_date',original_release_year='$original_release_year'   where id='$id'") or die(mysqli_error($con));
             header('location:videosong.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con, "delete from videosong where id='$_REQUEST[id]'");

header("location:videosong.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>videosong Management</title>
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
		 
		 
		  <!-- select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
       height: 35px;
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
                  <h1>Film Song</h1>
                  <small>Film Song List</small>
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
                                 <h4>Add Film Song</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <div class="form-group">
                                 <label>Film Name</label>
                                 <select name="film_id" class="form-control select2" requied>
                                 <option value="">-Please Select Film Name-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by name asc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id'];?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                            
                              </div>
                              <div class="form-group">
                                 <label>Song Title</label>
                                 <input type="text" class="form-control" name="title" placeholder="Enter title"  >
                              </div>
                              <div class="form-group">
                                 <label>Youtube Link</label>
                                 <input type="text" class="form-control" name="youtube" placeholder="Enter youtube"  >


                              </div>
							  
							  
							  							  <div class="form-group">
                                 <label>Singer Name</label>
                                 <select  class="form-control select2" name="singer_id[]" style="width:100%;" multiple >
                                 <? $sqlfr=mysqli_query($con, "select * from singer order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                              
                             
                             
                           
                            <div class="form-group">
                                 <label>Image</label>
                                   <input type="file"  name="filstor"  class="form-control">
                                  
                              </div>
							  
							  <div class="form-group">
                                 <label>Language</label>
                                 <select  class="form-control select2" name="language[]" style="width:100%;" multiple >
                                 <? $sqlfr=mysqli_query($con, "select * from song_language order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['song_language']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  
							  <div class="form-group">
                                 <label>Genre</label>
                                 <select  class="form-control select2" name="genre[]" style="width:100%;" multiple >
                                <? $sqlfr=mysqli_query($con, "select * from genresong order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  <div class="form-group">
                                 <label>Music Director</label>
                                 <select  class="form-control select2" name="music_director[]" style="width:100%;" multiple >
                                 <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							   <div class="form-group">
                                 <label>Music Producer</label>
                                 <select  class="form-control select2" name="music_producer[]" style="width:100%;" multiple >
								   <?php 
                                     $music_director_id=explode(",",$rowa["music_producer"]);
                                     foreach($music_director_id as $music_director_id_read){
										 $music_director_data_query="select * from music_producer where id='$music_director_id_read'";
										 $music_director_data_exe=mysqli_query($con,$music_director_data_query);
										 $music_director_read=mysqli_fetch_array($music_director_data_exe);
                                     ?>
                                     <option value="<?php echo $music_director_id_read ?>" selected><?php echo $music_director_read["name"];?></option>
                                     <?php } ?>
                                 <? $sqlfr=mysqli_query($con, "select * from music_producer order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  <div class="form-group">
                                 <label>Composer</label>
                                 <select  class="form-control select2" name="composer[]" style="width:100%;" multiple >
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  <div class="form-group">
                                 <label>Music Arranged</label>
                                 <select  class="form-control select2" name="arranged[]" style="width:100%;" multiple >
                                  <? $sqlfr=mysqli_query($con, "select * from music_arranged order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  <div class="form-group">
							   <label>Music Programmer</label>
                                 <select  class="form-control select2" name="programmer[]" style="width:100%;" multiple >
                                  <? $sqlfr=mysqli_query($con, "select * from music_programmer order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  <div class="form-group">
							  <label>Mixed</label>
                                 <select  class="form-control select2" name="mixed[]" style="width:100%;" multiple >
                                  <? $sqlfr=mysqli_query($con, "select * from mix order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  <div class="form-group">
							  <label>Master</label>
                                 <select  class="form-control select2" name="matered[]" style="width:100%;" multiple >
                                  <? $sqlfr=mysqli_query($con, "select * from master order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  <div class="form-group">
							  <label>Lyricist</label>
                                 <select  class="form-control select2" name="lyricist[]" style="width:100%;" multiple >
                                    <? $sqlfr=mysqli_query($con, "select * from lyricist order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  <div class="form-group">
							  							  <label> Additional Lyrics</label>
                                 <select  class="form-control select2" name="additional_lyrics[]" style="width:100%;" multiple >
                                    <? $sqlfr=mysqli_query($con, "select * from lyricist order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  <div class="form-group">
							  							  <label> Rap</label>
                                 <select  class="form-control select2" name="rap[]" style="width:100%;" multiple >

                                    <? $sqlfr=mysqli_query($con, "select * from lyricist order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  
							  
							  <div class="form-group">
							  							  <label> Choreographer</label>
                                 <select  class="form-control select2" name="choreographer[]" style="width:100%;" multiple >
                                     <? $sqlfr=mysqli_query($con, "select * from choreographer order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  <div class="form-group">
							  							  <label> Performance</label>
                                
 
<input type='text'
       placeholder='Enter Cast Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='other_cast',
       data-value-property='value',
	   name='performance[]',
      multiple
       >
	   <datalist id="other_cast" >
   <? $sqlfr=mysqli_query($con, "select * from cast order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
   
</datalist>

 





                              </div>
							  
							  
							  <div class="form-group">
							  							  <label>Music Label</label>
                                 <select  class="form-control select2" name="label[]" style="width:100%;" multiple >
                                     <? $sqlfr=mysqli_query($con, "select * from music_label order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['music_label']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  
                              
 <div class="form-group">
                                 <label>Award</label>
                                 
								  <select  class="form-control select2" name="award" style="width:100%;" multiple >
                                    

<option value="No" selected>No</option>
<option value="Yes">Yes</option>
                                  
                                 </select>
                              </div>
							  
							<!--  <div class="form-group">
                                 <label>Song Upload Date</label> 
                                 <input type="text" class="form-control" name="song_upload_date" placeholder=""  >
                              </div>
							  
							  <div class="form-group">
                                 <label>Song Upload Month</label>
                                 <input type="text" class="form-control" name="song_upload_month"   placeholder=""  >
                              </div>
							  
							  <div class="form-group">
                                 <label>Song Upload Year</label>
                                 <input type="text" class="form-control" name="song_upload_year"  placeholder=""  >
                              </div> -->
							  
							  <div class="form-group">
                                 <label>Best Song</label>
								 
								 <select  class="form-control select2" name="best_song" style="width:100%;" multiple >
                                    

<option value="No" selected>No</option>
<option value="Yes">Yes</option>
                                  
                                 </select>
                                 <!-- <input type="text" class="form-control" name="best_song"   placeholder=""  > -->
                              </div>
							  
							  
							  
							  							  <div class="form-group">
                                 <label>YouTube Upload Date</label>
                                 <input type="text" class="form-control" name="youtube_upload_date"  placeholder=""  >
                              </div>
 
 <div class="form-group">
                                 <label>YouTube Upload Month</label>
                                 <input type="text" class="form-control" name="youtube_upload_month"  placeholder=""  >
                              </div>
 
 <div class="form-group">
                                 <label>YouTube Upload Year</label>
                                 <input type="text" class="form-control" name=" youtube_upload_year"   placeholder=""  >
                              </div>
							  <div class="form-group">
                                 <label> Youtube video viwe</label>
                                 <input type="text" class="form-control" name=" youtube_video_viwe"   placeholder=""  >
                              </div>


							  
 
							  
							   <div class="form-group">
                                 <label>Original credit</label>
                                 <select class="form-control" id="Sequel" name="original_credit" required>
                                      <option value="No">No</option>
                                     <option value="Yes">Yes</option>
                                   
                                </select>
                              </div>
                     
                  
                   <div id="isSequel" style="display: block;border: 1px solid black;padding: 14px;">
                          <label></label>
                                <br/>
                                <div class="field_wrapper3">
                                <!-- <a href="javascript:void(0);" class="add_button3 btn btn-success pull-right" title="Add More">Add More</a> -->
                                     <br/>
                                        <div class="form-group  ">
                                <label>Original Singer</label>
                                 
   <select  class="form-control select2" name="original_singer[]" style="width:100%;" multiple >
                                 <? $sqlfr=mysqli_query($con, "select * from singer order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
							  <div class="form-group  ">
							  <label>Original Music</label>
                                 
  <select  class="form-control select2" name="original_music[]" style="width:100%;" multiple >
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
							  
							   <div class="form-group  ">
							  <label>Original Lyricist</label>
                                 
   <select  class="form-control select2" name="original_lyricist[]" style="width:100%;" multiple >
                                    <? $sqlfr=mysqli_query($con, "select * from lyricist order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
							  
							   <div class="form-group  ">
							  <label>Original Release Date</label>
                                 
   <input type="text" class="form-control" name=" original_release_date"   placeholder="DD-MM-YYYY"  >
                                 
                              </div> 
							  
							  <div class="form-group  ">
							  <label>Original Release year</label>
                                 
   <input type="text" class="form-control" name=" original_release_year"   placeholder="YYYY"  >
                                 
                              </div> 
							   
                              </div>
                                    </div>
                              



     <div class="form-group">
                                 <label>English Lyrics</label>
                                 <textarea name="eng_lyrics" rows="25"></textarea> 
                              </div>
                               <div class="form-group">
                                 <label>Hindi Lyrics</label>
                                 <textarea name="hin_lyrics" rows="25"></textarea> 
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











<? if($_GET['Action']=="Update"){  $id=$_GET['id'];
$sqla="select * from videosong where id='$id'";
$rsa=mysqli_query($con,$sqla);
$rowa=mysqli_fetch_array($rsa);
?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Update videosong</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <div class="form-group">
                                 <label>Song Name</label>
                                 <input type="text" name="title" class="form-control" placeholder="Update title" value="<? echo $rowa['title'];?>"   >
                              </div>
                               <div class="form-group">
                                 <label>Singer Name</label>
                                 <select  class="form-control select2" name="singer_id[]" style="width:100%;" multiple >
								 <?php 
                                     $singer_id=explode(",",$rowa["singer_id"]);
                                     foreach($singer_id as $singer_id_read){
										 $singer_data_query="select * from singer where id='$singer_id_read'";
										 $singer_data_exe=mysqli_query($con,$singer_data_query);
										 $singer_name_read=mysqli_fetch_array($singer_data_exe);
                                     ?>
                                     <option value="<?php echo $singer_id_read ?>" selected><?php echo $singer_name_read["name"];?></option>
                                     <?php } ?>
                                 <? $sqlfr=mysqli_query($con, "select * from singer order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Youtube Link</label>
                                 <input type="text" name="youtube" class="form-control" placeholder="Update youtube" value="<? echo $rowa['youtube'];?>"   >
                              </div>
                         
                                 <div class="form-group">
                                 <label>Image</label>
                                 <img src="photo/<? echo $rowa['photo']; ?>" width="100"> 
                                   <input type="file"  name="filstor"  class="form-control">
                                    <input type="hidden" name="oldimg" value="<? echo $rowa['photo']; ?>">
                                  
                              </div>  


<div class="form-group">
                                 <label>Language</label>
                                 <select  class="form-control select2" name="language[]" style="width:100%;" multiple >
								 <?php 
                                     $language_id=explode(",",$rowa["language"]);
                                     foreach($language_id as $language_id_read){
										 $language_data_query="select * from song_language where id='$language_id_read'";
										 $language_data_exe=mysqli_query($con,$language_data_query);
										 $language_read=mysqli_fetch_array($language_data_exe);
                                     ?>
                                     <option value="<?php echo $language_id_read ?>" selected><?php echo $language_read["song_language"];?></option>
                                     <?php } ?>
                                 <? $sqlfr=mysqli_query($con, "select * from song_language order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['song_language']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  
							  <div class="form-group">
                                 <label>Genre</label>
                                 <select  class="form-control select2" name="genre[]" style="width:100%;" multiple >
								  <?php 
                                     $genresong=explode(",",$rowa["genre"]);
                                     foreach($genresong as $song_genre_id_read){
										 $song_genre_data_query="select * from genresong where id='$song_genre_id_read'";
										 $song_genre_data_exe=mysqli_query($con,$song_genre_data_query);
										 $song_genre_read=mysqli_fetch_array($song_genre_data_exe);
                                     ?>
                                     <option value="<?php echo $song_genre_id_read ?>" selected><?php echo $song_genre_read["name"];?></option>
                                     <?php } ?>
                                <? $sqlfr=mysqli_query($con, "select * from genresong order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  <div class="form-group">
                                 <label>Music Director</label>
                                 <select  class="form-control select2" name="music_director[]" style="width:100%;" multiple >
								   <?php 
                                     $music_director_id=explode(",",$rowa["music_director"]);
                                     foreach($music_director_id as $music_director_id_read){
										 $music_director_data_query="select * from music_director where id='$music_director_id_read'";
										 $music_director_data_exe=mysqli_query($con,$music_director_data_query);
										 $music_director_read=mysqli_fetch_array($music_director_data_exe);
                                     ?>
                                     <option value="<?php echo $music_director_id_read ?>" selected><?php echo $music_director_read["name"];?></option>
                                     <?php } ?>
                                 <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							    <div class="form-group">
                                 <label>Music Producer</label>
                                 <select  class="form-control select2" name="music_producer[]" style="width:100%;" multiple >
								   <?php 
                                     $music_director_id=explode(",",$rowa["music_producer"]);
                                     foreach($music_director_id as $music_director_id_read){
										 $music_director_data_query="select * from music_producer where id='$music_director_id_read'";
										 $music_director_data_exe=mysqli_query($con,$music_director_data_query);
										 $music_director_read=mysqli_fetch_array($music_director_data_exe);
                                     ?>
                                     <option value="<?php echo $music_director_id_read ?>" selected><?php echo $music_director_read["name"];?></option>
                                     <?php } ?>
                                 <? $sqlfr=mysqli_query($con, "select * from music_producer order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  <div class="form-group">
                                 <label>Composer</label>
                                 <select  class="form-control select2" name="composer[]" style="width:100%;" multiple >
								 <?php 
                                     $composer_id=explode(",",$rowa["composer"]);
                                     foreach($composer_id as $composer_id_read){
										 $composer_data_query="select * from music_director where id='$composer_id_read'";
										 $composer_data_exe=mysqli_query($con,$composer_data_query);
										 $composer_read=mysqli_fetch_array($composer_data_exe);
                                     ?>
                                     <option value="<?php echo $song_genre_id_read ?>" selected><?php echo $composer_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  <div class="form-group">
                                 <label>Music Arranged</label>
                                 <select  class="form-control select2" name="arranged[]" style="width:100%;" multiple >
								  <?php 
                                     $music_arranged=explode(",",$rowa["arranged"]);
                                     foreach($music_arranged as $music_arranged_read){
										 $music_arranged_data_query="select * from music_arranged where id='$music_arranged_read'";
										 $music_arranged_data_exe=mysqli_query($con,$music_arranged_data_query);
										 $music_arranged_data_read=mysqli_fetch_array($music_arranged_data_exe);
                                     ?>
                                     <option value="<?php echo $music_arranged_read ?>" selected><?php echo $music_arranged_data_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from music_arranged order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  <div class="form-group">
							   <label>Music Programmer</label>
                                 <select  class="form-control select2" name="programmer[]" style="width:100%;" multiple >
								  <?php 
                                     $programmer=explode(",",$rowa["programmer"]);
                                     foreach($programmer as $programmer_read){
										 $programmer_data_query="select * from music_programmer where id='$programmer_read'";
										 $programmer_data_exe=mysqli_query($con,$programmer_data_query);
										 $programmer_data_read=mysqli_fetch_array($programmer_data_exe);
                                     ?>
                                     <option value="<?php echo $programmer_read ?>" selected><?php echo $programmer_data_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from music_programmer order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  <div class="form-group">
							  <label>Mixed</label>
                                 <select  class="form-control select2" name="mixed[]" style="width:100%;" multiple >
								  <?php 
                                     $mixed=explode(",",$rowa["mixed"]);
                                     foreach($mixed as $mixed_read){
										 $mixed_data_query="select * from mix where id='$mixed_read'";
										 $mixed_data_exe=mysqli_query($con,$mixed_data_query);
										 $mixed_data_read=mysqli_fetch_array($mixed_data_exe);
                                     ?>
                                     <option value="<?php echo $mixed_read ?>" selected><?php echo $mixed_data_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from mix order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  <div class="form-group">
							  <label>Master</label>
                                 <select  class="form-control select2" name="matered[]" style="width:100%;" multiple >
								 
								 <?php 
                                     $matered=explode(",",$rowa["matered"]);
                                     foreach($matered as $matered_read){
										 $matered_data_query="select * from master where id='$matered_read'";
										 $matered_data_exe=mysqli_query($con,$matered_data_query);
										 $matered_data_read=mysqli_fetch_array($matered_data_exe);
                                     ?>
                                     <option value="<?php echo $matered_read ?>" selected><?php echo $matered_data_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from master order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  <div class="form-group">
							  <label>Lyricist</label>
                                 <select  class="form-control select2" name="lyricist[]" style="width:100%;" multiple >
								 
								  <?php 
                                     $lyricist=explode(",",$rowa["lyricist"]);
                                     foreach($lyricist as $lyricist_read){
										 $lyricist_data_query="select * from lyricist where id='$lyricist_read'";
										 $lyricist_data_exe=mysqli_query($con,$lyricist_data_query);
										 $lyricist_data_read=mysqli_fetch_array($lyricist_data_exe);
                                     ?>
                                     <option value="<?php echo $lyricist_read ?>" selected><?php echo $lyricist_data_read["name"];?></option>
                                     <?php } ?>
                                    <? $sqlfr=mysqli_query($con, "select * from lyricist order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  <div class="form-group">
							  							  <label> Additional Lyrics</label>
                                 <select  class="form-control select2" name="additional_lyrics[]" style="width:100%;" multiple >
								  <?php 
                                     $additional_lyrics=explode(",",$rowa["additional_lyrics"]);
                                     foreach($additional_lyrics as $additional_lyrics_read){
										 $additional_lyrics_data_query="select * from lyricist where id='$additional_lyrics_read'";
										 $additional_lyrics_data_exe=mysqli_query($con,$additional_lyrics_data_query);
										 $additional_lyrics_data_read=mysqli_fetch_array($additional_lyrics_data_exe);
                                     ?>
                                     <option value="<?php echo $additional_lyrics_read ?>" selected><?php echo $additional_lyrics_data_read["name"];?></option>
                                     <?php } ?>
                                    <? $sqlfr=mysqli_query($con, "select * from lyricist order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  <div class="form-group">
							  							  <label> Rap</label>
                                 <select  class="form-control select2" name="rap[]" style="width:100%;" multiple >
								  <?php 
                                     $rap=explode(",",$rowa["rap"]);
                                     foreach($rap as $rap_read){
										 $rap_data_query="select * from lyricist where id='$rap_read'";
										 $rap_data_exe=mysqli_query($con,$rap_data_query);
										 $rap_data_read=mysqli_fetch_array($rap_data_exe);
                                     ?>
                                     <option value="<?php echo $rap_read ?>" selected><?php echo $rap_data_read["name"];?></option>
                                     <?php } ?>
                                    <? $sqlfr=mysqli_query($con, "select * from lyricist order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							  
							  
							  <div class="form-group">
							  							  <label> choreographer</label>
                                 <select  class="form-control select2" name="choreographer[]" style="width:100%;" multiple >
								 
								 <?php 
                                     $choreographer=explode(",",$rowa["choreographer"]);
                                     foreach($choreographer as $choreographer_read){
										 $choreographer_data_query="select * from choreographer where id='$choreographer_read'";
										 $choreographer_data_exe=mysqli_query($con,$choreographer_data_query);
										 $choreographer_data_read=mysqli_fetch_array($choreographer_data_exe);
                                     ?>
                                     <option value="<?php echo $choreographer_read ?>" selected><?php echo $choreographer_data_read["name"];?></option>
                                     <?php } ?>
                                     <? $sqlfr=mysqli_query($con, "select * from choreographer order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
		
							  <div class="form-group">							  							 
														 <label> Performance</label>
														 <?  $cast=explode(",",$rowa["performance"]);
														$tmp = '';

                                     foreach($cast as $cast_read){
									 
										 $cast_data_query="select * from cast where id='$cast_read'";
										 $cast_data_exe=mysqli_query($con,$cast_data_query);
										 $cast_data_read=mysqli_fetch_array($cast_data_exe);
										 $cast_read_id=$cast_data_read["id"];
										 $tmp .=$cast_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
														 <input type='text'
       placeholder='Enter Cast Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='other_cast',
       data-value-property='value',
	   name='performance[]',
	   value='<? echo $tmp?>',
      multiple='multiple'
	 
       />
	   <datalist id="other_cast" >
	    <?php 
                                     
                                     foreach($cast as $cast_read1){
									 
										 $cast_data_query1="select * from cast where id='$cast_read1'";
										 $cast_data_exe1=mysqli_query($con,$cast_data_query1);
										 $cast_data_read1=mysqli_fetch_array($cast_data_exe1);
										
                                     ?>
                                     <option value="<?php echo $cast_data_read1["id"] ?>" selected><?php echo $cast_data_read1["name"];?></option>
                                     <?php } ?>
	
   <? $sqlfr=mysqli_query($con, "select * from cast order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
   
</datalist>														  														  														  																						
                              </div>
							  
							  
							  <div class="form-group">
							  							  <label>Music Label</label>
                                 <select  class="form-control select2" name="label[]" style="width:100%;" multiple >
								 <?php 
                                     $label_id=explode(",",$rowa["label"]);
                                     foreach($label_id as $label_read){
										 $label_data_query="select * from music_label where id='$label_read'";
										 $label_data_exe=mysqli_query($con,$label_data_query);
										 $label_data_read=mysqli_fetch_array($label_data_exe);
                                     ?>
                                     <option value="<?php echo $label_read ?>" selected><?php echo $label_data_read["music_label"];?></option>
                                     <?php } ?>
								 
                                     <? $sqlfr=mysqli_query($con, "select * from music_label order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['music_label']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
							  
							 
                              
 <div class="form-group">
                                 <label>Award</label>
								 <select class="form-control" id="Sequel" name="award" required>
                                     <?php if($rowa["award"]=="Yes"){ ?>
                                       <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>
                                   <?php }else { ?>
                                      <option value="No" selected>No</option>
                                      <option value="Yes">Yes</option>
                                      <?php } ?>
                                       
                                   
                                </select>
								 
                                 <!-- <input type="text" class="form-control" name="award" value="<? echo $rowa['award'];?>"  placeholder="no"  > -->
                              </div>
							  
							<!--  <div class="form-group">
                                 <label>Song Upload Date</label> 
                                 <input type="text" class="form-control" name="song_upload_date" value="<? echo $rowa['song_upload_date'];?>"  placeholder="no"  >
                              </div>
							  
							  <div class="form-group">
                                 <label>Song Upload Month</label>
                                 <input type="text" class="form-control" name="song_upload_month" value="<? echo $rowa['song_upload_month'];?>"  placeholder="no"  >
                              </div>
							  
							  <div class="form-group">
                                 <label>Song Upload Year</label>
                                 <input type="text" class="form-control" name="song_upload_year" value="<? echo $rowa['song_upload_year'];?>"  placeholder="no"  >
                              </div>
							  -->
							  <div class="form-group">
                                 <label>Best Song</label>
								 <select class="form-control" id="Sequel" name="best_song" required>
                                     <?php if($rowa["best_song"]=="Yes"){ ?>
                                       <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>
                                   <?php }else { ?>
                                      <option value="No" selected>No</option>
                                      <option value="Yes">Yes</option>
                                      <?php } ?>
                                       
                                   
                                </select>
								 
                                 <!-- <input type="text" class="form-control" name="best_song" value="<? echo $rowa['best_song'];?>"  placeholder=""  > -->
                              </div>
							 
							  
							  
							  
							  							  <div class="form-group">
                                 <label>YouTube Upload Date</label>
                                 <input type="text" class="form-control" name="youtube_upload_date" value="<? echo $rowa['youtube_upload_date'];?>"  placeholder=""  >
                              </div>
 
 <div class="form-group">
                                 <label>YouTube Upload Month</label>
                                 <input type="text" class="form-control" name="youtube_upload_month" value="<? echo $rowa['youtube_upload_month'];?>"  placeholder=""  >
                              </div>
 
 <div class="form-group">
                                 <label>YouTube Upload Year</label>
                                 <input type="text" class="form-control" name=" youtube_upload_year" value="<? echo $rowa['youtube_upload_year'];?>"  placeholder=""  >
                              </div>
							  <div class="form-group">
                                 <label> Youtube video viwe</label>
                                 <input type="text" class="form-control" name=" youtube_video_viwe" value="<? echo $rowa['youtube_video_viwe'];?>"  placeholder=""  >
                              </div>
							  



 <div class="form-group">
                                 <label>Original credit</label>
                                 <select class="form-control" id="credit" name="original_credit" required>
                                     <?php if($rowa["original_credit"]=="Yes"){ ?>
                                       <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>
                                   <?php }else { ?>
                                      <option value="No" selected>No</option>
                                      <option value="Yes">Yes</option>
                                      <?php } ?>
                                   
                                </select>
                              </div>
                     
                  
                   <div id="iscredit" style="display: block;border: 1px solid black;padding: 14px;">
                          <label></label>
                                <br/>
                                <div class="field_wrapper3">
                                <!-- <a href="javascript:void(0);" class="add_button3 btn btn-success pull-right" title="Add More">Add More</a> -->
                                     <br/>
									  <?php
                                     $sequel_type=explode(",",$read["sequel_type"]);
                                     $installment=explode(",",$read["installment"]);
                                     $count_sequel_type=count($sequel_type);
                                     $count=0;
                                     for($i=1;$i<=$count_sequel_type;$i++){
                                     
                                     ?>
                                        <div class="form-group  ">
                                <label>Original Singer</label>
                                 
   <select  class="form-control select2" name="original_singer[]" style="width:100%;" multiple >
   
    <?php 
                                     $original_singer_id=explode(",",$rowa["original_singer"]);
                                     foreach($original_singer_id as $original_singer_read){
										 $original_singer_data_query="select * from singer where id='$original_singer_read'";
										 $original_singer_data_exe=mysqli_query($con,$original_singer_data_query);
										 $original_singer_data_read=mysqli_fetch_array($original_singer_data_exe);
                                     ?>
                                     <option value="<?php echo $original_singer_read ?>" selected><?php echo $original_singer_data_read["name"];?></option>
                                     <?php } ?>
                                 <? $sqlfr=mysqli_query($con, "select * from singer order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
							  <div class="form-group  ">
							  <label>Original Music</label>
                                 
  <select  class="form-control select2" name="original_music[]" style="width:100%;" multiple >
  
  <?php 
                                     $original_music_id=explode(",",$rowa["original_music"]);
                                     foreach($original_music_id as $original_music_read){
										 $original_music_data_query="select * from music_director where id='$original_music_read'";
										 $original_music_data_exe=mysqli_query($con,$original_music_data_query);
										 $original_music_data_read=mysqli_fetch_array($original_music_data_exe);
                                     ?>
                                     <option value="<?php echo $original_music_read ?>" selected><?php echo $original_music_data_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
							  
							   <div class="form-group  ">
							  <label>Original Lyricist</label>
                                 
   <select  class="form-control select2" name="original_lyricist[]" style="width:100%;" multiple >
   
   <?php 
                                     $original_lyricist_id=explode(",",$rowa["original_music"]);
                                     foreach($original_lyricist_id as $original_lyricist_read){
										 $original_lyricist_data_query="select * from lyricist where id='$original_lyricist_read'";
										 $original_lyricist_data_exe=mysqli_query($con,$original_lyricist_data_query);
										 $original_lyricist_data_read=mysqli_fetch_array($original_lyricist_data_exe);
                                     ?>
                                     <option value="<?php echo $original_lyricist_read ?>" selected><?php echo $original_lyricist_data_read["name"];?></option>
                                     <?php } ?>
                                    <? $sqlfr=mysqli_query($con, "select * from lyricist order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
							  
							   <div class="form-group  ">
							  <label>Original Release Date</label>
                                 
   <input type="text" class="form-control" value="<? echo $rowa['original_release_date'];?>" name="original_release_date"   placeholder="DD-MM-YYYY"  >
                                 
                              </div> 
							  
							  <div class="form-group  ">
							  <label>Original Release year</label>
                                 
   <input type="text" class="form-control" value="<? echo $rowa['original_release_year'];?>" name="original_release_year"  placeholder="YYYY"  >
                                 
                              </div> 
							   
                              </div>
							  <?php $count++;} ?>
                                    </div>
                              




     <div class="form-group">
                                 <label>English Lyrics</label>
                                 <textarea name="eng_lyrics" rows="25"><? echo $rowa['eng_lyrics'];?></textarea> 
                              </div>
                              <div class="form-group">
                                 <label>Hindi Lyrics</label>
                                 <textarea name="hin_lyrics" rows="25"><? echo $rowa['hin_lyrics'];?></textarea> 
                              </div>
        
                              <input type="hidden" name="id" value="<? echo $rowa['id'];?>">
                             
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
                                 <h4>videosong List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="videosong.php?Action=Add"> <i class="fa fa-plus"></i> Add videosong
                                 </a>  
                              </div>
                            
                           </div>

 <script type="text/javascript" src="jquery-1.8.0.min.js"></script>
 <script>
$(document).ready(function(){

    var maxField3 = 10; //Input fields increment limitation
    var addButton3 = $('.add_button3'); //Add button selector
    var wrapper3 = $('.field_wrapper3'); //Input field wrapper
    var fieldHTML3 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                        '<label>Fill Following Franchise  Details of This Film:</label>'+
                                '<br/>'+
                                '<br/>'+
                        '<div class="form-group  ">'+
                                '<label>Select Sequel Type</label>'+
   '<select class="form-control" name="sequel_type[]" >'+
                                  '<option value="">-Please Select-</option>'+
                                     '<option value="Sequel">Sequel</option>'+
                                     '<option value="Prequel">Prequel</option>'+
                                     '<option value="Quasi Sequel">Quasi Sequel</option>'+
                                 '</select>'+
                              '</div>'+
                              
                              '<div class="form-group  ">'+
                             
                                 '<label>Film Title(s)</label>'+
                                 
 '<select class="main_language"  class="form-control" name="sequel_film_name[]" multiple="multiple">'+
                                  <? $sqlfr=mysqli_query($con, "select * from film order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){  $FilmName=$rowfr['name'];?>

'<option value="<? echo $rowfr['id']; ?>"><?  $FilmName1= str_replace("'", "", $FilmName);echo $FilmName1; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                                 
                              '</div>'+
                              
                              '<div class="form-group  ">'+
                                '<label>Installment:</label>'+
                                '<input type="text" name="Installment[]" class="form-control"/>'+
                                '</div>'+
                                
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton3).click(function(){
        //Check maximum number of input fields
        if(x < maxField3){ 
            x++; //Increase field counter
            $(wrapper3).append(fieldHTML3); //Add field html
            $('.main_language').select2();
           
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
    url: "search_videosong.php",
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

<input type="text" class="search form-control" id="searchid" placeholder="Search for Film Song" style="width: 100%" />  
<div id="result"></div>
 

<br><br>
 <select class="form-control select2"   onChange="window.document.location.href=this.options[this.selectedIndex].value;">
<option value="">Search Video Song</option>
<?php $sqlfs=mysqli_query($con, "select * from videosong");
while($rowfs=mysqli_fetch_array($sqlfs)){  
 ?>

<option value="videosong.php?Action=Update&id=<?php echo $rowfs['id']; ?>"><?php echo $rowfs['title']; ?> </option>
<?php } ?>

 </select><br><br>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>title</th>
                                       <th>language</th> 
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `videosong`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `videosong` order by id desc LIMIT $offset, $total_records_per_page");

 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                       <td><? echo $row['title']; ?></td>
                                       <td><? 


$language_id=explode(",",$row['language']);
$ulang="";
foreach ($language_id as $x) {
 $sqll=mysqli_query($con, "select * from song_language where id='$x'");
 $rowl=mysqli_fetch_array($sqll);
 $ulang=strtolower($ulang.", ".$rowl['song_language']);

}

$ulang=substr($ulang, 1);

 echo $ulang;
 
                                        ?></td> 
                                      <td> <img src="photo/<? echo $row['photo']; ?>" width="50"></td>
                                       <td>
                                         
                                          <a href="videosong.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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
    =====================================================================-->

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

 

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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




$(document).ready(function() {
    $('.select2').select2();
});
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
$(function() {
    jQuery(document).ready(function($){
        if($('#Sequel').val() == 'Yes') {
            $('#isSequel').show(); 
        } else {
            $('#isSequel').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#Sequel").change(function(){
        if($('#Sequel').val() == 'Yes') {
            $('#isSequel').show(); 
        } else {
            $('#isSequel').hide(); 
        } 
    });
});
 </script>
 
 
 <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#credit').val() == 'Yes') {
            $('#iscredit').show(); 
        } else {
            $('#iscredit').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#credit").change(function(){
        if($('#credit').val() == 'Yes') {
            $('#iscredit').show(); 
        } else {
            $('#iscredit').hide(); 
        } 
    });
});
 </script>
 
   



<script type="text/javascript"> 

$(document).ready(function() {
    $('.select2').select2();
});
</script>