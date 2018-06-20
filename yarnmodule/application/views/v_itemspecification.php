<!DOCTYPE html>
<?php
include 'include/leftmenu.php';
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Item Creation 
        </h1><br><br>
        <div class="row">
            <div class="pull-right" style="padding-right:15px;">
                <a class="btn btn-app" onclick="retrivePopup()">
                    <i class="fa fa-align-justify"></i> Retrieve                  
                </a>
                <a class="btn btn-app" onclick="reloadForm()">
                    <i class="fa fa-adn"></i> New                  
                </a>                                                
                <a id="EditAnchor" class="btn btn-app" onclick="readyForUpdate()"> 
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
                <!--                <div class="box-header">
                                </div> /.box-header -->
                <div class="box-body">
                    <!-- form start -->
                    <form id="itemSpecificationForm" name="itemSpecificationForm" role="form" method="post" action="<?= base_url() ?>index.php/itemspecification/Add" onSubmit="return validationForm()"> 
                        <fieldset>
                            <legend onclick="">Item Specification</legend>
                            <div id="FlashMessage">
                                <h5 id="PurchaseInsertMessage" style=""><?= $insertMessage ?></h5>
                                <h5 id="PurchaseUpdateMessage" style=""><?= $updateMessage ?></h5>
                                <h5 id="PurchaseDeleteMessage" style=""><?= $deleteMessage ?></h5>
                            </div>  
                            <div class="pull-left col-xs-6 col-sm-2 col-md-12">
                                <div id="">
                                    <div class="pull-left col-xs-6 col-sm-2 col-md-4" style="margin-top: 20px;">
                                        <label for="">Item Code</label>
                                        <input id="ItemCode" name="ItemCode" type="text" value="" class="form-control" style="" placeholder="Item Code">
                                        <input id="ItemID" name="ItemID" type="hidden">
                                        <div class="pull-left col-xs-6 col-sm-4 col-md-3 form-group has-error form-error error-ItemCode" style="width: 150px;margin-left: 0px;">
                                            <label class="control-label" for="inputError">Enter Item Code!</label>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="pull-left col-xs-6 col-sm-2 col-md-12">
                                <div class="pull-left col-xs-12 col-sm-2 col-md-2" style="margin-top: 50px;">
                                    <label for="">Finish Size</label>
                                </div>
                                <div>
                                    <div id="">
                                        <div class="pull-left col-xs-12 col-sm-2 col-md-2" style="margin-top: 20px;">
                                            <label for="">Length</label>
                                            <input id="Length" name="Length" type="number" value="" min="0" class="form-control" style="" placeholder="Length">
                                            <div class="pull-left col-xs-6 col-sm-4 col-md-3 form-group has-error form-error error-Length" style="width: 150px;margin-left: 0px;">
                                                <label class="control-label" for="inputError">Enter Length!</label>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div id="" class="pull-left col-xs-6 col-sm-4 col-md-3" style="margin-top: 20px;">
                                        <label for="">Unit</label>
                                        <select id="LengthUnit" name="LengthUnit" class="form-control" style="width:150px;">
                                            <option value="0">Select Unit</option>                                      
                                            <option value="inch">inch</option>                                      
                                            <option value="cm">cm</option>                                      
                                        </select>
                                        <div class="pull-left col-xs-6 col-sm-4 col-md-3 form-group has-error form-error error-lengthunit" style="width: 150px;margin-left: 0px;">
                                            <label class="control-label" for="inputError">Select any Option!</label>
                                        </div>
                                    </div>
                                    <div id="">
                                        <div class="pull-left col-xs-12 col-sm-2 col-md-2" style="margin-top: 20px;">
                                            <label for="">Width</label>
                                            <input id="Width" name="Width" type="number" value="" min="0" class="form-control" style="" placeholder="Width">
                                            <div class="pull-left col-xs-6 col-sm-4 col-md-3 form-group has-error form-error error-Width" style="width: 150px;margin-left: 0px;">
                                                <label class="control-label" for="inputError">Enter Width!</label>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div id="" class="pull-left col-xs-6 col-sm-4 col-md-3" style="margin-top: 20px;">
                                        <label for="">Unit</label>
                                        <select id="WidthUnit" name="WidthUnit" class="form-control" style="width:150px;">
                                            <option value="0">Select Unit</option>                                      
                                            <option value="inch">inch</option>                                      
                                            <option value="cm">cm</option>                                      
                                        </select>
                                        <div class="pull-left col-xs-6 col-sm-4 col-md-3 form-group has-error form-error error-WidthUnit" style="width: 150px;margin-left: 0px;">
                                            <label class="control-label" for="inputError">Select any Option!</label>
                                        </div>
                                    </div> 
                                </div>                            
                            </div>           
                            <div class="pull-left col-xs-6 col-sm-2 col-md-12" style="margin-top: 20px;">
                                <div id="">
                                    <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                        <label for="">Finish Weight</label>
                                        <input id="FinishWeight" name="FinishWeight" type="number" value="" min="0" step="any" class="form-control" style="" placeholder="Finish Weight">
                                        <div class="pull-left col-xs-6 col-sm-4 col-md-3 form-group has-error form-error error-FinishWeight" style="width: 150px;margin-left: 0px;">
                                            <label class="control-label" for="inputError">Enter Finish Weight!</label>
                                        </div>
                                    </div>                                    
                                </div>
                                <div id="" class="pull-left col-xs-6 col-sm-4 col-md-6" style="margin-top: 20px;">
                                    <label for=""></label>
                                    <select id="FinishWeightUnit" name="FinishWeightUnit" class="form-control" style="width:200px;">
                                        <option value="0">Select Unit</option>   
                                        <option value="lbs/doz">lbs/doz</option>                                      
                                        <option value="onz/doz">onz/doz</option>                                      
                                        <option value="gm/pc">gm/pc</option>                                      
                                    </select>
                                    <label for="" style="width: 150px;margin-left: 0px;">(Billing Weight)</label>
                                    <div class="pull-left col-xs-6 col-sm-4 col-md-4 form-group has-error form-error error-finsihweightunit" style="width: 150px;margin-left: 0px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div> 
                            </div>
                            <div class="pull-left col-xs-6 col-sm-2 col-md-12">
                                <div id="">
                                    <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                        <label for="">Greigh Weight</label>
                                        <input id="GreightWeight" name="GreightWeight" type="number" value="" min="0" step="any" class="form-control" style="" placeholder="Greigh Weight" readonly>
                                        <div class="pull-left col-xs-6 col-sm-4 col-md-4 form-group has-error form-error error-GreightWeight" style="width: 150px;margin-left: 0px;">
                                            <label class="control-label" for="inputError">Enter Greigh Weight!</label>
                                        </div>
                                    </div>                                    
                                </div>
                                <div>
                                    <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                        <label for="">Greigh Weight Unit</label>
                                        <input id="GreightWeightUnit" name="GreightWeightUnit" type="text" value="" class="form-control" style="" readonly>   
                                        <label for="" style="width: 350px;margin-left: 0px;">(Net in Greigh without cut piece)</label>
                                    </div>  
                                </div>  
                            </div> 
                            <div class="pull-left col-xs-6 col-sm-2 col-md-12">
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Finish GSM</label>
                                    <input id="FinishGSM" name="FinishGSM" type="text" value="" min="0" class="form-control" style="" placeholder="Finish GSM" readonly>
                                </div>  
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <input id="LoopCount" name="LoopCount" type="hidden" value="">
                                    <label for="">Loop</label>
                                    <select id="Loop" name="Loop" class="form-control" style="width:200px;" onchange="SetLoopCountName()">
                                        <option value="0">Select Count</option>  
                                        <?php
                                        foreach ($countCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['Count_id'] ?>"><?php echo $key['CountName'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-6 col-sm-4 col-md-4 form-group has-error form-error error-loop" style="width: 150px;margin-left: 0px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>
                            </div>     
                            <div class="pull-left col-xs-6 col-sm-2 col-md-12">
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Blend %</label>
                                    <input id="blend" name="blend" type="text" value="" class="form-control" style="" placeholder="Blend %">
                                </div>  
                                <div class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Attribute</label>
                                    <input id="attribute" name="attribute" type="text" value="" class="form-control" style="" placeholder="Attribute">
                                </div> 
                            </div>
                            <div class="pull-left col-xs-6 col-sm-2 col-md-12">
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Stitching Type</label>
                                    <input id="StitchingType" name="StitchingType" type="text" value="" class="form-control" style="" placeholder="Stitching Type">
                                </div>  
                            </div>
                        </fieldset><br><br>
                        <fieldset>
                            <legend onclick="">Consumption</legend>
                            <div id="PilDiv" class="pull-left col-xs-6 col-sm-2 col-md-12">
                                <div class="pull-left col-xs-6 col-sm-2 col-md-4" style="margin-top: 20px;">
                                    <label for="">Pile</label>
                                    <input id="Pile" name="Pile" type="text" value="" min="0" class="form-control" style="" placeholder="Pile">
                                </div>  
                                <div class="pull-left col-xs-2 col-sm-1 col-md-1" style="margin-top: 50px;">
                                    <span for="" style="width: 65px;margin-left: -25px;">%</span>                                                              
                                </div>  
                                <div id="" class="pull-left col-xs-6 col-sm-4 col-md-2" style="margin-top: 20px;">
                                    <label for="">Count</label>
                                    <select id="PileCount" name="PileCount" class="form-control" style="width:150px;">
                                        <option value="0">Select Count</option> 
                                        <?php
                                        foreach ($countCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['Count_id'] ?>"><?php echo $key['CountName'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-6 col-sm-4 col-md-2 form-group has-error form-error error-pilecount" style="width: 150px;margin-left: 0px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>                           
                                <div id="" class="pull-right col-xs-6 col-sm-4 col-md-2" style="margin-top: 20px;">
                                    <div style="margin-left:-75px;">
                                        <label for="">Type</label>
                                        <input id="PileUnit" name="PileType" type="text" value="" class="form-control" style="width:150px;" placeholder="Type">
                                        <div class="pull-left col-xs-6 col-sm-4 col-md-2 form-group has-error form-error error-piletype" style="width:150px;">
                                            <label class="control-label" for="inputError">Select any Option!</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="WeftDiv" class="pull-left col-xs-6 col-sm-2 col-md-12">
                                <div class="pull-left col-xs-6 col-sm-2 col-md-4" style="margin-top: 20px;">
                                    <label for="">Weft</label>
                                    <input id="Weft" name="Weft" type="text" value="" min="0" class="form-control" style="" placeholder="Weft">
                                </div>  
                                <div class="pull-left col-xs-2 col-sm-1 col-md-1" style="margin-top: 50px;">
                                    <span for="" style="width: 65px;margin-left: -25px;">%</span>                                                              
                                </div>  
                                <div id="" class="pull-left col-xs-6 col-sm-4 col-md-2" style="margin-top: 20px;">
                                    <label for="">Count</label>
                                    <select id="WeftCount" name="WeftCount" class="form-control" style="width:150px;">
                                        <option value="0">Select Count</option>                                      
                                        <?php
                                        foreach ($countCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['Count_id'] ?>"><?php echo $key['CountName'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-6 col-sm-4 col-md-2 form-group has-error form-error error-weftcount" style="width: 150px;margin-left: 0px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>                           
                                <div id="" class="pull-right col-xs-6 col-sm-4 col-md-2" style="margin-top: 20px;">
                                    <div style="margin-left:-75px;">
                                        <label for="">Type</label>
                                        <input id="WeftUnit" name="WeftType" type="text" value="" class="form-control" style="width:150px;" placeholder="Type">
                                        <div class="pull-left col-xs-6 col-sm-4 col-md-2 form-group has-error form-error error-wefttype" style="width: 150px;margin-left: 0px;">
                                            <label class="control-label" for="inputError">Select any Option!</label>
                                        </div>
                                    </div>                                   
                                </div>
                            </div>
                            <div id="Grounddiv" class="pull-left col-xs-6 col-sm-2 col-md-12">
                                <div class="pull-left col-xs-6 col-sm-2 col-md-4" style="margin-top: 20px;">
                                    <label for="">Ground</label>
                                    <input id="Ground" name="Ground" type="text" value="" min="0" class="form-control" style="" placeholder="Ground">
                                </div>  
                                <div class="pull-left col-xs-2 col-sm-1 col-md-1" style="margin-top: 50px;">
                                    <span for="" style="width: 65px;margin-left: -25px;">%</span>                                                              
                                </div>  
                                <div id="" class="pull-left col-xs-6 col-sm-4 col-md-2" style="margin-top: 20px;">
                                    <label for="">Count</label>
                                    <select id="GroundCount" name="GroundCount" class="form-control" style="width:150px;">
                                        <option value="0">Select Count</option>                                      
                                        <?php
                                        foreach ($countCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['Count_id'] ?>"><?php echo $key['CountName'] ?></option>
                                        <?php }
                                        ?>                                        
                                    </select>
                                    <div class="pull-left col-xs-6 col-sm-4 col-md-2 form-group has-error form-error error-groundcount" style="width: 150px;margin-left: 0px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>                           
                                <div id="" class="pull-right col-xs-6 col-sm-4 col-md-2" style="margin-top: 20px;">
                                    <div style="margin-left:-75px;">
                                        <label for="">Type</label>
                                        <input id="GroundUnit" name="GroundType" type="text" value="" class="form-control" style="width:150px;" placeholder="Type">
                                        <div class="pull-left col-xs-6 col-sm-4 col-md-2 form-group has-error form-error error-groundtype" style="width: 150px;margin-left: 0px;">
                                            <label class="control-label" for="inputError">Select any Option!</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-left col-xs-6 col-sm-2 col-md-12">
                                <div class="pull-left col-xs-6 col-sm-2 col-md-4" style="margin-top: 20px;">
                                    <label for="">Fancy</label>
                                    <input id="FancyPercent" name="FancyPercent" type="text" value="" min="0" class="form-control" style="" placeholder="Fancy">
                                </div>  
                                <div class="pull-left col-xs-2 col-sm-1 col-md-1" style="margin-top: 50px;">
                                    <span for="" style="width: 65px;margin-left: -25px;">%</span>                                                              
                                </div>  
                                <div id="" class="pull-left col-xs-6 col-sm-4 col-md-2" style="margin-top: 20px;">
                                    <label for="">Count</label>
                                    <select id="FancyCount" name="FancyCount" class="form-control" style="width:150px;">
                                        <option value="0"> Select Count</option>                                      
                                        <?php
                                        foreach ($countCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['Count_id'] ?>"><?php echo $key['CountName'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-6 col-sm-4 col-md-2 form-group has-error form-error error-fancycount" style="width: 150px;margin-left: 0px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>                           
                                <div id="" class="pull-right col-xs-6 col-sm-4 col-md-2" style="margin-top: 20px;">
                                    <div style="margin-left:-75px;">
                                        <label for="">Type</label>
                                        <input id="FancyUnit" name="FancyType" type="text" value="" class="form-control" style="width:150px;" placeholder="Type">
                                        <div class="pull-left col-xs-6 col-sm-4 col-md-2 form-group has-error form-error error-fancytype" style="width: 150px;margin-left: 0px;">
                                            <label class="control-label" for="inputError">Select any Option!</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-left col-xs-6 col-sm-2 col-md-12">
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Process Loss %</label>
                                    <input id="ProcessLoss" name="ProcessLoss" type="number" step="any" min="0" class="form-control" style="" placeholder="Process Loss %">
                                </div>  
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Weaving Loss %</label>
                                    <input id="WeavingLoss" name="WeavingLoss" type="number" step="any" min="0" class="form-control" style="" placeholder="Weaving Loss %">
                                </div>
                            </div>
                            <div id="otherFields" class="OtherDiv">
                                <div class="pull-left col-xs-6 col-sm-2 col-md-12">
                                    <div class="pull-left col-xs-6 col-sm-4 col-md-4" style="margin-top: 20px;">
                                        <label for="">Other</label>
                                        <input id="Other" name="Other[]" type="text" value="" class="form-control" style="" placeholder="Other">
                                    </div> 
                                    <div class="pull-left col-xs-6 col-sm-4 col-md-4" style="margin-top: 50px;">
                                        <input class="btn btn-primary" type="button" for="" style="cursor: pointer;font-size: larger" onclick="populateOtherDiv();" value="+" >                                                           
                                        <label></label>
                                        <input id="btnRemove" name="btnRemove" class="btn btn-primary" type="button" for="" style="cursor: pointer;font-size: larger" onclick="removeOtherDiv(this);" value="x">                                                           
                                    </div>  
                                </div>
                            </div>                          
                        </fieldset><br><br>
                        <fieldset>
                            <legend onclick="">Construction</legend>
                            <div id="">
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Reed on Loom</label>
                                    <input id="ReedonLoom" name="ReedonLoom" type="text" value="" min="0" class="form-control" style="" placeholder="Reed on Loom">
                                </div>                      
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Pick on Loom</label>
                                    <input id="PickonLoom" name="PickonLoom" type="text" value="" min="0" class="form-control" style="" placeholder="Pick on Loom">
                                </div>                           
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Pile Tar</label>
                                    <input id="PileTar" name="PileTar" type="text" value="" min="0" class="form-control" style="" placeholder="Pile Tar">
                                </div>  
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Ground Tar</label>
                                    <input id="GroundTar" name="GroundTar" type="text" value="" min="0" class="form-control" style="" placeholder="Ground Tar">
                                </div>   
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Cut Panna</label>
                                    <input id="CutPanna" name="CutPanna" type="text" value="" min="0" class="form-control" style="" placeholder="Cut Panna">
                                </div>                      
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Kinari</label>
                                    <input id="Kinari" name="Kinari" type="text" value="" min="0" class="form-control" style="" placeholder="Kinari">
                                </div>                           
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Nali Tar</label>
                                    <input id="NaliTar" name="NaliTar" type="text" value="" min="0" class="form-control" style="" placeholder="Nali Tar">
                                </div>  
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Misc.</label>
                                    <input id="Misc" name="Misc" type="text" value="" min="0" class="form-control" style="" placeholder="Misc">
                                </div>   
                            </div>                           
                        </fieldset><br><br>
                        <fieldset>
                            <legend onclick="">Size on Table</legend>
                            <div id="">
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Cutting Border</label>
                                    <input id="CuttingBorder" name="CuttingBorder" type="text" value="" min="0" class="form-control" style="" placeholder="Cutting Border">
                                </div>                      
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Plain Cam</label>
                                    <input id="PlainCam" name="PlainCam" type="text" value="" min="0" class="form-control" style="" placeholder="Plain Cam">
                                </div>                           
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Pile to Pile</label>
                                    <input id="PiletoPile" name="PiletoPile" type="text" value="" min="0" class="form-control" style="" placeholder="Pile to Pile">
                                </div>  
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Pile Cam</label>
                                    <input id="PileCam" name="PileCam" type="text" value="" min="0" class="form-control" style="" placeholder="Pile Cam">
                                </div>   
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Fancy</label>
                                    <input id="Fancy" name="Fancy" type="text" value="" min="0" class="form-control" style="" placeholder="Fancy">
                                </div>                      
                                <div id="" class="pull-right col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Frame</label>
                                    <input id="Frame" name="Frame" type="text" value="" min="0" class="form-control" style="" placeholder="Frame">
                                </div>                           
                                <div class="pull-right col-xs-6 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <br><input id="SaveItemSpecificationButton" type="submit" value="Save" class="btn btn-primary" style="width: 75px;float: right;">
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
    });

    var attribute = 0;
    function retrivePopup() {
        formMode = "Retrieve";
        $("#EditAnchor").removeAttr("disabled");
        $("#PrintAnchor").removeAttr("disabled");
        bootbox.dialog({
        title: "Item Specification(s)",
                message:
                "<fieldset>" +
                "<div class='box box-primary'>" +
                "<div class='box-body'>" +
                "<form name='itemSpecsFormEdit' role='' method='' action='' class=''>" +
                "<br><div class='col-md-12'>" +
                "<div class='pull-left col-md-2'>" +
                "<label>Search</label>" +
                "</div>" +
                "<div class='pull-left col-md-4'>" +
                "<input id='searchItemSpecs' name='searchItemSpecs' type='text' class='form-control' onkeyup='search()' placeholder='Search by Item Code' style='width:200px;margin-left:-100px;'>" +
                "</div>" +
                "</div><br><br><br>" +
                "<fieldset>" +
                "<div class='box-body table-responsive'>" +
                "<div class='box'>" +
                "<table class='table table-bordered table-striped'>" +
                "<thead>" +
                "<tr>" +
                "<th width='8%'>Item Code</th>" +
                "<th width='15%'>Item Description</th>" +
                "<th width='5%'>Details</th>" +
                "</tr>" +
                "</thead>" +
                "<tbody id='ItemSpecsTbody'>" + <?php
                                        foreach ($itemList as $key) {
                                        ?>
                    "<tr>" +
                    "<td><?= $key['ItemCode'] ?></td>" +
                    "<td><?= $key['ItemDesc'] ?></td>" +
                    "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('<?= $key['item_id'] ?>','<?= rawurlencode($key['ItemCode']) ?>','<?= rawurlencode($key['FinishLength']) ?>','<?= rawurlencode($key['FinishLengthUnit']) ?>','<?= rawurlencode($key['FinishWidth']) ?>','<?= rawurlencode($key['FinishWidthUnit']) ?>','<?= rawurlencode($key['FinishWeight']) ?>','<?= rawurlencode($key['FinishWeightUnit']) ?>','<?= rawurlencode($key['GreighWeight']) ?>','<?= rawurlencode($key['FinishGSM']) ?>','<?= rawurlencode($key['loop_count_id']) ?>','<?= rawurlencode($key['BlendPercent']) ?>','<?= rawurlencode($key['Attribute']) ?>','<?= rawurlencode($key['StitchingType']) ?>','<?= rawurlencode($key['PilePercent']) ?>','<?= rawurlencode($key['pile_count_id']) ?>','<?= rawurlencode($key['PileUnit']) ?>','<?= rawurlencode($key['WeftPercent']) ?>','<?= rawurlencode($key['weft_count_id']) ?>','<?= rawurlencode($key['WeftUnit']) ?>','<?= rawurlencode($key['GroundPercent']) ?>','<?= rawurlencode($key['ground_count_id']) ?>','<?= rawurlencode($key['GroundUnit']) ?>','<?= rawurlencode($key['FancyPercent']) ?>','<?= rawurlencode($key['fancy_count_id']) ?>','<?= rawurlencode($key['FancyUnit']) ?>','<?= rawurlencode($key['ProcessLossPercent']) ?>','<?= rawurlencode($key['WeavingLossPercent']) ?>','<?= rawurlencode($key['Other']) ?>','<?= rawurlencode($key['ReedOnLoom']) ?>','<?= rawurlencode($key['PickOnLoom']) ?>','<?= rawurlencode($key['PileTar']) ?>','<?= rawurlencode($key['GroundTar']) ?>','<?= rawurlencode($key['CutPanna']) ?>','<?= rawurlencode($key['Kinari']) ?>','<?= rawurlencode($key['NaliTar']) ?>','<?= rawurlencode($key['Misc']) ?>','<?= rawurlencode($key['CuttingBorder']) ?>','<?= rawurlencode($key['PlainCam']) ?>','<?= rawurlencode($key['PiletoPile']) ?>','<?= rawurlencode($key['PileCam']) ?>','<?= rawurlencode($key['Fancy']) ?>','<?= rawurlencode($key['Frame']) ?>','<?= rawurlencode($key['GreighWeightUnit']) ?>','None')>Edit</a>" +
                    "<span> | </span>" +
                    "<a style='cursor: pointer;' href='<?= base_url() ?>index.php/itemspecification/Delete/<?= $key['item_id'] ?>'>Delete</a>" +
                    "</td>" +
                    "</tr>" +<?php } ?>
                "</tbody>" +
                "<tfoot>" +
                "<tr>" +
                "<th></th>" +
                "<th></th>" +
                "<th></th>" +
                "</tr>" +
                "</tfoot>" +
                "</table>" +
                "</fieldset>" +
                "</div>" +
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
    
    function search() {
            var items = [];
            var searchValue = $('#searchItemSpecs').val();
            if (searchValue === "") {             
                <?php foreach ($itemList as $key) {
                ?>
                items += "<tr>" +
                    "<td><?= $key['ItemCode'] ?></td>" +
                    "<td><?= $key['ItemDesc'] ?></td>" +
                    "<td><a data-dismiss='modal' style='cursor: pointer;' onclick=ediForm('<?= $key['item_id'] ?>','<?= $key['ItemCode'] ?>','<?= $key['FinishLength'] ?>','<?= $key['FinishLengthUnit'] ?>','<?= rawurlencode($key['FinishWidth']) ?>','<?=rawurlencode($key['FinishWidthUnit']) ?>','<?= rawurlencode($key['FinishWeight']) ?>','<?= rawurlencode($key['FinishWeightUnit']) ?>','<?= rawurlencode($key['GreighWeight']) ?>','<?= rawurlencode($key['GreighWeightUnit']) ?>','<?= rawurlencode($key['FinishGSM']) ?>','<?= rawurlencode($key['loop_count_id']) ?>','<?= rawurlencode($key['BlendPercent']) ?>','<?= rawurlencode($key['Attribute']) ?>','<?= rawurlencode($key['StitchingType']) ?>','<?= rawurlencode($key['PilePercent']) ?>','<?= rawurlencode($key['pile_count_id']) ?>','<?= rawurlencode($key['PileUnit']) ?>','<?= rawurlencode($key['WeftPercent']) ?>','<?= rawurlencode($key['weft_count_id']) ?>','<?= rawurlencode($key['WeftUnit']) ?>','<?= rawurlencode($key['GroundPercent']) ?>','<?= rawurlencode($key['ground_count_id']) ?>','<?= rawurlencode($key['GroundUnit']) ?>','<?= rawurlencode($key['FancyPercent']) ?>','<?= rawurlencode($key['fancy_count_id']) ?>','<?= rawurlencode($key['FancyUnit']) ?>','<?= rawurlencode($key['ProcessLossPercent']) ?>','<?= rawurlencode($key['WeavingLossPercent']) ?>','<?= rawurlencode($key['Other']) ?>','<?= rawurlencode($key['ReedOnLoom']) ?>','<?= rawurlencode($key['PickOnLoom']) ?>','<?= rawurlencode($key['PileTar']) ?>','<?= rawurlencode($key['GroundTar']) ?>','<?= rawurlencode($key['CutPanna']) ?>','<?= rawurlencode($key['Kinari']) ?>','<?= rawurlencode($key['NaliTar']) ?>','<?= rawurlencode($key['Misc']) ?>','<?= rawurlencode($key['CuttingBorder']) ?>','<?= rawurlencode($key['PlainCam']) ?>','<?= rawurlencode($key['PiletoPile']) ?>','<?= rawurlencode($key['PileCam']) ?>','<?= rawurlencode($key['Fancy']) ?>','<?= rawurlencode($key['Frame']) ?>','<?= rawurlencode($key['GreighWeightUnit']) ?>','None')>Edit</a>" +
                    "<span> | </span>" +
                    "<a style='cursor: pointer;' href='<?= base_url() ?>index.php/itemspecification/Delete/<?= $key['item_id'] ?>'>Delete</a>" +
                    "</td>" +
                    "</tr>";<?php } ?>
                $("#ItemSpecsTbody").html(items);
            } 
            else
            {
                $.ajax({
                    url: "<?= base_url() ?>index.php/itemspecification/search",
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
                                                "<td>" + val.ItemCode + "</td>" +
                                                "<td>" + val.ItemDesc + "</td>" +
                                                "<td><a data-dismiss='modal' style='cursor: pointer;' onclick =ediForm('" + val.item_id + "','" + encodeURI(val.ItemCode) + "','" + encodeURI(val.FinishLength) + "','" + encodeURI(val.FinishLengthUnit) + "','" + encodeURI(val.FinishWidth) + "','" + encodeURI(val.FinishWidthUnit) + "','" + encodeURI(val.FinishWeight) + "','" + encodeURI(val.FinishWeightUnit) + "','" + encodeURI(val.GreighWeight) + "','" + encodeURI(val.FinishGSM) + "','" + encodeURI(val.loop_count_id) + "','" + encodeURI(val.BlendPercent) + "','"  + encodeURI(val.Attribute) + "','"  + encodeURI(val.StitchingType) + "','" + encodeURI(val.PilePercent) + "','" + encodeURI(val.pile_count_id) + "','" + encodeURI(val.PileUnit) + "','" + encodeURI(val.WeftPercent) + "','" + encodeURI(val.weft_count_id) + "','" + encodeURI(val.WeftUnit) + "','" + encodeURI(val.GroundPercent) + "','" + encodeURI(val.ground_count_id) + "','" + encodeURI(val.GroundUnit) + "','" + encodeURI(val.FancyPercent) + "','" + encodeURI(val.fancy_count_id) + "','" + encodeURI(val.FancyUnit) + "','" + encodeURI(val.ProcessLossPercent) + "','"+ encodeURI(val.WeavingLossPercent) + "','"+ encodeURI(val.Other) + "','"+ encodeURI(val.ReedOnLoom) + "','"+ encodeURI(val.PickOnLoom) + "','"+ encodeURI(val.PileTar) + "','"+ encodeURI(val.GroundTar) + "','"+ encodeURI(val.CutPanna) + "','"+ encodeURI(val.Kinari) + "','"+ encodeURI(val.NaliTar) + "','"+ encodeURI(val.Misc) + "','"+ encodeURI(val.CuttingBorder) + "','"+ encodeURI(val.PlainCam) + "','"+ encodeURI(val.PiletoPile) + "','"+ encodeURI(val.PileCam) + "','"+ encodeURI(val.Fancy) + "','"+ encodeURI(val.Frame) + "','" + encodeURI(val.GreighWeightUnit) +"','None')>Edit</a>" +
                                                "<span> | </span>" +
                                                "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/itemspecification/Delete/" + val.item_id + "'>Delete</a></td>" +
                                                "</tr>";
                                    });
                                    $("#ItemSpecsTbody").html(items);
                                } catch (e) {
                                    console.log(e);
                                }
                            }
                            else {
                                $("#ItemSpecsTbody").html("<tr><td></td><td>No Data Found</td><td></td></tr>");
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

    function ediForm(item_id,ItemCode,FinishLength,FinishLengthUnit,FinishWidth,FinishWidthUnit,FinishWeight,FinishWeightUnit,GreighWeight,
                    FinishGSM,loop_count_id,BlendPercent,Attribute, StitchingType, PilePercent,pile_count_id,PileUnit,WeftPercent,weft_count_id,
                    WeftUnit,GroundPercent,ground_count_id,GroundUnit,FancyPercent,fancy_count_id, FancyUnit, ProcessLossPercent, WeavingLossPercent, Other,
                    ReedOnLoom,PickOnLoom,PileTar,GroundTar,CutPanna,Kinari,NaliTar,Misc,CuttingBorder,PlainCam,PiletoPile,PileCam, Fancy, Frame, GreighWeightUnit, type) {
               
            removeOtherFields();
            $("#ItemID").val(item_id);
            $("#ItemCode").val(ItemCode);
            $("#Length").val(FinishLength);
            $('#LengthUnit option').filter(function() {
                return ($(this).text() === FinishLengthUnit);
            }).prop('selected', true);
            $("#Width").val(decodeURI(FinishWidth));
            $('#WidthUnit option').filter(function() {
                return ($(this).text() === decodeURI(FinishWidthUnit));
            }).prop('selected', true);
            $("#FinishWeight").val(decodeURI(FinishWeight));
            $('#FinishWeightUnit option').filter(function() {
                return ($(this).text() === unescape(FinishWeightUnit));
            }).prop('selected', true);
            $("#GreightWeight").val(decodeURI(GreighWeight));
            $("#GreightWeightUnit").val(unescape(GreighWeightUnit));
            $("#FinishGSM").val(decodeURI(FinishGSM));
            $('#Loop option').filter(function() {
                return ($(this).val() === decodeURI(loop_count_id));
            }).prop('selected', true);
            SetLoopCountName();
            $("#blend").val(unescape(BlendPercent));
            $("#attribute").val(unescape(Attribute));
            $("#StitchingType").val(unescape(StitchingType));
            $("#Pile").val(decodeURI(PilePercent));
            $('#PileCount option').filter(function() {
                return ($(this).val() === decodeURI(pile_count_id));
            }).prop('selected', true);
            $("#PileUnit").val(decodeURI(PileUnit));
//            $('#PileUnit option').filter(function() {
//                return ($(this).text() === decodeURI(PileUnit));
//            }).prop('selected', true);
            $("#Weft").val(decodeURI(WeftPercent));
            $('#WeftCount option').filter(function() {
                return ($(this).val() === decodeURI(weft_count_id));
            }).prop('selected', true);
            $("#WeftUnit").val(decodeURI(WeftUnit));
//            $('#WeftUnit option').filter(function() {
//                return ($(this).text() === decodeURI(WeftUnit));
//            }).prop('selected', true);
            $("#Ground").val(decodeURI(GroundPercent));
            $('#GroundCount option').filter(function() {
                return ($(this).val() === decodeURI(ground_count_id));
            }).prop('selected', true);
            $("#GroundUnit").val(decodeURI(GroundUnit));
//            $('#GroundUnit option').filter(function() {
//                return ($(this).text() === decodeURI(GroundUnit));
//            }).prop('selected', true);
            $("#FancyPercent").val(decodeURI(FancyPercent));
            $('#FancyCount option').filter(function() {
                return ($(this).val() === decodeURI(fancy_count_id));
            }).prop('selected', true);
            $("#FancyUnit").val(decodeURI(FancyUnit));
//            $('#FancyUnit option').filter(function() {
//                return ($(this).text() === decodeURI(FancyUnit));
//            }).prop('selected', true);
            $("#ProcessLoss").val(decodeURI(ProcessLossPercent));
            $("#WeavingLoss").val(decodeURI(WeavingLossPercent));
            splitOtherFields(unescape(Other));
            $("#ReedonLoom").val(unescape(ReedOnLoom));
            $("#PickonLoom").val(unescape(PickOnLoom));
            $("#PileTar").val(unescape(PileTar));
            $("#GroundTar").val(unescape(GroundTar));
            $("#CutPanna").val(unescape(CutPanna));
            $("#Kinari").val(unescape(Kinari));
            $("#NaliTar").val(unescape(NaliTar));
            $("#Misc").val(unescape(Misc));
            $("#CuttingBorder").val(unescape(CuttingBorder));
            $("#PlainCam").val(unescape(PlainCam));
            $("#PiletoPile").val(unescape(PiletoPile));
            $("#PileCam").val(unescape(PileCam));
            $("#Fancy").val(unescape(Fancy));
            $("#Frame").val(unescape(Frame));
            disableElements("#ItemCode");
            disableElements("#Length");
            disableElements("#LengthUnit");
            disableElements("#Width");
            disableElements("#WidthUnit");
            disableElements("#FinishWeight");
            disableElements("#FinishWeightUnit");
            disableElements("#GreightWeight");
            disableElements("#FinishGSM");
            disableElements("#Loop");
            disableElements("#blend");
            disableElements("#attribute");
            disableElements("#StitchingType");
            disableElements("#Pile");
            disableElements("#PileCount");
            disableElements("#PileUnit");
            disableElements("#Weft");
            disableElements("#WeftCount");
            disableElements("#WeftUnit");
            disableElements("#Ground");
            disableElements("#GroundCount");
            disableElements("#GroundUnit");
            disableElements("#FancyPercent");
            disableElements("#FancyCount");
            disableElements("#FancyUnit");
            disableElements("#ProcessLoss");
            disableElements("#WeavingLoss");
            disableElements("#otherFields *");
            disableElements("#ReedonLoom");
            disableElements("#PickonLoom");
            disableElements("#PileTar");
            disableElements("#GroundTar");
            disableElements("#CutPanna");
            disableElements("#Kinari");
            disableElements("#NaliTar");
            disableElements("#Misc");
            disableElements("#CuttingBorder");
            disableElements("#PlainCam");
            disableElements("#PiletoPile");
            disableElements("#PileCam");
            disableElements("#Fancy");
            disableElements("#Frame");
    }

    function readyForUpdate() {
        formMode = "Edit";
        var action = "<?php echo base_url() ?>index.php/itemspecification/Update";
        enableElements("#ItemCode");
        enableElements("#Length");
        enableElements("#LengthUnit");
        enableElements("#Width");
        enableElements("#WidthUnit");
        enableElements("#FinishWeight");
        enableElements("#FinishWeightUnit");
        enableElements("#GreightWeight");
        enableElements("#FinishGSM");
        enableElements("#Loop");
        enableElements("#blend");
        enableElements("#attribute");
        enableElements("#StitchingType");
        enableElements("#Pile");
        enableElements("#PileCount");
        enableElements("#PileUnit");
        enableElements("#Weft");
        enableElements("#WeftCount");
        enableElements("#WeftUnit");
        enableElements("#Ground");
        enableElements("#GroundCount");
        enableElements("#GroundUnit");
        enableElements("#FancyPercent");
        enableElements("#FancyCount");
        enableElements("#FancyUnit");
        enableElements("#ProcessLoss");
        enableElements("#WeavingLoss");
        enableElements("#otherFields *");
        enableElements("#ReedonLoom");
        enableElements("#PickonLoom");
        enableElements("#PileTar");
        enableElements("#GroundTar");
        enableElements("#CutPanna");
        enableElements("#Kinari");
        enableElements("#NaliTar");
        enableElements("#Misc");
        enableElements("#CuttingBorder");
        enableElements("#PlainCam");
        enableElements("#PiletoPile");
        enableElements("#PileCam");
        enableElements("#Fancy");
        enableElements("#Frame");
        document.getElementById("itemSpecificationForm").action = action;
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
            removeOtherDiv($("#btnRemove"));   
        }
        attribute = 0;
    }
    
    function resetForm() {
            if (formMode === 'Retrieve' || formMode === 'Edit') {
                return true;
            } else {
                emptyAllFields("#ItemCode");
                emptyAllFields("#Length");
                $('#LengthUnit option').filter(function() {
                    return ($(this).val() === "0");
                }).prop('selected', true);
                emptyAllFields("#Width");
                $('#WidthUnit option').filter(function() {
                    return ($(this).val() === "0");
                }).prop('selected', true);
                emptyAllFields("#FinishWeight");
                $('#FinishWeightUnit option').filter(function() {
                    return ($(this).val() === "0");
                }).prop('selected', true);
                emptyAllFields("#GreightWeight");
                emptyAllFields("#FinishGSM");
                $('#Loop option').filter(function() {
                    return ($(this).val() === "0");
                }).prop('selected', true);
                emptyAllFields("#blend");
                emptyAllFields("#attribute");
                emptyAllFields("#StitchingType");
                emptyAllFields("#Pile");
                $('#PileCount option').filter(function() {
                    return ($(this).val() === "0");
                }).prop('selected', true);
                emptyAllFields("#PileUnit");
//                $('#PileUnit option').filter(function() {
//                    return ($(this).val() === "0");
//                }).prop('selected', true);
                emptyAllFields("#Weft");
                $('#WeftCount option').filter(function() {
                    return ($(this).val() === "0");
                }).prop('selected', true);
                emptyAllFields("#WeftUnit");
//                $('#WeftUnit option').filter(function() {
//                    return ($(this).val() === "0");
//                }).prop('selected', true);
                emptyAllFields("#Ground");
                $('#GroundCount option').filter(function() {
                    return ($(this).val() === "0");
                }).prop('selected', true);
                emptyAllFields("#GroundUnit");
//                $('#GroundUnit option').filter(function() {
//                    return ($(this).val() === "0");
//                }).prop('selected', true);
                emptyAllFields("#FancyPercent");
                $('#FancyCount option').filter(function() {
                    return ($(this).val() === "0");
                }).prop('selected', true);
                emptyAllFields("#FancyUnit");
//                $('#FancyUnit option').filter(function() {
//                    return ($(this).val() === "0");
//                }).prop('selected', true);
                emptyAllFields("#ProcessLoss");
                emptyAllFields("#WeavingLoss");
                emptyAllFields("#Other");
                removeOtherFields();
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
                emptyAllFields("#Frame");
            }
	}

    function doToggle(id) {
        $(id).toggle();
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
        var isValidate = 1;
        var itemCode = $('#ItemCode').val();
        var length = $('#Length').val();
        var lengthUnit = $('#LengthUnit').val();
        var width = $('#Width').val();
        var widthUnit = $("#WidthUnit").val();
        var finishWeight = $("#FinishWeight").val();
        var finishWeightUnit = $("#FinishWeightUnit").val();
        var greighWeight = $('#GreightWeight').val();
        var loop = $('#Loop').val();
                
        if ((itemCode === "") 
                || (length === "") 
                || (lengthUnit === 0) 
                || (width === "") 
                || (widthUnit === 0) 
                || (finishWeight === "") 
                || (finishWeightUnit === 0) 
                || (greighWeight === "") 
                || (loop === 0))
            isValidate = 0;
        else 
            isValidate = 1;
      
        
        if (itemCode === "") {
            $(".error-ItemCode").show();
        } else {
            $(".error-ItemCode").hide();
        }

        if (length === "") {
            $(".error-Length").show();
        } else {
            $(".error-Length").hide();
        }
        
        if (lengthUnit === "0") {
            $(".error-lengthunit").show();
        } else {
            $(".error-lengthunit").hide();
        }
        
        if (width === "") {
            $(".error-Width").show();
        } else {
            $(".error-Width").hide();
        }
        
        if (widthUnit === "0") {
            $(".error-WidthUnit").show();
        } else {
            $(".error-WidthUnit").hide();
        }
        
        if (finishWeight === "") {
            $(".error-FinishWeight").show();
        } else {
            $(".error-FinishWeight").hide();
        }
        
        if (finishWeightUnit === "0") {
            $(".error-finsihweightunit").show();
        } else {
            $(".error-finsihweightunit").hide();
        }
        
        if (greighWeight === "") {
            $(".error-GreightWeight").show();
        } else {
            $(".error-GreightWeight").hide();
        }
        
        if (loop === "0") {
            $(".error-loop").show();
        } else {
            $(".error-loop").hide();
        }        
        
        if (isValidate === 0) {
            return false;
        } else {
            return true;
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
    
    function SetLoopCountName() {
        var countName = ($("#Loop option:selected").text());
        if (countName !== "Select Count") {
            $("#LoopCount").val(countName);
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
    
    $("#Length").focusout(function() {
        SetFinishGSM();
    });
    
    $("#LengthUnit").focusout(function() {
        SetFinishGSM();
    });
    
    $("#Width").focusout(function() {
        SetFinishGSM();
    });

    $("#WidthUnit").focusout(function() {
        SetFinishGSM();
    });  
    
    $("#FinishWeight").focusout(function() {
        SetFinishGSM();
        SetGreighWeight();
    });
    
    $("#FinishWeightUnit").focusout(function() {
        SetFinishGSM();
        $("#GreightWeightUnit").val($("#FinishWeightUnit").val());
    });
    
    $("#ProcessLoss").focusout(function() {
        SetGreighWeight();
    });
    
    function CalculateFininshGSM() {
        var finishLength = $("#Length").val();
        var finishLengthUnit = $("#LengthUnit").val();
        var finishWidth = $("#Width").val();
        var finishWidthUnit = $("#WidthUnit").val();
        var finishWeight = $("#FinishWeight").val();
        var finishWeightUnit = $("#FinishWeightUnit").val();
        var area = 0;
        var areaMetreSquares = 0;
        var gmsPerPiece = 0;
        var finishGSM = 0.00;
               
        if (finishLength > 0 && finishLengthUnit !== "0" && finishWidth > 0 && finishWidthUnit !== "0" 
                && finishWeight > 0 && finishWeightUnit !== "0") {
            if (finishLengthUnit === finishWidthUnit) {
                if (finishLengthUnit === "cm" && finishWidthUnit === "cm") {
                    area = finishLength * finishWidth;                    
                }
                else if (finishLengthUnit === "inch" && finishWidthUnit === "inch"){
                    finishLength = finishLength * 2.54;
                    finishWidth = finishWidth * 2.54;
                    area = finishLength * finishWidth;                    
                }
                areaMetreSquares = area / 10000;
                
                if (finishWeightUnit === "lbs/doz") {
                    gmsPerPiece = ((finishWeight / 2.2046) * 1000) / 12;                    
                }
                else if (finishWeightUnit === "onz/doz") {
                    gmsPerPiece = (finishWeight * 28.3495) / 12;
                }
                else if (finishWeightUnit === "gm/pc") {
                    gmsPerPiece = finishWeight;
                }
                
                finishGSM = round(gmsPerPiece / areaMetreSquares, 2);
            }
            else {
                alert("Finish Length and Finish Width must have same units.")
            }
        } 
        return finishGSM;
    }
    
    function SetFinishGSM() {
        var finishGSM = 0.00;
        finishGSM = CalculateFininshGSM();
        $("#FinishGSM").val(finishGSM, 2);
    }
    
    function CalculateGreighWeight() {
        var greighWeight = 0.000;  
        var finishWeight = $("#FinishWeight").val();
        var processLoss = $("#ProcessLoss").val();
        
        if (finishWeight <= 0 || processLoss <= 0)
            return 0.00;
        
        greighWeight = parseFloat(finishWeight) + parseFloat((finishWeight * processLoss) / 100);
        greighWeight = round(greighWeight, 2);
        return greighWeight;
    }
    
    function SetGreighWeight() {
        var greighWeight = 0.00;
        greighWeight = CalculateGreighWeight();
        $("#GreightWeight").val(greighWeight, 2);
    }
    
    function round(num, places) {    
        return Number(Math.round(num + "e+" + places)  + "e-" + places);
    }

	
</script>