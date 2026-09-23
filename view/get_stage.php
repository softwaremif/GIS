<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi11s.php";

$srpk = isset($_GET['srpk']) ? ($_GET['srpk']) : false;

$rs = mysqli_query($koneksi11s, "SELECT request.srno, status.opsi, status.statuspk, stage.stagenm, status.date, status.stagepk, status.samplenm
FROM status
left outer join stage on stage.stagepk=status.stagepk
left outer join request on request.srpk=status.srpk
where status.stagepk>0 and status.srpk='$srpk'
group by status.statuspk
ORDER BY status.statuspk desc");

$result = array();

// $result['total'] = mysqli_num_rows(mysqli_query($koneksi11s, "SELECT * FROM status
// left outer join request on request.srpk=status.srpk
// left outer join stage on stage.stagepk=status.stagepk
// where status.stagepk>0 and status.srpk='$srpk'
// group by status.statuspk"));
// $row = array();

while ($data = mysqli_fetch_array($rs)) {
    // $row[] = array(
    //     'statuspk' => $data['statuspk'],
    //     'stagenm' => $data['stagenm']
    // );
    if($data['stagepk']==8){
    $stagenm=$data['samplenm'];
    } else {
    $stagenm=$data['stagenm'];
    }

    if($data['opsi']<>''){
    $opsi="<b>".$data['srno']."(".$data['opsi'].")- </b>";
    } else {
    $opsi="<b>".$data['srno']."- </b>";
    }

    array_push($result,    
    $row[] = array(
            'statuspk' => $data['statuspk'],
            'stagenm' => $opsi."".$stagenm." (".$data['date'].")"
        ));
}
// $result = array_merge($result, array('rows' => $row));
echo json_encode($result);
?>