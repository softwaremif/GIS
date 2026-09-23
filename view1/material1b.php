<?php
include "email/req.php";
//include "email/test.php";
?>
<script type="text/javascript">
var url;

/*menu*/
function menu(){
	var row = $('#dg3a').datagrid('getSelected');
	if(row){
		$('#menu').show();
	} else {
	$('#menu').hide();
	$('#dg3a').datagrid('clearSelections');
	}
}

function menu2(){	
	var row = $('#dg3b').datagrid('getSelected');
	if(row){
		$('#menu').show();
		count_row();
	} else {
	$('#menu').hide();
	$('#dg3b').datagrid('clearSelections');
	}
}

function menu3(){
  $('#menu').hide();
}

/*edit*/
function edit3a(){
	var row = $('#dg3a').datagrid('getSelected');
	if(row){
		$('#dialog-form3a').dialog('open').dialog('setTitle','');
		$('#form3a').form('load',row);
		if(row.tspec==2){
			$('#hidden').show();
		} else {
			$('#hidden').hide();
		}
	} else {
		$.messager.alert('Warning','No material data selected','warning');
	}
}

/*request*/
function request3a(){
	/*ord = $('#ord3').val();
	window.location.href="?hal=detmat&dt=3&ord="+ord;*/
	var row = $('#dg3a').datagrid('getSelected');
	if(row){
		if(row.popk>0){
		$.messager.confirm('Confirm','Are you sure you want to finish revised this material PO ' +row.pono+ ' ? ',
		function(r){ 
			if (r){  
				$.ajax({
					type	: "POST",
					url	: "action/simpan.php?x=req4",
					data	: 'id='+row.rkbpk,
					success	: function(data){
						$.messager.show({
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
						});
						$('#dg3a').datagrid('reload');
					}
				});  
			}  
		});
		} else {
		$('#dialog-form4a').dialog('open').dialog('setTitle','');
		$('#form4a').form('load',row);
	}
	} else {
		$.messager.alert('Warning','No material data selected','warning');
	}
}

function request3b(){
var ids = [];
var rows = $('#dg3b').datagrid('getChecked');
	if(rows){
	//alert(i);
	//document.getElementById("rkb2").value = ids;
	for(var i=0; i<rows.length; i++){
	ids.push(rows[i].rkbpk);
	}
	$.each(ids, function (index, value){
	$.post('action/simpan.php?x=req2',{id:value},function(result){
if (result.success){
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
	$('#dg3b').datagrid('reload');
	$('#dialog-form3b').dialog('open').dialog('setTitle','');
	ord = $('#ord3').val();
	/*alert(ord);*/
	document.getElementById("ordpk3").value = +ord;
 } else {
	$.messager.show({
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
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});
	/*$('#dialog-formc').dialog('close');*/
 }
	},'json')
	});
 } else {
	$.messager.alert('Warning','No material data selected','warning');
	}
}

/*save*/
function save3a(){
		var string = $("#form3a").serialize();
		$('#form3a').form('submit',{
		type	: "POST",
		url	: "action/simpan.php?x=mat",
		data	: string,
		onSubmit: function(){
		return $(this).form('validate');
		},
		success	: function(data){
			$.messager.show({
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
			});
			$('#dialog-form3a').dialog('close');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg3a').datagrid('reload');
		}
	 });
}

function save3aa(){
	 rkbpk3a = $('#rkbpk3a').val();
	 popk3a = $('#popk3a').val();
		pono3a = $('#pono3a').val();
		var string = $("#form3a").serialize();
		$('#form3a').form('submit',{
		type	: "POST",
		url	: "action/simpan.php?x=mat",
		data	: string,
		onSubmit: function(){
		return $(this).form('validate');
		},
		success	: function(data){
			$.messager.show({
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
			});
			$('#dialog-form3a').dialog('close');
	 if(popk3a>0){
		$.messager.confirm('Confirm','Are you sure you want to finish revised this material PO ' +pono3a+ ' ? ',
		function(r){ 
			if (r){  
				$.ajax({
					type	: "POST",
					url	: "action/simpan.php?x=req4",
					data	: 'id='+rkbpk3a,
					success	: function(data){
						$.messager.show({
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
						});
						$('#dg3a').datagrid('reload');
					}
				});  
			}  
		});
		} else {
			$('#dialog-form3aa').dialog('open').dialog('setTitle','');
			/*alert(rkb);*/
			document.getElementById("rkb3").value = +rkbpk3a;
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg3a').datagrid('reload');
		}
		}
	 });
}

function save3bb(){
		var string = $("#form3aa").serialize();
		$('#form3aa').form('submit',{
		type	: "POST",
		url		: "action/simpan.php?x=req",
		data	: string,
		onSubmit: function(){
		return $(this).form('validate');
		},
		success	: function(data){
		/*ord = $('#ord3').val();
		window.location.href="?hal=detmat&dt=3&ord="+ord;*/
		$.messager.show({
			title:'',
			msg:data, 
			timeout:3000,
			showType:'slide',
			icon:'info',
			width:430,
			height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
		});
		$('#dialog-form3aa').dialog('close');
		/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
		$('#dg3a').datagrid('reload');
		}
	 });
}

