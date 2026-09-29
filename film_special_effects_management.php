<?

session_start();

include "config.php";

if($_SESSION['admin']==""){

     header("location:index.php");

      } 

	   $id=$_GET["id"];

      $record="select * from  film_special_effects_management_allot where id='$id'";

      $exe=mysqli_query($con,$record);

      $read=mysqli_fetch_array($exe);

        $film_id=$read["film_id"];



?><!DOCTYPE html>

<html lang="en">

    

<head>

      <meta charset="utf-8">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Film Special Effects Management</title>

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



         <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

  <script>tinymce.init({

  selector: 'textarea',

  height: 300,

  theme: 'modern',

  plugins: 'print preview fullpage   searchreplace autolink directionality   visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc   advlist lists textcolor wordcount     imagetools      contextmenu colorpicker textpattern help',

  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',

  image_advtab: true,

  templates: [

    { title: 'Test template 1', content: 'Test 1' },

    { title: 'Test template 2', content: 'Test 2' }

  ],

  content_css: [

    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',

    '//www.tinymce.com/css/codepen.min.css'

  ]

 });</script>

   

   <script>

     function del()

     {

         var c=confirm('Are you sure delete this...?');

         if(c==true)

         {

             return true;

         }

         else{

             return false;

         }

     }

     

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

                  <h1> Film Special Effects Management</h1>

                  <small> Film Special Effects List</small>

               </div>

            </section>

            <!-- Main content -->

            <section class="content">

               <div class="row">

                  <div class="col-sm-12">

                     <div class="panel panel-bd lobidrag">

                        <div class="panel-heading">

                           <div class="btn-group" id="buttonexport">

                              <a href="#">

                                 <h4> Film Special Effects Management List</h4>

                              </a>

                           </div>

                        </div>

                        <div class="panel-body">

                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->

                           <div class="btn-group">

                              <div class="buttonexport" id="buttonlist"> 

                                 <a class="btn btn-add" href="add_film_special_effects_management.php"> <i class="fa fa-plus"></i> Add Special Effects

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

    url: "search_casting_management.php",

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



<input type="text" class="search form-control" id="searchid" placeholder="Search for Film" style="width: 100%" />  

<div id="result"></div>

 


   <br/>

 <select class="form-control select2"   onChange="window.document.location.href=this.options[this.selectedIndex].value;">
