<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GreighFabricReceiving extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Karachi");
        $this->load->helper('WeavingCalculation');
        $this->load->model('m_itemspecification');
        $this->load->model('m_partycreation');
        $this->load->model('m_warehouse');
        $this->load->model('m_greighfabricreceiving');
        $this->load->model('m_greighfabricdelivery');
        $this->load->model('m_customerorder');
        $this->load->library('../controllers/GreighFabricDelivery');

    }

    function index() {
        $dataArray = array();
        $itemSpecsModel = new M_itemspecification();
        $warehouseModel = new M_warehouse();
        $greighFabricModel = new M_greighfabricreceiving();
        $customerOrderModel = new M_customerorder();
        
        $myModel = new My_Model();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $dataArray['gfrNumber'] = $greighFabricModel->generateGFRNumber();
        $dataArray['gfList'] = $greighFabricModel->getAllActiveGreighFabricReceivingInfo();
        $dataArray['itemList'] = $itemSpecsModel->getAllItems();
        $dataArray['partyList'] = $myModel->getPartyType('WEAVING');
        $dataArray['processorList'] = $myModel->getPartyType('DYEING');
        $dataArray['warehouseCombo'] = $warehouseModel->getAllwarehouse();
        $dataArray['customerOrders'] = $myModel->getOrderByData('customer_order','PremierPO' , 'isActive');
        $dataArray['operation'] = $this->session->flashdata('operation');
        $dataArray['gfrn'] = $this->session->flashdata('gfrn');
        $dataArray['gfdc'] = $this->session->flashdata('gfdc');
        $dataArray['gfdcDate'] = $this->session->flashdata('gfdcDate');
        $dataArray['gfdn'] = $this->session->flashdata('gfdn');
        $dataArray['item_id'] = $this->session->flashdata('item_id');
        $dataArray['warehouse_id'] = $this->session->flashdata('warehouse_id');
        $dataArray['rolls'] = $this->session->flashdata('rolls');
        $dataArray['pieces'] = $this->session->flashdata('pieces');
        $dataArray['weight'] = $this->session->flashdata('weight');
        $dataArray['dcNo'] = $this->session->flashdata('dcNo');
        $dataArray['issueby'] = $this->session->flashdata('issueby');
        $dataArray['receivedby'] = $this->session->flashdata('receivedby');
        $dataArray['vehicleNo'] = $this->session->flashdata('vehicleNo');
        $this->load->view('header');
        $this->load->view('v_greighfabricreceiving', $dataArray);
        $this->load->view('footer');
    }

    function Add() {
        $greighFabricModel = new M_greighfabricreceiving();
        $greighFabricdeliveryModel = new M_greighfabricdelivery();
        $myModel = new My_Model();
        $greighFabricData = array(
            'GreighFabricReceivingNo' => $this->input->post('GreighFabricReceivingNo'),
            'ReceivingDate' => date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))),
            'ChallanNo' => $this->input->post('ChallanNo'),
            'TotalPieces' => $this->input->post('TotalPieces'),
            'TotalWeight' => $this->input->post('TotalWeight'),
            'TotalRolls' => $this->input->post('TotalRolls'),
            'AvgLbsPerDozenReceived' => $this->input->post('AvgLbsPerDozen'),
            'GramPerPieceReceived' => $this->input->post('GramPerPiece'),
            'HeavyLightPercent' => $this->input->post('HeavyLight'),
            'ReceivedBy' => $this->input->post('ReceivedBy'),
            'IssueToProcessor' => $this->input->post('confirmDelivery'),
            'party_id' => $this->input->post('PartyName'),
            'item_id' => $this->input->post('ItemCode'),
            'warehouse_id' => $this->input->post('warehouse'),
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']
        );

        $inserted = $greighFabricModel->InsertGreighFabricReceiving($greighFabricData);

        if ($inserted) {
            $gfrID = $inserted;
            $weavearLegderData = $this->GetDataForYarnLedger($inserted);
            $greighFabricModel->insertYarnledger($weavearLegderData);
            $this->insertItemLedger($gfrID);
            $this->insertItemStock($gfrID);
            $this->insertMainStock();
        }
        if ($inserted) {
            $insertItemMsg = "Successfully Inserted";
        } else {
            $insertItemMsg = "Failed to Insert";
        }

        $this->session->set_flashdata('operation', '1');
        $this->session->set_flashdata('gfrn', $inserted);
        $this->session->set_flashdata('gfdcDate', date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))));        
        $this->session->set_flashdata('item_id', $this->input->post('ItemCode'));
        $this->session->set_flashdata('warehouse_id', $this->input->post('warehouse'));
        $this->session->set_flashdata('gfdcDate', date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))));
        $this->session->set_flashdata('gfdc', $greighFabricdeliveryModel->generateGFDNumber());
        $this->session->set_flashdata('rolls', $this->input->post('TotalRolls'));
        $this->session->set_flashdata('pieces', $this->input->post('TotalPieces'));
        $this->session->set_flashdata('weight', $this->input->post('TotalWeight'));
        $this->session->set_flashdata('insertmessage', $insertItemMsg);
        redirect(base_url() . "index.php/greighfabricreceiving/index");
    }

    function Update() {
        $greighFabricModel = new M_greighfabricreceiving();
        $greighFabricdeliveryModel = new M_greighfabricdelivery();
        $myModel = new My_Model();
        $gfrID = $this->input->post('receiving_id');
        $gfdID = $this->input->post('delivery_id');
        $greighFabricData = array(
            'GreighFabricReceivingNo' => $this->input->post('GreighFabricReceivingNo'),
            'ReceivingDate' => date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))),
            'ChallanNo' => $this->input->post('ChallanNo'),
            'TotalPieces' => $this->input->post('TotalPieces'),
            'TotalWeight' => $this->input->post('TotalWeight'),
            'TotalRolls' => $this->input->post('TotalRolls'),
            'AvgLbsPerDozenReceived' => $this->input->post('AvgLbsPerDozen'),
            'GramPerPieceReceived' => $this->input->post('GramPerPiece'),
            'HeavyLightPercent' => $this->input->post('HeavyLight'),
            'ReceivedBy' => $this->input->post('ReceivedBy'),
            'IssueToProcessor' => $this->input->post('confirmDelivery'),
            'party_id' => $this->input->post('PartyName'),
            'item_id' => $this->input->post('ItemCode'),
            'warehouse_id' => $this->input->post('warehouse'),
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']
        );

        $updated = $greighFabricModel->UpdateGreighFabricReceiving($gfrID, $greighFabricData);
        
        if ($updated) {
            $weavearLegderData = $this->GetDataForYarnLedger($gfrID);
            $greighFabricModel->updateYarnledger($weavearLegderData, $gfrID);
            $this->updateItemLedger($gfrID);
            $this->updateItemStock($gfrID);
            $this->updateMainStock();
        }

        if ($updated) {
            $updateItemMsg = "Successfully Updated ";
        } else {
            $updateItemMsg = "Failed to Updated";
        }
        
        $this->session->set_flashdata('gfrn', $gfrID);
        $this->session->set_flashdata('gfdcDate', date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))));
        $this->session->set_flashdata('gfdn', $gfdID);
        $this->session->set_flashdata('item_id', $this->input->post('ItemCode'));
        $this->session->set_flashdata('warehouse_id', $this->input->post('warehouse'));
        $this->session->set_flashdata('gfdcDate', date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))));
        $greighFabricDelivery = $this->GetGreighFabricDelivery($gfrID);

        if (count($greighFabricDelivery) > 0)
        {
            $this->session->set_flashdata('gfdc', $greighFabricDelivery[0]['GreighFabricDeliveryNo']);
            $this->session->set_flashdata('operation', '2');
            $this->session->set_flashdata('dcNo', $greighFabricDelivery[0]['ChallanNo']);
            $this->session->set_flashdata('issueby', $greighFabricDelivery[0]['IssueBy']);
            $this->session->set_flashdata('receivedby', $greighFabricDelivery[0]['ReceivedBy']);
            $this->session->set_flashdata('vehicleNo', $greighFabricDelivery[0]['VehicleNo']);
        }
        else{
            $this->session->set_flashdata('gfdc', $greighFabricdeliveryModel->generateGFDNumber());
            $this->session->set_flashdata('operation', '1');
        } 
        $this->session->set_flashdata('rolls', $this->input->post('TotalRolls'));
        $this->session->set_flashdata('pieces', $this->input->post('TotalPieces'));
        $this->session->set_flashdata('weight', $this->input->post('TotalWeight'));
        $this->session->set_flashdata('updatemessage', $updateItemMsg);
        redirect(base_url() . "index.php/greighfabricreceiving/index");
    }

    function InsertGreighFabricDelivery($direct_delivery_id) {
        $greighFabricModel = new M_greighfabricdelivery();
        $greighFabricController = new GreighFabricDelivery();
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

        for ($Count = 0; $Count < count($serialNo); $Count++) {

            $totalPieces = $totalPieces + $Pieces[$Count];
            $totalWeight = $totalWeight + $Weight[$Count];
            $totalRolls = $totalRolls + $Rolls[$Count];
        }

        $greighFabricDeliveryData = array(
            'GreighFabricDeliveryNo' => $this->input->post('GFDC'),
            'DeliveryDate' => date("Y-m-d", strtotime($this->input->post('date'))),
            'ChallanNo' => $this->input->post('ChallanNoDelivery'),
            'GatePassNo' => $greighFabricModel->generateGatePassNumber(),
            'VehicleNo' => $this->input->post('VehicleNo'),
            'TotalPieces' => $totalPieces,
            'TotalWeight' => $totalWeight,
            'TotalRolls' => $totalRolls,
            'party_id' => $this->input->post('ProcessorName'),
            'direct_delivery_id' => $direct_delivery_id,
            'IssueBy' => $this->input->post('IssueBy'),
            'ReceivedBy' => $this->input->post('ReceivedByDelivery'),
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
                    'item_id' => $this->input->post('item_id'),
                    'warehouse_id' => $this->input->post('warehouse_id'),
                    'customer_order_id' => $customer_order_id[$Count],
                    'greigh_fabric_delivery_id' => $inserted,
                    'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                    'isActive' => $myModel->getFieldsValue()['isActive']
                );
            }
            $greighFabricModel->InsertGreighFabricDeliveryDetail($greighFabricDeliveryDetailData);
            $greighFabricController->insertSingleItemLedger($inserted, $totalPieces);
            $greighFabricController->insertSingleItemStock($inserted, $totalPieces);
        } else {
            $inserted = 0;
        }
        redirect(base_url() . "index.php/greighfabricreceiving/index");
    }

    function UpdateGreighFabricDelivery($direct_delivery_id) {
        $greighFabricModel = new M_greighfabricdelivery();
        $myModel = new My_Model();
        $gfdID = $this->input->post('delivery_id');
        $totalPieces = 0;
        $totalWeight = 0.00;
        $totalRolls = 0;
        $greighFabricDeliveryDetailData = array();
        $serialNo = $this->input->post('SerialNoDetail');
        $Pieces = $this->input->post('Pieces');
        $Weight = $this->input->post('Weight');
        $Rolls = $this->input->post('Rolls');
        $customer_order_id = $this->input->post('PONumber');
        
         for ($Count = 0; $Count < count($serialNo); $Count++) {

            $totalPieces = $totalPieces + $Pieces[$Count];
            $totalWeight = $totalWeight + $Weight[$Count];
            $totalRolls = $totalRolls + $Rolls[$Count];
        }
        
        $greighFabricDeliveryData = array(
            //'GreighFabricDeliveryNo' => $greighFabricModel->generateGFDNumber(),
            'DeliveryDate' => date("Y-m-d", strtotime($this->input->post('date'))),
            'ChallanNo' => $this->input->post('ChallanNoDelivery'),
            'GatePassNo' => $greighFabricModel->generateGatePassNumber(),
            'VehicleNo' => $this->input->post('VehicleNo'),
            'TotalPieces' => $totalPieces,
            'TotalWeight' => $totalWeight,
            'TotalRolls' => $totalRolls,
            'party_id' => $this->input->post('ProcessorName'),
            'direct_delivery_id' => $direct_delivery_id,
            'IssueBy' => $this->input->post('IssueBy'),
            'ReceivedBy' => $this->input->post('ReceivedByDelivery'),
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']
        );

        $updated = $greighFabricModel->UpdateGreighFabricDelivery($gfdID, $greighFabricDeliveryData);

        if ($updated) {
            for ($Count = 0; $Count < count($serialNo); $Count++) {
                $greighFabricDeliveryDetailData[] = array(
                    'Pieces' => $Pieces[$Count],
                    'Weight' => $Weight[$Count],
                    'Rolls' => $Rolls[$Count],
                    'customer_order_id' => $customer_order_id[$Count],
                    'item_id' => $this->input->post('item_id'),
                    'warehouse_id' => $this->input->post('warehouse_id'),
                    'greigh_fabric_delivery_id' => $gfdID,
                    'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                    'isActive' => $myModel->getFieldsValue()['isActive']
                );
            }
            $updated = $greighFabricModel->UpdateGreighFabricDeliveryDetail($gfdID, $greighFabricDeliveryDetailData);
        } else {
            $updated = 0;
        }
        redirect(base_url() . "index.php/greighfabricreceiving/index");
    }
    
    function GetGreighFabricDelivery($direct_delivery_id){
        $greighFabricModel = new M_greighfabricdelivery();
        $greighFabricDelivery = $greighFabricModel->getGreighFabricDelivery('direct_delivery_id', $direct_delivery_id);
        return $greighFabricDelivery;
    }

    function Delete($gfrID) {
        $greighFabricModel = new M_greighfabricreceiving();
        $greighFabricController = new GreighFabricDelivery();
        $gfrData = array(
            'isActive' => 0,
        );
        $deleted = $greighFabricModel->DeleteGreighFabricReceiving($gfrID, $gfrData);
        $deleted = $greighFabricModel->DeleteYarnLedger($gfrID);
        $deleted = $greighFabricModel->DeleteItemLedger($gfrID);
        $deleted = $greighFabricModel->DeleteItemStock($gfrID);
        $gfrNo = $greighFabricModel->GetGreighFabricReceivingNo($gfrID);         
        $deleted = $greighFabricModel->DeleteMainStock("GFR-".$gfrNo);    
        $gfdID = $this->GetGreighFabricDelivery($gfrID);
        if(count($gfdID) > 0)
        {
            $deleted = $greighFabricController->DeleteDirectDelivery($gfdID[0]['greigh_fabric_delivery_id']);
        }
        if ($deleted) {
            $deleteItemMsg = "Successfully Deleted ";
        } else {
            $deleteItemMsg = "Failed to Delete";
        }
        $this->session->set_flashdata('deletemessage', $deleteItemMsg);
        redirect(base_url() . "index.php/greighfabricreceiving/index");
    }
    
    function search() {
        $gfrModel = new M_greighfabricreceiving();
        $search = $this->input->post('search');
        $gfrSearch = $gfrModel->searchGreighFabricReceiving($search);
        $gfrData = json_encode($gfrSearch);
        echo $gfrData;
    }

    function getAverageFinishWeight() {
        //$dataArray = array( 'AvgFinishWeight' => 0.00 ); 
        $weight = $this->input->post('weight');
        $weightUnits = $this->input->post('weightUnits');
        $finishWeightUnits = $this->input->post('finishWeightUnits');
        $totalPieces = $this->input->post('totalPieces');
        $data = WeavingCalculationHelper::CalculateAverageFinishWeight($weight, $weightUnits, $finishWeightUnits, $totalPieces);
        $finishWeight = json_encode($data);
        echo $finishWeight;
    }

    function getHeavyLightPercent() {
        $weightReq = $this->input->post('weightRequired');
        $weightRecv = $this->input->post('weightReceived');
        $data = WeavingCalculationHelper::CalculateHeavyLightPercent($weightReq, $weightRecv);
        $percent = json_encode($data);
        echo $percent;
    }

    function GetDataForYarnLedger($greigh_fabric_receiving_id) {
        $itemID = $this->input->post('ItemCode');
        $weight = $this->input->post('TotalWeight');
        $weightUnits = "kgs";
        $heavyLight = $this->input->post('HeavyLight');
        $itemSpecs = new M_itemspecification();
        $itemInfo = $itemSpecs->getItemInfo($itemID);

        $weavingLossPercent = $itemInfo[0]["WeavingLossPercent"];
        $processLossPercent = $itemInfo[0]["ProcessLossPercent"];
        $pilePercent = $itemInfo[0]["PilePercent"];
        $weftPercent = $itemInfo[0]["WeftPercent"];
        $groundPercent = $itemInfo[0]["GroundPercent"];
        $consumedWeight = 0.00;
        $allowedWeight = 0.00;
        $disallowedWeight = 0.00;
        $pileDisallowed = 0.00;
        $weftDisallowed = 0.00;
        $groundDisallowed = 0.00;

        if ($heavyLight > 0) {
            $totalPieces = $this->input->post('TotalPieces');
            $averageFinishWeight = $itemInfo[0]["FinishWeight"];
            $averageFinishWeightUnits = $itemInfo[0]["FinishWeightUnit"];
            $consumedWeight = WeavingCalculationHelper::CalculateConsumedWeight($weight, $weightUnits, $weavingLossPercent, $processLossPercent);
            $allowedWeight = WeavingCalculationHelper::CalculateAllowedConsumption($totalPieces, $averageFinishWeight, $averageFinishWeightUnits, $weavingLossPercent, $processLossPercent);
            $disallowedWeight = $consumedWeight - $allowedWeight;
            $pileDisallowed = WeavingCalculationHelper::CalculateCountConsumption($pilePercent, $disallowedWeight);
            $weftDisallowed = WeavingCalculationHelper::CalculateCountConsumption($weftPercent, $disallowedWeight);            
            $groundDisallowed = WeavingCalculationHelper::CalculateCountConsumption($groundPercent, $disallowedWeight);
            //die(floatval($groundDisallowed));
            $pileConsumed = WeavingCalculationHelper::CalculateCountConsumption($pilePercent, $consumedWeight);
            $weftConsumed = WeavingCalculationHelper::CalculateCountConsumption($weftPercent, $consumedWeight);
            $groundConsumed = WeavingCalculationHelper::CalculateCountConsumption($groundPercent, $consumedWeight);

        } else {
            $consumedWeight = WeavingCalculationHelper::CalculateConsumedWeight($weight, $weightUnits, $weavingLossPercent, $processLossPercent);
            $pileConsumed = WeavingCalculationHelper::CalculateCountConsumption($pilePercent, $consumedWeight);
            $weftConsumed = WeavingCalculationHelper::CalculateCountConsumption($weftPercent, $consumedWeight);
            $groundConsumed = WeavingCalculationHelper::CalculateCountConsumption($groundPercent, $consumedWeight);
        }
        $partyID = $this->input->post('PartyName');
        $gfrID = $greigh_fabric_receiving_id;
        $transactionDate = date("Y-m-d", strtotime($this->input->post('GreighFabricDated')));
        $gfrn = $this->input->post('GreighFabricReceivingNo');
        $yarnLedgerData = array();
        if ($pileConsumed > 0) {
            $yarnLedgerData[] = array(
                'party_id' => $partyID,
                'TransactionDate' => date("Y-m-d", strtotime($transactionDate)),
                'Description' => "Allowed yarn adjusted against Greigh Fabric Receiving No.: " . $gfrn,
                'count_id' => $itemInfo[0]["pile_count_id"],
                'WeightReceived' => $pileConsumed,
                'WeightIssue' => 0.00,
                'greigh_fabric_receiving_id' => $gfrID
            );
        }
        if ($pileDisallowed > 0) {
            $yarnLedgerData[] = array(
                'party_id' => $partyID,
                'TransactionDate' => date("Y-m-d", strtotime($transactionDate)),
                'Description' => "Disallowed yarn adjusted against Greigh Fabric Receiving No.: " . $gfrn,
                'count_id' => $itemInfo[0]["pile_count_id"],
                'WeightIssue' => $pileDisallowed,
                'WeightReceived' => 0.00, 
                'greigh_fabric_receiving_id' => $gfrID
            );
        }
        if ($weftConsumed > 0) {
            $yarnLedgerData[] = array(
                'party_id' => $partyID,
                'TransactionDate' => date("Y-m-d", strtotime($transactionDate)),
                'Description' => "Allowed yarn adjusted against Greigh Fabric Receiving No.: " . $gfrn,
                'count_id' => $itemInfo[0]["weft_count_id"],
                'WeightReceived' => $weftConsumed,
                'WeightIssue' => 0.00,
                'greigh_fabric_receiving_id' => $gfrID
            );
        }
        if ($weftDisallowed > 0) {
            $yarnLedgerData[] = array(
                'party_id' => $partyID,
                'TransactionDate' => date("Y-m-d", strtotime($transactionDate)),
                'Description' => "Disallowed yarn adjusted against Greigh Fabric Receiving No.: " . $gfrn,
                'count_id' => $itemInfo[0]["weft_count_id"],
                'WeightIssue' => $weftDisallowed,
                'WeightReceived' => 0.00,
                'greigh_fabric_receiving_id' => $gfrID
            );
        }
        if ($groundConsumed > 0) {
            $yarnLedgerData[] = array(
                'party_id' => $partyID,
                'TransactionDate' => date("Y-m-d", strtotime($transactionDate)),
                'Description' => "Allowed yarn adjusted against Greigh Fabric Receiving No.: " . $gfrn,
                'count_id' => $itemInfo[0]["ground_count_id"],
                'WeightReceived' => $groundConsumed,
                'WeightIssue' => 0.00, 
                'greigh_fabric_receiving_id' => $gfrID
            );
        }
        if ($groundDisallowed > 0) {
            $yarnLedgerData[] = array(
                'party_id' => $partyID,
                'TransactionDate' => date("Y-m-d", strtotime($transactionDate)),
                'Description' => "Disallowed yarn adjusted against Greigh Fabric Receiving No.: " . $gfrn,
                'count_id' => $itemInfo[0]["ground_count_id"],
                'WeightIssue' => $groundDisallowed,
                'WeightReceived' => 0.0,
                'greigh_fabric_receiving_id' => $gfrID
            );
        }

        return $yarnLedgerData;
    }
    
    function insertItemLedger($gfrID){
        $myModel = new My_Model();
        $greighFabricModel = new M_greighfabricreceiving();
        $greighFabricData = array(
            'party_id' => $this->input->post('PartyName'),
            'item_id' => $this->input->post('ItemCode'),
            'TransactionDate' => date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))),
            'Description' => "Item received against GreighFabric Receiving No. ". $this->input->post('GreighFabricReceivingNo'),
            'ItemIssued' => 0,
            'ItemReceived' => $this->input->post('TotalPieces'),
            'greigh_fabric_receiving_id' => $gfrID,   
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'user_id' => 0
        );
        $greighFabricModel->insertItemledger($greighFabricData);
    }

    function updateItemLedger($gfrID){
        $myModel = new My_Model();
        $greighFabricModel = new M_greighfabricreceiving();
        $greighFabricData = array(
            'party_id' => $this->input->post('PartyName'),
            'item_id' => $this->input->post('ItemCode'),
            'TransactionDate' => date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))),
            'Description' => "Item received against GreighFabric Receiving No. ". $this->input->post('GreighFabricReceivingNo'),
            'ItemIssued' => 0,
            'ItemReceived' => $this->input->post('TotalPieces'),
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'user_id' => 0
        );
        $greighFabricModel->updateItemledger($greighFabricData, $gfrID);
    }
    
    function insertItemStock($gfrID){
        $myModel = new My_Model();
        $greighFabricModel = new M_greighfabricreceiving();
        $greighFabricData = array(
            'item_id' => $this->input->post('ItemCode'),
            'warehouse_id' => $this->input->post('warehouse'),
            'TransactionDate' => date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))),
            'TransactionType' => "IN",            
            'Quantity' => $this->input->post('TotalPieces'),
            'greigh_fabric_receiving_id' => $gfrID,
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'user_id' => 0
        );
        $greighFabricModel->insertItemStock($greighFabricData);
    }
    
    function updateItemStock($gfrID){
        $myModel = new My_Model();
        $greighFabricModel = new M_greighfabricreceiving();
        $greighFabricData = array(
            'item_id' => $this->input->post('ItemCode'),
            'warehouse_id' => $this->input->post('warehouse'),
            'TransactionDate' => date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))),
            'TransactionType' => "IN",            
            'Quantity' => $this->input->post('TotalPieces'),
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'user_id' => 0
        );
        $greighFabricModel->updateItemStock($greighFabricData, $gfrID);
    }
    
    function insertMainStock(){
        $myModel = new My_Model();
        $greighFabricModel = new M_greighfabricreceiving();
        $greighFabricData = array(
            'item_id' => $this->input->post('ItemCode'),
            'TransactionDate' => date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))),
            'TransactionType' => "IN",            
            'TransactionReferenceNo' => 'GFR-'.$this->input->post('GreighFabricReceivingNo'),
            'ItemQuantity' => $this->input->post('TotalPieces'),
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'user_id' => 0
        );
        $greighFabricModel->insertMainStock($greighFabricData);
    }
    
    function updateMainStock(){
        $myModel = new My_Model();
        $greighFabricModel = new M_greighfabricreceiving();
        $gfrNo = 'GFR-'.$this->input->post('GreighFabricReceivingNo');
        $greighFabricData = array(            
            'item_id' => $this->input->post('ItemCode'),
            'TransactionDate' => date("Y-m-d", strtotime($this->input->post('GreighFabricDated'))),
            'TransactionType' => "IN",            
            'ItemQuantity' => $this->input->post('TotalPieces'),
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'user_id' => 0
        );
        $greighFabricModel->updateMainStock($greighFabricData, $gfrNo);
    }
}