function cancelreq3bb(){
		var string = $("#form3aa").serialize();
		$('#form3aa').form('submit',{
		type	: "POST",
		url		: "action/simpan.php?x=cancelreq1",
		data	: string,
		onSubmit: function(){
		return $(this).form('validate');
		},
		success	: function(data){
		$.messager.show({
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
		});
		$('#dialog-form3aa').dialog('close');
		/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
		$('#dg3a').datagrid('reload');
		}
	 });
}

function save4b(){
		var string = $("#form3aa").serialize();
		$('#form3aa').form('submit',{
		type	: "POST",
		url		: "action/simpan.php?x=req3",
		data	: string,
		onSubmit: function(){
		return $(this).form('validate');
		},
		success	: function(data){
		/*ord = $('#ord3').val();
		window.location.href="?hal=detmat&dt=3&ord="+ord;*/
		$.messager.show({
			title:'',
			msg:data, 
			timeout:3000,
			showType:'slide',
			icon:'info',
			width:430,
			height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
		});
		$('#dialog-form3aa').dialog('close');
		/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
		/*$('#dg3a').datagrid('reload');*/
		}
	 });
}

function cancelreq4b(){
		var string = $("#form3aa").serialize();
		$('#form3aa').form('submit',{
		type	: "POST",
		url		: "action/simpan.php?x=cancelreq2",
		data	: string,
		onSubmit: function(){
		return $(this).form('validate');
		},
		success	: function(data){
		$.messager.show({
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
		});
		$('#dialog-form3aa').dialog('close');
		/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
		$('#dg3a').datagrid('reload');
		}
	 });
}

function save4bb(){
		var string = $("#form4a").serialize();
		$('#form4a').form('submit',{
		type	: "POST",
		url		: "action/simpan.php?x=req3",
		data	: string,
		onSubmit: function(){
		return $(this).form('validate');
		},
		success	: function(data){
		$('#dialog-form4a').dialog('close');
		/*ord = $('#ord3').val();
		window.location.href="?hal=detmat&dt=3&ord="+ord;*/
		$.messager.show({
			title:'',
			msg:data, 
			timeout:3000,
			showType:'slide',
			icon:'info',
			width:430,
			height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
		});
		/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
		$('#dg3a').datagrid('reload');
		//window.location.href="?hal=detmat&ord=<?php echo $ord; ?>&dt=3";
		}
	 });
}

function cancelreq4bb(){
		var string = $("#form4a").serialize();
		$('#form4a').form('submit',{
		type	: "POST",
		url		: "action/simpan.php?x=cancelreq2",
		data	: string,
		onSubmit: function(){
		return $(this).form('validate');
		},
		success	: function(data){
		$.messager.show({
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
		});
		$('#dialog-form4a').dialog('close');
		/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
		$('#dg3a').datagrid('reload');
		}
	 });
}

function save3b(){
		var string = $("#form3b").serialize();
		$('#form3b').form('submit',{
		type	: "POST",
		url		: "action/simpan.php?x=req2b",
		data	: string,
		onSubmit: function(){
		return $(this).form('validate');
		},
		success	: function(data){
		$.messager.show({
			title:'',
			msg:data, 
			timeout:3000,
			showType:'slide',
			icon:'info',
			width:430,
			height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
		});
		$('#dialog-form3b').dialog('close');
		/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
		$('#dg3b').datagrid('reload');
		}
	 });
}

function cancelreq3b(){
		var string = $("#form3b").serialize();
		$('#form3b').form('submit',{
		type	: "POST",
		url		: "action/simpan.php?x=cancelreq",
		data	: string,
		onSubmit: function(){
		return $(this).form('validate');
		},
		success	: function(data){
		$.messager.show({
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
		});
		$('#dialog-form3b').dialog('close');
		/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
		$('#dg3b').datagrid('reload');
		}
	 });
}

/*delete*/
function delmat3a(){  
	var row = $('#dg3a').datagrid('getSelected');  
	if (row){  
		$.messager.confirm('Confirm','Are you sure you want to delete this material?',
		function(r){ 
			if (r){  
				$.ajax({
					type	: "POST",
					url		: "action/delete.php?x=mat3",
					data	: 'id='+row.rkbpk,
					success	: function(data){
						$.messager.show({
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
						});
						$('#dg3a').datagrid('reload');
					}
				});  
			}  
		});  
	}  else {
		$.messager.alert('Warning','No material  data selected','warning');
	}
}

function delmat3b(){  
//if (rows){  
//$.messager.confirm('Confirm','Are you sure you want to delete this material?',
//function(r){
//if (r){
var ids = [];
var rows = $('#dg3b').datagrid('getSelections');
for(var i=0; i<rows.length; i++){
ids.push(rows[i].rkbpk);
//alert(ids);
}
$.messager.confirm('Confirm','Are you sure you want to delete this material?',
function(r){
if (r){
//alert(ids);
// We loop through each project and then delete it
$.each(ids, function (index, value){
//alert(i);
$.post('action/delete.php?x=mat',{id:value},function(result){
if (result.success){
							$.messager.show({
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
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
						});
						$('#dg3b').datagrid('reload'); 
} else {
							$.messager.show({
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
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
						});
}
},'json')
});
}//reload the user data
});
//} else {
//		$.messager.alert('Warning','No material  data selected','warning');
//}
}

