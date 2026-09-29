<?
session_start();
include "config.php";
$table=$_GET["profile"];
if(empty($_GET["profile_unique_id"]))
{
$profile_unique_id=rand();
}
else
{
    $profile_unique_id=$_GET["profile_unique_id"];
}

$id= $_GET['id'] ;  
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_GET['Action']=="ShowHome"){
  
    $show_on_home= $_GET['show_on_home'] ;
$sql=mysqli_query($con, "update $table set show_on_home='$show_on_home' where id='$id'")or die(mysqli_error($con));
header('location:director.php?msg=success');
}

           if($_POST["Update"]) {

    $id= $_GET['id'];
	
    //$table= mysqli_real_escape_string($con,implode(",",$_POST['table'])) ;
     $name=mysqli_real_escape_string($con,$_POST['name']);
        $real_name=mysqli_real_escape_string($con,$_POST['real_name']); 
$other_profession=mysqli_real_escape_string($con,implode(",",$_POST['table'])); 
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
	 
	 $born_state=mysqli_real_escape_string($con,implode(",",$_POST['born_state']));
   
	$born_city=mysqli_real_escape_string($con,implode(",",$_POST['born_city']));
	$father1=mysqli_real_escape_string($con,implode(",",$_POST['father']));
	$father=rtrim($father1,',');
	$father_data_from1=mysqli_real_escape_string($con,implode(",",$_POST['father_name_choice_profesion']));
	$father_data_from=rtrim($father_data_from1,',');
	$mother1=mysqli_real_escape_string($con,implode(",",$_POST['mother']));
	$mother=rtrim($mother1,',');
	$mother_data_from1=mysqli_real_escape_string($con,implode(",",$_POST['mother_name_choice_profesion']));
	$mother_data_from=rtrim($mother_data_from1,',');
	$spouse1=mysqli_real_escape_string($con,implode(",",$_POST['spouse']));
	$spouse=rtrim($spouse1,',');
   $spouse_data_from1=mysqli_real_escape_string($con,implode(",",$_POST['spouse_name_choice_profesion']));
	$spouse_data_from=rtrim($spouse_data_from1,',');
	$son_data_from1=mysqli_real_escape_string($con,implode(",",$_POST['son_name_choice_profesion']));
	$son_data_from=rtrim($son_data_from1,',');
	$son1=mysqli_real_escape_string($con,implode(",",$_POST['son']));
	$son=rtrim($son1,',');
	$daughter1=mysqli_real_escape_string($con,implode(",",$_POST['daughter']));
	$daughter=rtrim($daughter1,',');
	$daughter_data_from1=mysqli_real_escape_string($con,implode(",",$_POST['daughter_name_choice_profesion']));
	$daughter_data_from=rtrim($daughter_data_from1,',');
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
$total_children=mysqli_real_escape_string($con,implode(",",$_POST['total_children']));
$movie_language=mysqli_real_escape_string($con,implode(",",$_POST['movie_language']));
$spouse_total_children=mysqli_real_escape_string($con,implode(",",$_POST['spouse_total_children']));

$brother1=mysqli_real_escape_string($con,implode(",",$_POST['brother']));
$brother=rtrim($brother1,',');
$brother_data_from1=mysqli_real_escape_string($con,implode(",",$_POST['brother_name_choice_profesion']));
$brother_data_from=rtrim($brother_data_from1,',');
$brother_relation=mysqli_real_escape_string($con,implode(",",$_POST['brother_relation']));
$brotherDOB_date=mysqli_real_escape_string($con,implode(",",$_POST['brotherDOB_date']));
$brotherDOB_month=mysqli_real_escape_string($con,implode(",",$_POST['brotherDOB_month']));
$brotherDOB_year=mysqli_real_escape_string($con,implode(",",$_POST['brotherDOB_year']));
$brotherDOD_date=mysqli_real_escape_string($con,implode(",",$_POST['brotherDOD_date']));
$brotherDOD_month=mysqli_real_escape_string($con,implode(",",$_POST['brotherDOD_month']));
$brotherDOD_year=mysqli_real_escape_string($con,implode(",",$_POST['brotherDOD_year']));
$sister1=mysqli_real_escape_string($con,implode(",",$_POST['sister']));
$sister=rtrim($sister1,',');
$sister_data_from1=mysqli_real_escape_string($con,implode(",",$_POST['sister_name_choice_profesion']));
$sister_data_from=rtrim($sister_data_from1,',');
$sister_relation=mysqli_real_escape_string($con,implode(",",$_POST['sister_relation']));
$sisterDOB_date=mysqli_real_escape_string($con,implode(",",$_POST['sisterDOB_date']));
$sisterDOB_month=mysqli_real_escape_string($con,implode(",",$_POST['sisterDOB_month']));
$sisterDOB_year=mysqli_real_escape_string($con,implode(",",$_POST['sisterDOB_year']));
$sisterDOD_date=mysqli_real_escape_string($con,implode(",",$_POST['sisterDOD_date']));
$sisterDOD_month=mysqli_real_escape_string($con,implode(",",$_POST['sisterDOD_month']));
$sisterDOD_year=mysqli_real_escape_string($con,implode(",",$_POST['sisterDOD_year']));

/*$Spouse_Partner1=mysqli_real_escape_string($con,$_POST['Spouse_Partner1']);
$Spouse_Partner2=mysqli_real_escape_string($con,$_POST['Spouse_Partner2']);
*/

$Spouse_Partner=mysqli_real_escape_string($con,$_POST['spouse_partner']);

$son_mother_father=mysqli_real_escape_string($con,$_POST['son_mother_father']);
$daughter_mother_father=mysqli_real_escape_string($con,$_POST['daughter_mother_father']);
$brother_mother_father=mysqli_real_escape_string($con,$_POST['brother_mother_father']);
$sister_mother_father=mysqli_real_escape_string($con,$_POST['sister_mother_father']);
	$social_media_name=mysqli_real_escape_string($con,implode(",",$_POST['social_media_name']));
	$social_media_link=mysqli_real_escape_string($con,implode(",",$_POST['link']));
   $alias =  strtolower(preg_replace('/\s+/', '-', trim($name)));
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

  $make_array=explode(",",$other_profession);
  //print_r($make_array);
  $count_number_of_table=count($make_array);
 for($j=1;$j<=$count_number_of_table;$j++){
$table_id=$make_array[$j-1];
 $table_name_find="select * from  profession  where id='$table_id'";
$table_name_find_exe=mysqli_query($con,$table_name_find);
$read_find_table_name=mysqli_fetch_array($table_name_find_exe);
$table_name=$read_find_table_name["table_name"];
if(!empty($_GET["profile_unique_id"]))
{
    // echo "<script>alert('profile id not blank')</script>";
 $check_data="select * from $table_name where profile_unique_id='$profile_unique_id'"; 
 //name='$name' and birth_date='$birth_date' and birth_month='$birth_month' and birth_year='$birth_year' and nickname='$nickname'";
$exe_crew_check=mysqli_query($con,$check_data);
$find_crew=mysqli_num_rows($exe_crew_check);

if($find_crew>=1)
{
	// echo "<script>return check();</script>";
	 $update_query="update $table_name set alias='$alias',social_media_name='$social_media_name',social_media_links='$social_media_link',father_data_from='$father_data_from',mother_data_from='$mother_data_from',spouse_data_from='$spouse_data_from',son_data_from='$son_data_from',daughter_data_from='$daughter_data_from',brother_data_from='$brother_data_from',sister_data_from='$sister_data_from',son_mother_father='$son_mother_father',daughter_mother_father='$daughter_mother_father',brother_mother_father='$brother_mother_father',sister_mother_father='$sister_mother_father',brother='$brother',brother_relation='$brother_relation',brotherDOB_date='$brotherDOB_date',brotherDOB_month='$brotherDOB_month',brotherDOB_year='$brotherDOB_year',brotherDOD_date='$brotherDOD_date',brotherDOD_month='$brotherDOD_month',brotherDOD_year='$brotherDOD_year',sister='$sister',sister_relation='$sister_relation',sisterDOB_date='$sisterDOB_date',sisterDOB_month='$sisterDOB_month',sisterDOB_year='$sisterDOB_year',sisterDOD_date='$sisterDOD_date',sisterDOD_month='$sisterDOD_month',sisterDOD_year='$sisterDOD_year',total_children='$total_children',movie_language='$movie_language',spouse_total_children='$spouse_total_children',other_profession='$other_profession',Spouse_Partner='$Spouse_Partner',spouseDOD_date='$spouseDOD_date',spouseDOD_month='$spouseDOD_month',spouseDOD_year='$spouseDOD_year',born_state='$born_state',daughter_relation='$daughter_relation',son_relation='$son_relation',relative='$relative',daughterDOD_date='$daughterDOD_date',daughterDOD_month='$daughterDOD_month',daughterDOD_year='$daughterDOD_year',daughterDOB_date='$daughterDOB_date',daughterDOB_month='$daughterDOB_month',daughterDOB_year='$daughterDOB_year',sonDOD_date='$sonDOD_date',sonDOD_month='$sonDOD_month',sonDOD_year='$sonDOD_year',sonDOB_date='$sonDOB_date',sonDOB_month='$sonDOB_month',sonDOB_year='$sonDOB_year',total_son='$total_son',total_Daughter='$total_Daughter',divorce_date='$divorce_date',divorce_month='$divorce_month',divorce_year='$divorce_year',separation_date='$separation_date',separation_month='$separation_month',separation_year='$separation_year',marriage_date='$marriage_date',marriage_month='$marriage_month',marriage_year='$marriage_year',motherDOB_date='$motherDOB_date',motherDOB_month='$motherDOB_month',motherDOB_year='$motherDOB_year',motherDOD_date='$motherDOD_date',motherDOD_month='$motherDOD_month',motherDOD_year='$motherDOD_year',fatherDOB_date='$fatherDOB_date',fatherDOB_month='$fatherDOB_month',fatherDOB_year='$fatherDOB_year',fatherDOD_date='$fatherDOD_date',fatherDOD_month='$fatherDOD_month',fatherDOD_year='$fatherDOD_year',real_step_mother='$real_step_mother',real_step_father='$real_step_father',name='$name',real_name='$real_name',  nickname='$nickname',nationality='$nationality',born_country='$born_country',born_city='$born_city',father='$father',mother='$mother',spouse='$spouse',son='$son',daughter='$daughter',facebook='$facebook',twitter='$twitter',instagram='$instagram',  birth_date='$birth_date',birth_month='$birth_month',birth_year='$birth_year', death_date='$death_date',death_month='$death_month',death_year='$death_year',gender='$gender',show_on_home='$show_on_home',photo='$newName',details='$details',profile_unique_id='$profile_unique_id' where  profile_unique_id='$profile_unique_id'";
     //name='$name' and birth_date='$birth_date' and birth_month='$birth_month' and birth_year='$birth_year'";
            mysqli_query($con,$update_query);
echo "<script>alert('Crew With Name $name is already Exist as $table_name,so its Update Successfully')</script>";
if($table_name=="film_editor")
{
$table_name="filmeditor";
}
echo "<script>window.location.href='$table_name.php'</script>";
}
else
{
 $insert_query="INSERT INTO $table_name set alias='$alias',social_media_name='$social_media_name',Spouse_Partner='$Spouse_Partner',social_media_links='$social_media_link',son_mother_father='$son_mother_father',daughter_mother_father='$daughter_mother_father',brother_mother_father='$brother_mother_father',sister_mother_father='$sister_mother_father',brother='$brother',brother_relation='$brother_relation',brotherDOB_date='$brotherDOB_date',brotherDOB_month='$brotherDOB_month',brotherDOB_year='$brotherDOB_year',brotherDOD_date='$brotherDOD_date',brotherDOD_month='$brotherDOD_month',brotherDOD_year='$brotherDOD_year',sister='$sister',sister_relation='$sister_relation',sisterDOB_date='$sisterDOB_date',sisterDOB_month='$sisterDOB_month',sisterDOB_year='$sisterDOB_year',sisterDOD_date='$sisterDOD_date',sisterDOD_month='$sisterDOD_month',sisterDOD_year='$sisterDOD_year',name='$name',total_children='$total_children',movie_language='$movie_language',spouse_total_children='$spouse_total_children',real_name='$real_name',nickname='$nickname',nationality='$nationality',born_country='$born_country',born_city='$born_city',father='$father',mother='$mother',spouse='$spouse',son='$son',daughter='$daughter',facebook='$facebook',twitter='$twitter',instagram='$instagram',birth_date='$birth_date',birth_month='$birth_month',birth_year='$birth_year',death_date='$death_date',death_month='$death_month',death_year='$death_year',gender='$gender',show_on_home='$show_on_home',photo='$photo',details='$details',real_step_father='$real_step_father',fatherDOB_date='$fatherDOB_date',fatherDOB_month='$fatherDOB_month',fatherDOB_year='$fatherDOB_year',fatherDOD_date='$fatherDOD_date',fatherDOD_month='$fatherDOD_month',fatherDOD_year='$fatherDOD_year',real_step_mother='$real_step_mother',motherDOB_date='$motherDOB_date',motherDOB_month='$motherDOB_month',motherDOB_year='$motherDOB_year',motherDOD_date='$motherDOD_date',motherDOD_month='$motherDOD_month', motherDOD_year='$motherDOD_year', marriage_date='$marriage_date', marriage_month='$marriage_month', marriage_year='$marriage_year', separation_date='$separation_date',separation_month='$separation_month',separation_year='$separation_year',divorce_date='$divorce_date',divorce_month='$divorce_month',divorce_year='$divorce_year', spouseDOD_date='$spouseDOD_date',spouseDOD_month='$spouseDOD_month',spouseDOD_year='$spouseDOD_year',total_son='$total_son',total_Daughter='$total_Daughter',sonDOB_date='$sonDOB_date', sonDOB_month='$sonDOB_month', sonDOB_year='$sonDOB_year', sonDOD_date='$sonDOD_date',sonDOD_month='$sonDOD_month',sonDOD_year='$sonDOD_year',daughterDOB_date='$daughterDOB_date',daughterDOB_month='$daughterDOB_month',daughterDOB_year='$daughterDOB_year',daughterDOD_date='$daughterDOD_date',daughterDOD_month='$daughterDOD_month', daughterDOD_year='$daughterDOD_year', born_state='$born_state',daughter_relation='$daughter_relation',son_relation='$son_relation',relative='$relative',other_profession='$other_profession',profile_unique_id='$profile_unique_id'";
mysqli_query($con,$insert_query);


 //$update_query="update $table_name set father_data_from='$father_data_from',mother_data_from='$mother_data_from',spouse_data_from='$spouse_data_from',son_data_from='$son_data_from',daughter_data_from='$daughter_data_from',brother_data_from='$brother_data_from',sister_data_from='$sister_data_from',Spouse_Partner='$Spouse_Partner',son_mother_father='$son_mother_father',daughter_mother_father='$daughter_mother_father',brother_mother_father='$brother_mother_father',sister_mother_father='$sister_mother_father',brother='$brother',brother_relation='$brother_relation',brotherDOB_date='$brotherDOB_date',brotherDOB_month='$brotherDOB_month',brotherDOB_year='$brotherDOB_year',brotherDOD_date='$brotherDOD_date',brotherDOD_month='$brotherDOD_month',brotherDOD_year='$brotherDOD_year',sister='$sister',sister_relation='$sister_relation',sisterDOB_date='$sisterDOB_date',sisterDOB_month='$sisterDOB_month',sisterDOB_year='$sisterDOB_year',sisterDOD_date='$sisterDOD_date',sisterDOD_month='$sisterDOD_month',sisterDOD_year='$sisterDOD_year',total_children='$total_children',movie_language='$movie_language',spouse_total_children='$spouse_total_children',other_profession='$other_profession',spouseDOD_date='$spouseDOD_date',spouseDOD_month='$spouseDOD_month',spouseDOD_year='$spouseDOD_year',born_state='$born_state',daughter_relation='$daughter_relation',son_relation='$son_relation',relative='$relative',daughterDOD_date='$daughterDOD_date',daughterDOD_month='$daughterDOD_month',daughterDOD_year='$daughterDOD_year',daughterDOB_date='$daughterDOB_date',daughterDOB_month='$daughterDOB_month',daughterDOB_year='$daughterDOB_year',sonDOD_date='$sonDOD_date',sonDOD_month='$sonDOD_month',sonDOD_year='$sonDOD_year',sonDOB_date='$sonDOB_date',sonDOB_month='$sonDOB_month',sonDOB_year='$sonDOB_year',total_son='$total_son',total_Daughter='$total_Daughter',divorce_date='$divorce_date',divorce_month='$divorce_month',divorce_year='$divorce_year',separation_date='$separation_date',separation_month='$separation_month',separation_year='$separation_year',marriage_date='$marriage_date',marriage_month='$marriage_month',marriage_year='$marriage_year',motherDOB_date='$motherDOB_date',motherDOB_month='$motherDOB_month',motherDOB_year='$motherDOB_year',motherDOD_date='$motherDOD_date',motherDOD_month='$motherDOD_month',motherDOD_year='$motherDOD_year',fatherDOB_date='$fatherDOB_date',fatherDOB_month='$fatherDOB_month',fatherDOB_year='$fatherDOB_year',fatherDOD_date='$fatherDOD_date',fatherDOD_month='$fatherDOD_month',fatherDOD_year='$fatherDOD_year',real_step_mother='$real_step_mother',real_step_father='$real_step_father',name='$name',real_name='$real_name',  nickname='$nickname',nationality='$nationality',born_country='$born_country',born_city='$born_city',father='$father',mother='$mother',spouse='$spouse',son='$son',daughter='$daughter',facebook='$facebook',twitter='$twitter',instagram='$instagram',  birth_date='$birth_date',birth_month='$birth_month',birth_year='$birth_year', death_date='$death_date',death_month='$death_month',death_year='$death_year',gender='$gender',show_on_home='$show_on_home',photo='$newName',details='$details' where profile_unique_id='$profile_unique_id'";
            //mysqli_query($con,$update_query);
           echo "<script>alert('Data Insert into $table_name Successful')</script>";
			echo "<script>window.location.href='$table_name.php'</script>";
         }
         //$update_query1="update $table set father_data_from='$father_data_from',mother_data_from='$mother_data_from',spouse_data_from='$spouse_data_from',son_data_from='$son_data_from',daughter_data_from='$daughter_data_from',brother_data_from='$brother_data_from',sister_data_from='$sister_data_from',Spouse_Partner='$Spouse_Partner',son_mother_father='$son_mother_father',daughter_mother_father='$daughter_mother_father',brother_mother_father='$brother_mother_father',sister_mother_father='$sister_mother_father',brother='$brother',brother_relation='$brother_relation',brotherDOB_date='$brotherDOB_date',brotherDOB_month='$brotherDOB_month',brotherDOB_year='$brotherDOB_year',brotherDOD_date='$brotherDOD_date',brotherDOD_month='$brotherDOD_month',brotherDOD_year='$brotherDOD_year',sister='$sister',sister_relation='$sister_relation',sisterDOB_date='$sisterDOB_date',sisterDOB_month='$sisterDOB_month',sisterDOB_year='$sisterDOB_year',sisterDOD_date='$sisterDOD_date',sisterDOD_month='$sisterDOD_month',sisterDOD_year='$sisterDOD_year',total_children='$total_children',movie_language='$movie_language',spouse_total_children='$spouse_total_children',other_profession='$other_profession',spouseDOD_date='$spouseDOD_date',spouseDOD_month='$spouseDOD_month',spouseDOD_year='$spouseDOD_year',born_state='$born_state',daughter_relation='$daughter_relation',son_relation='$son_relation',relative='$relative',daughterDOD_date='$daughterDOD_date',daughterDOD_month='$daughterDOD_month',daughterDOD_year='$daughterDOD_year',daughterDOB_date='$daughterDOB_date',daughterDOB_month='$daughterDOB_month',daughterDOB_year='$daughterDOB_year',sonDOD_date='$sonDOD_date',sonDOD_month='$sonDOD_month',sonDOD_year='$sonDOD_year',sonDOB_date='$sonDOB_date',sonDOB_month='$sonDOB_month',sonDOB_year='$sonDOB_year',total_son='$total_son',total_Daughter='$total_Daughter',divorce_date='$divorce_date',divorce_month='$divorce_month',divorce_year='$divorce_year',separation_date='$separation_date',separation_month='$separation_month',separation_year='$separation_year',marriage_date='$marriage_date',marriage_month='$marriage_month',marriage_year='$marriage_year',motherDOB_date='$motherDOB_date',motherDOB_month='$motherDOB_month',motherDOB_year='$motherDOB_year',motherDOD_date='$motherDOD_date',motherDOD_month='$motherDOD_month',motherDOD_year='$motherDOD_year',fatherDOB_date='$fatherDOB_date',fatherDOB_month='$fatherDOB_month',fatherDOB_year='$fatherDOB_year',fatherDOD_date='$fatherDOD_date',fatherDOD_month='$fatherDOD_month',fatherDOD_year='$fatherDOD_year',real_step_mother='$real_step_mother',real_step_father='$real_step_father',name='$name',real_name='$real_name',  nickname='$nickname',nationality='$nationality',born_country='$born_country',born_city='$born_city',father='$father',mother='$mother',spouse='$spouse',son='$son',daughter='$daughter',facebook='$facebook',twitter='$twitter',instagram='$instagram',  birth_date='$birth_date',birth_month='$birth_month',birth_year='$birth_year', death_date='$death_date',death_month='$death_month',death_year='$death_year',gender='$gender',show_on_home='$show_on_home',photo='$newName',details='$details' where id='$id'";
            //mysqli_query($con,$update_query1);
           //echo "<script>window.location.href='$table_name.php'</script>";
}
else
{
   // echo "<script>alert('profile id is blank')</script>";
    if($table_name==$table){
       // echo "<script>alert('match')</script>";
     $update_query="update $table_name set social_media_name='$social_media_name',Spouse_Partner='$Spouse_Partner',social_media_links='$social_media_link',father_data_from='$father_data_from',mother_data_from='$mother_data_from',spouse_data_from='$spouse_data_from',son_data_from='$son_data_from',daughter_data_from='$daughter_data_from',brother_data_from='$brother_data_from',sister_data_from='$sister_data_from',son_mother_father='$son_mother_father',daughter_mother_father='$daughter_mother_father',brother_mother_father='$brother_mother_father',sister_mother_father='$sister_mother_father',brother='$brother',brother_relation='$brother_relation',brotherDOB_date='$brotherDOB_date',brotherDOB_month='$brotherDOB_month',brotherDOB_year='$brotherDOB_year',brotherDOD_date='$brotherDOD_date',brotherDOD_month='$brotherDOD_month',brotherDOD_year='$brotherDOD_year',sister='$sister',sister_relation='$sister_relation',sisterDOB_date='$sisterDOB_date',sisterDOB_month='$sisterDOB_month',sisterDOB_year='$sisterDOB_year',sisterDOD_date='$sisterDOD_date',sisterDOD_month='$sisterDOD_month',sisterDOD_year='$sisterDOD_year',total_children='$total_children',movie_language='$movie_language',spouse_total_children='$spouse_total_children',other_profession='$other_profession',spouseDOD_date='$spouseDOD_date',spouseDOD_month='$spouseDOD_month',spouseDOD_year='$spouseDOD_year',born_state='$born_state',daughter_relation='$daughter_relation',son_relation='$son_relation',relative='$relative',daughterDOD_date='$daughterDOD_date',daughterDOD_month='$daughterDOD_month',daughterDOD_year='$daughterDOD_year',daughterDOB_date='$daughterDOB_date',daughterDOB_month='$daughterDOB_month',daughterDOB_year='$daughterDOB_year',sonDOD_date='$sonDOD_date',sonDOD_month='$sonDOD_month',sonDOD_year='$sonDOD_year',sonDOB_date='$sonDOB_date',sonDOB_month='$sonDOB_month',sonDOB_year='$sonDOB_year',total_son='$total_son',total_Daughter='$total_Daughter',divorce_date='$divorce_date',divorce_month='$divorce_month',divorce_year='$divorce_year',separation_date='$separation_date',separation_month='$separation_month',separation_year='$separation_year',marriage_date='$marriage_date',marriage_month='$marriage_month',marriage_year='$marriage_year',motherDOB_date='$motherDOB_date',motherDOB_month='$motherDOB_month',motherDOB_year='$motherDOB_year',motherDOD_date='$motherDOD_date',motherDOD_month='$motherDOD_month',motherDOD_year='$motherDOD_year',fatherDOB_date='$fatherDOB_date',fatherDOB_month='$fatherDOB_month',fatherDOB_year='$fatherDOB_year',fatherDOD_date='$fatherDOD_date',fatherDOD_month='$fatherDOD_month',fatherDOD_year='$fatherDOD_year',real_step_mother='$real_step_mother',real_step_father='$real_step_father',name='$name',real_name='$real_name',  nickname='$nickname',nationality='$nationality',born_country='$born_country',born_city='$born_city',father='$father',mother='$mother',spouse='$spouse',son='$son',daughter='$daughter',facebook='$facebook',twitter='$twitter',instagram='$instagram',  birth_date='$birth_date',birth_month='$birth_month',birth_year='$birth_year', death_date='$death_date',death_month='$death_month',death_year='$death_year',gender='$gender',show_on_home='$show_on_home',photo='$newName',details='$details',profile_unique_id='$profile_unique_id' where  id='$id'";
     //name='$name' and birth_date='$birth_date' and birth_month='$birth_month' and birth_year='$birth_year'";
            mysqli_query($con,$update_query);
echo "<script>alert('Crew With Name $name is already Exist as $table_name,so its Update Successfully')</script>";
  echo "<script>window.location.href='$table_name.php'</script>";
}
else
{
    $insert_query="INSERT INTO $table_name set Spouse_Partner='$Spouse_Partner',son_mother_father='$son_mother_father',daughter_mother_father='$daughter_mother_father',brother_mother_father='$brother_mother_father',sister_mother_father='$sister_mother_father',brother='$brother',brother_relation='$brother_relation',brotherDOB_date='$brotherDOB_date',brotherDOB_month='$brotherDOB_month',brotherDOB_year='$brotherDOB_year',brotherDOD_date='$brotherDOD_date',brotherDOD_month='$brotherDOD_month',brotherDOD_year='$brotherDOD_year',sister='$sister',sister_relation='$sister_relation',sisterDOB_date='$sisterDOB_date',sisterDOB_month='$sisterDOB_month',sisterDOB_year='$sisterDOB_year',sisterDOD_date='$sisterDOD_date',sisterDOD_month='$sisterDOD_month',sisterDOD_year='$sisterDOD_year',name='$name',total_children='$total_children',movie_language='$movie_language',spouse_total_children='$spouse_total_children',real_name='$real_name',nickname='$nickname',nationality='$nationality',born_country='$born_country',born_city='$born_city',father='$father',mother='$mother',spouse='$spouse',son='$son',daughter='$daughter',facebook='$facebook',twitter='$twitter',instagram='$instagram',birth_date='$birth_date',birth_month='$birth_month',birth_year='$birth_year',death_date='$death_date',death_month='$death_month',death_year='$death_year',gender='$gender',show_on_home='$show_on_home',photo='$photo',details='$details',real_step_father='$real_step_father',fatherDOB_date='$fatherDOB_date',fatherDOB_month='$fatherDOB_month',fatherDOB_year='$fatherDOB_year',fatherDOD_date='$fatherDOD_date',fatherDOD_month='$fatherDOD_month',fatherDOD_year='$fatherDOD_year',real_step_mother='$real_step_mother',motherDOB_date='$motherDOB_date',motherDOB_month='$motherDOB_month',motherDOB_year='$motherDOB_year',motherDOD_date='$motherDOD_date',motherDOD_month='$motherDOD_month', motherDOD_year='$motherDOD_year', marriage_date='$marriage_date', marriage_month='$marriage_month', marriage_year='$marriage_year', separation_date='$separation_date',separation_month='$separation_month',separation_year='$separation_year',divorce_date='$divorce_date',divorce_month='$divorce_month',divorce_year='$divorce_year', spouseDOD_date='$spouseDOD_date',spouseDOD_month='$spouseDOD_month',spouseDOD_year='$spouseDOD_year',total_son='$total_son',total_Daughter='$total_Daughter',sonDOB_date='$sonDOB_date', sonDOB_month='$sonDOB_month', sonDOB_year='$sonDOB_year', sonDOD_date='$sonDOD_date',sonDOD_month='$sonDOD_month',sonDOD_year='$sonDOD_year',daughterDOB_date='$daughterDOB_date',daughterDOB_month='$daughterDOB_month',daughterDOB_year='$daughterDOB_year',daughterDOD_date='$daughterDOD_date',daughterDOD_month='$daughterDOD_month', daughterDOD_year='$daughterDOD_year', born_state='$born_state',daughter_relation='$daughter_relation',son_relation='$son_relation',relative='$relative',other_profession='$other_profession',profile_unique_id='$profile_unique_id'";
mysqli_query($con,$insert_query);
  echo "<script>window.location.href='$table_name.php'</script>";
}
}
 }   
           }
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con, "delete from director where id='$_REQUEST[id]'");
echo "<script>alert('Update Successful')</script>";
header("location:director.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php echo ucfirst($table)?> Management</title>
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
<script>
function check()
{
	var ch=confirm("Duplicate Record Found,Are You Sure To Continue?");
	if(ch==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
 <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
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
                  <h1><?php echo ucfirst($table)?></h1>
                  <small><?php echo ucfirst($table)?> List</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">



<? if($_GET['Action']=="Update"){  $id2=$_GET['id'];
$sql="select * from $table where id='$id2'";
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
                                 <h4>Update <?php echo ucfirst($table)?></h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
						  <div class="form-group">
						    <label>Select Crew Other Profession (e.g -Director/Producer/Music Director etc)</label>
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
                                        if(empty($tmp_profession1))
                                        {
                                             $table_name_find1="select * from  profession  where table_name='$table'";
$table_name_find_exe1=mysqli_query($con,$table_name_find1);
$read_find_table_id=mysqli_fetch_array($table_name_find_exe1);
$table_id=$read_find_table_id["id"];
                                            $tmp_profession1=$table_id;
                                        }
                                        else
                                        {
                                            $tmp_profession1 = trim($tmp_profession1, ',');
                                        }
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
                                 <label>Name</label>
                                 <input type="text" name="name" class="form-control" value="<? echo $row['name'];?>"  >
                              </div>   
                              <div class="form-group">
                                 <label>Real Name</label>
                                 <input type="text" name="real_name" class="form-control" placeholder="Update real_name" value="<? echo $row['real_name'];?>"   >
                              </div> 
                              
<?   if($row['show_on_home']=="1"){ ?> 
                                        <a  class="btn btn-primary" href="director.php?id=<? echo $row['id']; ?>&show_on_home=0&Action=ShowHome" style="color:#fff; font-weight: bold">Hide</a>
                                        <? } else{ ?>
                                        <a  class="btn btn-primary" href="director.php?id=<? echo $row['id']; ?>&show_on_home=1&Action=ShowHome">Show</a>
                                        <? } ?>
 
                             <div class="form-group">
                                 <label>Nick Name</label>
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
	   name='born_state[]',
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
	   name='born_city[]',
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
							  
							  
							  
							  
							  

							<!--Father Block Start-->
							<!-- ================= Father Edit Block Start ================= -->

<div id="father" style="display:block;border:1px solid #000;padding:14px;">

<?php

$father_data_from    = explode(",", $row["father_data_from"]);
$father_name         = explode(",", $row["father"]);
$father_step_father  = explode(",", $row["real_step_father"]);

$father_birth_date   = explode(",", $row["fatherDOB_date"]);
$father_birth_month  = explode(",", $row["fatherDOB_month"]);
$father_birth_year   = explode(",", $row["fatherDOB_year"]);

$father_death_date   = explode(",", $row["fatherDOD_date"]);
$father_death_month  = explode(",", $row["fatherDOD_month"]);
$father_death_year   = explode(",", $row["fatherDOD_year"]);

/* Find total father records */

$totalFather = max(

    count($father_name),
    count($father_step_father),
    count($father_birth_date),
    count($father_death_date)

);

if($totalFather==0){
    $totalFather=1;
}

?>

<div id="fatherContainer">

<?php
for($i=0;$i<$totalFather;$i++){
     $totalFather;
?>

<div class="father-section card mb-3 p-3">

    <div class="d-flex justify-content-between">

        <h4>Father <?php echo ($i+1); ?></h4>

        <button type="button"
                class="btn btn-danger btn-sm removeFather"
                <?php if($i==0){ ?>style="display:none;"<?php } ?>>
            Remove
        </button>

    </div>

    <!-- Father Name -->

    <div class="form-group">

        <label>Father Name</label>

        <button type="button"
                class="btn btn-link p-0 toggleFatherDb">

            Select Data From Database

        </button>

        &nbsp;&nbsp;&nbsp;

        <a href="#" class="manualEntry">
            Enter Manually
        </a>

        <div class="father-db"
             style="display:block;margin-top:10px;">

            <select class="form-control professionSelect"
                    name="father_name_choice_profesion[]">

                <option value="<?php echo isset($father_data_from[$i]) ? $father_data_from[$i] : ''; ?>">

                    <?php echo isset($father_data_from[$i]) ? $father_data_from[$i] : '- Select Profession -'; ?>

                </option>

                <?php

                $choice=mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");

                while($choice_exe=mysqli_fetch_array($choice)){

                ?>

                <option value="<?php echo $choice_exe['table_name'];?>">

                    <?php echo $choice_exe['profession_name'];?>

                </option>

                <?php } ?>

            </select>

            <br>

            <select class="form-control fatherSelect"
                    name="father[]"
                    style="display:none;">

            </select>

        </div>

        <input type="text"
               name="father[]"
               class="form-control fatherTextbox"
               placeholder="Enter Father"
               value="<?php echo isset($father_name[$i]) ? $father_name[$i] : ''; ?>">

    </div>

    <!-- Father / Step Father -->

    <div class="form-group">

        <label>Relation</label>

        <select class="form-control"
                name="real_step_father[]">

            <option value="<?php echo isset($father_step_father[$i]) ? $father_step_father[$i] : 'Father'; ?>">

                <?php echo isset($father_step_father[$i]) ? $father_step_father[$i] : 'Father'; ?>

            </option>

            <option value="Father">Father</option>

            <option value="Step Father">Step Father</option>

        </select>

    </div>

    <!-- DOB -->

    <label>Date Of Birth</label>

    <div class="row">

        <div class="col-md-4">

            <input type="text"
                   class="form-control"
                   name="fatherDOB_date[]"
                   value="<?php echo isset($father_birth_date[$i]) ? $father_birth_date[$i] : ''; ?>"
                   placeholder="Date">

        </div>

        <div class="col-md-4">

            <input type="text"
                   class="form-control"
                   name="fatherDOB_month[]"
                   value="<?php echo isset($father_birth_month[$i]) ? $father_birth_month[$i] : ''; ?>"
                   placeholder="Month">

        </div>

        <div class="col-md-4">

            <input type="text"
                   class="form-control"
                   name="fatherDOB_year[]"
                   value="<?php echo isset($father_birth_year[$i]) ? $father_birth_year[$i] : ''; ?>"
                   placeholder="Year">

        </div>

    </div>
    <!-- DOD -->

    <label>Date Of Death</label>

    <div class="row">

        <div class="col-md-4">

            <input type="text"
                   class="form-control"
                   name="fatherDOD_date[]"
                   value="<?php echo isset($father_death_date[$i]) ? $father_death_date[$i] : ''; ?>"
                   placeholder="Date">

        </div>

        <div class="col-md-4">

            <input type="text"
                   class="form-control"
                   name="fatherDOD_month[]"
                   value="<?php echo isset($father_death_month[$i]) ? $father_death_month[$i] : ''; ?>"
                   placeholder="Month">

        </div>

        <div class="col-md-4">

            <input type="text"
                   class="form-control"
                   name="fatherDOD_year[]"
                   value="<?php echo isset($father_death_year[$i]) ? $father_death_year[$i] : ''; ?>"
                   placeholder="Year">

        </div>

    </div>

</div>

<?php } ?>

</div>

<button type="button"
        class="btn btn-success mt-3"
        id="addFather">

    + Add Father

</button>

</div>
<script>
    /* ===========================
   Edit Father Initialization
=========================== */
$(function () {

    var count = 1;

  $("#addFather").click(function () {

    count++;

    var clone = $("#fatherContainer .father-section:first").clone();

    // Clear all textboxes
    clone.find("input[type='text']").val("");

    // Reset selects
    clone.find("select").prop("selectedIndex", 0);

    // Hide database section
    clone.find(".father-db").hide();

    // Reset database dropdown
    clone.find(".fatherSelect")
        .hide()
        .html("")
        .prop("disabled", false);

    // Show manual textbox
    clone.find(".fatherTextbox")
        .show()
        .prop("disabled", false);

    // Reset profession
    clone.find(".professionSelect").val("");

    // Heading
    clone.find("h4:first").text("Father " + count);

    // Show remove button
    clone.find(".removeFather").show();

    $("#fatherContainer").append(clone);

});

$(document).on("click", ".removeFather", function () {

    $(this).closest(".father-section").remove();

    count = 0;

    $("#fatherContainer .father-section").each(function () {

        count++;

        $(this).find("h4:first").text("Father " + count);

        if(count==1){
            $(this).find(".removeFather").hide();
        }else{
            $(this).find(".removeFather").show();
        }

    });

});
$(document).on("click", ".toggleFatherDb", function (e) {
    e.preventDefault();
    e.stopPropagation();

    console.log("toggle clicked");

    var section = $(this).closest(".father-section");

    section.find(".father-db").stop(true, true).slideToggle();

    return false;
});

//When a profession is selected, load names using Ajax:

$(document).on("change", ".professionSelect", function () {

    var section = $(this).closest(".father-section");

    $.ajax({
        url: "ajax_data_bind.php",
        type: "POST",
        data: {
            professionSelect: $(this).val()
        },
        success: function(data) {
            section.find(".fatherSelect").html(data).show();
        }
    });

});

//When a database record is selected:

$(document).on("change", ".fatherSelect", function () {

    var section = $(this).closest(".father-section");

    if ($(this).val() != "") {

        section.find(".fatherTextbox")
            .hide()
            .prop("disabled", true);

        $(this)
            .show()
            .prop("disabled", false);
    }
});
//If the user wants to type manually again
$(document).on("click", ".manualEntry", function (e) {

    e.preventDefault();

    var section = $(this).closest(".father-section");

    section.find(".fatherTextbox")
        .show()
        .prop("disabled", false)
        .val("");

    section.find(".fatherSelect")
        .hide()
        .prop("disabled", false)
        .html("");

    section.find(".professionSelect").val("");

    section.find(".father-db").hide();

});

});

</script>
<!-- ================= Father Edit Block End ================= -->
    <br>
							
							<!--Father Block End-->
<br/>
									<!--Mother Block Start-->
									<!-- ================= Mother Edit Block Start ================= -->

<div id="mother" style="display:block;border:1px solid #000;padding:14px;">

<?php

$mother_data_from   = explode(",", $row["mother_data_from"]);
$mother_name        = explode(",", $row["mother"]);
$mother_relation    = explode(",", $row["real_step_mother"]);

$mother_birth_date  = explode(",", $row["motherDOB_date"]);
$mother_birth_month = explode(",", $row["motherDOB_month"]);
$mother_birth_year  = explode(",", $row["motherDOB_year"]);

$mother_death_date  = explode(",", $row["motherDOD_date"]);
$mother_death_month = explode(",", $row["motherDOD_month"]);
$mother_death_year  = explode(",", $row["motherDOD_year"]);

/* Total Mother Records */

$totalMother = max(

    count($mother_name),
    count($mother_relation),
    count($mother_birth_date),
    count($mother_death_date)

);

if ($totalMother == 0) {
    $totalMother = 1;
}

?>

<div id="motherContainer">

<?php for ($i = 0; $i < $totalMother; $i++) { ?>

<div class="mother-section card mb-3 p-3">

    <div class="d-flex justify-content-between">

        <h4>Mother <?php echo ($i + 1); ?></h4>

        <button type="button"
                class="btn btn-danger btn-sm removeMother"
                <?php if($i==0){ ?>style="display:none;"<?php } ?>>
            Remove
        </button>

    </div>

    <!-- Mother Name -->

    <div class="form-group">

        <label>Mother Name</label>

        <button type="button"
                class="btn btn-link p-0 toggleMotherDb">
            Select Data From Database
        </button>

        &nbsp;&nbsp;&nbsp;&nbsp;

        <a href="#" class="manualMotherEntry">
            Enter Manually
        </a>

        <div class="mother-db"
             style="display:block;margin-top:10px;">

            <select class="form-control professionSelect"
                    name="mother_name_choice_profesion[]">

                <option value="">- Select Profession -</option>

                <?php
                $choice = mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");
                while($choice_exe=mysqli_fetch_array($choice)){
                ?>

                <option value="<?php echo $choice_exe['table_name']; ?>"
                    <?php
                    if(isset($mother_data_from[$i]) &&
                       $mother_data_from[$i]==$choice_exe['table_name'])
                    echo "selected";
                    ?>>

                    <?php echo $choice_exe['profession_name']; ?>

                </option>

                <?php } ?>

            </select>

            <br>

            <select class="form-control motherSelect"
                    name="mother[]"
                    style="display:none;">
            </select>

        </div>

        <input type="text"
               name="mother[]"
               class="form-control motherTextbox"
               placeholder="Enter Mother"
               value="<?php echo isset($mother_name[$i]) ? $mother_name[$i] : ''; ?>">

    </div>

    <!-- Mother / Step Mother -->

    <div class="form-group">

        <label>Relation</label>

        <select class="form-control"
                name="real_step_mother[]">

            <option value="<?php echo isset($mother_relation[$i]) ? $mother_relation[$i] : 'Mother'; ?>">
                <?php echo isset($mother_relation[$i]) ? $mother_relation[$i] : 'Mother'; ?>
            </option>

            <option value="Mother">Mother</option>
            <option value="Step Mother">Step Mother</option>

        </select>

    </div>

    <!-- Date Of Birth -->

    <label>Date Of Birth</label>

    <div class="row">

        <div class="col-md-4">

            <input type="text"
                   class="form-control"
                   name="motherDOB_date[]"
                   value="<?php echo isset($mother_birth_date[$i]) ? $mother_birth_date[$i] : ''; ?>"
                   placeholder="Date">

        </div>

        <div class="col-md-4">

            <input type="text"
                   class="form-control"
                   name="motherDOB_month[]"
                   value="<?php echo isset($mother_birth_month[$i]) ? $mother_birth_month[$i] : ''; ?>"
                   placeholder="Month">

        </div>

        <div class="col-md-4">

            <input type="text"
                   class="form-control"
                   name="motherDOB_year[]"
                   value="<?php echo isset($mother_birth_year[$i]) ? $mother_birth_year[$i] : ''; ?>"
                   placeholder="Year">

        </div>

    </div>
    <!-- Date Of Death -->

    <label>Date Of Death</label>

    <div class="row">

        <div class="col-md-4">

            <input type="text"
                   class="form-control"
                   name="motherDOD_date[]"
                   value="<?php echo isset($mother_death_date[$i]) ? $mother_death_date[$i] : ''; ?>"
                   placeholder="Date">

        </div>

        <div class="col-md-4">

            <input type="text"
                   class="form-control"
                   name="motherDOD_month[]"
                   value="<?php echo isset($mother_death_month[$i]) ? $mother_death_month[$i] : ''; ?>"
                   placeholder="Month">

        </div>

        <div class="col-md-4">

            <input type="text"
                   class="form-control"
                   name="motherDOD_year[]"
                   value="<?php echo isset($mother_death_year[$i]) ? $mother_death_year[$i] : ''; ?>"
                   placeholder="Year">

        </div>

    </div>

</div>

<?php } ?>

</div>

<button type="button"
        class="btn btn-success mt-3"
        id="addMother">

    + Add Mother

</button>

</div>
<script>
$(function () {

    var count = $("#motherContainer .mother-section").length;

    /* ===========================
       Add Mother
    =========================== */

    $("#addMother").click(function () {

        count++;

        var clone = $("#motherContainer .mother-section:first").clone();

        // Clear all textboxes
        clone.find("input[type='text']").val("");

        // Reset selects
        clone.find("select").prop("selectedIndex", 0);

        // Hide database section
        clone.find(".mother-db").hide();

        // Reset database dropdown
        clone.find(".motherSelect")
            .hide()
            .html("")
            .prop("disabled", false);

        // Show manual textbox
        clone.find(".motherTextbox")
            .show()
            .prop("disabled", false);

        // Reset profession
        clone.find(".professionSelect").val("");

        // Heading
        clone.find("h4:first").text("Mother " + count);

        // Show remove button
        clone.find(".removeMother").show();

        $("#motherContainer").append(clone);

    });

    /* ===========================
       Remove Mother
    =========================== */

    $(document).on("click", ".removeMother", function () {

        $(this).closest(".mother-section").remove();

        count = 0;

        $("#motherContainer .mother-section").each(function () {

            count++;

            $(this).find("h4:first").text("Mother " + count);

            if (count == 1) {
                $(this).find(".removeMother").hide();
            } else {
                $(this).find(".removeMother").show();
            }

        });

    });

    /* ===========================
       Toggle Database
    =========================== */

    $(document).on("click", ".toggleMotherDb", function (e) {

        e.preventDefault();
        e.stopPropagation();

        var section = $(this).closest(".mother-section");

        section.find(".mother-db").stop(true, true).slideToggle();

        return false;

    });

    /* ===========================
       Load Mother From Database
    =========================== */

    $(document).on("change", ".professionSelect", function () {

        var section = $(this).closest(".mother-section");

        $.ajax({

            url: "ajax_data_bind.php",

            type: "POST",

            data: {
                professionSelect: $(this).val()
            },

            success: function (data) {

                section.find(".motherSelect")
                    .html(data)
                    .show();

            }

        });

    });

    /* ===========================
       Database Selection
    =========================== */

    $(document).on("change", ".motherSelect", function () {

        var section = $(this).closest(".mother-section");

        if ($(this).val() != "") {

            section.find(".motherTextbox")
                .hide()
                .prop("disabled", true);

            $(this)
                .show()
                .prop("disabled", false);

        }

    });

    /* ===========================
       Manual Entry
    =========================== */

    $(document).on("click", ".manualMotherEntry", function (e) {

        e.preventDefault();

        var section = $(this).closest(".mother-section");

        section.find(".motherTextbox")
            .show()
            .prop("disabled", false)
            .val("");

        section.find(".motherSelect")
            .hide()
            .prop("disabled", false)
            .html("");

        section.find(".professionSelect").val("");

        section.find(".mother-db").hide();

    });


});
</script>
<!-- ================= Mother Edit Block End ================= -->
    <br>
									<!--Mother Block End-->


                             

<br/>
							   <!--Spouse Block Start-->
							   <?php
$spouse_data_from     = explode(",", $row["spouse_data_from"]);
$spouse_name          = explode(",", $row["spouse"]);
$spouse_partner       = explode(",", $row["Spouse_Partner"]);

$marriage_date        = explode(",", $row["marriage_date"]);
$marriage_month       = explode(",", $row["marriage_month"]);
$marriage_year        = explode(",", $row["marriage_year"]);

$separation_date      = explode(",", $row["separation_date"]);
$separation_month     = explode(",", $row["separation_month"]);
$separation_year      = explode(",", $row["separation_year"]);

$divorce_date         = explode(",", $row["divorce_date"]);
$divorce_month        = explode(",", $row["divorce_month"]);
$divorce_year         = explode(",", $row["divorce_year"]);

$spouseDOD_date       = explode(",", $row["spouseDOD_date"]);
$spouseDOD_month      = explode(",", $row["spouseDOD_month"]);
$spouseDOD_year       = explode(",", $row["spouseDOD_year"]);

$total_son            = explode(",", $row["total_son"]);
$total_Daughter       = explode(",", $row["total_Daughter"]);
$spouse_total_children= explode(",", $row["spouse_total_children"]);
?>

<div id="Spouse" style="display:block;border:1px solid #000;padding:14px;">

  

    <div id="spouseContainer">

        <?php
        $totalSpouse=max(
            count($spouse_name),
            1
        );

        for($i=0;$i<$totalSpouse;$i++){
        ?>

        <div class="spouse-section"
             style="border:1px solid #ddd;padding:15px;margin-bottom:20px;">

            <button type="button"
                    class="btn btn-danger btn-sm removeSpouse"
                    <?php if($i==0){?>style="display:none"<?php }?>>
                Remove
            </button>

            <h4>Spouse <?php echo $i+1;?></h4>

            <hr>

            <input type="hidden"
                   class="spousePartnerHidden"
                   name="spouse_partner[]"
                   value="<?php echo $spouse_partner[$i] ?? ''; ?>">

            <div class="radio-group">

                <h4>Spouse / Partner</h4>

                <label>

                    <input type="radio"
                           class="partnerRadio"
                           value="Spouse"
                           <?php if(($spouse_partner[$i] ?? '')=="Spouse") echo "checked";?>>

                    Spouse

                </label>

                &nbsp;&nbsp;

                <label>

                    <input type="radio"
                           class="partnerRadio"
                           value="Partner"
                           <?php if(($spouse_partner[$i] ?? '')=="Partner") echo "checked";?>>

                    Partner

                </label>

            </div>

            <br>

            <label>Spouse Name</label>

            <a href="#" class="toggleSpouseDb">
                Select Data From Database
            </a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" class="manualEntrySpouse">
                    Manual Entry
                </a>
            <div class="spouse-db" style="display:none;margin-top:10px;">

                <select class="form-control professionSelect"
                        name="spouse_name_choice_profesion[]">

                    <option value="">
                        -Select Profession-
                    </option>

                    <?php
                    $choice=mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");

                    while($choice_exe=mysqli_fetch_array($choice)){
                    ?>

                    <option
                        value="<?php echo $choice_exe['table_name'];?>"

                        <?php
                        if(($spouse_data_from[$i] ?? '')==$choice_exe['table_name'])
                            echo "selected";
                        ?>>

                        <?php echo $choice_exe['profession_name'];?>

                    </option>

                    <?php } ?>

                </select>

                <br>

                <select class="form-control spouseSelect"
                        name="spouse[]"
                        style="display:none;">
                </select>

                <br>


            </div>

            <input type="text"
                   class="form-control spouseTextbox"
                   name="spouse[]"
                   value="<?php echo $spouse_name[$i] ?? ''; ?>"
                   placeholder="Enter Spouse">

            <br>

            <h4><b>Marriage Date</b></h4>

            <label>Date</label>

            <input type="text"
                   name="marriage_date[]"
                   value="<?php echo $marriage_date[$i] ?? ''; ?>">

            <label>Month</label>

            <input type="text"
                   name="marriage_month[]"
                   value="<?php echo $marriage_month[$i] ?? ''; ?>">

            <label>Year</label>

            <input type="text"
                   name="marriage_year[]"
                   value="<?php echo $marriage_year[$i] ?? ''; ?>">
                               <br><br>

            <h4><b>Separation Date</b></h4>

            <label>Date</label>
            <input type="text"
                   name="separation_date[]"
                   value="<?php echo $separation_date[$i] ?? ''; ?>">

            <label>Month</label>
            <input type="text"
                   name="separation_month[]"
                   value="<?php echo $separation_month[$i] ?? ''; ?>">

            <label>Year</label>
            <input type="text"
                   name="separation_year[]"
                   value="<?php echo $separation_year[$i] ?? ''; ?>">

            <br><br>

            <h4><b>Divorce Date</b></h4>

            <label>Date</label>
            <input type="text"
                   name="divorce_date[]"
                   value="<?php echo $divorce_date[$i] ?? ''; ?>">

            <label>Month</label>
            <input type="text"
                   name="divorce_month[]"
                   value="<?php echo $divorce_month[$i] ?? ''; ?>">

            <label>Year</label>
            <input type="text"
                   name="divorce_year[]"
                   value="<?php echo $divorce_year[$i] ?? ''; ?>">

            <br><br>

            <h4><b>Date Of Death</b></h4>

            <label>Date</label>
            <input type="text"
                   name="spouseDOD_date[]"
                   value="<?php echo $spouseDOD_date[$i] ?? ''; ?>">

            <label>Month</label>
            <input type="text"
                   name="spouseDOD_month[]"
                   value="<?php echo $spouseDOD_month[$i] ?? ''; ?>">

            <label>Year</label>
            <input type="text"
                   name="spouseDOD_year[]"
                   value="<?php echo $spouseDOD_year[$i] ?? ''; ?>">

            <br><br>

            <h4><b>No. Of Children</b></h4>

            <div class="form-group">

                <label>Son</label>

                <input type="text"
                       class="form-control"
                       name="total_son[]"
                       value="<?php echo $total_son[$i] ?? ''; ?>"
                       placeholder="No. of Son">

            </div>

            <div class="form-group">

                <label>Daughter</label>

                <input type="text"
                       class="form-control"
                       name="total_Daughter[]"
                       value="<?php echo $total_Daughter[$i] ?? ''; ?>"
                       placeholder="No. of Daughter">

            </div>

            <div class="form-group">

                <label>Spouse / Partner Total No. Of Children</label>

                <input type="text"
                       class="form-control"
                       name="spouse_total_children[]"
                       value="<?php echo $spouse_total_children[$i] ?? ''; ?>"
                       placeholder="Total Children">

            </div>

        </div>

        <?php } ?>
      

    </div>
    <button type="button"
            class="btn btn-success"
            id="addSpouse">
        Add More Spouse
    </button>

    <br><br>
</div>
<script>
/* ===========================
   Edit Spouse Initialization
=========================== */

$(function () {

    var count = $("#spouseContainer .spouse-section").length;

    if (count == 0) count = 1;

    /* ===========================
       Add More Spouse
    ============================ */

    $("#addSpouse").click(function () {

        count++;

        var clone = $("#spouseContainer .spouse-section:first").clone();

        // Clear textboxes
        clone.find("input[type='text']").val("");

        // Reset hidden spouse/partner
        clone.find(".spousePartnerHidden").val("");

        // Uncheck radio buttons
        clone.find(".partnerRadio").prop("checked", false);

        // Reset selects
        clone.find("select").prop("selectedIndex", 0);

        // Hide database section
        clone.find(".spouse-db").hide();

        // Reset database dropdown
        clone.find(".spouseSelect")
            .hide()
            .html("")
            .prop("disabled", false);

        // Show manual textbox
        clone.find(".spouseTextbox")
            .show()
            .prop("disabled", false);

        // Reset profession
        clone.find(".professionSelect").val("");

        // Heading
        clone.find("h4:first").text("Spouse " + count);

        // Show remove button
        clone.find(".removeSpouse").show();

        $("#spouseContainer").append(clone);

    });

    /* ===========================
       Remove Spouse
    ============================ */

    $(document).on("click", ".removeSpouse", function () {

        $(this).closest(".spouse-section").remove();

        count = 0;

        $("#spouseContainer .spouse-section").each(function () {

            count++;

            $(this).find("h4:first").text("Spouse " + count);

            if (count == 1) {
                $(this).find(".removeSpouse").hide();
            } else {
                $(this).find(".removeSpouse").show();
            }

        });

    });

});


/* ===========================
   Toggle Database
=========================== */

$(document).on("click", ".toggleSpouseDb", function (e) {

    e.preventDefault();

    var section = $(this).closest(".spouse-section");

    section.find(".spouse-db")
        .stop(true, true)
        .slideToggle();

});


/* ===========================
   Profession Change
=========================== */

$(document).on("change", ".professionSelect", function () {

    var section = $(this).closest(".spouse-section");

    $.ajax({

        url: "ajax_data_bind.php",

        type: "POST",

        data: {

            professionSelect: $(this).val()

        },

        success: function (data) {

            section.find(".spouseSelect")
                .html(data)
                .show();

        }

    });

});


/* ===========================
   Database Name Selected
=========================== */

$(document).on("change", ".spouseSelect", function () {

    var section = $(this).closest(".spouse-section");

    if ($(this).val() != "") {

        section.find(".spouseTextbox")
            .hide()
            .prop("disabled", true);

        $(this)
            .show()
            .prop("disabled", false);

    }

});


/* ===========================
   Manual Entry
=========================== */

$(document).on("click", ".manualEntrySpouse", function (e) {

    e.preventDefault();

    var section = $(this).closest(".spouse-section");

    section.find(".spouseTextbox")
        .show()
        .prop("disabled", false)
        .val("");

    section.find(".spouseSelect")
        .hide()
        .prop("disabled", false)
        .html("");

    section.find(".professionSelect").val("");

    section.find(".spouse-db").hide();

});


/* ===========================
   Spouse / Partner Radio
=========================== */

$(document).on("change", ".partnerRadio", function () {

    var section = $(this).closest(".spouse-section");

    section.find(".spousePartnerHidden").val($(this).val());

});
</script>
							   <!--Spouse Block End-->
									<br/>

							  
							<!--Son Block Start-->
							<?php
$son_data_from      = explode(",", $row["son_data_from"]);
$son_name           = explode(",", $row["son"]);
$son_mother_father  = explode(",", $row["son_mother_father"]);
$son_relation       = explode(",", $row["son_relation"]);
$sonDOB_date        = explode(",", $row["sonDOB_date"]);
$sonDOB_month       = explode(",", $row["sonDOB_month"]);
$sonDOB_year        = explode(",", $row["sonDOB_year"]);
$sonDOD_date        = explode(",", $row["sonDOD_date"]);
$sonDOD_month       = explode(",", $row["sonDOD_month"]);
$sonDOD_year        = explode(",", $row["sonDOD_year"]);

$totalSon = max(
    count($son_name),
    count($son_data_from),
    count($son_relation)
);

if ($totalSon == 0) {
    $totalSon = 1;
}
?>

<div id="son" style="display:block;border:1px solid #000;padding:15px;">

    <h3 class="mb-3">Son Details</h3>

    <div id="sonContainer">

        <?php for($i=0;$i<$totalSon;$i++){ ?>

        <div class="son-section card mb-3">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h4>Son <?php echo ($i+1); ?></h4>

                    <button type="button"
                            class="btn btn-danger btn-sm removeSon"
                            <?php if($i==0 && $totalSon==1){ ?>style="display:none"<?php } ?>>
                        Remove
                    </button>

                </div>

                <input type="hidden"
                       name="son_mother_father_hidden[]"
                       class="sonParentHidden"
                       value="<?php echo isset($son_mother_father[$i]) ? $son_mother_father[$i] : ''; ?>">

                <div class="form-group">

                    <a href="javascript:void(0)" class="toggleSonDb">
                        Select Data From Database
                    </a>
&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:void(0)"
                           class="manualSon btn btn-sm btn-secondary">

                            Manual Entry

                        </a>

                    <div class="son-db mt-2" style="display:none;">

                        <select class="form-control professionSelect"
                                name="son_name_choice_profesion[]">

                            <option value="">
                                -Select Profession-
                            </option>

                            <?php
                            $choice=mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");

                            while($choice_exe=mysqli_fetch_array($choice)){
                            ?>

                            <option
                                value="<?php echo $choice_exe['table_name'];?>"
                                <?php
                                if(isset($son_data_from[$i]) &&
                                   $son_data_from[$i]==$choice_exe['table_name'])
                                    echo "selected";
                                ?>>

                                <?php echo $choice_exe['profession_name'];?>

                            </option>

                            <?php } ?>

                        </select>

                        <br>

                        <select class="form-control sonSelect"
                                name="son[]"
                                style="<?php echo !empty($son_data_from[$i])?'':'display:none';?>">

                        </select>

                        <br>

                       
                    </div>

                    <input type="text"
                           class="form-control sonTextbox mt-2"
                           name="son[]"
                           placeholder="Enter Son Name"
                           value="<?php echo isset($son_name[$i]) ? htmlspecialchars($son_name[$i]) : ''; ?>">

                </div>

                <hr>

                <div class="form-group">

                    <label><strong>Father / Mother</strong></label>

                    <br>

                    <label>

                        <input type="radio"
                               name="son_parent_<?php echo $i;?>"
                               value="Father"
                               <?php
                               if(isset($son_mother_father[$i]) &&
                                  $son_mother_father[$i]=='Father')
                                  echo 'checked';
                               ?>>

                        Father

                    </label>

                    &nbsp;&nbsp;

                    <label>

                        <input type="radio"
                               name="son_parent_<?php echo $i;?>"
                               value="Mother"
                               <?php
                               if(isset($son_mother_father[$i]) &&
                                  $son_mother_father[$i]=='Mother')
                                  echo 'checked';
                               ?>>

                        Mother

                    </label>

                </div>

                <div class="form-group">

                    <label>Father / Mother Name</label>

                    <input type="text"
                           class="form-control"
                           name="son_relation[]"
                           value="<?php echo isset($son_relation[$i]) ? htmlspecialchars($son_relation[$i]) : ''; ?>">

                </div>
                                <hr>

                <h5><strong>Date of Birth</strong></h5>

                <div class="row">

                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="text"
                               class="form-control"
                               name="sonDOB_date[]"
                               value="<?php echo isset($sonDOB_date[$i]) ? $sonDOB_date[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Month</label>
                        <input type="text"
                               class="form-control"
                               name="sonDOB_month[]"
                               value="<?php echo isset($sonDOB_month[$i]) ? $sonDOB_month[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Year</label>
                        <input type="text"
                               class="form-control"
                               name="sonDOB_year[]"
                               value="<?php echo isset($sonDOB_year[$i]) ? $sonDOB_year[$i] : ''; ?>">
                    </div>

                </div>

                <br>

                <h5><strong>Date of Death</strong></h5>

                <div class="row">

                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="text"
                               class="form-control"
                               name="sonDOD_date[]"
                               value="<?php echo isset($sonDOD_date[$i]) ? $sonDOD_date[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Month</label>
                        <input type="text"
                               class="form-control"
                               name="sonDOD_month[]"
                               value="<?php echo isset($sonDOD_month[$i]) ? $sonDOD_month[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Year</label>
                        <input type="text"
                               class="form-control"
                               name="sonDOD_year[]"
                               value="<?php echo isset($sonDOD_year[$i]) ? $sonDOD_year[$i] : ''; ?>">
                    </div>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

    <button type="button"
            class="btn btn-success"
            id="addSon">

        <i class="fa fa-plus"></i> Add More Son

    </button>

</div>
<script>

$(function () {

    var count = $("#sonContainer .son-section").length;

    if (count == 0) count = 1;

    /*==========================
      Add Son
    ==========================*/

    $("#addSon").click(function () {

        count++;

        var clone = $("#sonContainer .son-section:first").clone();

        /* Clear textboxes */
        clone.find("input[type='text']").val("");

        /* Reset hidden value */
        clone.find(".sonParentHidden").val("");

        /* Reset selects */
        clone.find("select").prop("selectedIndex", 0);

        clone.find(".sonSelect")
            .hide()
            .html("")
            .prop("disabled", false);

        clone.find(".professionSelect").val("");

        /* Show textbox */
        clone.find(".sonTextbox")
            .show()
            .prop("disabled", false)
            .val("");

        /* Hide database area */
        clone.find(".son-db").hide();

        /* Reset radio buttons */
        clone.find("input[type='radio']").prop("checked", false);

        /* Heading */
        clone.find("h4:first").text("Son " + count);

        /* Show remove button */
        clone.find(".removeSon").show();

        $("#sonContainer").append(clone);

    });


    /*==========================
      Remove Son
    ==========================*/

    $(document).on("click", ".removeSon", function () {

        $(this).closest(".son-section").remove();

        count = 0;

        $("#sonContainer .son-section").each(function () {

            count++;

            $(this).find("h4:first").text("Son " + count);

            if (count == 1) {
                $(this).find(".removeSon").hide();
            } else {
                $(this).find(".removeSon").show();
            }

        });

    });


    /*==========================
      Toggle Database
    ==========================*/

    $(document).on("click", ".toggleSonDb", function (e) {

        e.preventDefault();

        var section = $(this).closest(".son-section");

        section.find(".son-db")
            .stop(true, true)
            .slideToggle();

    });


    /*==========================
      Load Profession
    ==========================*/

    $(document).on("change", ".professionSelect", function () {

        var section = $(this).closest(".son-section");

        $.ajax({

            url: "ajax_data_bind.php",

            type: "POST",

            data: {
                professionSelect: $(this).val()
            },

            success: function (data) {

                section.find(".sonSelect")
                    .html(data)
                    .show();

            }

        });

    });


    /*==========================
      Database Selection
    ==========================*/

    $(document).on("change", ".sonSelect", function () {

        var section = $(this).closest(".son-section");

        if ($(this).val() != "") {

            section.find(".sonTextbox")
                .hide()
                .prop("disabled", true);

            $(this)
                .show()
                .prop("disabled", false);

        }

    });


    /*==========================
      Manual Entry
    ==========================*/

    $(document).on("click", ".manualSon", function (e) {

        e.preventDefault();

        var section = $(this).closest(".son-section");

        section.find(".sonTextbox")
            .show()
            .prop("disabled", false)
            .val("");

        section.find(".sonSelect")
            .hide()
            .html("")
            .prop("disabled", false);

        section.find(".professionSelect").val("");

        section.find(".son-db").hide();

    });


    /*==========================
      Father/Mother Radio
    ==========================*/

    $(document).on("change", ".son-section input[type='radio']", function () {

        var section = $(this).closest(".son-section");

        section.find(".sonParentHidden").val($(this).val());

    });

});

</script>
							<!--Son Block End-->
							  <br/>
							  <!--Dauther Block Start-->
							  <!--Daughter Block Start-->

<?php

$daughter_data_from      = explode(",", $row["daughter_data_from"]);
$daughter_name           = explode(",", $row["daughter"]);
$daughter_mother_father  = explode(",", $row["daughter_mother_father"]);
$daughter_relation       = explode(",", $row["daughter_relation"]);
$daughterDOB_date        = explode(",", $row["daughterDOB_date"]);
$daughterDOB_month       = explode(",", $row["daughterDOB_month"]);
$daughterDOB_year        = explode(",", $row["daughterDOB_year"]);
$daughterDOD_date        = explode(",", $row["daughterDOD_date"]);
$daughterDOD_month       = explode(",", $row["daughterDOD_month"]);
$daughterDOD_year        = explode(",", $row["daughterDOD_year"]);

$totalDaughter = max(
    count($daughter_name),
    count($daughter_data_from),
    count($daughter_relation)
);

if ($totalDaughter == 0) {
    $totalDaughter = 1;
}

?>

<div id="daughter" style="display:block;border:1px solid #000;padding:15px;">

    <h3 class="mb-3">Daughter Details</h3>

    <div id="daughterContainer">

        <?php for($i=0;$i<$totalDaughter;$i++){ ?>

        <div class="daughter-section card mb-3">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h4>Daughter <?php echo ($i+1); ?></h4>

                    <button type="button"
                            class="btn btn-danger btn-sm removeDaughter"
                            <?php if($i==0 && $totalDaughter==1){ ?>style="display:none"<?php } ?>>
                        Remove
                    </button>

                </div>

                <input type="hidden"
                       name="daughter_mother_father_hidden[]"
                       class="daughterParentHidden"
                       value="<?php echo isset($daughter_mother_father[$i]) ? $daughter_mother_father[$i] : ''; ?>">

                <div class="form-group">

                    <a href="javascript:void(0)" class="toggleDaughterDb">
                        Select Data From Database
                    </a>

                    &nbsp;&nbsp;&nbsp;&nbsp;

                    <a href="javascript:void(0)"
                       class="manualDaughter btn btn-sm btn-secondary">
                        Manual Entry
                    </a>

                    <div class="daughter-db mt-2" style="display:none;">

                        <select class="form-control professionSelectDaughter"
                                name="daughter_name_choice_profesion[]">

                            <option value="">
                                -Select Profession-
                            </option>

                            <?php
                            $choice=mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");
                            while($choice_exe=mysqli_fetch_array($choice)){
                            ?>

                            <option
                                value="<?php echo $choice_exe['table_name'];?>"
                                <?php
                                if(isset($daughter_data_from[$i]) &&
                                   $daughter_data_from[$i]==$choice_exe['table_name'])
                                    echo "selected";
                                ?>>
                                <?php echo $choice_exe['profession_name'];?>
                            </option>

                            <?php } ?>

                        </select>

                        <br>

                        <select class="form-control daughterSelect"
                                name="daughter[]"
                                style="<?php echo !empty($daughter_data_from[$i])?'':'display:none';?>">

                        </select>

                        <br>

                    </div>

                    <input type="text"
                           class="form-control daughterTextbox mt-2"
                           name="daughter[]"
                           placeholder="Enter Daughter Name"
                           value="<?php echo isset($daughter_name[$i]) ? htmlspecialchars($daughter_name[$i]) : ''; ?>">

                </div>

                <hr>

                <div class="form-group">

                    <label><strong>Father / Mother</strong></label>

                    <br>

                    <label>

                        <input type="radio"
                               name="daughter_parent_<?php echo $i;?>"
                               value="Father"
                               <?php
                               if(isset($daughter_mother_father[$i]) &&
                                  $daughter_mother_father[$i]=='Father')
                                  echo 'checked';
                               ?>>

                        Father

                    </label>

                    &nbsp;&nbsp;

                    <label>

                        <input type="radio"
                               name="daughter_parent_<?php echo $i;?>"
                               value="Mother"
                               <?php
                               if(isset($daughter_mother_father[$i]) &&
                                  $daughter_mother_father[$i]=='Mother')
                                  echo 'checked';
                               ?>>

                        Mother

                    </label>

                </div>

                <div class="form-group">

                    <label>Father / Mother Name</label>

                    <input type="text"
                           class="form-control"
                           name="daughter_relation[]"
                           value="<?php echo isset($daughter_relation[$i]) ? htmlspecialchars($daughter_relation[$i]) : ''; ?>">

                </div>

                <hr>
                                <h5><strong>Date of Birth</strong></h5>

                <div class="row">

                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="text"
                               class="form-control"
                               name="daughterDOB_date[]"
                               value="<?php echo isset($daughterDOB_date[$i]) ? $daughterDOB_date[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Month</label>
                        <input type="text"
                               class="form-control"
                               name="daughterDOB_month[]"
                               value="<?php echo isset($daughterDOB_month[$i]) ? $daughterDOB_month[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Year</label>
                        <input type="text"
                               class="form-control"
                               name="daughterDOB_year[]"
                               value="<?php echo isset($daughterDOB_year[$i]) ? $daughterDOB_year[$i] : ''; ?>">
                    </div>

                </div>

                <br>

                <h5><strong>Date of Death</strong></h5>

                <div class="row">

                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="text"
                               class="form-control"
                               name="daughterDOD_date[]"
                               value="<?php echo isset($daughterDOD_date[$i]) ? $daughterDOD_date[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Month</label>
                        <input type="text"
                               class="form-control"
                               name="daughterDOD_month[]"
                               value="<?php echo isset($daughterDOD_month[$i]) ? $daughterDOD_month[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Year</label>
                        <input type="text"
                               class="form-control"
                               name="daughterDOD_year[]"
                               value="<?php echo isset($daughterDOD_year[$i]) ? $daughterDOD_year[$i] : ''; ?>">
                    </div>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

    <button type="button"
            class="btn btn-success"
            id="addDaughter">

        <i class="fa fa-plus"></i> Add More Daughter

    </button>

</div>

<script>

$(function () {

    var count = $("#daughterContainer .daughter-section").length;

    if (count == 0) count = 1;

    /*==========================
      Add Daughter
    ==========================*/

    $("#addDaughter").click(function () {

        count++;

        var clone = $("#daughterContainer .daughter-section:first").clone();

        clone.find("input[type='text']").val("");

        clone.find(".daughterParentHidden").val("");

        clone.find("select").prop("selectedIndex", 0);

        clone.find(".daughterSelect")
            .hide()
            .html("")
            .prop("disabled", false);

        clone.find(".professionSelectDaughter").val("");

        clone.find(".daughterTextbox")
            .show()
            .prop("disabled", false)
            .val("");

        clone.find(".daughter-db").hide();

        clone.find("input[type='radio']").prop("checked", false);

        clone.find("h4:first").text("Daughter " + count);

        clone.find(".removeDaughter").show();

        $("#daughterContainer").append(clone);

    });
        /*==========================
      Remove Daughter
    ==========================*/

    $(document).on("click", ".removeDaughter", function () {

        $(this).closest(".daughter-section").remove();

        count = 0;

        $("#daughterContainer .daughter-section").each(function () {

            count++;

            $(this).find("h4:first").text("Daughter " + count);

            if (count == 1) {
                $(this).find(".removeDaughter").hide();
            } else {
                $(this).find(".removeDaughter").show();
            }

        });

    });


    /*==========================
      Toggle Database
    ==========================*/

    $(document).on("click", ".toggleDaughterDb", function (e) {

        e.preventDefault();

        var section = $(this).closest(".daughter-section");

        section.find(".daughter-db")
            .stop(true, true)
            .slideToggle();

    });


    /*==========================
      Load Profession
    ==========================*/

    $(document).on("change", ".professionSelectDaughter", function () {

        var section = $(this).closest(".daughter-section");

        $.ajax({

            url: "ajax_data_bind.php",

            type: "POST",

            data: {
                professionSelect: $(this).val()
            },

            success: function (data) {

                section.find(".daughterSelect")
                    .html(data)
                    .show();

            }

        });

    });


    /*==========================
      Database Selection
    ==========================*/

    $(document).on("change", ".daughterSelect", function () {

        var section = $(this).closest(".daughter-section");

        if ($(this).val() != "") {

            section.find(".daughterTextbox")
                .hide()
                .prop("disabled", true);

            $(this)
                .show()
                .prop("disabled", false);

        }

    });


    /*==========================
      Manual Entry
    ==========================*/

    $(document).on("click", ".manualDaughter", function (e) {

        e.preventDefault();

        var section = $(this).closest(".daughter-section");

        section.find(".daughterTextbox")
            .show()
            .prop("disabled", false)
            .val("");

        section.find(".daughterSelect")
            .hide()
            .html("")
            .prop("disabled", false);

        section.find(".professionSelectDaughter").val("");

        section.find(".daughter-db").hide();

    });


    /*==========================
      Father / Mother Radio
    ==========================*/

    $(document).on("change", ".daughter-section input[type='radio']", function () {

        var section = $(this).closest(".daughter-section");

        section.find(".daughterParentHidden").val($(this).val());

    });

});
</script>


							  <!--Dauther Block End-->
						
									<br/>
									 <!--Brother Block Start-->
									 <!--Brother Block Start-->

<?php

$brother_data_from      = explode(",", $row["brother_data_from"]);
$brother_name           = explode(",", $row["brother"]);
$brother_mother_father  = explode(",", $row["brother_mother_father"]);
$brother_relation       = explode(",", $row["brother_relation"]);
$brotherDOB_date        = explode(",", $row["brotherDOB_date"]);
$brotherDOB_month       = explode(",", $row["brotherDOB_month"]);
$brotherDOB_year        = explode(",", $row["brotherDOB_year"]);
$brotherDOD_date        = explode(",", $row["brotherDOD_date"]);
$brotherDOD_month       = explode(",", $row["brotherDOD_month"]);
$brotherDOD_year        = explode(",", $row["brotherDOD_year"]);

$totalBrother = max(
    count($brother_name),
    count($brother_data_from),
    count($brother_relation)
);

if ($totalBrother == 0) {
    $totalBrother = 1;
}

?>

<div id="brother" style="display:block;border:1px solid #000;padding:15px;">

    <h3 class="mb-3">Brother Details</h3>

    <div id="brotherContainer">

        <?php for($i=0;$i<$totalBrother;$i++){ ?>

        <div class="brother-section card mb-3">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h4>Brother <?php echo ($i+1); ?></h4>

                    <button type="button"
                            class="btn btn-danger btn-sm removeBrother"
                            <?php if($i==0 && $totalBrother==1){ ?>style="display:none"<?php } ?>>
                        Remove
                    </button>

                </div>

                <input type="hidden"
                       name="brother_mother_father_hidden[]"
                       class="brotherParentHidden"
                       value="<?php echo isset($brother_mother_father[$i]) ? $brother_mother_father[$i] : ''; ?>">

                <div class="form-group">

                    <a href="javascript:void(0)" class="toggleBrotherDb">
                        Select Data From Database
                    </a>

                    &nbsp;&nbsp;&nbsp;&nbsp;

                    <a href="javascript:void(0)"
                       class="manualBrother btn btn-sm btn-secondary">
                        Manual Entry
                    </a>

                    <div class="brother-db mt-2" style="display:none;">

                        <select class="form-control professionSelectBrother"
                                name="brother_name_choice_profesion[]">

                            <option value="">
                                -Select Profession-
                            </option>

                            <?php
                            $choice=mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");
                            while($choice_exe=mysqli_fetch_array($choice)){
                            ?>

                            <option
                                value="<?php echo $choice_exe['table_name'];?>"
                                <?php
                                if(isset($brother_data_from[$i]) &&
                                   $brother_data_from[$i]==$choice_exe['table_name'])
                                    echo "selected";
                                ?>>
                                <?php echo $choice_exe['profession_name'];?>
                            </option>

                            <?php } ?>

                        </select>

                        <br>

                        <select class="form-control brotherSelect"
                                name="brother[]"
                                style="<?php echo !empty($brother_data_from[$i])?'':'display:none';?>">

                        </select>

                        <br>

                    </div>

                    <input type="text"
                           class="form-control brotherTextbox mt-2"
                           name="brother[]"
                           placeholder="Enter Brother Name"
                           value="<?php echo isset($brother_name[$i]) ? htmlspecialchars($brother_name[$i]) : ''; ?>">

                </div>

                <hr>

                <div class="form-group">

                    <label><strong>Father / Mother</strong></label>

                    <br>

                    <label>

                        <input type="radio"
                               name="brother_parent_<?php echo $i;?>"
                               value="Father"
                               <?php
                               if(isset($brother_mother_father[$i]) &&
                                  $brother_mother_father[$i]=='Father')
                                  echo 'checked';
                               ?>>

                        Father

                    </label>

                    &nbsp;&nbsp;

                    <label>

                        <input type="radio"
                               name="brother_parent_<?php echo $i;?>"
                               value="Mother"
                               <?php
                               if(isset($brother_mother_father[$i]) &&
                                  $brother_mother_father[$i]=='Mother')
                                  echo 'checked';
                               ?>>

                        Mother

                    </label>

                </div>

                <div class="form-group">

                    <label>Father / Mother Name</label>

                    <input type="text"
                           class="form-control"
                           name="brother_relation[]"
                           value="<?php echo isset($brother_relation[$i]) ? htmlspecialchars($brother_relation[$i]) : ''; ?>">

                </div>

                <hr>
                                <h5><strong>Date of Birth</strong></h5>

                <div class="row">

                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="text"
                               class="form-control"
                               name="brotherDOB_date[]"
                               value="<?php echo isset($brotherDOB_date[$i]) ? $brotherDOB_date[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Month</label>
                        <input type="text"
                               class="form-control"
                               name="brotherDOB_month[]"
                               value="<?php echo isset($brotherDOB_month[$i]) ? $brotherDOB_month[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Year</label>
                        <input type="text"
                               class="form-control"
                               name="brotherDOB_year[]"
                               value="<?php echo isset($brotherDOB_year[$i]) ? $brotherDOB_year[$i] : ''; ?>">
                    </div>

                </div>

                <br>

                <h5><strong>Date of Death</strong></h5>

                <div class="row">

                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="text"
                               class="form-control"
                               name="brotherDOD_date[]"
                               value="<?php echo isset($brotherDOD_date[$i]) ? $brotherDOD_date[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Month</label>
                        <input type="text"
                               class="form-control"
                               name="brotherDOD_month[]"
                               value="<?php echo isset($brotherDOD_month[$i]) ? $brotherDOD_month[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Year</label>
                        <input type="text"
                               class="form-control"
                               name="brotherDOD_year[]"
                               value="<?php echo isset($brotherDOD_year[$i]) ? $brotherDOD_year[$i] : ''; ?>">
                    </div>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

    <button type="button"
            class="btn btn-success"
            id="addBrother">

        <i class="fa fa-plus"></i> Add More Brother

    </button>

</div>

<script>

$(function () {

    var count = $("#brotherContainer .brother-section").length;

    if (count == 0) count = 1;

    /*==========================
      Add Brother
    ==========================*/

    $("#addBrother").click(function () {

        count++;

        var clone = $("#brotherContainer .brother-section:first").clone();

        clone.find("input[type='text']").val("");

        clone.find(".brotherParentHidden").val("");

        clone.find("select").prop("selectedIndex", 0);

        clone.find(".brotherSelect")
            .hide()
            .html("")
            .prop("disabled", false);

        clone.find(".professionSelectBrother").val("");

        clone.find(".brotherTextbox")
            .show()
            .prop("disabled", false)
            .val("");

        clone.find(".brother-db").hide();

        clone.find("input[type='radio']").prop("checked", false);

        clone.find("h4:first").text("Brother " + count);

        clone.find(".removeBrother").show();

        $("#brotherContainer").append(clone);

    });
        /*==========================
      Remove Brother
    ==========================*/

    $(document).on("click", ".removeBrother", function () {

        $(this).closest(".brother-section").remove();

        count = 0;

        $("#brotherContainer .brother-section").each(function () {

            count++;

            $(this).find("h4:first").text("Brother " + count);

            if (count == 1) {
                $(this).find(".removeBrother").hide();
            } else {
                $(this).find(".removeBrother").show();
            }

        });

    });


    /*==========================
      Toggle Database
    ==========================*/

    $(document).on("click", ".toggleBrotherDb", function (e) {

        e.preventDefault();

        var section = $(this).closest(".brother-section");

        section.find(".brother-db")
            .stop(true, true)
            .slideToggle();

    });


    /*==========================
      Load Profession
    ==========================*/

    $(document).on("change", ".professionSelectBrother", function () {

        var section = $(this).closest(".brother-section");

        $.ajax({

            url: "ajax_data_bind.php",

            type: "POST",

            data: {
                professionSelect: $(this).val()
            },

            success: function (data) {

                section.find(".brotherSelect")
                    .html(data)
                    .show();

            }

        });

    });


    /*==========================
      Database Selection
    ==========================*/

    $(document).on("change", ".brotherSelect", function () {

        var section = $(this).closest(".brother-section");

        if ($(this).val() != "") {

            section.find(".brotherTextbox")
                .hide()
                .prop("disabled", true);

            $(this)
                .show()
                .prop("disabled", false);

        }

    });


    /*==========================
      Manual Entry
    ==========================*/

    $(document).on("click", ".manualBrother", function (e) {

        e.preventDefault();

        var section = $(this).closest(".brother-section");

        section.find(".brotherTextbox")
            .show()
            .prop("disabled", false)
            .val("");

        section.find(".brotherSelect")
            .hide()
            .html("")
            .prop("disabled", false);

        section.find(".professionSelectBrother").val("");

        section.find(".brother-db").hide();

    });


    /*==========================
      Father / Mother Radio
    ==========================*/

    $(document).on("change", ".brother-section input[type='radio']", function () {

        var section = $(this).closest(".brother-section");

        section.find(".brotherParentHidden").val($(this).val());

    });

});
</script>

<!--Brother Block End-->
									
									 
									<br> 
									
									
									 <!--Sister Block Start-->

<?php

$sister_data_from      = explode(",", $row["sister_data_from"]);
$sister_name           = explode(",", $row["sister"]);
$sister_mother_father  = explode(",", $row["sister_mother_father"]);
$sister_relation       = explode(",", $row["sister_relation"]);
$sisterDOB_date        = explode(",", $row["sisterDOB_date"]);
$sisterDOB_month       = explode(",", $row["sisterDOB_month"]);
$sisterDOB_year        = explode(",", $row["sisterDOB_year"]);
$sisterDOD_date        = explode(",", $row["sisterDOD_date"]);
$sisterDOD_month       = explode(",", $row["sisterDOD_month"]);
$sisterDOD_year        = explode(",", $row["sisterDOD_year"]);

$totalSister = max(
    count($sister_name),
    count($sister_data_from),
    count($sister_relation)
);

if ($totalSister == 0) {
    $totalSister = 1;
}
?>

<div id="sister" style="display:block;border:1px solid #000;padding:15px;">

    <h3 class="mb-3">Sister Details</h3>

    <div id="sisterContainer">

        <?php for($i=0;$i<$totalSister;$i++){ ?>

        <div class="sister-section card mb-3">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h4>Sister <?php echo ($i+1); ?></h4>

                    <button type="button"
                            class="btn btn-danger btn-sm removeSister"
                            <?php if($i==0 && $totalSister==1){ ?>style="display:none"<?php } ?>>
                        Remove
                    </button>

                </div>

                <input type="hidden"
                       name="sister_mother_father_hidden[]"
                       class="sisterParentHidden"
                       value="<?php echo isset($sister_mother_father[$i]) ? $sister_mother_father[$i] : ''; ?>">

                <div class="form-group">

                    <a href="javascript:void(0)" class="toggleSisterDb">
                        Select Data From Database
                    </a>

                    &nbsp;&nbsp;&nbsp;&nbsp;

                    <a href="javascript:void(0)"
                       class="manualSister btn btn-sm btn-secondary">
                        Manual Entry
                    </a>

                    <div class="sister-db mt-2" style="display:none;">

                        <select class="form-control professionSelectSister"
                                name="sister_name_choice_profesion[]">

                            <option value="">
                                -Select Profession-
                            </option>

                            <?php
                            $choice=mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");
                            while($choice_exe=mysqli_fetch_array($choice)){
                            ?>

                            <option
                                value="<?php echo $choice_exe['table_name'];?>"
                                <?php
                                if(isset($sister_data_from[$i]) &&
                                   $sister_data_from[$i]==$choice_exe['table_name'])
                                    echo "selected";
                                ?>>
                                <?php echo $choice_exe['profession_name'];?>
                            </option>

                            <?php } ?>

                        </select>

                        <br>

                        <select class="form-control sisterSelect"
                                name="sister[]"
                                style="<?php echo !empty($sister_data_from[$i])?'':'display:none';?>">
                        </select>

                        <br>

                    </div>

                    <input type="text"
                           class="form-control sisterTextbox mt-2"
                           name="sister[]"
                           placeholder="Enter Sister Name"
                           value="<?php echo isset($sister_name[$i]) ? htmlspecialchars($sister_name[$i]) : ''; ?>">

                </div>

                <hr>

                <div class="form-group">

                    <label><strong>Father / Mother</strong></label>

                    <br>

                    <label>

                        <input type="radio"
                               name="sister_parent_<?php echo $i;?>"
                               value="Father"
                               <?php
                               if(isset($sister_mother_father[$i]) &&
                                  $sister_mother_father[$i]=='Father')
                                  echo 'checked';
                               ?>>

                        Father

                    </label>

                    &nbsp;&nbsp;

                    <label>

                        <input type="radio"
                               name="sister_parent_<?php echo $i;?>"
                               value="Mother"
                               <?php
                               if(isset($sister_mother_father[$i]) &&
                                  $sister_mother_father[$i]=='Mother')
                                  echo 'checked';
                               ?>>

                        Mother

                    </label>

                </div>

                <div class="form-group">

                    <label>Father / Mother Name</label>

                    <input type="text"
                           class="form-control"
                           name="sister_relation[]"
                           value="<?php echo isset($sister_relation[$i]) ? htmlspecialchars($sister_relation[$i]) : ''; ?>">

                </div>

                <hr>
                                <h5><strong>Date of Birth</strong></h5>

                <div class="row">

                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="text"
                               class="form-control"
                               name="sisterDOB_date[]"
                               value="<?php echo isset($sisterDOB_date[$i]) ? $sisterDOB_date[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Month</label>
                        <input type="text"
                               class="form-control"
                               name="sisterDOB_month[]"
                               value="<?php echo isset($sisterDOB_month[$i]) ? $sisterDOB_month[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Year</label>
                        <input type="text"
                               class="form-control"
                               name="sisterDOB_year[]"
                               value="<?php echo isset($sisterDOB_year[$i]) ? $sisterDOB_year[$i] : ''; ?>">
                    </div>

                </div>

                <br>

                <h5><strong>Date of Death</strong></h5>

                <div class="row">

                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="text"
                               class="form-control"
                               name="sisterDOD_date[]"
                               value="<?php echo isset($sisterDOD_date[$i]) ? $sisterDOD_date[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Month</label>
                        <input type="text"
                               class="form-control"
                               name="sisterDOD_month[]"
                               value="<?php echo isset($sisterDOD_month[$i]) ? $sisterDOD_month[$i] : ''; ?>">
                    </div>

                    <div class="col-md-4">
                        <label>Year</label>
                        <input type="text"
                               class="form-control"
                               name="sisterDOD_year[]"
                               value="<?php echo isset($sisterDOD_year[$i]) ? $sisterDOD_year[$i] : ''; ?>">
                    </div>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

    <button type="button"
            class="btn btn-success"
            id="addSister">

        <i class="fa fa-plus"></i> Add More Sister

    </button>

</div>

<script>

$(function () {

    var count = $("#sisterContainer .sister-section").length;

    if (count == 0) count = 1;

    /*==========================
      Add Sister
    ==========================*/

    $("#addSister").click(function () {

        count++;

        var clone = $("#sisterContainer .sister-section:first").clone();

        /* Clear textboxes */
        clone.find("input[type='text']").val("");

        /* Reset hidden value */
        clone.find(".sisterParentHidden").val("");

        /* Reset selects */
        clone.find("select").prop("selectedIndex", 0);

        clone.find(".sisterSelect")
            .hide()
            .html("")
            .prop("disabled", false);

        clone.find(".professionSelectSister").val("");

        /* Show textbox */
        clone.find(".sisterTextbox")
            .show()
            .prop("disabled", false)
            .val("");

        /* Hide database area */
        clone.find(".sister-db").hide();

        /* Reset radio buttons */
        clone.find("input[type='radio']").prop("checked", false);

        /* Heading */
        clone.find("h4:first").text("Sister " + count);

        /* Show remove button */
        clone.find(".removeSister").show();

        $("#sisterContainer").append(clone);

    });
        /*==========================
      Remove Sister
    ==========================*/

    $(document).on("click", ".removeSister", function () {

        $(this).closest(".sister-section").remove();

        count = 0;

        $("#sisterContainer .sister-section").each(function () {

            count++;

            $(this).find("h4:first").text("Sister " + count);

            if (count == 1) {
                $(this).find(".removeSister").hide();
            } else {
                $(this).find(".removeSister").show();
            }

        });

    });


    /*==========================
      Toggle Database
    ==========================*/

    $(document).on("click", ".toggleSisterDb", function (e) {

        e.preventDefault();

        var section = $(this).closest(".sister-section");

        section.find(".sister-db")
            .stop(true, true)
            .slideToggle();

    });


    /*==========================
      Load Profession
    ==========================*/

    $(document).on("change", ".professionSelectSister", function () {

        var section = $(this).closest(".sister-section");

        $.ajax({

            url: "ajax_data_bind.php",

            type: "POST",

            data: {
                professionSelect: $(this).val()
            },

            success: function (data) {

                section.find(".sisterSelect")
                    .html(data)
                    .show();

            }

        });

    });


    /*==========================
      Database Selection
    ==========================*/

    $(document).on("change", ".sisterSelect", function () {

        var section = $(this).closest(".sister-section");

        if ($(this).val() != "") {

            section.find(".sisterTextbox")
                .hide()
                .prop("disabled", true);

            $(this)
                .show()
                .prop("disabled", false);

        }

    });


    /*==========================
      Manual Entry
    ==========================*/

    $(document).on("click", ".manualSister", function (e) {

        e.preventDefault();

        var section = $(this).closest(".sister-section");

        section.find(".sisterTextbox")
            .show()
            .prop("disabled", false)
            .val("");

        section.find(".sisterSelect")
            .hide()
            .html("")
            .prop("disabled", false);

        section.find(".professionSelectSister").val("");

        section.find(".sister-db").hide();

    });


    /*==========================
      Father / Mother Radio
    ==========================*/

    $(document).on("change", ".sister-section input[type='radio']", function () {

        var section = $(this).closest(".sister-section");

        section.find(".sisterParentHidden").val($(this).val());

    });

});
</script>

<!--Sister Block End-->
									
									

							 
								
							  
									
									
									
									 
									
									
									 
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
<?php
$social_media_ids = explode(",", $row["social_media_name"]);

$items = array();

foreach ($social_media_ids as $sids) {

    $sids = trim($sids);

    if ($sids != '') {

        $social_media_query = mysqli_query($con, "SELECT * FROM social_media_name WHERE id='$sids'");

        if ($social_media_row = mysqli_fetch_array($social_media_query)) {

            $items[] = $social_media_row["name"];

        }
    }
}

$pre_filled_value = implode(", ", $items);
?>

<?php

$social_ids   = explode(",", $row["social_media_name"]);
$social_links = explode(",", $row["social_media_links"]);

?>

<div id="social" style="border:1px solid #ccc; padding:10px;">

    <a href="javascript:void(0);" 
       class="add_button2 btn btn-success pull-right">
       Add More
    </a>

    <br><br>

    <div class="field_wrapper2">

        <?php

        if(!empty($social_ids)) {

            foreach($social_ids as $key => $sid) {

                $sid = trim($sid);

                $link = isset($social_links[$key]) 
                        ? trim($social_links[$key]) 
                        : '';
        ?>

        <div class="social-row" style="margin-bottom:15px; border-bottom:1px solid #ddd; padding-bottom:10px;">

            <!-- SOCIAL MEDIA -->
            <div class="form-group">

                <label>Social Media Name</label>

                <select name="social_media_name[]" 
                        class="form-control social-select2">

                    <option value="">Select Social Media</option>

                    <?php

                    $social_media_query = mysqli_query($con, "
                        SELECT * 
                        FROM social_media_name 
                        ORDER BY name
                    ");

                    while($social = mysqli_fetch_array($social_media_query)) {

                        $selected = ($sid == $social['id']) 
                                    ? 'selected' 
                                    : '';

                        echo '
                        <option value="'.$social['id'].'" '.$selected.'>
                            '.$social['name'].'
                        </option>';
                    }

                    ?>

                </select>

            </div>

            <!-- LINK -->
            <div class="form-group">

                <label>Social Media Link</label>

                <input 
                    type="text"
                    name="link[]"
                    class="form-control"
                    value="<?= htmlspecialchars($link); ?>"
                >

            </div>

            <a href="javascript:void(0);" 
               class="remove_button btn btn-danger">
               Remove
            </a>

        </div>

        <?php
            }
        }
        ?>

    </div>

</div>


<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>

$(document).ready(function () {

    $('.social-select2').select2({
        placeholder: "Search Social Media",
        width: '100%'
    });

});


/* ADD MORE */

$('.add_button2').click(function () {

    var html = `

    <div class="social-row" style="margin-bottom:15px; border-bottom:1px solid #ddd; padding-bottom:10px;">

        <div class="form-group">

            <label>Social Media Name</label>

            <select name="social_media_name[]" 
                    class="form-control social-select2-new">

                <option value="">Select Social Media</option>

                <?php

                $social_media_query2 = mysqli_query($con, "
                    SELECT * 
                    FROM social_media_name 
                    ORDER BY name
                ");

                while($social2 = mysqli_fetch_array($social_media_query2)) {

                    echo '
                    <option value="'.$social2['id'].'">
                        '.$social2['name'].'
                    </option>';
                }

                ?>

            </select>

        </div>

        <div class="form-group">

            <label>Social Media Link</label>

            <input type="text"
                   name="link[]"
                   class="form-control">

        </div>

        <a href="javascript:void(0);" 
           class="remove_button btn btn-danger">
           Remove
        </a>

    </div>

    `;

    $('.field_wrapper2').append(html);

    $('.social-select2-new').select2({
        placeholder: "Search Social Media",
        width: '100%'
    });

});


/* REMOVE */

$(document).on('click', '.remove_button', function () {

    $(this).closest('.social-row').remove();

});

</script>





                                     
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

                                                <label>Gender</label><br>
                                          <?php if($row['gender'] == ''){?>
                                                <input type="radio" name="gender" value="" checked >None<br>
                                                <?php } else { ?>
                                               <input type="radio" name="gender" value="" >None<br>
                                               <?php } ?>
                                                <?php if($row['gender'] == 'Male'){?>
                                                <input type="radio" name="gender" value="Male" checked>Male<br>
                                                <?php }else { ?>
                                                 <input type="radio" name="gender" value="Male">Male<br>
                                                 <?php } ?>
                                                 <?php if($row['gender'] == 'Female'){?>
                                                <input type="radio" name="gender" value="Female" checked>Female<br>
                                                <?php } else { ?>
                                                <input type="radio" name="gender" value="Female" >Female<br>
                                                <?php } ?>

                                            </div>
							  
						
<br/>

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
                                 <h4>director List</h4>
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
    url: "search_director.php",
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

<input type="text" class="search form-control" id="searchid" placeholder="Search for Director" style="width: 100%" />  
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `director`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `director` order by show_on_home desc LIMIT $offset, $total_records_per_page");


 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                       <td><? echo $row['name']; ?></td>                                        <td><? echo $row['nickname']; ?></td> 
                                       <td><? echo $row['dob']; ?></td> 
                                       <td><? echo $row['dod']; ?></td>    <td><?   if($row['show_on_home']=="1"){ ?> 
                                        <a href="director.php?id=<? echo $row['id']; ?>&show_on_home=0&Action=ShowHome" style="color:#F00">Hide</a>
                                        <? } else{ ?>
                                        <a href="director.php?id=<? echo $row['id']; ?>&show_on_home=1&Action=ShowHome">Show</a>
                                        <? } ?></td> 
                                      <td> <img src="photo/<? echo $row['photo']; ?>" width="50"></td>
                                       <td>
                                         
                                          <a href="director.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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
      <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
     
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
	  <script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>
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




<script>
$(document).ready(function() {
   
   $("#mother_name_choice").on('change', function() {
        var mother_name_choice = $(this).val();

        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                mother_name_choice: mother_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#mother_name_select").html(data);
               $('.mother').select2();

            }
        });
    });
	
	  $("#mother_name_choice2").on('change', function() {
        var mother_name_choice = $(this).val();
 $("#mother_name_select_text2").css("display","none");
   $("#mother_name_select_text2").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                mother_name_choice: mother_name_choice
            },
            datatype: "html",
            success: function(data) {
				
                $("#mother_name_select2").html(data);
               $('.mother2').select2();
			  

            }
        });
    });
	 $("#mother_name_choice3").on('change', function() {
        var mother_name_choice = $(this).val();
 $("#mother_name_select_text3").css("display","none");
   $("#mother_name_select_text3").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                mother_name_choice: mother_name_choice
            },
            datatype: "html",
            success: function(data) {
				
                $("#mother_name_select3").html(data);
               $('.mother3').select2();
			  

            }
        });
    });
	
	 $("#mother_name_choice4").on('change', function() {
        var mother_name_choice = $(this).val();
 $("#mother_name_select_text4").css("display","none");
   $("#mother_name_select_text4").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                mother_name_choice: mother_name_choice
            },
            datatype: "html",
            success: function(data) {
				
                $("#mother_name_select4").html(data);
               $('.mother4').select2();
			  

            }
        });
    });
	
	 $("#mother_name_choice5").on('change', function() {
        var mother_name_choice = $(this).val();
 $("#mother_name_select_text5").css("display","none");
   $("#mother_name_select_text5").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                mother_name_choice: mother_name_choice
            },
            datatype: "html",
            success: function(data) {
				
                $("#mother_name_select5").html(data);
               $('.mother5').select2();
			  

            }
        });
    });
	
	
});


