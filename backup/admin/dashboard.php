<?
session_start();
include "config.php";
include "generalfunction.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      $total_recors_count="SELECT 
  SUM(cnt) AS total_rows 
FROM (
  SELECT 
    COUNT(*) AS cnt 
  FROM 
    director 
  UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
    producer
     UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
    film
    UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
    lyricist
    UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
    singer
    UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
   music_director
   UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
   actiondirector
   UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
   cast 
   UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
   costumes
   UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
   theater
   UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
   film_editor
   UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
   screenplay 
   UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
    production_designer
    UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
    choreographer
    UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
    cinematographer
    UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
    productionanddistribution 
    UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
    makeup 
    UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
    sound 
    UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
    visualeffects
    UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
     casting
     UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
   productionandmanagement
   UNION ALL 
  SELECT 
    COUNT(*) AS cnt 
  FROM 
   additionalcontributors            
 
) AS subquery";
$exe_total_count=mysqli_query($con,$total_recors_count);
$read_total_records=mysqli_fetch_array($exe_total_count);
$final_total_records=$read_total_records["total_rows"];
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Bollywood Product Admin Panel</title>
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <!-- Pe-icon -->
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <!-- Themify icons -->
      <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
      <!-- End Global Mandatory Style
         =====================================================================-->
      <!-- Start page Label Plugins 
         =====================================================================-->
      <!-- Emojionearea -->
      <link href="assets/plugins/emojionearea/emojionearea.min.css" rel="stylesheet" type="text/css"/>
      <!-- Monthly css -->
      <link href="assets/plugins/monthly/monthly.css" rel="stylesheet" type="text/css"/>
      <!-- End page Label Plugins 
         =====================================================================-->
      <!-- Start Theme Layout Style
         =====================================================================-->
      <!-- Theme style -->
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
      <!-- Theme style rtl -->
      <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
      <!-- End Theme Layout Style
         =====================================================================-->
   </head>
   <body class="hold-transition sidebar-mini">
      <!--preloader 
      <div id="preloader">
         <div id="status"></div>
      </div>
      <!-- Site wrapper -->
      <div class="wrapper">
         
         <!-- =============================================== -->
         <!-- Left side column. contains the sidebar -->
         <? include "topandleft.php"; ?>
         <!-- =============================================== -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-dashboard"></i>
               </div>
               <div class="header-title">
                  <h1>Bollywood Product:<span style="color:red;">Total Records:</span><span style="color:blue;"><?php echo $final_total_records;?></span></h1>
                  <small>Administrative Control Panel.</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="film.php">
                     <div id="cardbox1">
                        <div class="statistic-box">
                           <i class="fas fa-film fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM film order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?></span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Film</h3>
                           
                          
                        </div>
                     </div>
                     </a>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="director.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           
                           <i class="fa-solid fa-user-tie fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM director order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Director</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                  
                 
                 
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="lyricist.php">
                     <div id="cardbox1">
                        <div class="statistic-box">
                           <i class="fas fa-music fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM lyricist order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?></span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Lyricist</h3>
                           
                          
                        </div>
                     </div>
                     </a>
                  </div>
                 
                 
                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="singer.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fas fa-microphone fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM singer order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Singer</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                  
                 
                 
                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="music_director.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-headphones fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM music_director order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Music Director</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                 
                 
                 
                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="producer.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa fa-user-secret fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM producer order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Producer</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                  
                  
                  
                  
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="actiondirector.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-clapperboard fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM actiondirector order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Action Director</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                  
                  
                  
                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="cast.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-podcast fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM cast order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Cast</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                  
                  
                  
                  
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="costumes.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-users-line fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM costumes order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Costumes</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                  
                  
                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="theater.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-video fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM theater order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Theater</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                  
                  
                  
                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="filmeditor.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fas fa-cut fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM film_editor order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Film Editor</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                  
                  
                  
                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="screenplay.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-display fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM screenplay order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Screenplay</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                  
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="production_designer.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-shirt fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM production_designer order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Production Designer</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                  
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="choreographer.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <img src="photo/gd.webp" width="60px" height="60px" style="background-color:white;">
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM choreographer order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Choreographer</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                  
                  
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="cinematographer.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-video fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM cinematographer order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Cinematographer/DOP</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                  
                  
                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="productionanddistribution.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-video fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM productionanddistribution order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Production and Distribution</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                   
                  
                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="makeup.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-video fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM makeup order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3>Makeup</h3>
                        </div>
                     </div>
                     </a>
                  </div> 
                  
                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="sound.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-video fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM sound order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total Sound</h3>
                        </div>
                     </div>
                     </a>
                  </div> 
                  
                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="visualeffects.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-video fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM visualeffects order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total visualeffects</h3>
                        </div>
                     </div>
                     </a>
                  </div> 
                  
                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="casting.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-video fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM casting order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total casting</h3>
                        </div>
                     </div>
                     </a>
                  </div> 
                  
                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="productionandmanagement.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-video fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM productionandmanagement order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total production and management</h3>
                        </div>
                     </div>
                     </a>
                  </div> 
                  
                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                      <a href="additionalcontributors.php">
                     <div id="cardbox2">
                        <div class="statistic-box">
                           <i class="fa-solid fa-video fa-3x"></i>
                           <div class="counter-number pull-right">
                                <?php
														$r="SELECT id FROM additionalcontributors order by id";
                                                        $row=mysqli_query($con,$r);
                                                        $result=mysqli_num_rows($row); 														
														
														
														?>
                              <span class="count-number"><?php echo $result;?> </span> 
                              <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                           </div>
                           <h3> Total additional contributors</h3>
                        </div>
                     </div>
                     </a>
                  </div>
                 
                  
                  
               </div>

  
                
               <!-- /.row -->
              
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <footer>
    <strong>© 2018-<?php echo date('Y'); ?> Bollywood Product - A Brand of BPBB &reg; DIGITAL LLP. All Rights Reserved.</strong>
