<?php
session_start();
include "../config/koneksi.php";
include "../config/koneksi11a.php";
include "../config/koneksi11s.php";
include "../config/koneksi11u.php";
include "../config/koneksi103a.php";
include "../config/tanggal2.php";
include "../config/ip.php";

$ip = ip();
$browser = browser();
$sistem = $_SERVER['HTTP_USER_AGENT'];
$userlog = $_SESSION['login'];
$sfu = $_SESSION['funm'];
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_GET['x']) && $_GET['x'] == "apv") {

    $popk_raw = isset($_POST['id']) ? trim($_POST['id']) : '';

    if ($popk_raw == '') {
        echo json_encode(["success" => false, "msg" => "Error: No PO Selected."]);
        exit;
    }
    
    try {
        mysqli_begin_transaction($koneksi);

        $ids = mysqli_real_escape_string($koneksi, $popk_raw);

        $sql_check = "SELECT rkb.rkbpk 
                      FROM rkb 
                      WHERE rkb.popk IN ($ids) AND rkb.stspk = 5 LIMIT 1";
        $res_check = mysqli_query($koneksi, $sql_check);

        if (mysqli_num_rows($res_check) > 0) {

            $sql_approve_podt = "UPDATE podt 
                                 INNER JOIN rkb ON podt.rkbpk = rkb.rkbpk 
                                               AND podt.popk = rkb.popk 
                                 SET 
                                     podt.nour         = rkb.nour,
                                     podt.ordpk        = rkb.ordpk,
                                     podt.item         = rkb.item,
                                     podt.itemadd      = rkb.itemadd,
                                     podt.suppk        = rkb.suppk,
                                     podt.sup          = rkb.sup,
                                     podt.hspec        = rkb.hspec,
                                     podt.tspec        = rkb.tspec,
                                     podt.nspec        = rkb.nspec,
                                     podt.spec         = rkb.spec,
                                     podt.hspec1       = rkb.hspec1, podt.hspec2 = rkb.hspec2, podt.hspec3 = rkb.hspec3,
                                     podt.hspec4       = rkb.hspec4, podt.hspec5 = rkb.hspec5, podt.hspec6 = rkb.hspec6,
                                     podt.hspec7       = rkb.hspec7, podt.hspec8 = rkb.hspec8, podt.hspec9 = rkb.hspec9,
                                     podt.hspec10      = rkb.hspec10,
                                     podt.spec1        = rkb.spec1, podt.spec2  = rkb.spec2, podt.spec3  = rkb.spec3,
                                     podt.spec4        = rkb.spec4, podt.spec5  = rkb.spec5, podt.spec6  = rkb.spec6,
                                     podt.spec7        = rkb.spec7, podt.spec8  = rkb.spec8, podt.spec9  = rkb.spec9,
                                     podt.spec10       = rkb.spec10,
                                     podt.specadd      = rkb.specadd,
                                     podt.unit         = rkb.unit,
                                     podt.colname      = rkb.colname,
                                     podt.colcode      = rkb.colcode,
                                     podt.sizegar      = rkb.sizegar,
                                     podt.sizemat      = rkb.sizemat,
                                     podt.estcons      = rkb.estcons,
                                     podt.allowcons    = rkb.allowcons,
                                     podt.totcons      = rkb.totcons,
                                     podt.pocons       = rkb.pocons,
                                     podt.bdownpk      = rkb.bdownpk,
                                     podt.kolom        = rkb.kolom,
                                     podt.bdownqty     = rkb.bdownqty,
                                     podt.kelnm        = rkb.kelnm,
                                     podt.submit       = rkb.submit,
                                     podt.submitdate   = rkb.submitdate,
                                     podt.stspk        = rkb.stspk,
                                     podt.nopo         = rkb.nopo,
                                     podt.manual       = rkb.manual,
                                     podt.rumus        = rkb.rumus,
                                     podt.f1           = rkb.f1,
                                     podt.f2           = rkb.f2,
                                     podt.qrs          = rkb.qrs,
                                     podt.matusage     = rkb.matusage
                                 WHERE podt.popk IN ($ids)";

            $sql_approve_rpo = "UPDATE rpo 
                                INNER JOIN rkb ON rpo.rkbpk = rkb.rkbpk 
                                              AND rpo.popk = rkb.popk 
                                SET 
                                    rpo.nour         = rkb.nour,
                                    rpo.ordpk        = rkb.ordpk,
                                    rpo.item         = rkb.item,
                                    rpo.itemadd      = rkb.itemadd,
                                    rpo.suppk        = rkb.suppk,
                                    rpo.sup          = rkb.sup,
                                    rpo.hspec        = rkb.hspec,
                                    rpo.tspec        = rkb.tspec,
                                    rpo.nspec        = rkb.nspec,
                                    rpo.spec         = rkb.spec,
                                    rpo.hspec1       = rkb.hspec1, rpo.hspec2 = rkb.hspec2, rpo.hspec3 = rkb.hspec3,
                                    rpo.hspec4       = rkb.hspec4, rpo.hspec5 = rkb.hspec5, rpo.hspec6 = rkb.hspec6,
                                    rpo.hspec7       = rkb.hspec7, rpo.hspec8 = rkb.hspec8, rpo.hspec9 = rkb.hspec9,
                                    rpo.hspec10      = rkb.hspec10,
                                    rpo.spec1        = rkb.spec1, rpo.spec2 = rkb.spec2, rpo.spec3 = rkb.spec3,
                                    rpo.spec4        = rkb.spec4, rpo.spec5 = rkb.spec5, rpo.spec6 = rkb.spec6,
                                    rpo.spec7        = rkb.spec7, rpo.spec8 = rkb.spec8, rpo.spec9 = rkb.spec9,
                                    rpo.spec10       = rkb.spec10,
                                    rpo.specadd      = rkb.specadd,
                                    rpo.unit         = rkb.unit,
                                    rpo.colname      = rkb.colname,
                                    rpo.colcode      = rkb.colcode,
                                    rpo.sizegar      = rkb.sizegar,
                                    rpo.sizemat      = rkb.sizemat,
                                    rpo.negocons     = rkb.negocons,
                                    rpo.varcons      = rkb.varcons,
                                    rpo.estcons      = rkb.estcons,
                                    rpo.allowcons    = rkb.allowcons,
                                    rpo.totcons      = rkb.totcons,
                                    rpo.pocons       = rkb.pocons,
                                    
                                    rpo.bdownpk      = rkb.bdownpk,
                                    rpo.kolom        = rkb.kolom,
                                    rpo.bdownqty     = rkb.bdownqty,
                                    rpo.kelnm        = rkb.kelnm,
                                    rpo.level        = rkb.level,
                                    rpo.submit       = rkb.submit,
                                    rpo.submitdate   = rkb.submitdate,
                                    rpo.stspk        = rkb.stspk,
                                    rpo.poreqdel     = rkb.poreqdel,
                                    rpo.popros       = rkb.popros,
                                    rpo.polipk       = rkb.polipk,
                                    rpo.postatpk     = rkb.postatpk,
                                    rpo.pourgpk      = rkb.pourgpk,
                                    rpo.ponew        = rkb.ponew,
                                    rpo.porevised    = rkb.porevised,
                                    rpo.pocanceled   = rkb.pocanceled,
                                    rpo.newdate      = rkb.newdate,
                                    rpo.revdate      = rkb.revdate,
                                    rpo.candate      = rkb.candate,
                                    rpo.ponote       = rkb.ponote,
                                    rpo.nopo         = rkb.nopo,
                                    rpo.manual       = rkb.manual,
                                    rpo.rumus        = rkb.rumus,
                                    rpo.f1           = rkb.f1,
                                    rpo.f2           = rkb.f2,
                                    rpo.qrs          = rkb.qrs,
                                    rpo.matusage     = rkb.matusage
                                WHERE rpo.popk IN ($ids)";
                                        
            mysqli_query($koneksi, $sql_approve_podt);
            mysqli_query($koneksi, $sql_approve_rpo);

            $sql_update_po = "UPDATE po SET 
                                stsrev = '2', 
                                dateupdt = NOW() 
                              WHERE popk IN ($ids)";
            mysqli_query($koneksi, $sql_update_po);

            $sql_get_pono = "SELECT pono FROM po WHERE popk IN ($ids)";
            $res_pono = mysqli_query($koneksi, $sql_get_pono);
            
            $list_pono = [];
            while ($row_pono = mysqli_fetch_assoc($res_pono)) {
                $list_pono[] = $row_pono['pono'];
            }
            $pono_display = count($list_pono) > 0 ? implode(', ', $list_pono) : $popk_raw;

            // Jika semua query sukses sampai sini, commit perubahannya
            mysqli_commit($koneksi);

            echo json_encode([
                "success" => true, 
                "msg" => "Revision for PO No. [" . $pono_display . "] has been successfully approved."
            ]);

        } else {
            echo json_encode([
                "success" => false, 
                "msg" => "Error: No data found with revision status (stspk = 5) for POPK: [" . $popk_raw . "]"
            ]);
        }

    } catch (Exception $e) {
        // Jika ada query yang error, batalkan semua perubahan database yang terlanjur berjalan
        mysqli_rollback($koneksi);

        echo json_encode([
            "success" => false, 
            "msg" => "Database Error: " . $e->getMessage()
        ]);
    }
    
    exit;
}


