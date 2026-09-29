<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_POST["basic_details"]) { 
    
    $meaningfilm= mysqli_real_escape_string($con,$_POST['film_meaning']); 
    $type= mysqli_real_escape_string($con,$_POST['type']); 
    $country= mysqli_real_escape_string($con,implode(",",$_POST['country']));
    $name= mysqli_real_escape_string($con,$_POST['name']); 
    $main_language= mysqli_real_escape_string($con,implode(",",$_POST['main_language']));
    $film_slug=mysqli_real_escape_string($con,$_POST['film_slug_permalink']);
    $panindia=mysqli_real_escape_string($con,$_POST['panindia']);
    $pan_language=mysqli_real_escape_string($con,implode(",",$_POST['pan_language']));
    $Real=mysqli_real_escape_string($con,$_POST['Real']);
    $Sequel=mysqli_real_escape_string($con,$_POST['Sequel']);
    $sequel_type=mysqli_real_escape_string($con,implode(",",$_POST['sequel_type']));
    $sequel_film_name=mysqli_real_escape_string($con,implode(",",$_POST['sequel_film_name']));
    $Installment=mysqli_real_escape_string($con,implode(",",$_POST['Installment']));
    $Multiple_Roles=mysqli_real_escape_string($con,$_POST['Multiple_Roles']);
    $multiple_actor_name=mysqli_real_escape_string($con,implode(",",$_POST['multiple_actor_name']));
    $multiple_character_name=mysqli_real_escape_string($con,implode(",",$_POST['multiple_character_name']));
    $multiple_remarks=mysqli_real_escape_string($con,implode(",",$_POST['multiple_remarks']));
    $budget=mysqli_real_escape_string($con,$_POST['budget']);
    $date_release= mysqli_real_escape_string($con,$_POST['date_release']);
    $month_release= mysqli_real_escape_string($con,$_POST['month_release']);
    $year_release= mysqli_real_escape_string($con,$_POST['year_release']);
    $shelved_unreleased=mysqli_real_escape_string($con,$_POST['shelved_unreleased']);
    $img=$_FILES['filstor']['name'];
    $tmpName=$_FILES['filstor']['tmp_name']; 
    if($img<>"")
         {
            $ext = strrchr($img, ".");
            $prefix=str_replace(" ","-",$name);
            $newName = $prefix ."-". substr(md5(rand() * time()), 0, 5) . $ext;
            move_uploaded_file($tmpName,"photo/".$newName);
         } 


$fname1=strtolower(str_replace(" ", "-", $name)); 

$alias=preg_replace("/[^a-zA-Z0-9-]/", "",$fname1 );

  $film_basic_details="insert into film set type='$type',name='$name',alias='$alias',country='$country',budget='$budget',main_lang='$main_language',photo='$newName',date_release='$date_release',month_release='$month_release',year_release='$year_release',film_meaning='$meaningfilm',film_slug_permalink='$film_slug',panindia='$panindia',pan_language='$pan_language',real_name='$Real',sequel='$Sequel',sequel_type='$sequel_type',sequel_film_name='$sequel_film_name',installment='$Installment',multiple_roles='$Multiple_Roles',multiple_actor_name='$multiple_actor_name',multiple_character_name='$multiple_character_name',multiple_remarks='$multiple_remarks',shelved_unreleased='$shelved_unreleased'";
mysqli_query($con,$film_basic_details) or die(mysqli_error($con));
  
         echo "<script>alert('Basic Details Save Succesfully')</script>";
  echo "<script>window.location.href='film_basic_details.php'</script>";
         }






if($_GET["Action"]=="DeleteGenre") { 
  $film_id=$_GET['film_id'];
   $genre_id= $_GET['genre_id'];
  mysqli_query($con, "delete from film_genre where film_id='$film_id' and genre_id='$genre_id'") or die(mysqli_error($con));

header("location:film.php?Action=Update&id=$film_id");

}





if($_POST["UpdateCast"]) { 

    $film_id= $_POST['film_id'];
    $cast_id= $_POST['cast_id'];
    $othercharacterdetails=$_POST["othercharacterdetails"];
    $otherremark=$_POST["otherremark"];
    mysqli_query($con, "insert into film_cast (film_id, cast_id,film_other_charater,film_other_remark) values ('$film_id', '$cast_id','$othercharacterdetails','$otherremark')");

echo "<script>alert('Other Lead Cast Added Successfully')</script>";

}


if($_GET["Action"]=="DeleteCast") { 
  $id=$_GET["id"];
  $film_id=$_GET['film_id'];
  $cast_id=$_GET['cast_id'];
  mysqli_query($con, "delete from film_cast where film_id='$film_id' and cast_id='$cast_id' and id='$id'");

header("location:film.php?Action=Update&id=$film_id");

}

if($_POST["UpdateLeadCast"]) { 

    $film_id= $_POST['film_id'];
    $film_lead_cast_id= $_POST['film_lead_cast_id'];
    $characterdetails=$_POST["characterdetails"];
    $remark=$_POST["remark"];
    
    mysqli_query($con, "insert into film_lead_cast (film_id, film_lead_cast_id,film_lead_charater,film_lead_remark) values ('$film_id', '$film_lead_cast_id','$characterdetails','$remark')");

echo "<script>alert('Lead Cast Added Successfully')</script>";
}


if($_GET["Action"]=="DeleteLeadCast") { 
  $id=$_GET["id"];
  $film_id=$_GET['film_id'];
  $film_lead_cast_id=$_GET['film_lead_cast_id'];
  mysqli_query($con, "delete from film_lead_cast where film_id='$film_id' and film_lead_cast_id='$film_lead_cast_id' and id='$id'");

header("location:film.php?Action=Update&id=$film_id");

}


