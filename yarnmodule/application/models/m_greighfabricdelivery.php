<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_greighfabricdelivery extends My_Model {

    public function __construct() {

        parent::__construct();
    }
    
    function generateGFDNumber() {
        $number = $this->generateNumber('greigh_fabric_delivery', 'MAX(GreighFabricDeliveryNo)+1');
        if ($number != NULL) {
            $gfdNumber = $number;
            return $gfdNumber;
        } else {
            $gfdNumber = '1';
            return $gfdNumber;
        }
    }
    
    function generateGatePassNumber() {
        $number = $this->generateNumber('greigh_fabric_delivery', 'MAX(GatePassNo)+1');
        if ($number != NULL) {
            $gpNumber = $number;
            return $gpNumber;
        } else {
            $gpNumber = '1';
            return $gpNumber;
        }
    }
    
    function InsertGreighFabricDelivery($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('greigh_fabric_delivery', $insertionData);
        return $insert;
    }
    
    function InsertGreighFabricDeliveryDetail($GreighFabricDetailData) {

        $insert = $this->db->insert_batch('greigh_fabric_delivery_detail', $GreighFabricDetailData);
        if ($insert) {
            return True;
        } else {
            return False;
        }
    }
    
    function getAllActiveGreighFabricDeliveryInfo() {
        $this->db->select('*');
        $this->db->from('view_greighfabricdelivery_info vpi');
        $this->db->where('vpi.isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }
    
    function getGreighFabricDelivery($where, $value){
        $myModel = new My_Model();
        $whereArray = array(
            $where => $value,
            'isActive' => 1
        );
        $greighFabricDelivery = $myModel->SelectOne('greigh_fabric_delivery', $whereArray);
        return $greighFabricDelivery;
    }
    
    function UpdateGreighFabricDelivery($gfdID, $updateData) {

        $myModel = new My_Model();
        $update = $myModel->Update('greigh_fabric_delivery', $updateData, 'greigh_fabric_delivery_id', $gfdID);
        return $update;
    }
    
    function UpdateGreighFabricDeliveryDetail($gfdID, $updateData) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('greigh_fabric_delivery_detail', 'greigh_fabric_delivery_id', $gfdID);
        if ($delete) {
            $updated = $this->InsertGreighFabricDeliveryDetail($updateData);
            if ($updated) {
                return True;
            } else {
                return False;
            }
        }
    }
    
    function DeleteGreighFabricDelivery($gfdID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('greigh_fabric_delivery_detail', $deleteData, 'greigh_fabric_delivery_id', $gfdID);
        $update = $myModel->Update('greigh_fabric_delivery', $deleteData, 'greigh_fabric_delivery_id', $gfdID);
        return $update;
    }
    
    function searchGreighFabricDelivery($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('view_greighfabricdelivery_info');
        $this->db->like('GreighFabricDeliveryNo', $SearchKeyword);
        $this->db->where('isActive', 1);
        //$this->db->where('vpi.isClosed', 0);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }
    
    function insertItemledger($itemLedgerData) {
        $myModel = new My_Model();
        $insert = $myModel->Insert('item_ledger', $itemLedgerData);
        return $insert;
    }
    
    function updateItemledger($itemLedgerData, $gfdID) {
        $myModel = new My_Model();
        $update = $myModel->Update('item_ledger', $itemLedgerData, 'greigh_fabric_delivery_id', $gfdID);
        return $update;
    }
    
    function insertItemStock($itemStockData) {
        $myModel = new My_Model();
        $insert = $myModel->Insert('item_stock', $itemStockData);
        return $insert;
    }
    
    function updateItemStock($itemStockData, $gfdID) {
        $myModel = new My_Model();
        $update = $myModel->Update('item_stock', $itemStockData, 'greigh_fabric_delivery_id', $gfdID);
        return $update;
    }
    
    function DeleteItemLedger($gfrID) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('item_ledger', 'greigh_fabric_delivery_id', $gfrID);
        if ($delete) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    function DeleteItemStock($gfrID) {;
        $myModel = new My_Model();
        $delete = $myModel->Delete('item_stock', 'greigh_fabric_delivery_detail_id', $gfrID);
        if ($delete) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

}
