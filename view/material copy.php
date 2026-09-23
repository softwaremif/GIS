<?php
//include "action/sinkron1.php";
/*include "email/test.php";
include "email/test1.php";
include "email/test2.php";*/
// include "action/sinkron4.php";
include "material_js.php";
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<style type="text/css">
	.header {
		display: flex;
		flex-direction: row;
		justify-content: flex-end;
		align-items: flex-start;
		padding: 16px;
		gap: 24px;
		position: absolute;
		width: 100%;
		height: 48px;
		left: 0px;
		top: 58px;
		background: #359DD9;
		box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);
	}

	.contenta {
		padding: 16px;
	}

	.sticky {
		position: fixed;
		top: 0;
		width: 100%;
	}

	.sticky+.contenta {
		padding-top: 102px;
	}

	.item_dan_usage {
		display: flex;
		flex-direction: row;
		align-items: center;
	}

	.item_dan_usage>div {
		margin-right: 20px;
	}

	.datagrid-cell {
		/* font-family: 'Arial'; */
		font-style: normal;
		font-weight: 400;
		font-size: 13px;
		line-height: 18px;
		white-space: normal;
	}

	.datagrid-row {
		height: auto !important;
		white-space: normal !important;
	}

		.suggestions-container {
			position: absolute;
			width: 300px;
			/* border: 0px solid #ccc; */
			max-height: 300px;
			overflow-y: auto;
			z-index: 5;
			background-color: #ffffff;
			box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);
			border-radius: 5px;
		}

		.suggestions-container ul {
			list-style-type: none;
			padding: 0;
			margin: 0;
		}

		.suggestions-container li {
			padding: 5px;
			cursor: pointer;
		}

		.suggestions-container li:hover {
			background-color: #f1f1f1;
		}
		.item_input {
			position: relative;
		}
</style>
<script src="config/item.js"></script>
<script src="config/item2.js"></script>
<?php
$sql = mysqli_query($koneksi, "SELECT SUM(tot) AS tot FROM bdown WHERE ordpk='$ord' AND jenis LIKE '%DETAIL%' GROUP BY ordpk");
$dtsql = mysqli_fetch_array($sql);
$totqty = $dtsql['tot'];

$sqlcur = mysqli_query($koneksi, "select * from cur where curpk='2'");
$dtcur = mysqli_fetch_array($sqlcur);

$sqlc = mysqli_query($koneksi, "select * from costing where ordpk='$ord'");
$dtc = mysqli_fetch_array($sqlc);

$sqlk = mysqli_query($koneksi, "select * from kurs order by kurspk desc limit 1");
$dtk = mysqli_fetch_array($sqlk);

/*totrkb*/
$crr = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from rkb where ordpk='$ord' and curpk='1' and spec<>'' and popk>'0' and stspk<>'7' group by ordpk");
$dtr = mysqli_fetch_array($crr);
$totrp = $dtr['totrkb'] / $dtk['rupiah'];

$cre = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from rkb where ordpk='$ord' and curpk='3' and spec<>'' and popk>'0' and stspk<>'7' group by ordpk");
$dte = mysqli_fetch_array($cre);
$toteu = $dte['totrkb'] / $dtk['euro'];

$crp = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from rkb where ordpk='$ord' and curpk='6' and spec<>'' and popk>'0' and stspk<>'7' group by ordpk");
$dtp = mysqli_fetch_array($crp);
$totp = $dtp['totrkb'] / $dtk['pounds'];

$crd = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from rkb where ordpk='$ord' and curpk='2' and spec<>'' and popk>'0' and stspk<>'7' group by ordpk");
$dtd = mysqli_fetch_array($crd);
$totd = $dtd['totrkb'];

$totrkb1 = $totrp + $toteu + $totp + $totd;
$totrkb = $dtcur['cursign'] . number_format($totrkb1, 2, ".", ",");
$totrkbb = number_format($totrkb1, 2, ".", ",");
if ($totqty > 0) {
	$perrkb1 = $totrkb1 / $totqty;
	$perrkb = $dtcur['cursign'] . number_format($perrkb1, 2, ".", ",");
} else {
	$perrkb = "N/A";
}

/*totpo*/
$crr2 = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from podt where ordpk='$ord' and curpk='1' and delsts='0' and stspk<>'7' group by ordpk");
$dtr2 = mysqli_fetch_array($crr2);
$totrp2 = $dtr2['totrkb'] / $dtk['rupiah'];

$cre2 = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from podt where ordpk='$ord' and curpk='3' and delsts='0' and stspk<>'7' group by ordpk");
$dte2 = mysqli_fetch_array($cre2);
$toteu2 = $dte2['totrkb'] / $dtk['euro'];

$crp2 = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from podt where ordpk='$ord' and curpk='6' and delsts='0' and stspk<>'7' group by ordpk");
$dtp2 = mysqli_fetch_array($crp2);
$totp2 = $dtp2['totrkb'] / $dtk['pounds'];

$crd2 = mysqli_query($koneksi, "select sum(pocons*price) as totrkb from podt where ordpk='$ord' and curpk='2' and delsts='0' and stspk<>'7' group by ordpk");
$dtd2 = mysqli_fetch_array($crd2);
$totd2 = $dtd2['totrkb'];

$totpo1 = $totrp2 + $toteu2 + $totp2 + $totd2;
$totpo = $dtcur['cursign'] . number_format($totpo1, 2, ".", ",");
$totpoo = number_format($totpo1, 2, ".", ",");
if ($totqty > 0) {
	$perpo1 = $totpo1 / $totqty;
	$perpo = $dtcur['cursign'] . number_format($perpo1, 2, ".", ",");
} else {
	$perpo = "N/A";
}
?>
<input type="hidden" name="copy" id="copy">
<input type="hidden" name="test1" id="test1">
<input type="hidden" name="test2" id="test2">
<input type="hidden" name="total" id="total" value="0" size="5">
<input type="hidden" name="ord" id="ord" value="<?php echo $ord; ?>" size="8">
<input type="hidden" name="sfu" id="sfu" value="<?php echo $_SESSION['funm']; ?>" size="8">

