
<!-- add new calendar event modal -->
<!-- jQuery 2.0.2 -->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="<?= base_url(); ?>assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<!-- InputMask -->
<script src="<?= base_url(); ?>assets/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?= base_url(); ?>assets/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?= base_url(); ?>assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- fullCalendar -->
<script src="<?= base_url(); ?>assets/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>assets/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>assets/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url(); ?>assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?= base_url(); ?>assets/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url(); ?>assets/js/AdminLTE/dashboard.js" type="text/javascript"></script>     
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>assets/js/AdminLTE/demo.js" type="text/javascript"></script>
<!-- CK Editor -->
<script src="<?= base_url(); ?>assets/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<!-- Chosen -->
<script src="<?= base_url(); ?>assets/js/chosen.jquery.js"></script>
<!-- BootBox Js -->
<script src="<?= base_url(); ?>assets/js/bootbox.min.js"></script>
<!-- Adding BootStrap Validator -->
<script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrapValidator.js"></script>
<!-- Adding BootStrap Validator  ADDOn-->
<script type="text/javascript" src="<?= base_url(); ?>assets/js/validator/numeric.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/validator/regexp.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap-select.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.maskedinput.js"></script>
<!--<script type="text/javascript" src="<?= base_url(); ?>assets/js/numeral.min.js"></script>-->
<script type="text/javascript" src="<?= base_url(); ?>assets/js/fractionNotationN.js"></script>
<!--<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.price_format.2.0.min.js"></script>-->
<script type="text/javascript">
    var charArray = "";

    $(document.body).on('click', ".error-partytype", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-brokertype", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-milltype", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-counttype", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-cartagetype", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-purposetype", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-usagetype", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-error-partytypepop", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-emailpopup", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-pcdate", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-chalandate", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-deliverychalandate", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-rate", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-noofbags", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-totalbags", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-totalweight", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-netweight", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-packing", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-bags", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-qty", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-warehousecombo", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-totalweight", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-contractamount", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-shortweight", function() {
        $(this).hide();
    });
    $(document.body).on('click', ".error-YarnReturndate", function() {
        $(this).hide();
    });
    // ::::::::  For Weaving Module ::::::: //

//  for item specification form

    $(document.body).on('click', ".error-lengthunit", function () {
        $(this).hide();
    });
    $(document.body).on('click', ".error-widthunit", function () {
        $(this).hide();
    });
    $(document.body).on('click', ".error-finsihweightunit", function () {
        $(this).hide();
    });
    $(document.body).on('click', ".error-loop", function () {
        $(this).hide();
    });
    $(document.body).on('click', ".error-pilecount", function () {
        $(this).hide();
    });
    $(document.body).on('click', ".error-piletype", function () {
        $(this).hide();
    });
    $(document.body).on('click', ".error-weftcount", function () {
        $(this).hide();
    });
    $(document.body).on('click', ".error-wefttype", function () {
        $(this).hide();
    });
    $(document.body).on('click', ".error-groundcount", function () {
        $(this).hide();
    });
    $(document.body).on('click', ".error-groundtype", function () {
        $(this).hide();
    });
    $(document.body).on('click', ".error-fancycount", function () {
        $(this).hide();
    });
    $(document.body).on('click', ".error-fancytype", function () {
        $(this).hide();
    });

//   for weaving form

    $(document.body).on('click', ".error-partyname", function () {
        $(this).hide();
    });
    $(document.body).on('click', ".error-itemcode", function () {
        $(this).hide();
    });
    $(document.body).on('click', ".error-wcdate", function () {
        $(this).hide();
    });
    // ::::::::  End For Weaving Module ::::::: //

//    $("#Rate").mask('*.999', {placeholder: '0'});//03121234567 (Mobile)
//    $("#Rate").inputmask({'mask':["9{0,5}.9{0,2}", "999"]});
//    $(document).ready(function() {
//       $(".SelectQA").chosen();
    //Money Euro
//        $("[data-mask]").inputmask();
//        //Date range picker
//        $('#reservation').daterangepicker();
//        //Date range picker with time picker
//        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
//        //Date range as a button
//        $('#daterange-btn').daterangepicker(
//                {
//                    ranges: {
//                        'Today': [moment(), moment()],
//                        'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
//                        'Last 7 Days': [moment().subtract('days', 6), moment()],
//                        'Last 30 Days': [moment().subtract('days', 29), moment()],
//                        'This Month': [moment().startOf('month'), moment().endOf('month')],
//                        'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
//                    },
//                    startDate: moment().subtract('days', 29),
//                    endDate: moment()
//                },
//        function(start, end) {
//            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
//        }
//        );
    //iCheck for checkbox and radio inputs