/*print*/
function print3a(){
	var row = $('#dg3a').datagrid('getSelected');
	if(row){
		cari6 = $('#cari6b').val();
		url = "pdf/pdf_mat.php?dt=<?php echo $_GET['dt']; ?>&ord="+row.ordpk+"&rkb="+row.rkbpk;
		window.open(url);
		/*window.location.href="pdf/pdf_rkb.php&cari=breakdown&ord=" +row.ordpk;*/
	} else {
		$.messager.alert('Warning','No material data selected','warning');
	}
}

function print3b(){
	var row = $('#dg3b').datagrid('getSelected');
	if(row){
		cari6 = $('#cari6b').val();
		url = "pdf/pdf_mat.php?ord="+row.ordpk+"&rkb="+row.rkbpk;
		window.open(url);
		/*window.location.href="pdf/pdf_rkb.php&cari=breakdown&ord=" +row.ordpk;*/
	} else {
		$.messager.alert('Warning','No material data selected','warning');
	}
}

/* RUmus Onkeyup */	
function myFunction3a(){
  var x = document.getElementById("bdownqty3a").value;
		var y = document.getElementById("allowcons3a").value;
		var a = document.getElementById("qrs3a").value;
		var b = document.getElementById("estcons3a").value;
		var c = document.getElementById("allowman3a").value;
		var d = document.getElementById("negocons3a").value;
  /*var y2 = 0;*/
		if (x == ''){ var x2= 0; }
		else { var x2= x;}
		
		if (a == ''){ var a2 = 0;}
  else {a2 = a;}

		if (y == ''){ var y2= 0;}
		else { var y2= y;}
		
		if (c == ''){ var c2= 0;}
		else { var c2= c;}
		
		if (d == ''){ var d2= 0; }
		else { var d2= d;}
		
		var e= x * b;
		document.getElementById("totcons3a").value = e;
		
		var f= d - b;
		document.getElementById("varcons3a").value = f;
		
		var z= parseFloat(e) + (parseFloat(e) * parseFloat(y2) / 100) + parseFloat(a2) + parseFloat(c2);
  document.getElementById("pocons3a").value = z;
		document.getElementById("pocons3b").value = Math.ceil(z);
		}

function myformatter3a(date){
var y = date.getFullYear();
var m = date.getMonth()+1;
var d = date.getDate();
return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}
function myparser3a(s){
if (!s) return new Date();
var ss = (s.split('-'));
var y = parseInt(ss[0],10);
var m = parseInt(ss[1],10);
var d = parseInt(ss[2],10);
if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
return new Date(y,m-1,d);
} else {
return new Date();
}
}

function myformatter3b(date){
var y = date.getFullYear();
var m = date.getMonth()+1;
var d = date.getDate();
return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}

function myparser3b(s){
if (!s) return new Date();
var ss = (s.split('-'));
var y = parseInt(ss[0],10);
var m = parseInt(ss[1],10);
var d = parseInt(ss[2],10);
if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
return new Date(y,m-1,d);
} else {
return new Date();
}
}

/* LOOKUP color */
function lookup_col3(){
	$('#dialog-form3e').dialog('open').dialog('setTitle','');
	$('#form3e').form('clear');
}

function get_lookup3(){   
var row = $('#dg3e').datagrid('getSelected');
 if (row){
	document.getElementById("colname3a").value = row.colname;
	document.getElementById("colcode3a").value = row.colcode;
	$('#dialog-form3e').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);
    }
}

/* LOOKUP Material */
function lookup_mb3(){
	$('#dialog-form3f').dialog('open').dialog('setTitle','');
	$('#form3f').form('clear');
}

function get_mb3(){   
var row = $('#dg3f').datagrid('getSelected');
 if (row){
	document.getElementById("spec3a").value = row.spec;
	$('#dialog-form3f').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);
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
var qty2=document.getElementById("bdownqty1").value;
var sz1=document.getElementById("sz1").value;
var col1=document.getElementById("col1").value;
var bdwpk0=document.getElementById("bdwpk").value;
var klm0=document.getElementById("klm").value;
document.getElementById("sizegar3a").value = sz1;
document.getElementById("bdownqty3a").value = qty2.replace(',','');
document.getElementById("colname3a").value = col1;
document.getElementById("bdownpk3a").value = bdwpk0;
document.getElementById("kolom3a").value = klm0;
$('#dialog-form3g').dialog('close');
}

