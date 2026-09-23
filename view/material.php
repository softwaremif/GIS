<?php
//include "action/sinkron1.php";
/*include "email/test.php";
include "email/test1.php";
include "email/test2.php";*/
include "action/sinkron4.php";
include "material_create.php";
include 'material_create_detail.php';
include "material_edit.php";
include 'material_edit_detail.php';
?>
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

		.tooltip {
				max-width: 200px; 
				word-wrap: break-word; 
				white-space: normal; 
		}
</style>

<script type="text/javascript">
	var url;
	/*var totmat = JSON.stringify($('#dg2').datagrid('getData').total);
	document.getElementById("totmat").value = totmat;*/
	/*var tabmat = "All material ("+data+")";
	document.write(tabmat); */

	$(function() {
		$.ajax({
			type: "POST",
			url: "view/get_copy.php",
			data: "ord=<?php echo $ord ?>",
			success: function(data) {
				document.getElementById('copy').value = data;
				var copy = document.getElementById('copy').value;
				if (copy == 1) {
					menu();
				}
			},
		});

		$.ajax({
			type: "POST",
			url: "view/get_pomat.php?x=bqty&ord=<?php echo $_GET['ord']; ?>",
			success: function(data) {
				document.getElementById('bqty').innerHTML = data;
			},
		});

		over1();
		over2();
		sumpo();
		sumreq();
		cost1();
		cost2();
	});

	function over1() {
		$.ajax({
			type: "POST",
			url: "view/get_over2.php?x=over1&ord=<?php echo $_GET['ord']; ?>",
			success: function(data) {
				if (data > 0) {
					$('#container-cari3b').show();
				} else {
					$('#container-cari3b').hide();
				}
				document.getElementById('overqty').innerHTML = data;
			},
		});
	}

	function over2() {
		$.ajax({
			type: "POST",
			url: "view/get_over2.php?x=over2&ord=<?php echo $_GET['ord']; ?>",
			success: function(data) {
				if (data > 0) {
					$('#container-cari3b').show();
				} else {
					$('#container-cari3b').hide();
				}
				document.getElementById('overprice').innerHTML = data;
			},
		});
	}

	function sumpo() {
		$.ajax({
			type: "POST",
			url: "view/get_pomat.php?x=sumpo&ord=<?php echo $_GET['ord']; ?>",
			success: function(data) {
				// if(data>0){
				$('#sumpo').show();
				// } else {
				// $('#sumpo').hide(); 
				// }
				document.getElementById('sumpo').innerHTML = data;
			},
		});
	}

	function sumreq() {
		$.ajax({
			type: "POST",
			url: "view/get_pomat.php?x=sumreq&ord=<?php echo $_GET['ord']; ?>",
			success: function(data) {
				// if(data>0){
				$('#sumreq').show();
				// } else {
				// $('#sumreq').hide(); 
				// }
				document.getElementById('sumreq').innerHTML = data;
			},
		});
	}

	function cost1() {
		$.ajax({
			type: "POST",
			url: "view/get_pomat.php?x=cost1&ord=<?php echo $_GET['ord']; ?>",
			success: function(data) {
				document.getElementById('cost1').innerHTML = data;
			},
		});
	}

	function cost2() {
		$.ajax({
			type: "POST",
			url: "view/get_pomat.php?x=cost2&ord=<?php echo $_GET['ord']; ?>",
			success: function(data) {
				document.getElementById('cost2').innerHTML = data;
			},
		});
	}


	/*menu*/
	function menu() {
		var cp = document.getElementById('copy').value;
		if (cp == 1) {
			$('#myHeader').show();
			$('#count2').show();
			$('#mreplace2').show();
			$('#mcancopy').show();
			$('#count').hide();
			$('#mreqrev').hide();
			$('#mcanreq').hide();
			$('#mcanreq2').hide();
			$('#medit').hide();
			$('#mreq').hide();
			$('#mprint').hide();
			$('#mreplace1').hide();
			$('#mcopy').hide();
			$('#mdel').hide();
			$('#mview').hide();
			$('#mviewpi').hide();
			$('#mexp').hide();
			$('#count2').css('margin-right', '61%');
		} else {
			var cc = [];
			var rows = $('#dg2').datagrid('getSelections');
			for (var i = 0; i < rows.length; i++) {
				var pono = rows[i]['pono'];
				if ($.inArray(pono, cc) == -1) { // not found
					cc.push(pono);
				}
			}

			var cc2 = [];
			var rows2 = $('#dg2').datagrid('getSelections');
			for (var i2 = 0; i2 < rows2.length; i2++) {
				var sts2 = rows2[i2]['status2'];
				if ($.inArray(sts2, cc2) == -1) { // not found
					cc2.push(sts2);
				}
			}
			var row = $('#dg2').datagrid('getSelected');
			console.log(row);

			var tchek = $('#dg2').datagrid('getChecked').length;
			var sfu = $('#sfu').val();

			if (row) {
				if (row.status2 == 4) {
					if (tchek > 1) {
						if (cc.length > 1) {
							$('#count').show();
							$('#medit').hide();
							$('#mcopy').show();
							$('#mreq').hide();
							$('#mdel').hide();
							$('#mview').hide();
							$('#mviewpi').hide();
							$('#mcanreq').hide();
							$('#mcanreq2').hide();
							$('#mreqrev').hide();
							$('#mprint').show();
							$('#count2').hide();
							$('#mreplace1').hide();
							$('#mreplace2').hide();
							$('#mcancopy').hide();
							count_row();
							$('#count').css('margin-right', '58%');
						} else {
							$('#count').show();
							$('#medit').hide();
							$('#mcopy').show();
							$('#mreq').hide();
							$('#mdel').hide();
							$('#mprint').show();
							$('#count2').hide();
							$('#mreplace1').hide();
							$('#mreplace2').hide();
							$('#mcancopy').hide();
							count_row();
							if (row.pono) {
								if (row.fup == sfu) {
									if (row.pur != "") {
										$('#mcanreq').hide();
										// $('#mcanreq2').hide();
										$('#mcanreq2').show();
										$('#mview').show();
										$('#mviewpi').show();
										$('#mreqrev').show();
										$('#count').css('margin-right', '21%');
									} else {

										$('#mcanreq').hide();
										$('#mcanreq2').hide();
										$('#mview').show();
										$('#mviewpi').show();
										$('#mreqrev').hide();
										$('#count').css('margin-right', '53%');
									}
								} else {
									$('#mreqrev').show();
									if (row.tqtydtg > 0) {

										$('#mcanreq').hide();
										$('#mcanreq2').hide();
										$('#count').css('margin-right', '30%');
									} else {
										$('#mcanreq').hide();
										$('#mcanreq2').show();
										$('#count').css('margin-right', '21%');
									}
									$('#mview').show();
									$('#mviewpi').show();
								}
							} else {
								if (cc2.length > 1) {
									$('#mcanreq').hide();
									$('#mcanreq2').hide();
									$('#mreqrev').hide();
									$('#mview').hide();
									$('#mviewpi').hide();
									$('#count').css('margin-right', '58%');
								} else {
									$('#mcanreq').show();
									$('#mcanreq2').hide();
									$('#mreqrev').hide();
									$('#mview').hide();
									$('#mviewpi').hide();
									$('#count').css('margin-right', '62.5%');
								}
							}
						}
					} else {
						$('#count').show();
						$('#mcopy').show();
						$('#mreq').hide();
						$('#mdel').hide();
						$('#medit').show();
						$('#mprint').show();
						$('#count2').hide();
						$('#mreplace1').show();
						$('#mreplace2').hide();
						$('#mcancopy').hide();
						count_row();
						if (row.pono) {
							if (row.fup == sfu) {
								if (row.pur != "") {
									$('#mcanreq').hide();
									// $('#mcanreq2').hide();
									$('#mcanreq2').show();
									$('#mreqrev').show();
									$('#mview').show();
									$('#mviewpi').show();
									$('#count').css('margin-right', '6%');
								} else {

									$('#mcanreq').hide();
									$('#mcanreq2').hide();
									$('#mreqrev').hide();
									$('#mview').show();
									$('#mviewpi').show();
									$('#count').css('margin-right', '38%');
								}
							} else {
								if (row.tqtydtg > 0) {
									$('#mcanreq').hide();
									$('#mcanreq2').hide();
									$('#count').css('margin-right', '16%');
								} else {
									$('#mcanreq').hide();
									$('#mcanreq2').show();
									$('#count').css('margin-right', '6%');
								}
								$('#mreqrev').show();
								$('#mview').show();
								$('#mviewpi').show();
							}
						} else {
							$('#mcanreq').show();
							$('#mcanreq2').hide();
							$('#mreqrev').hide();
							$('#mview').hide();
							$('#mviewpi').hide();
							$('#count').css('margin-right', '32%');
						}
					}
				} else if (row.status2 < 4) {
					if (tchek > 1) {
						if (cc.length > 1) {
							$('#count').show();
							$('#medit').hide();
							$('#mcopy').show();
							$('#mreq').hide();
							$('#mdel').hide();
							$('#mview').hide();
							$('#mviewpi').hide();
							$('#mcanreq').hide();
							$('#mcanreq2').hide();
							$('#mreqrev').hide();
							$('#mprint').show();
							$('#count2').hide();
							$('#mreplace1').hide();
							$('#mreplace2').hide();
							$('#mcancopy').hide();
							count_row();
							$('#count').css('margin-right', '58%');
						} else {
							$('#count').show();
							$('#medit').hide();
							$('#mcopy').show();
							$('#mdel').show();
							$('#mview').hide();
							$('#mviewpi').hide();
							$('#mcanreq').hide();
							$('#mcanreq2').hide();
							$('#mreqrev').hide();
							$('#mprint').show();
							$('#count2').hide();
							$('#mreplace1').hide();
							$('#mreplace2').hide();
							$('#mcancopy').hide();
							count_row();
							$('#mreq').show();
							$('#count').css('margin-right', '42%');
						}
					} else {
						$('#count').show();
						$('#mcopy').show();
						$('#mreq').show();
						$('#mcanreq').hide();
						$('#mcanreq2').hide();
						$('#mreqrev').hide();
						$('#mview').hide();
						$('#mviewpi').hide();
						$('#mdel').show();
						$('#medit').show();
						$('#mprint').show();
						$('#count2').hide();
						$('#mreplace1').show();
						$('#mreplace2').hide();
						$('#mcancopy').hide();
						count_row();
						$('#count').css('margin-right', '27%');
					}
				} else if (row.status2 > 4) {
					if (tchek > 1) {
						if (cc.length > 1) {
							$('#count').show();
							$('#medit').hide();
							$('#mcopy').show();
							$('#mreq').hide();
							$('#mdel').hide();
							$('#mview').hide();
							$('#mviewpi').hide();
							$('#mcanreq').hide();

							$('#mcanreq2').hide();
							$('#mreqrev').hide();
							$('#mprint').show();
							$('#count2').hide();
							$('#mreplace1').hide();
							$('#mreplace2').hide();
							$('#mcancopy').hide();
							count_row();
							$('#count').css('margin-right', '58%');
						} else {
							$('#count').show();
							$('#mcopy').show();
							$('#mreq').hide();
							$('#mcanreq').hide();

							$('#mcanreq2').hide();
							$('#mview').show();
							$('#mviewpi').show();
							$('#mdel').hide();
							$('#medit').hide();
							$('#mprint').show();
							$('#count2').hide();
							$('#mreplace1').hide();
							$('#mreplace2').hide();
							$('#mcancopy').hide();
							count_row();
							if (row.fup == sfu) {
								if (row.pur != "") {
									$('#mreqrev').show();
									$('#count').css('margin-right', '31%');
								} else {
									$('#mreqrev').hide();
									$('#count').css('margin-right', '48%');
								}
							} else {
								$('#mreqrev').show();
								$('#count').css('margin-right', '31%');
							}
						}
					} else {
						$('#count').show();
						$('#mcopy').show();
						$('#mreq').hide();
						$('#mcanreq').hide();
						$('#mview').show();
						$('#mviewpi').show();
						$('#mdel').hide();
						$('#medit').show();
						$('#mprint').show();
						$('#count2').hide();
						$('#mreplace1').show();
						$('#mreplace2').hide();
						$('#mcancopy').hide();
						count_row();
						if (row.fup == sfu) {
							if (row.pur != "") {
								$('#mreqrev').show();
								// $('#count').css('margin-right','16%');
								console.log(row.tqtydtg);

								if (row.tqtydtg > 0) {

									$('#mcanreq2').hide();
									$('#count').css('margin-right', '16%');
								} else {

									$('#mcanreq2').show();
									$('#count').css('margin-right', '6%');
								}
							} else {
								$('#mreqrev').hide();
								// $('#count').css('margin-right','23%');
								if (row.tqtydtg > 0) {

									$('#mcanreq2').hide();
									$('#count').css('margin-right', '23%');
								} else {
									$('#mcanreq2').show();
									$('#count').css('margin-right', '6%');
								}
							}
						} else {
							$('#mreqrev').show();
							// $('#count').css('margin-right','16%');
							if (row.tqtydtg > 0) {
								$('#mcanreq2').hide();
								$('#count').css('margin-right', '16%');
							} else {
								$('#mcanreq2').show();
								$('#count').css('margin-right', '6%');
							}
						}
					}
				}
				$('#myHeader').show();
			} else {
				$('#myHeader').hide();
				$('#dg2').datagrid('clearSelections');
			}
		}
	}

	function menu2() {
		var cp = document.getElementById('copy').value;
		if (cp == 1) {
			$('#myHeader').show();
			menu();
		} else {
			$('#myHeader').hide();
		}
	}

	function replace1() {
		var row = $('#dg2').datagrid('getSelected');
		if (row) {
			$.ajax({
				type: "POST",
				url: "action/simpan.php?x=replace1",
				data: "rkbpk=" + row.rkbpk,
				success: function(data) {
					//document.getElementById('tpur1').innerHTML =data;
					var copy = data;
					window.location.href = "?hal=mat&ord=<?php echo $ord; ?>";
				},
			});
			//$('#myHeader').show();
			//   $('#count2').show();
			//   $('#mreplace2').show();
			//   $('#mcancopy').show();
			//   $('#count').hide();
			//   $('#mreqrev').hide();
			//   $('#mcanreq').hide();
			//   $('#medit').hide();
			//   $('#mreq').hide();
			//   $('#mprint').hide();
			//   $('#mreplace1').hide();
			//   $('#mcopy').hide();
			//   $('#mdel').hide();
			//   $('#mview').hide();
			//   $('#mviewpi').hide();
			//   $('#count2').css('margin-right','925px');
			//   $('#dg2').datagrid('clearSelections');
			//   $('#dg2').datagrid('reload');
			/*$.ajax({
			type:"POST",
			url:"view/get_copy.php",
			data:"ord=<?php //echo $ord 
						?>",
						success: function(data) {
							document.getElementById('copy').value = data;
							var copy = document.getElementById('copy').value;
							if (copy == 1) {
								menu();
							}
						},
					});
					$('#myHeader').show();* /
					/*if(row.copy==3){
					var dg2 = $('#dg2');
					var td = dg2.datagrid('getPanel').find('div.datagrid-body td');
					td.css('background-color','#D6D6D6');
					}*/
			// window.location.href="?hal=mat&ord=<?php //echo $ord; 
													?>";
		} else {
			$('#myHeader').hide();
		}
	}

	function replace2() {
		var cc = [];
		var rows1 = $('#dg2').datagrid('getSelections');
		for (var n = 0; n < rows1.length; n++) {
			var pono = rows1[n]['pono'];
			if ($.inArray(pono, cc) == -1) { // not found
				cc.push(pono);
			}

			var sts = rows1[n]['stspk'];
			if ($.inArray(sts, cc) == -1) { // not found
				cc.push(sts);
			}
		}
		var row = $('#dg2').datagrid('getSelected');
		//var tchek = $('#dg2').datagrid('getChecked').length;
		if (row) {
			if (pono && sts != 4) {
				//$.messager.alert('Warning','Some items already have PO numbers or ineligible to be edited. Please review selected items and try again.','warning');
				$('#dialog-formr').dialog('open').dialog('setTitle', '');
				//$('#formr').form('load',row);
			} else {
				var ids = [];
				var rows = $('#dg2').datagrid('getChecked');
				if (rows) {
					//alert(i);
					//document.getElementById("rkb2").value = ids;
					for (var i = 0; i < rows.length; i++) {
						ids.push(rows[i].rkbpk);
					}
					$.each(ids, function(index, value) {
						$.post('action/simpan.php?x=replace2', {
							id: value
						}, function(result) {
							if (result.success) {
								/*$.messager.show({
								title:'',
								msg:result.msg, 
								timeout:3000,
								showType:'slide',
								icon:'info',
								width:430,
								height:55,
								style:{
								left:0,
								right:'',
								bottom:''
								}
								});*/
								$('#dialog-formp').dialog('open').dialog('setTitle', '');
								//$('#formp').form('load',row);
								//ord = $('#ord').val();
								/*alert(ord);*/
								//document.getElementById("ordpk2").value = +ord;
							} else {
								$.messager.show({
									title: '',
									msg: result.msg,
									timeout: 3000,
									showType: 'slide',
									icon: 'info',
									width: 430,
									height: 55,
									style: {
										left: 0,
										right: '',
										top: '',
										bottom: -document.body.scrollTop - document.documentElement.scrollTop
									}
								});
								/*$('#dialog-formc').dialog('close');*/
							}
						}, 'json')
					});
				} else {
					$.messager.alert('Warning', 'No material data selected', 'warning');
				}
			}
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	function savereplace() {
		var string = $("#formp").serialize();
		$('#formp').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=replace3",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 252,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-formp').dialog('close');
				$('#formp').form('reset');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
				$('#myHeader').hide();
				document.getElementById('copy').value = 0;
				//window.location.href="?hal=mat&ord=<?php echo $ord; ?>";
			}
		});
	}

	function cancopy() {
		$.ajax({
			type: "POST",
			url: "action/simpan.php?x=canreplace",
			data: "ord=<?php echo $ord; ?>",
			success: function(data) {
				//document.getElementById('tpur1').innerHTML =data;
			},
		});
		$('#myHeader').hide();
		$('#dg2').datagrid('clearSelections');
		$('#dg2').datagrid('reload');
		window.location.href = "?hal=mat&ord=<?php echo $ord; ?>";
	}
