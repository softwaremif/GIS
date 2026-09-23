<?php
ob_clean();
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "../config/koneksi11s.php";
$thn = DATE('Y');
$thn2 = $thn - 2;
$today = DATE('Y-m-d');

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'r.srno';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
$carisr = isset($_POST['carisr']) ? ($_POST['carisr']) : false;

$offset = ($page - 1) * $rows;

// echo "Page: ".$page;
// echo " Rows: ".$rows;
// echo " Offset: ".$offset;
// die();

$and = "";
if ($carisr) {
    // $and = "";
    // if ($carisr) {
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
    // }
} 
// else {
//     $and = "";
// }

// $sql_debug = "SELECT * FROM request
// left outer join buyer on buyer.buyerpk=request.buyerpk
// left outer join status on status.srpk=request.srpk
// where request.buyerpk>0 
// and YEAR(status.date) >= '$thn2' 
// $and
// group by request.srpk
// ORDER BY $sort $order
// LIMIT $rows OFFSET $offset";

// $countQuery = "
// SELECT COUNT(DISTINCT request.srpk) as total
// FROM request
// LEFT OUTER JOIN buyer ON buyer.buyerpk=request.buyerpk
// LEFT OUTER JOIN status ON status.srpk=request.srpk
// WHERE request.buyerpk>0
// AND YEAR(status.date) >= '$thn2'
// $and
// ";

// $countResult = mysqli_query($koneksi11s, $countQuery);
// $countRow = mysqli_fetch_assoc($countResult);
// $result['total'] = $countRow['total'];

// print_r($countRow);
// die();

// $rs = mysqli_query($koneksi11s, "SELECT request.srpk, request.srno, request.style,
// buyer.buyernm, status.description
// FROM request
// LEFT JOIN buyer ON buyer.buyerpk=request.buyerpk
// LEFT JOIN status ON status.srpk=request.srpk
// WHERE request.buyerpk>0 
// AND (status.date IS NULL OR YEAR(status.date) >= '$thn2')
// $and
// GROUP BY request.srpk
// ORDER BY $sort $order
// LIMIT $rows OFFSET $offset");

// $result = array();
// $result['total'] = mysqli_num_rows(mysqli_query($koneksi11s, "SELECT request.srpk, request.srno, request.style,
// buyer.buyernm, status.description
// FROM request
// LEFT JOIN buyer ON buyer.buyerpk=request.buyerpk
// LEFT JOIN status ON status.srpk=request.srpk
// WHERE request.buyerpk>0 
// AND (status.date IS NULL OR YEAR(status.date) >= '$thn2')
// $and
// GROUP BY request.srpk"));
// $row = array();

$rs = mysqli_query($koneksi11s, "
 SELECT r.srpk, r.srno, s.style,
           b.buyernm,
           MAX(s.description) as description
    FROM request r
    LEFT JOIN buyer b ON b.buyerpk = r.buyerpk
    LEFT JOIN status s ON s.srpk = r.srpk
    WHERE r.buyerpk > 0
      AND (s.date IS NULL OR YEAR(s.date) >= '$thn2')
      $and
    GROUP BY r.srpk
    ORDER BY $sort $order
    LIMIT $rows OFFSET $offset
");

// if(!$rs){
//     die("QUERY RS ERROR: " . mysqli_error($koneksi11s));
// }

// echo "RS OK\n";

$result = array();

// total data (tanpa limit)
$count = mysqli_query($koneksi11s, "
 SELECT r.srpk, r.srno, s.style,
           b.buyernm,
           MAX(s.description) as description
    FROM request r
    LEFT JOIN buyer b ON b.buyerpk = r.buyerpk
    LEFT JOIN status s ON s.srpk = r.srpk
    WHERE r.buyerpk > 0
    AND (s.date IS NULL OR YEAR(s.date) >= '$thn2')
      $and
    GROUP BY r.srpk
");

$result["total"] = mysqli_num_rows($count);

// ambil data
$rows_data = array();

// if(!$count){
//     die("QUERY COUNT ERROR: " . mysqli_error($koneksi11s));
// }

// echo "COUNT OK\n";

$k = $offset;
mysqli_set_charset($koneksi11s, "utf8mb4");  
// while ($data = mysqli_fetch_array($rs)) {
while($data = mysqli_fetch_assoc($rs)){
    $k++;
    $act = '<a href="#" style="text-decoration:none; color:#359DD9;">Select</a>';
    $rows_data[] = array(
        'no' => $k,
        'srpk' => $data['srpk'],
        'srno' => $data['srno'],
        'style' => $data['style'],
        'buyernm' => $data['buyernm'],
        'prodes' => $data['description'],
        'act' => $act
    );
}
// $result = array_merge($result, array('rows' => $row));
// echo json_encode($result);

$result["rows"] = $rows_data;

echo json_encode($result);
// echo json_encode([
//   "total" => 1,
//   "rows" => [
//     ["srno"=>"TEST","style"=>"TEST","prodes"=>"TEST","buyernm"=>"TEST","act"=>"TEST"]
//   ]
// ]);
?>