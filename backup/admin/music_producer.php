<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_GET['Action']=="ShowHome"){
    $id= $_GET['id'] ;  
    $show_on_home= $_GET['show_on_home'] ;
$sql=mysqli_query($con, "update music_producer set show_on_home='$show_on_home' where id='$id'")or die(mysqli_error($con));
header('location:music_producer.php?msg=success');
}

if($_POST["Submit"]) { 
    $name=mysqli_real_escape_string($con,$_POST['name']) ; 
    $real_name= mysqli_real_escape_string($con,$_POST['real_name']) ; 

    $nickname= mysqli_real_escape_string($con,$_POST['nickname']) ;  
    $dob= mysqli_real_escape_string($con,$_POST['dob']) ;  
    $dod= mysqli_real_escape_string($con,$_POST['dod']) ;   
    $details= mysqli_real_escape_string($con,$_POST['details']) ;
$nationality= mysqli_real_escape_string($con,$_POST['nationality']) ;
    $born_country= mysqli_real_escape_string($con,$_POST['born_country']) ;
    $born_city= mysqli_real_escape_string($con,$_POST['born_city']) ;
    $father= mysqli_real_escape_string($con,$_POST['father']) ;
    $mother= mysqli_real_escape_string($con,$_POST['mother']) ;
    $spouse= mysqli_real_escape_string($con,$_POST['spouse']) ;
    $son= mysqli_real_escape_string($con,$_POST['son']) ;
    $daughter= mysqli_real_escape_string($con,$_POST['daughter']) ; 
    $facebook= mysqli_real_escape_string($con,$_POST['facebook']) ; 
    $twitter= mysqli_real_escape_string($con,$_POST['twitter']) ; 
    $instagram= mysqli_real_escape_string($con,$_POST['instagram']) ; 


    $img=$_FILES['filstor']['name'];
    $tmpName=$_FILES['filstor']['tmp_name']; 
    if($img<>"")
         {
            $ext = strrchr($img, ".");
            $prefix=str_replace(" ","-",$name);
            $newName = $prefix ."-". substr(md5(rand() * time()), 0, 5) . $ext;
            move_uploaded_file($tmpName,"photo/".$newName);
         } 


 
mysqli_query($con,"INSERT INTO `music_producer` ( `name`,`real_name`,`nickname`,`nationality`,`born_country`,`born_city`,`father`,`mother`,`spouse`,`son`,`daughter`,`facebook`,`twitter`,`instagram`,`dob`,`dod`, `photo`, `details`) VALUES (  '$name','$real_name','$nickname', '$nationality','$born_country','$born_city','$father','$mother','$spouse','$son','$daughter','$facebook','$twitter','$instagram', '$dob','$dod', '$newName', '$details')") or die(mysqli_error($con));
  
            header('location:music_producer.php?msg=success');
         }



           if($_POST["Update"]) {




    $id= $_POST['id'];
       $name=mysqli_real_escape_string($con,$_POST['name']);
        $real_name=mysqli_real_escape_string($con,$_POST['real_name']); 
 $table= mysqli_real_escape_string($con,implode(",",$_POST['table'])) ;
    $nickname= mysqli_real_escape_string($con,$_POST['nickname']) ; 
    $dob= mysqli_real_escape_string($con,$_POST['dob']) ;  
    $birth_date= mysqli_real_escape_string($con,$_POST['birth_date']) ;  
    $birth_month= mysqli_real_escape_string($con,$_POST['birth_month']) ;  
    $birth_year= mysqli_real_escape_string($con,$_POST['birth_year']) ;  

    $dod= mysqli_real_escape_string($con,$_POST['dod']) ; 
    $death_date= mysqli_real_escape_string($con,$_POST['death_date']) ; 
    $death_month= mysqli_real_escape_string($con,$_POST['death_month']) ; 
    $death_year= mysqli_real_escape_string($con,$_POST['death_year']) ; 

    $gender= mysqli_real_escape_string($con,$_POST['gender']) ;  
    $show_on_home= mysqli_real_escape_string($con,$_POST['show_on_home']) ;  
    $nationality= mysqli_real_escape_string($con,implode(",",$_POST['nationality'])) ;
    $born_country= mysqli_real_escape_string($con,$_POST['born_country']) ;
	 $born_state= mysqli_real_escape_string($con,$_POST['born_state']) ;
    $born_city= mysqli_real_escape_string($con,$_POST['born_city']) ;
	$father=mysqli_real_escape_string($con,implode(",",$_POST['father']));
	$mother=mysqli_real_escape_string($con,implode(",",$_POST['mother']));
	$spouse=mysqli_real_escape_string($con,implode(",",$_POST['spouse']));
	$son=mysqli_real_escape_string($con,implode(",",$_POST['son']));
	$daughter=mysqli_real_escape_string($con,implode(",",$_POST['daughter']));
    $facebook= mysqli_real_escape_string($con,$_POST['facebook']) ; 
    $twitter= mysqli_real_escape_string($con,$_POST['twitter']) ; 
    $instagram= mysqli_real_escape_string($con,$_POST['instagram']) ; 
    $details= mysqli_real_escape_string($con,$_POST['details']) ;  
$real_step_father=mysqli_real_escape_string($con,implode(",",$_POST['real_step_father']));
$fatherDOB_date=mysqli_real_escape_string($con,implode(",",$_POST['fatherDOB_date']));
$fatherDOB_month=mysqli_real_escape_string($con,implode(",",$_POST['fatherDOB_month']));
$fatherDOB_year=mysqli_real_escape_string($con,implode(",",$_POST['fatherDOB_year']));
$fatherDOD_date=mysqli_real_escape_string($con,implode(",",$_POST['fatherDOD_date']));
$fatherDOD_month=mysqli_real_escape_string($con,implode(",",$_POST['fatherDOD_month']));
$fatherDOD_year=mysqli_real_escape_string($con,implode(",",$_POST['fatherDOD_year']));
$real_step_mother=mysqli_real_escape_string($con,implode(",",$_POST['real_step_mother']));
$motherDOB_date=mysqli_real_escape_string($con,implode(",",$_POST['motherDOB_date']));
$motherDOB_month=mysqli_real_escape_string($con,implode(",",$_POST['motherDOB_month']));
$motherDOB_year=mysqli_real_escape_string($con,implode(",",$_POST['motherDOB_year']));
$motherDOD_date=mysqli_real_escape_string($con,implode(",",$_POST['motherDOD_date']));
$motherDOD_month=mysqli_real_escape_string($con,implode(",",$_POST['motherDOD_month']));
$motherDOD_year=mysqli_real_escape_string($con,implode(",",$_POST['motherDOD_year']));
$marriage_date=mysqli_real_escape_string($con,implode(",",$_POST['marriage_date']));
$marriage_month=mysqli_real_escape_string($con,implode(",",$_POST['marriage_month']));
$marriage_year=mysqli_real_escape_string($con,implode(",",$_POST['marriage_year']));
$separation_date=mysqli_real_escape_string($con,implode(",",$_POST['separation_date']));
$separation_month=mysqli_real_escape_string($con,implode(",",$_POST['separation_month']));
$separation_year=mysqli_real_escape_string($con,implode(",",$_POST['separation_year']));
$divorce_date=mysqli_real_escape_string($con,implode(",",$_POST['divorce_date']));
$divorce_month=mysqli_real_escape_string($con,implode(",",$_POST['divorce_month']));
$divorce_year=mysqli_real_escape_string($con,implode(",",$_POST['divorce_year']));
$spouseDOD_date=mysqli_real_escape_string($con,implode(",",$_POST['spouseDOD_date']));
$spouseDOD_month=mysqli_real_escape_string($con,implode(",",$_POST['spouseDOD_month']));
$spouseDOD_year=mysqli_real_escape_string($con,implode(",",$_POST['spouseDOD_year']));
$total_son=mysqli_real_escape_string($con,implode(",",$_POST['total_son']));
$sonDOB_date=mysqli_real_escape_string($con,implode(",",$_POST['sonDOB_date']));
$sonDOB_month=mysqli_real_escape_string($con,implode(",",$_POST['sonDOB_month']));
$sonDOB_year=mysqli_real_escape_string($con,implode(",",$_POST['sonDOB_year']));
$sonDOD_date=mysqli_real_escape_string($con,implode(",",$_POST['sonDOD_date']));
$sonDOD_month=mysqli_real_escape_string($con,implode(",",$_POST['sonDOD_month']));
$sonDOD_year=mysqli_real_escape_string($con,implode(",",$_POST['sonDOD_year']));
$total_Daughter=mysqli_real_escape_string($con,implode(",",$_POST['total_Daughter']));
$daughterDOB_date=mysqli_real_escape_string($con,implode(",",$_POST['daughterDOB_date']));
$daughterDOB_month=mysqli_real_escape_string($con,implode(",",$_POST['daughterDOB_month']));
$daughterDOB_year=mysqli_real_escape_string($con,implode(",",$_POST['daughterDOB_year']));
$daughterDOD_date=mysqli_real_escape_string($con,implode(",",$_POST['daughterDOD_date']));
$daughterDOD_month=mysqli_real_escape_string($con,implode(",",$_POST['daughterDOD_month']));
$daughterDOD_year=mysqli_real_escape_string($con,implode(",",$_POST['daughterDOD_year']));
$son_relation=mysqli_real_escape_string($con,implode(",",$_POST['son_relation']));
$daughter_relation=mysqli_real_escape_string($con,implode(",",$_POST['daughter_relation']));
$relative=mysqli_real_escape_string($con,implode(",",$_POST['relative']));
$other_profession=mysqli_real_escape_string($con,implode(",",$_POST['table']));

$total_children=mysqli_real_escape_string($con,implode(",",$_POST['total_children']));
$movie_language=mysqli_real_escape_string($con,implode(",",$_POST['movie_language']));
$spouse_total_children=mysqli_real_escape_string($con,implode(",",$_POST['spouse_total_children']));

$brother=mysqli_real_escape_string($con,implode(",",$_POST['brother']));
$brother_relation=mysqli_real_escape_string($con,implode(",",$_POST['brother_relation']));
$brotherDOB_date=mysqli_real_escape_string($con,implode(",",$_POST['brotherDOB_date']));
$brotherDOB_month=mysqli_real_escape_string($con,implode(",",$_POST['brotherDOB_month']));
$brotherDOB_year=mysqli_real_escape_string($con,implode(",",$_POST['brotherDOB_year']));
$brotherDOD_date=mysqli_real_escape_string($con,implode(",",$_POST['brotherDOD_date']));
$brotherDOD_month=mysqli_real_escape_string($con,implode(",",$_POST['brotherDOD_month']));
$brotherDOD_year=mysqli_real_escape_string($con,implode(",",$_POST['brotherDOD_year']));
$sister=mysqli_real_escape_string($con,implode(",",$_POST['sister']));
$sister_relation=mysqli_real_escape_string($con,implode(",",$_POST['sister_relation']));
$sisterDOB_date=mysqli_real_escape_string($con,implode(",",$_POST['sisterDOB_date']));
$sisterDOB_month=mysqli_real_escape_string($con,implode(",",$_POST['sisterDOB_month']));
$sisterDOB_year=mysqli_real_escape_string($con,implode(",",$_POST['sisterDOB_year']));
$sisterDOD_date=mysqli_real_escape_string($con,implode(",",$_POST['sisterDOD_date']));
$sisterDOD_month=mysqli_real_escape_string($con,implode(",",$_POST['sisterDOD_month']));
$sisterDOD_year=mysqli_real_escape_string($con,implode(",",$_POST['sisterDOD_year']));

$Spouse_Partner=mysqli_real_escape_string($con,implode(",",$_POST['Spouse_Partner']));
$son_mother_father=mysqli_real_escape_string($con,implode(",",$_POST['son_mother_father']));
$daughter_mother_father=mysqli_real_escape_string($con,implode(",",$_POST['daughter_mother_father']));
$brother_mother_father=mysqli_real_escape_string($con,implode(",",$_POST['brother_mother_father']));
$sister_mother_father=mysqli_real_escape_string($con,implode(",",$_POST['sister_mother_father']));
$img=$_FILES['filstor']['name'];
$tmpName=$_FILES['filstor']['tmp_name'];
$oldimg=$_POST['oldimg'];

 if($img<>"")
   {
      $ext = strrchr($img, ".");
            $prefix=str_replace(" ","-",$name);
            $newName = $prefix ."-". substr(md5(rand() * time()), 0, 5) . $ext;
            move_uploaded_file($tmpName,"photo/".$newName);


   @unlink("photo/".$oldimg); 
   move_uploaded_file($tmpName,"photo/".$newName);

 }

else
{
$newName=$oldimg;
}

if(!empty($table)){
$make_array=explode(",",$table);
  $count_number_of_table=count($make_array);
 for($j=1;$j<=$count_number_of_table;$j++){
$table_id=$make_array[$j-1];
$table_name_find="select * from profession where id='$table_id'";
$table_name_find_exe=mysqli_query($con,$table_name_find);
$read_find_table_name=mysqli_fetch_array($table_name_find_exe);
$table_name=$read_find_table_name["table_name"];
$check_data="select * from $table_name where name='$name' and birth_date='$birth_date' and birth_month='$birth_month' and birth_year='$birth_year'";
$exe_crew_check=mysqli_query($con,$check_data);
$find_crew=mysqli_num_rows($exe_crew_check);

if($find_crew>=1)
{
echo "<script>alert('Crew With Name $name is already Exist as $table_name')</script>";
}
else
{
$insert_query="INSERT INTO $table_name set Spouse_Partner='$Spouse_Partner',son_mother_father='$son_mother_father',daughter_mother_father='$daughter_mother_father',brother_mother_father='$brother_mother_father',sister_mother_father='$sister_mother_father',brother='$brother',brother_relation='$brother_relation',brotherDOB_date='$brotherDOB_date',brotherDOB_month='$brotherDOB_month',brotherDOB_year='$brotherDOB_year',brotherDOD_date='$brotherDOD_date',brotherDOD_month='$brotherDOD_month',brotherDOD_year='$brotherDOD_year',sister='$sister',sister_relation='$sister_relation',sisterDOB_date='$sisterDOB_date',sisterDOB_month='$sisterDOB_month',sisterDOB_year='$sisterDOB_year',sisterDOD_date='$sisterDOD_date',sisterDOD_month='$sisterDOD_month',sisterDOD_year='$sisterDOD_year',name='$name',total_children='$total_children',movie_language='$movie_language',spouse_total_children='$spouse_total_children',real_name='$real_name',nickname='$nickname',nationality='$nationality',born_country='$born_country',born_city='$born_city',father='$father',mother='$mother',spouse='$spouse',son='$son',daughter='$daughter',facebook='$facebook',twitter='$twitter',instagram='$instagram',birth_date='$birth_date',birth_month='$birth_month',birth_year='$birth_year',death_date='$death_date',death_month='$death_month',death_year='$death_year',gender='$gender',show_on_home='$show_on_home',photo='$photo',details='$details',real_step_father='$real_step_father',fatherDOB_date='$fatherDOB_date',fatherDOB_month='$fatherDOB_month',fatherDOB_year='$fatherDOB_year',fatherDOD_date='$fatherDOD_date',fatherDOD_month='$fatherDOD_month',fatherDOD_year='$fatherDOD_year',real_step_mother='$real_step_mother',motherDOB_date='$motherDOB_date',motherDOB_month='$motherDOB_month',motherDOB_year='$motherDOB_year',motherDOD_date='$motherDOD_date',motherDOD_month='$motherDOD_month', motherDOD_year='$motherDOD_year', marriage_date='$marriage_date', marriage_month='$marriage_month', marriage_year='$marriage_year', separation_date='$separation_date',separation_month='$separation_month',separation_year='$separation_year',divorce_date='$divorce_date',divorce_month='$divorce_month',divorce_year='$divorce_year', spouseDOD_date='$spouseDOD_date',spouseDOD_month='$spouseDOD_month',spouseDOD_year='$spouseDOD_year',total_son='$total_son',total_Daughter='$total_Daughter',sonDOB_date='$sonDOB_date', sonDOB_month='$sonDOB_month', sonDOB_year='$sonDOB_year', sonDOD_date='$sonDOD_date',sonDOD_month='$sonDOD_month',sonDOD_year='$sonDOD_year',daughterDOB_date='$daughterDOB_date',daughterDOB_month='$daughterDOB_month',daughterDOB_year='$daughterDOB_year',daughterDOD_date='$daughterDOD_date',daughterDOD_month='$daughterDOD_month', daughterDOD_year='$daughterDOD_year', born_state='$born_state',daughter_relation='$daughter_relation',son_relation='$son_relation',relative='$relative',other_profession='$other_profession'";
mysqli_query($con,$insert_query);
  
 // mysqli_query($con,"INSERT INTO cast set Spouse_Partner='$Spouse_Partner',son_mother_father='$son_mother_father',daughter_mother_father='$daughter_mother_father',brother_mother_father='$brother_mother_father',sister_mother_father='$sister_mother_father',brother='$brother',brother_relation='$brother_relation',brotherDOB_date='$brotherDOB_date',brotherDOB_month='$brotherDOB_month',brotherDOB_year='$brotherDOB_year',brotherDOD_date='$brotherDOD_date',brotherDOD_month='$brotherDOD_month',brotherDOD_year='$brotherDOD_year',sister='$sister',sister_relation='$sister_relation',sisterDOB_date='$sisterDOB_date',sisterDOB_month='$sisterDOB_month',sisterDOB_year='$sisterDOB_year',sisterDOD_date='$sisterDOD_date',sisterDOD_month='$sisterDOD_month',sisterDOD_year='$sisterDOD_year',name='$name',total_children='$total_children',movie_language='$movie_language',spouse_total_children='$spouse_total_children',real_name='$real_name',nickname='$nickname',nationality='$nationality',born_country='$born_country',born_city='$born_city',father='$father',mother='$mother',spouse='$spouse',son='$son',daughter='$daughter',facebook='$facebook',twitter='$twitter',instagram='$instagram',birth_date='$birth_date',birth_month='$birth_month',birth_year='$birth_year',death_date='$death_date',death_month='$death_month',death_year='$death_year',gender='$gender',show_on_home='$show_on_home',photo='$photo',details='$details',real_step_father='$real_step_father',fatherDOB_date='$fatherDOB_date',fatherDOB_month='$fatherDOB_month',fatherDOB_year='$fatherDOB_year',fatherDOD_date='$fatherDOD_date',fatherDOD_month='$fatherDOD_month',fatherDOD_year='$fatherDOD_year',real_step_mother='$real_step_mother',motherDOB_date='$motherDOB_date',motherDOB_month='$motherDOB_month',motherDOB_year='$motherDOB_year',motherDOD_date='$motherDOD_date',motherDOD_month='$motherDOD_month', motherDOD_year='$motherDOD_year', marriage_date='$marriage_date', marriage_month='$marriage_month', marriage_year='$marriage_year', separation_date='$separation_date',separation_month='$separation_month',separation_year='$separation_year',divorce_date='$divorce_date',divorce_month='$divorce_month',divorce_year='$divorce_year', spouseDOD_date='$spouseDOD_date',spouseDOD_month='$spouseDOD_month',spouseDOD_year='$spouseDOD_year',total_son='$total_son',total_Daughter='$total_Daughter',sonDOB_date='$sonDOB_date', sonDOB_month='$sonDOB_month', sonDOB_year='$sonDOB_year', sonDOD_date='$sonDOD_date',sonDOD_month='$sonDOD_month',sonDOD_year='$sonDOD_year',daughterDOB_date='$daughterDOB_date',daughterDOB_month='$daughterDOB_month',daughterDOB_year='$daughterDOB_year',daughterDOD_date='$daughterDOD_date',daughterDOD_month='$daughterDOD_month', daughterDOD_year='$daughterDOD_year', born_state='$born_state',daughter_relation='$daughter_relation',son_relation='$son_relation',relative='$relative',other_profession='$other_profession'");
  
            
         }
// header('location:crew_details.php?msg=success');



}
echo "<script>alert('Add Crew Successful')</script>";
}

            mysqli_query($con,"update music_producer set  Spouse_Partner='$Spouse_Partner',son_mother_father='$son_mother_father',daughter_mother_father='$daughter_mother_father',brother_mother_father='$brother_mother_father',sister_mother_father='$sister_mother_father',brother='$brother',brother_relation='$brother_relation',brotherDOB_date='$brotherDOB_date',brotherDOB_month='$brotherDOB_month',brotherDOB_year='$brotherDOB_year',brotherDOD_date='$brotherDOD_date',brotherDOD_month='$brotherDOD_month',brotherDOD_year='$brotherDOD_year',sister='$sister',sister_relation='$sister_relation',sisterDOB_date='$sisterDOB_date',sisterDOB_month='$sisterDOB_month',sisterDOB_year='$sisterDOB_year',sisterDOD_date='$sisterDOD_date',sisterDOD_month='$sisterDOD_month',sisterDOD_year='$sisterDOD_year',total_children='$total_children',movie_language='$movie_language',spouse_total_children='$spouse_total_children',other_profession='$other_profession',spouseDOD_month='$spouseDOD_month',spouseDOD_year='$spouseDOD_year',born_state='$born_state',daughter_relation='$daughter_relation',son_relation='$son_relation',relative='$relative',daughterDOD_date='$daughterDOD_date',daughterDOD_month='$daughterDOD_month',daughterDOD_year='$daughterDOD_year',daughterDOB_date='$daughterDOB_date',daughterDOB_month='$daughterDOB_month',daughterDOB_year='$daughterDOB_year',sonDOD_date='$sonDOD_date',sonDOD_month='$sonDOD_month',sonDOD_year='$sonDOD_year',sonDOB_date='$sonDOB_date',sonDOB_month='$sonDOB_month',sonDOB_year='$sonDOB_year',total_son='$total_son',total_Daughter='$total_Daughter',divorce_date='$divorce_date',divorce_month='$divorce_month',divorce_year='$divorce_year',separation_date='$separation_date',separation_month='$separation_month',separation_year='$separation_year',marriage_date='$marriage_date',marriage_month='$marriage_month',marriage_year='$marriage_year',motherDOB_date='$motherDOB_date',motherDOB_month='$motherDOB_month',motherDOB_year='$motherDOB_year',motherDOD_date='$motherDOD_date',motherDOD_month='$motherDOD_month',motherDOD_year='$motherDOD_year',fatherDOB_date='$fatherDOB_date',fatherDOB_month='$fatherDOB_month',fatherDOB_year='$fatherDOB_year',fatherDOD_date='$fatherDOD_date',fatherDOD_month='$fatherDOD_month',fatherDOD_year='$fatherDOD_year',real_step_mother='$real_step_mother',real_step_father='$real_step_father',name='$name',real_name='$real_name',  nickname='$nickname',nationality='$nationality',born_country='$born_country',born_city='$born_city',father='$father',mother='$mother',spouse='$spouse',son='$son',daughter='$daughter',facebook='$facebook',twitter='$twitter',instagram='$instagram',  birth_date='$birth_date',birth_month='$birth_month',birth_year='$birth_year', death_date='$death_date',death_month='$death_month',death_year='$death_year',gender='$gender',show_on_home='$show_on_home',photo='$newName',details='$details'   where id='$id'") or die(mysqli_error($con));
                 //header('location:music_producer.php?msg=success');
                 echo "<script>alert('Update Successful')</script>";
         }
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con, "delete from music_producer where id='$_REQUEST[id]'");
echo "<script>alert('Delete Update Successful')</script>";
//header("location:music_producer.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Music Producer </title>
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


