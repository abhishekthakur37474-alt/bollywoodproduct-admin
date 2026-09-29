<?php
session_start();
include "config.php";

if (empty($_SESSION['admin'])) {
    header("location:index.php");
    exit();
}

$id = $_GET["id"];
$record = "SELECT * FROM film_producer_allot WHERE id='$id'";
$exe = mysqli_query($con, $record);
$read = mysqli_fetch_array($exe);
$film_id = $read["film_id"];
// Fetching producer IDs from the database
$film_producer_ids = explode(',', $read['film_producer_name']);
$film_co_producer_ids = explode(',', $read['film_co_producer_name']);
$film_line_producer_ids = explode(',', $read['film_line_producer_name']);

// Function to get producer names by IDs
function getProducerNames($ids, $con) {
    $names = [];
    foreach ($ids as $id) {
        $id = intval($id); // Ensure the ID is an integer
        $query = "SELECT name FROM producer WHERE id='$id'";
        $result = mysqli_query($con, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            $names[] = $row['name'];
        }
    }
    return implode(',', $names); // Return as a comma-separated string
}

// Get names for each role
 $film_producer_names = getProducerNames($film_producer_ids, $con);
$film_co_producer_names = getProducerNames($film_co_producer_ids, $con);
$film_line_producer_names = getProducerNames($film_line_producer_ids, $con);

