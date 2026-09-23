<?php //session_start();
//include "action/sinkron6.php";
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
.sticky + .contenta {
  padding-top: 102px;
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
</style>

<script type="text/javascript">
var url;

/*menu*/
// function menu(){
// 	var row = $('#dg').datagrid('getSelected');
// 	if(row){
// 		$('#myHeader').show();
// 	} else {
// 	$('#myHeader').hide();
// 	//$('#dg').datagrid('clearSelections');
// 	}
// }

function menu(){
	var row = $('#dg').datagrid('getSelected');
	if(row){
		$('#myHeader').show();
  count_row();
	} else {
	$('#myHeader').hide();
	$('#dg').datagrid('clearSelections');
	}
}

function menu2(){
$('#myHeader').hide();	
}

/*search*/
function Search(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
srcitem();
 srcsupp();
 srccolor();
}

function Searcha(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari3: $('#cari3').val(),
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
	$('#newest').show();
$('#oldest').hide();
$('#recently').hide();
 }

function Searchb(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari4: $('#cari4').val(),
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
$('#newest').hide();
$('#oldest').show();
$('#recently').hide();
}

function Searchc(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari4b: $('#cari4b').val(),
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
$('#newest').hide();
$('#oldest').hide();
$('#recently').show();
}

/*view*/
function viewpo(){
/*var ids = [];
var rows = $('#dg').datagrid('getChecked');*/
var rows = $('#dg').datagrid('getSelected');
	if(rows){
  var cari1=document.getElementById('cari1').value;
  var cari2=document.getElementById('cari2').value;
  // var cari5=document.getElementById('cari5').value;
  // var cari6=document.getElementById('cari6').value;
 /*for(var i=0; i<rows.length; i++){
	ids.push(rows[i].rkbpk);
	}
	$.each(ids, function (index, value){
	$.post('pdf/pdf_mat2.php',{id:value});*/
	/*cari = $('#cari2').val();
 pur = $('#pur').val();
 alert(value);*/
  $.ajax({
		type	: "POST",
		url	: "action/simpan.php?x=tpo2&po="+rows.popk,
		data	: 'popk3='+rows.popk,
		success	: function(data){
      window.location.href="?hal=detpo&r=1&po=" +rows.popk+"&cari1="+cari1+"&cari2="+cari2;
     }
				});
	/*url = "pdf/pdf_po.php?po="+rows.pono;
 window.open(url);*/
	/*window.location.href="pdf/pdf_rkb.php&cari=breakdown&ord=" +row.ordpk;*/
	/*});*/
 } else {
		$.messager.alert('Warning','No PO data selected','warning');
	}
}

function viewpo2(){
var rows = $('#dg').datagrid('getSelected');
	if(rows){
    /*if(rows.postatpk==3){
   $.messager.alert('Warning','PO data status cancel','warning');
  } else {*/
	url = "?hal=detpo&po=" +rows.popk;
  window.open(url);
	//window.location.href="?hal=qty&ord=" +row.ordpk;
	/*}*/
 } else {
		$.messager.alert('Warning','No PO data selected','warning');
	}
}

// function apv() {
// 	var ids = [];
// 	var rows = $('#dg').datagrid('getSelections');
// 	for (var i = 0; i < rows.length; i++) {
// 		ids.push(rows[i].popk);
// 	}
// 	$.messager.confirm('Confirm', 'Are you sure you want to approved this revision PO ?',
// 		function(r) {
// 			if (r) {
// 				$.each(ids, function(index, value) {
// 					$.post('action/simpan_apv.php?x=apv', {
// 						id: value
// 					}, function(result) {
// 						if (result.success) {
// 							$.messager.show({
// 								title: '',
// 								msg: result.msg,
// 								timeout: 3000,
// 								showType: 'slide',
// 								icon: 'info',
// 								width: 252,
// 								height: 55,
// 								style: {
// 									left: 0,
// 									right: '',
// 									top: '',
// 									bottom: -document.body.scrollTop - document.documentElement.scrollTop
// 								}
// 							});
// 							$('#dg').datagrid('reload');
// 							$('#dg').datagrid('clearSelections');
// 						} else {
// 							$.messager.show({
// 								title: '',
// 								msg: result.msg,
// 								timeout: 3000,
// 								showType: 'slide',
// 								icon: 'info',
// 								width: 252,
// 								height: 55,
// 								style: {
// 									left: 0,
// 									right: '',
// 									top: '',
// 									bottom: -document.body.scrollTop - document.documentElement.scrollTop
// 								}
// 							});
// 						}
// 					}, 'json')
// 				});
// 			}
// 		});
// }
function apv() {
    var ids = [];
    var names = [];
    var rows = $('#dg').datagrid('getSelections');

    console.log('Data', rows);
    if (rows.length > 0) {

        for (var i = 0; i < rows.length; i++) {
            ids.push(rows[i].popk);
            names.push(rows[i].pono);
        }

        var pesanKonfirmasi = 'Are you sure you want to approved this revision PO no. ' + names.join(', ') + '?';
        console.log('ids', ids);
        
        $.messager.confirm('Confirm', pesanKonfirmasi, function(r) {
            if (r) {
                // PERBAIKAN: Gabungkan array ID menjadi string dipisah koma (contoh: "121174,121173,121172")
                var stringIds = ids.join(',');

                $.post('action/simpan_apv.php?x=apv', {
                    id: stringIds 
                }, function(result) {
                    if (result.success) {
                        $.messager.show({
                            title: '',
                            msg: '<div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; border: 1px solid #c3e6cb; max-height: 300px; overflow-y: auto;">' + result.msg + '</div>', 
                            timeout: 5000, 
                            showType: 'fade',
                            width: 450,
                            height: 'auto',
                            style: {
                                left: 20,
                                right: '', 
                                top: '',
                                bottom: 20
                            }
                        });
                        $('#dg').datagrid('reload');
                        $('#dg').datagrid('clearSelections');
                    } else {
                        $.messager.show({
                            title: '',
                            msg: '<div style="background-color: #edd4d4; color: #960000; padding: 15px; border-radius: 4px; border: 1px solid #edd4d4;">' + result.msg + '</div>', 
                            timeout: 5000,
                            showType: 'fade',
                            width: 450,
                            height: 'auto',
                            style: {
                                left: 20,
                                right: '', 
                                top: '',
                                bottom: 20
                            }
                        });
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Warning', 'Please select at least one PO!', 'warning');
    }
}

	// function canapv() {
	// 	var ids = [];
	// 	var rows = $('#dg').datagrid('getSelections');

	// 	for (var i = 0; i < rows.length; i++) {
	// 		ids.push(rows[i].popk);
	// 	}
		
	// 	$.messager.confirm('Confirm', 'Are you sure you want to cancelled this revision PO ?',
	// 		function(r) {
	// 			if (r) {
	// 				$.each(ids, function(index, value) {
	// 					$.post('action/simpan_apv.php?x=canapv', {
	// 						id: value
	// 					}, function(result) {
	// 						if (result.success) {
	// 							$.messager.show({
	// 								title: '',
	// 								msg: result.msg,
	// 								timeout: 3000,
	// 								showType: 'slide',
	// 								icon: 'info',
	// 								width: 252,
	// 								height: 55,
	// 								style: {
	// 									left: 0,
	// 									right: '',
	// 									top: '',
	// 									bottom: -document.body.scrollTop - document.documentElement.scrollTop
	// 								}
	// 							});
	// 							$('#dg').datagrid('reload');
	// 							$('#dg').datagrid('clearSelections');
	// 						} else {
	// 							$.messager.show({
	// 								title: '',
	// 								msg: result.msg,
	// 								timeout: 3000,
	// 								showType: 'slide',
	// 								icon: 'info',
	// 								width: 252,
	// 								height: 55,
	// 								style: {
	// 									left: 0,
	// 									right: '',
	// 									top: '',
	// 									bottom: -document.body.scrollTop - document.documentElement.scrollTop
	// 								}
	// 							});
	// 						}
	// 					}, 'json')
	// 				});
	// 			}
	// 		});
	// }

// function canapv() {
// 	var ids = [];
//   var names = [];
// 	var rows = $('#dg').datagrid('getSelections');

// 	console.log('Data', rows);
// 	if (rows.length > 0) {

// 		for (var i = 0; i < rows.length; i++) {
// 				ids.push(rows[i].popk);
// 				names.push(rows[i].pono);
// 		}

// 		var pesanKonfirmasi = 'Are you sure you want to cancelled this revision PO no. ' + names.join(', ') + '?';
// 		console.log('ids', ids);
		
// 		$.messager.confirm('Confirm', pesanKonfirmasi, function(r) {
// 				if (r) {
// 					$.each(ids, function(index, value) {
// 						$.post('action/simpan_apv.php?x=canapv', {
//               id: value
//             }, function(result) {
// 							if (result.success) {
// 								$.messager.show({
// 									title: '',
// 										msg: '<div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; border: 1px solid #c3e6cb;">' + result.msg + '</div>', 
// 										timeout: 3000,
// 										// showType: 'slide',
// 										showType: 'fade',
// 										width: 430,
// 										height: 'auto',
// 										icon: 'info',
// 										border: false,
// 										style: {
// 												left: '',
// 												right: 20, 
// 												top: '',
// 												bottom: 20,
// 												backgroundColor: 'transparent', 
// 												border: 'none', 
// 												boxShadow: 'none'
// 										}
// 								});
// 								$('#dg').datagrid('reload');
// 								$('#dg').datagrid('clearSelections');
// 							} else {
// 								$.messager.show({
// 									msg: '<div style="background-color: #edd4d4; color: #960000; padding: 15px; border-radius: 4px; border: 1px solid #edd4d4;">' + result.msg + '</div>', 
// 										timeout: 3000,
// 										// showType: 'slide',
// 										showType: 'fade',
// 										width: 430,
// 										height: 'auto',
// 										icon: 'info',
// 										border: false,
// 										style: {
// 												left: '',
// 												right: 20, 
// 												top: '',
// 												bottom: 20,
// 												backgroundColor: 'transparent', 
// 												border: 'none', 
// 												boxShadow: 'none'
// 										}
// 								});
// 							}
// 						}, 'json')
// 					});
// 				}
// 			});
// 		} else {
// 			$.messager.alert('Warning', 'Please select at least one PO!', 'warning');
// 	}
// }
function canapv() {
    var ids = [];
    var names = [];
    var rows = $('#dg').datagrid('getSelections');

    console.log('Data', rows);
    if (rows.length > 0) {

        for (var i = 0; i < rows.length; i++) {
            ids.push(rows[i].popk);
            names.push(rows[i].pono);
        }

        var pesanKonfirmasi = 'Are you sure you want to cancelled this revision PO no. ' + names.join(', ') + '?';
        console.log('ids', ids);
        
        $.messager.confirm('Confirm', pesanKonfirmasi, function(r) {
            if (r) {
                // PERBAIKAN: Gabungkan array ID menjadi string dipisah koma (contoh: "121174,121173,121172")
                var stringIds = ids.join(',');

                // Kirim satu request saja ke server
                $.post('action/simpan_apv.php?x=canapv', {
                    id: stringIds 
                }, function(result) {
                    if (result.success) {
                        $.messager.show({
                            title: '',
                            msg: '<div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; border: 1px solid #c3e6cb; max-height: 300px; overflow-y: auto;">' + result.msg + '</div>', 
                            timeout: 5000, // dinaikkan ke 5 detik agar sempat membaca data banyak
                            showType: 'fade',
                            width: 450,
                            height: 'auto',
                            style: {
                                left: '',
                                right: 20, 
                                top: '',
                                bottom: 20
                            }
                        });
                        $('#dg').datagrid('reload');
                        $('#dg').datagrid('clearSelections');
                    } else {
                        $.messager.show({
                            title: '',
                            msg: '<div style="background-color: #edd4d4; color: #960000; padding: 15px; border-radius: 4px; border: 1px solid #edd4d4;">' + result.msg + '</div>', 
                            timeout: 5000,
                            showType: 'fade',
                            width: 450,
                            height: 'auto',
                            style: {
                                left: '',
                                right: 20, 
                                top: '',
                                bottom: 20
                            }
                        });
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Warning', 'Please select at least one PO!', 'warning');
    }
}

function savePI(){
    var selectedIds = $('#popk').val();
	var fileBaru = $('#uploadfile').filebox('getValue');
    var fileLama = $('#existing_file').val();

    // Jika dua-duanya kosong, cegah submit
    if (!fileBaru && (!fileLama || fileLama === "No file uploaded")) {
        $.messager.alert('Error', 'You must upload a file!', 'error');
        return;
    }

    $('#form-pi').form('submit',{
        url : "action/simpan.php?x=uploadpi",
        queryParams: {
            popk: selectedIds 
        },
        onSubmit: function(){
            var isValid = $(this).form('validate');
            if (!selectedIds) {
                $.messager.alert('Error', 'ID PO missing, please re-select.', 'error');
                return false;
            }
            return isValid;
        },
        success : function(data){
            console.log("Server Response:", data);
            if (data.includes("Success")) {
                $.messager.show({ 
				title: '',
				msg: '<div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; border: 1px solid #c3e6cb;">' + data + '</div>', 
				timeout: 3000,
				// showType: 'slide',
				showType: 'fade',
				width: 430,
				height: 'auto',
				border: false,
				style: {
						left: '',
						right: 20, 
						top: '',
						bottom: 20,
						backgroundColor: 'transparent', 
						border: 'none', 
						boxShadow: 'none'
						}
				});
                $('#dialog-form2').dialog('close');
                $('#dg').datagrid('reload');
                $('#dg').datagrid('clearSelections');
                $('#dg').datagrid('clearChecked');
            } else {
                $.messager.alert('Error', data, 'error');
            }
        }
    });
}

function cancelPI() {
	$('#form-pi').form('reset'); 
	$('#dialog-form2').dialog('close');
	$('#dg').datagrid('clearSelections');
	$('#dg').datagrid('clearChecked');
	$('#dg').datagrid('reload');
}

function insert(){
    var rows = $('#dg').datagrid('getChecked');
    console.log('Data', rows);
    if (rows.length > 0) {
        var ids = [];
        var names = [];
        
        var firstFile = rows[0].piform;
        var firstETD  = rows[0].etd;  
        var firstETA  = rows[0].etdal;
        var firstEIH  = rows[0].eihl;
				var firstPoli = rows[0].polipk; 

        for (var i = 0; i < rows.length; i++) {
            ids.push(rows[i].popk);
            names.push(rows[i].pono);
        }

        $('#dialog-form2').dialog('open').dialog('setTitle', 'Upload File PI Form');
        $('#form-pi').form('reset'); 

				if (firstPoli == 2) {
            $('#eta').datebox('disable');
            $('#eih').datebox('disable');
            console.log('ETA & EIH Disabled karena polipk === 2');
        } else {
            $('#eta').datebox('enable');
            $('#eih').datebox('enable');
        }

        $('#display-pono').text(names.join(', '));
				$('#display-piform').text(firstFile || "No file uploaded");
        $('#popk').val(ids.join(','));
				$('#existing_file').val(firstFile || "");

				function toDatebox(dateStr) {
            if (!dateStr) return '';
            var p = dateStr.split('-');
            if (p.length !== 3) return '';
            // Mengembalikan format MM/DD/YYYY agar diterima Datebox default
            return p[1] + '/' + p[2] + '/' + p[0];
        }

			if(firstETD) $('#etd').datebox('setValue', toDatebox(firstETD));
        if(firstETA) $('#eta').datebox('setValue', toDatebox(firstETA));
        if(firstEIH) $('#eih').datebox('setValue', toDatebox(firstEIH));
        
        console.log('PO List:', names.join(', '));
        console.log('Current File from first PO:', firstFile);
				console.log('Row data:', rows);

    } else {
        $.messager.alert('Warning', 'Please select at least one PO!', 'warning');
    }
}

// function insert(){
//     var rows = $('#dg').datagrid('getChecked');
    
//     if (rows.length > 0) {
//         var ids = [];
//         var names = [];
        
//         // Data dari baris pertama (index 0)
//         var firstFile = rows[0].piform || "No file uploaded";
//         var firstETD  = rows[0].etd2;   // Pastikan field ini sesuai dengan 'field' di datagrid
//         var firstETA  = rows[0].etdal2; // Pastikan field ini sesuai dengan 'field' di datagrid
//         var firstEIH  = rows[0].eihl2;  // Pastikan field ini sesuai dengan 'field' di datagrid

//         for (var i = 0; i < rows.length; i++) {
//             ids.push(rows[i].popk);
//             names.push(rows[i].pono);
//         }

//         $('#dialog-form2').dialog('open').dialog('setTitle', 'Upload File PI Form');
        
//         // 1. Reset form TERLEBIH DAHULU
//         $('#form-pi').form('reset'); 
        
//         // 2. Isi teks biasa
//         $('#display-pono').text(names.join(', '));
//         $('#display-piform').text(firstFile);
//         $('#popk').val(ids.join(','));
        
//         // 3. ISI DATEBOX (Gunakan setValue)
//         // Jika data dari database ada, masukkan ke datebox
//         if(firstETD) $('#etd').datebox('setValue', firstETD);
//         if(firstETA) $('#eta').datebox('setValue', firstETA);
//         if(firstEIH) $('#eih').datebox('setValue', firstEIH);

//     } else {
//         $.messager.alert('Warning', 'Please select at least one PO!', 'warning');
//     }
// }

/*count*/
function count_row() {
	$('#myHeader').show();
    var count = $('#dg').datagrid('getChecked').length;
    if (count) {
        document.getElementById("countp").innerHTML = count +" items selected";
    } else {
		document.getElementById("countp").innerHTML = 0 +" items selected";
	}
}

//DROPDOWN
function toggle(source) {
   checkboxes = document.getElementsByName('ck');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}

function cheka1(){               
			var c1 = document.getElementById("chek1");
				if (c1.checked) {
        $('#dg').datagrid('showColumn', 'funm');
			}else {
											$('#dg').datagrid('hideColumn', 'funm');
			}
				}
				
			 function cheka2(){               
			var c2 = document.getElementById("chek2");
				if (c2.checked) {
        $('#dg').datagrid('showColumn', 'status');
			}else {
											$('#dg').datagrid('hideColumn', 'status');
			}
				}
				
				function cheka3(){               
			var c3 = document.getElementById("chek3");
				if (c3.checked) {
        $('#dg').datagrid('showColumn', 'pono');
			}else {
											$('#dg').datagrid('hideColumn', 'pono');
			}
				}
				
				function cheka4(){               
			var c4 = document.getElementById("chek4");
				if (c4.checked) {
        $('#dg').datagrid('showColumn', 'tglpo2');
			}else {
											$('#dg').datagrid('hideColumn', 'tglpo2');
			}
				}
				
				function cheka5(){               
			var c5 = document.getElementById("chek5");
				if (c5.checked) {
        $('#dg').datagrid('showColumn', 'brg');
			}else {
											$('#dg').datagrid('hideColumn', 'brg');
			}
				}
				
				function cheka6(){               
			var c6 = document.getElementById("chek6");
				if (c6.checked) {
        $('#dg').datagrid('showColumn', 'supnm');
			}else {
											$('#dg').datagrid('hideColumn', 'supnm');
			}
				}
				
				function cheka7(){               
			var c7 = document.getElementById("chek7");
				if (c7.checked) {
        $('#dg').datagrid('showColumn', 'pocons');
			}else {
											$('#dg').datagrid('hideColumn', 'pocons');
			}
				}
				
				function cheka8(){               
			var c8 = document.getElementById("chek8");
				if (c8.checked) {
        $('#dg').datagrid('showColumn', 'unit');
			}else {
											$('#dg').datagrid('hideColumn', 'unit');
			}
				}
				
				function cheka9(){               
			var c9 = document.getElementById("chek9");
				if (c9.checked) {
        $('#dg').datagrid('showColumn', 'colname');
			}else {
											$('#dg').datagrid('hideColumn', 'colname');
			}
				}
    function cheka10(){               
			var c10 = document.getElementById("chek10");
				if (c10.checked) {
        $('#dg').datagrid('showColumn', 'price');
			}else {
											$('#dg').datagrid('hideColumn', 'price');
			}
				}
    function cheka11(){               
			var c11 = document.getElementById("chek11");
				if (c11.checked) {
        $('#dg').datagrid('showColumn', 'tgljam2');
			}else {
											$('#dg').datagrid('hideColumn', 'tgljam2');
			}
				}
     function cheka12(){               
			var c12 = document.getElementById("chek12");
				if (c12.checked) {
        $('#dg').datagrid('showColumn', 'tgldel2');
			}else {
											$('#dg').datagrid('hideColumn', 'tgldel2');
			}
				}
				 function cheka13(){               
			var c13 = document.getElementById("chek13");
				if (c13.checked) {
        $('#dg').datagrid('showColumn', 'etd2');
			}else {
											$('#dg').datagrid('hideColumn', 'etd2');
			}
				}
    
/*filter*/
function Search5(){
    $('#item').datagrid('load',{
    carispl: $('#carispl').val()
    });
	$('#supp2').datagrid('load',{
    carispl: $('#carispl').val()
    });
	$('#color2').datagrid('load',{
    carispl: $('#carispl').val()
    });
}

$(function(){
    $('#item').datagrid({
        onCheck: function(index,row,value){
								$('#tabel1').css("margin-top","50px");
				    var ckk=$('#item').datagrid('getRows')[index].brg;
				    document.getElementById("filtera"+index).value = ckk;
								document.getElementById("idxa"+index).value = index;
								document.getElementById("talla"+index).value = 1;
								$('#filtera'+index).show();
								$('#crossa'+index).show();
								$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
				tall();
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
    },
        onUncheck: function(index,row,value){
									var total = document.getElementById("total").value;
									if (total==1) {
									reset();
									} else{
									 document.getElementById("carispl").value = "";
										Search5();
        document.getElementById("filtera"+index).value ="";
								$('#filtera'+index).hide();
								$('#crossa'+index).hide();
								$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
				document.getElementById("talla"+index).value = 0;
				tall();
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
					}
			}
  });
});

function unceka(cross){
var total = document.getElementById("total").value;
if (total==1) {
					reset();
} else {
var c = cross;
//alert(c);
var ca=document.getElementById("idxa"+c).value;
$('#item').datagrid('unselectRow',ca);
document.getElementById("carispl").value = "";
Search5();
document.getElementById("filtera"+c).value ="";
document.getElementById("talla"+c).value = 0;
$('#filtera'+c).hide();
$('#crossa'+c).hide();
$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
document.getElementById("idxa"+c).value="";
}
}

$(function(){
    $('#supp2').datagrid({
        onCheck: function(index,row,value){
								$('#tabel1').css("margin-top","50px");
				    var ckk=$('#supp2').datagrid('getRows')[index].supnm;
				    document.getElementById("filterb"+index).value = ckk;
								$('#filterb'+index).show();
								$('#filterb'+index).show();
								$('#crossb'+index).show();
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
								document.getElementById("idxb"+index).value = index;
								document.getElementById("tallb"+index).value = 1;
								tall();
								$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
    },
        onUncheck: function(index,row,value){
									var total = document.getElementById("total").value;
									if (total==1) {
									reset();
									} else{
									 document.getElementById("carispl").value = "";
										Search5();
        document.getElementById("filterb"+index).value ="";
								$('#filterb'+index).hide();
								$('#crossb'+index).hide();
								$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
				document.getElementById("tallb"+index).value = 0;
				tall();
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
					}
			}
  });
});

function uncekb(cross){
var total = document.getElementById("total").value;
if (total==1) {
					reset();
} else {
var c = cross;
//alert(c);
var ca=document.getElementById("idxb"+c).value;
$('#supp2').datagrid('unselectRow',ca);
document.getElementById("carispl").value = "";
Search5();
document.getElementById("filterb"+c).value ="";
document.getElementById("tallb"+c).value = 0;
$('#filterb'+c).hide();
$('#crossb'+c).hide();
$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
document.getElementById("idxb"+c).value="";
}
}

$(function(){
    $('#color2').datagrid({
        onCheck: function(index,row,value){
								$('#tabel1').css("margin-top","50px");
				    var ckk=$('#color2').datagrid('getRows')[index].colname;
				    document.getElementById("filterc"+index).value = ckk;
								$('#filterc'+index).show();
								$('#filterc'+index).show();
								$('#crossc'+index).show();
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
								document.getElementById("idxc"+index).value = index;
								document.getElementById("tallc"+index).value = 1;
								tall();
								$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
    },
        onUncheck: function(index,row,value){
									var total = document.getElementById("total").value;
									if (total==1) {
									reset();
									} else{
									 document.getElementById("carispl").value = "";
										Search5();
        document.getElementById("filterc"+index).value ="";
								$('#filterc'+index).hide();
								$('#crossc'+index).hide();
								$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
				document.getElementById("tallc"+index).value = 0;
				tall();
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
					}
			}
  });
});

function uncekc(cross){
var total = document.getElementById("total").value;
if (total==1) {
					reset();
} else {
var c = cross;
//alert(c);
var ca=document.getElementById("idxc"+c).value;
$('#color2').datagrid('unselectRow',ca);
document.getElementById("carispl").value = "";
Search5();
document.getElementById("filterc"+c).value ="";
document.getElementById("tallc"+c).value = 0;
$('#filterc'+c).hide();
$('#crossc'+c).hide();
$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
document.getElementById("idxc"+c).value="";
}
}
/* end function search baru */

/*
function cekitem(){
$('#tabel1').css("margin-top","50px");
var ck = $('#item').datagrid('getChecked');
for(var i=0; i<=1; i++){
var row = $('#item').datagrid('getRows')[i];
//alert(ck2);
if ($.inArray(row,ck) >= 0){
    document.getElementById("filtera"+i).value = ck[i].brg;
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
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
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
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();	
}
}

function ceksupp(){
$('#tabel1').css("margin-top","50px");
var ck = $('#supp2').datagrid('getChecked');
for(var i=0; i<=1; i++){
var row = $('#supp2').datagrid('getRows')[i];
if ($.inArray(row,ck) >= 0){
    document.getElementById("filterb"+i).value = ck[i].supnm;
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
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
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
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();	
}
}

function cekcol(){
$('#tabel1').css("margin-top","50px");
var ck = $('#color2').datagrid('getChecked');
for(var i=0; i<=1; i++){
var row = $('#color2').datagrid('getRows')[i];
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
$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
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
var counta= JSON.stringify($('#dg').datagrid('getData').total);
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
$('#item').datagrid('unselectRow',c);

document.getElementById("filtera"+c).value ="";
$('#filtera'+c).hide();
$('#crossa'+c).hide();
document.getElementById("talla"+c).value = 0;

tall();
$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
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
if (total==1) {
reset();	
} else {
var c = cross;
$('#supp2').datagrid('unselectRow',c);

document.getElementById("filterb"+c).value ="";
$('#filterb'+c).hide();
$('#crossb'+c).hide();
document.getElementById("tallb"+c).value = 0;

tall();
$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
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
if (total==1) {
reset();
} else {
var c = cross;
$('#color2').datagrid('unselectRow',c);

document.getElementById("filterc"+c).value ="";
$('#filterc'+c).hide();
$('#crossc'+c).hide();
document.getElementById("tallc"+c).value = 0;

tall();
$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();
}
}*/

function totrec() {
var tcount= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = tcount+" result";
}

/*function myFunc(total, num) {
return total - num;
}*/

function tall(){
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
var tall = parseInt(cka0)+parseInt(cka1)+parseInt(ckb0)+parseInt(ckb1)+parseInt(ckc0)+parseInt(ckc1);
//alert(tall);
if(tall>=1){
document.getElementById('total').value = tall;
document.getElementById('fltr1').innerHTML = "Search filters("+tall+")";
}
else {
document.getElementById('total').value = tall;
document.getElementById('fltr1').innerHTML = "Search filters(0)";
}
}

function reset(){
//var total = document.getElementById("total").value;
document.getElementById("carispl").value = "";
Search5();
document.getElementById('total').value = 0;
$('#item').datagrid('clearSelections');
$('#supp2').datagrid('clearSelections');
$('#color2').datagrid('clearSelections');
$('#tabel1').css("margin-top","");
$(".dropdown2-content").slideUp("fast");
$('#fltr1').hide();
$('#fltr2').hide();
$('#fltr3').hide();
for(var i=0; i<=2; i++){
$('#filtera'+i).hide();
$('#crossa'+i).hide();
document.getElementById('filtera'+i).value = '';
document.getElementById('talla'+i).value = 0;

$('#filterb'+i).hide();
$('#crossb'+i).hide();
document.getElementById('filterb'+i).value = '';
document.getElementById('tallb'+i).value = 0;

$('#filterc'+i).hide();
$('#crossc'+i).hide();
document.getElementById('filterc'+i).value = '';
document.getElementById('tallc'+i).value = 0;

$('#dg').datagrid('load',{
item0: $('#filtera0').val(),
item1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
});
}
}

/*disheader*/
function testku() {
var dg = $('#item');
var dg2= $('#supp2');
var dg3= $('#color2');
dg.datagrid();
dg2.datagrid();
dg3.datagrid();
dg.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg2.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg3.datagrid('getPanel').find('div.datagrid-header').css('display','none');
$('#item').datagrid('getPanel').addClass('lines-no');
$('#supp2').datagrid('getPanel').addClass('lines-no');
$('#color2').datagrid('getPanel').addClass('lines-no');
$('#item').datagrid('getPanel').addClass('lines-no2');
$('#supp2').datagrid('getPanel').addClass('lines-no2');
$('#color2').datagrid('getPanel').addClass('lines-no2');
$('#item').datagrid('getPanel').addClass('col');
$('#supp2').datagrid('getPanel').addClass('col');
$('#color2').datagrid('getPanel').addClass('col');
}

$.extend($.fn.datagrid.methods, {
    lockColumn: function(jq, field){
        return jq.each(function(){
            var p = $('#kolom1').datagrid('getPanel');    // get the panel
            var cell = p.find('div.datagrid-header td[field=' + field + '] > div.datagrid-cell'); // get the cell
												cell.resizable({disabled:true}); // disable resize
        });
    }
});

function testku2() {
$('#kolom1').datagrid('getPanel').addClass('col');
$('#kolom1').datagrid('getPanel').addClass('lines-no');
$('#kolom1').datagrid('getPanel').addClass('lines-no2');
$('#kolom1').datagrid('lockColumn', 'kolomnm');
$('#kolom1').datagrid('lockColumn', 'ck');
//$('#kolom1').datagrid('getPanel').find('div.datagrid-header input[type=checkbox]').css('outline','2px solid deeppink');
}

function expand() {
const togglePassword2a = document.querySelector("#togglePassword2a");
const togglePassword2b = document.querySelector("#togglePassword2b");
const togglePassword2c = document.querySelector("#togglePassword2c");

     togglePassword2a.addEventListener("click", function () {
					test1 = $('#test1').val();
						test2 = $('#test2').val();
				if (test1=="" && test2=="") {
      $('.tabela').hide();
						document.getElementById('test1').value=1;
						$(".prodesa").css("margin-top","-10px");
						$(".tabelb").css("margin-top","-90px");
						$(".tabelc").css("margin-top","15px");
    } else if (test1==1 && test2==1) {
									$(".tabelb").css("margin-top","-45px");
       $(".tabelc").css("margin-top","20px");
							$('.tabela').show();
								$(".prodesa").css("margin-top","60px");
								document.getElementById('test1').value="";
    }else if (test1=="" && test2==1) {
							$('.tabela').hide();
							$(".prodesa").css("margin-top","-15px");
							$(".tabelb").css("margin-top","-70px");
							document.getElementById('test1').value=1;
							 $(".tabelc").css("margin-top","-45px");
    }else if (test1==1 && test2=="") {
							$('.tabela').show();
							$(".byr").css("margin-top","20px");
							$(".prodesa").css("margin-top","60px");
							$(".seasona").css("margin-top","55px");
							$(".tabelb").css("margin-top","-20px");
							document.getElementById('test1').value="";
							 $(".tabelc").css("margin-top","90px");
    }
				else {
					 $('.tabela').show();
						document.getElementById('test1').value="";
						$(".prodesa").css("margin-top","25px");
						$(".tabelb").css("margin-top","-40px");
						$(".tabelc").css("margin-top","55px");
				}
				this.classList.toggle("bi-eye2");
				});
					
					togglePassword2b.addEventListener("click", function () {
						test1 = $('#test1').val();
						test2 = $('#test2').val();
     if (test1=="" && test2=="") {
      $('.tabelb').hide();
						document.getElementById('test2').value=1;
						$(".seasona").css("margin-top","-10px");
						$(".tabelc").css("margin-top","25px");
    } else if (test1==1 && test2==1) {
       $(".tabelc").css("margin-top","30px");
							$('.tabelb').show();
								$(".seasona").css("margin-top","65px");
								document.getElementById('test2').value="";
    }else if (test1==1 && test2=="") {
     $(".tabelb").css("margin-top","-85px");
							$('.tabelb').hide();
							$(".seasona").css("margin-top","-15px");
							document.getElementById('test2').value=1;
							 $(".tabelc").css("margin-top","-55px");
    }else if (test1=="" && test2==1) {
     $(".prodesa").css("margin-top","60px");
     $(".tabelb").css("margin-top","-20px");
							$('.tabelb').show();
							$(".seasona").css("margin-top","55px");
							document.getElementById('test2').value="";
							 $(".tabelc").css("margin-top","95px");
    }
				else {
					 $('.tabelb').show();
						document.getElementById('test2').value="";
						$(".seasona").css("margin-top","30px");
						$(".tabelc").css("margin-top","55px");
				}
				this.classList.toggle("bi-eye2");
        });
									 togglePassword2c.addEventListener("click", function () {
            $('.tabelc').toggle();
            this.classList.toggle("bi-eye2");
        });
}

function tnew(){
var tcount= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("tpay").innerHTML = "("+tcount+")";
$('#tpay').show();
$('#tpay1').hide();
}

function revisi3(){
	//cari = $('#cari2').val();
    var ids = [];
    var rows = $('#dg').datagrid('getSelections');
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        var aaa = row.fupk;
    }
    for(var i=0; i<rows.length; i++){
    ids.push(rows[i].fupk);
       if (ids[i]!= aaa) {
         $.messager.alert('Warning','Handle must be same','warning');
         $('#dg').datagrid('clearChecked');
       } else {

       }
    }
}

// function revisi3b(){
// 	//cari = $('#cari2').val();
//     var ids = [];
//     var rows = $('#dg').datagrid('getSelections');
//     var row = $('#dg').datagrid('getSelected');
//     if (row) {
//         var aaa = row.supnm;
//     }
//     for(var i=0; i<rows.length; i++){
//     ids.push(rows[i].supnm);
//        if (ids[i]!= aaa) {
//          $.messager.alert('Warning','Supplier must be same','warning');
//          $('#dg').datagrid('clearChecked');
//        } else {

//        }
//     }
// }
function revisi3b(){
    var rows = $('#dg').datagrid('getSelections');
		console.log("DATA", rows);
    
    if (rows.length > 0) {
        var refSupplier = rows[0].supnm;
        var refPoli = rows[0].polipk;

        for (var i = 0; i < rows.length; i++) {
            if (rows[i].supnm !== refSupplier) {
                $.messager.alert('Warning', 'Supplier must be the same!', 'warning');
                $('#dg').datagrid('clearChecked');
                $('#dg').datagrid('clearSelections');
                return; 
            }
            
            if (rows[i].polipk !== refPoli) {
                $.messager.alert('Warning', 'PO List / Poli must be the same!', 'warning');
                $('#dg').datagrid('clearChecked');
                $('#dg').datagrid('clearSelections');
                return; 
            }
        }
        
    } else {
        // $.messager.alert('Warning', 'Please select at least one row!', 'warning');
    }
}


function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("cari6a");
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

$(function (){
 Search();
 srcitem();
 srcsupp();
 srccolor();
});

function srcitem(){
	var thn=$('#cari6').val();
	$('#item').datagrid('load', 'view/get_data2.php?dt=pur1&thn='+thn);
  }

  function srcsupp(){
	var thn=$('#cari6').val();
	$('#supp2').datagrid('load', 'view/get_data2.php?dt=pur2&thn='+thn);
  }

  function srccolor(){
	var thn=$('#cari6').val();
	$('#color2').datagrid('load', 'view/get_data2.php?dt=pur3&thn='+thn);
  }

function formatku2(val,row){
  if (row.tpo2>0) {
  return '<div style="margin-left:-10px;"><img src="css/images/notif2.png" width="3px" height="30px">'+
          '<div style="margin-top:-25px;margin-left:-10px;"><center>'+val+'</center></div>';
  } else {
    return val;
  }
}

</script>
<input type="hidden" name="test1" id="test1">
<input type="hidden" name="test2" id="test2">
<input type="hidden" name="total" id="total"  value="0" size="5">
<input type="hidden" name="pur" id="pur" value="<?php echo $_SESSION['login']; ?>" size="8">
<?php //$ord=$_GET['ord']; ?>

<div class="contenta">
<div id="frame-utama-cari" style="width:350px;">
<div id="container-cari">
<div id="frame-cari">
<img src="css/images/Shape.png" plain="true" width="18px" height="18px">
<input id="cari1" placeholder="Search..." class="input" onkeyup="Search();" value="<?php echo $_GET['cari1a']; ?>">
</div>
</div>
<!--<input style="width:140px; height:28px;" id="cari2" name="cari2" class="easyui-combobox"
data-options="valueField:'fupk',textField:'funm',url:'view/get_data.php?dt=fu&cari2a=<?php echo $_GET['cari2a']; ?>',prompt:'Handle',onChange:Search,limitToList:'true'">-->
<select class="easyui-combobox" id="cari2"
data-options="editable:true,prompt:'Handle',limitToList:'true',onChange:Search" style="width:140px;" >
<?php
$sqla=mysqli_query($koneksi,"select * FROM fu where aktif='0' and fupk='$_GET[cari2a]' order by funm asc");
$dta=mysqli_fetch_array($sqla)
?>
<option value="<?php echo $dta['fupk']; ?>"><?php echo $dta['funm']; ?></option>
<option value="">ALL HANDLE</option>
<?php
$sql=mysqli_query($koneksi,"select * FROM fu where aktif='0' order by funm asc");
while($dt=mysqli_fetch_array($sql)){
?>
<option value="<?php echo $dt['fupk']; ?>"><?php echo $dt['funm']; ?></option>
<?php } ?>
</select>
<!-- <select class="easyui-combobox" id="cari5"
data-options="editable:false,prompt:'Month',limitToList:'true',onChange:Search" style="width:150px;" >
<?php
// $bln=array(1=>"January","February","March","April","May",
// "June","July","August","September","October",
// "November","Desember");
// $bln1=date('m');
// if($bln1<=9){
// $bln2 = substr($bln1,1,1);
// }
?>
<option value="<?php //echo $_GET['cari5a']; ?>"><?php //echo $bln[$_GET['cari5a']]; ?></option>
<option value="">All Month</option>
<?php
//for($bulan=1; $bulan<=12; $bulan++){
?>
<option value="<?php //echo $bulan; ?>"><?php //echo $bln[$bulan]; ?></option>
<?php //} ?>
</select> -->
<?php //$thna=date('Y'); ?>
<!-- <select class="easyui-combobox" id="cari6"
data-options="editable:false, panelHeight:'auto',onChange:Search,prompt:'<?php //echo $thna; ?>'" style="width:100px;" >
<?php
//if($_GET['cari6a']<>$thna){ ?>
<option value="<?php //echo $_GET['cari6a']; ?>"><?php //echo $_GET['cari6a']; ?></option>
<?php //}
//for ($i=date('Y'); $i>=date('Y')-2 ; $i-=1){
?>
<option value="<?php //echo $i; ?>"><?php //echo $i; ?></option>
<?php //} ?>
</select> -->
<a href="javascript:void(0);" title="Reload table" class="easyui-tooltip" onclick="$('#dg').datagrid('reload');">
<img src="css/images/reload1.png" width="20px" height="20px">
</a>
</div>
<div id="frame-filter" style="margin-left:-5%;">
<div id="frame-filter-fields">    
<!-- <div class="fields"><a href="javascript:void(0)" onclick="myFunction1c(); testku2();" style="text-decoration:none; color: #AFAFAF;">Fields</a></div> -->
<!-- <div class="all"><a href="javascript:void(0)" onclick="myFunction1c(); testku2();" style="text-decoration:none; color: #000000;">All</a></div> -->
<div id="panah2">
<div class="dropdown1">
  <!-- <input onclick="myFunction1c(); testku2();" type="image" src="css/images/Polygon.png" class="dropbtn1" style="filter:brightness(0%);" alt="Submit button" width="10px" height="10px"> -->
  <!--<button onclick="myFunction()" class="dropbtn"></button>-->
  <div id="myDropdown2" class="dropdown1-content" name="dropdown1-content" style="height:500px;">
			<div class="content-search2">
				<div id="frame-cari2">
			 <img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button" >
    <input id="cari6a" placeholder="Search..." class="input" onkeyup="filterFunction();">
				</div>
				</div>
			<div style="margin-top:50px;margin-left:-5px;display: inline-block; text-align: left;">
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div><b>Select All</b></div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="all" value="all" id="chek0" onclick="toggle(this); cheka1(); cheka2(); cheka3(); cheka4(); cheka5(); cheka6(); cheka7(); cheka8(); cheka9(); cheka10(); cheka11(); cheka12(); cheka13();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>From</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"  name="ck" id="chek1" onclick="cheka1();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Status</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek2" onclick="cheka2();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>PO No</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek3" onclick="cheka3();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>PO Date</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek4" onclick="cheka4();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Item</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek5" onclick="cheka5();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Supplier</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"  name="ck" id="chek6" onclick="cheka6();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Qty</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek7" onclick="cheka7();" checked></div></a>
	     <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Unit</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek8" onclick="cheka8();" checked></div></a>			
			   <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Color</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek9" onclick="cheka9();" checked></div></a>
			   <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Price</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek10" onclick="cheka10();" checked></div></a>
		    <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Req Date</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek11" onclick="cheka11();" checked></div></a>
	     <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Req Del</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek12" onclick="cheka12();" checked></div></a>			
			   <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>ETD</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek13" onclick="cheka13();" checked></div></a>
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
<input onclick="myFunction()" type="image" class="imgsort" src="css/images/sort.jpg" alt="Submit button" class="dropbtn">
<div id="myDropdown" class="dropdwn-content" style="height:90px;">
<input type="hidden" id="cari3" value="1" name="cari3">
<div class="new-entry"><a href="javascript:void(0)" plain="true" onclick="Searcha();">Newest updated</a></div>
<input type="hidden" id="cari4" value="1" name="cari4">
<div class="old-entry"><a href="javascript:void(0)" plain="true" onclick="Searchb();">Oldest updated</a></div>
<!-- <input type="hidden" id="cari4b" value="1" name="cari4b">
<div class="old-entry"><a href="javascript:void(0)" plain="true" onclick="Searchc();">Recently modified</a></div> -->
</div>
</div>
<a href="javascript:void(0);" style="text-decoration:none; color: #000000;">
<div id="newest" class="newest" style="width:150px;left:100px;" onclick="myFunction();">Newest updated</div>
<div id="oldest" class="newest" onclick="myFunction();" style="display:none;width:150px;left:100px;">Oldest updated</div>
<!-- <div id="recently" class="newest" onclick="myFunction();" style="display:none;">Recently</div> -->
</a>
</div>
<div id="frame-filter2">
<div id="dropdown2">
<!-- <input onclick="myFunction1d(); testku();" type="image" class="imgfilter" src="css/images/filter.png" width="14px" height="12.83px" alt="Submit button">
<div class="filter"><a href="javascript:void(0);" style="text-decoration:none; color: #000000;" onclick="myFunction1d(); testku();">Filter</a></div> -->
<div id="myDropdown3" class=dropdown2-content style="width:220px;height:395px">
				<div class="content-search2">
				<div id="frame-cari2">
			 <img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button" >
    <input id="carispl" placeholder="Search..." class="input" onkeyup="Search5();">
				</div>
				</div>
							<div id="byr1a" class="byra" style="margin-top:50px;margin-left:15px;">
						Item
						<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img1">
						<i class="bi bi-eye-slash-fill" id="togglePassword2a" style="cursor: pointer;" onmouseover="expand();" onmouseout="expand();"></i>
						</div>
						</div>
				<div id="tabel" class="tabela" onmousemove="totrec();" style="width:200px;height:auto;border:0px solid;margin-top:-120px;margin-left:-20px;">
			 <table id="item" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center" idField="popk"
				url="view/get_data2.php?dt=pur1" toolbar="#tb" striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
				data-options="border:false,loadMsg:''">
			<thead>
			<tr>
			<th field="brg" width="160" sortable="false"></th>
			<th field="ck" checkbox="true" width="50"></th>
			</tr>
			</thead>
			</table>
			</div>
				
				<div id="byr1a" class="prodesa" style="margin-top:60px;margin-left:15px;">
						<hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
					Supplier
						<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img2">
						<i class="bi bi-eye-slash-fill" id="togglePassword2b" style="cursor: pointer;" onmouseover="expand();" onmouseout="expand();"></i></div>
						</div>   
								<div id="tabel" class="tabelb" onmousemove="totrec();" style="width:200px;height:auto;margin-top:-20px;margin-left:-20px;">
			 <table id="supp2" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center" idField="popk"
				url="view/get_data2.php?dt=pur2" toolbar="#tb" striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
				data-options="border:false,loadMsg:''">
			<thead>
			<tr>
			<th field="supnm" width="160" sortable="false"></th>
			<th field="ck" checkbox="true" width="50"></th>
			</tr>
			</thead>
			</table>
			</div>
								
								<div id="byr1a"  class="seasona" style="margin-top:55px;margin-left:15px;">
				<hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
				Color
									<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img3">
											<i class="bi bi-eye-slash-fill" id="togglePassword2c" style="cursor: pointer;" onmouseover="expand();" onmouseout="expand();"></i></div>
									</div>
								<div id="tabel" class="tabelc" onmousemove="totrec();" style="width:200px;height:auto;margin-top:90px;margin-left:-20px;">
			 <table id="color2" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center" idField="popk"
				url="view/get_data2.php?dt=pur3" toolbar="#tb" striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
				data-options="border:false,loadMsg:''">
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
<div id="frame-fltrchk" align="left" onmousemove="totrec();" style="width:95%;">
<div id="fltr1" style="margin-top:-35px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"></div>
<div id="fltr2" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"></div>
<div id="fltr3" style="width:100px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;display:none;" onclick="reset();">
<a href="javascript:void(0)" style="text-decoration:none; color: #359DD9;">Reset All</a></div>
<div style="margin-left:150px;margin-top:-20px;">
<!--<div style="width:20px; height:auto;" id="cross" class="cross" value="<?php //echo $i; ?>" onclick="uncek(<?php //echo $i; ?>);">
&nbsp;&#215;&nbsp;
</div>-->
<!--A-->
<?php for($i=0; $i<=1; $i++){ ?>
<input type="button" id="filtera<?php echo $i; ?>" class="filterchek" alt="Submit button" style="" readonly>
<input type="hidden" id="idxa<?php echo $i; ?>" size="5">
<a href="javascript:void(0)" id="crossa<?php echo $i; ?>" class="cross" onclick="unceka(<?php echo $i; ?>);">&nbsp;&#215;&nbsp;</a>
<input type="hidden" name="tall" id="talla<?php echo $i; ?>" value="0" size="5">
<?php } ?>
<!--B-->
<?php for($j=0; $j<=1; $j++){ ?>
<input type="button" id="filterb<?php echo $j; ?>" class="filterchek" alt="Submit button" style="" readonly>
<input type="hidden" id="idxb<?php echo $j; ?>" size="5">
<a href="javascript:void(0)" id="crossb<?php echo $j; ?>" class="cross" onclick="uncekb(<?php echo $j; ?>);">&nbsp;&#215;&nbsp;</a>
<input type="hidden" name="tall" id="tallb<?php echo $j; ?>" value="0" size="5">
<?php } ?>
<!--C-->
<?php for($k=0; $k<=1; $k++){ ?>
<input type="button" id="filterc<?php echo $k; ?>" class="filterchek" alt="Submit button" style="" readonly>
<input type="hidden" id="idxc<?php echo $k; ?>" size="5">
<a href="javascript:void(0)" id="crossc<?php echo $k; ?>" class="cross" onclick="uncekc(<?php echo $k; ?>);">&nbsp;&#215;&nbsp;</a>
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
<!-- <div id="tabel1" onclick="menu();" ondblclick="viewpo(); $('#myHeader').hide();" onmousemove="" style=""> -->
<div id="tabel1" onclick="menu();" style="">
<!-- <table id="dg" class="easyui-datagrid" title="" style="width:100%;height:460px;" align="center"
url="view/get_pay.php" idField="popk" toolbar="#tb" striped="true"
pagination="false" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" method="post"
data-options="multiSort:true,remoteSort:false"> -->
<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:460px;" align="center"
		url="view/get_rev.php" idField="popk" toolbar="#tb" striped="true" sortable="true"
		pagination="false" rownumbers="false" collapsible="true" fitColumns="false" method="post" multiple="true"
		data-options="onCheckAll:function(){menu();},onUncheckAll:function(){menu2();},ctrlSelect:true,checkOnSelect:true,multiSort:true,remoteSort:false">
<thead>
<tr>
	<th data-options="field:'ck',checkbox:true"></th>
<!--<th field="no" width="55" sortable="false" formatter="formatku2">No</th>-->
<th field="funm" width="80" sortable="true" formatter="formatku2">From</th>
<th field="byrnm" width="90" sortable="true">Buyer</th>
<th field="status" width="90" sortable="true">Status</th>
<th field="pono" width="90" sortable="true">PO no.</th>
<th field="tglpo2" width="80" sortable="true">PO Date</th>
<th field="brg" width="155" sortable="true">Item</th>
<th field="supnm" width="135" sortable="true">Supplier</th>
<th field="pocons" width="90" sortable="true">Total PO</th>
<th field="unit" width="80" sortable="true">Units</th>
<th field="colname" width="80" sortable="true">Color</th>
<th field="price" width="100" sortable="true">Total Price</th>
<th field="tgljam2" width="100" sortable="true">Req Date</th>
<th field="tgldel2" width="80" sortable="true">Req Del</th>
<th field="pidate2" width="80" sortable="true">PI date</th>
<th field="etd2" width="80" sortable="true">ETD</th>
<th field="etdal2" width="80" sortable="true">ETA</th>
<th field="eihl2" width="80" sortable="true">EIH</th>
</tr>
</thead>
</table>
<br>
</div>
</div>

<div class="header" id="myHeader" onclick=""  style="display:none;">
<div id="countp" style="margin-right:50%;"></div>
<!--<div id="countp" style="left:0px;font-color:#ffffff;"></div>-->
<!--<div class="delete"><a href="javascript:void(0)" plain="true" onclick="edit2();" style="color: #FFFFFF; text-decoration: none;"> Edit </a></div>-->
<!--<div class="detail"><a href="javascript:void(0)" plain="true" onclick="viewpo();" style="color: #FFFFFF; text-decoration: none;"> Update PO </a></div>
<div class="detail"><a href="javascript:void(0)" plain="true" onclick="revised();" style="color: #FFFFFF; text-decoration: none;"> Revised PO </a></div>-->
<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="apv();" style="color: #FFFFFF; text-decoration: none;"> Approve revised </a></div>
<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="canapv();" style="color: #FFFFFF; text-decoration: none;"> Cancel revised </a></div>
<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="viewpo();" oncontextmenu="viewpo2();" title="if right click automatically new tab" class="easyui-tooltip"  style="color: #FFFFFF; text-decoration: none;"> View PO </a></div>
<div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="$('#myHeader').hide(); $('#dg').datagrid('clearSelections');" style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
</div>

<div id="dialog-form" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,resizable:true,modal:true"
style="width:425px;height:335px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
<form id="form" method="post">
	<input type="hidden" name="user" id="userpk" size="8">
 	<input type="hidden" name="fu" id="fu" size="8">
    <!-- <div class="modal-dialog"> -->
        <div class="modal-content">
        	<!-- Modal Header -->
            <div class="modal-header">
            <div class="modal-title">Attach a memo?
												</div>
            </div>
            <!-- Modal body -->
            <div class="border-modal" style="border:none;">
            <div style="padding:5px;">
             <textarea placeholder="Beri memo untuk MD" name="memo" id="memo" class="easyui-validatebox" style="width:100%; height:100px;" required></textarea>
													</div>
             </div>
        <!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
        <a style="text-decoration:none; left: 129px; top: 228px;" href="javascript:void(0)" class="button-cancel" onclick="cancel();">Cancel</a>
        <a style="text-decoration:none; left: 206px; top: 228px;" href="javascript:void(0)" class="button-submit" onclick="save();">Submit</a>
								<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
        </div>
</form>
<!-- </div> -->
</div>


<!-- Upload PI Form -->
<div id="dialog-form2" class="easyui-dialog" title="Upload File PI Form" style="width:500px; height:auto; padding:0;" 
     data-options="
        closed:true,
        modal:true,
        closable:true,
        buttons:'#dialog-buttons-footer',
        border:'thin'
     ">
    
	<form id="form-pi" method="post" enctype="multipart/form-data" style="margin:0; padding:20px;">
			<!-- Hidden Input -->
			<input type="hidden" name="popk" id="popk" value="<?php echo $po; ?>">
			<input type="hidden" name="existing_file" id="existing_file">

			<div style="margin-bottom:20px; padding:10px; background:#ffffff; border-radius:4px; border:1px solid #ddd;">
					<div style="font-weight:bold; font-size:14px; margin-bottom: 5px;">PO Number:</div>
					<div id="display-pono" style="font-size:16px;color:#00529B;font-weight:bold;max-height: 80px;overflow-y: auto;word-wrap: break-word;padding: 5px;background: #ffffff;border-radius: 2px;">
							-
					</div>
			</div>

			<div style="margin-bottom:15px;">
					<label style="display:block; margin-bottom:5px; font-weight:bold;">Select PI File:</label>
					<input name="uploadfile" id="uploadfile" class="easyui-filebox" style="width:100%;" 
								data-options="
											buttonText:'Choose File',
											buttonAlign:'right',
											prompt:'Select a file...',
											required:false">
			</div>

			<!-- Row Input Dates (ETD, ETA, EIH) -->
			<div style="gap:10px; margin-bottom:15px;">
					<div style="flex:1;">
							<label style="display:block; margin-bottom:5px;margin-top:5px; font-weight:bold;">ETD:</label>
							<input name="etd" id="etd" class="easyui-datebox" style="width:100%;" data-options="editable:false">
					</div>
					<div style="flex:1;">
							<label style="display:block; margin-bottom:5px;margin-top:5px; font-weight:bold;">ETA:</label>
							<input name="etdal" id="eta" class="easyui-datebox" style="width:100%;" data-options="editable:false">
					</div>
					<div style="flex:1;">
							<label style="display:block; margin-bottom:5px;margin-top:5px; font-weight:bold;">EIH:</label>
							<input name="eihl" id="eih" class="easyui-datebox" style="width:100%;" data-options="editable:false">
					</div>
			</div>

			<div style="margin-bottom:15px; text-align:center; padding:10px; border:1px dashed #ccc; background: #fafafa;">
					<span style="color:#666; font-size: 11px;">Current File (from first selected PO):</span><br>
					<strong id="display-piform" style="color: #00529B;">-</strong>
			</div>

			<div style="background:#fff3f3; padding:8px; border-radius:4px;">
					<span style="color:red; font-size:12px; font-style:italic;">
							* PI file name cannot contain the (#) symbol
					</span>
			</div>
	</form>
</div>
<div id="dialog-buttons-footer" style="padding:10px; text-align:right;">
	<a href="javascript:void(0)" class="easyui-linkbutton c5" onclick="cancelPI();" style="width:90px">Cancel</a>
	<a href="javascript:void(0)" class="easyui-linkbutton c2" onclick="savePI();" style="width:90px">Submit</a>
</div>

<script>
window.onscroll = function(){ myFunctiona() };
var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunctiona(){
  if (window.pageYOffset > sticky){
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>