<?php
// Letakkan di bagian paling atas file sebelum HTML dimulai
$sql = mysqli_query($koneksi, "SELECT SUM(tot) AS tot FROM bdown WHERE ordpk='$ord' AND jenis LIKE '%DETAIL%' GROUP BY ordpk");
$dtsql = mysqli_fetch_array($sql);
// $totqty = number_format($dtsql['tot'] ?? 0, 0);
$pure_qty = $dtsql['tot'] ?? 0;
$display_qty = number_format($pure_qty, 0); 
?>
	/*open dialog*/
	function create2() {
		$('#dialog-forma').dialog('open').dialog('setTitle', '');
		var pureQty = "<?php echo $pure_qty; ?>";
    var displayQty = "<?php echo $display_qty; ?>";
		var nativeData = {
				ordno: "<?php echo TRIM($dt2['ordno']); ?>",
				byrnm: "<?php echo TRIM($dt2['byrnm']); ?>",
		};
		console.log('Data', nativeData);

		$('#h-ordno_create').text(nativeData.ordno);
		$('#h-byrnm_create').text(nativeData.byrnm);
		$('#h-totqty_display_create').text(displayQty);
			// UPDATE INPUT (Perhitungan) - Gunakan .val() bukan .text()
		$('#val_totqty_raw_create').val(pureQty);

		$('.label_unit').text('');
	}

	function create2b() {
		$('#dialog-forma').dialog('open').dialog('setTitle', '');
		var pureQty = "<?php echo $pure_qty; ?>";
    var displayQty = "<?php echo $display_qty; ?>";
		var nativeData = {
				ordno: "<?php echo TRIM($dt2['ordno']); ?>",
				byrnm: "<?php echo TRIM($dt2['byrnm']); ?>",
		};
		console.log('Data', nativeData);

		$('#h-ordno_create').text(nativeData.ordno);
		$('#h-byrnm_create').text(nativeData.byrnm);
		$('#h-totqty_display_create').text(displayQty);
		$('#val_totqty_raw_create').val(pureQty);
	}

	function openModalCreateDetail() {
		if (typeof myFunction2b === "function") {
				myFunction2b(); 
		} else {
				console.error("Fungsi myFunction2b tidak ditemukan!");
		}
		
		$('#modal_detail_create_summary').dialog('open').dialog('center');
	}
	function openModalEditDetail() {
		if (typeof myFunction2a === "function") {
				myFunction2a(); 
		} else {
				console.error("Fungsi myFunction2a tidak ditemukan!");
		}
		
		$('#modal_detail_edit_summary').dialog('open').dialog('center');
	}
	/*edit*/
	function edit2() {
		var row = $('#dg2').datagrid('getSelected');
		var sfu = $('#sfu').val();
		var pureQty = "<?php echo $pure_qty; ?>";
    var displayQty = "<?php echo $display_qty; ?>";
		var nativeData = {
				ordno: "<?php echo TRIM($dt2['ordno']); ?>",
				byrnm: "<?php echo TRIM($dt2['byrnm']); ?>",
		};
		if (row) {
			// console.log('TOT', nativeData);
      $('#h-ordno').text(nativeData.ordno);
      $('#h-byrnm').text(nativeData.byrnm);
			$('#h-totqty_display').text(displayQty);
        // UPDATE INPUT (Perhitungan) - Gunakan .val() bukan .text()
        $('#val_totqty_raw').val(pureQty);

			if (row.status2 == 3) {
				$('#viewmemo').show();
				$('#close').show();
				$('#viewmemo2').hide();
				$('#dialog-formb').dialog('open').dialog('setTitle', '');
				$('#formb').form('load', row);
				if(row.itemadd){

						var itemaddValues = row.itemadd
								.split(',')
								.map(function(v){
										return $.trim(v);
								});

						console.log(itemaddValues);

						// ambil instance combobox
						var cb = $('#itemadd1');

						// reload data remote
						cb.combobox('reload');

						// tunggu selesai load
						cb.combobox({

								onLoadSuccess:function(){

										// SET VALUE MULTIPLE
										cb.combobox('setValues', itemaddValues);

										console.log(
												'HASIL',
												cb.combobox('getValues')
										);

										// CHECKLIST CHECKBOX
										setTimeout(function(){

												var panel = cb.combobox('panel');

												panel.find('.combobox-item').each(function(){

														var text = $(this).text().trim();

														var checked =
																itemaddValues.includes(text);

														$(this)
																.find('.combobox-checkbox')
																.prop('checked', checked);

												});

										},100);

								}

						});

				}
				if (row.sizegar === "" || row.sizegar === null || row.sizegar === "1949") {
            $('#notApplicable1').prop('checked', true);
            handleSizeVisuals(true);
        } else {
            $('#notApplicable1').prop('checked', false);
            handleSizeVisuals(false);
        }
				if (row.suppk == "1949") {
            $('#external2').prop('checked', true);
            // Paksa jalankan logika visual (hide/show combobox)
            handleExternalVisuals(true, row.suppk);
        } else {
            $('#external2').prop('checked', false);
            handleExternalVisuals(false, row.suppk);
        }
				myFunction2a();
				if (row.tspec == 2) {
					$('#hidden').show();
					$('#ts_multi_check1').prop('checked', true); 
    			$('#hidden1a').show();
				} else {
					$('#ts_multi_check1').prop('checked', false); 
    			$('#hidden1a').hide();
					$('#hidden').hide();
				}
			} else {
				$('#viewmemo').hide();
				$('#close').hide();
				$('#viewmemo2').show();
				if (row.suppk == "1949") {
            $('#external2').prop('checked', true);
            // Paksa jalankan logika visual (hide/show combobox)
            handleExternalVisuals(true, row.suppk);
        } else {
            $('#external2').prop('checked', false);
            handleExternalVisuals(false, row.suppk);
        }
				myFunction2a();
				if (row.popk > 0) {
					if (row.fup == sfu) {
						if (row.pur == "Rita") {
							if (row.stspk == 4) {
								$('#dialog-formb').dialog('open').dialog('setTitle', '');
								$('#formb').form('load', row);
								if(row.itemadd){

										var itemaddValues = row.itemadd
												.split(',')
												.map(function(v){
														return $.trim(v);
												});

										console.log(itemaddValues);

										// ambil instance combobox
										var cb = $('#itemadd1');

										// reload data remote
										cb.combobox('reload');

										// tunggu selesai load
										cb.combobox({

												onLoadSuccess:function(){

														// SET VALUE MULTIPLE
														cb.combobox('setValues', itemaddValues);

														console.log(
																'HASIL',
																cb.combobox('getValues')
														);

														// CHECKLIST CHECKBOX
														setTimeout(function(){

																var panel = cb.combobox('panel');

																panel.find('.combobox-item').each(function(){

																		var text = $(this).text().trim();

																		var checked =
																				itemaddValues.includes(text);

																		$(this)
																				.find('.combobox-checkbox')
																				.prop('checked', checked);

																});

														},100);

												}

										});

								}
								if (row.sizegar === "" || row.sizegar === null || row.sizegar === "1949") {
										$('#notApplicable1').prop('checked', true);
										handleSizeVisuals(true);
								} else {
										$('#notApplicable1').prop('checked', false);
										handleSizeVisuals(false);
								}
								if (row.suppk == "1949") {
										$('#external2').prop('checked', true);
										// Paksa jalankan logika visual (hide/show combobox)
										handleExternalVisuals(true, row.suppk);
								} else {
										$('#external2').prop('checked', false);
										handleExternalVisuals(false, row.suppk);
								}
								myFunction2a();
								if (row.tspec == 2) {
									$('#hidden').show();
									$('#ts_multi_check1').prop('checked', true); 
    							$('#hidden1a').show();
								} else {
									$('#ts_multi_check1').prop('checked', false); 
    							$('#hidden1a').hide();
									$('#hidden').hide();
								}
							} else {
								$.messager.alert('Warning', ' Do revision PO ' + row.pono + '', 'warning');
							}
						} else if (row.pur == "Theresia") {
							if (row.stspk == 4) {
								$('#dialog-formb').dialog('open').dialog('setTitle', '');
								$('#formb').form('load', row);
								if(row.itemadd){

										var itemaddValues = row.itemadd
												.split(',')
												.map(function(v){
														return $.trim(v);
												});

										console.log(itemaddValues);

										// ambil instance combobox
										var cb = $('#itemadd1');

										// reload data remote
										cb.combobox('reload');

										// tunggu selesai load
										cb.combobox({

												onLoadSuccess:function(){

														// SET VALUE MULTIPLE
														cb.combobox('setValues', itemaddValues);

														console.log(
																'HASIL',
																cb.combobox('getValues')
														);

														// CHECKLIST CHECKBOX
														setTimeout(function(){

																var panel = cb.combobox('panel');

																panel.find('.combobox-item').each(function(){

																		var text = $(this).text().trim();

																		var checked =
																				itemaddValues.includes(text);

																		$(this)
																				.find('.combobox-checkbox')
																				.prop('checked', checked);

																});

														},100);

												}

										});

								}
								if (row.sizegar === "" || row.sizegar === null || row.sizegar === "1949") {
										$('#notApplicable1').prop('checked', true);
										handleSizeVisuals(true);
								} else {
										$('#notApplicable1').prop('checked', false);
										handleSizeVisuals(false);
								}
								if (row.suppk == "1949") {
            			$('#external2').prop('checked', true);
										// Paksa jalankan logika visual (hide/show combobox)
										handleExternalVisuals(true, row.suppk);
								} else {
										$('#external2').prop('checked', false);
										handleExternalVisuals(false, row.suppk);
								}
								myFunction2a();
								if (row.tspec == 2) {
									$('#hidden').show();
									$('#ts_multi_check1').prop('checked', true); 
    							$('#hidden1a').show();
								} else {
									$('#hidden').hide();
									$('#ts_multi_check1').prop('checked', false); 
    							$('#hidden1a').hide();
								}
							} else {
								$.messager.alert('Warning', ' Do revision PO ' + row.pono + '', 'warning');
							}
						} else {
							$.messager.confirm('Confirm', 'Are you sure you want to edit the material data, there is already a PO ' + row.pono + ' ?',
								function(r) {
									if (r) {
										$('#dialog-formb').dialog('open').dialog('setTitle', '');
										$('#formb').form('load', row);
										if(row.itemadd){

												var itemaddValues = row.itemadd
														.split(',')
														.map(function(v){
																return $.trim(v);
														});

												console.log(itemaddValues);

												// ambil instance combobox
												var cb = $('#itemadd1');

												// reload data remote
												cb.combobox('reload');

												// tunggu selesai load
												cb.combobox({

														onLoadSuccess:function(){

																// SET VALUE MULTIPLE
																cb.combobox('setValues', itemaddValues);

																console.log(
																		'HASIL',
																		cb.combobox('getValues')
																);

																// CHECKLIST CHECKBOX
																setTimeout(function(){

																		var panel = cb.combobox('panel');

																		panel.find('.combobox-item').each(function(){

																				var text = $(this).text().trim();

																				var checked =
																						itemaddValues.includes(text);

																				$(this)
																						.find('.combobox-checkbox')
																						.prop('checked', checked);

																		});

																},100);

														}

												});

										}
										if (row.sizegar === "" || row.sizegar === null || row.sizegar === "1949") {
												$('#notApplicable1').prop('checked', true);
												handleSizeVisuals(true);
										} else {
												$('#notApplicable1').prop('checked', false);
												handleSizeVisuals(false);
										}
										if (row.suppk == "1949") {
												$('#external2').prop('checked', true);
												// Paksa jalankan logika visual (hide/show combobox)
												handleExternalVisuals(true, row.suppk);
										} else {
												$('#external2').prop('checked', false);
												handleExternalVisuals(false, row.suppk);
										}
										myFunction2a();
										if (row.tspec == 2) {
											$('#hidden').show();
											$('#ts_multi_check1').prop('checked', true); 
    									$('#hidden1a').show();
										} else {
											$('#hidden').hide();
											$('#ts_multi_check1').prop('checked', false); 
    									$('#hidden1a').hide();
										}
									}
								});
						}
					} else if (row.stspk == 4) {
						$('#dialog-formb').dialog('open').dialog('setTitle', '');
						$('#formb').form('load', row);
						if(row.itemadd){

								var itemaddValues = row.itemadd
										.split(',')
										.map(function(v){
												return $.trim(v);
										});

								console.log(itemaddValues);

								// ambil instance combobox
								var cb = $('#itemadd1');

								// reload data remote
								cb.combobox('reload');

								// tunggu selesai load
								cb.combobox({

										onLoadSuccess:function(){

												// SET VALUE MULTIPLE
												cb.combobox('setValues', itemaddValues);

												console.log(
														'HASIL',
														cb.combobox('getValues')
												);

												// CHECKLIST CHECKBOX
												setTimeout(function(){

														var panel = cb.combobox('panel');

														panel.find('.combobox-item').each(function(){

																var text = $(this).text().trim();

																var checked =
																		itemaddValues.includes(text);

																$(this)
																		.find('.combobox-checkbox')
																		.prop('checked', checked);

														});

												},100);

										}

								});

						}
						if (row.sizegar === "" || row.sizegar === null || row.sizegar === "1949") {
								$('#notApplicable1').prop('checked', true);
								handleSizeVisuals(true);
						} else {
								$('#notApplicable1').prop('checked', false);
								handleSizeVisuals(false);
						}
						if (row.suppk == "1949") {
								$('#external2').prop('checked', true);
								// Paksa jalankan logika visual (hide/show combobox)
								handleExternalVisuals(true, row.suppk);
						} else {
								$('#external2').prop('checked', false);
								handleExternalVisuals(false, row.suppk);
						}
						myFunction2a();
						if (row.tspec == 2) {
							$('#hidden').show();
							$('#ts_multi_check1').prop('checked', true); 
							$('#hidden1a').show();
						} else {
							$('#hidden').hide();
							$('#ts_multi_check1').prop('checked', false); 
							$('#hidden1a').hide();
						}
					} else if (row.postatpk == 2) {
						if (row.stspk == 4) {
							$('#dialog-formb').dialog('open').dialog('setTitle', '');
							$('#formb').form('load', row);
							if(row.itemadd){

									var itemaddValues = row.itemadd
											.split(',')
											.map(function(v){
													return $.trim(v);
											});

									console.log(itemaddValues);

									// ambil instance combobox
									var cb = $('#itemadd1');

									// reload data remote
									cb.combobox('reload');

									// tunggu selesai load
									cb.combobox({

											onLoadSuccess:function(){

													// SET VALUE MULTIPLE
													cb.combobox('setValues', itemaddValues);

													console.log(
															'HASIL',
															cb.combobox('getValues')
													);

													// CHECKLIST CHECKBOX
													setTimeout(function(){

															var panel = cb.combobox('panel');

															panel.find('.combobox-item').each(function(){

																	var text = $(this).text().trim();

																	var checked =
																			itemaddValues.includes(text);

																	$(this)
																			.find('.combobox-checkbox')
																			.prop('checked', checked);

															});

													},100);

											}

									});

							}
							if (row.sizegar === "" || row.sizegar === null || row.sizegar === "1949") {
									$('#notApplicable1').prop('checked', true);
									handleSizeVisuals(true);
							} else {
									$('#notApplicable1').prop('checked', false);
									handleSizeVisuals(false);
							}
							if (row.suppk == "1949") {
									$('#external2').prop('checked', true);
									// Paksa jalankan logika visual (hide/show combobox)
									handleExternalVisuals(true, row.suppk);
							} else {
									$('#external2').prop('checked', false);
									handleExternalVisuals(false, row.suppk);
							}
							myFunction2a();
							if (row.tspec == 2) {
								$('#hidden').show();
								$('#ts_multi_check1').prop('checked', true); 
								$('#hidden1a').show();
							} else {
								$('#hidden').hide();
								$('#ts_multi_check1').prop('checked', false); 
								$('#hidden1a').hide();
							}
						} else {
							$.messager.alert('Warning', ' Do revision PO ' + row.pono + '', 'warning');
						}
					} else {
						$.messager.alert('Warning', ' Do revision PO ' + row.pono + '', 'warning');
					}
				} else {
					$('#dialog-formb').dialog('open').dialog('setTitle', '');
					$('#formb').form('load', row);
					if(row.itemadd){

							var itemaddValues = row.itemadd
									.split(',')
									.map(function(v){
											return $.trim(v);
									});

							console.log(itemaddValues);

							// ambil instance combobox
							var cb = $('#itemadd1');

							// reload data remote
							cb.combobox('reload');

							// tunggu selesai load
							cb.combobox({

									onLoadSuccess:function(){

											// SET VALUE MULTIPLE
											cb.combobox('setValues', itemaddValues);

											console.log(
													'HASIL',
													cb.combobox('getValues')
											);

											// CHECKLIST CHECKBOX
											setTimeout(function(){

													var panel = cb.combobox('panel');

													panel.find('.combobox-item').each(function(){

															var text = $(this).text().trim();

															var checked =
																	itemaddValues.includes(text);

															$(this)
																	.find('.combobox-checkbox')
																	.prop('checked', checked);

													});

											},100);

									}

							});

					}
					if (row.sizegar === "" || row.sizegar === null || row.sizegar === "1949") {
							$('#notApplicable1').prop('checked', true);
							handleSizeVisuals(true);
					} else {
							$('#notApplicable1').prop('checked', false);
							handleSizeVisuals(false);
					}
					if (row.suppk == "1949") {
							$('#external2').prop('checked', true);
							// Paksa jalankan logika visual (hide/show combobox)
							handleExternalVisuals(true, row.suppk);
					} else {
							$('#external2').prop('checked', false);
							handleExternalVisuals(false, row.suppk);
					}
					myFunction2a();
					if (row.tspec == 2) {
						$('#hidden').show();
						$('#ts_multi_check1').prop('checked', true); 
						$('#hidden1a').show();
					} else {
						$('#hidden').hide();
						$('#ts_multi_check1').prop('checked', false); 
						$('#hidden1a').hide();
					}

					//if(row.bdownpk>0){
					//$('#canbdown').show();
					//$('#lcan').show();
					//}
					//else {
					//$('#canbdown').hide();
					//$('#lcan').hide();
					//}
				}
			}
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	// Letakkan di luar fungsi edit2
	function handleSizeVisuals(isNotApplicable) {
			if (isNotApplicable) {
					// Jika Not Applicable: Sembunyikan input ukuran atau beri warna abu-abu
					$('#input-size-container').hide(); 
					$('#size-combobox').combobox('disable'); // Jika pakai EasyUI Combobox
			} else {
					// Jika Ada Ukuran: Munculkan kembali
					$('#input-size-container').show();
					$('#size-combobox').combobox('enable');
			}
	}

	/*request*/
	function request2() {
		var ids = [];
		var rows = $('#dg2').datagrid('getChecked');
		if (rows) {
			//alert(i);
			//document.getElementById("rkb2").value = ids;
			for (var i = 0; i < rows.length; i++) {
				ids.push(rows[i].rkbpk);
			}
			$.each(ids, function(index, value) {
				$.post('action/simpan.php?x=req2', {
					id: value
				}, function(result) {
					if (result.success) {
						/*$.messager.show({
						title:'',
						msg:result.msg, 
						timeout:3000,
						showType:'slide',
						icon:'info',
						width:430,
						height:55,
						style:{
						left:0,
						right:'',
						bottom:''
						}
						});*/
						$('#dg2').datagrid('reload');
						$('#dialog-formc').dialog('open').dialog('setTitle', '');
						//ord = $('#ord').val();
						/*alert(ord);*/
						//document.getElementById("ordpk2").value = +ord;
					} else {
						$.messager.show({
							title: '',
							msg: result.msg,
							timeout: 3000,
							showType: 'slide',
							icon: 'info',
							width: 430,
							height: 55,
							style: {
								left: 0,
								right: '',
								top: '',
								bottom: -document.body.scrollTop - document.documentElement.scrollTop
							}
						});
						/*$('#dialog-formc').dialog('close');*/
					}
				}, 'json')
			});
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	function requestpo() {
		var ids = [];
		var rows = $('#dg2').datagrid('getChecked');
		if (rows) {
			//alert(i);
			//document.getElementById("rkb2").value = ids;
			for (var i = 0; i < rows.length; i++) {
				ids.push(rows[i].rkbpk);
			}
			$.each(ids, function(index, value) {
				$.post('action/simpan.php?x=requestpo', {
					id: value
				}, function(result) {
					if (result.success) {
						/*$.messager.show({
						title:'',
						msg:result.msg, 
						timeout:3000,
						showType:'slide',
						icon:'info',
						width:390,
						height:55,
						style:{
						left:0,
						right:'',
						bottom:''
						}
						});*/
						$('#dg2').datagrid('reload');
						$('#dialog-formpo2').dialog('open').dialog('setTitle', '');
						//ord = $('#ord').val();
						/*alert(ord);*/
						//document.getElementById("ordpk2").value = +ord;
					} else {
						$.messager.show({
							title: '',
							msg: result.msg,
							timeout: 3000,
							showType: 'slide',
							icon: 'info',
							width: 450,
							height: 55,
							style: {
								left: 0,
								right: '',
								top: '',
								bottom: -document.body.scrollTop - document.documentElement.scrollTop
							}
						});
						/*$('#dialog-formc').dialog('close');*/
					}
				}, 'json')
			});
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	/*requestega*/
	function requestpo2b() {
		var ids = [];
		var rows = $('#dg2').datagrid('getChecked');
		if (rows) {
			//alert(i);
			//document.getElementById("rkb2").value = ids;
			for (var i = 0; i < rows.length; i++) {
				ids.push(rows[i].rkbpk);
			}
			$.each(ids, function(index, value) {
				$.post('action/simpan.php?x=requestpo2', {
					id: value
				}, function(result) {
					if (result.success) {
						/*$.messager.show({
						title:'',
						msg:result.msg, 
						timeout:3000,
						showType:'slide',
						icon:'info',
						width:390,
						height:55,
						style:{
						left:0,
						right:'',
						bottom:''
						}
						});*/
						$('#dg2').datagrid('reload');
						$('#dialog-formdel2').dialog('open').dialog('setTitle', '');
						//$('#dialog-formpo2b').dialog('open').dialog('setTitle','');
						//ord = $('#ord').val();
						/*alert(ord);*/
						//document.getElementById("ordpk2").value = +ord;
					} else {
						$.messager.show({
							title: '',
							msg: result.msg,
							timeout: 3000,
							showType: 'slide',
							icon: 'info',
							width: 450,
							height: 55,
							style: {
								left: 0,
								right: '',
								top: '',
								bottom: -document.body.scrollTop - document.documentElement.scrollTop
							}
						});
						/*$('#dialog-formc').dialog('close');*/
					}
				}, 'json')
			});
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	function requestpo2() {
		var ids = [];
		var rows = $('#dg2').datagrid('getChecked');
		if (rows) {
			//alert(i);
			//document.getElementById("rkb2").value = ids;
			for (var i = 0; i < rows.length; i++) {
				ids.push(rows[i].rkbpk);
			}
			$.each(ids, function(index, value) {
				$.post('action/simpan.php?x=requestpo2', {
					id: value
				}, function(result) {
					if (result.success) {
						/*$.messager.show({
						title:'',
						msg:result.msg, 
						timeout:3000,
						showType:'slide',
						icon:'info',
						width:390,
						height:55,
						style:{
						left:0,
						right:'',
						bottom:''
						}
						});*/
						$('#dg2').datagrid('reload');
						$('#dialog-formdel').dialog('open').dialog('setTitle', '');
						//$('#dialog-formpo2b').dialog('open').dialog('setTitle','');
						//ord = $('#ord').val();
						/*alert(ord);*/
						//document.getElementById("ordpk2").value = +ord;
					} else {
						$.messager.show({
							title: '',
							msg: result.msg,
							timeout: 3000,
							showType: 'slide',
							icon: 'info',
							width: 450,
							height: 55,
							style: {
								left: 0,
								right: '',
								top: '',
								bottom: -document.body.scrollTop - document.documentElement.scrollTop
							}
						});
						/*$('#dialog-formc').dialog('close');*/
					}
				}, 'json')
			});
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	function canreqpo2() {
		//$('#dialog-formpo2').dialog('close');
		var string = $("#formdel2").serialize();
		$('#formdel2').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=canreqpo",
			data: string,
			onSubmit: function() {
				//   return $(this).form('validate');
			},
			success: function(data) {
				/*$.messager.show({
						title:'',
						msg:data, 
						timeout:3000,
						showType:'slide',
						icon:'info',
						width:252,
						height:55,
			style:{
		 left:0,
		 right:'',
		 top:'',
		 bottom:-document.body.scrollTop-document.documentElement.scrollTop
		 }
						});*/
				$('#dialog-formdel2').dialog('close');
				$('#formdel2').form('reset');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
				$('#dg2').datagrid('clearSelections');
				$('#dg2').datagrid('clearChecked');
				over1();
				over2();
				sumpo();
				sumreq();
				cost1();
				cost2();
			}
		});
	}

	function canreqpo() {
		//$('#dialog-formpo2').dialog('close');
		var string = $("#formdel").serialize();
		$('#formdel').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=canreqpo",
			data: string,
			onSubmit: function() {
				//   return $(this).form('validate');
			},
			success: function(data) {
				/*$.messager.show({
						title:'',
						msg:data, 
						timeout:3000,
						showType:'slide',
						icon:'info',
						width:252,
						height:55,
			style:{
		 left:0,
		 right:'',
		 top:'',
		 bottom:-document.body.scrollTop-document.documentElement.scrollTop
		 }
						});*/
				$('#dialog-formdel').dialog('close');
				$('#formdel').form('reset');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
				$('#dg2').datagrid('clearSelections');
				$('#dg2').datagrid('clearChecked');
				over1();
				over2();
				sumpo();
				sumreq();
				cost1();
				cost2();
			}
		});
	}

	function savereqpo() {
		//$('#dialog-formpo2').dialog('close');
		var string = $("#formdel2").serialize();
		$('#formdel2').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=savereqpo1",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				/*$.messager.show({
						title:'',
						msg:data, 
						timeout:3000,
						showType:'slide',
						icon:'info',
						width:252,
						height:55,
			style:{
		 left:0,
		 right:'',
		 top:'',
		 bottom:-document.body.scrollTop-document.documentElement.scrollTop
		 }
						});*/
				$('#dialog-formpo2b').dialog('open').dialog('setTitle', '');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
				$('#dg2').datagrid('clearSelections');
				$('#dg2').datagrid('clearChecked');
			}
		});
	}

	/*save*/
	function save1() {
		var string = $("#forma").serialize();
		$('#forma').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=mat",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 252,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-forma').dialog('close');
				$('#modal_detail_create_summary').dialog('close');
				$('#forma').form('reset');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
				over1();
				over2();
				sumpo();
				sumreq();
				cost1();
				cost2();
			}
		});
	}

	function savee1() {
		var string = $("#forma").serialize();
		$('#forma').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=mat",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 252,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-forma').dialog('close'); 
				$('#modal_detail_create_summary').dialog('close');
				$('#forma').form('reset');
				$('#dg2').datagrid('reload');
				// window.location.href = "?hal=mat&ord=<?php echo $ord; ?>";
			}
		});
	}

	function save2() {
		var string = $("#formb").serialize();
		$('#formb').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=mat",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 252,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-formb').dialog('close');
				$('#modal_detail_edit_summary').dialog('close');
				$('#formb').form('reset');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
				over1();
				over2();
				sumpo();
				sumreq();
				cost1();
				cost2();
			}
		});
	}

	function save2b() {
		var string = $("#formb").serialize();
		$('#formb').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=mat2",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 252,
					height: 55,
					style: {
						right: '',
						left: 0,
						top: document.body.scrollTop + document.documentElement.scrollTop,
						bottom: ''
					}
				});
				$('#dialog-formb').dialog('close');
				$('#modal_detail_edit_summary').dialog('close');
				$('#dialog-formc').dialog('open').dialog('setTitle', '');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
			}
		});
	}

	function save2c() {
		var string = $("#formc").serialize();
		$('#formc').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=req2b",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 430,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-formc').dialog('close');
				$('#formc').form('reset');
				$('#dg2').datagrid('clearSelections');
				$('#dg2').datagrid('clearChecked');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
			}
		});
	}

	function reqrev() {
		var ids = [];
		var rows = $('#dg2').datagrid('getSelections');
		for (var i = 0; i < rows.length; i++) {
			ids.push(rows[i].rkbpk);
		}
		$.messager.confirm('Confirm', 'Are you sure you want to request revised this material?',
			function(r) {
				if (r) {
					// We loop through each project and then delete it
					$.each(ids, function(index, value) {
						$.post('action/simpan.php?x=reqrev2', {
							id: value
						}, function(result) {
							if (result.success) {
								$.messager.show({
									title: '',
									msg: result.msg,
									timeout: 3000,
									showType: 'slide',
									icon: 'info',
									width: 252,
									height: 55,
									style: {
										left: 0,
										right: '',
										top: '',
										bottom: -document.body.scrollTop - document.documentElement.scrollTop
									}
								});
								$('#dg2').datagrid('reload');
							} else {
								$.messager.show({
									title: '',
									msg: result.msg,
									timeout: 3000,
									showType: 'slide',
									icon: 'info',
									width: 252,
									height: 55,
									style: {
										left: 0,
										right: '',
										top: '',
										bottom: -document.body.scrollTop - document.documentElement.scrollTop
									}
								});
							}
						}, 'json')
					});
				} //reload the user data
			});
	}

	function reqrev2() {
		var row = $('#dg2').datagrid('getSelected');
		if (row) {
			if (row.pono) {
				$.messager.confirm('Confirm', 'Are you sure you want to request revised this material?',
					function(r) {
						if (r) {
							$.ajax({
								type: "POST",
								url: "action/simpan.php?x=reqrev2",
								data: 'id=' + row.rkbpk,
								success: function(data) {
									$.messager.show({
										title: '',
										msg: data,
										timeout: 3000,
										showType: 'slide',
										icon: 'info',
										width: 252,
										height: 55,
										style: {
											left: 0,
											right: '',
											top: '',
											bottom: -document.body.scrollTop - document.documentElement.scrollTop
										}
									});
									$('#dg2').datagrid('reload');
								}
							});
						}
					});
			} else {
				$.messager.alert('Warning', 'Material cannot be request revised', 'warning');
			}
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	function canreq2() {
		var row = $('#dg2').datagrid('getSelected');
		if (row) {
			/*if(row.pono){
				$.messager.alert('Warning','Material cannot be canceled request','warning');
			} else {*/
			$.messager.confirm('Confirm', 'Are you sure you want to cancel request this material?',
				function(r) {
					if (r) {
						$.ajax({
							type: "POST",
							url: "action/simpan.php?x=canreq",
							data: 'id=' + row.rkbpk,
							success: function(data) {
								$.messager.show({
									title: '',
									msg: data,
									timeout: 3000,
									showType: 'slide',
									icon: 'info',
									width: 252,
									height: 55,
									style: {
										left: 0,
										right: '',
										top: '',
										bottom: -document.body.scrollTop - document.documentElement.scrollTop
									}
								});
								$('#dg2').datagrid('reload');
							}
						});
					}
				});
			/*}*/
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	function canreq() {
		var ids = [];
		var rows = $('#dg2').datagrid('getSelections');
		for (var i = 0; i < rows.length; i++) {
			ids.push(rows[i].rkbpk);
		}
		$.messager.confirm('Confirm', 'Are you sure you want to cancel request this material?',
			function(r) {
				if (r) {
					// We loop through each project and then delete it
					$.each(ids, function(index, value) {
						$.post('action/simpan.php?x=canreq2', {
							id: value
						}, function(result) {
							if (result.success) {
								$.messager.show({
									title: '',
									msg: result.msg,
									timeout: 3000,
									showType: 'slide',
									icon: 'info',
									width: 400,
									height: 55,
									style: {
										left: 0,
										right: '',
										top: '',
										bottom: -document.body.scrollTop - document.documentElement.scrollTop
									}
								});
								$('#dg2').datagrid('clearSelections');
								$('#dg2').datagrid('clearChecked');
								$('#dg2').datagrid('reload');
							} else {
								$.messager.show({
									title: '',
									msg: result.msg,
									timeout: 3000,
									showType: 'slide',
									icon: 'info',
									width: 400,
									height: 55,
									style: {
										left: 0,
										right: '',
										top: '',
										bottom: -document.body.scrollTop - document.documentElement.scrollTop
									}
								});
							}
						}, 'json')
					});
				} //reload the user data
			});
	}

	function cancelreq() {
		var string = $("#formc").serialize();
		$('#formc').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=cancelreq",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 252,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-formc').dialog('close');
				$('#formc').form('reset');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
			}
		});
	}

	function viewpi() {
		var rows = $('#dg2').datagrid('getSelected');
		if (rows) {
			//  if(rows.status=="Purchased"){
			if (rows.piform !== null && rows.piform !== "") {
				url = "upload/" + rows.piform;
				//url = "upload/LN021110,LN021111,LN021112,LN021113,LN021114.pdf";
				window.open(url);
			} else {
				$.messager.alert('Warning', 'No PI files', 'warning');
			}
			// } else {
			//     $.messager.alert('Warning','PO status not purchased','warning');
			//  }
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	function viewpo() {
		var rows = $('#dg2').datagrid('getSelected');
		if (rows) {
			if (rows.pono) {
				url = url = "pdf/pdf_po?cek=1&po=" + rows.pono;
				window.open(url);
			} else {
				$.messager.alert('Warning', 'No PO number', 'warning');
			}
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	/*delete*/
	/*function select(){
	var ids = [];
	var rows = $('#dg2').datagrid('getChecked');
	for (var i=0; i<rows.length; i++) {
	ids.push(rows[i].rkbpk);
	}
	alert(ids);
	}*/

	function delmat2() {
		//var spv = document.getElementById("spv").value;
		//if(spv==1){
		//if (rows){  
		//$.messager.confirm('Confirm','Are you sure you want to delete this material?',
		//function(r){
		//if (r){
		var ids = [];
		var rows = $('#dg2').datagrid('getSelections');
		for (var i = 0; i < rows.length; i++) {
			ids.push(rows[i].rkbpk);
			//alert(ids);
		}
		$.messager.confirm('Confirm', 'Are you sure you want to delete this material?',
			function(r) {
				if (r) {
					//alert(ids);
					// We loop through each project and then delete it
					$.each(ids, function(index, value) {
						//alert(i);
						$.post('action/delete.php?x=mat', {
							id: value
						}, function(result) {
							if (result.success) {
								$.messager.show({
									title: '',
									msg: result.msg,
									timeout: 3000,
									showType: 'slide',
									icon: 'info',
									width: 252,
									height: 55,
									style: {
										left: 0,
										right: '',
										top: '',
										bottom: -document.body.scrollTop - document.documentElement.scrollTop
									}
								});
								$('#dg2').datagrid('reload');
								$('#dg2').datagrid('clearSelections');
								over1();
								over2();
								sumpo();
								sumreq();
								cost1();
								cost2();
							} else {
								$.messager.show({
									title: '',
									msg: result.msg,
									timeout: 3000,
									showType: 'slide',
									icon: 'info',
									width: 252,
									height: 55,
									style: {
										left: 0,
										right: '',
										top: '',
										bottom: -document.body.scrollTop - document.documentElement.scrollTop
									}
								});
							}
						}, 'json')
					});
				} //reload the user data
			});
		//} else {
		//$.messager.alert('Warning','You are not allowed to delete this material, please contact your supervisor','warning');
		//}
	}

	function delmat2b() {
		var row = $('#dg2').datagrid('getSelected');
		if (row) {
			$.messager.confirm('Confirm', 'Are you sure you want to delete this material?',
				function(r) {
					if (r) {
						$.ajax({
							type: "POST",
							url: "action/delete.php?x=mat",
							data: 'id=' + row.rkbpk,
							success: function(data) {
								$.messager.show({
									title: '',
									msg: data,
									timeout: 3000,
									showType: 'slide',
									icon: 'info',
									width: 252,
									height: 55,
									style: {
										left: 0,
										right: '',
										top: '',
										bottom: -document.body.scrollTop - document.documentElement.scrollTop
									}
								});
								$('#dg2').datagrid('reload');
							}
						});
					}
				});
		} else {
			$.messager.alert('Warning', 'No material  data selected', 'warning');
		}
	}

	/*copy*/
	function copy2() {
		var ids = [];
		var rows = $('#dg2').datagrid('getChecked');
		if (rows) {
			for (var i = 0; i < rows.length; i++) {
				ids.push(rows[i].rkbpk);
			}
			// We loop through each project and then delete it
			$.each(ids, function(index, value) {
				$.post('action/simpan.php?x=copy', {
					id: value
				}, function(result) {
					if (result.success) {
						$.messager.show({
							title: '',
							msg: result.msg,
							timeout: 3000,
							showType: 'slide',
							icon: 'info',
							width: 252,
							height: 55,
							style: {
								left: 0,
								right: '',
								top: '',
								bottom: -document.body.scrollTop - document.documentElement.scrollTop
							}
						});
						$('#dg2').datagrid('reload');
					} else {
						$.messager.show({
							title: '',
							msg: result.msg,
							timeout: 3000,
							showType: 'slide',
							icon: 'info',
							width: 252,
							height: 55,
							style: {
								left: 0,
								right: '',
								top: '',
								bottom: -document.body.scrollTop - document.documentElement.scrollTop
							}
						});
					}
				}, 'json')
			}); // reload the user data
		} else {
			$.messager.alert('Warning', 'No material  data selected', 'warning');
		}
	}

	function copyto() {
		var ids = [];
		var rows = $('#dg2').datagrid('getChecked');
		var row = $('#dg2').datagrid('getSelected');
		if (row) {
			$('#dialog-form2').dialog('open').dialog('setTitle', '');
			$('#form2').form('load', row);

			for (var i = 0; i < rows.length; i++) {
				ids.push(rows[i].rkbpk);
			}
			// We loop through each project and then delete it
			$.each(ids, function(index, value) {
				$.post('action/simpan.php?x=copyto&count=' + i, {
						id: value
					},
					function(result) {
						if (result.success) {
							/*$.messager.show({
							title:'',
							msg:result.msg, 
							timeout:3000,
							showType:'slide',
							icon:'info',
							width:252,
							height:55,
							style:{
							left:0,
		  right:'',
							bottom:''
							}
						});*/
							document.getElementById("tot").value = i;
							/*$('#dg2').datagrid('reload');*/
						} else {
							$.messager.show({
								title: '',
								msg: result.msg,
								timeout: 3000,
								showType: 'slide',
								icon: 'info',
								width: 252,
								height: 55,
								style: {
									left: 0,
									right: '',
									top: '',
									bottom: -document.body.scrollTop - document.documentElement.scrollTop
								}
							});
							$('#dg').datagrid('reload');
						}
					}, 'json')
			}); // reload the user data
		} else {
			$.messager.alert('Warning', 'No material  data selected', 'warning');
		}
	}

	function importdata() {
		$('#dialog-form2b').dialog('open').dialog('setTitle', '');
		$('#form2b').form('load', row);
	}

	function importdata2() {

		var row = $('#dg2b2').datagrid('getSelected');
		if (row) {
			$('#dialog-form2c').dialog('open').dialog('setTitle', '');
			$('#form2c').form('load', row);
			document.getElementById("cari12").value = row.ordpk;
			document.getElementById("artno").innerHTML = row.ordno + " / Style " + row.artno;
			document.getElementById("byr").innerHTML = row.byrnm + " , " + row.artno;
			document.getElementById("prodes").innerHTML = row.prodes;
			$('#dg2b3').datagrid('resize');
			$('#dg2b3').datagrid('load', {
				cari12: $('#cari12').val()
			});
		} //else {
		//$.messager.alert('Warning','No style data selected','warning');
		//}
	}

	function cancel2b() {
		$('#dialog-form2b').dialog('close');
	}

	function cancel2c() {
		$('#dg2b2').datagrid('clearSelections');
		$('#dialog-form2c').dialog('close');
		$('#form2c').form('reset');
		document.getElementById("cari12").value = "";
		$('#dg2b3').datagrid('resize');
		$('#dg2b3').datagrid('load', {
			cari12: $('#cari12').val()
		});
	}

	function cancel2() {
		var string = $("#form2").serialize();

		$('#form2').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=cancopy",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 252,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-form2').dialog('close');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('clearSelections');
				$('#dg2').datagrid('reload');
			}
		});
	}

	function select1a() {
		var rows = $('#dg2b').datagrid('getSelected');
		if (rows) {
			$('#export').css('color', '#359DD9');
		} else {
			$('#export').css('color', 'rgba(0, 0, 0, 0.38)');
		}
	}

	function select1b() {
		$('#export').css('color', 'rgba(0, 0, 0, 0.38)');
	}

	function select() {
		var ids = [];
		var rows = $('#dg2b').datagrid('getChecked');
		if (rows) {
			for (var i = 0; i < rows.length; i++) {
				ids.push(rows[i].ordpk);
			}
			// We loop through each project and then delete it
			$.each(ids, function(index, value) {
				$.post('action/simpan.php?x=export&ordpk=<?php echo $ord; ?>&count=' + i, {
						id: value
					},
					function(result) {
						if (result.success) {
							$.messager.show({
								title: '',
								msg: result.msg,
								timeout: 3000,
								showType: 'slide',
								icon: 'info',
								width: 300,
								height: 55,
								style: {
									left: 0,
									right: '',
									top: '',
									bottom: -document.body.scrollTop - document.documentElement.scrollTop
								}
							});
							$('#dialog-form2').dialog('close');
							$('#dg2').datagrid('reload');
							over1();
							over2();
							sumpo();
							sumreq();
							cost1();
							cost2();
						} else {
							$.messager.show({
								title: '',
								msg: result.msg,
								timeout: 3000,
								showType: 'slide',
								icon: 'info',
								width: 300,
								height: 55,
								style: {
									left: 0,
									right: '',
									top: '',
									bottom: -document.body.scrollTop - document.documentElement.scrollTop
								}
							});
							$('#dialog-form2').dialog('close');
							$('#dg').datagrid('reload');
						}
					}, 'json')
			}); // reload the user data
		} else {
			$.messager.alert('Warning', 'No material  data selected', 'warning');
		}
	}


	// function select(){
	// var row = $('#dg2b').datagrid('getSelected');
	// var string = $("#form2").serialize();
	// 	 $('#form2').form('submit',{
	//   type	: "POST",
	// 		url	: "action/simpan.php?x=copyto2&ordpk="+row.ordpk,
	// 		data	: string,
	//   onSubmit: function(){
	//   return $(this).form('validate');
	//   },
	// 		success	: function(data){
	// 			$.messager.show({
	// 					title:'',
	// 					msg:data, 
	// 					timeout:3000,
	// 					showType:'slide',
	// 					icon:'info',
	// 					width:252,
	// 					height:55,
	// 		style:{
	//      left:0,
	//      right:'',
	//      top:'',
	//      bottom:-document.body.scrollTop-document.documentElement.scrollTop
	//      }
	// 					});
	// 			$('#dialog-form2').dialog('close');
	// 			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
	//    $('#dg2').datagrid('clearSelections');
	// 			$('#dg2').datagrid('reload');
	// 		}
	// 	 });
	// }

	function select2() {
		var rows = $('#dg2b3').datagrid('getSelected');
		if (rows) {
			$('#import').css('color', '#359DD9');
		} else {
			$('#import').css('color', 'rgba(0, 0, 0, 0.38)');
		}
	}

	function select3() {
		$('#import').css('color', 'rgba(0, 0, 0, 0.38)');
	}

	function select2b() {
		var ids = [];
		var rows = $('#dg2b3').datagrid('getChecked');
		if (rows) {
			for (var i = 0; i < rows.length; i++) {
				ids.push(rows[i].rkbpk);
			}
			// We loop through each project and then delete it
			$.each(ids, function(index, value) {
				$.post('action/simpan.php?x=import&ordpk=<?php echo $ord; ?>&count=' + i, {
						id: value
					},
					function(result) {
						if (result.success) {
							$.messager.show({
								title: '',
								msg: result.msg,
								timeout: 3000,
								showType: 'slide',
								icon: 'info',
								width: 300,
								height: 55,
								style: {
									left: 0,
									right: '',
									top: '',
									bottom: -document.body.scrollTop - document.documentElement.scrollTop
								}
							});
							$('#dialog-form2c').dialog('close');
							$('#dialog-form2b').dialog('close');
							$('#dg2').datagrid('reload');
							over1();
							over2();
							sumpo();
							sumreq();
							cost1();
							cost2();
						} else {
							$.messager.show({
								title: '',
								msg: result.msg,
								timeout: 3000,
								showType: 'slide',
								icon: 'info',
								width: 300,
								height: 55,
								style: {
									left: 0,
									right: '',
									top: '',
									bottom: -document.body.scrollTop - document.documentElement.scrollTop
								}
							});
							$('#dialog-form2c').dialog('close');
							$('#dialog-form2b').dialog('close');
							$('#dg').datagrid('reload');
						}
					}, 'json')
			}); // reload the user data
		} else {
			$.messager.alert('Warning', 'No material  data selected', 'warning');
		}
	}

	/* LOOKUP color */
	function lookup_col() {
		$('#dialog-forme').dialog('open').dialog('setTitle', '');
		$('#forme').form('reset');
	}

	function get_lookup() {
		var row = $('#dg4e').datagrid('getSelected');
		if (row) {
			document.getElementById("colname").value = row.colname;
			document.getElementById("colcode").value = row.colcode;
			document.getElementById("colname1").value = row.colname;
			document.getElementById("colcode1").value = row.colcode;

			$('#colname').validatebox('validate');
      $('#colcode').validatebox('validate');
			$('#colname1').validatebox('validate');
      $('#colcode1').validatebox('validate');
			$('#dialog-forme').dialog('close');
			//alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);
		}
	}

	/* LOOKUP Material */
	function lookup_mb() {
		$('#dialog-formf').dialog('open').dialog('setTitle', '');
		$('#formf').form('clear');
	}

	function get_mb() {
		var row = $('#dg4f').datagrid('getSelected');
		if (row) {
			document.getElementById("spec2").value = row.spec;
			document.getElementById("spec2b").value = row.spec;
			document.getElementById("item1").value = row.item;
			document.getElementById("item").value = row.item;

			$('#spec2').validatebox('validate');
			$('#spec2b').validatebox('validate');
			$('#item1').validatebox('validate');
			$('#item').validatebox('validate');
			$('#dialog-formf').dialog('close');
			//alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);
		}
	}

	/* LOOKUP Breakdown S1 */
	function lookup_bdown() {
		// $('#dialog-formg').dialog('open').dialog('setTitle','Data Breakdown');
		$('#dialog-formg').dialog('open').dialog('setTitle', '');
		$('#formg').form('clear');
		$('#formg').form('reset');
	}

	function lookup_bdowns1() {
		$('#dialog-formh').dialog('open').dialog('setTitle', 'S1');
		$('#formh').form('clear');
		$('#dg4h').datagrid('clearSelections');
	}

	function get_bdowns1() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4h').datagrid('getSelected');
		var rowsb = $('#dg4h').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-formh').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4h').datagrid('clearSelections');
		}
		/*	var row = $('#dg4h').datagrid('getSelected');
		 if (row){
										var v1=$('#dg4h').datagrid('getRows')[0].size;
										document.getElementById("sizegar").value = v1;
										document.getElementById("bdownqty").value = row.size;
											document.getElementById("bdownpk").value = row.bdownpk;
											document.getElementById("kolom").value = row.kolom;
										$('#dialog-formh').dialog('close');
											$('#dialog-formg').dialog('close');
		
			}*/
	}

	function clk1() {
		var rowc = $('#dg4h').datagrid('getSelected');
		var rowsc = $('#dg4h').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4h').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S2 */
	function lookup_bdowns2() {
		$('#dialog-formi').dialog('open').dialog('setTitle', 'S2');
		$('#formi').form('clear');
		$('#dg4i').datagrid('clearSelections');
	}

	function get_bdowns2() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4i').datagrid('getSelected');
		var rowsb = $('#dg4i').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-formi').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4i').datagrid('clearSelections');
		}
	}

	function clk2() {
		var rowc = $('#dg4i').datagrid('getSelected');
		var rowsc = $('#dg4i').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4i').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S3 */
	function lookup_bdowns3() {
		$('#dialog-formj').dialog('open').dialog('setTitle', 'S3');
		$('#formj').form('clear');
		$('#dg4j').datagrid('clearSelections');
	}

	function get_bdowns3() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4j').datagrid('getSelected');
		var rowsb = $('#dg4j').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-formj').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4j').datagrid('clearSelections');
		}
	}

	function clk3() {
		var rowc = $('#dg4j').datagrid('getSelected');
		var rowsc = $('#dg4j').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4j').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S4 */
	function lookup_bdowns4() {
		$('#dialog-formk').dialog('open').dialog('setTitle', 'S4');
		$('#formk').form('clear');
		$('#dg4k').datagrid('clearSelections');
	}

	function get_bdowns4() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4k').datagrid('getSelected');
		var rowsb = $('#dg4k').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-formk').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4k').datagrid('clearSelections');
		}

		function clk4() {
			var rowc = $('#dg4k').datagrid('getSelected');
			var rowsc = $('#dg4k').datagrid('getSelections');
			if (rowc) {
				if (rowsc.length > 2) {
					$('#dg4k').datagrid('unselectAll');
				}
			}
		}
		// alert(ids[1]);
		/*var row = $('#dg4k').datagrid('getSelected');  						
		 if (row){
										var v1=$('#dg4k').datagrid('getRows')[0].size;
										document.getElementById("sizegar").value = v1;
										document.getElementById("bdownqty").value = row.size;
											document.getElementById("bdownpk").value = row.bdownpk;
											document.getElementById("kolom").value = row.kolom;
										$('#dialog-formk').dialog('close');
											$('#dialog-formg').dialog('close');
		
			}*/
	}
	/* LOOKUP Breakdown S5 */
	function lookup_bdowns5() {
		$('#dialog-forml').dialog('open').dialog('setTitle', 'S5');
		$('#forml').form('clear');
		$('#dg4l').datagrid('clearSelections');
	}

	function get_bdowns5() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4l').datagrid('getSelected');
		var rowsb = $('#dg4l').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-forml').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4l').datagrid('clearSelections');
		}
	}

	function clk5() {
		var rowc = $('#dg4l').datagrid('getSelected');
		var rowsc = $('#dg4l').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4l').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S6 */
	function lookup_bdowns6() {
		$('#dialog-formm').dialog('open').dialog('setTitle', 'S6');
		$('#formm').form('clear');
		$('#dg4m').datagrid('clearSelections');
	}

	function get_bdowns6() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4m').datagrid('getSelected');
		var rowsb = $('#dg4m').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-formm').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4m').datagrid('clearSelections');
		}
	}

	function clk6() {
		var rowc = $('#dg4m').datagrid('getSelected');
		var rowsc = $('#dg4m').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4m').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S7 */
	function lookup_bdowns7() {
		$('#dialog-formn').dialog('open').dialog('setTitle', 'S7');
		$('#formn').form('clear');
		$('#dg4n').datagrid('clearSelections');
	}

	function get_bdowns7() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4n').datagrid('getSelected');
		var rowsb = $('#dg4n').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-formn').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4n').datagrid('clearSelections');
		}
	}

	function clk7() {
		var rowc = $('#dg4n').datagrid('getSelected');
		var rowsc = $('#dg4n').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4n').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S8 */
	function lookup_bdowns8() {
		$('#dialog-formo').dialog('open').dialog('setTitle', 'S8');
		$('#formo').form('clear');
		$('#dg4o').datagrid('clearSelections');
	}

	function get_bdowns8() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4o').datagrid('getSelected');
		var rowsb = $('#dg4o').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-formo').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4o').datagrid('clearSelections');
		}
	}

	function clk8() {
		var rowc = $('#dg4o').datagrid('getSelected');
		var rowsc = $('#dg4o').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4o').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S9 */
	function lookup_bdowns9() {
		$('#dialog-formp').dialog('open').dialog('setTitle', 'S9');
		$('#formp').form('clear');
		$('#dg4p').datagrid('clearSelections');
	}

	function get_bdowns9() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4p').datagrid('getSelected');
		var rowsb = $('#dg4p').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-formp').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4p').datagrid('clearSelections');
		}
	}

	function clk9() {
		var rowc = $('#dg4p').datagrid('getSelected');
		var rowsc = $('#dg4p').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4p').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S10 */
	function lookup_bdowns10() {
		$('#dialog-formq').dialog('open').dialog('setTitle', 'S10');
		$('#formq').form('clear');
		$('#dg4q').datagrid('clearSelections');
	}

	function get_bdowns10() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4q').datagrid('getSelected');
		var rowsb = $('#dg4q').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-formq').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4q').datagrid('clearSelections');
		}
	}

	function clk10() {
		var rowc = $('#dg4q').datagrid('getSelected');
		var rowsc = $('#dg4q').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4q').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S11 */
	function lookup_bdowns11() {
		$('#dialog-formr').dialog('open').dialog('setTitle', 'S11');
		$('#formr').form('clear');
		$('#dg4r').datagrid('clearSelections');
	}

	function get_bdowns11() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4r').datagrid('getSelected');
		var rowsb = $('#dg4r').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-formr').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4r').datagrid('clearSelections');
		}
	}

	function clk11() {
		var rowc = $('#dg4r').datagrid('getSelected');
		var rowsc = $('#dg4r').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4r').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S12 */
	function lookup_bdowns12() {
		$('#dialog-forms').dialog('open').dialog('setTitle', 'S12');
		$('#forms').form('clear');
		$('#dg4s').datagrid('clearSelections');
	}

	function get_bdowns12() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4s').datagrid('getSelected');
		var rowsb = $('#dg4s').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-forms').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4s').datagrid('clearSelections');
		}
	}

	function clk12() {
		var rowc = $('#dg4s').datagrid('getSelected');
		var rowsc = $('#dg4s').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4s').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S13 */
	function lookup_bdowns13() {
		$('#dialog-formt').dialog('open').dialog('setTitle', 'S13');
		$('#formt').form('clear');
		$('#dg4t').datagrid('clearSelections');
	}

	function get_bdowns13() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4t').datagrid('getSelected');
		var rowsb = $('#dg4t').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-formg').dialog('close');
			$('#dg4t').datagrid('clearSelections');
		}
	}

	function clk13() {
		var rowc = $('#dg4t').datagrid('getSelected');
		var rowsc = $('#dg4t').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4t').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S14 */
	function lookup_bdowns14() {
		$('#dialog-formu').dialog('open').dialog('setTitle', 'S13');
		$('#formu').form('clear');
		$('#dg4u').datagrid('clearSelections');
	}

	function get_bdowns14() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4u').datagrid('getSelected');
		var rowsb = $('#dg4u').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-formu').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4u').datagrid('clearSelections');
		}
	}

	function clk14() {
		var rowc = $('#dg4u').datagrid('getSelected');
		var rowsc = $('#dg4u').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4u').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S15 */
	function lookup_bdowns15() {
		$('#dialog-formv').dialog('open').dialog('setTitle', 'S15');
		$('#formv').form('clear');
		$('#dg4v').datagrid('clearSelections');
	}

	function get_bdowns15() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg4v').datagrid('getSelected');
		var rowsb = $('#dg4v').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar").value = ids[0];
			document.getElementById("bdownqty").value = ids[1];
			document.getElementById("bdownpk").value = ids2[1];
			document.getElementById("kolom").value = row.kolom;

			document.getElementById("sizegar1").value = ids[0];
			document.getElementById("bdownqty1").value = ids[1];
			document.getElementById("bdownpk1").value = ids2[1];
			document.getElementById("kolom1").value = row.kolom;
			$('#dialog-formv').dialog('close');
			$('#dialog-formg').dialog('close');
			$('#dg4v').datagrid('clearSelections');
		}
	}

	function clk15() {
		var rowc = $('#dg4v').datagrid('getSelected');
		var rowsc = $('#dg4v').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg4v').datagrid('unselectAll');
			}
		}
	}

	function formatku2b(val, row) {
		return val;
	}


	function editrow() {
		var a = document.getElementById('dtc').value;
		if (a == 1) {
			var dg = $('#dg2bb');
			var td4 = dg.datagrid('getPanel').find('div.datagrid-body td[field="qtys"]').css('background-color', '#000000');;
			td4.css('border-right', '1.5px solid #b2b2b2');
			td4.css('border-top', '1.5px solid #b2b2b2');
			td4.css('border-left', '1.5px solid #b2b2b2');
			td4.css('border-bottom', '1.5px solid #b2b2b2');
			td4.css('border-radius', '8px');
			td4.css('background-color', '#ffffff');
		}
	}

	function editrow2() {
		var a = document.getElementById('dtc2').value;
		if (a == 1) {
			var dg = $('#dg2bb2');
			var td4 = dg.datagrid('getPanel').find('div.datagrid-body td[field="qtys"]').css('background-color', '#000000');;
			td4.css('border-right', '1.5px solid #b2b2b2');
			td4.css('border-top', '1.5px solid #b2b2b2');
			td4.css('border-left', '1.5px solid #b2b2b2');
			td4.css('border-bottom', '1.5px solid #b2b2b2');
			td4.css('border-radius', '8px');
			td4.css('background-color', '#ffffff');
		}
	}

	function viewdtl() {
		var a = document.getElementById('dtb').value;
		//  alert(a);
		if (a == 0) {
			$('#cancel1').show();
			$('#edit1').show();
			$('#cancela').hide();
			$('#savea').hide();
			$('#tabel2bb').hide();
			$('#tabel2c').show();
			document.getElementById('dtb').value = 1;
			$('#shw').show();
			$('#hdn').hide();
			$('#shipdetail').show();
			$('#shipdetail').css('margin-top', '15px');
			$('#shipdetail2').hide();
			$('#dg2bb').datagrid('load', {
				importpkb: $('#importpkb').val()
			});
			$('#dg2c').datagrid('load', {
				importpkb: $('#importpkb').val()
			});
		} else {
			$('#tabel2bb').show();
			document.getElementById('dtb').value = 0;
			$('#shw').hide();
			$('#hdn').show();
			$('#shipdetail').css('margin-top', '20px');
			$('#dg2bb').datagrid('load', {
				importpkb: $('#importpkb').val()
			});
		}
	}


	function viewdtl2() {
		var a = document.getElementById('dtb2').value;
		//  alert(a);
		if (a == 0) {
			$('#cancel12').show();
			$('#edit12').show();
			$('#cancela2').hide();
			$('#savea2').hide();
			$('#tabel2bb2').hide();
			$('#tabel2c2').show();
			document.getElementById('dtb2').value = 1;
			$('#shw2').show();
			$('#hdn2').hide();
			$('#shipdetail2').show();
			$('#shipdetail2').css('margin-top', '15px');
			$('#shipdetail22').hide();
			$('#dg2bb2').datagrid('load', {
				importpkb: $('#importpkb2').val()
			});
			$('#dg2c2').datagrid('load', {
				importpkb: $('#importpkb2').val()
			});

		} else {
			$('#tabel2bb2').show();
			document.getElementById('dtb2').value = 0;
			$('#shw2').hide();
			$('#hdn2').show();
			$('#shipdetail2').css('margin-top', '300px');
			$('#dg2bb2').datagrid('load', {
				importpkb: $('#importpkb2').val()
			});

		}
	}

	function myformatter(date) {
		/*var y = date.getFullYear("yy");
		var m = date.getMonth("M")+1;
		var d = date.getDate("dd");
		//return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
		return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
		//return d+'/'+m+'/'+y;*/
		var d = new Date(date || Date.now()),
			month = '' + (d.getMonth() + 1),
			day = '' + d.getDate(),
			year = d.getFullYear();
		if (month.length < 2) month = '0' + month;
		if (day.length < 2) day = '0' + day;
		return [day, month, year].join('/');
	}

	function myparser(s) {
		if (!s) return new Date();
		//var ss = (s.split('-'));
		var ss = (s.split('/'));
		var y = parseInt(ss[0], 10);
		var m = parseInt(ss[1], 10);
		var d = parseInt(ss[2], 10);
		if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
			//return new Date(y,m-1,d);
			return new Date(d, m - 1, y);
		} else {
			return new Date();
			//return new Date(date).format("dd/mm/yy");
		}
	}

	/*search*/
	function Search2() {
		$('#dg2').datagrid('load', {
			cari1: $('#cari1b').val(),
			cari2: $('#cari2b').val(),
			cari3: $('#cari3b').val(),
			cari6: $('#cari6b').val(),
			type0: $('#filtera0').val(),
			type1: $('#filtera1').val(),
			type2: $('#filtera2').val(),
			spec0: $('#filterb0').val(),
			spec1: $('#filterb1').val(),
			col0: $('#filterc0').val(),
			col1: $('#filterc1').val()
		});

		over1();
		over2();
		sumpo();
		sumreq();
		cost1();
		cost2();
	}

	function Search2a() {
		$('#dg2').datagrid('load', {
			cari1: $('#cari1b').val(),
			cari2: $('#cari2b').val(),
			cari3: $('#cari3b').val(),
			cari6: $('#cari6b').val(),
			cari4: $('#cari4b').val(),
			type0: $('#filtera0').val(),
			type1: $('#filtera1').val(),
			type2: $('#filtera2').val(),
			spec0: $('#filterb0').val(),
			spec1: $('#filterb1').val(),
			col0: $('#filterc0').val(),
			col1: $('#filterc1').val()
		});
		$('#newest').show();
		$('#oldest').hide();
		$('#itemaz').hide();

		over1();
		over2();
		sumpo();
		sumreq();
		cost1();
		cost2();
	}

	function Search2b() {
		$('#dg2').datagrid('load', {
			cari1: $('#cari1b').val(),
			cari2: $('#cari2b').val(),
			cari3: $('#cari3b').val(),
			cari6: $('#cari6b').val(),
			cari5: $('#cari5b').val(),
			type0: $('#filtera0').val(),
			type1: $('#filtera1').val(),
			type2: $('#filtera2').val(),
			spec0: $('#filterb0').val(),
			spec1: $('#filterb1').val(),
			col0: $('#filterc0').val(),
			col1: $('#filterc1').val()
		});
		$('#newest').hide();
		$('#oldest').show();
		$('#itemaz').hide();

		over1();
		over2();
		sumpo();
		sumreq();
		cost1();
		cost2();
	}

	function Searchaz() {
		$('#dg2').datagrid('load', {
			cari1: $('#cari1b').val(),
			cari2: $('#cari2b').val(),
			cari3: $('#cari3b').val(),
			cari6: $('#cari6b').val(),
			cariaz: $('#cariaz').val(),
			type0: $('#filtera0').val(),
			type1: $('#filtera1').val(),
			type2: $('#filtera2').val(),
			spec0: $('#filterb0').val(),
			spec1: $('#filterb1').val(),
			col0: $('#filterc0').val(),
			col1: $('#filterc1').val()
		});
		$('#newest').hide();
		$('#oldest').hide();
		$('#itemaz').show();

		over1();
		over2();
		sumpo();
		sumreq();
		cost1();
		cost2();
	}

	function Search4a() {
		$('#dg4e').datagrid('load', {
			cari7: $('#cari7').val()
		});
		over1();
		over2();
		sumpo();
		sumreq();
		cost1();
		cost2();
	}

	function Search4b() {
		var nilaiCari = $('#cari8').val();
    $('#dg4f').datagrid('load', {
        cariMaterial: nilaiCari
    });
		over1();
		over2();
		sumpo();
		sumreq();
		cost1();
		cost2();
	}

	function Search4() {
		$('#kolom1').datagrid('load', {
			cari6: $('#cari6').val()
		});
		over1();
		over2();
		sumpo();
		sumreq();
		cost1();
		cost2();
	}

	function Searchc() {
		$('#dg2b').datagrid('load', {
			cari11: $('#cari11').val(),
			cari14: $('#cari14').val()
		});
		over1();
		over2();
		sumpo();
		sumreq();
		cost1();
		cost2();
	}

	function Searchc2() {
		$('#dg2b2').datagrid('load', {
			cari12: $('#cari12a').val()
		});
		over1();
		over2();
		sumpo();
		sumreq();
		cost1();
		cost2();
	}

	function Searchc3() {
		$('#dg2b3').datagrid('load', {
			cari12: $('#cari12').val(),
			cari13: $('#cari13').val()
		});
		over1();
		over2();
		sumpo();
		sumreq();
		cost1();
		cost2();
	}

	/*print*/
	function print() {
		var row = $('#dg2').datagrid('getSelected');
		var data = JSON.stringify($('#dg2').datagrid('getData').total);
		//document.getElementById("rkb2").value = ids;
		var tabmat = "All material (" + data + ")";
		if (row) {
			document.write(tabmat);
			/*url = "pdf/pdf_qty2.php?ord="+row.ordpk;
	  window.open(url);*/
			/*window.location.href="pdf/pdf_rkb.php&cari=breakdown&ord=" +row.ordpk;*/
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	function print2() {
		var ids = [];
		var row = $('#dg2').datagrid('getSelected');
		var rows = $('#dg2').datagrid('getSelections');
		if (row) {
			//cari6 = $('#cari6b').val();
			for (var i = 0; i < rows.length; i++) {
				ids.push(rows[i].rkbpk);
			}
			url = "pdf/pdf_mat?ord=" + row.ordpk + "&rkb=" + ids;
			window.open(url);
			/*window.location.href="pdf/pdf_rkb.php&cari=breakdown&ord=" +row.ordpk;*/
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	function myFunction2b(forcedCurrency) {
		validateConsumption();
		var x = document.getElementById("bdownqty1a").value;
		// alert(x);
		var y = document.getElementById("allowcons1").value;
		var a = parseFloat(document.getElementById("qrs1").value) || 0;
		var b = document.getElementById("estcons1").value;
		var c = parseFloat(document.getElementById("allowman1").value) || 0;
		var d = document.getElementById("negocons1").value;
		var g = document.getElementById("formula1b").value;
		let pocons2 = document.getElementById("pocons2b").value;
		//var f1a = document.getElementById("f1a").value;
		//var f2a = document.getElementById("f2a").value;
		var f1b = document.getElementById("f1b").value;
		var f2b = document.getElementById("f2b").value;

		
		let currency = forcedCurrency || $('#curpk').combobox('getText') || 'USD';
		var valunitprice = document.getElementById("price2").value;
		//var g =  $('#formula1').val();
		//var h =  $('#formula2').val();
		$('#allowcons_text').text(`(${y}% allowance)`);
		$('#allowance_qty_create').text(`(${y}%)`);
		$('.text_currency').text(currency);

		let wrapper = $('#poSummaryWrapper');
		let wrapperBalance = $('.balanceWrapperSummaryCreate');

		if (valunitprice != "" && parseFloat(valunitprice) >= 0) {
				wrapper.find('.po-content-data').show(); 
				wrapper.find('.po-instruction').hide(); 
		} else {
				wrapper.find('.po-content-data').hide();
				wrapper.find('.po-instruction').show();
		}

		const format = (num) => new Intl.NumberFormat().format(num || 0);

		/*var y2 = 0;*/
		if (x == '') {
			var x2 = 0;
		} else {
			var x2 = x;
		}

		if (a == '') {
			var a2 = 0;
		} else {
			a2 = a;
		}

		if (y == '') {
			var y2 = 0;
		} else {
			var y2 = y;
		}

		if (c == '') {
			var c2 = 0;
		} else {
			var c2 = c;
		}

		if (d == '') {
			var d2 = 0;
		} else {
			var d2 = d;
		}

		if (f1b) {
			//alert(f1b);
			$.ajax({
				type: "POST",
				url: "view/get_rumus.php?bdownqty=" + x + "&estcons=" + b + "&formula1=" + g + "&f2b=" + f2b + "&negocons=" + d,
				data: "f1b=" + f1b,
				dataType: "json",
        success: function(response){
					//alert(data);
					//var e = data;

					// document.getElementById("totcons1").value = data;
					// var e2 = document.getElementById("totcons1").value;

					let tnetto = parseFloat(response.tnetto) || 0;
					let nettoBase = parseFloat(response.netto) || 0;
          let e2budget = parseFloat(response.tbudgetNetto) || 0;

					document.getElementById("totcons1").value = tnetto;
					var e2 = parseFloat(document.getElementById("totcons1").value) || 0;

					var f = b - d;
					let ab = (pocons2 / x ) - d
					let allowqty = e2 * parseFloat(y2) / 100;
					let allowqtyBudget = e2budget * parseFloat(y2) / 100;

					let finalCons = pocons2 / x; 
          setFinalConsumption(finalCons, d);
					document.getElementById("varcons1").value = f;

					// var z = parseFloat(e2) + allowqty + parseFloat(a2) + parseFloat(c2);
					var z = (parseFloat(e2) + allowqty + parseFloat(a2) + parseFloat(c2)).toFixed(2);
					let zBudget = e2budget + allowqtyBudget + parseFloat(a2) + parseFloat(c2);

					let finalPO = Math.ceil(z);
          let totalCost = finalPO * valunitprice;
					setConsumptionVarianceFull('#varcons_text', ab, d);

					document.getElementById("pocons1").value = z;
					document.getElementById("pocons2b").value = Math.ceil(z);
					document.getElementById("totcons_create").value = nettoBase;

					let finalBudget = Math.ceil(zBudget);
					let consManual = c;
					let allowAds = allowqty;
					let consPps = a;
					let consOther = consManual;
					let totalConsumption = allowAds + consPps + consManual;
					let persentTotalConsumption = (pocons2 && pocons2 !== 0) ? (totalConsumption / pocons2) * 100 : 0;
					let totalCostOrder = totalConsumption * parseFloat(valunitprice);
					let nettoCost = pocons2 * parseFloat(valunitprice);
          let persentCostOrder = (nettoCost && nettoCost !== 0) ? (totalCostOrder / nettoCost) * 100 : 0;
					let totalBudget = finalBudget * valunitprice;
					let totalBalance = parseFloat((totalBudget - totalCost).toFixed(2));

					let allowAdsDetail = allowqty/x;
					let totAddsCost = (allowAdsDetail * x) || 0;
					let allowCostDetail = allowAdsDetail * valunitprice;
					let totAddsItemCost = allowCostDetail * x;
					let totPpsCost = (consPps/x)*valunitprice * x;
					let totManualCost = (consManual/x)*valunitprice * x;
					let totConsumptionDetail= totAddsItemCost + totPpsCost + totManualCost;

					console.log('e2', e2);
					console.log('allowAds', allowAds);
					console.log('allowAdsDetail', allowAdsDetail);
					console.log('totAddsCost', totAddsCost);
					console.log('allowCostDetail', allowCostDetail);

					const btnSave = $('#btnSaveMaterial');
					const warningText = $('#budget_warning_create');

					let isOverBudget = totalBalance < 0;

					if (isOverBudget) {
							btnSave.prop('disabled', true).removeClass('btn-dark').css('color', '#ffffff'); 
							warningText.text('Total Cost Order melebihi Total Budget!').css('color', '#EF3B42');
					} else {
							btnSave.prop('disabled', false).removeClass('btn-secondary').addClass('btn-dark').css('color', '#ffffff');
							warningText.text('').css('color', ''); 
					}

					let signOrder = totalCostOrder > 0 ? '+' : '';

					$('.text_allowads_create').text(format(allowAds.toFixed(2)));
					$('.text_cons_pps_create').text(format(consPps));
					$('.text_cons_other_create').text(format(consOther));
					$('.text_totalconsumption_create').text(format(totalConsumption.toFixed(2)));
					applyColorAndSign('.text_persent_totalconsumption_create', persentTotalConsumption);
					$('.text_total_costorder_create').text(signOrder + formatCurrency(totalCostOrder, currency));
					applyColorAndSign('.text_persent_costorder_create', persentCostOrder);
					$('.text_totalbudget_create').text(formatCurrency(totalBudget, currency));
					$('.text_total_cost_create').text(formatCurrency(totalCost, currency));
					$('.text_totalbalance_create').text(formatCurrency(totalBalance, currency));
					applyColorBudget(wrapperBalance, totalBalance);

					$(".label_bqty_po").text(format(e2.toFixed(2)));
					$(".label_total_po").text(format(z));
					// $('.label_allowance_qty').text(allowqty.toLocaleString());
					$('.label_allowance_qty').text(format(allowqty.toFixed(2)));
					$('.label_manual_qty').text(format(c));
					$('.label_pps_qty').text(format(a));
					$('.label_final_po').text(Math.ceil(z).toLocaleString());
					$('.label_unit_price').text(formatCurrency(valunitprice, currency));
					$('.label_total_cost').text(formatCurrency(totalCost, currency));

					$('.text_bdownqty').text(`${x} PCS`);
					$('.label_allowance_detail').text(format(allowAdsDetail));
					$('.label_total_add_cost').text(format(totAddsCost.toFixed(2)));
					applyColorAndSignDetail('.text_persent_totalconsumption_create_detail', persentTotalConsumption);
					$('.label_allowancecost_detail').text(formatCurrency(allowCostDetail, currency));
					$('.label_total_add_itemcost').text(formatCurrency(totAddsItemCost, currency));
					$('.text_cons_costpps').text(formatCurrency(totPpsCost, currency));
					$('.text_cons_costother').text(formatCurrency(totManualCost, currency));
					$('.text_totalconsumption_detail').text(signOrder + formatCurrency(totConsumptionDetail, currency));
					applyColorAndSignDetail('.text_persent_consumptioncreate_detail', persentTotalConsumption);
					$('.label_coscons_detail').text(format(finalBudget));

					calculateCosting();
				},
			});
		} else {
			var e = x * b;
			var eBudget = x * d; 
			let nettoBase = parseFloat(e) || 0;

			document.getElementById("totcons1").value = e;
			var e2 = parseFloat(e) || 0;

			var f = b - d;
			let ab = (pocons2 / x ) - d
			let allowqty = e * parseFloat(y2) / 100;
			let allowqtyBudget = eBudget * parseFloat(y2) / 100;
			let finalCons = pocons2 / x; 
      setFinalConsumption(finalCons, d);
			document.getElementById("varcons1").value = f;

			// var z = parseFloat(e2) + allowqty + parseFloat(a2) + parseFloat(c2);
			var z = (parseFloat(e2) + allowqty + parseFloat(a2) + parseFloat(c2)).toFixed(2);
			let zBudget = eBudget + allowqtyBudget + parseFloat(a2) + parseFloat(c2);

			let finalPO = Math.ceil(z);
			let totalCost = finalPO * valunitprice;
			let finalBudget = Math.ceil(zBudget);
      let totalBudget = finalBudget * valunitprice;
			let consPps = a;
			let consManual = c;
			setConsumptionVarianceFull('#varcons_text', ab, d);
			
			document.getElementById("pocons1").value = z;
			document.getElementById("pocons2b").value = Math.ceil(z);
			document.getElementById("totcons_create").value = nettoBase;

			let totalConsumption = allowqty + parseFloat(a2) + parseFloat(c2);
      let totalCostOrder = totalConsumption * parseFloat(valunitprice);
      let totalBalance = parseFloat((totalBudget - totalCost).toFixed(2));
      
      let persentTotalConsumption = (pocons2 && pocons2 !== 0) ? (totalConsumption / pocons2) * 100 : 0;
      let nettoCost = pocons2 * parseFloat(valunitprice);
      let persentCostOrder = (nettoCost && nettoCost !== 0) ? (totalCostOrder / nettoCost) * 100 : 0;

			let allowAdsDetail = allowqty/x;
			let totAddsCost = (allowAdsDetail * x) || 0;
			let allowCostDetail = allowAdsDetail * valunitprice;
			let totAddsItemCost = allowCostDetail * x;
			let totPpsCost = (consPps/x)*valunitprice * x;
			let totManualCost = (consManual/x)*valunitprice * x;
			let totConsumptionDetail= totAddsItemCost + totPpsCost + totManualCost;

			console.log('e2', e2);
			console.log('allowqty', allowqty);
			console.log('allowAdsDetail', allowAdsDetail);
			console.log('totAddsCost', totAddsCost);
			console.log('allowCostDetail', allowCostDetail);

			const btnSave = $('#btnSaveMaterial');
      const warningText = $('#budget_warning_create');
      let isOverBudget = totalBalance < 0;

      if (isOverBudget) {
          btnSave.prop('disabled', true).removeClass('btn-dark').css('color', '#ffffff'); 
          warningText.text('Total Cost Order melebihi Total Budget!').css('color', '#EF3B42');
      } else {
          btnSave.prop('disabled', false).removeClass('btn-secondary').addClass('btn-dark').css('color', '#ffffff');
          warningText.text('').css('color', ''); 
      }

			let signOrder = totalCostOrder > 0 ? '+' : '';

			$(".label_bqty_po").text(format(e2.toFixed(2)));
      $(".label_total_po").text(format(z));
      $('.label_allowance_qty').text(format(allowqty.toFixed(2)));
      $('.label_manual_qty').text(format(c2));
      $('.label_pps_qty').text(format(a2));
      $('.label_final_po').text(finalPO.toLocaleString());
      $('.label_unit_price').text(formatCurrency(valunitprice, currency));
      $('.label_total_cost').text(formatCurrency(totalCost, currency));

			$('.text_allowads_create').text(format(allowqty.toFixed(2)));
      $('.text_cons_pps_create').text(format(a2));
      $('.text_cons_other_create').text(format(c2));
      $('.text_totalconsumption_create').text(format(totalConsumption.toFixed(2)));
      $('.text_totalbudget_create').text(formatCurrency(totalBudget, currency));
      $('.text_total_cost_create').text(formatCurrency(totalCost, currency));
      $('.text_total_costorder_create').text(signOrder + formatCurrency(totalCostOrder, currency));
      $('.text_totalbalance_create').text(formatCurrency(totalBalance, currency));

			applyColorAndSign('.text_persent_totalconsumption_create', persentTotalConsumption);
      applyColorAndSign('.text_persent_costorder_create', persentCostOrder);
      applyColorBudget(wrapperBalance, totalBalance);

			$('.text_bdownqty').text(`${x} PCS`);
			$('.label_allowance_detail').text(format(allowAdsDetail));
			$('.label_total_add_cost').text(format(totAddsCost.toFixed(2)));
			applyColorAndSignDetail('.text_persent_totalconsumption_create_detail', persentTotalConsumption);
			$('.label_allowancecost_detail').text(formatCurrency(allowCostDetail, currency));
			$('.label_total_add_itemcost').text(formatCurrency(totAddsItemCost, currency));
			$('.text_cons_costpps').text(formatCurrency(totPpsCost, currency));
			$('.text_cons_costother').text(formatCurrency(totManualCost, currency));
			$('.text_totalconsumption_detail').text(signOrder + formatCurrency(totConsumptionDetail, currency));
			applyColorAndSignDetail('.text_persent_consumptioncreate_detail', persentTotalConsumption);
			$('.label_coscons_detail').text(format(finalBudget));

			calculateCosting();
		}
	}

	/* RUmus Onkeyup */
	function myFunction2a(forcedCurrency) {
		validateConsumptionA();
		var x = document.getElementById("bdownqty").value;
		// alert(x);
		var y = document.getElementById("allowcons").value;
		var a = parseFloat(document.getElementById("qrs").value) || 0;
		var b = document.getElementById("estcons").value;
		var c = parseFloat(document.getElementById("allowman").value) || 0;
		var d = document.getElementById("negocons").value;
		var g = document.getElementById("formula1").value;
		let pocons2 = document.getElementById("pocons2").value;
		//var f1a = document.getElementById("f1a").value;
		//var f2a = document.getElementById("f2a").value;
		var f1b = document.getElementById("f1").value;
		var f2b = document.getElementById("f2").value;

		let currency = forcedCurrency || $('#curpk1').combobox('getText') || 'USD';
		var valunitprice = document.getElementById("price2a").value;
		//var g =  $('#formula1').val();
		//var h =  $('#formula2').val();
		$('#allowcons_text1').text(`(${y}% allowance)`);
		$('#allowance_qty').text(`(${y}%)`);
		$('.text_currency').text(currency);

		let wrapper = $('#poSummaryWrapper1');
		let wrapperBalance = $('.balanceWrapperSummaryEdit');

		// if (valunitprice != "" && parseFloat(valunitprice) > 0) {
		// 		wrapper.find('.po-content-data').show(); 
		// 		wrapper.find('.po-instruction').hide(); 
		// } else {
		// 		wrapper.find('.po-content-data').hide();
		// 		wrapper.find('.po-instruction').show();
		// }
		if (valunitprice !== "" && !isNaN(parseFloat(valunitprice)) && parseFloat(valunitprice) >= 0) {
				wrapper.find('.po-content-data').show(); 
				wrapper.find('.po-instruction').hide(); 
		} else {
				wrapper.find('.po-content-data').hide();
				wrapper.find('.po-instruction').show();
		}
		//var g =  $('#formula1').val();
		//var h =  $('#formula2').val();
		const format = (num) => new Intl.NumberFormat().format(num || 0);

		/*var y2 = 0;*/
		if (x == '') {
			var x2 = 0;
		} else {
			var x2 = x;
		}

		if (a == '') {
			var a2 = 0;
		} else {
			a2 = a;
		}

		if (y == '') {
			var y2 = 0;
		} else {
			var y2 = y;
		}

		if (c == '') {
			var c2 = 0;
		} else {
			var c2 = c;
		}

		if (d == '') {
			var d2 = 0;
		} else {
			var d2 = d;
		}

		if (f1b) {
			//alert(f1b);
			$.ajax({
				type: "POST",
				url: "view/get_rumus.php?bdownqty=" + x + "&estcons=" + b + "&formula1=" + g + "&f2b=" + f2b + "&negocons=" + d,
				data: "f1b=" + f1b,
				dataType: "json",
        success: function(response){
					//alert(data);
					//var e = data;
					let tnetto = parseFloat(response.tnetto) || 0;
					let nettoBase = parseFloat(response.netto) || 0;
          let e2budget = parseFloat(response.tbudgetNetto) || 0;

					document.getElementById("totcons").value = tnetto;
					var e2 = parseFloat(document.getElementById("totcons").value) || 0;

					var f = b - d;
					let ab = (pocons2 / x ) - d
					let allowqty = e2 * parseFloat(y) / 100;
					let allowqtyBudget = e2budget * y / 100;

					let finalCons = pocons2 / x; 
          setFinalConsumptionA(finalCons, d);
					document.getElementById("varcons").value = f;

					// var z = parseFloat(e2) + allowqty + parseFloat(a2) + parseFloat(c2);
					var z = (parseFloat(e2) + allowqty + parseFloat(a2) + parseFloat(c2)).toFixed(2);
					let zBudget = e2budget + allowqtyBudget + parseFloat(a2) + parseFloat(c2);

					let finalPO = Math.ceil(z);
          let totalCost = finalPO * valunitprice;
					setConsumptionVarianceFull('#varcons_text1', ab, d);

					document.getElementById("pocons").value = z;
					document.getElementById("pocons2").value = Math.ceil(z);
					document.getElementById("totcons_edit").value = nettoBase;

					let finalBudget = Math.ceil(zBudget);
					let consManual = c;
					let allowAds = allowqty;
					let consPps = a;
					let consOther = consManual;
					let totalConsumption = allowAds + consPps + consManual;
					let persentTotalConsumption = (pocons2 && pocons2 !== 0) ? (totalConsumption / pocons2) * 100 : 0;
					let totalCostOrder = totalConsumption * parseFloat(valunitprice);
					let nettoCost = pocons2 * parseFloat(valunitprice);
          let persentCostOrder = (nettoCost && nettoCost !== 0) ? (totalCostOrder / nettoCost) * 100 : 0;
					let totalBudget = finalBudget * valunitprice;
					let totalBalance = parseFloat((totalBudget - totalCost).toFixed(2));

					let allowAdsDetail = allowqty/x;
					let totAddsCost = (allowAdsDetail * x) || 0;
					let allowCostDetail = allowAdsDetail * valunitprice;
					let totAddsItemCost = allowCostDetail * x;
					let totPpsCost = (consPps/x)*valunitprice * x;
					let totManualCost = (consManual/x)*valunitprice * x;
					let totConsumptionDetail= totAddsItemCost + totPpsCost + totManualCost;

					console.log('e2', e2);
					console.log('allowAds', allowAds);
					console.log('allowAdsDetail', allowAdsDetail);
					console.log('totAddsCost', totAddsCost);
					console.log('allowCostDetail', allowCostDetail);

					const btnSave = $('#btnSaveMaterial1');
					const warningText = $('#budget_warning_edit');

					let isOverBudget = totalBalance < 0;

					if (isOverBudget) {
							btnSave.prop('disabled', true).removeClass('btn-dark').css('color', '#ffffff'); 
							warningText.text('Total Cost Order melebihi Total Budget!').css('color', '#EF3B42');
					} else {
							btnSave.prop('disabled', false).removeClass('btn-secondary').addClass('btn-dark').css('color', '#ffffff');
							warningText.text('').css('color', ''); 
					}

					let signOrder = totalCostOrder > 0 ? '+' : '';

					$('.text_allowads_edit').text(format(allowAds.toFixed(2)));
					$('.text_cons_pps_edit').text(format(consPps));
					$('.text_cons_other_edit').text(format(consOther));
					$('.text_totalconsumption_edit').text(format(totalConsumption.toFixed(2)));
					applyColorAndSign('.text_persent_totalconsumption_edit', persentTotalConsumption);
					$('.text_total_costorder_edit').text(signOrder + formatCurrency(totalCostOrder, currency));
					applyColorAndSign('.text_persent_costorder_edit', persentCostOrder);
					$('.text_totalbudget_edit').text(formatCurrency(totalBudget, currency));
					$('.text_total_cost_edit').text(formatCurrency(totalCost, currency));
					$('.text_totalbalance_edit').text(formatCurrency(totalBalance, currency));
					applyColorBudget(wrapperBalance, totalBalance);

					$(".label_bqty_po").text(format(e2.toFixed(2)));
					$(".label_total_po").text(format(z));
					// $('.label_allowance_qty').text(allowqty.toLocaleString());
					$('.label_allowance_qty').text(format(allowqty.toFixed(2)));
					$('.label_manual_qty').text(format(c));
					$('.label_pps_qty').text(format(a));
					$('.label_final_po').text(Math.ceil(z).toLocaleString());
					$('.label_unit_price').text(formatCurrency(valunitprice, currency));
					$('.label_total_cost').text(formatCurrency(totalCost, currency));

					$('.text_bdownqty').text(`${x} PCS`);
					$('.label_allowance_detail').text(format(allowAdsDetail));
					$('.label_total_add_cost').text(format(totAddsCost.toFixed(2)));
					applyColorAndSignDetail('.text_persent_totalconsumption_edit_detail', persentTotalConsumption);
					$('.label_allowancecost_detail').text(formatCurrency(allowCostDetail, currency));
					$('.label_total_add_itemcost').text(formatCurrency(totAddsItemCost, currency));
					$('.text_cons_costpps').text(formatCurrency(totPpsCost, currency));
					$('.text_cons_costother').text(formatCurrency(totManualCost, currency));
					$('.text_totalconsumption_detail').text(signOrder + formatCurrency(totConsumptionDetail, currency));
					applyColorAndSignDetail('.text_persent_consumption_detail', persentTotalConsumption);
					$('.label_coscons_detail').text(format(finalBudget));
					

					calculateCostingA();
				},
			});
		} else {
			var e = x * b;
			var eBudget = x * d; 
			let nettoBase = parseFloat(e) || 0;

			document.getElementById("totcons").value = e;
			var e2 = parseFloat(e) || 0;

			var f = b - d;
			let ab = (pocons2 / x ) - d
			let allowqty = e * parseFloat(y2) / 100;
			let allowqtyBudget = eBudget * parseFloat(y2) / 100;
			let finalCons = pocons2 / x; 
			let consPps = a;
			let consManual = c;
			setFinalConsumptionA(finalCons, d);
			document.getElementById("varcons").value = f;

			// var z = parseFloat(e2) + allowqty + parseFloat(a2) + parseFloat(c2);
			var z = (parseFloat(e2) + allowqty + parseFloat(a2) + parseFloat(c2)).toFixed(2);
			let zBudget = eBudget + allowqtyBudget + parseFloat(a2) + parseFloat(c2);

			let finalPO = Math.ceil(z);
			let totalCost = finalPO * valunitprice;
			let finalBudget = Math.ceil(zBudget);
      let totalBudget = finalBudget * valunitprice;
			setConsumptionVarianceFull('#varcons_text1', ab, d);

			document.getElementById("pocons").value = z;
			document.getElementById("pocons2").value = Math.ceil(z);
			document.getElementById("totcons_edit").value = nettoBase;

			let totalConsumption = allowqty + parseFloat(a2) + parseFloat(c2);
      let totalCostOrder = totalConsumption * parseFloat(valunitprice);
      let totalBalance = parseFloat((totalBudget - totalCost).toFixed(2));
      
      let persentTotalConsumption = (pocons2 && pocons2 !== 0) ? (totalConsumption / pocons2) * 100 : 0;
      let nettoCost = pocons2 * parseFloat(valunitprice);
      let persentCostOrder = (nettoCost && nettoCost !== 0) ? (totalCostOrder / nettoCost) * 100 : 0;

			let allowAdsDetail = allowqty/x;
			let totAddsCost = (allowAdsDetail * x) || 0;
			let allowCostDetail = allowAdsDetail * valunitprice;
			let totAddsItemCost = allowCostDetail * x;
			let totPpsCost = (consPps/x)*valunitprice * x;
			let totManualCost = (consManual/x)*valunitprice * x;
			let totConsumptionDetail= totAddsItemCost + totPpsCost + totManualCost;

			console.log('e2', e2);
			console.log('allowqty', allowqty);
			console.log('allowAdsDetail', allowAdsDetail);
			console.log('totAddsCost', totAddsCost);
			console.log('allowCostDetail', allowCostDetail);

			const btnSave = $('#btnSaveMaterial1');
      const warningText = $('#budget_warning_edit');
      let isOverBudget = totalBalance < 0;

      if (isOverBudget) {
          btnSave.prop('disabled', true).removeClass('btn-dark').css('color', '#ffffff'); 
          warningText.text('Total Cost Order melebihi Total Budget!').css('color', '#EF3B42');
      } else {
          btnSave.prop('disabled', false).removeClass('btn-secondary').addClass('btn-dark').css('color', '#ffffff');
          warningText.text('').css('color', ''); 
      }

			let signOrder = totalCostOrder > 0 ? '+' : '';

			$(".label_bqty_po").text(format(e2.toFixed(2)));
      $(".label_total_po").text(format(z));
      $('.label_allowance_qty').text(format(allowqty.toFixed(2)));
      $('.label_manual_qty').text(format(c2));
      $('.label_pps_qty').text(format(a2));
      $('.label_final_po').text(finalPO.toLocaleString());
      $('.label_unit_price').text(formatCurrency(valunitprice, currency));
      $('.label_total_cost').text(formatCurrency(totalCost, currency));

			$('.text_allowads_edit').text(format(allowqty.toFixed(2)));
      $('.text_cons_pps_edit').text(format(a2));
      $('.text_cons_other_edit').text(format(c2));
      $('.text_totalconsumption_edit').text(format(totalConsumption.toFixed(2)));
      $('.text_totalbudget_edit').text(formatCurrency(totalBudget, currency));
      $('.text_total_cost_edit').text(formatCurrency(totalCost, currency));
      $('.text_total_costorder_edit').text(signOrder + formatCurrency(totalCostOrder, currency));
      $('.text_totalbalance_edit').text(formatCurrency(totalBalance, currency));

			applyColorAndSign('.text_persent_totalconsumption_edit', persentTotalConsumption);
      applyColorAndSign('.text_persent_costorder_edit', persentCostOrder);
      applyColorBudget(wrapperBalance, totalBalance);

			$('.text_bdownqty').text(`${x} PCS`);
			$('.label_allowance_detail').text(format(allowAdsDetail));
			$('.label_total_add_cost').text(format(totAddsCost.toFixed(2)));
			applyColorAndSignDetail('.text_persent_totalconsumption_edit_detail', persentTotalConsumption);
			$('.label_allowancecost_detail').text(formatCurrency(allowCostDetail, currency));
			$('.label_total_add_itemcost').text(formatCurrency(totAddsItemCost, currency));
			$('.text_cons_costpps').text(formatCurrency(totPpsCost, currency));
			$('.text_cons_costother').text(formatCurrency(totManualCost, currency));
			$('.text_totalconsumption_detail').text(signOrder + formatCurrency(totConsumptionDetail, currency));
			applyColorAndSignDetail('.text_persent_consumption_detail', persentTotalConsumption);
			$('.label_coscons_detail').text(format(finalBudget));

			calculateCostingA();
		}
	}

	function calculateCostingA(forcedCurrency) {
			let totcons = parseFloat($('#totcons').val()) || 0;
			let allow = parseFloat($('#allowcons').val()) || 0;
			let price = parseFloat($('#price2a').val()) || 0;
			let qty = parseFloat($('#bdownqty').val()) || 0;
			let costing = parseFloat($('#negocons').val()) || 0;
			let qrs = parseFloat($('#qrs').val()) || 0;
			let manual = parseFloat($('#allowman').val()) || 0;
			let b = parseFloat($('#estcons').val()) || 0;
			let pocons2 = parseFloat($('#pocons2').val()) || 0;

			let currency = forcedCurrency || $('#curpk1').combobox('getText') || 'USD';
			let fractionDigits = (currency === 'IDR') ? 2 : 2;

			$('.text_currency').text(currency);

			// ===== HITUNG =====
			let allowanceQty = totcons * allow / 100;
			let finalCons = totcons + allowanceQty + qrs + manual;
			let consVariance = pocons2 / qty

			// Cost impact
			let allowanceCostPerPcs = allowanceQty * price;
			let totalAddVariance = (consVariance - costing) * price;
			// let finalItemCost = allowanceCostPerPcs +  totalAddVariance;
			let rawFinalItemCost = consVariance * price;
      let finalItemCost = parseFloat(rawFinalItemCost.toFixed(fractionDigits));

			let totalCost = pocons2 * price;
			let itemBudgetGarment = costing * price;
			let balance = itemBudgetGarment - finalItemCost;

			let displayVariance = Math.abs(totalAddVariance);
			let displayFinalCost = Math.abs(finalItemCost);

			// let totalAllowanceCost = allowanceCostPerPcs * qty;
			// let extraPerPcs = (finalCons - costing) * price;
			// let totalExtra = extraPerPcs * qty;

			// ===== ELEMENT Cost impact =====
			let allowPcEl = $('.text_allow_cost_pc1');
			let addVariance = $('.text_additional_variance1');
			let finCost = $('.text_final_itemcost1');
			let totCost = $('.text_order_cost1');
			let itemBudget = $('.text_itembudget_garmet');
			let totBalance = $('.text_total_balance');
			let currencyLabel = $('.text_currency');
			let wrapperBalance = $('#balanceWrapper');
			let wrapperTotalCost = $('#totalOrderWrapper1');
			// let allowTotEl = $('.text_allow_total');
			// let extraPcEl = $('.text_extra_pc');
			// let extraTotEl = $('.text_extra_total');

			// ===== SET TEXT =====
			allowPcEl.text(formatCurrency(allowanceCostPerPcs, currency));
			addVariance.text(formatCurrency(displayVariance, currency));
			finCost.text(formatCurrency(displayFinalCost, currency));
			// totCost.text(formatWithSign(totalCost, currency));
			totCost.text(formatWithSign(totalCost.toFixed(fractionDigits), currency));
			itemBudget.text(formatCurrency(itemBudgetGarment, currency));
			totBalance.text(formatWithSign(balance, currency));

			currencyLabel.text(currency);

			// allowTotEl.text(formatWithSign(totalAllowanceCost, currency));
			// extraPcEl.text(formatWithSign(extraPerPcs, currency, ' / pcs'));
			// extraTotEl.text(formatWithSign(totalExtra, currency));

			// ===== WARNA =====
			
			// applyColor(allowTotEl, totalAllowanceCost);
			// applyColor(extraPcEl, extraPerPcs);
			applyColor(wrapperBalance, balance);
			applyColor(wrapperTotalCost, totalCost);
	}

	function calculateCosting() {
			let totcons = parseFloat($('#totcons1').val()) || 0;
			let allow = parseFloat($('#allowcons1').val()) || 0;
			let price = parseFloat($('#price2').val()) || 0;
			let qty = parseFloat($('#bdownqty1a').val()) || 0;
			let costing = parseFloat($('#negocons1').val()) || 0;
			let qrs = parseFloat($('#qrs1').val()) || 0;
			let manual = parseFloat($('#allowman1').val()) || 0;
			let b = parseFloat($('#estcons1').val()) || 0;
			let pocons2 = parseFloat($('#pocons2b').val()) || 0;

			let currency = $('#curpk').combobox('getText') || 'USD';
			let fractionDigits = (currency === 'IDR') ? 2 : 2;

			// ===== HITUNG =====
			let allowanceQty = totcons * allow / 100;
			let finalCons = totcons + allowanceQty + qrs + manual;
			let consVariance = pocons2 / qty

			// Cost impact
			let allowanceCostPerPcs = allowanceQty * price;
			let totalAddVariance = (consVariance - costing) * price;
			// let finalItemCost = allowanceCostPerPcs +  totalAddVariance;
			let rawFinalItemCost = consVariance * price;
      let finalItemCost = parseFloat(rawFinalItemCost.toFixed(fractionDigits));
			
			let totalCost = pocons2 * price;
			let itemBudgetGarment = costing * price;
			let balance = itemBudgetGarment - finalItemCost;

			let displayVariance = Math.abs(totalAddVariance);
			let displayFinalCost = Math.abs(finalItemCost);

			// let totalAllowanceCost = allowanceCostPerPcs * qty;
			// let extraPerPcs = (finalCons - costing) * price;
			// let totalExtra = extraPerPcs * qty;

			// ===== ELEMENT Cost impact =====
			let allowPcEl = $('.text_allow_cost_pc');
			let addVariance = $('.text_additional_variance');
			let finCost = $('.text_final_itemcost');
			let totCost = $('.text_order_cost');
			let itemBudget = $('.text_itembudget_garmet');
			let totBalance = $('.text_total_balance');
			let currencyLabel = $('.text_currency');
			let wrapperBalance = $('#balanceWrapper');
			let wrapperTotalCost = $('#totalOrderWrapper');
			// let allowTotEl = $('.text_allow_total');
			// let extraPcEl = $('.text_extra_pc');
			// let extraTotEl = $('.text_extra_total');

			// ===== SET TEXT =====
			allowPcEl.text(formatCurrency(allowanceCostPerPcs, currency));
			addVariance.text(formatCurrency(displayVariance, currency));
			finCost.text(formatCurrency(displayFinalCost, currency));
			// totCost.text(formatWithSign(totalCost, currency));
			totCost.text(formatWithSign(totalCost.toFixed(fractionDigits), currency));
			itemBudget.text(formatCurrency(itemBudgetGarment, currency));
			totBalance.text(formatWithSign(balance, currency));

			currencyLabel.text(currency);

			// allowTotEl.text(formatWithSign(totalAllowanceCost, currency));
			// extraPcEl.text(formatWithSign(extraPerPcs, currency, ' / pcs'));
			// extraTotEl.text(formatWithSign(totalExtra, currency));

			// ===== WARNA =====
			
			// applyColor(allowTotEl, totalAllowanceCost);
			// applyColor(extraPcEl, extraPerPcs);
			applyColor(wrapperBalance, balance);
			applyColor(wrapperTotalCost, totalCost);
	}



	function setConsumptionVarianceFull(selector, ab, d, decimal = 3) {
        let el = $(selector);

        let v = parseFloat(ab) || 0;
        let n = parseFloat(d) || 0;

        // ambil unit
        let unit = $('#unit1').combobox('getText') || '';

        // ===== FORMAT VARIANCE =====
        let val = parseFloat(v.toFixed(decimal));
        let valText = val > 0 ? `+${val}` : val;

        // ===== FORMAT PERCENT =====
        let percent = n !== 0 ? (v / n) * 100 : 0;
        let per = parseFloat(percent.toFixed(2));
        let perText = per > 0 ? `+${per}` : per;

				// console.log('v', v);
				// console.log('n', n);
				// console.log('unit', unit);
				// console.log('percent', percent);
				// console.log('percent', percent);

        // ===== FINAL TEXT =====
        let text = `${valText} ${unit}/pcs (${perText}% from costing)`;

        el.text(text);

        // ===== WARNA =====
        applyColor(el, v);
    }

		function applyColorAndSign(selector, value) {
        const el = $(selector);
        el.removeClass('text-danger text-success text-dark');
        if (!isFinite(value)) value = 0;

        let sign = value > 0 ? '+' : '';
        let formattedValue = `(${sign}${value.toFixed(2)}%)`;

        if (value > 0) {
            el.css('color', '#EF3B42').text(formattedValue);
        } else if (value < 0) {
            el.css('color', '#19B715').text(formattedValue);
        } else {
            el.css('color', '#000000');
        }
    }

		function applyColorAndSignDetail(selector, value) {
        const el = $(selector);
        el.removeClass('text-danger text-success text-dark');
        if (!isFinite(value)) value = 0;

        let sign = value > 0 ? '+' : '';
        let formattedValue = `(${sign}${value.toFixed(2)}% dari PO Qty)`;

        if (value > 0) {
            el.css('color', '#EF3B42').text(formattedValue);
        } else if (value < 0) {
            el.css('color', '#19B715').text(formattedValue);
        } else {
            el.css('color', '#000000');
        }
    }

		function applyColorBudget(el, value) {
        el.removeClass('text-danger text-success text-dark bg-light-danger bg-light-success');

        if (value < 0) { 
            // Over Budget (Melebihi Budget)
           el.css('color', '#EF3B42');
        } else if (value > 0) {
            // Under Budget (Hemat)
            el.css('color', '#19B715');
        } else {
            el.css('color', '#000000');
        }
    }

		function applyColor(el, value) {
				// Menghapus inline style warna sebelumnya agar tidak bentrok
				el.css('color', ''); 

				if (value > 0) {
						el.css('color', '#e74c3c'); // Merah native (Hex)
				} else if (value < 0) {
						el.css('color', '#27ae60'); // Hijau native (Hex)
				} else {
						el.css('color', '#000000'); // Hitam/Gelap native
				}
		}

		// function setFinalConsumption(finalCons, d) {
    //     let el = $('.text_finalcons');

    //     let unit = $('#unit').combobox('getText') || '';
    //     let n = parseFloat(d) || 0;
    //     const format = (num) => new Intl.NumberFormat().format(Math.abs(num || 0));
    //     // let variance = finalCons - n;

    //     let percent = n !== 0 ? (finalCons / n) * 100 : 0;

    //     let valText = format(finalCons);
    //     let perNum = parseFloat(percent.toFixed(2));
        
    //     let perText = perNum > 0 ? `+${perNum}` : perNum;

    //     el.text(`${valText} ${unit}/pcs (${perText}% from costing)`);

    //     applyColor(el, finalCons);
    // }

		function validateConsumption() {
				let costing = parseFloat($('#negocons1').val()) || 0;
				let purchasing = parseFloat($('#estcons1').val()) || 0;
				let btn = $('#btnSaveMaterial');
				let warning = $('#cons_warning');

				let inputVal = parseFloat($('#bdownqty1a').val()) || 0;
        let totqty = parseFloat($('#val_totqty_raw_create').val()) || 0;

				console.log('Validasi Qty:', inputVal);
				console.log('totqty', totqty);

        let breakdownQty = inputVal;
        // if (inputVal > totqty) {
        //     breakdownQty = totqty;
        //     $('#bdownqty1a').val(totqty); 
            
        //     $('#bdownqty_warning_create').text('Nilai otomatis disesuaikan ke Maksimal Qty (' + totqty + ')').css('color', '#e74c3c');
        // } else {
        //     $('#bdownqty_warning_create').text('');
        // }


        let isPurchasingInvalid = purchasing > costing;
        if (isPurchasingInvalid) {
            warning.text('Purchasing consumption tidak boleh lebih besar dari costing!').css('color', '#e74c3c');
        } else {
            warning.text('');
        }

        if (isPurchasingInvalid) {
            btn.prop('disabled', true)
							.css({
								'background-color': '#95a5a6',
								'cursor': 'not-allowed',
								'border': 'none'
							});
        } else {
            btn.prop('disabled', false)
							.addClass('btn-dark')
							.css({
									'background-color': '#000000',
									'color': '#ffff',
									'cursor': 'pointer',
									'border': ''
							});
        }

				// if (purchasing > costing) {
				// 		// Keadaan Terkunci (Disabled)
				// 		btn.prop('disabled', true)
				// 			.css({
				// 					'background-color': '#95a5a6', // Abu-abu (Native)
				// 					'cursor': 'not-allowed',
				// 					'border': 'none'
				// 			});

				// 		warning.text('Purchasing consumption tidak boleh lebih besar dari costing!')
				// 					.css('color', '#e74c3c'); // Merah (Native)
				// } else {
				// 		// Keadaan Aktif (Enabled)
				// 		btn.prop('disabled', false)
				// 			.css({
				// 					'background-color': '#2c3e50', // Gelap (Native)
				// 					'cursor': 'pointer',
				// 					'border': 'none'
				// 			});

				// 		warning.text('');
				// }
		}
		function validateConsumptionA() {
				let costing = parseFloat($('#negocons').val()) || 0;
				let purchasing = parseFloat($('#estcons').val()) || 0;
				let btn = $('#btnSaveMaterial1');
				let warning = $('#cons_warning1');

				let inputVal = parseFloat($('#bdownqty').val()) || 0;
        let totqty = parseFloat($('#val_totqty_raw').val()) || 0;

				console.log('Validasi Qty:', totqty);
				console.log('totqty', totqty);

        let breakdownQty = inputVal;
        // if (inputVal > totqty) {
        //     breakdownQty = totqty;
        //     $('#bdownqty').val(totqty); 
            
        //     $('#bdownqty_warning').text('Nilai otomatis disesuaikan ke Maksimal Qty (' + totqty + ')').css('color', '#e74c3c');
        // } else {
        //     $('#bdownqty_warning').text('');
        // }


        let isPurchasingInvalid = purchasing > costing;
        if (isPurchasingInvalid) {
            warning.text('Purchasing consumption tidak boleh lebih besar dari costing!').css('color', '#e74c3c');
        } else {
            warning.text('');
        }

        if (isPurchasingInvalid) {
            btn.prop('disabled', true)
							.removeClass('btn-dark')
							.css({
								'background-color': '#95a5a6',
								'cursor': 'not-allowed',
								'border': 'none'
							});
        } else {
            btn.prop('disabled', false)
							.addClass('btn-dark')
							.css({
									'background-color': '#000000',
									'color': '#ffff',
									'cursor': 'pointer',
									'border': ''
							});
        }

				// if (purchasing > costing) {
				// 		// Keadaan Terkunci (Disabled)
				// 		btn.prop('disabled', true)
				// 			.css({
				// 					'background-color': '#95a5a6', // Abu-abu (Native)
				// 					'cursor': 'not-allowed',
				// 					'border': 'none'
				// 			});

				// 		warning.text('Purchasing consumption tidak boleh lebih besar dari costing!')
				// 					.css('color', '#e74c3c'); // Merah (Native)
				// } else {
				// 		// Keadaan Aktif (Enabled)
				// 		btn.prop('disabled', false)
				// 			.css({
				// 					'background-color': '#2c3e50', // Gelap (Native)
				// 					'cursor': 'pointer',
				// 					'border': 'none'
				// 			});

				// 		warning.text('');
				// }
		}

		function setFinalConsumption(finalCons, d) {
			let el = $('.text_finalcons');
			let unit = $('#unit').combobox('getText') || '';

			// 1. Pastikan input adalah angka yang valid (Sanitization)
			let fCons = parseFloat(finalCons) || 0; 
			let n = parseFloat(d) || 0;

			// 2. Format angka dengan proteksi Math.abs
			const format = (num) => new Intl.NumberFormat().format(Math.abs(num));

			// 3. Hitung persentase (Aman dari pembagian dengan nol)
			let percent = n !== 0 ? (fCons / n) * 100 : 0;

			let valText = format(fCons);
			let perNum = parseFloat(percent.toFixed(2));
			
			// 4. Tambahkan tanda + jika angka positif, atau biarkan jika 0/negatif
			let perText = `${perNum}`;

			el.text(`${valText} ${unit}/pcs (${perText}% from costing)`);

			// applyColor(el, fCons);
	}
	function setFinalConsumptionA(finalCons, d) {
			let el = $('.text_finalcons');
			let unit = $('#unit1').combobox('getText') || '';

			// 1. Pastikan input adalah angka yang valid (Sanitization)
			let fCons = parseFloat(finalCons) || 0; 
			let n = parseFloat(d) || 0;

			// 2. Format angka dengan proteksi Math.abs
			const format = (num) => new Intl.NumberFormat().format(Math.abs(num));

			// 3. Hitung persentase (Aman dari pembagian dengan nol)
			let percent = n !== 0 ? (fCons / n) * 100 : 0;

			let valText = format(fCons);
			let perNum = parseFloat(percent.toFixed(2));
			
			// 4. Tambahkan tanda + jika angka positif, atau biarkan jika 0/negatif
			let perText = `${perNum}`;

			el.text(`${valText} ${unit}/pcs (${perText}% from costing)`);

			// applyColor(el, fCons);
	}
	// function myFunction2b() {
	// 	var x = document.getElementById("bdownqty1a").value || 0;
	// 	var y = document.getElementById("allowcons1").value || 0;
	// 	var a = document.getElementById("qrs1").value || 0;
	// 	var b = document.getElementById("estcons1").value || 0;
	// 	var c = document.getElementById("allowman1").value || 0;
	// 	var d = document.getElementById("negocons1").value || 0;
	// 	var g = document.getElementById("formula1b").value;
	// 	var f1b = document.getElementById("f1b").value;
	// 	var f2b = document.getElementById("f2b").value;

	// 	var f1b = document.getElementById("f1b").value;
	// 	var f2b = document.getElementById("f2b").value;

	// 	/*var y2 = 0;*/
	// 	if (x == '') {
	// 		var x2 = 0;
	// 	} else {
	// 		var x2 = x;
	// 	}

	// 	if (a == '') {
	// 		var a2 = 0;
	// 	} else {
	// 		a2 = a;
	// 	}

	// 	if (y == '') {
	// 		var y2 = 0;
	// 	} else {
	// 		var y2 = y;
	// 	}

	// 	if (c == '') {
	// 		var c2 = 0;
	// 	} else {
	// 		var c2 = c;
	// 	}

	// 	if (d == '') {
	// 		var d2 = 0;
	// 	} else {
	// 		var d2 = d;
	// 	}

	// 	if (f1b) {
	// 			$.ajax({
	// 					type: "POST",
	// 					url: "view/get_rumus.php?bdownqty=" + x + "&estcons=" + b + "&formula1=" + g + "&f2b=" + f2b,
	// 					data: "f1b=" + f1b,
	// 					success: function(data) {
	// 							document.getElementById("totcons1").value = data;
	// 							var e2 = data || 0;
	// 							var f = d - b;
	// 							let allowqty = e * parseFloat(y) / 100;
	// 							document.getElementById("varcons1").value = f;

	// 							// Hitung Z (Total PO)
	// 							var z = parseFloat(e2) + (parseFloat(e2) * parseFloat(y) / 100) + parseFloat(a) + parseFloat(c);
								
	// 							document.getElementById("pocons1").value = z;
	// 							document.getElementById("pocons2b").value = Math.ceil(z);

	// 							// UPDATE LABEL SUMMARY DISINI
	// 							// Gunakan Math.ceil(z) agar sesuai dengan hasil pembulatan di input
	// 							$(".label_bqty_po").text(Math.ceil(z).toLocaleString()); 
	// 							$('.label_allowance_qty').text(allowqty.toLocaleString());
	// 					},
	// 			});
	// 	} else {
	// 			var e = x * b;
	// 			document.getElementById("totcons1").value = e;
	// 			var f = d - b;
	// 			document.getElementById("varcons1").value = f;

	// 			var z = parseFloat(e) + (parseFloat(e) * parseFloat(y) / 100) + parseFloat(a) + parseFloat(c);
	// 			let allowqty = e * parseFloat(y) / 100;
				
	// 			document.getElementById("pocons1").value = z;
	// 			document.getElementById("pocons2b").value = Math.ceil(z);

	// 			// UPDATE LABEL SUMMARY DISINI
	// 			$(".label_bqty_po").text(Math.ceil(z).toLocaleString());
	// 			$('.label_allowance_qty').text(allowqty.toLocaleString());
	// 	}
	// }
	/* Warna lookup bdown total qty 
	function cellStyler(value,row,index){
		if (value > 35){
			return 'background-color:#ffee00;color:red;';
		}
	}*/

	function myformatter2(date) {
		var y = date.getFullYear();
		var m = date.getMonth() + 1;
		var d = date.getDate();
		return y + '-' + (m < 10 ? ('0' + m) : m) + '-' + (d < 10 ? ('0' + d) : d);
	}

	function myparser2(s) {
		if (!s) return new Date();
		var ss = (s.split('-'));
		var y = parseInt(ss[0], 10);
		var m = parseInt(ss[1], 10);
		var d = parseInt(ss[2], 10);
		if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
			return new Date(y, m - 1, d);
		} else {
			return new Date();
		}
	}

	function count_row() {
		$('#myHeader').show();
		var count = $('#dg2').datagrid('getChecked').length;
		if (count) {
			if (count > 1) {
				$('#medit').hide();
				$('#count').css('margin-right', '825px');
			} else {
				$('#medit').show();
				$('#count').css('margin-right', '750px');
			}
			document.getElementById("count").innerHTML = count + " items selected";
			document.getElementById("totreq").value = count;
			document.getElementById("totreq2").value = count;
		} else {
			document.getElementById("count").innerHTML = 0 + " items selected";
		}
	}

	/*function tot1(){
		var totmat = JSON.stringify($('#dg2').datagrid('getData').total);
		if (totmat) {
		document.getElementById("count1").innerHTML = "All materials ("+totmat+")";
		}
	}*/

	/*function tot2(){
		var totmat = JSON.stringify($('#dg2').datagrid('getData').total);
		if (totmat) {
		document.getElementById("count2").innerHTML = "Worked on ("+totmat+")";
		}
	}*/

	//DROPDOWN
	function toggle(source) {
		checkboxes = document.getElementsByName('ck');
		for (var i = 0, n = 14; i < n; i++) {
			checkboxes[i].checked = source.checked;
		}
	}


	function cheka1() {
		var c1 = document.getElementById("chek1");
		if (c1.checked) {
			$('#dg2').datagrid('showColumn', 'item');
		} else {
			$('#dg2').datagrid('hideColumn', 'item');
		}
	}

	function cheka1b() {
		var c1b = document.getElementById("chek1b");
		if (c1b.checked) {
			$('#dg2').datagrid('showColumn', 'itemadd');
		} else {
			$('#dg2').datagrid('hideColumn', 'itemadd');
		}
	}

	function cheka2() {
		var c2 = document.getElementById("chek2");
		if (c2.checked) {
			$('#dg2').datagrid('showColumn', 'supnm2');
		} else {
			$('#dg2').datagrid('hideColumn', 'supnm2');
		}
	}

	function cheka3() {
		var c3 = document.getElementById("chek3");
		if (c3.checked) {
			$('#dg2').datagrid('showColumn', 'status');
		} else {
			$('#dg2').datagrid('hideColumn', 'status');
		}
	}

	function cheka3b() {
		var c3b = document.getElementById("chek3b");
		if (c3b.checked) {
			$('#dg2').datagrid('showColumn', 'ponoblue');
		} else {
			$('#dg2').datagrid('hideColumn', 'ponoblue');
		}
	}

	function cheka4() {
		var c4 = document.getElementById("chek4");
		if (c4.checked) {
			$('#dg2').datagrid('showColumn', 'spec');
		} else {
			$('#dg2').datagrid('hideColumn', 'spec');
		}
	}

	function cheka4b() {
		var c4b = document.getElementById("chek4b");
		if (c4b.checked) {
			$('#dg2').datagrid('showColumn', 'specadd');
		} else {
			$('#dg2').datagrid('hideColumn', 'specadd');
		}
	}

	function cheka5() {
		var c5 = document.getElementById("chek5");
		if (c5.checked) {
			$('#dg2').datagrid('showColumn', 'qty');
		} else {
			$('#dg2').datagrid('hideColumn', 'qty');
		}
	}

	function cheka5b() {
		var c5b = document.getElementById("chek5b");
		if (c5b.checked) {
			$('#dg2').datagrid('showColumn', 'pocons2');
		} else {
			$('#dg2').datagrid('hideColumn', 'pocons2');
		}
	}

	function cheka6() {
		var c6 = document.getElementById("chek6");
		if (c6.checked) {
			$('#dg2').datagrid('showColumn', 'unit');
		} else {
			$('#dg2').datagrid('hideColumn', 'unit');
		}
	}

	function cheka7() {
		var c7 = document.getElementById("chek7");
		if (c7.checked) {
			$('#dg2').datagrid('showColumn', 'colname');
		} else {
			$('#dg2').datagrid('hideColumn', 'colname');
		}
	}

	function cheka7b() {
		var c7b = document.getElementById("chek7b");
		if (c7b.checked) {
			$('#dg2').datagrid('showColumn', 'colcode');
		} else {
			$('#dg2').datagrid('hideColumn', 'colcode');
		}
	}

	function cheka8() {
		var c8 = document.getElementById("chek8");
		if (c8.checked) {
			$('#dg2').datagrid('showColumn', 'price');
		} else {
			$('#dg2').datagrid('hideColumn', 'price');
		}
	}

	function cheka9() {
		var c9 = document.getElementById("chek9");
		if (c9.checked) {
			$('#dg2').datagrid('showColumn', 'negocons');
		} else {
			$('#dg2').datagrid('hideColumn', 'negocons');
		}
	}

	function cheka10() {
		var c10 = document.getElementById("chek10");
		if (c10.checked) {
			$('#dg2').datagrid('showColumn', 'estcons');
		} else {
			$('#dg2').datagrid('hideColumn', 'estcons');
		}
	}

	function cheka11() {
		var c11 = document.getElementById("chek11");
		if (c11.checked) {
			$('#dg2').datagrid('showColumn', 'varcons');
		} else {
			$('#dg2').datagrid('hideColumn', 'varcons');
		}
	}

	function cheka12() {
		var c12 = document.getElementById("chek12");
		if (c12.checked) {
			$('#dg2').datagrid('showColumn', 'totcons');
		} else {
			$('#dg2').datagrid('hideColumn', 'totcons');
		}
	}

	function cheka13() {
		var c13 = document.getElementById("chek13");
		if (c13.checked) {
			$('#dg2').datagrid('showColumn', 'allowcons');
		} else {
			$('#dg2').datagrid('hideColumn', 'allowcons');
		}
	}

	function cheka14() {
		var c14 = document.getElementById("chek14");
		if (c14.checked) {
			$('#dg2').datagrid('showColumn', 'sizegar');
		} else {
			$('#dg2').datagrid('hideColumn', 'sizegar');
		}
	}

	/*filter*/
	function Search5() {
		$('#spec').datagrid('load', {
			carispl: $('#carispl').val()
		});
		$('#type').datagrid('load', {
			carispl: $('#carispl').val()
		});
		$('#color').datagrid('load', {
			carispl: $('#carispl').val()
		});
	}

	$(function() {
		$('#type').datagrid({
			onCheck: function(index, row, value) {
				$('#tabel1').css("margin-top", "60px");
				var ckk = $('#type').datagrid('getRows')[index].kelnm;
				document.getElementById("filtera" + index).value = ckk;
				document.getElementById("idxa" + index).value = index;
				document.getElementById("talla" + index).value = 1;
				$('#filtera' + index).show();
				$('#crossa' + index).show();
				$('#dg2').datagrid('load', {
					type0: $('#filtera0').val(),
					type1: $('#filtera1').val(),
					type2: $('#filtera2').val(),
					spec0: $('#filterb0').val(),
					spec1: $('#filterb1').val(),
					col0: $('#filterc0').val(),
					col1: $('#filterc1').val(),
					cari1: $('#cari1b').val(),
					cari2: $('#cari2b').val(),
					cari3: $('#cari3b').val(),
					cari6: $('#cari6b').val()
				});
				tall();
				var counta = JSON.stringify($('#dg2').datagrid('getData').total);
				document.getElementById("fltr2").innerHTML = counta + " result";
				$('#fltr1').show();
				$('#fltr2').show();
				$('#fltr3').show();
			},
			onUncheck: function(index, row, value) {
				var total = document.getElementById("total").value;
				if (total == 1) {
					reset();
				} else {
					document.getElementById("carispl").value = "";
					Search5();
					document.getElementById("filtera" + index).value = "";
					$('#filtera' + index).hide();
					$('#crossa' + index).hide();
					$('#dg2').datagrid('load', {
						type0: $('#filtera0').val(),
						type1: $('#filtera1').val(),
						type2: $('#filtera2').val(),
						spec0: $('#filterb0').val(),
						spec1: $('#filterb1').val(),
						col0: $('#filterc0').val(),
						col1: $('#filterc1').val(),
						cari1: $('#cari1b').val(),
						cari2: $('#cari2b').val(),
						cari3: $('#cari3b').val(),
						cari6: $('#cari6b').val()
					});
					document.getElementById("talla" + index).value = 0;
					tall();
					var counta = JSON.stringify($('#dg2').datagrid('getData').total);
					document.getElementById("fltr2").innerHTML = counta + " result";
					$('#fltr1').show();
					$('#fltr2').show();
					$('#fltr3').show();
				}
			}
		});
	});

	function uncektype2(cross) {
		var total = document.getElementById("total").value;
		if (total == 1) {
			reset();
		} else {
			var c = cross;
			//alert(c);
			var ca = document.getElementById("idxa" + c).value;
			$('#type').datagrid('unselectRow', ca);
			document.getElementById("carispl").value = "";
			Search5();
			document.getElementById("filtera" + c).value = "";
			document.getElementById("talla" + c).value = 0;
			$('#filtera' + c).hide();
			$('#crossa' + c).hide();
			$('#dg2').datagrid('load', {
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
				type2: $('#filtera2').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val(),
				cari6: $('#cari6b').val()
			});
			document.getElementById("idxa" + c).value = "";
		}
	}

	$(function() {
		$('#spec').datagrid({
			onCheck: function(index, row, value) {
				$('#tabel1').css("margin-top", "60px");
				var ckk = $('#spec').datagrid('getRows')[index].spec;
				document.getElementById("filterb" + index).value = ckk;
				$('#filterb' + index).show();
				$('#filterb' + index).show();
				$('#crossb' + index).show();
				$('#fltr1').show();
				$('#fltr2').show();
				$('#fltr3').show();
				document.getElementById("idxb" + index).value = index;
				document.getElementById("tallb" + index).value = 1;
				tall();
				$('#dg2').datagrid('load', {
					type0: $('#filtera0').val(),
					type1: $('#filtera1').val(),
					type2: $('#filtera2').val(),
					spec0: $('#filterb0').val(),
					spec1: $('#filterb1').val(),
					col0: $('#filterc0').val(),
					col1: $('#filterc1').val(),
					cari1: $('#cari1b').val(),
					cari2: $('#cari2b').val(),
					cari3: $('#cari3b').val(),
					cari6: $('#cari6b').val()
				});
				var counta = JSON.stringify($('#dg2').datagrid('getData').total);
				document.getElementById("fltr2").innerHTML = counta + " result";
			},
			onUncheck: function(index, row, value) {
				var total = document.getElementById("total").value;
				if (total == 1) {
					reset();
				} else {
					document.getElementById("carispl").value = "";
					Search5();
					document.getElementById("filterb" + index).value = "";
					$('#filterb' + index).hide();
					$('#crossb' + index).hide();
					$('#dg2').datagrid('load', {
						type0: $('#filtera0').val(),
						type1: $('#filtera1').val(),
						type2: $('#filtera2').val(),
						spec0: $('#filterb0').val(),
						spec1: $('#filterb1').val(),
						col0: $('#filterc0').val(),
						col1: $('#filterc1').val(),
						cari1: $('#cari1b').val(),
						cari2: $('#cari2b').val(),
						cari3: $('#cari3b').val(),
						cari6: $('#cari6b').val()
					});
					document.getElementById("tallb" + index).value = 0;
					tall();
					var counta = JSON.stringify($('#dg2').datagrid('getData').total);
					document.getElementById("fltr2").innerHTML = counta + " result";
					$('#fltr1').show();
					$('#fltr2').show();
					$('#fltr3').show();
				}
			}
		});
	});

	function uncekspec2(cross) {
		var total = document.getElementById("total").value;
		if (total == 1) {
			reset();
		} else {
			var c = cross;
			//alert(c);
			var ca = document.getElementById("idxb" + c).value;
			$('#spec').datagrid('unselectRow', ca);
			document.getElementById("carispl").value = "";
			Search5();
			document.getElementById("filterb" + c).value = "";
			document.getElementById("tallb" + c).value = 0;
			$('#filterb' + c).hide();
			$('#crossb' + c).hide();
			$('#dg2').datagrid('load', {
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
				type2: $('#filtera2').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val(),
				cari6: $('#cari6b').val()
			});
			document.getElementById("idxb" + c).value = "";
		}
	}

	$(function() {
		$('#color').datagrid({
			onCheck: function(index, row, value) {
				$('#tabel1').css("margin-top", "60px");
				var ckk = $('#color').datagrid('getRows')[index].colname;
				document.getElementById("filterc" + index).value = ckk;
				$('#filterc' + index).show();
				$('#filterc' + index).show();
				$('#crossc' + index).show();
				$('#fltr1').show();
				$('#fltr2').show();
				$('#fltr3').show();
				document.getElementById("idxc" + index).value = index;
				document.getElementById("tallc" + index).value = 1;
				tall();
				$('#dg2').datagrid('load', {
					type0: $('#filtera0').val(),
					type1: $('#filtera1').val(),
					type2: $('#filtera2').val(),
					spec0: $('#filterb0').val(),
					spec1: $('#filterb1').val(),
					col0: $('#filterc0').val(),
					col1: $('#filterc1').val(),
					cari1: $('#cari1b').val(),
					cari2: $('#cari2b').val(),
					cari3: $('#cari3b').val(),
					cari6: $('#cari6b').val()
				});
				var counta = JSON.stringify($('#dg2').datagrid('getData').total);
				document.getElementById("fltr2").innerHTML = counta + " result";
			},
			onUncheck: function(index, row, value) {
				var total = document.getElementById("total").value;
				if (total == 1) {
					reset();
				} else {
					document.getElementById("carispl").value = "";
					Search5();
					document.getElementById("filterc" + index).value = "";
					$('#filterc' + index).hide();
					$('#crossc' + index).hide();
					$('#dg2').datagrid('load', {
						type0: $('#filtera0').val(),
						type1: $('#filtera1').val(),
						type2: $('#filtera2').val(),
						spec0: $('#filterb0').val(),
						spec1: $('#filterb1').val(),
						col0: $('#filterc0').val(),
						col1: $('#filterc1').val(),
						cari1: $('#cari1b').val(),
						cari2: $('#cari2b').val(),
						cari3: $('#cari3b').val(),
						cari6: $('#cari6b').val()
					});
					document.getElementById("tallc" + index).value = 0;
					tall();
					var counta = JSON.stringify($('#dg2').datagrid('getData').total);
					document.getElementById("fltr2").innerHTML = counta + " result";
					$('#fltr1').show();
					$('#fltr2').show();
					$('#fltr3').show();
				}
			}
		});
	});

	function uncekcolor2(cross) {
		var total = document.getElementById("total").value;
		if (total == 1) {
			reset();
		} else {
			var c = cross;
			//alert(c);
			var ca = document.getElementById("idxc" + c).value;
			$('#color').datagrid('unselectRow', ca);
			document.getElementById("carispl").value = "";
			Search5();
			document.getElementById("filterc" + c).value = "";
			document.getElementById("tallc" + c).value = 0;
			$('#filterc' + c).hide();
			$('#crossc' + c).hide();
			$('#dg2').datagrid('load', {
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
				type2: $('#filtera2').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val(),
				cari6: $('#cari6b').val()
			});
			document.getElementById("idxc" + c).value = "";
		}
	}

	/*
	function cektype(){
	$('#tabel1').css("margin-top","60px");
	var ck = $('#type').datagrid('getChecked');
	for(var i=0; i<=1; i++){
	var row = $('#type').datagrid('getRows')[i];
	if ($.inArray(row,ck) >= 0){
		document.getElementById("filtera"+i).value = ck[i].kelnm;
					$('#filtera'+i).show();
					$('#crossa'+i).show();
	document.getElementById("talla"+i).value = 1;
	}
	if ($.inArray(row,ck) < 0){
		document.getElementById("filtera"+i).value ="";
					$('#filtera'+i).hide();
					$('#crossa'+i).hide();
	document.getElementById("talla"+i).value = 0;
	}
	}
	tall();
	$('#dg2').datagrid('load',{
	type0: $('#filtera0').val(),
	type1: $('#filtera1').val(),
	spec0: $('#filterb0').val(),
	spec1: $('#filterb1').val(),
	col0: $('#filterc0').val(),
	col1: $('#filterc1').val()
	});
	var total = document.getElementById("total").value;
	if(total==0){
	$('#tabel1').css("margin-top","");
	$('#fltr1').hide();
	$('#fltr2').hide();
	$('#fltr3').hide();
	} else {
	var counta= JSON.stringify($('#dg2').datagrid('getData').total);
	document.getElementById("fltr2").innerHTML = counta+" result";
	$('#fltr1').show();
	$('#fltr2').show();
	$('#fltr3').show();	
	}
	}
	
	function cekspec(){
	$('#tabel1').css("margin-top","60px");
	var ck = $('#spec').datagrid('getChecked');
	for(var i=0; i<=1; i++){
	var row = $('#spec').datagrid('getRows')[i];
	if ($.inArray(row,ck) >= 0){
		document.getElementById("filterb"+i).value = ck[i].spec;
					$('#filterb'+i).show();
					$('#crossb'+i).show();
	document.getElementById("tallb"+i).value = 1;
	}
	if ($.inArray(row,ck) < 0){
		document.getElementById("filterb"+i).value ="";
					$('#filterb'+i).hide();
					$('#crossb'+i).hide();
	document.getElementById("tallb"+i).value = 0;
	}
	}
	tall();
	$('#dg2').datagrid('load',{
	type0: $('#filtera0').val(),
	type1: $('#filtera1').val(),
	spec0: $('#filterb0').val(),
	spec1: $('#filterb1').val(),
	col0: $('#filterc0').val(),
	col1: $('#filterc1').val()
	});
	var total = document.getElementById("total").value;
	if(total==0){
	$('#tabel1').css("margin-top","");
	$('#fltr1').hide();
	$('#fltr2').hide();
	$('#fltr3').hide();
	} else {
	var counta= JSON.stringify($('#dg2').datagrid('getData').total);
	document.getElementById("fltr2").innerHTML = counta+" result";
	$('#fltr1').show();
	$('#fltr2').show();
	$('#fltr3').show();	
	}
	}
	
	function cekcol(){
	$('#tabel1').css("margin-top","60px");
	var ck = $('#color').datagrid('getChecked');
	for(var i=0; i<=1; i++){
	var row = $('#color').datagrid('getRows')[i];
	if ($.inArray(row,ck) >= 0){
		document.getElementById("filterc"+i).value = ck[i].colname;
					$('#filterc'+i).show();
					$('#crossc'+i).show();
	document.getElementById("tallc"+i).value = 1;
	}
	if ($.inArray(row,ck) < 0){
		document.getElementById("filterc"+i).value ="";
					$('#filterc'+i).hide();
					$('#crossc'+i).hide();
	document.getElementById("tallc"+i).value = 0;
	}
	}
	tall();
	$('#dg2').datagrid('load',{
	type0: $('#filtera0').val(),
	type1: $('#filtera1').val(),
	spec0: $('#filterb0').val(),
	spec1: $('#filterb1').val(),
	col0: $('#filterc0').val(),
	col1: $('#filterc1').val()
	});
	var total = document.getElementById("total").value;
	if(total==0){
	$('#tabel1').css("margin-top","");
	$('#fltr1').hide();
	$('#fltr2').hide();
	$('#fltr3').hide();
	} else {
	var counta= JSON.stringify($('#dg2').datagrid('getData').total);
	document.getElementById("fltr2").innerHTML = counta+" result";
	$('#fltr1').show();
	$('#fltr2').show();
	$('#fltr3').show();	
	}
	}
	  
	function unceka(cross){
	var total = document.getElementById("total").value;
	if (total==1) {
	reset();
	} else {
	var c = cross;
	$('#type').datagrid('unselectRow',c);
	
	document.getElementById("filtera"+c).value ="";
	$('#filtera'+c).hide();
	$('#crossa'+c).hide();
	document.getElementById("talla"+c).value = 0;
	
	tall();
	$('#dg2').datagrid('load',{
	type0: $('#filtera0').val(),
	type1: $('#filtera1').val(),
	spec0: $('#filterb0').val(),
	spec1: $('#filterb1').val(),
	col0: $('#filterc0').val(),
	col1: $('#filterc1').val()
	});
	var counta= JSON.stringify($('#dg2').datagrid('getData').total);
	document.getElementById("fltr2").innerHTML = counta+" result";
	$('#fltr1').show();
	$('#fltr2').show();
	$('#fltr3').show();
	}
	}
	
	function uncekb(cross){
	var total = document.getElementById("total").value;
	if (total==1) {
	reset();
	} else {
	var c = cross;
	$('#spec').datagrid('unselectRow',c);
	
	document.getElementById("filterb"+c).value ="";
	$('#filterb'+c).hide();
	$('#crossb'+c).hide();
	document.getElementById("tallb"+c).value = 0;
	
	tall();
	$('#dg2').datagrid('load',{
	type0: $('#filtera0').val(),
	type1: $('#filtera1').val(),
	spec0: $('#filterb0').val(),
	spec1: $('#filterb1').val(),
	col0: $('#filterc0').val(),
	col1: $('#filterc1').val()
	});
	var counta= JSON.stringify($('#dg2').datagrid('getData').total);
	document.getElementById("fltr2").innerHTML = counta+" result";
	$('#fltr1').show();
	$('#fltr2').show();
	$('#fltr3').show();
	}
	}
	
	function uncekc(cross){
	var total = document.getElementById("total").value;
	if (total==1) {
	reset();	
	} else {
	var c = cross;
	$('#color').datagrid('unselectRow',c);
	
	document.getElementById("filterc"+c).value ="";
	$('#filterc'+c).hide();
	$('#crossc'+c).hide();
	document.getElementById("tallc"+c).value = 0;
	
	tall();
	$('#dg2').datagrid('load',{
	type0: $('#filtera0').val(),
	type1: $('#filtera1').val(),
	spec0: $('#filterb0').val(),
	spec1: $('#filterb1').val(),
	col0: $('#filterc0').val(),
	col1: $('#filterc1').val()
	});
	var counta= JSON.stringify($('#dg2').datagrid('getData').total);
	document.getElementById("fltr2").innerHTML = counta+" result";
	$('#fltr1').show();
	$('#fltr2').show();
	$('#fltr3').show();
	}
	}*/

	function totrec() {
		var tcount = JSON.stringify($('#dg2').datagrid('getData').total);
		document.getElementById("fltr2").innerHTML = tcount + " result";
	}

	/*function myFunc(total, num) {
	return total - num;
	}*/

	function tall() {
		/*for(var i=0; i<=5; i++){
		const ck = [document.getElementById('tall'+i).value];
		var tall = ck;
		var tall = ck.reduce(myFunc);
		alert(ck);
		document.getElementById('tall').innerHTML = +ck;
		document.getElementById('fltr1').innerHTML = "Search filters("+ck.reduce(myFunc)+")";
		}*/
		var cka0 = document.getElementById("talla0").value;
		var cka1 = document.getElementById("talla1").value;
		var cka2 = document.getElementById("talla2").value;
		var ckb0 = document.getElementById("tallb0").value;
		var ckb1 = document.getElementById("tallb1").value;
		var ckc0 = document.getElementById("tallc0").value;
		var ckc1 = document.getElementById("tallc1").value;
		var tall = parseInt(cka0) + parseInt(cka1) + parseInt(cka2) + parseInt(ckb0) + parseInt(ckb1) + parseInt(ckc0) + parseInt(ckc1);
		//alert(tall);
		if (tall >= 1) {
			document.getElementById('total').value = tall;
			document.getElementById('fltr1').innerHTML = "Search filters(" + tall + ")";
		} else {
			document.getElementById('total').value = tall;
			document.getElementById('fltr1').innerHTML = "Search filters(0)";
		}
	}

	function reset() {
		//var total = document.getElementById("total").value;
		document.getElementById("carispl").value = "";
		Search5();
		document.getElementById('total').value = 0;
		$('#type').datagrid('clearSelections');
		$('#spec').datagrid('clearSelections');
		$('#color').datagrid('clearSelections');
		$('#tabel1').css("margin-top", "");
		$(".dropdown2-content").slideUp("fast");
		$('#fltr1').hide();
		$('#fltr2').hide();
		$('#fltr3').hide();
		for (var i = 0; i <= 2; i++) {
			$('#filtera' + i).hide();
			$('#crossa' + i).hide();
			document.getElementById('filtera' + i).value = '';
			document.getElementById('talla' + i).value = 0;

			$('#filterb' + i).hide();
			$('#crossb' + i).hide();
			document.getElementById('filterb' + i).value = '';
			document.getElementById('tallb' + i).value = 0;

			$('#filterc' + i).hide();
			$('#crossc' + i).hide();
			document.getElementById('filterc' + i).value = '';
			document.getElementById('tallc' + i).value = 0;

			$('#dg2').datagrid('load', {
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
				type2: $('#filtera2').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val(),
				cari6: $('#cari6b').val()
			});
		}
	}

	/*disheader*/
	function testku() {
		var dg = $('#spec');
		var dg2 = $('#type');
		var dg3 = $('#color');
		dg.datagrid();
		dg2.datagrid();
		dg3.datagrid();
		dg.datagrid('getPanel').find('div.datagrid-header').css('display', 'none');
		dg2.datagrid('getPanel').find('div.datagrid-header').css('display', 'none');
		dg3.datagrid('getPanel').find('div.datagrid-header').css('display', 'none');
		$('#spec').datagrid('getPanel').addClass('lines-no');
		$('#type').datagrid('getPanel').addClass('lines-no');
		$('#color').datagrid('getPanel').addClass('lines-no');
		$('#spec').datagrid('getPanel').addClass('lines-no2');
		$('#type').datagrid('getPanel').addClass('lines-no2');
		$('#color').datagrid('getPanel').addClass('lines-no2');
		$('#spec').datagrid('getPanel').addClass('col');
		$('#type').datagrid('getPanel').addClass('col');
		$('#color').datagrid('getPanel').addClass('col');
	}

	$.extend($.fn.datagrid.methods, {
		lockColumn: function(jq, field) {
			return jq.each(function() {
				var p = $('#kolom1').datagrid('getPanel'); // get the panel
				var cell = p.find('div.datagrid-header td[field=' + field + '] > div.datagrid-cell'); // get the cell
				cell.resizable({
					disabled: true
				}); // disable resize
			});
		}
	});

	function testku2() {
		$('#kolom1').datagrid('getPanel').addClass('col');
		$('#kolom1').datagrid('getPanel').addClass('lines-no');
		$('#kolom1').datagrid('getPanel').addClass('lines-no2');
		$('#kolom1').datagrid('lockColumn', 'kolomnm');
		//$('#kolom1').datagrid('getPanel').find('div.datagrid-header input[type=checkbox]').css('outline','2px solid deeppink');
	}

	function expand() {
		const togglePassword2a = document.querySelector("#togglePassword2a");
		const togglePassword2b = document.querySelector("#togglePassword2b");
		const togglePassword2c = document.querySelector("#togglePassword2c");

		togglePassword2a.addEventListener("click", function() {
			test1 = $('#test1').val();
			test2 = $('#test2').val();
			if (test1 == "" && test2 == "") {
				$('.tabela').hide();
				document.getElementById('test1').value = 1;
				$(".prodesa").css("margin-top", "-15px");
				$(".tabelb").css("margin-top", "-90px");
				$(".tabelc").css("margin-top", "10px");
			} else if (test1 == 1 && test2 == 1) {
				$(".tabelb").css("margin-top", "-45px");
				$(".tabelc").css("margin-top", "55px");
				$('.tabela').show();
				$(".prodesa").css("margin-top", "90px");
				document.getElementById('test1').value = "";
			} else if (test1 == "" && test2 == 1) {
				$('.tabela').hide();
				$(".prodesa").css("margin-top", "-15px");
				$(".tabelb").css("margin-top", "-70px");
				document.getElementById('test1').value = 1;
				$(".tabelc").css("margin-top", "-50px");
			} else if (test1 == 1 && test2 == "") {
				$('.tabela').show();
				$(".byr").css("margin-top", "20px");
				$(".prodesa").css("margin-top", "90px");
				$(".seasona").css("margin-top", "55px");
				$(".tabelb").css("margin-top", "15px");
				document.getElementById('test1').value = "";
				$(".tabelc").css("margin-top", "115px");
			} else {
				$('.tabela').show();
				document.getElementById('test1').value = "";
				$(".prodesa").css("margin-top", "25px");
				$(".tabelb").css("margin-top", "-40px");
				$(".tabelc").css("margin-top", "55px");
			}
			this.classList.toggle("bi-eye2");
		});

		togglePassword2b.addEventListener("click", function() {
			test1 = $('#test1').val();
			test2 = $('#test2').val();
			if (test1 == "" && test2 == "") {
				$('.tabelb').hide();
				document.getElementById('test2').value = 1;
				$(".prodesa").css("margin-top", "85px");
				$(".seasona").css("margin-top", "-5px");
				$(".tabelc").css("margin-top", "45px");
			} else if (test1 == 1 && test2 == 1) {
				$(".tabelc").css("margin-top", "25px");
				$('.tabelb').show();
				$(".seasona").css("margin-top", "65px");
				document.getElementById('test2').value = "";
			} else if (test1 == 1 && test2 == "") {
				$(".tabelb").css("margin-top", "-85px");
				$('.tabelb').hide();
				$(".seasona").css("margin-top", "-10px");
				document.getElementById('test2').value = 1;
				$(".tabelc").css("margin-top", "-60px");
			} else if (test1 == "" && test2 == 1) {
				$(".prodesa").css("margin-top", "85px");
				$(".tabelb").css("margin-top", "10px");
				$('.tabelb').show();
				$(".seasona").css("margin-top", "55px");
				document.getElementById('test2').value = "";
				$(".tabelc").css("margin-top", "105px");
			} else {
				$('.tabelb').show();
				document.getElementById('test2').value = "";
				$(".seasona").css("margin-top", "30px");
				$(".tabelc").css("margin-top", "55px");
			}
			this.classList.toggle("bi-eye2");
		});
		togglePassword2c.addEventListener("click", function() {
			$('.tabelc').toggle();
			this.classList.toggle("bi-eye2");
		});
	}

	function filterFunction() {
		var input, filter, ul, li, a, i;
		input = document.getElementById("cari6");
		filter = input.value.toUpperCase();
		div = document.getElementById("myDropdown2");
		a = div.getElementsByTagName("a");
		for (i = 0; i < a.length; i++) {
			txtValue = a[i].textContent || a[i].innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				a[i].style.display = "";
			} else {
				a[i].style.display = "none";
			}
		}
	}

	function tnew() {
		var tcount = JSON.stringify($('#dg2').datagrid('getData').total);
		document.getElementById("tmat").innerHTML = "(" + tcount + ")";
		$('#tmat').show();
		$('#tmat1').hide();
	}

	function gtrow() {
		var qty2 = document.getElementById("bdownqty1").value;

		var sz1 = document.getElementById("sz1").value;

		var bdwpk0 = document.getElementById("bdwpk").value;
		var klm0 = document.getElementById("klm").value;

		document.getElementById("canbd2").value = 0;
		document.getElementById("sizegar").value = sz1;
		document.getElementById("bdownqty").value = qty2;
		//document.getElementById("colname").value = col1;
		document.getElementById("bdownpk").value = bdwpk0;
		document.getElementById("kolom").value = klm0;

		document.getElementById("canbd").value = 0;
		document.getElementById("sizegar1").value = sz1;
		document.getElementById("bdownqty1a").value = qty2;
		//document.getElementById("colname").value = col1;
		document.getElementById("bdownpk1").value = bdwpk0;
		document.getElementById("kolom1").value = klm0;

		$('#sizegar').validatebox('validate');
    $('#sizegar1').validatebox('validate');

		$('#dialog-formv').dialog('close');
		$('#dialog-formg').dialog('close');

		myFunction2a();
		myFunction2b();
	}

	$(function() {
		$('#dg4g').datagrid({
			onClickCell: function(index, field, value) {
				//var row = $('#dg4g').edatagrid('getSelected');
				if (field == 's1') {
					//alert(value);
					/*lookup size*/
					//var v1=$('#dg4g').datagrid('getRows')[0].s1;
					//document.getElementById('sz1').value=v1;
					document.getElementById('col1').value = '';
					/*lookup qty*/
					var b1 = document.getElementById('s1a' + index).value;
					document.getElementById('bdownqty1').value = b1;
					/*bdownpk & kolom */
					document.getElementById('klm').value = field;
					var bdwpk1 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk1;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s1&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk1,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					/*warna kuning*/
					$('#s1a' + index).css('background-color', 'yellow');
				} else if (field == 's2') {
					//var v2=$('#dg4g').datagrid('getRows')[0].s2;
					//document.getElementById('sz1').value=v2;
					document.getElementById('col1').value = '';
					var b2 = document.getElementById('s2a' + index).value;
					document.getElementById('bdownqty1').value = b2;
					document.getElementById('klm').value = field;
					var bdwpk2 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk2;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s2&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk2,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s2a' + index).css('background-color', 'yellow');
				} else if (field == 's3') {
					//var v3=$('#dg4g').datagrid('getRows')[0].s3;
					//document.getElementById('sz1').value=v3;
					document.getElementById('col1').value = '';
					var b3 = document.getElementById('s3a' + index).value;
					document.getElementById('bdownqty1').value = b3;
					document.getElementById('klm').value = field;
					var bdwpk3 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk3;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s3&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk3,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s3a' + index).css('background-color', 'yellow');
				} else if (field == 's4') {
					//var v4=$('#dg4g').datagrid('getRows')[0].s4;
					//document.getElementById('sz1').value=v4;
					document.getElementById('col1').value = '';
					var b4 = document.getElementById('s4a' + index).value;
					document.getElementById('bdownqty1').value = b4;
					document.getElementById('klm').value = field;
					var bdwpk4 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk4;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s4&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk4,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s4a' + index).css('background-color', 'yellow');
				} else if (field == 's5') {
					//var v5=$('#dg4g').datagrid('getRows')[0].s5;
					//document.getElementById('sz1').value=v5;
					document.getElementById('col1').value = '';
					var b5 = document.getElementById('s5a' + index).value;
					document.getElementById('bdownqty1').value = b5;
					document.getElementById('klm').value = field;
					var bdwpk5 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk5;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s5&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk5,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s5a' + index).css('background-color', 'yellow');
				} else if (field == 's6') {
					//var v6=$('#dg4g').datagrid('getRows')[0].s6;
					//document.getElementById('sz1').value=v6;
					document.getElementById('col1').value = '';
					var b6 = document.getElementById('s6a' + index).value;
					document.getElementById('bdownqty1').value = b6;
					document.getElementById('klm').value = field;
					var bdwpk6 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk6;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s6&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk6,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s6a' + index).css('background-color', 'yellow');
				} else if (field == 's7') {
					//var v7=$('#dg4g').datagrid('getRows')[0].s7;
					//document.getElementById('sz1').value=v7;
					document.getElementById('col1').value = '';
					var b7 = document.getElementById('s7a' + index).value;
					document.getElementById('bdownqty1').value = b7;
					document.getElementById('klm').value = field;
					var bdwpk7 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk7;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s7&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk7,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s7a' + index).css('background-color', 'yellow');
				} else if (field == 's8') {
					//var v8=$('#dg4g').datagrid('getRows')[0].s8;
					//document.getElementById('sz1').value=v8;
					document.getElementById('col1').value = '';
					var b8 = document.getElementById('s8a' + index).value;
					document.getElementById('bdownqty1').value = b8;
					document.getElementById('klm').value = field;
					var bdwpk8 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk8;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s8&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk8,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s8a' + index).css('background-color', 'yellow');
				} else if (field == 's9') {
					//var v9=$('#dg4g').datagrid('getRows')[0].s9;
					//document.getElementById('sz1').value=v9;
					document.getElementById('col1').value = '';
					var b9 = document.getElementById('s9a' + index).value;
					document.getElementById('bdownqty1').value = b9;
					document.getElementById('klm').value = field;
					var bdwpk9 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk9;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s9&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk9,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s9a' + index).css('background-color', 'yellow');
				} else if (field == 's10') {
					//var v10=$('#dg4g').datagrid('getRows')[0].s10;
					//document.getElementById('sz1').value=v10;
					document.getElementById('col1').value = '';
					var b10 = document.getElementById('s10a' + index).value;
					document.getElementById('bdownqty1').value = b10;
					document.getElementById('klm').value = field;
					var bdwpk10 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk10;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s10&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk10,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s10a' + index).css('background-color', 'yellow');
				} else if (field == 's11') {
					//var v11=$('#dg4g').datagrid('getRows')[0].s11;
					//document.getElementById('sz1').value=v11;
					document.getElementById('col1').value = '';
					var b11 = document.getElementById('s11a' + index).value;
					document.getElementById('bdownqty1').value = b11;
					document.getElementById('klm').value = field;
					var bdwpk11 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk11;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s11&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk11,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s11a' + index).css('background-color', 'yellow');
				} else if (field == 's12') {
					//var v12=$('#dg4g').datagrid('getRows')[0].s12;
					//document.getElementById('sz1').value=v12;
					document.getElementById('col1').value = '';
					var b12 = document.getElementById('s12a' + index).value;
					document.getElementById('bdownqty1').value = b12;
					document.getElementById('klm').value = field;
					var bdwpk12 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk12;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s12&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk12,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s12a' + index).css('background-color', 'yellow');
				} else if (field == 's13') {
					//var v13=$('#dg4g').datagrid('getRows')[0].s13;
					//document.getElementById('sz1').value=v13;
					document.getElementById('col1').value = '';
					var b13 = document.getElementById('s13a' + index).value;
					document.getElementById('bdownqty1').value = b13;
					document.getElementById('klm').value = field;
					var bdwpk13 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk13;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s13&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk13,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s13a' + index).css('background-color', 'yellow');
				} else if (field == 's14') {
					//var v14=$('#dg4g').datagrid('getRows')[0].s14;
					//document.getElementById('sz1').value=v14;
					document.getElementById('col1').value = '';
					var b14 = document.getElementById('s14a' + index).value;
					document.getElementById('bdownqty1').value = b14;
					document.getElementById('klm').value = field;
					var bdwpk14 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk14;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s14&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk14,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s14a' + index).css('background-color', 'yellow');
				} else if (field == 's15') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b15 = document.getElementById('s15a' + index).value;
					document.getElementById('bdownqty1').value = b15;
					document.getElementById('klm').value = field;
					var bdwpk15 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk15;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s15&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk15,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s15a' + index).css('background-color', 'yellow');
				} else if (field == 's16') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b16 = document.getElementById('s16a' + index).value;
					document.getElementById('bdownqty1').value = b16;
					document.getElementById('klm').value = field;
					var bdwpk16 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk16;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s16&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk16,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s16a' + index).css('background-color', 'yellow');
				} else if (field == 's17') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b17 = document.getElementById('s17a' + index).value;
					document.getElementById('bdownqty1').value = b17;
					document.getElementById('klm').value = field;
					var bdwpk17 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk17;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s17&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk17,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s17a' + index).css('background-color', 'yellow');
				} else if (field == 's18') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b18 = document.getElementById('s18a' + index).value;
					document.getElementById('bdownqty1').value = b18;
					document.getElementById('klm').value = field;
					var bdwpk18 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk18;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s18&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk18,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s18a' + index).css('background-color', 'yellow');
				} else if (field == 's19') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b19 = document.getElementById('s19a' + index).value;
					document.getElementById('bdownqty1').value = b19;
					document.getElementById('klm').value = field;
					var bdwpk19 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk19;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s19&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk19,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s19a' + index).css('background-color', 'yellow');
				} else if (field == 's20') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b20 = document.getElementById('s20a' + index).value;
					document.getElementById('bdownqty1').value = b20;
					document.getElementById('klm').value = field;
					var bdwpk20 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk20;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s20&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk20,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s20a' + index).css('background-color', 'yellow');
				} else if (field == 's21') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b21 = document.getElementById('s21a' + index).value;
					document.getElementById('bdownqty1').value = b21;
					document.getElementById('klm').value = field;
					var bdwpk21 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk21;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s21&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk21,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s21a' + index).css('background-color', 'yellow');
				} else if (field == 's22') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b22 = document.getElementById('s22a' + index).value;
					document.getElementById('bdownqty1').value = b22;
					document.getElementById('klm').value = field;
					var bdwpk22 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk22;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s22&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk22,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s22a' + index).css('background-color', 'yellow');
				} else if (field == 's23') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b23 = document.getElementById('s23a' + index).value;
					document.getElementById('bdownqty1').value = b23;
					document.getElementById('klm').value = field;
					var bdwpk23 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk23;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s23&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk23,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s23a' + index).css('background-color', 'yellow');
				} else if (field == 's24') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b24 = document.getElementById('s24a' + index).value;
					document.getElementById('bdownqty1').value = b24;
					document.getElementById('klm').value = field;
					var bdwpk24 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk24;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s24&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk24,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s24a' + index).css('background-color', 'yellow');
				} else if (field == 's25') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b25 = document.getElementById('s25a' + index).value;
					document.getElementById('bdownqty1').value = b25;
					document.getElementById('klm').value = field;
					var bdwpk25 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk25;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s25&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk25,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s25a' + index).css('background-color', 'yellow');
				} else if (field == 's26') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b26 = document.getElementById('s26a' + index).value;
					document.getElementById('bdownqty1').value = b26;
					document.getElementById('klm').value = field;
					var bdwpk26 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk26;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s26&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk26,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s26a' + index).css('background-color', 'yellow');
				} else if (field == 's27') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b27 = document.getElementById('s27a' + index).value;
					document.getElementById('bdownqty1').value = b27;
					document.getElementById('klm').value = field;
					var bdwpk27 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk27;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s27&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk27,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s27a' + index).css('background-color', 'yellow');
				} else if (field == 's28') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b28 = document.getElementById('s28a' + index).value;
					document.getElementById('bdownqty1').value = b28;
					document.getElementById('klm').value = field;
					var bdwpk28 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk28;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s28&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk28,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s28a' + index).css('background-color', 'yellow');
				} else if (field == 's29') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b29 = document.getElementById('s29a' + index).value;
					document.getElementById('bdownqty1').value = b29;
					document.getElementById('klm').value = field;
					var bdwpk29 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk29;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s29&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk25,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s29a' + index).css('background-color', 'yellow');
				} else if (field == 's30') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b30 = document.getElementById('s30a' + index).value;
					document.getElementById('bdownqty1').value = b30;
					document.getElementById('klm').value = field;
					var bdwpk30 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk30;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s30&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk30,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s30a' + index).css('background-color', 'yellow');
				} else if (field == 's31') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b31 = document.getElementById('s31a' + index).value;
					document.getElementById('bdownqty1').value = b31;
					document.getElementById('klm').value = field;
					var bdwpk31 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk31;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s31&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk31,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s31a' + index).css('background-color', 'yellow');
				} else if (field == 's32') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b32 = document.getElementById('s32a' + index).value;
					document.getElementById('bdownqty1').value = b32;
					document.getElementById('klm').value = field;
					var bdwpk32 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk32;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s31&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk32,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s32a' + index).css('background-color', 'yellow');
				} else if (field == 's33') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b33 = document.getElementById('s33a' + index).value;
					document.getElementById('bdownqty1').value = b33;
					document.getElementById('klm').value = field;
					var bdwpk33 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk33;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s31&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk33,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s33a' + index).css('background-color', 'yellow');
				} else if (field == 's34') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b34 = document.getElementById('s34a' + index).value;
					document.getElementById('bdownqty1').value = b34;
					document.getElementById('klm').value = field;
					var bdwpk34 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk34;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s34&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk31,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s34a' + index).css('background-color', 'yellow');
				} else if (field == 's35') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b35 = document.getElementById('s35a' + index).value;
					document.getElementById('bdownqty1').value = b35;
					document.getElementById('klm').value = field;
					var bdwpk35 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk35;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s35&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk31,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s35a' + index).css('background-color', 'yellow');
				} else if (field == 's36') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b36 = document.getElementById('s36a' + index).value;
					document.getElementById('bdownqty1').value = b36;
					document.getElementById('klm').value = field;
					var bdwpk36 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk36;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s36&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk36,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s36a' + index).css('background-color', 'yellow');
				} else if (field == 's37') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b37 = document.getElementById('s37a' + index).value;
					document.getElementById('bdownqty1').value = b37;
					document.getElementById('klm').value = field;
					var bdwpk37 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk37;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s37&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk37,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s37a' + index).css('background-color', 'yellow');
				} else if (field == 's38') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b38 = document.getElementById('s38a' + index).value;
					document.getElementById('bdownqty1').value = b38;
					document.getElementById('klm').value = field;
					var bdwpk38 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk38;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s38&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk38,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s38a' + index).css('background-color', 'yellow');
				} else if (field == 's39') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b39 = document.getElementById('s39a' + index).value;
					document.getElementById('bdownqty1').value = b39;
					document.getElementById('klm').value = field;
					var bdwpk39 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk39;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s39&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk39,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s39a' + index).css('background-color', 'yellow');
				} else if (field == 's40') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b40 = document.getElementById('s40a' + index).value;
					document.getElementById('bdownqty1').value = b40;
					document.getElementById('klm').value = field;
					var bdwpk40 = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk40;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s40&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk40,
						success: function(data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s40a' + index).css('background-color', 'yellow');
				} else if (field == 'tot') {
					var t4 = $('#dg4g').datagrid('getRows')[index].color;
					document.getElementById('col1').value = t4;
					document.getElementById('sz1').value = '';
					var totb = document.getElementById('tota' + index).value;
					document.getElementById('bdownqty1').value = totb;
					document.getElementById('klm').value = field;
					var bdwpkt = $('#dg4g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpkt;
					$('#tota' + index).css('background-color', 'yellow');
				} else {
					// alert('No Selected Value...!!');
					document.getElementById("bdownqty1").value = '';
					document.getElementById("sz1").value = '';
					document.getElementById("col1").value = '';
					document.getElementById("bdwpk").value = '';
					document.getElementById("klm").value = '';
				}
			}
		});
	});

	function test() {
		var q = $('#dg4g').datagrid('getSelected').br;
		for (r = 0; r <= q - 1; r++) {
			$('#s1a' + r).css('background-color', '');
			$('#s2a' + r).css('background-color', '');
			$('#s3a' + r).css('background-color', '');
			$('#s4a' + r).css('background-color', '');
			$('#s5a' + r).css('background-color', '');
			$('#s6a' + r).css('background-color', '');
			$('#s7a' + r).css('background-color', '');
			$('#s8a' + r).css('background-color', '');
			$('#s9a' + r).css('background-color', '');
			$('#s10a' + r).css('background-color', '');
			$('#s11a' + r).css('background-color', '');
			$('#s12a' + r).css('background-color', '');
			$('#s13a' + r).css('background-color', '');
			$('#s14a' + r).css('background-color', '');
			$('#s15a' + r).css('background-color', '');
			$('#s16a' + r).css('background-color', '');
			$('#s17a' + r).css('background-color', '');
			$('#s18a' + r).css('background-color', '');
			$('#s19a' + r).css('background-color', '');
			$('#s20a' + r).css('background-color', '');
			$('#s21a' + r).css('background-color', '');
			$('#s22a' + r).css('background-color', '');
			$('#s23a' + r).css('background-color', '');
			$('#s24a' + r).css('background-color', '');
			$('#s25a' + r).css('background-color', '');
			$('#s26a' + r).css('background-color', '');
			$('#s27a' + r).css('background-color', '');
			$('#s28a' + r).css('background-color', '');
			$('#s29a' + r).css('background-color', '');
			$('#s30a' + r).css('background-color', '');
			$('#s31a' + r).css('background-color', '');
			$('#s32a' + r).css('background-color', '');
			$('#s33a' + r).css('background-color', '');
			$('#s34a' + r).css('background-color', '');
			$('#s35a' + r).css('background-color', '');
			$('#s36a' + r).css('background-color', '');
			$('#s37a' + r).css('background-color', '');
			$('#s38a' + r).css('background-color', '');
			$('#s39a' + r).css('background-color', '');
			$('#s40a' + r).css('background-color', '');
			$('#tota' + r).css('background-color', '');
		}
	}

	function formatPrice(val, row) {
		if (val < 20) {
			return '<span style="color:red;">(' + val + ')</span>';
		} else {
			return val;
		}
	}

	function multi() {
		var item = document.getElementById("item").value;
		if (item.match(/Zipper.*/)) {
			document.getElementById('hspec1').value = "TAPE";
			document.getElementById('hspec2').value = "TEETH";
			document.getElementById('hspec3').value = "SLIDER";
			document.getElementById('hspec4').value = "PULLER";
			document.getElementById('hspec5').value = "STOPPER";
			document.getElementById('hspec6').value = "SIZE/LENGTH";
		} else if (item.match(/ZIPPER.*/)) {
			document.getElementById('hspec1').value = "TAPE";
			document.getElementById('hspec2').value = "TEETH";
			document.getElementById('hspec3').value = "SLIDER";
			document.getElementById('hspec4').value = "PULLER";
			document.getElementById('hspec5').value = "STOPPER";
			document.getElementById('hspec6').value = "SIZE/LENGTH";
		} else if (item.match(/zipper.*/)) {
			document.getElementById('hspec1').value = "TAPE";
			document.getElementById('hspec2').value = "TEETH";
			document.getElementById('hspec3').value = "SLIDER";
			document.getElementById('hspec4').value = "PULLER";
			document.getElementById('hspec5').value = "STOPPER";
			document.getElementById('hspec6').value = "SIZE/LENGTH";
		} else {
			var h1 = $('#h1').val();
			var h2 = $('#h2').val();
			var h3 = $('#h3').val();
			var h4 = $('#h4').val();
			var h5 = $('#h5').val();
			var h6 = $('#h6').val();

			document.getElementById('hspec1').value = h1;
			document.getElementById('hspec2').value = h2;
			document.getElementById('hspec3').value = h3;
			document.getElementById('hspec4').value = h4;
			document.getElementById('hspec5').value = h5;
			document.getElementById('hspec6').value = h6;
		}
	}

	function multi1() {
		var item1 = document.getElementById("item1").value;
		if (item1.match(/Zipper.*/)) {
			// $('#hidden1').show();
			document.getElementById('hspec1b').value = "TAPE";
			document.getElementById('hspec2b').value = "TEETH";
			document.getElementById('hspec3b').value = "SLIDER";
			document.getElementById('hspec4b').value = "PULLER";
			document.getElementById('hspec5b').value = "STOPPER";
			document.getElementById('hspec6b').value = "SIZE/LENGTH";
		} else if (item1.match(/ZIPPER.*/)) {
			// $('#hidden1').show();
			document.getElementById('hspec1b').value = "TAPE";
			document.getElementById('hspec2b').value = "TEETH";
			document.getElementById('hspec3b').value = "SLIDER";
			document.getElementById('hspec4b').value = "PULLER";
			document.getElementById('hspec5b').value = "STOPPER";
			document.getElementById('hspec6b').value = "SIZE/LENGTH";
		} else if (item1.match(/zipper.*/)) {
			// $('#hidden1').show();
			document.getElementById('hspec1b').value = "TAPE";
			document.getElementById('hspec2b').value = "TEETH";
			document.getElementById('hspec3b').value = "SLIDER";
			document.getElementById('hspec4b').value = "PULLER";
			document.getElementById('hspec5b').value = "STOPPER";
			document.getElementById('hspec6b').value = "SIZE/LENGTH";
		} else {
			// $('#hidden1').hide();
			document.getElementById('hspec1b').value = "";
			document.getElementById('hspec2b').value = "";
			document.getElementById('hspec3b').value = "";
			document.getElementById('hspec4b').value = "";
			document.getElementById('hspec5b').value = "";
			document.getElementById('hspec6b').value = "";
		}
	}

	$(function() {
		$('#all').click(function(event) {
			if (this.checked) {
				// Iterate each checkbox
				$('#ceek1').prop('checked', true);
				$('#ceek2').prop('checked', true);
				$('#ceek3').prop('checked', true);
				$('#ceek4').prop('checked', true);
				$('#ceek5').prop('checked', true);
				$('#ceek6').prop('checked', true);
				$('#ceek7').prop('checked', true);
				$('#ceek8').prop('checked', true);
				$('.button-request-po').css('background-color', '#000000');
			} else {
				$('#ceek1').prop('checked', false);
				$('#ceek2').prop('checked', false);
				$('#ceek3').prop('checked', false);
				$('#ceek4').prop('checked', false);
				$('#ceek5').prop('checked', false);
				$('#ceek6').prop('checked', false);
				$('#ceek7').prop('checked', false);
				$('#ceek8').prop('checked', false);
				$('.button-request-po').css('background-color', '#BDBDBD');
			}
		});
	});

	function cheek() {
		var ceek1 = document.getElementById('ceek1');
		var ceek2 = document.getElementById('ceek2');
		var ceek3 = document.getElementById('ceek3');
		var ceek4 = document.getElementById('ceek4');
		var ceek5 = document.getElementById('ceek5');
		var ceek6 = document.getElementById('ceek6');
		var ceek7 = document.getElementById('ceek7');
		var ceek8 = document.getElementById('ceek8');
		if (ceek1.checked || ceek2.checked || ceek3.checked || ceek4.checked || ceek5.checked || ceek6.checked || ceek7.checked || ceek8.checked) {
			$('.button-request-po').css('background-color', '#000000');
		} else {
			$('.button-request-po').css('background-color', '#BDBDBD');
		}
	}

	function prosespo() {
		$('#dialog-formpo').dialog('open').dialog('setTitle', '');
	}

	function cancelpo() {
		$('#dialog-formpo').dialog('close');
	}

	function prosespo1() {
		$('#dialog-formpo1').dialog('open').dialog('setTitle', '');
	}

	function cancelpo1() {
		$('#dialog-formpo1').dialog('close');
	}

	function savepo() {
		//$('#dialog-formpo').dialog('close');
		var string = $("#formpo").serialize();
		$('#formpo').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=prosespo&ordpk=<?php echo $ord; ?>",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 393,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-formpo').dialog('close');
				$('#formpo').form('reset');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
				$('#dg2').datagrid('clearSelections');
				$('#dg2').datagrid('clearChecked');
			}
		});
	}

	function savepo1() {
		//$('#dialog-formpo').dialog('close');
		var string = $("#formpo1").serialize();
		$('#formpo1').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=prosespo1&ordpk=<?php echo $ord; ?>",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 395,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-formpo1').dialog('close');
				$('#formpo1').form('reset');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
				$('#dg2').datagrid('clearSelections');
				$('#dg2').datagrid('clearChecked');
			}
		});
	}

	/*function savepo(){
	var string = $("#formpo").serialize();
		 $('#formpo').form('submit',{
	  type	: "POST",
			url	: "action/simpan.php?x=prosespo&ordpk=<?php //echo $ord; 
															?>",
		data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
		success: function(data) {
			$.messager.show({
				title: '',
				msg: data,
				timeout: 3000,
				showType: 'slide',
				icon: 'info',
				width: 395,
				height: 57,
				style: {
					left: 0,
					right: '',
					top: '',
					bottom: -document.body.scrollTop - document.documentElement.scrollTop
				}
			});
			$('#dialog-formpo').dialog('close');
			$('#formpo').form('reset');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
	/*$('#dg2').datagrid('reload');
	}
 });
}*/

	function cancelpo2() {
		//$('#dialog-formpo2').dialog('close');
		var string = $("#formpo2").serialize();
		$('#formpo2').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=canreqpo",
			data: string,
			onSubmit: function() {
				//   return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 252,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-formpo2').dialog('close');
				$('#formpo2').form('reset');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
				$('#dg2').datagrid('clearSelections');
				$('#dg2').datagrid('clearChecked');
			}
		});
	}

	function savepo2() {
		//$('#dialog-formpo').dialog('close');
		var string = $("#formpo2").serialize();
		$('#formpo2').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=savereqpo",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 390,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-formpo2').dialog('close');
				$('#formpo2').form('reset');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
				$('#dg2').datagrid('clearSelections');
				$('#dg2').datagrid('clearChecked');
			}
		});
	}

	function savereqpo2a() {
		//$('#dialog-formpo2').dialog('close');
		// var string = $("#formpo2b").serialize();
		// 	 $('#formpo2b').form('submit',{
		var string = $("#formdel").serialize();
		$('#formdel').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=savereqpo2a",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 290,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-formpo2b').dialog('close');
				$('#formpo2b').form('reset');
				$('#dialog-formdel').dialog('close');
				$('#formdel').form('reset');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
				$('#dg2').datagrid('clearSelections');
				$('#dg2').datagrid('clearChecked');
				over1();
				over2();
				sumpo();
				sumreq();
				cost1();
				cost2();
			}
		});
	}

	function savereqpo2aa() {
		//$('#dialog-formpo2').dialog('close');
		var string = $("#formpo2b").serialize();
		$('#formpo2b').form('submit', {
			// var string = $("#formdel").serialize();
			// $('#formdel').form('submit',{
			type: "POST",
			url: "action/simpan.php?x=savereqpo2aa",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 290,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-formpo2b').dialog('close');
				$('#formpo2b').form('reset');
				$('#dialog-formdel2').dialog('close');
				$('#formdel2').form('reset');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
				$('#dg2').datagrid('clearSelections');
				$('#dg2').datagrid('clearChecked');
				over1();
				over2();
				sumpo();
				sumreq();
				cost1();
				cost2();
			}
		});
	}

	function savereqpo2() {
		//$('#dialog-formpo').dialog('close');
		var string = $("#formpo2b").serialize();
		$('#formpo2b').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=savereqpo2",
			data: string,
			onSubmit: function() {
				return $(this).form('validate');
			},
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 390,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dialog-formpo2b').dialog('close');
				$('#formpo2b').form('reset');
				$('#dialog-formdel2').dialog('close');
				$('#formdel2').form('reset');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg2').datagrid('reload');
				$('#dg2').datagrid('clearSelections');
				$('#dg2').datagrid('clearChecked');
			}
		});
	}

	function sup1() {
		//var ckk=$('#progres').datagrid('getRows')[index].progresnm;
		var ext1 = $('#ext1').val();
		var ck1 = $('#external1').val();
		//alert(ext1);
		if (ext1 == "") {
			$('#suppk1a').hide();
			$('#suppk1b').show();
			$('#suppk1bb').combobox('select', ck1);
			$('#suppk1aa').combobox('select', ck1);
			var suppk = $('#suppk1bb').val();
			document.getElementById('ext1').value = suppk;
			//if(suppk=="1949"){
			//document.getElementById('ext1').value = "";
			//} else {
			//document.getElementById('ext1').value = suppk;
			//}
		} else {
			$('#suppk1a').show();
			$('#suppk1b').hide();
			//$('#suppk1aa').combobox('select', ext1);
			////var suppk = $('#suppk1aa').val();
			document.getElementById('ext1').value = "";
		}
	}

	function sup1b() {
		$('#suppk1a').show();
		$('#suppk1b').hide();
		document.getElementById('ext1').value = "";
		var suggestionsContainer = document.getElementById("suggestions-container1");
		suggestionsContainer.innerHTML = "";
	}

	// function sup2() {
	// 	//$('#external2b').hide();
	// 	//$('#external2').show();
	// 	//var ckk=$('#progres').datagrid('getRows')[index].progresnm;
	// 	var ext2 = $('#ext2').val();
	// 	var ck2 = $('#external2').val();
	// 	//var ck2b = $('#external2b').val();
	// 	//alert(suppk);
	// 	if (ext2 == "") {
	// 		$('#suppk2a').hide();
	// 		$('#suppk2b').show();
	// 		$('#suppk2bb').combobox('select', ck2);
	// 		var suppk = $('#suppk2aa').val();
	// 		var suppkb = $('#suppk2bb').val();
	// 		document.getElementById('ext2').value = suppk;
	// 		document.getElementById('ext2b').value = suppkb;
	// 	} else {
	// 		$('#suppk2a').show();
	// 		$('#suppk2b').hide();
	// 		$('#suppk2aa').combobox('select', ext2);
	// 		//var suppk = $('#suppk1aa').val();
	// 		document.getElementById('ext2').value = "";
	// 		document.getElementById('ext2b').value = "";
	// 	}
	// }
	// Fungsi ini hanya menangani tampilan dan seleksi combobox