<link href="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
<style>
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
                  <h1>Music Producer</h1>
                  <small>Music Producer List</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">








<? if($_GET['Action']=="Add"){ ?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Add Music Producer</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <div class="form-group">
                                 <label>name</label>
                                 <input type="text" class="form-control" name="name" placeholder="Enter name"  >
                              </div>
                              <div class="form-group">
                                 <label>real_name</label>
                                 <input type="text" class="form-control" name="real_name" placeholder="Enter real_name"  >
                              </div>
 <div class="form-group">
                                 <label>Nick name</label>
                                 <input type="text" class="form-control" name="nickname" placeholder="Enter Nick name"  >
                              </div>   




<div class="form-group">
                                 <label>Nationality</label>
                                 <input type="text" class="form-control" name="nationality" placeholder="Enter nationality"  >
                              </div>
<div class="form-group">
                                 <label>Born Country</label>
                                 <input type="text" class="form-control" name="born_country" placeholder="Enter Born Country"  >
                              </div>
<div class="form-group">
                                 <label>Born City</label>
                                 <input type="text" class="form-control" name="born_city" placeholder="Enter Born City"  >
                              </div>
<div class="form-group">
                                 <label>Father</label>
                                 <input type="text" class="form-control" name="father" placeholder="Enter Father"  >
                              </div>
<div class="form-group">
                                 <label>Mother</label>
                                 <input type="text" class="form-control" name="mother" placeholder="Enter Mother"  >
                              </div>
<div class="form-group">
                                 <label>Spouse</label>
                                 <input type="text" class="form-control" name="spouse" placeholder="Enter Spouse"  >
                              </div>
<div class="form-group">
                                 <label>Son</label>
                                 <input type="text" class="form-control" name="son" placeholder="Enter Son"  >
                              </div>
<div class="form-group">
                                 <label>Daughter</label>
                                 <input type="text" class="form-control" name="daughter" placeholder="Enter Daughter"  >
                              </div>
<div class="form-group">
                                 <label>Facebook</label>
                                 <input type="text" class="form-control" name="facebook" placeholder="Enter Facebook"  >
                              </div>
<div class="form-group">
                                 <label>Twitter</label>
                                 <input type="text" class="form-control" name="twitter" placeholder="Enter Twitter"  >
                              </div>
<div class="form-group">
                                 <label>Instagram</label>
                                 <input type="text" class="form-control" name="instagram" placeholder="Enter Instagram"  >
                              </div>



                               <div class="form-group">
                                 <label>DOB</label>
                                 <input type="text" class="form-control" name="dob" placeholder="Enter DOB"  >
                              </div> <div class="form-group">
                                 <label>DOD</label>
                                 <input type="text" class="form-control" name="dod" placeholder="Enter DOD"  >
                              </div>                            <div class="form-group">
                                 <label>Image</label>
                                   <input type="file"  name="filstor"  class="form-control">
                                  
                              </div>
                              

     <div class="form-group">
                                 <label>Details</label>
                                 <textarea name="details" rows="25"></textarea> 
                              </div>
                             
 
                           
                          
                              <div class="reset-button">

                                   <input type="submit" name="Submit"  class="btn btn-add"  value="Add Record">
                            
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>

<? } ?>