//        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
//            checkboxClass: 'icheckbox_minimal',
//            radioClass: 'iradio_minimal'
//        });
//        //Red color scheme for iCheck
//        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
//            checkboxClass: 'icheckbox_minimal-red',
//            radioClass: 'iradio_minimal-red'
//        });
//        //Flat red color scheme for iCheck
//        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
//            checkboxClass: 'icheckbox_flat-red',
//            radioClass: 'iradio_flat-red'
//        });
//        //Colorpicker
//        $(".my-colorpicker1").colorpicker();
//        //color picker with addon
//        $(".my-colorpicker2").colorpicker();
//        //Timepicker
//        $(".timepicker").timepicker({
//            showInputs: false
//        });
//       
    /* Dynamically CKEditor Adding Method */
    var CauseEditor = 0;
    function AddCause() {

        var id = 'cck' + CauseEditor++;
        $('#CauseDiv').append("<br><div class='form-group'><label for='exampleInputEmail1'>Cause Type</label>" +
                "<input id='CauseType' name='CauseType' type='text' class='form-control' id='exampleInputEmail1' placeholder='Cause Type'>" +
                "</div><br><label for=''>Cause</label><div><div class='pull-right box-tools'>" +
                "<button class='btn btn-info btn-sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa-minus'></i></button>" +
                "<button class='btn btn-info btn-sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa-times'></i></button>" +
                "</div>" +
                "<div class='box-body pad'>" +
                "<textarea id='" + id + "' name='CauseEditor' rows='10' cols='80'></textarea></div></div>");
        CKEDITOR.replace(id);
    }

    var generalIE = 0;
    var subIE = 0;
    function AddIndication() {

        var generalid = 'gick' + generalIE++;
        var subid = 'sick' + subIE++;
        $('#IndicationDiv').append("<br><label for=''>Indication</label>" +
                "<div class='pull-right box-tools'>" +
                "<button class='btn btn - info btn - sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa - minus'></i></button>" +
                "<button class='btn btn - info btn - sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa - times'></i></button></div>" +
                "<div class='box-body pad'>" +
                "<textarea id='" + generalid + "' name='GenIndication' rows='10' cols='80'>Type General Indications</textarea>" +
                "</div>" +
                "<label for=''>Sub Indication</label>" +
                "<div class='pull - right box - tools'>" +
                "<button class='btn btn - info btn - sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa - minus'></i></button>" +
                "<button class='btn btn - info btn - sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa - times'></i></button>" +
                "</div>" +
                "<div class='box-body pad'>" +
                "<textarea id='" + subid + "' name='SubIndication' rows='10' cols='80'>Type Sub Indications</textarea>" +
                "</div>"
                );
        CKEDITOR.replace(generalid);
        CKEDITOR.replace(subid);
    }

    var generalTE = 0;
    var subTE = 0;
    function AddTest() {

        var generalid = 'gtck' + generalTE++;
        var subid = 'stck' + subTE++;
        $('#TestDiv').append("<br><label for=''>Test</label>" +
                "<div class='pull-right box-tools'>" +
                "<button class='btn btn - info btn - sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa - minus'></i></button>" +
                "<button class='btn btn - info btn - sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa - times'></i></button></div>" +
                "<div class='box-body pad'>" +
                "<textarea id='" + generalid + "' name='GenTest' rows='10' cols='80'>Type General Test</textarea>" +
                "</div>" +
                "<label for=''>Sub Indication</label>" +
                "<div class='pull - right box - tools'>" +
                "<button class='btn btn - info btn - sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa - minus'></i></button>" +
                "<button class='btn btn - info btn - sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa - times'></i></button>" +
                "</div>" +
                "<div class='box-body pad'>" +
                "<textarea id='" + subid + "' name='SubTest' rows='10' cols='80'>Type Sub Test</textarea>" +
                "</div>"
                );
        CKEDITOR.replace(generalid);
        CKEDITOR.replace(subid);
    }

    var generalXE = 0;
    var subXE = 0;
    function AddXRay() {
        var generalid = 'gxck' + generalXE++;
        var subid = 'sxck' + subXE++;
        $('#XRAYDiv').append("<br><label for=''>X-Ray</label>" +
                "<div class='pull-right box-tools'>" +
                "<button class='btn btn - info btn - sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa - minus'></i></button>" +
                "<button class='btn btn - info btn - sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa - times'></i></button></div>" +
                "<div class='box-body pad'>" +
                "<textarea id='" + generalid + "' name='GenXRay' rows='10' cols='80'>Type General X-Ray</textarea>" +
                "</div>" +
                "<label for=''>Sub Indication</label>" +
                "<div class='pull - right box - tools'>" +
                "<button class='btn btn - info btn - sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa - minus'></i></button>" +
                "<button class='btn btn - info btn - sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa - times'></i></button>" +
                "</div>" +
                "<div class='box-body pad'>" +
                "<textarea id='" + subid + "' name='SubXRay' rows='10' cols='80'>Type Sub X-Ray</textarea>" +
                "</div>"
                );
        CKEDITOR.replace(generalid);
        CKEDITOR.replace(subid);
    }

    var generalTTE = 0;
    var subTTE = 0;
    function AddTreatment() {

        var generalid = 'gttck' + generalTTE++;
        var subid = 'sttck' + subTTE++;
        $('#TreatmentDiv').append("<br><label for=''>Treatment</label>" +
                "<div class='pull-right box-tools'>" +
                "<button class='btn btn - info btn - sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa - minus'></i></button>" +
                "<button class='btn btn - info btn - sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa - times'></i></button></div>" +
                "<div class='box-body pad'>" +
                "<textarea id='" + generalid + "' name='GenTreatment' rows='10' cols='80'>Type General Treatment</textarea>" +
                "</div>" +
                "<label for=''>Sub Indication</label>" +
                "<div class='pull - right box - tools'>" +
                "<button class='btn btn - info btn - sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa - minus'></i></button>" +
                "<button class='btn btn - info btn - sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa - times'></i></button>" +
                "</div>" +
                "<div class='box-body pad'>" +
                "<textarea id='" + subid + "' name='SubTreatment' rows='10' cols='80'>Type Sub Treatment</textarea>" +
                "</div>"
                );
        CKEDITOR.replace(generalid);
        CKEDITOR.replace(subid);
    }

    var QE = 0;
    var AE = 0;
    function AddQuestionAnswer() {

        var generalid = 'qck' + QE++;
        var subid = 'ack' + AE++;
//        $('#QALabel').val('1');
        $('#QADiv').show();
        $('#QADiv').append("<br><div><label for=''>Select Character From</label>" +
                "<div class='form-group'>" +
                "<select name='QFrom[]' class='QAFrom'>" +
                "<option>Select Character</option></select>" +
                "</div>" +
                "<label for=''>To</label>" +
                "<div class='form-group'>" +
                "<select name='QTo[]' class='QATo'>" +
                "<option>Select Character</option></select>" +
                "</div></div>" +
                "<label for=''>Question</label>" +
                "<div class='pull-right box-tools'>" +
                "<button class='btn btn-info btn-sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa-minus'></i></button>" +
                "<button class='btn btn-info btn-sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa-times'></i></button>" +
                "</div>" +
                "<div class='box-body pad'>" +
                "<textarea id='" + generalid + "' name='QEditor[]' rows='10' cols='80'>Type Question</textarea>" +
                "</div>" +
                "<label for=''>Answer</label>" +
                "<div class='pull-right box-tools'>" +
                "<button class='btn btn-info btn-sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa-minus'></i></button>" +
                "<button class='btn btn-info btn-sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa-times'></i></button>" +
                "</div>" +
                "<div class='box-body pad'>" +
                "<textarea id='" + subid + "' name='AEditor[]' rows='10' cols='80'>Type Answer</textarea>" +
                "</div>");

        CKEDITOR.replace(generalid);
        CKEDITOR.replace(subid);

        $(".QAFrom").empty();
        $(".QATo").empty();
        $(".QAFrom").append($("<option id=''>Select Character</option>"));
        $(".QATo").append($("<option id=''>Select Character</option>"));
        console.log('charArray');
        console.log(charArray);

        for (x in charArray) {
            $(".QAFrom").append($("<option></option>").val(charArray[x]['idCharacter']).html(charArray[x]['CharacterName']));
            $(".QATo").append($("<option></option>").val(charArray[x]['idCharacter']).html(charArray[x]['CharacterName']));
        }
    }


    var charCount = 1;
    function AddCharacter() {
        charCount = charCount + 1;
        $('#CharacterDiv').append("<br><br><label for=''>Character (" + charCount + ")</label><br>" +
                "<input id='CharacterEditor" + charCount + "' name='CharacterEditor' type='text' class='form-control' placeholder='Type Characters Name'>");
    }
    // Instantiating All CKEditors    
    CKEDITOR.replace('DiseaseDef');
    CKEDITOR.replace('IntroEditor');
    CKEDITOR.replace('SummaryEditor');
    CKEDITOR.replace('CauseEditor');
    CKEDITOR.replace('GenInvestigaion');
    CKEDITOR.replace('GenTreatment');

    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();


    function callMe() {
        $(".QAFrom").empty();
        $(".QATo").empty();
        var formData = $('#adddiseseform').serialize();
        var data = $("#CharacterDiv input[name=CharacterEditor]").map(function(a) {
            return this.value;
        }).get().join(',');
        formData += "&Characters=" + data;
        $.ajax({
            url: "<?= base_url() ?>index.php/adddisease/addCharacterData",
            type: "POST",
            data: formData,
            success: function(data) {
                if (data !== "null")
                {
                    var parsedData = JSON.parse(data);
                    charArray = parsedData;
                    if (parsedData.length > 0) {
                        $('#QALabel').show();
                        $(".QAFrom").append($("<option id=''>Select Character</option>"));
                        $(".QATo").append($("<option id=''>Select Character</option>"));

                        $.each(parsedData, function(index, name) {
                            $(".QAFrom").append($("<option id=''></option>").val(name['idCharacter']).html(name['CharacterName']));
                            $(".QATo").append($("<option id=''></option>").val(name['idCharacter']).html(name['CharacterName']));
                        });
                    } else {
                        $(".QAFrom").append($("<option id=''></option>").html('None'));
                        $(".QATo").append($("<option id=''></option>").html('None'));
                    }
                }
                $('#QALabel').append("<span style='margin-left:20px;'>Click to Add Questions</span>");
            },
            error: function(data) {
                console.log('The Error');
                console.log(data);
            }
        });
    }

</script>
</body>
</html>
