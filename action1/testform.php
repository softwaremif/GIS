<?php
if($_POST['pourg']>0){
$update2=mysqli_query($koneksi,"update po set pourgpk='$_POST[pourg]' where popk='$POST[popk1j]'");
}

$etd=tgl2b($_POST['etda']);
$update=mysqli_query($koneksi,"update po set etd='$etd' where popk='$_POST[popk1j]'");
$update2=mysqli_query($koneksi,"update rkb set piplandel='$etd' where popk='$_POST[popk1j]'");

$sup=addslashes($_GET['sup']);
if($_POST['suppe']<>''){
$update1e=mysqli_query($koneksi,"update po set suppk='$_POST[suppe]' where popk='$_POST[popk1j]'");
$update2e=mysqli_query($koneksi,"update podt set suppk='$_POST[suppe]', sup='$sup' where popk='$_POST[popk1j]'");
$update3e=mysqli_query($koneksi,"update rkb set suppk='$_POST[suppe]', sup='$sup' where popk='$_POST[popk1j]'");
$update4e=mysqli_query($koneksi,"update rpo set suppk='$_POST[suppe]', sup='$sup' where popk='$_POST[popk1j]'");
}

if($_POST['curf']>0){
$update1f=mysqli_query($koneksi,"update po set curpk='$_POST[curf]' where popk='$_POST[popk1j]'");
$update2f=mysqli_query($koneksi,"update podt set curpk='$_POST[curf]' where popk='$_POST[popk1j]'");
$update3f=mysqli_query($koneksi,"update rkb set curpk='$_POST[curf]' where popk='$_POST[popk1j]'");
$update4f=mysqli_query($koneksi,"update rpo set curpk='$_POST[curf]' where popk='$_POST[popk1j]'");
}

$update1g=mysqli_query($koneksi,"update po set potop='$_POST[payterm]' where popk='$_POST[popk1j]'");

$tgldel=tgl2b($_POST['deldt']);
$update1g=mysqli_query($koneksi,"update po set tgldel='$tgldel' where popk='$_POST[popk1j]'");
$update3f=mysqli_query($koneksi,"update rkb set podel='$tgldel',poreqdel='$tgldel' where popk='$_POST[popk1j]'");
$update4f=mysqli_query($koneksi,"update rpo set poreqdel='$tgldel' where popk='$_POST[popk1j]'");

$update1g=mysqli_query($koneksi,"update po set brg='$_POST[brgg]' where popk='$_POST[popk1j]'");

$tglpo=tgl2b($_POST['tglpo']);
$tglpi=tgl2b($_POST['pia']);
if($_POST['postatpk']==4){
if($_POST['sts']>0){
$update1g=mysqli_query($koneksi,"update po set postatpk='$_POST[sts]', tglpo='$tglpo' where popk='$_POST[popk1j]'");
}
} else {
if($_POST['sts']>0){
$update1g=mysqli_query($koneksi,"update po set postatpk='$_POST[sts]', tglpo='$tglpo' where popk='$_POST[popk1j]'");
} else {
$update1g=mysqli_query($koneksi,"update po set tglpo='$tglpo' where popk='$_POST[popk1j]'");
$update1g=mysqli_query($koneksi,"update po set pidate='$tglpi', postatpk='4', email='1' where popk='$_POST[popk1j]'");
$update2=mysqli_query($koneksi,"update rkb set status='6' where popk='$_POST[popk1j]' and status>='3'");
}
}
?>