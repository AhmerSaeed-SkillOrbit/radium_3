<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_weavingcontract extends My_Model {

    public function __construct() {

        parent::__construct();
    }
    
    function generateWCNumber() {
        $number = $this->generateNumber('weaving_contract', 'MAX(WeavingContractNo)+1');
        if ($number != NULL) {
            $wcNumber = $number;
            return $wcNumber;
        } else {
            $wcNumber = '1';
            return $wcNumber;
        }
    }
    
    function InsertWeavingcontract($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('weaving_contract', $insertionData);
        return $insert;
    }
    
    function getAllActiveWeavingContractInfo() {
        $this->db->select('*');
        $this->db->from('view_weavingcontract_info vpi');
        $this->db->where('vpi.isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }
    
    function UpdateWeavingContract($wcID, $updateData) {

        $myModel = new My_Model();
        $update = $myModel->Update('weaving_contract', $updateData, 'weaving_contract_id', $wcID);
        return $update;
    }
    
    function DeleteWeavingContract($wcID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('weaving_contract', $deleteData, 'weaving_contract_id', $wcID);
        return $update;
    }
    
    function searchWevingContract($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('view_weavingcontract_info');
        $this->db->like('WeavingContractNo', $SearchKeyword);
        $this->db->where('isActive', 1);
        //$this->db->where('vpi.isClosed', 0);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

}
