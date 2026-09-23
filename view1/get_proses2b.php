<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
//include "../action/sinkron2.php";

$bln=date("m");
$thn=date("Y");

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 2000;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'po.dateupdt';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;
//$cari4 = isset($_POST['cari4']) ? ($_POST['cari4']) : false;
$user = isset($_GET['user']) ? ($_GET['user']) : false;

$offset = ($page-1) * $rows;

//$updts=mysqli_query($koneksi,"update podt set stspk='2' where stspk='99' and ck='1'");

if($cari1<>""){
$and1="and concat(po.pono,po.brg,sup.supnm) like '%$cari1%'";
}

if($cari2>0){
$and3="and byr.byrpk='$cari2'";   
}

if($cari3>0){
$and4="and YEAR(po.tglpo)='$cari3'";   
} else {
$and4="and YEAR(po.tglpo)='$thn'";
}

$cr=mysqli_query($koneksi,"select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$user'");
$dt=mysqli_fetch_array($cr);

if($dt['spv']==1){ $and2="and fu.fupk='$dt[fupk]' and po.fu='$dt[funm]'"; }
else { $and2="and ord.userpk='$dt[userpk]' and po.fu='$dt[funm]'"; }

$rs = mysqli_query($koneksi,"SELECT podt.popk, podt.podtpk, ord.ordno, podt.item, podt.spec, podt.sizegar, podt.colname, podt.pocons, podt.unit,
podt.price, cur.curid, po.etd, po.postatpk, sup.supnm, COUNT(podt.popk) as tpo, po.postatpk, po.pono
FROM po
left outer join podt on podt.popk=po.popk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=podt.suppk
LEFT OUTER JOIN cur ON  cur.curpk=podt.curpk
left outer join byr on byr.byrpk=ord.byrpk
WHERE po.pur is null $and1 $and2 $and3 $and4
group by po.popk
ORDER BY $sort $order, po.tglpo desc");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM po
left outer join podt on podt.popk=po.popk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=podt.suppk
LEFT OUTER JOIN cur ON  cur.curpk=podt.curpk
left outer join byr on byr.byrpk=ord.byrpk
WHERE po.pur is null $and1 $and2 $and3 $and4
group by po.popk"));
$row = array();

$k = $offset;
while($data=mysqli_fetch_array($rs)){
$k++;

//$btn = '<a href="?hal=detord&ord='.$data['ordpk'].'" style="text-decoration:none;">'.$data['ordno'].'</a>';
if($data['status']==1){ $sts="In progress"; }
else if($data['status']==2){ $sts="Ready for PO"; }
else if($data['status']==3){ $sts="Need revision"; }
else if($data['status']==4){
if($data['stspk']==1){ $sts="Req PO"; }
else if($data['stspk']==2){ $sts="PO Ready"; }
else if($data['stspk']==4){ $sts="Req Revised"; }
else if($data['stspk']==5){ $sts="Ready Revised"; }
else if($data['stspk']==6){ $sts="Req Cancel"; }
else if($data['stspk']==7){ $sts="Cancel PO"; }
else {
$sts="PO in process";
}
}
else if($data['status']==5){ $sts="In Revision"; }
else if($data['status']==6){ $sts="Purchased"; }
else { $sts="In progress"; }

// if($data['curid']=="IDR"){
// if($data['price']=="0.00000"){
// $price="-";
// $total="-";
// } else {
// $price=number_format($data['price'],0,".",",")." ".$data['curid'];
// $price2=number_format($data['price'],0,".","");
// $tot=$data['price']*$data['pocons'];
// $total=$data['curid']." ".number_format($tot,0,".",",");
// }
// } else {
// if($data['price']=="0.00000"){
// $price="-";
// $total="-";
// } else {
// $price=number_format($data['price'],3,".",",")." ".$data['curid'];
// $price2=number_format($data['price'],3,".","");
// $tot=$data['price']*$data['pocons'];
// $total=$data['curid']." ".number_format($tot,3,".",",");
// }
// }

// if($data['poreqdel']=="0000-00-00"){ $poreqdel=""; $poreqdel2=""; }
// else {
// if($data['poreqdel']==""){ $poreqdel=""; $poreqdel2=""; }
// else { $poreqdel=$data['poreqdel']; $poreqdel2=tgl($data['poreqdel']); }
// }

// if($data['tgljam']=="0000-00-00 00:00:00"){ $tgljam=""; $tgljam2=""; }
// else {
// if($data['tgljam']==""){ $tgljam=""; $tgljam2=""; }
// else { $tgljam=$data['tgljam']; $tgljam2=tgl($data['tgljam']); }
// }

$qty=number_format($data['bdownqty'],0,".",",");
$pocons=number_format($data['pocons'],0,".",",");
$kelnm=RTRIM($data['kelnm']);
if($kelnm=='CUTTING'){
    $kelnm2="<div style='width: 45px;height: 24px;background: #359DD9;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>C</div>";
}else if($kelnm=='SEWING'){
    $kelnm2="<div style='width: 45px;height: 24px;background: #19B715;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>S</div>";
} else {
    $kelnm2="<div style='width: 45px;height: 24px;background: #FF6B00;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>F</div>";
}


// $cr=mysqli_query($koneksi,"select * from memo where rkbpk='$data[rkbpk]' and cek=1 order by memopk desc");
// $dt=mysqli_fetch_array($cr);

// $cr2=mysqli_query($koneksi,"select * from po where popk='$data[popk]'");
// $dt2=mysqli_fetch_array($cr2);

$cr3=mysqli_query($koneksi,"select count(*) as tdelsts from podt where popk='$data[popk]' and delsts='1'");
$dt3=mysqli_fetch_array($cr3);

// $allowman=number_format($data['allowman'],0,".","");

// if($data['tspec']==1){
// $hspec1="";
// $hspec2="";
// $hspec3="";
// $hspec4="";
// $hspec5="";
// $hspec6="";
// $hspec7="";
// $hspec8="";
// $spec1="";
// $spec2="";
// $spec3="";
// $spec4="";
// $spec5="";
// $spec6="";
// $spec7="";
// $spec8="";
// } else {
// $hspec1=$data['hspec1'];
// $hspec2=$data['hspec2'];
// $hspec3=$data['hspec3'];
// $hspec4=$data['hspec4'];
// $hspec5=$data['hspec5'];
// $hspec6=$data['hspec6'];
// $hspec7=$data['hspec7'];
// $hspec8=$data['hspec8'];
// $spec1=$data['spec1'];
// $spec2=$data['spec2'];
// $spec3=$data['spec3'];
// $spec4=$data['spec4'];
// $spec5=$data['spec5'];
// $spec6=$data['spec6'];
// $spec7=$data['spec7'];
// $spec8=$data['spec8'];   
// }

// $specb=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©"]/', ' ', $data['spec']);
// $spec=TRIM($specb);
// $sizeb=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©"]/', ' ', $data['sizegar']);
// $sizegar=TRIM($sizeb);

// $spec1b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©"]/', ' ', $spec1);
// $spec1c=TRIM($spec1b);
// $spec2b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©"]/', ' ', $spec2);
// $spec2c=TRIM($spec2b);
// $spec3b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©"]/', ' ', $spec3);
// $spec3c=TRIM($spec3b);
// $spec4b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©"]/', ' ', $spec4);
// $spec4c=TRIM($spec4b);
// $spec5b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©"]/', ' ', $spec5);
// $spec5c=TRIM($spec5b);
// $spec6b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©"]/', ' ', $spec6);
// $spec6c=TRIM($spec6b);
// $spec7b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©"]/', ' ', $spec7);
// $spec7c=TRIM($spec7b);
// $spec8b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©"]/', ' ', $spec8);
// $spec8c=TRIM($spec8b);

// $specadd1=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©"]/', ' ', $data['specadd']);
// $specadd=TRIM($specadd1);

if($data['postatpk']==4){
$status='<input type="text" name="on" id="on" value="PI received" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#19B715;" readonly>';    
}else{
if($data['postatpk']==1){
$status='<input type="text" name="on" id="on" value="Awaiting PI" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#BDBDBD;" readonly>';       
} else if($data['postatpk']==2){
$status='<input type="text" name="on" id="on" value="In Revision" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#BDBDBD;" readonly>';       
} else if($data['postatpk']==3){
$status='<input type="text" name="on" id="on" value="Cancel PO" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#BDBDBD;" readonly>';       
} else {
$status='<input type="text" name="on" id="on" value="Awaiting PI" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#BDBDBD;" readonly>';         
}
}

if($dt3['tdelsts']>0){
    $tdelmat="(".$dt3['tdelsts']."&nbsp;items deleted from PO)";
}else{
     $tdelmat="";
}

$row[] = array(
'tdelmat'=>$tdelmat,   
'popk'=>$data['popk'],
'pono'=>$data['pono'],
'status'=>$status,
'tpo'=>$data['tpo']);

// $row[] = array(
// 'no'=>$k,
// 'ordpk'=>$data['ordpk'],
// 'ordno'=>$data['ordno'],
// 'suppk'=>$data['suppk'],
// 'supnm'=>$data['supnm'],
// 'sup'=>$data['sup'],
// 'tdelmat'=>$tdelmat,
// 'rkbpk'=>$data['rkbpk'],
// 'nour'=>$data['nour'],
// 'item'=>$data['item'],
// 'itemadd'=>$data['itemadd'],
// 'spec'=>$spec,
// 'specadd'=>$specadd,
// 'tspec'=>$data['tspec'],
// 'hspec1'=>$hspec1,
// 'hspec2'=>$hspec2,
// 'hspec3'=>$hspec3,
// 'hspec4'=>$hspec4,
// 'hspec5'=>$hspec5,
// 'hspec6'=>$hspec6,
// 'hspec7'=>$hspec7,
// 'hspec8'=>$hspec8,
// 'spec1'=>$spec1c,
// 'spec2'=>$spec2c,
// 'spec3'=>$spec3c,
// 'spec4'=>$spec4c,
// 'spec5'=>$spec5c,
// 'spec6'=>$spec6c,
// 'spec7'=>$spec7c,
// 'spec8'=>$spec8c,
// 'sizegar'=>$sizegar,
// 'qty'=>$qty,
// 'unit'=>$data['unit'],
// 'colname'=>$data['colname'],
// 'colcode'=>$data['colcode'],
// 'price2'=>$data['price'],
// //'price2'=>$data['price'],
// 'price'=>$price,
// 'curpk'=>$data['curpk'],
// 'curid'=>$data['curid'],
// 'kelnm'=>$kelnm,
// 'kelnm2'=>$kelnm2,
// 'bdownqty'=>$data['bdownqty'],
// 'kolom'=>$data['kolom'],
// 'bdownpk'=>$data['bdownpk'],
// 'allowcons'=>$data['allowcons'],
// 'negocons'=>$data['negocons'],
// 'estcons'=>$data['estcons'],
// 'varcons'=>$data['varcons'],
// 'totcons'=>$data['totcons'],
// 'qrs'=>$data['qrs'],
// 'pocons1'=>$data['pocons'],
// 'pocons2'=>$pocons,
// 'status'=>$sts,
// 'status2'=>$data['status'],
// 'stspk'=>$data['stspk'],
// 'poreqdel'=>$data['poreqdel'],
// 'podel'=>$data['podel'],
// //'allowman'=>$data['allowman'],
// 'allowman'=>$allowman,
// 'memonm'=>$dt['memonm'],
// 'tgl2'=>$dt['tgl2'],
// 'popk'=>$data['popk'],
// 'postatpk'=>$dt2['postatpk'],
// 'pono'=>$dt2['pono'],
// 'rumus'=>$data['rumus'],
// 'f1'=>$data['f1'],
// 'f2'=>$data['f2'],
// 'copy'=>$data['copy'],
// 'pidate'=>$data['pidate'],
// 'piform'=>$data['piform'],
// 'tpo'=>$data['tpo'],
// 'poreqdel'=>$poreqdel,
// 'poreqdel2'=>$poreqdel2,
// 'status'=>$status,
// /*'podel'=>$data['podel'],*/
// 'tgljam'=>$tgljam,
// 'tgljam2'=>$tgljam2,
// 'postatpk'=>$data['postatpk']);
}

$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>
