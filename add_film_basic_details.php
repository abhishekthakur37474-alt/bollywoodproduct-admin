<?
session_start();
date_default_timezone_set('Asia/Kolkata');
$currentDate = date('Y-m-d\TH:i:sP');
$last_update=date('d-m-Y h:i:s A');
// Create a DateTime object in IST
$dateTime = new DateTime($currentDate, new DateTimeZone('Asia/Kolkata'));

// Convert to UTC
$dateTime->setTimezone(new DateTimeZone('UTC'));

// Format the date to the desired output
 $utcDate = $dateTime->format('Y-m-d\TH:i:s\Z');

include "config.php";
include("../functions/search/search-insert-update.php");
include("../functions/film-url.php");
if($_SESSION['admin']==""){
     header("location:index.php");
      }


if(isset($_POST["basic_details"])) {

    // ✅ Helper function for safe POST
    function post($key){
        return isset($_POST[$key]) ? trim($_POST[$key]) : '';
    }

    function postArray($key){
        return isset($_POST[$key]) ? implode(",", array_filter($_POST[$key])) : '';
    }

    // ✅ Collect Data
    $season = post('season');
    $meaningfilm =mysqli_real_escape_string($con,post('film_meaning'));
    $type = post('type');
    $country = postArray('country');
   // $name = mysqli_real_escape_string($con, post('name'));
    $name = trim($_POST['name']); // Original value
    //$name =post('name1');
    $original_title = mysqli_real_escape_string($con, post('original_title'));
    $main_language = postArray('main_language');
    $film_slug = post('film_slug_permalink');
    $panindia = post('panindia');
    $pan_language = postArray('pan_language');
    $Real = post('Real');
    $Sequel = post('Sequel');
    $sequel_type = postArray('sequel_type');
    $sequel_film_name = postArray('sequel_film_name');
    $Installment = postArray('Installment');
    $genre_id = postArray('genre_id');
    $budget = post('budget');

    $date_release = post('date_release');
    $month_release = post('month_release');
    $year_release = post('year_release');

    $shelved_unreleased = post('shelved_unreleased');
    $showonfront = post('showonfront');
    $releasing_platform = post('releasing_platform');
    $ott_platform_name = post('ott_platform_name');
    $posterbyurl = post('posterbyurl');

    $platform_country = postArray('platform_country');
    $platform_name = postArray('platform_name');
    $platform_sub_type = postArray('platform_sub_type');
    $platform_date = postArray('platform_date');
    $platform_month = postArray('platform_month');
    $platform_year = postArray('platform_year');
    $platform_is_rerelease = postArray('platform_is_rerelease');
    $platform_language_id = postArray('platform_language_id');

    $remake = post('remake');
    $remake_original_film_name = post('remake_original_film_name');
    $is_tentatively = post('is_tentatively');
    $franchise_name = post('franchise_name');
    $also_known_as = post('also_known_as');

    // ✅ FAST unique id (NO DB LOOP)
function generateUniqueId($con) {
    do {
        
        $unique_id = rand(100000, 999999);
        $sqluc = "SELECT COUNT(*) as count FROM film WHERE unique_id = '$unique_id'";
         $result = mysqli_query($con, $sqluc); 
        $rowuc=mysqli_fetch_array($result);
        $count=$rowuc['count'];
    } while ($count > 0); 

    return $unique_id;
}






$unique_id = generateUniqueId($con);

    // ✅ Clean alias
    $alias = preg_replace('/[^a-z0-9-]/', '', strtolower(str_replace(' ', '-', $name)));
    

$alias_new=sanitize(preg_replace("/[^a-zA-Z0-9-]/", "",$alias ));
    // ✅ Prepared Statement
    $stmt = $con->prepare("INSERT INTO film SET 
        is_tentatively=?,
        updated_at=?,
        unique_id=?,
        type=?,
        name=?,
        original_title=?,
        alias=?,
        alias_new=?,
        season=?,
        country=?,
        budget=?,
        cbfc_releasing_platform=?,
        cbfc_releasing_platform_details=?,
        main_lang=?,
        youtube=?,
        date_release=?,
        month_release=?,
        year_release=?,
        film_meaning=?,
        film_slug_permalink=?,
        panindia=?,
        pan_language=?,
        real_name=?,
        sequel=?,
        sequel_type=?,
        sequel_film_name=?,
        installment=?,
        shelved_unreleased=?,
        show_on_front=?,
        film_genre=?,
        platform_country=?,
        platform_name=?,
        platform_sub_type=?,
        platform_date=?,
        platform_month=?,
        platform_year=?,
        platform_is_rerelease=?,
        platform_language_id=?,
        last_updated=?,
        remake_original_film_name=?,
        remake=?,
        franchise_name=?,
        also_known_as=?,
        updated_date=NOW(),
        created_date=NOW()
    ");

    $stmt->bind_param(
        "sssssssssssssssssssssssssssssssssssssssssss",
        $is_tentatively,
        $last_update,
        $unique_id,
        $type,
        $name,
        $original_title,
        $alias,
        $alias,
        $season,
        $country,
        $budget,
        $releasing_platform,
        $ott_platform_name,
        $main_language,
        $posterbyurl,
        $date_release,
        $month_release,
        $year_release,
        $meaningfilm,
        $film_slug,
        $panindia,
        $pan_language,
        $Real,
        $Sequel,
        $sequel_type,
        $sequel_film_name,
        $Installment,
        $shelved_unreleased,
        $showonfront,
        $genre_id,
        $platform_country,
        $platform_name,
        $platform_sub_type,
        $platform_date,
        $platform_month,
        $platform_year,
        $platform_is_rerelease,
        $platform_language_id,
        $utcDate,
        $remake_original_film_name,
        $remake,
        $franchise_name,
        $also_known_as
    );

    // ✅ Execute
    if($stmt->execute()){
        $stmt->close();
      

      
         include('../test-unique-alias-film.php');
         $film_id = mysqli_insert_id($con);


$poster = "https://img.youtube.com/vi/$posterbyurl/0.jpg";
$language_name = '';

if (!empty($main_language)) {

    // Convert comma-separated IDs to integers
    $language_ids = array_map('intval', explode(',', $main_language));

    // Remove any invalid values
    $language_ids = array_filter($language_ids);

    if (!empty($language_ids)) {

        $id_list = implode(',', $language_ids);

        $lang_sql = mysqli_query($con, "
            SELECT name
            FROM dubbing
            WHERE id IN ($id_list)
            ORDER BY FIELD(id, $id_list)
        ");

        $language_names = [];

        while ($lang_row = mysqli_fetch_assoc($lang_sql)) {
            $language_names[] = $lang_row['name'];
        }

        $language_name = implode(', ', $language_names);
    }
}
$type = trim(strtolower($type));

// Replace every occurrence of "film" with "movie"
$type = str_replace('film', 'movie', $type);

// SEO slug
$type = preg_replace('/\s+/', '-', $type);
$alias = strtolower(trim($alias));
$alias = preg_replace('/\s+/', '-', $alias);

$movie_url = $type . "/" . $alias . "/" . $unique_id;

$subtitle = trim("$year_release $language_name $type");
$search_type='original';
updateSearchIndex(
    $con,
    $type,
    $film_id,
    $name,
    $subtitle,
    $name . " " . $alias . " " . $genre_id,
    $movie_url,
    $poster,
    NULL,
    100,
    $search_type
);
           header("Location: film_basic_details.php?success=1");
        exit;
    } else {
        error_log($stmt->error);
        echo "Something went wrong";
    }
      $con->close(); // ✅ CLOSE CONNECTION (IMPORTANT)
}
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Add Film Basic Details</title>
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
            <!--textaera------css-->
            <link href="/admin/richtext.min.css" rel="stylesheet" type="text/css"/>
            <link href="/admin/site.css" rel="stylesheet" type="text/css"/>
      <!-- End Global Mandatory Style
         =====================================================================-->
      <!-- Start Theme Layout Style
         =====================================================================-->
      <!-- Theme style -->
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>

     <link href="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
  <!-- select2 -->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

 <style>
     select
     {
         width:100%;
     }
     fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
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
                  <!--<h1>Film Basic Details Management</h1>-->
                  <small>Add New Film Basic Details</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">

 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Add Film Basic Details Here</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                             <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                     <div class="form-group">
                                 <label>Type</label>
                                 <select class="form-control" name="type" required>
                                     <option value="">-Select Type-</option>
                                      <? $sqlfr=mysqli_query($con, "select * from  filetypemanagement order by film_type");
                                  
                                 while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['film_type']; ?>"><? echo $rowfr['film_type']; ?></option>
                                  <? } ?>
                                </select>
                              </div>
                              <div class="form-group" >
                                 <label>Is Tentatively Title?</label>
                                <select class="form-control" id="is_tentatively" name="is_tentatively">
<option value="no">No</option>
<option value="yes">Yes</option>
                                </select>
                              </div>
                              
                              <div class="form-group">
                                 <label>Film Title</label>
                                 <input type="text" class="form-control" name="name" placeholder="Enter name"  >
                              </div>
                               <div class="form-group">
                                 <label>Original Title (optional)</label>
                                 <input type="text" class="form-control" name="original_title" placeholder="Original Title"  >
                              </div>
                                <div class="form-group">
                                 <label>Film Season</label>
                                 <input type="text" class="form-control" name="season" placeholder="Enter season"   >
                              </div>
                              <div class="form-group">
                                 <label>Film Meaning(optional)</label>
                                 <input type="text" class="form-control" name="film_meaning" placeholder="Enter Film Meaning"  >
                              </div>
                              <div class="form-group">
                                 <label>Also known as (optional)</label>
                                 <input type="text" class="form-control" name="also_known_as" placeholder="Also known as"  >
                              </div>
                            <div class="form-group">
<label>Nationality(s)</label>

<input type='text'
placeholder='Enter Country'
class="flexdatalist"
data-min-length='1'
style='width:100%;'
list='country_name'
data-value-property='value'
name='country[]'
multiple
>

<datalist id="country_name">

<?php
$sqlfr = mysqli_query($con, "SELECT * FROM country ORDER BY country_name");

while($rowfr = mysqli_fetch_assoc($sqlfr)){
?>

<option value="<?php echo $rowfr['country_name']; ?>">
<?php echo $rowfr['country_name']; ?>
</option>

<?php } ?>

</datalist>

</div>
                                 <div class="form-group">
<label>Main Language(s)</label>

<input type='text'
placeholder='Enter Language'
class="flexdatalist"
data-min-length='1'
style='width:100%;'
list='language_name'
data-value-property='value'
name='main_language[]'
multiple
required
>

<datalist id="language_name">

<?php
$sqlfr = mysqli_query($con, "SELECT * FROM dubbing ORDER BY name");

while($rowfr = mysqli_fetch_assoc($sqlfr)){
?>

<option value="<?php echo $rowfr['id']; ?>">
<?php echo $rowfr['name']; ?> (ID:<?php echo $rowfr['id']; ?>)
</option>

<?php } ?>

</datalist>

</div>
                                <div class="form-group">
                                 <label>Film Slug</label>
                                <input type="text" name="film_slug" class="form-control" id="film_slug"  onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)"  placeholder="Enter Slug"/>
                                 <label for="title">Permalink URL:</label>
                            <input type="text" class="form-control" name="film_slug_permalink" id="film_slug_permalink"  placeholder="Permalink URL Value" readonly />
                              </div>
                                <div class="form-group">
                                 <label>Film Genre</label>
                                 
                                 <input type='text'
