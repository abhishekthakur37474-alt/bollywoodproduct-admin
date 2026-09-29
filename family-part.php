                                  <!--Father Block Start-->
                                        <div id="father" style="display: block;border: 1px solid black;padding: 14px;">

                                         <div id="fatherContainer">

    <div class="father-section card mb-3 p-3">

        <div class="d-flex justify-content-between">
            <h4>Father 1</h4>

            <button type="button" class="btn btn-danger btn-sm removeFather" style="display:none;">
                Remove
            </button>
        </div>

   

    <div class="form-group">

        <label>Father Name</label>
      
       <button type="button" class="btn btn-link p-0 toggleFatherDb">
    Select Data From Database
</button>&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="manualEntry">Enter Manually</a>
    
        <div class="father-db" style="display:none; margin-top:10px;">

            <select class="form-control professionSelect" name="father_name_choice_profesion[]">
                <option value="">- Select Profession -</option>

                <?php
                $choice = mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");
                while($row = mysqli_fetch_array($choice)){
                ?>
                    <option value="<?php echo $row['table_name']; ?>">
                        <?php echo $row['profession_name']; ?>
                <?php } ?>
            </select>

            <br>

            <select class="form-control fatherSelect" name="father[]" style="display:none;"></select>

        </div>

        <input type="text"
               name="father[]"
               class="form-control fatherTextbox"
               placeholder="Enter Father">

    </div>



        <!-- Father / Step Father -->
        <div class="form-group">

            <label>Relation</label>

            <select name="real_step_father[]" class="form-control">
                <option value="Father">Father</option>
                <option value="Step Father">Step Father</option>
            </select>

        </div>

        <!-- DOB -->
        <label>Date of Birth</label>
        <div class="row">

            <div class="col-md-4">
                <input type="text" name="fatherDOB_date[]" class="form-control" placeholder="Date">
            </div>

            <div class="col-md-4">
                <input type="text" name="fatherDOB_month[]" class="form-control" placeholder="Month">
            </div>

            <div class="col-md-4">
                <input type="text" name="fatherDOB_year[]" class="form-control" placeholder="Year">
            </div>

        </div>

        <br>

        <!-- DOD -->
        <label>Date of Death</label>
        <div class="row">

            <div class="col-md-4">
                <input type="text" name="fatherDOD_date[]" class="form-control" placeholder="Date">
            </div>

            <div class="col-md-4">
                <input type="text" name="fatherDOD_month[]" class="form-control" placeholder="Month">
            </div>

            <div class="col-md-4">
                <input type="text" name="fatherDOD_year[]" class="form-control" placeholder="Year">
            </div>

        </div>

    </div>

</div>

<button type="button" class="btn btn-success mt-3" id="addFather">
    + Add Father
</button>


                                        </div>
