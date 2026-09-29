<?php
session_start();
include "config.php";

if (empty($_SESSION['admin'])) {
    header("location:index.php");
    exit();
}

if (isset($_POST["add_producer"])) {
    $film_id = mysqli_real_escape_string($con, $_POST['film_id']);
    $film_producer_name = mysqli_real_escape_string($con, implode(",", $_POST['film_producer_name']));
    $film_co_producer_name = mysqli_real_escape_string($con, implode(",", $_POST['film_co_producer_name']));
    $film_line_producer_name = mysqli_real_escape_string($con, implode(",", $_POST['film_line_producer_name']));
    $film_executive_producer_name = mysqli_real_escape_string($con, implode(",", $_POST['film_executive_producer_name']));
    $film_supervising_producer_name = mysqli_real_escape_string($con, implode(",", $_POST['film_supervising_producer_name']));
    $film_associate_producer_name = mysqli_real_escape_string($con, implode(",", $_POST['film_associate_producer_name']));
    $film_creative_producer_name = mysqli_real_escape_string($con, implode(",", $_POST['film_creative_producer_name']));
    $film_post_producer_name = mysqli_real_escape_string($con, implode(",", $_POST['film_post_producer_name']));
    $film_presenter_name = mysqli_real_escape_string($con, implode(",", $_POST['film_presenter_name']));
    $film_created_by = mysqli_real_escape_string($con, implode(",", $_POST['film_created_by']));
    $project_head = mysqli_real_escape_string($con, implode(",", $_POST['project_head']));
    $creative_designer = mysqli_real_escape_string($con, implode(",", $_POST['creative_designer']));
    $show_runner = mysqli_real_escape_string($con, implode(",", $_POST['show_runner']));
    $co_executive_producer = mysqli_real_escape_string($con, implode(",", $_POST['co_executive_producer']));
    $unit_producer = mysqli_real_escape_string($con, implode(",", $_POST['unit_producer']));
    $creative_head = mysqli_real_escape_string($con, implode(",", $_POST['creative_head']));

    $film_directors = "INSERT INTO film_producer_allot SET film_id='$film_id', created_by='$film_created_by', film_producer_name='$film_producer_name', film_co_producer_name='$film_co_producer_name', film_line_producer_name='$film_line_producer_name', film_executive_producer_name='$film_executive_producer_name', film_supervising_producer_name='$film_supervising_producer_name', film_associate_producer_name='$film_associate_producer_name', film_creative_producer_name='$film_creative_producer_name', film_post_producer_name='$film_post_producer_name', film_presenter_name='$film_presenter_name', project_head='$project_head', creative_designer='$creative_designer', show_runner='$show_runner', co_executive_producer='$co_executive_producer', unit_producer='$unit_producer', creative_head='$creative_head'";
    
    mysqli_query($con, $film_directors) or die(mysqli_error($con));
    
    echo "<script>alert('Film Producers Saved Successfully')</script>";
    echo "<script>window.location.href='film_producer_management.php'</script>";
    exit();
}

