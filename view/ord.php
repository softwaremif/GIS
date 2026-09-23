<?php
// include "email/emailcut.php";

// $sql = mysqli_query($koneksi, "select po.suppk, po.polipk from po
// left outer join sup on sup.suppk=po.suppk
// left outer join podt on podt.popk=po.popk
// left outer join ord on ord.ordpk=podt.ordpk
// where po.suppk>0 and po.polipk>0 and YEAR(po.tglpo)='$thn2' and ord.fupk='$_SESSION[fu]' and sup.local='0'
// group by po.suppk order by po.suppk desc");
// while ($dt = mysqli_fetch_array($sql)) {
// 	//$sql2=mysqli_query($koneksi,"select suppk,polipk from po where suppk='$dt[suppk]' order by popk desc limit 1");
// //$dt2=mysqli_fetch_array($sql2);
// 	$update = mysqli_query($koneksi, "update sup set local='$dt[polipk]' where suppk='$dt[suppk]'");
// }
?>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="media/bootstrap-5.3.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="media/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
	<style type="text/css">
		body {
			/* font-family: "Arial"; */
		}

		.tooltip {
			position: absolute;
			display: inline-block;
			border: none;
			background-color: transparent;
			margin-top: -15px;
			margin-left: -10px;
			z-index: 3;
		}

		.tooltip .tooltiptext {
			visibility: hidden;
			width: 182px;
			height: auto;
			color: #fff;
			text-align: left;
			border-width: 1px 1px 1px 1px;
			border-style: solid;
			border-color: #E0E0E0;
			padding: 5px 0;
			left: -180px;
			top: -67px;
			/* Position the tooltip */
			position: absolute;
			z-index: 1;
			background: #FFFFFF;
			box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);
		}

		.tooltip:hover .tooltiptext {
			visibility: visible;
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

		.dropbtn2x {
			background-color: #3498DB;
			color: white;
			padding: 16px;
			font-size: 16px;
			/* margin-left: -400px; */
			border: none;
			cursor: pointer;
		}

		.dropbtn2x:hover,
		.dropbtn2x:focus {
			background-color: #2980B9;
		}

		.dropdown1x {
			position: relative;
			display: inline-block;
		}

		.dropdown2x {
			position: relative;
			display: inline-block;
		}

		.dropdown1-content1x {
			display: none;
			position: absolute;
			background-color: #FFFFFF;
			min-width: 250px;
			overflow: auto;
			/* margin-left: -250px; */
			margin-top: 10px;
			box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
			z-index: 1;
			text-align: left;
		}

		.dropdown1-content1x a {
			color: black;
			padding: 5px;
			text-decoration: none;
			display: block;
		}

		.dropdown2-content2x {
			display: none;
			position: absolute;
			background-color: #FFFFFF;
			min-width: 235px;
			overflow: auto;
			/* margin-left: -250px; */
			margin-top: 10px;
			box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
			z-index: 1;
			text-align: left;
		}

		.dropdown2-content2x a {
			color: black;
			padding: 5px;
			text-decoration: none;
			display: block;
		}

		.dropdown1x a:hover {
			background-color: #ddd;
		}

		.dropdown2x a:hover {
			background-color: #ddd;
		}

		.show {
			display: block;
		}

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

		.datagrid-body {
			/* overflow-x:hidden; */
			/* overflow-y:hidden; */
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

		.lines-no3 .datagrid-body td {
			border-right: 1px dotted transparent;
			border-bottom: 1px dotted transparent;
		}

		.suggestions-container {
			position: absolute;
			width: 185px;
			/* border: 0px solid #ccc; */
			max-height: 85px;
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

		.border-modal3 {
			box-sizing: border-box;
			background: #FFFFFF;
			border: 1px dashed #000000;
			border-radius: 8px;
		}
	</style>

	<script type="text/javascript">
		$(window).scroll(function() {
			checkScroll();
		});

		var url;
		/*menu*/
		function menu() {
			var row = $('#dg').datagrid('getSelected');
			if (row) {
				$('#myHeader').show();
				/*count_row();*/
			} else {
				$('#myHeader').hide();
				//$('#dg').datagrid('clearSelections');
			}
		}

		// function menu2(){
		// 	var row = $('#dg').datagrid('getSelected');
		// 	if(row){
		// 	$('#myHeader').hide();
		// 	detail2();
		// 	} else {
		// //$('#dg').datagrid('clearSelections');
		// 	}
		// }

		function myFunction1x() {
			document.getElementById("myDropdown1x").classList.toggle("show");
		}

		function myFunction2x() {
			document.getElementById("myDropdown2x").classList.toggle("show");
		}

		window.onclick = function(event) {
			if (!event.target.matches('.dropbtn1x')) {
				var dropdowns = document.getElementsByClassName("dropdown1-content1x");
				var i;
				for (i = 0; i < dropdowns.length; i++) {
					var openDropdown = dropdowns[i];
					if (openDropdown.classList.contains('show')) {
						openDropdown.classList.remove('show');
					}
				}
			}
		}

		window.onclick = function(event) {
			if (!event.target.matches('.dropbtn2x')) {
				var dropdowns = document.getElementsByClassName("dropdown2-content2x");
				var i;
				for (i = 0; i < dropdowns.length; i++) {
					var openDropdown = dropdowns[i];
					if (openDropdown.classList.contains('show')) {
						openDropdown.classList.remove('show');
					}
				}
			}
		}

		$(function() {
			if (performance.navigation.type == 1) {
				console.log("Halaman di-refresh");
				// window.location.href = "?hal=order";
				$('#cari1').val('');
				$('#cari2').val('');
				$('#cari3').val('');
				$('#cari7').val('');
				$('#cari8').val('');
			} else {
				console.log("Halaman tidak di-refresh");
				Search();
			}

			$('#dg').datagrid('getPanel').find('div.datagrid-header').css('background', '#FFFFFF');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-top', '1px solid #858585');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-top-left-radius', '8px');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-bottom', '1px solid #858585');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-bottom-left-radius', '8px');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-top-right-radius', '8px');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-bottom-right-radius', '8px');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-left', '1px solid #858585');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-right', '1px solid #858585');
			$('#dg').datagrid('getPanel').find('div.datagrid-header td[field]').css('border-right', 'none');
			$('#dg').datagrid('getPanel').find('div.datagrid-header').addClass('lines-no');
			$('#dg').datagrid('getPanel').find('div.datagrid-header').addClass('lines-no3');
			$('#dg').datagrid('getPanel').find('div.datagrid-header').addClass('col');
			$('#dg').datagrid('getPanel').addClass('lines-no');
			$('#dg').datagrid('getPanel').addClass('lines-no3');
			//   $('#dg').datagrid('getPanel').addClass('col');

			$('#cari8').combobox({
				onSelect: function(rec) {
					// alert(rec.deppk);
					var cari2 = $('#cari2').val();
					var cari3 = $('#cari3').val();
					var cari7 = $('#cari7').val();
					var cari8 = $('#cari8').val();

					//   var url1 = 'view/get_data.php?dt=md&thn='+cari8;
					//   $('#cari7').combobox('reload', url1);

					var url2 = 'view/get_data.php?dt=byr&md=' + cari7 + '&thn=' + rec.value;
					$('#cari2').combobox('reload', url2);

					var url3 = 'view/get_data.php?dt=season&md=' + cari7 + '&byr=' + cari2 + '&thn=' + rec.value;
					$('#cari3').combobox('reload', url3);

					$('#expthn').combobox('setValue', rec.value);
					console.log('Nilai combobox setelah disetel:', $('#expthn').val());

					$('#expthn2').combobox('setValue', rec.value);
					console.log('Nilai combobox setelah disetel:', $('#expthn2').val());

					$('#expthn3').combobox('setValue', rec.value);
					console.log('Nilai combobox setelah disetel:', $('#expthn3').val());

					$('#expthn4').combobox('setValue', rec.value);
					console.log('Nilai combobox setelah disetel:', $('#expthn4').val());
				}
			});

			$('#cari7').combobox({
				onSelect: function(rec) {
					// alert(rec.deppk);
					var cari2 = $('#cari2').val();
					var cari3 = $('#cari3').val();
					var cari7 = $('#cari7').val();
					var cari8 = $('#cari8').val();

					var url2 = 'view/get_data.php?dt=byr&md=' + rec.userpk + '&thn=' + cari8;
					$('#cari2').combobox('reload', url2);

					var url3 = 'view/get_data.php?dt=season&md=' + rec.userpk + '&byr=' + cari2 + '&thn=' + cari8;
					$('#cari3').combobox('reload', url3);
				}
			});

			$('#cari2').combobox({
				onSelect: function(rec) {
					// alert(rec.deppk);
					var cari2 = $('#cari2').val();
					var cari3 = $('#cari3').val();
					var cari7 = $('#cari7').val();
					var cari8 = $('#cari8').val();

					var url3 = 'view/get_data.php?dt=season&md=' + cari7 + '&byr=' + rec.byrpk + '&thn=' + cari8;
					$('#cari3').combobox('reload', url3);
				}
			});

			// $('#dl').datalist({
			// url: 'datalist_data1.json',
			// checkbox: true,
			// lines: true
			// });

			srcbyr();
			srcprodes();
			srcseason();

			$('#dg2').datagrid({
				onLoadSuccess: function(data) {
					var tcount = JSON.stringify($('#dg2').datagrid('getData').total);
					console.log("data total dg2 : " + tcount);

					settingTableHeight(tcount);
				},
			})

		});

		function checkScroll() {
			var scrollYPosition = window.pageYOffset;

			var scroll = {};
			scroll.scrollYPosition = scrollYPosition;
			localStorage.setItem('scroll', JSON.stringify(scroll));
			// localStorage.setItem('scroll', JSON.stringify(scroll));
		}


		function add() {
			// var spv = document.getElementById("spv").value;
			// if (spv == 1) {
			// canceladd();
			// $('#dialog-form3').dialog('open').dialog('setTitle', '');
			$('#dg').datagrid('clearSelections');
			$('#form-add').form('reset');
			$('#dialog-form-add').dialog('open').dialog('setTitle', '');
			setCover();
			checkImages();
			resetImage();
			$('#btn-close-first').show();
			$('#btn-close-second').hide();

			// } else {
			// 	$.messager.alert('Warning', 'You are not allowed to add order, please contact your supervisor', 'warning');
			// }
		}

		function canceladd() {
			var ordpk = parseInt($('#ordpkcreate').val());
			var formData = new FormData();
			formData.append('ordpk', ordpk);
			$.ajax({
				url: "action/delete.php?x=orderimg",
				method: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					console.log("success save data style here >>>>> " + JSON.stringify(response));
					document.getElementById('countImages').value = 0;
					document.getElementById('ordpkcreate').value = "";
					document.getElementById('ordpkimg').value = "";
					document.getElementById('gbr1').value = "";
					document.getElementById('gbr2').value = "";
					$('#dialog-form-add').dialog('close');
					$('#form-add').form('reset');
					// $('#form-edit').form('reset');
					removesradd();
					$('#multi').hide();
				},
				error: function(xhr, status, error) {
					console.error("Error: " + error);
				}
			});
		}

		function save1() {
			$.messager.progress({
				title: '',
				msg: 'Upload in progress...',
				border: 'thin'
			});
			var string = $("#form").serialize();
			$('#form').form('submit', {
				type: "POST",
				url: "action/simpan_master2.php",
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
					$('#dialog-conupload').dialog('close');
					$('#form').form('reset');
					$('#dialog-form').dialog('close');
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

		function save2() {
			$.messager.progress({
				title: '',
				msg: 'Upload in progress...',
				border: 'thin'
			});
			var string = $("#form2").serialize();
			$('#form2').form('submit', {
				type: "POST",
				url: "action/simpan_master2.php",
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
					$('#form2').form('reset');
					$('#dialog-form2').dialog('close');
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
					/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
					$('#dg').datagrid('reload');
				}
			});
		}

		function saveedt() {
			$.messager.progress({
				title: '',
				msg: 'Upload in progress...',
				border: 'thin'
			});
			var string = $("#form-update").serialize();
			$('#form-update').form('submit', {
				type: "POST",
				url: "action/simpan_bqty.php",
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
					$('#form-update').form('reset');
					$('#dialog-update').dialog('close');
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
					/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
					$('#dg').datagrid('reload');
				}
			});
		}

		function canconupload() {
			$('#dialog-conupload').dialog('close');
			// $('#dialog-form').dialog('close');
			// $('#form').form('reset');
			// $('#submit2a').show();
			// $('#submit1a').hide();
		}

		function consaveupload() {

			var ordpk = $('#ordpkupload').val();
			$.ajax({
				type: "POST",
				url: "view/get_dataord.php?x=ord&ordpk=" + ordpk,
				dataType: "json",
				success: function(data) {

					if (data.stsprod == 1) {
						$('#dialog-conupload').dialog('open').dialog('setTitle', '');
					} else {
						save1();
					}
				},
			});
		}

		function cancel1() {
			$('#dialog-form').dialog('close');
			$('#dg').datagrid('clearSelections');
			$('#form').form('reset');
			$('#submit2a').show();
			$('#submit1a').hide();
		}

		function cancel2() {
			$('#dialog-form2').dialog('close');
			$('#dg').datagrid('clearSelections');
			$('#form2').form('reset');
			$('#submit2b').show();
			$('#submit1b').hide();
		}

		function cancel3() {
			$('#dialog-form2b').dialog('close');
			$('#dg').datagrid('clearSelections');
			$('#form2b').form('reset');
			$('#submit2c').show();
			$('#submit1c').hide();
		}

		function canceledt() {
			$('#dialog-update').dialog('close');
			$('#dg').datagrid('clearSelections');
			$('#form-update').form('reset');
			$('#submit2d').show();
			$('#submit1d').hide();
		}

		function delorder(ordpk) {
			var row = $('#dg').datagrid('getSelected');
			var spv = document.getElementById("spv").value;
			if (spv == 1) {
				$.messager.confirm({
					title: 'Confirm',
					msg: 'Are you sure you want to delete this order ' + row.ordno + ' ? ',
					ok: 'Ok',
					cancel: 'Cancel',
					fn: function(r) {
						if (r) {
							$.ajax({
								type: "POST",
								url: "action/delete.php?x=order",
								data: 'id=' + ordpk,
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
									$('#dg').datagrid('reload');
								}
							});
						}
					}
				});
			} else {
				$.messager.alert('Warning', 'You are not allowed to delete this order, please contact your supervisor', 'warning');
			}
		}

		function update(index) {
			var a = $('#dg').datagrid('selectRow', index)
			if (a) {
				var row = $('#dg').datagrid('getSelected');

				if (row) {
					$('#dialog-form').dialog('open').dialog('setTitle', '');
					$('#form').form('load', row);
				} else {
					$.messager.alert('Warning', 'No order data selected', 'warning');
				}
			}
		}

		function update2() {
			$('#dialog-form2').dialog('open').dialog('center');
		}

		function multiple1() {
			$('#dialog-update').dialog('open').dialog('center');
		}

		function costing() {
			$('#dialog-form2b').dialog('open').dialog('setTitle', '');
			//$('#form2').form('load',row);
		}

		function savecost() {
			$.messager.progress({
				title: '',
				msg: 'Upload in progress...',
				border: 'thin'
			});
			var string = $("#form2b").serialize();
			$('#form2b').form('submit', {
				type: "POST",
				url: "action/simpan_cost.php",
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
					$('#form2b').form('reset');
					$('#dialog-form2b').dialog('close');
					$.messager.show({
						title: '',
						msg: data,
						timeout: 3000,
						showType: 'slide',
						icon: 'info',
						width: 315,
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

		function detail(ordpk) {
			var cari1 = $('#cari1').val();
			var cari2 = $('#cari2').val();
			var cari3 = $('#cari3').val();
			var cari7 = $('#cari7').val();
			var cari8 = $('#cari8').val();
			window.location.href = "?hal=qty&ord=" + ordpk + "&c1=" + cari1 + "&c2=" + cari2 + "&c3=" + cari3 + "&c7=" + cari7 + "&c8=" + cari8;
			//   window.location.href="?hal=qty&ord="+ordpk;
		}

		function detail3(ordpk) {
			var cari1 = $('#cari1').val();
			var cari2 = $('#cari2').val();
			var cari3 = $('#cari3').val();
			var cari7 = $('#cari7').val();
			var cari8 = $('#cari8').val();
			url = "?hal=qty&ord=" + ordpk + "&c1=" + cari1 + "&c2=" + cari2 + "&c3=" + cari3 + "&c7=" + cari7 + "&c8=" + cari8;
			//   url = "?hal=qty&ord="+ordpk;
			window.open(url);
			//window.location.href="?hal=qty&ord=" +row.ordpk;
		}



		function detail2() {
			var row = $('#dg').datagrid('getSelected');
			// if(row){
			/*if(row.filenm){*/
			/*url = "admin.php?hal=detord&ord=" +row.ordpk;
		  window.open(url);*/
			window.location.href = "?hal=qty&ord=" + row.ordpk;
			/*} else {
			$('#dialog-form').dialog('open').dialog('setTitle','');
			$('#form').form('load',row);	
			}*/
			// } else {
			// $.messager.alert('Warning','No order data selected','warning');
			// }
		}

		function fresh() {
			$('#dg').datagrid('reload');
		}

		function Search() {
			$('#dg').datagrid('load', {
				cari1: $('#cari1').val(),
				cari2: $('#cari2').val(),
				cari3: $('#cari3').val(),
				cari7: $('#cari7').val(),
				cari8: $('#cari8').val()
			});

			$('#dg2').datagrid('load', {
				cari1: $('#cari1').val(),
				cari2: $('#cari2').val(),
				cari3: $('#cari3').val(),
				cari7: $('#cari7').val(),
				cari8: $('#cari8').val()
			});
			srcbyr();
			srcprodes();
			srcseason();

			$('#dg2').datagrid({
				onLoadSuccess: function(data) {
					var tcount = JSON.stringify($('#dg2').datagrid('getData').total);
					console.log("data total dg2 : " + tcount);

					settingTableHeight(tcount);
				},
			})

			$('#dg').datagrid({
				onLoadSuccess: function(data) {
					var returnBack = localStorage.getItem('returnBack');
					var retrievedScrollYData = localStorage.getItem('scroll');
					var parsedScrollYData = retrievedScrollYData ? JSON.parse(retrievedScrollYData) : null;

					if (returnBack) {
						if (parsedScrollYData && parseInt(parsedScrollYData.scrollYPosition) > 0) {
							console.log("parsedScrollYData.scrollYPosition : " + parsedScrollYData.scrollYPosition);

							$('html, body').animate({
								scrollTop: parsedScrollYData.scrollYPosition
							}, 'slow');
						}
						localStorage.removeItem('scroll');
						localStorage.removeItem('returnBack');
					}
				}
			})
		}

		function Search2() {
			$('#dg').datagrid('load', {
				//   cari1: $('#cari1').val(),    
				//   cari2: $('#cari2').val(),
				//   cari3: $('#cari3').val(),
				//   cari7: $('#cari7').val(),
				//   cari8: $('#cari8').val(),
				cari4: $('#cari4').val()
			});
			$('#newest').show();
			$('#oldest').hide();
		}

		function Search3() {
			$('#dg').datagrid('load', {
				//   cari1: $('#cari1').val(),    
				//   cari2: $('#cari2').val(),
				//   cari3: $('#cari3').val(),
				//   cari7: $('#cari7').val(),
				//   cari8: $('#cari8').val(),
				cari5: $('#cari5').val()
			});
			$('#newest').hide();
			$('#oldest').show();
		}

		function Search4() {
			$('#kolom1').datagrid('load', {
				//   cari1: $('#cari1').val(),    
				//   cari2: $('#cari2').val(),
				//   cari3: $('#cari3').val(),
				//   cari7: $('#cari7').val(),
				//   cari8: $('#cari8').val()
				cari6: $('#cari6').val()
			});
		}

		function Search5() {
			$('#prodes').datagrid('load', {
				carispl: $('#carispl').val()
			});
			$('#byr').datagrid('load', {
				carispl: $('#carispl').val()
			});
			$('#season').datagrid('load', {
				carispl: $('#carispl').val()
			});
		}

		function Search2a() {
			$('#dg').datagrid('load', {
				cari1: $('#cari1').val(),
				cari2: $('#cari2').val(),
				cari3: $('#cari3').val(),
				cari7: $('#cari7').val(),
				cari8: $('#cari8').val(),
				cari4: $('#cari4b').val()
			});
			$('#newest').show();
			$('#oldest').hide();
		}

		function Search2b() {
			$('#dg').datagrid('load', {
				cari1: $('#cari1').val(),
				cari2: $('#cari2').val(),
				cari3: $('#cari3').val(),
				cari7: $('#cari7').val(),
				cari8: $('#cari8').val(),
				cari5: $('#cari5b').val()
			});
			$('#newest').hide();
			$('#oldest').show();
		}

		$(function() {
			$('#byr').datagrid({
				onCheck: function(index, row, value) {
					$('#tabel1').css("margin-top", "50px");
					var ckk = $('#byr').datagrid('getRows')[index].byrnm;
					document.getElementById("filtera" + index).value = ckk;
					document.getElementById("idxa" + index).value = index;
					document.getElementById("talla" + index).value = 1;
					$('#filtera' + index).show();
					$('#crossa' + index).show();
					$('#dg').datagrid('load', {
						byr0: $('#filtera0').val(),
						byr1: $('#filtera1').val(),
						prodes0: $('#filterb0').val(),
						prodes1: $('#filterb1').val(),
						season0: $('#filterc0').val(),
						season1: $('#filterc1').val(),
						cari8: $('#cari8').val()
					});
					tall();
					var counta = JSON.stringify($('#dg').datagrid('getData').total);
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
						$('#dg').datagrid('load', {
							byr0: $('#filtera0').val(),
							byr1: $('#filtera1').val(),
							prodes0: $('#filterb0').val(),
							prodes1: $('#filterb1').val(),
							season0: $('#filterc0').val(),
							season1: $('#filterc1').val(),
							cari8: $('#cari8').val()
						});
						document.getElementById("talla" + index).value = 0;
						tall();
						var counta = JSON.stringify($('#dg').datagrid('getData').total);
						document.getElementById("fltr2").innerHTML = counta + " result";
						$('#fltr1').show();
						$('#fltr2').show();
						$('#fltr3').show();
					}
				}
			});
		});

		function uncekbyr2(cross) {
			var total = document.getElementById("total").value;
			if (total == 1) {
				reset();
			} else {
				var c = cross;
				//alert(c);
				var ca = document.getElementById("idxa" + c).value;
				$('#byr').datagrid('unselectRow', ca);
				document.getElementById("carispl").value = "";
				Search5();
				document.getElementById("filtera" + c).value = "";
				document.getElementById("talla" + c).value = 0;
				$('#filtera' + c).hide();
				$('#crossa' + c).hide();
				$('#dg').datagrid('load', {
					byr0: $('#filtera0').val(),
					byr1: $('#filtera1').val(),
					prodes0: $('#filterb0').val(),
					prodes1: $('#filterb1').val(),
					season0: $('#filterc0').val(),
					season1: $('#filterc1').val(),
					cari8: $('#cari8').val()
				});
				document.getElementById("idxa" + c).value = "";
			}
		}

		$(function() {
			$('#prodes').datagrid({
				onCheck: function(index, row, value) {
					$('#tabel1').css("margin-top", "50px");
					var ckk = $('#prodes').datagrid('getRows')[index].prodes;
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
					$('#dg').datagrid('load', {
						byr0: $('#filtera0').val(),
						byr1: $('#filtera1').val(),
						prodes0: $('#filterb0').val(),
						prodes1: $('#filterb1').val(),
						season0: $('#filterc0').val(),
						season1: $('#filterc1').val(),
						cari8: $('#cari8').val()
					});
					var counta = JSON.stringify($('#dg').datagrid('getData').total);
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
						$('#dg').datagrid('load', {
							byr0: $('#filtera0').val(),
							byr1: $('#filtera1').val(),
							prodes0: $('#filterb0').val(),
							prodes1: $('#filterb1').val(),
							season0: $('#filterc0').val(),
							season1: $('#filterc1').val(),
							cari8: $('#cari8').val()
						});
						document.getElementById("tallb" + index).value = 0;
						tall();
						var counta = JSON.stringify($('#dg').datagrid('getData').total);
						document.getElementById("fltr2").innerHTML = counta + " result";
						$('#fltr1').show();
						$('#fltr2').show();
						$('#fltr3').show();
					}
				}
			});
		});

		function uncekprodes2(cross) {
			var total = document.getElementById("total").value;
			if (total == 1) {
				reset();
			} else {
				var c = cross;
				//alert(c);
				var ca = document.getElementById("idxb" + c).value;
				$('#prodes').datagrid('unselectRow', ca);
				document.getElementById("carispl").value = "";
				Search5();
				document.getElementById("filterb" + c).value = "";
				document.getElementById("tallb" + c).value = 0;
				$('#filterb' + c).hide();
				$('#crossb' + c).hide();
				$('#dg').datagrid('load', {
					byr0: $('#filtera0').val(),
					byr1: $('#filtera1').val(),
					prodes0: $('#filterb0').val(),
					prodes1: $('#filterb1').val(),
					season0: $('#filterc0').val(),
					season1: $('#filterc1').val(),
					cari8: $('#cari8').val()
				});
				document.getElementById("idxb" + c).value = "";
			}
		}

		/*$(function(){
		$('#dg').datagrid({
		pagination:true
		});
		var pager = $('#dg').datagrid('getPager');
		pager.pagination({
		layout:[]
		});  
		});*/

		$(function() {
			$('#season').datagrid({
				onCheck: function(index, row, value) {
					$('#tabel1').css("margin-top", "50px");
					var ckk = $('#season').datagrid('getRows')[index].season;
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
					$('#dg').datagrid('load', {
						byr0: $('#filtera0').val(),
						byr1: $('#filtera1').val(),
						prodes0: $('#filterb0').val(),
						prodes1: $('#filterb1').val(),
						season0: $('#filterc0').val(),
						season1: $('#filterc1').val(),
						cari8: $('#cari8').val()
					});
					var counta = JSON.stringify($('#dg').datagrid('getData').total);
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
						$('#dg').datagrid('load', {
							byr0: $('#filtera0').val(),
							byr1: $('#filtera1').val(),
							prodes0: $('#filterb0').val(),
							prodes1: $('#filterb1').val(),
							season0: $('#filterc0').val(),
							season1: $('#filterc1').val(),
							cari8: $('#cari8').val()
						});
						document.getElementById("tallc" + index).value = 0;
						tall();
						var counta = JSON.stringify($('#dg').datagrid('getData').total);
						document.getElementById("fltr2").innerHTML = counta + " result";
						$('#fltr1').show();
						$('#fltr2').show();
						$('#fltr3').show();
					}
				}
			});
		});

		function uncekseason2(cross) {
			var total = document.getElementById("total").value;
			if (total == 1) {
				reset();
			} else {
				var c = cross;
				//alert(c);
				var ca = document.getElementById("idxc" + c).value;
				$('#season').datagrid('unselectRow', ca);
				document.getElementById("carispl").value = "";
				Search5();
				document.getElementById("filterc" + c).value = "";
				document.getElementById("tallc" + c).value = 0;
				$('#filterc' + c).hide();
				$('#crossc' + c).hide();
				$('#dg').datagrid('load', {
					byr0: $('#filtera0').val(),
					byr1: $('#filtera1').val(),
					prodes0: $('#filterb0').val(),
					prodes1: $('#filterb1').val(),
					season0: $('#filterc0').val(),
					season1: $('#filterc1').val(),
					cari8: $('#cari8').val()
				});
				document.getElementById("idxc" + c).value = "";
			}
		}
		/* end function search baru */

		/*function cekbyr(){
		$('#tabel1').css("margin-top","50px");
		var ck = $('#byr').datagrid('getChecked');
		for(var i=0; i<=1; i++){
		var row = $('#byr').datagrid('getRows')[i];
		if ($.inArray(row,ck) >= 0){
		document.getElementById("filtera"+i).value = ck[i].byrnm;
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
		$('#dg').datagrid('load',{
		byr0: $('#filtera0').val(),
		byr1: $('#filtera1').val(),
		prodes0: $('#filterb0').val(),
		prodes1: $('#filterb1').val(),
		season0: $('#filterc0').val(),
		season1: $('#filterc1').val()
		});
		var total = document.getElementById("total").value;
		if(total==0){
		$('#tabel1').css("margin-top","");
		$('#fltr1').hide();
		$('#fltr2').hide();
		$('#fltr3').hide();
		} else {
		var counta= JSON.stringify($('#dg').datagrid('getData').total);
		document.getElementById("fltr2").innerHTML = counta+" result";
		$('#fltr1').show();
		$('#fltr2').show();
		$('#fltr3').show();	
		}
		}
		
		function cekprodes(){
		$('#tabel1').css("margin-top","50px");
		var ck = $('#prodes').datagrid('getChecked');
		for(var i=0; i<=1; i++){
		var row = $('#prodes').datagrid('getRows')[i];
		if ($.inArray(row,ck) >= 0){
		document.getElementById("filterb"+i).value = ck[i].prodes;
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
		$('#dg').datagrid('load',{
		byr0: $('#filtera0').val(),
		byr1: $('#filtera1').val(),
		prodes0: $('#filterb0').val(),
		prodes1: $('#filterb1').val(),
		season0: $('#filterc0').val(),
		season1: $('#filterc1').val()
		});
		var total = document.getElementById("total").value;
		if(total==0){
		$('#tabel1').css("margin-top","");
		$('#fltr1').hide();
		$('#fltr2').hide();
		$('#fltr3').hide();
		} else {
		var counta= JSON.stringify($('#dg').datagrid('getData').total);
		document.getElementById("fltr2").innerHTML = counta+" result";
		$('#fltr1').show();
		$('#fltr2').show();
		$('#fltr3').show();	
		}
		}
		
		function cekseason(){
		$('#tabel1').css("margin-top","50px");
		//var index = 1;
		var ck = $('#season').datagrid('getChecked');
		for(var i=0; i<=1; i++){
		//var p = 4;
		//var j = i+p;
		var row = $('#season').datagrid('getRows')[i];
		if ($.inArray(row,ck) >= 0){
		document.getElementById("filterc"+i).value = ck[i].season;
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
		$('#dg').datagrid('load',{
		byr0: $('#filtera0').val(),
		byr1: $('#filtera1').val(),
		prodes0: $('#filterb0').val(),
		prodes1: $('#filterb1').val(),
		season0: $('#filterc0').val(),
		season1: $('#filterc1').val()
		});
		var total = document.getElementById("total").value;
		if(total==0){
		$('#tabel1').css("margin-top","");
		$('#fltr1').hide();
		$('#fltr2').hide();
		$('#fltr3').hide();
		} else {
		var counta= JSON.stringify($('#dg').datagrid('getData').total);
		document.getElementById("fltr2").innerHTML = counta+" result";
		$('#fltr1').show();
		$('#fltr2').show();
		$('#fltr3').show();	
		}
		}
		  
		function unceka(cross){
		var total = document.getElementById("total").value;
		if (total==1){
		reset();
		} else {
		var c = cross;
		$('#byr').datagrid('unselectRow',c);
		
		document.getElementById("filtera"+c).value ="";
		$('#filtera'+c).hide();
		$('#crossa'+c).hide();
		document.getElementById("talla"+c).value = 0;
		
		tall();
		$('#dg').datagrid('load',{
		byr0: $('#filtera0').val(),
		byr1: $('#filtera1').val(),
		prodes0: $('#filterb0').val(),
		prodes1: $('#filterb1').val(),
		season0: $('#filterc0').val(),
		season1: $('#filterc1').val()
		});
		var counta= JSON.stringify($('#dg').datagrid('getData').total);
		document.getElementById("fltr2").innerHTML = counta+" result";
		$('#fltr1').show();
		$('#fltr2').show();
		$('#fltr3').show();
		}
		}
		
		function uncekb(cross){
		var total = document.getElementById("total").value;
		if (total==1){
		reset();
		} else {
		var c = cross;
		$('#prodes').datagrid('unselectRow',c);
		
		document.getElementById("filterb"+c).value ="";
		$('#filterb'+c).hide();
		$('#crossb'+c).hide();
		document.getElementById("tallb"+c).value = 0;
		
		tall();
		$('#dg').datagrid('load',{
		byr0: $('#filtera0').val(),
		byr1: $('#filtera1').val(),
		prodes0: $('#filterb0').val(),
		prodes1: $('#filterb1').val(),
		season0: $('#filterc0').val(),
		season1: $('#filterc1').val()
		});
		var counta= JSON.stringify($('#dg').datagrid('getData').total);
		document.getElementById("fltr2").innerHTML = counta+" result";
		$('#fltr1').show();
		$('#fltr2').show();
		$('#fltr3').show();
		}
		}
		
		function uncekc(cross){
		var total = document.getElementById("total").value;
		if (total==1){
		reset();
		} else {
		var c = cross;
		$('#season').datagrid('unselectRow',c);
		
		document.getElementById("filterc"+c).value ="";
		$('#filterc'+c).hide();
		$('#crossc'+c).hide();
		document.getElementById("tallc"+c).value = 0;
		
		tall();
		$('#dg').datagrid('load',{
		byr0: $('#filtera0').val(),
		bur1: $('#filtera1').val(),
		prodes0: $('#filterb0').val(),
		prodes1: $('#filterb1').val(),
		season0: $('#filterc0').val(),
		season1: $('#filterc1').val()
		});
		var counta= JSON.stringify($('#dg').datagrid('getData').total);
		document.getElementById("fltr2").innerHTML = counta+" result";
		$('#fltr1').show();
		$('#fltr2').show();
		$('#fltr3').show();
		}
		}*/

		function totrec() {
			var tcount = JSON.stringify($('#dg').datagrid('getData').total);
			document.getElementById("fltr2").innerHTML = tcount + " result";
		}

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
			var ckb0 = document.getElementById("tallb0").value;
			var ckb1 = document.getElementById("tallb1").value;
			var ckc0 = document.getElementById("tallc0").value;
			var ckc1 = document.getElementById("tallc1").value;
			var tall = parseInt(cka0) + parseInt(cka1) + parseInt(ckb0) + parseInt(ckb1) + parseInt(ckc0) + parseInt(ckc1);
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
			$('#byr').datagrid('clearSelections');
			$('#prodes').datagrid('clearSelections');
			$('#season').datagrid('clearSelections');
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
				$('#dg').datagrid('load', {
					byr0: $('#filtera0').val(),
					byr1: $('#filtera1').val(),
					prodes0: $('#filterb0').val(),
					prodes1: $('#filterb1').val(),
					season0: $('#filterc0').val(),
					season1: $('#filterc1').val()
				});
			}
		}

		function toggle(source) {
			checkboxes = document.getElementsByName('ck');
			for (var i = 0, n = checkboxes.length; i < n; i++) {
				checkboxes[i].checked = source.checked;
			}
		}

		function cheka1() {
			var c1 = document.getElementById("chek1");
			if (c1.checked) {
				$('#dg').datagrid('showColumn', 'artno');
				//$('#dg').datagrid('showColumn', 2);
			} else {
				$('#dg').datagrid('hideColumn', 'artno');
			}
		}

		function cheka2() {
			var c2 = document.getElementById("chek2");
			if (c2.checked) {
				$('#dg').datagrid('showColumn', 'ordno');
			} else {
				$('#dg').datagrid('hideColumn', 'ordno');
			}
		}

		function cheka3() {
			var c3 = document.getElementById("chek3");
			if (c3.checked) {
				$('#dg').datagrid('showColumn', 'prodes');
			} else {
				$('#dg').datagrid('hideColumn', 'prodes');
			}
		}

		function cheka4() {
			var c4 = document.getElementById("chek4");
			if (c4.checked) {
				$('#dg').datagrid('showColumn', 'fob');
			} else {
				$('#dg').datagrid('hideColumn', 'fob');
			}
		}

		function cheka5() {
			var c5 = document.getElementById("chek5");
			if (c5.checked) {
				$('#dg').datagrid('showColumn', 'qty');
			} else {
				$('#dg').datagrid('hideColumn', 'qty');
			}
		}

		function cheka6() {
			var c6 = document.getElementById("chek6");
			if (c6.checked) {
				$('#dg').datagrid('showColumn', 'deldate2');
			} else {
				$('#dg').datagrid('hideColumn', 'deldate2');
			}
		}

		function cheka7() {
			var c7 = document.getElementById("chek7");
			if (c7.checked) {
				$('#dg').datagrid('showColumn', 'user');
			} else {
				$('#dg').datagrid('hideColumn', 'user');
			}
		}

		function cheka7b() {
			var c7b = document.getElementById("chek7b");
			if (c7b.checked) {
				$('#dg').datagrid('showColumn', 'linnm');
			} else {
				$('#dg').datagrid('hideColumn', 'linnm');
			}
		}

		function cheka8() {
			var c8 = document.getElementById("chek8");
			if (c8.checked) {
				$('#dg').datagrid('showColumn', 'mat');
			} else {
				$('#dg').datagrid('hideColumn', 'mat');
			}
		}

		function cheka9() {
			var c9 = document.getElementById("chek9");
			if (c9.checked) {
				$('#dg').datagrid('showColumn', 'status');
			} else {
				$('#dg').datagrid('hideColumn', 'status');
			}
		}

		function cheka10() {
			var c10 = document.getElementById("chek10");
			if (c10.checked) {
				$('#dg').datagrid('showColumn', 'act');
			} else {
				$('#dg').datagrid('hideColumn', 'act');
			}
		}

		function testku() {
			var dg = $('#prodes');
			var dg2 = $('#byr');
			var dg3 = $('#season');
			dg.datagrid();
			dg2.datagrid();
			dg3.datagrid();
			dg.datagrid('getPanel').find('div.datagrid-header').css('display', 'none');
			dg2.datagrid('getPanel').find('div.datagrid-header').css('display', 'none');
			dg3.datagrid('getPanel').find('div.datagrid-header').css('display', 'none');
			$('#prodes').datagrid('getPanel').addClass('lines-no');
			$('#byr').datagrid('getPanel').addClass('lines-no');
			$('#season').datagrid('getPanel').addClass('lines-no');
			$('#prodes').datagrid('getPanel').addClass('lines-no2');
			$('#byr').datagrid('getPanel').addClass('lines-no2');
			$('#season').datagrid('getPanel').addClass('lines-no2');
			$('#prodes').datagrid('getPanel').addClass('col');
			$('#byr').datagrid('getPanel').addClass('col');
			$('#season').datagrid('getPanel').addClass('col');
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
					// $(".prodesa").css("margin-top","0px");
					// $(".tabelb").css("margin-top","0px");
					// $(".tabelc").css("margin-top","0px");
				} else if (test1 == 1 && test2 == 1) {
					// $(".tabelb").css("margin-top","-45px");
					// $(".tabelc").css("margin-top","15px");
					$('.tabela').show();
					// $(".prodesa").css("margin-top","60px");
					document.getElementById('test1').value = "";
				} else if (test1 == "" && test2 == 1) {
					$('.tabela').hide();
					// $(".prodesa").css("margin-top","-15px");
					// $(".tabelb").css("margin-top","-70px");
					document.getElementById('test1').value = 1;
					// $(".tabelc").css("margin-top","-50px");
				} else if (test1 == 1 && test2 == "") {
					$('.tabela').show();
					// $(".byr").css("margin-top","20px");
					// $(".prodesa").css("margin-top","60px");
					// $(".seasona").css("margin-top","55px");
					// $(".tabelb").css("margin-top","-15px");
					document.getElementById('test1').value = "";
					// $(".tabelc").css("margin-top","85px");
				} else {
					$('.tabela').show();
					document.getElementById('test1').value = "";
					// $(".prodesa").css("margin-top","25px");
					// $(".tabelb").css("margin-top","-40px");
					// $(".tabelc").css("margin-top","55px");
				}
				this.classList.toggle("bi-eye2");
			});

			togglePassword2b.addEventListener("click", function() {
				test1 = $('#test1').val();
				test2 = $('#test2').val();
				if (test1 == "" && test2 == "") {
					$('.tabelb').hide();
					document.getElementById('test2').value = 1;
					// $(".seasona").css("margin-top","-10px");
					// $(".tabelc").css("margin-top","20px");
				} else if (test1 == 1 && test2 == 1) {
					// $(".tabelc").css("margin-top","25px");
					$('.tabelb').show();
					// $(".seasona").css("margin-top","65px");
					document.getElementById('test2').value = "";
				} else if (test1 == 1 && test2 == "") {
					// $(".tabelb").css("margin-top","-85px");
					$('.tabelb').hide();
					// $(".seasona").css("margin-top","-15px");
					document.getElementById('test2').value = 1;
					// $(".tabelc").css("margin-top","-60px");
				} else if (test1 == "" && test2 == 1) {
					// $(".prodesa").css("margin-top","60px");
					// $(".tabelb").css("margin-top","-15px");
					$('.tabelb').show();
					// $(".seasona").css("margin-top","55px");
					document.getElementById('test2').value = "";
					// $(".tabelc").css("margin-top","100px");
				} else {
					$('.tabelb').show();
					document.getElementById('test2').value = "";
					// $(".seasona").css("margin-top","30px");
					// $(".tabelc").css("margin-top","55px");
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

		/*edit*/
		function edit(index) {
			var a = $('#dg').datagrid('selectRow', index)
			if (a) {
				var row = $('#dg').datagrid('getSelected');
				if (row) {
					// alert(row.ordpk);
					$('#dialog-form-edit').dialog('open').dialog('setTitle', '');
					$('#form-edit').form('load', row);
					document.getElementById('ordpkimg').value = row.ordpk;
					$('#btn-close-first').show();
					$('#btn-close-second').hide();
					// if(row.stsfoto==1){
					// document.getElementById('countImages').value = 2;
					document.getElementById('gbr1').value = 1;
					document.getElementById('gbr2').value = 1;
					fillImageedit(1, row.foto, row.stsfoto);
					fillImageedit(2, row.foto2, row.stsfoto);
					// } else {
					// resetImage();
					// }

					if (row.srno) {
						$('#informasi1-edit').hide();
						$('#informasi2-edit').show();
						document.getElementById('srsync-edit').innerHTML = "Synced with SR " + row.srno;
					} else {
						$('#informasi1-edit').show();
						$('#informasi2-edit').hide();
					}
					setCoveredit();
					checkImagesedit();
					// resetImageedit();
					$('#btn-close-first').show();
					$('#btn-close-second').hide();
				} else {
					$.messager.alert('Warning', 'No order data selected', 'warning');
				}
			}

		}

		function canceledit() {
			// var ordpk = parseInt($('#ordpkcreate').val());
			// var formData = new FormData();
			// formData.append('ordpk', ordpk);
			// $.ajax({
			//     url: "action/delete.php?x=orderimg",
			//     method: 'POST',
			//     data: formData,
			//     processData: false,
			//     contentType: false,
			//     success: function (response) {
			// console.log("success save data style here >>>>> " + JSON.stringify(response));
			document.getElementById('countImages').value = 0;
			// document.getElementById('ordpkcreate').value = "";
			document.getElementById('ordpkimg').value = "";
			document.getElementById('gbr1').value = "";
			document.getElementById('gbr2').value = "";
			$('#dialog-form-edit').dialog('close');
			$('#form-edit').form('reset');
			// $('#form-add').form('reset');
			removesradd();
			//     },
			// 	error: function(xhr, status, error) {
			// 	console.error("Error: " + error);
			// 	}
			// });
		}

		/*save*/
		function save3() {
			console.log("start");
			var string = $("#form-add").serialize();
			$("#form-add").form('submit', {
				type: "POST",
				url: "action/simpan.php?x=ord",
				data: string,
				onSubmit: function() {
					return $(this).form('validate');
					console.log("submit");
				},
				success: function(data) {
					console.log("sucsess");
					$.messager.show({
						title: '',
						msg: data,
						timeout: 3000,
						showType: 'slide',
						icon: 'info',
						width: 315,
						height: 55,
						style: {
							left: 0,
							right: '',
							top: '',
							bottom: -document.body.scrollTop - document.documentElement.scrollTop
						}
					});
					$('#dg').datagrid('reload');
					$('#dialog-form-add').dialog('close');
					$('#form-add').form('reset');
					// $('#form-edit').form('reset');
					// removesradd();
					document.getElementById('countImages').value = 0;
					document.getElementById('ordpkcreate').value = "";
					document.getElementById('ordpkimg').value = "";
					document.getElementById('gbr1').value = "";
					document.getElementById('gbr2').value = "";
					$('#informasi2-add').hide();
					$('#informasi1-add').show();
					/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
					// $('#dg').datagrid('reload');
				},
				error: function(xhr, status, error) {
					// Handle error response
					$.messager.alert('Error', 'Form submission failed: ' + error, 'error');
				}
			});
		}

		function save3e() {
			console.log("start");
			var string = $("#form-edit").serialize();
			$("#form-edit").form('submit', {
				type: "POST",
				url: "action/simpan.php?x=ord",
				data: string,
				onSubmit: function() {
					return $(this).form('validate');
					console.log("submit");
				},
				success: function(data) {
					console.log("sucsess");
					$.messager.show({
						title: '',
						msg: data,
						timeout: 3000,
						showType: 'slide',
						icon: 'info',
						width: 315,
						height: 55,
						style: {
							left: 0,
							right: '',
							top: '',
							bottom: -document.body.scrollTop - document.documentElement.scrollTop
						}
					});
					$('#dg').datagrid('reload');
					$('#dialog-form-edit').dialog('close');
					$('#form-edit').form('reset');
					// $('#form-add').form('reset');
					// removesradd();
					document.getElementById('countImages').value = 0;
					document.getElementById('ordpkcreate').value = "";
					document.getElementById('ordpkimg').value = "";
					document.getElementById('gbr1').value = "";
					document.getElementById('gbr2').value = "";
					$('#informasi2-edit').hide();
					$('#informasi1-edit').show();
					/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
					// $('#dg').datagrid('reload');
				},
				error: function(xhr, status, error) {
					// Handle error response
					$.messager.alert('Error', 'Form submission failed: ' + error, 'error');
				}
			});
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

		$(function() {
			var spv = document.getElementById("spv").value;
			if (spv == 1) {
				$('#submit2').show();
				$('#act').show();
				$('#act2').hide();
				$('#upld').hide();
				$('#frame-utama-cari').css('width', '760px');
			} else {
				$('#submit2').hide();
				$('#act').hide();
				$('#act2').show();
				$('#upld').hide();
				$('#frame-utama-cari').css('width', '770px');
			}
		});

		// $(function(){
		// $('#dg').datagrid({
		//   onClickCell: function(index,field,value){
		//    var row = $(this).datagrid('getRows')[index];
		//     if (field == 'cut'){
		//      document.getElementById('ordpkcut').value=row.ordpk;
		//      $('#dialog-formcut').dialog('open').dialog('setTitle','');
		// 		 document.getElementById('opcut').innerHTML="OP "+row.ordno+" - Cutting";
		//      $('#dgcut').datagrid('load',{
		//      ordpk: $('#ordpkcut').val()
		//      });
		//      //$.ajax({
		//      //type:"POST",
		//     //url:"view/get_infob.php?pono="+row.pono,
		//      //data:"rkbpk="+row.rkbpk,
		//      //success:function(data){
		//      //document.getElementById('qtyinfo').innerHTML=data;
		//      //},
		//      //});
		//      }
		// 		else if (field == 'ssew'){
		//      document.getElementById('ordpksew').value=row.ordpk;
		//      $('#dialog-formsew').dialog('open').dialog('setTitle','');
		// 		 document.getElementById('opsew').innerHTML="OP "+row.ordno+" - Sewing";
		//      $('#dgsew').datagrid('load',{
		//      ordpk: $('#ordpksew').val()
		//      });
		//      //$.ajax({
		//      //type:"POST",
		//      //url:"view/get_infob.php?pono="+row.pono,
		//      //data:"rkbpk="+row.rkbpk,
		//      //success:function(data){
		//      //document.getElementById('qtyinfo').innerHTML=data;
		//      //},
		//      //});
		//      }
		// 		 	else if (field == 'fsew'){
		//      document.getElementById('ordpkfin').value=row.ordpk;
		//      $('#dialog-formfin').dialog('open').dialog('setTitle','');
		// 		 document.getElementById('opfin').innerHTML="OP "+row.ordno+" - Finishing";
		//      $('#dgfin').datagrid('load',{
		//      ordpk: $('#ordpkfin').val()
		//      });
		//      //$.ajax({
		//      //type:"POST",
		//      //data:"rkbpk="+row.rkbpk,
		//      //document.getElementById('qtyinfo').innerHTML=data;
		//      //},
		//      //});
		// 		}
		// 	}
		// });
		// });

		function loadcutting(index) {
			var a = $('#dg').datagrid('selectRow', index)
			if (a) {
				var row = $('#dg').datagrid('getSelected');
				if (row) {
					document.getElementById('ordpkcut').value = row.ordpk;
					$('#dialog-formcut').dialog('open').dialog('setTitle', '');
					document.getElementById('opcut').innerHTML = "OP " + row.ordno + " - Cutting";
					$('#dgcut').datagrid('load', {
						ordpk: $('#ordpkcut').val()
					});
				}
			}
		}

		function loadsewing(index) {
			var a = $('#dg').datagrid('selectRow', index)
			if (a) {
				var row = $('#dg').datagrid('getSelected');
				if (row) {
					document.getElementById('ordpksew').value = row.ordpk;
					$('#dialog-formsew').dialog('open').dialog('setTitle', '');
					document.getElementById('opsew').innerHTML = "OP " + row.ordno + " - Sewing";
					$('#dgsew').datagrid('load', {
						ordpk: $('#ordpksew').val()
					});
				}
			}
		}

		function loadfinish(index) {
			var a = $('#dg').datagrid('selectRow', index)
			if (a) {
				var row = $('#dg').datagrid('getSelected');
				if (row) {
					document.getElementById('ordpkfin').value = row.ordpk;
					$('#dialog-formfin').dialog('open').dialog('setTitle', '');
					document.getElementById('opfin').innerHTML = "OP " + row.ordno + " - Finishing";
					$('#dgfin').datagrid('load', {
						ordpk: $('#ordpkfin').val()
					});
				}
			}
		}

		//jasa
		function loadjs(index) {
			var a = $('#dg').datagrid('selectRow', index)
			if (a) {
				var row = $('#dg').datagrid('getSelected');
				if (row) {
					document.getElementById('ordpkjs').value = row.ordpk;
					$('#dialog-formjs').dialog('open').dialog('setTitle', '');
					document.getElementById('opjs').innerHTML = "OP " + row.ordno + " - Jasa";
					$('#dgjs').datagrid('load', {
						ordpk: $('#ordpkjs').val()
					});
				}
			}
		}

		$(function() {
			$('#dgcut').datagrid({
				onClickCell: function(index, field, value) {
					var row = $(this).datagrid('getRows')[index];
					if (field == 'pocons') {
						if (row.pocons2 > 0) {
							document.getElementById('ponoi').value = row.pono;
							document.getElementById('rkbpki').value = row.rkbpk;
							$('#dialog-forminfo').dialog('open').dialog('setTitle', '');
							$('#dginf').datagrid('load', 'view/get_infolpb.php?popk=' + row.popk + '&rkbpk=' + row.rkbpk);
							$.ajax({
								type: "POST",
								url: "view/get_infolpbb.php?popk=" + row.popk,
								data: "rkbpk=" + row.rkbpk,
								success: function(data) {
									document.getElementById('qtyinfo').innerHTML = data;
								},
							});
						}
					}
				}
			});
		});

		$(function() {
			$('#dgsew').datagrid({
				onClickCell: function(index, field, value) {
					var row = $(this).datagrid('getRows')[index];
					if (field == 'pocons') {
						if (row.pocons2 > 0) {
							document.getElementById('ponoi').value = row.pono;
							document.getElementById('rkbpki').value = row.rkbpk;
							$('#dialog-forminfo').dialog('open').dialog('setTitle', '');
							$('#dginf').datagrid('load', 'view/get_infolpb.php?popk=' + row.popk + '&rkbpk=' + row.rkbpk);
							$.ajax({
								type: "POST",
								url: "view/get_infolpbb.php?popk=" + row.popk,
								data: "rkbpk=" + row.rkbpk,
								success: function(data) {
									document.getElementById('qtyinfo').innerHTML = data;
								},
							});
						}
					}
				}
			});
		});

		$(function() {
			$('#dgfin').datagrid({
				onClickCell: function(index, field, value) {
					var row = $(this).datagrid('getRows')[index];
					if (field == 'pocons') {
						if (row.pocons2 > 0) {
							document.getElementById('ponoi').value = row.pono;
							document.getElementById('rkbpki').value = row.rkbpk;
							$('#dialog-forminfo').dialog('open').dialog('setTitle', '');
							$('#dginf').datagrid('load', 'view/get_infolpb.php?popk=' + row.popk + '&rkbpk=' + row.rkbpk);
							$.ajax({
								type: "POST",
								url: "view/get_infolpbb.php?popk=" + row.popk,
								data: "rkbpk=" + row.rkbpk,
								success: function(data) {
									document.getElementById('qtyinfo').innerHTML = data;
								},
							});
						}
					}
				}
			});
		});

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

		function formatterpo(value, row) {
			if (!value) return '-';
			return value.length > 30 ? value.substring(0, 30) + '...' : value;
		}

		function formatter1(value, row) {
			return '<div class="p-0 d-flex">' +
				'<div class="p-0 d-flex justify-content-center align-items-center">' + value + '</div>' +
				'<div class="ps-1">' +
				'<div class="p-0" style="font-size: 14px;font-weight: 700;line-height: 18px;">' + row.artno + '</div>' +
				'<div class="p-0" style="font-size: 12px;font-weight: 400;line-height: 18px;color:#00000061;">' + row.byrnm + ', ' + row.season + '</div>' +
				'</div>' +
				'</div>';
		}

		function formatter2(value, row) {
			if (value != '-') {
				return '<div style="margin-top:20px;margin-left:-70px;font-size: 14px;font-weight: 400;line-height: 18px;">' + value + '</div>' +
					'<div style="margin-left:35px;margin-top:-35px;padding:5px;"><div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061">C:' + row.cut + '</div>' +
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061">S:' + row.ssew + '</div>' +
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061">F:' + row.fsew + '</div></div>';
			} else {
				return '<span style="color:#00000061">Awaiting Schedule</span>';
			}
		}

		function formatter2b(value, row) {
			if (row.vassalnm == "N/A") {
				return value;
			} else {
				return '<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(53, 157, 217, 1);cursor:pointer;" onclick="dtlimport(' + row.popk + ',' + row.importpk + ')">' + value + '</span>'

			}
		}

		function formatter3(value, row, index) {
			// if (row.stscut != '' || row.stsssew != '' || row.stsfsew != '') {
			// 	return '<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadcutting(' + index + ')">C:' + row.stscut + '</div>' +
			// 		'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadsewing(' + index + ')">S:' + row.stsssew + '</div>' +
			// 		'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadfinish(' + index + ')">F:' + row.stsfsew + '</div>';
			// } 
			// jasa
			if (row.stscut != '' || row.stsssew != '' || row.stsfsew != '' || row.stsjs != '') {
				return '<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadcutting(' + index + ')">C:' + row.stscut + '</div>' +
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadsewing(' + index + ')">S:' + row.stsssew + '</div>' +
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadfinish(' + index + ')">F:' + row.stsfsew + '</div>'+
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadjs(' + index + ')">J:' + row.stsjs + '</div>';
			} 
			else {
				// return '<span style="color:#00000061">N/A</span>';
				return '<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="">C:waiting</div>' +
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="">S:waiting</div>' +
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="">F:waiting</div>';
			}
		}

		function formatter4(value, row, index) {
			// return '<div class="tooltip" style="cursor:pointer;"><img src="css/images/More.png" height="24px" width="24px"><div class="tooltiptext">' +
			//       '<a href="javascript:void(0);" onclick="detail('+row.ordpk+');" oncontextmenu="detail3('+row.ordpk+');" style="padding:5px;text-decoration:none;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#359DD9;">&ensp;&ensp;View order details </a>' +
			//       '<hr style="height:1px; background-color:#D9D9D9; color:#D9D9D9; border:none;">' +
			//       '<a href="javascript:void(0);" onclick="update('+index+');" style="padding:5px;text-decoration:none;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#359DD9;">&ensp;&ensp;Upload breakdown</a>' +
			//       '<hr style="height:1px; background-color:#D9D9D9; color:#D9D9D9; border:none;">' +
			//       '<a href="javascript:void(0);" onclick="edit('+index+')" style="padding:5px;text-decoration:none;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#359DD9;">&ensp;&ensp;Edit order</a>' +
			// 	  '<hr style="height:1px; background-color:#D9D9D9; color:#D9D9D9; border:none;">' +
			//       '<a href="javascript:void(0);" onclick="delorder('+row.ordpk+')" style="padding:5px;text-decoration:none;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#359DD9;">&ensp;&ensp;Delete order</a>'+
			// 	  '<hr style="height:1px; background-color:#D9D9D9; color:#D9D9D9; border:none;">' +
			//       '<a href="javascript:void(0);" onclick="printabs('+row.ordpk+')" style="padding:5px;text-decoration:none;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#359DD9;">&ensp;&ensp;Export Traceability</a>'+ 
			// 	  '<hr style="height:1px; background-color:#D9D9D9; color:#D9D9D9; border:none;">' +
			//       '<a href="javascript:void(0);" onclick="exp('+row.ordpk+')" style="padding:5px;text-decoration:none;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#359DD9;">&ensp;&ensp;Export excel</a></div></div>';
			return '<button id="button-action" type="button" class="btn dropdown-toggle-custom pt-0" data-bs-toggle="dropdown"><img src="css/images/More.png" height="24px" width="24px"></button>' +
				'<ul id="dropdown-menu-action' + index + '" class="dropdown-menu pt-1 pb-1">' +
				'<li><a class="dropdown-item" href="javascript:void(0);" onclick="detail(' + row.ordpk + ');" oncontextmenu="detail3(' + row.ordpk + ');">View order details</a></li>' +
				'<li><hr class="dropdown-divider mt-1 mb-1"></li>' +
				'<li><a class="dropdown-item" href="javascript:void(0);" onclick="update(' + index + ');">Upload breakdown</a></li>' +
				'<li><hr class="dropdown-divider mt-1 mb-1"></li>' +
				'<li><a class="dropdown-item" href="javascript:void(0);" onclick="edit(' + index + ')">Edit order</a></li>' +
				'<li><hr class="dropdown-divider mt-1 mb-1"></li>' +
				'<li><a class="dropdown-item" href="javascript:void(0);" onclick="delorder(' + row.ordpk + ')">Delete order</a></li>' +
				'<li><hr class="dropdown-divider mt-1 mb-1"></li>' +
				'<li><a class="dropdown-item" href="javascript:void(0);" onclick="printabs(' + row.ordpk + ')">Export Traceability</a></li>' +
				'<li><hr class="dropdown-divider mt-1 mb-1"></li>' +
				'<li><a class="dropdown-item" href="javascript:void(0);" onclick="exp(' + row.ordpk + ')">Export excel</a></li>' +
				'</ul>'
		}

		function styler1(index, row) {
			return 'border-top:1px solid #ededed;border-bottom:3px solid #ededed;border-left:1px solid #ededed;border-top-left-radius:5px;' +
				'border-bottom-left-radius:5px;height:75px;';
		}

		function styler2(index, row) {
			return 'border-top:1px solid #ededed;border-bottom:3px solid #ededed;';
		}

		function styler3(index, row) {
			return 'border-top:1px solid #ededed;border-bottom:3px solid #ededed;border-right:1px solid #ededed;border-top-right-radius:5px;' +
				'border-bottom-right-radius:5px;';
		}

		function styler4(index, row) {
			return 'color:#359DD9;';
		}

		function exp(ordpk) {
			document.getElementById("ordpkexp").value = ordpk;
			$.ajax({
				type: "POST",
				url: "view/get_ordno.php",
				data: "ord=" + ordpk,
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

		function printabs(ordpk) {
			var url = "pdf/preview_traceability.php?ord=" + ordpk;
			window.open(url);
		}

		function canexp() {
			$('#dialog-form').dialog('close');
			$('#form').form('reset');

			$('#dialog-formb').dialog('close');
			$('#formb').form('reset');

			$('#dialog-formc').dialog('close');
			// $('#formc').form('reset');
		}

		function canexp2() {
			$('#dialog-formo').dialog('close');
			// $('#formo').form('reset');
		}

		function exp2() {
			var cek = $('input[name="cek"]:checked').attr("value");
			var ord = $('#ordpkexp').val();
			// alert(cek);
			if (cek == 1) {
				url = "excel/excel_rkb2?cari=ALL&ord=" + ord;
				// url = "http://192.168.0.11/RKB/excel/excel_rkb?cari=ALL&ord=" + ord;
				window.open(url);
			} else {
				url = "excel/excel_op2?ord=" + ord;
				window.open(url);
			}
		}

		function expord() {
			$('#dialog-formc').dialog('open').dialog('setTitle', '');
		}

		function expordlist() {
			$('#dialog-formo').dialog('open').dialog('setTitle', '');
		}

		function exp2b() {
			var ord = $('#ordpkexp2').val();
			var bln = $('#expbln').val();
			var thn = $('#expthn').val();
			var byr = $('#cari2').val();
			// alert(cek);
			url = "excel/excel_outord?ord=" + ord + "&bln=" + bln + "&thn=" + thn + "&fu=<?php echo $_SESSION['fu']; ?>&byr="+byr;
			window.open(url);
		}

		function dcost1() {
			$('#dialog-cost').dialog('open').dialog('setTitle', '');
		}

		function candcost() {
			$('#dialog-cost').dialog('close');
		}

		function dupdate1() {
			$('#dialog-dupdate').dialog('open').dialog('setTitle', '');
		}

		function candupdate() {
			$('#dialog-dupdate').dialog('close');
		}

		function dcost() {
			// var cek = $('input[name="cek"]:checked').attr("value");
			// var thn = $('#cari8').val();
			var thn = $('#expthn3').val();
			// alert(cek);
			url = "excel/excel_cost?thn=" + thn + "&fu=<?php echo $_SESSION['fu']; ?>";
			window.open(url);
		}


		function dupdate() {
			// var cek = $('input[name="cek"]:checked').attr("value");
			// var thn = $('#cari8').val();
			var thn = $('#expthn4').val();
			// alert(cek);
			url = "excel/excel_update?thn=" + thn + "&fu=<?php echo $_SESSION['fu']; ?>";
			window.open(url);
		}

		// function ordlist() {
		// 	// var cek = $('input[name="cek"]:checked').attr("value");
		// 	var thn = $('#cari8').val();
		// 	// alert(cek);
		// 	url = "excel/excel_ord?thn="+thn+"&fu=<?php echo $_SESSION['fu']; ?>";
		// 	window.open(url);
		// }

		function ordlist() {
			// var cek = $('input[name="cek"]:checked').attr("value");
			var thn = $('#expthn2').val();
			// alert(cek);
			url = "excel/excel_ord?thn=" + thn + "&fu=<?php echo $_SESSION['fu']; ?>";
			window.open(url);
		}

		function srcbyr() {
			var thn = $('#cari8').val();
			$('#byr').datagrid('load', 'view/get_data2.php?dt=byr&thn=' + thn);
		}

		function srcprodes() {
			var thn = $('#cari8').val();
			$('#prodes').datagrid('load', 'view/get_data2.php?dt=prodes&thn=' + thn);
		}

		function srcseason() {
			var thn = $('#cari8').val();
			$('#season').datagrid('load', 'view/get_data2.php?dt=season&thn=' + thn);
		}

		function settingTableHeight(length) {
			// if (length <= 5) {
			// 	console.log("here data 100");
			// 	$('#dg').datagrid({
			// 		height: '500px',
			// 		LoadMsg:''
			// 	});
			// } 
			// else {
			// 	console.log("here auto");
			// 	$('#dg').datagrid({
			// 		height: 'auto',
			// 		LoadMsg:''
			// 	});
			// }
			if (length <= 6) {
				console.log("here <= 6");
				$('#dg').datagrid('getPanel').find('div.datagrid-view2').css('height', '500px');
				//$('#dg').datagrid('getPanel').find('div.datagrid-view2').css('height', windowHeight);
			} else {
				console.log("here auto");
				$('#dg').datagrid('getPanel').find('div.datagrid-view2').css('height', 'auto');
				//$('#dg').datagrid('getPanel').find('div.datagrid-view2').css('height', 'auto');
			}
		}

		$(function() {
			// $('#dg2').datagrid({
			// 	onLoadSuccess: function (data) {
			// 		var tcount = JSON.stringify($('#dg2').datagrid('getData').total);
			// 		console.log("data total dg2 : " + tcount);

			// 		settingTableHeight(tcount)
			// 	},
			// })

			// $('#dg').datagrid({
			// 	onLoadSuccess: function (data) {
			// 		// console.log("onloadsuccess data dg : " + JSON.stringify(data));

			// 		for (var i = 0; i < data.total; i++) {
			// 			$('#button-action-' + i).click(function (e) {
			// 				e.stopPropagation();
			// 			});
			// 			$('#dropdown-menu-action-' + i).click(function (e) {
			// 				e.stopPropagation();
			// 			});
			// 		}
			// 	}
			// })
		})

		function tnew() {

		}
		//Start   Gambar
		function onAddOrChangeUploadImage() {
			$('#dialog-upload_image').dialog('open').dialog('setTitle', '');
			// imageList();
		}

		function checkImages() {
			var countImages = parseInt($('#countImages').val());

			if (countImages > 0) {
				$('#btn-add-image').hide();
				$('#btn-change-image').show();
			} else {
				$('#btn-add-image').show();
				$('#btn-change-image').hide();
			}
		}

		function checkImagesedit() {
			var countImages = parseInt($('#countImages').val());

			if (countImages > 0) {
				$('#style-photo-edit').hide();
				$('#style-photo2-edit').show();
				$('#btn-add-image-edit').hide();
				$('#btn-change-image-edit').show();
			} else {
				$('#style-photo-edit').show();
				$('#style-photo2-edit').hide();
				$('#btn-add-image-edit').show();
				$('#btn-change-image-edit').hide();
			}
		}

		function resetImage() {
			for (let i = 1; i <= 2; i++) {
				onRemoveImage(i);
				// onRemoveImageedit(i);
			}
		}

		function onRemoveImage(index) {
			var countImages = parseInt($('#countImages').val());

			if (countImages > 0) {
				document.getElementById('countImages').value = --countImages;
			}

			var uploadImageFileWrap = $('#upload-image-file-' + index);
			var uploadImageFile = document.getElementById('upload-image-file-' + index).files[0];

			if (uploadImageFile) {
				uploadImageFileWrap.wrap('<form>').closest('form').get(0).reset();
				uploadImageFileWrap.unwrap();
			}

			var uploadImagePreview = document.getElementById('upload-image-preview-' + index);
			uploadImagePreview.src = '';

			$('#btn-close-image-' + index).hide();
			$('#upload-image-preview-' + index).hide();
			$('#text-upload-image-' + index).show();
			$('#upload-style-foto-' + index).show();

			var total = 0;
			$('#gbr' + index).val('0');
			for (var i = 1; i <= index; i++) {
				total += parseInt($('#gbr' + i).val(), 10);
			}
			if (total == 2) {
				$('#btn-aktif').show();
				$('#btn-non-aktif').hide();
			} else {
				$('#btn-aktif').hide();
				$('#btn-non-aktif').show();
			}
			// checkImages();
			// setCover();
		}

		// function onRemoveImageedit(index) {
		//     var countImages = parseInt($('#countImagesedit').val());

		//     if (countImages > 0) {
		//         document.getElementById('countImagesedit').value = --countImages;
		//     }

		//     var uploadImageFileWrap = $('#upload-image-file-'+index);
		//     var uploadImageFile = document.getElementById('upload-image-file-'+index).files[0];

		//     if (uploadImageFile) {
		//         uploadImageFileWrap.wrap('<form>').closest('form').get(0).reset();
		//         uploadImageFileWrap.unwrap();
		//     }

		//     var uploadImagePreview = document.getElementById('upload-image-preview-'+index);
		//     uploadImagePreview.src = '';

		//     $('#btn-close-image-'+index).hide();
		//     $('#upload-image-preview-'+index).hide();
		//     $('#text-upload-image-'+index).show();
		//     $('#upload-style-foto-'+index).show();

		//     var total = 0;
		//     // $('#gbr'+index).val('0');
		//     for (var i = 1; i <= index; i++) {
		//         total += parseInt($('#gbr' + i).val(), 10);
		//     }
		//     if(total == 2){
		//         $('#btn-aktif').show();
		//         $('#btn-non-aktif').hide();
		//     }else{
		//         $('#btn-aktif').hide();
		//         $('#btn-non-aktif').show();
		//     }
		//     // checkImages();
		//     // setCover();
		// }

		function imageList() {
			var countImages = parseInt($('#countImages').val());

			console.log("countImages before: " + countImages);

			if (countImages > 3) return;

			console.log("countImages after: " + parseInt(countImages + 1));

			for (var i = 1; i < parseInt(countImages + 1); i++) {
				$('#div-upload-image-' + i).show();
			}
		}

		// function imageListedit() {
		//     var countImages = parseInt($('#countImagesedit').val());

		//     console.log("countImages before: " + countImages);

		//     if (countImages > 3) return;

		//     console.log("countImages after: " + parseInt(countImages+1));

		//     for (var i = 1; i < parseInt(countImages+1); i++) {
		//         $('#div-upload-image-'+i).show();
		//     }
		// }

		function onCloseUploadImage(step) {
			$('#dialog-upload_image').dialog('close');
			if (step == 'first') {
				resetImage();
				// resetImageedit();
			} else {
				checkImages();
				checkImagesedit();
				// setCover();
			}
		}

		function onUploadImage(index) {
			var countImages = parseInt($('#countImages').val());
			var uploadImageFile = document.getElementById('upload-image-file-' + index).files[0];
			var uploadImagePreview = document.getElementById('upload-image-preview-' + index);
			var btnCloseImage = document.getElementById('btn-close-image-' + index);

			$('#btn-close-image-' + index).hide();
			$('#upload-image-preview-' + index).hide();
			$('#text-upload-image-' + index).show();

			// console.log("uploadImageFile : " + JSON.stringify(uploadImageFile));

			if (!uploadImageFile) return;

			console.log("uploadImageFile : " + JSON.stringify(uploadImageFile));

			document.getElementById('countImages').value = ++countImages;

			$('#btn-close-image-' + index).show();
			$('#upload-image-preview-' + index).show();
			$('#text-upload-image-' + index).hide();

			//add preview image src here
			var reader = new FileReader();
			reader.onload = function(e) {
				uploadImagePreview.src = e.target.result;
			};
			reader.readAsDataURL(uploadImageFile);

			var total = 0;
			$('#gbr' + index).val(1);
			for (var i = 1; i <= 2; i++) {
				total += parseInt($('#gbr' + i).val(), 10);
			}
			if (total == 2 || countImages == 2) {
				$('#btn-aktif').show();
				$('#btn-non-aktif').hide();
			} else {
				$('#btn-aktif').hide();
				$('#btn-non-aktif').show();
			}
			// imageList();
			// checkImages();
		}

		// function onUploadImageedit(index) {
		//     var countImages = parseInt($('#countImagesedit').val());
		//     var uploadImageFile = document.getElementById('upload-image-file-'+index).files[0];
		//     var uploadImagePreview = document.getElementById('upload-image-preview-'+index);
		//     var btnCloseImage = document.getElementById('btn-close-image-'+index);

		//     $('#btn-close-image-'+index).hide();
		//     $('#upload-image-preview-'+index).hide();
		//     $('#text-upload-image-'+index).show();

		//     // console.log("uploadImageFile : " + JSON.stringify(uploadImageFile));

		//     if (!uploadImageFile) return;

		//     console.log("uploadImageFile : " + JSON.stringify(uploadImageFile));

		//     document.getElementById('countImages').value = ++countImages;

		//     $('#btn-close-image-'+index).show();
		//     $('#upload-image-preview-'+index).show();
		//     $('#text-upload-image-'+index).hide();

		//     //add preview image src here
		//     var reader = new FileReader();
		//     reader.onload = function(e) {
		//         uploadImagePreview.src = e.target.result;
		//     };
		//     reader.readAsDataURL(uploadImageFile);

		//     var total = 0;
		//     $('#gbr'+index).val('1');
		//     for (var i = 1; i <= 2; i++) {
		//         total += parseInt($('#gbr' + i).val(), 10);
		//     }
		//     if(total == 2){
		//         $('#btn-aktif').show();
		//         $('#btn-non-aktif').hide();
		//     }else{
		//         $('#btn-aktif').hide();
		//         $('#btn-non-aktif').show();
		//     }
		//     // imageList();
		//     // checkImages();
		// }

		function fillImage(index, filename, stsfoto) {
			var countImages = parseInt($('#countImages').val());

			document.getElementById('countImages').value = ++countImages;

			var uploadImagePreview = document.getElementById('upload-image-preview-' + index);
			var uploadImagePreviewx = document.getElementById('upload-image-previewx-' + index);

			if (stsfoto == 1) {
				uploadImagePreview.src = "foto" + '/' + filename;
				uploadImagePreviewx.src = "foto" + '/' + filename;
			} else if (stsfoto == 2) {
				uploadImagePreview.src = "/production/public/foto/" + filename;
				uploadImagePreviewx.src = "/production/public/foto/" + filename;
			} else {
				let url = "http://192.168.0.22/SOM/public/foto";
				uploadImagePreview.src = url + '/' + filename;
				uploadImagePreviewx.src = url + '/' + filename;
			}

			setCover();
			checkImages();
		}

		function fillImageedit(index, filename, stsfoto) {
			var countImages = parseInt($('#countImages').val());

			document.getElementById('countImages').value = ++countImages;

			var uploadImagePreview = document.getElementById('upload-image-preview-' + index);
			var uploadImagePreviewx = document.getElementById('upload-image-previewx-' + index);

			if (stsfoto == 1) {
				uploadImagePreview.src = "foto" + '/' + filename;
				uploadImagePreviewx.src = "foto" + '/' + filename;
			} else if (stsfoto == 2) {
				uploadImagePreview.src = "/production/public/foto/" + filename;
				uploadImagePreviewx.src = "/production/public/foto/" + filename;
			} else {
				let url = "http://192.168.0.22/SOM/public/foto";
				uploadImagePreview.src = url + '/' + filename;
				uploadImagePreviewx.src = url + '/' + filename;
			}

			setCoveredit();
			checkImagesedit();
		}

		function changeImage() {
			$('#dialog-upload_image').dialog('open').dialog('setTitle', '');
			$('#btn-close-first').hide();
			$('#btn-close-second').show();
			$('#gbr1').val(1);
			$('#gbr2').val(1);
			// setCover();
			checkImages();
			checkImagesedit();
		}

		// function changeImageedit(){
		//     $('#dialog-upload_image').dialog('open').dialog('setTitle', '');
		//     $('#btn-close-first').hide();
		//     $('#btn-close-second').show();
		//     $('#gbr1').val(1);
		//     $('#gbr2').val(1);
		//     // setCover();
		// 	checkImagesedit();
		// }

		function setCover() {
			var countImages = parseInt($('#countImages').val());
			var showCoverImage = document.getElementById('showCoverImage');
			var showCoverImage2 = document.getElementById('showCoverImage2');

			if (countImages > 0) {
				$('#showCoverImage').show();
				$('#showCoverImage2').show();


				// Reset the src attributes before setting new ones
				showCoverImage.src = '';
				showCoverImage2.src = '';

				for (var i = 1; i <= 2; i++) {
					var uploadImageFile = document.getElementById('upload-image-file-' + i).files[0];
					var sourceImagePreview = document.getElementById('upload-image-preview-' + i).src;

					if (uploadImageFile) {
						var reader = new FileReader();
						reader.onload = (function(imageIndex) {
							return function(e) {
								if (imageIndex === 1) {
									showCoverImage.src = e.target.result;
								} else if (imageIndex === 2) {
									showCoverImage2.src = e.target.result;
								}
							};
						})(i);
						reader.readAsDataURL(uploadImageFile);
					} else if (sourceImagePreview) {
						if (i === 1) {
							showCoverImage.src = sourceImagePreview;
							$('#upload-image-preview-1').show();
							$('#btn-close-image-1').show();
							$('#upload-style-foto-1').hide();
						} else if (i === 2) {
							showCoverImage2.src = sourceImagePreview;
							$('#upload-image-preview-2').show();
							$('#btn-close-image-2').show();
							$('#upload-style-foto-2').hide();
						}
					}
				}

				$('#style-photo').hide();
				$('#style-photo2').show();
				$('#btn-create-non-aktif').hide();
				$('#btn-create-aktif').show();
				$('#style-photo2').css('display', 'flex');

			} else {
				$('#showCoverImage').hide();
				$('#showCoverImage2').hide();
				$('#btn-create-non-aktif').show();
				$('#btn-create-aktif').hide();
				$('#style-photo').show();
				$('#style-photo2').hide();
			}
		}

		function setCoveredit() {
			var countImages = parseInt($('#countImages').val());
			var showCoverImage = document.getElementById('showCoverImage-edit');
			var showCoverImage2 = document.getElementById('showCoverImage2-edit');

			if (countImages > 0) {
				$('#showCoverImage-edit').show();
				$('#showCoverImage2-edit').show();


				// Reset the src attributes before setting new ones
				showCoverImage.src = '';
				showCoverImage2.src = '';

				for (var i = 1; i <= 2; i++) {
					var uploadImageFile = document.getElementById('upload-image-file-' + i).files[0];
					var sourceImagePreview = document.getElementById('upload-image-preview-' + i).src;

					if (uploadImageFile) {
						var reader = new FileReader();
						reader.onload = (function(imageIndex) {
							return function(e) {
								if (imageIndex === 1) {
									showCoverImage.src = e.target.result;
								} else if (imageIndex === 2) {
									showCoverImage2.src = e.target.result;
								}
							};
						})(i);
						reader.readAsDataURL(uploadImageFile);
					} else if (sourceImagePreview) {
						if (i === 1) {
							showCoverImage.src = sourceImagePreview;
							$('#upload-image-preview-1').show();
							$('#btn-close-image-1').show();
							$('#upload-style-foto-1').hide();
						} else if (i === 2) {
							showCoverImage2.src = sourceImagePreview;
							$('#upload-image-preview-2').show();
							$('#btn-close-image-2').show();
							$('#upload-style-foto-2').hide();
						}
					}
				}

				$('#style-photo-edit').hide();
				$('#style-photo2-edit').show();
				// $('#btn-create-non-aktif').hide();
				// $('#btn-create-aktif').show();
				$('#style-photo2-edit').css('display', 'flex');

			} else {
				$('#showCoverImage-edit').hide();
				$('#showCoverImage2-edit').hide();
				// $('#btn-create-non-aktif').show();
				// $('#btn-create-aktif').hide();
				$('#style-photo-edit').show();
				$('#style-photo2-edit').hide();
			}
		}

		function onSubmitImage() {

			var countImages = parseInt($('#countImages').val());
			// console.log("countImages : " + countImages);

			if (countImages < 1) return;

			var formData = new FormData();
			formData.append('countImages', countImages);

			// var token = "{{ csrf_token() }}";
			// formData.append('_token', token);

			var srpk = $('#ordpkimg').val();
			formData.append('srpk', srpk);
			// console.log("srpk : " + srpk);

			for (var i = 1; i <= countImages; i++) {
				var imageFile = document.getElementById('upload-image-file-' + i).files[0] ?? null;
				if (imageFile) formData.append('imageFile' + i, imageFile);
			}

			// let url = "http://192.168.0.8/GIS3/action/save_upload_image.php'";
			// url = url.replace(':srpk', srpk);

			$.ajax({
				url: "action/save_upload_image.php",
				method: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					console.log("success save data style here >>>>> " + JSON.stringify(response));
					let statuspk = response.statuspk || 'Not available'; // Fallback for debugging
					var data = JSON.parse(response);
					console.log("Status PK value:", data.statuspk); // Log the specific property

					// fillFormStyle(null);
					// $.messager.show({
					//     title: '',
					//     msg: response.message,
					//     timeout: 3000,
					//     showType: 'slide',
					//     icon: 'info',
					//     width: 300,
					//     height: 55,
					//     style: {
					//         left: 0,
					//         right: '',
					//         top: '',
					//         bottom: -document.body.scrollTop - document.documentElement.scrollTop
					//     }
					// });
					// document.getElementById('ordpkimg').value = response.statuspk;
					// document.getElementById('ordpkcreate').value = response.statuspk;
					$('#ordpkimg').val(data.statuspk);
					$('#ordpkcreate').val(data.statuspk);
					$('#dialog-upload_image').dialog('close');
					$('#btn-close-first').hide();
					// $('#btn-close-second').show();
					checkImages();
					setCover();
					checkImagesedit();
					setCoveredit();
				},
				error: function(xhr, status, error) {
					console.error("Error: " + error);
				}
			});
		}

		// function onSubmitImageedit() {

		//     var countImages = parseInt($('#countImages-edit').val());
		//     // console.log("countImages : " + countImages);

		//     if (countImages < 1) return;

		//     var formData = new FormData();
		//     formData.append('countImages-edit', countImages);

		//     // var token = "{{ csrf_token() }}";
		//     // formData.append('_token', token);

		//     var srpk = $('#ordpkimg').val();
		//     formData.append('srpk', srpk);
		//     // console.log("srpk : " + srpk);

		//     for (var i = 1; i <= countImages; i++) {
		//         var imageFile = document.getElementById('upload-image-file-'+i).files[0] ?? null;
		//         if (imageFile) formData.append('imageFile'+i, imageFile);
		//     }

		//     // let url = "http://192.168.0.8/GIS3/action/save_upload_image.php'";
		//     // url = url.replace(':srpk', srpk);

		//     $.ajax({
		//         url: "action/save_upload_image.php",
		//         method: 'POST',
		//         data: formData,
		//         processData: false,
		//         contentType: false,
		//         success: function (response) {
		//             console.log("success save data style here >>>>> " + JSON.stringify(response));
		// 			let statuspk = response.statuspk || 'Not available'; // Fallback for debugging
		// 			var data = JSON.parse(response);
		// 			console.log("Status PK value:", data.statuspk); // Log the specific property

		//             // fillFormStyle(null);
		//             // $.messager.show({
		//             //     title: '',
		//             //     msg: response.message,
		//             //     timeout: 3000,
		//             //     showType: 'slide',
		//             //     icon: 'info',
		//             //     width: 300,
		//             //     height: 55,
		//             //     style: {
		//             //         left: 0,
		//             //         right: '',
		//             //         top: '',
		//             //         bottom: -document.body.scrollTop - document.documentElement.scrollTop
		//             //     }
		//             // });
		//             // document.getElementById('ordpkimg').value = response.statuspk;
		// 			// document.getElementById('ordpkcreate').value = response.statuspk;
		// 			$('#ordpkimg').val(data.statuspk);
		// 			// $('#ordpkcreate').val(data.statuspk);
		//             $('#dialog-upload_image').dialog('close');
		//             $('#btn-close-first').hide();
		//             // $('#btn-close-second').show();
		//             checkImagesedit();
		//             setCoveredit();
		//         },
		// 		error: function(xhr, status, error) {
		//     	console.error("Error: " + error);
		// 		}
		//     });
		// }

		//End Upload Gambar

		function ordno() {
			var selectthn = document.getElementById("thn");
			var selectedthn = selectthn.value;

			var selectbln = document.getElementById("bln");
			var selectedbln = selectbln.value;

			var ordpk = $('#ordpkcreate').val();

			$.ajax({
				type: "POST",
				url: "view/get_dataord.php?x=getord&ordpk=" + ordpk,
				data: {
					thn: selectedthn,
					bln: selectedbln
				},
				dataType: "json",
				success: function(data) {
					console.log("success save data style here >>>>> " + JSON.stringify(data));
					// var data = JSON.parse(response);
					$('#ordcreate2').val(data.ordno);
					$('#ordcreate2').show();
					$('#ordcreate').hide();
					$('#multi').show();
					// var ordCreateElement = document.getElementById('ordcreate2');
					// ordCreateElement.removeAttribute('required');
					// ordCreateElement.setAttribute('required', false);
					// document.getElementById("ordcreate").value = data.ordno;
				},
			});
		}

		function importsradd() {
			var spv = document.getElementById("spv").value;
			// if (spv == 1) {
			$('#dialog-form-sr').dialog('open').dialog('setTitle', '');
			// } else {
			// 	$.messager.alert('Warning', 'You are not allowed to add order, please contact your supervisor', 'warning');
			// }
				// $('#srfind').show();
				$('#srempty').show();
				// $('#dgsr').datagrid('resize');
				// Searchsr()
			$('#dgsr').datagrid({
				onLoadSuccess:function(data){
					console.log("DATA:", data);
				},
				onLoadError:function(){
					console.log("LOAD ERROR");
				}
			});
		}

		function backadd() {
			$('#dialog-form-sr').dialog('close');
			document.getElementById("carisr").value = '';
			$('#srfind').hide();
			$('#srempty').show();
		}

		function Searchsr() {
			var carisr = $('#carisr').val();
			console.log("carisr="+carisr);
			$('#dgsr').datagrid('resize');
				$('#dgsr').datagrid('load', {
					carisr: carisr
			});
			
			if (carisr) {
				$('#srfind').show();
				// $('#dgsr').show();
				$('#srempty').hide();
			} else {
				$('#srfind').hide();
				// $('#dgsr').hide();
				$('#srempty').show();
			}
		}

		function importdata() {
			var row = $('#dgsr').datagrid('getSelected');
			if (row) {
				$('#dialog-form-dev').dialog('open').dialog('setTitle', '');
				$('#form-dev').form('load', row);
				document.getElementById("srpkpilih").value = row.srpk;
				document.getElementById("srnopilih").value = row.srno;
				document.getElementById("srnomor").innerHTML = "SR " + row.srno;

				var url = 'view/get_stage.php?srpk=' + row.srpk;
				// Initialize combobox, load data from URL, and set the first item as the selected value
				// $('#statuspkadd').combobox({
				//     url: url,  // Load data from URL
				//     onLoadSuccess: function() {
				//         var data = $(this).combobox('getData'); // Get all data items
				// 		if (data.length > 0) {
				// 			var opts = $(this).combobox('options');
				// 			$(this).combobox('select', items[0][opts.valueField]);
				//         }
				//     }
				// });

				$('#statuspkadd').combobox('reload', url);
				// $.fn.combobox.defaults.onLoadSuccess = function(items){
				// if (items.length){
				// var opts = $(this).combobox('options');
				// $(this).combobox('select', items[0][opts.valueField]);
				// }
				// }

			}
		}

		function backdev() {
			$('#dialog-form-dev').dialog('close');
			$('#form-dev').form('reset');
		}

		function addsr() {
			var ordpkc = $('#ordpkcreate').val();
			var ordpke = $('#ordpkedt').val();
			var string = $("#form-dev").serialize();
			$("#form-dev").form('submit', {
				type: "POST",
				url: "action/save_dev.php?ordpkc=" + ordpkc + "&ordpke=" + ordpke,
				data: string,
				onSubmit: function() {
					return $(this).form('validate');
					console.log("submit");
				},
				success: function(data) {
					console.log("sucsess");
					let text = data;
					const arr = text.split(",");
					var statuspk = arr[0];
					var ordpk = arr[1];
					var material = arr[2];
					var foto1 = arr[3];
					var foto2 = arr[4];
					var stsfoto = arr[5];
					var byrpk = arr[6];
					var prodes = arr[7];
					var season = arr[8];
					var edit = arr[9];

					$('#ordpkimg').val(ordpk);
					$('#ordpkcreate').val(ordpk);
					// $('#btn-close-first').hide();
					// $('#btn-close-second').show();
					// checkImages();
					// setCover();
					// checkImagesedit();
					// setCoveredit();

					$('#dialog-form-dev').dialog('close');
					$('#form-dev').form('reset');
					$('#dialog-form-sr').dialog('close');
					document.getElementById("carisr").value = '';
					$('#srfind').hide();
					$('#srempty').show();
					var srno = $('#srnopilih').val();
					if (edit == 0) {
						document.getElementById("srnocr").value = srno;
						document.getElementById("statuspkcr").value = statuspk;
						document.getElementById("matcr").value = material;
						$('#byrpkcr').combobox('setValue', byrpk);
						console.log("ini:" + byrpk);
						$('#prodescr').textbox('setValue', prodes);
						$('#seasoncr').val(season);
						// Remove the required attribute
						$('#seasoncr').removeAttr('required');
						// Update EasyUI validatebox validation rules
						$('#seasoncr').validatebox('options').required = false;
						$('#seasoncr').validatebox('validate'); // Re-validate to apply changes

						$('#informasi2-add').show();
						$('#informasi1-add').hide();
						document.getElementById('srnoadd').innerHTML = "Synced with SR " + srno;
					} else {
						document.getElementById("srnoedt").value = srno;
						document.getElementById("statuspkedt").value = statuspk;
						document.getElementById("matedt").value = material;
						$('#byrpkedt').combobox('setValue', byrpk);
						$('#prodesedt').textbox('setValue', prodes);
						$('#seasonedt').val(season);
						$('#informasi2-edit').show();
						$('#informasi1-edit').hide();
						document.getElementById('srsync-edit').innerHTML = "Synced with SR " + srno;
					}
					document.getElementById('gbr1').value = 1;
					document.getElementById('gbr2').value = 1;
					fillImage(1, foto1, stsfoto);
					fillImage(2, foto2, stsfoto);
				},
				error: function(xhr, status, error) {
					// Handle error response
					$.messager.alert('Error', 'Form submission failed: ' + error, 'error');
				}
			});
		}

		function removesradd() {
			document.getElementById("srnocr").value = '';
			document.getElementById("statuspkcr").value = '';
			document.getElementById("matcr").value = '';
			$('#informasi2-add').hide();
			$('#informasi1-add').show();

			document.getElementById("srnoedt").value = '';
			document.getElementById("statuspkedt").value = '';
			document.getElementById("matedt").value = '';
			$('#informasi2-edit').hide();
			$('#informasi1-edit').show();
		}

		$(document).ready(function() {
			$('#uploadfile1').filebox({
				onChange: function(file) {
					$('#submit2a').hide();
					$('#submit1a').show();
				}
			});
			$('#uploadfile2').filebox({
				onChange: function(file) {
					$('#submit2b').hide();
					$('#submit1b').show();
				}
			});
			$('#uploadfile3').filebox({
				onChange: function(file) {
					$('#submit2c').hide();
					$('#submit1c').show();
				}
			});
			$('#uploadfile4').filebox({
				onChange: function(file) {
					$('#submit2d').hide();
					$('#submit1d').show();
				}
			});
		});

		function attrStage(value, row, index) {
			var stagenm = row.samplenm ?? row.stagenm ?? undefined;
			var srno = row.srno ? `SR ${row.srno}` : undefined;

			var stage = `<div class="d-flex flex-column">`;
			if (srno) stage += `<span>${srno}</span>`;
			if (stagenm) stage += `<span>${stagenm}</span>`;
			stage += `</div>`;

			return stage;
		}
	</script>
	<script src="config/srno.js"></script>
	<script src="config/srno2.js"></script>
</head>

<body style="font-family: Inter, sans-serif !important;">
	<input type="hidden" name="test1" id="test1">
	<input type="hidden" name="test2" id="test2">
	<input type="hidden" name="total" id="total" value="0" size="5">
	<div class="contenta">
		<div id="frame-utama-cari">
			<div id="container-cari">
				<div id="frame-cari">
					<img src="css/images/Shape.png" width="18px" height="18px">
					<input id="cari1" placeholder="Search..." class="input" plain="true" value="<?php echo $_GET['c1']; ?>" onkeyup="Search();">
				</div>
			</div>
			<input style="margin-top:-2px;margin-left:0px;display:none;" type="button" name="submit" id="upld" value="Upload all" class="button-submit-add" onclick="update2();">

			<div class="dropdown1x" style="left:0px;">
				<button class="dropbtn1x" id="act" onclick="myFunction1x()"
					style="display:none;padding:5px;color:#FFFFFF;background-color:#000000;border-radius:8px;cursor:pointer">Action
					&#9660;</button>
				<div id="myDropdown1x" class="dropdown1-content1x">
					<a href="javascript:void(0);" onclick="add();">Add order</a>
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<a href="Javascript:void(0);" onclick="costing();">Bulk upload costing data</a>
					<!-- <hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<a href="javascript:void(0);" onclick="dcost1();">Download costing template</a> -->
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<a href="javascript:void(0);" onclick="update2();">Add multiple breakdown</a>
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<a href="javascript:void(0);" onclick="multiple1();">Update multiple breakdown</a>
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<a href="javascript:void(0);" onclick="expordlist();">Export Order List</a>
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<a href="javascript:void(0);" onclick="expord();">Export Outstanding Order</a>
				</div>
			</div>

			<div class="dropdown2x" style="left:0px;">
				<button class="dropbtn2x" id="act2" onclick="myFunction2x()"
					style="display:none;padding:5px;color:#FFFFFF;background-color:#000000;border-radius:8px;cursor:pointer">Action
					&#9660;</button>
				<div id="myDropdown2x" class="dropdown2-content2x">
					<a href="javascript:void(0);" onclick="add();">Add order</a>
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<!-- <a href="Javascript:void(0);" onclick="costing();">Bulk upload costing data</a>
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<a href="javascript:void(0);" onclick="dcost();">Download costing template</a>
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1"> -->
					<a href="javascript:void(0);" onclick="update2();">Upload multiple breakdown</a>
					<!-- <hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1"> -->
					<!-- <a href="javascript:void(0);" onclick="ordlist();">Export Order List</a>
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<a href="javascript:void(0);" onclick="expord();">Export Outstanding Order</a> -->
				</div>
			</div>

			<input style="width:125px; height:28px;" id="cari7" name="cari7" class="easyui-combobox" value="<?php echo $_GET['c7']; ?>"
				data-options="valueField:'userpk',textField:'login',url:'view/get_data.php?dt=md',prompt:'Handle',onChange:Search,panelHeight:'auto',limitToList:'true'">

			<input style="width:130px; height:28px;" id="cari2" name="cari2" class="easyui-combobox" value="<?php echo $_GET['c2']; ?>"
				data-options="valueField:'byrpk',textField:'byrnm',prompt:'Buyer',onChange:Search,limitToList:'true'">

			<!-- <select class="easyui-combobox" style="width:140px; height:28px;" name="cari3" id="cari3"
				data-options="prompt:'Season',onChange:Search,panelHeight:'auto'">
				<option value=""></option>
				<option value="All">All</option>
				<option value="Spring">Spring</option>
				<option value="Summer">Summer</option>
				<option value="Fall">Fall</option>
				<option value="Winter">Winter</option>
			</select> -->

			<input style="width:125px; height:28px;" id="cari3" class="easyui-combobox" value="<?php echo $_GET['c3']; ?>"
				data-options="valueField:'season',textField:'season',prompt:'Season',onChange:Search,limitToList:'true'">

			<select class="easyui-combobox" id="cari8" data-options="editable:false, panelHeight:'auto',onChange:Search"
				style="width:85px;">
				<?php
				if ($_GET['c8'] > 0) {
				?>
					<option value="<?php echo $_GET['c8']; ?>"><?php echo $_GET['c8']; ?></option>
				<?php } ?>
				<?php
				for ($i = date('Y'); $i >= date('Y') - 3; $i -= 1) {
				?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>
		</div>

		<div id="frame-filter" style="margin-left:-5%;">
			<div id="frame-filter-fields">
				<div class="fields"><a href="javascript:void(0)" onclick="myFunction1c(); testku2();"
						style="text-decoration:none; color: #AFAFAF;">Fields</a></div>
				<div class="all"><a href="javascript:void(0)" onclick="myFunction1c(); testku2();"
						style="text-decoration:none; color: #000000;">All</a></div>
				<div id="panah2">
					<div class="dropdown1">
						<input onclick="myFunction1c(); testku2();" type="image" src="css/images/Polygon.png"
							class="dropbtn1" style="filter:brightness(0%);" alt="Submit button" width="10px"
							height="10px">
						<!--<button onclick="myFunction()" class="dropbtn"></button>-->
						<div id="myDropdown2" class="dropdown1-content" name="dropdown1-content" style="height:450px;">
							<div class="content-search2">
								<div id="frame-cari2">
									<img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button">
									<input id="cari6" placeholder="Search..." class="input" onkeyup="filterFunction();">
								</div>
							</div>
							<div style="margin-top:50px;margin-left:-5px;display: inline-block; text-align: left;">
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div><b>Select All</b></div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input
											type="checkbox" name="all" value="all" id="chek0"
											onclick="toggle(this); cheka1(); cheka2(); cheka3(); cheka4(); cheka5(); cheka6(); cheka7(); cheka7b(); cheka8(); cheka9(); cheka10(); cheka11();"
											checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Order Inf</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input
											type="checkbox" name="ck" value="ordno" id="chek1" onclick="cheka1();"
											checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Order No</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input
											type="checkbox" name="ck" value="buyer" id="chek2" onclick="cheka2();"
											checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Style Desc.</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input
											type="checkbox" name="ck" value="style" id="chek3" onclick="cheka3();"
											checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>FOB</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input
											type="checkbox" name="ck" value="prodes" id="chek4" onclick="cheka4();"
											checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Qty</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input
											type="checkbox" name="ck" value="season" id="chek5" onclick="cheka5();"
											checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Delv. Date</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input
											type="checkbox" name="ck" value="md" id="chek6" onclick="cheka6();" checked>
									</div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Handle</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input
											type="checkbox" name="ck" value="qty" id="chek7" onclick="cheka7();"
											checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Line Inf</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input
											type="checkbox" name="ck" value="handle" id="chek7b" onclick="cheka7b();"
											checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Materials</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input
											type="checkbox" name="ck" value="cut" id="chek8" onclick="cheka8();"
											checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Status</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input
											type="checkbox" name="ck" value="sew" id="chek9" onclick="cheka9();"
											checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Act</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input
											type="checkbox" name="ck" value="fin" id="chek10" onclick="cheka10();"
											checked></div>
								</a>
							</div>
							<!--<div id="tabel" class="tabeld" style="width:200px;height:300px;border:0px solid;margin-top:-150px;margin-left:-20px;">
<table id="kolom1" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_data.php?dt=kolom1" toolbar="#tb" striped="false"
rownumbers="false"  multiple="true" collapsible="false" fitColumns="false" method="post" data-options="border:false,loadMsg:''">
<thead>
<tr>
<th field="kolomnm" width="165" sortable="false" >Select All</th>
<th field="ck" width="40"><input type="checkbox" name="chekk" onclick="toggle(this); cheka1(); cheka2(); cheka3(); cheka4(); cheka5(); cheka6(); cheka7(); cheka8(); cheka9(); cheka10(); cheka11();" id="chekk2" checked></th>
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
					<input onclick="myFunction()" type="image" class="imgsort" src="css/images/sort.jpg"
						alt="Submit button" class="dropbtn" style="left:80px;">
					<div id="myDropdown" class="dropdwn-content">
						<input type="hidden" id="cari4b" value="1" name="cari4">
						<div class="new-entry"><a href="javascript:void(0)" plain="true" onclick="Search2a();">Newest entry</a></div>
						<input type="hidden" id="cari5b" value="1" name="cari5">
						<div class="old-entry"><a href="javascript:void(0)" plain="true" onclick="Search2b();">Oldest entry</a></div>
					</div>
				</div>
        <a href="javascript:void(0);" style="text-decoration:none; color: #000000;">
          <div id="newest" class="newest" style="left:65px;width:150px;" onclick="myFunction()">Newest entry</div>
          <div id="oldest" class="newest" style="left:65px;width:150px; display:none;" onclick="myFunction()">Oldest entry</div>
        </a>
			</div>
			<div id="frame-filter2">
				<div id="dropdown2">
					<input type="image" class="imgfilter" src="css/images/filter.png" width="14px" height="12.83px"
						alt="Submit button" onclick="myFunction1d(); testku();">
					<div class="filter"><a href="javascript:void(0);" onclick="myFunction1d(); testku();"
							style="text-decoration:none; color: #000000;">Filter</a></div>
					<div id="myDropdown3" class="dropdown2-content" style="width:220px;height:395px">
						<div class="content-search2">
							<div id="frame-cari2">
								<img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button"
									onclick="myFunction1d(); testku();">
								<input id="carispl" placeholder="Search..." class="input" onkeyup="Search5();">
							</div>
						</div>
						<div id="byr1a" class="byra" style="margin-top:50px;margin-left:15px;">Buyer
							<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img1">
								<i class="bi bi-eye-slash-fill" id="togglePassword2a" style="cursor: pointer;"
									onmouseover="expand();" onmouseout="expand();"></i>
							</div>
						</div>
						<div id="tbbyr" class="tabela" onmousemove="totrec();"
							style="width:200px;height:auto;border:0px solid;margin-top:0px;margin-left:5px;">
							<table id="byr" class="easyui-datagrid" idField="byrpk" title=""
								style="margin-left:20px;width:100%;height:auto;" align="center" toolbar="#tb"
								striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
								data-options="border:false,loadMsg:''">
								<thead>
									<tr>
										<th field="byrnm2" width="160" sortable="false"></th>
										<th field="ck" checkbox="true" width="50"></th>
									</tr>
								</thead>
							</table>
						</div>

						<div id="byr1a" class="prodesa" style="margin-top:0px;margin-left:15px;">
							<hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
							Style desc
							<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img2">
								<i class="bi bi-eye-slash-fill" id="togglePassword2b" style="cursor: pointer;"
									onmouseover="expand();" onmouseout="expand();"></i>
							</div>
						</div>
						<div id="tbprodes" class="tabelb" onmousemove="totrec();"
							style="width:200px;height:auto;margin-top:0px;margin-left:5px;">
							<table id="prodes" class="easyui-datagrid" title="" style="width:100%;height:auto;"
								align="center" toolbar="" idField="ordpk" striped="false" multiple="true"
								collapsible="true" fitColumns="false" method="post"
								data-options="border:false,loadMsg:''">
								<thead>
									<tr>
										<th field="prodes2" width="160" sortable="false"></th>
										<th field="ck" checkbox="true" width="50"></th>
									</tr>
								</thead>
							</table>
						</div>

						<div id="byr1a" class="seasona" style="margin-top:0px;margin-left:15px;;">
							<hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
							Season
							<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img3">
								<i class="bi bi-eye-slash-fill" id="togglePassword2c" style="cursor: pointer;"
									onmouseover="expand();" onmouseout="expand();"></i>
							</div>
						</div>
						<div id="tbseason" class="tabelc" onmousemove="totrec();"
							style="width:200px;height:auto;margin-top:0px;margin-left:5px;">
							<table id="season" class="easyui-datagrid" title="" style="width:100%;height:auto;"
								align="center" url="view/get_data2.php?dt=season" toolbar="#tb" idField="ordpk"
								striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
								data-options="border:false,loadMsg:''">
								<thead>
									<tr>
										<th field="season2" width="160" sortable="false"></th>
										<th field="ck" checkbox="true" width="50"></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="frame-fltrchk" align="left" onmousemove="totrec();" style="width:95%;">
			<div id="fltr1"
				style="margin-top:-35px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
			</div>
			<div id="fltr2"
				style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
			</div>
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
				<?php for ($i = 0; $i <= 1; $i++) { ?>
					<input type="button" id="filtera<?php echo $i; ?>" class="filterchek" alt="Submit button" readonly>
					<input type="hidden" id="idxa<?php echo $i; ?>" size="5">
					<a href="javascript:void(0)" id="crossa<?php echo $i; ?>" class="cross"
						onclick="uncekbyr2(<?php echo $i; ?>);">&nbsp;&#215;&nbsp;</a>
					<input type="hidden" name="tall" id="talla<?php echo $i; ?>" value="0" size="5">
				<?php } ?>
				<!--B-->
				<?php for ($j = 0; $j <= 1; $j++) { ?>
					<input type="button" id="filterb<?php echo $j; ?>" class="filterchek" alt="Submit button" readonly>
					<input type="hidden" id="idxb<?php echo $j; ?>" size="5">
					<a href="javascript:void(0)" id="crossb<?php echo $j; ?>" class="cross"
						onclick="uncekprodes2(<?php echo $j; ?>);">&nbsp;&#215;&nbsp;</a>
					<input type="hidden" name="tall" id="tallb<?php echo $j; ?>" value="0" size="5">
				<?php } ?>
				<!--C-->
				<?php for ($k = 0; $k <= 1; $k++) { ?>
					<input type="button" id="filterc<?php echo $k; ?>" class="filterchek" alt="Submit button" readonly>
					<input type="hidden" id="idxc<?php echo $k; ?>" size="5">
					<a href="javascript:void(0)" id="crossc<?php echo $k; ?>" class="cross"
						onclick="uncekseason2(<?php echo $k; ?>);">&nbsp;&#215;&nbsp;</a>
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
		<div class="d-none">
			<table id="dg2" class="easyui-datagrid" title="" style="width:100%;height:auto" align="center"
				url="view/get_ord.php"
				toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]"
				method="post"
				data-options="loadMsg:'',singleSelect:false,pagination:true,collapsible:true,rownumbers:false,fitColumns:true,border:false,autoRowHeight:true">
			</table>
		</div>

		<div id="tabel1" onclick="" ondblclick="">
			<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:auto" align="center"
				url="view/get_ord.php"
				toolbar="#tb" striped="false" pageSize="50" pageList="[50,100,150,200]"
				method="post"
				data-options="singleSelect:false,pagination:true,collapsible:true,rownumbers:false,fitColumns:true,border:false,autoRowHeight:true">
				<thead>
					<tr>
						<th field="ordinf" width="170" styler="styler1" formatter="formatter1">Order information</th>
						<th field="ordno" width="90" styler="styler2" sortable="true">Order no.</th>
						<th field="pono" width="90" styler="styler2" sortable="true" formatter="formatterpo">PO no.</th>
						<th field="stage" width="90" styler="styler2" sortable="true">Stage</th>
						<th field="prodes" width="180" styler="styler2" sortable="true">Style description</th>
						<th field="fob" width="85" styler="styler2">FOB (Costing)</th>
						<th field="qty" width="85" styler="styler2">Qty</th>
						<!-- <th field="packed" width="75" styler="styler2">Total Output</th> -->
						<th field="deldate2" width="100" styler="styler2"> Delivery date</th>
						<th field="stagenm" width="100" styler="styler2" formatter="attrStage" align="center">Sample</th>
						<th field="smv" width="100" styler="styler2" align="center">SMV</th>
						<th field="user" width="85" styler="styler2">Handle</th>
						<th field="linnm" width="130" styler="styler2" formatter="formatter2" align="center">Line <br>
							information</th>
						<th field="mat" width="100" styler="styler2" formatter="formatter3">Materials</th>
						<th field="status" width="85" styler="styler2">Status</th>
						<th field="act" width="55" styler="styler3" formatter="formatter4" align="left">Act</th>
					</tr>
				</thead>
			</table>
			<br>
		</div>
	</div>

	<!--MENU-->
	<!-- <div class="header" id="myHeader" style="display:none;" onclick="">
		<div class="detail"><a href="javascript:void(0)" plain="true" onclick="update();"
				style="color: #FFFFFF; text-decoration: none;"> Upload </a></div>
		<div class="detail">
			<a href="javascript:void(0)" plain="true" onclick="detail();" oncontextmenu="detail3();"
				title="if right click automatically new tab" class="easyui-tooltip"
				style="color: #FFFFFF; text-decoration: none;"> View Details </a>
		</div>
		<div class="delete"><a href="javascript:void(0)" plain="true" onclick="edit();"
				style="color: #FFFFFF; text-decoration: none;"> Edit </a></div>
		<div class="delete"><a href="javascript:void(0)" plain="true" onclick="delorder();"
				style="color: #FFFFFF; text-decoration: none;"> Delete </a></div>
		<div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true"
				onclick="$('#myHeader').hide(); $('#dg').datagrid('clearSelections');"
				style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
	</div> -->

	<!--upload1-->
	<div id="dialog-form" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:false,modal:true,closable:false"
		style="width:525px;height:350px;padding:5px;display:none;top:20%;border-radius:8px;">
		<form id="form" method="post" enctype="multipart/form-data">
			<input type="hidden" name="ordpk" id="ordpkupload">
			<!-- <div class="modal-dialog" style="width:98%; height:96%;"> -->
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div style="padding:10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">
						Add order breakdown
						<input name="ordno" id="ordno" style="border:none;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px" readonly>
					</div>
				</div>
				<!-- Modal body -->
				<div class="border-modal" style="width:90%; height:auto; top:50px;">
					<div style="padding:5px;">
						<input name="uploadfile" id="uploadfile1" class="easyui-filebox" style="width:100%;"
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
						<input name="filenm" id="filenm" style="margin-left:0px;margin-top:-20px;border:none;width:90%;" readonly>
					</div>
				</div>
				<div class="font-excel-template" style="width:auto; top:140px;">
					<a href="action/file_RKB_new_update_SecSize2.xlsx" target="_blank" style="font-size:14px;line-height:18px;text-decoration:none;color:#359DD9;">
						Download order breakdown template </a><br>
					<span style="color:red; font-style: italic; font-size:12px;line-height:16px;">
						<!-- (Update excel template coloumn DDP & Sec.Size)  -->
						(default upload template)
					</span>
					<br><br>
					<div style="font-size:14px;line-height:24px;text-decoration:none;color:#000000;">Apa yang ingin anda lakukan?<br>
						<select class="easyui-combobox" style="width:460px; height:28px;" name="typeupload" id="typeupload"
							data-options="panelHeight:'auto'">
							<option value="1">Tambahkan data baru yang saya upload kepada order.</option>
							<option value="2">Replace data yang ada di order dengan data baru yang saya upload.</option>
						</select>
					</div>
				</div>
				<a style="text-decoration:none; left: 250px; top: 270px;" href="javascript:void(0)"
					class="button-cancel" onclick="cancel1();">Cancel</a>
				<a id="submit1a" style="text-decoration:none; left: 340px; top: 270px; width:150px;display:none;" href="javascript:void(0)"
					class="button-submit" onclick="consaveupload();">Submit</a>
				<a id="submit2a" style="text-decoration:none; left: 340px; top: 270px; width:150px;background-color:#BDBDBD;color:#FFFFFF;" href="javascript:void(0)"
					class="button-submit">Submit</a>
				<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
			</div>
		</form>
	</div>

	<!--upload2-->
	<div id="dialog-form2" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:false,modal:true,closable:false"
		style="width:525px;height:300px;padding:5px;display:none;border-radius:8px;top:20%">
		<form id="form2" method="post" enctype="multipart/form-data">
			<!-- <div class="modal-dialog" style="width:98%; height:96%;"> -->
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div style="padding:10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">
						Add order breakdown for a number of order
					</div>
				</div>
				<!-- Modal body -->
				<div class="border-modal" style="width:90%; height:auto;top:50px;">
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
					<!-- <div align="center" style="padding:10px;">
						<img src="css/images/xls.png" style="width:18px; height:18px;">
						<input name="file" style="border:none;" readonly>
					</div> -->
				</div>
				<div class="font-excel-template" style="width:auto; top:100px;">
					<a href="action/file_RKB_new2_update_SecSize.xlsx" target="_blank" style="font-size:14px;line-height:18px;text-decoration:none;color:#359DD9;">
						Download order breakdown template </a><br>
					<span style="color:red; font-style: italic; font-size:12px;line-height:16px;">
						<!-- (Update excel template coloumn DDP & Sec.Size)  -->
						(default upload template)
					</span>
					<br><br>
					<div style="font-size:14px;line-height:24px;text-decoration:none;color:#000000;">Apa yang ingin anda lakukan?<br>
						<select class="easyui-combobox" style="width:460px; height:28px;" name="typeupload" id="typeupload"
							data-options="panelHeight:'auto'">
							<option value="1">Tambahkan data baru yang saya upload kepada order.</option>
							<option value="2">Replace data yang ada di order dengan data baru yang saya upload.</option>
						</select>
					</div>
				</div>
				<a style="text-decoration:none; left: 250px; top: 230px;" href="javascript:void(0)"
					class="button-cancel" onclick="cancel2();">Cancel</a>
				<a id="submit1b" style="text-decoration:none; left: 340px; top: 230px; width:150px;display:none;" href="javascript:void(0)"
					class="button-submit" onclick="save2();">Submit</a>
				<a id="submit2b" style="text-decoration:none; left: 340px; top: 230px; width:150px;background-color:#BDBDBD;color:#FFFFFF;" href="javascript:void(0)"
					class="button-submit">Submit</a>
			</div>
		</form>
	</div>

	<div id="dialog-update" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:false,modal:true,closable:false"
		style="width:525px;height:230px;padding:5px;display:none;border-radius:8px;top:20%">
		<form id="form-update" method="post" enctype="multipart/form-data">
			<!-- <div class="modal-dialog" style="width:98%; height:96%;"> -->
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div style="padding:10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">
						Update order detail data for multiple orders
					</div>
				</div>
				<!-- Modal body -->
				<div class="border-modal" style="width:90%; height:auto;top:50px;">
					<div style="padding:5px;">
						<input name="uploadfile" id="uploadfile4" class="easyui-filebox" style="width:100%;"
							data-options="
							buttonText:'Upload order excel file',
							buttonAlign:'left',
							label:'',
							labelPosition: '',
							labelWidth:'',
							required:'true',
							validType:''">
					</div>
					<!-- <div align="center" style="padding:10px;">
						<img src="css/images/xls.png" style="width:18px; height:18px;">
						<input name="file" style="border:none;" readonly>
					</div> -->
				</div>
				<div class="font-excel-template" style="width:auto; top:100px;">
					<a onclick="dupdate1();" target="_blank" style="font-size:14px;line-height:18px;text-decoration:none;color:#359DD9;">
						Download order breakdown template </a><br>
					<span style="color:red; font-style: italic; font-size:12px;line-height:16px;">
						<!-- (Update excel template coloumn DDP & Sec.Size)  -->
						(template sesuai breakdown id)
					</span>
					<br><br>
					<!-- <div style="font-size:14px;line-height:24px;text-decoration:none;color:#000000;">Apa yang ingin anda lakukan?<br>
				<select class="easyui-combobox" style="width:460px; height:28px;" name="typeupload" id="typeupload"
				data-options="panelHeight:'auto'">
				<option value="1">Tambahkan data baru yang saya upload kepada order.</option>
				<option value="2">Replace data yang ada di order dengan data baru yang saya upload.</option>
				</select>
				</div> -->
				</div>
				<a style="text-decoration:none; left: 250px; top: 180px;" href="javascript:void(0)"
					class="button-cancel" onclick="canceledt();">Cancel</a>
				<a id="submit1d" style="text-decoration:none; left: 340px; top: 180px; width:150px;display:none;" href="javascript:void(0)"
					class="button-submit" onclick="saveedt();">Submit</a>
				<a id="submit2d" style="text-decoration:none; left: 340px; top: 180px; width:150px;background-color:#BDBDBD;color:#FFFFFF;" href="javascript:void(0)"
					class="button-submit">Submit</a>
			</div>
		</form>
	</div>

	<!-- Upload Costing -->
	<div id="dialog-form2b" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:false,modal:true,closable:false"
		style="width:425px;height:250px;padding:5px 5px;display:none;top:20%;border-radius:8px;">
		<form id="form2b" method="post" enctype="multipart/form-data">
			<!-- <div class="modal-dialog" style="width:98%; height:96%;"> -->
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div class="modal-title">Add Costing Data
					</div>
				</div>
				<!-- Modal body -->
				<div class="border-modal" style="height:auto;">
					<div style="padding:5px;">
						<input name="uploadfile" id="uploadfile3" class="easyui-filebox" style="width:100%;"
							data-options="
							buttonText:'Upload costing excel file',
							buttonAlign:'left',
  							label:'',
  							labelPosition: '',
  							labelWidth:'',
							required:'true',
  							validType:''">
					</div>
					<!-- <div align="center" style="padding:10px;">
	<img src="css/images/xls.png" style="width:18px; height:18px;">
	<input name="file" style="border:none;" readonly>
	</div> -->
				</div>
				<div class="font-excel-template" style="width:auto; top:140px;">
					<a target="_blank" onclick="dcost1();"
						style="text-decoration:none;"> Download costing template </a>
				</div>
				<a style="text-decoration:none; left: 129px; top: 185px;" href="javascript:void(0)"
					class="button-cancel" onclick="cancel3()">Cancel</a>
				<a id="submit1c" style="text-decoration:none; left: 206px; top: 185px; width:150px;display:none;" href="javascript:void(0)"
					class="button-submit" onclick="savecost();">Submit</a>
				<a id="submit2c" style="text-decoration:none; left: 206px; top: 185px; width:150px;background-color:#BDBDBD;color:#FFFFFF;" href="javascript:void(0)"
					class="button-submit">Submit</a>
				<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
			</div>
			<!-- </div> -->
		</form>
	</div>
	<!-- add order -->
	<div id="dialog-form-add" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,closable:false,resizable:false,modal:true"
		style="width:882px;height:630px;padding:5px 5px;display:none;top:0px;border-radius:8px;">
		<form id="form-add" method="post">
			<input type="hidden" name="ordpk" id="ordpkcreate" readonly>
			<div class="modal-content">
				<div style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Create new order
					<!-- <a href="javascript:void(0)"
				style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:350px;"
				onclick="$('#dialog-form-add').dialog('close'); $('#form-add').form('reset');"> X</a> -->
				</div>
				<div class="fitem">
					<label>Stage Order</label></br>
					<input style="width:140px; height:28px;" id="stage" name="stage" class="easyui-combobox"
						required="true" data-options="prompt:'Stage Order',panelHeight:'auto',editable:false,
				data: [
				{value:'Salesman',text:'Salesman'},
				{value:'Bulk Order',text:'Bulk Order'}
				]">
				</div>

				<div style="margin-left: 25px; margin-top:10px; font-size: 16px; font-style: normal; font-weight: 700; line-height: 20px;">
					Order information
					<input type="hidden" name="srno" id="srnocr">
					<input type="hidden" name="statuspk" id="statuspkcr">
					<input type="hidden" name="matadd" id="matcr">
				</div>

				<!-- <div id="informasi1-add" style="margin-left: 25px; margin-top:0px; font-size: 14px; line-height: 18px;">
				<span style="font-weight:400px;">
				Did you create a sample? (SR number)
				</span>
				<a id="importsradd" href="javascript:void(0)" onclick="importsradd();" style="font-weight:700px;color:#359DD9;text-decoration:none;">
				import sample data</a>
				</div> -->

				<div id="informasi1-add" style="margin-left: 25px; margin-top:0px;">
					<!-- <span style="font-weight:400px;">
				Did you create a sample? (SR number)
				</span> -->
					<a id="importsradd" href="javascript:void(0)" onclick="importsradd();" style="font-weight:700px;color:#359DD9;text-decoration:none;">
						Please insert SR number</a>
				</div>

				<!-- <div id="informasi2-add" style="display:none;margin-left: 25px; margin-top:0px; font-size: 14px; line-height: 18px;">
				<span id="srnoadd" style="font-weight:700px;"></span>
				<a id="changesr-add" href="javascript:void(0)" onclick="importsradd();" style="font-weight:700px;color:#359DD9;text-decoration:none;">
				Change</a>
				<a id="removesr-add" href="javascript:void(0)" onclick="removesradd();" style="font-weight:700px;color:#359DD9;text-decoration:none;">
				Remove</a>
				</div> -->

				<div id="informasi2-add" style="display:none;margin-left: 25px; margin-top:0px;">
					<span id="srnoadd" style="font-weight:700px;"></span>
					<a id="changesr-add" href="javascript:void(0)" onclick="importsradd();" style="font-weight:700px;color:#359DD9;text-decoration:none;">
						Change</a>
					<a id="removesr-add" href="javascript:void(0)" onclick="removesradd();" style="font-weight:700px;color:#359DD9;text-decoration:none;">
						Remove</a>
				</div>

				<div class="fitem">
					<label>Year ID</label>
					<label style="margin-left:-7.5%;">Month</label>
					<label style="margin-left:-6%;">Order Number</label>
				</div>
				<div class="fitem" style="margin-top:0px;">
					<div style="display: flex; align-items: center;gap:5px;">
						<select class="easyui-combobox" name="thn" id="thn" data-options="editable:false, panelHeight:'auto',prompt:'Year'" style="width:85px;">
							<option></option>
							<?php
							for ($i = date('Y'); $i <= date('Y') + 1; $i++) {
							?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php } ?>
						</select>
						<?php
						$bln = array(1 => "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "Desember");
						$bln1 = date('m');
						if ($bln1 <= 9) {
							$bln2 = substr($bln1, 1, 1);
						} else {
							$bln2 = $bln1;
						}
						?>
						<select class="easyui-combobox" name="bln" id="bln"
							data-options="editable:false,prompt:'Month',limitToList:'true',onChange:ordno" style="width:100px;">
							<option></option>
							<?php
							for ($bulan = 1; $bulan <= 12; $bulan++) {
							?>
								<option value="<?php echo $bulan; ?>"><?php echo $bln[$bulan]; ?></option>
							<?php } ?>
						</select>
						<input name="ordno1" id="ordcreate" placeholder="Order Number" class="easyui-validatebox" style="width: 150px; height:34px;">
						<input name="ordno2" id="ordcreate2" placeholder="Order Number" class="easyui-validatebox" style="background-color:#F1F1F1;color:#00000061;display:none;width: 150px; height:34px;" readonly>
						<input id="kali" name="kali" placeholder="" class="easyui-validatebox" style="width:50px; height:34px; display:none;">
						<span id="multi" style="margin-left: 10px;margin-left:0px; display:none;">
							<input class="easyui-checkbox" name="cekkali" value="1" data-options="label:'',labelPosition:'after',onChange:function(checked){ $('#kali').toggle(checked); }">
							<strong>Book multiple order numbers*</strong></br>
							<span style="color:#00000061; font-size:12px;">
								*Nomor OP akan berurutan sesuai jumlah booking
							</span>
						</span>
					</div>
				</div>

				<div class="fitem">
					<label>Buyer</label>
					<label style="margin-left:15px;">Style Code</label>
				</div>
				<div class="fitem" style="margin-top:0px;">
					<input name="byrpk" id="byrpkcr" required="true"
						style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="valueField:'byrpk',textField:'byrnm',url:'view/get_data.php?dt=byr2&e=1',prompt:'Choose Buyer',limitToList:'true'">

					<input name="artno" id="artno" placeholder="Input style code..." class="easyui-validatebox" style="width:244px; height:34px;" required="true">
				</div>

				<div class="fitem">
					<label>Style Description</label></br>
					<input name="prodes" id="prodescr" class="easyui-textbox" multiline="true" style="width:500px;height:55px" prompt="Input Style description..." required="true">
				</div>
				<!-- <div class="fitem">
					<label>Season</label></br>
					<select class="easyui-combobox" style="width:140px; height:28px;" name="gseason" id="season_id"
						data-options="prompt:'Season',panelHeight:'auto', required:'true'">
						<option value=""></option>
						<option value="Spring">Spring</option>
						<option value="Summer">Summer</option>
						<option value="Fall">Fall</option>
						<option value="Winter">Winter</option>
					</select>
				</div> -->
				<div class="fitem">
					<label>Season</label>
					<label style="margin-left:95px;">Delivery Date</label>
				</div>
				<div class="fitem" style="margin-top:0px;">
					<input name="season" id="seasoncr" placeholder="Input Buyer’s season code..." class="easyui-validatebox" style="width:244px; height:34px;" required="true">
					<input name="deldate3" id="deldate2" data-options="formatter:myformatter,parser:myparser"
						class="easyui-datebox" style="width: 150px; height:34px;">
				</div>

				<div id="style-photo" class="border-modal" style="width:126px;height:126px;margin-top:43%;margin-left:0px;">
					<div id="btn-add-image" style="margin-top:45px;font-family:'Arial';font-style:normal;font-weight:400;font-size:14px;line-height:18px;text-align:center;cursor:pointer;color:#359DD9;"
						onclick="onAddOrChangeUploadImage();">+<br>product image</div>
				</div>
				<div id="style-photo2" class="border-modal" style="display: none;align-items: center;justify-content: center;width:250px;height:128px;margin-top:43%;margin-left:0px;">
					<!-- <input type="number" name="countImages" id="countImages" value="0" hidden> -->
					<img id="showCoverImage" style="display:none;margin-left:-100px;width:120px;height:120px;padding:5px;">&nbsp;&nbsp;&nbsp;
					<img id="showCoverImage2" style="display:none;width:120px;height:120px;padding:5px;">
					<div style="display:none;margin-top:-125px;margin-left:100px;width:auto;height:auto;" id="divCountLingkaran">
						<img id="imgCountLingkaran" style="width:25px;height:25px;">
					</div>
					<div id="btn-change-image" style="display:none;margin-top:160px;margin-left:-150px;font-family:'Arial';font-style:normal;font-weight:700;font-size:14px;line-height:18px;color:#359DD9;cursor:pointer;" onclick="changeImage();">Change</div>
				</div>

				<a style="text-decoration:none; left:607px; margin-top:580px;border:1px solid #000;" href="javascript:void(0)" class="button-cancel"
					onclick="canceladd();">Cancel</a>
				<a id="btn-create-non-aktif" style="text-decoration:none; left:682px; margin-top:580px;background-color:#BDBDBD;color:#FFFFFF;" href="javascript:void(0)"
					class="button-submit">Create New Order(s)</a>
				<a id="btn-create-aktif" style="display:none;text-decoration:none; left:682px; margin-top:580px;" href="javascript:void(0)"
					class="button-submit" onclick="save3();">Create New Order(s)</a>
			</div>
		</form>
	</div>

	<div id="dialog-form3" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,closable:false,resizable:false,modal:true"
		style="width:600px;height:600px;padding:5px 5px;display:none;top:20%;border-radius:8px;">
		<form id="form3" method="post">
			<input type="hidden" name="ordpk" id="ordpk">
			<div class="modal-content">
				<div
					style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Add Order
					<a href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:400px;"
						onclick="$('#dialog-form3').dialog('close'); $('#form3').form('reset');"> X</a>
				</div>
				<div class="fitem">
					<label>Order no</label></br>
					<input name="ordno" id="ordno" class="easyui-validatebox" style="width: 150px; height:34px;"
						required="true">
				</div>
				<div class="fitem">
					<label>Stage</label></br>
					<input style="width:140px; height:28px;" id="stage" name="stage" class="easyui-combobox"
						required="true" data-options="prompt:'Stage',panelHeight:'auto',
						data: [
						{value:'Salesman',text:'Salesman'},
						{value:'Bulk Order',text:'Bulk Order'}
						]">
				</div>
				<div class="fitem">
					<label>Buyer</label><br>
					<input name="byrpk" id="byrpk" required="true"
						style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="valueField:'byrpk',textField:'byrnm',url:'view/get_data.php?dt=byr2&e=1',prompt:'Buyer',limitToList:'true'">
				</div>
				<div class="fitem">
					<label>Style code</label></br>
					<input name="artno" id="artno" class="easyui-validatebox" style="width:244px; height:34px;"
						required="true">
				</div>
				<div class="fitem">
					<label>Style description</label></br>
					<textarea name="prodes" id="prodes" class="easyui-validatebox" style="width:500px; height: 55px;"
						required="true"></textarea>
				</div>
				<!-- <div class="fitem">
					<label>Season</label></br>
					<select class="easyui-combobox" style="width:140px; height:28px;" name="gseason" id="season_id"
						data-options="prompt:'Season',panelHeight:'auto', required:'true'">
						<option value=""></option>
						<option value="Spring">Spring</option>
						<option value="Summer">Summer</option>
						<option value="Fall">Fall</option>
						<option value="Winter">Winter</option>
					</select>
				</div> -->
				<div class="fitem">
					<label>Season</label></br>
					<input name="season" id="season" class="easyui-validatebox"
						style="width: 150px; height:34px;" required="true">
				</div>
				<div class="fitem">
					<label>SR no</label></br>
					<input type="text" name="srno" id="srno" class="easyui-validatebox" autocomplete="off">
					<div id="suggestions-container" class="suggestions-container"></div>
				</div>
				<div class="fitem">
					<label>Delivery Date</label></br>
					<input name="deldate3" id="deldate2" data-options="formatter:myformatter,parser:myparser"
						class="easyui-datebox" style="width: 150px; height:34px;">
				</div>
				<a style="text-decoration:none; left:275px; margin-top:620px;" href="javascript:void(0)"
					class="button-cancel"
					onclick="jQuery('#dialog-form3e').dialog('close'); $('#form3e').form('reset');">Cancel</a>
				<a style="text-decoration:none; left:350px; margin-top:620px;" href="javascript:void(0)" value="Save"
					class="button-submit" onclick="save3();">Save</a>
			</div>
		</form>
	</div>
	<!-- edit order -->
	<div id="dialog-form-edit" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,closable:false,resizable:false,modal:true"
		style="width:882px;height:630px;padding:5px 5px;display:none;top:0px;border-radius:8px;">
		<form id="form-edit" method="post">
			<input type="hidden" name="ordpk" id="ordpkedt" readonly>
			<div class="modal-content">
				<div style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Edit order
					<!-- <a href="javascript:void(0)"
				style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:350px;"
				onclick="$('#dialog-form-add').dialog('close'); $('#form-add').form('reset');"> X</a> -->
				</div>
				<div class="fitem">
					<label>Stage Order</label></br>
					<input style="width:140px; height:28px;" id="stage" name="stage" class="easyui-combobox"
						required="true" data-options="prompt:'Stage Order',panelHeight:'auto',editable:false,
				data: [
				{value:'Salesman',text:'Salesman'},
				{value:'Bulk Order',text:'Bulk Order'}
				]">
				</div>

				<div style="margin-left: 25px; margin-top:10px; font-size: 16px; font-style: normal; font-weight: 700; line-height: 20px;">
					Order information
					<input type="hidden" name="srno" id="srnoedt">
					<input type="hidden" name="statuspk" id="statuspkedt">
					<input type="hidden" name="matadd" id="matedt">
				</div>

				<!-- <div id="informasi1-edit" style="display:none;margin-left: 25px; margin-top:0px; font-size: 14px; line-height: 18px;">
				<span style="font-weight:400px;">
				Did you create a sample? (SR number)
				</span>
				<a id="importsr-edit" href="javascript:void(0)" onclick="importsradd();" style="font-weight:700px;color:#359DD9;text-decoration:none;">
				import sample data</a>
				</div> -->

				<div id="informasi1-edit" style="display:none;margin-left: 25px; margin-top:0px;">
					<!-- <span style="font-weight:400px;">
				Did you create a sample? (SR number)
				</span> -->
					<a id="importsr-edit" href="javascript:void(0)" onclick="importsradd();" style="font-weight:700px;color:#359DD9;text-decoration:none;">
						Please insert SR number</a>
				</div>

				<!-- <div id="informasi2-edit" style="font-weight:700;margin-left: 25px; margin-top:0px; font-size: 14px; line-height: 18px;">
				<span id="srsync-edit"></span>
				<a id="changesr-edit" href="javascript:void(0)" onclick="importsradd()" style="font-weight:700px;color:#359DD9;text-decoration:none;">
				Change</a>
				<a id="removesr-edit" href="javascript:void(0)" onclick="removesradd();" style="font-weight:700px;color:#359DD9;text-decoration:none;">
				Remove</a>
				</div> -->

				<div id="informasi2-edit" style="font-weight:700;margin-left: 25px; margin-top:0px;">
					<span id="srsync-edit"></span>
					<a id="changesr-edit" href="javascript:void(0)" onclick="importsradd()" style="font-weight:700px;color:#359DD9;text-decoration:none;">
						Change</a>
					<a id="removesr-edit" href="javascript:void(0)" onclick="removesradd();" style="font-weight:700px;color:#359DD9;text-decoration:none;">
						Remove</a>
				</div>

				<div class="fitem">
					<!-- <label>Year ID</label>
				<label style="margin-left:-7.5%;">Month</label> -->
					<label>Order Number</label>
				</div>
				<div class="fitem" style="margin-top:0px;">
					<div style="display: flex; align-items: center;gap:5px;">
						<!-- <select class="easyui-combobox" name="thn" id="thn" data-options="editable:false, panelHeight:'auto',prompt:'Year'" style="width:85px;">
				<option></option>
				<?php
				// for ($i = date('Y'); $i <= date('Y') + 1; $i++) {
				?>
				<option value="<?php //echo $i; 
								?>"><?php //echo $i; 
									?></option>
				<?php //} 
				?>
				</select>
				<?php
				// $bln=array(1=>"January","February","March","April","May","June","July","August","September","October","November","Desember");
				// $bln1=date('m');
				// if($bln1<=9){
				// //$bln2 = substr($bln1,1,1);
				// } else {
				// //$bln2 = $bln1; 
				// }
				?>
				<select class="easyui-combobox" name="bln" id="bln"
				data-options="editable:false,prompt:'Month',limitToList:'true',onChange:ordno" style="width:100px;" >
				<option></option>
				<?php
				//for($bulan=1; $bulan<=12; $bulan++){
				?>
				<option value="<?php //echo $bulan; 
								?>"><?php //echo $bln[$bulan]; 
									?></option>
				<?php //} 
				?>
				</select> -->
						<!-- <input id="ordcreate" placeholder="Order Number" class="easyui-validatebox" style="width: 150px; height:34px;"> -->
						<input name="ordno" id="ordcreate2-edit" placeholder="Order Number" class="easyui-validatebox" style="width: 150px; height:34px;">
						<!-- <input id="kali" name="kali" placeholder="" class="easyui-validatebox" style="width:50px; height:34px; display:none;">
    			<input class="easyui-checkbox" name="cekkali" value="1" data-options="label:'',labelPosition:'after',onChange:function(checked){ $('#kali').toggle(checked); }">
    			<span style="margin-left: 10px;margin-left:0px;">
        		<strong>Book multiple order numbers*</strong></br>
        		<span style="color:#00000061; font-size:12px;">
            	*Nomor OP akan berurutan sesuai jumlah booking
        		</span>
    			</span> -->
					</div>
				</div>

				<div class="fitem">
					<label>Buyer</label>
					<label style="margin-left:15px;">Style Code</label>
				</div>
				<div class="fitem" style="margin-top:0px;">
					<input name="byrpk" id="byrpkedt" required="true"
						style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="valueField:'byrpk',textField:'byrnm',url:'view/get_data.php?dt=byr2&e=1',prompt:'Choose Buyer',limitToList:'true'">

					<input name="artno" id="artno" placeholder="Input style code..." class="easyui-validatebox" style="width:244px; height:34px;" required="true">
				</div>

				<div class="fitem">
					<label>Style Description</label></br>
					<input name="prodes" id="prodesedt" class="easyui-textbox" multiline="true" style="width:500px;height:55px" prompt="Input Style description..." required="true">
				</div>
				<!-- <div class="fitem">
					<label>Season</label></br>
					<select class="easyui-combobox" style="width:140px; height:28px;" name="gseason" id="season_id"
						data-options="prompt:'Season',panelHeight:'auto', required:'true'">
						<option value=""></option>
						<option value="Spring">Spring</option>
						<option value="Summer">Summer</option>
						<option value="Fall">Fall</option>
						<option value="Winter">Winter</option>
					</select>
				</div> -->
				<div class="fitem">
					<label>Season</label>
					<label style="margin-left:95px;">Delivery Date</label>
				</div>
				<div class="fitem" style="margin-top:0px;">
					<input name="season" id="seasonedt" placeholder="Input Buyer’s season code..." class="easyui-validatebox" style="width:244px; height:34px;" required="true">
					<input name="deldate3" id="deldate2" data-options="formatter:myformatter,parser:myparser"
						class="easyui-datebox" style="width: 150px; height:34px;">
				</div>

				<div id="style-photo-edit" class="border-modal" style="display: none;width:126px;height:126px;margin-top:43%;margin-left:0px;">
					<div id="btn-add-image" style="margin-top:45px;font-family:'Arial';font-style:normal;font-weight:400;font-size:14px;line-height:18px;text-align:center;cursor:pointer;color:#359DD9;"
						onclick="onAddOrChangeUploadImage();">+<br>product image</div>
				</div>
				<div id="style-photo2-edit" class="border-modal" style="align-items: center;justify-content: center;width:250px;height:128px;margin-top:43%;margin-left:0px;">
					<!-- <input type="number" name="countImages-edit" id="countImages-edit" value="0" hidden> -->
					<img id="showCoverImage-edit" style="display:none;margin-left:-100px;width:120px;height:120px;padding:5px;">&nbsp;&nbsp;&nbsp;
					<img id="showCoverImage2-edit" style="display:none;width:120px;height:120px;padding:5px;">
					<div style="display:none;margin-top:-125px;margin-left:100px;width:auto;height:auto;" id="divCountLingkaran">
						<img id="imgCountLingkaran" style="width:25px;height:25px;">
					</div>
					<div id="btn-change-image-edit" style="margin-top:160px;margin-left:-150px;font-family:'Arial';font-style:normal;font-weight:700;font-size:14px;line-height:18px;color:#359DD9;cursor:pointer;" onclick="changeImage();">Change</div>
				</div>

				<a style="text-decoration:none; left:607px; margin-top:580px;border:1px solid #000;" href="javascript:void(0)" class="button-cancel"
					onclick="canceledit();">Cancel</a>
				<!-- <a id="btn-edit-non-aktif" style="text-decoration:none; left:682px; margin-top:580px;background-color:#BDBDBD;color:#FFFFFF;" href="javascript:void(0)"
				class="button-submit">Save</a> -->
				<a id="btn-edit-aktif" style="text-decoration:none; left:682px; margin-top:580px;" href="javascript:void(0)"
					class="button-submit" onclick="save3e();">Save</a>
			</div>
		</form>
	</div>

	<div id="dialog-form3e" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,closable:false,resizable:false,modal:true"
		style="width:600px;height:600px;padding:5px 5px;display:none;top:20%;border-radius:8px;">
		<form id="form3e" method="post">
			<input type="hidden" name="ordpk" id="ordpk">
			<div class="modal-content">
				<div
					style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Edit Order
					<a href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:400px;"
						onclick="$('#dialog-form3e').dialog('close'); $('#form3e').form('reset');"> X</a>
				</div>
				<div class="fitem">
					<label>Order no</label></br>
					<input name="ordno" id="ordno" class="easyui-validatebox" style="width: 150px; height:34px;"
						required="true">
				</div>
				<div class="fitem">
					<label>Stage</label></br>
					<input style="width:140px; height:28px;" id="stage" name="stage" class="easyui-combobox"
						required="true" data-options="prompt:'Stage',panelHeight:'auto',
							data: [
							{value:'Salesman',text:'Salesman'},
							{value:'Bulk Order',text:'Bulk Order'}
							]">
				</div>
				<div class="fitem">
					<label>Buyer</label><br>
					<input name="byrpk" id="byrpk" required="true"
						style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="valueField:'byrpk',textField:'byrnm',url:'view/get_data.php?dt=byr2&e=1',prompt:'Buyer',limitToList:'true'">
				</div>
				<div class="fitem">
					<label>Style</label></br>
					<input name="artno" id="artno" class="easyui-validatebox" style="width:244px; height:34px;"
						required="true">
				</div>
				<div class="fitem">
					<label>Style description</label></br>
					<textarea name="prodes" id="prodes" class="easyui-validatebox" style="width:500px; height: 55px;"
						required="true"></textarea>
				</div>
				<!-- <div class="fitem">
					<label>Season</label></br>
					<select class="easyui-combobox" style="width:140px; height:28px;" name="gseason" id="season_id"
						data-options="prompt:'Season',panelHeight:'auto', required:'true'">
						<option value=""></option>
						<option value="Spring">Spring</option>
						<option value="Summer">Summer</option>
						<option value="Fall">Fall</option>
						<option value="Winter">Winter</option>
					</select>
				</div> -->
				<div class="fitem">
					<label>Season</label></br>
					<input name="season" id="season" class="easyui-validatebox"
						style="width: 150px; height:34px;" required="true">
				</div>
				<div class="fitem">
					<label>SR no</label></br>
					<input type="text" name="srno" id="srno2" class="easyui-validatebox" autocomplete="off">
					<div id="suggestions-container2" class="suggestions-container"></div>
				</div>
				<div class="fitem">
					<label>Delivery Date</label></br>
					<input name="deldate3" id="deldate2" data-options="formatter:myformatter,parser:myparser"
						class="easyui-datebox" style="width: 150px; height:34px;">
				</div>
				<a style="text-decoration:none; left:275px; margin-top:620px;" href="javascript:void(0)"
					class="button-cancel"
					onclick="jQuery('#dialog-form3e').dialog('close'); $('#form3e').form('reset');">Cancel</a>
				<a style="text-decoration:none; left:350px; margin-top:620px;" href="javascript:void(0)" value="Save"
					class="button-submit" onclick="save3e();">Save</a>
			</div>
		</form>
	</div>

	<div id="dialog-formcut" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,closable:false,resizable:false,modal:true"
		style="width:90%;height:100%;display:none;top:0px;border-radius:8px;">
		<form id="formcut" method="post">
			<input type="hidden" name="ordpkcut" id="ordpkcut" value="">
			<div class="modal-content">
				<div id="close" style="margin-top:10px; margin-left:95%;">
					<a id="close" href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
						onclick="$('#dialog-formcut').dialog('close'); $('#formcut').form('reset');">X</a>
				</div>
				<div
					style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">
					Material arrival records</div>
				<div id="opcut"
					style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">
				</div>
				<div id="tabelcut" style="margin-top:15px;margin-left: 10px;">
					<table id="dgcut" class="easyui-datagrid" title="" style="width:98%;height:515px;" align="center"
						url="view/get_dtcut.php" toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]"
						pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="true"
						method="post" data-options="multiSort:true,remoteSort:false">
						<thead>
							<tr>
								<th field="pono" width="80">PO</th>
								<th field="item" width="120">Item</th>
								<th field="spec" width="120">Description</th>
								<th field="supnm" width="120">Supplier</th>
								<th field="colname" width="80">Color</th>
								<!-- <th field="price" width="90">Price</th> -->
								<th field="pocons" width="90" styler="styler4">Quantity</th>
								<th field="qtydtg" width="90">Arrival qty</th>
								<th field="balance" width="90">Balance</th>
								<th field="etd" width="90">Supplier ETD</th>
								<th field="eta" width="90">ETA</th>
								<th field="eih" width="90">EIH</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</form>
	</div>

	<div id="dialog-formsew" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,closable:false,resizable:false,modal:true"
		style="width:90%;height:100%;display:none;top:0px;border-radius:8px;">
		<form id="formsew" method="post">
			<input type="hidden" name="ordpksew" id="ordpksew" value="">
			<div class="modal-content">
				<div id="close" style="margin-top:10px; margin-left:95%;">
					<a id="close" href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
						onclick="$('#dialog-formsew').dialog('close'); $('#formsew').form('reset');">X</a>
				</div>
				<div
					style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">
					Material arrival records</div>
				<div id="opsew"
					style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">
				</div>
				<div id="tabelsew" style="margin-top:15px;margin-left: 10px;">
					<table id="dgsew" class="easyui-datagrid" title="" style="width:98%;height:515px;;" align="center"
						url="view/get_dtsew.php" toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]"
						pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="true"
						method="post" data-options="multiSort:true,remoteSort:false">
						<thead>
							<tr>
								<th field="pono" width="80">PO</th>
								<th field="item" width="120">Item</th>
								<th field="spec" width="120">Description</th>
								<th field="supnm" width="120">Supplier</th>
								<th field="colname" width="80">Color</th>
								<!-- <th field="price" width="90">Price</th> -->
								<th field="pocons" width="90" styler="styler4">Quantity</th>
								<th field="qtydtg" width="90">Arrival qty</th>
								<th field="balance" width="90">Balance</th>
								<th field="etd" width="90">Supplier ETD</th>
								<th field="eta" width="90">ETA</th>
								<th field="eih" width="90">EIH</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</form>
	</div>

	<div id="dialog-formfin" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,closable:false,resizable:false,modal:true"
		style="width:90%;height:100%;display:none;top:0px;border-radius:8px;">
		<form id="formfin" method="post">
			<input type="hidden" name="ordpkfin" id="ordpkfin" value="">
			<div class="modal-content">
				<div id="close" style="margin-top:10px; margin-left:95%;">
					<a id="close" href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
						onclick="$('#dialog-formfin').dialog('close'); $('#formfin').form('reset');">X</a>
				</div>
				<div
					style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">
					Material arrival records</div>
				<div id="opfin"
					style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">
				</div>
				<div id="tabelfin" style="margin-top:15px;margin-left: 10px;">
					<table id="dgfin" class="easyui-datagrid" title="" style="width:98%;height:515px;" align="center"
						url="view/get_dtfin.php" toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]"
						pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="true"
						method="post" data-options="multiSort:true,remoteSort:false">
						<thead>
							<tr>
								<th field="pono" width="80">PO</th>
								<th field="item" width="120">Item</th>
								<th field="spec" width="120">Description</th>
								<th field="supnm" width="120">Supplier</th>
								<th field="colname" width="80">Color</th>
								<!-- <th field="price" width="90">Price</th> -->
								<th field="pocons" width="90" styler="styler4">Quantity</th>
								<th field="qtydtg" width="90">Arrival qty</th>
								<th field="balance" width="90">Balance</th>
								<th field="etd" width="90">Supplier ETD</th>
								<th field="eta" width="90">ETA</th>
								<th field="eih" width="90">EIH</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</form>
	</div>

	<!-- //jasa -->
	<div id="dialog-formjs" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,closable:false,resizable:false,modal:true"
		style="width:90%;height:100%;display:none;top:0px;border-radius:8px;">
		<form id="formjs" method="post">
			<input type="hidden" name="ordpkjs" id="ordpkjs" value="">
			<div class="modal-content">
				<div id="close" style="margin-top:10px; margin-left:95%;">
					<a id="close" href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
						onclick="$('#dialog-formjs').dialog('close'); $('#formjs').form('reset');">X</a>
				</div>
				<div
					style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">
					Material arrival records</div>
				<div id="opfin"
					style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">
				</div>
				<div id="tabeljs" style="margin-top:15px;margin-left: 10px;">
					<table id="dgjs" class="easyui-datagrid" title="" style="width:98%;height:515px;" align="center"
						url="view/get_dtjs.php" toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]"
						pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="true"
						method="post" data-options="multiSort:true,remoteSort:false">
						<thead>
							<tr>
								<th field="pono" width="80">PO</th>
								<th field="item" width="120">Item</th>
								<th field="spec" width="120">Description</th>
								<th field="supnm" width="120">Supplier</th>
								<th field="colname" width="80">Color</th>
								<!-- <th field="price" width="90">Price</th> -->
								<th field="pocons" width="90" styler="styler4">Quantity</th>
								<th field="qtydtg" width="90">Arrival qty</th>
								<th field="balance" width="90">Balance</th>
								<th field="etd" width="90">Supplier ETD</th>
								<th field="eta" width="90">ETA</th>
								<th field="eih" width="90">EIH</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</form>
	</div>

	<div id="dialog-forminfo" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:false,modal:true,closable:false"
		style="width:30%;height:47%;padding:5px 5px;display:none;top:0px;border-radius:8px;">
		<form id="forminfo" method="post">
			<!-- <div class="modal-content"> -->
			<div id="close" style="margin-top:0px; margin-left:90%;">
				<a id="close" href="javascript:void(0)"
					style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
					onclick="$('#dialog-forminfo').dialog('close'); $('#forminfo').form('reset');"> X</a>
			</div>
			<input type="hidden" id="ponoi" name="ponoi">
			<input type="hidden" id="rkbpki" name="rkbpki">
			<div
				style="margin-top:-25px;margin-left: 15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">
				Arrival date record</div><br>
			<div id="tbinf" style="margin-left:15px;">
				<table id="dginf" class="easyui-datagrid" title="" style="width:92%;height:180px;" align="center"
					toolbar="#tb2" striped="false" border="true" pageSize="100" pageList="[100,200,300,500]" pagination="false"
					rownumbers="false" singleSelect="true" collapsible="true" fitColumns="true" data-options="multiSort:false">
					<thead>
						<tr>
							<th field="vassalnm" width="100" formatter="formatter2b">Shipment</th>
							<th field="tgldtg" width="99">Date</th>
							<th field="qtydtg" width="120">Amount</th>
							<th field="popk" width="120" hidden="true">Popk</th>
							<th field="importpk" width="120" hidden="true">importpk</th>
						</tr>
					</thead>
				</table>
			</div>
			<span
				style="margin-left: 15px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
				id="qtyinfo"></span>
			<!-- </div> -->
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
	<div id="dialog-formb" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:true,modal:true,closable:false"
		style="width:425px;height:200px;padding:5px 5px;display:none;top:20%;border-radius:8px;">
		<form id="formb" method="post" enctype="multipart/form-data">
			<input type="hidden" name="ordpk" id="ordpkexp" size="8">
			<!-- <div class="modal-dialog" style="height:175px;"> -->
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div class="modal-title" style="width:auto;font-size:18px;line-height:20px;">
						Export excel Order no. <span id="ordnoexp"></span> <br>
					</div>
				</div>
				<!-- Modal body -->
				<div style="padding:5px; margin-top:60px; margin-left:25px;">
					<span id="cek1"><input type="radio" name="cek" id="cek" value="1" checked> Excel RKB </span>
					<span id="cek2"><input type="radio" name="cek" id="cek" value="2"> Excel OP </span>
				</div>
				<!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
				<a style="text-decoration:none; left: 169px; top: 100px;" href="javascript:void(0)"
					class="button-cancel" onclick="canexp();">Cancel</a>
				<a style="text-decoration:none; width:100px; left: 246px; top: 100px;" href="javascript:void(0)"
					class="button-submit" onclick="exp2();">Export</a>
				<!--<input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
				<!-- </div> -->
		</form>
	</div>

	<!--outstanding-->
	<div id="dialog-formc" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:true,modal:true,closable:false"
		style="width:425px;height:200px;padding:5px 5px;display:none;top:20%;border-radius:8px;">
		<form id="formc" method="post">
			<input type="hidden" name="ordpk" id="ordpkexp2" size="8">
			<!-- <div class="modal-dialog" style="height:175px;"> -->
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div class="modal-title" style="width:auto;font-size:18px;line-height:20px;">
						Export Outstanding Order <br>
						<span style="color:red; font-style: italic; font-size:12px;line-height:16px;font-weight:400;">
							(based on month and year of shipping date in order breakdown)
						</span>
					</div>
				</div><br>
				<!-- Modal body -->
				<div style="padding:5px; margin-top:60px; margin-left:25px;">
					<?php
					$bln = array(
						1 => "January",
						"February",
						"March",
						"April",
						"May",
						"June",
						"July",
						"August",
						"September",
						"October",
						"November",
						"Desember"
					);
					$bln1 = date('m');
					if ($bln1 <= 9) {
						$bln2 = substr($bln1, 1, 1);
					} else {
						$bln2 = $bln1;
					}
					?>
					<select class="easyui-combobox" id="expbln"
						data-options="editable:false,limitToList:'true'" style="width:150px;">
						<option value="">All Month</option>
						<option value="<?php echo $bln1; ?>"><?php echo $bln[$bln2]; ?></option>
						<?php
						for ($bulan = 1; $bulan <= 12; $bulan++) {
						?>
							<option value="<?php echo $bulan; ?>"><?php echo $bln[$bulan]; ?></option>
						<?php } ?>
					</select>
					<select class="easyui-combobox" id="expthn" data-options="editable:false, panelHeight:'auto'"
						style="width:85px;">
						<?php
						for ($i = date('Y'); $i >= date('Y') - 3; $i -= 1) {
						?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>
				<!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
				<a style="text-decoration:none; left: 169px; top: 150px;" href="javascript:void(0)"
					class="button-cancel" onclick="canexp();">Cancel</a>
				<a style="text-decoration:none; width:100px; left: 246px; top: 150px;" href="javascript:void(0)"
					class="button-submit" onclick="exp2b();">Export</a>
				<!--<input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
				<!-- </div> -->
		</form>
	</div>
	</div>

	<div id="dialog-formo" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:true,modal:true,closable:false"
		style="width:425px;height:200px;padding:5px 5px;display:none;top:20%;border-radius:8px;">
		<form id="formo" method="post">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div class="modal-title" style="width:auto;font-size:18px;line-height:20px;">
						Export Order List <br>
						<span style="color:red; font-style: italic; font-size:12px;line-height:16px;font-weight:400;">
							(based on year schedule shipping date)
						</span>
					</div>
				</div><br>
				<!-- Modal body -->
				<div style="padding:5px; margin-top:60px; margin-left:25px;">
					<?php
					// $bln=array(1=>"January","February","March","April","May",
					// "June","July","August","September","October",
					// "November","Desember");
					// $bln1=date('m');
					// if($bln1<=9){
					// $bln2 = substr($bln1,1,1);
					// } else {
					// $bln2 = $bln1; 
					// }
					?>
					<!-- <select class="easyui-combobox" id="expbln"
				data-options="editable:false,limitToList:'true'" style="width:150px;" >
				<option value="">All Month</option>
				<option value="<?php //echo $bln1; 
								?>"><?php //echo $bln[$bln2]; 
									?></option>
				<?php
				//for($bulan=1; $bulan<=12; $bulan++){
				?>
				<option value="<?php //echo $bulan; 
								?>"><?php //echo $bln[$bulan]; 
									?></option>
				<?php //} 
				?>
				</select> -->
					<select class="easyui-combobox" id="expthn2" data-options="editable:false, panelHeight:'auto'"
						style="width:85px;">
						<?php
						for ($i = date('Y'); $i >= date('Y') - 3; $i -= 1) {
						?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>
				<a style="text-decoration:none; left: 169px; top: 150px;" href="javascript:void(0)"
					class="button-cancel" onclick="canexp2();">Cancel</a>
				<a style="text-decoration:none; width:100px; left: 246px; top: 150px;" href="javascript:void(0)"
					class="button-submit" onclick="ordlist();">Export</a>
			</div>
		</form>
	</div>

	<div id="dialog-cost" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:true,modal:true,closable:false"
		style="width:425px;height:200px;padding:5px 5px;display:none;top:20%;border-radius:8px;">
		<form id="form-cost" method="post">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div class="modal-title" style="width:auto;font-size:18px;line-height:20px;">
						Download Costing Template <br>
						<span style="color:red; font-style: italic; font-size:12px;line-height:16px;font-weight:400;">
							(based on the year of input in the system)
						</span>
					</div>
				</div><br>
				<!-- Modal body -->
				<div style="padding:5px; margin-top:60px; margin-left:25px;">
					<?php
					// $bln=array(1=>"January","February","March","April","May",
					// "June","July","August","September","October",
					// "November","Desember");
					// $bln1=date('m');
					// if($bln1<=9){
					// $bln2 = substr($bln1,1,1);
					// } else {
					// $bln2 = $bln1; 
					// }
					?>
					<!-- <select class="easyui-combobox" id="expbln"
				data-options="editable:false,limitToList:'true'" style="width:150px;" >
				<option value="">All Month</option>
				<option value="<?php //echo $bln1; 
								?>"><?php //echo $bln[$bln2]; 
									?></option>
				<?php
				//for($bulan=1; $bulan<=12; $bulan++){
				?>
				<option value="<?php //echo $bulan; 
								?>"><?php //echo $bln[$bulan]; 
									?></option>
				<?php //} 
				?>
				</select> -->
					<select class="easyui-combobox" id="expthn3" data-options="editable:false, panelHeight:'auto'"
						style="width:85px;">
						<?php
						for ($i = date('Y'); $i >= date('Y') - 3; $i -= 1) {
						?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>
				<a style="text-decoration:none; left: 169px; top: 150px;" href="javascript:void(0)"
					class="button-cancel" onclick="candcost();">Cancel</a>
				<a style="text-decoration:none; width:100px; left: 246px; top: 150px;" href="javascript:void(0)"
					class="button-submit" onclick="dcost();">Download</a>
			</div>
		</form>
	</div>

	<div id="dialog-dupdate" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:true,modal:true,closable:false"
		style="width:425px;height:200px;padding:5px 5px;display:none;top:20%;border-radius:8px;">
		<form id="form-dupadate" method="post">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div class="modal-title" style="width:auto;font-size:18px;line-height:20px;">
						Download Order Breakdown Template <br>
						<span style="color:red; font-style: italic; font-size:12px;line-height:16px;font-weight:400;">
							(based on the year of input in the system)
						</span>
					</div>
				</div><br>
				<!-- Modal body -->
				<div style="padding:5px; margin-top:60px; margin-left:25px;">
					<?php
					// $bln=array(1=>"January","February","March","April","May",
					// "June","July","August","September","October",
					// "November","Desember");
					// $bln1=date('m');
					// if($bln1<=9){
					// $bln2 = substr($bln1,1,1);
					// } else {
					// $bln2 = $bln1; 
					// }
					?>
					<!-- <select class="easyui-combobox" id="expbln"
				data-options="editable:false,limitToList:'true'" style="width:150px;" >
				<option value="">All Month</option>
				<option value="<?php //echo $bln1; 
								?>"><?php //echo $bln[$bln2]; 
									?></option>
				<?php
				//for($bulan=1; $bulan<=12; $bulan++){
				?>
				<option value="<?php //echo $bulan; 
								?>"><?php //echo $bln[$bulan]; 
									?></option>
				<?php //} 
				?>
				</select> -->
					<select class="easyui-combobox" id="expthn4" data-options="editable:false, panelHeight:'auto'"
						style="width:85px;">
						<?php
						for ($i = date('Y'); $i >= date('Y') - 3; $i -= 1) {
						?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>
				<a style="text-decoration:none; left: 169px; top: 150px;" href="javascript:void(0)"
					class="button-cancel" onclick="candupdate();">Cancel</a>
				<a style="text-decoration:none; width:100px; left: 246px; top: 150px;" href="javascript:void(0)"
					class="button-submit" onclick="dupdate();">Download</a>
			</div>
		</form>
	</div>

	<script type="text/javascript">
		// window.onscroll = function () { myFunctiona(); };
		// var header = document.getElementById("myHeader");
		// var sticky = header.offsetTop;
		// function myFunctiona() {
		// 	if (window.pageYOffset > sticky) {
		// 		header.classList.add("sticky");
		// 	} else {
		// 		header.classList.remove("sticky");
		// 	}
		// }
	</script>
	<!-- Start Dialog Upload Image -->
	<div id="dialog-upload_image" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true"
		style="width:882px;height:630px;display:none;top:0px;overflow: hidden;border-radius:5px;">
		<form id="form-upload-foto" method="post" enctype="multipart/form-data">
			<input type="number" name="countImages" id="countImages" value="0" hidden>
			<input type="hidden" id="gbr1" name="gbr1" value="0">
			<input type="hidden" id="gbr2" name="gbr2" value="0">
			<input type="hidden" id="ordpkimg" name="ordpkimg">
			<div style="margin-top:1%;margin-left:95%;">
				<a style="text-decoration:none; color:#000; font-size:20px; cursor: pointer;" id="btn-close-first" onclick="onCloseUploadImage('first')">&#10761;</a>
				<a style="text-decoration:none; color:#000; font-size:20px; cursor: pointer;display:none;" id="btn-close-second" onclick="onCloseUploadImage('second')">&#10761;</a>
			</div>
			<div style="margin-top:0%;margin-left:3%;padding-bottom:5px;">
				<div style="font-size: 20px;font-weight: 700;line-height: 24px;text-align: left;">Garment image upload</div>
				<div style="font-size: 14px;font-weight: 400;line-height: 18px;text-align: left;">Silahkan upload gambar tampak depan dan tampak belakang dari garment.<br>
					Gambar perlu dalam ratio 1:1, background putih.</div>
			</div>
			<div style="display: flex;margin-left:3%;margin-top:0%;">
				<img src="css/images/contohbaju.png" style="width:106px;height:106px;margin-right: 10px;">
				<div style="">
					<span style="font-size: 14px;font-weight: 700;line-height: 18px;text-align: left;">Contoh gambar yang baik</span><br>
					<span style="font-size: 14px;font-weight: 400;line-height: 18px;text-align: left;color: #00000099;">Ratio gambar garment 1:1,<br>terlihat besar dan jelas tepat di tengah frame.</span>
				</div>
			</div>
			<div style="text-align:center;margin-top:3%;">
				<span style="font-size: 14px;font-weight: 700;line-height: 18px;text-align: left;">Silahkan upload sesuai keterangan di bawah</span><br>
			</div>
			<div style="display: flex; justify-content: center; align-items: center; margin-top:2%; width: 100%;gap:25px;">
				<?php
				for ($i = 1; $i < 3; $i++) { ?>
					<div class="border-modal3" style="text-align:center;width:200px;height:200px;">
						<img id="btn-close-image-<?php echo $i; ?>" src="css/images/tempat_sampah.png" onclick="onRemoveImage(<?php echo $i; ?>);" style="position:relative;z-index:10;width:24px;height:24px;font-size:150%;margin-left:84%;margin-top:2%;display:none;cursor: pointer;">
						<img id="upload-image-preview-<?php echo $i; ?>" style="margin-top:-10%;width:95%;height:90%;display:none;">
						<img id="upload-image-previewx-<?php echo $i; ?>" style="margin-top:-10%;width:95%;height:90%;display:none;" hidden>
						<div id="upload-style-foto-<?php echo $i; ?>" style="margin-top:75px;font-family:'Arial';font-style:normal;font-weight:400;font-size:14px;line-height:18px;text-align:center;">
							<label id="text-upload-image-<?php echo $i; ?>" for="upload-image-file-<?php echo $i; ?>" style="color:#359DD9;">+<br />product image</label>
							<input type="file" name="file" id="upload-image-file-<?php echo $i; ?>" accept="image/*" onchange="onUploadImage(<?php echo $i; ?>);" hidden>
						</div>
					</div>
				<?php  } ?>
			</div>
			<div style="display: flex;align-items: center;justify-content: center;margin-top:2%;">
				<div style="font-size: 16px;font-weight: 700;line-height: 20px;text-align: left;margin-right:10%;">Tampak Depan</div>
				<div style="font-size: 16px;font-weight: 700;line-height: 20px;text-align: left;margin-left:5%;">Tampak Belakang</div>
			</div>
			<div style="display: flex;align-items: center;justify-content: center;margin-top:10%;">
				<input id="btn-non-aktif" style="text-decoration:none;width:152px;height:34px;cursor:pointer;background-color:#BDBDBD;color:#FFFFFF;outline:none; border:none;" readonly value="Submit Images" class="button-submit">
				<input id="btn-aktif" style="text-decoration:none;width:152px;height:34px;cursor:pointer;background-color:#000000;color:#FFFFFF;outline:none;display:none;" readonly value="Submit Images" class="button-submit" onclick="onSubmitImage();">
			</div>
		</form>
	</div>
	<!-- End Dialog Upload Image -->

	<!-- Start Dialog SR -->
	<div id="dialog-form-sr" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true"
		style="width:882px;height:630px;display:none;top:0px;overflow-x: hidden;border-radius:5px;">
		<!-- <form id="form-sr" method="post"> -->
		<!-- <input type="hidden" id="ordpksr" name="ordpksr"> -->
		<div style="margin-top:0%;margin-left:6%;padding:8px;">
			<div style="font-size: 20px;font-weight: 700;line-height: 24px;text-align: left;">
				<a href="javascript:void(0);" onclick="backadd();"><input type="image" src="css/images/Vector2.png" class="panah-samping" style="margin-left:25px;"></a>
				Insert Sample Development
			</div>
		</div>
		<!-- <div style="margin-top:3%;margin-left:5%;padding:8px;"> -->
		<div id="container-cari" style="margin-top:5%;margin-left:3%;width:270px;">
			<div id="frame-cari" style="width:250px;">
				<img src="css/images/Shape.png" width="18px" height="18px">
				<input id="carisr" placeholder="Search SR number..." class="input" plain="true" onkeyup="Searchsr();">
			</div>
		</div>

		<div id="srempty" style="margin-top:5%;margin-left:3%;width:100%;color:#00000061;">
			Silahkan cari SR melalui search bar di atas
		</div>
		<div id="srfind" onclick="importdata();" style="display:none;margin-top:5%;margin-left:3%;width:100%;">
			<!-- <table id="dgsr" class="easyui-datagrid" title="" style="width:95%;height:auto" align="center"
				url="view/get_sr.php" toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]" method="post"
				idField="srpk" data-options="singleSelect:true,pagination:true,collapsible:true,rownumbers:false,fitColumns:true,
				border:false,autoRowHeight:true"> -->

			<table id="dgsr" class="easyui-datagrid" title="" style="width:95%;height:530px;" align="center"
				url="view/get_sr.php" toolbar="#tb" striped="false" pageSize="100"
				pageList="[100,200,300,500]" pagination="true" rownumbers="false" singleSelect="true"
				collapsible="true" fitColumns="true" method="post"
				data-options="multiSort:true,remoteSort:true">
				<thead>
					<tr>
						<th field="srno" width="90">SR number</th>
						<th field="style" width="90">Style code</th>
						<th field="prodes" width="180">Style description</th>
						<th field="buyernm" width="90">Buyer</th>
						<th field="act" width="60">Action</th>
					</tr>
				</thead>
			</table>
		</div>
		<!-- </div> -->
		<!-- </form> -->
	</div>
	<!-- End Dialog SR -->

	<!-- Start Dialog dev -->
	<div id="dialog-form-dev" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true"
		style="width:385px;height:366px;display:none;top:100px;overflow-x: hidden;border-radius:5px;">
		<form id="form-dev" method="post">
			<input type="hidden" id="srpkpilih">
			<input type="hidden" id="srnopilih">
			<div style="margin-top:5%;margin-left:3%;width:100%;font-weight:700;">
				Sync development history
			</div>
			<div style="margin-left:3%;width:100%;">
				Silahkan pilih informasi yang ingin Anda transferkan dari history development sample.
			</div>
			<div style="margin-top:5%;margin-left:3%;width:100%;">
				SR code<br>
				<span id="srnomor" style="font-weight:700;"></span>
			</div>
			<div style="margin-top:5%;margin-left:3%;width:100%;">
				Pilih stage sample<br>
				<input name="statuspk" id="statuspkadd" required
					style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
					class="easyui-combobox"
					data-options="valueField:'statuspk',textField:'stagenm',limitToList:'true',prompt:'Stage'">
			</div>
			<div style="margin-top:5%;margin-left:3%;width:100%;">
				Pilih informasi yang ingin Anda transfer masuk ke OP<br>
				<input type="checkbox" name="produk" value="1" checked> Product Information & Supporting Files</br>
				<input type="checkbox" name="material" value="1"> Materials
			</div>

			<a style="text-decoration:none; width:auto;left:150px; margin-top:20px;border:1px solid #000;" href="javascript:void(0)" class="button-cancel"
				onclick="backdev();">Go Back</a>
			<a style="text-decoration:none; width:130px; left:230px; margin-top:20px;" href="javascript:void(0)"
				class="button-submit" onclick="addsr();">Save & Sync</a>
		</form>
	</div>
	<!-- End Dialog dev -->

	<!-- konfirmasi upload -->
	<div id="dialog-conupload" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
		style="width:387px;height:200px;padding:5px;gap:20px;display:none;top:15px;border-radius:8px;top:20%">
		<form id="form-upload" method="post">
			<input type="hidden" name="ordpk" value="<?php echo $_GET['ord']; ?>" size="8">
			<div style="padding: 10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">Konfirmasi Release Perubahan</div>
			<div style="padding: 10px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
				Perubahan Anda di order breakdown akan diteruskan ke Produksi. Apakah Anda mau melakukan perubahan?
			</div>
			<a style="text-decoration:none; left: 150px; top: 150px;width:100px;" href="javascript:void(0)"
				class="button-cancel" onclick="canconupload();">Cancel</a>
			<a style="text-decoration:none; left: 250px; top: 150px;width:100px;" href="javascript:void(0)"
				class="button-submit" onclick="save1();">Confirm</a>
		</form>
	</div>
</body>

</html>