<script>
$(function () {

    var count = 1;

    $("#addFather").click(function () {

        count++;

        var clone = $(".father-section:first").clone();

        clone.find("input").val("");

        clone.find("select").prop("selectedIndex", 0);

        clone.find("h4").text("Father " + count);

        clone.find(".removeFather").show();

        $("#fatherContainer").append(clone);

    });

    $(document).on("click", ".removeFather", function () {

        $(this).closest(".father-section").remove();

        $(".father-section").each(function (index) {

            $(this).find("h4").text("Father " + (index + 1));

        });

        count = $(".father-section").length;

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

</script>
                                 <!--Father Block End-->
                                        <br>


<!--Mother Section Start-->

<!-- ================= Mother Block Start ================= -->

<div id="mother" style="display:block;border:1px solid black;padding:14px;">

    <div id="motherContainer">

        <div class="mother-section card mb-3 p-3">

            <div class="d-flex justify-content-between">
                <h4>Mother 1</h4>

                <button type="button" class="btn btn-danger btn-sm removeMother" style="display:none;">
                    Remove
                </button>
            </div>

            <!-- Mother Name -->
            <div class="form-group">

                <label>Mother Name</label>

                <button type="button" class="btn btn-link p-0 toggleMotherDb">
                    Select Data From Database
                </button>

                &nbsp;&nbsp;&nbsp;&nbsp;

                <a href="#" class="manualMotherEntry">
                    Enter Manually
                </a>

                <div class="mother-db" style="display:none;margin-top:10px;">

                    <select class="form-control professionSelectMother"
                        name="mother_name_choice_profesion[]">

                        <option value="">- Select Profession -</option>

                        <?php
                        $choice = mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");
                        while($row=mysqli_fetch_array($choice)){
                        ?>

                        <option value="<?php echo $row['table_name']; ?>">
                            <?php echo $row['profession_name']; ?>
                        </option>

                        <?php } ?>

                    </select>

                    <br>

                    <select class="form-control motherSelect"
                        name="mother[]"
                        style="display:none;"
                        >

                    </select>

                </div>

                <input
                    type="text"
                    name="mother[]"
                    class="form-control motherTextbox"
                    placeholder="Enter Mother">

            </div>

            <!-- Relation -->

            <div class="form-group">

                <label>Mother/Step Mother</label>

                <select
                    name="real_step_mother[]"
                    class="form-control">

                    <option value="Mother">
                        Mother
                    </option>

                    <option value="Step Mother">
                        Step Mother
                    </option>

                </select>

            </div>

            <!-- Date Of Birth -->

            <label>Date of Birth</label>

            <div class="row">

                <div class="col-md-4">

                    <input
                        type="text"
                        name="motherDOB_date[]"
                        class="form-control"
                        placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input
                        type="text"
                        name="motherDOB_month[]"
                        class="form-control"
                        placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input
                        type="text"
                        name="motherDOB_year[]"
                        class="form-control"
                        placeholder="Year">

                </div>

            </div>

            <br>

            <!-- Date Of Death -->

            <label>Date of Death</label>

            <div class="row">

                <div class="col-md-4">

                    <input
                        type="text"
                        name="motherDOD_date[]"
                        class="form-control"
                        placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input
                        type="text"
                        name="motherDOD_month[]"
                        class="form-control"
                        placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input
                        type="text"
                        name="motherDOD_year[]"
                        class="form-control"
                        placeholder="Year">

                </div>

            </div>

        </div>

    </div>

    <button
        type="button"
        class="btn btn-success mt-3"
        id="addMother">

        + Add Mother

    </button>

</div>

<script>
$(function () {

    var motherCount = 1;

    $("#addMother").click(function () {

        motherCount++;

        var clone = $(".mother-section:first").clone();

        // Clear inputs
        clone.find("input").val("");

        // Reset selects
        clone.find("select").prop("selectedIndex", 0);

        // Reset heading
        clone.find("h4").text("Mother " + motherCount);

        // Show Remove button
        clone.find(".removeMother").show();

        // Reset textbox/dropdown state
        clone.find(".motherTextbox")
            .show()
            .prop("disabled", false);

        clone.find(".mother-db").hide();

        clone.find(".motherSelect")
            .hide()
            .html("")
            .prop("disabled", true);

        clone.find(".professionSelectMother").val("");

        $("#motherContainer").append(clone);

    });

});


/* Remove Mother */

$(document).on("click", ".removeMother", function () {

    $(this).closest(".mother-section").remove();

    $(".mother-section").each(function (index) {

        $(this).find("h4").text("Mother " + (index + 1));

    });

    motherCount = $(".mother-section").length;

});


/* Open Database Panel */

$(document).on("click", ".toggleMotherDb", function (e) {

    e.preventDefault();
    e.stopPropagation();

    var section = $(this).closest(".mother-section");

    section.find(".mother-db")
        .stop(true, true)
        .slideToggle();

    return false;

});


/* Profession Change */

$(document).on("change", ".professionSelectMother", function () {

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


/* Database Name Selected */

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


/* Enter Manually */

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

    section.find(".professionSelectMother").val("");

    section.find(".mother-db").hide();

});
</script>
<!-- ================= Mother Block End ================= -->
                                     
<!--Mother Section End-->

                                        <br />
<!--Spouse Section Start-->
<!-- ================= Spouse Block Start ================= -->

<div id="Spouse" style="display:block;border:1px solid black;padding:14px;">

    <div id="spouseContainer">

        <div class="spouse-section card mb-3 p-3">

            <div class="d-flex justify-content-between">

                <h4>Spouse 1</h4>

                <button type="button"
                        class="btn btn-danger btn-sm removeSpouse"
                        style="display:none;">
                    Remove
                </button>

            </div>

            <!-- Spouse / Partner -->

            <div class="form-group">

                <input type="hidden"
                       class="spousePartnerHidden"
                       name="Spouse_Partner[]"
                       value="Spouse">

                <h4>Spouse / Partner</h4>

                <label class="mr-3">

                    <input type="radio"
                           class="spousePartnerRadio"
                           name="spouse_partner1"
                           value="Spouse"
                           checked>

                    Spouse

                </label>

                <label>

                    <input type="radio"
                           class="spousePartnerRadio"
                           name="spouse_partner1"
                           value="Partner">

                    Partner

                </label>

            </div>

            <!-- Spouse Name -->

            <div class="form-group">

                <label>Spouse Name</label>

                <button type="button"
                        class="btn btn-link p-0 toggleSpouseDb">

                    Select Data From Database

                </button>

                &nbsp;&nbsp;&nbsp;&nbsp;

                <a href="#"
                   class="manualSpouseEntry">

                    Enter Manually

                </a>

                <div class="spouse-db"
                     style="display:none;margin-top:10px;">

                    <select class="form-control professionSelectSpouse"
                            name="spouse_name_choice_profesion[]">

                        <option value="">
                            - Select Profession -
                        </option>

                        <?php
                        $choice = mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");

                        while($row=mysqli_fetch_array($choice)){
                        ?>

                            <option value="<?php echo $row['table_name']; ?>">

                                <?php echo $row['profession_name']; ?>

                            </option>

                        <?php } ?>

                    </select>

                    <br>

                    <select class="form-control spouseSelect"
                            name="spouse[]"
                            style="display:none;"
                            disabled>

                    </select>

                </div>

                <input type="text"
                       name="spouse[]"
                       class="form-control spouseTextbox"
                       placeholder="Enter Spouse">

            </div>

            <!-- Marriage Date -->

            <label>Marriage Date</label>

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="marriage_date[]"
                           class="form-control"
                           placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="marriage_month[]"
                           class="form-control"
                           placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="marriage_year[]"
                           class="form-control"
                           placeholder="Year">

                </div>

            </div>

            <br>
                        <!-- Separation Date -->

            <label>Separation Date</label>

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="separation_date[]"
                           class="form-control"
                           placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="separation_month[]"
                           class="form-control"
                           placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="separation_year[]"
                           class="form-control"
                           placeholder="Year">

                </div>

            </div>

            <br>

            <!-- Divorce Date -->

            <label>Divorce Date</label>

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="divorce_date[]"
                           class="form-control"
                           placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="divorce_month[]"
                           class="form-control"
                           placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="divorce_year[]"
                           class="form-control"
                           placeholder="Year">

                </div>

            </div>

            <br>

            <!-- Date Of Death -->

            <label>Date Of Death</label>

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="spouseDOD_date[]"
                           class="form-control"
                           placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="spouseDOD_month[]"
                           class="form-control"
                           placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="spouseDOD_year[]"
                           class="form-control"
                           placeholder="Year">

                </div>

            </div>

            <br>

            <!-- Children -->

            <h4>No. Of Children</h4>

            <div class="form-group">

                <label>Son</label>

                <input type="text"
                       class="form-control"
                       name="total_son[]"
                       placeholder="No of Son">

            </div>

            <div class="form-group">

                <label>Daughter</label>

                <input type="text"
                       class="form-control"
                       name="total_Daughter[]"
                       placeholder="No of Daughter">

            </div>

            <div class="form-group">

                <label>Spouse/Partner Total No. Of Children</label>

                <input type="text"
                       class="form-control"
                       name="spouse_total_children[]"
                       placeholder="No of Total Children">

            </div>

        </div>

    </div>

    <button type="button"
            class="btn btn-success mt-3"
            id="addSpouse">

        + Add Spouse

    </button>

</div>
<script>
    /* ==========================================
   Spouse Block
========================================== */

var spouseCount = 1;

$(function () {

    $("#addSpouse").click(function () {

        spouseCount++;

        var clone = $(".spouse-section:first").clone();

        /* Clear Inputs */
        clone.find("input[type='text']").val("");

        clone.find("select").prop("selectedIndex", 0);

        /* Reset Heading */
        clone.find("h4:first").text("Spouse " + spouseCount);

        /* Show Remove Button */
        clone.find(".removeSpouse").show();

        /* Reset Database Controls */
        clone.find(".spouseTextbox")
            .show()
            .prop("disabled", false);

        clone.find(".spouse-db").hide();

        clone.find(".spouseSelect")
            .hide()
            .html("")
            .prop("disabled", true);

        clone.find(".professionSelectSpouse").val("");

        /* Reset Hidden Field */
        clone.find(".spousePartnerHidden").val("Spouse");

        /* Reset Radio Buttons */
        clone.find(".spousePartnerRadio").prop("checked", false);

        clone.find(".spousePartnerRadio[value='Spouse']")
            .prop("checked", true);

        /* Give Radio Buttons Unique Name */

        clone.find(".spousePartnerRadio").each(function () {

            $(this).attr("name", "spouse_partner" + spouseCount);

        });

        $("#spouseContainer").append(clone);

    });

});


/* ==========================================
   Remove Spouse
========================================== */

$(document).on("click", ".removeSpouse", function () {

    $(this).closest(".spouse-section").remove();

    $(".spouse-section").each(function (index) {

        $(this).find("h4:first").text("Spouse " + (index + 1));

    });

    spouseCount = $(".spouse-section").length;

});


/* ==========================================
   Show Database Section
========================================== */

$(document).on("click", ".toggleSpouseDb", function (e) {

    e.preventDefault();

    e.stopPropagation();

    var section = $(this).closest(".spouse-section");

    section.find(".spouse-db")
        .stop(true, true)
        .slideToggle();

});


/* ==========================================
   Profession Changed
========================================== */

$(document).on("change", ".professionSelectSpouse", function () {

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
                .show()
                .prop("disabled", false);
        }

    });

});


/* ==========================================
   Database Name Selected
========================================== */

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


/* ==========================================
   Manual Entry
========================================== */

$(document).on("click", ".manualSpouseEntry", function (e) {

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

    section.find(".professionSelectSpouse").val("");

    section.find(".spouse-db").hide();

});


/* ==========================================
   Spouse / Partner Radio
========================================== */

$(document).on("change", ".spousePartnerRadio", function () {

    var section = $(this).closest(".spouse-section");

    section.find(".spousePartnerHidden").val($(this).val());

});
</script>
<!-- ================= Spouse Block End ================= -->
<!--Spouse Section End-->

                                        <br />

<!--Son Section Start-->
<!-- ================= Son Block Start ================= -->

<div id="son" style="display:block;border:1px solid black;padding:14px;">

    <div id="sonContainer">

        <div class="son-section card mb-3 p-3">

            <div class="d-flex justify-content-between">

                <h4>Son 1</h4>

                <button type="button"
                        class="btn btn-danger btn-sm removeSon"
                        style="display:none;">
                    Remove
                </button>

            </div>

            <!-- Son Name -->

            <div class="form-group">

                <label>Son Name</label>

                <button type="button"
                        class="btn btn-link p-0 toggleSonDb">
                    Select Data From Database
                </button>

                &nbsp;&nbsp;&nbsp;&nbsp;

                <a href="#" class="manualSonEntry">
                    Enter Manually
                </a>

                <div class="son-db"
                     style="display:none;margin-top:10px;">

                    <select class="form-control professionSelectSon"
                            name="son_name_choice_profesion[]">

                        <option value="">- Select Profession -</option>

                        <?php
                        $choice = mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");
                        while($row=mysqli_fetch_array($choice)){
                        ?>

                            <option value="<?php echo $row['table_name']; ?>">
                                <?php echo $row['profession_name']; ?>
                            </option>

                        <?php } ?>

                    </select>

                    <br>

                    <select class="form-control sonSelect"
                            name="son[]"
                            style="display:none;"
                            disabled>

                    </select>

                </div>

                <input type="text"
                       name="son[]"
                       class="form-control sonTextbox"
                       placeholder="Enter Son">

            </div>

            <!-- Son Of -->

            <div class="form-group">

                <input type="hidden"
                       class="sonParentHidden"
                       name="son_mother_father[]"
                       value="Father">

                <h4>Son Of :</h4>

                <label class="mr-3">

                    <input type="radio"
                           class="sonParentRadio"
                           name="son_parent0"
                           value="Father"
                           checked>

                    Father

                </label>

                <label>

                    <input type="radio"
                           class="sonParentRadio"
                           name="son_parent0"
                           value="Mother">

                    Mother

                </label>

                <br><br>

                <input type="text"
                       class="form-control"
                       name="son_relation[]"
                       placeholder="Enter Mother/Father Name">

            </div>

            <!-- Date Of Birth -->

            <label>Date Of Birth</label>

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="sonDOB_date[]"
                           class="form-control"
                           placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="sonDOB_month[]"
                           class="form-control"
                           placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="sonDOB_year[]"
                           class="form-control"
                           placeholder="Year">

                </div>

            </div>

            <br>
                        <!-- Date Of Death -->

            <label>Date Of Death</label>

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="sonDOD_date[]"
                           class="form-control"
                           placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="sonDOD_month[]"
                           class="form-control"
                           placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="sonDOD_year[]"
                           class="form-control"
                           placeholder="Year">

                </div>

            </div>

        </div>

    </div>

    <button type="button"
            class="btn btn-success mt-3"
            id="addSon">

        + Add Son

    </button>

</div>

<script>
var sonCount = 1;

$(function () {

    $("#addSon").click(function () {

        sonCount++;

        var clone = $(".son-section:first").clone();

        /* Clear Textboxes */
        clone.find("input[type='text']").val("");

        /* Reset Selects */
        clone.find("select").prop("selectedIndex", 0);

        /* Heading */
        clone.find("h4:first").text("Son " + sonCount);

        /* Show Remove Button */
        clone.find(".removeSon").show();

        /* Reset Manual/Database */
        clone.find(".sonTextbox")
            .show()
            .prop("disabled", false);

        clone.find(".son-db").hide();

        clone.find(".sonSelect")
            .hide()
            .html("")
            .prop("disabled", true);

        clone.find(".professionSelectSon").val("");

        /* Reset Hidden Field */
        clone.find(".sonParentHidden").val("Father");

        /* Reset Radio Buttons */
        clone.find(".sonParentRadio").prop("checked", false);

        clone.find(".sonParentRadio[value='Father']")
            .prop("checked", true);

        /* Unique Radio Group */
        clone.find(".sonParentRadio").each(function () {

            $(this).attr("name", "son_parent" + sonCount);

        });

        $("#sonContainer").append(clone);

    });

});


/* ==========================================
   Remove Son
========================================== */

$(document).on("click", ".removeSon", function () {

    $(this).closest(".son-section").remove();

    $(".son-section").each(function (index) {

        $(this).find("h4:first").text("Son " + (index + 1));

    });

    sonCount = $(".son-section").length;

});


/* ==========================================
   Show Database
========================================== */

$(document).on("click", ".toggleSonDb", function (e) {

    e.preventDefault();
    e.stopPropagation();

    var section = $(this).closest(".son-section");

    section.find(".son-db")
        .stop(true, true)
        .slideToggle();

});


/* ==========================================
   Profession Changed
========================================== */

$(document).on("change", ".professionSelectSon", function () {

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
                .show()
                .prop("disabled", false);

        }

    });

});


