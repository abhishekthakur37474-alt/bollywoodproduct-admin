<?php
session_start();
include "config.php";
if (empty($_SESSION['admin'])) {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Film Trailer Details Management</title>
    
    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    
    <!-- CSS Plugins -->
    <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
    <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
    
    <!-- Select2 CSS Moved to Head -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />

    <!-- Theme Style -->
    <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>

    <!-- Load Core jQuery once in HEAD to prevent layout breaking -->
    <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>

    <script>
    function del() {
        return confirm('Are you sure delete this...?');
    }
    </script>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include "topandleft.php"; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="header-icon"><i class="fa fa-users"></i></div>
                <div class="header-title">
                    <h1>Film Trailer Details Management</h1>
                    <small>Film Trailer Details List</small>
                </div>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag">
                            <div class="panel-heading">
                                <div class="btn-group" id="buttonexport">
                                    <a href="#"><h4>Film Trailer Details Management List</h4></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="btn-group">
                                    <div class="buttonexport" id="buttonlist"> 
                                        <a class="btn btn-add" href="add_film_Trailer_details.php">
                                            <i class="fa fa-plus"></i> Add Film Trailer Details
                                        </a>  
                                    </div>
                                </div> 

                                <!-- Ajax Live Search -->
                                <input type="text" class="search form-control" id="searchid" placeholder="Search for Film Trailer" style="width: 100%; margin-top: 15px;" autocomplete="off" />  
                                <div id="result"></div>
                                <br/>

                                <!-- Optimized Select Dropdown (Limited to 100 to stop hanging) -->
                                
                            <!--    
                            <select class="form-control select2" onChange="if(this.value) window.document.location.href=this.value;">
                                    <option value="">Quick Select Trailer (Latest 100)</option>
                                    <?php 
                                    // JOIN query used: 1 single query instead of thousands
                                    $sqlfs = mysqli_query($con, "
                                        SELECT ftm.id, ftm.trailer_category, ftm.trailer_release_date, ftm.trailer_release_month, ftm.trailer_release_year, ftm.trailer_lanaguage, f.name as film_name, f.year_release 
                                        FROM film_trailer_management ftm 
                                        LEFT JOIN film f ON ftm.film_id = f.id 
                                        ORDER BY ftm.id DESC LIMIT 100
                                    ");
                                    while($rowfs = mysqli_fetch_array($sqlfs)) { 
                                    ?>
                                        <option value="edit_film_trailer_details.php?id=<?php echo $rowfs['id']; ?>">
                                            <?php echo htmlspecialchars($rowfs['film_name']); ?> - <?php echo $rowfs['year_release']; ?> | <?php echo $rowfs['trailer_category'];?>/<?php echo $rowfs['trailer_release_date'];?>-<?php echo $rowfs['trailer_release_month'];?>-<?php echo $rowfs['trailer_release_year'];?> (<?php echo $rowfs['trailer_lanaguage']?>)
                                        </option>
                                    <?php } ?>
                                </select>
                                -->
                                
                                <br/><br/>

                                <!-- Table Section -->
                                <div class="table-responsive">
                                    <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr class="info"> 
                                                <th>S.N</th>
                                                <th>Film Id</th>
                                                <th>Film Name</th>
                                                <th>Trailer Release Date</th> 
                                                <th>Trailer Category</th> 
                                                <th>Trailer Language</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $page_no = (isset($_GET['page_no']) && $_GET['page_no'] != "") ? (int)$_GET['page_no'] : 1;
                                            $total_records_per_page = 10;
                                            $offset = ($page_no - 1) * $total_records_per_page;
                                            $adjacents = "2"; 

                                            $result_count = mysqli_query($con, "SELECT COUNT(*) As total_records FROM `film_trailer_management`");
                                            $total_records = mysqli_fetch_array($result_count)['total_records'];
                                            $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                            $second_last = $total_no_of_pages - 1;

                                            // Fetch records
                                            $result = mysqli_query($con, "SELECT * FROM `film_trailer_management` ORDER BY trailer_release_year DESC, trailer_release_month DESC, trailer_release_date DESC LIMIT $offset, $total_records_per_page");

                                            $sn = $offset + 1;
                                            while($row = mysqli_fetch_array($result)) { 
                                            ?>
                                            <tr>
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $row['film_id']; ?></td>
                                                <td><?php echo htmlspecialchars($row["name"]); ?></td> 
                                                <td><?php echo $row["trailer_release_date"]."-".$row["trailer_release_month"]."-".$row["trailer_release_year"]; ?></td>      
                                                <td><?php echo $row['trailer_category']; ?></td>
                                                <td><?php echo $row['trailer_lanaguage']; ?></td>
                                                <td>
                                                    <a href="edit_film_trailer_details.php?id=<?php echo $row['id'];?>" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                                    <a href="delete_film_trailer_details.php?delete=<?php echo $row['id']?>" onclick="return del();" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <?php $sn++; } ?>
                                        </tbody>
                                    </table>

                                    <!-- Pagination -->
                                    <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                                        <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
                                    </div>

                                    <ul class="pagination">
                                        <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
                                            <a <?php if($page_no > 1){ echo "href='?page_no=".($page_no - 1)."'"; } ?>>Previous</a>
                                        </li>
                                        <?php 
                                        if ($total_no_of_pages <= 10) {     
                                            for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                                echo ($counter == $page_no) ? "<li class='active'><a>$counter</a></li>" : "<li><a href='?page_no=$counter'>$counter</a></li>";
                                            }
                                        } elseif($total_no_of_pages > 10) {
                                            if($page_no <= 4) {     
                                                for ($counter = 1; $counter < 8; $counter++) {     
                                                    echo ($counter == $page_no) ? "<li class='active'><a>$counter</a></li>" : "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                }
                                                echo "<li><a>...</a></li>";
                                                echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                                echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                            } elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {     
                                                echo "<li><a href='?page_no=1'>1</a></li>";
                                                echo "<li><a href='?page_no=2'>2</a></li>";
                                                echo "<li><a>...</a></li>";
                                                for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {     
                                                    echo ($counter == $page_no) ? "<li class='active'><a>$counter</a></li>" : "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                }
                                                echo "<li><a>...</a></li>";
                                                echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                                echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
                                            } else {
                                                echo "<li><a href='?page_no=1'>1</a></li>";
                                                echo "<li><a href='?page_no=2'>2</a></li>";
                                                echo "<li><a>...</a></li>";
                                                for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                                    echo ($counter == $page_no) ? "<li class='active'><a>$counter</a></li>" : "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                }
                                            }
                                        }
                                        ?>
                                        <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
                                            <a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=".($page_no + 1)."'"; } ?>>Next</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2016-2017 <a href="#">Bollywood Product</a>.</strong> All rights reserved.
        </footer>
    </div>

    <!-- Scripts (Duplicate jQuery Removed) -->
    <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
    <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <script src="assets/dist/js/custom.js" type="text/javascript"></script>
    <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Fixed jQuery Code (No .live() Errors) -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();

        // Search keyup
        $(".search").keyup(function() { 
            var searchid = $(this).val();
            var dataString = 'search=' + encodeURIComponent(searchid);
            if(searchid != '') {
                $.ajax({
                    type: "POST",
                    url: "search_film_trailer.php",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $("#result").html(html).show();
                    }
                });
            } else {
                $("#result").fadeOut();
            }
            return false;    
        });

        // Fixed .live() -> converted to .on()
        $(document).on("click", "#result", function(e){ 
            var $clicked = $(e.target);
            var $name = $clicked.find('.name').html() || $clicked.html();
            var decoded = $("<div/>").html($name).text();
            $('#searchid').val(decoded);
        });

        $(document).on("click", function(e) { 
            if (!$(e.target).closest('#searchid, #result').length){
                $("#result").fadeOut(); 
            }
        });

        $('#searchid').click(function(){
            if($(this).val() != '') {
                $("#result").fadeIn();
            }
        });
    });
    </script>
</body>
</html>