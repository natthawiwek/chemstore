<?php
    $_POST = json_decode(file_get_contents('php://input'), true);
    include 'connect.php';
    $type = $_POST['type'];

    isset($_POST['locationF']) ? $locF = $_POST['locationF'] : $locF = null;
    isset($_POST['locationT']) ? $locT = $_POST['locationT'] : $locT = null;
    isset($_POST['stDt']) ? $stDt = date("Y-m-d", strtotime($_POST['stDt'])) : $stDt = null;
    isset($_POST['edDt']) ? $edDt =  date("Y-m-d", strtotime($_POST['edDt'])) : $edDt = null;
    isset($_POST['no']) ? $no = $_POST['no'] : $no = null;
    
    if($type == "all"){
        $sql = "SELECT ce.*,ca_tname,ca_fname,ca_lname FROM `chem_exchange` AS ce ";
    }
    else{
        $sql = "SELECT ce.*,ca_tname,ca_fname,ca_lname FROM `chem_exchange` AS ce ";
        $sql .= "INNER JOIN chem_account ON ce_ca_fk = ca_pk ";
        $sql .= "WHERE `ce_crtDt` BETWEEN '".$stDt."' AND '".$edDt."'";
        $sql .= " AND ce_no LIKE 'NO.".$type."%' ";
    }
    
    if($no != null){
        $sql .= " AND ce_no LIKE '%".$no."%' ";
    }
//
//    if($locF != null && $locT != null){
//        $sql .= " AND ce_fromstore LIKE '%".$no."%' ";
//        $sql .= " AND ce_tostore '%".$no."%' ";
//    }
    
    $sql .= "ORDER BY ce_crtDt DESC";
    echo json_encode($sql);
//    $query = mysql_query($sql);
//    $data=array();
//    while($row = mysql_fetch_array ($query))
//    {
//        array_push($data,$row);
//    }
//    echo json_encode($data);
?>