if (isset($_POST["update_producer"])) {
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

    $film_directors = "UPDATE film_producer_allot SET 
        film_id='$film_id',
        created_by='$film_created_by',
        film_producer_name='$film_producer_name',
        film_co_producer_name='$film_co_producer_name',
        film_line_producer_name='$film_line_producer_name',
        film_executive_producer_name='$film_executive_producer_name',
        film_supervising_producer_name='$film_supervising_producer_name',
        film_associate_producer_name='$film_associate_producer_name',
        film_creative_producer_name='$film_creative_producer_name',
        film_post_producer_name='$film_post_producer_name',
        film_presenter_name='$film_presenter_name',
        project_head='$project_head',
        creative_designer='$creative_designer',
        show_runner='$show_runner',
        co_executive_producer='$co_executive_producer',
        unit_producer='$unit_producer',
        creative_head='$creative_head' 
        WHERE id='$id'";

    mysqli_query($con, $film_directors) or die(mysqli_error($con));
    echo "<script>alert('Film Producers Updated Successfully')</script>";
    echo "<script>window.location.href='film_producer_management.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Film Producers</title>
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
<link href="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
  <!-- select2 -->
  
 

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
                    <small>Edit Film Producers</small>
                </div>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag">
                            <div class="panel-heading">
                                <h4>Edit Film Producers Here</h4>
                            </div>
                            <div class="panel-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Select Film:</label>
                                                
                                               
                      <select class="searchwithselect2 form-control" name="film_id" style="width:100%;" required>
                                                   <?php 
                                                    $film_data_query = "SELECT * FROM film WHERE id='$film_id'";
                                                    $film_data_exe = mysqli_query($con, $film_data_query);
                                                    $film_name_read = mysqli_fetch_array($film_data_exe);
                                                    ?>
                                                    <option value="<?php echo $film_name_read["id"]; ?>"><?php echo $film_name_read["name"]; ?></option>

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
                                	 <?  $film_producer_read=explode(",",$read["film_producer_name"]);
														$tmp = '';

                                     foreach($film_producer_read as $film_producer_read_id){
									 
										 $producer_data_query="select * from producer where id='$film_producer_read_id'";
										 $producer_data_exe=mysqli_query($con,$producer_data_query);
										 $producer_data_read=mysqli_fetch_array($producer_data_exe);
										 $producer_read_id=$producer_data_read["id"];
										 $tmp .=$producer_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Film Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_producer_name',
       data-value-property='value',
	   name='film_producer_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>

 <div class="form-group">
							  	<label>Co-Producer Name</label>
                                	 <?  $film_co_producer_read=explode(",",$read["film_co_producer_name"]);
														$tmp = '';

                                     foreach($film_co_producer_read as $film_co_producer_read_id){
									 
										 $co_producer_data_query="select * from producer where id='$film_co_producer_read_id'";
										 $co_producer_data_exe=mysqli_query($con,$co_producer_data_query);
										 $co_producer_data_read=mysqli_fetch_array($co_producer_data_exe);
										 $co_producer_read_id=$co_producer_data_read["id"];
										 $tmp .=$co_producer_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Film Co-Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_co_producer_name',
       data-value-property='value',
	   name='film_co_producer_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_co_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>
                      <div class="form-group">
							  	<label>Line Producer Name</label>
                                	 <?  $film_line_producer_read=explode(",",$read["film_line_producer_name"]);
														$tmp = '';

                                     foreach($film_line_producer_read as $film_line_producer_read_id){
									 
										 $line_producer_data_query="select * from producer where id='$film_line_producer_read_id'";
										 $line_producer_data_exe=mysqli_query($con,$line_producer_data_query);
										 $line_producer_data_read=mysqli_fetch_array($line_producer_data_exe);
										 $line_producer_read_id=$line_producer_data_read["id"];
										 $tmp .=$line_producer_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Line Producer Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_line_producer_name',
       data-value-property='value',
	   name='film_line_producer_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_line_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>      
 <div class="form-group">
							  	<label>Executive Producer Name</label>
                                	 <?  $film_executive_producer_name_read=explode(",",$read["film_executive_producer_name"]);
														$tmp = '';

                                     foreach($film_executive_producer_name_read as $film_executive_producer_name_read_id){
									 
										 $executive_producer_data_query="select * from producer where id='$film_executive_producer_name_read_id'";
										 $executive_producer_data_exe=mysqli_query($con,$executive_producer_data_query);
										 $executive_producer_data_read=mysqli_fetch_array($executive_producer_data_exe);
										 $executive_producer_read_id=$executive_producer_data_read["id"];
										 $tmp .=$executive_producer_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Executive Producer Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_executive_producer_name',
       data-value-property='value',
	   name='film_executive_producer_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_executive_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>               
 <div class="form-group">
							  	<label>Supervising Producer Name:</label>
                                	 <?  $film_supervising_producer_read=explode(",",$read["film_supervising_producer_name"]);
														$tmp = '';

                                     foreach($film_supervising_producer_read as $film_supervising_producer_read_id){
									 
										 $supervising_producer_data_query="select * from producer where id='$film_supervising_producer_read_id'";
										 $supervising_producer_data_exe=mysqli_query($con,$supervising_producer_data_query);
										 $supervising_producer_data_read=mysqli_fetch_array($supervising_producer_data_exe);
										 $supervising_producer_read_id=$supervising_producer_data_read["id"];
										 $tmp .=$supervising_producer_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Supervising Producer Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_supervising_producer_name',
       data-value-property='value',
	   name='film_supervising_producer_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_supervising_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>
                
 <div class="form-group">
							  	<label>Associate Producer Name:</label>
                                	 <?  $film_associate_producer_read=explode(",",$read["film_associate_producer_name"]);
														$tmp = '';

                                     foreach($film_associate_producer_read as $film_associate_producer_read_id){
									 
										 $associate_producer_data_query="select * from producer where id='$film_associate_producer_read_id'";
										 $associate_producer_data_exe=mysqli_query($con,$associate_producer_data_query);
										 $associate_producer_data_read=mysqli_fetch_array($associate_producer_data_exe);
										 $associate_producer_read_id=$associate_producer_data_read["id"];
										 $tmp .=$associate_producer_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Associate Producer Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_associate_producer_name',
       data-value-property='value',
	   name='film_associate_producer_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_associate_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>	
 <div class="form-group">
							  	<label> Creative Producer Name</label>
                                	 <?  $film_creative_producer_read=explode(",",$read["film_creative_producer_name"]);
														$tmp = '';

                                     foreach($film_creative_producer_read as $film_creative_producer_read_id){
									 
										 $creative_producer_data_query="select * from producer where id='$film_creative_producer_read_id'";
										 $creative_producer_data_exe=mysqli_query($con,$creative_producer_data_query);
										 $creative_producer_data_read=mysqli_fetch_array($creative_producer_data_exe);
										 $creative_producer_read_id=$creative_producer_data_read["id"];
										 $tmp .=$creative_producer_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Creative Producer Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_creative_producer_name',
       data-value-property='value',
	   name='film_creative_producer_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_creative_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>			
                  
 <div class="form-group">
							  	<label>Post Producer Name</label>
                                	 <?  $film_post_producer_read=explode(",",$read["film_post_producer_name"]);
														$tmp = '';

                                     foreach($film_post_producer_read as $film_post_producer_read_id){
									 
										 $post_producer_data_query="select * from producer where id='$film_post_producer_read_id'";
										 $post_producer_data_exe=mysqli_query($con,$post_producer_data_query);
										 $post_producer_data_read=mysqli_fetch_array($post_producer_data_exe);
										 $post_producer_read_id=$post_producer_data_read["id"];
										 $tmp .=$post_producer_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Post Producer Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_post_producer_name',
       data-value-property='value',
	   name='film_post_producer_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_post_producer_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>				  
     <div class="form-group">
							  	<label> Presenter Name</label>
                                	 <?  $film_presenter_read=explode(",",$read["film_presenter_name"]);
														$tmp = '';

                                     foreach($film_presenter_read as $film_presenter_read_id){
									 
										 $presenter_data_query="select * from producer where id='$film_presenter_read_id'";
										 $presenter_data_exe=mysqli_query($con,$presenter_data_query);
										 $presenter_data_read=mysqli_fetch_array($presenter_data_exe);
										 $presenter_read_id=$presenter_data_read["id"];
										 $tmp .=$presenter_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Presenter Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_presenter_name',
       data-value-property='value',
	   name='film_presenter_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_presenter_name" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>    
 <div class="form-group">
							  	<label>Created By</label>
                                	 <?  $film_created_by=explode(",",$read["created_by"]);
														$tmp = '';

                                     foreach($film_created_by as $film_created_by_id){
									 
										 $created_by_data_query="select * from producer where id='$film_created_by_id'";
										 $created_by_data_exe=mysqli_query($con,$created_by_data_query);
										 $created_by_data_read=mysqli_fetch_array($created_by_data_exe);
										 $created_by_read_id=$created_by_data_read["id"];
										 $tmp .=$created_by_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Created By'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_created_by',
       data-value-property='value',
	   name='film_created_by[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_created_by" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>    
 <div class="form-group">
							  	<label>Project Head</label>
                                	 <?  $film_project_head=explode(",",$read["project_head"]);
														$tmp = '';

                                     foreach($film_project_head as $film_project_head_id){
									 
										 $project_head_data_query="select * from producer where id='$film_project_head_id'";
										 $project_head_data_exe=mysqli_query($con,$project_head_data_query);
										 $project_head_data_read=mysqli_fetch_array($project_head_data_exe);
										 $project_head_read_id=$project_head_data_read["id"];
										 $tmp .=$project_head_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Project Head'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='project_head',
       data-value-property='value',
	   name='project_head[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="project_head" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>
       
 <div class="form-group">
							  	<label>Creative Designer</label>
                                	 <?  $film_creative_designer=explode(",",$read["creative_designer"]);
														$tmp = '';

                                     foreach($film_creative_designer as $film_creative_designer_id){
									 
										 $creative_designer_data_query="select * from producer where id='$film_creative_designer_id'";
										 $creative_designer_data_exe=mysqli_query($con,$creative_designer_data_query);
										 $creative_designer_data_read=mysqli_fetch_array($creative_designer_data_exe);
										 $creative_designer_read_id=$creative_designer_data_read["id"];
										 $tmp .=$creative_designer_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Creative Designer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='creative_designer',
       data-value-property='value',
	   name='creative_designer[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="creative_designer" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>	   
 <div class="form-group">
							  	<label>Show Runner</label>
                                	 <?  $film_show_runner_read=explode(",",$read["show_runner"]);
														$tmp = '';

                                     foreach($film_show_runner_read as $film_show_runner_read_id){
									 
										 $show_runner_data_query="select * from producer where id='$film_show_runner_read_id'";
										 $show_runner_data_exe=mysqli_query($con,$show_runner_data_query);
										 $show_runner_data_read=mysqli_fetch_array($show_runner_data_exe);
										 $show_runner_read_id=$show_runner_data_read["id"];
										 $tmp .=$show_runner_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Show Runner'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='show_runner',
       data-value-property='value',
	   name='show_runner[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="show_runner" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>
 <div class="form-group">
							  	<label>Co-Executive Producer</label>
                                	 <?  $film_co_executive_producer=explode(",",$read["co_executive_producer"]);
														$tmp = '';

                                     foreach($film_co_executive_producer as $film_co_executive_producer_id){
									 
										 $co_executive_data_query="select * from producer where id='$film_co_executive_producer_id'";
										 $co_executive_data_exe=mysqli_query($con,$co_executive_data_query);
										 $co_executive_data_read=mysqli_fetch_array($co_executive_data_exe);
										 $co_executive_read_id=$co_executive_data_read["id"];
										 $tmp .=$co_executive_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Co-Executive Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='co_executive_producer',
       data-value-property='value',
	   name='co_executive_producer[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="co_executive_producer" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>
           
 <div class="form-group">
							  	<label>Unit Producer</label>
                                	 <?  $film_unit_producer=explode(",",$read["unit_producer"]);
														$tmp = '';

                                     foreach($film_unit_producer as $film_unit_producer_id){
									 
										 $unit_producer_data_query="select * from producer where id='$film_unit_producer_id'";
										 $unit_producer_data_exe=mysqli_query($con,$unit_producer_data_query);
										 $unit_producer_data_read=mysqli_fetch_array($unit_producer_data_exe);
										 $unit_producer_read_id=$unit_producer_data_read["id"];
										 $tmp .=$unit_producer_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Unit Producer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='unit_producer',
       data-value-property='value',
	   name='unit_producer[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="unit_producer" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>		   
       <div class="form-group">
							  	<label> Creative Head</label>
                                	 <?  $film_creative_head=explode(",",$read["creative_head"]);
														$tmp = '';

                                     foreach($film_creative_head as $film_creative_head_id){
									 
										 $creative_head_producer_data_query="select * from producer where id='$film_creative_head_id'";
										 $creative_head_producer_data_exe=mysqli_query($con,$creative_head_producer_data_query);
										 $creative_head_producer_data_read=mysqli_fetch_array($creative_head_producer_data_exe);
										 $creative_head_producer_read_id=$creative_head_producer_data_read["id"];
										 $tmp .=$creative_head_producer_read_id. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
 
<input type='text'
       placeholder='Enter Creative Head'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='creative_head',
       data-value-property='value',
	   name='creative_head[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="creative_head" >
   <? $sqlfr=mysqli_query($con, "select * from producer order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
</div>                           
                                  
                                  
                                    <div class="reset-button">
                                        <input type="submit" name="update_producer" class="btn btn-add" value="Update Producers">
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