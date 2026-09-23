<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
ini_set('max_execution_time', 0);
date_default_timezone_set('Asia/Jakarta');
session_start();
include "config/admin_session.php";
include "config/truncate.php";
include "config/tanggal.php";
include "config/tanggal2.php";
include "config/ip.php";
include "config/koneksi.php";
include "config/koneksi4b.php";
//require "config/vendor/autoload.php";
?>
<html>
<head>
<link rel="shortcut icon" href="css/images/morich.gif"/>	
<title>Morich Indo Fashion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" media="screen" href="css/styleku.css">
<link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/themes/gray/easyui.css">
<!-- <link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/themes/default/easyui.css"> -->
<link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/themes/icon.css">
<link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/themes/color.css">
<!--<link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/demo/demo.css">-->
<script type="text/javascript" src="media/jquery-easyui-1.9.15/jquery.min.js"></script>
<!--<script type="text/javascript" src="media/jquery-easyui-1.9.15/jquery-1.9.1.min.js"></script>-->
<script type="text/javascript" src="media/jquery-easyui-1.9.15/jquery.easyui.min.js"></script>
<script type="text/javascript" src="media/jquery-easyui-1.9.15/jquery.edatagrid.js"></script>
<script type="text/javascript" src="media/jquery-easyui-1.9.15/datagrid-groupview.js"></script>
<script type="text/javascript" src="media/jquery-easyui-1.9.15/datagrid-detailview.js"></script>
<!--<link rel="stylesheet" type="text/css" href="media/DataTables/Bootstrap-3.3.7/css/bootstrap.min.css" />
<script type="text/javascript" src="media/DataTables/Bootstrap-3.3.7/js/bootstrap.min.js"></script>-->
<script type="text/javascript">
function mm() {
$('#dialog-formm').dialog('open').dialog('setTitle','');
$('#formm').form('load',row);
}

function cancel2m(){
$('#dialog-formm').dialog('close');
}

function Searchc2m(){
  $('#dg2b2').datagrid('load',{
    carim: $('#carim').val()
    });
}
</script>
</head>
<body>
<div id="utama" onmousemove="tnew();">
<div><?php include "header.php"; ?></div>
<div align="center"><?php include "content.php"; ?></div>
</div>

