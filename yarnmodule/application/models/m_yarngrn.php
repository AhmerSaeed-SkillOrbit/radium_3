<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_yarngrn extends My_Model {

    public function __construct() {

        parent::__construct();
        date_default_timezone_set("Asia/Karachi");
    }

    function InsertYarnGrn($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('good_receive_note', $insertionData);
        if ($insert) {
            $insertDetail = $this->insertYarnGrnDetail($insert);
            if ($insertDetail) {
                return "Successfully Inserted";
            }
        } else {
            return "Failed to Insert";
        }
    }

    function insertYarnGrnDetail($goodReceiveNoteID) {

        $myModel = new My_Model();
        $yarnGrnDetailData = array();
        $SerialNo = $_POST['SerialNoDetail'];
        $PurchaseContractNo = $_POST['PCNoDetail'];
        $Bags = $_POST['NoOfBagsDetail'];
        $Packing = $_POST['PackingDetail'];
        $TotalWeight = $_POST['TotalWeightDetail'];
        $ShortWeight = $_POST['ShortWeightDetail'];
        $NetWeight = $_POST['NetWeightDetail'];
        $purchaseContractID = $_POST['PCIDDetail'];
        $weightRemaining = $_POST['BalanceDetail'];
        $weightReceived = $_POST['WeightReceivedDetail'];
        $warehouseID = $_POST['idWarehouse'];

        for ($Count = 0; $Count < count($_POST['SerialNoDetail']); $Count++) {
            
//          Code For Old Logic - Start
//            $newWeightRemaining = ($weightRemaining[$Count] - $NetWeight[$Count]);
//            $isClosed = 0;
//            if ($newWeightRemaining <= 0) {
//                $isClosed = 1;
//            }
//            $purchaseContractData = array(
//                'WeightRemaining' => $newWeightRemaining,
//                'WeightRecieved' => ($weightReceived[$Count] + $NetWeight[$Count]),
//                'isClosed' => $isClosed,
//            );
//            $updatePurchaseContract = $myModel->Update('purchase_contract', $purchaseContractData, 'PurchaseContractNo', $PurchaseContractNo[$Count]);
//       Code For Old Logic - End     
            $yarnGrnDetailData[] = array(
                'SerialNo' => trim($SerialNo[$Count]),
                'PurchaseContractNo' => trim($PurchaseContractNo[$Count]),
                'Bags' => trim($Bags[$Count]),
                'Packing' => trim(str_replace(',', '', $Packing[$Count])),
                'TotalWeight' => trim(str_replace(',', '', $TotalWeight[$Count])),
                'ShortWeight' => trim(str_replace(',', '', $ShortWeight[$Count])),
                'NetWeight' => trim(str_replace(',', '', $NetWeight[$Count])),
                'Purchase_contract_id' => $purchaseContractID[$Count],
                'Good_Receive_Note_id' => $goodReceiveNoteID,
                'Warehouse_id' => $warehouseID[$Count],
            );
        }
        $addGrnDetail = $this->db->insert_batch('good_receive_note_detail', $yarnGrnDetailData);
        if ($addGrnDetail) {
            return True;
        } else {
            return False;
        }
    }
    
     // function Written on 10-Feb-2015 Start
    function ClosePurchaseContract() {
        
        $myModel = new My_Model();
        $purchaseContractID = $_POST['PCIDDetail'];   
        for ($Count = 0; $Count < count($_POST['SerialNoDetail']); $Count++) {
            $pcTotalWeight = $this->getPCTotalWeight($purchaseContractID[$Count]);
            $pcTotalWeightGrn = $this->getGRNTotalWeight($purchaseContractID[$Count]);
            $pcTotalWtRemaining = $pcTotalWeight - $pcTotalWeightGrn;
            if ($pcTotalWtRemaining <= 0) {
                $purchaseContractData = array(
                    'isClosed' => 1,
                );
                $updatePurchaseContract = $myModel->Update('purchase_contract', $purchaseContractData, 'Purchase_contract_id', $purchaseContractID[$Count]);
            }
        }
    }
    // function Written on 10-Feb-2015 End
    
    // function Written on 19-Feb-2015 Start
    function OpenPurchaseContract($yarn_grnID) {
        
        $myModel = new My_Model();
        $purchaseContractID = $this->getGRNPurchaseContract($yarn_grnID);
        //for ($Count = 0; $Count < count($purchaseContractID); $Count++) {
        foreach ($purchaseContractID as $val) {
            $pcTotalWeight = $this->getPCTotalWeight($val['Purchase_contract_id']);
            $pcTotalWeightGrn = $this->getGRNTotalWeight($val['Purchase_contract_id']);
            $pcTotalWtRemaining = $pcTotalWeight - $pcTotalWeightGrn;
            if ($pcTotalWtRemaining > 0) {
                $purchaseContractData = array(
                    'isClosed' => 0,
                );
                $updatePurchaseContract = $myModel->Update('purchase_contract', $purchaseContractData, 'Purchase_contract_id', $val['Purchase_contract_id']);
            }
        }
    }   
    // function Written on 19-Feb-2015 End

    function UpdateYarnGrn($yarn_grnID, $updateData) {

        $myModel = new My_Model();
        $updateYarnGrn = $myModel->Update('good_receive_note', $updateData, 'Good_Receive_Note_id', $yarn_grnID);
        if ($updateYarnGrn) {
            $updateYarnGrnDetail = $this->updateYarnGrnDetail($yarn_grnID);
            if ($updateYarnGrnDetail) {
                return "Successfully Updated";
            }
        } else {
            return "Failed to Update";
        }
    }

    function updateYarnGrnDetail($yarn_grnID) {

        $myModel = new My_Model();
        $delete = $myModel->Delete('good_receive_note_detail', 'Good_Receive_Note_id', $yarn_grnID);
        if ($delete) {
            $yarnGrnDetailData = array();
            $SerialNo = $_POST['SerialNoDetail'];
            $PurchaseContractNo = $_POST['PCNoDetail'];
            $Bags = $_POST['NoOfBagsDetail'];
            $Packing = $_POST['PackingDetail'];
            $TotalWeight = $_POST['TotalWeightDetail'];
            $ShortWeight = $_POST['ShortWeightDetail'];
            $NetWeight = $_POST['NetWeightDetail'];
            $purchaseContractID = $_POST['PCIDDetail'];
            $warehouseID = $_POST['idWarehouse'];

            for ($Count = 0; $Count < count($_POST['SerialNoDetail']); $Count++) {
                $yarnGrnDetailData[] = array(
                    'SerialNo' => trim($SerialNo[$Count]),
                    'PurchaseContractNo' => trim($PurchaseContractNo[$Count]),
                    'Bags' => trim($Bags[$Count]),
                    'Packing' => trim(str_replace(',', '', $Packing[$Count])),
                    'TotalWeight' => trim(str_replace(',', '', $TotalWeight[$Count])),
                    'ShortWeight' => trim(str_replace(',', '', $ShortWeight[$Count])),
                    'NetWeight' => trim(str_replace(',', '', $NetWeight[$Count])),
                    'Purchase_contract_id' => $purchaseContractID[$Count],
                    'Good_Receive_Note_id' => $yarn_grnID,
                    'Warehouse_id' => $warehouseID[$Count]
                );
            }
            $updateYarnGrnDetail = $this->db->insert_batch('good_receive_note_detail', $yarnGrnDetailData);
            if ($updateYarnGrnDetail) {
                return True;
            } else {
                return False;
            }
        }
    }

    function DeleteYarnGrn($yarn_grnID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('good_receive_note', $deleteData, 'Good_Receive_Note_id', $yarn_grnID);
        if ($update) {
            return "Successfully Deleted";
        } else {
            return "Failed to Delete";
        }
    }

    function searchYarnGrn($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('view_yarngrn_info vyi');
        $this->db->where('vyi.GRNNo', $SearchKeyword);
        $this->db->where('vyi.isActive', 1);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

    function generateGRNNumber() {
        $number = $this->generateNumber('good_receive_note', 'MAX(GRNNo)+1');
        if ($number != NULL) {
            $grnNumber = $number;
            return $grnNumber;
        } else {
            $grnNumber = '1';
            return $grnNumber;
        }
    }

    function calNetWeight($pcID) {
        $this->db->select('SUM(NETWeight) AS TotalNetWeight');
        $this->db->from('good_receive_note_detail grnd');
        $this->db->join('good_receive_note grn', 'grn.Good_Receive_Note_id = grnd.Good_Receive_Note_id');
        $this->db->where('grnd.Purchase_contract_id', $pcID);
        $this->db->where('grn.isActive', 1);
        $data = $this->db->get();
        return $data->result_array();
    }
    
    function InsertStock($yarn_grnNo) {
        $sql = "CALL sp_add_yarn_stock(?)";
        $params = array($yarn_grnNo);
        $this->db->query($sql, $params);
        return ($this->db->affected_rows() == 1); 
    }
    
    function UpdateStock($yarn_grnNo) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('yarn_stock', 'grn_id', $_POST['GRNID']);
        if ($delete) 
        {
            $this->InsertStock($yarn_grnNo);
        }
    }
    
    function DeleteStock($yarn_grnID) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('yarn_stock', 'grn_id', $yarn_grnID);
        if ($delete) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
     //Function Written on 10-Feb-2015
    function getPCTotalWeight($pcID) {
        $this->db->select('TotalWeight');
        $this->db->from('purchase_contract pc');
        $this->db->where('pc.Purchase_contract_id', $pcID);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            $row = $data->row();
            $data = $row->TotalWeight;
            return $data;
        } else {
            return '0';
        }
    }

    //Function Written on 10-Feb-2015
    function getGRNTotalWeight($pcID) {
        $this->db->select('SUM(NETWeight) AS TotalNetWeight');
        $this->db->from('good_receive_note_detail grnd');
        $this->db->join('good_receive_note grn', 'grn.Good_Receive_Note_id = grnd.Good_Receive_Note_id');
        $this->db->where('grnd.Purchase_contract_id', $pcID);
        $this->db->where('grn.isActive', 1);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            $row = $data->row();
            $data = $row->TotalNetWeight;
            return $data;
        } else {
            return 0;
        }
    }
    
    function getGRNPurchaseContract($yarn_grnID) {
        $this->db->select('Purchase_contract_id');
        $this->db->from('good_receive_note_detail');
        $this->db->where('good_receive_note_id', $yarn_grnID);
        $searchData = $this->db->get();
        return $searchData->result_array();
    }

    

}
