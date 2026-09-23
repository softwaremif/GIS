<html>
<head>
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
top: 68px;
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
.sticky + .contenta {
padding-top: 102px;
}

.dropdownx {
  position: relative;
  display: inline-block;
}

.dropdownx-content {
  display: none;
 position:absolute;
  z-index: 1;
  top: -14px;
  left:4px;
  background-color: #FFFFFF;
  width:auto;
  height:auto;
  /*box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);*/
  z-index: 1;
  padding: 5px;
  border-width: 1px 1px 1px 1px;
  border-style: solid;
  border-color: #E0E0E0;
  border-radius:5px;
}

.dropdownx:hover .dropdownx-content {
  display: block;
}

.datagrid-header .datagrid-cell span{
    color: rgba(0, 0, 0, 0.38);
}
.datagrid-cell{
font-family: 'Arial';
font-style: normal;
font-weight: 400;
font-size: 13px;
line-height: 18px;
white-space: normal;
}


#hor-minimalist-a
{
	font-family:"Arial";
	font-size: 11px;
	background: #ffffff;
	border-collapse: collapse;
	text-align: left;
	width:auto;
	height:auto;
 color: #AFAFAF;
 border-color: #AFAFAF;
}
#hor-minimalist-a th
{
 background-color: #fafafa;
	font-size: 13px;
	font-weight: bolder;
	padding: 5px 5px;
	text-align: center;
/*	border-bottom: 2px solid #6678b1;*/
}
#hor-minimalist-a td
{
	padding: 9px 8px 0px 8px;
/*	border-bottom: 2px solid #6678b1;*/
}
#hor-minimalist-a tbody tr:hover td
{
	font-weight: normal;
}
</style>
<script type="text/javascript">
var url;

$(document).ready(function(){
	//$('#tabel2').hide();
});

function viewpoa(){
$('#viewop').hide();
$('#tabel2').show();
$('#grs').show();
$('#grs2').show();
$('#viewpo').show();
$('#tabel1').hide();
//$('#ntfdelmat').show();
Search();
var count3= JSON.stringify($('#dg3').datagrid('getData').total);
if(count3==0){
var dg3= $('#dg3');
dg3.datagrid();
dg3.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg3.datagrid('getPanel').css('border','none');
$('#grs2').hide();
//$('#dg3').datagrid('load',{});
}
}

function viewpob(){
$('#viewop').show();
$('#viewpo').hide();
$('#grs').hide();
$('#grs2b').hide();
$('#tabel2').hide();
$('#tabel1').show();
//$('#ntfdelmat').show();
Search();
//$('#dg').datagrid('load',{});
//$('#dg2').datagrid('load',{});
}

function Search(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
$('#dg2').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
$('#dg2b').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
$('#dg3').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
$('#dg2c').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
$('#dg1d').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
tnewp();
}

function tnewp(){
var cari1 = $('#cari1').val();
var cari2 = $('#cari2').val();
var cari3 = $('#cari3').val();
$.ajax({
type:"POST",
url:"view/get_proses2ba.php?user=<?php echo $_SESSION['user']; ?>&cari2="+cari2+"&cari3="+cari3,
data:"cari1="+cari1,
success:function(data){
if(data==0){
var dg= $('#dg');
dg.datagrid();
dg.datagrid('getPanel').find('div.datagrid-header').css('display','none');
$('#dg').datagrid('getPanel').css('border','none');
$('#grs2').hide();
$('#curr').hide();
}else{
$('#dg').datagrid('getPanel').css('border','1px solid #E0E0E0');
$('#grs2').show();
$('#curr').show();
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
}
},
});
}

function test(){
var count= JSON.stringify($('#dg').datagrid('getData').total);
if(count==0){
$('#tabel1a').hide();
//var dg= $('#dg');
//dg.datagrid();
//dg.datagrid('getPanel').find('div.datagrid-header').css('display','none');
//dg.datagrid('getPanel').css('border','none');
}
}

function test2(){
var count= JSON.stringify($('#dg3').datagrid('getData').total);
if(count==0){
$('#tabel2a').hide();
var dg= $('#dg');
dg.datagrid();
dg.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg.datagrid('getPanel').css('border','none');
}
}

$(function(){
var dg= $('#dg');
var dg2= $('#dg2');
var dg3= $('#dg3');
var dg2b= $('#dg2b');
var dg2c= $('#dg2c');
var dg1d= $('#dg1d');
dg.datagrid();
dg2.datagrid();
dg3.datagrid();
dg2b.datagrid();
//dg.datagrid('getPanel').find('div.datagrid-header td[field="pono"]').css('border','none');
//$('#dg').datagrid('getPanel').addClass('lines-no');
//$('#dg').datagrid('getPanel').addClass('lines-no2');
//$('#dg').datagrid('getPanel').addClass('col');
dg2.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg2b.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg2c.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg1d.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg3.datagrid('getPanel').find('div.datagrid-header').css('display','none');
//$('#dg2').datagrid('getPanel').addClass('lines-no');
//$('#dg2').datagrid('getPanel').addClass('lines-no2');
//$('#dg2').datagrid('getPanel').addClass('col');
//$('#dg3').datagrid('getPanel').addClass('lines-no');
//$('#dg3').datagrid('getPanel').addClass('lines-no2');
//$('#dg3').datagrid('getPanel').addClass('col');
//$('#dg2d').datagrid('getPanel').addClass('lines-no');
//$('#dg2d').datagrid('getPanel').addClass('lines-no2');
//$('#dg2d').datagrid('getPanel').addClass('col');
Search();

$('#dg2da').datagrid('getPanel').find('div.datagrid-header').css('display','none');
});

function toggle(source){
checkboxes = document.getElementsByName('ckk');
for(var i=0, n=checkboxes.length;i<n;i++){
checkboxes[i].checked = source.checked;
}
}


