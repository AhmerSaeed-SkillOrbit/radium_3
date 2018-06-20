<html>

    <head>
        <!--<link rel=Stylesheet href='<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css'>-->
        <meta charset="utf-8">
        <title>Purchase Contract</title>
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
                popupWin.document.write('<html><title>::Print Preview::</title><link rel=Stylesheet href=<?php echo base_url(); ?>assets/receipt/css/bootstrap.min.css><link rel=stylesheet href=<?php echo base_url(); ?>assets/css/stylesheet.css></head><body>');
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
    <body class="yarnoperation">
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
                                <h3 class="text-center"><b>YARN DELIVERY CHALLAN</b></h3>
                                <h4 class="text-center"><b>PREMIER TOWELS</b></h4>
                                <h5 class="text-center"><b>Plot # 17, Sector 6-A, North Karachi-75850</b></h5>
                                <h5 class="text-center"><b>Ph: 36962491-2-3</b></h5>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-3 col-xs-offset-1">
                                <span><b>Dated:</b></span>
                                <span style=""><u><?php echo date("d-M-Y", strtotime($data[0]['ChallanDate'])) ?></u></span>
                            </div>
                            <div class="pull-left col-xs-3 col-xs-offset-0">
                                <span><b>Gate Pass #:</b></span>
                                <span style=""><u><?php echo 'GP-' . $data[0]['GatePassNo'] ?></u></span>
                            </div>
                            <div class="pull-left col-xs-2 col-xs-offset-0" style="width: 225px">
                                <span><b>Challan #:</b></span>
                                <span style="">
                                    <u><?php echo 'DC-' . $data[0]['DeliveryChallanNo']; ?></u>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-3 col-xs-offset-1">
                                <span><b>Time:</b></span>
                                <span style=""><u><?php echo date("h:i A") ?></u></span>
                            </div>
                            <div class="pull-left col-xs-3 col-xs-offset-0">
                                <span><b>Purpose:</b></span>
                                <span style=""><u><?php echo $data[0]['PurposeName'] ?></u></span>
                            </div>
                            <div class="pull-left col-xs-3 col-xs-offset-0">
                                <span><b>Deliver To:</b></span>