placeholder='Enter Genre'
class="flexdatalist"
data-min-length='1'
style='width:100%;'
list='genre_ids'
data-value-property='value'
name='genre_id[]'
multiple

>

<datalist id="genre_ids">

  <? $sqlfr=mysqli_query($con, "select * from genre order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<?php echo $rowfr['id']; ?>">
<?php echo $rowfr['name']; ?> (ID:<?php echo $rowfr['id']; ?>)
</option>

<?php } ?>

</datalist>

                               
                                 </div>
                                    <div class="form-group">
                                 <label>Remake</label>
                                 <select class="form-control" name="remake" id="remake">
                                
                              <option value="no">No</option>
                              <option value="yes">Yes</option>
                                 </select>
                                
                              </div>
                                   <div class="form-group">
                                 <label>Is Franchise?</label>
                                 <select class="form-control" name="franchise" id="franchise">
                                
                              <option value="no">No</option>
                              <option value="yes">Yes</option>
                                 </select>
                                
                              </div>
                               	    <div id="isfranchise" style="display:none;border: 1px solid black;padding: 14px;">
                                  <fieldset>
								   <label>Franchise Name</label>
								 <input list="franchise_list" name="franchise_name" class="form-control" id="franchise_name">
								 <datalist id="franchise_list">
								     <?
								     $film_franchise_name="select DISTINCT franchise_name from film where franchise_name<>''";
								     $film_franchise_name_exe=mysqli_query($con,$film_franchise_name);
								     while($read_film_franchise_name=mysqli_fetch_array($film_franchise_name_exe)){
								     ?>
                                  <option value="<? echo $read_film_franchise_name['franchise_name']?>">
                                      <? } ?>
                                 </datalist>
								  </fieldset>
								  </div>
							    <div id="isremake" style="display:none;border: 1px solid black;padding: 14px;">
                                  <fieldset>
								   <label>Original Film</label>
								  <select class="form-control select2" style="width:100%;" name="remake_original_film_name">
								  
								   <option value="">-Select Original Film-</option>
								  
								  <?

