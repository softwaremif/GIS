<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/truncate.php";
$thn=DATE('Y');
$thn2=$thn-2;
$thn2b=$thn2-2000;

$bln=date("m");
$thn=date("Y");

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
$cari5 = isset($_POST['cari5']) ? ($_POST['cari5']) : false;
$cari6 = isset($_POST['cari6']) ? ($_POST['cari6']) : false;
$cari7 = isset($_POST['cari7']) ? ($_POST['cari7']) : false;
$cari8 = isset($_POST['cari8']) ? ($_POST['cari8']) : false;
$cari9 = isset($_POST['cari9']) ? ($_POST['cari9']) : false;
$cari10 = isset($_POST['cari10']) ? ($_POST['cari10']) : false;
$cari11 = isset($_POST['cari11']) ? ($_POST['cari11']) : false;
$carispl = isset($_POST['carispl']) ? ($_POST['carispl']) : false;
$ord = isset($_GET['ord']) ? ($_GET['ord']) : false;

if($_SESSION['mat']==1) { $and3="and rpo.kelnm='CUTTING'"; }
else { $and3="and rpo.kelnm<>'CUTTING'"; }

/*if($cari2>0){ $and2="and fu.fupk='$cari2'"; }

if($cari5>0){ $and4="and MONTH(rpo.tgl)='$cari5'"; }
else { $and4="and MONTH(rpo.tgl)='$bln'"; }

if($cari6>0){ $and5="and YEAR(rpo.tgl)='$cari6'"; }
else { $and5="and YEAR(rpo.tgl)='$thn'"; }*/

$and5="and YEAR(rpo.tgl)='$thn'";
$and5b="and YEAR(po.tglpo)='$thn'";


