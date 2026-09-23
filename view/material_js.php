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

	/*open dialog*/
	function create2() {
		$('#dialog-forma').dialog('open').dialog('setTitle', '');
		//$('#dialog-formb').css('overflow','scroll');
		//$('#formb').form('clear');
		//var div_top = $('#dialog-formb .panel-body');
		//$(dd.dialog.id+' .panel-body').scrollTop(0);
		//ord = $('#ord').val();
		/*alert(ord);*/
		//document.getElementById("ordpk").value = +ord;
		//document.getElementById("tspec").value = 1;
	}

	function create2b() {
		$('#dialog-forma').dialog('open').dialog('setTitle', '');
	}

	/*edit*/
	function edit2() {
		var row = $('#dg2').datagrid('getSelected');
		var sfu = $('#sfu').val();
		if (row) {
			if (row.status2 == 3) {
				$('#viewmemo').show();
				$('#close').show();
				$('#viewmemo2').hide();
				$('#dialog-formb').dialog('open').dialog('setTitle', '');
				$('#formb').form('load', row);
				if (row.tspec == 2) {
					$('#hidden').show();
				} else {
					$('#hidden').hide();
				}
			} else {
				$('#viewmemo').hide();
				$('#close').hide();
				$('#viewmemo2').show();

				if (row.popk > 0) {
					if (row.fup == sfu) {
						if (row.pur == "Rita") {
							if (row.stspk == 4) {
								$('#dialog-formb').dialog('open').dialog('setTitle', '');
								$('#formb').form('load', row);
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
								$('#dialog-formb').dialog('open').dialog('setTitle', '');
								$('#formb').form('load', row);
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
								function(r) {
									if (r) {
										$('#dialog-formb').dialog('open').dialog('setTitle', '');
										$('#formb').form('load', row);
										if (row.tspec == 2) {
											$('#hidden').show();
										} else {
											$('#hidden').hide();
										}
									}
								});
						}
					} else if (row.stspk == 4) {
						$('#dialog-formb').dialog('open').dialog('setTitle', '');
						$('#formb').form('load', row);
						if (row.tspec == 2) {
							$('#hidden').show();
						} else {
							$('#hidden').hide();
						}
					} else if (row.postatpk == 2) {
						if (row.stspk == 4) {
							$('#dialog-formb').dialog('open').dialog('setTitle', '');
							$('#formb').form('load', row);
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
					$('#dialog-formb').dialog('open').dialog('setTitle', '');
					$('#formb').form('load', row);
					if (row.tspec == 2) {
						$('#hidden').show();
					} else {
						$('#hidden').hide();
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
		$('#dg4f').datagrid('load', {
			cari8: $('#cari8').val()
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

	/* RUmus Onkeyup */
	function myFunction2a() {
		var x = document.getElementById("bdownqty").value;
		// alert(x);
		var y = document.getElementById("allowcons").value;
		var a = document.getElementById("qrs").value;
		var b = document.getElementById("estcons").value;
		var c = document.getElementById("allowman").value;
		var d = document.getElementById("negocons").value;
		var g = document.getElementById("formula1").value;
		//var f1a = document.getElementById("f1a").value;
		//var f2a = document.getElementById("f2a").value;
		var f1b = document.getElementById("f1").value;
		var f2b = document.getElementById("f2").value;
		//var g =  $('#formula1').val();
		//var h =  $('#formula2').val();

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
				url: "view/get_rumus.php?bdownqty=" + x + "&estcons=" + b + "&formula1=" + g + "&f2b=" + f2b,
				data: "f1b=" + f1b,
				success: function(data) {
					//alert(data);
					//var e = data;
					document.getElementById("totcons").value = data;
					var e2 = document.getElementById("totcons").value;

					var f = d - b;
					document.getElementById("varcons").value = f;

					var z = parseFloat(e2) + (parseFloat(e2) * parseFloat(y2) / 100) + parseFloat(a2) + parseFloat(c2);
					document.getElementById("pocons").value = z;
					document.getElementById("pocons2").value = Math.ceil(z);
				},
			});
		} else {
			var e = x * b;
			document.getElementById("totcons").value = e;
			var e2 = document.getElementById("totcons").value;

			var f = d - b;
			document.getElementById("varcons").value = f;

			var z = parseFloat(e2) + (parseFloat(e2) * parseFloat(y2) / 100) + parseFloat(a2) + parseFloat(c2);
			document.getElementById("pocons").value = z;
			document.getElementById("pocons2").value = Math.ceil(z);
		}
	}

	function myFunction2b() {
		var x = document.getElementById("bdownqty1a").value;
		// alert(x);
		var y = document.getElementById("allowcons1").value;
		var a = document.getElementById("qrs1").value;
		var b = document.getElementById("estcons1").value;
		var c = document.getElementById("allowman1").value;
		var d = document.getElementById("negocons1").value;
		var g = document.getElementById("formula1b").value;
		//var f1a = document.getElementById("f1a").value;
		//var f2a = document.getElementById("f2a").value;
		var f1b = document.getElementById("f1b").value;
		var f2b = document.getElementById("f2b").value;
		//var g =  $('#formula1').val();
		//var h =  $('#formula2').val();

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
				url: "view/get_rumus.php?bdownqty=" + x + "&estcons=" + b + "&formula1=" + g + "&f2b=" + f2b,
				data: "f1b=" + f1b,
				success: function(data) {
					//alert(data);
					//var e = data;
					document.getElementById("totcons1").value = data;
					var e2 = document.getElementById("totcons1").value;

					var f = d - b;
					document.getElementById("varcons1").value = f;

					var z = parseFloat(e2) + (parseFloat(e2) * parseFloat(y2) / 100) + parseFloat(a2) + parseFloat(c2);
					document.getElementById("pocons1").value = z;
					document.getElementById("pocons2b").value = Math.ceil(z);
				},
			});
		} else {
			var e = x * b;
			document.getElementById("totcons1").value = e;

			var e2 = document.getElementById("totcons1").value;

			var f = d - b;
			document.getElementById("varcons1").value = f;

			var z = parseFloat(e2) + (parseFloat(e2) * parseFloat(y2) / 100) + parseFloat(a2) + parseFloat(c2);
			document.getElementById("pocons1").value = z;
			document.getElementById("pocons2b").value = Math.ceil(z);
		}
	}
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

	function sup2() {
		//$('#external2b').hide();
		//$('#external2').show();
		//var ckk=$('#progres').datagrid('getRows')[index].progresnm;
		var ext2 = $('#ext2').val();
		var ck2 = $('#external2').val();
		//var ck2b = $('#external2b').val();
		//alert(suppk);
		if (ext2 == "") {
			$('#suppk2a').hide();
			$('#suppk2b').show();
			$('#suppk2bb').combobox('select', ck2);
			var suppk = $('#suppk2aa').val();
			var suppkb = $('#suppk2bb').val();
			document.getElementById('ext2').value = suppk;
			document.getElementById('ext2b').value = suppkb;
		} else {
			$('#suppk2a').show();
			$('#suppk2b').hide();
			$('#suppk2aa').combobox('select', ext2);
			//var suppk = $('#suppk1aa').val();
			document.getElementById('ext2').value = "";
			document.getElementById('ext2b').value = "";
		}
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
			} else {
			$('#div_input_usage').hide();
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
			} else {
			$('#div_input_usage2').hide();
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
			url = "excel/excel_mat?ord=" + row.ordpk + "&rkb=" + ids;
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
</script>