if (isset($_GET['x']) && $_GET['x'] == "canapv") {

    $popk_raw = isset($_POST['id']) ? trim($_POST['id']) : '';

    if ($popk_raw == '') {
        echo json_encode(["success" => false, "msg" => "Error: No PO Selected."]);
        exit;
    }

    try {
        mysqli_begin_transaction($koneksi);

        $ids = mysqli_real_escape_string($koneksi, $popk_raw);

        $sql_check = "SELECT rpo.rpopk 
                      FROM rpo 
                      INNER JOIN rkb ON rpo.rkbpk = rkb.rkbpk AND rpo.popk = rkb.popk
                      WHERE rpo.popk IN ($ids) AND rkb.stspk = 5 LIMIT 1";
        $res_check = mysqli_query($koneksi, $sql_check);

        if (mysqli_num_rows($res_check) > 0) {
            
            $sql_restore_rkb = "UPDATE rkb 
                                INNER JOIN rpo ON rkb.rkbpk = rpo.rkbpk AND rkb.popk = rpo.popk
                                SET 
                                    rkb.nour       = rpo.nour,
                                    rkb.ordpk      = rpo.ordpk,
                                    rkb.item       = rpo.item,
                                    rkb.itemadd    = rpo.itemadd,
                                    rkb.suppk      = rpo.suppk,
                                    rkb.sup        = rpo.sup,
                                    rkb.hspec      = rpo.hspec,
                                    rkb.tspec      = rpo.tspec,
                                    rkb.nspec      = rpo.nspec,
                                    rkb.spec       = rpo.spec,
                                    rkb.hspec1     = rpo.hspec1, rkb.hspec2 = rpo.hspec2, rkb.hspec3 = rpo.hspec3,
                                    rkb.hspec4     = rpo.hspec4, rkb.hspec5 = rpo.hspec5, rkb.hspec6 = rpo.hspec6,
                                    rkb.hspec7     = rpo.hspec7, rkb.hspec8 = rpo.hspec8, rkb.hspec9 = rpo.hspec9,
                                    rkb.hspec10    = rpo.hspec10,
                                    rkb.spec1      = rpo.spec1, rkb.spec2 = rpo.spec2, rkb.spec3 = rpo.spec3,
                                    rkb.spec4      = rpo.spec4, rkb.spec5 = rpo.spec5, rkb.spec6 = rpo.spec6,
                                    rkb.spec7      = rpo.spec7, rkb.spec8 = rpo.spec8, rkb.spec9 = rpo.spec9,
                                    rkb.spec10     = rpo.spec10,
                                    rkb.specadd    = rpo.specadd,
                                    rkb.unit       = rpo.unit,
                                    rkb.colname    = rpo.colname,
                                    rkb.colcode    = rpo.colcode,
                                    rkb.sizegar    = rpo.sizegar,
                                    rkb.sizemat    = rpo.sizemat,
                                    rkb.negocons   = rpo.negocons,
                                    rkb.varcons    = rpo.varcons,
                                    rkb.estcons    = rpo.estcons,
                                    rkb.allowcons  = rpo.allowcons,
                                    rkb.totcons    = rpo.totcons,
                                    rkb.pocons     = rpo.pocons,
                                    rkb.bdownpk    = rpo.bdownpk,
                                    rkb.kolom      = rpo.kolom,
                                    rkb.bdownqty   = rpo.bdownqty,
                                    rkb.kelnm      = rpo.kelnm,
                                    rkb.level      = rpo.level,
                                    rkb.submit     = rpo.submit,
                                    rkb.submitdate = rpo.submitdate,
                                    rkb.stspk      = 2, 
                                    rkb.poreqdel   = rpo.poreqdel,
                                    rkb.popros     = rpo.popros,
                                    rkb.polipk     = rpo.polipk,
                                    rkb.postatpk   = rpo.postatpk,
                                    rkb.pourgpk    = rpo.pourgpk,
                                    rkb.ponew      = rpo.ponew,
                                    rkb.porevised  = rpo.porevised,
                                    rkb.pocanceled = rpo.pocanceled,
                                    rkb.newdate    = rpo.newdate,
                                    rkb.revdate    = rpo.revdate,
                                    rkb.candate    = rpo.candate,
                                    rkb.ponote     = rpo.ponote,
                                    rkb.nopo       = rpo.nopo,
                                    rkb.manual     = rpo.manual,
                                    rkb.rumus      = rpo.rumus,
                                    rkb.f1         = rpo.f1,
                                    rkb.f2         = rpo.f2,
                                    rkb.qrs        = rpo.qrs,
                                    rkb.matusage   = rpo.matusage
                                WHERE rkb.popk IN ($ids) AND rkb.stspk = 5"; 
                                
            mysqli_query($koneksi, $sql_restore_rkb);

            $sql_update_po = "UPDATE po SET 
                                stsrev = '3', 
                                dateupdt = NOW() 
                              WHERE popk IN ($ids)";
            mysqli_query($koneksi, $sql_update_po);

            $sql_get_pono = "SELECT pono FROM po WHERE popk IN ($ids)";
            $res_pono = mysqli_query($koneksi, $sql_get_pono);
            
            $list_pono = [];
            while ($row_pono = mysqli_fetch_assoc($res_pono)) {
                $list_pono[] = $row_pono['pono'];
            }
            $pono_display = count($list_pono) > 0 ? implode(', ', $list_pono) : $popk_raw;

            // Jika semua query di atas berhasil tanpa memicu exception, simpan permanen
            mysqli_commit($koneksi);

            echo json_encode([
                "success" => true, 
                "msg" => "Revision for PO No. [" . $pono_display . "] has been successfully cancelled and all data columns restored."
            ]);

        } else {
            echo json_encode([
                "success" => false, 
                "msg" => "Error: No original backup data found in rpo table for POPK: [" . $popk_raw . "]"
            ]);
        }

    } catch (Exception $e) {
        // Batalkan semua transaksi jika ada error salah satu query di atas
        mysqli_rollback($koneksi);

        echo json_encode([
            "success" => false, 
            "msg" => "Database Error: " . $e->getMessage()
        ]);
    }
    
    exit;
}

