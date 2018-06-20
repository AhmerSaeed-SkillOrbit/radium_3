<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class m_ReportServices extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function yarnReceivingDateWise($dateFrom, $dateTo) {

        $where = "grn.ChallanDate between '$dateFrom' AND '$dateTo'";
        $this->db->select('grn.ChallanDate as Date, pc.PurchaseContractNo as PCNo, grn.GRNNo, p1.CompanyName as Broker, p2.CompanyName as Mill, 
			pc.Brand, c.CountName, grnd.ShortWeight as Shortage, w.WarehouseName as Warehouse, grnd.Bags, grnd.NetWeight as Lbs');
        $this->db->from('good_receive_note grn');
        $this->db->join('good_receive_note_detail grnd','grn.Good_Receive_Note_id = grnd.Good_Receive_Note_id');
        $this->db->join('purchase_contract pc','pc.Purchase_contract_id = grnd.Purchase_contract_id');
        $this->db->join('party p1','p1.Party_id = pc.Broker_id');
        $this->db->join('party p2','p2.Party_id = pc.Mill_id');
        $this->db->join('warehouse w','w.warehouse_id = grnd.Warehouse_ID');
        $this->db->join('count c','c.Count_id = pc.Count_id');
        $this->db->where($where);
        $this->db->order_by('grn.ChallanDate', "asc");
        $this->db->order_by('pc.PurchaseContractNo', "asc");
        $this->db->order_by('grn.GRNNo', "asc");
        $this->db->order_by('p1.CompanyName', "asc");
        $this->db->order_by('p2.CompanyName', "asc");
        $this->db->order_by('pc.Brand', "asc");
        $this->db->order_by('c.CountName', "asc");
        $this->db->order_by('w.WarehouseName', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnDeliveryDateAndPartyWise($dateFrom, $dateTo, $partyID) {

        $where = "dc.ChallanDate between '$dateFrom' AND '$dateTo' AND dc.Party_id = '$partyID' AND dc.isActive = 1";
        $this->db->select('dc.ChallanDate as Date, dc.GatePassNo as GPNo, dc.DeliveryChallanNo as DCNo, 
			w.WarehouseName as Warehouse, u.UsageName, c.CountName as Count, p1.CompanyName as Mill, 
			dcd.Brand, dcd.Bags, dcd.Quantity as Lbs, p2.CompanyName as party');
        $this->db->from('delivery_challan dc');
        $this->db->join('delivery_challan_detail dcd','dc.Delivery_Challan_id = dcd.Delivery_Challan_id');
        $this->db->join('warehouse w','w.Warehouse_id = dcd.Warehouse_ID');
        $this->db->join('count c','c.Count_id = dcd.Count_id');
        $this->db->join('party p1','p1.Party_id = dcd.Mill_id');
        $this->db->join('party p2','p2.Party_id = dc.Party_id');
        $this->db->join('`usage` u','u.Usageid = dcd.Usage_id');
        $this->db->where($where);
        $this->db->order_by('dc.ChallanDate', "asc");
        $this->db->order_by('dc.GatePassNo', "asc");
        $this->db->order_by('dc.DeliveryChallanNo', "asc");
        $this->db->order_by('w.WarehouseName', "asc");
        $this->db->order_by('u.UsageName', "asc");
        $this->db->order_by('c.CountName', "asc");
        $this->db->order_by('p1.CompanyName', "asc");
        $this->db->order_by('dcd.Brand', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnDeliveryDateWise($dateFrom, $dateTo) {

        $where = "dc.ChallanDate between '$dateFrom' AND '$dateTo' AND dc.isActive = 1";
        $this->db->select("dc.ChallanDate as Date, dc.GatePassNo as GPNo, dc.DeliveryChallanNo as DCNo, 
						w.WarehouseName as Warehouse, p2.CompanyName as vendor, p.PurposeName as Purpose,
                        dc.VehicleNo as 'Vehicle No', c.CountName as Count, p1.CompanyName as Mill, 
                        dcd.Brand, dcd.Bags, dcd.Quantity as Lbs");
        $this->db->from('delivery_challan dc');
        $this->db->join('delivery_challan_detail dcd','dc.Delivery_Challan_id = dcd.Delivery_Challan_id');
        $this->db->join('warehouse w','w.Warehouse_id = dcd.Warehouse_ID');
        $this->db->join('count c','c.Count_id = dcd.Count_id');
        $this->db->join('party p1','p1.Party_id = dcd.Mill_id');
        $this->db->join('party p2','p2.Party_id = dc.Party_id');
        $this->db->join('purpose p','p.Purpose_id = dc.Purpose_id');
        $this->db->where($where);
        $this->db->order_by('dc.ChallanDate', "asc");
        $this->db->order_by('dc.GatePassNo', "asc");
        $this->db->order_by('dc.DeliveryChallanNo', "asc");
        $this->db->order_by('w.WarehouseName', "asc");
        $this->db->order_by('p2.CompanyName', "asc");
        $this->db->order_by('p.PurposeName', "asc");
        $this->db->order_by('dc.VehicleNo', "asc");
        $this->db->order_by('c.CountName', "asc");
        $this->db->order_by('p1.CompanyName', "asc");
        $this->db->order_by('dcd.Brand', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnReceivingDateWiseSummary($dateFrom, $dateTo) {

        $where = "grn.ChallanDate between '$dateFrom' AND '$dateTo'";
        $this->db->select('c.CountName, sum(grnd.Bags) AS Bags, sum(grnd.ShortWeight) AS Shortage, sum(grnd.NetWeight) as Lbs');
        $this->db->from('good_receive_note grn');
        $this->db->join('good_receive_note_detail grnd','grn.Good_Receive_Note_id = grnd.Good_Receive_Note_id');
        $this->db->join('purchase_contract pc','pc.Purchase_contract_id = grnd.Purchase_contract_id');
        $this->db->join('party p1','p1.Party_id = pc.Broker_id');
        $this->db->join('party p2','p2.Party_id = pc.Mill_id');
        $this->db->join('warehouse w','w.warehouse_id = grnd.Warehouse_ID');
        $this->db->join('count c','c.count_id = pc.Count_id');
        $this->db->where($where);
        $this->db->order_by('c.CountName', "asc");
        $this->db->group_by('c.CountName', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnDeliveryDateAndPartyWiseSummary($dateFrom, $dateTo, $partyID) {

        $where = "dc.ChallanDate between '$dateFrom' AND '$dateTo' AND dc.Party_id = '$partyID' AND dc.isActive = 1";
        $this->db->select('u.UsageName, c.CountName, sum(dcd.Bags) as Bags, sum(dcd.Quantity) as Lbs');
        $this->db->from('delivery_challan dc');
        $this->db->join('delivery_challan_detail dcd','dc.Delivery_Challan_id = dcd.Delivery_Challan_id');
        $this->db->join('`usage` u','u.Usageid = dcd.Usage_id');
        $this->db->join('count c','c.Count_id = dcd.Count_id');
        $this->db->where($where);
        $this->db->order_by('u.UsageName', "asc");
        $this->db->order_by('c.CountName', "asc");
        $this->db->group_by('u.UsageName', "asc");
        $this->db->group_by('c.CountName', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnDeliveryDatewiseWeavingSummary($dateFrom, $dateTo) {

        $where = "dc.ChallanDate between '$dateFrom' AND '$dateTo' AND PurposeCode = '001' AND dc.isActive = 1";
        $this->db->select("u.UsageName as Weaving, sum(dcd.Bags) as Bags, sum(dcd.Quantity) as Lbs");
        $this->db->from('delivery_challan dc');
        $this->db->join('delivery_challan_detail dcd','dc.Delivery_Challan_id = dcd.Delivery_Challan_id');
        $this->db->join('`usage` u','u.Usageid = dcd.Usage_id');
        $this->db->join('warehouse w','w.Warehouse_id = dcd.Warehouse_ID');
        $this->db->join('party p1','p1.Party_id = dcd.Mill_id');
        $this->db->join('party p2','p2.Party_id = dc.Party_id');
        $this->db->join('purpose p','p.Purpose_id = dc.Purpose_id');
        $this->db->where($where);
        $this->db->group_by('u.UsageName', "asc");
        $this->db->order_by('u.Usageid', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnDeliveryDatewiseDoublingSummary($dateFrom, $dateTo) {

        $where = "dc.ChallanDate between '$dateFrom' AND '$dateTo' AND p.PurposeCode = '003' AND u.UsageName = 'Ground' AND dc.isActive = 1";
        $this->db->select("u.UsageName as Doubling, sum(dcd.Bags) as Bags, sum(dcd.Quantity) as Lbs");
        $this->db->from('delivery_challan dc');
        $this->db->join('delivery_challan_detail dcd','dc.Delivery_Challan_id = dcd.Delivery_Challan_id');
        $this->db->join('`usage` u','u.Usageid = dcd.Usage_id');
        $this->db->join('party p1','p1.Party_id = dcd.Mill_id');
        $this->db->join('party p2','p2.Party_id = dc.Party_id');
        $this->db->join('purpose p','p.Purpose_id = dc.Purpose_id');
        $this->db->where($where);
        $this->db->group_by('u.UsageName', "asc");
        $this->db->order_by('u.Usageid', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnDeliveryDatewiseGodownSummary($dateFrom, $dateTo) {

        $where = "dc.ChallanDate between '$dateFrom' AND '$dateTo' AND dc.isActive = 1";
        $this->db->select("w.WarehouseName as Godown, sum(dcd.Bags) as Bags, sum(dcd.Quantity) as Lbs");
        $this->db->from('delivery_challan dc');
        $this->db->join('delivery_challan_detail dcd','dc.Delivery_Challan_id = dcd.Delivery_Challan_id');
        $this->db->join('warehouse w','w.Warehouse_id = dcd.Warehouse_ID');
        $this->db->join('party p1','p1.Party_id = dcd.Mill_id');
        $this->db->join('party p2','p2.Party_id = dc.Party_id');
        $this->db->where($where);
        $this->db->group_by('w.WarehouseName', "asc");
        $this->db->order_by('w.WarehouseName', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function purchaseContractsAll($dateFrom, $dateTo) {

        $where = "pc.ContractDate between '$dateFrom' AND '$dateTo' AND pc.isActive = 1";
        $this->db->select("pc.ContractDate as Date, pc.SellerContractNo, pc.PurchaseContractNo as 'PC#', p1.CompanyName as Broker, 
			c.CountName as Count, p2.CompanyName as Mill, pc.Brand, pc.Rate, pc.Bags, pc.ContractAmount as Amount, pc.PaymentTerms,
			pc.Cartage, pc.isClosed as 'Status'");
        $this->db->from('purchase_contract pc');
        $this->db->join('party p1','p1.Party_id = pc.Broker_id');
        $this->db->join('party p2','p2.Party_id = pc.Mill_id');
        $this->db->join('count c','c.Count_id = pc.Count_id');
        $this->db->where($where);
        $this->db->order_by('pc.ContractDate', "asc");
        $this->db->order_by('pc.PurchaseContractNo', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function purchaseContractsClosed($dateFrom, $dateTo) {

        $where = "pc.ContractDate between '$dateFrom' AND '$dateTo' AND pc.isClosed = 1 AND pc.isActive = 1";
        $this->db->select("pc.ContractDate as Date, pc.SellerContractNo, pc.PurchaseContractNo as 'PC#', p1.CompanyName as Broker, 
			c.CountName as Count, p2.CompanyName as Mill, pc.Brand, pc.Rate, pc.Bags, pc.ContractAmount as Amount, pc.PaymentTerms,
			pc.Cartage");
        $this->db->from('purchase_contract pc');
        $this->db->join('party p1','p1.Party_id = pc.Broker_id');
        $this->db->join('party p2','p2.Party_id = pc.Mill_id');
        $this->db->join('count c','c.Count_id = pc.Count_id');
        $this->db->where($where);
        $this->db->order_by('pc.ContractDate', "asc");
        $this->db->order_by('pc.PurchaseContractNo', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function purchaseContractsOpened($dateFrom, $dateTo) {

        $where = "pc.ContractDate between '$dateFrom' AND '$dateTo' AND pc.isClosed = 0 AND pc.isActive = 1";
        $this->db->select("pc.ContractDate as Date, pc.SellerContractNo, pc.PurchaseContractNo as 'PC#', p1.CompanyName as Broker, 
			c.CountName as Count, p2.CompanyName as Mill, pc.Brand, pc.Rate, pc.Bags, pc.ContractAmount as Amount, pc.PaymentTerms,
			pc.Cartage");
        $this->db->from('purchase_contract pc');
        $this->db->join('party p1','p1.Party_id = pc.Broker_id');
        $this->db->join('party p2','p2.Party_id = pc.Mill_id');
        $this->db->join('count c','c.Count_id = pc.Count_id');
        $this->db->where($where);
        $this->db->order_by('pc.ContractDate', "asc");
        $this->db->order_by('pc.PurchaseContractNo', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnInwardPCWiseAll($dateFrom, $dateTo) {

        $where = "grn.ChallanDate between '$dateFrom' AND '$dateTo' AND grn.isActive = 1";
        $this->db->select("pc.PurchaseContractNo as PCNo, grn.ChallanDate, grn.ChallanNo, grn.GRNNo, p2.CompanyName as Mill, p1.CompanyName as Broker, 
			pc.Brand, c.CountName as Count, grnd.ShortWeight as Shortage, w.WarehouseName as Warehouse, grnd.Bags, grnd.Packing, grnd.NetWeight as Lbs");
        $this->db->from('good_receive_note grn');
        $this->db->join('good_receive_note_detail grnd','grn.Good_Receive_Note_id = grnd.Good_Receive_Note_id');
        $this->db->join('purchase_contract pc','pc.Purchase_contract_id = grnd.Purchase_contract_id');
        $this->db->join('count c','c.Count_id = pc.Count_id');
        $this->db->join('party p1','p1.Party_id = pc.Broker_id');
        $this->db->join('party p2','p2.Party_id = pc.Mill_id');
        $this->db->join('warehouse w','w.warehouse_id = grnd.Warehouse_ID');
        $this->db->where($where);
        $this->db->order_by('pc.PurchaseContractNo', "asc");
        $this->db->order_by('grn.ChallanDate', "asc");
        $this->db->order_by('grn.GRNNo', "asc");
        $this->db->order_by('p2.CompanyName', "asc");
        $this->db->order_by('p1.CompanyName', "asc");
        $this->db->order_by('pc.Brand', "asc");
        $this->db->order_by('c.CountName', "asc");
        $this->db->order_by('w.WarehouseName', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnInwardPCWiseAllSummary($dateFrom, $dateTo) {

        $where = "grn.ChallanDate between '$dateFrom' AND '$dateTo' AND grn.isActive = 1";
        $this->db->select("w.WarehouseName, c.CountName as Count, sum(grnd.ShortWeight) as Shortage, sum(grnd.Bags) as Bags, sum(grnd.NetWeight) as Lbs");
        $this->db->from('good_receive_note grn');
        $this->db->join('good_receive_note_detail grnd','grn.Good_Receive_Note_id = grnd.Good_Receive_Note_id');
        $this->db->join('purchase_contract pc','pc.Purchase_contract_id = grnd.Purchase_contract_id');
        $this->db->join('count c','c.Count_id = pc.Count_id');
        $this->db->join('warehouse w','w.warehouse_id = grnd.Warehouse_ID');
        $this->db->where($where);
        $this->db->group_by('w.WarehouseName', "asc");
        $this->db->group_by('c.CountName', "asc");
        $this->db->order_by('w.WarehouseName', "asc");
        $this->db->order_by('c.CountName', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnInwardContractWise($pcNo, $totalBags, $totalLbs) {

        $where = "pc.PurchaseContractNo = '$pcNo' AND grn.isActive = 1";
        $this->db->query('SET @bags := '.$totalBags);
        $this->db->query('SET @lbs := '.$totalLbs);
        $this->db->select("grn.ChallanDate, grn.ChallanNo, grn.GRNNo, grnd.ShortWeight as Shortage, w.WarehouseName as Warehouse, grnd.Bags, grnd.Packing, grnd.NetWeight as Lbs,
                            p2.CompanyName as Mill, p1.CompanyName as Broker, pc.Brand, c.CountName as Count, (@bags := @bags - grnd.Bags) as BalanceBags, (@lbs := @lbs - grnd.NetWeight) as BalanceLbs");
        $this->db->from('purchase_contract pc');
        $this->db->join('good_receive_note_detail grnd','pc.Purchase_contract_id = grnd.Purchase_contract_id');
        $this->db->join('count c','c.Count_id = pc.Count_id');
        $this->db->join('party p1','p1.Party_id = pc.Broker_id');
        $this->db->join('party p2','p2.Party_id = pc.Mill_id');
        $this->db->join('good_receive_note grn','grn.Good_Receive_Note_id = grnd.Good_Receive_Note_id', 'left');
        $this->db->join('warehouse w','w.warehouse_id = grnd.Warehouse_ID', 'left');
        $this->db->where($where);
        //$this->db->order_by('grn.ChallanDate', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function getPurchaseContractTotal($pcNo) {
        $where = "pc.PurchaseContractNo = '$pcNo'";
        $this->db->select("pc.Bags, pc.TotalWeight");
        $this->db->from('purchase_contract pc');
        $this->db->where($where);
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnStockPosition($warehouseID) {

        $where = "stock.warehouse_id = '$warehouseID' and stock.Lbs <> 0.00";
        //$where = "where stock.Lbs > 0.00";
        $this->db->select('CountName, Mill, Brand, WarehouseName, Bags, Lbs', false);
        $this->db->from('view_stockposition_info stock');
        $this->db->where($where);
        $this->db->order_by('stock.WarehouseName', "asc");
        $this->db->order_by('stock.CountName', "asc");
        $this->db->order_by('stock.Mill', "asc");
        $this->db->order_by('stock.Brand', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnStockPositionSummary($warehouseID) {

        $where = "stock_summary.warehouse_id = '$warehouseID'";
        //$where = "where stock.Lbs > 0.00";
        $this->db->select('CountName, WarehouseName, Bags, Lbs', false);
        $this->db->from('view_stockpositionsummary_info stock_summary');
        $this->db->where($where);
        $this->db->order_by('stock_summary.CountName', "asc");
        $this->db->order_by('stock_summary.WarehouseName', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnStockPositionGodowns($warehouseIDs, $date) {
        $where = "stock.TransactionDate <= DATE('$date')";
        $this->db->select('CountName, Mill, Brand, sum(Bags) as Bags, sum(Lbs) as Lbs', false);
        $this->db->from('view_stockpositiongodowns_info stock');
        $this->db->where_in('stock.WarehouseName', $warehouseIDs);
        $this->db->where($where);
        $this->db->group_by('stock.CountName', "asc");
        $this->db->group_by('stock.Mill', "asc");
        $this->db->group_by('stock.Brand', "asc");
        $this->db->having('sum(Lbs) <> 0');
        $this->db->order_by('stock.CountName', "asc");
        $this->db->order_by('stock.Mill', "asc");
        $this->db->order_by('stock.Brand', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnStockPositionSummaryGodowns($warehouseIDs, $date) {

//        $where = "stock_summary.TransactionDate <= DATE('$date')";
//        $this->db->select('CountName, sum(Bags) as Bags, sum(Lbs) as Lbs', false);
//        $this->db->from('view_stockpositiongodowns_info stock_summary');
//        $this->db->where_in('stock_summary.WarehouseName', $warehouseIDs);
//        $this->db->where($where);
//        $this->db->group_by('stock_summary.CountName', "asc");
//        $this->db->having('sum(Lbs) > 0');
//        $this->db->order_by('stock_summary.CountName', "asc");
        
        $where = "stock.TransactionDate <= DATE('$date')";
        //$this->db->select("stock.CountName, stock.Mill, stock.Brand, sum(stock.Bags) as Bags, sum(stock.Lbs) as Lbs", false);
        //$this->db->from('view_stockpositiongodowns_info stock');
        //$this->db->where($where);
        //$this->db->where('stock.warehouse_id', '1');
        //$this->db->group_by('stock.CountName');
        //$this->db->group_by('stock.Mill');
        //$this->db->group_by('stock.Brand');
        //$this->db->having('sum(stock.Lbs) > 0');
        //$this->db->order_by('stock.CountName', "asc");
        //$this->db->order_by('stock.Mill', "asc");
        //$this->db->order_by('stock.Brand', "asc");
        //$stock = $this->db->get_compiled_select('view_stockpositiongodowns_info stock');
        $stock = "(select stock.CountName, stock.Mill, stock.Brand, sum(stock.Bags) as Bags, sum(stock.Lbs) as Lbs "
                . "from view_stockpositiongodowns_info stock "
                . "where stock.TransactionDate <= DATE('$date')"
                . "group by stock.CountName, stock.Mill, stock.Brand "
                . "order by stock.CountName, stock.Mill, stock.Brand) as ss";
        $this->db->select('ss.CountName, sum(ss.Bags) as Bags, sum(ss.Lbs) as Lbs', false);
        $this->db->from("$stock");
        $this->db->group_by('ss.CountName');
        $this->db->order_by('ss.CountName', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnDoublingLedger($dateFrom, $dateTo, $partyID, $openingBalance) {
        $where = "yl.TransactionDate between '$dateFrom' AND '$dateTo' AND p.Party_id = '$partyID'";
        $this->db->query('SET @bal := '.$openingBalance);
        $this->db->select('yl.yarn_ledger_id, yl.party_id, p.CompanyName as Party, yl.TransactionDate as Date, 
			IFNULL(dc.DeliveryChallanNo,"") + IFNULL(yr.YarnReturnNo,"") as "DC#/YR#",
			yl.Description, c.CountName, yl.WeightIssue, yl.WeightReceived, (@bal := @bal + yl.WeightIssue - yl.WeightReceived) as Balance', false);
        $this->db->from('yarn_ledger yl');
        $this->db->join('delivery_challan dc','yl.yarn_delivery_id = dc.Delivery_Challan_id', 'left');
        $this->db->join('yarn_return yr','yl.yarn_return_id = yr.Yarn_Return_id', 'left');  
        $this->db->join('count c','c.Count_id = yl.Count_id');
        $this->db->join('party p','p.Party_id = yl.party_id');
        $this->db->where($where);
        $this->db->order_by('yl.TransactionDate', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
     function yarnDoublingLedgerOpeningBalance($dateFrom,  $partyID) {
        $where = "yl.TransactionDate < '$dateFrom' AND p.Party_id = '$partyID'";
        $this->db->select('IFNULL(sum(yl.WeightIssue) - sum(yl.WeightReceived), 0) as OpeningBalance', false);
        $this->db->from('yarn_ledger yl');
        $this->db->join('party p','p.Party_id = yl.party_id');
        $this->db->where($where);
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnGodownLedgerOpeningBalance($dateFrom,  $warehouseID) {
        $where = "ys.TransactionDate < '$dateFrom' AND ys.warehouse_id = '$warehouseID'";
        $this->db->select('IFNULL(sum(ys.Bags), 0) OpeningBalanceBags, IFNULL(sum(ys.Quantity), 0) as OpeningBalanceLbs', false);
        $this->db->from('yarn_stock ys');
        $this->db->where($where);
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnGodownLedger($dateFrom, $dateTo, $warehouseID) {
        $where = "ys.TransactionDate between '$dateFrom' AND '$dateTo' AND ys.warehouse_id = '$warehouseID'";
        $this->db->select('ys.TransactionDate as Date,
                           date(CONCAT(ifnull(grn.CreatedDate, ""),ifnull(dc.CreatedDate, ""), IFNULL(yr.CreatedDate, ""))) as CreatedDate,
                            CONCAT(IFNULL(CONCAT("GRN-",IFNULL(grn.GRNNo, NULL)), ""), 
                                    IFNULL(CONCAT("DC-",IFNULL(dc.DeliveryChallanNo, NULL)), ""), 
                                    IFNULL(CONCAT("YR-",IFNULL(yr.YarnReturnNo, NULL)),"")) as "GRN#/DC#/YR#",
			c.CountName as Count, 
			p1.CompanyName as Mill, 
			ys.Brand, 
			w.WarehouseName,
                        CONCAT(ifnull(p2.CompanyName, ""),ifnull(p3.CompanyName, "")) as Party,
			CASE WHEN ys.yarn_delivery_id is null THEN ys.Bags ELSE 0 END as "Receive(Bags)", 
			CASE WHEN ys.yarn_delivery_id is null THEN ys.Quantity ELSE 0 END  as "Receive(Lbs)",
			CASE WHEN ys.grn_id is null AND ys.yarn_return_id is null THEN -ys.Bags ELSE 0 END as "Issue(Bags)", 
			CASE WHEN ys.grn_id is null AND ys.yarn_return_id is null THEN -ys.Quantity ELSE 0 END  as "Issue(Lbs)"', false);
        $this->db->from('yarn_stock ys');
        $this->db->join('count c','ys.count_id = c.Count_id');
        $this->db->join('party p1','ys.mill_id = p1.Party_id');
        $this->db->join('warehouse w','ys.warehouse_id = w.Warehouse_id');
        $this->db->join('good_receive_note grn','grn.Good_Receive_Note_id = ys.grn_id', 'left');
        $this->db->join('delivery_challan dc','dc.Delivery_Challan_id = ys.yarn_delivery_id', 'left');
        $this->db->join('yarn_return yr','yr.Yarn_Return_id = ys.yarn_return_id', 'left');
        $this->db->join('party p2','dc.Party_id = p2.Party_id', 'left');
        $this->db->join('party p3','yr.Party_id = p3.Party_id', 'left');
        $this->db->where($where);
        $this->db->order_by('ys.TransactionDate', "asc");
        //$this->db->order_by('CreatedDate', "asc");
        $this->db->order_by('ys.yarn_stock_temp_id', "asc");
        //$this->db->order_by('yr.YarnReturnNo', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnLedgerOpeningBalance($dateFrom,  $millID, $countID) {
        $where = "ys.TransactionDate < '$dateFrom' AND ys.mill_id = '$millID' AND ys.count_id = '$countID'";
        $this->db->select('IFNULL(sum(ys.Bags), 0) OpeningBalanceBags, IFNULL(sum(ys.Quantity), 0) as OpeningBalanceLbs', false);
        $this->db->from('yarn_stock ys');
        $this->db->where($where);
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    
    function yarnLedger($dateFrom, $dateTo, $millID, $countID) {
        $where = "ys.TransactionDate between '$dateFrom' AND '$dateTo' AND ys.mill_id = '$millID' AND ys.count_id = '$countID'";
        $this->db->select('ys.TransactionDate as Date,
                            m.CompanyName as Mill,
                            c.CountName as Count,
                            date(CONCAT(ifnull(grn.CreatedDate, ""),ifnull(dc.CreatedDate, ""), IFNULL(yr.CreatedDate, ""))) as CreatedDate,
                            CONCAT(IFNULL(CONCAT("GRN-",IFNULL(grn.GRNNo, NULL)), ""), 
                                    IFNULL(CONCAT("DC-",IFNULL(dc.DeliveryChallanNo, NULL)), ""), 
                                    IFNULL(CONCAT("YR-",IFNULL(yr.YarnReturnNo, NULL)),"")) as "GRN#/DC#/YR#",
			CONCAT(ifnull(p2.CompanyName, ""),ifnull(p3.CompanyName, "")) as Party,
			CASE WHEN ys.yarn_delivery_id is null THEN ys.Bags ELSE 0 END as "Receive(Bags)", 
			CASE WHEN ys.yarn_delivery_id is null THEN ys.Quantity ELSE 0 END  as "Receive(Lbs)",
			CASE WHEN ys.grn_id is null AND ys.yarn_return_id is null THEN -ys.Bags ELSE 0 END as "Issue(Bags)", 
			CASE WHEN ys.grn_id is null AND ys.yarn_return_id is null THEN -ys.Quantity ELSE 0 END  as "Issue(Lbs)"', false);
        $this->db->from('yarn_stock ys');
        $this->db->join('good_receive_note grn','grn.Good_Receive_Note_id = ys.grn_id', 'left');
        $this->db->join('delivery_challan dc','dc.Delivery_Challan_id = ys.yarn_delivery_id', 'left');
        $this->db->join('yarn_return yr','yr.Yarn_Return_id = ys.yarn_return_id', 'left');
        $this->db->join('party p2','dc.Party_id = p2.Party_id', 'left');
        $this->db->join('party p3','yr.Party_id = p3.Party_id', 'left');
        $this->db->join('party m','ys.mill_id = m.Party_id');
        $this->db->join('count c','ys.count_id = c.Count_id');
        $this->db->where($where);
        $this->db->order_by('ys.TransactionDate', "asc");
        $this->db->order_by('ys.yarn_stock_temp_id', "asc");
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }
    

}
