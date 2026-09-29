<? 

include "config.php";
         
          $email=$_GET["email"];
          $q_forgot_password="select * from admin where email='$email'";
          $forgot_exe=mysqli_query($con,$q_forgot_password);
          $check_email_id=mysqli_num_rows($forgot_exe);
          $read_forgot_data=mysqli_fetch_array($forgot_exe);
          if(empty($email))
          {
               echo "<script>alert('Invalid Access!!!')</script>";
               echo "<script>window.location.href='index.php'</script>";
          }
          if($check_email_id<=0)
          {
              echo "<script>alert('Invalid Access!!!')</script>";
               echo "<script>window.location.href='index.php'</script>";
          }
          
?>
<!DOCTYPE html>
<html lang="en">
     
<head style="background-color:white;">
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
       
        
        <form method="post" enctype="multipart/form-data">
        <div class="popup">
           <div class="container " >

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false" style="background-color:white;">
    <div class="modal-dialog" >
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header">
         
         <h2>Create New Password</h2>
        </div>
        <div class="modal-body">
            
            <form method="post">
            
          <label class="control-label" for="email">New Password</label>
                                <input type="password" placeholder="enter your email"  required  name="password" id="password" class="form-control">
                                  <label class="control-label" for="email">Repeat New Passwoerd</label>
                                <input type="password" placeholder="enter your email"  required  name="newpassword" id="newpassword" class="form-control">
                                <br>
                                <span id="msg"></span>
          <input type="submit" name="submit" value="submit" class="btn btn-add">
          </form>
         
         
        
          
        <div class="modal-footer">
          <a href="index.php"><button type="button" class="btn btn-danger">Close</button></a>
        </div>
      </div>
    
      
    </div>
  </div>
  
</div>
</div>






  
<?
  
  
               if(isset($_POST["submit"]))
                  {
                       $password=$_POST["password"];
                       $repassword=$_POST["newpassword"];
                       
                        if($password == $repassword) {
                     
                     
                     
                       $q="update admin set password='$password' where email='$email'";
                      mysqli_query($con,$q);
                      echo "<script>alert('Password Update Successfully')</script>";
                     echo "<script>window.location.href='index.php'</script>";
                      }
                      else
                  {
                     // echo "<script>document.getElementById('msg').innerHTML=Password and Repassword Must be Same!!!''</script>";
                       echo "<script>alert('Password and Repassword Must be Same!!!')</script>";
                  }
                  }
  
                      ?>
          

  <script type="text/javascript">
  
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
</script>
    






       
        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
 
</html>