$(function() {
$('#dg3g').datagrid({
  onClickCell: function(index,field,value){
    //var row = $('#dg4g').edatagrid('getSelected');
    if (field == 's1'){
					//alert(value);
					/*lookup size*/
				//var v1=$('#dg3g').datagrid('getRows')[0].s1;
				//document.getElementById('sz1').value=v1;
				document.getElementById('col1').value='';
				/*lookup qty*/
				var b1 = document.getElementById('s1a'+index).value;
    document.getElementById('bdownqty1').value=b1;
				/*bdownpk & kolom */
				document.getElementById('klm').value=field;
				var bdwpk1=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk1;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s1&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk1,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				/*warna kuning*/
				$('#s1a'+index).css('background-color','yellow');
    } else if(field == 's2'){
					//var v2=$('#dg3g').datagrid('getRows')[0].s2;
				//document.getElementById('sz1').value=v2;
				document.getElementById('col1').value='';
				var b2 = document.getElementById('s2a'+index).value; 
    document.getElementById('bdownqty1').value=b2;
				document.getElementById('klm').value=field;
				var bdwpk2=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk2;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s2&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk2,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s2a'+index).css('background-color','yellow');
				}else if(field == 's3'){
					//var v3=$('#dg3g').datagrid('getRows')[0].s3;
				//document.getElementById('sz1').value=v3;
				document.getElementById('col1').value='';
					var b3 = document.getElementById('s3a'+index).value; 
    document.getElementById('bdownqty1').value=b3;
				document.getElementById('klm').value=field;
				var bdwpk3=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk3;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s3&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk3,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s3a'+index).css('background-color','yellow');
				}else if(field == 's4'){
					//var v4=$('#dg3g').datagrid('getRows')[0].s4;
				//document.getElementById('sz1').value=v4;
				document.getElementById('col1').value='';
					var b4 = document.getElementById('s4a'+index).value; 
    document.getElementById('bdownqty1').value=b4;
				document.getElementById('klm').value=field;
				var bdwpk4=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk4;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s4&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk4,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s4a'+index).css('background-color','yellow');
				}else if(field == 's5'){
					//var v5=$('#dg3g').datagrid('getRows')[0].s5;
				//document.getElementById('sz1').value=v5;
				document.getElementById('col1').value='';
					var b5 = document.getElementById('s5a'+index).value; 
    document.getElementById('bdownqty1').value=b5;
				document.getElementById('klm').value=field;
				var bdwpk5=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk5;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s5&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk5,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s5a'+index).css('background-color','yellow');
				}else if(field == 's6'){
					//var v6=$('#dg3g').datagrid('getRows')[0].s6;
				//document.getElementById('sz1').value=v6;
				document.getElementById('col1').value='';
					var b6 = document.getElementById('s6a'+index).value; 
    document.getElementById('bdownqty1').value=b6;
				document.getElementById('klm').value=field;
				var bdwpk6=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk6;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s6&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk6,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s6a'+index).css('background-color','yellow');
				}else if(field == 's7'){
					//var v7=$('#dg3g').datagrid('getRows')[0].s7;
				//document.getElementById('sz1').value=v7;
				document.getElementById('col1').value='';
					var b7 = document.getElementById('s7a'+index).value; 
    document.getElementById('bdownqty1').value=b7;
				document.getElementById('klm').value=field;
				var bdwpk7=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk7;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s7&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk7,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s7a'+index).css('background-color','yellow');
				}else if(field == 's8'){
					//var v8=$('#dg3g').datagrid('getRows')[0].s8;
				//document.getElementById('sz1').value=v8;
				document.getElementById('col1').value='';
					var b8 = document.getElementById('s8a'+index).value; 
    document.getElementById('bdownqty1').value=b8;
				document.getElementById('klm').value=field;
				var bdwpk8=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk8;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s8&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk8,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s8a'+index).css('background-color','yellow');
				}else if(field == 's9'){
					//var v9=$('#dg3g').datagrid('getRows')[0].s9;
				//document.getElementById('sz1').value=v9;
				document.getElementById('col1').value='';
					var b9 = document.getElementById('s9a'+index).value; 
    document.getElementById('bdownqty1').value=b9;
				document.getElementById('klm').value=field;
				var bdwpk9=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk9;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s9&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk9,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s9a'+index).css('background-color','yellow');
				}else if(field == 's10'){
					//var v10=$('#dg3g').datagrid('getRows')[0].s10;
				//document.getElementById('sz1').value=v10;
				document.getElementById('col1').value='';
					var b10 = document.getElementById('s10a'+index).value; 
    document.getElementById('bdownqty1').value=b10;
				document.getElementById('klm').value=field;
				var bdwpk10=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk10;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s10&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk10,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s10a'+index).css('background-color','yellow');
				}else if(field == 's11'){
					//var v11=$('#dg3g').datagrid('getRows')[0].s11;
				//document.getElementById('sz1').value=v11;
				document.getElementById('col1').value='';
					var b11 = document.getElementById('s11a'+index).value; 
    document.getElementById('bdownqty1').value=b11;
				document.getElementById('klm').value=field;
				var bdwpk11=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk11;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s11&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk11,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s11a'+index).css('background-color','yellow');
				}else if(field == 's12'){
					//var v12=$('#dg3g').datagrid('getRows')[0].s12;
				//document.getElementById('sz1').value=v12;
				document.getElementById('col1').value='';
					var b12 = document.getElementById('s12a'+index).value; 
    document.getElementById('bdownqty1').value=b12;
				document.getElementById('klm').value=field;
				var bdwpk12=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk12;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s12&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk12,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s12a'+index).css('background-color','yellow');
				}else if(field == 's13'){
					//var v13=$('#dg3g').datagrid('getRows')[0].s13;
				//document.getElementById('sz1').value=v13;
				document.getElementById('col1').value='';
					var b13 = document.getElementById('s13a'+index).value; 
    document.getElementById('bdownqty1').value=b13;
				document.getElementById('klm').value=field;
				var bdwpk13=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk13;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s13&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk13,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s13a'+index).css('background-color','yellow');
				}else if(field == 's14'){
					//var v14=$('#dg3g').datagrid('getRows')[0].s14;
				//document.getElementById('sz1').value=v14;
				document.getElementById('col1').value='';
					var b14 = document.getElementById('s14a'+index).value; 
    document.getElementById('bdownqty1').value=b14;
				document.getElementById('klm').value=field;
				var bdwpk14=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk14;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s14&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk14,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s14a'+index).css('background-color','yellow');
				}else if(field == 's15'){
					//var v15=$('#dg3g').datagrid('getRows')[0].s15;
				//document.getElementById('sz1').value=v15;
				document.getElementById('col1').value='';
					var b15 = document.getElementById('s15a'+index).value; 
    document.getElementById('bdownqty1').value=b15;
				document.getElementById('klm').value=field;
				var bdwpk15=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpk15;
					$.ajax({
		   type:"POST",
		   url:"view/get_data.php?dt=bdown2&size=s15&ord=<?php echo $ord; ?>",
		   data:"bdwpk="+bdwpk15,
			  success:function(data){
					document.getElementById('sz1').value=data;
			   },
		   });
				$('#s15a'+index).css('background-color','yellow');
				}else if(field == 'tot'){
					var t4=$('#dg3g').datagrid('getRows')[index].color;
				document.getElementById('col1').value=t4;
				document.getElementById('sz1').value='';
					var totb = document.getElementById('tota'+index).value; 
    document.getElementById('bdownqty1').value=totb;
				document.getElementById('klm').value=field;
				var bdwpkt=$('#dg3g').datagrid('getRows')[index].bdownpk;
				document.getElementById('bdwpk').value=bdwpkt;
				$('#tota'+index).css('background-color','yellow');
				}else {
      alert('No Selected Value...!!');
						document.getElementById("bdownqty1").value='';
						document.getElementById("sz1").value='';
					document.getElementById("col1").value='';
					document.getElementById("bdwpk").value='';
					document.getElementById("klm").value='';
    }
  }
});
});