<!--<div id="menu" onclick="$('#menu').hide(); $('#dg2').datagrid('clearSelections');"  style="display:none;">
<div id="count" style="margin-right:700px;color:#ffffff;"></div>
<div class="detail" style="width:50px;" id="medit"><a href="javascript:void(0)" plain="true" onclick="edit2();" style="color: #FFFFFF; text-decoration: none;"> Edit </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="select();" style="color: #FFFFFF; text-decoration: none;"> Select </a></div>-->
<!--<div class="detail"><a href="javascript:void(0)" plain="true" onclick="request2();" style="color: #FFFFFF; text-decoration: none;"> Request PO </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="print2();" style="color: #FFFFFF; text-decoration: none;"> Print </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="copy2();" style="color: #FFFFFF; text-decoration: none;"> Copy </a></div>
<div class="delete" style="width:80px;"><a href="javascript:void(0)" plain="true" onclick="copyto();" style="color: #FFFFFF; text-decoration: none;"> Copy To </a></div>-->
<!--<div class="delete"><a href="javascript:void(0)" plain="true" onclick="delmat2();" style="color: #FFFFFF; text-decoration: none;"> Delete </a></div>
</div>-->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> -->
<?php
$tot = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb WHERE ordpk='$ord' and spec<>'' GROUP BY ordpk"));
if ($tot > 0) {
?>
	<div class="contenta">
		<div id="container-cari" style="background:#FFFFFF; width:1220px; top:200px; left:20px;">
			<div
				style="text-align:left;width:100%;height:92px;overflow-y:hidden;overflow-x:scroll; width:auto;z-index: 0; border-radius: 8px;box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
				<div
					style="text-align:left;padding:5px;background-color:#FFFFFF; height:70px; width:15%; border-radius: 8px; box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
					<span style="color:#00000061; font-weight:700; font-size:12px; line-height:16px;">Summary</span><br>
					<span id="sumreq" style="display:none;color:#000000; font-size:14px; line-height:18px;"></span>
					<span style="color:#000000; font-size:14px; line-height:18px;">requested for PO</span><br>
					<span id="sumpo" style="display:none;color:#00000061; font-size:14px; line-height:18px;"></span>
					<span style="color:#00000061; font-size:14px; line-height:18px;">PO issued</span>
				</div>
				<div
					style="text-align:left;padding:5px;background-color:#FFFFFF; margin-top:-70px;margin-left:15.5%; height:70px; width:30%; border-radius: 8px; box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
					<span style="color:#00000061; font-weight:700; font-size:12px; line-height:16px;">Material Per garment
					</span>
					<table style="width:100%">
						<tr>
							<td style="width:20%;color:#000000; font-size:14px; line-height:18px">Costing</td>
							<td style="width:25%;color:#000000; font-size:14px; line-height:18px">RKB cost</td>
							<td style="width:55%;color:#000000; font-size:14px; line-height:18px">PO cost</td>
						</tr>
						<tr>
							<td style="width:20%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
								<!-- <span id="cost1"></span> -->
								<?php
								if ($dtc['costpk'] > 0) {
									// $cost1=$dtc['CM']+$dtc['materials']+$dtc['others'];
									$cost1 = $dtc['materials'];
									$cost = $dtcur['cursign'] . number_format($cost1, 2, ".", ",");
								} else {
									$cost = "<span style='color:#00000061;font-weight:400;'>N/A</span>";
								}
								echo $cost;
								?>
							</td>
							<td style="width:25%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
								<?php if ($perrkb1 > 0) { ?>
									<?php echo $perrkb; ?>
								<?php } else { ?>
									<span style="color:#00000061;font-weight:400;">N/A</span>
								<?php } ?>
							</td>
							<td style="width:55%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
								<?php if ($perpo1 > 0) { ?>
									<?php echo $perpo; ?>
								<?php } else { ?>
									<span style="color:#00000061;font-weight:400;">N/A</span>
								<?php } ?>
								<?php if ($perrkb1 > 0) {
									$profit1a = $perrkb1 - $perpo1;
									if ($totrkbb <> $totpoo) {
										if ($profit1a < 0) {
											$profit1b = $profit1a * (-1);
											$profitp1a = ($profit1b / $perrkb1) * 100;
											$profitp1 = number_format($profitp1a, 2, ".", ",");
											$profit1 = "-" . number_format($profit1b, 2, ".", ",");
								?>
											<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;"
												title="<?php echo $profit1 . "(" . $profitp1 . "%)"; ?>" class="easyui-tooltip">
												<span style='color:#EF3B42; font-size:12px;'>
													<?php //echo truncate($profit1,10); 
													?>
													<?php echo $profit1; ?>
													(<?php echo $profitp1; ?>%)</span>
											</a>
										<?php } else if ($profit1a > 0) {
											$profitp1a = ($profit1a / $perrkb1) * 100;
											$profitp1 = number_format($profitp1a, 2, ".", ",");
											$profit1 = number_format($profit1a, 2, ".", ",");
										?>
											<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;"
												title="<?php echo "+" . $profit1 . "(" . $profitp1 . "%) profit"; ?>"
												class="easyui-tooltip">
												<span style='color:#19B715; font-size:12px;'>+
													<?php //echo truncate($profit1,5); 
													?>
													<?php echo $profit1; ?>
													(<?php echo $profitp1; ?>%) profit</span>
											</a>
										<?php }
									} else {
										$profitp1a = ($profit1a / $perrkb1) * 100;
										$profitp1 = number_format($profitp1a, 2, ".", ",");
										$profit1 = number_format($profit1a, 2, ".", ",");
										?>
										<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;"
											title="<?php echo "+" . $profit1 . "(" . $profitp1 . "%) profit"; ?>"
											class="easyui-tooltip">
											<span style='color:#00000061; font-size:12px;'>+
												<?php //echo truncate($profit1,5); 
												?>
												<?php echo $profit1; ?>
												(<?php echo $profitp1; ?>%) profit</span>
										</a>
								<?php }
								} ?>
							</td>
						</tr>
					</table>
				</div>
				<div
					style="text-align:left;padding:5px;background-color:#FFFFFF; margin-top:-70px;margin-left:46%; height:70px; width:40%; border-radius: 8px; box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
					<span style="color:#00000061; font-weight:700; font-size:12px; line-height:16px;">Bulk material</span>
					<span id="bqty" style="color:#00000061; font-weight:700; font-size:12px; line-height:16px;"></span>
					<table style="width:100%">
						<tr>
							<td style="width:20%;color:#000000; font-size:14px; line-height:18px">Costing</td>
							<td style="width:25%;color:#000000; font-size:14px; line-height:18px">RKB cost</td>
							<td style="width:55%;color:#000000; font-size:14px; line-height:18px">PO cost</td>
						</tr>
						<tr>
							<td style="width:20%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
								<!-- <span id="cost2"></span> -->
								<?php
								if ($dtc['costpk'] > 0) {
									$cost1 = $dtc['materials'] * $totqty;
									$cost2 = $dtcur['cursign'] . number_format($cost1, 0, ".", ",");
									$totcost = "<a href='javascript:void(0)' style='text-decoration:none; color:#000000;cursor:default;' title='$cost2' class='easyui-tooltip'>"
										. truncate($cost2, 10) .
										// .$cost2.
										"</a>";
								} else {
									$totcost = "<span style='color:#00000061;font-weight:400;'>N/A</span>";
								}
								echo $totcost;
								?>
							</td>
							<td style="width:25%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
								<?php if ($totrkb1 > 0) { ?>
									<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;"
										title="<?php echo $totrkb; ?>" class="easyui-tooltip">
										<?php
										//echo truncate($totrkb,10); 
										echo $totrkb;
										?>
									</a>
								<?php } else { ?>
									<span style="color:#00000061;font-weight:400;">N/A</span>
								<?php } ?>
							</td>
							<td style="width:55%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
								<?php if ($totpo1 > 0) { ?>
									<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;"
										title="<?php echo $totpo; ?>" class="easyui-tooltip">
										<?php
										//echo truncate($totpo,10); 
										echo $totpo;
										?>
									</a>
								<?php } else { ?>
									<span style="color:#00000061;font-weight:400;">N/A</span>
								<?php } ?>
								<?php
								if ($totrkb1 > 0) {
									$profit2a = $totrkb1 - $totpo1;
									if ($totrkbb <> $totpoo) {
										if ($profit2a < 0) {
											$cekover = 1;
											$profit2b = $profit2a * (-1);
											$profitp2a = ($profit2b / $totrkb1) * 100;
											$profitp2 = number_format($profitp2a, 2, ".", ",");
											$profit2 = "-" . number_format($profit2b, 2, ".", ",");
								?>
											<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;"
												title="<?php echo $profit2 . "(" . $profitp2 . "%)"; ?>" class="easyui-tooltip">
												<span style='color:#EF3B42; font-size:12px;'>
													<?php
													//echo truncate($profit2,10); 
													echo $profit2;
													?>(<?php echo $profitp2; ?>%)
												</span>
											</a>
										<?php //} else if($profit2a>0){ 
										} else if ($profit2a > 0) {
											$profitp2a = ($profit2a / $totrkb1) * 100;
											$profitp2 = number_format($profitp2a, 2, ".", ",");
											$profit2 = number_format($profit2a, 2, ".", ",");
										?>
											<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;"
												title="<?php echo "+" . $profit2 . "(" . $profitp2 . "%) profit"; ?>"
												class="easyui-tooltip">
												<span style='color:#19B715; font-size:12px;'>+
													<?php
													// echo truncate($profit2,5); 
													echo $profit2;
													?>(<?php echo $profitp2; ?>%) profit
												</span>
											</a>
										<?php }
									} else {
										$profitp2a = ($profit2a / $totrkb1) * 100;
										$profitp2 = number_format($profitp2a, 2, ".", ",");
										$profit2 = number_format($profit2a, 2, ".", ",");
										?>
										<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;"
											title="<?php echo "+" . $profit2 . "(" . $profitp2 . "%) profit"; ?>"
											class="easyui-tooltip">
											<span style='color:#00000061; font-size:12px;'>+
												<?php
												// echo truncate($profit2,5);
												echo $profit2;
												?>(<?php echo $profitp2; ?>%) profit
											</span>
										</a>
								<?php }
								} else {
									if ($totpo1 > $totrkb1) {
										$cekover = 1;
									}
								}
								?>
							</td>
						</tr>
					</table>
				</div>
				<?php //if($cekover==1){ 
				?>
				<div id="container-cari3b"
					style="display:none;text-align:left;padding:5px;background-color:#FFFFFF; margin-top:-70px;margin-left:86.5%; height:70px; width:23%; border-radius: 8px; box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
					<span style="color:#00000061; font-weight:700; font-size:12px; line-height:16px;">Attention !</span><br>
					<span id="overprice" style="color:#EF3B42; font-size:12px; line-height:16px;"></span>
					<span style="color:#EF3B42; font-size:12px; line-height:16px;">materials</span>
					<span style="color:#000000; font-size:12px; line-height:18px;">are over price in purchase</span><br>
					<span id="overqty" style="color:#FF6B00; font-size:12px; line-height:16px;"></span>
					<span style="color:#FF6B00; font-size:12px; line-height:16px;">materials</span>
					<span style="color:#000000; font-size:12px; line-height:18px;">are over qty in purchase</span>
					<!-- <span style="color:#000000; font-size:14px; line-height:18px;">Materials row is highlighted in</span>
<span style="color:#FF6B00; font-size:14px; line-height:18px;">orange</span> -->
				</div>
				<?php //} 
				?>
			</div>
		</div>
		<!--<div id="frame-utama-cari" style="width:820px; top:175px;">-->
		<div id="frame-utama-cari" style="width:740px; top:297px;">
			<div id="container-cari">
				<div id="frame-cari">
					<img src="css/images/Shape.png" plain="true" width="18px" height="18px">
					<input id="cari1b" placeholder="Search..." class="input"
						onkeyup="Search2(); over(); sumpo(); cost1(); cost2();">
				</div>
			</div>
			<!-- <input style="margin-top:-2px;" type="button" name="submit" value="&#10010; Material" class="button-submit-add"
				onclick="create2();"> -->
				<button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#addMaterial"> &#10010; Material</button>
				<?php include('create_material.php'); ?>
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
					Launch demo modal
				</button>

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								Woo-hoo, you’re reading this text in a modal!
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>
						</div>
					</div>
				</div>
			<input style="width:140px; height:28px;" id="cari2b" class="easyui-combobox" data-options="prompt:'Status',onChange:Search2,limitToList:'true',
data: [
{value:'0',text:'All'},
{value:'1',text:'In progress'},
{value:'2',text:'Ready for PO'},
{value:'3',text:'Need revision'},
{value:'41',text:'Req PO'},
{value:'42',text:'PO In Process'},
{value:'44',text:'Req Revised'},
{value:'45',text:'Ready Revised'},
{value:'46',text:'Req Cancel'},
{value:'47',text:'Cancel PO'},
{value:'5',text:'In Revision PO'},
{value:'6',text:'Purchased'}
]">
			<input style="width:200px; height:28px;" id="cari3b" class="easyui-combobox"
				data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=supplier&ord=<?php echo $ord; ?>',prompt:'Supplier',onChange:Search2,limitToList:'true'">
			<!--<input style="width:140px; height:28px;" id="cari6b" class="easyui-combobox"
data-options="prompt:'Type',onChange:Search2,panelHeight:'auto',
data: [
{value:'ALL',text:'ALL'},
{value:'CUTTING',text:'CUTTING'},
{value:'SEWING',text:'SEWING'},
{value:'FINISHING',text:'FINISHING'}
]">-->
			<a href="javascript:void(0)" plain="true" onclick="importdata();"
				style="font-weight:700; font-size:14px; color:#359DD9; text-decoration: none;"> Import Material </a>
			<!--<a href="javascript:void(0)" plain="true" onclick="prosespo1();" style="font-weight:700; font-size:14px; color:#359DD9; text-decoration: none;"> Process PO </a>-->

			<!--<a href="javascript:void(0)" plain="true" onclick="prosespo();" style="font-weight:700; font-size:14px; color:#359DD9; text-decoration: none;"> Process PO </a>-->

			<!--<a href="javascript:void(0);" title="Reload table" class="easyui-tooltip" onclick="$('#dg2').datagrid('reload');">
<img src="css/images/reload1.png" width="20px" height="20px">-->
			</a>
		</div>

		<div id="frame-filter" style="top:307px;margin-left:-5%;">
			<div id="frame-filter-fields">
				<div class="fields"><a href="javascript:void(0)" style="text-decoration:none; color: #AFAFAF;"
						onclick="myFunction1c(); testku2();">Fields</a></div>
				<div class="all"><a href="javascript:void(0)" style="text-decoration:none; color: #000000;"
						onclick="myFunction1c(); testku2();">All</a></div>
				<div id="panah2">
					<div class="dropdown">
						<input onclick="myFunction1c(); testku2();" type="image" src="css/images/Polygon.png"
							class="dropbtn1" style="filter:brightness(0%);" alt="Submit button" width="10px" height="10px">
						<!--<button onclick="myFunction()" class="dropbtn"></button>-->
						<div id="myDropdown2" class="dropdown1-content" name="dropdown1-content" style="height:540px;">
							<div class="content-search2">
								<div id="frame-cari2">
									<img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button">
									<input id="cari6" placeholder="Search..." class="input" onkeyup="filterFunction();">
								</div>
							</div>
							<div style="margin-top:50px;margin-left:-5px;display: inline-block; text-align: left;">
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div><b>Select All</b></div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;">
										<input type="checkbox" name="all" value="all" id="chek0"
											onclick="toggle(this); cheka1(); cheka1b(); cheka2(); cheka3(); cheka3b(); cheka4(); cheka4b(); cheka5(); cheka5b(); cheka6(); cheka7(); cheka7b();  cheka8(); cheka9(); cheka10(); cheka11(); cheka12(); cheka13(); cheka14();"
											checked>
									</div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Item</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek1" onclick="cheka1();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Garment Colorway</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek1b" onclick="cheka1b();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Supplier</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek2" onclick="cheka2();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Status</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek3" onclick="cheka3();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>PO no.</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek3b" onclick="cheka3b();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Specification</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek4" onclick="cheka4();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Placement</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek4b" onclick="cheka4b();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Size</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek14" onclick="cheka14();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Qty</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek5" onclick="cheka5();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Total PO</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek5b" onclick="cheka5b();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Unit</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek6" onclick="cheka6();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Color</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek7" onclick="cheka7();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Col Code</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek7b" onclick="cheka7b();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Price</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek8" onclick="cheka8();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Cost.Cons</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek9" onclick="cheka9();"></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Pur.Cons</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek10" onclick="cheka10();"></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Var.Cons</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek11" onclick="cheka11();"></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Netto</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek12" onclick="cheka12();"></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Allowance</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek13" onclick="cheka13();"></div>
								</a>
							</div>
							<!--<div id="tabel" style="width:200px;height:350px;border:0px solid;margin-top:-150px;margin-left:-20px;">
			<table id="kolom1" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
				url="view/get_data.php?dt=kolom2" toolbar="#tb" striped="false"
				rownumbers="false"  multiple="true" collapsible="false" fitColumns="false" method="post" data-options="border:false,loadMsg:''">
			<thead>
			<tr>
			<th field="kolomnm" width="145" sortable="false" >Select All</th>
			<th field="ck" width="40"><input type="checkbox" name="chekk" onclick="toggle(this); cheka1(); cheka2(); cheka3(); cheka4(); cheka5(); cheka6(); cheka7(); cheka8(); cheka9(); cheka10(); cheka11(); cheka12(); cheka13();" id="chekk"></th>
			</tr>
			</thead>
			</table>
			</div>-->
						</div>
					</div>
				</div>
			</div>
			<div id="frame-filter-newest">
				<div class="dropdwn">
					<input onclick="myFunction()" type="image" class="imgsort" src="css/images/sort.jpg" alt="Submit button"
						class="dropbtn">
					<div id="myDropdown" class="dropdwn-content" style="height:120px;">
						<input type="hidden" id="cari4b" value="1" name="cari4">
						<div class="new-entry"><a href="javascript:void(0)" plain="true" onclick="Search2a();">Newest entry</a></div>
						<input type="hidden" id="cari5b" value="1" name="cari5">
						<div class="old-entry"><a href="javascript:void(0)" plain="true" onclick="Search2b();">Oldest entry</a></div>
						<input type="hidden" id="cariaz" value="1" name="cariaz">
						<div class="old-entry"><a href="javascript:void(0)" plain="true" onclick="Searchaz();">Item Name (A-Z)</a></div>
					</div>
				</div>
				<a href="javascript:void(0);" style="text-decoration:none; color: #000000;">
					<div id="newest" class="newest" onclick="myFunction()">Newest</div>
					<div id="oldest" class="newest" onclick="myFunction()" style="display:none;">Oldest</div>
					<div id="itemaz" class="newest" onclick="myFunction()" style="display:none;">Item</div>
				</a>
			</div>
			<div id="frame-filter2">
				<div id="dropdown2">
					<input onclick="myFunction1d(); testku();" type="image" class="imgfilter" src="css/images/filter.png"
						width="14px" height="12.83px" alt="Submit button">
					<div class="filter"><a href="javascript:void(0);" style="text-decoration:none; color: #000000;"
							onclick="myFunction1d(); testku();">Filter</a></div>
					<div id="myDropdown3" class=dropdown2-content style="width:220px;height:395px">
						<div class="content-search2">
							<div id="frame-cari2">
								<img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button">
								<input id="carispl" placeholder="Search..." class="input" onkeyup="Search5();">
							</div>
						</div>
						<div id="byr1a" class="byra" style="margin-top:50px;margin-left:15px;">
							Type
							<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img1">
								<i class="bi bi-eye-slash-fill" id="togglePassword2a" style="cursor: pointer;"
									onmouseover="expand();" onmouseout="expand();"></i>
							</div>
						</div>
						<div id="tabel" class="tabela" onmousemove="totrec();"
							style="width:200px;height:auto;border:0px solid;margin-top:-120px;margin-left:-20px;">
							<table id="type" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
								url="view/get_data2.php?dt=mat1&ord=<?php echo $ord; ?>" toolbar="#tb" idField="rkbpk"
								striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
								data-options="border:false,loadMsg:''">
								<thead>
									<tr>
										<th field="kelnm" width="160" sortable="false"></th>
										<th field="ck" checkbox="true" width="50"></th>
									</tr>
								</thead>
							</table>
						</div>

						<div id="byr1a" class="prodesa" style="margin-top:85px;margin-left:15px;">
							<hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
							Specification
							<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img2">
								<i class="bi bi-eye-slash-fill" id="togglePassword2b" style="cursor: pointer;"
									onmouseover="expand();" onmouseout="expand();"></i>
							</div>
						</div>
						<div id="tabel" class="tabelb" onmousemove="totrec();"
							style="width:200px;height:auto;margin-top:15px;margin-left:-20px;">
							<table id="spec" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
								url="view/get_data2.php?dt=mat2&ord=<?php echo $ord; ?>" toolbar="#tb" idField="rkbpk"
								striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
								data-options="border:false,loadMsg:''">
								<thead>
									<tr>
										<th field="spec" width="160" sortable="false"></th>
										<th field="ck" checkbox="true" width="50"></th>
									</tr>
								</thead>
							</table>
						</div>

						<div id="byr1a" class="seasona" style="margin-top:60px;margin-left:15px;">
							<hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
							Color
							<div style="text-align:right;margin-top:-15px;margin-right:25px;" id="img3">
								<i class="bi bi-eye-slash-fill" id="togglePassword2c" style="cursor: pointer;"
									onmouseover="expand();" onmouseout="expand();"></i>
							</div>
						</div>
						<div id="tabel" class="tabelc" onmousemove="totrec();"
							style="width:200px;height:auto;margin-top:115px;margin-left:-20px;">
							<table id="color" class="easyui-datagrid" title="" style="width:100%;height:auto;"
								align="center" url="view/get_data2.php?dt=mat3&ord=<?php echo $ord; ?>" toolbar="#tb"
								idField="rkbpk" striped="false" multiple="true" collapsible="true" fitColumns="false"
								method="post" data-options="border:false,loadMsg:''">
								<thead>
									<tr>
										<th field="colname" width="160" sortable="false"></th>
										<th field="ck" checkbox="true" width="50"></th>
									</tr>
								</thead>
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div id="frame-fltrchk" align="left" onmousemove="totrec();" style="width:95%; margin-top:150px;">
			<div id="fltr1"
				style="margin-top:-35px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
			</div>
			<div id="fltr2"
				style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"></div>
			<div id="fltr3"
				style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;display:none;"
				onclick="reset();">
				<a href="javascript:void(0)" style="text-decoration:none; color: #359DD9;">Reset All</a>
			</div>
			<div style="margin-left:150px;margin-top:-20px;">
				<!--<div style="width:20px; height:auto;" id="cross" class="cross" value="<?php //echo $i; 
																							?>" onclick="uncek(<?php //echo $i; 
																												?>);">
&nbsp;&#215;&nbsp;
</div>-->
				<!--A-->
				<?php for ($i = 0; $i <= 2; $i++) { ?>
					<input type="button" id="filtera<?php echo $i; ?>" class="filterchek" alt="Submit button" style="" readonly>
					<input type="hidden" id="idxa<?php echo $i; ?>" size="5">
					<a href="javascript:void(0)" id="crossa<?php echo $i; ?>" class="cross"
						onclick="uncektype2(<?php echo $i; ?>);">&nbsp;&#215;&nbsp;</a>
					<input type="hidden" name="tall" id="talla<?php echo $i; ?>" value="0" size="5">
				<?php } ?>
				<!--B-->
				<?php for ($j = 0; $j <= 1; $j++) { ?>
					<input type="button" id="filterb<?php echo $j; ?>" class="filterchek" alt="Submit button" style="" readonly>
					<input type="hidden" id="idxb<?php echo $j; ?>" size="5">
					<a href="javascript:void(0)" id="crossb<?php echo $j; ?>" class="cross"
						onclick="uncekspec2(<?php echo $j; ?>);">&nbsp;&#215;&nbsp;</a>
					<input type="hidden" name="tall" id="tallb<?php echo $j; ?>" value="0" size="5">
				<?php } ?>
				<!--C-->
				<?php for ($k = 0; $k <= 1; $k++) { ?>
					<input type="button" id="filterc<?php echo $k; ?>" class="filterchek" alt="Submit button" style="" readonly>
					<input type="hidden" id="idxc<?php echo $k; ?>" size="5">
					<a href="javascript:void(0)" id="crossc<?php echo $k; ?>" class="cross"
						onclick="uncekcolor2(<?php echo $k; ?>);">&nbsp;&#215;&nbsp;</a>
					<input type="hidden" name="tall" id="tallc<?php echo $k; ?>" value="0" size="5">
				<?php } ?>
				<!--<input type="button" id="filter1" class="filterchek" alt="Submit button" style="" readonly>
<a href="javascript:void(0)" id="cross1" class="cross" onclick="UnSearchsupp(); tall(); tutup();">&nbsp;&#215;&nbsp;</a>
<input type="button" id="filter2" class="filterchek" alt="Submit button" style="" readonly>
<a href="javascript:void(0)" id="cross2" class="cross" onclick="UnSearchcolor(); tall(); tutup();">&nbsp;&#215;&nbsp;</a>
<input type="button" id="filter3" class="filterchek" alt="Submit button" style="" readonly>
<a href="javascript:void(0)" id="cross3" class="cross" onclick="UnSearchspec(); tall(); tutup();">&nbsp;&#215;&nbsp;</a>-->

			</div>
		</div>
		<div id="tabel1" onclick="menu();" ondblclick="edit2(); $('#myHeader').hide();" onmousemove="" style="top:337px;">
			<table id="dg2" class="easyui-datagrid" title="" style="width:100%;height:500px;" align="center"
				url="view/get_material.php?ord=<?php echo $ord; ?>" idField="rkbpk" toolbar="#tb2" striped="true"
				pageSize="100" pageList="[100,200,300,500]" pagination="true" rownumbers="false" multiple="true"
				collapsible="true" fitColumns="false" data-options="onCheckAll:function(){menu();},onUncheckAll:function(){menu2();},ctrlSelect:true,checkOnSelect:true,multiSort:true,
					rowStyler:function(index,row){
						if (row.copy==5){
						return 'color:#000000;background-color:#D6D6D6;';
						} else {
						if(row.cekover==1){
						if(row.cekover2==1){
						return 'color:#000000;background-color:#FFCCCB;';
						} else {
						return 'color:#000000;background-color:#FFE4B5;';
						}
						} else if(row.cekover2==1){ 
						return 'color:#000000;background-color:#FFCCCB;';
						} else {
						return '';  
						}
					}
					}">
				<thead>
					<tr>
						<th data-options="field:'ck',checkbox:true"></th>
						<th align="center"
							data-options="field:'kelnm2',title:'Type',width:60,sortable:true,styler:function(index,row){}">
							Type</th>
						<!-- <th field="codenm" width="90" sortable="true">Item Code</th> -->
						<th data-options="field:'kategori',width:125,sortable:true">
							Category</th>
						<th data-options="field:'item',width:125,sortable:true">
							Item Name</th>
						<th field="nilai_usage2" width="90" sortable="true">Usage</th>
						<th field="itemadd" width="148" sortable="true">Garment Colorway</th>
						<th field="supnm2" width="137" sortable="true">Supplier</th>
						<th field="status" width="100" formatter="formatter1" sortable="true">Status</th>
						<th field="ponoblue" width="90" sortable="true">PO no.</th>
						<th field="spec" width="150" sortable="true">Specification</th>
						<th field="specadd" width="150" sortable="true">Placement</th>
						<th field="sizegar" width="100" sortable="true">Size</th>
						<th field="qty" width="100" sortable="true">Qty</th>
						<th field="pocons2" width="100" sortable="true">Total PO</th>
						<th field="unit" width="100" sortable="true">Units</th>
						<th field="colname" width="100" sortable="true">Color</th>
						<th field="colcode" width="100" sortable="true">Col Code</th>
						<th field="price" width="100" sortable="true">Price</th>
						<th field="negocons" width="100" sortable="true" hidden="true">Cost.Cons</th>
						<th field="estcons" width="100" sortable="true" hidden="true">Pur.Cons</th>
						<th field="varcons" width="100" sortable="true" hidden="true">Var.Cons</th>
						<th field="totcons" width="100" sortable="true" hidden="true">Netto</th>
						<th field="allowcons" width="100" sortable="true" hidden="true">Allowance</th>
					</tr>
				</thead>
			</table>
			<br>
		</div>
	</div>
<?php } else { ?>
	<!-- <div class="contenta"> -->
	<!-- <div style="text-align:left;"> -->
	<div id="frame-utama-cari" style="margin-left:-23%;width:65%;text-align:left;top:210px;">
		<span style="font-size:14px;font-weight:400;color:#d3d3d3;text-align:left;">No data available. Please check in again
			later.</span>
		<!-- </div> -->
		<!-- <div id="frame-utama-cari" style="text-align:left;top:210px;left:26%;"> -->
		<input style="left:75%;" type="button" name="submit" value="&#10010; Material" class="button-submit-add"
			onclick="create2b();">
		<!-- </div> -->
		<div style="text-align:left;top:210px;margin-left:15%;">
			<a href="javascript:void(0)" plain="true" onclick="importdata();"
				style="font-weight:700; font-size:14px; color:#359DD9; text-decoration: none;"> Import Material </a>
		</div>
	</div>
<?php } ?>

