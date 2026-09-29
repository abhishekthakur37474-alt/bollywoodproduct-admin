<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_POST["Submit"]) { 
    
    $meaningfilm= mysqli_real_escape_string($con,$_POST['meaningfilm']) ; 
    $type= mysqli_real_escape_string($con,$_POST['type']) ; 
    $country= mysqli_real_escape_string($con,implode(",",$_POST['country']));
    $name= mysqli_real_escape_string($con,$_POST['name']) ; 
    $dubbing_language= mysqli_real_escape_string($con,implode(",",$_POST['dubbing_language'])) ;
    $main_language= mysqli_real_escape_string($con,implode(",",$_POST['main_language'])) ;
    $director= mysqli_real_escape_string($con,$_POST['director']) ; 
    $cast= mysqli_real_escape_string($con,$_POST['cast']) ; 
    $producer= mysqli_real_escape_string($con,$_POST['producer']) ; 
    $music_director= mysqli_real_escape_string($con,$_POST['music_director']) ; 
    $budget= mysqli_real_escape_string($con,$_POST['budget']) ; 
    $box_office= mysqli_real_escape_string($con,$_POST['box_office']) ; 
    $story= mysqli_real_escape_string($con,$_POST['story']) ; 
    $climax= mysqli_real_escape_string($con,$_POST['climax']) ; 
    $acting= mysqli_real_escape_string($con,$_POST['acting']) ; 
    $film_review= mysqli_real_escape_string($con,$_POST['film_review']) ; 
    $trailer_review= mysqli_real_escape_string($con,$_POST['trailer_review']) ; 
    $why_watch= mysqli_real_escape_string($con,$_POST['why_watch']) ; 
    $why_not_watch= mysqli_real_escape_string($con,$_POST['why_not_watch']) ; 
    $youtube= mysqli_real_escape_string($con,$_POST['youtube']) ;  
    $youtube_film= mysqli_real_escape_string($con,$_POST['youtube_film']) ;  
    $rating= mysqli_real_escape_string($con,$_POST['rating']) ;   
    $imdb_rating= mysqli_real_escape_string($con,$_POST['imdb_rating']) ;   
    $rotten_rating= mysqli_real_escape_string($con,$_POST['rotten_rating']) ; 
    $date_release= mysqli_real_escape_string($con,$_POST['date_release']) ;
    $month_release= mysqli_real_escape_string($con,$_POST['month_release']) ;
    $year_release= mysqli_real_escape_string($con,$_POST['year_release']) ;

    $isdubbed= mysqli_real_escape_string($con,$_POST['isdubbed']) ;
    $original_movie_name= mysqli_real_escape_string($con,$_POST['original_movie_name']) ;
    $dubbed_main_language= mysqli_real_escape_string($con,implode(",",$_POST['dubbed_main_language'])) ;
    $dubbed_date_release= mysqli_real_escape_string($con,$_POST['dubbed_date_release']) ;
    $dubbed_month_release= mysqli_real_escape_string($con,$_POST['dubbed_month_release']) ;
    $dubbed_year_release= mysqli_real_escape_string($con,$_POST['dubbed_year_release']) ;
    $dubbed_Genre= mysqli_real_escape_string($con,implode(",",$_POST['dubbed_Genre'])) ;
    $dubbed_youtube= mysqli_real_escape_string($con,$_POST['dubbed_youtube']) ;
    $dubbed_upload_date	= mysqli_real_escape_string($con,$_POST['dubbed_upload_date']) ;
    
    
    
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
    $cbfc_releasing_platform_details= mysqli_real_escape_string($con,$_POST['cbfc_releasing_platform_details']) ;
    
    
    
    $why_watch= mysqli_real_escape_string($con,$_POST['why_watch']) ; 
 

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

 
mysqli_query($con,"INSERT INTO `film` (`film_meaning`,`type`,`country`,`name`,`alias`,`dubbing`,`main_lang`, `director`, `cast`, `producer`, `music_director`, `box_office`,`budget`, `story`, `climax`, `acting`, `film_review`, `trailer_review`, `why_watch`, `why_not_watch`, `youtube`, `youtube_film`, `photo`, `imdb_rating`,`rotten_rating`,`rating`, `date_release`, `month_release`, `year_release`,`original_movie_name`,`dubbed_main_language`,`dubbed_date_release`,`dubbed_month_release`,`dubbed_year_release`,`dubbed_Genre`,`dubbed_youtube`,`dubbed_upload_date`,`isdubbed`,`cbfc_rating`, `cbfc_certificate_no`, `cbfc_certificate_date`, `cbfc_certificate_month`, `cbfc_certificate_year`, `cbfc_running_time_minutes`, `cbfc_running_time_seconds`, `cbfc_language`, `cbfc_status`, `cbfc_releasing_platform`, `cbfc_releasing_platform_details`) VALUES ('$meaningfilm','$type','$country','$name','$alias','$dubbing_language','$main_language','$director', '$cast', '$producer', '$music_director', '$box_office', '$budget', '$story', '$climax', '$acting', '$film_review', '$trailer_review', '$why_watch', '$why_not_watch', '$youtube', '$youtube_film', '$newName', '$imdb_rating', '$rotten_rating', '$rating', '$date_release', '$month_release', '$year_release','$original_movie_name','$dubbed_main_language','$dubbed_date_release','$dubbed_month_release','$dubbed_year_release','$dubbed_Genre','$dubbed_youtube','$dubbed_upload_date','$isdubbed','$cbfc_rating', '$cbfc_certificate_no', '$cbfc_certificate_date',  '$cbfc_certificate_month',  '$cbfc_certificate_year', '$cbfc_running_time_minutes','$cbfc_running_time_seconds', '$cbfc_language', '$cbfc_status', '$cbfc_releasing_platform', '$cbfc_releasing_platform_details')") or die(mysqli_error($con));
  
            header('location:film.php?msg=success');
         }



