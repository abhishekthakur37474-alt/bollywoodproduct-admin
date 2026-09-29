<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_POST["Submit"]) { 
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']) ; 
    $title= mysqli_real_escape_string($con,$_POST['title']) ; 
    $singer= mysqli_real_escape_string($con,$_POST['singer']) ; 
    $youtube= mysqli_real_escape_string($con,$_POST['youtube']) ; 
    $details= mysqli_real_escape_string($con,$_POST['details']) ;  
    $hdetails=mysqli_real_escape_string($con,$_POST['hdetails']) ;  
    $about=mysqli_real_escape_string($con,$_POST['about']) ;  
 
 
$fname1=strtolower(str_replace(" ", "-", $title)); 

$alias=preg_replace("/[^a-zA-Z0-9-]/", "",$fname1 );


mysqli_query($con,"INSERT INTO `film_song` ( `film_id`, `title`, `alias`,`singer`, `youtube`, `details`, `hdetails`, `about`, `updated_date`, `created_date`) VALUES (  '$film_id', '$title', '$alias','$singer', '$youtube', '$details', '$hdetails', '$about', now(),now())") or die(mysqli_error($con));
  echo "<script>alert('Film Song Basic Details Save Succesfully')</script>";
           include('../test-unique-alias-song.php');
  echo "<script>window.location.href='film_song.php'</script>";
         }