<option value="">Search Film  </option>
<?php $sqlfs=mysqli_query($con, "select * from film_special_effects_management_allot");
while($rowfs=mysqli_fetch_array($sqlfs)){ 

$film_id=$rowfs['film_id'];

$sqlf=mysqli_query($con,"select * from film where id='$film_id'");
$rowf=mysqli_fetch_array($sqlf);
   
$main_lang=explode(",",$rowf['main_lang']);
$main_language="";
foreach ($main_lang as $x) {
  $sqlld=mysqli_query($con, "select * from dubbing where id='$x'");
  $rowld=mysqli_fetch_array($sqlld);
  $main_language=$main_language.", ".$rowld['name'];

}
 
$main_language=   substr($main_language, 2);
 ?>

<option value="edit_film_special_effects.php?id=<?php echo $rowfs['id']; ?>"><?php echo $rowf['name']; ?> - <?php echo $rowf['year_release']; ?> - <?php echo $main_language; ?>     </option>
<?php } ?>

 </select><br>
                           

                           <br/>

                           <div class="table-responsive">

                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">

                                 <thead>

                                    <tr class="info"> 

                                    <th>S.N</th>

                                    <th>Film Name</th>

                                    <th>Directos</th>

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



  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `film_special_effects_management_allot`");

  $total_records = mysqli_fetch_array($result_count);

  $total_records = $total_records['total_records'];

    $total_no_of_pages = ceil($total_records / $total_records_per_page);

  $second_last = $total_no_of_pages - 1; // total page minus 1



    $result = mysqli_query($con,"SELECT * FROM `film_special_effects_management_allot` order by id desc LIMIT $offset, $total_records_per_page");





                                       $sn=1;

                                    while($row=mysqli_fetch_array($result)){ ?>

                                    <tr>

                                           <td><?php echo $sn;?></td>

                                           <td><?php 

                                    

                                    $film_id=$row["film_id"];

										 $film_data_query="select * from film where id='$film_id'";

										 $film_data_exe=mysqli_query($con,$film_data_query);

										 $film_name_read=mysqli_fetch_array($film_data_exe);

                                     ?>

                                     <?php echo $film_name_read["name"];?></td>

                                      

                                       <td>

                                           <table class="table table-bordered table-striped table-hover">

                                               <tr>

                                               <th>Special Effects:</th>

                                               <td>

											    <?php

$special_effects	= explode(",", $row["special_effects"]);



foreach ($special_effects	 as $special_effects_id) {

    $special_effects_data_query = "select * from  special_effect_manager where id='$special_effects_id'";

    $special_effects_data_exe = mysqli_query($con, $special_effects_data_query);

  

        $special_effects_name_read = mysqli_fetch_array($special_effects_data_exe);

        echo $special_effects_name_read["name"],"<br/>";

    }



?>

											   </td>

                                               </tr>

                                               <tr>

                                               <th>Special Effects Supervisor:</th>

                                               <td>

											    <?php

$special_effects_supervisor = explode(",", $row["special_effects_supervisor"]);



foreach ($special_effects_supervisor as $special_effects_supervisor_id) {

    $special_effects_supervisor_data_query = "select * from special_effect_manager where id='$special_effects_supervisor_id'";

    $special_effects_supervisor_data_exe = mysqli_query($con, $special_effects_supervisor_data_query);

  

        $special_effects_supervisor_name_read = mysqli_fetch_array($special_effects_supervisor_data_exe);

        echo $special_effects_supervisor_name_read["name"],"<br/>";

    }



?>

											   

											   </td>

                                               </tr>

                                               <tr>

                                               <th>Pyrotechnics:</th>

                                               <td>

											    <?php

$pyrotechnics = explode(",", $row["pyrotechnics"]);



foreach ($pyrotechnics as $pyrotechnics_id) {

    $pyrotechnics_data_query = "select * from special_effect_manager where id='$pyrotechnics_id'";

    $pyrotechnics_data_exe = mysqli_query($con, $pyrotechnics_data_query);

  

        $pyrotechnics_name_read = mysqli_fetch_array($pyrotechnics_data_exe);

        echo $pyrotechnics_name_read["name"],"<br/>";

    }



?>

											   

											   </td>

                                               </tr>

                                                <tr>

                                               <th>Machanical Effects:</th>

                                               <td>

											    <?php

$machanical_effects = explode(",", $row["machanical_effects"]);



foreach ($machanical_effects as $machanical_effects_id) {

    $machanical_effects_data_query = "select * from special_effect_manager where id='$machanical_effects_id'";

    $machanical_effects_data_exe = mysqli_query($con, $machanical_effects_data_query);

  

        $machanical_effects_name_read = mysqli_fetch_array($machanical_effects_data_exe);

        echo $machanical_effects_name_read["name"],"<br/>";

    }



?>

											   

											   </td>

                                               </tr>

                                                 <tr>

                                               <th>Creature Effects:</th>

                                               <td>

											    <?php

$creature_effects = explode(",", $row["creature_effects"]);



foreach ($creature_effects as $creature_effects_id) {

    $creature_effects_data_query = "select * from special_effect_manager where id='$creature_effects_id'";

    $creature_effects_data_exe = mysqli_query($con, $creature_effects_data_query);

  

        $creature_effects_name_read = mysqli_fetch_array($creature_effects_data_exe);

        echo $creature_effects_name_read["name"],"<br/>";

    }



?>

											   

											   </td>

                                               </tr>

                                             <tr>

                                               <th>Special Effects Coordinator:</th>

                                               <td>

											    <?php

$special_effects_coordinator = explode(",", $row["special_effects_coordinator"]);



foreach ($special_effects_coordinator as $special_effects_coordinator_id) {

    $special_effects_coordinator_data_query = "select * from special_effect_manager where id='$special_effects_coordinator_id'";

    $special_effects_coordinator_data_exe = mysqli_query($con, $special_effects_coordinator_data_query);

  

        $special_effects_coordinator_name_read = mysqli_fetch_array($special_effects_coordinator_data_exe);

        echo $special_effects_coordinator_name_read["name"],"<br/>";

    }



?>

											   

											   </td>

                                               </tr>

                                             <tr>

                                               <th>Prop Master:</th>

                                               <td>

											    <?php

$prop_master = explode(",", $row["prop_master"]);



foreach ($prop_master as $prop_master_id) {

    $prop_master_data_query = "select * from special_effect_manager where id='$prop_master_id'";

    $prop_master_data_exe = mysqli_query($con, $prop_master_data_query);

  

        $prop_master_name_read = mysqli_fetch_array($prop_master_data_exe);

        echo $prop_master_name_read["name"],"<br/>";

    }



?>

											   

											   </td>

                                               </tr>

                                                <tr>

                                               <th>Special Effects Technicianre:</th>

                                               <td>

											    <?php

$special_effects_technicianre = explode(",", $row["special_effects_technicianre"]);



foreach ($special_effects_technicianre as $special_effects_technicianre_id) {

    $special_effects_technicianre_data_query = "select * from special_effect_manager where id='$special_effects_technicianre_id'";

    $special_effects_technicianre_data_exe = mysqli_query($con, $special_effects_technicianre_data_query);

  

        $special_effects_technicianre_name_read = mysqli_fetch_array($special_effects_technicianre_data_exe);

        echo $special_effects_technicianre_name_read["name"],"<br/>";

    }



?>

											   

											   </td>

                                               </tr>

                                                <tr>

                                               <th>Special Effects Buyer:</th>

                                               <td>

											    <?php

$special_effects_buyer = explode(",", $row["special_effects_buyer"]);



foreach ($special_effects_buyer as $special_effects_buyer_id) {

    $special_effects_buyer_data_query = "select * from special_effect_manager where id='$special_effects_buyer_id'";

    $special_effects_buyer_data_exe = mysqli_query($con, $special_effects_buyer_data_query);

  

        $special_effects_buyer_name_read = mysqli_fetch_array($special_effects_buyer_data_exe);

        echo $special_effects_buyer_name_read["name"],"<br/>";

    }



?>

											   

											   </td>

                                               </tr>



 <tr>

                                               <th>Special Effects Assistant:</th>

                                               <td>

											    <?php

$special_effects_assistant = explode(",", $row["special_effects_assistant"]);



foreach ($special_effects_assistant as $special_effects_assistant_id) {

    $special_effects_assistant_data_query = "select * from special_effect_manager where id='$special_effects_assistant_id'";

    $special_effects_assistant_data_exe = mysqli_query($con, $special_effects_assistant_data_query);

  

        $special_effects_assistant_name_read = mysqli_fetch_array($special_effects_assistant_data_exe);

        echo $special_effects_assistant_name_read["name"],"<br/>";

    }



?>

											   

											   </td>

                                               </tr>



                                            </table>

                                         

                                          

                                       </td>

                                       <td>

                                         

                                          <a href="edit_film_special_effects.php?id=<? echo $row['id'];?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>

                                          <a  href="delete_film_special_effects.php?delete=<? echo $row['id'];?>" onclick="return del();" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>

                                       </td>

                                    </tr>



                                     <? $sn++;} ?>

                                    

                                 </tbody>

                              </table>







<div style='padding: 10px 20px 0px; border-top: ded 1px #CCC;'>

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



</script>
   


<script type="text/javascript"> 

$(document).ready(function() {
    $('.select2').select2();
});
</script>