/* ==========================================
   Database Name Selected
========================================== */

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


/* ==========================================
   Enter Manually
========================================== */

$(document).on("click", ".manualSonEntry", function (e) {

    e.preventDefault();

    var section = $(this).closest(".son-section");

    section.find(".sonTextbox")
        .show()
        .prop("disabled", false)
        .val("");

    section.find(".sonSelect")
        .hide()
        .prop("disabled", true)
        .html("");

    section.find(".professionSelectSon").val("");

    section.find(".son-db").hide();

});


/* ==========================================
   Father / Mother Selection
========================================== */

$(document).on("change", ".sonParentRadio", function () {

    var section = $(this).closest(".son-section");

    section.find(".sonParentHidden").val($(this).val());

});
</script>

<!-- ================= Son Block End ================= -->
<!--Son Section End-->



                                        <br />

                                  
<!--Daughter Data Start-->
<!-- ================= Daughter Block Start ================= -->

<div id="daughter" style="display:block;border:1px solid black;padding:14px;">

    <div id="daughterContainer">

        <div class="daughter-section card mb-3 p-3">

            <div class="d-flex justify-content-between">

                <h4>Daughter 1</h4>

                <button type="button"
                        class="btn btn-danger btn-sm removeDaughter"
                        style="display:none;">
                    Remove
                </button>

            </div>

            <!-- Daughter Name -->

            <div class="form-group">

                <label>Daughter Name</label>

                <button type="button"
                        class="btn btn-link p-0 toggleDaughterDb">
                    Select Data From Database
                </button>

                &nbsp;&nbsp;&nbsp;&nbsp;

                <a href="#" class="manualDaughterEntry">
                    Enter Manually
                </a>

                <div class="daughter-db"
                     style="display:none;margin-top:10px;">

                    <select class="form-control professionSelectDaughter"
                            name="daughter_name_choice_profesion[]">

                        <option value="">- Select Profession -</option>

                        <?php
                        $choice = mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");
                        while($row=mysqli_fetch_array($choice)){
                        ?>

                            <option value="<?php echo $row['table_name']; ?>">
                                <?php echo $row['profession_name']; ?>
                            </option>

                        <?php } ?>

                    </select>

                    <br>

                    <select class="form-control daughterSelect"
                            name="daughter[]"
                            style="display:none;"
                            disabled>

                    </select>

                </div>

                <input type="text"
                       name="daughter[]"
                       class="form-control daughterTextbox"
                       placeholder="Enter Daughter">

            </div>

            <!-- Daughter Of -->

            <div class="form-group">

                <input type="hidden"
                       class="daughterParentHidden"
                       name="daughter_mother_father[]"
                       value="Father">

                <h4>Daughter Of :</h4>

                <label class="mr-3">

                    <input type="radio"
                           class="daughterParentRadio"
                           name="daughter_parent0"
                           value="Father"
                           checked>

                    Father

                </label>

                <label>

                    <input type="radio"
                           class="daughterParentRadio"
                           name="daughter_parent0"
                           value="Mother">

                    Mother

                </label>

                <br><br>

                <input type="text"
                       class="form-control"
                       name="daughter_relation[]"
                       placeholder="Enter Mother/Father Name">

            </div>

            <!-- Date Of Birth -->

            <label>Date Of Birth</label>

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="daughterDOB_date[]"
                           class="form-control"
                           placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="daughterDOB_month[]"
                           class="form-control"
                           placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="daughterDOB_year[]"
                           class="form-control"
                           placeholder="Year">

                </div>

            </div>

            <br>
                        <!-- Date Of Death -->

            <label>Date Of Death</label>

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="daughterDOD_date[]"
                           class="form-control"
                           placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="daughterDOD_month[]"
                           class="form-control"
                           placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="daughterDOD_year[]"
                           class="form-control"
                           placeholder="Year">

                </div>

            </div>

        </div>

    </div>

    <button type="button"
            class="btn btn-success mt-3"
            id="addDaughter">

        + Add Daughter

    </button>