$sqlfs=mysqli_query($con, "select * from film");
while($rowfs=mysqli_fetch_array($sqlfs)){ 
$main_lang=explode(",",$rowfs['main_lang']);
$main_language="";
foreach ($main_lang as $x) {
  $sqlld=mysqli_query($con, "select * from dubbing where id='$x'");
  $rowld=mysqli_fetch_array($sqlld);
  $main_language=$main_language.", ".$rowld['name'];

}
 
$main_language=substr($main_language, 2);
 ?>								 
                                     
                                   
								  <option value="<? echo $rowfs["id"];?>"><? echo $rowfs["name"];?>-<?php echo $rowfs['year_release']; ?>-<?php echo $main_language; ?></option>
								  
<? } ?>
								  </select>
								  </fieldset>
								  </div>
                               <div class="form-group">
                                 <label>PAN India:</label>
                                 <select class="form-control" id="panindia" name="panindia" required>
                                    <option value="No">No</option>
                                     <option value="Yes">Yes</option>
                                     
                                     
                                </select>
                              </div>
                                    <div id="ispan" style="display: block;border: 1px solid black;padding: 14px;">
                                        <div class="form-group  ">
                                <label>Select PAN Lanaguage(s)</label>
                                 
   <select class="main_language"  class="form-control" name="pan_language[]" multiple="multiple">
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
                                    </div>
                                    
                                     <div class="form-group">
                                 <label>Real:</label>
                                 <select class="form-control" id="Real" name="Real" required>
                                     <option value="No">No</option>
                                     <option value="Yes">Yes</option>
                                  
                                     
                                </select>
                              </div>
                              
                              
                              
                              

                                  
                               <div class="form-group">
                                 <label>Sequel:</label>
                                 <select class="form-control" id="Sequel" name="Sequel" required>
                                      <option value="No">No</option>
                                     <option value="Yes">Yes</option>
                                   
                                </select>
                              </div>
                              
                              
                              
                              
                              
                  
                   <div id="isSequel" style="display: block;border: 1px solid black;padding: 14px;">
                          <label>Fill Following Franchise  Details of This Film:</label>
                                <br/>
                                <div class="field_wrapper3">
                                <a href="javascript:void(0);" class="add_button3 btn btn-success pull-right" title="Add More">Add More</a>
                                     <br/>
                                        <div class="form-group  ">
                                <label>Select Sequel Type</label>
                                 
   <select class="form-control" name="sequel_type[]" >
                                  <option value="">-Please Select-</option>
                                     <option value="Sequel">Sequel</option>
                                     <option value="Prequel">Prequel</option>
                                     <option value="Quasi Sequel">Quasi Sequel</option>
                                 </select>
                                 
                              </div> 
                               <div class="form-group  ">
                             
                                 <label>Film Title(s)</label>
                                 
 <select class="main_language"  class="form-control select2" name="sequel_film_name[]">
                                  <? $sqlfr=mysqli_query($con, "select * from film order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){
                                    $main_lang=explode(",",$rowfr['main_lang']);
$main_language="";
foreach ($main_lang as $x) {
  $sqlld=mysqli_query($con, "select * from dubbing where id='$x'");
  $rowld=mysqli_fetch_array($sqlld);
  $main_language=$main_language.", ".$rowld['name'];

}
 
$main_language=   substr($main_language, 2);
                                    
                                     ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>-<?php echo $rowfr['year_release']; ?>-<?php echo $main_language; ?>  </option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
                               <div class="form-group  ">
                                <label>Installment:</label>
                                <input type="text" name="Installment[]" class="form-control"/>
                                </div>
                              </div>
                                    </div>
                                    
                                    
                              
                                   <div class="form-group">
                                 <label>Budget (in Crore)</label>
                                 <input type="text" class="form-control" name="budget" placeholder="Enter Budget"  >
                              </div>
                              <div class="form-group">
                                 <label>Releasing Platform:</label>
                                 <select class="form-control" id="releasing_platform" name="releasing_platform" required>
                                     <option value="">-Please Select-</option>
                                      <? $sqlfr=mysqli_query($con, "select * from  platform order by platform_name");
                                  
                                 while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['platform_name']; ?>"><? echo $rowfr['platform_name']; ?></option>
                                  <? } ?>
                                      
        
                                </select>
                              </div>
							     <div class="form-group" id="ott_platform_name">
                                 <label>OTT Platform</label>
                                 <select class="form-control" name="ott_platform_name">
                                     <option value="">-Select OTT Platform Name-</option>
                                       <? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                </select>
                              </div>
							  
                           <div class="form-group">
                                 <label> Date Release</label>
                                 <input type="text" class="form-control" name="date_release" placeholder="Enter  Date Release"  >
                              </div>
                          <div class="form-group">
                                 <label> Month Release</label>
                                 <input type="text" class="form-control" name="month_release" placeholder="Enter  Month Release"  >
                              </div>
                           <div class="form-group">
                                 <label>Year Release</label>
                                 <input type="text" class="form-control" name="year_release" placeholder="Enter Year Release"  >
                              </div>
                              
                                
                              <div class="form-group">
                                 <label>Latest Trailer/Teaser By YouTube Link:</label>
                                   <input type="text"  name="posterbyurl"  class="form-control">
                                  
                              </div>
                              
                             <div class="form-group">
                                 <label>Is This Film Show on Frontent?</label>
                             
 <select name="showonfront" class="form-control">
