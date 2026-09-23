<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/koneksi11s.php";

$statuspk = $_POST['statuspk'];
$material = $_POST['material'];

if($material==1){ $material=1; }
else { $material=0; } 

$crsr=mysqli_query($koneksi11s,"select * from status 
left outer join request on request.srpk=status.srpk
left outer join buyer on buyer.buyerpk=request.buyerpk
where status.statuspk='$statuspk'");
$dtsr=mysqli_fetch_array($crsr);
$imageFilename1=addslashes($dtsr['foto']);
$imageFilename2=addslashes($dtsr['foto2']);
$buyernm=TRIM($dtsr['buyernm']);
$season=TRIM($dtsr['season']);
$prodes=TRIM($dtsr['description']);

$crbyr=mysqli_query($koneksi,"select * from byr where byrnm='$buyernm'");
$dtbyr=mysqli_fetch_array($crbyr);
$byrpk=$dtbyr['byrpk'];

$ordpkc = $_GET['ordpkc'];
$ordpke = $_GET['ordpke'];

if($ordpke>0){ $ordpk=$ordpke; $edit=1; }
else { $ordpk=$ordpkc; $edit=0; }

// Fetch the last status from the database
$lastStatusQuery = mysqli_query($koneksi, "SELECT * FROM ord ORDER BY ordpk DESC LIMIT 1");
$lastStatus = mysqli_fetch_assoc($lastStatusQuery);
$lastStatusPK = intval($lastStatus['ordpk']) + 1;

// Check if status exists for the given srpk
$statusQuery = mysqli_query($koneksi, "SELECT * FROM ord WHERE ordpk = '$ordpk'");
$status = mysqli_fetch_assoc($statusQuery);

if (!empty($status)) {
mysqli_query($koneksi, "UPDATE ord SET 
statuspk='$statuspk',
stsfoto='0',
foto = '$imageFilename1',
foto2 = '$imageFilename2' WHERE ordpk = " . $status['ordpk']);

$currentStatusPK = $status['ordpk'];
} else {
    $OP="OP".$lastStatusPK;
    // Insert the new status with the uploaded images
    mysqli_query($koneksi, "INSERT INTO ord (ordpk, ordno, stsfoto, statuspk, foto, foto2) 
    VALUES ('$lastStatusPK', '$OP', '0', '$statuspk', '$imageFilename1', '$imageFilename2')");

    // Return the new statuspk
    $currentStatusPK = $lastStatusPK;
}
$stsfoto=0;
$result=$statuspk.",".$currentStatusPK.",".$material.",".$imageFilename1.",".$imageFilename2.",".
$stsfoto.",".$byrpk.",".$prodes.",".$season.",".$edit;
echo $result;
?>