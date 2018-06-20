<html>

    <head>
        <!--<link rel=Stylesheet href='<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css'>-->
        <meta charset="utf-8">
        <title>PURCHASE CONTRACT</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
        <!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
        <!--script src="js/less-1.3.3.min.js"></script-->
        <!--append â€˜#!watchâ€™ to the browser URL, then refresh the page. -->

        <link href="<?php echo base_url(); ?>assets/receipt/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/receipt/css/style.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/receipt/img/favicon.png">

        <!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
        <!--<script type="text/javascript" src="js/bootstrap.min.js"></script>-->
        <!--<script type="text/javascript" src="js/scripts.js"></script>-->
        <script type="text/javascript">
            /*--This JavaScript method for Print command--*/
            function PrintDoc() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=948px,height=700px,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title></title><link rel=Stylesheet href=<?php echo base_url(); ?>assets/receipt/css/bootstrap.min.css><body onload="window.print()">');
                popupWin.document.write(toPrint.innerHTML);
                popupWin.document.write('</html>');
                popupWin.document.close();
            }
            /*--This JavaScript method for Print Preview command--*/
            function PrintPreview() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=670px,height=300,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title></title><link rel=Stylesheet href=<?php echo base_url(); ?>assets/receipt/css/bootstrap.min.css><link rel=stylesheet href=<?php echo base_url(); ?>assets/css/stylesheet.css></head><body>');
                popupWin.document.write(toPrint.innerHTML);
                popupWin.document.write('</html>');
                popupWin.document.close();
            }
        </script>
        <style>
            .border {
                border:1px solid black;
            }
            .bold {
                font-weight: bold;
            }
            .underline {
                text-decoration: underline;
            }
        </style>
    </head>

    <body>
        <br/>
        <div class="container" style="width: 600px;">
            <div class="row-fluid">
                <div class="span12 text-center">
                    <input type="button" value="Print" class="btn-primary" onclick="PrintDoc()"/>
                    <input type="button" value="Print Preview" class="btn-info" onclick="PrintPreview()"/>
                </div>
            </div>
        </div>
        <br/>
        <div id="printArea">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-xs-offset-3" style="width:460px;"> 
                                <h3 class="text-center"><b>Purchase Contract</b></h3>
                                <h4 class="text-center"><b>PREMIER TOWELS</b></h4>
                                <h5 class="text-center"><b>Plot # 17, Sector 6-A, North Karachi-75850</b></h5>
                                <h5 class="text-center"><b>Ph: 36962491-2-3</b></h5>
                            </div>
                        </div><br><br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-5 col-xs-offset-2">
                                <span><b>Dated:</b></span>
                                <span>
                                    <u><?php
                                        if ($data[0]['ContractDate'] === "") {
                                            echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                        } else {
                                            ?></u> 
                                        <u>
                                            <?php
                                            echo date("d-M-Y", strtotime($data[0]['ContractDate']));
                                        }
                                        ?>
                                    </u>
                                </span>

                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-5 col-xs-offset-2">
                                <span><b>Purchase Contract #:</b></span>
                                <span>
                                    <u><?php
                                        if ($data[0]['PurchaseContractNo'] === "") {
                                            echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                        } else {
                                            ?></u> 
                                        <u><?php
                                            echo 'PC-' . $data[0]['PurchaseContractNo'];
                                        }
                                        ?></u>
                                </span>
                            </div>
                            <div class="pull-left col-xs-5 col-xs-offset-7" style="margin-top: -19px;">
                                <span><b>Broker:</b></span>
                                <span>
                                    <u><?php
                                        if ($data[0]['Broker'] === "") {
                                            echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                        } else {
                                            ?></u>
                                        <u><?php
                                            echo $data[0]['Broker'];
                                        }
                                        ?></u>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-5 col-xs-offset-2">
                                <span><b>Count:</b></span>
                                <span>
                                    <u><?php
                                        if ($data[0]['CountName'] === "") {
                                            echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                        } else {
                                            ?></u>
                                        <u><?php
                                            echo $data[0]['CountName'];
                                        }
                                        ?></u>
                                </span>
                            </div>
                            <div class="pull-left col-xs-5 col-xs-offset-7" style="margin-top: -19px;">
                                <span><b>Mill:</b></span>
                                <span>
                                    <u><?php
                                        if ($data[0]['Mill'] === "") {
                                            echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                        } else {
                                            ?></u>
                                        <u><?php
                                            echo $data[0]['Mill'];
                                        }
                                        ?></u>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-5 col-xs-offset-2">
                                <span><b>Brand:</b></span>
                                <span>
                                    <u><?php
                                        if ($data[0]['Brand'] === "") {
                                            echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                        } else {
                                            ?></u>
                                        <u><?php
                                            echo $data[0]['Brand'];
                                        }
                                        ?></u>
                                </span>
                            </div>

                            <div class="pull-left col-xs-5 col-xs-offset-7" style="margin-top: -19px;">        
                                <span><b>Seller Contract#:</b></span>
                                <span>
                                    <u><?php
                                        if ($data[0]['SellerContractNo'] === "") {
                                            echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                        } else {
                                            ?></u>
                                        <u><?php
                                            echo $data[0]['SellerContractNo'];
                                        }
                                        ?></u>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-5 col-xs-offset-2">
                                <span><b>Rate/10 lbs: </b></span>
                                <span style="">
                                    <u>
                                        <?php echo number_format($data[0]['Rate'], 2); ?>
                                    </u>
                                </span>
                            </div>
                            <div class="pull-left col-xs-5 col-xs-offset-7" style="margin-top: -19px;">        
                                <span><b>No. of Bags:</b></span>
                                <span style="">
                                    <u>
                                        <?php echo $data[0]['Bags']; ?>
                                    </u>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-5 col-xs-offset-2">
                                <span><b>Total Weight(lbs):</b></span>
                                <span style="">
                                    <u>
                                        <?php echo number_format($data[0]['TotalWeight'], 2); ?>
                                    </u>
                                </span>
                            </div>
                            <div class="pull-left col-xs-5 col-xs-offset-7" style="margin-top: -19px;">        
                                <span><b>Contract Amount:</b></span>
                                <span style="">
                                    <u>
                                        <?php echo number_format($data[0]['ContractAmount'], 2); ?>
                                    </u>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-5 col-xs-offset-2">
                                <span><b>Payment Terms: </b></span>
                                <span>
                                    <u><?php
                                        if ($data[0]['PaymentTerms'] === "") {
                                            echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                        } else {
                                            ?></u>
                                        <u><?php
                                            echo $data[0]['PaymentTerms'];
                                        }
                                        ?></u>
                                </span>
                            </div>
                            <div class="pull-left col-xs-5 col-xs-offset-7" style="margin-top: -19px;">        
                                <span><b>Cartage:</b></span>
                                <span style="">
                                    <span style="">
                                        <u>
                                            <?php echo $data[0]['Cartage']; ?>
                                        </u>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-12 col-sm-6 col-md-3 col-xs-offset-2" style="width: 600px;">
                                <span><b>Remarks:</b></span>
                                <span>
                                    <u><?php
                                        if ($data[0]['Remarks'] === "") {
                                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
                                        } else {
                                            ?></u>
                                        <u><?php
                                            echo $data[0]['Remarks'];
                                        }
                                        ?></u>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>	


