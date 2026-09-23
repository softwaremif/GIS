<?php
$id = $_POST['id'];
$N = count($id);
$dt = mysqli_fetch_array(mysqli_query($koneksi,"SELECT popk FROM po order by popk desc limit 1"));
$dt2 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT pono FROM po WHERE polipk='1' order by popk desc limit 1"));
$popk=$dt['popk']+1;
$lokal=substr($dt2['pono'],4,5)+1;
$lokal2=substr($dt2['pono'],4,5)+2;
$pono="LN0".$lokal;

$update=mysqli_query($koneksi,"update notran set nikelokal='$lokal2' where tabel='PO'");
$dta=mysqli_fetch_array(mysqli_query($koneksi,"select * from rkb where rkbpk='$id'"));
$insert=mysqli_query($koneksi,"insert into po set
popk='$popk',
pono='$pono',
polipk='1',
pourgpk='1',
postatpk='1',
tgldel='$dta[podel]',
tglpo=NOW(),
suppk='$dta[suppk]',
brg='$dta[item]',
ket='$dta[spec]',
pur='$_GET[pur]',
curpk='$dta[curpk]'");

for($i=0; $i < $N; $i++){
$sql = "select * from rkb where rkbpk='$id'";
$result = @mysqli_query($koneksi,$sql);
$update2=mysqli_query($koneksi,"update rkb set
newdate=NOW(),
popk='$popk',
stspk='2',
status='4' where rkbpk='$id'");
$update3=mysqli_query($koneksi,"update rpo set
newdate=NOW(),
popk='$popk',
stspk='2' where rkbpk='$id'");
$sql2 = mysqli_query($koneksi,"select * from rkb where rkbpk='$id'");
while($dtb= mysqli_fetch_array($sql2)){
$tpo=$dtb['pocons']*$dtb['price'];
$tot=$tot+$tpo;
$update4=mysqli_query($koneksi,"update po set tot='$tot' where popk='$popk'");
$insert2=mysqli_query($koneksi,"insert into podt set
popk='$popk',
rkbpk='$dtb[rkbpk]',
rpopk='$dtb[rpopk]',
ordpk='$dtb[ordpk]',
rkbpk='$dtb[rkbpk]',
nour='$dtb[nour]',
submitdate='$dtb[submitdate]',
kelnm='$dtb[kelnm]',
item='$dtb[item]',
itemadd='$dtb[itemadd]',
suppk='$dtb[suppk]',
sup='$dtb[sup]',
tspec='$dtb[tspec]',
nspec='$dtb[nspec]',
specs='$dtb[spec]',
specadd='$dtb[specadd]',
hspec1='$dtb[hspec1]',
hspec2='$dtb[hspec2]',
hspec3='$dtb[hspec3]',
hspec4='$dtb[hspec4]',
hspec5='$dtb[hspec5]',
hspec6='$dtb[hspec6]',
spec1='$dtb[spec1]',
spec2='$dtb[spec2]',
spec3='$dtb[spec3]',
spec4='$dtb[spec4]',
spec5='$dtb[spec5]',
spec6='$dtb[spec6]',
colname='$dtb[colname]',
colcode='$dtb[colcode]',
sizegar='$dtb[sizegar]',
unit='$dtb[unit]',
price='$dtb[price]',
curpk='$dtb[curpk]',
bdownqty='$dtb[bdownqty]',
bdownpk='$dtb[bdownpk]',
kolom='$dtb[kolom]',
allowcons='$dtb[allowcons]',
allowman='$dt[allowman]',
estcons='$dtb[estcons]',
totcons='$dtb[totcons]',
qrs='$dtb[qrs]',
pocons='$dtb[pocons]',
stspk='$dtb[stspk]'");  
}
if ($result){
echo json_encode(array('success'=>true, 'msg'=>"<div class='text-infohijau' style='width:415px;'> $N Item processed for PO &nbsp; &#10004; </div>"));
} else {
echo json_encode(array('msg'=>"<div class='text-infomerah' style='width:415px;'>There is error process PO &nbsp; &#x2573; </div>"));
}
} else {
echo json_encode(array('msg'=>"<div class='text-infomerah' style='width:415px;'>Cannot process submit PO &nbsp; &#x2573; </div>"));  
}
?>