<option value="No">No</option>      
<option value="Yes">Yes</option>


                                 
                                 </select> 
                              </div>
                             

      <div class="form-group">
                                 <label>Is This Film Shelved/Unreleased?</label>
                             
 <select name="shelved_unreleased" class="form-control" > 
<option value="No">No</option>      
<option value="Yes">Yes</option>


                                 
                                 </select> 
                              </div>
                                  <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Release Info</h4>
                              </a>
                           </div>
                        </div>
                              <div class="panel-body">
						
						 <div class="form-group">
        <label for="country">Release Country</label>
        <select class="form-control main_language" id="country" name="platform_country[]">
            <option value="">-Select Country-</option>
            <?php

            $query = "select * from country1 order by country_name";
            // $query = mysqli_query($con, $qr);
            $result = $con->query($query);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

            ?>
                    <option value="<?php echo $row['country_name']; ?>"><?php echo $row['country_name']; ?></option>
            <?php
                }
            }

            ?>

        </select>
    </div>

   <div class="form-group">
                                 <label>Platform Language:</label>
                                <select  class="form-control search_in_dropdown main_language" id="platform_language_id" name="platform_language_id[]"  style="width:100%:"  >
                                    <option value="">-Select Language-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div> 




                            <div class="form-group">
                                 <label>Platform Name:</label>
                                <select  class="form-control search_in_dropdown main_language" id="platform_name" name="platform_name[]"  style="width:100%:"  >
                                    <option value="">-Select Platform-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from platform order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['platform_name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div> 
                               <div id="platform_details_film_festival" style="display:none;border: 1px solid black;padding: 14px;">
                                  <fieldset>
								   <label>Select Film Festival Name</label>
								 <select  class="form-control search_in_dropdown main_language" id="festival_name" name="platform_sub_type[]"  style="width:100%:"  >
								     <option value="">-Please Select-</option>
								     <?
								     $film_festival_name="select * from film_festival";
								     $film_festival_exe=mysqli_query($con,$film_festival_name);
								     while($read_film_festival_name=mysqli_fetch_array($film_festival_exe)){
								     ?>
                                  <option value="<? echo $read_film_festival_name['name']?>"><? echo $read_film_festival_name['name']?></option>
                                      <? } ?>
                                 </select>
								  </fieldset>
								  </div>
								   <div id="platform_details_tv_serial" style="display:none;border: 1px solid black;padding: 14px;">
                                  <fieldset>
								   <label>Select TV Serial Channel</label>
								 <select  class="form-control search_in_dropdown main_language" id="tv_serial_name" name="platform_sub_type[]"  style="width:100%:"  >
								     <option value="">-Please Select-</option>
								     <?
								     $film_tv_name="select * from tv_channels";
								     $film_tv_exe=mysqli_query($con,$film_tv_name);
								     while($read_tv_name=mysqli_fetch_array($film_tv_exe)){
								     ?>
                                  <option value="<? echo $read_tv_name['name']?>"><? echo $read_tv_name['name']?></option>
                                      <? } ?>
                                 </select>
								  </fieldset>
								  </div>
								    <div id="youtube_channel_name" style="display:none;border: 1px solid black;padding: 14px;">
                                  <fieldset>
								   <label>Select YouTube Channel</label>
								 <select  class="form-control search_in_dropdown main_language"  name="platform_sub_type[]"  style="width:100%:"  >
								     <option value="">-Please Select-</option>
								     <?
								     $film_youtube_name="select * from music_label";
								     $film_youtube_exe=mysqli_query($con,$film_youtube_name);
								     while($read_youtube_name=mysqli_fetch_array($film_youtube_exe)){
								     ?>
                                  <option value="<? echo $read_youtube_name['music_label']?>"><? echo $read_youtube_name['music_label']?></option>
                                      <? } ?>
                                 </select>
								  </fieldset>
								  </div>
								    <div id="ott_details_name" style="display:none;border: 1px solid black;padding: 14px;">
                                  <fieldset>
								   <label>Select OTT Platform Name</label>
								 <select  class="form-control search_in_dropdown main_language"  name="platform_sub_type[]"  style="width:100%:"  >
								     <option value="">-Please Select-</option>
								     <?
								     $film_ott_name="select * from ott_platform";
								     $film_ott_exe=mysqli_query($con,$film_ott_name);
								     while($read_ott_name=mysqli_fetch_array($film_ott_exe)){
								     ?>
                                  <option value="<? echo $read_ott_name['name']?>"><? echo $read_ott_name['name']?></option>
                                      <? } ?>
                                 </select>
								  </fieldset>
								  </div>
         
  <div class="form-group">
    <label for="character">Release Date:</label>
    <input type="text" class="form-control" id="character" name="platform_date[]" >
  </div>
   <div class="form-group">
    <label for="remark">Release Month:</label>
    <input type="text" class="form-control" id="otherremark" name="platform_month[]" >
  </div>
  <div class="form-group">
    <label for="remark">Release Year:</label>
    <input type="text" class="form-control" id="otherremark" name="platform_year[]" >
  </div>

  
   <div class="form-group">
                                 <label>Platform Is Rerelase:</label>
                                <select  class="form-control search_in_dropdown main_rerelease" id="platform_is_rerelease" name="platform_is_rerelease[]"  style="width:100%:"  >
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                             
                                 </select>
                                  
                              </div> 




   <div class="field_wrapper2"></div>
   <a href="javascript:void(0);" class="add_button2 btn btn-success pull-right" title="Add More">Add More Release</a><br/>
  </div>
               <div class="reset-button">

                                   <input type="submit" name="basic_details"  class="btn btn-add"  value="Add Basic Record">
                            
                              </div>
                        </br>      
          </div> 
                        
        </form>  
                </section>  
            <!-- /.content -->
         </div>
          
         <!-- /.content-wrapper -->
       <?php include('footer.php');?>
      </div>
    
  </div>
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
   <script src="/admin/assets/bootstrap/js/jquery.richtext.js"></script>
<script src="/admin/assets/bootstrap/js/jquery.richtext.min.js"></script>
<script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>
<script>
$('.flexdatalist').flexdatalist({
     minLength: 1,
	 selectionRequired: true,
	  valueProperty: 'value'
});
</script>
  <script>
  
	/* Encode string to slug */
function convertToSlug(str) {
    
  //replace all special characters | symbols with a space
  str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
           .toLowerCase();
    
  // trim spaces at start and end of string
  str = str.replace(/^\s+|\s+$/gm,'');
    
  // replace space with dash/hyphen
  str = str.replace(/\s+/g, '-');  
 $("#film_slug_permalink").val(str); 
  //document.getElementById("slug1").innerHTML = str;
  //return str;
}
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

<?php
$sqlfr = mysqli_query($con, "select * from cast order by name");
$options = '';
while ($rowfr = mysqli_fetch_array($sqlfr)) {
    $new_string = str_replace("'", "", $rowfr["name"]);
    $nick_name = str_replace("'", "", $rowfr["nickname"]);
    $showing='(ID:"'.$rowfr['id'].'"Nick Name:"'.$nick_name.'")';
    $options .= '<option value="' . $rowfr["id"] . '">' . $new_string . $showing.'</option>';
}
?>
<script>
$(document).ready(function(){
    var maxField_multiple_role = 10; //Input fields increment limitation
    var addButton_multiple_role = $('.add_button_multiple_role'); //Add button selector
    var wrapper_multiple_role = $('.field_wrapper_multiple_role'); //Input field wrapper
    var fieldHTML_multiple_role = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                              
                             '<div class="form-group">'+
                               '<label>Actors Name:</label>'+
    '<input type="text" placeholder="Enter Cast Name" class="flexdatalist" data-min-length="1" style="width:100%;" list="other_cast", data-value-property="value"  name="multiple_actor_name[]" value="" style="width:100%;" />'+
	   '<datalist id="other_cast" >'+
	    
                             '<? echo $options ?>'+
                                 
'</datalist>'+						
                                '</div>'+

                                '<div class="form-group">'+
                                '<label>Character  Name:</label>'+
                                '<input type="text" name="multiple_character_name[]" class="form-control"/>'+
                                '</div>'+
								 '<div class="form-group">'+
                                '<label>Number of Roles:</label>'+
                                '<input type="number" name="number_of_roles[]" class="form-control"/>'+
                                '</div>'+
                                '<div class="form-group">'+
                                '<label>Remarks:</label>'+
                                '<input type="text" name="multiple_remarks[]" class="form-control"/>'+
                                '</div>'+
                          
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    // Once add button is clicked
    $(addButton_multiple_role).click(function(){
        //Check maximum number of input fields
        if(x < maxField_multiple_role){ 
            x++; //Increase field counter
            $(wrapper_multiple_role).append(fieldHTML_multiple_role); //Add field html
			$('.flexdatalist').flexdatalist({
     minLength: 1
});
           
        }else{
            alert('A maximum of '+maxField_multiple_role+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper_multiple_role).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
   
});
</script>
 <?php
$sqlfr = mysqli_query($con, "select * from film order by name");
$options = '';
while ($rowfr = mysqli_fetch_array($sqlfr)) {

   $main_lang=explode(",",$rowfr['main_lang']);
$main_language="";
foreach ($main_lang as $x) {
  $sqlld=mysqli_query($con, "select * from dubbing where id='$x'");
  $rowld=mysqli_fetch_array($sqlld);
  $main_language=$main_language.", ".$rowld['name'];

}
 
$main_language=   substr($main_language, 2);
                                    
                                    
    $FilmName = $rowfr['name'];
    $FilmName1 = str_replace("'", "", $FilmName);
	 //$FilmName1=str_replace ("'","\'",$FilmName2);
    $options .= '<option value="' . $rowfr["id"] . '">' . $FilmName1 .'-'. $rowfr['year_release'] .'-'. $main_language .'</option>';
}
?>

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
                                 
 '<select  class="form-control main_language select2" name="sequel_film_name[]">'+
                                  '<?php echo $options; ?>'+
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
            alert('A maximum of '+maxField3+' fields are allowed to be added. ');
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
$(function() {
    jQuery(document).ready(function($){
        if($('#Multiple_Roles').val() == 'Yes') {
            $('#is_Multiple_Roles').show(); 
        } else {
            $('#is_Multiple_Roles').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#Multiple_Roles").change(function(){
        if($('#Multiple_Roles').val() == 'Yes') {
            $('#is_Multiple_Roles').show(); 
        } else {
            $('#is_Multiple_Roles').hide(); 
        } 
    });
});
 </script>
 

 
 <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#panindia').val() == 'Yes') {
            $('#ispan').show(); 
        } else {
            $('#ispan').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#panindia").change(function(){
        if($('#panindia').val() == 'Yes') {
            $('#ispan').show(); 
        } else {
            $('#ispan').hide(); 
        } 
    });
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
      
            $('#ott_platform_name').hide(); 
        
    });
});
 </script>
 
  <script>
