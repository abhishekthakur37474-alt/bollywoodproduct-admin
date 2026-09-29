
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include "config.php";
 
 function sanitize3($string, $force_lowercase = true, $anal = false) {
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                   "â€”", "â€“", ",", "<", ".", ">", "/", "?");

    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $pattern = '/-+/';
    $clean = preg_replace($pattern, '-', $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

    return ($force_lowercase) ?
        (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') :
            strtolower($clean) :
        $clean;
}
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(isset($_REQUEST["term"])){
    // Prepare a select statement

  $cast_q="SELECT  * FROM cast WHERE name LIKE ? order by name asc";

 
 
    // $sql = "SELECT * FROM film WHERE name LIKE ? ";
    
    if($stmt = mysqli_prepare($con,$cast_q)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
while($rowfr=mysqli_fetch_array($result, MYSQLI_ASSOC)){ 

$id=$rowfr['id'];
$name=$rowfr['name']; 
$nick_name=$rowfr['nickname']; 
$b_name='<strong>'.$q.'</strong>'; 
$final_name = str_ireplace($q, $b_name, $name); 
$profile_unique_id=$rowfr["profile_unique_id"];
$cast_name_with_hypen =strtolower(str_replace(' ', '-', $name));
?>
   <span class="name"><a href="crew-details-edit.php?Action=Update&id=<? echo $id ;?>&profile=cast&profile_unique_id=<? echo $profile_unique_id ;?>"  style="color:#111111"><?php echo $final_name; ?>(Nick Name:<? echo $nick_name;?>(<? echo $id;?>))</a></span>&nbsp;<br/><a href="crew-details-edit.php?Action=Update&id=<? echo $id ;?>&profile=cast&profile_unique_id=<? echo $profile_unique_id ;?>"" style="color:#0044de">Edit</a>, <a href="javascript:resume_id('<? echo $id?>')"  style="color:#F00">Delete</a><br/>
	<?  
      
      
    }
    
    }
}
    }
    // Close statement
    mysqli_stmt_close($stmt);
}
?>