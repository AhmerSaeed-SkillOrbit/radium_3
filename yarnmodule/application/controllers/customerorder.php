<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CustomerOrder extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Karachi");
        $this->load->model('m_itemspecification');
        $this->load->model('m_customerorder');
    }

    function index() {
        $this->dataArray = array();
        $customerOrderModel = new M_customerorder();
        $itemSpecsModel = new M_itemspecification();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        //$dataArray['poNumber'] = $customerOrderModel->generatePONumber();
        $dataArray['coList'] = $customerOrderModel->getAllActiveCustomerOrderInfo();
        $dataArray['itemList'] = $itemSpecsModel->getAllItems();
        $this->load->view('header');
        $this->load->view('v_customerorder', $dataArray);
        $this->load->view('footer');
    }
    
    function Add() {
        $customerOrderModel = new M_customerorder();
        $myModel = new My_Model();
        
        $customerOrderData = array (
            'CustomerPO' => $this->input->post('customerPO'),
            'PremierPO' => $this->input->post('premierPO'),
            'OrderDate' => date("Y-m-d", strtotime($this->input->post('CustomerOrderDated'))),
            'TotalFinishQuantity' => trim(str_replace(',', '', $this->input->post('TotalFinishQuantity'))),
            'TotalWeavingPieces' => trim(str_replace(',', '', $this->input->post('TotalWeavingPieces'))),
            'TotalPOValue' => trim(str_replace(',', '', $this->input->post('TotalPOValue'))),
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']          
        );   
        
        $inserted = $customerOrderModel->InsertCustomerOrder($customerOrderData);
        $customerOrderID = $inserted;
        
        $customerOrderDetail = array();
        $serialNo = $this->input->post('SerialNoDetail');
        $customerItemNo = $this->input->post('CustomerItemNo');
        $item_id = $this->input->post('ItemCode');
        $FinishQuantity = $this->input->post('FinishQuantity');
        $FinishQuantityUnit = $this->input->post('FinishQuantityUnit');
        $dozenPerBale = $this->input->post('DozenPerBale');
        $totalDozen = $this->input->post('TotalBales');
        $BPercent = $this->input->post('BPercent');
        $WeavingQuantity = $this->input->post('WeavingQuantity');
        $AdditionalRequirement = $this->input->post('AdditionalRequirement');
        $ExcessAvailable = $this->input->post('ExcessAvailable');
        $TotalQuantity = $this->input->post('TotalQuantity');
        $Rate = $this->input->post('Rate');
        $RateUnit = $this->input->post('RateUnit');
        
        
        for ($Count = 0; $Count < count($serialNo); $Count++) {
           $customerOrderDetail[] = array(
                'customer_order_id' => $customerOrderID,
                'CustomerItemNo' => $customerItemNo[$Count],
                'item_id' => $item_id[$Count],
                'FinishQuantity' => $FinishQuantity[$Count],
                'FinishQuantityUnit' => $FinishQuantityUnit[$Count],
                'DozenPerBale' => $dozenPerBale[$Count],
                'TotalBales' => $totalDozen[$Count],
                'BPercent' => $BPercent[$Count],
                'WeavingQuantity' => $WeavingQuantity[$Count],
                'AdditionalRequirement' => $AdditionalRequirement[$Count],
                'ExcessAvailable' => $ExcessAvailable[$Count],
                'TotalWeavingQuantity' => $TotalQuantity[$Count],
                'Rate' => $Rate[$Count],
                'RateUnit' => $RateUnit[$Count],
                'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                'isActive' => $myModel->getFieldsValue()['isActive']
            );
         }
         
        $inserted = $customerOrderModel->InsertCustomerOrderDetail($customerOrderDetail);
        
        if ($inserted) {
            $insertItemMsg = "Successfully Inserted ";
        } else {
            $insertItemMsg = "Failed to Insert";
        }
        $this->session->set_flashdata('insertmessage', $insertItemMsg);
        redirect(base_url() . "index.php/customerorder/index");
    }
    
    function Update() {
        $customerOrderModel = new M_customerorder();
        $myModel = new My_Model();
        $coID = $this->input->post('customer_order_id');
        $customerOrderData = array (
            'CustomerPO' => $this->input->post('customerPO'),
            'PremierPO' => $this->input->post('premierPO'),
            'OrderDate' => date("Y-m-d", strtotime($this->input->post('CustomerOrderDated'))),
            'TotalFinishQuantity' => trim(str_replace(',', '', $this->input->post('TotalFinishQuantity'))),
            'TotalWeavingPieces' => trim(str_replace(',', '', $this->input->post('TotalWeavingPieces'))),
            'TotalPOValue' => trim(str_replace(',', '', $this->input->post('TotalPOValue'))),
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']          
        );   
        
        $customerOrderDetail = array();
        $serialNo = $this->input->post('SerialNoDetail');
        $customerItemNo = $this->input->post('CustomerItemNo');
        $item_id = $this->input->post('ItemCode');
        $FinishQuantity = $this->input->post('FinishQuantity');
        $FinishQuantityUnit = $this->input->post('FinishQuantityUnit');
        $dozenPerBale = $this->input->post('DozenPerBale');
        $totalDozen = $this->input->post('TotalBales');
        $BPercent = $this->input->post('BPercent');
        $WeavingQuantity = $this->input->post('WeavingQuantity');
        $AdditionalRequirement = $this->input->post('AdditionalRequirement');
        $ExcessAvailable = $this->input->post('ExcessAvailable');
        $TotalQuantity = $this->input->post('TotalQuantity');
        $Rate = $this->input->post('Rate');
        $RateUnit = $this->input->post('RateUnit');
        
        
        for ($Count = 0; $Count < count($serialNo); $Count++) {
           $customerOrderDetail[] = array(
                'customer_order_id' => $coID,
                'CustomerItemNo' => $customerItemNo[$Count],
                'item_id' => $item_id[$Count],
                'FinishQuantity' => $FinishQuantity[$Count],
                'FinishQuantityUnit' => $FinishQuantityUnit[$Count],
                'DozenPerBale' => $dozenPerBale[$Count],
                'TotalBales' => $totalDozen[$Count],
                'BPercent' => $BPercent[$Count],
                'WeavingQuantity' => $WeavingQuantity[$Count],
                'AdditionalRequirement' => $AdditionalRequirement[$Count],
                'ExcessAvailable' => $ExcessAvailable[$Count],
                'TotalWeavingQuantity' => $TotalQuantity[$Count],
                'Rate' => $Rate[$Count],
                'RateUnit' => $RateUnit[$Count],
                'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                'isActive' => $myModel->getFieldsValue()['isActive']
            );
         }
         
        $updated = $customerOrderModel->UpdateCustomerOrder($coID, $customerOrderData );
        
        $updated = $customerOrderModel->UpdateCustomerOrderDetail($coID, $customerOrderDetail );
        
        if ($updated) {
            $updateItemMsg = "Successfully Updated ";
        } else {
            $updateItemMsg = "Failed to Updated";
        }
        $this->session->set_flashdata('updatemessage', $updateItemMsg);
        redirect(base_url() . "index.php/customerorder/index");
    }
    
     function Delete($coID) {
        $customerOrderModel = new M_customerorder();
        $coData = array(
            'isActive' => 0,
        );
        $deleted = $customerOrderModel->DeleteCustomerOrder($coID, $coData);
        if ($deleted) {
            $deleteItemMsg = "Successfully Deleted ";
        } else {
            $deleteItemMsg = "Failed to Delete";
        }
        $this->session->set_flashdata('deletemessage', $deleteItemMsg);
        redirect(base_url() . "index.php/customerorder/index");
    }
    
    function search() {
        $customerOrderModel = new M_customerorder();
        $search = $this->input->post('search');
        $coSearch = $customerOrderModel->searchCustomerOrder($search);
        $coData = json_encode($coSearch);
        echo $coData;
    }

}