<!--                                <span style="">
                                    <u><?php echo $data[0]['CompanyName']; ?></u>
                                </span>-->
                                <span>
                                    <u><?php
                                        if ($data[0]['CompanyName'] === "") {
                                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                        } else {
                                            ?></u>
                                        <u><?php
                                            echo $data[0]['CompanyName'];
                                        }
                                        ?></u>
                                </span>
                            </div>
                        </div><br><br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-12 col-sm-6 col-md-9 col-xs-offset-1">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Count</th>
                                            <th class="text-center">Mill</th>
                                            <th class="text-center">Brand</th>
                                            <th class="text-center">Usage</th>
                                            <th style="" class="text-center">Warehouse</th>
                                            <th class="text-center">Bags</th>
                                            <th class="text-center">Total Quantity(lbs)</th>                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $Counter = 1;
                                        $totalBags = 0.00;
                                        $totalQty = 0.00;
                                        foreach ($data as $key => $allData) {
                                            $totalBags +=$allData['Bags'];
                                            $totalQty +=$allData['Quantity'];
                                            ?>
                                            <tr id="">
                                                <td class="tbl-name"><?= $Counter++ ?></td>
                                                <td class="tbl-name"><?= $allData['CountName'] ?></td>
                                                <td class="tbl-name"><?= $allData['Mill'] ?></td>
                                                <td class="tbl-name"><?= $allData['Brand'] ?></td>
                                                <td class="tbl-name"><?= $allData['UsageName'] ?></td>
                                                <td class="tbl-name"><?= $allData['WarehouseName'] ?></td>    
                                                <td class="tbl-name"><?= number_format($allData['Bags'], 2) ?></td>                                                
                                                <td class="tbl-name"><?= number_format($allData['Quantity'], 2)?></td>                                                                                                                                          
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                    <tfoot>                                           
                                    <td class="tbl-name"></td>
                                    <td class="tbl-name"></td>
                                    <td class="tbl-name"></td>
                                    <td class="tbl-name"></td>
                                    <td class="tbl-name"></td>
                                    <td class="tbl-name"><b>Total</b></td>
                                    <td class="tbl-name"><?php echo number_format($totalBags, 2); ?></td>
                                    <td class="tbl-name"><?php echo number_format($totalQty, 2); ?></td>
                                    </tfoot>
                                </table>
                            </div>
                        </div><br>
                        <div class="row clearfix">
                            <div class="col-xs-5 col-xs-offset-1" style="width: 400px;">
                                <span class="text-center">
                                    <b>Receive the above goods in perfect condition.</b>
                                </span>
                            </div>
                        </div><br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-3 col-xs-offset-1">
                                <span class="text-center">                                 
                                    <span><b>Vehicle #:</b></span>
                                    <span><u><?php echo $data[0]['VehicleNo']; ?></u></span><br>
                                    (Name and Signature)
                                </span>
                            </div>
                            <div class="col-xs-3 col-xs-offset-3" style="width: 200px;
                                 margin-top: 0px;
                                 ">
                                <span class="text-center">
                                    <b>_______________________</b><br><br>
                                    <!--<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature</b>-->
                                </span>
                                <span style="margin-left: 30px;
                                      ">
                                    <b>For Premier Towels</b>
                                </span>
                            </div>
                            <!--                            <div class="pull-right col-xs-2 col-xs-offset-3" style="margin-top: 25px;
                                            ">
                                                            <span class="text-center">
                                                                <b>__________________</b>
                                                                <br>
                                                                <b>For Premier Towels</b>
                                                            </span>
                                                        </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<head>-->
    <!--        <link rel=Stylesheet href='<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css'>
            <meta charset="utf-8">
            <title>Purchase Contract</title>
            <meta name="viewport" content="width = device-width, initial-scale = 1.0">
            <meta name="description" content="">
            <meta name="author" content="">-->

        <!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
        <!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
        <!--script src="js/less-1.3.3.min.js"></script-->
        <!--append â€˜#!watchâ€™ to the browser URL, then refresh the page. -->

        <!--        <link href="<?php echo base_url();
                                        ?>assets/receipt/css/bootstrap.css" rel="stylesheet">
                                                    <link href="<?php echo base_url(); ?>assets/receipt/css/style.css" rel="stylesheet">-->

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
<!--        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/receipt/img/favicon.png">-->

            <!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
            <!--<script type="text/javascript" src="js/bootstrap.min.js"></script>-->
            <!--<script type="text/javascript" src="js/scripts.js"></script>-->
        <script type="text/javascript">
            /*--This JavaScript method for Print command--*/
            function PrintGatePass() {
                var toPrint = document.getElementById('printAreaGatePass');
                var popupWin = window.open('', '_blank', 'width=948px,height=700px,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title></title><link rel=Stylesheet href=<?php echo base_url(); ?>assets/receipt/css/bootstrap.min.css><body onload="window.print()">');
                popupWin.document.write(toPrint.innerHTML);
                popupWin.document.write('</html>');
                popupWin.document.close();
            }
            /*--This JavaScript method for Print Preview command--*/
            function PreviewGatePass() {
                var toPrint = document.getElementById('printAreaGatePass');
                var popupWin = window.open('', '_blank', 'width=670px,height=300,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title>::Print Preview::</title><link rel=Stylesheet href=<?php echo base_url(); ?>assets/receipt/css/bootstrap.min.css><link rel=stylesheet href=<?php echo base_url(); ?>assets/css/stylesheet.css></head><body>');
                popupWin.document.write(toPrint.innerHTML);
                popupWin.document.write('</html>');
                popupWin.document.close();
            }
        </script>
<!--        <style>
            .border {
                border:1px solid black;
            }
            .bold {
                font-weight: bold;
            }
            .underline {
                text-decoration: underline;
            }
        </style>-->
        <!--</head>-->
        <br/><br/><br/>
        <br/><br/><br/>
        <br/><br/>
        <div class="container" style="width: 600px;">
            <div class="row-fluid">
                <div class="span12 text-center">
                    <input type="button" value="Print" class="btn-primary" onclick="PrintGatePass()"/>
                    <input type="button" value="Print Preview" class="btn-info" onclick="PreviewGatePass()"/>
                </div>
            </div>
        </div>
        <br/>
        <div id="printAreaGatePass">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6 col-md-3 col-xs-offset-1" style="width:675px;">
                                <h3 class="text-center"><b>GATE PASS</b></h3>
                                <h4 class="text-center"><b>PREMIER TOWELS</b></h4>
                                <h5 class="text-center"><b>Plot # 17, Sector 6-A, North Karachi-75850</b></h5>
                                <h5 class="text-center"><b>Ph: 36921841, 36921842, Fax: 9221-6924445</b></h5>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-3 col-xs-offset-1">
                                <span><b>Dated :</b></span>
                                <span style=""><u><?php echo date("d-M-Y", strtotime($data[0]['ChallanDate'])) ?></u></span>
                            </div>
                            <div class="pull-left col-xs-3 col-xs-offset-1">
                                <span><b>Gate Pass #:</b></span>
                                <span style=""><u><?php echo 'GP-' . $data[0]['GatePassNo'] ?></u></span>
                            </div>
                            <div class="pull-left col-xs-3 col-xs-offset-1">
                                <span><b>Challan #:</b></span>
                                <span style="">
                                    <u><?php echo 'DC-' . $data[0]['DeliveryChallanNo']; ?></u>
                                </span>
                            </div>
                        </div><br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-3 col-xs-offset-1">
                                <span><b>Time:</b></span>
                                <span style=""><u><?php echo date("h:i A") ?></u></span>
                            </div>
                            <div class="pull-left col-xs-3 col-xs-offset-1">
                                <span><b>Deliver To:</b></span>
<!--                                <span style="">
                                    <u><?php echo $data[0]['CompanyName']; ?></u>
                                </span>-->
                                <span>
                                    <u><?php
                                        if ($data[0]['CompanyName'] === "") {
                                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
                                        } else {
                                            ?></u>
                                        <u><?php
                                            echo $data[0]['CompanyName'];
                                        }
                                        ?></u>
                                </span>
                            </div>
                        </div><br><br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-12 col-sm-6 col-md-9 col-xs-offset-1">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Count</th>
                                            <th class="text-center">
                                                Mill
                                            </th>
                                            <th class="text-center">Brand</th>
                                            <th class="text-center">Bags</th>
                                            <th class="text-center">Quantity(lbs)</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $Counter = 1;
                                        $totalBags = 0;
                                        $totalQty = 0;
                                        foreach ($data as $key => $allData) {
                                            $totalBags +=$allData['Bags'];
                                            $totalQty +=$allData['Quantity'];
                                            ?>
                                            <tr id="">
                                                <td class="tbl-name"><?= $Counter++ ?></td>
                                                <td class="tbl-name"><?= $allData['CountName'] ?></td>
                                                <td class="tbl-name"><?= $allData['Mill'] ?></td>
                                                <td class="tbl-name"><?= $allData['Brand'] ?></td>
                                                <td class="tbl-name"><?= $allData['Bags'] ?></td>                                                
                                                <td class="tbl-name"><?= number_format($allData['Quantity']); ?></td>                                                 
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                    <tfoot>                                           
                                    <td class="tbl-name"></td>
                                    <td class="tbl-name"></td>
                                    <td class="tbl-name"></td>
                                    <td class="tbl-name"><b>Total</b></td>
                                    <td class="tbl-name"><?php echo $totalBags; ?></td>
                                    <td class="tbl-name"><?php echo number_format($totalQty); ?></td>
                                    </tfoot>
                                </table>
                            </div>
                        </div><br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-3 col-xs-offset-1" style="width:300px;">
                                <span class="text-center">                                 
                                    <span><b>Vehicle# :</b></span>
                                    <span><u><?php echo $data[0]['VehicleNo']; ?></u></span><br>
                                </span>
                                <span class="text-center">
                                    <b>Received Sign</b>
                                    <b>__________________</b>
                                </span>
                            </div>
                            <div class="pull-left col-xs-3 col-xs-offset-2" style="margin-top: 25px;">
                                <span class="text-center">
                                    <b>__________________</b><br><br>
                                    <!--<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature</b>-->
                                </span>
                                <span style="margin-left: 38px;">
                                    <b>Signature</b>
                                </span>
                            </div>
                            <!--                            <div class="pull-right col-xs-3 col-xs-offset-0">
                                                            <span class="text-center">
                                                                <b>__________________</b>
                                                                <br>
                                                                <b>Signature</b>
                                                            </span>
                                                        </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>	


