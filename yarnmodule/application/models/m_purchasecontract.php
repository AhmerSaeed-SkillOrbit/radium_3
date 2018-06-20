<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_purchasecontract extends My_Model {

    public function __construct() {

        parent::__construct();
    }

    function InsertPurchaseContract($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('purchase_contract', $insertionData);
        if ($insert) {
            return "Successfully Inserted ";
        } else {
            return "Failed to Insert";
        }
    }

    function UpdatePurchaseContract($purchase_contractID, $updateData) {

        $myModel = new My_Model();
        $update = $myModel->Update('purchase_contract', $updateData, 'Purchase_contract_id', $purchase_contractID);
        if ($update) {
            return "Successfully Updated";
        } else {
            return "Failed to Update";
        }
    }

    function DeletePurchaseContract($purchase_contractID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('purchase_contract', $deleteData, 'Purchase_contract_id', $purchase_contractID);
        if ($update) {
            return "Successfully Deleted";
        } else {
            return "Failed to Delete";
        }
    }

    function searchPurchaseContract($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('view_purchasecontract_info vpi');
        $this->db->like('vpi.PurchaseContractNo', $SearchKeyword);
        $this->db->where('vpi.isActive', 1);
        //$this->db->where('vpi.isClosed', 0);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

    function notClosedPurchaseContract($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('view_purchasecontract_info vpi');
        $this->db->like('vpi.PurchaseContractNo', $SearchKeyword);
        $this->db->where('vpi.isClosed', 0);
        $this->db->where('vpi.isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

    function getAllPurchaseContract() {
        $myModel = new My_Model();
        $get = $myModel->SelectOne('purchase_contract', 'isActive', 1);
        return $get;
    }
    
     function getAllActivePurchaseContractInfo() {
        $this->db->select('*');
        $this->db->from('view_purchasecontract_info vpi');
        $this->db->where('vpi.isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

    function getAllOpenedPurchaseContract() {
        $this->db->select('*');
        $this->db->from('view_purchasecontract_info vpi');
        $this->db->where('vpi.isClosed', 0);
        $this->db->where('vpi.isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

    function generatePCNumber() {
        $number = $this->generateNumber('purchase_contract', 'MAX(PurchaseContractNo)+1');
        if ($number != NULL) {
            $pcNumber = $number;
            return $pcNumber;
        } else {
            $pcNumber = '1';
            return $pcNumber;
        }
    }

}
