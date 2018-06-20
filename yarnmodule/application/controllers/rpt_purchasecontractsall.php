<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class rpt_purchasecontractsall extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library("Pdf");
        $this->load->model('m_ReportServices');
        //$this->load->model('s_repairorder');
    }

    public function index() {

        $this->load->view('header');
        $this->load->view('v_rpt_purchasecontractsall');
        $this->load->view('footer');
    }

    public function reportPurchaseContractsAll() {

        $html = array();

        $dateone = $_POST['FromDate'];
        $datetwo = $_POST['ToDate'];
        $fromdate = date("Y-m-d", strtotime($dateone));
        $todate = date("Y-m-d", strtotime($datetwo));

        $reportPCAll = new m_ReportServices();
        $allServices = $reportPCAll->purchaseContractsAll($fromdate, $todate);
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('All Services Reports');
        $pdf->SetTitle('All Services Reports');
        $pdf->SetSubject('All Services Reports');
        $pdf->SetKeywords('Services');

        //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->SetHeaderData("", "", 'PREMIER TOWELS', 'Purchase Contract All');
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
                    <td width="08%" height="25px" align="center"><b>Date</b></td> 
                    <td width="07%" height="25px" align="center"><b>Seller Contract #</b></td>
                    <td width="05%" height="25px" align="center"><b>PC #</b></td>
                    <td width="13%" height="25px" align="center"><b>Broker</b></td>
                    <td width="07%" height="25px" align="center"><b>Count</b></td>
                    <td width="13%" height="25px" align="center"><b>Mill</b></td>  
                    <td width="10%" height="25px" align="center"><b>Brand</b></td>  
                    <td width="06%" height="25px" align="center"><b>Rate</b></td>  
                    <td width="06%" height="25px" align="center"><b>Bags</b></td>  
                    <td width="08%" height="25px" align="center"><b>Amount</b></td>  
                    <td width="06%" height="25px" align="center"><b>Payment Terms</b></td>
                    <td width="07%" height="25px" align="center"><b>Cartage</b></td>
                    <td width="06%" height="25px" align="center"><b>Status</b></td>
                </tr>
            </thead>
            <tbody>';

        foreach ($allServices as $allData) {
            $status = "";
            if ($allData['Status'] == 1) {
                $status = "Closed" ;
            }
            else {
                $status = "Opened" ;
            }
            $html .= '                
                <tr><td width = "08%" align="center">' . date("d-m-Y", strtotime($allData['Date'])) . '</td>
                    <td width = "07%" align="center">' . $allData['SellerContractNo'] . '</td>
                    <td width = "05%" align="center">' . $allData['PC#'] . '</td>
                    <td width = "13%" align="center">' . $allData['Broker'] . '</td>
                    <td width = "07%" align="center">' . $allData['Count'] . '</td>
                    <td width = "13%" align="center">' . $allData['Mill'] . '</td>
                    <td width = "10%" align="center">' . $allData['Brand'] . '</td>                    
                    <td width = "06%" align="right">' . $allData['Rate'] . '<label>&nbsp;</label></td>
                    <td width = "06%" align="right">' . $allData['Bags'] . '<label>&nbsp;</label></td>
                    <td width = "08%" align="right">' . $allData['Amount'] . '<label>&nbsp;</label></td>
                    <td width = "06%" align="center">' . $allData['PaymentTerms'] . '</td> 
                    <td width = "07%" align="center">' . $allData['Cartage'] . '</td> 
                    <td width = "06%" align="center">' . $status . '</td>                  
                </tr>';    
        }

        $html .= '</tbody>
        </table><br>';
        
        $pdf->writeHTML($html, true, false, false, false, '');

        //Close and output PDF document
        //This method has several options, check the source code documentation for more information.
        $pdf->Output('Purchase Contracts All '.$dateone.' to '.$datetwo.'.pdf', 'I');
    }

}