function test(){
	 var q = $('#dg3g').datagrid('getSelected').br;
		for (r=0;r<=q-1;r++) {
   $('#s1a'+r).css('background-color','');
			$('#s2a'+r).css('background-color','');
			$('#s3a'+r).css('background-color','');
			$('#s4a'+r).css('background-color','');
			$('#s5a'+r).css('background-color','');
			$('#s6a'+r).css('background-color','');
			$('#s7a'+r).css('background-color','');
			$('#s8a'+r).css('background-color','');
			$('#s9a'+r).css('background-color','');
			$('#s10a'+r).css('background-color','');
			$('#s11a'+r).css('background-color','');
			$('#s12a'+r).css('background-color','');
			$('#s13a'+r).css('background-color','');
			$('#s14a'+r).css('background-color','');
			$('#s15a'+r).css('background-color','');
			$('#tota'+r).css('background-color','');
  }
}

/*search*/
function Search3a(){
$('#dg3e').datagrid('load',{
cari7: $('#cari7b').val()
});
}

function Search3b(){
$('#dg3f').datagrid('load',{
cari8: $('#cari8b').val()
});
}

//DROPDOWN
function myFunction(){
document.getElementById("myDropdown").classList.toggle("show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event){
  if (!event.target.matches('')){
var dropdowns = document.getElementsByClassName("dropdwn-content1");
var i;
for (i = 0; i < dropdowns.length; i++){
  var openDropdown = dropdowns[i];
  if (openDropdown.classList.contains('show')){
openDropdown.classList.remove('show');
  }
}
  }
}

function tnew() {
var tcount= JSON.stringify($('#dg3a').datagrid('getData').total);
document.getElementById("tprogress").innerHTML = tcount; 
}
</script>
<input type="hidden" name="ord3" id="ord3" value="<?php echo $ord; ?>" size="8">
<!--needrevision-->
<div id="menu" onclick="$('#menu').hide(); $('#dg3a').datagrid('clearSelections');"  style="display:none;">
<div class="detail" style="width:50px;"><a href="javascript:void(0)" plain="true" onclick="edit3a();" style="color: #FFFFFF; text-decoration: none;"> Edit </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="print3a();" style="color: #FFFFFF; text-decoration: none;"> Print </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="delmat3a();" style="color: #FFFFFF; text-decoration: none;"> Delete </a></div>
</div>

<div id="tabel" onclick="menu();" ondblclick="edit3a(); $('#menu').hide(); $('#dg3a').datagrid('clearSelections');" onmousemove="tnew();" style="">
<table id="dg3a" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_material2.php?ord=<?php echo $ord; ?>&cek=1" idField="rkbpk" toolbar="#tb2" striped="true"
pagination="true" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false"
data-options="multiSort:true">
<!--data-options="rowStyler: function(index,row){
              if (row.kelnm == 'CUTTING'){
              return 'background-color:#0B89D2;color:#FFFFFF;';
              }
			  else if (row.kelnm == 'SEWING'){
              return 'background-color:#19B715;color:#FFFFFF;';
              }
			  else {
              return 'background-color:#FF6B00;color:#FFFFFF;';
              }
              }"-->
