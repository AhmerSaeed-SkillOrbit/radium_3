<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class My_Model extends CI_Model {

    public function __construct() {

        parent::__construct();
        date_default_timezone_set("Asia/Karachi");
    }

    public function Insert($TableName, $InsertData) {
        $this->db->trans_start();
        $insert = $this->db->insert($TableName, $InsertData);
        if ($insert) {
            $id = $this->db->insert_id();
            $this->db->trans_complete();
            return $id;
        } else {
            return FALSE;
        }
    }

    public function Update($TableName, $UpdateData, $Where, $Value = '') {
        if (is_array($Where)) {
            $this->db->where($Where);
        } else {
            $this->db->where($Where, $Value);
        }
        $update = $this->db->update($TableName, $UpdateData);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function Delete($TableName, $Where, $Value = '') {
        if (is_array($Where)) {
            $this->db->where($Where);
        } else {
            $this->db->where($Where, $Value);
        }
        $delete = $this->db->delete($TableName);
        if ($delete) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function SelectAll($TableName) {
        $this->db->select('*');
        $rs = $this->db->get($TableName);
        return $rs->result_array();
    }

    public function SelectOne($TableName, $Where, $Value = '') {
        $this->db->select('*');
        if (is_array($Where)) {
            $this->db->where($Where);
        } else {
            $this->db->where($Where, $Value);
        }
        $rs = $this->db->get($TableName);
        return $rs->result_array();
    }

    public function getOrderByData($tableName, $fieldName, $isActive) {
        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where($isActive, 1);
        $this->db->order_by($fieldName, 'ASC');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getPartyType($type) {

        $this->db->select('*');
        $this->db->from('party p');
        $this->db->join('party_type pt', 'pt.Party_type_id = p.Party_type_id');
        $this->db->where('pt.PartyTypeName', $type);
        $this->db->where('p.isActive', 1);
        $this->db->order_by('p.CompanyName', 'ASC');
        $partyType = $this->db->get();
        return $partyType->result_array();
    }

    public function generateNumber($TableName, $value) {
        $this->db->select($value . ' AS Number');
        $number = $this->db->get($TableName);
        if ($number->num_rows() > 0) {
            $row = $number->row();
            $number = $row->Number;
            return $number;
        } else {
            return '0';
        }
    }

    public function isRecordExist($tableName, $where, $value) {

        $whereClause = "$where = '$value' AND isActive = 1";
        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where($whereClause);
        $this->db->limit(1);
        $isExist = $this->db->get();
        if ($isExist->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isRecordUpdateExist($tableName, $where, $value, $whereId, $id) {

        $whereClause = "$where = '$value' AND $whereId != '$id' AND isActive = 1";
        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where($whereClause);
        $this->db->limit(1);
        $isExist = $this->db->get();
        if ($isExist->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function savePartyFromPopup() {
        $partyData = $this->input->post('data');
        $isExist = $this->isRecordExist('party', 'CompanyName', $partyData['CompanyName']);
        if (!$isExist) {
            $partyCreationData = array(
                'CompanyName' => $partyData['CompanyName'],
                'ContactPerson' => $partyData['ContactPerson'],
                'Address' => $partyData['Address'],
                'Phone' => $partyData['Phone'],
                'Fax' => $partyData['Fax'],
                'Mobile' => $partyData['Mobile'],
                'Email' => $partyData['Email'],
                'STRN' => $partyData['STRN'],
                'NtnNumber' => $partyData['NtnNumber'],
                'Party_type_id' => $partyData['idPartyType'],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $insert = $this->Insert('party', $partyCreationData);
            if ($insert) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $insert = "Party of this Name is already exist";
            return $insert;
        }
    }

    public function getFieldsValue() {
        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
