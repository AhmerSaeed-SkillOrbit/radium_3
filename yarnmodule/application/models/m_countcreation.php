<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_countcreation extends My_Model {

    public function __construct() {

        parent::__construct();
    }

    function InsertCount($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('count', $insertionData);
        if ($insert) {
            return "Successfully Inserted";
        } else {
            return "Failed to Insert";
        }
    }

    function UpdateCount($countID, $updateData) {

        $myModel = new My_Model();
        $update = $myModel->Update('count', $updateData, 'Count_id', $countID);
        if ($update) {
            return "Successfully Updated";
        } else {
            return "Failed to Update";
        }
    }

    function DeleteCount($countID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('count', $deleteData, 'Count_id', $countID);
        if ($update) {
            return "Successfully Deleted";
        } else {
            return "Failed to Delete";
        }
    }

    function searchCount($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('count');
        $this->db->like('CountName', $SearchKeyword);
        $this->db->where('isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();

//        $myModel = new My_Model();
//        $get = $myModel->SelectOne('count', 'isActive = 1 AND count.CountName =', $SearchKeyword);
//        return $get;
    }

    function getAllCount() {
        $myModel = new My_Model();
        $get = $myModel->getOrderByData('count', 'CountName', 'isActive');
        return $get;
    }
    
     function getAllCounts() {

        $this->db->select('*');
        $this->db->from('count');
        $this->db->where('isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

}