<thead>
<tr>
<th field="no" width="55" sortable="false">No</th>
<th field="item" width="120" sortable="true">Item</th>
<th field="supnm" width="223" sortable="true">Supplier</th>
<th field="status" width="100" sortable="false">Status</th>
<th field="spec" width="275" sortable="true">Specification</th>
<th field="sizegar" width=100" sortable="true">Size</th>
<th field="qty" width=100" sortable="true">Qty</th>
<th field="unit" width="100" sortable="true">Units</th>
<th field="colname" width="100" sortable="true">Color</th>
<th field="price" width="100" sortable="true">Price</th>
</tr>
</thead>
</table>
</div>

<div id="dialog-form3a" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,closable:false,reziable:false,modal:true"
style="width:1200px;height:575px;padding:5px 5px;display:none;top:15px">
<form id="form3a" method="post">
<input type="hidden" name="ordpk" id="ordpk">
<input type="hidden" name="rkbpk" id="rkbpk3a">
<input type="hidden" name="bdownpk" id="bdownpk3a">
<input type="hidden" name="kolom" id="kolom3a">
<input type="hidden" name="nour" id="nour">
<input type="hidden" name="popk" id="popk3a">
<input type="hidden" name="pono" id="pono3a">
<!--<input type="hidden" name="tspec" id="tspec" >-->
    <div class="modal-dialog" style="width:98%; height:96%; overflow-y:scroll;overflow-x:hidden;">
        <div class="modal-content">
<div id="viewmemo" style="margin-top:10px; margin-left:25px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
Add Material
<a href="javascript:void(0)" onclick="myFunction2();" style="font-size:14px; color:#359DD9; text-decoration:none;">View purchasing memo</a>
</div>
<div style="margin-top:-30px; margin-left:1125px;">
<a href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:28px;"
onclick="$('#dialog-form3a').dialog('close'); $('#form3a').form('clear');"> X</a>
</div>
<div class="fitem">
<label>Group</label></br>
<input name="kelnm" id="kelnm" class="easyui-combobox" required="true"
style="width: 162px; height:34px;font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
data-options="prompt:'Choose group...',panelHeight:'auto',
data: [
{value:'CUTTING',text:'CUTTING'},
{value:'SEWING',text:'SEWING'},
{value:'FINISHING/PACKING',text:'FINISHING/PACKING'}
]">
</div>
<div class="fitem">
<label >Item</label></br>
<input name="item" id="item" class="easyui-validatebox" style="width: 244px; height:34px;" placeholder="Input item name...">
</div>

<!-- memo -->
<div id="dropdwn">
<div id="myDropdown2b" class="dropdwn-content2" style="left:155px; top:35px; width:413px;">
<input name="memonm" id="memonm" class="easyui-validatebox" style="font-size:14px; border:none; width:100%; height:auto;" readonly>
<input name="tgl2" id="tgl2" class="easyui-validatebox" style="font-size:14px; color:#AFAFAF; border:none; width:100%; height:auto;" readonly>
</div>
</div>

