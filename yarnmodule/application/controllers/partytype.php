<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Partytype extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_partytype');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {
        $partyTypeModel = new M_partytype();
        $dataArray = array();
        $dataArray['partyTypelist'] = $partyTypeModel->getAllPartyType();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('v_partytype', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $partyTypeModel = new M_partytype();
        $myModel = new My_Model();
        $isExist = $myModel->isRecordExist('party_type', 'PartyTypeName', $this->input->post('PartyType'));
        if (!$isExist) {
            $partyTypeData = array(
                'PartyTypeName' => trim($this->input->post('PartyType')),
                'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                'isActive' => $myModel->getFieldsValue()['isActive']
            );
            $insertPartyType = $partyTypeModel->InsertPartyType($partyTypeData);
        } else {
            $insertPartyType = "Party Type is already exist";
        }
        $this->session->set_flashdata('insertmessage', $insertPartyType);
        redirect(base_url() . "index.php/partytype/index");
    }

    function Update() {
        $partyTypeModel = new M_partytype();
        $myModel = new My_Model();
        $partyTypeID = $this->input->post('PartyTypeID');
        $partyTypeName = trim($this->input->post('PartyType'));
        $isExist = $myModel->isRecordUpdateExist('party_type', 'PartyTypeName', $partyTypeName, 'Party_type_id', $partyTypeID);
        if (!$isExist) {
            $partyTypeData = array(
                'PartyTypeName' => $this->input->post('PartyType'),
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            );
            $updatePartyType = $partyTypeModel->UpdatePartyType($partyTypeID, $partyTypeData);
        } else {
            $updatePartyType = "Party Type is already exist";
        }
        $this->session->set_flashdata('updatemessage', $updatePartyType);
        redirect(base_url() . "index.php/partytype/index");
    }

    function Delete($partyTypeID) {

        $partyTypeModel = new M_partytype();
        $partyTypeData = array(
            'isActive' => 0,
        );
        $deletePartyType = $partyTypeModel->DeletePartyType($partyTypeID, $partyTypeData);
        $this->session->set_flashdata('deletemessage', $deletePartyType);
        redirect(base_url() . "index.php/partytype/index");
    }

    function search() {
        $partyTypeModel = new M_partytype();
        $search = $this->input->post('search');
        $partyTypeSearch = $partyTypeModel->searchPartyType($search);
        $partyTypeData = json_encode($partyTypeSearch);
        echo $partyTypeData;
    }

}
