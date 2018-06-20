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
                                <h3 class="text-center"><b>GOODS RECEIVE NOTE</b></h3>
                                <h4 class="text-center"><b>PREMIER TOWELS</b></h4>
                                <h5 class="text-center"><b>Plot # 17, Sector 6-A, North Karachi-75850</b></h5>
                                <h5 class="text-center"><b>Ph: 36962491-2-3</b></h5>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-3 col-xs-offset-0">
                                <span><b>Dated:</b></span>
                                   <span>
                                    <u><?php
                                        if ($data[0]['ChallanDate'] === "") {
                                            echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                        } else {
                                            ?></u> 
                                        <u>
                                            <?php
                                            echo date("d-M-Y", strtotime($data[0]['ChallanDate']));
                                        }
                                        ?>
                                    </u>
                                </span>                                
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-3 col-xs-offset-0">
                                <span><b>Challan #:</b></span>
                                <span style=""><u><?php echo $data[0]['ChallanNo']; ?></u></span>
                            </div>
                            <div class="pull-left col-xs-3 col-xs-offset-3" style="margin-top:0px;">
                                <span><b>GRN #: </b></span>
                                <span style="">
                                    <u><?php echo 'GRN-' . $data[0]['GRNNo']; ?></u>
                                </span>
                            </div>
                        </div><br><br>
                        <div class="row clearfix" style="">
                            <div class="col-xs-2 col-xs-offset-0">
                                <table id="example1" class="table table-bordered" style="">
                                    <thead>
                                        <tr>
                                            <th style="" class="text-center">PC#</th>
                                            <th style="" class="text-center">Count</th>
                                            <th style="" class="text-center">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                Mill 
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </th>
                                            <th style="" class="text-center">Brand</th>
                                            <th style="" class="text-center">Seller Contract #</th>
                                            <th style="" class="text-center">Contract Date</th>
                                            <th style="" class="text-center">Bags</th>
                                            <th style="" class="text-center">Packing (lbs)</th>
                                            <th style="" class="text-center">Total Weight (lbs)</th>
                                            <th style="" class="text-center">Shortage Weight (lbs)</th>
                                            <th style="" class="text-center">Net Weight (lbs)</th>
                                            <th style="" class="text-center">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                Warehouse
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data as $key => $allData) {
                                            ?>
                                            <tr id="">
                                                <td class="tbl-name"><?= 'PC-' . $allData['PurchaseContractNo'] ?></td>
                                                <td class="tbl-name"><?= $allData['CountName'] ?></td>
                                                <td class="tbl-name"><p><?= $allData['Mill'] ?></p></td>
                                                <td class="tbl-name"><?= $allData['Brand'] ?></td>
                                                <td class="tbl-name"><?= $allData['SellerContractNo'] ?></td>
                                                <td class="tbl-name"><?= date("d-M-Y", strtotime($allData['ContractDate'])) ?></td>                                                
                                                <td class="tbl-name"><?= $allData['Bags'] ?></td>                                                
                                                <td class="tbl-name"><?= number_format($allData['Packing'], 2) ?></td>                                                
                                                <td class="tbl-name"><?= number_format($allData['TotalWeight'], 2) ?></td>                                                
                                                <td class="tbl-name"><?= number_format($allData['ShortWeight'], 2) ?></td>                                                
                                                <td class="tbl-name"><?= number_format($allData['NetWeight'], 2) ?></td>                                                
                                                <td class="tbl-name"><?= $allData['WarehouseName'] ?></td>                                                
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><br><br>
                        <div class="row clearfix">
                            <div class="pull-left col-xs-5 col-xs-offset-0">
                                <span class="text-center">
                                    <b>Receiving (Name and Signature)</b>
                                </span>
                            </div>
                            <div class="pull-right col-xs-3 col-xs-offset-1" style="margin-top: 25px;">
                                <span class="">
                                    <b>__________________</b><br><br>
                                    <!--<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature</b>-->
                                </span>
                                <span style="margin-left: 38px;">
                                    <b>Signature</b>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>	


