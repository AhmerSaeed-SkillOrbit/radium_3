<?php
include 'include/leftmenu.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Greigh Fabric Delivery 
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
             <div class='box box-primary'> 
				<div class='box-body'> 
					<fieldset> 
						<form id='greighFabricDeliveryForm' name='greighFabricDeliveryForm' role='form' method='post' action='<?= base_url() ?>index.php/greighfabricdelivery/Add' onSubmit='return validateDeliveryForm()'> 
						<legend onclick=''>Delivery Information</legend> 
						<div id='deliveryDiv'> 
						<div id='' class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'> 
						<label>GFDC#</label> 
						<input id='GFDC' name='GFDC' type='text' value='<?php if ($gfdc) { echo $gfdc;}?>' class='form-control' readonly> 
						</div>
						<div id='' class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'> 
						<label>Challan No</label> 
						<input id='ChallanNo' name='ChallanNo' type='text' class='form-control' placeholder='Challan No'> 
						</div>
                                                <div class='form-group has-error form-error error-ChallanNo' style='width:0px;margin-left:0px;display:none;'>                                                     
						<label class='control-label' for='inputError'>Enter Challan No.!</label></div> 
						<div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                                    <label for="">Date</label>
                                                    <div class="input-group" style="width: 150px;">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input id="GreighFabricDated" name="GreighFabricDated" type="text" class="form-control" style="" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                                                    </div>
                                                    <div class="form-group has-error form-error error-GreighFabricDated" style="width: 130px;">
                                                        <label class="control-label" for="inputError">Enter Date!</label>
                                                    </div>
                                                </div>                           
                                                <div id='' class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'> 
						<label>Processor Name</label> 
						<select id='ProcessorName' name='ProcessorName' class='form-control' style='width:200px;'><option value='0'>Select Processor</option><?php 
								foreach ($processorList as $key) {?><option value='<?= $key['Party_id'] ?>'><?= $key['CompanyName'] ?></option><?php }?></select>                                                     
						</div>  
						<div class='form-group has-error form-error error-ProcessorName' style='width:0px;margin-left:0px;display:none;'>                                                     
						<label class='control-label' for='inputError'>Select Processor Name!</label></div> 
                                                <div id='' class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'> 
						<label>A/C Weaver</label> 
						<select id='WeaverName' name='WeaverName' class='form-control' style='width:200px;'><option value='0'>Select A/C Weaver</option><?php 
								foreach ($weaverList as $key) {?><option value='<?= $key['Party_id'] ?>'><?= $key['CompanyName'] ?></option><?php }?></select>                                                     
						</div> 
                                                <div class='form-group has-error form-error error-WeaverName' style='width:0px;margin-left:0px;display:none;'>                                                     
						<label class='control-label' for='inputError'>Select A/C Weaver!</label></div> 
                                                <div id='' class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'> 
						<label>Reference Challan No</label> 
						<input id='ReferenceChallanNo' name='ReferenceChallanNo' type='text' class='form-control' placeholder='Reference Challan No'> 
                                                <div class='form-group has-error form-error error-ReferenceChallanNo' style='width:0px;margin-left:0px;display:none;'>                                                     
						<label class='control-label' for='inputError'>Enter Reference Challan No.!</label></div> 
						</div>
                                                <div id='' class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'> 
						<label>Issue By</label> 
						<input id='IssueBy' name='IssueBy' type='text' class='form-control' placeholder='Issue By'> 
                                                <div class='form-group has-error form-error error-IssueBy' style='width:0px;margin-left:0px;display:none;'>                                                     
						<label class='control-label' for='inputError'>Enter Issue By!</label></div> 
						</div> 						
						<div id='' class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'> 
						<label>Received By</label> 
						<input id='ReceivedBy' name='ReceivedBy' type='text' class='form-control' placeholder='Received By'> 
                                                <div class='form-group has-error form-error error-ReceivedBy' style='width:0px;margin-left:0px;display:none;'>                                                     
						<label class='control-label' for='inputError'>Enter Received By!</label></div> 
						</div> 						
						<div id='' class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'> 
						<label>Vehicle No</label> 
						<input id='VehicleNo' name='VehicleNo' type='text' class='form-control' placeholder='Vehicle No'> 
                                                <div class='form-group has-error form-error error-VehicleNo' style='width:0px;margin-left:0px;display:none;'>                                                     
						<label class='control-label' for='inputError'>Enter Vehicle No.!</label></div> 
						</div> 						
						</div>                   
						<fieldset> 
						<div class='box-body table-responsive'> 
						<legend onclick=''>Delivery Items</legend>                          
						<div id='DeliveryItemsTable' class='box' style='margin-top: 20px;width:700px;overflow-x: scroll;'> 
						<div class='pull-right col-xs-12 col-sm-6 col-md-6' style='margin-top: 20px;'> 
						<input id='AddButton' name='AddButton' class='btn btn-primary col-xs-12 col-sm-6 col-md-1' style='width:35px;height:30px;margin-left:-355px;margin-top:-12px;text-align:center;cursor: pointer' value='+' onclick='populateGridRows()' readonly> 
						</div>  
						<table id='deliveryItemsGrid' class='table table-bordered table-striped' style='margin-top: 60px;'> 
						<thead> 
						<tr> 
						<th>S.No</th> 
                                                <th>Item Code</th>
						<th>Rolls</th> 
						<th>Pieces</th> 
						<th>Weight</th> 
						<th>PO#</th>      
                                                <th>Warehouse</th>       
						<th>Add</th> 
						<th>Delete</th> 
						</tr> 
						</thead> 
						<tbody id='deliveryItemsTbody'> 
						<tr> 
						<td tag=''><input id='SerialNoDetail' name='SerialNoDetail[]' value='1' type = 'text' class='form-control dcSno' style='width:55px' placeholder = 'SNo' readonly></td> 
                                                <td tag=''><select id='ItemCode' name='ItemCode[]' class='form-control' style='width:200px' onchange=''><option value='0'>Select Item Code</option><?php
                                                        foreach ($itemList as $key) {
                                                                ?><option value='<?= $key['item_id'] ?>'><?= $key['ItemCode'] ?></option><?php }?></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-ItemCode' style='width:0px;margin-left:0px;display:none;'>
						<td tag=''><input id='Rolls' name='Rolls[]' value='<?php if($rolls) {echo $rolls;} ?>' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Rolls' style='width:0px;margin-left:0px;display:none;'> 
						<label class='control-label' for='inputError'>Enter Rolls!</label></div></td> 
						<td tag=''><input id='Pieces' name='Pieces[]' value='<?php  if($pieces) {echo $pieces;} ?>' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Pieces' style='width:0px;margin-left:0px;display:none;'> 
						<label class='control-label' for='inputError'>Enter Pieces!</label></div></td> 
						<td tag=''><input id='Weight' name='Weight[]' value='<?php if($weight) {echo $weight;} ?>' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Weight' style='width:0px;margin-left:0px;display:none;'> 
						<label class='control-label' for='inputError'>Enter Weight!</label></div></td> 
						<td><select id='PONumber' name='PONumber[]' class='form-control' style='width:200px;'><option value='0'>Select PO Number</option><?php 
								foreach ($customerOrders as $key) {?><option value='<?= $key['customer_order_id'] ?>'><?= $key['PremierPO'] ?></option><?php }?></select><div class='form-group has-error form-error error-PONumber' style='width:0px;margin-left:0px;display:none;'>                                                     
						<label class='control-label' for='inputError'>Select PO Number!</label></div></td> 
                                                <td><select id='warehouse' name='warehouse[]' class='form-control' style='width:200px;'><option value='0'>Select Warehouse</option><?php 
								foreach ($warehouseCombo as $key) {?><option value='<?= $key['Warehouse_id'] ?>'><?= $key['WarehouseName'] ?></option><?php }?></select><div class='form-group has-error form-error error-warehouse' style='width:0px;margin-left:0px;display:none;'>                                                     
						<label class='control-label' for='inputError'>Select Warehouse!</label></div></td> 
						<td><input id='AddButton' name='AddButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='+' onclick='populateGridRows()' readonly></td> 
						<td tag=''><input id='DelButton' name='DelButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='X' onclick='deleteGridRows(this)' readonly></td>
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
                                    </fieldset>
				</div><!-- /.box -->
            </div>  
        </div><!-- /.box -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<script>
        $(document).ready(function() {
        $(".form-error").hide();
        formMode = "Add";
        $('#FlashMessage').fadeOut(5000);
        $("#GreighFabricDated").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});                 
    });    
    
        function retrivePopup() {
        formMode = "Retrieve";
        $("#EditAnchor").removeAttr("disabled");
        $("#PrintAnchor").removeAttr("disabled");
        bootbox.dialog({
        title: "Greigh Fabric Delivery",
        message: "<fieldset>" +
                    "<div class='box box-primary'>" +
                    "<div class='box-body'>" +
                    "<form name='greighFabricDeliveryFormEdit' role='' method='' action='' class=''>" +
                    "<br><div class='col-md-12'>" +
                    "<div class='pull-left col-md-2'>" +
                    "<label>Search</label>" +
                    "</div>" +
                    "<div class='pull-left col-md-4'>" +
                    "<input id='searchGreighFabricDelivery' name='searchGreighFabricDelivery' type='text' class='form-control' onkeyup='search()' placeholder='Search by GFD No.' style='width:200px;margin-left:-100px;'>" +
                    "<input id='SearchNow' type='button' value='OK' class='btn btn-primary' onclick='search()' style='width: 100px;margin-left: 110px;margin-top:-58px;'>" +
                    "</div>" +
                    "</div><br><br><br>" +
                    "<fieldset>" +
                    "<div class='box-body table-responsive'>" +
                    "<div class='box'>" +
                    "<table class='table table-bordered table-striped'>" +
                    "<thead>" +
                    "<tr>" +
                    "<th width='10%'>GFD No.</th>" +
                    "<th width='10%'>Date</th>" +
                    "<th width='10%'>Processor Name</th>" +
                    "<th width='10%'>Total Pieces</th>" +
                    "<th width='10%'>Total Weight</th>" +
                    "<th width='10%'>Total Rolls</th>" +
                    "<th width='10%'>Warehouse</th>" +
                    "<th width='10%'>Details</th>" +
                    "</tr>" +
                    "</thead>" +
                    "<tbody id='GreighFabricDeliveryTbody'>" +<?php
                                        foreach ($gfList as $key) {
                                            ?>
                "<tr>" +
                        "<td><?= $key['GreighFabricDeliveryNo'] ?></td>" +
                        "<td><?= $key['DeliveryDate'] ?></td>" +                        
                        "<td><?= $key['ProcessorName'] ?></td>" +
                        "<td><?= number_format($key['TotalPieces']) ?></td>" +
                        "<td><?= number_format($key['TotalWeight']) ?></td>" +
                        "<td><?= number_format($key['TotalRolls']) ?></td>" +
                        "<td><?= $key['warehouse'] ?></td>" +
                        "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('<?= $key['greigh_fabric_delivery_id'] ?>','<?= rawurlencode($key['GreighFabricDeliveryNo']) ?>','<?= rawurlencode($key['DeliveryDate']) ?>','<?= rawurlencode($key['ProcessorName']) ?>','<?= rawurlencode($key['ChallanNo']) ?>','<?= rawurlencode($key['ItemCode']) ?>','<?= rawurlencode($key['TotalPieces']) ?>','<?= rawurlencode($key['TotalWeight']) ?>','<?= rawurlencode($key['TotalRolls']) ?>','<?= rawurlencode($key['warehouse']) ?>','<?= rawurlencode($key['ReceivedBy']) ?>','<?= rawurlencode($key['IssueBy']) ?>','<?= rawurlencode($key['VehicleNo']) ?>','<?= $key['WeaverName'] ?>','<?= $key['ReferenceChallanNo'] ?>','None')>Edit</a>" +
                        "<span> | </span>" +
                        "<a style='cursor: pointer;' href='<?= base_url() ?>index.php/greighfabricdelivery/Delete/<?= $key['greigh_fabric_delivery_id'] ?>'>Delete</a>" +
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

    function search() {
        var items = [];
        var searchValue = $('#searchGreighFabricDelivery').val();
        if (searchValue === "") {
            <?php foreach ($gfList as $key) {
            ?>
            items += "<tr>" +
                    "<td><?= $key['GreighFabricDeliveryNo'] ?></td>" +
                    "<td><?= $key['DeliveryDate'] ?></td>" +                   
                    "<td><?= $key['ProcessorName'] ?></td>" +
                    "<td><?= number_format($key['TotalPieces']) ?></td>" +
                    "<td><?= number_format($key['TotalWeight']) ?></td>" +
                    "<td><?= number_format($key['TotalRolls']) ?></td>" +
                    "<td><?= ($key['warehouse']) ?></td>" +
                    "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('<?= $key['greigh_fabric_delivery_id'] ?>','<?= rawurlencode($key['GreighFabricDeliveryNo']) ?>','<?= rawurlencode($key['DeliveryDate']) ?>','<?= rawurlencode($key['ProcessorName']) ?>','<?= rawurlencode($key['ChallanNo']) ?>','<?= rawurlencode($key['ItemCode']) ?>','<?= rawurlencode($key['TotalPieces']) ?>','<?= rawurlencode($key['TotalWeight']) ?>','<?= rawurlencode($key['TotalRolls']) ?>','<?= rawurlencode($key['warehouse']) ?>','<?= rawurlencode($key['ReceivedBy']) ?>','<?= rawurlencode($key['IssueBy']) ?>','<?= rawurlencode($key['VehicleNo']) ?>','<?= $key['greigh_fabric_delivery_id'] ?>','<?= $key['WeaverName'] ?>','<?= $key['ReferenceChallanNo'] ?>','None')>Edit</a>" +
                    "<span> | </span>" +
                    "<a style='cursor: pointer;' href='<?= base_url() ?>index.php/greighfabricdelivery/Delete/<?= $key['greigh_fabric_delivery_id'] ?>'>Delete</a>" +
                    "</td>" +
                    "</tr>";<?php } ?>
            $("#GreighFabricDeliveryTbody").html(items);
        } else
        {
            $.ajax({
            url: "<?= base_url() ?>index.php/greighfabricdelivery/search",
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
                        "<td>" + val.GreighFabricDeliveryNo + "</td>" +
                        "<td>" + val.DeliveryDate + "</td>" +                        
                        "<td>" + val.ProcessorName + "</td>" +
                        "<td>" + val.TotalPieces + "</td>" +
                        "<td>" + val.TotalWeight + "</td>" +
                        "<td>" + val.TotalRolls + "</td>" +
                        "<td>" + val.warehouse + "</td>" +
                        "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('" + encodeURI(val.greigh_fabric_delivery_id) + "','" + encodeURI(val.GreighFabricDeliveryNo) + "','" + encodeURI(val.DeliveryDate) + "','" + encodeURI(val.ProcessorName) + "','" + encodeURI(val.ChallanNo) + "','" + encodeURI(val.ItemCode) + "','" + encodeURI(val.TotalPieces) + "','" + encodeURI(val.TotalWeight) + "','" + encodeURI(val.TotalRolls) + "','" + encodeURI(val.warehouse) + "','" + encodeURI(val.ReceivedBy) + "','"  + encodeURI(val.IssueBy) + "','" + encodeURI(val.VehicleNo) + "','" + encodeURI(val.WeaverName) + "','" + encodeURI(val.ReferenceChallanNo) + "','None')>Edit</a>" +
                        "<span> | </span>" +
                        "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/greighfabricdelivery/Delete/" + val.greigh_fabric_delivery_id + "'>Delete</a></td>" +
                        "</tr>";
                        });
                    $("#GreighFabricDeliveryTbody").html(items);
                } catch (e) {
                    console.log(e);
                    }
                }
                else {
                    $("#GreighFabricDeliveryTbody").html("<tr><td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td></tr>");
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
    
    function ediForm(greighFabricDeliveryID, greighFabricDeliveryNo, date, processorName, challanNo, itemCode, totalPieces, totalWeight, totalRolls, warehouse, receivedBy, issueBy, vehicleNo, weaverName, referenceChallanNo, type) {
        if (type === 'editmenu') {
            formMode = "Edit";
            var action = "<?php echo base_url() ?>index.php/greighfabricdelivery/Update";
            enableElements("#GreighFabricDated");            
            enableElements("#ProcessorName");
            enableElements("#ChallanNo");
            enableElements("#WeaverName");
            enableElements("#ReferenceChallanNo");
            enableElements("#IssueBy");
            enableElements("#ReceivedBy");
            enableElements("#warehouse");            
            enableElements("#VehicleNo");            
            document.getElementById("greighFabricDeliveryForm").action = action;            
        }
        else
        {
            resetForm();
            $("#greigh_fabric_delivery_id").val(greighFabricDeliveryID);
            $("#GFDC").val(decodeURI(greighFabricDeliveryNo));
            $("#ChallanNo").val(decodeURI(challanNo));
            $("#GreighFabricDated").val(getFormatedDate(decodeURI(date)));            
            $("#ReferenceChallanNo").val(decodeURI(referenceChallanNo));
            $("#IssueBy").val(decodeURI(issueBy));
            $("#ReceivedBy").val(decodeURI(receivedBy));
            $("#VehicleNo").val(decodeURI(vehicleNo));
            $('#ProcessorName option').filter(function() {
                return ($(this).text() === decodeURI(processorName));
            }).prop('selected', true);
            $('#WeaverName option').filter(function() {
                return ($(this).text() === decodeURI(weaverName));
            }).prop('selected', true);
            $('#warehouse option').filter(function() {
                return ($(this).text() === decodeURI(warehouse));
            }).prop('selected', true);
            disableElements("#GreighFabricDated");            
            disableElements("#ProcessorName");
            disableElements("#ChallanNo");
            disableElements("#WeaverName");
            disableElements("#ReferenceChallanNo");
            disableElements("#IssueBy");
            disableElements("#ReceivedBy");
            disableElements("#warehouse");            
            disableElements("#VehicleNo");           
        }
    }
    
    function resetForm() {
        if (formMode === 'Retrieve') {
            return true;
            } else {
            $('#ProcessorName option').filter(function() {
                return ($(this).val() === "0");
            }).prop('selected', true);
            $('#WeaverName option').filter(function() {
                return ($(this).val() === "0");
            }).prop('selected', true);
            emptyAllFields("#greigh_fabric_delivery_id");    
            emptyAllFields("#GreighFabricDated");            
            emptyAllFields("#ProcessorName");
            emptyAllFields("#ChallanNo");
            emptyAllFields("#WeaverName");
            emptyAllFields("#ReferenceChallanNo");
            emptyAllFields("#IssueBy");
            emptyAllFields("#ReceivedBy");
            emptyAllFields("#warehouse");            
            emptyAllFields("#VehicleNo");             
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
                "<td><select id='ItemCode' name='ItemCode[]' class='form-control' style='width:200px;'><option value='0'>Select Item Code</option><?php 
                            foreach ($itemList as $key) {?><option value='<?= $key['item_id'] ?>'><?= $key['ItemCode'] ?></option><?php }?></select><div class='form-group has-error form-error error-ItemCode' style='width:0px;margin-left:0px;display:none;'>" +                                                    
                "<label class='control-label' for='inputError'>Select Item Code!</label></div></td>" +
                "<td tag=''><input id='Rolls' name='Rolls[]' value='0' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Rolls' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Rolls!</label></div></td>" +
		"<td tag=''><input id='Pieces' name='Pieces[]' value='0' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Pieces' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Pieces!</label></div></td>" +
		"<td tag=''><input id='Weight' name='Weight[]' value='0' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Weight' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Weight!</label></div></td>" +
                "<td><select id='PONumber' name='PONumber[]' class='form-control' style='width:200px;'><option value='0'>Select PO Number</option><?php 
                            foreach ($customerOrders as $key) {?><option value='<?= $key['customer_order_id'] ?>'><?= $key['PremierPO'] ?></option><?php }?></select><div class='form-group has-error form-error error-PONumber' style='width:0px;margin-left:0px;display:none;'>" +                                                    
                "<label class='control-label' for='inputError'>Select PO Number!</label></div></td>" +
                "<td><select id='warehouse' name='warehouse[]' class='form-control' style='width:200px;'><option value='0'>Select warehouse</option><?php 
                            foreach ($warehouseCombo as $key) {?><option value='<?= $key['Warehouse_id'] ?>'><?= $key['WarehouseName'] ?></option><?php }?></select><div class='form-group has-error form-error error-warehouse' style='width:0px;margin-left:0px;display:none;'>" +                                                    
                "<label class='control-label' for='inputError'>Select warehouse!</label></div></td>" +
                "<td><input id='AddButton' name='AddButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='+' onclick='populateGridRows()' readonly></td>" +
                "<td tag=''><input id='DelButton' name='DelButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='X' onclick='deleteGridRows(this)' readonly></td></tr>";
        $('#deliveryItemsTbody').append(items);
        
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


    
    
    
    
</script>
    