$(function() {
   $("#releasing_platform").change(function(){
        if($('#releasing_platform').val() == 'OTT') {
            $('#ott_platform_name').show(); 
        } else {
            $('#ott_platform_name').hide(); 
        } 
    });
});
 </script>
 <script>
$(document).ready(function(){
    var maxField2 = 10; //Input fields increment limitation
    var addButton2 = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper2'); //Input field wrapper
    var fieldHTML2 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+


     
      '<div class="form-group">'+
        '<label for="country">Release Language</label>'+
        '<select class="form-control language" id="language" name="platform_language_id[]">'+
           '<option value="">-Select Language-</option>'+
            <?php

            $query = "select * from dubbing order by name";
            // $query = mysqli_query($con, $qr);
            $result = $con->query($query);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

            ?>
                    '<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>'+
            <?php
                }
            }

            ?>

        '</select>'+
'</div>'+






     
      '<div class="form-group">'+
        '<label for="country">Release Country</label>'+
        '<select class="form-control main_language" id="country" name="platform_country[]">'+
           '<option value="">-Select Country-</option>'+
            <?php

            $query = "select * from country1 order by country_name";
            // $query = mysqli_query($con, $qr);
            $result = $con->query($query);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

            ?>
                    '<option value="<?php echo $row['country_name']; ?>"><?php echo $row['country_name']; ?></option>'+
            <?php
                }
            }

            ?>

        '</select>'+