if($_GET["Action"]=="Deleteuploaddate") { 
  $song_id=$_GET['song_id'];
  $date=$_GET['date'];
  $month=$_GET['month'];
  $year=$_GET['year'];
  
  mysqli_query($con, "delete from song_youtube_upload_date where song_id='$song_id' and youtube_viwe='$youtube_viwe'");

header("location:film_song.php?Action=Update&id=$song_id");

}

    if($_POST["Update"]) {
    $song_id=$_GET["id"];
    $film_id= $_POST['film_id'] ; 
    $title= mysqli_real_escape_string($con,$_POST['title']) ; 
    $singer= mysqli_real_escape_string($con,$_POST['singer']) ; 
    $youtube= mysqli_real_escape_string($con,$_POST['youtube']) ; 
    $details= mysqli_real_escape_string($con,$_POST['details']) ;  
    $hdetails= mysqli_real_escape_string($con,$_POST['hdetails']) ;  
    $about=mysqli_real_escape_string($con,$_POST['about']) ;
$remake=mysqli_real_escape_string($con,$_POST['remake']) ;
$remake_original_film_song_name=mysqli_real_escape_string($con,$_POST['remake_original_film_song_name']) ;
$remake_original_video_song_name=mysqli_real_escape_string($con,$_POST['remake_original_video_song_name']) ;
$remake_original_datafrom=mysqli_real_escape_string($con,$_POST['datafrom']) ;

if($remake_original_datafrom=="Film Song")
{
   $remake_original_song_name=$remake_original_film_song_name;
}
else
{
   $remake_original_song_name=$remake_original_video_song_name;
}
//$song_upload_date=mysqli_real_escape_string($con,$_POST['song_upload_date']) ;
//$song_upload_month=mysqli_real_escape_string($con,$_POST['song_upload_month']) ;
//$song_upload_year=mysqli_real_escape_string($con,$_POST['song_upload_year']) ;
$best_song=mysqli_real_escape_string($con,$_POST['best_song']) ;
$all_time_best_song=mysqli_real_escape_string($con,$_POST['all_time_best_song']) ;
$youtube_upload_date=mysqli_real_escape_string($con,$_POST['youtube_upload_date']) ;
$youtube_upload_month=mysqli_real_escape_string($con,$_POST['youtube_upload_month']) ;
$youtube_upload_year=mysqli_real_escape_string($con,$_POST['youtube_upload_year']) ;
$youtube_video_viwe=mysqli_real_escape_string($con,$_POST['youtube_video_viwe']) ;	
$cast_id=mysqli_real_escape_string($con,implode(",",$_POST['cast_id']));
$cast_id_ex=explode(",",$cast_id);
mysqli_query($con, "delete from song_cast where song_id='$song_id'");
foreach($cast_id_ex as $cast)
{
	
mysqli_query($con, "insert into song_cast (song_id, cast_id) values ('$song_id', '$cast')");
	
}

$language_id_id=mysqli_real_escape_string($con,implode(",",$_POST['lang_id']));

$genre_id_id=mysqli_real_escape_string($con,implode(",",$_POST['genre_id']));
$genre_id_ex=explode(",",$genre_id_id);
mysqli_query($con, "delete from song_genre where song_id='$song_id'");
foreach($genre_id_ex as $genre_id)
{
 mysqli_query($con, "insert into song_genre(song_id, genre_id) values ('$song_id', '$genre_id')");
}

$music_director_id_id=mysqli_real_escape_string($con,implode(",",$_POST['music_director_id']));
$music_director_id_ex=explode(",",$music_director_id_id);
mysqli_query($con, "delete from song_music_director where song_id='$song_id'");
foreach($music_director_id_ex as $music_director_id)
{
 mysqli_query($con, "insert into song_music_director set song_id='$song_id', music_director_id='$music_director_id'");
}

$music_producer_id_id=mysqli_real_escape_string($con,implode(",",$_POST['music_producer_id']));
$music_producer_id_ex=explode(",",$music_producer_id_id);
mysqli_query($con, "delete from song_music_producer where song_id='$song_id'");
foreach($music_producer_id_ex as $music_producer_id)
{
 mysqli_query($con, "insert into song_music_producer (song_id, music_producer_id) values ('$song_id', '$music_producer_id')");
}
$singer_id_id=mysqli_real_escape_string($con,implode(",",$_POST['singer_id']));
$singer_id_ex=explode(",",$singer_id_id);
mysqli_query($con, "delete from song_singer where song_id='$song_id'");
foreach($singer_id_ex as $singer_id)
{
	mysqli_query($con, "insert into song_singer (song_id, singer_id) values ('$song_id', '$singer_id')");
}

$rap_singer_id_id=mysqli_real_escape_string($con,implode(",",$_POST['rap_singer_id']));
$rap_singer_id_ex=explode(",",$rap_singer_id_id);
mysqli_query($con, "delete from song_rap_singer where song_id='$song_id'");
foreach($rap_singer_id_ex as $rap_singer_id)
{
	mysqli_query($con, "insert into song_rap_singer (song_id, singer_id) values ('$song_id', '$rap_singer_id')");
}

$background_vocal_singer_id_id=mysqli_real_escape_string($con,implode(",",$_POST['background_vocal_singer_id']));
$backgroud_vocal_singer_id_ex=explode(",",$background_vocal_singer_id_id);
mysqli_query($con, "delete from song_background_vocal where song_id='$song_id'");
foreach($backgroud_vocal_singer_id_ex as $background_vocal_singer_id)
{
	mysqli_query($con, "insert into song_background_vocal (song_id, singer_id) values ('$song_id', '$background_vocal_singer_id')");
}
$supported_vocal_singer_id_id=mysqli_real_escape_string($con,implode(",",$_POST['supported_vocal_singer_id']));
$suppoted_vocal_singer_id_ex=explode(",",$supported_vocal_singer_id_id);
mysqli_query($con, "delete from song_supported_vocal where song_id='$song_id'");
foreach($suppoted_vocal_singer_id_ex as $suppoted_vocal_singer_id)
{
	mysqli_query($con, "insert into song_supported_vocal (song_id, singer_id) values ('$song_id', '$suppoted_vocal_singer_id')");
}

   $additional_vocal_id=mysqli_real_escape_string($con,implode(",",$_POST['additional_vocal']));
$additional_vocal_id_ex=explode(",",$additional_vocal_id);
mysqli_query($con, "delete from song_additional_vocal where song_id='$song_id'");
foreach($additional_vocal_id_ex as $additional_vocal_id_id)
{
	mysqli_query($con, "insert into song_additional_vocal (song_id, singer_id) values ('$song_id', '$additional_vocal_id_id')");
}
$lyricist_id_id=mysqli_real_escape_string($con,implode(",",$_POST['lyricist_id']));
$lyricist_id_ex=explode(",",$lyricist_id_id);
mysqli_query($con, "delete from song_lyricist where song_id='$song_id'");
foreach($lyricist_id_ex as $lyricist_id)
{
	mysqli_query($con, "insert into song_lyricist (song_id, lyricist_id) values ('$song_id', '$lyricist_id')");
}
$rap_lyricist_id_id=mysqli_real_escape_string($con,implode(",",$_POST['rap_lyricist_id']));
$rap_lyricist_id_ex=explode(",",$rap_lyricist_id_id);
mysqli_query($con, "delete from song_rap_lyricist where song_id='$song_id'");
foreach($rap_lyricist_id_ex as $raplyricist_id)
{
	mysqli_query($con, "insert into song_rap_lyricist (song_id, lyricist_id) values ('$song_id', '$raplyricist_id')");
}




$song_composer_id_id=mysqli_real_escape_string($con,implode(",",$_POST['song_composer_id']));
$song_composer_id_ex=explode(",",$song_composer_id_id);
mysqli_query($con, "delete from song_Composer where song_id='$song_id'");
foreach($song_composer_id_ex as $song_composer_id)
{
	 mysqli_query($con, "insert into song_Composer(song_id, song_composer_id) values ('$song_id', '$song_composer_id')");
}

$arranged_id_id=mysqli_real_escape_string($con,implode(",",$_POST['arranged_id']));
$arranged_id_ex=explode(",",$arranged_id_id);
mysqli_query($con, "delete from song_music_arranged where song_id='$song_id'");
foreach($arranged_id_ex as $arranged_id)
{
	 mysqli_query($con, "insert into song_music_arranged(song_id, arranged_id) values ('$song_id', '$arranged_id')");
}
$programmer_id_id=mysqli_real_escape_string($con,implode(",",$_POST['programmer_id']));
$programmer_id_ex=explode(",",$programmer_id_id);
mysqli_query($con, "delete from song_music_programmer where song_id='$song_id'");
foreach($programmer_id_ex as $programmer_id)
{
	 mysqli_query($con, "insert into song_music_programmer(song_id, programmer_id) values ('$song_id', '$programmer_id')");
}

$mixed_id_id=mysqli_real_escape_string($con,implode(",",$_POST['mixed_id']));
$mixed_id_ex=explode(",",$mixed_id_id);
mysqli_query($con, "delete from song_mixed where song_id='$song_id'");
foreach($mixed_id_ex as $mixed_id)
{
	 mysqli_query($con, "insert into song_mixed(song_id, mixed_id) values ('$song_id', '$mixed_id')");
}

$matered_id_id=mysqli_real_escape_string($con,implode(",",$_POST['matered_id']));
$matered_id_ex=explode(",",$matered_id_id);
mysqli_query($con, "delete from song_matered where song_id='$song_id'");
foreach($matered_id_ex as $matered_id)
{
	 mysqli_query($con, "insert into song_matered(song_id, matered_id) values ('$song_id', '$matered_id')");
}

$additional_lyrics_id_id=mysqli_real_escape_string($con,implode(",",$_POST['additional_lyrics_id']));
$additional_lyrics_id_ex=explode(",",$additional_lyrics_id_id);
mysqli_query($con, "delete from song_additional_lyrics where song_id='$song_id'");
foreach($additional_lyrics_id_ex as $additional_lyrics_id)
{
	 mysqli_query($con, "insert into song_additional_lyrics(song_id, additional_lyrics_id) values ('$song_id', '$additional_lyrics_id')");
}

$rap_id_id=mysqli_real_escape_string($con,implode(",",$_POST['rap_id']));
$rap_id_ex=explode(",",$rap_id_id);
mysqli_query($con, "delete from song_rap where song_id='$song_id'");
foreach($rap_id_ex as $rap_id)
{
	 mysqli_query($con, "insert into song_rap(song_id, rap_id) values ('$song_id', '$rap_id')");
}

$choreographe_id_id=mysqli_real_escape_string($con,implode(",",$_POST['choreographe_id']));
$choreographe_id_ex=explode(",",$choreographe_id_id);
mysqli_query($con, "delete from song_choreographe where song_id='$song_id'");
foreach($choreographe_id_ex as $choreographe_id)
{
	mysqli_query($con, "insert into song_choreographe(song_id, choreographe_id) values ('$song_id', '$choreographe_id')");
}

$music_label_id=mysqli_real_escape_string($con,implode(",",$_POST['music_label']));
$music_label_id_ex=explode(",",$music_label_id);
mysqli_query($con, "delete from song_lable where song_id='$song_id'");
foreach($music_label_id_ex as $lable_id)
{
	mysqli_query($con, "insert into song_lable(song_id, lable_id) values ('$song_id', '$lable_id')");
}
$recreated_by_id=mysqli_real_escape_string($con,implode(",",$_POST['recreated_by']));
$recreated_by_id_ex=explode(",",$recreated_by_id);
mysqli_query($con, "delete from song_recreated where song_id='$song_id'");
foreach($recreated_by_id_ex as $recreated_by_id_f)
{
	mysqli_query($con, "insert into song_recreated(song_id, recreated_by) values ('$song_id', '$recreated_by_id_f')");
}


$fname1=strtolower(str_replace(" ", "-", $title)); 
$alias=preg_replace("/[^a-zA-Z0-9-]/", "",$fname1 );


 $update_film_song="update film_song set film_id='$film_id',title='$title',alias='$alias',language='$language_id_id',singer='$singer',youtube='$youtube',details='$details',hdetails='$hdetails',about='$about',remake='$remake',remake_original_song_name='$remake_original_song_name',orginial_song_from='$remake_original_datafrom',song_upload_date='$song_upload_date',song_upload_month='$song_upload_month',song_upload_year='$song_upload_year',best_song='$best_song',youtube_upload_date='$youtube_upload_date',youtube_upload_month='$youtube_upload_month',youtube_upload_year='$youtube_upload_year',youtube_video_viwe='$youtube_video_viwe',all_time_best_song='$all_time_best_song', updated_date=now()  where id='$song_id'";
            mysqli_query($con,$update_film_song) or die(mysql_error());
            header('location:film_song.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con, "delete from film_song where id='$_REQUEST[id]'");

header("location:film_song.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Film Song Management</title>
      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <!-- Start Global Mandatory Style-->
        
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
      <!-- End Global Mandatory Style-->
       
      <!-- Start Theme Layout Style-->
      
      <!-- Theme style -->
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
      <!-- Theme style rtl -->
      <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
      <!-- End Theme Layout Style-->
      
		 
		  <!-- select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		 
		 
		 

		
<?php include "tinymce.php"; ?>
<link href="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">

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

    <select name="film_id" class="form-control select2" required>
        
        <option value="">-Please Select Film-</option>

        <?php

        $sqlfr = mysqli_query($con,"
            SELECT 
                film.id,
                film.name,
                film.year_release,
                dubbing.name AS lang_name
            FROM film
            LEFT JOIN dubbing 
                ON dubbing.id = film.main_lang
            ORDER BY film.name ASC
        ");

        while($rowfr = mysqli_fetch_assoc($sqlfr)) {

        ?>

        <option 
            value="<?php echo $rowfr['id']; ?>"
            <?php if(isset($_GET['film_id']) && $_GET['film_id'] == $rowfr['id']) echo "selected"; ?>
        >

            <?php 
            echo $rowfr['name']; 
            ?> 
            (
            <?php 
            echo $rowfr['year_release']; 
            ?> -
            <?php 
            echo $rowfr['lang_name']; 
            ?>
            )

        </option>

        <?php } ?>

    </select>

</div>
                             <div class="form-group">
                                 <label>Title</label>
                                 <input type="text" class="form-control" name="title" placeholder="Enter Song Title"  >
                              </div>
                          
                            <div class="form-group">
                                 <label>You Tube Link</label>
                                 <input type="text" class="form-control" name="youtube" placeholder="Enter You Tube Link"  >
                              </div>
                
                       

     <div class="form-group">
                                 <label>Lyrics (Details)</label>
                                 <textarea name="details" rows="25"></textarea> 
                              </div>
                             
     <div class="form-group">
                                 <label>Hindi Lyrics (Details)</label>
                                 <textarea name="hdetails" rows="25"></textarea> 
                              </div>
                             
 
     <div class="form-group">
                                 <label>About Song</label>
                                 <textarea name="about" rows="25"><? echo $row['about'];?></textarea> 
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

<? if($_GET['Action']=="Update"){
	
$id2=$_GET['id'];
$sql="select * from film_song where id='$id2'";
$song_id=$_GET["id"];
$rs=mysqli_query($con,$sql);
$row_main=mysqli_fetch_array($rs);

?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Update Film Song</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">

							 



                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                               <div class="form-group">
    <label>Film Name</label>

    <select name="film_id" class="form-control select2">

        <?php

        $sqlfr = mysqli_query($con, "
            SELECT 
                film.id,
                film.name,
                film.year_release,
                film.main_lang,
                dubbing.name AS lang_name
            FROM film
            LEFT JOIN dubbing 
                ON dubbing.id = film.main_lang
            ORDER BY film.name ASC
        ");

        while($rowfr = mysqli_fetch_assoc($sqlfr)) {

        ?>

        <option 
            value="<?php echo $rowfr['id']; ?>"
            <?php if($rowfr['id'] == $row_main['film_id']) echo "selected"; ?>
        >

            <?php 
            echo $rowfr['name']; 
            ?>
            (
            <?php 
            echo $rowfr['year_release']; 
            ?>
            -
            <?php 
            echo $rowfr['lang_name']; 
            ?>
            )

        </option>

        <?php } ?>

    </select>

</div>
                             <div class="form-group">
                                 <label>Title</label>
                                 <input type="text" class="form-control" name="title" placeholder="Enter Song Title" value="<? echo $row_main['title'];?>"   >
                              </div>


 
                            <div class="form-group">
                                 <label>You Tube Link</label>
                                 <input type="text" class="form-control" name="youtube" value="<? echo $row_main['youtube'];?>"  placeholder="Enter You Tube Link"  >
                              </div>
							    <div class="row">
                               
                  
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Song Langauge</strong>
                              </div>
                         <div class="form-group col-sm-10">

<?php


$tmp = $row_main['language'];

?>

<input type="text"
       placeholder="Enter Language Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="song_language_list"
       data-value-property="value"
       name="lang_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="song_language_list">

<?php

/* LOAD ALL LANGUAGES */

$sqlfr = mysqli_query($con,"
    SELECT id, song_language
    FROM song_language
    ORDER BY song_language ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php echo $rowfr['song_language']; ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div>
							   <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float:right;">Song Genre</strong>
                              </div>
                         <div class="form-group col-sm-10">

<?php

/* SELECTED GENRES */

$genre_ids = [];

$song_genre_query = mysqli_query($con,"
    SELECT genre_id
    FROM song_genre
    WHERE song_id = '$song_id'
");

while($row = mysqli_fetch_assoc($song_genre_query)) {

    $genre_ids[$row['genre_id']] = $row['genre_id'];

}

/* CREATE COMMA SEPARATED VALUE */

$tmp = implode(',', $genre_ids);

?>

<input type="text"
       placeholder="Enter Genre Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="genre_list"
       data-value-property="value"
       name="genre_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="genre_list">

<?php

/* LOAD ALL GENRES */

$sqlfr = mysqli_query($con,"
    SELECT id,name
    FROM genresong
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)) {

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

</option>

<?php } ?>

</datalist>

</div>
                              </div>
							  <div class="row">
                        <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Cast</strong>
                              </div>
                         <div class="form-group col-sm-10">

<?php

$cast_id_id = [];
$tmp = '';

/* SONG CAST QUERY WITH JOIN */

$song_cast_query = mysqli_query($con, "
    SELECT 
        song_cast.cast_id,
        cast.id,
        cast.name
    FROM song_cast
    LEFT JOIN cast 
        ON cast.id = song_cast.cast_id
    WHERE song_cast.song_id = '$song_id'
");

while($row = mysqli_fetch_assoc($song_cast_query)) {

    $cast_id_id[$row['id']] = $row['id'];

}

/* CREATE COMMA VALUE */

$tmp = implode(',', $cast_id_id);

?>

<input type="text"
       placeholder="Enter Cast Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="other_cast"
       data-value-property="value"
       name="cast_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="other_cast">

<?php

/* LOAD ALL CAST ONLY ONCE */

$sqlfr = mysqli_query($con, "
    SELECT id,name,nickname 
    FROM cast 
    ORDER BY id DESC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)) {

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>
(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])) { ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  
                       
                            
							
							  </div>
                          
 <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Music Director</strong>
                              </div>
                          <div class="form-group col-sm-10">

<?php

/* STORE SELECTED MUSIC DIRECTOR IDS */

$music_director_ids = [];

$song_music_director_query = mysqli_query($con,"
    SELECT music_director_id
    FROM song_music_director
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_music_director_query)){

    $music_director_ids[$row['music_director_id']] = $row['music_director_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $music_director_ids);

?>

<input type="text"
       placeholder="Enter Music Director Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="music_director_list"
       data-value-property="value"
       name="music_director_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="music_director_list">

<?php

/* LOAD ALL MUSIC DIRECTORS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM music_director
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div>
                               <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Music Producer</strong>
                              </div>
                           <div class="form-group col-sm-10">

<?php

/* STORE SELECTED MUSIC PRODUCER IDS */

$music_producer_ids = [];

$song_music_producer_query = mysqli_query($con,"
    SELECT music_producer_id
    FROM song_music_producer
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_music_producer_query)){

    $music_producer_ids[$row['music_producer_id']] = $row['music_producer_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $music_producer_ids);

?>

<input type="text"
       placeholder="Enter Music Producer Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="music_producer_list"
       data-value-property="value"
       name="music_producer_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="music_producer_list">

<?php

/* LOAD ALL MUSIC PRODUCERS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM music_producer
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div>
                             
 <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Singer</strong>
                              </div>
                          <div class="form-group col-sm-10">

<?php

/* STORE SELECTED SINGER IDS */

$singer_ids = [];

$song_singer_query = mysqli_query($con,"
    SELECT singer_id
    FROM song_singer
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_singer_query)){

    $singer_ids[$row['singer_id']] = $row['singer_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $singer_ids);

?>

<input type="text"
       placeholder="Enter Singer Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="singer_list"
       data-value-property="value"
       name="singer_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="singer_list">

<?php

/* LOAD ALL SINGERS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM singer
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div>
   
    <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Rap Singer</strong>
                              </div>
                          <div class="form-group col-sm-10">

<?php

/* STORE SELECTED SINGER IDS */

$rap_singer_ids = [];

$song_rap_singer_query = mysqli_query($con,"
    SELECT singer_id
    FROM song_rap_singer
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_rap_singer_query)){

    $rap_singer_ids[$row['singer_id']] = $row['singer_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $rap_singer_ids);

?>

<input type="text"
       placeholder="Enter Rap Singer Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="singer_list"
       data-value-property="value"
       name="rap_singer_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="singer_list">

<?php

/* LOAD ALL SINGERS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM singer
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div> 
							   <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Background Vocal</strong>
                              </div>
                          <div class="form-group col-sm-10">

<?php

/* STORE SELECTED SINGER IDS */

$background_vocal_ids = [];

$song_background_vocal_query = mysqli_query($con,"
    SELECT singer_id
    FROM song_background_vocal
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_background_vocal_query)){

    $background_vocal_ids[$row['singer_id']] = $row['singer_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $background_vocal_ids);

?>

<input type="text"
       placeholder="Enter Background Vocal Singer Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="singer_list"
       data-value-property="value"
       name="background_vocal_singer_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="singer_list">

<?php

/* LOAD ALL SINGERS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM singer
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div> 
							   <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Supported Vocal</strong>
                              </div>
                          <div class="form-group col-sm-10">

<?php

/* STORE SELECTED SINGER IDS */

$supported_vocal_ids = [];

$song_supported_vocal_query = mysqli_query($con,"
    SELECT singer_id
    FROM song_supported_vocal
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_supported_vocal_query)){

    $supported_vocal_ids[$row['singer_id']] = $row['singer_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $supported_vocal_ids);

?>

<input type="text"
       placeholder="Enter Suppoted Vocal Singer Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="singer_list"
       data-value-property="value"
       name="supported_vocal_singer_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="singer_list">

<?php

/* LOAD ALL SINGERS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM singer
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div> 
   <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Additional Vocal</strong>
                              </div>
                          <div class="form-group col-sm-10">

<?php

/* STORE SELECTED ADDITIONAL VOCAL IDS */

$additional_vocal_ids = [];

$song_additional_vocal_query = mysqli_query($con,"
    SELECT singer_id
    FROM song_additional_vocal
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_additional_vocal_query)){

    $additional_vocal_ids[$row['singer_id']] = $row['singer_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $additional_vocal_ids);

?>

<input type="text"
       placeholder="Enter Additional Vocal Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="additional_vocal_list"
       data-value-property="value"
       name="additional_vocal[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="additional_vocal_list">

<?php

/* LOAD ALL SINGERS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM singer
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div>
  <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Lyricist</strong>
                              </div>
                           <div class="form-group col-sm-10">

<?php

/* STORE SELECTED LYRICIST IDS */

$lyricist_ids = [];

$song_lyricist_query = mysqli_query($con,"
    SELECT lyricist_id
    FROM song_lyricist
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_lyricist_query)){

    $lyricist_ids[$row['lyricist_id']] = $row['lyricist_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $lyricist_ids);

?>

<input type="text"
       placeholder="Enter Lyricist Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="lyricist_list"
       data-value-property="value"
       name="lyricist_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="lyricist_list">

<?php

/* LOAD ALL LYRICISTS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM lyricist
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div>
							  
      <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Rap Lyricist</strong>
                              </div>
                           <div class="form-group col-sm-10">

<?php

/* STORE SELECTED LYRICIST IDS */

$rap_lyricist_ids = [];

$song_lyricist_query = mysqli_query($con,"
    SELECT lyricist_id
    FROM song_rap_lyricist
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_lyricist_query)){

    $rap_lyricist_ids[$row['lyricist_id']] = $row['lyricist_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $rap_lyricist_ids);

?>

<input type="text"
       placeholder="Enter Rap Lyricist Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="lyricist_list"
       data-value-property="value"
       name="rap_lyricist_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="lyricist_list">

<?php

/* LOAD ALL LYRICISTS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM lyricist
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div>                  

 <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Composer</strong>
                              </div>
                         <div class="form-group col-sm-10">

<?php

/* STORE SELECTED COMPOSER IDS */

$composer_ids = [];

$song_composer_query = mysqli_query($con,"
    SELECT song_composer_id
    FROM song_Composer
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_composer_query)){

    $composer_ids[$row['song_composer_id']] = $row['song_composer_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $composer_ids);

?>

<input type="text"
       placeholder="Enter Composer Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="composer_list"
       data-value-property="value"
       name="song_composer_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="composer_list">

<?php

/* LOAD ALL COMPOSERS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM music_director
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
                              </div>
							  
                              

 <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Music Arranged</strong>
                              </div>
                           <div class="form-group col-sm-10">

<?php

/* STORE SELECTED ARRANGED IDS */

$arranged_ids = [];

$song_arranged_query = mysqli_query($con,"
    SELECT arranged_id
    FROM song_music_arranged
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_arranged_query)){

    $arranged_ids[$row['arranged_id']] = $row['arranged_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $arranged_ids);

?>

<input type="text"
       placeholder="Enter Arranger Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="arranged_list"
       data-value-property="value"
       name="arranged_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="arranged_list">

<?php

/* LOAD ALL ARRANGERS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM music_director
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div>

 <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">  Music Programmer</strong>
                              </div>
                           <div class="form-group col-sm-10">

<?php

/* STORE SELECTED PROGRAMMER IDS */

$programmer_ids = [];

$song_programmer_query = mysqli_query($con,"
    SELECT programmer_id
    FROM song_music_programmer
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_programmer_query)){

    $programmer_ids[$row['programmer_id']] = $row['programmer_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $programmer_ids);

?>

<input type="text"
       placeholder="Enter Programmer Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="programmer_list"
       data-value-property="value"
       name="programmer_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="programmer_list">

<?php

/* LOAD ALL PROGRAMMERS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM music_director
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div>
                               
                             
                           <div class="row">   


    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Mixed</strong>
                              </div>
                         <div class="form-group col-sm-10">

<?php

/* STORE SELECTED MIXED IDS */

$mixed_ids = [];

$song_mixed_query = mysqli_query($con,"
    SELECT mixed_id
    FROM song_mixed
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_mixed_query)){

    $mixed_ids[$row['mixed_id']] = $row['mixed_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $mixed_ids);

?>

<input type="text"
       placeholder="Enter Mixed By Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="mixed_list"
       data-value-property="value"
       name="mixed_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="mixed_list">

<?php

/* LOAD ALL MIXING ARTISTS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM music_director
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
                             </div>
							  <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Matered</strong>
                              </div>
                          <div class="form-group col-sm-10">

<?php

/* STORE SELECTED MASTERED IDS */

$mastered_ids = [];

$song_mastered_query = mysqli_query($con,"
    SELECT matered_id
    FROM song_matered
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_mastered_query)){

    $mastered_ids[$row['matered_id']] = $row['matered_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $mastered_ids);

?>

<input type="text"
       placeholder="Enter Mastered By Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="mastered_list"
       data-value-property="value"
       name="matered_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="mastered_list">

<?php

/* LOAD ALL MASTERING ARTISTS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM music_director
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div>
                               <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Additional Lyrics</strong>
                              </div>
                           <div class="form-group col-sm-10">

<?php

/* STORE SELECTED ADDITIONAL LYRICS IDS */

$additional_lyrics_ids = [];

$song_additional_lyrics_query = mysqli_query($con,"
    SELECT additional_lyrics_id
    FROM song_additional_lyrics
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_additional_lyrics_query)){

    $additional_lyrics_ids[$row['additional_lyrics_id']] = $row['additional_lyrics_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $additional_lyrics_ids);

?>

<input type="text"
       placeholder="Enter Additional Lyrics Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="additional_lyrics_list"
       data-value-property="value"
       name="additional_lyrics_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="additional_lyrics_list">

<?php

/* LOAD ALL LYRICISTS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM lyricist
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div>
							
                            <div class="row">   
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Rap</strong>
                              </div>
                          <div class="form-group col-sm-10">

<?php

/* STORE SELECTED RAP IDS */

$rap_ids = [];

$song_rap_query = mysqli_query($con,"
    SELECT rap_id
    FROM song_rap
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_rap_query)){

    $rap_ids[$row['rap_id']] = $row['rap_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $rap_ids);

?>

<input type="text"
       placeholder="Enter Rap Artist Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="rap_list"
       data-value-property="value"
       name="rap_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="rap_list">

<?php

/* LOAD ALL RAP ARTISTS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM lyricist
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
                              </div>

 <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong style="float:right;">Choreographer</strong>
                              </div>
                         <div class="form-group col-sm-10">

<?php

/* STORE SELECTED CHOREOGRAPHER IDS */

$choreographer_ids = [];

$song_choreographer_query = mysqli_query($con,"
    SELECT choreographe_id
    FROM song_choreographe
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_choreographer_query)){

    $choreographer_ids[$row['choreographe_id']] = $row['choreographe_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $choreographer_ids);

?>

<input type="text"
       placeholder="Enter Choreographer Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="choreographer_list"
       data-value-property="value"
       name="choreographe_id[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="choreographer_list">

<?php

/* LOAD ALL CHOREOGRAPHERS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM choreographer
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
                              </div>


 <div class="row">

    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Music Label</strong>
                              </div>
                          <div class="form-group col-sm-10">

<?php

/* STORE SELECTED MUSIC LABEL IDS */

$music_label_ids = [];

$song_music_label_query = mysqli_query($con,"
    SELECT lable_id
    FROM song_lable
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_music_label_query)){

    $music_label_ids[$row['lable_id']] = $row['lable_id'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $music_label_ids);

?>

<input type="text"
       placeholder="Enter Music Label Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="music_label_list"
       data-value-property="value"
       name="music_label[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="music_label_list">

<?php

/* LOAD ALL MUSIC LABELS */

$sqlfr = mysqli_query($con,"
    SELECT id,music_label
    FROM music_label
    ORDER BY music_label ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['music_label']; 
?>

</option>

<?php } ?>

</datalist>

</div>
                               </div>
                <div class="row">
    <div class="form-group col-sm-2">
    
                              <strong  style="float: right;">Recreated By</strong>
                              </div>
                          <div class="form-group col-sm-10">

<?php

/* STORE SELECTED RECREATED BY IDS */

$recreated_ids = [];

$song_recreated_query = mysqli_query($con,"
    SELECT recreated_by
    FROM song_recreated
    WHERE song_id='$song_id'
");

while($row = mysqli_fetch_assoc($song_recreated_query)){

    $recreated_ids[$row['recreated_by']] = $row['recreated_by'];

}

/* CREATE COMMA SEPARATED IDS */

$tmp = implode(',', $recreated_ids);

?>

<input type="text"
       placeholder="Enter Recreated By Name"
       class="flexdatalist"
       data-min-length="1"
       style="width:100%;"
       list="recreated_list"
       data-value-property="value"
       name="recreated_by[]"
       value="<?php echo $tmp; ?>"
       multiple="multiple"
/>

<datalist id="recreated_list">

<?php

/* LOAD ALL MUSIC DIRECTORS */

$sqlfr = mysqli_query($con,"
    SELECT id,name,nickname
    FROM music_director
    ORDER BY name ASC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

?>

<option value="<?php echo $rowfr['id']; ?>">

<?php 
echo $rowfr['name']; 
?>

(ID:<?php echo $rowfr['id']; ?>)

<?php if(!empty($rowfr['nickname'])){ ?>

Nick Name: <?php echo $rowfr['nickname']; ?>

<?php } ?>

</option>

<?php } ?>

</datalist>

</div>
							  </div>
 
                           <div class="form-group">
                                 <label>Remake</label>
                                 
                                 <select class="form-control" name="remake" id="remake">
                        <option value="<? if(empty($row_main['remake'])){ echo "no";}else {echo $row_main['remake'];}?>" ><? if(empty($row_main['remake'])){ echo "No";}else {echo $row_main['remake'];}?></option>
                              <option value="no">No</option>
                              <option value="yes">Yes</option>
                                 </select>
                                
                              </div>
							    <div id="isremake" style="display:none;border: 1px solid black;padding: 14px;">
                                  <fieldset>
                                   <div class="form-group">
                                 <label>Select Data From</label>
                                 
                                 <select class="form-control" name="datafrom" id="datafrom">
                                 <option value="<? echo $row_main['orginial_song_from'];?>" ><? echo $row_main['orginial_song_from'];?></option>
                              <option value="Music Video">Music Video</option>
                              <option value="Film Song">Film Song</option>
                                 </select>
                                
                              </div>
                              <div id="film_song">
								   <label>Original Film Song</label>
								  <select class="form-control select2" style="width:100%;" name="remake_original_film_song_name">
								   <? 
								   if($row_main["remake_original_song_name"]==""){
									   ?>
								   <option value="">-Select Original Song-</option>
								   <? } else { 
                              $original_song_id=$row["remake_original_song_name"];
                              $orginal_song="select * from film_song where id='$original_song_id'";
$orginal_song_exe=mysqli_query($con,$orginal_song);
$orginal_song_read=mysqli_fetch_array($orginal_song_exe);
                              ?>
								   <option value="<? echo $row_main["remake_original_song_name"];?>"><? echo $orginal_song_read["title"];?></option>
								   <? } ?>
								  <?

$orginal_song="select * from film_song";
$orginal_song_exe=mysqli_query($con,$orginal_song);
while($orginal_song_read=mysqli_fetch_array($orginal_song_exe)){
   $film_id=$orginal_song_read["film_id"];
   $song_id=$orginal_song_read["id"];
   							$sqlfsl_name=mysqli_query($con, "select * from film where id='$film_id'") or die(mysqli_error($con));
$rowfsl_name=mysqli_fetch_array($sqlfsl_name); 
               $sqlfsl=mysqli_query($con, "select * from songlanguage where song_id='$song_id'") or die(mysqli_error($con));
$rowfsl=mysqli_fetch_array($sqlfsl);
    $language_id=$rowfsl['language_id'];
     $sqll=mysqli_query($con, "select * from song_language where id='$language_id'");
 $rowl=mysqli_fetch_array($sqll);
// $ulang=strtolower($ulang.", ".$rowl['song_language']);  
                   
                                     ?>
<option value="<? echo $orginal_song_read["id"];?>"><? echo $orginal_song_read["title"];?>(<? echo $rowfsl_name["name"];?>-<? echo $rowl['song_language']?>)</option>
								  
<? } ?>
								  </select>
                          </div>
                           <div id="music_video_song">
								   <label>Original Music Video</label>
								  <select class="form-control select2" style="width:100%;" name="remake_original_video_song_name">
								   <? 
								   if($row_main["remake_original_song_name"]==""){
									   ?>
								   <option value="">-Select Original Music Video Song-</option>
								   <? } else { 
								    $original_song_id=$row_main["remake_original_song_name"];
                              $orginal_song="select * from videosong where id='$original_song_id'";
$orginal_song_exe=mysqli_query($con,$orginal_song);
$orginal_song_read=mysqli_fetch_array($orginal_song_exe);
								   
								   ?>
								   <option value="<? echo $orginal_song_read["id"];?>"><? echo $orginal_song_read["title"];?></option>
								   <? } ?>
								  <?
 $original_song_id=$row["remake_original_song_name"];
$orginal_song="select * from videosong";
$orginal_song_exe=mysqli_query($con,$orginal_song);
while($orginal_song_read=mysqli_fetch_array($orginal_song_exe)){	
   		$video_song_language_id=$orginal_song_read["language"];					 
                           $song_language="select * from song_language where id='$video_song_language_id'";
$song_language_exe=mysqli_query($con,$song_language);
$song_language_read=mysqli_fetch_array($song_language_exe);       
                                     ?>
								  <option value="<? echo $orginal_song_read["id"];?>"><? echo $orginal_song_read["title"];?> (<? echo $song_language_read["song_language"];?>)</option>
								  
<? } ?>
								  </select>
                          </div>
								  </fieldset>
								  </div>
							  <!--
							  <div class="form-group">
                                 <label>Song Upload Date</label> 
                                 <input type="text" class="form-control" name="song_upload_date" value="<? echo $row_main['song_upload_date'];?>"  placeholder="no"  >
                              </div>
							  
							  <div class="form-group">
                                 <label>Song Upload Month</label>
                                 <input type="text" class="form-control" name="song_upload_month" value="<? echo $row_main['song_upload_month'];?>"  placeholder="no"  >
                              </div>
							  
							  <div class="form-group">
                                 <label>Song Upload Year</label>
                                 <input type="text" class="form-control" name="song_upload_year" value="<? echo $row_main['song_upload_year'];?>"  placeholder="no"  >
                              </div>
							  -->
							  <div class="form-group">
                                 <label>Best Song</label>
                                 <select class="form-control" name="best_song">
                                 <option value="<? if(empty($row_main['best_song'])){ echo "no";}else {echo $row_main['best_song'];}?>" ><? if(empty($row_main['best_song'])){ echo "No";}else {echo $row_main['best_song'];}?></option>
                              <option value="no">No</option>
                              <option value="yes">Yes</option>
                                 </select>
                                
                              </div>
							  <div class="form-group">
                                 <label>All Time Best Song</label>
                                 <select class="form-control" name="all_time_best_song">
                                 <option value="<? if(empty($row_main['all_time_best_song'])){ echo "no";}else {echo $row_main['all_time_best_song'];}?>" ><? if(empty($row_main['all_time_best_song'])){ echo "No";}else {echo $row_main['all_time_best_song'];}?></option>
                              <option value="no">No</option>
                              <option value="yes">Yes</option>
                                 </select>
                                
                              </div>
							  
							  
							  
							  							  <div class="form-group">
                                 <label>YouTube Upload Date</label>
                                 <input type="text" class="form-control" name="youtube_upload_date" value="<? echo $row_main['youtube_upload_date'];?>"  placeholder="no"  >
                              </div>
 
 <div class="form-group">
                                 <label>YouTube Upload Month</label>
                                 <input type="text" class="form-control" name="youtube_upload_month" value="<? echo $row_main['youtube_upload_month'];?>"  placeholder="no"  >
                              </div>
 
 <div class="form-group">
                                 <label>YouTube Upload Year</label>
                                 <input type="text" class="form-control" name=" youtube_upload_year" value="<? echo $row_main['youtube_upload_year'];?>"  placeholder="no"  >
                              </div>
							  <div class="form-group">
                                 <label> Youtube video Views</label>
                                 <input type="text" class="form-control" name=" youtube_video_viwe" value="<? echo $row_main['youtube_video_viwe'];?>"  placeholder="no"  >
                              </div>
 



 
                              <input type="hidden" name="id" value="<? echo $row_main['id'];?>">

     <div class="form-group">
                                 <label>Lyrics (Details)</label>
                                 <textarea name="details" rows="25"><? echo $row_main['details'];?></textarea> 
                              </div>
                             
 
     <div class="form-group">
                                 <label>Hindi Lyrics (Details)</label>
                                 <textarea name="hdetails" rows="25"><? echo $row_main['hdetails'];?></textarea> 
                              </div>
                             
 
     <div class="form-group">
                                 <label>About Song</label>
                                 <textarea name="about" rows="25"><? echo $row_main['about'];?></textarea> 
                              </div>
                             
							 
							
                             
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
                                 <h4>film_song List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                          
                         

 <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="film_song.php?Action=Add"> <i class="fa fa-plus"></i> Add film_song
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
    url: "search_film_song.php",
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
<!-- 
<input type="text" class="search form-control" id="searchid" placeholder="Search for Film Song" style="width: 100%" />  
<div id="result"></div>
 

<br><br> -->
 <select class="form-control select2"   onChange="window.document.location.href=this.options[this.selectedIndex].value;">
<option value="">Search Film Song
</option>
<?php $sqlfs=mysqli_query($con, "select * from film_song");
while($rowfs=mysqli_fetch_array($sqlfs)){ 

   $ulang="";   
   $song_id=$rowfs["id"]; 
$sqlfsl=mysqli_query($con, "select * from songlanguage where song_id='$song_id'") or die(mysqli_error($con));
while($rowfsl=mysqli_fetch_array($sqlfsl)){
    $language_id=$rowfsl['language_id'];
     $sqll=mysqli_query($con, "select * from song_language where id='$language_id'");
 $rowl=mysqli_fetch_array($sqll);
 $ulang=strtolower($ulang.", ".$rowl['song_language']);
}

$ulang=substr($ulang, 1);
         //echo $ulang;
 
 ?>

<option value="film_song.php?Action=Update&id=<?php echo $rowfs['id']; ?>"><?php echo $rowfs['title']; ?> (<? echo $ulang;?>) </option>
<?php } ?>

 </select><br><br>




                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>title</th>    
                                       <th>Film</th>    
                                       
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `film_song`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `film_song` order by id desc LIMIT $offset, $total_records_per_page");



 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                       <td><? echo $row['title']; ?></td> 
                               <td><? $film_id= $row['film_id'];
$sqlf=mysqli_query($con, "select * from film where id='$film_id'");
$rowf=mysqli_fetch_array($sqlf);
echo $rowf['name'];

                                ?></td> 
                              
                                    
                                       <td>
                                          

                                          <a href="film_song.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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
      <!-- Start Core Plugins-->
    
		 
		 
		 
		 
		 
		 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
<script>
  $(document).ready(function() {
    $('.searchwithselect2').select2();
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
<script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>
<script>
$('.flexdatalist').flexdatalist({
     minLength: 1,
	 selectionRequired: true,
	  valueProperty: 'value'
});
</script>
		 
		 
		 
		 
		 
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
      <!-- End Core Plugins-->
      <!-- Start Theme label Script-->

      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
      <!-- End Theme label Script-->
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

$(document).ready(function() {
    $('.select2').select2();
});
</script>
<script>
$(function() {
   $("#remake").change(function(){
        if($('#remake').val() == 'yes') {
            $('#isremake').show(); 
        } else {
            $('#isremake').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   
        if($('#remake').val() == 'yes') {
            $('#isremake').show(); 
        } else {
            $('#isremake').hide(); 
        } 
   
});
 </script>

 <script>
$(function() {
   $("#datafrom").change(function(){
        if($('#datafrom').val() == 'Film Song') {
            $('#film_song').show(); 
            $('#music_video_song').hide(); 
        } else {
            $('#film_song').hide(); 
        } 
    });
});
 </script>

 <script>
$(function() {
   $("#datafrom").change(function(){
        if($('#datafrom').val() == 'Music Video') {
            $('#music_video_song').show(); 
             $('#film_song').hide(); 
        } else {
            $('#music_video_song').hide(); 
        } 
    });
});
 </script>

 <script>
$(function() {
   
        if($('#datafrom').val() == 'Film Song') {
            $('#film_song').show(); 
            $('#music_video_song').hide(); 
        } else if ($('#datafrom').val() == 'Music Video'){
            $('#film_song').hide(); 
             $('#music_video_song').show(); 
           
            
        } 
        else
        {
         $('#film_song').hide(); 
          $('#music_video_song').hide();
        }
   
});
 </script>