<div class="header" id="myHeader" onclick="" style="display:none;">
	<div id="count" style="display:none;"></div>
	<div id="count2" style="display:none;">Select items to replace</div>
	<div class="detail" id="mreqrev" style="width:auto;display:none;"><a href="javascript:void(0)" plain="true"
			onclick="reqrev();" style="color: #FFFFFF; text-decoration: none;"> Request Revised </a></div>
	<div class="detail" id="mcanreq" style="width:auto;display:none;"><a href="javascript:void(0)" plain="true"
			onclick="canreq();" style="color: #FFFFFF; text-decoration: none;"> Cancel request </a></div>
	<div class="detail" id="mcanreq2" style="width:auto;display:none;"><a href="javascript:void(0)" plain="true"
			onclick="canreq();" style="color: #FFFFFF; text-decoration: none;"> Cancel item PO </a></div>
	<div class="detail" id="medit" style="width:auto;display:none;"><a href="javascript:void(0)" plain="true"
			onclick="edit2();" style="color: #FFFFFF; text-decoration: none;"> Edit </a></div>
	<!--<div class="delete"><a href="javascript:void(0)" plain="true" onclick="select();" style="color: #FFFFFF; text-decoration: none;"> Select </a></div>-->
	<!--<div class="delete"><a href="javascript:void(0)" plain="true" onclick="select();" style="color: #FFFFFF; text-decoration: none;"> Select </a></div>-->
	<!--<div class="detail" id="mreq" style="display:none;"><a href="javascript:void(0)" plain="true" onclick="request2();" style="color: #FFFFFF; text-decoration: none;"> Request PO </a></div>-->
	<?php if ($_SESSION['fu'] == "4" || $_SESSION['fu'] == "10") { ?>
		<div class="detail" id="mreq" style="display:none;"><a href="javascript:void(0)" plain="true"
				onclick="requestpo2b();" style="color: #FFFFFF; text-decoration: none;"> Request PO </a></div>
	<?php } else { ?>
		<div class="detail" id="mreq" style="display:none;"><a href="javascript:void(0)" plain="true"
				onclick="requestpo2();" style="color: #FFFFFF; text-decoration: none;"> Request PO </a></div>
	<?php } ?>
	<!--<div class="detail" id="mreq" style="display:none;"><a href="javascript:void(0)" plain="true" onclick="requestpo();" style="color: #FFFFFF; text-decoration: none;"> Request PO </a></div>-->

	<!-- <div class="delete" id="mprint"><a href="javascript:void(0)" plain="true" onclick="print2();"
			style="color: #FFFFFF; text-decoration: none;"> Print </a></div> -->
	<div class="delete" id="mprint"><a href="javascript:void(0)" plain="true" onclick="exp();"
			style="color: #FFFFFF; text-decoration: none;"> Print </a></div>
	<div class="delete" id="mreplace1" style="width:auto;display:none;"><a href="javascript:void(0)" plain="true"
			onclick="replace1();" style="color: #FFFFFF; text-decoration: none;"> Copy & Replace </a></div>
	<div class="delete" id="mreplace2" style="width:auto;display:none;"><a href="javascript:void(0)" plain="true"
			onclick="replace2();" style="color: #FFFFFF; text-decoration: none;"> Replace data </a></div>
	<div class="delete" id="mcancopy" style="display:none;"><a href="javascript:void(0)" plain="true"
			onclick="cancopy();" style="color: #FFFFFF; text-decoration: none;"> Cancel </a></div>
	<div class="delete" id="mcopy" style="display:none;"><a href="javascript:void(0)" plain="true" onclick="copy2();"
			style="color: #FFFFFF; text-decoration: none;"> Copy </a></div>
	<div class="delete" id="mexp" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="copyto();"
			style="color: #FFFFFF; text-decoration: none;"> Export materials </a></div>
	<div class="delete" id="mdel" style="display:none;"><a href="javascript:void(0)" plain="true" onclick="delmat2();"
			style="color: #FFFFFF; text-decoration: none;"> Delete </a></div>
	<div class="delete" id="mview" style="width:auto;display:none;"><a href="javascript:void(0)" plain="true"
			onclick="viewpo();" style="color: #FFFFFF; text-decoration: none;"> View PO </a></div>
	<div class="delete" id="mviewpi" style="width:auto;display:none;"><a href="javascript:void(0)" plain="true"
			onclick="viewpi();" style="color: #FFFFFF; text-decoration: none;"> View PI Form </a></div>
	<div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true"
			onclick="$('#myHeader').hide(); $('#dg2').datagrid('clearSelections'); $('#dg2').datagrid('clearChecked');"
			style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
</div>