// if (isset($_GET['x']) && $_GET['x'] == "canapv") {

//     header('Content-Type: application/json');

//     // Menerima string ID yang dipisah koma, contoh: "121174,121173"
//     $popk_raw = isset($_POST['id']) ? trim($_POST['id']) : '';

//     if ($popk_raw == '') {
//         echo json_encode([
//             "success" => false, 
//             "msg" => "TESTING GAGAL: ID (popk) tidak diterima oleh PHP backend!"
//         ]);
//         exit;
//     }

//     $ids = mysqli_real_escape_string($koneksi, $popk_raw);

//     // 1. Ambil list PO terlebih dahulu
//     $sql_po = "SELECT popk, pono FROM po WHERE popk IN ($ids)";
//     $res_po = mysqli_query($koneksi, $sql_po);
    
//     if (mysqli_num_rows($res_po) == 0) {
//         echo json_encode(["success" => false, "msg" => "Data PO tidak ditemukan di database."]);
//         exit;
//     }

//     $message = "<b>=== RINCIAN DATA PENGECEKAN PO ===</b><br><br>";
//     $is_all_valid = true;

//     // 2. Looping per masing-masing PO yang dipilih untuk dicari data RKB & RPO nya
//     while ($row_po = mysqli_fetch_assoc($res_po)) {
//         $current_popk = $row_po['popk'];
//         $current_pono = $row_po['pono'];