</div>
<script>
    /* ==========================================
   Daughter Block
========================================== */

var daughterCount = 1;

$(function () {

    $("#addDaughter").click(function () {

        daughterCount++;

        var clone = $(".daughter-section:first").clone();

        /* Clear Textboxes */
        clone.find("input[type='text']").val("");

        /* Reset Selects */
        clone.find("select").prop("selectedIndex", 0);

        /* Heading */
        clone.find("h4:first").text("Daughter " + daughterCount);

        /* Show Remove Button */
        clone.find(".removeDaughter").show();

        /* Reset Manual/Database */
        clone.find(".daughterTextbox")
            .show()
            .prop("disabled", false);

        clone.find(".daughter-db").hide();

        clone.find(".daughterSelect")
            .hide()
            .html("")
            .prop("disabled", true);

        clone.find(".professionSelectDaughter").val("");

        /* Reset Hidden Field */
        clone.find(".daughterParentHidden").val("Father");

        /* Reset Radio Buttons */
        clone.find(".daughterParentRadio").prop("checked", false);

        clone.find(".daughterParentRadio[value='Father']")
            .prop("checked", true);

        /* Give Radio Buttons Unique Name */
        clone.find(".daughterParentRadio").each(function () {

            $(this).attr("name", "daughter_parent" + daughterCount);

        });

        $("#daughterContainer").append(clone);

    });

});


