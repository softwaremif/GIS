<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/koneksi11s.php";
include "../config/tanggal.php";
include "../config/tanggal2.php";
$thn = DATE('Y');
$thnb = $thn - 2000;
$thn2 = $thn - 2;
$thn2b = $thn2 - 2000;
$thn2c = $thn - 1;

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$cari6 = isset($_POST['cari6']) ? ($_POST['cari6']) : false;
$cari7 = isset($_POST['cari7']) ? ($_POST['cari7']) : false;
$cari8 = isset($_POST['cari8']) ? ($_POST['cari8']) : false;
$cari9 = isset($_POST['cari9']) ? ($_POST['cari9']) : false;
$cari10 = isset($_POST['cari10']) ? ($_POST['cari10']) : false;
$cari11 = isset($_POST['cari11']) ? ($_POST['cari11']) : false;
$cari12 = isset($_POST['cari12']) ? ($_POST['cari12']) : false;
$cari13 = isset($_POST['cari13']) ? ($_POST['cari13']) : false;
$cari14 = isset($_POST['cari14']) ? ($_POST['cari14']) : false;
$carim = isset($_POST['carim']) ? ($_POST['carim']) : false;
$crkel = isset($_POST['crkel']) ? ($_POST['crkel']) : false;
$ord = isset($_GET['ord']) ? ($_GET['ord']) : false;

$cari10a = TRIM($cari10);

if ($cari6) {
	$and6 = "and kolomnm like '%$cari6%'";
}
if ($cari7) {
	$and7 = "and concat(rkb.colcode,rkb.colname) like '%$cari7%'";
}
if ($cari8) {
	$and8 = "and concat(rkb.item,rkb.spec) like '%$cari8%'";
}
if ($cari11) {
	$and11 = "and concat(po.pono,sup.supnm,po.brg) like '%$cari11%'";
	$and11b = "and concat(ord.ordno,byr.byrnm,ord.artno,ord.prodes) like '%$cari11%'";
}
if ($cari12) {
	$and12 = "and concat(ord.artno,ord.ordno,byr.byrnm,ord.prodes) like '%$cari12%'";
	$and12b = "and ord.ordpk='$cari12'";
}
if ($cari13) {
	$and13 = "and concat(rkb.item,sup.supnm,rkb.spec,rkb.colname) like '%$cari13%'";
}
if ($cari14) {
	$and14 = "and byr.byrpk='$cari14'";
}

if ($carim) {
	$andm = "and concat(po.pono,byr.byrnm,fu.funm,po.brg) like '%$carim%'";
}

if ($crkel) {
	$andkel = "and podt.kelnm like '%$crkel%'";
}

$offset = ($page - 1) * $rows;

if ($_SESSION['mat'] == 1) {
	$and3 = "and rpo.kelnm='CUTTING'";
} else {
	$and3 = "and rpo.kelnm<>'CUTTING'";
}

if ($_SESSION['spv'] == 1) {
	$and = "and user.userpk<>'$_SESSION[user]'";
} else {
	$and = "and user.userpk='$_SESSION[user]'";
}

