<?php
include "action/sinkron4.php";
?>
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

	.item_dan_usage > div {
		margin-right: 20px;
	}
</style>

<script type="text/javascript">

	/*function tot3() {
	var totmat = JSON.stringify($('#dg4').datagrid('getData').total);
	if (totmat) {
	document.getElementById("count3").innerHTML = "Purchasing ("+totmat+")";
		}
	}*/
	function tot() {
		var tcount = JSON.stringify($('#dg').datagrid('getData').total);
		document.getElementById("tot3").innerHTML = +tcount;
	}

	/*menu*/
	function menu() {
		var row = $('#dg').datagrid('getSelected');
		var sfu = $('#sfu').val();
		if (row) {
			if (row.postatpk == 4) {
				if (row.fup == sfu) {
					$('#mreqrev').hide();
				} else {
					$('#mreqrev').show();
				}
				$('#mcanreq').hide();
				//$('#mreqrev').css('margin-left','100px');
			} else {
				if (row.pono) {
					if (row.fup == sfu) {
						$('#mreqrev').hide();
						$('#mcanreq').hide();
					} else {
						$('#mreqrev').show();
						$('#mcanreq').show();
					}
				} else {
					$('#mreqrev').hide();
					$('#mcanreq').show();
				}
			}
			$('#myHeader').show();
		} else {
			$('#myHeader').hide();
			//$('#dg').datagrid('clearSelections');
		}
	}

	function viewpi() {
		var rows = $('#dg').datagrid('getSelected');
		if (rows) {
			// if(rows.status=="Purchased"){
			if (rows.piform !== null && rows.piform !== "") {
				url = "upload/" + rows.piform;
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
		var rows = $('#dg').datagrid('getSelected');
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

	/*edit*/
	function edit() {
		var row = $('#dg').datagrid('getSelected');
		var sfu = $('#sfu').val();
		if (row) {
			if (row.pono) {
				if (row.fup == sfu) {
					if (row.pur == "Rita") {
						if (row.stspk == 4) {
							$('#dialog-form3a').dialog('open').dialog('setTitle', '');
							$('#form3a').form('load', row);
							if (row.tspec == 2) {
								$('#hidden').show();
							} else {
								$('#hidden').hide();
							}
						} else {
							$.messager.alert('Warning', ' Do revision PO ' + row.pono + '', 'warning');
						}
					} else if (row.pur == "Theresia") {
						if (row.stspk == 4) {
							$('#dialog-form3a').dialog('open').dialog('setTitle', '');
							$('#form3a').form('load', row);
							if (row.tspec == 2) {
								$('#hidden').show();
							} else {
								$('#hidden').hide();
							}
						} else {
							$.messager.alert('Warning', ' Do revision PO ' + row.pono + '', 'warning');
						}
					} else {
						$.messager.confirm('Confirm', 'Are you sure you want to edit the material data, there is already a PO ' + row.pono + ' ?',
							function (r) {
								if (r) {
									$('#dialog-form3a').dialog('open').dialog('setTitle', '');
									$('#form3a').form('load', row);
									if (row.tspec == 2) {
										$('#hidden').show();
									} else {
										$('#hidden').hide();
									}
								}
							});
					}
				} else if (row.stspk == 4) {
					$('#dialog-form3a').dialog('open').dialog('setTitle', '');
					$('#form3a').form('load', row);
					if (row.tspec == 2) {
						$('#hidden').show();
					} else {
						$('#hidden').hide();
					}
				} else if (row.postatpk == 2) {
					if (row.stspk == 4) {
						$('#dialog-form3a').dialog('open').dialog('setTitle', '');
						$('#form3a').form('load', row);
						if (row.tspec == 2) {
							$('#hidden').show();
						} else {
							$('#hidden').hide();
						}
					} else {
						$.messager.alert('Warning', ' Do revision PO ' + row.pono + '', 'warning');
					}
				} else {
					$.messager.alert('Warning', ' Do revision PO ' + row.pono + '', 'warning');
				}
			} else {
				$('#dialog-form3a').dialog('open').dialog('setTitle', '');
				$('#form3a').form('load', row);
				if (row.tspec == 2) {
					$('#hidden').show();
				} else {
					$('#hidden').hide();
				}
			}
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	function reqrev() {
		var row = $('#dg').datagrid('getSelected');
		if (row) {
			if (row.pono) {
				$.messager.confirm('Confirm', 'Are you sure you want to request revised this material?',
					function (r) {
						if (r) {
							$.ajax({
								type: "POST",
								url: "action/simpan.php?x=reqrev",
								data: 'id=' + row.rkbpk,
								success: function (data) {
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
					});
			} else {
				$.messager.alert('Warning', 'Material cannot be request revised', 'warning');
			}
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	/*canreq*/
	function canreq() {
		var row = $('#dg').datagrid('getSelected');
		if (row) {
			/*if(row.pono){
				$.messager.alert('Warning','Material cannot be canceled request','warning');
			} else {*/
			$.messager.confirm('Confirm', 'Are you sure you want to cancel request this material?',
				function (r) {
					if (r) {
						$.ajax({
							type: "POST",
							url: "action/simpan.php?x=canreq",
							data: 'id=' + row.rkbpk,
							success: function (data) {
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
				});
			/*}*/
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
		}
	}

	/*save*/
	function save3a() {
		var string = $("#form3a").serialize();
		$('#form3a').form('submit', {
			type: "POST",
			url: "action/simpan.php?x=mat",
			data: string,
			onSubmit: function () {
				return $(this).form('validate');
			},
			success: function (data) {
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
				$('#dialog-form3a').dialog('close');
				/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
				$('#dg').datagrid('reload');
			}
		});
	}

	/* RUmus Onkeyup */
	function myFunction3a() {
		var x = document.getElementById("bdownqty3a").value;
		var y = document.getElementById("allowcons3a").value;
		var a = document.getElementById("qrs3a").value;
		var b = document.getElementById("estcons3a").value;
		var c = document.getElementById("allowman3a").value;
		var d = document.getElementById("negocons3a").value;
		var g = document.getElementById("formula1").value;
		//var f1a = document.getElementById("f1a").value;
		//var f2a = document.getElementById("f2a").value;
		var f1b = document.getElementById("f1").value;
		var f2b = document.getElementById("f2").value;
		//var g =  $('#formula1').val();
		//var h =  $('#formula2').val();

		/*var y2 = 0;*/
		if (x == '') { var x2 = 0; }
		else { var x2 = x; }

		if (a == '') { var a2 = 0; }
		else { a2 = a; }

		if (y == '') { var y2 = 2; }
		else { var y2 = y; }

		if (c == '') { var c2 = 0; }
		else { var c2 = c; }

		if (d == '') { var d2 = 0; }
		else { var d2 = d; }

		if (f1b) {
			//alert(f1b);
			$.ajax({
				type: "POST",
				url: "view/get_rumus.php?bdownqty=" + x + "&estcons=" + b + "&formula1=" + g + "&f2b=" + f2b,
				data: "f1b=" + f1b,
				success: function (data) {
					//alert(data);
					//var e = data;
					document.getElementById("totcons3a").value = data;
					var e2 = document.getElementById("totcons3a").value;

var f = d - b;
document.getElementById("varcons3a").value = f;

var z = parseFloat(e2) + (parseFloat(e2) * parseFloat(y2) / 100) + parseFloat(a2) + parseFloat(c2);
document.getElementById("pocons3a").value = z;
document.getElementById("pocons3b").value = Math.ceil(z);
				},
			});
		} else {
			var e = x * b;
			document.getElementById("totcons3a").value = e;
			var e2 = document.getElementById("totcons3a").value;

var f = d - b;
document.getElementById("varcons3a").value = f;

var z = parseFloat(e2) + (parseFloat(e2) * parseFloat(y2) / 100) + parseFloat(a2) + parseFloat(c2);
document.getElementById("pocons3a").value = z;
document.getElementById("pocons3b").value = Math.ceil(z);
		}
	}

	/* Warna lookup bdown total qty 
	function cellStyler(value,row,index){
		if (value > 35){
			return 'background-color:#ffee00;color:red;';
		}
	}*/
	function myformatter3a(date) {
		var y = date.getFullYear();
		var m = date.getMonth() + 1;
		var d = date.getDate();
		return y + '-' + (m < 10 ? ('0' + m) : m) + '-' + (d < 10 ? ('0' + d) : d);
	}
	function myparser3a(s) {
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

	function myformatter3b(date) {
		var y = date.getFullYear();
		var m = date.getMonth() + 1;
		var d = date.getDate();
		return y + '-' + (m < 10 ? ('0' + m) : m) + '-' + (d < 10 ? ('0' + d) : d);
	}

	function myparser3b(s) {
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


	/* LOOKUP color */
	function lookup_col3() {
		$('#dialog-form3e').dialog('open').dialog('setTitle', '');
		$('#form3e').form('clear');
	}

	function get_lookup3() {
		var row = $('#dg3e').datagrid('getSelected');
		if (row) {
			document.getElementById("colname3a").value = row.colname;
			document.getElementById("colcode3a").value = row.colcode;
			$('#dialog-form3e').dialog('close');
			//alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);
		}
	}

	/* LOOKUP Material */
	function lookup_mb3() {
		$('#dialog-form3f').dialog('open').dialog('setTitle', '');
		$('#form3f').form('clear');
	}

	function get_mb3() {
		var row = $('#dg3f').datagrid('getSelected');
		if (row) {
			document.getElementById("spec3a").value = row.spec;
			$('#dialog-form3f').dialog('close');
			//alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);
		}
	}

	/* LOOKUP Breakdown S1 */
	function lookup_bdown3() {
		// $('#dialog-form3g').dialog('open').dialog('setTitle','Data Breakdown');
		$('#dialog-form3g').dialog('open').dialog('setTitle', '');
		$('#form3g').form('clear');
		$('#form3g').form('reset');
	}
	function lookup_bdowns1a() {
		$('#dialog-form3h').dialog('open').dialog('setTitle', 'S1');
		$('#form3h').form('clear');
		$('#dg3h').datagrid('clearSelections');
	}
	function get_bdowns1a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3h').datagrid('getSelected');
		var rowsb = $('#dg3h').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3h').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3h').datagrid('clearSelections');
		}
		function clk1a() {
			var rowc = $('#dg3h').datagrid('getSelected');
			var rowsc = $('#dg3h').datagrid('getSelections');
			if (rowc) {
				if (rowsc.length > 2) {
					$('#dg3h').datagrid('unselectAll');
				}
			}
		}
		/*var row = $('#dg3h').datagrid('getSelected');  						
		 if (row){
			var v1=$('#dg3h').datagrid('getRows')[0].size;
			document.getElementById("sizegar3a").value = v1;
			document.getElementById("bdownqty3a").value = row.size;
			document.getElementById("bdownpk3a").value = row.bdownpk;
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3h').dialog('close');
			$('#dialog-form3g').dialog('close');
			}*/
	}
	/* LOOKUP Breakdown S2 */
	function lookup_bdowns2a() {
		$('#dialog-form3i').dialog('open').dialog('setTitle', 'S2');
		$('#form3i').form('clear');
		$('#dg3i').datagrid('clearSelections');
	}
	function get_bdowns2a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3i').datagrid('getSelected');
		var rowsb = $('#dg3i').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3i').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3i').datagrid('clearSelections');
		}
	}
	function clk2a() {
		var rowc = $('#dg3i').datagrid('getSelected');
		var rowsc = $('#dg3i').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3i').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S3 */
	function lookup_bdowns3a() {
		$('#dialog-form3j').dialog('open').dialog('setTitle', 'S3');
		$('#form3j').form('clear');
		$('#dg3j').datagrid('clearSelections');
	}
	function get_bdowns3a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3j').datagrid('getSelected');
		var rowsb = $('#dg3j').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3j').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3j').datagrid('clearSelections');
		}
	}
	function clk3a() {
		var rowc = $('#dg3j').datagrid('getSelected');
		var rowsc = $('#dg3j').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3j').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S4 */
	function lookup_bdowns4a() {
		$('#dialog-form3k').dialog('open').dialog('setTitle', 'S4');
		$('#form3k').form('clear');
		$('#dg3k').datagrid('clearSelections');
	}
	function get_bdowns4a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3k').datagrid('getSelected');
		var rowsb = $('#dg3k').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3k').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3k').datagrid('clearSelections');
		}
	}
	function clk4a() {
		var rowc = $('#dg3k').datagrid('getSelected');
		var rowsc = $('#dg3k').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3k').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S5 */
	function lookup_bdowns5a() {
		$('#dialog-form3l').dialog('open').dialog('setTitle', 'S5');
		$('#form3l').form('clear');
		$('#dg3l').datagrid('clearSelections');
	}
	function get_bdowns5a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3l').datagrid('getSelected');
		var rowsb = $('#dg3l').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3l').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3l').datagrid('clearSelections');
		}
	}
	function clk5a() {
		var rowc = $('#dg3l').datagrid('getSelected');
		var rowsc = $('#dg3l').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3l').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S6 */
	function lookup_bdowns6a() {
		$('#dialog-form3m').dialog('open').dialog('setTitle', 'S6');
		$('#form3m').form('clear');
		$('#dg3m').datagrid('clearSelections');
	}
	function get_bdowns6a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3m').datagrid('getSelected');
		var rowsb = $('#dg3m').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3m').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3m').datagrid('clearSelections');
		}
	}
	function clk6a() {
		var rowc = $('#dg3m').datagrid('getSelected');
		var rowsc = $('#dg3m').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3m').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S7 */
	function lookup_bdowns7a() {
		$('#dialog-form3n').dialog('open').dialog('setTitle', 'S7');
		$('#form3n').form('clear');
		$('#dg3n').datagrid('clearSelections');
	}
	function get_bdowns7a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3n').datagrid('getSelected');
		var rowsb = $('#dg3n').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3n').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3n').datagrid('clearSelections');
		}
	}
	function clk7a() {
		var rowc = $('#dg3n').datagrid('getSelected');
		var rowsc = $('#dg3n').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3n').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S8 */
	function lookup_bdowns8a() {
		$('#dialog-form3o').dialog('open').dialog('setTitle', 'S8');
		$('#form3o').form('clear');
		$('#dg3o').datagrid('clearSelections');
	}
	function get_bdowns8a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3o').datagrid('getSelected');
		var rowsb = $('#dg3o').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3o').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3o').datagrid('clearSelections');
		}
	}
	function clk8a() {
		var rowc = $('#dg3o').datagrid('getSelected');
		var rowsc = $('#dg3o').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3o').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S9 */
	function lookup_bdowns9a() {
		$('#dialog-form3p').dialog('open').dialog('setTitle', 'S9');
		$('#form3p').form('clear');
		$('#dg3p').datagrid('clearSelections');
	}
	function get_bdowns9a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3p').datagrid('getSelected');
		var rowsb = $('#dg3p').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3p').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3p').datagrid('clearSelections');
		}
	}
	function clk9a() {
		var rowc = $('#dg3p').datagrid('getSelected');
		var rowsc = $('#dg3p').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3p').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S10 */
	function lookup_bdowns10a() {
		$('#dialog-form3q').dialog('open').dialog('setTitle', 'S10');
		$('#form3q').form('clear');
		$('#dg3q').datagrid('clearSelections');
	}
	function get_bdowns10a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3q').datagrid('getSelected');
		var rowsb = $('#dg3q').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3q').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3q').datagrid('clearSelections');
		}
	}
	function clk10a() {
		var rowc = $('#dg3q').datagrid('getSelected');
		var rowsc = $('#dg3q').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3q').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S11 */
	function lookup_bdowns11a() {
		$('#dialog-form3r').dialog('open').dialog('setTitle', 'S11');
		$('#form3r').form('clear');
		$('#dg3r').datagrid('clearSelections');
	}
	function get_bdowns11a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3r').datagrid('getSelected');
		var rowsb = $('#dg3r').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3r').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3r').datagrid('clearSelections');
		}
	}
	function clk11a() {
		var rowc = $('#dg3r').datagrid('getSelected');
		var rowsc = $('#dg3r').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3r').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S12 */
	function lookup_bdowns12a() {
		$('#dialog-form3s').dialog('open').dialog('setTitle', 'S12');
		$('#form3s').form('clear');
		$('#dg43s').datagrid('clearSelections');
	}
	function get_bdowns12a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3s').datagrid('getSelected');
		var rowsb = $('#dg3s').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3s').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg43s').datagrid('clearSelections');
		}
	}
	function clk12a() {
		var rowc = $('#dg3s').datagrid('getSelected');
		var rowsc = $('#dg3s').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3s').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S13 */
	function lookup_bdowns13a() {
		$('#dialog-form3t').dialog('open').dialog('setTitle', 'S13');
		$('#form3t').form('clear');
		$('#dg3t').datagrid('clearSelections');
	}
	function get_bdowns13a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3t').datagrid('getSelected');
		var rowsb = $('#dg3t').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3t').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3t').datagrid('clearSelections');
		}
	}
	function clk13a() {
		var rowc = $('#dg3t').datagrid('getSelected');
		var rowsc = $('#dg3t').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3t').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S14 */
	function lookup_bdowns14a() {
		$('#dialog-form3u').dialog('open').dialog('setTitle', 'S13');
		$('#form3u').form('clear');
		$('#dg3u').datagrid('clearSelections');
	}
	function get_bdowns14a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3u').datagrid('getSelected');
		var rowsb = $('#dg3u').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3u').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3u').datagrid('clearSelections');
		}
	}
	function clk14a() {
		var rowc = $('#dg3u').datagrid('getSelected');
		var rowsc = $('#dg3u').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3u').datagrid('unselectAll');
			}
		}
	}
	/* LOOKUP Breakdown S15 */
	function lookup_bdowns15a() {
		$('#dialog-form3v').dialog('open').dialog('setTitle', 'S15');
		$('#form3v').form('clear');
		$('#dg3v').datagrid('clearSelections');
	}
	function get_bdowns15a() {
		var ids = [];
		var ids2 = [];
		var row = $('#dg3v').datagrid('getSelected');
		var rowsb = $('#dg3v').datagrid('getSelections');
		if (row) {
			for (var i = 0; i < rowsb.length; i++) {
				ids.push(rowsb[i].size);
				ids2.push(rowsb[i].bdownpk);
			}
			document.getElementById("sizegar3a").value = ids[0];
			document.getElementById("bdownqty3a").value = ids[1];
			document.getElementById("bdownpk3a").value = ids2[1];
			document.getElementById("kolom3a").value = row.kolom;
			$('#dialog-form3v').dialog('close');
			$('#dialog-form3g').dialog('close');
			$('#dg3v').datagrid('clearSelections');
		}
	}
	function clk15a() {
		var rowc = $('#dg3v').datagrid('getSelected');
		var rowsc = $('#dg3v').datagrid('getSelections');
		if (rowc) {
			if (rowsc.length > 2) {
				$('#dg3v').datagrid('unselectAll');
			}
		}
	}

	/*search*/
	function Search3a() {
		$('#dg3e').datagrid('load', {
			cari7: $('#cari7b').val()
		});
	}

	function Search3b() {
		$('#dg3f').datagrid('load', {
			cari8: $('#cari8b').val()
		});
	}

	function Search2() {
		$('#dg').datagrid('load', {
			cari1: $('#cari1b').val(),
			cari2: $('#cari2b').val(),
			cari3: $('#cari3b').val(),
			type0: $('#filtera0').val(),
			type1: $('#filtera1').val(),
			spec0: $('#filterb0').val(),
			spec1: $('#filterb1').val(),
			col0: $('#filterc0').val(),
			col1: $('#filterc1').val()
		});
	}

	function Search2a() {
		$('#dg').datagrid('load', {
			cari1: $('#cari1b').val(),
			cari2: $('#cari2b').val(),
			cari3: $('#cari3b').val(),
			cari4: $('#cari4b').val(),
			type0: $('#filtera0').val(),
			type1: $('#filtera1').val(),
			spec0: $('#filterb0').val(),
			spec1: $('#filterb1').val(),
			col0: $('#filterc0').val(),
			col1: $('#filterc1').val()
		});
		$('#newest').show();
		$('#oldest').hide();
		$('#itemaz').hide();
	}

	function Search2b() {
		$('#dg').datagrid('load', {
			cari1: $('#cari1b').val(),
			cari2: $('#cari2b').val(),
			cari3: $('#cari3b').val(),
			cari5: $('#cari5b').val(),
			type0: $('#filtera0').val(),
			type1: $('#filtera1').val(),
			spec0: $('#filterb0').val(),
			spec1: $('#filterb1').val(),
			col0: $('#filterc0').val(),
			col1: $('#filterc1').val()
		});
		$('#newest').hide();
		$('#oldest').show();
		$('#itemaz').hide();
	}

	function Searchaz() {
		$('#dg').datagrid('load', {
			cari1: $('#cari1b').val(),
			cari2: $('#cari2b').val(),
			cari3: $('#cari3b').val(),
			cariaz: $('#cariaz').val(),
			type0: $('#filtera0').val(),
			type1: $('#filtera1').val(),
			spec0: $('#filterb0').val(),
			spec1: $('#filterb1').val(),
			col0: $('#filterc0').val(),
			col1: $('#filterc1').val()
		});
		$('#newest').hide();
		$('#oldest').hide();
		$('#itemaz').show();
	}

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

	$(function () {
		$('#type').datagrid({
			onCheck: function (index, row, value) {
				$('#tabel1').css("margin-top", "60px");
				var ckk = $('#type').datagrid('getRows')[index].item;
				document.getElementById("filtera" + index).value = ckk;
				document.getElementById("idxa" + index).value = index;
				document.getElementById("talla" + index).value = 1;
				$('#filtera' + index).show();
				$('#crossa' + index).show();
				$('#dg').datagrid('load', {
					type0: $('#filtera0').val(),
					type1: $('#filtera1').val(),
					spec0: $('#filterb0').val(),
					spec1: $('#filterb1').val(),
					col0: $('#filterc0').val(),
					col1: $('#filterc1').val(),
					cari1: $('#cari1b').val(),
					cari2: $('#cari2b').val(),
					cari3: $('#cari3b').val()
				});
				tall();
				var counta = JSON.stringify($('#dg').datagrid('getData').total);
				document.getElementById("fltr2").innerHTML = counta + " result";
				$('#fltr1').show();
				$('#fltr2').show();
				$('#fltr3').show();
			},
			onUncheck: function (index, row, value) {
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
						type0: $('#filtera0').val(),
						type1: $('#filtera1').val(),
						spec0: $('#filterb0').val(),
						spec1: $('#filterb1').val(),
						col0: $('#filterc0').val(),
						col1: $('#filterc1').val(),
						cari1: $('#cari1b').val(),
						cari2: $('#cari2b').val(),
						cari3: $('#cari3b').val()
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

	function unceka(cross) {
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
			$('#dg').datagrid('load', {
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val()
			});
			document.getElementById("idxa" + c).value = "";
		}
	}

	$(function () {
		$('#spec').datagrid({
			onCheck: function (index, row, value) {
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
				$('#dg').datagrid('load', {
					type0: $('#filtera0').val(),
					type1: $('#filtera1').val(),
					spec0: $('#filterb0').val(),
					spec1: $('#filterb1').val(),
					col0: $('#filterc0').val(),
					col1: $('#filterc1').val(),
					cari1: $('#cari1b').val(),
					cari2: $('#cari2b').val(),
					cari3: $('#cari3b').val()
				});
				var counta = JSON.stringify($('#dg').datagrid('getData').total);
				document.getElementById("fltr2").innerHTML = counta + " result";
			},
			onUncheck: function (index, row, value) {
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
						type0: $('#filtera0').val(),
						type1: $('#filtera1').val(),
						spec0: $('#filterb0').val(),
						spec1: $('#filterb1').val(),
						col0: $('#filterc0').val(),
						col1: $('#filterc1').val(),
						cari1: $('#cari1b').val(),
						cari2: $('#cari2b').val(),
						cari3: $('#cari3b').val()
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

	function uncekb(cross) {
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
			$('#dg').datagrid('load', {
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val()
			});
			document.getElementById("idxb" + c).value = "";
		}
	}

	$(function () {
		$('#color').datagrid({
			onCheck: function (index, row, value) {
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
				$('#dg').datagrid('load', {
					type0: $('#filtera0').val(),
					type1: $('#filtera1').val(),
					spec0: $('#filterb0').val(),
					spec1: $('#filterb1').val(),
					col0: $('#filterc0').val(),
					col1: $('#filterc1').val(),
					cari1: $('#cari1b').val(),
					cari2: $('#cari2b').val(),
					cari3: $('#cari3b').val()
				});
				var counta = JSON.stringify($('#dg').datagrid('getData').total);
				document.getElementById("fltr2").innerHTML = counta + " result";
			},
			onUncheck: function (index, row, value) {
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
						type0: $('#filtera0').val(),
						type1: $('#filtera1').val(),
						spec0: $('#filterb0').val(),
						spec1: $('#filterb1').val(),
						col0: $('#filterc0').val(),
						col1: $('#filterc1').val(),
						cari1: $('#cari1b').val(),
						cari2: $('#cari2b').val(),
						cari3: $('#cari3b').val()
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

	function uncekc(cross) {
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
			$('#dg').datagrid('load', {
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val()
			});
			document.getElementById("idxc" + c).value = "";
		}
	}

	function totrec() {
		var tcount = JSON.stringify($('#dg').datagrid('getData').total);
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
		var ckb0 = document.getElementById("tallb0").value;
		var ckb1 = document.getElementById("tallb1").value;
		var ckc0 = document.getElementById("tallc0").value;
		var ckc1 = document.getElementById("tallc1").value;
		var tall = parseInt(cka0) + parseInt(cka1) + parseInt(ckb0) + parseInt(ckb1) + parseInt(ckc0) + parseInt(ckc1);
		//alert(tall);
		if (tall >= 1) {
			document.getElementById('total').value = tall;
			document.getElementById('fltr1').innerHTML = "Search filters(" + tall + ")";
		}
		else {
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

			$('#dg').datagrid('load', {
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val()
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
		lockColumn: function (jq, field) {
			return jq.each(function () {
				var p = $('#kolom1').datagrid('getPanel');    // get the panel
				var cell = p.find('div.datagrid-header td[field=' + field + '] > div.datagrid-cell'); // get the cell
				cell.resizable({ disabled: true }); // disable resize
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
		togglePassword2a.addEventListener("click", function () {
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
				$(".tabelc").css("margin-top", "15px");
				$('.tabela').show();
				$(".prodesa").css("margin-top", "60px");
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
				$(".prodesa").css("margin-top", "60px");
				$(".seasona").css("margin-top", "55px");
				$(".tabelb").css("margin-top", "-15px");
				document.getElementById('test1').value = "";
				$(".tabelc").css("margin-top", "85px");
			}
			else {
				$('.tabela').show();
				document.getElementById('test1').value = "";
				$(".prodesa").css("margin-top", "25px");
				$(".tabelb").css("margin-top", "-40px");
				$(".tabelc").css("margin-top", "55px");
			}
			this.classList.toggle("bi-eye2");
		});

		togglePassword2b.addEventListener("click", function () {
			test1 = $('#test1').val();
			test2 = $('#test2').val();
			if (test1 == "" && test2 == "") {
				$('.tabelb').hide();
				document.getElementById('test2').value = 1;
				$(".seasona").css("margin-top", "-10px");
				$(".tabelc").css("margin-top", "20px");
			} else if (test1 == 1 && test2 == 1) {
				$(".tabelc").css("margin-top", "25px");
				$('.tabelb').show();
				$(".seasona").css("margin-top", "65px");
				document.getElementById('test2').value = "";
			} else if (test1 == 1 && test2 == "") {
				$(".tabelb").css("margin-top", "-85px");
				$('.tabelb').hide();
				$(".seasona").css("margin-top", "-15px");
				document.getElementById('test2').value = 1;
				$(".tabelc").css("margin-top", "-60px");
			} else if (test1 == "" && test2 == 1) {
				$(".prodesa").css("margin-top", "60px");
				$(".tabelb").css("margin-top", "-15px");
				$('.tabelb').show();
				$(".seasona").css("margin-top", "55px");
				document.getElementById('test2').value = "";
				$(".tabelc").css("margin-top", "100px");
			}
			else {
				$('.tabelb').show();
				document.getElementById('test2').value = "";
				$(".seasona").css("margin-top", "30px");
				$(".tabelc").css("margin-top", "55px");
			}
			this.classList.toggle("bi-eye2");
		});
		togglePassword2c.addEventListener("click", function () {
			$('.tabelc').toggle();
			this.classList.toggle("bi-eye2");
		});
	}

	function tnew() {
		var cari1 = $('#cari1b').val();
		var cari2 = $('#cari2b').val();
		var cari3 = $('#cari3b').val();
		var type0 = $('#filtera0').val();
		var type1 = $('#filtera1').val();
		var spec0 = $('#filterb0').val();
		var spec1 = $('#filterb1').val();
		var col0 = $('#filterc0').val();
		var col1 = $('#filterc1').val();
		$.ajax({
			type: "POST",
			url: "view/get_po2.php?ord=<?php echo $ord; ?>&cari2=" + cari2 + "&cari3=" + cari3 + "&type0=" + type0 + "&type1=" + type1 + "&spec0=" + spec0 + "&spec1=" + spec1 + "&col0=" + col0 + "&col1=" + col1,
			data: "cari1=" + cari1,
			success: function (data) {
				document.getElementById('tpur1b').innerHTML = data;
			},
		});
		var tcount = JSON.stringify($('#dg').datagrid('getData').total);
		document.getElementById("tpur").innerHTML = "(" + tcount + ")";
		$('#tpur').show();
		$('#tpur1').hide();
		//document.getElementById("tpur1").innerHTML = tcount;
		document.getElementById("tpur2").innerHTML = tcount;
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
			$('#dg').datagrid('showColumn', 'item');
		} else {
			$('#dg').datagrid('hideColumn', 'item');
		}
	}

	function cheka2() {
		var c2 = document.getElementById("chek2");
		if (c2.checked) {
			$('#dg').datagrid('showColumn', 'supnm');
		} else {
			$('#dg').datagrid('hideColumn', 'supnm');
		}
	}

	function cheka3() {
		var c3 = document.getElementById("chek3");
		if (c3.checked) {
			$('#dg').datagrid('showColumn', 'colname');
		} else {
			$('#dg').datagrid('hideColumn', 'colname');
		}
	}

	function cheka3c() {
		var c3c = document.getElementById("chek3c");
		if (c3c.checked) {
			$('#dg').datagrid('showColumn', 'colcode');
		} else {
			$('#dg').datagrid('hideColumn', 'colcode');
		}
	}

	function cheka3d() {
		var c3d = document.getElementById("chek3d");
		if (c3d.checked) {
			$('#dg').datagrid('showColumn', 'sizegar');
		} else {
			$('#dg').datagrid('hideColumn', 'sizegar');
		}
	}

	function cheka3b() {
		var c3b = document.getElementById("chek3b");
		if (c3b.checked) {
			$('#dg').datagrid('showColumn', 'rev');
		} else {
			$('#dg').datagrid('hideColumn', 'rev');
		}
	}

	function cheka4() {
		var c4 = document.getElementById("chek4");
		if (c4.checked) {
			$('#dg').datagrid('showColumn', 'status');
		} else {
			$('#dg').datagrid('hideColumn', 'status');
		}
	}

	function cheka5() {
		var c5 = document.getElementById("chek5");
		if (c5.checked) {
			$('#dg').datagrid('showColumn', 'pono');
		} else {
			$('#dg').datagrid('hideColumn', 'pono');
		}
	}

	function cheka6() {
		var c6 = document.getElementById("chek6");
		if (c6.checked) {
			$('#dg').datagrid('showColumn', 'tgljam2');
		} else {
			$('#dg').datagrid('hideColumn', 'tgljam2');
		}
	}

	function cheka6b() {
		var c6b = document.getElementById("chek6b");
		if (c6b.checked) {
			$('#dg').datagrid('showColumn', 'revdate2');
		} else {
			$('#dg').datagrid('hideColumn', 'revdate2');
		}
	}

	function cheka6c() {
		var c6c = document.getElementById("chek6c");
		if (c6c.checked) {
			$('#dg').datagrid('showColumn', 'candate2');
		} else {
			$('#dg').datagrid('hideColumn', 'candate2');
		}
	}

	function cheka7() {
		var c7 = document.getElementById("chek7");
		if (c7.checked) {
			$('#dg').datagrid('showColumn', 'etd2');
		} else {
			$('#dg').datagrid('hideColumn', 'etd2');
		}
	}

	function cheka8() {
		var c8 = document.getElementById("chek8");
		if (c8.checked) {
			$('#dg').datagrid('showColumn', 'price');
		} else {
			$('#dg').datagrid('hideColumn', 'price');
		}
	}

	function cheka9() {
		var c9 = document.getElementById("chek9");
		if (c9.checked) {
			$('#dg').datagrid('showColumn', 'pocons2');
		} else {
			$('#dg').datagrid('hideColumn', 'pocons2');
		}
	}

	function cheka10() {
		var c10 = document.getElementById("chek10");
		if (c10.checked) {
			$('#dg').datagrid('showColumn', 'unit');
		} else {
			$('#dg').datagrid('hideColumn', 'unit');
		}
	}

	function cheka11() {
		var c11 = document.getElementById("chek11");
		if (c11.checked) {
			$('#dg').datagrid('showColumn', 'piqty');
		} else {
			$('#dg').datagrid('hideColumn', 'piqty');
		}
	}

	function cheka12() {
		var c12 = document.getElementById("chek12");
		if (c12.checked) {
			$('#dg').datagrid('showColumn', 'piprice');
		} else {
			$('#dg').datagrid('hideColumn', 'piprice');
		}
	}

	function cheka13() {
		var c13 = document.getElementById("chek13");
		if (c13.checked) {
			$('#dg').datagrid('showColumn', 'pitot');
		} else {
			$('#dg').datagrid('hideColumn', 'pitot');
		}
	}

	function cheka14() {
		var c14 = document.getElementById("chek14");
		if (c14.checked) {
			$('#dg').datagrid('showColumn', 'spec');
		} else {
			$('#dg').datagrid('hideColumn', 'spec');
		}
	}

	function cheka15() {
		var c15 = document.getElementById("chek15");
		if (c15.checked) {
			$('#dg').datagrid('showColumn', 'poreqdel2');
		} else {
			$('#dg').datagrid('hideColumn', 'poreqdel2');
		}
	}

	function gtrow() {
		//var dg = $('#dg4g');
		//var index = dg.datagrid('getRowIndex', dg.datagrid('getSelected'));
		//var field = dg.datagrid('getColumnFields', dg.datagrid('getSelected'));

		//var row = $(dg4g).datagrid('getRowIndex');
		//var v=$('#dg4g').datagrid('getRows')[5].s2;
		//alert(row);
		/*var row = $('#dg4g').datagrid('getSelected');
		if (row){
		  var a = $('#dg4g').datagrid('getRowIndex', row);
			var fields = $('#dg4g').datagrid('getColumnFields');
				var v=$('#dg4g').datagrid('getRows')[a].s1;
				alert(fields);
		}*/
		var qty2 = document.getElementById("bdownqty1").value;
		var sz1 = document.getElementById("sz1").value;
		var col1 = document.getElementById("col1").value;
		var bdwpk0 = document.getElementById("bdwpk").value;
		var klm0 = document.getElementById("klm").value;

		document.getElementById("canbd").value = 0;
		document.getElementById("sizegar3a").value = sz1;
		document.getElementById("bdownqty3a").value = qty2.replace(',', '');
		document.getElementById("colname3a").value = col1;
		document.getElementById("bdownpk3a").value = bdwpk0;
		document.getElementById("kolom3a").value = klm0;
		$('#dialog-form3g').dialog('close');

		myFunction1c();
	}

	$(function () {
		$('#dg3g').datagrid({
			onClickCell: function (index, field, value) {
				//var row = $('#dg4g').edatagrid('getSelected');
				if (field == 's1') {
					//alert(value);
					/*lookup size*/
					//var v1=$('#dg3g').datagrid('getRows')[0].s1;
					//document.getElementById('sz1').value=v1;
					document.getElementById('col1').value = '';
					/*lookup qty*/
					var b1 = document.getElementById('s1a' + index).value;
					document.getElementById('bdownqty1').value = b1;
					/*bdownpk & kolom */
					document.getElementById('klm').value = field;
					var bdwpk1 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk1;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s1&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk1,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					/*warna kuning*/
					$('#s1a' + index).css('background-color', 'yellow');
				} else if (field == 's2') {
					//var v2=$('#dg3g').datagrid('getRows')[0].s2;
					//document.getElementById('sz1').value=v2;
					document.getElementById('col1').value = '';
					var b2 = document.getElementById('s2a' + index).value;
					document.getElementById('bdownqty1').value = b2;
					document.getElementById('klm').value = field;
					var bdwpk2 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk2;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s2&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk2,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s2a' + index).css('background-color', 'yellow');
				} else if (field == 's3') {
					//var v3=$('#dg3g').datagrid('getRows')[0].s3;
					//document.getElementById('sz1').value=v3;
					document.getElementById('col1').value = '';
					var b3 = document.getElementById('s3a' + index).value;
					document.getElementById('bdownqty1').value = b3;
					document.getElementById('klm').value = field;
					var bdwpk3 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk3;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s3&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk3,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s3a' + index).css('background-color', 'yellow');
				} else if (field == 's4') {
					//var v4=$('#dg3g').datagrid('getRows')[0].s4;
					//document.getElementById('sz1').value=v4;
					document.getElementById('col1').value = '';
					var b4 = document.getElementById('s4a' + index).value;
					document.getElementById('bdownqty1').value = b4;
					document.getElementById('klm').value = field;
					var bdwpk4 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk4;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s4&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk4,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s4a' + index).css('background-color', 'yellow');
				} else if (field == 's5') {
					//var v5=$('#dg3g').datagrid('getRows')[0].s5;
					//document.getElementById('sz1').value=v5;
					document.getElementById('col1').value = '';
					var b5 = document.getElementById('s5a' + index).value;
					document.getElementById('bdownqty1').value = b5;
					document.getElementById('klm').value = field;
					var bdwpk5 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk5;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s5&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk5,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s5a' + index).css('background-color', 'yellow');
				} else if (field == 's6') {
					//var v6=$('#dg3g').datagrid('getRows')[0].s6;
					//document.getElementById('sz1').value=v6;
					document.getElementById('col1').value = '';
					var b6 = document.getElementById('s6a' + index).value;
					document.getElementById('bdownqty1').value = b6;
					document.getElementById('klm').value = field;
					var bdwpk6 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk6;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s6&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk6,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s6a' + index).css('background-color', 'yellow');
				} else if (field == 's7') {
					//var v7=$('#dg3g').datagrid('getRows')[0].s7;
					//document.getElementById('sz1').value=v7;
					document.getElementById('col1').value = '';
					var b7 = document.getElementById('s7a' + index).value;
					document.getElementById('bdownqty1').value = b7;
					document.getElementById('klm').value = field;
					var bdwpk7 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk7;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s7&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk7,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s7a' + index).css('background-color', 'yellow');
				} else if (field == 's8') {
					//var v8=$('#dg3g').datagrid('getRows')[0].s8;
					//document.getElementById('sz1').value=v8;
					document.getElementById('col1').value = '';
					var b8 = document.getElementById('s8a' + index).value;
					document.getElementById('bdownqty1').value = b8;
					document.getElementById('klm').value = field;
					var bdwpk8 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk8;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s8&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk8,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s8a' + index).css('background-color', 'yellow');
				} else if (field == 's9') {
					//var v9=$('#dg3g').datagrid('getRows')[0].s9;
					//document.getElementById('sz1').value=v9;
					document.getElementById('col1').value = '';
					var b9 = document.getElementById('s9a' + index).value;
					document.getElementById('bdownqty1').value = b9;
					document.getElementById('klm').value = field;
					var bdwpk9 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk9;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s9&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk9,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s9a' + index).css('background-color', 'yellow');
				} else if (field == 's10') {
					//var v10=$('#dg3g').datagrid('getRows')[0].s10;
					//document.getElementById('sz1').value=v10;
					document.getElementById('col1').value = '';
					var b10 = document.getElementById('s10a' + index).value;
					document.getElementById('bdownqty1').value = b10;
					document.getElementById('klm').value = field;
					var bdwpk10 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk10;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s10&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk10,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s10a' + index).css('background-color', 'yellow');
				} else if (field == 's11') {
					//var v11=$('#dg3g').datagrid('getRows')[0].s11;
					//document.getElementById('sz1').value=v11;
					document.getElementById('col1').value = '';
					var b11 = document.getElementById('s11a' + index).value;
					document.getElementById('bdownqty1').value = b11;
					document.getElementById('klm').value = field;
					var bdwpk11 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk11;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s11&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk11,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s11a' + index).css('background-color', 'yellow');
				} else if (field == 's12') {
					//var v12=$('#dg3g').datagrid('getRows')[0].s12;
					//document.getElementById('sz1').value=v12;
					document.getElementById('col1').value = '';
					var b12 = document.getElementById('s12a' + index).value;
					document.getElementById('bdownqty1').value = b12;
					document.getElementById('klm').value = field;
					var bdwpk12 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk12;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s12&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk12,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s12a' + index).css('background-color', 'yellow');
				} else if (field == 's13') {
					//var v13=$('#dg3g').datagrid('getRows')[0].s13;
					//document.getElementById('sz1').value=v13;
					document.getElementById('col1').value = '';
					var b13 = document.getElementById('s13a' + index).value;
					document.getElementById('bdownqty1').value = b13;
					document.getElementById('klm').value = field;
					var bdwpk13 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk13;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s13&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk13,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s13a' + index).css('background-color', 'yellow');
				} else if (field == 's14') {
					//var v14=$('#dg3g').datagrid('getRows')[0].s14;
					//document.getElementById('sz1').value=v14;
					document.getElementById('col1').value = '';
					var b14 = document.getElementById('s14a' + index).value;
					document.getElementById('bdownqty1').value = b14;
					document.getElementById('klm').value = field;
					var bdwpk14 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk14;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s14&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk14,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s14a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's15') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b15 = document.getElementById('s15a' + index).value;
					document.getElementById('bdownqty1').value = b15;
					document.getElementById('klm').value = field;
					var bdwpk15 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk15;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s15&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk15,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s15a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's16') {
					//var v15=$('#dg4g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b16 = document.getElementById('s16a' + index).value;
					document.getElementById('bdownqty1').value = b16;
					document.getElementById('klm').value = field;
					var bdwpk16 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk16;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s16&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk16,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s16a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's17') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b17 = document.getElementById('s17a' + index).value;
					document.getElementById('bdownqty1').value = b17;
					document.getElementById('klm').value = field;
					var bdwpk17 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk17;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s17&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk17,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s17a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's18') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b18 = document.getElementById('s18a' + index).value;
					document.getElementById('bdownqty1').value = b18;
					document.getElementById('klm').value = field;
					var bdwpk18 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk18;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s18&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk18,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s18a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's19') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b19 = document.getElementById('s19a' + index).value;
					document.getElementById('bdownqty1').value = b19;
					document.getElementById('klm').value = field;
					var bdwpk19 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk19;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s19&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk19,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s19a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's20') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b20 = document.getElementById('s20a' + index).value;
					document.getElementById('bdownqty1').value = b20;
					document.getElementById('klm').value = field;
					var bdwpk20 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk20;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s20&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk20,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s20a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's21') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b21 = document.getElementById('s21a' + index).value;
					document.getElementById('bdownqty1').value = b21;
					document.getElementById('klm').value = field;
					var bdwpk21 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk21;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s21&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk21,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s21a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's22') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b22 = document.getElementById('s22a' + index).value;
					document.getElementById('bdownqty1').value = b22;
					document.getElementById('klm').value = field;
					var bdwpk22 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk22;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s22&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk22,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s22a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's23') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b23 = document.getElementById('s23a' + index).value;
					document.getElementById('bdownqty1').value = b23;
					document.getElementById('klm').value = field;
					var bdwpk23 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk23;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s23&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk23,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s23a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's24') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b24 = document.getElementById('s24a' + index).value;
					document.getElementById('bdownqty1').value = b24;
					document.getElementById('klm').value = field;
					var bdwpk24 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk24;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s24&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk24,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s24a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's25') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b25 = document.getElementById('s25a' + index).value;
					document.getElementById('bdownqty1').value = b25;
					document.getElementById('klm').value = field;
					var bdwpk25 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk25;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s25&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk25,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s25a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's26') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b26 = document.getElementById('s26a' + index).value;
					document.getElementById('bdownqty1').value = b26;
					document.getElementById('klm').value = field;
					var bdwpk26 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk26;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s26&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk26,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s26a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's27') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b27 = document.getElementById('s27a' + index).value;
					document.getElementById('bdownqty1').value = b27;
					document.getElementById('klm').value = field;
					var bdwpk27 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk27;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s27&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk27,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s27a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's28') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b28 = document.getElementById('s28a' + index).value;
					document.getElementById('bdownqty1').value = b28;
					document.getElementById('klm').value = field;
					var bdwpk28 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk28;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s28&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk28,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s28a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's29') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b29 = document.getElementById('s29a' + index).value;
					document.getElementById('bdownqty1').value = b29;
					document.getElementById('klm').value = field;
					var bdwpk29 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk29;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s29&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk25,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s29a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's30') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b30 = document.getElementById('s30a' + index).value;
					document.getElementById('bdownqty1').value = b30;
					document.getElementById('klm').value = field;
					var bdwpk30 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk30;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s30&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk30,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s30a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's31') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b31 = document.getElementById('s31a' + index).value;
					document.getElementById('bdownqty1').value = b31;
					document.getElementById('klm').value = field;
					var bdwpk31 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk31;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s31&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk31,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s31a' + index).css('background-color', 'yellow');
				} 
				else if (field == 's32') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b32 = document.getElementById('s32a' + index).value;
					document.getElementById('bdownqty1').value = b32;
					document.getElementById('klm').value = field;
					var bdwpk32 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk32;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s31&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk32,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s32a' + index).css('background-color', 'yellow');
				}
				else if (field == 's33') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b33 = document.getElementById('s33a' + index).value;
					document.getElementById('bdownqty1').value = b33;
					document.getElementById('klm').value = field;
					var bdwpk33 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk33;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s31&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk33,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s33a' + index).css('background-color', 'yellow');
				}
				else if (field == 's34') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b34 = document.getElementById('s34a' + index).value;
					document.getElementById('bdownqty1').value = b34;
					document.getElementById('klm').value = field;
					var bdwpk34 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk34;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s34&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk31,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s34a' + index).css('background-color', 'yellow');
				}
				else if (field == 's35') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b35 = document.getElementById('s35a' + index).value;
					document.getElementById('bdownqty1').value = b35;
					document.getElementById('klm').value = field;
					var bdwpk35 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk35;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s35&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk31,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s35a' + index).css('background-color', 'yellow');
				}
				else if (field == 's36') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b36 = document.getElementById('s36a' + index).value;
					document.getElementById('bdownqty1').value = b36;
					document.getElementById('klm').value = field;
					var bdwpk36 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk36;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s36&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk36,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s36a' + index).css('background-color', 'yellow');
				}
				else if (field == 's37') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b37 = document.getElementById('s37a' + index).value;
					document.getElementById('bdownqty1').value = b37;
					document.getElementById('klm').value = field;
					var bdwpk37 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk37;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s37&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk37,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s37a' + index).css('background-color', 'yellow');
				}
				else if (field == 's38') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b38 = document.getElementById('s38a' + index).value;
					document.getElementById('bdownqty1').value = b38;
					document.getElementById('klm').value = field;
					var bdwpk38 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk38;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s38&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk38,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s38a' + index).css('background-color', 'yellow');
				}
				else if (field == 's39') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b39 = document.getElementById('s39a' + index).value;
					document.getElementById('bdownqty1').value = b39;
					document.getElementById('klm').value = field;
					var bdwpk39 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk39;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s39&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk39,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s39a' + index).css('background-color', 'yellow');
				}
				else if (field == 's40') {
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
					//document.getElementById('sz1').value=v15;
					document.getElementById('col1').value = '';
					var b40 = document.getElementById('s40a' + index).value;
					document.getElementById('bdownqty1').value = b40;
					document.getElementById('klm').value = field;
					var bdwpk40 = $('#dg3g').datagrid('getRows')[index].bdownpk;
					document.getElementById('bdwpk').value = bdwpk40;
					$.ajax({
						type: "POST",
						url: "view/get_data.php?dt=bdown2&size=s40&ord=<?php echo $ord; ?>",
						data: "bdwpk=" + bdwpk40,
						success: function (data) {
							document.getElementById('sz1').value = data;
						},
					});
					$('#s40a' + index).css('background-color', 'yellow');
				}
				else if (field == 'tot') {
					var t4 = $('#dg3g').datagrid('getRows')[index].color;
					document.getElementById('col1').value = t4;
					document.getElementById('sz1').value = '';
					var totb = document.getElementById('tota' + index).value;
					document.getElementById('bdownqty1').value = totb;
					document.getElementById('klm').value = field;
					var bdwpkt = $('#dg3g').datagrid('getRows')[index].bdownpk;
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
		var q = $('#dg3g').datagrid('getSelected').br;
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

	function print() {
		var row = $('#dg').datagrid('getSelected');
		if (row) {
			//cari6 = $('#cari6b').val();
			url = "pdf/pdf_mat?dt=4&ord=" + row.ordpk + "&rkb=" + row.rkbpk;
			window.open(url);
			/*window.location.href="pdf/pdf_rkb.php&cari=breakdown&ord=" +row.ordpk;*/
		} else {
			$.messager.alert('Warning', 'No material data selected', 'warning');
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

	//$(function(){
	//$('#dg').datagrid({
	//  onClickCell: function(index,field,value){
	////    var row = $(this).datagrid('getRows')[index];
	////     if (field == 'status'){
	////      if(row.pono!=null && row.status2==6){
	////      document.getElementById('ponoi').value=row.pono;
	////      document.getElementById('rkbpki').value=row.rkbpk;
	////      $('#dialog-forminfo').dialog('open').dialog('setTitle','');
	////      $('#dginf').datagrid('load',{
	////      pono: $('#ponoi').val(),
	////      rkbpk: $('#rkbpki').val()
	////      });
	////      $.ajax({
	////      type:"POST",
	////      url:"view/get_infob.php?pono="+row.pono,
	////      data:"rkbpk="+row.rkbpk,
	////      success:function(data){
	////      document.getElementById('qtyinfo').innerHTML=data;
	////      },
	////      });
	////      }
	////     }
	//  }
	//});
	//});

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
			success: function (data) {
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
		}
		else {
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
			success: function (data) {
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

	function updateItem() {
		var selectedItem_edit = document.getElementById('nilai_usage2').value;	
		document.getElementById('input_hidden_usage_edit').value = selectedItem_edit;
	}

	function klnm_value_edit() {
		var klnm_value_selected = $('#kelnm_edit').combobox('getValue');
		console.log(klnm_value_selected);

		if (klnm_value_selected === "CUTTING") {
			$('#div_input_usage2').show();
		} else {
			$('#div_input_usage2').hide();
		}
	}

</script>

<input type="hidden" name="test1" id="test1">
<input type="hidden" name="test2" id="test2">
<input type="hidden" name="total" id="total" value="0" size="5">
<input type="hidden" name="sfu" id="sfu" value="<?php echo $_SESSION['funm']; ?>" size="8">
<!--<div id="menu" onclick="$('#menu').hide(); $('#dg').datagrid('clearSelections');"  style="display:none;">
<div class="detail" style="width:50px;">
<a href="javascript:void(0)" plain="true" onclick="edit();" style="color: #FFFFFF; text-decoration: none;">Edit</a>
</div>
<div class="detail" style="width:50px;"><a href="javascript:void(0)" plain="true" onclick="print();" style="color: #FFFFFF; text-decoration: none;"> Print </a></div>
<div class="detail"><a href="javascript:void(0)" plain="true" onclick="viewpi();" style="color: #FFFFFF; text-decoration: none;"> View PI form </a></div>
</div>-->
<!--<div id="menu" onclick="$('#menu').fadeOut(); $('#dg').datagrid('clearSelections');"  style="display:none;">
<div class="detail" style="width:50px;"><a href="javascript:void(0)" plain="true" onclick="edit();" style="color: #FFFFFF; text-decoration: none;">Edit</a></div>
<div class="detail"><a href="javascript:void(0)" plain="true" onclick="viewpi();" style="color: #FFFFFF; text-decoration: none;"> View PI form </a></div>
</div>-->

<?php
$tot = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb WHERE ordpk='$ord' GROUP BY ordpk"));
if ($tot > 0) {
	?>

	<div class="contenta">
		<div id="frame-utama-cari" style="width:530px; top:200px;">
			<div id="container-cari">
				<div id="frame-cari">
					<img src="css/images/Shape.png" plain="true" width="18px" height="18px">
					<input id="cari1b" placeholder="Search..." class="input" onkeyup="Search2();">
				</div>
			</div>
			<input style="width:140px; height:28px;" id="cari2b" class="easyui-combobox" data-options="prompt:'Status',panelHeight:'auto',onChange:Search2,
				data: [
				{value:'0',text:'All'},
				{value:'1',text:'Awaiting PI'},
				{value:'2',text:'In Revision PO'},
				{value:'3',text:'Cancel PO'},
				{value:'4',text:'Purchased'}
				]">
			<input style="width:200px; height:28px;" id="cari3b" class="easyui-combobox"
				data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=supplier&ord=<?php echo $ord; ?>',prompt:'Supplier',onChange:Search2,limitToList:'true'">
			<!--<a href="javascript:void(0);" title="Reload table" class="easyui-tooltip" onclick="$('#dg').datagrid('reload');">
<img src="css/images/reload1.png" width="20px" height="20px">-->
			</a>
		</div>
		<div id="frame-filter" style="top:210px;">
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
						<div id="myDropdown2" class="dropdown1-content" name="dropdown1-content" style="height:575px;">
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
											onclick="toggle(this); cheka1(); cheka2(); cheka3(); cheka3b(); cheka3c(); cheka3d(); cheka4(); cheka5(); cheka6(); cheka6b(); cheka6c(); cheka7(); cheka8(); cheka9(); cheka10(); cheka11(); cheka12(); cheka13(); cheka14(); cheka15();"
											checked>
									</div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Item</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek1" onclick="cheka1();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Supplier</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek2" onclick="cheka2();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Color</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek3" onclick="cheka3();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Col Code</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek3c" onclick="cheka3c();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Size</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek3d" onclick="cheka3d();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Subject</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek3b" onclick="cheka3b();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Status</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek4" onclick="cheka4();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Po no</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek5" onclick="cheka5();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Req Date</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek6" onclick="cheka6();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Rev Date</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek6b" onclick="cheka6b();"></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Can Date</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek6c" onclick="cheka6c();"></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Delivery</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek15" onclick="cheka15();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>ETD</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek7" onclick="cheka7();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Price</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek8" onclick="cheka8();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Total PO</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek9" onclick="cheka9();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Unit</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek10" onclick="cheka10();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>PI Qty</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek11" onclick="cheka11();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>PI Price</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek12" onclick="cheka12();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>PI Total</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek13" onclick="cheka13();" checked></div>
								</a>
								<a href="Javascript:void(0);" style="padding: 5px 16px;">
									<div>Specification</div>
									<div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"
											name="ck" id="chek14" onclick="cheka14();" checked></div>
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
							onclick="myFunction1e(); testku();">Filter</a></div>
					<div id="myDropdown3" class=dropdown2-content style="width:220px;height:395px">
						<div class="content-search2">
							<div id="frame-cari2">
								<img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button">
								<input id="carispl" placeholder="Search..." class="input" onkeyup="Search5();">
							</div>
						</div>
						<div id="byr1a" class="byra" style="margin-top:50px;margin-left:15px;">
							Item
							<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img1">
								<i class="bi bi-eye-slash-fill" id="togglePassword2a" style="cursor: pointer;"
									onmouseover="expand();" onmouseout="expand();"></i>
							</div>
						</div>
						<div id="tabel" class="tabela" onmousemove="totrec();"
							style="width:200px;height:auto;border:0px solid;margin-top:-120px;margin-left:-20px;">
							<table id="type" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
								url="view/get_data2.php?dt=purcashing1&ord=<?php echo $ord; ?>" toolbar="#tb"
								idField="rkbpk" striped="false" multiple="true" collapsible="true" fitColumns="false"
								method="post" data-options="border:false,loadMsg:''">
								<thead>
									<tr>
										<th field="item" width="160" sortable="false"></th>
										<th field="ck" checkbox="true" width="50"></th>
									</tr>
								</thead>
							</table>
						</div>

						<div id="byr1a" class="prodesa" style="margin-top:60px;margin-left:15px;">
							<hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
							Specification
							<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img2">
								<i class="bi bi-eye-slash-fill" id="togglePassword2b" style="cursor: pointer;"
									onmouseover="expand();" onmouseout="expand();"></i>
							</div>
						</div>
						<div id="tabel" class="tabelb" onmousemove="totrec();"
							style="width:200px;height:auto;margin-top:-15px;margin-left:-20px;">
							<table id="spec" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
								url="view/get_data2.php?dt=purcashing2&ord=<?php echo $ord; ?>" toolbar="#tb"
								idField="rkbpk" striped="false" multiple="true" collapsible="true" fitColumns="false"
								method="post" data-options="border:false,loadMsg:''">
								<thead>
									<tr>
										<th field="spec" width="160" sortable="false"></th>
										<th field="ck" checkbox="true" width="50"></th>
									</tr>
								</thead>
							</table>
						</div>

						<div id="byr1a" class="seasona" style="margin-top:55px;margin-left:15px;">
							<hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
							Color
							<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img3">
								<i class="bi bi-eye-slash-fill" id="togglePassword2c" style="cursor: pointer;"
									onmouseover="expand();" onmouseout="expand();"></i>
							</div>
						</div>
						<div id="tabel" class="tabelc" onmousemove="totrec();"
							style="width:200px;height:auto;margin-top:85px;margin-left:-20px;">
							<table id="color" class="easyui-datagrid" title="" style="width:100%;height:auto;"
								align="center" url="view/get_data2.php?dt=purcashing3&ord=<?php echo $ord; ?>" toolbar="#tb"
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
		<div id="frame-fltrchk" align="left" onmousemove="totrec();" style="width:95%;margin-top:53px;">
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
				<!--<div style="width:20px; height:auto;" id="cross" class="cross" value="<?php //echo $i; ?>" onclick="uncek(<?php //echo $i; ?>);">
&nbsp;&#215;&nbsp;
</div>-->
				<!--A-->
				<?php for ($i = 0; $i <= 1; $i++) { ?>
					<input type="button" id="filtera<?php echo $i; ?>" class="filterchek" alt="Submit button" style="" readonly>
					<input type="hidden" id="idxa<?php echo $i; ?>" size="5">
					<a href="javascript:void(0)" id="crossa<?php echo $i; ?>" class="cross"
						onclick="unceka(<?php echo $i; ?>);">&nbsp;&#215;&nbsp;</a>
					<input type="hidden" name="tall" id="talla<?php echo $i; ?>" value="0" size="5">
				<?php } ?>
				<!--B-->
				<?php for ($j = 0; $j <= 1; $j++) { ?>
					<input type="button" id="filterb<?php echo $j; ?>" class="filterchek" alt="Submit button" style="" readonly>
					<input type="hidden" id="idxb<?php echo $j; ?>" size="5">
					<a href="javascript:void(0)" id="crossb<?php echo $j; ?>" class="cross"
						onclick="uncekb(<?php echo $j; ?>);">&nbsp;&#215;&nbsp;</a>
					<input type="hidden" name="tall" id="tallb<?php echo $j; ?>" value="0" size="5">
				<?php } ?>
				<!--C-->
				<?php for ($k = 0; $k <= 1; $k++) { ?>
					<input type="button" id="filterc<?php echo $k; ?>" class="filterchek" alt="Submit button" style="" readonly>
					<input type="hidden" id="idxc<?php echo $k; ?>" size="5">
					<a href="javascript:void(0)" id="crossc<?php echo $k; ?>" class="cross"
						onclick="uncekc(<?php echo $k; ?>);">&nbsp;&#215;&nbsp;</a>
					<input type="hidden" name="tall" id="tallc<?php echo $k; ?>" value="0" size="5">
				<?php } ?>
			</div>
		</div>

		<div id="tabel1" onclick="menu();" ondblclick="edit(); $('#myHeader').hide(); " onmousemove="" style="top:240px;">
			<div style="padding:8px;margin-left:0px;text-align:left;font-weight:700;font-size: 14px;">
				<span id="tpur1b" style="margin-left:0px;text-align:left;font-weight:700;font-size: 14px;"></span>
				out of
				<span id="tpur2" style="margin-left:0px;text-align:left;font-weight:700;font-size: 14px;"></span>
				listed materials purchased
			</div>
			<!--<span style="margin-left:-1020px;font-weight:700;font-size:14px;"><?php //echo $tot3b; ?> out of <?php //echo $tot3; ?> listed materials purchased</span>-->
			<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:500px;" align="center"
				url="view/get_po.php?ord=<?php echo $ord; ?>" toolbar="#tb2" striped="true" pageSize="100"
				pageList="[100,200,300,500]" pagination="false" rownumbers="false" singleSelect="true" collapsible="true"
				fitColumns="false" method="post" data-options="multiSort:true">
				<thead>
					<tr>
						<!--<th field="no" width="32" sortable="false">No</th>-->
						<th field="item" width="90" sortable="true">Item</th>
						<th field="supnm" width="90" sortable="true">Supplier</th>
						<th field="colname" width="80" sortable="true">Color</th>
						<th field="colcode" width="86" sortable="true">Col Code</th>
						<th field="sizegar" width="80" sortable="true">Size</th>
						<th field="rev" width="85" sortable="true">Subject</th>
						<th field="status" width="85" formatter="formatter1" sortable="true">Status</th>
						<th field="ponoblue" width="80" sortable="true">PO no.</th>
						<th field="tgljam2" width="86" sortable="true">Req Date</th>
						<th field="revdate2" width="86" sortable="true" hidden="true">Rev Date</th>
						<th field="candate2" width="86" sortable="true" hidden="true">Can Date</th>
						<th field="poreqdel2" width="80" sortable="true">Delivery</th>
						<!--<th field="pidate2" width=80" sortable="true">PI date</th>-->
						<th field="etd2" width="80" sortable="true">ETD</th>
						<th field="price" width="80" sortable="true">Price</th>
						<th field="pocons2" width="80" sortable="true">Total PO</th>
						<th field="unit" width="80" sortable="true">Units</th>
						<th field="piqty" width="80" sortable="true">PI Qty</th>
						<th field="piprice" width="80" sortable="true">PI Price</th>
						<th field="pitot" width="80" sortable="true">PI Total</th>
						<th field="spec" width="90" sortable="true">Spec</th>
					</tr>
				</thead>
			</table>
			<br>
		</div>
	</div>

	<div class="header" id="myHeader" onclick="" style="display:none;">
		<div class="detail" id="mreqrev" style="width:auto;">
			<a href="javascript:void(0)" plain="true" onclick="reqrev();"
				style="color: #FFFFFF; text-decoration: none;">Request Revised</a>
		</div>
		<div class="detail" id="mcanreq" style="width:auto;">
			<a href="javascript:void(0)" plain="true" onclick="canreq();"
				style="color: #FFFFFF; text-decoration: none;">Cancel Request</a>
		</div>
		<div class="detail" style="width:auto;">
			<a href="javascript:void(0)" plain="true" onclick="edit();"
				style="color: #FFFFFF; text-decoration: none;">Edit</a>
		</div>
		<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="print();"
				style="color: #FFFFFF; text-decoration: none;"> Print </a></div>
		<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="viewpo();"
				style="color: #FFFFFF; text-decoration: none;"> View PO </a></div>
		<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="viewpi();"
				style="color: #FFFFFF; text-decoration: none;"> View PI form </a></div>
		<div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true"
				onclick="$('#myHeader').hide(); $('#dg').datagrid('clearSelections');"
				style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
	</div>

	<div id="dialog-form3a" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,closable:false,reziable:false,modal:true"
		style="width:1200px;height:575px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
		<form id="form3a" method="post">
			<input type="hidden" name="ordpk" id="ordpk">
			<input type="hidden" name="rkbpk" id="rkbpk3a">
			<input type="hidden" name="bdownpk" id="bdownpk3a">
			<input type="hidden" name="kolom" id="kolom3a">
			<input type="hidden" name="nour" id="nour">
			<input type="hidden" name="fup" id="fup">
			<input type="hidden" name="popk" id="popk">
			<!--<input type="hidden" name="tspec" id="tspec" >-->
			<div class="modal-dialog" style="width:98%; height:96%; overflow-y:scroll;overflow-x:hidden;">
				<div class="modal-content">
					<div
						style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
						Edit Material
						<a href="javascript:void(0)"
							style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:980px;"
							onclick="$('#dialog-form3a').dialog('close'); $('#form3a').form('clear');$('#div_input_usage2').hide();"> X</a>
					</div>
					<div class="fitem">
						<label>Group</label></br>
						<input name="kelnm" id="kelnm_edit" class="easyui-combobox" required="true"
							style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
							data-options="prompt:'Choose group...',panelHeight:'auto',editable:false,
								data: [
								{value:'CUTTING',text:'CUTTING'},
								{value:'SEWING',text:'SEWING'},
								{value:'FINISHING/PACKING',text:'FINISHING/PACKING'}
								], onChange:klnm_value_edit">
					</div>

					<div class="fitem item_dan_usage">
						<div class="item_input">
							<label>Item</label></br>
							<input onkeyup="multi();" name="item" id="item" class="easyui-validatebox"
								style="width: 244px; height:34px;" placeholder="Input item name...">
						</div>
						<div id="div_input_usage2" style="display:none;">
							<label>Usage</label><br>
							<select class="easyui-combobox" name="nilai_usage2" id="nilai_usage2"
								data-options="editable:true, prompt:'Jenis Usage', limitToList:'true', onChange:updateItem">
								<option value=""></option>
								<?php
									$jenis_usage = array("Shell", "Lining", "Pocketing", "Interlining", "Filler");
									$jumlah_usage = 5;

									foreach($jenis_usage as $item) {
										for($i = 1; $i <= $jumlah_usage; $i++) {
											echo "<option value='$item$i'>$item$i</option>";
										}
									}
								?>
							</select>
							<!-- <input type="text" id="input_hidden_usage_edit" name="input_hidden_usage_edit"> -->
						</div>
					</div>
					
					<div class="fitem">
						<label>Item Remarks</label></br>
						<textarea name="itemadd" id="itemadd" class="easyui-validatebox"
							style="width:1125px; height: 55px;"></textarea>
					</div>
					<div class="fitem">
						<label>Supplier</label><br>
						<input name="suppk" id="suppk" required="true"
							style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
							class="easyui-combobox"
							data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=sup',prompt:'Supplier',limitToList:'true'">
					</div>
					<label style="margin-left: 24px;">Specification <a href="javascript:void(0)" onclick="lookup_mb3();"
							style="color:#359DD9; text-decoration:none;">Search for
							material</a></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label><a href="http://192.168.0.11/RKB/data/admin.php?hal=sisa" target="_blank"
							style="color:#359DD9; text-decoration:none;">Check Stock</a></label>
					<div class="fitem">
						<input type="radio" name="tspec" id="tspec" value="1" onclick="$('#hidden').hide(); multi();">
						<label>Single Column</label>
						<input type="radio" name="tspec" id="tspec" value="2" onclick="$('#hidden').show(); multi();">
						<label>Multi Column</label>
					</div>
					<div class="fitem">
						<textarea name="spec" id="spec3a" required="true" class="easyui-validatebox" multiline="true"
							style="width:1125px; height: 55px;"></textarea>
					</div>
					<div id="hidden" style="display:none;">
						<div class="fitem">
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
						<div class="fitem">
							<input name="spec1" id="spec1" class="easyui-validatebox" style="width: 138px; height:34px;"
								placeholder="value...">
							<input name="spec2" id="spec2" class="easyui-validatebox" style="width: 138px; height:34px;"
								placeholder="value...">
							<input name="spec3" id="spec3" class="easyui-validatebox" style="width: 138px; height:34px;"
								placeholder="value...">
							<input name="spec4" id="spec4" class="easyui-validatebox" style="width: 138px; height:34px;"
								placeholder="value...">
							<input name="spec5" id="spec5" class="easyui-validatebox" style="width: 138px; height:34px;"
								placeholder="value...">
							<input name="spec6" id="spec6" class="easyui-validatebox" style="width: 138px; height:34px;"
								placeholder="value...">
							<input name="spec7" id="spec7" class="easyui-validatebox" style="width: 138px; height:34px;"
								placeholder="value...">
							<input name="spec8" id="spec8" class="easyui-validatebox" style="width: 138px; height:34px;"
								placeholder="value...">
						</div>
					</div>
					<div class="fitem">
						<label>Spec Remarks</label></br>
						<textarea name="specadd" id="specadd" class="easyui-validatebox"
							style="width:1125px; height: 55px;"></textarea>
					</div>
					<div class="fitem">
						<label>Color Name</label>&emsp;&emsp;&emsp;&emsp;
						<label>Color Code</label>
					</div>
					<div class="fitem">
						<input name="colname" id="colname3a" required="true" class="easyui-validatebox"
							style="width: 150px; height:34px;" placeholder="Input color...">&nbsp;
						<input name="colcode" id="colcode3a" required="true" class="easyui-validatebox"
							style="width: 150px; height:34px;" placeholder="Input code...">
						<a href="javascript:void(0)" onclick="lookup_col3();"
							style="color:#359DD9; text-decoration:none;">Lookup</a>
					</div>
					<div class="fitem">
						<label>Size</label></br>
						<input name="sizegar" id="sizegar3a" required="true" class="easyui-validatebox"
							style="width: 150px; height:34px;" placeholder="Input size...">
						<a href="javascript:void(0)" onclick="lookup_bdown3();"
							style="color:#359DD9; text-decoration:none;">Lookup</a>
					</div>
					<div class="">
						<label style="margin-left: 24px;font-size: 15px;">Unit</label>&emsp;&emsp;&emsp;&emsp;&emsp;
						<label style="font-size: 15px;">Budgeting price</label>&nbsp;&nbsp;
						<label style="font-size: 15px;">Currency</label>
					</div>
					<div class="fitem">
						<!--<input name="unit" id="unit" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input Unit...">&nbsp;-->
						<input name="unit" id="unit"
							style="width: 88px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
							class="easyui-combobox"
							data-options="valueField:'unita',textField:'unita',url:'view/get_data.php?dt=piunit',prompt:'Unit',limitToList:true">
						<input required name="price2" id="price2" class="easyui-validatebox"
							style="width: 103px; height:34px;" placeholder="0">&nbsp;
						<input name="curpk" id="curpk"
							style="width: 88px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
							class="easyui-combobox"
							data-options="valueField:'curpk',textField:'curid',url:'view/get_data.php?dt=cur',prompt:'USD',limitToList:'true'">
					</div>
					<div class="fitem">
						<label>Bdown Qty.</label></br>
						<input name="bdownqty" id="bdownqty3a" required="true" class="easyui-validatebox"
							style="width: 150px; height:34px;" placeholder="0" onkeyup="canbdown(); myFunction3a();" onchange="canbdown(); myFunction3a();">
						<a href="javascript:void(0)" onclick="lookup_bdown3();"
							style="color:#359DD9; text-decoration:none;">Lookup</a>
						<input type="hidden" name="canbd" id="canbd" size="5">
					</div>
					<div>
						<label
							style="margin-left: 24px;font-size: 15px;">Allowance%</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
						<label style="font-size: 15px;">Allowman</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
						<label style="font-size: 15px;">Costing Cons.</label>&emsp;&emsp;&emsp;&emsp;
						<label style="font-size: 15px;">Purcashing Cons.</label>&emsp;&emsp;
						<label style="font-size: 15px;">Variance Cons.</label>
					</div>
					<div class="fitem">
						<input name="allowcons" id="allowcons3a" class="easyui-validatebox"
							style="width: 150px; height:34px;" placeholder="0" onkeyup="myFunction3a();" onchange="myFunction3a();">&nbsp;
						<input name="allowman" id="allowman3a" class="easyui-validatebox" style="width: 150px; height:34px;"
							placeholder="0" onkeyup="myFunction3a();" onchange="myFunction3a();">&nbsp;
						<input name="negocons" id="negocons3a" class="easyui-validatebox" style="width: 150px; height:34px;"
							placeholder="0" onkeyup="myFunction3a();" onchange="myFunction3a();">&nbsp;
						<input name="estcons" id="estcons3a" class="easyui-validatebox" style="width: 150px; height:34px;"
							placeholder="0" onkeyup="myFunction3a();" onchange="myFunction3a();">
						<input name="varcons" id="varcons3a" class="easyui-validatebox"
							style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					</div>
					<div class="fitem">
						<label>Netto</label>&emsp;
						<label>Formula </label>
						<label></label>
					</div>
					<div class="fitem">
						<input name="totcons" id="totcons3a" class="easyui-validatebox"
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
						<input name="f1" id="f1" placeholder=" / 100000000 " class="easyui-validatebox"
							style="width:100px; height:34px;" onkeyup="myFunction3a();" onchange="myFunction3a();">
						<!--<select class="easyui-combobox" name="f2a" id="f2a"
data-options="editable:false, panelHeight:'auto'" style="width:50px;">
<option value=""></option>
<option value="+"> + </option>
<option value="-"> - </option>
<option value="*"> * </option>
<option value="/"> / </option>
</select>-->
						<input name="f2" id="f2" placeholder=" + 100000000 " class="easyui-validatebox"
							style="width:100px; height:34px;" onkeyup="myFunction3a();" onchange="myFunction3a();">
					</div>
					<!--<div class="fitem">
<label>Netto</label></br>
<input name="totcons" id="totcons" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
</div>-->
					<div class="fitem">
						<label>PPS</label></br>
						<input name="qrs" id="qrs3a" class="easyui-validatebox" style="width: 150px; height:34px;"
							placeholder="0" onkeyup="myFunction3a();" onchange="myFunction3a();">
					</div>
					<div class="fitem">
						<label>Total PO</label></br>
						<input name="pocons1" id="pocons3a" class="easyui-validatebox"
							style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
						<input name="pocons2b" id="pocons3b" class="easyui-validatebox"
							style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					</div>
					<a style="text-decoration:none; left:725px; margin-top:-37px;" href="javascript:void(0)"
						class="button-cancel"
						onclick="$('#dialog-form3a').dialog('close'); $('#form3a').form('clear'); $('#div_input_usage2').hide();">Cancel</a>
					<!-- <a style="text-decoration:none;" href="javascript:void(0)" class="button-submit" onclick="save();">Submit</a>-->
					<a style="text-decoration:none; left:800px; margin-top:-35px;" href="javascript:void(0)" value="Save"
						class="button-submit" onclick="save3a(); $('#div_input_usage2').hide();">Save</a>
					<!--<a style="text-decoration:none; left:1000px; bottom: 35px;"" href="javascript:void(0)" class="button-request-po" onclick="save3aa();">Save & Request PO</a>-->
				</div>
			</div>
		</form>
	</div>

	<!-- DIALOG FORM REQUEST PO -->
	<div id="dialog-form3aa" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,reziable:false,modal:true,closable:false"
		style="width:350px;height:200px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
		<form id="form3aa" method="post">
			<input type="hidden" name="rkbpk" id="rkb3" size="8">
			<!-- <div class="modal-dialog" style="width:325px; height:175px;"> -->
			<div class="modal-content">
				<div
					style="padding:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Set material delivery date
					<div><br>
						<input name="poreqdel" id="poreqdel" class="easyui-datebox"
							data-options="formatter:myformatter3a,parser:myparser3a" style="width:60%;"></br>
						<label
							style="width:auto; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date
							format must be in YYYY-MM-DD</label>
						<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
						<a style="text-decoration:none; left:71px; top: 128px;" href="javascript:void(0)"
							class="button-cancel" onclick="cancelreq3bb();">Cancel</a>
						<a style="text-decoration:none; left:150px; top: 128px;"" href=" javascript:void(0)"
							class="button-request-po" onclick="save3bb();">Submit PO request</a>
					</div>
				</div>
				<!-- </div> -->
		</form>
	</div>

	<!-- LOOKUP Color -->
	<div id="dialog-form3e" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,reziable:false,modal:true,closable:false"
		style="width:900px;height:550px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
		<div class="modal-dialog" style="width:98%; height:96%; overflow-y:scroll;overflow-x:hidden;">
			<div class="modal-content">
				<div
					style="margin-top:10px; margin-left:15px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Lookup Color
					<a href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:680px;"
						onclick="$('#dialog-form3e').dialog('close');"> X</a>
				</div>
				<div class="content-search3" style="margin-top:-35px;">
					<div id="frame-cari3">
						<img src="css/images/Shape.png" plain="true" width="18px" height="18px">
						<input id="cari7b" placeholder="Search..." class="input" onkeyup="Search3a();">
					</div>
				</div>
				<!--<img src="css/images/Shape.png" plain="true" width="18px" height="18px" style="margin-top:-22px; margin-left:168px;" onclick="get_lookup();">
<input id="cari7b" placeholder="Search Color" class="input" onkeyup="Search3a();" style="width:218px; height:30px;margin-top:-26px; margin-left:190px;"></br>-->
				<div id="tabel2" onclick="get_lookup3();" style="width:860px; margin-top:25px;">
					<table id="dg3e" class="easyui-datagrid" title="" style="width:100%;height:460px;" align="center"
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
	<div id="dialog-form3f" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,reziable:false,modal:true,closable:false"
		style="width:900px;height:550px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
		<div class="modal-dialog" style="width:98%; height:96%; overflow-y:scroll;overflow-x:hidden;">
			<div class="modal-content">
				<div
					style="margin-top:10px; margin-left:15px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Lookup Material
					<a href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:660px;"
						onclick="$('#dialog-form3f').dialog('close');"> X</a>
				</div>
				<div class="content-search3" style="margin-top:-35px;">
					<div id="frame-cari3">
						<img src="css/images/Shape.png" plain="true" width="18px" height="18px">
						<input id="cari8b" placeholder="Search..." class="input" onkeyup="Search3b();">
					</div>
				</div>
				<!--<img src="css/images/Shape.png" plain="true" width="18px" height="18px" style="margin-top:-22px; margin-left:178px;" onclick="get_mb();">
<input id="cari8b" placeholder="Search item material" class="input" onkeyup="Search3b();" style="width:218px; height:30px;margin-top:-26px; margin-left:200px;"></br>-->
				<div id="tabel2" onclick="get_mb3();" style="width:860px; margin-top:25px;">
					<table id="dg3f" class="easyui-datagrid" title="" style="width:100%;height:460px;" align="center"
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
	<div id="dialog-form3g" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,reziable:false,modal:true"
		style="width:100%;height:660px; padding:5px 5px; display:none;top:75px;border-radius:8px;">
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
					onclick="$('#dialog-form3g').dialog('close');"> X</a>
			</div>
			<div style="margin-left:90%;">
				<a style="margin-right:10px;" href="javascript:void(0);" class="easyui-linkbutton" id="btn1"
					data-options="iconCls:'icon-add'" onclick="gtrow();">Get</a>
			</div>
			<br>
			<!-- <div class="modal-dialog" style="width:98%; height:93%; overflow-y:scroll;overflow-x:hidden;"> -->
			<div id="tabel2">
				<table id="dg3g" class="easyui-datagrid" title="" style="width:99.5%;height:540px;" align="center"
					url="view/get_data.php?dt=bdown&ord=<?php echo $_GET['ord']; ?>" toolbar="#tb2" striped="false"
					pagination="false" rownumbers="false" singleSelect="true" collapsible="false" fitColumns="false">
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
$ord=$_GET['ord'];
$crh=mysqli_query($koneksi,"select * from bdown where ordpk='$ord' and jenis='HEADER' order by bdownpk desc limit 1");
$dth=mysqli_fetch_array($crh);
if($dth['s1']<>"" || !empty($dth['s1'])){ $sz1=1; } else { $sz1=0; $hidden1="hidden"; }
if($dth['s2']<>"" || !empty($dth['s2'])){ $sz2=1; } else { $sz2=0; $hidden2="hidden"; }
if($dth['s3']<>"" || !empty($dth['s3'])){ $sz3=1; } else { $sz3=0; $hidden3="hidden"; }
if($dth['s4']<>"" || !empty($dth['s4'])){ $sz4=1; } else { $sz4=0; $hidden4="hidden"; }
if($dth['s5']<>"" || !empty($dth['s5'])){ $sz5=1; } else { $sz5=0; $hidden5="hidden"; }
if($dth['s6']<>"" || !empty($dth['s6'])){ $sz6=1; } else { $sz6=0; $hidden6="hidden"; }
if($dth['s7']<>"" || !empty($dth['s7'])){ $sz7=1; } else { $sz7=0; $hidden7="hidden"; }
if($dth['s8']<>"" || !empty($dth['s8'])){ $sz8=1; } else { $sz8=0; $hidden8="hidden"; }
if($dth['s9']<>"" || !empty($dth['s9'])){ $sz9=1; } else { $sz9=0; $hidden9="hidden"; }
if($dth['s10']<>"" || !empty($dth['s10'])){ $sz10=1; } else { $sz10=0; $hidden10="hidden"; }
if($dth['s11']<>"" || !empty($dth['s11'])){ $sz11=1; } else { $sz11=0; $hidden11="hidden"; }
if($dth['s12']<>"" || !empty($dth['s12'])){ $sz12=1; } else { $sz12=0; $hidden12="hidden"; }
if($dth['s13']<>"" || !empty($dth['s13'])){ $sz13=1; } else { $sz13=0; $hidden13="hidden"; }
if($dth['s14']<>"" || !empty($dth['s14'])){ $sz14=1; } else { $sz14=0; $hidden14="hidden"; }
if($dth['s15']<>"" || !empty($dth['s15'])){ $sz15=1; } else { $sz15=0; $hidden15="hidden"; }
if($dth['s16']<>"" || !empty($dth['s16'])){ $sz16=1; } else { $sz16=0; $hidden16="hidden"; }
if($dth['s17']<>"" || !empty($dth['s17'])){ $sz17=1; } else { $sz17=0; $hidden17="hidden"; }
if($dth['s18']<>"" || !empty($dth['s18'])){ $sz18=1; } else { $sz18=0; $hidden18="hidden"; }
if($dth['s19']<>"" || !empty($dth['s19'])){ $sz19=1; } else { $sz19=0; $hidden19="hidden"; }
if($dth['s20']<>"" || !empty($dth['s20'])){ $sz20=1; } else { $sz20=0; $hidden20="hidden"; }
if($dth['s21']<>"" || !empty($dth['s21'])){ $sz21=1; } else { $sz21=0; $hidden21="hidden"; }
if($dth['s22']<>"" || !empty($dth['s22'])){ $sz22=1; } else { $sz22=0; $hidden22="hidden"; }
if($dth['s23']<>"" || !empty($dth['s23'])){ $sz23=1; } else { $sz23=0; $hidden23="hidden"; }
if($dth['s24']<>"" || !empty($dth['s24'])){ $sz24=1; } else { $sz24=0; $hidden24="hidden"; }
if($dth['s25']<>"" || !empty($dth['s25'])){ $sz25=1; } else { $sz25=0; $hidden25="hidden"; }
if($dth['s26']<>"" || !empty($dth['s26'])){ $sz26=1; } else { $sz26=0; $hidden26="hidden"; }
if($dth['s27']<>"" || !empty($dth['s27'])){ $sz27=1; } else { $sz27=0; $hidden27="hidden"; }
if($dth['s28']<>"" || !empty($dth['s28'])){ $sz28=1; } else { $sz28=0; $hidden28="hidden"; }
if($dth['s29']<>"" || !empty($dth['s29'])){ $sz29=1; } else { $sz29=0; $hidden29="hidden"; }
if($dth['s30']<>"" || !empty($dth['s30'])){ $sz30=1; } else { $sz30=0; $hidden30="hidden"; }
if($dth['s31']<>"" || !empty($dth['s31'])){ $sz31=1; } else { $sz31=0; $hidden31="hidden"; }
if($dth['s32']<>"" || !empty($dth['s32'])){ $sz32=1; } else { $sz32=0; $hidden32="hidden"; }
if($dth['s33']<>"" || !empty($dth['s33'])){ $sz33=1; } else { $sz33=0; $hidden33="hidden"; }
if($dth['s34']<>"" || !empty($dth['s34'])){ $sz34=1; } else { $sz34=0; $hidden34="hidden"; }
if($dth['s35']<>"" || !empty($dth['s35'])){ $sz35=1; } else { $sz35=0; $hidden35="hidden"; }
if($dth['s36']<>"" || !empty($dth['s36'])){ $sz36=1; } else { $sz36=0; $hidden36="hidden"; }
if($dth['s37']<>"" || !empty($dth['s37'])){ $sz37=1; } else { $sz37=0; $hidden37="hidden"; }
if($dth['s38']<>"" || !empty($dth['s38'])){ $sz38=1; } else { $sz38=0; $hidden38="hidden"; }
if($dth['s39']<>"" || !empty($dth['s39'])){ $sz39=1; } else { $sz39=0; $hidden39="hidden"; }
if($dth['s40']<>"" || !empty($dth['s40'])){ $sz40=1; } else { $sz40=0; $hidden40="hidden"; }
$cjml=$sz1+$sz2+$sz3+$sz4+$sz5+$sz6+$sz7+$sz8+$sz9+$sz10
+$sz11+$sz12+$sz13+$sz14+$sz15+$sz16+$sz17+$sz18+$sz19+$sz20
+$sz21+$sz22+$sz23+$sz24+$sz25+$sz26+$sz27+$sz28+$sz29+$sz30
+$sz31+$sz32+$sz33+$sz34+$sz35+$sz36+$sz37+$sz38+$sz39+$sz40;
?>
					<tr>
						<th field="jenis" width="35" hidden="true">Jenis</th>
						<th field="country" width="100">Place</th>
						<th field="pono" width="100">PO no.</th>
						<th field="opno" width="100">OP no.</th>
						<th field="style" width="100">Style</th>
						<th field="color" width="100">Color</th>
						<th field="gac" width="100">Ex Factory</th>
						<th field="s1" width="50"  <?php echo $hidden1; ?>></th>
<th field="s2"  width="50"  <?php echo $hidden2; ?>></th>
<th field="s3"  width="50"  <?php echo $hidden3; ?>></th>
<th field="s4"  width="50"  <?php echo $hidden4; ?>></th>
<th field="s5"  width="50"  <?php echo $hidden5; ?>></th>
<th field="s6"  width="50"  <?php echo $hidden6; ?>></th>
<th field="s7"  width="50"  <?php echo $hidden7; ?>></th>
<th field="s8"  width="50"  <?php echo $hidden8; ?>></th>
<th field="s9"  width="50"  <?php echo $hidden9; ?>></th>
<th field="s10"  width="50"  <?php echo $hidden10; ?>></th>
<th field="s11"  width="50"  <?php echo $hidden11; ?>></th>
<th field="s12"  width="50"  <?php echo $hidden12; ?>></th>
<th field="s13"  width="50"  <?php echo $hidden13; ?>></th>
<th field="s14"  width="50"  <?php echo $hidden14; ?>></th>
<th field="s15"  width="50"  <?php echo $hidden15; ?>></th>
<th field="s16"  width="50"  <?php echo $hidden16; ?>></th>
<th field="s17"  width="50"  <?php echo $hidden17; ?>></th>
<th field="s18"  width="50"  <?php echo $hidden18; ?>></th>
<th field="s19"  width="50"  <?php echo $hidden19; ?>></th>
<th field="s20"  width="50"  <?php echo $hidden20; ?>></th>
<th field="s21"  width="50"  <?php echo $hidden21; ?>></th>
<th field="s22"  width="50"  <?php echo $hidden22; ?>></th>
<th field="s23"  width="50"  <?php echo $hidden23; ?>></th>
<th field="s24"  width="50"  <?php echo $hidden24; ?>></th>
<th field="s25"  width="50"  <?php echo $hidden25; ?>></th>
<th field="s26"  width="50"  <?php echo $hidden26; ?>></th>
<th field="s27"  width="50"  <?php echo $hidden27; ?>></th>
<th field="s28"  width="50"  <?php echo $hidden28; ?>></th>
<th field="s29"  width="50"  <?php echo $hidden29; ?>></th>
<th field="s30"  width="50"  <?php echo $hidden30; ?>></th>
<th field="s31"  width="50"  <?php echo $hidden31; ?>></th>
<th field="s32"  width="50"  <?php echo $hidden32; ?>></th>
<th field="s33"  width="50"  <?php echo $hidden33; ?>></th>
<th field="s34"  width="50"  <?php echo $hidden34; ?>></th>
<th field="s35"  width="50"  <?php echo $hidden35; ?>></th>
<th field="s36"  width="50"  <?php echo $hidden36; ?>></th>
<th field="s37"  width="50"  <?php echo $hidden37; ?>></th>
<th field="s38"  width="50"  <?php echo $hidden38; ?>></th>
<th field="s39"  width="50"  <?php echo $hidden39; ?>></th>
<th field="s40"  width="50"  <?php echo $hidden40; ?>></th>
						<th field="tot" width="70">Total</th>
						</tr>
					</thead>
				</table>
			</div>
			<!-- </div> -->
		</div>
	</div>

	<div id="dialog-forminfo" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:false,modal:true,closable:false"
		style="width:377px;height:310px;padding:5px 5px;display:none;top:200px;border-radius:8px;">
		<form id="forminfo" method="post">
			<div class="modal-content">
				<div id="close" style="margin-top:0px; margin-left:325px;">
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
				<div id="tbinf" style="margin-left:15px;" onclick="routeship()">
					<table id="dginf" class="easyui-datagrid" title="" style="width:320px;height:190px;" align="center"
						toolbar="#tb2" striped="false" border="true" pageSize="100" pageList="[100,200,300,500]"
						pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="false"
						data-options="multiSort:false">
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
				<span
					style="margin-left: 15px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
					id="qtyinfo"></span>
			</div>
		</form>
	</div>

	<!--Shipment detail -->
	<div id="dialog-enroute2" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:false,modal:true,closable:false"
		style="width:1017px;height:550px;padding:5px 5px;display:none;top:100px;border-radius:8px;">
		<div id="close" style="margin-top:5px; margin-left:960px;">
			<a id="close" href="javascript:void(0)"
				style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
				onclick="$('#dialog-enroute2').dialog('close');"> X</a>
		</div>
		<div id="shipdetail2" style="margin-top:-15px;">
			<div class="ShipmentDetails"
				style="margin-top:15px;margin-left:15px;color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word">
				Shipment details</div>
			<table border="0" style="margin-left:15px;">
				<tr>
					<th width="150" align="left">
						<div
							style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
							Vassal type</div>
					</th>
					<th width="275" align="left">
						<div
							style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
							Vassal name</div>
					</th>
					<th width="250" align="left">
						<div
							style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
							AirwayBill Number</div>
					</th>
					<th width="200" align="left">
						<div
							style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
							Arrival city</div>
					</th>
					<th width="200" align="left">
						<div
							style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
							Port name</div>
					</th>
				</tr>
				<tr>
					<td align="left"><input type="text" name="typenm2" id="typenm2" style="border:none;" readonly></td>
					<td align="left"><input type="text" name="vassalnm2" id="vassalnm2" style="width: 200px;border:none;"
							readonly></td>
					<td align="left"><input type="text" name="bill2" id="bill2" style="width: 200px;border:none;" readonly>
					</td>
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
						<div
							style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
							Gross weight</div>
					</th>
					<th width="250" align="left">
						<div
							style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
							Dimension of boxes</div>
					</th>
					<th width="250" align="left">
						<div
							style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
							Total Package</div>
					</th>
				</tr>
				<tr>
					<td align="left"><input type="text" name="gw2" id="gw2" style="border:none;" readonly></td>
					<td align="left">(P)<input type="text" name="dp2" id="dp2" style="width: 35px;border:none;" readonly>x
						(L)<input type="text" name="dl2" id="dl2" style="width: 35px;border:none;" readonly>x (T)<input
							type="text" name="dt2" id="dt2" style="width: 35px;border:none;" readonly>cm</td>
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
						<div
							style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word;">
							ETD</div>
					</th>
					<th align="left" width="150">
						<div
							style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word;">
							ETA</div>
					</th>
					<th align="left" width="150">
						<div
							style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word;">
							EIH (Estimate in house)</div>
					</th>
				</tr>
				<tr>
					<td align="left"><input type="text" name="etd222" id="etd222" class="easyui-validatebox"
							style="border:none;" data-options="formatter:myformatter,parser:myparser" readonly></td>
					<td align="left"><input type="text" name="eta222" id="eta222" class="easyui-validatebox"
							style="border:none;" data-options="formatter:myformatter,parser:myparser" readonly></td>
					<td align="left"><input type="text" name="eih222" id="eih222" class="easyui-validatebox"
							style="border:none;" data-options="formatter:myformatter,parser:myparser" readonly></td>
				</tr>
			</table>
			<br>
			<div id="tabel2c" onclick="" onmousemove="" style="margin-top:10px;margin-left:15px;">
				<div class="ItemDetails"
					style="color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word;">
					Shipment Log</div>
				<table id="dg2c" class="easyui-datagrid" title="" style="width:79%;" align="center"
					url="view/get_log_shipment.php" border="none" striped="false" idField="importdtpk"
					data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,border:true,autoRowHeight:true">
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

	<script type="text/javascript">
		window.onscroll = function () { myFunctiona(); myFunctionb(); };

		var header = document.getElementById("myHeader");
		var sticky = header.offsetTop;
		function myFunctiona() {
			if (window.pageYOffset > sticky) {
				header.classList.add("sticky");
			} else {
				header.classList.remove("sticky");
			}
		}

		// var header2 = document.getElementById("dialog-forminfo");
		// var sticky2 = header2.offsetTop;
		// function myFunctionb(){
		//   if (window.pageYOffset > sticky2){
		//     header2.classList.add("sticky");
		//   } else {
		//     header2.classList.remove("sticky");
		//   }
		// }
	</script>

<?php } else { ?>
	<!-- <div class="contenta" style="text-align:left;">
  <div id="frame-utama-cari" style="width:720px;text-align:left;margin-left:-31%;">
<div style="font-size:14px;font-weight:400;color:#d3d3d3;text-align:left;margin-top:15%;">No data available. Please check in again later.</div>
</div>
</div> -->
	<div id="frame-utama-cari" style="width:auto;text-align:left;top:210px;">
		<span style="font-size:14px;font-weight:400;color:#d3d3d3;text-align:left;">No data available. Please check in again
			later.</span>
	</div>
	</div>
<?php } ?>