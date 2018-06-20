<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_itemspecification extends My_Model {

    public function __construct() {

        parent::__construct();
    }
    
    function InsertItemSpecifications($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('item_specification', $insertionData);
        return $insert;
    }
    
    function UpdateItemSpecifications($itemID, $updateData) {

        $myModel = new My_Model();
        $update = $myModel->Update('item_specification', $updateData, 'item_id', $itemID);
        return $update;
    }
    
    function DeleteItemSpecifications($itemID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('item_specification', $deleteData, 'item_id', $itemID);
        return $update;
    }
    
    function searchItemSpecs($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('item_specification');
        $this->db->like('ItemCode', $SearchKeyword);
        $this->db->where('isActive', 1);
        //$this->db->where('vpi.isClosed', 0);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }
    
    function getAllItems() {
//        $myModel = new My_Model();
//        $get = $myModel->getOrderByData('item_specification', 'ItemCode', 'isActive');
//        return $get;
        
        $this->db->select('*');
        $this->db->from('item_specification');
        $this->db->where('isActive', 1);
        $this->db->order_by('ItemCode');
        $searchData = $this->db->get();
        return $searchData->result_array();
    }
    
    function getItemInfo($ItemID) {
        $this->db->select('*');
        $this->db->from('view_itemspecs_info');
        $this->db->where('item_id', $ItemID);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

}
