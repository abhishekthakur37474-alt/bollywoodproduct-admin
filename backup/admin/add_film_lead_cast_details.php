<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      ?>
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Add Film Lead Cast Details</title>
      <!-- Favicon and touch icons -->
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

     
  <!-- select2 -->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
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
 <script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>
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
                  <h1>Film Lead Cast Details Management</h1>
                  <small>Add Film Lead Cast Details</small>
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
                                 <h4>Add Film Lead Cast Details Here</h4>
                              </a>
							 
                           </div>
                        </div>
                        <div class="panel-body">
						 <a href="javascript:void(0);" class="add_button2 btn btn-success pull-right" title="Add More">Add More</a><br/>
                 <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
<label>Select Film:</label>

<select class="main_language form-control" name="film_id" style="width:100%;" required>
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
    <label for="othercast">Lead Cast:</label>
	<input type='text'
       placeholder='Enter Lead Cast Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='lead_cast',
       data-value-property='value',
	   name='film_lead_cast_id[]'
       >
	   <datalist id="lead_cast" >
   <? $sqlfr=mysqli_query($con, "select * from cast order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
   
</datalist>



  </div>   
    
  <div class="form-group">
    <label for="character">Character Details:</label>
    <input type="text" class="form-control" id="character" name="characterdetails[]" >
  </div>
   <div class="form-group">
    <label for="remark">Character Remark:</label>
    <input type="text" class="form-control" id="remark" name="remark[]" >
  </div>
    <div class="field_wrapper2"></div>
 <input type="submit" name="UpdateLeadCast" id="leadcast" class="btn btn-add"   value="Add Lead Cast">
 </form>
 <?
        if($_POST["UpdateLeadCast"]) { 

    $film_id= $_POST['film_id'];
    $film_lead_cast_id=implode(",",$_POST['film_lead_cast_id']);
    $characterdetails=implode(",",$_POST["characterdetails"]);
    $remark=implode(",",$_POST["remark"]);
	$lead_cast_name=explode(",",$film_lead_cast_id);
	 $count_lead_cast=count($lead_cast_name);
    for($i=0;$i<$count_lead_cast;$i++){
	$lead_cast_name=explode(",",$film_lead_cast_id);
	$character_details=explode(",",$characterdetails);
	$remark_details=explode(",",$remark);
    mysqli_query($con, "insert into film_lead_cast (film_id, film_lead_cast_id,film_lead_charater,film_lead_remark) values ('$film_id', '$lead_cast_name[$i]','$character_details[$i]','$remark_details[$i]')");
	}

echo "<script>alert('Lead Cast Added Successfully')</script>";
echo "<script>window.location.href='film_lead_cast_details.php'</script>";
}                  
  ?>   
                            
                            
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
     
     
      <!-- jquery-ui --> 
     <!-- <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>-->
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
         
         
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="/admin/assets/bootstrap/js/jquery.richtext.js"></script>
<script src="/admin/assets/bootstrap/js/jquery.richtext.min.js"></script>


<script>
  $(document).ready(function() {
    $('.search_in_dropdown').select2();
});
</script>


<script>
  $(document).ready(function() {
    $('.search_in_dropdown').select2();
});
</script>


<script>
$(document).ready(function(){

    var maxField2 = 25;
    var addButton2 = $('.add_button2');
    var wrapper2 = $('.field_wrapper2');

    var fieldHTML2 =
    '<div><hr/>'+
    '<a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+

    '<div class="form-group">'+
    '<label>Lead Cast:</label>'+

    '<input type="text" '+
    'placeholder="Enter Lead Cast Name" '+
    'class="flexdatalist1" '+
    'data-min-length="1" '+
    'data-value-property="value" '+
    'list="lead_cast" '+
    'name="film_lead_cast_id[]">'+

    '<datalist id="lead_cast">'+
    '<?php echo $options; ?>'+
    '</datalist>'+

    '</div>'+

    '<div class="form-group">'+
    '<label>Character Details:</label>'+
    '<input type="text" class="form-control" name="characterdetails[]">'+
    '</div>'+

    '<div class="form-group">'+
    '<label>Character Remark:</label>'+
    '<input type="text" class="form-control" name="remark[]">'+
    '</div>'+

    '</div>';

    var x = 1;

    $(addButton2).click(function(){

        if(x < maxField2){

            x++;

            $(wrapper2).append(fieldHTML2);

            $('.flexdatalist1').flexdatalist({
                minLength:1,
                selectionRequired:true
            });

        } else {

            alert(
                'A maximum of '+
                maxField2+
                ' fields are allowed to be added.'
            );

        }

    });

    $(wrapper2).on(
        'click',
        '.remove_button',
        function(e){

            e.preventDefault();

            $(this)
            .parent('div')
            .remove();

            x--;

        }
    );

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

</body>
</html>