<!--form tambah-->
<div id="dialog-forma" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,closable:false,resizable:false,modal:true"
	style="width:95%;height:100%;padding:5px 5px;display:none;top:0;border-radius:8px;">
	<?php //$ord=$_GET['ord']; 
	?>
	<!--<div id="center" region="center" border="false">-->
	<form id="forma" method="post">
		<input type="hidden" name="ordpk" id="ordpk" value="<?php echo $ord; ?>">
		<input type="hidden" name="bdownpk" id="bdownpk1">
		<input type="hidden" name="kolom" id="kolom1">
		<!--<input type="hidden" name="tspec" id="tspec" >-->
		<div class="modal-dialog" style="width:99%; height:98%; overflow-y:true;overflow-x:hidden;">
			<div class="modal-content">
				<div
					style="padding:5px;margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Add Material
				</div>
				<div
					style="margin-top:-25px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					<a href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:1090px;"
						onclick="$('#dialog-forma').dialog('close'); $('#forma').form('reset'); 
						sup1b();$('#div_input_usage').hide();"> X</a>
				</div>
				<!-- <div class="fitem">
					<label>Group</label></br>
					<input name="kelnm" id="kelnm1" class="easyui-combobox" required="true"
						style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						data-options="prompt:'Choose group...',panelHeight:'auto',editable:false, 
						data: [
						{value:'CUTTING',text:'CUTTING'},
						{value:'SEWING',text:'SEWING'},
						{value:'FINISHING/PACKING',text:'FINISHING/PACKING'}
						], onChange:klnm_value">
				</div> -->

				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Category</label></br>
					<input name="mtype" id="mtype" required="true"
					style="width: 235px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
					class="easyui-combobox"
					data-options="onChange:klnm_value,valueField:'mtypepk',textField:'typenm',url:'view/get_data.php?dt=mtype',prompt:'Category',limitToList:'true'">
				</div>

				<div class="fitem item_dan_usage">
					<!-- <div id="item_input">
						<label>Item</label></br>
						<input onkeyup="multi1();" name="item" id="item1" class="easyui-validatebox" required="true"
							style="width: 244px; height:34px;" placeholder="Input item name...">
					</div> -->

				<div class="item_input" style="padding:5px;">
					<label style="padding-bottom:10px;">Item Name</label></br>
					<input onkeyup="multi1();" type="text" name="item" id="item1" class="easyui-validatebox" required="true" 
					autocomplete="off" style="width: 300px; height:34px;" placeholder="Input item name...">
					<div id="suggestions-container1" class="suggestions-container"></div>
				</div>

					<div id="div_input_usage" style="display:none;padding:5px;">
						<label style="padding-bottom:10px;">Usage</label><br>
						<select class="easyui-combobox" name="nilai_usage" id="nilai_usage"
							data-options="editable:true, prompt:'Jenis Usage', limitToList:'true'">
							<option value=""></option>

							<?php
							$jenis_usage = array("Shell", "Lining", "Pocketing", "Interlining", "Filler", "Piping");
							$jumlah_usage = 10;

							foreach ($jenis_usage as $item) {
								for ($i = 1; $i <= $jumlah_usage; $i++) {
									echo "<option value='$item$i'>$item$i</option>";
								}
							}
							?>
						</select>
						<!-- <input type="text" id="input_hidden_usage" name="input_hidden_usage"> -->
					</div>
				</div>

				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Garment Colorway</label></br>
					<textarea name="itemadd" id="itemadd" class="easyui-validatebox"
						style="width:1125px; height: 55px;"></textarea>
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Supplier</label><br>
					<span id="suppk1a">
						<input name="suppk" id="suppk1aa" required="true"
							style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
							class="easyui-combobox"
							data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=sup',prompt:'Supplier',limitToList:'true'">
					</span>
					<span id="suppk1b" style="display:none;">
						<input id="suppk1bb" required="true"
							style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
							class="easyui-combobox"
							data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=sup',prompt:'Supplier',limitToList:'true'"
							disabled>
					</span>
					<!--<input type="hidden" name="suppk1" id="suppk1" size="5">-->
					<input type="checkbox" name="external1" id="external1" value="1949" onclick="sup1();">
					<input type="hidden" name="ext1" id="ext1" size="5">
					<label>External sourcing</label>
				</div>
				<div class="fitem" style="padding:5px;">
				<label style="width:auto;">Specification 
				<a href="javascript:void(0)" onclick="lookup_mb();" style="color:#359DD9; text-decoration:none;">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Search for material</a>
				<!-- </label> -->
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<!-- <label> -->
				<a href="http://192.168.0.11/RKB/data/admin?hal=sisa" target="_blank" style="color:#359DD9; text-decoration:none;">
				Check Stock</a>
				</label>
				</div>
				<div class="fitem">
					<input type="radio" name="tspec" id="tspec" value="1" onclick="$('#hidden1').hide(); multi1();"
						checked>
					<label>Single Column</label>
					<input type="radio" name="tspec" id="tspec" value="2" onclick="$('#hidden1').show(); multi1();">
					<label>Multi Column</label>
				</div>
				<div class="fitem" style="padding:5px;">
					<textarea name="spec" id="spec2b" required="true" class="easyui-validatebox"
						style="width:1125px; height: 55px;"></textarea>
				</div>
				<div id="hidden1" style="display:none;">
					<div class="fitem" style="padding:5px;">
						<input name="hspec1" id="hspec1b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec2" id="hspec2b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec3" id="hspec3b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec4" id="hspec4b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec5" id="hspec5b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec6" id="hspec6b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec7" id="hspec7b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec8" id="hspec8b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
					</div>
					<div class="fitem" style="padding:5px;">
						<input name="spec1" id="spec1a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec2" id="spec2a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec3" id="spec3a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec4" id="spec4a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec5" id="spec5a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec6" id="spec6a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec7" id="spec7a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec8" id="spec8a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
					</div>
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Placement</label></br>
					<textarea name="specadd" id="specadd" class="easyui-validatebox"
						style="width:1125px; height: 55px;"></textarea>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<label>Color Name</label>
					<label>Color Code</label>
				</div>
				<div class="fitem" style="padding:5px;">
					<input name="colname" id="colname1" class="easyui-validatebox" required="true"
						style="width: 150px; height:34px;" placeholder="Input color...">&nbsp;
					<input name="colcode" id="colcode1" class="easyui-validatebox" required="true"
						style="width: 150px; height:34px;" placeholder="Input code...">
					<a href="javascript:void(0)" onclick="lookup_col();"
						style="color:#359DD9; text-decoration:none;">Lookup</a>
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Size</label></br>
					<input name="sizegar" id="sizegar1" class="easyui-validatebox" required="true"
						style="width: 150px; height:34px;" placeholder="Input size...">
					<a href="javascript:void(0)" onclick="lookup_bdown();"
						style="color:#359DD9; text-decoration:none;">Lookup</a>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<label style="width:auto;">
					<!-- Unit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
					<!-- </label>
					<label style="font-size: 15px;"> -->
					Budgeting price &nbsp;&nbsp;
					<!-- </label>
					<label style="font-size: 15px;"> -->
					Currency
					</label>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<!--<input name="unit" id="unit" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input Unit...">&nbsp;-->
					<!-- <input name="unit" id="unit"
						style="width: 88px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="valueField:'unita',textField:'unita',url:'view/get_data.php?dt=piunit',prompt:'Unit',limitToList:true"> -->
					<input required name="price2" id="price2" class="easyui-validatebox"
						style="width: 103px; height:34px;" placeholder="0">
					<input name="curpk" id="curpk"
						style="width: 88px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="valueField:'curpk',textField:'curid',url:'view/get_data.php?dt=cur',prompt:'USD',panelHeight:'auto'">
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Bdown Qty.</label></br>
					<input name="bdownqty" id="bdownqty1a" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="canbdown(); myFunction2b();" onchange="canbdown(); myFunction2b();">
					<a href="javascript:void(0)" onclick="lookup_bdown();"
						style="color:#359DD9; text-decoration:none;">Lookup</a>
					<input type="hidden" name="canbd" id="canbd" size="5">
				</div>
				<div style="padding-left:5px;">
					<label style="margin-left: 24px;font-size: 15px;padding-bottom:5px;">Allowance %</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Allowman</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Costing Cons.</label>&emsp;&emsp;&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Purcashing Cons.</label>&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Variance Cons.</label>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<input name="allowcons" id="allowcons1" class="easyui-validatebox"
						style="width: 150px; height:34px;" placeholder="0" onkeyup="myFunction2b();" onchange="myFunction2b();">&nbsp;
					<input name="allowman" id="allowman1" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2b();" onchange="myFunction2b();">&nbsp;
					<input name="negocons" id="negocons1" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2b();" onchange="myFunction2b();">&nbsp;
					<input name="estcons" id="estcons1" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2b();" onchange="myFunction2b();">
					<input name="varcons" id="varcons1" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<label style="padding-bottom:0px;">Netto</label>&emsp;
					<label style="padding-bottom:0px;">Formula </label>
					<label></label>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<input name="totcons" id="totcons1" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					<input id="formula1b" value="estcons * bdownqty" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" readonly>
					<!--<select class="easyui-combobox" name="f1a" id="f1a"
						data-options="editable:false, panelHeight:'auto'" style="width:50px;">
						<option value=""></option>
						<option value="1"> + </option>
						<option value="2"> - </option>
						<option value="3"> * </option>
						<option value="4"> / </option>
						</select>-->
					<input name="f1" id="f1b" placeholder=" / 100000000 " class="easyui-validatebox"
						style="width:100px; height:34px;" onkeyup="myFunction2b();" onchange="myFunction2b();">
					<!--<select class="easyui-combobox" name="f2a" id="f2a"
						data-options="editable:false, panelHeight:'auto'" style="width:50px;">
						<option value=""></option>
						<option value="+"> + </option>
						<option value="-"> - </option>
						<option value="*"> * </option>
						<option value="/"> / </option>
						</select>-->
					<input name="f2" id="f2b" placeholder=" + 100000000 " class="easyui-validatebox"
						style="width:100px; height:34px;" onkeyup="myFunction2b();" onchange="myFunction2b();">
				</div>
				<!--<div class="fitem">
					<label>Netto</label></br>
					<input name="totcons" id="totcons" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					</div>-->
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">PPS</label></br>
					<input name="qrs" id="qrs1" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2b();" onchange="myFunction2b();">
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;width:auto;">
					Total PO 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Unit
					</label></br>
					<input name="pocons1" id="pocons1" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					<input name="pocons2b" id="pocons2b" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					<input name="unit" id="unit"
						style="width: 88px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="editable:false,valueField:'unita',textField:'unita',url:'view/get_data.php?dt=piunit',prompt:'Unit',limitToList:true">
				</div>
				<a style="text-decoration:none; left:750px; margin-top:-32px;" href="javascript:void(0)"
					class="button-cancel"
					onclick="$('#dialog-forma').dialog('close'); $('#forma').form('reset'); sup1b(); $('#div_input_usage').hide();">Cancel</a>
				<!-- <a style="text-decoration:none;" href="javascript:void(0)" class="button-submit" onclick="save();">Submit</a>-->
				<?php if ($tot > 0) { ?>
					<a style="text-decoration:none; left:825px; margin-top:-30px;" href="javascript:void(0)" value="Save"
						class="button-submit" onclick="save1(); sup1b(); $('#div_input_usage').hide();">Save</a>
				<?php } else { ?>
					<a style="text-decoration:none; left:825px; margin-top:-30px;" href="javascript:void(0)" value="Save"
						class="button-submit" onclick="savee1(); sup2b(); $('#div_input_usage').hide();">Save</a>
				<?php } ?>
				<!--<a style="text-decoration:none; left:700px; bottom: 75px;"" href="javascript:void(0)" class="button-request-po" onclick="save2b();">Save & Request PO</a>-->
			</div>
		</div>
	</form>
</div>

