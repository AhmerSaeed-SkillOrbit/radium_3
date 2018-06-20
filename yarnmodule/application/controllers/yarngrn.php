<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Yarngrn extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_yarngrn');
        $this->load->model('m_partytype');
        $this->load->model('m_countcreation');
        $this->load->model('m_partycreation');
        $this->load->model('m_yarngrn');
        $this->load->model('m_warehouse');
        $this->load->model('m_purchasecontract');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $grnModel = new M_yarngrn();
        $countCreationModel = new M_countcreation();
        $warehouseModel = new M_warehouse();
        $purchaseContractModel = new M_purchasecontract();
        $myModel = new My_Model();
        $dataArray['grnNumber'] = $grnModel->generateGRNNumber();
        $dataArray['brokerCombo'] = $myModel->getPartyType('Broker');
        $dataArray['millCombo'] = $myModel->getPartyType('Mill');
        $dataArray['countCombo'] = $countCreationModel->getAllCount();
        $dataArray['warehouseCombo'] = $warehouseModel->getAllwarehouse();
        $dataArray['pcList'] = $purchaseContractModel->getAllOpenedPurchaseContract();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $dataArray['operation'] = $this->session->flashdata('operation');
        $dataArray['grnNo'] = $this->session->flashdata('grnNo');
        $this->load->view('header');
        $this->load->view('v_yarngrn', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $grnModel = new M_yarngrn();
        $myModel = new My_Model();
        $yarnGrnID = $this->input->post('GRNNumber');
        $yarnGrnData = array(
            'ChallanDate' => date("Y-m-d", strtotime($this->input->post('ChallanDate'))),
            'ChallanNo' => trim($this->input->post('ChallanNumber')),
            'GRNNo' => $this->input->post('GRNNumber'),
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']
        );
        $insertYarnGrn = $grnModel->InsertYarnGrn($yarnGrnData);
        $insertStock = $grnModel->InsertStock($yarnGrnID);
        $closePC = $grnModel->ClosePurchaseContract();
        $this->session->set_flashdata('operation', '1');
        $this->session->set_flashdata('grnNo', $yarnGrnID);
        $this->session->set_flashdata('insertmessage', '<h4 style="background-color:white;color:black;margin-left: 0px;margin-top: 05px;width: 390px;text-align: left;">' . $insertYarnGrn . '</h4>');
        redirect(base_url() . "index.php/yarngrn/index");
        
    }

    function Update() {

        $grnModel = new M_yarngrn();
        $myModel = new My_Model();
        $yarnGrnID = $this->input->post('GRNID');
        $yarnGrnNo = $this->input->post('GRNNumber');
        $yarnGrnData = array(
            'ChallanDate' => date("Y-m-d", strtotime($this->input->post('ChallanDate'))),
            'ChallanNo' => trim($this->input->post('ChallanNumber')),
            'GRNNo' => $this->input->post('GRNNumber'),
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
        );
        $updateYarnGrn = $grnModel->UpdateYarnGrn($yarnGrnID, $yarnGrnData);
        $updateStock = $grnModel->UpdateStock($yarnGrnNo);
        $closePC = $grnModel->ClosePurchaseContract();
        $openPC = $grnModel->OpenPurchaseContract($yarnGrnID);
        $this->session->set_flashdata('operation', '2');
        $this->session->set_flashdata('grnNo', $yarnGrnNo);
        $this->session->set_flashdata('updatemessage', $updateYarnGrn);
        redirect(base_url() . "index.php/yarngrn/index");
    }

    function Delete($yarnGrnID) {
        $grnModel = new M_yarngrn();
        $yarnGrnData = array(
            'isActive' => 0,
        );
        $deleteYarnGrn = $grnModel->DeleteYarnGrn($yarnGrnID, $yarnGrnData);
        $deleteStock = $grnModel->DeleteStock($yarnGrnID);
        $openPC = $grnModel->OpenPurchaseContract($yarnGrnID);
        $this->session->set_flashdata('deletemessage', $deleteYarnGrn);
        redirect(base_url() . "index.php/yarngrn/index");
    }

    function search() {
        $grnModel = new M_yarngrn();
        $search = $this->input->post('search');
        $yarnGrnSearch = $grnModel->searchYarnGrn($search);
        $yarnGrnData = json_encode($yarnGrnSearch);
        echo $yarnGrnData;
    }

    function printGrn($value) {
        $dataArray = array();
        $grnModel = new M_yarngrn();
        $yarnGrnSearch = $grnModel->searchYarnGrn($value);
        $dataArray['data'] = $yarnGrnSearch;
        $this->load->view('header');
        $this->load->view('printgrn', $dataArray);
        $this->load->view('footer');
    }

    function downloadCSV($value) {
        $dataArray = array();
        $grnModel = new M_yarngrn();
//        $fileName = "PremierTowels-GRN-" . "$orderNo" . ".csv";
        $fileName = "PremierTowels-GRN-" . $value . ".csv";
        $yarnGrnSearch = $grnModel->searchYarnGrn($value);
        $dataArray['data'] = $yarnGrnSearch;
        $dataArray['fileName'] = $fileName;
        $dataArray['type'] = "GRN";
        $this->load->view('excel', $dataArray);
    }

    function getTotalNetWeight() {
        $grnModel = new M_yarngrn();
        $pcID = $this->input->post('pcID');
        $data = $grnModel->calNetWeight($pcID);
        $totalNetWeight = json_encode($data);
        echo $totalNetWeight;
    }
    
}