function count_row(){
	$('#myHeader').show();
    var count = $('#dg').datagrid('getChecked').length;
    if (count) {
    if(count>1){
    $('#mview').hide();
    $('#massign').hide();
    $('#count').css('margin-right','58%'); 
    } else {
    $('#mview').show();
    $('#massign').show();
    $('#count').css('margin-right','40%'); 
    }
    document.getElementById("count").innerHTML = count +" items selected";
    } else {
		document.getElementById("count").innerHTML = 0 +" items selected";
		}
	}
  
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
$('#dg').datagrid('clearSelections');
}

/*view*/
function viewpo(){
var rows = $('#dg').datagrid('getSelected');
	if(rows){
      window.location.href="?hal=detpomd&x=2&po="+rows.popk;
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
	url = "?hal=detpomd&x=2&po="+rows.popk;
  window.open(url);
	//window.location.href="?hal=qty&ord=" +row.ordpk;
	/*}*/
 } else {
		$.messager.alert('Warning','No PO data selected','warning');
	}
}

function canpo(){
var row = $('#dg').datagrid('getSelected');
	if(row){
		$('#dialog-form1').dialog('open').dialog('setTitle','');
		$('#form1').form('load',row);
 }
}

function savecanpo(){
var string = $("#form1").serialize();
	 $('#form1').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=canpo",
		data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
		success	: function(data){
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
			$('#dialog-form1').dialog('close');
			$('#form1').form('reset');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg').datagrid('reload');
   $('#dg').datagrid('clearSelections');
   $('#dg').datagrid('clearChecked');
		}
	 });
}

function purchasing(){
var row = $('#dg').datagrid('getSelected');
	if(row){
		$('#dialog-form1b').dialog('open').dialog('setTitle','');
		$('#form1b').form('load',row);
 }
}

function saveassign(){
var string = $("#form1b").serialize();
	 $('#form1b').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=purchasing",
		data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
		success	: function(data){
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
			$('#dialog-form1b').dialog('close');
			$('#form1b').form('reset');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg').datagrid('reload');
   $('#dg').datagrid('clearSelections');
   $('#dg').datagrid('clearChecked');
		}
	 });
}

