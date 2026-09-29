<?php
include('config.php');

if(isset($_POST['search'])){

$q = trim($_POST['search']);

if($q==''){
exit;
}

$q=mysqli_real_escape_string($con,$q);

/* ALL TABLES */

$tables=[

'cast',
'director',
'producer',
'actiondirector',
'additionalcontributors',
'choreographer',
'cinematographer',
'casting',
'costumes',
'film_editor',
'lyricist',
'location_manager',
'music_director',
'mix',
'music_programmer',
'master',
'music_producer',
'music_arranged',
'makeup',
'marketing_publicity',
'production_designer',
'productionanddistribution',
'productionandmanagement',
'special_effect_manager',
'singer',
'screenplay',
'sound',
'visualeffects'

];

$queries=[];

foreach($tables as $table){

$queries[]="

SELECT

id,
name,
real_name,
nickname,
movie_language,
profile_unique_id,

'$table' AS profile_type,

(

CASE

/* Exact Match Priority */

WHEN LOWER(name)=LOWER('$q') THEN 100
WHEN LOWER(real_name)=LOWER('$q') THEN 95
WHEN LOWER(nickname)=LOWER('$q') THEN 90
WHEN LOWER(profile_unique_id)=LOWER('$q') THEN 85


/* Starts With */

WHEN LOWER(name) LIKE LOWER('$q%') THEN 80
WHEN LOWER(real_name) LIKE LOWER('$q%') THEN 75
WHEN LOWER(nickname) LIKE LOWER('$q%') THEN 70


/* Contains */

WHEN LOWER(name) LIKE LOWER('%$q%') THEN 60
WHEN LOWER(real_name) LIKE LOWER('%$q%') THEN 55
WHEN LOWER(nickname) LIKE LOWER('%$q%') THEN 50
WHEN LOWER(profile_unique_id) LIKE LOWER('%$q%') THEN 45

ELSE 0

END

) AS search_rank


FROM $table


WHERE

LOWER(name) LIKE LOWER('%$q%')

OR LOWER(real_name) LIKE LOWER('%$q%')

OR LOWER(nickname) LIKE LOWER('%$q%')

OR LOWER(profile_unique_id) LIKE LOWER('%$q%')

";

}

$combine_query="

SELECT *

FROM

(

".implode(" UNION ALL ",$queries)."

) profiles

ORDER BY

search_rank DESC,
name ASC

LIMIT 50
";

$sql_res=mysqli_query($con,$combine_query)
or die(mysqli_error($con));

if(mysqli_num_rows($sql_res)==0){

echo "<div class='show'>No results found</div>";

exit;

}


$profile_labels=[

'cast'=>'Cast',
'director'=>'Director',
'producer'=>'Producer',
'sound'=>'Sound',
'visualeffects'=>'Visual Effects',
'marketing_publicity'=>'Marketing Publicity',
'music_director'=>'Music Director',
'singer'=>'Singer',
'film_editor'=>'Film Editor',
'cinematographer'=>'Cinematographer'

];

while($row=mysqli_fetch_assoc($sql_res)){

$profile=$row['profile_type'];

$profile_type_name=
isset($profile_labels[$profile])
?
$profile_labels[$profile]
:
ucwords(str_replace('_',' ',$profile));

$id=$row['id'];

$name=$row['name'];

$real_name=$row['real_name'];

$nickname=$row['nickname'];

$language=$row['movie_language'];

$profile_unique_id=
$row['profile_unique_id'];

$display="

<i>ID:</i> $id
-
<i>Name:</i>
$name

($profile_type_name)

<br>

";

if(!empty($language)){
$display.="
<i>Movie Language:</i>
$language
<br>
";
}

$display.="

<i>Profile ID:</i>

$profile_unique_id

";

if(!empty($real_name)){

$display.="

<br>

<i>Real Name:</i>

$real_name

";

}

if(!empty($nickname)){

$display.="

<br>

<i>Nick Name:</i>

$nickname

";

}


$display=preg_replace(

'/('.preg_quote($q,'/').')/i',

'<strong>$1</strong>',

$display

);

?>

<div
class="show"
align="left"
style="
padding:8px;
border-bottom:1px solid #eee;
">

<span class="name">

<a

href="crew-details-edit.php?Action=Update&id=<?=$id?>&profile=<?=$profile?>&profile_unique_id=<?=$profile_unique_id?>"

style="
color:#111;
text-decoration:none;
"

>

<?=$display?>

</a>

</span>

<br>

<a

href="crew-details-edit.php?Action=Update&id=<?=$id?>&profile=<?=$profile?>&profile_unique_id=<?=$profile_unique_id?>"

style="color:#0044de;"

>

Edit

</a>

|

<a

href="common-delete-cast-crew.php?Action=delete&id=<?=$id?>&profile=<?=$profile?>&profile_unique_id=<?=$profile_unique_id?>"

style="color:red;"

onclick="return confirm('Delete this record?')"

>

Delete

</a>

</div>

<?php

}

}

?>