<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Partycreation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_partycreation');
        $this->load->model('m_partytype');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $partyTypeModel = new M_partytype();
        $partyModel = new M_partycreation();
        $dataArray['partyTypeCombo'] = $partyTypeModel->getAllPartyType();
        $dataArray['partyList'] = $partyModel->getAllParties();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('v_partycreation', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $partyCreationModel = new M_partycreation();
        $myModel = new My_Model();
        $isExist = $myModel->isRecordExist('party', 'CompanyName', $this->input->post('CompanyName'));
        if (!$isExist) {
            $partyCreationData = array(
                'CompanyName' => trim($this->input->post('CompanyName')),
                'ContactPerson' => trim($this->input->post('ContactPerson')),
                'Address' => trim($this->input->post('Address')),
                'Phone' => $this->input->post('ContactNumber'),
                'Fax' => trim($this->input->post('Fax')),
                'Mobile' => $this->input->post('Mobile'),
                'Email' => trim($this->input->post('Email')),
                'STRN' => trim($this->input->post('STRN')),
                'NtnNumber' => trim($this->input->post('NtnNumber')),
                'Party_type_id' => $this->input->post('idPartyType'),
                'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                'isActive' => $myModel->getFieldsValue()['isActive']
            );
            $insertPartyCreation = $partyCreationModel->InsertParty($partyCreationData);
        } else {
            $insertPartyCreation = "Party of this Name is already exist";
        }
        $this->session->set_flashdata('insertmessage', $insertPartyCreation);
        redirect(base_url() . "index.php/partycreation/index");
    }

    function Update() {
        $partyCreationModel = new M_partycreation();
        $myModel = new My_Model();
        $partyID = $this->input->post('PartyID');
        $companyName = $this->input->post('CompanyName');
        $isExist = $myModel->isRecordUpdateExist('party', 'CompanyName', $companyName, 'Party_id', $partyID);
        if (!$isExist) {
            $partyCreationData = array(
                'CompanyName' => trim($this->input->post('CompanyName')),
                'ContactPerson' => trim($this->input->post('ContactPerson')),
                'Address' => trim($this->input->post('Address')),
                'Phone' => $this->input->post('ContactNumber'),
                'Fax' => trim($this->input->post('Fax')),
                'Mobile' => $this->input->post('Mobile'),
                'Email' => trim($this->input->post('Email')),
                'STRN' => trim($this->input->post('STRN')),
                'NtnNumber' => $this->input->post('NtnNumber'),
                'Party_type_id' => $this->input->post('idPartyType'),
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            );
            $updatePartyCreation = $partyCreationModel->UpdateParty($partyID, $partyCreationData);
        } else {
            $updatePartyCreation = "Party of this Name is already exist";
        }
        $this->session->set_flashdata('updatemessage', $updatePartyCreation);
        redirect(base_url() . "index.php/partycreation/index");
    }

    function Delete($partyID) {
        $partyCreationModel = new M_partycreation();
        $partyCreationData = array(
            'isActive' => 0,
        );
        $deletePartyCreation = $partyCreationModel->DeleteParty($partyID, $partyCreationData);
        $this->session->set_flashdata('deletemessage', $deletePartyCreation);
        redirect(base_url() . "index.php/partycreation/index");
    }

    function search() {
        $partyCreationModel = new M_partycreation();
        $search = $this->input->post('search');
        $partyCreationSearch = $partyCreationModel->searchParty($search);
        $partyCreationData = json_encode($partyCreationSearch);
        echo $partyCreationData;
    }

}
