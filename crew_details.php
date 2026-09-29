<?

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);



session_start();


include "config.php";

if ($_SESSION['admin'] == "") {

    header("location:index.php");

}

if (isset($_GET['Action']) && $_GET['Action'] == "ShowHome") {

    $id = $_GET['id'];

    $show_on_home = $_GET['show_on_home'];

    $sql = mysqli_query($con, "update testing set show_on_home='$show_on_home' where id='$id'") or die(mysqli_error($con));



}




if (isset($_POST["save"])) {



  
    $table = mysqli_real_escape_string($con, implode(",", $_POST['table']));

    $name = mysqli_real_escape_string($con, $_POST['name']);

    $real_name = mysqli_real_escape_string($con, $_POST['real_name']);
   
    
    $other_profession = mysqli_real_escape_string($con, implode(",", $_POST['table']));

    $nickname = mysqli_real_escape_string($con, $_POST['nickname']);

    $dob = mysqli_real_escape_string($con, $_POST['dob']);

    $birth_date = mysqli_real_escape_string($con, $_POST['birth_date']);

    $birth_month = mysqli_real_escape_string($con, $_POST['birth_month']);

    $birth_year = mysqli_real_escape_string($con, $_POST['birth_year']);



    $dod = mysqli_real_escape_string($con, $_POST['dod']);

    $death_date = mysqli_real_escape_string($con, $_POST['death_date']);

    $death_month = mysqli_real_escape_string($con, $_POST['death_month']);

    $death_year = mysqli_real_escape_string($con, $_POST['death_year']);



    $gender = mysqli_real_escape_string($con, $_POST['gender']);


    $show_on_home = mysqli_real_escape_string($con, $_POST['show_on_home']);

    $nationality = mysqli_real_escape_string($con, implode(",", $_POST['nationality']));

    $born_country = mysqli_real_escape_string($con, $_POST['born_country']);



    $born_state = mysqli_real_escape_string($con, implode(",", $_POST['born_state']));



    $born_city = mysqli_real_escape_string($con, implode(",", $_POST['born_city']));
  

    $father1 = mysqli_real_escape_string($con, implode(",", $_POST['father']));

    $father = rtrim($father1, ',');

    $father_data_from1 = mysqli_real_escape_string($con, implode(",", $_POST['father_name_choice_profesion']));

    $father_data_from = rtrim($father_data_from1, ',');
    
 

    $mother1 = mysqli_real_escape_string($con, implode(",", $_POST['mother']));

    $mother = rtrim($mother1, ',');

    $mother_data_from1 = mysqli_real_escape_string($con, implode(",", $_POST['mother_name_choice_profesion']));

    $mother_data_from = rtrim($mother_data_from1, ',');

    $spouse1 = mysqli_real_escape_string($con, implode(",", $_POST['spouse']));

    $spouse = rtrim($spouse1, ',');

    $spouse_data_from1 = mysqli_real_escape_string($con, implode(",", $_POST['spouse_name_choice_profesion']));

    $spouse_data_from = rtrim($spouse_data_from1, ',');

    $son_data_from1 = mysqli_real_escape_string($con, implode(",", $_POST['son_name_choice_profesion']));

    $son_data_from = rtrim($son_data_from1, ',');

    $son1 = mysqli_real_escape_string($con, implode(",", $_POST['son']));

    $son = rtrim($son1, ',');

    $daughter1 = mysqli_real_escape_string($con, implode(",", $_POST['daughter']));

    $daughter = rtrim($daughter1, ',');

    $daughter_data_from1 = mysqli_real_escape_string($con, implode(",", $_POST['daughter_name_choice_profesion']));

    $daughter_data_from = rtrim($daughter_data_from1, ',');

    $facebook = mysqli_real_escape_string($con, $_POST['facebook']);

    $twitter = mysqli_real_escape_string($con, $_POST['twitter']);

    $instagram = mysqli_real_escape_string($con, $_POST['instagram']);

    $details = mysqli_real_escape_string($con, $_POST['details']);

    $real_step_father = mysqli_real_escape_string($con, implode(",", $_POST['real_step_father']));

    $fatherDOB_date = mysqli_real_escape_string($con, implode(",", $_POST['fatherDOB_date']));

    $fatherDOB_month = mysqli_real_escape_string($con, implode(",", $_POST['fatherDOB_month']));

    $fatherDOB_year = mysqli_real_escape_string($con, implode(",", $_POST['fatherDOB_year']));

    $fatherDOD_date = mysqli_real_escape_string($con, implode(",", $_POST['fatherDOD_date']));

    $fatherDOD_month = mysqli_real_escape_string($con, implode(",", $_POST['fatherDOD_month']));

    $fatherDOD_year = mysqli_real_escape_string($con, implode(",", $_POST['fatherDOD_year']));

    $real_step_mother = mysqli_real_escape_string($con, implode(",", $_POST['real_step_mother']));

    $motherDOB_date = mysqli_real_escape_string($con, implode(",", $_POST['motherDOB_date']));

    $motherDOB_month = mysqli_real_escape_string($con, implode(",", $_POST['motherDOB_month']));

    $motherDOB_year = mysqli_real_escape_string($con, implode(",", $_POST['motherDOB_year']));

    $motherDOD_date = mysqli_real_escape_string($con, implode(",", $_POST['motherDOD_date']));

    $motherDOD_month = mysqli_real_escape_string($con, implode(",", $_POST['motherDOD_month']));

    $motherDOD_year = mysqli_real_escape_string($con, implode(",", $_POST['motherDOD_year']));

    $marriage_date = mysqli_real_escape_string($con, implode(",", $_POST['marriage_date']));

    $marriage_month = mysqli_real_escape_string($con, implode(",", $_POST['marriage_month']));

    $marriage_year = mysqli_real_escape_string($con, implode(",", $_POST['marriage_year']));

    $separation_date = mysqli_real_escape_string($con, implode(",", $_POST['separation_date']));

    $separation_month = mysqli_real_escape_string($con, implode(",", $_POST['separation_month']));

    $separation_year = mysqli_real_escape_string($con, implode(",", $_POST['separation_year']));

    $divorce_date = mysqli_real_escape_string($con, implode(",", $_POST['divorce_date']));

    $divorce_month = mysqli_real_escape_string($con, implode(",", $_POST['divorce_month']));

    $divorce_year = mysqli_real_escape_string($con, implode(",", $_POST['divorce_year']));

    $spouseDOD_date = mysqli_real_escape_string($con, implode(",", $_POST['spouseDOD_date']));

    $spouseDOD_month = mysqli_real_escape_string($con, implode(",", $_POST['spouseDOD_month']));

    $spouseDOD_year = mysqli_real_escape_string($con, implode(",", $_POST['spouseDOD_year']));

    $total_son = mysqli_real_escape_string($con, implode(",", $_POST['total_son']));

    $sonDOB_date = mysqli_real_escape_string($con, implode(",", $_POST['sonDOB_date']));

    $sonDOB_month = mysqli_real_escape_string($con, implode(",", $_POST['sonDOB_month']));

    $sonDOB_year = mysqli_real_escape_string($con, implode(",", $_POST['sonDOB_year']));

    $sonDOD_date = mysqli_real_escape_string($con, implode(",", $_POST['sonDOD_date']));

    $sonDOD_month = mysqli_real_escape_string($con, implode(",", $_POST['sonDOD_month']));

    $sonDOD_year = mysqli_real_escape_string($con, implode(",", $_POST['sonDOD_year']));

    $total_Daughter = mysqli_real_escape_string($con, implode(",", $_POST['total_Daughter']));

    $daughterDOB_date = mysqli_real_escape_string($con, implode(",", $_POST['daughterDOB_date']));

    $daughterDOB_month = mysqli_real_escape_string($con, implode(",", $_POST['daughterDOB_month']));

    $daughterDOB_year = mysqli_real_escape_string($con, implode(",", $_POST['daughterDOB_year']));

    $daughterDOD_date = mysqli_real_escape_string($con, implode(",", $_POST['daughterDOD_date']));

    $daughterDOD_month = mysqli_real_escape_string($con, implode(",", $_POST['daughterDOD_month']));

    $daughterDOD_year = mysqli_real_escape_string($con, implode(",", $_POST['daughterDOD_year']));

    $son_relation = mysqli_real_escape_string($con, implode(",", $_POST['son_relation']));

    $daughter_relation = mysqli_real_escape_string($con, implode(",", $_POST['daughter_relation']));

    $relative = mysqli_real_escape_string($con, implode(",", $_POST['relative']));

    $total_children = mysqli_real_escape_string($con, implode(",", $_POST['total_children']));

    $movie_language = mysqli_real_escape_string($con, implode(",", $_POST['movie_language']));

    $spouse_total_children = mysqli_real_escape_string($con, implode(",", $_POST['spouse_total_children']));



    $brother1 = mysqli_real_escape_string($con, implode(",", $_POST['brother']));

    $brother = rtrim($brother1, ',');

    $brother_data_from1 = mysqli_real_escape_string($con, implode(",", $_POST['brother_name_choice_profesion']));

    $brother_data_from = rtrim($brother_data_from1, ',');

    $brother_relation = mysqli_real_escape_string($con, implode(",", $_POST['brother_relation']));

    $brotherDOB_date = mysqli_real_escape_string($con, implode(",", $_POST['brotherDOB_date']));

    $brotherDOB_month = mysqli_real_escape_string($con, implode(",", $_POST['brotherDOB_month']));

    $brotherDOB_year = mysqli_real_escape_string($con, implode(",", $_POST['brotherDOB_year']));

    $brotherDOD_date = mysqli_real_escape_string($con, implode(",", $_POST['brotherDOD_date']));

    $brotherDOD_month = mysqli_real_escape_string($con, implode(",", $_POST['brotherDOD_month']));

    $brotherDOD_year = mysqli_real_escape_string($con, implode(",", $_POST['brotherDOD_year']));

    $sister1 = mysqli_real_escape_string($con, implode(",", $_POST['sister']));

    $sister = rtrim($sister1, ',');

    $sister_data_from1 = mysqli_real_escape_string($con, implode(",", $_POST['sister_name_choice_profesion']));

    $sister_data_from = rtrim($sister_data_from1, ',');

    $sister_relation = mysqli_real_escape_string($con, implode(",", $_POST['sister_relation']));

    $sisterDOB_date = mysqli_real_escape_string($con, implode(",", $_POST['sisterDOB_date']));

    $sisterDOB_month = mysqli_real_escape_string($con, implode(",", $_POST['sisterDOB_month']));

    $sisterDOB_year = mysqli_real_escape_string($con, implode(",", $_POST['sisterDOB_year']));

    $sisterDOD_date = mysqli_real_escape_string($con, implode(",", $_POST['sisterDOD_date']));

    $sisterDOD_month = mysqli_real_escape_string($con, implode(",", $_POST['sisterDOD_month']));

    $sisterDOD_year = mysqli_real_escape_string($con, implode(",", $_POST['sisterDOD_year']));



    $Spouse_Partner = mysqli_real_escape_string($con, $_POST['Spouse_Partner']);

    $son_mother_father = mysqli_real_escape_string($con, $_POST['son_mother_father']);

    $daughter_mother_father = mysqli_real_escape_string($con, $_POST['daughter_mother_father']);

    $brother_mother_father = mysqli_real_escape_string($con, $_POST['brother_mother_father']);

    $sister_mother_father = mysqli_real_escape_string($con, $_POST['sister_mother_father']);



    $social_media_name = mysqli_real_escape_string($con, implode(",", $_POST['social_media_name']));

    $social_media_link = mysqli_real_escape_string($con, implode(",", $_POST['link']));


    $img = $_FILES['filstor']['name'];

    $tmpName = $_FILES['filstor']['tmp_name'];

    if ($img <> "") {



        $ext = strrchr($img, ".");

        $prefix = str_replace(" ", "-", $name);

        $newName = $prefix . "-" . substr(md5(rand() * time()), 0, 5) . $ext;

        move_uploaded_file($tmpName, "photo/" . $newName);



    }





    $profile_unique_id = rand();

    $make_array = explode(",", $table);

    $count_number_of_table = count($make_array);

    for ($j = 1; $j <= $count_number_of_table; $j++) {

        $table_id = $make_array[$j - 1];



         $table_name_find = "select * from  profession  where id='$table_id'";

        $table_name_find_exe = mysqli_query($con, $table_name_find);

        $read_find_table_name = mysqli_fetch_array($table_name_find_exe);

        $table_name = $read_find_table_name["table_name"];

        $check_data = "select * from $table_name where name='$name' and birth_date='$birth_date' and birth_month='$birth_month' and birth_year='$birth_year' and nickname='$nickname'";

        $exe_crew_check = mysqli_query($con, $check_data);

        $find_crew = mysqli_num_rows($exe_crew_check);

     $alias =  strtolower(preg_replace('/\s+/', '-', trim($name)));
    

        if ($find_crew >= 1) {

            echo "<script>alert('Crew With Name $name is already Exist as $table_name')</script>";

        } else {

            $insert_query = "INSERT INTO $table_name set alias='$alias',social_media_name='$social_media_name',social_media_links='$social_media_link',profile_unique_id='$profile_unique_id',father_data_from='$father_data_from',mother_data_from='$mother_data_from',spouse_data_from='$spouse_data_from',son_data_from='$son_data_from',daughter_data_from='$daughter_data_from',brother_data_from='$brother_data_from',sister_data_from='$sister_data_from',Spouse_Partner='$Spouse_Partner',son_mother_father='$son_mother_father',daughter_mother_father='$daughter_mother_father',brother_mother_father='$brother_mother_father',sister_mother_father='$sister_mother_father',brother='$brother',brother_relation='$brother_relation',brotherDOB_date='$brotherDOB_date',brotherDOB_month='$brotherDOB_month',brotherDOB_year='$brotherDOB_year',brotherDOD_date='$brotherDOD_date',brotherDOD_month='$brotherDOD_month',brotherDOD_year='$brotherDOD_year',sister='$sister',sister_relation='$sister_relation',sisterDOB_date='$sisterDOB_date',sisterDOB_month='$sisterDOB_month',sisterDOB_year='$sisterDOB_year',sisterDOD_date='$sisterDOD_date',sisterDOD_month='$sisterDOD_month',sisterDOD_year='$sisterDOD_year',name='$name',total_children='$total_children',movie_language='$movie_language',spouse_total_children='$spouse_total_children',real_name='$real_name',nickname='$nickname',nationality='$nationality',born_country='$born_country',born_city='$born_city',father='$father',mother='$mother',spouse='$spouse',son='$son',daughter='$daughter',facebook='$facebook',twitter='$twitter',instagram='$instagram',birth_date='$birth_date',birth_month='$birth_month',birth_year='$birth_year',death_date='$death_date',death_month='$death_month',death_year='$death_year',gender='$gender',show_on_home='$show_on_home',photo='$newName',details='$details',real_step_father='$real_step_father',fatherDOB_date='$fatherDOB_date',fatherDOB_month='$fatherDOB_month',fatherDOB_year='$fatherDOB_year',fatherDOD_date='$fatherDOD_date',fatherDOD_month='$fatherDOD_month',fatherDOD_year='$fatherDOD_year',real_step_mother='$real_step_mother',motherDOB_date='$motherDOB_date',motherDOB_month='$motherDOB_month',motherDOB_year='$motherDOB_year',motherDOD_date='$motherDOD_date',motherDOD_month='$motherDOD_month', motherDOD_year='$motherDOD_year', marriage_date='$marriage_date', marriage_month='$marriage_month', marriage_year='$marriage_year', separation_date='$separation_date',separation_month='$separation_month',separation_year='$separation_year',divorce_date='$divorce_date',divorce_month='$divorce_month',divorce_year='$divorce_year', spouseDOD_date='$spouseDOD_date',spouseDOD_month='$spouseDOD_month',spouseDOD_year='$spouseDOD_year',total_son='$total_son',total_Daughter='$total_Daughter',sonDOB_date='$sonDOB_date', sonDOB_month='$sonDOB_month', sonDOB_year='$sonDOB_year', sonDOD_date='$sonDOD_date',sonDOD_month='$sonDOD_month',sonDOD_year='$sonDOD_year',daughterDOB_date='$daughterDOB_date',daughterDOB_month='$daughterDOB_month',daughterDOB_year='$daughterDOB_year',daughterDOD_date='$daughterDOD_date',daughterDOD_month='$daughterDOD_month', daughterDOD_year='$daughterDOD_year', born_state='$born_state',daughter_relation='$daughter_relation',son_relation='$son_relation',relative='$relative',other_profession='$other_profession'";

       if (!mysqli_query($con, $insert_query)) {
    die(mysqli_errno($con) . " : " . mysqli_error($con));
}

            // mysqli_query($con,"INSERT INTO cast set Spouse_Partner='$Spouse_Partner',son_mother_father='$son_mother_father',daughter_mother_father='$daughter_mother_father',brother_mother_father='$brother_mother_father',sister_mother_father='$sister_mother_father',brother='$brother',brother_relation='$brother_relation',brotherDOB_date='$brotherDOB_date',brotherDOB_month='$brotherDOB_month',brotherDOB_year='$brotherDOB_year',brotherDOD_date='$brotherDOD_date',brotherDOD_month='$brotherDOD_month',brotherDOD_year='$brotherDOD_year',sister='$sister',sister_relation='$sister_relation',sisterDOB_date='$sisterDOB_date',sisterDOB_month='$sisterDOB_month',sisterDOB_year='$sisterDOB_year',sisterDOD_date='$sisterDOD_date',sisterDOD_month='$sisterDOD_month',sisterDOD_year='$sisterDOD_year',name='$name',total_children='$total_children',movie_language='$movie_language',spouse_total_children='$spouse_total_children',real_name='$real_name',nickname='$nickname',nationality='$nationality',born_country='$born_country',born_city='$born_city',father='$father',mother='$mother',spouse='$spouse',son='$son',daughter='$daughter',facebook='$facebook',twitter='$twitter',instagram='$instagram',birth_date='$birth_date',birth_month='$birth_month',birth_year='$birth_year',death_date='$death_date',death_month='$death_month',death_year='$death_year',gender='$gender',show_on_home='$show_on_home',photo='$photo',details='$details',real_step_father='$real_step_father',fatherDOB_date='$fatherDOB_date',fatherDOB_month='$fatherDOB_month',fatherDOB_year='$fatherDOB_year',fatherDOD_date='$fatherDOD_date',fatherDOD_month='$fatherDOD_month',fatherDOD_year='$fatherDOD_year',real_step_mother='$real_step_mother',motherDOB_date='$motherDOB_date',motherDOB_month='$motherDOB_month',motherDOB_year='$motherDOB_year',motherDOD_date='$motherDOD_date',motherDOD_month='$motherDOD_month', motherDOD_year='$motherDOD_year', marriage_date='$marriage_date', marriage_month='$marriage_month', marriage_year='$marriage_year', separation_date='$separation_date',separation_month='$separation_month',separation_year='$separation_year',divorce_date='$divorce_date',divorce_month='$divorce_month',divorce_year='$divorce_year', spouseDOD_date='$spouseDOD_date',spouseDOD_month='$spouseDOD_month',spouseDOD_year='$spouseDOD_year',total_son='$total_son',total_Daughter='$total_Daughter',sonDOB_date='$sonDOB_date', sonDOB_month='$sonDOB_month', sonDOB_year='$sonDOB_year', sonDOD_date='$sonDOD_date',sonDOD_month='$sonDOD_month',sonDOD_year='$sonDOD_year',daughterDOB_date='$daughterDOB_date',daughterDOB_month='$daughterDOB_month',daughterDOB_year='$daughterDOB_year',daughterDOD_date='$daughterDOD_date',daughterDOD_month='$daughterDOD_month', daughterDOD_year='$daughterDOD_year', born_state='$born_state',daughter_relation='$daughter_relation',son_relation='$son_relation',relative='$relative',other_profession='$other_profession'");





        }

        // header('location:crew_details.php?msg=success');









    }

    echo "<script>alert('Add Crew Successful')</script>";

}