<div class="fitem">
<label>Item Remarks</label></br>
<textarea name="itemadd" id="itemadd" class="easyui-validatebox" style="width:1125px; height: 55px;"></textarea>
</div>
<div class="fitem">
<label>Supplier</label><br>
<input name="suppk" id="suppk" required="true" style="width: 162px; height:34px;font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;" class="easyui-combobox"
data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=sup',prompt:'Supplier',limitToList:'true'">
</div>
<label style="margin-left: 24px;">Specification <a href="javascript:void(0)" onclick="lookup_mb3();" style="color:#359DD9; text-decoration:none;">Search for material</a></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label><a href="http://192.168.0.11/RKB/data/admin.php?hal=sisa" target="_blank" style="color:#359DD9; text-decoration:none;">Check Stock</a></label>
<div class="fitem">
<input type="radio" name="tspec" id="tspec" value="1" onclick="$('#hidden').hide()">
<label>Single Column</label>
<input type="radio" name="tspec" id="tspec" value="2" onclick="$('#hidden').show()">
<label>Multi Column</label>
</div>
<div class="fitem">
<textarea name="spec" id="spec3a" class="easyui-validatebox" multiline="true" style="width:1125px; height: 55px;"></textarea>
</div>
<div id="hidden">
<div class="fitem">
<input name="hspec1" id="hspec1" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
<input name="hspec2" id="hspec2" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
<input name="hspec3" id="hspec3" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
<input name="hspec4" id="hspec4" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
<input name="hspec5" id="hspec5" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
<input name="hspec6" id="hspec6" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
<input name="hspec7" id="hspec7" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
<input name="hspec8" id="hspec8" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
</div>
<div class="fitem">
<input name="spec1" id="spec1" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
<input name="spec2" id="spec2" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
<input name="spec3" id="spec3" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
<input name="spec4" id="spec4" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
<input name="spec5" id="spec5" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
<input name="spec6" id="spec6" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
<input name="spec7" id="spec7" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
<input name="spec8" id="spec8" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
</div>
</div>
<div class="fitem">
<label>Spec Remarks</label></br>
<textarea name="specadd" id="specadd" class="easyui-validatebox" style="width:1125px; height: 55px;"></textarea>
</div>
<div class="fitem">
<label>Color Name</label>&emsp;&emsp;&emsp;&emsp;
<label>Color Code</label>
</div>
<div class="fitem">
<input name="colname" id="colname3a" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input color...">&nbsp;
<input name="colcode" id="colcode3a" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input code...">
<a href="javascript:void(0)" onclick="lookup_col3();" style="color:#359DD9; text-decoration:none;">Lookup</a>
</div>
<div class="fitem">
<label>Size</label></br>
<input name="sizegar" id="sizegar3a" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input size...">
<a href="javascript:void(0)" onclick="lookup_bdown3();" style="color:#359DD9; text-decoration:none;">Lookup</a>
</div>
<div class="">
<label style="margin-left: 24px;font-size: 15px;">Unit</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;
<label style="font-size: 15px;">Unit price actual</label>&nbsp;&nbsp;
<label style="font-size: 15px;">Currency</label>
</div>
<div class="fitem">
<input name="unit" id="unit" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input Unit...">&nbsp;
<input name="price2" id="price2" class="easyui-validatebox" style="width: 103px; height:34px;" placeholder="0">&nbsp;
<input name="curpk" id="curpk" style="width: 88px; height:34px;font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;" class="easyui-combobox"
data-options="valueField:'curpk',textField:'curid',url:'view/get_data.php?dt=cur',prompt:'USD',limitToList:'true'">
</div>
<div class="fitem">
<label>Bdown Qty.</label></br>
<input name="bdownqty" id="bdownqty3a" required="true" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" onkeyup="myFunction3a();">
<a href="javascript:void(0)" onclick="lookup_bdown3();" style="color:#359DD9; text-decoration:none;">Lookup</a>
</div>
<div>
<label style="margin-left: 24px;font-size: 15px;">Allowance%</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
<label style="font-size: 15px;">Allowman</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
<label style="font-size: 15px;">Costing Cons.</label>&emsp;&emsp;&emsp;&emsp;
<label style="font-size: 15px;">Purcashing Cons.</label>&emsp;&emsp;
<label style="font-size: 15px;">Variance Cons.</label>
</div>
<div class="fitem">
<input name="allowcons" id="allowcons3a" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" onkeyup="myFunction3a();">&nbsp;
<input name="allowman" id="allowman3a" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" onkeyup="myFunction3a();">&nbsp;
<input name="negocons" id="negocons3a" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" onkeyup="myFunction3a();">&nbsp;
<input name="estcons" id="estcons3a" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" onkeyup="myFunction3a();">
<input name="varcons" id="varcons3a" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
</div>
<div class="fitem">
<label>Netto</label></br>
<input name="totcons" id="totcons3a" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
</div>
<div class="fitem">
<label>QRS</label></br>
<input name="qrs" id="qrs3a" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" onkeyup="myFunction3a();">
</div>
<div class="fitem">
<label>Total PO</label></br>
<input name="pocons" id="pocons3a" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
<input name="pocons2" id="pocons3b" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
</div>
<a style="text-decoration:none; left:700px; margin-top:-37px;" href="javascript:void(0)" class="button-cancel" onclick="$('#dialog-form3a').dialog('close'); $('#form3a').form('clear');">Cancel</a>
<!-- <a style="text-decoration:none;" href="javascript:void(0)" class="button-submit" onclick="save();">Submit</a>-->
<a style="text-decoration:none; left:775px; margin-top:-35px;" href="javascript:void(0)" value="Save" class="button-submit" onclick="save3a();">Save</a>
<a style="text-decoration:none; left:975px; margin-top:-35px;"" href="javascript:void(0)" class="button-submit" onclick="save3aa();">Save & Request PO
</a>
</div>
</div>
</form>
</div>

<!-- DIALOG FORM REQUEST PO -->
<div id="dialog-form3aa" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,reziable:false,modal:true,closable:false"
style="width:350px;height:200px;padding:5px 5px;display:none;top:100px">
<form id="form3aa" method="post">
<input type="hidden" name="rkbpk" id="rkb3" size="8">
    <div class="modal-dialog" style="width:325px; height:175px;">
        <div class="modal-content">
<div style="padding:10px; margin-left:25px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
Set material delivery date
<div><br>
<input name="poreqdel" id="poreqdel" class="easyui-datebox" data-options="formatter:myformatter3a,parser:myparser3a" style="width:60%;"></br>
<label style="width:auto;font-family: 'Arial'; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date format must be in YYYY-MM-DD</label>
</div>
<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
<a style="text-decoration:none; left:71px; top: 128px;" href="javascript:void(0)" class="button-cancel" onclick="jQuery('#dialog-form3aa').dialog('close');">Cancel</a>
<a style="text-decoration:none; left:150px; top: 128px;"" href="javascript:void(0)" class="button-request-po" onclick="save4b();">Submit PO request</a>
</div>
								</div>
				</div>
</form>
</div>

<!-- DIALOG FORM REQUEST PO2 -->
<div id="dialog-form4a" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,reziable:false,modal:true,closable:false"
style="width:350px;height:200px;padding:5px;display:none;top:100px">
<form id="form4a" method="post">
<input type="hidden" name="rkbpk" id="rkbpk" size="8">
    <div class="modal-dialog" style="width:325px; height:175px;">
        <div class="modal-content">
