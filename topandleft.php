<? 
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      $admin_id=$_SESSION["id"];
     $record_profile="select * from admin where id='$admin_id'";
      $exe_profile=mysqli_query($con,$record_profile);
      $read_profile=mysqli_fetch_array($exe_profile);
      
      
     
           ?>

<header class="main-header">
            <a href="dashboard.php" class="logo">
               <!-- Logo -->
               <span class="logo-mini">
               <img src="assets/dist/img/mini-logo.png" alt="">
               </span>
               <span class="logo-lg">
               <img src="assets/dist/img/logo.png" alt="">
               </span>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
               <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                  <!-- Sidebar toggle button-->
                  <span class="sr-only">Toggle navigation</span>
                  <span class="pe-7s-angle-left-circle"></span>
               </a>
               <!-- searchbar-->
               <a href="#search"><span class="pe-7s-search"></span></a>
               <div id="search">
                  <button type="button" class="close">×</button>
                  <form>
                     <input type="search" value="" placeholder="type keyword(s) here" />
                     <button type="submit" class="btn btn-add">Search...</button>
                  </form>
               </div>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <!-- Orders -->
                     <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle admin-notification" data-toggle="dropdown"> 
                        <i class="pe-7s-cart"></i>
                        <span class="label label-primary">5</span>
                        </a>
                        <ul class="dropdown-menu">
                           <li>
                              <ul class="menu">
                                 <li >
                                    <!-- start Orders -->
                                    <a href="#" class="border-gray">
                                       <div class="pull-left">
                                          <img src="assets/dist/img/basketball-jersey.png" class="img-thumbnail" alt="User Image">
                                       </div>
                                       <h4>polo shirt</h4>
                                       <p><strong>total item:</strong> 21
                                       </p>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="border-gray">
                                       <div class="pull-left">
                                          <img src="assets/dist/img/shirt.png" class="img-thumbnail" alt="User Image">
                                       </div>
                                       <h4>Kits</h4>
                                       <p><strong>total item:</strong> 11
                                       </p>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="border-gray">
                                       <div class="pull-left">
                                          <img src="assets/dist/img/football.png" class="img-thumbnail" alt="User Image">
                                       </div>
                                       <h4>Football</h4>
                                       <p><strong>total item:</strong> 16
                                       </p>
                                    </a>
                                 </li>
                                 <li class="nav-list">
                                    <a href="#" class="border-gray">
                                       <div class="pull-left">
                                          <img src="assets/dist/img/shoe.png" class="img-thumbnail" alt="User Image">
                                       </div>
                                       <h4>Sports sheos</h4>
                                       <p><strong>total item:</strong> 10
                                       </p>
                                    </a>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <!-- Messages -->
                     <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="pe-7s-mail"></i>
                        <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                           <li>
                              <ul class="menu">
                                 <li>
                                    <!-- start message -->
                                    <a href="#" class="border-gray">
                                       <div class="pull-left">
                                          <img src="assets/dist/img/avatar.png" class="img-circle" alt="User Image">
                                       </div>
                                       <h4>Ronaldo</h4>
                                       <p>Please oreder 10 pices of kits..</p>
                                       <span class="badge badge-success badge-massege"><small>15 hours ago</small>
                                       </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="border-gray">
                                       <div class="pull-left">
                                          <img src="assets/dist/img/avatar2.png" class="img-circle" alt="User Image">
                                       </div>
                                       <h4>Leo messi</h4>
                                       <p>Please oreder 10 pices of Sheos..</p>
                                       <span class="badge badge-info badge-massege"><small>6 days ago</small>
                                       </span>   
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="border-gray">
                                       <div class="pull-left" >
                                          <img src="assets/dist/img/avatar3.png" class="img-circle" alt="User Image">
                                       </div>
                                       <h4>Modric</h4>
                                       <p>Please oreder 6 pices of bats..</p>
                                       <span class="badge badge-info badge-massege"><small>1 hour ago</small>
                                       </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="border-gray">
                                       <div class="pull-left">
                                          <img src="assets/dist/img/avatar4.png" class="img-circle" alt="User Image">
                                       </div>
                                       <h4>Salman</h4>
                                       <p>Hello i want 4 uefa footballs</p>
                                       <span class="badge badge-danger badge-massege">
                                       <small>6 days ago</small>
                                       </span>  
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="border-gray">
                                       <div class="pull-left">
                                          <img src="assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                                       </div>
                                       <h4>Sergio Ramos</h4>
                                       <p>Hello i want 9 uefa footballs</p>
                                       <span class="badge badge-info badge-massege"><small>5 hours ago</small>
                                       </span>
                                    </a>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <!-- Notifications -->
                     <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="pe-7s-bell"></i>
                        <span class="label label-warning">7</span>
                        </a>
                        <ul class="dropdown-menu">
                           <li>
                              <ul class="menu">
                                 <li>
                                    <a href="#" class="border-gray">
                                    <i class="fa fa-dot-circle-o color-green"></i>Change Your font style</a>
                                 </li>
                                 <li><a href="#" class="border-gray">
                                    <i class="fa fa-dot-circle-o color-red"></i>
                                    check the system ststus..</a>
                                 </li>
                                 <li><a href="#" class="border-gray">
                                    <i class="fa fa-dot-circle-o color-yellow"></i>
                                    Add more admin...</a>
                                 </li>
                                 <li><a href="#" class="border-gray">
                                    <i class="fa fa-dot-circle-o color-violet"></i> Add more clients and order</a>
                                 </li>
                                 <li><a href="#" class="border-gray">
                                    <i class="fa fa-dot-circle-o color-yellow"></i>
                                    Add more admin...</a>
                                 </li>
                                 <li><a href="#" class="border-gray">
                                    <i class="fa fa-dot-circle-o color-violet"></i> Add more clients and order</a>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <!-- Tasks -->
                     <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="pe-7s-note2"></i>
                        <span class="label label-danger">6</span>
                        </a>
                        <ul class="dropdown-menu">
                           <li>
                              <ul class="menu">
                                 <li>
                                    <!-- Task item -->
                                    <a href="#" class="border-gray">
                                       <span class="label label-success pull-right">50%</span>
                                       <h3><i class="fa fa-check-circle"></i> Theme color should be change</h3>
                                    </a>
                                 </li>
                                 <!-- end task item -->
                                 <li>
                                    <!-- Task item -->
                                    <a href="#" class="border-gray">
                                       <span class="label label-warning pull-right">90%</span>
                                       <h3><i class="fa fa-check-circle"></i> Fix Error and bugs</h3>
                                    </a>
                                 </li>
                                 <!-- end task item -->
                                 <li>
                                    <!-- Task item -->
                                    <a href="#" class="border-gray">
                                       <span class="label label-danger pull-right">80%</span>
                                       <h3><i class="fa fa-check-circle"></i> Sidebar color change</h3>
                                    </a>
                                 </li>
                                 <!-- end task item -->
                                 <li>
                                    <!-- Task item -->
                                    <a href="#" class="border-gray">
                                       <span class="label label-info pull-right">30%</span>   
                                       <h3><i class="fa fa-check-circle"></i> font-family should be change</h3>
                                    </a>
                                 </li>
                                 <li>
                                    <!-- Task item -->
                                    <a href="#"  class="border-gray">
                                       <span class="label label-success pull-right">60%</span>
                                       <h3><i class="fa fa-check-circle"></i> Fix the database Error</h3>
                                    </a>
                                 </li>
                                 <li>
                                    <!-- Task item -->
                                    <a href="#"  class="border-gray">
                                       <span class="label label-info pull-right">20%</span>
                                       <h3><i class="fa fa-check-circle"></i> data table data missing</h3>
                                    </a>
                                 </li>
                                 <!-- end task item -->
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <!-- Help -->
                     <li class="dropdown dropdown-help hidden-xs">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="pe-7s-settings"></i></a>
                        <ul class="dropdown-menu" > 
                           
                        <li><a href="settings.php"><i class="fa fa-bar-chart"></i> Settings</a></li>
                           <!-- <li>
                              <a href="profile.html">
                              <i class="fa fa-line-chart"></i> Networking</a>
                           </li>
                           <li><a href="#"><i class="fa fa fa-bullhorn"></i> Lan settings</a></li>
                          
                           <li><a href="login.html">
                              <i class="fa fa-wifi"></i> wifi</a>
                           </li> -->
                        </ul>
                     </li>
                     <!-- user -->
                     <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="photo/<? echo $read_profile["image"];?>" class="img-circle" width="45" height="45" alt="user"></a>
                        <ul class="dropdown-menu" >
                           <li>
                              <a href="edit_profile.php">
                              <i class="fa fa-user"></i> User Profile</a>
                           </li>
                           <li><a href="#"><i class="fa fa-inbox"></i> Inbox</a></li>
                           <li><a href="logout.php">
                              <i class="fa fa-sign-out"></i> Signout</a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </nav>
         </header>

         
         <!-- =============================================== -->
         <!-- Left side column. contains the sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar -->
            <div class="sidebar">
               <!-- sidebar menu -->
               <ul class="sidebar-menu">
                  <li class="active">
                     <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span>
                     <span class="pull-right-container">
                     </span>
                     </a>
                  </li>
                  <li class="active">
                     <a href="cast-crew-soical-media.php"><i class="fa fa-tachometer"></i><span>Cast/Crew Social Media</span>
                     <span class="pull-right-container">
                     </span>
                     </a>
                  </li>
                   <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>News & FAQ Management</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
 
                        <li><a href="faq.php">FAQ List</a></li> 
                        <li><a href="news.php">News List</a></li> 
                        <li><a href="birthdayvideo.php">Birthday Video List</a></li> 
                        <li><a href="content.php">Content Management</a></li> 
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Genre and Category</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
 
                        <li><a href="genre.php">Film Genre  List</a></li>  
                        <li><a href="categoryfilm.php">Film Category</a></li>
                        <li><a href="dubbing.php">Doubbing Category</a></li>
                        <li><a href="genresong.php">Song Genre  List</a></li> 
                         <li><a href="categorysong.php">Song Category</a></li>  
                     </ul>
                  </li>
    
 


                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Theater & Location </span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 

                        <li><a href="theater.php">Theater List</a></li> 
                      <!--
                        <li><a href="state.php">State  List</a></li>  
                        <li><a href="city.php">City List</a></li> 
                        -->
                     </ul>
                  </li>  

                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Blog Manegement </span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 

                        <li><a href="blog.php">blog List</a></li> 
                      
                     </ul>
                  </li>  

                
   
              
   
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Artists Management</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
                     <!-- <li><a href="crew_details.php">Add Crew Management</a></li> -->
                         <li><a href="unique_profile.php">All Profile List</a></li>
                         <li><a href="actiondirector.php">Action Director List</a></li>
                         <li><a href="additionalcontributors.php">Additional Contributors</a></li>
                        <li><a href="cast.php">Cast  List</a></li>    
                        <li><a href="crew_type.php">Crew Type  List</a></li> 
                        <li><a href="crew.php">Crew List</a></li>
                        <li><a href="choreographer.php">Choreographer List</a></li>
                        <li><a href="cinematographer.php">Cinematographer/DOP List</a></li>
                        <li><a href="casting.php">Casting</a></li>
                        <li><a href="costumes.php">Costumes</a></li>
                        <li><a href="director.php">Director List</a></li>
                        <li><a href="filmeditor.php">Film Editor List</a></li>
                        <li><a href="lyricist.php">Lyricist  List</a></li>
                        <li><a href="location_manager.php">Location Management</a></li>
                       
                        <li><a href="music_director.php">Music Director/<br/>Background Scorer List</a></li>
                         
                        <li><a href="mix.php">Mix</a></li> 
                        <li><a href="music_programmer.php">Music Programmer</a></li> 
                        <li><a href="master.php">Master</a></li> 
                        <li><a href="music_producer.php">Music Producer</a></li>
                        <li><a href="music_arranged.php">Music Arranged</a></li> 
                        <!--<li><a href="artdirector.php">Art Director List</a></li>-->
                        <li><a href="makeup.php">Makeup</a></li>
                        <li><a href="marketing_publicity.php">Marketing And Publicity</a></li>
                        <li><a href="producer.php">Producer/Co-Producer  List</a></li>
                        <li><a href="production_designer.php">Production Designer List</a></li>
                        <li><a href="productionanddistribution.php">Production and Distribution</a></li>
                        <li><a href="productionandmanagement.php">Production And Management</a></li>
                         <li><a href="special_effect_manager.php">Special Effects</a></li>
                        <li><a href="singer.php">Singer  List</a></li>  
                        
                       <!-- <li><a href="dialogue.php">Dialogue Writer List</a></li>-->
                        
                        <!--<li><a href="story_writer.php">Story Writer List</a></li>-->
                        <li><a href="screenplay.php">Screenplay List</a></li>
                        
                        <li><a href="sound.php">Sound</a></li>
                        <li><a href="visualeffects.php">Visual Effects</a></li>
                        
                        

                     </ul>
                  </li>


                    <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>New Film Management</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
 
                       <!-- <li><a href="film.php">Film  List</a></li>-->
                        <li><a href="film_basic_details.php">Film Basic Details</a></li>
                       
                        <li><a href="mutliple-roles-details.php">Film Multiple Roles Details</a></li>
                      
                        <li><a href="film_box_office_management.php">Film Box Office Details</a></li>
                        <li><a href="film_bookmyshow_management.php">Film Book My Show Details</a></li>
                        <li  class="treeview">
                        <!--<a href="film_crew_management.php">Film Crew Details</a>-->
                        <a href="#">
                    <span>Film Crew Details</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
 
                        <li><a href="film_directors_management.php">Film Directors</a></li>
                         <li><a href="film_producer_management.php">Film Producer</a></li>
                        <li><a href="film_music_directors_management.php">Film Music Director</a></li>
                        <li><a href="film_production_designer.php">Film Production Designer</a></li>
                        <li><a href="film_production_and_distributing.php">Production and Distribution</a></li>
                        <li><a href="film_makeup_management.php">Film Makeup</a></li>
                        <li><a href="film_visual_effects_management.php">Film Visual Effects</a></li>
                        <li><a href="film_casting_management.php">Film Casting</a></li>
                        <li><a href="film_editor_management.php">Film Film Editor</a></li>
                        <li><a href="film_screenplay_management.php">Film Screenplay</a></li>
                        <li><a href="film_choreographer_management.php">Film Choreographer</a></li>
                        <li><a href="film_action_director_management.php">Film Action Director</a></li>
                        <li><a href="film_sound_management.php">Film Sound</a></li>
                         <li><a href="film_costumes_management.php">Film Costumes</a></li>
                        <li><a href="film_production_management.php">Production Manangement</a></li>
                        <li><a href="film_cinematographer_management.php">Film Cinematographer</a></li>
                        <li><a href="film_additional_contributors_management.php">Additional Contributors</a></li>
                        <li><a href="film_location_management.php">Location Management</a></li>
                        <li><a href="film_special_effects_management.php">Special Effects</a></li>
                        <li><a href="film_marketing_and_publicity_management.php">Marketing And Publicity</a></li>
                    </ul>
                        </li>
                        <li><a href="film_dubbed_details.php">Film Dubbed Details</a></li>
                        <li><a href="film_diffrent_name_list.php" style="font-size:12px;">Film Different Name & Language</a></li>
                        <li><a href="film_similar_management.php">Similar Film Details</a></li>
                        <li><a href="film_lead_cast_details.php">Film Lead Cast Details</a></li>
                        <li><a href="film_other_cast_details.php">Film Other Cast Details</a></li>
                         <li><a href="film_ott_management.php">Film OTT Details</a></li>
                         <li><a href="film_other_details_management.php">Film Other Details Details</a></li>
                        
                        
                        
                        
                        
                        <!--<li><a href="film_genre_management.php">Film Genre Details</a></li>-->
                        <li><a href="film_rating_management.php">Film Rating Details</a></li>
                        
                        <li><a href="film_trailer_details.php">Film Trailer Details</a></li>
                       
                        <li><a href="film_trivia_management.php">Film Trivia Details</a></li>
                        
                        
                       
                     </ul>
                  </li>  
                  
                         <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Old Film Management</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 

                        <li><a href="film.php">Film List</a></li> 
                        </ul>
                        </li>
              
                    <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Film Song Management</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
 
                        
                        <li><a href="film_song.php">Film Song List</a></li>  
                        <li><a href="videosong.php">Videosong  List</a></li>  
                     </ul>
                  </li>  
                    <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Master Entries</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
                       
                        <li><a href="professional.php">Profession List</a></li>
                        <li><a href="platform.php">Platform List</a></li>
                        <li><a href="ott_platform_list.php">OTT Platform List</a></li> 
                        <li><a href="country_list.php">Nationality List</a></li>
                        <li><a href="country_list1.php">Country List</a></li>
                        <li><a href="state1.php">State List</a></li>
                        <li><a href="city1.php">City List</a></li>
                         <li><a href="pincode.php">Pincode List</a></li>
                        <li><a href="film_type_management.php">Film Type List</a></li>
                        <li><a href="film_trailer_categories.php">Trailer Categories List</a></li>
						       <li><a href="song_language.php">Song Language</a></li>
                        <li><a href="music_label_management.php">Music Label Management</a></li>
                         <li><a href="cinema-chain-name.php">Cinema Chain Management</a></li>
                         <li><a href="mall_complex.php">Mall/Complex Management</a></li>
                         <li><a href="social-media-name.php">Social Media Name</a></li>
                          <li><a href="coupon.php">Coupon Management</a></li> 
                     </ul>
                  </li>  
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Slider Management</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
                        <li><a href="film_slider.php">Slider List</a></li>
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="user-list.php">
                     <i class="fa fa-users"></i><span>User Management system</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                  </li>




                  
                   <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Subscriber Management</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
 
                        <li><a href="subscriber_package.php">Subscriber Package</a></li>

                        <li><a href="subscriber_package_attribute.php">Package Attribute</a></li>
                        <li><a href="subscriber_user.php">Subscriber User</a></li>
                        <li><a href="subscriber_user_package.php">Subscriber User Package</a></li>
                        <li><a href="subscriber_invoice.php">Subscriber Invoice</a></li>
                        <li><a href="subscriber_emailer.php">Subscriber Emailer</a></li>  
                        <li><a href="subscriber_content.php">Subscriber Content</a></li>
                        <li><a href="subscriber_faq.php">Subscriber FAQ</a></li>
                        <li><a href="subscriber_setting.php">Subscriber Setting</a></li>
                   
                     </ul>
                  </li>

 <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Advertiser Management</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
 
                        <li><a href="advertiser_user.php">Advertiser User</a></li>
                        <li><a href="advertiser_package.php">Advertiser Package</a></li>
                        <li><a href="advertiser_user_package.php">Advertiser User Package</a></li>
                        <li><a href="advertiser_invoice.php">Advertiser Invoice</a></li>
                        <li><a href="advertiser_report.php">Advertiser Report</a></li>
                        <li><a href="advertiser_content.php">Advertiser Content</a></li>
                        <li><a href="advertiser_faq.php">Advertiser FAQ</a></li>
                        <li><a href="advertiser_setting.php">Advertiser Setting</a></li>
                   
                     </ul>
                  </li>






 <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Awards Management</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
 
                        <li><a href="award_name.php">Award Name</a></li> 
                        <li><a href="award_year.php">Award Year</a></li> 
                        <li><a href="award_category.php">Award Category</a></li>
                        <li><a href="award_nomination.php?Action=Add">Award Nomination</a></li>

                        <!-- <li><a href="award.php">Award Management</a></li> -->
                   
                     </ul>
                  </li>



 <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Binaca Geetmala</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
  
                    <li><a href="binaca_geetmala.php">Binaca Geetmala</a></li>
 <li><a href="binaca_geetmala_songs.php">Binaca Geetmala Songs</a></li>

                     </ul>
                  </li>


                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Film Festival</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
  
                    <li><a href="film_festival.php">Film Festival</a></li> 
                    <li><a href="youtubemovies.php">Youtube Movies</a></li> 

                     </ul>
                  </li>
  

                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>TV Series</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
  
                    <li><a href="tv_channels.php">Channel Management</a></li> 
                    <li><a href="tv_series.php">Series Management</a></li> 
                    <li><a href="tv_seasons.php">Season Management</a></li> 
                    <li><a href="tv_episodes.php">Episodes Management</a></li> 
                    <li><a href="tv_episodes_links.php">Episodes Links Management</a></li> 
                    <li><a href="tv_talkshow.php">Talkshow Management</a></li> 
                    <li><a href="tv_realityshow.php">Realityshow Management</a></li> 
                    <li><a href="tv_reality_entry_exit_type.php">Reality Entry Exit Type</a></li> 
                    <li><a href="tv_reality_profile_type.php">Reality Profile type</a></li> 

                     </ul>
                  </li>
  

                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Quiz</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
  
                    <li><a href="quiz_question_generators.php">Question Geneartors</a></li>  
                    <li><a href="quiz_questions.php">Questions List</a></li>  

                     </ul>
                  </li>
  



 <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Payments Received</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
  
                    <li><a href="donate_user.php">Donation List</a></li> 

                     </ul>
                  </li>

                  

 <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Static Content</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
  
                    <li><a href="about_us_contant.php">About Us</a></li> 
                    <li><a href="legal_documents.php">Legal Documents</a></li> 

                     </ul>
                  </li>
  <!--
  
  <li class="treeview">
                     <a href="about_us_contant.php">
                     <i class="fa fa-users"></i><span>Static Content</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                  </li>
