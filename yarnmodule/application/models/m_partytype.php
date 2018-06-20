<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_partytype extends My_Model {

    public function __construct() {

        parent::__construct();
    }

    function InsertPartyType($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('party_type', $insertionData);
        if ($insert) {
            return "Successfully Inserted";
        } else {
            return "failed to insert";
        }
    }

    function UpdatePartyType($party_typeID, $updateData) {

        $myModel = new My_Model();
        $update = $myModel->Update('party_type', $updateData, 'Party_type_id', $party_typeID);
        if ($update) {
            return "Successfully Updated";
        } else {
            return "Failed to Update";
        }
    }

    function DeletePartyType($party_typeID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('party_type', $deleteData, 'Party_type_id', $party_typeID);
        if ($update) {
            return "Successfully Deleted";
        } else {
            return "Failed to Delete";
        }
    }

    function searchPartyType($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('party_type');
        $this->db->like('PartyTypeName', $SearchKeyword);
        $this->db->where('isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();

//        $myModel = new My_Model();
//        $get = $myModel->SelectOne('party_type', 'isActive = 1 AND party_type.PartyTypeName LIKE', $SearchKeyword);
//        return $get;
    }

    function getAllPartyType() {
        $myModel = new My_Model();
        $get = $myModel->getOrderByData('party_type', 'PartyTypeName', 'isActive');
        return $get;
    }

}
