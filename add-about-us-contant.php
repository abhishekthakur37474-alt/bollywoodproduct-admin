<?
session_start();
include "config.php";
if ($_SESSION['admin'] == "") {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Static Details</title>
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
    <!--textaera------css-->
    <link href="/admin/richtext.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/site.css" rel="stylesheet" type="text/css" />
    <!-- End Global Mandatory Style
         =====================================================================-->
    <!-- Start Theme Layout Style
         =====================================================================-->
    <!-- Theme style -->
    <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css" />


    <!-- select2 -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/qyhq7trksx7i1gpmasi3h8szpuzmiuj9c3epa0k2hjpuszlk/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
    <style>
        select {
            width: 100%;
        }

        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;
        }

        legend.scheduler-border {
            font-size: 1.2em !important;
            font-weight: bold !important;
            text-align: left !important;
            width: auto;
            padding: 0 10px;
            border-bTriviaom: none;
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
                    <h1> Static Details Management</h1>
                    <small>Add Static Film Details</small>
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
                                        <h4>Add Static Film Details Here</h4>
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">

                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Select Title:</label>
                                                    <input type="text" class="form-control" class="form-control"
                                                        name="title" id="type">
                                            </div>

                                            <div class="form-group">
                                                <label>Alias:</label>
                                                        <input type="text" class="form-control" class="form-control"
                                                        name="alias" id="print" readonly value="<?php echo $read["alias"]; ?>">
                                            </div>

                                            <div class="field_wrapper7">

                                                <br>
                                                <div class="form-group">
                                                    <label>Content</label>
                                                    <textarea class="" name="details[]"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reset-button">
                                            <input type="submit" name="Updatetrivia_content" class="btn btn-add"
                                                value="Add Details" style="margin-top:10px;" >
                                        </div>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST["Updatetrivia_content"])) {
                                    $details_film = mysqli_real_escape_string($con, implode(",", $_POST["details"]));
                                    $title = mysqli_real_escape_string($con, $_POST['title']);
                                    $alias = mysqli_real_escape_string($con, $_POST['alias']);
                                    $trivia_add = "insert into content set title='$title',alias='$alias',details='$details_film'";
                                    mysqli_query($con, $trivia_add);
                                    echo "<script>alert('Static  Details Save Successfully')</script>";
                                    echo "<script>window.location.href='about_us_contant.php'</script>";
                                }
                                ?>


            </section>
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->
        <?php include('footer.php'); ?>
    </div>

    </div>
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
    <script>
    $("#type").keyup(function(){
       var textValue = $("#type").val();
       textValue= textValue.replace(/ /g,"-");
       $("#print").val(textValue);
    })
    </script>
    <!-- End Theme label Script
         =====================================================================-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css"
        integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js"
        integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/admin/assets/bootstrap/js/jquery.richtext.js"></script>
    <script src="/admin/assets/bootstrap/js/jquery.richtext.min.js"></script>

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
            var maxField7 = 10; //Input fields increment limitation
            var addButton7 = $('.add_button7'); //Add button selector
            var wrapper7 = $('.field_wrapper7'); //Input field wrapper
            var fieldHTML7 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>' +
                '<br/>' +
                '<div class="form-group">' +
                '<label>Trivia:</label>' +
                '<textarea class="text_add" name="text_area_trivia[]"></textarea>' +
                '</div>' +

                '</div>'; //New input field html 
            var x = 1; //Initial field counter is 1
            // Once add button is clicked
            $(addButton7).click(function () {
                //Check maximum number of input fields
                if (x < maxField7) {
                    x++; //Increase field counter
                    $(wrapper7).append(fieldHTML7); //Add field html
                    $('.main_language').select2();
                    tinymce.init({
                        selector: 'textarea',
                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
                        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                    });
                } else {
                    alert('A maximum of ' + maxField2 + ' fields are allowed to be added. ');
                }
            });

            // Once remove button is clicked
            $(wrapper7).on('click', '.remove_button', function (e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrease field counter
            });

        });

    </script>
</body>

</html>