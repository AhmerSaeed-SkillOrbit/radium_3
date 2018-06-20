<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_partycreation extends My_Model {

    public function __construct() {

        parent::__construct();
    }

    function InsertParty($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('party', $insertionData);
        if ($insert) {
            return "Successfully Inserted";
        } else {
            return "Failed to Insert";
        }
    }

    function UpdateParty($partyID, $updateData) {

        $myModel = new My_Model();
        $update = $myModel->Update('party', $updateData, 'Party_id', $partyID);
        if ($update) {
            return "Successfully Updated";
        } else {
            return "Failed to Update";
        }
    }

    function DeleteParty($partyID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('party', $deleteData, 'Party_id', $partyID);
        if ($update) {
            return "Successfully Deleted";
        } else {
            return "Failed to Delete";
        }
    }

    function searchParty($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('party p');
        $this->db->join('party_type pt', 'pt.Party_type_id = p.Party_type_id');
        $this->db->like('p.CompanyName', $SearchKeyword);
        $this->db->where('p.isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

    function getAllParty() {

        $myModel = new My_Model();
        $get = $myModel->getOrderByData('party', 'CompanyName', 'isActive');
        return $get;
    }
    
    function getAllParties() {

        $this->db->select('*');
        $this->db->from('party p');
        $this->db->join('party_type pt', 'pt.Party_type_id = p.Party_type_id');
        $this->db->where('p.isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }
    
    function getDoublingParties() {
        
        $this->db->select('Party_id, CompanyName');
        $this->db->from('party p');
        $this->db->where('p.Party_type_id = 3 and p.isActive = 1');
        $searchData = $this->db->get();
        return $searchData->result_array();
    }
    
    function getPartiesByType($partyTypeId) {
        
        $this->db->select('Party_id, CompanyName');
        $this->db->from('party p');
        $this->db->where("p.Party_type_id = '$partyTypeId' and p.isActive = 1");
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

}
