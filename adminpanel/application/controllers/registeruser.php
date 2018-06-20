<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Registeruser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_registeruser');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $registerUserModel = new M_registeruser();
        $dataArray['userRoleCombo'] = $registerUserModel->getAllUserRoles();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('v_registeruser', $dataArray);
        $this->load->view('footer');
    }

    function Add() {

        $registerUserModel = new M_registeruser();
        $myModel = new My_Model();
        $isExist = $myModel->isRecordExist('users', 'Login_id', $this->input->post('LoginID'));
        if (!$isExist) {
            $userData = array(
                'Login_id' => trim($this->input->post('LoginID')),
                'Password' => trim($this->input->post('Password')),
                'FirstName' => trim($this->input->post('FirstName')),
                'LastName' => $this->input->post('LastName'),
                'idUserRole' => trim($this->input->post('idUserRole')),
                'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
                'isActive' => $myModel->getFieldsValue()['isActive']
            );
            $insertUser = $registerUserModel->InsertUser($userData);
        } else {
            $insertUser = "User ID is already exist";
        }
        $this->session->set_flashdata('insertmessage', $insertUser);
        redirect(base_url() . "index.php/registeruser/index");
    }

    function Update() {
        $registerUserModel = new M_registeruser();
        $myModel = new My_Model();
        $idUser = $this->input->post('idUser');
        $loginID = $this->input->post('LoginID');
        $isExist = $myModel->isRecordUpdateExist('users', 'Login_id', $loginID, 'User_id', $idUser);
        if (!$isExist) {
            $userData = array(
                'Login_id' => trim($this->input->post('LoginID')),
                'Password' => trim($this->input->post('Password')),
                'FirstName' => trim($this->input->post('FirstName')),
                'LastName' => $this->input->post('LastName'),
                'idUserRole' => trim($this->input->post('idUserRole')),
                'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            );
            $updateUser = $registerUserModel->UpdateUser($idUser, $userData);
        } else {
            $updateUser = "User ID is already exist";
        }
        $this->session->set_flashdata('updatemessage', $updateUser);
        redirect(base_url() . "index.php/registeruser/index");
    }

    function Delete($idUser) {
        $registerUserModel = new M_registeruser();
        $userData = array(
            'isActive' => 0,
        );
        $deleteUser = $registerUserModel->DeleteUser($idUser, $userData);
        $this->session->set_flashdata('deletemessage', $deleteUser);
        redirect(base_url() . "index.php/registeruser/index");
    }

    function search() {
        $registerUserModel = new M_registeruser();
        $search = $this->input->post('search');
        $registerUserSearch = $registerUserModel->searchUser($search);
        $userData = json_encode($registerUserSearch);
        echo $userData;
    }

}