function handleExternalVisuals(isExternal, value) {
    if (isExternal) {
        $('#suppk2a').hide();
        $('#suppk2b').show(); // Tampilkan yang disabled
        $('#suppk2bb').combobox('select', '1949');
        $('#suppk2aa').combobox('select', '1949');
        $('#ext2').val('1949');
    } else {
        $('#suppk2a').show();
        $('#suppk2b').hide();
        // Jika value ada (saat edit), pilih value tersebut, jika tidak (saat baru), clear.
        if(value && value != "1949") {
            $('#suppk2aa').combobox('select', value);
        } else {
            $('#suppk2aa').combobox('clear');
        }
        $('#ext2').val('');
    }
}

// Fungsi yang dipanggil onclick di HTML
function sup2() {
    var isChecked = $('#external2').is(':checked');
    handleExternalVisuals(isChecked, null);
}

	function sup2b() {
		$('#suppk2a').show();
		$('#suppk2b').hide();
		document.getElementById('ext2').value = "";
		document.getElementById('ext2b').value = "";
		var suggestionsContainer = document.getElementById("suggestions-container");
		suggestionsContainer.innerHTML = "";
	}

	// function routeship(){
	// 	$('#dginf').datagrid({
	// 	onClickCell: function(index,field,value){
	// 	var row = $(this).datagrid('getRows')[index];
	// 	document.getElementById('importshipa').value=row.importpk;

	// 	document.getElementById('buatkondisi').value = 1;
	// 	var popkship = document.getElementById('popkship').value;
	// 	var rkbpki2 = document.getElementById('rkbpki2').value;

	// 	// document.getElementById('importpkship').value=row.importpk;

	// 	document.getElementById('popkb2').value= popkship;
	// 	document.getElementById('rkbpki2').value=rkbpki2;
	// 	// document.getElementById('importpkshipa').value=importpkship;

	// 	// // document.getElementById('supnm2').value=row.supnm2;
	// 	// // alert(row.popk);
	// 	// alert('masuk routeship')
	// 	$('#dg2c2').datagrid('load', {
	// 		importpkb: $('#importshipa').val()
	// 	});
	// 	$('#dialog-enroute2').dialog('open').dialog('setTitle','');

	// 	$.ajax({
	// 	type:"POST",
	// 	url:"view/get_data.php?x=vasnm2",
	// 	data:"popk="+popkship,
	// 	success:function(data){
	// 	let text = data;
	// 	const arr = text.split(",");
	// 	// alert(data);
	// 	document.getElementById('typenm2').value=arr[0];
	// 	document.getElementById('vassalnm2').value=arr[1];
	// 	document.getElementById('bill2').value=arr[2];
	// 	document.getElementById('arrival2').value=arr[3];
	// 	document.getElementById('port2').value=arr[4];

	// 	document.getElementById('gw2').value=arr[5];
	// 	document.getElementById('dp2').value=arr[6];
	// 	document.getElementById('dl2').value=arr[7];
	// 	document.getElementById('dt2').value=arr[8];
	// 	document.getElementById('amount2').value=arr[9];

	// 	document.getElementById('etd222').value=arr[10];
	// 	document.getElementById('eta222').value=arr[11];
	// 	document.getElementById('eih222').value=arr[12];

	// 	document.getElementById('importpkb2').value=arr[13];
	// 	// document.getElementById('supnm').value=arr[14];
	// 	},
	// 	});
	// }
	// 	});
	// }


	// function routeship2(){
	// 	$('#dginf2').datagrid({
	// 	onClickCell: function(index,field,value){
	// 	var row = $(this).datagrid('getRows')[index];
	// 	document.getElementById('importshipa1').value=row.importpk;

	// 	document.getElementById('buatkondisi').value = 1;
	// 	var popkship = document.getElementById('popkship').value;
	// 	var rkbpki2 = document.getElementById('rkbpki2').value;

	// 	// document.getElementById('importpkship').value=row.importpk;

	// 	document.getElementById('popkb2').value= popkship;
	// 	document.getElementById('rkbpki2').value=rkbpki2;
	// 	// document.getElementById('importpkshipa').value=importpkship;

	// 	// // document.getElementById('supnm2').value=row.supnm2;
	// 	// // alert(row.popk);
	// 	// alert('masuk routeship')
	// 	$('#dg2c2').datagrid('load', {
	// 		importpkb: $('#importshipa1').val()
	// 	});
	// 	$('#dialog-enroute2').dialog('open').dialog('setTitle','');

	// 	$.ajax({
	// 	type:"POST",
	// 	url:"view/get_data.php?x=vasnm2",
	// 	data:"popk="+popkship,
	// 	success:function(data){
	// 	let text = data;
	// 	const arr = text.split(",");
	// 	// alert(data);
	// 	document.getElementById('typenm2').value=arr[0];
	// 	document.getElementById('vassalnm2').value=arr[1];
	// 	document.getElementById('bill2').value=arr[2];
	// 	document.getElementById('arrival2').value=arr[3];
	// 	document.getElementById('port2').value=arr[4];

	// 	document.getElementById('gw2').value=arr[5];
	// 	document.getElementById('dp2').value=arr[6];
	// 	document.getElementById('dl2').value=arr[7];
	// 	document.getElementById('dt2').value=arr[8];
	// 	document.getElementById('amount2').value=arr[9];

	// 	document.getElementById('etd222').value=arr[10];
	// 	document.getElementById('eta222').value=arr[11];
	// 	document.getElementById('eih222').value=arr[12];

	// 	document.getElementById('importpkb2').value=arr[13];
	// 	// document.getElementById('supnm').value=arr[14];
	// 	},
	// 	});
	// }
	// 	});
	// }

	// function carilog() {
	//       $('#dg2c').datagrid('load', {
	//         importpkb: $('#importpkb').val()
	//       });
	//     }

	function info(popk, rkbpk) {
		// alert(rkbpk);
		document.getElementById('ponoi').value = popk;
		document.getElementById('rkbpki').value = rkbpk;
		$('#dialog-forminfo').dialog('open').dialog('setTitle', '');
		$('#dginf').datagrid('load', 'view/get_infolpb.php?popk=' + popk + '&rkbpk=' + rkbpk);
		// $('#dginf').datagrid('load',{
		// popk: $('#ponoi').val(),
		// rkbpk: $('#rkbpki').val()
		// });
		$.ajax({
			type: "POST",
			url: "view/get_infolpbb.php?popk=" + popk,
			data: "rkbpk=" + rkbpk,
			success: function(data) {
				document.getElementById('qtyinfo').innerHTML = data;
			},
		});
	}

	function formatter1(value, rows) {
		if (value == "1") {
			return '<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid rgba(25, 183, 21, 1);color:#FFFFFF;background-color: rgba(25, 183, 21, 1);cursor:pointer" onclick="info(' + rows.popk + ',' + rows.rkbpk + ');">' + rows.stsb + '</span>';
		} else if (value == "2") {
			return '<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid rgba(25, 183, 21, 1);color:#FFFFFF;background-color: rgba(25, 183, 21, 1);cursor:pointer" onclick="info(' + rows.popk + ',' + rows.rkbpk + ');">' + rows.stsb + '</span>';
		} else if (value == "3") {
			return '<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#359DD9;cursor:pointer" onclick="info(' + rows.popk + ',' + rows.rkbpk + ');">' + rows.stsb + '</span>';
		} else if (value == "4") {
			return '<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#EF3B42;cursor:pointer" onclick="info(' + rows.popk + ',' + rows.rkbpk + ');">' + rows.stsb + '</span>';
		} else {
			return value;
		}
	}

	function dtlimport(popkship, importpk) {
		//  alert(importpk);
		$('#dialog-enroute2').dialog('open').dialog('setTitle', '');
		$('#dg2c').datagrid('load', {
			importpkb: importpk
		});
		$.ajax({
			type: "POST",
			url: "view/get_data.php?x=vasnm2",
			data: "popk=" + popkship,
			success: function(data) {
				let text = data;
				const arr = text.split(",");
				// alert(data);
				document.getElementById('typenm2').value = arr[0];
				document.getElementById('vassalnm2').value = arr[1];
				document.getElementById('bill2').value = arr[2];
				document.getElementById('arrival2').value = arr[3];
				document.getElementById('port2').value = arr[4];

				document.getElementById('gw2').value = arr[5];
				document.getElementById('dp2').value = arr[6];
				document.getElementById('dl2').value = arr[7];
				document.getElementById('dt2').value = arr[8];
				document.getElementById('amount2').value = arr[9];

				document.getElementById('etd222').value = arr[10];
				document.getElementById('eta222').value = arr[11];
				document.getElementById('eih222').value = arr[12];

				document.getElementById('importpkb2').value = arr[13];
				// document.getElementById('supnm').value=arr[14];
			},
		});
	}

	function formatter2(value, row) {
		if (row.vassalnm == "N/A") {
			return value;
		} else {
			return '<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(53, 157, 217, 1);cursor:pointer;" onclick="dtlimport(' + row.popk + ',' + row.importpk + ')">' + value + '</span>'

		}
	}

	function canbdown() {
		document.getElementById('canbd').value = 1;
	}

	function canbdown2() {
		document.getElementById('canbd2').value = 1;
	}

	function updateItem() {
		var selectedItem = document.getElementById('nilai_usage').value;
		var selectedItem_edit = document.getElementById('nilai_usage2').value;

		document.getElementById('input_hidden_usage').value = selectedItem;
		document.getElementById('input_hidden_usage_edit').value = selectedItem_edit;
	}

	function klnm_value() {
		var klnm_value_selected = $('#mtype').combobox('getValue');

		$.ajax({
			type: "POST",
			url: "view/get_data.php?x=mtype2",
			data: "id="+klnm_value_selected,
			success: function(data) {
			if (data == "1") {
			$('#div_input_usage').show();
			$('#div_input_cw1').show();
			$('#div_input_gsm1').show();
			} else {
			$('#div_input_usage').hide();
			$('#div_input_cw1').hide();
			$('#div_input_gsm1').hide();
			}
			},
		});
	}

	function klnm_value_edit() {
		var klnm_value_selected = $('#mtype_edit').combobox('getValue');

		$.ajax({
			type: "POST",
			url: "view/get_data.php?x=mtype2",
			data: "id="+klnm_value_selected,
			success: function(data) {
			if (data == "1") {
			$('#div_input_usage2').show();
			$('#div_input_cw').show();
			$('#div_input_gsm').show();
			} else {
			$('#div_input_usage2').hide();
			$('#div_input_cw').hide();
			$('#div_input_gsm').hide();
			}
			},
		});
	}