-->
  <li class="treeview">
                     <a href="mailer-log.php">
                     <i class="fa fa-users"></i><span>Mailer Details</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                  </li>

  <li class="treeview">
                     <a href="send-push.php">
                     <i class="fa fa-users"></i><span>Send Push</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                  </li>

                  <li class="treeview">
                     <a href="user-visit-report.php">
                     <i class="fa fa-users"></i><span>User Report</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                  </li>
                  <li class="treeview">
                     <a href="most-commonly-opened-pages.php">
                     <i class="fa fa-users"></i><span>Commonly Opened </span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                  </li>


                  <li class="treeview">
                     <a href="editors-choice-categories.php">
                     <i class="fa fa-users"></i><span>Editors Choice Category</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                  </li>

                  <li class="treeview">
                     <a href="editors-choice-links.php">
                     <i class="fa fa-users"></i><span>Editors Choice Links</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                  </li>

                  
                  <li class="treeview">
                     <a href="quiz-question-videos.php">
                     <i class="fa fa-users"></i><span>Quiz Question Videos</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                  </li>
                  
               
                  
                  
                  
                   <li class="treeview">
                     <a href="#">
                     <i class="fa fa-users"></i><span>Talent Management</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu"> 
 
                        <li><a href="manage_all.php">Payment Details</a></li>  
                        <li><a href="talent_coupon.php">talent coupon</a></li>
                        <li><a href="plan.php">Add Payments Plan</a></li>
                          <li><a href="production_type_management.php">Production Type Management </a></li>
                           <li><a href="age_range_management.php">Age Range Management</a></li>
                         
                          <li><a href="role_name_management.php">Role Name Management</a></li>
                     </ul>
                  </li>
    
                     <li class="active">
                     <a href="social-media-followers-list.php"><i class="fa fa-tachometer"></i><span>Cast Social Media Followers</span>
                     <span class="pull-right-container">
                     </span>
                     </a>
                  </li>

                     <li class="active">
                     <a href="view-all-cast-crew.php"><i class="fa fa-tachometer"></i><span>View All Cast/Crew</span>
                     <span class="pull-right-container">
                     </span>
                     </a>
                  </li>
               </ul> 
            </div>
            <!-- /.sidebar -->
            
         </aside>
         