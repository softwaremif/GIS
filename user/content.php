<?php
//include "action/sinkron5.php";
?>
<!-- Detail -->
<div id="atas" onmousemove="" onclick="
<?php if($_GET['hal']<>"qty"){ ?>
/*$('#menu').hide();
$('#dg').datagrid('clearSelections');
$('#dg2').datagrid('clearSelections');
$('#dg3a').datagrid('clearSelections');
$('#dg3b').datagrid('clearSelections');*/
<?php } ?>
/*$('#dg').edatagrid('cancelRow');
$('#dg').datagrid('reload');*/">
<?php
$style="border-bottom:  3px solid #000000;color: #000000;";
$ord=$_GET['ord'];
$po=$_GET['po'];
$spv=$_SESSION['spv'];
$thn2=date("Y");
$bln2=date("m");
?>
<input type="text" name="spv" id="spv" value="<?php echo $spv; ?>" size="5">
<?php
if($_SESSION['gusernm']=="fu"){
if($_GET['hal']=="order"){
?>
<div id="judul">
Order list
<a style="text-decoration:none; left:145px; top: -5px;width: 200px;" href="?hal=sum" class="button-request-po" onclick="">View order summary report</a>
</div>
<?php } else if($_GET['hal']=="sum"){ ?>
<div id="frame-utama-judul">
<div class="frame-arrow">
<a href="?hal=order"><input type="image" src="css/images/Vector2.png" class="panah-samping" style="margin-left:0px;"></a>  
</div>
<div class="frame-judul" align="left" style="margin-left:-20px;">
<div class="font-judul-atas" style="top:10px;right:0px; font-weight:normal; font-size:16px;"><a href="?hal=order" style="text-decoration:none;color:#000000;">Back</a></div>
<div class="font-judul-bawah" style="top:35px;right:30px;width:auto;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
Order summary report
</div>
<div class="font-judul-bawah" style="top:45px;right:30px;width:auto;font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
Quick summary report of orders that have been shipped in a certain period
</div>
</div>
</div>
<?php } else if($_GET['hal']=="list"){ ?>
<div id="frame-utama-judul" style="top:75px;">
<div class="frame-arrow">
<a href="?hal=order"><input type="image" src="css/images/Vector2.png" class="panah-samping" style="margin-left:0px;"> </a>
</div>
<div class="frame-judul" align="left" style="margin-left:-20px;">
<div class="font-judul-atas" style="top:10px;right:0px; font-weight:normal; font-size:16px;"><a href="?hal=order" style="text-decoration:none;color:#000000;">Back</a></div>
<div class="font-judul-bawah" style="top:35px;right:30px;width:auto;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
Order list assignment
</div>
<div class="font-judul-bawah" style="top:65px;right:30px;width:auto;font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
Below are list of orders that have been created by you or your team members. <br>
You can adjust the assignments to see which person can access which order.
</div>
</div>
</div>
<?php } else {
if($_GET['hal']=="proses"){ }
else if($_GET['hal']=="assign"){ }
else if($_GET['hal']=="assign2"){ }
else if($_GET['hal']=="proses2"){ }
else if($_GET['hal']=="detpomd"){ }
else if($_GET['hal']=="detpopur"){ }
else {
$cari=mysqli_query($koneksi,"select byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno,
ord.artno, ord.prodes, ord.season, ord.buymonth, ord.deldate, ord.codate, ord.ordpk
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord'");
$dt=mysqli_fetch_array($cari);

$tot1= mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord'"));

$tot1b= mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.stspk is null and rkb.status<='3'"));

$tot3= mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join rpo on rpo.rkbpk=rkb.rkbpk
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=podt.popk
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.status>='3'
group by rkb.rkbpk"));

$tot3b= mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.status='6'"));

$tot2a = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status='1' and rkb.stspk is null"));

$tot2b = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status='2' and rkb.stspk is null"));

$tot2c = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status='3' and rkb.stspk is null"));
?>
<div id="frame-utama-judul">
<div class="frame-arrow">
<a href="?hal=order"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>  
</div>
<div class="frame-judul" style="width:150px;">
<div class="font-judul-atas">Order
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt['ordno']); ?>" class="easyui-tooltip">
&nbsp;<?php echo truncate(TRIM($dt['ordno']),8); ?>
</a>
</div>
<div class="font-judul-bawah" style="width:250px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt['byrnm']); ?>" class="easyui-tooltip">
<?php echo truncate(TRIM($dt['byrnm']),5); ?>
</a>
, Season
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title=" <?php echo TRIM($dt['season']); ?>" class="easyui-tooltip">
&nbsp;<?php echo truncate(TRIM($dt['season']),6); ?>
</a>
</div>
</div>
<table width="auto" height="50px" border="0px" style="margin-left:5px;">
<tr>
<th width="75px" align="left" style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
MD
</th>
<th width="85px" align="left" style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
Article
</th>
<th width="75px" align="left" style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
SR No.
</th>
<th width="250px" align="left" style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
Product
</th>
</tr>
<tr>
<td style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
<?php echo $dt['funm']; ?>
</td>
<td style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt['artno']); ?>" class="easyui-tooltip">
<?php echo truncate(TRIM($dt['artno']),8); ?>
</a>
</td>
<td style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;">
<?php echo $dt['srno']; ?>
</a>
</td>
<td style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt['prodes']); ?>" class="easyui-tooltip">
<?php echo truncate(TRIM($dt['prodes']),25); ?>
</a>
</td>
</tr>
</table>
<!--<div class="frame-utama-md">
<font class="md">MD</font>
<font class="nm-md"><?php //echo $dt['funm']; ?></font>
</div>
<div class="frame-utama-article">
<font class="article">Article</font>
<font class="article-number">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;" title="<?php //echo TRIM($dt['artno']); ?>" class="easyui-tooltip">
<?php //echo truncate(TRIM($dt['artno']),8); ?>
</a>
</font>
</div>
<div class="frame-utama-Product">
<font class="product">Product</font>
<font class="dt-product">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;" title="<?php //echo TRIM($dt['prodes']); ?>" class="easyui-tooltip">
<?php //echo truncate(TRIM($dt['prodes']),15); ?>
</a>
</font>
</div>-->
</div>
<div id="frame-menu-detail" style="width:100%;height:auto;">
<!--breakdwownqty-->
<a href="?hal=qty&ord=<?php echo $ord; ?>" class="link" style="<?php if($_GET['hal']=="qty"){ echo $style;} ?>">Order breakdown</a>
<!--allmaterial-->
<a href="?hal=mat&ord=<?php echo $ord; ?>" class="link" style="<?php if($_GET['hal']=="mat"){ echo $style;} ?>">
<?php if($_GET['hal']=="mat"){ ?> All materials <span id="tmat1">(<?php echo $tot1; ?>)</span> <span id="tmat" style="display:none;"></span>
<?php } else { ?> All materials (<?php echo $tot1; ?>) <?php } ?> </a>
<!--workedon-->
<a href="?hal=detmat&dt=1&ord=<?php echo $ord; ?>" class="link2" style="<?php if($_GET['hal']=="detmat"){ echo $style;} ?>">
Worked on (<?php echo $tot1b; ?>)
<?php if($_GET['dt']>1){ ?>
<span id="ntwork" style="display:none;"><img src="css/images/notiff.png" width="8px" height="8px"></span>
<?php } else {
if($tot2b>0 || $tot2c>0){    
?>
<img src="css/images/notiff.png" width="8px" height="8px">
<?php }
} ?>
</a>
<!--purchasing-->
<a href="?hal=pur&ord=<?php echo $ord; ?>" class="link" style="<?php if($_GET['hal']=="pur"){ echo $style;} ?>">
<?php if($_GET['hal']=="pur"){ ?> Purchasing <span id="tpur1">(<?php echo $tot3; ?>)</span> <span id="tpur" style="display:none;"></span>
<?php } else { ?> Purchasing (<?php echo $tot3; ?>) <?php } ?> </a>
<!--end-->
</div>
<?php if($_GET['hal']=="detmat"){ ?>
<div id="frame-menu-detail"  style="margin-left:-55%; margin-top:52px; width:100%; height:auto;">
<!--inprogress-->
<a href="?hal=detmat&dt=1&ord=<?php echo $ord; ?>" class="link2" style="<?php if($_GET['dt']=="1"){ echo $style; } ?>">
<?php if($_GET['dt']==1){ ?> IN PROGRESS <span id="tprogress1">(<?php echo $tot2a; ?>)</span> <span id="tprogress" style="display:none;"></span>
<?php } else { ?> IN PROGRESS (<?php echo $tot2a; ?>) <?php } ?> </a>
<!--readyforpo-->
<a href="?hal=detmat&dt=2&ord=<?php echo $ord; ?>" class="link2" style="<?php if($_GET['dt']=="2"){ echo $style; } ?>">
<?php if($_GET['dt']==2){ ?> READY FOR PO <span id="tready1">(<?php echo $tot2b; ?>)</span> <span id="tready" style="display:none;"></span>
<?php } else { ?> READY FOR PO (<?php echo $tot2b; ?>) <?php } ?> </a>
<!--needrevision-->
<?php if($tot2c>0){ ?>
<a href="?hal=detmat&dt=3&ord=<?php echo $ord; ?>" class="link2" style="<?php if($_GET['dt']=="3"){ echo $style; } ?>">
<?php if($_GET['dt']==3){ ?> NEED REVISION <span id="trevisi1">(<?php echo $tot2c; ?>)</span> <span id="trevisi" style="display:none;"></span>
<?php } else { ?> NEED REVISION (<?php echo $tot2c; ?>) <?php } ?> </a>
<?php } ?>
<!--tab2-->
</div>
<?php   
}
}
}
} else {
if($_SESSION['mat']==1) { $and3="and rpo.kelnm='CUTTING'"; }
else { $and3="and rpo.kelnm<>'CUTTING'"; $and3b="and rpo.kelnm like '%sewing%'"; }

$tot1= mysqli_num_rows(mysqli_query($koneksi,"SELECT *  FROM rpo
LEFT OUTER JOIN ord ON ord.ordpk=rpo.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=rpo.suppk
LEFT OUTER JOIN cur ON  cur.curpk=rpo.curpk
WHERE rpo.stspk='1' and rpo.popros='0' and ord.fupk<>'' and rpo.rkbpk<>'' and rpo.item<>'' and YEAR(rpo.tgl)='$thn2' $and3 $and3b"));

/*
$tot4= mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
WHERE rpo.stspk='7' and ord.fupk<>'' and rpo.rkbpk<>'' and rpo.item<>'' and YEAR(rpo.tgl)='$thn2' and MONTH(rpo.tgl)='$bln2' $and3"));
*/

$tot2= mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM po
left outer join sup on sup.suppk=po.suppk
left outer join podt on podt.popk=po.popk
left outer join cur on cur.curpk=podt.curpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
left outer join rpo on rpo.rpopk=podt.rpopk
WHERE po.pur='$_SESSION[login]' and po.postatpk between '1' and '3' and rkb.status between '3' and '6' and YEAR(po.tglpo)='$thn2'
group by po.popk"));

$tot2b= mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM po
left outer join sup on sup.suppk=po.suppk
left outer join podt on podt.popk=po.popk
left outer join cur on cur.curpk=podt.curpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
left outer join rpo on rpo.rpopk=podt.rpopk
WHERE po.pur='$_SESSION[login]' and po.postatpk between '1' and '3' and rkb.status between '3' and '6' and YEAR(po.tglpo)='$thn2'
and po.tpo1='1'
group by po.popk"));

$tot3b= mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM po
left outer join sup on sup.suppk=po.suppk
left outer join podt on podt.popk=po.popk
left outer join cur on cur.curpk=podt.curpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
left outer join rpo on rpo.rpopk=podt.rpopk
WHERE po.pur='$_SESSION[login]'and po.postatpk='4' and rkb.status='6' and YEAR(po.tglpo)='$thn2'
and po.tpo1='1'
group by po.popk"));

$tot3= mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM po
left outer join sup on sup.suppk=po.suppk
left outer join podt on podt.popk=po.popk
left outer join cur on cur.curpk=podt.curpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
left outer join rpo on rpo.rpopk=podt.rpopk
WHERE po.pur='$_SESSION[login]' and po.postatpk='4' and rkb.status='6' and YEAR(po.tglpo)='$thn2'
group by po.popk"));
?>
<!-- Detail -->

<?php
if($_GET['hal']=="detpo"){ 
} else if($_GET['hal']=="dford"){
?>
<div id="judul">
Order list
</div>
<?php } else if($_GET['hal']=="dfqty" || $_GET['hal']=="dfmat"){
$cari=mysqli_query($koneksi,"select byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno,
ord.artno, ord.prodes, ord.season, ord.buymonth, ord.deldate, ord.codate, ord.ordpk
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.ordpk='$ord'");
$dt=mysqli_fetch_array($cari);

$tot1= mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.ordpk='$ord'"));

$tot1b= mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.ordpk='$ord' and rkb.stspk is null and rkb.status<='3'"));

$tot3= mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join rpo on rpo.rkbpk=rkb.rkbpk
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=podt.popk
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status>='3'
group by rkb.rkbpk"));

$tot3b= mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status='6'"));

$tot2a = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status='1' and rkb.stspk is null"));

$tot2b = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and rkb.status='2' and rkb.stspk is null"));

$tot2c = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and rkb.status='3' and rkb.stspk is null"));
?>
<div id="frame-utama-judul">
<div class="frame-arrow">
<a href="?hal=dford"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>  
</div>
<div class="frame-judul" style="width:150px;">
<div class="font-judul-atas">Order
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt['ordno']); ?>" class="easyui-tooltip">
&nbsp;<?php echo truncate(TRIM($dt['ordno']),8); ?>
</a>
</div>
<div class="font-judul-bawah" style="width:250px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt['byrnm']); ?>" class="easyui-tooltip">
<?php echo truncate(TRIM($dt['byrnm']),5); ?>
</a>
, Season
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title=" <?php echo TRIM($dt['season']); ?>" class="easyui-tooltip">
&nbsp;<?php echo truncate(TRIM($dt['season']),6); ?>
</a>
</div>
</div>
<table width="auto" height="50px" border="0px" style="margin-left:5px;">
<tr>
<th width="75px" align="left" style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
MD
</th>
<th width="85px" align="left" style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
Article
</th>
<th width="75px" align="left" style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
SR No.
</th>
<th width="250px" align="left" style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
Product
</th>
</tr>
<tr>
<td style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
<?php echo $dt['funm']; ?>
</td>
<td style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt['artno']); ?>" class="easyui-tooltip">
<?php echo truncate(TRIM($dt['artno']),8); ?>
</a>
</td>
<td style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;">
<?php echo $dt['srno']; ?>
</a>
</td>
<td style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt['prodes']); ?>" class="easyui-tooltip">
<?php echo truncate(TRIM($dt['prodes']),25); ?>
</a>
</td>
</tr>
</table>
<!--<div class="frame-utama-md">
<font class="md">MD</font>
<font class="nm-md"><?php //echo $dt['funm']; ?></font>
</div>
<div class="frame-utama-article">
<font class="article">Article</font>
<font class="article-number">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;" title="<?php //echo TRIM($dt['artno']); ?>" class="easyui-tooltip">
<?php //echo truncate(TRIM($dt['artno']),8); ?>
</a>
</font>
</div>
<div class="frame-utama-Product">
<font class="product">Product</font>
<font class="dt-product">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;" title="<?php //echo TRIM($dt['prodes']); ?>" class="easyui-tooltip">
<?php //echo truncate(TRIM($dt['prodes']),15); ?>
</a>
</font>
</div>-->
</div>
<div id="frame-menu-detail" style="width:100%;height:auto;">
<!--breakdwownqty-->
<a href="?hal=dfqty&ord=<?php echo $ord; ?>" class="link" style="<?php if($_GET['hal']=="dfqty"){ echo $style;} ?>">Order breakdown</a>
<!--allmaterial-->
<a href="?hal=dfmat&ord=<?php echo $ord; ?>" class="link" style="<?php if($_GET['hal']=="dfmat"){ echo $style;} ?>">
<?php if($_GET['hal']=="dfmat"){ ?> All materials <span id="tmat1">(<?php echo $tot1; ?>)</span> <span id="tmat" style="display:none;"></span>
<?php } else { ?> All materials (<?php echo $tot1; ?>) <?php } ?> </a>
</div>
<?php } else if($_GET['hal']=="dfpo"){ ?>
<div id="judul">Purchase orders</div>
<?php } else if($_GET['hal']=="dtpo"){ 
} else if($_GET['hal']=="sum"){ ?>
<div id="frame-utama-judul">
<div class="frame-arrow"> 
</div>
<div class="frame-judul">
<div class="font-judul-bawah" style="top:20px;left:-55px;width:auto;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
Order summary report
</div>
<div class="font-judul-bawah" style="top:25px;left:-55px;width:auto;font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
Quick summary report of orders that have been shipped in a certain period
</div>
</div>
</div>
<?php }  else if($_GET['hal']=="log"){ ?>
<div id="frame-utama-judul">
<div class="frame-arrow"> 
</div>
<div class="frame-judul">
<div class="font-judul-bawah" style="top:20px;left:-55px;width:auto;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
Log activity user
</div>
</div>
</div>
<?php } else {
if($_GET['hal']=="new"){ ?>
<div id="judul">PO requests</div>
<?php } else if($_GET['hal']=="assign3"){ ?>
<div id="judul"></div>
<?php } else { ?>
<div id="judul">Purchase orders</div>
<?php } ?>
<!--tab-->
<?php if($_GET['hal']=="assign3"){
} else { ?>
<div id="frame-menu-detail" style="width:100%;height:auto;">
<!--new-->
<a href="?hal=new" class="link" style="<?php if($_GET['hal']=="new"){ echo $style; } ?>">
<?php if($_GET['hal']=="new"){ ?> New requests <span id="tnew1">(<?php echo $tot1; ?>)
<?php if($tot1>0){ ?>
<img src="css/images/notiff.png" width="8px" height="8px">
<?php
}
?>
</span>
<span id="tnew" style="display:none;"></span>
<span id="ntnew" style="display:none;"><img src="css/images/notiff.png" width="8px" height="8px"></span>
<?php
} else { ?> New requests (<?php echo $tot1; ?>)
<?php if($tot1>0){ ?>
<img src="css/images/notiff.png" width="8px" height="8px">
<?php
}
}
?>
</a>
<!--cancel-->
<!--<a href="?hal=cancel" class="link" style="<?php //if($_GET['hal']=="cancel"){ echo $style; } ?>">
<?php //if($_GET['hal']=="cancel"){ ?> Cancel PO (<span id="tcancel"></span>)
<?php //} else { ?> Cancel PO (<?php //echo $tot4; ?>) <?php //} ?></a>-->

<!--awaiting-->
<a href="action/simpan.php?x=mempo2&pur=<?php echo $_SESSION['login']; ?>" class="link" style="<?php if($_GET['hal']=="wait"){ echo $style; } ?>">
<?php
if($_GET['hal']=="wait"){ ?> Awaiting PI <span id="twait1">(<?php echo $tot2; ?>)
<?php if($tot2b>0){ ?>
<img src="css/images/notiff.png" width="8px" height="8px">
<?php
}
?>
</span>
<span id="twait" style="display:none;"></span>
<span id="ntwait" style="display:none;"></span>
<?php
} else { ?> Awaiting PI (<?php echo $tot2; ?>)
<?php if($tot2b>0){ ?>
<img src="css/images/notiff.png" width="8px" height="8px">
<?php
}
}
?>
</a>
<!--purchased-->
<a href="?hal=pur2" class="link" style="<?php if($_GET['hal']=="pur2"){ echo $style; } ?>">
<?php if($_GET['hal']=="pur2"){ ?>Purchased <span id="tpay1">(<?php echo $tot3; ?>)
<?php if($tot3b>0){ ?>
<img src="css/images/notiff.png" width="8px" height="8px">
<?php
}
?>
</span>
<span id="tpay" style="display:none;"></span>
<span id="ntpay" style="display:none;"></span>
<?php } else { ?> Purchased (<?php echo $tot3; ?>)
<?php if($tot3b>0){ ?>
<img src="css/images/notiff.png" width="8px" height="8px">
<?php
}
}
?>
</a>
<!--end-->
</div>
<?php }
}
}
?>
</div>
<script type="text/javascript">
//DROPDOWN

