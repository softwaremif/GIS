<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/koneksi11s.php";
include "../config/tanggal.php";
include "../config/tanggal2.php";
$thn = DATE('Y');
$thn2 = $thn - 2;
$thn2b = $thn2 - 2000;
$today = DATE('Y-m-d');
$ordpk = $_GET['ordpk'];

if ($_GET['x'] == "getord") {
    $thn = $_POST['thn'] - 2000; // Extract the last two digits of the year
    $thn = $thn . "-";
    $bln = $_POST['bln']; // Get the month
    if ($bln < 10) {
        $bln = "0" . $bln;
    } else {
        $bln = $bln;
    }

    // Sanitize input before using it in a query
    // $thn = mysqli_real_escape_string($koneksi, $thn);
    // $bln = mysqli_real_escape_string($koneksi, $bln);
    $ord = $thn . "-" . $bln;

    // Query to get the order number based on the first part (year and month)
    // Assuming ordno is structured as 'YY-MMXXX' (e.g., 24-09345)
    $query = "SELECT * FROM ord WHERE SUBSTRING(nourut, 1, 3) = '$thn' AND SUBSTRING(nourut, 4, 2) = '$bln' 
    ORDER BY CAST(SUBSTRING(nourut, 6) AS UNSIGNED) DESC";
    $report2 = mysqli_query($koneksi, $query);
    // $query = "SELECT * FROM ord WHERE ordno like '%$ord%' order by ordno desc limit 1";
    // $report2 = mysqli_query($koneksi, $query);

    // Fetch the result
    $result = mysqli_fetch_array($report2);

    if ($result) {
        // Extract the last part of the order number and increment it
        // $angkaSetelahTandaStrip = substr($string, strpos($string, "-") + 1, 4);
        $subordno = substr($result['nourut'], strpos($result['nourut'], "-") + 1);
        $subordno2 = substr($subordno, 0, 2);
        $sisaKarakter = substr($subordno, 2);

        $plusordno = (int)$sisaKarakter + 1; // Increment order number

        // if($plusordno>=100){
        // // Create new order number (ordno)
        // $ordno = sprintf("%02d-%02d%03d", $thn, $subordno2, $plusordno); // Formatted as YY-MMXXX
        // } else {
        // $subordno = substr($result['ordno'], 6, 2);
        // $plusordno = (int)$subordno + $i;
        //$ordno = sprintf("%02d-%02d%02d", $thn, $subordno2, $plusordno); // Formatted as YY-MMXXX  
        // }

        do {
            // Format the new order number
            $ordno = sprintf("%02d-%02d%02d", $thn, $subordno2, $plusordno);

            // Check if the new order number already exists
            $query1b = "SELECT * FROM ord WHERE nourut = '$ordno'";
            $report2b = mysqli_query($koneksi, $query1b);

            // If it exists, increment and check again
            if (mysqli_num_rows($report2b) > 0) {
                $plusordno++;
            } else {
                // Break the loop if a unique ordno is found
                break;
            }
        } while (true);

        // Send response as JSON
        $insert = mysqli_query($koneksi, "update ord set
        ordno='$ordno',
        nourut='$ordno' where ordpk='$ordpk'");

        $response = array("ordno" => $ordno);
        echo json_encode($response);
    } else {
        // Create new order number (ordno)
        $ordno = sprintf("%02d-%02d%02d", $thn, $bln, "01"); // Formatted as YY-MMXXX
        // Handle the case where no result is found
        $insert = mysqli_query($koneksi, "update ord set
        ordno='$ordno',
        nourut='$ordno' where ordpk='$ordpk'");
        $response = array("error" => "No order found for the given date.", "ordno" => $ordno);
        echo json_encode($response);
    }
}

if ($_GET['x'] == "ord") {
    $dtord = mysqli_fetch_array(mysqli_query($koneksi, "select * from ord where ordpk='$_GET[ordpk]'"));
    $stsprod = $dtord['stsprod'];
    if (!empty($dtord['dateprod'])) {
        $dateprod = tglu($dtord['dateprod']);
    } else {
        $dateprod = "";
    }
    $response = array("error" => "No order found for the given date.", "stsprod" => $stsprod, "dateprod" => $dateprod);
    echo json_encode($response);
}

if ($_GET['x'] == "bdown") {
    $dtord = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bdown WHERE ordpk='$_GET[ordpk]' AND jenis='DETAIL' AND tot>'0' AND color<>'' AND pcd='0000-00-00'"));
    $dtcost = mysqli_num_rows(mysqli_query($koneksi, "select * from costing where ordpk='$_GET[ordpk]'"));
    $check = $dtord;

    $dtqty = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(tot) as tot FROM bdown WHERE ordpk='$_GET[ordpk]' AND jenis='DETAIL' AND tot>'0' AND color<>'' group by ordpk"));
    $tot=$dtqty['tot'];

    if ($tot <= 0) {
        // $bdown = "Terdapat informasi yang tidak lengkap dalam order breakdown. Tolong cek kembali.";
        $total =  "Data order brakdown belum terisi.";

    }

    if ($dtord > 0) {
        // $bdown = "Terdapat informasi yang tidak lengkap dalam order breakdown. Tolong cek kembali.";
        $bdown =  "Data PCD di order brakdown tidak boleh kosong.";

    }

    if ($dtcost == 0) {
        $cost = "Informasi dalam tab Costing belum terisi.";
    }
    $response = array("error" => "No order found for the given date.", "bdown" => $bdown, "cost" => $cost, "dtord" => $dtord, "dtcost" => $dtcost , "tot" => $tot, "total" => $total, );
    echo json_encode($response);
}
