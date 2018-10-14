<?php
include 'include/leftmenu.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Processed Fabric Receiving
        </h1><br><br>
        <div class="row">
            <div class="pull-right" style="padding-right:15px;">
                <a class="btn btn-app" onclick="retrivePopup()">
                    <i class="fa fa-align-justify"></i> Retrieve                  
                </a>
                <a class="btn btn-app" onclick="reloadForm()">
                    <i class="fa fa-adn"></i> New                  
                </a>                                                
                <a id="EditAnchor" class="btn btn-app" onclick="ediForm('Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'editmenu')"> 
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
                    <form id="processedReceivingForm" name="processedReceivingForm" role="form" method="post" action="<?= base_url() ?>index.php/processedfabricreceiving/Add" onSubmit="return validationForm();">
                        <fieldset>
                            <legend onclick ="">General</legend>
                            <div id="FlashMessage">
                                <h5 style=""><?= $insertMessage ?></h5>
                                <h5 style=""><?= $updateMessage ?></h5>
                                <h5 style=""><?= $deleteMessage ?></h5>
                            </div>
                            <div id="ProcessedReceivingDiv">                                
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">PFR #</label>
                                    <input id="PFRNo" name="PFRNo" type="text"  value="<?php
                                    if ($pfr) {
                                        echo $pfr;
                                    }
                                    ?>" class="form-control" placeholder="" readonly>
                                </div>
                                <div id='' class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'> 
                                    <label>Processor Name</label> 
                                    <select id='ProcessorName' name='ProcessorName' class='form-control' style='width:200px;'><option value='0'>Select Processor</option><?php foreach ($processorList as $key) { ?><option value='<?= $key['Party_id'] ?>'><?= $key['CompanyName'] ?></option><?php } ?></select>                                                     
                                    <div class='form-group has-error form-error error-ProcessorName' style='width:0px;margin-left:0px;display:none;'>                                                     
                                        <label class='control-label' for='inputError'>Select Processor Name!</label>
                                    </div>
                                </div>                                                                 
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Receiving Date</label>
                                    <div class="input-group" style="width: 150px;">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input id="ReceivingDate" name="ReceivingDate" type="text" class="form-control" style="" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                                    </div>
                                    <div class="form-group has-error form-error error-GreighFabricDated" style="width: 130px;">
                                        <label class="control-label" for="inputError">Enter Date!</label>
                                    </div>
                                </div>
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Challan #</label>
                                    <input id="ChallanNo" name="ChallanNo" type="text" class="form-control" placeholder="Challan Number">
                                </div>  
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Driver Name</label>
                                    <input id="DriverName" name="DriverName" type="text" class="form-control" placeholder="Driver Name">
                                </div>
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Vehicle #</label>
                                    <input id="VehicleNo" name="VehicleNo" type="text" class="form-control" placeholder="Vehicle Number"  style="" required>
                                </div>                                                        
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Receiver Name</label>
                                    <input id="ReceivedBy" name="ReceivedBy" type="text" class="form-control" placeholder="Receiver Name"  style="" required>
                                    <input id="processed_fabric_receiving_id" name="processed_fabric_receiving_id" type="hidden" value="">
                                </div>
                            </div>
                        </fieldset>   
                        <fieldset> 
                            <div class='box-body table-responsive'> 
                                <legend onclick=''>Receiving Items</legend>                          
                                <div id='ReceivingItemsTable' class='box' style='margin-top: 20px;width:700px;overflow-x: scroll;'> 
                                    <div class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'> 
                                        <input id='AddButton' name='AddButton' class='btn btn-primary col-xs-12 col-sm-6 col-md-1' style='width:35px;height:30px;margin-left:-355px;margin-top:-12px;text-align:center;cursor: pointer' value='+' onclick='populateGridRows()' readonly> 
                                    </div>  
                                    <table id='receivingItemsGrid' class='table table-bordered table-striped' style='margin-top: 60px;'> 
                                        <thead> 
                                            <tr> 
                                                <th>S.No</th> 
                                                <th>PO #</th> 
                                                <th>Item Code</th>
                                                <th>Description</th>
                                                <th>Color</th> 
                                                <th>Rolls</th> 
                                                <th>Pieces</th>     
                                                <th>Warehouse</th>       
                                                <th>Add</th> 
                                                <th>Delete</th> 
                                            </tr> 
                                        </thead> 
                                        <tbody id='receivingItemsTbody'> 
                                            <tr> 
                                                <td tag=''>
                                                    <input id='SerialNoDetail' name='SerialNoDetail[]' value='1' type = 'text' class='form-control dcSno' style='width:55px' placeholder = 'SNo' readonly>
                                                </td>
                                                <td>
                                                    <select id='PONumber' name='PONumber[]' class='form-control' style='width:200px;'><option value='0'>Select PO Number</option><?php foreach ($customerOrders as $key) { ?><option value='<?= $key['customer_order_id'] ?>'><?= $key['PremierPO'] ?></option><?php } ?></select>
                                                    <div class='form-group has-error form-error error-PONumber' style='width:0px;margin-left:0px;display:none;'>                                                     
                                                        <label class='control-label' for='inputError'>Select PO Number!</label>
                                                    </div>
                                                </td>
                                                <td tag=''>
                                                    <select id='ItemCode' name='ItemCode[]' class='form-control' style='width:200px' onchange=''><option value='0'>Select Item Code</option><?php
                                                        foreach ($itemList as $key) {
                                                            ?><option value='<?= $key['item_id'] ?>'><?= $key['ItemCode'] ?></option><?php } ?></select>
                                                    <div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-ItemCode' style='width:0px;margin-left:0px;display:none;'>

                                                    </div>
                                                </td>
                                                <td tag=''>
                                                    <input id='Description' name='Description[]' value='<?php
                                                    if ($description) {
                                                        echo $description;
                                                    }
                                                    ?>' type='text' step='any' class='form-control' style='width:75px'>
                                                    <div class='form-group has-error form-error error-Rolls' style='width:0px;margin-left:0px;display:none;'> 
                                                        <label class='control-label' for='inputError'>Enter Description!</label>
                                                    </div>
                                                </td> 
                                                <td tag=''>
                                                    <input id='Color' name='Color[]' value='<?php
                                                    if ($color) {
                                                        echo $color;
                                                    }
                                                    ?>' type='text' step='any' class='form-control' style='width:75px'>
                                                    <div class='form-group has-error form-error error-Rolls' style='width:0px;margin-left:0px;display:none;'> 
                                                        <label class='control-label' for='inputError'>Enter Color!</label>
                                                    </div>
                                                </td> 

                                                <td tag=''><input id='Rolls' name='Rolls[]' value='<?php
                                                    if ($rolls) {
                                                        echo $rolls;
                                                    }
                                                    ?>' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Rolls' style='width:0px;margin-left:0px;display:none;'> 
                                                        <label class='control-label' for='inputError'>Enter Rolls!</label>
                                                    </div>
                                                </td> 
                                                <td tag=''><input id='Pieces' name='Pieces[]' value='<?php
                                                    if ($pieces) {
                                                        echo $pieces;
                                                    }
                                                    ?>' type='number' step='any' min='0' class='form-control' style='width:75px'>
                                                    <div class='form-group has-error form-error error-Pieces' style='width:0px;margin-left:0px;display:none;'>

                                                    </div>
                                                </td>
                                                <td>
                                                    <select id='warehouse' name='warehouse[]' class='form-control' style='width:200px;'><option value='0'>Select Warehouse</option>
                                                        <?php foreach ($warehouseCombo as $key) { ?><option value='<?= $key['Warehouse_id'] ?>'><?= $key['WarehouseName'] ?></option><?php } ?></select>
                                                    <div class='form-group has-error form-error error-warehouse' style='width:0px;margin-left:0px;display:none;'>                                                     
                                                        <label class='control-label' for='inputError'>Select Warehouse!</label>
                                                    </div>
                                                </td> 
                                                <td>
                                                    <input id='AddButton' name='AddButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='+' onclick='populateGridRows()' readonly>
                                                </td> 
                                                <td tag=''>
                                                    <input id='DelButton' name='DelButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='X' onclick='deleteGridRows(this)' readonly>
                                                </td>
                                            </tr> 
                                        </tbody> 
                                        <tfoot> 
                                            <tr></tr> 
                                        </tfoot> 
                                    </table> 
                                </div> 
                            </div>  
                        </fieldset> 
                        <div class='pull-right col-xs-6 col-sm-6 col-md-6' style='margin-top: 20px;'> 
                            <input id='SaveDelivery' type='submit' value='Save' class='btn btn-primary' style='width: 75px;float: right;'> 
                        </div> 
                    </form>
                </div><!-- /.box-body --> 
            </div>
        </div>
        </div><!-- /.box -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<script>

    $(document).ready(function () {

        $(".form-error").hide();
        formMode = "Add";
        //        disableElements("#SaveProcessedFabricReceivingButton");
        $('#EditAnchor').attr("disabled", "disabled");
        $('#PrintAnchor').attr("disabled", "disabled");
        $('#CSVAnchor').attr("disabled", "disabled");
        $('#FlashMessage').fadeOut(5000);
        $("#ReceivingDate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        // On Pressing Enter, Preventing Default Functionality
        onPressEnter('#processedReceivingForm');
        onPressEnter('#processedReceivingFormEdit');
    });
    var pfrCount = 0;
    var selectedCount = "";
    var selectedMill = "";
    var selectedWarehouse = "";
    var brandValue = "";
    var stockElement;
    function populateGridRows() {
        var deliverItemsCount = 0;
        var countRows = $("#receivingItemsGrid> tbody").children().length;
        if (countRows > 0) {
            deliverItemsCount = $('#receivingItemsGrid tbody>tr:last').find("td:first").find('input').val();
            deliverItemsCount = parseInt(deliverItemsCount);
        }
        deliverItemsCount = parseInt(deliverItemsCount) + 1;
        var items = [];
        items += "<tr>" +
                "<td tag=''><input id='SerialNoDetail' name='SerialNoDetail[]' value='" + deliverItemsCount + "' type = 'text' class='form-control dcSno' style='width:55px' placeholder = 'SNo' readonly></td>" +
                "<td><select id='PONumber' name='PONumber[]' class='form-control' style='width:200px;'><option value='0'>Select PO Number</option><?php foreach ($customerOrders as $key) { ?><option value='<?= $key['customer_order_id'] ?>'><?= $key['PremierPO'] ?></option><?php } ?></select><div class='form-group has-error form-error error-PONumber' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Select PO Number!</label></div></td>" +
                "<td><select id='ItemCode' name='ItemCode[]' class='form-control' style='width:200px;'><option value='0'>Select Item Code</option><?php foreach ($itemList as $key) { ?><option value='<?= $key['item_id'] ?>'><?= $key['ItemCode'] ?></option><?php } ?></select><div class='form-group has-error form-error error-ItemCode' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Select Item Code!</label></div></td>" +
                "<td tag=''><input id='Description' name='Description[]' type='text' step='any' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Description' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Description!</label></div></td>" +
                "<td tag=''><input id='Color' name='Color[]' type='text' step='any' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Color' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Color!</label></div></td>" +
                "<td tag=''><input id='Rolls' name='Rolls[]' value='0' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Rolls' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Rolls!</label></div></td>" +
                "<td tag=''><input id='Pieces' name='Pieces[]' value='0' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Pieces' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Pieces!</label></div></td>" +
                "<td><select id='warehouse' name='warehouse[]' class='form-control' style='width:200px;'><option value='0'>Select warehouse</option><?php foreach ($warehouseCombo as $key) { ?><option value='<?= $key['Warehouse_id'] ?>'><?= $key['WarehouseName'] ?></option><?php } ?></select><div class='form-group has-error form-error error-warehouse' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Select warehouse!</label></div></td>" +
                "<td><input id='AddButton' name='AddButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='+' onclick='populateGridRows()' readonly></td>" +
                "<td tag=''><input id='DelButton' name='DelButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='X' onclick='deleteGridRows(this)' readonly></td></tr>";
        $('#receivingItemsTbody').append(items);
        if (formMode === "Edit") {
            resetSNO();
        }
    }

    function deleteGridRows(r) {
        var itemsCount = 0;
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('deliveryItemsGrid').deleteRow(i);
        resetSNO();
    }

    function resetSNO() {
        var countRows = $("#deliveryItemsGrid > tbody").children().length;
        var sNO = $("#deliveryItemsGrid").find(".dcSno");
        if (countRows > 0) {
            for (var counter = 1; counter <= countRows; counter++) {
                $(sNO[counter - 1]).val(counter);
            }
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

    function onPressEnter(id) {

        $(id).bind("keypress", function (e) {
            if (e.keyCode == 13) {
                return false;
            }
        });
    }

    function retrivePopup() {
    formMode = "Retrieve";
            $("#EditAnchor").removeAttr("disabled");
            $("#PrintAnchor").removeAttr("disabled");
            bootbox.dialog({
            title: "Processed Fabric Receiving",
                    message: "<fieldset>" +
                    "<div class='box box-primary'>" +
                    "<div class='box-body'>" +
                    "<form name='processedFabricReceivingFormEdit' role='' method='' action='' class=''>" +
                    "<br><div class='col-md-12'>" +
                    "<div class='pull-left col-md-2'>" +
                    "<label>Search</label>" +
                    "</div>" +
                    "<div class='pull-left col-md-4'>" +
                    "<input id='searchProcessedFabricReceiving' name='searchProcessedFabricReceiving' type='text' class='form-control' onkeyup='search()' placeholder='Search by PFR No.' style='width:200px;margin-left:-100px;'>" +
                    "<input id='SearchNow' type='button' value='OK' class='btn btn-primary' onclick='search()' style='width: 100px;margin-left: 110px;margin-top:-58px;'>" +
                    "</div>" +
                    "</div><br><br><br>" +
                    "<fieldset>" +
                    "<div class='box-body table-responsive'>" +
                    "<div class='box'>" +
                    "<table class='table table-bordered table-striped'>" +
                    "<thead>" +
                    "<tr>" +
                    "<th width='10%'>PFR No.</th>" +
                    "<th width='10%'>Receiving Date</th>" +
                    "<th width='10%'>Processor Name</th>" +
                    "<th width='10%'>Total Pieces</th>" +
                    "<th width='10%'>Total Rolls</th>" +
                    "<th width='10%'>Driver Name</th>" +
                    "<th width='10%'>Vehicle No</th>" +
                    "<th width='10%'>Challan No</th>" +
                    "<th width='10%'>Receiver By</th>" +
                    "<th width='10%'>Details</th>" +
                    "</tr>" +
                    "</thead>" +
                    "<tbody id='GreighFabricDeliveryTbody'>" +<?php
                                                        foreach ($pfrList as $key) {
                                                            ?>
                "<tr>" +
                        "<td><?= $key['ProcessedFabricReceivingNo'] ?></td>" +
                        "<td><?= $key['ReceivingDate'] ?></td>" +
                        "<td><?= $key['CompanyName'] ?></td>" +
                        "<td><?= number_format($key['TotalPieces']) ?></td>" +
                        "<td><?= number_format($key['TotalRolls']) ?></td>" +
                        "<td><?= $key['VehicleNo'] ?></td>" +
                        "<td><?= $key['DriverName'] ?></td>" +
                        "<td><?= $key['ChallanNo'] ?></td>" +
                        "<td><?= $key['ReceivedBy'] ?></td>" +
                        "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('<?= $key['processed_fabric_receiving_id'] ?>','<?= rawurlencode($key['ProcessedFabricReceivingNo']) ?>','<?= rawurlencode($key['CompanyName']) ?>','<?= rawurlencode($key['ReceivingDate']) ?>','<?= rawurlencode($key['ChallanNo']) ?>','<?= rawurlencode($key['DriverName']) ?>','<?= rawurlencode($key['VehicleNo']) ?>','<?= rawurlencode($key['ReceivedBy']) ?>','<?= $key['premier_po'] ?>','<?= $key['item_code'] ?>','Description','<?= $key['colors'] ?>','<?= $key['rolls'] ?>','<?= $key['pieces'] ?>','<?= $key['warehouseId'] ?>','None')>Edit</a>" +
                        "<span> | </span>" +
                        "<a style='cursor: pointer;' href='<?= base_url() ?>index.php/processedfabricreceiving/Delete/<?= $key['processed_fabric_receiving_id'] ?>'>Delete</a>" +
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
                    "</tr>" +
                    "</tfoot>" +
                    "</table>" +
                    "</div>" +
                    "</div>" +
                    "</fieldset>" +
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

    function ediForm(processedFabricReceivingId, processedFabricReceivingNo, CompanyName, ReceivingDate, ChallanNo, DriverName, VehicleNo, ReceivedBy, PremierPO, ItemCode, Description, Colors, Rolls, Pieces, Warehouse, type) {
    if (type === 'editmenu') {
    formMode = "Edit";
            var action = "<?php echo base_url() ?>index.php/processedfabricreceiving/Update";
            enableElements("#ProcessorName");
            enableElements("#ReceivingDate");
            enableElements("#ChallanNo");
            enableElements("#DriverName");
            enableElements("#VehicleNo");
            enableElements("#ReceivedBy");
            enableElements("#ReceivingItemsTable *");
            enableElements("#OKButton");
            enableElements("#SaveProcessedFabricReceivingButton");
            var countRows = $("#receivingItemsGrid> tbody").children().length;
            if (countRows > 0) {
    enableElements('#SaveProcessedFabricReceivingButton');
    }

    console.log("action");
            console.log(action);
            document.getElementById("processedReceivingForm").action = action;
    }
    else {
    console.log(decodeURI(ItemCode));
            var parsedData = ItemCode.split(',');
            var splitWarehouse = Warehouse.split(',');
            var splitPremierPo = PremierPO.split(',');
            var splitDescription = Description.split(',');
            var splitColors = Colors.split(',');
            var splitRolls = Rolls.split(',');
            var splitPieces = Pieces.split(',');
            console.log("splitWarehouse");
            console.log(splitWarehouse);
            if (parsedData.length > 0) {
    $("#processed_fabric_receiving_id").val(processedFabricReceivingId);
            $("#PFRNo").val(processedFabricReceivingNo);
            $("#ReceivingDate").val(getFormatedDate(ReceivingDate));
            $("#ChallanNo").val(decodeURI(ChallanNo));
            $("#DriverName").val(decodeURI(DriverName));
            $("#VehicleNo").val(decodeURI(VehicleNo));
            $("#ReceivedBy").val(decodeURI(ReceivedBy));
            $('#ProcessorName option').filter(function () {
    return ($(this).text() === decodeURI(CompanyName));
    }).prop('selected', true);
            var items = [];
            $.each(parsedData, function (i, val) {
            items += "<tr>" +
                    "<td tag=''><input id='SerialNoDetail' name='SerialNoDetail[]' value='" + (i + 1) + "' type = 'text' class='form-control dcSno' style = 'width: 55px;' placeholder = 'SNo' readonly></td>" +
                    "<td tag=''><select id='PONumber' name='PONumber[]' class='form-control' style='width:200px;'><option value='0'>Select PO Number</option><?php foreach ($customerOrders as $key) { ?><option " + (splitPremierPo[i] === '<?= $key['PremierPO'] ?>' ? "selected" : "") + " value='<?= $key['customer_order_id'] ?>'><?= $key['PremierPO'] ?></option><?php } ?></select><div class='form-group has-error form-error error-PONumber' style='width:0px;margin-left:0px;display:none;'><label class='control-label' for='inputError'>Select PO Number!</label></div></td>" +
                    "<td tag=''><select id='ItemCode' name='ItemCode[]' class='form-control' style='width:200px' onchange=''><option value='0'>Select Item Code</option><?php foreach ($itemList as $key) { ?><option " + (parsedData[i] === '<?= $key['ItemCode'] ?>' ? "selected" : "") + " value = '<?= $key['item_id'] ?>'><?= $key['ItemCode'] ?></option><?php } ?></select><div class = 'pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-ItemCode' style = 'width:0px;margin-left:0px;display:none;'></div></td> " +
                    "<td tag=''><input id='Description' name='Description[]' value=" + splitDescription[i] + " type='text' step='any' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Rolls' style='width:0px;margin-left:0px;display:none;'><label class='control-label' for='inputError'>Enter Description!</label></div></td>" +
                    "<td tag=''><input id='Color' name='Color[]' value=" + splitColors[i] + " type='text' step='any' class='form-control' style='width:75px'><div class = 'form-group has-error form-error error-Rolls' style = 'width:0px;margin-left:0px;display:none;'><label class = 'control-label' for = 'inputError' > Enter Color! < /label></div></td>" +
                    "<td tag=''><input id='Rolls' name='Rolls[]' value=" + splitRolls[i] + "  type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Rolls' style='width:0px;margin-left:0px;display:none;'><label class='control-label' for='inputError'>Enter Rolls!</label></div></td>" +
                    "<td tag=''><input id='Pieces' name='Pieces[]' value=" + splitPieces[i] + " type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Pieces' style = 'width:0px;margin-left:0px;display:none;'><label class='control-label' for='inputError'>Enter Rolls!</label></div></td>" +
                    "<td tag=''><select id='warehouse' name='warehouse[]' class='form-control' style='width:200px;'><option value='0'>Select Warehouse</option><?php foreach ($warehouseCombo as $key) { ?> <option " + (splitWarehouse[i] === '<?= $key['Warehouse_id'] ?>' ? "selected" : "") + " value= '<?= $key['Warehouse_id'] ?>'><?= $key['WarehouseName'] ?> </option><?php } ?></select><div class = 'form-group has-error form-error error-warehouse' style = 'width:0px;margin-left:0px;display:none;'> <label class = 'control-label' for='inputError'>Select Warehouse!</label></div></td>" +
                    "<td><input id='AddButton' name='AddButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='+' onclick='populateGridRows()' readonly></td>" +
                    "<td tag=''><input id='DelButton' name='DelButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='X' onclick='deleteGridRows(this)' readonly></td></tr>";
                    $("#receivingItemsTbody").html(items);
            });
    }
    disableElements("#ProcessorName");
            disableElements("#ReceivingDate");
            disableElements("#ChallanNo");
            disableElements("#DriverName");
            disableElements("#VehicleNo");
            disableElements("#ReceivedBy");
            disableElements("#ReceivingItemsTable *");
            disableElements("#OKButton");
            disableElements("#SaveProcessedFabricReceivingButton");
            resetSNO();
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

    function search() {
    var searchValue = $('#searchProcessedFabricReceiving').val();
            if (searchValue === "") {
    bootbox.alert("Please enter value to search for", function(result) {
    });
    }
    else{
    $.ajax({
    url: "<?= base_url() ?>index.php/processedfabricreceiving/search",
            type: "POST",
            data: {search: searchValue},
            success: function(data) {
            if (data !== "null")
            {
            var parsedData = JSON.parse(data);
                    if (parsedData.length > 0) {

            console.log("parsedData");
                    console.log(parsedData[0].warehouseId);
                    var items = [];
                    var counter = 0;
                    $.each(parsedData, function(i, val) {
                    counter = parseInt(counter) + 1;
                            items += "<tr>" +
                            "<td>" + val.ProcessedFabricReceivingNo + "</td>" +
                            "<td>" + val.ReceivingDate + "</td>" +
                            "<td>" + val.CompanyName + "</td>" +
                            "<td>" + fractionNotation(val.TotalPieces, 2) + "</td>" +
                            "<td>" + fractionNotation(val.TotalRolls, 2) + "</td>" +
                            "<td>" + val.DriverName + "</td>" +
                            "<td>" + val.VehicleNo + "</td>" +
                            "<td>" + val.ChallanNo + "</td>" +
                            "<td>" + val.ReceivedBy + "</td>" +
                            "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('" + val.processed_fabric_receiving_id + "','" + val.ProcessedFabricReceivingNo + "','" + encodeURI(val.CompanyName) + "','" + val.ReceivingDate + "','" + encodeURI(val.ChallanNo) + "','" + encodeURI(val.DriverName) + "','" + encodeURI(val.VehicleNo) + "','" + encodeURI(val.ReceivedBy) + "','" + val.premier_po + "','" + val.item_code + "','Description','" + encodeURI(val.colors) + "','" + val.rolls + "','" + val.pieces + "','" + val.warehouseId + "','None')>Edit</a>" +
                            "<span> | </span>" +
                            "<a style='cursor: pointer;' href='<?= base_url() ?>index.php/processedfabricreceiving/Delete/'" + val.processed_fabric_receiving_id + "'>Delete</a>" +
                            "</td>" +
                            "</tr>";
                    });
                    $("#GreighFabricDeliveryTbody").html(items);
            }

            }

            }
    });
    }
    }


    // $("#yarnDeliveryTbodyDetail").html("<tr><td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td></tr>");


</script>
