<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_customerorder extends My_Model {

    public function __construct() {

        parent::__construct();
    }
    
    function generatePONumber() {
        $number = $this->generateNumber('customer_order', 'MAX(PremierPO)+1');
        if ($number != NULL) {
            $poNumber = $number;
            return $poNumber;
        } else {
            $poNumber = '1';
            return $poNumber;
        }
    }
    
    function InsertCustomerOrder($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('customer_order', $insertionData);
        return $insert;
    }
    
    function InsertCustomerOrderDetail($insertionData) {

        $myModel = new My_Model();
        $insert = $this->db->insert_batch('customer_order_detail', $insertionData);
        return $insert;
    }
    
    function getAllActiveCustomerOrderInfo() {
        $this->db->select('*');
        $this->db->from('view_customerorder_info');
        $searchData = $this->db->get();
        return $searchData->result_array();
    }
    
    function UpdateCustomerOrder($customerOrderID, $updateData) {

        $myModel = new My_Model();
        $update = $myModel->Update('customer_order', $updateData, 'customer_order_id', $customerOrderID);
        return $update;
    }
    
    function UpdateCustomerOrderDetail($customerOrderID, $updateData) {

        $myModel = new My_Model();
        $delete = $myModel->Delete('customer_order_detail', 'customer_order_id', $customerOrderID);
        if($delete) {
            $update = $this->db->insert_batch('customer_order_detail', $updateData);
        }
        return $update;
    }
    
    function DeleteCustomerOrder($customerOrderID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('customer_order', $deleteData, 'customer_order_id', $customerOrderID);
        $update = $myModel->Update('customer_order_detail', $deleteData, 'customer_order_id', $customerOrderID);
        return $update;
    }
    
    function searchCustomerOrder($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('view_customerorder_info');
        $this->db->where('PremierPO', $SearchKeyword);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

}
