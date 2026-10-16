<?php
// Proses simpan upload excel material (template dari excel/excel_template_material.php).
// Aturan simpan mengikuti form Add Material (action/simpan.php?x=mat, bagian insert).
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/ip.php";
require "../config/vendor/autoload.php";
include_once "../excel/template_material_cols.php";

header('Content-Type: application/json');

$ip = ip();
$sistem = addslashes($_SERVER['HTTP_USER_AGENT']);
$userlog = $_SESSION['login'];
$next = date("Y-m-d", strtotime("+1 days"));

function selesai($success, $msg, $errors = array())
{
	echo json_encode(array('success' => $success, 'msg' => $msg, 'errors' => $errors));
	exit;
}

function esc($v)
{
	global $koneksi;
	return mysqli_real_escape_string($koneksi, $v);
}

// hitung netto dengan formula, sama dengan view/get_rumus.php
function hitung_rumus($netto, $f1, $f2)
{
	$hasil = array($netto);
	foreach (array($f1, $f2) as $f) {
		$op = substr($f, 0, 1);
		$val = (float) substr($f, 1, 9);
		$prev = end($hasil);
		if ($op == "-") {
			$hasil[] = $prev - $val;
		} else if ($op == "*") {
			$hasil[] = $prev * $val;
		} else if ($op == "/") {
			$hasil[] = $val != 0 ? $prev / $val : 0;
		} else {
			$hasil[] = $prev + $val;
		}
	}
	if ($hasil[2] > 0) return $hasil[2];
	if ($hasil[1] > 0) return $hasil[1];
	return $hasil[0];
}

$ord = (int) $_POST['ordpk'];
if ($ord <= 0) {
	selesai(false, 'Order tidak ditemukan.');
}
$dtord = mysqli_fetch_array(mysqli_query($koneksi, "select ordpk, ordno from ord where ordpk='$ord'"));
if (!$dtord) {
	selesai(false, 'Order tidak ditemukan.');
}

// ===== Cek file =====
if (!isset($_FILES['uploadfile']) || $_FILES['uploadfile']['error'] != UPLOAD_ERR_OK) {
	selesai(false, 'File gagal diupload, silakan pilih ulang file.');
}
$file = $_FILES['uploadfile'];
if (strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) != 'xlsx') {
	selesai(false, 'Format file harus .xlsx');
}
if ($file['size'] > 5 * 1024 * 1024) {
	selesai(false, 'Ukuran file maksimal 5 MB.');
}

try {
	if (\PhpOffice\PhpSpreadsheet\IOFactory::identify($file['tmp_name']) != 'Xlsx') {
		selesai(false, 'Format file harus .xlsx');
	}
	$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	$spreadsheet = $reader->load($file['tmp_name']);
} catch (Exception $e) {
	selesai(false, 'File excel tidak bisa dibaca.');
}

// ===== Cek template =====
$salahTemplate = 'File tidak sesuai template. Silakan download template upload material dan gunakan file tersebut.';
$props = $spreadsheet->getProperties();
$sheet = $spreadsheet->getSheetByName('Material');
if ($props->getKeywords() != TEMPLATE_MATERIAL_KEY || !$sheet || !$spreadsheet->getSheetByName('List')) {
	selesai(false, $salahTemplate);
}
if ($props->isCustomPropertySet('ordpk') && (int) $props->getCustomPropertyValue('ordpk') != $ord) {
	selesai(false, 'Template ini didownload dari order lain. Silakan download template dari order ' . trim($dtord['ordno']) . '.');
}

$keys = array_keys($template_material_cols);
$jmlCol = count($keys);
foreach ($keys as $i => $key) {
	$letter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i + 1);
	if (trim($sheet->getCell($letter . '1')->getValue()) != template_material_header($template_material_cols[$key])) {
		selesai(false, $salahTemplate);
	}
}
$letterNext = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($jmlCol + 1);
if (trim($sheet->getCell($letterNext . '1')->getValue()) != '') {
	selesai(false, $salahTemplate);
}

