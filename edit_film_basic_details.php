<?

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

session_start();
include "config.php";
include("../functions/search/search-insert-update.php");
include("../functions/film-url.php");
date_default_timezone_set('Asia/Kolkata');
 $currentDate = date('Y-m-d\TH:i:sP');
$last_update=date('d-m-Y h:i:s A');
// Create a DateTime object in IST
$dateTime = new DateTime($currentDate, new DateTimeZone('Asia/Kolkata'));

// Convert to UTC
 $dateTime->setTimezone(new DateTimeZone('UTC'));

// Format the date to the desired output
  $utcDate = $dateTime->format('Y-m-d\TH:i:s\Z');
if($_SESSION['admin']==""){
     header("location:index.php");
      }


/* ✅ Auto close connection safely */
register_shutdown_function(function() use ($con) {
    if ($con) mysqli_close($con);
});

/* ✅ Validate ID */
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die("Invalid ID");
}

/* ✅ Fetch minimal data */
$add_basic_details="select * from film where id='$id'";
$exe_add=mysqli_query($con,$add_basic_details) or die(mysqli_error($con));
$read=mysqli_fetch_array($exe_add);

/* ✅ Only allow POST */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["basic_details"])) {

   /* ===========================
   Safe POST Helpers
=========================== */
function post($key){
    return $_POST[$key] ?? '';
}

function postArray($key){
    return (isset($_POST[$key]) && is_array($_POST[$key]))
        ? implode(",", array_filter($_POST[$key]))
        : '';
}

/* ===========================
   Collect Data
=========================== */

$meaningfilm = post('film_meaning');
$season = post('season');
$type = post('type');
$country = postArray('country');
$name = trim(post('name'));
$original_title = post('original_title');
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
$platform_date = postArray('platform_date');
$platform_month = postArray('platform_month');
$platform_year = postArray('platform_year');

$platform_sub_type = $_POST['platform_sub_type'] ?? [];

if (in_array('Theater', $platform_sub_type)) {
    array_unshift($platform_sub_type, '');
}

$platform_sub_type = implode(",", array_filter($platform_sub_type));

$platform_is_rerelease = postArray('platform_is_rerelease');
$platform_language_id = postArray('platform_language_id');

$remake = post('remake');
$is_tentatively = post('is_tentatively');
$franchise_name = post('franchise_name');
$also_known_as = post('also_known_as');

$remake_original_film_name = ($remake == "no") ? "" : post('remake_original_film_name');

/* ===========================
   Alias
=========================== */

$name1 = strtolower(str_replace(" ", "-", $name));
$alias = preg_replace("/[^a-zA-Z0-9-]/", "", $name1);
$alias_new = sanitize($alias);

/* ===========================
   Prepared Update
=========================== */

$stmt = $con->prepare("
UPDATE film SET
is_tentatively=?,
updated_at=?,
type=?,
name=?,
original_title=?,
alias=?,
alias_new=?,
season=?,
country=?,
budget=?,
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
film_genre=?,
show_on_front=?,
cbfc_releasing_platform=?,
cbfc_releasing_platform_details=?,
platform_name=?,
platform_sub_type=?,
platform_date=?,
platform_month=?,
platform_year=?,
platform_is_rerelease=?,
last_updated=?,
remake_original_film_name=?,
remake=?,
franchise_name=?,
also_known_as=?,
platform_country=?,
platform_language_id=?,
updated_date=NOW()
WHERE id=?
");

$stmt->bind_param(
"ssssssssssssssssssssssssssssssssssssssssssi",

$is_tentatively,
$last_update,
$type,
$name,
$original_title,
$alias,
$alias_new,
$season,
$country,
$budget,
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
$genre_id,
$showonfront,
$releasing_platform,
$ott_platform_name,
$platform_name,
$platform_sub_type,
$platform_date,
$platform_month,
$platform_year,
$platform_is_rerelease,
$utcDate,
$remake_original_film_name,
$remake,
$franchise_name,
$also_known_as,
$platform_country,
$platform_language_id,
$id
);

if(!$stmt->execute()){
    die($stmt->error);
}

$stmt->close();
  
         echo "<script>alert('Basic Details Updated Succesfully')</script>";
         include('../test-unique-alias-film.php');
         
$poster = "https://img.youtube.com/vi/$posterbyurl/0.jpg";
$unique_id=$read["unique_id"];
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
    $id,
    $name,
    $subtitle,
    $name . " " . $alias . " " . $genre_id,
    $movie_url,
    $poster,
    NULL,
    100,
    $search_type
);
 echo "<script>window.location.href='film_basic_details.php'</script>";
         
}
?>
       
         
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Basic Details</title>
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
                  <h1>Film Basic Details Management</h1>
                  <small>Edit Film Basic Details</small>
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
                                 <h4>Edit Film Basic Details Here</h4>
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
                                     <option value="<?php echo $read["type"];?>" selected><?php echo $read["type"];?></option>
                                      <? $sqlfr=mysqli_query($con, "select * from  filetypemanagement order by film_type");
                                  
                                 while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['film_type']; ?>"><? echo $rowfr['film_type']; ?></option>
                                  <? } ?>
                                </select>
                              </div>
                               <div class="form-group" >
                                 <label>Is Tentatively Title?</label>
                                <select class="form-control" id="is_tentatively" name="is_tentatively">