/* ==========================================
   Remove Daughter
========================================== */

$(document).on("click", ".removeDaughter", function () {

    $(this).closest(".daughter-section").remove();

    $(".daughter-section").each(function (index) {

        $(this).find("h4:first").text("Daughter " + (index + 1));

    });

    daughterCount = $(".daughter-section").length;

});


/* ==========================================
   Show Database Section
========================================== */

$(document).on("click", ".toggleDaughterDb", function (e) {

    e.preventDefault();
    e.stopPropagation();

    var section = $(this).closest(".daughter-section");

    section.find(".daughter-db")
        .stop(true, true)
        .slideToggle();

});


/* ==========================================
   Profession Changed
========================================== */

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
                .show()
                 .prop("disabled", false)

        }

    });

});


/* ==========================================
   Database Name Selected
========================================== */

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


/* ==========================================
   Enter Manually
========================================== */

$(document).on("click", ".manualDaughterEntry", function (e) {

    e.preventDefault();

    var section = $(this).closest(".daughter-section");

    section.find(".daughterTextbox")
        .show()
        .prop("disabled", false)
        .val("");

    section.find(".daughterSelect")
        .hide()
        .prop("disabled", true)
        .html("");

    section.find(".professionSelectDaughter").val("");

    section.find(".daughter-db").hide();

});


