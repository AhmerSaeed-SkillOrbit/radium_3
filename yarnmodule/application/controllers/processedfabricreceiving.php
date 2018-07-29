<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Processedfabricreceiving extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('m_itemspecification');
        $this->load->model('m_partycreation');
        $this->load->model('m_warehouse');
        $this->load->model('m_processedfabricreceiving');
        $this->load->model('m_customerorder');

        $this->load->model('m_yarndelivery');
        $this->load->model('m_partytype');
        $this->load->model('m_countcreation');
        $this->load->model('m_partycreation');
        $this->load->model('m_warehouse');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $itemSpecsModel = new M_itemspecification();
        $warehouseModel = new M_warehouse();
        $customerOrderModel = new M_customerorder();
        $myModel = new My_Model();

        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');

        $dataArray['itemList'] = $itemSpecsModel->getAllItems();
        $dataArray['processorList'] = $myModel->getPartyType('DYEING');
        $dataArray['warehouseCombo'] = $warehouseModel->getAllwarehouse();
        $dataArray['customerOrders'] = $customerOrderModel->getAllActiveCustomerOrderInfo();

        $this->load->view('header');
        $this->load->view('v_processedfabricreceiving', $dataArray);
        $this->load->view('footer');
    }

    function Add() {
        $processedFabricReceivingModel = new M_processedfabricreceiving();
        $myModel = new My_Model();

        $totalPieces = 0;
        $totalRolls = 0;

        $processedFabricReceivingData = array();
        $serialNo = $this->input->post('SerialNoDetail');
        $Pieces = $this->input->post('Pieces');
        $Rolls = $this->input->post('Rolls');
        $Color = $this->input->post('Color');
        $customer_order_id = $this->input->post('PONumber');
        $item = $this->input->post('ItemCode');
        $warehouse_id = $this->input->post('warehouse');

        for ($Count = 0; $Count < count($serialNo); $Count++) {

            $totalPieces = $totalPieces + $Pieces[$Count];
            $totalRolls = $totalRolls + $Rolls[$Count];
        }

        $processedFabricReceivingData = array(
            'ProcessedFabricReceivingNo' => $this->input->post('PFRNo'),
            'ReceivingDate' => date("Y-m-d", strtotime($this->input->post('ReceivingDate'))),
            'ChallanNo' => $this->input->post('ChallanNo'),
            'GatePassNo' => NULL,
            'VehicleNo' => $this->input->post('VehicleNo'),
            'TotalPieces' => $totalPieces,
            'TotalRolls' => $totalRolls,
            'party_id' => $this->input->post('ProcessorName'),
            'ReceivedBy' => $this->input->post('ReceivedBy'),
            'DriverName' => $this->input->post('DriverName'),
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']
        );

        $inserted = $processedFabricReceivingModel->InsertProcessedFabricReceiving($processedFabricReceivingData);

        if ($inserted) {
            for ($Count = 0; $Count < count($serialNo); $Count++) {
                $processedFabricReceivingDetailData[] = array(
                    'Pieces' => $Pieces[$Count],
                    'Rolls' => $Rolls[$Count],
                    'item_id' => $item[$Count],
                    'warehouse_id' => $warehouse_id[$Count],
                    'customer_order_id' => $customer_order_id[$Count],
                    'Color' => $Color[$Count],
                    'processed_fabric_receiving_id' => $inserted,
                    'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                    'isActive' => $myModel->getFieldsValue()['isActive']
                );
            }
            $processedFabricReceivingModel->InsertProcessedFabricReceivingDetail($processedFabricReceivingDetailData);
//            $gfrID = $inserted;
//            $this->insertItemLedger($gfrID);
//            $this->insertItemStock($gfrID);
        } else {
            $inserted = 0;
        }
        if ($inserted) {
            $insertItemMsg = "Successfully Inserted";
        } else {
            $insertItemMsg = "Failed to Insert";
        }

        $this->session->set_flashdata('operation', '1');
        $this->session->set_flashdata('insertmessage', $insertItemMsg);
        redirect(base_url() . "index.php/processedfabricreceiving/index");
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