</footer>
      </div>
      <!-- /.wrapper -->
      <!-- Start Core Plugins
         =====================================================================-->
      <!-- jQuery -->
      <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
      <!-- jquery-ui --> 
      <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <!-- Bootstrap -->
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <!-- lobipanel -->
      <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <!-- Pace js -->
      <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <!-- SlimScroll -->
      <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript">    </script>
      <!-- FastClick -->
      <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
      <!-- CRMadmin frame -->
      <script src="assets/dist/js/custom.js" type="text/javascript"></script>
      <!-- End Core Plugins
         =====================================================================-->
      <!-- Start Page Lavel Plugins
         =====================================================================-->
      <!-- ChartJs JavaScript -->
      <script src="assets/plugins/chartJs/Chart.min.js" type="text/javascript"></script>
      <!-- Counter js -->
      <script src="assets/plugins/counterup/waypoints.js" type="text/javascript"></script>
      <script src="assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
      <!-- Monthly js -->
      <script src="assets/plugins/monthly/monthly.js" type="text/javascript"></script>
      <!-- End Page Lavel Plugins
         =====================================================================-->
      <!-- Start Theme label Script
         =====================================================================-->
      <!-- Dashboard js -->
      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
      <!-- End Theme label Script
         =====================================================================-->
      <script>
         function dash() {
         // single bar chart
         var ctx = document.getElementById("singelBarChart");
         var myChart = new Chart(ctx, {
         type: 'bar',
         data: {
         labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
         datasets: [
         {
         label: "My First dataset",
         data: [40, 55, 75, 81, 56, 55, 40],
         borderColor: "rgba(0, 150, 136, 0.8)",
         width: "1",
         borderWidth: "0",
         backgroundColor: "rgba(0, 150, 136, 0.8)"
         }
         ]
         },
         options: {
         scales: {
         yAxes: [{
             ticks: {
                 beginAtZero: true
             }
         }]
         }
         }
         });
               //monthly calender
               $('#m_calendar').monthly({
                 mode: 'event',
                 //jsonUrl: 'events.json',
                 //dataType: 'json'
                 xmlUrl: 'events.xml'
             });
         
         //bar chart
         var ctx = document.getElementById("barChart");
         var myChart = new Chart(ctx, {
         type: 'bar',
         data: {
         labels: ["January", "February", "March", "April", "May", "June", "July", "august", "september","october", "Nobemver", "December"],
         datasets: [
         {
         label: "My First dataset",
         data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56],
         borderColor: "rgba(0, 150, 136, 0.8)",
         width: "1",
         borderWidth: "0",
         backgroundColor: "rgba(0, 150, 136, 0.8)"
         },
         {
         label: "My Second dataset",
         data: [28, 48, 40, 19, 86, 27, 90, 28, 48, 40, 19, 86],
         borderColor: "rgba(51, 51, 51, 0.55)",
         width: "1",
         borderWidth: "0",
         backgroundColor: "rgba(51, 51, 51, 0.55)"
         }
         ]
         },
         options: {
         scales: {
         yAxes: [{
             ticks: {
                 beginAtZero: true
             }
         }]
         }
         }
         });
             //counter
             $('.count-number').counterUp({
                 delay: 10,
                 time: 5000
             });
         }
         dash();         
      </script>
   </body>
 
</html>