<!--form edit-->
<div id="dialog-formb" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,closable:false,resizable:false,modal:true"
	style="width:95%;height:100%;padding:5px 5px;display:none;top:15px;border-radius:8px;">
	<?php //$ord=$_GET['ord']; 
	?>
	<!--<div id="center" region="center" border="false">-->
	<form id="formb" method="post">
		<input type="hidden" name="ordpk" id="ordpk" value="<?php echo $ord; ?>">
		<input type="hidden" name="rkbpk" id="rkbpk">
		<input type="hidden" name="bdownpk" id="bdownpk">
		<input type="hidden" name="kolom" id="kolom">
		<input type="hidden" name="nour" id="nour">
		<input type="hidden" name="fup" id="fup">
		<input type="hidden" name="popk" id="popk">
		<!--<input type="hidden" name="tspec" id="tspec" >-->
		<div class="modal-dialog" style="width:99%; height:98%; overflow-y:scroll;overflow-x:hidden;">
			<div class="modal-content">
				<div id="viewmemo"
					style="padding:5px;margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Edit Material
					<a href="javascript:void(0)" onclick="myFunction2();"
						style="font-size:14px; color:#359DD9; text-decoration:none;">View purchasing memo</a>
				</div>
				<div id="close" style="margin-top:-30px; margin-left:1090px;display:none;">
					<a id="close" href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:28px;"
						onclick="$('#dialog-formb').dialog('close'); $('#formb').form('reset'); sup2b(); 
						$('#div_input_usage2').hide();"> X</a>
				</div>

				<div id="viewmemo2"
					style="padding:5px;margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Edit Material
					<a href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:980px;"
						onclick="$('#dialog-formb').dialog('close'); $('#formb').form('reset'); sup2b(); $('#div_input_usage2').hide();"> X</a>
				</div>
				<!-- <div class="fitem">
					<label>Group</label></br>
					<input name="kelnm" id="kelnm_edit" class="easyui-combobox" required="true"
						style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						data-options="prompt:'Choose group...',panelHeight:'auto',editable:false, 
						data: [
						{value:'CUTTING',text:'CUTTING'},
						{value:'SEWING',text:'SEWING'},
						{value:'FINISHING/PACKING',text:'FINISHING/PACKING'}
						], onChange:klnm_value_edit">
				</div> -->

				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Category</label></br>
					<input name="mtype" id="mtype_edit" required="true"
					style="width: 235px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
					class="easyui-combobox"
					data-options="onChange:klnm_value_edit,valueField:'mtypepk',textField:'typenm',url:'view/get_data.php?dt=mtype',prompt:'Category',limitToList:'true'">
				</div>

				<div class="fitem item_dan_usage">
					<!-- <div id="item_input">
						<label>Item</label></br>
						<input onkeyup="multi();" name="item" id="item" class="easyui-validatebox" required="true"
							style="width: 244px; height:34px;" placeholder="Input item name...">
					</div> -->

				<div class="item_input" style="padding:5px;">
					<label style="padding-bottom:10px;">Item Name</label></br>
					<input onkeyup="multi();" type="text" name="item" id="item" class="easyui-validatebox" required="true" 
					autocomplete="off" style="width: 300px; height:34px;" placeholder="Input item name...">
					<div id="suggestions-container" class="suggestions-container"></div>
				</div>

					<div id="div_input_usage2" style="display:none;padding:5px;">
						<label style="padding-bottom:10px;">Usage</label><br>
						<select class="easyui-combobox" name="nilai_usage2" id="nilai_usage2"
							data-options="editable:true, prompt:'Jenis Usage', limitToList:'true'">
							<option value=""></option>
							<?php
							$jenis_usage = array("Shell", "Lining", "Pocketing", "Interlining", "Filler", "Piping");
							$jumlah_usage = 10;

							foreach ($jenis_usage as $item) {
								for ($i = 1; $i <= $jumlah_usage; $i++) {
									echo "<option value='$item$i'>$item$i</option>";
								}
							}
							?>
						</select>
						<!-- <input type="text" id="input_hidden_usage_edit" name="input_hidden_usage_edit"> -->
					</div>
				</div>

				<!-- memo -->
				<div id="dropdwn">
					<div id="myDropdown2b" class="dropdwn-content2" style="left:155px; top:35px; width:413px;">
						<input name="memonm" id="memonm" class="easyui-validatebox"
							style="font-size:14px; border:none; width:100%; height:auto;" readonly>
						<input name="tgl2" id="tgl2" class="easyui-validatebox"
							style="font-size:14px; color:#AFAFAF; border:none; width:100%; height:auto;" readonly>
					</div>
				</div>

				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Garment Colorway</label></br>
					<textarea name="itemadd" id="itemadd" class="easyui-validatebox"
						style="width:1125px; height: 55px;"></textarea>
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Supplier</label><br>
					<span id="suppk2a">
						<input name="suppk" id="suppk2aa" required="true"
							style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
							class="easyui-combobox"
							data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=sup',prompt:'Supplier',limitToList:'true'">
					</span>
					<span id="suppk2b" style="display:none;">
						<input id="suppk2bb" required="true"
							style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
							class="easyui-combobox"
							data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=sup',prompt:'Supplier',limitToList:'true'"
							disabled>
						<!--<input type="hidden" name="suppk1" id="suppk2" value="1949" size="5">-->
					</span>
					<input type="checkbox" name="external2" id="external2" value="1949" onclick="sup2();">
					<!--<input type="checkbox" name="external2b" id="external2b" value="1949" onclick="sup2();" checked>-->
					<input type="hidden" name="ext2" id="ext2" size="5">
					<input type="hidden" name="ext2b" id="ext2b" size="5">
					<label>External sourcing</label>
				</div>
				<div class="fitem" style="padding:5px;">
				<label style="width:auto;">Specification 
				<a href="javascript:void(0)" onclick="lookup_mb();" style="color:#359DD9; text-decoration:none;">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Search for material</a>
				<!-- </label> -->
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<!-- <label> -->
				<a href="http://192.168.0.11/RKB/data/admin?hal=sisa" target="_blank" style="color:#359DD9; text-decoration:none;">
				Check Stock</a>
				</label>
				</div>				
				<div class="fitem">
					<input type="radio" name="tspec" id="tspec" value="1" onclick="$('#hidden').hide(); multi();"
						checked>
					<label>Single Column</label>
					<input type="radio" name="tspec" id="tspec" value="2" onclick="$('#hidden').show(); multi();">
					<label>Multi Column</label>
				</div>
				<div class="fitem" style="padding:5px;">
					<textarea name="spec" id="spec2" required="true" class="easyui-validatebox"
						style="width:1125px; height: 55px;"></textarea>
				</div>
				<div id="hidden" style="display: none;">
					<div class="fitem" style="padding:5px;">
						<input type="hidden" name="h1" id="h1" style="width: 138px; height:34px;" readonly>
						<input type="hidden" name="h2" id="h2" style="width: 138px; height:34px;" readonly>
						<input type="hidden" name="h3" id="h3" style="width: 138px; height:34px;" readonly>
						<input type="hidden" name="h4" id="h4" style="width: 138px; height:34px;" readonly>
						<input type="hidden" name="h5" id="h5" style="width: 138px; height:34px;" readonly>
						<input type="hidden" name="h6" id="h6" style="width: 138px; height:34px;" readonly>

						<input name="hspec1" id="hspec1" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec2" id="hspec2" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec3" id="hspec3" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec4" id="hspec4" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec5" id="hspec5" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec6" id="hspec6" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec7" id="hspec7" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec8" id="hspec8" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
					</div>
					<div class="fitem" style="padding:5px;">
						<input name="spec1" id="spec1a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec2" id="spec2a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec3" id="spec3a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec4" id="spec4a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec5" id="spec5a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec6" id="spec6a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec7" id="spec7a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec8" id="spec8a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
					</div>
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Placement</label></br>
					<textarea name="specadd" id="specadd" class="easyui-validatebox"
						style="width:1125px; height: 55px;"></textarea>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<label>Color Name</label>&emsp;
					<label>Color Codes</label>
				</div>
				<div class="fitem" style="padding:5px;">
					<input name="colname" id="colname" class="easyui-validatebox" required="true"
						style="width: 150px; height:34px;" placeholder="Input color...">&nbsp;
					<input name="colcode" id="colcode" class="easyui-validatebox" required="true"
						style="width: 150px; height:34px;" placeholder="Input code...">
					<a href="javascript:void(0)" onclick="lookup_col();"
						style="color:#359DD9; text-decoration:none;">Lookup</a>
				</div>
				<div class="fitem" style="padding:5px;">
					<label>Size</label></br>
					<input name="sizegar" id="sizegar" class="easyui-validatebox" required="true"
						style="width: 150px; height:34px;" placeholder="Input size...">
					<a href="javascript:void(0)" onclick="lookup_bdown();"
						style="color:#359DD9; text-decoration:none;">Lookup</a>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<label style="width:auto;">
					<!-- Unit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
					<!-- </label>
					<label style="font-size: 15px;"> -->
					Budgeting price &nbsp;&nbsp;
					<!-- </label>
					<label style="font-size: 15px;"> -->
					Currency
					</label>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<!--<input name="unit" id="unit" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input Unit...">&nbsp;-->
					<!-- <input name="unit" id="unit"
						style="width: 88px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="valueField:'unita',textField:'unita',url:'view/get_data.php?dt=piunit',prompt:'Unit',limitToList:true"> -->
					<input required name="price2" id="price2" class="easyui-validatebox"
						style="width: 103px; height:34px;" placeholder="0">&nbsp;
					<input name="curpk" id="curpk"
						style="width: 88px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="valueField:'curpk',textField:'curid',url:'view/get_data.php?dt=cur',prompt:'USD',limitToList:'true'">
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Bdown Qty.</label></br>
					<input name="bdownqty" id="bdownqty" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="canbdown2(); myFunction2a();" onchange="canbdown2(); myFunction2a();">
					<a href="javascript:void(0)" onclick="lookup_bdown();"
						style="color:#359DD9; text-decoration:none;">Lookup</a>
					<input type="hidden" name="canbd" id="canbd2" size="5">
					<!--<input type="checkbox" name="canbdown1" id="canbdown1" value="1" style="display: none;"><label id="lcan" style="display: none;">Cancel Lookup</label>-->
				</div>
				<div style="padding-left:5px;">
					<label style="margin-left: 24px;font-size: 15px;padding-bottom:5px;">Allowance%</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Allowman</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Costing Cons.</label>&emsp;&emsp;&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Purcashing Cons.</label>&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Variance Cons.</label>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<input name="allowcons" id="allowcons" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">&nbsp;
					<input name="allowman" id="allowman" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">&nbsp;
					<input name="negocons" id="negocons" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">&nbsp;
					<input name="estcons" id="estcons" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">
					<input name="varcons" id="varcons" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<label style="padding-bottom:0px;">Netto</label>&emsp;
					<label style="padding-bottom:0px;">Formula </label>
					<label></label>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<input name="totcons" id="totcons" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					<input id="formula1" value="estcons * bdownqty" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" readonly>
					<!--<select class="easyui-combobox" name="f1a" id="f1a"
					data-options="editable:false, panelHeight:'auto'" style="width:50px;">
					<option value=""></option>
					<option value="1"> + </option>
					<option value="2"> - </option>
					<option value="3"> * </option>
					<option value="4"> / </option>
					</select>-->
					<input name="f1" id="f1" placeholder=" /100000000 " class="easyui-validatebox"
						style="width:100px; height:34px;" onkeyup="myFunction2a();" onchange="myFunction2a();">
					<!--<select class="easyui-combobox" name="f2a" id="f2a"
					data-options="editable:false, panelHeight:'auto'" style="width:50px;">
					<option value=""></option>
					<option value="+"> + </option>
					<option value="-"> - </option>
					<option value="*"> * </option>
					<option value="/"> / </option>
					</select>-->
					<input name="f2" id="f2" placeholder=" +100000000 " class="easyui-validatebox"
						style="width:100px; height:34px;" onkeyup="myFunction2a();" onchange="myFunction2a();">
				</div>
				<!--<div class="fitem">
				<label>Netto</label></br>
				<input name="totcons" id="totcons" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
				</div>-->
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">PPS</label></br>
					<input name="qrs" id="qrs" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;width:auto;">
					Total PO 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Unit
					</label></br>
					<input name="pocons1" id="pocons" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					<input name="pocons2b" id="pocons2" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					<input name="unit" id="unit"
						style="width: 88px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="editable:false,valueField:'unita',textField:'unita',url:'view/get_data.php?dt=piunit',prompt:'Unit',limitToList:true">
				</div>
				<a style="text-decoration:none; left:750px; margin-top:-32px;" href="javascript:void(0)"
					class="button-cancel"
					onclick="$('#dialog-formb').dialog('close'); $('#formb').form('reset'); sup2b(); $('#div_input_usage2').hide();">Cancel</a>
				<!-- <a style="text-decoration:none;" href="javascript:void(0)" class="button-submit" onclick="save();">Submit</a>-->
				<a style="text-decoration:none; left:825px; margin-top:-30px;" href="javascript:void(0)" value="Save"
					class="button-submit" onclick="save2(); sup2b(); $('#div_input_usage2').hide();">Save</a>
				<!--<a style="text-decoration:none; left:700px; bottom: 75px;" href="javascript:void(0)" class="button-request-po" onclick="save2b();">Save & Request PO</a>-->
			</div>
		</div>
	</form>
</div>

<!-- DIALOG FORM REQUEST PO -->
<div id="dialog-formc" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:350px;height:200px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
	<form id="formc" method="post">
		<input type="hidden" name="ordpk" id="ordpk2" value="<?php echo $ord; ?>">
		<input type="hidden" name="fu" id="fu" value="<?php echo $_SESSION['fu']; ?>">
		<div class="modal-dialog" style="width:325px; height:175px;">
			<div class="modal-content">
				<div
					style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Set material delivery date
					<div><br>
						<input required name="poreqdel" id="poreqdel" class="easyui-datebox"
							data-options="formatter:myformatter2,parser:myparser2" style="width:60%;"></br>
						<label
							style="width:auto; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date
							format must be in YYYY-MM-DD</label>
					</div>
					<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
					<a style="text-decoration:none; left:71px; top: 128px;" href="javascript:void(0)"
						class="button-cancel" onclick="cancelreq();">Cancel</a>
					<a style="text-decoration:none; left:150px; top: 128px;" href="javascript:void(0)"
						class="button-request-po" onclick="save2c();">Submit PO request</a>
				</div>
			</div>
		</div>
	</form>
</div>

<!-- Copy to -->
<div id="dialog-form2" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,resizable:false,modal:true,closable:false"
	style="width:884px;height:675px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
	<div class="modal-dialog2" style="width:98%; height:96%; overflow-y:scroll;overflow-x:hidden;">
		<form id="form2" method="post">
			<input type="hidden" name="ordpk" id="ordpk" size="8" value="<?php echo $ord; ?>">
			<input type="hidden" name="tot" id="tot" size="8">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div class="modal-title2">
						<div style="color:rgba(0, 0, 0, 0.38); font-size:14px;"></div>
						<div style="font-size:20px; line-height:24px; font-weight:bold;">Export materials</div><br>
						<div style="font-size:14px; line-height:18px; width:100%;">Select the order that you would like
							to export your selected materials to.</div>
						<div style="margin-top:-55;">
							<a href="javascript:void(0)"
								style="text-decoration:none; color:#000; font-size:28px; margin-left:780;"
								onclick="cancel2();"> X</a>
						</div>
						<div class="content-search4" style="margin-top:0px;">
							<div id="frame-cari4">
								<img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button">
								<input id="cari11" placeholder="Search..." class="input" onkeyup="Searchc();">
							</div>
						</div>
						<div style="margin-top:60px;margin-left:230px;">
							<input style="width:140px; height:28px;" id="cari14" name="cari14" class="easyui-combobox"
								data-options="valueField:'byrpk',textField:'byrnm',url:'view/get_data.php?dt=byr',prompt:'All buyers',onChange:Searchc,limitToList:'true'">
						</div>
					</div>

				</div>
				<!-- Modal body -->
				<div class="border-modal2" style="border:none;">
					<div style="padding:5px;">
						<div id="tabel2b" onclick="select1a();" style="top:20px;">
							<table id="dg2b" class="easyui-datagrid" title="" style="width:100%;height:auto;"
								align="center" url="view/get_data.php?dt=ord" toolbar="#tb" striped="true"
								pagination="true" rownumbers="false" multiple="true" collapsible="true"
								fitColumns="false" method="post"
								data-options="onCheckAll:function(){select1a();},onUncheckAll:function(){select1b();},ctrlSelect:true,checkOnSelect:true">
								<thead>
									<tr>
										<th data-options="field:'ck',checkbox:true"></th>
										<th field="ordno" width="150" sortable="true">Order no.</th>
										<th field="artno" width="150" sortable="true">Style</th>
										<th field="byrnm" width="200" sortable="true">Buyer</th>
										<th field="prodes" width="400" sortable="true">Product description</th>
									</tr>
								</thead>
							</table>
							<div style="margin-top:20px;">
								<hr
									style="height:1px; width:975px; margin-left:-23px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
								<div style="text-align:right; font-weight:700; font-size:14px;">
									<a href="javascript:void(0)" plain="true" onclick="select();" id="export"
										style="text-decoration:none; color:rgba(0, 0, 0, 0.38);">
										Export
									</a>
								</div>
							</div>
						</div>
					</div>
		</form>
	</div>
</div>
</div>
</div>

<!-- import -->
<div id="dialog-form2b" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:860px;height:575px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
	<!-- <div class="modal-dialog2" style="width:98%; height:96%; overflow-y:scroll;overflow-x:hidden;"> -->
	<form id="form2b" method="post">
		<input type="hidden" name="ordpk" id="ordpk" value="<?php echo $ord; ?>" size="8">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<div class="modal-title2">
					<div style="font-size:16px; font-weight:bold;">Import materials</div><br>
					<div style="width:100%;">Importing materials will insert all the materials from the selected
						style.</div>
					<div style="margin-top:-45px;">
						<a href="javascript:void(0)"
							style="text-decoration:none; color:#000; font-size:28px; margin-left:775px;"
							onclick="cancel2b();"> X</a>
					</div>
					<div class="content-search4" style="margin-top:-10px;">
						<div id="frame-cari4">
							<img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button">
							<input id="cari12a" placeholder="Search..." class="input" onkeyup="Searchc2();">
						</div>
					</div>
				</div>
			</div>
			<!-- Modal body -->
			<div class="border-modal2" style="border:none;">
				<!--<div style="padding:5px;">-->
				<div id="tabel2b" onclick="importdata2();" style="margin-top:-25px;">
					<table id="dg2b2" class="easyui-datagrid" title="" style="width:100%;height:425px;"
						align="center" url="view/get_data.php?dt=ord2" toolbar="#tb" striped="true" pageSize="100"
						pageList="[100,200,300,500]" pagination="true" rownumbers="false" singleSelect="true"
						collapsible="true" fitColumns="true" method="post">
						<thead>
							<tr>
								<th field="artno" width="100" sortable="true">Style</th>
								<th field="ordno" width="100" sortable="true">Order no</th>
								<th field="byrnm" width="100" sortable="true">Buyer</th>
								<th field="prodes" width="408" sortable="true">Product description</th>
								<th field="act" width="100" sortable="false">Action</th>
							</tr>
						</thead>
					</table>
				</div>
				<!--</div>-->
			</div>
		</div>
	</form>
	<!-- </div> -->
</div>