// 	$(function(){
// 	const $cb = $('#mtype');

// 	$cb.combobox({
// 		valueField: 'mtypepk',
// 		textField: 'typenm',
// 		mode: 'remote',
// 		url: 'view/get_data.php?dt=mtype',
// 		editable: true,
// 		limitToList: true,
// 		filter: function(q, row){
// 			return row.typenm.toLowerCase().includes(q.toLowerCase());
// 		},
// 		onLoadSuccess: function(data){
// 			$cb.data('originalData', data); // simpan data asli
// 		},
// 		onChange: function(newVal, oldVal){
// 			if (newVal === '__no_result__') {
// 				$cb.combobox('clear');
// 			}
// 		}
// 	});

// 	// Tangani filter manual saat mengetik di textbox
// 	$cb.combobox('textbox').on('input', function(){
// 		let query = $(this).val().toLowerCase();
// 		let originalData = $cb.data('originalData') || [];

// 		let filtered = originalData.filter(row =>
// 			row.typenm.toLowerCase().includes(query)
// 		);

// 		if (query.length && filtered.length === 0) {
// 			$cb.combobox('loadData', [{
// 				mtypepk: '__no_result__',
// 				typenm: 'No result data'
// 			}]);

// 			// Kembalikan fokus ke textbox agar tetap bisa diketik
// 			setTimeout(() => {
// 				$cb.combobox('textbox').focus();
// 			}, 10);
// 		} else {
// 			$cb.combobox('loadData', originalData);
// 		}
// 	});
// });
</script>
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
			<input style="margin-top:-2px;cursor:pointer;" type="button" name="submit" value="&#10010; Material" class="button-submit-add"
				onclick="create2();$('#div_input_cw1').hide();$('#div_input_gsm1').hide();$('#div_input_usage').hide();">
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
<!-- <div id="dialog-forme" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
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
			</div> -->
			<!--<img src="css/images/Shape.png" plain="true" width="18px" height="18px" style="margin-top:-22px; margin-left:168px;" onclick="get_lookup();">
