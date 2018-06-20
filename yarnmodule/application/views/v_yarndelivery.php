<?php
include 'include/leftmenu.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Yarn Delivery
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
                <a id="PrintAnchor" class="btn btn-app" onclick="printYarnDelivery($('#DeliveryChalanNumber').val())">
                    <i class="fa fa-print"></i> Print
                </a>
                <a id="CSVAnchor" class="btn btn-app" onclick="downloadCSV($('#DeliveryChalanNumber').val())">
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
                <div class="box-body">
                    <!-- form start -->
                    <form id="yarnDeliveryForm" name="yarnDeliveryForm" role="form" method="post" action="<?= base_url() ?>index.php/yarndelivery/Add" onSubmit="return validationForm();">
                        <fieldset>
                            <legend onclick ="">General</legend>
                            <div id="FlashMessage">
                                <h5 style=""><?= $insertMessage ?></h5>
                                <h5 style=""><?= $updateMessage ?></h5>
                                <h5 style=""><?= $deleteMessage ?></h5>
                            </div>
                            <div id="YarnDeliveryDiv">
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="display: none;">
                                    <label for="">Delivery Challan ID</label>
                                    <input id="DeliveryChalanID" name="DeliveryChalanID" type="text" class="form-control" placeholder="">
                                </div> 
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Challan Date</label>
                                    <div class="input-group" style="width: 150px;">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input id="ChallanDate" name="ChallanDate" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                    </div>
                                    <div class="form-group has-error form-error error-deliverychalandate" style="width: 100px;margin-left: 30px;">
                                        <label class="control-label" for="inputError">Enter Date!</label>
                                    </div>
                                </div>                      
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Gate Pass #</label>
                                    <input id="GatePassNumber" name="GatePassNumber" type="text" value="<?php
                                    if ($gatePassNo) {
                                        echo $gatePassNo;
                                    }
                                    ?>" class="form-control" placeholder="" readonly>
                                </div>  
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Vehicle #</label>
                                    <input id="VehicleNumber" name="VehicleNumber" type="text" class="form-control" placeholder="Vehicle Registration Number"  style="" required>
                                </div>                                                           
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Delivery Challan #</label>
                                    <input id="DeliveryChalanNumber" name="DeliveryChalanNumber" type="text"  value="<?php
                                    if ($deliveryChallanNo) {
                                        echo $deliveryChallanNo;
                                    }
                                    ?>" class="form-control" placeholder="" readonly>
                                </div>
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Purpose</label>                                   
                                    <select id="idPurpose" name="idPurpose" class="form-control" style="width: 220px;">
                                        <option value="Select Purpose">Select Purpose</option>                                       
                                        <?php
                                        foreach ($purposeCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['Purpose_id'] ?>"><?php echo $key['PurposeName'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-10 col-sm-5 col-md-5 form-group has-error form-error error-purposetype" style="width: 170px;margin-left: 30px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>  
                                <div id="" class="pull-left col-xs-10 col-sm-5 col-md-5" style="margin-top: 20px;">
                                    <label for="">Party</label>
                                    <select id="idPartyType" name="idPartyType" class="form-control" style="width: 200px;">
                                        <option value="Select Party">Select Party</option>                                       
                                        <?php
                                        foreach ($partyCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['Party_id'] ?>"><?php echo $key['CompanyName'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-10 col-sm-5 col-md-5 form-group has-error form-error error-partytype" style="width: 170px;margin-left: 30px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>
                                <div class="pull-right col-xs-2 col-sm-1 col-md-1" style="margin-top: 50px;">
                                    <label for="" style="width: 65px;margin-left: -45px;"><a onclick="addNewPopup()">Add New</a></label>                                                              
                                </div>  
                            </div>
                        </fieldset>   
                        <fieldset>
                            <br><br><div class="box-body table-responsive">
                                <legend onclick="">Challan Items</legend>                          
                                <div id="ChalanItemsTable" class="box" class="pull-left col-md-12" style="margin-top: 20px;width:685px;overflow-x: scroll;">   
                                    <div class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                        <input id="AddButton" name="AddButton" class="btn btn-primary col-xs-12 col-sm-6 col-md-1" style="width:35px;height:30px;margin-left: -350px;margin-top:-12px;text-align:center;cursor: pointer" value="+" onclick="populateGridRows()" readonly>
                                        <!--<input id="Add" type="button" value="Add" class="btn btn-primary" onclick="populateGridRows();" style="width: 100px;float: right">-->
                                    </div> 
                                    <table id="yarnDeliveryGrid" class="table table-bordered table-striped" style="margin-top: 75px;">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Count</th>
                                                <th>Mill</th>
                                                <th>Brand</th>
                                                <th>Warehouse</th>
                                                <th>Quantity In Stock</th>
                                                <th>Usage </th>
                                                <th>Bags</th>
                                                <th>Qty(lbs)</th>                                                
                                                <th>Add</th>
                                                <th>Del</th>
                                            </tr>
                                        </thead>
                                        <tbody id="yarnDeliveryTbody">
                                        </tbody>
                                        <tfoot>
                                            <tr></tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div id="" class="col-md-12" style="margin-top: 20px;">
                                    <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="">
                                        <label>Total Bags</label>
                                        <input id="TotalBags" name="TotalBags" type="text" value="" class="form-control" placeholder="0.00" style="" readonly>
                                        <div class="form-group has-error form-error error-totalbags" onstyle="width: 235px;margin-left: 5px;display: none;">
                                            <label class="control-label" for="inputError">value must be a Decimal,Greater than zero!</label>
                                        </div>
                                    </div>
                                    <div class="pull-left col-xs-10 col-sm-5 col-md-5" style="">
                                        <label>Total Weight (lbs)</label>
                                        <input id="TotalWeight" name="TotalWeight" type="text" value="" class="form-control" placeholder="0.00"  style="" readonly>
                                        <div class="form-group has-error form-error error-totalweight" style="width: 235px;margin-left:5px;display: none;">
                                            <label class="control-label" for="inputError">value must be a Decimal,Greater than zero!</label>
                                        </div>
                                    </div>
                                    <div class="pull-right col-xs-2 col-sm-1 col-md-1" style="display: none">
                                        <input id="OKButton" name="OKButton" class="btn btn-default" style="width:60px;height:30px;margin-top: 25px;margin-right: -25px;text-align:center;float: right; cursor: pointer" value="OK" readonly>
                                        <label  style="width: 60px;margin-left: -45px;"><a>OK</a></label>   
                                    </div>
                                </div>                      
                            </div>
                            <div class="pull-right col-md-6" style="margin-left: 0px;margin-top: 20px;">
                                <br><button id="SaveYarnDeliveryButton" type="submit" class="btn btn-primary" style="width: 75px;float: right;">Save</button>
                            </div>
                            </div><!-- /.box-body -->                           
                        </fieldset>
                    </form>
                </div>
            </div>
        </div><!-- /.box -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<script>

    $(document).ready(function() {

        $(".form-error").hide();
        formMode = "Add";
//        disableElements("#SaveYarnDeliveryButton");
        $('#EditAnchor').attr("disabled", "disabled");
        $('#PrintAnchor').attr("disabled", "disabled");
        $('#CSVAnchor').attr("disabled", "disabled");
        $('#PrintGatePassAnchor').attr("disabled", "disabled");
        $('#FlashMessage').fadeOut(5000);
        $("#ChallanDate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        // On Pressing Enter, Preventing Default Functionality
        onPressEnter('#yarnDeliveryForm');
        onPressEnter('#yarnDeliveryFormEdit');
        onPressEnter('#partyCreationForm');
        <?php
            if (strval($operation) == "1" || strval($operation) == "2")
            {
                echo "bootbox.confirm('Do you want to print this document', function(result) {
                        if (result) {
                            printYarnDelivery($challanNo);
                        }                        
                    });";
            }
        ?>
    });
    
    var challanItemsCount = 0;
    function populateGridRows() {
        var countRows = $("#yarnDeliveryGrid> tbody").children().length;
        if (countRows > 0) {
            challanItemsCount = $('#yarnDeliveryGrid tbody>tr:last').find("td:first").find('input').val();
            challanItemsCount = parseInt(challanItemsCount);
        }
        challanItemsCount = parseInt(challanItemsCount) + 1;
        var items = [];
        items += "<tr>" +
                "<td tag=''><input id='SerialNoDetail' name='SerialNoDetail[]' value='" + challanItemsCount + "' type = 'text' class='form-control dcSno' style = 'width: 55px;' placeholder = 'SNo' readonly></td>" +
                "<td tag=''><select id='idCount' name='idCount[]' data-target='count' onchange='getStockQty(this)' class = 'form-control slctboxes' style = 'width: 125px;'><option value='select'>Count</option><?php
                                        foreach ($countCombo as $key) {
                                            ?><option value='<?= $key['Count_id'] ?>'><?= $key['CountName'] ?></option><?php } ?></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-counttype' style='width: 125px;margin-left:0px;display:none'>" +
                "<label class='control-label' for='inputError'>Select any Option!</label></div></td>" +
                "<td tag=''><select id='idMill' name='idMill[]' data-target='mill' onchange='getStockQty(this)' class = 'form-control slctboxes' style = 'width: 125px;'><option value='select'>Mill</option><?php
                                        foreach ($millCombo as $key) {
                                            ?><option value='<?= $key['Party_id'] ?>'><?= $key['CompanyName'] ?></option><?php } ?></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-milltype' style='width: 125px;margin-left:0px;display:none'>" +
                "<label class='control-label' for='inputError'>Select any Option!</label></div></td>" +
                "<td tag=''><input id='Brand' name='Brand[]' data-target='brand' onfocusout='getStockQty(this)' value='' type='text' class='form-control' style='width:125px;' placeholder='Brand'></td>" +
                "<td tag=''><select id='idWarehouse' name='idWarehouse[]' data-target='warehouse' onchange='getStockQty(this)' class='form-control slctboxes' style = 'width: 170px;'><option value='select'>Select Warehouse</option><?php
                                        foreach ($warehouseCombo as $key) {
                                            ?><option value='<?= $key['Warehouse_id'] ?>'><?= $key['WarehouseName'] ?></option><?php } ?></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-warehousecombo' style='width:125px;margin-left: 0px;display:none'><label class='control-label' for='inputError'>Select any Option!</label></div></td>" +
                "<td tag=''><input id='stockQuantity' name='stockQuantity[]' value='' type = 'text' class='form-control qty' style='width: 125px;' placeholder='0.00' readonly></td>" +
                "<td tag=''><select id='idUsage' name='idUsage[]' class='form-control slctboxes' style = 'width: 125px;'><option value='select'>Usage</option><?php
                                        foreach ($usageCombo as $key) {
                                            ?><option value='<?= $key['Usageid'] ?>'><?= $key['UsageName'] ?></option><?php } ?></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-usagetype' style='width:125px;margin-left:0px;display:none'>" +
                "<label class='control-label' for='inputError'>Select any Option!</label></div></td>" +
                "<td tag=''><input id='Bags' name='Bags[]' value='' type = 'text' class='form-control bags' onfocusout='sumTotalValues(this,1)' style='width: 125px;' placeholder='0.00'><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-bags' style='width:125px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be a Numeric or Decimal and Greater than Zero</label></div></td>" +
                "<td tag=''><input id='Quantity' name='Quantity[]' value='' type = 'text' class='form-control qty' onfocusout='sumTotalValues(this,0)' style='width: 125px;' placeholder='0.00'><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-qty' style='width:125px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be a Numeric or Decimal and Greater than Zero</label></div></td>" +
                "<td><input id='AddButton' name='AddButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='+' onclick='populateGridRows()' readonly></td>" +
                "<td tag=''><input id='DelButton' name='DelButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='X' onclick='deleteGridRows(this)' readonly></td></tr>";
        $('#yarnDeliveryTbody').append(items);
        if (formMode === "Edit") {
            resetSNO();
        }
    }
    
    var selectedCount = "";
    var selectedMill = "";
    var selectedWarehouse = "";
    var brandValue = "";
    var stockElement;
    
    function getStockQty(obj) {
        var type = $(obj).data("target");
        //var stockQty = 0.00;
        //alert(type);
              
        if (type === "count") {
            selectedCount = $(obj).val();
            selectedMill = $(obj).closest('td').next().find('select option:selected').val();
            selectedWarehouse = $(obj).closest('td').next().next().next().find('select option:selected').val();
            brandValue = $(obj).closest('td').next().next().find('input').val();
            stockElement = $(obj).closest('td').next().next().next().next().find('input');

            if (selectedCount !== "select" && selectedMill !== "select" && selectedWarehouse !== "select") {
                getStockQuantity(selectedCount, selectedMill, brandValue, selectedWarehouse, stockElement);
            } else {
                $(stockElement).val(0.00);    
            }

        } else if (type === "mill") {
            selectedCount = $(obj).closest('td').prev().find('select option:selected').val();
            selectedMill = $(obj).val();
            selectedWarehouse = $(obj).closest('td').next().next().find('select option:selected').val();
            brandValue = $(obj).closest('td').next().find('input').val();
            stockElement = $(obj).closest('td').next().next().next().find('input');

            if (selectedCount !== "select" && selectedMill !== "select" && selectedWarehouse !== "select") {
                getStockQuantity(selectedCount, selectedMill, brandValue, selectedWarehouse, stockElement);
            } else {
                $(stockElement).val(0.00);        
            }

        } else if (type === "brand") {
            selectedCount = $(obj).closest('td').prev().prev().find('select option:selected').val();
            selectedMill = $(obj).closest('td').prev().find('select option:selected').val();
            selectedWarehouse = $(obj).closest('td').next().find('select option:selected').val();
            brandValue = $(obj).val();
            stockElement = $(obj).closest('td').next().next().find('input');

            if (selectedCount !== "select" && selectedMill !== "select" && selectedWarehouse !== "select") {
                getStockQuantity(selectedCount, selectedMill, brandValue, selectedWarehouse, stockElement);
            } else {
                $(stockElement).val(0.00);   
            }

        } else if (type === "warehouse") {
            selectedCount = $(obj).closest('td').prev().prev().prev().find('select option:selected').val();
            selectedMill = $(obj).closest('td').prev().prev().find('select option:selected').val();
            selectedWarehouse = $(obj).val();
            brandValue = $(obj).closest('td').prev().find('input').val();
            stockElement = $(obj).closest('td').next().find('input');

            if (selectedCount !== "select" && selectedMill !== "select" && selectedWarehouse !== "select") {
                getStockQuantity(selectedCount, selectedMill, brandValue, selectedWarehouse, stockElement);
            } else {
                $(stockElement).val(0.00);   
            }
        } else if (type === "quantity") {
            selectedCount = $(obj).closest('td').prev().prev().prev().prev().prev().prev().prev().find('select option:selected').val();
            selectedMill = $(obj).closest('td').prev().prev().prev().prev().prev().prev().find('select option:selected').val();
            selectedWarehouse = $(obj).closest('td').prev().prev().prev().prev().find('select option:selected').val();
            brandValue = $(obj).closest('td').prev().prev().prev().prev().prev().find('input').val();
            stockElement = $(obj).closest('td').prev().prev().prev().find('input');
            if (selectedCount !== "select" && selectedMill !== "select" && selectedWarehouse !== "select") {
                getStockQuantity(selectedCount, selectedMill, brandValue, selectedWarehouse, stockElement);
            } else {
                $(stockElement).val(0.00);
            }
            
        }
    }
        
    function getStockQuantity(countID, millID, brand, warehouseID, stockElement) {
       var stockQuantity = 0.00;
       var deliveryChalanID = $("#DeliveryChalanID").val();
       
       $.ajax({
            url: "<?= base_url() ?>index.php/yarndelivery/getStockQuantity",
            type: "POST",
            data: {countID: countID, millID: millID, brand: brand, warehouseID: warehouseID, deliveryChalanID: deliveryChalanID},
            success: function(data) {
            if (data !== "null") {
                var parsedData = JSON.parse(data);
                if (parsedData.length > 0) {
                    try {
                            stockQuantity = parsedData[0]['StockQuantity'];
                            if (stockQuantity === null)
                                stockQuantity = 0.00;
                            $(stockElement).val(stockQuantity);
                            $(stockElement).val(fractionNotation(stockQuantity, 2));
                    } 
                    catch (e) {
                        console.log(e);
                    }
                }
            }
        }
    });
   }

    function deleteGridRows(r) {
        var i = r.parentNode.parentNode.rowIndex;
        var totalBagsModified = 0.00;
        var totalWeightModified = 0.00;
        var totalBags = $('#TotalBags').val();
        var totalWeight = $('#TotalWeight').val();
        var bags = $(r).closest("td").prev().prev().prev().prev().find('input').val();
        var quantity = $(r).closest("td").prev().prev().prev().find('input').val();
        if (quantity !== "") {
            if (quantity.indexOf(',') > -1) {
                quantity = quantity.replace(/,/g, "");
            }
        }
        if (totalWeight !== "") {
            if (totalWeight.indexOf(',') > -1) {
                totalWeight = totalWeight.replace(/,/g, "");
            }
        }
        document.getElementById('yarnDeliveryGrid').deleteRow(i);
        challanItemsCount = parseInt(challanItemsCount) - 1;
        totalBagsModified = totalBags - bags;
        totalWeightModified = totalWeight - quantity;
        if (totalBagsModified < 0) {
            totalBagsModified = 0.00;
        }
        if (totalWeightModified < 0) {
            totalWeightModified = 0.00;
        }
        $('#TotalBags').val(totalBagsModified);
        $('#TotalWeight').val(totalWeightModified);
        $('#TotalWeight').val(fractionNotation($('#TotalWeight').val(), 2));
        resetSNO();
    }

    function retrivePopup() {
        formMode = "Retrieve";
        $("#EditAnchor").removeAttr("disabled");
        $("#PrintAnchor").removeAttr("disabled");
        $("#PrintGatePassAnchor").removeAttr("disabled");
        $("#CSVAnchor").removeAttr("disabled");
        bootbox.dialog({
            title: "All Yarn Delivery Item(s)",
            message:
                    "<fieldset>" +
                    "<div class='box box-primary'>" +
                    "<div class='box-body'>" +
                    "<form name='yarnDeliveryFormEdit' role='' method='' action='' style='margin-top:0px;'>" +
                    "<div class='col-md-12'>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6' style='width:443px;margin-top:20px;'>" +
                    "<label>Search</label>" +
                    "<input id='searchYarnDelivery' name='searchYarnDelivery' type='text' class='form-control' placeholder='Search by Challan Number' style='width:200px;'>" +
                    "<input id='SearchNow' type='button' value='OK' class='btn btn-primary' onclick='search()' style='width: 100px;margin-left: 205px;margin-top:-58px;'>" +
                    "</div>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top:20px;'>" +
                    "<label>GatePass Number</label>" +
                    "<input id='GatePassNoEdit'name='GatePassNoEdit'type='text'class='form-control' placeholder='' style='width:200px;' readonly>" +
                    "</div>" +
                    "<div class='pull-left col-xs-10 col-sm-5 col-md-5' style='margin-top:20px;'>" +
                    "<label>Delivery Chalan #</label>" +
                    "<input id='DeliveryChalanNumberEdit'name='DeliveryChalanNumberEdit' type='text' class='form-control' placeholder='' style='width:200px;' readonly>" +
                    "</div><br>" +
                    "<div id='DeliveryDetailDiv' class='pull-left col-xs-2 col-sm-1 col-md-1' style='width:106px;margin-top:50px;margin-left:-105px;display:none;'>" +
                    "</div><br>" +
                    "<div class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top:20px;'>" +
                    "<label>Purpose</label>" +
                    "<input id='idPurposeEdit' name='idPurposeEdit' type='text' class='form-control' placeholder='' style='width:200px' readonly>" +
                    "</div>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6'  style='margin-top:20px;'>" +
                    "<label>Challan Date</label>" +
                    "<input id='ChallanDateEdit'name='ChallanDateEdit' type='text'class='form-control' placeholder='' style='width:200px;' readonly>" +
                    "</div>" +
                    "<div class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top:20px;'>" +
                    "<label>Vehicle Number</label>" +
                    "<input id='VehicleNumberEdit' name='VehicleNumberEdit' type='text' class='form-control' placeholder='' style='width:200px' readonly>" +
                    "</div>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top:20px;'>" +
                    "<label>Party Type</label>" +
                    "<input id='idPartyTypeEdit'name='idPartyTypeEidt' type='text' class='form-control' placeholder='' style='width:200px;' readonly>" +
                    "</div>" +
                    "<div class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top:20px;'>" +
                    "<label>Total Bags</label>" +
                    "<input id='TotalBagsEdit' name='TotalBagsEdit' type='text' class='form-control' placeholder='' style='width:200px' readonly>" +
                    "</div>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top:20px;'>" +
                    "<label>Total Weight</label>" +
                    "<input id='TotalWeightEdit' name='TotalWeightEdit' type='text' class='form-control' placeholder='' style='width:200px;' readonly>" +
                    "</div>" +
                    "</div>" +
                    "<fieldset>" +
                    "<div class='box-body table-responsive' style='margin-top:20px;'>" +
                    "<div class='box'>" +
                    "<table class='table table-bordered table-striped'>" +
                    "<thead>" +
                    "<tr>" +
                    "<th width='05%'>SNo.</th>" +
                    "<th width='20%'>Count</th>" +
                    "<th width='15%'>Mill</th>" +
                    "<th width='15%'>Brand</th>" +
                    "<th width='20%'>Usage</th>" +
                    "<th width='15%'>Bags</th>" +
                    "<th width='05%'>Qty (lbs)</th>" +
                    "<th width='05%'>Warehouse</th>" +
                    "</tr>" +
                    "</thead>" +
                    "<tbody id='yarnDeliveryTbodyDetail'>" +
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
        onPressEnter('#searchYarnDelivery');
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
            var action = "<?php echo base_url() ?>index.php/yarndelivery/Update";
            enableElements("#DeliveryChalanID");
            enableElements("#DeliveryChalanID");
            enableElements("#ChallanDate");
            enableElements("#GatePassNumber");
            enableElements("#idPurpose");
            enableElements("#DeliveryChalanNumber");
            enableElements("#VehicleNumber");
            enableElements("#idPartyType");
            enableElements("#TotalWeight");
            enableElements("#TotalBags");
            enableElements("#OKButton");
            enableElements("#SaveYarnDeliveryButton");
            enableTable("#ChalanItemsTable *");
            var countRows = $("#yarnDeliveryGrid> tbody").children().length;
            if (countRows > 0) {
                enableElements('#SaveYarnDeliveryButton');
            }
            document.getElementById("yarnDeliveryForm").action = action;
        } else {
            var parsedData = JSON.parse(decodeURI(detailData));
            if (parsedData.length > 0) {
                $("#DeliveryChalanID").val(parsedData[0]['Delivery_Challan_id']);
                $("#ChallanDate").val(getFormatedDate(parsedData[0]['ChallanDate']));
                $("#DeliveryChalanNumber").val(parsedData[0]['DeliveryChallanNo']);
                $("#GatePassNumber").val(parsedData[0]['GatePassNo']);
                $('#idPartyType option').filter(function() {
                    return ($(this).text() === parsedData[0]['CompanyName']);
                }).prop('selected', true);
                $('#idPurpose option').filter(function() {
                    return ($(this).text() === parsedData[0]['PurposeName']);
                }).prop('selected', true);
                $("#VehicleNumber").val(parsedData[0]['VehicleNo']);
                $("#TotalBags").val(parsedData[0]['TotalBags']);
                $("#TotalWeight").val(fractionNotation(parsedData[0]['TotalWeight'], 2));
                var items = [];
                $('#yarnDeliveryGrid tr:eq(1) td:eq(1) select option').filter(function() {
                    return ($(this).text() === "Two");
                }).prop('selected', true);
                $.each(parsedData, function(i, val) {
                    items += "<tr>" +
                            "<td tag=''><input id='SerialNoDetail' name='SerialNoDetail[]' value='" + val.SerialNo + "' type = 'text' class='form-control dcSno' style = 'width: 55px;' placeholder = 'SNo' readonly></td>" +
                            "<td tag=''><select id='idCount' name='idCount[]' data-target='count' onchange='getStockQty(this)' class = 'form-control slctboxes' style = 'width: 125px;'><option value='select'>Count</option><?php
                                        foreach ($countCombo as $key) {
                                            ?><option " + (val['CountName'] === '<?= $key['CountName'] ?>' ? "selected" : "") + " value='<?= $key['Count_id'] ?>'><?= $key['CountName'] ?></option><?php } ?></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-counttype' style='width: 125px;margin-left: 0px;display:none'></td>" +
                            "<td tag=''><select id='idMill' name='idMill[]' data-target='mill' onchange='getStockQty(this)' class = 'form-control slctboxes' style = 'width: 125px;'><option value='select'>Mill</option><?php
                                        foreach ($millCombo as $key) {
                                            ?><option " + (val['Mill'] === '<?= $key['CompanyName'] ?>' ? "selected" : "") + " value='<?= $key['Party_id'] ?>'><?= $key['CompanyName'] ?></option><?php } ?></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-milltype' style='width: 125px;margin-left: 0px;display:none'></td>" +
                            "<td tag=''><input id='Brand' name='Brand[]' value='" + val.Brand + "' data-target='brand' onfocusout='getStockQty(this)' type = 'text' class='form-control' style='width:125px;'placeholder='Brand' data-validation = 'required'></td>" +
                            "<td tag=''><select id='idWarehouse' name='idWarehouse[]' data-target='warehouse' onchange='getStockQty(this)' class='form-control slctboxes' style = 'width: 170px;'><option value='select'>Select Warehouse</option><?php
                                        foreach ($warehouseCombo as $key) {
                                            ?><option " + (val['Warehouse_id'] === '<?= $key['Warehouse_id'] ?>' ? "selected" : "") + " value='<?= $key['Warehouse_id'] ?>'><?= $key['WarehouseName'] ?></option><?php } ?></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-warehousecombo' style='width:125px;margin-left: 0px;display:none'><label class='control-label' for='inputError'>Select any Option!</label></div></td>" +                            
                            "<td tag=''><input id='stockQuantity' name='stockQuantity[]' value='' type = 'text' class='form-control qty' style='width: 125px;' placeholder='0.00' readonly></td>" +
                            "<td tag=''><select id='idUsage' name='idUsage[]' class='form-control slctboxes' style = 'width: 125px;'><option value='select'>Usage</option><?php
                                        foreach ($usageCombo as $key) {
                                            ?><option " + (val['UsageName'] === '<?= $key['UsageName'] ?>' ? "selected" : "") + " value='<?= $key['Usageid'] ?>'><?= $key['UsageName'] ?></option><?php } ?></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-usagetype' style='width:125px;margin-left: 0px;display:none'></td>" +
                            "<td tag=''><input id='Bags' name='Bags[]' value='" + val.Bags + "' type = 'text' class='form-control bags' onfocusout='sumTotalValues(this,1)' style='width: 125px;'placeholder='0.00'><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-bags' style='width:125px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be a Numeric or Decimal and Greater than Zero</label></div></td>" +
                            "<td tag=''><input id='Quantity' name='Quantity[]' value='" + fractionNotation(val.Quantity, 2) + "' type = 'text' class='form-control qty' data-target='quantity' onloadeddata='' onfocusout='getStockQty(this);sumTotalValues(this,0);' style='width: 125px;'placeholder='0.00'><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-qty' style='width:125px;margin-left:0px;display:none'><label class='control-label' for='inputError'>Value Must be a Numeric or Decimal and Greater than Zero</label></div></td>" +
                            "<td><input id='AddButton' name='AddButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='+' onclick='populateGridRows()' readonly></td>" +
                            "<td tag=''><input id='DelButton' name='DelButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='X' onclick='deleteGridRows(this)' readonly></td></tr>";
                    $("#yarnDeliveryTbody").html(items);
                });
            }

            disableElements("#DeliveryChalanID");
            disableElements("#ChallanDate");
            disableElements("#GatePassNumber");
            disableElements("#idPurpose");
            disableElements("#DeliveryChalanNumber");
            disableElements("#VehicleNumber");
            disableElements("#idPartyType");
            disableElements("#TotalWeight");
            disableElements("#TotalBags");
            disableElements("#OKButton");
            disableElements("#SaveYarnDeliveryButton");
            disableTable("#ChalanItemsTable *");
            resetSNO();
        }
    }

    function resetForm() {
        if (formMode === 'Retrieve' || formMode === 'Edit') {
            return true;
        } else {
            emptyAllFields("#DeliveryChalanID");
            emptyAllFields("#ChallanDate");
            emptyAllFields("#GatePassNumber");
            emptyAllFields("#idPurpose");
            emptyAllFields("#DeliveryChalanNumber");
            emptyAllFields("#VehicleNumber");
            emptyAllFields("#idPartyType");
            emptyAllFields("#TotalWeight");
            emptyAllFields("#TotalBags");
            emptyAllFields("#ChalanItemsTable *");
        }
    }

    function emptyAllFields(element) {
        $(element).val("");
    }

    function search() {
        var searchValue = $('#searchYarnDelivery').val();
        if (searchValue === "") {
            bootbox.alert("Please enter value to search for", function(result) {
            });
        } else
        {
            $.ajax({
                url: "<?= base_url() ?>index.php/yarndelivery/search",
                type: "POST",
                data: {search: searchValue},
                success: function(data) {
                    if (data !== "null")
                    {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            try {
                                $("#ChallanDateEdit").val(getFormatedDate(parsedData[0]['ChallanDate']));
                                $("#GatePassNoEdit").val(parsedData[0]['GatePassNo']);
                                $("#idPartyTypeEdit").val(parsedData[0]['CompanyName']);
                                $("#idPurposeEdit").val(parsedData[0]['PurposeName']);
                                $("#DeliveryChalanNumberEdit").val(parsedData[0]['DeliveryChallanNo']);
                                $("#VehicleNumberEdit").val(parsedData[0]['VehicleNo']);
                                $("#TotalBagsEdit").val(parsedData[0]['TotalBags']);
                                $("#TotalWeightEdit").val(fractionNotation(parsedData[0]['TotalWeight'], 2));
                                $('#DeliveryDetailDiv').html("<span><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('" + encodeURI(data) + "','None')>Edit</a> | <a style='cursor: pointer'; href='<?= base_url() ?>index.php/yarndelivery/Delete/" + parsedData[0]['Delivery_Challan_id'] + "'>Delete</a></span>");
                                $('#DeliveryDetailDiv').show();
                                var items = [];
                                var counter = 0;
                                $.each(parsedData, function(i, val) {
                                    counter = parseInt(counter) + 1;
                                    items += "<tr>" +
                                            "<td>" + counter + "</td>" +
                                            "<td>" + val.CountName + "</td>" +
                                            "<td>" + val.Mill + "</td>" +
                                            "<td>" + val.Brand + "</td>" +
                                            "<td>" + val.UsageName + "</td>" +
                                            "<td>" + val.Bags + "</td>" +
                                            "<td>" + fractionNotation(val.Quantity, 2) + "</td>" +
                                            "<td>" + val.WarehouseName + "</td>" +
                                            "</tr>";
                                });
                                $("#yarnDeliveryTbodyDetail").html(items);
                            } catch (e) {
                                console.log(e);
                            }
                        }
                        else {
                            $('#DeliveryDetailDiv').html('');
                            $('#DeliveryDetailDiv').hide();
                            $("#ChallanDateEdit").val('');
                            $("#GatePassNoEdit").val('');
                            $("#idPartyTypeEdit").val('');
                            $("#idPurposeEdit").val('');
                            $("#DeliveryChalanNumberEdit").val('');
                            $("#VehicleNumberEdit").val('');
                            $("#TotalBagsEdit").val('');
                            $("#TotalWeightEdit").val('');
                            $("#yarnDeliveryTbodyDetail").html("<tr><td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td></tr>");
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

    function addNewPopup() {

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
                "<input id='ContactNumber' name='ContactNumber' type='text' class='form-control' data-inputmask='mask: 999-9-9999999' data-mask style='width: 290px;'>" +
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
                "<div id='' class='pull-left col-xs-12 col-sm-5 col-md-6' style='margin-top: 20px;'>" +
                "<label for=''>Email</label>" +
                "<input id='Email' name='Email' type='text' class='form-control'placeholder='Email'>" +
                "<div class='pull-right col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-emailpopup' style='width: 165px;margin-right:100px;'><label class='control-label' for='inputError'>Invalid Email Address!</label>" +
                "</div>" +
                "</div>" +
                "<div class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                "<label>Party Type</label>" +
                "<select id='idPartyTypePopup' name='idPartyTypePopup' class='form-control'>" +
                "<option>Select Party Type</option>" + <?php foreach ($partyTypeCombo as $key) { ?>
            "<option value = '<?php echo $key['Party_type_id'] ?>' ><?php echo $key['PartyTypeName'] ?></option>" +<?php } ?>
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
        });
                $('.modal-content').css({
            "width": '850px',
            "margin-left": '-115px'
        });
        $('.error-partyname').hide();
        $('.error-partytypepopup').hide();
        $('.error-emailpopup').hide();
    }

    function saveParty() {

        var isValidPopup = 1;
        var emailAddress = $('#Email').val();
        if (emailAddress !== "") {
            var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
            if (!re.test(emailAddress)) {
                $('.error-emailpopup').show();
                isValidPopup = 0;
            }
        }
        if ($('#idPartyTypePopup').val() === "Select Party Type") {
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
            partyData['idPartyType'] = $('#idPartyTypePopup').val();
            $.ajax({
                url: "<?= base_url() ?>index.php/yarndelivery/save",
                type: "POST",
                data: {data: partyData},
                success: function(data) {
                    if (data !== "") {
                        bootbox.alert(data, function(result) {
                        });
                        updateCombo();
                    } else {
                    }
                }
            });
            $('#SavePartyButton').addClass('bootbox-close-button close');
        }
    }

    function updateCombo() {
        $("#idPartyType").html('');
        $.ajax({
            url: "<?= base_url() ?>index.php/yarndelivery/reloadCombo",
            type: "GET",
            success: function(data) {
                if (data.length > 0) {
                    var parsedData = JSON.parse(data);
                    $("#idPartyType").append($("<option>Select Party</option>"));
                    $.each(parsedData, function(index, name) {
                        $("#idPartyType").append($("<option></option>").val(name['Party_id']).html(name['CompanyName']));
                    });
                }
            }
        });
        $('#SavePartyButton').addClass('bootbox-close-button close');
    }

    function printYarnDelivery(val) {
        window.open(
                "<?php echo base_url(); ?>index.php/yarndelivery/printYarnDelivery/" + val + "",
                '_blank'
                );
//        window.location = "<?php echo base_url(); ?>index.php/yarndelivery/printYarnDelivery/" + val + "";
    }
    
    function downloadCSV(val) {
        window.open(
                "<?php echo base_url(); ?>index.php/yarndelivery/downloadCSV/" + val + "",
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

    function resetSNO() {
        var countRows = $("#yarnDeliveryGrid > tbody").children().length;
        var sNO = $("#yarnDeliveryGrid").find(".dcSno");
        if (countRows > 0) {
            for (var counter = 1; counter <= countRows; counter++) {
                $(sNO[counter - 1]).val(counter);
            }
        }
    }

    function sumTotalValues(obj, type) {
        if (type === 0) {
            $(obj).val(fractionNotation($(obj).val(), 2));
            $('#TotalWeight').val('');
            var totalQty = $('#ChalanItemsTable tr td:nth-last-child(3) input');
            var sumTotalQty = 0.00;
            for (var i = 0; i < totalQty.length; i++) {
                var qty = totalQty[i].value;
                if (CheckStockQuantity(totalQty[i]) !== 1)
                    return;
                if (qty !== "") {
                    if (qty.indexOf(',') > -1) {
                        qty = qty.replace(/,/g, "");
                    }
                    sumTotalQty = sumTotalQty + parseFloat(qty);
                }
            }
            $('#TotalWeight').val(sumTotalQty);
            $('#TotalWeight').val(fractionNotation(sumTotalQty, 2));
        } else {
            $('#TotalBags').val('');
            var totalBags = $('#ChalanItemsTable tr td:nth-last-child(4) input');
            var sumTotalBags = 0.00;
            for (var j = 0; j < totalBags.length; j++) {
                var bag = totalBags[j].value;
                if (bag !== "") {
                    sumTotalBags = sumTotalBags + parseFloat(bag);
                }
            }
            $('#TotalBags').val(sumTotalBags);
        }
    }
    
    function CheckStockQuantity(obj) {
         var quantity = $(obj).val();
			
        if (quantity === null || quantity === "")
            quantity = 0.00;
        var stockQuantity = $(obj).closest('td').prev().prev().prev().find('input').val();
        if (stockQuantity === null || stockQuantity === "")
            stockQuantity = 0.00;
		
        if (quantity.indexOf(',') > -1) {
            quantity = quantity.replace(/,/g, "");
        }
        
	if (stockQuantity.indexOf(',') > -1) {
            stockQuantity = stockQuantity.replace(/,/g, "");
        }
		
        if (parseFloat(quantity) > parseFloat(stockQuantity)) {
            alert("Entered value is greater than stock.");
            $(obj).focus();
            return 0;
        }
        return 1;
    }

    $("#partyCreationForm").submit(function() {
        saveParty();
    });

    function validationForm() {
        var isValidate = 1;
        var dChalanDate = $("#ChallanDate").val();
        var purpose = $('#idPurpose').val();
        var partytypeName = $('#idPartyType').val();
        //  var totalBags = $('#TotalBags').val();
        //    var totalWeight = $('#TotalWeight').val();
        var countRows = $("#yarnDeliveryGrid > tbody").children().length;
        //         Old  RegEx
        //        var decimal = /^[-+]?[0-9,]+\.[0-9]+$/;
        //          New RegEx
        var decimal = /^\d+\.?\d*$/;

        if (dChalanDate === "" && purpose === "Select Purpose" && partytypeName === "Select Party") {
            $(".error-purposetype").show();
            $(".error-partytype").show();
            $(".error-deliverychalandate").show();
            isValidate = 0;
        } else {
            $(".error-purposetype").hide();
            $(".error-partytype").hide();
            $(".error-deliverychalandate").hide();
            if ((dChalanDate === "") || (purpose === "Select Purpose") || (partytypeName === "Select Party")) {

                if (dChalanDate === "") {
                    $(".error-deliverychalandate").show();
                } else {
                    $(".error-deliverychalandate").hide();
                }
                if (purpose === "Select Purpose") {
                    $(".error-purposetype").show();
                } else {
                    $(".error-purposetype").hide();
                }
                if (partytypeName === "Select Party") {
                    $(".error-partytype").show();
                } else {
                    $(".error-partytype").hide();
                }
                isValidate = 0;
            }
            if ((!$("#ChallanDate").inputmask("isComplete")) || (dChalanDate === "00-00-0000") || (dChalanDate === "01-01-1970")) {
                isValidate = 0;
                $(".error-deliverychalandate").html("<label>Enter valid Date</label>").show();
            } else {
                $(".error-deliverychalandate").hide();
            }
        }
        if (countRows > 0) {
            var selects = $("#yarnDeliveryGrid").find(".slctboxes");
            var bags = $("#yarnDeliveryGrid").find("input[name='Bags[]']");
            var qty = $("#yarnDeliveryGrid").find("input[name='Quantity[]']");
            for (var count = 0; count <= selects.length - 1; count++) {
                if ($(selects[count]).val() === "select") {
                    isValidate = 0;
                    $(selects[count]).parent().find('div').show();
                } else {
                    $(selects[count]).parent().find('div').hide();
                }
            }
            for (var bagsCount = 0; bagsCount <= bags.length - 1; bagsCount++) {
                if ($(bags[bagsCount]).val() === "") {
                    isValidate = 0;
                    $(bags[bagsCount]).parent().find('div').show();
                } else {
                    if (!(($(bags[bagsCount]).val()).match(decimal)) || ($(bags[bagsCount]).val() <= "0.00")) {
                        isValidate = 0;
                        $(bags[bagsCount]).parent().find('div').show();
                    } else {
                        $(bags[bagsCount]).parent().find('div').hide();
                    }
                }
            }
            for (var qtyCount = 0; qtyCount <= qty.length - 1; qtyCount++) {
                var qct = $(qty[qtyCount]).val();
                if (qct === "") {
                    isValidate = 0;
                    $(qty[qtyCount]).parent().find('div').show();
                }
                else {
                    if (qct.indexOf(',') > -1) {
                        qct = qct.replace(/,/g, "");
                    }
                    if (!((qct).match(decimal)) || (qct <= "0.00")) {
                        isValidate = 0;
                        $(qty[qtyCount]).parent().find('div').show();
                    } else {
                        $(qty[qtyCount]).parent().find('div').hide();
                    }
                }
            }
        } else {
            isValidate = 0;
        }
//        if (totalBags === "") {
//            $(".error-totalbags").show();
//        } else {
//            if ((totalBags <= "0.00")) {
//                isValidate = 0;
//                $(".error-totalbags").show();
//            }
//            if (!(totalBags.match(decimal))) {
//                isValidate = 0;
//                $(".error-totalbags").show();
//            }
//        }
//        if (totalWeight === "") {
//            $(".error-totalweight").show();
//        } else {
//            if ((totalWeight <= "0.00")) {
//                isValidate = 0;
//                $(".error-totalweight").show();
//            }
//            if (!(totalWeight.match(decimal))) {
//                isValidate = 0;
//                $(".error-totalweight").show();
//            }
//        }

        if (isValidate === 0) {
            return false;
        } else {
            return true;
        }
    }





//    $('#OKButton').click(function() {
//        var totalBags = $('#ChalanItemsTable tr td:nth-last-child(4) input');
//        var totalQty = $('#ChalanItemsTable tr td:nth-last-child(3) input');
//        var sumTotalQty = 0.00;
//        var sumTotalBags = 0.00;
//        for (var i = 0; i < totalQty.length; i++) {
//            sumTotalQty = sumTotalQty + parseInt(totalQty[i].value);
//        }
//        for (var j = 0; j < totalBags.length; j++) {
//            sumTotalBags = sumTotalBags + parseInt(totalBags[j].value);
//        }
//        $('#TotalBags').val(sumTotalBags);
//        $('#TotalWeight').val(sumTotalQty);
//        if ((sumTotalBags > 0) && (sumTotalQty > 0)) {
//            enableElements('#SaveYarnDeliveryButton');
//        }
//    });
//    
//  Testing Of Back Button
//    function disableBack() {
//        window.history.forward();
//    }
//    window.onload = disableBack();
//    window.onpageshow = function(evt) {
//        if (evt.persisted)
//            disableBack();
//    };
</script>
