<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_registeruser extends My_Model {

    public function __construct() {

        parent::__construct();
    }

    function InsertUser($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('users', $insertionData);
        if ($insert) {
            return "Successfully Inserted";
        } else {
            return "failed to insert";
        }
    }

    function UpdateUser($idUser, $updateData) {

        $myModel = new My_Model();
        $update = $myModel->Update('users', $updateData, 'User_id', $idUser);
        if ($update) {
            return "Successfully Updated";
        } else {
            return "Failed to Update";
        }
    }

    function DeleteUser($idUser, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('users', $deleteData, 'User_id', $idUser);
        if ($update) {
            return "Successfully Deleted";
        } else {
            return "Failed to Delete";
        }
    }

    function searchUser($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('users u');
        $this->db->like('Login_id', $SearchKeyword);
        //$this->db->like('FirstName', $SearchKeyword);
        $this->db->join('user_role ur', 'ur.idRole = u.idUserRole');
        $this->db->where('u.isActive', 1);
        $this->db->where('ur.isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();

//        $myModel = new My_Model();
//        $get = $myModel->SelectOne('users', 'isActive = 1 AND users.UserName LIKE', $SearchKeyword);
//        return $get;
    }

    function getAllUserRoles() {
        $myModel = new My_Model();
        $get = $myModel->getOrderByData('user_role', 'Role_name', 'isActive');
        return $get;
    }

}