if($_GET['dt']=="byr"){
$thna=$_GET['thn'];
if($thna>0){
    $anda="and YEAR(ord.datecreate)>='$thna'";
}else{
    $anda="";
}

$rs = mysqli_query($koneksi,"select byr.byrpk, byr.byrnm, ord.season
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.fupk='$_SESSION[fu]' and ord.byrpk>0 and byr.byrnm like '%$carispl%' $anda
group by byr.byrpk order by byr.byrnm desc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//$ck2="<input type='checkbox' class='combobox-checkbox' name='chek' id='chekbyr$i' value='$data[byrnm]'>$i";
$row[] = array(
'byrpk'=>$data['byrpk'],
'byrnm'=>$data['byrnm'],
//'ck2'=>$ck2,
'byrnm2'=>truncate(TRIM($data['byrnm']),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="byr2"){
$rs = mysqli_query($koneksi,"select byr.byrpk, byr.byrnm, ord.season
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.byrpk>0 and byr.byrnm like '%$carispl%' and YEAR(ord.datecreate)>='$thn2'
group by byr.byrpk order by byr.byrnm desc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//$ck2="<input type='checkbox' class='combobox-checkbox' name='chek' id='chekbyr$i' value='$data[byrnm]'>$i";
$row[] = array(
'byrpk'=>$data['byrpk'],
'byrnm'=>$data['byrnm'],
//'ck2'=>$ck2,
'byrnm2'=>truncate(TRIM($data['byrnm']),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="prodes"){

$thna=$_GET['thn'];
if($thna>0){
    $anda="and YEAR(ord.datecreate)>='$thna'";
}else{
    $anda="";
}

$rs = mysqli_query($koneksi,"select byr.byrpk, byr.byrnm, ord.season, ord.prodes, ord.ordpk
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.fupk='$_SESSION[fu]' and ord.byrpk>0 and ord.prodes like '%$carispl%' $anda
and ord.prodes<>''
group by ord.prodes order by ord.prodes desc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//$ck="<input type='checkbox' name='chek' onclick='Searchprodes$i();' id='chekprodes$i' value='$data[prodes]' >";
$row[] = array(
'ordpk'=>$data['ordpk'],
'prodes'=>TRIM($data['prodes']),
'prodes2'=>truncate(TRIM($data['prodes']),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="prodes2"){
$rs = mysqli_query($koneksi,"select byr.byrpk, byr.byrnm, ord.season, ord.prodes, ord.ordpk
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.byrpk>0 and ord.prodes like '%$carispl%' and YEAR(ord.datecreate)>='$thn2'
and ord.prodes<>''
group by ord.prodes order by ord.prodes desc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//$ck="<input type='checkbox' name='chek' onclick='Searchprodes$i();' id='chekprodes$i' value='$data[prodes]' >";
$row[] = array(
'ordpk'=>$data['ordpk'],
'prodes'=>TRIM($data['prodes']),
'prodes2'=>truncate(TRIM($data['prodes']),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="season"){

$thna=$_GET['thn'];
if($thna>0){
    $anda="and YEAR(ord.datecreate)>='$thna'";
}else{
    $anda="";
}

$rs = mysqli_query($koneksi,"select ord.season, ord.ordpk
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.fupk='$_SESSION[fu]' and ord.byrpk>0 and ord.season<>'' and  ord.season like '%$carispl%' $anda
group by ord.season order by ord.season desc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'ordpk'=>$data['ordpk'],
'season'=>TRIM($data['season']),
'season2'=>truncate(TRIM($data['season']),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="season2"){
$rs = mysqli_query($koneksi,"select ord.season, ord.ordpk
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.byrpk>0 and ord.season<>'' and  ord.season like '%$carispl%' and YEAR(ord.datecreate)>='$thn2'
group by ord.season order by ord.season desc  LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'ordpk'=>$data['ordpk'],
'season'=>TRIM($data['season']),
'season2'=>truncate(TRIM($data['season']),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="supp"){
    
if($_SESSION['mat']==1) { $and3="and rpo.kelnm='CUTTING'"; }
else { $and3="and rpo.kelnm<>'CUTTING'"; }

$thna=$_GET['thn'];
if($thna>0){
    $anda="and YEAR(rpo.tgl)='$thna'";
}else{
    $anda="";
}

$kelnm=$_GET['kelnm'];
if($kelnm<>""){
    $andb="AND rpo.kelnm LIKE'%$kelnm%'";
}else{
    $andb="";
}

$rs = mysqli_query($koneksi,"SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join sup on sup.suppk=rpo.suppk
left outer join cur on  cur.curpk=rpo.curpk
WHERE rpo.stspk='1' and sup.supnm like '%$carispl%' and sup.supnm<>'' and sup.local>0 and sup.aktif='0'
and ord.fupk<>'' and rpo.popros='0' and rpo.popk='0' and rpo.rkbpk<>'' and rpo.item<>'' $and3 $anda $andb
GROUP BY TRIM(sup.supnm) ORDER BY rpo.tgl desc LIMIT 2");
$result = array();

$row = array();
$i=-1;
while($data=mysqli_fetch_array($rs)){
$i++;
$ck="<input type='checkbox' name='cek' onclick='Searchsupp();' id='cek' value='$i' >$i";
$row[] = array(
//'ck'=>$ck,
'rpopk'=>$data['rpopk'],
'supnm'=>TRIM($data['supnm']),
'supnm2'=>truncate(TRIM($data['supnm']),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="color"){
    $thna=$_GET['thn'];
    if($thna>0){
        $anda="and YEAR(rpo.tgl)='$thna'";
    }else{
        $anda="";
    }
$kelnm=$_GET['kelnm'];
if($kelnm<>""){
    $andb="AND rpo.kelnm LIKE '%$kelnm%'";
}else{
    $andb="";
}
$rs = mysqli_query($koneksi,"SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join sup on sup.suppk=rpo.suppk
left outer join cur on  cur.curpk=rpo.curpk
WHERE rpo.stspk='1' and rpo.popros='0' and rpo.popk='0' and rpo.colname like '%$carispl%' and rpo.colname<>'' and ord.fupk<>'' and rpo.rkbpk<>'' and rpo.item<>'' $and3 $anda $andb
GROUP BY rpo.colname ORDER BY rpo.tgl desc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'rpopk'=>$data['rpopk'],
'colname'=>TRIM($data['colname']),
'colname2'=>truncate(TRIM($data['colname']),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="specb"){
$thna=$_GET['thn']; 
if($thna>0){
    $anda="and YEAR(rpo.tgl)='$thna'";
}else{
    $anda="";
}
$kelnm=$_GET['kelnm'];
if($kelnm<>""){
    $andb="AND rpo.kelnm LIKE '%$kelnm%'";
}else{
    $andb="";
}
$rs = mysqli_query($koneksi,"SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join sup on sup.suppk=rpo.suppk
left outer join cur on  cur.curpk=rpo.curpk
WHERE rpo.stspk='1' and rpo.popros='0' and rpo.popk='0' and rpo.spec like '%$carispl%' and rpo.spec<>'' and ord.fupk<>'' and rpo.rkbpk<>'' and rpo.item<>'' $and3 $anda $andb
GROUP BY rpo.spec ORDER BY rpo.tgl desc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'rpopk'=>$data['rpopk'],
'spec'=>TRIM($data['spec']),
'spec2'=>truncate(TRIM($data['spec']),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="wait1"){
/*if($carispl=="Awaiting PI"){$postatpk="and po.postatpk='1'";}
else if($carispl=="In Revision"){$postatpk="and po.postatpk='2'";}
else if($carispl=="PO Cancel"){$postatpk="and po.postatpk='3'";}
else if($carispl=="Purchased"){$postatpk="and po.postatpk='4'";}
else { $postatpk=""; }
$rs = mysqli_query($koneksi,"SELECT po.popk, po.postatpk
FROM po
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=po.curpk
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
WHERE po.pur='$_SESSION[login]' and po.postatpk>='1' and rkb.status>='3' $postatpk $and5b
group by po.postatpk order by po.postatpk asc LIMIT 3");*/

if($carispl=="Awaiting PI"){$postatpk="where postatpk='1'";}
else if($carispl=="In Revision"){$postatpk="where postatpk='2'";}
else if($carispl=="PO Cancel"){$postatpk="where postatpk='3'";}
else if($carispl=="Purchased"){$postatpk="where postatpk='4'";}
else { $postatpk=""; }

$rs = mysqli_query($koneksi,"SELECT * FROM postat
$postatpk
order by postatpk asc LIMIT 3");
$result = array();

$row = array();
$i=-1;
while($data=mysqli_fetch_array($rs)){
$i++;
if($data['postatpk']==1){ $sts="Awaiting PI"; }
else if($data['postatpk']==2){ $sts="In Revision"; }
else if($data['postatpk']==3){ $sts="PO Cancel"; }
else if($data['postatpk']==4){ $sts="Purchased"; }
else { $sts="Awaiting PI"; }
$ck="<input type='checkbox' name='cek' onclick='cek($i);' id='cek$i' value='1'>";
$row[] = array(
'no'=>$i,
//'ck'=>$ck,
//'popk'=>$data['popk'],
'postatpk'=>$data['postatpk'],
'status'=>TRIM($sts),
'status2'=>truncate(TRIM($sts),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="wait2"){
$thna=$_GET['thn'];
if($thna>0){
    $anda="AND YEAR(po.tglpo)='$thna'";
}else{
    $anda="AND YEAR(po.tglpo)='$thn'";
}
$rs = mysqli_query($koneksi,"SELECT po.popk, sup.supnm
FROM po
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=po.curpk
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
WHERE po.pur='$_SESSION[login]' and po.postatpk between '1' and '3' and rkb.status between '3' and '6' and po.ck<='1' and sup.supnm<>'' and sup.supnm LIKE '%$carispl%' $anda
group by sup.supnm order by po.tglpo desc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'popk'=>$data['popk'],
'supnm'=>TRIM($data['supnm']),
'supnm2'=>truncate(TRIM($data['supnm']),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="wait3"){
    $thna=$_GET['thn'];
    if($thna>0){
        $anda="AND YEAR(po.tglpo)='$thna'";
    }else{
        $anda="AND YEAR(po.tglpo)='$thn'";
    }
$rs = mysqli_query($koneksi,"SELECT po.popk, podt.colname
FROM po
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=po.curpk
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
WHERE po.pur='$_SESSION[login]' and po.postatpk between '1' and '3' and rkb.status between '3' and '6' and po.ck<='1' and podt.colname<>'' and podt.colname LIKE '%$carispl%' $anda
group by podt.colname order by po.tglpo desc LIMIT 2 ");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'popk'=>$data['popk'],
'colname'=>TRIM($data['colname']),
'colname2'=>truncate(TRIM($data['colname']),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="mat1"){
$rs = mysqli_query($koneksi,"select rkb.rkbpk, rkb.kelnm
FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.kelnm<>'' and rkb.spec<>'' 
and rkb.status<=3 and rkb.kelnm LIKE '%$carispl%' and YEAR(ord.datecreate)>='$thn2'
group by rkb.kelnm order by rkb.kelnm asc LIMIT 4");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
$kelnm=TRIM($data['kelnm']);
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'rkbpk'=>$data['rkbpk'],
'kelnm'=>TRIM($kelnm),
'kelnm2'=>truncate(TRIM($data['kelnm']),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="mat1b"){
$rs = mysqli_query($koneksi,"select rkb.rkbpk, rkb.kelnm
FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.kelnm<>'' and rkb.spec<>'' and rkb.status<=3 and rkb.kelnm LIKE '%$carispl%' and YEAR(ord.datecreate)>='$thn2'
group by rkb.kelnm order by rkb.kelnm asc LIMIT 3");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
$kelnm=TRIM($data['kelnm']);
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'rkbpk'=>$data['rkbpk'],
'kelnm'=>TRIM($kelnm),
'kelnm2'=>truncate(TRIM($data['kelnm']),15));
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="mat2"){
$rs = mysqli_query($koneksi,"select rkb.rkbpk, rkb.spec
FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.spec<>'' and rkb.spec LIKE '%$carispl%'
group by rkb.spec order by rkb.spec asc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
$kelnm=TRIM($data['kelnm']);
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'rkbpk'=>$data['rkbpk'],
'spec'=>TRIM($data['spec']),
'spec2'=>truncate(TRIM($data['spec']),15));    
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="mat2b"){
$rs = mysqli_query($koneksi,"select rkb.rkbpk, rkb.spec
FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.ordpk='$ord' and rkb.spec<>'' and rkb.spec LIKE '%$carispl%'
group by rkb.spec order by rkb.spec asc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
$kelnm=TRIM($data['kelnm']);
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'rkbpk'=>$data['rkbpk'],
'spec'=>TRIM($data['spec']),
'spec2'=>truncate(TRIM($data['spec']),15));    
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="mat3"){
$rs = mysqli_query($koneksi,"select rkb.rkbpk, rkb.colname
FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.colname<>'' and rkb.colname LIKE '%$carispl%'
group by rkb.colname order by rkb.colname asc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
$kelnm=TRIM($data['kelnm']);
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'rkbpk'=>$data['rkbpk'],
'colname'=>TRIM($data['colname']),
'colname2'=>truncate(TRIM($data['colname']),15));     
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="mat3b"){
$rs = mysqli_query($koneksi,"select rkb.rkbpk, rkb.colname
FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.ordpk='$ord' and rkb.colname<>'' and rkb.colname LIKE '%$carispl%'
group by rkb.colname order by rkb.colname asc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
$kelnm=TRIM($data['kelnm']);
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'rkbpk'=>$data['rkbpk'],
'colname'=>TRIM($data['colname']),
'colname2'=>truncate(TRIM($data['colname']),15));     
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="pur1"){
    $thna=$_GET['thn'];
    if($thna>0){
        $anda="AND YEAR(po.tglpo)='$thna'";
    }else{
        $anda="AND YEAR(po.tglpo)='$thn'";
    }
$rs = mysqli_query($koneksi,"SELECT po.popk, po.brg
FROM po
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=po.curpk
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
WHERE po.pur='$_SESSION[login]' and po.postatpk='4' and rkb.status='6' and po.brg<>'' and po.brg LIKE '%$carispl%' $anda
group by po.brg order by po.tglpo desc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
$kelnm=TRIM($data['kelnm']);
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'popk'=>$data['popk'],
'brg'=>TRIM($data['brg']),
'brg2'=>truncate(TRIM($data['brg']),15));    
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="pur1b"){
$rs = mysqli_query($koneksi,"SELECT po.popk, po.brg
FROM po
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=po.curpk
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
WHERE po.postatpk between '1' and '4' and rkb.status between '3' and '6' and po.brg<>'' and po.brg LIKE '%$carispl%' $and5b
group by po.popk, po.brg order by po.tglpo desc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
$kelnm=TRIM($data['kelnm']);
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'popk'=>$data['popk'],
'brg'=>TRIM($data['brg']),
'brg2'=>truncate(TRIM($data['brg']),15));    
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="pur2"){
    $thna=$_GET['thn'];
if($thna>0){
    $anda="AND YEAR(po.tglpo)='$thna'";
}else{
    $anda="AND YEAR(po.tglpo)='$thn'";
}
$rs = mysqli_query($koneksi,"SELECT po.popk, sup.supnm
FROM po
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=po.curpk
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
WHERE po.pur='$_SESSION[login]' and po.postatpk='4' and rkb.status='6' and sup.supnm<>'' and sup.supnm LIKE '%$carispl%' $anda
group by sup.supnm order by po.tglpo desc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
$kelnm=TRIM($data['kelnm']);
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'popk'=>$data['popk'],
'supnm'=>TRIM($data['supnm']),
'supnm2'=>truncate(TRIM($data['supnm']),15));     
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="pur2b"){
    $thna=$_GET['thn'];
if($thna>0){
    $anda="AND YEAR(po.tglpo)='$thna'";
}else{
    $anda="AND YEAR(po.tglpo)='$thn'";
}
$rs = mysqli_query($koneksi,"SELECT po.popk, sup.supnm
FROM po
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=po.curpk
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
WHERE po.postatpk between '1' and '4' and rkb.status between '3' and '6' and sup.supnm<>'' and sup.supnm LIKE '%$carispl%' $and5b
group by po.popk, sup.suppk  order by po.tglpo desc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
$kelnm=TRIM($data['kelnm']);
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'popk'=>$data['popk'],
'supnm'=>TRIM($data['supnm']),
'supnm2'=>truncate(TRIM($data['supnm']),15));     
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="pur3"){
    $thna=$_GET['thn'];
if($thna>0){
    $anda="AND YEAR(po.tglpo)='$thna'";
}else{
    $anda="AND YEAR(po.tglpo)='$thn'";
}
$rs = mysqli_query($koneksi,"SELECT po.popk, podt.colname
FROM po
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=po.curpk
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
WHERE po.pur='$_SESSION[login]' and po.postatpk='4' and rkb.status='6' and podt.colname<>'' and podt.colname LIKE '%$carispl%' $anda
group by podt.colname order by po.tglpo desc LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
$kelnm=TRIM($data['kelnm']);
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'popk'=>$data['popk'],
'colname'=>TRIM($data['colname']),
'colname2'=>truncate(TRIM($data['colname']),15));     
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
} if($_GET['dt']=="pur3b"){
$rs = mysqli_query($koneksi,"SELECT po.popk, podt.colname
FROM po
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=po.curpk
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
WHERE po.postatpk between '1' and '4' and rkb.status between '3' and '6' and podt.colname<>'' and podt.colname LIKE '%$carispl%' $and5b
group by po.popk, podt.colname LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
$kelnm=TRIM($data['kelnm']);
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'popk'=>$data['popk'],
'colname'=>TRIM($data['colname']),
'colname2'=>truncate(TRIM($data['colname']),15));     
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="purcashing1"){
$rs = mysqli_query($koneksi,"select rkb.ordpk, ord.ordno, rkb.suppk, sup.supnm, rkb.rkbpk, rkb.nour, rkb.item,
rkb.itemadd, rkb.spec, rkb.specadd, rkb.tspec, rkb.hspec1, rkb.hspec2, rkb.hspec3, rkb.hspec4, rkb.hspec5,
rkb.hspec6, rkb.hspec7, rkb.hspec8, rkb.spec1, rkb.spec2, rkb.spec3, rkb.spec5, rkb.spec6, rkb.spec7, rkb.spec8,
rkb.sizegar, rkb.unit, rkb.colname, rkb.colcode, rkb.price, rkb.curpk, cur.curid, rkb.kelnm, rkb.bdownqty,
rkb.kolom, rkb.bdownpk, rkb.allowcons, rkb.negocons, rkb.estcons, rkb.varcons, rkb.totcons, rkb.qrs, rkb.pocons,
rkb.poreqdel, rkb.podel, rkb.status, rkb.stspk, rkb.allowman, rkb.popk, po.postatpk, po.pono, rkb.piqty,
rkb.piprice, po.piform, po.pidate, po.tgldel, po.etd, rpo.tgljam
FROM rkb
left outer join rpo on rpo.rkbpk=rkb.rkbpk
left outer join po on po.popk=rkb.popk
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.status>=3 and rkb.item like '%$carispl%' and rkb.item<>''
group by rkb.item
order by rkb.rkbpk DESC LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'rkbpk'=>$data['rkbpk'],
'item'=>TRIM($data['item']),
'spec'=>truncate(TRIM($data['item']),15));     
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="purcashing2"){
$rs = mysqli_query($koneksi,"select rkb.ordpk, ord.ordno, rkb.suppk, sup.supnm, rkb.rkbpk, rkb.nour, rkb.item,
rkb.itemadd, rkb.spec, rkb.specadd, rkb.tspec, rkb.hspec1, rkb.hspec2, rkb.hspec3, rkb.hspec4, rkb.hspec5,
rkb.hspec6, rkb.hspec7, rkb.hspec8, rkb.spec1, rkb.spec2, rkb.spec3, rkb.spec5, rkb.spec6, rkb.spec7, rkb.spec8,
rkb.sizegar, rkb.unit, rkb.colname, rkb.colcode, rkb.price, rkb.curpk, cur.curid, rkb.kelnm, rkb.bdownqty,
rkb.kolom, rkb.bdownpk, rkb.allowcons, rkb.negocons, rkb.estcons, rkb.varcons, rkb.totcons, rkb.qrs, rkb.pocons,
rkb.poreqdel, rkb.podel, rkb.status, rkb.stspk, rkb.allowman, rkb.popk, po.postatpk, po.pono, rkb.piqty,
rkb.piprice, po.piform, po.pidate, po.tgldel, po.etd, rpo.tgljam
FROM rkb
left outer join rpo on rpo.rkbpk=rkb.rkbpk
left outer join po on po.popk=rkb.popk
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.status>=3 and rkb.spec like '%$carispl%' and rkb.spec<>''
group by rkb.spec
order by rkb.rkbpk DESC LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'rkbpk'=>$data['rkbpk'],
'item'=>TRIM($data['item']),
'spec'=>TRIM($data['spec']),
'colname'=>TRIM($data['colname']));     
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
if($_GET['dt']=="purcashing3"){
$rs = mysqli_query($koneksi,"select rkb.ordpk, ord.ordno, rkb.suppk, sup.supnm, rkb.rkbpk, rkb.nour, rkb.item,
rkb.itemadd, rkb.spec, rkb.specadd, rkb.tspec, rkb.hspec1, rkb.hspec2, rkb.hspec3, rkb.hspec4, rkb.hspec5,
rkb.hspec6, rkb.hspec7, rkb.hspec8, rkb.spec1, rkb.spec2, rkb.spec3, rkb.spec5, rkb.spec6, rkb.spec7, rkb.spec8,
rkb.sizegar, rkb.unit, rkb.colname, rkb.colcode, rkb.price, rkb.curpk, cur.curid, rkb.kelnm, rkb.bdownqty,
rkb.kolom, rkb.bdownpk, rkb.allowcons, rkb.negocons, rkb.estcons, rkb.varcons, rkb.totcons, rkb.qrs, rkb.pocons,
rkb.poreqdel, rkb.podel, rkb.status, rkb.stspk, rkb.allowman, rkb.popk, po.postatpk, po.pono, rkb.piqty,
rkb.piprice, po.piform, po.pidate, po.tgldel, po.etd, rpo.tgljam
FROM rkb
left outer join rpo on rpo.rkbpk=rkb.rkbpk
left outer join po on po.popk=rkb.popk
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.status>=3 and rkb.colname like '%$carispl%' and rkb.colname<>''
group by rkb.colname
order by rkb.rkbpk DESC LIMIT 2");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//$ck="<input type='checkbox' name='chek' onclick='Searchseason$i();' id='chekseason$i' value='$data[season]' >";
$row[] = array(
'rkbpk'=>$data['rkbpk'],
'item'=>TRIM($data['item']),
'spec'=>TRIM($data['spec']),
'colname'=>TRIM($data['colname']),
'spec2'=>truncate(TRIM($data['item']),15));     
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
}
?>