<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_processedfabricreceiving extends My_Model {

    public function __construct() {

        parent::__construct();
    }

    function generatePFRNumber() {
        $number = $this->generateNumber('processed_fabric_receiving', 'MAX(ProcessedFabricReceivingNo)+1');
        if ($number != NULL) {
            $gfdNumber = $number;
            return $gfdNumber;
        } else {
            $gfdNumber = '1';
            return $gfdNumber;
        }
    }

    function InsertProcessedFabricReceiving($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('processed_fabric_receiving', $insertionData);
        return $insert;
    }

    function InsertProcessedFabricReceivingDetail($ProcessedFabricReceivingDetailData) {

        $insert = $this->db->insert_batch('processed_fabric_receiving_detail', $ProcessedFabricReceivingDetailData);
        if ($insert) {
            return True;
        } else {
            return False;
        }
    }

    function getAllActiveProcessedFabricReceivingInfo() {
        $this->db->select('*');
        $this->db->from('view_processedfabricreceiving_info vpi');
        $this->db->where('vpi.isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

    function getProcessedFabricReceiving($where, $value) {
        $myModel = new My_Model();
        $whereArray = array(
            $where => $value,
            'isActive' => 1
        );
        $processedFabricReceiving = $myModel->SelectOne('processed_fabric_receiving', $whereArray);
        return $processedFabricReceiving;
    }

    function UpdateProcessedFabricReceiving($pfrID, $updateData) {

        $myModel = new My_Model();
        $update = $myModel->Update('processed_fabric_receiving', $updateData, 'processed_fabric_receiving_id', $pfrID);
        return $update;
    }

    function UpdateProcessedFabricReceivingDetail($pfrID, $updateData) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('processed_fabric_receiving_detail', 'processed_fabric_receiving_id', $pfrID);
        if ($delete) {
            $updated = $this->InsertProcessedFabricReceivingDetail($updateData);
            if ($updated) {
                return True;
            } else {
                return False;
            }
        }
    }

    function DeleteGreighFabricDelivery($pfrID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('processed_fabric_receiving', $deleteData, 'processed_fabric_receiving_id', $pfrID);
        $update = $myModel->Update('processed_fabric_receiving_detail', $deleteData, 'processed_fabric_receiving_id', $pfrID);
        return $update;
    }

    function searchProcessedFabricReceiving($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('view_processedfabricreceiving_info');
        $this->db->like('ProcessedFabricReceivingNo', $SearchKeyword);
        $this->db->where('isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

    function insertItemledger($itemLedgerData) {
        $myModel = new My_Model();
        $insert = $myModel->Insert('item_ledger', $itemLedgerData);
        return $insert;
    }

    function updateItemledger($itemLedgerData, $pfrId) {
        $myModel = new My_Model();
        
        $update = $myModel->Update('item_ledger', $itemLedgerData, 'processed_fabric_receiving_id', $pfrId);
        return $update;
    }

    function insertItemStock($itemStockData) {
        $myModel = new My_Model();
        $insert = $myModel->Insert('item_stock', $itemStockData);
        return $insert;
    }

    function updateItemStock($itemStockData, $pfrId) {
        $myModel = new My_Model();
        $update = $myModel->Update('item_stock', $itemStockData, 'processed_fabric_receiving_detail_id', $pfrId);
        return $update;
    }

    function DeleteItemLedger($gfrID) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('item_ledger', 'greigh_fabric_delivery_id', $gfrID);
        if ($delete) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function DeleteItemStock($gfrID) {
;
        $myModel = new My_Model();
        $delete = $myModel->Delete('item_stock', 'greigh_fabric_delivery_detail_id', $gfrID);
        if ($delete) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function insertMainStock($mainStockData) {
        $myModel = new My_Model();
        $insert = $myModel->Insert('item_main_stock', $mainStockData);
        return $insert;
    }

    function updateMainStock($mainStockData, $gfrNo) {
        $myModel = new My_Model();
        $update = $myModel->Update('item_main_stock', $mainStockData, 'TransactionReferenceNo', $gfrNo);
        return $update;
    }

}
