<?php
include 'include/leftmenu.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Weaving Contract 
        </h1><br><br>
        <div class="row">
            <div class="pull-right" style="padding-right:15px;">
                <a class="btn btn-app" onclick="retrivePopup()">
                    <i class="fa fa-align-justify"></i> Retrieve                  
                </a>
                <a class="btn btn-app" onclick="reloadForm()">
                    <i class="fa fa-adn"></i> New                  
                </a>                                                
                <a id="EditAnchor" class="btn btn-app" onclick="ediForm('Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'editmenu')"> 
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a class="btn btn-app" onclick="resetForm()">
                    <i class="fa fa-repeat"></i> Reset
                </a>
                <a id="PrintAnchor" class="btn btn-app" onclick="printWeavingContractReport($('#ContractNo').val(), $('#ItemCode option:selected').val())">
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
                    <form id="weavingContractForm" name="weavingContractForm" role="form" method="post" action="<?= base_url() ?>index.php/weavingcontract/Add" onSubmit="return validationForm()"> 
                        <fieldset>
                            <legend onclick="">Contract Info</legend>
                            <div id="FlashMessage">
                                <h5 id="WeavingInsertMessage" style=""><?= $insertMessage ?></h5>
                                <h5 id="WeavingUpdateMessage" style=""><?= $updateMessage ?></h5>
                                <h5 id="WeavingDeleteMessage" style=""><?= $deleteMessage ?></h5>
                            </div>  
                            <div id="ContractInfoDiv">
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <input id="weaving_contract_id" name="weaving_contract_id" type="hidden" value="">
                                    <label for="">Contract No.</label>
                                    <input id="ContractNo" name="ContractNo" type="text" value="<?php
                                    if ($wcNumber) {
                                        echo $wcNumber;
                                    }
                                    ?>" min="0" class="form-control" style="" readonly>
                                </div>                      
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Dated</label>
                                    <div class="input-group" style="width: 150px;">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input id="WeavingContractDated" name="WeavingContractDated" type="text" class="form-control" style="" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                                    </div>
                                    <div class="form-group has-error form-error error-wcdate" style="width: 130px;">
                                        <label class="control-label" for="inputError">Enter Date!</label>
                                    </div>
                                </div>                           
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Party Name</label>
                                    <select id="PartyName" name="PartyName" class="form-control" style="width:200px;">
                                        <option value="0">Select Party</option>                                       
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
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Item Code</label>
                                    <select id="ItemCode" name="ItemCode" class="form-control" style="width:200px;" onchange="populateItemInfo()">
                                        <option value="0">Select Item Code</option>
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
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Finish Weight</label>
                                    <input id="FinishWeight" name="FinishWeight" type="text" value="" min="0" class="form-control" style="" readonly>
                                    <div class="form-group has-error form-error error-FinishWeight" style="width: 130px;">
                                        <label class="control-label" for="inputError">Enter Finish Weight!</label>
                                    </div>
                                </div>
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Greigh Weight</label>  
                                    <input id="GreightWeight" name="GreightWeight" type="text" value="" min="0" class="form-control" style="" readonly>
                                    <div class="form-group has-error form-error error-GreightWeight" style="width: 130px;">
                                        <label class="control-label" for="inputError">Enter Greigh Weight!</label>
                                    </div>
                                </div> 
                                <div class="pull-left col-xs-12 col-sm-6 col-md-12" style="margin-top: 20px;">
                                    <label for="">Item Description</label>
                                    <input id="ItemDescription" name="ItemDescription" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div> 
                            </div>     
                        </fieldset><br><br>
                        <fieldset>
                            <legend onclick="">Yarn Required</legend>
                            <div id="" class="pull-left col-xs-6 col-sm-6 col-md-12" style="margin-top: 20px;">
                                <div id="">
                                    <div class="pull-left col-xs-6 col-sm-6 col-md-12" style="margin-top: 20px;">
                                        <label for="">Order Quantity</label>
                                        <input id="OrderQuantity" name="OrderQuantity" type="text" value="" min="0" class="form-control" style="" placeholder="Order Quantity">
                                        <div class="pull-left col-xs-6 col-sm-4 col-md-4 form-group has-error form-error error-orderquantity" style="width: 150px;margin-left: 0px;">
                                            <label class="control-label" for="inputError">Enter Order Quantity!</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