<? if($_GET['Action']=="Update"){  $id2=$_GET['id'];
$sql="select * from music_producer where id='$id2'";
$rs=mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs);
?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Update Music Producer</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
						   
						   
						    <div class="form-group">
						    <label>Select Crew Profession (e.g -Director/Producer/Music Director etc)</label>
							 <?  
							$other_profession1=explode(",",$row["other_profession"]);
							 
                                     $tmp_profession1 = '';
                                    foreach($other_profession1 as $other_profession_read1){
									 
									$other_profession1_data_query="select * from profession where id='$other_profession_read1'";
										 $other_profession_data_exe=mysqli_query($con,$other_profession1_data_query);
										 $other_profession_data_read=mysqli_fetch_array($other_profession_data_exe);
										 $other_profession_read_name=$other_profession_data_read["profession_name"];
											$other_profession_read_id=$other_profession_data_read["id"];			
										 $tmp_profession1 .=$other_profession_read_id. ','; 
										 }
										$tmp_profession1 = trim($tmp_profession1, ',');    // remove trailing comma
                                    			 ?>
  <input type='text'
       placeholder='Enter other Profession'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='selectedtable'
       data-value-property='value'
	   name='table[]'
	   value='<? echo $tmp_profession1?>'
       multiple
       >
	   <datalist id="selectedtable" >
	   <?
	   
	  foreach($other_profession1 as $other_profession_read1){
	 //$tmp_profession2 .=$other_profession_read2. ','; 
									  	$other_profession1_data_query="select * from profession where id='$other_profession_read1'";
										 $other_profession_data_exe=mysqli_query($con,$other_profession1_data_query);
										 $other_profession_data_read=mysqli_fetch_array($other_profession_data_exe);
										 $other_profession_read_name=$other_profession_data_read["profession_name"];
											$other_profession_read_id=$other_profession_data_read["id"];				

									  ?>
										
										  <option value="<? echo $other_profession_read_id ?>" selected><?  echo $other_profession_read_name;?></option>
										<? } ?>
										  
                                  <? $sqlfr=mysqli_query($con, "select * from profession order by profession_name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['profession_name']; ?></option>
                                  <? } ?>
                                  </datalist>
                              </div>


                              <div class="form-group">
                                 <label>name</label>
                                 <input type="text" name="name" class="form-control" placeholder="Update name" value="<? echo $row['name'];?>"   >
                              </div> 
                              <div class="form-group">
                                 <label>real_name</label>
                                 <input type="text" name="real_name" class="form-control" placeholder="Update real_name" value="<? echo $row['real_name'];?>"   >
                              </div> 
                              