?><!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Crew Management</title>

    <!-- Favicon and touch icons -->

    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">

    <!-- Start Global Mandatory Style

         =====================================================================-->

    <!-- jquery-ui css -->

    <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap -->

    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap rtl -->

    <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->

    <!-- Lobipanel css -->

    <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css" />

    <!-- Pace css -->

    <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css" />

    <!-- Font Awesome -->

    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- Pe-icon -->

    <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css" />

    <!-- Themify icons -->

    <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css" />

    <!-- dataTables css -->

    <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css" />

    <!-- End Global Mandatory Style

         =====================================================================-->

    <!-- Start Theme Layout Style

         =====================================================================-->

    <!-- Theme style -->

    <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css" />

    <!-- Theme style rtl -->

    <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->

    <!-- End Theme Layout Style

      

      

         =====================================================================-->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <?php include "tinymce.php"; ?>



    <link href="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">

    <style>
        .flexdatalist-alias {

            width: 100%;

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

                    <h1>Crew Management</h1>



                </div>

            </section>

            <!-- Main content -->

            <section class="content">
                 <label>Search All Cast & Crew By Name:</label>
<input type="text" class="search form-control" id="searchid" placeholder="Search All Cast & Crew By Name..." style="width: 100%" /> 
<div id="result"></div>


<br/>

                <div class="row">

                    <!-- Form controls -->

                    <div class="col-sm-12">

                        <div class="panel panel-bd lobidrag">

                            <div class="panel-heading">

                                <div class="btn-group" id="buttonexport">

                                    <a href="#">

                                        <h4>Add Crew Details</h4>

                                    </a>

                                </div>

                            </div>

                            <div class="panel-body">

                               

                                <form class="col-sm-12" method="post"  enctype="multipart/form-data">



                                    <div class="form-group">

                                        <label>Select Crew Profession (e.g -Director/Producer/Music Director
                                            etc)</label>

                                        <input type='text' placeholder='Enter other Profession' class="flexdatalist"
                                            data-min-length='1' style='width:100%;' list='profession' ,
                                            data-value-property='value' , name='table[]' , multiple required>

                                        <datalist id="profession">

                                            <? $sqlfr = mysqli_query($con, "select * from profession order by profession_name");

                                            while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>



                                                <option value="<? echo $rowfr['id']; ?>">
                                                    <? echo $rowfr['profession_name']; ?></option>

                                            <? } ?>

                                        </datalist>

                                    </div>





                                    <div class="form-group">

                                        <label>Name</label>

                                        <input type="text" class="form-control" name="name" placeholder="Enter name">

                                    </div>
                                    <div class="form-group">

                                        <label>Real Name</label>

                                        <input type="text" class="form-control" name="real_name"
                                            placeholder="Enter real_name">

                                    </div>

                                    <div class="form-group">

                                        <label>Nick name</label>

                                        <input type="text" class="form-control" name="nickname"
                                            placeholder="Enter Nick name">

                                    </div>



                                    <!--		<div class="form-group">

                                         <label>Rather Than Above Selected Profile?(if Yes,Please Select,otherwise leave it blank)</label>

          <input type='text'

               placeholder='Enter other Profession'

               class="flexdatalist"

               data-min-length='1'

               style='width:100%;'

               list='profession',

               data-value-property='value',

               name='other_profession[]',

               multiple

               >

               <datalist id="profession" >

                                          <? $sqlfr = mysqli_query($con, "select * from profession order by profession_name");

                                          while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>



        <option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['profession_name']; ?></option>

                                          <? } ?>

                                          </datalist>

                                      </div> -->



                                    <div class="form-group">

                                        <label>Nationality</label>

                                        <input type='text' placeholder='Enter Nationality Name' class="flexdatalist"
                                            data-min-length='1' style='width:100%;' list='Nationality' ,
                                            data-value-property='value' , name='nationality[]' , multiple>

                                        <datalist id="Nationality">

                                            <? $sqlfr = mysqli_query($con, "select * from country order by country_name");

                                            while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>



                                                <option value="<? echo $rowfr['country_name']; ?>">
                                                    <? echo $rowfr['country_name']; ?></option>

                                            <? } ?>

                                        </datalist>



                                    </div>



                                    <div class="form-group">



                                        <div class="form-group">

                                            <label>Born Country</label>

                                            <input type='text' placeholder='Enter Born Country Name'
                                                class="flexdatalist" data-min-length='1' style='width:100%;'
                                                list='borncountry' , data-value-property='value' , name='born_country'
                                                ,>

                                            <datalist id="borncountry">

                                                <? $sqlfr = mysqli_query($con, "select * from country1 order by country_name");

                                                while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>



                                                    <option value="<? echo $rowfr['country_name']; ?>">
                                                        <? echo $rowfr['country_name']; ?></option>

                                                <? } ?>

                                            </datalist>

                                        </div>





                                        <div class="form-group">

                                            <label>Born State</label>

                                            <input type='text' placeholder='Enter Born state Name' class="flexdatalist"
                                                data-min-length='1' style='width:100%;' list='bornstate' ,
                                                data-value-property='value' , name='born_state[]' , multiple>

                                            <datalist id="bornstate">

                                                <? $sqlfr = mysqli_query($con, "select * from state1 order by state");

                                                while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>



                                                    <option value="<? echo $rowfr['state']; ?>"><? echo $rowfr['state']; ?>
                                                    </option>

                                                <? } ?>

                                            </datalist>

                                        </div>





                                        <div class="form-group">

                                            <label>Born City</label>

                                            <input type='text' placeholder='Enter Born city Name' class="flexdatalist"
                                                data-min-length='1' style='width:100%;' list='borncity' ,
                                                data-value-property='value' , name='born_city[]' , multiple>

                                            <datalist id="borncity">

                                                <? $sqlfr = mysqli_query($con, "select * from city1 order by city");

                                                while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>



                                                    <option value="<? echo $rowfr['city']; ?>"><? echo $rowfr['city']; ?>
                                                    </option>

                                                <? } ?>

                                            </datalist>

                                        </div>
                                    
