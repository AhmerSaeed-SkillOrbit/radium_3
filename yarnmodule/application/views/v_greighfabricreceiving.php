<?php
include 'include/leftmenu.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Greigh Fabric Receiving 
        </h1><br><br>
        <div class="row">
            <div class="pull-right" style="padding-right:15px;">
                <a class="btn btn-app" onclick="retrivePopup()">
                    <i class="fa fa-align-justify"></i> Retrieve                  
                </a>
                <a class="btn btn-app" onclick="reloadForm()">
                    <i class="fa fa-adn"></i> New                  
                </a>                                                
                <a id="EditAnchor" class="btn btn-app" onclick="ediForm('Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'editmenu')"> 
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a class="btn btn-app" onclick="resetForm()">
                    <i class="fa fa-repeat"></i> Reset
                </a>
                <a id="PrintAnchor" class="btn btn-app" onclick="printPC()">
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
                <div class="box-body">
                    <!-- form start -->
                    <form id="greighFabricReceivingForm" name="greighFabricReceivingForm" role="form" method="post" action="<?= base_url() ?>index.php/greighfabricreceiving/Add" onSubmit="return validationForm()"> 
                        <fieldset>
                            <legend onclick="">Greigh Fabric Receiving Information</legend>
                            <div id="FlashMessage">
                                <h5 id="GreighFabricReceivingInsertMessage" style=""><?= $insertMessage ?></h5>
                                <h5 id="GreighFabricReceivingUpdateMessage" style=""><?= $updateMessage ?></h5>
                                <h5 id="GreighFabricReceivingDeleteMessage" style=""><?= $deleteMessage ?></h5>
                            </div>  
                            <div id="GreighFabricReceivingInfoDiv">
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <input id="greigh_fabric_receiving_id" name="receiving_id" type="hidden" value="">
                                    <input id="greigh_fabric_delivery_id" name="delivery_id" type="hidden" value="">
                                    <label for="">Greigh Fabric Receiving No.</label>
                                    <input id="GreighFabricReceivingNo" name="GreighFabricReceivingNo" type="text" value="<?php
                                    if ($gfrNumber) {
                                        echo $gfrNumber;
                                    }
                                    ?>" class="form-control" style="" readonly>
                                    <div class="form-group has-error form-error error-GreighFabricReceivingNo" style="width: 150px;">
                                        <label class="control-label" for="inputError">Enter Greigh Fabric Receiving No.!</label>
                                    </div>
                                </div>                      
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Dated</label>
                                    <div class="input-group" style="width: 150px;">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input id="GreighFabricDated" name="GreighFabricDated" type="text" class="form-control" style="" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                                    </div>
                                    <div class="form-group has-error form-error error-gfdate" style="width: 130px;">
                                        <label class="control-label" for="inputError">Enter Date!</label>
                                    </div>
                                </div>                           
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Party Name</label>
                                    <select id="PartyName" name="PartyName" class="form-control" style="width:200px;">
                                        <option value="Select Party">Select Party</option>                                       
                                        <?php
                                        foreach ($partyList as $key) {
                                            ?>
                                            <option value="<?php echo $key['Party_id'] ?>"><?php echo $key['CompanyName'] ?></option>
                                        <?php }
                                        ?>                                
                                    </select>
                                    <div class="pull-left col-xs-6 col-sm-4 col-md-4 form-group has-error form-error error-partyname" style="width: 150px;margin-left: 0px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>  
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <input id="greigh_fabric_receiving_id" name="greigh_fabric_receiving_id" type="hidden" value="">
                                    <label for="">Challan Number</label>
                                    <input id="ChallanNo" name="ChallanNo" type="text" value="" min="0" class="form-control" style="" placeholder="Challan Number">
                                    <div class="form-group has-error form-error error-ChallanNo" style="width: 150px;">
                                        <label class="control-label" for="inputError">Enter Challan Number!</label>
                                    </div>
                                </div>
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Item Code</label>
                                    <select id="ItemCode" name="ItemCode" class="form-control" style="width:200px;" onchange="populateItemInfo()">
                                        <option value="Select Item Code">Select Item Code</option>
                                        <?php
                                        foreach ($itemList as $key) {
                                            ?>
                                            <option value="<?php echo $key['item_id'] ?>"><?php echo $key['ItemCode'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-6 col-sm-4 col-md-4 form-group has-error form-error error-itemcode" style="width: 150px;margin-left: 0px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Size</label>  
                                    <input id="Size" name="Size" type="text" value="" class="form-control" style="" readonly>                                    
                                </div>
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Finsih Weight</label>  
                                    <input id="FinishWeight" name="FinishWeight" type="text" value="" class="form-control" style="" readonly> 
                                    <input id="FinishWeightUnit" name="FinishWeightUnit" type="hidden" value="" class="form-control" style="">
                                </div>
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Blend Ratio</label>  
                                    <input id="BlendRatio" name="BlendRatio" type="text" value="" class="form-control" style="" readonly>                                    
                                </div>
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Pile Yarn</label>  
                                    <input id="PileYarn" name="PileYarn" type="text" value="" class="form-control" style="" readonly>                                    
                                </div>
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Weft Yarn</label>  
                                    <input id="WeftYarn" name="WeftYarn" type="text" value="" class="form-control" style="" readonly>                                    
                                </div>
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Ground Yarn</label>  
                                    <input id="GroundYarn" name="GroundYarn" type="text" value="" class="form-control" style="" readonly>                                    
                                </div>
                               <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Total Pieces</label>  
                                    <input id="TotalPieces" name="TotalPieces" type="number" value="" min="0" step="any" class="form-control" style="" placeholder="Total Pieces">
                                    <div class="form-group has-error form-error error-TotalPieces" style="width: 130px;">
                                        <label class="control-label" for="inputError">Enter Total Pieces!</label>
                                    </div>
                                </div> 
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Total Weight (Kgs)</label>
                                    <input id="TotalWeight" name="TotalWeight" type="number" value="" min="0" step="any" class="form-control" style="" placeholder="Total Weight (Kgs)">
                                    <div class="form-group has-error form-error error-TotalPieces" style="width: 130px;">
                                        <label class="control-label" for="inputError">Enter Total Weight (Kgs)!</label>
                                    </div>
                                </div> 
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Total Rolls</label>
                                    <input id="TotalRolls" name="TotalRolls" type="number" value="" min="0" step="any" class="form-control" style="" placeholder="Total Rolls">
                                </div>
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Warehouse</label>
                                    <select id="warehouse" name="warehouse" class="form-control" style="">
                                        <option value="Select Warehouse">Select Warehouse</option>
                                        <?php
                                        foreach ($warehouseCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['Warehouse_id'] ?>"><?php echo $key['WarehouseName'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-6 col-sm-4 col-md-4 form-group has-error form-error error-warehouse" style="width: 150px;margin-left: 0px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Avg. Lbs Per Dozen Received</label>
                                    <input id="AvgLbsPerDozen" name="AvgLbsPerDozen" type="number" value="0.000" step="any" class="form-control" onchange="GetHeavyLightPercent()" style="" readonly>                                    
                                </div>
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Gram per Piece</label>
                                    <input id="GramPerPiece" name="GramPerPiece" type="number" value="0.000" step="any" class="form-control" style=""  readonly>                                    
                                </div>
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Heavy / Light</label>
                                    <input id="HeavyLight" name="HeavyLight" type="number" value="0" step="any" class="form-control" style="" readonly>
                                </div>
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Received By</label>
                                    <input id="ReceivedBy" name="ReceivedBy" type="text" value="" class="form-control" style="" placeholder="Received By">
                                    <div class="form-group has-error form-error error-ReceivedBy" style="width: 150px;">
                                        <label class="control-label" for="inputError">Enter Received By!</label>
                                    </div>
                                </div><br>                
                                <div class="pull-right col-xs-6 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <br><input id="SaveGreighFabricReceiving" type="submit" value="Save" class="btn btn-primary" style="width: 75px;float: right;">
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
        //$("#DeliveryInfo").hide();
        formMode = "Add";
        $('#FlashMessage').fadeOut(5000);
        $("#GreighFabricDated").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                <?php
            if (strval($operation) == "1" || strval($operation) == "2")
            {
                echo "bootbox.confirm('Do you want to issue for Processing ?', function(result) {
                        if (result) {
                            greighFabricDeliveryPopup();
                        }                      
                    });";
            }            
        ?>       
    });

    $("#TotalPieces").focusout(function() {
        GetAverageLbsPerDozen();
        GetAverageGramsPerPiece();
        //GetHeavyLightPercent();
    });

    $("#TotalWeight").focusout(function() {
        GetAverageLbsPerDozen();
        GetAverageGramsPerPiece();
        //GetHeavyLightPercent();
    });
    
    $("#AvgLbsPerDozen").change(function() {
        GetHeavyLightPercent();
    });
      
    function retrivePopup() {
        formMode = "Retrieve";
        $("#EditAnchor").removeAttr("disabled");
        $("#PrintAnchor").removeAttr("disabled");
        bootbox.dialog({
        title: "Greigh Fabric Receiving",
        message: "<fieldset>" +
                    "<div class='box box-primary'>" +
                    "<div class='box-body'>" +
                    "<form name='greighFabricReceivingFormEdit' role='' method='' action='' class=''>" +
                    "<br><div class='col-md-12'>" +
                    "<div class='pull-left col-md-2'>" +
                    "<label>Search</label>" +
                    "</div>" +
                    "<div class='pull-left col-md-4'>" +
                    "<input id='searchGreighFabricReceiving'name='searchGreighFabricReceiving'type='text'class='form-control' onkeyup='search()' placeholder='Search by GFR No.' style='width:200px;margin-left:-100px;'>" +
                    "<input id='SearchNow' type='button' value='OK' class='btn btn-primary' onclick='search()' style='width: 100px;margin-left: 110px;margin-top:-58px;'>" +
                    "</div>" +
                    "</div><br><br><br>" +
                    "<fieldset>" +
                    "<div class='box-body table-responsive'>" +
                    "<div class='box'>" +
                    "<table class='table table-bordered table-striped'>" +
                    "<thead>" +
                    "<tr>" +
                    "<th width='10%'>GFR No.</th>" +
                    "<th width='10%'>Date</th>" +
                    "<th width='10%'>Item Code</th>" +
                    "<th width='10%'>Party Name</th>" +
                    "<th width='10%'>Total Pieces</th>" +
                    "<th width='10%'>Total Weight</th>" +
                    "<th width='10%'>Total Rolls</th>" +
                    "<th width='10%'>Warehouse</th>" +
                    "<th width='10%'>Details</th>" +
                    "</tr>" +
                    "</thead>" +
                    "<tbody id='GreighFabricReceivingTbody'>" +<?php
                                        foreach ($gfList as $key) {
                                            ?>
                "<tr>" +
                        "<td><?= $key['GreighFabricReceivingNo'] ?></td>" +
                        "<td><?= $key['Date'] ?></td>" +                        
                        "<td><?= $key['ItemCode'] ?></td>" +
                        "<td><?= $key['CompanyName'] ?></td>" +
                        "<td><?= number_format($key['TotalPieces']) ?></td>" +
                        "<td><?= number_format($key['TotalWeight']) ?></td>" +
                        "<td><?= number_format($key['TotalRolls']) ?></td>" +
                        "<td><?= $key['warehouse'] ?></td>" +
                        "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('<?= $key['greigh_fabric_receiving_id'] ?>','<?= rawurlencode($key['GreighFabricReceivingNo']) ?>','<?= rawurlencode($key['Date']) ?>','<?= rawurlencode($key['CompanyName']) ?>','<?= rawurlencode($key['ChallanNo']) ?>','<?= rawurlencode($key['ItemCode']) ?>','<?= rawurlencode($key['TotalPieces']) ?>','<?= rawurlencode($key['TotalWeight']) ?>','<?= rawurlencode($key['TotalRolls']) ?>','<?= rawurlencode($key['warehouse']) ?>','<?= rawurlencode($key['AvgLbsPerDozenReceived']) ?>','<?= rawurlencode($key['GramPerPieceReceived']) ?>','<?= rawurlencode($key['HeavyLightPercent']) ?>','<?= rawurlencode($key['ReceivedBy']) ?>','<?= rawurlencode($key['IssueToProcessor']) ?>','<?= rawurlencode($key['Processer']) ?>','<?= rawurlencode($key['IssueBy']) ?>','<?= rawurlencode($key['DeliveryReceivedBy']) ?>','<?= rawurlencode($key['VehicleNo']) ?>','<?= $key['greigh_fabric_delivery_id'] ?>','None')>Edit</a>" +
                        "<span> | </span>" +
                        "<a style='cursor: pointer;' href='<?= base_url() ?>index.php/greighfabricreceiving/Delete/<?= $key['greigh_fabric_receiving_id'] ?>'>Delete</a>" +
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
    
    function greighFabricDeliveryPopup() {
            bootbox.dialog({
            title: "Greigh Fabric Delivery",
                    message:
                    "<fieldset>" +
                    "<div class='box box-primary'>" +
                    "<div class='box-body'>" +
                    "<form id='greighFabricDeliveryForm' name='greighFabricDeliveryForm' role='form' method='post' action='<?= base_url() ?>index.php/greighfabricreceiving/<?php if (strval($operation) == "1") { echo "InsertGreighFabricDelivery";} else {echo "UpdateGreighFabricDelivery";}?>/<?=$gfrn ?>' onSubmit='return validateDeliveryForm()'>" +
                    "<legend onclick=''>Delivery Information</legend>" +
                    "<div id='deliveryDiv'>" +
                    "<div id='' class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label>GFDC#</label>" +
                    "<input id='GFDC' name='GFDC' type='text' value='<?php if ($gfdc) { echo $gfdc;}?>' class='form-control' readonly>" +
                    "</div>"+
                    "<input id='greigh_fabric_delivery_id' name='delivery_id' type='hidden' value='<?php if ($gfdn) { echo $gfdn;}?>'>"+
                    "<input id='date' name='date' type='hidden' value='<?php if ($gfdcDate) { echo $gfdcDate;}?>'>"+
                    "<input id='item_id' name='item_id' type='hidden' value='<?php if ($item_id) { echo $item_id;}?>'>"+
                    "<input id='warehouse_id' name='warehouse_id' type='hidden' value='<?php if ($warehouse_id) { echo $warehouse_id;}?>'>"+
                    "<div id='' class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label>Challan No</label>" +
                    "<input id='ChallanNoDelivery' name='ChallanNoDelivery' type='text' class='form-control' placeholder='Challan No' value='<?php if ($dcNo) { echo $dcNo;}?>'>"+
                    "</div>" +
                    "<div class='form-group has-error form-error error-ChallanNoDelivery' style='width:0px;margin-left:0px;display:none;'>" +                                                    
                    "<label class='control-label' for='inputError'>Enter Challan No.!</label></div>" +
                    "<div id='' class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label>Processor Name</label>" +
                    "<select id='ProcessorName' name='ProcessorName' class='form-control' style='width:200px;'><option value='0'>Select Processor</option><?php 
                            foreach ($processorList as $key) {?><option value='<?= $key['Party_id'] ?>'><?= $key['CompanyName'] ?></option><?php }?></select>" +                                                    
                    "</div>" + 
                    "<div class='form-group has-error form-error error-ProcessorName' style='width:0px;margin-left:0px;display:none;'>" +                                                    
                    "<label class='control-label' for='inputError'>Select Processor Name!</label></div>" +
                    "<div id='' class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label>Issue By</label>" +
                    "<input id='IssueBy' name='IssueBy' type='text' class='form-control' placeholder='Issue By' value='<?php if ($issueby) { echo $issueby;}?>'>"+
                    "</div>" +
                    "<div class='form-group has-error form-error error-IssueBy' style='width:0px;margin-left:0px;display:none;'>" +                                                    
                    "<label class='control-label' for='inputError'>Enter Issue By!</label></div>" +
                    "<div id='' class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label>Received By</label>" +
                    "<input id='ReceivedByDelivery' name='ReceivedByDelivery' type='text' class='form-control' placeholder='Received By' value='<?php if ($receivedby) { echo $receivedby;}?>'>"+
                    "</div>" +
                    "<div class='form-group has-error form-error error-ReceivedByDelivery' style='width:0px;margin-left:0px;display:none;'>" +                                                    
                    "<label class='control-label' for='inputError'>Enter Received By!</label></div>" +
                    "<div id='' class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<label>Vehicle No</label>" +
                    "<input id='VehicleNo' name='VehicleNo' type='text' class='form-control' placeholder='Vehicle No' value='<?php if ($vehicleNo) { echo $vehicleNo;}?>'>"+
                    "</div>" +
                    "<div class='form-group has-error form-error error-VehicleNo' style='width:0px;margin-left:0px;display:none;'>" +                                                    
                    "<label class='control-label' for='inputError'>Enter Vehicle No.!</label></div>" +
                    "</div>" +                  
                    "<fieldset>" +
                    "<div class='box-body table-responsive'>" +
                    "<legend onclick=''>Delivery Items</legend>" +                         
                    "<div id='DeliveryItemsTable' class='box' style='margin-top: 20px;width:700px;overflow-x: scroll;'>" +
                    "<div class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<input id='AddButton' name='AddButton' class='btn btn-primary col-xs-12 col-sm-6 col-md-1' style='width:35px;height:30px;margin-left:-355px;margin-top:-12px;text-align:center;cursor: pointer' value='+' onclick='populateGridRows()' readonly>" +
                    "</div>" + 
                    "<table id='deliveryItemsGrid' class='table table-bordered table-striped' style='margin-top: 60px;'>" +
                    "<thead>" +
                    "<tr>" +
                    "<th>S.No</th>" +
                    "<th>Rolls</th>" +
                    "<th>Pieces</th>" +
		    "<th>Weight</th>" +
                    "<th>PO#</th>" +      
                    "<th>Add</th>" +
                    "<th>Delete</th>" +
                    "</tr>" +
                    "</thead>" +
                    "<tbody id='deliveryItemsTbody'>" +
                    "<tr>" +
                    "<td tag=''><input id='SerialNoDetail' name='SerialNoDetail[]' value='1' type = 'text' class='form-control dcSno' style='width:55px' placeholder = 'SNo' readonly></td>" +
                    "<td tag=''><input id='Rolls' name='Rolls[]' value='<?php if($rolls) {echo $rolls;} ?>' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Rolls' style='width:0px;margin-left:0px;display:none;'>" +
                    "<label class='control-label' for='inputError'>Enter Rolls!</label></div></td>" +
                    "<td tag=''><input id='Pieces' name='Pieces[]' value='<?php  if($pieces) {echo $pieces;} ?>' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Pieces' style='width:0px;margin-left:0px;display:none;'>" +
                    "<label class='control-label' for='inputError'>Enter Pieces!</label></div></td>" +
                    "<td tag=''><input id='Weight' name='Weight[]' value='<?php if($weight) {echo $weight;} ?>' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Weight' style='width:0px;margin-left:0px;display:none;'>" +
                    "<label class='control-label' for='inputError'>Enter Weight!</label></div></td>" +
                    "<td><select id='PONumber' name='PONumber[]' class='form-control' style='width:200px;'><option value='0'>Select PO Number</option><?php 
                            foreach ($customerOrders as $key) {?><option value='<?= $key['customer_order_id'] ?>'><?= $key['PremierPO'] ?></option><?php }?></select><div class='form-group has-error form-error error-PONumber' style='width:0px;margin-left:0px;display:none;'>" +                                                    
                    "<label class='control-label' for='inputError'>Select PO Number!</label></div></td>" +
                    "<td><input id='AddButton' name='AddButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='+' onclick='populateGridRows()' readonly></td>" +
                    "<td tag=''><input id='DelButton' name='DelButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='X' onclick='deleteGridRows(this)' readonly></td>"+
                    "</tr>" +
                    "</tbody>" +
                    "<tfoot>" +
                    "<tr></tr>" +
                    "</tfoot>" +
                    "</table>" +
                    "</div>" +
//                    "<div id='' class='col-md-12' style='margin-top: 10px;'>" +
//                    "<div class='pull-left col-xs-10 col-sm-5 col-md-5' style=''>" +
//                    "<label>Total Rolls</label>" +
//                    "<input id='TotalRollsDelivery' name='TotalRollsDelivery' type='text' value='' class='form-control' placeholder='0' style='' readonly>" +
//                    "<div class='form-group has-error form-error error-TotalRollsDelivery' style='width: 235px;margin-left: 5px;display: none;'>" +
//                    "<label class='control-label' for='inputError'>value must be greater than zero!</label>" +
//                    "</div>" +
//                    "</div>" +
//                    "<div class='pull-left col-xs-10 col-sm-5 col-md-5' style=''>" +
//                    "<label>Total Pieces</label>" +
//                    "<input id='TotalPiecesDelivery' name='TotalPiecesDelivery' type='text'  value='' class='form-control' placeholder='0'  style='' readonly>" +
//                    "<div class='form-group has-error form-error error-TotalPiecesDelivery' style='width: 235px;margin-left:5px;display: none;'>" +
//                    "<label class='control-label' for='inputError'>value must be greater than zero!</label>" +
//                    "</div>" +
//                    "</div>" +
//                    "</div>" +
//                    "<div id='' class='col-md-12' style='margin-top: 20px;'>" +
//                    "<div class='pull-left col-xs-10 col-sm-5 col-md-5' style=''>" +
//                    "<label>Total Weight</label>" +
//                    "<input id='TotalWeightDelivery' name='TotalWeightDelivery' type='text' value='' class='form-control' placeholder='0.00' style='' readonly>" +
//                    "<div class='form-group has-error form-error error-TotalWeightDelivery' style='width: 235px;margin-left:5px;display: none;'>" +
//                    "<label class='control-label' for='inputError'>value must be a Decimal,Greater than zero!</label>" +
//                    "</div>" +
//                    "</div>" +                                    
//                    "</div>" +
                    "</div>" + 
                    "</fieldset>" +
                    "<div class='pull-right col-xs-6 col-sm-6 col-md-6' style='margin-top: 20px;'>" +
                    "<input id='SaveDelivery' type='submit' value='Save' class='btn btn-primary' style='width: 75px;float: right;'>" +
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
        $('.error-TotalRollsDelivery').hide();
        $('.error-TotalPiecesDelivery').hide();
        $('.error-TotalWeightDelivery').hide();
    }

    function search() {
        var items = [];
        var searchValue = $('#searchGreighFabricReceiving').val();
        if (searchValue === "") {
            <?php foreach ($gfList as $key) {
            ?>
            items += "<tr>" +
                    "<td><?= $key['GreighFabricReceivingNo'] ?></td>" +
                    "<td><?= $key['Date'] ?></td>" +                    
                    "<td><?= $key['ItemCode'] ?></td>" +
                    "<td><?= $key['CompanyName'] ?></td>" +
                    "<td><?= number_format($key['TotalPieces']) ?></td>" +
                    "<td><?= number_format($key['TotalWeight']) ?></td>" +
                    "<td><?= number_format($key['TotalRolls']) ?></td>" +
                    "<td><?= ($key['warehouse']) ?></td>" +
                    "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('<?= $key['greigh_fabric_receiving_id'] ?>','<?= rawurlencode($key['GreighFabricReceivingNo']) ?>','<?= rawurlencode($key['Date']) ?>','<?= rawurlencode($key['CompanyName']) ?>','<?= rawurlencode($key['ChallanNo']) ?>','<?= rawurlencode($key['ItemCode']) ?>','<?= rawurlencode($key['TotalPieces']) ?>','<?= rawurlencode($key['TotalWeight']) ?>','<?= rawurlencode($key['TotalRolls']) ?>','<?= rawurlencode($key['warehouse']) ?>','<?= rawurlencode($key['AvgLbsPerDozenReceived']) ?>','<?= rawurlencode($key['GramPerPieceReceived']) ?>','<?= rawurlencode($key['HeavyLightPercent']) ?>','<?= rawurlencode($key['ReceivedBy']) ?>','<?= rawurlencode($key['IssueToProcessor']) ?>','<?= rawurlencode($key['Processer']) ?>','<?= rawurlencode($key['IssueBy']) ?>','<?= rawurlencode($key['DeliveryReceivedBy']) ?>','<?= rawurlencode($key['VehicleNo']) ?>','<?= $key['greigh_fabric_delivery_id'] ?>','None')>Edit</a>" +
                    "<span> | </span>" +
                    "<a style='cursor: pointer;' href='<?= base_url() ?>index.php/greighfabricreceiving/Delete/<?= $key['greigh_fabric_receiving_id'] ?>'>Delete</a>" +
                    "</td>" +
                    "</tr>";<?php } ?>
            $("#GreighFabricReceivingTbody").html(items);
        } else
        {
            $.ajax({
            url: "<?= base_url() ?>index.php/greighfabricreceiving/search",
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
                        "<td>" + val.GreighFabricReceivingNo + "</td>" +
                        "<td>" + val.Date + "</td>" +                        
                        "<td>" + val.ItemCode + "</td>" +
                        "<td>" + val.CompanyName + "</td>" +
                        "<td>" + val.TotalPieces + "</td>" +
                        "<td>" + val.TotalWeight + "</td>" +
                        "<td>" + val.TotalRolls + "</td>" +
                        "<td>" + val.warehouse + "</td>" +
                        "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('" + encodeURI(val.greigh_fabric_receiving_id) + "','" + encodeURI(val.GreighFabricReceivingNo) + "','" + encodeURI(val.Date) + "','" + encodeURI(val.CompanyName) + "','" + encodeURI(val.ChallanNo) + "','" + encodeURI(val.ItemCode) + "','" + encodeURI(val.TotalPieces) + "','" + encodeURI(val.TotalWeight) + "','" + encodeURI(val.TotalRolls) + "','" + encodeURI(val.warehouse) + "','" + encodeURI(val.AvgLbsPerDozenReceived) + "','" + encodeURI(val.GramPerPieceReceived) + "','" + encodeURI(val.HeavyLightPercent) + "','" + encodeURI(val.ReceivedBy) + "','" + encodeURI(val.IssueToProcessor) + encodeURI(val.Processer) + encodeURI(val.IssueBy) + encodeURI(val.DeliveryReceivedBy) + encodeURI(val.VehicleNo) + encodeURI(val.greigh_fabric_delivery_id) + "','None')>Edit</a>" +
                        "<span> | </span>" +
                        "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/greighfabricreceiving/Delete/" + val.greigh_fabric_receiving_id + "'>Delete</a></td>" +
                        "</tr>";
                });
                $("#GreighFabricReceivingTbody").html(items);
                } catch (e) {
                    console.log(e);
                }
                }
                else {
                    $("#GreighFabricReceivingTbody").html("<tr><td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td><td></td><td></td></tr>");
                }
            }
            }
        });
    }
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

    function ediForm(greighFabricReceivingID, greighFabricReceivingNo, date, partyName, challanNo, itemCode, totalPieces, totalWeight, totalRolls, warehouse, avgLbsPerDozen, gramPerPiece, heavyLightPercent, receivedBy, issueToProcessor, processorName, issueBy, deliveryReceivedBy, vehicleNo, greighFabricDeliveryID, type) {
        if (type === 'editmenu') {
            formMode = "Edit";
            var action = "<?php echo base_url() ?>index.php/greighfabricreceiving/Update";
            enableElements("#GreighFabricReceivingNo");
            enableElements("#GreighFabricDated");            
            enableElements("#PartyName");
            enableElements("#ChallanNo");
            enableElements("#ItemCode");
            enableElements("#TotalPieces");
            enableElements("#TotalWeight");
            enableElements("#TotalRolls");
            enableElements("#warehouse");
            enableElements("#ReceivedBy");
            enableElements("#confirmDelivery");
//            enableElements("#ProcessorName");
//            enableElements("#IssueBy");
//            enableElements("#DeliveryReceivedBy");
//            enableElements("#VehicleNo");
            document.getElementById("greighFabricReceivingForm").action = action;            
        }
        else
        {
            resetForm();
            $("#greigh_fabric_receiving_id").val(greighFabricReceivingID);
            $("#GreighFabricReceivingNo").val(decodeURI(greighFabricReceivingNo));
            $("#ChallanNo").val(decodeURI(challanNo));
            $("#GreighFabricDated").val(getFormatedDate(decodeURI(date)));
            $("#TotalPieces").val(decodeURI(totalPieces));
            $("#TotalWeight").val(decodeURI(totalWeight));
            $("#TotalRolls").val(decodeURI(totalRolls));
            $("#AvgLbsPerDozen").val(decodeURI(avgLbsPerDozen));
            $("#GramPerPiece").val(decodeURI(gramPerPiece));
            $("#HeavyLight").val(decodeURI(heavyLightPercent));
            $("#ReceivedBy").val(decodeURI(receivedBy));
            //$("#confirmDelivery").val(decodeURI(issueToProcessor));
            $('#confirmDelivery option').filter(function() {
                return ($(this).val() === decodeURI(issueToProcessor));
            }).prop('selected', true);
            $('#PartyName option').filter(function() {
                return ($(this).text() === decodeURI(partyName));
            }).prop('selected', true);
            $('#ItemCode option').filter(function() {
                return ($(this).text() === decodeURI(itemCode));
            }).prop('selected', true);
            $('#warehouse option').filter(function() {
                return ($(this).text() === decodeURI(warehouse));
            }).prop('selected', true);
            populateItemInfo();
            disableElements("#GreighFabricReceivingNo");
            disableElements("#ChallanNo");
            disableElements("#GreighFabricDated");            
            disableElements("#PartyName");
            disableElements("#ItemCode");
            disableElements("#TotalPieces");
            disableElements("#TotalWeight");
            disableElements("#TotalRolls");
            disableElements("#warehouse");
            disableElements("#ReceivedBy");
//            disableElements("#confirmDelivery");
            $("#greigh_fabric_delivery_id").val(greighFabricDeliveryID);
//            $('#ProcessorName option').filter(function() {
//                return ($(this).text() === decodeURI(processorName));
//            }).prop('selected', true);
//            $("#IssueBy").val(decodeURI(issueBy));
//            $("#DeliveryReceivedBy").val(decodeURI(deliveryReceivedBy));
//            $("#VehicleNo").val(decodeURI(vehicleNo));
//            disableElements("#ProcessorName");
//            disableElements("#IssueBy");
//            disableElements("#DeliveryReceivedBy");
//            disableElements("#VehicleNo");                      
        }
    }

    function resetForm() {
        if (formMode === 'Retrieve') {
            return true;
            } else {
            $('#PartyName option').filter(function() {
                return ($(this).val() === "0");
            }).prop('selected', true);
            $('#ItemCode option').filter(function() {
                return ($(this).val() === "0");
            }).prop('selected', true);
                    $('#warehouse option').filter(function() {
            return ($(this).val() === "0");
            }).prop('selected', true);
            emptyAllFields("#greigh_fabric_receiving_id");
            emptyAllFields("#GreighFabricReceivingNo");
            emptyAllFields("#ChallanNo");
            emptyAllFields("#GreighFabricDated");            
            emptyAllFields("#TotalPieces");
            emptyAllFields("#TotalWeight");
            emptyAllFields("#TotalRolls");            
            emptyAllFields("#AvgLbsPerDozen");
            emptyAllFields("#GramPerPiece");
            emptyAllFields("#HeavyLight");
            emptyAllFields("#ReceivedBy");
//            $('#ProcessorName option').filter(function() {
//                return ($(this).val() === "0");
//            }).prop('selected', true);
//            emptyAllFields("#IssueBy");
//            emptyAllFields("#DeliveryReceivedBy");
//            emptyAllFields("#VehicleNo");
            emptyAllFields("#greigh_fabric_delivery_id");
        }
    }
    
    function populateGridRows() {
        var deliverItemsCount = 0;
        var countRows = $("#deliveryItemsGrid> tbody").children().length;
        if (countRows > 0) {
            deliverItemsCount = $('#deliveryItemsGrid tbody>tr:last').find("td:first").find('input').val();
            deliverItemsCount = parseInt(deliverItemsCount);
        }
        deliverItemsCount = parseInt(deliverItemsCount) + 1;
        var items = [];
        
        items += "<tr>" +
                "<td tag=''><input id='SerialNoDetail' name='SerialNoDetail[]' value='" + deliverItemsCount + "' type = 'text' class='form-control dcSno' style='width:55px' placeholder = 'SNo' readonly></td>" +
                "<td tag=''><input id='Rolls' name='Rolls[]' value='0' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Rolls' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Rolls!</label></div></td>" +
		"<td tag=''><input id='Pieces' name='Pieces[]' value='0' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Pieces' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Pieces!</label></div></td>" +
		"<td tag=''><input id='Weight' name='Weight[]' value='0' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Weight' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Weight!</label></div></td>" +
                "<td><select id='PONumber' name='PONumber[]' class='form-control' style='width:200px;'><option value='0'>Select PO Number</option><?php 
                            foreach ($customerOrders as $key) {?><option value='<?= $key['customer_order_id'] ?>'><?= $key['PremierPO'] ?></option><?php }?></select><div class='form-group has-error form-error error-PONumber' style='width:0px;margin-left:0px;display:none;'>" +                                                    
                "<label class='control-label' for='inputError'>Select PO Number!</label></div></td>" +
                "<td><input id='AddButton' name='AddButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='+' onclick='populateGridRows()' readonly></td>" +
                "<td tag=''><input id='DelButton' name='DelButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='X' onclick='deleteGridRows(this)' readonly></td></tr>";
        $('#deliveryItemsTbody').append(items);
        
        if (formMode === "Edit") {
            resetSNO();
        }
    }

    function GetAverageLbsPerDozen() {
        var weight = $("#TotalWeight").val();
        var weightUnits = "kgs";
        var finishWeightUnits = "lbs/doz";
        var totalPieces = $("#TotalPieces").val();
        
        if (weight === 0 || totalPieces === 0 || weight === "" || totalPieces === "")
            return;
        
        $.ajax({
            url: "<?= base_url() ?>index.php/greighfabricreceiving/getAverageFinishWeight",
            type: "POST",
            data: { weight: weight, weightUnits: weightUnits, finishWeightUnits: finishWeightUnits, totalPieces: totalPieces },
            success: function(data) {
                if (data !== "null") {
                    var parsedData = JSON.parse(data);
                    if (parsedData !== null) {
                        $("#AvgLbsPerDozen").val(parsedData); 
                        $("#AvgLbsPerDozen").change();
                    }
                }
            }
        });        
    }
    
    function GetAverageGramsPerPiece() {
        var weight = $("#TotalWeight").val();
        var weightUnits = "kgs";
        var finishWeightUnits = "gm/pc";
        var totalPieces = $("#TotalPieces").val();
                
        if (weight === 0 || totalPieces === 0 || weight === "" || totalPieces === "")
            return;
        
        $.ajax({
            url: "<?= base_url() ?>index.php/greighfabricreceiving/getAverageFinishWeight",
            type: "POST",
            data: { weight: weight, weightUnits: weightUnits, finishWeightUnits: finishWeightUnits, totalPieces: totalPieces },
            success: function(data) {
                if (data !== "null") {
                    var parsedData = JSON.parse(data);
                    if (parsedData !== null) {
                        $("#GramPerPiece").val(parsedData); 
                        $("#GramPerPiece").change();
                    }
                }
            }
        });        
    }
    
    function GetHeavyLightPercent() {
        var weightReq = $("#FinishWeight").val();
        var weightRecv = 0;
        var units = $("#FinishWeightUnit").val();
        
        if (units === "lbs/doz") 
            weightRecv = $("#AvgLbsPerDozen").val();            
        else if (units === "gm/pc")
            weightRecv = $("#GramPerPiece").val();
        else if (units === "onz/doz")
            weightRecv = parseFloat($("#AvgLbsPerDozen").val()) * 16;
                
        if (weightRecv === 0.000 || weightReq === "" || weightRecv === "")
            return;
       
        $.ajax({
            url: "<?= base_url() ?>index.php/greighfabricreceiving/getHeavyLightPercent",
            type: "POST",
            data: { weightRequired: weightReq, weightReceived: weightRecv },
            success: function(data) {
                if (data !== "null") {
                    var parsedData = JSON.parse(data);
                    if (parsedData !== null) {
                        $("#HeavyLight").val(parsedData);                          
                    }
                }
            }
        });
    }
    
    function populateItemInfo() {
        var itemID = $("#ItemCode").val();
        if (itemID === 0)
            return;
        $.ajax({
            url: "<?= base_url() ?>index.php/itemspecification/getItemInfo",
            type: "POST",
            data: {ItemID: itemID},
            success: function(data) {
                if (data !== "null") {
                    var parsedData = JSON.parse(data);
                    if (parsedData.length > 0) {  
                        $.each(parsedData, function(i, val) {
                            $("#Size").val(parseInt(decodeURI(val.FinishLength)) + " X " + parseInt(decodeURI(val.FinishWidth)));
                            $("#FinishWeight").val(decodeURI(val.FinishWeight) + " " + unescape(val.FinishWeightUnit));
                            $("#FinishWeightUnit").val(unescape(val.FinishWeightUnit));
                            $("#BlendRatio").val(unescape(val.BlendPercent));
                            $("#PileYarn").val(unescape(val.PileCount) + " " + unescape(val.PileUnit));
                            //$("#Weft").val(decodeURI(val.WeftPercent));
                            $("#WeftYarn").val(unescape(val.WeftCount) + " " + unescape(val.WeftUnit));
                            //$("#Ground").val(decodeURI(val.GroundPercent));
                            $("#GroundYarn").val(unescape(val.GroundCount) + " " + unescape(val.GroundUnit));
                            //$("#FancyCount").val(decodeURI(val.FancyPercent));
                            //$("#FancyDescription").val(unescape(val.FancyCount) + " " + decodeURI(val.FancyUnit));
                            //$("#WeavingLoss").val(decodeURI(WeavingLossPercent));
                            GetHeavyLightPercent();
                            
                        }); 
                    }                       
                }
            } 
        });
    }
    
    function deleteGridRows(r) {
        var itemsCount = 0;
        var i = r.parentNode.parentNode.rowIndex;
        
//        var totalRollsModified = 0;
//        var totalPiecesModified = 0;
//        var totalWeightModified = 0.00;
//        var totalRolls = $('#TotalRollsDelivery').val();
//        var totalPieces = $('#TotalPiecesDelivery').val();
//        var totalWeight = $('#TotalWeightDelivery').val();
//        var rolls = parseInt($(r).closest("td").next().next().find('input').val());
//        var pieces = parseInt($(r).closest("td").next().next().next().find('input').val());
//        var weight = parseFloat($(r).closest("td").next().next().next().next().find('input').val());
//        alert(rolls);
//        alert(pieces);
//        alert(weight);
//        if (totalRolls !== "") {
//            if (totalRolls.indexOf(',') > -1) {
//                totalRolls = totalRolls.replace(/,/g, "");
//            }
//        }
//        if (totalPieces !== "") {
//            if (totalPieces.indexOf(',') > -1) {
//                totalPieces = totalPieces.replace(/,/g, "");
//            }
//        }
//        if (totalWeight !== "") {
//            if (totalWeight.indexOf(',') > -1) {
//                totalWeight = totalWeight.replace(/,/g, "");
//            }
//        }
        document.getElementById('deliveryItemsGrid').deleteRow(i);
//        itemsCount = parseInt(itemsCount) - 1;
//        totalRollsModified = totalRolls - rolls;
//        totalPiecesModified = totalPieces - pieces; 
//        totalWeightModified = totalWeight - weight;
//        
//        if (totalRollsModified < 0) {
//            totalRollsModified = 0;
//        }        
//        if (totalPiecesModified < 0) {
//            totalPiecesModified = 0;
//        }        
//        if (totalWeightModified < 0) {
//            totalWeightModified = 0.00;
//        }
//        $('#TotalRollsDelivery').val(totalRollsModified);
//        $('#TotalRollsDelivery').val(fractionNotation(totalRollsModified, 0));
//        $('#TotalPiecesDelivery').val(totalPiecesModified);
//        $('#TotalPiecesDelivery').val(fractionNotation(totalPiecesModified, 0));
//        $('#TotalWeightDelivery').val(totalWeightModified);
//        $('#TotalWeightDelivery').val(fractionNotation(totalWeightModified, 2));
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
    
    function sumTotalValues(obj, type) {
        //$(obj).val(fractionNotation($(obj).val(), 2));
        if (type === 0) {            
            $('#TotalWeightDelivery').val('');            
            var totalWeight = $('#DeliveryItemsTable tr td:nth-last-child(4) input');            
            var sumTotalQty = 0.00;
            for (var i = 0; i < totalWeight.length; i++) {
                var qty = totalWeight[i].value;
                sumTotalQty = sumTotalQty + parseFloat(qty);                
            }            
            $('#TotalWeightDelivery').val(sumTotalQty);
            //$('#TotalWeight').val(fractionNotation(sumTotalQty, 2));
        } 
        else if (type === 1) {
            $('#TotalRollsDelivery').val('');
            var totalRolls = $('#DeliveryItemsTable tr td:nth-last-child(6) input');
            var sumTotalRolls = 0;
            for (var j = 0; j < totalRolls.length; j++) {
                var rolls = totalRolls[j].value;
                sumTotalRolls = sumTotalRolls + parseInt(rolls);
            }
            $('#TotalRollsDelivery').val(sumTotalRolls);
            //$('#TotalRolls').val(fractionNotation(sumTotalRolls, 0));
        }        
        else if (type === 2) {
            $('#TotalPiecesDelivery').val('');
            var totalPieces = $('#DeliveryItemsTable tr td:nth-last-child(5) input');
            var sumTotalPieces = 0;
            for (var k = 0; k < totalPieces.length; k++) {
                var pieces = totalPieces[k].value;
                sumTotalPieces = sumTotalPieces + parseInt(pieces);
            }
            $('#TotalPiecesDelivery').val(sumTotalPieces);
            //$('#TotalPieces').val(fractionNotation(sumTotalPieces, 0));
        }
    }
    
    function doToggle(id) {
        $(id).toggle();
    }

    function onPressEnter(id) {
        $(id).bind("keypress", function (e) {
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

    function validationForm() {
        var isValidate = 1;
        var date = $("#GreighFabricDated").val();
        var partyName = $('#PartyName').val();
        var itemCode = $('#ItemCode').val();
        var warehouse = $('#warehouse').val();
        //    var totalWeight = $('#TotalWeight').val();
        if (date === "" && partyName === "Select Party" && itemCode === "Select Item Code" && warehouse === "Select Warehouse") {
            $(".error-partyname").show();
            $(".error-itemcode").show();
            $(".error-gfdate").show();
            $(".error-warehouse").show();
            isValidate = 0;            
        } else {
            $(".error-partyname").hide();
            $(".error-itemcode").hide();
            $(".error-gfdate").hide();
            $(".error-warehouse").hide();
            if ((date === "") || (partyName === "Select Party") || (itemCode === "Select Item Code") || warehouse === "Select Warehouse") {
                if (date === "") {
                    $(".error-gfdate").show();
                } else {
                    $(".error-gfdate").hide();
                }
                if (partyName === "Select Party") {
                    $(".error-partyname").show();
                } else {
                    $(".error-partyname").hide();
                }
                if (itemCode === "Select Item Code") {
                    $(".error-itemcode").show();
                } else {
                    $(".error-itemcode").hide();
                }
                if (warehouse === "Select Warehouse") {
                    $(".error-warehouse").show();
                } else {
                    $(".error-warehouse").hide();
                }
                isValidate = 0;
            }
            if ((!$("#GreighFabricDated").inputmask("isComplete")) || (date === "00-00-0000") || (date === "01-01-1970")) {
                isValidate = 0;
                $(".error-gfdate").html("<label>Enter valid Date</label>").show();
            } else {
                $(".error-gfdate").hide();
            }
        }
 
        if (isValidate === 0) {
            return false;
        } else {
            return true;
        }
    }
    
    function validateDeliveryForm() {
        var isValidate = 1;
        var partyName = $('#ProcessorName').val();
        var challanNo = $('#ChallanNoDelivery').val();
        var issueBy = $('#IssueBy').val();
        var receivedByDelivery = $('#ReceivedByDelivery').val();
        var vehicleNo = $('#VehicleNo').val();
        
        //    var totalWeight = $('#TotalWeight').val();
        if (challanNo === "" && partyName === "Select Processor" && issueBy === "" && receivedByDelivery === "" && vehicleNo === "") {
            $(".error-ChallanNoDelivery").show();
            $(".error-ProcessorName").show();
            $(".error-IssueBy").show();
            $(".error-ReceivedByDelivery").show();
            $(".error-VehicleNo").show();
            isValidate = 0;            
        } else {
            $(".error-ChallanNoDelivery").hide();
            $(".error-ProcessorName").hide();
            $(".error-IssueBy").hide();
            $(".error-ReceivedByDelivery").hide();
            $(".error-VehicleNo").hide();
            if ((challanNo === "" || partyName === "Select Processor" || issueBy === "" || receivedByDelivery === "" || vehicleNo === "")) {
                if (challanNo === "") {
                    $(".error-ChallanNoDelivery").show();
                } else {
                    $(".error-ChallanNoDelivery").hide();
                }
                if (partyName === "Select Processor") {
                    $(".error-ProcessorName").show();
                } else {
                    $(".error-ProcessorName").hide();
                }
                if (issueBy === "") {
                    $(".error-IssueBy").show();
                } else {
                    $(".error-IssueBy").hide();
                }
                if (receivedByDelivery === "") {
                    $(".error-ReceivedByDelivery").show();
                } else {
                    $(".error-ReceivedByDelivery").hide();
                }
                if (vehicleNo === "") {
                    $(".error-VehicleNo").show();
                } else {
                    $(".error-VehicleNo").hide();
                }
                isValidate = 0;
            }            
        }
 
        if (isValidate === 0) {
            return false;
        } else {
            return true;
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

</script>