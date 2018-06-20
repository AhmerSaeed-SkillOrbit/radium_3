<?php
include 'include/leftmenu.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Party Creation
        </h1><br><br>
        <div class="row">
            <div class="pull-right" style="padding-right:15px;">
                <div>
                    <a class="btn btn-app" onclick="retrivePopup()">
                        <i class="fa fa-align-justify"></i> Retrieve                  
                    </a>
                    <a class="btn btn-app" onclick="reloadForm()">
                        <i class="fa fa-adn"></i> New                  
                    </a>
                    <a id="EditAnchor" class="btn btn-app" onclick="ediForm('Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'editmenu')"> 
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
                    <form id="partyCreationForm" name="partyCreationForm" role="form" method="post" action="<?= base_url() ?>index.php/partycreation/Add" onSubmit="return validationForm()"> 
                        <fieldset>
                            <legend>Party Information</legend>
                            <div id="FlashMessage">
                                <h5 style=""><?= $insertMessage ?></h5>
                                <h5 style=""><?= $updateMessage ?></h5>
                                <h5 style=""><?= $deleteMessage ?></h5>
                            </div>    
                            <div id="PartyDiv">  
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;display: none;">
                                    <label for="">Party ID</label>
                                    <input id="PartyID" name="PartyID" type="hidden" class="form-control" placeholder="">
                                </div>   
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Company Name</label>
                                    <input id="CompanyName" name="CompanyName" type="text" class="form-control"  placeholder="Company Name">
                                </div>                       
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Contact Person</label>
                                    <input id="ContactPerson" name="ContactPerson" type="text" class="form-control"  placeholder="Contact Person Name">
                                </div><br>                        
                                <div class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label>Address</label>
                                    <textarea id="Address" name="Address" class="form-control"  rows="3" cols="5" placeholder="Address ..." style="height: 114px;"></textarea>
                                </div>
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label>Phone</label> 
                                    <div class="input-group" style="">                                  
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input id="ContactNumber" name="ContactNumber" type="text" class="form-control" data-inputmask='"mask": "999-9-9999999"' data-mask style="width: 290px;"/>
                                    </div>
                                </div> 
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Fax</label>
                                    <input id="Fax" name="Fax" type="text" class="form-control"  placeholder="Fax">
                                </div> 
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label>Mobile</label>
                                    <div class="input-group" style="">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input id="Mobile" name="Mobile" type="text" class="form-control" data-inputmask='"mask": "9999-9999999"' data-mask style="width: 290px;"/>
                                    </div> 
                                </div>                                                         
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Email</label>
                                    <input id="Email" name="Email" type="email" class="form-control"  placeholder="Email">
                                </div>                      
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">STRN</label>
                                    <input id="STRN" name="STRN" type="text" class="form-control"  placeholder="STRN">
                                </div>
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">NTN#</label>
                                    <input id="NtnNumber" name="NtnNumber" type="text" class="form-control"  placeholder="NTN Number">
                                </div>  
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label>Party Type</label>
                                    <select id="idPartyType" name="idPartyType" class="form-control">
                                        <option>Select Party Type</option>                                       
                                        <?php
                                        foreach ($partyTypeCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['Party_type_id'] ?>"><?php echo $key['PartyTypeName'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-partytype" style="width: 170px;margin-left: 60px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>
                                <div class="pull-right col-xs-6 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <br><button id="SavePartyButton" type="submit" class="btn btn-primary" style="width: 75px;float: right;">Save</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div><!-- /.box -->
        </div><!-- /.box -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<script>

    $(document).ready(function() {
        formMode = "Add";
        $('#EditAnchor').attr("disabled", "disabled");
        $('#FlashMessage').fadeOut(5000);
        $("[data-mask]").inputmask();
        $(".form-error").hide();

        onPressEnter('#CompanyName');
        onPressEnter('#ContactPerson');
        onPressEnter('#ContactNumber');
        onPressEnter('#Fax');
        onPressEnter('#Mobile');
        onPressEnter('#Email');
        onPressEnter('#STRN');
        onPressEnter('#NtnNumber');
        onPressEnter('#idPartyType');
        onPressEnter('#partyCreationFormEdit');

    });

    function retrivePopup() {
        formMode = "Retrieve";
        $("#EditAnchor").removeAttr("disabled");
        var count = 1;

        bootbox.dialog({
            title: "List of Party(ies)",
            message:
                    "<fieldset>" +
                    "<div class='box box-primary'>" +
                    "<div class='box-body'>" +
                    "<form name='partyCreationFormEdit' role='' method='' action='' class=''>" +
                    "<br><div class='col-md-12'>" +
                    "<div class='pull-left col-md-2'>" +
                    "<label>Search</label>" +
                    "</div>" +
                    "<div class='pull-left col-md-6' style='width:400px;'>" +
                    "<input id='searchParty' name='searchParty'type='text'class='form-control' placeholder='Search by Company Name' onkeyup='search()' style='width:200px;margin-left:-70px;'>" +
                    //"<input id='SearchNow' type='button' value='OK' class='btn btn-primary' onclick='search()' style='width: 100px;margin-left: 135px;margin-top:-58px;'>" +
                    "</div>" +
                    "</div><br><br><br>" +
                    "<fieldset>" +
                    "<div class='box-body table-responsive'>" +
                    "<div class='box'>" +
                    "<table class='table table-bordered table-striped'>" +
                    "<thead>" +
                    "<tr>" +
                    "<th width='02%'>SNo.</th>" +
                    "<th width='15%'>Company</th>" +
                    "<th width='15%'>Person</th>" +
                    "<th width='24%'>Contact</th>" +
                    "<th width='10%'>Email</th>" +
                    "<th width='05%'>STRN</th>" +
                    "<th width='05%'>NTN</th>" +
                    "<th width='10%'>Type</th>" +
                    "<th width='10%'>Address</th>" +
                    "<th width='15%'>Details</th>" +
                    "</tr>" +
                    "</thead>" +
                    "<tbody id='PartyCreationTbody'>" +
                    <?php
                        foreach ($partyList as $key) {
                    ?> 
                    "<tr>" +
                    "<td>" + count++ +"</td>" +
                    "<td><?= $key['CompanyName'] ?></td>" +
                    "<td><?= $key['ContactPerson'] ?></td>" +
                    "<td><?= $key['Phone'] ?></td>" +
                    "<td><?= $key['Email'] ?></td>" +
                    "<td><?= $key['STRN'] ?></td>" +
                    "<td><?= $key['NtnNumber'] ?></td>" +
                    "<td><?= $key['PartyTypeName'] ?></td>" +
                    "<td><?= $key['Address'] ?></td>" +
                    "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('<?= $key['Party_id'] ?>','<?= rawurlencode($key['CompanyName']) ?>','<?= rawurlencode($key['ContactPerson']) ?>','<?= rawurlencode($key['Phone']) ?>','<?= rawurlencode($key['Address']) ?>','<?= rawurlencode($key['Mobile']) ?>','<?= rawurlencode($key['Email']) ?>','<?= rawurlencode($key['STRN']) ?>','<?= rawurlencode($key['NtnNumber']) ?>','<?= rawurlencode($key['Fax']) ?>','<?= rawurlencode($key['PartyTypeName']) ?>','None')>Edit</a>" +
                    "<span>|</span>" +
                    "<a style='cursor: pointer;' href='<?= base_url() ?>index.php/partycreation/Delete/<?= $key['Party_id'] ?>'>Delete</a>" +
                    "</td>" +
                    "</tr>"+<?php } ?>
                    "</tbody>" +
                    "<tfoot>" +
                    "<tr>" +
                    "<th></th>" +
                    "<th></th>" +
                    "<th></th>" +
                    "<th></th>" +
                    "<th></th>" +
                    "<th></th>" +
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
        $('.modal-content').css({
            "width": '850px',
            "margin-left": '-150px'
        });
        onPressEnter('#searchParty');
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

    function ediForm(idPartyType, CompanyName, ContactPerson, Phone, Address, Mobile, Email, STRN, NtnNumber, Fax, partyTypeName, type) {
        if (type === 'editmenu') {
            formMode = "Edit";
            var action = "<?php echo base_url() ?>index.php/partycreation/Update";
            enableElements("#PartyID");
            enableElements("#CompanyName");
            enableElements("#ContactPerson");
            enableElements("#ContactNumber");
            enableElements("#Mobile");
            enableElements("#Email");
            enableElements("#STRN");
            enableElements("#NtnNumber");
            enableElements("#Address");
            enableElements("#Fax");
            enableElements("#idPartyType");
            enableElements("#SavePartyButton");
            document.getElementById("partyCreationForm").action = action;
        } else {
            $("#PartyID").val(idPartyType);
            $("#CompanyName").val(decodeURI(CompanyName));
            $("#ContactPerson").val(decodeURI(ContactPerson));
            $("#ContactNumber").val(decodeURI(Phone));
            $("#Address").val(unescape(Address));
            $("#Mobile").val(decodeURI(Mobile));
            $("#Email").val(unescape(Email));
            $("#STRN").val(decodeURI(STRN));
            $("#NtnNumber").val(decodeURI(NtnNumber));
            $("#Fax").val(decodeURI(Fax));
            $('#idPartyType option').filter(function() {
                return ($(this).text() === partyTypeName);
            }).prop('selected', true);
            disableElements("#PartyID");
            disableElements("#CompanyName");
            disableElements("#ContactPerson");
            disableElements("#ContactNumber");
            disableElements("#Mobile");
            disableElements("#Email");
            disableElements("#STRN");
            disableElements("#NtnNumber");
            disableElements("#Fax");
            disableElements("#idPartyType");
            disableElements("#Address");
            disableElements("#SavePartyButton");
        }
    }

    function resetForm() {
        if (formMode === 'Retrieve' || formMode === 'Edit') {
            return true;
        } else {
            emptyAllFields("#PartyID");
            emptyAllFields("#CompanyName");
            emptyAllFields("#ContactPerson");
            emptyAllFields("#ContactNumber");
            emptyAllFields("#Mobile");
            emptyAllFields("#Email");
            emptyAllFields("#STRN");
            emptyAllFields("#NtnNumber");
            emptyAllFields("#Fax");
            emptyAllFields("#Address");
            emptyAllFields("#idPartyType");
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

    function doToggle(id) {
        $(id).toggle();
    }

    function search() {
        var searchValue = $('#searchParty').val();
        var items = [];
        var count = 1;
        if (searchValue === "") {
            //bootbox.alert("Please enter value to search for ", function(result) {
            <?php
                foreach ($partyList as $key) {
            ?> 
             items +=  "<tr>" +
                    "<td>" + count++ +"</td>" +
                    "<td><?= $key['CompanyName'] ?></td>" +
                    "<td><?= $key['ContactPerson'] ?></td>" +
                    "<td><?= $key['Phone'] ?></td>" +
                    "<td><?= $key['Email'] ?></td>" +
                    "<td><?= $key['STRN'] ?></td>" +
                    "<td><?= $key['NtnNumber'] ?></td>" +
                    "<td><?= $key['PartyTypeName'] ?></td>" +
                    "<td><?= $key['Address'] ?></td>" +
                    "<td><a data-dismiss='modal' style='cursor: pointer;' onclick=ediForm('<?= $key['Party_id'] ?>','<?= rawurlencode($key['CompanyName']) ?>','<?= rawurlencode($key['ContactPerson']) ?>','<?= rawurlencode($key['Phone']) ?>','<?= rawurlencode($key['Address']) ?>','<?= rawurlencode($key['Mobile']) ?>','<?= rawurlencode($key['Email']) ?>','<?= rawurlencode($key['STRN']) ?>','<?= rawurlencode($key['NtnNumber']) ?>','<?= rawurlencode($key['Fax']) ?>','<?= rawurlencode($key['PartyTypeName']) ?>','None')>Edit</a>" +
                    "<span>|</span>" +
                    "<a style='cursor: pointer;' href='<?= base_url() ?>index.php/partycreation/Delete/<?= $key['Party_id'] ?>'>Delete</a>" +
                    "</td>" +
                    "</tr>";<?php } ?>
            $("#PartyCreationTbody").html(items);
        } else {
            $.ajax({
                url: "<?= base_url() ?>index.php/partycreation/search",
                type: "POST",
                data: {search: searchValue},
                success: function(data) {
                    if (data !== "null") {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            try {
                                    $.each(parsedData, function(i, val) {
                                    items += "<tr>" +
                                            "<td>" + count++ + "</td>" +
                                            "<td>" + val.CompanyName + "</td>" +
                                            "<td>" + val.ContactPerson + "</td>" +
                                            "<td>" + val.Phone + ", <?php echo "<br>" ?> " + val.Mobile + "</td>" +
                                            "<td>" + val.Email + "</td>" +
                                            "<td>" + val.STRN + "</td>" +
                                            "<td>" + val.NtnNumber + "</td>" +
                                            "<td>" + val.PartyTypeName + "</td>" +
                                            "<td>" + val.Address + "</td>" +
                                            "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('" + val.Party_id + "','" + encodeURI(val.CompanyName) + "','" + encodeURI(val.ContactPerson) + "','" + encodeURI(val.Phone) + "','" + encodeURI(val.Address) + "','" + encodeURI(val.Mobile) + "','" + encodeURI(val.Email) + "','" + encodeURI(val.STRN) + "','" + encodeURI(val.NtnNumber) + "','" + encodeURI(val.Fax) + "','" + encodeURI(val.PartyTypeName) + "','None')>Edit</a>" +
                                            "<span> | </span>" +
                                            "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/partycreation/Delete/" + val.Party_id + "'>Delete</a>"+"\
                                            </td>" +
                                            "</tr>";
                                });
                                $("#PartyCreationTbody").html(items);
                            } catch (e) {
                                console.log(e);
                            }
                        }
                        else {
                            $("#PartyCreationTbody").html("<tr><td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td><td></td><td></td></tr>");
                        }
                    }
                }
            });
        }
    }

    function validationForm() {
        var partytypeName = $('#idPartyType').val();
        if (partytypeName === "Select Party Type") {
            $(".error-partytype").show();
            return false;
        } else {
            $(".error-partytype").hide();
            return true;
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