<!--data here start-->
<?php include('family-part.php');?>


<!--data end here-->

                                        <div class="form-group">

                                            <label>Relatives</label>

                                            <input type='text' placeholder='Enter Relatives Name' class="flexdatalist"
                                                data-min-length='1' style='width:100%;' list='cast' ,
                                                data-value-property='value' , name='relative[]' , multiple>

                                            <datalist id="cast">

                                                <? $sqlfr = mysqli_query($con, "select * from cast order by name");

                                                while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>



                                                    <option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?>
                                                    </option>

                                                <? } ?>

                                            </datalist>

                                        </div>



                                        <div class="form-group">

                                            <label>Movie Language</label>

                                            <input type='text' placeholder='Enter Movie Language  Name'
                                                class="flexdatalist" data-min-length='1' style='width:100%;'
                                                list='movie_language' , data-value-property='value' ,
                                                name='movie_language[]' , multiple>

                                            <datalist id="movie_language">

                                                <? $sqlfr = mysqli_query($con, "select * from dubbing  order by name");

                                                while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>



                                                    <option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?>
                                                    </option>

                                                <? } ?>

                                            </datalist>

                                        </div>



                                        <div class="form-group  ">

                                            <label>Lead Actor/Actress Total No. Of Children</label>



                                            <input type="text" class="form-control" name="total_children[]"
                                                placeholder="NO. Of children">



                                        </div>




 

                                        <div id="social" style="border:1px solid black;">

                                            <a href="javascript:void(0);" class="add_button2 btn btn-success pull-right"
                                                title="Add More">Add More</a><br />

                                            <div class="form-group">

                                                <label for="social_media_name">Select Social Media Name:</label>

                                                <select class="form-control social_media_name" id="social_media_name"
                                                    name="social_media_name[]">

                                                    <option>-Select Social Media Name-</option>

                                                    <? $social_media_name = mysqli_query($con, "select * from social_media_name order by name");

                                                    while ($choice_exe = mysqli_fetch_array($social_media_name)) { ?>



                                                        <option value="<? echo $choice_exe['id']; ?>">
                                                            <? echo $choice_exe['name']; ?></option>

                                                    <? } ?>



                                                </select>



                                            </div>

                                            <div class="form-group">

                                                <label for="link">Social Media Link:</label>

                                                <input type="text" class="form-control" id="link" name="link[]">

                                            </div>

                                            <div class="field_wrapper2"></div>

                                        </div>







                                        <div class="form-group">

                                            <label>Birth Date</label>

                                            <input type="text" class="form-control" name="birth_date"
                                                placeholder="Enter Birth Date">



                                            <div class="form-group">

                                                <label>Birth Month</label>

                                                <input type="text" class="form-control" name="birth_month"
                                                    placeholder="Enter Birth Month">



                                                <div class="form-group">

                                                    <label>Birth Year</label>

                                                    <input type="text" class="form-control" name="birth_year"
                                                        placeholder="Enter Birth Year">





                                                </div>



                                            </div>
                                            <div class="form-group">

                                                <label>Death Date</label>

                                                <input type="text" class="form-control" name="death_date"
                                                    placeholder="Enter Death Date">

                                            </div>



                                            <div class="form-group">

                                                <label>Death Month</label>

                                                <input type="text" class="form-control" name="death_month"
                                                    placeholder="Enter Death Month">

                                            </div>

                                            <div class="form-group">

                                                <label>Death year</label>

                                                <input type="text" class="form-control" name="death_year"
                                                    placeholder="Enter Death Year">

                                            </div>

                                            <div class="form-group">

                                                <label>Gender</label><br>

                                                <input type="radio" name="gender" value="">None<br>

                                                <input type="radio" name="gender" value="Male">Male<br>

                                                <input type="radio" name="gender" value="Female">Female<br>

                                            </div>

                                            <div class="form-group">

                                                <label>Show on Home</label>

                                                <select class="form-control" name="show_on_home">

                                                    <option value="0">No</option>

                                                    <option value="1">Yes</option>

                                                </select>

                                            </div>



                                            <div class="form-group">

                                                <label>Image</label>

                                                <input type="file" name="filstor" class="form-control">



                                            </div>





                                            <div class="form-group">

                                                <label>Details</label>

                                                <textarea name="details" rows="25"></textarea>

                                            </div>







                                            <div class="reset-button">



                                                <input type="submit" name="save" class="btn btn-add"
                                                    value="Add Record">



                                            </div>

                                </form>

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

            <strong>Copyright &copy; 2018-22023 <a href="#">Bollywood Product</a>.</strong> All rights reserved.

        </footer>

    </div>

    <!-- ./wrapper -->

    <!-- Start Core Plugins

         =====================================================================-->

    <!-- jQuery -->

    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css"
        integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js"
        integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>



