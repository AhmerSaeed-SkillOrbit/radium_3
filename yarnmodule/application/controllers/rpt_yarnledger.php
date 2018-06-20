<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class rpt_yarnledger extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library("Pdf");
        $this->load->model('m_ReportServices');
        $this->load->model('m_partycreation');;
        $this->load->model('m_countcreation');
    }

    public function index() {
        
        $dataArray = array();
        $partyModel = new M_partycreation();
        $countModel = new M_countcreation();
        $dataArray['millCombo'] = $partyModel->getPartiesByType(1);
        $dataArray['countCombo'] = $countModel->getAllCount();
        $this->load->view('header');
        $this->load->view('v_rpt_yarnledger', $dataArray);
        $this->load->view('footer');
    }

    public function reportYarnLedger() {

        $html = array();
        $dateone = $_POST['FromDate'];
        $datetwo = $_POST['ToDate'];
        $millID = $_POST['idMill'];
        $countID = $_POST['idCount'];
        $fromdate = date("Y-m-d", strtotime($dateone));
        $todate = date("Y-m-d", strtotime($datetwo));
        $balanceBags = 0.00;
        $balanceLbs = 0.00;
        $totalReceiveBags = 0.00;
        $totalReceiveLbs = 0.00;
        $totalIssueBags = 0.00;
        $totalIssueLbs = 0.00;

        $reportYarnLedger = new m_ReportServices();
        $openingBalanceResult = $reportYarnLedger->yarnLedgerOpeningBalance($fromdate, $millID, $countID);
        $openingBalanceBags = $openingBalanceResult[0]['OpeningBalanceBags'];
        $openingBalanceLbs = $openingBalanceResult[0]['OpeningBalanceLbs'];
        $allServices = $reportYarnLedger->yarnLedger($fromdate, $todate, $millID, $countID);
        $balanceBags = $openingBalanceBags;
        $balanceLbs = $openingBalanceLbs;
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
        $pdf->SetHeaderData("", "", 'PREMIER TOWELS', 'Yarn Ledger');
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
        $html = '<span><h4>Report From: ' . $dateone . '<label>&nbsp;&nbsp;</label>To:   ' . $datetwo . '</span></h4><br>'
                .'<span><label><b>Count: </b>'. $allServices[0]['Count']. '</label></span><br>'
                .'<span><label><b>Mill: </b>'. $allServices[0]['Mill']. '</label></span><br><br>'
        .'<div>
        <table border="1">
            <thead>
                <tr>
                    <td width="10%" height="25px" align="center"><b>Date</b></td> 
                    <td width="10%" height="25px" align="center"><b>GRN#/DC#/YR#</b></td> 
                    <td width="20%" height="25px" align="center"><b>Broker/Party</b></td>  
                    <td width="07%" height="25px" align="center"><b>Receive (Bags)</b></td>  
                    <td width="10%" height="25px" align="center"><b>Receive (Lbs)</b></td>  
                    <td width="07%" height="25px" align="center"><b>Issue (Bags)</b></td>  
                    <td width="10%" height="25px" align="center"><b>Issue (Lbs)</b></td>  
                    <td width="10%" height="25px" align="center"><b>Balance (Bags)</b></td>
                    <td width="10%" height="25px" align="center"><b>Balance (Lbs)</b></td>  
                </tr>
            </thead>
            <tbody>';
        
        $html .= '                
                <tr>
                    <td width = "10%" align="center"></td>
                    <td width = "10%" align="center"></td>
                    <td width = "20%" align="center">Opening Balance</td>
                    <td width = "07%" align="center"></td>
                    <td width = "10%" align="center"></td>
                    <td width = "07%" align="center"></td>
                    <td width = "10%" align="right"></td>
                    <td width = "10%" align="right">' . number_format($openingBalanceBags, $decimalPoints) . '</td>
                    <td width = "10%" align="right">' . number_format($openingBalanceLbs, $decimalPoints) . '</td></tr>';

        foreach ($allServices as $allData) {
            $balanceBags = $balanceBags + $allData['Receive(Bags)'] - $allData['Issue(Bags)'];
            $balanceLbs = $balanceLbs + $allData['Receive(Lbs)'] - $allData['Issue(Lbs)'];
            $totalReceiveBags = $totalReceiveBags + $allData['Receive(Bags)'];
            $totalReceiveLbs = $totalReceiveLbs + $allData['Receive(Lbs)'];
            $totalIssueBags = $totalIssueBags + $allData['Issue(Bags)'];
            $totalIssueLbs = $totalIssueLbs + $allData['Issue(Lbs)'];
            
            $html .= '                
                <tr>
                    <td width = "10%" align="center">' . date("d-m-Y", strtotime($allData['Date'])) . '</td>
                    <td width = "10%" align="center">' . $allData['GRN#/DC#/YR#'] . '</td>
                    <td width = "20%" align="center">' . $allData['Party'] . '</td>
                    <td width = "07%" align="right">' . number_format($allData['Receive(Bags)'], $decimalPoints) . '</td>
                    <td width = "10%" align="right">' . number_format($allData['Receive(Lbs)'], $decimalPoints) . '</td>
                    <td width = "07%" align="right">' . number_format($allData['Issue(Bags)'], $decimalPoints) . '</td>
                    <td width = "10%" align="right">' . number_format($allData['Issue(Lbs)'], $decimalPoints) . '</td>
                    <td width = "10%" align="right">' . number_format($balanceBags, $decimalPoints) . '</td>
                    <td width = "10%" align="right">' . number_format($balanceLbs, $decimalPoints) . '</td></tr>';            
        }
        
        $html .= '                
                <tr>
                    <td width = "10%" align="center"><b>Total</b></td>
                    <td width = "10%" align="center"></td>
                    <td width = "20%" align="center"></td>
                    <td width = "07%" align="right">' . number_format($totalReceiveBags, $decimalPoints) . '</td>
                    <td width = "10%" align="right">' . number_format($totalReceiveLbs, $decimalPoints) . '</td>
                    <td width = "07%" align="right">' . number_format($totalIssueBags, $decimalPoints) . '</td>
                    <td width = "10%" align="right">' . number_format($totalIssueLbs, $decimalPoints) . '</td>
                    <td width = "10%" align="right"></td>
                    <td width = "10%" align="right"></td></tr>';

        $html .= '</tbody>
        </table><br>';

        $pdf->writeHTML($html, true, false, true, false, '');

        //Close and output PDF document
        //This method has several options, check the source code documentation for more information.
        $pdf->Output('Yarn Ledger ' .$dateone.' to '.$datetwo.'.pdf', 'I');
    }

}
