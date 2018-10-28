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

                $processedFabricReceivingDetailData = array(
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

                $pfrDetailId = $processedFabricReceivingModel->InsertProcessedFabricReceivingDetail($processedFabricReceivingDetailData);
                if ($pfrDetailId) {
                    //now inserting item stock                    
                    $itemStockData = array(
                        'item_id' => $item[$Count],
                        'warehouse_id' => $warehouse_id[$Count],
                        'TransactionDate' => date("Y-m-d", strtotime($_POST['ReceivingDate'])),
                        'TransactionType' => "IN",
                        'Quantity' => $Pieces[$Count],
                        'processed_fabric_receiving_detail_id' => $pfrDetailId,
                        'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                        'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                        'user_id' => 0
                    );
                    $processedFabricReceivingModel->insertItemStock($itemStockData);
                }
            }

            $pfrID = $inserted;
            $this->insertItemLedger($pfrID, 0);
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
        $processedFabricReceivingModel = new M_processedfabricreceiving();
        $myModel = new My_Model();

        $totalPieces = 0;
        $totalRolls = 0;

        $pfrId = $this->input->post('processed_fabric_receiving_id');
        $pfrDetalId = $this->input->post('pfrDetailId');
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
            //deleting record from item_stock table
            //on behalf of processed_fabric_receiving_detail id
            $processedFabricReceivingModel->DeleteItemStock($pfrDetalId[$Count]);
        }

        //deleting record from processedfabricreceivingdetail table 
        //on behalf of processed_fabricreceiving_id
        $processedFabricReceivingModel->DeleteProcessedFabricReceivingDetail($pfrId);

        //updating processedfabricreceiving data
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
        $updateProcessedFabricReceivingData = $processedFabricReceivingModel->UpdateProcessedFabricReceiving($pfrId, $processedFabricReceivingData);

        //now adding processefabricreceivingdetail
        //and item_stock record
        if ($updateProcessedFabricReceivingData) {
            for ($Count = 0; $Count < count($serialNo); $Count++) {
                $processedFabricReceivingDetailData = array(
                    'Pieces' => $Pieces[$Count],
                    'Rolls' => $Rolls[$Count],
                    'item_id' => $item[$Count],
                    'warehouse_id' => $warehouse_id[$Count],
                    'customer_order_id' => $customer_order_id[$Count],
                    'Color' => $Color[$Count],
                    'processed_fabric_receiving_id' => $pfrId,
                    'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                    'isActive' => $myModel->getFieldsValue()['isActive']
                );

                $pfrDetailId = $processedFabricReceivingModel->InsertProcessedFabricReceivingDetail($processedFabricReceivingDetailData);
                if ($pfrDetailId) {
                    $itemStockData = array(
                        'item_id' => $item[$Count],
                        'warehouse_id' => $warehouse_id[$Count],
                        'TransactionDate' => date("Y-m-d", strtotime($_POST['ReceivingDate'])),
                        'TransactionType' => "IN",
                        'Quantity' => $Pieces[$Count],
                        'processed_fabric_receiving_detail_id' => $pfrDetailId,
                        'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                        'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                        'user_id' => 0
                    );
                    $processedFabricReceivingModel->insertItemStock($itemStockData);
                }
            }

            if ($updateProcessedFabricReceivingData) {
                //deleteing item_ledger record
                //on behalf of processed_fabric_receiving_id
                //and adding item_ledger again
                $processedFabricReceivingModel->DeleteItemLedger($pfrId);
                $this->insertItemLedger($pfrId, 0);
            }

            $updateMessage = "Successfully Updated";
            $this->session->set_flashdata('updatemessage', $updateMessage);
        } else {
            $updateMessage = "Failed to Update";
            $this->session->set_flashdata('updatemessage', FALSE);
        }
        redirect(base_url() . "index.php/processedfabricreceiving/index");
    }

    function Delete($processedFabricReceivingId) {
        $processedFabricReceivingModel = new M_processedfabricreceiving();
        $deleteData = array(
            'isActive' => 0,
        );

        //first fetch processedFabricReceivingDetail record
        //via provided processedFabricReceivingId
        //then delete item_stock record on basis of fetched processedFabricReceivingDetailId
        //then delete item_ledger record via provided processedFabricReceivingId
        //then delete processedFabricReceivingDetail record via provided processedFabricReceivingId
        //then delete processedFabricReceiving recor via provided processedFabricReceivingId

        $pfrDetailData = $processedFabricReceivingModel->getProcessedFabricReceivingDetailViaProcessedFabricReceivingId($processedFabricReceivingId);
        if ($pfrDetailData != null) {
            $pfrDetailIds = explode(",", $pfrDetailData);
//            print_r($pfrDetailIds);
            if (count($pfrDetailIds) > 0) {
                for ($i = 0; $i < count($pfrDetailIds); $i++) {
//                    echo "<br>";'
//                    echo "<pre>";
//                    echo $pfrDetailIds[$i];
                    $processedFabricReceivingModel->DeleteItemStock($pfrDetailIds[$i]);
                }
            }
        }
        $processedFabricReceivingModel->DeleteItemLedger($processedFabricReceivingId);
        $processedFabricReceivingModel->DeleteProcessedFabricReceivingDetail($processedFabricReceivingId);
        $delete = $processedFabricReceivingModel->DeleteProcessedFabricReceivingRecord($processedFabricReceivingId, $deleteData);

        if ($delete == 1) {
            $deleteMessage = "Successfully Deleted";
            $this->session->set_flashdata('deletemessage', $deleteMessage);
        } else {
            $deleteMessage = "Failed to Delete";
            $this->session->set_flashdata('deletemessage', $deleteMessage);
        }
        redirect(base_url() . "index.php/processedfabricreceiving/index");
    }

    function search() {
        $processedFabricReceivingModel = new M_processedfabricreceiving();
        $search = $this->input->post('search');
        $processedFabricReceivingSearch = $processedFabricReceivingModel->searchProcessedFabricReceiving($search);
        $processedFabricReceivingData = json_encode($processedFabricReceivingSearch);
        echo $processedFabricReceivingData;
    }

    function reloadCombo() {
        $partyCreationModel = new M_partycreation();
        $resulData = $partyCreationModel->getAllParty();
        echo json_encode($resulData);
    }

    function insertItemLedger($pfrID, $userId) {
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
                'user_id' => $userId
            );
            $processedFabricReceivingModel->insertItemledger($processedFabricReceivingData);
        }
    }

}