/* ==========================================
   Father / Mother Selection
========================================== */

$(document).on("change", ".daughterParentRadio", function () {

    var section = $(this).closest(".daughter-section");

    section.find(".daughterParentHidden").val($(this).val());

});
</script>

<!-- ================= Daughter Block End ================= -->
<!--Daughter Data End-->

                                        </div>

                                        <br />

                                   

<!--Brother Data Start-->
<!-- ================= Brother Block Start ================= -->

<div id="brother" style="display:block;border:1px solid black;padding:14px;">

    <div id="brotherContainer">

        <div class="brother-section card mb-3 p-3">

            <div class="d-flex justify-content-between">

                <h4>Brother 1</h4>

                <button type="button"
                        class="btn btn-danger btn-sm removeBrother"
                        style="display:none;">
                    Remove
                </button>

            </div>

            <!-- Brother Name -->

            <div class="form-group">

                <label>Brother Name</label>

                <button type="button"
                        class="btn btn-link p-0 toggleBrotherDb">
                    Select Data From Database
                </button>

                &nbsp;&nbsp;&nbsp;&nbsp;

                <a href="#" class="manualBrotherEntry">
                    Enter Manually
                </a>

                <div class="brother-db"
                     style="display:none;margin-top:10px;">

                    <select class="form-control professionSelectBrother"
                            name="brother_name_choice_profesion[]">

                        <option value="">- Select Profession -</option>

                        <?php
                        $choice = mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");
                        while($row=mysqli_fetch_array($choice)){
                        ?>

                            <option value="<?php echo $row['table_name']; ?>">
                                <?php echo $row['profession_name']; ?>
                            </option>

                        <?php } ?>

                    </select>

                    <br>

                    <select class="form-control brotherSelect"
                            name="brother[]"
                            style="display:none;"
                            disabled>

                    </select>

                </div>

                <input type="text"
                       name="brother[]"
                       class="form-control brotherTextbox"
                       placeholder="Enter Brother">

            </div>

            <!-- Brother Of -->

            <div class="form-group">

                <input type="hidden"
                       class="brotherParentHidden"
                       name="brother_mother_father[]"
                       value="Father">

                <h4>Brother Of :</h4>

                <label class="mr-3">

                    <input type="radio"
                           class="brotherParentRadio"
                           name="brother_parent0"
                           value="Father"
                           checked>

                    Father

                </label>

                <label>

                    <input type="radio"
                           class="brotherParentRadio"
                           name="brother_parent0"
                           value="Mother">

                    Mother

                </label>

                <br><br>

                <input type="text"
                       class="form-control"
                       name="brother_relation[]"
                       placeholder="Enter Mother/Father Name">

            </div>

            <!-- Date Of Birth -->

            <label>Date Of Birth</label>

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="brotherDOB_date[]"
                           class="form-control"
                           placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="brotherDOB_month[]"
                           class="form-control"
                           placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="brotherDOB_year[]"
                           class="form-control"
                           placeholder="Year">

                </div>

            </div>

            <br>
                        <!-- Date Of Death -->

            <label>Date Of Death</label>

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="brotherDOD_date[]"
                           class="form-control"
                           placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="brotherDOD_month[]"
                           class="form-control"
                           placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="brotherDOD_year[]"
                           class="form-control"
                           placeholder="Year">

                </div>

            </div>

        </div>

    </div>

    <button type="button"
            class="btn btn-success mt-3"
            id="addBrother">

        + Add Brother

    </button>

