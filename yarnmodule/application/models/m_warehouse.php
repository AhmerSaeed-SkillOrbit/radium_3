<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_warehouse extends My_Model {

    public function __construct() {

        parent::__construct();
    }

    function Insertwarehouse($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('warehouse', $insertionData);
        if ($insert) {
            return "Successfully Inserted";
        } else {
            return "failed to insert";
        }
    }

    function Updatewarehouse($warehouseID, $updateData) {

        $myModel = new My_Model();
        $update = $myModel->Update('warehouse', $updateData, 'warehouse_id', $warehouseID);
        if ($update) {
            return "Successfully Updated";
        } else {
            return "Failed to Update";
        }
    }

    function Deletewarehouse($warehouseID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('warehouse', $deleteData, 'warehouse_id', $warehouseID);
        if ($update) {
            return "Successfully Deleted";
        } else {
            return "Failed to Delete";
        }
    }

    function searchwarehouse($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('warehouse');
        $this->db->like('warehouseName', $SearchKeyword);
        $this->db->where('isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
        
//        $get = $myModel->SelectOne('warehouse', 'isActive = 1 AND warehouse.warehouseName LIKE', $SearchKeyword);
//        return $searchData;
    }

    function getAllwarehouse() {
        $myModel = new My_Model();
        $get = $myModel->SelectOne('warehouse', 'isActive', 1);
        return $get;
    }

}
