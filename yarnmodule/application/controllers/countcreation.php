<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Countcreation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_countcreation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $countCreationModel = new M_countcreation();
        $dataArray['countList'] = $countCreationModel->getAllCounts();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('v_countcreation', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $countCreationModel = new M_countcreation();
        $myModel = new My_Model();
        $isExist = $myModel->isRecordExist('count', 'CountName', $this->input->post('CountName'));
        if (!$isExist) {
            $countCreationData = array(
                'CountName' => trim($this->input->post('CountName')),
                'CountType' => trim($this->input->post('CountType')),
                'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                'isActive' => $myModel->getFieldsValue()['isActive']
            );
            $insertCountCreation = $countCreationModel->InsertCount($countCreationData);
        } else {
            $insertCountCreation = "Count Name is already exist";
        }
        $this->session->set_flashdata('insertmessage', $insertCountCreation);
        redirect(base_url() . "index.php/countcreation/index");
    }

    function Update() {
        $countCreationModel = new M_countcreation();
        $myModel = new My_Model();
        $countID = $this->input->post('CountID');
        $countName = $this->input->post('CountName');
        $isExist = $myModel->isRecordUpdateExist('count', 'CountName', $countName, 'Count_id', $countID);
        if (!$isExist) {
            $countCreationData = array(
                'CountName' => trim($this->input->post('CountName')),
                'CountType' => trim($this->input->post('CountType')),
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            );
            $updateCountCreation = $countCreationModel->UpdateCount($countID, $countCreationData);
        } else {
            $updateCountCreation = "Count Name is already exist";
        }
        $this->session->set_flashdata('updatemessage', $updateCountCreation);
        redirect(base_url() . "index.php/countcreation/index");
    }

    function Delete($countID) {

        $countCreationModel = new M_countcreation();
        $countCreationData = array(
            'isActive' => 0,
        );
        $deleteCount = $countCreationModel->DeleteCount($countID, $countCreationData);
        $this->session->set_flashdata('deletemessage', $deleteCount);
        redirect(base_url() . "index.php/countcreation/index");
    }

    function search() {
        $countCreationModel = new M_countcreation();
        $search = $this->input->post('search');
        $countSearch = $countCreationModel->searchCount($search);
        $countData = json_encode($countSearch);
        echo $countData;
    }

}
