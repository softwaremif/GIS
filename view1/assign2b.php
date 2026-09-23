<?php
session_start();
include "../config/koneksi.php";
include "../config/tanggal2.php";
include "../config/ip.php";

$ip=ip();
$browser=browser();
$sistem=$_SERVER['HTTP_USER_AGENT'];
$userlog=$_SESSION['login'];

$date=date("Y-m-d");
$next=date("Y-m-d", strtotime("+1 days", strtotime($date)));
$next2=date("Y-m-d", strtotime("+2 days", strtotime($date)));
$next3=date("Y-m-d", strtotime("+6 month", strtotime($date)));

$thn=date("Y");

if($_GET['cari1']==1){
$by1=",rpo.item";
//$and1="and rpo.item='$item'";
//$and1b="and brg='$item'";
}

if($_GET['cari2']==1){
$by2=",rpo.colname";
//$and2="and rpo.colname='$colname'";
//$and2b="and warna='$colname'"; 
}

$cr1=mysqli_query($koneksi,"select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$_POST[user]'");
$dt1=mysqli_fetch_array($cr1);

if($dt1['spv']==1){ $and="and ord.fupk='$dt1[fupk]'"; $andd="and po.fu='$dt1[funm]'"; $fu=$dt1['funm']; }
else { $and="and ord.userpk='$dt1[userpk]'"; $andd="and po.fu='$dt1[funm]'"; $fu=$dt1['funm']; }
    
