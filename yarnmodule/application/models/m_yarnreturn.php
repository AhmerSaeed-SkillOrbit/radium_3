<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_yarnreturn extends My_Model {

    public function __construct() {

        parent::__construct();
    }

    function InsertYarnReturn($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('yarn_return', $insertionData);
        if ($insert) {
            $insertDetail = $this->insertYarnReturnDetail($insert);
            if ($insertDetail) {
                return "Successfully Inserted";
            }
        } else {
            return "Failed to Insert";
        }
    }

    function insertYarnReturnDetail($yarnReturnID) {

        $yarnReturnDetailData = array();
        $SerialNo = $_POST['SerialNoDetail'];
        $Count_id = $_POST['idCount'];
        $Mill_id = $_POST['idMill'];
        $Brand = $_POST['Brand'];
        $Bags = $_POST['Bags'];
        $Quantity = $_POST['Quantity'];
        $Wastage = $_POST['Wastage'];
        $warehouseID = $_POST['idWarehouse'];
        
	
        for ($Count = 0; $Count < count($_POST['Brand']); $Count++) {
            $yarnReturnDetailData[] = array(
                'SerialNo' => trim($SerialNo[$Count]),
                'Count_id' => $Count_id[$Count],
                'Mill_id' => $Mill_id[$Count],
                'Brand' => trim($Brand[$Count]),
                'Bags' => trim($Bags[$Count]),
                'Quantity' => trim(str_replace(',', '', $Quantity[$Count])),
                'yarn_return_id' => $yarnReturnID,
                'Warehouse_id' => $warehouseID[$Count],
                'WastagePercent' => $Wastage[$Count]
            );
        }
        $addGrnDetail = $this->db->insert_batch('yarn_return_detail', $yarnReturnDetailData);
        if ($addGrnDetail) {
            return True;
        } else {
            return False;
        }
    }

    function UpdateYarnReturn($yarn_deliveryID, $updateData) {

        $myModel = new My_Model();
        $updateYarnReturn = $myModel->Update('yarn_return', $updateData, 'yarn_return_id', $yarn_deliveryID);
        if ($updateYarnReturn) {
            $updateYarnReturnDetail = $this->updateYarnReturnDetail($yarn_deliveryID);
            if ($updateYarnReturnDetail) {
                return "Successfully Updated";
            }
        } else {
            return "Failed to Update";
        }
    }

    function updateYarnReturnDetail($yarn_deliveryID) {

        $myModel = new My_Model();
        $delete = $myModel->Delete('yarn_return_detail', 'yarn_return_id', $yarn_deliveryID);
        if ($delete) {
            $updateYarnReturnDetail = $this->insertYarnReturnDetail($yarn_deliveryID);
            if ($updateYarnReturnDetail) {
                return True;
            } else {
                return False;
            }
        }
    }

    function DeleteYarnReturn($yarn_deliveryID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('yarn_return', $deleteData, 'yarn_return_id', $yarn_deliveryID);
        if ($update) {
            return "Successfully Deleted";
        } else {
            return "Failed to Delete";
        }
    }

    function searchYarnReturn($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('view_yarnreturn_info vyi');
        $this->db->where('vyi.YarnReturnNo', $SearchKeyword);
        $this->db->where('vyi.isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

    function getAllPurpose() {
        $myModel = new My_Model();
        $get = $myModel->getOrderByData('purpose', 'PurposeName', 'isActive');
        return $get;
    }

    function getAllUsage() {
        $myModel = new My_Model();
        $get = $myModel->getOrderByData('usage', 'UsageName', 'isActive');
        return $get;
    }

    function generateGatePassNumber() {
        $number = $this->generateNumber('yarn_return', 'MAX(GatePassNo)+1');
        if ($number != NULL) {
            $gatePassNo = $number;
            return $gatePassNo;
        } else {
            $gatePassNo = '1';
            return $gatePassNo;
        }
    }

    function generateYarnReturnNumber() {
        $number = $this->generateNumber('yarn_return', 'MAX(YarnReturnNo)+1');
        if ($number != NULL) {
            $yarnReturnNo = $number;
            return $yarnReturnNo;
        } else {
            $yarnReturnNo = '1';
            return $yarnReturnNo;
        }
    }
    
    function ReturnStock($return_No) {
        $sql = "CALL sp_return_yarn_stock(?)";
        $params = array($return_No);
        $this->db->query($sql, $params);
        return ($this->db->affected_rows() == 1); 
    }
    
    function UpdateStock($return_No) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('yarn_stock', 'yarn_return_id', $_POST['YarnReturnID']);
        if ($delete) 
        {
            $this->ReturnStock($return_No);
        }
    }
    
    function DeleteStock($return_ID) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('yarn_stock', 'yarn_return_id', $return_ID);
        if ($delete) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
     function DeleteLedger($return_ID) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('yarn_ledger', 'yarn_return_id', $return_ID);
        if ($delete) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    function insertYarnledger($return_No) {

        $yarnLedgerData = array();
        $partyID = $_POST['idPartyType'];
        $Date = $_POST['ReturnDate'];
        $Count_id = $_POST['idCount'];
        $Mill_id = $_POST['idMill'];
        $Bags = $_POST['Bags'];
        $Quantity = $_POST['Quantity'];
        $Wastage = $_POST['Wastage'];
        $suplierChallanNo = $_POST['SupplierChallanNo'];
        $yarnReturnID = $this->getYarnReturnID($return_No);
        $wasteQuantity = 0.00;
       
        for ($Count = 0; $Count < count($_POST['SerialNoDetail']); $Count++) {
            $yarnLedgerData[] = array(
                'party_id' => $partyID,
                'TransactionDate' => date("Y-m-d", strtotime($Date)),
                'Description' => "Yarn returned against Return No.: ".$suplierChallanNo,
                'count_id' => $Count_id[$Count],
                'mill_id' => $Mill_id[$Count],
                'Bags' => trim($Bags[$Count]),
                'WeightReceived' => trim(str_replace(',', '',$Quantity[$Count])),
                'yarn_return_id' => $yarnReturnID
            );
            if ($Wastage[$Count] > 0) {
                $wasteQuantity = trim(str_replace(',', '',$Quantity[$Count])) * ($Wastage[$Count]/100);
                $yarnLedgerData[] = array(
                    'party_id' => $partyID,
                    'TransactionDate' => date("Y-m-d", strtotime($Date)),
                    'Description' => "Wastage allowed " . $Wastage[$Count] . "%",
                    'count_id' => $Count_id[$Count],
                    'mill_id' => $Mill_id[$Count],
                    'Bags' => 0,
                    'WeightReceived' => $wasteQuantity,
                    'yarn_return_id' => $yarnReturnID
                );
            }
        }
        $addLedger = $this->db->insert_batch('yarn_ledger', $yarnLedgerData);
        if ($addLedger) {
            return True;
        } else {
            return False;
        }
    }
    
     function UpdateYarnledger($return_No) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('yarn_ledger', 'yarn_return_id', $_POST['YarnReturnID']);
        if ($delete) 
        {
            $this->insertYarnledger($return_No);
        }
    }
    
    function getYarnReturnID($return_No) {
        $this->db->select('Yarn_Return_id');
        $this->db->from('yarn_return');
        $this->db->where('YarnReturnNo', $return_No);
        $searchData = $this->db->get();
        if ($searchData->num_rows() > 0) {
            $row = $searchData->row();
            $returnID = $row->Yarn_Return_id;
        } else {
            $returnID = 0;
        }
        return $returnID;
    }
    
     function getPartyBalance($party_id, $return_ID) {
        $this->db->select('sum(Weightissue) - sum(weightreceived) AS PartyBalance');
        $this->db->from('yarn_ledger');
        $this->db->where('party_id', $party_id);
        if ($return_ID != NULL || $return_ID != "") {
            $this->db->where('COALESCE(yarn_return_id, 0) != ', $return_ID);
        }
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

}
