<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["add_directos"])) {

    /* ✅ helper functions */
    function post($key) {
        return $_POST[$key] ?? '';
    }

    function postArray($key) {
        return isset($_POST[$key]) && is_array($_POST[$key])
            ? implode(",", array_filter($_POST[$key]))
            : '';
    }

    /* ✅ safe inputs */
    $film_id = isset($_POST['film_id']) ? (int) $_POST['film_id'] : 0;

    if ($film_id <= 0) {
        die("Invalid Film ID");
    }

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

    /* ✅ prepared statement */
    $stmt = $con->prepare("
        INSERT INTO film_directors_allot (
            film_id, direction_team, second_unit_director, chief_associate_director,
            chief_assistant_director, third_assistant_director, technical_director,
            creative_director, director, co_director, assistant_director,
            associate_director, first_assistant_director, second_assistant_director,
            second_second_assistant_director, tainee_assistant_director,
            director_assistant, first_assistant_director_second_unit,
            second_assistant_director_second_unit, dialogue_director,
            additional_assistant_director
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ");

    $stmt->bind_param(
        "issssssssssssssssssss",
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
        $additional_assistant_director
    );

    if (!$stmt->execute()) {
        die("Insert failed: " . $stmt->error);
    }
 echo "<script>alert('Film Directors Save Succesfully')</script>";
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
      <title>Add Film Directors</title>
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
                  <small>Add Film Directors</small>
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
                                 <h4>Add Film Directors Here</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                             <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                  
                              <div class="form-group">
    <label>Select Film:</label>

    <select class="form-control searchwithselect2" id="film_id" name="film_id" style="width:100%;" required>
        <option value="">-Select Film-</option>

        <?php
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
        ?>

        <option value="<?php echo $row['id']; ?>">
            <?php echo $row['name']; ?> 
            (Year: <?php echo $row['year_release']; ?> 
            Language: <?php echo $row['languages'] ?? ''; ?>)
        </option>

        <?php } ?>

    </select>
</div>
                              <div class="form-group">
                                 <label>Film Director</label>
                                 
                                 
                                 <input type='text'
       placeholder='Enter Film Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_director_name',
       data-value-property='value',
	   name='film_director[]',
      multiple
       >
	   <datalist id="film_director_name" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                              
                              </div>
                              <!--
                               <select id="film_director"
            name="film_director[]"
            class="form-control searchwithselect2"
            multiple="multiple"
            style="width:100%;">
    </select>
    -->
    
    
                              <div class="form-group">
                                 <label>Film Co-Director</label>
                                 
                                  <input type='text'
       placeholder='Enter Film Co-Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_codirector_name',
       data-value-property='value',
	   name='film_codirector[]',
      multiple
       >
	   <datalist id="film_codirector_name" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                      

                                   </div>
                                       <div class="form-group">
                                 <label>Direction Team</label>
                                   <input type='text'
       placeholder='Enter Film Direction Team'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_directionteam_name',
       data-value-property='value',
	   name='direction_team[]',
      multiple
       >
	   <datalist id="film_directionteam_name" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>

                                   </div>
                               <div class="form-group">  
                                 <label>Film Associate Director</label> 
                                                               <input type='text'
       placeholder='Enter Film Associate Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_associate_director',
       data-value-property='value',
	   name='film_associate_director[]',
      multiple
       >
	   <datalist id="film_associate_director" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                               
                                 </div>
                                 <div class="form-group">  
                                 <label>Film Assistant Director</label>  
                                  <input type='text'
       placeholder='Enter Film Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_assistant_director',
       data-value-property='value',
	   name='film_assistant_director[]',
      multiple
       >
	   <datalist id="film_assistant_director" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>

                                  </div>
                                   <div class="form-group">
                                 <label>Additional Assistant Director</label>
                                  <input type='text'
       placeholder='Enter Film Additional Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='additional_assistant_director',
       data-value-property='value',
	   name='additional_assistant_director[]',
      multiple
       >
	   <datalist id="additional_assistant_director" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>

                                   </div>
                                     <div class="form-group">
                                 <label>Film Creative Director</label>
                                  <input type='text'
       placeholder='Enter Film Creative Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_creativedirector',
       data-value-property='value',
	   name='film_creativedirector[]',
      multiple
       >
	   <datalist id="film_creativedirector" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>

                                   </div>
                                  <div class="form-group">
                                 <label>Technical Director</label>
                                 <input type='text'
       placeholder='Enter Film Technical Directorr'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='technical_director',
       data-value-property='value',
	   name='technical_director[]',
      multiple
       >
	   <datalist id="technical_director" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                               
                              </div>
                               <div class="form-group">
                                 <label>Chief Associate Director</label>
                                  <input type='text'
       placeholder='Enter Film Chief Associate Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='chief_associate_director',
       data-value-property='value',
	   name='chief_associate_director[]',
      multiple
       >
	   <datalist id="chief_associate_director" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                                
                              </div>
                                <div class="form-group">
                                 <label>Chief Assistant Director</label>
                                                             <input type='text'
       placeholder='Enter Film Chief Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='chief_assistant_director',
       data-value-property='value',
	   name='chief_assistant_director[]',
      multiple
       >
	   <datalist id="chief_assistant_director" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                                
                              </div>
                              <div class="form-group">  
                                 <label>Film First Assistant Director</label> 
                                  <input type='text'
       placeholder='Enter Film First Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_first_assistant_director',
       data-value-property='value',
	   name='film_first_assistant_director[]',
      multiple
       >
	   <datalist id="film_first_assistant_director" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                               
                                 </div>
                                  <div class="form-group">  
                                 <label>Film Second Assistant Director</label> 
                                 <input type='text'
       placeholder='Enter Film Second Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_second_assistant_director',
       data-value-property='value',
	   name='film_second_assistant_director[]',
      multiple
       >
	   <datalist id="film_second_assistant_director" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                            
                                 </div>
                                  <div class="form-group">
                                 <label>Film Third Assistant Director</label>
                                  <input type='text'
       placeholder='Enter Film Third Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='third_assistant_director',
       data-value-property='value',
	   name='third_assistant_director[]',
      multiple
       >
	   <datalist id="third_assistant_director" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                              
                              </div>
 
                                 <div class="form-group">
                                 <label>Second Second Assistant Director</label>
                                  <input type='text'
       placeholder='Enter Film Second Second Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='second_second_assistant_director',
       data-value-property='value',
	   name='second_second_assistant_director[]',
      multiple
       >
	   <datalist id="second_second_assistant_director" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                               
                              </div>
                                   
                              <div class="form-group">
                                 <label>Trainee Assistant Director</label>
                                  <input type='text'
       placeholder='Enter Film Trainee Assistant Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='tainee_assistant_director',
       data-value-property='value',
	   name='tainee_assistant_director[]',
      multiple
       >
	   <datalist id="tainee_assistant_director" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                                
                              </div>
                              <div class="form-group">
                                 <label>Director Assistant</label>
                                  <input type='text'
       placeholder='Enter Film Director Assistant'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='director_assistant',
       data-value-property='value',
	   name='director_assistant[]',
      multiple
       >
	   <datalist id="director_assistant" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                        
                              </div>
                              <div class="form-group">
                                 <label>Second Unit Director</label>
                                  <input type='text'
       placeholder='Enter Film Second Unit Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='second_unit_director',
       data-value-property='value',
	   name='second_unit_director[]',
      multiple
       >
	   <datalist id="second_unit_director" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>

                              </div>
                              <div class="form-group">
                                 <label>First Assistant Director-Second Unit </label>
                                  <input type='text'
       placeholder='Enter Film Assistant Director-Second Unit'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='first_assistant_director_second_unit',
       data-value-property='value',
	   name='first_assistant_director_second_unit[]',
      multiple
       >
 <datalist id="first_assistant_director_second_unit" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                             
                              </div>
                              <div class="form-group">
                                 <label>Second Assistant Director-Second Unit </label>
                                 <input type='text'
       placeholder='Enter Film Second Assistant Director-Second Unit'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='second_assistant_director_second_unit',
       data-value-property='value',
	   name='second_assistant_director_second_unit[]',
      multiple
       >
 <datalist id="second_assistant_director_second_unit" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                                
                              </div>
                              <div class="form-group">
                                 <label>Dialogue Director</label>
                                 <input type='text'
       placeholder='Enter Film Dialogue Director'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='dialogue_director',
       data-value-property='value',
	   name='dialogue_director[]',
      multiple
       >
 <datalist id="dialogue_director" >
   <? $sqlfr=mysqli_query($con, "select * from director order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                              
                              </div>
                             
                                   
                               
                               
                                       
                                 
                                                              
     

              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="add_directos"  class="btn btn-add"  value="Add Directors">
                            
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
      <!-- ./wrapper -->
      <!-- Start Core Plugins
         =====================================================================-->
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
<script>
    $(document).ready(function () {
$('#film_director').select2({
    placeholder: "Search Director...",
    minimumInputLength: 2, // start searching after 2 chars
    ajax: {
        url: 'ajax/search-director.php',
        type: 'POST',
        dataType: 'json',
        delay: 300, // debounce
        data: function (params) {
            return {
                search: params.term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
});
});
</script>
 
   </body>
  
</html>