</html>





<script type="text/javascript">

    function resume_id(res_id) {



        var agree = confirm("This will record.  Are you sure you wish to continue?");

        if (agree) {

            window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?remove=yes&id=' + res_id;

            window.submit();

        }

        else {



        }

    }



</script>



<script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>

<script>

    $('.flexdatalist').flexdatalist({

        minLength: 1,

        selectionRequired: true,

        valueProperty: 'value'

    });

</script>



<script>

    $(document).ready(function () {

        $('.main_language').select2();

    });

</script>



<script>

    $(document).ready(function () {

        $('.orignal_language').select2();

    });

</script>





<script>

    $(document).ready(function () {

        $("#sister_name_choice").on('change', function () {

            var sister_name_choice = $(this).val();



            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    sister_name_choice: sister_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#sister_name_select").html(data);

                    $('.sister').select2();



                }

            });

        });



    });

</script>





<script>

    $(document).ready(function () {



        $("#father_name_choice").on('change', function () {

            var father_name_choice = $(this).val();



            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    father_name_choice: father_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#father_name_select").html(data);

                    $('.father').select2();



                }

            });

        });



        $("#father_name_choice2").on('change', function () {

            var father_name_choice = $(this).val();

            $("#father_name_select_text2").css("display", "none");

            $("#father_name_select_text2").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    father_name_choice: father_name_choice

                },

                datatype: "html",

                success: function (data) {



                    $("#father_name_select2").html(data);

                    $('.father2').select2();





                }

            });

        });

        $("#father_name_choice3").on('change', function () {

            var father_name_choice = $(this).val();

            $("#father_name_select_text3").css("display", "none");

            $("#father_name_select_text3").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    father_name_choice: father_name_choice

                },

                datatype: "html",

                success: function (data) {



                    $("#father_name_select3").html(data);

                    $('.father3').select2();





                }

            });

        });



        $("#father_name_choice4").on('change', function () {

            var father_name_choice = $(this).val();

            $("#father_name_select_text4").css("display", "none");

            $("#father_name_select_text4").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    father_name_choice: father_name_choice

                },

                datatype: "html",

                success: function (data) {



                    $("#father_name_select4").html(data);

                    $('.father4').select2();





                }

            });

        });



        $("#father_name_choice5").on('change', function () {

            var father_name_choice = $(this).val();

            $("#father_name_select_text5").css("display", "none");

            $("#father_name_select_text5").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    father_name_choice: father_name_choice

                },

                datatype: "html",

                success: function (data) {



                    $("#father_name_select5").html(data);

                    $('.father5').select2();





                }

            });

        });





    });