</script>


<script>
$(document).ready(function() {
    $("#spouse_name_choice").on('change', function() {
        var spouse_name_choice = $(this).val();
 $("#spouse_name_select_text").css("display","none");
   $("#spouse_name_select_text").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                spouse_name_choice: spouse_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#spouse_name_select").html(data);
               $('.spouse').select2();

            }
        });
    });
	 $("#spouse_name_choice2").on('change', function() {
        var spouse_name_choice = $(this).val();
$("#spouse_name_select_text2").css("display","none");
   $("#spouse_name_select_text2").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                spouse_name_choice: spouse_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#spouse_name_select2").html(data);
               $('.spouse2').select2();

            }
        });
    });
	$("#spouse_name_choice3").on('change', function() {
        var spouse_name_choice = $(this).val();
$("#spouse_name_select_text3").css("display","none");
   $("#spouse_name_select_text3").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                spouse_name_choice: spouse_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#spouse_name_select3").html(data);
               $('.spouse3').select2();

            }
        });
    });
	
	$("#spouse_name_choice4").on('change', function() {
        var spouse_name_choice = $(this).val();
$("#spouse_name_select_text4").css("display","none");
   $("#spouse_name_select_text4").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                spouse_name_choice: spouse_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#spouse_name_select4").html(data);
               $('.spouse4').select2();

            }
        });
    });
   
   $("#spouse_name_choice5").on('change', function() {
        var spouse_name_choice = $(this).val();
$("#spouse_name_select_text5").css("display","none");
   $("#spouse_name_select_text5").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                spouse_name_choice: spouse_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#spouse_name_select5").html(data);
               $('.spouse5').select2();

            }
        });
    });
});
</script>


