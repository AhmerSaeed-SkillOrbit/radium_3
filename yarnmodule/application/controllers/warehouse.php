<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Warehouse extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_warehouse');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $warehouseModel = new M_warehouse();
        $dataArray['warehouseList'] = $warehouseModel->getAllwarehouse();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('v_warehouse', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $warehouseModel = new M_warehouse();
        $myModel = new My_Model();
        $isExist = $myModel->isRecordExist('warehouse', 'WarehouseName', $this->input->post('warehousename'));
        if (!$isExist) {
            $warehouseData = array(
                'WarehouseName' => $this->input->post('warehousename'),
				'WarehouseAddress' => $this->input->post('warehouseadd'),
                'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                'isActive' => $myModel->getFieldsValue()['isActive']
            );
            $insertwarehouse = $warehouseModel->Insertwarehouse($warehouseData);
        } else {
            $insertwarehouse = "Warehouse with this name already exist";
        }
        $this->session->set_flashdata('insertmessage', $insertwarehouse);
        redirect(base_url() . "index.php/warehouse/index");
    }

    function Update() {
        $warehouseModel = new M_warehouse();
        $myModel = new My_Model();
        $warehouseID = $this->input->post('warehouseID');
        $warehouseName = $this->input->post('warehousename');
        $isExist = $myModel->isRecordUpdateExist('warehouse', 'WarehouseName', $warehouseName, 'Warehouse_id', $warehouseID);
        if (!$isExist) {
            $warehouseData = array(
                'WarehouseName' => $this->input->post('warehousename'),
                'WarehouseAddress' => $this->input->post('warehouseadd'),
				'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
			);
            $updatewarehouse = $warehouseModel->Updatewarehouse($warehouseID, $warehouseData);
        } else {
            $updatewarehouse = "Warehouse with this name already exist";
        }
        $this->session->set_flashdata('updatemessage', $updatewarehouse);
        redirect(base_url() . "index.php/warehouse/index");
    }

    function Delete($warehouseID) {

        $warehouseModel = new M_warehouse();
        $warehouseData = array(
            'isActive' => 0,
        );
        $deletewarehouse = $warehouseModel->Deletewarehouse($warehouseID, $warehouseData);
        $this->session->set_flashdata('deletemessage', $deletewarehouse);
        redirect(base_url() . "index.php/warehouse/index");
    }

    function search() {
        $warehouseModel = new M_warehouse();
        $search = $this->input->post('search');
        $warehouseSearch = $warehouseModel->searchwarehouse($search);
        $warehouseData = json_encode($warehouseSearch);
        echo $warehouseData;
    }

}