</script>





<script>

    $(document).ready(function () {



        $("#mother_name_choice").on('change', function () {

            var mother_name_choice = $(this).val();



            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    mother_name_choice: mother_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#mother_name_select").html(data);

                    $('.mother').select2();



                }

            });

        });



        $("#mother_name_choice2").on('change', function () {

            var mother_name_choice = $(this).val();

            $("#mother_name_select_text2").css("display", "none");

            $("#mother_name_select_text2").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    mother_name_choice: mother_name_choice

                },

                datatype: "html",

                success: function (data) {



                    $("#mother_name_select2").html(data);

                    $('.mother2').select2();





                }

            });

        });

        $("#mother_name_choice3").on('change', function () {

            var mother_name_choice = $(this).val();

            $("#mother_name_select_text3").css("display", "none");

            $("#mother_name_select_text3").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    mother_name_choice: mother_name_choice

                },

                datatype: "html",

                success: function (data) {



                    $("#mother_name_select3").html(data);

                    $('.mother3').select2();





                }

            });

        });



        $("#mother_name_choice4").on('change', function () {

            var mother_name_choice = $(this).val();

            $("#mother_name_select_text4").css("display", "none");

            $("#mother_name_select_text4").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    mother_name_choice: mother_name_choice

                },

                datatype: "html",

                success: function (data) {



                    $("#mother_name_select4").html(data);

                    $('.mother4').select2();





                }

            });

        });



        $("#mother_name_choice5").on('change', function () {

            var mother_name_choice = $(this).val();

            $("#mother_name_select_text5").css("display", "none");

            $("#mother_name_select_text5").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    mother_name_choice: mother_name_choice

                },

                datatype: "html",

                success: function (data) {



                    $("#mother_name_select5").html(data);

                    $('.mother5').select2();





                }

            });

        });





    });





