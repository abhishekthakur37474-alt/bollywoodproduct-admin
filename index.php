<? 
session_start();
include "config.php";

?>
<!DOCTYPE html>
<html lang="en">
     
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bollywood Product</title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
        <!-- Bootstrap -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap rtl -->
        <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
        <!-- Pe-icon-7-stroke -->
        <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <!-- style css -->
        <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <!-- Theme style rtl -->
        <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
        <style>

        .password{
        
            display: inline-block;
            position: relative;
            border: 0px #000 solid;
        
        }
        .password input{
            width:315px;
            padding: 10px 15px;
            outline: one;
            border: 1;
            border-radius:4px;
        }
        .pass-icon{
            position: absolute;
            top: 5px;
            right: 10px;
            width: 24px;
            cursor: pointer;
        }
        
            </style>
        
    </head>
    <body>
        <!-- Content Wrapper -->
        <div class="login-wrapper">
           
            <div class="container-center">  <h3><strong style="color: #F00"></strong></h3>
            <div class="login-area">
                <div class="panel panel-bd panel-custom">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3>
                                <small><strong>Please enter your credentials to login.</strong></small><br>
                              
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  method="post" action="login.php" id="loginForm" novalidate>
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" placeholder="Yourusername" title="Please enter you username" required="" value="" name="username" id="username" class="form-control">
                                <span class="help-block small">Your unique username to app</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                 <div class="password">
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                                <img src="photo/hide.jpeg"  class="pass-icon" id="eyeicon">
</div>
   
                                
   

                                
                                <span class="help-block small">Your strong password</span>
                            </div>
                            <div>
                                
                                <input type="submit" name="submit" value="Login" class="btn btn-add">
                                
                                
                                 <button style="margin-left:100px" type="button" class="btn btn-add " data-toggle="modal" data-target="#myModal">Forgot Password?</button>
                            </div>
                            
                            
                            
                            
                         
                            
                            
                            
                        </form>
                        </div>
                        </div>
                </div>
            </div>
        </div>
        
        
        
        <form method="post">
        <div class="popup">
           <div class="container ">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h3>Forgot Password?</h3>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            
            <form method="post">
            
          <label class="control-label" for="email">Enter Your Register Email</label>
                                <input type="email" placeholder="enter your email"  required  name="email" id="forgetemail" class="form-control">
                                <BR>
          <input type="submit" name="forget" value="Send Reset Email" class="btn btn-add">
          </form>
          
          <?php
          if(isset($_POST["forget"]))
          {
          $email=$_POST["email"];
          $q_forgot_password="select * from admin where email='$email'";
          $forgot_exe=mysqli_query($con,$q_forgot_password);
          $check_email_id=mysqli_num_rows($forgot_exe);
          $read_forgot_data=mysqli_fetch_array($forgot_exe);
          if($check_email_id>0)
          {
              $forgotemail=$read_forgot_data["email"];
             $url="https://bollywoodproduct.com/admin/update_password.php?email=$forgotemail";
              $to ="$email";
$subject = "BollyWood Product Admin Forgot Password";
$message = "

<p>Please Click Below Link To Reset Your Password!</p>
<a href='$url'>Click Here</a>

";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From:admin@bollywoodproduct.com" . "\r\n" .
"CC: abhinavkumar201@gmail.com";

mail($to,$subject,$message,$headers);
 echo "<script>alert('Reset Password Link Send on Your Register Email Address,Please Check Your Email ID!!!')</script>";
          }
          else
          {
               echo "<script>alert('This is Email is Not Valid')</script>";
              
          }
          }
          
          ?>
        </div>
        
          
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    
      
    </div>
  </div>
  
</div>
</div>

<!--
  <script type="text/javascript">
  
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
</script>
    

-->




         <script>
let eyeicon = document.getElementById('eyeicon');
let password = document.getElementById('password');

eyeicon.onclick = function(){
    if(password.type == "password"){
        password.type = "text";
        eyeicon.src = "photo/show.jpeg"; 
        
    }else{

        password.type = "password";
        eyeicon.src = "photo/hide.jpeg";
        
    }
}
    </script>
        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
 
</html>