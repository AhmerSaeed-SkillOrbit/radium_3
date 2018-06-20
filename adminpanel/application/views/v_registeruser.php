<?php
include 'include/leftmenu.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Registration
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
                    <a id="EditAnchor" class="btn btn-app" onclick="editForm('Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'editmenu')"> 
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
                    <form id="userRegistrationForm" name="userRegistrationForm" role="form" method="post" action="<?= base_url() ?>index.php/registeruser/Add" onSubmit="return validationForm()"> 
                        <fieldset>
                            <legend>User Information</legend>
                            <div id="FlashMessage">
                                <h5 style=""><?= $insertMessage ?></h5>
                                <h5 style=""><?= $updateMessage ?></h5>
                                <h5 style=""><?= $deleteMessage ?></h5>
                            </div>    
                            <div id="UserRegistrationDiv">  
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;display: none;">
                                    <label for="">id User</label>
                                    <input id="idUser" name="idUser" type="hidden" class="form-control" placeholder="">
                                </div>   
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Login ID</label>
                                    <input id="LoginID" name="LoginID" type="text" class="form-control"  placeholder="Login ID" required>
                                </div>                       
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">First Name</label>
                                    <input id="FirstName" name="FirstName" type="text" class="form-control"  placeholder="First Name" required>
                                </div>                       
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Last Name</label>
                                    <input id="LastName" name="LastName" type="text" class="form-control"  placeholder="Last Name" required>
                                </div><br>      
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Password</label>
                                    <input id="Password" name="Password" type="password" class="form-control" placeholder="Password" required>
                                </div>     
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label>User Role</label>
                                    <select id="idUserRole" name="idUserRole" class="form-control">
                                        <option>Select User Role</option>                                       
                                        <?php
                                        foreach ($userRoleCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['idRole'] ?>"><?php echo $key['Role_name'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-userrole" style="width: 170px;margin-left: 60px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>
                                <div class="pull-right col-xs-6 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <br><button id="SaveUserButton" type="submit" class="btn btn-primary" style="width: 75px;float: right;">Save</button>
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

        onPressEnter('#idUser');
        onPressEnter('#LoginID');
        onPressEnter('#FirstName');
        onPressEnter('#LastName');
        onPressEnter('#Password');
        onPressEnter('#idUserRole');

    });

    function retrivePopup() {
        formMode = "Retrieve";
        $("#EditAnchor").removeAttr("disabled");

        bootbox.dialog({
            title: "List of User(s)",
            message:
                    "<fieldset>" +
                    "<div class='box box-primary'>" +
                    "<div class='box-body'>" +
                    "<form name='registerUserFormEdit' role='' method='' action='' class=''>" +
                    "<br><div class='col-md-12'>" +
                    "<div class='pull-left col-md-2'>" +
                    "<label>Search</label>" +
                    "</div>" +
                    "<div class='pull-left col-md-6' style='width:400px;'>" +
                    "<input id='searchUser' name='searchUser' type='text' class='form-control' onkeyup='search(this)' placeholder='Search by User ID' style='width:200px;margin-left:-70px;'>" +
                    "<input id='SearchNow' type='hidden' value='OK' class='btn btn-primary' onclick='' style='width: 100px;margin-left: 135px;margin-top:-58px;'>" +
                    "</div>" +
                    "</div><br><br><br>" +
                    "<fieldset>" +
                    "<div class='box-body table-responsive'>" +
                    "<div class='box'>" +
                    "<table class='table table-bordered table-striped'>" +
                    "<thead>" +
                    "<tr>" +
                    "<th width='02%'>SNo.</th>" +
                    "<th width='15%'>Login ID</th>" +
                    "<th width='15%'>First Name</th>" +
                    "<th width='15%'>Last Name</th>" +
                    "<th width='14%'>User Role</th>" +
                    "<th width='15%'>Details</th>" +
                    "</tr>" +
                    "</thead>" +
                    "<tbody id='RegisterUserTbody'>" +
                    "</tbody>" +
                    "<tfoot>" +
                    "<tr>" +
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
        onPressEnter('#searchUser');
    }

    function reloadForm() {
        console.log('formMode');
        console.log(formMode);

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

    function editForm(idUser, LoginID, FirstName, LastName, Password, idRole, RoleName, type) {
        if (type === 'editmenu') {
            formMode = "Edit";
            var action = "<?php echo base_url() ?>index.php/registeruser/Update";
            enableElements("#idUser");
            enableElements("#LoginID");
            enableElements("#FirstName");
            enableElements("#LastName");
            enableElements("#idUserRole");
            document.getElementById("userRegistrationForm").action = action;
        } else {
            $("#idUser").val(idUser);
            $("#LoginID").val(decodeURI(LoginID));
            $("#FirstName").val(decodeURI(FirstName));
            $("#LastName").val(decodeURI(LastName));
            $("#Password").val(decodeURI(Password));
            $('#idUserRole option').filter(function() {
                return ($(this).text() === RoleName);
            }).prop('selected', true);
            disableElements("#idUser");
            disableElements("#LoginID");
            disableElements("#FirstName");
            disableElements("#LastName");
            disableElements("#Password");
            disableElements("#idUserRole");
        }
    }

    function resetForm() {
        if (formMode === 'Retrieve' || formMode === 'Edit') {
            return true;
        } else {
            emptyAllFields("#idUser");
            emptyAllFields("#LoginID");
            emptyAllFields("#FirstName");
            emptyAllFields("#LastName");
            emptyAllFields("#Password");
            emptyAllFields("#idUserRole");
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

    function search(obj) {
        var searchValue = $(obj).val();
        if (searchValue === "") {
//            bootbox.alert("Please enter value to search for ", function(result) {
//            });
        } else
        {
            $.ajax({
                url: "<?= base_url() ?>index.php/registeruser/search",
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
                                            "<td>" + val.Login_id + "</td>" +
                                            "<td>" + val.FirstName + "</td>" +
                                            "<td>" + val.LastName + "</td>" +
                                            "<td>" + val.Role_name + "</td>" +
                                            "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =editForm('" + val.User_id + "','" + encodeURI(val.Login_id) + "','" + encodeURI(val.FirstName) + "','" + encodeURI(val.LastName) + "','" + encodeURI(val.Password) + "','" + encodeURI(val.idRole) + "','" + encodeURI(val.Role_name) + "','None')>Edit</a>" +
                                            "<span> | </span>" +
                                            "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/registeruser/Delete/" + val.User_id + "'>Delete</a></td>" +
                                            "</tr>";
                                });
                                $("#RegisterUserTbody").html(items);
                            } catch (e) {
                                console.log(e);
                            }
                        }
                        else {
                            $("#RegisterUserTbody").html("<tr><td></td><td>No Data Found</td><td></td><td></td><td></td><td></td><td></td></tr>");
                        }
                    }
                }
            });
        }
    }

    function validationForm() {
        var userRole = $('#idUserRole option:selected').val();
        if (userRole === "Select User Role") {
            $(".error-userrole").show();
            return false;
        } else {
            $(".error-userrole").hide();
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