if($_POST["UpdateDirector"]) { 

    $film_id= $_POST['id'];
    $director_id= $_POST['director_id'];
    mysqli_query($con, "insert into film_director (film_id, director_id) values ('$film_id', '$director_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteDirector") { 
  $film_id=$_GET['film_id'];
  $director_id=$_GET['director_id'];
  mysqli_query($con, "delete from film_director where film_id='$film_id' and director_id='$director_id'");

header("location:film.php?Action=Update&id=$film_id");

}
if($_POST["UpdateCoDirector"]) { 

    $film_id= $_POST['id'];
    $codirector_id= $_POST['codirector_id'];
    mysqli_query($con, "insert into film_codirector (film_id, codirector_id) values ('$film_id', '$codirector_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteCoDirector") { 
  $film_id=$_GET['film_id'];
  $codirector_id=$_GET['codirector_id'];
  mysqli_query($con, "delete from film_codirector where film_id='$film_id' and codirector_id='$codirector_id'");

header("location:film.php?Action=Update&id=$film_id");

}

if($_POST["Updateartdirector"]) { 

    $film_id= $_POST['id'];
    $art_director_id= $_POST['art_director_id'];
    mysqli_query($con, "insert into film_art_director (film_id, art_director_id) values ('$film_id', '$art_director_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteArtDirector") { 
  $film_id=$_GET['film_id'];
  $art_director_id=$_GET['art_director_id'];
  mysqli_query($con, "delete from film_art_director where film_id='$film_id' and art_director_id='$art_director_id'");

header("location:film.php?Action=Update&id=$film_id");

}





if($_POST["UpdateProducer"]) { 

    $film_id= $_POST['id'];
    $producer_id= $_POST['producer_id'];
    mysqli_query($con, "insert into film_producer (film_id, producer_id) values ('$film_id', '$producer_id')");

header("location:film.php?Action=Update&id=$film_id");
}

if($_POST["UpdateCoProducer"]) { 

    $film_id= $_POST['id'];
    $co_producer_id= $_POST['co_producer'];
    mysqli_query($con, "insert into film_co_producer (film_id, co_producer_id) values ('$film_id', '$co_producer_id')");

header("location:film.php?Action=Update&id=$film_id");
}

if($_GET["Action"]=="DeleteProducer") { 
  $film_id=$_GET['film_id'];
  $producer_id=$_GET['producer_id'];
  mysqli_query($con, "delete from film_producer where film_id='$film_id' and producer_id='$producer_id'");

header("location:film.php?Action=Update&id=$film_id");

}
if($_GET["Action"]=="DeleteCoProducer") { 
  $film_id=$_GET['film_id'];
  $co_producer_id=$_GET['co_producer_id'];
  mysqli_query($con, "delete from film_co_producer where film_id='$film_id' and co_producer_id='$co_producer_id'");

header("location:film.php?Action=Update&id=$film_id");

}
if($_POST["UpdatePresenterProducer"]) { 

    $film_id= $_POST['id'];
    $presenter_id= $_POST['presenter_id'];
    mysqli_query($con, "insert into film_presenter (film_id, presenter_id) values ('$film_id', '$presenter_id')");

header("location:film.php?Action=Update&id=$film_id");
}

if($_GET["Action"]=="DeletePresenterProducer") { 
  $film_id=$_GET['film_id'];
  $presenter_id=$_GET['presenter_id'];
  mysqli_query($con, "delete from film_presenter where film_id='$film_id' and presenter_id='$presenter_id'");

header("location:film.php?Action=Update&id=$film_id");

}
if($_POST["dialogue_writers"]) { 

    $film_id= $_POST['id'];
    $dialogue_writers_id= $_POST['dialogue_writers_id'];
    mysqli_query($con, "insert into film_dialogue_writers (film_id, dialogue_writers_id) values ('$film_id', '$dialogue_writers_id')");

header("location:film.php?Action=Update&id=$film_id");
}

if($_GET["Action"]=="dialogue_writers") { 
  $film_id=$_GET['film_id'];
  $dialogue_writers_id=$_GET['dialogue_writers_id'];
  mysqli_query($con, "delete from film_dialogue_writers where film_id='$film_id' and dialogue_writers_id='$dialogue_writers_id'");

header("location:film.php?Action=Update&id=$film_id");

}



if($_POST["UpdateMusicDirector"]) { 

    $film_id= $_POST['id'];
    $music_director_id= $_POST['music_director_id'];
    mysqli_query($con, "insert into film_music_director (film_id, music_director_id) values ('$film_id', '$music_director_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteMusicDirector") { 
  $film_id=$_GET['film_id'];
  $music_director_id=$_GET['music_director_id'];
  mysqli_query($con, "delete from film_music_director where film_id='$film_id' and music_director_id='$music_director_id'");

header("location:film.php?Action=Update&id=$film_id");

}


if($_POST["UpdateBackgroundScorer"]) { 

    $film_id= $_POST['id'];
    $background_scorer_id= $_POST['music_background_scorer_id'];
    mysqli_query($con, "insert into  film_background_scorer (film_id, background_scorer_id) values ('$film_id', '$background_scorer_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteBackgroundScorer") { 
  $film_id=$_GET['film_id'];
  $music_background_scorer_id=$_GET['music_background_scorer_id'];
  mysqli_query($con, "delete from film_background_scorer where film_id='$film_id' and background_scorer_id='$music_background_scorer_id'");

header("location:film.php?Action=Update&id=$film_id");

}
if($_POST["UpdateFilmEditor"]) { 

    $film_id= $_POST['id'];
    $film_editor_id= $_POST['film_editor_id'];
    mysqli_query($con, "insert into film_editor_allot (film_id, film_editor_id) values ('$film_id', '$film_editor_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteFilmEditor") { 
  $film_id=$_GET['film_id'];
  $film_editor_id=$_GET['film_editor_id'];
  mysqli_query($con, "delete from film_editor_allot where film_id='$film_id' and film_editor_id='$film_editor_id'");

header("location:film.php?Action=Update&id=$film_id");

}
if($_POST["UpdateStoryWriter"]) { 

    $film_id= $_POST['id'];
    $film_story_writer_id= $_POST['film_story_writer_id'];
    mysqli_query($con, "insert into film_story_writer (film_id, film_story_writer_id) values ('$film_id', '$film_story_writer_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteStoryWriter") { 
  $film_id=$_GET['film_id'];
  $film_story_writer_id=$_GET['film_story_writer_id'];
  mysqli_query($con, "delete from film_story_writer where film_id='$film_id' and film_story_writer_id='$film_story_writer_id'");

header("location:film.php?Action=Update&id=$film_id");

}
if($_POST["UpdateProductionDesigner"]) { 

    $film_id= $_POST['id'];
    $film_production_designer_id= $_POST['film_production_designer_id'];
    mysqli_query($con, "insert into film_production_designer (film_id, film_production_designer_id) values ('$film_id', '$film_production_designer_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteProductionDesigner") { 
  $film_id=$_GET['film_id'];
  $film_production_designer_id=$_GET['film_production_designer_id'];
  mysqli_query($con, "delete from film_production_designer where film_id='$film_id' and film_production_designer_id='$film_production_designer_id'");

header("location:film.php?Action=Update&id=$film_id");

}
if($_POST["UpdateChoreographer"]) { 

    $film_id= $_POST['id'];
    $film_choreographer_id= $_POST['film_choreographer_id'];
    mysqli_query($con, "insert into film_choreographer (film_id, film_choreographer_id) values ('$film_id', '$film_choreographer_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteChoreographer") { 
  $film_id=$_GET['film_id'];
  $film_choreographer_id=$_GET['film_choreographer_id'];
  mysqli_query($con, "delete from film_choreographer where film_id='$film_id' and film_choreographer_id='$film_choreographer_id'");

header("location:film.php?Action=Update&id=$film_id");

}
if($_POST["UpdateScreenplay"]) { 

    $film_id= $_POST['id'];
    $film_screenplay_id= $_POST['film_screenplay_id'];
    mysqli_query($con, "insert into film_screenplay (film_id, film_screenplay_id) values ('$film_id', '$film_screenplay_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteScreenplay") { 
  $film_id=$_GET['film_id'];
  $film_screenplay_id=$_GET['film_screenplay_id'];
  mysqli_query($con, "delete from film_screenplay where film_id='$film_id' and film_screenplay_id='$film_screenplay_id'");

header("location:film.php?Action=Update&id=$film_id");

}
if($_POST["UpdateActionDirector"]) { 

    $film_id= $_POST['id'];
    $film_action_director_id= $_POST['film_action_director_id'];
    mysqli_query($con, "insert into film_action_director (film_id, film_action_director_id) values ('$film_id', '$film_action_director_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteActionDirector") { 
  $film_id=$_GET['film_id'];
  $film_action_director_id=$_GET['film_action_director_id'];
  mysqli_query($con, "delete from film_action_director where film_id='$film_id' and film_action_director_id='$film_action_director_id'");

header("location:film.php?Action=Update&id=$film_id");

}
if($_POST["UpdateLineProducer"]) { 

    $film_id= $_POST['id'];
    $film_line_producer_id= $_POST['line_producer'];
    mysqli_query($con, "insert into film_line_producer (film_id, film_line_producer_id) values ('$film_id', '$film_line_producer_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteLineProducer") { 
  $film_id=$_GET['film_id'];
  $film_line_producer_id=$_GET['film_line_producer_id'];
  mysqli_query($con, "delete from film_line_producer where film_id='$film_id' and film_line_producer_id='$film_line_producer_id'");

header("location:film.php?Action=Update&id=$film_id");

}

if($_POST["UpdateExecutiveProducer"]) { 

    $film_id= $_POST['id'];
    $film_executive_producer_id= $_POST['film_executive_producer_id'];
    mysqli_query($con, "insert into film_executive_producer (film_id, film_executive_producer_id) values ('$film_id', '$film_executive_producer_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteExectiveProducer") { 
  $film_id=$_GET['film_id'];
  $film_executive_producer_id=$_GET['film_executive_producer_id'];
  mysqli_query($con, "delete from film_executive_producer where film_id='$film_id' and film_executive_producer_id='$film_executive_producer_id'");

header("location:film.php?Action=Update&id=$film_id");

}

if($_POST["UpdateSupervisingProducer"]) { 

    $film_id= $_POST['id'];
    $film_supervising_producer_id= $_POST['film_supervising_producer_id'];
    mysqli_query($con, "insert into film_supervising_producer (film_id, film_supervising_producer_id) values ('$film_id', '$film_supervising_producer_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteSupervisingProducer") { 
  $film_id=$_GET['film_id'];
  $film_supervising_producer_id=$_GET['film_supervising_producer_id'];
  mysqli_query($con, "delete from film_supervising_producer where film_id='$film_id' and film_supervising_producer_id='$film_supervising_producer_id'");

header("location:film.php?Action=Update&id=$film_id");

}
if($_POST["UpdateCinematographer"]) { 

    $film_id= $_POST['id'];
    $film_Cinematographer_id= $_POST['film_Cinematographer_id'];
    mysqli_query($con, "insert into film_cinematographer (film_id, cinematographer_id) values ('$film_id', '$film_Cinematographer_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteCinematographer") { 
  $film_id=$_GET['film_id'];
  $film_Cinematographer_id=$_GET['film_Cinematographer_id'];
  mysqli_query($con, "delete from film_cinematographer where film_id='$film_id' and cinematographer_id='$film_Cinematographer_id'");

header("location:film.php?Action=Update&id=$film_id");

}
if($_POST["UpdateDOP"]) { 

    $film_id= $_POST['id'];
    $film_dop=$_POST['film_dop'];
    mysqli_query($con, "insert into film_dop (film_id, dop_id) values ('$film_id', '$film_dop')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteDOP") { 
  $film_id=$_GET['film_id'];
  $dop_id=$_GET['film_dop_id'];
  mysqli_query($con, "delete from film_dop where film_id='$film_id' and dop_id='$dop_id'");

header("location:film.php?Action=Update&id=$film_id");

}



           if($_POST["Update"]) {




    $id= $_POST['id'];
    $meaningfilm= mysqli_real_escape_string($con,$_POST['meaningfilm']);
    $type= mysqli_real_escape_string($con,$_POST['type']) ; 
    $name=mysqli_real_escape_string($con,$_POST['name']); 
     $country= mysqli_real_escape_string($con,implode(",",$_POST['country']));
     $dubbing_language= mysqli_real_escape_string($con,implode(",",$_POST['dubbing_language'])) ;
    $main_language= mysqli_real_escape_string($con,implode(",",$_POST['main_language'])) ;
$name=mysqli_real_escape_string($con,$_POST['name']); 
$director=mysqli_real_escape_string($con,$_POST['director']); 
$cast=mysqli_real_escape_string($con,$_POST['cast']); 
$producer=mysqli_real_escape_string($con,$_POST['producer']); 
    $budget= mysqli_real_escape_string($con,$_POST['budget']) ; 
$music_director=mysqli_real_escape_string($con,$_POST['music_director']); 
$story=mysqli_real_escape_string($con,$_POST['story']); 
$climax=mysqli_real_escape_string($con,$_POST['climax']); 
$acting=mysqli_real_escape_string($con,$_POST['acting']); 
    $film_review= mysqli_real_escape_string($con,$_POST['film_review']) ;
$trailer_review=mysqli_real_escape_string($con,$_POST['trailer_review']); 
$why_watch=mysqli_real_escape_string($con,$_POST['why_watch']); 
$why_not_watch=mysqli_real_escape_string($con,$_POST['why_not_watch']); 
$youtube=mysqli_real_escape_string($con,$_POST['youtube']); 
$youtube_film=mysqli_real_escape_string($con,$_POST['youtube_film']); 
$rating=mysqli_real_escape_string($con,$_POST['rating']);
$release_date=mysqli_real_escape_string($con,$_POST['release_date']);  
    $rotten_rating= mysqli_real_escape_string($con,$_POST['rotten_rating']) ; 
    $date_release= mysqli_real_escape_string($con,$_POST['date_release']) ;
    $month_release= mysqli_real_escape_string($con,$_POST['month_release']) ;
    $year_release= mysqli_real_escape_string($con,$_POST['year_release']) ;
 
 
 
  $cbfc_rating= mysqli_real_escape_string($con,$_POST['cbfc_rating']) ;
    $cbfc_certificate_no= mysqli_real_escape_string($con,$_POST['cbfc_certificate_no']) ;
    $cbfc_certificate_date= mysqli_real_escape_string($con,$_POST['cbfc_certificate_date']) ;
    $cbfc_certificate_month= mysqli_real_escape_string($con,$_POST['cbfc_certificate_month']) ;
    $cbfc_certificate_year= mysqli_real_escape_string($con,$_POST['cbfc_certificate_year']) ;
    $cbfc_running_time_minutes= mysqli_real_escape_string($con,$_POST['cbfc_running_time_minutes']) ;
    $cbfc_running_time_seconds= mysqli_real_escape_string($con,$_POST['cbfc_running_time_seconds']) ;
    $cbfc_language= mysqli_real_escape_string($con,$_POST['cbfc_language']) ;
    $cbfc_status= mysqli_real_escape_string($con,$_POST['cbfc_status']) ;
    $cbfc_releasing_platform= mysqli_real_escape_string($con,$_POST['cbfc_releasing_platform']) ;
    if($cbfc_releasing_platform=="OTT")
    {
    $cbfc_releasing_platform_details= mysqli_real_escape_string($con,$_POST['cbfc_releasing_platform_details']) ;
    }
    else
    {
        $cbfc_releasing_platform_details="";
    }
 
    $imdb_rating= mysqli_real_escape_string($con,$_POST['imdb_rating']) ;   
    $box_office= $_POST['box_office'] ; 
$img=$_FILES['filstor']['name'];
$tmpName=$_FILES['filstor']['tmp_name'];
$oldimg=$_POST['oldimg'];



    $isdubbed= mysqli_real_escape_string($con,$_POST['isdubbed']) ;
    $original_movie_name= mysqli_real_escape_string($con,$_POST['original_movie_name']) ;
    $dubbed_main_language= mysqli_real_escape_string($con,implode(",",$_POST['dubbed_main_language'])) ;
    $dubbed_date_release= mysqli_real_escape_string($con,$_POST['dubbed_date_release']) ;
    $dubbed_month_release= mysqli_real_escape_string($con,$_POST['dubbed_month_release']) ;
    $dubbed_year_release= mysqli_real_escape_string($con,$_POST['dubbed_year_release']) ;
    $dubbed_Genre= mysqli_real_escape_string($con,implode(",",$_POST['dubbed_Genre'])) ;
    $dubbed_youtube= mysqli_real_escape_string($con,$_POST['dubbed_youtube']) ;
    $dubbed_upload_date	= mysqli_real_escape_string($con,$_POST['dubbed_upload_date']) ;
    
    
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

$fname1=strtolower(str_replace(" ", "-", $name)); 

$alias=preg_replace("/[^a-zA-Z0-9-]/", "",$fname1 );
            mysqli_query($con,"update film set  film_meaning='$meaningfilm',type='$type', name='$name',country='$country',alias='$alias',dubbing='$dubbing_language',main_lang='$main_language',director='$director',cast='$cast',producer='$producer',music_director='$music_director',box_office='$box_office',budget='$budget',story='$story',climax='$climax',acting='$acting',film_review='$film_review',trailer_review='$trailer_review',why_watch='$why_watch',why_not_watch='$why_not_watch',youtube='$youtube',youtube_film='$youtube_film',rating='$rating',imdb_rating='$imdb_rating',rotten_rating='$rotten_rating',date_release='$date_release',month_release='$month_release',year_release='$year_release',photo='$newName',isdubbed='$isdubbed',original_movie_name='$original_movie_name',dubbed_main_language='$dubbed_main_language',dubbed_date_release='$dubbed_date_release',dubbed_month_release='$dubbed_month_release',dubbed_year_release='$dubbed_year_release',dubbed_Genre='$dubbed_Genre',dubbed_youtube='$dubbed_youtube',dubbed_upload_date='$dubbed_upload_date',cbfc_rating='$cbfc_rating',cbfc_certificate_no='$cbfc_certificate_no',cbfc_certificate_date='$cbfc_certificate_date',cbfc_certificate_month='$cbfc_certificate_month',cbfc_certificate_year='$cbfc_certificate_year',cbfc_running_time_minutes='$cbfc_running_time_minutes',cbfc_running_time_seconds='$cbfc_running_time_seconds',cbfc_language='$cbfc_language',cbfc_status='$cbfc_status',cbfc_releasing_platform='$cbfc_releasing_platform',cbfc_releasing_platform_details='$cbfc_releasing_platform_details' where id='$id'") or die(mysqli_error($con));
             header('location:film.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con, "delete from film where id='$_REQUEST[id]'");

header("location:film.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Add Film</title>
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

      <!-- Theme style rtl -->
      <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
      <!-- End Theme Layout Style
         =====================================================================-->
<!--
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
-->
  <!-- select2 -->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
                  <h1>Film Management</h1>
                  <small>Add New Film</small>
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
                                 <h4>Add Film</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                             <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#Basics">Basics Details</a></li>
    <li><a data-toggle="tab" href="#Trailer">Trailer</a></li>
    <li><a data-toggle="tab" href="#Dubbed">Dubbed</a></li>
    <li><a data-toggle="tab" href="#Cast_1">Cast</a></li>
    <li><a data-toggle="tab" href="#Crew_1">Crew</a></li>
    <li><a data-toggle="tab" href="#Rating">Rating</a></li>
    <li><a data-toggle="tab" href="#Box_Office">Box Office</a></li>
    <li><a data-toggle="tab" href="#Similar">Similar Film</a></li>
    <li><a data-toggle="tab" href="#OTT">OTT</a></li>
    <li><a data-toggle="tab" href="#Trivia">Trivia</a></li>
    <li><a data-toggle="tab" href="#Bookmyshow">Bookmyshow</a></li>
    <li><a data-toggle="tab" href="#otherdetails">Other Details</a></li>
  </ul>
  
    <div class="tab-content">
    <div id="Basics" class="tab-pane fade in active">
      <h3>Film Basic Details: </h3>
       <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                     <div class="form-group">
                                 <label>Type</label>
                                 <select class="form-control" name="type" required>
                                     <option value="">-Select Type-</option>
                                      <? $sqlfr=mysqli_query($con, "select * from  filetypemanagement order by film_type");
                                  
                                 while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['film_type']; ?>"><? echo $rowfr['film_type']; ?></option>
                                  <? } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                 <label>Film Title</label>
                                 <input type="text" class="form-control" name="name" placeholder="Enter name" required >
                              </div>
                              <div class="form-group">
                                 <label>Film Meaning(optional)</label>
                                 <input type="text" class="form-control" name="film_meaning" placeholder="Enter Film Meaning"  >
                              </div>
                              <div class="form-group">
                                <label>Country (s)</label>
                                 
   <select class="main_language"  class="form-control" name="country[]" multiple="multiple">
                                  <? $sqlfr=mysqli_query($con, "select * from country order by country_name");
                                  
                                 while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['country_name']; ?>"><? echo $rowfr['country_name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              
                              </div>
                                  <div class="form-group  ">
                                <label>Main Lanaguage(s)</label>
                                 
   <select class="main_language"  class="form-control" name="main_language[]" multiple="multiple">
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <div class="form-group">
                                 <label>Film Slug</label>
                                <input type="text" name="film_slug" class="form-control" id="film_slug"  onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)"  placeholder="Enter Slug"/>
                                 <label for="title">Permalink URL:</label>
                            <input type="text" class="form-control" name="film_slug_permalink" id="film_slug_permalink"  placeholder="Permalink URL Value" readonly />
                              </div>
                               <div class="form-group">
                                 <label>PAN India:</label>
                                 <select class="form-control" id="panindia" name="panindia" required>
                                    <option value="No">No</option>
                                     <option value="Yes">Yes</option>
                                     
                                     
                                </select>
                              </div>
                                    <div id="ispan" style="display: block;border: 1px solid black;padding: 14px;">
                                        <div class="form-group  ">
                                <label>Select PAN Lanaguage(s)</label>
                                 
   <select class="main_language"  class="form-control" name="pan_language[]" multiple="multiple">
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
                                    </div>
                                    
                                     <div class="form-group">
                                 <label>Real:</label>
                                 <select class="form-control" id="Real" name="Real" required>
                                     <option value="No">No</option>
                                     <option value="Yes">Yes</option>
                                  
                                     
                                </select>
                              </div>
                              
                              
                              
                              

                                  
                               <div class="form-group">
                                 <label>Sequel:</label>
                                 <select class="form-control" id="Sequel" name="Sequel" required>
                                      <option value="No">No</option>
                                     <option value="Yes">Yes</option>
                                   
                                </select>
                              </div>
                              
                              
                              
                              
                              
                  
                   <div id="isSequel" style="display: block;border: 1px solid black;padding: 14px;">
                          <label>Fill Following Franchise  Details of This Film:</label>
                                <br/>
                                <div class="field_wrapper3">
                                <a href="javascript:void(0);" class="add_button3 btn btn-success pull-right" title="Add More">Add More</a>
                                     <br/>
                                        <div class="form-group  ">
                                <label>Select Sequel Type</label>
                                 
   <select class="form-control" name="sequel_type[]" >
                                  <option value="">-Please Select-</option>
                                     <option value="Sequel">Sequel</option>
                                     <option value="Prequel">Prequel</option>
                                     <option value="Quasi Sequel">Quasi Sequel</option>
                                 </select>
                                 
                              </div> 
                               <div class="form-group  ">
                             
                                 <label>Film Title(s)</label>
                                 
 <select class="main_language"  class="form-control" name="sequel_film_name[]" multiple="multiple">
                                  <? $sqlfr=mysqli_query($con, "select * from film order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
                               <div class="form-group  ">
                                <label>Installment:</label>
                                <input type="text" name="Installment[]" class="form-control"/>
                                </div>
                              </div>
                                    </div>
                                    
                                      <div class="form-group">
                                 <label>Multiple Roles:</label>
                                 <select class="form-control" id="Multiple_Roles" name="Multiple_Roles" required>
                                     <option value="No">No</option>
                                     <option value="Yes">Yes</option>
                                   
                                     
                                </select>
                              </div>
                               <div id="is_Multiple_Roles" style="display: block;border: 1px solid black;padding: 14px;">
                                     <div class="field_wrapper_multiple_role">
                                <a href="javascript:void(0);" class="add_button_multiple_role btn btn-success pull-right" title="Add More">Add More</a>
                                     <div class="form-group">
                                <label>Actors Name:</label>
                               <select name="multiple_actor_name[]" class="form-control leadactor" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from cast order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                </div>
                                <div class="form-group">
                                <label>Character  Name:</label>
                                <input type="text" name="multiple_character_name[]" class="form-control"/>
                                </div>
                                <div class="form-group">
                                <label>Remarks:</label>
                                <input type="text" name="multiple_remarks[]" class="form-control"/>
                                </div>
                                </div>
                                </div>
                                   <div class="form-group">
                                 <label>Budget</label>
                                 <input type="text" class="form-control" name="budget" placeholder="Enter Budget"  >
                              </div>
                           <div class="form-group">
                                 <label> Date Release</label>
                                 <input type="text" class="form-control" name="date_release" placeholder="Enter  Date Release"  >
                              </div>
                          <div class="form-group">
                                 <label> Month Release</label>
                                 <input type="text" class="form-control" name="month_release" placeholder="Enter  Month Release"  >
                              </div>
                          <div class="form-group">
                                 <label> Year Release</label>
                                 <input type="text" class="form-control" name="year_release" placeholder="Enter  Year Release"  >
                              </div>
                              
                                 <div class="form-group">
                                 <label>Image</label>
                                   <input type="file"  name="filstor"  class="form-control">
                                  
                              </div>
                             

      <div class="form-group">
                                 <label>Is This Film Shelved/Unreleased?</label>
                             
 <select name="shelved_unreleased" class="form-control" > 
<option value="No">No</option>      
<option value="Yes">Yes</option>


                                 
                                 </select> 
                              </div>

              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="basic_details"  class="btn btn-add"  value="Add Basic Record">
                            
                              </div>
        </form>  
    </div>
    
    
    
    
    <div id="Trailer" class="tab-pane fade">
      <h3>Trailer Management</h3>
     <?
     $fetch_film_id="select * from film order by id desc limit 1";
     $exe_film_id=mysqli_query($con,$fetch_film_id) or die(mysqli_error($con));
     $read_film_id=mysqli_fetch_array($exe_film_id);
     ?>
          <form method="post" enctype="multipart/form-data"  >
      <div class="field_wrapper2">
                <a href="javascript:void(0);" class="add_button2 btn btn-success pull-right" title="Add More">Add More</a>
 
            <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="main_language"  class="form-control" name="film_id"  style="width:100%:"  required>
                                    <option value="">-Select Film-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div>        
          <div class="row">
              <div class="col-lg-12">
                  <div class="form-group">
                                 <label>Trailer Category</label>
                                 <select class="form-control" name="trailer_catgories[]">
                                     <option value="">-Please Select-</option>
                                      <? $sqlfr=mysqli_query($con, "select * from film_trailer_categories order by film_trailer_name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['film_trailer_name']; ?>"><? echo $rowfr['film_trailer_name']; ?></option>
                                  <? } ?>
                                </select>
                              </div>
            
            <div class="form-group  ">
                                <label>Trailer Lanaguage</label>
                                 
   <select class="main_language"  class="form-control" name="trailer_language[]" multiple="multiple" style="width:100%:" >
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                              
            <div class="form-group">
                                 <label>Teaser</label>
                                 <input type="text" class="form-control" name="teaser[]" >
                                  
                              </div>
                              
            <div class="form-group">
                                 <label>Trailer</label>
                                 <input type="text" class="form-control" name="trailer[]" >
                                  
                              </div>                  
            
            
            <div class="form-group">
                                 <label>Motional Poster</label>
                                   <input type="file"  name="motion_poster[]"  class="form-control">
                                  
                              </div>
                              
            <div class="form-group">
                                 <label>First Look Poster</label>
                                   <input type="file"  name="first_look_poster[]"  class="form-control">
                                  
                              </div>                  
                  
                  <div class="form-group">
                                 <label> Trailer Release Date</label>
                                 <input type="text" class="form-control" name="trailer_date_release[]" placeholder="Enter  Date Release"  >
                              </div>
                          <div class="form-group">
                                 <label> Trailer Release Month</label>
                                 <input type="text" class="form-control" name="trailer_month_release[]" placeholder="Enter  Month Release"  >
                              </div>
                          <div class="form-group">
                                 <label> Trailer Release Year</label>
                                 <input type="text" class="form-control" name="trailer_year_release[]" placeholder="Enter  Year Release"  >
                              </div>
                              
                              <div class="form-group">
                                 <label> YouTube upload Date</label>
                                 <input type="text" class="form-control" name="trailer_youtube_date_release[]" placeholder="Enter  Date Release"  >
                              </div>
                          <div class="form-group">
                                 <label> YouTube upload Month</label>
                                 <input type="text" class="form-control" name="trailer_youtube_month_release[]" placeholder="Enter  Month Release"  >
                              </div>
                          <div class="form-group">
                                 <label> YouTube upload Year</label>
                                 <input type="text" class="form-control" name="trailer_youtube_year_release[]" placeholder="Enter  Year Release"  >
                              </div>
                            <div class="form-group">
                                 <label> Views (Million/Billion)</label>
                                 <input type="text" class="form-control" name="trailer_youtube_views[]" >
                              </div>      
                          
                  </div>
                  </div>
                  
                
                   </div>
   
                               <div class="reset-button">

                                   <input type="submit" name="trailer_details"  class="btn btn-add"  value="Add Trailer Details">
                            
                              </div>
                             
                  </form>
                  
                    <?
                  
                  if(isset($_POST["trailer_details"]))
                  {
                      $film_id=mysqli_real_escape_string($con,$_POST["film_id"]); 
                      $trailer_catgories=mysqli_real_escape_string($con,implode(",",$_POST["trailer_catgories"])); 
                      $trailer_language=mysqli_real_escape_string($con,implode(",",$_POST["trailer_language"]));
                      $teaser=mysqli_real_escape_string($con,implode(",",$_POST["teaser"]));
                      $trailer=mysqli_real_escape_string($con,implode(",",$_POST["trailer"]));
                      $trailer_date_release=mysqli_real_escape_string($con,implode(",",$_POST["trailer_date_release"]));
                      $trailer_month_release=mysqli_real_escape_string($con,implode(",",$_POST["trailer_month_release"]));
                      $trailer_year_release=mysqli_real_escape_string($con,implode(",",$_POST["trailer_year_release"]));
                      $trailer_youtube_date_release=mysqli_real_escape_string($con,implode(",",$_POST["trailer_youtube_date_release"]));
                      $trailer_youtube_month_release=mysqli_real_escape_string($con,implode(",",$_POST["trailer_youtube_month_release"]));
                      $trailer_youtube_year_release=mysqli_real_escape_string($con,implode(",",$_POST["trailer_youtube_year_release"]));
                      $trailer_youtube_views=mysqli_real_escape_string($con,implode(",",$_POST["trailer_youtube_views"]));
                      $motion_poster=$_FILES['motion_poster']['name'];
                      $first_look_poster=$_FILES['first_look_poster']['name'];
                      $tmpName_motion_poster=$_FILES['motion_poster']['tmp_name']; 
                      $delimiter = ",";
                      $motion_poster_name = '';
                      $first_look_poster_name='';
    if($motion_poster<>"")
         {
        $files = array_filter($_FILES['motion_poster']['name']); //Use something similar before processing files.
// Count the number of uploaded files in array
$total_count = count($_FILES['motion_poster']['name']);
// Loop through every file
for( $i=0 ; $i < $total_count ; $i++ ) {
   //The temp file path is obtained
   $tmpFilePath = $_FILES['motion_poster']['tmp_name'][$i];
   //A file path needs to be present
   if ($tmpFilePath != ""){
       
            move_uploaded_file($tmpFilePath,"photo/".$_FILES['motion_poster']['name'][$i]);
            if (strlen($motion_poster_name)) {
                $motion_poster_name .= $delimiter;
            }
           
            $motion_poster_name .= $_FILES['motion_poster']['name'][$i];
         } 
        
   }
} 
         
         
           if($first_look_poster<>""){
         
        $files1 = array_filter($_FILES['first_look_poster']['name']); //Use something similar before processing files.
// Count the number of uploaded files in array
$total_count1 = count($_FILES['first_look_poster']['name']);
// Loop through every file
for( $j=0 ; $j < $total_count1 ; $j++ ) {
   //The temp file path is obtained
   $tmpFilePath1 = $_FILES['first_look_poster']['tmp_name'][$j];
   //A file path needs to be present
   if ($tmpFilePath1 != ""){
       
            move_uploaded_file($tmpFilePath1,"photo/".$_FILES['first_look_poster']['name'][$j]);
            if (strlen($first_look_poster_name)) {
                $first_look_poster_name .= $delimiter;
            }
           
            $first_look_poster_name .= $_FILES['first_look_poster']['name'][$j];
         } 
        
   }
           }
         
            $trailer_management_query="insert into  film_trailer_management set film_id='$film_id',trailer_category='$trailer_catgories',trailer_lanaguage='$trailer_language',teaser='$teaser',trailer='$trailer',motional_poster='$motion_poster_name',first_look_poster='$first_look_poster_name',trailer_release_date='$trailer_date_release',trailer_release_month='$trailer_month_release',trailer_release_year='$trailer_year_release',youtube_upload_date='$trailer_youtube_date_release',youtube_upload_month='$trailer_youtube_month_release',youtube_upload_year='$trailer_youtube_year_release',views='$trailer_youtube_views'"; 
                  mysqli_query($con,$trailer_management_query) or die(mysqli_error($con));
  echo "<script>alert('Trailer Details Save Succesfully')</script>";
  echo "<script>window.location.href='add_film.php?#Trailer'</script>";
            //header('location:film.php?msg=success');
                  }
               
                  
                  
                  ?>
    </div>
    
    
    
     <div id="Dubbed" class="tab-pane fade">
          <h3>Dubbed Management</h3>
           <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                   <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="main_language"  class="form-control" name="film_id"  style="width:100%:"  required>
                                    <option value="">-Select Film-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div>     
                            <div class="form-group">
                                 <label>DUBBED VERSION:</label>
                                 <select class="form-control" id="isdubbed" name="isdubbed" required>
                                     <option value="">-Please Select-</option>
                                     <option value="Yes">Yes</option>
                                     <option value="No">No</option>
                                     
                                </select>
                              </div>
                               <div id="isdubbedsection" style="display: block;border: 1px solid black;padding: 14px;">
                                  <fieldset>
                                      <legend>Please Fillout These Details Also:</legend>
                                   <div class="form-group">
                                 <label>Original Movie Name </label>
                                 <input type="text" class="form-control" name="original_movie_name[]" placeholder="Enter Original Movie Name"  >
                              </div>
                                  <div class="form-group">
                                <label>Original Lanaguage(s)</label>
                                

   <select class="form-control orignal_language" name="original_movie_language[]" multiple="multiple" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
                              
                              <div class="form-group">
                                <label>Dubbing Lanaguage(s)</label>
                                 
   <select class="dubbing_lang"  class="form-control" name="dubbing_movie_language[]" multiple="multiple" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
            <label>Dubbing Film Name</label>
            <input list="dubb_film_name_list" name="dubb_film_name[]" id="dubb_film_name" class="form-control">

<datalist id="dubb_film_name_list">
    <? $sqlfrm=mysqli_query($con, "select * from film order by name");
    while($rowfrm=mysqli_fetch_array($sqlfrm)){ ?>
 <option value="<? echo $rowfrm['name']; ?>"/>
     <? } ?>
</datalist>
                          
                              </div>
                              
                               <div class="form-group">
                                 <label>Release Date</label>
                                 <input type="text" class="form-control" name="dubbed_date_release[]" placeholder="Enter Release Date"  >
                              </div>
                          <div class="form-group">
                                 <label>Release Month</label>
                                 <input type="text" class="form-control" name="dubbed_month_release[]" placeholder="Enter Release Month"  >
                              </div>
                          <div class="form-group">
                                 <label>Release Year</label>
                                 <input type="text" class="form-control" name="dubbed_year_release[]" placeholder="Enter Release Year"  >
                              </div>
                               <div class="form-group  ">
                                <label>Genre(s)</label>
                                 
   <select class="main_language"  class="form-control" name="dubbed_Genre[]" multiple="multiple" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from genre order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                                <div class="form-group">
                                 <label>YouTube Movie Link</label>
                                 <input type="text" class="form-control" name="dubbed_youtube_link[]" placeholder="Enter You Tube Movie Link"  >
                              </div>
                              <div class="form-group">
                                 <label>Upload Full Date:</label>
                             
                              </div>
                               <div class="form-group">
                                 <label>Upload Date</label>
                                 <input type="text" class="form-control" name="dubbed_date_release_youtube[]" placeholder="Enter Release Date"  >
                              </div>
                          <div class="form-group">
                                 <label>Upload Month</label>
                                 <input type="text" class="form-control" name="dubbed_month_release_youtube[]" placeholder="Enter Release Month"  >
                              </div>
                          <div class="form-group">
                                 <label>Upload Year</label>
                                 <input type="text" class="form-control" name="dubbed_year_release_youtube[]" placeholder="Enter Release Year"  >
                              </div>
                              </fieldset>
                               
                                           <br/>
        <div class="field_wrapper1">
    <label>OTT Platform Details</label>
          <a href="javascript:void(0);" class="add_button1 btn btn-success" title="Add More">Add More</a>
                           <div class="form-group">
                                <label>OTT Platform Name:</label>
                                 
   <select  class="form-control" name="dubbed_ott_name[]"  style="width:100%;">
       <option value="">-Please Select OTT Platform-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
            <label>Link</label>
            <input type="text" name="dubbed_ott_link[]" id="ott_link" class="form-control">
   </div>
                              
   
</div>
                             
                            <div class="form-group">
                                 <label>More than 1 Dubbed Versions:</label>
                                 <select class="form-control" id="ismoredubbed" name="ismoredubbed">
                                     <option value="">-Please Select-</option>
                                     <option value="Yes">Yes</option>
                                     <option value="No">No</option>
                                     
                                </select>
                              </div> 
                               <div id="ismoredubbedsection" style="display: block;border: 1px solid black;padding: 14px;">
                                   <div class="field_wrapper">
  
          <a href="javascript:void(0);" class="add_button btn btn-success" title="Add More">Add More</a>
                           
                           
                           
                           
                           <div class="form-group">
                                 <label>Original Movie Name </label>
                                 <input type="text" class="form-control" name="original_movie_name[]" placeholder="Enter Original Movie Name"  >
                              </div>
                                  <div class="form-group">
                                <label>Original Lanaguage(s)</label>
                                 
   <select class="form-control orignal_language" name="original_movie_language[]" multiple="multiple" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
                              
                              <div class="form-group">
                                <label>Dubbing Lanaguage(s)</label>
                                 
   <select class="dubbing_lang"  class="form-control" name="dubbing_movie_language[]" multiple="multiple" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
            <label>Dubbing Film Name</label>
            <input list="dubb_film_name_list" id="dubb_film_name" name="dubb_film_name[]" class="form-control">

<datalist id="dubb_film_name_list">
    <? $sqlfrm=mysqli_query($con, "select * from film order by name");
    while($rowfrm=mysqli_fetch_array($sqlfrm)){ ?>
 <option value="<? echo $rowfrm['name']; ?>"/>
     <? } ?>
</datalist>
                          
                              </div>
                              
                               <div class="form-group">
                                 <label>Release Date</label>
                                 <input type="text" class="form-control" name="dubbed_date_release[]" placeholder="Enter Release Date"  >
                              </div>
                          <div class="form-group">
                                 <label>Release Month</label>
                                 <input type="text" class="form-control" name="dubbed_month_release[]" placeholder="Enter Release Month"  >
                              </div>
                          <div class="form-group">
                                 <label>Release Year</label>
                                 <input type="text" class="form-control" name="dubbed_year_release[]" placeholder="Enter Release Year"  >
                              </div>
                               <div class="form-group  ">
                                <label>Genre(s)</label>
                                 
   <select class="main_language"  class="form-control" name="dubbed_Genre[]" multiple="multiple" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from genre order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                                <div class="form-group">
                                 <label>YouTube Movie Link</label>
                                 <input type="text" class="form-control" name="dubbed_youtube_link[]" placeholder="Enter You Tube Movie Link"  >
                              </div>
                              <div class="form-group">
                                 <label>Upload Full Date:</label>
                             
                              </div>
                               <div class="form-group">
                                 <label>Upload Date</label>
                                 <input type="text" class="form-control" name="dubbed_date_release_youtube[]" placeholder="Enter Release Date"  >
                              </div>
                          <div class="form-group">
                                 <label>Upload Month</label>
                                 <input type="text" class="form-control" name="dubbed_month_release_youtube[]" placeholder="Enter Release Month"  >
                              </div>
                          <div class="form-group">
                                 <label>Upload Year</label>
                                 <input type="text" class="form-control" name="dubbed_year_release_youtube[]" placeholder="Enter Release Year"  >
                              </div>
                                       <br/>
        <div class="field_wrapper1">
    <label>OTT Platform Details</label>
          <a href="javascript:void(0);" class="add_button1 btn btn-success" title="Add More">Add More</a>
                           <div class="form-group">
                                <label>OTT Platform Name:</label>
                                 
   <select  class="form-control" name="dubbed_ott_name[]"  style="width:100%;">
       <option value="">-Please Select OTT Platform-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
            <label>Link</label>
            <input type="text" name="dubbed_ott_link[]" id="ott_link" class="form-control">
   </div>
                              
   
</div>
    
   
</div>
    </div>
            
                    
                    
                              
           </div>                    
                    <div class="reset-button">

                                   <input type="submit" name="dubbed_details"  class="btn btn-add"  value="Add Dubbed Details">
                            
                              </div>          
        </div>
                        
        </div>
        </form>
        <?
        if(isset($_POST["dubbed_details"]))
        {
                      $film_id=mysqli_real_escape_string($con,$_POST["film_id"]); 
                      $isdubbed=mysqli_real_escape_string($con,$_POST["isdubbed"]);
                      $ismoredubbed=mysqli_real_escape_string($con,$_POST["ismoredubbed"]); 
                      $original_movie_name=mysqli_real_escape_string($con,implode(",",$_POST["original_movie_name"]));
                      $original_movie_language=mysqli_real_escape_string($con,implode(",",$_POST["original_movie_language"]));
                      $dubbing_movie_language=mysqli_real_escape_string($con,implode(",",$_POST["dubbing_movie_language"]));
                      $dubb_film_name=mysqli_real_escape_string($con,implode(",",$_POST["dubb_film_name"]));
                      $dubbed_date_release=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_date_release"]));
                      $dubbed_month_release=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_month_release"]));
                      $dubbed_year_release=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_year_release"]));
                      $dubbed_Genre=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_Genre"]));
                      $dubbed_youtube_link=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_youtube_link"]));
                      $dubbed_date_release_youtube=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_date_release_youtube"]));
                      $dubbed_month_release_youtube=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_month_release_youtube"]));
                      $dubbed_year_release_youtube=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_year_release_youtube"]));
                      $dubbed_ott_name=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_ott_name"]));
                      $dubbed_ott_link=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_ott_link"]));
                      $dubbed_details_q="insert into film_dubbed_management set film_id='$film_id',original_movie_name='$original_movie_name',original_lanaguage='$original_movie_language',dubbing_lanaguage='$dubbing_movie_language',dubbing_film_name='$dubb_film_name',release_date='$dubbed_date_release',release_month='$dubbed_month_release',release_year='$dubbed_year_release',genre='$dubbed_Genre',youtube_movie_link='$dubbed_youtube_link',upload_date='$dubbed_date_release_youtube',upload_month='$dubbed_month_release_youtube',upload_year='$dubbed_year_release_youtube',ott_platform_name='$dubbed_ott_name',ott_link='$dubbed_ott_link',isdubbed='$isdubbed',more_than_dubbed_versions='$ismoredubbed'";
                       mysqli_query($con,$dubbed_details_q) or die(mysqli_error($con));
  echo "<script>alert('Dubbed Details Save Succesfully')</script>";
  echo "<script>window.location.href='add_film.php?#Dubbed'</script>";
        }
        
        ?>
        
        
        
    </div>
    <div id="Crew_1" class="tab-pane fade">
       <h3>Crew Management</h3>
     <div class="row">
         <div class="col-lg-6 col-md-6">
             
                 <fieldset class="scheduler-border">
    <legend class="scheduler-border">Genre</legend>
      <form class="col-sm-12" method="post" id="Genre" enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                  <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="form-control main_language" id="film_id" name="film_id"  style="width:100%:"  required>
                                    <option value="">-Select Film-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div>     
              </td>
          </tr>
                 <tr>
                     <td>
                                                          
  <select name="genre_id[]" id="genre_id"  class="form-control main_language"   multiple="multiple" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from genre order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                   <input type="hidden" name="id" value="<? echo $row['id'];?>">
                     </td>
                 
                          
                            
                            </tr>
                            <tr>
                                 <td>
                                
                               <input type="submit" name="UpdateGenre" id="UpdateGenre" class="btn btn-add"   value="Add Genre">  
                            </td> 
                            </tr>
                </table>
                </form>
                
               
 <script>
        $(document).ready(function(){
            $("#UpdateGenre").click(function(){
                var genre= $("#genre_id").val();
                var film= $("#film_id").val();
                $.ajax({
                    url:'genre_insert.php',
                    method:'POST',
                    data:{
                        film_id:film,
                        genre_id:genre
                    },
                   success:function(data){
                       //alert(data);
                   }
                });
            });
        });
    </script>





                    </fieldset>        
                             
                



 
     
     <fieldset class="scheduler-border">
    <legend class="scheduler-border">Director(s)</legend>
    <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
                 <tr>
                    
                         <td>
                             <select name="director_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                         </td>
                                <td>
                                    
                                    <input type="submit" name="UpdateDirector" class="btn btn-add"   value="Add  Director">
                                </td> 
                                </tr>
                                </table>
                                </form>
                                <form  method="post" action=""   enctype="multipart/form-data"  >
                                 <table class="table table-bordered">
                               <tr>
                                   <td>
                                         
                                 
  <select name="codirector_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                                   </td>
                                   <td>
                                         <input type="submit" name="UpdateCoDirector" class="btn btn-add"   value="Add Co-Director"> 
                                   </td>
                               </tr> 
                                
                                
                                 </table>
                                 </form>
                                 
                               
                                      <form  method="post" action=""   enctype="multipart/form-data"  >
                                 <table class="table table-bordered">
                                     <td>
                     
  <select name="assistant_director_id" class="form-control searchwithselect2" style="width:100%;">
                                 <? $sqlfr=mysqli_query($con, "select * from director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                          
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                            </td>
                                     <td>
                                           <input type="submit" name="Updateartdirector" class="btn btn-add"   value="Add Assistant Director">
                                     </td>
                                      </table>
                                     </form>
                                      <form  method="post" action=""   enctype="multipart/form-data"  >
                                 <table class="table table-bordered">
                                     <td>
                     
  <select name="associate_director_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                          
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                            </td>
                                     <td>
                                           <input type="submit" name="Updateartdirector" class="btn btn-add"   value="Add Associate Director">
                                     </td>
                                      </table>
                                     </form>
                                      <form  method="post" action=""   enctype="multipart/form-data"  >
                                 <table class="table table-bordered">
                                     <td>
                     
  <select name="first_assistant_director_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                          
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                            </td>
                                     <td>
                                           <input type="submit" name="Updateartdirector" class="btn btn-add"   value="Add First Assistant Director">
                                     </td>
                                      </table>
                                     </form>
                                      <form  method="post" action=""   enctype="multipart/form-data"  >
                                 <table class="table table-bordered">
                                     <td>
                     
  <select name="second_assistant_director_id" class="form-control searchwithselect2" style="width:100%;">
                                 <? $sqlfr=mysqli_query($con, "select * from director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                          
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                            </td>
                                     <td>
                                           <input type="submit" name="Updateartdirector" class="btn btn-add"   value="Add Second Assistant Director">
                                     </td>
                                      </table>
                                     </form>
                                     
                    </fieldset>        

 
     <fieldset class="scheduler-border">
    <legend class="scheduler-border">Music Director(s)</legend>
    <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
                 <tr>
                    
                         <td>
 
                                 
  <select name="music_director_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                              </td>
                               
                             <td>
                                 <input type="submit" name="UpdateMusicDirector" class="btn btn-add"   value="Add Music Director"> 
                             </td>
                             </tr>
 </table>
</form>


 <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
                 <tr>
                    
                         <td>
 
                                 
  <select name="music_background_scorer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                              </td>
                               
                             <td>
                                     <input type="submit" name="UpdateBackgroundScorer" class="btn btn-add"   value="Add Background Scorer">
                             </td>
                             </tr>
 </table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
                 <tr>
                    
                         <td>
 
                                 
  <select name="music_background_scorer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                              </td>
                               
                             <td>
                                     <input type="submit" name="UpdateBackgroundScorer" class="btn btn-add"   value="Add Music Producer">
                             </td>
                             </tr>
 </table>
</form>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
                 <tr>
                    
                         <td>
 
                                 
  <select name="music_background_scorer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                              </td>
                               
                             <td>
                                     <input type="submit" name="UpdateBackgroundScorer" class="btn btn-add"   value="Add Lyricist">
                             </td>
                             </tr>
 </table>
</form>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
                 <tr>
                    
                         <td>
 
                                 
  <select name="music_background_scorer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                              </td>
                               
                             <td>
                                     <input type="submit" name="UpdateBackgroundScorer" class="btn btn-add"   value="Add Additional Lyrics">
                             </td>
                             </tr>
 </table>
</form>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
                 <tr>
                    
                         <td>
 
                                 
  <select name="music_background_scorer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                              </td>
                               
                             <td>
                                     <input type="submit" name="UpdateBackgroundScorer" class="btn btn-add"   value="Add Rap">
                             </td>
                             </tr>
 </table>
</form>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
                 <tr>
                    
                         <td>
 
                                 
  <select name="music_background_scorer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                              </td>
                               
                             <td>
                                     <input type="submit" name="UpdateBackgroundScorer" class="btn btn-add"   value="Add Playback Singer">
                             </td>
                             </tr>
 </table>
</form>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
                 <tr>
                    
                         <td>
 
                                 
  <select name="music_background_scorer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                              </td>
                               
                             <td>
                                     <input type="submit" name="UpdateBackgroundScorer" class="btn btn-add"   value="Add Music Label">
                             </td>
                             </tr>
 </table>
</form>
 </fieldset>  

  <fieldset class="scheduler-border">
    <legend class="scheduler-border">Production Designer(s)</legend>
    <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Production Designer">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Chief Assistant Art Director">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Assistant Art Director">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Assistant Production Designer">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Graphic Designer">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Set Decorator">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Set Dresser">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add 3D Set Visualizer">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
                                 <table class="table table-bordered">
                                     <td>
                     
  <select name="art_director_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                          
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                            </td>
                                     <td>
                                           <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Art Director">
                                     </td>
                                      </table>
                                     </form>
                                     
<form  method="post" action=""   enctype="multipart/form-data"  >
                                 <table class="table table-bordered">
                                     <td>
                     
  <select name="art_director_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                          
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                            </td>
                                     <td>
                                           <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Associate Production Designer">
                                     </td>
                                      </table>
                                     </form>                                     
</fieldset>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Production and Distribution</legend>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Production Company">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Distributing Company">
                  </td>
                      
                  </tr>
</table>
</form>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Makeup</legend>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Makeup Artist">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Assistant Makeup Artist">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Prosthetic Makeup Artist">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Assistant Prosthetic Makeup Artist">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Hair Stylist">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Assistant Hair">
                  </td>
                      
                  </tr>
</table>
</form>

</fieldset>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Visual Effects</legend>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Visual Effects">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Visual Effect Supervisor">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Compositor">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Digital Compositor">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Senior Compositor">
                  </td>
                      
                  </tr>
</table>
</form>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Casting</legend>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Casting Director">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Casting Associate">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Casting Assistant">
                  </td>
                      
                  </tr>
</table>
</form>

</fieldset>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Additional Contributors</legend>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Publicity Designer">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Public Relation Officer">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add DI">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Colourist">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Still Photographer">
                  </td>
                      
                  </tr>
</table>
</form>
</fieldset>

         </div>
        <!--New Crew Members start-->
        
        <div class="col-lg-6 col-md-6">
          
        <fieldset class="scheduler-border">
    <legend class="scheduler-border">Producer(s)</legend>
    <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                  <select name="producer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                   <input type="hidden" name="id" value="<? echo $row['id'];?>">
                                 </td>
                                 <td>
                                        <input type="submit" name="UpdateProducer" class="btn btn-add"   value="Add  Producer">
                                 </td>
              
          </tr>
          
         </table>
         </form>
         
          <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="co_producer" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                   <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateCoProducer" class="btn btn-add"   value="Add Co-Producer">
                  </td>
                  </tr>
                  </table>
                  </form>
         
          <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                  <select name="line_producer" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
              </td>
              <td>
                    <input type="submit" name="UpdateLineProducer" class="btn btn-add"   value="Add Line Producer">
              </td>
                </tr>
                </table>
                </form>
                
                
                  <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                   <select name="film_executive_producer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
              </td>
              <td>
                    <input type="submit" name="UpdateExecutiveProducer" class="btn btn-add"   value="Add Executive Producer">
              </td>
                </tr>
                </table>
                </form>
                
                 <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                   <select name="film_supervising_producer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
              </td>
              <td>
                   <input type="submit" name="UpdateSupervisingProducer" class="btn btn-add"   value="Add Supervising Producer">
              </td>
                </tr>
                </table>
                </form>
                
                <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                   <select name="film_supervising_producer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
              </td>
              <td>
                   <input type="submit" name="UpdateSupervisingProducer" class="btn btn-add"   value="Add Associate Producer">
              </td>
                </tr>
                </table>
                </form>
                <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                   <select name="film_supervising_producer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
              </td>
              <td>
                   <input type="submit" name="UpdateSupervisingProducer" class="btn btn-add"   value="Add Creative Producer">
              </td>
                </tr>
                </table>
                </form>
                <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                   <select name="film_supervising_producer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
              </td>
              <td>
                   <input type="submit" name="UpdateSupervisingProducer" class="btn btn-add"   value="Add Post Producer">
              </td>
                </tr>
                </table>
                </form>
                
                <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                   <select name="film_supervising_producer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
              </td>
              <td>
                   <input type="submit" name="UpdateSupervisingProducer" class="btn btn-add"   value="Add Presenter">
              </td>
                </tr>
                </table>
                </form>
                
         </fieldset>
          
                <fieldset class="scheduler-border">
    <legend class="scheduler-border">Film Editor(s)</legend>
    <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                  
              
               <select name="film_editor_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from film_editor order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                           </td>   
                           <td>
                                  <input type="submit" name="UpdateFilmEditor" class="btn btn-add"   value="Add Film Editor">
                           </td>
              </tr>
                </table>
                </form>
                
                <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                  
              
               <select name="film_editor_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from film_editor order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                           </td>   
                           <td>
                                  <input type="submit" name="UpdateFilmEditor" class="btn btn-add"   value="Add Associate Editor">
                           </td>
              </tr>
                </table>
                </form>
         </fieldset> 

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Screenplay(s)</legend>
    <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                  
            
               <select name="film_screenplay_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from screenplay order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                                   </td>
                                 <td>
                                       <input type="submit" name="UpdateScreenplay" class="btn btn-add"   value="Add Screenplay">
                                 </td>
          </tr>
</table>
</form>

 <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                  
            
               <select name="film_screenplay_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from screenplay order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                                   </td>
                                 <td>
                                       <input type="submit" name="UpdateScreenplay" class="btn btn-add"   value="Add Additional Screenplay">
                                 </td>
          </tr>
</table>
</form>

 <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                  
            
               <select name="film_screenplay_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from screenplay order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                                   </td>
                                 <td>
                                       <input type="submit" name="UpdateScreenplay" class="btn btn-add"   value="Add Additional Dialogue">
                                 </td>
          </tr>
</table>
</form>

 <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                  
            
               <select name="film_screenplay_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from screenplay order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                                   </td>
                                 <td>
                                       <input type="submit" name="UpdateScreenplay" class="btn btn-add"   value="Add Story">
                                 </td>
          </tr>
</table>
</form>

 <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                  
            
               <select name="film_screenplay_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from screenplay order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                                   </td>
                                 <td>
                                       <input type="submit" name="UpdateScreenplay" class="btn btn-add"   value="Add Screenplay Adapted">
                                 </td>
          </tr>
</table>
</form>

 <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                  
            
               <select name="film_screenplay_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from screenplay order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                                   </td>
                                 <td>
                                       <input type="submit" name="UpdateScreenplay" class="btn btn-add"   value="Add Dialouge">
                                 </td>
          </tr>
</table>
</form>

 <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                  
            
               <select name="film_screenplay_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from screenplay order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                                   </td>
                                 <td>
                                       <input type="submit" name="UpdateScreenplay" class="btn btn-add"   value="Add Adapted Story">
                                 </td>
          </tr>
</table>
</form>

</fieldset>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Choreographer(s)</legend>
    <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
 
                                 
  <select name="film_choreographer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from choreographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                              </td>
                               
                             
                            <td>
                                 <input type="submit" name="UpdateChoreographer" class="btn btn-add"   value="Add Choreographer">
                            </td>
   </tr>
                                
        </table>                          
                              
</form>


 <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
 
                                 
  <select name="film_choreographer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from choreographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                              </td>
                               
                             
                            <td>
                                 <input type="submit" name="UpdateChoreographer" class="btn btn-add"   value="Add Director of Choreography">
                            </td>
   </tr>
                                
        </table>                          
                              
</form>

 <form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
 
                                 
  <select name="film_choreographer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from choreographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  <input type="hidden" name="id" value="<? echo $row['id'];?>">
                              </td>
                               
                             
                            <td>
                                 <input type="submit" name="UpdateChoreographer" class="btn btn-add"   value="Add Assistant Choreographer">
                            </td>
   </tr>
                                
        </table>                          
                              
</form>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Action Director(s)</legend>
    <form  method="post" action=""   enctype="multipart/form-data"  >
                                 <table class="table table-bordered">
                                     <td>
                                          <select name="film_action_director_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from actiondirector order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                           
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                                     </td>
                                     <td>
                                            <input type="submit" name="UpdateActionDirector" class="btn btn-add"   value="Add Action Director"> 
                                     </td>
                                     </table>
                                     </form>
                                     
                                       <form  method="post" action=""   enctype="multipart/form-data"  >
                                 <table class="table table-bordered">
                                     <td>
                                          <select name="film_action_director_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from actiondirector order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                           
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                                     </td>
                                     <td>
                                            <input type="submit" name="UpdateActionDirector" class="btn btn-add"   value="Add Stunts"> 
                                     </td>
                                     </table>
                                     </form>
                                       <form  method="post" action=""   enctype="multipart/form-data"  >
                                 <table class="table table-bordered">
                                     <td>
                                          <select name="film_action_director_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from actiondirector order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                           
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                                     </td>
                                     <td>
                                            <input type="submit" name="UpdateActionDirector" class="btn btn-add"   value="Add Stunts Coordinator"> 
                                     </td>
                                     </table>
                                     </form>
                                       <form  method="post" action=""   enctype="multipart/form-data"  >
                                 <table class="table table-bordered">
                                     <td>
                                          <select name="film_action_director_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from actiondirector order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                           
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                                     </td>
                                     <td>
                                            <input type="submit" name="UpdateActionDirector" class="btn btn-add"   value="Add Fight Master"> 
                                     </td>
                                     </table>
                                     </form>
                                     
                                     
</fieldset>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Sound</legend>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Dialogue Editor">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Sound Designer">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Sound Mixing">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Audio Mastering">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Sound Effect Editor">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Sound Recordist">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Re-Recordist Mixer">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Production Sound Mixer">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Boom  Operator">
                  </td>
                      
                  </tr>
</table>
</form>


</fieldset>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Costumes</legend>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Costume Designer">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Assistant Costume Designer">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Wardrobe Supervisor">
                  </td>
                      
                  </tr>
</table>
</form>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Production Manangement</legend>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Production Controller">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Production Coordinator">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Production Assistant">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Post Production Supervisor">
                  </td>
                      
                  </tr>
</table>
</form>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Cinematographer</legend>
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Cinematographer">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Director of Photography">
                  </td>
                      
                  </tr>
</table>
</form>

<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Associate Cinematographer">
                  </td>
                      
                  </tr>
</table>
</form>
    
<form  method="post" action=""   enctype="multipart/form-data"  >
      <table class="table table-bordered">
          <tr>
              <td>
                    <select name="film_production_designer_id" class="form-control searchwithselect2" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 <input type="hidden" name="id" value="<? echo $row['id'];?>">
                  </td>
                  <td>
                        <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Assistant Cinematographer">
                  </td>
                      
                  </tr>
</table>
</form>

</fieldset>



         </div>
        <!--New Crew Members End-->
     </div>
    </div>
    <div id="Cast_1" class="tab-pane fade">
       <h3>Cast Management</h3>
     <div class="row">
         <div class="col-lg-6 col-md-6">
            
             <center><h2>Lead Cast</h2></center>
                <form method="post" action=""   enctype="multipart/form-data">
                      <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="main_language"  class="form-control" name="film_id"  style="width:100%:"  required>
                                    <option value="">-Select Film-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div>    
             
          <div class="form-group">
    <label for="LeadCast">Lead Cast:</label>
 <select name="film_lead_cast_id" class="form-control leadactor" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from cast order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
  </div>
  <div class="form-group">
    <label for="character">Character Details:</label>
    <input type="text" class="form-control" id="character" name="characterdetails" >
  </div>
   <div class="form-group">
    <label for="remark">Character Remark:</label>
    <input type="text" class="form-control" id="remark" name="remark" >
  </div>
 <input type="submit" name="UpdateLeadCast" id="leadcast" class="btn btn-add"   value="Add Lead Cast">
 </form>
         </div>
        <!--New Crew Members start-->
        
        <div class="col-lg-6 col-md-6">
          
         
             <center><h2>Other Cast</h2></center>
              <form method="post" action=""   enctype="multipart/form-data"  >
             <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="main_language"  class="form-control" name="film_id"  style="width:100%:"  required>
                                    <option value="">-Select Film-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div>    
          <div class="form-group">
    <label for="OtherCast">Other Cast:</label>
 <select name="cast_id" class="form-control leadactor" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from cast order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
  </div>
  <div class="form-group">
    <label for="character">Character Details:</label>
    <input type="text" class="form-control" id="character" name="othercharacterdetails" >
  </div>
   <div class="form-group">
    <label for="remark">Character Remark:</label>
    <input type="text" class="form-control" id="otherremark" name="otherremark" >
  </div>
  <input type="submit" name="UpdateCast" class="btn btn-add"   value="Add Cast">
 </form>
             
         </div>
        <!--New Crew Members End-->
     </div>
    </div>
     <div id="Rating" class="tab-pane fade">
      <h3>Rating Management</h3>
      <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                    <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="main_language"  class="form-control" name="film_id"  style="width:100%:"  required>
                                    <option value="">-Select Film-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div>   
                   <div class="form-group">
                                 <label>Rotten Tomato Rating</label>
                                 <input type="text" class="form-control" name="rotten_rating" placeholder="Enter Rotten Tomato Rating"  >
                              </div>
                              <div class="form-group">
                                 <label>IMDB Rating</label>
                                 <input type="text" class="form-control" name="imdb_rating" placeholder="Enter IMDB Rating"  >
                              </div>
                              <div class="form-group">
                                 <label>Rating</label>
                                 <input type="text" class="form-control" name="rating" placeholder="Enter Rating"  >
                              </div>
                                <div class="form-group">
                                 <label>CBFC Rating</label>
                              
 <select name="cbfc_rating" class="form-control"> 
                                 

<option value="">-Please Select-</option>
<option value="A" <? if($row['cbfc_rating']=="A"){echo "selected"; } ?> >A</option>
<option value="UA" <? if($row['cbfc_rating']=="UA"){echo "selected"; } ?> >UA</option>
<option value="U" <? if($row['cbfc_rating']=="U"){echo "selected"; } ?> >U</option>
<option value="S" <? if($row['cbfc_rating']=="S"){echo "selected"; } ?> >S</option>
                                 
                                 </select>
                              </div>
                                <div class="form-group">
                                 <label>cbfc_certificate_no</label>
                                 <input type="text" class="form-control" name="cbfc_certificate_no" placeholder="Enter cbfc_certificate_no" value="<? echo $row['cbfc_certificate_no'];?>" >
                              </div>

    
                              
      <div class="form-group">
                                 <label>cbfc_certificate_date</label>
                                 <input type="text" class="form-control" name="cbfc_certificate_date" placeholder="Enter cbfc_certificate_date" value="<? echo $row['cbfc_certificate_date'];?>" >
                              </div>
                        
      <div class="form-group">
                                 <label>cbfc_certificate_month</label>
                                 <input type="text" class="form-control" name="cbfc_certificate_month" placeholder="Enter cbfc_certificate_month" value="<? echo $row['cbfc_certificate_month'];?>" >
                              </div>
                        
      <div class="form-group">
                                 <label>cbfc_certificate_year</label>
                                 <input type="text" class="form-control" name="cbfc_certificate_year" placeholder="Enter cbfc_certificate_year" value="<? echo $row['cbfc_certificate_year'];?>" >
                              </div>

                          
      <div class="form-group">
                                 <label>cbfc_running_time_minutes</label>
                                 <input type="text" class="form-control" name="cbfc_running_time_minutes" placeholder="Enter cbfc_running_time_minutes" value="<? echo $row['cbfc_running_time_minutes'];?>" >
                              </div>

                              
      <div class="form-group">
                                 <label>cbfc_running_time_seconds</label>
                                 <input type="text" class="form-control" name="cbfc_running_time_seconds" placeholder="Enter cbfc_running_time_seconds" value="<? echo $row['cbfc_running_time_seconds'];?>" >
                              </div>
                              
                               <div class="form-group">
                                 <label>Select CBFC Releasing Platform</label>
                                            
 <select name="cbfc_releasing_platform" id="cbfc_releasing_platform" class="form-control" required>
     <option value="">-Please Select-</option> 
<? $sqlfr=mysqli_query($con, "select * from platform order by platform_name");
                                  while($rowfr1=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr1['platform_name']; ?>"><? echo $rowfr1['platform_name']; ?></option>
                                  <? } ?>
                                 
                                 </select> 
                              </div>

                              
      <div class="form-group" id="ott_platform">
                                 <label>OTT Platform Name:</label>
                                 <select name="cbfc_releasing_platform_details" id="cbfc_releasing_platform_details" class="form-control">
                                 <option value="">-Please Select-</option> 
<? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                  while($rowfr1=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr1['name']; ?>"><? echo $rowfr1['name']; ?></option>
                                  <? } ?>
                                 
                                 </select> 
                              </div>
                               <div class="reset-button">
                               <input type="submit" name="UpdateRating" class="btn btn-add"   value="Add Rating">
                               </div>
              </div>
              
              </div>
             
              </form>
              <?php
               if(isset($_POST["UpdateRating"]))
                  {
                      $film_id=mysqli_real_escape_string($con,$_POST["film_id"]); 
                      $rotten_rating=mysqli_real_escape_string($con,$_POST["rotten_rating"]); 
                      $imdb_rating=mysqli_real_escape_string($con,$_POST["imdb_rating"]);
                      $rating=mysqli_real_escape_string($con,$_POST["rating"]);
                      $cbfc_rating=mysqli_real_escape_string($con,$_POST["cbfc_rating"]);
                      $cbfc_certificate_no=mysqli_real_escape_string($con,$_POST["cbfc_certificate_no"]);
                      $cbfc_certificate_date=mysqli_real_escape_string($con,$_POST["cbfc_certificate_date"]);
                      $cbfc_certificate_month=mysqli_real_escape_string($con,$_POST["cbfc_certificate_month"]);
                      $cbfc_certificate_year=mysqli_real_escape_string($con,$_POST["cbfc_certificate_year"]);
                      $cbfc_running_time_minutes=mysqli_real_escape_string($con,$_POST["cbfc_running_time_minutes"]);
                      $cbfc_running_time_seconds=mysqli_real_escape_string($con,$_POST["cbfc_running_time_seconds"]);
                      $cbfc_releasing_platform=mysqli_real_escape_string($con,$_POST["cbfc_releasing_platform"]);
                      $cbfc_releasing_platform_details=mysqli_real_escape_string($con,$_POST["cbfc_releasing_platform_details"]);
                      $rating_value="insert into film_rating_management set film_id='$film_id',rotten_tomato_rating='$rotten_rating',imdb_rating='$imdb_rating',rating='$rating',cbfc_rating='$cbfc_rating',certificate_no='$cbfc_certificate_no',certificate_date='$cbfc_certificate_date',certificate_month='$cbfc_certificate_month',certificate_year='$cbfc_certificate_year',running_time_minutes='$cbfc_running_time_minutes',running_time_seconds='$cbfc_running_time_seconds',releasing_platform='$cbfc_releasing_platform',nlatform_name='$cbfc_releasing_platform_details'";
                      mysqli_query($con,$rating_value);
                      echo "<script>alert('Rating Details Save Successfully')</script>";
                      }
                      ?>
    </div>
    <div id="Similar" class="tab-pane fade">
      <h3>Similar Film</h3>
      <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                   <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="main_language"  class="form-control" name="film_id"  style="width:100%:"  required>
                                    <option value="">-Select Film-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div>  
                            <div class="form-group">
                                 <label>Is any other movie with same name</label>
                                 <select class="form-control" id="similar" name="same_movies_name" required>
                                     <option value="">-Please Select-</option>
                                     <option value="Yes">Yes</option>
                                     <option value="No">No</option>
                                     
                                </select>
                              </div>
                               <div id="similardetails" style="display: block;border: 1px solid black;padding: 14px;">
                                  <fieldset>
                                      <legend>Please Fillout These Details Also:</legend>
                                      
                                    <div class="field_wrapper5">
                                    	<a href="javascript:void(0);" class="add_button5 btn btn-success " title="Add More">Add More</a>
                                    
                                    <br>
                                  <div class="form-group">
            <label>Select Movie Name:</label>
            <input list="dubb_film_name_list" id="dubb_film_name" class="form-control" name="movies_add[]" />

<datalist id="dubb_film_name_list">
    <? $sqlfrm=mysqli_query($con, "select * from film order by name");
    while($rowfrm=mysqli_fetch_array($sqlfrm)){ ?>
 <option value="<? echo $rowfrm['name']; ?>"/>
     <? } ?>
</datalist>
                          
                              </div>
                              
                        </div>      
                          </fieldset>
                          
           </div>        
            <div class="reset-button">
               <input type="submit" name="Updatesimiler" class="btn btn-add"   value="Add Similar" style="margin-top:10px;">     
               </div>
        </div>
        
        </div>
       
        </form>
         <?php
               if(isset($_POST["Updatesimiler"]))
                  {
                      $film_id=mysqli_real_escape_string($con,$_POST["film_id"]); 
                      $same_movies_name=mysqli_real_escape_string($con,$_POST["same_movies_name"]); 
                      $add_more_movies=mysqli_real_escape_string($con,implode(",",$_POST["movies_add"]));
                      
                      $similar_value="insert into similar_page set film_id='$film_id',movies_name='$same_movies_name',film_name='$add_more_movies'";
                      mysqli_query($con,$similar_value);
                      echo "<script>alert('Similar Film Details Save Successfully')</script>";
                      }
                      ?>
    </div>
     <div id="Box_Office" class="tab-pane fade">
      <h3>Box Office Management</h3>
       <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                    <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="main_language"  class="form-control" name="film_id"  style="width:100%:"  required>
                                    <option value="">-Select Film-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div>   
                  <div class="form-group">
                                 <label>Currency Symbol</label>
                                 <select class="form-control" name="currency_symbol">
                                     <option value="">-Select Type-</option>
                                     <option value="1">&#8377; Rupee</option>
                                     <option value="2">&#36; Dollar</option>
                                </select>
                              </div>
                              
       <div class="form-group">
                                 <label>Box Office India Nett</label>
                                 <input type="text" class="form-control" name="box_office_india_net" placeholder="Enter Box Office India Nett"  >
                              </div>
        <div class="form-group">
                                 <label>Box Office India Gross</label>
                                 <input type="text" class="form-control" name="box_office_india_gross" placeholder="Enter Box Office India Gross"  >
                              </div>
        <div class="form-group">
                                 <label>Box Office Oversease</label>
                                 <input type="text" class="form-control" name="box_office_overseases" placeholder="Enter Box Office Oversease"  >
                              </div>
        <div class="form-group">
                                 <label>Box Office Worldwide</label>
                                 <input type="text" class="form-control" name="box_office_worldwide" placeholder="Enter Box Office Worldwide"  >
                              </div>
                    <br>          
                    <hr>
                    <h3>Box Office (Apprx)</h3>
        <div class="form-group">
                                 <label>Box Office India Nett</label>
                                 <input type="text" class="form-control" name="box_officebox_office_india_net_approx" placeholder="Enter Box Office India Nett"  >
                              </div>
        <div class="form-group">
                                 <label>Box Office India Gross</label>
                                 <input type="text" class="form-control" name="box_office_india_gross_approx" placeholder="Enter Box Office India Gross"  >
                              </div>
        <div class="form-group">
                                 <label>Box Office Oversease</label>
                                 <input type="text" class="form-control" name="box_office_overseases_approx" placeholder="Enter Box Office Oversease"  >
                              </div>
        <div class="form-group">
                                 <label>Box Office Worldwide</label>
                                 <input type="text" class="form-control" name="box_office_worldwide_approx" placeholder="Enter Box Office Worldwide"  >
                              </div>
    </div>
    <div class="reset-button">

                                   <input type="submit" name="box_office_details"  class="btn btn-add"  value="Add Box Office Details">
                            
                              </div>
    </div>
    </form>
    
    <?
    if(isset($_POST["box_office_details"]))
    {
          $film_id=mysqli_real_escape_string($con,$_POST["film_id"]); 
          $currency_symbol=mysqli_real_escape_string($con,$_POST["currency_symbol"]);
          $box_office_india_net=mysqli_real_escape_string($con,$_POST["box_office_india_net"]);
          $box_office_india_gross=mysqli_real_escape_string($con,$_POST["box_office_india_gross"]);
          $box_office_overseases=mysqli_real_escape_string($con,$_POST["box_office_overseases"]);
          $box_office_worldwide=mysqli_real_escape_string($con,$_POST["box_office_worldwide"]);
          $box_officebox_office_india_net_approx=mysqli_real_escape_string($con,$_POST["box_officebox_office_india_net_approx"]);
          $box_office_india_gross_approx=mysqli_real_escape_string($con,$_POST["box_office_india_gross_approx"]);
          $box_office_overseases_approx=mysqli_real_escape_string($con,$_POST["box_office_overseases_approx"]);
          $box_office_worldwide_approx=mysqli_real_escape_string($con,$_POST["box_office_worldwide_approx"]);
          $box_office_details="insert into  film_box_office_management set film_id='$film_id',currency_symbol='$currency_symbol',box_office_india_nett='$box_office_india_net',box_office_india_gross='$box_office_india_gross',box_office_oversease='$box_office_overseases',box_office_worldwide='$box_office_worldwide',box_office_india_nett_approx='$box_office_india_gross_approx',box_office_india_gross_approx='$box_office_india_gross_approx',box_office_oversease_approx='$box_office_overseases_approx',box_office_worldwide_approx='$box_office_worldwide_approx'";
          mysqli_query($con,$box_office_details);
                      echo "<script>alert('Box Office Details Save Successfully')</script>";
    }
    
    ?>
    </div>
    
    
     <div id="OTT" class="tab-pane fade">
      <h3>Films on OTT  </h3>
      <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                      <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="main_language"  class="form-control" name="film_id"  style="width:100%:"  required>
                                    <option value="">-Select Film-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div>   
                            <div class="form-group">
                                 <label>FILM AVAILABLE ON OTT:</label>
                                 <select class="form-control" id="isott" name="film_available_ott" required>
                                     <option value="">-Please Select-</option>
                                     <option value="Yes">Yes</option>
                                     <option value="No">No</option>
                                     
                                </select>
                              </div>
                               <div id="isottdetails" style="display: block;border: 1px solid black;padding: 14px;">
                                  <fieldset>
                                      <legend>Please Fillout These Details Also:</legend>
                                      
                                    <div class="field_wrapper4">
                                    	<a href="javascript:void(0);" class="add_button4 btn btn-success " title="Add More">Add More</a>
                                    
                                    <br>
                                   <div class="form-group">
                                 <label>OTT Platform</label>
                                 <select class="form-control" name="type[]">
                                     <option value="">-Select OTT Platform Name-</option>
                                       <? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                </select>
                              </div>
                              
                              <div class="form-group">
                                 <label>Link</label>
                                 <input type="text" class="form-control" name="link[]" placeholder=""  >
                              </div>
                              
                                  <div class="form-group">
                                <label>Lanaguage</label>
                                 
   <select class="form-control orignal_language" name="main_language[]" multiple="multiple" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
                               
                          <div class="form-group">
                                 <label>Remarks</label>
                                 <input type="text" class="form-control" name="remarks[]" placeholder=""  >
                              </div>
                              
                        </div>      
                          </fieldset>
                               
                             
          
                    
                    
                              
           </div>                    
                                                        
        </div>
        <div class="reset-button">
                   <input type="submit" name="Updateott_two_w" class="btn btn-add"   value="Add OTT" style="margin-top:10px;">       
        </div>
        </div>

        </form>
          <?php
               if(isset($_POST["Updateott_two_w"]))
                  {
                      $film_id=mysqli_real_escape_string($con,$_POST["film_id"]); 
                      $film_available_ott=mysqli_real_escape_string($con,$_POST["film_available_ott"]); 
                      $type=mysqli_real_escape_string($con,implode(",",$_POST["type"]));
                      $link=mysqli_real_escape_string($con,implode(",",$_POST["link"]));
                      $main_language=mysqli_real_escape_string($con,implode(",",$_POST["main_language"]));
                      $remarks=mysqli_real_escape_string($con,implode(",",$_POST["remarks"]));
                      $ott_film_add="insert into ott_film set film_id='$film_id',film_available_ott='$film_available_ott',ott_Platform='$type',ott_link='$link',ott_lanaguage='$main_language',ott_remarks='$remarks'";
                      mysqli_query($con,$ott_film_add);
                      echo "<script>alert('OTT Film  Details Save Successfully')</script>";
                      }
                      ?>

    </div>
    
    
    
    
    <div id="Trivia" class=" fade">
      <h3>Trivia</h3>
      <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
        <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="main_language"  class="form-control" name="film_id"  style="width:100%:"  required>
                                    <option value="">-Select Film-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div> 
      <div class="field_wrapper7">
            	<a href="javascript:void(0);" class="add_button7 btn btn-success " title="Add More">Add More</a>
            	<br>
                  <div class="form-group">
                     <label>:</label>
                     <textarea class="" name="text_area_trivia[]"></textarea> 
                  </div>
        </div>  
        </div>
        <div class="reset-button">
                   <input type="submit" name="Updatetrivia_film" class="btn btn-add"   value="Add Trivia" style="margin-top:10px;">       
        </div>
        </div>
        </form>
                  <?php
               if(isset($_POST["Updatetrivia_film"]))
                  {
                      $film_id=mysqli_real_escape_string($con,$_POST["film_id"]); 
                      $trivia_textarea_film=mysqli_real_escape_string($con,implode(",",$_POST["text_area_trivia"])); 
                      echo $trivia_add="insert into trivia set film_id='$film_id',trivia_textarea='$trivia_textarea_film'";
                      mysqli_query($con,$trivia_add);
                      "<script>alert('Trivia  Details Save Successfully')</script>";
                      }
                      ?>
    </div>
    <div id="Bookmyshow" class="tab-pane fade" style="position:relative;top:-400px;">
      <h3>Bookmyshow</h3>
      <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                   <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="main_language"  class="form-control" name="film_id"  style="width:100%:"  required>
                                    <option value="">-Select Film-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div> 
          <div class="field_wrapper6">
        	<a href="javascript:void(0);" class="add_button6 btn btn-success " title="Add More">Add More</a>
            <br>
      
      <div class="form-group  ">
                                <label>Main Lanaguage</label>
                                 
   <select class="main_language"  class="form-control" name="main_language_two[]" multiple="multiple" style="width:100%:" >
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                              
        <div class="form-group">
                                 <label>Bookmyshow Link</label>
                                 <input type="text" class="form-control" name="link_two[]" placeholder=""  >
                              </div>
                              
        <div class="form-group">
                                 <label>From</label>
                                 <input type="date" class="form-control" name="date_two[]" placeholder=""  >
                              </div>                      
       <div class="form-group">
                                 <label>To</label>
                                 <input type="date" class="form-control" name="date_three[]" placeholder=""  >
                              </div>    
                </div>
                </div>
                            <div class="reset-button">
                   <input type="submit" name="Updatebookshow_film" class="btn btn-add"   value="Add Bookmyshow" style="margin-top:10px;">       
        </div> 
                </div>
                </form>
                          <?php
               if(isset($_POST["Updatebookshow_film"]))
                  {
                      $film_id=mysqli_real_escape_string($con,$_POST["film_id"]); 
                      $main_language_book=mysqli_real_escape_string($con,implode(",",$_POST["main_language_two"])); 
                      $link_two=mysqli_real_escape_string($con,implode(",",$_POST["link_two"]));
                      $date_two=mysqli_real_escape_string($con,implode(",",$_POST["date_two"]));
                      $date_three=mysqli_real_escape_string($con,implode(",",$_POST["date_three"]));
                       $book_my="insert into bookmyshow set film_id='$film_id',main_lanaguage='$main_language_book',bookmyshow_link='$link_two',from_two='$date_two',to_bookshow='$date_three'";
                      mysqli_query($con,$book_my);
                      echo "<script>alert('Bookmyshow  Details Save Successfully')</script>";
                      }
                      ?>
                              
                              
    </div>
    <div id="otherdetails" class="tab-pane fade" style="position:relative;top:-400px;">
      <h3>Details</h3>
       <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                   <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="main_language"  class="form-control" name="film_id"  style="width:100%:"  required>
                                    <option value="">-Select Film-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div>
      <div class="form-group">
                                 <label>Movie Plot</label>
                                 <textarea class="" name="movie"></textarea> 
                              </div>
      
      <div class="form-group">
                                 <label>Story</label>
                                 <textarea name="story" class="" ></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Climax</label>
                                 <textarea name="climax" class=""></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Acting</label>
                                 <textarea name="acting" class=""></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Film Review</label>
                                 <textarea name="film_review" class=""></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Trailer Review</label>
                                 <textarea name="trailer_review" class=""></textarea> 
                              </div>


     <div class="form-group">
                                 <label>Why Watch</label>
                                 <textarea name="why_watch" class=""></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Why Not Watch</label>
                                 <textarea name="why_not_watch" class=""></textarea> 
                              </div>
    </div>
        

  </div>
  <div class="reset-button">
                   <input type="submit" name="other_details_btn" class="btn btn-add"   value="Add Other etails" style="margin-top:10px;">       
        </div>
                     </form>
                    <?php
               if(isset($_POST["other_details_btn"]))
                  {
                      $film_id=mysqli_real_escape_string($con,$_POST["film_id"]); 
                      $movies_other=mysqli_real_escape_string($con,$_POST["movie"]); 
                      $story_two=mysqli_real_escape_string($con,$_POST["story"]);
                      $climax_two=mysqli_real_escape_string($con,$_POST["climax"]);
                      $acting_other=mysqli_real_escape_string($con,$_POST["acting"]);
                      $film_review_two=mysqli_real_escape_string($con,$_POST["film_review"]);
                      $trailer_review_two=mysqli_real_escape_string($con,$_POST["trailer_review"]);
                      $why_watch_two=mysqli_real_escape_string($con,$_POST["why_watch"]);
                      $why_not_watch_two=mysqli_real_escape_string($con,$_POST["why_not_watch"]);
                      $other_data="insert into other_details set film_id='$film_id',movie_plot='$movies_other',story='$story_two',climax='$climax_two',acting='$acting_other',film_review='$film_review_two',trailer_review='$trailer_review_two',why_watch='$why_watch_two',why_not_watch='$why_not_watch_two'";
                      mysqli_query($con,$other_data);
                      echo "<script>alert('Other Details Save Successfully')</script>";
                      }
                      ?>
                  </div>
               

               <!-- customer Modal1 -->
              
               <!-- /.modal -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
       <?php include('footer.php');?>
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="/admin/assets/bootstrap/js/jquery.richtext.js"></script>
<script src="/admin/assets/bootstrap/js/jquery.richtext.min.js"></script>
  <script>
  
	/* Encode string to slug */
function convertToSlug(str) {
    
  //replace all special characters | symbols with a space
  str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
           .toLowerCase();
    
  // trim spaces at start and end of string
  str = str.replace(/^\s+|\s+$/gm,'');
    
  // replace space with dash/hyphen
  str = str.replace(/\s+/g, '-');  
 $("#film_slug_permalink").val(str); 
  //document.getElementById("slug1").innerHTML = str;
  //return str;
}
	</script>
<script>
  $(document).ready(function() {
    $('.main_language').select2();
});
</script>

<script>
  $(document).ready(function() {
    $('.orignal_language').select2();
});
</script>
<script>
$(function() {
    jQuery(document).ready(function($){
        if($('#isdubbed').val() == 'Yes') {
            $('#isdubbedsection').show(); 
        } else {
            $('#isdubbedsection').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#isdubbed").change(function(){
        if($('#isdubbed').val() == 'Yes') {
            $('#isdubbedsection').show(); 
        } else {
            $('#isdubbedsection').hide(); 
        } 
    });
});
 </script>
 
 
 
 <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#isott').val() == 'Yes') {
            $('#isottdetails').show(); 
        } else {
            $('#isottdetails').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#isott").change(function(){
        if($('#isott').val() == 'Yes') {
            $('#isottdetails').show(); 
        } else {
            $('#isottdetails').hide(); 
        } 
    });
});
 </script>
 
 
<script>
$(function() {
    jQuery(document).ready(function($){
        if($('#similar').val() == 'Yes') {
            $('#similardetails').show(); 
        } else {
            $('#similardetails').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#similar").change(function(){
        if($('#similar').val() == 'Yes') {
            $('#similardetails').show(); 
        } else {
            $('#similardetails').hide(); 
        } 
    });
});
 </script> 
 
 
  <script>
$(function() {
   $("#cbfc_releasing_platform").change(function(){
        if($('#cbfc_releasing_platform').val() == 'OTT') {
            $('#ott_platform').show(); 
        } else {
            $('#ott_platform').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#cbfc_releasing_platform').val() == 'OTT') {
            $('#ott_platform').show(); 
        } else {
            $('#ott_platform').hide(); 
        } 
    });
});
 </script>
 
 <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#panindia').val() == 'Yes') {
            $('#ispan').show(); 
        } else {
            $('#ispan').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#panindia").change(function(){
        if($('#panindia').val() == 'Yes') {
            $('#ispan').show(); 
        } else {
            $('#ispan').hide(); 
        } 
    });
});
 </script>
 
  <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#Sequel').val() == 'Yes') {
            $('#isSequel').show(); 
        } else {
            $('#isSequel').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#Sequel").change(function(){
        if($('#Sequel').val() == 'Yes') {
            $('#isSequel').show(); 
        } else {
            $('#isSequel').hide(); 
        } 
    });
});
 </script>
 
 
   <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#Multiple_Roles').val() == 'Yes') {
            $('#is_Multiple_Roles').show(); 
        } else {
            $('#is_Multiple_Roles').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#Multiple_Roles").change(function(){
        if($('#Multiple_Roles').val() == 'Yes') {
            $('#is_Multiple_Roles').show(); 
        } else {
            $('#is_Multiple_Roles').hide(); 
        } 
    });
});
 </script>
 
 
    <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#ismoredubbed').val() == 'Yes') {
            $('#ismoredubbedsection').show(); 
        } else {
            $('#ismoredubbedsection').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#ismoredubbed").change(function(){
        if($('#ismoredubbed').val() == 'Yes') {
            $('#ismoredubbedsection').show(); 
        } else {
            $('#ismoredubbedsection').hide(); 
        } 
    });
});
 </script>
 <script>
$(document).ready(function(){

    var maxField1 = 10; //Input fields increment limitation
    var addButton1 = $('.add_button1'); //Add button selector
    var wrapper1 = $('.field_wrapper1'); //Input field wrapper
    var fieldHTML1 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a> <div class="form-group">'+
                                '<label>OTT Platform Name:</label>'+
                                 
   '<select  class="form-control" name="dubbed_ott_name[]"  style="width:100%;">'+
       '<option value="">-Please Select OTT Platform-</option>'+
                                  <? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                              '</div>'+
                               '<div class="form-group">'+
            '<label>Link</label>'+
            '<input type="text" name="dubbed_ott_link[]" id="ott_link" class="form-control">'+
   '</div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton1).click(function(){
        //Check maximum number of input fields
        if(x < maxField1){ 
            x++; //Increase field counter
            $(wrapper1).append(fieldHTML1); //Add field html
           
        }else{
            alert('A maximum of '+maxField1+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper1).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>


<script>
$(document).ready(function(){

    var maxField2 = 10; //Input fields increment limitation
    var addButton2 = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper2'); //Input field wrapper
    var fieldHTML2 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
         '<div class="row">'+
              '<div class="col-lg-12">'+
                 '<div class="form-group">'+
                                 '<label>Trailer Category</label>'+
                                 '<select class="form-control" name="trailer_catgories[]">'+
                                     '<option value="">-Please Select-</option>'+
                                      <? $sqlfr=mysqli_query($con, "select * from film_trailer_categories order by film_trailer_name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['film_trailer_name']; ?>"><? echo $rowfr['film_trailer_name']; ?></option>'+
                                  <? } ?>
                                '</select>'+
                              '</div>'+
            
            '<div class="form-group  ">'+
                                '<label>Lanaguage</label>'+
                                 
   '<select class="main_language"  class="form-control" name="trailer_language[]" multiple="multiple" style="width:100%:" >'+
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                                 
                              '</div>'+
                              
            '<div class="form-group">'+
                                 '<label>Teaser</label>'+
                                 '<input type="text" class="form-control" name="teaser[]" >'+
                                  
                              '</div>'+
                              
            '<div class="form-group">'+
                                 '<label>Trailer</label>'+
                                 '<input type="text" class="form-control" name="trailer[]" >'+
                                  
                              '</div>'+                  
            
            
            '<div class="form-group">'+
                                 '<label>Motional Poster</label>'+
                                   '<input type="file"  name="motion_poster[]"  class="form-control">'+
                                  
                              '</div>'+
                              
            '<div class="form-group">'+
                                 '<label>First Look Poster</label>'+
                                   '<input type="file"  name="first_look_poster[]"  class="form-control">'+
                                  
                              '</div>'+               
                  
                  '<div class="form-group">'+
                                 '<label> Trailer Release Date</label>'+
                                 '<input type="text" class="form-control" name="trailer_date_release[]" placeholder="Enter  Date Release"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label> Trailer Release Month</label>'+
                                 '<input type="text" class="form-control" name="trailer_month_release[]" placeholder="Enter  Month Release"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label> Trailer Release Year</label>'+
                                 '<input type="text" class="form-control" name="trailer_year_release[]" placeholder="Enter  Year Release"  >'+
                              '</div>'+
                              
                              '<div class="form-group">'+
                                 '<label> YouTube upload Date</label>'+
                                 '<input type="text" class="form-control" name="trailer_youtube_date_release[]" placeholder="Enter  Date Release"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label> YouTube upload Month</label>'+
                                 '<input type="text" class="form-control" name="trailer_youtube_month_release[]" placeholder="Enter  Month Release"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label> YouTube upload Year</label>'+
                                 '<input type="text" class="form-control" name="trailer_youtube_year_release[]" placeholder="Enter  Year Release"  >'+
                              '</div>'+
                            '<div class="form-group">'+
                                 '<label> Views (Million/Billion)</label>'+
                                 '<input type="text" class="form-control" name="trailer_youtube_views[]">'+
                              '</div>'+    
                          
                  '</div>'+
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
$(document).ready(function(){

    var maxField3 = 10; //Input fields increment limitation
    var addButton3 = $('.add_button3'); //Add button selector
    var wrapper3 = $('.field_wrapper3'); //Input field wrapper
    var fieldHTML3 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                        '<label>Fill Following Franchise  Details of This Film:</label>'+
                                '<br/>'+
                                '<br/>'+
                        '<div class="form-group  ">'+
                                '<label>Select Sequel Type</label>'+
   '<select class="form-control" name="sequel_type[]" >'+
                                  '<option value="">-Please Select-</option>'+
                                     '<option value="Sequel">Sequel</option>'+
                                     '<option value="Prequel">Prequel</option>'+
                                     '<option value="Quasi Sequel">Quasi Sequel</option>'+
                                 '</select>'+
                              '</div>'+
                              
                              '<div class="form-group  ">'+
                             
                                 '<label>Film Title(s)</label>'+
                                 
 '<select class="main_language"  class="form-control" name="sequel_film_name[]" multiple="multiple">'+
                                  <? $sqlfr=mysqli_query($con, "select * from film order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){  $FilmName=$rowfr['name'];?>

'<option value="<? echo $rowfr['id']; ?>"><?  $FilmName1= str_replace("'", "", $FilmName);echo $FilmName1; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                                 
                              '</div>'+
                              
                              '<div class="form-group  ">'+
                                '<label>Installment:</label>'+
                                '<input type="text" name="Installment[]" class="form-control"/>'+
                                '</div>'+
                                
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton3).click(function(){
        //Check maximum number of input fields
        if(x < maxField3){ 
            x++; //Increase field counter
            $(wrapper3).append(fieldHTML3); //Add field html
            $('.main_language').select2();
           
        }else{
            alert('A maximum of '+maxField2+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper3).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>

<script>
$(document).ready(function(){

    var maxField4 = 10; //Input fields increment limitation
    var addButton4 = $('.add_button4'); //Add button selector
    var wrapper4 = $('.field_wrapper4'); //Input field wrapper
    var fieldHTML4 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                               
                                   '<div class="form-group">'+
                                 '<label>OTT Platform</label>'+
                                 '<select class="form-control" name="type[]">'+
                                     '<option value="">-Select OTT Platform Name-</option>'+
                                       <? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                
                                '</select>'+
                              '</div>'+
                              
                              '<div class="form-group">'+
                                 '<label>Link</label>'+
                                 '<input type="text" class="form-control" name="link[]" placeholder=""  >'+
                              '</div>'+
                              
                                  '<div class="form-group">'+
                                '<label>Lanaguage</label>'+
                                 
   '<select class="form-control dubbing_lang" name="main_language[]" multiple="multiple" style="width:100%;">'+
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                                 
                              '</div>'+
                               
                          '<div class="form-group">'+
                                 '<label>Remarks</label>'+
                                 '<input type="text" class="form-control" name="remarks[]" placeholder=""  >'+
                              '</div>'+
                                
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton4).click(function(){
        //Check maximum number of input fields
        if(x < maxField4){ 
            x++; //Increase field counter
            $(wrapper4).append(fieldHTML4); //Add field html
            $('.dubbing_lang').select2();
           
        }else{
            alert('A maximum of '+maxField2+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper4).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>


<script>
$(document).ready(function(){

    var maxField5 = 10; //Input fields increment limitation
    var addButton5 = $('.add_button5'); //Add button selector
    var wrapper5 = $('.field_wrapper5'); //Input field wrapper
    var fieldHTML5 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                              
                            '<div class="form-group">'+
                                '<label>Select Movie Name:</label>'+
                                '<input list="dubb_film_name_list" id="dubb_film_name" class="form-control" name="movies_add[]">'+
                    
                    '<datalist id="dubb_film_name_list">'+
                        <? $sqlfrm=mysqli_query($con, "select * from film1 order by name");
                        while($rowfrm=mysqli_fetch_array($sqlfrm)){ ?>
                     '<option value="<? echo $rowfrm['name']; ?>"/>'+
                         <? } ?>
                    '</datalist>'+
                            '</div>'+
                              
                              
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton5).click(function(){
        //Check maximum number of input fields
        if(x < maxField5){ 
            x++; //Increase field counter
            $(wrapper5).append(fieldHTML5); //Add field html
            $('.main_language').select2();
           
        }else{
            alert('A maximum of '+maxField2+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper5).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>

<script>
$(document).ready(function(){

    var maxField6 = 10; //Input fields increment limitation
    var addButton6 = $('.add_button6'); //Add button selector
    var wrapper6 = $('.field_wrapper6'); //Input field wrapper
    var fieldHTML6 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                              
                            '<div class="form-group  ">'+
                                '<label>Main Lanaguage</label>'+
                                 
   '<select class="main_language"  class="form-control" name="main_language_two[]" multiple="multiple" style="width:100%:" >'+
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                              '</div>'+
                              
                              '<div class="form-group">'+
                                 '<label>Bookmyshow Link</label>'+
                                 '<input type="text" class="form-control" name="link_two[]" placeholder=""  >'+
                              '</div>'+
                              
        '<div class="form-group">'+
                                 '<label>From</label>'+
                                 '<input type="date" class="form-control" name="date_two[]" placeholder=""  >'+
                              '</div>'+
       '<div class="form-group">'+
                                 '<label>To</label>'+
                                 '<input type="date" class="form-control" name="date_three[]" placeholder=""  >'+
                              '</div>'+
                              
                              
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
     
    // Once add button is clicked
    $(addButton6).click(function(){
        //Check maximum number of input fields
        if(x < maxField6){ 
            x++; //Increase field counter
            $(wrapper6).append(fieldHTML6); //Add field html
            $('.main_language').select2();
           
        }else{
            alert('A maximum of '+maxField2+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper6).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>



<script>
$(document).ready(function(){
    var maxField7 = 10; //Input fields increment limitation
    var addButton7 = $('.add_button7'); //Add button selector
    var wrapper7 = $('.field_wrapper7'); //Input field wrapper
    var fieldHTML7 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                    '<div class="form-group">'+
                     '<label>:</label>'+
                     '<textarea class="text_add" name="text_area_trivia[]"></textarea>'+ 
                  '</div>'+
                          
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    // Once add button is clicked
    $(addButton7).click(function(){
        //Check maximum number of input fields
        if(x < maxField7){ 
            x++; //Increase field counter
            $(wrapper7).append(fieldHTML7); //Add field html
            $('.main_language').select2();
            //$('.text_add').richText();
        }else{
            alert('A maximum of '+maxField2+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper7).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
   
});

</script>



<script>
$(document).ready(function(){
    var maxField_multiple_role = 10; //Input fields increment limitation
    var addButton_multiple_role = $('.add_button_multiple_role'); //Add button selector
    var wrapper_multiple_role = $('.field_wrapper_multiple_role'); //Input field wrapper
    var fieldHTML_multiple_role = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                              
                            '<div class="form-group">'+
                                '<label>Actors Name:</label>'+
                               '<select name="multiple_actor_name[]" class="form-control leadactor" style="width:100%;">'+
                                  <? $sqlfr=mysqli_query($con, "select * from cast order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                                '</div>'+
                                '<div class="form-group">'+
                                '<label>Character  Name:</label>'+
                                '<input type="text" name="multiple_character_name[]" class="form-control"/>'+
                                '</div>'+
                                '<div class="form-group">'+
                                '<label>Remarks:</label>'+
                                '<input type="text" name="multiple_remarks[]" class="form-control"/>'+
                                '</div>'+
                          
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    // Once add button is clicked
    $(addButton_multiple_role).click(function(){
        //Check maximum number of input fields
        if(x < maxField_multiple_role){ 
            x++; //Increase field counter
            $(wrapper_multiple_role).append(fieldHTML_multiple_role); //Add field html
           
        }else{
            alert('A maximum of '+maxField_multiple_role+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper_multiple_role).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
   
});

</script>
 <script>
$(document).ready(function(){

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
    '<div class="form-group">'+
                                 '<label>Original Movie Name </label>'+
                                 '<input type="text" class="form-control" name="original_movie_name[]" placeholder="Enter Original Movie Name"  >'+
                              '</div>'+
                              '<div class="form-group">'+
                                '<label>Original Lanaguage(s)</label>'+
   '<select class="form-control dubbing_lang" name="original_movie_language[]" multiple="multiple" style="width:100%;">'+
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>
'<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                                 
                              '</div>'+
    '<div class="form-group"><label>Dubbing Lanaguage(s)</label><select  class="form-control dubbing_lang" name="dubbing_movie_language[]" multiple="multiple" style="width:100%;">'+
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                '</select>'+
                              '</div>'+
                               '<div class="form-group">'+
            '<label>Dubbing Film Name</label>'+
            '<input list="dubb_film_name_list" id="dubb_film_name" name="dubb_film_name[]" class="form-control">'+
'<datalist id="dubb_film_name_list">'+
    <? $sqlfrm=mysqli_query($con, "select * from film1 order by name");
    while($rowfrm=mysqli_fetch_array($sqlfrm)){ ?>
 '<option value="<? echo $rowfrm['name']; ?>"/>'+
     <? } ?>
'</datalist>'+
                              '</div>'+
                              '<div class="form-group">'+
                                 '<label>Release Date</label>'+
                                 '<input type="text" class="form-control" name="dubbed_date_release[]" placeholder="Enter Release Date"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label>Release Month</label>'+
                                 '<input type="text" class="form-control" name="dubbed_month_release[]" placeholder="Enter Release Month"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label>Release Year</label>'+
                                 '<input type="text" class="form-control" name="dubbed_year_release[]" placeholder="Enter Release Year"  >'+
                              '</div>'+
                              '<div class="form-group  ">'+
                                '<label>Genre(s)</label>'+
                                 
   '<select class="dubbing_lang"  class="form-control" name="dubbed_Genre[]" multiple="multiple" style="width:100%;">'+
                                  <? $sqlfr=mysqli_query($con, "select * from genre order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                              '</div>'+
                              '<div class="form-group">'+
                                 '<label>YouTube Movie Link</label>'+
                                 '<input type="text" class="form-control" name="dubbed_youtube_link[]" placeholder="Enter You Tube Movie Link"  >'+
                              '</div>'+
                              '<div class="form-group">'+
                                 '<label>Upload Full Date:</label>'+
                             
                              '</div>'+
                               '<div class="form-group">'+
                                 '<label>Upload Date</label>'+
                                 '<input type="text" class="form-control" name="dubbed_date_release_youtube[]" placeholder="Enter Release Date"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label>Upload Month</label>'+
                                 '<input type="text" class="form-control" name="dubbed_month_release_youtube[]" placeholder="Enter Release Month"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label>Upload Year</label>'+
                                 '<input type="text" class="form-control" name="dubbed_year_release_youtube[]" placeholder="Enter Release Year"  >'+
                              '</div>'+
                              '<br/>'+
        '<div class="field_wrapper1">'+
    '<label>OTT Platform Details</label>'+
          '<a href="javascript:void(0);" class="add_button1 btn btn-success" title="Add More">Add More</a>'+
                           '<div class="form-group">'+
                                '<label>OTT Platform Name:</label>'+                        
   '<select  class="form-control" name="dubbed_ott_name[]"  style="width:100%;">'+
       '<option value="">-Please Select OTT Platform-</option>'+
                                  <? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                              '</div>'+
                               '<div class="form-group">'+
            '<label>Link</label>'+
            '<input type="text" name="dubbed_ott_link[]" id="ott_link" class="form-control">'+
   '</div>'+
'</div>'+
                              '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increase field counter
            $(wrapper).append(fieldHTML); //Add field html
             $('.dubbing_lang').select2();
        }else{
            alert('A maximum of '+maxField+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>

<script>
  $(document).ready(function() {
    $('.dubbing_lang').select2();
});
</script>
<script>
  $(document).ready(function() {
    $('.leadactor').select2();
});
</script>
<script>
  $(document).ready(function() {
    $('.searchwithselect2').select2();
});
</script>
<!---textaera--->
  

<script>
        $(document).ready(function() {
            $('.text_add').richText();
        });
        </script>