</script>





<script>

    $(document).ready(function () {

        $("#spouse_name_choice").on('change', function () {

            var spouse_name_choice = $(this).val();

            $("#spouse_name_select_text").css("display", "none");

            $("#spouse_name_select_text").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    spouse_name_choice: spouse_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#spouse_name_select").html(data);

                    $('.spouse').select2();



                }

            });

        });

        $("#spouse_name_choice2").on('change', function () {

            var spouse_name_choice = $(this).val();

            $("#spouse_name_select_text2").css("display", "none");

            $("#spouse_name_select_text2").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    spouse_name_choice: spouse_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#spouse_name_select2").html(data);

                    $('.spouse2').select2();



                }

            });

        });

        $("#spouse_name_choice3").on('change', function () {

            var spouse_name_choice = $(this).val();

            $("#spouse_name_select_text3").css("display", "none");

            $("#spouse_name_select_text3").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    spouse_name_choice: spouse_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#spouse_name_select3").html(data);

                    $('.spouse3').select2();



                }

            });

        });



        $("#spouse_name_choice4").on('change', function () {

            var spouse_name_choice = $(this).val();

            $("#spouse_name_select_text4").css("display", "none");

            $("#spouse_name_select_text4").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    spouse_name_choice: spouse_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#spouse_name_select4").html(data);

                    $('.spouse4').select2();



                }

            });

        });



        $("#spouse_name_choice5").on('change', function () {

            var spouse_name_choice = $(this).val();

            $("#spouse_name_select_text5").css("display", "none");

            $("#spouse_name_select_text5").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    spouse_name_choice: spouse_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#spouse_name_select5").html(data);

                    $('.spouse5').select2();



                }

            });

        });

    });