//         $message .= "📌 <b>PO No: $current_pono (POPK: $current_popk)</b><br>";

//         // --- A. CARI DATA DI TABEL RKB (Khusus yang stspk = 5 untuk direvisi) ---
//         $sql_rkb = "SELECT rkbpk FROM rkb WHERE popk = '$current_popk' AND stspk = 5";
//         $res_rkb = mysqli_query($koneksi, $sql_rkb);
//         $count_rkb = mysqli_num_rows($res_rkb);
        
//         $list_rkbpk_rkb = [];
//         while ($row_rkb = mysqli_fetch_assoc($res_rkb)) {
//             $list_rkbpk_rkb[] = $row_rkb['rkbpk'];
//         }

//         // --- B. CARI DATA DI TABEL HISTORI RPO ---
//         $sql_rpo = "SELECT rkbpk FROM rpo WHERE popk = '$current_popk'";
//         $res_rpo = mysqli_query($koneksi, $sql_rpo);
//         $count_rpo = mysqli_num_rows($res_rpo);
        
//         $list_rkbpk_rpo = [];
//         while ($row_rpo = mysqli_fetch_assoc($res_rpo)) {
//             $list_rkbpk_rpo[] = $row_rpo['rkbpk'];
//         }

//         // Tulis laporan RKB untuk PO ini
//         $message .= "&nbsp;&nbsp; ▪️ <b>Tabel RKB (stspk=5):</b> " . $count_rkb . " item ditemukan<br>";
//         if ($count_rkb > 0) {
//             $message .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; └─ RKBPK: [" . implode(', ', $list_rkbpk_rkb) . "]<br>";
//         } else {
//             $is_all_valid = false; // Flag gagal jika rkb revisi kosong
//         }

//         // Tulis laporan RPO untuk PO ini
//         $message .= "&nbsp;&nbsp; ▪️ <b>Tabel RPO (Backup):</b> " . $count_rpo . " item ditemukan<br>";
//         if ($count_rpo > 0) {
//             $message .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; └─ RKBPK: [" . implode(', ', $list_rkbpk_rpo) . "]<br>";
//         } else {
//             $is_all_valid = false; // Flag gagal jika backup histori kosong
//         }
        
//         $message .= "--------------------------------------------------------<br>";
//     }

//     // 3. Kesimpulan Akhir
//     if ($is_all_valid) {
//         $message .= "🟢 <b>KESIMPULAN:</b> Seluruh kecocokan popk & rkbpk VALID. Siap diproses cancel revisi!";
//         echo json_encode([
//             "success" => true,
//             "msg" => $message
//         ]);
//     } else {
//         $message .= "🔴 <b>KESIMPULAN:</b> Ada data yang kosong/pincang di RKB atau RPO!";
//         echo json_encode([
//             "success" => false,
//             "msg" => $message
//         ]);
//     }
//     exit;
// }
?>