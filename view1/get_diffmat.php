<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
//include "../action/sinkron2.php";

$bln=date("m");
//$thn=date("Y");

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ord.ordno';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
$user = isset($_GET['user']) ? ($_GET['user']) : false;
$carpo = isset($_POST['carpo']) ? ($_POST['carpo']) : false;

$offset = ($page-1) * $rows;

$cr=mysqli_query($koneksi,"select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$user'");
$dt=mysqli_fetch_array($cr);

if($dt['spv']==1){ $and2="and fu.fupk='$dt[fupk]' and po.fu='$dt[funm]'"; }
else { $and2="and ord.userpk='$dt[userpk]' and po.fu='$dt[funm]'"; }

$rs = mysqli_query($koneksi,"SELECT *  FROM podt
left outer join po on po.popk=podt.popk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=podt.suppk
LEFT OUTER JOIN cur ON  cur.curpk=podt.curpk
left outer join byr on byr.byrpk=ord.byrpk
WHERE podt.delsts='0' and po.pur is null and po.popk='$carpo' $and2
ORDER BY $sort $sort1 $sort2");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"SELECT *  FROM podt
left outer join po on po.popk=podt.popk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=podt.suppk
LEFT OUTER JOIN cur ON  cur.curpk=podt.curpk
left outer join byr on byr.byrpk=ord.byrpk
WHERE podt.delsts='0' and po.pur is null and po.popk='$carpo' $and2"));
$row = array();

$k =$offset;
while($data=mysqli_fetch_array($rs)){
$k++;
//$btn = '<a href="javascript:void(0)" style="text-decoration:none;">GET</a>';
if($data['curid']=="IDR"){
if($data['price']=="0.00000"){
$price="-";
$total="-";
} else {
$price=number_format($data['price'],2,".",",")." ".$data['curid'];
$tot=$data['price']*$data['pocons'];
$total=$data['curid']." ".number_format($tot,2,".",",");
}
} else {
if($data['price']=="0.00000"){
$price="-";
$total="-";
} else {
$price=number_format($data['price'],5,".",",")." ".$data['curid'];
$tot=$data['price']*$data['pocons'];
$total=$data['curid']." ".number_format($tot,5,".",",");
}
}

$qty=number_format($data['bdownqty'],0,".",",");
$pocons1=ceil($data['pocons']);
$pocons=number_format($pocons1,0,".",",");

$specb=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³]/', ' ', $data['spec']);
$spec=TRIM($specb);
$sizeb=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³]/', ' ', $data['sizegar']);
$sizegar=TRIM($sizeb);

//$supnm = "<input type='radio' name='po' id='po' onclick=''> Group (".TRIM($data['supnm']).")
// <input type='checkbox' name='cari' id='cari' onclick='search();' value='1' checked> Separate by item
// <input type='checkbox' name='cari' id='cari' onclick='search();' value='2'> Separate by color ";
 
$supnm = "Group (".TRIM($data['supnm']).")";
$cek="<input type='checkbox' name='cek' id='cek' onclick='menu();'>";


if($spec==""){ $specc="NA"; } else { $specc=$spec; }
if($sizegar==""){ $sizegarr="NA"; } else { $sizegarr=$sizegar; }
if($data['colname']==""){ $colnamee="NA"; } else { $colnamee=$data['colname']; }

$spono=$data['pono'];
$sordno=$data['ordno'];
$sitem=$data['item'];
$sspec=$spec;
$ssupnm=$data['supnm'];
$ssizegar=$sizegar;
$scolname=$data['colname'];
$sqty=$qty;
$spocons=$pocons;
$sunit=$data['unit'];

$cr2=mysqli_query($koneksi,"select * from rpo where rkbpk='$data[rkbpk]'");
$dt2=mysqli_fetch_array($cr2);

if($dt2['poreqdel']=="0000-00-00"){ $poreqdel=""; $poreqdel2=""; }
else {
if($dt2['poreqdel']==""){ $poreqdel=""; $poreqdel2=""; }
else { $poreqdel=$dt2['poreqdel']; $poreqdel2=tgl($dt2['poreqdel']); }
}

if($dt2['tgljam']=="0000-00-00 00:00:00"){ $tgljam=""; $tgljam2=""; }
else {
if($dt2['tgljam']==""){ $tgljam=""; $tgljam2=""; }
else { $tgljam=$dt2['tgljam']; $tgljam2=tgl($dt2['tgljam']); }
}

$row[] = array(
'no'=>$k,
'cek'=>$cek,
'ordpk'=>$data['ordpk'],
'ordno'=>" OP ".$sordno,
'popk'=>$data['popk'],
'pono'=>$spono,
//'pono2'=>$data['pono'],
'fupk'=>$data['fupk'],
'funm'=>$data['funm'],
'byrnm'=>$data['byrnm'],
'suppk'=>$data['suppk'],
'supnm'=>$ssupnm,
'supnm2'=>$supnm,
'sup'=>$data['sup'],
'suppk'=>$data['suppk'],
'podtpk'=>$data['podtpk'],
'rpopk'=>$data['rpopk'],
'rkbpk'=>$data['rkbpk'],
'nour'=>$data['nour'],
'item'=>$sitem,
'itemadd'=>$data['itemadd'],
'spec'=>$sspec,
'specadd'=>$data['specadd'],
'tspec'=>$data['tspec'],
'hspec1'=>$data['hspec1'],
'hspec2'=>$data['hspec2'],
'hspec3'=>$data['hspec3'],
'hspec4'=>$data['hspec4'],
'hspec5'=>$data['hspec5'],
'hspec6'=>$data['hspec6'],
'spec1'=>$data['spec1'],
'spec2'=>$data['spec2'],
'spec3'=>$data['spec3'],
'spec4'=>$data['spec4'],
'spec5'=>$data['spec5'],
'spec6'=>$data['spec6'],
'sizegar'=>$ssizegar,
'qty'=>$sqty,
'unit'=>$sunit,
'colname'=>$scolname,
'colcode'=>$data['colcode'],
'price'=>$price,
'price2'=>$data['price'],
'curpk'=>$data['curpk'],
'curid'=>$data['curid'],
'kelnm'=>$kelnm,
'bdownqty'=>$data['bdownqty'],
'kolom'=>$data['kolom'],
'bdownpk'=>$data['bdownpk'],
'allowcons'=>$data['allowcons'],
'negocons'=>$data['negocons'],
'estcons'=>$data['estcons'],
'varcons'=>$data['varcons'],
'totcons'=>$data['totcons'],
'qrs'=>$data['qrs'],
'pocons'=>$pocons,
'satus'=>$sts,
'stspk'=>$data['stspk'],
'poreqdel'=>$poreqdel,
'poreqdel2'=>$poreqdel2,
/*'podel'=>$data['podel'],*/
'tgljam'=>$tgljam,
'tgljam2'=>$tgljam2);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>