<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

session_start();
include "../config/koneksi11s.php";
$thn = DATE('Y');
$thn2 = $thn - 2;
$today = DATE('Y-m-d');

$carisr = isset($_POST['carisr']) ? ($_POST['carisr']) : false;
$page  = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page - 1) * $rows;

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

/* ================= QUERY DATA ================= */
$rs = mysqli_query($koneksi11s, "
 SELECT r.srpk, r.srno, s.style,
        b.buyernm,
        MAX(s.description) as description
 FROM request r
 LEFT JOIN buyer b ON b.buyerpk = r.buyerpk
 LEFT JOIN status s ON s.srpk = r.srpk
 WHERE r.buyerpk > 0
 AND (s.date IS NULL OR YEAR(s.date) >= '$thn2')
 GROUP BY r.srpk
 ORDER BY r.srpk DESC
 LIMIT $rows OFFSET $offset
");

$rows_data = array();
$no = $offset + 1;

while($data = mysqli_fetch_assoc($rs)){
    $act = '<a href="#" style="text-decoration:none; color:#359DD9;">Select</a>';

    $rows_data[] = array(
        'no'      => $no++,
        'srpk'    => $data['srpk'],
        'srno'    => $data['srno'],
        'style'   => $data['style'],
        'buyernm' => $data['buyernm'],
        'prodes'  => $data['description'],
        'act'     => $act
    );
}

/* ================= QUERY COUNT ================= */
$count = mysqli_query($koneksi11s, "
SELECT COUNT(DISTINCT r.srpk) AS total
 FROM request r
 LEFT JOIN buyer b ON b.buyerpk = r.buyerpk
 LEFT JOIN status s ON s.srpk = r.srpk
 WHERE r.buyerpk > 0
 AND (s.date IS NULL OR YEAR(s.date) >= '$thn2')
");

$row_count = mysqli_fetch_assoc($count);
// $result["total"] = mysqli_num_rows($count);
$total = $row_count['total'];

/* ================= RETURN JSON ================= */
$result = array(
    "total" => $total,
    "rows"  => $rows_data
);

echo json_encode($result);
exit;
