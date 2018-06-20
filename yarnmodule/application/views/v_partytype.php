<?php
include 'include/leftmenu.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Party Type
        </h1><br><br>
        <div class="row">
            <div class="pull-right" style="padding-right:15px;">
                <a class="btn btn-app" onclick="retrivePopup()">
                    <i class="fa fa-align-justify"></i> Retrieve                  
                </a>
                <a class="btn btn-app" onclick="reloadForm()">
                    <i class="fa fa-adn"></i> New                  
                </a>
                <a id="EditAnchor" class="btn btn-app" onclick="ediForm('Null', 'Null', 'editmenu')"> 
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
                    <form id="partyTypeForm" name="partyTypeForm" role="form" method="post" action="<?= base_url() ?>index.php/partytype/Add"> 
                        <fieldset>
                            <legend>Party Type</legend>
                            <div id="FlashMessage">
                                <h5 style=""><?= $insertMessage ?></h5>
                                <h5 style=""><?= $updateMessage ?></h5>
                                <h5 style=""><?= $deleteMessage ?></h5>
                            </div>                          
                            <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;display: none;">
                                <label for="">Party-Type ID</label>
                                <input id="PartyTypeID" name="PartyTypeID" type="hidden" class="form-control" placeholder="">
                            </div>    
                            <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                <label for="">Party Type</label>
                                <input id="PartyType" name="PartyType" type="text" step="" class="form-control" placeholder="Party Type" required>
                            </div><br>
                            <div class="pull-right col-xs-6 col-sm-6 col-md-6" style="margin-top: 20px;">
                                <br><button id="SavePartyTypeButton" type="submit" class="btn btn-primary" style="float: right;">Save</button>
                            </div>
                        </fieldset>
                    </form>
                </div><!-- /.box -->
            </div>
        </div><!-- /.box -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<script>
//
//    $(document).ready(function() {
//
////        $(form).bootstrapValidator({
////            fields: {
////                PartyType: {
////                    validators: {
////                        notEmpty: {
////                            enabled: true   // or false
////                        }
////                    }
////                }
////            }
////        });
//    });

    $(document).ready(function() {

        formMode = "Add";
        $('#EditAnchor').attr("disabled", "disabled");
        $('#FlashMessage').fadeOut(5000);

        // On Pressing Enter, Preventing Default Functionality
        onPressEnter('#partyTypeForm');
        onPressEnter('#partyTypeFormEdit');
    });

    function doToggle(id) {
        $(id).toggle();
    }

    function retrivePopup() {
        formMode = "Retrieve";
        $("#EditAnchor").removeAttr("disabled");
        var count = 1;
        bootbox.dialog({
            title: "List of Party Type",
            message:
                    "<fieldset>" +
                    "<div class='box box-primary'>" +
                    "<div class='box-body'>" +
                    "<form name='partyTypeFormEdit' role='' method='' action='' class=''>" +
                    "<br><div class='col-md-12'>" +
                    "<div class='pull-left col-md-2'>" +
                    "<label>Search</label>" +
                    "</div>" +
                    "<div class='pull-left col-md-4'>" +
                    "<input id='searchPartyType' name='searchPartyType' type='text' class='form-control' onkeyup='search()' placeholder='Search by Party Type' style='width:200px;margin-left:-30px;'>" +
                    //"<input id='SearchNow' type='button' value='OK' class='btn btn-primary' onclick='search()' style='width: 100px;margin-left: 175px;margin-top:-58px;'>" +
                    "</div>" +
                    "</div><br><br><br>" +
                    "<fieldset>" +
                    "<div class='box-body table-responsive'>" +
                    "<div class='box'>" +
                    "<table class='table table-bordered table-striped'>" +
                    "<thead>" +
                    "<tr>" +
                    "<th width='10%'>S No.</th>" +
                    "<th width='55%'>Party Type</th>" +
                    "<th width='35%'>Details</th>" +
                    "</tr>" +
                    "</thead>" +
                    "<tbody id='PartyTypebody'>" +
                    <?php
                        foreach ($partyTypelist as $key) {
                    ?> 
                    "<tr>" +
                    "<td>" + count++ + "</td>" +
                    "<td><?= $key['PartyTypeName'] ?></td>" +
                    "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('<?= $key['Party_type_id'] ?>','<?= rawurlencode($key['PartyTypeName']) ?>','None')>Edit</a>" +
                    "<span> | </span>" +
                    "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/partytype/Delete/<?= $key['Party_type_id'] ?>'>Delete</a></td>" +
                    "</tr>"+<?php } ?>
                    "</tbody>" +
                    "<tfoot>" +
                    "<tr>" +
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
        onPressEnter('#searchPartyType');
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

    function ediForm(idPartyType, partyType, type) {
        if (type === 'editmenu') {
            formMode = "Edit";
            var action = "<?php echo base_url() ?>index.php/partytype/Update";
            enableElements("#PartyType");
            enableElements("#SavePartyTypeButton");
            document.getElementById("partyTypeForm").action = action;
        } else {
            $("#PartyTypeID").val(idPartyType);
            $("#PartyType").val(decodeURI(partyType));
            disableElements("#PartyType");
            disableElements("#SavePartyTypeButton");
        }
    }

    function resetForm() {
        if (formMode === 'Retrieve' || formMode === 'Edit') {
            return true;
        } else {
            emptyAllFields("#PartyType");
        }
    }

    function doToogle(id) {
        $(id).toggle();
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

    function search() {
        var searchValue = $('#searchPartyType').val();
        var items = [];
        var count = 1;
        if (searchValue === "") {
            //bootbox.alert("Please enter value to search for", function(result) {
            //});
            
                    <?php
                        foreach ($partyTypelist as $key) {
                    ?> 
             items += "<tr>" +
                    "<td>" + count++ + "</td>" +
                    "<td><?= $key['PartyTypeName'] ?></td>" +
                    "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('<?= $key['Party_type_id'] ?>','<?= rawurlencode($key['PartyTypeName']) ?>','None')>Edit</a>" +
                    "<span> | </span>" +
                    "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/partytype/Delete/<?= $key['Party_type_id'] ?>'>Delete</a></td>" +
                    "</tr>";<?php } ?>
            $("#PartyTypebody").html(items);
        } else
        {
            $.ajax({
                url: "<?= base_url() ?>index.php/partytype/search",
                type: "POST",
                data: {search: searchValue},
                success: function(data) {
                    if (data !== "null")
                    {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            try {
                                
                                $.each(parsedData, function(i, val) {
                                    items += "<tr>" +
                                            "<td>" + count++ + "</td>" +
                                            "<td>" + val.PartyTypeName + "</td>" +
                                            "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('" + val.Party_type_id + "','" + encodeURI(val.PartyTypeName) + "','None')>Edit</a>" +
                                            "<span> | </span>" +
                                            "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/partytype/Delete/" + val.Party_type_id + "'>Delete</a></td>" +
                                            "</tr>";
                                });
                                $("#PartyTypebody").html(items);
                            } catch (e) {
                                console.log(e);
                            }
                        }
                        else {
                            $("#PartyTypebody").html("<tr><td></td><td>No Data Found</td><td></td></tr>");
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
