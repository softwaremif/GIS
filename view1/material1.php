<script type="text/javascript">
var url;

/*edit*/
function edit3a(){
	var row = $('#dg3a').datagrid('getSelected');
	if(row){
		$('#dialog-form3a').dialog('open').dialog('setTitle','Add Material');
		$('#form3a').form('load',row);
	} else {
		$.messager.alert('Warning','No material data selected','warning');
	}
}

/*request*/
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
	timeout:5000,
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
	$('#dialog-form3b').dialog('open').dialog('setTitle','Set material delivery date');
	ord = $('#ord3').val();
	/*alert(ord);*/
	document.getElementById("ordpk3").value = +ord;
 } else {
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:5000,
	showType:'slide',
	icon:'info',
	width:430,
	height:55,
	style:{
	left:0,
	right:'',
	bottom:''
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
					timeout:5000,
					showType:'slide',
					icon:'info',
					width:252,
					height:55,
					style:{
					right:'',
					left:0,
					top:document.body.scrollTop+document.documentElement.scrollTop,
					bottom:''
					}
			});
			$('#dialog-form3a').dialog('close');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg3a').datagrid('reload');
		}
	 });
}

function save3aa(){
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
				timeout:5000,
				showType:'slide',
				icon:'info',
				width:252,
				height:55,
				style:{
				right:'',
				left:0,
				top:document.body.scrollTop+document.documentElement.scrollTop,
				bottom:''
				}
			});
			$('#dialog-form3a').dialog('close');
			$('#dialog-form3aa').dialog('open').dialog('setTitle','Set material delivery date');
			rkbpk3a = $('#rkbpk3a').val();
			/*alert(rkb);*/
			document.getElementById("rkb3").value = +rkbpk3a;
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg3a').datagrid('reload');
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
		$.messager.show({
			title:'',
			msg:data, 
			timeout:5000,
			showType:'slide',
			icon:'info',
			width:430,
			height:55,
			style:{
			left:0,
			right:'',
			bottom:''
			}
		});
		$('#dialog-form3aa').dialog('close');
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
			timeout:5000,
			showType:'slide',
			icon:'info',
			width:430,
			height:55,
			style:{
			left:0,
			right:'',
			bottom:''
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
						timeout:5000,
						showType:'slide',
						icon:'info',
						width:252,
						height:55,
						style:{
						left:0,
						right:'',
						bottom:''
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
var ids = [];
var rows = $('#dg3b').datagrid('getChecked');
if (rows){  
$.messager.confirm('Confirm','Are you sure you want to delete this material?',
function(r){ 
for(var i=0; i<rows.length; i++){
ids.push(rows[i].rkbpk);
}
 // We loop through each project and then delete it
$.each(ids, function (index, value){
$.post('action/delete.php?x=mat',{id:value},function(result){
if (result.success){
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:5000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
	style:{
	left:0,
	right:'',
	bottom:''
	}
	});
	$('#dg3b').datagrid('reload'); 
} else {
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:5000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
	style:{
	left:0,
	right:'',
	bottom:''
	}
	});
}
},'json')
});  // reload the user data
});
} else {
	$.messager.alert('Warning','No material  data selected','warning');
}
}

/*print*/
function print3a(){
	var row = $('#dg3a').datagrid('getSelected');
	if(row){
		cari6 = $('#cari6b').val();
		url = "pdf/pdf_mat.php?ord="+row.ordpk+"&rkb="+row.rkbpk+"&cari="+cari6;
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
		url = "pdf/pdf_mat.php?ord="+row.ordpk+"&rkb="+row.rkbpk+"&cari="+cari6;
		window.open(url);
		/*window.location.href="pdf/pdf_rkb.php&cari=breakdown&ord=" +row.ordpk;*/
	} else {
		$.messager.alert('Warning','No material data selected','warning');
	}
}

/*tab*/
$(function(){
var tabs = $('#tt2').tabs().tabs('tabs');
$('#tt2').tabs({
	onSelect: function(title,index){
	$('#tt2').tabs('getTab',index).panel('refresh');
	}
});
});

/* RUmus Onkeyup */	
function myFunction3a(){
  var x = document.getElementById("bdownqty3a").value;
		var y = document.getElementById("allowcons3a").value;
		var a = document.getElementById("qrs3a").value;
		var b = document.getElementById("estcons3a").value;
  var y2 = 0;
		
		if (a == '') { var a2 = 0;}
  else {a2 = a;}

		if (y == '') { var y2= 2; }
		else { var y2= y;}
		var z= (x * y2 / 100) + parseInt(x) + parseInt(a2) ;
  document.getElementById("pocons3a").value = z;
		
		var c= x * b;
		document.getElementById("totcons3a").value = c;
		}
		
		/* Warna lookup bdown total qty 
        function cellStyler(value,row,index){
            if (value > 35){
                return 'background-color:#ffee00;color:red;';
            }
        }*/
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
	$('#dialog-form3e').dialog('open').dialog('setTitle','Data Color');
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
	$('#dialog-form3f').dialog('open').dialog('setTitle','Data Material Breakdown');
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