$cr=mysqli_query($koneksi,"SELECT * FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
WHERE po.pur is null  and po.ck='0' and podt.stspk='1' and YEAR(po.tglpo)='$_GET[thn]' $and $andd");
while($dt=mysqli_fetch_array($cr)){
$updt=mysqli_query($koneksi,"update rpo set stspk='1', popros='1', popk='0' where rkbpk='$dt[rkbpk]'");
$updt2=mysqli_query($koneksi,"update rkb set stspk='1', popk=NULL where rkbpk='$dt[rkbpk]'");
$del1=mysqli_query($koneksi,"delete from podt where popk='$dt[popk]'");    
$del2=mysqli_query($koneksi,"delete from po where popk='$dt[popk]'");   
}
    
$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
WHERE rpo.popros='1' and rpo.stspk='1' and rpo.popk='0' and YEAR(rpo.tgl)='$_GET[thn]' $and"));
if($row>0){
$cr2=mysqli_query($koneksi,"SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
left outer join sup on sup.suppk=rpo.suppk
WHERE rpo.popros='1' and rpo.stspk='1' and rpo.popk='0' and YEAR(rpo.tgl)='$_GET[thn]' $and group by rpo.suppk $by1 $by2");
while($dt2=mysqli_fetch_array($cr2)){
if($dt2['local']==2){ $polipk='2'; }
else { $polipk='1'; }

$dt2a = mysqli_fetch_array(mysqli_query($koneksi,"SELECT popk FROM po order by popk desc limit 1"));
$dt2b = mysqli_fetch_array(mysqli_query($koneksi,"SELECT pono FROM po WHERE polipk='$polipk' order by popk desc limit 1"));
$popk=$dt2a['popk']+1;
$lokal=substr($dt2b['pono'],3,5)+1;
$lokal2=substr($dt2b['pono'],3,5)+2;
if($dt2['local']==2){ $pono="IN0".$lokal; }
else { $pono="LN0".$lokal; }

if($_GET['cari1']==1){ $item=addslashes($dt2['item']); }

if($_GET['cari2']==1){ $warna=addslashes($dt2['colname']); }

/*if($dt2['suppk']==1949){
$cra=mysqli_query($koneksi,"SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
left outer join sup on sup.suppk=rpo.suppk
WHERE rpo.suppk='1949' and rpo.popros='1' and rpo.stspk='1' and rpo.popk='0' and YEAR(rpo.tgl)='$_GET[thn]' $and");
while($dta=mysqli_fetch_array($cra)){
$update=mysqli_query($koneksi,"update rpo set popros='0' where rkbpk='$dta[rkbpk]'");
}
} else {*/
$insert=mysqli_query($koneksi,"insert into po set
popk='$popk',
pono='$pono',
polipk='$polipk',
pourgpk='1',
postatpk='1',
tglpo=NOW(),
dateupdt=NOW(),
suppk='$dt2[suppk]',
brg='$item',
warna='$warna',
curpk='$dt2[curpk]',
ck='0',
fu='$fu'");

if($dt2['local']==2){
$update=mysqli_query($koneksi,"update notran set nikelokal='$lokal2' where tabel='PO'");
} else {
$update=mysqli_query($koneksi,"update notran set nikeimpor='$lokal2' where tabel='PO'");   
}

if($_GET['cari1']==1){
//$by1=",rpo.item";
$and1="and rpo.item='$item'";
$and1b="and brg='$item'";
}

if($_GET['cari2']==1){
//$by2=",rpo.colname";
$and2="and rpo.colname='$warna'";
$and2b="and warna='$warna'"; 
}

$crb=mysqli_query($koneksi,"SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
left outer join sup on sup.suppk=rpo.suppk
WHERE rpo.suppk='$dt2[suppk]' $and1 $and2 and rpo.popros='1' and rpo.stspk='1' and rpo.popk='0' and YEAR(rpo.tgl)='$_GET[thn]' $and");
while($dtb=mysqli_fetch_array($crb)){
if($dtb['local']==2){ $polipkb='2'; }
else { $polipkb='1'; }

$dt3 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT popk FROM po
where suppk='$dtb[suppk]' $and1b $and2b and polipk='$polipkb' and pur is null and ck='0' and fu='$fu' order by popk desc limit 1"));
$popkb=$dt3['popk'];

/*$update2=mysqli_query($koneksi,"update rkb set
newdate=NOW(),
popk='$popkb',
stspk='2',
status='4' where rkbpk='$dtb[rkbpk]'");

$update3=mysqli_query($koneksi,"update rpo set
newdate=NOW(),
popk='$popkb',
stspk='2',
popros='1' where rkbpk='$dtb[rkbpk]'");*/

$update3a=mysqli_query($koneksi,"update rkb set
stspk='2' where rkbpk='$dtb[rkbpk]'");

$update3b=mysqli_query($koneksi,"update rpo set
stspk='2',
popros='2' where rkbpk='$dtb[rkbpk]'");

$item=addslashes($dtb['item']);
$itemadd=addslashes($dtb['itemadd']);
$spec=addslashes($dtb['spec']);
$specadd=addslashes($dtb['specadd']);
$sup=addslashes($dtb['sup']);
$spec1=addslashes($dtb['spec1']);
$spec2=addslashes($dtb['spec2']);
$spec3=addslashes($dtb['spec3']);
$spec4=addslashes($dtb['spec4']);
$spec5=addslashes($dtb['spec5']);
$spec6=addslashes($dtb['spec6']);
$spec7=addslashes($dtb['spec7']);
$spec8=addslashes($dtb['spec8']);
$sizegar=addslashes($dtb['sizegar']);
$colname=addslashes($dtb['colname']);

$crb2=mysqli_query($koneksi,"select * from podt where rkbpk='$dtb[rkbpk]'");
$dtb2=mysqli_fetch_array($crb2);

if($dtb2['podtpk']>0){
$result = mysqli_query($koneksi,"update podt set popk='$popkb' where rkbpk='$dtb[rkbpk]'");    
} else {
$result = mysqli_query($koneksi,"insert into podt set
popk='$popkb',
rkbpk='$dtb[rkbpk]',
rpopk='$dtb[rpopk]',
ordpk='$dtb[ordpk]',
nour='$dtb[nour]',
submit='$dtb[submit]',
submitdate='$dtb[submitdate]',
kelnm='$dtb[kelnm]',
item='$item',
itemadd='$itemadd',
suppk='$dtb[suppk]',
sup='$sup',
tspec='$dtb[tspec]',
nspec='$dtb[nspec]',
spec='$spec',
specadd='$specadd',
hspec1='$dtb[hspec1]',
hspec2='$dtb[hspec2]',
hspec3='$dtb[hspec3]',
hspec4='$dtb[hspec4]',
hspec5='$dtb[hspec5]',
hspec6='$dtb[hspec6]',
hspec7='$dtb[hspec7]',
hspec8='$dtb[hspec8]',
spec1='$spec1',
spec2='$spec2',
spec3='$spec3',
spec4='$spec4',
spec5='$spec5',
spec6='$spec6',
spec7='$spec7',
spec8='$spec8',
colname='$colname',
colcode='$dtb[colcode]',
sizegar='$sizegar',
unit='$dtb[unit]',
unitori='$dtb[unit]',
price='$dtb[price]',
curpk='$dtb[curpk]',
bdownqty='$dtb[bdownqty]',
bdownpk='$dtb[bdownpk]',
kolom='$dtb[kolom]',
allowcons='$dtb[allowcons]',
estcons='$dtb[estcons]',
totcons='$dtb[totcons]',
qrs='$dtb[qrs]',
pocons='$dtb[pocons]',
poconsori='$dtb[pocons]',
stspk='1',
f1='$dtb[f1]',
f2='$dtb[f2]'");
}
}
}
/*
?>
<script language="javascript">
document.location="../admin?hal=assign2&x=1&thn=<?php echo $_GET['thn']; ?>";
</script>

<?php
*/
//}
} else {
}
?>