<?   if($row['show_on_home']=="1"){ ?> 
                                        <a  class="btn btn-primary" href="music_producer.php?id=<? echo $row['id']; ?>&show_on_home=0&Action=ShowHome" style="color:#fff; font-weight: bold">Hide</a>
                                        <? } else{ ?>
                                        <a  class="btn btn-primary" href="music_producer.php?id=<? echo $row['id']; ?>&show_on_home=1&Action=ShowHome">Show</a>
                                        <? } ?>
 
                             <div class="form-group">
                                 <label>Nick name</label>
                                 <input type="text" name="nickname" class="form-control" placeholder="Update Nick name" value="<? echo $row['nickname'];?>"   >
                              </div>   


<div class="form-group">
                                 <label>Nationality</label>
								  <?  $nationality=explode(",",$row["nationality"]);
														$tmp = '';

                                     foreach($nationality as $nationality_read){
									 
										 $nationality_data_query="select * from country where country_name='$nationality_read'";
										 $nationality_data_exe=mysqli_query($con,$nationality_data_query);
										 $nationality_data_read=mysqli_fetch_array($nationality_data_exe);
										 $nationality_read_name=$nationality_data_read["country_name"];
										 $tmp .=$nationality_read_name. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
                                    <input type='text'
       placeholder='Enter Nationality Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='Nationality',
       data-value-property='value',
	   name='nationality[]',
	   value='<? echo $tmp?>',
      multiple
       >
	   <datalist id="Nationality" >
	   <?
	   
	   
	     foreach($nationality as $nationality_read){
									 
										 $nationality_data_query="select * from country where country_name='$nationality_read'";
										 $nationality_data_exe=mysqli_query($con,$nationality_data_query);
										 $nationality_data_read=mysqli_fetch_array($nationality_data_exe);
										 $nationality_read_name=$nationality_data_read["country_name"];
										
										 ?>
										  <option value="<?php echo $nationality_read_name ?>" selected><?php echo $nationality_read_name;?></option>
                                     <?php } ?>
                                    			
                                  <? $sqlfr=mysqli_query($con, "select * from country order by country_name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['country_name']; ?>"><? echo $rowfr['country_name']; ?></option>
                                  <? } ?>
                                  </datalist>

                              </div>
<div class="form-group">
                                 <label>Born Country</label>
								 
															  <?    
								  $born_country=$row["born_country"];
                                    			 ?>
  <input type='text'
       placeholder='Enter Born Country Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='borncountry',
       data-value-property='value',
	   value='<? echo $born_country?>',
	   name='born_country',
      
       >`
	   <datalist id="borncountry" >
	  
                                     <option value="<?php echo $born_country?>" selected><?php echo $born_country;?></option>
                                 
	   
                                  <? $sqlfr=mysqli_query($con, "select * from country1 order by country_name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['country_name']; ?>"><? echo $rowfr['country_name']; ?></option>
                                  <? } ?>
                                  </datalist>
                              </div>
							  
							  <div class="form-group">
                                 <label>Born State</label>
								 
												  <?  $born_state=explode(",",$row["born_state"]);
														$tmp = '';

                                     foreach($born_state as $born_state_read){
									 
										 $born_state_data_query="select * from state1 where state='$born_state_read'";
										 $born_state_data_exe=mysqli_query($con,$born_state_data_query);
										 $born_state_data_read=mysqli_fetch_array($born_state_data_exe);
										 $born_state_read_name=$born_state_data_read["state"];
										 $tmp .=$born_state_read_name. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
												 
												 
  <input type='text'
       placeholder='Enter Born state Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='bornstate',
       data-value-property='value',
	   name='born_state',
	    value='<? echo $tmp?>',
      multiple='multiple'
       >
	   <datalist id="bornstate" >
	   <?
	   
	   
	      foreach($born_state as $born_state_read){
									 
										 $born_state_data_query="select * from state1 where state='$born_state_read'";
										 $born_state_data_exe=mysqli_query($con,$born_state_data_query);
										 $born_state_data_read=mysqli_fetch_array($born_state_data_exe);
										 $born_state_read_name=$born_state_data_read["state"];
										
										 ?>
										  <option value="<?php echo $born_state_read_name ?>" selected><?php echo $born_state_read_name;?></option>
                                     <?php } ?>
	   
	   
	   
	    
                                  <? $sqlfr=mysqli_query($con, "select * from state1 order by state");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['state']; ?>"><? echo $rowfr['state']; ?></option>
                                  <? } ?>
								  
								  
                                  </datalist>
                              </div>
	<div class="form-group">
                                 <label>Born City</label>
								 
												 
												 <?  $born_city=explode(",",$row["born_city"]);
														$tmp = '';

                                     foreach($born_city as $born_city_read){
									 
										 $born_city_data_query="select * from city1 where city='$born_city_read'";
										 $born_city_data_exe=mysqli_query($con,$born_city_data_query);
										 $born_city_data_read=mysqli_fetch_array($born_city_data_exe);
										 $born_city_read_name=$born_city_data_read["city"];
										 $tmp .=$born_city_read_name. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
  <input type='text'
       placeholder='Enter Born city Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='borncity',
       data-value-property='value',
	   name='born_city',
	    value='<? echo $tmp?>',
        multiple='multiple'
       >
	   <datalist id="borncity" >
	   
	     <?
	   
	   
	       foreach($born_city as $born_city_read){
									 
										 $born_city_data_query="select * from city1 where city='$born_city_read'";
										 $born_city_data_exe=mysqli_query($con,$born_city_data_query);
										 $born_city_data_read=mysqli_fetch_array($born_city_data_exe);
										 $born_city_read_name=$born_city_data_read["city"];
										
										 ?>
										  <option value="<?php echo $born_city_read_name ?>" selected><?php echo $born_city_read_name;?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from city1 order by city");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['city']; ?>"><? echo $rowfr['city']; ?></option>
                                  <? } ?>
                                  </datalist>
                              </div>
							  
							  
							 
							  
							  

								   <div id="father" style="display: block;border: 1px solid black;padding: 14px;">
                          <label></label>
                                
                              
                                <a href="javascript:void(0);" class="add_button_father btn btn-success pull-right" title="Add More">Add More Father</a>
                                     <br/>
<?
$father=explode(",",$row["father"]);
$real_step_father=explode(",",$row["real_step_father"]);
$fatherDOB_date=explode(",",$row["fatherDOB_date"]);
$fatherDOB_month=explode(",",$row["fatherDOB_month"]);
$fatherDOB_year=explode(",",$row["fatherDOB_year"]);
$fatherDOD_date=explode(",",$row["fatherDOD_date"]);
$fatherDOD_month=explode(",",$row["fatherDOD_month"]);
$fatherDOD_year=explode(",",$row["fatherDOD_year"]);
$count_father=count($father);
for($i=0;$i<$count_father;$i++){

?>
<h2>Father <? echo $i+1;?> Details:</h2>
							  <div class="form-group">
                                 <label>Father Name</label>
                                 <input type="text" class="form-control" name="father[]" value="<? echo $father[$i];?>" placeholder="Enter Father"  >
								 
								 </div>
							   <div class="form-group  ">
							  <label>Father/Step Father</label>
							  
							  <select class="form-control" id="Sequel"  name="real_step_father[]" >
							  <option value="<? echo $real_step_father[$i];?>" selected><? echo $real_step_father[$i];?></option>
                                      <option value="Father">Father</option>
                                     <option value="Step Father"> Step Father</option>
                                   
                                </select>
                                 
   
                                 
                              </div> 
							  
							<div class="form-group">
							   
							   <h4><B>Date Of Birth</B></h4>
							  <label>Date</label>
                                 
   <input type="text" class="" name="fatherDOB_date[]" value="<? echo $fatherDOB_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="fatherDOB_month[]" value="<? echo $fatherDOB_month[$i];?>"   placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="fatherDOB_year[]" value="<? echo $fatherDOB_year[$i];?>"  placeholder="Year"  >
                                 
                              </div> 
							   <BR/>
							    <div class="form-group">
							   
							   <h4><B>Date Of Death</B></h4>
							  <label>Date</label>
                                 
   <input type="text" class="" name="fatherDOD_date[]" value="<? echo $fatherDOD_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="fatherDOD_month[]" value="<? echo $fatherDOD_month[$i];?>"  placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="fatherDOD_year[]" value="<? echo $fatherDOD_year[$i];?>"  placeholder="Year"  >
                                 
                              </div> 
							  <? } ?>
							  <div class="field_wrapper3_father">
							   
                              </div>
                                    </div>
									<br>
									
									<div id="isSequel" style="display: block;border: 1px solid black;padding: 14px;">
                          <label></label>
                                
                                
                                <a href="javascript:void(0);" class="add_button_mother btn btn-success pull-right" title="Add More">Add More Mother</a>
                                     <br/>
<?
$mother=explode(",",$row["mother"]);
$real_step_mother=explode(",",$row["real_step_mother"]);
$motherDOB_date=explode(",",$row["motherDOB_date"]);
$motherDOB_month=explode(",",$row["motherDOB_month"]);
$motherDOB_year=explode(",",$row["motherDOB_year"]);
$motherDOD_date=explode(",",$row["motherDOD_date"]);
$motherDOD_month=explode(",",$row["motherDOD_month"]);
$motherDOD_year=explode(",",$row["motherDOD_year"]);
$count_mother=count($mother);
for($i=0;$i<$count_mother;$i++){

?>
<h2>Mother <? echo $i+1;?> Details:</h2>
							  <div class="form-group">
                                 <label>Mother Name</label>
                                 <input type="text" class="form-control" name="mother[]" value="<? echo $mother[$i];?>"  placeholder="Enter Mother"  >
								 
								 </div>
							   <div class="form-group  ">
							  <label>Mother/Step Mother</label>
							  
							  <select class="form-control" id="Sequel" name="real_step_mother[]" >
							   <option value="<? echo $real_step_mother[$i];?>" selected><? echo $real_step_mother[$i];?></option>
                                      <option value="Mother">Mother</option>
                                     <option value="Step Mother"> Step Mother</option>
                                   
                                </select>
                                 
                                 
                              </div> 
							  
							 <div class="form-group">
							  <h4><B>Date Of Birth</B></h4>
							  <label>Date</label>
                                 
   <input type="text" class="" name="motherDOB_date[]" value="<? echo $motherDOB_date[$i];?>"   placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="motherDOB_month[]"  value="<? echo $motherDOB_month[$i];?>"  placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="motherDOB_year[]" value="<? echo $motherDOB_year[$i];?>"   placeholder="Year"  >
                                 
                              </div> 
							   <BR/>
							  <div class="form-group">
							  <h4><B>Date Of Death</B></h4>
							  <label>Date</label>
                                 
   <input type="text" class="" name="motherDOD_date[]"  value="<? echo $motherDOD_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="motherDOD_month[]" value="<? echo $motherDOD_month[$i];?>"   placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="motherDOD_year[]"  value="<? echo $motherDOD_year[$i];?>"  placeholder="Year"  >
                                 
                              </div> 
							  
							  <? } ?>
							   <div class="field_wrapper3_mother">
                              </div>
							  
                                    </div>
                              

                             

<br/>
							    <div id="isSequel" style="display: block;border: 1px solid black;padding: 14px;">
                          <label></label>
                                
                                
                                <a href="javascript:void(0);" class="add_button_spouse btn btn-success pull-right" title="Add More">Add More</a>
                                     <br/>
<?
$spouse=explode(",",$row["spouse"]);
$marriage_date=explode(",",$row["marriage_date"]);
$marriage_month=explode(",",$row["marriage_month"]);
$marriage_year=explode(",",$row["marriage_year"]);
$separation_date=explode(",",$row["separation_date"]);
$separation_month=explode(",",$row["separation_month"]);
$separation_year=explode(",",$row["separation_year"]);
$divorce_date=explode(",",$row["divorce_date"]);
$divorce_month=explode(",",$row["divorce_month"]);
$divorce_year=explode(",",$row["divorce_year"]);
$spouseDOD_date=explode(",",$row["spouseDOD_date"]);
$spouseDOD_year=explode(",",$row["spouseDOD_year"]);
$spouseDOD_month=explode(",",$row["spouseDOD_month"]);
$total_son=explode(",",$row["total_son"]);
$total_Daughter=explode(",",$row["total_Daughter"]);
$spouse_total_children=explode(",",$row["spouse_total_children"]);

$Spouse_Partner=explode(",",$row["Spouse_Partner"]);

$count_spouse=count($spouse);
for($i=0;$i<$count_spouse;$i++){

?>
		<h2>Spouse <? echo $i+1;?> Details:</h2>
<div class="form-group">
                                 <label>
<input type="radio" name="Spouse_Partner[]" value="Spouse" <?= ($Spouse_Partner[$i] == "Spouse")? 'checked' : '';?>>Spouse
<input type="radio" name="Spouse_Partner[]" value="Partner" <?= ($Spouse_Partner[$i] == "Partner")? 'checked' : '';?>>Partner<br>
</label>
                                 <input type="text" class="form-control" name="spouse[]" value="<? echo $spouse[$i];?>"   placeholder="Enter Spouse"  >
                              </div>
							  
 <div class="form-group  ">
  
							   <h4><B>Marriage Date</B></h4>
							    <label>Date</label>
                                 
   <input type="text" class="" name="marriage_date[]" value="<? echo $marriage_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="marriage_month[]" value="<? echo $marriage_month[$i];?>"  placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="marriage_year[]" value="<? echo $marriage_year[$i];?>"  placeholder="Year"  >
                                 
                              </div> 
							  
							    <BR/>
							  
							  <div class="form-group  ">
							  <h4><B>Separation Date</B></h4>
							 
							    <label>Date</label>
                                 
   <input type="text" class="" name="separation_date[]" value="<? echo $separation_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="separation_month[]"  value="<? echo $separation_month[$i];?>" placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="separation_year[]" value="<? echo $separation_year[$i];?>"  placeholder="Year"  >
                                 
								 
                              </div> 
							   <BR/>

							   <div class="form-group  ">
							  <h4><B>Divorce Date</B></h4>
							    <label>Date</label>
                                 
   <input type="text" class="" name="divorce_date[]" value="<? echo $divorce_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="divorce_month[]" value="<? echo $divorce_month[$i];?>"  placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="divorce_year[]" value="<? echo $divorce_year[$i];?>"  placeholder="Year"  >
                                 
                              </div> 
							   <BR/>
							    <div class="form-group  ">
							  <h4><B>Date Of Death</B></h4>
							
							    <label>Date</label>
                                 
   <input type="text" class="" name="spouseDOD_date[]" value="<? echo $spouseDOD_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="spouseDOD_month[]" value="<? echo $spouseDOD_month[$i];?>"  placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="spouseDOD_year[]" value="<? echo $spouseDOD_year[$i];?>"  placeholder="Year"  >
                                 
                              </div> 
							  
							  <h4> No. Of Children</h4>
							  <br/>
							  <div class="form-group  ">
							   <label>son</label>
                                 
   <input type="text" class="form-control" name="total_son[]"   value="<? echo $total_son[$i];?>"   placeholder="No of son"  >
							  
							</div>
							 <div class="form-group  ">
							   <label>Daughter</label>
                                 
   <input type="text" class="form-control" name="total_Daughter[]"   value="<? echo $total_Daughter[$i];?>"   placeholder="No of Daughter"  >
							  
							</div>
							
								<div class="form-group  ">
							   <label>Spouse/Partner Total No. Of Children</label>
                                 
   <input type="text" class="form-control" name="spouse_total_children[]"  value="<? echo $spouse_total_children[$i];?>" placeholder="No of total children"  >
							  
							</div>
							
							  <? } ?>
							   <div class="field_wrapper_spouse">
                              </div>
							  
							  
							  
                                    </div>
									<br>

							  
							  <div id="isSequel" style="display: block;border: 1px solid black;padding: 14px;">
                          <label></label>
                                
                                
                                <a href="javascript:void(0);" class="add_button_son btn btn-success pull-right" title="Add More">Add More</a>
                                     <br/>

<?
$son=explode(",",$row["son"]);
$sonDOB_date=explode(",",$row["sonDOB_date"]);
$sonDOB_month=explode(",",$row["sonDOB_month"]);
$sonDOB_year=explode(",",$row["sonDOB_year"]);
$sonDOD_date=explode(",",$row["sonDOD_date"]);
$sonDOD_month=explode(",",$row["sonDOD_month"]);
$sonDOD_year=explode(",",$row["sonDOD_year"]);
$son_relation=explode(",",$row["son_relation"]);
$son_mother_father=explode(",",$row["son_mother_father"]);



$count_son=count($son);
for($i=0;$i<$count_son;$i++){

?>
<h2>Son <? echo $i+1;?> Details:</h2>
<div class="form-group">
                                 <label>Son</label>
                                 <input type="text" class="form-control" name="son[]" value="<? echo $son[$i];?>" placeholder="Enter Son"  >
                              </div>
							  
 <div class="form-group">
							   <label>
<input type="radio" name="son_mother_father[]" value="Father" <?= ($son_mother_father[$i] == "Father")? 'checked' : '';?>>Father
<input type="radio" name="son_mother_father[]" value="Mother" <?= ($son_mother_father[$i] == "Mother")? 'checked' : '';?>>Mother<br>
</label>
                                 <input type="text" class="form-control" name="son_relation[]" value="<? echo $son_relation[$i];?>" placeholder="Enter Mother/Father Name"  >
                              </div>
							  

							  
							   <div class="form-group  ">
							 <h4><B>Date Of Birth</B></h4>
							    <label>Date</label>
                                 
   <input type="text" class="" name="sonDOB_date[]" value="<? echo $sonDOB_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="sonDOB_month[]" value="<? echo $sonDOB_month[$i];?>"  placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="sonDOB_year[]" value="<? echo $sonDOB_year[$i];?>"  placeholder="Year"  >
                                 
                              </div> 
							  
							   <BR/>
							   <div class="form-group  ">
							 <h4><B>Date Of Death</B></h4>
							    <label>Date</label>
                                 
   <input type="text" class="" name="sonDOD_date[]" value="<? echo $sonDOD_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="sonDOD_month[]"  value="<? echo $sonDOD_month[$i];?>" placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="sonDOD_year[]" value="<? echo $sonDOD_year[$i];?>"  placeholder="Year"  >
                                 
                              </div> 
							  
							    <? } ?>
					<div class="field_wrapper_son">
                              </div>
                                    </div>
									<br>
							  
							  
							  
							  
							  <div id="isSequel" style="display: block;border: 1px solid black;padding: 14px;">
                          <label></label>
                                
                                
                                <a href="javascript:void(0);" class="add_button_daughter btn btn-success pull-right" title="Add More">Add More</a>
                                     <br/>
<?
$daughter=explode(",",$row["daughter"]);
$daughterDOB_date=explode(",",$row["daughterDOB_date"]);
$daughterDOB_month=explode(",",$row["daughterDOB_month"]);
$daughterDOB_year=explode(",",$row["daughterDOB_year"]);
$daughterDOD_date=explode(",",$row["daughterDOD_date"]);
$daughterDOD_month=explode(",",$row["daughterDOD_month"]);
$daughterDOD_year=explode(",",$row["daughterDOD_year"]);
$daughter_relation=explode(",",$row["daughter_relation"]);
$daughter_mother_father=explode(",",$row["daughter_mother_father"]);


$count_daughter=count($daughter);
for($i=0;$i<$count_daughter;$i++){

?>
<h2>Daughter <? echo $i+1;?> Details:</h2>
<div class="form-group">

                                 <label>Daughter</label>
                                 <input type="text" class="form-control" name="daughter[]" value="<? echo $daughter[$i];?>" placeholder="Enter Daughter"  >
                              </div>
							  
							   <div class="form-group">
							  <label>
<input type="radio" name="daughter_mother_father[]" value="Father" <?= ($daughter_mother_father[$i] == "Father")? 'checked' : '';?>>Father
<input type="radio" name="daughter_mother_father[]" value="Mother" <?= ($daughter_mother_father[$i] == "Mother")? 'checked' : '';?>>Mother<br>
</label>
                                 <input type="text" class="form-control" name="daughter_relation[]" value="<? echo $daughter_relation[$i];?>" placeholder="Enter Mother/Father Name"  >
                              </div>
							  
  <div class="form-group  ">
							<h4><B>Date Of Birth</B></h4>
							    <label>Date</label>
                                 
   <input type="text" class="" name="daughterDOB_date[]" value="<? echo $daughterDOB_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="daughterDOB_month[]"  value="<? echo $daughterDOB_month[$i];?>" placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="daughterDOB_year[]" value="<? echo $daughterDOB_year[$i];?>"  placeholder="Year"  >
                                 
                              </div> 
							  
							  
							   <BR/>
							    <div class="form-group  ">
							<h4><B>Date Of Death</B></h4>
							    <label>Date</label>
                                 
   <input type="text" class="" name="daughterDOD_date[]" value="<? echo $daughterDOD_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="daughterDOD_month[]" value="<? echo $daughterDOD_month[$i];?>"  placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="daughterDOD_year[]" value="<? echo $daughterDOD_year[$i];?>"  placeholder="Year"  >
                                 
                              </div> 
							  
							    <? } ?>
							  <div class="field_wrapper_daughter">
					
                              </div>
                                    </div>
									<br> 
									 <div id="isSequel" style="display: block;border: 1px solid black;padding: 14px;">
                          <label></label>
                                
                                
                                <a href="javascript:void(0);" class="add_button_brother btn btn-success pull-right" title="Add More">Add More</a>
                                     <br/>
									 
									 <?
$brother=explode(",",$row["brother"]);
$brotherDOB_date=explode(",",$row["brotherDOB_date"]);
$brotherDOB_month=explode(",",$row["brotherDOB_month"]);
$brotherDOB_year=explode(",",$row["brotherDOB_year"]);
$brotherDOD_date=explode(",",$row["brotherDOD_date"]);
$brotherDOD_month=explode(",",$row["brotherDOD_month"]);
$brotherDOD_year=explode(",",$row["brotherDOD_year"]);
$brother_relation=explode(",",$row["brother_relation"]);
$brother_mother_father=explode(",",$row["brother_mother_father"]);

$count_brother=count($brother);
for($i=0;$i<$count_brother;$i++){

?>
<h2>Brother <? echo $i+1;?> Details:</h2>

<div class="form-group">
                                 <label>Brother</label>
                                 <input type="text" class="form-control" name="brother[]" value="<? echo $brother[$i];?>" placeholder="Enter brother"  >
								 
                              </div>
							  
							  <div class="form-group">
							  <label>
<input type="radio" name="brother_mother_father[]" value="Father" <?= ($brother_mother_father[$i] == "Father")? 'checked' : '';?>>Father
<input type="radio" name="brother_mother_father[]" value="Mother" <?= ($brother_mother_father[$i] == "Mother")? 'checked' : '';?>>Mother<br>
</label>
                                 <input type="text" class="form-control" name="brother_relation[]" value="<? echo $brother_relation[$i];?>" placeholder="Enter Mother/Father Name"  >
                              </div>
							  
 
							  
							  <div class="form-group">
							<h4><B>Date Of Birth</B></h4>
							    <label>Date</label>
                                 
   <input type="text" class="" name="brotherDOB_date[]" value="<? echo $brotherDOB_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="brotherDOB_month[]" value="<? echo $brotherDOB_month[$i];?>"  placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="brotherDOB_year[]" value="<? echo $brotherDOB_year[$i];?>"  placeholder="Year"  >
                                 
                              </div> 
							  
							  
							   <BR/>
							    <div class="form-group">
							<h4><B>Date Of Death</B></h4>
							    <label>Date</label>
                                 
   <input type="text" class="" name="brotherDOD_date[]" value="<? echo $brotherDOD_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="brotherDOD_month[]" value="<? echo $brotherDOD_month[$i];?>"  placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="brotherDOD_year[]" value="<? echo $brotherDOD_year[$i];?>"  placeholder="Year"  >
                                 
                              </div> 
							  <? } ?>
							  
							  <div class="field_wrapper_brother">
					
                              </div>
                                    </div>
									<br> 
									
									 <div id="isSequel" style="display: block;border: 1px solid black;padding: 14px;">
                          <label></label>
                                
                                
                                <a href="javascript:void(0);" class="add_button_sister btn btn-success pull-right" title="Add More">Add More</a>
                                     <br/>
<?
$sister=explode(",",$row["sister"]);
$sisterDOB_date=explode(",",$row["sisterDOB_date"]);
$sisterDOB_month=explode(",",$row["sisterDOB_month"]);
$sisterDOB_year=explode(",",$row["sisterDOB_year"]);
$sisterDOD_date=explode(",",$row["sisterDOD_date"]);
$sisterDOD_month=explode(",",$row["sisterDOD_month"]);
$sisterDOD_year=explode(",",$row["sisterDOD_year"]);
$sister_relation=explode(",",$row["sister_relation"]);

$sister_mother_father=explode(",",$row["sister_mother_father"]);
$count_sister=count($sister);
for($i=0;$i<$count_sister;$i++){

?>
<h2>Sister <? echo $i+1;?> Details:</h2>
<div class="form-group">
                                 <label>Sister</label>
                                 <input type="text" class="form-control" name="sister[]" value="<? echo $sister[$i];?>"  placeholder="Enter sister"  >
								 
                              </div>
							  
							  <div class="form-group">

  
 <label>
<input type="radio" name="sister_mother_father[]" value="Father" <?= ($sister_mother_father[$i] == "Father")? 'checked' : '';?>>Father
<input type="radio" name="sister_mother_father[]" value="Mother" <?= ($sister_mother_father[$i] == "Mother")? 'checked' : '';?>>Mother<br>
</label>
                                 <input type="text" class="form-control" name="sister_relation[]" value="<? echo $sister_relation[$i];?>"  placeholder="Enter Mother/Father Name"  >
                              </div>
							  
 
							  
							  <div class="form-group">
							<h4><B>Date Of Birth</B></h4>
							    <label>Date</label>
                                 
   <input type="text" class="" name="sisterDOB_date[]"  value="<? echo $sisterDOB_date[$i];?>"  placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="sisterDOB_month[]" value="<? echo $sisterDOB_month[$i];?>"   placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="sisterDOB_year[]" value="<? echo $sisterDOB_year[$i];?>"   placeholder="Year"  >
                                 
                              </div> 
							  
							  
							   <BR/>
							    <div class="form-group">
							<h4><B>Date Of Death</B></h4>
							    <label>Date</label>
                                 
   <input type="text" class="" name="sisterDOD_date[]" value="<? echo $sisterDOD_date[$i];?>"   placeholder="Date"  >
   <label>Month</label>
                                 
   <input type="text" class="" name="sisterDOD_month[]" value="<? echo $sisterDOD_month[$i];?>"   placeholder="Month"  >
   <label>Year</label>
                                 
   <input type="text" class="" name="sisterDOD_year[]"  value="<? echo $sisterDOD_year[$i];?>"  placeholder="Year"  >
                                 
                              </div> 
							  <? } ?>
							  
							  <div class="field_wrapper_sister">
					
                              </div>
                                    </div>
									<br> 
									
									
									 
<div class="form-group">
                                 <label>Relatives</label>
								 
								 <?  $relative=explode(",",$row["relative"]);
														$tmp = '';

                                     foreach($relative as $relative_read){
									 
										 $relative_data_query="select * from cast where name='$relative_read'";
										 $relative_data_exe=mysqli_query($con,$relative_data_query);
										 $relative_data_read=mysqli_fetch_array($relative_data_exe);
										 $relative_read_name=$relative_data_read["name"];
										 $tmp .=$relative_read_name. ','; 
										 }
										 $tmp = trim($tmp, ',');    // remove trailing comma
                                    			 ?>
   <input type='text'
       placeholder='Enter Lyricist Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='cast',
       data-value-property='value',
	   name='relative[]',
	   value='<? echo $tmp?>',
      multiple
       >
	   <datalist id="cast" >
	   
	   <?
	   
	   
	     foreach($relative as $relative_read){
									 
										 $relative_data_query="select * from cast where name='$relative_read'";
										 $relative_data_exe=mysqli_query($con,$relative_data_query);
										 $relative_data_read=mysqli_fetch_array($relative_data_exe);
										 $relative_read_name=$relative_data_read["name"];
										
										 ?>
										  <option value="<?php echo $relative_read_name ?>" selected><?php echo $relative_read_name;?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cast order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                  </datalist>
                              </div>



							  
							  <div class="form-group">
							  <label>Movie Language</label>

<?php
$movie_language=explode(",",$row["movie_language"]);
$tmp = '';

foreach($movie_language as $movie_language_read){

    $movie_language_data_query="select * from dubbing  where name='$movie_language_read'";
    $movie_language_data_exe=mysqli_query($con,$movie_language_data_query);
    $movie_language_data_read=mysqli_fetch_array($movie_language_data_exe, MYSQLI_ASSOC);
    $movie_language_read_name=$movie_language_data_read["name"];
    $tmp .=$movie_language_read_name. ',';
}

$tmp = trim($tmp, ',');    // remove trailing comma
?>

<input type='text'
       placeholder='Enter Movie Language  Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='movie_language'
       data-value-property='value'
       name='movie_language[]'
       value="<?php echo $tmp; ?>"
       multiple>

<datalist id="movie_language" >

<?php

$sqlfr=mysqli_query($con, "select * from dubbing  order by name");
while($rowfr=mysqli_fetch_array($sqlfr, MYSQLI_ASSOC)){

?>

<option value="<?php echo $rowfr['name']; ?>"><?php echo $rowfr['name']; ?></option>
<?php } ?>

</datalist>
				</div>			  
							  

									<div class="form-group  ">
							   <label>Lead Actor/Actress Total No. Of Children</label>
                                 
   <input type="text" class="form-control" name="total_children[]" value="<? echo $row['total_children'];?>"  placeholder="NO. Of children"  >
							  
							</div>
									
									
									
							  
							  

 
                              
<div class="form-group">
                                 <label>Facebook</label>
                                 <input type="text" class="form-control" name="facebook" placeholder="Enter Facebook"   value="<? echo $row['facebook'];?>">
                              </div>
<div class="form-group">
                                 <label>Twitter</label>
                                 <input type="text" class="form-control" name="twitter" placeholder="Enter Twitter" value="<? echo $row['twitter'];?>"  >
                              </div>
<div class="form-group">
                                 <label>Instagram</label>
                                 <input type="text" class="form-control" name="instagram" placeholder="Enter Instagram"  value="<? echo $row['instagram'];?>" >
                              </div>







                                     
           <div class="form-group">
                                 <label>Birth Date</label>
                                 <input type="text" class="form-control" name="birth_date" placeholder="Enter Birth Date"   value="<? echo $row['birth_date'];?>" >

                                      <div class="form-group">
                                 <label>Birth Month</label>
                                 <input type="text" class="form-control" name="birth_month" placeholder="Enter Birth Month"  value="<? echo $row['birth_month'];?>"  >

                                      <div class="form-group">
                                 <label>Birth Year</label>
                                 <input type="text" class="form-control" name="birth_year" placeholder="Enter Birth Year" value="<? echo $row['birth_year'];?>"   >


                              </div>  

                                </div> <div class="form-group">
                                 <label>Death Date</label>
                                 <input type="text" class="form-control" name="death_date" placeholder="Enter Death Date"  value="<? echo $row['death_date'];?>"  >
                              </div> 

                               <div class="form-group">
                                 <label>Death Month</label>
                                 <input type="text" class="form-control" name="death_month" placeholder="Enter Death Month"  value="<? echo $row['death_month'];?>"  >
                              </div>
                                 <div class="form-group">
                                 <label>Death year</label>
                                 <input type="text" class="form-control" name="death_year" placeholder="Enter Death Year"  value="<? echo $row['death_year'];?>"   >
                              </div> 
                             <div class="form-group">
                               <!-- <label>Gender <? echo $row['gender']; ?></label><br>
 <input type="radio" name="gender" value="Male" <? if($row['gender']=="'Male' or 'actor'"){ ?>
 checked="checked"
 <? }?>>Actor<br>
<input type="radio" name="gender" value="Female" <? if($row['gender']=="'Female' or 'actress'"){ ?>
checked="checked"
<?
}?>>Actress<br> -->

<label>Gender</label><br/>
<input type="radio" name="gender" value="None" <?php if($row['gender'] == 'None' || $row['gender'] == 'None'){ ?>
checked="checked"
<?php }?>>None<br/>

<input type="radio" name="gender" value="Male" <?php if($row['gender'] == 'Male' || $row['gender'] == 'actor'){ ?>
checked="checked"
<?php }?>>Male<br/>
<input type="radio" name="gender" value="Female" <?php if($row['gender'] == 'Female' || $row['gender'] == 'actress'){ ?>
checked="checked"
<?php }?>>Female<br/>



                              </div>
							  
							  
							 

    <div class="form-group">
                                 <label>Show on Home</label>
                                 <select class="form-control" name="show_on_home" >
                                  <option value="0" <? if($row['show_on_home']=="0"){ echo "selected";} ?>>No</option>
                                  <option value="1" <? if($row['show_on_home']=="1"){ echo "selected";} ?>>Yes</option>
                                 </select>
                              </div>
                         
                                 <div class="form-group">
                                 <label>Image</label>
                                 <img src="photo/<? echo $row['photo']; ?>" width="100"> 
                                   <input type="file"  name="filstor"  class="form-control">
                                    <input type="hidden" name="oldimg" value="<? echo $row['photo']; ?>">
                                  
                              </div>   
                              

     <div class="form-group">
                                 <label>Details</label>
                                 <textarea name="details" rows="25"><? echo $row['details'];?></textarea> 
                              </div>
        
                              <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="reset-button">

                                 <input type="submit" name="Update" class="btn btn-add"   value="Update">
                                  
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>

<? } ?>
















<? if( $_GET['Action']==""){ ?>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Music Producer List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                                                          <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="crew_details.php"> <i class="fa fa-plus"></i> Add Crew
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
    url: "search_music_producers.php",
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

<input type="text" class="search form-control" id="searchid" placeholder="Search for music_producer" style="width: 100%" />  
<div id="result"></div>
 

<br><br>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>Name</th> <th>Nick Name</th> 
                                       <th>DOB</th> 
                                       <th>DOD</th> 

                                                                              <th>Show on Home Page</th> 
                                       <th>Photo</th> 
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `music_producer`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `music_producer` order by show_on_home desc LIMIT $offset, $total_records_per_page");


 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                       <td><? echo $row['name']; ?></td>                                        <td><? echo $row['nickname']; ?></td> 
                                       <td><? echo $row['dob']; ?></td> 
                                       <td><? echo $row['dod']; ?></td>    <td><?   if($row['show_on_home']=="1"){ ?> 
                                        <a href="music_producer.php?id=<? echo $row['id']; ?>&show_on_home=0&Action=ShowHome" style="color:#F00">Hide</a>
                                        <? } else{ ?>
                                        <a href="music_producer.php?id=<? echo $row['id']; ?>&show_on_home=1&Action=ShowHome">Show</a>
                                        <? } ?></td> 
                                      <td> <img src="photo/<? echo $row['photo']; ?>" width="50"></td>
                                       <td>
                                         
                                          <a href="crew-details-edit.php?Action=Update&id=<? echo $row['id'];?>&profile=music_producer&profile_unique_id=<? echo $row['profile_unique_id'];?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
                                          <a  href="javascript:resume_id('<? echo $row['id']?>')" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
                                       </td>
                                    </tr>

                                     <? } ?>
                                    
                                 </tbody>
                              </table>



<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
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

            <? } ?>
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
	  
	  
	   <script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>
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