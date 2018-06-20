<?php

if ($type === "GRN") {
    //Enter the headings of the excel columns
    $contents = ",,,,,,,GOODS RECEIVE NOTE,,,,,,,,,,,,\n";
    $contents .= ",,,,,,,  PREMIER TOWELS,,,,,,,,,,,,\n";
    $contents .= ",,,,,,Plot # 17 Sector 6-A North Karachi-75850,,,,,,,,,,,, ,,,\n";
    $contents .= ",,,,,,Ph: 36921841 36921842 Fax: 9221-6924445,,,,,,,,\n";
    $contents .= ",,,Dated," . date("d-M-Y", strtotime($data[0]['ChallanDate'])) . ",,,,,,,,,,,,,,,,\n";
    $contents .= ",,,Challan #," . $data[0]['ChallanNo'] . ",,,,,,,GRN #," . 'GRN-' . $data[0]['GRNNo'] . ",,, \n";
    $contents .= ",,,,,,,,,,,,,,,,,,, \n";
    $contents .= ",,,,,,,,,,,,,,,,,,, \n";
    $contents .= ",,, PC#,Count,Mill,Brand,Seller Contract #,Contract Date,Bags,Packing (lbs),Total Weight (lbs),Shortage Weight (lbs),Net Weight (lbs),Warehouse\n";

    $count = 1;
    foreach ($data as $key => $allData) {
        $contents.=",,," . 'PC-' . $allData['PurchaseContractNo'] . ",";
        $contents.=$allData['CountName'] . ",";
        $contents.=$allData["Mill"] . ",";
        $contents.=$allData["Brand"] . ",";
        $contents.=$allData["SellerContractNo"] . ",";
        $contents.=date("d-M-Y", strtotime($allData['ContractDate'])) . ",";
        $contents.=$allData["Bags"] . ",";
        $contents.=$allData["Packing"] . ",";
        $contents.=$allData["TotalWeight"] . ",";
        $contents.=$allData["ShortWeight"] . ",";
        $contents.=$allData["NetWeight"] . ",";
        $contents.=$allData["WarehouseName"] . ",\n";
    }
    $contents .= ",,,,,,,,,,,,,,\n";
    $contents .= ",,,,,,,,,,,,,,\n";
    $contents .= ",,,,,,,,,,,,,,\n";
    $contents .= ",,,Receiving (Name and Signature),,,,,,,,,,Signature\n";

// remove html and php tags etc.
    $contents = strip_tags($contents);
//header to make force download the file
    print $contents;
//header("Content-Disposition: attachment; filename=Toyota-DMS-" . date('d-m-Y') . ".csv");
    header("Content-Disposition: attachment; filename=" . $fileName);
} elseif ($type === "YarnDelivery") {

    //Enter the headings of the excel columns
    $contents = ",,,,,,,YARN DELIVERY CHALLAN,,,,,,,,,,,,\n";
    $contents .= ",,,,,,,  PREMIER TOWELS,,,,,,,,,,,,\n";
    $contents .= ",,,,,,Plot # 17 Sector 6-A North Karachi-75850,,,,,,,,,,,, ,,,\n";
    $contents .= ",,,,,,Ph: 36921841 36921842 Fax: 9221-6924445,,,,,,,,\n\n";
    $contents .= ",,,Dated," . date("d-M-Y", strtotime($data[0]['ChallanDate'])) . ",,,Gate Pass #," . 'GP-' . $data[0]['GatePassNo'] . ",,,Challan #," . 'DC-' . $data[0]['DeliveryChallanNo'] . ", \n";
    $contents .= ",,,Purpose," . $data[0]['PurposeName'] . ",,,Deliver To," . $data[0]['CompanyName'] . ",,,\n";
    $contents .= ",,,,,,,,,,,,,,,,,,, \n";
    $contents .= ",,,,,,,,,,,,,,,,,,, \n";
    $contents .= ",,, S.No,Count,Mill,Brand,Usage,Warehouse,Bags,Total Quantity(lbs),\n";

    $Counter = 1;
    $totalBags = 0;
    $totalQty = 0;
    foreach ($data as $key => $allData) {
        $totalBags +=$allData['Bags'];
        $totalQty +=$allData['Quantity'];

        $contents.=",,," . $Counter++ . ",";
        $contents.=$allData['CountName'] . ",";
        $contents.=$allData["Mill"] . ",";
        $contents.=$allData["Brand"] . ",";
        $contents.=$allData['UsageName'] . ",";
        $contents.=$allData['WarehouseName'] . ",";
        $contents.=$allData["Bags"] . ",";
        $contents.=$allData["Quantity"] . ",\n";
    }
    $contents .= ",,,,,,,,Total," . $totalBags . "," . $totalQty . ",\n";
    $contents .= ",,,,,,,,,,,,,,\n";
    $contents .= ",,,,,,,,,,,,,,\n";
    $contents .= ",,,Receive the above goods in perfect condition,,,,,,,,,,\n";
    $contents .= ",,,Vehicle #," . $data[0]['VehicleNo'] . ",,,,,,,_______________,\n";
    $contents .= ",,,(Name and Signature),,,,,,,,For Premier Towels\n";

// remove html and php tags etc.
    $contents = strip_tags($contents);
//header to make force download the file
    print $contents;
//header("Content-Disposition: attachment; filename=Toyota-DMS-" . date('d-m-Y') . ".csv");
    header("Content-Disposition: attachment; filename=" . $fileName);
} elseif ($type === "PC") {
    //Enter the headings of the excel columns
    $contents = ",,,,,,,PURCHASE CONTRACT,,,,,,,,,,,,\n";
    $contents .= ",,,,,,,  PREMIER TOWELS,,,,,,,,,,,,\n";
    $contents .= ",,,,,,Plot # 17 Sector 6-A North Karachi-75850,,,,,,,,,,,, ,,,\n";
    $contents .= ",,,,,,Ph: 36921841 36921842 Fax: 9221-6924445,,,,,,,,\n\n\n";
    $contents .= ",,,,,Dated," . date("d-M-Y", strtotime($data[0]['ContractDate'])) . ",,,,,,,,,,,,,,,,\n";
    $contents .= ",,,,,Purchase Contract #," . 'PC-' . $data[0]['PurchaseContractNo'] . ",,,Broker," . $data[0]['Broker'] . ",\n";
    $contents .= ",,,,,Count," . $data[0]['CountName'] . ",,,Mill," . $data[0]['Mill'] . ",\n";
    $contents .= ",,,,,Brand," . $data[0]['Brand'] . ",,,Seller Contract#," . $data[0]['SellerContractNo'] . ",\n";
    $contents .= ",,,,,Rate/10 lbs," . number_format($data[0]['Rate']) . ",,,No. of Bags," . $data[0]['Bags'] . ",\n";
    $contents .= ",,,,,Total Weight(lbs)," . $data[0]['TotalWeight'] . ",,,Contract Amount," . $data[0]['ContractAmount'] . ",\n";
    $contents .= ",,,,,Payment Terms," . $data[0]['PaymentTerms'] . ",,,Cartage," . $data[0]['Cartage'] . ",\n";
    $contents .= ",,,,,Remarks," . $data[0]['Remarks'] . ",,,,,\n";
// remove html and php tags etc.
    $contents = strip_tags($contents);
//header to make force download the file
    print $contents;
//header("Content-Disposition: attachment; filename=Toyota-DMS-" . date('d-m-Y') . ".csv");
    header("Content-Disposition: attachment; filename=" . $fileName);
} elseif ($type === "YarnReturn") {
    //Enter the headings of the excel columns
    $contents = ",,,,,,,    YARN RETURN,,,,,,,,,,,,\n";
    $contents .= ",,,,,,,  PREMIER TOWELS,,,,,,,,,,,,\n";
    $contents .= ",,,,,,Plot # 17 Sector 6-A North Karachi-75850,,,,,,,,,,,, ,,,\n";
    $contents .= ",,,,,,Ph: 36921841 36921842 Fax: 9221-6924445,,,,,,,,\n\n";
    $contents .= ",,,Dated," . $data[0]['ReturnDate'] . ",,,Yarn Return #," . 'YR-' . $data[0]['YarnReturnNo'] . ", \n";
    $contents .= ",,,Return Type," . $data[0]['ReturnType'] . ",,,Returned From," . $data[0]['CompanyName'] . ",,,\n";
    $contents .= ",,,,,,,,,,,,,,,,,,, \n";
    $contents .= ",,,,,,,,,,,,,,,,,,, \n";
    $contents .= ",,, S.No,Count,Mill,Brand,Warehouse,Wastage Allowed(%)(lbs),Bags,Total Quantity(lbs),\n";

    $Counter = 1;
    $totalBags = 0;
    $totalQty = 0;
    foreach ($data as $key => $allData) {
        $totalBags +=$allData['Bags'];
        $totalQty +=$allData['Quantity'];

        $contents.=",,," . $Counter++ . ",";
        $contents.=$allData['CountName'] . ",";
        $contents.=$allData["Mill"] . ",";
        $contents.=$allData["Brand"] . ",";
        $contents.=$allData['WarehouseName'] . ",";
        $contents.=$allData['WastagePercent'] . ",";
        $contents.=$allData["Bags"] . ",";
        $contents.=$allData["Quantity"] . ",\n";
    }
    $contents .= ",,,,,,,,Total," . $totalBags . "," . $totalQty . ",\n";

// remove html and php tags etc.
    $contents = strip_tags($contents);
//header to make force download the file
    print $contents;
//header("Content-Disposition: attachment; filename=Toyota-DMS-" . date('d-m-Y') . ".csv");
    header("Content-Disposition: attachment; filename=" . $fileName);
}