<input id="cari7" placeholder="Search Color" class="input" onkeyup="Search4a();" style="width:218px; height:30px;margin-top:-26px; margin-left:190px;">-->
			<!-- <div id="tabel2" onclick="get_lookup();" style="width:860px; margin-top:25px;">
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
</div> -->
<div style="visibility: hidden; position: absolute; height: 0; overflow: hidden;">
	<div id="dialog-forme" class="easyui-dialog" closed="true" 
			data-options="
					modal:true, 
					border:'thin', 
					closable:false, 
					header:'#header-lookup-color'
			"
			style="width:900px; height:580px; padding:10px; display:none;">
			
			<div id="tabel2" onclick="get_lookup();" style="width:100%;">
					<table id="dg4e" class="easyui-datagrid" style="width:100%; height:470px;"
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

	<div id="header-lookup-color" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; background: #f8f9fa;">
			
			<div style="display: flex; align-items: center; flex-grow: 1;">
					<div style="font-weight: 700; font-size: 18px; color: #333; margin-right: 25px;">
							Lookup Color
					</div>
					
					<div style="display: flex; align-items: center; background: #fff; border: 1px solid #ccc; border-radius: 4px; padding: 5px 10px; width: 350px;">
							<img src="css/images/Shape.png" width="16px" height="16px" style="margin-right: 8px; opacity: 0.6;">
							<input id="cari7" placeholder="Search color code or name..." 
										style="border: none; outline: none; width: 100%; font-size: 14px;" 
										onkeyup="Search4a();">
					</div>
			</div>

			<div style="margin-left: 15px;">
					<a href="javascript:void(0)" 
						style="text-decoration: none; color: #555; font-size: 26px; font-weight: bold; line-height: 20px; display: block;" 
						onmouseover="this.style.color='#ff0000'" 
						onmouseout="this.style.color='#555'"
						onclick="$('#dialog-forme').dialog('close');">
						&times;
					</a>
			</div>
	</div>
