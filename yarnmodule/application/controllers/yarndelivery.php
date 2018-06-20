<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Yarndelivery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_yarndelivery');
        $this->load->model('m_yarndelivery');
        $this->load->model('m_partytype');
        $this->load->model('m_countcreation');
        $this->load->model('m_partycreation');
        $this->load->model('m_warehouse');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $yarnDeliveryModel = new M_yarndelivery();
        $partyCreationModel = new M_partycreation();
        $countCreationModel = new M_countcreation();
        $partyTypeModel = new M_partytype();
        $warehouseModel = new M_warehouse();
        $myModel = new My_Model();
        $dataArray['deliveryChallanNo'] = $yarnDeliveryModel->generateDeliveryChallanNumber();
        $dataArray['gatePassNo'] = $yarnDeliveryModel->generateGatePassNumber();
        $dataArray['partyCombo'] = $partyCreationModel->getAllParty();
        $dataArray['millCombo'] = $myModel->getPartyType('Mill');
        $dataArray['countCombo'] = $countCreationModel->getAllCount();
        $dataArray['purposeCombo'] = $yarnDeliveryModel->getAllPurpose();
        $dataArray['usageCombo'] = $yarnDeliveryModel->getAllUsage();
        $dataArray['partyTypeCombo'] = $partyTypeModel->getAllPartyType();
        $dataArray['warehouseCombo'] = $warehouseModel->getAllwarehouse();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $dataArray['operation'] = $this->session->flashdata('operation');
        $dataArray['challanNo'] = $this->session->flashdata('challanNo');
        $this->load->view('header');
        $this->load->view('v_yarndelivery', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $yarnDeliveryModel = new M_yarndelivery();
        $myModel = new My_Model();
        $challanID = $this->input->post('DeliveryChalanNumber');
        $purposeID = $this->input->post('idPurpose');
        $yarnDeliveryData = array(
            'ChallanDate' => date("Y-m-d", strtotime($this->input->post('ChallanDate'))),
            'DeliveryChallanNo' => trim($this->input->post('DeliveryChalanNumber')),
            'GatePassNo' => trim($this->input->post('GatePassNumber')),
            'VehicleNo' => trim($this->input->post('VehicleNumber')),
            'Party_id' => $this->input->post('idPartyType'),
            'Purpose_id' => $this->input->post('idPurpose'),
            'TotalBags' => trim($this->input->post('TotalBags')),
            'TotalWeight' => trim(str_replace(',', '', $this->input->post('TotalWeight'))),
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']
        );
        $insertYarnDelivery = $yarnDeliveryModel->InsertYarnDelivery($yarnDeliveryData);
        $removeStock = $yarnDeliveryModel->RemoveStock($challanID);
        $addLedger = $yarnDeliveryModel->insertYarnledger($challanID);
        if ($purposeID == 1) {
            $addWeaverLedger = $yarnDeliveryModel->InsertWeavingLegder($challanID);
        }
        $this->session->set_flashdata('operation', '1');
        $this->session->set_flashdata('challanNo', $challanID);
        $this->session->set_flashdata('insertmessage', '<h4 style="background-color:white;color:black;margin-left: 0px;margin-top: 05px;width: 390px;text-align: left;">' . $insertYarnDelivery . '</h4>');
        redirect(base_url() . "index.php/yarndelivery/index");
    }

    function Update() {

        $yarnDeliveryModel = new M_yarndelivery();
        $myModel = new My_Model();
        $yarnDeliveryID = $this->input->post('DeliveryChalanID');
        $yarnDeliveryNo = $this->input->post('DeliveryChalanNumber');
        $purposeID = $this->input->post('idPurpose');
        $yarnDeliveryData = array(
            'ChallanDate' => date("Y-m-d", strtotime($this->input->post('ChallanDate'))),
            'DeliveryChallanNo' => trim($this->input->post('DeliveryChalanNumber')),
            'GatePassNo' => trim($this->input->post('GatePassNumber')),
            'VehicleNo' => trim($this->input->post('VehicleNumber')),
            'Party_id' => $this->input->post('idPartyType'),
            'Purpose_id' => $this->input->post('idPurpose'),
            'TotalBags' => trim($this->input->post('TotalBags')),
            'TotalWeight' => trim(str_replace(',', '', $this->input->post('TotalWeight'))),
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate']
        );
        $updateYarnDelivery = $yarnDeliveryModel->UpdateYarnDelivery($yarnDeliveryID, $yarnDeliveryData);
        $updateStock = $yarnDeliveryModel->UpdateStock($yarnDeliveryNo);
        $updateLedger = $yarnDeliveryModel->UpdateYarnledger($yarnDeliveryNo);
        if ($purposeID == 1) {
            $updateWeaverLedger = $yarnDeliveryModel->UpdateWeavingLegder($yarnDeliveryNo);
        }
        $this->session->set_flashdata('operation', '2');
        $this->session->set_flashdata('challanNo', $yarnDeliveryNo);
        $this->session->set_flashdata('updatemessage', $updateYarnDelivery);
        redirect(base_url() . "index.php/yarndelivery/index");
    }

    function Delete($yarnDeliveryID) {
        $yarnDeliveryModel = new M_yarndelivery();
        $purposeID = $this->input->post('idPurpose');
        $yarnDeliveryData = array(
            'isActive' => 0,
        );
        $deleteYarnDelivery = $yarnDeliveryModel->DeleteYarnDelivery($yarnDeliveryID, $yarnDeliveryData);
        $deleteStock = $yarnDeliveryModel->DeleteStock($yarnDeliveryID);
        $deleteLedger = $yarnDeliveryModel->DeleteLedger($yarnDeliveryID);
        if ($purposeID == 1) {
            $deleteWeaverLedger = $yarnDeliveryModel->DeleteWeavingLegder($yarnDeliveryID);
        }
        $this->session->set_flashdata('deletemessage', $deleteYarnDelivery);
        redirect(base_url() . "index.php/yarndelivery/index");
    }

    function search() {
        $yarnDeliveryModel = new M_yarndelivery();
        $search = $this->input->post('search');
        $yarnGrnSearch = $yarnDeliveryModel->searchYarnDelivery($search);
        $yarnDeliveryData = json_encode($yarnGrnSearch);
        echo $yarnDeliveryData;
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

    function printYarnDelivery($value) {
        $dataArray = array();
        $yarnDeliveryModel = new M_yarndelivery();
        $yarnGrnSearch = $yarnDeliveryModel->searchYarnDelivery($value);
        $dataArray['data'] = $yarnGrnSearch;
        $dataArray['gatePassData'] = $yarnGrnSearch;
        $this->load->view('header');
        $this->load->view('printyarndelivery', $dataArray);
        $this->load->view('footer');
    }

    function printGatePass() {
        $dataArray = array();
        $yarnDeliveryModel = new M_yarndelivery();
        $search = $this->input->post('DeliveryChalanNumber');
        $yarnGrnSearch = $yarnDeliveryModel->searchYarnDelivery($search);
        $dataArray['data'] = $yarnGrnSearch;
        $this->load->view('header');
        $this->load->view('printgatepass', $dataArray);
        $this->load->view('footer');
    }
    
    function getStockQuantity() {
        $yarnDeliveryModel = new M_yarndelivery();
        $countID = $this->input->post('countID');
        $millID = $this->input->post('millID');
        $brand = $this->input->post('brand');
        $warehouseID = $this->input->post('warehouseID');
        $challanID = $this->input->post('deliveryChalanID');
        $data = $yarnDeliveryModel->getStock($countID, $millID, $brand, $warehouseID, $challanID);
        $stockQuantity = json_encode($data);
        echo $stockQuantity;
    }
    
    function downloadCSV($value) {
        $dataArray = array();
        $yarnDeliveryModel = new M_yarndelivery();
        $fileName = "PremierTowels-YarnDelivery-" . $value . ".csv";
        $yarnDeliverySearch = $yarnDeliveryModel->searchYarnDelivery($value);
        $dataArray['data'] = $yarnDeliverySearch;
        $dataArray['fileName'] = $fileName;
        $dataArray['type'] = "YarnDelivery";
        $this->load->view('excel', $dataArray);
    }

}