<div id="dialog-form2c" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,reziable:false,modal:true,closable:false"
	style="width:980px;height:610px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
	<!-- <div class="modal-dialog2" style="width:98%; height:96%; overflow-y:scroll;overflow-x:hidden;"> -->
	<form id="form2c" method="post">
		<input type="hidden" name="ordpk" id="ordpk" value="<?php echo $ord; ?>" size="8">
		<input type="hidden" name="ordpk" id="cari12">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<div class="modal-title2">
					<a href="javascript:void(0)" style="text-decoration:none; color:#000;" onclick="cancel2c();">
						<div style="margin-top:10px;"><img src="css/images/Vector2.png" width="20" height="20">
						</div>
						<div style="font-size:16px; margin-left:25px; margin-top:-15px;">Back</div>
					</a><br>
					<div id="artno" style="font-size:14px; font-weight:bold;"></div>
					<div id="byr"></div>
					<div id="prodes"></div><br>
					<div style="font-size:16px; font-weight:bold;">Select materials to import</div>
					<!-- <div style="margin-top:-115px;">
							<a href="javascript:void(0)"
								style="text-decoration:none; color:#000; font-size:28px; margin-left:900px;"
								onclick="cancel2c();"> X</a>
						</div> -->
					<div class="content-search4" style="margin-top:70px;">
						<div id="frame-cari4">
							<img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button">
							<input id="cari13" placeholder="Search Material" class="input" onkeyup="Searchc3();">
						</div>
					</div>
				</div>
			</div>
			<!-- Modal body -->
			<div class="border-modal2" style="border:none; margin-top:70px">
				<div style="padding:5px;">
					<div id="tabel2b" onclick="select2();" style="width:925px; margin-top:-25px">
						<table id="dg2b3" class="easyui-datagrid" title="" style="width:100%;height:350px;"
							align="center" url="view/get_data.php?dt=mat" idField="rkbpk" toolbar="#tb"
							striped="true" pageSize="100" pageList="[100,200,300,500]" pagination="true"
							rownumbers="false" multiple="true" collapsible="true" fitColumns="false" method="post"
							data-options="onCheckAll:function(){select2();},onUncheckAll:function(){select3();},ctrlSelect:true,checkOnSelect:true">
							<thead>
								<tr>
									<th data-options="field:'ck',checkbox:true"></th>
									<th field="item" width="115" sortable="true">Item</th>
									<th field="supnm" width="125" sortable="true">Supplier</th>
									<th field="spec" width="175" sortable="true">Specification</th>
									<th field="specadd" width="175" sortable="true">Placement</th>
									<th field="qty" width="90" sortable="true">Qty</th>
									<th field="unit" width="90" sortable="true">Units</th>
									<th field="colname" width="100" sortable="true">Color</th>
									<th field="colcode" width="100" sortable="true">Col Code</th>
									<th field="sizegar" width="100" sortable="true">Size</th>
								</tr>
							</thead>
						</table>
						<div style="margin-top:30px;">
							<hr
								style="height:1px; width:975px; margin-left:-23px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
							<div style="text-align:right; font-weight:700; font-size:14px;">
								<a href="javascript:void(0)" plain="true" onclick="select2b();" id="import"
									style="text-decoration:none; color:rgba(0, 0, 0, 0.38);">
									Import
								</a>
							</div>
						</div>
	</form>
</div>
</div>
</div>
</div>
<!-- </div> -->
</div>

<!-- LOOKUP Color -->
<div id="dialog-forme" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,reziable:false,modal:true,closable:false"
	style="width:900px;height:550px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
	<div class="modal-dialog" style="width:98%; height:96%; overflow-y:scroll;overflow-x:hidden;">
		<div class="modal-content">
			<div
				style="margin-top:10px; margin-left:15px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
				Lookup Color
				<a href="javascript:void(0)"
					style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:680px;"
					onclick="$('#dialog-forme').dialog('close');"> X</a>
			</div>
			<div class="content-search3" style="margin-top:-35px;">
				<div id="frame-cari3">
					<img src="css/images/Shape.png" plain="true" width="18px" height="18px">
					<input id="cari7" placeholder="Search..." class="input" onkeyup="Search4a();">
				</div>
			</div>
			<!--<img src="css/images/Shape.png" plain="true" width="18px" height="18px" style="margin-top:-22px; margin-left:168px;" onclick="get_lookup();">
<input id="cari7" placeholder="Search Color" class="input" onkeyup="Search4a();" style="width:218px; height:30px;margin-top:-26px; margin-left:190px;">-->
			<div id="tabel2" onclick="get_lookup();" style="width:860px; margin-top:25px;">
				<table id="dg4e" class="easyui-datagrid" title="" style="width:100%;height:460px;" align="center"
					url="view/get_data.php?dt=color" toolbar="#tb2" striped="true" pageSize="100"
					pageList="[100,200,300,500]" pagination="true" rownumbers="false" singleSelect="true"
					collapsible="true" fitColumns="false" data-options="multiSort:true">
					<thead>
						<tr>
							<th field="colcode" width="300" sortable="true">Color Code</th>
							<th field="colname" width="480" sortable="true">Color Name</th>
							<th field="action" width="78">Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- LOOKUP Spec -->
<div id="dialog-formf" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,reziable:false,modal:true,closable:false"
	style="width:900px;height:550px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
	<div class="modal-dialog" style="width:98%; height:96%; overflow-y:scroll;overflow-x:hidden;">
		<div class="modal-content">
			<div
				style="margin-top:10px; margin-left:15px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
				Lookup Material
				<a href="javascript:void(0)"
					style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:660px;"
					onclick="$('#dialog-formf').dialog('close');"> X</a>
			</div>
			<div class="content-search3" style="margin-top:-35px;">
				<div id="frame-cari3">
					<img src="css/images/Shape.png" plain="true" width="18px" height="18px">
					<input id="cari8" placeholder="Search..." class="input" onkeyup="Search4b();">
				</div>
			</div>
			<!--<img src="css/images/Shape.png" plain="true" width="18px" height="18px" style="margin-top:-22px; margin-left:178px;" onclick="get_mb();">
<input id="cari8" placeholder="Search item material" class="input" onkeyup="Search4b();" style="width:218px; height:30px;margin-top:-26px; margin-left:200px;"></br>-->
			<div id="tabel2" onclick="get_mb();" style="width:860px; margin-top:25px;">
				<table id="dg4f" class="easyui-datagrid" title="" style="width:100%;height:460px;" align="center"
					url="view/get_data.php?dt=mb" toolbar="#tb2" striped="true" pageSize="100"
					pageList="[100,200,300,500]" pagination="true" rownumbers="false" singleSelect="true"
					collapsible="true" fitColumns="false" data-options="multiSort:true">
					<thead>
						<tr>
							<th field="item" width="300" sortable="true">Item</th>
							<th field="spec" width="480" sortable="true">Specification</th>
							<th field="action" width="78">Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- LOOKUP BREAKDOWN -->
<div id="dialog-formg" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,reziable:false,modal:true,closable:false"
	style="width:100%;height:660px; padding:5px 5px; display:none;top:0px;border-radius:8px;">
	<div class="modal-content">
		<input type="hidden" name="bdownqty1" id="bdownqty1">
		<input type="hidden" name="sz1" id="sz1">
		<input type="hidden" name="col1" id="col1">
		<input type="hidden" name="bdwpk" id="bdwpk">
		<input type="hidden" name="klm" id="klm">
		<div
			style="margin-top:0px; margin-left:15px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
			Data Breakdown
		</div>
		<div style="margin-top:-30px;margin-left:97%;">
			<a href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:28px;"
				onclick="$('#dialog-formg').dialog('close');"> X</a>
		</div>
		<div style="margin-left:90%;">
			<a style="margin-right:10px;" href="javascript:void(0);" class="easyui-linkbutton" id="btn1"
				data-options="iconCls:'icon-add'" onclick="gtrow();">Get</a>
		</div>
		<br>
		<!-- <div class="modal-dialog" style="width:98%; height:93%; overflow-y:scroll;overflow-x:hidden;"> -->
		<div id="tabel2">
			<table id="dg4g" class="easyui-datagrid" title="" style="width:99.5%;height:540px;" align="center"
				url="view/get_data.php?dt=bdown&ord=<?php echo $ord; ?>" toolbar="#tb2" striped="false"
				showFooter="true" pagination="false" rownumbers="false" singleSelect="true" collapsible="false"
				fitColumns="true">
				<!--data-options="iconCls: 'icon-save',
			  rowStyler: function(index,row){
				 if (row.jenis == 'FOOTER'){
					   return 'background-color:#d8d8d8;color:#000000;';
					}
																	else if (row.jenis == 'HEADER'){
						return 'background-color:#ff0000;color:#fff;';
					}
				}"-->
				<thead>
					<?php
					$ord = $_GET['ord'];
					$crh = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and jenis='HEADER' order by bdownpk desc limit 1");
					$dth = mysqli_fetch_array($crh);
					if ($dth['s1'] <> "" || !empty($dth['s1'])) {
						$sz1 = 1;
					} else {
						$sz1 = 0;
						$hidden1 = "hidden";
					}
					if ($dth['s2'] <> "" || !empty($dth['s2'])) {
						$sz2 = 1;
					} else {
						$sz2 = 0;
						$hidden2 = "hidden";
					}
					if ($dth['s3'] <> "" || !empty($dth['s3'])) {
						$sz3 = 1;
					} else {
						$sz3 = 0;
						$hidden3 = "hidden";
					}
					if ($dth['s4'] <> "" || !empty($dth['s4'])) {
						$sz4 = 1;
					} else {
						$sz4 = 0;
						$hidden4 = "hidden";
					}
					if ($dth['s5'] <> "" || !empty($dth['s5'])) {
						$sz5 = 1;
					} else {
						$sz5 = 0;
						$hidden5 = "hidden";
					}
					if ($dth['s6'] <> "" || !empty($dth['s6'])) {
						$sz6 = 1;
					} else {
						$sz6 = 0;
						$hidden6 = "hidden";
					}
					if ($dth['s7'] <> "" || !empty($dth['s7'])) {
						$sz7 = 1;
					} else {
						$sz7 = 0;
						$hidden7 = "hidden";
					}
					if ($dth['s8'] <> "" || !empty($dth['s8'])) {
						$sz8 = 1;
					} else {
						$sz8 = 0;
						$hidden8 = "hidden";
					}
					if ($dth['s9'] <> "" || !empty($dth['s9'])) {
						$sz9 = 1;
					} else {
						$sz9 = 0;
						$hidden9 = "hidden";
					}
					if ($dth['s10'] <> "" || !empty($dth['s10'])) {
						$sz10 = 1;
					} else {
						$sz10 = 0;
						$hidden10 = "hidden";
					}
					if ($dth['s11'] <> "" || !empty($dth['s11'])) {
						$sz11 = 1;
					} else {
						$sz11 = 0;
						$hidden11 = "hidden";
					}
					if ($dth['s12'] <> "" || !empty($dth['s12'])) {
						$sz12 = 1;
					} else {
						$sz12 = 0;
						$hidden12 = "hidden";
					}
					if ($dth['s13'] <> "" || !empty($dth['s13'])) {
						$sz13 = 1;
					} else {
						$sz13 = 0;
						$hidden13 = "hidden";
					}
					if ($dth['s14'] <> "" || !empty($dth['s14'])) {
						$sz14 = 1;
					} else {
						$sz14 = 0;
						$hidden14 = "hidden";
					}
					if ($dth['s15'] <> "" || !empty($dth['s15'])) {
						$sz15 = 1;
					} else {
						$sz15 = 0;
						$hidden15 = "hidden";
					}
					if ($dth['s16'] <> "" || !empty($dth['s16'])) {
						$sz16 = 1;
					} else {
						$sz16 = 0;
						$hidden16 = "hidden";
					}
					if ($dth['s17'] <> "" || !empty($dth['s17'])) {
						$sz17 = 1;
					} else {
						$sz17 = 0;
						$hidden17 = "hidden";
					}
					if ($dth['s18'] <> "" || !empty($dth['s18'])) {
						$sz18 = 1;
					} else {
						$sz18 = 0;
						$hidden18 = "hidden";
					}
					if ($dth['s19'] <> "" || !empty($dth['s19'])) {
						$sz19 = 1;
					} else {
						$sz19 = 0;
						$hidden19 = "hidden";
					}
					if ($dth['s20'] <> "" || !empty($dth['s20'])) {
						$sz20 = 1;
					} else {
						$sz20 = 0;
						$hidden20 = "hidden";
					}
					if ($dth['s21'] <> "" || !empty($dth['s21'])) {
						$sz21 = 1;
					} else {
						$sz21 = 0;
						$hidden21 = "hidden";
					}
					if ($dth['s22'] <> "" || !empty($dth['s22'])) {
						$sz22 = 1;
					} else {
						$sz22 = 0;
						$hidden22 = "hidden";
					}
					if ($dth['s23'] <> "" || !empty($dth['s23'])) {
						$sz23 = 1;
					} else {
						$sz23 = 0;
						$hidden23 = "hidden";
					}
					if ($dth['s24'] <> "" || !empty($dth['s24'])) {
						$sz24 = 1;
					} else {
						$sz24 = 0;
						$hidden24 = "hidden";
					}
					if ($dth['s25'] <> "" || !empty($dth['s25'])) {
						$sz25 = 1;
					} else {
						$sz25 = 0;
						$hidden25 = "hidden";
					}
					if ($dth['s26'] <> "" || !empty($dth['s26'])) {
						$sz26 = 1;
					} else {
						$sz26 = 0;
						$hidden26 = "hidden";
					}
					if ($dth['s27'] <> "" || !empty($dth['s27'])) {
						$sz27 = 1;
					} else {
						$sz27 = 0;
						$hidden27 = "hidden";
					}
					if ($dth['s28'] <> "" || !empty($dth['s28'])) {
						$sz28 = 1;
					} else {
						$sz28 = 0;
						$hidden28 = "hidden";
					}
					if ($dth['s29'] <> "" || !empty($dth['s29'])) {
						$sz29 = 1;
					} else {
						$sz29 = 0;
						$hidden29 = "hidden";
					}
					if ($dth['s30'] <> "" || !empty($dth['s30'])) {
						$sz30 = 1;
					} else {
						$sz30 = 0;
						$hidden30 = "hidden";
					}
					if ($dth['s31'] <> "" || !empty($dth['s31'])) {
						$sz31 = 1;
					} else {
						$sz31 = 0;
						$hidden31 = "hidden";
					}
					if ($dth['s32'] <> "" || !empty($dth['s32'])) {
						$sz32 = 1;
					} else {
						$sz32 = 0;
						$hidden32 = "hidden";
					}
					if ($dth['s33'] <> "" || !empty($dth['s33'])) {
						$sz33 = 1;
					} else {
						$sz33 = 0;
						$hidden33 = "hidden";
					}
					if ($dth['s34'] <> "" || !empty($dth['s34'])) {
						$sz34 = 1;
					} else {
						$sz34 = 0;
						$hidden34 = "hidden";
					}
					if ($dth['s35'] <> "" || !empty($dth['s35'])) {
						$sz35 = 1;
					} else {
						$sz35 = 0;
						$hidden35 = "hidden";
					}
					if ($dth['s36'] <> "" || !empty($dth['s36'])) {
						$sz36 = 1;
					} else {
						$sz36 = 0;
						$hidden36 = "hidden";
					}
					if ($dth['s37'] <> "" || !empty($dth['s37'])) {
						$sz37 = 1;
					} else {
						$sz37 = 0;
						$hidden37 = "hidden";
					}
					if ($dth['s38'] <> "" || !empty($dth['s38'])) {
						$sz38 = 1;
					} else {
						$sz38 = 0;
						$hidden38 = "hidden";
					}
					if ($dth['s39'] <> "" || !empty($dth['s39'])) {
						$sz39 = 1;
					} else {
						$sz39 = 0;
						$hidden39 = "hidden";
					}
					if ($dth['s40'] <> "" || !empty($dth['s40'])) {
						$sz40 = 1;
					} else {
						$sz40 = 0;
						$hidden40 = "hidden";
					}
					$cjml = $sz1 + $sz2 + $sz3 + $sz4 + $sz5 + $sz6 + $sz7 + $sz8 + $sz9 + $sz10
						+ $sz11 + $sz12 + $sz13 + $sz14 + $sz15 + $sz16 + $sz17 + $sz18 + $sz19 + $sz20
						+ $sz21 + $sz22 + $sz23 + $sz24 + $sz25 + $sz26 + $sz27 + $sz28 + $sz29 + $sz30
						+ $sz31 + $sz32 + $sz33 + $sz34 + $sz35 + $sz36 + $sz37 + $sz38 + $sz39 + $sz40;
					?>
					<tr>
						<th field="jenis" width="35" hidden="true">Jenis</th>
						<th field="country" width="100">Place</th>
						<th field="pono" width="100">PO no.</th>
						<th field="opno" width="100">OP no.</th>
						<th field="style" width="100">Style</th>
						<th field="color" width="100">Color</th>
						<th field="gac" width="100">Ex Factory</th>
						<th field="s1" width="50" <?php echo $hidden1; ?>></th>
						<th field="s2" width="50" <?php echo $hidden2; ?>></th>
						<th field="s3" width="50" <?php echo $hidden3; ?>></th>
						<th field="s4" width="50" <?php echo $hidden4; ?>></th>
						<th field="s5" width="50" <?php echo $hidden5; ?>></th>
						<th field="s6" width="50" <?php echo $hidden6; ?>></th>
						<th field="s7" width="50" <?php echo $hidden7; ?>></th>
						<th field="s8" width="50" <?php echo $hidden8; ?>></th>
						<th field="s9" width="50" <?php echo $hidden9; ?>></th>
						<th field="s10" width="50" <?php echo $hidden10; ?>></th>
						<th field="s11" width="50" <?php echo $hidden11; ?>></th>
						<th field="s12" width="50" <?php echo $hidden12; ?>></th>
						<th field="s13" width="50" <?php echo $hidden13; ?>></th>
						<th field="s14" width="50" <?php echo $hidden14; ?>></th>
						<th field="s15" width="50" <?php echo $hidden15; ?>></th>
						<th field="s16" width="50" <?php echo $hidden16; ?>></th>
						<th field="s17" width="50" <?php echo $hidden17; ?>></th>
						<th field="s18" width="50" <?php echo $hidden18; ?>></th>
						<th field="s19" width="50" <?php echo $hidden19; ?>></th>
						<th field="s20" width="50" <?php echo $hidden20; ?>></th>
						<th field="s21" width="50" <?php echo $hidden21; ?>></th>
						<th field="s22" width="50" <?php echo $hidden22; ?>></th>
						<th field="s23" width="50" <?php echo $hidden23; ?>></th>
						<th field="s24" width="50" <?php echo $hidden24; ?>></th>
						<th field="s25" width="50" <?php echo $hidden25; ?>></th>
						<th field="s26" width="50" <?php echo $hidden26; ?>></th>
						<th field="s27" width="50" <?php echo $hidden27; ?>></th>
						<th field="s28" width="50" <?php echo $hidden28; ?>></th>
						<th field="s29" width="50" <?php echo $hidden29; ?>></th>
						<th field="s30" width="50" <?php echo $hidden30; ?>></th>
						<th field="s31" width="50" <?php echo $hidden31; ?>></th>
						<th field="s32" width="50" <?php echo $hidden32; ?>></th>
						<th field="s33" width="50" <?php echo $hidden33; ?>></th>
						<th field="s34" width="50" <?php echo $hidden34; ?>></th>
						<th field="s35" width="50" <?php echo $hidden35; ?>></th>
						<th field="s36" width="50" <?php echo $hidden36; ?>></th>
						<th field="s37" width="50" <?php echo $hidden37; ?>></th>
						<th field="s38" width="50" <?php echo $hidden38; ?>></th>
						<th field="s39" width="50" <?php echo $hidden39; ?>></th>
						<th field="s40" width="50" <?php echo $hidden40; ?>></th>
						<th field="tot" width="70">Total</th>
					</tr>
				</thead>
			</table>
		</div>
		<!-- </div> -->
	</div>