</div>


<!-- LOOKUP Spec -->
<!-- <div id="dialog-formf" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
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
			</div> -->
			<!--<img src="css/images/Shape.png" plain="true" width="18px" height="18px" style="margin-top:-22px; margin-left:178px;" onclick="get_mb();">
<input id="cari8" placeholder="Search item material" class="input" onkeyup="Search4b();" style="width:218px; height:30px;margin-top:-26px; margin-left:200px;"></br>-->
			<!-- <div id="tabel2" onclick="get_mb();" style="width:860px; margin-top:25px;">
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
</div> -->
<div style="visibility: hidden; position: absolute; height: 0; overflow: hidden;">
	<div id="dialog-formf" class="easyui-dialog" closed="true" data-options=" modal:true, border:'thin', closable:false, header:'#header-lookup-material' " style="width:900px; height:580px; padding:10px; display:none;">
			<div id="tabel2" onclick="get_mb();" style="width:100%;">
					<table id="dg4f" class="easyui-datagrid" style="width:100%; height:470px;"
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

	<div id="header-lookup-material" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; background: #f8f9fa;">
			
			<div style="display: flex; align-items: center; flex-grow: 1;">
					<div style="font-weight: 700; font-size: 18px; color: #333; margin-right: 25px;">
							Lookup Material
					</div>
					
					<div style="display: flex; align-items: center; background: #fff; border: 1px solid #ccc; border-radius: 4px; padding: 5px 10px; width: 350px;">
							<img src="css/images/Shape.png" width="16px" height="16px" style="margin-right: 8px; opacity: 0.6;">
							<input id="cari8" placeholder="Search item or specification..." 
										style="border: none; outline: none; width: 100%; font-size: 14px;" 
										onkeyup="Search4b();">
					</div>
			</div>

			<div style="margin-left: 15px;">
					<a href="javascript:void(0)" 
						style="text-decoration: none; color: #555; font-size: 26px; font-weight: bold; line-height: 20px; display: block;" 
						onmouseover="this.style.color='#ff0000'" 
						onmouseout="this.style.color='#555'"
						onclick="$('#dialog-formf').dialog('close');">
						&times;
					</a>
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

