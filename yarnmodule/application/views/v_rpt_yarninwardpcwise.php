<?php
include 'include/leftmenu.php';
?>
<aside class="right-side">
    <section class="content">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body"> 
                    <form id="addcomplaintmodes" name="addcomplaintmodes" onSubmit="" method="post"
                          action="<?= base_url() ?>index.php/rpt_yarninwardpcwise/reportYarnInwardPCWise">
                        <fieldset>
                            <legend>Yarn Inward PC Wise</legend>
                            <div class="" style="margin-left: 20px;">
                                <div id="" class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-top: 20px;">
                                    <label for="">Purchase Contract</label>
                                    <select id="idPC" name="idPC" class="form-control" style="width: 300px;">
                                        <option value="Select PC">Select Purchase Contract</option>                                       
                                        <?php
                                        foreach ($pcCombo as $key) {
                                            ?>
                                            <option value="<?php echo $key['PurchaseContractNo'] ?>"><?php echo "PC-" . $key['PurchaseContractNo'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="pull-left col-xs-10 col-sm-5 col-md-5 form-group has-error form-error error-partytype" style="width: 170px;margin-left: 30px;">
                                        <label class="control-label" for="inputError">Select any Option!</label>
                                    </div>
                                </div>
                                <div class="pull-left col-xs-12 col-sm-6 col-md-6" style="margin-left: 0px;margin-top: 25px;"><br>
                                    <button id="generateReport" type="submit" class="btn btn-primary" style="width: 80px;float: left;">Generate</button>
                                </div>
                            </div>                    
                            <div id="divloader" style="margin-left: 370px;margin-top: 50px;opacity:0.5">
                                <img src="<?= base_url(); ?>assets/img/ajax-loader.gif" alt="">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section>
</aside>
<script>
    $(document).ready(function(e) {
        $('#divloader').hide();
        $(".form-error").hide();
        $("#FromDate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        $("#ToDate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
    });

    function shwLoader() {
        var dateOne = $('#filterbydateone').val();
        var dateTwo = $('#filterbydatetwo').val();
        if (dateOne !== "" && dateTwo !== "") {
            $('#divloader').show();
        }
    }
</script>