'</div>'+
  
   '<div class="form-group">'+
   
  '<label>Platform Name:</label>'+
  '<select class="form-control search_in_dropdown" name="platform_name[]" id="platform_name1" onchange="platform_details()" style="width:100%;">'+
    '<option value="">-Select Platform-</option>'+
    <? $sqlfr=mysqli_query($con, "select * from platform order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['id']; ?>">'+
'<? echo $rowfr['platform_name']; ?>'+
'</option>'+
                                  <? } ?>
  '</select>'+
'</div>'+
  
   '<div id="platform_details_film_festival" style="display:none;border: 1px solid black;padding: 14px;">'+
                                  '<fieldset>'+
								   '<label>Select Film Festival Name</label>'+
								 '<select  class="form-control search_in_dropdown main_language" id="festival_name" name="platform_sub_type[]"  style="width:100%:"  >'+
								     '<option value="">-Please Select-</option>'+
								     <?
								     $film_festival_name="select * from film_festival";
								     $film_festival_exe=mysqli_query($con,$film_festival_name);
								     while($read_film_festival_name=mysqli_fetch_array($film_festival_exe)){
								     ?>
                                  '<option value="<? echo $read_film_festival_name['name']?>"><? echo $read_film_festival_name['name']?></option>'+
                                      <? } ?>
                                '</select>'+
								 '</fieldset>'+
								 '</div>'+
								   '<div id="platform_details_tv_serial" style="display:none;border: 1px solid black;padding: 14px;">'+
                                  '<fieldset>'+
								   '<label>Select TV Serial Channel</label>'+
								 '<select  class="form-control search_in_dropdown main_language" id="tv_serial_name" name="platform_sub_type[]"  style="width:100%:"  >'+
								     '<option value="">-Please Select-</option>'+
								     <?
								     $film_tv_name="select * from tv_channels";
								     $film_tv_exe=mysqli_query($con,$film_tv_name);
								     while($read_tv_name=mysqli_fetch_array($film_tv_exe)){
								     ?>
                                  '<option value="<? echo $read_tv_name['name']?>"><? echo $read_tv_name['name']?></option>'+
                                      <? } ?>
                                 '</select>'+
								  '</fieldset>'+
								  '</div>'+
								    '<div id="youtube_channel_name" style="display:none;border: 1px solid black;padding: 14px;">'+
                                 '<fieldset>'+
								   '<label>Select YouTube Channel</label>'+
								 '<select  class="form-control search_in_dropdown main_language"  name="platform_sub_type[]"  style="width:100%:"  >'+
								     '<option value="">-Please Select-</option>'+
								     <?
								     $film_youtube_name="select * from music_label";
								     $film_youtube_exe=mysqli_query($con,$film_youtube_name);
								     while($read_youtube_name=mysqli_fetch_array($film_youtube_exe)){
								     ?>
                                  '<option value="<? echo $read_youtube_name['music_label']?>"><? echo $read_youtube_name['music_label']?></option>'+
                                      <? } ?>
                                 '</select>'+
								  '</fieldset>'+
								  '</div>'+
								    '<div id="ott_details_name" style="display:none;border: 1px solid black;padding: 14px;">'+
                                  '<fieldset>'+
								   '<label>Select OTT Platform Name</label>'+
								 '<select  class="form-control search_in_dropdown main_language"  name="platform_sub_type[]"  style="width:100%:"  >'+
								     '<option value="">-Please Select-</option>'+
								     <?
								     $film_ott_name="select * from ott_platform";
								     $film_ott_exe=mysqli_query($con,$film_ott_name);
								     while($read_ott_name=mysqli_fetch_array($film_ott_exe)){
								     ?>
                                  '<option value="<? echo $read_ott_name['name']?>"><? echo $read_ott_name['name']?></option>'+
                                      <? } ?>
                                 '</select>'+
								  '</fieldset>'+
								  '</div>'+
  
  
  '<div class="form-group">'+
    '<label for="character">Release Date:</label>'+
    '<input type="text" class="form-control" id="character"  name="platform_date[]" >'+
  '</div>'+
   '<div class="form-group">'+
    '<label for="remark">Release Month:</label>'+
    '<input type="text" class="form-control" id="remark"  name="platform_month[]" >'+
  '</div>'+
  '<div class="form-group">'+
    '<label for="remarkk">Release Year:</label>'+
    '<input type="text" class="form-control" id="remarkk"  name="platform_year[]" >'+
                  '</div>'+
    '<div class="form-group">'+
                '<label for="is_rerelease">Is Re-Release:</label>'+
                '<select class="form-control search_in_dropdown" name="platform_is_rerelease[]" id="platform_is_rerelease" style="width: 100%;" aria-label="Is Rerelease">'+
                    
                        '<option value="No" >No</option>'+
                        '<option value="Yes" >Yes</option>'+
                 
                '</select>'+
            '</div>'
                  
                  
                  ;//New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton2).click(function(){
        //Check maximum number of input fields
        if(x < maxField2){ 
            x++; //Increase field counter
            $(wrapper2).append(fieldHTML2); //Add field html
            $('.main_language').select2();
			$('.flexdatalist1').flexdatalist({
     minLength: 1
});
           
        }else{
            alert('A maximum of '+maxField2+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper2).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
     // Event delegation for platform name change to trigger platform_details
    $(wrapper2).on('change', '#platform_name1', function(){
        platform_details(this);
    });
});
</script>


