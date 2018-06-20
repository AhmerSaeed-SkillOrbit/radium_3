<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Weavingcontract extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Karachi");
        $this->load->model('m_itemspecification');
        $this->load->model('m_partycreation');
        $this->load->model('m_weavingcontract');
    }

    function index() {
        $dataArray = array();
        $itemSpecsModel = new M_itemspecification();
        $weavingContractModel = new M_weavingcontract();
        $myModel = new My_Model();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $dataArray['wcNumber'] = $weavingContractModel->generateWCNumber();
        $dataArray['itemList'] = $itemSpecsModel->getAllItems();
        $dataArray['partyList'] = $myModel->getPartyType('WEAVING');
        $dataArray['wcList'] = $weavingContractModel->getAllActiveWeavingContractInfo();
        $this->load->view('header');
        $this->load->view('v_weavingcontract', $dataArray);
        $this->load->view('footer');
    }
    
    function Add() {
        $contractModel = new M_weavingcontract();
        $myModel = new My_Model();
        $weavingContractData = array (
            'WeavingContractNo' => $this->input->post('ContractNo'),
            'ContractDate' => date("Y-m-d", strtotime($this->input->post('WeavingContractDated'))),
            'OrderQunatity' => $this->input->post('OrderQuantity'),
            'party_id' => $this->input->post('PartyName'),
            'item_id' => $this->input->post('ItemCode'),
            //'TotalBags' => $this->input->post(''),
            //'ImagePath' => $this->input->post(''),
            'isClosed' => 0,
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']          
        );   
        
        $inserted = $contractModel->InsertWeavingcontract($weavingContractData);
        if ($inserted) {
            $insertItemMsg = "Successfully Inserted ";
        } else {
            $insertItemMsg = "Failed to Insert";
        }
        $this->session->set_flashdata('insertmessage', $insertItemMsg);
        redirect(base_url() . "index.php/weavingcontract/index");
    }
    
    function Update() {
        $contractModel = new M_weavingcontract();
        $myModel = new My_Model();
        $wcID = $this->input->post('weaving_contract_id');
        $weavingContractData = array (
            'WeavingContractNo' => $this->input->post('ContractNo'),
            'ContractDate' => date("Y-m-d", strtotime($this->input->post('WeavingContractDated'))),
            'OrderQunatity' => $this->input->post('OrderQuantity'),
            'party_id' => $this->input->post('PartyName'),
            'item_id' => $this->input->post('ItemCode'),
            //'TotalBags' => $this->input->post(''),
            //'ImagePath' => $this->input->post(''),
            'isClosed' => 0,
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']          
        );   
        
        $updated = $contractModel->UpdateWeavingContract($wcID, $weavingContractData );
        if ($updated) {
            $updateItemMsg = "Successfully Updated ";
        } else {
            $updateItemMsg = "Failed to Updated";
        }
        $this->session->set_flashdata('updatemessage', $updateItemMsg);
        redirect(base_url() . "index.php/weavingcontract/index");
    }
    
     function Delete($wcID) {
        $contractModel = new M_weavingcontract();
        $wcData = array(
            'isActive' => 0,
        );
        $deleted = $contractModel->DeleteWeavingContract($wcID, $wcData);
        if ($deleted) {
            $deleteItemMsg = "Successfully Deleted ";
        } else {
            $deleteItemMsg = "Failed to Delete";
        }
        $this->session->set_flashdata('deletemessage', $deleteItemMsg);
        redirect(base_url() . "index.php/weavingcontract/index");
    }
    
    function search() {
        $wcModel = new M_weavingcontract();
        $search = $this->input->post('search');
        $wcSearch = $wcModel->searchWevingContract($search);
        $wcData = json_encode($wcSearch);
        echo $wcData;
    }

    function printReport($contractNo, $itemId) {
        $dataArray = array();
        $wcModel = new M_weavingcontract();
        $itemSpecsModel = new M_itemspecification();
        $weavingContractDetails = $wcModel->searchWevingContract($contractNo);
        $itemInfo = $itemSpecsModel->getItemInfo($itemId);
        $dataArray['weavingContractDetails'] = $weavingContractDetails;
        $dataArray['itemInfo'] = $itemInfo;
        $this->load->view('v_rpt_weavingcontract', $dataArray);
    }
}
