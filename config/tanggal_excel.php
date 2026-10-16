<?php
/**
 * Konversi nilai tanggal dari sel Excel menjadi format DATE MySQL (Y-m-d).
 *
 * Kenapa perlu: pembaca spreadsheet di sini memakai setReadDataOnly(true),
 * yang TIDAK membaca format sel — sehingga tanggal kembali sebagai angka
 * serial Excel (mis. 46037), bukan "15/01/2026". Angka itu kalau langsung
 * dimasukkan ke kolom DATE tidak bisa dibaca MySQL, dan karena server
 * berjalan non-strict nilainya diam-diam menjadi '0000-00-00' — tampil
 * kosong di layar tanpa pesan error apa pun.
 *
 * Mengganti setReadDataOnly menjadi false saja tidak cukup: hasilnya
 * "15/01/2026", yang juga bukan format DATE MySQL.
 *
 * Mengembalikan null kalau selnya kosong atau tidak bisa dibaca, supaya
 * kolomnya benar-benar NULL dan bukan '0000-00-00'.
 */
function excel_ke_tanggal($nilai)
{
    if ($nilai === null) return null;

    if (is_string($nilai)) {
        $nilai = trim($nilai);
        if ($nilai === '') return null;
    }

    // Serial Excel — bentuk yang dihasilkan setReadDataOnly(true).
    if (is_numeric($nilai)) {
        if ((float) $nilai <= 0) return null;

        try {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float) $nilai)->format('Y-m-d');
        } catch (\Throwable $e) {
            return null;
        }
    }

    // Sel bertipe teks: terima format yang lazim dipakai di template.
    foreach (['d/m/Y', 'j/n/Y', 'Y-m-d', 'd-m-Y', 'd/m/y'] as $format) {
        $tgl = DateTime::createFromFormat($format, $nilai);

        if ($tgl && $tgl->format($format) === $nilai) {
            return $tgl->format('Y-m-d');
        }
    }

    $waktu = strtotime($nilai);

    return $waktu ? date('Y-m-d', $waktu) : null;
}

/**
 * Potongan SQL siap tempel: "'2026-01-15'" atau NULL (tanpa kutip).
 *
 * Dipakai TANPA kutip di query — `gac=" . tanggal_sql($x) . "` — supaya sel
 * kosong tersimpan sebagai NULL, bukan '' yang di MySQL non-strict berubah
 * jadi '0000-00-00'.
 */
function tanggal_sql($nilai)
{
    $tgl = excel_ke_tanggal($nilai);

    return $tgl === null ? 'NULL' : "'" . $tgl . "'";
}

/**
 * Validasi tahun pada kolom tanggal file upload: maksimal $rentang tahun ke
 * depan dari tahun berjalan (mis. 2026 -> maksimal 2028).
 *
 * Dijalankan untuk seluruh sheet SEBELUM ada data yang disimpan/dihapus,
 * supaya satu sel salah tidak membuat upload tersimpan setengah.
 *
 * $kolom  : [index kolom => label], mis. [9 => 'PCD', 10 => 'Ex Factory']
 * $lewati : callable(baris) -> true untuk baris yang tidak dicek (HEADER dsb.)
 *
 * Mengembalikan null kalau semua valid, atau HTML pesan error per kolom.
 */
function validasi_tahun_upload(array $sheetData, $barisAwal, array $kolom, callable $lewati = null, $rentang = 2)
{
    $maks  = (int) date('Y') + $rentang;
    $salah = [];

    for ($i = $barisAwal; $i < count($sheetData); $i++) {
        $baris = $sheetData[$i];
        if ($lewati && $lewati($baris)) continue;

        foreach ($kolom as $idx => $label) {
            $tgl = excel_ke_tanggal($baris[$idx] ?? null);

            if ($tgl !== null && (int) substr($tgl, 0, 4) > $maks) {
                $salah[$label][] = $i + 1; // nomor baris di Excel
            }
        }
    }

    if (!$salah) return null;

    $pesan = [];
    foreach ($salah as $label => $daftar) {
        $tampil = array_slice($daftar, 0, 10);
        $lebih  = count($daftar) > 10 ? ', dst.' : '';
        $pesan[] = "Data tahun kolom <b>$label</b> maksimal 2 tahun (s/d $maks) &mdash; baris Excel: "
            . implode(', ', $tampil) . $lebih;
    }

    // Sengaja tidak memakai class text-infomerah: class itu flex + tinggi tetap
    // 40px untuk toast satu baris, sehingga pesan panjang jadi terpotong.
    return "<div class='validasi-tahun' style='text-align:left;line-height:1.6;font-size:14px;color:#333;'>"
        . "<div style='color:#EF3B42;font-weight:700;margin-bottom:6px;'>Upload dibatalkan</div>"
        . implode('<br>', $pesan)
        . "<div style='margin-top:8px;'>Tidak ada data yang disimpan, perbaiki file lalu upload ulang.</div></div>";
}