/*function tutup(){
document.getElementById("myDropdown1").classList.toggle("");
document.querySelector('#myDropdown1').style.display = 'none';
}*/
// Close the dropdown if the user clicks outside of it
$(document).on("click", function(event){
var $trigger = $("#notif");
if($trigger !== event.target && !$trigger.has(event.target).length){
$(".dropdwn-content1").slideUp("fast");
}            
});

function myFunction2(){
document.querySelector('#myDropdown2b').style.display = '';
document.getElementById("myDropdown2b").classList.toggle("show");
}
$(document).on("click", function(event){
var $trigger = $("#viewmemo");
if($trigger !== event.target && !$trigger.has(event.target).length){
$(".dropdwn-content2").slideUp("fast");							
}            
});
 
//DROPDOWN
function myFunction(){
document.querySelector('#myDropdown').style.display = '';
document.getElementById("myDropdown").classList.toggle("show");
}
$(document).on("click", function(event){
var $trigger = $("#frame-filter-newest");
if($trigger !== event.target && !$trigger.has(event.target).length){
$(".dropdwn-content").slideUp("fast");							
}            
});
 
function myFunction1c(){
document.querySelector('#myDropdown2').style.display = '';
document.getElementById("myDropdown2").classList.toggle("show");
$('#kolom1').datagrid('load');
}
$(document).on("click", function(event){
var $trigger = $("#frame-filter-fields");
if($trigger !== event.target && !$trigger.has(event.target).length){
$(".dropdown1-content").slideUp("fast");							
}            
});
 
