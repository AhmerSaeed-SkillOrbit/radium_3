<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Yarnreturn extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_yarnreturn');
        $this->load->model('m_partytype');
        $this->load->model('m_countcreation');
        $this->load->model('m_partycreation');
        $this->load->model('m_warehouse');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $yarnReturnModel = new M_yarnreturn();
        $partyCreationModel = new M_partycreation();
        $countCreationModel = new M_countcreation();
        $partyTypeModel = new M_partytype();
        $warehouseModel = new M_warehouse();
        $myModel = new My_Model();
        $dataArray['yarnReturnNo'] = $yarnReturnModel->generateYarnReturnNumber();
        $dataArray['partyCombo'] = $partyCreationModel->getAllParty();
        $dataArray['millCombo'] = $myModel->getPartyType('Mill');
        $dataArray['countCombo'] = $countCreationModel->getAllCount();
        $dataArray['partyTypeCombo'] = $partyTypeModel->getAllPartyType();
        $dataArray['warehouseCombo'] = $warehouseModel->getAllwarehouse();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $dataArray['operation'] = $this->session->flashdata('operation');
        $dataArray['returnNo'] = $this->session->flashdata('returnNo');
        $this->load->view('header');
        $this->load->view('v_yarnreturn', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $yarnReturnModel = new M_yarnreturn();
        $myModel = new My_Model();
        $yarnReturnNo = trim($this->input->post('YarnReturnNumber'));
        $yarnReturnData = array(
            'ReturnDate' => date("Y-m-d", strtotime($this->input->post('ReturnDate'))),
            'YarnReturnNo' => trim($this->input->post('YarnReturnNumber')),
            'Party_id' => $this->input->post('idPartyType'),
            'ReturnType' => $this->input->post('idReturnType'),
            'SupplierChallanNo' => $this->input->post('SupplierChallanNo'),
            'TotalBags' => trim($this->input->post('TotalBags')),
            'TotalWeight' => trim(str_replace(',', '', $this->input->post('TotalWeight'))),
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']
        );
        $insertYarnReturn = $yarnReturnModel->InsertYarnReturn($yarnReturnData);
        $returnStock = $yarnReturnModel->ReturnStock($yarnReturnNo);
        $addLedger = $yarnReturnModel->insertYarnledger($yarnReturnNo);
        $this->session->set_flashdata('operation', '1');
        $this->session->set_flashdata('returnNo', $yarnReturnNo);
        $this->session->set_flashdata('insertmessage', '<h4 style="background-color:white;color:black;margin-left: 0px;margin-top: 05px;width: 390px;text-align: left;">' . $insertYarnReturn . '</h4>');
        redirect(base_url() . "index.php/yarnreturn/index");
    }

    function Update() {

        $yarnReturnModel = new M_yarnreturn();
        $myModel = new My_Model();
        $yarnReturnID = $this->input->post('YarnReturnID');
        $yarnReturnNo = $this->input->post('YarnReturnNumber');
        $yarnReturnData = array(
            'ReturnDate' => date("Y-m-d", strtotime($this->input->post('ReturnDate'))),
            'YarnReturnNo' => trim($this->input->post('YarnReturnNumber')),
            'Party_id' => $this->input->post('idPartyType'),
            'ReturnType' => $this->input->post('idReturnType'),
            'SupplierChallanNo' => $this->input->post('SupplierChallanNo'),
            'TotalBags' => trim($this->input->post('TotalBags')),
            'TotalWeight' => trim(str_replace(',', '', $this->input->post('TotalWeight'))),
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate']
        );
        $updateYarnReturn = $yarnReturnModel->UpdateYarnReturn($yarnReturnID, $yarnReturnData);
        $updateStock = $yarnReturnModel->UpdateStock($yarnReturnNo);
        $addLedger = $yarnReturnModel->UpdateYarnledger($yarnReturnNo);
        $this->session->set_flashdata('operation', '2');
        $this->session->set_flashdata('returnNo', $yarnReturnNo);
        $this->session->set_flashdata('updatemessage', $updateYarnReturn);
        redirect(base_url() . "index.php/yarnreturn/index");
    }

    function Delete($yarnReturnID) {
        $yarnReturnModel = new M_yarnreturn();
        $yarnReturnData = array(
            'isActive' => 0,
        );
        $deleteYarnReturn = $yarnReturnModel->DeleteYarnReturn($yarnReturnID, $yarnReturnData);
        $deleteStock = $yarnReturnModel->DeleteStock($yarnReturnID);
        $deleteLedger = $yarnReturnModel->DeleteLedger($yarnReturnID);
        $this->session->set_flashdata('deletemessage', $deleteYarnReturn);
        redirect(base_url() . "index.php/yarnreturn/index");
    }

    function search() {
        $yarnReturnModel = new M_yarnreturn();
        $search = $this->input->post('search');
        $yarnGrnSearch = $yarnReturnModel->searchYarnReturn($search);
        $yarnReturnData = json_encode($yarnGrnSearch);
        echo $yarnReturnData;
    }

    function save() {
        $myModel = new My_Model();
        $insertPopupData = $myModel->savePartyFromPopup();
        if ($insertPopupData === "Party of this Name is already exist") {
            echo $insertPopupData;
        } else {
            if ($insertPopupData) {
                echo "Successfully Inserted ";
            } else {
                echo "Failed to Insert";
            }
        }
    }

    function reloadCombo() {
        $partyCreationModel = new M_partycreation();
        $resulData = $partyCreationModel->getAllParty();
        echo json_encode($resulData);
    }

    function printYarnReturn($value) {
        $dataArray = array();
        $yarnReturnModel = new M_yarnreturn();
        $yarnGrnSearch = $yarnReturnModel->searchYarnReturn($value);
        $dataArray['data'] = $yarnGrnSearch;
        $dataArray['gatePassData'] = $yarnGrnSearch;
        $this->load->view('header');
        $this->load->view('printyarnreturn', $dataArray);
        $this->load->view('footer');
    }
    
    function getPartyBalance() {
        $yarnReturnModel = new M_yarnreturn();
        $partyID = $this->input->post('partyID');
        $returnID = $this->input->post('returnID');
        $data = $yarnReturnModel->getPartyBalance($partyID, $returnID);
        $partyBalance = json_encode($data);
        echo $partyBalance;
    }
    
    function downloadCSV($value) {
        $dataArray = array();
        $yarnReturnModel = new M_yarnreturn();
        $fileName = "PremierTowels-YarnReturn-" . $value . ".csv";
        $yarnReturnSearch = $yarnReturnModel->searchYarnReturn($value);
        $dataArray['data'] = $yarnReturnSearch;
        $dataArray['fileName'] = $fileName;
        $dataArray['type'] = "YarnReturn";
        $this->load->view('excel', $dataArray);
    }

//    function printGatePass() {
//        $dataArray = array();
//        $yarnReturnModel = new M_yarnreturn();
//        $search = $this->input->post('YarnReturnNo');
//        $yarnGrnSearch = $yarnReturnModel->searchYarnReturn($search);
//        $dataArray['data'] = $yarnGrnSearch;
//        $this->load->view('header');
//        $this->load->view('printgatepass', $dataArray);
//        $this->load->view('footer');
//    }

}