// ===== Data master untuk validasi =====
$mtype = array();
$rs = mysqli_query($koneksi, "select mtypepk, typenm, mgroup, mcode from mtype");
while ($r = mysqli_fetch_array($rs)) $mtype[strtoupper(trim($r['typenm']))] = $r;

$sup = array();
$rs = mysqli_query($koneksi, "select min(suppk) as suppk, TRIM(supnm) as supnm FROM sup
	where supnm<>'' and supnm<>'.' and local>'0' and aktif='0' group by TRIM(supnm)");
while ($r = mysqli_fetch_array($rs)) $sup[strtoupper($r['supnm'])] = $r;
$supExternal = mysqli_fetch_array(mysqli_query($koneksi, "select suppk, supnm from sup where suppk='1949'"));

$units = array();
$rs = mysqli_query($koneksi, "select unit from munit");
while ($r = mysqli_fetch_array($rs)) $units[strtoupper(trim($r['unit']))] = trim($r['unit']);

$curs = array();
$rs = mysqli_query($koneksi, "select curpk, curid from cur");
while ($r = mysqli_fetch_array($rs)) $curs[strtoupper(trim($r['curid']))] = $r['curpk'];

$usages = array();
foreach (array("Shell", "Lining", "Pocketing", "Interlining", "Filler", "Piping") as $u) {
	for ($i = 1; $i <= 10; $i++) $usages[strtoupper($u . $i)] = $u . $i;
}

$colors = array('ALL COLOR' => 'ALL COLOR');
$rs = mysqli_query($koneksi, "SELECT DISTINCT color FROM bdown WHERE ordpk='$ord' AND color IS NOT NULL AND color<>''");
while ($r = mysqli_fetch_array($rs)) {
	$c = trim($r['color']);
	if ($c != "") $colors[strtoupper($c)] = $c;
}
$rs = mysqli_query($koneksi, "SELECT itemadd FROM rkb WHERE ordpk='$ord' AND itemadd IS NOT NULL AND itemadd<>''");
while ($r = mysqli_fetch_array($rs)) {
	foreach (explode(',', $r['itemadd']) as $c) {
		$c = trim($c);
		if ($c != "") $colors[strtoupper($c)] = $c;
	}
}

// ===== Baca & validasi tiap baris =====
$rows = array();
$errors = array();
$highestRow = $sheet->getHighestDataRow();

for ($r = 2; $r <= $highestRow; $r++) {
	$d = array();
	$kosong = true;
	foreach ($keys as $i => $key) {
		$letter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i + 1);
		$v = $sheet->getCell($letter . $r)->getCalculatedValue();
		$v = is_null($v) ? '' : trim((string) $v);
		if ($v !== '') $kosong = false;
		$d[$key] = $v;
	}
	if ($kosong) continue;

	$err = array();
	$ext = strtoupper($d['external']) == 'YES';

	// wajib diisi (supplier tidak wajib bila External sourcing = YES)
	foreach ($template_material_cols as $key => $col) {
		if ($col[1] && $d[$key] === '' && !($key == 'supplier' && $ext)) {
			$err[] = $col[0] . ' wajib diisi';
		}
	}

	// angka
	foreach ($template_material_cols as $key => $col) {
		if ($d[$key] === '') continue;
		if ($col[4] == 'number' && !is_numeric($d[$key])) {
			$err[] = $col[0] . ' harus berupa angka';
		} else if ($col[4] == 'int' && !preg_match('/^\d+$/', $d[$key])) {
			$err[] = $col[0] . ' harus berupa bilangan bulat';
		} else if (in_array($col[4], array('number', 'int')) && $d[$key] < 0) {
			$err[] = $col[0] . ' tidak boleh minus';
		}
	}

	// pilihan dari list
	$m = null;
	if ($d['mtype'] !== '') {
		$m = $mtype[strtoupper($d['mtype'])];
		if (!$m) $err[] = 'Item Category "' . $d['mtype'] . '" tidak ditemukan';
	}
	$s = null;
	if ($ext) {
		$s = $supExternal;
	} else if ($d['supplier'] !== '') {
		$s = $sup[strtoupper($d['supplier'])];
		if (!$s) $err[] = 'Supplier "' . $d['supplier'] . '" tidak ditemukan';
	}
	if ($d['external'] !== '' && !in_array(strtoupper($d['external']), array('YES', 'NO'))) {
		$err[] = 'External sourcing harus YES atau NO';
	}
	if ($d['unit'] !== '') {
		if (!isset($units[strtoupper($d['unit'])])) {
			$err[] = 'Consumption unit "' . $d['unit'] . '" tidak ditemukan';
		} else {
			$d['unit'] = $units[strtoupper($d['unit'])];
		}
	}
	$curpk = '';
	if ($d['curpk'] !== '') {
		if (!isset($curs[strtoupper($d['curpk'])])) {
			$err[] = 'Currency "' . $d['curpk'] . '" tidak ditemukan';
		} else {
			$curpk = $curs[strtoupper($d['curpk'])];
		}
	}

	// usage, cuttable width, gramasi hanya untuk kategori group CUTTING (sama seperti form)
	$isFabric = $m && $m['mgroup'] == 1;
	if (!$isFabric) {
		$d['usage'] = '';
		$d['cw'] = '';
		$d['gsm'] = '';
	} else if ($d['usage'] !== '') {
		if (!isset($usages[strtoupper($d['usage'])])) {
			$err[] = 'Usage "' . $d['usage'] . '" tidak ditemukan';
		} else {
			$d['usage'] = $usages[strtoupper($d['usage'])];
		}
	}

	// garment colorway boleh lebih dari satu, dipisah koma
	$itemadd = array();
	if ($d['itemadd'] !== '') {
		foreach (explode(',', $d['itemadd']) as $c) {
			$c = trim($c);
			if ($c === '') continue;
			if (!isset($colors[strtoupper($c)])) {
				$err[] = 'Garment colorway "' . $c . '" tidak ada di order ini';
			} else {
				$itemadd[] = $colors[strtoupper($c)];
			}
		}
	}
	$d['itemadd'] = implode(', ', array_unique($itemadd));

	// formula: operator (+ - * /) diikuti angka, contoh /100 atau +5
	foreach (array('f1', 'f2') as $f) {
		if ($d[$f] === '') continue;
		if (is_numeric($d[$f]) && preg_match('/^\d/', $d[$f])) {
			$d[$f] = '+' . $d[$f]; // Excel menyimpan "+5" sebagai angka 5
		}
		if (!preg_match('/^[\+\-\*\/]\d+(\.\d+)?$/', $d[$f]) || strlen($d[$f]) > 10) {
			$err[] = $template_material_cols[$f][0] . ' harus diawali + - * / lalu angka (contoh: /100), maks 10 karakter';
		}
	}

	// detail breakdown spesifikasi (checkbox "Add more detail breakdown" di form)
	$adaDetail = false;
	for ($i = 1; $i <= 8; $i++) {
		if ($d['hspec' . $i] !== '' || $d['spec' . $i] !== '') $adaDetail = true;
	}
	if ($d['tspec'] !== '' && !in_array(strtoupper($d['tspec']), array('YES', 'NO'))) {
		$err[] = 'Add more detail breakdown harus YES atau NO';
	}
	if (strtoupper($d['tspec']) == 'YES') {
		$d['tspec'] = 2;
		// sama dengan multi1(): item zipper otomatis isi header 1-6 bila kosong
		if (preg_match('/Zipper|ZIPPER|zipper/', $d['item'])) {
			foreach (array('TAPE', 'TEETH', 'SLIDER', 'PULLER', 'STOPPER', 'SIZE/LENGTH') as $i => $h) {
				if ($d['hspec' . ($i + 1)] === '') $d['hspec' . ($i + 1)] = $h;
			}
		}
		for ($i = 1; $i <= 8; $i++) {
			if (strlen($d['hspec' . $i]) > 50) $err[] = 'Spec Header ' . $i . ' maksimal 50 karakter';
			if (strlen($d['spec' . $i]) > 250) $err[] = 'Spec Value ' . $i . ' maksimal 250 karakter';
		}
	} else {
		if ($adaDetail) {
			$err[] = 'Spec Header/Value terisi, isi YES pada Add more detail breakdown atau kosongkan Spec Header/Value';
		}
		$d['tspec'] = 1;
	}

	if (strlen($d['item']) > 200) $err[] = 'Item Name maksimal 200 karakter';
	if (strlen($d['colname']) > 200) $err[] = 'Color Name maksimal 200 karakter';
	if (strlen($d['colcode']) > 100) $err[] = 'Color Code maksimal 100 karakter';
	if (strlen($d['sizegar']) > 50) $err[] = 'Item size maksimal 50 karakter';

	if (!$err) {
		// ===== Perhitungan, sama dengan myFunction2b() di form =====
		$bdownqty = (int) $d['bdownqty'];
		$negocons = (float) $d['negocons'];
		$estcons = (float) $d['estcons'];
		$allowcons = (float) $d['allowcons'];
		$allowman = (float) $d['allowman'];
		$qrs = (int) $d['qrs'];
		$price = (float) $d['price'];

		if ($estcons > $negocons) {
			$err[] = 'Purchasing consumption tidak boleh lebih besar dari costing';
		}

		$netto = $bdownqty * $estcons;
		$budgetNetto = $bdownqty * $negocons;
		if ($d['f1'] !== '') {
			$totcons = hitung_rumus($netto, $d['f1'], $d['f2']);
			$budget = hitung_rumus($budgetNetto, $d['f1'], $d['f2']);
		} else {
			$totcons = $netto;
			$budget = $budgetNetto;
		}
		$z = round($totcons + ($totcons * $allowcons / 100) + $qrs + $allowman, 2);
		$zBudget = $budget + ($budget * $allowcons / 100) + $qrs + $allowman;
		$pocons = ceil($z) > 0 ? ceil($z) : $z;

		if ((ceil($zBudget) * $price) - (ceil($z) * $price) < 0) {
			$err[] = 'Total Cost Order melebihi Total Budget';
		}

		$d['totcons'] = $totcons;
		$d['varcons'] = $estcons - $negocons;
		$d['pocons'] = $pocons;
		$d['curpk2'] = $curpk;
		$d['m'] = $m;
		$d['s'] = $s;
	}

	if ($err) {
		$errors[] = 'Baris ' . $r . ': ' . implode(', ', $err);
	} else {
		$rows[] = $d;
	}
}

