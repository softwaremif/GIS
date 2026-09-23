<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
//include "../action/sinkron2.php";

$bln=date("m");
$thn=date("Y");

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 200;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'po.tglpo';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$user = isset($_GET['user']) ? ($_GET['user']) : false;

$offset = ($page-1) * $rows;

if($cari1<>""){
$and1="and concat(ord.ordno,rpo.item,sup.supnm) like '%$cari1%'";
}

$cr=mysqli_query($koneksi,"select * from user where userpk='$user'");
$dt=mysqli_fetch_array($cr);

if($dt['spv']==1){ $and2="and fu.fupk='$dt[fupk]'"; }
else { $and2="and ord.userpk='$dt[userpk]'"; }

$rs = mysqli_query($koneksi,"SELECT podt.popk, podt.podtpk, ord.ordno, podt.item, podt.spec, podt.sizegar, podt.colname, podt.pocons, podt.unit,
podt.price, cur.curid, rpo.poreqdel, rpo.tgljam, po.etd, COUNT(po.popk) as tpo
FROM podt
LEFT OUTER JOIN rpo ON rpo.rkbpk=podt.rkbpk
LEFT OUTER JOIN po ON po.popk=podt.popk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=po.suppk
LEFT OUTER JOIN cur ON cur.curpk=po.curpk
LEFT OUTER JOIN postat ON postat.postatpk=po.postatpk
where podt.spec<>'' and po.pono<>'' and YEAR(po.tglpo)='$thn' and po.pur<>'' and po.postatpk<>'4' $and1 $and2
group by po.popk
ORDER BY $sort $order LIMIT 1");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"SELECT podt.popk, podt.podtpk, ord.ordno, podt.item, podt.spec, podt.sizegar, podt.colname, podt.pocons, podt.unit,
podt.price, cur.curid, rpo.poreqdel, rpo.tgljam, po.etd, COUNT(po.popk) as tpo
FROM podt
LEFT OUTER JOIN rpo ON rpo.rkbpk=podt.rkbpk
LEFT OUTER JOIN po ON po.popk=podt.popk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=po.suppk
LEFT OUTER JOIN cur ON cur.curpk=po.curpk
LEFT OUTER JOIN postat ON postat.postatpk=po.postatpk
where podt.spec<>'' and po.pono<>'' and YEAR(po.tglpo)='$thn' and po.pur<>'' and po.postatpk<>'4' $and1 $and2
group by po.popk"));
$row = array();

$k = $offset;
while($data=mysqli_fetch_array($rs)){
$k++;

if($data['curid']=="IDR"){
if($data['price']=="0.00000"){
$price="-";
$total="-";
} else {
$price=number_format($data['price'],0,".",",")." ".$data['curid'];
$price2=number_format($data['price'],0,".","");
$tot=$data['price']*$data['pocons'];
$total=$data['curid']." ".number_format($tot,0,".",",");
}
} else {
if($data['price']=="0.00000"){
$price="-";
$total="-";
} else {
$price=number_format($data['price'],3,".",",")." ".$data['curid'];
$price2=number_format($data['price'],3,".","");
$tot=$data['price']*$data['pocons'];
$total=$data['curid']." ".number_format($tot,3,".",",");
}
}

if($data['poreqdel']=="0000-00-00"){ $poreqdel=""; $poreqdel2=""; }
else {
if($data['poreqdel']==""){ $poreqdel=""; $poreqdel2=""; }
else { $poreqdel=$data['poreqdel']; $poreqdel2=tgl($data['poreqdel']); }
}

if($data['tgljam']=="0000-00-00 00:00:00"){ $tgljam=""; $tgljam2=""; }
else {
if($data['tgljam']==""){ $tgljam=""; $tgljam2=""; }
else { $tgljam=$data['tgljam']; $tgljam2=tgl($data['tgljam']); }
}

if($data['etd']=="0000-00-00"){ $etd=""; }
else {
if($data['etd']==""){ $etd="";}
else { $etd=$data['etd']; }
}

$cr=mysqli_query($koneksi,"select * from memo where rkbpk='$data[rkbpk]' and cek=1 order by memopk desc");
$dt=mysqli_fetch_array($cr);

$cr2=mysqli_query($koneksi,"select * from po where popk='$data[popk]'");
$dt2=mysqli_fetch_array($cr2);

$allowman=number_format($data['allowman'],0,".","");

if($data['tspec']==1){
$hspec1="";
$hspec2="";
$hspec3="";
$hspec4="";
$hspec5="";
$hspec6="";
$hspec7="";
$hspec8="";
$spec1="";
$spec2="";
$spec3="";
$spec4="";
$spec5="";
$spec6="";
$spec7="";
$spec8="";
} else {
$hspec1=$data['hspec1'];
$hspec2=$data['hspec2'];
$hspec3=$data['hspec3'];
$hspec4=$data['hspec4'];
$hspec5=$data['hspec5'];
$hspec6=$data['hspec6'];
$hspec7=$data['hspec7'];
$hspec8=$data['hspec8'];
$spec1=$data['spec1'];
$spec2=$data['spec2'];
$spec3=$data['spec3'];
$spec4=$data['spec4'];
$spec5=$data['spec5'];
$spec6=$data['spec6'];
$spec7=$data['spec7'];
$spec8=$data['spec8'];   
}

$specb=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±"]/', ' ', $data['spec']);
$spec=TRIM($specb);
$sizeb=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±"]/', ' ', $data['sizegar']);
$sizegar=TRIM($sizeb);

$spec1b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±"]/', ' ', $spec1);
$spec1c=TRIM($spec1b);
$spec2b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±"]/', ' ', $spec2);
$spec2c=TRIM($spec2b);
$spec3b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±"]/', ' ', $spec3);
$spec3c=TRIM($spec3b);
$spec4b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±"]/', ' ', $spec4);
$spec4c=TRIM($spec4b);
$spec5b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±"]/', ' ', $spec5);
$spec5c=TRIM($spec5b);
$spec6b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±"]/', ' ', $spec6);
$spec6c=TRIM($spec6b);
$spec7b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±"]/', ' ', $spec7);
$spec7c=TRIM($spec7b);
$spec8b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±"]/', ' ', $spec8);
$spec8c=TRIM($spec8b);

$specadd1=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±"]/', ' ', $data['specadd']);
$specadd=TRIM($specadd1);

$row[] = array(
'no'=>$k,
'ordpk'=>$data['ordpk'],
'ordno'=>$data['ordno'],
'suppk'=>$data['suppk'],
'supnm'=>$data['supnm'],
'sup'=>$data['sup'],
'rkbpk'=>$data['rkbpk'],
'nour'=>$data['nour'],
'item'=>$data['item'],
'itemadd'=>$data['itemadd'],
'spec'=>$spec,
'specadd'=>$specadd,
'tspec'=>$data['tspec'],
'hspec1'=>$hspec1,
'hspec2'=>$hspec2,
'hspec3'=>$hspec3,
'hspec4'=>$hspec4,
'hspec5'=>$hspec5,
'hspec6'=>$hspec6,
'hspec7'=>$hspec7,
'hspec8'=>$hspec8,
'spec1'=>$spec1c,
'spec2'=>$spec2c,
'spec3'=>$spec3c,
'spec4'=>$spec4c,
'spec5'=>$spec5c,
'spec6'=>$spec6c,
'spec7'=>$spec7c,
'spec8'=>$spec8c,
'sizegar'=>$sizegar,
'qty'=>$qty,
'unit'=>$data['unit'],
'colname'=>$data['colname'],
'colcode'=>$data['colcode'],
'price2'=>$data['price'],
//'price2'=>$data['price'],
'price'=>$price,
'curpk'=>$data['curpk'],
'curid'=>$data['curid'],
'kelnm'=>$kelnm,
'kelnm2'=>$kelnm2,
'bdownqty'=>$data['bdownqty'],
'kolom'=>$data['kolom'],
'bdownpk'=>$data['bdownpk'],
'allowcons'=>$data['allowcons'],
'negocons'=>$data['negocons'],
'estcons'=>$data['estcons'],
'varcons'=>$data['varcons'],
'totcons'=>$data['totcons'],
'qrs'=>$data['qrs'],
'pocons1'=>$data['pocons'],
'pocons2'=>$pocons,
'status'=>$sts,
'status2'=>$data['status'],
'stspk'=>$data['stspk'],
'poreqdel'=>$data['poreqdel'],
'podel'=>$data['podel'],
//'allowman'=>$data['allowman'],
'allowman'=>$allowman,
'memonm'=>$dt['memonm'],
'tgl2'=>$dt['tgl2'],
'popk'=>$data['popk'],
'postatpk'=>$dt2['postatpk'],
'pono'=>$dt2['pono'],
'rumus'=>$data['rumus'],
'f1'=>$data['f1'],
'f2'=>$data['f2'],
'copy'=>$data['copy'],
'piform'=>$data['piform'],
'postatnm'=>$data['postatnm'],
'tpo'=>$data['tpo'],
'etd'=>$etd,
'poreqdel'=>$poreqdel,
'poreqdel2'=>$poreqdel2,
/*'podel'=>$data['podel'],*/
'tgljam'=>$tgljam,
'tgljam2'=>$tgljam2);
}

$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>
