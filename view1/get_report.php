<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/koneksi4b.php";
include "../config/tanggal.php";
include "../config/tanggal2.php";
$thn=DATE('Y');
$thn2=$thn-2;
$thn2b=$thn2-2000;
$today=DATE('Y-m-d');

if($_GET['x']=="getReport"){
    $selectedSupplier = $_GET['supplier'];
    $selectedTreportpk = $_GET['treportpk'];

    $report2 = mysqli_query($koneksi, "SELECT * FROM report2 WHERE supnm LIKE '%$selectedSupplier%' AND treportpk = '$selectedTreportpk'");
    $result = mysqli_fetch_array($report2);

    $alamat = $result['alamat'];
    $stage = $result['stage'];
    $reportpk = $result['reportpk'];

    $response = array("alamat" => $alamat, "stage" => $stage, "reportpk" => $reportpk);
    echo json_encode($response);
}

if($_GET['x']=="getReport1"){
    $reportpk2 = $_GET['reportpk2'];

    $maxRows = 5;
    $queryFile1 = mysqli_query($koneksi, "SELECT * FROM file2 WHERE reportpk = '$reportpk2' ORDER BY filepk ASC LIMIT 1");

    $File1 = mysqli_fetch_array($queryFile1);

    $response = array("Filenm1" => $File1['filenm'], "Filepk1" => $File1['filepk'], "PoT1" => $File1['pono'], "File2T1" => $File1['file']);
    echo json_encode($response);
}

if($_GET['x']=="getReport2"){
    $reportpk2 = $_GET['reportpk2'];
    $filepk1 = $_GET['filepk1'];

    $maxRows = 5;
    $queryFile2 = mysqli_query($koneksi, "SELECT * FROM file2 WHERE reportpk = '$reportpk2' AND filepk != '$filepk1' ORDER BY filepk ASC LIMIT 1");

    $File2 = mysqli_fetch_array($queryFile2);
    $response = array("Filenm2" => $File2['filenm'], "Filepk2" => $File2['filepk'], "PoT2" => $File2['pono'], "File2T2" => $File2['file']);
    echo json_encode($response);
}

if($_GET['x']=="getReport3"){
    $reportpk2 = $_GET['reportpk2'];
    $filepk1 = $_GET['filepk1'];
    $filepk2 = $_GET['filepk2'];

    $maxRows = 5;
    $queryFile3 = mysqli_query($koneksi, "SELECT * FROM file2 WHERE reportpk = '$reportpk2' AND filepk != '$filepk1' AND filepk != '$filepk2' ORDER BY filepk ASC LIMIT 1");

    $File3 = mysqli_fetch_array($queryFile3);
    $response = array("Filenm3" => $File3['filenm'], "Filepk3" => $File3['filepk'], "PoT3" => $File3['pono'], "File2T3" => $File3['file']);
    echo json_encode($response);
}

if($_GET['x']=="getReport4"){
    $reportpk2 = $_GET['reportpk2'];
    $filepk1 = $_GET['filepk1'];
    $filepk2 = $_GET['filepk2'];
    $filepk3 = $_GET['filepk3'];

    $maxRows = 5;
    $queryFile4 = mysqli_query($koneksi, "SELECT * FROM file2 WHERE reportpk = '$reportpk2' AND filepk != '$filepk1' AND filepk != '$filepk2' AND filepk != '$filepk3' ORDER BY filepk ASC LIMIT 1");

    $File4 = mysqli_fetch_array($queryFile4);
    $response = array("Filenm4" => $File4['filenm'], "Filepk4" => $File4['filepk'], "PoT4" => $File4['pono'], "File2T4" => $File4['file']);
    echo json_encode($response);
}

if($_GET['x']=="getReport5"){
    $reportpk2 = $_GET['reportpk2'];
    $filepk1 = $_GET['filepk1'];
    $filepk2 = $_GET['filepk2'];
    $filepk3 = $_GET['filepk3'];
    $filepk4 = $_GET['filepk4'];

    $maxRows = 5;
    $queryFile5 = mysqli_query($koneksi, "SELECT * FROM file2
    WHERE reportpk = '$reportpk2' AND
    filepk != '$filepk1'AND
    filepk != '$filepk2' AND
    filepk != '$filepk3' AND
    filepk != '$filepk4'
    ORDER BY filepk ASC LIMIT 1");

    $File5 = mysqli_fetch_array($queryFile5);
    $response = array("Filepk5" => $File5['filepk'], "Filenm5" => $File5['filenm'], "PoT5" => $File5['pono'], "File2T5" => $File5['file']);
    echo json_encode($response);
}

?>