</div>
<script>
    /* ==========================================
   Brother Block
========================================== */

var brotherCount = 1;

$(function () {

    $("#addBrother").click(function () {

        brotherCount++;

        var clone = $(".brother-section:first").clone();

        /* Clear Textboxes */
        clone.find("input[type='text']").val("");

        /* Reset Selects */
        clone.find("select").prop("selectedIndex", 0);

        /* Heading */
        clone.find("h4:first").text("Brother " + brotherCount);

        /* Show Remove Button */
        clone.find(".removeBrother").show();

        /* Reset Manual/Database */
        clone.find(".brotherTextbox")
            .show()
            .prop("disabled", false);

        clone.find(".brother-db").hide();

        clone.find(".brotherSelect")
            .hide()
            .html("")
            .prop("disabled", true);

        clone.find(".professionSelectBrother").val("");

        /* Reset Hidden Field */
        clone.find(".brotherParentHidden").val("Father");

        /* Reset Radio Buttons */
        clone.find(".brotherParentRadio").prop("checked", false);

        clone.find(".brotherParentRadio[value='Father']")
            .prop("checked", true);

        /* Unique Radio Group */
        clone.find(".brotherParentRadio").each(function () {

            $(this).attr("name", "brother_parent" + brotherCount);

        });

        $("#brotherContainer").append(clone);

    });

});


/* ==========================================
   Remove Brother
========================================== */

$(document).on("click", ".removeBrother", function () {

    $(this).closest(".brother-section").remove();

    $(".brother-section").each(function (index) {

        $(this).find("h4:first").text("Brother " + (index + 1));

    });

    brotherCount = $(".brother-section").length;

});


/* ==========================================
   Show Database Section
========================================== */

$(document).on("click", ".toggleBrotherDb", function (e) {

    e.preventDefault();
    e.stopPropagation();

    var section = $(this).closest(".brother-section");

    section.find(".brother-db")
        .stop(true, true)
        .slideToggle();

});


/* ==========================================
   Profession Changed
========================================== */

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
                .show()
                .prop("disabled", false);

        }

    });

});


/* ==========================================
   Database Name Selected
========================================== */

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


/* ==========================================
   Enter Manually
========================================== */

$(document).on("click", ".manualBrotherEntry", function (e) {

    e.preventDefault();

    var section = $(this).closest(".brother-section");

    section.find(".brotherTextbox")
        .show()
        .prop("disabled", false)
        .val("");

    section.find(".brotherSelect")
        .hide()
        .prop("disabled", true)
        .html("");

    section.find(".professionSelectBrother").val("");

    section.find(".brother-db").hide();

});


/* ==========================================
   Father / Mother Selection
========================================== */

$(document).on("change", ".brotherParentRadio", function () {

    var section = $(this).closest(".brother-section");

    section.find(".brotherParentHidden").val($(this).val());

});
</script>
<!-- ================= Brother Block End ================= -->
<!--Brother Data End-->

                                             

<!--Sister Data Start-->
<!-- ================= Sister Block Start ================= -->

