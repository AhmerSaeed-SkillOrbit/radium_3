<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Purchasecontract extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_purchasecontract');
        $this->load->model('m_partytype');
        $this->load->model('m_countcreation');
        $this->load->model('m_purchasecontract');
        $this->load->model('m_partycreation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $purchaseContractModel = new M_purchasecontract();
        $countCreationModel = new M_countcreation();
        $partyTypeModel = new M_partytype();
        $myModel = new My_Model();
        $dataArray['pcNumber'] = $purchaseContractModel->generatePCNumber();
        $dataArray['brokerCombo'] = $myModel->getPartyType('Broker');
        $dataArray['millCombo'] = $myModel->getPartyType('Mill');
        $dataArray['countCombo'] = $countCreationModel->getAllCount();
        $dataArray['partyTypeCombo'] = $partyTypeModel->getAllPartyType();
        $dataArray['pcList'] = $purchaseContractModel->getAllActivePurchaseContractInfo();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $dataArray['operation'] = $this->session->flashdata('operation');
        $dataArray['pcNo'] = $this->session->flashdata('pcNo');
        $this->load->view('header');
        $this->load->view('v_purchasecontract', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $purchaseContractModel = new M_purchasecontract();
        $myModel = new My_Model();
        $decimalValue = 0.00;
        $purchaseContractData = array(
            'PurchaseContractNo' => $this->input->post('PCNumber'),
            'Broker_id' => $this->input->post('idBroker'),
            'Count_id' => $this->input->post('idCount'),
            'Mill_id' => $this->input->post('idMill'),
            'Brand' => trim($this->input->post('Brand')),
            'SellerContractNo' => trim($this->input->post('SellerContractNumber')),
            'ContractDate' => date("Y-m-d", strtotime($this->input->post('ContractDate'))),
            'Rate' => trim(str_replace(',', '', $this->input->post('Rate'))),
            'Bags' => trim($this->input->post('NoOfBags')),
            'TotalWeight' => trim(str_replace(',', '', $this->input->post('TotalWeight'))),
            'WeightRemaining' => trim(str_replace(',', '', $this->input->post('TotalWeight'))),
            'WeightRecieved' => $decimalValue,
            'ContractAmount' => trim(str_replace(',', '', $this->input->post('ContractAmount'))),
            'GSTPercent' => trim(str_replace(',', '', $this->input->post('GSTPercent'))),
            'GSTAmount' => trim(str_replace(',', '', $this->input->post('GSTAmount'))),
            'ContractAmountGST' => trim(str_replace(',', '', $this->input->post('ContractAmountGST'))),
            'PaymentTerms' => trim($this->input->post('PaymentTerms')),
            'Cartage' => $this->input->post('Cartage'),
            'Remarks' => trim($this->input->post('Remarks')),
            'isClosed' => 0,
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']
        );
        $insertPurchaseContract = $purchaseContractModel->InsertPurchaseContract($purchaseContractData);
        $this->session->set_flashdata('operation', '1');
        $this->session->set_flashdata('pcNo', $purchaseContractData["PurchaseContractNo"]);
        $this->session->set_flashdata('insertmessage', $insertPurchaseContract);
        redirect(base_url() . "index.php/purchasecontract/index");
    }

    function Update() {
        $purchaseContractModel = new M_purchasecontract();
        $myModel = new My_Model();
        $purchaseContractID = $this->input->post('PurchaseContractID');
        $decimalValue = 0.00;
        $purchaseContractData = array(
            'PurchaseContractNo' => $this->input->post('PCNumber'),
            'Broker_id' => $this->input->post('idBroker'),
            'Count_id' => $this->input->post('idCount'),
            'Mill_id' => $this->input->post('idMill'),
            'Brand' => trim($this->input->post('Brand')),
            'SellerContractNo' => trim($this->input->post('SellerContractNumber')),
            'ContractDate' => date("Y-m-d", strtotime($this->input->post('ContractDate'))),
            'Rate' => trim(str_replace(',', '', $this->input->post('Rate'))),
            'Bags' => trim($this->input->post('NoOfBags')),
            'TotalWeight' => trim(str_replace(',', '', $this->input->post('TotalWeight'))),
            'WeightRemaining' => trim(str_replace(',', '', $this->input->post('TotalWeight'))),
            'WeightRecieved' => $decimalValue,
            'ContractAmount' => trim(str_replace(',', '', $this->input->post('ContractAmount'))),
            'PaymentTerms' => trim($this->input->post('PaymentTerms')),
            'Cartage' => $this->input->post('Cartage'),
            'Remarks' => $this->input->post('Remarks'),
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'GSTPercent' => trim(str_replace(',', '', $this->input->post('GSTPercent'))),
            'GSTAmount' => trim(str_replace(',', '', $this->input->post('GSTAmount'))),
            'ContractAmountGST' => trim(str_replace(',', '', $this->input->post('ContractAmountGST'))),
        );
        $updatePurchaseContract = $purchaseContractModel->UpdatePurchaseContract($purchaseContractID, $purchaseContractData);
        $this->session->set_flashdata('operation', '2');
        $this->session->set_flashdata('pcNo', $purchaseContractData["PurchaseContractNo"]);
        $this->session->set_flashdata('updatemessage', $updatePurchaseContract);
        redirect(base_url() . "index.php/purchasecontract/index");
    }

    function Delete($purchaseContractID) {
        $purchaseContractModel = new M_purchasecontract();
        $purchaseContractData = array(
            'isActive' => 0,
        );
        $deletePurchaseContractCreation = $purchaseContractModel->DeletePurchaseContract($purchaseContractID, $purchaseContractData);
        $this->session->set_flashdata('deletemessage', $deletePurchaseContractCreation);
        redirect(base_url() . "index.php/purchasecontract/index");
    }

    function search() {
        $purchaseContractModel = new M_purchasecontract();
        $search = $this->input->post('search');
        $partyCreationSearch = $purchaseContractModel->searchPurchaseContract($search);
        $purchaseContractData = json_encode($partyCreationSearch);
        echo $purchaseContractData;
    }

    function notClosedPC() {
        $purchaseContractModel = new M_purchasecontract();
        $search = $this->input->post('search');
        $partyCreationSearch = $purchaseContractModel->notClosedPurchaseContract($search);
        $purchaseContractData = json_encode($partyCreationSearch);
        echo $purchaseContractData;
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
        $myModel = new My_Model();
        $typeOfParty = $this->input->post('data');
        if ($typeOfParty == "Broker") {
            $typeOfParty = 'Broker';
            $resulData = $myModel->getPartyType($typeOfParty);
            echo json_encode($resulData);
        } else {
            $typeOfParty = 'Mill';
            $resulData = $myModel->getPartyType($typeOfParty);
            echo json_encode($resulData);
        }
    }

    function printPC($value) {
        $dataArray = array();
        $purchaseContractModel = new M_purchasecontract();
        $partyCreationSearch = $purchaseContractModel->searchPurchaseContract($value);
        $dataArray['data'] = $partyCreationSearch;
        $this->load->view('header');
        $this->load->view('printpc', $dataArray);
        $this->load->view('footer');
    }

    function downloadCSV($value) {
        $dataArray = array();
        $purchaseContractModel = new M_purchasecontract();
        $fileName = "PremierTowels-PC-" . $value . ".csv";
        $pcSearch = $purchaseContractModel->searchPurchaseContract($value);
        $dataArray['data'] = $pcSearch;
        $dataArray['fileName'] = $fileName;
        $dataArray['type'] = "PC";
        $this->load->view('excel', $dataArray);
    }

}
