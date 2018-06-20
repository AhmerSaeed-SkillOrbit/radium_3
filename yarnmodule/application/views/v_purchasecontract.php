<?php
include 'include/leftmenu.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Purchase Contract
        </h1><br><br>
        <div class="row">
            <div class="pull-right" style="padding-right:15px;">
                <a class="btn btn-app" onclick="retrivePopup()">
                    <i class="fa fa-align-justify"></i> Retrieve                  
                </a>
                <a class="btn btn-app" onclick="reloadForm()">
                    <i class="fa fa-adn"></i> New                  
                </a>                                                
                <a id="EditAnchor" class="btn btn-app" onclick="ediForm('Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'editmenu')"> 
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a class="btn btn-app" onclick="resetForm()">
                    <i class="fa fa-repeat"></i> Reset
                </a>
                <a id="PrintAnchor" class="btn btn-app" onclick="printPC($('#PCNumber').val())">
                    <i class="fa fa-print"></i> Print
                </a>
                <a id="CSVAnchor" class="btn btn-app" onclick="downloadCSV($('#PCNumber').val())">
                    <i class="fa fa-download"></i> Download CSV
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
                    <form id="purchaseContractForm" name="purchaseContractForm" role="form" method="post" action="<?= base_url() ?>index.php/purchasecontract/Add" onSubmit="return validationForm()"> 
                        <fieldset>
                            <legend onclick="">Contract Information</legend>
                            <div id="FlashMessage">
                                <h5 id="PurchaseInsertMessage" style=""><?= $insertMessage ?></h5>
                                <h5 id="PurchaseUpdateMessage" style=""><?= $updateMessage ?></h5>
                                <h5 id="PurchaseDeleteMessage" style=""><?= $deleteMessage ?></h5>
                            </div>  
                            <div id="ContractDiv">
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;display: none;">
                                    <label for="">Purchase Contract ID</label>
                                    <input id="PurchaseContractID" name="PurchaseContractID" type="" class="form-control" placeholder="">
                                </div>  
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">PC#</label>
                                    <input id="PCNumber" name="PCNumber" type="text" value="<?php
                                    if ($pcNumber) {
                                        echo $pcNumber;
                                    }
                                    ?>" class="form-control" style="" placeholder="" readonly>
                                </div>                       
                                <div id="" class="pull-left col-xs-10 col-sm-5 col-md-5" style="margin-top: 20px;">
                                    <label for="">Broker</label>
                                    <select id="idBroker" name="idBroker" class="form-control" style="width: 200px;"> 
                                        <option>Select Broker</option>                                       
                                        <?php
                                        foreach ($brokerCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['Party_id'] ?>"><?php echo $key['CompanyName'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-brokertype" style="width: 170px;margin-left: 60px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>
                                <div class="pull-right col-xs-2 col-sm-1 col-md-1" style="">
                                    <label for="" style="width: 65px;margin-top: 59px;margin-left: -35px;"><a onclick="addNewPopup('Broker')">Add New</a></label>                                                              
                                </div>
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label>Count</label>
                                    <select id="idCount" name="idCount" class="form-control" style="width: 175px;">
                                        <option>Select Count</option>                                       
                                        <?php
                                        foreach ($countCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['Count_id'] ?>"><?php echo $key['CountName'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-counttype" style="width: 170px;margin-left: 30px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>                    
                                <div id="" class="pull-left col-xs-10 col-sm-5 col-md-5" style="margin-top: 20px;">
                                    <label for="">Mill</label>
                                    <select id="idMill" name="idMill" class="form-control" style="width:200px;">
                                        <option>Select Mill</option>                                       
                                        <?php
                                        foreach ($millCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['Party_id'] ?>"><?php echo $key['CompanyName'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-milltype" style="width: 170px;margin-left: 60px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>  
                                <div class="pull-right col-xs-2 col-sm-1 col-md-1" style="">
                                    <label for="" style="width: 65px;margin-top: 48px;margin-left: -35px;"><a onclick="addNewPopup('Mill')">Add New</a></label>                                                              
                                </div>                             
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Brand</label>
                                    <input id="Brand" name="Brand" type="text" class="form-control" style="" placeholder="Brand">
                                </div>                      
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Seller Contract Number</label>
                                    <input id="SellerContractNumber" name="SellerContractNumber" type="text" class="form-control" style="width: 175px;" placeholder="Seller Contact Number">
                                </div>                          
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;width: 280px;">
                                    <label for="">Contract Date</label>
                                    <div class="input-group" style="width: 150px;">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input id="ContractDate" name="ContractDate" type="text" class="form-control" style="" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                                    </div>
                                </div>
                                <div class="form-group has-error form-error error-pcdate" style="width: 130px;margin-left: 30px;">
                                    <label class="control-label" for="inputError">Enter Date!</label>
                                </div>
                            </div>
                        </fieldset><br><br><br>
                        <fieldset>
                            <legend onclick="">Item Information</legend>
                            <div id="ItemDiv">
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Rate/10 lbs</label>
                                    <input id="Rate" name="Rate" type="text" value="" class="form-control allownumericwithdecimal" style="" placeholder="0.00">
                                    <div class="form-group has-error form-error error-rate" style="width: 185px;margin-left: 75px;">
                                        <label class="control-label" for="inputError">Value Must be a Numeric or Decimal and Greater than Zero!</label>
                                    </div>
                                </div>                       
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">No. Of Bags</label>
                                    <input id="NoOfBags" name="NoOfBags" type="text" value="" class="form-control" style="" placeholder="0.00" >
                                    <div class="form-group has-error form-error error-noofbags" style="width: 185px;margin-left: 75px;">
                                        <label class="control-label" for="inputError">Value Must be a Numeric or Decimal and Greater than Zero!</label>
                                    </div>
                                </div>
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label>Total Weight (lbs)</label>
                                    <input id="TotalWeight" name="TotalWeight" type="text" value="" class="form-control" style="" placeholder="0.00" readonly>
                                    <!--                                    <div class="form-group has-error form-error error-totalweight" style="width: 235px;margin-left: 30px;">
                                                                            <label class="control-label" for="inputError">Value Must be Decimal and Greater than Zero!</label>
                                                                        </div>-->
                                </div>                   
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6 " style="margin-top: 20px;">
                                    <label for="">Contract Amount</label>
                                    <input id="ContractAmount" name="ContractAmount" type="text" value="" class="form-control" style="" placeholder="0.00" readonly>
                                    <!--                                    <div class="form-group has-error form-error error-contractamount" style="width: 235px;margin-left: 30px;">
                                                                            <label class="control-label" for="inputError">Value Must be a Decimal or Numeric!</label>
                                                                        </div>-->
                                </div>
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label>GST %</label>
                                    <input id="GSTPercent" name="GSTPercent" type="text" value="" class="form-control allownumericwithdecimal" style="" placeholder="0.00">
                                    <div class="form-group has-error form-error error-contractamount" style="width: 235px;margin-left: 30px;">
                                        <label class="control-label" for="inputError">Value Must be a Decimal or Numeric!</label>
                                    </div>
                                </div>                   
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6 " style="margin-top: 20px;">
                                    <label for="">GST Amount</label>
                                    <input id="GSTAmount" name="GSTAmount" type="text" value="" class="form-control" style="" placeholder="0.00" readonly>
                                </div>
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label>Contract Amount (Incl. GST)</label>
                                    <input id="ContractAmountGST" name="ContractAmountGST" type="text" value="" class="form-control allownumericwithdecimal" style="" placeholder="0.00" readonly>
                                </div> 
                            </div>
                        </fieldset><br><br><br>
                        <fieldset>
                            <legend onclick="">Payment and Delivery</legend>
                            <div id="PaymentDeliveryDiv">
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Payment Terms</label>
                                    <input id="PaymentTerms" name="PaymentTerms" type="number" value="0" min="0" class="form-control" style="" placeholder="Payment Terms">
                                </div>                      
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Cartage</label>
                                    <select id="Cartage" name="Cartage" class="form-control" style="">
                                        <option>Select Cartage</option>
                                        <option value="Ex-Mill">Ex-Mill</option>
                                        <option value="Ex-Factory">Ex-Factory</option>
                                    </select>
                                    <div class="pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-cartagetype" style="width: 170px;margin-left: 60px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>                        
                                <div class="pull-left col-xs-12 col-sm-6 col-md-12" style="margin-top: 20px;">
                                    <label>Remarks</label>
                                    <textarea id="Remarks" name="Remarks" class="form-control" style="width: 677px;" rows="3" placeholder="Remarks ..."></textarea>
                                </div><br>
                                <div class="pull-right col-xs-6 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <br><input id="SavePCButton" type="submit" value="Save" class="btn btn-primary" style="width: 75px;float: right;">
                                </div>
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
        $(".form-error").hide();
        formMode = "Add";
        $('#EditAnchor').attr("disabled", "disabled");
        $('#PrintAnchor').attr("disabled", "disabled");
        $('#FlashMessage').fadeOut(5000);
        $("#ContractDate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        onPressEnter('#purchaseContractFormEdit');
        onPressEnter('#purchaseContractForm');
        onPressEnter('#partyCreationForm');
        <?php
            if (strval($operation) == "1" || strval($operation) == "2")
            {
                echo "bootbox.confirm('Do you want to print this document', function(result) {
                        if (result) {
                            printPC($pcNo);
                        }
                        else {
                            printPC($pcNo);
                        }
                    });";
            }
        ?>
    });

 
        function retrivePopup() {

        formMode = "Retrieve";
        $("#EditAnchor").removeAttr("disabled");
        $("#PrintAnchor").removeAttr("disabled");
        bootbox.dialog({
        title: "Purchase Contract(s)",
                message:
                "<fieldset>" +
                "<div class='box box-primary'>" +
                "<div class='box-body'>" +
                "<form name='purchaseContractFormEdit' role='' method='' action='' class=''>" +
                "<br><div class='col-md-12'>" +
                "<div class='pull-left col-md-2'>" +
                "<label>Search</label>" +
                "</div>" +
                "<div class='pull-left col-md-4'>" +
                "<input id='searchPurchaseContract'name='searchPurchaseContract'type='text'class='form-control' onkeyup='search()' placeholder='Search by PC Number' style='width:200px;margin-left:-100px;'>" +
                //"<input id='SearchNow' type='button' value='OK' class='btn btn-primary' onclick='search()' style='width: 100px;margin-left: 110px;margin-top:-58px;'>" +
                "</div>" +
                "</div><br><br><br>" +
                "<fieldset>" +
                "<div class='box-body table-responsive'>" +
                "<div class='box'>" +
                "<table class='table table-bordered table-striped'>" +
                "<thead>" +
                "<tr>" +
                "<th width='12%'>PC-#</th>" +
                "<th width='05%'>Broker</th>" +
                "<th width='05%'>Count</th>" +
                "<th width='05%'>Mill</th>" +
                "<th width='05%'>Brand</th>" +
                "<th width='10%'>Seller Contract</th>" +
                "<th width='15%'>Contract Date</th>" +
                "<th width='04%'>Rate</th>" +
                "<th width='04%'>Bags</th>" +
                "<th width='05%'>Total-Weight</th>" +
                "<th width='05%'>Contract Amount</th>" +
                "<th width='05%'>Contract Amount(Incl. GST)</th>" +
                "<th width='05%'>Payment-Terms</th>" +
                "<th width='05%'>Status</th>" +
                "<th width='15%'>Details</th>" +
                "</tr>" +
                "</thead>" +
                "<tbody id='PurchaseContractTbody'>"+                  
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
                "<th></th>" +
                "<th></th>" +
                "<th></th>" +
                "<th></th>" +
                "<th></th>" +
                "</tr>" +
                "</tfoot>" +
                "</table>" +
                "</fieldset>" +
                "</div>" +
                "</form>" +
                "</div>" +
                "</div>" +
                "</fieldset>"
        });
                $('.modal-content').css({
        "width": '1210px',
                "margin-left": '-180px'
        });
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

        function ediForm(Purchase_contract_id, PurchaseContractNo, Broker, CountName, Mill, Brand, SellerContractNo, ContractDate, Rate, Bags, TotalWeight, ContractAmount, PaymentTerms, Cartage, Remarks, GSTPercent, GSTAmount, ContractAmountGST, type) {
            if (type === 'editmenu') {
                formMode = "Edit";
                var action = "<?php echo base_url() ?>index.php/purchasecontract/Update";
                enableElements("#PCNumber");
                enableElements("#idBroker");
                enableElements("#idCount");
                enableElements("#idMill");
                enableElements("#Brand");
                enableElements("#SellerContractNumber");
                enableElements("#ContractDate");
                enableElements("#Rate");
                enableElements("#NoOfBags");
                enableElements("#TotalWeight");
                enableElements("#ContractAmount");
                enableElements("#GSTPercent");
                enableElements("#GSTAmount");
                enableElements("#ContractAmountGST");
                enableElements("#PaymentTerms");
                enableElements("#Cartage");
                enableElements("#Remarks");
                enableElements("#SavePCButton");
                document.getElementById("purchaseContractForm").action = action;
            } else {
                $("#PurchaseContractID").val(Purchase_contract_id);
                $("#PCNumber").val(decodeURI(PurchaseContractNo));
                $("#Brand").val(decodeURI(Brand));
                $("#SellerContractNumber").val(decodeURI(SellerContractNo));
                $("#ContractDate").val(getFormatedDate(decodeURI(ContractDate)));
                $("#Rate").val(decodeURI(fractionNotation(Rate, 2)));
                $("#NoOfBags").val(decodeURI(Bags));
                $("#TotalWeight").val(decodeURI(fractionNotation(TotalWeight, 2)));
                $("#ContractAmount").val(decodeURI(fractionNotation(ContractAmount, 2)));
                $("#GSTPercent").val(decodeURI(GSTPercent));
                $("#GSTAmount").val(decodeURI(fractionNotation(GSTAmount, 2)));
                $("#ContractAmountGST").val(decodeURI(fractionNotation(ContractAmountGST, 2)));
                $("#PaymentTerms").val(decodeURI(PaymentTerms));
                $("#Remarks").val(decodeURI(Remarks));
                $('#idBroker option').filter(function() {
                    return ($(this).text() === decodeURI(Broker));
                }).prop('selected', true);
                $('#idCount option').filter(function() {
                    return ($(this).text() === unescape(CountName));
                }).prop('selected', true);
                $('#idMill option').filter(function() {
                    return ($(this).text() === decodeURI(Mill));
                }).prop('selected', true);
                $('#Cartage option').filter(function() {
                    return ($(this).text() === decodeURI(Cartage));
                }).prop('selected', true);
                disableElements("#PCNumber");
                disableElements("#idBroker");
                disableElements("#idCount");
                disableElements("#idMill");
                disableElements("#Brand");
                disableElements("#SellerContractNumber");
                disableElements("#ContractDate");
                disableElements("#Rate");
                disableElements("#NoOfBags");
                disableElements("#TotalWeight");
                disableElements("#ContractAmount");
                disableElements("#GSTPercent");
                disableElements("#GSTAmount");
                disableElements("#ContractAmountGST");
                disableElements("#PaymentTerms");
                disableElements("#Cartage");
                disableElements("#Remarks");
                disableElements("#SavePCButton");
            }
        }

        function resetForm() {
            if (formMode === 'Retrieve' || formMode === 'Edit') {
                return true;
            } else {
                emptyAllFields("#Broker");
                emptyAllFields("#Count");
                emptyAllFields("#Mill");
                emptyAllFields("#Brand");
                emptyAllFields("#SellerContractNumber");
                emptyAllFields("#ContractDate");
                emptyAllFields("#Rate");
                emptyAllFields("#NoOfBags");
                emptyAllFields("#TotalWeight");
                emptyAllFields("#ContractAmount");
                emptyAllFields("#GSTPercent");
                emptyAllFields("#GSTAmount");
                emptyAllFields("#ContractAmountGST");
                emptyAllFields("#PaymentTerms");
                emptyAllFields("#Cartage");
                emptyAllFields("#Remarks");
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


        function search(object) {
            var items = [];
            var PCStatus = "";
            var searchValue = $('#searchPurchaseContract').val();
            if (searchValue === "") {                //bootbox.alert("Please enter value to search for", function(result) {});  
                items = [];
                $("#PurchaseContractTbody").html(items);
            } else
            {
                $.ajax({
                    url: "<?= base_url() ?>index.php/purchasecontract/search",
                    type: "POST",
                    data: {search: searchValue},
                    success: function(data) {
                        if (data !== "null")
                        {
                            var parsedData = JSON.parse(data);
                            if (parsedData.length > 0) {
                                try {
                                       $.each(parsedData, function(i, val) {
                                        if (val.isClosed === '0') {

                                            PCStatus = "Opened";
                                        } else
                                        {
                                            PCStatus = "Closed";
                                        }
                                        items += "<tr>" +
                                                "<td>" + val.PurchaseContractNo + "</td>" +
                                                "<td>" + val.Broker + "</td>" +
                                                "<td>" + val.CountName + "</td>" +
                                                "<td>" + val.Mill + "</td>" +
                                                "<td>" + val.Brand + "</td>" +
                                                "<td>" + val.SellerContractNo + "</td>" +
                                                "<td>" + val.ContractDate + "</td>" +
                                                "<td>" + fractionNotation(val.Rate, 2) + "</td>" +
                                                "<td>" + val.Bags + "</td>" +
                                                "<td>" + fractionNotation(val.TotalWeight, 2) + "</td>" +
                                                "<td>" + fractionNotation(val.ContractAmount, 2) + "</td>" +
                                                "<td>" + fractionNotation(val.ContractAmountGST, 2) + "</td>" +
                                                "<td>" + val.PaymentTerms + "</td>" +
                                                "<td>" + PCStatus + "</td>" +
                                                "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('" + encodeURI(val.Purchase_contract_id) + "','" + encodeURI(val.PurchaseContractNo) + "','" + encodeURI(val.Broker) + "','" + encodeURI(val.CountName) + "','" + encodeURI(val.Mill) + "','" + encodeURI(val.Brand) + "','" + encodeURI(val.SellerContractNo) + "','" + encodeURI(val.ContractDate) + "','" + encodeURI(val.Rate) + "','" + encodeURI(val.Bags) + "','" + encodeURI(val.TotalWeight) + "','" + encodeURI(val.ContractAmount) + "','" + encodeURI(val.PaymentTerms) + "','" + encodeURI(val.Cartage) + "','" + encodeURI(val.Remarks) + "','" + encodeURI(val.GSTPercent) + "','" + encodeURI(val.GSTAmount) + "','" + encodeURI(val.ContractAmountGST) + "','None')>Edit</a>" +
                                                "<span> | </span>" +
                                                "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/purchasecontract/Delete/" + val.Purchase_contract_id + "'>Delete</a></td>" +
                                                "</tr>";
                                    });
                                    $("#PurchaseContractTbody").html(items);
                                } catch (e) {
                                    console.log(e);
                                }
                            }
                            else {
                                $("#PurchaseContractTbody").html("<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
                            }
                        }
                    }
                });
            }
        }

        function doToggle(id) {
            $(id).toggle();
        }

        function addNewPopup(type) {
            bootbox.dialog({
            title: "Party Creation",
                    message:
                    "<fieldset>" +
                    "<div class='box box-primary'>" +
                    "<div class='box-body'>" +
                    "<form id='partyCreationForm' name='partyCreationForm' role='form' method='post' action='' onSubmit='return false'>" +
                    "<fieldset>" +
                    "<legend onclick=''>Party Information</legend>" +
                    "<div id='PartyDiv'>" +
                    "<div id='' class='pull-left col-xs-12 col-sm-6 col-md-6' style='display:none;'>" +
                    "<label>Type Of Party</label>" +
                    "<input id='typeOfParty' name='typeOfParty' type='text' value='" + type + "' class='form-control' placeholder=''>" +
                    "</div>" +
                    "<div id='' class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label>Company Name</label>" +
                    "<input id='CompanyName' name='CompanyName' type='text' class='form-control' placeholder='Company Name'>" +
                    "</div>" +
                    "<div id='' class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label>Contact Person</label>" +
                    "<input id='ContactPerson' name='ContactPerson' type='text' class='form-control' placeholder='Contact Person Name'>" +
                    "</div>" +
                    "<div id='' class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label>Address</label>" +
                    "<textarea id='Address' name='Address' class='form-control' rows='3' cols='5' placeholder='Address ...' style='height: 114px;'></textarea>" +
                    "</div>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label>Phone</label>" +
                    "<input id='ContactNumber' name='ContactNumber' type='text' class='form-control' data-inputmask=''mask': '9999-9999999'' data-mask style='width: 290px;'>" +
                    "</div>" +
                    "<div id='' class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label for=''>Fax</label>" +
                    "<input id='Fax' name='Fax' type='text' class='form-control' placeholder='Fax'>" +
                    "</div>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label>Mobile</label>" +
                    "<input id='Mobile' name='Mobile' type='text' class='form-control' data-inputmask='mask: 9999-9999999' data-mask style='width: 290px;'>" +
                    "</div>" +
                    "<div id='' class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label for=''>NTN#</label>" +
                    "<input id='NtnNumber' name='NtnNumber' type='text' class='form-control' placeholder='NTN Number'>" +
                    "</div>" +
                    "<div id='' class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label for=''>STRN</label>" +
                    "<input id='STRN' name='STRN' type='text' class='form-control' placeholder='STRN'>" +
                    "</div>" +
                    "<div id='' class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label for=''>Email</label>" +
                    "<input id='Email' name='Email' type='text' class='form-control'placeholder='Email'>" +
                    "<div class='pull-right col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-emailpopup' style='width: 165px;margin-right:100px;'><label class='control-label' for='inputError'>Invalid Email Address!</label>" +
                    "</div>" +
                    "</div>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label>Party Type</label>" +
                    "<select id='idPartyType' name='idPartyType' class='form-control'>" +
                    "<option>Select Party Type</option>" + <?php foreach ($partyTypeCombo as $key) { ?>
                    "<option value = '<?php echo $key['Party_type_id'] ?>'><?php echo $key['PartyTypeName'] ?></option>" +<?php } ?>
                    "</select>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-partytypepopup' style='width: 170px;margin-left: 60px;'>" +
                    "<label class='control-label' for='inputError'>Select any Option!</label>" +
                    "</div>" +
                    "</div>" +
                    "<div class='pull-right col-xs-6 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<br><button id='SavePartyButton' type='submit' class='btn btn-primary' onclick='saveParty()' style='width: 75px;float: right;'>Save</button>" +
                    "</div>" +
                    "</div>" +
                    "</fieldset>" +
                    "</div>" +
                    "</form>" +
                    "</div>" +
                    "</div>" +
                    "</fieldset>"
        }
        );
                $('.modal-content').css({
            "width": '850px',
            "margin-left": '-115px'});
        $('.error-partyname').hide();
        $('.error-partytypepopup').hide();
        $('.error-emailpopup').hide();
    }

    function saveParty() {
        var isValidPopup = 1;
        var emailAddress = $('#Email').val();
        var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
        if (emailAddress !== "") {
            if (!re.test(emailAddress)) {
                $('.error-emailpopup').show();
                isValidPopup = 0;
                //                return false;
            }
        }
        if ($('#idPartyType').val() === "Select Party Type") {
            isValidPopup = 0;
            $('.error-partytypepopup').show();
        }

        if (isValidPopup === 1) {
            $('.error-partytypepopup').hide();
            $('.error-emailpopup').hide();
            var partyData = {};
            partyData['CompanyName'] = $('#CompanyName').val();
            partyData['ContactPerson'] = $('#ContactPerson').val();
            partyData['Address'] = $('#Address').val();
            partyData['Phone'] = $('#ContactNumber').val();
            partyData['Fax'] = $('#Fax').val();
            partyData['Mobile'] = $('#Mobile').val();
            partyData['Email'] = $('#Email').val();
            partyData['STRN'] = $('#STRN').val();
            partyData['NtnNumber'] = $('#NtnNumber').val();
            partyData['idPartyType'] = $('#idPartyType').val();
            partyData['typeOfParty'] = $('#typeOfParty').val();
            $.ajax({
                url: "<?= base_url() ?>index.php/purchasecontract/save",
                type: "POST",
                data: {data: partyData},
                success: function(data) {
                    if (data !== "") {
                        bootbox.alert(data, function(result) {
                        });
                        updateCombo(partyData['typeOfParty']);
                    } else {
                    }
                }
            });
            $('#SavePartyButton').addClass('bootbox-close-button close');
        }
    }

    function updateCombo(partyType) {
        $.ajax({
            url: "<?= base_url() ?>index.php/purchasecontract/reloadCombo",
            type: "POST",
            data: {data: partyType},
            success: function(data) {
                if (data.length > 0) {
                    var parsedData = JSON.parse(data);
                    if (partyType === "Mill") {
                        $("#idMill").html('');
                        $("#idMill").append($("<option>Select Mill</option>"));
                        $.each(parsedData, function(index, name) {
                            $("#idMill").append($("<option></option>").val(name['Party_id']).html(name['CompanyName']));
                        });
                    } else {
                        if (partyType === "Broker") {
                            $("#idBroker").html('');
                            $("#idBroker").append($("<option>Select Broker</option>"));
                            $.each(parsedData, function(index, name) {
                                $("#idBroker").append($("<option></option>").val(name['Party_id']).html(name['CompanyName']));
                            });
                        }
                    }
                }
            }});
        $('#SavePartyButton').addClass('bootbox-close-button close');
    }

    function printPC(val) {
        window.open("<?php echo base_url(); ?>index.php/purchasecontract/printpc/" + val + "",
                '_blank'
                );
        window.location.reload();
    }
    
    function downloadCSV(val) {
        window.open(
                "<?php echo base_url(); ?>index.php/purchasecontract/downloadCSV/" + val + "",
                '_blank'
                );
    }

    function onPressEnter(id) {

        $(id).bind("keypress", function(e) {
            if (e.keyCode == 13) {
                return false;
            }
        });
    }

    function getFormatedDate(dateVal) {
        var DateIs = new Date(dateVal);
        var Day = DateIs.getDate();
        var Month = DateIs.getMonth() + 1;
        var Year = DateIs.getFullYear();
        if (Month < 10) {
            Month = "0" + Month;
        }
        if (Day < 10) {
            Day = "0" + Day;
        }
        var formatedDate = Day + "-" + Month + "-" + Year;
        return formatedDate;
    }

    function checkDecimal(inputtxt) {
//        var decimal = /^\d+\.?\d*$/;
        var decimal = /^\d+\.?\d*$/;
        if (inputtxt.match(decimal))
        {
            return true;
        }
        else
        {
            return false;
        }
//        old RegEx
//        var decimal = /^[-+]?[0-9,]+\.[0-9]+$/;
    }

    function validationForm() {
        var isValidate = 1;
        var broker = $('#idBroker').val();
        var count = $('#idCount').val();
        var mill = $('#idMill').val();
        var cartage = $('#Cartage').val();
        var contractDate = $("#ContractDate").val();
        var rate = $("#Rate").val();
        var noOfBags = $("#NoOfBags").val();
        var gstPercent = $('#GSTPercent').val();
//        var totalWeight = $('#TotalWeight').val();
//        var contractAmount = $('#ContractAmount').val();

        if (contractDate === "" && rate === "" && noOfBags === "" && broker === "Select Broker" && count === "Select Count" && mill === "Select Mill" && cartage === "Select Cartage") {
            $(".error-brokertype").show();
            $(".error-counttype").show();
            $(".error-milltype").show();
            $(".error-cartagetype").show();
            $(".error-pcdate").show();
            $(".error-rate").show();
            $(".error-noofbags").show();
            isValidate = 0;
        } else {
            $(".error-brokertype").hide();
            $(".error-counttype").hide();
            $(".error-milltype").hide();
            $(".error-cartagetype").hide();
            $(".error-pcdate").hide();
            $(".error-rate").hide();
            $(".error-noofbags").hide();
            if ((contractDate === "") || (rate === "") || (noOfBags === "") || (broker === "Select Broker") || (count === "Select Count") || (mill === "Select Mill") || (cartage === "Select Cartage")) {

                if (contractDate === "") {
                    $(".error-pcdate").show();
                } else {
                    $(".error-pcdate").hide();
                }
                if (rate === "") {
                    $(".error-rate").show();
                } else {
                    $(".error-rate").hide();
                }
                if (noOfBags === "") {
                    $(".error-noofbags").show();
                } else {
                    $(".error-noofbags").hide();
                }
                if (broker === "Select Broker") {
                    $(".error-brokertype").show();
                } else {
                    $(".error-brokertype").hide();
                }
                if (count === "Select Count") {
                    $(".error-counttype").show();
                } else {
                    $(".error-counttype").hide();
                }
                if (mill === "Select Mill") {
                    $(".error-milltype").show();
                } else {
                    $(".error-milltype").hide();
                }
                if (cartage === "Select Cartage") {
                    $(".error-cartagetype").show();
                } else {
                    $(".error-cartagetype").hide();
                }
                isValidate = 0;
            }
            if ((!$("#ContractDate").inputmask("isComplete")) || (contractDate === "00-00-0000") || (contractDate === "01-01-1970")) {
                isValidate = 0;
                $(".error-pcdate").html("<label>Enter valid Date</label>").show();
            } else {
                $(".error-pcdate").hide();
            }
            if(rate != ""){
                    if (rate.indexOf(',') > -1) {
                      rate = rate.replace(/,/g, "");
                    }
                    if ((!checkDecimal(rate)) || (rate <= 0))
                    {
                        isValidate = 0;
                        $(".error-rate").show();
                    }
                    else
                    {
                      $(".error-rate").hide();
                    }
            }
           
            if ((!checkDecimal(noOfBags)) || (noOfBags <= 0))
            {
                isValidate = 0;
                $(".error-noofbags").show();
            }
            else
            {
                $(".error-noofbags").hide();
            }
            if (gstPercent != "") {
                if ((!checkDecimal(gstPercent)))
                {
                    isValidate = 0;
                    $(".error-contractamount").show();
                }
                else
                {
                    $(".error-contractamount").hide();
                }
            }


//            if ((!checkDecimal(totalWeight)) || (totalWeight <= 0))
//            {
//                isValidate = 0;
//                $(".error-totalweight").show();
//            }
//            else
//            {
//                $(".error-totalweight").hide();
//            }
//
//            if ((!checkDecimal(contractAmount)) || (contractAmount <= 0))
//            {
//                isValidate = 0;
//                $(".error-contractamount").show();
//            }
//            else
//            {
//                $(".error-contractamount").hide();
//            }


        }
        if (isValidate === 0) {
            return false;
        } else {
            return true;
        }
    }

    $("#partyCreationForm").submit(function() {
        saveParty();
    });

    $('#Rate').focusout(function() {

        var noOfBags = $('#NoOfBags').val();
        var rate = $(this).val();
        var contractAmount = "";
        $('#Rate').val(fractionNotation(rate, 2));
        if (rate == "") {
            rate = 0.00;
        } else {
            if (rate.indexOf(',') > -1) {
                rate = rate.replace(/,/g, "");
            }
        }
        if (noOfBags == "") {
            noOfBags = 0.00;
        }
        $('#TotalWeight').val(noOfBags * 100);
        $('#TotalWeight').val(fractionNotation($('#TotalWeight').val(), 2));
        contractAmount = noOfBags * rate * 10;

        $('#ContractAmount').val(contractAmount);
        $('#ContractAmount').val(fractionNotation(contractAmount, 2));
        contractAmount = $('#ContractAmount').val();
        if (contractAmount == "") {
          contractAmount = 0.00;
        }
        else {
            if (contractAmount.indexOf(',') > -1) {
                contractAmount = contractAmount.replace(/,/g, "");
            }
        }
        var gstPercent = $('#GSTPercent').val();
        if (gstPercent == "") {
            gstPercent = 0.00;
        }
        var gstrate = parseFloat(gstPercent) / 100;
        var gstAmount = parseFloat(gstrate) * parseFloat(contractAmount);
        var contractAmountGST = parseFloat(contractAmount) + parseFloat(gstAmount);
        $('#GSTAmount').val(gstAmount);
        $('#GSTAmount').val(fractionNotation(gstAmount, 2));
        $('#ContractAmountGST').val(contractAmountGST);
        $('#ContractAmountGST').val(fractionNotation(contractAmountGST, 2));
    });

    $('#NoOfBags').focusout(function() {
        var noOfBags = $(this).val();
        var rate = $('#Rate').val();
        $('#Rate').val(fractionNotation(rate, 2));
        var contractAmount = "";
        if (rate == "") {
            rate = 0.00;
        } else {
            if (rate.indexOf(',') > -1) {
                rate = rate.replace(/,/g, "");
            }
        }
        if (noOfBags == "") {
            noOfBags = 0.00;
        }
        $('#TotalWeight').val(noOfBags * 100);
        $('#TotalWeight').val(fractionNotation($('#TotalWeight').val(), 2));
        contractAmount = noOfBags * rate * 10;
        $('#ContractAmount').val(contractAmount);
        $('#ContractAmount').val(fractionNotation(contractAmount, 2));
        contractAmount = $('#ContractAmount').val();
        if (contractAmount == "") {
          contractAmount = 0.00;
        }
        else {
            if (contractAmount.indexOf(',') > -1) {
                contractAmount = contractAmount.replace(/,/g, "");
            }
        }
        var gstPercent = $('#GSTPercent').val();
        if (gstPercent == "") {
            gstPercent = 0.00;
        }
        var gstrate = parseFloat(gstPercent) / 100;
        var gstAmount = parseFloat(gstrate) * parseFloat(contractAmount);
        var contractAmountGST = parseFloat(contractAmount) + parseFloat(gstAmount);
        $('#GSTAmount').val(gstAmount);
        $('#GSTAmount').val(fractionNotation(gstAmount, 2));
        $('#ContractAmountGST').val(contractAmountGST);
        $('#ContractAmountGST').val(fractionNotation(contractAmountGST, 2));
    });

    $('#GSTPercent').focusout(function() {
        var contractAmount = $('#ContractAmount').val();
        if (contractAmount == "") {
            contractAmount = 0.00;
        }
        else {
            if (contractAmount.indexOf(',') > -1) {
                contractAmount = contractAmount.replace(/,/g, "");
            }
        }
        var gstPercent = $(this).val();
        if (gstPercent == "") {
            gstPercent = 0.00;
        }

        var gstrate = 0.00;
        gstrate = parseFloat(gstPercent) / 100;
        var gstAmount = parseFloat(gstrate) * parseFloat(contractAmount);
        var contractAmountGST = parseFloat(contractAmount) + parseFloat(gstAmount);
        $('#GSTAmount').val(gstAmount);
        $('#GSTAmount').val(fractionNotation(gstAmount, 2));
        $('#ContractAmountGST').val(contractAmountGST);
        $('#ContractAmountGST').val(fractionNotation(contractAmountGST, 2));
    });


//      Old Before Zeeshan
//    $('#Rate').focusout(function() {
//        var noOfBags = $('#NoOfBags').val();
//        var rate = $(this).val();
//        var contractAmount = "";
////                                                    rate = numeral(rate).format('0,0');
//        $(this).val(rate);
//        $('#Rate').val(fractionNotation(rate, 2));
//        if (rate === "") {
//            rate = 0.00;
//        } else {
//            rate = rate.replace(/,/g, "");
//        }
//        if (noOfBags === "") {
//            noOfBags = 0.00;
//        }
//        $('#TotalWeight').val(noOfBags * 100);
//        contractAmount = noOfBags * rate * 10;
//        contractAmount = numeral(contractAmount).format('0,0');
//        $('#ContractAmount').val(contractAmount);
////        $('#ContractAmount').priceFormat({
////            prefix: '',
////            centsSeparator: ',',
////            thousandsSeparator: ','
////        });
//    });
//    $('#NoOfBags').focusout(function() {
//        var noOfBags = $(this).val();
//        var rate = $('#Rate').val();
//        var contractAmount = "";
//        if (rate === "") {
//            rate = 0.00;
//        } else {
////            rate = numeral(rate).format('0,0');
//            $('#Rate').val(rate);
//            rate = rate.replace(/,/g, "");
//        }
//        if (noOfBags === "") {
//            noOfBags = 0.00;
//        }
//        $('#TotalWeight').val(noOfBags * 100);
//        contractAmount = noOfBags * rate * 10;
////        contractAmount = numeral(contractAmount).format('0,0');
//        $('#ContractAmount').val(contractAmount);
//    });



</script>