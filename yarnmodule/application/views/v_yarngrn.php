<?php
include 'include/leftmenu.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->

<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Good Receiving Note
        </h1><br><br>
        <div class="row">
            <div class="pull-right" style="padding-right:15px;">
                <a class="btn btn-app" onclick="retrivePopup()">
                    <i class="fa fa-align-justify"></i> Retrieve                  
                </a>
                <a class="btn btn-app" onclick="reloadForm()">
                    <i class="fa fa-adn"></i> New                  
                </a>                                                
                <a id="EditAnchor" class="btn btn-app" onclick="ediForm('Null', 'editmenu')"> 
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a class="btn btn-app" onclick="resetForm()">
                    <i class="fa fa-repeat"></i> Reset
                </a>
                <a d="PrintAnchor" class="btn btn-app" onclick="printGrn($('#GRNNumber').val())">
                    <i class="fa fa-print"></i> Print
                </a>
                <a d="PrintAnchor" class="btn btn-app" onclick="downloadCSV($('#GRNNumber').val())">
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
                    <form id="yarnGrnForm" name="yarnGrnForm" role="form" method="post" action="<?= base_url() ?>index.php/yarngrn/Add"  onSubmit="return validationForm()"> 
                        <fieldset>
                            <legend onclick="">GRN Information</legend>
                            <div id="FlashMessage">
                                <h5 style=""><?= $insertMessage ?></h5>
                                <h5 style=""><?= $updateMessage ?></h5>
                                <h5 style=""><?= $deleteMessage ?></h5>
                            </div>  
                            <div id="GeneralDiv">
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="display: none;">
                                    <label for="">Purchase Contract ID</label>
                                    <input id="PCID" name="PCID" type="text" class="form-control" placeholder="Purchase Contract Number">
                                </div> 
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="display: none;">
                                    <label for="">GRN ID</label>
                                    <input id="GRNID" name="GRNID" type="text" class="form-control" placeholder="GRN ID">
                                </div> 
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Challan Date</label>
                                    <div class="input-group" style="width: 150px;">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input id="ChallanDate" name="ChallanDate" type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                                    </div>
                                    <div class="form-group has-error form-error error-chalandate" style="width: 100px;margin-left: 60px;">
                                        <label class="control-label" for="inputError">Enter Date!</label>
                                    </div>
                                </div>                   
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Challan No.</label>
                                    <input id="ChallanNumber" name="ChallanNumber" type="text" class="form-control" placeholder="Challan Number">
                                </div>
                                <div id="" class="pull-left col-xs-10 col-sm-5 col-md-5" style="width: 250px;margin-top: 20px;">
                                    <label for="">PC#</label>
                                    <input id="PCNo" name="PCNo" type="text" class="form-control" placeholder="Purchase Contract Number" readonly>
                                </div> 
                                <div class="pull-left col-xs-2 col-sm-1 col-md-1" style="margin-top: 50px;">
                                    <label for="" style="width: 75px;margin-top: 0px;margin-left: 0px;"><a onclick="retrivePurchaseContractPopup()">Select PC#</a></label>                                                              
                                </div>