<!--                            <div id="" class="pull-left col-xs-6 col-sm-6 col-md-12" style="margin-top: 20px;">
                                <div id="">
                                    <div class="pull-left col-xs-6 col-sm-2 col-md-6" style="margin-top: 20px;">
                                        <label for="">Finish Weight</label>
                                        <input id="FinishWeight" name="FinishWeight" type="text" value="" min="0" class="form-control" style="" placeholder="Finish Weight">
                                    </div>
                                </div>
                                <div>
                                    <div class="pull-left col-xs-2 col-sm-1 col-md-2" style="margin-top: 50px;">
                                        <label for="" style="width: 150px;margin-left: -15px;"></label>                                                              
                                    </div>   
                                    <div id="" class="pull-left col-xs-6 col-sm-4 col-md-4" style="margin-top: 20px;">
                                        <label for="">Greight Weight</label>  
                                        <input id="GreightWeight" name="GreightWeight" type="text" value="" min="0" class="form-control" style="" placeholder="Greight Weight">
                                    </div>   
                                </div> 
                            </div>-->
                            <div id="" class="pull-left col-xs-6 col-sm-6 col-md-12" style="margin-top: 20px;">
                                <div id="">
                                    <div class="pull-left col-xs-6 col-sm-2 col-md-6" style="margin-top: 20px;">
                                        <label for="">Pile</label>
                                        <input id="Pile" name="Pile" type="text" value="" min="0" class="form-control" style="" readonly>
                                    </div>
                                </div>
                                <div>
                                    <div class="pull-left col-xs-2 col-sm-1 col-md-2" style="margin-top: 50px;">
                                        <label for="" style="width: 65px;margin-left: -10px;">%</label>                                                              
                                    </div>   
                                    <div id="" class="pull-left col-xs-6 col-sm-4 col-md-4" style="margin-top: 20px;">
                                        <label for=""></label>  
                                        <input id="PileDescription" name="PileDescripton" type="text" value="" min="0" class="form-control" style="" readonly>
                                    </div>   
                                </div> 
                            </div>
                            <div id="" class="pull-left col-xs-6 col-sm-6 col-md-12">
                                <div id="">
                                    <div class="pull-left col-xs-6 col-sm-2 col-md-6" style="margin-top: 20px;">
                                        <label for="">Weft</label>
                                        <input id="Weft" name="Weft" type="text" value="" min="0" class="form-control" style="" readonly>
                                    </div>
                                </div>
                                <div>
                                    <div class="pull-left col-xs-2 col-sm-1 col-md-2" style="margin-top: 50px;">
                                        <label for="" style="width: 65px;margin-left: -10px;">%</label>                                                              
                                    </div>   
                                    <div id="" class="pull-left col-xs-6 col-sm-4 col-md-4" style="margin-top: 20px;">
                                        <label for=""></label>  
                                        <input id="WeftDescription" name="WeftDescription" type="text" value="" min="0" class="form-control" style="" readonly>
                                    </div>   
                                </div> 
                            </div>
                            <div id="" class="pull-left col-xs-6 col-sm-6 col-md-12">
                                <div id="">
                                    <div class="pull-left col-xs-6 col-sm-2 col-md-6" style="margin-top: 20px;">
                                        <label for="">Ground</label>
                                        <input id="Ground" name="Ground" type="text" value="" min="0" class="form-control" style="" readonly>
                                    </div>
                                </div>
                                <div>
                                    <div class="pull-left col-xs-2 col-sm-1 col-md-2" style="margin-top: 50px;">
                                        <label for="" style="width: 65px;margin-left: -10px;">%</label>                                                              
                                    </div>   
                                    <div id="" class="pull-left col-xs-6 col-sm-4 col-md-4" style="margin-top: 20px;">
                                        <label for=""></label>  
                                        <input id="GroundDescription" name="GroundDescription" type="text" value="" min="0" class="form-control" style="" readonly>
                                    </div>   
                                </div> 
                            </div>
                            <div id="" class="pull-left col-xs-6 col-sm-6 col-md-12">
                                <div id="">
                                    <div class="pull-left col-xs-6 col-sm-2 col-md-6" style="margin-top: 20px;">
                                        <label for="">Fancy</label>
                                        <input id="FancyCount" name="FancyCount" type="text" value="" min="0"  class="form-control" style="" readonly>
                                    </div>
                                </div>
                                <div>
                                    <div class="pull-left col-xs-2 col-sm-1 col-md-2" style="margin-top: 50px;">
                                        <label for="" style="width: 65px;margin-left: -10px;">%</label>                                                              
                                    </div>   
                                    <div id="" class="pull-left col-xs-6 col-sm-4 col-md-4" style="margin-top: 20px;">
                                        <label for=""></label>  
                                        <input id="FancyDescription" name="FancyDescription" type="text" value="" min="0" class="form-control" style="" readonly>
                                    </div>   
                                </div> 
                            </div>
                            <div id="otherFields" class="OtherDiv">
                                <div class="pull-left col-xs-6 col-sm-2 col-md-12">
                                    <div class="pull-left col-xs-6 col-sm-4 col-md-4" style="margin-top: 20px;">
                                        <label for="">Other</label>
                                        <input id="Other" name="Other[]" type="text" value="" class="form-control" style="" readonly>
                                    </div>
                                </div>
                            </div>                              
                        </fieldset><br><br>
                        <fieldset>
                            <legend onclick="">Construction</legend>
                            <div id="">
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Reed on Loom</label>
                                    <input id="ReedonLoom" name="ReedonLoom" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div>                      
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Pick on Loom</label>
                                    <input id="Pick on Loom" name="PaymentTerms" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div>                           
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Pile Tar</label>
                                    <input id="PaymentTerms" name="PaymentTerms" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div>  
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Ground Tar</label>
                                    <input id="PaymentTerms" name="PaymentTerms" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div>   
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Cut Panna</label>
                                    <input id="PaymentTerms" name="PaymentTerms" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div>                      
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Kinari</label>
                                    <input id="Kinari" name="Kinari" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div>                           
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Nali Tar</label>
                                    <input id="NaliTar" name="NaliTar" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div>  
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Misc.</label>
                                    <input id="Misc" name="Misc" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div>   
                            </div>                           
                        </fieldset><br><br>
                        <fieldset>
                            <legend onclick="">Size on Table</legend>
                            <div id="">
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Cutting Border</label>
                                    <input id="CuttingBorder" name="CuttingBorder" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div>                      
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Plain Cam</label>
                                    <input id="PlainCam" name="PlainCam" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div>                           
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Pile to Pile</label>
                                    <input id="PiletoPile" name="PiletoPile" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div>  
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Pile Cam</label>
                                    <input id="PileCam" name="PileCam" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div>   
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Fancy</label>
                                    <input id="Fancy" name="Fancy" type="text" value="" min="0" class="form-control" style=""  readonly>
                                </div>                      
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Frame</label>
                                    <input id="Frame" name="Frame" type="text" value="" min="0" class="form-control" style="" readonly>
                                </div>                           
                                <div class="pull-right col-xs-6 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <br><input id="SaveWeavingContractButton" type="submit" value="Save" class="btn btn-primary" style="width: 75px;float: right;">
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
        $("#WeavingContractDated").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
    });
    
    var attribute = 0;

    function retrivePopup() {
	formMode = "Retrieve";
        $("#EditAnchor").removeAttr("disabled");
        $("#PrintAnchor").removeAttr("disabled");
        bootbox.dialog({
        title: "Weaving Contract(s)",
                message:
                "<fieldset>" +
                "<div class='box box-primary'>" +
                "<div class='box-body'>" +
                "<form name='weavingContractFormEdit' role='' method='' action='' class=''>" +
                "<br><div class='col-md-12'>" +
                "<div class='pull-left col-md-2'>" +
                "<label>Search</label>" +
                "</div>" +
                "<div class='pull-left col-md-4'>" +
                "<input id='searchWeavingContract'name='searchWeavingContract'type='text'class='form-control' onkeyup='search()' placeholder='Search by WC Number' style='width:200px;margin-left:-100px;'>" +
                //"<input id='SearchNow' type='button' value='OK' class='btn btn-primary' onclick='search()' style='width: 100px;margin-left: 110px;margin-top:-58px;'>" +
                "</div>" +
                "</div><br><br><br>" +
                "<fieldset>" +
                "<div class='box-body table-responsive'>" +
                "<div class='box'>" +
                "<table class='table table-bordered table-striped'>" +
                "<thead>" +
                "<tr>" +
                "<th width='7%'>WC-#</th>" +
                "<th width='10%'>Contract Date</th>" +
                "<th width='10%'>Order Quantity</th>" +
                "<th width='10%'>Item Code</th>" +
                "<th width='20%'>Party Name</th>" +
                "<th width='10%'>Total Bags</th>" +
                "<th width='05%'>Status</th>" +
                "<th width='10%'>Details</th>" +
                "</tr>" +
                "</thead>" +
                "<tbody id='WeavingContractTbody'>" +<?php
                                        foreach ($wcList as $key) {
                                            $isOpened = "";
                                            if ($key['isClosed'] === '0') {
                                                $isOpened = "Opened";
                                            }
                                            if ($key['isClosed'] === '1') {
                                                $isOpened = "Closed";
                                            }
                                            ?>
                    "<tr>" +
                    "<td><?= $key['WeavingContractNo'] ?></td>" +
                    "<td><?= $key['ContractDate'] ?></td>" +
                    "<td><?= $key['OrderQunatity'] ?></td>" +
                    "<td><?= $key['ItemCode'] ?></td>" +
                    "<td><?= $key['CompanyName'] ?></td>" +
                    "<td><?= number_format($key['TotalBags']) ?></td>" +
                    "<td><?= $isOpened ?></td>" +
                    "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('<?= $key['weaving_contract_id'] ?>','<?= rawurlencode($key['WeavingContractNo']) ?>','<?= rawurlencode($key['ContractDate']) ?>','<?= rawurlencode($key['OrderQunatity']) ?>','<?= rawurlencode($key['ItemCode']) ?>','<?= rawurlencode($key['CompanyName']) ?>','<?= rawurlencode($key['TotalBags']) ?>','None')>Edit</a>" +
                    "<span> | </span>" +
                    "<a style='cursor: pointer;' href='<?= base_url() ?>index.php/weavingcontract/Delete/<?= $key['weaving_contract_id'] ?>'>Delete</a>" +
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
    
    function search(object) {
        var items = [];
        var WCStatus = "";
        var searchValue = $('#searchWeavingContract').val();
        if (searchValue === "") {
            <?php foreach ($wcList as $key) {
                    $isOpened = "";
                    if ($key['isClosed'] === '0') {
                        $isOpened = "Opened";
                     }else{
                             $isOpened = "Closed";
                    }
            ?>
            items += "<tr>" +
                    "<td><?= $key['WeavingContractNo'] ?></td>" +
                    "<td><?= $key['ContractDate'] ?></td>" +
                    "<td><?= $key['OrderQunatity'] ?></td>" +
                    "<td><?= $key['ItemCode'] ?></td>" +
                    "<td><?= $key['CompanyName'] ?></td>" +
                    "<td><?= number_format($key['TotalBags']) ?></td>" +
                    "<td><?= $isOpened ?></td>" +
                    "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('<?= $key['weaving_contract_id'] ?>','<?= rawurlencode($key['WeavingContractNo']) ?>','<?= rawurlencode($key['ContractDate']) ?>','<?= rawurlencode($key['OrderQunatity']) ?>','<?= rawurlencode($key['ItemCode']) ?>','<?= rawurlencode($key['CompanyName']) ?>','<?= rawurlencode($key['TotalBags']) ?>','None')>Edit</a>" +
                    "<span> | </span>" +
                    "<a style='cursor: pointer;' href='<?= base_url() ?>index.php/weavingcontract/Delete/<?= $key['weaving_contract_id'] ?>'>Delete</a>" +
                    "</td>" +
                    "</tr>";<?php } ?>
            $("#WeavingContractTbody").html(items);
        } else
        {
            $.ajax({
                url: "<?= base_url() ?>index.php/weavingcontract/search",
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
                                        WCStatus = "Opened";
                                    } else
                                    {
                                        WCStatus = "Closed";
                                    }
                                        items += "<tr>" +
                                            "<td>" + val.WeavingContractNo + "</td>" +
                                            "<td>" + val.ContractDate + "</td>" +
                                            "<td>" + val.OrderQunatity + "</td>" +
                                            "<td>" + val.ItemCode + "</td>" +
                                            "<td>" + val.CompanyName + "</td>" +
                                            "<td>" + val.TotalBags + "</td>" +
                                            "<td>" + WCStatus + "</td>" +
                                            "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('" + encodeURI(val.weaving_contract_id) + "','" + encodeURI(val.WeavingContractNo) + "','" + encodeURI(val.ContractDate) + "','" + encodeURI(val.OrderQunatity) + "','" + encodeURI(val.ItemCode) + "','" + encodeURI(val.CompanyName) + "','" + encodeURI(val.TotalBags) + "','None')>Edit</a>" +
                                            "<span> | </span>" +
                                            "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/weavingcontract/Delete/" + val.Purchase_contract_id + "'>Delete</a></td>" +
                                            "</tr>";
                                });
                                $("#WeavingContractTbody").html(items);
                            } catch (e) {
                                console.log(e);
                            }
                        }
                        else {
                            $("#WeavingContractTbody").html("<tr><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td><td></td></tr>");
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

    function ediForm(wcID, wcNo, contractDate, orderQuantity, itemCode, partyName, totalBags, type) {
        if (type === 'editmenu') {
            formMode = "Edit";
            var action = "<?php echo base_url() ?>index.php/weavingcontract/Update";
            enableElements("#WeavingContractDated");
            enableElements("#PartyName");
            enableElements("#ItemCode");
            enableElements("#OrderQuantity");
            document.getElementById("weavingContractForm").action = action;
        }
        else
        {
            $("#weaving_contract_id").val(wcID);
            $("#ContractNo").val(decodeURI(wcNo));
            $("#WeavingContractDated").val(getFormatedDate(decodeURI(contractDate)));
            $("#OrderQuantity").val(decodeURI(orderQuantity));
            $('#PartyName option').filter(function() {
                    return ($(this).text() === decodeURI(partyName));
            }).prop('selected', true);
            $('#ItemCode option').filter(function() {
                    return ($(this).text() === decodeURI(itemCode));
            }).prop('selected', true);
            disableElements("#WeavingContractDated");
            disableElements("#OrderQuantity");
            disableElements("#PartyName");
            disableElements("#ItemCode");
            populateItemInfo();            
        }
    }
    
    function populateOtherDiv() {
        if (attribute >= 0) {
            attribute = parseInt(attribute) + 1;
        }
        var items = "";
        items += //"<div class='pull-left col-xs-6 col-sm-2 col-md-12'>" +
                "<div class='pull-left col-xs-6 col-sm-4 col-md-4' style='margin-top: 20px; margin-left: 15px;'>" +
                "<label for=''>Attribute " + attribute + "</label>" +
                "<input id='Attribute" + attribute + "' name='Other[]' type='text' value='' min='0' class='form-control' style='' placeholder='Attribute " + attribute + "'>" +
                //"</div>" +
                "</div>";
        $('.OtherDiv').append(items);
    }

    function removeOtherDiv(obj) {

        if ($('.OtherDiv').children().length > 1) {
            if (attribute > 0) {
                attribute = parseInt(attribute) - 1;
            }
            $(obj).parent().parent().parent().find('div').last().remove();
        }
    }
    
    function splitOtherFields(otherStr) {
        var splitted = otherStr.split("|");
        var i = 0
        var element = document.getElementById("Other");
        
        if (splitted.length > 1) {
            element.setAttribute("value", splitted[0]);
            for(i=1; i < splitted.length; i++) {
                populateOtherDiv();
                element = document.getElementById("Attribute" + i);
                element.setAttribute("value", splitted[i]);
            }
        }
        else {
            $("#Other").val(otherStr);
        }
    }
    
    function removeOtherFields() {
        var i = 0;
        var count = attribute;
        for(i = 0; i < count; i++) {
            removeOtherDiv($("#Other"));   
        }
        attribute = 0;
    }

    function resetForm() {
	if (formMode === 'Retrieve' || formMode === 'Edit') {
            return true;
        } else {
            emptyAllFields("#WeavingContractDated");
            $('#PartyName option').filter(function() {
                    return ($(this).val() === "0");
            }).prop('selected', true);
            $('#ItemCode option').filter(function() {
                    return ($(this).val() === "0");
            }).prop('selected', true);
            emptyAllFields("#OrderQuantity");
            //emptyAllFields("#ItemCode").val(decodeURI(val.ItemCode));
            emptyAllFields("#ItemDescription");
            emptyAllFields("#FinishWeight");
            emptyAllFields("#GreightWeight");
            //emptyAllFields("#FinishGSM").val(decodeURI(val.FinishGSM));
            //emptyAllFields("#blend").val(decodeURI(val.BlendPercent));
            emptyAllFields("#Pile");
            emptyAllFields("#PileDescription");
            emptyAllFields("#Weft");
            emptyAllFields("#WeftDescription");
            emptyAllFields("#Ground");
            emptyAllFields("#GroundDescription");
            emptyAllFields("#FancyCount");
            emptyAllFields("#FancyDescription");
            //emptyAllFields("#ProcessLoss").val(decodeURI(ProcessLossPercent));
            //emptyAllFields("#WeavingLoss").val(decodeURI(WeavingLossPercent));
            //splitOtherFields(unescape(Other));
            emptyAllFields("#ReedonLoom");
            emptyAllFields("#PickonLoom");
            emptyAllFields("#PileTar");
            emptyAllFields("#GroundTar");
            emptyAllFields("#CutPanna");
            emptyAllFields("#Kinari");
            emptyAllFields("#NaliTar");
            emptyAllFields("#Misc");
            emptyAllFields("#CuttingBorder");
            emptyAllFields("#PlainCam");
            emptyAllFields("#PiletoPile");
            emptyAllFields("#PileCam");
            emptyAllFields("#Fancy");
            emptyAllFields("#Fancy");
        }
    }

    function doToggle(id) {
        $(id).toggle();
    }

    function printWeavingContractReport(wcNo, itemId) {
        wcNo  = wcNo || null;
        itemId = itemId || null;

         console.log('wcNo',wcNo);
          console.log('itemId',itemId);    

        if((wcNo != null) && (itemId != 0 && itemId != null)){
             window.open(
            "<?php echo base_url(); ?>index.php/weavingcontract/printReport/" + wcNo + "/" + itemId,
            '_blank'
            );
         } 
    }
    
    function populateItemInfo() {
        var itemID = $("#ItemCode").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/itemspecification/getItemInfo",
            type: "POST",
            data: {ItemID: itemID},
            success: function(data) {
                if (data !== "null") {
                    var parsedData = JSON.parse(data);
                    if (parsedData.length > 0) {  
                        $.each(parsedData, function(i, val) {
                            removeOtherFields();
                            //$("#ItemCode").val(decodeURI(val.ItemCode));
                            $("#ItemDescription").val(unescape(val.ItemDesc));
                            $("#FinishWeight").val(decodeURI(val.FinishWeight) + " " + unescape(val.FinishWeightUnit));
                            $("#GreightWeight").val(decodeURI(val.GreighWeight));
                            //$("#FinishGSM").val(decodeURI(val.FinishGSM));
                            //$("#blend").val(decodeURI(val.BlendPercent));
                            $("#Pile").val(decodeURI(val.PilePercent));
                            $("#PileDescription").val(unescape(val.PileCount) + " " + decodeURI(val.PileUnit));
                            $("#Weft").val(decodeURI(val.WeftPercent));
                            $("#WeftDescription").val(unescape(val.WeftCount) + " " + decodeURI(val.WeftUnit));
                            $("#Ground").val(decodeURI(val.GroundPercent));
                            $("#GroundDescription").val(unescape(val.GroundCount) + " " + decodeURI(val.GroundUnit));
                            $("#FancyCount").val(decodeURI(val.FancyPercent));
                            $("#FancyDescription").val(unescape(val.FancyCount) + " " + decodeURI(val.FancyUnit));
                            //$("#ProcessLoss").val(decodeURI(ProcessLossPercent));
                            //$("#WeavingLoss").val(decodeURI(WeavingLossPercent));
                            splitOtherFields(unescape(val.Other));
                            $("#ReedonLoom").val(unescape(val.ReedOnLoom));
                            $("#PickonLoom").val(unescape(val.PickOnLoom));
                            $("#PileTar").val(unescape(val.PileTar));
                            $("#GroundTar").val(unescape(val.GroundTar));
                            $("#CutPanna").val(unescape(val.CutPanna));
                            $("#Kinari").val(unescape(val.Kinari));
                            $("#NaliTar").val(unescape(val.NaliTar));
                            $("#Misc").val(unescape(val.Misc));
                            $("#CuttingBorder").val(unescape(val.CuttingBorder));
                            $("#PlainCam").val(unescape(val.PlainCam));
                            $("#PiletoPile").val(unescape(val.PiletoPile));
                            $("#PileCam").val(unescape(val.PileCam));
                            $("#Fancy").val(unescape(val.Fancy));
                            $("#Fancy").val(unescape(val.Frame));
                        }); 
                    }                       
                }
            } 
        });
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