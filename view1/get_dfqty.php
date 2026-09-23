<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
include "../config/tanggal2.php";
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 4000;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'bdown.nour';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;
$cari4 = isset($_POST['cari4']) ? ($_POST['cari4']) : false;
$cari5 = isset($_POST['cari5']) ? ($_POST['cari5']) : false;
$ord = isset($_GET['ord']) ? ($_GET['ord']) : false;

$cari3a = explode(",",$cari3);
$cari3b = implode("','",$cari3a);

$cari4a = explode(",",$cari4);
$cari4b = implode("','",$cari4a);

$cari5a = explode(",",$cari5);
$cari5b = implode("','",$cari5a);

//$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
//$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;

$offset = ($page-1) * $rows;

if($cari3){$and3="and bdown.country IN ('$cari3b')";}
if($cari4){$and4="and bdown.color IN ('$cari4b')";}
if($cari5){$and5="and bdown.secsz IN ('$cari5b')";}

if($cari1){
$and1="and concat(bdown.country,bdown.pono,bdown.opno,bdown.style,bdown.color) like '%$cari1%'";
}
//else if($cari2){ $and2="and byr.byrpk='$cari2'"; }
//else if($cari3){ $and3="and ord.season like '%$cari3%'"; }

$rs = mysqli_query($koneksi,"select * FROM bdown
left outer join ord on ord.ordpk=bdown.ordpk
where ord.ordpk='$ord'
AND (jenis IN ('DETAIL','HEADER')) $and1 $and3 $and4 $and5
AND (bdown.jenis <> 'DETAIL' OR (bdown.jenis = 'DETAIL' AND bdown.color <> ''))
GROUP BY 
  CASE WHEN bdown.jenis = 'HEADER' THEN bdown.jenis ELSE bdown.bdownpk END
ORDER BY
CASE WHEN bdown.jenis = 'DETAIL' THEN bdown.bdownpk END ASC, $sort $order
LIMIT $rows OFFSET $offset");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"select * FROM bdown
left outer join ord on ord.ordpk=bdown.ordpk
where ord.ordpk='$ord'
AND (jenis IN ('DETAIL','HEADER')) $and1 $and3 $and4 $and5
AND (bdown.jenis <> 'DETAIL' OR (bdown.jenis = 'DETAIL' AND bdown.color <> ''))
GROUP BY 
  CASE WHEN bdown.jenis = 'HEADER' THEN bdown.jenis ELSE bdown.bdownpk END"));
$row = array();

$k =$offset;
while($data=mysqli_fetch_array($rs)){
$k++;

//$btn = '<a href="?hal=detord&ord='.$data['ordpk'].'" style="text-decoration:none;">'.$data['ordno'].'</a>';
if(TRIM($data['jenis'])=="HEADER"){
$po="";
$op="";
$style="";
$color="";
$gac="";
$fob="";
$ddp="";
$secsz="";
$country="<b>".$data['country']."</b>";
$s1="<b>".$data['s1']."</b>";
$s2="<b>".$data['s2']."</b>";
$s3="<b>".$data['s3']."</b>";
$s4="<b>".$data['s4']."</b>";
$s5="<b>".$data['s5']."</b>";
$s6="<b>".$data['s6']."</b>";
$s7="<b>".$data['s7']."</b>";
$s8="<b>".$data['s8']."</b>";
$s9="<b>".$data['s9']."</b>";
$s10="<b>".$data['s10']."</b>";
$s11="<b>".$data['s11']."</b>";
$s12="<b>".$data['s12']."</b>";
$s13="<b>".$data['s13']."</b>";
$s14="<b>".$data['s14']."</b>";
$s15="<b>".$data['s15']."</b>";
$s16="<b>".$data['s16']."</b>";
$s17="<b>".$data['s17']."</b>";
$s18="<b>".$data['s18']."</b>";
$s19="<b>".$data['s19']."</b>";
$s20="<b>".$data['s20']."</b>";
// $s21="<b>".$data['s21']."</b>";
// $s22="<b>".$data['s22']."</b>";
// $s23="<b>".$data['s23']."</b>";
// $s24="<b>".$data['s24']."</b>";
// $s25="<b>".$data['s25']."</b>";
// $s26="<b>".$data['s26']."</b>";
// $s27="<b>".$data['s27']."</b>";
// $s28="<b>".$data['s28']."</b>";
// $s29="<b>".$data['s29']."</b>";
// $s30="<b>".$data['s30']."</b>";
// $s31="<b>".$data['s31']."</b>";
// $s32="<b>".$data['s32']."</b>";
// $s33="<b>".$data['s33']."</b>";
// $s34="<b>".$data['s34']."</b>";
// $s35="<b>".$data['s35']."</b>";
// $s36="<b>".$data['s36']."</b>";
// $s37="<b>".$data['s37']."</b>";
// $s38="<b>".$data['s38']."</b>";
// $s39="<b>".$data['s39']."</b>";
// $s40="<b>".$data['s40']."</b>";
$tot="";
} else if(TRIM($data['jenis'])=="DETAIL"){
$po=$data['pono'];
$op=$data['opno'];
$style=$data['style'];
$color=$data['color'];
$fob=$data['FOB'];
$ddp=$data['DDP'];
$secsz=$data['secsz'];
$country=$data['country'];

if($data['gac']=="0000-00-00"){ $gac=""; $gac2=""; }
else {
if($data['gac']==""){ $gac=""; $gac2=""; }
else { $gac=$data['gac']; $gac2=tgl2($data['gac']); }
}

if($data['s1']<1){ $s1="0"; } else { $s1=$data['s1']; }
if($data['s2']<1){ $s2="0"; } else { $s2=$data['s2']; }
if($data['s3']<1){ $s3="0"; } else { $s3=$data['s3']; }
if($data['s4']<1){ $s4="0"; } else { $s4=$data['s4']; }
if($data['s5']<1){ $s5="0"; } else { $s5=$data['s5']; }
if($data['s6']<1){ $s6="0"; } else { $s6=$data['s6']; }
if($data['s7']<1){ $s7="0"; } else { $s7=$data['s7']; }
if($data['s8']<1){ $s8="0"; } else { $s8=$data['s8']; }
if($data['s9']<1){ $s9="0"; } else { $s9=$data['s9']; }
if($data['s10']<1){ $s10="0"; } else { $s10=$data['s10']; }
if($data['s11']<1){ $s11="0"; } else { $s11=$data['s11']; }
if($data['s12']<1){ $s12="0"; } else { $s12=$data['s12']; }
if($data['s13']<1){ $s13="0"; } else { $s13=$data['s13']; }
if($data['s14']<1){ $s14="0"; } else { $s14=$data['s14']; }
if($data['s15']<1){ $s15="0"; } else { $s15=$data['s15']; }
if($data['s16']<1){ $s16="0"; } else { $s16=$data['s16']; }
if($data['s17']<1){ $s17="0"; } else { $s17=$data['s17']; }
if($data['s18']<1){ $s18="0"; } else { $s18=$data['s18']; }
if($data['s19']<1){ $s19="0"; } else { $s19=$data['s19']; }
if($data['s20']<1){ $s20="0"; } else { $s20=$data['s20']; }
// if($data['s21']<1){ $s21="0"; } else { $s21=$data['s21']; }
// if($data['s22']<1){ $s22="0"; } else { $s22=$data['s22']; }
// if($data['s23']<1){ $s23="0"; } else { $s23=$data['s23']; }
// if($data['s24']<1){ $s24="0"; } else { $s24=$data['s24']; }
// if($data['s25']<1){ $s25="0"; } else { $s25=$data['s25']; }
// if($data['s26']<1){ $s26="0"; } else { $s26=$data['s26']; }
// if($data['s27']<1){ $s27="0"; } else { $s27=$data['s27']; }
// if($data['s28']<1){ $s28="0"; } else { $s28=$data['s28']; }
// if($data['s29']<1){ $s29="0"; } else { $s29=$data['s29']; }
// if($data['s30']<1){ $s30="0"; } else { $s30=$data['s30']; }
// if($data['s31']<1){ $s31="0"; } else { $s31=$data['s31']; }
// if($data['s32']<1){ $s32="0"; } else { $s32=$data['s32']; }
// if($data['s33']<1){ $s33="0"; } else { $s33=$data['s33']; }
// if($data['s34']<1){ $s34="0"; } else { $s34=$data['s34']; }
// if($data['s35']<1){ $s35="0"; } else { $s35=$data['s35']; }
// if($data['s36']<1){ $s36="0"; } else { $s36=$data['s36']; }
// if($data['s37']<1){ $s37="0"; } else { $s37=$data['s37']; }
// if($data['s38']<1){ $s38="0"; } else { $s38=$data['s38']; }
// if($data['s39']<1){ $s39="0"; } else { $s39=$data['s39']; }
// if($data['s40']<1){ $s40="0"; } else { $s40=$data['s40']; }
if($data['tot']<1){ $tot="0"; } else { $tot=$data['tot']; } 
} /*else if($data['jenis']=="FOOTER"){
$po="";
$op="";
$style="";
$color="";
$gac="";
if($data['s1']<1){ $s1="0"; } else { $s1=$data['s1']; }
if($data['s2']<1){ $s2="0"; } else { $s2=$data['s2']; }
if($data['s3']<1){ $s3="0"; } else { $s3=$data['s3']; }
if($data['s4']<1){ $s4="0"; } else { $s4=$data['s4']; }
if($data['s5']<1){ $s5="0"; } else { $s5=$data['s5']; }
if($data['s6']<1){ $s6="0"; } else { $s6=$data['s6']; }
if($data['s7']<1){ $s7="0"; } else { $s7=$data['s7']; }
if($data['s8']<1){ $s8="0"; } else { $s8=$data['s8']; }
if($data['s9']<1){ $s9="0"; } else { $s9=$data['s9']; }
if($data['s10']<1){ $s10="0"; } else { $s10=$data['s10']; }
if($data['s11']<1){ $s11="0"; } else { $s11=$data['s11']; }
if($data['s12']<1){ $s12="0"; } else { $s12=$data['s12']; }
if($data['s13']<1){ $s13="0"; } else { $s13=$data['s13']; }
if($data['s14']<1){ $s14="0"; } else { $s14=$data['s14']; }
if($data['s15']<1){ $s15="0"; } else { $s15=$data['s15']; }
if($data['tot']<1){ $tot="0"; } else { $tot=$data['tot']; } 
}*/
if(TRIM($data['jenis'])=="HEADER"){
$row[] = array(
'no'=>$k,
'jenis'=>$data['jenis'],
'ordpk'=>$data['ordpk'],
'ordno'=>$data['ordno'],
'bdownpk'=>$data['bdownpk'],
'country'=>$country,
'poref'=>$data['poref'],
'pono'=>$po,
'opno'=>$op,
'style'=>$style,
'color'=>$color,
'fob'=>$fob,
'ddp'=>$ddp,
'secsz'=>$secsz,
'gac'=>$gac,
'gac2'=>$gac2,
's1'=>$s1,
's2'=>$s2,
's3'=>$s3,
's4'=>$s4,
's5'=>$s5,
's6'=>$s6,
's7'=>$s7,
's8'=>$s8,
's9'=>$s9,
's10'=>$s10,
's11'=>$s11,
's12'=>$s12,
's13'=>$s13,
's14'=>$s14,
's15'=>$s15,
's16'=>$s16,
's17'=>$s17,
's18'=>$s18,
's19'=>$s19,
's20'=>$s20,
// 's21'=>$s21,
// 's22'=>$s22,
// 's23'=>$s23,
// 's24'=>$s24,
// 's25'=>$s25,
// 's26'=>$s26,
// 's27'=>$s27,
// 's28'=>$s28,
// 's29'=>$s29,
// 's30'=>$s30,
// 's31'=>$s31,
// 's32'=>$s32,
// 's33'=>$s33,
// 's34'=>$s34,
// 's35'=>$s35,
// 's36'=>$s36,
// 's37'=>$s37,
// 's38'=>$s38,
// 's39'=>$s39,
// 's40'=>$s40,
'tot'=>$tot);
} else {
if($data['country']=="" && $data['color']==""){
} else {
$row[] = array(
'no'=>$k,
'jenis'=>$data['jenis'],
'ordpk'=>$data['ordpk'],
'ordno'=>$data['ordno'],
'bdownpk'=>$data['bdownpk'],
'country'=>$country,
'poref'=>$data['poref'],
'pono'=>$po,
'opno'=>$op,
'style'=>$style,
'color'=>$color,
'fob'=>$fob,
'ddp'=>$ddp,
'secsz'=>$secsz,
'gac'=>$gac,
'gac2'=>$gac2,
's1'=>$s1,
's2'=>$s2,
's3'=>$s3,
's4'=>$s4,
's5'=>$s5,
's6'=>$s6,
's7'=>$s7,
's8'=>$s8,
's9'=>$s9,
's10'=>$s10,
's11'=>$s11,
's12'=>$s12,
's13'=>$s13,
's14'=>$s14,
's15'=>$s15,
's16'=>$s16,
's17'=>$s17,
's18'=>$s18,
's19'=>$s19,
's20'=>$s20,
// 's21'=>$s21,
// 's22'=>$s22,
// 's23'=>$s23,
// 's24'=>$s24,
// 's25'=>$s25,
// 's26'=>$s26,
// 's27'=>$s27,
// 's28'=>$s28,
// 's29'=>$s29,
// 's30'=>$s30,
// 's31'=>$s31,
// 's32'=>$s32,
// 's33'=>$s33,
// 's34'=>$s34,
// 's35'=>$s35,
// 's36'=>$s36,
// 's37'=>$s37,
// 's38'=>$s38,
// 's39'=>$s39,
// 's40'=>$s40,
'tot'=>$tot);    
}
}
}

/*$rs1 = mysqli_query($koneksi,"select * FROM bdown
left outer join ord on ord.ordpk=bdown.ordpk
where  ord.ordpk='$ord' and bdown.jenis='HEADER' order by bdown.bdownpk asc");
//LIMIT $rows OFFSET $offset");
$header = array();
while($data1=mysqli_fetch_array($rs1)){
$po="";
$op="";
$style="";
$color="";
$gac="";
$s1=$data1['s1'];
$s2=$data1['s2'];
$s3=$data1['s3'];
$s4=$data1['s4'];
$s5=$data1['s5'];
$s6=$data1['s6'];
$s7=$data1['s7'];
$s8=$data1['s8'];
$s9=$data1['s9'];
$s10=$data1['s10'];
$s11=$data1['s11'];
$s12=$data1['s12'];
$s13=$data1['s13'];
$s14=$data1['s14'];
$s15=$data1['s15'];
$tot="";

$header[] = array(
'jenis'=>$data1['jenis'],
'ordpk'=>$data1['ordpk'],
'ordno'=>$data1['ordno'],
'bdownpk'=>$data1['bdownpk'],
'country'=>$data1['country'],
'pono'=>$po,
'opno'=>$op,
'style'=>$style,
'color'=>$color,
'gac'=>$gac,
's1'=>$s1,
's2'=>$s2,
's3'=>$s3,
's4'=>$s4,
's5'=>$s5,
's6'=>$s6,
's7'=>$s7,
's8'=>$s8,
's9'=>$s9,
's10'=>$s10,
's11'=>$s11,
's12'=>$s12,
's13'=>$s13,
's14'=>$s14,
's15'=>$s15,
'tot'=>$tot);
}*/

$rs2 = mysqli_query($koneksi,"SELECT bdown.color, bdown.country, ord.ordpk, 
SUM(bdown.s1) AS s1,
SUM(bdown.s2) AS s2,
SUM(bdown.s3) AS s3,
SUM(bdown.s4) AS s4,
SUM(bdown.s5) AS s5,
SUM(bdown.s6) AS s6,
SUM(bdown.s7) AS s7,
SUM(bdown.s8) AS s8,
SUM(bdown.s9) AS s9,
SUM(bdown.s10) AS s10,
SUM(bdown.s11) AS s11,
SUM(bdown.s12) AS s12,
SUM(bdown.s13) AS s13,
SUM(bdown.s14) AS s14,
SUM(bdown.s15) AS s15,
SUM(bdown.s16) AS s16,
SUM(bdown.s17) AS s17,
SUM(bdown.s18) AS s18,
SUM(bdown.s19) AS s19,
SUM(bdown.s20) AS s20,
SUM(bdown.s21) AS s21,
SUM(bdown.s22) AS s22,
SUM(bdown.s23) AS s23,
SUM(bdown.s24) AS s24,
SUM(bdown.s25) AS s25,
SUM(bdown.s26) AS s26,
SUM(bdown.s27) AS s27,
SUM(bdown.s28) AS s28,
SUM(bdown.s29) AS s29,
SUM(bdown.s30) AS s30,
SUM(bdown.s31) AS s31,
SUM(bdown.s32) AS s32,
SUM(bdown.s33) AS s33,
SUM(bdown.s34) AS s34,
SUM(bdown.s35) AS s35,
SUM(bdown.s36) AS s36,
SUM(bdown.s37) AS s37,
SUM(bdown.s38) AS s38,
SUM(bdown.s39) AS s39,
SUM(bdown.s40) AS s40
FROM bdown
LEFT OUTER JOIN ord ON ord.ordpk=bdown.ordpk
where  ord.ordpk='$ord' and bdown.color<>'' $and1 $and3 $and4 AND bdown.jenis='DETAIL' and bdown.tot>'0'
GROUP BY bdown.color order by bdown.color asc");
$entry = array();
while ($row2 = mysqli_fetch_array($rs2)){
	
if($row2['s1']<1){ $s1="0"; } else { $s1=$row2['s1']; }
if($row2['s2']<1){ $s2="0"; } else { $s2=$row2['s2']; }
if($row2['s3']<1){ $s3="0"; } else { $s3=$row2['s3']; }
if($row2['s4']<1){ $s4="0"; } else { $s4=$row2['s4']; }
if($row2['s5']<1){ $s5="0"; } else { $s5=$row2['s5']; }
if($row2['s6']<1){ $s6="0"; } else { $s6=$row2['s6']; }
if($row2['s7']<1){ $s7="0"; } else { $s7=$row2['s7']; }
if($row2['s8']<1){ $s8="0"; } else { $s8=$row2['s8']; }
if($row2['s9']<1){ $s9="0"; } else { $s9=$row2['s9']; }
if($row2['s10']<1){ $s10="0"; } else { $s10=$row2['s10']; }
if($row2['s11']<1){ $s11="0"; } else { $s11=$row2['s11']; }
if($row2['s12']<1){ $s12="0"; } else { $s12=$row2['s12']; }
if($row2['s13']<1){ $s13="0"; } else { $s13=$row2['s13']; }
if($row2['s14']<1){ $s14="0"; } else { $s14=$row2['s14']; }
if($row2['s15']<1){ $s15="0"; } else { $s15=$row2['s15']; }
if($row2['s16']<1){ $s16="0"; } else { $s16=$row2['s16']; }
if($row2['s17']<1){ $s17="0"; } else { $s17=$row2['s17']; }
if($row2['s18']<1){ $s18="0"; } else { $s18=$row2['s18']; }
if($row2['s19']<1){ $s19="0"; } else { $s19=$row2['s19']; }
if($row2['s20']<1){ $s20="0"; } else { $s20=$row2['s20']; }
// if($row2['s21']<1){ $s21="0"; } else { $s21=$row2['s21']; }
// if($row2['s22']<1){ $s22="0"; } else { $s22=$row2['s22']; }
// if($row2['s23']<1){ $s23="0"; } else { $s23=$row2['s23']; }
// if($row2['s24']<1){ $s24="0"; } else { $s24=$row2['s24']; }
// if($row2['s25']<1){ $s25="0"; } else { $s25=$row2['s25']; }
// if($row2['s26']<1){ $s26="0"; } else { $s26=$row2['s26']; }
// if($row2['s27']<1){ $s27="0"; } else { $s27=$row2['s27']; }
// if($row2['s28']<1){ $s28="0"; } else { $s28=$row2['s28']; }
// if($row2['s29']<1){ $s29="0"; } else { $s29=$row2['s29']; }
// if($row2['s30']<1){ $s30="0"; } else { $s30=$row2['s30']; }
// if($row2['s31']<1){ $s31="0"; } else { $s31=$row2['s31']; }
// if($row2['s32']<1){ $s32="0"; } else { $s32=$row2['s32']; }
// if($row2['s33']<1){ $s33="0"; } else { $s33=$row2['s33']; }
// if($row2['s34']<1){ $s34="0"; } else { $s34=$row2['s34']; }
// if($row2['s35']<1){ $s35="0"; } else { $s35=$row2['s35']; }
// if($row2['s36']<1){ $s36="0"; } else { $s36=$row2['s36']; }
// if($row2['s37']<1){ $s37="0"; } else { $s37=$row2['s37']; }
// if($row2['s38']<1){ $s38="0"; } else { $s38=$row2['s38']; }
// if($row2['s39']<1){ $s39="0"; } else { $s39=$row2['s39']; }
// if($row2['s40']<1){ $s40="0"; } else { $s40=$row2['s40']; }
// if($row2['tot']<1){ $tot="0"; } else { $tot=$row2['tot']; } 
$total=$s1+$s2+$s3+$s4+$s5+$s6+$s7+$s8+$s9+$s10+$s11+$s12+$s13+$s14+$s15+
$s16+$s17+$s18+$s19+$s20+$s21+$s22+$s23+$s24+$s25+$s26+$s27+$s28+$s29+$s30+
$s31+$s32+$s33+$s34+$s35+$s36+$s37+$s38+$s39+$s40;

//if($cari3=="Place"){$ftr=$row2['country'];}
//else if($cari3=="Color"){$ftr=$row2['color'];}
//else {$ftr=$row2['color'];}

$ftr=$row2['color'];
$entry []  = array(
    'secsz'=>$ftr,
    's1'=> $s1,
    's2'=> $s2,
    's3'=> $s3,
    's4'=> $s4,
    's5'=> $s5,
    's6'=> $s6,
    's7'=> $s7,
    's8'=> $s8,
    's9'=> $s9,
    's10'=> $s10,
	's11'=> $s11,
    's12'=> $s12,
    's13'=> $s13,
    's14'=> $s14,
    's15'=> $s15,
    's16'=>$s16,
    's17'=>$s17,
    's18'=>$s18,
    's19'=>$s19,
    's20'=>$s20,
    // 's21'=>$s21,
    // 's22'=>$s22,
    // 's23'=>$s23,
    // 's24'=>$s24,
    // 's25'=>$s25,
    // 's26'=>$s26,
    // 's27'=>$s27,
    // 's28'=>$s28,
    // 's29'=>$s29,
    // 's30'=>$s30,
    // 's31'=>$s31,
    // 's32'=>$s32,
    // 's33'=>$s33,
    // 's34'=>$s34,
    // 's35'=>$s35,
    // 's36'=>$s36,
    // 's37'=>$s37,
    // 's38'=>$s38,
    // 's39'=>$s39,
    // 's40'=>$s40,
	'tot'=> "<b>".$total."<b>");

/*$cr=mysqli_query($koneksi,"select * from bdown where ordpk='$ord' and sumby='color' and sumdata='$ftr' and jenis='FOOTER1'");
$dt=mysqli_fetch_array($cr);
$bdownpk=$dt['bdownpk'];
$cr1=mysqli_query($koneksi,"select * from bdown where ordpk='$ord' and jenis='DETAIL' order by nour desc limit 1");
$dt1=mysqli_fetch_array($cr1);
$nour=$dt1['nour']+1;
if($bdownpk>0){
$update=mysqli_query($koneksi,"update bdown set
nour='$nour',
s1='$s1',
s2='$s2',
s3='$s3',
s4='$s4',
s5='$s5',
s6='$s6',
s7='$s7',
s8='$s8',
s9='$s9',
s10='$s10',
s11='$s11',
s12='$s12',
s13='$s13',
s14='$s14',
s15='$s15',
tot='$total' where bdownpk='$bdownpk'");
} else {
$update=mysqli_query($koneksi,"insert into bdown set
nour='$nour',
s1='$s1',
s2='$s2',
s3='$s3',
s4='$s4',
s5='$s5',
s6='$s6',
s7='$s7',
s8='$s8',
s9='$s9',
s10='$s10',
s11='$s11',
s12='$s12',
s13='$s13',
s14='$s14',
s15='$s15',
tot='$total',
ordpk='$ord',
sumby='color',
sumdata='$ftr',
jenis='FOOTER1'");  
}*/
}

$rs2b = mysqli_query($koneksi,"SELECT ord.ordpk,
SUM(bdown.s1) AS s1,
SUM(bdown.s2) AS s2,
SUM(bdown.s3) AS s3,
SUM(bdown.s4) AS s4,
SUM(bdown.s5) AS s5,
SUM(bdown.s6) AS s6,
SUM(bdown.s7) AS s7,
SUM(bdown.s8) AS s8,
SUM(bdown.s9) AS s9,
SUM(bdown.s10) AS s10,
SUM(bdown.s11) AS s11,
SUM(bdown.s12) AS s12,
SUM(bdown.s13) AS s13,
SUM(bdown.s14) AS s14,
SUM(bdown.s15) AS s15,
SUM(bdown.s16) AS s16,
SUM(bdown.s17) AS s17,
SUM(bdown.s18) AS s18,
SUM(bdown.s19) AS s19,
SUM(bdown.s20) AS s20,
SUM(bdown.s21) AS s21,
SUM(bdown.s22) AS s22,
SUM(bdown.s23) AS s23,
SUM(bdown.s24) AS s24,
SUM(bdown.s25) AS s25,
SUM(bdown.s26) AS s26,
SUM(bdown.s27) AS s27,
SUM(bdown.s28) AS s28,
SUM(bdown.s29) AS s29,
SUM(bdown.s30) AS s30,
SUM(bdown.s31) AS s31,
SUM(bdown.s32) AS s32,
SUM(bdown.s33) AS s33,
SUM(bdown.s34) AS s34,
SUM(bdown.s35) AS s35,
SUM(bdown.s36) AS s36,
SUM(bdown.s37) AS s37,
SUM(bdown.s38) AS s38,
SUM(bdown.s39) AS s39,
SUM(bdown.s40) AS s40
FROM bdown
LEFT OUTER JOIN ord ON ord.ordpk=bdown.ordpk
where  ord.ordpk='$ord' $and1 $and3 $and4 AND bdown.jenis='DETAIL' and bdown.tot>'0'
group by ord.ordpk");
$entryb = array();
while ($row2b = mysqli_fetch_array($rs2b)){
	
if($row2b['s1']<1){ $s1b="0"; } else { $s1b=$row2b['s1']; }
if($row2b['s2']<1){ $s2b="0"; } else { $s2b=$row2b['s2']; }
if($row2b['s3']<1){ $s3b="0"; } else { $s3b=$row2b['s3']; }
if($row2b['s4']<1){ $s4b="0"; } else { $s4b=$row2b['s4']; }
if($row2b['s5']<1){ $s5b="0"; } else { $s5b=$row2b['s5']; }
if($row2b['s6']<1){ $s6b="0"; } else { $s6b=$row2b['s6']; }
if($row2b['s7']<1){ $s7b="0"; } else { $s7b=$row2b['s7']; }
if($row2b['s8']<1){ $s8b="0"; } else { $s8b=$row2b['s8']; }
if($row2b['s9']<1){ $s9b="0"; } else { $s9b=$row2b['s9']; }
if($row2b['s10']<1){ $s10b="0"; } else { $s10b=$row2b['s10']; }
if($row2b['s11']<1){ $s11b="0"; } else { $s11b=$row2b['s11']; }
if($row2b['s12']<1){ $s12b="0"; } else { $s12b=$row2b['s12']; }
if($row2b['s13']<1){ $s13b="0"; } else { $s13b=$row2b['s13']; }
if($row2b['s14']<1){ $s14b="0"; } else { $s14b=$row2b['s14']; }
if($row2b['s15']<1){ $s15b="0"; } else { $s15b=$row2b['s15']; }
if($row2b['s16']<1){ $s16b="0"; } else { $s16b=$row2b['s16']; }
if($row2b['s17']<1){ $s17b="0"; } else { $s17b=$row2b['s17']; }
if($row2b['s18']<1){ $s18b="0"; } else { $s18b=$row2b['s18']; }
if($row2b['s19']<1){ $s19b="0"; } else { $s19b=$row2b['s19']; }
if($row2b['s20']<1){ $s20b="0"; } else { $s20b=$row2b['s20']; }
// if($row2b['s21']<1){ $s21b="0"; } else { $s21b=$row2b['s21']; }
// if($row2b['s22']<1){ $s22b="0"; } else { $s22b=$row2b['s22']; }
// if($row2b['s23']<1){ $s23b="0"; } else { $s23b=$row2b['s23']; }
// if($row2b['s24']<1){ $s24b="0"; } else { $s24b=$row2b['s24']; }
// if($row2b['s25']<1){ $s25b="0"; } else { $s25b=$row2b['s25']; }
// if($row2b['s26']<1){ $s26b="0"; } else { $s26b=$row2b['s26']; }
// if($row2b['s27']<1){ $s27b="0"; } else { $s27b=$row2b['s27']; }
// if($row2b['s28']<1){ $s28b="0"; } else { $s28b=$row2b['s28']; }
// if($row2b['s29']<1){ $s29b="0"; } else { $s29b=$row2b['s29']; }
// if($row2b['s30']<1){ $s30b="0"; } else { $s30b=$row2b['s30']; }
// if($row2b['s31']<1){ $s31b="0"; } else { $s31b=$row2b['s31']; }
// if($row2b['s32']<1){ $s32b="0"; } else { $s32b=$row2b['s32']; }
// if($row2b['s33']<1){ $s33b="0"; } else { $s33b=$row2b['s33']; }
// if($row2b['s34']<1){ $s34b="0"; } else { $s34b=$row2b['s34']; }
// if($row2b['s35']<1){ $s35b="0"; } else { $s35b=$row2b['s35']; }
// if($row2b['s36']<1){ $s36b="0"; } else { $s36b=$row2b['s36']; }
// if($row2b['s37']<1){ $s37b="0"; } else { $s37b=$row2b['s37']; }
// if($row2b['s38']<1){ $s38b="0"; } else { $s38b=$row2b['s38']; }
// if($row2b['s39']<1){ $s39b="0"; } else { $s39b=$row2b['s39']; }
// if($row2b['s40']<1){ $s40b="0"; } else { $s40b=$row2b['s40']; }

$gtotal=$s1b+$s2b+$s3b+$s4b+$s5b+$s6b+$s7b+$s8b+$s9b+$s10b+$s11b+$s12b+$s13b+$s14b+$s15b+
$s16b+$s17b+$s18b+$s19b+$s20b+$s21b+$s22b+$s23b+$s24b+$s25b+$s26b+$s27b+$s28b+$s29b+$s30b+
$s31b+$s32b+$s33b+$s34b+$s35b+$s36b+$s37b+$s38b+$s39b+$s40b;
		
$entryb []  = array(
    'secsz'=>"<b>TOTAL</b>",
    's1'=> "<b>".$s1b."<b>",
    's2'=> "<b>".$s2b."<b>",
    's3'=> "<b>".$s3b."<b>",
    's4'=> "<b>".$s4b."<b>",
    's5'=> "<b>".$s5b."<b>",
    's6'=> "<b>".$s6b."<b>",
    's7'=> "<b>".$s7b."<b>",
    's8'=> "<b>".$s8b."<b>",
    's9'=> "<b>".$s9b."<b>",
    's10'=> "<b>".$s10b."<b>",
	's11'=> "<b>".$s11b."<b>",
    's12'=> "<b>".$s12b."<b>",
    's13'=> "<b>".$s13b."<b>",
    's14'=> "<b>".$s14b."<b>",
    's15'=> "<b>".$s15b."<b>",
    's16'=> "<b>".$s16b."</b>",
    's17'=> "<b>".$s17b."</b>",
    's18'=> "<b>".$s18b."</b>",
    's19'=> "<b>".$s19b."</b>",
    's20'=> "<b>".$s20b."</b>",
    // 's21'=> "<b>".$s21b."</b>",
    // 's22'=> "<b>".$s22b."</b>",
    // 's23'=> "<b>".$s23b."</b>",
    // 's24'=> "<b>".$s24b."</b>",
    // 's25'=> "<b>".$s25b."</b>",
    // 's26'=> "<b>".$s26b."</b>",
    // 's27'=> "<b>".$s27b."</b>",
    // 's28'=> "<b>".$s28b."</b>",
    // 's29'=> "<b>".$s29b."</b>",
    // 's30'=> "<b>".$s30b."</b>",
    // 's31'=> "<b>".$s31b."</b>",
    // 's32'=> "<b>".$s32b."</b>",
    // 's33'=> "<b>".$s33b."</b>",
    // 's34'=> "<b>".$s34b."</b>",
    // 's35'=> "<b>".$s35b."</b>",
    // 's36'=> "<b>".$s36b."</b>",
    // 's37'=> "<b>".$s37b."</b>",
    // 's38'=> "<b>".$s38b."</b>",
    // 's39'=> "<b>".$s39b."</b>",
    // 's40'=> "<b>".$s40b."</b>",
	'tot'=> "<b>".$gtotal."<b>");

/*$cr=mysqli_query($koneksi,"select * from bdown where ordpk='$ord' and sumby='total' and jenis='FOOTER1'");
$dt=mysqli_fetch_array($cr);
$bdownpk=$dt['bdownpk'];
$cr1=mysqli_query($koneksi,"select * from bdown where ordpk='$ord' and  jenis='FOOTER1' order by nour desc limit 1");
$dt1=mysqli_fetch_array($cr1);
$nour=$dt1['nour']+1;
if($bdownpk>0){
$update=mysqli_query($koneksi,"update bdown set
nour='$nour',
s1='$s1b',
s2='$s2b',
s3='$s3b',
s4='$s4b',
s5='$s5b',
s6='$s6b',
s7='$s7b',
s8='$s8b',
s9='$s9b',
s10='$s10b',
s11='$s11b',
s12='$s12b',
s13='$s13b',
s14='$s14b',
s15='$s15b',
tot='$gtotal' where bdownpk='$bdownpk'");
} else {
$update=mysqli_query($koneksi,"insert into bdown set
nour='$nour',
s1='$s1b',
s2='$s2b',
s3='$s3b',
s4='$s4b',
s5='$s5b',
s6='$s6b',
s7='$s7b',
s8='$s8b',
s9='$s9b',
s10='$s10b',
s11='$s11b',
s12='$s12b',
s13='$s13b',
s14='$s14b',
s15='$s15b',
tot='$gtotal',
ordpk='$ord',
sumby='total',
jenis='FOOTER1'");  
}*/
}

$rs2c = mysqli_query($koneksi,"SELECT bdown.color, bdown.country, ord.ordpk, 
SUM(bdown.s1) AS s1,
SUM(bdown.s2) AS s2,
SUM(bdown.s3) AS s3,
SUM(bdown.s4) AS s4,
SUM(bdown.s5) AS s5,
SUM(bdown.s6) AS s6,
SUM(bdown.s7) AS s7,
SUM(bdown.s8) AS s8,
SUM(bdown.s9) AS s9,
SUM(bdown.s10) AS s10,
SUM(bdown.s11) AS s11,
SUM(bdown.s12) AS s12,
SUM(bdown.s13) AS s13,
SUM(bdown.s14) AS s14,
SUM(bdown.s15) AS s15,
SUM(bdown.s16) AS s16,
SUM(bdown.s17) AS s17,
SUM(bdown.s18) AS s18,
SUM(bdown.s19) AS s19,
SUM(bdown.s20) AS s20,
SUM(bdown.s21) AS s21,
SUM(bdown.s22) AS s22,
SUM(bdown.s23) AS s23,
SUM(bdown.s24) AS s24,
SUM(bdown.s25) AS s25,
SUM(bdown.s26) AS s26,
SUM(bdown.s27) AS s27,
SUM(bdown.s28) AS s28,
SUM(bdown.s29) AS s29,
SUM(bdown.s30) AS s30,
SUM(bdown.s31) AS s31,
SUM(bdown.s32) AS s32,
SUM(bdown.s33) AS s33,
SUM(bdown.s34) AS s34,
SUM(bdown.s35) AS s35,
SUM(bdown.s36) AS s36,
SUM(bdown.s37) AS s37,
SUM(bdown.s38) AS s38,
SUM(bdown.s39) AS s39,
SUM(bdown.s40) AS s40
FROM bdown
LEFT OUTER JOIN ord ON ord.ordpk=bdown.ordpk
where  ord.ordpk='$ord' and bdown.country<>'' $and1 $and3 $and4 AND bdown.jenis='DETAIL' and bdown.tot>'0'
GROUP BY bdown.country order by bdown.country asc");
$entryc = array();
while ($row2c = mysqli_fetch_array($rs2c)){
	
if($row2c['s1']<1){ $s1c="0"; } else { $s1c=$row2c['s1']; }
if($row2c['s2']<1){ $s2c="0"; } else { $s2c=$row2c['s2']; }
if($row2c['s3']<1){ $s3c="0"; } else { $s3c=$row2c['s3']; }
if($row2c['s4']<1){ $s4c="0"; } else { $s4c=$row2c['s4']; }
if($row2c['s5']<1){ $s5c="0"; } else { $s5c=$row2c['s5']; }
if($row2c['s6']<1){ $s6c="0"; } else { $s6c=$row2c['s6']; }
if($row2c['s7']<1){ $s7c="0"; } else { $s7c=$row2c['s7']; }
if($row2c['s8']<1){ $s8c="0"; } else { $s8c=$row2c['s8']; }
if($row2c['s9']<1){ $s9c="0"; } else { $s9c=$row2c['s9']; }
if($row2c['s10']<1){ $s10c="0"; } else { $s10c=$row2c['s10']; }
if($row2c['s11']<1){ $s11c="0"; } else { $s11c=$row2c['s11']; }
if($row2c['s12']<1){ $s12c="0"; } else { $s12c=$row2c['s12']; }
if($row2c['s13']<1){ $s13c="0"; } else { $s13c=$row2c['s13']; }
if($row2c['s14']<1){ $s14c="0"; } else { $s14c=$row2c['s14']; }
if($row2c['s15']<1){ $s15c="0"; } else { $s15c=$row2c['s15']; }
if($row2c['s16']<1){ $s16c="0"; } else { $s16c=$row2c['s16']; }
if($row2c['s17']<1){ $s17c="0"; } else { $s17c=$row2c['s17']; }
if($row2c['s18']<1){ $s18c="0"; } else { $s18c=$row2c['s18']; }
if($row2c['s19']<1){ $s19c="0"; } else { $s19c=$row2c['s19']; }
if($row2c['s20']<1){ $s20c="0"; } else { $s20c=$row2c['s20']; }
// if($row2c['s21']<1){ $s21c="0"; } else { $s21c=$row2c['s21']; }
// if($row2c['s22']<1){ $s22c="0"; } else { $s22c=$row2c['s22']; }
// if($row2c['s23']<1){ $s23c="0"; } else { $s23c=$row2c['s23']; }
// if($row2c['s24']<1){ $s24c="0"; } else { $s24c=$row2c['s24']; }
// if($row2c['s25']<1){ $s25c="0"; } else { $s25c=$row2c['s25']; }
// if($row2c['s26']<1){ $s26c="0"; } else { $s26c=$row2c['s26']; }
// if($row2c['s27']<1){ $s27c="0"; } else { $s27c=$row2c['s27']; }
// if($row2c['s28']<1){ $s28c="0"; } else { $s28c=$row2c['s28']; }
// if($row2c['s29']<1){ $s29c="0"; } else { $s29c=$row2c['s29']; }
// if($row2c['s30']<1){ $s30c="0"; } else { $s30c=$row2c['s30']; }
// if($row2c['s31']<1){ $s31c="0"; } else { $s31c=$row2c['s31']; }
// if($row2c['s32']<1){ $s32c="0"; } else { $s32c=$row2c['s32']; }
// if($row2c['s33']<1){ $s33c="0"; } else { $s33c=$row2c['s33']; }
// if($row2c['s34']<1){ $s34c="0"; } else { $s34c=$row2c['s34']; }
// if($row2c['s35']<1){ $s35c="0"; } else { $s35c=$row2c['s35']; }
// if($row2c['s36']<1){ $s36c="0"; } else { $s36c=$row2c['s36']; }
// if($row2c['s37']<1){ $s37c="0"; } else { $s37c=$row2c['s37']; }
// if($row2c['s38']<1){ $s38c="0"; } else { $s38c=$row2c['s38']; }
// if($row2c['s39']<1){ $s39c="0"; } else { $s39c=$row2c['s39']; }
// if($row2c['s40']<1){ $s40c="0"; } else { $s40c=$row2c['s40']; }
$totalc=$s1c+$s2c+$s3c+$s4c+$s5c+$s6c+$s7c+$s8c+$s9c+$s10c+$s11c+$s12c+$s13c+$s14c+$s15c+
$s16c+$s17c+$s18c+$s19c+$s20c+$s21c+$s22c+$s23c+$s24c+$s25c+$s26c+$s27c+$s28c+$s29c+$s30c+
$s31c+$s32c+$s33c+$s34c+$s35c+$s36c+$s37c+$s38c+$s39c+$s40c;

//if($cari3=="Place"){$ftr=$row2['country'];}
//else if($cari3=="Color"){$ftr=$row2['color'];}
//else {$ftr=$row2['color'];}

$ftrc=$row2c['country'];
$entryc []  = array(
    'secsz'=>$ftrc,
    's1'=> $s1c,
    's2'=> $s2c,
    's3'=> $s3c,
    's4'=> $s4c,
    's5'=> $s5c,
    's6'=> $s6c,
    's7'=> $s7c,
    's8'=> $s8c,
    's9'=> $s9c,
    's10'=> $s10c,
	's11'=> $s11c,
    's12'=> $s12c,
    's13'=> $s13c,
    's14'=> $s14c,
    's15'=> $s15c,
    's16'=> $s16c,
    's17'=> $s17c,
    's18'=> $s18c,
    's19'=> $s19c,
    's20'=> $s20c,
    // 's21'=> $s21c,
    // 's22'=> $s22c,
    // 's23'=> $s23c,
    // 's24'=> $s24c,
    // 's25'=> $s25c,
    // 's26'=> $s26c,
    // 's27'=> $s27c,
    // 's28'=> $s28c,
    // 's29'=> $s29c,
    // 's30'=> $s30c,
    // 's31'=> $s31c,
    // 's32'=> $s32c,
    // 's33'=> $s33c,
    // 's34'=> $s34c,
    // 's35'=> $s35c,
    // 's36'=> $s36c,
    // 's37'=> $s37c,
    // 's38'=> $s38c,
    // 's39'=> $s39c,
    // 's40'=> $s40c,
	'tot'=> "<b>".$totalc."<b>");

/*$cr=mysqli_query($koneksi,"select * from bdown where ordpk='$ord' and sumby='country' and sumdata='$ftrc' and jenis='FOOTER1'");
$dt=mysqli_fetch_array($cr);
$bdownpk=$dt['bdownpk'];
$cr1=mysqli_query($koneksi,"select * from bdown where ordpk='$ord' and jenis='DETAIL' order by nour desc limit 1");
$dt1=mysqli_fetch_array($cr1);
$nour=$dt1['nour']+1;
if($bdownpk>0){
$update=mysqli_query($koneksi,"update bdown set
nour='$nour',
s1='$s1c',
s2='$s2c',
s3='$s3c',
s4='$s4c',
s5='$s5c',
s6='$s6c',
s7='$s7c',
s8='$s8c',
s9='$s9c',
s10='$s10c',
s11='$s11c',
s12='$s12c',
s13='$s13c',
s14='$s14c',
s15='$s15c',
tot='$totalc' where bdownpk='$bdownpk'");
} else {
$update=mysqli_query($koneksi,"insert into bdown set
nour='$nour',
s1='$s1c',
s2='$s2c',
s3='$s3c',
s4='$s4c',
s5='$s5c',
s6='$s6c',
s7='$s7c',
s8='$s8c',
s9='$s9c',
s10='$s10c',
s11='$s11c',
s12='$s12c',
s13='$s13c',
s14='$s14c',
s15='$s15c',
tot='$totalc',
ordpk='$ord',
sumby='country',
sumdata='$ftrc',
jenis='FOOTER1'");  
}*/
}

$rs2d = mysqli_query($koneksi,"SELECT bdown.secsz, bdown.country, ord.ordpk, 
SUM(bdown.s1) AS s1,
SUM(bdown.s2) AS s2,
SUM(bdown.s3) AS s3,
SUM(bdown.s4) AS s4,
SUM(bdown.s5) AS s5,
SUM(bdown.s6) AS s6,
SUM(bdown.s7) AS s7,
SUM(bdown.s8) AS s8,
SUM(bdown.s9) AS s9,
SUM(bdown.s10) AS s10,
SUM(bdown.s11) AS s11,
SUM(bdown.s12) AS s12,
SUM(bdown.s13) AS s13,
SUM(bdown.s14) AS s14,
SUM(bdown.s15) AS s15,
SUM(bdown.s16) AS s16,
SUM(bdown.s17) AS s17,
SUM(bdown.s18) AS s18,
SUM(bdown.s19) AS s19,
SUM(bdown.s20) AS s20,
SUM(bdown.s21) AS s21,
SUM(bdown.s22) AS s22,
SUM(bdown.s23) AS s23,
SUM(bdown.s24) AS s24,
SUM(bdown.s25) AS s25,
SUM(bdown.s26) AS s26,
SUM(bdown.s27) AS s27,
SUM(bdown.s28) AS s28,
SUM(bdown.s29) AS s29,
SUM(bdown.s30) AS s30,
SUM(bdown.s31) AS s31,
SUM(bdown.s32) AS s32,
SUM(bdown.s33) AS s33,
SUM(bdown.s34) AS s34,
SUM(bdown.s35) AS s35,
SUM(bdown.s36) AS s36,
SUM(bdown.s37) AS s37,
SUM(bdown.s38) AS s38,
SUM(bdown.s39) AS s39,
SUM(bdown.s40) AS s40
FROM bdown
LEFT OUTER JOIN ord ON ord.ordpk=bdown.ordpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and bdown.secsz<>'' and bdown.color<>'' $and1 $and3 $and4 AND bdown.jenis='DETAIL' and bdown.tot>'0'
GROUP BY bdown.secsz order by bdown.secsz asc");
$entryd = array();
while ($row2d = mysqli_fetch_array($rs2d)){
	
if($row2d['s1']<1){ $s1="0"; } else { $s1=$row2d['s1']; }
if($row2d['s2']<1){ $s2="0"; } else { $s2=$row2d['s2']; }
if($row2d['s3']<1){ $s3="0"; } else { $s3=$row2d['s3']; }
if($row2d['s4']<1){ $s4="0"; } else { $s4=$row2d['s4']; }
if($row2d['s5']<1){ $s5="0"; } else { $s5=$row2d['s5']; }
if($row2d['s6']<1){ $s6="0"; } else { $s6=$row2d['s6']; }
if($row2d['s7']<1){ $s7="0"; } else { $s7=$row2d['s7']; }
if($row2d['s8']<1){ $s8="0"; } else { $s8=$row2d['s8']; }
if($row2d['s9']<1){ $s9="0"; } else { $s9=$row2d['s9']; }
if($row2d['s10']<1){ $s10="0"; } else { $s10=$row2d['s10']; }
if($row2d['s11']<1){ $s11="0"; } else { $s11=$row2d['s11']; }
if($row2d['s12']<1){ $s12="0"; } else { $s12=$row2d['s12']; }
if($row2d['s13']<1){ $s13="0"; } else { $s13=$row2d['s13']; }
if($row2d['s14']<1){ $s14="0"; } else { $s14=$row2d['s14']; }
if($row2d['s15']<1){ $s15="0"; } else { $s15=$row2d['s15']; }
if($row2d['s16']<1){ $s16="0"; } else { $s16=$row2d['s16']; }
if($row2d['s17']<1){ $s17="0"; } else { $s17=$row2d['s17']; }
if($row2d['s18']<1){ $s18="0"; } else { $s18=$row2d['s18']; }
if($row2d['s19']<1){ $s19="0"; } else { $s19=$row2d['s19']; }
if($row2d['s20']<1){ $s20="0"; } else { $s20=$row2d['s20']; }
// if($row2d['s21']<1){ $s21="0"; } else { $s21=$row2d['s21']; }
// if($row2d['s22']<1){ $s22="0"; } else { $s22=$row2d['s22']; }
// if($row2d['s23']<1){ $s23="0"; } else { $s23=$row2d['s23']; }
// if($row2d['s24']<1){ $s24="0"; } else { $s24=$row2d['s24']; }
// if($row2d['s25']<1){ $s25="0"; } else { $s25=$row2d['s25']; }
// if($row2d['s26']<1){ $s26="0"; } else { $s26=$row2d['s26']; }
// if($row2d['s27']<1){ $s27="0"; } else { $s27=$row2d['s27']; }
// if($row2d['s28']<1){ $s28="0"; } else { $s28=$row2d['s28']; }
// if($row2d['s29']<1){ $s29="0"; } else { $s29=$row2d['s29']; }
// if($row2d['s30']<1){ $s30="0"; } else { $s30=$row2d['s30']; }
// if($row2d['s31']<1){ $s31="0"; } else { $s31=$row2d['s31']; }
// if($row2d['s32']<1){ $s32="0"; } else { $s32=$row2d['s32']; }
// if($row2d['s33']<1){ $s33="0"; } else { $s33=$row2d['s33']; }
// if($row2d['s34']<1){ $s34="0"; } else { $s34=$row2d['s34']; }
// if($row2d['s35']<1){ $s35="0"; } else { $s35=$row2d['s35']; }
// if($row2d['s36']<1){ $s36="0"; } else { $s36=$row2d['s36']; }
// if($row2d['s37']<1){ $s37="0"; } else { $s37=$row2d['s37']; }
// if($row2d['s38']<1){ $s38="0"; } else { $s38=$row2d['s38']; }
// if($row2d['s39']<1){ $s39="0"; } else { $s39=$row2d['s39']; }
// if($row2d['s40']<1){ $s40="0"; } else { $s40=$row2d['s40']; }
if($row2d['tot']<1){ $tot="0"; } else { $tot=$row2d['tot']; } 
$total=$s1+$s2+$s3+$s4+$s5+$s6+$s7+$s8+$s9+$s10+$s11+$s12+$s13+$s14+$s15+
$s16+$s17+$s18+$s19+$s20+$s21+$s22+$s23+$s24+$s25+$s26+$s27+$s28+$s29+$s30+
$s31+$s32+$s33+$s34+$s35+$s36+$s37+$s38+$s39+$s40;

//if($cari3=="Place"){$ftr=$row2['country'];}
//else if($cari3=="Color"){$ftr=$row2['color'];}
//else {$ftr=$row2['color'];}

$ftr=$row2d['secsz'];
$entryd []  = array(
    'secsz'=>$ftr,
    's1'=> $s1,
    's2'=> $s2,
    's3'=> $s3,
    's4'=> $s4,
    's5'=> $s5,
    's6'=> $s6,
    's7'=> $s7,
    's8'=> $s8,
    's9'=> $s9,
    's10'=> $s10,
	's11'=> $s11,
    's12'=> $s12,
    's13'=> $s13,
    's14'=> $s14,
    's15'=> $s15,
    's16'=>$s16,
    's17'=>$s17,
    's18'=>$s18,
    's19'=>$s19,
    's20'=>$s20,
    // 's21'=>$s21,
    // 's22'=>$s22,
    // 's23'=>$s23,
    // 's24'=>$s24,
    // 's25'=>$s25,
    // 's26'=>$s26,
    // 's27'=>$s27,
    // 's28'=>$s28,
    // 's29'=>$s29,
    // 's30'=>$s30,
    // 's31'=>$s31,
    // 's32'=>$s32,
    // 's33'=>$s33,
    // 's34'=>$s34,
    // 's35'=>$s35,
    // 's36'=>$s36,
    // 's37'=>$s37,
    // 's38'=>$s38,
    // 's39'=>$s39,
    // 's40'=>$s40,
	'tot'=> "<b>".$total."<b>");
}

if($entryd && $entryc){
$footer=array_merge($entry,$entryb,$entryc,$entryb,$entryd,$entryb);
} else if($entryd) {
$footer=array_merge($entry,$entryb,$entryd,$entryb);
} else if($entryc) {
$footer=array_merge($entry,$entryb,$entryc,$entryb);
} else {
$footer=array_merge($entry,$entryb);    
}
/*$atas=array_merge($header,$row);*/

$result=array_merge($result,array('rows'=>$row),array('footer'=>$footer));
echo json_encode($result);
?>