$(function(){
$('#dg').datagrid({
view: detailview,
detailFormatter:function(index,row){
return '<div style="padding:2px;position:relative;"><table class="ddv" id="dg-'+index+'"></table></div>';
},
onExpandRow: function(index,row){
//var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
/*function count_row(){
	$('#myHeader').show();
    var count = ddv.datagrid('getChecked').length;
    if (count) {
        document.getElementById("count").innerHTML = count +" items selected";
    } else {
		document.getElementById("count").innerHTML = 0 +" items selected";
		}
	}
function menu(){
	var row = ddv.datagrid('getSelected');
	if(row){
		$('#myHeader').show();
  count_row();
	} else {
	$('#myHeader').hide();
	ddv.datagrid('clearSelections');
	}
}
function menu2(){
$('#myHeader').hide();
ddv.datagrid('clearSelections');
}*/
$('#dg-'+index).datagrid({
url:'view/get_proses2c.php?user=<?php echo $_SESSION['user']; ?>&pono='+row.pono,
fitColumns:false,
multiple:true,
rownumbers:false,
collapsible:true,
loadMsg:'',
autoRowHeight: true,
height:'auto',
width:'1120',
idField:'podtpk',
border:true,
onCheck:function(){ menu(); },
onUncheck:function(){ menu(); },
onCheckAll:function(){ menu(); },
onUncheckAll:function(){ menu2(); },
ctrlSelect:true,
checkOnSelect:true,
columns:[[
{field:'ordno',title:'Order no',width:100},
{field:'item',title:'Item',width:120},
{field:'spec',title:'Specification',width:147},
{field:'supnm',title:'Supplier',width:130},
{field:'sizegar',title:'Size',width:75},
{field:'colname',title:'Color',width:75},
{field:'price',title:'Price',width:85},
{field:'qty',title:'Qty',width:75},
{field:'unit',title:'Unit',width:50},
{field:'tgljam2',title:'Req Date',width:120},
{field:'poreqdel2',title:'Delivery ETD',width:110}
]],

onResize:function(){
//$('#dg').datagrid('fixDetailRowHeight',index);
},
onLoadSuccess:function(){
var sup = $(this).datagrid('getColumnOption', 'supnm');
      $('.' + sup.cellClass).each(function(){
         var style = $(this).attr('style');
        $(this).attr('style',style+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
      var item = $(this).datagrid('getColumnOption', 'item');
      $('.' + item.cellClass).each(function(){
         var style2 = $(this).attr('style');
        $(this).attr('style',style2+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
       var spec = $(this).datagrid('getColumnOption', 'spec');
      $('.' + spec.cellClass).each(function(){
         var style3 = $(this).attr('style');
        $(this).attr('style',style3+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
      var sizegar = $(this).datagrid('getColumnOption', 'sizegar');
      $('.' + sizegar.cellClass).each(function(){
         var style4 = $(this).attr('style');
        $(this).attr('style',style4+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
      var colname = $(this).datagrid('getColumnOption', 'colname');
      $('.' + colname.cellClass).each(function(){
         var style5 = $(this).attr('style');
        $(this).attr('style',style5+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
}
});
$('#dg').datagrid('fixDetailRowHeight',index);
},
onLoadSuccess: function(){
var dg = $('#dg');
var count = dg.datagrid('getRows').length;
for(var i=0; i<count; i++){
  dg.datagrid('expandRow',i);
}
}
});
});

function canproses(){
var row = $('#dg').datagrid('getSelected');
	if(row){
		$('#dialog-form2').dialog('open').dialog('setTitle','');
    document.getElementById('crpopk').value=row.popk;
    $('#dg2d').datagrid('load',{
    crpopk: $('#crpopk').val()
    });
    var dg2d=$('#dg2d');
    dg2d.datagrid();
    dg2d.datagrid('getPanel').find('div.datagrid-header').css('display','none');
    
    $('#dg2d').datagrid({
view: detailview,
detailFormatter:function(index,row){
return '<div style="padding:2px;position:relative;"><table class="ddv2"></table></div>';
},
onExpandRow: function(index,row){
var ddv2 = $(this).datagrid('getRowDetail',index).find('table.ddv2');
/*function count_row(){
	$('#myHeader').show();
    var count = ddv.datagrid('getChecked').length;
    if (count) {
        document.getElementById("count").innerHTML = count +" items selected";
    } else {
		document.getElementById("count").innerHTML = 0 +" items selected";
		}
	}
function menu(){
	var row = ddv.datagrid('getSelected');
	if(row){
		$('#myHeader').show();
  count_row();
	} else {
	$('#myHeader').hide();
	ddv.datagrid('clearSelections');
	}
}
function menu2(){
$('#myHeader').hide();
ddv.datagrid('clearSelections');
}*/
ddv2.datagrid({
url:'view/get_diffmat2.php?user=<?php echo $_SESSION['user']; ?>&pono='+row.pono,
fitColumns:false,
multiple: true,
ctrlSelect:true,
checkOnSelect:true,
rownumbers:false,
collapsible:true,
loadMsg:'',
height:'auto',
//width:'1125',
border:true,
columns:[[
{field:'ck',title:'',checkbox:true,width:50},
{field:'ordno',title:'Order no',width:85},
{field:'item',title:'Item',width:120},
{field:'spec',title:'Specification',width:130},
{field:'supnm',title:'Supplier',width:130},
{field:'sizegar',title:'Size',width:75},
{field:'colname',title:'Color',width:75},
{field:'price',title:'Price',width:85},
{field:'qty',title:'Qty',width:75},
{field:'unit',title:'Unit',width:50},
{field:'tgljam2',title:'Req Date',width:120},
{field:'poreqdel2',title:'Delivery ETD',width:110}
]],
onCheck:function(val,row){
document.getElementById('tt').value=1;
document.getElementById('popk3').value=row.popk;
document.getElementById('suppk3').value=row.suppk;
document.getElementById('podtpk3').value=row.podtpk;
},
onResize:function(){
$('#dg2d').datagrid('fixDetailRowHeight',index);
},
onLoadSuccess:function(){
setTimeout(function(){
$('#dg2d').datagrid('fixDetailRowHeight',index);
},0);
}
});
$('#dg2d').datagrid('fixDetailRowHeight',index);
},
onLoadSuccess: function(){
var dg2d = $('#dg2d');
var count = dg2d.datagrid('getRows').length;
for(var i=0; i<count; i++){
  dg2d.datagrid('expandRow',i);
}
}
});
 }
}

function reassign(){
var row = $('#dg').datagrid('getSelected');
	if(row){
		$('#dialog-form2').dialog('open').dialog('setTitle','');
		$('#form2').form('load',row);
  document.getElementById("carpo").value= row.popk;
  
    $('#dg2da').datagrid('load',{
    carpo: $('#carpo').val()
    });
 }
}

function tbpo(){
/*var a=document.getElementById('tt').value;
if(a==1){
$('#dialog-form3').dialog('open').dialog('setTitle','');
$('#dg2e').datagrid('load',{
    suppk3: $('#suppk3').val()
  });
$('#dialog-form2').dialog('close');
}*/
var row = $('#dg2da').datagrid('getSelected');
var ids = [];
var rows = $('#dg2da').datagrid('getSelections');
for(var i=0; i<rows.length; i++){
ids.push(rows[i].podtpk);
}
//$.messager.confirm('Confirm','Are you sure you want to reassign this material?',
//function(r){
//if (r){
// We loop through each project and then delete it
$.each(ids, function (index, value){
$.post('action/simpan.php?x=cekinsert',{id:value},
function(result){
if (result.success){
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
    top:'',
    bottom:-document.body.scrollTop-document.documentElement.scrollTop
    }
    });*/
//$('#dg').datagrid('reload');
$('#dialog-form3').dialog('open').dialog('setTitle','');
  document.getElementById("suppk3").value= row.suppk;
  document.getElementById("spec3").innerHTML= row.item;
  document.getElementById("popk3").value= row.popk;
  
    $('#dg2e').datagrid('load',{
    suppk3: $('#suppk3').val()
    });
} else {
 //alert("test");
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
    top:'',
    bottom:-document.body.scrollTop-document.documentElement.scrollTop
    }
    });*/
}
},'json')
});
//}
//});
} 

function cancel(){
//document.getElementById('crpopk').value='';
//document.getElementById('tt').value='';
//$('#dg2d').datagrid('load',{
//    crpopk: ''
//  });
$('#dialog-form2').dialog('close');
$('#form2').form('reset');
}

function cancel2(){
 //$('#dialog-form3').dialog('close');
 //$('#dialog-form2').dialog('open').dialog('setTitle','');
 var string = $("#form3").serialize();
	 $('#form3').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=cancekinsert",
		data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
		success	: function(data){
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
			$('#dialog-form3').dialog('close');
			$('#form3').form('reset');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg2da').datagrid('reload');
		}
	 });
}

function saveinsert(){
var row = $('#dg2e').datagrid('getSelected');
var string = $("#form3").serialize();
	 $('#form3').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=saveinsert&po="+row.popk,
		data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
		success	: function(data){
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
			$('#dialog-form3').dialog('close');
			$('#form3').form('reset');
   $('#dialog-form2').dialog('close');
			$('#form2').form('reset');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg').datagrid('reload');
   $('#dg').datagrid('clearSelections');
		}
	 }); 
}

function formatku(val,row){
        return '<div style=height:40px;padding:10px;><span style=font-family:Arial;font-style:normal;font-weight: 400;font-size: 16px;line-height:20px;color:#000000;>PO&nbsp;&nbsp;'+val+
        '</span>&nbsp;&nbsp;&nbsp;'+row.status+'&nbsp;&nbsp;<span style=color:#EF3B42;>'+row.tdelmat+'</span>&nbsp;&nbsp;&nbsp;'+row.tpo+'&nbsp;Materials'+
        '&nbsp;&nbsp;&nbsp;&nbsp;<a href=?hal=detpomd&x=1&po='+row.popk+' style=text-decoration:none;color:#359DD9;font-family:Arial;font-style:normal;font-weight:400;font-size:14px;line-height:18px;>View detail</a></div>';
}

function formatku2(value,rows){
     return 'OP &nbsp;'+value+
    '<br><div style="width:102.5%;"><table style="margin-left:-15px;" border="1" id="hor-minimalist-a">'+
    '<thead>'+
    '<tr style="height:30px;background-color:#F1F1F1;">'+
    '<th width="100">PO</th>'+
    '<th width="120">Item</th>'+
    '<th width="146">Specification</th>'+
    '<th width="130">Supplier</th>'+
    '<th width="75">Size</th>'+
    '<th width="74">Color</th>'+
    '<th width="100">Price</th>'+
    '<th width="74">Qty</th>'+
    '<th width="71">Units</th>'+
    '<th width="134">Req Date</th>'+
    '<th width="115">Delivery ETD</th>'+
    '</tr>'+
    '</thead>'+
    '</table></div>';
}

function formatkupo(value,rows){
     return 'PO &nbsp;'+value+
    '<br><div style="width:101.5%;"><table style="margin-left:-15px;" border="1" id="hor-minimalist-a">'+
    '<thead>'+
    '<tr style="height:30px;background-color:#F1F1F1;">'+
    '<th width="133">Order no</th>'+
    '<th width="124">Item</th>'+
    '<th width="124">Specification</th>'+
    '<th width="133">Supplier</th>'+
    '<th width="75">Size</th>'+
    '<th width="75">Color</th>'+
    '<th width="75">Price</th>'+
    '<th width="75">Qty</th>'+
    '<th width="75">Units</th>'+
    '<th width="110">Req Date</th>'+
    '<th width="110">Delivery ETD</th>'+
    '</tr>'+
    '</thead>'+
    '</table></div>';
}

function formatterku(value,rows){
        return value+
    '<br><div style="width:102.5%;"><table style="margin-left:-19px;" border="1" id="hor-minimalist-a">'+
    '<thead>'+
    '<tr style="height:30px;background-color:#F1F1F1;">'+
    '<th width="100">OP</th>'+
    '<th width="120">Item</th>'+
    '<th width="146">Specification</th>'+
    '<th width="130">Supplier</th>'+
    '<th width="75">Size</th>'+
    '<th width="74">Color</th>'+
    '<th width="100">Price</th>'+
    '<th width="74">Qty</th>'+
    '<th width="71">Units</th>'+
    '<th width="134">Req Date</th>'+
    '<th width="115">Delivery ETD</th>'+
    '</tr>'+
    '</thead>'+
    '</table></div>';
}

function formatku3(val,row){
    if(val=="Need assignment"){
    return '<span style="color: rgba(0, 0, 0, 0.38);">'+val+'</span>';
    //return "<span style='color: rgba(0, 0, 0, 0.38);'"+val+"</span>";
    }else{
     return val;
    }
}
$(function(){
$('#dg3').datagrid({
    rowStyler:function(index,row){
        if (row.delsts>0){
            return 'color:#EF3B42';
        }
    }
});
});

function Search2(){
$('#dg2e').datagrid('load',{
caripo: $('#caripo').val(),
suppk3: $('#suppk3').val()
});
}

function selectpo(){
 
}
function wrap() {
      var sup = $(this).datagrid('getColumnOption', 'supnm');
      $('.' + sup.cellClass).each(function(){
         var style = $(this).attr('style');
        $(this).attr('style',style+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
      var item = $(this).datagrid('getColumnOption', 'item');
      $('.' + item.cellClass).each(function(){
         var style2 = $(this).attr('style');
        $(this).attr('style',style2+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
       var spec = $(this).datagrid('getColumnOption', 'spec');
      $('.' + spec.cellClass).each(function(){
         var style3 = $(this).attr('style');
        $(this).attr('style',style3+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
    }
    
function clsdelsts(){
 $('#ntfdelmat').hide();
}
function clsdelsts2(){
 $('#ntfdelmat2').hide();
}
function clsdelsts4(){
 $('#ntfdelmat4').hide();
}

$(function(){
var a= document.getElementById('ttpo1b').value;
var b= document.getElementById('tdelmat1').value;
var c= document.getElementById('tdelmat2').value;
var d= document.getElementById('tdelmat4').value;
if(a>0){
$('#ntf1b').show();
}else{
$('#ntf1b').hide();
}
if(b>0){
$('#ntfdelmat').show();
}else{
$('#ntfdelmat').hide();
}
if(c>0){
$('#ntfdelmat2').show();
}else{
$('#ntfdelmat2').hide();
}
if(d>0){
$('#ntfdelmat4').show();
}else{
$('#ntfdelmat4').hide();
}
});
</script>
</head>
<body>
<?php
$ord=$_GET['ordpk'];
?>
<div class="contenta">
<div id="judul">
Purchase orders
</div>
<div id="frame-utama-cari" style="left:18%;top:100px; width:70%;">
<div id="container-cari">
<div id="frame-cari" >
<img src="css/images/Shape.png" plain="true" width="18px" height="18px" onclick="">
<input id="cari1" placeholder="Search..." class="input" onkeyup="Search();">
</div>
</div>
<div style="margin-right:385px;">
<input style="width:140px; height:28px;" id="cari2" name="cari2" class="easyui-combobox"
data-options="valueField:'byrpk',textField:'byrnm',url:'view/get_data.php?dt=byr',prompt:'Buyer',onChange:Search,limitToList:'true'">
<select class="easyui-combobox" id="cari3"
data-options="editable:false, panelHeight:'auto',onChange:Search" style="width:100px;" >
<?php
for ($i=date('Y'); $i>=date('Y')-2 ; $i-=1){
?>
<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
</select>
</div>
<div id="viewop"><a href="javascript:void(0)" plain="true" onclick="viewpoa();" style="text-decoration: none; color:#000000;"><img src="css/images/eye-fill.svg"> by PO </a></div>
<div id="viewpo" style="display:none;"><a href="javascript:void(0)" plain="true" onclick="viewpob();" style="text-decoration: none; color:#000000;"><img src="css/images/eye-fill.svg"> by OP</a></div>
</div>
<div id="frame-utama-judul" style="top:150px;">
<div class="frame-judul" style="width:auto;color: rgba(0, 0, 0, 0.6); font-size: 16px; line-height: 20px; font-weight:700;">
Awaiting PO assignment
</div>
<div class="frame-judul" style="width:auto;">
<a href="javascript:void(0);" onclick="prosespo();" plain="true" style="font-size: 16px; line-height: 20px; font-weight:700; color:#359DD9; text-decoration: none;"> Assign POs </a>
</div>
</div>
<div id="tabel1" style="top:170px;">
 <table id="dg1a" class="easyui-datagrid" title="" style="width:95%;" align="center"
url="view/get_proses1.php?user=<?php echo $_SESSION['user']; ?>"
data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,fitColumns:false,view:groupview,border:true,autoRowHeight:true,  
groupField:'ordno',groupFormatter:formatku2,
groupStyler:function(value,rows){
return 'height:68px;padding:10px;'
},
onLoadSuccess:wrap">
<thead>
<tr>
<th field="pono" width="100">PO</th>
<th field="item" width="120">Item</th>
<th field="spec" width="147">Specification</th>
<th field="supnm" width="130" formatter="formatku3">Supplier</th>
<th field="sizegar" width="75">Size</th>
<th field="colname" width="75">Color</th>
<th field="price" width="100">Price</th>
<th field="qty" width="75">Qty</th>
<th field="unit" width="70">Units</th>
<th field="tgljam2" width="135">Req Date</th>
<th field="poreqdel2" width="115">Delivery ETD</th>
</tr>
</thead>
</table>
<br>
<hr id="grsa" style="width:100%;height:auto;border:1px solid #D6D6D6;">
<div id="curr2" style="text-align:left;padding:5px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">
Current purchase orders
</div><br>
<div id="ntfdelmat2" style="padding: 5px;width: 1125px;height: 40px;background: #FF6B00;;box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12); border-radius: 8px;font-family: 'arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: #FFFFFF;">
<div style="margin-left:-1050px;margin-top:3px;"><img src="css/images/warning2.png" width="25" height="21"></div>
<div style="margin-left:-625px;margin-top:-15px;">&nbsp;&nbsp;&nbsp;&nbsp;A few items were deleted from your PO list, please review them</div>
<div style="margin-left:1075px;margin-top:-20px;font-size: 18px;line-height: 22px;color: #FFFFFF;cursor: pointer;" onclick="clsdelsts();">&#10005;</div>
</div><br>
<table id="dg" class="easyui-datagrid" style="width:95%;" align="center"
url="view/get_proses2b.php?user=<?php echo $_SESSION['user']; ?>" idField="popk"
data-options="
pagination:false,
multiple:true,
collapsible:true,
rownumbers:false,
fitColumns:true,
autoRowHeight: true,
height:'auto',
border:true,
onCheck:function(){ menu(); },
onUncheck:function(){ menu(); },
onCheckAll:function(){ menu(); },
onUncheckAll:function(){ menu2(); }">
<thead>
<tr>
<th field="ck" checkbox="true" width="100"></th>
<th field="pono" width="125" formatter="formatku">Select All PO's</th>
</tr>
</thead>
</table>
<br>
<hr id="grs2" style="width:100%;border:1px solid #D6D6D6;">
<div style="text-align:left;padding:5px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">
Outsourced
</div>
<div style="text-align:left;padding:5px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
The following items are still waiting for PO assignment
</div>
<table id="dg2" class="easyui-datagrid" title="" style="width:95%;height:auto;" align="center"
url="view/get_proses4.php?user=<?php echo $_SESSION['user']; ?>"
data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,fitColumns:false,view:groupview,border:true,
groupField:'ordno',groupFormatter:formatku2,
groupStyler:function(value,rows){
return 'height:68px;padding:10px;';
},
onLoadSuccess:wrap">
<thead>
<tr>
<th field="pono" width="100">PO</th>
<th field="item" width="120">Item</th>
<th field="spec" width="147">Specification</th>
<th field="supnm" width="130" formatter="formatku3">Supplier</th>
<th field="sizegar" width="75">Size</th>
<th field="colname" width="75">Color</th>
<th field="price" width="100">Price</th>
<th field="qty" width="75">Qty</th>
<th field="unit" width="70">Units</th>
<th field="tgljam2" width="135">Req Date</th>
<th field="poreqdel2" width="115">Delivery ETD</th>
</tr>
</thead>
</table>
<br>
<hr id="grs2" style="width:100%;border:1px solid #D6D6D6;">
<br>
<!-- Tabel 3 -->
<?php
$cr=mysqli_query($koneksi,"select * from user where userpk='$_SESSION[user]'");
$dt=mysqli_fetch_array($cr);
if($dt['spv']==1){ $and1="and fu.fupk='$dt[fupk]'"; }
else { $and1="and ord.userpk='$dt[userpk]'"; }
$result= mysqli_num_rows(mysqli_query($koneksi,"SELECT * from po
LEFT OUTER JOIN podt ON podt.popk=po.popk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
where tpo1b='1' $and1
group by po.popk"));

$result2= mysqli_num_rows(mysqli_query($koneksi,"SELECT * from podt
LEFT OUTER JOIN po ON po.popk=podt.popk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
where podt.delsts='1' and po.pur<>'' $and1"));

$result3= mysqli_num_rows(mysqli_query($koneksi,"SELECT * from podt
LEFT OUTER JOIN po ON po.popk=podt.popk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
where podt.delsts='1' and podt.stspk='2' and po.pur is null $and1"));
?>
<input type="hidden" id="ttpo1b" name="ttpo1b" value="<?php echo $result; ?>">
<input type="hidden" id="tdelmat1" name="tdelmat1" value="<?php echo $result2; ?>">
<input type="hidden" id="tdelmat2" name="tdelmat2" value="<?php echo $result3; ?>">
<div id="ntf1b" style="display: none;padding: 5px;width: 1125px;height: 40px;background: #0B89D2;box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12); border-radius: 8px;font-family: 'arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: #FFFFFF;">
<div style="margin-left:-1050px;margin-top:3px;"><img src="css/images/warning.png" width="25" height="21"></div>
<div style="margin-left:-650px;margin-top:-15px;">&nbsp;&nbsp;&nbsp;&nbsp;Some PO information has been updated by Purchasing</div>
<div style="margin-left:1075px;margin-top:-20px;font-size: 18px;line-height: 22px;color: #FFFFFF;cursor: pointer;" onclick="clsnotif();">&#10005;</div>
</div>
<br>
<div id="ntfdelmat" style="padding: 5px;width: 1125px;height: 40px;background: #FF6B00;;box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12); border-radius: 8px;font-family: 'arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: #FFFFFF;">
<div style="margin-left:-1050px;margin-top:3px;"><img src="css/images/warning2.png" width="25" height="21"></div>
<div style="margin-left:-625px;margin-top:-15px;">&nbsp;&nbsp;&nbsp;&nbsp;A few items were deleted from your PO list, please review them</div>
<div style="margin-left:1075px;margin-top:-20px;font-size: 18px;line-height: 22px;color: #FFFFFF;cursor: pointer;" onclick="clsdelsts();">&#10005;</div>
</div>
<br>
<table id="dg2c" class="easyui-datagrid" title="" style="width:95%;height:auto;" align="center"
url="view/get_proses3.php?user=<?php echo $_SESSION['user']; ?>" pageSize="100" pageList="[100,200,300,500]"
data-options="singleSelect:true,pagination:true,collapsible:true,rownumbers:false,fitColumns:true,view:groupview,border:true,
groupField:'pono',
groupFormatter:formatterku,
groupStyler:function(value,rows){
    return 'height:75px;padding:15px;';
},
onLoadSuccess:wrap">
<thead>
<tr>
<th field="ordno" width="100">OP</th>
<th field="item" width="120">Item</th>
<th field="spec" width="147">Specification</th>
<th field="supnm" width="130" formatter="formatku3">Supplier</th>
<th field="sizegar" width="75">Size</th>
<th field="colname" width="75">Color</th>
<th field="price" width="100">Price</th>
<th field="qty" width="75">Qty</th>
<th field="unit" width="70">Units</th>
<th field="tgljam2" width="135">Req Date</th>
<th field="poreqdel2" width="115">Delivery ETD</th>
</tr>
</thead>
</table>
<br>
</div>

<div id="tabel2" style="top:180px;display:none;">
<div id="curr" style="text-align:left;padding:5px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">
Current purchase orders
</div><br>
<!-- Tabel 1 -->
 <?php
$cr4=mysqli_query($koneksi,"select * from user where userpk='$_SESSION[user]'");
$dt4=mysqli_fetch_array($cr4);
if($dt4['spv']==1){ $and4="and fu.fupk='$dt4[fupk]'"; }
else { $and4="and ord.userpk='$dt4[userpk]'"; }

$result4= mysqli_num_rows(mysqli_query($koneksi,"SELECT * from podt
LEFT OUTER JOIN po ON po.popk=podt.popk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
where podt.delsts='1' and podt.stspk='2' and po.pur is null $and4"));
?>
<input type="hidden" id="tdelmat4" name="tdelmat4" value="<?php echo $result4; ?>">
<div id="ntfdelmat4" style="padding: 5px;width: 1125px;height: 40px;background: #FF6B00;;box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12); border-radius: 8px;font-family: 'arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: #FFFFFF;">
<div style="margin-left:-1050px;margin-top:3px;"><img src="css/images/warning2.png" width="25" height="21"></div>
<div style="margin-left:-625px;margin-top:-15px;">&nbsp;&nbsp;&nbsp;&nbsp;A few items were deleted from your PO list, please review them</div>
<div style="margin-left:1075px;margin-top:-20px;font-size: 18px;line-height: 22px;color: #FFFFFF;cursor: pointer;" onclick="clsdelsts4();">&#10005;</div>
</div><br>
<table id="dg3" class="easyui-datagrid" title="" style="width:95%;height:auto;" align="center"
url="view/get_proses2e.php?user=<?php echo $_SESSION['user']; ?>"
data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,fitColumns:false,view:groupview,border:true,
groupField:'ordno',groupFormatter:formatku2,
groupStyler:function(value,rows){
return 'height:68px;padding:10px;';},
onLoadSuccess:function(){ test2();}">
<thead>
<tr>
<th field="pono" width="100">PO</th>
<th field="item" width="120">Item</th>
<th field="spec" width="147">Specification</th>
<th field="supnm" width="130" formatter="formatku3">Supplier</th>
<th field="sizegar" width="75">Size</th>
<th field="colname" width="75">Color</th>
<th field="price" width="100">Price</th>
<th field="qty" width="75">Qty</th>
<th field="unit" width="70">Units</th>
<th field="tgljam2" width="135">Req Date</th>
<th field="poreqdel2" width="115">Delivery ETD</th>
</tr>
</thead>
</table>
<br>
<hr id="grs2" style="width:100%;border:1px solid #D6D6D6;"></hr>
<div style="text-align:left;padding:5px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">
Outsourced
</div>
<div style="text-align:left;padding:5px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
The following items are still waiting for PO assignment
</div>
<table id="dg2b" class="easyui-datagrid" title="" style="width:95%;height:auto;" align="center"
url="view/get_proses4.php?user=<?php echo $_SESSION['user']; ?>"
data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,fitColumns:false,view:groupview,border:true,
groupField:'ordno',groupFormatter:formatku2,
groupStyler:function(value,rows){
return 'height:68px;padding:10px;';
},
onLoadSuccess:wrap">
<thead>
<tr>
<th field="pono" width="100">PO</th>
<th field="item" width="120">Item</th>
<th field="spec" width="147">Specification</th>
<th field="supnm" width="130" formatter="formatku3">Supplier</th>
<th field="sizegar" width="75">Size</th>
<th field="colname" width="75">Color</th>
<th field="price" width="100">Price</th>
<th field="qty" width="75">Qty</th>
<th field="unit" width="70">Units</th>
<th field="tgljam2" width="135">Req Date</th>
<th field="poreqdel2" width="115">Delivery ETD</th>
</tr>
</thead>
</table>
<br>
<hr id="grs2" style="width:100%;border:1px solid #D6D6D6;"></hr>
<table id="dg1d" class="easyui-datagrid" title="" style="width:95%;height:auto;" align="center"
url="view/get_proses3c.php?user=<?php echo $_SESSION['user']; ?>" pageSize="100" pageList="[100,200,300,500]"
data-options="singleSelect:true,pagination:true,collapsible:true,rownumbers:false,fitColumns:true,view:groupview,border:true,
groupField:'ordno',
groupFormatter:formatku2,
groupStyler:function(value,rows){
    return 'height:75px;padding:15px;';
},
onLoadSuccess:wrap">
<thead>
<tr>
<th field="pono" width="100">PO</th>
<th field="item" width="120">Item</th>
<th field="spec" width="147">Specification</th>
<th field="supnm" width="130" formatter="formatku3">Supplier</th>
<th field="sizegar" width="75">Size</th>
<th field="colname" width="75">Color</th>
<th field="price" width="100">Price</th>
<th field="qty" width="75">Qty</th>
<th field="unit" width="70">Units</th>
<th field="tgljam2" width="135">Req Date</th>
<th field="poreqdel2" width="115">Delivery ETD</th>
</tr>
</thead>
</table>
</div>
</div>

<div class="header" id="myHeader" onclick=""  style="display:none;">
<div id="count" style="margin-right:40%;"></div>
<div class="detail" id="mview" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="viewpo();" oncontextmenu="viewpo2();" title="if right click automatically new tab" class="easyui-tooltip" style="color: #FFFFFF; text-decoration: none;"> View PO </a></div>
<div class="detail" id="massign" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="reassign();" style="color: #FFFFFF; text-decoration: none;"> Reassign material </a></div>
<!--<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="purchasing();" style="color: #FFFFFF; text-decoration: none;"> Assign purchasing </a></div>-->
<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="canpo();" style="color: #FFFFFF; text-decoration: none;"> Cancel PO </a></div>
<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="menu2();" style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
</div>

<div id="dialog-form1" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,closable:false,resizable:false,modal:true,border:false"
style="width:300px;height:190px;border-radius:8px;padding:5px 5px;display:none;top:200px">
<form id="form1" method="post">
 <input type="hidden" name="popk">
  <div class="modal-content">
  <!-- Modal Header -->
  <div class="modal-header">
  <div class="modal-title">Canceling PO
	</div>
  </div>
  <div style="margin-left:20px;width:275px;height:54px;margin-top:50px; font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
   Cancelling this PO will un-assign the PO numbers currently set to materials. Would you like to proceed?
  </div>
  <a style="text-decoration:none; width: 88px; height: 34px; left: 125px; top: 145px;" href="javascript:void(0)" class="button-cancel" onclick="$('#dialog-form1').dialog('close');$('#form1').form('reset');">Cancel</a>
  <a style="text-decoration:none; width: 88px; height: 34px; left: 200px; top: 145px;" href="javascript:void(0)" class="button-submit" onclick="savecanpo();">Yes</a>
	<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
  </div>
</form>
</div>

<div id="dialog-form1b" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,closable:false,resizable:false,modal:true,border:false"
style="width:300px;height:190px;border-radius:8px;padding:5px 5px;display:none;top:200px">
<form id="form1b" method="post">
 <input type="hidden" name="popk">
  <div class="modal-content">
  <!-- Modal Header -->
  <div class="modal-header">
  <div class="modal-title">Assign purchasing
	</div>
  </div>
  <div style="margin-left:20px;width:275px;height:54px;margin-top:50px; font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
   Assign this PO to purchasing. Would you like to proceed?
  </div>
  <a style="text-decoration:none; width: 88px; height: 34px; left: 125px; top: 145px;" href="javascript:void(0)" class="button-cancel" onclick="$('#dialog-form1b').dialog('close');$('#form1b').form('reset');">Cancel</a>
  <a style="text-decoration:none; width: 88px; height: 34px; left: 200px; top: 145px;" href="javascript:void(0)" class="button-submit" onclick="saveassign();">Yes</a>
	<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
  </div>
</form>
</div>

<div id="dialog-form2" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,closable:false,resizable:false,modal:true,border:false"
style="width:1150px;height:387px;padding:5px 5px;border-radius:8px;display:none;top:200px">
<form id="form2" method="post">
<!--<input type="hidden" name="crpopk" id="crpopk">-->
<!--<input type="hidden" name="tt" id="tt">-->
<input type="hidden" name="popk" id="carpo">
  <div class="modal-content">
  <!-- Modal Header -->
  <div class="modal-header">
  <div class="modal-title">Choose Material
	</div></div>
<div id="tabel2da" style="margin-left:25px;margin-top:50px;width:98.2%;">
<!--<table id="dg2da" class="easyui-datagrid" style="width:97%;height:185px;" align="center"
url="view/get_diffmat.php" idField="popk"
data-options="
pagination:false,
Multiple:true,
collapsible:true,
rownumbers:false,
fitColumns:false,
border:true">
<thead>
<tr>
<th field="pono" width="125"></th>
</tr>
</thead>
</table>-->
<table id="dg2da" class="easyui-datagrid" title="" style="width:97%;height:225px;" align="center"
url="view/get_diffmat.php?user=<?php echo $_SESSION['user']; ?>" IdField="podtpk"
data-options="Multiple:true,pagination:false,collapsible:true,rownumbers:false,fitColumns:false,view:groupview,border:true,autoRowHeight:true,  
groupField:'pono',groupFormatter:formatkupo,
groupStyler:function(value,rows){
return 'height:68px;padding:10px;'
},
onLoadSuccess:wrap">
<thead>
<tr>
<th data-options="field:'ck',checkbox:true"></th>
<th field="ordno" width="100">OP</th>
<th field="item" width="120">Item</th>
<th field="spec" width="125">Specification</th>
<th field="supnm" width="130" formatter="formatku3">Supplier</th>
<th field="sizegar" width="75">Size</th>
<th field="colname" width="75">Color</th>
<th field="price" width="75">Price</th>
<th field="qty" width="75">Qty</th>
<th field="unit" width="75">Units</th>
<th field="tgljam2" width="105">Req Date</th>
<th field="poreqdel2" width="105">Delivery ETD</th>
</tr>
</thead>
</table>
</div>
  <a style="text-decoration:none; width: 88px; height: 47px; left: 825px; top: 310px;" href="javascript:void(0)" class="button-cancel" onclick="cancel();">Cancel</a>
  <a style="text-decoration:none; width: 157px; height: 47px; left: 900px; top: 310px;" href="javascript:void(0)" class="button-submit" onclick="tbpo();">Insert into different PO</a>
	<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
  </div>
</form>
</div>

<div id="dialog-form3" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,closable:false,resizable:false,modal:true,border:false"
style="width:892px;height:560px;padding:5px 5px;border-radius:8px;display:none;top:100px">
<form id="form3" method="post">
<input type="hidden" name="popk" id="popk3">
<input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">
<!--<input type="hidden" name="thn" value="<?php //echo $_GET['thn']; ?>">-->
<!--<input type="hidden" name="podtpk3" id="podtpk3">-->
<input type="hidden" name="suppk" id="suppk3">
<div class="modal-content">
  <!-- Modal Header -->
<div class="modal-header">
<div class="modal-title" style="width: 785px;">Choose which PO to input the following item in
</div>
<div style="margin-top: 48px;margin-left: 23px;font-family: Arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
item</div>
</div>
<span id="spec3" style="margin-left: 23px;font-family: Arial;font-style: normal;font-weight: 400;font-size: 16px;line-height: 20px;color:#000000;"></span>
 <div class="content-search4" style="margin-top:35px;margin-left:23px;">
			<div id="frame-cari4">
			<img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button" >
   <input id="caripo" placeholder="Search..." class="input" onkeyup="Search2();">
			</div>
			</div><br>
<div id="tabel2e" onclick="" style="margin-left:25px;margin-top:75px;width:97%;">
<table id="dg2e" class="easyui-datagrid" style="width:96%;height:300px;" align="center"
url="view/get_datapo.php?user=<?php echo $_SESSION['user']; ?>"
data-options="
pagination:false,
singleSelect:true,
collapsible:true,
rownumbers:false,
fitColumns:false,
border:true,
height:'auto'">
<thead>
<tr>
<th field="act" width="100">Action</th>
<th field="pono" width="150">PO</th>
<th field="supnm" width="150">Supplier</th>
<th field="brg" width="420">Item description</th>
</tr>
</thead>
</table>
</div>
  <a style="text-decoration:none; width: 88px; height: 47px; left: 625px; top: 500px;" href="javascript:void(0)" class="button-cancel" onclick="cancel2();">Cancel</a>
  <a style="text-decoration:none; width: 157px; height: 47px; left: 700px; top: 500px;" href="javascript:void(0)" class="button-submit" onclick="saveinsert();">Insert into different PO</a>
	<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
  </div>
</form>
</div>

<script type="text/javascript">
window.onscroll = function(){
myFunctiona();
myFunctionb();
myFunctionb1();
myFunctionc();
myFunctiond();
};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;
function myFunctiona(){
if(window.pageYOffset > sticky){
header.classList.add("sticky");
} else {
header.classList.remove("sticky");
}
}

var headerb = document.getElementById("dialog-form1");
var stickyb = headerb.offsetTop;
function myFunctionb(){
if(window.pageYOffset > stickyb){
headerb.classList.add("sticky");
} else {
headerb.classList.remove("sticky");
}
}

var headerb1 = document.getElementById("dialog-form1b");
var stickyb1 = headerb1.offsetTop;
function myFunctionb1(){
if(window.pageYOffset > stickyb1){
headerb1.classList.add("sticky");
} else {
headerb1.classList.remove("sticky");
}
}

var headerc = document.getElementById("dialog-form2");
var stickyc = headerc.offsetTop;
function myFunctionc(){
if(window.pageYOffset > stickyc){
headerc.classList.add("sticky");
} else {
headerc.classList.remove("sticky");
}
}

var headerd = document.getElementById("dialog-form3");
var stickyd = headerd.offsetTop;
function myFunctiond(){
if(window.pageYOffset > stickyd){
headerd.classList.add("sticky");
} else {
headerd.classList.remove("sticky");
}
}
</script>
</body>
</html>