<div id="sister" style="display:block;border:1px solid black;padding:14px;">

    <div id="sisterContainer">

        <div class="sister-section card mb-3 p-3">

            <div class="d-flex justify-content-between">

                <h4>Sister 1</h4>

                <button type="button"
                        class="btn btn-danger btn-sm removeSister"
                        style="display:none;">
                    Remove
                </button>

            </div>

            <!-- Sister Name -->

            <div class="form-group">

                <label>Sister Name</label>

                <button type="button"
                        class="btn btn-link p-0 toggleSisterDb">
                    Select Data From Database
                </button>

                &nbsp;&nbsp;&nbsp;&nbsp;

                <a href="#" class="manualSisterEntry">
                    Enter Manually
                </a>

                <div class="sister-db"
                     style="display:none;margin-top:10px;">

                    <select class="form-control professionSelectSister"
                            name="sister_name_choice_profesion[]">

                        <option value="">- Select Profession -</option>

                        <?php
                        $choice = mysqli_query($con,"SELECT * FROM profession ORDER BY profession_name");
                        while($row=mysqli_fetch_array($choice)){
                        ?>

                            <option value="<?php echo $row['table_name']; ?>">
                                <?php echo $row['profession_name']; ?>
                            </option>

                        <?php } ?>

                    </select>

                    <br>

                    <select class="form-control sisterSelect"
                            name="sister[]"
                            style="display:none;"
                            disabled>

                    </select>

                </div>

                <input type="text"
                       name="sister[]"
                       class="form-control sisterTextbox"
                       placeholder="Enter Sister">

            </div>

            <!-- Sister Of -->

            <div class="form-group">

                <input type="hidden"
                       class="sisterParentHidden"
                       name="sister_mother_father[]"
                       value="Father">

                <h4>Sister Of :</h4>

                <label class="mr-3">

                    <input type="radio"
                           class="sisterParentRadio"
                           name="sister_parent0"
                           value="Father"
                           checked>

                    Father

                </label>

                <label>

                    <input type="radio"
                           class="sisterParentRadio"
                           name="sister_parent0"
                           value="Mother">

                    Mother

                </label>

                <br><br>

                <input type="text"
                       class="form-control"
                       name="sister_relation[]"
                       placeholder="Enter Mother/Father Name">

            </div>

            <!-- Date Of Birth -->

            <label>Date Of Birth</label>

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="sisterDOB_date[]"
                           class="form-control"
                           placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="sisterDOB_month[]"
                           class="form-control"
                           placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="sisterDOB_year[]"
                           class="form-control"
                           placeholder="Year">

                </div>

            </div>

            <br>
                        <!-- Date Of Death -->

            <label>Date Of Death</label>

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="sisterDOD_date[]"
                           class="form-control"
                           placeholder="Date">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="sisterDOD_month[]"
                           class="form-control"
                           placeholder="Month">

                </div>

                <div class="col-md-4">

                    <input type="text"
                           name="sisterDOD_year[]"
                           class="form-control"
                           placeholder="Year">

                </div>

            </div>

        </div>

    </div>

    <button type="button"
            class="btn btn-success mt-3"
            id="addSister">

        + Add Sister

    </button>

</div>
<script>
    /* ==========================================
   Sister Block
========================================== */

var sisterCount = 1;

$(function () {

    $("#addSister").click(function () {

        sisterCount++;

        var clone = $(".sister-section:first").clone();

        /* Clear Textboxes */
        clone.find("input[type='text']").val("");

        /* Reset Selects */
        clone.find("select").prop("selectedIndex", 0);

        /* Heading */
        clone.find("h4:first").text("Sister " + sisterCount);

        /* Show Remove Button */
        clone.find(".removeSister").show();

        /* Reset Manual/Database */
        clone.find(".sisterTextbox")
            .show()
            .prop("disabled", false);

        clone.find(".sister-db").hide();

        clone.find(".sisterSelect")
            .hide()
            .html("")
            .prop("disabled", true);

        clone.find(".professionSelectSister").val("");

        /* Reset Hidden Field */
        clone.find(".sisterParentHidden").val("Father");

        /* Reset Radio Buttons */
        clone.find(".sisterParentRadio").prop("checked", false);

        clone.find(".sisterParentRadio[value='Father']")
            .prop("checked", true);

        /* Unique Radio Group */
        clone.find(".sisterParentRadio").each(function () {

            $(this).attr("name", "sister_parent" + sisterCount);

        });

        $("#sisterContainer").append(clone);

    });

});


/* ==========================================
   Remove Sister
========================================== */

$(document).on("click", ".removeSister", function () {

    $(this).closest(".sister-section").remove();

    $(".sister-section").each(function (index) {

        $(this).find("h4:first").text("Sister " + (index + 1));

    });

    sisterCount = $(".sister-section").length;

});


/* ==========================================
   Show Database Section
========================================== */

$(document).on("click", ".toggleSisterDb", function (e) {

    e.preventDefault();
    e.stopPropagation();

    var section = $(this).closest(".sister-section");

    section.find(".sister-db")
        .stop(true, true)
        .slideToggle();

});


/* ==========================================
   Profession Changed
========================================== */

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
                .show()
                .prop("disabled", false);

        }

    });

});


/* ==========================================
   Database Name Selected
========================================== */

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


/* ==========================================
   Enter Manually
========================================== */

$(document).on("click", ".manualSisterEntry", function (e) {

    e.preventDefault();

    var section = $(this).closest(".sister-section");

    section.find(".sisterTextbox")
        .show()
        .prop("disabled", false)
        .val("");

    section.find(".sisterSelect")
        .hide()
        .prop("disabled", true)
        .html("");

    section.find(".professionSelectSister").val("");

    section.find(".sister-db").hide();

});


/* ==========================================
   Father / Mother Selection
========================================== */

$(document).on("change", ".sisterParentRadio", function () {

    var section = $(this).closest(".sister-section");

    section.find(".sisterParentHidden").val($(this).val());

});
</script>
<!-- ================= Sister Block End ================= -->
<!--Sister Data End-->