</div>

<!-- DIALOG FORM NOTIF REPLACE -->
<div id="dialog-formr" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:307px;height:200px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
	<form id="formr" method="post">
		<!-- <div class="modal-dialog" style="width:282px; height:175px;"> -->
		<div class="modal-content">
			<div
				style="margin-top:10px; margin-left:16px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
				Unable to replace
				<div><br>
					<label
						style="text-align:justify; width:250px;  font-style: normal; font-weight: 400; font-size: 14px; line-height: 18px;">
						Some items already have PO numbers <br>or ineligible to be edited. Please review <br>selected
						items and try again.</label>
				</div>
				<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
				<a style="text-decoration:none; width:100px; left:170px; top: 128px;"" href=" javascript:void(0)"
					class="button-request-po" onclick="$('#dialog-formr').dialog('close');">Okay</a>
			</div>
		</div>
		<!-- </div> -->
	</form>
</div>

<!-- DIALOG FORM PASTE -->
<div id="dialog-formp" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:440px;height:405px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
	<form id="formp" method="post">
		<input type="hidden" name="ordpk" id="ordpk" value="<?php echo $ord; ?>" size="8">
		<!-- <div class="modal-dialog" style="width:415px; height:380px;"> -->
		<div class="modal-content">
			<div
				style="margin-top:10px; margin-left:16px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
				Select which data set to copy
				<div><br>
					<?php
					$cek2 = mysqli_query($koneksi, "select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on cur.curpk=rkb.curpk
where rkb.ordpk='$ord' and rkb.copy='3' order by rkb.rkbpk desc limit 1");
					$hsl = mysqli_fetch_array($cek2);
					if ($hsl['curpk'] == 3) {
						$cursign = "&#8364;";
					} else {
						$cursign = $hsl['cursign'];
					}
					?>
					<table style="width:100%">
						<tr style="height:25px;">
							<td><a href="Javascript:void(0);" style="text-decoration:none;">
									<input type="checkbox" name="all" value="99" id="all" onclick="">
									<span
										style="font-weight:700; font-size:14px; line-height:18px; color:rgba(0,0,0,0.38);">
										All </span></a>
							<td>
						</tr>
						<tr style="height:25px;">
							<td style="width:130px;"><a href="Javascript:void(0);" style="text-decoration:none;">
									<input type="checkbox" name="ceek1" value="1" id="ceek1" onclick="cheek();">
									<span
										style="font-weight:700; font-size:14px; line-height:18px; color:rgba(0,0,0,0.38);">
										Item </span></a>
							<td>
							<td><span
									style="font-weight:400; font-size:16px; line-height:20px; color:#000000;"><?php echo truncate(TRIM($hsl['item']), 25); ?></span>
							</td>
						</tr>
						<tr style="height:25px;">
							<td><a href="Javascript:void(0);" style="text-decoration:none;">
									<input type="checkbox" name="ceek2" value="2" id="ceek2" onclick="cheek();">
									<span
										style="font-weight:700; font-size:14px; line-height:18px; color:rgba(0,0,0,0.38);">
										Description </span></a>
							<td>
							<td><span
									style="font-weight:400; font-size:16px; line-height:20px; color:#000000;"><?php echo truncate(TRIM($hsl['spec']), 25); ?></span>
							</td>
						</tr>
						<tr style="height:25px;">
							<td><a href="Javascript:void(0);" style="text-decoration:none;">
									<input type="checkbox" name="ceek3" value="3" id="ceek3" onclick="cheek();">
									<span
										style="font-weight:700; font-size:14px; line-height:18px; color:rgba(0,0,0,0.38);">
										Supplier </span></a>
							<td>
							<td><span
									style="font-weight:400; font-size:16px; line-height:20px; color:#000000;"><?php echo truncate(TRIM($hsl['supnm']), 25); ?></span>
							</td>
						</tr>
						<tr style="height:25px;">
							<td><a href="Javascript:void(0);" style="text-decoration:none;">
									<input type="checkbox" name="ceek4" value="4" id="ceek4" onclick="cheek();">
									<span
										style="font-weight:700; font-size:14px; line-height:18px; color:rgba(0,0,0,0.38);">
										Color </span></a>
							<td>
							<td><span
									style="font-weight:400; font-size:16px; line-height:20px; color:#000000;"><?php echo truncate(TRIM($hsl['colname']), 25); ?></span>
							</td>
						</tr>
						<tr style="height:25px;">
							<td><a href="Javascript:void(0);" style="text-decoration:none;">
									<input type="checkbox" name="ceek5" value="5" id="ceek5" onclick="cheek();">
									<span
										style="font-weight:700; font-size:14px; line-height:18px; color:rgba(0,0,0,0.38);">
										Consumption </span></a>
							<td>
							<td><span style="font-weight:400; font-size:16px; line-height:20px; color:#000000;">
									<?php if ($hsl['estcons'] == "" || $hsl['estcons'] == "0.0000") {
									} else { ?>
										<?php echo $hsl['estcons']; ?> <?php echo $hsl['unit']; ?>
									<?php } ?>
								</span></td>
						</tr>
						<tr style="height:25px;">
							<td><a href="Javascript:void(0);" style="text-decoration:none;">
									<input type="checkbox" name="ceek6" value="6" id="ceek6" onclick="cheek();">
									<span
										style="font-weight:700; font-size:14px; line-height:18px; color:rgba(0,0,0,0.38);">
										Allowance </span></a>
							<td>
							<td><span style="font-weight:400; font-size:16px; line-height:20px; color:#000000;">
									<?php if ($hsl['allowcons'] == "" || $hsl['allowcons'] == "0.00") {
									} else { ?>
										<?php echo $hsl['allowcons']; ?> %
									<?php } ?>
								</span></td>
						</tr>
						<tr style="height:25px;">
							<td><a href="Javascript:void(0);" style="text-decoration:none;">
									<input type="checkbox" name="ceek7" value="7" id="ceek7" onclick="cheek();">
									<span
										style="font-weight:700; font-size:14px; line-height:18px; color:rgba(0,0,0,0.38);">
										Quantity </span></a>
							<td>
							<td><span style="font-weight:400; font-size:16px; line-height:20px; color:#000000;">
									<?php if ($hsl['bdownqty'] < 1) {
									} else { ?>
										<?php echo $hsl['bdownqty']; ?> <?php echo $hsl['unit']; ?>
									<?php } ?>
								</span></td>
						</tr>
						<tr style="height:25px;">
							<td><a href="Javascript:void(0);" style="text-decoration:none;">
									<input type="checkbox" name="ceek8" value="8" id="ceek8" onclick="cheek();">
									<span
										style="font-weight:700; font-size:14px; line-height:18px; color:rgba(0,0,0,0.38);">
										Price / UOM </span></a>
							<td>
							<td><span style="font-weight:400; font-size:16px; line-height:20px; color:#000000;">
									<?php if ($hsl['price'] == "" || $hsl['price'] == "0.00000") {
									} else { ?>
										<?php echo $cursign; ?> <?php echo $hsl['price']; ?>
									<?php } ?>
								</span></td>
						</tr>
						<tr style="height:25px;">
							<td><a href="Javascript:void(0);" style="text-decoration:none;">
									<input type="checkbox" name="ceek9" value="9" id="ceek9" onclick="cheek();">
									<span
										style="font-weight:700; font-size:14px; line-height:18px; color:rgba(0,0,0,0.38);">
										Unit </span></a>
							<td>
							<td><span style="font-weight:400; font-size:16px; line-height:20px; color:#000000;">
									<?php echo $hsl['unit']; ?>
								</span></td>
						</tr>
					</table>
					</span>
					<a style="text-decoration:none; left:200px; top:333px;" href="javascript:void(0)"
						class="button-cancel" onclick="$('#dialog-formp').dialog('close'); cancopy();">Cancel</a>
					<a style="text-decoration:none; width:120px; left:275px; top:333px; background-color:#BDBDBD;"
						href="javascript:void(0)" class="button-request-po" onclick="savereplace();">Copy & Replace</a>
				</div>
			</div>
			<!-- </div> -->
	</form>
</div>

<!-- DIALOG FORM REQUEST PO -->
<div id="dialog-formpo" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:310px;height:200px;padding:5px 5px;display:none;top:100px;border-radius:8px;">
	<form id="formpo" method="post">
		<input type="hidden" name="ordpk" value="<?php echo $ord; ?>">
		<input type="hidden" name="fu" value="<?php echo $_SESSION['fu']; ?>">
		<!--<div class="modal-dialog" style="width:285px; height:175px;">-->
		<div class="modal-content">
			<div
				style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
				Processing items for PO
				<div><br>
					<label
						style="width:auto; font-style: normal; font-weight: 400; font-size: 14px; line-height: 18px;">
						All your materials will now be registered <br>in the purchasing menu. Continue?
					</label>
				</div>
				<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
				<a style="text-decoration:none; left:91px; top: 128px;" href="javascript:void(0)" class="button-cancel"
					onclick="cancelpo();">Cancel</a>
				<a style="text-decoration:none; left:170px; top: 128px; width:100px;" href="javascript:void(0)"
					class="button-request-po" onclick="savepo();">Yes</a>
			</div>
		</div>
		<!--</div>-->
	</form>
</div>

<div id="dialog-formpo1" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:375px;height:250px;padding:5px 5px;display:none;top:100px;border-radius:8px;">
	<form id="formpo1" method="post">
		<input type="hidden" name="ordpk" value="<?php echo $ord; ?>">
		<input type="hidden" name="fu" value="<?php echo $_SESSION['fu']; ?>">
		<!--<div class="modal-dialog" style="width:285px; height:175px;">-->
		<div class="modal-content">
			<div
				style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
				Processing items for PO
				<div><br>
					<label
						style="width:auto; font-style: normal; font-weight: 400; font-size: 14px; line-height: 18px;">
						All your materials will now be processed for <br> purchasing with the following paramaters:
					</label><br><br>
					<label
						style="width:auto; font-style: normal; font-weight: 400; font-size: 14px; line-height: 18px;">
						. Fabric materials will be managed by you<br>
						. Everything else is relayed to purchasing
					</label>
				</div>
				<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
				<a style="text-decoration:none; left:170px; top: 200px;" href="javascript:void(0)" class="button-cancel"
					onclick="cancelpo1();">Cancel</a>
				<a style="text-decoration:none; left:250px; top: 200px; width:100px;" href="javascript:void(0)"
					class="button-request-po" onclick="savepo1();">Confirm</a>
			</div>
		</div>
		<!--</div>-->
	</form>
</div>

<div id="dialog-formpo2" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:310px;height:200px;padding:5px 5px;display:none;top:100px;border-radius:8px;">
	<form id="formpo2" method="post">
		<input type="hidden" name="ordpk" value="<?php echo $ord; ?>">
		<input type="hidden" name="fu" value="<?php echo $_SESSION['fu']; ?>">
		<input type="hidden" name="totreq" id="totreq">
		<!--<div class="modal-dialog" style="width:285px; height:175px;">-->
		<div class="modal-content">
			<div
				style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
				Processing items for PO
				<div><br>
					<label
						style="width:auto; font-style: normal; font-weight: 400; font-size: 14px; line-height: 18px;">
						All your materials will now be registered <br>in the purchasing menu. Continue?
					</label>
				</div>
				<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
				<a style="text-decoration:none; left:91px; top: 128px;" href="javascript:void(0)" class="button-cancel"
					onclick="cancelpo2();">Cancel</a>
				<a style="text-decoration:none; left:170px; top: 128px; width:100px;" href="javascript:void(0)"
					class="button-request-po" onclick="savepo2();">Yes</a>
			</div>
		</div>
		<!--</div>-->
	</form>
</div>

<div id="dialog-formpo2b" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:400px;height:200px;padding:5px 5px;display:none;top:100px;border-radius:8px;">
	<form id="formpo2b" method="post">
		<input type="hidden" name="ordpk" value="<?php echo $ord; ?>">
		<input type="hidden" name="fu" value="<?php echo $_SESSION['fu']; ?>">
		<input type="hidden" name="totreq2" id="totreq2">
		<!--<div class="modal-dialog" style="width:285px; height:175px;">-->
		<div class="modal-content">
			<div
				style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
				Processing for purchasing
				<div><br>
					<label
						style="width:auto; font-style: normal; font-weight: 400; font-size: 14px; line-height: 18px;">
						Who will manage the purchase order process for <br> these materials?
					</label>
				</div>
				<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
				<a style="text-decoration:none; left:75px; top: 128px; border:1px solid #000000; background-color:#FFFFFF; color:#000000; width:175px;"
					href="javascript:void(0)" class="button-cancel" onclick="savereqpo2aa();">Assign to purchasing</a>
				<a style="text-decoration:none; left:260px; top: 128px; width:100px;" href="javascript:void(0)"
					class="button-request-po" onclick="savereqpo2();">Assign to me</a>
			</div>
		</div>
		<!--</div>-->
	</form>
</div>

<!-- DIALOG FORM REQUEST PO -->
<div id="dialog-formdel" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:350px;height:200px;padding:5px 5px;display:none;top:100px;border-radius:8px;">
	<form id="formdel" method="post">
		<input type="hidden" name="ordpk" value="<?php echo $ord; ?>">
		<input type="hidden" name="fu" id="fu" value="<?php echo $_SESSION['fu']; ?>">
		<!-- <div class="modal-dialog" style="width:325px; height:175px;"> -->
		<div class="modal-content">
			<div
				style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
				Set material delivery date
				<div><br>
					<input required name="poreqdel" id="poreqdel" class="easyui-datebox"
						data-options="formatter:myformatter2,parser:myparser2" style="width:60%;"></br>
					<label
						style="width:auto; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date
						format must be in YYYY-MM-DD</label>
				</div>
				<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
				<a style="text-decoration:none; left:71px; top: 128px;" href="javascript:void(0)" class="button-cancel"
					onclick="canreqpo();">Cancel</a>
				<!-- <a style="text-decoration:none; left:150px; top: 128px;" href="javascript:void(0)" class="button-request-po" onclick="savereqpo();">Submit PO request</a> -->
				<a style="text-decoration:none; left:150px; top: 128px;" href="javascript:void(0)"
					class="button-request-po" onclick="savereqpo2a();">Submit PO request</a>
			</div>
		</div>
		<!-- </div> -->
	</form>
</div>
<!--requestega-->
<div id="dialog-formdel2" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:350px;height:200px;padding:5px 5px;display:none;top:100px;border-radius:8px;">
	<form id="formdel2" method="post">
		<input type="hidden" name="ordpk" value="<?php echo $ord; ?>">
		<input type="hidden" name="fu" id="fu" value="<?php echo $_SESSION['fu']; ?>">
		<!-- <div class="modal-dialog" style="width:325px; height:175px;"> -->
		<div class="modal-content">
			<div
				style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
				Set material delivery date
				<div><br>
					<input required name="poreqdel" id="poreqdel" class="easyui-datebox"
						data-options="formatter:myformatter2,parser:myparser2" style="width:60%;"></br>
					<label
						style="width:auto; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date
						format must be in YYYY-MM-DD</label>
				</div>
				<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
				<a style="text-decoration:none; left:71px; top: 128px;" href="javascript:void(0)" class="button-cancel"
					onclick="canreqpo2();">Cancel</a>
				<a style="text-decoration:none; left:150px; top: 128px;" href="javascript:void(0)"
					class="button-request-po" onclick="savereqpo();">Submit PO request</a>
				<!-- <a style="text-decoration:none; left:150px; top: 128px;" href="javascript:void(0)" class="button-request-po" onclick="savereqpo2a();">Submit PO request</a> -->
			</div>
		</div>
		<!-- </div> -->
	</form>
</div>

<div id="dialog-forminfo" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:30%;height:47%;padding:5px 5px;display:none;top:0px;border-radius:8px;">
	<form id="forminfo" method="post">
		<div class="modal-content">
			<div id="close" style="margin-top:0px; margin-left:90%;">
				<a id="close" href="javascript:void(0)"
					style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
					onclick="$('#dialog-forminfo').dialog('close'); $('#forminfo').form('reset');"> X</a>
			</div>
			<input type="hidden" id="ponoi" name="ponoi">
			<input type="hidden" id="rkbpki" name="rkbpki">
			<input type="hidden" id="rkbpki2" name="rkbpki2">
			<input type="hidden" id="popkship" name="popkship">
			<input type="hidden" id="importshipa" name="importshipa">
			<!-- <input type="hidden" id="popki" name="popki">
<input type="hidden" id="podtpki" name="podtpki"> -->
			<div
				style="margin-top:-25px;margin-left: 15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">
				Arrival date record</div><br>
			<div id="tbinf" style="margin-left:15px;" onclick="">
				<table id="dginf" class="easyui-datagrid" title="" style="width:92%;height:180px;" align="center" toolbar="#tb2" striped="false" border="true"
					pageSize="100" pageList="[100,200,300,500]" pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="true" data-options="multiSort:false">
					<thead>
						<tr>
							<th field="vassalnm" width="100" formatter="formatter2">Shipment</th>
							<th field="tgldtg" width="99">Date</th>
							<th field="qtydtg" width="120">Amount</th>
							<th field="popk" width="120" hidden="true">Popk</th>
							<th field="importpk" width="120" hidden="true">importpk</th>
						</tr>
					</thead>
				</table>
			</div>
			<span style="margin-left: 15px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;" id="qtyinfo"></span>
		</div>
	</form>
</div>

<!--Shipment detail -->
<div id="dialog-enroute2" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:90%;height:100%;padding:5px 5px;display:none;top:0px;border-radius:8px;">
	<div id="close" style="margin-top:5px; margin-left:95%;">
		<a id="close" href="javascript:void(0)"
			style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
			onclick="$('#dialog-enroute2').dialog('close');"> X</a>
	</div>
	<div id="shipdetail2" style="margin-top:-15px;">
		<div class="ShipmentDetails"
			style="margin-top:15px;margin-left:15px;color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word">
			Shipment details</div>
		<table border="0" style="width:90%;margin-left:15px;">
			<tr>
				<th width="150" align="left">
					<div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
						Vassal type</div>
				</th>
				<th width="200" align="left">
					<div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
						Vassal name</div>
				</th>
				<th width="200" align="left">
					<div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
						AirwayBill Number</div>
				</th>
				<th width="200" align="left">
					<div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
						Arrival city</div>
				</th>
				<th width="200" align="left">
					<div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
						Port name</div>
				</th>
			</tr>
			<tr>
				<td align="left"><input type="text" name="typenm2" id="typenm2" style="border:none;" readonly></td>
				<td align="left"><input type="text" name="vassalnm2" id="vassalnm2" style="width: 200px;border:none;"
						readonly></td>
				<td align="left"><input type="text" name="bill2" id="bill2" style="width: 200px;border:none;" readonly></td>
				<td align="left"><input type="text" name="arrival2" id="arrival2" style="border:none;" readonly></td>
				<td align="left"><input type="text" name="port2" id="port2" style="border:none;" readonly></td>
			</tr>
		</table>
		<br>
		<div class="ItemDetails"
			style="margin-left:15px;color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word">
			Item details</div>
		<table border="0" style="margin-left:15px;">
			<tr>
				<th width="150" align="left">
					<div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
						Gross weight</div>
				</th>
				<th width="250" align="left">
					<div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
						Dimension of boxes</div>
				</th>
				<th width="250" align="left">
					<div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
						Total Package</div>
				</th>
			</tr>
			<tr>
				<td align="left"><input type="text" name="gw2" id="gw2" style="border:none;" readonly></td>
				<td align="left">(P)<input type="text" name="dp2" id="dp2" style="width: 35px;border:none;" readonly>x
					(L)<input type="text" name="dl2" id="dl2" style="width: 35px;border:none;" readonly>x (T)<input type="text"
						name="dt2" id="dt2" style="width: 35px;border:none;" readonly>cm</td>
				<td align="left"><input type="text" name="amount2" id="amount2" style="border:none;" readonly></td>
			</tr>
		</table>
		<br>
		<div class="ItemDetails2"
			style="margin-left:15px;color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word;">
			Shipment dates</div>
		<table border="0" style="margin-left:15px;">
			<tr>
				<th align="left" width="150">
					<div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word;">
						ETD</div>
				</th>
				<th align="left" width="150">
					<div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word;">
						ETA</div>
				</th>
				<th align="left" width="150">
					<div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word;">
						EIH (Estimate in house)</div>
				</th>
			</tr>
			<tr>
				<td align="left"><input type="text" name="etd222" id="etd222" class="easyui-validatebox" style="border:none;"
						data-options="formatter:myformatter,parser:myparser" readonly></td>
				<td align="left"><input type="text" name="eta222" id="eta222" class="easyui-validatebox" style="border:none;"
						data-options="formatter:myformatter,parser:myparser" readonly></td>
				<td align="left"><input type="text" name="eih222" id="eih222" class="easyui-validatebox" style="border:none;"
						data-options="formatter:myformatter,parser:myparser" readonly></td>
			</tr>
		</table>
		<br>
		<div id="tabel2c" onclick="" onmousemove="" style="margin-top:10px;margin-left:15px;">
			<div class="ItemDetails"
				style="color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word;">
				Shipment Log</div>
			<table id="dg2c" class="easyui-datagrid" title="" style="width:80%;height:275px;" align="center"
				url="view/get_log_shipment.php" border="none" striped="false" idField="importdtpk"
				data-options="fitColumns:true,singleSelect:true,pagination:false,collapsible:true,rownumbers:false,border:true,autoRowHeight:true">
				<thead>
					<tr>
						<th field="datelog" width="200" style="border:none;">Date</th>
						<th field="logchange" width="568">Changes</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<!--export excel-->
<div id="dialog-print" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:true,modal:true,closable:false"
	style="width:425px;height:200px;padding:5px 5px;display:none;top:50px;border-radius:8px;">
	<form id="form-print" method="post" enctype="multipart/form-data">
		<input type="hidden" name="ordpk" id="ordpkexp" size="8">
		<!-- <div class="modal-dialog" style="height:175px;"> -->
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<div class="modal-title" style="width:auto;font-size:18px;line-height:20px;">
					Print Material <span id="ordnoexp"></span> <br>
				</div>
			</div>
			<!-- Modal body -->
			<div style="padding:5px; margin-top:60px; margin-left:25px;">
				<span id="cek1"><input type="radio" name="cek" id="cek" value="1" checked>PDF</span>
				<span id="cek2"><input type="radio" name="cek" id="cek" value="2">Excel</span>
			</div>
			<!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
			<a style="text-decoration:none; left: 169px; top: 100px;" href="javascript:void(0)"
				class="button-cancel" onclick="canexp();">Cancel</a>
			<a style="text-decoration:none; width:100px; left: 246px; top: 100px;" href="javascript:void(0)"
				class="button-submit" onclick="cetak();">Export</a>
			<!--<input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
			<!-- </div> -->
	</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>