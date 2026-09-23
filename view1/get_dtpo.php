<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 4000;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ord.ordno';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
$po = isset($_GET['po']) ? ($_GET['po']) : false;
$caria = isset($_POST['caria']) ? ($_POST['caria']) : false;

$offset = ($page-1) * $rows;

if($caria){
$and1="and concat(ord.ordno,podt.spec,podt.colname,podt.colcode,podt.sizegar) like '%$caria%'";
}

$rs = mysqli_query($koneksi,"SELECT rkb.rkbpk, podt.spec, podt.colname, podt.sizegar, podt.unit, podt.bdownqty, podt.pocons, cur.curpk, cur.cursign,
rkb.piqty, rkb.piunit, rkb.piprice, podt.podtpk, podt.price, ord.ordpk, ord.ordno, cur.curid, rkb.stspk, podt.popk,
podt.hspec1,podt.hspec2,podt.hspec3,podt.hspec4,podt.hspec5,podt.hspec6,podt.hspec7,podt.hspec8,podt.spec1,podt.spec2,
podt.spec3,podt.spec4,podt.spec5,podt.spec6,podt.spec7,podt.spec8,podt.tspec, podt.colcode, ord.prodes, podt.specadd, sup.supnm, podt.tpodt
FROM podt
left outer join po on po.popk=podt.popk
left outer join rkb on podt.rkbpk=rkb.rkbpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=podt.curpk
WHERE podt.popk='$po' and podt.stspk>='1' $and1
GROUP BY podt.rkbpk
ORDER BY $sort $order
LIMIT $rows OFFSET $offset");
$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"SELECT rkb.rkbpk, podt.spec, podt.colname, podt.sizegar, podt.unit, podt.bdownqty, podt.pocons, cur.curpk, cur.cursign,
rkb.piqty, rkb.piunit, rkb.piprice, podt.podtpk, podt.price, ord.ordpk, ord.ordno, cur.curid, rkb.stspk, podt.popk,
podt.hspec1,podt.hspec2,podt.hspec3,podt.hspec4,podt.hspec5,podt.hspec6,podt.hspec7,podt.hspec8,podt.spec1,podt.spec2,
podt.spec3,podt.spec4,podt.spec5,podt.spec6,podt.spec7,podt.spec8,podt.tspec, podt.colcode, ord.prodes, podt.specadd, sup.supnm, podt.tpodt
FROM podt
left outer join po on po.popk=podt.popk
left outer join rkb on podt.rkbpk=rkb.rkbpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=podt.curpk
WHERE podt.popk='$po' and podt.stspk>='1' $and1
GROUP BY podt.rkbpk"));
$row = array();
$k =$offset;
while($data=mysqli_fetch_array($rs)){
$k++;
if($data['curpk']==3){
    $cursign="&#8364;";
}else {
    $cursign=$data['cursign'];
}

if($data['status']==1){ $sts="In progress"; }
else if($data['status']==2){ $sts="Ready for PO"; }
else if($data['status']==3){ $sts="Need revision"; }
else if($data['status']==4){ $sts="PO in process"; }
else if($data['status']==5){ $sts="In Revised"; }
else if($data['status']==6){ $sts="Purchased"; }
else { $sts="In progress"; }

/*if($data['piqty']>0){ $piqty1=$data['piqty']; }
else { $piqty1=$data['pocons']; }

if($data['piprice']>0){ $piprice1=$data['piprice']; }
else { $piprice1=$data['price']; }

if($data['piunit']){ $piunit1=$data['piunit']; }
else { $piunit1=$data['unit']; }*/

$piqty1=ceil($data['pocons']);
$piprice1=$data['price'];
$piunit1=$data['unit'];

if($data['curid']=="IDR"){
if($data['price']=="0.00000" || $data['price']==""){
$price="-";
$total="-";
} else {
$price=number_format($data['price'],2,".",",");
$tot=$data['price']*ceil($data['pocons']);
$total=$cursign." ".number_format($tot,2,".",",");
}

if($piprice1=="0.00000" || $piprice1==""){
$piprice="";
$piprice2="";
$total2="";
} else {
$piprice=number_format($piprice1,2,".",",");
$piprice2=number_format($piprice1,2,".",",");
$tot2=$piprice1*$piqty1;
$total2=$cursign." ".number_format($tot2,2,".",",");
}
} else {
if($data['price']=="0.00000" || $data['price']==""){
$price="";
$total="-";
} else {
$price=number_format($data['price'],5,".",",");
$tot=$data['price']*ceil($data['pocons']);
$total=$cursign." ".number_format($tot,5,".",",");
}

if($piprice1=="0.00000" || $piprice1==""){
$piprice="";
$piprice2="";
$total2="";
} else {
$piprice=number_format($piprice1,5,".",",");
$piprice2=number_format($piprice1,5,".",",");
$tot2=$piprice1*$piqty1;
$total2=$cursign." ".number_format($tot2,5,".",",");
}
}

$qty=number_format($data['bdownqty'],0,".",",");
//$pocons1=ceil($data['pocons']);
$pocons1=ceil($data['pocons']);
$pocons=number_format($pocons1,2,".",",");

if($piqty1=="0.00"){ $piqty=""; $piqty2=""; }
else {
$piqty=number_format($piqty1,0,".",","); $piqty2=$piqty1;
}

$kelnm=RTRIM($data['kelnm']);

//$btn = "<input type='text' style='width:75px;' id='piqty2' value='$piqty2'>";
//$btn2 = "<input type='text' style='width:75px;' id='piprice2' value='$piprice2'>";
$specb=preg_replace('/[^a-zA-Z"#()_%+-;–$&>=”:]/', ' ', $data['spec']);
$specadd=preg_replace('/[^a-zA-Z"#()_%+-;–$&>=”:]/', ' ', $data['specadd']);
$sup=TRIM($data['supnm']);
$supnm2=substr(TRIM($data['supnm']),0,5);
if($supnm2=="STOCK"){
if($specadd<>""){
$spec=TRIM($specb)."-".TRIM($specadd);
} else {
$spec=TRIM($specb);    
}
} else {
$spec=TRIM($specb);    
}
$sizeb=preg_replace('/[^a-zA-Z"#()_%+-;–$&>=”:]/', ' ', $data['sizegar']);
$sizegar=TRIM($sizeb);

$spec1b=preg_replace('/[^a-zA-Z"#()_%+-;–$&>=”:]/', ' ', $data['spec1']);
$spec1c=TRIM($spec1b);
$spec2b=preg_replace('/[^a-zA-Z"#()_%+-;–$&>=”:]/', ' ', $data['spec2']);
$spec2c=TRIM($spec2b);
$spec3b=preg_replace('/[^a-zA-Z"#()_%+-;–$&>=”:]/', ' ', $data['spec3']);
$spec3c=TRIM($spec3b);
$spec4b=preg_replace('/[^a-zA-Z"#()_%+-;–$&>=”:]/', ' ', $data['spec4']);
$spec4c=TRIM($spec4b);
$spec5b=preg_replace('/[^a-zA-Z"#()_%+-;–$&>=”:]/', ' ', $data['spec5']);
$spec5c=TRIM($spec5b);
$spec6b=preg_replace('/[^a-zA-Z"#()_%+-;–$&>=”:]/', ' ', $data['spec6']);
$spec6c=TRIM($spec6b);
$spec7b=preg_replace('/[^a-zA-Z"#()_%+-;–$&>=”:]/', ' ', $data['spec7']);
$spec7c=TRIM($spec7b);
$spec8b=preg_replace('/[^a-zA-Z"#()_%+-;–$&>=”:]/', ' ', $data['spec8']);
$spec8c=TRIM($spec8b);

$cr=mysqli_query($koneksi,"select * from po where popk='$data[popk]'");
$dt=mysqli_fetch_array($cr);

/*$btn = '<a href="?hal=detord&ord='.$data['ordpk'].'" style="text-decoration:none;">'.$data['ordno'].'</a>';
if($data['sts']==1){ $sts="In progress"; }
if($data['sts']==2){ $sts="Ready for PO"; }*/
if($dt['postatpk']==1 && $data['popk']>1){ $sts="Awating PI"; }
else if($dt['postatpk']==2){ $sts="In Revision"; }
else if($dt['postatpk']==3){ $sts="PO Cancel"; }
else if($dt['postatpk']==4){ $sts="Purchased"; }
//else if($dt['postatpk']==1){ $sts="PO in process"; }
else { $sts="PO in process"; }

if($data['stspk']==1){ $rev="Req PO"; }
else if($data['stspk']==2){ $rev="PO Ready"; }
else if($data['stspk']==4){ $rev="Req Revised"; }
else if($data['stspk']==5){ $rev="Ready Revised"; }
else if($data['stspk']==6){ $rev="Req Cancel"; }
else if($data['stspk']==7){ $rev="Cancel PO"; }
else {
if($dt['postatpk']==2){ $rev="Req Revised"; }
else { $rev=""; }
}

$row[] = array(
'no'=>$k,
'rev'=>$rev,
'ordpk'=>$data['ordpk'],
'ordno'=>$data['ordno'],
'suppk'=>$data['suppk'],
'supnm'=>$data['supnm'],
'sup'=>$data['sup'],
'popk'=>$data['popk'],
'rkbpk'=>$data['rkbpk'],
'nour'=>$data['nour'],
'item'=>$data['item'],
'itemadd'=>$data['itemadd'],
'spec'=>$spec,
'specadd'=>$data['specadd'],
'tspec'=>$data['tspec'],
'hspec1'=>$data['hspec1'],
'hspec2'=>$data['hspec2'],
'hspec3'=>$data['hspec3'],
'hspec4'=>$data['hspec4'],
'hspec5'=>$data['hspec5'],
'hspec6'=>$data['hspec6'],
'hspec7'=>$data['hspec7'],
'hspec8'=>$data['hspec8'],
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
'colname'=>TRIM($data['colname']),
'colcode'=>TRIM($data['colcode']),
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
'pocons1'=>$pocons1,
'status'=>$sts,
'stspk'=>$data['stspk'],
'poreqdel'=>$data['poreqdel'],
'podel'=>$data['podel'],
'allowman'=>$data['allowman'],
'total'=>$total,
'total2'=>$total2,
'piqty'=>$piqty,
'piqty2'=>$piqty2,
'piprice'=>$piprice,
'piprice2'=>$piprice2,
'piunit'=>$piunit1,
'piqty2btn'=>$btn,
'piprice2btn'=>$btn2,
'tpodt'=>$data['tpodt'],
'prodes'=>$data['prodes']);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>