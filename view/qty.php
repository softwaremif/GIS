<style>
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

		/* Blue */
		background: #359DD9;

		/* W - Drop Shadow */
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

	.dropbtn1x {
		background-color: #3498DB;
		color: white;
		padding: 16px;
		font-size: 16px;
		/* margin-left: -400px; */
		border: none;
		cursor: pointer;
	}

	.dropbtn1x:hover,
	.dropbtn1x:focus {
		background-color: #2980B9;
	}

	.dropdown1x {
		position: relative;
		display: inline-block;
	}

	.dropdown-content1x {
		display: none;
		position: absolute;
		background-color: #FFFFFF;
		min-width: 200px;
		max-height: 320px;
		overflow-y: auto;
		margin-left: -125px;
		margin-top: 15px;
		text-align: left;
		box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
		z-index: 999;
	}

	.dropdown-content1x a {
		color: black;
		padding: 7px 12px;
		text-decoration: none;
		display: block;
	}

	.dropdown1x a:hover {
		background-color: #ddd;
	}

	.show {
		display: block;
	}

	.dropdown-toggle-custom {
		border-style: none !important;
	}

	.dropdown-toggle-custom:active {
		border-style: none !important;
	}

	.dropdown-menu {
		box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);
		border-radius: 0px;
		border-style: none !important;
	}

	.dropdown-item {
		border-style: none !important;
		/* font-family: Arial; */
		font-style: normal;
		font-weight: 400;
		font-size: 14px;
		line-height: 18px;
		color: #359DD9;
	}

	.dropdown-item:hover {
		background-color: transparent;
		border-style: none !important;
		color: #359DD9;

	}

	.dropdown-item:active {
		background-color: transparent;
		border-style: none !important;

	}

	.d-none {
		display: none;
	}
