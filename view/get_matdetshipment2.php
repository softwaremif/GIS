<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 4000;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'importdt.importdtpk';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
$po = isset($_GET['po']) ? ($_GET['po']) : false;
$importpk = isset($_GET['importpk']) ? ($_GET['importpk']) : false;
$caria = isset($_POST['caria']) ? ($_POST['caria']) : false;
$delsts = isset($_POST['delsts']) ? ($_POST['delsts']) : false;

$offset = ($page - 1) * $rows;


if ($caria) {
    $and1 = "and concat(ord.ordno,podt.spec,podt.colname,podt.colcode,podt.sizegar) like '%$caria%'";
}

if ($delsts) {
    $and2 = "and podt.delsts<>'$delsts'";
}

$rs = mysqli_query($koneksi, "SELECT * from importdt
left outer join podt on podt.podtpk=importdt.podtpk
left outer join sup on sup.suppk=podt.suppk
left outer join cur on cur.curpk=podt.curpk
where importdt.popk='$po' 
GROUP BY importdt.podtpk
ORDER BY $sort $order
LIMIT $rows OFFSET $offset");
$all = mysqli_query($koneksi, "SELECT * from importdt
left outer join podt on podt.podtpk=importdt.podtpk
left outer join sup on sup.suppk=podt.suppk
left outer join cur on cur.curpk=podt.curpk
where importdt.popk='$po'
ORDER BY $sort $order
LIMIT $rows OFFSET $offset");
$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "SELECT * from importdt
left outer join podt on podt.podtpk=importdt.podtpk
left outer join sup on sup.suppk=podt.suppk
left outer join cur on cur.curpk=podt.curpk
where importdt.popk='$po'
-- GROUP BY importdt.podtpk"));
$k = $offset;

$dt = array();
$row = array();

$qrya=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM importdt
where importdt.popk='$po'
GROUP BY importpk"));
$dtqrya=mysqli_query($koneksi, "SELECT * FROM importdt
where importdt.popk='$po'
GROUP BY importpk");
$dataqrya=mysqli_fetch_all($dtqrya, MYSQLI_ASSOC);

$dataAll = mysqli_fetch_all($all, MYSQLI_ASSOC);
$numDataAllRows = count($dataAll);

$i=0;

    for($i=0;$i<$qrya;$i++){
        
       $dataku=$dataqrya[$i];
       $qryb=mysqli_query($koneksi, "SELECT * from importdt
                        left outer join podt on podt.podtpk=importdt.podtpk
                        left outer join sup on sup.suppk=podt.suppk
                        left outer join cur on cur.curpk=podt.curpk
                        where importdt.popk='$po' and importdt.importpk='$dataku[importpk]'
                        ORDER BY importpk ASC");
        $j = 0;
        while ($dta=mysqli_fetch_array($qryb)) {
            $dt[$j]['shipment'.$i] = $dta['qtys'];
            $j++;
        }
    }

$result['dt'] = $dt;

$dataRS = mysqli_fetch_all($rs, MYSQLI_ASSOC);
$numDataRSRows = count($dataRS);

$l = 0;

for ($i = 0; $i < $numDataRSRows; $i++) {
    $data = $dataRS[$i];
    
    $rowItem = array(
        'item' => $data['item'],
        'spec' => $data['spec'],
        'supnm' => $data['supnm'],
        'pocons1a' => $data['pocons'],
        'unit' => $data['unit']
    );
    for ($l = 0; $l < $qrya; $l++) {
        $dtuhuy = $dt[$i];
        $shipment = isset($dtuhuy['shipment' . $l]) ? $dtuhuy['shipment' . $l] : 0;
        $rowItem['pocons' . ($l + 1)] = $dtuhuy['shipment' . $l];
        $rowItem['balance'] += $dtuhuy['shipment' . $l];
    }
    $rowItem['colname'] = trim($data['colname']);
    $rowItem['balance2'] = $rowItem['balance']-$data['pocons'];

    if($rowItem['balance2']>0){
        $rowItem['balance2b']="<span style='color:#00e346;'><b>+".$rowItem['balance2']."</b></span>";
    }else if($rowItem['balance2']==0){
        $rowItem['balance2b']="-";
    }else{
        $rowItem['balance2b']="<span style='color:#ff2f3d;'><b>".$rowItem['balance2']."</b></span>";
    }
  
   

    $row[] = $rowItem;
}

$result = array_merge($result, array('rows' => $row));
echo json_encode($result);
?>




