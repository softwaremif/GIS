<?php
/**
 * Catatan perubahan breakdown yang perlu diketahui bagian schedule.
 *
 * Hanya tiga hal yang dicatat di sini: PCD, Ex-Factory (gac) dan total qty
 * order — cuma itu yang memengaruhi jadwal produksi.
 *
 * Kalimat "ubah breakdown order" adalah PENANDA yang dibaca SPS
 * (App\Services\Ordschedlc\OrdschedlcBdownChangeService) untuk memunculkan
 * notifikasi di halaman timeline. GIS dan SPS memakai database yang sama
 * (sig @ 192.168.0.50), jadi formatnya harus persis sama dengan yang ditulis
 * SPS di BreakdownController::LogBdownPenting — kalau berbeda sedikit saja,
 * perubahan dari GIS tidak akan pernah muncul di notifikasi.
 */

/** Nilai PCD, Ex-Factory dan total qty order pada satu saat. */
function bdown_snapshot($koneksi, $ordpk, $bdownpk)
{
    $ordpk = intval($ordpk);
    $bdownpk = intval($bdownpk);

    $baris = mysqli_fetch_assoc(mysqli_query(
        $koneksi,
        "select pcd, gac from bdown where bdownpk='$bdownpk'"
    ));

    return array(
        'pcd'      => isset($baris['pcd']) ? $baris['pcd'] : null,
        'gac'      => isset($baris['gac']) ? $baris['gac'] : null,
        'totorder' => bdown_total_order($koneksi, $ordpk),
    );
}

/**
 * Tulis log kalau ada yang berubah dari $sebelum. Tidak menulis apa pun kalau
 * ketiga nilainya sama.
 */
function log_bdown_penting($koneksi, $ordpk, $bdownpk, $sebelum, $userlog, $ip, $sistem)
{
    $ordpk = intval($ordpk);
    $bdownpk = intval($bdownpk);

    $sesudah = bdown_snapshot($koneksi, $ordpk, $bdownpk);

    $label = array('pcd' => 'PCD', 'gac' => 'Ex-Factory', 'totorder' => 'Total qty');
    $berubah = array();

    foreach ($label as $kolom => $nama) {
        $a = $sebelum[$kolom];
        $b = $sesudah[$kolom];

        if ((string) $a === (string) $b) continue;

        $berubah[] = $nama . ' '
            . ($a === null || $a === '' ? '(kosong)' : $a) . ' -> '
            . ($b === null || $b === '' ? '(kosong)' : $b);
    }

    if (empty($berubah)) return false;

    $ord = mysqli_fetch_assoc(mysqli_query($koneksi, "select ordno from ord where ordpk='$ordpk'"));
    $ordno = isset($ord['ordno']) ? $ord['ordno'] : '';

    $lognote = "User " . $userlog . " ubah breakdown order " . $ordno . ": " . implode('; ', $berubah);
    $lognote = mysqli_real_escape_string($koneksi, substr($lognote, 0, 500));
    $ip = mysqli_real_escape_string($koneksi, $ip);
    $sistem = mysqli_real_escape_string($koneksi, $sistem);

    return mysqli_query($koneksi, "insert into logtran set
        logdtime=NOW(),
        logdate=NOW(),
        logtime=NOW(),
        logip='$ip',
        lognote='$lognote',
        ordpk='$ordpk',
        bdownpk='$bdownpk',
        sistem='$sistem'");
}

/**
 * Total qty satu order, dihitung dari baris DETAIL.
 *
 * SENGAJA tidak membaca baris FOOTER1 sumby='total' seperti yang dilakukan SPS:
 * baris footer itu hanya dipelihara oleh SPS (BreakdownController), sedangkan
 * GIS tidak pernah menulisnya — hanya membaca. Kalau di sini footer yang
 * dibandingkan, nilainya tidak pernah berubah saat orang mengedit dari GIS dan
 * perubahan qty tidak akan pernah terdeteksi.
 *
 * Pada 470 dari 500 order terakhir kedua angka ini sama; selisih pada sisanya
 * justru menandakan footer-nya sudah basi.
 */
function bdown_total_order($koneksi, $ordpk)
{
    $ordpk = intval($ordpk);
    $r = mysqli_fetch_assoc(mysqli_query(
        $koneksi,
        "select COALESCE(SUM(tot),0) s from bdown where ordpk='$ordpk' and jenis='DETAIL'"
    ));

    return isset($r['s']) ? $r['s'] : null;
}

/**
 * Untuk tambah/hapus baris PO: yang berubah hanya total qty order. PCD dan
 * Ex-Factory tidak dibandingkan karena barisnya memang baru muncul atau sudah
 * hilang — membandingkannya akan menghasilkan "PCD x -> (kosong)" yang keliru.
 */
function log_bdown_total($koneksi, $ordpk, $bdownpk, $totalSebelum, $userlog, $ip, $sistem)
{
    $ordpk = intval($ordpk);
    $bdownpk = intval($bdownpk);

    $totalSesudah = bdown_total_order($koneksi, $ordpk);

    if ((string) $totalSebelum === (string) $totalSesudah) return false;

    $ord = mysqli_fetch_assoc(mysqli_query($koneksi, "select ordno from ord where ordpk='$ordpk'"));
    $ordno = isset($ord['ordno']) ? $ord['ordno'] : '';

    $lognote = "User " . $userlog . " ubah breakdown order " . $ordno . ": Total qty "
        . ($totalSebelum === null || $totalSebelum === '' ? '(kosong)' : $totalSebelum) . ' -> '
        . ($totalSesudah === null || $totalSesudah === '' ? '(kosong)' : $totalSesudah);

    $lognote = mysqli_real_escape_string($koneksi, substr($lognote, 0, 500));
    $ip = mysqli_real_escape_string($koneksi, $ip);
    $sistem = mysqli_real_escape_string($koneksi, $sistem);

    return mysqli_query($koneksi, "insert into logtran set
        logdtime=NOW(),
        logdate=NOW(),
        logtime=NOW(),
        logip='$ip',
        lognote='$lognote',
        ordpk='$ordpk',
        bdownpk='$bdownpk',
        sistem='$sistem'");
}
