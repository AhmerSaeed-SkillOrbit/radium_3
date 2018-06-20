<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_yarndelivery extends My_Model {

    public function __construct() {

        parent::__construct();
    }
    
    function InsertYarnDelivery($insertionData) {

        $myModel = new My_Model();
        $insert = $myModel->Insert('delivery_challan', $insertionData);
        if ($insert) {
            $insertDetail = $this->insertYarnDeliveryDetail($insert);
            if ($insertDetail) {
                return "Successfully Inserted";
            }
        } else {
            return "Failed to Insert";
        }
    }
    
    function insertYarnDeliveryDetail($deliveryChallanID) {

        $yarnDeliveryDetailData = array();
        $SerialNo = $_POST['SerialNoDetail'];
        $Count_id = $_POST['idCount'];
        $Mill_id = $_POST['idMill'];
        $Brand = $_POST['Brand'];
        $Usage_id = $_POST['idUsage'];
        $Bags = $_POST['Bags'];
        $Quantity = $_POST['Quantity'];
        $warehouseID = $_POST['idWarehouse'];

        for ($Count = 0; $Count < count($_POST['SerialNoDetail']); $Count++) {
            $yarnDeliveryDetailData[] = array(
                'SerialNo' => trim($SerialNo[$Count]),
                'Count_id' => $Count_id[$Count],
                'Mill_id' => $Mill_id[$Count],
                'Brand' => trim($Brand[$Count]),
                'Usage_id' => $Usage_id[$Count],
                'Bags' => trim($Bags[$Count]),
                'Quantity' => trim(str_replace(',', '',$Quantity[$Count])),
                'Delivery_Challan_id' => $deliveryChallanID,
                'Warehouse_id' => $warehouseID[$Count],
            );
        }
        $addGrnDetail = $this->db->insert_batch('delivery_challan_detail', $yarnDeliveryDetailData);
        if ($addGrnDetail) {
            return True;
        } else {
            return False;
        }
    }

    function UpdateYarnDelivery($yarn_deliveryID, $updateData) {

        $myModel = new My_Model();
        $updateYarnDelivery = $myModel->Update('delivery_challan', $updateData, 'Delivery_Challan_id', $yarn_deliveryID);
        if ($updateYarnDelivery) {
            $updateYarnDeliveryDetail = $this->updateYarnDeliveryDetail($yarn_deliveryID);
            if ($updateYarnDeliveryDetail) {
                return "Successfully Updated";
            }
        } else {
            return "Failed to Update";
        }
    }

    function updateYarnDeliveryDetail($yarn_deliveryID) {

        $myModel = new My_Model();
        $delete = $myModel->Delete('delivery_challan_detail', 'Delivery_Challan_id', $yarn_deliveryID);
        if ($delete) {
            $updateYarnDeliveryDetail = $this->insertYarnDeliveryDetail($yarn_deliveryID);
            if ($updateYarnDeliveryDetail) {
                return True;
            } else {
                return False;
            }
        }
    }

    function DeleteYarnDelivery($yarn_deliveryID, $deleteData) {

        $myModel = new My_Model();
        $update = $myModel->Update('delivery_challan', $deleteData, 'Delivery_Challan_id', $yarn_deliveryID);
        if ($update) {
            return "Successfully Deleted";
        } else {
            return "Failed to Delete";
        }
    }

    function searchYarnDelivery($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('view_yarndelivery_info vyi');
        $this->db->where('vyi.DeliveryChallanNo', $SearchKeyword);
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
        $number = $this->generateNumber('delivery_challan', 'MAX(GatePassNo)+1');
        if ($number != NULL) {
            $gatePassNo = $number;
            return $gatePassNo;
        } else {
            $gatePassNo = '1';
            return $gatePassNo;
        }
    }

    function generateDeliveryChallanNumber() {
        $number = $this->generateNumber('delivery_challan', 'MAX(DeliveryChallanNo)+1');
        if ($number != NULL) {
            $deliveryChallanNo = $number;
            return $deliveryChallanNo;
        } else {
            $deliveryChallanNo = '1';
            return $deliveryChallanNo;
        }
    }
    
    function RemoveStock($challan_ID) {
        $sql = "CALL sp_remove_yarn_stock(?)";
        $params = array($challan_ID);
        $this->db->query($sql, $params);
        return ($this->db->affected_rows() == 1); 
    }
    
    function UpdateStock($challan_ID) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('yarn_stock', 'yarn_delivery_id', $_POST['DeliveryChalanID']);
        if ($delete) 
        {
            $this->RemoveStock($challan_ID);
        }
    }
    
    function DeleteStock($challan_ID) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('yarn_stock', 'yarn_delivery_id', $challan_ID);
        if ($delete) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    function DeleteLedger($challan_ID) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('yarn_ledger', 'yarn_delivery_id', $challan_ID);
        if ($delete) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    function getStock($countID, $millID, $brand, $warehouseID, $challan_ID ) {
        $this->db->select('sum(quantity) AS StockQuantity');
        $this->db->from('yarn_stock ys');
        $this->db->where('ys.count_id', $countID);
        $this->db->where('ys.mill_id', $millID);
        $this->db->where('ys.Brand', $brand);
        $this->db->where('ys.warehouse_id', $warehouseID);
        if ($challan_ID != NULL || $challan_ID != "") {
            $this->db->where('COALESCE(ys.yarn_delivery_id, 0) != ', $challan_ID);
        }
        $data = $this->db->get();
        return $data->result_array();
    }
    
    function insertYarnledger($deliveryChallanNo) {

        $yarnLedgerData = array();
        $partyID = $_POST['idPartyType'];
        $Date = $_POST['ChallanDate'];
        $Count_id = $_POST['idCount'];
        $Mill_id = $_POST['idMill'];
        $Bags = $_POST['Bags'];
        $Quantity = $_POST['Quantity'];
        $yarnDeliveryID = $this->getYarnDeliveryID($deliveryChallanNo);
               
        for ($Count = 0; $Count < count($_POST['SerialNoDetail']); $Count++) {
            $yarnLedgerData[] = array(
                'party_id' => $partyID,
                'TransactionDate' => date("Y-m-d", strtotime($Date)),
                'Description' => "Yarn Delivered against Challan No.: ".$deliveryChallanNo,
                'count_id' => $Count_id[$Count],
                'mill_id' => $Mill_id[$Count],
                'Bags' => trim($Bags[$Count]),
                'WeightIssue' => trim(str_replace(',', '',$Quantity[$Count])),
                'yarn_delivery_id' => $yarnDeliveryID
            );
        }
        $addLedger = $this->db->insert_batch('yarn_ledger', $yarnLedgerData);
        if ($addLedger) {
            return True;
        } else {
            return False;
        }
    }
    
    function UpdateYarnledger($deliveryChallanNo) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('yarn_ledger', 'yarn_delivery_id', $_POST['DeliveryChalanID']);
        if ($delete) 
        {
            $this->insertYarnledger($deliveryChallanNo);
        }
    }
    
    function InsertWeavingLegder($deliveryChallanNo) {
        $sql = "CALL sp_add_weaving_ledger(?)";
        $params = array($deliveryChallanNo);
        $this->db->query($sql, $params);
        return ($this->db->affected_rows() == 1); 
    }
    
    function UpdateWeavingLegder($deliveryChallanNo) {
        $myModel = new My_Model();
        $yarn_delivery_id = $this->getYarnDeliveryID($deliveryChallanNo);
        $delete = $myModel->Delete('weaving_ledger', 'yarn_delivery_id', $yarn_delivery_id);
        if ($delete) 
        {
            $this->InsertWeavingLegder($deliveryChallanNo);
        }
    }
    
    function DeleteWeavingLegder($challan_ID) {
        $myModel = new My_Model();
        $delete = $myModel->Delete('weaving_ledger', 'yarn_delivery_id', $challan_ID);
        if ($delete) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    function getYarnDeliveryID($deliveryChallanNo) {
        $this->db->select('Delivery_Challan_id');
        $this->db->from('delivery_challan');
        $this->db->where('DeliveryChallanNo', $deliveryChallanNo);
        $searchData = $this->db->get();
        if ($searchData->num_rows() > 0) {
            $row = $searchData->row();
            $challanID = $row->Delivery_Challan_id;
        } else {
            $challanID = 0;
        }
        return $challanID;
    }
}
