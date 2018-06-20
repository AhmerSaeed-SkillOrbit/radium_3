<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Itemspecification extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_countcreation');
        $this->load->model('m_itemspecification');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {
        $dataArray = array();
        $countCreationModel = new M_countcreation();
        $itemSpecsModel = new M_itemspecification();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $dataArray['countCombo'] = $countCreationModel->getAllCount();
        $dataArray['itemList'] = $itemSpecsModel->getAllItems();
        $this->load->view('header');
        $this->load->view('v_itemspecification', $dataArray);
        $this->load->view('footer');
    }
    
    function Add() {
        $itemSpecsModel = new M_itemspecification();
        $myModel = new My_Model();
        $otherArray = $this->input->post('Other');
        $otherStr = "";
        $itemSpecsData = array(
            'ItemCode' => $this->input->post('ItemCode'),
            'FinishLength' => $this->input->post('Length'),
            'FinishLengthUnit' => $this->input->post('LengthUnit'),
            'FinishWidth' => $this->input->post('Width'),
            'FinishWidthUnit' => $this->input->post('WidthUnit'),
            'FinishWeight' => $this->input->post('FinishWeight'),
            'FinishWeightUnit' => $this->input->post('FinishWeightUnit'),
            'GreighWeight' => $this->input->post('GreightWeight'),
            'GreighWeightUnit' => $this->input->post('GreightWeightUnit'),
            'FinishGSM' => $this->input->post('FinishGSM'),
            'loop_count_id' => ($this->input->post('Loop') != "0" ? $this->input->post('Loop') : null),
            'BlendPercent' => $this->input->post('blend'),
            'Attribute' => $this->input->post('attribute'),
            'StitchingType' => $this->input->post('StitchingType'),
            'PilePercent' => $this->input->post('Pile'),
            'pile_count_id' => ($this->input->post('PileCount') != "0" ? $this->input->post('PileCount') : null),
            'PileUnit' => ($this->input->post('PileType') != "0" ? $this->input->post('PileType') : null),
            'WeftPercent' => $this->input->post('Weft'),
            'weft_count_id' => ($this->input->post('WeftCount') != "0" ? $this->input->post('WeftCount') : null),
            'WeftUnit' => ($this->input->post('WeftType') != "0" ? $this->input->post('WeftType') : null),
            'GroundPercent' => $this->input->post('Ground'),
            'ground_count_id' => ($this->input->post('GroundCount') != "0" ? $this->input->post('GroundCount') : null),
            'GroundUnit' => ($this->input->post('GroundType') != "0" ? $this->input->post('GroundType') : null),
            'FancyPercent' => $this->input->post('FancyPercent'),
            'fancy_count_id' => ($this->input->post('FancyCount') != "0" ? $this->input->post('FancyCount') : null),
            'FancyUnit' => ($this->input->post('FancyType') != "0" ? $this->input->post('FancyType') : null),
            'ProcessLossPercent' => $this->input->post('ProcessLoss'),
            'WeavingLossPercent' => $this->input->post('WeavingLoss'),
            'Other' => $this->input->post('Other'),
            'ReedOnLoom' => $this->input->post('ReedonLoom'),
            'PickOnLoom' => $this->input->post('PickonLoom'),
            'PileTar' => $this->input->post('PileTar'),
            'GroundTar' => $this->input->post('GroundTar'),
            'CutPanna' => $this->input->post('CutPanna'),
            'Kinari' => $this->input->post('Kinari'),
            'NaliTar' => $this->input->post('NaliTar'),
            'Misc' => $this->input->post('Misc'),
            'CuttingBorder' => $this->input->post('CuttingBorder'),
            'PlainCam' => $this->input->post('PlainCam'),
            'PiletoPile' => $this->input->post('PiletoPile'),
            'PileCam' => $this->input->post('PileCam'),
            'Fancy' => $this->input->post('Fancy'),
            'Frame' => $this->input->post('Frame'),
            'ItemDesc' => $this->input->post('Length')." X ".$this->input->post('Width')." ".$this->input->post('LengthUnit').", ".$this->input->post('FinishWeight')." ".$this->input->post('FinishWeightUnit').", ".$this->input->post('LoopCount').", ".$this->input->post('blend').", ".$this->input->post('attribute').", ".$this->input->post('StitchingType'),
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']
        );
        for ($Count = 0; $Count < count($otherArray); $Count++) {
            $otherStr .= $otherArray[$Count]."|";            
        }
        $itemSpecsData["Other"] = substr($otherStr, 0, -1);
        $inserted = $itemSpecsModel->InsertItemSpecifications($itemSpecsData);
        if ($inserted) {
            $insertItemMsg = "Successfully Inserted ";
        } else {
            $insertItemMsg = "Failed to Insert";
        }
        $this->session->set_flashdata('insertmessage', $insertItemMsg);
        redirect(base_url() . "index.php/itemspecification/index");
        
    }
    
    function Update() {
        $itemSpecsModel = new M_itemspecification();
        $myModel = new My_Model();
        $itemSpecsID = $this->input->post('ItemID');
        $otherArray = $this->input->post('Other');
        $otherStr = "";
        $itemSpecsData = array(
            'ItemCode' => $this->input->post('ItemCode'),
            'FinishLength' => $this->input->post('Length'),
            'FinishLengthUnit' => $this->input->post('LengthUnit'),
            'FinishWidth' => $this->input->post('Width'),
            'FinishWidthUnit' => $this->input->post('WidthUnit'),
            'FinishWeight' => $this->input->post('FinishWeight'),
            'FinishWeightUnit' => $this->input->post('FinishWeightUnit'),
            'GreighWeight' => $this->input->post('GreightWeight'),
            'GreighWeightUnit' => $this->input->post('GreightWeightUnit'),
            'FinishGSM' => $this->input->post('FinishGSM'),
            'loop_count_id' => ($this->input->post('Loop') != "0" ? $this->input->post('Loop') : null),
            'BlendPercent' => $this->input->post('blend'),
            'Attribute' => $this->input->post('attribute'),
            'StitchingType' => $this->input->post('StitchingType'),            
            'PilePercent' => $this->input->post('Pile'),
            'pile_count_id' => ($this->input->post('PileCount') != "0" ? $this->input->post('PileCount') : null),
            'PileUnit' => ($this->input->post('PileType') != "0" ? $this->input->post('PileType') : null),
            'WeftPercent' => $this->input->post('Weft'),
            'weft_count_id' => ($this->input->post('WeftCount') != "0" ? $this->input->post('WeftCount') : null),
            'WeftUnit' => ($this->input->post('WeftType') != "0" ? $this->input->post('WeftType') : null),
            'GroundPercent' => $this->input->post('Ground'),
            'ground_count_id' => ($this->input->post('GroundCount') != "0" ? $this->input->post('GroundCount') : null),
            'GroundUnit' => ($this->input->post('GroundType') != "0" ? $this->input->post('GroundType') : null),
            'FancyPercent' => $this->input->post('FancyPercent'),
            'fancy_count_id' => ($this->input->post('FancyCount') != "0" ? $this->input->post('FancyCount') : null),
            'FancyUnit' => ($this->input->post('FancyType') != "0" ? $this->input->post('FancyType') : null),
            'ProcessLossPercent' => $this->input->post('ProcessLoss'),
            'WeavingLossPercent' => $this->input->post('WeavingLoss'),
            //'Other' => $this->input->post('Other'),
            'ReedOnLoom' => $this->input->post('ReedonLoom'),
            'PickOnLoom' => $this->input->post('PickonLoom'),
            'PileTar' => $this->input->post('PileTar'),
            'GroundTar' => $this->input->post('GroundTar'),
            'CutPanna' => $this->input->post('CutPanna'),
            'Kinari' => $this->input->post('Kinari'),
            'NaliTar' => $this->input->post('NaliTar'),
            'Misc' => $this->input->post('Misc'),
            'CuttingBorder' => $this->input->post('CuttingBorder'),
            'PlainCam' => $this->input->post('PlainCam'),
            'PiletoPile' => $this->input->post('PiletoPile'),
            'PileCam' => $this->input->post('PileCam'),
            'Fancy' => $this->input->post('Fancy'),
            'Frame' => $this->input->post('Frame'),
            'ItemDesc' => $this->input->post('Length')." X ".$this->input->post('Width')." ".$this->input->post('LengthUnit').", ".$this->input->post('FinishWeight')." ".$this->input->post('FinishWeightUnit').", ".$this->input->post('LoopCount').", ".$this->input->post('blend').", ".$this->input->post('attribute').", ".$this->input->post('StitchingType'),
            'CreatedDate' => $myModel->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $myModel->getFieldsValue()['ModifiedDate'],
            'isActive' => $myModel->getFieldsValue()['isActive']
        );
        for ($Count = 0; $Count < count($otherArray); $Count++) {
            $otherStr .= $otherArray[$Count]."|";            
        }
        $itemSpecsData["Other"] = substr($otherStr, 0, -1);
        $updated = $itemSpecsModel->UpdateItemSpecifications($itemSpecsID, $itemSpecsData);
        if ($updated) {
            $updateItemMsg = "Successfully Updated ";
        } else {
            $updateItemMsg = "Failed to Update";
        }
        $this->session->set_flashdata('updatemessage', $updateItemMsg);
        redirect(base_url() . "index.php/itemspecification/index");
        
    }
    
    function search() {
        $itemSpecsModel = new M_itemspecification();
        $search = $this->input->post('search');
        $itemSpecsSearch = $itemSpecsModel->searchItemSpecs($search);
        $itemSpecsData = json_encode($itemSpecsSearch);
        echo $itemSpecsData;
    }
    
    function Delete($itemSpecsID) {
        $itemSpecsModel = new M_itemspecification();
        $itemSpecsData = array(
            'isActive' => 0,
        );
        $deleted = $itemSpecsModel->DeleteItemSpecifications($itemSpecsID, $itemSpecsData);
        if ($deleted) {
            $deleteItemMsg = "Successfully Deleted ";
        } else {
            $deleteItemMsg = "Failed to Delete";
        }
        $this->session->set_flashdata('deletemessage', $deleteItemMsg);
        redirect(base_url() . "index.php/itemspecification/index");
    }
    
    function getItemInfo() {
        $ItemID = $this->input->post('ItemID');
        $itemSpecsModel = new M_itemspecification();
        $itemSpecsData = $itemSpecsModel->getItemInfo($ItemID);
        $itemSpecsinfo = json_encode($itemSpecsData);
        echo $itemSpecsinfo;
    }

}