// Fetch all films
$films = [];
$sqlfr = mysqli_query($con, "SELECT id, name, year_release, main_lang FROM film ORDER BY id DESC");
while ($rowfr = mysqli_fetch_assoc($sqlfr)) {
    $films[] = $rowfr;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Add Film Producers</title>
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
    <div class="wrapper">
        <?php include "topandleft.php"; ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="header-icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="header-title">
                    <h1>Film Producers Management</h1>
                    <small>Add Film Producers</small>
                </div>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag">
                            <div class="panel-heading">
                                <h4>Add Film Producers Here</h4>
                            </div>
                            <div class="panel-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Select Film:</label>
                                               <select class="searchwithselect2 form-control" name="film_id" style="width:100%;" required>
<option value="">-Select Film-</option>

<?php
$sqlfr = mysqli_query($con, "
SELECT 
    f.id,
    f.name,
    f.year_release,
    f.type,
    f.season,
    d.name AS lang_name
FROM film f
LEFT JOIN dubbing d 
ON d.id = COALESCE(NULLIF(f.main_lang,''), f.dubbing)
ORDER BY f.id DESC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

$display = $rowfr['name'];

if($rowfr['type'] == "Web Series" && !empty($rowfr['season'])){
    $display .= " (Season ".$rowfr['season']." - ".$rowfr['year_release']." - ".$rowfr['lang_name'].")";
}else{
    $display .= " (".$rowfr['year_release']." - ".$rowfr['lang_name'].")";
}
?>

<option value="<?php echo $rowfr['id']; ?>">
<?php echo $display; ?>
</option>

<?php } ?>

</select>
                                            </div>
                                             <div class="form-group">
							  	<label> Film Producer</label>
                                
 
<input type='text'
       placeholder='Enter Film Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_producer_name',
       data-value-property='value',
	   name='film_producer_name[]',
      multiple
       >
	   <datalist id="film_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>
							  
                                     <div class="form-group">
							  	<label> Film Co-Producer</label>
                                
 
<input type='text'
       placeholder='Enter Film Co-Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_co_producer_name',
       data-value-property='value',
	   name='film_co_producer_name[]',
      multiple
       >
	   <datalist id="film_co_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>     
 <div class="form-group">
							  	<label> created By</label>
                                
 
<input type='text'
       placeholder='Enter created By'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_created_by',
       data-value-property='value',
	   name='film_created_by[]',
      multiple
       >
	   <datalist id="film_created_by" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>     
<div class="form-group">
<label> Project Head</label>
                                
 
<input type='text'
       placeholder='Enter Project Head'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='project_head',
       data-value-property='value',
	   name='project_head[]',
      multiple
       >
	   <datalist id="project_head" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>     
<div class="form-group">
<label> Creative Head</label>
<input type='text'
       placeholder='Enter Creative Head'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='creative_head',
       data-value-property='value',
	   name='creative_head[]',
      multiple
       >
	   <datalist id="creative_head" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>   
<div class="form-group">
<label> Creative Designer</label>
<input type='text'
       placeholder='Enter Creative Designer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='creative_designer',
       data-value-property='value',
	   name='creative_designer[]',
      multiple
       >
	   <datalist id="creative_designer" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>
<div class="form-group">
<label> Show Runner</label>
<input type='text'
       placeholder='Enter Show Runner'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='show_runner',
       data-value-property='value',
	   name='show_runner[]',
      multiple
       >
	   <datalist id="show_runner" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>    
<div class="form-group">
<label> Film Executive Producer</label>
<input type='text'
       placeholder='Enter Film Executive Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_executive_producer_name',
       data-value-property='value',
	   name='film_executive_producer_name[]',
      multiple
       >
	   <datalist id="film_executive_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div> 
          
<div class="form-group">
<label> Co-Executive Producer</label>
<input type='text'
       placeholder='Enter Co-Executive Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='co_executive_producer',
       data-value-property='value',
	   name='co_executive_producer[]',
      multiple
       >
	   <datalist id="co_executive_producer" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>		  
               <div class="form-group">
<label> Film Line Producer</label>
<input type='text'
       placeholder='Enter Film Line Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_line_producer_name',
       data-value-property='value',
	   name='film_line_producer_name[]',
      multiple
       >
	   <datalist id="film_line_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>     
<div class="form-group">
<label>Film Presenter</label>
<input type='text'
       placeholder='Enter Film Presenter'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_presenter_name',
       data-value-property='value',
	   name='film_presenter_name[]',
      multiple
       >
	   <datalist id="film_presenter_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div> 
<div class="form-group">
<label>Film Supervising Producer</label>
<input type='text'
       placeholder='Enter Film Supervising Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_supervising_producer_name',
       data-value-property='value',
	   name='film_supervising_producer_name[]',
      multiple
       >
	   <datalist id="film_supervising_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>                        
       
<div class="form-group">
<label>Film Creative Producer</label>
<input type='text'
       placeholder='Enter Film Creative Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_creative_producer_name',
       data-value-property='value',
	   name='film_creative_producer_name[]',
      multiple
       >
	   <datalist id="film_creative_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div> 	   
<div class="form-group">
<label>Film Associate Producer</label>
<input type='text'
       placeholder='Enter Film Associate Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_associate_producer_name',
       data-value-property='value',
	   name='film_associate_producer_name[]',
      multiple
       >
	   <datalist id="film_associate_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div> 
<div class="form-group">
<label>Film Post Producer</label>
<input type='text'
       placeholder='Enter Film Post Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_post_producer_name',
       data-value-property='value',
	   name='film_post_producer_name[]',
      multiple
       >
	   <datalist id="film_post_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div> 
<div class="form-group">
<label>Unit Producer</label>
<input type='text'
       placeholder='Enter Unit Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='unit_producer',
       data-value-property='value',
	   name='unit_producer[]',
      multiple
       >
	   <datalist id="unit_producer" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div> 
       
                          
                                        </div>
                                    </div>
                                    <div class="reset-button">
                                        <input type="submit" name="add_producer" class="btn btn-add" value="Add Producers">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include('footer.php'); ?>
    </div>
 
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


</body>
</html>