if ($errors) {
	selesai(false, 'Data belum disimpan, perbaiki ' . count($errors) . ' baris berikut lalu upload ulang:', $errors);
}
if (!$rows) {
	selesai(false, 'Tidak ada data material di file.');
}

// ===== Simpan (semua baris atau tidak sama sekali) =====
mysqli_begin_transaction($koneksi);
try {
	$dtnour = mysqli_fetch_array(mysqli_query($koneksi, "SELECT nour FROM rkb WHERE ordpk='$ord' order by nour desc limit 1"));
	$nour = (int) $dtnour['nour'];
	$kel = array(1 => array('CUTTING', 'C'), 2 => array('SEWING', 'S'), 3 => array('FINISHING/PACKING', 'F'), 4 => array('JASA', 'J'));

	foreach ($rows as $d) {
		$nour++;
		$m = $d['m'];
		$kelnm = $kel[$m['mgroup']][0];
		$kelcode = $kel[$m['mgroup']][1];
		$item = $d['item'];

		// itemcode
		$kata_pertama = explode(' ', $item)[0];
		$itemcode = $kelcode . "-" . $m['mcode'] . "-" . $kata_pertama;
		$dtitem = mysqli_fetch_array(mysqli_query($koneksi, "select codepk from itemcode where codenm='" . esc($itemcode) . "'"));
		if ($dtitem['codepk'] > 0) {
			$q = mysqli_query($koneksi, "update itemcode set itemnm='" . esc($item) . "' where codepk='$dtitem[codepk]'");
		} else {
			$q = mysqli_query($koneksi, "insert into itemcode set codenm='" . esc($itemcode) . "', itemnm='" . esc($item) . "'");
		}
		if (!$q) throw new Exception(mysqli_error($koneksi));

		$sts = $d['pocons'] > 0 ? 2 : 1;

		// tanpa detail breakdown header/value dikosongkan, sama seperti form
		$detailSql = "";
		for ($i = 1; $i <= 8; $i++) {
			$h = $d['tspec'] == 2 ? esc($d['hspec' . $i]) : '';
			$v = $d['tspec'] == 2 ? esc($d['spec' . $i]) : '';
			$detailSql .= "hspec$i='$h', spec$i='$v', ";
		}

		$q = mysqli_query($koneksi, "insert into rkb set
			$detailSql
			ordpk='$ord',
			matusage='" . esc($d['usage']) . "',
			nour='$nour',
			kelnm='$kelnm',
			mtypepk='$m[mtypepk]',
			codenm='" . esc($itemcode) . "',
			item='" . esc($item) . "',
			itemadd='" . esc($d['itemadd']) . "',
			suppk='" . $d['s']['suppk'] . "',
			sup='" . esc($d['s']['supnm']) . "',
			tspec='" . $d['tspec'] . "',
			spec='" . esc($d['spec']) . "',
			specadd='" . esc($d['specadd']) . "',
			colname='" . esc($d['colname']) . "',
			colcode='" . esc($d['colcode']) . "',
			sizegar='" . esc($d['sizegar']) . "',
			cw='" . esc($d['cw']) . "',
			gsm='" . esc($d['gsm']) . "',
			unit='" . esc($d['unit']) . "',
			price='" . (float) $d['price'] . "',
			curpk='" . $d['curpk2'] . "',
			bdownqty='" . (int) $d['bdownqty'] . "',
			allowcons='" . (float) $d['allowcons'] . "',
			allowman='" . (float) $d['allowman'] . "',
			negocons='" . (float) $d['negocons'] . "',
			estcons='" . (float) $d['estcons'] . "',
			varcons='" . $d['varcons'] . "',
			totcons='" . $d['totcons'] . "',
			qrs='" . (int) $d['qrs'] . "',
			pocons='" . $d['pocons'] . "',
			status='$sts',
			hari1=NOW(),
			hari2='$next',
			f1='" . esc($d['f1']) . "',
			f2='" . esc($d['f2']) . "'");
		if (!$q) throw new Exception(mysqli_error($koneksi));

		$lognote = esc("User " . $userlog . " tambah data material " . $item . " order " . $dtord['ordno'] . " (import excel)");
		$q = mysqli_query($koneksi, "insert into logtran set
			logdtime=NOW(),
			logdate=NOW(),
			logtime=NOW(),
			logip='$ip',
			lognote='$lognote',
			ordpk='$ord',
			sistem='$sistem'");
		if (!$q) throw new Exception(mysqli_error($koneksi));
	}

	mysqli_commit($koneksi);
} catch (Exception $e) {
	mysqli_rollback($koneksi);
	selesai(false, 'Gagal menyimpan data: ' . $e->getMessage());
}

selesai(true, count($rows) . ' material berhasil diimport');