</script>





<script>

    $(document).ready(function () {

        $("#daughter_name_choice").on('change', function () {

            var daughter_name_choice = $(this).val();

            $("#daughter_name_select_text").css("display", "none");

            $("#daughter_name_select_text").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    daughter_name_choice: daughter_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#daughter_name_select").html(data);

                    $('.daughter').select2();



                }

            });

        });

        $("#daughter_name_choice2").on('change', function () {

            var daughter_name_choice = $(this).val();

            $("#daughter_name_select_text2").css("display", "none");

            $("#daughter_name_select_text2").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    daughter_name_choice: daughter_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#daughter_name_select2").html(data);

                    $('.daughter2').select2();



                }

            });

        });

        $("#daughter_name_choice3").on('change', function () {

            var daughter_name_choice = $(this).val();

            $("#daughter_name_select_text3").css("display", "none");

            $("#daughter_name_select_text3").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    daughter_name_choice: daughter_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#daughter_name_select3").html(data);

                    $('.daughter3').select2();



                }

            });

        });



        $("#daughter_name_choice4").on('change', function () {

            var daughter_name_choice = $(this).val();

            $("#daughter_name_select_text4").css("display", "none");

            $("#daughter_name_select_text4").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    daughter_name_choice: daughter_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#daughter_name_select4").html(data);

                    $('.daughter4').select2();



                }

            });

        });



        $("#daughter_name_choice5").on('change', function () {

            var daughter_name_choice = $(this).val();

            $("#daughter_name_select_text5").css("display", "none");

            $("#daughter_name_select_text5").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    daughter_name_choice: daughter_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#daughter_name_select5").html(data);

                    $('.daughter5').select2();



                }

            });

        });

    });

</script>



<script>

    $(document).ready(function () {

        $("#son_name_choice").on('change', function () {

            var son_name_choice = $(this).val();

            $("#son_name_select_text").css("display", "none");

            $("#son_name_select_text").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    son_name_choice: son_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#son_name_select").html(data);

                    $('.son').select2();



                }

            });

        });

        $("#son_name_choice2").on('change', function () {

            var son_name_choice = $(this).val();

            $("#son_name_select_text2").css("display", "none");

            $("#son_name_select_text2").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    son_name_choice: son_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#son_name_select2").html(data);

                    $('.son2').select2();



                }

            });

        });

        $("#son_name_choice3").on('change', function () {

            var son_name_choice = $(this).val();

            $("#son_name_select_text3").css("display", "none");

            $("#son_name_select_text3").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    son_name_choice: son_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#son_name_select3").html(data);

                    $('.son3').select2();



                }

            });

        });



        $("#son_name_choice4").on('change', function () {

            var son_name_choice = $(this).val();

            $("#son_name_select_text4").css("display", "none");

            $("#son_name_select_text4").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    son_name_choice: son_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#son_name_select4").html(data);

                    $('.son4').select2();



                }

            });

        });



        $("#son_name_choice5").on('change', function () {

            var son_name_choice = $(this).val();

            $("#son_name_select_text5").css("display", "none");

            $("#son_name_select_text5").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    son_name_choice: son_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#son_name_select5").html(data);

                    $('.son5').select2();



                }

            });

        });

    });

</script>



<script>

    $(document).ready(function () {

        $("#brother_name_choice").on('change', function () {

            var brother_name_choice = $(this).val();

            $("#brother_name_select_text").css("display", "none");

            $("#brother_name_select_text").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    brother_name_choice: brother_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#brother_name_select").html(data);

                    $('.brother').select2();



                }

            });

        });

        $("#brother_name_choice2").on('change', function () {

            var brother_name_choice = $(this).val();

            $("#brother_name_select_text2").css("display", "none");

            $("#brother_name_select_text2").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    brother_name_choice: brother_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#brother_name_select2").html(data);

                    $('.brother2').select2();



                }

            });

        });

        $("#brother_name_choice3").on('change', function () {

            var brother_name_choice = $(this).val();

            $("#brother_name_select_text3").css("display", "none");

            $("#brother_name_select_text3").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    brother_name_choice: brother_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#brother_name_select3").html(data);

                    $('.brother3').select2();



                }

            });

        });



        $("#brother_name_choice4").on('change', function () {

            var brother_name_choice = $(this).val();

            $("#brother_name_select_text4").css("display", "none");

            $("#brother_name_select_text4").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    brother_name_choice: brother_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#brother_name_select4").html(data);

                    $('.brother4').select2();



                }

            });

        });



        $("#brother_name_choice5").on('change', function () {

            var brother_name_choice = $(this).val();

            $("#brother_name_select_text5").css("display", "none");

            $("#brother_name_select_text5").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    brother_name_choice: brother_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#brother_name_select5").html(data);

                    $('.brother5').select2();



                }

            });

        });

    });

</script>