<script>
$('.flexdatalist').flexdatalist({
     minLength: 1,
	 selectionRequired: true
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
   $("#franchise").change(function(){
        if($('#franchise').val() == 'yes') {
            $('#isfranchise').show(); 
        } else {
            $('#isfranchise').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   
        if($('#franchise').val() == 'yes') {
            $('#isfranchise').show(); 
        } else {
            $('#isfranchise').hide(); 
        } 
   
});
 </script>
  <script>
$(function() {
   $("#platform_name").change(function(){
        if($('#platform_name').val() == '7') {
            $('#platform_details_film_festival').show(); 
        } else {
            $('#platform_details_film_festival').hide(); 
        }
          if($('#platform_name').val() == '6') {
            $('#platform_details_tv_serial').show(); 
        } else {
            $('#platform_details_tv_serial').hide(); 
        }
            if($('#platform_name').val() == '5') {
            $('#youtube_channel_name').show(); 
        } else {
            $('#youtube_channel_name').hide(); 
        }
         if($('#platform_name').val() == '4') {
            $('#ott_details_name').show(); 
        } else {
            $('#ott_details_name').hide(); 
        }
        
        
        
    });
});
function platform_details(selectElem)
{
   const selectedValue = $(selectElem).val();
  
    const parentDiv = $(selectElem).closest('div').parent(); // Get the parent div of the select
    // Hide all platform detail sections initially
    parentDiv.find('#platform_details_film_festival, #platform_details_tv_serial, #youtube_channel_name, #ott_details_name').hide();
    // Show the relevant section based on the selected platform
    if (selectedValue == '7') { // Assuming '1' is the ID for Film Festival
        parentDiv.find('#platform_details_film_festival').show();
    } else if (selectedValue == '6') { // Assuming '2' is the ID for TV Serial
        parentDiv.find('#platform_details_tv_serial').show();
    } else if (selectedValue == '5') { // Assuming '3' is the ID for YouTube
        parentDiv.find('#youtube_channel_name').show();
    } else if (selectedValue == '4') { // Assuming '4' is the ID for OTT
        parentDiv.find('#ott_details_name').show();
    }
    
}
 </script>
   </body>
  
</html>

