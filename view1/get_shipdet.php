<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
$id=$_GET['id'];

$crim2 = mysqli_query($koneksi, "select * from importdt
left outer join import on import.importpk=importdt.importpk
left outer join vassal on vassal.vassalpk=import.vassalpk
left outer join arrival on arrival.arrivalpk=import.arrivalpk
left outer join port on port.portpk=import.portpk
where import.importpk='$id' and import.arrivalpk>0");
$dtim2 = mysqli_fetch_array($crim2);
$importpk = $dtim2['importpk'];
$stsimpk = $dtim2['stsimpk'];
$vassaltype = $dtim2['typenm'];
$vassalname = $dtim2['vassalnm'];
$airwaybill = $dtim2['AWB'];
$arrival = $dtim2['city'];
$port_name = $dtim2['portnm'];
$etdv3 = $dtim2['ETDV'];
$eta3 = $dtim2['ETDA'];
$eih3 = $dtim2['EIH'];

if($_GET['x']=="vtype"){
if ($vassaltype == "") {
echo $vassaltype = "-";
} else {
echo $vassaltype;
}
}

if($_GET['x']=="vname"){
if ($vassalname == "") {
echo $vassalname = "-";
} else {
echo $vassalname;
}
}

if($_GET['x']=="awb"){
if ($airwaybill == "") {
echo $airwaybill = "-";
} else {
echo $airwaybill;
}
}

if($_GET['x']=="arrival"){
if ($arrival == "") {
echo $arrival = "-";
} else {
echo $arrival;
}
}

if($_GET['x']=="port"){
if ($port_name == "") {
echo $port_name = "-";
} else {
echo $port_name;
}
}

if($_GET['x']=="etdv"){
if ($etdv3 == "") {
echo $etdv3 = "-";
} else {
echo tgl($etdv3);
}
}

if($_GET['x']=="eta"){
if ($eta3 == "") {
echo $eta3 = "-";
} else {
echo tgl($eta3);
}
}

if($_GET['x']=="eih"){
if ($eih3 == "") {
echo $eih3 = "-";
} else {
echo tgl($eih3);
}
}

if($_GET['x']=="totpo"){
$crim2b = mysqli_query($koneksi, "select * from importdt
left outer join import on import.importpk=importdt.importpk
where import.importpk='$id' and import.arrivalpk>0
group by importdt.popk");
$dtim2b = mysqli_num_rows($crim2b);
    
echo $dtim2b;
}
?>