<!--notif-->
<div id="dropdwn">
<div id="myDropdown1" class="dropdwn-content1" style="height:auto; text-align:left;">
<?php
if($_SESSION['guser']==3){
if($_SESSION['mat']==1) { $and3="and rpo.kelnm='CUTTING'"; }
else { $and3="and rpo.kelnm<>'CUTTING'"; $and3b="and rpo.kelnm like '%sewing%'"; }
$ckb=mysqli_query($koneksi,"SELECT byr.byrnm, po.pono,po.popk,fu.funm,po.dateupdt,rpo.kelnm,po.brg
FROM po
LEFT OUTER JOIN podt ON podt.popk=po.popk 
LEFT OUTER JOIN rpo ON rpo.rpopk=podt.rpopk
LEFT OUTER JOIN ord ON ord.ordpk=rpo.ordpk
LEFT OUTER JOIN byr ON byr.byrpk=ord.byrpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
WHERE po.tpo2='1' $and3 $and3b
GROUP BY po.popk
ORDER BY po.dateupdt DESC");
$tt=mysqli_num_rows($ckb);
$cka=mysqli_query($koneksi,"SELECT byr.byrnm, po.pono,po.popk,fu.funm,po.dateupdt,rpo.kelnm,po.brg
FROM po
LEFT OUTER JOIN podt ON podt.popk=po.popk 
LEFT OUTER JOIN rpo ON rpo.rpopk=podt.rpopk
LEFT OUTER JOIN ord ON ord.ordpk=rpo.ordpk
LEFT OUTER JOIN byr ON byr.byrpk=ord.byrpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
WHERE po.tpo2='1' $and3 $and3b
GROUP BY po.popk
ORDER BY po.dateupdt DESC LIMIT 5");
while($dta=mysqli_fetch_array($cka)){
?>
<div class="memo" style=""><?php echo $dta['funm']; ?> made a revision.</div>
<div class="" style="font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">
PO <?php echo $dta['pono']; ?>, <?php echo $dta['byrnm']; ?></div>
<div class="memo" style=""><?php echo $dta['brg']; ?></div>
<div class="tgl-memo" style=""><?php echo $dta['dateupdt']; ?></div>
<div style="font-size: 14px; text-align:right; margin-top:-40px; padding:15px;">
<a href="action/simpan.php?x=mempo&x1=1&po=<?php echo $dta['popk'];?>" style="text-decoration:none; color:#359DD9;">View</a>
</div>
<hr style="height:1px; width:385px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
<?php }
if($tt>5){
$style='style="text-decoration:none; color:#359DD9;cursor:pointer"';
} else {
$style='style="text-decoration:none; color:#359DD9;display:none;"';   
}
?>
<div <?php echo $style; ?> onclick="mm();">Show More</div>
<?php } else {
if($_SESSION['spv']==1){ $and=""; }
else { $and="and ord.userpk='$_SESSION[user]'"; }
$cek1=mysqli_query($koneksi,"select rkb.ordpk, memo.tgl2, ord.ordno from memo
left outer join rkb on rkb.rkbpk=memo.rkbpk
left outer join ord on ord.ordpk=rkb.ordpk
where memo.fupk='$_SESSION[fu]' and memo.cek='1' and rkb.status='3' $and
group by rkb.ordpk order by memo.tgl2 desc limit 5");
while($dt1=mysqli_fetch_array($cek1)){
$cek2=mysqli_query($koneksi,"select memo.tgl2 from memo
left outer join rkb on rkb.rkbpk=memo.rkbpk
left outer join ord on ord.ordpk=rkb.ordpk
where memo.fupk='$_SESSION[fu]' and memo.cek='1' and rkb.status='3' and rkb.ordpk='$dt1[ordpk]'
order by memo.tgl2 desc limit 1");
$dt2=mysqli_fetch_array($cek2);

$totm = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$dt1[ordpk]' and rkb.status='3' and rkb.stspk is null"));
if($totm>0){
?>
<div class="memo" style=""><?php echo $totm; ?> items have been sent to you for revision.</div>
<div class="memo" style="">Order no <?php echo $dt1['ordno']; ?></div>
<div class="tgl-memo" style=""><?php echo $dt1['tgl2']; ?></div>
<div style="font-size: 14px; text-align:right; margin-top:-40px; padding:15px;">
<a href="?hal=detmat&dt=3&ord=<?php echo $dt1['ordpk']; ?>" style="text-decoration:none; color:#359DD9;">View</a>
</div>
<hr style="height:1px; width:385px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
<?php }
}
}?>
</div>
</div>

<!-- memo more -->
<div id="dialog-formm" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,resizable:false,modal:true,closable:false"
style="width:884px;height:575px;padding:5px 5px;display:none;top:15px">
<div class="modal-dialog2" style="width:98%; height:96%; overflow-y:scroll;overflow-x:hidden;">
<form id="formm" method="post">
    <div class="modal-content">
        	<!-- Modal Header -->
            <div class="modal-header">
            <div class="modal-title2" style="margin-top:15px;">
            <div style="font-size:16px; font-weight:bold;">Revision From Merchandiser</div><br>
			<div style="margin-top:-45px;">
			<a href="javascript:void(0)" style="text-decoration:none; color:#000; font-size:28px; margin-left:800px;" onclick="cancel2m();"> X</a>
			</div>
   <div class="content-search4" style="margin-top:-17px;">
			<div id="frame-cari4">
			<img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button" >
   <input id="carim" placeholder="Search..." class="input" onkeyup="Searchc2m();">
			</div>
			</div>
			</div>
    </div>
    <!-- Modal body -->
    <div class="border-modal2" style="border:none;">
    <div style="padding:5px;">
    <div id="tabel2b" onclick="importdata2();" style="">
    <table id="dg2b2" class="easyui-datagrid" title="" style="width:100%;height:425px;" align="center"
    url="view/get_data.php?dt=mrevised" toolbar="#tb" striped="true"
    pageSize="100" pageList="[100,200,300,500]" pagination="true" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" method="post">
    <thead>
    <tr>
    <th field="funm" width="100" sortable="true">From</th>
    <th field="pono" width="100" sortable="true">PO no</th>
    <th field="byrnm" width="150" sortable="true">Buyer</th>
    <th field="brg" width="210" sortable="true">Item</th>
    <th field="dateupdt" width="150" sortable="true">Update date</th>
	<th field="act" width="100" sortable="false">Action</th>
    </tr>
    </thead>
    </table>
    </div>
	   </div>
    </div>
    </div>
</form>
</div>
</div>
</body>
</html>