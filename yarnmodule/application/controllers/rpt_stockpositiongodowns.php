<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class rpt_stockpositiongodowns extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library("Pdf");
        $this->load->model('m_ReportServices');
        $this->load->model('m_warehouse');        
    }

    public function index() {
        $warehouseModel = new M_warehouse();
        $dataArray['warehouseCheckbox'] = $warehouseModel->getAllwarehouse();
        $this->load->view('header');
        $this->load->view('v_rpt_stockpositiongodowns', $dataArray);
        $this->load->view('footer');
    }

    public function reportStockPositionGodowns() {

        $html = array();
        $dateone = $_POST['FromDate'];
        $fromdate = date("Y-m-d", strtotime($dateone));
        $wareHouseIDs = $_POST['idWarehouse'];
        $sumBags = 0.00;
        $sumLbs = 0.00;
        $decimalPoints = 2;
        
        //var_dump($wareHouseIDs);
        
        $reportStockPosition = new m_ReportServices();
        $allServices = $reportStockPosition->yarnStockPositionGodowns($wareHouseIDs, $fromdate);
        //$summary = $reportStockPosition->yarnStockPositionSummaryGodowns($wareHouseIDs, $fromdate);
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('All Services Reports');
        $pdf->SetTitle('All Services Reports');
        $pdf->SetSubject('All Services Reports');
        $pdf->SetKeywords('Services');

        //set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->SetHeaderData("", "", 'PREMIER TOWELS', 'Stock Position Multiple Go-downs');
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
        //var_dump($allServices);
        $html = '<span><label><b>Warehouses:</b> ';
        
        for ($i = 0; $i < count($wareHouseIDs); $i++)
        {
            $html .= $wareHouseIDs[$i] . ", ";
        }
        $html = trim($html);
        $html = str_replace(",", "", $html);
        $html .= "</label></span><br><br>";
        $html .= '<span><label><b>As on:</b></label> ' . $dateone . '</span><br>
        <div>
        <table border="1">
            <thead>
                <tr>
                    <td width="10%" height="25px" align="center"><b>Count</b></td> 
                    <td width="15%" height="25px" align="center"><b>Mill</b></td>
                    <td width="10%" height="25px" align="center"><b>Brand</b></td>                     
                    <td width="07%" height="25px" align="center"><b>Bags</b></td>                    
                    <td width="10%" height="25px" align="center"><b>Lbs</b></td>  
                </tr>
            </thead>
            <tbody>';
        
        $counter = 0;
        $CountName = $allServices[0]['CountName'];
        $Bags = 0;
        $Lbs = 0;
        $summary = array();
        foreach ($allServices as $allData) {
            
            if($CountName <> $allData['CountName']) {
                $summary[$counter]['CountName'] = $CountName;
                $summary[$counter]['Bags'] = $Bags;
                $summary[$counter]['Lbs'] = $Lbs;
                $CountName = $allData['CountName'];
                $Bags = 0;
                $Lbs = 0;
                $counter += 1;
            }  
            
            $html .= '                
                <tr>
                    <td width = "10%" align="center">' . $allData['CountName'] . '</td>
                    <td width = "15%" align="center">' . $allData['Mill'] . '</td>
                    <td width = "10%" align="center">' . $allData['Brand'] . '</td>                    
                    <td width = "07%" align="right">' . number_format($allData['Bags'], $decimalPoints) . '</td>
                    <td width = "10%" align="right">' . number_format($allData['Lbs'], $decimalPoints) . '</td></tr>';
            
            if($CountName == $allData['CountName']) {
                $Bags += $allData['Bags'];
                $Lbs += $allData['Lbs'];
            }
            
            $summary[$counter]['CountName'] = $CountName;
            $summary[$counter]['Bags'] = $Bags;
            $summary[$counter]['Lbs'] = $Lbs;
        }

        $html .= '</tbody>
        </table></div><br>';
        
        $html .= '<span><h4>Summary</h4></span><br><br>'
        .'<div>
        <table border="1">
            <thead>
                <tr>
                    <td width="10%" height="25px" align="center"><b>Count</b></td>  
                    <td width="07%" height="25px" align="center"><b>Bags</b></td>  
                    <td width="10%" height="25px" align="center"><b>Lbs</b></td>  
                </tr>
            </thead>
            <tbody>';
        
        foreach ($summary as $summaryData) {
            $sumBags = $sumBags + floatval($summaryData['Bags']);
            $sumLbs = $sumLbs + floatval($summaryData['Lbs']);
            $html .= '                
                <tr>
                    <td width = "10%" align="center">' .$summaryData['CountName'] . '</td>    
                    <td width = "07%" align="right">' . number_format($summaryData['Bags'], $decimalPoints) . '<label>&nbsp;</label></td>
                    <td width = "10%" align="right">' . number_format($summaryData['Lbs'], $decimalPoints) . '<label>&nbsp;</label></td>
                </tr>';
        }
        
        $html .= '<tr>
                        <td width = "10%" align="center">Total</td>    
                        <td width = "07%" align="right">' . number_format($sumBags, $decimalPoints) . '<label>&nbsp;</label></td>
                        <td width = "10%" align="right">' . number_format($sumLbs, $decimalPoints) . '<label>&nbsp;</label></td>
                    </tr>';

        $html .= '</tbody>
        </table></div><br>';
        
        $pdf->writeHTML($html, true, false, false, false, '');

        //Close and output PDF document
        //This method has several options, check the source code documentation for more information.
        $pdf->Output('Stock Position Godowns-' .$dateone. '.pdf', 'I');
    }

}