<script>

    $(document).ready(function () {

        $("#sister_name_choice").on('change', function () {

            var sister_name_choice = $(this).val();

            $("#sister_name_select_text").css("display", "none");

            $("#sister_name_select_text").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    sister_name_choice: sister_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#sister_name_select").html(data);

                    $('.sister').select2();



                }

            });

        });

        $("#sister_name_choice2").on('change', function () {

            var sister_name_choice = $(this).val();

            $("#sister_name_select_text2").css("display", "none");

            $("#sister_name_select_text2").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    sister_name_choice: sister_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#sister_name_select2").html(data);

                    $('.sister2').select2();



                }

            });

        });

        $("#sister_name_choice3").on('change', function () {

            var sister_name_choice = $(this).val();

            $("#sister_name_select_text3").css("display", "none");

            $("#sister_name_select_text3").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    sister_name_choice: sister_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#sister_name_select3").html(data);

                    $('.sister3').select2();



                }

            });

        });



        $("#sister_name_choice4").on('change', function () {

            var sister_name_choice = $(this).val();

            $("#sister_name_select_text4").css("display", "none");

            $("#sister_name_select_text4").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    sister_name_choice: sister_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#sister_name_select4").html(data);

                    $('.sister4').select2();



                }

            });

        });



        $("#sister_name_choice5").on('change', function () {

            var sister_name_choice = $(this).val();

            $("#sister_name_select_text5").css("display", "none");

            $("#sister_name_select_text5").removeAttr("name");

            $.ajax({

                method: "POST",

                url: "ajax_data_bind.php",

                data: {

                    sister_name_choice: sister_name_choice

                },

                datatype: "html",

                success: function (data) {

                    $("#sister_name_select5").html(data);

                    $('.sister5').select2();



                }

            });

        });

    });

</script>

<script>

    $(document).ready(function () {

        $('.social_media_name').select2();

    });

</script>



<script>

    $(document).ready(function () {

        var maxField2 = 15; //Input fields increment limitation

        var addButton2 = $('.add_button2'); //Add button selector

        var wrapper2 = $('.field_wrapper2'); //Input field wrapper

        var fieldHTML2 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>' +



            '<div class="form-group">' +

            '<label for="social_media_name">Select Social Media Name:</label>' +

            '<select class="form-control social_media_name" id="social_media_name" name="social_media_name[]">' +

            '<option>-Select Social Media Name-</option>' +

            <? $social_media_name = mysqli_query($con, "select * from social_media_name order by name");

            while ($choice_exe = mysqli_fetch_array($social_media_name)) { ?>



                '<option value="<? echo $choice_exe['id']; ?>"><? echo $choice_exe['name']; ?></option>' +

            <? } ?>

            '</select>' +



            '</div>' +

            '<div class="form-group">' +

            '<label for="link">Social Media Link:</label>' +

            '<input type="text" class="form-control" id="link" name="link[]" >' +

            '</div>' +



            '</div>'; //New input field html 

        var x = 1; //Initial field counter is 1



        // Once add button is clicked

        $(addButton2).click(function () {

            //Check maximum number of input fields

            if (x < maxField2) {

                x++; //Increase field counter

                $(wrapper2).append(fieldHTML2); //Add field html

                $('.main_language').select2();

                $('.flexdatalist1').flexdatalist({

                    minLength: 1

                });



            } else {

                alert('A maximum of ' + maxField2 + ' fields are allowed to be added. ');

            }

        });



        // Once remove button is clicked

        $(wrapper2).on('click', '.remove_button', function (e) {

            e.preventDefault();

            $(this).parent('div').remove(); //Remove field html

            x--; //Decrease field counter

        });

    });

</script>

<script>

    function updateTextbox() {

        // Get all radio button groups

        const groups = document.querySelectorAll('.radio-group');

        const values = [];



        // Loop through each group and find the selected radio button

        groups.forEach(group => {

            const selected = group.querySelector('input[type="radio"]:checked');

            if (selected) {

                values.push(selected.value);

            }

        });



        // Update the textbox with the selected values joined by commas

        document.getElementById('textbox_spouse_partner').value = values.join(',');

    }

</script>

<script>

    function updateTextbox_son() {

        // Get all radio button groups

        const groups = document.querySelectorAll('.radio-group-son');

        const values = [];



        // Loop through each group and find the selected radio button

        groups.forEach(group => {

            const selected = group.querySelector('input[type="radio"]:checked');

            if (selected) {

                values.push(selected.value);

            }

        });



        // Update the textbox with the selected values joined by commas

        document.getElementById('textbox_son').value = values.join(',');

    }

</script>



<script>

    function updateTextbox_daughter() {

        // Get all radio button groups

        const groups = document.querySelectorAll('.radio-group-daughter');

        const values = [];



        // Loop through each group and find the selected radio button

        groups.forEach(group => {

            const selected = group.querySelector('input[type="radio"]:checked');

            if (selected) {

                values.push(selected.value);

            }

        });



        // Update the textbox with the selected values joined by commas

        document.getElementById('textbox_daughter').value = values.join(',');

    }

</script>

<script>

    function updateTextbox_brother() {

        // Get all radio button groups

        const groups = document.querySelectorAll('.radio-group-brother');

        const values = [];



        // Loop through each group and find the selected radio button

        groups.forEach(group => {

            const selected = group.querySelector('input[type="radio"]:checked');

            if (selected) {

                values.push(selected.value);

            }

        });



        // Update the textbox with the selected values joined by commas

        document.getElementById('textbox_brother').value = values.join(',');

    }

</script>

<script>

    function updateTextbox_sister() {

        // Get all radio button groups

        const groups = document.querySelectorAll('.radio-group-sister');

        const values = [];



        // Loop through each group and find the selected radio button

        groups.forEach(group => {

            const selected = group.querySelector('input[type="radio"]:checked');

            if (selected) {

                values.push(selected.value);

            }

        });



        // Update the textbox with the selected values joined by commas

        document.getElementById('textbox_sister').value = values.join(',');

    }

</script>
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
    url: "search_all_cast_crew.php",
    data: dataString,
    cache: false,
    success: function(html)
    {
    $("#result").html(html).show();
    }
    });
}else
{
     $("#result").html('').hide(); // Clear and hide results

}
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
