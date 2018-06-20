<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class rpt_yarnreceivingoutwardall extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library("Pdf");
        $this->load->model('m_ReportServices');
        //$this->load->model('s_repairorder');
    }

    public function index() {
        
        $this->load->view('header');
        $this->load->view('v_rpt_yarnreceivingoutwardall');
        $this->load->view('footer');
    }

    public function reportYarnReceivingOutwardall() {

        $html = array();

        $dateone = $_POST['FromDate'];
        $datetwo = $_POST['ToDate'];
        $fromdate = date("Y-m-d", strtotime($dateone));
        $todate = date("Y-m-d", strtotime($datetwo));
        $decimalPoints = 2;
        $decimalSymbol = '.';
        $thousandSep = ',';

        $reportYarnOutwardAll = new m_ReportServices();
        $allServices = $reportYarnOutwardAll->yarnDeliveryDateWise($fromdate, $todate);
        
        $yarnOutwardSummary = $reportYarnOutwardAll->yarnDeliveryDatewiseWeavingSummary($fromdate, $todate);
        
        $yarnDoublingSummary = $reportYarnOutwardAll->yarnDeliveryDatewiseDoublingSummary($fromdate, $todate);
        
        $yarnGodownSummary = $reportYarnOutwardAll->yarnDeliveryDatewiseGodownSummary($fromdate, $todate);
        
        $sumBags = 0.00;
        $sumLbs = 0.00;
        

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('All Services Reports');
        $pdf->SetTitle('All Services Reports');
        $pdf->SetSubject('All Services Reports');
        $pdf->SetKeywords('Services');

        //set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->SetHeaderData("", "", 'PREMIER TOWELS', 'Yarn Delivery (Outward) All');
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        //set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        //set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        //set some language-dependent strings (optional)
        if (file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        //set default font subsetting mode
        $pdf->setFontSubsetting(true);

        //Set font
        //dejavusans is a UTF-8 Unicode font, if you only need to
        //print standard ASCII chars, you can use core fonts like
        //helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 8, '', true);

        //Add a page
        //This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        //set text shadow effect
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        //Set some content to print
        $html = '<span><h4>Report From:    ' . $dateone . '<label>&nbsp;&nbsp;</label>To:   ' . $datetwo . '</span></h4><br><br>'
        .'<div>
        <table border="1">
            <thead>
                <tr>
                    <td width="07%" height="25px" align="center"><b>Date</b></td> 
                    <td width="04%" height="25px" align="center"><b>GP #</b></td> 
                    <td width="04%" height="25px" align="center"><b>DC #</b></td> 
                    <td width="15%" height="25px" align="center"><b>Ware house</b></td>
                    <td width="15%" height="25px" align="center"><b>Vendor</b></td>
                    <td width="07%" height="25px" align="center"><b>Purpose</b></td>
                    <td width="05%" height="25px" align="center"><b>Vehilce No</b></td>
                    <td width="05%" height="25px" align="center"><b>Count</b></td>  
                    <td width="15%" height="25px" align="center"><b>Mill</b></td>  
                    <td width="10%" height="25px" align="center"><b>Brand</b></td>  
                    <td width="05%" height="25px" align="center"><b>Bags</b></td>  
                    <td width="07%" height="25px" align="center"><b>Lbs</b></td>  
                </tr>
            </thead>
            <tbody>';

        $SNO = 1;
        foreach ($allServices as $allData) {
            $html .= '                
                <tr><td width = "07%" align="center">' . date("d-m-Y", strtotime($allData['Date'])) . '</td>
                    <td width = "04%" align="center">' . $allData['GPNo'] . '</td>
                    <td width = "04%" align="center">' . $allData['DCNo'] . '</td>
                    <td width = "15%" align="center">' . $allData['Warehouse'] . '</td>
                    <td width = "15%" align="center">' . $allData['vendor'] . '</td>
                    <td width = "07%" align="center">' . $allData['Purpose'] . '</td>
                    <td width = "05%" align="center">' . $allData['Vehicle No'] . '</td>
                    <td width = "05%" align="center">' . $allData['Count'] . '</td>
                    <td width = "15%" align="center">' . $allData['Mill'] . '<label>&nbsp;</label></td>
                    <td width = "10%" align="center">' . $allData['Brand'] . '</td>
                    <td width = "05%" align="right">' . number_format($allData['Bags'], $decimalPoints, $decimalSymbol, $thousandSep) . '<label>&nbsp;</label></td>
                    <td width = "07%" align="right">' . number_format($allData['Lbs'], $decimalPoints, $decimalSymbol, $thousandSep) . '<label>&nbsp;</label></td></tr>';
        }

        $html .= '</tbody>
        </table><br>';
        
        $html .= '<span><h4>Summary</h4><br><br>'
        .'<div>
        <table border="1">
            <thead>
                <tr>
                    <td width="07%" height="25px" align="center"><b>Weaving</b></td>  
                    <td width="05%" height="25px" align="center"><b>Bags</b></td>  
                    <td width="10%" height="25px" align="center"><b>Lbs</b></td> 
                </tr>
            </thead>
            <tbody>';

        if (count($yarnOutwardSummary) > 0) {
            foreach ($yarnOutwardSummary as $summaryData) {
                $sumBags = $sumBags + floatval($summaryData['Bags']);
                $sumLbs = $sumLbs + floatval($summaryData['Lbs']);
                $html .= '                
                    <tr>
                        <td width = "07%" align="center">' . $summaryData['Weaving'] . '</td>    
                        <td width = "05%" align="right">' . number_format($summaryData['Bags'], $decimalPoints, $decimalSymbol, $thousandSep) . '</td>
                        <td width = "10%" align="right">' . number_format($summaryData['Lbs'], $decimalPoints, $decimalSymbol, $thousandSep) . '</td>
                    </tr>';
            }
            $html .= '                
                    <tr>
                        <td width = "07%" align="center">Total</td>    
                        <td width = "05%" align="right">' . number_format($sumBags, $decimalPoints, $decimalSymbol, $thousandSep) . '</td>
                        <td width = "10%" align="right">' . number_format($sumLbs, $decimalPoints, $decimalSymbol, $thousandSep) . '</td>
                    </tr>';
        }
        else {
            $html .= '                
                    <tr>
                        <td width = "07%" align="center"></td>    
                        <td width = "05%" align="right"></td>
                        <td width = "10%" align="right"></td>
                    </tr>';
        }
        
        $html .= '</tbody>
        </table><br>';
        
        $html .= '<div>
        <table border="1">
            <thead>
                <tr>
                    <td width="07%" height="25px" align="center"><b>Doubling</b></td>  
                    <td width="05%" height="25px" align="center"><b>Bags</b></td>  
                    <td width="10%" height="25px" align="center"><b>Lbs</b></td> 
                </tr>
            </thead>
            <tbody>';
        
        $sumBags = 0.00;
        $sumLbs = 0.00;

        if (count($yarnDoublingSummary) > 0) {
            foreach ($yarnDoublingSummary as $doublingData) {
                $sumBags = $sumBags + floatval($doublingData['Bags']);
                $sumLbs = $sumLbs + floatval($doublingData['Lbs']);
                $html .= '                
                    <tr>
                        <td width = "07%" align="center">' . $doublingData['Doubling'] . '</td>    
                        <td width = "05%" align="right">' . number_format($doublingData['Bags'], $decimalPoints, $decimalSymbol, $thousandSep) . '</td>
                        <td width = "10%" align="right">' . number_format($doublingData['Lbs'], $decimalPoints, $decimalSymbol, $thousandSep) . '</td>
                    </tr>';
            }
            $html .= '                
                    <tr>
                        <td width = "07%" align="center">Total</td>    
                        <td width = "05%" align="right">' . number_format($sumBags, $decimalPoints, $decimalSymbol, $thousandSep) . '</td>
                        <td width = "10%" align="right">' . number_format($sumLbs, $decimalPoints, $decimalSymbol, $thousandSep) . '</td>
                    </tr>';

        }
        else {
            $html .= '                
                    <tr>
                        <td width = "07%" align="center"></td>    
                        <td width = "05%" align="right"></td>
                        <td width = "10%" align="right"></td>
                    </tr>';
        }
        
        $html .= '</tbody>
            </table><br>';
        
        $html .= '<div>
        <table border="1">
            <thead>
                <tr>
                    <td width="15%" height="25px" align="center"><b>Godown</b></td>  
                    <td width="05%" height="25px" align="center"><b>Bags</b></td>  
                    <td width="10%" height="25px" align="center"><b>Lbs</b></td>
                </tr>
            </thead>
            <tbody>';
        
        $sumBags = 0.00;
        $sumLbs = 0.00;

        if (count($yarnGodownSummary) > 0) {
            foreach ($yarnGodownSummary as $GodownData) {
                $sumBags = $sumBags + floatval($GodownData['Bags']);
                $sumLbs = $sumLbs + floatval($GodownData['Lbs']);
                $html .= '                
                    <tr>
                        <td width = "15%" align="center">' . $GodownData['Godown'] . '</td>    
                        <td width = "05%" align="right">' . number_format($GodownData['Bags'], $decimalPoints, $decimalSymbol, $thousandSep) . '</td>
                        <td width = "10%" align="right">' . number_format($GodownData['Lbs'], $decimalPoints, $decimalSymbol, $thousandSep) . '</td>
                    </tr>';
            }
            $html .= '                
                    <tr>
                        <td width = "15%" align="center">Total</td>    
                        <td width = "05%" align="right">' . number_format($sumBags, $decimalPoints, $decimalSymbol, $thousandSep) . '</td>
                        <td width = "10%" align="right">' . number_format($sumLbs, $decimalPoints, $decimalSymbol, $thousandSep) . '</td>
                    </tr>';
        }
        else {
            $html .= '                
                    <tr>
                        <td width = "15%" align="center"></td>    
                        <td width = "05%" align="right"></td>
                        <td width = "10%" align="right"></td>
                    </tr>';
        }
        
        $html .= '</tbody>
            </table><br>';
        
    
        $pdf->writeHTML($html, true, false, false, false, '');

        //Close and output PDF document
        //This method has several options, check the source code documentation for more information.
        $pdf->Output('Yarn Delivery (Outward) All '.$dateone.' to '.$datetwo.'.pdf', 'I');
    }

}
   