<script type="text/javascript">
	function canexp() {
		$('#dialog-print').dialog('close');
		$('#form-print').form('reset');
	}

	/*cetak*/
	function exp() {
		document.getElementById("ordpkexp").value = <?php echo $ord; ?>;
		$.ajax({
			type: "POST",
			url: "view/get_ordno.php",
			data: "ord=<?php echo $ord; ?>",
			success: function(data) {
				let text = data;
				const arr = text.split(",");
				var ordno = arr[0];
				var filenm = arr[1];
				document.getElementById('ordnoexp').innerHTML = ordno;
			},
		});
		$('#dialog-print').dialog('open').dialog('setTitle', '');
	}

	function cetak() {
		var cek = $('input[name="cek"]:checked').attr("value");
		var ord = $('#ordpkexp').val();

		var ids = [];
		var row = $('#dg2').datagrid('getSelected');
		var rows = $('#dg2').datagrid('getSelections');
		if (row) {
		//cari6 = $('#cari6b').val();
		for (var i = 0; i < rows.length; i++) {
			ids.push(rows[i].rkbpk);
		}
		// alert(cek);
		if (cek == 1) {
			url = "pdf/pdf_mat?ord=" + row.ordpk + "&rkb=" + ids;
			window.open(url);
		} else {
			// url = "excel/excel_mat?ord=" + row.ordpk + "&rkb=" + ids;
			url = "excel/excel_mat2?ord=" + row.ordpk + "&rkb=" + ids;
			window.open(url);
		}
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	window.onscroll = function() {
		myFunctiona();
		myFunctionb();
	};

	var header = document.getElementById("myHeader");
	var sticky = header.offsetTop;

	function myFunctiona() {
		if (window.pageYOffset > sticky) {
			header.classList.add("sticky");
		} else {
			header.classList.remove("sticky");
		}
	}

	function toggleSize() {
			if ($('#notApplicable').is(':checked')) {
					$('#sizegar1').prop('disabled', true).val('');
					$('#sizegar1').removeAttr('required');
			} else {
					$('#sizegar1').prop('disabled', false);
					$('#sizegar1').attr('required', true);
			}
	}
	function toggleSizeA() {
			if ($('#notApplicable1').is(':checked')) {
					$('#sizegar').prop('disabled', true).val('');
					$('#sizegar').removeAttr('required');
			} else {
					$('#sizegar').prop('disabled', false);
					$('#sizegar').attr('required', true);
			}
	}

	function updateUnitText() {
			// myFunction2b();
			const val = $('#unit').combobox('getValue');
			$('.label_unit').text(val || '-');
	}
	function updateUnitText1() {
			// myFunction2b();
			const val = $('#unit1').combobox('getValue');
			$('.label_unit').text(val || '-');
	}

	function updateCurrencyText() {
        const currency = $('#curpk').combobox('getText') || 'USD';

        $('.text_currency').text(currency);

        // refresh semua tampilan
        myFunction2b();
        calculateCosting();
        // calculateItemCost();
  }

	// function updateCurrencyText1() {
  //       const currency = $('#curpk1').combobox('getText') || 'USD';

  //       $('.text_currency').text(currency);

  //       // refresh semua tampilan
	// 			myFunction2a();
  //       calculateCostingA();
  //       // calculateItemCost();
  // }

	function updateCurrencyText1(record) {
         const currency = record ? record.curid : ($('#curpk1').combobox('getText') || 'USD');

        $('.text_currency').text(currency);

        // refresh semua tampilan
        myFunction2a(currency);
        calculateCostingA(currency);
        // calculateItemCost(currency);
    }

	// function formatCurrency(value, currency) {
  //       value = parseFloat(value || 0);

  //       let map = {
  //           IDR: { locale: 'id-ID', code: 'IDR', fraction: 0 },
  //           USD: { locale: 'en-US', code: 'USD' },
  //           EUR: { locale: 'de-DE', code: 'EUR' },
  //           GBP: { locale: 'en-GB', code: 'GBP' },
  //           HKD: { locale: 'en-HK', code: 'HKD' },
  //           RMB: { locale: 'zh-CN', code: 'CNY' },
  //           RS:  { locale: 'en-IN', code: 'INR' }
  //       };

  //       let cfg = map[currency] || { locale: 'en-US', code: 'USD' };

  //       return new Intl.NumberFormat(cfg.locale, {
  //           style: 'currency',
  //           currency: cfg.code,
  //           minimumFractionDigits: cfg.fraction ?? 3
  //       }).format(value);
  //   }

		function formatCurrency(value, currency) {
        value = parseFloat(value || 0);

        let map = {
            IDR: { locale: 'id-ID', code: 'IDR', fraction: 2 }, 
            USD: { locale: 'en-US', code: 'USD', fraction: 2 },
            EUR: { locale: 'de-DE', code: 'EUR', fraction: 2 },
            GBP: { locale: 'en-GB', code: 'GBP', fraction: 2 },
            HKD: { locale: 'en-HK', code: 'HKD', fraction: 2 },
            CNY: { locale: 'zh-CN', code: 'CNY', fraction: 2 }, 
            RMB: { locale: 'zh-CN', code: 'CNY', fraction: 2 },
            INR: { locale: 'en-IN', code: 'INR', fraction: 2 },
            RS:  { locale: 'en-IN', code: 'INR', fraction: 2 }
        };

        let cfg = map[currency] || { locale: 'en-US', code: 'USD', fraction: 2 };

        return new Intl.NumberFormat(cfg.locale, {
            style: 'currency',
            currency: cfg.code,
            minimumFractionDigits: cfg.fraction,
            maximumFractionDigits: cfg.fraction
        }).format(value);
    }

		function formatWithSign(value, currency, suffix = '') {
        let val = parseFloat(value || 0);
        let sign = val > 0 ? '+' : '';

        return `${sign}${formatCurrency(val, currency)}${suffix}`;
    }

</script>