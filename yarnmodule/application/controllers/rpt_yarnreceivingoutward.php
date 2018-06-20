<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class rpt_yarnreceivingoutward extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library("Pdf");
        $this->load->model('m_ReportServices');
        $this->load->model('m_partycreation');
        //$this->load->model('s_repairorder');
    }

    public function index() {
        
        $dataArray = array();
        $partyCreationModel = new M_partycreation();
        $dataArray['partyCombo'] = $partyCreationModel->getAllParty();
        $this->load->view('header');
        $this->load->view('v_rpt_yarnreceivingoutward', $dataArray);
        $this->load->view('footer');
    }

    public function reportYarnReceivingOutward() {

        $html = array();

        $dateone = $_POST['FromDate'];
        $datetwo = $_POST['ToDate'];
        $partyID = $_POST['idPartyType'];
        $fromdate = date("Y-m-d", strtotime($dateone));
        $todate = date("Y-m-d", strtotime($datetwo));

        $reportYarnOutward = new m_ReportServices();
        $allServices = $reportYarnOutward->yarnDeliveryDateAndPartyWise($fromdate, $todate, $partyID);
        
        $yarnOutwardSummary = $reportYarnOutward->yarnDeliveryDateAndPartyWiseSummary($fromdate, $todate, $partyID);
        
        $sumBags = 0.00;
        $sumLbs = 0.00;
        $decimalPoints = 2;
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('All Services Reports');
        $pdf->SetTitle('All Services Reports');
        $pdf->SetSubject('All Services Reports');
        $pdf->SetKeywords('Services');

        //set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->SetHeaderData("", "", 'PREMIER TOWELS', 'Yarn Delivery (Outward)');
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
        $html = '<span><h4>Report From:    ' . $dateone . '<label>&nbsp;&nbsp;</label>To:   ' . $datetwo . '</span></h4><br>'
                .'<span><label><b>Party Name: </b>'. $allServices[0]['party']. '</label></span><br><br>'
        .'<div>
        <table border="1">
            <thead>
                <tr>
                    <td width="08%" height="25px" align="center"><b>Date</b></td> 
                    <td width="07%" height="25px" align="center"><b>GP #</b></td> 
                    <td width="07%" height="25px" align="center"><b>DC #</b></td> 
                    <td width="13%" height="25px" align="center"><b>Ware house</b></td>
                    <td width="07%" height="25px" align="center"><b>Usage</b></td>
                    <td width="08%" height="25px" align="center"><b>Count</b></td>  
                    <td width="20%" height="25px" align="center"><b>Mill</b></td>  
                    <td width="13%" height="25px" align="center"><b>Brand</b></td>  
                    <td width="07%" height="25px" align="center"><b>Bags</b></td>  
                    <td width="10%" height="25px" align="center"><b>Lbs</b></td>  
                </tr>
            </thead>
            <tbody>';


        foreach ($allServices as $allData) {
            $html .= '                
                <tr><td width = "08%" align="center">' . date("d-m-Y", strtotime($allData['Date'])) . '</td>
                    <td width = "07%" align="center">' . $allData['GPNo'] . '</td>
                    <td width = "07%" align="center">' . $allData['DCNo'] . '</td>
                    <td width = "13%" align="center">' . $allData['Warehouse'] . '</td>
                    <td width = "07%" align="center">' . $allData['UsageName'] . '</td>
                    <td width = "08%" align="center">' . $allData['Count'] . '</td>
                    <td width = "20%" align="center">' . $allData['Mill'] . '<label>&nbsp;</label></td>
                    <td width = "13%" align="center">' . $allData['Brand'] . '</td>
                    <td width = "07%" align="right">' . number_format($allData['Bags'], $decimalPoints) . '<label>&nbsp;</label></td>
                    <td width = "10%" align="right">' . number_format($allData['Lbs'], $decimalPoints) . '<label>&nbsp;</label></td></tr>';
        }

        $html .= '</tbody>
        </table><br>';
        
        $html .= '<span><h4>Summary</h4></span><br><br>'
        .'<div>
        <table border="1">
            <thead>
                <tr>
                    <td width="07%" height="25px" align="center"><b>Usage</b></td> 
                    <td width="07%" height="25px" align="center"><b>Count</b></td>  
                    <td width="07%" height="25px" align="center"><b>Bags</b></td>
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
                        <td width = "07%" align="center">' . $summaryData['UsageName'] . '</td>   
                        <td width = "07%" align="center">' . $summaryData['CountName'] . '</td>       
                        <td width = "07%" align="right">' . number_format($summaryData['Bags'], $decimalPoints) . '<label>&nbsp;</label></td>
                        <td width = "10%" align="right">' . number_format($summaryData['Lbs'], $decimalPoints) . '<label>&nbsp;</label></td>
                    </tr>';
            }
            $html .= '<tr>
                        <td width = "14%" align="center">Total</td>    
                        <td width = "07%" align="right">' . number_format($sumBags, $decimalPoints) . '<label>&nbsp;</label></td>
                        <td width = "10%" align="right">' . number_format($sumLbs, $decimalPoints) . '<label>&nbsp;</label></td>
                    </tr>';
        }
        else {
            $html .= '                
                    <tr>
                        <td width = "07%" align="center"></td>    
                        <td width = "07%" align="center"></td>
                        <td width = "07%" align="center"></td>
                        <td width = "10%" align="right"></td>
                    </tr>';
        }
        
        $html .= '</tbody>
        </table><br>';
        
        
        $pdf->writeHTML($html, true, false, false, false, '');

        //Close and output PDF document
        //This method has several options, check the source code documentation for more information.
        $pdf->Output('Yarn Delivery (Outward) '.$dateone.' to '.$datetwo.'.pdf', 'I');
    }

}
