<?php
session_start();
$fu = $_SESSION['fu'];
include "../config/koneksi.php";
include "../config/koneksi11a.php";
include "../config/koneksi103a.php";
require "../config/vendor/autoload.php";
include "../config/ip.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
//use PhpOffice\PhpSpreadsheet\Reader\Xls;

$ip = ip();
$browser = browser();
$sistem = $_SERVER['HTTP_USER_AGENT'];
$userlog = $_SESSION['login'];

$ordpk  = $_POST['ordpk'];
$filenm = $_FILES['uploadfile']['name'];
$file = $_FILES['uploadfile']['tmp_name'];

$file_mimes = array(
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);

if (isset($_FILES['uploadfile']['name']) && in_array($_FILES['uploadfile']['type'], $file_mimes)) {

        $arr_file = explode('.', $_FILES['uploadfile']['name']);
        $extension = end($arr_file);

        if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($_FILES['uploadfile']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        for ($i = 1; $i < count($sheetData); $i++) {
                $no  = $sheetData[$i]['0'];
                $bdownpk1 = $sheetData[$i]['1'];
                $country1 = $sheetData[$i]['2'];
                $poref1 = $sheetData[$i]['3'];
                $pono1     = $sheetData[$i]['4'];
                $op1  = $sheetData[$i]['5'];
                $style1 = $sheetData[$i]['6'];
                $color1 = $sheetData[$i]['7'];
                $fob   = $sheetData[$i]['8'];
                $ddp = $sheetData[$i]['9'];
                $pcd1 = $sheetData[$i]['10'];
                $gac1 = $sheetData[$i]['11'];
                $secsz = $sheetData[$i]['12'];

                $s1 = $sheetData[$i]['13'];
                $s2 = $sheetData[$i]['14'];
                $s3 = $sheetData[$i]['15'];
                $s4 = $sheetData[$i]['16'];
                $s5 = $sheetData[$i]['17'];
                $s6 = $sheetData[$i]['18'];
                $s7 = $sheetData[$i]['19'];
                $s8 = $sheetData[$i]['20'];
                $s9 = $sheetData[$i]['21'];
                $s10 = $sheetData[$i]['22'];
                $s11 = $sheetData[$i]['23'];
                $s12 = $sheetData[$i]['24'];
                $s13 = $sheetData[$i]['25'];
                $s14 = $sheetData[$i]['26'];
                $s15 = $sheetData[$i]['27'];
                $s16 = $sheetData[$i]['28'];
                $s17 = $sheetData[$i]['29'];
                $s18 = $sheetData[$i]['30'];
                $s19 = $sheetData[$i]['31'];
                $s20 = $sheetData[$i]['32'];
                $s21 = $sheetData[$i]['33'];
                $s22 = $sheetData[$i]['34'];
                $s23 = $sheetData[$i]['35'];
                $s24 = $sheetData[$i]['36'];
                $s25 = $sheetData[$i]['37'];

                // $GAC=date('Y-m-d', strtotime($gac1));
                $total = $s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7 + $s8 + $s9 + $s10 +
                        $s11 + $s12 + $s13 + $s14 + $s15 + $s16 + $s17 + $s18 + $s19 + $s20 + $s21 + $s22 + $s23 + $s24 + $s25;

                $i2 = $i - 1;
                //ordpk
                $cr2 = mysqli_query($koneksi, "select * from ord where ordpk='$ordpk'");
                $dt2 = mysqli_fetch_array($cr2);
                $ordpk2 = $ordpk;
                $ordno = $dt2['ordno'];
                //bdownpk
                $cr2 = mysqli_query($koneksi, "select * from bdown order by bdownpk desc limit 1");
                $dt2 = mysqli_fetch_array($cr2);
                $bdownpk = $dt2['bdownpk'] + 1;
                //dataord
                $query1a = mysqli_query($koneksi, "select * from ord
                left outer join byr on byr.byrpk=ord.byrpk
                left outer join fu on fu.fupk=ord.fupk
                where ord.ordpk='$ordpk2' and fu.fupk='$fu'");
                $data1a = mysqli_fetch_array($query1a);
                $byrnm = addslashes($data1a['byrnm']);
                $srno = $data1a['srno'];
                $prodes = $data1a['prodes'];
                $season = addslashes($data1a['season']);
                $stsprod = $data1a['stsprod'];
                //userpk
                $query3b = mysqli_query($koneksi11a, "select userpk from user where fupk='$fu'");
                $data3b = mysqli_fetch_array($query3b);
                $userpk = $data3b['userpk'];
                //opno
                if ($op1 <> "") {
                        $OP = str_replace(' ', '', $op1);
                } else {
                        $OP = $ordno;
                }
                //color&country
                $country = addslashes($country1);
                $poref = addslashes($poref1);
                $pono = addslashes($pono1);
                $style = addslashes($style1);
                $color2 = TRIM($color1);
                $color = addslashes($color2);

                if ($bdownpk1 > 0) {
                        $querybz = mysqli_query($koneksi, "select * from bdown where bdownpk='$bdownpk1'");
                        $databz = mysqli_fetch_array($querybz);

                        if ($databz['jenis'] == "HEADER") {
                                $query = mysqli_query($koneksi, "update bdown set
                                        jenis='HEADER',
                                        country='$country',
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
                                        s16='$s16',
                                        s17='$s17',
                                        s18='$s18',
                                        s19='$s19',
                                        s20='$s20',
                                        s21='$s21',
                                        s22='$s22',
                                        s23='$s23',
                                        s24='$s24',
                                        s25='$s25' where bdownpk='$bdownpk1'");
                        } else {
                                if ($total > 0) {
                                        $query = mysqli_query($koneksi, "update bdown set
                                                jenis='DETAIL',
                                                country='$country',
                                                poref='$poref',
                                                pono='$pono',
                                                opno='$OP',
                                                style='$style',
                                                color='$color',
                                                FOB='$fob',
                                                gac='$gac1',
                                                pcd='$pcd1',
                                                DDP='$ddp',
                                                secsz='$secsz',
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
                                                s16='$s16',
                                                s17='$s17',
                                                s18='$s18',
                                                s19='$s19',
                                                s20='$s20',
                                                s20='$s20',
                                                s21='$s21',
                                                s22='$s22',
                                                s23='$s23',
                                                s24='$s24',
                                                s25='$s25',
                                                tot='$total' where bdownpk='$bdownpk1'");

                                        if ($stsprod == 1) {
                                                //sizebdown
                                                $cr3 = mysqli_query($koneksi, "select * from bdown where ordpk='$ordpk2' and jenis='HEADER' order by bdownpk desc limit 1");
                                                $dt3 = mysqli_fetch_array($cr3);
                                                //andon11
                                                $sql1b = mysqli_query($koneksi11a, "update po set
                                                        OP='$OP',
                                                        buyer='$byrnm',
                                                        style='$style',
                                                        SR='$srno',
                                                        POno='$pono',
                                                        silhouette='$prodes',
                                                        season='$season',
                                                        mif='2',
                                                        qty='$total',
                                                        material='$color',
                                                        GAC='$gac',
                                                        customer='$country',
                                                        secsz='$secsz',
                                                        poref='$poref',
                                                        qty1='$s1',
                                                        qty2='$s2',
                                                        qty3='$s3',
                                                        qty4='$s4',
                                                        qty5='$s5',
                                                        qty6='$s6',
                                                        qty7='$s7',
                                                        qty8='$s8',
                                                        qty9='$s9',
                                                        qty10='$s10',
                                                        qty11='$s11',
                                                        qty12='$s12',
                                                        qty13='$s13',
                                                        qty14='$s14',
                                                        qty15='$s15',
                                                        qty16='$s16',
                                                        qty17='$s17',
                                                        qty18='$s18',
                                                        qty19='$s19',
                                                        qty20='$s20',
                                                        qty21='$s21',
                                                        qty22='$s22',
                                                        qty23='$s23',
                                                        qty24='$s24',
                                                        qty25='$s25',
                                                        userpk='$userpk' where bdownpk='$bdownpk1'");
                                                //andon103
                                                $sql1c = mysqli_query($koneksi103a, "update po set
                                                        OP='$OP',
                                                        buyer='$byrnm',
                                                        style='$style',
                                                        SR='$srno',
                                                        POno='$pono',
                                                        silhouette='$prodes',
                                                        season='$season',
                                                        mif='1',
                                                        qty='$total',
                                                        material='$color',
                                                        GAC='$gac',
                                                        customer='$country',
                                                        secsz='$secsz',
                                                        poref='$poref',
                                                        qty1='$s1',
                                                        qty2='$s2',
                                                        qty3='$s3',
                                                        qty4='$s4',
                                                        qty5='$s5',
                                                        qty6='$s6',
                                                        qty7='$s7',
                                                        qty8='$s8',
                                                        qty9='$s9',
                                                        qty10='$s10',
                                                        qty11='$s11',
                                                        qty12='$s12',
                                                        qty13='$s13',
                                                        qty14='$s14',
                                                        qty15='$s15',
                                                        qty16='$s16',
                                                        qty17='$s17',
                                                        qty18='$s18',
                                                        qty19='$s19',
                                                        qty20='$s20',
                                                        qty21='$s21',
                                                        qty22='$s22',
                                                        qty23='$s23',
                                                        qty24='$s24',
                                                        qty25='$s25',
                                                        userpk='$userpk' where bdownpk='$bdownpk1'");
                                                //sizeandon11
                                                $sql2 = mysqli_query($koneksi11a, "update po set
                                                        size1='$dt3[s1]',
                                                        size2='$dt3[s2]',
                                                        size3='$dt3[s3]',
                                                        size4='$dt3[s4]',
                                                        size5='$dt3[s5]',
                                                        size6='$dt3[s6]',
                                                        size7='$dt3[s7]',
                                                        size8='$dt3[s8]',
                                                        size9='$dt3[s9]',
                                                        size10='$dt3[s10]',
                                                        size11='$dt3[s11]',
                                                        size12='$dt3[s12]',
                                                        size13='$dt3[s13]',
                                                        size14='$dt3[s14]',
                                                        size15='$dt3[s15]',
                                                        size16='$dt3[s16]',
                                                        size17='$dt3[s17]',
                                                        size18='$dt3[s18]',
                                                        size19='$dt3[s19]',
                                                        size20='$dt3[s20]',
                                                        size21='$dt3[s21]',
                                                        size22='$dt3[s22]',
                                                        size23='$dt3[s23]',
                                                        size24='$dt3[s24]',
                                                        size25='$dt3[s25]' where ordpk='$ordpk2'");
                                                //sizeandon103
                                                $sql2b = mysqli_query($koneksi103a, "update po set
                                                        size1='$dt3[s1]',
                                                        size2='$dt3[s2]',
                                                        size3='$dt3[s3]',
                                                        size4='$dt3[s4]',
                                                        size5='$dt3[s5]',
                                                        size6='$dt3[s6]',
                                                        size7='$dt3[s7]',
                                                        size8='$dt3[s8]',
                                                        size9='$dt3[s9]',
                                                        size10='$dt3[s10]',
                                                        size11='$dt3[s11]',
                                                        size12='$dt3[s12]',
                                                        size13='$dt3[s13]',
                                                        size14='$dt3[s14]',
                                                        size15='$dt3[s15]',
                                                        size16='$dt3[s16]',
                                                        size17='$dt3[s17]',
                                                        size18='$dt3[s18]',
                                                        size19='$dt3[s19]',
                                                        size20='$dt3[s20]',
                                                        size21='$dt3[s21]',
                                                        size22='$dt3[s22]',
                                                        size23='$dt3[s23]',
                                                        size24='$dt3[s24]',
                                                        size25='$dt3[s25]' where ordpk='$ordpk2'");
                                        }
                                }

                                $cr = mysqli_query($koneksi, "select * from ord where ordpk='$ordpk2'");
                                $dt = mysqli_fetch_array($cr);
                                // if($fob>0 || $ddp>0){
                                // $note="(FOB/DDP)";
                                // }
                                $lognote = "User " . $userlog . " (upload) update data qty order " . $dt['ordno'];
                                $insert2 = mysqli_query($koneksi, "insert into logtran set
                                logdtime=NOW(),
                                logdate=NOW(),
                                logtime=NOW(),
                                logip='$ip',
                                lognote='$lognote',
                                ordpk='$ordpk2',
                                sistem='$sistem'");
                        }
                } else {
                        if ($country1 == "HEADER" || $country1 == "SIZE") {
                                $query = mysqli_query($koneksi, "insert into bdown set
                                bdownpk='$bdownpk',
                                ordpk='$ordpk2',
                                nour='$i2',
                                jenis='HEADER',
                                country='$country1',
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
                                s16='$s16',
                                s17='$s17',
                                s18='$s18',
                                s19='$s19',
                                s20='$s20',
                                qty21='$s21',
                                qty22='$s22',
                                qty23='$s23',
                                qty24='$s24',
                                qty25='$s25'");
                        } else {
                                if ($total > 0) {
                                        $query = mysqli_query($koneksi, "insert into bdown set
                                        bdownpk='$bdownpk',
                                        ordpk='$ordpk2',
                                        nour='$i2',
                                        jenis='DETAIL',
                                        country='$country',
                                        poref='$poref',
                                        pono='$pono',
                                        opno='$OP',
                                        style='$style',
                                        color='$color',
                                        FOB='$fob',
                                        gac='$gac1',
                                        pcd='$pcd1',
                                        DDP='$ddp',
                                        secsz='$secsz',
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
                                        s16='$s16',
                                        s17='$s17',
                                        s18='$s18',
                                        s19='$s19',
                                        s20='$s20',
                                        s21='$s21',
                                        s22='$s22',
                                        s23='$s23',
                                        s24='$s24',
                                        s25='$s25',
                                        tot='$total'");

                                        if ($stsprod == 1) {
                                                //sizebdown
                                                $cr3 = mysqli_query($koneksi, "select * from bdown where ordpk='$ordpk2' and jenis='HEADER' order by bdownpk desc limit 1");
                                                $dt3 = mysqli_fetch_array($cr3);
                                                //andon11
                                                $sql1b = mysqli_query($koneksi11a, "insert into po set
                                                ordpk='$ordpk2',
                                                bdownpk='$bdownpk',
                                                OP='$OP',
                                                buyer='$byrnm',
                                                style='$style',
                                                SR='$srno',
                                                POno='$pono',
                                                silhouette='$prodes',
                                                season='$season',
                                                mif='2',
                                                qty='$total',
                                                material='$color',
                                                GAC='$gac',
                                                customer='$country',
                                                secsz='$secsz',
                                                qty1='$s1',
                                                qty2='$s2',
                                                qty3='$s3',
                                                qty4='$s4',
                                                qty5='$s5',
                                                qty6='$s6',
                                                qty7='$s7',
                                                qty8='$s8',
                                                qty9='$s9',
                                                qty10='$s10',
                                                qty11='$s11',
                                                qty12='$s12',
                                                qty13='$s13',
                                                qty14='$s14',
                                                qty15='$s15',
                                                qty16='$s16',
                                                qty17='$s17',
                                                qty18='$s18',
                                                qty19='$s19',
                                                qty20='$s20',
                                                qty21='$s21',
                                                qty22='$s22',
                                                qty23='$s23',
                                                qty24='$s24',
                                                qty25='$s25',
                                                userpk='$userpk',
                                                sts='0'");
                                                //andon103
                                                $sql1c = mysqli_query($koneksi103a, "insert into po set
                                                ordpk='$ordpk2',
                                                bdownpk='$bdownpk',
                                                OP='$OP',
                                                buyer='$byrnm',
                                                style='$style',
                                                SR='$srno',
                                                POno='$pono',
                                                silhouette='$prodes',
                                                season='$season',
                                                mif='1',
                                                qty='$total',
                                                material='$color',
                                                GAC='$gac',
                                                customer='$country',
                                                secsz='$secsz',
                                                qty1='$s1',
                                                qty2='$s2',
                                                qty3='$s3',
                                                qty4='$s4',
                                                qty5='$s5',
                                                qty6='$s6',
                                                qty7='$s7',
                                                qty8='$s8',
                                                qty9='$s9',
                                                qty10='$s10',
                                                qty11='$s11',
                                                qty12='$s12',
                                                qty13='$s13',
                                                qty14='$s14',
                                                qty15='$s15',
                                                qty16='$s16',
                                                qty17='$s17',
                                                qty18='$s18',
                                                qty19='$s19',
                                                qty20='$s20',
                                                qty21='$s21',
                                                qty22='$s22',
                                                qty23='$s23',
                                                qty24='$s24',
                                                qty25='$s25',
                                                userpk='$userpk',
                                                sts='0'");
                                                //sizeandon11
                                                $sql2 = mysqli_query($koneksi11a, "update po set
                                                size1='$dt3[s1]',
                                                size2='$dt3[s2]',
                                                size3='$dt3[s3]',
                                                size4='$dt3[s4]',
                                                size5='$dt3[s5]',
                                                size6='$dt3[s6]',
                                                size7='$dt3[s7]',
                                                size8='$dt3[s8]',
                                                size9='$dt3[s9]',
                                                size10='$dt3[s10]',
                                                size11='$dt3[s11]',
                                                size12='$dt3[s12]',
                                                size13='$dt3[s13]',
                                                size14='$dt3[s14]',
                                                size15='$dt3[s15]',
                                                size16='$dt3[s16]',
                                                size17='$dt3[s17]',
                                                size18='$dt3[s18]',
                                                size19='$dt3[s19]',
                                                size20='$dt3[s20]',
                                                size21='$dt3[s21]',
                                                size22='$dt3[s22]',
                                                size23='$dt3[s23]',
                                                size24='$dt3[s24]',
                                                size25='$dt3[s25]' where ordpk='$ordpk2'");
                                                //sizeandon103
                                                $sql2b = mysqli_query($koneksi103a, "update po set
                                                size1='$dt3[s1]',
                                                size2='$dt3[s2]',
                                                size3='$dt3[s3]',
                                                size4='$dt3[s4]',
                                                size5='$dt3[s5]',
                                                size6='$dt3[s6]',
                                                size7='$dt3[s7]',
                                                size8='$dt3[s8]',
                                                size9='$dt3[s9]',
                                                size10='$dt3[s10]',
                                                size11='$dt3[s11]',
                                                size12='$dt3[s12]',
                                                size13='$dt3[s13]',
                                                size14='$dt3[s14]',
                                                size15='$dt3[s15]',
                                                size16='$dt3[s16]',
                                                size17='$dt3[s17]',
                                                size18='$dt3[s18]',
                                                size19='$dt3[s19]',
                                                size20='$dt3[s20]'
                                                size21='$dt3[s21]',
                                                size22='$dt3[s22]',
                                                size23='$dt3[s23]',
                                                size24='$dt3[s24]',
                                                size25='$dt3[s25]' where ordpk='$ordpk2'");
                                        }
                                }
                                $cr = mysqli_query($koneksi, "select * from ord where ordpk='$ordpk2'");
                                $dt = mysqli_fetch_array($cr);
                                // if($fob>0 || $ddp>0){
                                // $note="(FOB/DDP)";
                                // }
                                $lognote = "User " . $userlog . " (upload) insert data qty order " . $dt['ordno'];
                                $insert2 = mysqli_query($koneksi, "insert into logtran set
                                logdtime=NOW(),
                                logdate=NOW(),
                                logtime=NOW(),
                                logip='$ip',
                                lognote='$lognote',
                                ordpk='$ordpk2',
                                sistem='$sistem'");
                        }
                }

                if ($query) $sukses++;
                $text = mysqli_query($koneksi, "update ord set filenm='$filenm' where ordpk='$ordpk2'");
        }

        if ($sukses > 0) {
                if ($stsprod == 1) {
                        echo "<div class='text-infohijau' style='width:375px;'>Perubahan data diteruskan ke produksi &nbsp; &#10004;</div>";
                } else {
                        echo "<div class='text-infohijau' style='width:375px;'>$sukses Data Imported Successfully &nbsp; &#10004;</div>";
                }
        } else {
                echo "<div class='text-infomerah' style='width:375px;'>Data Imported Error &nbsp; &#x2573;</div>";
        }
} else {
        echo "<div class='text-infomerah' style='width:375px;'>Only .csv or .xlsx file allowed &nbsp; &#x2573;</div>";
}