</style>
<script type="text/javascript">
	var url;

	function myFunction1x() {
		document.getElementById("myDropdown1x").classList.toggle("show");
	}

	window.onclick = function(event) {
		if (!event.target.matches('.dropbtn1x')) {
			var dropdowns = document.getElementsByClassName("dropdown-content1x");
			var i;
			for (i = 0; i < dropdowns.length; i++) {
				var openDropdown = dropdowns[i];
				if (openDropdown.classList.contains('show')) {
					openDropdown.classList.remove('show');
				}
			}
		}
	}

	// function linkmaterials() {
	// 	var ord = "<?php //echo $ord; 
						?>";
	// 	var c1 = "<?php //echo $_GET['c1']; 
						?>";
	// 	var c2 = "<?php //echo $_GET['c2']; 
						?>";
	// 	var c3 = "<?php //echo $_GET['c3']; 
						?>";
	// 	var c7 = "<?php //echo $_GET['c7']; 
						?>";
	// 	var c8 = "<?php //echo $_GET['c8']; 
						?>";

	// 	var url = `?hal=mat&ord=${ord}&c1=${c1}&c2=${c2}&c3=${c3}&c7=${c7}&c8=${c8}`;
	// 	window.location.href = url;
	// }

	// function linkcosting() {
	// 	var ord = "<?php //echo $ord; 
						?>";
	// 	var c1 = "<?php //echo $_GET['c1']; 
						?>";
	// 	var c2 = "<?php //echo $_GET['c2']; 
						?>";
	// 	var c3 = "<?php //echo $_GET['c3']; 
						?>";
	// 	var c7 = "<?php //echo $_GET['c7']; 
						?>";
	// 	var c8 = "<?php //echo $_GET['c8']; 
						?>";

	// 	var url = `?hal=cost&ord=${ord}&c1=${c1}&c2=${c2}&c3=${c3}&c7=${c7}&c8=${c8}`;
	// 	window.location.href = url;
	// }

	/*menu*/
	function enforceCheckableRows() {
		var checked = $('#dg').datagrid('getChecked');
		var rows = $('#dg').datagrid('getRows');
		var invalid = checked.filter(function(r) { return r.copy == 1 || r.jenis != 'DETAIL'; });
		invalid.forEach(function(r) {
			var idx = rows.findIndex(function(x) { return x.bdownpk == r.bdownpk; });
			if (idx > -1) {
				$('#dg').datagrid('uncheckRow', idx);
			}
		});
		return invalid.length > 0;
	}

	function checkMenu() {
		if (enforceCheckableRows()) {
			return;
		}

		var checked = $('#dg').datagrid('getChecked');
		var hasSource = $('#dg').datagrid('getRows').some(function(r) { return r.copy == 1; });

		if (checked.length > 0 || hasSource) {
			var hasReleased = checked.some(function(r) { return r.stsprod == 1; });
			$('#myHeader').show();
			$('#edit').hide();
			$('#save').hide();
			$('#save2').hide();
			$('#delrowbtn').hide();

			if (checked.length > 0) {
				$('#ckcount').show().text(checked.length + ' item dipilih');
				$('#mdeleteqty').toggle(!hasReleased);
			} else {
				$('#ckcount').show().text('Pilih baris tujuan untuk di-replace');
				$('#mdeleteqty').hide();
			}

			$('#mcopyqty').toggle(!hasSource && checked.length == 1);
			$('#mreplaceqty').toggle(hasSource && checked.length > 0);
			$('#mcancopyqty').toggle(hasSource);
		} else {
			$('#ckcount').hide();
			$('#mdeleteqty').hide();
			$('#mcopyqty').hide();
			$('#mreplaceqty').hide();
			$('#mcancopyqty').hide();
			menu();
		}
	}

	function disableCopyRowCheckbox() {
		var rows = $('#dg').datagrid('getRows');
		var panel = $('#dg').datagrid('getPanel');
		rows.forEach(function(r, idx) {
			if (r.copy == 1 || r.jenis != 'DETAIL') {
				panel.find('tr[datagrid-row-index="' + idx + '"] input[type=checkbox]').prop('disabled', true).css('cursor', 'not-allowed');
			}
		});
	}

	function copyRowQty() {
		var checked = $('#dg').datagrid('getChecked');
		if (checked.length != 1) {
			return;
		}
		var row = checked[0];
		$.ajax({
			type: "POST",
			url: "action/simpan.php?x=copyqty",
			data: {
				ordpk: <?php echo $_GET['ord']; ?>,
				bdownpk: row.bdownpk
			},
			success: function() {
				$('#dg').datagrid('reload');
				$('#dg').datagrid('clearSelections');
				$('#dg').datagrid('clearChecked');
				$('#myHeader').hide();
			},
		});
	}

	function cancelCopyQty() {
		$.ajax({
			type: "POST",
			url: "action/simpan.php?x=cancopyqty",
			data: {
				ordpk: <?php echo $_GET['ord']; ?>
			},
			success: function() {
				$('#dg').datagrid('reload');
				$('#dg').datagrid('clearChecked');
				$('#myHeader').hide();
			},
		});
	}

	function openReplaceDialog() {
		var checked = $('#dg').datagrid('getChecked');
		if (!checked.length) {
			return;
		}
		var source = $('#dg').datagrid('getRows').filter(function(r) { return r.copy == 1; })[0];
		if (!source) {
			return;
		}
		$('#rpfob').prop('checked', false);
		$('#rpgac').prop('checked', false);
		$('#rppcd').prop('checked', false);
		$('#rpfobval').text(source.fob > 0 ? ('$' + source.fob) : '-');
		$('#rpgacval').text(source.gac2 ? source.gac2 : '-');
		$('#rppcdval').text(source.pcd2 ? source.pcd2 : '-');
		$('#dialog-form-replace').dialog('open').dialog('setTitle', '');
	}

	function saveReplaceQty() {
		var cols = [];
		if ($('#rpfob').is(':checked')) {
			cols.push('fob');
		}
		if ($('#rpgac').is(':checked')) {
			cols.push('gac');
		}
		if ($('#rppcd').is(':checked')) {
			cols.push('pcd');
		}
		if (!cols.length) {
			$.messager.alert('Warning', 'Pilih minimal satu kolom untuk di-replace.', 'warning');
			return;
		}
		var checked = $('#dg').datagrid('getChecked');
		var ids = checked.map(function(r) {
			return r.bdownpk;
		});
		if (!ids.length) {
			return;
		}
		$.ajax({
			type: "POST",
			url: "action/simpan.php?x=replaceqty",
			data: {
				ordpk: <?php echo $_GET['ord']; ?>,
				ids: ids,
				cols: cols
			},
			dataType: "json",
			success: function(result) {
				$('#dialog-form-replace').dialog('close');
				$.messager.show({
					title: '',
					msg: result.msg,
					timeout: 3000,
					showType: 'slide',
					icon: 'info',
					width: 350,
					height: 55,
					style: {
						left: 0,
						right: '',
						top: '',
						bottom: -document.body.scrollTop - document.documentElement.scrollTop
					}
				});
				$('#dg').datagrid('reload');
				$('#dg').datagrid('clearChecked');
				$('#myHeader').hide();
			},
		});
	}

	function delqty_bulk() {
		var checked = $('#dg').datagrid('getChecked');
		if (!checked.length) {
			return;
		}
		var ids = checked.map(function(r) { return r.bdownpk; });
		$.ajax({
			type: "GET",
			url: "view/get_data.php?x=stsprod&ordpk=<?php echo $_GET['ord']; ?>",
			dataType: "json",
			success: function(data) {
				var msg = (data == 1) ?
					'Order ini sudah di-release ke Produksi. Apakah Anda yakin ingin menghapus ' + ids.length + ' baris order breakdown terpilih?' :
					'Apakah Anda yakin ingin menghapus ' + ids.length + ' baris order breakdown terpilih?';
				$.messager.confirm('Confirm', msg, function(r) {
					if (r) {
						delqty_bulk2(ids);
					}
				});
			},
		});
	}

	function delqty_bulk2(ids) {
		var deferreds = ids.map(function(id) {
			return $.get('action/delete.php?x=qty&bdownpk=' + id);
		});
		$.when.apply($, deferreds).always(function() {
			$.messager.show({
				title: '',
				msg: "<div class='text-infohijau' style='width:285px;'>" + ids.length + " order breakdown berhasil dihapus &nbsp; &#10004;</div>",
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
			$('#dg').datagrid('reload');
			$('#dg').datagrid('clearChecked');
			$('#myHeader').hide();
		});
	}

	function autoCheckSelectedRow(row) {
		if (row.jenis != 'DETAIL') {
			return false;
		}
		var rows = $('#dg').datagrid('getRows');
		var idx = rows.findIndex(function(r) { return r.bdownpk == row.bdownpk; });
		if (idx > -1) {
			$('#dg').datagrid('checkRow', idx);
		}
		return true;
	}

	function menu() {
		if ($('#dg').datagrid('getChecked').length > 0) {
			return;
		}
		var row = $('#dg').datagrid('getSelected');
		if (row) {
			if (autoCheckSelectedRow(row)) {
				return;
			}

			if (row.stsprod == 1) {
                $('#delrowbtn').hide();
            } else {
                $('#delrowbtn').show();
            }

			test = $('#test').val();

			if (test == 1) {
				$('#myHeader').show();
				$('#edit').hide();
				$('#save2').hide();
				$('#save').hide();
			} else {
				$('#myHeader').show();
				$('#edit').hide();
				$('#save').hide();
				$('#save2').hide();
			}
		} else {
			$('#myHeader').hide();
			$('#dg').datagrid('clearSelections');
		}
	}

	function menu2() {
		if ($('#dg').datagrid('getChecked').length > 0) {
			return;
		}
		var row = $('#dg').datagrid('getSelected');
		if (row) {
			if (autoCheckSelectedRow(row)) {
				return;
			}

			if (row.stsprod == 1) {
                $('#delrowbtn').hide();
            } else {
                $('#delrowbtn').show();
            }

			$('#myHeader').show();
			$('#edit').hide();
			$('#save').hide();
			$('#save2').hide();
		} else {
			$('#myHeader').hide();
			$('#dg').datagrid('clearSelections');
		}
	}

	function edit() {
		test = 1;
		document.getElementById("test").value = test;
		$('#dg').edatagrid('addRow2');
		$('#myHeader').show();
		$('#edit').hide();
		$('#save').hide();
		$('#save2').hide();
		var dg = $('#dg');
		var hd = dg.datagrid('getPanel').find('div.datagrid-header td');
		hd.css('border', '0.3px solid #b2b2b2');
		var td = dg.datagrid('getPanel').find('div.datagrid-body td[field="country"]');
		var td1 = dg.datagrid('getPanel').find('div.datagrid-body td[field="pono"]');
		var td2 = dg.datagrid('getPanel').find('div.datagrid-body td[field="opno"]');
		var td3 = dg.datagrid('getPanel').find('div.datagrid-body td[field="style"]');
		var td4 = dg.datagrid('getPanel').find('div.datagrid-body td[field="color"]');
		var td4b = dg.datagrid('getPanel').find('div.datagrid-body td[field="fob"]');
		var td5 = dg.datagrid('getPanel').find('div.datagrid-body td[field="gac2"]');
		var td5b = dg.datagrid('getPanel').find('div.datagrid-body td[field="pcd2"]');
		var td6 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s1"]');
		var td7 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s2"]');
		var td8 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s3"]');
		var td9 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s4"]');
		var td10 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s5"]');
		var td11 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s6"]');
		var td12 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s7"]');
		var td13 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s8"]');
		var td14 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s9"]');
		var td15 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s10"]');
		var td16 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s11"]');
		var td17 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s12"]');
		var td18 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s13"]');
		var td19 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s14"]');
		var td20 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s15"]');
		var td21 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s16"]');
		var td22 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s17"]');
		var td23 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s18"]');
		var td24 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s19"]');
		var td25 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s20"]');
		var td26 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s21"]');
		var td27 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s22"]');
		var td28 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s23"]');
		var td29 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s24"]');
		var td30 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s25"]');
		var td31 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s26"]');
		var td32 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s27"]');
		var td33 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s28"]');
		var td34 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s29"]');
		var td35 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s30"]');
		var td36 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s31"]');
		var td37 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s32"]');
		var td38 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s33"]');
		var td39 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s34"]');
		var td40 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s35"]');
		var td41 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s36"]');
		var td42 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s37"]');
		var td43 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s38"]');
		var td44 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s39"]');
		var td45 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s40"]');
		td.css('border-style', 'ridge');
		td.css('border', '1px solid #b2b2b2');
		td.css('border-radius', '7px');
		td.css('background-color', '#ffffff');
		td1.css('border', '1px solid #b2b2b2');
		td1.css('border-radius', '7px');
		td1.css('background-color', '#ffffff');
		td2.css('border', '1px solid #b2b2b2');
		td2.css('border-radius', '7px');
		td2.css('background-color', '#ffffff');
		td3.css('border', '1px solid #b2b2b2');
		td3.css('border-radius', '7px');
		td3.css('background-color', '#ffffff');
		td4.css('border', '1px solid #b2b2b2');
		td4.css('border-radius', '7px');
		td4.css('background-color', '#ffffff');
		td4b.css('border', '1px solid #b2b2b2');
		td4b.css('border-radius', '7px');
		td4b.css('background-color', '#ffffff');
		td5.css('border', '1px solid #b2b2b2');
		td5.css('border-radius', '7px');
		td5.css('background-color', '#ffffff');
		td5b.css('border', '1px solid #b2b2b2');
		td5b.css('border-radius', '7px');
		td5b.css('background-color', '#ffffff');
		td6.css('border', '1px solid #b2b2b2');
		td6.css('border-radius', '7px');
		td6.css('background-color', '#ffffff');
		td7.css('border', '1px solid #b2b2b2');
		td7.css('border-radius', '7px');
		td7.css('background-color', '#ffffff');
		td8.css('border', '1px solid #b2b2b2');
		td8.css('border-radius', '7px');
		td8.css('background-color', '#ffffff');
		td9.css('border', '1px solid #b2b2b2');
		td9.css('border-radius', '7px');
		td9.css('background-color', '#ffffff');
		td10.css('border', '1px solid #b2b2b2');
		td10.css('border-radius', '7px');
		td10.css('background-color', '#ffffff');
		td11.css('border', '1px solid #b2b2b2');
		td11.css('border-radius', '7px');
		td11.css('background-color', '#ffffff');
		td12.css('border', '1px solid #b2b2b2');
		td12.css('border-radius', '7px');
		td12.css('background-color', '#ffffff');
		td13.css('border', '1px solid #b2b2b2');
		td13.css('border-radius', '7px');
		td13.css('background-color', '#ffffff');
		td14.css('border', '1px solid #b2b2b2');
		td14.css('border-radius', '7px');
		td14.css('background-color', '#ffffff');
		td15.css('border', '1px solid #b2b2b2');
		td15.css('border-radius', '7px');
		td15.css('background-color', '#ffffff');
		td16.css('border', '1px solid #b2b2b2');
		td16.css('border-radius', '7px');
		td16.css('background-color', '#ffffff');
		td17.css('border', '1px solid #b2b2b2');
		td17.css('border-radius', '7px');
		td17.css('background-color', '#ffffff');
		td18.css('border', '1px solid #b2b2b2');
		td18.css('border-radius', '7px');
		td18.css('background-color', '#ffffff');
		td19.css('border', '1px solid #b2b2b2');
		td19.css('border-radius', '7px');
		td19.css('background-color', '#ffffff');
		td20.css('border', '1px solid #b2b2b2');
		td20.css('border-radius', '7px');
		td20.css('background-color', '#ffffff');
		td21.css('border', '1px solid #b2b2b2');
		td21.css('border-radius', '7px');
		td21.css('background-color', '#ffffff');
		td22.css('border', '1px solid #b2b2b2');
		td22.css('border-radius', '7px');
		td22.css('background-color', '#ffffff');
		td23.css('border', '1px solid #b2b2b2');
		td23.css('border-radius', '7px');
		td23.css('background-color', '#ffffff');
		td24.css('border', '1px solid #b2b2b2');
		td24.css('border-radius', '7px');
		td24.css('background-color', '#ffffff');
		td25.css('border', '1px solid #b2b2b2');
		td25.css('border-radius', '7px');
		td25.css('background-color', '#ffffff');
		td26.css('border', '1px solid #b2b2b2');
		td26.css('border-radius', '7px');
		td26.css('background-color', '#ffffff');
		td27.css('border', '1px solid #b2b2b2');
		td27.css('border-radius', '7px');
		td27.css('background-color', '#ffffff');
		td28.css('border', '1px solid #b2b2b2');
		td28.css('border-radius', '7px');
		td28.css('background-color', '#ffffff');
		td29.css('border', '1px solid #b2b2b2');
		td29.css('border-radius', '7px');
		td29.css('background-color', '#ffffff');
		td30.css('border', '1px solid #b2b2b2');
		td30.css('border-radius', '7px');
		td30.css('background-color', '#ffffff');
		td31.css('border', '1px solid #b2b2b2');
		td31.css('border-radius', '7px');
		td31.css('background-color', '#ffffff');
		td32.css('border', '1px solid #b2b2b2');
		td32.css('border-radius', '7px');
		td32.css('background-color', '#ffffff');
		td33.css('border', '1px solid #b2b2b2');
		td33.css('border-radius', '7px');
		td33.css('background-color', '#ffffff');
		td34.css('border', '1px solid #b2b2b2');
		td34.css('border-radius', '7px');
		td34.css('background-color', '#ffffff');
		td35.css('border', '1px solid #b2b2b2');
		td35.css('border-radius', '7px');
		td35.css('background-color', '#ffffff');
		td36.css('border', '1px solid #b2b2b2');
		td36.css('border-radius', '7px');
		td36.css('background-color', '#ffffff');
		td37.css('border', '1px solid #b2b2b2');
		td37.css('border-radius', '7px');
		td37.css('background-color', '#ffffff');
		td38.css('border', '1px solid #b2b2b2');
		td38.css('border-radius', '7px');
		td38.css('background-color', '#ffffff');
		td39.css('border', '1px solid #b2b2b2');
		td39.css('border-radius', '7px');
		td39.css('background-color', '#ffffff');
		td40.css('border', '1px solid #b2b2b2');
		td40.css('border-radius', '7px');
		td40.css('background-color', '#ffffff');
		td41.css('border', '1px solid #b2b2b2');
		td41.css('border-radius', '7px');
		td41.css('background-color', '#ffffff');
		td42.css('border', '1px solid #b2b2b2');
		td42.css('border-radius', '7px');
		td42.css('background-color', '#ffffff');
		td43.css('border', '1px solid #b2b2b2');
		td43.css('border-radius', '7px');
		td43.css('background-color', '#ffffff');
		td44.css('border', '1px solid #b2b2b2');
		td44.css('border-radius', '7px');
		td44.css('background-color', '#ffffff');
		td45.css('border', '1px solid #b2b2b2');
		td45.css('border-radius', '7px');
		td45.css('background-color', '#ffffff');
	}

	function tambahrow() {
		$('#dg').edatagrid('addRow');
		var index = $('#dg').edatagrid('getRows').length - 1; // the editing row index
		var ed = $('#dg').edatagrid('getEditors', index)[0]; // get the first editor
		$(ed.target).focus();
		$('#myHeader').show();
		$('#edit').hide();
		$('#save').show();
		$('#save2').hide();
	}

	function cancel() {
		test = "";
		document.getElementById("test").value = test;
		$('#dg').edatagrid('cancelRow');
		$('#dg').datagrid('reload');
		$('#myHeader').hide();
		$('#dg').datagrid('clearSelections');
		var dg = $('#dg');
		var hd = dg.datagrid('getPanel').find('div.datagrid-header td');
		hd.css('border', '');
		//save();
	}

	function save() {
		// test = "";
		// document.getElementById("test").value = test;
		var dg = $('#dg');
		var editIndex = dg.data('editIndex');
		dg.datagrid('endEdit', editIndex);
		dg.edatagrid('saveRow');
	}

	function save2() {
		test = "";
		document.getElementById("test").value = test;
		$('#dg').edatagrid('saveRow');
		$('#myHeader').fadeOut();
		$('#dg').datagrid('clearSelections');
		$('#dg').datagrid('reload');
	}

	function delqty() {
		var row = $('#dg').datagrid('getSelected');
		$.ajax({
			type: "GET",
			url: "view/get_data.php?x=stsprod&ordpk=<?php echo $_GET['ord']; ?>",
			dataType: "json",
			success: function(data) {
				if (data == 1) {
					$('#dialog-form-confirm-delete').dialog('open').dialog('setTitle', '');
				} else {
					delqty2();
				}
			},
		});
		//var spv = document.getElementById("spv").value;
		//if(spv==1){
		// $('#dg').edatagrid('destroyRow');
		//} else {
		//$.messager.alert('Warning','You are not allowed to delete this order breakdown, please contact your supervisor','warning');	  
		//}
	}

	function delqty2() {
		var row = $('#dg').datagrid('getSelected');
		$.ajax({
			type: "GET",
			url: "action/delete.php?x=qty&bdownpk=" + row.bdownpk,
			data: "",
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
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
				$('#dg').datagrid('reload');
				$('#myHeader').hide();
				$('#dialog-form-confirm-delete').dialog('close');
			},
		});
	}

	/*edatagrid*/
	$.extend($.fn.datagrid.methods, {
		editCell: function(jq, param) {
			return jq.each(function() {
				var opts = $(this).datagrid('options');
				var fields = $(this).datagrid('getColumnFields', true).concat($(this).datagrid('getColumnFields'));
				for (var i = 0; i < fields.length; i++) {
					var col = $(this).datagrid('getColumnOption', fields[i]);
					col.editor1 = col.editor;
					if (fields[i] !== param.field) {
						col.editor = col.editor1; // Nonaktifkan editor untuk field lain
					}
				}
				$(this).datagrid('beginEdit', param.index);
				for (var i = 0; i < fields.length; i++) {
					var col = $(this).datagrid('getColumnOption', fields[i]);
					col.editor = col.editor1; // Kembalikan editor ke kondisi awal
				}
			});
		}
	});

	/*edatagrid*/
	$(function() {
		$('#dg').edatagrid({
			saveUrl: 'action/simpan.php?x=qty2&ord=<?php echo $ord; ?>',
			updateUrl: 'action/simpan.php?x=qty&ord=<?php echo $ord; ?>',
			destroyUrl: 'action/delete.php?x=qty',
			destroyMsg: null,
			onSuccess: function(index, row) {
				$.messager.show({
					title: '',
					msg: row.msg,
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
				$('#dg').datagrid('reload');
				var dg = $('#dg');
				var hd = dg.datagrid('getPanel').find('div.datagrid-header td');
				hd.css('border', '');
				$('#savenew1').removeClass('d-none');
				$('#savenew2').addClass('d-none');
				$('#myHeader').hide();
			},
			onDestroy: function(index, row) {
				$.messager.show({
					title: '',
					msg: row.msg,
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
				$('#dg').datagrid('reload');
				$('#myHeader').hide();
			},
			onDblClickRow: function(index, row) {
				// alert('ini double click');
				$(this).edatagrid('reload');
				return false; // Nonaktifkan double click default

			},
		 	 onBeginEdit: function(index,row){
				// daftar kolom yang wajib diisi
				var requiredFields = ['style','color','fob', 'opno'];

				requiredFields.forEach(function(fld){
					var ed = $(this).datagrid('getEditor',{index:index,field:fld});
					if(ed){
						var $input = $(ed.target).textbox('textbox');

						if(index === 0){
							// baris pertama → tidak wajib
							$input.validatebox({ required:false });
							$input.removeClass('validatebox-invalid');
						}else{
							// baris kedua dst → wajib
							$input.validatebox({ required:true });
							if(!$input.val().trim()){ 
								// kalau masih kosong → munculkan merah
								$input.addClass('validatebox-invalid'); 
							}
						}
					}
				}, this);
			},
			onClickCell: function(index, field) {
				var dg = $(this);
				var isEditable = ['country', 'poref', 'pono', 'opno', 'color', 'style', 'fob', 'pcd2', 'ddp', 'secsz', 'gac', 'gac2',
                    's1','s2','s3','s4','s5','s6','s7','s8','s9','s10',
                    's11','s12','s13','s14','s15','s16','s17','s18','s19','s20','s21','s22','s23','s24','s25'];
				var requiredFields = ['style']; // Kolom yang wajib diisi

				// Cek apakah ada kolom yang kosong sebelum pindah sel
				if (index > 0) {
					for (var i = 0; i < requiredFields.length; i++) {
						var requiredField = requiredFields[i];
						var cellValue = dg.datagrid('getRows')[index][requiredField] || '';
						console.log("nilai cellValue sebelum pindah sel :", cellValue);
						if (cellValue.trim() === '') {
							$.messager.alert('Warning', `Field <b>${requiredField.toUpperCase()}</b> harus diisi sebelum berpindah!`, 'warning');
							return false; // cegah pindah sel
						}
					}
				}

				if (isEditable.includes(field)) {
					dg.datagrid('beginEdit', index); // Edit semua field pada baris ini

					if (!dg.data('editedCells')) {
						dg.data('editedCells', []);
					}
					let editedCells = dg.data('editedCells');
					let row = dg.datagrid('getRows')[index];

					// // Loop seluruh kolom editable dalam satu baris
					// isEditable.forEach(function(fld) {
					// 	var ed = dg.datagrid('getEditor', {
					// 		index: index,
					// 		field: fld
					// 	});

					// 	if (ed) {
					// 		var inputBox = $(ed.target).textbox ? $(ed.target).textbox('textbox') : $(ed.target);
					// 		var originalValue = row[fld] || '';

					// 		inputBox.off('keyup').on('keyup', function() {
					// 			var newValue = inputBox.val().trim();
					// 			if (newValue !== originalValue) {
					// 				$('#savenew1').addClass('d-none');
					// 				$('#savenew2').removeClass('d-none');
					// 				$('#simpan_confirm1').addClass('d-none');
					// 				$('#simpan_confirm2').removeClass('d-none');

					// 				let existingIndex = editedCells.findIndex(e => e.index === index && e.field === fld);
					// 				if (existingIndex !== -1) {
					// 					editedCells[existingIndex].value = newValue;
					// 				} else {
					// 					editedCells.push({
					// 						index: index,
					// 						field: fld,
					// 						value: newValue
					// 					});
					// 				}
					// 				dg.data('editedCells', editedCells);
					// 			}
					// 		});
					// 	}
					// });

					isEditable.forEach(fld => {
                        let ed = dg.datagrid('getEditor', { index: index, field: fld });
                        if (ed) {
                            let originalValue = row[fld] || '';

                            // Jika editor datebox
                           if ($(ed.target).hasClass('datebox-f')) {
                                // ambil raw original (misal dari DB bisa yyyy-mm-dd)
                                let originalRaw = row[fld] || '';
                                // normalisasi ke format display dd/mm/yyyy
                                let originalFormatted = '';
                                if (originalRaw) {
                                    const dObj = myparser(originalRaw);
                                    if (dObj && !isNaN(dObj)) originalFormatted = myformatter(dObj);
                                }

                                // flag untuk mencegah trigger saat init (opsional)
                                let isInit = true;

                                $(ed.target).datebox({
                                    formatter: myformatter,
                                    parser: myparser,
                                    validType: 'maxTahun',
                                    onShowPanel: function () {
                                        // pastikan tampil value lama saat panel dibuka
                                        if (originalFormatted) $(this).datebox('setValue', originalFormatted);
                                    },
                                    onSelect: function (date) {
                                        if (date.getFullYear() > MAX_TAHUN_TGL) return;
                                        // ambil nilai dari parameter `date` (paling andal)
                                        const newValue = myformatter(date); // dd/mm/yyyy
                                        console.log('originalFormatted:', originalFormatted, ' newValue(from date):', newValue);

                                        if (isInit) {
                                            // jika ingin skip triggered event saat inisialisasi
                                            isInit = false;
                                            return;
                                        }

                                        if (newValue !== originalFormatted) {
                                           	$('#savenew1').addClass('d-none');
											$('#savenew2').removeClass('d-none');
											$('#simpan_confirm1').addClass('d-none');
											$('#simpan_confirm2').removeClass('d-none');

                                            let existingIndex = editedCells.findIndex(e => e.index === index && e.field === fld);
                                            if (existingIndex !== -1) {
                                                editedCells[existingIndex].value = newValue;
                                            } else {
                                                editedCells.push({ index: index, field: fld, value: newValue });
                                            }
                                            dg.data('editedCells', editedCells);
                                        }
                                    }
                                });

                                // tanggal di atas batas tahun tidak bisa dipilih di kalender
                                $(ed.target).datebox('calendar').calendar({ validator: tahunTglValid });

                                // langsung set value lama supaya tidak kosong saat editor aktif
                                if (originalFormatted) $(ed.target).datebox('setValue', originalFormatted);
                                isInit = false;
                            } else {
                                let inputBox = $(ed.target).textbox ? $(ed.target).textbox('textbox') : $(ed.target);

                                inputBox.off('keyup').on('keyup', function() {
                                    let newValue = inputBox.val().trim();
                                    if (newValue !== originalValue) {
                                        	$('#savenew1').addClass('d-none');
											$('#savenew2').removeClass('d-none');
											$('#simpan_confirm1').addClass('d-none');
											$('#simpan_confirm2').removeClass('d-none');

                                        let existingIndex = editedCells.findIndex(e => e.index === index && e.field === fld);
                                        if (existingIndex !== -1) {
                                            editedCells[existingIndex].value = newValue;
                                        } else {
                                            editedCells.push({ index: index, field: fld, value: newValue });
                                        }
                                        dg.data('editedCells', editedCells);
                                    }
                                });
                            }
                        }
                    });
				}
			},
		});
	});

	// function save_confirm() {
	// 	var dg = $('#dg');
	// 	var editedCells = dg.data('editedCells') || [];
	// 	console.log("nilai editedCells:", editedCells);
	// 	console.log("nilai length editedCells:", editedCells.length);

	// 	if (editedCells.length === 0) {
	// 		console.log("No changes detected.");
	// 		return;
	// 	}

	// 	// Cek apakah ada field yang kosong sebelum menyimpan
	// 	let emptyFields = [];
	// 	for (var i = 0; i < editedCells.length; i++) {
	// 		var cell = editedCells[i];
	// 		// if (cell.value.trim() === '') { // Jika nilai kosong
	// 		if (cell.value.trim() === '' && cell.field !== 'pono') {
	// 			emptyFields.push(cell.field); // Tambahkan ke list
	// 		}
	// 	}

	// 	if (emptyFields.length > 0) {
	// 		// Jika ada field kosong, tampilkan alert dan batalkan penyimpanan
	// 		// alert("Kolom berikut tidak boleh kosong: " + emptyFields.join(", "));
	// 		$('#myHeader').show();
	// 		$.messager.show({
	// 			title: '',
	// 			msg: `<div class="text-infomerah" style="width:400px;">
	// 					Data pada kolom <b>${emptyFields.join(", ")}</b> tidak boleh kosong!
	// 				</div>`,
	// 			timeout: 3000,
	// 			showType: 'slide',
	// 			icon: 'info',
	// 			width: 415,
	// 			height: 55,
	// 			style: {
	// 				left: 0,
	// 				right: '',
	// 				top: '',
	// 				bottom: -document.body.scrollTop - document.documentElement.scrollTop
	// 			}
	// 		});
	// 		return;
	// 	} else {
	// 	$.ajax({
	// 		type: "POST",
	// 		url: "view/get_dataord.php?x=ord&ordpk=<?php echo $_GET['ord']; ?>",
	// 		dataType: "json",
	// 		success: function(data) {
	// 			if (data.stsprod == 1) {
	// 				$('#dialog-form-confirm-simpan').dialog('open').dialog('setTitle', '');
	// 			} else {
	// 				save_confirm2();
	// 			}
	// 		},
	// 	});
	// 	}
	// }

	function save_confirm() {
		var dg = $('#dg');
		var editedCells = dg.data('editedCells') || [];
		console.log("nilai editedCells:", editedCells);
		console.log("nilai length editedCells:", editedCells.length);

		if (editedCells.length === 0) {
			console.log("No changes detected.");
			return;
		}

		// ✅ daftar field wajib isi
		let requiredOnly = ['fob'];

		// Cek apakah ada field wajib yang kosong sebelum menyimpan
		let emptyFields = [];
		for (var i = 0; i < editedCells.length; i++) {
			var cell = editedCells[i];
			if (requiredOnly.includes(cell.field) && cell.value.trim() === '') {
				emptyFields.push(cell.field);
			}
		}

		// Tahun PCD / Ex Factory maksimal MAX_TAHUN_TGL (bisa lolos kalau diketik manual)
		let tahunSalah = [];
		for (var i = 0; i < editedCells.length; i++) {
			var cell = editedCells[i];
			var label = { pcd2: 'PCD', gac2: 'Ex Factory' }[cell.field];
			var tahun = parseInt((cell.value || '').split('/')[2], 10);
			if (label && tahun > MAX_TAHUN_TGL && !tahunSalah.includes(label)) tahunSalah.push(label);
		}
		if (tahunSalah.length > 0) {
			$('#myHeader').show();
			$.messager.alert({
				title: 'Validasi Tahun',
				msg: 'Data tahun kolom <b>' + tahunSalah.join(', ') + '</b> maksimal 2 tahun (s/d ' + MAX_TAHUN_TGL + ').',
				icon: 'error',
				width: 420
			});
			return;
		}

		if (emptyFields.length > 0) {
			// Jika ada field wajib yang kosong, tampilkan alert dan batalkan penyimpanan
			$('#myHeader').show();
			$.messager.show({
				title: '',
				msg: `<div class="text-infomerah" style="width:400px;">
						Data pada kolom <b>${emptyFields.join(", ")}</b> tidak boleh kosong!
					</div>`,
				timeout: 3000,
				showType: 'slide',
				icon: 'info',
				width: 415,
				height: 55,
				style: {
					left: 0,
					right: '',
					top: '',
					bottom: -document.body.scrollTop - document.documentElement.scrollTop
				}
			});
			return;
		} else {
			$.ajax({
				type: "POST",
				url: "view/get_dataord.php?x=ord&ordpk=<?php echo $_GET['ord']; ?>",
				dataType: "json",
				success: function(data) {
					if (data.stsprod == 1) {
						$('#dialog-form-confirm-simpan').dialog('open').dialog('setTitle', '');
					} else {
						save_confirm2();
					}
				},
			});
		}
	}

	function save_confirm2() {
		var dg = $('#dg');
		var editedCells = dg.data('editedCells') || [];
		console.log("nilai editedCells:", editedCells);
		console.log("nilai length editedCells:", editedCells.length);

		if (editedCells.length === 0) {
			console.log("No changes detected.");
			return;
		}

		// // Cek apakah ada field yang kosong sebelum menyimpan
		// let emptyFields = [];
		// for (var i = 0; i < editedCells.length; i++) {
		// 	var cell = editedCells[i];
		// 	if (cell.value.trim() === '') { // Jika nilai kosong
		// 		emptyFields.push(cell.field); // Tambahkan ke list
		// 	}
		// }

		// if (emptyFields.length > 0) {
		// 	// Jika ada field kosong, tampilkan alert dan batalkan penyimpanan
		// 	alert("Kolom berikut tidak boleh kosong: " + emptyFields.join(", "));
		// 	return;
		// }

		// Simpan data jika semua valid
		for (var i = 0; i < editedCells.length; i++) {
			var cell = editedCells[i];
			dg.datagrid('endEdit', cell.index);
			dg.datagrid('updateRow', {
				index: cell.index,
				row: {
					[cell.field]: cell.value
				}
			});
		}

		// Save row to the server
		dg.datagrid('acceptChanges');
		$('#myHeader').hide();
		$('#dialog-form-confirm-simpan').dialog('close');

		// Clear stored edited cells
		dg.removeData('editedCells');
	}

	function saverow() {
		console.log('test saver row');
		var dg = $('#dg');
		var editIndex = dg.data('editIndex');
		dg.datagrid('endEdit', editIndex);
		dg.edatagrid('saveRow');
		$('#myHeader').hide();
		$('#dialog-form-confirm-simpan').dialog('close');
		dg.datagrid('reload');
		console.log('success save row');
	}

	function cancel_perubahan() {
		// var dg = $('#dg');
		// dg.removeData('editIndex'); // Reset edit index setelah menyimpan
		// dg.removeData('editField'); // Reset edit field setelah menyimpan
		// dg.datagrid('reload');
		$('#dialog-form-simpan').dialog('close');
		$('#myHeader').hide();
		window.location.reload();
	}

	function closemenu() {
		var dg = $('#dg');
		var editIndex = dg.data('editIndex');
		var editField = dg.data('editField');

		if (editIndex !== undefined && editField !== undefined) {
			var ed = dg.datagrid('getEditor', {
				index: editIndex,
				field: editField
			});

			console.log("Nilai editField: ", editField, "/", editIndex, "/", ed);

			if (ed) {
				var inputBox = $(ed.target).textbox('textbox');
				var val_editor = inputBox.val().trim(); // Ambil nilai editor

				var val_awal = dg.datagrid('getRows')[editIndex][editField] || '';
				console.log("Nilai awal:", val_awal);

				if (val_editor === "") {
					$.messager.show({
						title: '',
						msg: '<div class="text-infomerah" style="width:300px;">Data tidak boleh kosong &nbsp; &#x2573; </div>',
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
					return; // Hentikan proses close menu jika data kosong
				} else {
					$('#dialog-form-simpan').dialog('open').dialog('setTitle', '');
					return;
				}
			}

			// dg.datagrid('endEdit', editIndex);
			dg.removeData('editIndex'); // Reset edit index setelah menyimpan
			dg.removeData('editField'); // Reset edit field setelah menyimpan
		}

		$('#myHeader').hide();
		$('#dialog-form-simpan').dialog('open').dialog('setTitle', '');
		return;
	}

	function kembali() {
		$('#dialog-form-simpan').dialog('close');
		$('#myHeader').show();
	}

	function kembali2() {
		$('#dialog-form-confirm-simpan').dialog('close');
		$('#myHeader').show();
	}

	// Batas tahun tanggal PCD / Ex Factory: tahun berjalan (server) + 2.
	var MAX_TAHUN_TGL = <?php echo (int) date('Y') + 2; ?>;

	function tahunTglValid(date) {
		return date.getFullYear() <= MAX_TAHUN_TGL;
	}

	$.extend($.fn.validatebox.defaults.rules, {
		maxTahun: {
			validator: function(value) {
				var tahun = parseInt((value || '').split('/')[2], 10);
				return !tahun || tahun <= MAX_TAHUN_TGL;
			},
			message: 'Tahun maksimal ' + MAX_TAHUN_TGL + ' (2 tahun ke depan)'
		}
	});

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
	function Search() {
		$('#dg').datagrid('load', {
			cari1: $('#cari1').val()
		});
	}

	function Search2() {
		$('#tabel1').css("margin-top", "60px");
		$('#frame-utama-cari2').show();
		$('#frame-utama-cari1').hide();
		$('#dg').datagrid('load', {
			cari3: $('#place').val(),
			cari4: $('#color').val(),
			cari5: $('#secsz').val()
		});
		cari3 = $('#place').val();
		//alert(cari3);
		const myArray = cari3.split(",");
		var dt1 = $('#place').combobox('getData').length;
		for (i = 0; i <= dt1; i++) {
			document.getElementById("ceka" + i).value = myArray[i];
			document.getElementById("cekaa" + i).value = myArray[i];
			var dt = $('#ceka' + i).val();
			if (dt == "undefined" || dt == "") {
				$('#ceka' + i).hide();
				$('#crossa' + i).hide();
				document.getElementById("talla" + i).value = 0;
				tutup2();
			} else {
				$('#ceka' + i).show();
				$('#crossa' + i).show();
				document.getElementById("talla" + i).value = 1;
			}
		}
		$('#fltr3').show();
		totrec();
	}

	/*function unSearch2(cross){
	var c = cross;
	var cmb = document.getElementById("ceka"+c).value;
	//alert(cmb);
	$('#place').combobox('unselect', cmb);
	document.getElementById("ceka"+c).value ="test";
	$('#ceka'+c).hide();
	$('#crossa'+c).hide();
	document.getElementById("talla"+c).value = 0;
	$('#dg').datagrid('load',{
	cari3: $('#place').val(),
	cari4: $('#color').val()
	});
	//tutup2();
	}*/

	function unSearch2(cross) {
		var c = cross;
		document.getElementById("talla" + c).value = 0;
		document.getElementById("ceka" + c).value = "";
		var cmb = document.getElementById("cekaa" + c).value;
		$('#place').combobox('unselect', cmb);
		//$('#ceka'+c).hide();
		//$('#crossa'+c).hide();
		//alert(cmb);
		$('#dg').datagrid('load', {
			cari3: $('#place').val(),
			cari4: $('#color').val(),
			cari5: $('#secsz').val()
		});
		tutup2();
		totrec();
	}

	function Search2b() {
		$('#tabel1').css("margin-top", "60px");
		$('#frame-utama-cari2').show();
		$('#frame-utama-cari1').hide();
		$('#dg').datagrid('load', {
			cari3: $('#place').val(),
			cari4: $('#color').val(),
			cari5: $('#secsz').val()
		});
		cari4 = $('#color').val();
		//alert(cari3);
		const myArrayb = cari4.split(",");
		var dt1b = $('#color').combobox('getData').length;
		var dt1ab = dt1b - 1;
		for (j = 0; j <= dt1ab; j++) {
			document.getElementById("cekb" + j).value = myArrayb[j];
			document.getElementById("cekbb" + j).value = myArrayb[j];
			var dtb = $('#cekb' + j).val();
			if (dtb == "undefined" || dtb == "") {
				$('#cekb' + j).hide();
				$('#crossb' + j).hide();
				document.getElementById("tallb" + j).value = 0;
				tutup2();
			} else {
				$('#cekb' + j).show();
				$('#crossb' + j).show();
				document.getElementById("tallb" + j).value = 1;
			}
		}
		$('#fltr3').show();
		totrec();
	}

	function unSearch2b(crossb) {
		var cb = crossb;
		document.getElementById("tallb" + j).value = 0;
		document.getElementById("cekb" + cb).value = "";
		var cmbb = document.getElementById("cekbb" + cb).value;
		$('#color').combobox('unselect', cmbb);
		//$('#cekb'+cb).hide();
		//$('#crossb'+cb).hide();
		//alert(bc);
		$('#dg').datagrid('load', {
			cari3: $('#place').val(),
			cari4: $('#color').val(),
			cari5: $('#secsz').val()
		});
		tutup2();
		totrec();
	}

	function Search2c() {
		$('#tabel1').css("margin-top", "60px");
		$('#frame-utama-cari2').show();
		$('#frame-utama-cari1').hide();
		$('#dg').datagrid('load', {
			cari3: $('#place').val(),
			cari4: $('#color').val(),
			cari5: $('#secsz').val()
		});
		cari5 = $('#secsz').val();
		//alert(cari3);
		const myArrayc = cari5.split(",");
		var dt1c = $('#secsz').combobox('getData').length;
		var dt1ac = dt1c - 1;
		for (j = 0; j <= dt1ac; j++) {
			document.getElementById("cekc" + j).value = myArrayc[j];
			document.getElementById("cekcc" + j).value = myArrayc[j];
			var dtc = $('#cekc' + j).val();
			if (dtc == "undefined" || dtc == "") {
				$('#cekc' + j).hide();
				$('#crossc' + j).hide();
				document.getElementById("tallc" + j).value = 0;
				tutup2();
			} else {
				$('#cekc' + j).show();
				$('#crossc' + j).show();
				document.getElementById("tallc" + j).value = 1;
			}
		}
		$('#fltr3').show();
		totrec();
	}

	function unSearch2c(crossc) {
		var cc = crossc;
		document.getElementById("tallc" + j).value = 0;
		document.getElementById("cekc" + cb).value = "";
		var cmcc = document.getElementById("cekcc" + cc).value;
		$('#secsz').combobox('unselect', cmcc);
		//$('#cekb'+cb).hide();
		//$('#crossb'+cb).hide();
		//alert(bc);
		$('#dg').datagrid('load', {
			cari3: $('#place').val(),
			cari4: $('#color').val(),
			cari5: $('#secsz').val()
		});
		tutup2();
		totrec();
	}

	function reset() {
		//$('#tabel1').css("margin-top","");
		//$('#color').combobox('setValue', color);
		// $('#place').combobox('setValue', place);
		$('#dg').datagrid('load', {
			cari3: '',
			cari4: '',
			cari5: ''
		});
		$('#tabel1').css("margin-top", "");
		$('#fltr3').hide();
		totrec();
		$('#frame-fltrchk2').hide();
		$('#frame-utama-cari2').hide();
		$('#frame-utama-cari1').show();
	}

	function tutup2() {
		var cka1 = document.getElementById("talla0").value;
		var cka2 = document.getElementById("talla1").value;
		var cka3 = document.getElementById("talla2").value;
		var cka4 = document.getElementById("talla3").value;
		var cka5 = document.getElementById("talla4").value;
		var cka6 = document.getElementById("talla5").value;
		var cka7 = document.getElementById("talla6").value;
		var cka8 = document.getElementById("talla7").value;
		var cka9 = document.getElementById("talla8").value;
		var cka10 = document.getElementById("talla9").value;
		var cka11 = document.getElementById("talla10").value;

		var ckb1 = document.getElementById("tallb0").value;
		var ckb2 = document.getElementById("tallb1").value;
		var ckb3 = document.getElementById("tallb2").value;
		var ckb4 = document.getElementById("tallb3").value;
		var ckb5 = document.getElementById("tallb4").value;
		var ckb6 = document.getElementById("tallb5").value;
		var ckb7 = document.getElementById("tallb6").value;
		var ckb8 = document.getElementById("tallb7").value;
		var ckb9 = document.getElementById("tallb8").value;
		var ckb10 = document.getElementById("tallb9").value;
		var ckb11 = document.getElementById("tallb10").value;

		var ckc1 = document.getElementById("tallc0").value;
		var ckc2 = document.getElementById("tallc1").value;
		var ckc3 = document.getElementById("tallc2").value;
		var ckc4 = document.getElementById("tallc3").value;
		var ckc5 = document.getElementById("tallc4").value;
		var ckc6 = document.getElementById("tallc5").value;
		var ckc7 = document.getElementById("tallc6").value;
		var ckc8 = document.getElementById("tallc7").value;
		var ckc9 = document.getElementById("tallc8").value;
		var ckc10 = document.getElementById("tallc9").value;
		var ckc11 = document.getElementById("tallc10").value;

		var tallt = parseInt(cka1) + parseInt(cka2) + parseInt(cka3) + parseInt(cka4) + parseInt(cka5) + parseInt(cka6) +
			parseInt(cka7) + parseInt(cka8) + parseInt(cka9) + parseInt(cka10) + parseInt(cka11) +
			parseInt(ckb1) + parseInt(ckb2) + parseInt(ckb3) + parseInt(ckb4) + parseInt(ckb5) + parseInt(ckb6) + parseInt(ckb7) + parseInt(ckb8) +
			parseInt(ckb9) + parseInt(ckb10) + parseInt(ckb11) +
			parseInt(ckc1) + parseInt(ckc2) + parseInt(ckc3) + parseInt(ckc4) + parseInt(ckc5) + parseInt(ckc6) + parseInt(ckc7) + parseInt(ckc8) +
			parseInt(ckc9) + parseInt(ckc10) + parseInt(ckc11);
		//alert(tallt);
		if (tallt == 0) {
			reset();
			$('#frame-fltrchk2').hide();
			$('#frame-utama-cari2').hide();
			$('#frame-utama-cari1').show();
		}
		totrec();
	}

	function totrec() {
		var tcount = JSON.stringify($('#dg').datagrid('getData').total);
		document.getElementById("fltr2").innerHTML = "Selected Filter <br>" + tcount + " result";
	}

	/*function Search2(){
	$('#tabel1').css("margin-top","60px");
	$('#cek1').show();
	$('#cross1').show();
	$('#fltr1').show();
	$('#fltr2').show();
	$('#fltr3').show();
	$('#dg').datagrid('load',{
	cari3: $('#place').val(),
	cari4: $('#color').val()
	});
	cari3 = $('#place').val();
	document.getElementById("cek1").value = cari3;
	}
	function unSearch2(){
	$('#place').combobox('setValue', place);
	$('#cek1').hide();
	$('#cross1').hide();
	$('#dg').datagrid('load',{
	cari3: $('#place').val(),
	cari4: $('#color').val(),
	});
	document.getElementById("cek1").value = '';
	}
	function Search2b(){
	$('#tabel1').css("margin-top","60px");
	$('#cek2').show();
	$('#cross2').show();
	$('#fltr1').show();
	$('#fltr2').show();
	$('#fltr3').show();
	$('#dg').datagrid('load',{
	cari3: $('#place').val(),
	cari4: $('#color').val()
	});
	cari4 = $('#color').val();
	document.getElementById("cek2").value = cari4;
	}
	function unSearch2b(){
	$('#color').combobox('setValue', color);
	$('#cek2').hide();
	$('#cross2').hide();
	$('#dg').datagrid('load',{
	cari3: $('#place').val(),
	cari4: $('#color').val()
	});
	document.getElementById("cek2").value = '';
	}

	function totrec() {
	   var tcount= JSON.stringify($('#dg').datagrid('getData').total);
		document.getElementById("fltr2").innerHTML = "Selected Filter <br>"+tcount+" result";
	}

	function reset() {
	//$('#tabel1').css("margin-top","");
	$('#color').combobox('setValue', color);
	$('#place').combobox('setValue', place);
	$('#cek1').hide();
	$('#cek2').hide();
	$('#fltr1').hide();
	$('#fltr2').hide();
	$('#fltr3').hide();
	$('#cross1').hide();
	$('#cross2').hide();
	document.getElementById('cek1').value = '';
	document.getElementById('cek2').value = '';
	$('#dg').datagrid('load',{
	cari3: '',
	cari4: ''
	});
	$('#tabel1').css("margin-top","");
	}

	function tutup() {
	   	var cktype1= $('#cek1').val();
		if (cktype1) {
	       var ttype1=1;
	    } else { var ttype1=0; }
					
		var ckspec1= $('#cek2').val();
			if (ckspec1) {
	       var tspec1=1;
	    }  else { var tspec1=0; }
					
	    var tall1=ttype1+tspec1;
	if (tall1==0) {
	$('#color').combobox('setValue', color);
	$('#place').combobox('setValue', place);
	$('#cek1').hide();
	$('#cek2').hide();
	$('#fltr1').hide();
	$('#fltr2').hide();
	$('#fltr3').hide();
	$('#cross1').hide();
	$('#cross2').hide();
	document.getElementById('cek1').value = '';
	document.getElementById('cek2').value = '';
	$('#dg').datagrid('load',{
	cari3: '',
	cari4: ''
	});
	$('#tabel1').css("margin-top","");
	}
	}*/

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
		$('#dialog-formb').dialog('open').dialog('setTitle', '');
	}

	function canexp() {
		$('#dialog-formb').dialog('close');
		$('#formb').form('reset');
	}

	function cetak() {
		cari = $('#place').val();
		cari2 = $('#color').val();
		cari3 = $('#secsz').val();
		// url = "pdf/pdf_qty2?ord=<?php //echo $ord; 
									?>&cari="+cari+"&cari2="+cari2;
		// window.open(url); 
		var cek = $('input[name="cek"]:checked').attr("value");
		var ord = $('#ordpkexp').val();
		// alert(cek);
		if (cek == 1) {
			url = "pdf/pdf_qty2?ord=" + ord + "&cari=" + cari + "&cari2=" + cari2 + "&cari3=" + cari3;
			window.open(url);
		} else {
			// url = "excel/excel_qty?ord=" + ord + "&cari=" + cari + "&cari2=" + cari2 + "&cari3=" + cari3;
			url = "excel/excel_qty2?ord=" + ord + "&cari=" + cari + "&cari2=" + cari2 + "&cari3=" + cari3;
			window.open(url);
		}
	}

	//combobox dengan chekbox
	$(function() {
		$('#place').combobox({
			formatter: function(row) {
				var opts = $(this).combobox('options');
				return '<input type="checkbox" id="combochek" class="combobox-checkbox">' + row[opts.textField];
			},
			onLoadSuccess: function() {
				var opts = $(this).combobox('options');
				var target = this;
				var values = $(target).combobox('getValues');
				$.map(values, function(value) {
					var el = opts.finder.getEl(target, value);
					el.find('input.combobox-checkbox')._propAttr('checked', true);
				});
			},
			onSelect: function(row) {
				console.log(row);
				var opts = $(this).combobox('options');
				var el = opts.finder.getEl(this, row[opts.valueField]);
				el.find('input.combobox-checkbox')._propAttr('checked', true);
				$('#frame-fltrchk2').show();
				totrec();
			},
			onUnselect: function(row) {
				var opts = $(this).combobox('options');
				var el = opts.finder.getEl(this, row[opts.valueField]);
				el.find('input.combobox-checkbox')._propAttr('checked', false);
			}
		});

		$('#color').combobox({
			formatter: function(row) {
				var opts = $(this).combobox('options');
				return "<input type='checkbox' class='combobox-checkbox' value=''>" + row[opts.textField];
			},
			onLoadSuccess: function() {
				var opts = $(this).combobox('options');
				var target = this;
				var values = $(target).combobox('getValues');
				$.map(values, function(value) {
					var el = opts.finder.getEl(target, value);
					el.find('input.combobox-checkbox')._propAttr('checked', true);
				});
			},
			onSelect: function(row) {
				console.log(row);
				var opts = $(this).combobox('options');
				var el = opts.finder.getEl(this, row[opts.valueField]);
				el.find('input.combobox-checkbox')._propAttr('checked', true);
				$('#frame-fltrchk2').show();
				totrec();
			},
			onUnselect: function(row) {
				var opts = $(this).combobox('options');
				var el = opts.finder.getEl(this, row[opts.valueField]);
				el.find('input.combobox-checkbox')._propAttr('checked', false);
			}
		});

		$('#secsz').combobox({
			formatter: function(row) {
				var opts = $(this).combobox('options');
				return "<input type='checkbox' class='combobox-checkbox' value=''>" + row[opts.textField];
			},
			onLoadSuccess: function() {
				var opts = $(this).combobox('options');
				var target = this;
				var values = $(target).combobox('getValues');
				$.map(values, function(value) {
					var el = opts.finder.getEl(target, value);
					el.find('input.combobox-checkbox')._propAttr('checked', true);
				});
			},
			onSelect: function(row) {
				console.log(row);
				var opts = $(this).combobox('options');
				var el = opts.finder.getEl(this, row[opts.valueField]);
				el.find('input.combobox-checkbox')._propAttr('checked', true);
				$('#frame-fltrchk2').show();
				totrec();
			},
			onUnselect: function(row) {
				var opts = $(this).combobox('options');
				var el = opts.finder.getEl(this, row[opts.valueField]);
				el.find('input.combobox-checkbox')._propAttr('checked', false);
			}
		});
	});

	function scrollToBottom() {
		const scrollingElement = document.scrollingElement || document.body;
		scrollingElement.scrollTop = scrollingElement.scrollHeight;
	}

	function formatter1(value, row) {
		if (value > 0) {
			return '$' + value;
		} else {
			return '';
		}
	}

	function styler1(index, row) {
		if (row.jenis == "HEADER") {
			return 'font-weight:bold';
		} else {
			return '';
		}
	}

	function upload2() {
		document.getElementById("ordpkupload").value = <?php echo $ord; ?>;
		$.ajax({
			type: "POST",
			url: "view/get_ordno.php",
			data: "ord=<?php echo $ord; ?>",
			success: function(data) {
				let text = data;
				const arr = text.split(",");
				var ordno = arr[0];
				var filenm = arr[1];
				document.getElementById('ordnoupload').innerHTML = ordno;
				document.getElementById('filenm2').innerHTML = filenm;
			},
		});
		$('#dialog-form2').dialog('open').dialog('setTitle', '');
	}

	function upload() {
		document.getElementById("ordpkexp2").value = <?php echo $ord; ?>;
		$.ajax({
			type: "POST",
			url: "view/get_ordno.php",
			data: "ord=<?php echo $ord; ?>",
			success: function(data) {
				let text = data;
				const arr = text.split(",");
				var ordno = arr[0];
				var filenm = arr[1];
				document.getElementById('ordnoexp2').innerHTML = ordno;
				document.getElementById('filenm').innerHTML = filenm;
			},
		});
		$('#dialog-form').dialog('open').dialog('setTitle', '');
	}

	function cancelupload() {
		$('#dialog-form').dialog('close');
		$('#form').form('reset');
		$('#submit2').show();
		$('#submit1').hide();
	}

	function cancelupload2() {
		$('#dialog-form2').dialog('close');
		$('#form2').form('reset');
		$('#submit2a').show();
		$('#submit1a').hide();
	}

	function canconupload() {
		$('#dialog-conupload').dialog('close');
	}

	function canconupload2() {
		$('#dialog-conupload2').dialog('close');
	}

	function consaveupload() {
		$.ajax({
			type: "POST",
			url: "view/get_dataord.php?x=ord&ordpk=<?php echo $_GET['ord']; ?>",
			dataType: "json",
			success: function(data) {
				if (data.stsprod == 1) {
					$('#dialog-conupload').dialog('open').dialog('setTitle', '');
				} else {
					saveupload();
				}
			},
		});
	}

	function consaveupload2() {
		$.ajax({
			type: "POST",
			url: "view/get_dataord.php?x=ord&ordpk=<?php echo $_GET['ord']; ?>",
			dataType: "json",
			success: function(data) {
				if (data.stsprod == 1) {
					$('#dialog-conupload2').dialog('open').dialog('setTitle', '');
				} else {
					saveupload2();
				}
			},
		});
	}

	function saveupload() {
		$.messager.progress({
			title: '',
			msg: 'Upload in progress...',
			border: 'thin'
		});
		var string = $("#form").serialize();
		var url = "action/simpan_bqty.php";
		$('#form').form('submit', {
			type: "POST",
			url: url,
			data: string,
			onSubmit: function() {
				var isValid = $(this).form('validate');
				if (!isValid) {
					$.messager.progress('close'); // hide progress bar while the form is invalid
				}
				return isValid; // return false will stop the form submission
			},
			onProgress: function(percent) {
				$.messager.progress();
			},
			success: function(data) {
				$.messager.progress('close');
				if (data.indexOf('validasi-tahun') !== -1) {
					$('#dialog-conupload').dialog('close');
					$.messager.alert({ title: 'Validasi Tahun', msg: data, icon: 'error', width: 520 });
					return;
				}
				$('#dialog-conupload').dialog('close');
				$('#dialog-form').dialog('close');
				$('#form').form('reset');
				$('#submit2').show();
				$('#submit1').hide();
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
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg').datagrid('reload');
			}
		});
	}

	// function saveupload() {
    //     $.messager.progress({
    //         title: '',
    //         msg: 'Upload in progress...',
    //         border: 'thin'
    //     });
    //     let formUploadBreakdown = $('#form2')[0]; // ambil form DOM
    //     let dataFormUploadBreakdown = new FormData(formUploadBreakdown); // FormData bisa bawa file
	// 	var url = "action/simpan_bqty.php";
    //     $.ajax({
    //         url: url,
    //         method: "POST",
    //         data: dataFormUploadBreakdown,
    //         processData: false, // penting: jangan proses data
    //         contentType: false, // penting: jangan set content type
    //         success: function(data) {
    //             $.messager.progress('close');
    //             $('#formUploadBreakdown').form('reset');
    //             $('#dialog-confirm-upload').dialog('close')
    //             $('#uploadBreakdown').dialog('close')
    //             showAlert('codeApproved', data.message);
    //             // $('#tt').datagrid('reload');
	// 	        window.location.reload();
    //         },
    //         error: function(xhr) {
    //             $.messager.progress('close');
    //             $.messager.alert('Error', xhr.responseJSON?.message ||
    //                 'Terjadi kesalahan saat mengunggah.');
    //         }
    //     });
    // }
	
	// function saveupload() {
	// 	$.messager.progress({
	// 		msg: 'Upload in progress...',
	// 		border: 'thin'
	// 	});

	// 	var formData = new FormData();

	// 	// ambil file ASLI dari easyui-filebox
	// 	var fileInput = $('#uploadfile2')
	// 		.next()
	// 		.find('input[type=file]')[0];
	// 	if (!fileInput || fileInput.files.length === 0) {
	// 		$.messager.progress('close');
	// 		$.messager.alert('Error', 'File belum dipilih');
	// 		return;
	// 	}

	// 	formData.append('uploadfile', fileInput.files[0]);
	// 	formData.append('ordpk', $('#ordpkexp2').val());

	// 	$.ajax({
	// 		url: 'action/simpan_bqty.php',
	// 		type: 'POST',
	// 		data: formData,
	// 		processData: false,
	// 		contentType: false,
	// 		success: function (data) {
	// 			$.messager.progress('close');
	// 			$('#dialog-conupload').dialog('close');
	// 			$('#dialog-form').dialog('close');
	// 			$('#form').form('reset');
	// 			$('#submit2').show();
	// 			$('#submit1').hide();
	// 			$.messager.show({
	// 				title: '',
	// 				msg: data,
	// 				timeout: 3000,
	// 				showType: 'slide',
	// 				icon: 'info',
	// 				width: 390,
	// 				height: 55,
	// 				style: {
	// 					left: 0,
	// 					right: '',
	// 					top: '',
	// 					bottom: -document.body.scrollTop - document.documentElement.scrollTop
	// 				}
	// 			});
	// 			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
	// 			$('#dg').datagrid('reload');
	// 		},
	// 		error: function (xhr) {
	// 			$.messager.progress('close');
	// 			console.error(xhr.responseText);
	// 		}
	// 	});
	// }
	
	function saveupload2() {
		$.messager.progress({
			title: '',
			msg: 'Upload in progress...',
			border: 'thin'
		});
		var string = $("#form2").serialize();
		// var typeupload = $("#typeupload2").val();
		// var url = typeupload == 3 ? "action/simpan_bqty.php" : "action/simpan_master2.php";
		var url = "action/simpan_master2.php";
		// var url = "action/simpan_bdown_detail.php";
		$('#form2').form('submit', {
			type: "POST",
			url: url,
			data: string,
			onSubmit: function() {
				var isValid = $(this).form('validate');
				if (!isValid) {
					$.messager.progress('close'); // hide progress bar while the form is invalid
				}
				return isValid; // return false will stop the form submission
			},
			onProgress: function(percent) {
				$.messager.progress();
			},
			success: function(data) {
				$.messager.progress('close');
				if (data.indexOf('validasi-tahun') !== -1) {
					$('#dialog-conupload2').dialog('close');
					$('#dialog-conupload').dialog('close');
					$.messager.alert({ title: 'Validasi Tahun', msg: data, icon: 'error', width: 520 });
					return;
				}
				$('#dialog-conupload2').dialog('close');
				$('#dialog-conupload').dialog('close');
				$('#dialog-form2').dialog('close');
				$('#form2').form('reset');
				$('#submit2a').show();
				$('#submit1a').hide();
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
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg').datagrid('reload');
			}
		});
	}

	function ordno() {
		$.ajax({
			type: "POST",
			url: "view/get_dataord.php?x=ord&ordpk=<?php echo $_GET['ord']; ?>",
			dataType: "json",
			success: function(data) {
				console.log("stsprod:" + data.stsprod)
				if (data.stsprod == 1) {
					$('#btnrel1').hide();
					$('#btnrel2').show();
					$('#frame-utama-cari').css('width', '910px');
				} else {
					$('#btnrel1').show();
					$('#btnrel2').hide();
					$('#frame-utama-cari').css('width', '960px');
				}
			},
		});
	}

	function release() {
		$.ajax({
			type: "POST",
			url: "view/get_dataord.php?x=bdown&ordpk=<?php echo $_GET['ord']; ?>",
			dataType: "json",
			success: function(data) {
				// if (data.dtord >= 1 || data.dtcost == 0) {
				if (data.dtord >= 1 || data.tot<=0) {
					$('#dialog-release').dialog('open').dialog('setTitle', '');
					document.getElementById('notebdown').innerHTML = "&bull;" + data.bdown;
					document.getElementById('notecost').innerHTML = "&bull;" + data.cost;
					document.getElementById('notetotal').innerHTML = "&bull;" + data.total;
					if (data.bdown) {
						$('#notebdown').show();
					}
					if (data.total) {
						$('#notetotal').show();
					}

					// if (data.cost) {
					// 	$('#notecost').show();
					// }
				} else {
					$('#dialog-conrelease').dialog('open').dialog('setTitle', '');
				}
			},
		});
	}

	function canrelease() {
		$('#dialog-release').dialog('close');
		$('#notecost').hide();
		$('#notebdown').hide();
		$('#notetotal').hide();
	}

	function canrelease3() {
		$('#dialog-conrelease').dialog('close');
	}

	function saverelease() {
		var string = $("#form-release").serialize();
		$('#form-release').form('submit', {
			type: "POST",
			url: "action/simpan_release.php",
			data: string,
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
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
				window.location.reload();
			}
		});
	}

	function release2() {
		$.ajax({
			type: "POST",
			url: "view/get_dataord.php?x=ord&ordpk=<?php echo $_GET['ord']; ?>",
			dataType: "json",
			success: function(data) {
				$('#dialog-release2').dialog('open').dialog('setTitle', '');
				document.getElementById('dateprod').innerHTML = data.dateprod;
			},
		});
	}

	function canrelease2() {
		$('#dialog-release2').dialog('close');
	}

	$(document).ready(function() {
		$('#uploadfile').filebox({
			onChange: function(file) {
				$('#submit2').hide();
				$('#submit1').show();
			}
		});

		$('#uploadfile2').filebox({
			onChange: function(file) {
				$('#submit2a').hide();
				$('#submit1a').show();
			}
		});
		ordno();
	});

	function log() {
		$('#dialog-formhistory').dialog('open').dialog('setTitle', '');
		$('#dg2c').datagrid('load', 'view/get_log_qty.php?ordpk=<?php echo $_GET['ord']; ?>');
		var dg = $('#dg2c');
		dg.datagrid();
		dg.datagrid('getPanel').addClass('lines-no2');
		dg.datagrid('getPanel').addClass('col');
		$('#dg2c').datagrid('getPanel').addClass('lines-no3');
		$('#dg2c').datagrid('getPanel').css('border', 'none');
	}

	// $(function() {
	// 	$('#dg').datagrid({
	// 		onLoadSuccess: function(data) {
	// 			var rows = $('#dg').datagrid('getPanel').find('div.datagrid-footer tr');

	// 			rows.each(function() {
	// 				var secszText = $(this).find('td[field="secsz"]').text().trim();
	// 				console.log("nilai kolom seczs:", secszText);

	// 				if (secszText === "By Color" || secszText === "By Place" || secszText === "By Sec. Size" || secszText === "By PCD" ) {
	// 					$(this).css({
	// 						"background-color": "#D3D3D3",
	// 						"font-weight": "bold"
	// 					});
	// 				}
	// 			});
	// 		}
	// 	});
	// });

	 $(function () {
        $('#dg').datagrid({
            onLoadSuccess: function (data) {
                var panel = $('#dg').datagrid('getPanel');
                var footerRows = panel.find('.datagrid-footer .datagrid-row');

                footerRows.each(function () {
                    var cells = $(this).find('td');

                    cells.each(function () {
                        var cellText = $(this).text().trim();
						console.log("nilai kolom seczs:", cellText);
                        if (cellText === "By Color" || cellText === "By Place" || cellText === "By Sec. Size" || cellText === "By PCD" || cellText === "By Secsz & Col") {
                            $(this).parent().css({
                                "background-color": "#D3D3D3",
                                "font-weight": "bold"
                            });
                        }
                    });
                });
            }
        });
    });

	function BackToOrder() {
		var stsclose = $('#stsclose').val();
		if (stsclose > 0) {
			$('#stsback').val(1);
			$('#dialog-form-simpan').dialog('open').dialog('setTitle', '');
		} else {
			onReturnBack1();
		}
	}

	function ToMaterials() {
		var stsclose = $('#stsclose').val();
		if (stsclose > 0) {
			$('#stsmaterials').val(1);
			$('#dialog-form-simpan').dialog('open').dialog('setTitle', '');
		} else {
			linkmaterials();
		}
	}

	function ToCosting() {
		var stsclose = $('#stsclose').val();
		if (stsclose > 0) {
			$('#stscosting').val(1);
			$('#dialog-form-simpan').dialog('open').dialog('setTitle', '');
		} else {
			linkcosting();
		}
	}

	function editlokasi(){
       $('#dialog-conrelease2').dialog('open').dialog('setTitle', '');
    }

    function cancel_edit_lokasi(){
        $('#dialog-conrelease2').dialog('close');
    }

	function onConfirm_update_lokasi() {
       var string = $("#form-lokasi").serialize();
		$('#form-lokasi').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=lokasi",
			data: string,
			success: function(data) {
				$.messager.show({
					title: '',
					msg: data,
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
				window.location.reload();
			}
		});
    }
</script>
<?php
$ord = $_GET['ord'];
$crh = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and jenis='HEADER' order by bdownpk desc limit 1");
$dth = mysqli_fetch_array($crh);
$sz = [];
$hidden = [];

for ($i = 1; $i <= 25; $i++) {
    if ($dth['s'.$i] <> "" || !empty($dth['s'.$i])) {
        $sz[$i] = 1;
    } else {
        $sz[$i] = 0;
        $hidden[$i] = "hidden";
    }
}

$cjml = array_sum($sz);

$qry = mysqli_query($koneksi, "SELECT * FROM ord where ordpk='$ord'");
$dtmif = mysqli_fetch_array($qry);
?>
<!--<div id="menu" onclick="" style="display:none;">
<div class="delete">
<a href="javascript:void(0)" id="edit"  plain="true" onclick="edit();" style="color: #FFFFFF; text-decoration: none;"> Edit </a>
<a href="javascript:void(0)" id="save" plain="true" onclick="save();" style="color: #FFFFFF; text-decoration: none;"> Save </a>
<a href="javascript:void(0)" id="save2" plain="true" onclick="save2();" style="color: #FFFFFF; text-decoration: none;"> Save </a>
</div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="cancel();" style="color: #FFFFFF; text-decoration: none;"> Cancel </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')" style="color: #FFFFFF; text-decoration: none;">Delete </a></div>-->
<!--</div>-->
<div class="contenta">
	<input type="hidden" name="stsclose" id="stsclose" value="">
	<input type="hidden" name="stsback" id="stsback" value="">
	<input type="hidden" name="stsmaterials" id="stsmaterials" value="">
	<input type="hidden" name="stscosting" id="stscosting" value="">
	<div id="frame-utama-cari" style="width:835px;">
		<div id="container-cari">
			<div id="frame-cari">
				<img src="css/images/Shape.png" plain="true" width="18px" height="18px" onclick="tutup2();">
				<input id="cari1" placeholder="Search..." class="input" plain="true" onkeyup="Search();">
			</div>
		</div>
		<!-- <input style="width:119px;" type="button" name="submit" value="Print breakdown" class="button-submit-add" plain="true" 
href="javascript:void(0);" onclick="exp()"> -->
		<div class="dropdown1x" style="left:0px;">
			<button class="dropbtn1x" id="act" onclick="myFunction1x();"
				style="padding:5px;color:#FFFFFF;background-color:#000000;border-radius:8px;cursor:pointer">Action &#9660;</button>
			<div id="myDropdown1x" class="dropdown-content1x">
				<a href="javascript:void(0);" onclick="upload2();">Add breakdown</a>
				<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
				<a href="javascript:void(0);" onclick="upload();">Update breakdown</a>
				<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
				<a href="javascript:void(0);" onclick="exp();">Print breakdown</a>
				<!-- <?php
				//if($dtmif['mif']>0){ ?>
				<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
				<a href="javascript:void(0);" onclick="editlokasi();">Edit Lokasi</a>
				<?php //} ?> -->
			</div>
		</div>

		<input type="button" value="Release to Prod." id="btnrel1" onclick="release();" style="border:none;display:none;padding:8px;color:#FFFFFF;background-color:#FF6B00;border-radius:8px;cursor:pointer">
		<input type="button" value="Released" id="btnrel2" onclick="release2();" style="border:none;display:none; padding:8px;color:#FFFFFF;background-color:#D6D6D6;border-radius:8px;cursor:pointer">

		<input style="width:150px; height:28px;" id="place" name="place" class="easyui-combobox"
			data-options="prompt:'Place',onChange:Search2,panelHeight:'auto',limitToList:'true',multiple:true,
url:'view/get_data.php?dt=qty&ord=<?php echo $ord; ?>',valueField:'country',textField:'country'," />

		<input style="width:150px; height:28px;" id="color" name="color" class="easyui-combobox"
			data-options="prompt:'Color',onChange:Search2b,panelHeight:'auto',limitToList:'true',multiple:true,
url:'view/get_data.php?dt=qty2&ord=<?php echo $ord; ?>',valueField:'color',textField:'color'," />

		<input style="width:150px; height:28px;" id="secsz" name="secsz" class="easyui-combobox"
			data-options="prompt:'Sec.Size',onChange:Search2c,panelHeight:'auto',limitToList:'true',multiple:true,
url:'view/get_data.php?dt=qty3&ord=<?php echo $ord; ?>',valueField:'secsz',textField:'secsz'," />
		<?php //if($cjml>0){ 
		?>
		<a href="javascript:void(0);" style="text-decoration:none;" onclick="tambahrow(); scrollToBottom();">
			<span style="font-style: normal; font-weight: 700; font-size: 14px; line-height: 18px; color: #359DD9;">Add order</span></a>
		<?php  //} 
		?>
		<input type="hidden" name="test" id="test" size="5">
		<a href="javascript:void(0);" title="Reload table" class="easyui-tooltip" onclick="$('#dg').datagrid('reload');">
			<img src="css/images/reload1.png" width="20px" height="20px">
		</a>
	</div>
	<div id="frame-fltrchk2" align="left" onmousemove="totrec();" style="margin-top:60px;display:none;">
		<div id="fltr1" style="margin-top:5px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"></div>
		<div id="fltr2" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"></div>
		<div style="margin-left:150px;margin-top:-25px;">
			<?php for ($a = 0; $a <= 10; $a++) { ?>
				<input type="button" id="ceka<?php echo $a; ?>" class="filterchek" alt="Submit button" style="" readonly>
				<input type="hidden" id="cekaa<?php echo $a; ?>">
				<input type="hidden" name="talla" id="talla<?php echo $a; ?>" value="0" size="5">
				<a href="javascript:void(0);" id="crossa<?php echo $a; ?>" class="cross" onclick="unSearch2(<?php echo $a; ?>);">&nbsp;&#215;&nbsp;</a>

				<input type="button" id="cekb<?php echo $a; ?>" class="filterchek" alt="Submit button" style="" readonly>
				<input type="hidden" id="cekbb<?php echo $a; ?>">
				<input type="hidden" name="tallb" id="tallb<?php echo $a; ?>" value="0" size="5">
				<a href="javascript:void(0);" id="crossb<?php echo $a; ?>" class="cross" onclick="unSearch2b(<?php echo $a; ?>);">&nbsp;&#215;&nbsp;</a>

				<input type="button" id="cekc<?php echo $a; ?>" class="filterchek" alt="Submit button" style="" readonly>
				<input type="hidden" id="cekcc<?php echo $a; ?>">
				<input type="hidden" name="tallc" id="tallc<?php echo $a; ?>" value="0" size="5">
				<a href="javascript:void(0);" id="crossc<?php echo $a; ?>" class="cross" onclick="unSearch2c(<?php echo $a; ?>);">&nbsp;&#215;&nbsp;</a>
			<?php } ?>
		</div>
		<div id="fltr3" style=" margin-left:90%;margin-top:-25px;display:none;"><a href="javascript:void(0);" style="text-decoration:none; color: #359DD9;" onclick="reset();">Reset All</a></div>
	</div>

	<?php
	$dtu = mysqli_fetch_array(mysqli_query($koneksi, "select * from logtran where ordpk='$ord' and lognote like '%qty%' 
	order by logdtime desc limit 1"));
	$dtord = mysqli_fetch_array(mysqli_query($koneksi, "SELECT stsprod, dateprod FROM ord WHERE ordpk='$ord'"));
	?>
	<div id="frame-utama-cari1" style="width:auto;text-align:left;margin-left:20px;margin-top:60px;font-size:12px;line-height:16px;font-weight:400;">
		<?php
		if ($dtord['stsprod'] == 1) {
			if (!empty($dtord['dateprod'])) { ?>
				<span style="color:rgba(0, 0, 0, 0.38);text-align:left;">
					Released : <span style="color:#000000;"><?php echo tglu($dtord['dateprod']); ?></span></span> |
		<?php }
		} ?>
		<span style="color:rgba(0, 0, 0, 0.38);text-align:left;">
			Last updated : <span style="color:#000000;"><?php echo tglu($dtu['logdtime']); ?></span></span>
		<a href="javascript:void(0)" id="log" plain="true" onclick="log();" style="color:#359DD9;text-decoration:none;">History Log</a>
	</div>

	<div id="frame-utama-cari2" style="display:none;width:auto;text-align:left;margin-left:20px;margin-top:10px;font-size:12px;line-height:16px;font-weight:400;">
		<?php
		if ($dtord['stsprod'] == 1) {
			if (!empty($dtord['dateprod'])) { ?>
				<span style="color:rgba(0, 0, 0, 0.38);text-align:left;">
					Released : <span style="color:#000000;"><?php echo tglu($dtord['dateprod']); ?></span></span> |
		<?php }
		} ?>
		<span style="color:rgba(0, 0, 0, 0.38);text-align:left;">
			Last updated : <span style="color:#000000;"><?php echo tglu($dtu['logdtime']); ?></span></span>
		<a href="javascript:void(0)" id="log" plain="true" onclick="log();" style="color:#359DD9;text-decoration:none;">History Log</a>
	</div>

			<?php
				$sizes = [];
				$hiddens = [];
				$cjml = 0;

				if (!empty($dth) && $dth['bdownpk'] > 0) {
					for ($i = 1; $i <= 25; $i++) {
						$field = "s{$i}";
						if (isset($dth[$field]) && $dth[$field] !== '') {   // pakai array akses
							$sizes[$i] = 1;
						} else {
							$sizes[$i] = 0;
							$hiddens[$i] = "hidden";
						}
						$cjml += $sizes[$i];
					}
				}
			$batasKolom = min($cjml + 1, 25);
			?>

	<div id="tabel1" onclick="menu();" ondblclick="menu2();" style="top:220px;">
		<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
			url="view/get_detord.php?ord=<?php echo $ord; ?>" idField="bdownpk" toolbar="#tb" striped="true" showFooter="true"
			pagination="false" rownumbers="false" singleSelect="false" collapsible="true" fitColumns="false"
			data-options="multiSort:true, remoteSort:false, ctrlSelect:false, checkOnSelect:false,
                            onCheck:function(){checkMenu();}, onCheckAll:function(){checkMenu();},
                            onUncheck:function(){checkMenu();}, onUncheckAll:function(){checkMenu();},
                            rowStyler:function(index,row){
                                if (row.copy == 1){
                                    return 'background-color:#FFF3B0;color:#000000;';
                                }
                            },
                            onLoadSuccess:function(){
                                disableCopyRowCheckbox();
                            },
                            onSortColumn:function(sort, order){
                            $(this).datagrid('options').sortName = sort;
                            $(this).datagrid('options').sortOrder = order;}">
			<!--data-options="rowStyler: function(index,row){
            if (row.jenis == 'FOOTER'){
            return 'background-color:#d8d8d8;color:#000000;';
            }
			else if (row.jenis == 'HEADER'){
            return 'background-color:#ff0000;color:#fff;';
            }
            }"-->
			<thead>
				<tr>
					<th data-options="field:'ck',checkbox:true" rowspan="2"></th>
					<th field="country" width="150" sortable="true" rowspan="2" styler="styler1" editor="{type:'textbox'}">Place</th>
					<th field="poref" width="150" sortable="true" rowspan="2" styler="styler1" editor="{type:'textbox'}">License<br>PO Ref</th>
					<th field="pono" width="94" sortable="true" rowspan="2" styler="styler1" editor="{type:'textbox', options:{required:false}}">PO no.</th>
					<th field="opno" width="95" sortable="false" rowspan="2" styler="styler1" editor="{type:'textbox', options:{required:false}}">OP no.</th>
					<th field="style" width="95" sortable="true" rowspan="2" styler="styler1" editor="{type:'textbox', options:{required:false}}">Style</th>
					<th field="color" width="95" sortable="true" rowspan="2" styler="styler1" editor="{type:'textbox', options:{required:false}}">Color</th>
					<th field="fob" width="80" sortable="true" rowspan="2" styler="styler1" formatter="formatter1" editor="{type:'textbox', options:{required:false}}">FOB</th>
					<th field="ddp" width="80" sortable="true" rowspan="2" styler="styler1" formatter="formatter1" editor="{type:'textbox'}">DDP</th>
					<!-- <th styler="styler1" data-options="field:'pcd2',width:92,sortable:'true', editor:{type:'datebox', options:{formatter:myformatter,parser:myparser}}" rowspan="2">PCD</th> -->
					<!-- <th styler="styler1" data-options="field:'gac2',width:92,sortable:'true', editor:{type:'datebox', options:{formatter:myformatter,parser:myparser}}" rowspan="2">Ex Factory</th> -->
					<th field="pcd2"
                                    width="92"
                                    styler="styler1"
                                    sortable="true"
                                    data-options="
                                        editor:{
                                            type:'datebox',
                                            options:{
                                                formatter:myformatter,
                                                parser:myparser,
                                                validType:'maxTahun',
                                                onShowPanel:function(){
                                                    $(this).datebox('calendar').calendar({validator:tahunTglValid});
                                                }
                                            }
                                        },
                                        sorter:function(a,b){
                                            if(!a) return -1;
                                            if(!b) return 1;

                                            // a dan b = 'dd/MM/yyyy'
                                            var da = a.split('/');
                                            var db = b.split('/');

                                            var dateA = new Date(da[2], da[1]-1, da[0]);
                                            var dateB = new Date(db[2], db[1]-1, db[0]);

                                            return dateA - dateB;
                                        }
                                    "
                                    rowspan="2">
                                    PCD
                                </th>
                                <th field="gac2"
                                    width="92"
                                    styler="styler1"
                                    sortable="true"
                                    data-options="
                                        editor:{
                                            type:'datebox',
                                            options:{
                                                formatter:myformatter,
                                                parser:myparser,
                                                validType:'maxTahun',
                                                onShowPanel:function(){
                                                    $(this).datebox('calendar').calendar({validator:tahunTglValid});
                                                }
                                            }
                                        },
                                        sorter:function(a,b){
                                            if(!a) return -1;
                                            if(!b) return 1;

                                            // a dan b = 'dd/MM/yyyy'
                                            var da = a.split('/');
                                            var db = b.split('/');

                                            var dateA = new Date(da[2], da[1]-1, da[0]);
                                            var dateB = new Date(db[2], db[1]-1, db[0]);

                                            return dateA - dateB;
                                        }
                                    "
                                    rowspan="2">
                                    Ex Factory
                                </th>
					<th field="secsz" width="95" sortable="true" rowspan="2" styler="styler1" editor="{type:'textbox'}">Sec.Size</th>
					<?php //if ($dth['bdownpk'] > 0) { ?>
						<!-- <th colspan="20" width="1800"><b>Quantity / Size</b></th> -->
					<?php //} else { ?>
					<th colspan="<?php echo $batasKolom; ?>" width="1800"><b>Quantity / Size</b></th>
					<?php //} ?>
					<th field="tot" width="100" sortable="false" rowspan="2">Total</th>
				</tr>
				<tr>
					<?php 
					for($i = 1; $i <= $batasKolom; $i++) {
					?>
					<th field="s<?php echo $i; ?>" width="60" styler="styler1" sortable="false" editor="{type:'textbox'}" 
					<?php //echo $hiddens[$i]; ?>> </th>
					<?php } ?>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div class="header" id="myHeader" onclick="" style="display:none;">
	<div class="delete">
		<a href="javascript:void(0)" id="edit" plain="true" onclick="edit();" style="color: #FFFFFF; text-decoration: none;"> Edit </a>
		<a href="javascript:void(0)" id="save" plain="true" onclick="save();" style="color: #FFFFFF; text-decoration: none;"> Save </a>
		<a href="javascript:void(0)" id="save2" plain="true" onclick="save2();" style="color: #FFFFFF; text-decoration: none;"> Savee </a>
	</div>
	<div class="delete" style="width:auto;">
		<a href="javascript:void(0)" id="savenew1" class="d-none" plain="true" onclick="" style="color: #FFFFFF; text-decoration: none;opacity: 0.5;"> Save Change </a>
		<a href="javascript:void(0)" id="savenew2" class="d-none" plain="true" onclick="save_confirm();" style="color: #FFFFFF; text-decoration: none;"> Save Change </a>
	</div>
	<div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="cancel();" style="color: #FFFFFF; text-decoration: none;display:none;"> Cancel </a></div>
	<div id="ckcount" style="display:none;color:#FFFFFF;margin-right:auto;align-self:center;"></div>
	<div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="delqty();" id="delrowbtn" style="color: #FFFFFF; text-decoration: none;">Delete Row</a></div>
	<div class="delete" id="mdeleteqty" style="width:auto;display:none;"><a href="javascript:void(0)" plain="true" onclick="delqty_bulk();" style="color: #FFFFFF; text-decoration: none;">Delete Row</a></div>
	<div class="delete" id="mcopyqty" style="width:auto;display:none;"><a href="javascript:void(0)" plain="true" onclick="copyRowQty();" style="color: #FFFFFF; text-decoration: none;">Copy</a></div>
	<div class="delete" id="mreplaceqty" style="width:auto;display:none;"><a href="javascript:void(0)" plain="true" onclick="openReplaceDialog();" style="color: #FFFFFF; text-decoration: none;">Replace</a></div>
	<div class="delete" id="mcancopyqty" style="width:auto;display:none;"><a href="javascript:void(0)" plain="true" onclick="cancelCopyQty();" style="color: #FFFFFF; text-decoration: none;">Cancel Copy</a></div>
	<div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="$('#dg').datagrid('clearChecked'); closemenu();" style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
</div>

<!--export excel-->
<div id="dialog-formb" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:true,modal:true,closable:false"
	style="width:425px;height:200px;padding:5px 5px;display:none;top:50px;border-radius:8px;">
	<form id="formb" method="post" enctype="multipart/form-data">
		<input type="hidden" name="ordpk" id="ordpkexp" size="8">
		<!-- <div class="modal-dialog" style="height:175px;"> -->
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<div class="modal-title" style="width:auto;font-size:18px;line-height:20px;">
					Print Breakdown Order no. <span id="ordnoexp"></span> <br>
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

<!--upload1-->
<div id="dialog-form" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:525px;height:250px;padding:5px 5px;display:none;top:20%;border-radius:8px;">
	<form id="form" method="post" enctype="multipart/form-data">
		<input type="hidden" name="ordpk" id="ordpkexp2" size="8">
		<div class="modal-content">
			<div class="modal-header">
				<div style="padding:10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">Update order breakdown
					<span id="ordnoexp2" style="border:none;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px"></span>
				</div>
			</div>

			<div class="border-modal" style="width:90%; height:auto;top:50px;">
				<div style="padding:5px;">
					<input name="uploadfile" id="uploadfile" class="easyui-filebox" style="width:100%;"
						data-options="
							buttonText:'Upload order excel file',
							buttonAlign:'left',
  							label:'',
  							labelPosition: '',
  							labelWidth:'',
							required:'true',
  							validType:''">
				</div>
				<div style="padding:10px;">
					<img src="css/images/xls.png" style="width:18px; height:18px;">
					<span id="filenm"></span>
				</div>
			</div>
			
			<div class="font-excel-template" style="width:auto; top:140px;">
				<a href="excel/excel_bqty?ord=<?php echo $ord; ?>"
					target="_blank" style="font-size:14px;line-height:18px;text-decoration:none;color:#359DD9;">
					Download order breakdown template </a><br>
				<span style="color:red; font-style: italic; font-size:12px;line-height:16px;">(template sesuai breakdown id)</span>
			</div>
			<a style="text-decoration:none; left: 250px; top: 200px;" href="javascript:void(0)"
				class="button-cancel" onclick="cancelupload();">Cancel</a>
			<a id="submit1" style="text-decoration:none; left: 340px; top: 200px; width:150px;display:none;" href="javascript:void(0)"
				class="button-submit" onclick="consaveupload();">Submit</a>
			<a id="submit2" style="text-decoration:none; left: 340px; top: 200px; width:150px;background-color:#BDBDBD;color:#FFFFFF;" href="javascript:void(0)"
				class="button-submit">Submit</a>
	</form>
</div>

	<!--upload1-->
	<div id="dialog-form2" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:false,modal:true,closable:false"
		style="width:525px;height:350px;padding:5px;display:none;top:20%;border-radius:8px;">
		<form id="form2" method="post" enctype="multipart/form-data">
			<input type="hidden" name="ordpk" id="ordpkupload">
			<!-- <div class="modal-dialog" style="width:98%; height:96%;"> -->
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div style="padding:10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">Add order breakdown
						<span id="ordnoupload" style="border:none;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px"></span>
					</div>
				</div>
			</div>
			<!-- Modal body -->
			<div class="border-modal" style="width:90%; height:auto; top:50px;">
				<div style="padding:5px;">
					<input name="uploadfile" id="uploadfile2" class="easyui-filebox" style="width:100%;"
						data-options="
								buttonText:'Upload order excel file',
								buttonAlign:'left',
								label:'',
								labelPosition: '',
								labelWidth:'',
								required:'true',
								validType:''">
				</div>
				<div style="padding:10px;">
					<img src="css/images/xls.png" style="width:18px; height:18px;">
					<span id="filenm2"></span>
				</div>
			</div>
			<div class="font-excel-template" style="width:auto; top:140px;">
				<a href="action/file_RKB_new_update_SecSize2.xlsx" target="_blank" style="font-size:14px;line-height:18px;text-decoration:none;color:#359DD9;">
					Download order breakdown template </a><br>
				<span style="color:red; font-style: italic; font-size:12px;line-height:16px;">
					(default upload template)
				</span>
				<br><br>
				<div style="font-size:14px;line-height:24px;text-decoration:none;color:#000000;">Apa yang ingin anda lakukan?<br>
					<select class="easyui-combobox" style="width:460px; height:28px;" name="typeupload" id="typeupload2"
						data-options="panelHeight:'auto'">
						<option value="1">Tambahkan data baru yang saya upload kepada order.</option>
						<option value="2">Replace data yang ada di order dengan data baru yang saya upload.</option>
					</select>
				</div>
			</div>
			<a style="text-decoration:none; left: 250px; top: 270px;" href="javascript:void(0)"
				class="button-cancel" onclick="cancelupload2();">Cancel</a>
			<a id="submit1a" style="text-decoration:none; left: 340px; top: 270px; width:150px;display:none;" href="javascript:void(0)"
				class="button-submit" onclick="consaveupload2();">Submit</a>
			<a id="submit2a" style="text-decoration:none; left: 340px; top: 270px; width:150px;background-color:#BDBDBD;color:#FFFFFF;" href="javascript:void(0)"
				class="button-submit">Submit</a>
		</form>
	</div>


<!-- konfirmasi upload -->
<div id="dialog-conupload" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:387px;height:200px;padding:5px;gap:20px;display:none;top:20%;border-radius:8px;">
	<form id="form-upload" method="post">
		<input type="hidden" name="ordpk" value="<?php echo $_GET['ord']; ?>" size="8">
		<div style="padding: 10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">Konfirmasi Release Perubahan</div>
		<div style="padding: 10px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
			Perubahan Anda di order breakdown akan diteruskan ke Produksi. Apakah Anda mau melakukan perubahan?
		</div>
		<a style="text-decoration:none; left: 150px; top: 150px;width:100px;" href="javascript:void(0)"
			class="button-cancel" onclick="canconupload();">Cancel</a>
		<a style="text-decoration:none; left: 250px; top: 150px;width:100px;" href="javascript:void(0)"
			class="button-submit" onclick="saveupload();">Confirm</a>
	</form>
</div>

<div id="dialog-conupload2" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:387px;height:200px;padding:5px;gap:20px;display:none;top:20%;border-radius:8px;">
	<form id="form-upload2" method="post">
		<input type="hidden" name="ordpk" value="<?php echo $_GET['ord']; ?>" size="8">
		<div style="padding: 10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">Konfirmasi Release Perubahan</div>
		<div style="padding: 10px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
			Perubahan Anda di order breakdown akan diteruskan ke Produksi. Apakah Anda mau melakukan perubahan?
		</div>
		<a style="text-decoration:none; left: 150px; top: 150px;width:100px;" href="javascript:void(0)"
			class="button-cancel" onclick="canconupload2();">Cancel</a>
		<a style="text-decoration:none; left: 250px; top: 150px;width:100px;" href="javascript:void(0)"
			class="button-submit" onclick="saveupload2();">Confirm</a>
	</form>
</div>

<!-- konfirmasi sync -->
<div id="dialog-release2" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:373px;height:179px;padding:5px;gap:20px;display:none;top:20%;border-radius:8px;">
	<div style="padding: 10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">
		Order sudah release ke produksi.</div>
	<div style="padding: 10px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
		Order ini telah dikirimkan ke produksi pada <br>tanggal <span id="dateprod"></span>
	</div>
	<a style="text-decoration:none; left: 250px; top: 130px;width:100px;" href="javascript:void(0)"
		class="button-submit" onclick="canrelease2();">Kembali</a>
	</form>
</div>

<!-- konfirmasi release -->
<div id="dialog-release" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:387px;height:250px;padding:5px;gap:20px;display:none;top:30%;border-radius:8px;">
	<div style="padding: 10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;color:#EF3B42">Missing info</div>
	<div style="padding: 10px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
		Ada beberapa informasi yang belum lengkap untuk bisa meneruskan order ke produksi:<br><br>
		<span id="notetotal" style="color: #EF3B42;display:none;"></span><br>
		<span id="notebdown" style="color: #EF3B42;display:none;"></span><br>
		<span id="notecost" style="color: #EF3B42;display:none;"></span>
	</div>
	<a style="text-decoration:none; left: 250px; top: 200px;width:100px;" href="javascript:void(0)"
		class="button-submit" onclick="canrelease();">Kembali</a>
</div>

<div id="dialog-conrelease" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:415px;height:250px;padding:5px;gap:20px;display:none;top:30%;border-radius:8px;">
	<form id="form-release" method="post">
		<input type="hidden" name="ordpk" value="<?php echo $_GET['ord']; ?>" size="8">
		<div style="padding: 10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">Konfirmasi Release</div>
		<div style="padding: 10px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
			Order ini akan diteruskan ke produksi untuk scheduling. Silahkan klik click confirm untuk konfirmasi release order,
			action ini tidak bisa di-undo.
		</div>
		<!-- <div style="padding: 10px;font-size:14px;line-height:24px;text-decoration:none;color:#000000;">
			<select class="easyui-combobox" style="width:185px; height:34px;" name="lokasi"
				id="lokasi" data-options="panelHeight:'auto'">
				<option value="0">Pilih Lokasi</option>
				<option value="1">MIF 1</option>
				<option value="2">MIF 2</option>
				<option value="3">MIF 1 & 2</option>
			</select>
		</div> -->
		<a style="text-decoration:none; left: 150px; top: 200px;width:100px;" href="javascript:void(0)"
			class="button-cancel" onclick="canrelease3();">Cancel</a>
		<a style="text-decoration:none; left: 250px; top: 200px;width:100px;" href="javascript:void(0)"
			class="button-submit" onclick="saverelease();">Confirm</a>
	</form>
</div>

<!-- Edit Lokasi -->
<div id="dialog-conrelease2" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:415px;height:200px;padding:5px;gap:20px;display:none;top:30%;border-radius:8px;">
	<form id="form-lokasi" method="post">
		<input type="hidden" name="ordpk" id="ordpk" value="<?php echo $_GET['ord']; ?>" size="8">
		<div style="padding: 10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">Edit Lokasi</div>
		<?php
			$dtlok = mysqli_fetch_array(mysqli_query($koneksi, "SELECT mif FROM ord WHERE ordpk='$_GET[ord]'"));
			$mif = $dtlok['mif'] ?? 0;
		?>
			<div style="padding: 10px;font-size:14px;line-height:24px;text-decoration:none;color:#000000;">
			    <select class="easyui-combobox" style="width:185px; height:34px;" name="lokasi2" id="lokasi2"
					data-options="panelHeight:'auto'">
					<option value="0" <?php echo $mif == 0 ? 'selected' : ''; ?>>Pilih Lokasi</option>
					<option value="1" <?php echo $mif == 1 ? 'selected' : ''; ?>>MIF 1</option>
					<option value="2" <?php echo $mif == 2 ? 'selected' : ''; ?>>MIF 2</option>
					<option value="3" <?php echo $mif == 3 ? 'selected' : ''; ?>>MIF 1 & 2</option>
				</select>
			</div>
		<a style="text-decoration:none; left: 150px; top: 150px;width:100px;" href="javascript:void(0)"
			class="button-cancel" onclick="cancel_edit_lokasi()">Cancel</a>
		<a style="text-decoration:none; left: 250px; top: 150px;width:100px;" href="javascript:void(0)"
			class="button-submit" onclick="onConfirm_update_lokasi()">Confirm</a>
	</form>
</div>

<div id="dialog-formhistory" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:750px;height:450px;padding:5px 5px;display:none;top:15%;border-radius:8px;">
	<div id="close" style="margin-top:0px; margin-left:700px;">
		<a id="close" href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#00000099;; font-size:35px;"
			onclick="$('#dialog-formhistory').dialog('close');">&#215;</a>
	</div>
	<div style="margin-left: 15px;margin-top: -20px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">
		Order Breakdown History Log</div>
	<style>
		.lines-no3 .datagrid-body td {
			border-right: 2px solid #FFFFFF;
			border-bottom: 2px solid #FFFFFF;
		}
	</style>
	<div style="margin-top: 15px;margin-left:15px;">
		<table id="dg2c" class="easyui-datagrid" title="" style="width:98%;height:350px;" align="center" border="none" striped="false"
			data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,border:true,autoRowHeight:true">
			<thead>
				<tr>
					<th field="datelog" width="200" style="border:none;">Date of edit</th>
					<th field="action" width="500">Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<!--Alert Data tidak disimpan-->
<div id="dialog-form-simpan" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:411px;height:184px;padding:5px 5px;display:none;top:20%;border-radius:8px;">
	<div style="padding-left:16px;padding-top:16px;font-size: 18px;font-weight: 700;line-height: 24px;">Ada data tidak tersimpan</div>
	<div style="padding-left:16px;padding-top:16px;padding-right:16px;font-size: 14px;font-weight: 400;line-height: 18px;">Perubahan yang telah Anda lakukan belum tersimpan. Apakah Anda ingin menyimpan perubahan?</div>
	<div style="padding-top:35px;padding-left:16px">
		<button style="height: 34px;padding: 8px;justify-content: center;align-items: center;gap: 8px;align-self: stretch;border:1px solid #FF3232; border-radius: 8px;
		background: #FF3232;color:#FFFFFF;cursor:pointer;" onclick="cancel_perubahan();">Cancel Perubahan</button>
		<button style="margin-left:25%;height: 34px;padding: 8px;justify-content: center;align-items: center;gap: 8px;align-self: stretch;border:none;
		cursor:pointer;background: #FFFFFF;color:#000000;" onclick="kembali();">Kembali</button>
		<button id="simpan_confirm1" class="d-none" style="height: 34px;padding: 8px;justify-content: center;align-items: center;gap: 8px;align-self: stretch;border:none; border-radius: 8px;
		background:rgb(172, 171, 171);color:#FFFFFF;" onclick="">Simpan</button>
		<!-- <button id="simpan_confirm2" class="d-none" style="height: 34px;padding: 8px;justify-content: center;align-items: center;gap: 8px;align-self: stretch;border:1px solidrgb(0, 0, 0); border-radius: 8px;
		background:rgb(0, 0, 0);color:#FFFFFF;cursor:pointer;" onclick="saverow();">Simpan</button> -->
		<button id="simpan_confirm2" class="d-none" style="height: 34px;padding: 8px;justify-content: center;align-items: center;gap: 8px;align-self: stretch;border:1px solidrgb(0, 0, 0); border-radius: 8px;
		background:rgb(0, 0, 0);color:#FFFFFF;cursor:pointer;" onclick="save_confirm(); $('#dialog-form-simpan').dialog('close');">Simpan</button>
	</div>
</div>

<!--Confirm save-->
<div id="dialog-form-confirm-simpan" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:387px;height:200px;padding:5px;gap:20px;display:none;top:20%;border-radius:8px;">
	<!-- <form id="form-upload" method="post"> -->
	<!-- <input type="hidden" name="ordpk" value="<?php //echo $_GET['ord']; 
													?>" size="8"> -->
	<div style="padding: 10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">Konfirmasi Release Perubahan</div>
	<div style="padding: 10px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
		Perubahan Anda di order breakdown akan diteruskan ke Produksi. Apakah Anda mau melakukan perubahan?
	</div>
	<a style="text-decoration:none; left: 150px; top: 150px;width:100px;" href="javascript:void(0)"
		class="button-cancel" onclick="kembali2();">Cancel</a>
	<a style="text-decoration:none; left: 250px; top: 150px;width:100px;" href="javascript:void(0)"
		class="button-submit" onclick="save_confirm2();">Confirm</a>
	<!-- </form> -->
</div>

<!--Confirm delete-->
<div id="dialog-form-confirm-delete" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:387px;height:200px;padding:5px;gap:20px;display:none;top:20%;border-radius:8px;">
	<!-- <form id="form-upload" method="post"> -->
	<!-- <input type="hidden" name="ordpk" value="<?php //echo $_GET['ord']; 
													?>" size="8"> -->
	<div style="padding: 10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">Konfirmasi Release Perubahan</div>
	<div style="padding: 10px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
		Perubahan Anda di order breakdown akan diteruskan ke Produksi. Apakah Anda mau melakukan perubahan?
	</div>
	<a style="text-decoration:none; left: 150px; top: 150px;width:100px;" href="javascript:void(0)"
		class="button-cancel" onclick="kembali2();">Cancel</a>
	<a style="text-decoration:none; left: 250px; top: 150px;width:100px;" href="javascript:void(0)"
		class="button-submit" onclick="delqty2();">Confirm</a>
	<!-- </form> -->
</div>

<!--Replace column select-->
<div id="dialog-form-replace" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:387px;height:290px;padding:5px;gap:20px;display:none;top:20%;border-radius:8px;">
	<div style="padding: 10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">Pilih kolom yang akan di-replace</div>
	<div style="padding: 10px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
		<label style="display:block;margin-bottom:12px;cursor:pointer;"><input type="checkbox" id="rpfob"> FOB <span id="rpfobval" style="color:rgba(0,0,0,0.6);"></span></label>
		<label style="display:block;margin-bottom:12px;cursor:pointer;"><input type="checkbox" id="rpgac"> Ex Factory <span id="rpgacval" style="color:rgba(0,0,0,0.6);"></span></label>
		<label style="display:block;margin-bottom:12px;cursor:pointer;"><input type="checkbox" id="rppcd"> PCD <span id="rppcdval" style="color:rgba(0,0,0,0.6);"></span></label>
	</div>
	<a style="text-decoration:none; left: 150px; top: 250px;width:100px;" href="javascript:void(0)"
		class="button-cancel" onclick="$('#dialog-form-replace').dialog('close');">Cancel</a>
	<a style="text-decoration:none; left: 250px; top: 250px;width:100px;" href="javascript:void(0)"
		class="button-submit" onclick="saveReplaceQty();">Confirm</a>
</div>
<!-- <div id="dialog-form-confirm-simpan" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:411px;height:184px;margin-top:15%;padding:5px 5px;display:none;top:15px;border-radius:8px;">
	<div style="padding-left:16px;padding-top:16px;font-size: 18px;font-weight: 700;line-height: 24px;">Konfirmasi Release Perubahan</div>
	<div style="padding-left:16px;padding-top:16px;padding-right:16px;font-size: 14px;font-weight: 400;line-height: 18px;">Perubahan Anda di order breakdown akan diteruskan ke Produksi. Apakah Anda mau melakukan perubahan?</div>
	<div style="padding-top:35px;margin-left:45%;">
		<button style="margin-left:25%;height: 34px;padding: 8px;justify-content: center;align-items: center;gap: 8px;align-self: stretch;border:none;
		cursor:pointer;background: #FFFFFF;color:#000000;" onclick="kembali2();">Cancel</button>
		<button style="height: 34px;padding: 8px;justify-content: center;align-items: center;gap: 8px;align-self: stretch;border:1px solidrgb(0, 0, 0); border-radius: 8px;
		background:rgb(0, 0, 0);color:#FFFFFF;cursor:pointer;" onclick="save_confirm2();">Confirm</button>
	</div>
</div> -->

<script type="text/javascript">
	window.onscroll = function() {
		myFunction();
	};
	var header = document.getElementById("myHeader");
	var sticky = header.offsetTop;

	function myFunction() {
		if (window.pageYOffset > sticky) {
			header.classList.add("sticky");
		} else {
			header.classList.remove("sticky");
		}
	}
</script>