if($_POST["UpdateGenre"]) { 

    $film_id= $_POST['id'];
    $genre_id= $_POST['genre_id'];
    mysqli_query($con, "insert into film_genre (film_id, genre_id) values ('$film_id', '$genre_id')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteGenre") { 
  $film_id=$_GET['film_id'];
   $genre_id= $_GET['genre_id'];
  mysqli_query($con, "delete from film_genre where film_id='$film_id' and genre_id='$genre_id'") or die(mysqli_error($con));

header("location:film.php?Action=Update&id=$film_id");

}





if($_POST["UpdateCast"]) { 

    $film_id= $_POST['id'];
    $cast_id= $_POST['cast_id'];
    $othercharacterdetails=$_POST["othercharacterdetails"];
    $otherremark=$_POST["otherremark"];
    mysqli_query($con, "insert into film_cast (film_id, cast_id,film_other_charater,film_other_remark) values ('$film_id', '$cast_id','$othercharacterdetails','$otherremark')");

header("location:film.php?Action=Update&id=$film_id");
}


if($_GET["Action"]=="DeleteCast") { 
  $id=$_GET["id"];
  $film_id=$_GET['film_id'];
  $cast_id=$_GET['cast_id'];
  mysqli_query($con, "delete from film_cast where film_id='$film_id' and cast_id='$cast_id' and id='$id'");

header("location:film.php?Action=Update&id=$film_id");

}

if($_POST["UpdateLeadCast"]) { 

    $film_id= $_POST['id'];
    $film_lead_cast_id= $_POST['film_lead_cast_id'];
    $characterdetails=$_POST["characterdetails"];
    $remark=$_POST["remark"];
    
    mysqli_query($con, "insert into film_lead_cast (film_id, film_lead_cast_id,film_lead_charater,film_lead_remark) values ('$film_id', '$film_lead_cast_id','$characterdetails','$remark')");

header("location:film.php?Action=Update&id=$film_id");
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
      <title>film Management</title>
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

        <script src="https://cdn.tiny.cloud/1/qyhq7trksx7i1gpmasi3h8szpuzmiuj9c3epa0k2hjpuszlk/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>

  <!-- select2 -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <style>
     select
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
                  <h1>Old Film</h1>
                  <small>Old Film List</small>
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
                                 <h4>Add film</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                               <div class="form-group">
                                 <label>Type</label>
                                 <select class="form-control" name="type" required>
                                     <option value="">-Select Type-</option>
                                     <option value="Film">Film</option>
                                     <option value="Web Series">Web Series</option>
                                     <option value="TV Movie">TV Movie</option>
                                </select>
                              </div>
                              <div class="form-group">
                                 <label>name</label>
                                 <input type="text" class="form-control" name="name" placeholder="Enter name"  >
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
                           <div class="form-group  ">
                                <label>Dubbing Lanaguage(s)</label>
                                 
   <select class="dubbing_lang"  class="form-control" name="dubbing_language[]" multiple="multiple">
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              
 
                                 
                              </div>
                          <div class="form-group">
                                 <label>IS This Dubbed:</label>
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
                                 <input type="text" class="form-control" name="original_movie_name" placeholder="Enter Original Movie Name"  >
                              </div>
                                <div class="form-group  ">
                                <label>Lanaguage(s)</label>
                                 
   <select class="main_language"  class="form-control" name="dubbed_main_language[]" multiple="multiple">
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Release Date</label>
                                 <input type="text" class="form-control" name="dubbed_date_release" placeholder="Enter Release Date"  >
                              </div>
                          <div class="form-group">
                                 <label>Release Month</label>
                                 <input type="text" class="form-control" name="dubbed_month_release" placeholder="Enter Release Month"  >
                              </div>
                          <div class="form-group">
                                 <label>Release Year</label>
                                 <input type="text" class="form-control" name="dubbed_year_release" placeholder="Enter Release Year"  >
                              </div>
                               <div class="form-group  ">
                                <label>Genre(s)</label>
                                 
   <select class="main_language"  class="form-control" name="dubbed_Genre[]" multiple="multiple">
                                  <? $sqlfr=mysqli_query($con, "select * from genre order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                                <div class="form-group">
                                 <label>YouTube Channel</label>
                                 <input type="text" class="form-control" name="dubbed_youtube" placeholder="Enter You Tube Channel Link"  >
                              </div>
                              <div class="form-group">
                                 <label>Upload Date</label>
                                 <input type="date" class="form-control" name="dubbed_upload_date" >
                              </div>
                              </fieldset>
                               
                              </div>
                            
                     <div class="form-group">
                                 <label>Box Office</label>
                                 <input type="text" class="form-control" name="box_office" placeholder="Enter Box Office"  >
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
                                 <label>You Tube Trailer Link</label>
                                 <input type="text" class="form-control" name="youtube" placeholder="Enter You Tube Trailer Link"  >
                              </div>
                         <div class="form-group">
                                 <label>You Tube Film Link</label>
                                 <input type="text" class="form-control" name="youtube_film" placeholder="Enter You Tube Film Link"  >
                              </div>
                          
                            <div class="form-group">
                                 <label>Image</label>
                                   <input type="file"  name="filstor"  class="form-control">
                                  
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
                                 <label>Is This Film Shelved/Unreleased?</label>
                             
 <select name="cbfc_status" class="form-control" > 
<option value="">-Please Select-</option>              
<option value="Yes">Yes</option>
<option value="No">No</option>

                                 
                                 </select> 
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


     <div class="form-group">
                                 <label>Story</label>
                                 <textarea name="story" rows="25"></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Climax</label>
                                 <textarea name="climax" rows="25"></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Acting</label>
                                 <textarea name="acting" rows="25"></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Film Review</label>
                                 <textarea name="film_review" rows="25"></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Trailer Review</label>
                                 <textarea name="trailer_review" rows="25"></textarea> 
                              </div>


     <div class="form-group">
                                 <label>Why Watch</label>
                                 <textarea name="why_watch" rows="25"></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Why Not Watch</label>
                                 <textarea name="why_not_watch" rows="25"></textarea> 
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
$sql="select * from film where id='$id2'";
$rs=mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs);
$main_lang_ex=explode(",",$row["main_lang"]);
$all_country_fetch=explode(",",$row["country"]);
$dubbing_lang_ex=explode(",",$row["dubbing"]);
$dubbed_main_language=explode(",",$row["dubbed_main_language"]);
$dubbed_Genre=explode(",",$row["dubbed_Genre"]);
?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Update film</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">

 
     <div class="row">
         <div class="col-lg-6 col-md-6">
             
             <div class="col-sm-4">
        </div>
                              <div class="col-sm-6">
    <a class="btn btn-add"  data-toggle="modal" data-target="#leadcastdialog" data-backdrop="static" data-keyboard="false">Select Lead Cast</a>
                                <!-- <input type="submit" name="UpdateLeadCast" id="leadcast" class="btn btn-add"   value="Add Lead Cast">-->
                                  
                              </div>
                              <br/><br/>
                                <div class="col-sm-4">
        </div>
                                <div class="col-sm-6">
    <a class="btn btn-add"  data-toggle="modal" data-target="#othercastdialog" data-backdrop="static" data-keyboard="false">Select Other Cast</a>
                                <!-- <input type="submit" name="UpdateLeadCast" id="leadcast" class="btn btn-add"   value="Add Lead Cast">-->
                                  
                              </div>
                              <br/><br/>
             <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                 <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">    Genre</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="genre_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from genre order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="col-sm-4">
   
                                 <input type="submit" name="UpdateGenre" class="btn btn-add"   value="Add Genre">
                                  
                              </div>
</form>

  

 

 <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">    Music Director</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="music_director_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdateMusicDirector" class="btn btn-add"   value="Add Music Director">
                                  
                              </div>
</form>
<form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">   Background Scorer</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="music_background_scorer_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdateBackgroundScorer" class="btn btn-add"   value="Add Background Scorer">
                                  
                              </div>
</form>
<form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Director</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="director_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdateDirector" class="btn btn-add"   value="Add  Director">
                                  
                              </div>
</form>
<form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Co-Director</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="codirector_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdateCoDirector" class="btn btn-add"   value="Add  Co-Director">
                                  
                              </div>
</form>
<form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Presenter</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="presenter_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdatePresenterProducer" class="btn btn-add"   value="Add Presenter">
                                  
                              </div>
</form>
 <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Producer</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="producer_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdateProducer" class="btn btn-add"   value="Add  Producer">
                                  
                              </div>
</form>
<form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Dialogue</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="dialogue_writers_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from screenplay order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="dialogue_writers" class="btn btn-add"   value="Add Dialogue Writers">
                                  
                              </div>
</form>
 <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">    Story</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="film_story_writer_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from screenplay order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdateStoryWriter" class="btn btn-add"   value="Add Story">
                                  
                              </div>
</form>

 <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Screenplay</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="film_screenplay_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from screenplay order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdateScreenplay" class="btn btn-add"   value="Add Screenplay">
                                  
                              </div>
</form>
 <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Action Director</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="film_action_director_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from actiondirector order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdateActionDirector" class="btn btn-add"   value="Add Action Director">
                                  
                              </div>
</form>

         </div>
        <!--New Crew Members start-->
        
        <div class="col-lg-6 col-md-6">
          
             <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                 <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Co-Producer</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="co_producer" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="col-sm-4">
   
                                 <input type="submit" name="UpdateCoProducer" class="btn btn-add"   value="Add Co-Producer">
                                  
                              </div>
</form>
<form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                 <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Line Producer</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="line_producer" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="col-sm-4">
   
                                 <input type="submit" name="UpdateLineProducer" class="btn btn-add"   value="Add Line Producer">
                                  
                              </div>
</form>
<form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                 <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Executive Producer</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="film_executive_producer_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="col-sm-4">
   
                                 <input type="submit" name="UpdateExecutiveProducer" class="btn btn-add"   value="Add Executive Producer">
                                  
                              </div>
</form>
<form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                 <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Supervising Producer</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="film_supervising_producer_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from producer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="col-sm-4">
   
                                 <input type="submit" name="UpdateSupervisingProducer" class="btn btn-add"   value="Add Supervising Producer">
                                  
                              </div>
</form>
 <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">    Film Editor</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="film_editor_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from film_editor order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdateFilmEditor" class="btn btn-add"   value="Add Film Editor">
                                  
                              </div>
</form>
<form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Art Director</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="art_director_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="Updateartdirector" class="btn btn-add"   value="Add Art Director">
                                  
                              </div>
</form>

<form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-5">
    
                              <strong  style="float: right;">Production Designer</strong>
                              </div>
                           <div class="form-group col-sm-3">
                               
                                 
  <select name="film_production_designer_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdateProductionDesigner" class="btn btn-add"   value="Add Production Designer">
                                  
                              </div>
</form>
 <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Choreographer</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="film_choreographer_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from choreographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdateChoreographer" class="btn btn-add"   value="Add Choreographer">
                                  
                              </div>
</form>
 <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">Cinematographer</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="film_Cinematographer_id" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdateCinematographer" class="btn btn-add"   value="Add Cinematographer">
                                  
                              </div>
</form>
 <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
    <div class="form-group col-sm-4">
    
                              <strong  style="float: right;">DOP</strong>
                              </div>
                           <div class="form-group col-sm-4">
                               
                                 
  <select name="film_dop" class="form-control">
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                                <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="  col-sm-4">
   
                                 <input type="submit" name="UpdateDOP" class="btn btn-add"   value="Add DOP">
                                  
                              </div>
</form>

         </div>
        <!--New Crew Members End-->
     </div>
    

                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                                <div class="form-group">
                                 <label>Type</label>
                                 <select class="form-control" name="type" required>
                                     <option value="<? echo $row['type'];?>"><? echo $row['type'];?></option>
                                     <option value="Film">Film</option>
                                     <option value="Web Series">Web Series</option>
                                     <option value="TV Movie">TV Movie</option>
                                </select>
                              </div>
                              <div class="form-group">
                                 <label>name</label>
                                 <input type="text" name="name" class="form-control" placeholder="Update name" value="<? echo $row['name'];?>"   >
                              </div>
 <div class="form-group">
                                <label>Country (s)</label>
                                 
 
   <select class="main_language"  class="form-control" name="country[]" multiple="multiple">
                                  <? 
                              
                                  foreach($all_country_fetch as $country_print)
                                  {
                                     
                                  ?>
<option value="<? echo $country_print ?>" selected="selected"><? echo $country_print ?></option>
                                  <?
                                  }
                                 
                                       $sqlfr=mysqli_query($con, "select * from country order by country_name");
                                
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['country_name']; ?>"><? echo $rowfr['country_name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              
 
                                 
                              </div>
<div class="form-group"> <label>Genre: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_genre where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $genre_id= $rowss['genre_id'];

                                       $sqlsss=mysqli_query($con, "select * from genre where id='$genre_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteGenre&film_id=<? echo $rowss['film_id']; ?>&genre_id=<? echo $rowss['genre_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>

<div class="form-group"> <label>Lead Cast: </label>
<br/>
 <table class="table table-bordered">
      <tr>
          <th>S.N</th>
          <th>Name</th>
          <th>Character</th>
          <th>Remark</th>
          <th>Action</th>
  
  </tr> 
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_lead_cast where film_id='$film_id'");
                                      $leadcastcount=1;
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $film_lead_cast_id= $rowss['film_lead_cast_id'];

                                       $sqlsss=mysqli_query($con, "select * from cast where id='$film_lead_cast_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                <tr>
                                    <td><? echo $leadcastcount;?></td>
                                    <td><? echo $rowsss['name'];?></td>
                                    <td><? echo $rowss['film_lead_charater'];?></td>
                                    <td><? echo $rowss['film_lead_remark'];?></td>
                                    <td>
                                        <a data-toggle="modal" data-target="#editleadcastdialog<? echo $leadcastcount;?>" data-backdrop="static" data-keyboard="false"  class="btn btn-success btn-sm" ><i class="fa fa-pencil"></i></a> 
                                         <!--edit LeadCast Start-->
  
   <!-- Modal -->
  <div class="modal fade" id="editleadcastdialog<? echo $leadcastcount;?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Lead Cast Character Details</h4>
        </div>
        <div class="modal-body">
            <form method="post" action=""   enctype="multipart/form-data"  >
              <input type="hidden" name="rowid" value="<? echo $rowss['id'];?>">
                <input type="hidden" name="film_id" value="<? echo $rowss['film_id']; ?>">
                <input type="hidden" name="film_lead_cast_id" value="<? echo $rowss['film_lead_cast_id']; ?>">
          <div class="form-group">
    <label for="LeadCast">Lead Cast:</label>
 <select name="film_lead_cast_id_new" class="form-control">
     <option value="<? echo $rowsss['id']; ?>"><? echo $rowsss['name'];?></option>
                                  <? $sqlfr=mysqli_query($con, "select * from cast order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
  </div>
  <div class="form-group">
    <label for="character">Character Details:</label>
    <input type="text" class="form-control" id="character" name="characterdetails"  value="<? echo $rowss['film_lead_charater'];?>">
  </div>
   <div class="form-group">
    <label for="remark">Character Remark:</label>
    <input type="text" class="form-control" id="remark" name="remark" value="<? echo $rowss['film_lead_remark'];?>" >
  </div>
 <input type="submit" name="EditLeadCast<? echo $leadcastcount;?>" class="btn btn-add"   value="Update Lead Cast">
 </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <?
  $btnname="EditLeadCast$leadcastcount";
  if($_POST["$btnname"]) { 
    $id= $_POST['rowid'];
    $film_id= $_POST['film_id'];
    $film_lead_cast_id_old=$_POST["film_lead_cast_id"];
    $film_lead_cast_id_new= $_POST['film_lead_cast_id_new'];
    $characterdetails=$_POST["characterdetails"];
    $remark=$_POST["remark"];
     $updatedata="update film_lead_cast set film_lead_cast_id='$film_lead_cast_id_new',film_lead_charater='$characterdetails',film_lead_remark='$remark' where id='$id' and film_id='$film_id' and film_lead_cast_id='$film_lead_cast_id_old'";
    mysqli_query($con,$updatedata);
    $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
echo "<script>window.location.href='$actual_link'</script>";
//header("location:film.php?Action=Update&id=$film_id");
//header("location:film.php?Action=Update&id=$film_id");
}
?>
  <!--edit LeadCast End-->
  
                    
                                    <a href="film.php?Action=DeleteLeadCast&film_id=<? echo $rowss['film_id']; ?>&film_lead_cast_id=<? echo $rowss['film_lead_cast_id']; ?>&id=<? echo $rowss['id']; ?>" class="btn btn-danger btn-sm" ><i class="fa fa-times"></i></a></td>
                                </tr>       
  
                                     
       
                                    <?  $leadcastcount++;}    ?>
                                    </table>

                          </div>

<div class="form-group"> <label>Cast: </label>
<br/>
<table class="table table-bordered">
      <tr>
          <th>S.N</th>
          <th>Name</th>
          <th>Character</th>
          <th>Remark</th>
          <th>Action</th>
  
  </tr> 
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_cast where film_id='$film_id'");
                                      $othercastcount=1;
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $cast_id= $rowss['cast_id'];

                                       $sqlsss=mysqli_query($con, "select * from cast where id='$cast_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                       
                                       
                                          <tr>
                                    <td><? echo $othercastcount;?></td>
                                    <td><? echo $rowsss['name'];?></td>
                                    <td><? echo $rowss['film_other_charater'];?></td>
                                    <td><? echo $rowss['film_other_remark'];?></td>
                                    <td>
                                        <a data-toggle="modal" data-target="#otherleadcastdialog<? echo $othercastcount;?>" data-backdrop="static" data-keyboard="false"  class="btn btn-success btn-sm" ><i class="fa fa-pencil"></i></a> 
                                         <!--edit LeadCast Start-->
  
   <!-- Modal -->
  <div class="modal fade" id="otherleadcastdialog<? echo $othercastcount;?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Lead Cast Character Details</h4>
        </div>
        <div class="modal-body">
            <form method="post" action=""   enctype="multipart/form-data"  >
              <input type="hidden" name="rowid" value="<? echo $rowss['id'];?>">
                <input type="hidden" name="film_id" value="<? echo $rowss['film_id']; ?>">
                <input type="hidden" name="film_cast_id" value="<? echo $rowss['cast_id']; ?>">
          <div class="form-group">
    <label for="LeadCast">Other Cast:</label>
 <select name="film_other_cast_id_new" class="form-control">
     <option value="<? echo $rowsss['id']; ?>"><? echo $rowsss['name'];?></option>
                                  <? $sqlfr=mysqli_query($con, "select * from cast order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
  </div>
  <div class="form-group">
    <label for="character">Character Details:</label>
    <input type="text" class="form-control" id="character" name="othercharacterdetails"  value="<? echo $rowss['film_other_charater'];?>">
  </div>
   <div class="form-group">
    <label for="remark">Character Remark:</label>
    <input type="text" class="form-control" id="remark" name="otherremark" value="<? echo $rowss['film_other_remark'];?>" >
  </div>
 <input type="submit" name="EditOtherCast<? echo $othercastcount;?>" class="btn btn-add"   value="Update Other Cast">
 </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <?
  $btnname="EditOtherCast$othercastcount";
  if($_POST["$btnname"]) { 
    $id= $_POST['rowid'];
    $film_id= $_POST['film_id'];
    $film_cast_id_old=$_POST["film_cast_id"];
    $film_other_cast_id_new= $_POST['film_other_cast_id_new'];
    $characterdetails=$_POST["othercharacterdetails"];
    $remark=$_POST["otherremark"];
     $updatedata="update  film_cast set cast_id='$film_other_cast_id_new',film_other_charater='$characterdetails',film_other_remark='$remark' where id='$id' and film_id='$film_id' and cast_id='$film_cast_id_old'";
    mysqli_query($con,$updatedata);
    $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
echo "<script>window.location.href='$actual_link'</script>";
//header("location:film.php?Action=Update&id=$film_id");
//header("location:film.php?Action=Update&id=$film_id");
}
?>
  <!--edit LeadCast End-->
  
                    
                                     <a href="film.php?Action=DeleteCast&film_id=<? echo $rowss['film_id']; ?>&cast_id=<? echo $rowss['cast_id']; ?>&id=<? echo $rowss['id']; ?>" class="btn btn-danger btn-sm" ><i class="fa fa-times"></i></a></td>
                                </tr>       
  
                                     
       
                                    <?  $othercastcount++;}    ?>
                                    </table>
                                       
                                  

                          </div>


<div class="form-group"> <label>  Director: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_director where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $director_id= $rowss['director_id'];

                                       $sqlsss=mysqli_query($con, "select * from director where id='$director_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteDirector&film_id=<? echo $rowss['film_id']; ?>&director_id=<? echo $rowss['director_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>

<div class="form-group"> <label>  Co-Director: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_codirector where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $codirector_id= $rowss['codirector_id'];

                                       $sqlsss=mysqli_query($con, "select * from director where id='$codirector_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteCoDirector&film_id=<? echo $rowss['film_id']; ?>&codirector_id=<? echo $rowss['codirector_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                          <div class="form-group"> <label>  Presenter: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_presenter where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $presenter_id= $rowss['presenter_id'];

                                       $sqlsss=mysqli_query($con, "select * from producer where id='$presenter_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeletePresenterProducer&film_id=<? echo $rowss['film_id']; ?>&presenter_id=<? echo $rowss['presenter_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
<div class="form-group"> <label>  Producer: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_producer where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $producer_id= $rowss['producer_id'];

                                       $sqlsss=mysqli_query($con, "select * from producer where id='$producer_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteProducer&film_id=<? echo $rowss['film_id']; ?>&producer_id=<? echo $rowss['producer_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                          <div class="form-group"> <label> Co-Producer: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_co_producer where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $co_producer_id= $rowss['co_producer_id'];

                                       $sqlsss=mysqli_query($con, "select * from producer where id='$co_producer_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteCoProducer&film_id=<? echo $rowss['film_id']; ?>&co_producer_id=<? echo $rowss['co_producer_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
    <div class="form-group"> <label> Line-Producer: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_line_producer where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $film_line_producer_id= $rowss['film_line_producer_id'];

                                       $sqlsss=mysqli_query($con, "select * from producer where id='$film_line_producer_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteLineProducer&film_id=<? echo $rowss['film_id']; ?>&film_line_producer_id=<? echo $rowss['film_line_producer_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                            <div class="form-group"> <label> Executive Producer: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_executive_producer where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $film_executive_producer_id= $rowss['film_executive_producer_id'];

                                       $sqlsss=mysqli_query($con, "select * from producer where id='$film_executive_producer_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteExectiveProducer&film_id=<? echo $rowss['film_id']; ?>&film_executive_producer_id=<? echo $rowss['film_executive_producer_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
 <div class="form-group"> <label> Supervising Producer: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_supervising_producer where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $film_supervising_producer_id= $rowss['film_supervising_producer_id'];

                                       $sqlsss=mysqli_query($con, "select * from producer where id='$film_supervising_producer_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteSupervisingProducer&film_id=<? echo $rowss['film_id']; ?>&film_supervising_producer_id=<? echo $rowss['film_supervising_producer_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>

<div class="form-group"> <label>Music Director: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_music_director where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $music_director_id= $rowss['music_director_id'];

                                       $sqlsss=mysqli_query($con, "select * from music_director where id='$music_director_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteMusicDirector&film_id=<? echo $rowss['film_id']; ?>&music_director_id=<? echo $rowss['music_director_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                          <div class="form-group"> <label>Background Scorer: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_background_scorer where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $background_scorer_id= $rowss['background_scorer_id'];

                                       $sqlsss=mysqli_query($con, "select * from music_director where id='$background_scorer_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteBackgroundScorer&film_id=<? echo $rowss['film_id']; ?>&music_background_scorer_id=<? echo $rowss['background_scorer_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                          
                          <div class="form-group"> <label>Art Director: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_art_director where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $art_director_id= $rowss['art_director_id'];

                                       $sqlsss=mysqli_query($con, "select * from production_designer where id='$art_director_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteArtDirector&film_id=<? echo $rowss['film_id']; ?>&art_director_id=<? echo $rowss['art_director_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                          <div class="form-group"> <label>Dialogue Writers: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_dialogue_writers where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $dialogue_writers_id= $rowss['dialogue_writers_id'];

                                       $sqlsss=mysqli_query($con, "select * from screenplay where id='$dialogue_writers_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=dialogue_writers&film_id=<? echo $rowss['film_id']; ?>&dialogue_writers_id=<? echo $rowss['dialogue_writers_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                          <div class="form-group"> <label>Film Editor: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_editor_allot where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $film_editor_id= $rowss['film_editor_id'];

                                       $sqlsss=mysqli_query($con, "select * from film_editor where id='$film_editor_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteFilmEditor&film_id=<? echo $rowss['film_id']; ?>&film_editor_id=<? echo $rowss['film_editor_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                            <div class="form-group"> <label>Story Writer: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_story_writer where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $film_story_writer_id= $rowss['film_story_writer_id'];

                                       $sqlsss=mysqli_query($con, "select * from screenplay where id='$film_story_writer_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteStoryWriter&film_id=<? echo $rowss['film_id']; ?>&film_story_writer_id=<? echo $rowss['film_story_writer_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                             <div class="form-group"> <label>Production Designer: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_production_designer where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $film_production_designer_id= $rowss['film_production_designer_id'];

                                       $sqlsss=mysqli_query($con, "select * from production_designer where id='$film_production_designer_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteProductionDesigner&film_id=<? echo $rowss['film_id']; ?>&film_production_designer_id=<? echo $rowss['film_production_designer_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                             <div class="form-group"> <label>Choreographer: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_choreographer where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $film_choreographer_id= $rowss['film_choreographer_id'];

                                       $sqlsss=mysqli_query($con, "select * from choreographer where id='$film_choreographer_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteChoreographer&film_id=<? echo $rowss['film_id']; ?>&film_choreographer_id=<? echo $rowss['film_choreographer_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                             <div class="form-group"> <label>Screenplay: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_screenplay where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $film_screenplay_id= $rowss['film_screenplay_id'];

                                       $sqlsss=mysqli_query($con, "select * from screenplay where id='$film_screenplay_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteScreenplay&film_id=<? echo $rowss['film_id']; ?>&film_screenplay_id=<? echo $rowss['film_screenplay_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                             <div class="form-group"> <label>Action Director: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_action_director where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $film_action_director_id= $rowss['film_action_director_id'];

                                       $sqlsss=mysqli_query($con, "select * from actiondirector where id='$film_action_director_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteActionDirector&film_id=<? echo $rowss['film_id']; ?>&film_action_director_id=<? echo $rowss['film_action_director_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                            <div class="form-group"> <label>Cinematographer: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_cinematographer where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $cinematographer_id= $rowss['cinematographer_id'];

                                       $sqlsss=mysqli_query($con, "select * from cinematographer where id='$cinematographer_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteCinematographer&film_id=<? echo $rowss['film_id']; ?>&film_Cinematographer_id=<? echo $rowss['cinematographer_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
                          <div class="form-group"> <label>DOP: </label>
   <?
                                     $film_id=$row['id'];
                                      $sqlss=mysqli_query($con, "select * from film_dop where film_id='$film_id'");
                                      while($rowss=mysqli_fetch_array($sqlss)){
                                       $dop_id= $rowss['dop_id'];

                                       $sqlsss=mysqli_query($con, "select * from cinematographer where id='$dop_id'");
                                       $rowsss=mysqli_fetch_array($sqlsss);

                                       ?>
                                      <a href="film.php?Action=DeleteDOP&film_id=<? echo $rowss['film_id']; ?>&film_dop_id=<? echo $rowss['dop_id']; ?>" class="btn btn-danger btn-sm" ><? echo $rowsss['name'];?> <i class="fa fa-times"></i></a>
       
                                    <?  }    ?>

                          </div>
      <div class="form-group  ">
                                <label>Main Lanaguage(s)</label>
                                <?    $main_lang_fetch=$row["main_lang"];?>
   <select class="main_language"  class="form-control" name="main_language[]" multiple="multiple">
                                  <? 
                              
                                  foreach($main_lang_ex as $main_lang_print)
                                  {
                                       $sqlfr_name=mysqli_query($con, "select * from dubbing where id='$main_lang_print'");
                                       $lange_name=mysqli_fetch_array($sqlfr_name);
                                       $lange_name_print=$lange_name["name"];
                                       $lange_id_print=$lange_name["id"];
                                  ?>
<option value="<? echo $lange_id_print ?>" selected="selected"><? echo $lange_name_print ?></option>
                                  <?
                                  }
                                  if(empty($main_lang_fetch))
                                  {
                                       $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  }
                                  else
                                  {
                                  $sqlfr=mysqli_query($con, "select * from dubbing where id not in ($main_lang_fetch) order by name");
                                  }
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              
 
                                 
                              </div>
                           <div class="form-group  ">
                                <label>Dubbing Lanaguage(s)</label>
                                 <?    $debugging_lang_fetch=$row["dubbing"];?>
   <select class="dubbing_lang"  class="form-control" name="dubbing_language[]" multiple="multiple">
                                 <? 
                              
                                  foreach($dubbing_lang_ex as $debbing_lang_print)
                                  {
                                       $sqlfr_name_debug=mysqli_query($con, "select * from dubbing where id='$debbing_lang_print'");
                                       $lange_name_debug=mysqli_fetch_array($sqlfr_name_debug);
                                       $deb_lange_name_print=$lange_name_debug["name"];
                                       $deb_lange_id_print=$lange_name_debug["id"];
                                  ?>
<option value="<? echo $deb_lange_id_print ?>" selected="selected"><? echo $deb_lange_name_print ?></option>
                                  <?
                                  }
                                  $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  while($rowfr1=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr1['id']; ?>"><? echo $rowfr1['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              
 
                                 
                              </div>
                          <div class="form-group">
                                 <label>IS This Dubbed:</label>
                                 <select class="form-control" id="isdubbed" name="isdubbed" required>
                                     <option value="<? echo $row['isdubbed']; ?>" selected><? echo $row['isdubbed']; ?></option>
                                     <option value="Yes">Yes</option>
                                     <option value="No">No</option>
                                     
                                </select>
                              </div>
                              <div id="isdubbedsection" style="display: block;border: 1px solid black;padding: 14px;">
                                  <fieldset>
                                      <legend>Please Fillout These Details Also:</legend>
                                   <div class="form-group">
                                 <label>Original Movie Name </label>
                                 <input type="text" class="form-control" name="original_movie_name" value="<? echo $row['original_movie_name']; ?>" placeholder="Enter Original Movie Name"  >
                              </div>
                                <div class="form-group  ">
                                <label>Lanaguage(s)</label>
                                 
   <select class="main_language"  class="form-control" name="dubbed_main_language[]" multiple="multiple">
                                 <?
                                  $debugging_mainlang_fetch=$row["dubbed_main_language"];
                                 foreach($dubbed_main_language as $debbing_lang_print)
                                  {
                                       $sqlfr_name_debug=mysqli_query($con, "select * from dubbing where id='$debbing_lang_print'");
                                       $lange_name_debug=mysqli_fetch_array($sqlfr_name_debug);
                                       $deb_lange_name_print=$lange_name_debug["name"];
                                       $deb_lange_id_print=$lange_name_debug["id"];
                                  ?>
<option value="<? echo $deb_lange_id_print ?>" selected="selected"><? echo $deb_lange_name_print ?></option>
                                  <?
                                  }
                                  $sqlfr=mysqli_query($con, "select * from dubbing where id not in ($debugging_mainlang_fetch) order by name");
                                  while($rowfr1=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr1['id']; ?>"><? echo $rowfr1['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Release Date</label>
                                 <input type="text" class="form-control" name="dubbed_date_release" value="<? echo $row['dubbed_date_release']; ?>" placeholder="Enter Release Date"  >
                              </div>
                          <div class="form-group">
                                 <label>Release Month</label>
                                 <input type="text" class="form-control" name="dubbed_month_release" value="<? echo $row['dubbed_month_release']; ?>" placeholder="Enter Release Month"  >
                              </div>
                          <div class="form-group">
                                 <label>Release Year</label>
                                 <input type="text" class="form-control" name="dubbed_year_release" value="<? echo $row['dubbed_year_release']; ?>" placeholder="Enter Release Year"  >
                              </div>
                               <div class="form-group  ">
                                <label>Genre(s)</label>
                                 
   <select class="main_language"  class="form-control" name="dubbed_Genre[]" multiple="multiple">
                                  <?
                                   $debugging_genre_fetch=$row["dubbed_Genre"];
                                 foreach($dubbed_Genre as $debbing_genre_print)
                                  {
                                       $sqlfr_name_debug=mysqli_query($con, "select * from genre where id='$debbing_genre_print'");
                                       $lange_name_debug=mysqli_fetch_array($sqlfr_name_debug);
                                       $deb_lange_name_print=$lange_name_debug["name"];
                                       $deb_lange_id_print=$lange_name_debug["id"];
                                  ?>
<option value="<? echo $deb_lange_id_print ?>" selected="selected"><? echo $deb_lange_name_print ?></option>
                                  <?
                                  }
                                  $sqlfr=mysqli_query($con, "select * from genre where id not in ($debugging_genre_fetch) order by name");
                                  while($rowfr1=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr1['id']; ?>"><? echo $rowfr1['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                                <div class="form-group">
                                 <label>YouTube Channel</label>
                                 <input type="text" class="form-control" name="dubbed_youtube" value="<? echo $row['dubbed_youtube']; ?>" placeholder="Enter You Tube Channel Link"  >
                              </div>
                              <div class="form-group">
                                 <label>Upload Date</label>
                                 <input type="date" class="form-control" name="dubbed_upload_date" value="<? echo $row['dubbed_upload_date']; ?>" >
                              </div>
                              </fieldset>
                               
                              </div>
                      
                        
                         <div class="form-group">
                                 <label>Box Office</label>
                                 <input type="text" class="form-control" name="box_office" placeholder="Enter Box Office" value="<? echo $row['box_office'];?>" >
                              </div>
                         <div class="form-group">
                                 <label>Budget</label>
                                 <input type="text" class="form-control" name="budget" placeholder="Enter Budget" value="<? echo $row['budget'];?>" >
                              </div>
                         
                               <div class="form-group">
                                 <label> Date Release</label>
                                 <input type="text" class="form-control" name="date_release" placeholder="Enter  Date Release"  value="<? echo $row['date_release'];?>"  >
                              </div>
                          <div class="form-group">
                                 <label> Month Release</label>
                                 <input type="text" class="form-control" name="month_release" placeholder="Enter  Month Release"  value="<? echo $row['month_release'];?>"  >
                              </div>
                          <div class="form-group">
                                 <label> Year Release</label>
                                 <input type="text" class="form-control" name="year_release" placeholder="Enter  Year Release"  value="<? echo $row['year_release'];?>"  >
                              </div>
                         


                           <div class="form-group">
                                 <label>You Tube Trailer Link</label>
                                 <input type="text" class="form-control" name="youtube" placeholder="Enter You Tube Link" value="<? echo $row['youtube'];?>" >
                              </div>
                          
                          <div class="form-group">
                                 <label>You Tube Film Link</label>
                                 <input type="text" class="form-control" name="youtube_film" placeholder="Enter You Tube Film Link" value="<? echo $row['youtube_film'];?>" >
                              </div>
                          
                         
                                 <div class="form-group">
                                 <label>Image</label>
                                 <img src="photo/<? echo $row['photo']; ?>" width="100"> 
                                   <input type="file"  name="filstor"  class="form-control">
                                    <input type="hidden" name="oldimg" value="<? echo $row['photo']; ?>">
                                  
                              </div>   
                              <div class="form-group">
                                 <label>Rating</label>
                                 <input type="text" class="form-control" name="rating" placeholder="Enter Rating" value="<? echo $row['rating'];?>" >
                              </div>
 <div class="form-group">
                                 <label>Rotten Tomato Rating</label>
                                 <input type="text" class="form-control" name="rotten_rating" placeholder="Enter Rotten Tomato Rating"  value="<? echo $row['rotten_rating'];?>"  >
                              </div>
                              <div class="form-group">
                                 <label>IMDB Rating</label>
                                 <input type="text" class="form-control" name="imdb_rating" placeholder="Enter IMDB Rating"  value="<? echo $row['imdb_rating'];?>"  >
                              </div>
                              
                               <div class="form-group">
                                 <label>CBFC Rating</label>
                              
 <select name="cbfc_rating" class="form-control"> 
                                 

<option value=""  ></option>
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
                                 <label>Is This Film Shelved/Unreleased?</label>
                             
 <select name="cbfc_status" class="form-control"> 
<option value="<? echo $row['cbfc_status'];?>" selected="selected"><? echo $row['cbfc_status'];?></option>              
<option value="Yes">Yes</option>
<option value="No">No</option>

                                 
                                 </select> 
                              </div>

                              
      <div class="form-group">
                                 <label>cbfc_releasing_platform</label>
                                            
 <select name="cbfc_releasing_platform" id="cbfc_releasing_platform" class="form-control">
     <option value="<? echo $row['cbfc_releasing_platform']; ?>"><? echo $row['cbfc_releasing_platform']; ?></option> 
<? $sqlfr=mysqli_query($con, "select * from platform order by platform_name");
                                  while($rowfr1=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr1['platform_name']; ?>"><? echo $rowfr1['platform_name']; ?></option>
                                  <? } ?>
                                 
                                 </select> 
                              </div>

                              
      <div class="form-group" id="ott_platform">
                                 <label>OTT Platform Name:</label>
                                 <select name="cbfc_releasing_platform_details" id="cbfc_releasing_platform_details" class="form-control">
                                 <option value="<? echo $row['cbfc_releasing_platform_details']; ?>"><? echo $row['cbfc_releasing_platform_details']; ?></option> 
<? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                  while($rowfr1=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr1['name']; ?>"><? echo $rowfr1['name']; ?></option>
                                  <? } ?>
                                 
                                 </select> 
                              </div>

                              
     <div class="form-group">
                                 <label>Story</label>
                                 <textarea name="story" rows="25"><? echo $row['story'];?></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Climax</label>
                                 <textarea name="climax" rows="25"><? echo $row['climax'];?></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Acting</label>
                                 <textarea name="acting" rows="25"><? echo $row['acting'];?></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Film Review</label>
                                 <textarea name="film_review" rows="25"><? echo $row['film_review'];?></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Trailer Review</label>
                                 <textarea name="trailer_review" rows="25"><? echo $row['trailer_review'];?></textarea> 
                              </div>


     <div class="form-group">
                                 <label>Why Watch</label>
                                 <textarea name="why_watch" rows="25"><? echo $row['why_watch'];?></textarea> 
                              </div>
                             

     <div class="form-group">
                                 <label>Why Not Watch</label>
                                 <textarea name="why_not_watch" rows="25"><? echo $row['why_not_watch'];?></textarea> 
                              </div>
                               <div class="form-group">
                                 <label>Meaning of the Film</label>
                                 <input type="text" name="meaningfilm" value="<? echo $row['film_meaning'];?>" class="form-control" />
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
                                 <h4>film List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">




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
    url: "search_film_old.php",
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

 <div class="btn-group"  >
                              <div class="buttonexport" id="buttonlist"> 
                                 <!--<a class="btn btn-add" href="film.php?Action=Add"> <i class="fa fa-plus"></i> Add film
                                 </a>  -->
                              </div>
                            
                           </div>
  
<input type="text" class="search form-control" id="searchid" placeholder="Search for Film" style="width: 100%" />  
<div id="result"></div>
 

<br><br>


                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                          






                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>Name</th> 
                                       <th>Photo</th> 
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `film`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `film` order by id desc LIMIT $offset, $total_records_per_page");



                                   
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                       <td><? echo $row['name']; ?></td> 
                                     <td><? if($row['date_release']!="" or $row['date_release']!="00"){ echo $rowf['date_release'];} ?> 

<? if($row['month_release']!="" or $row['month_release']!="00"){ 
 $monthNum= ltrim($row['month_release'], '0');  
 if($monthNum!=0){ 
echo date('F', mktime(0, 0, 0, $monthNum, 10)); } }?> 
 
<?   if($row['year_release']!="" or $row['year_release']!="0000"){ 
       echo $row['year_release']; 
} ?> 

                                     </td> 
                                      <td> <img src="photo/<? echo $row['photo']; ?>" width="50"></td>
                                       <td>
                                        
                                          <a href="film.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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
        <!-- Modal -->
  <div class="modal fade" id="leadcastdialog" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Lead Cast Character Details</h4>
        </div>
        <div class="modal-body">
            <form method="post" action=""   enctype="multipart/form-data"  >
              <input type="hidden" name="id" value="<? echo $row['id'];?>">
          <div class="form-group">
    <label for="LeadCast">Lead Cast:</label>
 <select name="film_lead_cast_id" class="form-control">
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
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 
          <!-- Modal -->
  <div class="modal fade" id="othercastdialog" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Other Cast Character Details</h4>
        </div>
        <div class="modal-body">
            <form method="post" action=""   enctype="multipart/form-data"  >
              <input type="hidden" name="id" value="<? echo $row['id'];?>">
          <div class="form-group">
    <label for="OtherCast">Other Cast:</label>
 <select name="cast_id" class="form-control">
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
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <script>
   
      $(document).on("click","#leadcast",function(){
  
  $("#leadcastdialog").modal("toggle");
  
})
  </script>
  
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
<script>
  $(document).ready(function() {
    $('.main_language').select2();
});
</script>
<script>
  $(document).ready(function() {
    $('.dubbing_lang').select2();
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