<script>
$(document).ready(function() {
    $("#daughter_name_choice").on('change', function() {
        var daughter_name_choice = $(this).val();
 $("#daughter_name_select_text").css("display","none");
   $("#daughter_name_select_text").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                daughter_name_choice: daughter_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#daughter_name_select").html(data);
               $('.daughter').select2();

            }
        });
    });
	 $("#daughter_name_choice2").on('change', function() {
        var daughter_name_choice = $(this).val();
$("#daughter_name_select_text2").css("display","none");
   $("#daughter_name_select_text2").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                daughter_name_choice: daughter_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#daughter_name_select2").html(data);
               $('.daughter2').select2();

            }
        });
    });
	$("#daughter_name_choice3").on('change', function() {
        var daughter_name_choice = $(this).val();
$("#daughter_name_select_text3").css("display","none");
   $("#daughter_name_select_text3").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                daughter_name_choice: daughter_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#daughter_name_select3").html(data);
               $('.daughter3').select2();

            }
        });
    });
	
	$("#daughter_name_choice4").on('change', function() {
        var daughter_name_choice = $(this).val();
$("#daughter_name_select_text4").css("display","none");
   $("#daughter_name_select_text4").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                daughter_name_choice: daughter_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#daughter_name_select4").html(data);
               $('.daughter4').select2();

            }
        });
    });
   
   $("#daughter_name_choice5").on('change', function() {
        var daughter_name_choice = $(this).val();
$("#daughter_name_select_text5").css("display","none");
   $("#daughter_name_select_text5").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                daughter_name_choice: daughter_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#daughter_name_select5").html(data);
               $('.daughter5').select2();

            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    $("#son_name_choice").on('change', function() {
        var son_name_choice = $(this).val();
 $("#son_name_select_text").css("display","none");
   $("#son_name_select_text").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                son_name_choice: son_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#son_name_select").html(data);
               $('.son').select2();

            }
        });
    });
	 $("#son_name_choice2").on('change', function() {
        var son_name_choice = $(this).val();
$("#son_name_select_text2").css("display","none");
   $("#son_name_select_text2").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                son_name_choice: son_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#son_name_select2").html(data);
               $('.son2').select2();

            }
        });
    });
	$("#son_name_choice3").on('change', function() {
        var son_name_choice = $(this).val();
$("#son_name_select_text3").css("display","none");
   $("#son_name_select_text3").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                son_name_choice: son_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#son_name_select3").html(data);
               $('.son3').select2();

            }
        });
    });
	
	$("#son_name_choice4").on('change', function() {
        var son_name_choice = $(this).val();
$("#son_name_select_text4").css("display","none");
   $("#son_name_select_text4").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                son_name_choice: son_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#son_name_select4").html(data);
               $('.son4').select2();

            }
        });
    });
   
   $("#son_name_choice5").on('change', function() {
        var son_name_choice = $(this).val();
$("#son_name_select_text5").css("display","none");
   $("#son_name_select_text5").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                son_name_choice: son_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#son_name_select5").html(data);
               $('.son5').select2();

            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    $("#brother_name_choice").on('change', function() {
        var brother_name_choice = $(this).val();
 $("#brother_name_select_text").css("display","none");
   $("#brother_name_select_text").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                brother_name_choice: brother_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#brother_name_select").html(data);
               $('.brother').select2();

            }
        });
    });
	 $("#brother_name_choice2").on('change', function() {
        var brother_name_choice = $(this).val();
$("#brother_name_select_text2").css("display","none");
   $("#brother_name_select_text2").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                brother_name_choice: brother_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#brother_name_select2").html(data);
               $('.brother2').select2();

            }
        });
    });
	$("#brother_name_choice3").on('change', function() {
        var brother_name_choice = $(this).val();
$("#brother_name_select_text3").css("display","none");
   $("#brother_name_select_text3").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                brother_name_choice: brother_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#brother_name_select3").html(data);
               $('.brother3').select2();

            }
        });
    });
	
	$("#brother_name_choice4").on('change', function() {
        var brother_name_choice = $(this).val();
$("#brother_name_select_text4").css("display","none");
   $("#brother_name_select_text4").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                brother_name_choice: brother_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#brother_name_select4").html(data);
               $('.brother4').select2();

            }
        });
    });
   
   $("#brother_name_choice5").on('change', function() {
        var brother_name_choice = $(this).val();
$("#brother_name_select_text5").css("display","none");
   $("#brother_name_select_text5").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                brother_name_choice: brother_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#brother_name_select5").html(data);
               $('.brother5').select2();

            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    $("#sister_name_choice").on('change', function() {
        var sister_name_choice = $(this).val();
 $("#sister_name_select_text").css("display","none");
   $("#sister_name_select_text").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                sister_name_choice: sister_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#sister_name_select").html(data);
               $('.sister').select2();

            }
        });
    });
	 $("#sister_name_choice2").on('change', function() {
        var sister_name_choice = $(this).val();
$("#sister_name_select_text2").css("display","none");
   $("#sister_name_select_text2").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                sister_name_choice: sister_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#sister_name_select2").html(data);
               $('.sister2').select2();

            }
        });
    });
	$("#sister_name_choice3").on('change', function() {
        var sister_name_choice = $(this).val();
$("#sister_name_select_text3").css("display","none");
   $("#sister_name_select_text3").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                sister_name_choice: sister_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#sister_name_select3").html(data);
               $('.sister3').select2();

            }
        });
    });
	
	$("#sister_name_choice4").on('change', function() {
        var sister_name_choice = $(this).val();
$("#sister_name_select_text4").css("display","none");
   $("#sister_name_select_text4").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                sister_name_choice: sister_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#sister_name_select4").html(data);
               $('.sister4').select2();

            }
        });
    });
   
   $("#sister_name_choice5").on('change', function() {
        var sister_name_choice = $(this).val();
$("#sister_name_select_text5").css("display","none");
   $("#sister_name_select_text5").removeAttr("name");
        $.ajax({
            method: "POST",
            url: "ajax_data_bind.php",
            data: {
                sister_name_choice: sister_name_choice
            },
            datatype: "html",
            success: function(data) {
                $("#sister_name_select5").html(data);
               $('.sister5').select2();

            }
        });
    });
});
</script>
<script>
$(document).ready(function(){
    var maxField2 = 15; //Input fields increment limitation
    var addButton2 = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper2'); //Input field wrapper
    var fieldHTML2 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
         
'<div class="form-group">'+
    '<label for="social_media_name">Select Social Media Name:</label>'+
	'<select class="form-control social_media_name" id="social_media_name" name="social_media_name[]">'+
	   '<option>-Select Social Media Name-</option>'+
           <? $social_media_name=mysqli_query($con, "select * from social_media_name order by name");
                                  while($choice_exe=mysqli_fetch_array($social_media_name)){ ?>

'<option value="<? echo $choice_exe['id']; ?>"><? echo $choice_exe['name']; ?></option>'+
                                  <? } ?>
	   '</select>'+

  '</div>'+
  '<div class="form-group">'+
    '<label for="link">Social Media Link:</label>'+
    '<input type="text" class="form-control" id="link" name="link[]" >'+
  '</div>'+
  
                  '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton2).click(function(){
        //Check maximum number of input fields
        if(x < maxField2){ 
            x++; //Increase field counter
            $(wrapper2).append(fieldHTML2); //Add field html
            $('.main_language').select2();
			$('.flexdatalist1').flexdatalist({
     minLength: 1
});
           
        }else{
            alert('A maximum of '+maxField2+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper2).on('click', '.remove_button', function(e){
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

            //Update the textbox with the selected values joined by commas
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

            //Update the textbox with the selected values joined by commas
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

            //Update the textbox with the selected values joined by commas
            document.getElementById('textbox_brother').value = values.join(',');
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

            //Update the textbox with the selected values joined by commas
            document.getElementById('textbox_daughter').value = values.join(',');
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

            //Update the textbox with the selected values joined by commas
            document.getElementById('textbox_sister').value = values.join(',');
        }
    </script>