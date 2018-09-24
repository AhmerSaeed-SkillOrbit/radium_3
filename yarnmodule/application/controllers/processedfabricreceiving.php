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
        $processedFabricReceivingModel = new M_processedfabricreceiving();
        $myModel = new My_Model();

        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $dataArray['pfrList'] = $processedFabricReceivingModel->getAllActiveProcessedFabricReceivingInfo();
        $dataArray['itemList'] = $itemSpecsModel->getAllItems();
        $dataArray['processorList'] = $myModel->getPartyType('DYEING');
        $dataArray['warehouseCombo'] = $warehouseModel->getAllwarehouse();
        $dataArray['customerOrders'] = $customerOrderModel->getAllActiveCustomerOrderInfo();
        $dataArray['pfr'] = $processedFabricReceivingModel->generatePFRNumber();

        $dataArray['description'] = $this->session->flashdata('description');
        $dataArray['rolls'] = $this->session->flashdata('rolls');
        $dataArray['pieces'] = $this->session->flashdata('pieces');
        $dataArray['color'] = $this->session->flashdata('color');

        $this->load->view('header');
        $this->load->view('v_processedfabricreceiving', $dataArray);
        $this->load->view('footer');
    }

    function Add() {
        $processedFabricReceivingModel = new M_processedfabricreceiving();
        $myModel = new My_Model();

        $totalPieces = 0;
        $totalRolls = 0;

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
            $pfrID = $inserted;
            $this->insertItemLedger($pfrID);
            $this->insertItemStock($pfrID);
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

    function insertItemLedger($pfrID) {
        $myModel = new My_Model();
        $processedFabricReceivingModel = new M_processedfabricreceiving();
        $item_id = $this->input->post('ItemCode');
        $pieces = $this->input->post('Pieces');

        for ($count = 0; $count < count($item_id); $count++) {
            $processedFabricReceivingData = array(
                'party_id' => $this->input->post('ProcessorName'),
                'item_id' => $item_id[$count],
                'TransactionDate' => date("Y-m-d", strtotime($this->input->post('ReceivingDate'))),
                'Description' => "Item received against Processed Fabric Receiving No. " . $this->input->post('PFRNo'),
                'ItemIssued' => 0,
                'ItemReceived' => $pieces[$count],
                'processed_fabric_receiving_id' => $pfrID,
                'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                'user_id' => 0
            );
            $processedFabricReceivingModel->insertItemledger($processedFabricReceivingData);
        }
    }

    function insertItemStock($pfrId) {
        $myModel = new My_Model();
        $processedFabricReceivingModel = new M_processedfabricreceiving();
        $item_id = $this->input->post('ItemCode');
        $warehouse_id = $this->input->post('warehouse');
        $pieces = $this->input->post('Pieces');

        for ($count = 0; $count < count($item_id); $count++) {
            $processedFabricReceivingData = array(
                'item_id' => $item_id[$count],
                'warehouse_id' => $warehouse_id[$count],
                'TransactionDate' => date("Y-m-d", strtotime($_POST['ReceivingDate'])),
                'TransactionType' => "IN",
                'Quantity' => ($pieces[$count] * +1),
                'processed_fabric_receiving_detail_id' => $pfrId,
                'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                'user_id' => 0
            );
            $processedFabricReceivingModel->insertItemStock($processedFabricReceivingData);
        }
    }

    function Update() {

        $processedFabricReceivingModel = new M_processedfabricreceiving();
        $myModel = new My_Model();

        $totalPieces = 0;
        $totalRolls = 0;

        $processedFabricReceivingId = $this->input->post('processed_fabric_receiving_id');
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
            'ReceivingDate' => date("Y-m-d", strtotime($this->input->post('ReceivingDate'))),
            'ChallanNo' => $this->input->post('ChallanNo'),
            'GatePassNo' => NULL,
            'VehicleNo' => $this->input->post('VehicleNo'),
            'TotalPieces' => $totalPieces,
            'TotalRolls' => $totalRolls,
            'party_id' => $this->input->post('ProcessorName'),
            'ReceivedBy' => $this->input->post('ReceivedBy'),
            'DriverName' => $this->input->post('DriverName'),
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate']
        );
        $updateProcessedFabricReceivingData = $processedFabricReceivingModel->UpdateProcessedFabricReceiving($processedFabricReceivingId, $processedFabricReceivingData);
        if ($updateProcessedFabricReceivingData) {
            for ($Count = 0; $Count < count($serialNo); $Count++) {
                $processedFabricReceivingDetailData[] = array(
                    'Pieces' => $Pieces[$Count],
                    'Rolls' => $Rolls[$Count],
                    'item_id' => $item[$Count],
                    'warehouse_id' => $warehouse_id[$Count],
                    'customer_order_id' => $customer_order_id[$Count],
                    'Color' => $Color[$Count],
                    'processed_fabric_receiving_id' => $processedFabricReceivingId,
                    'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                    'isActive' => $myModel->getFieldsValue()['isActive']
                );
            }
            $updateDetailData = $processedFabricReceivingModel->UpdateProcessedFabricReceivingDetail($processedFabricReceivingId, $processedFabricReceivingDetailData);
            if ($updateDetailData) {
                
            }
            $this->session->set_flashdata('updatemessage', $processedFabricReceivingData);
            redirect(base_url() . "index.php/processedfabricreceiving/index");
        } else {
            $this->session->set_flashdata('updatemessage', FALSE);
            redirect(base_url() . "index.php/processedfabricreceiving/index");
        }
//        $updateStock = $yarnDeliveryModel->UpdateStock($yarnDeliveryNo);
//        $updateLedger = $yarnDeliveryModel->UpdateYarnledger($yarnDeliveryNo);
//        if ($purposeID == 1) {
//            $updateWeaverLedger = $yarnDeliveryModel->UpdateWeavingLegder($yarnDeliveryNo);
//        }

        $this->session->set_flashdata('updatemessage', $processedFabricReceivingData);
        redirect(base_url() . "index.php/processedfabricreceiving/index");
    }

    function updateItemLedger($pfrID) {
        $myModel = new My_Model();
        $processedFabricReceivingModel = new M_processedfabricreceiving();
        $item_id = $this->input->post('ItemCode');
        $pieces = $this->input->post('Pieces');

        for ($count = 0; $count < count($item_id); $count++) {
            $processedFabricReceivingData = array(
                'party_id' => $this->input->post('ProcessorName'),
                'item_id' => $item_id[$count],
                'ItemReceived' => $pieces[$count],
                'processed_fabric_receiving_id' => $pfrID,
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                'user_id' => 0
            );
            $processedFabricReceivingModel->updateItemledger($processedFabricReceivingData);
        }
    }

    function updateItemStock($pfrId) {
        //think logic if rows exceed from insert
        
        $myModel = new My_Model();
        $processedFabricReceivingModel = new M_processedfabricreceiving();
        $item_id = $this->input->post('ItemCode');
        $warehouse_id = $this->input->post('warehouse');
        $pieces = $this->input->post('Pieces');

        for ($count = 0; $count < count($item_id); $count++) {
            $processedFabricReceivingData = array(
                'item_id' => $item_id[$count],
                'warehouse_id' => $warehouse_id[$count],
                'Quantity' => ($pieces[$count] * +1),
                'processed_fabric_receiving_detail_id' => $pfrId,
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                'user_id' => 0
            );
            $processedFabricReceivingModel->updateItemStock($processedFabricReceivingData);
        }
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

    function reloadCombo() {
        $partyCreationModel = new M_partycreation();
        $resulData = $partyCreationModel->getAllParty();
        echo json_encode($resulData);
    }

}
