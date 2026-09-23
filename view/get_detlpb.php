<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/koneksi4b.php";
include "../config/tanggal.php";
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 4000;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'podt.kelnm';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
$ord = isset($_GET['ord']) ? ($_GET['ord']) : false;
$pono = isset($_GET['pono']) ? ($_GET['pono']) : false;

if($pono<>""){
    $and="and po.pono='$pono'";
}else{
    $and="";
}

$offset = ($page-1) * $rows;

$rs = mysqli_query($koneksi,"select podt.rkbpk, podt.unit, cur.curid, podt.item, podt.spec, sup.supnm, podt.colname,
podt.price, podt.pocons, po.pono, po.etd, podt.ordpk, podt.kelnm, po.popk, podt.price as pprice, podt.pocons as ppocons, po.etdal, po.eihl,
import.ETDA, import.EIH, po.polipk
 FROM podt
left outer join po on po.popk=podt.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join sup on sup.suppk=podt.suppk
left outer join cur on  cur.curpk=podt.curpk
left outer join importdt on importdt.popk=po.popk
left outer join import on import.importpk=importdt.importpk
where ord.ordpk='$ord' and ord.fupk='$_SESSION[fu]' and podt.cek<>'4' and sup.supnm NOT LIKE '%STOCK%' $and
group by podt.rkbpk
ORDER BY $sort $order, podt.nour desc, podt.rkbpk desc LIMIT $rows OFFSET $offset");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"select podt.rkbpk, podt.unit, cur.curid, podt.item, podt.spec, sup.supnm, podt.colname,
podt.price, podt.pocons, po.pono, po.etd, podt.ordpk, podt.kelnm, po.popk, podt.price as pprice, podt.pocons as ppocons, po.etdal, po.eihl,
import.ETDA, import.EIH, po.polipk
 FROM podt
left outer join po on po.popk=podt.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join sup on sup.suppk=podt.suppk
left outer join cur on  cur.curpk=podt.curpk
left outer join importdt on importdt.popk=po.popk
left outer join import on import.importpk=importdt.importpk
where ord.ordpk='$ord' and ord.fupk='$_SESSION[fu]' and podt.cek<>'4' and sup.supnm NOT LIKE '%STOCK%' $and
group by podt.rkbpk"));
$row = array();

$k = $offset;
while($data=mysqli_fetch_array($rs)){
$k++;

// include "../config/koneksi4.php";
$sql=mysqli_query($koneksi4,"SELECT SUM(qtydtg) as tqtydtg, unitdtg, kelnm, stsunit FROM dtgdt WHERE rkbpk='$data[rkbpk]' GROUP BY rkbpk");
$dtg=mysqli_fetch_array($sql);

$poconsa1=$data['pocons'];
$tqtydtg1=$dtg['tqtydtg'];

$poconsa=number_format($data['pocons'],0,".",",");
$tqtydtg=number_format($dtg['tqtydtg'],0,".",",");
$unitdtg=TRIM($dtg['unitdtg']);
$unitpo=TRIM($data['unit']);

$tqtydtg2=number_format($dtg['tqtydtg'],0,".",",")." ".$unitdtg;

$balance=($dtg['tqtydtg'] - $data['pocons'])/$data['pocons']*100;
$balance2=number_format($balance,1,".",",");

$test = "unit dif";

$bal1=$dtg['tqtydtg'] - $data['pocons'];
if($unitpo == $unitdtg){
    if($bal1>0){
        $bal2a=number_format($bal1,1,".",",")." ".$unitdtg;
        $bal2="<span style='color:#19B715'>$bal2a</span>";
    } else { 
        $balb=$bal1*(-1);
        $bal2a=number_format($balb,1,".",",")." ".$unitdtg;
        $bal2="<span style='color:#FF6B00'>$bal2a </span>";
    }
} else if($unitpo != $unitdtg) {
    $bal2="<span style='color:#FF6B00'>$test</span>";
}

//SINKRON KELNM
if($dtg['kelnm']==''){
// $update=mysqli_query($koneksi4,"update dtgdt set kelnm='$data[kelnm]' where rkbpk='$data[rkbpk]' and ordpk='$ord'");    
}

if(TRIM($dtg['unitdtg'])<>TRIM($data['unit'])){
// $update2=mysqli_query($koneksi4,"update dtgdt set stsunit='1' where rkbpk='$data[rkbpk]' and ordpk='$ord'");
}

// include "../config/koneksi.php";
//$btn = '<a href="?hal=detord&ord='.$data['ordpk'].'" style="text-decoration:none;">'.$data['ordno'].'</a>';
$cr2=mysqli_query($koneksi,"select * from po where popk='$data[popk]'");
$dt2=mysqli_fetch_array($cr2);
if($dt2['ck']==0){
    if($dt2['pur']=="Rita"){
    $pono2=$dt2['pono'];
    } else if($dt2['pur']=="Theresia"){
    $pono2=$dt2['pono'];
    } else {
    if($dt2['postatpk']>1){
    $pono2=$dt2['pono'];    
    } else { 
    $pono2="";
    }
    }
    } else if($dt2['ck']==1){
    $pono2=$dt2['pono'];
    } else {
    $pono2="";  
    }

// if($data['status']==1){ $bal=""; $sts="In progress"; }
// else if($data['status']==2){ $bal=""; $sts="Ready for PO"; }
// else if($data['status']==3){ $bal=""; $sts="Need revision"; }
// else if($data['status']==4){
// if($data['stspk']==1){ $bal=""; $sts="Req PO"; }
// else if($data['stspk']==2){
// if($dt2['fu']<>''){
// if($dt2['ck']==1){
// $sts="PO Ready"; $bal="";
// } else {
// $sts="Req PO"; $bal="";    
// }
// } else {
// $sts="PO Ready"; $bal="";    
// }
// }
// else if($data['stspk']==4){ $sts="Req Revised"; $bal=""; }
// else if($data['stspk']==5){ $sts="Ready Revised"; $bal=""; }
// else if($data['stspk']==6){ $sts="Req Cancel"; $bal=""; }
// else if($data['stspk']==7){ $sts="Cancel PO"; $bal=""; }
// else {
// $sts="PO in process"; $bal="";
// }
// }
// else if($data['status']==5){ $sts="In Revision"; $bal=""; }
// else if($data['status']==6 && $tqtydtg==0 || $tqtydtg==""){
// if($data['stspk']==4){ $sts="Req Revised"; $bal=""; }
// else if($data['stspk']==5){
// //$sts="Ready Revised";
// $sts="Purchased"; $bal=""; }
// else{ $sts="Purchased"; $bal=""; }    
// }
if($dtg['tqtydtg']>0){
if($poconsa1==$tqtydtg1 && $unitpo==$unitdtg){
$bal=$bal2;
$sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#19B715;cursor:pointer' onclick='info();'>Complete</span>";    
$update = mysqli_query($koneksi, "update podt set cek = '4' WHERE rkbpk='$data[rkbpk]'");
}
else if($tqtydtg1>$poconsa1 && $unitpo==$unitdtg){
$bal=$bal2;
$sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#19B715;cursor:pointer' onclick='info();'>Complete<span style='color:#FF6B00;'>(+".$balance2."%)</span></span>";    
$update = mysqli_query($koneksi, "update podt set cek = '4' WHERE rkbpk='$data[rkbpk]'");
}
else if($tqtydtg1<$poconsa1 && $unitpo == $unitdtg){
$bal=$bal2;
$sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#359DD9;cursor:pointer' onclick='info();'>Partial In</span>";    
}
else if($tqtydtg1<$poconsa1 && $unitpo != $unitdtg){
$bal=$bal2;
$sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#EF3B42;cursor:pointer' onclick='info();'>Unit Difference</span>";    
}
} else {
$bal="";
}
// else { $sts="In progress"; $bal=""; }

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

$qty=number_format($data['bdownqty'],0,".",",");
$pocons=number_format($data['pocons'],0,".",",")." ".$unitpo;
$kelnm=TRIM($data['kelnm']);

if($kelnm=='CUTTING'){
$kelnm3="<div style='width: 45px;height: 24px;background: #359DD9;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>&nbsp; &nbsp;&nbsp; C</div>";
$kelnm2= $kelnm.' '.'('.$cut.')';
} else if($kelnm=='SEWING'){
$kelnm3="<div style='width: 45px;height: 24px;background: #19B715;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>&nbsp; &nbsp;&nbsp; S</div>";
$kelnm2= $kelnm.' '.'('.$ssew.')';
} else {
$kelnm3="<div style='width: 45px;height: 24px;background: #FF6B00;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>&nbsp; &nbsp;&nbsp; F</div>";
$kelnm2= $kelnm.' '.'('.$fsew.')';
}

// include "../config/koneksi.php";
$cr=mysqli_query($koneksi,"select * from memo where rkbpk='$data[rkbpk]' and cek=1 order by memopk desc");
$dt=mysqli_fetch_array($cr);

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

$specb=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼"]/', ' ', $data['spec']);
$spec=TRIM($specb);
$sizeb=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼"]/', ' ', $data['sizegar']);
$sizegar=TRIM($sizeb);
//$sizegar=TRIM($data['sizegar']);

$spec1b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼"]/', ' ', $spec1);
$spec1c=TRIM($spec1b);
$spec2b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼"]/', ' ', $spec2);
$spec2c=TRIM($spec2b);
$spec3b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼"]/', ' ', $spec3);
$spec3c=TRIM($spec3b);
$spec4b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼"]/', ' ', $spec4);
$spec4c=TRIM($spec4b);
$spec5b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼"]/', ' ', $spec5);
$spec5c=TRIM($spec5b);
$spec6b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼"]/', ' ', $spec6);
$spec6c=TRIM($spec6b);
$spec7b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼"]/', ' ', $spec7);
$spec7c=TRIM($spec7b);
$spec8b=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼"]/', ' ', $spec8);
$spec8c=TRIM($spec8b);

$specadd1=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼"]/', ' ', $data['specadd']);
$specadd=TRIM($specadd1);

if($data['suppk']=="1949"){ 
$supnm2="<font style='color:rgba(0, 0, 0, 0.38)'>$data[supnm]</font>";
} else {
$supnm2=$data['supnm'];    
}

if($data['etd']=="" || $data['etd']=="0000-00-00"){ $etd="- - - "; }
else { $etd=tgl($data['etd']); }

if($data['polipk']==1){
$eta=$data['etdal'];
$eih=$data['eihl'];
} else {
$eta=$data['ETDA'];
$eih=$data['EIH'];
}

if($eta=="" || $eta=="0000-00-00"){ $eta="- - - "; }
else { $eta=tgl($eta); }

if($eih=="" || $eih=="0000-00-00"){ $eih="- - - "; }
else { $eih=tgl($eih); }

$crcek=mysqli_fetch_array(mysqli_query($koneksi,"select * from podt where rkbpk='$data[rkbpk]'"));

if($data['cek']==4){
} else {
$row[] = array(
'no'=>$k,
'ordpk'=>$data['ordpk'],
'ordno'=>$data['ordno'],
'suppk'=>$data['suppk'],
'supnm'=>$data['supnm'],
'supnm2'=>$supnm2,
'sup'=>$data['sup'],
'rkbpk'=>$data['rkbpk'],
'nour'=>$data['nour'],
'item'=>$data['item'],
'itemadd'=>$data['itemadd'],
'spec'=>$spec,
'specadd'=>$specadd,
'tspec'=>$data['tspec'],
'h1'=>$hspec1,
'h2'=>$hspec2,
'h3'=>$hspec3,
'h4'=>$hspec4,
'h5'=>$hspec5,
'h6'=>$hspec6,
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
'kelnm3'=>$kelnm3,
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
'qtydtg'=>$tqtydtg2,
'bal'=>$bal,
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
'pur'=>$dt2['pur'],
'pono'=>$pono2,
'fup'=>$dt2['fu'],
'rumus'=>$data['rumus'],
'f1'=>$data['f1'],
'f2'=>$data['f2'],
'copy'=>$data['copy'],
'piform'=>$data['piform'],
'etd'=>$etd,
'eta'=>$eta,
'eih'=>$eih);
}
}

$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>
