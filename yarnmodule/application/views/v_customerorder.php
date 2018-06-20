<?php
include 'include/leftmenu.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Customer Order
        </h1><br><br>
        <div class="row">
            <div class="pull-right" style="padding-right:15px;">
                <a class="btn btn-app" onclick="retrivePopup()">
                    <i class="fa fa-align-justify"></i> Retrieve                  
                </a>
                <a class="btn btn-app" onclick="reloadForm()">
                    <i class="fa fa-adn"></i> New                  
                </a>                                                
                <a id="EditAnchor" class="btn btn-app" onclick="ediForm('Null','editmenu')"> 
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
                    <form id="customerOrderForm" name="customerOrderForm" role="form" method="post" action="<?= base_url() ?>index.php/customerorder/Add" onSubmit="return validationForm()"> 
                        <fieldset>
                            <legend onclick="">Customer Order</legend>
                            <div id="FlashMessage">
                                <h5 id="CustomerOrderInsertMessage" style=""><?= $insertMessage ?></h5>
                                <h5 id="CustomerOrderUpdateMessage" style=""><?= $updateMessage ?></h5>
                                <h5 id="CustomerOrderDeleteMessage" style=""><?= $deleteMessage ?></h5>
                            </div>  
                            <div id="CustomerOrderInfoDiv">
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <input id="customer_order_id" name="customer_order_id" type="hidden" value="">
                                    <label for="">Customer PO Number</label>
                                    <input id="customerPO" name="customerPO" type="text" value="" class="form-control" style="" placeholder="Customer PO Number">
                                    <div class="form-group has-error form-error error-customerPO" style="width: 200px;">
                                        <label class="control-label" for="inputError">Enter Customer PO Number!</label>
                                    </div>
                                </div>
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Premier PO Number</label>
                                    <input id="premierPO" name="premierPO" type="text" class="form-control" style="" placeholder="Premier PO Number">
                                    <div class="form-group has-error form-error error-premierPO" style="width: 200px;">
                                        <label class="control-label" for="inputError">Enter Premier PO Number!</label>
                                    </div>
                                </div>
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Order Date</label>
                                    <div class="input-group" style="width: 150px;">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input id="CustomerOrderDated" name="CustomerOrderDated" type="text" class="form-control" style="" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                                    </div>
                                    <div class="form-group has-error form-error error-gfdate" style="width: 200px;">
                                        <label class="control-label" for="inputError">Enter Date!</label>
                                    </div>
                                </div>                           
                            </div>     
                        </fieldset>
                        <fieldset>
                            <br><br>
                            <div class="box-body table-responsive">
                                <legend onclick="">Order Items</legend>                          
                                <div id="OrderItemsTable" class="box" style="margin-top: 20px;width:700px;overflow-x: scroll;">
                                    <div class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                        <input id="AddButton" name="AddButton" class="btn btn-primary col-xs-12 col-sm-6 col-md-1" style="width:35px;height:30px;margin-left:-355px;margin-top:-12px;text-align:center;cursor: pointer" value="+" onclick="populateGridRows()" readonly>
                                    </div> 
                                    <table id="customerOrderGrid" class="table table-bordered table-striped" style="margin-top: 75px;">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Customer Item No</th>
                                                <th>Item Code</th>
                                                <th>Finish Quantity</th>
                                                <th>Finish Quantity Unit</th>
                                                <th>Dozen Per Bale</th>
                                                <th>Total Bales</th>
                                                <th>B%</th>
                                                <th>Weaving Quantity</th>                                                
                                                <th>Additional Requirement</th>
                                                <th>Excess Available</th>
                                                <th>Total Weaving Quantity</th>
                                                <th>Rate</th>
                                                <th>Rate Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody id="customerOrderTbody">
                                        </tbody>
                                        <tfoot>
                                            <tr></tr>
                                        </tfoot>
                                    </table>
                                </div><br>
                                <div id="" class="col-md-12" style="margin-top: 20px;">
                                    <div class="pull-left col-xs-10 col-sm-5 col-md-5" style="">
                                        <label>Total Finish Quantity</label>
                                        <input id="TotalFinishQuantity" name="TotalFinishQuantity" type="text" value="" class="form-control" placeholder="0.00" style="" readonly>
                                        <div class="form-group has-error form-error error-TotalFinishQuantity" style="width: 235px;margin-left: 5px;display: none;">
                                            <label class="control-label" for="inputError">value must be a Decimal,Greater than zero!</label>
                                        </div>
                                    </div>
                                    <div class="pull-left col-xs-10 col-sm-5 col-md-5" style="">
                                        <label>Total Weaving Pieces</label>
                                        <input id="TotalWeavingPieces" name="TotalWeavingPieces" type="text"  value="" class="form-control" placeholder="0.00"  style="" readonly>
                                        <div class="form-group has-error form-error error-TotalWeavingPieces" style="width: 235px;margin-left:5px;display: none;">
                                            <label class="control-label" for="inputError">value must be a Decimal,Greater than zero!</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="" class="col-md-12" style="margin-top: 20px;">
                                    <div class="pull-left col-xs-10 col-sm-5 col-md-5" style="">
                                        <label>Total PO Value</label>
                                        <input id="TotalPOValue" name="TotalPOValue" type="text" value="" class="form-control" placeholder="0.00"  style="" readonly>
                                        <div class="form-group has-error form-error error-TotalPOValue" style="width: 235px;margin-left:5px;display: none;">
                                            <label class="control-label" for="inputError">value must be a Decimal,Greater than zero!</label>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="pull-right col-xs-6 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <input id="SaveCustomerOrder" type="submit" value="Save" class="btn btn-primary" style="width: 75px;float: right;">
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
    $(document).ready(function () {
        $(".form-error").hide();
	formMode = "Add";
        $('#FlashMessage').fadeOut(5000);
        $("#CustomerOrderDated").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        onPressEnter('#customerOrderForm');
        onPressEnter('#customerOrderFormEdit');
    });
    
    $("#FinishQuantity").focusout(function() {
        CalculateWeavingQuantity();
        CalculateTotalQuantity();
    });
    
    $("#BPercent").focusout(function() {
        CalculateWeavingQuantity();
        CalculateTotalQuantity();
    });
    
    $("#AdditionalRequirement").focusout(function() {
        CalculateTotalQuantity();
    });
    
    $("#ExcessAvailable").focusout(function() {
        CalculateTotalQuantity();
    });
    
    function populateGridRows() {
        var orderItemsCount = 0;
        var countRows = $("#customerOrderGrid> tbody").children().length;
        if (countRows > 0) {
            orderItemsCount = $('#customerOrderGrid tbody>tr:last').find("td:first").find('input').val();
            orderItemsCount = parseInt(orderItemsCount);
        }
        orderItemsCount = parseInt(orderItemsCount) + 1;
        var items = [];
        
        items += "<tr>" +
                "<td tag=''><input id='SerialNoDetail' name='SerialNoDetail[]' value='" + orderItemsCount + "' type = 'text' class='form-control dcSno' style='width:55px' placeholder = 'SNo' readonly></td>" +
                "<td tag=''><input id='CustomerItemNo' name='CustomerItemNo[]' class='form-control' style='width:100px' ><div class='form-group has-error form-error error-CustonerItemNo' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Custoner Item No!</label></div></td>" +
                "<td tag=''><select id='ItemCode' name='ItemCode[]' class='form-control' style='width:100px' onchange=''><option value='0'>Select Item Code</option><?php
                                        foreach ($itemList as $key) {
                                            ?><option value='<?= $key['item_id'] ?>'><?= $key['ItemCode'] ?></option><?php }?></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-counttype' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Select any Option!</label></div></td>" +
                "<td tag=''><input id='FinishQuantity' name='FinishQuantity[]' data-target='FinishQuantity' value=0 onfocusout='CalculateWeavingQuantity(this);CalculateTotalQuantity(this);sumTotalValues(this,0);CalculateTotalBales(this);' type='number' min='0' class='form-control' style='width:100px' ><div class='form-group has-error form-error error-FinishQuantity' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Finish Quantity!</label></div></td>" +
                "<td tag=''><select id='FinishQuantityUnit' name='FinishQuantityUnit[]' data-target='FinishQuantityUnit' class='form-control' style='width:100px;' onchange='CalculateWeavingQuantity(this);CalculateTotalQuantity(this);'><option value='0'>Select Unit</option><option value='doz'>doz</option><option value='pcs'>pcs</option></select><div class='pull-left col-xs-6 col-sm-4 col-md-4 form-group has-error form-error error-FinishQuantityUnit' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Select any Option!</label></div></td>" +
                "<td tag=''><input id='DozenPerBale' name='DozenPerBale[]' value=0 type='number' step='any' min='0' data-target='DozenPerBale' onfocusout='CalculateTotalBales(this);' class='form-control' style='width:75px'><div class='form-group has-error form-error error-DozenPerBale' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Dozen Per Bale!</label></div></td>" +
                "<td tag=''><input id='TotalBales' name='TotalBales[]' value=0 type='number' min='0' class='form-control' style='width:100px' readonly><div class='form-group has-error form-error error-TotalBales' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Total Bales!</label></div></td>" +
                "<td tag=''><input id='BPercent' name='BPercent[]' data-target='BPercent' value=0 onfocusout='CalculateWeavingQuantity(this);CalculateTotalQuantity(this);sumTotalValues(this,0);' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-B%' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter B%!</label></div></td>" +
                "<td tag=''><input id='WeavingQuantity' name='WeavingQuantity[]' value=0 type='number' min='0' class='form-control' style='width:100px' readonly><div class='form-group has-error form-error error-WeavingQuantity' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Weaving Quantity!</label></div></td>" +
                "<td tag=''><input id='AdditionalRequirement' name='AdditionalRequirement[]' data-target='AdditionalRequirement' value=0 onfocusout='CalculateTotalQuantity(this);sumTotalValues(this,0);' type='number' min='0' class='form-control' style='width:100px'><div class='form-group has-error form-error error-AdditionalRequirement' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Additional Requirement!</label></div></td>" +
                "<td tag=''><input id='ExcessAvailable' name='ExcessAvailable[]' data-target='ExcessAvailable' value=0 onfocusout='CalculateTotalQuantity(this);sumTotalValues(this,0);' type='number' min='0' class='form-control' style='width:100px'><div class='form-group has-error form-error error-ExcessAvailable' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Excess Available!</label></div></td>" +
                "<td tag=''><input id='TotalQuantity' name='TotalQuantity[]' value=0 type='number' min='0' class='form-control' style='width:100px' readonly><div class='form-group has-error form-error error-TotalQuantity' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Total Quantity!</label></div></td>" +
                "<td tag=''><input id='Rate' name='Rate[]' value=0 type='number' step='any' min='0' onfocusout='sumTotalValues(this,0);' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Rate' style='width:0px;margin-left:0px;display:none;'>" +
                "<label class='control-label' for='inputError'>Enter Rate!</label></div></td>" +
                "<td tag=''><select id='RateUnit' name='RateUnit[]' class='form-control' style='width:100px;'><option value='0'>Select Unit</option><option value='Per dozen'>Per dozen</option><option value='Per Lbs'>Per Lbs</option><option value='Per Kg'>Per Kg</option><option value='Per Set'>Per Set</option><option value='Per Pc'>Per Pc</option><option value='Per Pack'>Per Pack</option></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-RateUnit' style='width:0px;margin-left:0px;display:none'>" +
                "<label class='control-label' for='inputError'>Enter Rate!</label></div></td>" +
                "<td><input id='AddButton' name='AddButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='+' onclick='populateGridRows()' readonly></td>" +
                "<td tag=''><input id='DelButton' name='DelButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='X' onclick='deleteGridRows(this)' readonly></td></tr>";
        $('#customerOrderTbody').append(items);
        
        if (formMode === "Edit") {
            resetSNO();
        }
    }
    
    function retrivePopup() {
	formMode = "Retrieve";
        $("#EditAnchor").removeAttr("disabled");
        $("#PrintAnchor").removeAttr("disabled");
        bootbox.dialog({
            title: "Customer Order Items",
            message:
                    "<fieldset>" +
                    "<div class='box box-primary'>" +
                    "<div class='box-body'>" +
                    "<form name='customerOrderFormEdit' role='' method='' action='' style='margin-top:0px;'>" +
                    "<div class='col-md-12'>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6' style='width:443px;margin-top:20px;'>" +
                    "<label>Search</label>" +
                    "<input id='searchCustomerOrder' name='searchCustomerOrder' type='text' class='form-control' placeholder='Search by Premier PO' style='width:200px;'>" +
                    "<input id='SearchNow' type='button' value='OK' class='btn btn-primary' onclick='search()' style='width: 100px;margin-left: 205px;margin-top:-58px;'>" +
                    "</div>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6' style='margin-top:20px;'>" +
                    "<label>Customer PO Number</label>" +
                    "<input id='CustomerPONoEdit'name='CustomerPONoEdit'type='text'class='form-control' placeholder='' style='width:200px;' readonly>" +
                    "</div>" +
                    "<div class='pull-left col-xs-10 col-sm-5 col-md-5' style='margin-top:20px;'>" +
                    "<label>Premier PO Number</label>" +
                    "<input id='PremierPONumberEdit'name='PremierPONumberEdit' type='text' class='form-control' placeholder='' style='width:200px;' readonly>" +
                    "</div><br>" +
                     "<div id='customerOrderDetailDiv' class='pull-left col-xs-2 col-sm-1 col-md-1' style='width:106px;margin-top:50px;margin-left:-105px;display:none;'>" +
                    "</div><br>" +
                    "<div class='pull-left col-xs-12 col-sm-6 col-md-6'  style='margin-top:20px;'>" +
                    "<label>Order Date</label>" +
                    "<input id='OrderDateEdit'name='OrderDateEdit' type='text'class='form-control' placeholder='' style='width:200px;' readonly>" +
                    "</div>" +
                    "</div>" +
                    "<fieldset>" +
                    "<div class='box-body table-responsive' style='margin-top:20px;'>" +
                    "<div class='box'>" +
                    "<table class='table table-bordered table-striped'>" +
                    "<thead>" +
                    "<tr>" +
                    "<th width='10%'>Customer Item No</th>" +
                    "<th width='5%'>Item Code</th>" +
                    "<th width='10%'>Finish Quantity</th>" +
                    "<th width='10%'>Finish Quantity Unit</th>" +
                    "<th width='5%'>Dozen Per Bale</th>" +
                    "<th width='5%'>Total Bales</th>" +
                    "<th width='5%'>B%</th>" +
                    "<th width='10%'>Weaving Quantity</th>" +
                    "<th width='10%'>Additional Requirement</th>" +
                    "<th width='10%'>Excess Available</th>" +
                    "<th width='10%'>Total Weaving Quantity</th>" +
                    "<th width='5%'>Rate</th>" +
                    "<th width='5%'>Rate Unit</th>" +
                    "</tr>" +
                    "</thead>" +
                    "<tbody id='customerOrderTbodyDetail'>" +
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
    
    function search(object) {
        var items = [];
        var searchValue = $('#searchCustomerOrder').val();
        var decimalPlaces = 2;
        if (searchValue === "") {
            bootbox.alert("Please enter value to search for", function(result) {
            });
        } 
        else
        {
            $.ajax({
                url: "<?= base_url() ?>index.php/customerorder/search",
                type: "POST",
                data: {search: searchValue},
                success: function(data) {
                    if (data !== "null")
                    {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            try {
                                    $("#CustomerPONoEdit").val(parsedData[0]['CustomerPO']);
                                    $("#PremierPONumberEdit").val(parsedData[0]['PremierPO']);
                                    $("#OrderDateEdit").val(getFormatedDate(parsedData[0]['OrderDate']));
                                    $('#customerOrderDetailDiv').html("<span><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('" + encodeURI(data) + "','None')>Edit</a> | <a style='cursor: pointer'; href='<?= base_url() ?>index.php/customerorder/Delete/" + parsedData[0]['customer_order_id'] + "'>Delete</a></span>");
                                    $('#customerOrderDetailDiv').show();
                                    $.each(parsedData, function(i, val) {
                                       
                                        items += "<tr>" +
                                            "<td>" + val.CustomerItemNo + "</td>" +
                                            "<td>" + val.ItemCode + "</td>" +
                                            "<td>" + fractionNotation(val.FinishQuantity, decimalPlaces) + "</td>" +
                                            "<td>" + val.FinishQuantityUnit + "</td>" +
                                            "<td>" + fractionNotation(val.DozenPerBale, decimalPlaces) + "</td>" +
                                            "<td>" + fractionNotation(val.TotalBales, decimalPlaces) + "</td>" +
                                            "<td>" + fractionNotation(val.BPercent, decimalPlaces) + "</td>" +
                                            "<td>" + fractionNotation(val.WeavingQuantity, decimalPlaces) + "</td>" +
                                            "<td>" + fractionNotation(val.AdditionalRequirement, decimalPlaces) + "</td>" +
                                            "<td>" + fractionNotation(val.ExcessAvailable, decimalPlaces) + "</td>" +
                                            "<td>" + fractionNotation(val.TotalWeavingQuantity, decimalPlaces) + "</td>" +
                                            "<td>" + fractionNotation(val.Rate, decimalPlaces) + "</td>" +
                                            "<td>" + val.RateUnit + "</td>" +
                                            "</tr>";                                   
                                    });
                                     $("#customerOrderTbodyDetail").html(items);
                                
                            } catch (e) {
                                console.log(e);
                            }
                        }
                        else {
                                $("#CustomerPONoEdit").val('');
                                $("#PremierPONumberEdit").val('');
                                $("#OrderDateEdit").val('');
                                $('#customerOrderDetailDiv').hide();
                                $("#customerOrderTbodyDetail").html("<tr><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
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

    function ediForm(detailData, type) {
        if (type === 'editmenu') {
            formMode = "Edit";
            var action = "<?php echo base_url() ?>index.php/customerorder/Update";
            enableElements("#customerPO");
            enableElements("#premierPO");
            enableElements("#CustomerOrderDated");
            enableTable("#OrderItemsTable *");
            var countRows = $("#customerOrderGrid> tbody").children().length;
            if (countRows > 0) {
                enableElements('#SaveCustomerOrder');
            }
            document.getElementById("customerOrderForm").action = action;
        }
        else
        {
            var parsedData = JSON.parse(decodeURI(detailData));
            if (parsedData.length > 0) {
                $("#customer_order_id").val(parsedData[0]['customer_order_id']);
                $("#customerPO").val(decodeURI(parsedData[0]['CustomerPO']));
                $("#premierPO").val(decodeURI(parsedData[0]['PremierPO']));
                $("#CustomerOrderDated").val(getFormatedDate(parsedData[0]['OrderDate']));
                $("#TotalFinishQuantity").val(fractionNotation(parsedData[0]['TotalFinishQuantity']));
                $("#TotalWeavingPieces").val(fractionNotation(parsedData[0]['TotalWeavingPieces']));
                $("#TotalPOValue").val(fractionNotation(parsedData[0]['TotalPOValue']));                
                var items = [];
                var count = 0;
                $.each(parsedData, function(i, val) {
                    count = parseInt(count) + 1;
                    items += "<tr>" +
                            "<td tag=''><input id='SerialNoDetail' name='SerialNoDetail[]' value='" + count + "' type = 'text' class='form-control COSno' style='width:55px' placeholder = 'SNo' readonly></td>" +
                            "<td tag=''><input id='CustomerItemNo' name='CustomerItemNo[]' value='" + val.CustomerItemNo + "' class='form-control' style='width:100px' ><div class='form-group has-error form-error error-CustonerItemNo' style='width:0px;margin-left:0px;display:none;'>" +
                            "<label class='control-label' for='inputError'>Enter Custoner Item No!</label></div></td>" +
                            "<td tag=''><select id='ItemCode' name='ItemCode[]' class='form-control' style='width:100px' onchange=''><option value='0'>Select Item Code</option><?php
                                                    foreach ($itemList as $key) {
                                                        ?><option " + (val['ItemCode'] === '<?= $key['ItemCode'] ?>' ? "selected" : "") + " value='<?= $key['item_id'] ?>'><?= $key['ItemCode'] ?></option><?php }  ?></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-counttype' style='width:0px;margin-left:0px;display:none;'>" +
                            "<label class='control-label' for='inputError'>Select any Option!</label></div></td>" +
                            "<td tag=''><input id='FinishQuantity' name='FinishQuantity[]' data-target='FinishQuantity' value='" + val.FinishQuantity + "' onfocusout='CalculateWeavingQuantity(this);CalculateTotalQuantity(this);sumTotalValues(this,0);CalculateTotalBales(this);' type='number' min='0' class='form-control' style='width:100px' ><div class='form-group has-error form-error error-FinishQuantity' style='width:0px;margin-left:0px;display:none;'>" +
                            "<label class='control-label' for='inputError'>Enter Finish Quantity!</label></div></td>" +
                            "<td tag=''><select id='FinishQuantityUnit' name='FinishQuantityUnit[]' data-target='FinishQuantityUnit' class='form-control' style='width:100px;' onchange='CalculateWeavingQuantity(this);CalculateTotalQuantity(this);'><option value='0'>Select Unit</option><option " + (val['FinishQuantityUnit'] === 'doz' ? "selected" : "") + " value='doz'>doz</option><option " + (val['FinishQuantityUnit'] === 'pcs' ? "selected" : "") + " value='pcs'>pcs</option></select><div class='pull-left col-xs-6 col-sm-4 col-md-4 form-group has-error form-error error-FinishQuantityUnit' style='width:0px;margin-left:0px;display:none;'>" +
                            "<label class='control-label' for='inputError'>Select any Option!</label></div></td>" +
                            "<td tag=''><input id='DozenPerBale' name='DozenPerBale[]' value='" + val.DozenPerBale + "' data-target='DozenPerBale'  type='number' step='any' min='0' onfocusout='CalculateTotalBales(this);' class='form-control' style='width:75px'><div class='form-group has-error form-error error-DozenPerBale' style='width:0px;margin-left:0px;display:none;'>" +
                            "<label class='control-label' for='inputError'>Enter Dozen Per Bale!</label></div></td>" +
                            "<td tag=''><input id='TotalBales' name='TotalBales[]' value='" + val.TotalBales + "'  type='number' min='0' class='form-control' style='width:100px' readonly><div class='form-group has-error form-error error-TotalBales' style='width:0px;margin-left:0px;display:none;'>" +
                            "<label class='control-label' for='inputError'>Enter Total Bales!</label></div></td>" +
                            "<td tag=''><input id='BPercent' name='BPercent[]' data-target='BPercent' value='" + val.BPercent + "' onfocusout='CalculateWeavingQuantity(this);CalculateTotalQuantity(this);sumTotalValues(this,0);' type='number' step='any' min='0' class='form-control' style='width:75px'><div class='form-group has-error form-error error-B%' style='width:0px;margin-left:0px;display:none;'>" +
                            "<label class='control-label' for='inputError'>Enter B%!</label></div></td>" +
                            "<td tag=''><input id='WeavingQuantity' name='WeavingQuantity[]' value='" + val.WeavingQuantity + "' type='number' min='0' class='form-control' style='width:100px' readonly><div class='form-group has-error form-error error-WeavingQuantity' style='width:0px;margin-left:0px;display:none;'>" +
                            "<label class='control-label' for='inputError'>Enter Weaving Quantity!</label></div></td>" +
                            "<td tag=''><input id='AdditionalRequirement' name='AdditionalRequirement[]' data-target='AdditionalRequirement' value='" + val.AdditionalRequirement + "' onfocusout='CalculateTotalQuantity(this);sumTotalValues(this,0);' type='number' min='0' class='form-control' style='width:100px'><div class='form-group has-error form-error error-AdditionalRequirement' style='width:0px;margin-left:0px;display:none;'>" +
                            "<label class='control-label' for='inputError'>Enter Additional Requirement!</label></div></td>" +
                            "<td tag=''><input id='ExcessAvailable' name='ExcessAvailable[]' data-target='ExcessAvailable' value='" + val.ExcessAvailable + "' onfocusout='CalculateTotalQuantity(this);sumTotalValues(this,0);' type='number' min='0' class='form-control' style='width:100px'><div class='form-group has-error form-error error-ExcessAvailable' style='width:0px;margin-left:0px;display:none;'>" +
                            "<label class='control-label' for='inputError'>Enter Excess Available!</label></div></td>" +
                            "<td tag=''><input id='TotalQuantity' name='TotalQuantity[]' value='" + val.TotalWeavingQuantity + "' type='number' min='0' class='form-control' style='width:100px' readonly><div class='form-group has-error form-error error-TotalQuantity' style='width:0px;margin-left:0px;display:none;'>" +
                            "<label class='control-label' for='inputError'>Enter Total Quantity!</label></div></td>" +
                            "<td tag=''><input id='Rate' name='Rate[]' value='" + val.Rate + "' type='number' step='any' min='0' onfocusout='sumTotalValues(this,0);' class='form-control' style='width:75px'><div class='form-group has-error form-error error-Rate' style='width:0px;margin-left:0px;display:none;'>" +
                            "<label class='control-label' for='inputError'>Enter Rate!</label></div></td>" +
                            "<td tag=''><select id='RateUnit' name='RateUnit[]' value='" + val.RateUnit + "' class='form-control' style='width:100px;'><option value='0'>Select Unit</option><option " + (val['RateUnit'] === 'Per dozen' ? "selected" : "") + " value='Per dozen'>Per dozen</option><option " + (val['RateUnit'] === 'Per Lbs' ? "selected" : "") + " value='Per Lbs'>Per Lbs</option><option " + (val['RateUnit'] === 'Per Kg' ? "selected" : "") + " value='Per Kg'>Per Kg</option><option " + (val['RateUnit'] === 'Per Set' ? "selected" : "") + " value='Per Set'>Per Set</option><option " + (val['RateUnit'] === 'Per Pc' ? "selected" : "") + " value='Per Pc'>Per Pc</option><option " + (val['RateUnit'] === 'Per Pack' ? "selected" : "") + " value='Per Pack'>Per Pack</option></select><div class='pull-left col-xs-12 col-sm-6 col-md-6 form-group has-error form-error error-RateUnit' style='width:0px;margin-left:0px;display:none'>" +
                            "<label class='control-label' for='inputError'>Enter Rate!</label></div></td>" +
                            "<td><input id='AddButton' name='AddButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='+' onclick='populateGridRows()' readonly></td>" +
                            "<td tag=''><input id='DelButton' name='DelButton' class='btn btn-primary' style='width:35px;height:30px;text-align:center;float: right; cursor: pointer' value='X' onclick='deleteGridRows(this)' readonly></td></tr>";
                });
                $('#customerOrderTbody').html(items);
                disableElements("#customerPO");
                disableElements("#premierPO");
                disableElements("#CustomerOrderDated");   
                disableTable("#OrderItemsTable *");
                resetSNO();        
            }
        }
    }
     
    function resetForm() {
	
        if (formMode === 'Retrieve' || formMode === 'Edit') {
            return true;
        } else {
            emptyAllFields("#customerPO");
            emptyAllFields("#premierPO");
            emptyAllFields("#CustomerOrderDated");
            emptyAllFields("#TotalFinishQuantity");
            emptyAllFields("#TotalWeavingPieces");
            emptyAllFields("#TotalPOValue");
            emptyAllFields("#OrderItemsTable *");
        }
    }

    function doToggle(id) {
        $(id).toggle();
    }
    
    function CalculateWeavingQuantity(obj) {
        var type = $(obj).data("target");
        var bpercent = 0.00;
        var finishQuantity = 0.00;
        var finishQuantityUnit = 0.00;
        var elementWeavingQty;
               
        if (type === "BPercent" ) {
            bpercent = $(obj).val();
            finishQuantity = $(obj).closest('td').prev().prev().prev().prev().find('input').val();
            finishQuantityUnit = $(obj).closest('td').prev().prev().prev().find('select option:selected').val();
            elementWeavingQty = $(obj).closest('td').next().find('input');            
        }
        
        if (type === "FinishQuantity" ) {
            bpercent = $(obj).closest('td').next().next().next().next().find('input').val();
            finishQuantity = $(obj).val(); 
            finishQuantityUnit = $(obj).closest('td').next().find('select option:selected').val();
            elementWeavingQty = $(obj).closest('td').next().next().next().next().next().find('input');
        }
        
        if (type === "FinishQuantityUnit" ) {
            bpercent = $(obj).closest('td').next().next().next().find('input').val();
            finishQuantity =  $(obj).closest('td').prev().find('input').val();
            finishQuantityUnit = $(obj).val();
            elementWeavingQty = $(obj).closest('td').next().next().next().next().find('input');
        }
       
        var weavingQuantity = 0.00;
        var bpercentQuantity = 0.00;
        
        if (bpercent === 0.00 || finishQuantity === 0.00 || bpercent === "undefined" || finishQuantity === "undefined")
        {
            return;
        }
        
        if (finishQuantityUnit === "doz") {
            bpercent = bpercent / 100;
            finishQuantity = finishQuantity * 12;
            bpercentQuantity = bpercent * finishQuantity;
            weavingQuantity = parseFloat(finishQuantity) + parseFloat(bpercentQuantity);
        }
        else if (finishQuantityUnit === "pcs") {
            bpercent = bpercent / 100;
            bpercentQuantity = bpercent * finishQuantity;
            weavingQuantity = parseFloat(finishQuantity) + parseFloat(bpercentQuantity);
        }
        $(elementWeavingQty).val(round(weavingQuantity, 0));
    }
    
    function CalculateTotalQuantity(obj) {
        var type = $(obj).data("target");
        var weavingQuantity = 0.00;
        var additionalReq = 0.00;
        var excessAvailable = 0.00;
        var totalQuantity = 0.00;
        var elementTotalQuantity;
        
        if (type === "FinishQuantity")
        {
            weavingQuantity = $(obj).closest('td').next().next().next().next().next().find('input').val(); 
            additionalReq = $(obj).closest('td').next().next().next().next().next().next().find('input').val(); 
            excessAvailable = $(obj).closest('td').next().next().next().next().next().next().next().find('input').val(); 
            elementTotalQuantity = $(obj).closest('td').next().next().next().next().next().next().next().next().find('input'); 
        }
        
        if (type === "FinishQuantityUnit")
        {
            weavingQuantity = $(obj).closest('td').next().next().next().next().find('input').val(); 
            additionalReq = $(obj).closest('td').next().next().next().next().next().find('input').val(); 
            excessAvailable = $(obj).closest('td').next().next().next().next().next().next().find('input').val(); 
            elementTotalQuantity = $(obj).closest('td').next().next().next().next().next().next().next().find('input'); 
        }
        
        if (type === "BPercent")
        {
            weavingQuantity = $(obj).closest('td').next().find('input').val(); 
            additionalReq = $(obj).closest('td').next().next().find('input').val(); 
            excessAvailable = $(obj).closest('td').next().next().next().find('input').val(); 
            elementTotalQuantity = $(obj).closest('td').next().next().next().next().find('input'); 
        }
        
        if (type === "AdditionalRequirement")
        {
            weavingQuantity = $(obj).closest('td').prev().find('input').val(); 
            additionalReq = $(obj).val();
            excessAvailable = $(obj).closest('td').next().find('input').val(); 
            elementTotalQuantity = $(obj).closest('td').next().next().find('input')
        }
        
        if (type === "ExcessAvailable")
        {
            weavingQuantity = $(obj).closest('td').prev().prev().find('input').val(); 
            additionalReq = $(obj).closest('td').prev().find('input').val(); 
            excessAvailable = $(obj).val();
            elementTotalQuantity = $(obj).closest('td').next().find('input'); 
        }
        
        if (weavingQuantity === 0.00 || weavingQuantity === "undefined" || additionalReq === "undefined" || excessAvailable === "undefined")
        {
            return;
        }
        
        totalQuantity = parseFloat(weavingQuantity) + parseFloat(additionalReq) - parseFloat(excessAvailable);
        $(elementTotalQuantity).val(round(totalQuantity, 0));
    }
    
    function CalculateTotalBales(obj) {
        var type = $(obj).data("target");
        var finishQuantity = 0.00;
        var dozenPerBales = 0.00;
        var totalBales = 0.00;
        var elementTotalBales = 0.00;
        
        if(type === "FinishQuantity"){
            finishQuantity = $(obj).val();
            dozenPerBales = $(obj).closest('td').next().next().find('input').val(); 
            elementTotalBales = $(obj).closest('td').next().next().next().find('input'); 
        }
        
        if (type === "DozenPerBale"){
            dozenPerBales = $(obj).val();
            finishQuantity = $(obj).closest('td').prev().prev().find('input').val(); 
            elementTotalBales = $(obj).closest('td').next().find('input'); 
        }
        
        if (dozenPerBales === 0.00 || dozenPerBales === "undefined" || finishQuantity === "undefined")
        {
            return;
        }
        
        totalBales = finishQuantity / dozenPerBales;
        $(elementTotalBales).val(round(totalBales, 0));        
    }
        
    function sumTotalValues(obj, type) {
        //$(obj).val(fractionNotation($(obj).val(), 2));
        $('#TotalFinishQuantity').val(0.00);
        var totalQty = $('#OrderItemsTable tr td:nth-last-child(13) input');
        var sumTotalQty = 0.00;
        for (var i = 0; i < totalQty.length; i++) {
            var qty = totalQty[i].value;
            if (qty !== "") {
                if (qty.indexOf(',') > -1) {
                    qty = qty.replace(/,/g, "");
                }
                sumTotalQty = sumTotalQty + parseFloat(qty);
            }
        }
        $('#TotalFinishQuantity').val(fractionNotation(sumTotalQty, 2));

        $('#TotalWeavingPieces').val(0.00);
        var totalWeavingPieces = $('#OrderItemsTable tr td:nth-last-child(5) input');
        var sumTotalWeavingPieces = 0.00;
        for (var j = 0; j < totalWeavingPieces.length; j++) {
            var weavingPieces = totalWeavingPieces[j].value;
            if (weavingPieces !== "") {
                sumTotalWeavingPieces = sumTotalWeavingPieces + parseFloat(weavingPieces);
            }
        }
        $('#TotalWeavingPieces').val(fractionNotation(sumTotalWeavingPieces, 2));
        
        $('#TotalPOValue').val(0.00);
        var rateCollection = $('#OrderItemsTable tr td:nth-last-child(4) input'); 
        var totalPOValue = 0.00;
        var poValue = 0.00;
        var finishQty = 0.00;
        var rate = 0.00;
        for (var k = 0; k < rateCollection.length; k++) {
            finishQty = totalQty[k].value;
            rate = rateCollection[k].value;
            if (finishQty !== 0) {
                if (finishQty.indexOf(',') > -1) {
                    finishQty = qty.replace(/,/g, "");
                }
            }
            if (rate !== 0) {
                poValue = rate * finishQty;
            }
            totalPOValue = totalPOValue + parseFloat(poValue);
            
        }
        $('#TotalPOValue').val(fractionNotation(totalPOValue, 2));        
    }

    function printPC() {

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
        var customerPO = $('#customerPO').val();
        var premierPO = $('#premierPO').val();
        var date = $('#CustomerOrderDated').val();
        var totalFinishQuantity = $('#TotalFinishQuantity').val();
        var totalWeavingPcs = $('#TotalWeavingPieces').val();
        var totalPOValue = $('#TotalPOValue').val();
        
        if ((customerPO === "") 
                || (premierPO === "") 
                || (date === "dd-mm-yyyy")
                || (date === "00-00-0000")
                || (date === "01-01-1970")
                || (date === "")
                || (totalFinishQuantity === 0 || totalFinishQuantity === "")
                || (totalWeavingPcs === 0 || totalWeavingPcs === "")
                || (totalPOValue === 0 || totalPOValue === ""))
            isValidate = 0;
        else 
            isValidate = 1;
        
        if (customerPO === "") {
            $(".error-customerPO").show();
        } else {
            $(".error-customerPO").hide();
        }
        
        if (premierPO === "") {
            $(".error-premierPO").show();
        } else {
            $(".error-premierPO").hide();
        }
        
        if (date === "dd-mm-yyyy" || (date === "00-00-0000") || (date === "01-01-1970")) {
            $(".error-gfdate").show();
        } else {
            $(".error-gfdate").hide();
        }
        
        if (totalFinishQuantity === 0 || totalFinishQuantity === "") {
            $(".error-TotalFinishQuantity").show();
        } else {
            $(".error-TotalFinishQuantity").hide();
        }
        
        if (totalWeavingPcs === 0 || totalWeavingPcs === "") {
            $(".error-TotalWeavingPieces").show();
        } else {
            $(".error-TotalWeavingPieces").hide();
        }
        
        if (totalPOValue === 0 || totalPOValue === "") {
            $(".error-TotalPOValue").show();
        } else {
            $(".error-TotalPOValue").hide();
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
        
    function round(num, places) {    
        return Number(Math.round(num + "e+" + places)  + "e-" + places);
    }
    
    function resetSNO() {
        var countRows = $("#customerOrderGrid > tbody").children().length;
        var sNO = $("#customerOrderGrid").find(".COSno");
        if (countRows > 0) {
            for (var counter = 1; counter <= countRows; counter++) {
                $(sNO[counter - 1]).val(counter);
            }
        }
    }
    
    function disableTable(idTable) {
        $(idTable).attr("disabled", true);
    }

    function enableTable(idTable) {
        $(idTable).attr("disabled", false);
    }
    
    function deleteGridRows(r) {
        var i = r.parentNode.parentNode.rowIndex;
        var totalFinishQtyModified = 0.00;
        var totalWeavingPcsModified = 0.00;
        var totalPOValueModified = 0.00;
        var totalFinishQty = $('#TotalFinishQuantity').val();
        var totalWeavingPcs = $('#TotalWeavingPieces').val();
        var totalPOValue = $('#TotalPOValue').val();
        var finishQty = $(r).closest("td").prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().find('input').val();
        var weavingQty = $(r).closest("td").prev().prev().prev().prev().find('input').val();
        var rate = $(r).closest("td").prev().prev().prev().find('input').val();
        
        if (totalFinishQty !== "") {
            if (totalFinishQty.indexOf(',') > -1) {
                totalFinishQty = totalFinishQty.replace(/,/g, "");
            }
        }
        if (totalWeavingPcs !== "") {
            if (totalWeavingPcs.indexOf(',') > -1) {
                totalWeavingPcs = totalWeavingPcs.replace(/,/g, "");
            }
        }
        
        if (totalPOValue !== "") {
            if (totalPOValue.indexOf(',') > -1) {
                totalPOValue = totalPOValue.replace(/,/g, "");
            }
        }
                
        if (finishQty !== "") {
            if (finishQty.indexOf(',') > -1) {
                finishQty = finishQty.replace(/,/g, "");
            }
        }
        if (weavingQty !== "") {
            if (weavingQty.indexOf(',') > -1) {
                weavingQty = weavingQty.replace(/,/g, "");
            }
        }
        
        if (rate !== "") {
            if (rate.indexOf(',') > -1) {
                rate = rate.replace(/,/g, "");
            }
        }
        
        var poValue = parseFloat(rate) * parseFloat(finishQty);
        
        document.getElementById('customerOrderGrid').deleteRow(i);
        totalFinishQtyModified = totalFinishQty - finishQty;
        totalWeavingPcsModified = totalWeavingPcs - weavingQty;
        totalPOValueModified = totalPOValue - poValue;
        
        if (totalFinishQtyModified < 0) {
            totalFinishQtyModified = 0.00;
        }
        if (totalWeavingPcsModified < 0) {
            totalWeavingPcsModified = 0.00;              
        }        
        if (totalPOValueModified < 0) {
            totalPOValueModified = 0.00;           
        }
        
        $('#TotalFinishQuantity').val(fractionNotation(totalFinishQtyModified, 2));
        $('#TotalWeavingPieces').val(fractionNotation(totalWeavingPcsModified, 2));
        $('#TotalPOValue').val(fractionNotation(totalPOValueModified, 2));
        resetSNO();
    }

    function ApplyFilterFinishQuantityUnit(value) {
        $("#FinishQuantityUnit option").filter(function() {
                            return ($(this).text() === decodeURI(value));
                    }).prop('selected', true);
    }
</script>