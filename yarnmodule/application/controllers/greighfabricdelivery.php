<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GreighFabricDelivery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Karachi");
        $this->load->model('m_itemspecification');
        $this->load->model('m_partycreation');
        $this->load->model('m_warehouse');
        $this->load->model('m_greighfabricdelivery');
        $this->load->model('M_greighfabricreceiving');
        $this->load->model('m_customerorder');
    }

    function index() {
        $dataArray = array();
        $itemSpecsModel = new M_itemspecification();
        $warehouseModel = new M_warehouse();
        $greighFabricModel = new M_greighfabricdelivery();
        $customerOrderModel = new M_customerorder();
        $greighFabricdeliveryModel = new M_greighfabricdelivery();
        $myModel = new My_Model();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $dataArray['gfList'] = $greighFabricModel->getAllActiveGreighFabricDeliveryInfo();
        $dataArray['itemList'] = $itemSpecsModel->getAllItems();
        $dataArray['processorList'] = $myModel->getPartyType('DYEING');
        $dataArray['weaverList'] = $myModel->getPartyType('WEAVING');
        $dataArray['warehouseCombo'] = $warehouseModel->getAllwarehouse();
        $dataArray['customerOrders'] = $customerOrderModel->getAllActiveCustomerOrderInfo();
        $dataArray['operation'] = $this->session->flashdata('operation');
        $dataArray['gfdc'] = $greighFabricdeliveryModel->generateGFDNumber();
        $dataArray['item_id'] = $this->session->flashdata('item_id');
        $dataArray['warehouse_id'] = $this->session->flashdata('warehouse_id');
        $dataArray['rolls'] = $this->session->flashdata('rolls');
        $dataArray['pieces'] = $this->session->flashdata('pieces');
        $dataArray['weight'] = $this->session->flashdata('weight');
        $this->load->view('header');
        $this->load->view('v_greighfabricdelivery', $dataArray);
        $this->load->view('footer');
    }

    function Add() {
        $greighFabricModel = new M_greighfabricdelivery();
        $myModel = new My_Model();

        $totalPieces = 0;
        $totalWeight = 0.00;
        $totalRolls = 0;

        $greighFabricDeliveryDetailData = array();
        $serialNo = $this->input->post('SerialNoDetail');
        $Pieces = $this->input->post('Pieces');
        $Weight = $this->input->post('Weight');
        $Rolls = $this->input->post('Rolls');
        $customer_order_id = $this->input->post('PONumber');
        $item = $this->input->post('ItemCode');
        $warehouse_id = $this->input->post('warehouse');

        for ($Count = 0; $Count < count($serialNo); $Count++) {

            $totalPieces = $totalPieces + $Pieces[$Count];
            $totalWeight = $totalWeight + $Weight[$Count];
            $totalRolls = $totalRolls + $Rolls[$Count];
        }

        $greighFabricDeliveryData = array(
            'GreighFabricDeliveryNo' => $this->input->post('GFDC'),
            'DeliveryDate' => date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))),
            'ChallanNo' => $this->input->post('ChallanNo'),
            'GatePassNo' => $greighFabricModel->generateGatePassNumber(),
            'VehicleNo' => $this->input->post('VehicleNo'),
            'TotalPieces' => $totalPieces,
            'TotalWeight' => $totalWeight,
            'TotalRolls' => $totalRolls,
            'party_id' => $this->input->post('ProcessorName'),
            'weaver_id' => $this->input->post('WeaverName'),
            'ReferenceChallanNo' => $this->input->post('ReferenceChallanNo'),
            'IssueBy' => $this->input->post('IssueBy'),
            'ReceivedBy' => $this->input->post('ReceivedBy'),
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']
        );

        $inserted = $greighFabricModel->InsertGreighFabricDelivery($greighFabricDeliveryData);

        if ($inserted) {
            for ($Count = 0; $Count < count($serialNo); $Count++) {
                $greighFabricDeliveryDetailData[] = array(
                    'Pieces' => $Pieces[$Count],
                    'Weight' => $Weight[$Count],
                    'Rolls' => $Rolls[$Count],
                    'item_id' => $item[$Count],
                    'warehouse_id' => $warehouse_id[$Count],
                    'customer_order_id' => $customer_order_id[$Count],
                    'greigh_fabric_delivery_id' => $inserted,
                    'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                    'isActive' => $myModel->getFieldsValue()['isActive']
                );
            }
            $greighFabricModel->InsertGreighFabricDeliveryDetail($greighFabricDeliveryDetailData);
            $gfrID = $inserted;
            $this->insertItemLedger($gfrID);
            $this->insertItemStock($gfrID);
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
        redirect(base_url() . "index.php/greighfabricdelivery/index");
    }

    function Update() {
//        $greighFabricModel = new M_greighfabricdelivery();
//        $myModel = new My_Model();
//        $gfrID = $this->input->post('delivery_id');
//        $gfdID = $this->input->post('delivery_id');
//        $greighFabricData = array(
//            'GreighFabricDeliveryNo' => $this->input->post('GreighFabricDeliveryNo'),
//            'DeliveryDate' => date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))),
//            'ChallanNo' => $this->input->post('ChallanNo'),
//            'TotalPieces' => $this->input->post('TotalPieces'),
//            'TotalWeight' => $this->input->post('TotalWeight'),
//            'TotalRolls' => $this->input->post('TotalRolls'),
//            'AvgLbsPerDozenReceived' => $this->input->post('AvgLbsPerDozen'),
//            'GramPerPieceReceived' => $this->input->post('GramPerPiece'),
//            'HeavyLightPercent' => $this->input->post('HeavyLight'),
//            'ReceivedBy' => $this->input->post('ReceivedBy'),
//            'IssueToProcessor' => $this->input->post('confirmDelivery'),
//            'party_id' => $this->input->post('PartyName'),
//            'item_id' => $this->input->post('ItemCode'),
//            'warehouse_id' => $this->input->post('warehouse'),
//            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
//            'isActive' => $myModel->getFieldsValue()['isActive']
//        );
//
//        $updated = $greighFabricModel->UpdateGreighFabricDelivery($gfrID, $greighFabricData);
//        
//        if ($updated) {
//            $weavearLegderData = $this->GetDataForYarnLedger($gfrID);
//            $greighFabricModel->updateYarnledger($weavearLegderData, $gfrID);
//            $this->updateItemLedger($gfrID);
//            $this->updateItemStock($gfrID);
//            $this->updateMainStock();
//        }
//
//        if ($updated) {
//            $updateItemMsg = "Successfully Updated ";
//        } else {
//            $updateItemMsg = "Failed to Updated";
//        }
//        
//        $this->session->set_flashdata('operation', '2');
//        $this->session->set_flashdata('gfrn', $gfrID);
//        $this->session->set_flashdata('gfdcDate', date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))));
//        $this->session->set_flashdata('gfdn', $gfdID);
//        $this->session->set_flashdata('item_id', $this->input->post('ItemCode'));
//        $this->session->set_flashdata('warehouse_id', $this->input->post('warehouse'));
//        $this->session->set_flashdata('gfdcDate', date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))));
//        $this->session->set_flashdata('rolls', $this->input->post('TotalRolls'));
//        $this->session->set_flashdata('pieces', $this->input->post('TotalPieces'));
//        $this->session->set_flashdata('weight', $this->input->post('TotalWeight'));
//        $this->session->set_flashdata('updatemessage', $updateItemMsg);
//        redirect(base_url() . "index.php/greighfabricdelivery/index");
    }

    function InsertGreighFabricDelivery($direct_delivery_id) {
//        $greighFabricModel = new M_greighfabricdelivery();
//        $myModel = new My_Model();
//        $totalPieces = 0;
//        $totalWeight = 0.00;
//        $totalRolls = 0;
//
//        $greighFabricDeliveryDetailData = array();
//        $serialNo = $this->input->post('SerialNoDetail');
//        $Pieces = $this->input->post('Pieces');
//        $Weight = $this->input->post('Weight');
//        $Rolls = $this->input->post('Rolls');
//        $customer_order_id = $this->input->post('PONumber');
//
//        for ($Count = 0; $Count < count($serialNo); $Count++) {
//
//            $totalPieces = $totalPieces + $Pieces[$Count];
//            $totalWeight = $totalWeight + $Weight[$Count];
//            $totalRolls = $totalRolls + $Rolls[$Count];
//        }
//
//        $greighFabricDeliveryData = array(
//            'GreighFabricDeliveryNo' => $this->input->post('GFDC'),
//            'DeliveryDate' => date("Y-m-d", strtotime($this->input->post('date'))),
//            'ChallanNo' => $this->input->post('ChallanNoDelivery'),
//            'GatePassNo' => $greighFabricModel->generateGatePassNumber(),
//            'VehicleNo' => $this->input->post('VehicleNo'),
//            'TotalPieces' => $totalPieces,
//            'TotalWeight' => $totalWeight,
//            'TotalRolls' => $totalRolls,
//            'party_id' => $this->input->post('ProcessorName'),
//            'direct_delivery_id' => $direct_delivery_id,
//            'IssueBy' => $this->input->post('IssueBy'),
//            'ReceivedBy' => $this->input->post('ReceivedByDelivery'),
//            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
//            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
//            'isActive' => $myModel->getFieldsValue()['isActive']
//        );
//
//        $inserted = $greighFabricModel->InsertGreighFabricDelivery($greighFabricDeliveryData);
//
//        if ($inserted) {
//            for ($Count = 0; $Count < count($serialNo); $Count++) {
//                $greighFabricDeliveryDetailData[] = array(
//                    'Pieces' => $Pieces[$Count],
//                    'Weight' => $Weight[$Count],
//                    'Rolls' => $Rolls[$Count],
//                    'item_id' => $this->input->post('item_id'),
//                    'warehouse_id' => $this->input->post('warehouse_id'),
//                    'customer_order_id' => $customer_order_id[$Count],
//                    'greigh_fabric_delivery_id' => $inserted,
//                    'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
//                    'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
//                    'isActive' => $myModel->getFieldsValue()['isActive']
//                );
//            }
//            $inserted = $greighFabricModel->InsertGreighFabricDeliveryDetail($greighFabricDeliveryDetailData);
//        } else {
//            $inserted = 0;
//        }
//        redirect(base_url() . "index.php/greighfabricdelivery/index");
    }

    function UpdateGreighFabricDelivery($direct_delivery_id) {
//        $greighFabricModel = new M_greighfabricdelivery();
//        $myModel = new My_Model();
//        $gfdID = $this->input->post('delivery_id');
//        $totalPieces = 0;
//        $totalWeight = 0.00;
//        $totalRolls = 0;
//        $greighFabricDeliveryDetailData = array();
//        $serialNo = $this->input->post('SerialNoDetail');
//        $Pieces = $this->input->post('Pieces');
//        $Weight = $this->input->post('Weight');
//        $Rolls = $this->input->post('Rolls');
//        $customer_order_id = $this->input->post('PONumber');
//        
//         for ($Count = 0; $Count < count($serialNo); $Count++) {
//
//            $totalPieces = $totalPieces + $Pieces[$Count];
//            $totalWeight = $totalWeight + $Weight[$Count];
//            $totalRolls = $totalRolls + $Rolls[$Count];
//        }
//        
//        $greighFabricDeliveryData = array(
//            //'GreighFabricDeliveryNo' => $greighFabricModel->generateGFDNumber(),
//            'DeliveryDate' => date("Y-m-d", strtotime($this->input->post('date'))),
//            'ChallanNo' => $this->input->post('ChallanNoDelivery'),
//            'GatePassNo' => $greighFabricModel->generateGatePassNumber(),
//            'VehicleNo' => $this->input->post('VehicleNo'),
//            'TotalPieces' => $totalPieces,
//            'TotalWeight' => $totalWeight,
//            'TotalRolls' => $totalRolls,
//            'party_id' => $this->input->post('ProcessorName'),
//            'direct_delivery_id' => $direct_delivery_id,
//            'IssueBy' => $this->input->post('IssueBy'),
//            'ReceivedBy' => $this->input->post('ReceivedByDelivery'),
//            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
//            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
//            'isActive' => $myModel->getFieldsValue()['isActive']
//        );
//
//        $updated = $greighFabricModel->UpdateGreighFabricDelivery($gfdID, $greighFabricDeliveryData);
//
//        if ($updated) {
//            for ($Count = 0; $Count < count($serialNo); $Count++) {
//                $greighFabricDeliveryDetailData[] = array(
//                    'Pieces' => $Pieces[$Count],
//                    'Weight' => $Weight[$Count],
//                    'Rolls' => $Rolls[$Count],
//                    'customer_order_id' => $customer_order_id[$Count],
//                    'item_id' => $this->input->post('item_id'),
//                    'warehouse_id' => $this->input->post('warehouse_id'),
//                    'greigh_fabric_delivery_id' => $gfdID,
//                    'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
//                    'isActive' => $myModel->getFieldsValue()['isActive']
//                );
//            }
//            $updated = $greighFabricModel->UpdateGreighFabricDeliveryDetail($gfdID, $greighFabricDeliveryDetailData);
//        } else {
//            $updated = 0;
//        }
//        redirect(base_url() . "index.php/greighfabricdelivery/index");
    }

    function DeleteDirectDelivery($gfdID) {
        $greighFabricModel = new M_greighfabricdelivery();
        $gfdData = array(
            'isActive' => 0,
        );
        $deleted = $greighFabricModel->DeleteGreighFabricDelivery($gfdID, $gfdData);
        $deleted = $greighFabricModel->DeleteItemLedger($gfdID);
        $deleted = $greighFabricModel->DeleteItemStock($gfdID);
        if ($deleted) {
            $deleteItemMsg = "Successfully Deleted ";
        } else {
            $deleteItemMsg = "Failed to Delete";
        }
        $this->session->set_flashdata('deletemessage', $deleteItemMsg);
        redirect(base_url() . "index.php/greighfabricreceiving/index");
    }

    function search() {
        $gfrModel = new M_greighfabricdelivery();
        $search = $this->input->post('search');
        $gfrSearch = $gfrModel->searchGreighFabricDelivery($search);
        $gfrData = json_encode($gfrSearch);
        echo $gfrData;
    }

    function insertSingleItemLedger($gfdID, $pieces) {
        $myModel = new My_Model();
        $greighFabricModel = new M_greighfabricdelivery();
        $greighFabricData = array(
            'party_id' => $this->input->post('ProcessorName'),
            'item_id' => $this->input->post('item_id'),
            'TransactionDate' => date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))),
            'Description' => "Item issued against GreighFabric Delivery No. " . $this->input->post('GFDC'),
            'ItemIssued' => $pieces,
            'ItemReceived' => 0,
            'greigh_fabric_delivery_id' => $gfdID,
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'user_id' => 0
        );
        $greighFabricModel->insertItemledger($greighFabricData);
    }

    function insertItemLedger($gfdID) {
        $myModel = new My_Model();
        $greighFabricModel = new M_greighfabricdelivery();
        $item_id = $this->input->post('ItemCode');
        $pieces = $this->input->post('Pieces');

        for ($count = 0; $count < count($item_id); $count++) {
            $greighFabricData = array(
                'party_id' => $this->input->post('ProcessorName'),
                'item_id' => $item_id[$count],
                'TransactionDate' => date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))),
                'Description' => "Item issued against GreighFabric Delivery No. " . $this->input->post('GFDC'),
                'ItemIssued' => $pieces[$count],
                'ItemReceived' => 0,
                'greigh_fabric_delivery_id' => $gfdID,
                'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                'user_id' => 0
            );
            $greighFabricModel->insertItemledger($greighFabricData);
        }
    }

    function updateSingleItemLedger($gfdID, $pieces) {
        $myModel = new My_Model();
        $greighFabricModel = new M_greighfabricdelivery();
        $greighFabricData = array(
            'party_id' => $this->input->post('ProcessorName'),
            'item_id' => $this->input->post('item_id'),
            'TransactionDate' => date("Y-m-d", strtotime($this->input->post('date'))),
            'Description' => "Item issued against GreighFabric Delivery No. " . $this->input->post('GFDC'),
            'ItemIssued' => $pieces,
            'ItemReceived' => 0,
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'user_id' => 0
        );
        $greighFabricModel->updateItemledger($greighFabricData, $gfdID);
    }

    function insertSingleItemStock($gfdID, $pieces) {
        $myModel = new My_Model();
        $greighFabricModel = new M_greighfabricdelivery();
        $greighFabricData = array(
            'item_id' => $_POST['item_id'],
            'warehouse_id' => $_POST['warehouse_id'],
            'TransactionDate' => date("Y-m-d", strtotime($_POST['GreighFabricDated'])),
            'TransactionType' => "OUT",
            'Quantity' => ($pieces * -1),
            'greigh_fabric_delivery_detail_id' => $gfdID,
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'user_id' => 0
        );
        $greighFabricModel->insertItemStock($greighFabricData);
    }

    function insertItemStock($gfdID) {
        $myModel = new My_Model();
        $greighFabricModel = new M_greighfabricdelivery();
        $item_id = $this->input->post('ItemCode');
        $warehouse_id = $this->input->post('warehouse');
        $pieces = $this->input->post('Pieces');

        for ($count = 0; $count < count($item_id); $count++) {
            $greighFabricData = array(
                'item_id' => $item_id[$count],
                'warehouse_id' => $warehouse_id[$count],
                'TransactionDate' => date("Y-m-d", strtotime($_POST['GreighFabricDated'])),
                'TransactionType' => "OUT",
                'Quantity' => ($pieces[$count] * -1),
                'greigh_fabric_delivery_detail_id' => $gfdID,
                'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                'user_id' => 0
            );
            $greighFabricModel->insertItemStock($greighFabricData);
        }
    }

    function updateSingleItemStock($gfdID, $pieces) {
        $myModel = new My_Model();
        $greighFabricModel = new M_greighfabricdelivery();
        $greighFabricData = array(
            'item_id' => $_POST['item_id'],
            'warehouse_id' => $_POST['warehouse_id'],
            'TransactionDate' => date("Y-m-d", strtotime($_POST['date'])),
            'TransactionType' => "OUT",
            'Quantity' => $pieces * -1,
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'user_id' => 0
        );
        $greighFabricModel->updateItemStock($greighFabricData, $gfdID);
    }

}
