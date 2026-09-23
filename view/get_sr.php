<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi11s.php";
$thn = DATE('Y');
$thn2 = $thn - 2;
$today = DATE('Y-m-d');

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'request.srno';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
$carisr = isset($_POST['carisr']) ? ($_POST['carisr']) : false;

$offset = ($page - 1) * $rows;

// if ($carisr <> "") {
    $and = "";
    if ($carisr) {
        $carisr_values = explode(";", $carisr);
        $multiple_search = [];

        foreach ($carisr_values as $value) {
            $trimmed_value = trim($value);
            $multiple_search[] = "concat(
            COALESCE(request.srno, ''), 
            COALESCE(buyer.buyernm, ''), 
            COALESCE(status.description, ''), 
            COALESCE(status.style, '')
            ) like '%$trimmed_value%'";
        }

        $and = "AND (" . implode(" OR ", $multiple_search) . ")";
    }
// } else {
//     $and = "";
// }
mysqli_set_charset($koneksi11s, "utf8mb4");
$rs = mysqli_query($koneksi11s, "SELECT * FROM request
left outer join buyer on buyer.buyerpk=request.buyerpk
left outer join status on status.srpk=request.srpk
where request.buyerpk>0 and status.style<>''
-- and YEAR(status.date) >= '$thn2' 
$and
group by request.srpk, status.style
ORDER BY $sort $order
LIMIT $rows OFFSET $offset");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi11s, "SELECT * FROM request
left outer join buyer on buyer.buyerpk=request.buyerpk
left outer join status on status.srpk=request.srpk
where request.buyerpk>0 and status.style<>''
-- and YEAR(status.date) >= '$thn2' 
$and group by request.srpk, status.style"));
$row = array();

$k = $offset;

while ($data = mysqli_fetch_array($rs)) {
    $k++;
    $act = '<a href="#" style="text-decoration:none; color:#359DD9;">Select</a>';
    $row[] = array(
        'no' => $k,
        'srpk' => $data['srpk'],
        'srno' => $data['srno'],
        'style' => $data['style'],
        'buyernm' => $data['buyernm'],
        'prodes' => $data['description'],
        'act' => $act
    );
}
$result = array_merge($result, array('rows' => $row));
echo json_encode($result);
?>