<div style="padding:10px; margin-left:25px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
Set material delivery date
<div><br>
<input name="poreqdel" id="poreqdel" class="easyui-datebox" data-options="formatter:myformatter3a,parser:myparser3a" style="width:60%;"></br>
<label style="width:auto;font-family: 'Arial'; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date format must be in YYYY-MM-DD</label>
</div>
<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
<a style="text-decoration:none; left:71px; top: 128px;" href="javascript:void(0)" class="button-cancel" onclick="jQuery('#dialog-form4a').dialog('close');">Cancel</a>
<a style="text-decoration:none; left:150px; top: 128px;"" href="javascript:void(0)" class="button-request-po" onclick="save4bb();">Submit PO request</a>
</div>
								</div>
				</div>
</form>
</div>

<!-- LOOKUP Color -->
<div id="dialog-form3e" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,reziable:false,modal:true,closable:false"
style="width:900px;height:550px;padding:5px 5px;display:none;top:106px">
<div class="modal-dialog" style="width:98%; height:96%; overflow-y:scroll;overflow-x:hidden;">
<div class="modal-content">
<div style="margin-top:10px; margin-left:15px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
Lookup Color
<a href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:680px;"
onclick="$('#dialog-form3e').dialog('close');"> X</a>
</div>
<div class="content-search3" style="margin-top:-35px;">
				<div id="frame-cari3">
			 <img src="css/images/Shape.png" plain="true" width="18px" height="18px" >
    <input id="cari7b" placeholder="Search..." class="input" onkeyup="Search3a();">
				</div>
				</div>
<!--<img src="css/images/Shape.png" plain="true" width="18px" height="18px" style="margin-top:-22px; margin-left:168px;" onclick="get_lookup();">
<input id="cari7b" placeholder="Search Color" class="input" onkeyup="Search3a();" style="width:218px; height:30px;margin-top:-26px; margin-left:190px;"></br>-->
<div id="tabel2" onclick="get_lookup3();" style="width:860px; margin-top:25px;">
<table id="dg3e" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_data.php?dt=color" toolbar="#tb2" striped="true"
pagination="true" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" data-options="multiSort:true">
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
<div id="dialog-form3f" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,reziable:false,modal:true,closable:false"
style="width:900px;height:550px;padding:5px 5px;display:none;top:106px">
<div class="modal-dialog" style="width:98%; height:96%; overflow-y:scroll;overflow-x:hidden;">
<div class="modal-content">
<div style="margin-top:10px; margin-left:15px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
Lookup Material
<a href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:660px;"
onclick="$('#dialog-form3f').dialog('close');"> X</a>
</div>
<div class="content-search3" style="margin-top:-35px;">
				<div id="frame-cari3">
			 <img src="css/images/Shape.png" plain="true" width="18px" height="18px" >
    <input id="cari8b" placeholder="Search..." class="input" onkeyup="Search3b();">
				</div>
				</div>
<!--<img src="css/images/Shape.png" plain="true" width="18px" height="18px" style="margin-top:-22px; margin-left:178px;" onclick="get_mb();">
<input id="cari8b" placeholder="Search item material" class="input" onkeyup="Search3b();" style="width:218px; height:30px;margin-top:-26px; margin-left:200px;"></br>-->
<div id="tabel2" onclick="get_mb3();" style="width:860px; margin-top:25px;">
<table id="dg3f" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_data.php?dt=mb" toolbar="#tb2" striped="true"
pagination="true" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" data-options="multiSort:true">
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
<div id="dialog-form3g" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="reziable:false,modal:true"
style="width:1325px;height:auto; padding:5px 5px; display:none;top:75px">
	<div align="right">
	<input type="hidden" name="bdownqty1" id="bdownqty1">
	<input type="hidden" name="sz1" id="sz1">
		<input type="hidden" name="col1" id="col1">
		<input type="hidden" name="bdwpk" id="bdwpk">
		<input type="hidden" name="klm" id="klm">
<a href="javascript:void(0);" class="easyui-linkbutton" id="btn1" data-options="iconCls:'icon-add'" onclick="gtrow();">Get</a>
</div><br>
<div id="tabel2">
<table id="dg3g" class="easyui-datagrid" title="" style="width:1300px;height:auto;" align="center"
url="view/get_data.php?dt=bdown&ord=<?php echo $_GET['ord']; ?>" toolbar="#tb2" striped="false"
pagination="false" rownumbers="false"  singleSelect="true" collapsible="false" fitColumns="false">
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
<tr>
<th field="jenis" width="50" hidden="true">Jenis</th>
<th field="country" width="84" editor="textbox">Place</th>
<th field="pono" width="84">PO no.</th>
<th field="opno" width="80">OP no.</th>
<th field="style" width="80">Style</th>
<th field="color" width="80">Color</th>
<th field="gac" width="80">GAC</th>
<th field="s1" width="50">S1</th>
<th field="s2" width="50">S2</th>
<th field="s3" width="50">S3</th>
<th field="s4" width="50">S4</th>
<th field="s5" width="50">S5</th>
<th field="s6" width="50">S6</th>
<th field="s7" width="50">S7</th>
<th field="s8" width="50">S8</th>
<th field="s9" width="50">S9</th>
<th field="s10" width="50">S10</th>
<th field="s11" width="50">S11</th>
<th field="s12" width="50">S12</th>
<th field="s13" width="50">S13</th>
<th field="s14" width="50">S14</th>
<th field="s15" width="50">S15</th>
<th field="tot" width="60">Total</th>
</tr>
</thead>
</table>
</div>
</div>