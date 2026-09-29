<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
    $id=$_GET["id"];
      $record="select * from film_directors_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
  
	 ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["update_directos"])) {

    /* ✅ helpers */
    function postArray($key) {
        return isset($_POST[$key]) && is_array($_POST[$key])
            ? implode(",", array_filter($_POST[$key]))
            : '';
    }

    /* ✅ validate ids */
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    $film_id = isset($_POST['film_id']) ? (int) $_POST['film_id'] : 0;

    if ($id <= 0 || $film_id <= 0) {
        die("Invalid ID");
    }

    /* ✅ collect data safely */
    $film_director = postArray('film_director');
    $direction_team = postArray('direction_team');
    $second_unit_director = postArray('second_unit_director');
    $chief_associate_director = postArray('chief_associate_director');
    $chief_assistant_director = postArray('chief_assistant_director');
    $third_assistant_director = postArray('third_assistant_director');
    $technical_director = postArray('technical_director');
    $film_codirector = postArray('film_codirector');
    $film_assistant_director = postArray('film_assistant_director');
    $film_associate_director = postArray('film_associate_director');
    $film_first_assistant_director = postArray('film_first_assistant_director');
    $film_second_assistant_director = postArray('film_second_assistant_director');
    $film_creativedirector = postArray('film_creativedirector');
    $second_second_assistant_director = postArray('second_second_assistant_director');
    $tainee_assistant_director = postArray('tainee_assistant_director');
    $director_assistant = postArray('director_assistant');
    $first_assistant_director_second_unit = postArray('first_assistant_director_second_unit');
    $second_assistant_director_second_unit = postArray('second_assistant_director_second_unit');
    $dialogue_director = postArray('dialogue_director');
    $additional_assistant_director = postArray('additional_assistant_director');

    /* ✅ prepared update */
    $stmt = $con->prepare("
        UPDATE film_directors_allot SET
            film_id=?,
            direction_team=?,
            second_unit_director=?,
            chief_associate_director=?,
            chief_assistant_director=?,
            third_assistant_director=?,
            technical_director=?,
            creative_director=?,
            director=?,
            co_director=?,
            assistant_director=?,
            associate_director=?,
            first_assistant_director=?,
            second_assistant_director=?,
            second_second_assistant_director=?,
            tainee_assistant_director=?,
            director_assistant=?,
            first_assistant_director_second_unit=?,
            second_assistant_director_second_unit=?,
            dialogue_director=?,
            additional_assistant_director=?
        WHERE id=?
    ");

    $stmt->bind_param(
        "issssssssssssssssssssi",
        $film_id,
        $direction_team,
        $second_unit_director,
        $chief_associate_director,
        $chief_assistant_director,
        $third_assistant_director,
        $technical_director,
        $film_creativedirector,
        $film_director,
        $film_codirector,
        $film_assistant_director,
        $film_associate_director,
        $film_first_assistant_director,
        $film_second_assistant_director,
        $second_second_assistant_director,
        $tainee_assistant_director,
        $director_assistant,
        $first_assistant_director_second_unit,
        $second_assistant_director_second_unit,
        $dialogue_director,
        $additional_assistant_director,
        $id
    );

    if (!$stmt->execute()) {
        die("Update failed: " . $stmt->error);
    }

    echo "<script>alert('Film Directors Updated Succesfully')</script>";
  echo "<script>window.location.href='film_directors_management.php'</script>";
    exit;
}
?>
   
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Directors</title>
      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <!-- Start Global Mandatory Style
         =====================================================================-->
     
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
  <!-- select2 -->
  
  <style>
   .flexdatalist-alias
    {
       width:100%;
       height: 35px;
    }
  </style>
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
                  <h1>Film Directors Management</h1>
                  <small>Edit Film Directors</small>
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
                                 <h4>Edit Film Directors Here</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                             <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
			  
			  
                  
                             
								 
								 
							<div class="form-group">
    <label>Select Film:</label>

    <select class="form-control searchwithselect2" 
            id="film_id" 
            name="film_id" 
            style="width:100%;" 
            required>

        <option value="">-Select Film-</option>

        <?php
        $selected_film_id = (int) ($read["film_id"] ?? 0);

        $sql = mysqli_query($con, "
            SELECT 
                f.id,
                f.name,
                f.year_release,
                GROUP_CONCAT(d.name SEPARATOR ', ') AS languages
            FROM film f
            LEFT JOIN dubbing d 
                ON FIND_IN_SET(d.id, f.main_lang)
            GROUP BY f.id
            ORDER BY f.id DESC
        ");

        while($row = mysqli_fetch_assoc($sql)) {

            $selected = ($row['id'] == $selected_film_id) ? 'selected' : '';
        ?>

        <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>>
            <?php echo $row['name']; ?> 
            (Year: <?php echo $row['year_release']; ?> 
            Language: <?php echo $row['languages'] ?? ''; ?>)
        </option>

        <?php } ?>

    </select>
</div>
							<div class="form-group">
    <label>Film Director</label>

    <?php
     $film_director_id=explode(",",$read["director"]);
														$tmp = '';
                                       
                                   
                                     foreach($film_director_id as $director_id_read){
										 $director_data_query="select * from director where id='$director_id_read'";
										 $director_data_exe=mysqli_query($con,$director_data_query);
										 $director_name_read=mysqli_fetch_array($director_data_exe);
										 $director_read_id=$director_name_read["id"];
										 $tmp .=$director_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
 

    <input type="text"
           placeholder="Enter Film Director"
           class="flexdatalist"
           data-min-length="1"
           style="width:100%;"
           list="film_director_name"
           data-value-property="value"
           name="film_director[]"
           value="<?php echo $tmp; ?>"
           multiple="multiple">

    <datalist id="film_director_name">
        <?php
        $sql = mysqli_query($con, "
            SELECT id, name, nickname 
            FROM director 
            ORDER BY id DESC
           
        ");

        while($row = mysqli_fetch_assoc($sql)) {
        ?>
            <option value="<?php echo $row['id']; ?>">
                <?php echo $row['name']; ?>
                (Nick: <?php echo $row['nickname']; ?> ID: <?php echo $row['id']; ?>)
            </option>
        <?php } ?>
    </datalist>

</div>
                               
                                <div class="form-group">
                                 <label>Film Direction Team</label>
                                   <?  $direction_team_id=explode(",",$read["direction_team"]);
														$tmp = '';
                                    
                                   foreach($direction_team_id as $direction_team_id_read){
										 $director_data_query="select * from director where id='$direction_team_id_read'";
										 $director_data_exe=mysqli_query($con,$director_data_query);
										 $director_name_read=mysqli_fetch_array($director_data_exe);
										 $director_read_id=$director_name_read["id"];
										 $tmp .=$director_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Film Direction Team'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='direction_team',
       data-value-property='value',
	   name='direction_team[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="direction_team">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                                 
                           
                              </div>
                             
							    <div class="form-group">
                                 <label>Film Co-Director</label>
                                  <?  $film_codirector_name=explode(",",$read["co_director"]);
														$tmp = '';
                                    
                                  foreach($film_codirector_name as $codirector_name){
										  $film_codirector_data_query="select * from director where id='$codirector_name'";
										 $film_codirector_data_exe=mysqli_query($con,$film_codirector_data_query);
										 $film_codirector_read=mysqli_fetch_array($film_codirector_data_exe);
										 $film_codirector_read_id=$film_codirector_read["id"];
										 $tmp .=$film_codirector_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Film Co-Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_codirector',
       data-value-property='value',
	   name='film_codirector[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_codirector">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                              
                                   </div>
								   
								    <div class="form-group">  
                                 <label>Film Associate Director</label>  
                                 					<?php
                                 					$tmp = '';
                                    
                                  $film_associate_director_name=explode(",",$read["associate_director"]);
                                     foreach($film_associate_director_name as $associate_director_name){
										  $film_associate_director_name_data_query="select * from director where id='$associate_director_name'";
										 $film_associate_director_name_data_exe=mysqli_query($con,$film_associate_director_name_data_query);
										 $film_associate_director_name_read=mysqli_fetch_array($film_associate_director_name_data_exe);
										 $film_associate_director_name_read_id=$film_associate_director_name_read["id"];
										 $tmp .=$film_associate_director_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Film Associate Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_associate_director',
       data-value-property='value',
	   name='film_associate_director[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_associate_director">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                                 
                                 
                                   
                                 </div>
							   <div class="form-group">  
                                 <label>Film Assistant Director</label>
                                 	<?php
                                 					$tmp = '';
                                    
                                   $film_assistant_director_name=explode(",",$read["assistant_director"]);
                                     foreach($film_assistant_director_name as $assistant_director_name){
										  $film_assistant_director_name_data_query="select * from director where id='$assistant_director_name'";
										 $film_assistant_director_name_data_exe=mysqli_query($con,$film_assistant_director_name_data_query);
										 $film_assistant_director_name_read=mysqli_fetch_array($film_assistant_director_name_data_exe);
										 $film_assistant_director_name_read_id=$film_assistant_director_name_read["id"];
										 $tmp .=$film_assistant_director_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Film Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_assistant_director',
       data-value-property='value',
	   name='film_assistant_director[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_assistant_director">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                              
                                  </div>
                                  <div class="form-group">
                                 <label>Additional Assistant Director</label>
                                 	<?php
                                 					$tmp = '';
                                    
                                              $additional_assistant_director=explode(",",$read["additional_assistant_director"]);
                                     foreach($additional_assistant_director as $additional_assistant_director){
										  $additional_assistant_director_data_query="select * from director where id='$additional_assistant_director'";
										 $additional_assistant_director_data_exe=mysqli_query($con,$additional_assistant_director_data_query);
										 $additional_assistant_director_read=mysqli_fetch_array($additional_assistant_director_data_exe);
										 $additional_assistant_director_read_id=$additional_assistant_director_read["id"];
										 $tmp .=$additional_assistant_director_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Film Additional Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='additional_assistant_director',
       data-value-property='value',
	   name='additional_assistant_director[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="additional_assistant_director">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                               
                                   </div>

                                   <div class="form-group">
                                 <label>Film Creative Director</label>
                                 	<?php
                                 					$tmp = '';
                                    
                                           $film_creative_director_name=explode(",",$read["creative_director"]);
                                     foreach($film_creative_director_name as $creativedirector_name){
										  $film_creative_data_query="select * from director where id='$creativedirector_name'";
										 $film_creative_data_exe=mysqli_query($con,$film_creative_data_query);
										 $film_creative_read=mysqli_fetch_array($film_creative_data_exe);
										 $film_creative_read_id=$film_creative_read["id"];
										 $tmp .=$film_creative_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Film Creative Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_creativedirector',
       data-value-property='value',
	   name='film_creativedirector[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_creativedirector">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                              
                                   </div>
                                   <div class="form-group">
                                 <label>Technical Director</label>
                                 	<?php
                                 					$tmp = '';
                                    
                                          $technical_director=explode(",",$read["technical_director"]);
                                     foreach($technical_director as $technical_director1){
										  $technical_director_data_query="select * from director where id='$technical_director1'";
										 $technical_director_data_exe=mysqli_query($con,$technical_director_data_query);
										 $technical_director_name_read=mysqli_fetch_array($technical_director_data_exe);
										 $technical_director_name_read_id=$technical_director_name_read["id"];
										 $tmp .=$technical_director_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Film Technical Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='technical_director',
       data-value-property='value',
	   name='technical_director[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="technical_director">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                               
                              </div>
							   <div class="form-group">
                                 <label>Chief Associate Director</label>
                                 	<?php
                                 					$tmp = '';
                                    
                                          $chief_associate_director=explode(",",$read["chief_associate_director"]);
                                     foreach($chief_associate_director as $chief_associate_director1){
										 $chief_associate_director1_data_query="select * from director where id='$chief_associate_director1'";
										 $chief_associate_director1_data_exe=mysqli_query($con,$chief_associate_director1_data_query);
										 $chief_associate_director1_name_read=mysqli_fetch_array($chief_associate_director1_data_exe);
										 $chief_associate_director1_name_read_id=$chief_associate_director1_name_read["id"];
										 $tmp .=$chief_associate_director1_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Film Chief Associate Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='chief_associate_director',
       data-value-property='value',
	   name='chief_associate_director[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="chief_associate_director">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                              
                              </div>
                               <div class="form-group">
                                 <label>Chief Assistant Director</label>
                                 <?php
                                 					$tmp = '';
                                    
                                         $chief_assistant_director=explode(",",$read["chief_assistant_director"]);
                                     foreach($chief_assistant_director as $chief_assistant_director1){
										  $chief_assistant_director_data_query="select * from director where id='$chief_assistant_director1'";
										 $chief_assistant_director_data_exe=mysqli_query($con,$chief_assistant_director_data_query);
										 $chief_assistant_director_name_read=mysqli_fetch_array($chief_assistant_director_data_exe);
										 $chief_assistant_director_name_read_id=$chief_assistant_director_name_read["id"];
										 $tmp .=$chief_assistant_director_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Film Chief Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='chief_assistant_director',
       data-value-property='value',
	   name='chief_assistant_director[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="chief_assistant_director">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                               
                              </div>
                               
                                    
                                  <div class="form-group">  
                                 <label>Film First Assistant Director</label> 
                                  <?php
                                 					$tmp = '';
                                    
                                        $film_first_assistant_director_name=explode(",",$read["first_assistant_director"]);
                                     foreach($film_first_assistant_director_name as $first_assistant_director_name){
										   $film_first_assistant_director_name_data_query="select * from director where id='$first_assistant_director_name'";
										 $film_first_assistant_director_name_data_exe=mysqli_query($con,$film_first_assistant_director_name_data_query);
										 $film_first_assistant_director_name_read=mysqli_fetch_array($film_first_assistant_director_name_data_exe);
										 $film_first_assistant_director_name_read_id=$film_first_assistant_director_name_read["id"];
										 $tmp .=$film_first_assistant_director_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Film First Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_first_assistant_director',
       data-value-property='value',
	   name='film_first_assistant_director[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_first_assistant_director">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                               
                                 </div>
                                  <div class="form-group">  
                                 <label>Film Second Assistant Director</label>
                                   <?php
                                 					$tmp = '';
                                    
                                       $film_second_assistant_director_name=explode(",",$read["second_assistant_director"]);
                                     foreach($film_second_assistant_director_name as $second_assistant_director_name){
										  $film_second_assistant_director_name_data_query="select * from director where id='$second_assistant_director_name'";
										 $film_second_assistant_director_name_data_exe=mysqli_query($con,$film_second_assistant_director_name_data_query);
										 $film_second_assistant_director_name_read=mysqli_fetch_array($film_second_assistant_director_name_data_exe);
										 $film_second_assistant_director_name_read_id=$film_second_assistant_director_name_read["id"];
										 $tmp .=$film_second_assistant_director_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Film Second Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_second_assistant_director',
       data-value-property='value',
	   name='film_second_assistant_director[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_second_assistant_director">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                                 </div>
                                 <div class="form-group">
                                 <label>Second Second Assistant Director</label>
                                 <?php
                                 					$tmp = '';
                                    
                                       $second_second_assistant_director=explode(",",$read["second_second_assistant_director"]);
                                     foreach($second_second_assistant_director as $second_second_assistant_director1){
										  $second_second_assistant_director_data_query="select * from director where id='$second_second_assistant_director1'";
										 $second_second_assistant_director_data_exe=mysqli_query($con,$second_second_assistant_director_data_query);
										 $second_second_assistant_director_name_read=mysqli_fetch_array($second_second_assistant_director_data_exe);
										 $second_second_assistant_director_name_read_id=$second_second_assistant_director_name_read["id"];
										 $tmp .=$second_second_assistant_director_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Film Second Second Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='second_second_assistant_director',
       data-value-property='value',
	   name='second_second_assistant_director[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="second_second_assistant_director">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                                 
                              </div>
                              <div class="form-group">
                                 <label>Trainee Associate Director</label>
                                   <?php
                                 					$tmp = '';
                                    
                                       $tainee_assistant_director=explode(",",$read["tainee_assistant_director"]);
                                     foreach($tainee_assistant_director as $tainee_assistant_director1){
										 $tainee_assistant_director1_data_query="select * from director where id='$tainee_assistant_director1'";
										 $tainee_assistant_director1_data_exe=mysqli_query($con,$tainee_assistant_director1_data_query);
										 $tainee_assistant_director1_name_read=mysqli_fetch_array($tainee_assistant_director1_data_exe);
										 $tainee_assistant_director1_name_read_id=$tainee_assistant_director1_name_read["id"];
										 $tmp .=$tainee_assistant_director1_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Trainee Associate Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='tainee_assistant_director',
       data-value-property='value',
	   name='tainee_assistant_director[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="tainee_assistant_director">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                               
                              </div>
                              <div class="form-group">
                                 <label>Director Associate</label>
                                  <?php
                                 					$tmp = '';
                                     $director_assistant=explode(",",$read["director_assistant"]);
                                     foreach($director_assistant as $director_assistant1){
										 $director_assistant1_data_query="select * from director where id='$director_assistant1'";
										 $director_assistant1_data_exe=mysqli_query($con,$director_assistant1_data_query);
										 $director_assistant1_name_read=mysqli_fetch_array($director_assistant1_data_exe);
										 $director_assistant1_name_read_id=$director_assistant1_name_read["id"];
										 $tmp .=$director_assistant1_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Director Associate'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='director_assistant',
       data-value-property='value',
	   name='director_assistant[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="director_assistant">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                            
                              </div>
                              <div class="form-group">  
                                 <label>Film Third Assistant Director</label>
                                  <?php
                                 					$tmp = '';
                                     $third_assistant_director=explode(",",$read["third_assistant_director"]);
                                     foreach($third_assistant_director as $third_assistant_director1){
										  $film_third_assistant_director_name_data_query="select * from director where id='$third_assistant_director1'";
										 $film_third_assistant_director_name_data_exe=mysqli_query($con,$film_third_assistant_director_name_data_query);
										 $film_third_assistant_director_name_read=mysqli_fetch_array($film_third_assistant_director_name_data_exe);
										 $film_third_assistant_director_name_read_id=$film_third_assistant_director_name_read["id"];
										 $tmp .=$film_third_assistant_director_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Third Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='third_assistant_director',
       data-value-property='value',
	   name='third_assistant_director[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="third_assistant_director">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                               
                                 </div>
							   <div class="form-group">
                                 <label>Second Unit Director</label>
                                  <?php
                                 					$tmp = '';
                                     $second_unit_director=explode(",",$read["second_unit_director"]);
                                     foreach($second_unit_director as $second_unit_director1){
										  $director1_data_query="select * from director where id='$second_unit_director1'";
										 $director1_data_exe=mysqli_query($con,$director1_data_query);
										 $director1_name_read=mysqli_fetch_array($director1_data_exe);
										 $director1_name_read_id=$director1_name_read["id"];
										 $tmp .=$director1_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Third Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='second_unit_director',
       data-value-property='value',
	   name='second_unit_director[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="second_unit_director">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                               
                              </div>
                                   <div class="form-group">  
                                 <label>First Assistant Director-Second Unit</label> 
                                  <?php
                                 					$tmp = '';
                                     $first_assistant_director_second_unit=explode(",",$read["first_assistant_director_second_unit"]);
                                     foreach($first_assistant_director_second_unit as $first_assistant_director_second_unit){
										  $first_assistant_director_second_unit_data_query="select * from director where id='$first_assistant_director_second_unit'";
										 $first_assistant_director_second_unit_data_exe=mysqli_query($con,$first_assistant_director_second_unit_data_query);
										 $first_assistant_director_second_unit_read=mysqli_fetch_array($first_assistant_director_second_unit_data_exe);
										 $first_assistant_director_second_unit_read_id=$first_assistant_director_second_unit_read["id"];
										 $tmp .=$first_assistant_director_second_unit_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter First Assistant Director-Second Unit'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='first_assistant_director_second_unit',
       data-value-property='value',
	   name='first_assistant_director_second_unit[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="first_assistant_director_second_unit">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                                  
                                 </div>
                           
                           <div class="form-group">  
                                 <label>Second Assistant Director-Second Unit</label>   
                                  <?php
                                 					$tmp = '';
                                      $second_assistant_director_second_unit=explode(",",$read["second_assistant_director_second_unit"]);
                                     foreach($second_assistant_director_second_unit as $second_assistant_director_second_unit){
										  $second_assistant_director_second_unit_data_query="select * from director where id='$second_assistant_director_second_unit'";
										 $second_assistant_director_second_unit_data_exe=mysqli_query($con,$second_assistant_director_second_unit_data_query);
										 $second_assistant_director_second_unit_read=mysqli_fetch_array($second_assistant_director_second_unit_data_exe);
										 $second_assistant_director_second_unit_read_id=$second_assistant_director_second_unit_read["id"];
										 $tmp .=$second_assistant_director_second_unit_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Second Assistant Director-Second Unit'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='second_assistant_director_second_unit',
       data-value-property='value',
	   name='second_assistant_director_second_unit[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="second_assistant_director_second_unit">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                                  
                                 </div>
                                  <div class="form-group">  
                                 <label>Dialogue Director</label>  
                                 <?php
                                 					$tmp = '';
                                      $dialogue_director=explode(",",$read["dialogue_director"]);
                                     foreach($dialogue_director as $dialogue_director){
										  $dialogue_director_data_query="select * from director where id='$dialogue_director'";
										 $dialogue_director_data_exe=mysqli_query($con,$dialogue_director_data_query);
										 $dialogue_director_read=mysqli_fetch_array($dialogue_director_data_exe);
										 $dialogue_director_read_id=$dialogue_director_read["id"];
										 $tmp .=$dialogue_director_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Dialogue Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='dialogue_director',
       data-value-property='value',
	   name='dialogue_director[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="dialogue_director">
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                    
                                  
                                 </div>
                           
              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="update_directos"  class="btn btn-add"  value="update Directors">
                            
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
    <!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>
      <!-- jquery-ui --> 
      <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <!-- Bootstrap -->
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <!-- lobipanel -->
      <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <!-- Pace js -->
      <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <!-- table-export js -->

   
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
         
       
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script>
  $(document).ready(function() {
    $('.searchwithselect2').select2();
});
</script>
  
    <script>
$('.flexdatalist').flexdatalist({
     minLength: 1,
	 selectionRequired: true,
	  valueProperty: 'value'
});
</script>

 
   </body>
  
</html>

