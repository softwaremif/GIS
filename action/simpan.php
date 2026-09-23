<?php
session_start();
include "../config/koneksi.php";
include "../config/koneksi11a.php";
include "../config/koneksi11s.php";
include "../config/koneksi11u.php";
include "../config/koneksi103a.php";
include "../config/tanggal2.php";
include "../config/ip.php";
include "../config/log_bdown.php";

$ip = ip();
$browser = browser();
$sistem = $_SERVER['HTTP_USER_AGENT'];
$userlog = $_SESSION['login'];
$sfu = $_SESSION['funm'];

$date = date("Y-m-d");
$next = date("Y-m-d", strtotime("+1 days", strtotime($date)));
$next2 = date("Y-m-d", strtotime("+2 days", strtotime($date)));
$next3 = date("Y-m-d", strtotime("+6 month", strtotime($date)));

if ($_GET['x'] == "qty") {
    $ordpk = $_GET['ord'];
    $bdownpk = $_REQUEST['bdownpk'];
    $country = addslashes($_REQUEST['country']);
    $poref = addslashes($_REQUEST['poref']);
    $po = addslashes($_REQUEST['pono']);
    $dop = $_REQUEST['opno'];
    $style = $_REQUEST['style'];
    $color = addslashes(TRIM($_REQUEST['color']));
    $fob = $_REQUEST['fob'];
    $ddp = $_REQUEST['ddp'];
    $secsz = addslashes($_REQUEST['secsz']);
    $gac = $_REQUEST['gac2'];
    $pcd = $_REQUEST['pcd2'];
    $s1 = $_REQUEST['s1'];
    $s2 = $_REQUEST['s2'];
    $s3 = $_REQUEST['s3'];
    $s4 = $_REQUEST['s4'];
    $s5 = $_REQUEST['s5'];
    $s6 = $_REQUEST['s6'];
    $s7 = $_REQUEST['s7'];
    $s8 = $_REQUEST['s8'];
    $s9 = $_REQUEST['s9'];
    $s10 = $_REQUEST['s10'];
    $s11 = $_REQUEST['s11'];
    $s12 = $_REQUEST['s12'];
    $s13 = $_REQUEST['s13'];
    $s14 = $_REQUEST['s14'];
    $s15 = $_REQUEST['s15'];
    $s16 = $_REQUEST['s16'];
    $s17 = $_REQUEST['s17'];
    $s18 = $_REQUEST['s18'];
    $s19 = $_REQUEST['s19'];
    $s20 = $_REQUEST['s20'];
    $s21 = $_REQUEST['s21'];
    $s22 = $_REQUEST['s22'];
    $s23 = $_REQUEST['s23'];
    $s24 = $_REQUEST['s24'];
    $s25 = $_REQUEST['s25'];
    $s26 = $_REQUEST['s26'];
    $s27 = $_REQUEST['s27'];
    $s28 = $_REQUEST['s28'];
    $s29 = $_REQUEST['s29'];
    $s30 = $_REQUEST['s30'];
    $s31 = $_REQUEST['s31'];
    $s32 = $_REQUEST['s32'];
    $s33 = $_REQUEST['s33'];
    $s34 = $_REQUEST['s34'];
    $s35 = $_REQUEST['s35'];
    $s36 = $_REQUEST['s36'];
    $s37 = $_REQUEST['s37'];
    $s38 = $_REQUEST['s38'];
    $s39 = $_REQUEST['s39'];
    $s40 = $_REQUEST['s40'];
    $stot = $s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7 + $s8 + $s9 + $s10 + $s11 + $s12 + $s13 + $s14 + $s15 +
        $s16 + $s17 + $s18 + $s19 + $s20 + $s21 + $s22 + $s23 + $s24 + $s25 + $s26 + $s27 + $s28 + $s29 + $s30 +
        $s31 + $s32 + $s33 + $s34 + $s35 + $s36 + $s37 + $s38 + $s39 + $s40;
    $tot = $stot;

    $country2 = addslashes($country);
    $style2 = addslashes($style);
    $gac2 = tgl2b($gac);
    $pcd2 = tgl2b($pcd);

    //opno
    $cro = mysqli_query($koneksi, "select * from ord where ordpk='$ordpk'");
    $dto = mysqli_fetch_array($cro);
    if ($dop <> "") {
        $OP = str_replace(' ', '', $dop);
    } else {
        $OP = $dto['ordno'];
    }

    $stsprod = $dto['stsprod'];

    $updt = mysqli_query($koneksi, "update ord set dateupdate=NOW() where ordpk='$ordpk'");

    // Rekam PCD / Ex-Factory / total qty sebelum diubah, untuk dibandingkan
    // sesudahnya. Lihat config/log_bdown.php.
    $bdownSebelum = bdown_snapshot($koneksi, $ordpk, $bdownpk);

    $sql = "update bdown set
        country='$country2',
        poref='$poref',
        pono='$po',
        opno='$OP',
        style='$style2',
        color='$color',
        FOB='$fob',
        DDP='$ddp',
        secsz='$secsz',
        gac='$gac2',
        pcd='$pcd2',
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
        s26='$s26',
        s27='$s27',
        s28='$s28',
        s29='$s29',
        s30='$s30',
        s31='$s31',
        s32='$s32',
        s33='$s33',
        s34='$s34',
        s35='$s35',
        s36='$s36',
        s37='$s37',
        s38='$s38',
        s39='$s39',
        s40='$s40',
        tot='$tot' where bdownpk='$bdownpk'";
    @mysqli_query($koneksi, $sql);
    //userpk
    $query3 = mysqli_query($koneksi11a, "select userpk from user where fupk='$fu'");
    $data3 = mysqli_fetch_array($query3);
    $userpk = $data3['userpk'];
    //bdown
    $cr = mysqli_query($koneksi, "select * from bdown where bdownpk='$bdownpk'");
    $dt = mysqli_fetch_array($cr);
    $jenis = $dt['jenis'];
    if ($stsprod == 1) {
        if ($jenis == "DETAIL") {
            //andon11
            $sql2 = mysqli_query($koneksi11a, "update po set
                userpk='$userpk',
                mif='2',
                OP='$OP',
                style='$style2',
                POno='$po',
                qty='$tot',
                material='$color',
                GAC='$gac2',
                customer='$country2',
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
                qty26='$s26',
                qty27='$s27',
                qty28='$s28',
                qty29='$s29',
                qty30='$s30',
                qty31='$s31',
                qty32='$s32',
                qty33='$s33',
                qty34='$s34',
                qty35='$s35',
                qty36='$s36',
                qty37='$s37',
                qty38='$s38',
                qty39='$s39',
                qty40='$s40' where bdownpk='$bdownpk'");
            //andon103
            $sql2b = mysqli_query($koneksi103a, "update po set
                userpk='$userpk',
                mif='1',
                OP='$OP',
                style='$style2',
                POno='$po',
                qty='$tot',
                material='$color',
                GAC='$gac2',
                customer='$country2',
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
                qty26='$s26',
                qty27='$s27',
                qty28='$s28',
                qty29='$s29',
                qty30='$s30',
                qty31='$s31',
                qty32='$s32',
                qty33='$s33',
                qty34='$s34',
                qty35='$s35',
                qty36='$s36',
                qty37='$s37',
                qty38='$s38',
                qty39='$s39',
                qty40='$s40' where bdownpk='$bdownpk'");
        } else {
            //sizeandon11
            $sql2 = mysqli_query($koneksi11a, "update po set
                userpk='$userpk',
                mif='2',
                size1='$s1',
                size2='$s2',
                size3='$s3',
                size4='$s4',
                size5='$s5',
                size6='$s6',
                size7='$s7',
                size8='$s8',
                size9='$s9',
                size10='$s10',
                size11='$s11',
                size12='$s12',
                size13='$s13',
                size14='$s14',
                size15='$s15',
                size16='$s16',
                size17='$s17',
                size18='$s18',
                size19='$s19',
                size20='$s20',
                size21='$s21',
                size22='$s22',
                size23='$s23',
                size24='$s24',
                size25='$s25',
                size26='$s26',
                size27='$s27',
                size28='$s28',
                size29='$s29',
                size30='$s30',
                size31='$s31',
                size32='$s32',
                size33='$s33',
                size34='$s34',
                size35='$s35',
                size36='$s36',
                size37='$s37',
                size38='$s38',
                size39='$s39',
                size40='$s40' where ordpk='$ordpk'");
            //sizeandon103
            $sql2b = mysqli_query($koneksi103a, "update po set
                userpk='$userpk',
                mif='1',
                size1='$s1',
                size2='$s2',
                size3='$s3',
                size4='$s4',
                size5='$s5',
                size6='$s6',
                size7='$s7',
                size8='$s8',
                size9='$s9',
                size10='$s10',
                size11='$s11',
                size12='$s12',
                size13='$s13',
                size14='$s14',
                size15='$s15',
                size16='$s16',
                size17='$s17',
                size18='$s18',
                size19='$s19',
                size20='$s20',
                size21='$s21',
                size22='$s22',
                size23='$s23',
                size24='$s24',
                size25='$s25',
                size26='$s26',
                size27='$s27',
                size28='$s28',
                size29='$s29',
                size30='$s30',
                size31='$s31',
                size32='$s32',
                size33='$s33',
                size34='$s34',
                size35='$s35',
                size36='$s36',
                size37='$s37',
                size38='$s38',
                size39='$s39',
                size40='$s40' where ordpk='$ordpk'");
        }
    }

    if ($dt['jenis'] == "DETAIL") {
        $cr2 = mysqli_query($koneksi, "select * from rkb where ordpk='$ord' and bdownpk='$bdownpk' and popk is null and stspk is null");
        while ($dt2 = mysqli_fetch_array($cr2)) {
        for ($i = 1; $i <= 25; $i++) {
            if ($dt2['kolom'] == "s$i") {

                $sval  = ${"s$i"};
                $kolom = "s$i"; // simpan ke variabel dulu, supaya bisa di-bind

                $totcons = $sval * $dt2['estcons'];

                $f1a = substr($dt2['f1'], 0, 1);
                $f1b = substr($dt2['f1'], 1, 10);
                $f2a = substr($dt2['f2'], 0, 1);
                $f2b = substr($dt2['f2'], 1, 10);

                if ($f1a == "-") {
                    $totcons2 = $totcons - $f1b;
                } elseif ($f1a == "*") {
                    $totcons2 = $totcons * $f1b;
                } elseif ($f1a == "/") {
                    $totcons2 = $totcons / $f1b;
                } else {
                    $totcons2 = $totcons + $f1b;
                }

                if ($f2a == "-") {
                    $totcons3 = $totcons2 - $f2b;
                } elseif ($f2a == "*") {
                    $totcons3 = $totcons2 * $f2b;
                } elseif ($f2a == "/") {
                    $totcons3 = $totcons2 / $f2b;
                } else {
                    $totcons3 = $totcons2 + $f2b;
                }

                if (is_numeric($totcons3)) {
                    $ttotcons = $totcons3;
                } elseif (is_numeric($totcons2)) {
                    $ttotcons = $totcons2;
                } else {
                    $ttotcons = $totcons;
                }

                $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);

                $rkbpk   = $dt2['rkbpk'];

                $stmt = mysqli_prepare($koneksi, "UPDATE rkb SET pocons=?, totcons=?, bdownqty=? WHERE rkbpk=? AND ordpk=? AND bdownpk=? AND kolom=?");
                mysqli_stmt_bind_param($stmt, "ddsssss", $pocons, $ttotcons, $sval, $rkbpk, $ord, $bdownpk, $kolom);
                mysqli_stmt_execute($stmt);

                $stmt2 = mysqli_prepare($koneksi, "UPDATE rpo SET pocons=?, totcons=?, bdownqty=? WHERE rkbpk=? AND ordpk=? AND bdownpk=? AND kolom=?");
                mysqli_stmt_bind_param($stmt2, "ddsssss", $pocons, $ttotcons, $sval, $rkbpk, $ord, $bdownpk, $kolom);
                mysqli_stmt_execute($stmt2);

                $stmt3 = mysqli_prepare($koneksi, "UPDATE podt SET pocons=?, totcons=?, bdownqty=? WHERE rkbpk=? AND ordpk=? AND bdownpk=? AND kolom=?");
                mysqli_stmt_bind_param($stmt3, "ddsssss", $pocons, $ttotcons, $sval, $rkbpk, $ord, $bdownpk, $kolom);
                mysqli_stmt_execute($stmt3);

                break;
            }
        }
            if ($dt2['kolom'] == "tot") {
                $totcons = $tot * $dt2['estcons'];

                $f1a = substr($dt2['f1'], 0, 1);
                $f1b = substr($dt2['f1'], 1, 10);
                $f2a = substr($dt2['f2'], 0, 1);
                $f2b = substr($dt2['f2'], 1, 10);

                if ($f1a == "-") {
                    $totcons2 = $totcons - $f1b;
                } else if ($f1a == "*") {
                    $totcons2 = $totcons * $f1b;
                } else if ($f1a == "/") {
                    $totcons2 = $totcons / $f1b;
                } else {
                    $totcons2 = $totcons + $f1b;
                }

                if ($f2a == "-") {
                    $totcons3 = $totcons2 - $f2b;
                } else if ($f2a == "*") {
                    $totcons3 = $totcons2 * $f2b;
                } else if ($f2a == "/") {
                    $totcons3 = $totcons2 / $f2b;
                } else {
                    $totcons3 = $totcons2 + $f2b;
                }

                if ($totcons3 > 0) {
                    $ttotcons = $totcons3;
                } else if ($totcons2 > 0) {
                    $ttotcons = $totcons2;
                } else {
                    $ttotcons = $totcons;
                }

                $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
                //$totcons=$tot*$dt2['estcons'];
                //$pocons=$totcons+(($totcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman'];
                $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$tot' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='tot'");
                $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$tot' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='tot'");
                $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$tot' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='tot'");
            }
        }
    }

    $cr3 = mysqli_query($koneksi, "select * from ord where ordpk='$dt[ordpk]'");
    $dt3 = mysqli_fetch_array($cr3);
    if ($fob > 0 || $ddp > 0) {
        $note = " (FOB/DDP) ";
    }
    $lognote = "User " . $userlog . " edit data qty order " . $note . $dt3['ordno'];
    $insert2 = mysqli_query($koneksi, "insert into logtran set
        logdtime=NOW(),
        logdate=NOW(),
        logtime=NOW(),
        logip='$ip',
        lognote='$lognote',
        ordpk='$dt3[ordpk]',
        bdownpk='$bdownpk',
        sistem='$sistem'");

    log_bdown_penting($koneksi, $ordpk, $bdownpk, $bdownSebelum, $userlog, $ip, $sistem);

    if ($stsprod == 1) {
        echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:375px;'>Perubahan data diteruskan ke produksi &nbsp; &#10004; </div>"));
    } else {
        echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:375px;'>Data berhasil diupdate. &nbsp; &#10004; </div>"));
    }
}

if ($_GET['x'] == "copyqty") {
    $ordpk = intval($_POST['ordpk']);
    $bdownpk = intval($_POST['bdownpk']);

    mysqli_query($koneksi, "update bdown set copy='0' where ordpk='$ordpk'");
    mysqli_query($koneksi, "update bdown set copy='1' where bdownpk='$bdownpk' and ordpk='$ordpk'");

    echo json_encode(array('success' => true));
}

if ($_GET['x'] == "cancopyqty") {
    $ordpk = intval($_POST['ordpk']);
    mysqli_query($koneksi, "update bdown set copy='0' where ordpk='$ordpk'");
    echo json_encode(array('success' => true));
}

if ($_GET['x'] == "replaceqty") {
    $ordpk = intval($_POST['ordpk']);
    $ids = isset($_POST['ids']) ? $_POST['ids'] : array();
    $cols = isset($_POST['cols']) ? $_POST['cols'] : array();

    $allowedCols = array('fob' => 'FOB', 'gac' => 'gac', 'pcd' => 'pcd');
    $selectedCols = array_values(array_intersect($cols, array_keys($allowedCols)));

    $src = mysqli_fetch_array(mysqli_query($koneksi, "select * from bdown where ordpk='$ordpk' and copy='1' limit 1"));

    if (!$src || empty($selectedCols) || empty($ids)) {
        echo json_encode(array('success' => false, 'msg' => "<div class='text-infomerah' style='width:350px;'>Data sumber copy tidak ditemukan &nbsp; &#x2573; </div>"));
    } else {
        $updated = 0;
        foreach ($ids as $bdownpk) {
            $bdownpk = intval($bdownpk);
            if ($bdownpk == $src['bdownpk']) {
                continue;
            }
            $cr = mysqli_query($koneksi, "select * from bdown where bdownpk='$bdownpk'");
            $dt = mysqli_fetch_array($cr);
            if (!$dt) {
                continue;
            }
            $sets = array();
            foreach ($selectedCols as $col) {
                $dbcol = $allowedCols[$col];
                $val = addslashes($src[$dbcol]);
                $sets[] = "$dbcol='$val'";
            }
            mysqli_query($koneksi, "update bdown set " . implode(',', $sets) . " where bdownpk='$bdownpk'");
            $updated++;
        }

        mysqli_query($koneksi, "update bdown set copy='0' where ordpk='$ordpk' and copy='1'");

        $dt3 = mysqli_fetch_array(mysqli_query($koneksi, "select * from ord where ordpk='$ordpk'"));
        $lognote = "User " . $userlog . " replace data qty order (" . implode(',', $selectedCols) . ") " . $dt3['ordno'];
        mysqli_query($koneksi, "insert into logtran set
            logdtime=NOW(),
            logdate=NOW(),
            logtime=NOW(),
            logip='$ip',
            lognote='$lognote',
            ordpk='$ordpk',
            sistem='$sistem'");

        echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:350px;'>" . $updated . " baris berhasil di-replace &nbsp; &#10004; </div>"));
    }
}

if ($_GET['x'] == "qty2") {
    $fu = $_SESSION['fu'];
    $ordpk = $_GET['ord'];

    // Tambah baris PO mengubah total qty order — direkam untuk notifikasi schedule.
    $totalSebelum = bdown_total_order($koneksi, $ordpk);
    $country = addslashes($_REQUEST['country']);
    $poref = $_REQUEST['poref'];
    $po = $_REQUEST['pono'];
    $dop = $_REQUEST['opno'];
    $style = $_REQUEST['style'];
    $color = TRIM($_REQUEST['color']);
    $fob = $_REQUEST['fob'];
    $ddp = $_REQUEST['ddp'];
    $secsz = $_REQUEST['secsz'];
    $gac = $_REQUEST['gac2'];
    $pcd = $_REQUEST['pcd2'];
    $s1 = $_REQUEST['s1'];
    $s2 = $_REQUEST['s2'];
    $s3 = $_REQUEST['s3'];
    $s4 = $_REQUEST['s4'];
    $s5 = $_REQUEST['s5'];
    $s6 = $_REQUEST['s6'];
    $s7 = $_REQUEST['s7'];
    $s8 = $_REQUEST['s8'];
    $s9 = $_REQUEST['s9'];
    $s10 = $_REQUEST['s10'];
    $s11 = $_REQUEST['s11'];
    $s12 = $_REQUEST['s12'];
    $s13 = $_REQUEST['s13'];
    $s14 = $_REQUEST['s14'];
    $s15 = $_REQUEST['s15'];
    $s16 = $_REQUEST['s16'];
    $s17 = $_REQUEST['s17'];
    $s18 = $_REQUEST['s18'];
    $s19 = $_REQUEST['s19'];
    $s20 = $_REQUEST['s20'];
    $s21 = $_REQUEST['s21'];
    $s22 = $_REQUEST['s22'];
    $s23 = $_REQUEST['s23'];
    $s24 = $_REQUEST['s24'];
    $s25 = $_REQUEST['s25'];
    $s26 = $_REQUEST['s26'];
    $s27 = $_REQUEST['s27'];
    $s28 = $_REQUEST['s28'];
    $s29 = $_REQUEST['s29'];
    $s30 = $_REQUEST['s30'];
    $s31 = $_REQUEST['s31'];
    $s32 = $_REQUEST['s32'];
    $s33 = $_REQUEST['s33'];
    $s34 = $_REQUEST['s34'];
    $s35 = $_REQUEST['s35'];
    $s36 = $_REQUEST['s36'];
    $s37 = $_REQUEST['s37'];
    $s38 = $_REQUEST['s38'];
    $s39 = $_REQUEST['s39'];
    $s40 = $_REQUEST['s40'];
    $stot = $s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7 + $s8 + $s9 + $s10 + $s11 + $s12 + $s13 + $s14 + $s15 +
        $s16 + $s17 + $s18 + $s19 + $s20 + $s21 + $s22 + $s23 + $s24 + $s25 + $s26 + $s27 + $s28 + $s29 + $s30 +
        $s31 + $s32 + $s33 + $s34 + $s35 + $s36 + $s37 + $s38 + $s39 + $s40;
    $tot = $stot;

    $gac2 = tgl2b($gac);
    $pcd2 = tgl2b($pcd);
    $sqln = mysqli_query($koneksi, "SELECT * FROM bdown WHERE ordpk='$ordpk' ORDER BY nour DESC LIMIT 1");
    $dtn = mysqli_fetch_array($sqln);
    $nour = $dtn['nour'] + 1;

    if ($country == "HEADER" || $country == "SIZE") {
        $jenis = "HEADER";
        $country2 = "SIZE";
        $nour2 = 1;
    } else {
        $jenis = "DETAIL";
        $country2 = $country;
        $nour2 = $nour;
    }

    //opno
    $cro = mysqli_query($koneksi, "select * from ord where ordpk='$ordpk'");
    $dto = mysqli_fetch_array($cro);
    if ($dop <> "") {
        $OP = str_replace(' ', '', $dop);
    } else {
        $OP = $dto['ordno'];
    }

    $stsprod = $dto['stsprod'];

    //bdownpk
    $cr2 = mysqli_query($koneksi, "select * from bdown order by bdownpk desc limit 1");
    $dt2 = mysqli_fetch_array($cr2);
    $bdownpk = $dt2['bdownpk'] + 1;
    //dataord
    $query1a = mysqli_query($koneksi, "select * from ord
        left outer join byr on byr.byrpk=ord.byrpk
        left outer join fu on fu.fupk=ord.fupk
        where ord.ordpk='$ordpk' and fu.fupk='$fu'");
    $data1a = mysqli_fetch_array($query1a);
    $byrnm = addslashes($data1a['byrnm']);
    $srno = $data1a['srno'];
    $prodes = $data1a['prodes'];
    $season = addslashes($data1a['season']);
    //userpk
    $query3 = mysqli_query($koneksi11a, "select userpk from user where fupk='$fu'");
    $data3 = mysqli_fetch_array($query3);
    $userpk = $data3['userpk'];
    //opno
    // $OP=str_replace(' ', '', $op);

    $updt = mysqli_query($koneksi, "update ord set dateupdate=NOW() where ordpk='$ordpk'");

    $sql2n = "insert into bdown set
        bdownpk='$bdownpk',
        nour='$nour2',
        ordpk='$ordpk',
        jenis='$jenis',
        country='$country2',
        poref='$poref',
        pono='$po',
        opno='$OP',
        style='$style',
        color='$color',
        FOB='$fob',
        DDP='$ddp',
        secsz='$secsz',
        gac='$gac2',
        pcd='$pcd2',
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
        s26='$s26',
        s27='$s27',
        s28='$s28',
        s29='$s29',
        s30='$s30',
        s31='$s31',
        s32='$s32',
        s33='$s33',
        s34='$s34',
        s35='$s35',
        s36='$s36',
        s37='$s37',
        s38='$s38',
        s39='$s39',
        s40='$s40',
        tot='$tot'";
    @mysqli_query($koneksi, $sql2n);

    //sizebdown
    $cr3 = mysqli_query($koneksi, "select * from bdown where ordpk='$ordpk' and jenis='HEADER' order by bdownpk desc limit 1");
    $dt3 = mysqli_fetch_array($cr3);
    //andon11
    if ($stsprod == 1) {
        $sql1b = mysqli_query($koneksi11a, "insert into po set
            ordpk='$ordpk',
            bdownpk='$bdownpk',
            OP='$OP',
            buyer='$byrnm',
            style='$style',
            SR='$srno',
            POno='$po',
            silhouette='$prodes',
            season='$season',
            mif='2',
            qty='$tot',
            material='$color',
            GAC='$gac2',
            customer='$country2',
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
            qty26='$s26',
            qty27='$s27',
            qty28='$s28',
            qty29='$s29',
            qty30='$s30',
            qty31='$s31',
            qty32='$s32',
            qty33='$s33',
            qty34='$s34',
            qty35='$s35',
            qty36='$s36',
            qty37='$s37',
            qty38='$s38',
            qty39='$s39',
            qty40='$s40',
            userpk='$userpk',
            sts='0'");
        //andon103
        $sql1c = mysqli_query($koneksi103a, "insert into po set
            ordpk='$ordpk',
            bdownpk='$bdownpk',
            OP='$OP',
            buyer='$byrnm',
            style='$style',
            SR='$srno',
            POno='$po',
            silhouette='$prodes',
            season='$season',
            mif='1',
            qty='$tot',
            material='$color',
            GAC='$gac2',
            customer='$country2',
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
            qty26='$s26',
            qty27='$s27',
            qty28='$s28',
            qty29='$s29',
            qty30='$s30',
            qty31='$s31',
            qty32='$s32',
            qty33='$s33',
            qty34='$s34',
            qty35='$s35',
            qty36='$s36',
            qty37='$s37',
            qty38='$s38',
            qty39='$s39',
            qty40='$s40',
            userpk='$userpk',
            sts='0'");
        //sizeandon11
        $sql2 = mysqli_query($koneksi11a, "update po set
            userpk='$userpk',
            mif='2',
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
            size25='$dt3[s25]',
            size26='$dt3[s26]',
            size27='$dt3[s27]',
            size28='$dt3[s28]',
            size29='$dt3[s29]',
            size30='$dt3[s30]',
            size31='$dt3[s31]',
            size32='$dt3[s32]',
            size33='$dt3[s33]',
            size34='$dt3[s34]',
            size35='$dt3[s35]',
            size36='$dt3[s36]',
            size37='$dt3[s37]',
            size38='$dt3[s38]',
            size39='$dt3[s39]',
            size40='$dt3[s40]' where ordpk='$ordpk'");
        //sizeandon103
        $sql2b = mysqli_query($koneksi103a, "update po set
            userpk='$userpk',
            mif='1',
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
            size25='$dt3[s25]',
            size26='$dt3[s26]',
            size27='$dt3[s27]',
            size28='$dt3[s28]',
            size29='$dt3[s29]',
            size30='$dt3[s30]',
            size31='$dt3[s31]',
            size32='$dt3[s32]',
            size33='$dt3[s33]',
            size34='$dt3[s34]',
            size35='$dt3[s35]',
            size36='$dt3[s36]',
            size37='$dt3[s37]',
            size38='$dt3[s38]',
            size39='$dt3[s39]',
            size40='$dt3[s40]' where ordpk='$ordpk'");
    }

    $cr = mysqli_query($koneksi, "select * from ord where ordpk='$ordpk'");
    $dt = mysqli_fetch_array($cr);
    if ($fob > 0 || $ddp > 0) {
        $note = " (FOB/DDP) ";
    }
    $lognote = "User " . $userlog . " tambah data qty order " . $note . $dt['ordno'];
    $insert2 = mysqli_query($koneksi, "insert into logtran set
                logdtime=NOW(),
                logdate=NOW(),
                logtime=NOW(),
                logip='$ip',
                lognote='$lognote',
                ordpk='$ordpk',
                sistem='$sistem'");

    log_bdown_total($koneksi, $ordpk, 0, $totalSebelum, $userlog, $ip, $sistem);
    // echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:285px;'>1 Row order breakdown added &nbsp; &#10004; </div>"));
    if ($stsprod == 1) {
        echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:375px;'>Perubahan data diteruskan ke produksi &nbsp; &#10004; </div>"));
    } else {
        echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:375px;'>1 Row order breakdown added &nbsp; &#10004; </div>"));
    }
}

// if ($_GET['x'] == "edtord") {
//     $prodes = addslashes($_POST['prodes']);
//     $season = addslashes($_POST['season']);
//     $ordno1 = addslashes($_POST['ordno']);
//     $ordno = TRIM($ordno1);
//     $deldate = tgl2b($_POST['deldate3']);

//     $cr = mysqli_query($koneksi, "select * from ord where ordno='$ordno'");
//     $dt = mysqli_fetch_array($cr);

//     if ($dt['ordpk']==$_POST['ordpk']) {
//     echo "<div class='text-infomerah' style='width:300px;'>Order number cannot be the same &nbsp; &#x2573; </div>";
//     } else {

//     }
// }
if ($_GET['x'] == "ord") {
    $prodes = addslashes($_POST['prodes']);
    $season = addslashes($_POST['season']);
    if ($_POST['ordno1'] <> "") {
        $ordno = addslashes($_POST['ordno1']);
    } else if ($_POST['ordno2'] <> "") {
        $ordno = addslashes($_POST['ordno2']);
    } else {
        $ordno = addslashes($_POST['ordno']);
    }
    // $ordno = TRIM($ordno1);
    $deldate = tgl2b($_POST['deldate3']);
    $sspv = $_SESSION['spv'];
    $suser = $_SESSION['user'];

    if ($sspv == 1) {
        $userpk = "";
    } else {
        $userpk = $suser;
    }

    $crord = mysqli_query($koneksi, "select * from ord where nourut='$ordno' and ordpk<>'$_POST[ordpk]'");
    $dtcek = mysqli_num_rows($crord);

    $cr2 = mysqli_query($koneksi, "select * from ord where ordpk='$_POST[ordpk]'");
    // $dt2 = mysqli_num_rows($cr2);
    $dt2 = mysqli_fetch_array($cr2);

    $crm = mysqli_query($koneksi, "select * from rkb where ordpk='$_POST[ordpk]' order by rkbpk desc limit 1");
    $dtm = mysqli_fetch_array($crm);
    $nour1 = $dtm['nour'] + 1;

    if ($dt2['fupk'] > 0) {
        $fupk = $dt2['fupk'];
    } else {
        $fupk = $_SESSION['fu'];
    }

    if ($dtcek > 0) {
        echo "<div class='text-infomerah' style='width:300px;'>Order number cannot be the same &nbsp; &#x2573; </div>";
    } else {
        if ($sspv == 1) {
            if ($dt2['datecreate'] > 0) {
                $insert = mysqli_query($koneksi, "update ord set
    ordno='$ordno',
    artno='$_POST[artno]',
    prodes='$prodes',
    season='$season',
    srno='$_POST[srno]',
    byrpk='$_POST[byrpk]',
    fupk='$fupk',
    stage='$_POST[stage]',
    deldate='$deldate',
    dateupdate=NOW(),
    statuspk='$_POST[statuspk]' where ordpk='$_POST[ordpk]'");
            } else {
                $insert = mysqli_query($koneksi, "update ord set
    ordno='$ordno',
    nourut='$ordno',
    artno='$_POST[artno]',
    prodes='$prodes',
    season='$season',
    srno='$_POST[srno]',
    byrpk='$_POST[byrpk]',
    fupk='$fupk',
    stage='$_POST[stage]',
    deldate='$deldate',
    datecreate=NOW(),
    dateupdate=NOW(),
    statuspk='$_POST[statuspk]' where ordpk='$_POST[ordpk]'");
            }
        } else {
            if ($dt2['datecreate'] > 0) {
                $insert = mysqli_query($koneksi, "update ord set
    ordno='$ordno',
    artno='$_POST[artno]',
    prodes='$prodes',
    season='$season',
    srno='$_POST[srno]',
    byrpk='$_POST[byrpk]',
    fupk='$fupk',
    userpk='$userpk',
    stage='$_POST[stage]',
    deldate='$deldate',
    dateupdate=NOW(),
    statuspk='$_POST[statuspk]' where ordpk='$_POST[ordpk]'");
            } else {
                $insert = mysqli_query($koneksi, "update ord set
    ordno='$ordno',
    nourut='$ordno',
    artno='$_POST[artno]',
    prodes='$prodes',
    season='$season',
    srno='$_POST[srno]',
    byrpk='$_POST[byrpk]',
    fupk='$fupk',
    userpk='$userpk',
    stage='$_POST[stage]',
    deldate='$deldate',
    datecreate=NOW(),
    dateupdate=NOW(),
    statuspk='$_POST[statuspk]' where ordpk='$_POST[ordpk]'");
            }
        }

        $lognote = "User " . $userlog . " edit data order " . $_POST['ordno'];
        $insert2 = mysqli_query($koneksi, "insert into logtran set
    logdtime=NOW(),
    logdate=NOW(),
    logtime=NOW(),
    logip='$ip',
    lognote='$lognote',
    ordpk='$_POST[ordpk]',
    sistem='$sistem'");

        if ($dt2['statuspk'] <> $_POST['statuspk']) {
            if ($_POST['matadd'] == 1) {
                $cr3 = mysqli_query($koneksi11s, "select * from material where statuspk='$_POST[statuspk]'");
                while ($dt3 = mysqli_fetch_array($cr3)) {
                    //supplier
                    $crs = mysqli_query($koneksi11s, "select * from supplier where suppk='$dt3[suppk]'");
                    $dts = mysqli_fetch_array($dts);
                    if ($dts['suppkgis'] > 0) {
                        $suppk = $dts['suppkgis'];
                    } else {
                        $suppk = 1224;
                    }

                    $matnm = addslashes(TRIM($dt3['matnm']));

                    //kelnm
                    if ($dt3['group'] == 1) {
                        $kelnm = "CUTTING";
                        $kelcode = "C";
                    } else if ($dt3['group'] == 2) {
                        $kelnm = "SEWING";
                        $kelcode = "S";
                    } else if ($dt3['group'] == 3) {
                        $kelnm = "FINISHING/PACKING";
                        $kelcode = "F";
                    } else if ($dt3['group'] == 4) {
                        $kelnm = "JASA";
                        $kelcode = "J";
                    } else {
                        $kelnm = "";
                        $kelcode = "";
                    }
                    //multikolom
                    if ($dt3['kelnm'] == "ZIPPER") {
                        $tspec = 2;
                        $nspec = 5;
                        $hspec1 = "Tape";
                        $hspec2 = "Teeth";
                        $hspec3 = "Slider";
                        $hspec4 = "Stopper";
                        $hspec5 = "Puler";
                        $spec1 = $dt3['tape'];
                        $spec2 = $dt3['teeth'];
                        $spec3 = $dt3['slider'];
                        $spec4 = $dt3['stopper'];
                        $spec5 = $dt3['puler'];
                    } else {
                        $tspec = 1;
                        $nspec = 0;
                    }
                    //itemcode
                    if ($dt3['mtypepk']) {
                        $dtcode = mysqli_fetch_array(mysqli_query($koneksi, "select * from mtype where mtypepk='$dt3[mtypepk]'"));
                        $mcode = $dtcode['mcode'];
                        $kata_pertama = explode(' ', $matnm)[0];
                        $itemcode = $kelcode . "-" . $mcode . "-" . $kata_pertama;
                    } else {
                        $itemcode = "";
                    }

                    if ($itemcode <> "") {
                        $dtitem = mysqli_fetch_array(mysqli_query($koneksi, "select * from itemcode where codenm='$itemcode'"));
                        if ($dtitem['codepk'] > 0) {
                            $updtcode = mysqli_query($koneksi, "update itemcode set itemnm='$matnm' where codepk='$dtitem[codepk]'");
                        } else {
                            $updtcode = mysqli_query($koneksi, "insert into itemcode set 
                    codenm='$itemcode',
                    itemnm='$matnm'");
                        }
                    }

                    $nour1++;
                    $insertmat = mysqli_query($koneksi, "insert into rkb set
    ordpk='$_POST[ordpk]',
    matpk='$dt3[matpk]',
    nour='$nour1',
    suppk='$suppk',
    hari1=NOW(),
    tspec='$tspec',
    nspec='$nspec',
    item='$matnm',
    colname='$dt3[color]',
    spec='$dt3[spec]',
    colcode='$dt3[colcode]',
    bdownqty='$dt3[qty]',
    price='$dt3[price]',
    curpk='$dt3[curpk]',
    sizegar='$dt3[size]',
    unit='$dt3[unit]',
    kelnm='$kelnm',
    mtypepk='$dt3[mtypepk]',
    codenm='$itemcode',
    itemadd='$dt3[garmentcw]',
    specadd='$dt3[placement]',
    matusage='$dt3[matusage]',
    hspec1='$hspec1',
    hspec2='$hspec2',
    hspec3='$hspec3',
    hspec4='$hspec4',
    hspec5='$hspec5',
    spec1='$spec1',
    spec2='$spec2',
    spec3='$spec3',
    spec4='$spec4',
    spec5='$spec5'");
                }
            }
        }

        if ($_POST['kali'] > 0) {
            for ($i = 1; $i <= $_POST['kali']; $i++) {
                // Extract the last part of the order number and increment it
                $thn = substr($ordno, 0, 2);
                // $bln = substr($ordno, 3, 2);
                // $subordno = substr($ordno, 6, 3); // Assuming the last 3 digits are order sequence
                // $plusordno = (int)$subordno + $i; // Increment order number

                $subordno = substr($ordno, strpos($ordno, "-") + 1);
                $subordno2 = substr($subordno, 0, 2);
                $sisaKarakter = substr($subordno, 2);

                $plusordno = (int)$sisaKarakter + $i;

                // $ordnop = sprintf("%02d-%02d%02d", $thn, $subordno2, $plusordno);

                $ordpkp = $_POST['ordpk'];
                $ordpkpp = $ordpkp + $i;

                do {
                    // Format the new order number
                    $ordnop = sprintf("%02d-%02d%02d", $thn, $subordno2, $plusordno);

                    // Check if the new order number already exists
                    $query1b = "SELECT * FROM ord WHERE ordno = '$ordnop'";
                    $report2b = mysqli_query($koneksi, $query1b);

                    // If it exists, increment and check again
                    if (mysqli_num_rows($report2b) > 0) {
                        $plusordno++;
                    } else {
                        // Break the loop if a unique ordno is found
                        break;
                    }
                } while (true);

                if ($sspv == 1) {
                    $insert = mysqli_query($koneksi, "insert into ord set
            ordpk='$ordpkpp',
            ordno='$ordnop',
            nourut='$ordnop',
            prodes='$prodes',
            season='$season',
            srno='$_POST[srno]',
            artno='$_POST[artno]',
            byrpk='$_POST[byrpk]',
            fupk='$_SESSION[fu]',
            deldate='$deldate',
            stage='$_POST[stage]',
            datecreate=NOW(),
            dateupdate=NOW(),
            foto='$dt2[foto]',
            foto2='$dt2[foto2]',
            stsfoto='$dt2[stsfoto]',
            statuspk='$dt2[statuspk]'");
                } else {
                    $insert = mysqli_query($koneksi, "insert into ord set
            ordpk='$ordpkpp',
            ordno='$ordnop',
            nourut='$ordnop',
            prodes='$prodes',
            season='$season',
            srno='$_POST[srno]',
            artno='$_POST[artno]',
            byrpk='$_POST[byrpk]',
            fupk='$_SESSION[fu]',
            userpk='$userpk',
            deldate='$deldate',
            stage='$_POST[stage]',
            datecreate=NOW(),
            dateupdate=NOW(),
            foto='$dt2[foto]',
            foto2='$dt2[foto2]',
            stsfoto='$dt2[stsfoto]',
            statuspk='$dt2[statuspk]'");
                }

                $lognote = "User " . $userlog . " tambah data order " . $_POST['ordno'];
                $insert2 = mysqli_query($koneksi, "insert into logtran set
            logdtime=NOW(),
            logdate=NOW(),
            logtime=NOW(),
            logip='$ip',
            lognote='$lognote',
            ordpk='$_POST[ordpk]',
            sistem='$sistem'");

                if ($_POST['matadd'] == 1) {
                    $crm2 = mysqli_query($koneksi, "select * from rkb where ordpk='$_POST[ordpk]' and matpk>0 and hari1='$date' 
            order by rkbpk asc");
                    while ($dtm2 = mysqli_fetch_array($crm2)) {
                        $insertmat = mysqli_query($koneksi, "insert into rkb set
                ordpk='$ordpkpp',
                matpk='$dtm2[matpk]',
                nour='$dtm2[nour]',
                suppk='$dtm2[suppk]',
                hari1=NOW(),
                tspec='$dtm2[tspec]',
                nspec='$dtm2[nspec]',
                item='$dtm2[item]',
                colname='$dtm2[colname]',
                spec='$dtm2[spec]',
                colcode='$dtm2[colcode]',
                bdownqty='$dtm2[bdownqty]',
                price='$dtm2[price]',
                curpk='$dtm2[curpk]',
                sizegar='$dtm2[sizegar]',
                unit='$dtm2[unit]',
                kelnm='$dtm2[kelnm]',
                mtypepk='$dtm2[mtypepk]',
                codenm='$dtm2[codenm]',
                itemadd='$dtm2[garmentcw]',
                specadd='$dtm2[placement]',
                matusage='$dtm2[matusage]',
                hspec1='$dtm2[hspec1]',
                hspec2='$dtm2[hspec2]',
                hspec3='$dtm2[hspec3]',
                hspec4='$dtm2[hspec4]',
                hspec5='$dtm2[hspec5]',
                spec1='$dtm2[spec1]',
                spec2='$dtm2[spec2]',
                spec3='$dtm2[spec3]',
                spec4='$dtm2[spec4]',
                spec5='$dtm2[spec5]'");
                    }
                }
            }
        }
        echo "<div class='text-infohijau' style='width:300px;'>Order data saved &nbsp; &#10004; </div>";
    }
}

if ($_GET['x'] == "mat") {
    $row = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb WHERE rkbpk='$_POST[rkbpk]'"));
    $dt1 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM rkb WHERE rkbpk='$_POST[rkbpk]'"));
    //$dt = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM sup WHERE suppk='$_POST[suppk]'"));
    $dt2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM rkb WHERE ordpk='$_POST[ordpk]' order by nour desc limit 1"));
    //$sup = addslashes($dt['supnm']);
    $nour = $dt2['nour'] + 1;

    $dt3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM po WHERE popk='$dt1[popk]'"));

    if ($_POST['pocons2b'] > 0) {
        $pocons = $_POST['pocons2b'];
    } else {
        $pocons = $_POST['pocons1'];
    }

    if ($dt1['status'] >= 3) {
        if ($dt1['suppk'] <> $_POST['suppk']) {
            if ($dt1['stspk'] == 4) {
                $sts = $dt1['status'];
            } else {
                if ($dt1['status'] == 3) {
                    $sts = 2;
                } else {
                    $sts = $dt1['status'];
                }
            }
        } else {
            $sts = $dt1['status'];
        }
    } else {
        if ($pocons > 0) {
            $sts = 2;
            $hari2 = $next2;
        } else {
            $sts = 1;
            $hari2 = $next;
        }
    }

    // if ($_POST['tspec'] == 2) {
    //     $nspec = 8;
    // } else {
    //     $nspec = 0;
    // }
    if ($_POST['tspec'] != 2) {
        for ($i = 1; $i <= 8; $i++) {
            $_POST["hspec$i"] = null;
            $_POST["spec$i"] = null;
        }
        $tspec = 1;
    }else{
        $tspec = 2;
    }

    $item = addslashes($_POST['item']);
    
    $itemadd_raw = $_POST['itemadd'] ?? '';
    if (is_array($itemadd_raw)) {
        $itemadd = implode(', ', $itemadd_raw);
    } else {
        $itemadd = addslashes($itemadd_raw);
    }
    $itemadd = addslashes($itemadd);
    // $itemadd = addslashes($_POST['itemadd']);
    $spec = addslashes($_POST['spec']);
    $specadd = addslashes($_POST['specadd']);
    $spec1 = addslashes($_POST['spec1']);
    $spec2 = addslashes($_POST['spec2']);
    $spec3 = addslashes($_POST['spec3']);
    $spec4 = addslashes($_POST['spec4']);
    $spec5 = addslashes($_POST['spec5']);
    $spec6 = addslashes($_POST['spec6']);
    $spec7 = addslashes($_POST['spec7']);
    $spec8 = addslashes($_POST['spec8']);
    $sizegar = addslashes($_POST['sizegar']);
    $cw = addslashes($_POST['cw']);
    $gsm = addslashes($_POST['gsm']);
    $colname = addslashes($_POST['colname']);

    $nilai_usage = !empty($_POST['nilai_usage']) ? $_POST['nilai_usage'] : $_POST['nilai_usage2'];

    if ($row > 0) {
        if ($_POST['ext2b'] > 0) {
            $suppk2 = $_POST['ext2b'];
        } else {
            $suppk2 = $_POST['suppk'];
        }

        $dt = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM sup WHERE suppk='$suppk2'"));
        $sup = addslashes($dt['supnm']);

        $dtgroup = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mtype WHERE mtypepk='$_POST[mtype]'"));
        if ($dtgroup['mgroup'] == 1) {
            $kelnm = "CUTTING";
            $kelcode = "C";
        }
        if ($dtgroup['mgroup'] == 2) {
            $kelnm = "SEWING";
            $kelcode = "S";
        }
        if ($dtgroup['mgroup'] == 3) {
            $kelnm = "FINISHING/PACKING";
            $kelcode = "F";
        }
        if ($dtgroup['mgroup'] == 4) {
            $kelnm = "JASA";
            $kelcode = "J";
        }


        //itemcode
        if ($_POST['mtype']) {
            $dtcode = mysqli_fetch_array(mysqli_query($koneksi, "select * from mtype where mtypepk='$_POST[mtype]'"));
            $mcode = $dtcode['mcode'];
            $kata_pertama = explode(' ', $item)[0];
            $itemcode = $kelcode . "-" . $mcode . "-" . $kata_pertama;
        } else {
            $itemcode = "";
        }

        if ($itemcode <> "") {
            $dtitem = mysqli_fetch_array(mysqli_query($koneksi, "select * from itemcode where codenm='$itemcode'"));
            if ($dtitem['codepk'] > 0) {
                $updtcode = mysqli_query($koneksi, "update itemcode set itemnm='$item' where codepk='$dtitem[codepk]'");
            } else {
                $updtcode = mysqli_query($koneksi, "insert into itemcode set 
                    codenm='$itemcode',
                    itemnm='$item'");
            }
        }

        $insert = mysqli_query($koneksi, "update rkb set
            ordpk='$_POST[ordpk]',
            matusage='$nilai_usage',
            nour='$_POST[nour]',
            kelnm='$kelnm',
            mtypepk='$_POST[mtype]',
            codenm='$itemcode',
            item='$item',
            itemadd='$itemadd',
            suppk='$suppk2',
            sup='$sup',
            tspec='$tspec',
            nspec='$nspec',
            spec='$spec',
            specadd='$specadd',
            hspec1='$_POST[hspec1]',
            hspec2='$_POST[hspec2]',
            hspec3='$_POST[hspec3]',
            hspec4='$_POST[hspec4]',
            hspec5='$_POST[hspec5]',
            hspec6='$_POST[hspec6]',
            hspec7='$_POST[hspec7]',
            hspec8='$_POST[hspec8]',
            spec1='$spec1',
            spec2='$spec2',
            spec3='$spec3',
            spec4='$spec4',
            spec5='$spec5',
            spec6='$spec6',
            spec7='$spec7',
            spec8='$spec8',
            colname='$colname',
            colcode='$_POST[colcode]',
            sizegar='$sizegar',
            cw='$cw',
            gsm='$gsm',
            unit='$_POST[unit]',
            price='$_POST[price2]',
            curpk='$_POST[curpk]',
            bdownqty='$_POST[bdownqty]',
            bdownpk='$_POST[bdownpk]',
            kolom='$_POST[kolom]',
            allowcons='$_POST[allowcons]',
            allowman='$_POST[allowman]',
            negocons='$_POST[negocons]',
            estcons='$_POST[estcons]',
            varcons='$_POST[varcons]',
            totcons='$_POST[totcons]',
            qrs='$_POST[qrs]',
            pocons='$pocons',
            status='$sts',
            hari2='$hari2',
            f1='$_POST[f1]',
            f2='$_POST[f2]' where rkbpk='$_POST[rkbpk]'");

        if ($_POST['canbd'] == 1) {
            $updt = mysqli_query($koneksi, "update rkb set bdownpk=NULL, kolom=NULL where rkbpk='$_POST[rkbpk]'");
        }

        if ($dt1['suppk'] <> $suppk2) {
            if ($dt1['stspk'] == 4) {
                if ($dt3['pur'] == "Rita" || $dt3['pur'] == "Theresia") {
                    $delete2 = mysqli_query($koneksi, "delete from podt where rkbpk='$_POST[rkbpk]'");
                    $update = mysqli_query($koneksi, "update rkb set stspk='1', popk=NULL, status='4' where rkbpk='$_POST[rkbpk]'");
                    $update2 = mysqli_query($koneksi, "update rpo set suppk='$suppk2', sup='$sup', stspk='1', popk=0, popros='0' where rkbpk='$_POST[rkbpk]'");
                    //$update4=mysqli_query($koneksi,"update po tglrev=NULL, postatpk='1' where popk='$dt1[popk]'");
                } else {
                    $delete2 = mysqli_query($koneksi, "delete from podt where rkbpk='$_POST[rkbpk]'");
                    $update = mysqli_query($koneksi, "update rkb set stspk='1', popk=NULL, status='4' where rkbpk='$_POST[rkbpk]'");
                    $update2 = mysqli_query($koneksi, "update rpo set suppk='$suppk2', sup='$sup', stspk='1', popk=0, popros='1' where rkbpk='$_POST[rkbpk]'");
                    //$update4=mysqli_query($koneksi,"update po tglrev=NULL, postatpk='1' where popk='$dt1[popk]'");    
                }
            } else {
                if ($dt1['status'] == 3) {
                    $delete1 = mysqli_query($koneksi, "delete from rpo where rkbpk='$_POST[rkbpk]'");
                    $delete2 = mysqli_query($koneksi, "delete from podt where rkbpk='$_POST[rkbpk]'");
                    $update = mysqli_query($koneksi, "update rkb set stspk=NULL, popk=NULL where rkbpk='$_POST[rkbpk]'");
                }
            }
        } else {
            if ($_POST['fup'] == $sfu) {
                // $dt2 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM po WHERE popk='$_POST[popk]'"));
                if ($dt3['pur'] == "Rita") {
                } else if ($dt3['pur'] == "Theresia") {
                } else {
                    $updtpo = mysqli_query($koneksi, "update po set postatpk='2', dateupdt2=NOW(), tpo2c='1' where popk='$_POST[popk]'");
                    $update = mysqli_query($koneksi, "update rkb set stspk='5' where rkbpk='$_POST[rkbpk]'");
                    $update2 = mysqli_query($koneksi, "update rpo set stspk='5' where rkbpk='$_POST[rkbpk]'");
                    $update3 = mysqli_query($koneksi, "update podt set stspk='5' where rkbpk='$_POST[rkbpk]'");

                    $insert = mysqli_query($koneksi, "update podt set
                        ordpk='$_POST[ordpk]',
                        matusage='$nilai_usage',
                        nour='$_POST[nour]',
                        kelnm='$kelnm',
                        item='$item',
                        itemadd='$itemadd',
                        tspec='$tspec',
                        nspec='$nspec',
                        spec='$spec',
                        specadd='$specadd',
                        hspec1='$_POST[hspec1]',
                        hspec2='$_POST[hspec2]',
                        hspec3='$_POST[hspec3]',
                        hspec4='$_POST[hspec4]',
                        hspec5='$_POST[hspec5]',
                        hspec6='$_POST[hspec6]',
                        hspec7='$_POST[hspec7]',
                        hspec8='$_POST[hspec8]',
                        spec1='$spec1',
                        spec2='$spec2',
                        spec3='$spec3',
                        spec4='$spec4',
                        spec5='$spec5',
                        spec6='$spec6',
                        spec7='$spec7',
                        spec8='$spec8',
                        colname='$colname',
                        colcode='$_POST[colcode]',
                        sizegar='$sizegar',
                        unit='$_POST[unit]',
                        price='$_POST[price2]',
                        curpk='$_POST[curpk]',
                        bdownqty='$_POST[bdownqty]',
                        bdownpk='$_POST[bdownpk]',
                        kolom='$_POST[kolom]',
                        allowcons='$_POST[allowcons]',
                        estcons='$_POST[estcons]',
                        totcons='$_POST[totcons]',
                        qrs='$_POST[qrs]',
                        pocons='$pocons',
                        f1='$_POST[f1]',
                        f2='$_POST[f2]',
                        tpodt='1' where rkbpk='$_POST[rkbpk]'");

                    if ($_POST['canbd'] == 1) {
                        $updt = mysqli_query($koneksi, "update podt set bdownpk=NULL, kolom=NULL where rkbpk='$_POST[rkbpk]'");
                    }
                }
            }
        }

        if ($dt1['stspk'] == 4) {
            $update = mysqli_query($koneksi, "update rkb set stspk='5' where rkbpk='$_POST[rkbpk]'");

            //revision
            // $update2 = mysqli_query($koneksi, "update rpo set stspk='5' where rkbpk='$_POST[rkbpk]'");
            // $update3 = mysqli_query($koneksi, "update podt set stspk='5' where rkbpk='$_POST[rkbpk]'");

            // if($_POST['kelnm']=="CUTTING"){
            // $insert=mysqli_query($koneksi,"update podt set
            // ordpk='$_POST[ordpk]',
            // nour='$_POST[nour]',
            // kelnm='$_POST[kelnm]',
            // item='$item',
            // itemadd='$itemadd',
            // tspec='$tspec',
            // nspec='$nspec',
            // spec='$spec',
            // specadd='$specadd',
            // hspec1='$_POST[hspec1]',
            // hspec2='$_POST[hspec2]',
            // hspec3='$_POST[hspec3]',
            // hspec4='$_POST[hspec4]',
            // hspec5='$_POST[hspec5]',
            // hspec6='$_POST[hspec6]',
            // hspec7='$_POST[hspec7]',
            // hspec8='$_POST[hspec8]',
            // spec1='$spec1',
            // spec2='$spec2',
            // spec3='$spec3',
            // spec4='$spec4',
            // spec5='$spec5',
            // spec6='$spec6',
            // spec7='$spec7',
            // spec8='$spec8',
            // colname='$colname',
            // colcode='$_POST[colcode]',
            // sizegar='$sizegar',
            // unit='$_POST[unit]',
            // tpodt='1' where rkbpk='$_POST[rkbpk]'");
            // } else {

            //revision
            // $insert = mysqli_query($koneksi, "update podt set
            //         ordpk='$_POST[ordpk]',
            //         matusage='$nilai_usage',
            //         nour='$_POST[nour]',
            //         kelnm='$kelnm',
            //         item='$item',
            //         itemadd='$itemadd',
            //         tspec='$tspec',
            //         nspec='$nspec',
            //         spec='$spec',
            //         specadd='$specadd',
            //         hspec1='$_POST[hspec1]',
            //         hspec2='$_POST[hspec2]',
            //         hspec3='$_POST[hspec3]',
            //         hspec4='$_POST[hspec4]',
            //         hspec5='$_POST[hspec5]',
            //         hspec6='$_POST[hspec6]',
            //         hspec7='$_POST[hspec7]',
            //         hspec8='$_POST[hspec8]',
            //         spec1='$spec1',
            //         spec2='$spec2',
            //         spec3='$spec3',
            //         spec4='$spec4',
            //         spec5='$spec5',
            //         spec6='$spec6',
            //         spec7='$spec7',
            //         spec8='$spec8',
            //         colname='$colname',
            //         colcode='$_POST[colcode]',
            //         sizegar='$sizegar',
            //         unit='$_POST[unit]',
            //         bdownqty='$_POST[bdownqty]',
            //         bdownpk='$_POST[bdownpk]',
            //         kolom='$_POST[kolom]',
            //         allowcons='$_POST[allowcons]',
            //         estcons='$_POST[estcons]',
            //         totcons='$_POST[totcons]',
            //         qrs='$_POST[qrs]',
            //         pocons='$pocons',
            //         f1='$_POST[f1]',
            //         f2='$_POST[f2]',
            //         tpodt='1' where rkbpk='$_POST[rkbpk]'");

            // }

            // bdownqty='$_POST[bdownqty]',
            // bdownpk='$_POST[bdownpk]',
            // kolom='$_POST[kolom]',
            // allowcons='$_POST[allowcons]',
            // estcons='$_POST[estcons]',
            // totcons='$_POST[totcons]',
            // qrs='$_POST[qrs]',
            // pocons='$pocons',
            // f1='$_POST[f1]',
            // f2='$_POST[f2]',
            
            //revision
            // $insert = mysqli_query($koneksi, "update rpo set
            // ordpk='$_POST[ordpk]',
            // matusage='$nilai_usage',
            // nour='$_POST[nour]',
            // kelnm='$kelnm',
            // item='$item',
            // itemadd='$itemadd',
            // suppk='$suppk2',
            // sup='$sup',
            // tspec='$tspec',
            // nspec='$nspec',
            // spec='$spec',
            // specadd='$specadd',
            // hspec1='$_POST[hspec1]',
            // hspec2='$_POST[hspec2]',
            // hspec3='$_POST[hspec3]',
            // hspec4='$_POST[hspec4]',
            // hspec5='$_POST[hspec5]',
            // hspec6='$_POST[hspec6]',
            // hspec7='$_POST[hspec7]',
            // hspec8='$_POST[hspec8]',
            // spec1='$spec1',
            // spec2='$spec2',
            // spec3='$spec3',
            // spec4='$spec4',
            // spec5='$spec5',
            // spec6='$spec6',
            // spec7='$spec7',
            // spec8='$spec8',
            // colname='$colname',
            // colcode='$_POST[colcode]',
            // sizegar='$sizegar',
            // unit='$_POST[unit]',
            // price='$_POST[price2]',
            // curpk='$_POST[curpk]',
            // bdownqty='$_POST[bdownqty]',
            // bdownpk='$_POST[bdownpk]',
            // kolom='$_POST[kolom]',
            // allowcons='$_POST[allowcons]',
            // negocons='$_POST[negocons]',
            // estcons='$_POST[estcons]',
            // varcons='$_POST[varcons]',
            // totcons='$_POST[totcons]',
            // qrs='$_POST[qrs]',
            // pocons='$pocons',
            // f1='$_POST[f1]',
            // f2='$_POST[f2]' where rkbpk='$_POST[rkbpk]'");

            $update = mysqli_query($koneksi, "update po set stsrev='1', dateupdt=NOW(), tpo1='1', tpo2='1' where popk='$dt1[popk]'");

            if ($_POST['canbd'] == 1) {
                $updt = mysqli_query($koneksi, "update podt set bdownpk=NULL, kolom=NULL where rkbpk='$_POST[rkbpk]'");
            }
        } else {
        //revision
        if ($dt1['popk'] < 1) {
            $insert = mysqli_query($koneksi, "update rpo set
            ordpk='$_POST[ordpk]',
            matusage='$nilai_usage',
            nour='$_POST[nour]',
            kelnm='$kelnm',
            item='$item',
            itemadd='$itemadd',
            suppk='$suppk2',
            sup='$sup',
            tspec='$tspec',
            nspec='$nspec',
            spec='$spec',
            specadd='$specadd',
            hspec1='$_POST[hspec1]',
            hspec2='$_POST[hspec2]',
            hspec3='$_POST[hspec3]',
            hspec4='$_POST[hspec4]',
            hspec5='$_POST[hspec5]',
            hspec6='$_POST[hspec6]',
            hspec7='$_POST[hspec7]',
            hspec8='$_POST[hspec8]',
            spec1='$spec1',
            spec2='$spec2',
            spec3='$spec3',
            spec4='$spec4',
            spec5='$spec5',
            spec6='$spec6',
            spec7='$spec7',
            spec8='$spec8',
            colname='$colname',
            colcode='$_POST[colcode]',
            sizegar='$sizegar',
            unit='$_POST[unit]',
            price='$_POST[price2]',
            curpk='$_POST[curpk]',
            bdownqty='$_POST[bdownqty]',
            bdownpk='$_POST[bdownpk]',
            kolom='$_POST[kolom]',
            allowcons='$_POST[allowcons]',
            negocons='$_POST[negocons]',
            estcons='$_POST[estcons]',
            varcons='$_POST[varcons]',
            totcons='$_POST[totcons]',
            qrs='$_POST[qrs]',
            pocons='$pocons',
            f1='$_POST[f1]',
            f2='$_POST[f2]' where rkbpk='$_POST[rkbpk]'");

            if ($_POST['canbd'] == 1) {
                $updt = mysqli_query($koneksi, "update rpo set bdownpk=NULL, kolom=NULL where rkbpk='$_POST[rkbpk]'");
            }
        }
        }

        $cr2 = mysqli_query($koneksi, "select * from ord where ordpk='$_POST[ordpk]'");
        $dt2 = mysqli_fetch_array($cr2);
        $lognote = "User " . $userlog . " edit data material " . $item . " order " . $dt2['ordno'];
        $insert2 = mysqli_query($koneksi, "insert into logtran set
        logdtime=NOW(),
        logdate=NOW(),
        logtime=NOW(),
        logip='$ip',
        lognote='$lognote',
        ordpk='$_POST[ordpk]',
        rkbpk='$_POST[rkbpk]',
        sistem='$sistem'");
        echo "<div class='text-infohijau'>Material data updated &nbsp; &#10004; </div>";
    } else {
        if ($_POST['ext1'] > 0) {
            $suppk1 = $_POST['ext1'];
        } else {
            $suppk1 = $_POST['suppk'];
        }

        $dt = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM sup WHERE suppk='$suppk1'"));
        $sup = addslashes($dt['supnm']);

        $dtgroup = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mtype WHERE mtypepk='$_POST[mtype]'"));
        if ($dtgroup['mgroup'] == 1) {
            $kelnm = "CUTTING";
            $kelcode = "C";
        }
        if ($dtgroup['mgroup'] == 2) {
            $kelnm = "SEWING";
            $kelcode = "S";
        }
        if ($dtgroup['mgroup'] == 3) {
            $kelnm = "FINISHING/PACKING";
            $kelcode = "F";
        }
        if ($dtgroup['mgroup'] == 4) {
            $kelnm = "JASA";
            $kelcode = "J";
        }


        //itemcode
        if ($_POST['mtype']) {
            $dtcode = mysqli_fetch_array(mysqli_query($koneksi, "select * from mtype where mtypepk='$_POST[mtype]'"));
            $mcode = $dtcode['mcode'];
            $kata_pertama = explode(' ', $item)[0];
            $itemcode = $kelcode . "-" . $mcode . "-" . $kata_pertama;
        } else {
            $itemcode = "";
        }

        if ($itemcode <> "") {
            $dtitem = mysqli_fetch_array(mysqli_query($koneksi, "select * from itemcode where codenm='$itemcode'"));
            if ($dtitem['codepk'] > 0) {
                $updtcode = mysqli_query($koneksi, "update itemcode set itemnm='$item' where codepk='$dtitem[codepk]'");
            } else {
                $updtcode = mysqli_query($koneksi, "insert into itemcode set 
                    codenm='$itemcode',
                    itemnm='$item'");
            }
        }

        if ($_POST['canbd'] == 1) {
            $insert = mysqli_query($koneksi, "insert into rkb set
            ordpk='$_POST[ordpk]',
            matusage='$nilai_usage',
            nour='$nour',
            kelnm='$kelnm',
            mtypepk='$_POST[mtype]',
            codenm='$itemcode',
            item='$item',
            itemadd='$itemadd',
            suppk='$suppk1',
            sup='$sup',
            tspec='$tspec',
            nspec='$nspec',
            spec='$spec',
            specadd='$specadd',
            hspec1='$_POST[hspec1]',
            hspec2='$_POST[hspec2]',
            hspec3='$_POST[hspec3]',
            hspec4='$_POST[hspec4]',
            hspec5='$_POST[hspec5]',
            hspec6='$_POST[hspec6]',
            hspec7='$_POST[hspec7]',
            hspec8='$_POST[hspec8]',
            spec1='$spec1',
            spec2='$spec2',
            spec3='$spec3',
            spec4='$spec4',
            spec5='$spec5',
            spec6='$spec6',
            spec7='$spec7',
            spec8='$spec8',
            colname='$colname',
            colcode='$_POST[colcode]',
            sizegar='$sizegar',
            cw='$cw',
            gsm='$gsm',
            unit='$_POST[unit]',
            price='$_POST[price2]',
            curpk='$_POST[curpk]',
            bdownqty='$_POST[bdownqty]',
            allowcons='$_POST[allowcons]',
            allowman='$_POST[allowman]',
            negocons='$_POST[negocons]',
            estcons='$_POST[estcons]',
            varcons='$_POST[varcons]',
            totcons='$_POST[totcons]',
            qrs='$_POST[qrs]',
            pocons='$pocons',
            status='$sts',
            hari1=NOW(),
            hari2='$next',
            f1='$_POST[f1]',
            f2='$_POST[f2]'");
        } else {
            $insert = mysqli_query($koneksi, "insert into rkb set
            ordpk='$_POST[ordpk]',
            matusage='$nilai_usage',
            nour='$nour',
            kelnm='$kelnm',
            mtypepk='$_POST[mtype]',
            codenm='$itemcode',
            item='$item',
            itemadd='$itemadd',
            suppk='$suppk1',
            sup='$sup',
            tspec='$tspec',
            nspec='$nspec',
            spec='$spec',
            specadd='$specadd',
            hspec1='$_POST[hspec1]',
            hspec2='$_POST[hspec2]',
            hspec3='$_POST[hspec3]',
            hspec4='$_POST[hspec4]',
            hspec5='$_POST[hspec5]',
            hspec6='$_POST[hspec6]',
            hspec7='$_POST[hspec7]',
            hspec8='$_POST[hspec8]',
            spec1='$spec1',
            spec2='$spec2',
            spec3='$spec3',
            spec4='$spec4',
            spec5='$spec5',
            spec6='$spec6',
            spec7='$spec7',
            spec8='$spec8',
            colname='$colname',
            colcode='$_POST[colcode]',
            sizegar='$sizegar',
            cw='$cw',
            gsm='$gsm',
            unit='$_POST[unit]',
            price='$_POST[price2]',
            curpk='$_POST[curpk]',
            bdownqty='$_POST[bdownqty]',
            bdownpk='$_POST[bdownpk]',
            kolom='$_POST[kolom]',
            allowcons='$_POST[allowcons]',
            allowman='$_POST[allowman]',
            negocons='$_POST[negocons]',
            estcons='$_POST[estcons]',
            varcons='$_POST[varcons]',
            totcons='$_POST[totcons]',
            qrs='$_POST[qrs]',
            pocons='$pocons',
            status='$sts',
            hari1=NOW(),
            hari2='$next',
            f1='$_POST[f1]',
            f2='$_POST[f2]'");
        }

        $cr2 = mysqli_query($koneksi, "select * from ord where ordpk='$_POST[ordpk]'");
        $dt2 = mysqli_fetch_array($cr2);
        $lognote = "User " . $userlog . " tambah data material " . $item . " order " . $dt2['ordno'];
        $insert2 = mysqli_query($koneksi, "insert into logtran set
            logdtime=NOW(),
            logdate=NOW(),
            logtime=NOW(),
            logip='$ip',
            lognote='$lognote',
            ordpk='$_POST[ordpk]',
            sistem='$sistem'");
        echo "<div class='text-infohijau'>Material data saved &nbsp; &#10004; </div>";
    }
}

if ($_GET['x'] == "copy") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $sql = "select * from rkb where rkbpk='$id'";
        $result = @mysqli_query($koneksi, $sql);
        $sql2 = mysqli_query($koneksi, "select * from rkb where rkbpk='$id'");
        while ($dt = mysqli_fetch_array($sql2)) {
            //$sql2b = mysqli_query($koneksi,"select * from rkb where ordpk='$dt[ordpk]' order by nour desc limit 1");
            //$dtb= mysqli_fetch_array($sql2b);

            $item = addslashes($dt['item']);
            $itemadd = addslashes($dt['itemadd']);
            $spec = addslashes($dt['spec']);
            $specadd = addslashes($dt['specadd']);
            $sup = addslashes($dt['sup']);
            $spec1 = addslashes($dt['spec1']);
            $spec2 = addslashes($dt['spec2']);
            $spec3 = addslashes($dt['spec3']);
            $spec4 = addslashes($dt['spec4']);
            $spec5 = addslashes($dt['spec5']);
            $spec6 = addslashes($dt['spec6']);
            $spec7 = addslashes($dt['spec7']);
            $spec8 = addslashes($dt['spec8']);
            $sizegar = addslashes($dt['sizegar']);
            $colname = addslashes($dt['colname']);
            //$nour=$dtb['nour']+1;

            $insert = mysqli_query($koneksi, "insert into rkb set
            ordpk='$dt[ordpk]',
            nour='$dt[nour]',
            kelnm='$dt[kelnm]',
            mtypepk='$dt[mtypepk]',
            codenm='$dt[codenm]',
            item='$item',
            itemadd='$itemadd',
            suppk='$dt[suppk]',
            sup='$sup',
            tspec='$dt[tspec]',
            nspec='$dt[nspec]',
            spec='$spec',
            specadd='$specadd',
            hspec1='$dt[hspec1]',
            hspec2='$dt[hspec2]',
            hspec3='$dt[hspec3]',
            hspec4='$dt[hspec4]',
            hspec5='$dt[hspec5]',
            hspec6='$dt[hspec6]',
            hspec7='$dt[hspec7]',
            hspec8='$dt[hspec8]',
            spec1='$spec1',
            spec2='$spec2',
            spec3='$spec3',
            spec4='$spec4',
            spec5='$spec5',
            spec6='$spec6',
            spec7='$spec7',
            spec8='$spec8',
            colname='$colname',
            colcode='$dt[colcode]',
            sizegar='$sizegar',
            unit='$dt[unit]',
            price='$dt[price]',
            curpk='$dt[curpk]',
            bdownqty='$dt[bdownqty]',
            allowcons='$dt[allowcons]',
            allowman='$dt[allowman]',
            negocons='$dt[negocons]',
            estcons='$dt[estcons]',
            varcons='$dt[varcons]',
            totcons='$dt[totcons]',
            qrs='$dt[qrs]',
            pocons='$dt[pocons]',
            status='1',
            copy='1',
            matusage = '$dt[matusage]',
            hari1=NOW(),
            hari2='$next'");
        }
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau'>Material data copyed &nbsp; &#10004; </div>"));
        } else {
            echo json_encode(array('msg' => "<div class='text-infomerah'>There is error copy &nbsp; &#x2573; </div>"));
        }
    }
}

if ($_GET['x'] == "copyto") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $result = mysqli_query($koneksi, "update rkb set copy='3' where rkbpk='$id'");
        $sukses++;
        if ($sukses > 0) {
            echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau'> $_GET[count] Item processed for copy &nbsp; &#10004; </div>"));
        } else {
            echo json_encode(array('msg' => "<div class='text-infomerah'>There is error process copy &nbsp; &#x2573; </div>"));
        }
    }
}

if ($_GET['x'] == "export") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $cr = mysqli_query($koneksi, "select * from rkb where ordpk='$_GET[ordpk]' and copy='3'");
        while ($dt = mysqli_fetch_array($cr)) {
            $sql2b = mysqli_query($koneksi, "select * from rkb where ordpk='$id' order by nour desc limit 1");
            $dtb = mysqli_fetch_array($sql2b);

            $item = addslashes($dt['item']);
            $itemadd = addslashes($dt['itemadd']);
            $spec = addslashes($dt['spec']);
            $specadd = addslashes($dt['specadd']);
            $sup = addslashes($dt['sup']);
            $spec1 = addslashes($dt['spec1']);
            $spec2 = addslashes($dt['spec2']);
            $spec3 = addslashes($dt['spec3']);
            $spec4 = addslashes($dt['spec4']);
            $spec5 = addslashes($dt['spec5']);
            $spec6 = addslashes($dt['spec6']);
            $spec7 = addslashes($dt['spec7']);
            $spec8 = addslashes($dt['spec8']);
            $sizegar = addslashes($dt['sizegar']);
            $colname = addslashes($dt['colname']);
            $nour = $dtb['nour'] + 1;

            $insert = mysqli_query($koneksi, "insert into rkb set
    ordpk='$id',
    nour='$nour',
    kelnm='$dt[kelnm]',
    mtypepk='$dt[mtypepk]',
    codenm='$dt[codenm]',
    item='$item',
    itemadd='$itemadd',
    suppk='$dt[suppk]',
    sup='$sup',
    tspec='$dt[tspec]',
    nspec='$dt[nspec]',
    spec='$spec',
    specadd='$specadd',
    hspec1='$dt[hspec1]',
    hspec2='$dt[hspec2]',
    hspec3='$dt[hspec3]',
    hspec4='$dt[hspec4]',
    hspec5='$dt[hspec5]',
    hspec6='$dt[hspec6]',
    hspec7='$dt[hspec7]',
    hspec8='$dt[hspec8]',
    spec1='$spec1',
    spec2='$spec2',
    spec3='$spec3',
    spec4='$spec4',
    spec5='$spec5',
    spec6='$spec6',
    spec7='$spec7',
    spec8='$spec8',
    colname='$colname',
    colcode='$dt[colcode]',
    sizegar='$sizegar',
    unit='$dt[unit]',
    price='$dt[price]',
    curpk='$dt[curpk]',
    bdownqty='$dt[bdownqty]',
    allowcons='$dt[allowcons]',
    allowman='$dt[allowman]',
    negocons='$dt[negocons]',
    estcons='$dt[estcons]',
    varcons='$dt[varcons]',
    totcons='$dt[totcons]',
    qrs='$dt[qrs]',
    pocons='$dt[pocons]',
    status='1',
    copy='4',
    matusage = '$dt[matusage]',
    hari1=NOW(),
    hari2='$next'");
            if ($insert)
                $sukses++;
        }
    }
    if ($sukses) {
        $cr2 = mysqli_query($koneksi, "select * from ord where ordpk='$_GET[ordpk]'");
        $dt2 = mysqli_fetch_array($cr2);
        $lognote = "User " . $userlog . " export data material order " . $dt2['ordno'];
        $insert2 = mysqli_query($koneksi, "insert into logtran set
    logdtime=NOW(),
    logdate=NOW(),
    logtime=NOW(),
    logip='$ip',
    lognote='$lognote',
    ordpk='$_GET[ordpk]',
    sistem='$sistem'");
        echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:285px;'> Materials successfully exported &nbsp; &#x2573; </div>"));
    } else {
        echo json_encode(array('msg' => "<div class='text-infomerah'>There is error export &nbsp; &#x2573; </div>"));
    }
}

if ($_GET['x'] == "cancopy") {
    $result = mysqli_query($koneksi, "update rkb set copy='0' where ordpk='$_POST[ordpk]' and copy='3'");
    echo "<div class='text-infomerah'>Export materials cancelled &nbsp; &#x2573; </div>";
}

if ($_GET['x'] == "copyto2") {
    $cr = mysqli_query($koneksi, "select * from rkb where copy='1' and ordpk='$_POST[ordpk]'");
    while ($dt = mysqli_fetch_array($cr)) {
        $item = addslashes($dt['item']);
        $itemadd = addslashes($dt['itemadd']);
        $spec = addslashes($dt['spec']);
        $specadd = addslashes($dt['specadd']);
        $sup = addslashes($dt['sup']);
        $spec1 = addslashes($dt['spec1']);
        $spec2 = addslashes($dt['spec2']);
        $spec3 = addslashes($dt['spec3']);
        $spec4 = addslashes($dt['spec4']);
        $spec5 = addslashes($dt['spec5']);
        $spec6 = addslashes($dt['spec6']);
        $spec7 = addslashes($dt['spec7']);
        $spec8 = addslashes($dt['spec8']);
        $sizegar = addslashes($dt['sizegar']);
        $colname = addslashes($dt['colname']);

        $insert = mysqli_query($koneksi, "insert into rkb set
        ordpk='$_GET[ordpk]',
        nour='$dt[nour]',
        kelnm='$dt[kelnm]',
        mtypepk='$dt[mtypepk]',
        codenm='$dt[codenm]',
        item='$item',
        itemadd='$itemadd',
        suppk='$dt[suppk]',
        sup='$sup',
        tspec='$dt[tspec]',
        nspec='$dt[nspec]',
        spec='$spec',
        specadd='$specadd',
        hspec1='$dt[hspec1]',
        hspec2='$dt[hspec2]',
        hspec3='$dt[hspec3]',
        hspec4='$dt[hspec4]',
        hspec5='$dt[hspec5]',
        hspec6='$dt[hspec6]',
        hspec7='$dt[hspec7]',
        hspec8='$dt[hspec8]',
        spec1='$spec1',
        spec2='$spec2',
        spec3='$spec3',
        spec4='$spec4',
        spec5='$spec5',
        spec6='$spec6',
        spec7='$spec7',
        spec8='$spec8',
        colname='$colname',
        colcode='$dt[colcode]',
        sizegar='$sizegar',
        unit='$dt[unit]',
        price='$dt[price]',
        curpk='$dt[curpk]',
        bdownqty='$dt[bdownqty]',
        allowcons='$dt[allowcons]',
        allowman='$dt[allowman]',
        negocons='$dt[negocons]',
        estcons='$dt[estcons]',
        varcons='$dt[varcons]',
        totcons='$dt[totcons]',
        qrs='$dt[qrs]',
        pocons='$dt[pocons]',
        status='1',
        copy='2',
        matusage = '$dt[matusage]',
        hari1=NOW(),
        hari2='$next'");
    }
    $result = mysqli_query($koneksi, "update rkb set copy='0' where ordpk='$_POST[ordpk]' and copy='1'");
    echo "<div class='text-infohijau'> $_POST[tot] Material data copyed &nbsp; &#x2573; </div>";
}

if ($_GET['x'] == "import") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $cr = mysqli_query($koneksi, "select * from rkb where rkbpk='$id'");
        while ($dt = mysqli_fetch_array($cr)) {
            $sql2b = mysqli_query($koneksi, "select * from rkb where ordpk='$_GET[ordpk]' order by nour desc limit 1");
            $dtb = mysqli_fetch_array($sql2b);

            $item = addslashes($dt['item']);
            $itemadd = addslashes($dt['itemadd']);
            $spec = addslashes($dt['spec']);
            $specadd = addslashes($dt['specadd']);
            $sup = addslashes($dt['sup']);
            $spec1 = addslashes($dt['spec1']);
            $spec2 = addslashes($dt['spec2']);
            $spec3 = addslashes($dt['spec3']);
            $spec4 = addslashes($dt['spec4']);
            $spec5 = addslashes($dt['spec5']);
            $spec6 = addslashes($dt['spec6']);
            $spec7 = addslashes($dt['spec7']);
            $spec8 = addslashes($dt['spec8']);
            $sizegar = addslashes($dt['sizegar']);
            $colname = addslashes($dt['colname']);
            $nour = $dtb['nour'] + 1;

            $insert = mysqli_query($koneksi, "insert into rkb set
                ordpk='$_GET[ordpk]',
                nour='$nour',
                kelnm='$dt[kelnm]',
                mtypepk='$dt[mtypepk]',
                codenm='$dt[codenm]',
                item='$item',
                itemadd='$itemadd',
                suppk='$dt[suppk]',
                sup='$sup',
                tspec='$dt[tspec]',
                nspec='$dt[nspec]',
                spec='$spec',
                specadd='$specadd',
                hspec1='$dt[hspec1]',
                hspec2='$dt[hspec2]',
                hspec3='$dt[hspec3]',
                hspec4='$dt[hspec4]',
                hspec5='$dt[hspec5]',
                hspec6='$dt[hspec6]',
                hspec7='$dt[hspec7]',
                hspec8='$dt[hspec8]',
                spec1='$spec1',
                spec2='$spec2',
                spec3='$spec3',
                spec4='$spec4',
                spec5='$spec5',
                spec6='$spec6',
                spec7='$spec7',
                spec8='$spec8',
                colname='$colname',
                colcode='$dt[colcode]',
                sizegar='$sizegar',
                unit='$dt[unit]',
                price='$dt[price]',
                curpk='$dt[curpk]',
                bdownqty='$dt[bdownqty]',
                allowcons='$dt[allowcons]',
                allowman='$dt[allowman]',
                negocons='$dt[negocons]',
                estcons='$dt[estcons]',
                varcons='$dt[varcons]',
                totcons='$dt[totcons]',
                qrs='$dt[qrs]',
                pocons='$dt[pocons]',
                status='1',
                copy='2',
                matusage = '$dt[matusage]',
                hari1=NOW(),
                hari2='$next'");
            if ($insert)
                $sukses++;
        }
    }

    if ($sukses) {
        $cr2 = mysqli_query($koneksi, "select * from ord where ordpk='$_GET[ordpk]'");
        $dt2 = mysqli_fetch_array($cr2);
        $lognote = "User " . $userlog . " import data material order " . $dt2['ordno'];
        $insert2 = mysqli_query($koneksi, "insert into logtran set
            logdtime=NOW(),
            logdate=NOW(),
            logtime=NOW(),
            logip='$ip',
            lognote='$lognote',
            ordpk='$_GET[ordpk]',
            sistem='$sistem'");
        echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:285px;'> $suksess Data Imported Successfully &nbsp; &#x2573; </div>"));
    } else {
        echo json_encode(array('msg' => "<div class='text-infomerah'>There is error import &nbsp; &#x2573; </div>"));
    }
}

if ($_GET['x'] == "cancelreq1") {
    $cr = mysqli_query($koneksi, "select * from rkb where rkbpk='$_POST[rkbpk]'");
    while ($dt = mysqli_fetch_array($cr)) {
        $result2 = mysqli_query($koneksi, "delete from rpo where rkbpk='$dt[rkbpk]'");
    }
    $result = mysqli_query($koneksi, "update rkb set
        submit=NULL,
        submitdate=NULL,
        poreqdel=NULL,
        podel=NULL,
        stspk=NULL,
        status='2',
        rkbsts='0' where rkbpk='$_POST[rkbpk]'");
    echo "<div class='text-infomerah'>Cancel request PO &nbsp; &#x2573; </div>";
}

if ($_GET['x'] == "req") {
    $row = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb WHERE rkbpk='$_POST[rkbpk]' and status='2'"));
    if ($row > 0) {
        $update = mysqli_query($koneksi, "update rkb set
            submit='1',
            submitdate=NOW(),
            poreqdel='$_POST[poreqdel]',
            podel='$_POST[poreqdel]',
            stspk='1',
            status='4',
            rkbsts='1' where rkbpk='$_POST[rkbpk]'");
        $cr = mysqli_query($koneksi, "select * from rkb where rkbpk='$_POST[rkbpk]'");
        $dt = mysqli_fetch_array($cr);
        $item = addslashes($dt['item']);
        $itemadd = addslashes($dt['itemadd']);
        $spec = addslashes($dt['spec']);
        $specadd = addslashes($dt['specadd']);
        $sup = addslashes($dt['sup']);
        $spec1 = addslashes($dt['spec1']);
        $spec2 = addslashes($dt['spec2']);
        $spec3 = addslashes($dt['spec3']);
        $spec4 = addslashes($dt['spec4']);
        $spec5 = addslashes($dt['spec5']);
        $spec6 = addslashes($dt['spec6']);
        $spec7 = addslashes($dt['spec7']);
        $spec8 = addslashes($dt['spec8']);
        $sizegar = addslashes($dt['sizegar']);
        $colname = addslashes($dt['colname']);

        $insert = mysqli_query($koneksi, "insert into rpo set
            ordpk='$dt[ordpk]',
            rkbpk='$dt[rkbpk]',
            nour='$dt[nour]',
            tgljam=NOW(),
            tgl=NOW(),
            submit='$dt[submit]',
            submitdate='$dt[submitdate]',
            kelnm='$dt[kelnm]',
            item='$item',
            itemadd='$itemadd',
            suppk='$dt[suppk]',
            sup='$sup',
            tspec='$dt[tspec]',
            nspec='$dt[nspec]',
            spec='$spec',
            specadd='$specadd',
            hspec1='$dt[hspec1]',
            hspec2='$dt[hspec2]',
            hspec3='$dt[hspec3]',
            hspec4='$dt[hspec4]',
            hspec5='$dt[hspec5]',
            hspec6='$dt[hspec6]',
            hspec7='$dt[hspec7]',
            hspec8='$dt[hspec8]',
            spec1='$spec1',
            spec2='$spec2',
            spec3='$spec3',
            spec4='$spec4',
            spec5='$spec5',
            spec6='$spec6',
            spec7='$spec7',
            spec8='$spec8',
            colname='$colname',
            colcode='$dt[colcode]',
            sizegar='$sizegar',
            unit='$dt[unit]',
            price='$dt[price]',
            curpk='$dt[curpk]',
            bdownqty='$dt[bdownqty]',
            bdownpk='$dt[bdownpk]',
            kolom='$dt[kolom]',
            allowcons='$dt[allowcons]',
            negocons='$dt[negocons]',
            estcons='$dt[estcons]',
            varcons='$dt[varcons]',
            totcons='$dt[totcons]',
            qrs='$dt[qrs]',
            pocons='$dt[pocons]',
            poreqdel='$_POST[poreqdel]',
            stspk='$dt[stspk]',
            f1='$dt[f1]',
            f2='$dt[f2]',
            matusage = '$dt[matusage]'");
        /*$cr2=mysqli_query($koneksi,"select * from rpo where tgl='$date' and email='0' and hari is null and posts='0'");
        while($dt2=mysqli_fetch_array($cr2)){
        if($dt2['kelnm']=="CUTTING"){
        //include "../email/index.php?id=req&mat=1&fu=$_POST[fu]"; 
        } else {
        //include "../email/index.php?id=req&mat=2&fu=$_POST[fu]";     
        }
        }
        //$result3 = mysqli_query($koneksi,"update rpo set email='1', hari='$next' where tgl='$date' and email='0' and hari is null and posts='0'");*/

        echo "<div class='text-infohijau' style='width:415px;'>PO request sent! &nbsp; &#10004; </div>";
    } else {
        echo "<div class='text-infomerah' style='width:415px;'>Cannot process because some items are incomplete &nbsp; &#x2573; </div>";
    }
}

if ($_GET['x'] == "cancelreq2") {
    $cr = mysqli_query($koneksi, "select * from rkb where rkbpk='$_POST[rkbpk]'");
    while ($dt = mysqli_fetch_array($cr)) {
        $result2 = mysqli_query($koneksi, "delete from rpo where rkbpk='$dt[rkbpk]'");
    }
    $result = mysqli_query($koneksi, "update rkb set
        submit=NULL,
        submitdate=NULL,
        poreqdel=NULL,
        podel=NULL,
        stspk=NULL,
        status='3',
        rkbsts='0' where rkbpk='$_POST[rkbpk]'");
    echo "<div class='text-infomerah'>Cancel request PO &nbsp; &#x2573; </div>";
}

if ($_GET['x'] == "req3") {
    $row = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb WHERE rkbpk='$_POST[rkbpk]' and status='3'"));
    /*$cr2=mysqli_query($koneksi,"select * from rkb WHERE rkbpk='$_POST[rkbpk]' and status='3'");
    $dt2=mysqli_fetch_array($cr2);*/
    if ($row > 0) {
        /*if($dt2['popk']>0){
        $update=mysqli_query($koneksi,"update rkb set
        stspk='2',
        status='5' where rkbpk='$_POST[rkbpk]'");
        $update2=mysqli_query($koneksi,"update memo set
        cek='2',
        tgl1b=NOW(),
        tgl2b=NOW() where rkbpk='$_POST[rkbpk]' and cek='1'");
        } else {*/
        $update = mysqli_query($koneksi, "update rkb set
            submit='1',
            submitdate=NOW(),
            poreqdel='$_POST[poreqdel]',
            podel='$_POST[poreqdel]',
            stspk='1',
            status='4',
            rkbsts='1' where rkbpk='$_POST[rkbpk]'");
        $update2 = mysqli_query($koneksi, "update memo set
            cek='2',
            tgl1b=NOW(),
            tgl2b=NOW() where rkbpk='$_POST[rkbpk]' and cek='1'");
        $cr = mysqli_query($koneksi, "select * from rkb where rkbpk='$_POST[rkbpk]'");
        $dt = mysqli_fetch_array($cr);
        $item = addslashes($dt['item']);
        $itemadd = addslashes($dt['itemadd']);
        $spec = addslashes($dt['spec']);
        $specadd = addslashes($dt['specadd']);
        $sup = addslashes($dt['sup']);
        $spec1 = addslashes($dt['spec1']);
        $spec2 = addslashes($dt['spec2']);
        $spec3 = addslashes($dt['spec3']);
        $spec4 = addslashes($dt['spec4']);
        $spec5 = addslashes($dt['spec5']);
        $spec6 = addslashes($dt['spec6']);
        $spec7 = addslashes($dt['spec7']);
        $spec8 = addslashes($dt['spec8']);
        $sizegar = addslashes($dt['sizegar']);
        $colname = addslashes($dt['colname']);

        $insert = mysqli_query($koneksi, "insert into rpo set
                ordpk='$dt[ordpk]',
                rkbpk='$dt[rkbpk]',
                nour='$dt[nour]',
                tgljam=NOW(),
                tgl=NOW(),
                submit='$dt[submit]',
                submitdate='$dt[submitdate]',
                kelnm='$dt[kelnm]',
                item='$item',
                itemadd='$itemadd',
                suppk='$dt[suppk]',
                sup='$sup',
                tspec='$dt[tspec]',
                nspec='$dt[nspec]',
                spec='$spec',
                specadd='$specadd',
                hspec1='$dt[hspec1]',
                hspec2='$dt[hspec2]',
                hspec3='$dt[hspec3]',
                hspec4='$dt[hspec4]',
                hspec5='$dt[hspec5]',
                hspec6='$dt[hspec6]',
                hspec7='$dt[hspec7]',
                hspec8='$dt[hspec8]',
                spec1='$spec1',
                spec2='$spec2',
                spec3='$spec3',
                spec4='$spec4',
                spec5='$spec5',
                spec6='$spec6',
                spec7='$spec7',
                spec8='$spec8',
                colname='$colname',
                colcode='$dt[colcode]',
                sizegar='$sizegar',
                unit='$dt[unit]',
                price='$dt[price]',
                curpk='$dt[curpk]',
                bdownqty='$dt[bdownqty]',
                bdownpk='$dt[bdownpk]',
                kolom='$dt[kolom]',
                allowcons='$dt[allowcons]',
                negocons='$dt[negocons]',
                estcons='$dt[estcons]',
                varcons='$dt[varcons]',
                totcons='$dt[totcons]',
                qrs='$dt[qrs]',
                pocons='$dt[pocons]',
                poreqdel='$_POST[poreqdel]',
                stspk='$dt[stspk]',
                f1='$dt[f1]',
                f2='$dt[f2]'
                matusage = '$dt[matusage]'");
        /*$cr2=mysqli_query($koneksi,"select * from rpo where tgl='$date' and email='0' and hari is null and posts='0'");
        while($dt2=mysqli_fetch_array($cr2)){
        if($dt2['kelnm']=="CUTTING"){
        //include "../email/index.php?id=req&mat=1&fu=$_POST[fu]"; 
        } else {
        //include "../email/index.php?id=req&mat=2&fu=$_POST[fu]";     
        }
        }
        //$result3 = mysqli_query($koneksi,"update rpo set email='1', hari='$next' where tgl='$date' and email='0' and hari is null and posts='0'");*/

        echo "<div class='text-infohijau' style='width:415px;'>PO request sent! &nbsp; &#10004; </div>";
        //}
    } else {
        echo "<div class='text-infomerah' style='width:415px;'>Cannot process because some items are incomplete &nbsp; &#x2573; </div>";
    }
}

if ($_GET['x'] == "req4") {
    $sql = mysqli_query($koneksi, "select * from rkb where popk='$_GET[popk]'");
    while ($dt = mysqli_fetch_array($sql)) {
        $update1 = mysqli_query($koneksi, "update rkb set
        stspk='5',
        status='4' where rkbpk='$dt[rkbpk]'");
        $update2 = mysqli_query($koneksi, "update rpo set stspk='5' where rkbpk='$dt[rkbpk]'");
        $update3 = mysqli_query($koneksi, "update podt set stspk='5' where rkbpk='$dt[rkbpk]'");
        $update4 = mysqli_query($koneksi, "update memo set
        cek='2',
        tgl1b=NOW(),
        tgl2b=NOW() where rkbpk='$dt[rkbpk]' and cek='1'");
    }
    //$update5=mysqli_query($koneksi,"update po set postatpk='1' where popk='$_GET[popk]'");
    echo "<div class='text-infohijau'>Revised material success &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "req2") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $row = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb WHERE rkbpk='$id' and status between '2' and '3'"));
        $cr = mysqli_query($koneksi, "select * from rkb WHERE rkbpk='$id' and status between '2' and '3'");
        $dt = mysqli_fetch_array($cr);
        if ($row > 0) {
            if ($dt['popk'] > 0) {
                $update1 = mysqli_query($koneksi, "update rkb set
                    stspk='5',
                    status='4' where rkbpk='$dt[rkbpk]'");
                $update2 = mysqli_query($koneksi, "update rpo set stspk='5' where rkbpk='$dt[rkbpk]'");
                $update3 = mysqli_query($koneksi, "update podt set stspk='5' where rkbpk='$dt[rkbpk]'");
                $update4 = mysqli_query($koneksi, "update memo set
                cek='2',
                tgl1b=NOW(),
                tgl2b=NOW() where rkbpk='$dt[rkbpk]' and cek='1'");
            } else {
                /*$update=mysqli_query($koneksi,"update rkb set
                submit='1',
                submitdate=NOW(),
                poreqdel='$_POST[poreqdel]',
                podel='$_POST[poreqdel]',
                stspk='1',
                status='4',
                rkbsts='1' where rkbpk='$id'");*/

                $update2 = mysqli_query($koneksi, "update memo set
                            cek='2',
                            tgl1b=NOW(),
                            tgl2b=NOW() where rkbpk='$id' and cek='1'");

                /*$result = @mysqli_query($koneksi,"update rkb set
                submit='1',
                submitdate=NOW(),
                poreqdel='$_POST[poreqdel]',
                podel='$_POST[poreqdel]',
                stspk='1',
                status='4',
                rkbsts='1' where rkbpk='$id'");*/
                $result = @mysqli_query($koneksi, "update rkb set
                        submit='1',
                        submitdate=NOW(),
                        stspk='1' where rkbpk='$id'");
                $cr = mysqli_query($koneksi, "select * from rkb where rkbpk='$id'");
                $dt = mysqli_fetch_array($cr);
                $item = addslashes($dt['item']);
                $itemadd = addslashes($dt['itemadd']);
                $spec = addslashes($dt['spec']);
                $specadd = addslashes($dt['specadd']);
                $sup = addslashes($dt['sup']);
                $spec1 = addslashes($dt['spec1']);
                $spec2 = addslashes($dt['spec2']);
                $spec3 = addslashes($dt['spec3']);
                $spec4 = addslashes($dt['spec4']);
                $spec5 = addslashes($dt['spec5']);
                $spec6 = addslashes($dt['spec6']);
                $spec7 = addslashes($dt['spec7']);
                $spec8 = addslashes($dt['spec8']);
                $sizegar = addslashes($dt['sizegar']);
                $colname = addslashes($dt['colname']);

                $insert = mysqli_query($koneksi, "insert into rpo set
                ordpk='$dt[ordpk]',
                rkbpk='$dt[rkbpk]',
                nour='$dt[nour]',
                tgljam=NOW(),
                tgl=NOW(),
                submit='$dt[submit]',
                submitdate='$dt[submitdate]',
                kelnm='$dt[kelnm]',
                item='$item',
                itemadd='$itemadd',
                suppk='$dt[suppk]',
                sup='$sup',
                tspec='$dt[tspec]',
                nspec='$dt[nspec]',
                spec='$spec',
                specadd='$specadd',
                hspec1='$dt[hspec1]',
                hspec2='$dt[hspec2]',
                hspec3='$dt[hspec3]',
                hspec4='$dt[hspec4]',
                hspec5='$dt[hspec5]',
                hspec6='$dt[hspec6]',
                hspec7='$dt[hspec7]',
                hspec8='$dt[hspec8]',
                spec1='$spec1',
                spec2='$spec2',
                spec3='$spec3',
                spec4='$spec4',
                spec5='$spec5',
                spec6='$spec6',
                spec7='$spec7',
                spec8='$spec8',
                colname='$colname',
                colcode='$dt[colcode]',
                sizegar='$sizegar',
                unit='$dt[unit]',
                price='$dt[price]',
                curpk='$dt[curpk]',
                bdownqty='$dt[bdownqty]',
                bdownpk='$dt[bdownpk]',
                kolom='$dt[kolom]',
                allowcons='$dt[allowcons]',
                negocons='$dt[negocons]',
                varcons='$dt[varcons]',
                estcons='$dt[estcons]',
                totcons='$dt[totcons]',
                qrs='$dt[qrs]',
                pocons='$dt[pocons]',
                stspk='$dt[stspk]',
                f1='$dt[f1]',
                f2='$dt[f2]',
                matusage = '$dt[matusage]'");
            }
            if ($result) {
                echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:415px;'>PO request sent! &nbsp; &#10004; </div>"));
            } else {
                echo json_encode(array('msg' => "<div class='text-infomerah' style='width:415px;'>There is error request &nbsp; &#x2573; </div>"));
            }
        } else {
            echo json_encode(array('msg' => "<div class='text-infomerah' style='width:415px;'>Cannot process because some items are incomplete &nbsp; &#x2573; </div>"));
        }
    }
}

if ($_GET['x'] == "cancelreq") {
    $cr = mysqli_query($koneksi, "select * from rkb where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and poreqdel is null and status='2'");
    while ($dt = mysqli_fetch_array($cr)) {
        $result2 = mysqli_query($koneksi, "delete from rpo where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and poreqdel is null and rkbpk='$dt[rkbpk]'");
    }
    $result = mysqli_query($koneksi, "update rkb set
                submit=NULL,
                submitdate=NULL,
                stspk=NULL,
                rkbsts='0'
                where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and poreqdel is null and status='2'");
    echo "<div class='text-infomerah'>Cancel request PO &nbsp; &#x2573; </div>";
}

if ($_GET['x'] == "req2b") {
    $cr = mysqli_query($koneksi, "select * from rkb where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and poreqdel is null and status between '2' and '3'");
    while ($dt = mysqli_fetch_array($cr)) {
        $result2 = mysqli_query($koneksi, "update rpo set poreqdel='$_POST[poreqdel]'
        where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and poreqdel is null and rkbpk='$dt[rkbpk]'");
    }
    $result = mysqli_query($koneksi, "update rkb set poreqdel='$_POST[poreqdel]', podel='$_POST[poreqdel]', status='4', rkbsts='1'
        where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and poreqdel is null and status='2'");
    /*$cr2=mysqli_query($koneksi,"select * from rpo where tgl='$date' and email='0' and hari is null and posts='0'");
    while($dt2=mysqli_fetch_array($cr2)){
    if($dt2['kelnm']=="CUTTING"){
    //include "../email/index.php?id=req&mat=1&fu=$_POST[fu]"; 
    } else {
    //include "../email/index.php?id=req&mat=2&fu=$_POST[fu]";     
    }
    }
    $result3 = mysqli_query($koneksi,"update rpo set email='1', hari='$next' where tgl='$date' and email='0' and hari is null and posts='0'");*/
    if ($result) {
        echo "<div class='text-infohijau' style='width:415px;'>PO request sent! &nbsp; &#10004; </div>";
    } else {
        echo "<div class='text-infomerah' style='width:415px;'>Cannot process because some items are incomplete &nbsp; &#x2573; </div>";
    }
}

if ($_GET['x'] == "revisi") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $row = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rpo WHERE rkbpk='$id' and stspk='1'"));
        if ($row > 0) {
            /*$result = @mysqli_query($koneksi,"update rkb set
            submitdate=NULL,
            poreqdel=NULL,
            podel=NULL,
            stspk=NULL,
            status='3' where rkbpk='$id'");*/
            /*$cr=mysqli_query($koneksi,"select * from rkb where rkbpk='$id'");
            $dt=mysqli_fetch_array($cr);*/
            /*$delete=mysqli_query($koneksi,"delete from rpo WHERE rkbpk='$id' and stspk='1'");*/
            $result = mysqli_query($koneksi, "insert into memo set
            rkbpk='$id',
            tgl2=NOW(),
            tgl1=NOW(),
            user='$_GET[user]',
            fupk='$_GET[fu]',
            cek='1'");
            if ($result) {
                echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:415px;'>Item sent back to MD for revision &nbsp; &#10004; </div>"));
            } else {
                echo json_encode(array('msg' => "<div class='text-infomerah' style='width:415px;'>There is error revision &nbsp; &#x2573; </div>"));
            }
        } else {
            echo json_encode(array('msg' => "<div class='text-infomerah' style='width:415px;'>Cannot process submit revision &nbsp; &#x2573; </div>"));
        }
    }
}

if ($_GET['x'] == "cancelrev") {
    $result = mysqli_query($koneksi, "delete from memo
    where cek='1' and user='$_POST[user]' and fupk='$_POST[fu]' and memonm is null and tgl1='$date'");
    echo "<div class='text-infomerah'>Cancel revision &nbsp; &#x2573; </div>";
}

if ($_GET['x'] == "revisi2") {
    //include "../email/index.php?id=rev1&user=$_POST[user]&fu=$_POST[fu]";
    $cr = mysqli_query($koneksi, "select * from memo where cek='1' and user='$_POST[user]' and fupk='$_POST[fu]' and memonm is null and tgl1='$date'");
    while ($dt = mysqli_fetch_array($cr)) {
        $result2 = mysqli_query($koneksi, "update rkb set
        submitdate=NULL,
        poreqdel=NULL,
        podel=NULL,
        stspk=NULL,
        status='3' where rkbpk='$dt[rkbpk]'");
        $delete = mysqli_query($koneksi, "delete from rpo WHERE rkbpk='$dt[rkbpk]' and stspk='1'");
    }
    $result = mysqli_query($koneksi, "update memo set memonm='$_POST[memo]'
                where cek='1' and user='$_POST[user]' and fupk='$_POST[fu]' and memonm is null and tgl1='$date'");
    if ($result) {
        echo "<div class='text-infohijau' style='width:415px;'>Item sent back to MD for revision &nbsp; &#10004; </div>";
    } else {
        echo "<div class='text-infomerah' style='width:415px;'>Cannot process submit revision &nbsp; &#x2573; </div>";
    }
}

if ($_GET['x'] == "uploadpi") {

    function fixDate($date) {
        if (empty($date)) return "NULL";
        $date = trim($date);
        $d = strtotime($date);
        return $d ? "'" . date('Y-m-d', $d) . "'" : "NULL";
    }

    $popk_raw      = isset($_POST['popk']) ? trim($_POST['popk']) : '';
    $existing_file = isset($_POST['existing_file']) ? $_POST['existing_file'] : '';
    $etd           = fixDate($_POST['etd']);
    $eta           = fixDate($_POST['etdal']);
    $eih           = fixDate($_POST['eihl']);
    $payterm       = isset($_POST['payterm']) ? trim($_POST['payterm']) : '';
    $paydate       = fixDate($_POST['pyd']);
    $payterm_value = ($payterm === '') ? "NULL" : (int)$payterm;
    $invoiceno = isset($_POST['invoiceno']) ? trim($_POST['invoiceno']) : '';
    $invoice_value = ($invoiceno === '') ? "NULL" : "'" . mysqli_real_escape_string($koneksi, $invoiceno) . "'";

    if ($popk_raw == '') {
        echo "<div>Error: No PO Selected.</div>";
        exit;
    }

    $is_new_upload = (!empty($_FILES['uploadfile']['name']));
    $file_to_save  = ""; 
    $upload_ok     = true;
    $msg_error     = "";

    if ($is_new_upload) {
        $file_name = $_FILES['uploadfile']['name'];
        $tmp_name  = $_FILES['uploadfile']['tmp_name'];
        $file_size = $_FILES['uploadfile']['size'];
        $maxsize   = 3100000;
        $target_dir = "../upload/";
        $dest_path = $target_dir . $file_name;

        if ($file_size > $maxsize) {
            $msg_error = "File must be less than 3 MB.";
            $upload_ok = false;
        } else {
            if (move_uploaded_file($tmp_name, $dest_path)) {
                $file_to_save = $file_name;

                // Jika upload berhasil dan file baru berbeda dengan file lama
                if (!empty($existing_file) && $existing_file !== "" && $existing_file !== $file_name) {
                    $old_file_path = $target_dir . $existing_file;
                    if (file_exists($old_file_path)) {
                        unlink($old_file_path);
                    }
                }
                
            } else {
                $msg_error = "Failed to move uploaded file.";
                $upload_ok = false;
            }
        }
    } else {
        // Jika tidak ada upload baru, gunakan file yang sudah ada
        if (!empty($existing_file) && $existing_file !== "") {
            $file_to_save = $existing_file;
        } else {
            $msg_error = "Please select a file to upload.";
            $upload_ok = false;
        }
    }

    if ($upload_ok) {
        $ids = mysqli_real_escape_string($koneksi, $popk_raw);

        $potop_value = "NULL"; // Default jika kosong
        if ($payterm !== '') {
            $payterm_escaped = mysqli_real_escape_string($koneksi, $payterm);
            $query_mpay = mysqli_query($koneksi, "SELECT paynm FROM mpay WHERE mpaypk = '$payterm_escaped'");
            if ($row_mpay = mysqli_fetch_assoc($query_mpay)) {
                $potop_value = "'" . mysqli_real_escape_string($koneksi, $row_mpay['paynm']) . "'";
            }
        }
        
        // Update data seperti biasa
        $sql_update_po = "UPDATE po SET 
                            pidate    = NOW(), 
                            piform    = '$file_to_save', 
                            etd       = $etd, 
                            etdal     = $eta, 
                            eihl      = $eih,
                            paydate   = $paydate,
                            mpaypk    = $payterm_value,
                            potop     = $potop_value,
                            invoiceno = $invoice_value,
                            postatpk  = '4',
                            email     = '1', 
                            dateupdt  = NOW(), 
                            tpo2c     = '1' 
                          WHERE popk IN ($ids)";
        
        $update = mysqli_query($koneksi, $sql_update_po);
        $sql_update_rkb = "UPDATE rkb SET status = '6' WHERE popk IN ($ids)";
        $update2 = mysqli_query($koneksi, $sql_update_rkb);

        if ($update && $update2) {
            $sql_get_pono = "SELECT pono FROM po WHERE popk IN ($ids)";
            $res_pono = mysqli_query($koneksi, $sql_get_pono);
            $list_pono = [];
            while ($row_pono = mysqli_fetch_assoc($res_pono)) {
                $list_pono[] = $row_pono['pono'];
            }
            $all_pono = implode(', ', $list_pono);

            echo "<div>Success: Updated PO ($all_pono)</div>";
        } else {
            echo "<div>Database Error: " . mysqli_error($koneksi) . "</div>";
        }
    } else {
        echo "<div>Error: $msg_error</div>";
    }
}

if ($_GET['x'] == "po1") {
    // $dta = mysqli_fetch_array(mysqli_query($koneksi, "select * from rkb where rkbpk='$_POST[rkb]'"));
    // $pur = ucfirst($_GET['pur']);
    // $item = addslashes($dta['item']);
    // $supnm = $dta['sup'];

    // $dt = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po order by popk desc limit 1"));
    // $popk = $dt['popk'] + 1;

    // if (stripos($supnm, 'stock') !== false) {
    // $dt2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT pono FROM po WHERE polipk='3' order by popk desc limit 1"));
    // } else {
    // $dt2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT pono FROM po WHERE polipk='1' order by popk desc limit 1"));  
    // }
    // // $lokal = substr($dt2['pono'], 3, 6) + 1;
    // // $lokal2 = substr($dt2['pono'], 3, 6) + 2;
    // // $pono = "LN0" . $lokal;

    // $lastNo = $dt2['pono'] ?? '';

    // if ($lastNo != '') {
    //     $angka = (int) substr($lastNo, 2);
    //     $next  = $angka + 1;
    // } else {
    //     $next = 1;
    // }

    // if (stripos($supnm, 'stock') !== false) {
    //     $pono = 'SN' . str_pad($next, 7, '0', STR_PAD_LEFT);
    // } else {
    //     $pono = 'LN' . str_pad($next, 7, '0', STR_PAD_LEFT);
    // }

        $dta = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM rkb WHERE rkbpk='$_POST[rkb]'"));
        $pur   = ucfirst($_GET['pur']);
        $item  = addslashes($dta['item']);
        $supnm = addslashes(trim($dta['sup']));

        $dt = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po ORDER BY popk DESC LIMIT 1"));
        $popk = $dt['popk'] + 1;

        /* ================= PREFIX ================= */
        if (stripos($supnm, 'stock') !== false) {
            $prefix = 'SN';
            $polipk = 3;
        } else {
            $prefix = 'LN';
            $polipk = 1;
        }

        /* ================= AMBIL NOMOR TERAKHIR ================= */
        $dt2 = mysqli_fetch_array(mysqli_query(
            $koneksi,
            "SELECT pono 
            FROM po 
            WHERE polipk='$polipk'
            AND pono LIKE '$prefix%'
            ORDER BY pono DESC 
            LIMIT 1"
        ));

        /* ================= GENERATE NOMOR ================= */
        if ($dt2 && !empty($dt2['pono'])) {
            $lastNo = trim($dt2['pono']);
            // ambil angka setelah prefix
            $angka = (int) substr($lastNo, 2);
            $next = $angka + 1;
        } else {
            $next = 1;
        }

        /* ================= HASIL FINAL ================= */
        $pono = $prefix . str_pad($next, 6, '0', STR_PAD_LEFT);

        /* DEBUG */
        // echo $pono;

    //tgldel='$dta[podel]',
    if ($dta['poreqdel'] > 0) {
        if($prefix == 'SN'){
        $insert = mysqli_query($koneksi, "insert into po set
        popk='$popk',
        pono='$pono',
        polipk='$polipk',
        pourgpk='1',
        postatpk='1',
        tglpo=NOW(),
        pidate=NOW(),
        etd=NOW(),
        etdal=NOW(),
        eihl=NOW(),
        tgldel='$dta[poreqdel]',
        suppk='$dta[suppk]',
        brg='$item',
        pur='$pur',
        curpk='$dta[curpk]',
        ck='0'");
        } else {
        $insert = mysqli_query($koneksi, "insert into po set
        popk='$popk',
        pono='$pono',
        polipk='$polipk',
        pourgpk='1',
        postatpk='1',
        tglpo=NOW(),
        tgldel='$dta[poreqdel]',
        suppk='$dta[suppk]',
        brg='$item',
        pur='$pur',
        curpk='$dta[curpk]',
        ck='0'");  
        }
    } else {
        if($prefix == 'SN'){
        $insert = mysqli_query($koneksi, "insert into po set
        popk='$popk',
        pono='$pono',
        polipk='$polipk',
        pourgpk='1',
        postatpk='1',
        tglpo=NOW(),
        pidate=NOW(),
        etd=NOW(),
        etdal=NOW(),
        eihl=NOW(),
        suppk='$dta[suppk]',
        brg='$item',
        pur='$pur',
        curpk='$dta[curpk]',
        ck='0'");
        } else {
        $insert = mysqli_query($koneksi, "insert into po set
        popk='$popk',
        pono='$pono',
        polipk='$polipk',
        pourgpk='1',
        postatpk='1',
        tglpo=NOW(),
        suppk='$dta[suppk]',
        brg='$item',
        pur='$pur',
        curpk='$dta[curpk]',
        ck='0'");   
        }
    }

    /*$insert=mysqli_query($koneksi,"insert into po set
    popk='$popk',
    pono='$pono',
    polipk='1',
    pourgpk='1',
    postatpk='1',
    tglpo=NOW(),
    suppk='$_GET[sup]',
    brg='$_GET[item]',
    pur='$_GET[pur]'");*/
    $update = mysqli_query($koneksi, "update notran set nikelokal='$lokal2' where tabel='PO'");
    echo $popk;
}

if ($_GET['x'] == "po1b") {
    //$popk=$_GET['popk'];
    //$dt3 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT popk FROM po WHERE popk='$popk'"));
    //include "../email/index.php?id=po&po=$popk";
    $dta = mysqli_fetch_array(mysqli_query($koneksi, "select * from rkb where rkbpk='$_GET[rkb]'"));
    $pur   = ucfirst($_GET['pur']);
    $item  = addslashes($dta['item']);
    $supnm = addslashes(trim($dta['sup']));

        if (stripos($supnm, 'stock') !== false) {
            $prefix = 'SN';
            $polipk = 3;
        } else {
            $prefix = 'LN';
            $polipk = 1;
        }


    if ($dta['poreqdel'] > 0) {
    if($polipk==3){
        $dt3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po
    WHERE polipk='$polipk' and pourgpk='1' and postatpk='1' and suppk='$dta[suppk]' and pur='$_GET[pur]' and tglpo='$date' and ck='0'
    order by popk desc limit 1"));
    } else {
        $dt3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po
    WHERE polipk='$polipk' and pourgpk='1' and postatpk='1' and tgldel='$dta[poreqdel]' and suppk='$dta[suppk]' and pur='$_GET[pur]' and tglpo='$date' and ck='0'
    order by popk desc limit 1"));
    }
    } else {
        $dt3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po
    WHERE polipk='$polipk' and pourgpk='1' and postatpk='1' and tgldel is null and suppk='$dta[suppk]' and pur='$_GET[pur]' and tglpo='$date' and ck='0'
    order by popk desc limit 1"));
    }
    $popk = $dt3['popk'];

    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {

        $update2 = mysqli_query($koneksi, "update rkb set
            newdate=NOW(),
            popk='$popk',
            stspk='2',
            status='4' where rkbpk='$id'");

        $update3 = mysqli_query($koneksi, "update rpo set
            newdate=NOW(),
            popk='$popk',
            stspk='2',
            popros='1' where rkbpk='$id'");

        $sql2 = mysqli_query($koneksi, "select * from rpo where rkbpk='$id'");
        /*while($dtb= mysqli_fetch_array($sql2)){*/
        $dtb = mysqli_fetch_array($sql2);
        /*$tpo=$dtb['pocons']*$dtb['price'];
        $tot=$tot+$tpo;*/
        /*$update4 = @mysqli_query($koneksi,"update po set tot='$tot' where popk='$popk'");*/
        $item = addslashes($dtb['item']);
        $itemadd = addslashes($dtb['itemadd']);
        $spec = addslashes($dtb['spec']);
        $specadd = addslashes($dtb['specadd']);
        $sup = addslashes($dtb['sup']);
        $spec1 = addslashes($dtb['spec1']);
        $spec2 = addslashes($dtb['spec2']);
        $spec3 = addslashes($dtb['spec3']);
        $spec4 = addslashes($dtb['spec4']);
        $spec5 = addslashes($dtb['spec5']);
        $spec6 = addslashes($dtb['spec6']);
        $spec7 = addslashes($dtb['spec7']);
        $spec8 = addslashes($dtb['spec8']);
        $sizegar = addslashes($dtb['sizegar']);
        $colname = addslashes($dtb['colname']);

        $cr = mysqli_query($koneksi, "select * from podt where rkbpk='$dtb[rkbpk]'");
        $dt = mysqli_fetch_array($cr);

        if ($dt['podtpk'] > 0) {
            $result = mysqli_query($koneksi, "update podt set 
        popk='$popk', 
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
        stspk='$dtb[stspk]',
        f1='$dtb[f1]',
        f2='$dtb[f2]',
        matusage = '$dtb[matusage]',
        delsts='0' where rkbpk='$dtb[rkbpk]'");
        } else {
            $result = mysqli_query($koneksi, "insert into podt set
            popk='$popk',
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
            stspk='$dtb[stspk]',
            f1='$dtb[f1]',
            f2='$dtb[f2]',
            matusage = '$dtb[matusage]'");
        }
        $sukses++;
    }
    /*$result3 = mysqli_query($koneksi,"update rpo set posts='1' where popk='$popk' and posts='0' and stspk='2'");*/
    if ($sukses > 0) {
        //$result3 = mysqli_query($koneksi,"update po set ck='1' where popk='$popk'");
        echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau'> $_GET[count] Item processed for PO &nbsp; &#10004; </div>"));
    } else {
        echo json_encode(array('msg' => "<div class='text-infomerah'>There is error process PO &nbsp; &#x2573; </div>"));
    }
}
if ($_GET['x'] == "po1c") {
    $dta = mysqli_fetch_array(mysqli_query($koneksi, "select * from rkb where rkbpk='$_POST[rkb]'"));
    $pur = $_GET['pur'];
    $insert = mysqli_query($koneksi, "update po set ck='1' where ck='0' and pur='$pur' and polipk='1' and suppk='$dta[suppk]'");
}
if ($_GET['x'] == "po2") {
    $dt = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po order by popk desc limit 1"));
    $dt2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT pono FROM po WHERE polipk='2' order by popk desc limit 1"));
    $popk = $dt['popk'] + 1;
    $lokal = substr($dt2['pono'], 3, 5) + 1;
    $lokal2 = substr($dt2['pono'], 3, 5) + 2;
    $pono = "IN0" . $lokal;

    $dta = mysqli_fetch_array(mysqli_query($koneksi, "select * from rkb where rkbpk='$_POST[rkb]'"));
    $pur = ucfirst($_GET['pur']);
    $item = addslashes($dta['item']);

    //tgldel='$dta[podel]',
    if ($dta['poreqdel'] > 0) {
        $insert = mysqli_query($koneksi, "insert into po set
        popk='$popk',
        pono='$pono',
        polipk='2',
        pourgpk='1',
        postatpk='1',
        tglpo=NOW(),
        tgldel='$dta[poreqdel]',
        suppk='$dta[suppk]',
        brg='$item',
        pur='$pur',
        curpk='$dta[curpk]',
        ck='0'");
    } else {
        $insert = mysqli_query($koneksi, "insert into po set
            popk='$popk',
            pono='$pono',
            polipk='2',
            pourgpk='1',
            postatpk='1',
            tglpo=NOW(),
            suppk='$dta[suppk]',
            brg='$item',
            pur='$pur',
            curpk='$dta[curpk]',
            ck='0'");
    }

    /*$insert=mysqli_query($koneksi,"insert into po set
    popk='$popk',
    pono='$pono',
    polipk='1',
    pourgpk='1',
    postatpk='1',
    tglpo=NOW(),
    suppk='$_GET[sup]',
    brg='$_GET[item]',
    pur='$_GET[pur]'");*/
    $update = mysqli_query($koneksi, "update notran set nikeimpor='$lokal2' where tabel='PO'");
    echo $popk;
}
if ($_GET['x'] == "po2b") {
    //$popk=$_GET['popk'];
    //$dt3 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT popk FROM po WHERE popk='$popk'"));
    //include "../email/index.php?id=po&po=$popk";
    $dta = mysqli_fetch_array(mysqli_query($koneksi, "select * from rkb where rkbpk='$_GET[rkb]'"));
    if ($dta['poreqdel'] > 0) {
        $dt3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po
        WHERE polipk='2' and pourgpk='1' and postatpk='1' and tgldel='$dta[poreqdel]' and suppk='$dta[suppk]' and pur='$_GET[pur]' and tglpo='$date' and ck='0'
        order by popk desc limit 1"));
    } else {
        $dt3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po
        WHERE polipk='2' and pourgpk='1' and postatpk='1' and tgldel is null and suppk='$dta[suppk]' and pur='$_GET[pur]' and tglpo='$date' and ck='0'
        order by popk desc limit 1"));
    }

    $popk = $dt3['popk'];
    $tgldel = $dt3['tgldel'];
    $brg = $dt3['brg'];

    /*$dt = mysqli_fetch_array(mysqli_query($koneksi,"SELECT popk FROM po order by popk desc limit 1"));
    $dt2 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT pono FROM po WHERE polipk='2' order by popk desc limit 1"));
    $popk=$dt['popk']+1;
    $lokal=substr($dt2['pono'],3,5)+1;
    $lokal2=substr($dt2['pono'],3,5)+2;
    $pono="IN0".$lokal;*/

    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $update2 = mysqli_query($koneksi, "update rkb set
        newdate=NOW(),
        popk='$popk',
        stspk='2',
        status='4' where rkbpk='$id'");

        $update3 = mysqli_query($koneksi, "update rpo set
        newdate=NOW(),
        popk='$popk',
        stspk='2',
        popros='1' where rkbpk='$id'");

        $sql2 = mysqli_query($koneksi, "select * from rpo where rkbpk='$id'");
        //while($dtb= mysqli_fetch_array($sql2)){
        $dtb = mysqli_fetch_array($sql2);
        /*$tpo=$dtb['pocons']*$dtb['price'];
        $tot=$tot+$tpo;*/
        /*$update4 = @mysqli_query($koneksi,"update po set tot='$tot' where popk='$popk'");*/
        $item = addslashes($dtb['item']);
        $itemadd = addslashes($dtb['itemadd']);
        $spec = addslashes($dtb['spec']);
        $specadd = addslashes($dtb['specadd']);
        $sup = addslashes($dtb['sup']);
        $spec1 = addslashes($dtb['spec1']);
        $spec2 = addslashes($dtb['spec2']);
        $spec3 = addslashes($dtb['spec3']);
        $spec4 = addslashes($dtb['spec4']);
        $spec5 = addslashes($dtb['spec5']);
        $spec6 = addslashes($dtb['spec6']);
        $spec7 = addslashes($dtb['spec7']);
        $spec8 = addslashes($dtb['spec8']);
        $sizegar = addslashes($dtb['sizegar']);
        $colname = addslashes($dtb['colname']);

        $cr = mysqli_query($koneksi, "select * from podt where rkbpk='$dtb[rkbpk]'");
        $dt = mysqli_fetch_array($cr);

        if ($dt['podtpk'] > 0) {
            $result = mysqli_query($koneksi, "update podt set 
            popk='$popk', 
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
            stspk='$dtb[stspk]',
            f1='$dtb[f1]',
            f2='$dtb[f2]',
            matusage = '$dtb[matusage]',
            delsts='0' where rkbpk='$dtb[rkbpk]'");
        } else {
            $result = mysqli_query($koneksi, "insert into podt set
            popk='$popk',
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
            stspk='$dtb[stspk]',
            f1='$dtb[f1]',
            f2='$dtb[f2]',
            matusage = '$dtb[matusage]'");
        }
        $sukses++;
    }

    /*$result3 = mysqli_query($koneksi,"update rpo set posts='1' where popk='$popk' and posts='0' and stspk='2'");*/
    if ($sukses > 0) {
        /*$sql3b=mysqli_query($koneksi,"SELECT * FROM rkb
        where popk='0' and suppk='$_GET[sup]' and poreqdel='$tgldel' and stspk='2' and status='4'");
        while($dt3b = mysqli_fetch_array($sql3b)){
        $update2b=mysqli_query($koneksi,"update rkb set popk='$popk' where rkbpk='$dt3b[rkbpk]'");
        $update3b=mysqli_query($koneksi,"update rpo set popk='$popk' where rkbpk='$dt3b[rkbpk]'");
        $update4b=mysqli_query($koneksi,"update podt set popk='$popk' where rkbpk='$dt3b[rkbpk]'");
        }*/
        //$result3 = mysqli_query($koneksi,"update po set ck='1' where popk='$popk'");
        echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau'> $_GET[count] Item processed for PO &nbsp; &#10004; </div>"));
    } else {
        echo json_encode(array('msg' => "<div class='text-infomerah'>There is error process PO &nbsp; &#x2573; </div>"));
    }
    //}
}

if ($_GET['x'] == "po2c") {
    $dta = mysqli_fetch_array(mysqli_query($koneksi, "select * from rkb where rkbpk='$_POST[rkb]'"));
    $pur = $_GET['pur'];
    $insert = mysqli_query($koneksi, "update po set ck='1' where ck='0' and pur='$pur' and polipk='2' and suppk='$dta[suppk]'");
}

if ($_GET['x'] == "updtpo1") {
    //$ket=addslashes($_GET['ket']);
    //$update=mysqli_query($koneksi,"update po set ket='$ket' where popk='$_GET[po]'");
    if ($_POST['pourg'] > 0) {
        $update2 = mysqli_query($koneksi, "update po set pourgpk='$_POST[pourg]' where popk='$_POST[popk1]'");
    }
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpo1b") {
    $etd = tgl2b($_POST['etda']);
    $update = mysqli_query($koneksi, "update po set etd='$etd' where popk='$_POST[popk2]'");
    $update2 = mysqli_query($koneksi, "update rkb set piplandel='$etd' where popk='$_POST[popk2]'");
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpoeih") {
    $eih = tgl2b($_POST['eih']);
    $update = mysqli_query($koneksi, "update po set eihl='$eih' where popk='$_POST[popkeih]'");
    $update2 = mysqli_query($koneksi, "update podt set ihdate='$eih' where popk='$_POST[popkeih]'");
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpoetdv") {
    $etdv = tgl2b($_POST['etdv']);
    $update = mysqli_query($koneksi, "update po set etdvl='$etdv' where popk='$_POST[popketdv]'");
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpoeta") {
    $eta = tgl2b($_POST['eta']);
    $update = mysqli_query($koneksi, "update po set etdal='$eta' where popk='$_POST[popketa]'");
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpo1e") {
    $sup = addslashes(TRIM($_GET['sup']));
    $suppke = $_POST['suppe'];
    $popke = $_POST['popk1e'];

    if ($suppke <> '') {
    $dt = mysqli_fetch_array(mysqli_query($koneksi, "SELECT po.suppk, po.popk, sup.supnm 
    FROM po
    left outer join sup on sup.suppk=po.suppk 
    where po.popk='$popke'"));
    $suppk = $dt['suppk'];
    $supnm = addslashes(TRIM($dt['supnm']));

    if($suppk==$suppke){
    } else {
    if (stripos($sup, 'stock') !== false) {
    $dt2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT pono FROM po WHERE polipk='3' order by pono desc limit 1"));
    } 
    // else {
    // $dt2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT pono FROM po WHERE polipk='1' order by popk desc limit 1"));  
    // }

    $lastNo = $dt2['pono'] ?? '';

    if ($lastNo != '') {
        $angka = (int) substr($lastNo, 2);
        // var_dump($angka);
        // die();
        $next  = $angka + 1;
    } else {
        $next = 1;
    }

    if (stripos($sup, 'stock') !== false) {
    if (stripos($supnm, 'stock') !== false) {
    $update1e = mysqli_query($koneksi, "update po set suppk='$suppke' where popk='$popke'");    
    } else {
    $pono = 'SN' . str_pad($next, 6, '0', STR_PAD_LEFT);
    $update1e = mysqli_query($koneksi, "update po set polipk='3', suppk='$suppke', pono='$pono', pidate=NOW(), etd=NOW(), etdal=NOW(), eihl=NOW() where popk='$popke'");
    } 
    } else {
    // $pono = 'LN' . str_pad($next, 7, '0', STR_PAD_LEFT);  
    $update1e = mysqli_query($koneksi, "update po set suppk='$suppke' where popk='$popke'");
    }

    // $update2e = mysqli_query($koneksi, "update podt set suppk='$suppke', sup='$sup' where popk='$popke'");
    // $update3e = mysqli_query($koneksi, "update rkb set suppk='$suppke', sup='$sup' where popk='$popke'");
    // $update4e = mysqli_query($koneksi, "update rpo set suppk='$suppke', sup='$sup' where popk='$popke'"); 

    if (stripos($sup, 'stock') !== false) {
        echo "SN";
    } else {
        echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
    }
    }

    $update2e = mysqli_query($koneksi, "update podt set suppk='$suppke', sup='$sup' where popk='$popke'");
    $update3e = mysqli_query($koneksi, "update rkb set suppk='$suppke', sup='$sup' where popk='$popke'");
    $update4e = mysqli_query($koneksi, "update rpo set suppk='$suppke', sup='$sup' where popk='$popke'"); 

    }
}

if ($_GET['x'] == "updtpo1f") {
    if ($_POST['curf'] > 0) {
        $update1f = mysqli_query($koneksi, "update po set curpk='$_POST[curf]' where popk='$_POST[popk1f]'");
        $update2f = mysqli_query($koneksi, "update podt set curpk='$_POST[curf]' where popk='$_POST[popk1f]'");
        // $update3f=mysqli_query($koneksi,"update rkb set curpk='$_POST[curf]' where popk='$_POST[popk1f]'");
        // $update4f=mysqli_query($koneksi,"update rpo set curpk='$_POST[curf]' where popk='$_POST[popk1f]'");
    }
}
if ($_GET['x'] == "updtpo1g") {
    $cr = mysqli_query($koneksi, "select * from mpay where mpaypk='$_POST[payterm]'");
    $dt = mysqli_fetch_array($cr);
    $payterm = $dt['paynm'];
    $update1g = mysqli_query($koneksi, "update po set potop='$payterm', mpaypk='$_POST[payterm]' where popk='$_POST[popk1g]'");
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpog2") {
    $update1g = mysqli_query($koneksi, "update po set surcharge='$_POST[surcharge1]' where popk='$_POST[popkg2]'");
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpog2b") {
    $update1g = mysqli_query($koneksi, "update po set surcharge2='$_POST[surcharge2]' where popk='$_POST[popkg2b]'");
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpog2c") {
    $update1g = mysqli_query($koneksi, "update po set note='$_POST[note]' where popk='$_POST[popkg2c]'");
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpo1h") {
    $tgldel = tgl2b($_POST['deldt']);
    $update1g = mysqli_query($koneksi, "update po set tgldel='$tgldel' where popk='$_POST[popk1h]'");
    $update3f = mysqli_query($koneksi, "update rkb set podel='$tgldel',poreqdel='$tgldel' where popk='$_POST[popk1h]'");
    $update4f = mysqli_query($koneksi, "update rpo set poreqdel='$tgldel' where popk='$_POST[popk1h]'");
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpo1i") {
    //$update1g=mysqli_query($koneksi,"update po set brg='$_POST[brgg]' where popk='$_POST[popk1i]'");
    //$update1g=mysqli_query($koneksi,"update po set buy='$_POST[brgg]' where popk='$_POST[popk1i]'");
    //$cr=mysqli_query($koneksi,"select * from podt where popk='$_POST[popk1i]' group by ordpk");
    //while($dt=mysqli_fetch_array($cr)){
    //$update2g=mysqli_query($koneksi,"update ord set season='$_POST[brgg]' where ordpk='$dt[ordpk]'");
    //}
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpoi2") {
    $ket = addslashes($_POST['rmk']);
    $update1g = mysqli_query($koneksi, "update po set ket='$ket' where popk='$_POST[popki2]'");
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpo1k") {
    $tglpi = tgl2b($_POST['pia']);
    if ($tglpi > 0) {
        $cr = mysqli_query($koneksi, "select * from po where popk='$_POST[popk1k]'");
        $dt = mysqli_fetch_array($cr);
        if ($dt['postatpk'] <= 2) {
            if ($tglpi <> $dt['pidate']) {
                $update1g = mysqli_query($koneksi, "update po set pidate='$tglpi', postatpk='4', email='1' where popk='$_POST[popk1k]'");
                $update2 = mysqli_query($koneksi, "update rkb set status='6' where popk='$_POST[popk1k]'");
                echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
            }
        } else {
            $update1g = mysqli_query($koneksi, "update po set pidate='$tglpi' where popk='$_POST[popk1k]'");
            echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
        }
    }
}

if ($_GET['x'] == "updtpo1j") {
    $tglpo = tgl2b($_POST['tglpo']);
    if ($_POST['sts'] > 0) {
        $update1g = mysqli_query($koneksi, "update po set postatpk='$_POST[sts]' where popk='$_POST[popk1j]'");
        if ($_POST['sts'] == 3) {
            $update2 = mysqli_query($koneksi, "update rkb set stspk='7', status='4', candate=NOW() where popk='$_POST[popk1j]'");
            $update3 = mysqli_query($koneksi, "update rpo set stspk='7', candate=NOW() where popk='$_POST[popk1j]'");
            $update4 = mysqli_query($koneksi, "update podt set stspk='7' where popk='$_POST[popk1j]'");
        }
    } else {
        //$update1g=mysqli_query($koneksi,"update po set tglpo='$tglpo' where popk='$_POST[popk1j]'");   
    }
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpo1j2") {
    $tglpo = tgl2b($_POST['tglpo']);
    if ($_POST['tglpo'] > 0) {
        $update1g = mysqli_query($koneksi, "update po set tglpo='$tglpo' where popk='$_POST[popk1j2]'");
        echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
    }
}

if ($_GET['x'] == "updtpo1p") {
    $pyd = tgl2b($_POST['pyd']);
    $update = mysqli_query($koneksi, "update po set paydate='$pyd' where popk='$_POST[popk1p]'");
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpo1iv") {
    $update = mysqli_query($koneksi, "update po set invoiceno='$_POST[invoiceno]' where popk='$_POST[popkiv]'");
    echo "<div class='text-infohijau'>PO data updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtpoft") {
    if ($_POST['ft'] <> "") {
        $update1ft = mysqli_query($koneksi, "update po set freightterm='$_POST[ft]' where popk='$_POST[popkft]'");
    }
}

if ($_GET['x'] == "updtpo2") {
    $rkbpk = $_REQUEST['rkbpk'];
    /*$pqty = $_REQUEST['piqty'];
    $piqty=preg_replace("/,/","", $pqty);
    $pprice = $_REQUEST['piprice2'];
    $piprice=preg_replace("/,/","", $pprice);
    $piunit= $_REQUEST['piunit'];*/
    $pqty = $_REQUEST['pocons'] + $_REQUEST['qrs'];
    $piqty = preg_replace("/,/", "", $pqty);
    $pprice = $_REQUEST['price'];
    $piprice = preg_replace("/,/", "", $pprice);
    $piunit = $_REQUEST['unit'];
    $spec = addslashes($_REQUEST['pospec']);
    $colname = addslashes($_REQUEST['pocolname']);
    $colcode = addslashes($_REQUEST['pocolcode']);
    $sizegar = addslashes($_REQUEST['posizegar']);
    $unit = $_REQUEST['pounit'];
    $unitcnv = $_REQUEST['unitcnv'];
    $pcns = $_REQUEST['pocons'];
    $pocons = preg_replace("/,/", "", $pcns);
    $prc = $_REQUEST['price'];
    // $price= $_REQUEST['price'];
    $price = preg_replace("/,/", "", $prc);
    $tot = $piqty * $piprice;
    $qrs = $_REQUEST['qrs1'];
    $item = addslashes($_REQUEST['poitem']);
    $dtunit = $_GET['dtunit'];

    $cr = mysqli_query($koneksi, "select * from rkb where rkbpk='$rkbpk'");
    $dt = mysqli_fetch_array($cr);
    $popk = $dt['popk'];
    $qrs2 = $dt['qrs'];
    // $price2=$dt['price'];

    $cr2a = mysqli_query($koneksi, "select * from podt 
    left outer join ord on ord.ordpk=podt.ordpk
    where podt.popk='$popk' order by ord.ordno asc limit 1");
    $dt2a = mysqli_fetch_array($cr2a);
    $updtitem = mysqli_query($koneksi, "update po set brg='$dt2a[item]' where popk='$popk'");

    $cr2 = mysqli_query($koneksi, "select * from podt where rkbpk='$rkbpk'");
    $dt2 = mysqli_fetch_array($cr2);

    $sqlk = mysqli_query($koneksi, "select * from kurs order by kurspk desc limit 1");
    $dtk = mysqli_fetch_array($sqlk);

    if ($dtunit == 2) {
        //Jika UNIT KONVERSI
        if ($price > 0) {
            if ($dt['curpk'] == 2) {
                if ($dt2['curpk'] == 1) {
                    $pprice = $price;
                    $rprice = $dt['price2'] * $dtk['rupiah'];
                    $pprice2 = number_format($pprice, 2, ".", "");
                    $rprice2 = number_format($rprice, 2, ".", "");
                } else {
                    $pprice = $price;
                    $rprice = $dt['price2'];
                    $pprice2 = number_format($pprice, 5, ".", "");
                    $rprice2 = number_format($rprice, 5, ".", "");
                }
            } else {
                $pprice = $price;
                $rprice = $dt['price2'];
                $pprice2 = number_format($pprice, 2, ".", "");
                $rprice2 = number_format($rprice, 2, ".", "");
            }
        }

        if ($dt2['kelnm'] <> "CUTTING") {
            $dtb = mysqli_fetch_array(mysqli_query($koneksi, "select sum(price2) as price from rkb where popk='$dt[popk]' group by popk"));
            $dtc = mysqli_num_rows(mysqli_query($koneksi, "select * from rkb where popk='$dt[popk]'"));
            $pricert = $dtb['price2'] / $dtc;

            $dt2b = mysqli_fetch_array(mysqli_query($koneksi, "select sum(price2) as price from podt where popk='$dt[popk]' and rkbpk<>'$rkbpk' and delsts='0' group by popk"));
            $dt2c = mysqli_num_rows(mysqli_query($koneksi, "select * from podt where popk='$dt[popk]' and rkbpk<>'$rkbpk' and delsts='0'"));
            $pricert2 = ($dt2b['price2'] + $price) / ($dt2c + 1);

            if ($dt['curpk'] == 2) {
                if ($dt2['curpk'] == 1) {
                    $pprice1 = $pricert2;
                    $rprice1 = $pricert * $dtk['rupiah'];
                    $pprice2b = number_format($pprice1, 2, ".", "");
                    $rprice2b = number_format($rprice1, 2, ".", "");
                } else {
                    $pprice1 = $pricert2;
                    $rprice1 = $pricert;
                    $pprice2b = number_format($pprice1, 5, ".", "");
                    $rprice2b = number_format($rprice1, 5, ".", "");
                }
            } else {
                $pprice1 = $pricert2;
                $rprice1 = $pricert;
                $pprice2b = number_format($pprice1, 2, ".", "");
                $rprice2b = number_format($rprice1, 2, ".", "");
            }

            // if ($pprice2b > $rprice2b) {
            //     echo json_encode(array('success' => true, 'msg' => "1"));
            // } else {
            // $updt=mysqli_query($koneksi,"update podt set delsts='0' where rkbpk='$rkbpk'");
            if ($qrs <> $qrs2) {
                $updt = mysqli_query($koneksi, "update podt set uqrs='1' where rkbpk='$rkbpk'");
            }

            $sql = "UPDATE rkb set
                unit='$unit',
                piqty='$piqty',
                piprice='$piprice',
                piunit='$piunit',
                piamount='$tot' where rkbpk='$rkbpk'";
            @mysqli_query($koneksi, $sql);

            /*$sqlb="update rpo set
                spec='$spec',
                colname='$colname',
                colcode='$colcode',
                sizegar='$sizegar',
                unit='$unit',
                pocons='$pocons',
                price='$price' where rkbpk='$rkbpk'";
                @mysqli_query($koneksi,$sqlb);*/

            $pocons2 = $pocons;
            $sqlc = "UPDATE podt SET
                        spec='$spec',
                        colname='$colname',
                        colcode='$colcode',
                        sizegar='$sizegar',
                        unit2='$unitcnv',
                        pocons2='$pocons2',
                        qrs2='$qrs',
                        item='$item',
                        tpodt='0',
                        price2='$price' where rkbpk='$rkbpk'";
            @mysqli_query($koneksi, $sqlc);

            $sql2 = mysqli_query($koneksi, "SELECT sum(pocons*price) as amount from podt where popk='$popk' group by popk");
            $dt2 = mysqli_fetch_array($sql2);
            $totpi = $dt2['amount'];
            $sql3 = mysqli_query($koneksi, "UPDATE po set piamount='$totpi', dateupdt=NOW(), dateupdt2=NOW(), tpo2c='1'  where popk='$popk'");

            $cr2 = mysqli_query($koneksi, "select * from rkb
        left outer join ord on ord.ordpk=rkb.ordpk
        where rkb.rkbpk='$rkbpk'");
            $dt2 = mysqli_fetch_array($cr2);
            $lognote = "User " . $userlog . " edit data material item " . $dt2['item'] . " order " . $dt2['ordno'];
            $insert2 = mysqli_query($koneksi, "INSERT into logtran set
        logdtime=NOW(),
        logdate=NOW(),
        logtime=NOW(),
        logip='$ip',
        lognote='$lognote',
        ordpk='$dt2[ordpk]',
        rkbpk='$rkbpk',
        sistem='$sistem'");
            echo json_encode(
                array(
                    'success' => true,
                    'msg' => "<div class='text-infohijau' style='width:355px;'>PO data updated &nbsp; &#10004; </div>"
                )
            );
            //}
        } else {
            if ($pprice2 > $rprice2) {
                // $updt=mysqli_query($koneksi,"update podt set delsts='2' where rkbpk='$rkbpk'");
                echo json_encode(
                    array(
                        'success' => true,
                        'msg' => "<div class='text-infomerah' style='width:355px;'>PO price cannot be higher than RKB price &nbsp; &#x2573; </div>"
                    )
                );
            } else {
                // $updt=mysqli_query($koneksi,"update podt set delsts='0' where rkbpk='$rkbpk'");
                if ($qrs <> $qrs2) {
                    $updt = mysqli_query($koneksi, "update podt set uqrs='1' where rkbpk='$rkbpk'");
                }

                $sql = "UPDATE rkb set
                        unit='$unit',
                        piqty='$piqty',
                        piprice='$piprice',
                        piunit='$piunit',
                        piamount='$tot' where rkbpk='$rkbpk'";
                @mysqli_query($koneksi, $sql);

                /*$sqlb="update rpo set
                spec='$spec',
                colname='$colname',
                colcode='$colcode',
                sizegar='$sizegar',
                unit='$unit',
                pocons='$pocons',
                price='$price' where rkbpk='$rkbpk'";
                @mysqli_query($koneksi,$sqlb);*/

                $pocons2 = $pocons + $qrs;
                $sqlc = "UPDATE podt set
                        spec='$spec',
                        colname='$colname',
                        colcode='$colcode',
                        sizegar='$sizegar',
                        unit2='$unitcnv',
                        pocons2='$pocons2',
                        qrs2='$qrs',
                        item='$item',
                        tpodt='0',
                        price2='$price' where rkbpk='$rkbpk'";
                @mysqli_query($koneksi, $sqlc);

                $sql2 = mysqli_query($koneksi, "select sum(pocons*price) as amount from podt where popk='$popk' group by popk");
                $dt2 = mysqli_fetch_array($sql2);
                $totpi = $dt2['amount'];
                $sql3 = mysqli_query($koneksi, "update po set piamount='$totpi', dateupdt=NOW(), dateupdt2=NOW(), tpo2c='1'  where popk='$popk'");

                $cr2 = mysqli_query($koneksi, "select * from rkb
                left outer join ord on ord.ordpk=rkb.ordpk
                where rkb.rkbpk='$rkbpk'");
                $dt2 = mysqli_fetch_array($cr2);
                $lognote = "User " . $userlog . " edit data material item " . $dt2['item'] . " order " . $dt2['ordno'];
                $insert2 = mysqli_query($koneksi, "insert into logtran set
                                                    logdtime=NOW(),
                                                    logdate=NOW(),
                                                    logtime=NOW(),
                                                    logip='$ip',
                                                    lognote='$lognote',
                                                    ordpk='$dt2[ordpk]',
                                                    rkbpk='$rkbpk',
                                                    sistem='$sistem'");
                echo json_encode(
                    array(
                        'success' => true,
                        'msg' => "<div class='text-infohijau' style='width:355px;'>PO data updated &nbsp; &#10004; </div>"
                    )
                );
            }
        }
    } else {
        // JIKA UNIT ASLI BUKAN KONVERSI
        if ($price > 0) {
            if ($dt['curpk'] == 2) {
                if ($dt2['curpk'] == 1) {
                    $pprice = $price;
                    $rprice = $dt['price'] * $dtk['rupiah'];
                    $pprice2 = number_format($pprice, 2, ".", "");
                    $rprice2 = number_format($rprice, 2, ".", "");
                } else {
                    $pprice = $price;
                    $rprice = $dt['price'];
                    $pprice2 = number_format($pprice, 5, ".", "");
                    $rprice2 = number_format($rprice, 5, ".", "");
                }
            } else {
                $pprice = $price;
                $rprice = $dt['price'];
                $pprice2 = number_format($pprice, 2, ".", "");
                $rprice2 = number_format($rprice, 2, ".", "");
            }
        }

        if ($dt2['kelnm'] <> "CUTTING") {
            $dtb = mysqli_fetch_array(mysqli_query($koneksi, "select sum(price) as price from rkb where popk='$dt[popk]' group by popk"));
            $dtc = mysqli_num_rows(mysqli_query($koneksi, "select * from rkb where popk='$dt[popk]'"));
            $pricert = $dtb['price'] / $dtc;

            $dt2b = mysqli_fetch_array(mysqli_query($koneksi, "select sum(price) as price from podt where popk='$dt[popk]' and rkbpk<>'$rkbpk' and delsts='0' group by popk"));
            $dt2c = mysqli_num_rows(mysqli_query($koneksi, "select * from podt where popk='$dt[popk]' and rkbpk<>'$rkbpk' and delsts='0'"));
            $pricert2 = ($dt2b['price'] + $price) / ($dt2c + 1);

            if ($dt['curpk'] == 2) {
                if ($dt2['curpk'] == 1) {
                    $pprice1 = $pricert2;
                    $rprice1 = $pricert * $dtk['rupiah'];
                    $pprice2b = number_format($pprice1, 2, ".", "");
                    $rprice2b = number_format($rprice1, 2, ".", "");
                } else {
                    $pprice1 = $pricert2;
                    $rprice1 = $pricert;
                    $pprice2b = number_format($pprice1, 5, ".", "");
                    $rprice2b = number_format($rprice1, 5, ".", "");
                }
            } else {
                $pprice1 = $pricert2;
                $rprice1 = $pricert;
                $pprice2b = number_format($pprice1, 2, ".", "");
                $rprice2b = number_format($rprice1, 2, ".", "");
            }

            if ($pprice2b > $rprice2b) {
                echo json_encode(array('success' => true, 'msg' => "1"));
            } else {
                // $updt=mysqli_query($koneksi,"update podt set delsts='0' where rkbpk='$rkbpk'");
                if ($qrs <> $qrs2) {
                    $updt = mysqli_query($koneksi, "update podt set uqrs='1' where rkbpk='$rkbpk'");
                }

                $sql = "update rkb set
                        unit='$unit',
                        piqty='$piqty',
                        piprice='$piprice',
                        piunit='$piunit',
                        piamount='$tot' where rkbpk='$rkbpk'";
                @mysqli_query($koneksi, $sql);

                /*$sqlb="update rpo set
                spec='$spec',
                colname='$colname',
                colcode='$colcode',
                sizegar='$sizegar',
                unit='$unit',
                pocons='$pocons',
                price='$price' where rkbpk='$rkbpk'";
                @mysqli_query($koneksi,$sqlb);*/

                $pocons2 = $pocons + $qrs;
                $sqlc = "update podt set
                        spec='$spec',
                        colname='$colname',
                        colcode='$colcode',
                        sizegar='$sizegar',
                        unit='$unit',
                        pocons='$pocons2',
                        qrs='$qrs',
                        item='$item',
                        tpodt='0',
                        price='$price' where rkbpk='$rkbpk'";
                @mysqli_query($koneksi, $sqlc);

                $sql2 = mysqli_query($koneksi, "select sum(pocons*price) as amount from podt where popk='$popk' group by popk");
                $dt2 = mysqli_fetch_array($sql2);
                $totpi = $dt2['amount'];
                $sql3 = mysqli_query($koneksi, "update po set piamount='$totpi', dateupdt=NOW(), dateupdt2=NOW(), tpo2c='1'  where popk='$popk'");

                $cr2 = mysqli_query($koneksi, "select * from rkb
        left outer join ord on ord.ordpk=rkb.ordpk
        where rkb.rkbpk='$rkbpk'");
                $dt2 = mysqli_fetch_array($cr2);
                $lognote = "User " . $userlog . " edit data material item " . $dt2['item'] . " order " . $dt2['ordno'];
                $insert2 = mysqli_query($koneksi, "insert into logtran set
        logdtime=NOW(),
        logdate=NOW(),
        logtime=NOW(),
        logip='$ip',
        lognote='$lognote',
        ordpk='$dt2[ordpk]',
        rkbpk='$rkbpk',
        sistem='$sistem'");
                echo json_encode(
                    array(
                        'success' => true,
                        'msg' => "<div class='text-infohijau' style='width:355px;'>PO data updated &nbsp; &#10004; </div>"
                    )
                );
            }
        } else {
            if ($pprice2 > $rprice2) {
                // $updt=mysqli_query($koneksi,"update podt set delsts='2' where rkbpk='$rkbpk'");
                echo json_encode(
                    array(
                        'success' => true,
                        'msg' => "<div class='text-infomerah' style='width:355px;'>PO price cannot be higher than RKB price &nbsp; &#x2573; </div>"
                    )
                );
            } else {
                // $updt=mysqli_query($koneksi,"update podt set delsts='0' where rkbpk='$rkbpk'");
                if ($qrs <> $qrs2) {
                    $updt = mysqli_query($koneksi, "update podt set uqrs='1' where rkbpk='$rkbpk'");
                }

                $sql = "update rkb set
        unit='$unit',
        piqty='$piqty',
        piprice='$piprice',
        piunit='$piunit',
        piamount='$tot' where rkbpk='$rkbpk'";
                @mysqli_query($koneksi, $sql);

                /*$sqlb="update rpo set
                spec='$spec',
                colname='$colname',
                colcode='$colcode',
                sizegar='$sizegar',
                unit='$unit',
                pocons='$pocons',
                price='$price' where rkbpk='$rkbpk'";
                @mysqli_query($koneksi,$sqlb);*/

                $pocons2 = $pocons + $qrs;
                $sqlc = "update podt set
                spec='$spec',
                colname='$colname',
                colcode='$colcode',
                sizegar='$sizegar',
                unit='$unit',
                pocons='$pocons2',
                qrs='$qrs',
                item='$item',
                tpodt='0',
                price='$price' where rkbpk='$rkbpk'";
                @mysqli_query($koneksi, $sqlc);

                $sql2 = mysqli_query($koneksi, "select sum(pocons*price) as amount from podt where popk='$popk' group by popk");
                $dt2 = mysqli_fetch_array($sql2);
                $totpi = $dt2['amount'];
                $sql3 = mysqli_query($koneksi, "update po set piamount='$totpi', dateupdt=NOW(), dateupdt2=NOW(), tpo2c='1'  where popk='$popk'");

                $cr2 = mysqli_query($koneksi, "select * from rkb
        left outer join ord on ord.ordpk=rkb.ordpk
        where rkb.rkbpk='$rkbpk'");
                $dt2 = mysqli_fetch_array($cr2);
                $lognote = "User " . $userlog . " edit data material item " . $dt2['item'] . " order " . $dt2['ordno'];
                $insert2 = mysqli_query($koneksi, "insert into logtran set
        logdtime=NOW(),
        logdate=NOW(),
        logtime=NOW(),
        logip='$ip',
        lognote='$lognote',
        ordpk='$dt2[ordpk]',
        rkbpk='$rkbpk',
        sistem='$sistem'");
                echo json_encode(
                    array(
                        'success' => true,
                        'msg' => "<div class='text-infohijau' style='width:355px;'>PO data updated &nbsp; &#10004; </div>"
                    )
                );
            }
        }
    }
}

if ($_GET['x'] == "piform") {
    $file_name = $_FILES['uploadfile']['name'];
    $tmp_name = $_FILES['uploadfile']['tmp_name'];
    $file_size = $_FILES['uploadfile']['size'];
    $file_type = $_FILES['uploadfile']['type'];
    $dir = "../upload/$file_name";
    $maxsize = 3100000;
    $format = array('application/pdf');

    $ext = strtolower(end(explode('.', $file_name)));
    /*$new_name ="$_POST[popk]".".$ext";*/
    if ($file_size == 0) {
        echo "<div class='text-infomerah' style='width:285px;'> There is error process upload &nbsp; &#x2573; </div>";
    } else {
        if ($file_size > $maxsize) {
            echo "<div class='text-infomerah' style='width:285px;'>File must be less than 3 mb &nbsp; &#x2573; </div>";
        } else if ($ext <> "pdf") {
            echo "<div class='text-infomerah' style='width:285px;'>Invalid file type, only PDF &nbsp; &#x2573; </div>";
        } else {
            $cr = mysqli_query($koneksi, "select * from po where popk='$_POST[popk]'");
            $dt = mysqli_fetch_array($cr);
            if ($dt['email'] == 0) {
                //include "../email/index.php?id=pay&po=$_POST[popk]";
            }
            if ($dt['pidate'] > 0) {
                if ($dt['postatpk'] <= 2) {
                    $update = mysqli_query($koneksi, "update po set pidate=NOW(), piform='$file_name', postatpk='4', email='1', dateupdt2=NOW(), tpo2c='1' where popk='$_POST[popk]'");
                    $update2 = mysqli_query($koneksi, "update rkb set status='6' where popk='$_POST[popk]'");
                } else {
                    $update = mysqli_query($koneksi, "update po set pidate=NOW(), piform='$file_name', email='1', dateupdt2=NOW(), tpo2c='1' where popk='$_POST[popk]'");
                }
            } else {
                if ($dt['postatpk'] <= 2) {
                    $update = mysqli_query($koneksi, "update po set pidate=NOW(), piform='$file_name', postatpk='4', email='1', dateupdt2=NOW(), tpo2c='1' where popk='$_POST[popk]'");
                    $update2 = mysqli_query($koneksi, "update rkb set status='6' where popk='$_POST[popk]'");
                } else {
                    $update = mysqli_query($koneksi, "update po set pidate=NOW(), piform='$file_name', email='1', dateupdt2=NOW(), tpo2c='1' where popk='$_POST[popk]'");
                }
            }
            move_uploaded_file($tmp_name, $dir);
            echo "<div class='text-infohijau' style='width:285px;'>Upload File PI Success &nbsp; &#10004; </div>";
        }
    }
}

if ($_GET['x'] == "revised") {
    //include "../email/index.php?id=rev2&po=$_POST[popk]&memo=$_POST[memo]";
    $cr = mysqli_query($koneksi, "select * from rkb
    left outer join ord on ord.ordpk=rkb.ordpk
    where rkb.popk='$_POST[popk]'");
    while ($dt = mysqli_fetch_array($cr)) {
        $result = mysqli_query($koneksi, "insert into memo set
        memonm='$_POST[memo]',
        rkbpk='$dt[rkbpk]',
        tgl2=NOW(),
        tgl1=NOW(),
        user='$_POST[pur]',
        fupk='$dt[fupk]',
        po='1',
        cek='1'");
    }
    $updaterev1 = mysqli_query($koneksi, "update po set tglrev=NOW(), postatpk='2' where popk='$_POST[popk]'");
    $updaterev2 = mysqli_query($koneksi, "update rkb set revdate=NOW(), status='3', stspk=NULL where popk='$_POST[popk]'");
    $updaterev3 = mysqli_query($koneksi, "update rpo set revdate=NOW(), stspk='4' where popk='$_POST[popk]'");
    $updaterev3 = mysqli_query($koneksi, "update podt set stspk='4' where popk='$_POST[popk]'");
    echo "<div class='text-infohijau'> PO data revised &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "cancel") {
    $updaterev1 = mysqli_query($koneksi, "update po set postatpk='3' where popk='$_POST[popk3]'");
    $updaterev2 = mysqli_query($koneksi, "update rkb set candate=NOW(), stspk='7' where popk='$_POST[popk3]'");
    $updaterev3 = mysqli_query($koneksi, "update rpo set candate=NOW(), stspk='7' where popk='$_POST[popk3]'");
    $updaterev4 = mysqli_query($koneksi, "update podt set stspk='7' where popk='$_POST[popk3]'");
    echo "<div class='text-infohijau'> PO data canceled &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "insert") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $sql2 = mysqli_query($koneksi, "select * from rpo where rkbpk='$id'");
        /*while($dtb= mysqli_fetch_array($sql2)){*/
        $dtb = mysqli_fetch_array($sql2);
        /*$tpo=$dtb['pocons']*$dtb['price'];
        $tot=$tot+$tpo;*/
        /*$update4 = @mysqli_query($koneksi,"update po set tot='$tot' where popk='$popk'");*/
        $item = addslashes($dtb['item']);
        $itemadd = addslashes($dtb['itemadd']);
        $spec = addslashes($dtb['spec']);
        $specadd = addslashes($dtb['specadd']);
        $sup = addslashes($dtb['sup']);
        $spec1 = addslashes($dtb['spec1']);
        $spec2 = addslashes($dtb['spec2']);
        $spec3 = addslashes($dtb['spec3']);
        $spec4 = addslashes($dtb['spec4']);
        $spec5 = addslashes($dtb['spec5']);
        $spec6 = addslashes($dtb['spec6']);
        $spec7 = addslashes($dtb['spec7']);
        $spec8 = addslashes($dtb['spec8']);
        $sizegar = addslashes($dtb['sizegar']);
        $colname = addslashes($dtb['colname']);

        $cr = mysqli_query($koneksi, "select * from podt where rkbpk='$dtb[rkbpk]'");
        $dt = mysqli_fetch_array($cr);

        if ($dt['podtpk'] > 0) {
            $result = mysqli_query($koneksi, "update podt set 
stspk='1', 
popk=NULL, 
delsts='0', 
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
stspk='1',
f1='$dtb[f1]',
f2='$dtb[f2]',
matusage = '$dtb[matusage]' where rkbpk='$dtb[rkbpk]'");
            $sukses++;
        } else {
            $result = mysqli_query($koneksi, "insert into podt set
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
stspk='1',
f1='$dtb[f1]',
f2='$dtb[f2]',
matusage = '$dt[matusage]'");
            $sukses++;
        }
        /*}*/
        if ($sukses > 0) {
            echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau'> $_GET[count] Item processed for PO &nbsp; &#10004; </div>"));
        } else {
            echo json_encode(array('msg' => "<div class='text-infomerah'>There is error process PO &nbsp; &#x2573; </div>"));
        }
    }
}
if ($_GET['x'] == "caninsert") {
    $result = mysqli_query($koneksi, "delete from podt
where stspk='1' and suppk='$_POST[suppk]' and popk is null");
    echo "<div class='text-infomerah'>Cancel insert PO &nbsp; &#x2573; </div>";
}
if ($_GET['x'] == "insert2") {
    $crpo = mysqli_query($koneksi, "select * from sup where suppk='$_POST[suppk]'");
    $dtpo = mysqli_fetch_array($crpo);
    $sup = addslashes($dtpo['supnm']);

    $cr = mysqli_query($koneksi, "select * from podt where stspk='1' and suppk='$_POST[suppk]' and popk is null");
    while ($dt = mysqli_fetch_array($cr)) {
        $update2 = mysqli_query($koneksi, "update rkb set
newdate=NOW(),
popk='$_GET[popk]',
suppk='$_POST[suppk]',
sup='$sup',
stspk='2',
status='4' where rkbpk='$dt[rkbpk]'");
        $update3 = mysqli_query($koneksi, "update rpo set
newdate=NOW(),
popk='$_GET[popk]',
suppk='$_POST[suppk]',
sup='$sup',
stspk='2',
posts='1',
popros='1' where rkbpk='$dt[rkbpk]'");
    }
    $result = mysqli_query($koneksi, "update podt set 
popk='$_GET[popk]', 
suppk='$_POST[suppk]',
sup='$sup',
stspk='2' where stspk='1' and suppk='$_POST[suppk]' and popk is null");

    //$result3 = mysqli_query($koneksi,"update rpo set posts='1' where popk='$popk' and posts='0' and stspk='2'");
    echo "<div class='text-infohijau'> $_POST[tot] Item for insert PO &nbsp; &#x2573; </div>";
}
if ($_GET['x'] == "updatepi") {
    $updaterev2 = mysqli_query($koneksi, "update rkb set piqty='$_GET[piqty]', piprice='$_GET[piprice]' where rkbpk='$_POST[rkbpk2]'");
    echo "<div class='text-infohijau'> PO data updated &nbsp; &#10004; </div>";
}
if ($_GET['x'] == "pswd") {
    $password = $_GET['cnfrm'];
    $datechange = $next3;
    $userpk = $_POST['usrpk'];

    $query = "UPDATE user SET password='$password', datechange='$datechange' WHERE userpk='$userpk'";
    mysqli_query($koneksi, $query);

    $query2 = "UPDATE user SET password='$password', datechange='$datechange', dateupdate=NOW() WHERE username='$_SESSION[usernm]'";
    mysqli_query($koneksi11u, $query2);

    $query3 = "UPDATE user 
    LEFT JOIN fu ON fu.fupk = user.fupk
    SET 
    user.password = '$password', 
    user.datechange = '$datechange', 
    WHERE fu.email = '$_SESSION[usernm]'";
    mysqli_query($koneksi11s, $query3);
    // $pswd = mysqli_query($koneksi, "update user set password='$_GET[cnfrm]', datechange='$next3' where userpk='$_POST[usrpk]'");
    echo "<div class='text-infohijau' style='width:285px;'> Password successfully updated &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "canreq") {
    $cr = mysqli_query($koneksi, "select * from rkb where rkbpk='$_POST[id]'");
    $dt = mysqli_fetch_array($cr);
    if ($dt['popk'] > 0) {
        $update1 = mysqli_query($koneksi, "update rkb set stspk=NULL, poreqdel=NULL, podel=NULL, status='2', rkbsts='0', candate=NOW() where rkbpk='$_POST[id]'");
        $update2 = mysqli_query($koneksi, "delete from rpo where rkbpk='$_POST[id]'");
        $update3 = mysqli_query($koneksi, "delete from podt where rkbpk='$_POST[id]'");
        //$delete=mysqli_query($koneksi,"delete from podt where rkbpk='$_POST[id]'");
        // $update1=mysqli_query($koneksi,"update rkb set stspk='7', status='4', candate=NOW() where rkbpk='$_POST[id]'");
        // $update2=mysqli_query($koneksi,"update rpo set stspk='7', candate=NOW() where rkbpk='$_POST[id]'");
        // $update3=mysqli_query($koneksi,"update podt set stspk='7' where rkbpk='$_POST[id]'");
        // $update4=mysqli_query($koneksi,"update po set tglcan=NOW(), postatpk='3' where popk='$dt[popk]'");

        $cr2 = mysqli_query($koneksi, "select * from ord where ordpk='$dt[ordpk]'");
        $dt2 = mysqli_fetch_array($cr2);
        $lognote = "User " . $userlog . " remove item from PO " . $dt['item'] . " order no " . $dt2['ordno'];
        $insert2 = mysqli_query($koneksi, "insert into logtran set
logdtime=NOW(),
logdate=NOW(),
logtime=NOW(),
logip='$ip',
lognote='$lognote',
ordpk='$dt[ordpk]',
rkbpk='$_POST[id]',
sistem='$sistem'");
    } else {
        $delete = mysqli_query($koneksi, "delete from rpo where rkbpk='$_POST[id]'");
        $update = mysqli_query($koneksi, "update rkb set stspk=NULL, poreqdel=NULL, podel=NULL, status='2', rkbsts='0' where rkbpk='$_POST[id]'");

        $cr2 = mysqli_query($koneksi, "select * from ord where ordpk='$dt[ordpk]'");
        $dt2 = mysqli_fetch_array($cr2);
        $lognote = "User " . $userlog . " cancel request material " . $dt['item'] . " order no " . $dt2['ordno'];
        $insert2 = mysqli_query($koneksi, "insert into logtran set
logdtime=NOW(),
logdate=NOW(),
logtime=NOW(),
logip='$ip',
lognote='$lognote',
ordpk='$dt[ordpk]',
rkbpk='$_POST[id]',
sistem='$sistem'");
    }
    echo "<div class='text-infohijau'> Cancel request success &nbsp; &#10004; </div>";
}
if ($_GET['x'] == "canreq2") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $cr = mysqli_query($koneksi, "select * from rkb where rkbpk='$id'");
        $dt = mysqli_fetch_array($cr);
        if ($dt['popk'] > 0) {
            $update1 = mysqli_query($koneksi, "update rkb set popk=NULL, stspk=NULL, poreqdel=NULL, podel=NULL, status='2', rkbsts='0', candate=NOW() where rkbpk='$id'");
            $update2 = mysqli_query($koneksi, "delete from rpo where rkbpk='$id'");
            $update3 = mysqli_query($koneksi, "delete from podt where rkbpk='$id'");
            // $delete=mysqli_query($koneksi,"delete from podt where rkbpk='$_POST[id]'");
            // $update1=mysqli_query($koneksi,"update rkb set stspk='7', status='4', candate=NOW() where rkbpk='$id'");
            // $update2=mysqli_query($koneksi,"update rpo set stspk='7', candate=NOW() where rkbpk='$id'");
            // $update3=mysqli_query($koneksi,"update podt set stspk='7' where rkbpk='$id'");
            // $update4=mysqli_query($koneksi,"update po set tglcan=NOW(), postatpk='3' where popk='$dt[popk]'");

            $cr2 = mysqli_query($koneksi, "select * from ord where ordpk='$dt[ordpk]'");
            $dt2 = mysqli_fetch_array($cr2);
            $lognote = "User " . $userlog . " remove item from PO " . $dt['item'] . " order no " . $dt2['ordno'];
            $insert2 = mysqli_query($koneksi, "insert into logtran set
logdtime=NOW(),
logdate=NOW(),
logtime=NOW(),
logip='$ip',
lognote='$lognote',
ordpk='$dt[ordpk]',
rkbpk='$id',
sistem='$sistem'");
            if ($update1) {
                echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:415px'>Remove item from PO success &nbsp; &#10004; </div>"));
            } else {
                echo json_encode(array('msg' => "<div class='text-infomerah' style='width:415px'>There is error remove item from PO &nbsp; &#x2573; </div>"));
            }
        } else {
            $update3 = mysqli_query($koneksi, "delete from podt where rkbpk='$id'");
            $delete = mysqli_query($koneksi, "delete from rpo where rkbpk='$id'");
            $update1 = mysqli_query($koneksi, "update rkb set stspk=NULL, poreqdel=NULL, podel=NULL, status='2', rkbsts='0' where rkbpk='$id'");

            $cr2 = mysqli_query($koneksi, "select * from ord where ordpk='$dt[ordpk]'");
            $dt2 = mysqli_fetch_array($cr2);
            $lognote = "User " . $userlog . " cancel request material " . $dt['item'] . " order no " . $dt2['ordno'];
            $insert2 = mysqli_query($koneksi, "insert into logtran set
logdtime=NOW(),
logdate=NOW(),
logtime=NOW(),
logip='$ip',
lognote='$lognote',
ordpk='$dt[ordpk]',
rkbpk='$id',
sistem='$sistem'");
            if ($update1) {
                echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:415px'>Cancel request success &nbsp; &#10004; </div>"));
            } else {
                echo json_encode(array('msg' => "<div class='text-infomerah' style='width:415px'>There is error cancel request &nbsp; &#x2573; </div>"));
            }
        }
        //echo "<div class='text-infohijau'> Cancel request success &nbsp; &#10004; </div>";
    }
}
if ($_GET['x'] == "reqrev") {
    $cr = mysqli_query($koneksi, "select * from rkb where rkbpk='$_POST[id]'");
    $dt = mysqli_fetch_array($cr);
    $update = mysqli_query($koneksi, "update rkb set revdate=NOW(), stspk='4' where rkbpk='$_POST[id]'");
    $update2 = mysqli_query($koneksi, "update rpo set revdate=NOW(), stspk='4' where rkbpk='$_POST[id]'");
    $update3 = mysqli_query($koneksi, "update podt set stspk='4' where rkbpk='$_POST[id]'");
    $update4 = mysqli_query($koneksi, "update po set tglrev=NOW(), postatpk='2' where popk='$dt[popk]'");
    echo "<div class='text-infohijau'> Request revised success &nbsp; &#10004; </div>";
}
if ($_GET['x'] == "reqrev2") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $cr = mysqli_query($koneksi, "select * from rkb where rkbpk='$_POST[id]'");
        $dt = mysqli_fetch_array($cr);
        $update = mysqli_query($koneksi, "update rkb set revdate=NOW(), stspk='4' where rkbpk='$_POST[id]'");
        $update2 = mysqli_query($koneksi, "update rpo set revdate=NOW(), stspk='4' where rkbpk='$_POST[id]'");
        $update3 = mysqli_query($koneksi, "update podt set stspk='4' where rkbpk='$_POST[id]'");
        $update4 = mysqli_query($koneksi, "update po set tglrev=NOW(), postatpk='2' where popk='$dt[popk]'");
        if ($update) {
            echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau'>Request revised success &nbsp; &#10004; </div>"));
        } else {
            echo json_encode(array('msg' => "<div class='text-infomerah'>There is error request revised &nbsp; &#x2573; </div>"));
        }
        //echo "<div class='text-infohijau'> Request revised success &nbsp; &#10004; </div>";
    }
}
if ($_GET['x'] == "addusr") {
    $username = $_POST['username2'] . $_POST['domain'];
    if ($_POST['userpk'] > 0) {
        $update = mysqli_query($koneksi, "update user set
fupk='$_POST[fupk2]',
guserpk='2',
login='$_POST[login]',
password='$_POST[password]',
username='$username' where userpk='$_POST[userpk]'");
    } else {
        $update = mysqli_query($koneksi, "insert into user set
fupk='$_POST[fupk2]',
guserpk='2',
login='$_POST[login]',
password='$_POST[password]',
username='$username'");
    }
    echo "<div class='text-infohijau'> Save handle success &nbsp; &#10004; </div>";
}
if ($_GET['x'] == "canassign") {
    $result2 = mysqli_query($koneksi, "update ord set userpk=NULL where fupk='$_POST[fupk2]' and userpk='99'");
    echo "<div class='text-infomerah'>Cancel assignment order &nbsp; &#x2573; </div>";
}
if ($_GET['x'] == "assign") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $result = @mysqli_query($koneksi, "update ord set userpk='99' where ordpk='$id'");
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:415px;'>Assignment order success &nbsp; &#10004; </div>"));
        } else {
            echo json_encode(array('msg' => "<div class='text-infomerah' style='width:415px;'>Cannot process assignment order &nbsp; &#x2573; </div>"));
        }
    }
}
if ($_GET['x'] == "assign2") {
    $result2 = mysqli_query($koneksi, "update ord set userpk='$_POST[md2]' where fupk='$_POST[fupk2]' and userpk='99'");
    echo "<div class='text-infohijau'>Assignment order success &nbsp; &#10004; </div>";
}
if ($_GET['x'] == "replace1") {
    $result2 = mysqli_query($koneksi, "update rkb set copy='5' where rkbpk='$_POST[rkbpk]'");
    //echo "<div class='text-infohijau'>Assignment order success &nbsp; &#10004; </div>";
}
if ($_GET['x'] == "canreplace") {
    $result2 = mysqli_query($koneksi, "update rkb set copy='0' where ordpk='$_POST[ord]' and copy='5'");
    $result3 = mysqli_query($koneksi, "update rkb set copy='0' where ordpk='$_POST[ord]' and copy='5'");
    //echo "<div class='text-infohijau'>Assignment order success &nbsp; &#10004; </div>";
}
if ($_GET['x'] == "replace2") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $result = @mysqli_query($koneksi, "update rkb set copy='6' where rkbpk='$id'");
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:415px;'>Replace data material success &nbsp; &#10004; </div>"));
        } else {
            echo json_encode(array('msg' => "<div class='text-infomerah' style='width:415px;'>Cannot process replace data material &nbsp; &#x2573; </div>"));
        }
    }
}
if ($_GET['x'] == "replace3") {
    $cr1 = mysqli_query($koneksi, "select * from rkb where ordpk='$_POST[ordpk]' and copy='5'");
    $dt1 = mysqli_fetch_array($cr1);
    $item1 = addslashes($dt1['item']);
    $spec1 = addslashes($dt1['spec']);
    $colname1 = addslashes($dt1['colname']);
    $suppk1 = $dt1['suppk'];
    $sup1 = $dt1['sup'];
    $estcons1 = $dt1['estcons'];
    $allowcons1 = $dt1['allowcons'];
    $bdownqty1 = $dt1['bdownqty'];
    $unit1 = $dt1['unit'];
    $price1 = $dt1['price'];
    $curpk1 = $dt1['curpk'];

    $cr2 = mysqli_query($koneksi, "select * from rkb where ordpk='$_POST[ordpk]' and copy='6'");
    while ($dt2 = mysqli_fetch_array($cr2)) {
        $item2 = addslashes($dt2['item']);
        $spec2 = addslashes($dt2['spec']);
        $colname2 = addslashes($dt2['colname']);
        $suppk2 = $dt2['suppk'];
        $sup2 = $dt2['sup'];
        $estcons2 = $dt2['estcons'];
        $allowcons2 = $dt2['allowcons'];
        $bdownqty2 = $dt2['bdownqty'];
        $unit2 = $dt2['unit'];
        $price2 = $dt2['price'];
        $curpk2 = $dt2['curpk'];
        $stspk = $dt2['stspk'];

        if ($_POST['ceek1'] == "1") {
            $item = $item1;
        } else {
            $item = $item2;
        }

        if ($_POST['ceek2'] == "2") {
            $spec = $spec1;
        } else {
            $spec = $spec2;
        }

        if ($_POST['ceek3'] == "3") {
            $suppk = $suppk1;
            $sup = $sup1;
        } else {
            $suppk = $suppk2;
            $sup = $sup2;
        }

        if ($_POST['ceek4'] == "4") {
            $colname = $colname1;
        } else {
            $colname = $colname2;
        }

        if ($_POST['ceek5'] == "5") {
            $estcons = $estcons1;
        } else {
            $estcons = $estcons2;
        }

        if ($_POST['ceek6'] == "6") {
            $allowcons = $allowcons1;
        } else {
            $allowcons = $allowcons2;
        }

        if ($_POST['ceek7'] == "7") {
            $bdownqty = $bdownqty1;
            $unit = $unit1;
        } else {
            $bdownqty = $bdownqty2;
            $unit = $unit2;
        }

        if ($_POST['ceek8'] == "8") {
            $price = $price1;
            $curpk = $curpk1;
        } else {
            $price = $price2;
            $curpk = $curpk2;
        }

        if ($stspk == 4) {
            $result1 = mysqli_query($koneksi, "update rkb set stspk='5' where rkbpk='$dt2[rkbpk]'");
            $result1b = mysqli_query($koneksi, "update rpo set stspk='5' where rkbpk='$dt2[rkbpk]'");
            $result1c = mysqli_query($koneksi, "update podt set stspk='5' where rkbpk='$dt2[rkbpk]'");
        }

        $result2 = mysqli_query($koneksi, "update rkb set
            item='$item',
            spec='$spec',
            suppk='$suppk',
            sup='$sup',
            colname='$colname',
            estcons='$estcons',
            allowcons='$allowcons',
            bdownqty='$bdownqty',
            unit='$unit',
            price='$price',
            curpk='$curpk' where rkbpk='$dt2[rkbpk]'");

        $result2b = mysqli_query($koneksi, "update rpo set
            item='$item',
            spec='$spec',
            suppk='$suppk',
            sup='$sup',
            colname='$colname',
            estcons='$estcons',
            allowcons='$allowcons',
            bdownqty='$bdownqty',
            unit='$unit',
            price='$price',
            curpk='$curpk' where rkbpk='$dt2[rkbpk]'");
        
        $result2c = mysqli_query($koneksi, "update podt set
            item='$item',
            spec='$spec',
            suppk='$suppk',
            sup='$sup',
            colname='$colname',
            estcons='$estcons',
            allowcons='$allowcons',
            bdownqty='$bdownqty',
            unit='$unit',
            price='$price',
            curpk='$curpk' where rkbpk='$dt2[rkbpk]'");
    }

    // if($_POST['all']=="99"){
    // $result2 = mysqli_query($koneksi,"update rkb set
    // item='$item',
    // spec='$spec',
    // suppk='$dt[suppk]',
    // sup='$dt[sup]',
    // colname='$colname',
    // estcons='$dt[estcons]',
    // allowcons='$dt[allowcons]',
    // bdownqty='$dt[bdownqty]',
    // unit='$dt[unit]',
    // price='$dt[price]',
    // curpk='$dt[curpk]' where ordpk='$_POST[ordpk]' and copy='4'");
    // $result3 = mysqli_query($koneksi,"update rkb set copy='0' where ordpk='$_POST[ordpk]' and copy='3'");
    // $result4 = mysqli_query($koneksi,"update rkb set copy='5' where ordpk='$_POST[ordpk]' and copy='4'");
    // } else {
    // if($_POST['ceek1']=="1" && $_POST['ceek2']=="2" && $_POST['ceek3']=="3" && $_POST['ceek4']=="4" && $_POST['ceek5']=="5" && $_POST['ceek6']=="6" && $_POST['ceek7']=="7" && $_POST['ceek8']=="8"){
    // $result2 = mysqli_query($koneksi,"update rkb set
    // item='$item',
    // spec='$spec',
    // suppk='$dt[suppk]',
    // sup='$dt[sup]',
    // colname='$colname',
    // estcons='$dt[estcons]',
    // allowcons='$dt[allowcons]',
    // bdownqty='$dt[bdownqty]',
    // unit='$dt[unit]',
    // price='$dt[price]',
    // curpk='$dt[curpk]' where ordpk='$_POST[ordpk]' and copy='4'");
    // } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2" && $_POST['ceek3']=="3" && $_POST['ceek4']=="4" && $_POST['ceek5']=="5" && $_POST['ceek6']=="6" && $_POST['ceek7']=="7"){
    // $result2 = mysqli_query($koneksi,"update rkb set
    // item='$item',
    // spec='$spec',
    // suppk='$dt[suppk]',
    // sup='$dt[sup]',
    // colname='$colname',
    // estcons='$dt[estcons]',
    // allowcons='$dt[allowcons]',
    // bdownqty='$dt[bdownqty]',
    // unit='$dt[unit]' where ordpk='$_POST[ordpk]' and copy='4'");
    // } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2" && $_POST['ceek3']=="3" && $_POST['ceek4']=="4" && $_POST['ceek5']=="5" && $_POST['ceek6']=="6"){
    // $result2 = mysqli_query($koneksi,"update rkb set
    // item='$item',
    // spec='$spec',
    // suppk='$dt[suppk]',
    // sup='$dt[sup]',
    // colname='$colname',
    // estcons='$dt[estcons]',
    // allowcons='$dt[allowcons]' where ordpk='$_POST[ordpk]' and copy='4'");
    // } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2" && $_POST['ceek3']=="3" && $_POST['ceek4']=="4" && $_POST['ceek5']=="5"){
    // $result2 = mysqli_query($koneksi,"update rkb set
    // item='$item',
    // spec='$spec',
    // suppk='$dt[suppk]',
    // sup='$dt[sup]',
    // colname='$colname',
    // estcons='$dt[estcons]' where ordpk='$_POST[ordpk]' and copy='4'");
    // } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2" && $_POST['ceek3']=="3" && $_POST['ceek4']=="4"){
    // $result2 = mysqli_query($koneksi,"update rkb set
    // item='$item',
    // spec='$spec',
    // suppk='$dt[suppk]',
    // sup='$dt[sup]',
    // colname='$colname' where ordpk='$_POST[ordpk]' and copy='4'");
    // } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2" && $_POST['ceek3']=="3"){
    // $result2 = mysqli_query($koneksi,"update rkb set
    // item='$item',
    // spec='$spec',
    // suppk='$dt[suppk]',
    // sup='$dt[sup]' where ordpk='$_POST[ordpk]' and copy='4'");
    // } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2"){
    // $result2 = mysqli_query($koneksi,"update rkb set
    // item='$item',
    // spec='$spec' where ordpk='$_POST[ordpk]' and copy='4'");
    // } else {
    // if($_POST['ceek1']=="1"){ $result2 = mysqli_query($koneksi,"update rkb set item='$item' where ordpk='$_POST[ordpk]' and copy='4'"); }
    // else if($_POST['ceek2']=="2"){ $result2 = mysqli_query($koneksi,"update rkb set spec='$spec' where ordpk='$_POST[ordpk]' and copy='4'"); } 
    // else if($_POST['ceek3']=="3"){ $result2 = mysqli_query($koneksi,"update rkb set suppk='$dt[suppk]', sup='$dt[sup]' where ordpk='$_POST[ordpk]' and copy='4'"); }
    // else if($_POST['ceek4']=="4"){ $result2 = mysqli_query($koneksi,"update rkb set colname='$colname' where ordpk='$_POST[ordpk]' and copy='4'"); }
    // else if($_POST['ceek5']=="5"){ $result2 = mysqli_query($koneksi,"update rkb set estcons='$dt[estcons]' where ordpk='$_POST[ordpk]' and copy='4'"); }
    // else if($_POST['ceek6']=="6"){ $result2 = mysqli_query($koneksi,"update rkb set allowcons='$dt[allowcons]' where ordpk='$_POST[ordpk]' and copy='4'"); }
    // else if($_POST['ceek7']=="7"){ $result2 = mysqli_query($koneksi,"update rkb set bdownqty='$dt[bdownqty]', unit='$dt[unit]' where ordpk='$_POST[ordpk]' and copy='4'"); }
    // else if($_POST['ceek8']=="8"){ $result2 = mysqli_query($koneksi,"update rkb set price='$dt[price]', curpk='$dt[curpk]' where ordpk='$_POST[ordpk]' and copy='4'"); }
    // }
    $result3 = mysqli_query($koneksi, "update rkb set copy='0' where ordpk='$_POST[ordpk]' and copy='5'");
    $result4 = mysqli_query($koneksi, "update rkb set copy='7' where ordpk='$_POST[ordpk]' and copy='6'");
    // }
    echo "<div class='text-infohijau'>Data successfully replaced &nbsp; &#10004; </div>";
}
if ($_GET['x'] == "tpo2") {
    $tpo2 = mysqli_query($koneksi, "update po set tpo2='0' where popk='$_GET[po]'");
}
if ($_GET['x'] == "mempo") {
    $result2 = mysqli_query($koneksi, "update po set
tpo1='0',
tpo2='0' where popk='$_GET[po]'");
?>
    <script language="javascript">
        document.location = "../admin?hal=detpo&x=<?php echo $_GET['x1']; ?>&po=<?php echo $_GET['po']; ?>";
    </script>
<?php }
if ($_GET['x'] == "mempo2") {
    $result2 = mysqli_query($koneksi, "update po set tpo1='0' where tpo1='1' and pur='$_GET[pur]'");
?>
    <script language="javascript">
        document.location = "../admin?hal=wait";
    </script>
    <?php
}
if ($_GET['x'] == "requestpo") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $row = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb WHERE rkbpk='$id' and status='2'"));
        $cr = mysqli_query($koneksi, "select * from rkb WHERE rkbpk='$id' and status='2'");
        $dt = mysqli_fetch_array($cr);
        if ($row > 0) {
            $result = @mysqli_query($koneksi, "update rkb set
submit='1',
submitdate=NOW(),
stspk='1',
status='2',
rkbsts='1' where rkbpk='$id'");
            // $cr = mysqli_query($koneksi, "select * from rkb where rkbpk='$id'");
            // $dt = mysqli_fetch_array($cr);
            $item = addslashes($dt['item']);
            $itemadd = addslashes($dt['itemadd']);
            $spec = addslashes($dt['spec']);
            $specadd = addslashes($dt['specadd']);
            $sup = addslashes($dt['sup']);
            $spec1 = addslashes($dt['spec1']);
            $spec2 = addslashes($dt['spec2']);
            $spec3 = addslashes($dt['spec3']);
            $spec4 = addslashes($dt['spec4']);
            $spec5 = addslashes($dt['spec5']);
            $spec6 = addslashes($dt['spec6']);
            $spec7 = addslashes($dt['spec7']);
            $spec8 = addslashes($dt['spec8']);
            $sizegar = addslashes($dt['sizegar']);
            $colname = addslashes($dt['colname']);

            $cr2 = mysqli_query($koneksi, "select * from rpo where rkbpk='$dt[rkbpk]'");
            $dt2 = mysqli_fetch_array($cr2);

            if ($dt2['rpopk'] > 0) {
                $result = mysqli_query($koneksi, "update rpo set popros='1', stspk='1' where rkbpk='$dt[rkbpk]'");
            } else {
                $insert = mysqli_query($koneksi, "insert into rpo set
ordpk='$dt[ordpk]',
rkbpk='$dt[rkbpk]',
nour='$dt[nour]',
tgljam=NOW(),
tgl=NOW(),
kelnm='$dt[kelnm]',
item='$item',
itemadd='$itemadd',
suppk='$dt[suppk]',
sup='$sup',
tspec='$dt[tspec]',
nspec='$dt[nspec]',
spec='$spec',
specadd='$specadd',
hspec1='$dt[hspec1]',
hspec2='$dt[hspec2]',
hspec3='$dt[hspec3]',
hspec4='$dt[hspec4]',
hspec5='$dt[hspec5]',
hspec6='$dt[hspec6]',
hspec7='$dt[hspec7]',
hspec8='$dt[hspec8]',
spec1='$spec1',
spec2='$spec2',
spec3='$spec3',
spec4='$spec4',
spec5='$spec5',
spec6='$spec6',
spec7='$spec7',
spec8='$spec8',
colname='$colname',
colcode='$dt[colcode]',
sizegar='$sizegar',
unit='$dt[unit]',
price='$dt[price]',
curpk='$dt[curpk]',
bdownqty='$dt[bdownqty]',
bdownpk='$dt[bdownpk]',
kolom='$dt[kolom]',
allowcons='$dt[allowcons]',
negocons='$dt[negocons]',
varcons='$dt[varcons]',
estcons='$dt[estcons]',
totcons='$dt[totcons]',
qrs='$dt[qrs]',
pocons='$dt[pocons]',
submit='1',
submitdate=NOW(),
stspk='1',
popros='1',
f1='$dt[f1]',
f2='$dt[f2]',
matusage = '$dt[matusage]'");
            }
            if ($result) {
                echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:375px;'> $N Materials processed for PO. <a href='?hal=proses' style='color:#ffffff;'>View</a> &nbsp; &#10004; </div>"));
            } else {
                echo json_encode(array('msg' => "<div class='text-infomerah' style='width:375px;'>There is error request &nbsp; &#x2573; </div>"));
            }
        } else {
            echo json_encode(array('msg' => "<div class='text-infomerah' style='width:435px;'>Cannot process because some items are incomplete &nbsp; &#x2573; </div>"));
        }
    }
}

if ($_GET['x'] == "requestpo2") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $row = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb WHERE rkbpk='$id' and status='2'"));
        $cr = mysqli_query($koneksi, "select * from rkb WHERE rkbpk='$id' and status='2'");
        $dt = mysqli_fetch_array($cr);
        if ($row > 0) {
            $result = @mysqli_query($koneksi, "update rkb set
            submit='1',
            submitdate=NOW(),
            stspk='1',
            status='2',
            rkbsts='1' where rkbpk='$id'");
            // $cr = mysqli_query($koneksi, "select * from rkb where rkbpk='$id'");
            // $dt = mysqli_fetch_array($cr);
            $item = addslashes($dt['item']);
            $itemadd = addslashes($dt['itemadd']);
            $spec = addslashes($dt['spec']);
            $specadd = addslashes($dt['specadd']);
            $sup = addslashes($dt['sup']);
            $spec1 = addslashes($dt['spec1']);
            $spec2 = addslashes($dt['spec2']);
            $spec3 = addslashes($dt['spec3']);
            $spec4 = addslashes($dt['spec4']);
            $spec5 = addslashes($dt['spec5']);
            $spec6 = addslashes($dt['spec6']);
            $spec7 = addslashes($dt['spec7']);
            $spec8 = addslashes($dt['spec8']);
            $sizegar = addslashes($dt['sizegar']);
            $colname = addslashes($dt['colname']);

            $cr2 = mysqli_query($koneksi, "select * from rpo where rkbpk='$dt[rkbpk]'");
            $dt2 = mysqli_fetch_array($cr2);

            if ($dt2['rpopk'] > 0) {
                $result = mysqli_query($koneksi, "update rpo set popros='2', stspk='1' where rkbpk='$dt[rkbpk]'");
            } else {
                $insert = mysqli_query($koneksi, "insert into rpo set
                        ordpk='$dt[ordpk]',
                        rkbpk='$dt[rkbpk]',
                        nour='$dt[nour]',
                        tgljam=NOW(),
                        tgl=NOW(),
                        kelnm='$dt[kelnm]',
                        item='$item',
                        itemadd='$itemadd',
                        suppk='$dt[suppk]',
                        sup='$sup',
                        tspec='$dt[tspec]',
                        nspec='$dt[nspec]',
                        spec='$spec',
                        specadd='$specadd',
                        hspec1='$dt[hspec1]',
                        hspec2='$dt[hspec2]',
                        hspec3='$dt[hspec3]',
                        hspec4='$dt[hspec4]',
                        hspec5='$dt[hspec5]',
                        hspec6='$dt[hspec6]',
                        hspec7='$dt[hspec7]',
                        hspec8='$dt[hspec8]',
                        spec1='$spec1',
                        spec2='$spec2',
                        spec3='$spec3',
                        spec4='$spec4',
                        spec5='$spec5',
                        spec6='$spec6',
                        spec7='$spec7',
                        spec8='$spec8',
                        colname='$colname',
                        colcode='$dt[colcode]',
                        sizegar='$sizegar',
                        unit='$dt[unit]',
                        price='$dt[price]',
                        curpk='$dt[curpk]',
                        bdownqty='$dt[bdownqty]',
                        bdownpk='$dt[bdownpk]',
                        kolom='$dt[kolom]',
                        allowcons='$dt[allowcons]',
                        negocons='$dt[negocons]',
                        varcons='$dt[varcons]',
                        estcons='$dt[estcons]',
                        totcons='$dt[totcons]',
                        qrs='$dt[qrs]',
                        pocons='$dt[pocons]',
                        submit='1',
                        submitdate=NOW(),
                        stspk='1',
                        popros='2',
                        f1='$dt[f1]',
                        f2='$dt[f2]',
                        matusage = '$dt[matusage]'");
            }
            if ($result) {
                echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:375px;'> $N Materials processed for PO. <a href='?hal=proses' style='color:#ffffff;'>View</a> &nbsp; &#10004; </div>"));
            } else {
                echo json_encode(array('msg' => "<div class='text-infomerah' style='width:375px;'>There is error request &nbsp; &#x2573; </div>"));
            }
        } else {
            echo json_encode(array('msg' => "<div class='text-infomerah' style='width:435px;'>Cannot process because some items are incomplete &nbsp; &#x2573; </div>"));
        }
    }
}

if ($_GET['x'] == "canreqpo") {
    $cr = mysqli_query($koneksi, "select * from rkb where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and poreqdel is null and status='2'");
    while ($dt = mysqli_fetch_array($cr)) {
        $result2 = mysqli_query($koneksi, "delete from rpo where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and poreqdel is null and rkbpk='$dt[rkbpk]'");
    }
    $result = mysqli_query($koneksi, "update rkb set
submit=NULL,
submitdate=NULL,
stspk=NULL,
rkbsts='0'
where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and poreqdel is null and status='2'");
    //echo "<div class='text-infomerah'>Cancel request PO &nbsp; &#x2573; </div>";
}

if ($_GET['x'] == "savereqpo1") {
    $result = mysqli_query($koneksi, "update rkb set
        poreqdel='$_POST[poreqdel]', podel='$_POST[poreqdel]'
        where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and poreqdel is null and status='2'");

    $result2 = mysqli_query($koneksi, "update rpo set
        poreqdel='$_POST[poreqdel]'
        where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and poreqdel is null and popros='2'");
    echo "<div class='text-infohijau' style='width:375px;'> $_POST[totreq] Materials processed for PO. <a href='?hal=proses' style='color:#ffffff;'>View</a> &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "savereqpo") {
    $result = mysqli_query($koneksi, "update rkb set
status='4'
where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and poreqdel is null and status='2'");
    echo "<div class='text-infohijau' style='width:375px;'> $_POST[totreq] Materials processed for PO. <a href='?hal=proses' style='color:#ffffff;'>View</a> &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "savereqpo2a") {
    $result = mysqli_query($koneksi, "update rkb set
poreqdel='$_POST[poreqdel]', 
podel='$_POST[poreqdel]',
status='4' where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and status='2'");

    $result2 = mysqli_query($koneksi, "update rpo set
poreqdel='$_POST[poreqdel]',
popros='0' where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and popros='2'");
    echo "<div class='text-infohijau' style='width:275px;'> PO request sent &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "savereqpo2aa") {
    $result = mysqli_query($koneksi, "update rkb set
    status='4'
    where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and status='2'");

    $result2 = mysqli_query($koneksi, "update rpo set
    popros='0'
    where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and popros='2'");
    echo "<div class='text-infohijau' style='width:275px;'> PO request sent &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "savereqpo2") {
    $result = mysqli_query($koneksi, "update rkb set
        status='4'
        where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and status='2'");

    $result2 = mysqli_query($koneksi, "update rpo set
        popros='1'
        where submit='1' and stspk='1' and ordpk='$_POST[ordpk]' and popros='2'");
    echo "<div class='text-infohijau' style='width:375px;'> $_POST[totreq2] Materials processed for PO. <a href='?hal=proses' style='color:#ffffff;'>View</a> &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "prosespo") {
    $row = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb WHERE ordpk='$_POST[ordpk]' and status='2'"));
    if ($row > 0) {
        $cr = mysqli_query($koneksi, "select * from rkb WHERE ordpk='$_POST[ordpk]' and status='2'");
        while ($dt = mysqli_fetch_array($cr)) {
            $update = mysqli_query($koneksi, "update rkb set
                submit='1',
                submitdate=NOW(),
                stspk='1',
                status='4',
                rkbsts='1' where rkbpk='$dt[rkbpk]'");

            $item = addslashes($dt['item']);
            $itemadd = addslashes($dt['itemadd']);
            $spec = addslashes($dt['spec']);
            $specadd = addslashes($dt['specadd']);
            $sup = addslashes($dt['sup']);
            $spec1 = addslashes($dt['spec1']);
            $spec2 = addslashes($dt['spec2']);
            $spec3 = addslashes($dt['spec3']);
            $spec4 = addslashes($dt['spec4']);
            $spec5 = addslashes($dt['spec5']);
            $spec6 = addslashes($dt['spec6']);
            $spec7 = addslashes($dt['spec7']);
            $spec8 = addslashes($dt['spec8']);
            $sizegar = addslashes($dt['sizegar']);
            $colname = addslashes($dt['colname']);

            $cr2 = mysqli_query($koneksi, "select * from rpo where rkbpk='$dt[rkbpk]'");
            $dt2 = mysqli_fetch_array($cr2);

            if ($dt2['rpopk'] > 0) {
                $result = mysqli_query($koneksi, "update rpo set popros='1', stspk='1' where rkbpk='$dt[rkbpk]'");
            } else {
                $insert = mysqli_query($koneksi, "insert into rpo set
                popros='1',
                stspk='1',
                ordpk='$dt[ordpk]',
                rkbpk='$dt[rkbpk]',
                nour='$dt[nour]',
                tgljam=NOW(),
                tgl=NOW(),
                submit='$dt[submit]',
                submitdate='$dt[submitdate]',
                kelnm='$dt[kelnm]',
                item='$item',
                itemadd='$itemadd',
                suppk='$dt[suppk]',
                sup='$sup',
                tspec='$dt[tspec]',
                nspec='$dt[nspec]',
                spec='$spec',
                specadd='$specadd',
                hspec1='$dt[hspec1]',
                hspec2='$dt[hspec2]',
                hspec3='$dt[hspec3]',
                hspec4='$dt[hspec4]',
                hspec5='$dt[hspec5]',
                hspec6='$dt[hspec6]',
                hspec7='$dt[hspec7]',
                hspec8='$dt[hspec8]',
                spec1='$spec1',
                spec2='$spec2',
                spec3='$spec3',
                spec4='$spec4',
                spec5='$spec5',
                spec6='$spec6',
                spec7='$spec7',
                spec8='$spec8',
                colname='$colname',
                colcode='$dt[colcode]',
                sizegar='$sizegar',
                unit='$dt[unit]',
                price='$dt[price]',
                curpk='$dt[curpk]',
                bdownqty='$dt[bdownqty]',
                bdownpk='$dt[bdownpk]',
                kolom='$dt[kolom]',
                allowcons='$dt[allowcons]',
                negocons='$dt[negocons]',
                estcons='$dt[estcons]',
                varcons='$dt[varcons]',
                totcons='$dt[totcons]',
                qrs='$dt[qrs]',
                pocons='$dt[pocons]',
                f1='$dt[f1]',
                f2='$dt[f2]',
                matusage = '$dt[matusage]'");

                echo "<div class='text-infohijau' style='width:375px;'> $row Materials processed for PO. <a href='?hal=proses' style='color:#ffffff;'>View</a> &nbsp; &#10004; </div>";
            }
        }
    } else {
        echo "<div class='text-infomerah' style='width:375px;background:#000000;'>No new materials, all items are processed for PO</div>";
    }
}

if ($_GET['x'] == "prosespo1") {
    $row = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb WHERE ordpk='$_POST[ordpk]' and status='2'"));
    if ($row > 0) {
        $cr = mysqli_query($koneksi, "select * from rkb WHERE ordpk='$_POST[ordpk]' and status='2'");
        while ($dt = mysqli_fetch_array($cr)) {
            $update = mysqli_query($koneksi, "update rkb set
submit='1',
submitdate=NOW(),
stspk='1',
status='4',
rkbsts='1' where rkbpk='$dt[rkbpk]'");

            $item = addslashes($dt['item']);
            $itemadd = addslashes($dt['itemadd']);
            $spec = addslashes($dt['spec']);
            $specadd = addslashes($dt['specadd']);
            $sup = addslashes($dt['sup']);
            $spec1 = addslashes($dt['spec1']);
            $spec2 = addslashes($dt['spec2']);
            $spec3 = addslashes($dt['spec3']);
            $spec4 = addslashes($dt['spec4']);
            $spec5 = addslashes($dt['spec5']);
            $spec6 = addslashes($dt['spec6']);
            $spec7 = addslashes($dt['spec7']);
            $spec8 = addslashes($dt['spec8']);
            $sizegar = addslashes($dt['sizegar']);
            $colname = addslashes($dt['colname']);

            if ($dt['kelnm'] == "CUTTING") {
                $cr2 = mysqli_query($koneksi, "select * from rpo where rkbpk='$dt[rkbpk]'");
                $dt2 = mysqli_fetch_array($cr2);

                if ($dt2['rpopk'] > 0) {
                    $result = mysqli_query($koneksi, "update rpo set popros='1', stspk='1' where rkbpk='$dt[rkbpk]'");
                } else {
                    $insert = mysqli_query($koneksi, "insert into rpo set
popros='1',
stspk='1',
ordpk='$dt[ordpk]',
rkbpk='$dt[rkbpk]',
nour='$dt[nour]',
tgljam=NOW(),
tgl=NOW(),
submit='$dt[submit]',
submitdate='$dt[submitdate]',
kelnm='$dt[kelnm]',
item='$item',
itemadd='$itemadd',
suppk='$dt[suppk]',
sup='$sup',
tspec='$dt[tspec]',
nspec='$dt[nspec]',
specadd='$specadd',
hspec1='$dt[hspec1]',
hspec2='$dt[hspec2]',
hspec3='$dt[hspec3]',
hspec4='$dt[hspec4]',
hspec5='$dt[hspec5]',
hspec6='$dt[hspec6]',
hspec7='$dt[hspec7]',
hspec8='$dt[hspec8]',
spec1='$spec1',
spec2='$spec2',
spec3='$spec3',
spec4='$spec4',
spec5='$spec5',
spec6='$spec6',
spec7='$spec7',
spec8='$spec8',
colname='$colname',
colcode='$dt[colcode]',
sizegar='$sizegar',
unit='$dt[unit]',
price='$dt[price]',
curpk='$dt[curpk]',
bdownqty='$dt[bdownqty]',
bdownpk='$dt[bdownpk]',
kolom='$dt[kolom]',
allowcons='$dt[allowcons]',
negocons='$dt[negocons]',
estcons='$dt[estcons]',
varcons='$dt[varcons]',
totcons='$dt[totcons]',
qrs='$dt[qrs]',
pocons='$dt[pocons]',
f1='$dt[f1]',
f2='$dt[f2]',
matusage = '$dt[matusage]'");
                }
            } else {
                $cr2 = mysqli_query($koneksi, "select * from rpo where rkbpk='$dt[rkbpk]'");
                $dt2 = mysqli_fetch_array($cr2);

                if ($dt2['rpopk'] > 0) {
                    $result = mysqli_query($koneksi, "update rpo set popros='1', stspk='1' where rkbpk='$dt[rkbpk]'");
                } else {
                    $insert = mysqli_query($koneksi, "insert into rpo set
popros='0',
stspk='1',
ordpk='$dt[ordpk]',
rkbpk='$dt[rkbpk]',
nour='$dt[nour]',
tgljam=NOW(),
tgl=NOW(),
submit='$dt[submit]',
submitdate='$dt[submitdate]',
kelnm='$dt[kelnm]',
item='$item',
itemadd='$itemadd',
suppk='$dt[suppk]',
sup='$sup',
tspec='$dt[tspec]',
nspec='$dt[nspec]',
specadd='$specadd',
hspec1='$dt[hspec1]',
hspec2='$dt[hspec2]',
hspec3='$dt[hspec3]',
hspec4='$dt[hspec4]',
hspec5='$dt[hspec5]',
hspec6='$dt[hspec6]',
hspec7='$dt[hspec7]',
hspec8='$dt[hspec8]',
spec1='$spec1',
spec2='$spec2',
spec3='$spec3',
spec4='$spec4',
spec5='$spec5',
spec6='$spec6',
spec7='$spec7',
spec8='$spec8',
colname='$colname',
colcode='$dt[colcode]',
sizegar='$sizegar',
unit='$dt[unit]',
price='$dt[price]',
curpk='$dt[curpk]',
bdownqty='$dt[bdownqty]',
bdownpk='$dt[bdownpk]',
kolom='$dt[kolom]',
allowcons='$dt[allowcons]',
negocons='$dt[negocons]',
estcons='$dt[estcons]',
varcons='$dt[varcons]',
totcons='$dt[totcons]',
qrs='$dt[qrs]',
pocons='$dt[pocons]',
f1='$dt[f1]',
f2='$dt[f2]',
matusage = '$dt[matusage]'");
                }
            }

            echo "<div class='text-infohijau' style='width:380px;'> $row Materials processed for PO. <a href='?hal=proses' style='color:#ffffff;'>View</a> &nbsp; &#10004; </div>";
        }
    } else {
        echo "<div class='text-infomerah' style='width:380px;background:#000000;'>No new materials, all items are processed for PO</div>";
    }
}

if ($_GET['x'] == "prosespo2") {
    $cr1 = mysqli_query($koneksi, "select * from user
        left outer join fu on fu.fupk=user.fupk
        where user.userpk='$_GET[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['spv'] == 1) {
        $and = "and ord.fupk='$dt1[fupk]'";
        $fu = $dt1['funm'];
    } else {
        $and = "and ord.userpk='$dt1[userpk]'";
        $fu = $dt1['funm'];
    }

    $row = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rpo
        left outer join ord on ord.ordpk=rpo.ordpk
        WHERE rpo.popros='1' and rpo.stspk='1' and rpo.popk='0' and YEAR(rpo.tgl)='$_GET[thn]' $and"));
    if ($row > 0) {
        $cr = mysqli_query($koneksi, "SELECT * FROM rpo
            left outer join ord on ord.ordpk=rpo.ordpk
            left outer join sup on sup.suppk=rpo.suppk
            WHERE rpo.popros='1' and rpo.stspk='1' and rpo.popk='0' and YEAR(rpo.tgl)='$_GET[thn]' $and group by rpo.suppk");
        while ($dt = mysqli_fetch_array($cr)) {
            // if ($dt['local'] == 2) {
            //     $polipk = '2';
            // } else {
            //     $polipk = '1';
            // }

            $supnm = addslashes(trim($dt['sup']));
            if (stripos($supnm, 'stock') !== false) {
                $prefix = 'SN';
                $polipk = 3;
            } else {
                if($dt['local'] == 1){
                $prefix = 'LN';
                $polipk = 1;
                } else {
                $prefix = 'IN';
                $polipk = 2;
                }
            }

            // $dt2a = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po order by popk desc limit 1"));
            // $dt2b = mysqli_fetch_array(mysqli_query($koneksi, "SELECT pono FROM po WHERE polipk='$polipk' order by popk desc limit 1"));
            // $popk = $dt2a['popk'] + 1;
            // $lokal = substr($dt2b['pono'], 3, 5) + 1;
            // $lokal2 = substr($dt2b['pono'], 3, 5) + 2;
            // if ($dt['local'] == 2) {
            //     $pono = "IN0" . $lokal;
            // } else {
            //     $pono = "LN0" . $lokal;
            // }

             /* ================= AMBIL NOMOR TERAKHIR ================= */
            $dt2 = mysqli_fetch_array(mysqli_query(
                $koneksi,
                "SELECT pono 
                FROM po 
                WHERE polipk='$polipk'
                AND pono LIKE '$prefix%'
                ORDER BY pono DESC 
                LIMIT 1"
            ));

            /* ================= GENERATE NOMOR ================= */
            if ($dt2 && !empty($dt2['pono'])) {
                $lastNo = trim($dt2['pono']);
                // ambil angka setelah prefix
                $angka = (int) substr($lastNo, 2);
                $next = $angka + 1;
            } else {
                $next = 1;
            }

            /* ================= HASIL FINAL ================= */
            $pono = $prefix . str_pad($next, 6, '0', STR_PAD_LEFT);


            $item = addslashes($dt['item']);

            if ($dt['suppk'] == 1949) {
                $cra = mysqli_query($koneksi, "SELECT * FROM rpo
                        left outer join ord on ord.ordpk=rpo.ordpk
                        left outer join sup on sup.suppk=rpo.suppk
                        WHERE rpo.suppk='1949' and rpo.popros='1' and rpo.stspk='1' and rpo.popk='0' and YEAR(rpo.tgl)='$_GET[thn]' $and");
                while ($dta = mysqli_fetch_array($cra)) {
                    $update = mysqli_query($koneksi, "update rpo set popros='0' where rkbpk='$dta[rkbpk]'");
                }
            } else {
                $insert = mysqli_query($koneksi, "insert into po set
                popk='$popk',
                pono='$pono',
                polipk='$polipk',
                pourgpk='1',
                postatpk='1',
                tglpo=NOW(),
                suppk='$dt[suppk]',
                brg='$item',
                curpk='$dt[curpk]',
                ck='0',
                fu='$fu'");

                // if ($dt['local'] == 2) {
                //     $update = mysqli_query($koneksi, "update notran set nikelokal='$lokal2' where tabel='PO'");
                // } else {
                //     $update = mysqli_query($koneksi, "update notran set nikeimpor='$lokal2' where tabel='PO'");
                // }

                $crb = mysqli_query($koneksi, "SELECT * FROM rpo
                        left outer join ord on ord.ordpk=rpo.ordpk
                        left outer join sup on sup.suppk=rpo.suppk
                        WHERE rpo.suppk='$dt[suppk]' and rpo.popros='1' and rpo.stspk='1' and rpo.popk='0' and YEAR(rpo.tgl)='$_GET[thn]' $and");
                while ($dtb = mysqli_fetch_array($crb)) {
                    // if ($dtb['local'] == 2) {
                    //     $polipkb = '2';
                    // } else {
                    //     $polipkb = '1';
                    // }

                    $supnmb = addslashes(trim($dtb['sup']));
                    if (stripos($supnmb, 'stock') !== false) {
                        $prefixb = 'SN';
                        $polipkb = 3;
                    } else {
                        if($dtb['local'] == 1){
                        $prefixb = 'LN';
                        $polipkb = 1;
                        } else {
                        $prefixb = 'IN';
                        $polipkb = 2;
                        }
                    }

                    $dt3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po
                        where suppk='$dtb[suppk]' and polipk='$polipkb' AND pono LIKE '$prefixb%' and pur is null and ck='0' 
                        and fu='$fu' order by popk desc limit 1"));
                    $popkb = $dt3['popk'];

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

                    $update3a = mysqli_query($koneksi, "update rkb set stspk='2' where rkbpk='$dtb[rkbpk]'");

                    $update3b = mysqli_query($koneksi, "update rpo set
                    stspk='2',
                    popros='2' where rkbpk='$dtb[rkbpk]'");

                    $item = addslashes($dtb['item']);
                    $itemadd = addslashes($dtb['itemadd']);
                    $spec = addslashes($dtb['spec']);
                    $specadd = addslashes($dtb['specadd']);
                    $sup = addslashes($dtb['sup']);
                    $spec1 = addslashes($dtb['spec1']);
                    $spec2 = addslashes($dtb['spec2']);
                    $spec3 = addslashes($dtb['spec3']);
                    $spec4 = addslashes($dtb['spec4']);
                    $spec5 = addslashes($dtb['spec5']);
                    $spec6 = addslashes($dtb['spec6']);
                    $spec7 = addslashes($dtb['spec7']);
                    $spec8 = addslashes($dtb['spec8']);
                    $sizegar = addslashes($dtb['sizegar']);
                    $colname = addslashes($dtb['colname']);

                    $crb2 = mysqli_query($koneksi, "select * from podt where rkbpk='$dtb[rkbpk]'");
                    $dtb2 = mysqli_fetch_array($crb2);

                    if ($dtb2['podtpk'] > 0) {
                        $result = mysqli_query($koneksi, "update podt set popk='$popkb' where rkbpk='$dtb[rkbpk]'");
                    } else {
                        $result = mysqli_query($koneksi, "insert into podt set
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
                                f2='$dtb[f2]',
                                matusage = '$dtb[matusage]'");
                        //echo "<div class='text-infohijau' style='width:375px;'> $row Materials processed for PO. <a href='?hal=proses' style='color:#ffffff;'>View</a> &nbsp; &#10004; </div>";
                    }
                }
            }
            ?>
            <script language="javascript">
                document.location = "../admin?hal=assign2&thn=<?php echo $_GET['thn'] ?>";
            </script>
        <?php
        }
    } else {
        ?>
        <script language="javascript">
            document.location = "../admin?hal=assign2&thn=<?php echo $_GET['thn'] ?>";
        </script>
    <?php
        //echo "<div class='text-infomerah' style='width:375px;background:#000000;'>No new materials, all items are processed for PO</div>";  
    }
}
if ($_GET['x'] == "canproses") {
    $cr1 = mysqli_query($koneksi, "select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$_GET[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['spv'] == 1) {
        $and = "and ord.fupk='$dt1[fupk]' and po.fu='$dt1[funm]'";
    } else {
        $and = "and ord.userpk='$dt1[userpk]' and po.fu='$dt1[funm]'";
    }

    $cr = mysqli_query($koneksi, "SELECT * FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
WHERE po.pur is null  and po.ck='0' and podt.stspk='1' and YEAR(po.tglpo)='$_GET[thn]' $and");
    while ($dt = mysqli_fetch_array($cr)) {
        $updt = mysqli_query($koneksi, "update rpo set stspk='1', popros='1', popk='0' where rkbpk='$dt[rkbpk]'");
        $updt2 = mysqli_query($koneksi, "update rkb set stspk='1', popk=NULL where rkbpk='$dt[rkbpk]'");
        $del1 = mysqli_query($koneksi, "delete from podt where popk='$dt[popk]'");
        $del2 = mysqli_query($koneksi, "delete from po where popk='$dt[popk]'");
    }
    ?>
    <script language="javascript">
        document.location = "../admin?hal=proses";
    </script>
    <?php
}

if ($_GET['x'] == "prosespo3") {
    $cr1 = mysqli_query($koneksi, "select * from user where userpk='$_GET[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['material'] == 1) {
        $and = "and ord.fupk='$_GET[cari2]' and and rpo.kelnm='CUTTING'";
        $pur = ucfirst($dt1['login']);
    } else if ($dt1['material'] == 2) {
        $and = "and ord.fupk='$_GET[cari2]' and rpo.kelnm='$_GET[cari7]'";
        $pur = ucfirst($dt1['login']);
    } else {
        $and = "and ord.fupk='$_GET[cari2]' and rpo.kelnm=='TEST'";
        $pur = ucfirst($dt1['login']);
    }

    $row = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
WHERE rpo.popros='0' and rpo.stspk='1' and rpo.popk='0' and YEAR(rpo.tgl)='$_GET[thn]' $and"));
    if ($row > 0) {
        $cr = mysqli_query($koneksi, "SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
left outer join sup on sup.suppk=rpo.suppk
WHERE rpo.popros='0' and rpo.stspk='1' and rpo.popk='0' and ord.fupk<>'' and rpo.rkbpk<>'' and rpo.item<>'' and YEAR(rpo.tgl)='$_GET[thn]' $and group by rpo.suppk, ord.byrpk");
        while ($dt = mysqli_fetch_array($cr)) {
            if ($dt['suppk'] == 1949) {
            } else {

                if ($dt['local'] == 2) {
                    $polipk = '2';
                } else {
                    $polipk = '1';
                }

                $dt2a = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po order by popk desc limit 1"));
                $dt2b = mysqli_fetch_array(mysqli_query($koneksi, "SELECT pono FROM po WHERE polipk='$polipk' order by popk desc limit 1"));
                $popk = $dt2a['popk'] + 1;
                $lokal = substr($dt2b['pono'], 3, 5) + 1;
                $lokal2 = substr($dt2b['pono'], 3, 5) + 2;
                if ($dt['local'] == 2) {
                    $pono = "IN0" . $lokal;
                } else {
                    $pono = "LN0" . $lokal;
                }

                $item = addslashes($dt['item']);

                $insert = mysqli_query($koneksi, "insert into po set
popk='$popk',
pono='$pono',
polipk='$polipk',
pourgpk='1',
postatpk='1',
tglpo=NOW(),
suppk='$dt[suppk]',
brg='$item',
byrpk='$dt[byrpk]',
curpk='$dt[curpk]',
ck='2',
pur='$pur'");

                if ($dt['local'] == 2) {
                    $update = mysqli_query($koneksi, "update notran set nikelokal='$lokal2' where tabel='PO'");
                } else {
                    $update = mysqli_query($koneksi, "update notran set nikeimpor='$lokal2' where tabel='PO'");
                }

                $crb = mysqli_query($koneksi, "SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
left outer join sup on sup.suppk=rpo.suppk
WHERE rpo.suppk='$dt[suppk]' and ord.byrpk='$dt[byrpk]' and rpo.popros='0' and rpo.stspk='1' and rpo.popk='0' and ord.fupk<>'' and rpo.rkbpk<>'' and rpo.item<>'' and YEAR(rpo.tgl)='$_GET[thn]' $and");
                while ($dtb = mysqli_fetch_array($crb)) {
                    if ($dtb['local'] == 2) {
                        $polipkb = '2';
                    } else {
                        $polipkb = '1';
                    }

                    $dt3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po
where suppk='$dtb[suppk]' and byrpk='$dtb[byrpk]' and polipk='$polipkb' and pur='$pur' and ck='2' order by popk desc limit 1"));
                    $popkb = $dt3['popk'];

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

                    $update3a = mysqli_query($koneksi, "update rkb set
stspk='2' where rkbpk='$dtb[rkbpk]'");

                    $update3b = mysqli_query($koneksi, "update rpo set
stspk='2',
popros='2' where rkbpk='$dtb[rkbpk]'");

                    $item = addslashes($dtb['item']);
                    $itemadd = addslashes($dtb['itemadd']);
                    $spec = addslashes($dtb['spec']);
                    $specadd = addslashes($dtb['specadd']);
                    $sup = addslashes($dtb['sup']);
                    $spec1 = addslashes($dtb['spec1']);
                    $spec2 = addslashes($dtb['spec2']);
                    $spec3 = addslashes($dtb['spec3']);
                    $spec4 = addslashes($dtb['spec4']);
                    $spec5 = addslashes($dtb['spec5']);
                    $spec6 = addslashes($dtb['spec6']);
                    $spec7 = addslashes($dtb['spec7']);
                    $spec8 = addslashes($dtb['spec8']);
                    $sizegar = addslashes($dtb['sizegar']);
                    $colname = addslashes($dtb['colname']);

                    $crb2 = mysqli_query($koneksi, "select * from podt where rkbpk='$dtb[rkbpk]'");
                    $dtb2 = mysqli_fetch_array($crb2);

                    if ($dtb2['podtpk'] > 0) {
                        $result = mysqli_query($koneksi, "update podt set popk='$popkb' where rkbpk='$dtb[rkbpk]'");
                    } else {
                        $result = mysqli_query($koneksi, "insert into podt set
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
f2='$dtb[f2]',
matusage = '$dtb[matusage]'");
    ?>
            <?php
                        //echo "<div class='text-infohijau' style='width:375px;'> $row Materials processed for PO. <a href='?hal=proses' style='color:#ffffff;'>View</a> &nbsp; &#10004; </div>";
                    }
                }
            }
            ?>
            <script language="javascript">
                document.location = "../admin?hal=assign3&cari2=<?php echo $_GET['cari2']; ?>&cari7=<?php echo $_GET['cari7']; ?>&thn=<?php echo $_GET['thn'] ?>";
            </script>
        <?php
        }
    } else {
        ?>
        <script language="javascript">
            document.location = "../admin?hal=new&cari2=<?php echo $_GET['cari2']; ?>&cari7=<?php echo $_GET['cari7']; ?>";
        </script>
    <?php
        //echo "<div class='text-infomerah' style='width:375px;background:#000000;'>No new materials, all items are processed for PO</div>";  
    }
}
if ($_GET['x'] == "canproses3") {
    $cr1 = mysqli_query($koneksi, "select * from user where userpk='$_GET[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['material'] == 1) {
        $and = "and ord.fupk='$_GET[cari2]' and podt.kelnm='CUTTING' and po.pur='$dt1[login]'";
    } else if ($dt1['material'] == 2) {
        $and = "and ord.fupk='$_GET[cari2]' and podt.kelnm='$_GET[cari7]' and po.pur='$dt1[login]'";
    } else {
        $and = "and ord.fupk='$_GET[cari2]' and podt.kelnm=='TEST' and po.pur='$dt1[login]'";
    }

    $cr = mysqli_query($koneksi, "SELECT * FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
WHERE po.ck='2' and podt.stspk='1' and YEAR(po.tglpo)='$_GET[thn]' $and");
    while ($dt = mysqli_fetch_array($cr)) {
        $updt = mysqli_query($koneksi, "update rpo set stspk='1', popros='0', popk='0' where rkbpk='$dt[rkbpk]'");
        $updt2 = mysqli_query($koneksi, "update rkb set stspk='1', popk=NULL where rkbpk='$dt[rkbpk]'");
        $del1 = mysqli_query($koneksi, "delete from podt where popk='$dt[popk]'");
        $del2 = mysqli_query($koneksi, "delete from po where popk='$dt[popk]'");
    }
    ?>
    <script language="javascript">
        document.location = "../admin?hal=new&cari2=<?php echo $_GET['cari2']; ?>&cari7=<?php echo $_GET['cari7']; ?>";
    </script>
<?php
}

if ($_GET['x'] == "canproses2") {
    /*$id = $_POST['id'];
    $N = count($id);
    for($i=0; $i < $N; $i++){
    $cr=mysqli_query($koneksi,"select * from podt where podtpk='$id'");
    $dt=mysqli_fetch_array($cr);

    $updt=mysqli_query($koneksi,"update rpo set stspk='1', popros='1', popk='0' where rkbpk='$dt[rkbpk]'");
    $updt2=mysqli_query($koneksi,"update rkb set stspk='1', popk=NULL where rkbpk='$dt[rkbpk]'");
    $del1=mysqli_query($koneksi,"delete from podt where podtpk='$dt[podtpk]'");

    if($updt){
    echo json_encode(array('success'=>true, 'msg'=>""));
    } else {
    echo json_encode(array('msg'=>""));
    }
    }*/
}
if ($_GET['x'] == "savepo") {
    $cr = mysqli_query($koneksi, "select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$_GET[user]'");
    $dt = mysqli_fetch_array($cr);

    if ($dt['spv'] == 1) {
        $and = "and ord.fupk='$dt[fupk]' and po.fu='$dt[funm]'";
    } else {
        $and = "and ord.userpk='$dt[userpk]' and po.fu='$dt[funm]'";
    }

    $cr2 = mysqli_query($koneksi, "select * from podt
        left outer join po on po.popk=podt.popk
        left outer join ord on ord.ordpk=podt.ordpk
        WHERE po.pur is null  and po.ck='0' and podt.stspk='1' and YEAR(po.tglpo)='$_GET[thn]' $and");
    while ($dt2 = mysqli_fetch_array($cr2)) {
        $updt = mysqli_query($koneksi, "update rpo set newdate=NOW(), popk='$dt2[popk]', popros='1', stspk='2' where rkbpk='$dt2[rkbpk]'");
        $updt2 = mysqli_query($koneksi, "update rkb set newdate=NOW(), popk='$dt2[popk]', stspk='2' where rkbpk='$dt2[rkbpk]'");
        $updt3 = mysqli_query($koneksi, "update podt set stspk='2' where rkbpk='$dt2[rkbpk]'");
        $updt4 = mysqli_query($koneksi, "update po set ck='1' where popk='$dt2[popk]'");
    }
?>
    <script language="javascript">
        document.location = "../admin?hal=proses&x=1";
    </script>
<?php }

if ($_GET['x'] == "savepo3") {
    $cr = mysqli_query($koneksi, "select * from user where userpk='$_GET[user]'");
    $dt = mysqli_fetch_array($cr);

    if ($dt['material'] == 1) {
        $and = "and ord.fupk='$_GET[cari2]' and podt.kelnm='CUTTING' and po.pur='$dt[login]'";
    } else if ($dt['material'] == 2) {
        $and = "and ord.fupk='$_GET[cari2]' and podt.kelnm='$_GET[cari7]' and po.pur='$dt[login]'";
    } else {
        $and = "and ord.fupk='$_GET[cari2]' and podt.kelnm=='TEST' and po.pur='$dt[login]'";
    }

    $cr2 = mysqli_query($koneksi, "select * from podt
left outer join po on po.popk=podt.popk
left outer join ord on ord.ordpk=podt.ordpk
WHERE po.ck='2' and podt.stspk='1' and YEAR(po.tglpo)='$_GET[thn]' $and");
    while ($dt2 = mysqli_fetch_array($cr2)) {
        $updt = mysqli_query($koneksi, "update rpo set newdate=NOW(), popk='$dt2[popk]', popros='1', stspk='2' where rkbpk='$dt2[rkbpk]'");
        $updt2 = mysqli_query($koneksi, "update rkb set newdate=NOW(), popk='$dt2[popk]', stspk='2' where rkbpk='$dt2[rkbpk]'");
        $updt3 = mysqli_query($koneksi, "update podt set stspk='2' where rkbpk='$dt2[rkbpk]'");
        $updt4 = mysqli_query($koneksi, "update po set ck='1' where popk='$dt2[popk]'");
    }
?>
    <script language="javascript">
        document.location = "../admin?hal=wait&cari2a=<?php echo $_GET['cari2']; ?>";
    </script>
<?php }

if ($_GET['x'] == "canpo1") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $sql = mysqli_query($koneksi, "update po set ck='99' where popk='$id'");
        if ($sql) {
            echo json_encode(array('success' => true, 'msg' => ""));
        } else {
            echo json_encode(array('msg' => ""));
        }
    }
}
if ($_GET['x'] == "savecanpo") {
    $cr = mysqli_query($koneksi, "select * from po where popk='$_POST[popk]'");
    while ($dt = mysqli_fetch_array($cr)) {
        $updt = mysqli_query($koneksi, "update rpo set tgljam=NOW(), candate=NOW(), stspk='1', popros='1', popk='0' where popk='$dt[popk]'");
        $updt2 = mysqli_query($koneksi, "update rkb set candate=NOW(), stspk='1', popk=NULL where popk='$dt[popk]'");
        $del1 = mysqli_query($koneksi, "delete from podt where popk='$dt[popk]'");
        $del2 = mysqli_query($koneksi, "delete from po where popk='$dt[popk]'");
    }
}
if ($_GET['x'] == "canpo") {
    $cr1 = mysqli_query($koneksi, "select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$_GET[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['spv'] == 1) {
        $and = "and ord.fupk='$dt1[fupk]' and po.fu='$dt1[funm]'";
    } else {
        $and = "and ord.userpk='$dt1[userpk]' and po.fu='$dt1[funm]'";
    }

    $cr = mysqli_query($koneksi, "select * from po
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
where po.pur is null and po.ck='99' and po.postatpk<'4' $and");
    while ($dt = mysqli_fetch_array($cr)) {
        $updt = mysqli_query($koneksi, "update rpo set tgljam=NOW(), candate=NOW(), stspk='1', popros='1', popk='0' where popk='$dt[popk]'");
        $updt2 = mysqli_query($koneksi, "update rkb set candate=NOW(), stspk='1', popk=NULL where popk='$dt[popk]'");
        $del1 = mysqli_query($koneksi, "delete from podt where popk='$dt[popk]'");
        $del2 = mysqli_query($koneksi, "delete from po where popk='$dt[popk]'");
    }
}
if ($_GET['x'] == "canpo2") {
    $cr1 = mysqli_query($koneksi, "select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$_GET[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['spv'] == 1) {
        $and = "and ord.fupk='$dt1[fupk]' and po.fu='$dt1[funm]'";
    } else {
        $and = "and ord.userpk='$dt1[userpk]' and po.fu='$dt1[funm]'";
    }

    $cr = mysqli_query($koneksi, "select * from po
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
where po.pur is null and po.ck='99' and po.postatpk<'4' $and
group by po.popk");
    while ($dt = mysqli_fetch_array($cr)) {
        $updt = mysqli_query($koneksi, "update po set ck='1' where popk='$dt[popk]'");
    }
}
if ($_GET['x'] == "purchasing1") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $sql = mysqli_query($koneksi, "update po set ck='77' where popk='$id'");
        if ($sql) {
            echo json_encode(array('success' => true, 'msg' => ""));
        } else {
            echo json_encode(array('msg' => ""));
        }
    }
}
if ($_GET['x'] == "purchasing") {
    $cr1 = mysqli_query($koneksi, "select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$_GET[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['spv'] == 1) {
        $and = "and ord.fupk='$dt1[fupk]' and po.fu='$dt1[funm]'";
    } else {
        $and = "and ord.userpk='$dt1[userpk]' and po.fu='$dt1[funm]'";
    }

    $cr = mysqli_query($koneksi, "select * from po
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
where po.pur is null and po.ck='77' and po.postatpk<'4' $and
group by po.popk");
    while ($dt = mysqli_fetch_array($cr)) {
        if ($dt['kelnm'] == "CUTTING") {
            $pur = "Theresia";
        } else {
            $pur = "Rita";
        }

        $updt = mysqli_query($koneksi, "update po set pur='$pur', tglpo=NOW(), dateupdt=NOW(), ck='1' where popk='$dt[popk]'");
    }
}
if ($_GET['x'] == "purchasing2") {
    $cr1 = mysqli_query($koneksi, "select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$_GET[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['spv'] == 1) {
        $and = "and ord.fupk='$dt1[fupk]' and po.fu='$dt1[funm]'";
    } else {
        $and = "and ord.userpk='$dt1[userpk]' and po.fu='$dt1[funm]'";
    }

    $cr = mysqli_query($koneksi, "select * from po
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
where po.pur is null and po.ck='77' and po.postatpk<'4' $and
group by po.popk");
    while ($dt = mysqli_fetch_array($cr)) {
        $updt = mysqli_query($koneksi, "update po set ck='1' where popk='$dt[popk]'");
    }
}
if ($_GET['x'] == "formwh") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $updt = mysqli_query($koneksi, "update podt set sup='STOCKKU' where podtpk='$id'");
        if ($updt) {
            echo json_encode(array('success' => true, 'msg' => ""));
        } else {
            echo json_encode(array('msg' => ""));
        }
    }
}
if ($_GET['x'] == "formwh2") {
    $cr1 = mysqli_query($koneksi, "select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$_POST[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['spv'] == 1) {
        $and = "and ord.fupk='$dt1[fupk]' and po.fu='$dt1[funm]'";
        $fu = $dt1['funm'];
    } else {
        $and = "and ord.userpk='$dt1[userpk]' and po.fu='$dt1[funm]'";
        $fu = $dt1['funm'];
    }

    $cr1a = mysqli_query($koneksi, "select * from sup where suppk='$_POST[suppk]'");
    $dt1a = mysqli_fetch_array($cr1a);

    $cr1b = mysqli_query($koneksi, "SELECT * FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
WHERE po.pur is null  and po.ck='0' and podt.stspk='1' and YEAR(po.tglpo)='$_POST[thn]' $and and podt.sup='STOCKKU'");
    $dt1b = mysqli_fetch_array($cr1b);

    $polipk = '1';

    $dt2a = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po order by popk desc limit 1"));
    $dt2b = mysqli_fetch_array(mysqli_query($koneksi, "SELECT pono FROM po WHERE polipk='$polipk' order by popk desc limit 1"));
    $popk = $dt2a['popk'] + 1;
    $lokal = substr($dt2b['pono'], 3, 5) + 1;
    $lokal2 = substr($dt2b['pono'], 3, 5) + 2;
    $pono = "LN0" . $lokal;

    $item = addslashes($dt1b['item']);

    $insert = mysqli_query($koneksi, "insert into po set
popk='$popk',
pono='$pono',
polipk='$polipk',
pourgpk='1',
postatpk='1',
tglpo=NOW(),
dateupdt=NOW(),
suppk='$_POST[suppk]',
brg='$item',
curpk='$dt1b[curpk]',
ck='0',
fu='$fu'");

    $update = mysqli_query($koneksi, "update notran set nikelokal='$lokal2' where tabel='PO'");

    $cr = mysqli_query($koneksi, "SELECT podt.podtpk, podt.rkbpk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
WHERE po.pur is null  and po.ck='0' and podt.stspk='1' and YEAR(po.tglpo)='$_POST[thn]' $and and podt.sup='STOCKKU'");
    while ($dt = mysqli_fetch_array($cr)) {
        $updt = mysqli_query($koneksi, "update podt set popk='$popk', suppk='$_POST[suppk]', sup='$dt1a[supnm]' where sup='STOCKKU' and podtpk='$dt[podtpk]'");
        $updt2 = mysqli_query($koneksi, "update rpo set suppk='$_POST[suppk]', sup='$dt1a[supnm]' where rkbpk='$dt[rkbpk]'");
        $updt3 = mysqli_query($koneksi, "update rkb set suppk='$_POST[suppk]', sup='$dt1a[supnm]' where rkbpk='$dt[rkbpk]'");
    }
}

if ($_GET['x'] == "formwh3") {
    $cr1 = mysqli_query($koneksi, "select * from user where userpk='$_POST[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['material'] == 1) {
        $and = "and ord.fupk='$_POST[cari2]' and and podt.kelnm='CUTTING'";
        $pur = ucfirst($dt1['login']);
    } else if ($dt1['material'] == 2) {
        $and = "and ord.fupk='$_POST[cari2]' and podt.kelnm='$_POST[cari7]'";
        $pur = ucfirst($dt1['login']);
    } else {
        $and = "and ord.fupk='$_POST[cari2]' and podt.kelnm=='TEST'";
        $pur = ucfirst($dt1['login']);
    }

    $cr1a = mysqli_query($koneksi, "select * from sup where suppk='$_POST[suppk]'");
    $dt1a = mysqli_fetch_array($cr1a);

    $cr1b = mysqli_query($koneksi, "SELECT * FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
WHERE po.ck='2' and podt.stspk='1' and YEAR(po.tglpo)='$_POST[thn]' $and and podt.sup='STOCKKU' and po.pur='$pur'");
    $dt1b = mysqli_fetch_array($cr1b);

    $polipk = '1';

    $dt2a = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po order by popk desc limit 1"));
    $dt2b = mysqli_fetch_array(mysqli_query($koneksi, "SELECT pono FROM po WHERE polipk='$polipk' order by popk desc limit 1"));
    $popk = $dt2a['popk'] + 1;
    $lokal = substr($dt2b['pono'], 3, 5) + 1;
    $lokal2 = substr($dt2b['pono'], 3, 5) + 2;
    $pono = "LN0" . $lokal;

    $item = addslashes($dt1b['item']);

    $insert = mysqli_query($koneksi, "insert into po set
popk='$popk',
pono='$pono',
polipk='$polipk',
pourgpk='1',
postatpk='1',
tglpo=NOW(),
dateupdt=NOW(),
suppk='$_POST[suppk]',
brg='$item',
curpk='$dt1b[curpk]',
ck='2',
pur='$pur'");

    $update = mysqli_query($koneksi, "update notran set nikelokal='$lokal2' where tabel='PO'");

    $cr = mysqli_query($koneksi, "SELECT podt.podtpk, podt.rkbpk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
WHERE po.ck='2' and podt.stspk='1' and YEAR(po.tglpo)='$_POST[thn]' $and and podt.sup='STOCKKU' and po.pur='$pur'");
    while ($dt = mysqli_fetch_array($cr)) {
        $updt = mysqli_query($koneksi, "update podt set popk='$popk', suppk='$_POST[suppk]', sup='$dt1a[supnm]' where sup='STOCKKU' and podtpk='$dt[podtpk]'");
        $updt2 = mysqli_query($koneksi, "update rpo set suppk='$_POST[suppk]', sup='$dt1a[supnm]' where rkbpk='$dt[rkbpk]'");
        $updt3 = mysqli_query($koneksi, "update rkb set suppk='$_POST[suppk]', sup='$dt1a[supnm]' where rkbpk='$dt[rkbpk]'");
    }
}

if ($_GET['x'] == "canwh") {
    $cr1 = mysqli_query($koneksi, "select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$_POST[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['spv'] == 1) {
        $and = "and ord.fupk='$dt1[fupk]' and po.fu='$dt1[funm]'";
    } else {
        $and = "and ord.userpk='$dt1[userpk]' and po.fu='$dt1[funm]'";
    }

    $cr = mysqli_query($koneksi, "SELECT podt.podtpk, podt.suppk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
WHERE po.pur is null  and po.ck='0' and podt.stspk='1' and YEAR(po.tglpo)='$_POST[thn]' $and and podt.sup='STOCKKU'");
    while ($dt = mysqli_fetch_array($cr)) {
        $cr1a = mysqli_query($koneksi, "select * from sup where suppk='$dt[suppk]'");
        $dt1a = mysqli_fetch_array($cr1a);

        $updt = mysqli_query($koneksi, "update podt set sup='$dt1a[supnm]' where sup='STOCKKU' and podtpk='$dt[podtpk]'");
    }
}

if ($_GET['x'] == "canwh3") {
    $cr1 = mysqli_query($koneksi, "select * from user where userpk='$_POST[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['material'] == 1) {
        $and = "and ord.fupk='$_POST[cari2]' and and podt.kelnm='CUTTING'";
        $pur = ucfirst($dt1['login']);
    } else if ($dt1['material'] == 2) {
        $and = "and ord.fupk='$_POST[cari2]' and podt.kelnm='$_POST[cari7]'";
        $pur = ucfirst($dt1['login']);
    } else {
        $and = "and ord.fupk='$_POST[cari2]' and podt.kelnm=='TEST'";
        $pur = ucfirst($dt1['login']);
    }

    $cr = mysqli_query($koneksi, "SELECT podt.podtpk, podt.suppk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
WHERE po.ck='2' and podt.stspk='1' and YEAR(po.tglpo)='$_POST[thn]' $and and podt.sup='STOCKKU' and po.pur='$pur'");
    while ($dt = mysqli_fetch_array($cr)) {
        $cr1a = mysqli_query($koneksi, "select * from sup where suppk='$dt[suppk]'");
        $dt1a = mysqli_fetch_array($cr1a);

        $updt = mysqli_query($koneksi, "update podt set sup='$dt1a[supnm]' where sup='STOCKKU' and podtpk='$dt[podtpk]'");
    }
}

if ($_GET['x'] == "tpo1b") {
    $updt = mysqli_query($koneksi, "update po set tpo1b='0'");
}
if ($_GET['x'] == "tpo2b") {
    $updt = mysqli_query($koneksi, "update po set tpo2b='0', tpo1b='0' where popk='$_GET[popk]'");
?>
    <script language="javascript">
        document.location = "../admin?hal=detpopur&x=1&po=<?php echo $_GET['popk'] ?>";
    </script>
<?php
}
if ($_GET['x'] == "tpodtb") {
    $updt = mysqli_query($koneksi, "update podt set tpodtb='0' where podtpk=$_GET[podtpk]");
}
if ($_GET['x'] == "cekinsert") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $updt = mysqli_query($koneksi, "update podt set stspk='99' where podtpk='$id'");
        if ($updt) {
            echo json_encode(array('success' => true, 'msg' => ""));
        } else {
            echo json_encode(array('msg' => ""));
        }
    }
}
if ($_GET['x'] == "cancekinsert") {
    $updt = mysqli_query($koneksi, "update podt set stspk='2' where stspk='99' and popk='$_POST[popk]'");
}
if ($_GET['x'] == "saveinsert") {
    $cr1 = mysqli_query($koneksi, "select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$_POST[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['spv'] == 1) {
        $and = "and ord.fupk='$dt1[fupk]' and po.fu='$dt1[funm]'";
    } else {
        $and = "and ord.userpk='$dt1[userpk]' and po.fu='$dt1[funm]'";
    }

    $cr = mysqli_query($koneksi, "select * from podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
WHERE po.pur is null $and and podt.popk='$_POST[popk]' and podt.stspk='99'");
    while ($dt = mysqli_fetch_array($cr)) {
        $update1 = mysqli_query($koneksi, "update po set dateupdt=NOW() where rkbpk='$_POST[popk]'");
        $update2 = mysqli_query($koneksi, "update rkb set popk='$_GET[po]' where rkbpk='$dt[rkbpk]'");
        $update3 = mysqli_query($koneksi, "update rpo set popk='$_GET[po]' where rkbpk='$dt[rkbpk]'");
        $result = mysqli_query($koneksi, "update podt set popk='$_GET[po]', stspk='2' where rkbpk='$dt[rkbpk]'");
    }
}
if ($_GET['x'] == "formwh2b") {
    $cr1 = mysqli_query($koneksi, "select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$_POST[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['spv'] == 1) {
        $and = "and ord.fupk='$dt1[fupk]' and po.fu='$dt1[funm]'";
        $fu = $dt1['funm'];
    } else {
        $and = "and ord.userpk='$dt1[userpk]' and po.fu='$dt1[funm]'";
        $fu = $dt1['funm'];
    }

    $cr1a = mysqli_query($koneksi, "select * from sup where suppk='$_POST[suppk]'");
    $dt1a = mysqli_fetch_array($cr1a);

    $cr1b = mysqli_query($koneksi, "SELECT * FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
WHERE po.pur is null $and and podt.stspk='99' and po.popk='$_POST[popk]'");
    $dt1b = mysqli_fetch_array($cr1b);

    $polipk = '1';

    $dt2a = mysqli_fetch_array(mysqli_query($koneksi, "SELECT popk FROM po order by popk desc limit 1"));
    $dt2b = mysqli_fetch_array(mysqli_query($koneksi, "SELECT pono FROM po WHERE polipk='$polipk' order by popk desc limit 1"));
    $popk = $dt2a['popk'] + 1;
    $lokal = substr($dt2b['pono'], 3, 5) + 1;
    $lokal2 = substr($dt2b['pono'], 3, 5) + 2;
    $pono = "LN0" . $lokal;

    $item = addslashes($dt1b['item']);

    $insert = mysqli_query($koneksi, "insert into po set
popk='$popk',
pono='$pono',
polipk='$polipk',
pourgpk='1',
postatpk='1',
tglpo=NOW(),
dateupdt=NOW(),
suppk='$_POST[suppk]',
brg='$item',
curpk='$dt1b[curpk]',
ck='0',
fu='$fu'");

    $update = mysqli_query($koneksi, "update notran set nikelokal='$lokal2' where tabel='PO'");

    $cr = mysqli_query($koneksi, "SELECT podt.podtpk, podt.rkbpk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
WHERE po.pur is null  $and and podt.stspk='99' and po.popk='$_POST[popk]'");
    while ($dt = mysqli_fetch_array($cr)) {
        $updt = mysqli_query($koneksi, "update podt set popk='$popk', stspk='2', suppk='$_POST[suppk]', sup='$dt1a[supnm]' where stspk='99' and podtpk='$dt[podtpk]'");
        $updt2 = mysqli_query($koneksi, "update rpo set popk='$popk', suppk='$_POST[suppk]', sup='$dt1a[supnm]' where rkbpk='$dt[rkbpk]'");
        $updt3 = mysqli_query($koneksi, "update rkb set popk='$popk', suppk='$_POST[suppk]', sup='$dt1a[supnm]' where rkbpk='$dt[rkbpk]'");
    }
}
if ($_GET['x'] == "tdel1") {
    $cr1 = mysqli_query($koneksi, "select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$_POST[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['spv'] == 1) {
        $where = "where ord.fupk='$dt1[fupk]' and YEAR(po.tglpo)='$_GET[thn]' and po.tdel='1' and po.pur<>''";
    } else {
        $where = "where ord.userpk='$dt1[userpk]' and YEAR(po.tglpo)='$_GET[thn]' and po.tdel='1' and po.pur<>''";
    }

    $cr = mysqli_query($koneksi, "select po.popk from po
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
$where");
    while ($dt = mysqli_fetch_array($cr)) {
        $updt = mysqli_query($koneksi, "update po set tdel='0' where popk='$dt[popk]'");
    }
}
if ($_GET['x'] == "tdel2") {
    $cr1 = mysqli_query($koneksi, "select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$_POST[user]'");
    $dt1 = mysqli_fetch_array($cr1);

    if ($dt1['spv'] == 1) {
        $where = "where ord.fupk='$dt1[fupk]' and YEAR(po.tglpo)='$_GET[thn]' and po.tdel='1' and po.pur is null";
    } else {
        $where = "where ord.userpk='$dt1[userpk]' and YEAR(po.tglpo)='$_GET[thn]' and po.tdel='1' and po.pur is null";
    }

    $cr = mysqli_query($koneksi, "select po.popk from po
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
$where");
    while ($dt = mysqli_fetch_array($cr)) {
        $updt = mysqli_query($koneksi, "update po set tdel='0' where popk='$dt[popk]'");
    }
}
if ($_GET['x'] == "costing") {
    $cm = $_POST['cm'];
    $mat = $_POST['mat'];
    $other = $_POST['other'];
    $cmx = $_POST['cmx'];
    $matx = $_POST['matx'];
    $otherx = $_POST['otherx'];
    $ordpk = $_POST['ordpk'];

    $sqlb = mysqli_num_rows(mysqli_query($koneksi, "select * from costing where ordpk='$ordpk'"));

    if ($sqlb > 0) {
        $insert = mysqli_query($koneksi, "update costing set CM='$cm', materials='$mat', others='$other', dateupdt=NOW() where ordpk='$ordpk'");

        $sqlc = mysqli_query($koneksi, "select ordno from ord where ordpk='$ordpk'");
        $dtsqlc = mysqli_fetch_array($sqlc);
        if ($cm <> $cmx || $mat <> $matx || $other <> $otherx) {
            $insert2b = mysqli_query($koneksi, "insert into logcost set
    logdtime=NOW(),
    logdate=NOW(),
    logtime=NOW(),
    cm='$cm',
    mat='$mat',
    other='$other',
    ordpk='$ordpk'");
        }
    } else {
        $insert = mysqli_query($koneksi, "insert into costing set CM='$cm', materials='$mat', others='$other', ordpk='$ordpk', dateupdt=NOW()");
    }

    echo "<div class='text-infohijau' style='width:250px;'>Costing information saved. &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "updtunit") {
    $popk = $_POST['popk_unit'];
    $unitori2 = trim($_POST['unit_ori']);
    if (strcasecmp($unitori2, 'PCS') == 0 || strcasecmp($unitori2, 'PIECES') == 0 || strcasecmp($unitori2, 'PCE') == 0) {
        $unitori = "PCS";
    } else if (strcasecmp($unitori2, 'DZN') == 0 || strcasecmp($unitori2, 'DOZEN') == 0) {
        $unitori = "DOZEN";
    } else if (strcasecmp($unitori2, 'GROSS') == 0 || strcasecmp($unitori2, 'GRS') == 0) {
        $unitori = "GROSS";
    } else if (strcasecmp($unitori2, 'BOX') == 0 || strcasecmp($unitori2, 'PACK') == 0) {
        $unitori = "BOX";
    } else if (strcasecmp($unitori2, 'YARDS') == 0 || strcasecmp($unitori2, 'YDS') == 0 || strcasecmp($unitori2, 'YARD') == 0) {
        $unitori = "YARDS";
    } else if (strcasecmp($unitori2, 'KG') == 0 || strcasecmp($unitori2, 'KILOGRAM') == 0 || strcasecmp($unitori2, 'KGS') == 0) {
        $unitori = "KG";
    } else if (strcasecmp($unitori2, 'GRAM') == 0 || strcasecmp($unitori2, 'GRM') == 0) {
        $unitori = "GRAM";
    } else if (strcasecmp($unitori2, 'METER') == 0 || strcasecmp($unitori2, 'MTR') == 0 || strcasecmp($unitori2, 'METERS') == 0) {
        $unitori = "METER";
    } else if (strcasecmp($unitori2, 'CENTIMETER') == 0 || strcasecmp($unitori2, 'CM') == 0 || strcasecmp($unitori2, 'CENTIMETERS') == 0) {
        $unitori = "CENTIMETER";
    }
    $unitnew = trim($_POST['unit2']);
    $perpcs = $_POST['perpcs'];
    $kgwidth = $_POST['kgwidth'];
    $kgweight = $_POST['kgweight'];
    $custom = $_POST['custom'];
    $unitnewcustom = trim($_POST['unitnew']);
    $qtyunitcustom = $_POST['qtyunit'];

    $qry = mysqli_query($koneksi, "SELECT * FROM podt WHERE popk='$popk'");
    while ($dtqry = mysqli_fetch_array($qry)) {
        if (strcasecmp($unitori, 'PCS') == 0 && strcasecmp($unitnew, 'DOZEN') == 0) {
            $qtynew = ($dtqry['pocons'] - $dtqry['qrs']) / 12;
            if ($dtqry['qrs'] > 0) {
                $qrsnew = $dtqry['qrs'] / 12;
            } else {
                $qrsnew = 0;
            }
            // $pricenew = ($dtqry['price'] * $dtqry['pocons']) / $qtynew;
            $pricenew = $dtqry['price'] * 12;


            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnew', pocons2 = '$qtynew', qrs2 = '$qrsnew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
        } else if (strcasecmp($unitori, 'PCS') == 0 && strcasecmp($unitnew, 'GROSS') == 0) {
            $qtynew =  ($dtqry['pocons'] - $dtqry['qrs']) / 144;
            if ($dtqry['qrs'] > 0) {
                $qrsnew = $dtqry['qrs'] / 144;
            } else {
                $qrsnew = 0;
            }
            $pricenew = ($dtqry['price']) * 144;
            // $pricenew = $dtqry['price'];

            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnew', pocons2 = '$qtynew', qrs2 = '$qrsnew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
        } else if (strcasecmp($unitori, 'PCS') == 0 && strcasecmp($unitnew, 'BOX') == 0) {
            $qtynew =  ($dtqry['pocons'] - $dtqry['qrs']) / $perpcs;
            if ($dtqry['qrs'] > 0) {
                $qrsnew = $dtqry['qrs'] / $perpcs;
            } else {
                $qrsnew = 0;
            }
            // $pricenew = ($dtqry['price'] * $dtqry['pocons']) / $qtynew;
            $pricenew = ($dtqry['price']) * $perpcs;

            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnew', perpcs= '$perpcs', pocons2 = '$qtynew', qrs2 = '$qrsnew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
        } else if (strcasecmp($unitori, 'PCS') == 0 && strcasecmp($unitnew, 'PIECES') == 0) {
            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= NULL, pocons2 = '0', perpcs = '0', price2 = '0', qrs2 = '0' WHERE podtpk='$dtqry[podtpk]'");
            //DOZEN
        } else if (strcasecmp($unitori, 'DOZEN') == 0 && strcasecmp($unitnew, 'PIECES') == 0) {
            $qtynew =  ($dtqry['pocons'] - $dtqry['qrs']) * 12;
            if ($dtqry['qrs'] > 0) {
                $qrsnew =  $dtqry['qrs'] * 12;
            } else {
                $qrsnew =  0;
            }
            // $pricenew = ($dtqry['price'] * $dtqry['pocons']) / $qtynew;
            $pricenew = $dtqry['price'] / 12;

            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnew', pocons2 = '$qtynew', qrs2 = '$qrsnew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
            //GROSS
        } else if (strcasecmp($unitori, 'GROSS') == 0 && strcasecmp($unitnew, 'PIECES') == 0) {
            $qtynew =  ($dtqry['pocons'] - $dtqry['qrs']) * 144;
            if ($dtqry['qrs'] > 0) {
                $qrsnew = $dtqry['qrs'] * 144;
            } else {
                $qrsnew = 0;
            }
            // $pricenew = ($dtqry['price'] * $dtqry['pocons']) / $qtynew;
            $pricenew = $dtqry['price'] / 144;

            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnew', pocons2 = '$qtynew', qrs2 = '$qrsnew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
        } else if (strcasecmp($unitori, 'GROSS') == 0 && strcasecmp($unitnew, 'DOZEN') == 0) {
            $qtynew =  ($dtqry['pocons'] - $dtqry['qrs']) * 12;
            if ($dtqry['qrs'] > 0) {
                $qrsnew = $dtqry['qrs'] * 12;
            } else {
                $qrsnew = 0;
            }
            // $pricenew = ($dtqry['price'] * $dtqry['pocons']) / $qtynew;
            $pricenew = $dtqry['price'] / 12;

            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnew', pocons2 = '$qtynew', qrs2 = '$qrsnew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
            //BOX
        } else if (strcasecmp($unitori, 'BOX') == 0 && strcasecmp($unitnew, 'PIECES') == 0) {
            $qtynew =  ($dtqry['pocons'] - $dtqry['qrs']) * $perpcs;
            if ($dtqry['qrs'] > 0) {
                $qrsnew =  $dtqry['qrs'] * $perpcs;
            } else {
                $qrsnew =  0;
            }
            // $pricenew = ($dtqry['price'] * $dtqry['pocons']) / $qtynew;
            $pricenew = $dtqry['price'] / $perpcs;

            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnew', perpcs= '$perpcs', pocons2 = '$qtynew', qrs2 = '$qrsnew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
        } else if (strcasecmp($unitori, 'BOX') == 0 && strcasecmp($unitnew, 'BOX') == 0) {
            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= NULL, pocons2 = '0', price2 = '0', qrs2 = '0' WHERE podtpk='$dtqry[podtpk]'");
            //YARDS
        } else if (strcasecmp($unitori, 'YARDS') == 0 && strcasecmp($unitnew, 'KG') == 0) {
            $qtynew = $kgweight * 1.39354 * $kgwidth + 2 / 60 / 1000;
            // $pricenew = ($dtqry['price'] * $dtqry['pocons']) / $qtynew;
            $pricenew = $dtqry['price'];

            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnew', fabwidth= '$kgwidth', fablength= '$kgweight', pocons2 = '$qtynew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
        } else if (strcasecmp($unitori, 'YARDS') == 0 && strcasecmp($unitnew, 'METER') == 0) {
            $qtynew = ($dtqry['pocons'] - $dtqry['qrs']) * 0.9144;
            if ($dtqry['qrs'] > 0) {
                $qrsnew = $dtqry['qrs'] * 0.9144;
            } else {
                $qrsnew = 0;
            }
            // $pricenew = ($dtqry['price'] * $dtqry['pocons']) / $qtynew;
            $pricenew = $dtqry['price'] / 0.9144;

            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnew', pocons2 = '$qtynew', qrs2 = '$qrsnew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
        } else if (strcasecmp($unitori, 'YARDS') == 0 && strcasecmp($unitnew, 'YARDS') == 0) {
            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= NULL, pocons2 = '0', price2 = '0', qrs2 = '0' WHERE podtpk='$dtqry[podtpk]'");
            //GRAM
        } else if (strcasecmp($unitori, 'GRAM') == 0 && strcasecmp($unitnew, 'KG') == 0) {
            $qtynew = ($dtqry['pocons'] - $dtqry['qrs']) * 0.001;
            if ($dtqry['qrs'] > 0) {
                $qrsnew = $dtqry['qrs'] * 0.001;
            } else {
                $qrsnew = 0;
            }
            // $pricenew = ($dtqry['price'] * $dtqry['pocons']) / $qtynew;
            $pricenew = $dtqry['price'] / 0.001;

            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnew', pocons2 = '$qtynew', qrs2 = '$qrsnew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
        } else if (strcasecmp($unitori, 'GRAM') == 0 && strcasecmp($unitnew, 'GRAM') == 0) {
            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= NULL, pocons2 = '0', price2 = '0', qrs2 = '0' WHERE podtpk='$dtqry[podtpk]'");

            //KILOGRAM
        } else if (strcasecmp($unitori, 'KG') == 0 && strcasecmp($unitnew, 'GRAM') == 0) {
            $qtynew = ($dtqry['pocons'] - $dtqry['qrs']) * 1000;
            if ($dtqry['qrs'] > 0) {
                $qrsnew = $dtqry['qrs'] * 1000;
            } else {
                $qrsnew = 0;
            }
            // $pricenew = ($dtqry['price'] * $dtqry['pocons']) / $qtynew;
            $pricenew = $dtqry['price'] / 1000;

            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnew', pocons2 = '$qtynew', qrs2 = '$qrsnew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
        } else if (strcasecmp($unitori, 'KG') == 0 && strcasecmp($unitnew, 'KG') == 0) {
            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= NULL, pocons2 = '0', price2 = '0', qrs2 = '0' WHERE podtpk='$dtqry[podtpk]'");
            //Meter
        } else if (strcasecmp($unitori, 'METER') == 0 && strcasecmp($unitnew, 'YARDS') == 0) {
            $qtynew = ($dtqry['pocons'] - $dtqry['qrs']) * 1.094;
            if ($dtqry['qrs'] > 0) {
                $qrsnew = $dtqry['qrs'] * 1.094;
            } else {
                $qrsnew = 0;
            }
            // $pricenew = ($dtqry['price'] * $dtqry['pocons']) / $qtynew;
            $pricenew = $dtqry['price'] / 1.094;

            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnew', pocons2 = '$qtynew', qrs2 = '$qrsnew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
        } else if (strcasecmp($unitori, 'METER') == 0 && strcasecmp($unitnew, 'CENTIMETER') == 0) {
            $qtynew = ($dtqry['pocons'] - $dtqry['qrs']) * 100;
            if ($dtqry['qrs'] > 0) {
                $qrsnew = $dtqry['qrs'] * 100;
            } else {
                $qrsnew = 0;
            }
            // $pricenew = ($dtqry['price'] * $dtqry['pocons']) / $qtynew;
            $pricenew = $dtqry['price'] / 100;

            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnew', pocons2 = '$qtynew', qrs2 = '$qrsnew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
        } else if (strcasecmp($unitori, 'METER') == 0 && strcasecmp($unitnew, 'METER') == 0) {
            $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= NULL, pocons2 = '0', price2 = '0', qrs2 = '0' WHERE podtpk='$dtqry[podtpk]'");
        } else {
            if ($unitnew == 'CUSTOM') {
                if ($custom == 1) {
                    $updt = mysqli_query($koneksi, "UPDATE podt SET unit2 = '$unitnewcustom', pocons2 = '$dtqry[pocons]', price2 = '$dtqry[price]' WHERE podtpk='$dtqry[podtpk]'");
                } else {
                    $qtynew =  ($dtqry['pocons'] - $dtqry['qrs']) / $qtyunitcustom;
                    if ($dtqry['qrs'] > 0) {
                        $qrsnew =  $dtqry['qrs'] / $qtyunitcustom;
                    } else {
                        $qrsnew = 0;
                    }
                    // $pricenew = ($dtqry['price'] * $dtqry['pocons']) / $qtynew;
                    $pricenew = $dtqry['price'] * $qtyunitcustom;

                    $updt = mysqli_query($koneksi, "UPDATE podt SET unit2= '$unitnewcustom', perpcs= '$qtyunitcustom', pocons2 = '$qtynew', qrs2 = '$qrsnew', price2 = '$pricenew' WHERE podtpk='$dtqry[podtpk]'");
                }
            } else {
                echo "salah";
            }
        }
    }
}
if ($_GET['x'] == "replacepo1") {
    $result2 = mysqli_query($koneksi, "update podt set copy='3' where rkbpk='$_POST[rkbpk]'");
}

if ($_GET['x'] == "replacepo2") {
    $id = $_POST['id'];
    $N = count($id);
    for ($i = 0; $i < $N; $i++) {
        $result = @mysqli_query($koneksi, "update podt set copy='4' where rkbpk='$id'");
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "<div class='text-infohijau' style='width:415px;'>Replace data material success &nbsp; &#10004; </div>"));
        } else {
            echo json_encode(array('msg' => "<div class='text-infomerah' style='width:415px;'>Cannot process replace data material &nbsp; &#x2573; </div>"));
        }
    }
}
if ($_GET['x'] == "replacepo3") {
    // echo('test');
    // $po = $_POST['po'];
    $cr1 = mysqli_query($koneksi, "select * from podt where popk='$_POST[popk]' and copy='3'");
    $dt1 = mysqli_fetch_array($cr1);
    $item1 = addslashes($dt1['item']);
    $spec1 = addslashes($dt1['spec']);
    $colname1 = addslashes($dt1['colname']);
    $colcode1 = $dt1['colcode'];
    $sizegar1 = $dt1['sizegar'];
    $unit1 = $dt1['unit'];
    $pocons1 = $dt1['pocons'];
    $qrs1 = $dt1['qrs'];
    $price1 = $dt1['price'];

    $cr2 = mysqli_query($koneksi, "select * from podt where popk='$_POST[popk]' and copy='4'");
    while ($dt2 = mysqli_fetch_array($cr2)) {
        $item2 = addslashes($dt2['item']);
        $spec2 = addslashes($dt2['spec']);
        $colname2 = addslashes($dt2['colname']);
        $colcode2 = $dt2['colcode'];
        $sizegar2 = $dt2['sizegar'];
        $unit2 = $dt2['unit'];
        $pocons2 = $dt2['pocons'];
        $qrs2 = $dt2['qrs'];
        $price2 = $dt2['price'];

        if ($_POST['ceek1'] == "1") {
            $item = $item1;
        } else {
            $item = $item2;
        }
        if ($_POST['ceek2'] == "2") {
            $spec = $spec1;
        } else {
            $spec = $spec2;
        }
        if ($_POST['ceek3'] == "3") {
            $colname = $colname1;
        } else {
            $colname = $colname2;
        }
        if ($_POST['ceek4'] == "4") {
            $colcode = $colcode1;
        } else {
            $colcode = $colcode2;
        }
        if ($_POST['ceek5'] == "5") {
            $sizegar = $sizegar1;
        } else {
            $sizegar = $sizegar2;
        }
        if ($_POST['ceek6'] == "6") {
            $unit = $unit1;
        } else {
            $unit = $unit2;
        }
        if ($_POST['ceek7'] == "7") {
            $pocons = $pocons1;
        } else {
            $pocons = $pocons2;
        }
        if ($_POST['ceek8'] == "8") {
            $qrs = $qrs1;
        } else {
            $qrs = $qrs2;
        }
        if ($_POST['ceek9'] == "9") {
            $price = $price1;
        } else {
            $price = $price2;
        }

        $result2 = mysqli_query($koneksi, "update podt set
item='$item',
spec='$spec',
colname='$colname',
colcode='$colcode',
sizegar='$sizegar',
unit='$unit',
pocons='$pocons',
qrs='$qrs',
price='$price' where rkbpk='$dt2[rkbpk]' and copy='4'");
    }

    /*if($_POST['all']=="99"){
    $result2 = mysqli_query($koneksi,"update podt set
    item='$item',
    spec='$spec',
    colname='$colname',
    colcode='$colcode',
    sizegar='$sizegar',
    unit='$unit',
    pocons='$pocons',
    qrs='$qrs',
    price='$price' where popk='$_POST[popk]' and copy='4'");
    $result3 = mysqli_query($koneksi,"update podt set copy='0' where popk='$_POST[popk]' and copy='3'");
    $result4 = mysqli_query($koneksi,"update podt set copy='0' where popk='$_POST[popk]' and copy='4'");
    } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2" && $_POST['ceek3'] == "3" && $_POST['ceek4'] == "4" && $_POST['ceek5'] == "5" && $_POST['ceek6'] == "6" && $_POST['ceek7'] == "7" && $_POST['ceek8'] == "8" && $_POST['ceek9'] == "9"){
    $result2 = mysqli_query($koneksi,"update podt set
    item='$item',
    spec='$spec',
    colname='$colname',
    colcode='$colcode',
    sizegar='$sizegar',
    unit='$unit',
    pocons='$pocons',
    qrs='$qrs'
    price='$price' where popk='$_POST[popk]' and copy='4'");
    } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2" && $_POST['ceek3'] == "3" && $_POST['ceek4'] == "4" && $_POST['ceek5'] == "5" && $_POST['ceek6'] == "6" && $_POST['ceek7'] == "7" && $_POST['ceek8'] == "8"){
    $result2 = mysqli_query($koneksi,"update podt set
    item='$item',
    spec='$spec',
    colname='$colname',
    colcode='$colcode',
    sizegar='$sizegar',
    unit='$unit',
    pocons='$pocons',
    qrs='$qrs' where popk='$_POST[popk]' and copy='4'");
    } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2" && $_POST['ceek3'] == "3" && $_POST['ceek4'] == "4" && $_POST['ceek5'] == "5" && $_POST['ceek6'] == "6" && $_POST['ceek7'] == "7"){
    $result2 = mysqli_query($koneksi,"update podt set
    item='$item',
    spec='$spec',
    colname='$colname',
    colcode='$colcode',
    sizegar='$sizegar',
    unit='$unit',
    pocons='$pocons' where popk='$_POST[popk]' and copy='4'");
    } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2" && $_POST['ceek3'] == "3" && $_POST['ceek4'] == "4" && $_POST['ceek5'] == "5" && $_POST['ceek6'] == "6"){
    $result2 = mysqli_query($koneksi,"update podt set
    item='$item',
    spec='$spec',
    colname='$colname',
    colcode='$colcode',
    sizegar='$sizegar',
    unit='$unit' where popk='$_POST[popk]' and copy='4'");
    } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2" && $_POST['ceek3'] == "3" && $_POST['ceek4'] == "4" && $_POST['ceek5'] == "5"){
    $result2 = mysqli_query($koneksi,"update podt set
    item='$item',
    spec='$spec',
    colname='$colname',
    colcode='$colcode',
    sizegar='$sizegar' where popk='$_POST[popk]' and copy='4'");
    } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2" && $_POST['ceek3'] == "3" && $_POST['ceek4'] == "4"){
    $result2 = mysqli_query($koneksi,"update podt set
    item='$item',
    spec='$spec',
    colname='$colname',
    colcode='$colcode' where popk='$_POST[popk]' and copy='4'");
    } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2" && $_POST['ceek3'] == "3"){
    $result2 = mysqli_query($koneksi,"update podt set
    item='$item',
    spec='$spec',
    colname='$colname' where popk='$_POST[popk]' and copy='4'");
    } else if($_POST['ceek1']=="1" && $_POST['ceek2']=="2"){
        $result2 = mysqli_query($koneksi,"update podt set
        item='$item',
        spec='$spec' where popk='$_POST[popk]' and copy='4'");
    }else {
        if($_POST['ceek1']=="1"){ $result2 = mysqli_query($koneksi,"update podt set item='$item' where popk='$_POST[popk]' and copy='4'"); }
        else if($_POST['ceek2']=="2"){ $result2 = mysqli_query($koneksi,"update podt set spec='$spec' where popk='$_POST[popk]' and copy='4'"); } 
        else if($_POST['ceek3']=="3"){ $result2 = mysqli_query($koneksi,"update podt set colname='$colname' where popk='$_POST[popk]' and copy='4'"); }
        else if($_POST['ceek4']=="4"){ $result2 = mysqli_query($koneksi,"update podt set colcode='$colcode' where popk='$_POST[popk]' and copy='4'"); }
        else if($_POST['ceek5']=="5"){ $result2 = mysqli_query($koneksi,"update podt set sizegar='$sizegar' where popk='$_POST[popk]' and copy='4'"); }
        else if($_POST['ceek6']=="6"){ $result2 = mysqli_query($koneksi,"update podt set unit='$unit' where popk='$_POST[popk]' and copy='4'"); }
        else if($_POST['ceek7']=="7"){ $result2 = mysqli_query($koneksi,"update podt set pocons='$pocons'where popk='$_POST[popk]' and copy='4'"); }
        else if($_POST['ceek8']=="8"){ $result2 = mysqli_query($koneksi,"update podt set  qrs='$qrs' where popk='$_POST[popk]' and copy='4'"); }
        else if($_POST['ceek9']=="9"){ $result2 = mysqli_query($koneksi,"update podt set  price='$price' where popk='$_POST[popk]' and copy='4'"); 
        // }else{
        // $result2 = mysqli_query($koneksi,"update podt set
        // item='$item',
        // spec='$spec',
        // colname='$colname',
        // colcode='$colcode',
        // sizegar='$sizegar',
        // unit='$unit',
        // pocons='$pocons',
        // qrs='$qrs',
        // price='$price' where popk='$_POST[popk]' and copy='4'"); 
       }*/

    $result3 = mysqli_query($koneksi, "update podt set copy='0' where popk='$_POST[popk]' and copy='3'");
    $result4 = mysqli_query($koneksi, "update podt set copy='5' where popk='$_POST[popk]' and copy='4'");
    // }
    echo "<div class='text-infohijau'>Data successfully replaced &nbsp; &#10004; </div>";
}
if ($_GET['x'] == "canreplacepo") {
    $result2 = mysqli_query($koneksi, "update podt set copy='0' where popk='$_POST[po]' and copy='3'");
    $result3 = mysqli_query($koneksi, "update podt set copy='0' where popk='$_POST[po]' and copy='4'");
    //echo "<div class='text-infohijau'>Assignment order success &nbsp; &#10004; </div>";
}

if ($_GET['x'] == "syncfob") {
    $dtc = mysqli_fetch_array(mysqli_query($koneksi, "select * from costing where ordpk='$_POST[ordpks]'"));
    $fob = $dtc['CM'] + $dtc['materials'] + $dtc['others'];
    $updatefob = mysqli_query($koneksi, "update bdown set FOB='$fob' where ordpk='$_POST[ordpks]' and jenis='DETAIL'");

    $cr3 = mysqli_query($koneksi, "select * from ord where ordpk='$_POST[ordpks]'");
    $dt3 = mysqli_fetch_array($cr3);

    $lognote = "User " . $userlog . " sync harga costing ke order qty " . $dt3['ordno'];
    $insert2 = mysqli_query($koneksi, "insert into logtran set
    logdtime=NOW(),
    logdate=NOW(),
    logtime=NOW(),
    logip='$ip',
    lognote='$lognote',
    ordpk='$dt3[ordpk]',
    sistem='$sistem'");
    echo "<div class='text-infohijau' style='width:315px;'>Berhasil sync harga costing ke order. &nbsp; &#10004; </div>";
}
if ($_GET['x'] == "lokasi") {
    $updatelokasi = mysqli_query($koneksi, "UPDATE ord SET mif='$_POST[lokasi2]' WHERE ordpk='$_POST[ordpk]'");
    echo "<div class='text-infohijau'> Data location updated &nbsp; &#10004; </div>";
}
?>