if ($_GET['dt'] == "user") {
	$rs = mysqli_query($koneksi, "SELECT user.userpk, CONCAT(UPPER(SUBSTRING(user.login,1,1)),LOWER(SUBSTRING(user.login,2))) as login FROM user
left outer join fu on fu.fupk=user.fupk
WHERE  user.username<>'' and user.datechange is not null and user.guserpk between '2' and '3'
ORDER BY user.login asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "md") {
	$rs = mysqli_query($koneksi, "select userpk, login from (
select filterpk as userpk, filternm as login from filter 
union
SELECT user.userpk, CONCAT(UPPER(SUBSTRING(user.login,1,1)),LOWER(SUBSTRING(user.login,2))) as login 
FROM user
left outer join fu on fu.fupk=user.fupk
WHERE user.fupk='$_SESSION[fu]' $and) as login
ORDER BY login asc");
	// $rs = mysqli_query($koneksi,"SELECT user.userpk, CONCAT(UPPER(SUBSTRING(user.login,1,1)),LOWER(SUBSTRING(user.login,2))) as login 
	// FROM user
	// left outer join fu on fu.fupk=user.fupk
	// WHERE user.fupk='$_SESSION[fu]' $and
	// ORDER BY user.login asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "fu1") {
	$rs = mysqli_query($koneksi, "SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
left outer join fu on fu.fupk=ord.fupk
WHERE rpo.stspk='1' $and3
group by fu.fupk ORDER BY fu.funm asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "fu2") {
	$rs = mysqli_query($koneksi, "SELECT * FROM po
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
WHERE po.pur='$_SESSION[login]' and po.postatpk>='1' and rkb.status>='3'
group by fu.fupk ORDER BY fu.funm asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "fu3") {
	$rs = mysqli_query($koneksi, "SELECT * FROM po
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
WHERE po.pur='$_SESSION[login]' and po.postatpk='4' and rkb.status='6'
group by fu.fupk ORDER BY fu.funm asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "fu") {
	if ($_SESSION['leader'] > 0) {
		if($_SESSION['login']=="anggia"){
		$lead="and fu.team in (1,2)";
		} else {
		$lead="and fu.team='$_SESSION[leader]'";	
		}
	}
	$rs = mysqli_query($koneksi, "select fupk,funm from (
		select filterpk as fupk, filternm as funm from filter
		union
		select fupk, funm FROM fu where aktif='0' $lead) as fu
		order by fupk asc, funm asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "ord") {
	if ($_SESSION['spv'] == 1) {
		$andord = "";
	} else {
		$andord = "and ord.userpk='$_SESSION[user]'";
	}

	$rs = mysqli_query($koneksi, "select ord.ordpk, ord.ordno, byr.byrnm, ord.prodes, ord.artno
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.fupk='$_SESSION[fu]' and ord.byrpk>0 and YEAR(ord.datecreate)>='$thn2' $and11b $and14 $andord
order by ord.ordpk desc LIMIT $rows OFFSET $offset");

	$result = array();
	$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "select ord.ordpk, ord.ordno, byr.byrnm, ord.prodes, ord.artno
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.fupk='$_SESSION[fu]' and ord.byrpk>0 and YEAR(ord.datecreate)>='$thn2' $and11b $and14 $andord"));

	$row = array();
	while ($data = mysqli_fetch_array($rs)) {
		$btn2 = '<a href="#" style="text-decoration:none; color:#359DD9;">Select</a>';

		$row[] = array(
			'act' => $btn2,
			'ordpk' => $data['ordpk'],
			'artno' => $data['artno'],
			'ordno' => $data['ordno'],
			'byrnm' => $data['byrnm'],
			'prodes' => $data['prodes']
		);
	}
	$result = array_merge($result, array('rows' => $row));
	echo json_encode($result);
}
if ($_GET['dt'] == "ord2") {
	$rs = mysqli_query($koneksi, "select ord.ordpk, ord.ordno, byr.byrnm, ord.prodes, ord.artno
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.fupk='$_SESSION[fu]' and ord.byrpk>0 and YEAR(ord.datecreate)>='$thn2' $and12
order by ord.ordpk desc LIMIT $rows OFFSET $offset");

	$result = array();
	$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "select ord.ordpk, ord.ordno, byr.byrnm, ord.prodes, ord.artno
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.fupk='$_SESSION[fu]' and ord.byrpk>0 and YEAR(ord.datecreate)>='$thn2' $and12"));

	$row = array();
	while ($data = mysqli_fetch_array($rs)) {
		$btn2 = '<a href="#" style="text-decoration:none; color:#359DD9;">Select</a>';

		$row[] = array(
			'act' => $btn2,
			'ordpk' => $data['ordpk'],
			'artno' => $data['artno'],
			'byrnm' => $data['byrnm'],
			'ordno' => $data['ordno'],
			'prodes' => $data['prodes']
		);
	}
	$result = array_merge($result, array('rows' => $row));
	echo json_encode($result);
}
if ($_GET['dt'] == "mat") {
	$rs = mysqli_query($koneksi, "select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$cari12' and substring(ord.ordno, 1,2)>='$thn2b' $and13
order by rkb.rkbpk asc LIMIT $rows OFFSET $offset");

	$result = array();
	$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$cari12' and substring(ord.ordno, 1,2)>='$thn2b' $and13"));

	$row = array();
	while ($data = mysqli_fetch_array($rs)) {
		$qty = number_format($data['bdownqty'], 0, ".", ",");
		$spec = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec']);
		$specadd = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['specadd']);
		$size = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['sizegar']);

		$row[] = array(
			'ordpk' => $data['ordpk'],
			'rkbpk' => $data['rkbpk'],
			'item' => $data['item'],
			'supnm' => $data['supnm'],
			'spec' => $spec,
			'specadd' => $specadd,
			'qty' => $qty,
			'unit' => $data['unit'],
			'colname' => $data['colname'],
			'colcode' => $data['colcode'],
			'sizegar' => $size
		);
	}
	$result = array_merge($result, array('rows' => $row));
	echo json_encode($result);
}
if ($_GET['dt'] == "qty") {
	$rs = mysqli_query($koneksi, "select TRIM(bdown.country) as country FROM bdown
left outer join ord on ord.ordpk=bdown.ordpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and bdown.jenis<>'FOOTER'
and bdown.country is not null and bdown.country<>''
group by bdown.country order by bdown.country asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "qtyb") {
	$rs = mysqli_query($koneksi, "select TRIM(bdown.country) as country FROM bdown
left outer join ord on ord.ordpk=bdown.ordpk
where ord.ordpk='$ord' and bdown.jenis<>'FOOTER'
and bdown.country is not null and bdown.country<>''
group by bdown.country order by bdown.country asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "qty2") {
	$rs = mysqli_query($koneksi, "select TRIM(bdown.color) as color FROM bdown
left outer join ord on ord.ordpk=bdown.ordpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and bdown.jenis<>'FOOTER'
and bdown.color is not null and bdown.color<>''
group by bdown.color order by bdown.color asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "qty2b") {
	$rs = mysqli_query($koneksi, "select TRIM(bdown.color) as color FROM bdown
left outer join ord on ord.ordpk=bdown.ordpk
where ord.ordpk='$ord' and bdown.jenis<>'FOOTER'
and bdown.color is not null and bdown.color<>''
group by bdown.color order by bdown.color asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}

if ($_GET['dt'] == "qty3") {
	$rs = mysqli_query($koneksi, "select TRIM(bdown.secsz) as secsz FROM bdown
left outer join ord on ord.ordpk=bdown.ordpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and bdown.jenis<>'FOOTER'
and bdown.secsz is not null and bdown.secsz<>''
group by bdown.secsz order by bdown.secsz asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "qty3b") {
	$rs = mysqli_query($koneksi, "select TRIM(bdown.secsz) as secsz FROM bdown
left outer join ord on ord.ordpk=bdown.ordpk
where ord.ordpk='$ord' and bdown.jenis<>'FOOTER'
and bdown.secsz is not null and bdown.secsz<>''
group by bdown.secsz order by bdown.secsz asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "byr") {
	// $rs = mysqli_query($koneksi,"select filterpk as byrpk, filternm as byrnm, (0) as season from filter 
	// union
	// select byr.byrpk, byr.byrnm, ord.season
	// FROM ord
	// left outer join byr on byr.byrpk=ord.byrpk
	// left outer join fu on fu.fupk=ord.fupk
	// where ord.fupk='$_SESSION[fu]' and ord.byrpk>0 and substring(ord.ordno, 1,2)>='$thn2b'
	// group by byr.byrpk
	// order by byrnm asc");
	if ($_GET['thn'] > 0) {
		$fthn = "and YEAR(ord.datecreate)='$_GET[thn]'";
	} else {
		$fthn = "and YEAR(ord.datecreate)='$thn'";
	}

	if ($_GET['fupk'] > 0) {
		$ffupk = "and ord.fupk='$_GET[fupk]'";
	}

	if ($_GET['md'] > 0) {
		$andmd = "and ord.userpk='$_GET[md]'";
	} else {
		$andmd = "";
	}

	if ($_SESSION['leader'] > 0) {
		$rs = mysqli_query($koneksi, "select byrpk, byrnm from (
select filterpk as byrpk, filternm as byrnm from filter
union 
select byr.byrpk, byr.byrnm
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where fu.team='$_SESSION[leader]' and ord.byrpk>0 $fthn $ffupk) as byr
group by byrpk
order by byrnm asc");
	} else {
		if ($_SESSION['fu'] > 0) {
			$rs = mysqli_query($koneksi, "select byrpk, byrnm from (
select filterpk as byrpk, filternm as byrnm from filter
union 
select byr.byrpk, byr.byrnm
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.fupk='$_SESSION[fu]' and ord.byrpk>0 $fthn $andmd) as byr
group by byr.byrpk
order by byrnm asc");
		} else {
			$rs = mysqli_query($koneksi, "select byrpk, byrnm from (
select filterpk as byrpk, filternm as byrnm from filter
union 
select byr.byrpk, byr.byrnm
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.byrpk>0 $fthn $ffupk $andmd) as byr
group by byr.byrpk
order by byrnm asc");
		}
	}
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "byr2") {
	if ($_GET['thn'] > 0) {
		$fthn = "and YEAR(ord.datecreate)='$_GET[thn]'";
	} else {
		if ($_GET['e'] == 1) {
			$fthn = "";
		} else {
			$fthn = "and YEAR(ord.datecreate)='$thn'";
		}
	}

	if ($_GET['fupk'] > 0) {
		$ffupk = "and ord.fupk='$_GET[fupk]'";
	}

	if ($_GET['md'] > 0) {
		$andmd = "and ord.fupk='$_GET[md]'";
	} else {
		$andmd = "";
	}

	if ($_SESSION['leader'] > 0) {
		if($_SESSION['login']=="anggia"){
		$lead="and fu.team in (1,2)";
		} else {
		$lead="and fu.team='$_SESSION[leader]'";	
		}
		// $rs = mysqli_query($koneksi, "select byrpk, byrnm from (
		// 	select filterpk as byrpk, filternm as byrnm from filter
		// 	union 
		// 	select byr.byrpk, byr.byrnm
		// 	FROM ord
		// 	left outer join byr on byr.byrpk=ord.byrpk
		// 	left outer join fu on fu.fupk=ord.fupk
		// 	where ord.byrpk>0 $fthn $andmd $lead) as byr
		// 	group by byrpk
		// 	order by byrpk asc, byrnm asc");

		$rs = mysqli_query($koneksi, "
			select byr.byrpk, byr.byrnm
			FROM ord
			left outer join byr on byr.byrpk=ord.byrpk
			left outer join fu on fu.fupk=ord.fupk
			where ord.byrpk>0 $fthn $andmd $lead
			group by byrpk
			order by byrnm asc");
	} else {
		if ($_GET['e'] == 1) {
			$rs = mysqli_query($koneksi, "select byrpk, byrnm from byr order by byrnm asc");
		} else {
			$rs = mysqli_query($koneksi, "select byrpk, byrnm from (
				select filterpk as byrpk, filternm as byrnm from filter
				union 
				select byr.byrpk, byr.byrnm
				FROM ord
				left outer join byr on byr.byrpk=ord.byrpk
				left outer join fu on fu.fupk=ord.fupk
				where ord.byrpk>0 $fthn $andmd) as byr
				group by byr.byrpk
				order by byrnm asc");
		}
	}
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "season") {
	if ($_GET['thn'] > 0) {
		$fthn = "and YEAR(ord.datecreate)='$_GET[thn]'";
	} else {
		$fthn = "and YEAR(ord.datecreate)='$thn'";
	}

	if ($_GET['md'] > 0) {
		$andmd = "and ord.userpk='$_GET[md]'";
	} else {
		$andmd = "";
	}

	if ($_GET['byr'] > 0) {
		$andbyr = "and ord.byrpk='$_GET[byr]'";
	} else {
		$andbyr = "";
	}

	$rs = mysqli_query($koneksi, "select RTRIM(ord.season) as season
		FROM ord
		left outer join byr on byr.byrpk=ord.byrpk
		left outer join fu on fu.fupk=ord.fupk
		where ord.fupk='$_SESSION[fu]' and ord.season<>'' $fthn $andmd $andbyr
		group by ord.season order by ord.season asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "season2") {
	if ($_SESSION['leader'] > 0) {
		$lead = "and fu.team='$_SESSION[leader]'";
	}

	if ($_GET['thn'] > 0) {
		$fthn = "and YEAR(ord.datecreate)='$_GET[thn]'";
	} else {
		$fthn = "and YEAR(ord.datecreate)='$thn'";
	}

	if ($_GET['md'] > 0) {
		$andmd = "and ord.fupk='$_GET[md]'";
	} else {
		$andmd = "";
	}

	if ($_GET['byr'] > 0) {
		$andbyr = "and ord.byrpk='$_GET[byr]'";
	} else {
		$andbyr = "";
	}

	$rs = mysqli_query($koneksi, "select seasonpk, season from (
		select filterpk as seasonpk, filternm as season from filter
		union 
		select (1) as seasonpk, RTRIM(ord.season) as season
		FROM ord
		left outer join byr on byr.byrpk=ord.byrpk
		left outer join fu on fu.fupk=ord.fupk
		where ord.season<>'' and ord.byrpk>0 $fthn $lead $andmd $andbyr
		group by ord.season) as season
		order by seasonpk asc, season asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "supplier") {
	$rs = mysqli_query($koneksi, "select suppk, supnm from(
select filterpk as suppk, filternm as supnm from filter
union
select sup.suppk, TRIM(sup.supnm) as supnm
FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and sup.supnm<>'' and sup.local>0 and sup.aktif='0') as sup
group by TRIM(supnm) 
order by supnm asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "supplier2") {
	$rs = mysqli_query($koneksi, "select suppk, supnm from(
select filterpk as suppk, filternm as supnm from filter
union
select sup.suppk, TRIM(sup.supnm) as supnm
FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
where ord.ordpk='$ord' and sup.supnm<>'' and sup.local>0 and sup.aktif='0') as sup
group by TRIM(supnm)
order by supnm asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "sup") {
	$rs = mysqli_query($koneksi, "select suppk, TRIM(supnm) as supnm
FROM sup
where supnm<>'' and supnm<>'.' and local>'0' and aktif='0'
group by TRIM(supnm) order by supnm asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "suppwh") {
	$rs = mysqli_query($koneksi, "select suppk, TRIM(supnm) as supnm
FROM sup
where supnm<>'' and supnm<>'.' and supnm='STOCK MORICH'
group by TRIM(supnm) order by supnm asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "cur") {
	$rs = mysqli_query($koneksi, "select curpk, curid from cur order by curid asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "color") {
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'rkb.colcode';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
	$rs = mysqli_query($koneksi, "select rkb.colname, rkb.colcode, rkb.spec, rkb.item from rkb
left outer join ord on ord.ordpk=rkb.ordpk
where ord.fupk='$_SESSION[fu]' and rkb.colname<>'' and rkb.colcode<>'' and substring(ord.ordno, 1,2)>='$thn2b' $and7
group by rkb.colname
ORDER BY $sort $order
LIMIT $rows OFFSET $offset");
	$result = array();
	$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "select rkb.colname, rkb.colcode, rkb.spec, rkb.item from rkb
left outer join ord on ord.ordpk=rkb.ordpk
where ord.fupk='$_SESSION[fu]' and rkb.colname<>'' and rkb.colcode<>'' and substring(ord.ordno, 1,2)>='$thn2b' $and7
group by rkb.colname"));
	$row = array();
	$k = $offset;
	while ($data = mysqli_fetch_array($rs)) {
		$k++;
		$btn = '<a href="#" style="color:#359DD9; text-decoration:none;">GET</a>';
		$specb = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec']);
		$spec = TRIM($specb);
		$row[] = array(
			'no' => $k,
			'colname' => $data['colname'],
			'colcode' => $data['colcode'],
			'item' => $data['item'],
			'spec' => $spec,
			'action' => $btn
		);
	}
	$result = array_merge($result, array('rows' => $row));
	echo json_encode($result);
}
// if ($_GET['dt'] == "mb") {
// if($_GET['input']<>""){ $anditem="and rkb.item='$_GET[input]'"; }
// 	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'rkb.item';
// 	$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
// 	$rs = mysqli_query($koneksi, "select rkb.colname, rkb.colcode, rkb.spec, rkb.item from rkb
// 			left outer join ord on ord.ordpk=rkb.ordpk
// 			where ord.fupk='$_SESSION[fu]' and rkb.colname<>'' and rkb.colcode<>'' and substring(ord.ordno, 1,2)>='$thn2b' $and8 $anditem
// 			group by rkb.item
// 			ORDER BY $sort $order
// 			LIMIT $rows OFFSET $offset");
// 	$result = array();
// 	$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "select rkb.colname, rkb.colcode, rkb.spec, rkb.item from rkb
// 			left outer join ord on ord.ordpk=rkb.ordpk
// 			where ord.fupk='$_SESSION[fu]' and rkb.colname<>'' and rkb.colcode<>'' and substring(ord.ordno, 1,2)>='$thn2b' $and8 $anditem
// 			group by rkb.item"));
// 	$row = array();
// 	$k = $offset;
// 	while ($data = mysqli_fetch_array($rs)) {
// 		$k++;
// 		$btn = '<a href="#" style="color:#359DD9; text-decoration:none;">GET</a>';
// 		$specb = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec']);
// 		$spec = TRIM($specb);
// 		$row[] = array(
// 			'no' => $k,
// 			'colname' => $data['colname'],
// 			'colcode' => $data['colcode'],
// 			'item' => $data['item'],
// 			'spec' => $spec,
// 			'action' => $btn
// 		);
// 	}
// 	$result = array_merge($result, array('rows' => $row));
// 	echo json_encode($result);
// }
if ($_GET['dt'] == "mb") {
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $rows = isset($_POST['rows']) ? (int)$_POST['rows'] : 100;
    $offset = ($page - 1) * $rows;

    $sort = isset($_POST['sort']) ? mysqli_real_escape_string($koneksi, $_POST['sort']) : 'podt.colcode';
    $order = isset($_POST['order']) ? mysqli_real_escape_string($koneksi, $_POST['order']) : 'ASC';

    $thn2b = (date('Y') - 2) - 2000; 

    $fu = $_SESSION['fu']; 
    $cari = isset($_REQUEST['cariMaterial']) ? mysqli_real_escape_string($koneksi, $_REQUEST['cariMaterial']) : '';
    
    $and8 = "";
    if ($cari != "") {
        $and8 = " AND concat(podt.item, podt.spec) LIKE '%$cari%' ";
    }

    $anditem = "";
    if (isset($_GET['input']) && $_GET['input'] <> "") { 
        $anditem = " AND podt.item = '" . mysqli_real_escape_string($koneksi, $_GET['input']) . "'"; 
    }

    $whereClause = " WHERE ord.fupk = '$fu' 
                     AND podt.colname <> '' 
                     AND podt.colcode <> '' 
                     AND podt.item <> '' 
                     AND YEAR(po.tglpo) >= '$thn2b' 
                     $and8 $anditem";

    $sqlFrom = " FROM podt
                 LEFT JOIN po ON po.popk = podt.popk
                 LEFT JOIN ord ON ord.ordpk = podt.ordpk 
                 $whereClause ";

    $sqlTotal = "SELECT COUNT(*) as jml FROM (SELECT podt.item $sqlFrom GROUP BY podt.item) as t";
    $resTotal = mysqli_query($koneksi, $sqlTotal);
    $rowTotal = mysqli_fetch_assoc($resTotal);
    $totalCount = $rowTotal['jml'];

    $sqlData = "SELECT podt.colname, podt.colcode, podt.spec, podt.item 
                $sqlFrom
                GROUP BY podt.item
                ORDER BY $sort $order
                LIMIT $rows OFFSET $offset";
    
    $rs = mysqli_query($koneksi, $sqlData);

    $row = array();
    $k = $offset;
    while ($data = mysqli_fetch_array($rs)) {
        $k++;
        $btn = '<a href="#" style="color:#359DD9; text-decoration:none;">GET</a>';
        
        // Regex Cleaning (Sama dengan Laravel)
        $spec = trim(preg_replace('/[^a-zA-Z"#()_,%+\-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec']));

        $row[] = array(
            'no' => $k,
            'colname' => $data['colname'],
            'colcode' => $data['colcode'],
            'item' => $data['item'],
            'spec' => $spec,
            'action' => $btn
        );
    }

    $result = array(
        'total' => (int)$totalCount,
        'rows' => $row
    );

    header('Content-Type: application/json');
    echo json_encode($result);
}
if ($_GET['dt'] == "bdown2") {
	$rs = mysqli_query($koneksi, "select $_GET[size] as size from bdown
where ordpk='$ord' and jenis='HEADER' order by bdownpk desc limit 1");
	$data = mysqli_fetch_array($rs);
	echo $data['size'];
}
if ($_GET['dt'] == "bdown") {
// 	$rs = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' 
// AND (jenis IN ('DETAIL','HEADER','FOOTER1')) 
// AND (jenis <> 'DETAIL' OR (jenis = 'DETAIL' AND country <> '' AND color <> ''))
// GROUP BY 
//   CASE WHEN bdown.jenis = 'HEADER' THEN bdown.jenis ELSE bdown.bdownpk END
// ORDER BY
//   CASE
//     WHEN jenis = 'HEADER' THEN 1
//     WHEN jenis = 'DETAIL' THEN 2
//     WHEN jenis = 'FOOTER1' THEN 3
//   END ASC,
//   CASE
//     WHEN jenis = 'DETAIL' THEN bdownpk
//     WHEN jenis = 'FOOTER1' THEN sumby
//     WHEN jenis = 'HEADER' THEN nour
//   END ASC");
	$rs = mysqli_query($koneksi, "SELECT * 
FROM bdown 
WHERE ordpk = '$ord'
  AND (
        jenis IN ('DETAIL','HEADER','FOOTER1')
      )
  AND (
        jenis <> 'DETAIL' 
        OR (
            jenis = 'DETAIL' 
            -- AND country <> '' 
            AND color <> ''
        )
      )
  AND (
      jenis <> 'FOOTER1'
      OR (
          jenis = 'FOOTER1'
          AND (
                sumby <> 'secsz'
								AND sumby <> 'pcd'
                OR (
                     sumby = 'secsz'
                     AND secsz IS NOT NULL
                     AND secsz <> ''
                )
              )
      )
    )
GROUP BY 
   CASE 
      WHEN bdown.jenis = 'HEADER' THEN bdown.jenis 
      ELSE bdown.bdownpk 
   END
ORDER BY
  CASE
      WHEN jenis = 'HEADER' THEN 1
      WHEN jenis = 'DETAIL' THEN 2
      WHEN jenis = 'FOOTER1' THEN 3
  END ASC,
  CASE
      WHEN jenis = 'DETAIL' THEN bdownpk
      WHEN jenis = 'FOOTER1' THEN sumby
      WHEN jenis = 'HEADER' THEN nour
  END ASC;
");
	$br = mysqli_num_rows($rs);
	$result = array();
	//$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"select jenis, country, pono, opno, style, color, gac, s1, s2, s3, s4, s5, s6, s7, s8, s9,
	//				   s10, s11, s12, s13, s14, s15, nour from bdown where ordpk='$ord' order by nour asc"));
	$row = array();
	$k = 0 - 1;
	while ($data = mysqli_fetch_array($rs)) {
		// if(TRIM($data['jenis'])=="FOOTER1"){
		// if($data['sumby']=="color"){
		// $qcolor=mysqli_query($koneksi,"select * from bdown where ordpk='$ord' and color<>'' group by color order by color asc");
		// while($dcolor=mysqli_fetch_array($qcolor)){
		// if($data['sumdata']==$dcolor['color']){
		// } else {
		// $delcol=mysqli_query($koneksi,"delete from bdown where bdownpk='$data[bdownpk]'");
		// }
		// }
		// }

		// if($data['sumby']=="country"){
		// $qcountry=mysqli_query($koneksi,"select * from bdown where ordpk='$ord' and country<>'' group by country order by country asc");
		// while($dcountry=mysqli_fetch_array($qcountry)){
		// if($data['sumdata']==$dcolor['country']){
		// } else {
		// $delcol=mysqli_query($koneksi,"delete from bdown where bdownpk='$data[bdownpk]'");
		// }
		// }
		// }
		// }

		//$k++;
		//$btn = '<a href="#" style="text-decoration:none;">GET</a>';
		if (TRIM($data['jenis']) == "HEADER") {
			$po = "";
			$poref = "";
			$op = "";
			$style = "";
			$color = "";
			$gac = "";
			$s1 = $data['s1'];
			$s2 = $data['s2'];
			$s3 = $data['s3'];
			$s4 = $data['s4'];
			$s5 = $data['s5'];
			$s6 = $data['s6'];
			$s7 = $data['s7'];
			$s8 = $data['s8'];
			$s9 = $data['s9'];
			$s10 = $data['s10'];
			$s11 = $data['s11'];
			$s12 = $data['s12'];
			$s13 = $data['s13'];
			$s14 = $data['s14'];
			$s15 = $data['s15'];
			$s16 = $data['s16'];
			$s17 = $data['s17'];
			$s18 = $data['s18'];
			$s19 = $data['s19'];
			$s20 = $data['s20'];
			$s21 = $data['s21'];
			$s22 = $data['s22'];
			$s23 = $data['s23'];
			$s24 = $data['s24'];
			$s25 = $data['s25'];
			$s26 = $data['s26'];
			$s27 = $data['s27'];
			$s28 = $data['s28'];
			$s29 = $data['s29'];
			$s30 = $data['s30'];
			$s31 = $data['s31'];
			$s32 = $data['s32'];
			$s33 = $data['s33'];
			$s34 = $data['s34'];
			$s35 = $data['s35'];
			$s36 = $data['s36'];
			$s37 = $data['s37'];
			$s38 = $data['s38'];
			$s39 = $data['s39'];
			$s40 = $data['s40'];
			$tot = "";
		} else if (TRIM($data['jenis']) == "DETAIL") {
			$po = $data['pono'];
			$poref = $data['poref'];
			$op = $data['opno'];
			$style = $data['style'];
			$color = $data['color'];
			if ($data['gac'] == "0000-00-00" || $data['gac'] == "") {
				$gac = "";
			} else {
				$gac = tgl($data['gac']);
			}

			if ($data['s1'] < 1) {
				$s1 = "";
			} else {
				$s1 = $data['s1'];
			}
			if ($data['s2'] < 1) {
				$s2 = "";
			} else {
				$s2 = $data['s2'];
			}
			if ($data['s3'] < 1) {
				$s3 = "";
			} else {
				$s3 = $data['s3'];
			}
			if ($data['s4'] < 1) {
				$s4 = "";
			} else {
				$s4 = $data['s4'];
			}
			if ($data['s5'] < 1) {
				$s5 = "";
			} else {
				$s5 = $data['s5'];
			}
			if ($data['s6'] < 1) {
				$s6 = "";
			} else {
				$s6 = $data['s6'];
			}
			if ($data['s7'] < 1) {
				$s7 = "";
			} else {
				$s7 = $data['s7'];
			}
			if ($data['s8'] < 1) {
				$s8 = "";
			} else {
				$s8 = $data['s8'];
			}
			if ($data['s9'] < 1) {
				$s9 = "";
			} else {
				$s9 = $data['s9'];
			}
			if ($data['s10'] < 1) {
				$s10 = "";
			} else {
				$s10 = $data['s10'];
			}
			if ($data['s11'] < 1) {
				$s11 = "";
			} else {
				$s11 = $data['s11'];
			}
			if ($data['s12'] < 1) {
				$s12 = "";
			} else {
				$s12 = $data['s12'];
			}
			if ($data['s13'] < 1) {
				$s13 = "";
			} else {
				$s13 = $data['s13'];
			}
			if ($data['s14'] < 1) {
				$s14 = "";
			} else {
				$s14 = $data['s14'];
			}
			if ($data['s15'] < 1) {
				$s15 = "";
			} else {
				$s15 = $data['s15'];
			}
			if ($data['s16'] < 1) {
				$s16 = "";
			} else {
				$s16 = $data['s16'];
			}
			if ($data['s17'] < 1) {
				$s17 = "";
			} else {
				$s17 = $data['s17'];
			}
			if ($data['s18'] < 1) {
				$s18 = "";
			} else {
				$s18 = $data['s18'];
			}
			if ($data['s19'] < 1) {
				$s19 = "";
			} else {
				$s19 = $data['s19'];
			}
			if ($data['s20'] < 1) {
				$s20 = "";
			} else {
				$s20 = $data['s20'];
			}
			if ($data['s21'] < 1) {
				$s21 = "";
			} else {
				$s21 = $data['s21'];
			}
			if ($data['s22'] < 1) {
				$s22 = "";
			} else {
				$s22 = $data['s22'];
			}
			if ($data['s23'] < 1) {
				$s23 = "";
			} else {
				$s23 = $data['s23'];
			}
			if ($data['s24'] < 1) {
				$s24 = "";
			} else {
				$s24 = $data['s24'];
			}
			if ($data['s25'] < 1) {
				$s25 = "";
			} else {
				$s25 = $data['s25'];
			}
			if ($data['s26'] < 1) {
				$s26 = "";
			} else {
				$s26 = $data['s26'];
			}
			if ($data['s27'] < 1) {
				$s27 = "";
			} else {
				$s27 = $data['s27'];
			}
			if ($data['s28'] < 1) {
				$s28 = "";
			} else {
				$s28 = $data['s28'];
			}
			if ($data['s29'] < 1) {
				$s29 = "";
			} else {
				$s29 = $data['s29'];
			}
			if ($data['s30'] < 1) {
				$s30 = "";
			} else {
				$s30 = $data['s30'];
			}
			if ($data['s31'] < 1) {
				$s31 = "";
			} else {
				$s31 = $data['s31'];
			}
			if ($data['s32'] < 1) {
				$s32 = "";
			} else {
				$s32 = $data['s32'];
			}
			if ($data['s33'] < 1) {
				$s33 = "";
			} else {
				$s33 = $data['s33'];
			}
			if ($data['s34'] < 1) {
				$s34 = "";
			} else {
				$s34 = $data['s34'];
			}
			if ($data['s35'] < 1) {
				$s35 = "";
			} else {
				$s35 = $data['s35'];
			}
			if ($data['s36'] < 1) {
				$s36 = "";
			} else {
				$s36 = $data['s36'];
			}
			if ($data['s37'] < 1) {
				$s37 = "";
			} else {
				$s37 = $data['s37'];
			}
			if ($data['s38'] < 1) {
				$s38 = "";
			} else {
				$s38 = $data['s38'];
			}
			if ($data['s39'] < 1) {
				$s39 = "";
			} else {
				$s39 = $data['s39'];
			}
			if ($data['s40'] < 1) {
				$s40 = "";
			} else {
				$s40 = $data['s40'];
			}
			if ($data['tot'] < 1) {
				$tot = "";
			} else {
				$tot = $data['tot'];
			}
		} else if (TRIM($data['jenis']) == "FOOTER1") {
			$po = "";
			$poref = "";
			$op = "";
			$style = "";
			$color = "";
			if ($data['sumdata'] <> '') {
				$gac = $data['sumdata'];
			} else {
				$gac = "<b>TOTAL</b>";
			}
			if ($data['s1'] < 1) {
				$s1 = "";
			} else {
				$s1 = $data['s1'];
			}
			if ($data['s2'] < 1) {
				$s2 = "";
			} else {
				$s2 = $data['s2'];
			}
			if ($data['s3'] < 1) {
				$s3 = "";
			} else {
				$s3 = $data['s3'];
			}
			if ($data['s4'] < 1) {
				$s4 = "";
			} else {
				$s4 = $data['s4'];
			}
			if ($data['s5'] < 1) {
				$s5 = "";
			} else {
				$s5 = $data['s5'];
			}
			if ($data['s6'] < 1) {
				$s6 = "";
			} else {
				$s6 = $data['s6'];
			}
			if ($data['s7'] < 1) {
				$s7 = "";
			} else {
				$s7 = $data['s7'];
			}
			if ($data['s8'] < 1) {
				$s8 = "";
			} else {
				$s8 = $data['s8'];
			}
			if ($data['s9'] < 1) {
				$s9 = "";
			} else {
				$s9 = $data['s9'];
			}
			if ($data['s10'] < 1) {
				$s10 = "";
			} else {
				$s10 = $data['s10'];
			}
			if ($data['s11'] < 1) {
				$s11 = "";
			} else {
				$s11 = $data['s11'];
			}
			if ($data['s12'] < 1) {
				$s12 = "";
			} else {
				$s12 = $data['s12'];
			}
			if ($data['s13'] < 1) {
				$s13 = "";
			} else {
				$s13 = $data['s13'];
			}
			if ($data['s14'] < 1) {
				$s14 = "";
			} else {
				$s14 = $data['s14'];
			}
			if ($data['s15'] < 1) {
				$s15 = "";
			} else {
				$s15 = $data['s15'];
			}
			if ($data['s16'] < 1) {
				$s16 = "";
			} else {
				$s16 = $data['s16'];
			}
			if ($data['s17'] < 1) {
				$s17 = "";
			} else {
				$s17 = $data['s17'];
			}
			if ($data['s18'] < 1) {
				$s18 = "";
			} else {
				$s18 = $data['s18'];
			}
			if ($data['s19'] < 1) {
				$s19 = "";
			} else {
				$s19 = $data['s19'];
			}
			if ($data['s20'] < 1) {
				$s20 = "";
			} else {
				$s20 = $data['s20'];
			}
			if ($data['s21'] < 1) {
				$s21 = "";
			} else {
				$s21 = $data['s21'];
			}
			if ($data['s22'] < 1) {
				$s22 = "";
			} else {
				$s22 = $data['s22'];
			}
			if ($data['s23'] < 1) {
				$s23 = "";
			} else {
				$s23 = $data['s23'];
			}
			if ($data['s24'] < 1) {
				$s24 = "";
			} else {
				$s24 = $data['s24'];
			}
			if ($data['s25'] < 1) {
				$s25 = "";
			} else {
				$s25 = $data['s25'];
			}
			if ($data['s26'] < 1) {
				$s26 = "";
			} else {
				$s26 = $data['s26'];
			}
			if ($data['s27'] < 1) {
				$s27 = "";
			} else {
				$s27 = $data['s27'];
			}
			if ($data['s28'] < 1) {
				$s28 = "";
			} else {
				$s28 = $data['s28'];
			}
			if ($data['s29'] < 1) {
				$s29 = "";
			} else {
				$s29 = $data['s29'];
			}
			if ($data['s30'] < 1) {
				$s30 = "";
			} else {
				$s30 = $data['s30'];
			}
			if ($data['s31'] < 1) {
				$s31 = "";
			} else {
				$s31 = $data['s31'];
			}
			if ($data['s32'] < 1) {
				$s32 = "";
			} else {
				$s32 = $data['s32'];
			}
			if ($data['s33'] < 1) {
				$s33 = "";
			} else {
				$s33 = $data['s33'];
			}
			if ($data['s34'] < 1) {
				$s34 = "";
			} else {
				$s34 = $data['s34'];
			}
			if ($data['s35'] < 1) {
				$s35 = "";
			} else {
				$s35 = $data['s35'];
			}
			if ($data['s36'] < 1) {
				$s36 = "";
			} else {
				$s36 = $data['s36'];
			}
			if ($data['s37'] < 1) {
				$s37 = "";
			} else {
				$s37 = $data['s37'];
			}
			if ($data['s38'] < 1) {
				$s38 = "";
			} else {
				$s38 = $data['s38'];
			}
			if ($data['s39'] < 1) {
				$s39 = "";
			} else {
				$s39 = $data['s39'];
			}
			if ($data['s40'] < 1) {
				$s40 = "";
			} else {
				$s40 = $data['s40'];
			}
			if ($data['tot'] < 1) {
				$tot = "";
			} else {
				$tot = $data['tot'];
			}
		}

		$k++;
		if (TRIM($data['jenis']) == "HEADER") {
			$s1a = $s1;
			$s2a = $s2;
			$s3a = $s3;
			$s4a = $s4;
			$s5a = $s5;
			$s6a = $s6;
			$s7a = $s7;
			$s8a = $s8;
			$s9a = $s9;
			$s10a = $s10;
			$s11a = $s11;
			$s12a = $s12;
			$s13a = $s13;
			$s14a = $s14;
			$s15a = $s15;
			$s16a = $s16;
			$s17a = $s17;
			$s18a = $s18;
			$s19a = $s19;
			$s20a = $s20;
			$s21a = $s21;
			$s22a = $s22;
			$s23a = $s23;
			$s24a = $s24;
			$s25a = $s25;
			$s26a = $s26;
			$s27a = $s27;
			$s28a = $s28;
			$s29a = $s29;
			$s30a = $s30;
			$s31a = $s31;
			$s32a = $s32;
			$s33a = $s33;
			$s34a = $s34;
			$s35a = $s35;
			$s36a = $s36;
			$s37a = $s37;
			$s38a = $s38;
			$s39a = $s39;
			$s40a = $s40;
			$tota = $tot;
		} else {
			$s1a = "<input type='text' name='s1a' id='s1a$k' value='$s1' onblur='test();' readonly>";
			$s2a = "<input type='text' name='s2a' id='s2a$k' value='$s2' onblur='test();' readonly>";
			$s3a = "<input type='text' name='s3a' id='s3a$k' value='$s3' onblur='test();' readonly>";
			$s4a = "<input type='text' name='s4a' id='s4a$k' value='$s4' onblur='test();' readonly>";
			$s5a = "<input type='text' name='s5a' id='s5a$k' value='$s5' onblur='test();' readonly>";
			$s6a = "<input type='text' name='s6a' id='s6a$k' value='$s6' onblur='test();' readonly>";
			$s7a = "<input type='text' name='s7a' id='s7a$k' value='$s7' onblur='test();' readonly>";
			$s8a = "<input type='text' name='s8a' id='s8a$k' value='$s8' onblur='test();' readonly>";
			$s9a = "<input type='text' name='s9a' id='s9a$k' value='$s9' onblur='test();' readonly>";
			$s10a = "<input type='text' name='s10a' id='s10a$k' value='$s10' onblur='test();' readonly>";
			$s11a = "<input type='text' name='s11a' id='s11a$k' value='$s11' onblur='test();' readonly>";
			$s12a = "<input type='text' name='s12a' id='s12a$k' value='$s12' onblur='test();' readonly>";
			$s13a = "<input type='text' name='s13a' id='s13a$k' value='$s13' onblur='test();' readonly>";
			$s14a = "<input type='text' name='s14a' id='s14a$k' value='$s14' onblur='test();' readonly>";
			$s15a = "<input type='text' name='s15a' id='s15a$k' value='$s15' onblur='test();' readonly>";
			$s16a = "<input type='text' name='s16a' id='s16a$k' value='$s16' onblur='test();' readonly>";
			$s17a = "<input type='text' name='s17a' id='s17a$k' value='$s17' onblur='test();' readonly>";
			$s18a = "<input type='text' name='s18a' id='s18a$k' value='$s18' onblur='test();' readonly>";
			$s19a = "<input type='text' name='s19a' id='s19a$k' value='$s19' onblur='test();' readonly>";
			$s20a = "<input type='text' name='s20a' id='s20a$k' value='$s20' onblur='test();' readonly>";
			$s21a = "<input type='text' name='s21a' id='s21a$k' value='$s21' onblur='test();' readonly>";
			$s22a = "<input type='text' name='s22a' id='s22a$k' value='$s22' onblur='test();' readonly>";
			$s23a = "<input type='text' name='s23a' id='s23a$k' value='$s23' onblur='test();' readonly>";
			$s24a = "<input type='text' name='s24a' id='s24a$k' value='$s24' onblur='test();' readonly>";
			$s25a = "<input type='text' name='s25a' id='s25a$k' value='$s25' onblur='test();' readonly>";
			$s26a = "<input type='text' name='s26a' id='s26a$k' value='$s26' onblur='test();' readonly>";
			$s27a = "<input type='text' name='s27a' id='s27a$k' value='$s27' onblur='test();' readonly>";
			$s28a = "<input type='text' name='s28a' id='s28a$k' value='$s28' onblur='test();' readonly>";
			$s29a = "<input type='text' name='s29a' id='s29a$k' value='$s29' onblur='test();' readonly>";
			$s30a = "<input type='text' name='s30a' id='s30a$k' value='$s30' onblur='test();' readonly>";
			$s31a = "<input type='text' name='s31a' id='s31a$k' value='$s31' onblur='test();' readonly>";
			$s32a = "<input type='text' name='s32a' id='s32a$k' value='$s32' onblur='test();' readonly>";
			$s33a = "<input type='text' name='s33a' id='s33a$k' value='$s33' onblur='test();' readonly>";
			$s34a = "<input type='text' name='s34a' id='s34a$k' value='$s34' onblur='test();' readonly>";
			$s35a = "<input type='text' name='s35a' id='s35a$k' value='$s35' onblur='test();' readonly>";
			$s36a = "<input type='text' name='s36a' id='s36a$k' value='$s36' onblur='test();' readonly>";
			$s37a = "<input type='text' name='s37a' id='s37a$k' value='$s37' onblur='test();' readonly>";
			$s38a = "<input type='text' name='s38a' id='s38a$k' value='$s38' onblur='test();' readonly>";
			$s39a = "<input type='text' name='s39a' id='s39a$k' value='$s39' onblur='test();' readonly>";
			$s40a = "<input type='text' name='s40a' id='s40a$k' value='$s40' onblur='test();' readonly>";
			$tota = "<input type='text' name='tota' id='tota$k' value='$tot' onblur='test();' style='font-weight: bold;' readonly>";
		}

		$row[] = array(
			'jenis' => $data['jenis'],
			'ordpk' => $data['ordpk'],
			'ordno' => $data['ordno'],
			'bdownpk' => $data['bdownpk'],
			'country' => $data['country'],
			'pono' => $po,
			'poref' => $poref,
			'opno' => $op,
			'style' => $style,
			'color' => $color,
			'gac' => $gac,
			's1' => $s1a,
			's2' => $s2a,
			's3' => $s3a,
			's4' => $s4a,
			's5' => $s5a,
			's6' => $s6a,
			's7' => $s7a,
			's8' => $s8a,
			's9' => $s9a,
			's10' => $s10a,
			's11' => $s11a,
			's12' => $s12a,
			's13' => $s13a,
			's14' => $s14a,
			's15' => $s15a,
			's16' => $s16a,
			's17' => $s17a,
			's18' => $s18a,
			's19' => $s19a,
			's20' => $s20a,
			's21' => $s21a,
			's22' => $s22a,
			's23' => $s23a,
			's24' => $s24a,
			's25' => $s25a,
			's26' => $s26a,
			's27' => $s27a,
			's28' => $s28a,
			's29' => $s29a,
			's30' => $s30a,
			's31' => $s31a,
			's32' => $s32a,
			's33' => $s33a,
			's34' => $s34a,
			's35' => $s35a,
			's36' => $s36a,
			's37' => $s37a,
			's38' => $s38a,
			's39' => $s39a,
			's40' => $s40a,
			'tot' => $tota,
			'br' => $br
		);
	}
	$result = array_merge($result, array('rows' => $row));
	echo json_encode($result);
}
if ($_GET['dt'] == "bdown3") {
	$rs = mysqli_query($koneksi, "select * from bdown
where ordpk='$ord' and jenis<>'' AND jenis<>'FOOTER' and jenis<>'footer1'
order by nour asc");
	$br = mysqli_num_rows($rs);
	$result = array();
	$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "select * from bdown
where ordpk='$ord' and jenis<>'' AND jenis<>'FOOTER' and jenis<>'footer1'
order by nour asc"));
	$row = array();

	$k = 0 - 1;
	while ($data = mysqli_fetch_array($rs)) {
		//$k++;
		//$btn = '<a href="#" style="text-decoration:none;">GET</a>';
		if (TRIM($data['jenis']) == "HEADER") {
			$po = "";
			$op = "";
			$style = "";
			$color = "";
			$gac = "";
			$s1 = $data['s1'];
			$s2 = $data['s2'];
			$s3 = $data['s3'];
			$s4 = $data['s4'];
			$s5 = $data['s5'];
			$s6 = $data['s6'];
			$s7 = $data['s7'];
			$s8 = $data['s8'];
			$s9 = $data['s9'];
			$s10 = $data['s10'];
			$s11 = $data['s11'];
			$s12 = $data['s12'];
			$s13 = $data['s13'];
			$s14 = $data['s14'];
			$s15 = $data['s15'];
			$s16 = $data['s16'];
			$s17 = $data['s17'];
			$s18 = $data['s18'];
			$s19 = $data['s19'];
			$s20 = $data['s20'];
			$s21 = $data['s21'];
			$s22 = $data['s22'];
			$s23 = $data['s23'];
			$s24 = $data['s24'];
			$s25 = $data['s25'];
			$s26 = $data['s26'];
			$s27 = $data['s27'];
			$s28 = $data['s28'];
			$s29 = $data['s29'];
			$s30 = $data['s30'];
			$s31 = $data['s31'];
			$s32 = $data['s32'];
			$s33 = $data['s33'];
			$s34 = $data['s34'];
			$s35 = $data['s35'];
			$s36 = $data['s36'];
			$s37 = $data['s37'];
			$s38 = $data['s38'];
			$s39 = $data['s39'];
			$s40 = $data['s40'];
			$tot = "";
		} else if (TRIM($data['jenis']) == "DETAIL") {
			$po = $data['pono'];
			$op = $data['opno'];
			$style = $data['style'];
			$color = $data['color'];
			if ($data['gac'] == "0000-00-00" || $data['gac'] == "") {
				$gac = "";
			} else {
				$gac = tgl($data['gac']);
			}

			if ($data['s1'] < 1) {
				$s1 = "";
			} else {
				$s1 = $data['s1'];
			}
			if ($data['s2'] < 1) {
				$s2 = "";
			} else {
				$s2 = $data['s2'];
			}
			if ($data['s3'] < 1) {
				$s3 = "";
			} else {
				$s3 = $data['s3'];
			}
			if ($data['s4'] < 1) {
				$s4 = "";
			} else {
				$s4 = $data['s4'];
			}
			if ($data['s5'] < 1) {
				$s5 = "";
			} else {
				$s5 = $data['s5'];
			}
			if ($data['s6'] < 1) {
				$s6 = "";
			} else {
				$s6 = $data['s6'];
			}
			if ($data['s7'] < 1) {
				$s7 = "";
			} else {
				$s7 = $data['s7'];
			}
			if ($data['s8'] < 1) {
				$s8 = "";
			} else {
				$s8 = $data['s8'];
			}
			if ($data['s9'] < 1) {
				$s9 = "";
			} else {
				$s9 = $data['s9'];
			}
			if ($data['s10'] < 1) {
				$s10 = "";
			} else {
				$s10 = $data['s10'];
			}
			if ($data['s11'] < 1) {
				$s11 = "";
			} else {
				$s11 = $data['s11'];
			}
			if ($data['s12'] < 1) {
				$s12 = "";
			} else {
				$s12 = $data['s12'];
			}
			if ($data['s13'] < 1) {
				$s13 = "";
			} else {
				$s13 = $data['s13'];
			}
			if ($data['s14'] < 1) {
				$s14 = "";
			} else {
				$s14 = $data['s14'];
			}
			if ($data['s15'] < 1) {
				$s15 = "";
			} else {
				$s15 = $data['s15'];
			}
			if ($data['s16'] < 1) {
				$s16 = "";
			} else {
				$s16 = $data['s16'];
			}
			if ($data['s17'] < 1) {
				$s17 = "";
			} else {
				$s17 = $data['s17'];
			}
			if ($data['s18'] < 1) {
				$s18 = "";
			} else {
				$s18 = $data['s18'];
			}
			if ($data['s19'] < 1) {
				$s19 = "";
			} else {
				$s19 = $data['s19'];
			}
			if ($data['s20'] < 1) {
				$s20 = "";
			} else {
				$s20 = $data['s20'];
			}
			if ($data['s21'] < 1) {
				$s21 = "";
			} else {
				$s21 = $data['s21'];
			}
			if ($data['s22'] < 1) {
				$s22 = "";
			} else {
				$s22 = $data['s22'];
			}
			if ($data['s23'] < 1) {
				$s23 = "";
			} else {
				$s23 = $data['s23'];
			}
			if ($data['s24'] < 1) {
				$s24 = "";
			} else {
				$s24 = $data['s24'];
			}
			if ($data['s25'] < 1) {
				$s25 = "";
			} else {
				$s25 = $data['s25'];
			}
			if ($data['s26'] < 1) {
				$s26 = "";
			} else {
				$s26 = $data['s26'];
			}
			if ($data['s27'] < 1) {
				$s27 = "";
			} else {
				$s27 = $data['s27'];
			}
			if ($data['s28'] < 1) {
				$s28 = "";
			} else {
				$s28 = $data['s28'];
			}
			if ($data['s29'] < 1) {
				$s29 = "";
			} else {
				$s29 = $data['s29'];
			}
			if ($data['s30'] < 1) {
				$s30 = "";
			} else {
				$s30 = $data['s30'];
			}
			if ($data['s31'] < 1) {
				$s31 = "";
			} else {
				$s31 = $data['s31'];
			}
			if ($data['s32'] < 1) {
				$s32 = "";
			} else {
				$s32 = $data['s32'];
			}
			if ($data['s33'] < 1) {
				$s33 = "";
			} else {
				$s33 = $data['s33'];
			}
			if ($data['s34'] < 1) {
				$s34 = "";
			} else {
				$s34 = $data['s34'];
			}
			if ($data['s35'] < 1) {
				$s35 = "";
			} else {
				$s35 = $data['s35'];
			}
			if ($data['s36'] < 1) {
				$s36 = "";
			} else {
				$s36 = $data['s36'];
			}
			if ($data['s37'] < 1) {
				$s37 = "";
			} else {
				$s37 = $data['s37'];
			}
			if ($data['s38'] < 1) {
				$s38 = "";
			} else {
				$s38 = $data['s38'];
			}
			if ($data['s39'] < 1) {
				$s39 = "";
			} else {
				$s39 = $data['s39'];
			}
			if ($data['s40'] < 1) {
				$s40 = "";
			} else {
				$s40 = $data['s40'];
			}
			if ($data['tot'] < 1) {
				$tot = "";
			} else {
				$tot = $data['tot'];
			}
		}

		$k++;
		if (TRIM($data['jenis']) == "HEADER") {
			$s1a = $s1;
			$s2a = $s2;
			$s3a = $s3;
			$s4a = $s4;
			$s5a = $s5;
			$s6a = $s6;
			$s7a = $s7;
			$s8a = $s8;
			$s9a = $s9;
			$s10a = $s10;
			$s11a = $s11;
			$s12a = $s12;
			$s13a = $s13;
			$s14a = $s14;
			$s15a = $s15;
			$s16a = $s16;
			$s17a = $s17;
			$s18a = $s18;
			$s19a = $s19;
			$s20a = $s20;
			$s21a = $s21;
			$s22a = $s22;
			$s23a = $s23;
			$s24a = $s24;
			$s25a = $s25;
			$s26a = $s26;
			$s27a = $s27;
			$s28a = $s28;
			$s29a = $s29;
			$s30a = $s30;
			$s31a = $s31;
			$s32a = $s32;
			$s33a = $s33;
			$s34a = $s34;
			$s35a = $s35;
			$s36a = $s36;
			$s37a = $s37;
			$s38a = $s38;
			$s39a = $s39;
			$s40a = $s40;
			$tota = $tot;
		} else {
			$s1a = "<input type='text' name='s1a' id='s1a$k' value='$s1' onblur='test();' readonly>";
			$s2a = "<input type='text' name='s2a' id='s2a$k' value='$s2' onblur='test();' readonly>";
			$s3a = "<input type='text' name='s3a' id='s3a$k' value='$s3' onblur='test();' readonly>";
			$s4a = "<input type='text' name='s4a' id='s4a$k' value='$s4' onblur='test();' readonly>";
			$s5a = "<input type='text' name='s5a' id='s5a$k' value='$s5' onblur='test();' readonly>";
			$s6a = "<input type='text' name='s6a' id='s6a$k' value='$s6' onblur='test();' readonly>";
			$s7a = "<input type='text' name='s7a' id='s7a$k' value='$s7' onblur='test();' readonly>";
			$s8a = "<input type='text' name='s8a' id='s8a$k' value='$s8' onblur='test();' readonly>";
			$s9a = "<input type='text' name='s9a' id='s9a$k' value='$s9' onblur='test();' readonly>";
			$s10a = "<input type='text' name='s10a' id='s10a$k' value='$s10' onblur='test();' readonly>";
			$s11a = "<input type='text' name='s11a' id='s11a$k' value='$s11' onblur='test();' readonly>";
			$s12a = "<input type='text' name='s12a' id='s12a$k' value='$s12' onblur='test();' readonly>";
			$s13a = "<input type='text' name='s13a' id='s13a$k' value='$s13' onblur='test();' readonly>";
			$s14a = "<input type='text' name='s14a' id='s14a$k' value='$s14' onblur='test();' readonly>";
			$s15a = "<input type='text' name='s15a' id='s15a$k' value='$s15' onblur='test();' readonly>";
			$s16a = "<input type='text' name='s16a' id='s16a$k' value='$s16' onblur='test();' readonly>";
			$s17a = "<input type='text' name='s17a' id='s17a$k' value='$s17' onblur='test();' readonly>";
			$s18a = "<input type='text' name='s18a' id='s18a$k' value='$s18' onblur='test();' readonly>";
			$s19a = "<input type='text' name='s19a' id='s19a$k' value='$s19' onblur='test();' readonly>";
			$s20a = "<input type='text' name='s20a' id='s20a$k' value='$s20' onblur='test();' readonly>";
			$s21a = "<input type='text' name='s21a' id='s21a$k' value='$s21' onblur='test();' readonly>";
			$s22a = "<input type='text' name='s22a' id='s22a$k' value='$s22' onblur='test();' readonly>";
			$s23a = "<input type='text' name='s23a' id='s23a$k' value='$s23' onblur='test();' readonly>";
			$s24a = "<input type='text' name='s24a' id='s24a$k' value='$s24' onblur='test();' readonly>";
			$s25a = "<input type='text' name='s25a' id='s25a$k' value='$s25' onblur='test();' readonly>";
			$s26a = "<input type='text' name='s26a' id='s26a$k' value='$s26' onblur='test();' readonly>";
			$s27a = "<input type='text' name='s27a' id='s27a$k' value='$s27' onblur='test();' readonly>";
			$s28a = "<input type='text' name='s28a' id='s28a$k' value='$s28' onblur='test();' readonly>";
			$s29a = "<input type='text' name='s29a' id='s29a$k' value='$s29' onblur='test();' readonly>";
			$s30a = "<input type='text' name='s30a' id='s30a$k' value='$s30' onblur='test();' readonly>";
			$s31a = "<input type='text' name='s31a' id='s31a$k' value='$s31' onblur='test();' readonly>";
			$s32a = "<input type='text' name='s32a' id='s32a$k' value='$s32' onblur='test();' readonly>";
			$s33a = "<input type='text' name='s33a' id='s33a$k' value='$s33' onblur='test();' readonly>";
			$s34a = "<input type='text' name='s34a' id='s34a$k' value='$s34' onblur='test();' readonly>";
			$s35a = "<input type='text' name='s35a' id='s35a$k' value='$s35' onblur='test();' readonly>";
			$s36a = "<input type='text' name='s36a' id='s36a$k' value='$s36' onblur='test();' readonly>";
			$s37a = "<input type='text' name='s37a' id='s37a$k' value='$s37' onblur='test();' readonly>";
			$s38a = "<input type='text' name='s38a' id='s38a$k' value='$s38' onblur='test();' readonly>";
			$s39a = "<input type='text' name='s39a' id='s39a$k' value='$s39' onblur='test();' readonly>";
			$s40a = "<input type='text' name='s40a' id='s40a$k' value='$s40' onblur='test();' readonly>";
			$tota = "<input type='text' name='tota' id='tota$k' value='$tot' onblur='test();' style='font-weight: bold;' readonly>";
		}

		$row[] = array(
			'jenis' => $data['jenis'],
			'ordpk' => $data['ordpk'],
			'ordno' => $data['ordno'],
			'bdownpk' => $data['bdownpk'],
			'country' => $data['country'],
			'pono' => $po,
			'opno' => $op,
			'style' => $style,
			'color' => $color,
			'gac' => $gac,
			's1' => $s1a,
			's2' => $s2a,
			's3' => $s3a,
			's4' => $s4a,
			's5' => $s5a,
			's6' => $s6a,
			's7' => $s7a,
			's8' => $s8a,
			's9' => $s9a,
			's10' => $s10a,
			's11' => $s11a,
			's12' => $s12a,
			's13' => $s13a,
			's14' => $s14a,
			's15' => $s15a,
			's16' => $s16a,
			's17' => $s17a,
			's18' => $s18a,
			's19' => $s19a,
			's20' => $s20a,
			's21' => $s21a,
			's22' => $s22a,
			's23' => $s23a,
			's24' => $s24a,
			's25' => $s25a,
			's26' => $s26a,
			's27' => $s27a,
			's28' => $s28a,
			's29' => $s29a,
			's30' => $s30a,
			's31' => $s31a,
			's32' => $s32a,
			's33' => $s33a,
			's34' => $s34a,
			's35' => $s35a,
			's36' => $s36a,
			's37' => $s37a,
			's38' => $s38a,
			's39' => $s39a,
			's40' => $s40a,
			'tot' => $tota,
			'br' => $br
		);
	}

	$rs2 = mysqli_query($koneksi, "select * from bdown
where ordpk='$ord' and jenis='FOOTER1' and sumby='color'
order by sumdata asc");
	$entry = array();
	while ($data2 = mysqli_fetch_array($rs2)) {
		$k++;
		$po = "";
		$op = "";
		$style = "";
		$color = "";
		if ($data2['sumdata'] <> "") {
			$gac = $data2['sumdata'];
		} else {
			$gac = "<b>TOTAL</b>";
		}
		if ($data2['s1'] < 1) {
			$s1 = "";
		} else {
			$s1 = $data2['s1'];
		}
		if ($data2['s2'] < 1) {
			$s2 = "";
		} else {
			$s2 = $data2['s2'];
		}
		if ($data2['s3'] < 1) {
			$s3 = "";
		} else {
			$s3 = $data2['s3'];
		}
		if ($data2['s4'] < 1) {
			$s4 = "";
		} else {
			$s4 = $data2['s4'];
		}
		if ($data2['s5'] < 1) {
			$s5 = "";
		} else {
			$s5 = $data2['s5'];
		}
		if ($data2['s6'] < 1) {
			$s6 = "";
		} else {
			$s6 = $data2['s6'];
		}
		if ($data2['s7'] < 1) {
			$s7 = "";
		} else {
			$s7 = $data2['s7'];
		}
		if ($data2['s8'] < 1) {
			$s8 = "";
		} else {
			$s8 = $data2['s8'];
		}
		if ($data2['s9'] < 1) {
			$s9 = "";
		} else {
			$s9 = $data2['s9'];
		}
		if ($data2['s10'] < 1) {
			$s10 = "";
		} else {
			$s10 = $data2['s10'];
		}
		if ($data2['s11'] < 1) {
			$s11 = "";
		} else {
			$s11 = $data2['s11'];
		}
		if ($data2['s12'] < 1) {
			$s12 = "";
		} else {
			$s12 = $data2['s12'];
		}
		if ($data2['s13'] < 1) {
			$s13 = "";
		} else {
			$s13 = $data2['s13'];
		}
		if ($data2['s14'] < 1) {
			$s14 = "";
		} else {
			$s14 = $data2['s14'];
		}
		if ($data2['s15'] < 1) {
			$s15 = "";
		} else {
			$s15 = $data2['s15'];
		}
		if ($data['s16'] < 1) {
			$s16 = "";
		} else {
			$s16 = $data['s16'];
		}
		if ($data['s17'] < 1) {
			$s17 = "";
		} else {
			$s17 = $data['s17'];
		}
		if ($data['s18'] < 1) {
			$s18 = "";
		} else {
			$s18 = $data['s18'];
		}
		if ($data['s19'] < 1) {
			$s19 = "";
		} else {
			$s19 = $data['s19'];
		}
		if ($data['s20'] < 1) {
			$s20 = "";
		} else {
			$s20 = $data['s20'];
		}
		if ($data['s21'] < 1) {
			$s21 = "";
		} else {
			$s21 = $data['s21'];
		}
		if ($data['s22'] < 1) {
			$s22 = "";
		} else {
			$s22 = $data['s22'];
		}
		if ($data['s23'] < 1) {
			$s23 = "";
		} else {
			$s23 = $data['s23'];
		}
		if ($data['s24'] < 1) {
			$s24 = "";
		} else {
			$s24 = $data['s24'];
		}
		if ($data['s25'] < 1) {
			$s25 = "";
		} else {
			$s25 = $data['s25'];
		}
		if ($data['s26'] < 1) {
			$s26 = "";
		} else {
			$s26 = $data['s26'];
		}
		if ($data['s27'] < 1) {
			$s27 = "";
		} else {
			$s27 = $data['s27'];
		}
		if ($data['s28'] < 1) {
			$s28 = "";
		} else {
			$s28 = $data['s28'];
		}
		if ($data['s29'] < 1) {
			$s29 = "";
		} else {
			$s29 = $data['s29'];
		}
		if ($data['s30'] < 1) {
			$s30 = "";
		} else {
			$s30 = $data['s30'];
		}
		if ($data['s31'] < 1) {
			$s31 = "";
		} else {
			$s31 = $data['s31'];
		}
		if ($data['s32'] < 1) {
			$s32 = "";
		} else {
			$s32 = $data['s32'];
		}
		if ($data['s33'] < 1) {
			$s33 = "";
		} else {
			$s33 = $data['s33'];
		}
		if ($data['s34'] < 1) {
			$s34 = "";
		} else {
			$s34 = $data['s34'];
		}
		if ($data['s35'] < 1) {
			$s35 = "";
		} else {
			$s35 = $data['s35'];
		}
		if ($data['s36'] < 1) {
			$s36 = "";
		} else {
			$s36 = $data['s36'];
		}
		if ($data['s37'] < 1) {
			$s37 = "";
		} else {
			$s37 = $data['s37'];
		}
		if ($data['s38'] < 1) {
			$s38 = "";
		} else {
			$s38 = $data['s38'];
		}
		if ($data['s39'] < 1) {
			$s39 = "";
		} else {
			$s39 = $data['s39'];
		}
		if ($data['s40'] < 1) {
			$s40 = "";
		} else {
			$s40 = $data['s40'];
		}
		if ($data2['tot'] < 1) {
			$tot = "";
		} else {
			$tot = $data2['tot'];
		}

		$s1a = "<input type='text' name='s1a' id='s1a$k' value='$s1' onblur='test();' readonly>";
		$s2a = "<input type='text' name='s2a' id='s2a$k' value='$s2' onblur='test();' readonly>";
		$s3a = "<input type='text' name='s3a' id='s3a$k' value='$s3' onblur='test();' readonly>";
		$s4a = "<input type='text' name='s4a' id='s4a$k' value='$s4' onblur='test();' readonly>";
		$s5a = "<input type='text' name='s5a' id='s5a$k' value='$s5' onblur='test();' readonly>";
		$s6a = "<input type='text' name='s6a' id='s6a$k' value='$s6' onblur='test();' readonly>";
		$s7a = "<input type='text' name='s7a' id='s7a$k' value='$s7' onblur='test();' readonly>";
		$s8a = "<input type='text' name='s8a' id='s8a$k' value='$s8' onblur='test();' readonly>";
		$s9a = "<input type='text' name='s9a' id='s9a$k' value='$s9' onblur='test();' readonly>";
		$s10a = "<input type='text' name='s10a' id='s10a$k' value='$s10' onblur='test();' readonly>";
		$s11a = "<input type='text' name='s11a' id='s11a$k' value='$s11' onblur='test();' readonly>";
		$s12a = "<input type='text' name='s12a' id='s12a$k' value='$s12' onblur='test();' readonly>";
		$s13a = "<input type='text' name='s13a' id='s13a$k' value='$s13' onblur='test();' readonly>";
		$s14a = "<input type='text' name='s14a' id='s14a$k' value='$s14' onblur='test();' readonly>";
		$s15a = "<input type='text' name='s15a' id='s15a$k' value='$s15' onblur='test();' readonly>";
		$s16a = "<input type='text' name='s16a' id='s16a$k' value='$s16' onblur='test();' readonly>";
		$s17a = "<input type='text' name='s17a' id='s17a$k' value='$s17' onblur='test();' readonly>";
		$s18a = "<input type='text' name='s18a' id='s18a$k' value='$s18' onblur='test();' readonly>";
		$s19a = "<input type='text' name='s19a' id='s19a$k' value='$s19' onblur='test();' readonly>";
		$s20a = "<input type='text' name='s20a' id='s20a$k' value='$s20' onblur='test();' readonly>";
		$s21a = "<input type='text' name='s21a' id='s21a$k' value='$s21' onblur='test();' readonly>";
		$s22a = "<input type='text' name='s22a' id='s22a$k' value='$s22' onblur='test();' readonly>";
		$s23a = "<input type='text' name='s23a' id='s23a$k' value='$s23' onblur='test();' readonly>";
		$s24a = "<input type='text' name='s24a' id='s24a$k' value='$s24' onblur='test();' readonly>";
		$s25a = "<input type='text' name='s25a' id='s25a$k' value='$s25' onblur='test();' readonly>";
		$s26a = "<input type='text' name='s26a' id='s26a$k' value='$s26' onblur='test();' readonly>";
		$s27a = "<input type='text' name='s27a' id='s27a$k' value='$s27' onblur='test();' readonly>";
		$s28a = "<input type='text' name='s28a' id='s28a$k' value='$s28' onblur='test();' readonly>";
		$s29a = "<input type='text' name='s29a' id='s29a$k' value='$s29' onblur='test();' readonly>";
		$s30a = "<input type='text' name='s30a' id='s30a$k' value='$s30' onblur='test();' readonly>";
		$s31a = "<input type='text' name='s31a' id='s31a$k' value='$s31' onblur='test();' readonly>";
		$s32a = "<input type='text' name='s32a' id='s32a$k' value='$s32' onblur='test();' readonly>";
		$s33a = "<input type='text' name='s33a' id='s33a$k' value='$s33' onblur='test();' readonly>";
		$s34a = "<input type='text' name='s34a' id='s34a$k' value='$s34' onblur='test();' readonly>";
		$s35a = "<input type='text' name='s35a' id='s35a$k' value='$s35' onblur='test();' readonly>";
		$s36a = "<input type='text' name='s36a' id='s36a$k' value='$s36' onblur='test();' readonly>";
		$s37a = "<input type='text' name='s37a' id='s37a$k' value='$s37' onblur='test();' readonly>";
		$s38a = "<input type='text' name='s38a' id='s38a$k' value='$s38' onblur='test();' readonly>";
		$s39a = "<input type='text' name='s39a' id='s39a$k' value='$s39' onblur='test();' readonly>";
		$s40a = "<input type='text' name='s40a' id='s40a$k' value='$s40' onblur='test();' readonly>";
		$tota = "<input type='text' name='tota' id='tota$k' value='$tot' onblur='test();' style='font-weight: bold;' readonly>";

		$entry[]  = array(
			'jenis' => $data2['jenis'],
			'ordpk' => $data2['ordpk'],
			'ordno' => $data2['ordno'],
			'bdownpk' => $data2['bdownpk'],
			'country' => $data2['country'],
			'pono' => $po,
			'opno' => $op,
			'style' => $style,
			'color' => $color,
			'gac' => $gac,
			's1' => $s1a,
			's2' => $s2a,
			's3' => $s3a,
			's4' => $s4a,
			's5' => $s5a,
			's6' => $s6a,
			's7' => $s7a,
			's8' => $s8a,
			's9' => $s9a,
			's10' => $s10a,
			's11' => $s11a,
			's12' => $s12a,
			's13' => $s13a,
			's14' => $s14a,
			's15' => $s15a,
			's16' => $s16a,
			's17' => $s17a,
			's18' => $s18a,
			's19' => $s19a,
			's20' => $s20a,
			's21' => $s21a,
			's22' => $s22a,
			's23' => $s23a,
			's24' => $s24a,
			's25' => $s25a,
			's26' => $s26a,
			's27' => $s27a,
			's28' => $s28a,
			's29' => $s29a,
			's30' => $s30a,
			's31' => $s31a,
			's32' => $s32a,
			's33' => $s33a,
			's34' => $s34a,
			's35' => $s35a,
			's36' => $s36a,
			's37' => $s37a,
			's38' => $s38a,
			's39' => $s39a,
			's40' => $s40a,
			'tot' => $tota,
			'br' => $br
		);
	}

	$rs2b = mysqli_query($koneksi, "select * from bdown
where ordpk='$ord' and jenis='FOOTER1' and sumby='country'
order by sumdata asc");
	$entryb = array();
	while ($data3 = mysqli_fetch_array($rs2b)) {
		$k++;
		$po = "";
		$op = "";
		$style = "";
		$color = "";
		if ($data3['sumdata'] <> "") {
			$gac = $data3['sumdata'];
		} else {
			$gac = "<b>TOTAL</b>";
		}
		if ($data3['s1'] < 1) {
			$s1 = "";
		} else {
			$s1 = $data3['s1'];
		}
		if ($data3['s2'] < 1) {
			$s2 = "";
		} else {
			$s2 = $data3['s2'];
		}
		if ($data3['s3'] < 1) {
			$s3 = "";
		} else {
			$s3 = $data3['s3'];
		}
		if ($data3['s4'] < 1) {
			$s4 = "";
		} else {
			$s4 = $data3['s4'];
		}
		if ($data3['s5'] < 1) {
			$s5 = "";
		} else {
			$s5 = $data3['s5'];
		}
		if ($data3['s6'] < 1) {
			$s6 = "";
		} else {
			$s6 = $data3['s6'];
		}
		if ($data3['s7'] < 1) {
			$s7 = "";
		} else {
			$s7 = $data3['s7'];
		}
		if ($data3['s8'] < 1) {
			$s8 = "";
		} else {
			$s8 = $data3['s8'];
		}
		if ($data3['s9'] < 1) {
			$s9 = "";
		} else {
			$s9 = $data3['s9'];
		}
		if ($data3['s10'] < 1) {
			$s10 = "";
		} else {
			$s10 = $data3['s10'];
		}
		if ($data3['s11'] < 1) {
			$s11 = "";
		} else {
			$s11 = $data3['s11'];
		}
		if ($data3['s12'] < 1) {
			$s12 = "";
		} else {
			$s12 = $data3['s12'];
		}
		if ($data3['s13'] < 1) {
			$s13 = "";
		} else {
			$s13 = $data3['s13'];
		}
		if ($data3['s14'] < 1) {
			$s14 = "";
		} else {
			$s14 = $data3['s14'];
		}
		if ($data3['s15'] < 1) {
			$s15 = "";
		} else {
			$s15 = $data3['s15'];
		}
		if ($data3['s16'] < 1) {
			$s16 = "";
		} else {
			$s16 = $data3['s16'];
		}
		if ($data3['s17'] < 1) {
			$s17 = "";
		} else {
			$s17 = $data3['s17'];
		}
		if ($data3['s18'] < 1) {
			$s18 = "";
		} else {
			$s18 = $data3['s18'];
		}
		if ($data3['s19'] < 1) {
			$s19 = "";
		} else {
			$s19 = $data3['s19'];
		}
		if ($data3['s20'] < 1) {
			$s20 = "";
		} else {
			$s20 = $data3['s20'];
		}
		if ($data3['s21'] < 1) {
			$s21 = "";
		} else {
			$s21 = $data3['s21'];
		}
		if ($data3['s22'] < 1) {
			$s22 = "";
		} else {
			$s22 = $data3['s22'];
		}
		if ($data3['s23'] < 1) {
			$s23 = "";
		} else {
			$s23 = $data3['s23'];
		}
		if ($data3['s24'] < 1) {
			$s24 = "";
		} else {
			$s24 = $data3['s24'];
		}
		if ($data3['s25'] < 1) {
			$s25 = "";
		} else {
			$s25 = $data3['s25'];
		}
		if ($data3['s26'] < 1) {
			$s26 = "";
		} else {
			$s26 = $data3['s26'];
		}
		if ($data3['s27'] < 1) {
			$s27 = "";
		} else {
			$s27 = $data3['s27'];
		}
		if ($data3['s28'] < 1) {
			$s28 = "";
		} else {
			$s28 = $data3['s28'];
		}
		if ($data3['s29'] < 1) {
			$s29 = "";
		} else {
			$s29 = $data3['s29'];
		}
		if ($data3['s30'] < 1) {
			$s30 = "";
		} else {
			$s30 = $data3['s30'];
		}
		if ($data3['s31'] < 1) {
			$s31 = "";
		} else {
			$s31 = $data3['s31'];
		}
		if ($data3['s32'] < 1) {
			$s32 = "";
		} else {
			$s32 = $data3['s32'];
		}
		if ($data3['s33'] < 1) {
			$s33 = "";
		} else {
			$s33 = $data3['s33'];
		}
		if ($data3['s34'] < 1) {
			$s34 = "";
		} else {
			$s34 = $data3['s34'];
		}
		if ($data3['s35'] < 1) {
			$s35 = "";
		} else {
			$s35 = $data3['s35'];
		}
		if ($data3['s36'] < 1) {
			$s36 = "";
		} else {
			$s36 = $data3['s36'];
		}
		if ($data3['s37'] < 1) {
			$s37 = "";
		} else {
			$s37 = $data3['s37'];
		}
		if ($data3['s38'] < 1) {
			$s38 = "";
		} else {
			$s38 = $data3['s38'];
		}
		if ($data3['s39'] < 1) {
			$s39 = "";
		} else {
			$s39 = $data3['s39'];
		}
		if ($data3['s40'] < 1) {
			$s40 = "";
		} else {
			$s40 = $data3['s40'];
		}
		if ($data3['tot'] < 1) {
			$tot = "";
		} else {
			$tot = $data3['tot'];
		}

		$s1a = "<input type='text' name='s1a' id='s1a$k' value='$s1' onblur='test();' readonly>";
		$s2a = "<input type='text' name='s2a' id='s2a$k' value='$s2' onblur='test();' readonly>";
		$s3a = "<input type='text' name='s3a' id='s3a$k' value='$s3' onblur='test();' readonly>";
		$s4a = "<input type='text' name='s4a' id='s4a$k' value='$s4' onblur='test();' readonly>";
		$s5a = "<input type='text' name='s5a' id='s5a$k' value='$s5' onblur='test();' readonly>";
		$s6a = "<input type='text' name='s6a' id='s6a$k' value='$s6' onblur='test();' readonly>";
		$s7a = "<input type='text' name='s7a' id='s7a$k' value='$s7' onblur='test();' readonly>";
		$s8a = "<input type='text' name='s8a' id='s8a$k' value='$s8' onblur='test();' readonly>";
		$s9a = "<input type='text' name='s9a' id='s9a$k' value='$s9' onblur='test();' readonly>";
		$s10a = "<input type='text' name='s10a' id='s10a$k' value='$s10' onblur='test();' readonly>";
		$s11a = "<input type='text' name='s11a' id='s11a$k' value='$s11' onblur='test();' readonly>";
		$s12a = "<input type='text' name='s12a' id='s12a$k' value='$s12' onblur='test();' readonly>";
		$s13a = "<input type='text' name='s13a' id='s13a$k' value='$s13' onblur='test();' readonly>";
		$s14a = "<input type='text' name='s14a' id='s14a$k' value='$s14' onblur='test();' readonly>";
		$s15a = "<input type='text' name='s15a' id='s15a$k' value='$s15' onblur='test();' readonly>";
		$s16a = "<input type='text' name='s16a' id='s16a$k' value='$s16' onblur='test();' readonly>";
		$s17a = "<input type='text' name='s17a' id='s17a$k' value='$s17' onblur='test();' readonly>";
		$s18a = "<input type='text' name='s18a' id='s18a$k' value='$s18' onblur='test();' readonly>";
		$s19a = "<input type='text' name='s19a' id='s19a$k' value='$s19' onblur='test();' readonly>";
		$s20a = "<input type='text' name='s20a' id='s20a$k' value='$s20' onblur='test();' readonly>";
		$s21a = "<input type='text' name='s21a' id='s21a$k' value='$s21' onblur='test();' readonly>";
		$s22a = "<input type='text' name='s22a' id='s22a$k' value='$s22' onblur='test();' readonly>";
		$s23a = "<input type='text' name='s23a' id='s23a$k' value='$s23' onblur='test();' readonly>";
		$s24a = "<input type='text' name='s24a' id='s24a$k' value='$s24' onblur='test();' readonly>";
		$s25a = "<input type='text' name='s25a' id='s25a$k' value='$s25' onblur='test();' readonly>";
		$s26a = "<input type='text' name='s26a' id='s26a$k' value='$s26' onblur='test();' readonly>";
		$s27a = "<input type='text' name='s27a' id='s27a$k' value='$s27' onblur='test();' readonly>";
		$s28a = "<input type='text' name='s28a' id='s28a$k' value='$s28' onblur='test();' readonly>";
		$s29a = "<input type='text' name='s29a' id='s29a$k' value='$s29' onblur='test();' readonly>";
		$s30a = "<input type='text' name='s30a' id='s30a$k' value='$s30' onblur='test();' readonly>";
		$s31a = "<input type='text' name='s31a' id='s31a$k' value='$s31' onblur='test();' readonly>";
		$s32a = "<input type='text' name='s32a' id='s32a$k' value='$s32' onblur='test();' readonly>";
		$s33a = "<input type='text' name='s33a' id='s33a$k' value='$s33' onblur='test();' readonly>";
		$s34a = "<input type='text' name='s34a' id='s34a$k' value='$s34' onblur='test();' readonly>";
		$s35a = "<input type='text' name='s35a' id='s35a$k' value='$s35' onblur='test();' readonly>";
		$s36a = "<input type='text' name='s36a' id='s36a$k' value='$s36' onblur='test();' readonly>";
		$s37a = "<input type='text' name='s37a' id='s37a$k' value='$s37' onblur='test();' readonly>";
		$s38a = "<input type='text' name='s38a' id='s38a$k' value='$s38' onblur='test();' readonly>";
		$s39a = "<input type='text' name='s39a' id='s39a$k' value='$s39' onblur='test();' readonly>";
		$s40a = "<input type='text' name='s40a' id='s40a$k' value='$s40' onblur='test();' readonly>";
		$tota = "<input type='text' name='tota' id='tota$k' value='$tot' onblur='test();' style='font-weight: bold;' readonly>";

		$entryb[]  = array(
			'jenis' => $data3['jenis'],
			'ordpk' => $data3['ordpk'],
			'ordno' => $data3['ordno'],
			'bdownpk' => $data3['bdownpk'],
			'country' => $data3['country'],
			'pono' => $po,
			'opno' => $op,
			'style' => $style,
			'color' => $color,
			'gac' => $gac,
			's1' => $s1a,
			's2' => $s2a,
			's3' => $s3a,
			's4' => $s4a,
			's5' => $s5a,
			's6' => $s6a,
			's7' => $s7a,
			's8' => $s8a,
			's9' => $s9a,
			's10' => $s10a,
			's11' => $s11a,
			's12' => $s12a,
			's13' => $s13a,
			's14' => $s14a,
			's15' => $s15a,
			's16' => $s16a,
			's17' => $s17a,
			's18' => $s18a,
			's19' => $s19a,
			's20' => $s20a,
			's21' => $s21a,
			's22' => $s22a,
			's23' => $s23a,
			's24' => $s24a,
			's25' => $s25a,
			's26' => $s26a,
			's27' => $s27a,
			's28' => $s28a,
			's29' => $s29a,
			's30' => $s30a,
			's31' => $s31a,
			's32' => $s32a,
			's33' => $s33a,
			's34' => $s34a,
			's35' => $s35a,
			's36' => $s36a,
			's37' => $s37a,
			's38' => $s38a,
			's39' => $s39a,
			's40' => $s40a,
			'tot' => $tota,
			'br' => $br
		);
	}

	$rs2c = mysqli_query($koneksi, "select * from bdown
where ordpk='$ord' and jenis='FOOTER1' and sumby='total'");
	$entryc = array();
	while ($data4 = mysqli_fetch_array($rs2c)) {
		$k++;
		$po = "";
		$op = "";
		$style = "";
		$color = "";
		if ($data4['sumdata'] <> "") {
			$gac = $data4['sumdata'];
		} else {
			$gac = "<b>TOTAL</b>";
		}
		if ($data4['s1'] < 1) {
			$s1 = "";
		} else {
			$s1 = $data4['s1'];
		}
		if ($data4['s2'] < 1) {
			$s2 = "";
		} else {
			$s2 = $data4['s2'];
		}
		if ($data4['s3'] < 1) {
			$s3 = "";
		} else {
			$s3 = $data4['s3'];
		}
		if ($data4['s4'] < 1) {
			$s4 = "";
		} else {
			$s4 = $data4['s4'];
		}
		if ($data4['s5'] < 1) {
			$s5 = "";
		} else {
			$s5 = $data4['s5'];
		}
		if ($data4['s6'] < 1) {
			$s6 = "";
		} else {
			$s6 = $data4['s6'];
		}
		if ($data4['s7'] < 1) {
			$s7 = "";
		} else {
			$s7 = $data4['s7'];
		}
		if ($data4['s8'] < 1) {
			$s8 = "";
		} else {
			$s8 = $data4['s8'];
		}
		if ($data4['s9'] < 1) {
			$s9 = "";
		} else {
			$s9 = $data4['s9'];
		}
		if ($data4['s10'] < 1) {
			$s10 = "";
		} else {
			$s10 = $data4['s10'];
		}
		if ($data4['s11'] < 1) {
			$s11 = "";
		} else {
			$s11 = $data4['s11'];
		}
		if ($data4['s12'] < 1) {
			$s12 = "";
		} else {
			$s12 = $data4['s12'];
		}
		if ($data4['s13'] < 1) {
			$s13 = "";
		} else {
			$s13 = $data4['s13'];
		}
		if ($data4['s14'] < 1) {
			$s14 = "";
		} else {
			$s14 = $data4['s14'];
		}
		if ($data4['s15'] < 1) {
			$s15 = "";
		} else {
			$s15 = $data4['s15'];
		}
		if ($data4['s16'] < 1) {
			$s16 = "";
		} else {
			$s16 = $data4['s16'];
		}
		if ($data4['s17'] < 1) {
			$s17 = "";
		} else {
			$s17 = $data4['s17'];
		}
		if ($data4['s18'] < 1) {
			$s18 = "";
		} else {
			$s18 = $data4['s18'];
		}
		if ($data4['s19'] < 1) {
			$s19 = "";
		} else {
			$s19 = $data4['s19'];
		}
		if ($data4['s20'] < 1) {
			$s20 = "";
		} else {
			$s20 = $data4['s20'];
		}
		if ($data4['s21'] < 1) {
			$s21 = "";
		} else {
			$s21 = $data4['s21'];
		}
		if ($data4['s22'] < 1) {
			$s22 = "";
		} else {
			$s22 = $data4['s22'];
		}
		if ($data4['s23'] < 1) {
			$s23 = "";
		} else {
			$s23 = $data4['s23'];
		}
		if ($data4['s24'] < 1) {
			$s24 = "";
		} else {
			$s24 = $data4['s24'];
		}
		if ($data4['s25'] < 1) {
			$s25 = "";
		} else {
			$s25 = $data4['s25'];
		}
		if ($data4['s26'] < 1) {
			$s26 = "";
		} else {
			$s26 = $data4['s26'];
		}
		if ($data4['s27'] < 1) {
			$s27 = "";
		} else {
			$s27 = $data4['s27'];
		}
		if ($data4['s28'] < 1) {
			$s28 = "";
		} else {
			$s28 = $data4['s28'];
		}
		if ($data4['s29'] < 1) {
			$s29 = "";
		} else {
			$s29 = $data4['s29'];
		}
		if ($data4['s30'] < 1) {
			$s30 = "";
		} else {
			$s30 = $data4['s30'];
		}
		if ($data4['s31'] < 1) {
			$s31 = "";
		} else {
			$s31 = $data4['s31'];
		}
		if ($data4['s32'] < 1) {
			$s32 = "";
		} else {
			$s32 = $data4['s32'];
		}
		if ($data4['s33'] < 1) {
			$s33 = "";
		} else {
			$s33 = $data4['s33'];
		}
		if ($data4['s34'] < 1) {
			$s34 = "";
		} else {
			$s34 = $data4['s34'];
		}
		if ($data4['s35'] < 1) {
			$s35 = "";
		} else {
			$s35 = $data4['s35'];
		}
		if ($data4['s36'] < 1) {
			$s36 = "";
		} else {
			$s36 = $data4['s36'];
		}
		if ($data4['s37'] < 1) {
			$s37 = "";
		} else {
			$s37 = $data4['s37'];
		}
		if ($data4['s38'] < 1) {
			$s38 = "";
		} else {
			$s38 = $data4['s38'];
		}
		if ($data4['s39'] < 1) {
			$s39 = "";
		} else {
			$s39 = $data4['s39'];
		}
		if ($data4['s40'] < 1) {
			$s40 = "";
		} else {
			$s40 = $data4['s40'];
		}
		if ($data4['tot'] < 1) {
			$tot = "";
		} else {
			$tot = $data4['tot'];
		}

		$s1a = "<input type='text' name='s1a' id='s1a$k' value='$s1' onblur='test();' readonly>";
		$s2a = "<input type='text' name='s2a' id='s2a$k' value='$s2' onblur='test();' readonly>";
		$s3a = "<input type='text' name='s3a' id='s3a$k' value='$s3' onblur='test();' readonly>";
		$s4a = "<input type='text' name='s4a' id='s4a$k' value='$s4' onblur='test();' readonly>";
		$s5a = "<input type='text' name='s5a' id='s5a$k' value='$s5' onblur='test();' readonly>";
		$s6a = "<input type='text' name='s6a' id='s6a$k' value='$s6' onblur='test();' readonly>";
		$s7a = "<input type='text' name='s7a' id='s7a$k' value='$s7' onblur='test();' readonly>";
		$s8a = "<input type='text' name='s8a' id='s8a$k' value='$s8' onblur='test();' readonly>";
		$s9a = "<input type='text' name='s9a' id='s9a$k' value='$s9' onblur='test();' readonly>";
		$s10a = "<input type='text' name='s10a' id='s10a$k' value='$s10' onblur='test();' readonly>";
		$s11a = "<input type='text' name='s11a' id='s11a$k' value='$s11' onblur='test();' readonly>";
		$s12a = "<input type='text' name='s12a' id='s12a$k' value='$s12' onblur='test();' readonly>";
		$s13a = "<input type='text' name='s13a' id='s13a$k' value='$s13' onblur='test();' readonly>";
		$s14a = "<input type='text' name='s14a' id='s14a$k' value='$s14' onblur='test();' readonly>";
		$s15a = "<input type='text' name='s15a' id='s15a$k' value='$s15' onblur='test();' readonly>";
		$s16a = "<input type='text' name='s16a' id='s16a$k' value='$s16' onblur='test();' readonly>";
		$s17a = "<input type='text' name='s17a' id='s17a$k' value='$s17' onblur='test();' readonly>";
		$s18a = "<input type='text' name='s18a' id='s18a$k' value='$s18' onblur='test();' readonly>";
		$s19a = "<input type='text' name='s19a' id='s19a$k' value='$s19' onblur='test();' readonly>";
		$s20a = "<input type='text' name='s20a' id='s20a$k' value='$s20' onblur='test();' readonly>";
		$s21a = "<input type='text' name='s21a' id='s21a$k' value='$s21' onblur='test();' readonly>";
		$s22a = "<input type='text' name='s22a' id='s22a$k' value='$s22' onblur='test();' readonly>";
		$s23a = "<input type='text' name='s23a' id='s23a$k' value='$s23' onblur='test();' readonly>";
		$s24a = "<input type='text' name='s24a' id='s24a$k' value='$s24' onblur='test();' readonly>";
		$s25a = "<input type='text' name='s25a' id='s25a$k' value='$s25' onblur='test();' readonly>";
		$s26a = "<input type='text' name='s26a' id='s26a$k' value='$s26' onblur='test();' readonly>";
		$s27a = "<input type='text' name='s27a' id='s27a$k' value='$s27' onblur='test();' readonly>";
		$s28a = "<input type='text' name='s28a' id='s28a$k' value='$s28' onblur='test();' readonly>";
		$s29a = "<input type='text' name='s29a' id='s29a$k' value='$s29' onblur='test();' readonly>";
		$s30a = "<input type='text' name='s30a' id='s30a$k' value='$s30' onblur='test();' readonly>";
		$s31a = "<input type='text' name='s31a' id='s31a$k' value='$s31' onblur='test();' readonly>";
		$s32a = "<input type='text' name='s32a' id='s32a$k' value='$s32' onblur='test();' readonly>";
		$s33a = "<input type='text' name='s33a' id='s33a$k' value='$s33' onblur='test();' readonly>";
		$s34a = "<input type='text' name='s34a' id='s34a$k' value='$s34' onblur='test();' readonly>";
		$s35a = "<input type='text' name='s35a' id='s35a$k' value='$s35' onblur='test();' readonly>";
		$s36a = "<input type='text' name='s36a' id='s36a$k' value='$s36' onblur='test();' readonly>";
		$s37a = "<input type='text' name='s37a' id='s37a$k' value='$s37' onblur='test();' readonly>";
		$s38a = "<input type='text' name='s38a' id='s38a$k' value='$s38' onblur='test();' readonly>";
		$s39a = "<input type='text' name='s39a' id='s39a$k' value='$s39' onblur='test();' readonly>";
		$s40a = "<input type='text' name='s40a' id='s40a$k' value='$s40' onblur='test();' readonly>";
		$tota = "<input type='text' name='tota' id='tota$k' value='$tot' onblur='test();' style='font-weight: bold;' readonly>";

		$entryc[]  = array(
			'jenis' => $data4['jenis'],
			'ordpk' => $data4['ordpk'],
			'ordno' => $data4['ordno'],
			'bdownpk' => $data4['bdownpk'],
			'country' => $data4['country'],
			'pono' => $po,
			'opno' => $op,
			'style' => $style,
			'color' => $color,
			'gac' => $gac,
			's1' => $s1a,
			's2' => $s2a,
			's3' => $s3a,
			's4' => $s4a,
			's5' => $s5a,
			's6' => $s6a,
			's7' => $s7a,
			's8' => $s8a,
			's9' => $s9a,
			's10' => $s10a,
			's11' => $s11a,
			's12' => $s12a,
			's13' => $s13a,
			's14' => $s14a,
			's15' => $s15a,
			's16' => $s16a,
			's17' => $s17a,
			's18' => $s18a,
			's19' => $s19a,
			's20' => $s20a,
			's21' => $s21a,
			's22' => $s22a,
			's23' => $s23a,
			's24' => $s24a,
			's25' => $s25a,
			's26' => $s26a,
			's27' => $s27a,
			's28' => $s28a,
			's29' => $s29a,
			's30' => $s30a,
			's31' => $s31a,
			's32' => $s32a,
			's33' => $s33a,
			's34' => $s34a,
			's35' => $s35a,
			's36' => $s36a,
			's37' => $s37a,
			's38' => $s38a,
			's39' => $s39a,
			's40' => $s40a,
			'tot' => $tota,
			'br' => $br
		);
	}
	$footer = array_merge($entry, $entryc, $entryb, $entryc);
	/*$atas=array_merge($header,$row);*/

	$result = array_merge($result, array('rows' => $row), array('footer' => $footer));
	echo json_encode($result);
}
if ($_GET['dt'] == "bdowns") {
	$size = "s" . $_GET['i'];
	$rs = mysqli_query($koneksi, "select bdownpk, jenis, country, pono, opno, style, color, gac, $size as size, nour
from bdown where ordpk='$ord' and $size<>'' and jenis<>'FOOTER' order by nour asc");
	$result = array();
	//$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"select jenis, country, pono, opno, style, color, gac, s1, s2, s3, s4, s5, s6, s7, s8, s9,
	//				   s10, s11, s12, s13, s14, s15, nour from bdown where ordpk='$ord' order by nour asc"));
	$row = array();
	//$k =$offset;
	while ($data = mysqli_fetch_array($rs)) {
		//$k++;
		//$btn = '<a href="#" style="text-decoration:none;">GET</a>';
		$kolom = $size;
		$row[] = array(
			'bdownpk' => $data['bdownpk'],
			'jenis' => $data['jenis'],
			'country' => $data['country'],
			'pono' => $data['pono'],
			'opno' => $data['opno'],
			'style' => $data['style'],
			'color' => $data['color'],
			'gac' => $data['gac'],
			'size' => $data['size'],
			'kolom' => $kolom,
			'action' => $btn
		);
	}
	$result = array_merge($result, array('rows' => $row));
	echo json_encode($result);
}
if ($_GET['dt'] == "kolom2") {
	$rs = mysqli_query($koneksi, "select * from kolom where sub='2' $and6 order by kolomid asc");
	$result = array();

	$row = array();
	while ($data = mysqli_fetch_array($rs)) {
		$i++;
		if ($i > 8) {
			$ck = "<input type='checkbox' name='chek' onclick='cheka$i();' id='chek$i' value='$i'>";
		} else {
			$ck = "<input type='checkbox' name='chek' onclick='cheka$i();' id='chek$i' value='$i' checked>";
		}
		$row[] = array(
			'kolompk' => $data['kolompk'],
			'kolomid' => $data['kolomid'],
			'kolomnm' => $data['kolomnm'],
			'sub' => $data['sub'],
			'ck' => $ck
		);
	}
	$result = array_merge($result, array('rows' => $row));
	echo json_encode($result);
}
if ($_GET['dt'] == "kolom3") {
	$rs = mysqli_query($koneksi, "select * from kolom where sub='3' $and6 order by kolompk asc");
	$result = array();

	$row = array();
	while ($data = mysqli_fetch_array($rs)) {
		$i = $data['kolompk'];
		$ck = "<input type='checkbox' name='chek' onclick='cheka$i();' id='chek$i' value='$i' checked>";
		$row[] = array(
			'kolompk' => $data['kolompk'],
			'kolomid' => $data['kolomid'],
			'kolomnm' => $data['kolomnm'],
			'sub' => $data['sub'],
			'ck' => $ck
		);
	}
	$result = array_merge($result, array('rows' => $row));
	echo json_encode($result);
}
if ($_GET['dt'] == "kolom4") {
	$rs = mysqli_query($koneksi, "select * from kolom where sub='4' $and6 order by kolomid asc");
	$result = array();

	$row = array();
	while ($data = mysqli_fetch_array($rs)) {
		$i++;
		$ck = "<input type='checkbox' name='chek' onclick='cheka$i();' id='chek$i' value='$i' checked>";
		$row[] = array(
			'kolompk' => $data['kolompk'],
			'kolomid' => $data['kolomid'],
			'kolomnm' => $data['kolomnm'],
			'sub' => $data['sub'],
			'ck' => $ck
		);
	}
	$result = array_merge($result, array('rows' => $row));
	echo json_encode($result);
}
if ($_GET['dt'] == "insert") {
	$rs = mysqli_query($koneksi, "SELECT * FROM po 
LEFT OUTER JOIN sup ON sup.suppk=po.suppk
WHERE YEAR(po.tglpo)>='$thn2' and po.pur='$_SESSION[login]' $and11
ORDER BY po.tglpo DESC LIMIT $rows OFFSET $offset");

	$result = array();
	$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM po 
LEFT OUTER JOIN sup ON sup.suppk=po.suppk
WHERE YEAR(po.tglpo)>='$thn2' and po.pur='$_SESSION[login]' $and11"));

	$row = array();
	while ($data = mysqli_fetch_array($rs)) {
		$btn2 = '<a href="#" style="text-decoration:none; color:#359DD9;">Select</a>';

		$row[] = array(
			'act' => $btn2,
			'popk' => $data['popk'],
			'pono' => $data['pono'],
			'supnm' => $data['supnm'],
			'suppk' => $suppk,
			'brg' => $data['brg']
		);
	}
	$result = array_merge($result, array('rows' => $row));
	echo json_encode($result);
}
if ($_GET['dt'] == "pourg") {
	$rs = mysqli_query($koneksi, "select * FROM pourg order by pourgnm asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "piunit") {
// $rs = mysqli_query($koneksi," select unita from(
// select unit as unita from munit
// union
// SELECT TRIM(podt.unit) AS unita FROM podt
// left outer join po on po.popk=podt.popk
// WHERE YEAR(po.tglpo)>='$thn2' AND podt.unit<>'' and podt.unit<>'123' and podt.unit<>'25159' 
// ) as tunit
// GROUP BY TRIM(unita) ORDER BY unita ASC");
$rs = mysqli_query($koneksi," select unit as unita from munit ORDER BY unita ASC");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "suppe") {
	$rs = mysqli_query($koneksi, "SELECT suppk,TRIM(supnm) as supnm FROM sup
WHERE supnm<>'' and local>'0' and aktif='0' GROUP BY TRIM(supnm) ORDER BY supnm ASC");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "mrevised") {
	if ($_SESSION['mat'] == 1) {
		$and3p = "and podt.kelnm='CUTTING'";
	} else {
		$and3p = "and podt.kelnm<>'CUTTING'";
	}
	$rs = mysqli_query($koneksi, "SELECT byr.byrnm,po.pono,po.brg,po.popk,fu.funm,po.dateupdt,podt.kelnm
		FROM po
		LEFT OUTER JOIN podt ON podt.popk=po.popk 
		LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
		LEFT OUTER JOIN byr ON byr.byrpk=ord.byrpk
		LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
		WHERE po.tpo2='1' and po.dateupdt BETWEEN DATE_SUB(NOW(), INTERVAL 3 MONTH) AND NOW() $and3p $andm $andkel
		GROUP BY po.popk
		ORDER BY po.dateupdt DESC LIMIT $rows OFFSET $offset");

	$result = array();
	$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "SELECT byr.byrnm, po.pono,po.popk,fu.funm,po.dateupdt,podt.kelnm
		FROM po
		LEFT OUTER JOIN podt ON podt.popk=po.popk 
		LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
		LEFT OUTER JOIN byr ON byr.byrpk=ord.byrpk
		LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
		WHERE po.tpo2='1' and po.dateupdt BETWEEN DATE_SUB(NOW(), INTERVAL 3 MONTH) AND NOW() $and3p $andm $andkel
		GROUP BY po.popk
		ORDER BY po.dateupdt DESC "));

	$row = array();
	while ($data = mysqli_fetch_array($rs)) {
		$popk = $data['popk'];
		$btn2 = "<a href='action/simpan.php?x=mempo&x1=1&po=$popk' style='text-decoration:none; color:#359DD9;'>View</a>";

		$kelnm = RTRIM($data['kelnm']);
			if ($kelnm == 'CUTTING') {
				$kelnm2 = "<div style='text-align:center;width: 45px;height: 24px;background: #359DD9;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>C</div>";
			} else if ($kelnm == 'SEWING') {
				$kelnm2 = "<div style='text-align:center;width: 45px;height: 24px;background: #19B715;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>S</div>";
			} else if ($kelnm == 'FINISHING/PACKING') {
				$kelnm2 = "<div style='text-align:center;width: 45px;height: 24px;background: #FF6B00;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>F</div>";
			} else {
				$kelnm2 = "<div></div>";
			}

		$row[] = array(
			'funm' => $data['funm'],
			'pono' => $data['pono'],
			'byrnm' => $data['byrnm'],
			'brg' => $data['brg'],
			'dateupdt' => $data['dateupdt'],
			'kelnm' => $kelnm2,
			'act' => $btn2
		);
	}
	$result = array_merge($result, array('rows' => $row));
	echo json_encode($result);
}
if ($_GET['dt'] == "freight") {
	$rs = mysqli_query($koneksi, "SELECT * FROM freight ORDER BY freightpk ASC");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}

if ($_GET['x'] == "vasnm") {
	$popk = $_POST['popk'];
	$supplier = $_POST['supplier'];
	$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM importdt
	LEFT OUTER JOIN import ON import.`importpk`=importdt.`importpk`
	left outer join vassal on vassal.vassalpk=import.vassalpk
	LEFT OUTER JOIN port ON port.portpk=import.portpk
	LEFT OUTER JOIN arrival ON arrival.arrivalpk=port.arrivalpk
	WHERE popk='$popk'
	GROUP BY importdt.importpk"));

	$shipmentb = $data['typenm'] . "," . $data['vassalnm'] . "," . $data['AWB'] . "," . $data['city'] . "," . $data['portnm']
		. "," . $data['GW'] . "," . $data['DP'] . "," . $data['DL'] . "," . $data['DT'] . "," . $data['amountbox'] . "," . tgl($data['ETDV'])
		. "," . tgl($data['ETDA']) . "," . tgl($data['EIH']) . "," . $data['importpk'] . "," . $data['supnm'];

	echo $shipmentb;
}

if ($_GET['x'] == "vasnm2") {
	$popk = $_POST['popk'];
	// $supplier = $_POST['supplier'];
	$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM importdt
	LEFT OUTER JOIN import ON import.`importpk`=importdt.`importpk`
	left outer join vassal on vassal.vassalpk=import.vassalpk
	LEFT OUTER JOIN port ON port.portpk=import.portpk
	LEFT OUTER JOIN arrival ON arrival.arrivalpk=port.arrivalpk
	WHERE importdt.popk='$popk' 
	GROUP BY import.importpk
	ORDER BY import.importpk DESC LIMIT 1"));

	$shipmentb = $data['typenm'] . "," . $data['vassalnm'] . "," . $data['AWB'] . "," . $data['city'] . "," . $data['portnm']
		. "," . $data['GW'] . "," . $data['DP'] . "," . $data['DL'] . "," . $data['DT'] . "," . $data['amountbox'] . "," . tgl($data['ETDV'])
		. "," . tgl($data['ETDA']) . "," . tgl($data['EIH']) . "," . $data['importpk'] . "," . $data['supnm'];

	echo $shipmentb;
}

if ($_GET['dt'] == "mpay") {
	$rs = mysqli_query($koneksi, "select * FROM mpay order by paynm asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		array_push($result, $row);
	}
	echo json_encode($result);
}
if ($_GET['dt'] == "costing") {
	$sql = mysqli_query($koneksi, "SELECT SUM(tot) AS tot FROM bdown WHERE ordpk='$_POST[ordpk]' and tot>'0' and color<>'' AND jenis LIKE '%DETAIL%' GROUP BY ordpk");
	$dtsql = mysqli_fetch_array($sql);
	$totqty = $dtsql['tot'];

	$sqlb = mysqli_query($koneksi, "SELECT * FROM costing WHERE ordpk='$_POST[ordpk]'");
	$dtsqlb = mysqli_fetch_array($sqlb);
	$cm = $dtsqlb['CM'];
	$mat = $dtsqlb['materials'];
	$other = $dtsqlb['others'];

	if($dtsqlb['dateupdt']>0 && $dtsqlb['dateupdt']<>"0000-00-00"){
	$tglupdt = tgl2($dtsqlb['dateupdt']);
	} else {
	$tglupdt = "";
	}

	$fob = $dtsqlb['CM'] + $dtsqlb['materials'] + $dtsqlb['others'];

	$totsales = $fob * $dtsql['tot'];

	$bulkmat = $totqty * $mat;
	$bulkcm = $totqty * $cm;
	$bulkother = $totqty * $other;

	$tot1 = $cm + $mat + $other;
	$tot2 = $bulkcm + $bulkmat + $bulkother;

	// $est=$totsales-$tot2;

	/*totpo*/
	$sqlk = mysqli_query($koneksi, "select * from kurs order by kurspk desc limit 1");
	$dtk = mysqli_fetch_array($sqlk);

	$crr2 = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from podt where ordpk='$_POST[ordpk]' and curpk='1' and delsts='0' and stspk<>'7' group by ordpk");
	$dtr2 = mysqli_fetch_array($crr2);
	$totrp2 = $dtr2['totrkb'] / $dtk['rupiah'];

	$cre2 = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from podt where ordpk='$_POST[ordpk]' and curpk='3' and delsts='0' and stspk<>'7' group by ordpk");
	$dte2 = mysqli_fetch_array($cre2);
	$toteu2 = $dte2['totrkb'] / $dtk['euro'];

	$crp2 = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from podt where ordpk='$_POST[ordpk]' and curpk='6' and delsts='0' and stspk<>'7' group by ordpk");
	$dtp2 = mysqli_fetch_array($crp2);
	$totp2 = $dtp2['totrkb'] / $dtk['pounds'];

	$crd2 = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from podt where ordpk='$_POST[ordpk]' and curpk='2' and delsts='0' and stspk<>'7' group by ordpk");
	$dtd2 = mysqli_fetch_array($crd2);
	$totd2 = $dtd2['totrkb'];

	$totpo1 = $totrp2 + $toteu2 + $totp2 + $totd2;

	$crr = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from rkb where ordpk='$_POST[ordpk]' and curpk='1' and spec<>'' and popk>'0' and stspk<>'7' group by ordpk");
	$dtr2 = mysqli_fetch_array($crr);
	$totrp = $dtr2['totrkb'] / $dtk['rupiah'];

	$cre = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from rkb where ordpk='$_POST[ordpk]' and curpk='3' and spec<>'' and popk>'0' and stspk<>'7' group by ordpk");
	$dte2 = mysqli_fetch_array($cre);
	$toteu = $dte2['totrkb'] / $dtk['euro'];

	$crp = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from rkb where ordpk='$_POST[ordpk]' and curpk='6' and spec<>'' and popk>'0' and stspk<>'7' group by ordpk");
	$dtp2 = mysqli_fetch_array($crp);
	$totp = $dtp2['totrkb'] / $dtk['pounds'];

	$crd = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from rkb where ordpk='$_POST[ordpk]' and curpk='2' and spec<>'' and popk>'0' and stspk<>'7' group by ordpk");
	$dtd2 = mysqli_fetch_array($crd);
	$totd = $dtd2['totrkb'];

	$totalRkb = $totrp+ $toteu + $totp + $totd;

  $perUnitRkb = ($totqty > 0) ? ($totalRkb / $totqty) : 0;

	$sqle = mysqli_query($koneksi, "SELECT YEAR(datecreate) as thn FROM ord WHERE ordpk='$_POST[ordpk]'");
	$dtsqle = mysqli_fetch_array($sqle);

	//Sample
	include "../config/koneksisample.php";
	$sqlc = mysqli_query($koneksi, "SELECT * FROM status 
	WHERE style LIKE '%$_GET[style]%' and YEAR(date)='$dtsqle[thn]' and stagepk<>'5' and progrespk='6' and samplenm NOT LIKE '%SMS%' and samplenm NOT LIKE '%Marketing Sample%'
	ORDER BY statuspk DESC LIMIT 1");
	$dtsqlc = mysqli_fetch_array($sqlc);

	$sqld = mysqli_query($koneksi, "SELECT SUM(qty) AS tqty FROM size WHERE statuspk='$dtsqlc[statuspk]'");
	$dtsqld = mysqli_fetch_array($sqld);

	$qtysample = $dtsqld['tqty'];
	$tcmsample = $cm * $dtsqld['tqty'];
	$tmatsample = $mat * $dtsqld['tqty'];
	$samplecost = $tcmsample + $tmatsample;

	// $est=$totsales-$totpo1-$samplecost-$bulkcm;
	$est = $totsales - $totpo1 - $bulkcm;

	if($totsales>0){
	$perpo = ($totpo1 / $totsales) * 100;
	$percm = ($bulkcm / $totsales) * 100;
	$perest = ($est / $totsales) * 100;

	$perpo = number_format($perpo, 2, ".", ",");
	$percm = number_format($percm, 2, ".", ",");
	$perest = number_format($perest, 2, ".", ",");
	}

	$per_unit_po = ($totqty > 0) ? ($totpo1 / $totqty) : 0;

	$costsum = $totqty. "," .$cm. "," .$mat. "," .$other. "," .$fob. "," . $totsales . "," .$bulkmat. "," .$bulkcm. "," .$tot1. "," 
	.$tot2. "," .$est. "," .$samplecost. "," .$tglupdt.",".$qtysample.",".$totpo1.",".$bulkother.",".$perpo.",".$percm.",".$perest.",". $per_unit_po.",".$totalRkb.",".$perUnitRkb;

	echo $costsum;
}
if ($_GET['dt'] == "srno") {
	$input = $_GET['input'];
	$result = mysqli_query($koneksi11s, "SELECT request.srno FROM request
left outer join status on status.srpk=request.srpk
where request.srno like '%$input%' group by request.srno order by srno asc");
	$suggestions = array();
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$suggestions[] = $row['srno'];
		}
	}
	echo json_encode($suggestions);
}
if ($_GET['x'] == "ckpo") {
	$popk = $_GET['popk'];
	$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT unit, unit2 FROM podt 
			WHERE popk='$popk' 
			GROUP BY popk"));

	$unit = $data['unit'] . "," . $data['unit2'];

	echo $unit;
}
if ($_GET['x'] == "stsprod") {
	$ordpk = $_GET['ordpk'];
	$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT stsprod FROM ord 
			WHERE ordpk='$ordpk'"));

	$stsprod = $data['stsprod'];

	echo $stsprod;
}
if ($_GET['dt'] == "mtype") {
	// $rs = mysqli_query($koneksi, "select * from mtype order by mgroup asc, typenm asc");
	$rs = mysqli_query($koneksi, "select * from mtype order by typenm asc");
	$result = array();
	while ($row = mysqli_fetch_object($rs)) {
		$result[] = $row;
	}
	echo json_encode($result);
}
if ($_GET['x'] == "mtype2") {
	$id = $_POST['id'];
	$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT mgroup FROM mtype WHERE mtypepk='$id'"));

	$mgroup = $data['mgroup'];

	echo $mgroup;
}

if ($_GET['dt'] == "colorBdown") {
    // Pastikan header adalah JSON
    header('Content-Type: application/json');
    
    // Ambil ordpk, beri default string kosong jika tidak ada
    $ordpk = isset($_GET['ord']) ? mysqli_real_escape_string($koneksi, $_GET['ord']) : '';
    
    if (empty($ordpk)) {
        echo json_encode([array("valCol" => "ALL COLOR", "textCol" => "ALL COLOR")]);
        exit;
    }

    $all_colors = array();

    // 1. Ambil warna dari tabel bdown
    $sql_bdown = "SELECT DISTINCT color FROM bdown 
                  WHERE ordpk = '$ordpk' AND color IS NOT NULL AND color != ''";
    $rs_bdown = mysqli_query($koneksi, $sql_bdown);
    while ($row = mysqli_fetch_object($rs_bdown)) {
        $color = trim($row->color);
        if ($color != "" && strtoupper($color) != "ALL COLOR") {
            $all_colors[] = $color;
        }
    }

    // 2. Ambil itemadd dari tabel rkb
    $sql_rkb = "SELECT itemadd FROM rkb 
                WHERE ordpk = '$ordpk' AND itemadd IS NOT NULL AND itemadd != ''";
    $rs_rkb = mysqli_query($koneksi, $sql_rkb);
    while ($row = mysqli_fetch_object($rs_rkb)) {
        $exploded = explode(',', $row->itemadd);
        foreach ($exploded as $c) {
            $color = trim($c);
            if ($color != "" && strtoupper($color) != "ALL COLOR") {
                $all_colors[] = $color;
            }
        }
    }

    // 3. Bersihkan duplikat dan urutkan
    $unique_colors = array_unique($all_colors);
    sort($unique_colors);

    // 4. Format hasil
    $final_result = array();
    $final_result[] = array("valCol" => "ALL COLOR", "textCol" => "ALL COLOR");

    foreach ($unique_colors as $color) {
        $final_result[] = array(
            "valCol" => $color,
            "textCol" => $color
        );
    }

    echo json_encode($final_result);
    exit;
}


if ($_GET['dt'] == "item") {
	$input = TRIM($_GET['input']);
	$result = mysqli_query($koneksi, "SELECT TRIM(item) as item, TRIM(spec) as spec FROM rkb
	where item like '%$input%' and YEAR(hari1)>='$thn2' group by item order by item asc");
	$suggestions = array();
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$suggestions[] = [
                'item' => $row['item'],
                'spec' => $row['spec']
            ];
		}
	}
	echo json_encode($suggestions);
}