function myFunction1d(){
document.querySelector('#myDropdown3').style.display = '';
document.getElementById("myDropdown3").classList.toggle("show");
$('#spl').datagrid('load');
$('#byr2').datagrid('load');
var total = document.getElementById("total").value;
if(total>=1){
$('#fltr2').show();
} else {
$('#fltr2').hide();
}
}
 /*$(document).on("click", function(event){
   var $trigger = $("#frame-filter2");
   if($trigger !== event.target && !$trigger.has(event.target).length){
     $(".dropdown2-content").slideUp("fast");							
     }            
});*/
 
$(document).on("click", function(event){
var $trigger = $("#tabel");
if($trigger !== event.target && !$trigger.has(event.target).length){
//$('#menu').fadeOut();
//$('#dg').datagrid('clearSelections');
//$('#dg2').datagrid('clearSelections');
//$('#dg3a').datagrid('clearSelections');
//$('#dg3b').datagrid('clearSelections');
}            
});
</script>
<?php
if	($_GET['hal'] == "order"){ include "view/ord.php"; }
if	($_GET['hal'] == "sum"){ include "view/sum.php"; }
if	($_GET['hal'] == "list"){ include "view/list.php"; }
if	($_GET['hal'] == "log"){ include "view/log.php"; }
/*if($_GET['hal'] == "detord"){ include "view/detord2.php"; }*/
if	($_GET['hal'] == "qty"){ include "view/qty.php"; }
if	($_GET['hal'] == "mat"){ include "view/material.php"; }
if	($_GET['hal'] == "detmat"){ include "view/material2.php"; }
if	($_GET['hal'] == "pur"){ include "view/purchasing.php"; }
if	($_GET['hal'] == "proses"){ include "view/proses.php"; }
if	($_GET['hal'] == "proses2"){ include "view/proses2.php"; }
if	($_GET['hal'] == "assign"){ include "view/assign.php"; }
if	($_GET['hal'] == "assign2"){ include "view/assign2.php"; }
if	($_GET['hal'] == "detpomd"){ include "view/detpomd.php"; }
if	($_GET['hal'] == "detpopur"){ include "view/detpopur.php"; }

if	($_GET['hal'] == "new"){ include "view/new.php"; }
if	($_GET['hal'] == "assign3"){ include "view/assign3.php"; }
if	($_GET['hal'] == "cancel"){ include "view/cancel.php"; }
if	($_GET['hal'] == "wait"){ include "view/waiting.php"; }
if	($_GET['hal'] == "detpo"){ include "view/detpo.php"; }
if	($_GET['hal'] == "pur2"){ include "view/purchased.php"; }
if	($_GET['hal'] == "lpb"){ include "view/lpb.php"; }
/*if($_GET['hal'] == "ord2"){ include "view/ord2.php"; }
if	($_GET['hal'] == "mat"){ include "view/material.php"; }*/
if	($_GET['hal'] == "dford"){ include "view/dford.php"; }
if	($_GET['hal'] == "dfqty"){ include "view/dfqty.php"; }
if	($_GET['hal'] == "dfmat"){ include "view/dfmat.php"; }
if	($_GET['hal'] == "dfpo"){ include "view/dfpo.php"; }
if	($_GET['hal'] == "dtpo"){ include "view/dtpo.php"; }
?>