<!--                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">PC#</label>
                                    <input id="PCNo" name="PCNo" type="text" class="form-control" placeholder="Purchase Contract Number">
                               </div> 
                                <div class="pull-left col-xs-2 col-sm-1 col-md-1" style="margin-top: 50px;">
                                    <label for="" style="width: 60px;margin-top: 0px;margin-left: 0px;"><a onclick="retrivePurchaseContractPopup()">Select PC#</a></label>                                                              
                                </div>-->
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Balance (lbs)</label>
                                    <input id="Balance" name="Balance" type="text" class="form-control" placeholder="0.00" readonly>
                                </div>   
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Broker</label>
                                    <input id="Broker" name="Broker" type="text" class="form-control" placeholder="" readonly>
                                </div>
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;"> 
                                    <label for="">Mill</label>
                                    <input id="Mill" name="Mill" type="text" class="form-control" placeholder="" readonly>
                                </div>
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Count</label>
                                    <input id="Count" name="Count" type="text" class="form-control" placeholder="" readonly>
                                </div><br>   
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;" readonly> 
                                    <label for="">Brand</label>
                                    <input id="Brand" name="Brand" type="text" class="form-control" placeholder="" readonly>
                                </div>  
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Contract Date</label>
                                    <div class="input-group" style="width: 150px;">
                                        <!--                                        <div class="input-group-addon">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </div>-->
                                                                                <!--<input id="ContractDate" name="ContractDate" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask placeholder="dd-mm-yyyy" readonly>-->
                                        <input id="ContractDate" name="ContractDate" type="text" class="form-control" readonly>

                                    </div>
                                </div>  
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Seller Contract No.</label>
                                    <input id="SellerContractNumber" name="SellerContractNumber" type="text" class="form-control" placeholder="" readonly>
                                </div>   
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">No. Of Bags</label>
                                    <input id="NoOfBags" name="NoOfBags" type="text" value="" class="form-control" placeholder="0.00">
                                </div>   
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Packing (lbs)</label>
                                    <input id="Packing" name="Packing" type="text" value="" class="form-control" placeholder="0.00">
                                </div> 
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Total Weight (lbs)</label>
                                    <input id="TotalWeight" name="TotalWeight" type="text" value="" class="form-control" placeholder="0.00" readonly>
                                </div>  
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">GRN#</label>
                                    <input id="GRNNumber" name="GRNNumber" type="text" value="<?php echo $grnNumber ?>" class="form-control" placeholder="" readonly>
                                </div>   
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Short Weight (lbs)</label>
                                    <input id="ShortWeight" name="ShortWeight" type="text" value="" class="form-control" placeholder="0.00">
                                </div>  
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Net Weight (lbs)</label>
                                    <input id="NetWeight" name="NetWeight" type="text" value="" class="form-control" placeholder="0.00" readonly>
                                </div>
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;display: none">
                                    <label for="">Weight Receive</label>
                                    <input id="WeightRecieved" name="WeightRecieved" type="text" value="" class="form-control" placeholder="0.00" readonly>
                                </div>
                                <div id="" class="pull-left col-xs-10 col-sm-5 col-md-5" style="margin-top: 20px;">
                                    <label for="">Warehouse</label>
                                    <select id="warehouse" name="warehouse" class="form-control" style="">
                                        <option>Select Warehouse</option>
                                        <?php
                                        foreach ($warehouseCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['Warehouse_id'] ?>"><?php echo $key['WarehouseName'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <input id="printDocument" name="printDocument" type="hidden" value="">
                                </div>
                                <div class="pull-right col-xs-2 col-sm-1 col-md-1"style="margin-top: 50px;">
                                    <input id="AddToGrn" type="button" value="Add to GRN" class="btn btn-primary" onclick="populateGridRows();" style="width: 100px;margin-left: -75px;" disabled>
                                </div>                           
                            </div>
                            <!-- /.box -->
                        </fieldset>                
                        <fieldset>
                            <br><br><div class="box-body table-responsive">
                                <legend onclick="">Purchase Contracts</legend><br>                              
                                <div id="PurchaseContractTable" class="box col-md-12"  style="margin-top: 0px;margin-left: 0px;width:685px;overflow-x: scroll;">                           
                                    <table id="GrnGrid" class="table table-bordered table-striped" style="margin-left: 0px;">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>PC#</th>
                                                <th>No. Of Bags</th>
                                                <th>Packing (lbs)</th>
                                                <th>Total Weight (lbs)</th>
                                                <th>Short Weight (lbs)</th>
                                                <th>Net Weight (lbs)</th>
                                                <th>Warehouse</th>
                                                <th>Del</th>
                                            </tr>
                                        </thead>
                                        <tbody id="GrnTbody">
                                        </tbody>
                                        <tfoot>
                                            <tr>          
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><br>
                                <div class="pull-right col-md-6" style="margin-top: 20px;">
                                    <br><button id="SaveGRNButton" type="submit" class="btn btn-primary" style="width: 75px;float: right;" disabled>Save</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<script>

    $(document).ready(function() {
        $(".form-error").hide();
        formMode = "Add";
        $('#EditAnchor').attr("disabled", "disabled");
        $('#PrintAnchor').attr("disabled", "disabled");
        $('#FlashMessage').fadeOut(5000);
        $("#ChallanDate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        $("#ContractDate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        // On Pressing Enter, Preventing Default Functionality
        onPressEnter('#yarnGrnForm');
        onPressEnter('#yarnGrnFormEdit');
        onPressEnter('#partyCreationForm');
        <?php
            if (strval($operation) == "1" || strval($operation) == "2")
            {
                echo "bootbox.confirm('Do you want to print last saved document', function(result) {
                        if (result) {
                            printGrn($grnNo);
                        }
                        else {
                            printGrn($grnNo);
                        }
                    });";
            }
            ?>            
    });  
    
    function PrintConfirmation() {
        bootbox.confirm("Do you want to print this document", function(result) {
            if (result) {
                $('#printDocument').val() = 1;
            }
            else {
               $('#printDocument').val() = 0;
            }
        });        
    }

    function retrivePurchaseContractPopup() {

        formMode = "Retrieve";
            //$("#EditAnchor").removeAttr("disabled");
            //$("#PrintAnchor").removeAttr("disabled");
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
                    "<input id='searchPurchaseContract'name='searchPurchaseContract'type='text'class='form-control' onkeyup='searchPC()' placeholder='Search by PC Number' style='width:200px;margin-left:-100px;'>" +
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
                    "<tbody id='PurchaseContractTbody'>" +<?php
                                        foreach ($pcList as $key) {
                                            $isOpened = "";
                                            if ($key['isClosed'] === '0') {
                                                $isOpened = "Opened";
                                            }
                                            ?>
                "<tr>" +
                        "<td><?= $key['PurchaseContractNo'] ?></td>" +
                        "<td><?= $key['Broker'] ?></td>" +
                        "<td><?= $key['CountName'] ?></td>" +
                        "<td><?= $key['Mill'] ?></td>" +
                        "<td><?= $key['Brand'] ?></td>" +
                        "<td><?= $key['SellerContractNo'] ?></td>" +
                        "<td><?= $key['ContractDate'] ?></td>" +
                        "<td><?= number_format($key['Rate']) ?></td>" +
                        "<td><?= $key['Bags'] ?></td>" +
                        "<td><?= number_format($key['TotalWeight']) ?></td>" +
                        "<td><?= number_format($key['ContractAmount']) ?></td>" +
                        "<td><?= number_format($key['ContractAmountGST']) ?></td>" +
                        "<td><?= $key['PaymentTerms'] ?></td>" +
                        "<td><?= $isOpened ?></td>" +
                        "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =getpurchasecontract('<?= rawurlencode($key['PurchaseContractNo']) ?>')>Select</a>" +
                        "</td>" +
                        "</tr>" +<?php } ?>
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
    
    function searchPC() {
            var items = [];
            var PCStatus = "";
            var searchValue = $('#searchPurchaseContract').val();
            if (searchValue === "") {                
                <?php foreach ($pcList as $key) {
                        $isOpened = "";
                        if ($key['isClosed'] === '0') {
                            $isOpened = "Opened";
                         }
                 ?>
                items += "<tr>" +
                    "<td><?= $key['PurchaseContractNo'] ?></td>" +
                    "<td><?= $key['Broker'] ?></td>" +
                    "<td><?= $key['CountName'] ?></td>" +
                    "<td><?= $key['Mill'] ?></td>" +
                    "<td><?= $key['Brand'] ?></td>" +
                    "<td><?= $key['SellerContractNo'] ?></td>" +
                    "<td><?= $key['ContractDate'] ?></td>" +
                    "<td><?= number_format($key['Rate']) ?></td>" +
                    "<td><?= $key['Bags'] ?></td>" +
                    "<td><?= number_format($key['TotalWeight']) ?></td>" +
                    "<td><?= number_format($key['ContractAmount']) ?></td>" +
                    "<td><?= number_format($key['ContractAmountGST']) ?></td>" +
                    "<td><?= $key['PaymentTerms'] ?></td>" +
                    "<td><?= $isOpened ?></td>" +
                    "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =getpurchasecontract('<?= rawurlencode($key['PurchaseContractNo']) ?>')>Select</a>" +
                    "</td>" +
                    "</tr>";<?php } ?>
                $("#PurchaseContractTbody").html(items);
            } else
            {
                $.ajax({
                    url: "<?= base_url() ?>index.php/purchasecontract/notClosedPC",
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
                                                "<td><a data-dismiss='modal' style='cursor: pointer;' onclick=getpurchasecontract(" + val.PurchaseContractNo + ")>Select</a>" +
                                                "</td>" +
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

    //$('#PCNo').focusout(function() {
    function getpurchasecontract(pcNumber) {
        //var pcNumber = $('#PCNo').val();
        //alert(pcNumber);
        if (pcNumber !== "") {
            $.ajax({
                url: "<?= base_url() ?>index.php/purchasecontract/search",
                type: "POST",
                data: {search: pcNumber},
                success: function(data) {
                if (data !== "null") {
                    var parsedData = JSON.parse(data);
                    if (parsedData.length > 0) {
                        enableElements('#AddToGrn');
                        try {
                            $('#PCID').val(parsedData[0]['Purchase_contract_id']);
        //                  $('#Balance').val(parsedData[0]['WeightRemaining']);
                            $('#PCNo').val(pcNumber);
                            $('#Broker').val(parsedData[0]['Broker']);
                            $('#Mill').val(parsedData[0]['Mill']);
                            $('#Count').val(parsedData[0]['CountName']);
                            $('#Brand').val(parsedData[0]['Brand']);
                            $('#ContractDate').val(getFormatedDate(parsedData[0]['ContractDate']));
                            $('#SellerContractNumber').val(parsedData[0]['SellerContractNo']);
                            $('#NoOfBags').val('');
                            $('#Packing').val('');
                            $('#TotalWeight').val('');
                            $('#ShortWeight').val('');
                            $('#NetWeight').val('');
                        }
                        catch (e) {
                            console.log(e);
                        }
                        getPCBalance(parsedData[0]['Purchase_contract_id'], parsedData[0]['TotalWeight']);
                    }
                    else {
                        $('#PCNo').val('');
                        $('#PCID').val('');
                        $('#Broker').val('');
                        $('#Balance').val('');
                        $('#Mill').val('');
                        $('#Count').val('');
                        $('#Brand').val('');
                        $('#ContractDate').val('');
                        $('#SellerContractNumber').val('');
                        $('#NoOfBags').val('');
                        $('#Packing').val('');
                        $('#TotalWeight').val('');
                        $('#ShortWeight').val('');
                        $('#NetWeight').val('');
                        bootbox.alert("No Purchase Contract Exist or Opened of this Number!", function(result) {});
                    }
                    
                }                
            }
        });
       }
    }
    
    $('#NoOfBags').focusout(function() {
        var noOfBags = $(this).val();
        var packing = $('#Packing').val();
        var totalWeight = $("#TotalWeight").val();
        var shortWeight = $("#ShortWeight").val();
        var netWeight = $("#NetWeight").val();
        if (packing === "") {
        packing = 0.00;
        }
        else {
        packing = packing.replace(/,/g, "");
        }
        if (noOfBags === "") {
        noOfBags = 0.00;
        }
        if (totalWeight === "") {
        totalWeight = 0.00;
        } else {
        totalWeight = totalWeight.replace(/,/g, "");
        }
        if (shortWeight === "") {
        shortWeight = 0.00;
        }
        else {
        shortWeight = shortWeight.replace(/,/g, "");
        }
        if (netWeight === "") {
        netWeight = 0.00;
        }
        totalWeight = [parseFloat(noOfBags) * parseFloat(packing)];
        netWeight = [parseFloat(totalWeight) - parseFloat(shortWeight)];
        $('#TotalWeight').val(totalWeight);
        $('#TotalWeight').val(fractionNotation($('#TotalWeight').val(), 2));
        $('#NetWeight').val(netWeight);
        $('#NetWeight').val(fractionNotation($('#NetWeight').val(), 2));
    });
           
    $('#Packing').focusout(function() {
        var noOfBags = $("#NoOfBags").val();
        var packing = $(this).val();
        $(this).val(fractionNotation(packing, 2));
        var totalWeight = $("#TotalWeight").val();
        var shortWeight = $("#ShortWeight").val();
        var netWeight = $("#NetWeight").val();
        if (packing === "") {
            packing = 0.00;
        } else {
            packing = packing.replace(/,/g, "");
        }
        if (noOfBags === "") {
            noOfBags = 0.00;
        }
        if (totalWeight === "") {
            totalWeight = 0.00;
        }
        else {
            totalWeight = totalWeight.replace(/,/g, "");
        }
        if (shortWeight === "") {
            shortWeight = 0.00;
        }
        else {
            shortWeight = shortWeight.replace(/,/g, "");
        }
        if (netWeight === "") {
            netWeight = 0.00;
        }
        totalWeight = [parseFloat(noOfBags) * parseFloat(packing)];
        netWeight = [parseFloat(totalWeight) - parseFloat(shortWeight)];
        $('#TotalWeight').val(totalWeight);
        $('#TotalWeight').val(fractionNotation($('#TotalWeight').val(), 2));
        $('#NetWeight').val(netWeight);
        $('#NetWeight').val(fractionNotation($('#NetWeight').val(), 2));
    });
    
    $('#ShortWeight').focusout(function() {
        var totalWeight = $("#TotalWeight").val();
        var shortWeight = $(this).val();
        $(this).val(fractionNotation(shortWeight, 2));
        if (totalWeight === "") {
            totalWeight = 0.00;
        }
        else {
            totalWeight = totalWeight.replace(/,/g, "");
        }
        if (shortWeight === "") {
            shortWeight = 0.00;
        }
        else {
            shortWeight = shortWeight.replace(/,/g, "");
        }
        $('#NetWeight').val(parseFloat(totalWeight) - parseFloat(shortWeight));
        $('#NetWeight').val(fractionNotation($('#NetWeight').val(), 2));
    });
            
    function getPCBalance(pcID, totalWeight) {

            var balance = 0.00;
                    var totalNetWeight = 0.00;
                    var pcTotalWeight = totalWeight;
                    $.ajax({
                    url: "<?= base_url() ?>index.php/yarngrn/getTotalNetWeight",
                            type: "POST",
                            data: {pcID: pcID},
                            success: function(data) {
                            if (data !== "null")
                            {
                            var parsedData = JSON.parse(data);
                                    if (parsedData.length > 0) {
                            try {
                            totalNetWeight = parsedData[0]['TotalNetWeight'];
                                    balance = pcTotalWeight - totalNetWeight;
//                          balance = balance.toFixed(2);
                                    $('#Balance').val(balance);
                                    $('#Balance').val(fractionNotation(balance, 2));
                            } catch (e) {
                            console.log(e);
                            }
                            }
                            }
                            }
                    });
            }

    var grnCount = 0;
    function populateGridRows() {
        var Balance = $('#Balance').val();
        var packing = $('#Packing').val()
        var NetWeight = $('#NetWeight').val();
        var shortWeight = $('#ShortWeight').val();
        var pcNumber = $('#PCNo').val();
        var warehouse = $('#warehouse :selected').val();
        var isExist = 1;
        var items = [];
        if (Balance.indexOf(',') > - 1) {
            Balance = Balance.replace(/,/g, "");
        }
        if (packing.indexOf(',') > - 1) {
            packing = packing.replace(/,/g, "");
        }
        if (NetWeight.indexOf(',') > - 1) {
            NetWeight = NetWeight.replace(/,/g, "");
        }
        if (shortWeight.indexOf(',') > - 1) {
            shortWeight = shortWeight.replace(/,/g, "");
        }

        if (!checkDecimal($('#NoOfBags').val())) {
            isExist = 0;
            bootbox.alert("Input value Must be a Numeric or Decimal", function(result) {
            });
            return false;
        }
        if (!checkDecimal(packing)) {
        isExist = 0;
                bootbox.alert("Input value Must be a Numeric or Decimal", function(result) {
                });
                return false;
        }
        if (shortWeight != "") {
        if (!checkDecimal(shortWeight)) {
        isExist = 0;
                bootbox.alert("Input value Must be a Numeric or Decimal", function(result) {
                });
                return false;
        }
        }

        if (parseFloat(NetWeight) > parseFloat(Balance)) {
        isExist = 0;
                bootbox.alert("GRN weight exceed from weight present in Purchase Contract", function(result) {
                });
                return false;
        } else {
//        var countRows = $("#GrnGrid> tbody").children().length;
//                if (countRows > 0) {
//        //var pcinput = $("#GrnGrid").find("input[name='PCNoDetail[]']");
//                for (var pcinputCount = 0; pcinputCount <= pcinput.length; pcinputCount++) {
//        if ($(pcinput[pcinputCount]).val() === pcNumber) {
//        isExist = 0;
//                bootbox.alert("This Purchase Contract Number is already exist in GRN Grid", function(result) {
//                });
//                return false;
//            }
//            }
//            }
            if ((NetWeight <= 0.00) || (NetWeight <= 0)) {
            isExist = 0;
                    bootbox.alert("Net-Weight Should be Greater than zero", function(result) {
                    });
                    return false;
            }

            if ((warehouse === "") || (warehouse === "Select Warehouse")) {
            isExist = 0;
                    bootbox.alert("Please Select Warehouse", function(result) {
                    });
                    return false;
            }
            }
            if (isExist === 1) {
            //grnCount = parseInt(grnCount) + 1;
            grnCount = parseInt($("#GrnGrid > tbody").children().length) + 1;
                    enableElements('#SaveGRNButton');
                    items += "<tr><td class='tbl-count'><input id='SerialNo' name='SerialNoDetail[]' value='" + grnCount + "' type = 'text' class='form-control sno' style = 'width: 50px;' placeholder = 'SNO' readonly></td>" +
                    "<td tag='' style='display:none'><input id='PCIDDetail' name='PCIDDetail[]' value='" + $('#PCID').val() + "' type = 'text' class='form-control' style = 'width: 0px;' placeholder = 'PCNo' readonly></td>" +
                    "<td tag=''><input id='PCNoDetail' name='PCNoDetail[]' value='" + pcNumber + "' type = 'text' class='form-control'  style = 'width: 100px;' placeholder = 'PCNo' readonly></td>" +
                    "<td tag=''><input id='NoOfBagsDetail' name='NoOfBagsDetail[]' value='" + $('#NoOfBags').val() + "' type = 'text' class='form-control' style='width:125px;' placeholder='0.00' onfocusout='calNoOfBags(this)'><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-noofbags' style='width:125px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be a Numeric or Decimal and Greater than Zero!</label></div></td>" +
                    "<td tag=''><input id='PackingDetail' name='PackingDetail[]' value='" + $('#Packing').val() + "' type = 'text' class='form-control' style='width: 125px;' placeholder='0.00' onfocusout='calPacking(this)'><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-packing' style='width:125px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be a Numeric or Decimal and Greater than Zero!</label></div></td>" +
                    "<td tag=''><input id='TotalWeightDetail' name='TotalWeightDetail[]' value='" + $('#TotalWeight').val() + "' type = 'text' class='form-control'  style='width: 150px;' placeholder='0.00' readonly><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-totalweight' style='width:150px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be a Numeric or Decimal and Greater than Zero!</label></div></td>" +
                    "<td tag=''><input id='ShortWeightDetail' name='ShortWeightDetail[]' value='" + $('#ShortWeight').val() + "' type = 'text' class='form-control' style='width: 150px;' placeholder='0.00' onfocusout='calShortWeight(this)'><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-shortweight' style='width:150px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be Numeric or Decimal!</label></div></td>" +
                    "<td tag=''><input id='NetWeightDetail' name='NetWeightDetail[]' value='" + $('#NetWeight').val() + "' type = 'text' class='form-control' style='width: 150px;' placeholder='0.00' readonly><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-netweight' style='width:150px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be a Numeric or Decimal and Greater than Zero!</label></div></td>" +
                    "<td tag=''><select id='idWarehouse' name='idWarehouse[]' class='form-control slctboxes' style = 'width: 170px;'><option value='select'>Select Warehouse</option><?php
                                        foreach ($warehouseCombo as $key) {
                                            ?><option " + (warehouse === '<?= $key['Warehouse_id'] ?>' ? "selected" : "") + " value='<?= $key['Warehouse_id'] ?>'><?= $key['WarehouseName'] ?></option><?php } ?></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-warehousecombo' style='width:170px;margin-left: 0px;display:none'><label class='control-label' for='inputError'>Select any Option!</label></div></td>" +
                    "<td tag='' style='display:none;'><input id='BalanceDetail' name='BalanceDetail[]' value='" + $('#Balance').val() + "' type = 'text' class='form-control' style='width:0px;display:none' placeholder='' readonly></td>" +
                    "<td tag='' style='display:none;'><input id='WeightReceivedDetail' name='WeightReceivedDetail[]' value='" + $('#WeightRecieved').val() + "' type = 'text' class='form-control' style='width:0px;display:none' placeholder='' readonly></td>" +
                    "<td tag=''><input id='DelButton' name='DelButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='X' onclick='deleteGridRows(this)' readonly></td></tr>";
                    $('#GrnTbody').append(items);
                    $('#PCID').val('');
                    $('#PCNo').val('');
                    $('#ContractDate').val('');
                    $('#Balance').val('0.00');
                    $('#Broker').val('');
                    $('#Mill').val('');
                    $('#Count').val('');
                    $('#Brand').val('');
                    $('#SellerContractNumber').val('');
                    $('#NoOfBags').val('0.00');
                    $('#Packing').val('0.00');
                    $('#TotalWeight').val('0.00');
                    $('#ShortWeight').val('0.00');
                    $('#NetWeight').val('0.00');
                    $('#warehouse').val('Select Warehouse');
                    disableElements("#AddToGrn");
            }
            if (formMode === "Edit") {
            resetSNO();
            }
            }

    function deleteGridRows(r) {
    var i = r.parentNode.parentNode.rowIndex;
            document.getElementById('GrnGrid').deleteRow(i);
            grnCount = parseInt(grnCount) - 1;
            resetSNO();
    }

    function retrivePopup() {
    formMode = "Retrieve";
            $("#EditAnchor").removeAttr("disabled");
            $("#PrintAnchor").removeAttr("disabled");
            bootbox.dialog({
            title: "All Good Receiving Note(s)",
                    message:
                    "<fieldset>" +
                    "<div class='box box-primary'>" +
                    "<div class='box-body'>" +
                    "<form name='yarnGrnFormEdit' role='' method='' action='' class='margin-top:20px;'>" +
                    "<br>" +
                    "<div class='col-md-12'>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6' style='width:443px;margin-top:20px;'>" +
                    "<label>Search</label>" +
                    "<input id='searchYarnGrn' name='searchYarnGrn'type='text'class='form-control' placeholder='Search by GRN Number' style='width:200px;'>" +
                    "<input id='SearchNow' type='button' value='OK' class='btn btn-primary' onclick='search()' style='width: 100px;margin-left: 205px;margin-top:-58px;'>" +
                    "</div><br>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top:20px;'>" +
                    "<label>Chalan Date</label>" +
                    "<input id='ChalanDateEdit'name='ChalanDateEdit'type='text'class='form-control' placeholder='' style='width:200px' readonly>" +
                    "</div>" +
                    "<div class='pull-left col-xs-10 col-sm-5 col-md-5' style='margin-top:20px;'>" +
                    "<label>GRN</label>" +
                    "<input id='GRNNoEdit'name='GRNNoEdit'type='text'class='form-control' onkeyup='' placeholder='' style='width:200px;' readonly>" +
                    "</div>" +
                    "<div id='GrnDetailDiv' class='pull-left col-xs-2 col-sm-1 col-md-1' style='width:106px;margin-top:50px;margin-left:-100px;display:none;'>" +
                    "</div><br>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6' style=margin-top:20px;''>" +
                    "<label>Chalan Number</label>" +
                    "<input id='ChalanNumberEdit' name='ChalanNumberEdit'type='text'class='form-control' placeholder='' style='width:200px;' readonly>" +
                    "</div><br>" +
                    "</div>" +
                    "<fieldset>" +
                    "<div class='box-body table-responsive' style='margin-top:20px;'>" +
                    "<div class='box'>" +
                    "<table class='table table-bordered table-striped'>" +
                    "<thead>" +
                    "<tr>" +
                    "<th width='05%'>SNo.</th>" +
                    "<th width='20%'>PC-#</th>" +
                    "<th width='15%'>Bags</th>" +
                    "<th width='15%'>Packing</th>" +
                    "<th width='15%'>Total-Weight</th>" +
                    "<th width='15%'>Short-Weight</th>" +
                    "<th width='15%'>Net-Weight</th>" +
                    "<th width='15%'>Warehouse</th>" +
                    "</tr>" +
                    "</thead>" +
                    "<tbody id='YarnGrnTbody'>" +
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
    "width": '850px',
            "margin-left": '-100px'
    });
            onPressEnter('#searchYarnGrn');
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

    function ediForm(detailData, type) {
        if (type === 'editmenu') {
            formMode = "Edit";
            var action = "<?php echo base_url() ?>index.php/yarngrn/Update";
            enableElements("#PCID");
            enableElements("#GRNID");
            enableElements("#ChallanDate");
            enableElements("#ChallanNumber");
            enableElements("#PCNo");
            enableElements("#Balance");
            enableElements("#Broker");
            enableElements("#Mill");
            enableElements("#Count");
            enableElements("#Brand");
            enableElements("ContractDate");
            enableElements("#SellerContractNumber");
            enableElements("#NoOfBags");
            enableElements("#Packing");
            enableElements("#TotalWeight");
            enableElements("#GRNNumber");
            enableElements("#ShortWeight");
            enableElements("#NetWeight");
            enableElements("#SerialNo");
            //enableElements("#PCIDDetail");
            //enableElements("#PCNoDetail");
            enableElements("#NoOfBagsDetail");
            enableElements("#PackingDetail");
            enableElements("#TotalWeightDetail");
            enableElements("#ShortWeightDetail");
            enableElements("#NetWeightDetail");
            enableElements("#DelButton");
            enableElements("#warehouse");
            enableTable("#GrnGrid *");
            var countRows = $("#GrnGrid> tbody").children().length;
            if (countRows > 0) {
                enableElements('#SaveGRNButton');
            }
        document.getElementById("yarnGrnForm").action = action;
    } 
    else {
        var parsedData = JSON.parse(decodeURI(detailData));
        if (parsedData.length > 0) {
            $("#PCID").val(parsedData[0]['Purchase_contract_id']);
            $("#GRNID").val(parsedData[0]['Good_Receive_Note_id']);
            $("#GRNNumber").val(parsedData[0]['GRNNo']);
            $("#ChallanNumber").val(parsedData[0]['ChallanNo']);
            $("#ChallanDate").val(getFormatedDate(parsedData[0]['ChallanDate']));
            emptyAllFields("#PCNo");
            emptyAllFields("#Balance");
            emptyAllFields("#Broker");
            emptyAllFields("#Mill");
            emptyAllFields("#Count");
            emptyAllFields("#Brand");
            emptyAllFields("#ContractDate");
            emptyAllFields("#SellerContractNumber");
            emptyAllFields("#NoOfBags");
            emptyAllFields("#Packing");
            emptyAllFields("#TotalWeight");
            emptyAllFields("#ShortWeight");
            emptyAllFields("#NetWeight");
            var items = [];
            var sNO = 0;
            $.each(parsedData, function(i, val) {
            items += "<tr><td class='tbl-count'><input id='SerialNo' name='SerialNoDetail[]' value='" + sNO++ + "' type = 'text' class='form-control sno' style = 'width: 50px;' placeholder = 'PCNo' readonly></td>" +
                    "<td tag='' style='display:none'><input id='PCIDDetail' name='PCIDDetail[]' value='" + val.Purchase_contract_id + "' type = 'text' class='form-control' style = 'width: 0px;' placeholder = 'PCNo'></td>" +
                    "<td tag=''><input id='PCNoDetail' name='PCNoDetail[]' value='" + val.PurchaseContractNo + "' type = 'text' class='form-control'  style = 'width:100px;' placeholder = 'PCNo' readonly></td>" +
                    "<td tag=''><input id='NoOfBagsDetail' name='NoOfBagsDetail[]' value='" + val.Bags + "' type = 'text' class='form-control' style='width:125px;'placeholder='0.00' onfocusout='calNoOfBags(this)'><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-noofbags' style='width:125px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be a Numeric or Decimal and Greater than Zero!</label></div></td>" +
                    "<td tag=''><input id='PackingDetail' name='PackingDetail[]' value='" + fractionNotation(val.Packing, 2) + "' type = 'text' class='form-control' style='width: 125px;'placeholder='0.00' onfocusout='calPacking(this)'><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-packing' style='width:125px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be a Numeric or Decimal and Greater than Zero!</label></div></td>" +
                    "<td tag=''><input id='TotalWeightDetail' name='TotalWeightDetail[]' value='" + fractionNotation(val.TotalWeight, 2) + "' type = 'text' class='form-control'  style='width: 150px;' placeholder='0.00' readonly><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-totalweight' style='width:150px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be a Numeric or Decimal and Greater than Zero!</label></div></td>" +
                    "<td tag=''><input id='ShortWeightDetail' name='ShortWeightDetail[]' value='" + fractionNotation(val.ShortWeight, 2) + "' type = 'text' class='form-control' style='width: 150px;' placeholder='0.00' onfocusout='calShortWeight(this)'><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-totalweight' style='width:150px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be Numeric or Decimal!</label></div></td>" +
                    "<td tag=''><input id='NetWeightDetail' name='NetWeightDetail[]' value='" + fractionNotation(val.NetWeight, 2) + "' type = 'text' class='form-control' style='width:150px;' placeholder='0.00' readonly><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-netweight' style='width:150px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be a Numeric or Decimal and Greater than Zero!</label></div></td>" +
                    "<td tag=''><select id='idWarehouse' name='idWarehouse[]' class='form-control slctboxes' style = 'width: 170px;'><option value='select'>Select Warehouse</option><?php
            foreach ($warehouseCombo as $key) {
                    ?><option " + (val['Warehouse_id'] === '<?= $key['Warehouse_id'] ?>' ? "selected" : "") + " value='<?= $key['Warehouse_id'] ?>'><?= $key['WarehouseName'] ?></option><?php } ?></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-warehousecombo' style='width:170px;margin-left: 0px;display:none'><label class='control-label' for='inputError'>Select any Option!</label></div></td>" +
                    "<td tag='' style='display:none;'><input id='BalanceDetail' name='BalanceDetail[]' value='" + fractionNotation(val.Packing, 2) + "' type = 'text' class='form-control' style='width:0px;' placeholder='Net Weight' readonly></td>" +
                    "<td tag='' style='display:none;'><input id='WeightReceivedDetail' name='WeightReceivedDetail[]' value='" + fractionNotation(val.WeightRecieved, 2) + "' type = 'text' class='form-control' style='width:0px;' placeholder='Net Weight' readonly><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-netweight' style='width:0px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be a Numeric or Decimal and Greater than Zero!</label></div></td>" +
                    "<td tag=''><input id='DelButton' name='DelButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='X' onclick='deleteGridRows(this)' readonly></td></tr>";
            });
            $("#GrnTbody").html(items);
        }
            disableElements("#PCID");
            disableElements("#GRNID");
            disableElements("#ChallanDate");
            disableElements("#ChallanNumber");
            disableElements("#PCNo");
            disableElements("#Balance");
            disableElements("#Broker");
            disableElements("#Mill");
            disableElements("#Count");
            disableElements("#Brand");
            disableElements("ContractDate");
            disableElements("#SellerContractNumber");
            disableElements("#NoOfBags");
            disableElements("#Packing");
            disableElements("#TotalWeight");
            disableElements("#GRNNumber");
            disableElements("#ShortWeight");
            disableElements("#NetWeight");
            disableElements("#SerialNo");
            disableElements("#PCIDDetail");
            disableElements("#PCNoDetail");
            disableElements("#NoOfBagsDetail");
            disableElements("#PackingDetail");
            disableElements("#TotalWeightDetail");
            disableElements("#ShortWeightDetail");
            disableElements("#NetWeightDetail");
            disableElements("#DelButton");
            disableElements("#warehouse");
            disableTable("#GrnGrid *");
            resetSNO();
    }
    }

    function resetForm() {
    if (formMode === 'Retrieve' || formMode === 'Edit') {
        return true;
    } else {
    emptyAllFields("#PCID");
            emptyAllFields("#GRNID");
            emptyAllFields("#ChallanDate");
            emptyAllFields("#ChallanNumber");
            emptyAllFields("#PCNo");
            emptyAllFields("#Balance");
            emptyAllFields("#Broker");
            emptyAllFields("#Mill");
            emptyAllFields("#Count");
            emptyAllFields("#Brand");
            emptyAllFields("#ContractDate");
            emptyAllFields("#SellerContractNumber");
            emptyAllFields("#NoOfBags");
            emptyAllFields("#Packing");
            emptyAllFields("#TotalWeight");
            emptyAllFields("#GRNNumber");
            emptyAllFields("#ShortWeight");
            emptyAllFields("#NetWeight");
            emptyAllFields("#SerialNo");
            emptyAllFields("#PCIDDetail");
            emptyAllFields("#PCNoDetail");
            emptyAllFields("#NoOfBagsDetail");
            emptyAllFields("#PackingDetail");
            emptyAllFields("#TotalWeightDetail");
            emptyAllFields("#ShortWeightDetail");
            emptyAllFields("#NetWeightDetail");
            $('#warehouse').val('Select Warehouse');
    }
    }

    function emptyAllFields(element) {
        $(element).val("");
    }

    function search() {
    var searchValue = $('#searchYarnGrn').val();
    if (searchValue === "") {
        bootbox.alert("Please enter value to search for", function(result) {
    });
    } 
    else {
        $.ajax({
            url: "<?= base_url() ?>index.php/yarngrn/search",
            type: "POST",
            data: {search: searchValue},
            success: function(data) {
            if (data !== "null")
            {
                var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                try {
                    $("#GRNNoEdit").val(parsedData[0]['GRNNo']);
                    $("#ChalanDateEdit").val(getFormatedDate(parsedData[0]['ChallanDate']));
                    $("#ChalanNumberEdit").val(parsedData[0]['ChallanNo']);
                    $('#GrnDetailDiv').html("<span><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('" + encodeURI(data) + "','None')>Edit</a> | <a style='cursor: pointer'; href='<?= base_url() ?>index.php/yarngrn/Delete/" + parsedData[0]['Good_Receive_Note_id'] + "'>Delete</a></span>");
                    $('#GrnDetailDiv').show();
                    var items = [];
                    var counter = 0;
                    $.each(parsedData, function(i, val) {
                    counter = parseInt(counter) + 1;
                            items += "<tr>" +
                            "<td>" + counter + "</td>" +
                            "<td>" + val.PurchaseContractNo + "</td>" +
                            "<td>" + val.Bags + "</td>" +
                            "<td>" + fractionNotation(val.Packing, 2) + "</td>" +
                            "<td>" + fractionNotation(val.TotalWeight, 2) + "</td>" +
                            "<td>" + fractionNotation(val.ShortWeight, 2) + "</td>" +
                            "<td>" + fractionNotation(val.NetWeight, 2) + "</td>" +
                            "<td>" + val.WarehouseName + "</td>" +
                            "</tr>";
                    });
                    $("#YarnGrnTbody").html(items);
                } catch (e) {
                    console.log(e);
                }
                }
                else {
                    $('#GrnDetailDiv').html('');
                    $('#GrnDetailDiv').hide();
                    $("#GRNNoEdit").val('');
                    $("#ChalanDateEdit").val('');
                    $("#ChalanNumberEdit").val('');
                    $("#YarnGrnTbody").html("<tr><td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td></tr>");
                }
            }
            }
    });
    }
    }

    function disableElements(elementArray) {
        $(elementArray).prop("disabled", true);
    }

    function enableElements(elementArray) {
        $(elementArray).prop("disabled", false);
    }

    function doToggle(id) {
        $(id).toggle();
    }

    function disableTable(idTable) {
    $(idTable).attr("disabled", true);
    }

    function enableTable(idTable) {
    $(idTable).attr("disabled", false);
    }

    function printGrn(val) {
    window.open(
            "<?php echo base_url(); ?>index.php/yarngrn/printGrn/" + val + "",
            '_blank'
            );
    }

    function downloadCSV(val) {
        window.open(
            "<?php echo base_url(); ?>index.php/yarngrn/downloadCSV/" + val + "",
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

    function calNoOfBags(obj) {
    var noOfBags = $(obj).val();
            var packing = $(obj).closest("td").next().find('input').val();
            var totalWeight = $(obj).closest("td").next().next().find('input').val();
            var shortWeight = $(obj).closest("td").next().next().next().find('input').val();
            var netWeight = $(obj).closest("td").next().next().next().next().find('input').val();
            if (packing === "") {
    packing = 0.00;
    } else {
    packing = packing.replace(/,/g, "");
    }
    if (noOfBags === "") {
    noOfBags = 0.00;
    }
    if (totalWeight === "") {
    totalWeight = 0.00;
    } else {
    totalWeight = totalWeight.replace(/,/g, "");
    }
    if (shortWeight === "") {
    shortWeight = 0.00;
    } else {
    shortWeight = shortWeight.replace(/,/g, "");
    }
    if (netWeight === "") {
    netWeight = 0.00;
    }
    totalWeight = [parseFloat(noOfBags) * parseFloat(packing)];
            netWeight = [parseFloat(totalWeight) - parseFloat(shortWeight)];
            $(obj).closest("td").next().next().find('input').val(totalWeight); // Total-Weight field
            $(obj).closest("td").next().next().next().next().find('input').val(netWeight); // Net-Weight field
            $(obj).closest("td").next().next().find('input').val(fractionNotation(totalWeight, 2));
            $(obj).closest("td").next().next().next().next().find('input').val(fractionNotation(netWeight, 2));
    }

    function calPacking(obj) {
        var noOfBags = $(obj).parent().parent().find('input').eq(3).val();
        var packing = $(obj).val();
        $(obj).val(fractionNotation($(obj).val(), 2));
        var totalWeight = $(obj).closest("td").next().find('input').val();
        var shortWeight = $(obj).closest("td").next().next().find('input').val();
        var netWeight = $(obj).closest("td").next().next().next().find('input').val();
        if (packing === "") {
            packing = 0.00;
        } else {
            packing = packing.replace(/,/g, "");
        }
        if (noOfBags === "") {
            noOfBags = 0.00;
        }
        if (totalWeight === "") {
            totalWeight = 0.00;
        } else {
            totalWeight = totalWeight.replace(/,/g, "");
        }
        if (shortWeight === "") {
            shortWeight = 0.00;
        } else {
            shortWeight = shortWeight.replace(/,/g, "");
        }
        if (netWeight === "") {
            netWeight = 0.00;
        }
        totalWeight = [parseFloat(noOfBags) * parseFloat(packing)];
        netWeight = [parseFloat(totalWeight) - parseFloat(shortWeight)];
        $(obj).closest("td").next().find('input').val(totalWeight); // Total-Weight field
        $(obj).closest("td").next().next().next().find('input').val(netWeight); // Net-Weight field
        $(obj).closest("td").next().find('input').val(fractionNotation(totalWeight, 2)); // Total-Weight field
        $(obj).closest("td").next().next().next().find('input').val(fractionNotation(netWeight, 2)); // Net-Weight field
    }

    function calShortWeight(obj) {

    var TotalWeight = $(obj).parent().parent().find('input').eq(5).val();
            var ShortWeight = $(obj).val();
            $(obj).val(fractionNotation($(obj).val(), 2));
            var Balance = $(obj).closest("td").next().next().find('input').val();
            if (Balance > 0.00 || Balance > 0) {
    Balance = Balance.replace(/,/g, "");
    }

    if (TotalWeight === "") {
    TotalWeight = 0.00;
    } else {
    TotalWeight = TotalWeight.replace(/,/g, "");
    }
    if (ShortWeight === "") {
    ShortWeight = 0.00;
    } else {
    ShortWeight = ShortWeight.replace(/,/g, "");
    }
    $(obj).closest("td").next().find('input').val(parseFloat(TotalWeight) - parseFloat(ShortWeight));
            $(obj).closest("td").next().find('input').val((fractionNotation($(obj).closest("td").next().find('input').val(), 2)));
            var NetWeight = $(obj).closest("td").next().find('input').val();
            if (parseFloat(NetWeight) > parseFloat(Balance)) {
    bootbox.alert("GRN weight exceed from weight present in Purchase Contract", function(result) {
    });
    }
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

    function validationForm() {

    var isValidate = 1;
            var yarnChalanDate = $("#ChallanDate").val();
            var countRows = $("#GrnGrid > tbody").children().length;
            if (yarnChalanDate === "") {
    $(".error-chalandate").show();
            isValidate = 0;
    } else {
    if ((!$("#ChallanDate").inputmask("isComplete")) || (yarnChalanDate === "00-00-0000") || (yarnChalanDate === "01-01-1970")) {
    $(".error-chalandate").html("<label>Enter valid Date</label>").show();
            isValidate = 0;
    } else {
    $(".error-chalandate").hide();
    }
    }
    if (countRows > 0) {
    var noOfBags = $("#GrnGrid").find("input[name='NoOfBagsDetail[]']");
            var packing = $("#GrnGrid").find("input[name='PackingDetail[]']");
            var shortWeight = $("#GrnGrid").find("input[name='ShortWeightDetail[]']");
            var selects = $("#GrnGrid").find(".slctboxes");
            // var totalWeight = $("#GrnGrid").find("input[name='TotalWeightDetail[]']");
            // var netWeight = $("#GrnGrid").find("input[name='NetWeightDetail[]']");

            for (var noOfBagsCount = 0; noOfBagsCount <= noOfBags.length - 1; noOfBagsCount++) {
    if (($(noOfBags[noOfBagsCount]).val() === "")) {
    isValidate = 0;
            $(noOfBags[noOfBagsCount]).parent().find('div').show();
    }
    else {
    if (($(noOfBags[noOfBagsCount]).val() <= "0.00") || (!checkDecimal($(noOfBags[noOfBagsCount]).val()))) {
    isValidate = 0;
            $(noOfBags[noOfBagsCount]).parent().find('div').show();
    } else {
    $(noOfBags[noOfBagsCount]).parent().find('div').hide();
    }
    }
    }
    for (var packingCount = 0; packingCount <= packing.length - 1; packingCount++) {
    var pct = $(packing[packingCount]).val();
            if (pct === "") {
    isValidate = 0;
            $(packing[packingCount]).parent().find('div').show();
    }
    else {
    if (pct.indexOf(',') > - 1) {
    pct = pct.replace(/,/g, "");
    }
    if ((pct <= "0.00") || (!checkDecimal(pct))) {
    isValidate = 0;
            $(packing[packingCount]).parent().find('div').show();
    }
    else {
    $(packing[packingCount]).parent().find('div').hide();
    }
    }
    }
//            for (var totalWeightCount = 0; totalWeightCount <= totalWeight.length - 1; totalWeightCount++) {
//                if ($(totalWeight[totalWeightCount]).val() === "") {
//                    isValidate = 0;
//                    $(totalWeight[totalWeightCount]).parent().find('div').show();
//                }
//                else {
//                    if (($(totalWeight[totalWeightCount]).val() === "0.00") || (!checkDecimal($(totalWeight[totalWeightCount]).val()))) {
//                        isValidate = 0;
//                        $(totalWeight[totalWeightCount]).parent().find('div').show();
//                    }
//                }
//            }
//            for (var netWeightCount = 0; netWeightCount <= netWeight.length - 1; netWeightCount++) {
//                if ($(netWeight[netWeightCount]).val() === "") {
//                    isValidate = 0;
//                    $(netWeight[netWeightCount]).parent().find('div').show();
//                } else {
//                    if (($(netWeight[netWeightCount]).val() <= "0.00") || (!checkDecimal($(netWeight[netWeightCount]).val()))) {
//                        isValidate = 0;
//                        $(netWeight[netWeightCount]).parent().find('div').show();
//                    }
//                }
//            }
    for (var shortWeightCount = 0; shortWeightCount <= shortWeight.length - 1; shortWeightCount++) {
    var sw = $(shortWeight[shortWeightCount]).val();
            if ($(sw === "" || sw === "0.00")) {
    $(shortWeight[shortWeightCount]).parent().find('div').hide();
    } else {
    if (sw.indexOf(',') > - 1) {
    sw = sw.replace(/,/g, "");
    }
    if (!checkDecimal(sw)) {
    isValidate = 0;
            $(shortWeight[shortWeightCount]).parent().find('div').show();
    }
    if (checkDecimal(sw)) {
    isValidate = 0;
            $(shortWeight[shortWeightCount]).parent().find('div').hide();
    }
    }
    }
    for (var count = 0; count <= selects.length - 1; count++) {
    if ($(selects[count]).val() === "select") {
    isValidate = 0;
            $(selects[count]).parent().find('div').show();
    } else {
    $(selects[count]).parent().find('div').hide();
    }
    }
    } else {
    isValidate = 0;
    }

    if (isValidate === 0) {
        return false;
    } else {
        return true;
    }
    }

    function resetSNO() {
    var countRows = $("#GrnGrid > tbody").children().length;
            var sNO = $("#GrnGrid").find(".sno");
            if (countRows > 0) {
    for (var counter = 1; counter <= countRows; counter++) {
    $(sNO[counter - 1]).val(counter);
    }
    }
    }

    function checkDecimal(inputtxt) {
    //         Old  RegEx
    //        var decimal = /^[-+]?[0-9,]+\.[0-9]+$/;
    //          New RegEx
    var decimal = /^\d+\.?\d*$/;
            if (inputtxt.match(decimal))
    {
        return true;
    }
    else
    {
        return false;
    }
    }
    
    
</script>
