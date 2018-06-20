<html>
    <head>
        <meta charset="utf-8">
        <title>Weaving Contract Report</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link href="<?php echo base_url(); ?>assets/receipt/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/receipt/css/style.css" rel="stylesheet">=

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
                </div>
            </div>
        </div>
        <div id="printArea">
            <div class="container">
                <div class="col-xs-12">
                    <div class="row clearfix">
                        <table width="100%" border="0" align="">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td width="6%" align="">
                                        <div style="width"><span><b>PREMIER TOWELS</b></span><b><span style="margin-left:200px;">CONTRACT</b></span></div>
                                    </td>
                                    <td width="4%" align="">
                                        <div><span></span></div>
                                    </td>
                                    <td width="4%" align="">
                                        <div><span><b>Tel:36962491-2</b></span></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="4%" align="">
                                        <div style="width"><span><b>PLOT# 17 6A NORTH KARACHI</b></span></div>
                                    </td>
                                    <td width="4%" align=""></td>
                                    <td width="4%" align=""></td>
                                </tr>
                                <tr>
                                    <td width="20%" align="">
                                        <br><div style="width"><span>CONTRACT#</span><span style="margin-left:15px;"><b><u><?php echo $weavingContractDetails[0]['WeavingContractNo']; ?></u></b></span></div>
                                    </td>
                                    <td width="2%" align="">
                                        <div style="width"><span></span></div>
                                    </td>
                                    <td width="6%" align="">
                                        <br><div style="width"><span>DATED:</span><span><b><u><?php echo $weavingContractDetails[0]['ContractDate']; ?></u></b></span></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%" align="">
                                        <div style="width"><span>PARTY NAME</span><span style="margin-left:5px;"><b><u><?php echo $weavingContractDetails[0]['CompanyName']; ?></u></b></span></div>
                                    </td>
                                    <td width="2%" align="">
                                        <div style="width"><span></span></div>
                                    </td>
                                    <td width="6%" align="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br/>
                <div class="row clearfix">
                    <table border="1" width="100%">
                        <thead></thead>
                        <tbody>
                            <tr>
                                <td width="2%">
                                    <div style=""><span>Item As Per Sample</span></div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""><span><b><?php echo $itemInfo[0]['ItemDesc']; ?></b></span></div>         
                                </td>
                                <td width="4%" align="">
                                    <div style=""><span><b>ITEM CODE</b></span><br><br><span><b><?php echo $itemInfo[0]['ItemCode']; ?></b></span></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="2%" >
                                    <div style=""><span>Finish Weight</span></div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""><span><?php echo $itemInfo[0]['FinishWeight'] . ' ' . $itemInfo[0]['FinishWeightUnit']; ?></span></div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""><span>(Billing Weight)</span></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="2%" >
                                    <div style=""><span>Grey Weight</span></div>
                                </td>
                                <td width="4%" align="">
                                    <div><span><?php echo $itemInfo[0]['GreighWeight'] . ' ' . $itemInfo[0]['GreighWeightUnit']; ?></span></div>
                                </td>
                                <td width="4%" align="">
                                    <div><span>(Net in Grey)</span></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table width="100%" border="0">
                        <tbody>
                            <tr>
                                <td width="">
                                    <div>
                                        <table border="" width="100%">
                                            <tr>
                                                <th colspan="3" style="text-align:center">CONSTRUCTION</th>
                                            </tr>
                                            <tbody>
                                                <tr>
                                                    <td width=""><div>Reed on Loom</div></td>
                                                    <td width=""><div><?php echo $itemInfo[0]['ReedOnLoom']; ?></div></td>
                                                    <td width=""></td>
                                                </tr>
                                                <tr>
                                                    <td width=""><div>Pick on Loom</div></td>
                                                    <td width=""><div><?php echo $itemInfo[0]['PickOnLoom']; ?></div></td>
                                                    <td width="">ON LOOM</td>
                                                </tr>
                                                <tr>
                                                    <td width=""><div>Pile Tar</div></td>
                                                    <td width=""><div><?php echo $itemInfo[0]['PileTar']; ?></div></td>
                                                    <td width=""><div>304 x 5</div></td>
                                                </tr>
                                                <tr>
                                                    <td width=""><div>Ground Tar</div></td>
                                                    <td width=""><div><?php echo $itemInfo[0]['GroundTar']; ?></div></td>
                                                    <td width=""><div></div></td>
                                                </tr>
                                                <tr>
                                                    <td width=""><div>Cut Panna</div></td>
                                                    <td width=""><div><?php echo $itemInfo[0]['CutPanna']; ?></div></td>
                                                    <td width=""><div></div></td>
                                                </tr>
                                                <tr>
                                                    <td width=""><div>Kinari</div></td>
                                                    <td width=""><div><?php echo $itemInfo[0]['Kinari']; ?></div></td>
                                                    <td width=""><div></div></td>
                                                </tr>
                                                <tr>
                                                    <td width=""><div>Nali Tar</div></td>
                                                    <td width=""><div><?php echo $itemInfo[0]['NaliTar']; ?></div></td>
                                                    <td width=""><div></div></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td width="">
                                    <div>
                                        <table border="" width="100%">
                                            <tr>
                                                <th colspan="4" style="text-align:center">SIZE ON TABLE</th>
                                            </tr>
                                            <tbody>
                                                <tr>
                                                    <td width=""><div><span>Cutting Border</span></div></td>
                                                    <td width=""><div><span><?php echo $itemInfo[0]['CuttingBorder']; ?></span></div></td>
                                                    <td width=""><div><span>Plain cam</span></div></td>
                                                    <td width=""><div><span><?php echo $itemInfo[0]['PlainCam']; ?></span></div></td>
                                                </tr>
                                                <tr>
                                                    <td width=""><div><span>Pile to Pile</span></div></td>
                                                    <td width=""><div><span><?php echo $itemInfo[0]['PiletoPile']; ?></span></div></td>
                                                    <td width=""><div><span>Pile cam</span></div></td>
                                                    <td width=""><div><span><?php echo $itemInfo[0]['PileCam']; ?></span></div></td>
                                                </tr>
                                                <tr>
                                                    <td width=""><div><span>Pile cam</span></div></td>
                                                    <td width=""><div><span><?php echo $itemInfo[0]['PileCam']; ?></span></div></td>
                                                    <td width=""><div><span>Plain cam</span></div></td>
                                                    <td width=""><div><span><?php echo $itemInfo[0]['PlainCam']; ?></span></div></td>
                                                </tr>
                                                <tr>
                                                    <td width=""><div><span>Fancy</span></div></td>
                                                    <td width=""><div><span><?php echo $itemInfo[0]['Fancy']; ?></span></div></td>
                                                    <td width=""><div><span>Misc</span></div></td>
                                                    <td width=""><div><span><?php echo $itemInfo[0]['Misc']; ?></span></div></td>
                                                </tr>
                                                <tr>
                                                    <td width=""><div><span>Frame</span></div></td>
                                                    <td width=""><div><span><?php echo $itemInfo[0]['Frame']; ?></span></div></td>
                                                    <td width=""><div><span></span></div></td>
                                                    <td width=""><div><span></span></div></td>

                                                </tr>
                                                <tr>
                                                    <td width=""><div><span>(B) Allowd in Grey 3% only</span></div></td>
                                                    <td width="1"><div><span></span></div></td>
                                                    <td width="" style="text-align:right"><div><span>Wastage 3%</span></div></td>
                                                    <td width="1"><div><span></span></div></td>
                                                </tr>
                                                <tr>
                                                    <td width="1" style="text-align:center"><div style="width:250px;">Weight Variations 3% ( +/- ) Only</div></td>
                                                    <td width="1"><div></div></td>
                                                    <td width="1"><div><span></span></div></td>
                                                    <td width="1"><div><span></span></div></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table border="" width="100%">
                        <th colspan="4" style="text-align:center">YARN REQUIRED</th>
                        <tbody>
                            <tr>
                                <td width="4%">
                                    <div style=""><span>Order Quantity</span></div>
                                </td>
                                <td>
                                    <div style=""><span><?php echo $weavingContractDetails[0]['OrderQunatity']; ?></span></div>
                                </td>
                                <td>
                                    <div style=""><span></span></div>
                                </td>
                                <td>
                                    <div style=""><span></span></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="2%" >
                                    <div style=""><span>Finish Weight</span></div>
                                </td>
                                <td width="8%">
                                    <div style=""><?php echo $itemInfo[0]['FinishWeight'] . ' ' . $itemInfo[0]['FinishWeightUnit']; ?></div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""><span>Grey Weight</span></div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""><?php echo $itemInfo[0]['GreighWeight'] . ' ' . $itemInfo[0]['GreighWeightUnit']; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="4%">
                                    <div style=""><span>Pile</span></div>
                                </td>
                                <td width="8%" align="">
                                    <div style=""><span><?php echo $itemInfo[0]['PilePercent'] . '% ' . $itemInfo[0]['PileCount'] . ' ' . $itemInfo[0]['PileUnit']; ?></span></div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""><span></span></div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""><span></span></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="4%">
                                    <div style=""><span>Weft</span></div>
                                </td>
                                <td width="8%" align="">
                                    <div style=""><span><?php echo $itemInfo[0]['WeftPercent'] . '% ' . $itemInfo[0]['WeftCount'] . ' ' . $itemInfo[0]['WeftUnit']; ?></span></div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""><span></span></div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""><span></span></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="4%">
                                    <div style=""><span>Ground</span></div>
                                </td>
                                <td width="8%" align="">
                                    <div style="">
                                        <span><?php echo $itemInfo[0]['GroundPercent'] . '% ' . $itemInfo[0]['GroundCount'] . ' ' . $itemInfo[0]['GroundUnit']; ?></span>
                                    </div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""><span></span></div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""><span></span></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="4%">
                                    <div style=""><span>Fancy</span></div>
                                </td>
                                <td width="8%" align="">
                                    <div style="">
                                        <span><?php echo $itemInfo[0]['FancyPercent'] . '% ' . $itemInfo[0]['FancyCount'] . ' ' . $itemInfo[0]['FancyUnit']; ?></span>
                                    </div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""></div>
                                </td>
                                <td width="4%" align=""><div style=""><span><?php echo $weavingContractDetails[0]['TotalBags']; ?></span></div></td>
                            </tr>
                            <tr>
                                <td width="4%">
                                    <div style=""><span>Others</span></div>
                                </td>
                                <td width="8%" align="">
                                    <div style="">
                                        <span><?php echo $itemInfo[0]['Other']; ?></span>
                                    </div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""><span>TOTAL BAGS</span></div>
                                </td>
                                <td width="4%" align="">
                                    <div style=""><span></span></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br> 
                    <br> 
                    <table border="0" width="100%">
                        <tbody>
                            <tr>
                                <td width="1%" colspan="3">
                                    <div><img src="<?= base_url(); ?>assets/img/urdu_1.jpg" alt="Note" height="125" width="600" style="margin-left: 250px;margin-right: 250px;float: right" ></div>
                                </td>
                            </tr>   
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <table width="60%" border="0">
                        <tbody>
                            <tr>
                                <td width="">
                                    <div>
                                        <table border="0" width="60%">
                                            <tbody>
                                                <tr>
                                                    <td>    
                                                        <table border="1" width="">
                                                            <caption style="background-color: grey">YARN CALCULATION WORKING</caption>
                                                            <tbody>
                                                                <tr>
                                                                    <td width="4%">
                                                                        <div style=""><span>1. YARN FINISH WEIGHT + 10 %</span></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="4%">
                                                                        <div style=""><span>2. Payment will be made after <b>30</b> days of billing</span></div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <br>
                                                        <table border="1" width="">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="4%">
                                                                        <div style=""><span>REMARKS</span></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="4%" height="20px">
                                                                        <div style=""><span></span></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="4%" height="20px">
                                                                        <div style=""><span></span></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="4%" height="20px">
                                                                        <div style=""><span></span></div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <br>
                    <div style="width: 100%">
                        <div style="float: left;">
                            <span><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span>
                            <br><span>For PREMIER TOWEL</span>
                        </div>
                        <div style="float: right;margin-right:100px;">
                            <span><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span>
                            <br><span>for Vendor</span>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>	


