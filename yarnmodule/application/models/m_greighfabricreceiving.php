<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_greighfabricreceiving extends My_Model {

    public function __construct() {

        parent::__construct();
    }
    
    function generateGFRNumber() {
        $number = $this->generateNumber('greigh_fabric_receiving', 'MAX(GreighFabricReceivingNo)+1');
        if ($number != NULL) {
            $gfrNumber = $number;
            return $gfrNumber;
        } else {
            $gfrNumber = '1';
            return $gfrNumber;
        }
    }
    
    function GetGreighFabricReceivingNo($gfrID){
        $this->db->select('GreighFabricReceivingNo');
        $this->db->from('greigh_fabric_receiving gfr');
        $this->db->where('gfr.greigh_fabric_receiving_id', $gfrID);
        $searchData = $this->db->get();
        if ($searchData->num_rows() > 0) {
            $row = $searchData->row();
            $gfrNo = $row->GreighFabricReceivingNo;
        } else {
            $gfrNo = 0;
        }        
        return $gfrNo;
    }
            
    function InsertGreighFabricReceiving($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('greigh_fabric_receiving', $insertionData);
        return $insert;
    }
    
    function getAllActiveGreighFabricReceivingInfo() {
        $this->db->select('*');
        $this->db->from('view_greighfabricreceiving_info vpi');
        $this->db->where('vpi.isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }
    
    function UpdateGreighFabricReceiving($gfrID, $updateData) {

        $myModel = new My_Model();
        $update = $myModel->Update('greigh_fabric_receiving', $updateData, 'greigh_fabric_receiving_id', $gfrID);
        return $update;
    }
    
    function DeleteGreighFabricReceiving($gfrID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('greigh_fabric_receiving', $deleteData, 'greigh_fabric_receiving_id', $gfrID);
        return $update;
    }
    
    function searchGreighFabricReceiving($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('view_greighfabricreceiving_info');
        $this->db->like('GreighFabricReceivingNo', $SearchKeyword);
        $this->db->where('isActive', 1);
        //$this->db->where('vpi.isClosed', 0);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }
    
     function insertYarnledger($yarnLedgerData) {
        $addLedger = $this->db->insert_batch('yarn_ledger', $yarnLedgerData);
        if ($addLedger) {
            return True;
        } else {
            return False;
        }
    }
    
    function updateYarnledger($yarnLedgerData, $gfrID) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('yarn_ledger', 'greigh_fabric_receiving_id', $gfrID);
        if ($delete) {
            $updateLedger = $this->db->insert_batch('yarn_ledger', $yarnLedgerData);
        } else {
            return False;
        }        
        if ($updateLedger) {
            return True;
        } else {
            return False;
        }
    }
    
    function insertItemledger($itemLedgerData) {
        $myModel = new My_Model();
        $insert = $myModel->Insert('item_ledger', $itemLedgerData);
        return $insert;
    }
    
    function updateItemledger($itemLedgerData, $gfrID) {
        $myModel = new My_Model();
        $update = $myModel->Update('item_ledger', $itemLedgerData, 'greigh_fabric_receiving_id', $gfrID);
        return $update;
    }
    
    function insertItemStock($itemStockData) {
        $myModel = new My_Model();
        $insert = $myModel->Insert('item_stock', $itemStockData);
        return $insert;
    }
    
    function updateItemStock($itemStockData, $gfrID) {
        $myModel = new My_Model();
        $update = $myModel->Update('item_stock', $itemStockData, 'greigh_fabric_receiving_id', $gfrID);
        return $update;
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
        
    function DeleteYarnLedger($gfrID) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('yarn_ledger', 'greigh_fabric_receiving_id', $gfrID);
        if ($delete) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    function DeleteItemLedger($gfrID) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('item_ledger', 'greigh_fabric_receiving_id', $gfrID);
        if ($delete) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    function DeleteItemStock($gfrID) {;
        $myModel = new My_Model();
        $delete = $myModel->Delete('item_stock', 'greigh_fabric_receiving_id', $gfrID);
        if ($delete) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
     function DeleteMainStock($gfrNo) {;
        $myModel = new My_Model();
        $delete = $myModel->Delete('item_main_stock', 'TransactionReferenceNo', $gfrNo);
        if ($delete) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
}