/* LOOKUP Breakdown S1 */
function lookup_bdown3(){
	$('#dialog-form3g').dialog('open').dialog('setTitle','Data Breakdown');
	$('#form3g').form('clear');
}
function lookup_bdowns1a(){
	$('#dialog-form3h').dialog('open').dialog('setTitle','S1');
	$('#form3h').form('clear');
}
function get_bdowns1a(){
var row = $('#dg3h').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3h').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3h').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S2 */
function lookup_bdowns2a(){
	$('#dialog-form3i').dialog('open').dialog('setTitle','S2');
	$('#form3i').form('clear');
}
function get_bdowns2a(){
var row = $('#dg3i').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3i').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3i').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S3 */
function lookup_bdowns3a(){
	$('#dialog-form3j').dialog('open').dialog('setTitle','S3');
	$('#form3j').form('clear');
}
function get_bdowns3a(){
var row = $('#dg3j').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3j').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3j').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S4 */
function lookup_bdowns4a(){
	$('#dialog-form3k').dialog('open').dialog('setTitle','S4');
	$('#form3k').form('clear');
}
function get_bdowns4a(){
var row = $('#dg3k').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3k').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3k').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S5 */
function lookup_bdowns5a(){
	$('#dialog-form3l').dialog('open').dialog('setTitle','S5');
	$('#form3l').form('clear');
}
function get_bdowns5a(){
var row = $('#dg3l').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3l').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3l').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S6 */
function lookup_bdowns6a(){
	$('#dialog-form3m').dialog('open').dialog('setTitle','S6');
	$('#form3m').form('clear');
}
function get_bdowns6a(){
var row = $('#dg3m').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3m').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3m').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S7 */
function lookup_bdowns7a(){
	$('#dialog-form3n').dialog('open').dialog('setTitle','S7');
	$('#form3n').form('clear');
}
function get_bdowns7a(){
var row = $('#dg3n').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3n').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3n').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S8 */
function lookup_bdowns8a(){
	$('#dialog-form3o').dialog('open').dialog('setTitle','S8');
	$('#form3o').form('clear');
}
function get_bdowns8a(){
var row = $('#dg3o').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3o').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3o').dialog('close');
	$('#dialog-form3g').dialog('close');
        //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S9 */
function lookup_bdowns9a(){
	$('#dialog-form3p').dialog('open').dialog('setTitle','S9');
	$('#form3p').form('clear');
}
function get_bdowns9a(){
var row = $('#dg3p').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3p').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3p').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S10 */
function lookup_bdowns10a(){
	$('#dialog-form3q').dialog('open').dialog('setTitle','S10');
	$('#form3q').form('clear');
}
function get_bdowns10a(){
var row = $('#dg3q').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3q').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3q').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S11 */
function lookup_bdowns11a(){
	$('#dialog-form3r').dialog('open').dialog('setTitle','S11');
	$('#form3r').form('clear');
}
function get_bdowns11a(){
var row = $('#dg3r').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3r').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3r').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S12 */
function lookup_bdowns12a(){
	$('#dialog-form3s').dialog('open').dialog('setTitle','S12');
	$('#form3s').form('clear');
}
function get_bdowns12a(){
var row = $('#dg3s').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3s').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3s').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S13 */
function lookup_bdowns13a(){
	$('#dialog-form3t').dialog('open').dialog('setTitle','S13');
	$('#form3t').form('clear');
}
function get_bdowns13a(){
var row = $('#dg3t').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3t').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3t').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S14 */
function lookup_bdowns14a(){
	$('#dialog-form3u').dialog('open').dialog('setTitle','S13');
	$('#form3u').form('clear');
}
function get_bdowns14a(){
var row = $('#dg3u').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3u').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3u').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
    }
}
/* LOOKUP Breakdown S15 */
function lookup_bdowns15a(){
	$('#dialog-form3v').dialog('open').dialog('setTitle','S15');
	$('#form3v').form('clear');
}
function get_bdowns15a(){
var row = $('#dg3v').datagrid('getSelected');  						
 if (row){
	var v1=$('#dg3v').datagrid('getRows')[0].size;
	document.getElementById("sizegar3a").value = v1;
	document.getElementById("bdownqty3a").value = row.size;
	document.getElementById("bdownpk3a").value = row.bdownpk;
	document.getElementById("kolom3a").value = row.kolom;
	$('#dialog-form3v').dialog('close');
	$('#dialog-form3g').dialog('close');
    //alert('Item ID:'+row.colname+"\nPrice:"+row.colcode);*/
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
</script>
<?php
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
$ord = $_GET['ord'];
/*$cr3=mysqli_query($koneksi,"select * from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.ordpk='$ord'");
while($dt3=mysqli_fetch_array($cr3)){
$update=mysqli_query($koneksi,"update rkb set sts='2' where rkbpk='$dt3[rkbpk]' and sts='1'");
}*/
$tot2a = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where ord.ordpk='$ord' and rkb.sts='1' and rkb.stspk is null"));

$tot2b = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where ord.ordpk='$ord' and rkb.sts='2' and rkb.stspk is null"));

$tot2c = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where ord.ordpk='$ord' and rkb.sts='3' and rkb.stspk is null"));
?>
<input type="hidden" name="ord3" id="ord3" value="<?php echo $ord; ?>" size="8">
<div id="frame-menu-detail"  style="left:-780px; top:52px; width:70%; height:auto">
<div class="easyui-tabs" id="tt2">
<!--inprogress-->
<div title="<div id=count2a onclick=tot2a();>IN PROGRESS (<?php echo $tot2a; ?>)</div>" href="view/material2.php?ord=<?php echo $ord; ?>&dt=1">
</div>
<!--readyforpo-->
<div title="<div id=count2b onclick=tot2b();>READY FOR PO (<?php echo $tot2b; ?>)</div" href="view/material2.php?ord=<?php echo $ord; ?>&dt=2">
</div>
<!--needrevision-->
<div title="<div id=count2c onclick=tot2c();>NEED REVISION (<?php echo $tot2c; ?>)</div" href="view/material2.php?ord=<?php echo $ord; ?>&dt=3">
</div>
<!--tab2-->
</div>
</div>
