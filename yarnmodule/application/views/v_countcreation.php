<?php
include 'include/leftmenu.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Count Creation
        </h1><br><br>
        <div class="row">
            <div class="pull-right" style="padding-right:15px;">
                <a class="btn btn-app" onclick="retrivePopup()">
                    <i class="fa fa-align-justify"></i> Retrieve                  
                </a>
                <a class="btn btn-app" onclick="reloadForm()">
                    <i class="fa fa-adn"></i> New                  
                </a>
                <a id="EditAnchor" class="btn btn-app" onclick="ediForm('Null', 'Null', 'Null', 'editmenu')"> 
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a class="btn btn-app" onclick="resetForm()">
                    <i class="fa fa-repeat"></i> Reset
                </a>
                <a class="btn btn-app" disabled>
                    <i class="fa fa-print"></i> Print
                </a>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <!--                <div class="box-header">
                                </div> /.box-header -->
                <div class="box-body">
                    <!-- form start -->
                    <form id="CountCreationForm" name="CountCreationForm" role="form" method="post" action="<?= base_url() ?>index.php/countcreation/Add" class="">                       
                        <fieldset>
                            <legend>Count Information</legend>
                            <div id="FlashMessage">
                                <h5 style=""><?= $insertMessage ?></h5>
                                <h5 style=""><?= $updateMessage ?></h5>
                                <h5 style=""><?= $deleteMessage ?></h5>
                            </div>   
                            <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;display: none;">
                                <label for="">Count ID</label>
                                <input id="CountID" name="CountID" type="hidden" class="form-control" placeholder="">
                            </div>                        
                            <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                <label for="">Count Name</label>
                                <input id="CountName" name="CountName" type="text" class="form-control" placeholder="Count Name" required>
                            </div>                        
                            <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                <label for="">Count Type</label>
                                <input id="CountType" name="CountType" type="text" class="form-control" placeholder="Count Type" >
                            </div><br>
                            <div class="pull-right col-xs-6 col-sm-6 col-md-6" style="margin-top: 20px;">
                                <br><input id="SaveCountButton" type="submit" value="Save" class="btn btn-primary" style="float: right;">
                            </div>
                        </fieldset>
                    </form>
                </div><!-- /.box -->
            </div>
        </div><!-- /.box -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<script>
    $(document).ready(function() {
        formMode = "Add";
        $('#EditAnchor').attr("disabled", "disabled");
        $('#FlashMessage').fadeOut(5000);

        // On Pressing Enter, Preventing Default Functionality
        onPressEnter('#CountCreationForm');
        onPressEnter('#countCreationFormEdit');
    });

    function retrivePopup() {
        formMode = "Retrieve";
        $("#EditAnchor").removeAttr("disabled");
        var count = 1;

        bootbox.dialog({
            title: "List of Count(s)",
            message:
                    "<fieldset>" +
                    "<div class='box box-primary'>" +
                    "<div class='box-body'>" +
                    "<form name='countCreationFormEdit' role='' method='' action='' class=''>" +
                    "<br><div class='col-md-12'>" +
                    "<div class='pull-left col-md-2'>" +
                    "<label>Search</label>" +
                    "</div>" +
                    "<div class='pull-left col-md-4'>" +
                    "<input id='searchCount'name='searchCount'type='text'class='form-control' placeholder='Search by Count Name' onkeyup='search()' style='width:200px;margin-left:-30px;'>" +
                   // "<input id='SearchNow' type='button' value='OK' class='btn btn-primary' onclick='search()' style='width: 100px;margin-left: 175px;margin-top:-58px;'>" +
                    "</div>" +
                    "</div><br><br><br>" +
                    "<fieldset>" +
                    "<div class='box-body table-responsive'>" +
                    "<div class='box'>" +
                    "<table class='table table-bordered table-striped'>" +
                    "<thead>" +
                    "<tr>" +
                    "<th width='10%'>S No.</th>" +
                    "<th width='35%'>Count Name</th>" +
                    "<th width='30%'>Count Type</th>" +
                    "<th width='25%'>Details</th>" +
                    "</tr>" +
                    "</thead>" +
                    "<tbody id='CountTbody'>" +
                    <?php
                        foreach ($countList as $key) {
                    ?> 
                    "<tr>" +
                    "<td>" + count++ + "</td>" +
                    "<td><?= $key['CountName'] ?></td>" +
                    "<td><?= $key['CountType'] ?></td>" +
                    "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('<?= $key['Count_id'] ?>','<?= rawurlencode($key['CountName']) ?>','<?= rawurlencode($key['CountType']) ?>','None')>Edit</a>" +
                    "<span> | </span>" +
                    "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/countcreation/Delete/<?= $key['Count_id'] ?>'>Delete</a></td>" +
                    "</tr>"+<?php } ?>
                    "</tbody>" +
                    "<tfoot>" +
                    "<tr>" +
                    "<th></th>" +
                    "<th></th>" +
                    "<th></th>" +
                    "<th></th>" +
                    "</tr>" +
                    "<tfoot>" +
                    "</table>" +
                    "</fieldset>" +
                    "</div>" +
                    "</form>" +
                    "</div>" +
                    "</div>" +
                    "</fieldset>"
        });
        onPressEnter('#searchCount');
    }

    function reloadForm() {
        if (formMode === 'Edit') {
            bootbox.confirm("Do you want to reload the page press OK", function(result) {
                if (result) {
                    window.location.reload();
                }
            });
        } else {
            window.location.reload();
        }
    }

    function ediForm(idCount, countName, countType, type) {
        if (type === 'editmenu') {
            formMode = "Edit";
            var action = "<?php echo base_url() ?>index.php/countcreation/Update";
            enableElements("#CountName");
            enableElements("#CountType");
            enableElements("#SaveCountButton");
            document.getElementById("CountCreationForm").action = action;
        } else {                    
            $("#CountID").val(idCount);
            $("#CountName").val(unescape(countName));
            $("#CountType").val(decodeURI(countType));
            disableElements("#CountName");
            disableElements("#CountType");
            disableElements("#SaveCountButton");
        }
    }

    function resetForm() {
        if (formMode === 'Retrieve' || formMode === 'Edit') {
            return true;
        } else {
            emptyAllFields("#CountName");
            emptyAllFields("#CountType");
        }
    }
    function disableElements(elementArray) {
        $(elementArray).prop("disabled", true);
    }

    function enableElements(elementArray) {
        $(elementArray).prop("disabled", false);
    }

    function emptyAllFields(element) {
        $(element).val("");
    }

    function doToogle(id) {
        $(id).toggle();
    }

    function search() {
        var searchValue = $('#searchCount').val();
        var items = [];
        var count = 1;
        if (searchValue === "") {
            //bootbox.alert("Please enter value to search for", function(result) {});
                    <?php
                        foreach ($countList as $key) {
                    ?> 
           items += "<tr>" +
                    "<td>" + count++ + "</td>" +
                    "<td><?= $key['CountName'] ?></td>" +
                    "<td><?= $key['CountType'] ?></td>" +
                    "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('<?= $key['Count_id'] ?>','<?= rawurlencode($key['CountName']) ?>','<?= rawurlencode($key['CountType']) ?>','None')>Edit</a>" +
                    "<span> | </span>" +
                    "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/countcreation/Delete/<?= $key['Count_id'] ?>'>Delete</a></td>" +
                    "</tr>";<?php } ?>
            $("#CountTbody").html(items);
        } else
        {
            $.ajax({
                url: "<?= base_url() ?>index.php/countcreation/search",
                type: "POST",
                data: {search: searchValue},
                success: function(data) {
                    if (data !== "null")
                    {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            try {
                                var items = [];
                                var count = 1;
                                $.each(parsedData, function(i, val) {
                                    items += "<tr>" +
                                            "<td>" + count++ + "</td>" +
                                            "<td>" + val.CountName + "</td>" +
                                            "<td>" + val.CountType + "</td>" +
                                            "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('" + val.Count_id + "','" + encodeURI(val.CountName) + "','" + encodeURI(val.CountType) + "','None')>Edit</a>" +
                                            "<span> | </span>" +
                                            "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/countcreation/Delete/" + val.Count_id + "'>Delete</a></td>" +
                                            "</tr>";
                                });
                                $("#CountTbody").html(items);
                            } catch (e) {
                                console.log(e);
                            }
                        }
                        else {
                            $("#CountTbody").html("<tr><td></td><td></td><td>No Data Found</td><td></td></tr>");
                        }
                    }
                }
            });
        }
    }

    function onPressEnter(id) {
        $(id).bind("keypress", function(e) {
            if (e.keyCode == 13) {
                return false;
            }
        });
    }

</script>