<option value="<? echo $read['is_tentatively'] ?>"><? echo $read["is_tentatively"]; ?></option>
<option value="no">No</option>
<option value="yes">Yes</option>
                                </select>
                              </div>
                              
                              <div class="form-group">
                                 <label>Film Title</label>
                                 <input type="text" class="form-control" name="name" value="<?php echo $read["name"];?>" placeholder="Enter name"  >
                              </div>
                               <div class="form-group">
                                 <label>Original Title (optional)</label>
                                 <input type="text" class="form-control" name="original_title" value="<?php echo $read["original_title"];?>" placeholder="Original Title"  >
                              </div>
                               <div class="form-group">
                                 <label>Film Season</label>
                                 <input type="text" class="form-control" name="season" value="<?php echo $read["season"];?>" placeholder="Enter season"   >
                              </div>
                              <div class="form-group">
                                 <label>Film Meaning(optional)</label>
                                 <input type="text" class="form-control" name="film_meaning" value="<?php echo $read["film_meaning"];?>" placeholder="Enter Film Meaning"  >
                              </div>
                               <div class="form-group">
                                 <label>Also known as (optional)</label>
                                 <input type="text" class="form-control" name="also_known_as" placeholder="Also known as" value="<?php echo $read["also_known_as"];?>"  >
                              </div>
                               <?    $country_name=explode(",",$read["country"]);
														$tmp = '';
                                       
                                   
                                     foreach($country_name as $country_name_read){
										
										 $tmp .=$country_name_read. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
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
value='<? echo $tmp?>'
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
                                         <?    
                                                $manin_lang=explode(",",$read["main_lang"]);
       
														$tmp = '';
                                       
                                   
                                   foreach($manin_lang as $manin_lang_read){
										 $language_name="select * from dubbing where id='$manin_lang_read'";
           $sqlfr_lang=mysqli_query($con,$language_name);
           $read_name_lang=mysqli_fetch_array($sqlfr_lang);
           $main_lang_read_id=$read_name_lang['id'];
           $read_name_lang=$read_name_lang['name'];
										 $tmp .=$main_lang_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
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
value='<? echo $tmp?>'
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
                                <input type="text" name="film_slug" class="form-control" id="film_slug"   onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)"  placeholder="Enter Slug"/>
                                 <label for="title">Permalink URL:</label>
                            <input type="text" class="form-control" name="film_slug_permalink" id="film_slug_permalink" value="<?php echo $read["film_slug_permalink"];?>"  placeholder="Permalink URL Value" readonly />
                              </div>
                               <div class="form-group">
                                 <label>Film Genre</label>
    <?php
$film_genre_ids = array_filter(
    array_map('trim', explode(',', $read['film_genre'] ?? ''))
);

$selected_genres = [];

if (!empty($film_genre_ids)) {

    $id_list = implode(',', array_map('intval', $film_genre_ids));

    $sql_selected = mysqli_query($con, "
        SELECT id, name
        FROM genre
        WHERE id IN ($id_list)
        ORDER BY FIELD(id, $id_list)
    ");

    while ($row = mysqli_fetch_assoc($sql_selected)) {
        $selected_genres[] = $row;
    }
}
?>

<input type="text"
    placeholder="Enter Genre"
    class="flexdatalist"
    data-min-length="1"
    style="width:100%;"
    list="genre_ids"
    data-value-property="value"
    name="genre_id[]"
    value="<?php
        echo htmlspecialchars(
            implode(',', array_column($selected_genres, 'id')),
            ENT_QUOTES,
            'UTF-8'
        );
    ?>"
    multiple
>

<datalist id="genre_ids">

<?php
$sqlfr = mysqli_query($con, "
    SELECT id, name
    FROM genre
    ORDER BY name
");

while ($rowfr = mysqli_fetch_assoc($sqlfr)) {
?>

<option
    value="<?php echo (int)$rowfr['id']; ?>"
    data-name="<?php echo htmlspecialchars($rowfr['name'], ENT_QUOTES, 'UTF-8'); ?>"
>
    <?php echo htmlspecialchars($rowfr['name']); ?>
    (ID: <?php echo (int)$rowfr['id']; ?>)
</option>

<?php } ?>

</datalist>
                                 
                              
                                 </div>
                                  <div class="form-group">
                                 <label>Remake</label>
                                 <select class="form-control" name="remake" id="remake">
                                <option value="<? echo $read['remake'];?>" ><? echo $read['remake'];?></option>
                              <option value="no">No</option>
                              <option value="yes">Yes</option>
                                 </select>
                                
                              </div>
							    <div id="isremake" style="display:none;border: 1px solid black;padding: 14px;">
                                  <fieldset>
								   <label>Original Film</label>
								  <select class="form-control film" style="width:100%;" name="remake_original_film_name">
								  
								    <? 
								   if($read["remake_original_film_name"]==""){
									   ?>
								   <option value="">-Select Original Film-</option>
								   <? } else { ?>
								   <option value="<? echo $read["remake_original_film_name"];?>"><? echo $read["remake_original_film_name"];?></option>
								   <? } ?>
								  
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
                                 <label>Is Franchise?</label>
                                 <select class="form-control" name="franchise" id="franchise">
                                <?
                                if($read["franchise_name"]==""){
                                    ?>
                              <option value="no">No</option>
                              <option value="yes">Yes</option>
                              <?  } else { ?>
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                              <? } ?>
                                 </select>
                                
                              </div>
                               	    <div id="isfranchise" style="display:none;border: 1px solid black;padding: 14px;">
                                  <fieldset>
								   <label>Franchise Name</label>
								 <input list="franchise_list" name="franchise_name" class="form-control" id="franchise_name" value="<? echo $read["franchise_name"];?>">
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
                               <div class="form-group">
                                 <label>PAN India:</label>
                                 <select class="form-control" id="panindia" name="panindia" required>
                                     <?php if($read["panindia"]=="Yes"){ ?>
                                       <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>
                                   <?php }else { ?>
                                      <option value="No" selected>No</option>
                                      <option value="Yes">Yes</option>
                                      <?php } ?>
                                       
                                     
                                </select>
                              </div>
                                    <div id="ispan" style="display: block;border: 1px solid black;padding: 14px;">
                                        <div class="form-group  ">
                                <label>Select PAN Lanaguage(s)</label>
                                 
   <select class="main_language"  class="form-control" name="pan_language[]" multiple="multiple">
          <?php 
       $pan_lanaguage=explode(",",$read["pan_language"]);
       foreach($pan_lanaguage as $pan_lanaguage_read)
       {
           $language_name="select * from dubbing where id='$pan_lanaguage_read'";
           $sqlfr_lang=mysqli_query($con,$language_name);
           $read_name_lang=mysqli_fetch_array($sqlfr_lang);
       ?>
       <option value="<? echo $read_name_lang['id']; ?>" selected><? echo $read_name_lang['name']; ?></option>  
        <?php } ?>
                                  <? $sqlfr1=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr1=mysqli_fetch_array($sqlfr1)){ ?>

<option value="<? echo $rowfr1['id']; ?>"><? echo $rowfr1['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
                                    </div>
                                    
                                     <div class="form-group">
                                 <label>Real:</label>
                                 <select class="form-control" id="Real" name="Real" required>
                                     <?php if($read["real_name"]=="Yes"){ ?>
                                       <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>
                                   <?php }else { ?>
                                      <option value="No" selected>No</option>
                                      <option value="Yes">Yes</option>
                                      <?php } ?>
                                       
                                     
                                </select>
                              </div>
                              
                              
                              
                              

                                  
                               <div class="form-group">
                                 <label>Sequel:</label>
                                 <select class="form-control" id="Sequel" name="Sequel" required>
                                     <?php if($read["sequel"]=="Yes"){ ?>
                                       <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>
                                   <?php }else { ?>
                                      <option value="No" selected>No</option>
                                      <option value="Yes">Yes</option>
                                      <?php } ?>
                                       
                                   
                                </select>
                              </div>
                              
                 
                   <div id="isSequel" style="display: block;border: 1px solid black;padding: 14px;">
                          <label>Fill Following Franchise  Details of This Film:</label>
                                <br/>
                                <div class="field_wrapper3">
                                <a href="javascript:void(0);" class="add_button3 btn btn-success pull-right" title="add More">Add More</a>
                                     <br/>
                                     <?php
                                     $sequel_type=explode(",",$read["sequel_type"]);
                                     $installment=explode(",",$read["installment"]);
                                     $count_sequel_type=count($sequel_type);
                                     $count=0;
                                     for($i=1;$i<=$count_sequel_type;$i++){
                                     
                                     ?>
                                        <div class="form-group">
                                <label>Select Sequel Type</label>
                                 
   <select class="form-control" name="sequel_type[]" >
     
                                  <option value="<?php echo $sequel_type[$count];?>" selected><?php echo $sequel_type[$count];?></option>
                              
                                     <option value="Sequel">Sequel</option>
                                     <option value="Prequel">Prequel</option>
                                     <option value="Quasi Sequel">Quasi Sequel</option>
                                 </select>
                                 
                              </div> 
                               <div class="form-group">
                             
                                 <label>Film Title(s)</label>
                                 
 <select class="main_language"  class="form-control" name="sequel_film_name[]">
      <?php 
       $sequel_film_id=explode(",",$read["sequel_film_name"]);
           $sequel_film=$sequel_film_id[$count];
           $sequel_film_name="select * from film where id='$sequel_film'";
           $sqlfr_film_name=mysqli_query($con,$sequel_film_name);
           $read_film_name=mysqli_fetch_array($sqlfr_film_name);
       ?>
       <option value="<? echo $read_film_name['id']; ?>" selected><? echo $read_film_name['name']; ?></option>
       
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
                               <div class="form-group">
                                <label>Installment:</label>
                                <input type="text" name="Installment[]" value="<?php echo $installment[$count];?>" class="form-control"/>
                                </div>
                              </div>
                              <hr/>
                              <?php $count++;} ?>
                                    </div>
                                    
                                    <!--  <div class="form-group">
                                 <label>Multiple Roles:</label>
                                 <select class="form-control" id="Multiple_Roles" name="Multiple_Roles" required>
                                     <?php if($read["multiple_roles"]=="Yes"){ ?>
                                       <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>
                                   <?php }else { ?>
                                      <option value="No" selected>No</option>
                                      <option value="Yes">Yes</option>
                                      <?php } ?>
                                   
                                     
                                </select>
                              </div>-->
                               <div id="is_Multiple_Roles" style="display: block;border: 1px solid black;padding: 14px;">
                                     <div class="field_wrapper_multiple_role">
                                <a href="javascript:void(0);" class="add_button_multiple_role btn btn-success pull-right" title="add More">Add More</a>
                                  <?php
								  $query_multiple_roles="select * from multiple_roles_details where film_id='$id'";
								  $query_exe=mysqli_query($con,$query_multiple_roles);
								  while($read_multiple_role_data=mysqli_fetch_array($query_exe)){
									  
                                     $actor_id=$read_multiple_role_data["multiple_actor_id"];
                                     $multiple_character_name=$read_multiple_role_data["multiple_character_name"];
                                     $multiple_remarks=$read_multiple_role_data["multiple_remarks"];
                                     $multiple_roles_number=$read_multiple_role_data["multiple_roles_number"];
                                     $count_actor_name=count($actor_id);
                                     $count1=0;
                                    // $cast_id_id = array();
                                     //for($j=0;$j<$count_actor_name;$j++){
										$tmp = '';
                                  //   foreach($actor_name as $cast_read){
									 //$cast_read=$actor_name[$j];
										  $cast_data_query="select * from cast where id='$actor_id'";
										 $cast_data_exe=mysqli_query($con,$cast_data_query);
										 $cast_data_read=mysqli_fetch_array($cast_data_exe);
										 $cast_read_id=$cast_data_read["id"];
										 $tmp=$cast_read_id; 
										 
										 $tmp = trim($tmp, ','); 
                                           // remove trailing comma
                                    			 ?>
                              <div class="form-group">
                                <label>Actors Name:</label>
                               		<input type="hidden" name="act_id[]" value="<? echo $read_multiple_role_data["id"];?>"/>	
							<input type='text'
       placeholder='Enter Cast Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='other_cast',
       data-value-property='value',
	   name='multiple_actor_name[]',
	    value='<? echo $tmp?>',
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
                                <label>Character  Name:</label>
                                <input type="text" name="multiple_character_name[]" value="<? echo $multiple_character_name;?>" class="form-control"/>
                                </div>
                                <div class="form-group">
                                <label>Number of Roles:</label>
                                <input type="text" name="multiple_roles_number[]" value="<? echo $multiple_roles_number;?>" class="form-control"/>
                                </div>
                                <div class="form-group">
                                <label>Remarks:</label>
                                <input type="text" name="multiple_remarks[]" value="<? echo $multiple_remarks;?>" class="form-control"/>
                                </div>
                                <?php $count1++;} ?>
                                </div>
                                </div>
                                   <div class="form-group">
                                 <label>Budget(in Crore)</label>
                                 <input type="text" class="form-control" name="budget" placeholder="Enter Budget" value="<? echo $read["budget"] ?>" >
                              </div>
                                  <div class="form-group">
                                 <label>Releasing Platform:</label>
                                 <select class="form-control" id="releasing_platform" name="releasing_platform" required>
                                    
                                      <option value="<? echo $read["cbfc_releasing_platform"] ?>"><? echo $read["cbfc_releasing_platform"] ?></option>
                                       
                                      <? $sqlfr=mysqli_query($con, "select * from  platform order by platform_name");
                                  
                                 while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['platform_name']; ?>"><? echo $rowfr['platform_name']; ?></option>
                                  <? } ?>
                                      
                                     
                                     
                                </select>
                              </div>
							  <div class="form-group" id="ott_platform_name">
                                 <label>OTT Platform</label>
                                 <select class="form-control" name="ott_platform_name">
                                     <option value="<? echo $read["cbfc_releasing_platform_details"] ?>"><? echo $read["cbfc_releasing_platform_details"] ?></option>
                                       <? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                 <label> Date Release</label>
                                 <input type="text" class="form-control" name="date_release" placeholder="Enter  Date Release" value="<? echo $read["date_release"] ?>" >
                              </div>
                          <div class="form-group">
                                 <label> Month Release</label>
                                 <input type="text" class="form-control" name="month_release" placeholder="Enter  Month Release"value="<? echo $read["month_release"] ?>"   >
                              </div>
                          <div class="form-group">
                                 <label> Year Release</label>
                                 <input type="text" class="form-control" name="year_release" placeholder="Enter  Year Release"  value="<? echo $read["year_release"] ?>">
                              </div>
                              
                                 
                              <div class="form-group">
                                 <label>Latest Trailer/Teaser By YouTube Link:</label>
                                   <input type="text"  name="posterbyurl" value="<? echo $read["youtube"];?>" class="form-control">
                                  
                              </div>
                             
                              
                             <div class="form-group">
                                 <label>Is This Film Show on Frontent?</label>
                             
 <select name="showonfront" class="form-control">
     <option value="<? echo $read["show_on_front"] ?>"><? echo $read["show_on_front"] ?></option> 
<option value="No">No</option>      
<option value="Yes">Yes</option>


                                 
                                 </select> 
                              </div>
      <div class="form-group">
                                 <label>Is This Film Shelved/Unreleased?</label>
                             
 <select name="shelved_unreleased" class="form-control" > 
 <?php if($read["shelved_unreleased"]=="Yes"){ ?>
                                       <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>
                                   <?php }else { ?>
                                      <option value="No" selected>No</option>
                                      <option value="Yes">Yes</option>
                                      <?php } ?>


                                 
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
						
                               <br/>
                               <?php
                                     $platform_name=explode(",",$read["platform_name"]);
                                     $platform_date=explode(",",$read["platform_date"]);
                                      $platform_month=explode(",",$read["platform_month"]);
                                       $platform_year=explode(",",$read["platform_year"]);
                                       $platform_country=explode(",",$read["platform_country"]);
                                       $platform_sub_type=explode(",",$read["platform_sub_type"]);
                                       $platform_is_rerelease=explode(",",$read["platform_is_rerelease"]);
                                       $platform_language_ids=explode(",",$read["platform_language_id"]);
                                       
                                       
                                      
                                     $count_platform_name=count($platform_name);
                                     $count=0;
                                     for($i=0;$i<$count_platform_name;$i++){
                                     
                                     ?>
                          <?php
            // Get platform data for the current platform id
            $platform_language_id = $platform_language_ids[$i];
            $platform_language_stmt = $con->prepare("SELECT id, name FROM dubbing WHERE id = ?");
            $platform_language_stmt->bind_param('i', $platform_language_id);
            $platform_language_stmt->execute();
            $platform_language_result = $platform_language_stmt->get_result();
            $platform_language_data = $platform_language_result->fetch_assoc();
            ?>


            <div class="form-group">
                <label for="platform_name_<?php echo $i; ?>">Platform Langauage:  </label>
                <select class="form-control search_in_dropdown" name="platform_language_id[]" id="platform_language_id_<?php echo $i; ?>" style="width: 100%;" aria-label="Platform Language">
                    <?php if ($platform_language_data): ?>
                        <option value="<?php echo htmlspecialchars($platform_language_data['id']); ?>" selected>
                            <?php echo htmlspecialchars($platform_language_data['name']); ?>
                        </option>
                    <?php else: ?>
                        <option value="" disabled selected>Select Language</option>
                    <?php endif; ?>
                    <?php
                    $platform_language_all_query = "SELECT id, name FROM dubbing ORDER BY id DESC";
                    $platform_language_all_result = $con->query($platform_language_all_query);
                    if ($platform_language_all_result && $platform_language_all_result->num_rows > 0) {
                        while ($row_pf_language = $platform_language_all_result->fetch_assoc()) {
                            if (!$platform_language_data || $row_pf_language['id'] != $platform_language_data['id']) {
                                echo '<option value="' . htmlspecialchars($row_pf_language['id']) . '">' . htmlspecialchars($row_pf_language['name']) . '</option>';
                            }
                        }
                    }
                    ?>
                </select>
            </div>

         

                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 <div class="form-group">
                <label for="country_<?php echo $i; ?>">Release Country</label>
                <select class="form-control main_language" id="country_<?php echo $i; ?>" name="platform_country[]" aria-label="Release Country">
                    <option value="<?php echo htmlspecialchars($platform_country[$i]); ?>" selected>
                        <?php echo htmlspecialchars($platform_country[$i]); ?>
                    </option>
                    <?php
                    $country_query = "SELECT country_name FROM country1 ORDER BY country_name";
                    $country_result = $con->query($country_query);
                    if ($country_result && $country_result->num_rows > 0) {
                        while ($country_row = $country_result->fetch_assoc()) {
                            $country_name_val = $country_row['country_name'];
                            // Don't repeat the preselected option
                            if ($country_name_val !== $platform_country[$i]) {
                                echo '<option value="' . htmlspecialchars($country_name_val) . '">' . htmlspecialchars($country_name_val) . '</option>';
                            }
                        }
                    }
                    ?>
                </select>
            </div>

            <?php
            // Get platform data for the current platform id
            $platform_id = $platform_name[$i];
            $platform_stmt = $con->prepare("SELECT id, platform_name FROM platform WHERE id = ?");
            $platform_stmt->bind_param('i', $platform_id);
            $platform_stmt->execute();
            $platform_result = $platform_stmt->get_result();
            $platform_data = $platform_result->fetch_assoc();
            ?>

            <div class="form-group">
                <label for="platform_name_<?php echo $i; ?>">Platform Name:</label>
                <select class="form-control search_in_dropdown" name="platform_name[]" id="platform_name_<?php echo $i; ?>" style="width: 100%;" aria-label="Platform Name">
                    <?php if ($platform_data): ?>
                        <option value="<?php echo htmlspecialchars($platform_data['id']); ?>" selected>
                            <?php echo htmlspecialchars($platform_data['platform_name']); ?>
                        </option>
                    <?php else: ?>
                        <option value="" disabled selected>Select platform</option>
                    <?php endif; ?>
                    <?php
                    $platform_all_query = "SELECT id, platform_name FROM platform ORDER BY id DESC";
                    $platform_all_result = $con->query($platform_all_query);
                    if ($platform_all_result && $platform_all_result->num_rows > 0) {
                        while ($row_pf = $platform_all_result->fetch_assoc()) {
                            if (!$platform_data || $row_pf['id'] != $platform_data['id']) {
                                echo '<option value="' . htmlspecialchars($row_pf['id']) . '">' . htmlspecialchars($row_pf['platform_name']) . '</option>';
                            }
                        }
                    }
                    ?>
                </select>
            </div>
<?php
$sub_type_value = isset($platform_sub_type[$i])
    ? trim($platform_sub_type[$i])
    : '';
?>

<div id="platform_details_film_festival_<?php echo $i; ?>" style="display:none;">

    <fieldset>

        <label for="festival_name_<?php echo $i; ?>">
            Select Film Festival Name
        </label>

        <select
            class="form-control search_in_dropdown main_language"
            id="festival_name_<?php echo $i; ?>"
            name="platform_sub_type[]"
            style="width:100%;"
            aria-label="Film Festival Name"
        >

            <option value="">- Select Film Festival -</option>

            <?php

            /* =========================================
               FIRST: SHOW SAVED VALUE
            ========================================= */

            if ($sub_type_value !== '') {

                $saved_value = mysqli_real_escape_string(
                    $con,
                    $sub_type_value
                );

                $saved_query = "
                    SELECT name
                    FROM film_festival
                    WHERE name = '$saved_value'
                    LIMIT 1
                ";

                $saved_result = mysqli_query($con, $saved_query);

                if ($saved_result && mysqli_num_rows($saved_result) > 0) {

                    $saved_row = mysqli_fetch_assoc($saved_result);

                    $saved_festival = $saved_row['name'];
                    ?>

                    <option
                        value="<?php echo htmlspecialchars(
                            $saved_festival,
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>"
                        selected="selected"
                    >
                        <?php echo htmlspecialchars(
                            $saved_festival,
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>
                    </option>

                    <?php
                }
            }


            /* =========================================
               THEN: SHOW ALL OTHER FESTIVALS
            ========================================= */

            $film_festival_query = "
                SELECT name
                FROM film_festival
                ORDER BY name ASC
            ";

            $film_festival_result = mysqli_query(
                $con,
                $film_festival_query
            );

            if ($film_festival_result) {

                while ($row_fest = mysqli_fetch_assoc($film_festival_result)) {

                    $festival_name = trim($row_fest['name']);

                    /*
                     * Don't show the saved festival twice
                     */
                    if (
                        $sub_type_value !== '' &&
                        $festival_name === $sub_type_value
                    ) {
                        continue;
                    }
                    ?>

                    <option
                        value="<?php echo htmlspecialchars(
                            $festival_name,
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>"
                    >
                        <?php echo htmlspecialchars(
                            $festival_name,
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>
                    </option>

                    <?php
                }
            }

            ?>

        </select>

    </fieldset>

</div>

            <div id="platform_details_tv_serial_<?php echo $i; ?>" style="display:none;">
                <fieldset>
                    <label for="tv_serial_name_<?php echo $i; ?>">Select TV Serial Channel</label>
                    <select class="form-control search_in_dropdown main_language" id="tv_serial_name_<?php echo $i; ?>" name="platform_sub_type[]" style="width: 100%;" aria-label="TV Serial Channel Name">
                        <option value="<?php echo htmlspecialchars($sub_type_value); ?>" selected><?php echo htmlspecialchars($sub_type_value); ?></option>
                        <?php
                        $tv_channels_query = "SELECT name FROM tv_channels ORDER BY name ASC";
                        $tv_channels_result = $con->query($tv_channels_query);
                        if ($tv_channels_result && $tv_channels_result->num_rows > 0) {
                            while ($row_tv = $tv_channels_result->fetch_assoc()) {
                                if ($row_tv['name'] !== $sub_type_value) {
                                    echo '<option value="' . htmlspecialchars($row_tv['name']) . '">' . htmlspecialchars($row_tv['name']) . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </fieldset>
            </div>

            <div id="youtube_channel_name_<?php echo $i; ?>" style="display:none;">
                <fieldset>
                    <label for="youtube_channel_<?php echo $i; ?>">Select YouTube Channel</label>
                    <select class="form-control search_in_dropdown main_language" id="youtube_channel_<?php echo $i; ?>" name="platform_sub_type[]" style="width: 100%;" aria-label="YouTube Channel">
                        <option value="<?php echo htmlspecialchars($sub_type_value); ?>" selected><?php echo htmlspecialchars($sub_type_value); ?></option>
                        <?php
                        $youtube_query = "SELECT music_label FROM music_label ORDER BY music_label ASC";
                        $youtube_result = $con->query($youtube_query);
                        if ($youtube_result && $youtube_result->num_rows > 0) {
                            while ($row_yt = $youtube_result->fetch_assoc()) {
                                if ($row_yt['music_label'] !== $sub_type_value) {
                                    echo '<option value="' . htmlspecialchars($row_yt['music_label']) . '">' . htmlspecialchars($row_yt['music_label']) . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </fieldset>
            </div>

            <div id="ott_details_name_<?php echo $i; ?>" style="display:none;">
                <fieldset>
                    <label for="ott_name_<?php echo $i; ?>">Select OTT Platform Name</label>
                    <select class="form-control search_in_dropdown main_language" id="ott_name_<?php echo $i; ?>" name="platform_sub_type[]" style="width: 100%;" aria-label="OTT Platform Name">
                        <option value="<?php echo htmlspecialchars($sub_type_value); ?>" selected><?php echo htmlspecialchars($sub_type_value); ?></option>
                        <?php
                        $ott_query = "SELECT name FROM ott_platform ORDER BY name ASC";
                        $ott_result = $con->query($ott_query);
                        if ($ott_result && $ott_result->num_rows > 0) {
                            while ($row_ott = $ott_result->fetch_assoc()) {
                                if ($row_ott['name'] !== $sub_type_value) {
                                    echo '<option value="' . htmlspecialchars($row_ott['name']) . '">' . htmlspecialchars($row_ott['name']) . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </fieldset>
            </div>

            <div class="form-group">
                <label for="platform_date_<?php echo $i; ?>">Release Date:</label>
                <input type="text" class="form-control" value="<?php echo isset($platform_date[$count]) ? htmlspecialchars($platform_date[$count]) : ''; ?>" id="platform_date_<?php echo $i; ?>" name="platform_date[]" aria-label="Release Date">
            </div>

            <div class="form-group">
                <label for="platform_month_<?php echo $i; ?>">Release Month:</label>
                <input type="text" class="form-control" id="platform_month_<?php echo $i; ?>" value="<?php echo isset($platform_month[$count]) ? htmlspecialchars($platform_month[$count]) : ''; ?>" name="platform_month[]" aria-label="Release Month">
            </div>

            <div class="form-group">
                <label for="platform_year_<?php echo $i; ?>">Release Year:</label>
                <input type="text" class="form-control" id="platform_year_<?php echo $i; ?>" value="<?php echo isset($platform_year[$count]) ? htmlspecialchars($platform_year[$count]) : ''; ?>" name="platform_year[]" aria-label="Release Year">
            </div>
 <?php
            // Get platform data for the current platform id
            $platform_is_rerelease_data = $platform_is_rerelease[$i];
          
            ?>

            <div class="form-group">
                <label for="platform_is_rerelease_<?php echo $i; ?>">Is Re-Release: </label>
                <select class="form-control search_in_dropdown" name="platform_is_rerelease[]" id="platform_is_rerelease_<?php echo $i; ?>" style="width: 100%;" aria-label="Is Rerelease">
                    
                        <option value="No" <?php if($platform_is_rerelease_data=="No"){ ?>selected<?php } ?>>No</option>
                        <option value="Yes" <?php if($platform_is_rerelease_data=="Yes"){ ?> selected<?php } ?>>Yes</option>
                 
                </select>
            </div>

 

            <hr>
            <?php $count++; ?>
        <?php } ?>   <div class="field_wrapper2"></div>
    <a href="javascript:void(0);" class="add_button2 btn btn-success pull-right" title="Add More">Add More</a><br/>
  </div> 
  </div>
      </div>
              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="basic_details"  class="btn btn-success"  value="Edit Basic Record">
                            
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
    $(function() {
        // Function to show/hide detail sections based on the selected platform name
        function toggleDetailSections(index) {
            var selectedValue = $('#platform_name_' + index).val();

            // Hide all detail sections first
            $('#platform_details_film_festival_' + index).hide();
            $('#platform_details_tv_serial_' + index).hide();
            $('#youtube_channel_name_' + index).hide();
            $('#ott_details_name_' + index).hide();

            // Show the relevant section based on the selected value
            if (selectedValue == '7') {
                $('#platform_details_film_festival_' + index).show();
            } else if (selectedValue == '6') {
                $('#platform_details_tv_serial_' + index).show();
            } else if (selectedValue == '5') {
                $('#youtube_channel_name_' + index).show();
            } else if (selectedValue == '4') {
                $('#ott_details_name_' + index).show();
            }
        }

        // Attach change event to all platform name dropdowns
        $("select[id^='platform_name_']").change(function() {
            var index = $(this).attr('id').split('_')[2]; // Get the index from the ID
            toggleDetailSections(index);
        });

        // Check the initial values of all platform name dropdowns on page load
        $("select[id^='platform_name_']").each(function() {
            var index = $(this).attr('id').split('_')[2]; // Get the index from the ID
            toggleDetailSections(index); // Call the function to show/hide sections based on the current value
        });
    });
    </script>
    
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
    $('.film').select2();
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
                                '<input type="text" name="multiple_roles_number[]" class="form-control"/>'+
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
 <script>
$(document).ready(function(){

    var maxField3 = 10; //Input fields increment limitation
    var addButton3 = $('.add_button3'); //add button selector
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
                                  <? $sqlfr=mysqli_query($con, "select * from film order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){  $FilmName=$rowfr['name'];
                                     $main_lang=explode(",",$rowfr['main_lang']);
$main_language="";
foreach ($main_lang as $x) {
  $sqlld=mysqli_query($con, "select * from dubbing where id='$x'");
  $rowld=mysqli_fetch_array($sqlld);
  $main_language=$main_language.", ".$rowld['name'];

}
 
$main_language=   substr($main_language, 2);
                                  
                                  
                                  ?>

'<option value="<? echo $rowfr['id']; ?>"><?  $FilmName1= str_replace("'", "", $FilmName);echo $FilmName1; ?>-<?php echo $rowfr['year_release']; ?>-<?php echo $main_language; ?></option>'+
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
            $(wrapper3).append(fieldHTML3); //add field html
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
        if($('#releasing_platform').val() == 'OTT') {
            $('#ott_platform_name').show(); 
        } else {
            $('#ott_platform_name').hide(); 
        } 
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

<script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>
<script>
$('.flexdatalist').flexdatalist({
     minLength: 1,
	 selectionRequired: true
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
  $(document).ready(function() {
    $('.main_language').select2();
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
  <script>
$(function() {
   
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
 </script>
 <script>
     $('form').on('submit', function() {
  // For each platform detail container
  ['film_festival', 'tv_serial', 'youtube_channel_name', 'ott_details_name'].forEach(function(type) {
    $("div[id^='platform_details_" + type + "_'], div[id^='" + type + "_']").each(function() {
      if ($(this).css('display') === 'none') {
        // Disable selects inside hidden div so their values don't get submitted
        $(this).find('select[name="platform_sub_type[]"]').prop('disabled', true);
      } else {
        // Ensure visible selects are enabled
        $(this).find('select[name="platform_sub_type[]"]').prop('disabled', false);
      }
    });
  });
});
 </script>
   </body>
  
</html>

