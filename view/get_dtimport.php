<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
include "../config/tanggal2.php";
$thn=DATE('Y');
$thn2=$thn-2;
$thn2b=$thn2-2000;

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'popk';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
$importpkb = isset($_POST['importpkb']) ? ($_POST['importpkb']) : false;

$offset = ($page-1) * $rows;

$popka = explode(",",$popk);
$popkb = implode("','",$popka);

//$cr=mysqli_query($koneksi,"select * from importdt where popk='$popk' and stsdt='1' order by importdtpk desc limit 1");
//$dt=mysqli_fetch_array($cr);
//$importpk=$dt['importpk'];

$rs = mysqli_query($koneksi,"SELECT po.pono, po.piamount, po.surcharge, po.piform, po.pidate, sup.supnm, ord.ordno,
po.surcharge2, po.potop, po.etd, po.paydate, po.popk, po.tglpo, byr.byrnm, cur.curid, cur.cursign, po.stsapv, podt.colname,
po.dateupdt, po.tpo2c, po.invoiceno, podt.pocons, podt.unit, podt.spec, rkb.item, podt.price,importdt.podtpk,importdt.qtys,importdt.importdtpk
FROM importdt
left outer join podt on podt.podtpk=importdt.podtpk
LEFT OUTER JOIN po ON po.popk=podt.popk
LEFT OUTER JOIN sup ON sup.suppk=po.suppk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN rkb ON rkb.popk=po.popk
LEFT OUTER JOIN byr ON byr.byrpk=ord.byrpk
LEFT OUTER JOIN cur ON cur.curpk=po.curpk
WHERE importdt.importpk='$importpkb'
group by importdt.podtpk
ORDER BY $sort $order");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"SELECT po.pono, po.piamount, po.surcharge, po.piform, po.pidate, sup.supnm, ord.ordno,
po.surcharge2, po.potop, po.etd, po.paydate, po.popk, po.tglpo, byr.byrnm, cur.curid, cur.cursign, po.stsapv,
po.dateupdt, po.tpo2c, po.invoiceno, podt.pocons, podt.unit, rkb.item, podt.price,importdt.podtpk,importdt.qtys,importdt.importdtpk
FROM importdt
left outer join podt on podt.podtpk=importdt.podtpk
LEFT OUTER JOIN po ON po.popk=podt.popk
LEFT OUTER JOIN sup ON sup.suppk=po.suppk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN rkb ON rkb.popk=po.popk
LEFT OUTER JOIN byr ON byr.byrpk=ord.byrpk
LEFT OUTER JOIN cur ON cur.curpk=po.curpk
WHERE importdt.importpk='$importpkb'
group by importdt.podtpk"));
$row = array();

$k =$offset;

while($data=mysqli_fetch_array($rs)){
$k++;

$sqty=mysqli_query($koneksi,"select sum(qtys) as qtys from importdt where podtpk='$data[podtpk]' group by podtpk");
$dqty=mysqli_fetch_array($sqty);

if($dqty['qtys']>0){
$balance= $data['pocons']-$dqty['qtys'];
if($dqty['qtys']>$data['pocons']){
$balance2="+ ".substr($balance, 1)." ".$data['unit'];
} else {
$balance2=$balance." ".$data['unit'];
}
} else {
$balance2=$data['pocons']." ".$data['unit'];    
}

$tglskrng=date("Y-m-d");
if($tgl==$tglskrng){
$tglapv="Today";
} else { 
$tglapv=tgl($tgl);
}

// $tglpo2=tgl($tgl);

$po="<a href='?hal=detpopur&x=1&po=$data[popk]' style='text-decoration:none;'><span style='color: #359DD9;'>$data[pono]</span></a>";

$total=$data['piamount'] + $data['surcharge'] + $data['surcharge2'];

if($data['curid']=="IDR"){$cursign=$data['cursign'];}
if($data['curid']=="USD"){$cursign="&#36;";}
if($data['curid']=="EUR"){$cursign="&#8364;";}
if($data['curid']=="HKD"){$cursign="&#36;";}
if($data['curid']=="RMB"){$cursign=$data['cursign'];}
if($data['curid']=="GBP"){$cursign="&#163;";}
if($data['curid']=="RS"){$cursign=$data['cursign'];}

if($data['curid']=="IDR"){
if($data['piamount']=="0.00000" || $data['piamount']==""){
$piamount="-";
$totals="-";
} else {
$piamount=$cursign." ".number_format($data['piamount'],2,".",",");
$totals=$cursign." ".number_format($total,2,".",",");
}
if($data['surcharge']=="0.00" || $data['surcharge']==""){
$surcharge="-";
}else{
$surcharge=$cursign." ".number_format($data['surcharge'],2,".",",");
}
if($data['surcharge2']=="0.00" || $data['surcharge2']==""){
$surcharge2="-";   
}else{
$surcharge2=$cursign." ".number_format($data['surcharge2'],2,".",",");
}
} else {
if($data['piamount']=="0.00000" && $data['surcharge']=="0.00"){
$piamount="-";
$totals="-";
} else {
$piamount=$cursign." ".number_format($data['piamount'],2,".",",");
$totals=$cursign." ".number_format($total,2,".",",");
}
if($data['surcharge']=="0.00" || $data['surcharge']==""){
$surcharge="-";
}else{
$surcharge=$cursign." ".number_format($data['surcharge'],2,".",",");
}
if($data['surcharge2']=="0.00" || $data['surcharge2']==""){
$surcharge2="-";
}else{
$surcharge2=$cursign." ".number_format($data['surcharge2'],2,".",",");
}
}

if($chek=='1'){
$tglapvx=$data['supnm'];
}else{
$tglapvx=$tglapv;
}

if($data['etd']=="0000-00-00" || $data['etd']=="") { $etd2="-";}
else {
$etd2=tgl($data['etd']);
//$etd=date_format($etda,"d F Y");
}

if($data['paydate']=="0000-00-00" || $data['paydate']=="") { $paydate="-";}
else {
$paydate=tgl($data['paydate']);
//$paydate=date_format($paydatea,"d F Y");
}

// if($data['stsapv']==1){
// $sts='<input type="text" name="apv" id="apv" value="Approved" size="5" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color: #0B89D2;" readonly>';    
// }else{
// $sts='<input type="text" name="new" id="new" value="New" size="5" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color: #BDBDBD;;" readonly>';    
// }

$sts='<input type="text" name="new" id="new" value="On hold" size="7" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color: #BDBDBD;;" readonly>';    

$qtys=number_format($data['qtys'],0,".",",")." ".$data['unit'];
$specb=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼"]/', ' ', $data['spec']);

if($data['unit']=="KG" || $data['unit']=="DZN" || $data['unit']=="RIM"){
    $piqty1=$data['pocons'];   
} else {
    $piqty1=ceil($data['pocons']);
}

$piprice1=$data['price'];
$piunit1=$data['unit'];

if($data['curid']=="IDR"){
    if($piprice1=="0.00000" || $piprice1==""){
    $piprice="-";
    $piprice2="-";
    } else {
    $piprice=number_format($piprice1,2,".",",");
    $piprice2=$cursign." ".number_format($piprice1,2,".",",");
    $tot2=$piprice1*$piqty1;
    $total2=$cursign." ".number_format($tot2,2,".",",");
    }
    } else {
    if($piprice1=="0.00000" || $piprice1==""){
    $piprice="-";
    $piprice2="-";
    } else {
    $piprice=number_format($piprice1,5,".",",");
    $piprice2=$cursign." ".number_format($piprice1,5,".",",");
    $tot2=$piprice1*$piqty1;
    $total2=$cursign." ".number_format($tot2,5,".",",");
    }
}

$pocons=number_format($data['pocons'],0,".",",")." ".$data['unit'];

$row[] = array(
'no'=>$k,
'pono'=>$data['pono'],
'ordno'=>$data['ordno'],
'popk'=>$data['popk'],
'podtpk'=>$data['podtpk'],
'spec'=> $specb,
'price'=> $total2,
'balance'=> $balance2,
'color'=>$data['colname'],
'item'=> $data['item'],
'ordno'=>$data['ordno'],
'supnm'=>$data['supnm'],
'suppk'=>$data['suppk'],
'byrnm'=>$data['byrnm'],
'byrpk'=>$data['byrpk'],
'total'=>$pocons,
'unit'=>$data['unit'],
'payterm'=>$data['potop'],
'etd2'=>$etd2,
'status'=>$sts,
'qtys'=>$data['qtys'],
'importdtpk'=>$data['importdtpk']);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>
