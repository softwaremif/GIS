<?php
//include "../config/koneksi.php";
?>
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

#hor-minimalist-a
{
	/* font-family:"Arial"; */
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
.datagrid-row-expand,.datagrid-row-collapse{
	background:transparent;
}
</style>
<script type="text/javascript">
var url;

$(function(){
tnewp();

// $('#dg2b').datagrid({
// 	onLoadSuccess:function(data){
// 		for(var i=0; i<data.rows.length; i++){
// 			if (data.rows[i].count == 0){
// 				$(this).datagrid('getExpander', i).hide();
// 			}
// 		}
// 	}
// });

// onCheck:function(){ menu(); cekgroup(); },
// onUncheck:function(){ menu(); },
// onCheckAll:function(){ menu(); cekgroup(); },
// onUncheckAll:function(){ menu2(); }

$('#dg2b').datagrid({
// onClickRow: function(index,row){
// menu(); 
// cekgroup(); 
// var expander = $(this).datagrid('getExpander', index);
// if (expander.hasClass('datagrid-row-expand')){
// $(this).datagrid('expandRow',index);                     
// } else { 
// $(this).datagrid('collapseRow',index);
// // $('#dg2b').datagrid('reload');
// }
// }
// onCheck: function(index,row){
// // alert(row.popk);
// menu();
// checkgroup();
// var expander = $(this).datagrid('getExpander', index);
// if (expander.hasClass('datagrid-row-expand')){
// $(this).datagrid('expandRow',index);                     
// } else { 
// $(this).datagrid('collapseRow',index);
// // $('#dg2b').datagrid('reload');
// }
// },
});
});

$(function(){
$('#dg2b').datagrid({
onCheck: function(index, row) {
  $('#dg2b').datagrid('expandRow',index);    
  menu(); 
  cekgroup();                 
},

onUncheck: function(index, row) {                   
  $('#dg2b').datagrid('collapseRow',index);
  menu();
},

onCheckAll: function(index, row) {
  // $('#dg2b').datagrid('expandRow',index);    
  menu(); 
  cekgroup();                 
},

onUncheckAll: function(index, row) {                   
  // $('#dg2b').datagrid('collapseRow',index);
  menu2();
},

view: detailview,
detailFormatter:function(index,row){
return '<div style="padding:2px;position:relative;"><table class="ddv" style="width:100%;"></table></div>';
},

onExpandRow: function(index,row){
var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
ddv.datagrid({
url:'view/get_proses2c.php?user=<?php echo $_SESSION['user']; ?>&pono='+row.pono,
fitColumns:false,
multiple:true,
rownumbers:false,
collapsible:false,
loadMsg:'',
autoRowHeight: true,
height:'auto',
idField:'podtpk',
border:true,
// onCheck:function(){ menu(); },
// onUncheck:function(){ menu(); },
// onCheckAll:function(){ menu(); },
// onUncheckAll:function(){ menu2(); },
// ctrlSelect:true,
// checkOnSelect:true,
columns:[[
{field:'ordno',title:'Order no',width:100},
{field:'item',title:'Item',width:120},
{field:'spec',title:'Specification',width:135},
{field:'supnm',title:'Supplier',width:130},
{field:'sizegar',title:'Size',width:75},
{field:'colname',title:'Color',width:75},
{field:'price',title:'Price',width:85},
{field:'pocons',title:'Qty',width:75},
{field:'unit',title:'Unit',width:50},
{field:'tgljam2',title:'Req Date',width:120},
{field:'etd',title:'Delivery ETD',width:105}
]],

onResize:function(){
//$('#dg2b').datagrid('fixDetailRowHeight',index);
},
onLoadSuccess:function(){
// $(this).datagrid('lockColumn', 'ordno');
// $(this).datagrid('lockColumn', 'item');
// $(this).datagrid('lockColumn', 'spec');
// $(this).datagrid('lockColumn', 'supnm');
// $(this).datagrid('lockColumn', 'sizegar');
// $(this).datagrid('lockColumn', 'colname');
// $(this).datagrid('lockColumn', 'price');
// $(this).datagrid('lockColumn', 'qty');
// $(this).datagrid('lockColumn', 'unit');
// $(this).datagrid('lockColumn', 'tgljam2');
// $(this).datagrid('lockColumn', 'poregdel2');
// var sup = $(this).datagrid('getColumnOption', 'supnm');
//       $('.' + sup.cellClass).each(function(){
//          var style = $(this).attr('style');
//         $(this).attr('style',style+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
//       });
//       var item = $(this).datagrid('getColumnOption', 'item');
//       $('.' + item.cellClass).each(function(){
//          var style2 = $(this).attr('style');
//         $(this).attr('style',style2+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
//       });
//        var spec = $(this).datagrid('getColumnOption', 'spec');
//       $('.' + spec.cellClass).each(function(){
//          var style3 = $(this).attr('style');
//         $(this).attr('style',style3+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
//       });
//       var sizegar = $(this).datagrid('getColumnOption', 'sizegar');
//       $('.' + sizegar.cellClass).each(function(){
//          var style4 = $(this).attr('style');
//         $(this).attr('style',style4+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
//       });
//       var colname = $(this).datagrid('getColumnOption', 'colname');
//       $('.' + colname.cellClass).each(function(){
//          var style5 = $(this).attr('style');
//         $(this).attr('style',style5+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
//       });
// setTimeout(function(){
// $('#dg2b').datagrid('fixDetailRowHeight',index);
// },0);
},
onSelect: function() {
getSelected(index);
},

});
$('#dg2b').datagrid('fixDetailRowHeight',index);
},
// onLoadSuccess: function(){
// var dg = $('#dg2b');
// var count = dg.datagrid('getRows').length;
// for(var i=0; i<count; i++){
//   dg.datagrid('expandRow',i);
//   dg.datagrid('getExpander',i).hide();
// }
// }
});
});

$(function(){
$('#dg1b').datagrid({
view: detailview,
detailFormatter:function(index,row){
return '<div style="padding:2px"><table class="ddv"></table></div>';
},
onExpandRow: function(index,row){
var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
ddv.datagrid({
url:'view/get_proses2f.php?user=<?php echo $_SESSION['user']; ?>&ordpk='+row.ordpk,
fitColumns:true,
singleSelect:true,
rownumbers:false,
loadMsg:'',
height:'auto',
columns:[[
{field:'pono',title:'PO',width:100},
{field:'item',title:'Item',width:120},
{field:'spec',title:'Specification',width:147},
{field:'supnm',title:'Supplier',width:130},
{field:'sizegar',title:'Size',width:75},
{field:'colname',title:'Color',width:75},
{field:'price',title:'Price',width:85},
{field:'pocons',title:'Qty',width:75},
{field:'unit',title:'Unit',width:50},
{field:'tgljam2',title:'Req Date',width:120},
{field:'etd',title:'Delivery ETD',width:110}
]],
onResize:function(){
$('#dg1b').datagrid('fixDetailRowHeight',index);
},
onLoadSuccess:function(){
ddv.datagrid('getPanel').addClass('lines-no4');
$(this).datagrid('lockColumn', 'pono');
$(this).datagrid('lockColumn', 'item');
$(this).datagrid('lockColumn', 'spec');
$(this).datagrid('lockColumn', 'supnm');
$(this).datagrid('lockColumn', 'sizegar');
$(this).datagrid('lockColumn', 'colname');
$(this).datagrid('lockColumn', 'price');
$(this).datagrid('lockColumn', 'qty');
$(this).datagrid('lockColumn', 'unit');
$(this).datagrid('lockColumn', 'tgljam2');
$(this).datagrid('lockColumn', 'poregdel2');
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
setTimeout(function(){
  $('#dg1b').datagrid('fixDetailRowHeight',index);
 },0);
}
});
$('#dg1b').datagrid('fixDetailRowHeight',index);
},
});
});

//$(document).ready(function(){
//	$('#dg1a').hide();
//});

function viewpo1(){
$('#viewop').hide();
$('#tabel1b').show();
$('#grs').show();
$('#grsa').hide();
$('#curra').hide();
$('#grs2').show();
$('#viewpo').show();
$('#tabel1a').hide();
Search();
///var count2a= JSON.stringify($('#dg2a').datagrid('getData').total);
//if(count2a==0){
//$('#tabel1b').css('margin-top','-60px');
//var dg2a= $('#dg2a');
//dg2a.datagrid();
//dg2a.datagrid('getPanel').find('div.datagrid-header').css('display','none');
//dg2a.datagrid('getPanel').css('border','none');
//$('#grs').hide();
//}
//var count2d= JSON.stringify($('#dg2d').datagrid('getData').total);
//if(count2d==0){
//var dg2d= $('#dg2d');
//dg2d.datagrid();
//dg2d.datagrid('getPanel').find('div.datagrid-header').css('display','none');
//dg2d.datagrid('getPanel').css('border','none');
//}
var count2b= JSON.stringify($('#dg2b').datagrid('getData').total);
if(count2b==0){
var dg2b= $('#dg2b');
dg2b.datagrid();
dg2b.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg2b.datagrid('getPanel').css('border','none');
$('#grs2b').hide();
$('#curr').hide();
}
//$('#curr').css('margin-top','30px');
$('#tabel1b').css('margin-top','-25px');
}

function viewpo2(){
$('#viewop').show();
$('#viewpo').hide();
$('#grs').hide();
$('#grs2').hide();
$('#tabel1b').hide();
$('#tabel1').show();
$('#grsa').show();
$('#curra').show();
$('#tabel1a').show();
Search();
}

function Search(){
$('#dg1a').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
$('#dg1b').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
$('#dg1c').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
$('#dg1d').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
$('#dg2a').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
$('#dg2b').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
$('#dg2c').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
$('#dg2d').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
// tnewp();
tnewp2();
//tnewp3();
//tnewp4();
//var count= JSON.stringify($('#dg').datagrid('getData').total);
//if(count==0){
//var dg= $('#dg');
//dg.datagrid();
//dg.datagrid('getPanel').find('div.datagrid-header').css('display','none');
//dg.datagrid('getPanel').css('border','none');
//}
}

function tnewp(){
var cari1 = $('#cari1').val();
var cari2 = $('#cari2').val();
var cari3 = $('#cari3').val();
$.ajax({
type:"POST",
url:"view/get_proses1b.php?user=<?php echo $_SESSION['user']; ?>&cari2="+cari2+"&cari3="+cari3,
data:"cari1="+cari1,
success:function(data){
// alert(data);
if(data==0){
//$('#tabel1a').hide();
// $('#dg2a').datagrid('getPanel').css('border','none');
// $('#dg1a').datagrid('getPanel').css('border','none');
// $('#frame-utama-judul').hide();
$('#assignpo').hide();
// $('#tabel1a').css('top','150px');
// $('#tabel1b').css('top','190px');
// $('#grs1a').hide();
// $('#grs2a').hide();
}else{
// $('#tabel1a').show();
// $('#dg2a').datagrid('getPanel').css('border','1px solid #E0E0E0');
// $('#dg1a').datagrid('getPanel').css('border','1px solid #E0E0E0');
// $('#frame-utama-judul').show();
$('#assignpo').show();
// $('#grs1a').show();
// $('#grs2a').show();
}
},
});
}

function tnewp2(){
var cari1 = $('#cari1').val();
var cari2 = $('#cari2').val();
var cari3 = $('#cari3').val();
$.ajax({
type:"POST",
url:"view/get_proses4b.php?user=<?php echo $_SESSION['user']; ?>&cari2="+cari2+"&cari3="+cari3,
data:"cari1="+cari1,
success:function(data){
if(data==0){
//$('#tabel1a').hide();
$('#dg2d').datagrid('getPanel').css('border','none');
$('#dg1c').datagrid('getPanel').css('border','none');
$('#grs1c').hide();
$('#grs2c').hide();
}else{
$('#dg2d').datagrid('getPanel').css('border','1px solid #E0E0E0');
$('#dg1c').datagrid('getPanel').css('border','1px solid #E0E0E0');
$('#grs1c').show();
$('#grs2c').show();
//$('#dg1c').datagrid('load',{
//cari1: $('#cari1').val(),
//cari2: $('#cari2').val(),
//cari3: $('#cari3').val()
//});
}
},
});
}

function tnewp3(){
var cari1 = $('#cari1').val();
var cari2 = $('#cari2').val();
var cari3 = $('#cari3').val();
$.ajax({
type:"POST",
url:"view/get_proses4ba.php?user=<?php echo $_SESSION['user']; ?>&cari2="+cari2+"&cari3="+cari3,
data:"cari1="+cari1,
success:function(data){
if(data==0){
//$('#tabel1a').hide();
$('#dg1d').datagrid('getPanel').css('border','none');
}else{
$('#dg1d').datagrid('getPanel').css('border','1px solid #E0E0E0');
//$('#dg1d').datagrid('load',{
//cari1: $('#cari1').val(),
//cari2: $('#cari2').val(),
//cari3: $('#cari3').val()
//});
}
},
});
}

//function tnewp4(){
//var cari1 = $('#cari1').val();
//var cari2 = $('#cari2').val();
//var cari3 = $('#cari3').val();
//$.ajax({
//type:"POST",
//url:"view/get_proses2ea.php?user=<?php //echo $_SESSION['user']; ?>&cari2="+cari2+"&cari3="+cari3,
//data:"cari1="+cari1,
//success:function(data){
//if(data==0){
////$('#tabel1a').hide();
//$('#dg1b').datagrid('getPanel').css('border','none');
//}else{
//$('#dg1b').datagrid('getPanel').css('border','1px solid #E0E0E0');
////$('#dg1b').datagrid('load',{
////cari1: $('#cari1').val(),
////cari2: $('#cari2').val(),
////cari3: $('#cari3').val()
////});
//}
//},
//});
//}

function count_row(){
	$('#myHeader').show();
    var count = $('#dg2b').datagrid('getChecked').length;
    if (count) {
    if(count>1){
    $('#mview').hide();
    $('#massign').hide();
    $('#count').css('margin-right','60%'); 
    } else {
    $('#mview').show();
    $('#massign').show();
    $('#count').css('margin-right','42%'); 
    }
    document.getElementById("count").innerHTML = count +" items selected";
    } else {
		document.getElementById("count").innerHTML = 0 +" items selected";
		}
}

function menu(){
	var row = $('#dg2b').datagrid('getSelected');
	if(row){
	$('#myHeader').show();
  count_row();
	} else {
	$('#myHeader').hide();
	$('#dg2b').datagrid('clearSelections');
	}
}

function menu2(){
$('#myHeader').hide();
$('#dg2b').datagrid('clearSelections');
$('#dg2b').datagrid('clearChecked');
$('#dg2b').datagrid('reload');
}

/*function canpo1(){
var row = $('#dg2b').datagrid('getSelected');
	if(row){
  if(row.postatpk==4){
		$('#dialog-form1c').dialog('open').dialog('setTitle','');
		$('#form1c').form('load',row);
  } else {
  $('#dialog-form1b').dialog('open').dialog('setTitle','');
		$('#form1b').form('load',row);
  }
 }
}*/

function canpo1(){
var ids = [];
var rows = $('#dg2b').datagrid('getSelections');
var row = $('#dg2b').datagrid('getSelected');
if(row){
if(row.postatpk==4){
$('#dialog-form1c').dialog('open').dialog('setTitle','');
$('#form1c').form('load',row);
} else {
for(var i=0; i<rows.length; i++){
ids.push(rows[i].popk);
}
//$.messager.confirm('Confirm','Are you sure you want to delete this material?',
//function(r){
//if (r){
// We loop through each project and then delete it
$.each(ids, function (index, value){
$.post('action/simpan.php?x=canpo1',{id:value},function(result){
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
      $('#dialog-form1b').dialog('open').dialog('setTitle','');
      $('#form1b').form('load',row);
						$('#dg2b').datagrid('reload');
} else {
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
//}//reload the user data
//});
}
//} else {
//$.messager.alert('Warning','You are not allowed to delete this material, please contact your supervisor','warning');
//}
}
}

function canpo2(id){
 var c=id;
 document.getElementById('popk').value=c;
	$('#dialog-form1b2').dialog('open').dialog('setTitle','');
 $('#form1b2').form('load',row);
}

function canpo2b(id){
 var c=id;
 document.getElementById('popk').value=c;
	$('#dialog-form1c').dialog('open').dialog('setTitle','');
 $('#form1c').form('load',row);
}

/*function purchasing(){
var row = $('#dg2b').datagrid('getSelected');
	if(row){
		$('#dialog-form2b').dialog('open').dialog('setTitle','');
		$('#form2b').form('load',row);
 }
}*/

function purchasing(){
var ids = [];
var rows = $('#dg2b').datagrid('getSelections');
var row = $('#dg2b').datagrid('getSelected');
if(row){
if(row.postatpk==4){
$('#dialog-form1c').dialog('open').dialog('setTitle','');
$('#form1c').form('load',row);
} else {
for(var i=0; i<rows.length; i++){
ids.push(rows[i].popk);
}
//$.messager.confirm('Confirm','Are you sure you want to delete this material?',
//function(r){
//if (r){
// We loop through each project and then delete it
$.each(ids, function (index, value){
$.post('action/simpan.php?x=purchasing1',{id:value},function(result){
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
      $('#dialog-form2b').dialog('open').dialog('setTitle','');
      $('#form2b').form('load',row);
						$('#dg2b').datagrid('reload');
} else {
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
//}//reload the user data
//});
}
//} else {
//$.messager.alert('Warning','You are not allowed to delete this material, please contact your supervisor','warning');
//}
}
}

function saveassign(){
var string = $("#form2b").serialize();
	 $('#form2b').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=purchasing&user=<?php echo $_SESSION['user']; ?>",
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
			$('#dialog-form2b').dialog('close');
			$('#form2b').form('reset');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
   $('#dg2c').datagrid('reload');
			$('#dg2b').datagrid('reload');
   $('#dg2b').datagrid('clearSelections');
   $('#dg2b').datagrid('clearChecked');
		}
	 });
}

function canassign(){
var string = $("#form2b").serialize();
	 $('#form2b').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=purchasing2&user=<?php echo $_SESSION['user']; ?>",
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
			$('#dialog-form2b').dialog('close');
			$('#form2b').form('reset');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg2b').datagrid('reload');
		}
	 });
}

function canpo1b(){
var string = $("#form1b").serialize();
	 $('#form1b').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=canpo2&user=<?php echo $_SESSION['user']; ?>",
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
   $('#dg2b').datagrid('reload');
   $('#dg2b').datagrid('clearSelections');
   $('#dg2b').datagrid('clearChecked');
		}
	 });
}

function savecanpo(){
var string = $("#form1b").serialize();
	 $('#form1b').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=canpo&user=<?php echo $_SESSION['user']; ?>",
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
    window.location.href="?hal=proses&x=1";
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			/*$('#dg2a').datagrid('reload');
   $('#dg2b').datagrid('reload');
   $('#dg2c').datagrid('reload');
   $('#dg2b').datagrid('clearSelections');
   $('#dg2b').datagrid('clearChecked');*/
		}
	 });
}

function savecanpo2(){
var string = $("#form1b2").serialize();
	 $('#form1b2').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=savecanpo&user=<?php echo $_SESSION['user']; ?>",
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
			$('#dialog-form1b2').dialog('close');
			$('#form1b2').form('reset');
    window.location.href="?hal=proses&x=1";
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			/*$('#dg2a').datagrid('reload');
   $('#dg2b').datagrid('reload');
   $('#dg2c').datagrid('reload');
   $('#dg2b').datagrid('clearSelections');
   $('#dg2b').datagrid('clearChecked');*/
		}
	 });
}

$(function(){
notif();
tnewp();
Search();
var dg1a= $('#dg1a');
//var dg1b= $('#dg1b');
var dg1c= $('#dg1c');
var dg1d= $('#dg1d');
var dg2a= $('#dg2a');
var dg2b= $('#dg2b');
var dg2c= $('#dg2c');
var dg2d= $('#dg2d');
//dg2a.datagrid();
////dg2b.datagrid();
////dg2c.datagrid();
//dg2d.datagrid();
dg2c.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg1a.datagrid('getPanel').find('div.datagrid-header').css('display','none');
//dg1b.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg1c.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg1d.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg2a.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg2d.datagrid('getPanel').find('div.datagrid-header').css('display','none');
$('#dg2da').datagrid('getPanel').find('div.datagrid-header').css('display','none');
$('#dg1a').datagrid('getPanel').addClass('lines-no4');
//$('#dg1b').datagrid('getPanel').addClass('lines-no4');
$('#dg1c').datagrid('getPanel').addClass('lines-no4');
$('#dg1d').datagrid('getPanel').addClass('lines-no4');
$('#dg2a').datagrid('getPanel').addClass('lines-no4');
$('#dg2b').datagrid('getPanel').addClass('lines-no4');
//$('#dg2b').datagrid('getPanel').addClass('lines-no');
//$('#dg2b').datagrid('getPanel').find('div.datagrid-header').css('border','');
$('#dg2d').datagrid('getPanel').addClass('lines-no4');
$('#dg2c').datagrid('getPanel').addClass('lines-no4');
//$('#dg1a').datagrid('getPanel').addClass('lines-no2');
//$('#dg1a').datagrid('getPanel').addClass('col');
//$('#dg2a').datagrid('getPanel').addClass('lines-no');
//$('#dg2a').datagrid('getPanel').addClass('lines-no2');
//$('#dg2a').datagrid('getPanel').addClass('col');
//$('#dg2b').datagrid('getPanel').addClass('lines-no');
//$('#dg2b').datagrid('getPanel').addClass('lines-no2');
//$('#dg2b').datagrid('getPanel').addClass('col');
//$('#dg2c').datagrid('getPanel').addClass('lines-no');
//$('#dg2c').datagrid('getPanel').addClass('lines-no2');
//$('#dg2c').datagrid('getPanel').addClass('col');
//$('#dg2d').datagrid('getPanel').addClass('lines-no');
//$('#dg2d').datagrid('getPanel').addClass('lines-no2');
//$('#dg2d').datagrid('getPanel').addClass('col');

// var dialog = $("#dialog").val();
// if(dialog==1){
// viewpo1();
// tnewp();
// //$('#tabel1b').css("margin-top","0px");
// dg2b.datagrid('getPanel').find('div.datagrid-header').css('display','');
// dg2b.datagrid('getPanel').css('border','1px solid #E0E0E0');
// dg2d.datagrid('getPanel').css('border','1px solid #E0E0E0');
// $('#grs').show();
// $('#curr').show();
// }
});

function toggle(source){
checkboxes = document.getElementsByName('ckk');
for(var i=0, n=checkboxes.length;i<n;i++){
checkboxes[i].checked = source.checked;
}
}

/*view*/
function viewpono(){
var rows = $('#dg2b').datagrid('getSelected');
	if(rows){
      window.location.href="?hal=detpomd&x=1&po="+rows.popk;
 } else {
		$.messager.alert('Warning','No PO data selected','warning');
	}
}

function viewpono2(){
var rows = $('#dg2b').datagrid('getSelected');
	if(rows){
    /*if(rows.postatpk==3){
   $.messager.alert('Warning','PO data status cancel','warning');
  } else {*/
	url = "?hal=detpomd&x=1&po="+rows.popk;
  window.open(url);
	//window.location.href="?hal=qty&ord=" +row.ordpk;
	/*}*/
 } else {
		$.messager.alert('Warning','No PO data selected','warning');
	}
}

function viewpono3(){
var rows = $('#dg2c').datagrid('getSelected');
	if(rows){
//  alert('test');
}
}

/*function canpo(){
var ids = [];
var rows = $('#dg2b').datagrid('getSelections');
for(var i=0; i<rows.length; i++){
ids.push(rows[i].popk);
}
$.messager.confirm('Confirm','Are you sure you want to cancel this PO?',
function(r){
if (r){
// We loop through each project and then delete it
$.each(ids, function (index, value){
$.post('action/simpan.php?x=canpo',{id:value},function(result){
if (result.success){
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:330,
	height:55,
	style:{
    left:0,
    right:'',
    top:'',
    bottom:-document.body.scrollTop-document.documentElement.scrollTop
    }
    });
$('#dg2a').datagrid('reload');
$('#dg2b').datagrid('reload');
$('#dg2b').datagrid('clearSelections');
} else {
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:330,
	height:55,
	style:{
    left:0,
    right:'',
    top:'',
    bottom:-document.body.scrollTop-document.documentElement.scrollTop
    }
    });
}
},'json');
});
}
});
}*/
function canproses(){
var row = $('#dg2b').datagrid('getSelected');
	if(row){
		$('#dialog-form2').dialog('open').dialog('setTitle','');
    document.getElementById('crpopk').value=row.popk;
    $('#dg2da').datagrid('load',{
    crpopk: $('#crpopk').val()
    });
    var dg2da=$('#dg2da');
    dg2da.datagrid();
    dg2da.datagrid('getPanel').find('div.datagrid-header').css('display','none');
    
$('#dg2da').datagrid({
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
width:'1125',
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
$('#dg2da').datagrid('fixDetailRowHeight',index);
},
onLoadSuccess:function(){
setTimeout(function(){
$('#dg2da').datagrid('fixDetailRowHeight',index);
},0);
}
});
$('#dg2da').datagrid('fixDetailRowHeight',index);
},
onLoadSuccess: function(){
var dg2da = $('#dg2da');
var count = dg2da.datagrid('getRows').length;
for(var i=0; i<count; i++){
  dg2da.datagrid('expandRow',i);
}
}
});
 }
}

function reassign(){
var row = $('#dg2b').datagrid('getSelected');
	if(row){
  if(row.postatpk==4){
		$('#dialog-form2c').dialog('open').dialog('setTitle','');
		$('#form2c').form('load',row);
  } else {
		$('#dialog-form2').dialog('open').dialog('setTitle','');
		$('#form2').form('load',row);
  document.getElementById("carpo").value= row.popk;
  
    $('#dg2da').datagrid('load',{
    carpo: $('#carpo').val()
    });
 }
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
  document.getElementById("suppk3b").value= row.suppk;
  document.getElementById("spec3b").innerHTML= row.item;
  document.getElementById("popk3").value= row.popk;
  document.getElementById("popk3b").value= row.popk;
  
    $('#dg2e').datagrid('load',{
    suppk3: $('#suppk3b').val()
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
$('#dg2b').datagrid('reload');
$('#dg2da').datagrid('clearSelections');
$('#dg2da').datagrid('clearChecked');
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
   $('#dg2da').datagrid('clearSelections');
   $('#dg2da').datagrid('clearChecked');
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
			$('#dg2b').datagrid('reload');
   $('#dg2b').datagrid('clearChecked');
   $('#dg2b').datagrid('clearSelections');
   $('#dg2da').datagrid('reload');
   $('#dg2da').datagrid('clearSelections');
   $('#dg2da').datagrid('clearChecked');
		}
	 }); 
}

/*function purchasing(){
var ids = [];
var rows = $('#dg2b').datagrid('getSelections');
for(var i=0; i<rows.length; i++){
ids.push(rows[i].popk);
}
$.messager.confirm('Confirm','Are you sure you want to assign this PO to purchasing?',
function(r){
if (r){
// We loop through each project and then delete it
$.each(ids, function (index, value){
$.post('action/simpan.php?x=purchasing',{id:value},function(result){
if (result.success){
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:330,
	height:55,
	style:{
    left:0,
    right:'',
    top:'',
    bottom:-document.body.scrollTop-document.documentElement.scrollTop
    }
    });
$('#dg2b').datagrid('reload');
$('#dg2b').datagrid('clearSelections');
} else {
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:330,
	height:55,
	style:{
    left:0,
    right:'',
    top:'',
    bottom:-document.body.scrollTop-document.documentElement.scrollTop
    }
    });
}
},'json');
});
}
});*/
/*win.window('move',{
	left:550,
	top:500
})*/
//}

function formatku(val,row){
        return '<div style=height:25px;padding:3px;><span style=font-style:normal;font-weight: 400;font-size: 16px;line-height:20px;color:#000000;>PO&nbsp;&nbsp;'+val+
        '</span>&nbsp;&nbsp;&nbsp;'+row.status+'&nbsp;&nbsp;<span style=color:#EF3B42;>'+row.tdelmat+'</span>&nbsp;&nbsp;&nbsp;'+row.tpo+'&nbsp;Materials'+
        '&nbsp;&nbsp;&nbsp;&nbsp;<a href=?hal=detpomd&x=1&po='+row.popk+' style=text-decoration:none;color:#359DD9;font-style:normal;font-weight:400;font-size:14px;line-height:18px;>View detail</a></div>';
}

function formatku2(value,rows){
     return 'OP &nbsp;'+value+
    '<br><div style="width:101%;"><table style="margin-left:-17px;" border="1" id="hor-minimalist-a">'+
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
    '<th width="115">Requested Deliv.</th>'+
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
    '<br><div style="width:101.5%;"><table style="margin-left:-19px;" border="1" id="hor-minimalist-a">'+
    '<thead>'+
    '<tr style="height:30px;background-color:#F1F1F1;">'+
    '<th width="100">Order no</th>'+
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

function prosespo(){
 var thn=$('#cari3').val();
 window.location.href="action/simpan?x=prosespo2&user=<?php echo $_SESSION['user']; ?>&thn="+thn; 
}

function Search2(){
$('#dg2e').datagrid('load',{
caripo: $('#caripo').val(),
suppk3: $('#suppk3b').val()
});
}

// function selectpo(){
// }

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
    
$(function(){
 $.extend($.fn.datagrid.methods, {
    lockColumn: function(jq, field){
        return jq.each(function(){
            var p = $(this).datagrid('getPanel');    // get the panel
            var cell = p.find('div.datagrid-header td[field=' + field + '] > div.datagrid-cell'); // get the cell
            cell.resizable({disabled:true}); // disable resize
        });
    }
});
});

function clsnotif(){
  $.ajax({
					type	: "POST",
					url	: "action/simpan.php?x=tpo1b",
					success	: function(){
      //window.location.href="?hal=proses";
      $('#ntf1b').hide();
     }
				});
}

function clsdelsts(){
 var cari3 = $('#cari3').val();
  $.ajax({
					type	: "POST",
					url	: "action/simpan.php?x=tdel1&thn="+cari3,
     data : "user=<?php echo $_SESSION['user']; ?>",
					success	: function(data){
      //window.location.href="?hal=proses";
      $('#ntfdelmat').hide();
     },
				});
}

function clsdelsts2(){
 var cari3 = $('#cari3').val();
  $.ajax({
					type	: "POST",
					url	: "action/simpan.php?x=tdel2&thn="+cari3,
     data : "user=<?php echo $_SESSION['user']; ?>",
					success	: function(data){
      //window.location.href="?hal=proses";
      $('#ntfdelmat2').hide();
     },
				});
}

function notif(){
var a= document.getElementById('ttpo1b').value;
var b= document.getElementById('tdelmat1').value;
var c= document.getElementById('tdelmat2').value;
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
}

function savewh(){
		var string = $("#formwh").serialize();
	 $('#formwh').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=formwh2b",
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
			$('#dialog-formwh').dialog('close');
			$('#formwh').form('reset');
   $('#dialog-form3').dialog('close');
			$('#form3').form('reset');
   $('#dialog-form2').dialog('close');
			$('#form2').form('reset');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg2b').datagrid('reload');
   $('#dg2da').datagrid('reload');
   $('#dg2da').datagrid('clearSelections');
   $('#dg2da').datagrid('clearChecked');
		}
	 });
}

function cancelwh(){
			$('#dialog-formwh').dialog('close');
			$('#formwh').form('reset');
}

function stock(){
			$('#dialog-formwh').dialog('open').dialog('setTitle','');
			//$('#formwh').form('reset');
}

function cekgroup(){
	//cari = $('#cari2').val();
    var ids = [];
    var rows = $('#dg2b').datagrid('getSelections');
    var row = $('#dg2b').datagrid('getSelected');
    if (row) {
        var aaa = row.postatpk;
    }
    for(var i=0; i<rows.length; i++){
    ids.push(rows[i].postatpk);
       if (ids[i]!= aaa) {
         //$.messager.alert('Warning','Handle must be same','warning');
           //$('#dialog-form1c').dialog('open').dialog('setTitle','');
           //$('#form1c').form('load',row);
         $('#dg2b').datagrid('clearChecked');
       } else {

       }
    }
}

function refreshdg(){
$('#dg1a').datagrid('reload');
$('#dg1b').datagrid('reload');
$('#dg1c').datagrid('reload');
$('#dg1d').datagrid('reload');

$('#dg2a').datagrid('reload');
$('#dg2b').datagrid('reload');
$('#dg2c').datagrid('reload');
$('#dg2d').datagrid('reload');
}

function polist(){
    // var cek = $('input[name="cek"]:checked').attr("value");
	var thn = $('#cari3').val();
	// alert(cek);
      url = "excel/excel_listpo?thn="+thn+"&fu=<?php echo $_SESSION['fu']; ?>";
      window.open(url);
  }
</script>
</head>
<body>
<?php
$ord=$_GET['ordpk'];
// echo $_SESSION['fu'];
?>
<input type="hidden" id="dialog" value="<?php echo $_GET['x']; ?>">
<div class="contenta">
<div id="judul">
Purchase orders
</div>
<div id="frame-utama-cari" style="left:18%;top:100px; width:44%;">
<div id="container-cari">
<div id="frame-cari" >
<img src="css/images/Shape.png" plain="true" width="18px" height="18px" onclick="">
<input id="cari1" placeholder="Search..." class="input" onkeyup="Search();">
</div>
</div>
<input style="margin-top:-2px;margin-left:0px;" type="button" name="submit" id="upld" value="Export" class="button-submit-add" onclick="polist();">
<div>
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
<img src="css/images/reload1.png" width="20px" height="20px"  onclick="refreshdg();" id="reload" style="margin-top:5px;">
<!-- <div id="viewop" style="margin-left:270px;"><a href="javascript:void(0)" plain="true" onclick="viewpo1();" style="text-decoration: none; color:#000000;"><img src="css/images/eye-fill.svg"> by OP </a></div>
<div id="viewpo" style="display:none;margin-left:270px;"><a href="javascript:void(0)" plain="true" onclick="viewpo2();" style="text-decoration: none; color:#000000;"><img src="css/images/eye-fill.svg"> by PO</a></div> -->
</div>
<div id="frame-utama-judul" style="top:150px;">
<div class="frame-judul" style="width:auto;color: rgba(0, 0, 0, 0.6); font-size: 16px; line-height: 20px; font-weight:700;">
Awaiting PO assignment
</div>
<div class="frame-judul" id="assignpo" style="width:auto;display:none;">
<a href="javascript:void(0);" onclick="prosespo();" plain="true" style="font-size: 16px; line-height: 20px; font-weight:700; color:#359DD9; text-decoration: none;"> Assign POs </a>
</div>
</div>

<!-- View By OP -->
<div id="tabel1a" style="display:none;">
<table id="dg1a" class="easyui-datagrid" title="" style="width:95%;" align="center"
url="view/get_proses1.php?user=<?php echo $_SESSION['user']; ?>"
data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,fitColumns:true,view:groupview,border:true,autoRowHeight:true,  
groupField:'ordno',groupFormatter:formatku2,
groupStyler:function(value,rows){
return 'height:68px;padding:10px;'
},
onLoadSuccess:wrap">
<thead>
<tr>
<th field="pono" width="100" align="center">PO</th>
<th field="item" width="120">Item</th>
<th field="spec" width="147">Specification</th>
<th field="supnm" width="130" formatter="formatku3">Supplier</th>
<th field="sizegar" width="75">Size</th>
<th field="colname" width="75">Color</th>
<th field="price" width="100">Price</th>
<th field="pocons" width="75">Qty</th>
<th field="unit" width="70">Units</th>
<th field="tgljam2" width="130">Req Date</th>
<th field="etd" width="115">Requested Deliv.</th>
</tr>
</thead>
</table>
<br>
<hr id="grs1a" style="width:100%;height:auto;border:1px solid #D6D6D6;">
<div id="curra" style="text-align:left;padding:5px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">
Current purchase orders
</div><br>
<table id="dg1b" style="width:95%;height:auto"
url="view/get_proses2e.php?user=<?php echo $_SESSION['user']; ?>" singleSelect="true" fitColumns="true">
<thead>
<tr>
<th field="ordno" width="125"></th>
</tr>
</thead>
</table>
<!--<table id="dg1b" class="easyui-datagrid" title="" style="width:95%;height:auto;" align="center"
url="view/get_proses2e.php?user=<?php //echo $_SESSION['user']; ?>"
data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,fitColumns:true,view:groupview,border:true,
groupField:'ordno',groupFormatter:formatku2,
groupStyler:function(value,rows){
return 'height:68px;padding:10px;';}">
<thead>
<tr>
<th field="pono" width="100" align="center">PO</th>
<th field="item" width="120">Item</th>
<th field="spec" width="147">Specification</th>
<th field="supnm" width="130" formatter="formatku3">Supplier</th>
<th field="sizegar" width="75">Size</th>
<th field="colname" width="75">Color</th>
<th field="price" width="100">Price</th>
<th field="qty" width="75">Qty</th>
<th field="unit" width="70">Units</th>
<th field="tgljam2" width="130">Req Date</th>
<th field="poreqdel2" width="115">Delivery ETD</th>
</tr>
</thead>
</table>--><br>

<hr id="grs1b" style="width:100%;border:1px solid #D6D6D6;">
<br>
<div style="text-align:left;padding:5px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">
Outsourced
</div>
<div style="text-align:left;padding:5px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
The following items are still waiting for PO assignment
</div>
<!--Tabel 4-->
<table id="dg1c" class="easyui-datagrid" title="" style="width:95%;height:auto;" align="center"
url="view/get_proses4.php?user=<?php echo $_SESSION['user']; ?>"
data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,fitColumns:true,view:groupview,border:true,
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
<th field="pocons" width="75">Qty</th>
<th field="unit" width="70">Units</th>
<th field="tgljam2" width="130">Req Date</th>
<th field="etd" width="115">Delivery ETD</th>
</tr>
</thead>
</table>
<br>
<hr id="grs1c" style="width:100%;border:1px solid #D6D6D6;">
<br>
<table id="dg1d" class="easyui-datagrid" title="" style="width:95%;height:auto;" align="center"
url="view/get_proses3c.php?user=<?php echo $_SESSION['user']; ?>" pageSize="100" pageList="[100,200,300,500]"
data-options="singleSelect:true,pagination:true,collapsible:true,rownumbers:false,fitColumns:true,view:groupview,border:true,
groupField:'ordno',groupFormatter:formatku2,
groupStyler:function(value,rows){
return 'height:68px;padding:10px;';
},
onLoadSuccess:wrap">
<thead>
<tr>
<th field="pono" width="100" align="center">PO</th>
<th field="item" width="120">Item</th>
<th field="spec" width="147">Specification</th>
<th field="supnm" width="130" formatter="formatku3">Supplier</th>
<th field="sizegar" width="75">Size</th>
<th field="colname" width="75">Color</th>
<th field="price" width="100">Price</th>
<th field="pocons" width="75">Qty</th>
<th field="unit" width="70">Units</th>
<th field="tgljam2" width="130">Req Date</th>
<th field="etd" width="115">Delivery ETD</th>
</tr>
</thead>
</table>
<br>
</div>

<!-- View By PO -->
<div id="tabel1b">
<!-- Tabel 1 -->
<table id="dg2a" class="easyui-datagrid" title="" style="width:95%;height:auto;" align="center"
url="view/get_proses1.php?user=<?php echo $_SESSION['user']; ?>"
data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,fitColumns:true,view:groupview,border:true,
groupField:'ordno',groupFormatter:formatku2
,groupStyler:function(value,rows){
    return 'height:68px;padding:10px;'
},
onLoadSuccess:wrap">
<thead>
<tr>
<th field="pono" width="100">PO</th>
<th field="item" width="120">Item</th>
<th field="spec" width="135">Specification</th>
<th field="supnm" width="135" formatter="formatku3">Supplier</th>
<th field="sizegar" width="75">Size</th>
<th field="colname" width="75">Color</th>
<th field="price" width="100">Price</th>
<th field="pocons" width="75">Qty</th>
<th field="unit" width="75">Units</th>
<th field="tgljam2" width="135">Req Date</th>
<th field="etd" width="120">Requested Deliv.</th>
</tr>
</thead>
</table>
<br>
<hr id="grs2a" style="width:100%;height:auto;border:1px solid #D6D6D6;">
<div id="curr" style="text-align:left;padding:5px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">
Current purchase orders
</div>
<!-- Tabel 2 -->
<div id="ntfdelmat2" style="padding: 5px;width: 1125px;height: 40px;background: #FF6B00;;box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12); border-radius: 8px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: #FFFFFF;">
<div style="margin-left:-1050px;margin-top:3px;"><img src="css/images/warning2.png" width="25" height="21"></div>
<div style="margin-left:-625px;margin-top:-15px;">&nbsp;&nbsp;&nbsp;&nbsp;A few items were deleted from your PO list, please review them</div>
<div style="margin-left:1075px;margin-top:-20px;font-size: 18px;line-height: 22px;color: #FFFFFF;cursor: pointer;" onclick="clsdelsts2();">&#10005;</div>
</div><br>
<table id="dg2b" class="easyui-datagrid" style="width:95%;height:auto;" align="center" pageSize="100" pageList="[100,200,300,500]"
url="view/get_proses2b.php?user=<?php echo $_SESSION['user']; ?>" idField="popk"
data-options="
pagination:true,
multiple:true,
collapsible:false,
rownumbers:false,
fitColumns:true,
autoRowHeight:true,
border:true,
ctrlSelect:true,
checkOnSelect:true">
<thead>
<tr>
<th field="ck" checkbox="true" width="100"></th>
<th field="pono" width="125" formatter="formatku">Select All PO's</th>
</tr>
</thead>
</table>
<br>
<hr id="grs2b" style="width:100%;border:1px solid #D6D6D6;">
<div style="text-align:left;padding:5px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">
Outsourced
</div>
<!-- <div style="text-align:left;padding:5px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
The following items are still waiting for PO assignment
</div> -->
<!--Tabel 4-->
<!-- <table id="dg2d" class="easyui-datagrid" title="" style="width:95%;height:auto;" align="center"
url="view/get_proses4.php?user=<?php //echo $_SESSION['user']; ?>"
data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,fitColumns:true,view:groupview,border:true,
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
<th field="pocons" width="75">Qty</th>
<th field="unit" width="70">Units</th>
<th field="tgljam2" width="130">Req Date</th>
<th field="poreqdel2" width="115">Delivery ETD</th>
</tr>
</thead>
</table>
<br>
<hr id="grs2c" style="width:100%;border:1px solid #D6D6D6;">
<br> -->
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

<div id="ntf1b" style="display: none;padding: 5px;width: 1125px;height: 40px;background: #0B89D2;box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12); border-radius: 8px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: #FFFFFF;">
<div style="margin-left:-1050px;margin-top:3px;"><img src="css/images/warning.png" width="25" height="21"></div>
<div style="margin-left:-650px;margin-top:-15px;">&nbsp;&nbsp;&nbsp;&nbsp;Some PO information has been updated by Purchasing</div>
<div style="margin-left:1075px;margin-top:-20px;font-size: 18px;line-height: 22px;color: #FFFFFF;cursor: pointer;" onclick="clsnotif(); $('#dg2c').datagrid('reload');">&#10005;</div>
</div>
<br>
<div id="ntfdelmat" style="padding: 5px;width: 1125px;height: 40px;background: #FF6B00;;box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12); border-radius: 8px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: #FFFFFF;">
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
<th field="pocons" width="75">Qty</th>
<th field="unit" width="70">Units</th>
<th field="tgljam2" width="135">Req Date</th>
<th field="etd" width="115">Delivery ETD</th>
</tr>
</thead>
</table>
<br>
</div>
</div>

<div class="header" id="myHeader" onclick=""  style="display:none;">
<div id="count"></div>
<div class="detail" id="mview" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="viewpono();" oncontextmenu="viewpono2();" title="if right click automatically new tab" class="easyui-tooltip" style="color: #FFFFFF; text-decoration: none;"> View PO </a></div>
<div class="detail" id="massign" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="reassign();" style="color: #FFFFFF; text-decoration: none;"> Reassign material </a></div>
<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="purchasing();" style="color: #FFFFFF; text-decoration: none;"> Assign purchasing </a></div>
<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="canpo1();" style="color: #FFFFFF; text-decoration: none;"> Cancel PO </a></div>
<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="menu2();" style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
</div>

<div id="dialog-form1b" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true,border:false"
style="width:300px;height:190px;border-radius:8px;padding:5px 5px;display:none;top:200px;border-radius:8px;">
<form id="form1b" method="post">
 <!--<input type="hidden" id="popk" name="popk">-->
  <div class="modal-content">
  <!-- Modal Header -->
  <div class="modal-header">
  <div class="modal-title">Canceling PO
	</div>
  </div>
  <div style="margin-left:20px;width:275px;height:54px;margin-top:50px; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
   Cancelling this PO will un-assign the PO numbers currently set to materials. Would you like to proceed?
  </div>
  <a style="text-decoration:none; width: 88px; height: 34px; left: 125px; top: 145px;" href="javascript:void(0)" class="button-cancel" onclick="canpo1b();">Cancel</a>
  <a style="text-decoration:none; width: 88px; height: 34px; left: 200px; top: 145px;" href="javascript:void(0)" class="button-submit" onclick="savecanpo();">Yes</a>
	<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
  </div>
</form>
</div>

<div id="dialog-form1b2" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true,border:false"
style="width:300px;height:190px;border-radius:8px;padding:5px 5px;display:none;top:200px;border-radius:8px;">
<form id="form1b2" method="post">
 <input type="hidden" id="popk" name="popk">
  <div class="modal-content">
  <!-- Modal Header -->
  <div class="modal-header">
  <div class="modal-title">Canceling PO
	</div>
  </div>
  <div style="margin-left:20px;width:275px;height:54px;margin-top:50px; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
   Cancelling this PO will un-assign the PO numbers currently set to materials. Would you like to proceed?
  </div>
  <a style="text-decoration:none; width: 88px; height: 34px; left: 125px; top: 145px;" href="javascript:void(0)" class="button-cancel" onclick="$('#dialog-form1b2').dialog('close');
			$('#form1b2').form('reset');">Cancel</a>
  <a style="text-decoration:none; width: 88px; height: 34px; left: 200px; top: 145px;" href="javascript:void(0)" class="button-submit" onclick="savecanpo2();">Yes</a>
	<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
  </div>
</form>
</div>

<div id="dialog-form1c" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true,border:false"
style="width:300px;height:190px;border-radius:8px;padding:5px 5px;display:none;top:200px;border-radius:8px;">
<form id="form1c" method="post">
 <input type="hidden" id="popk" name="popk">
  <div class="modal-content">
  <!-- Modal Header -->
  <div class="modal-header">
  <div class="modal-title">Canceling PO
	</div>
  </div>
  <div style="margin-left:20px;width:275px;height:54px;margin-top:50px; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
   PO cannot be canceled <br> because it has been purchased
  </div>
  <!--<a style="text-decoration:none; width: 88px; height: 34px; left: 125px; top: 145px;" href="javascript:void(0)" class="button-cancel" onclick="$('#dialog-form1b').dialog('close');$('#form1b').form('reset');">Cancel</a>-->
  <a style="text-decoration:none; width: 88px; height: 34px; left: 200px; top: 145px;" href="javascript:void(0)" class="button-submit" onclick="$('#dialog-form1c').dialog('close');$('#form1c').form('reset');">OK</a>
	<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
  </div>
</form>
</div>

<div id="dialog-form2c" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true,border:false"
style="width:300px;height:190px;border-radius:8px;padding:5px 5px;display:none;top:200px;border-radius:8px;">
<form id="form2c" method="post">
 <input type="hidden" id="popk" name="popk">
  <div class="modal-content">
  <!-- Modal Header -->
  <div class="modal-header">
  <div class="modal-title">Reassign material
	</div>
  </div>
  <div style="margin-left:20px;width:275px;height:54px;margin-top:50px; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
   PO cannot be reassign material <br> because it has been purchased
  </div>
  <!--<a style="text-decoration:none; width: 88px; height: 34px; left: 125px; top: 145px;" href="javascript:void(0)" class="button-cancel" onclick="$('#dialog-form1b').dialog('close');$('#form1b').form('reset');">Cancel</a>-->
  <a style="text-decoration:none; width: 88px; height: 34px; left: 200px; top: 145px;" href="javascript:void(0)" class="button-submit" onclick="$('#dialog-form2c').dialog('close');$('#form2c').form('reset');">OK</a>
	<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
  </div>
</form>
</div>

<div id="dialog-form3c" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true,border:false"
style="width:300px;height:190px;border-radius:8px;padding:5px 5px;display:none;top:200px;border-radius:8px;">
<form id="form3c" method="post">
 <input type="hidden" id="popk" name="popk">
  <div class="modal-content">
  <!-- Modal Header -->
  <div class="modal-header">
  <div class="modal-title">Assign purchasing
	</div>
  </div>
  <div style="margin-left:20px;width:275px;height:54px;margin-top:50px; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
   PO cannot be assign purchasing <br> because it has been purchased
  </div>
  <!--<a style="text-decoration:none; width: 88px; height: 34px; left: 125px; top: 145px;" href="javascript:void(0)" class="button-cancel" onclick="$('#dialog-form1b').dialog('close');$('#form1b').form('reset');">Cancel</a>-->
  <a style="text-decoration:none; width: 88px; height: 34px; left: 200px; top: 145px;" href="javascript:void(0)" class="button-submit" onclick="$('#dialog-form3c').dialog('close');$('#form3c').form('reset');">OK</a>
	<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
  </div>
</form>
</div>

<div id="dialog-form2b" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true,border:false"
style="width:300px;height:190px;border-radius:8px;padding:5px 5px;display:none;top:200px;border-radius:8px;">
<form id="form2b" method="post">
 <input type="hidden" name="popk">
  <div class="modal-content">
  <!-- Modal Header -->
  <div class="modal-header">
  <div class="modal-title">Assign purchasing
	</div>
  </div>
  <div style="margin-left:20px;width:275px;height:54px;margin-top:50px; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
   Assign this PO to purchasing. Would you like to proceed?
  </div>
  <a style="text-decoration:none; width: 88px; height: 34px; left: 125px; top: 145px;" href="javascript:void(0)" class="button-cancel" onclick="canassign();">Cancel</a>
  <a style="text-decoration:none; width: 88px; height: 34px; left: 200px; top: 145px;" href="javascript:void(0)" class="button-submit" onclick="saveassign();">Yes</a>
	<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
  </div>
</form>
</div>

<div id="dialog-form2" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true,border:false"
style="width:1150px;height:387px;padding:5px 5px;border-radius:8px;display:none;top:200px;border-radius:8px;">
<form id="form2" method="post">
<!--<input type="hidden" name="crpopk" id="crpopk">-->
<!--<input type="hidden" name="tt" id="tt">-->
<input type="hidden" name="popk" id="carpo">
  <div class="modal-content">
  <!-- Modal Header -->
  <div class="modal-header">
  <div class="modal-title" style="margin-top:-10px;">Choose Material
	</div>
  </div>
<a href="javascript:void(0)" onclick="cancel();" style="text-decoration:none; color:#000; font-size:24px; margin-left:95%;">X</a>
<div id="tabel2da" style="margin-left:25px;margin-top:35px;width:98.2%;">
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
<th field="pocons" width="75">Qty</th>
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

<div id="dialog-form3" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true,border:false"
style="width:892px;height:560px;padding:5px 5px;border-radius:8px;display:none;top:100px;border-radius:8px;">
<form id="form3" method="post">
<input type="hidden" name="popk" id="popk3" size="5">
<input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>" size="5">
<!--<input type="hidden" name="thn" value="<?php //echo $_GET['thn']; ?>">-->
<!--<input type="hidden" name="podtpk3" id="podtpk3">-->
<input type="hidden" name="suppk" id="suppk3b" size="5">
<div class="modal-content">
  <!-- Modal Header -->
<div class="modal-header">
<div class="modal-title" style="width: 785px;">Choose which PO to input the following item in
</div>
<a href="javascript:void(0)" onclick="cancel2();" style="text-decoration:none; color:#000; font-size:24px; margin-left:93%;">X</a>
<div style="margin-top: 40px;margin-left: 23px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
item</div>
</div>
<span id="spec3b" style="margin-left: 23px;font-style: normal;font-weight: 400;font-size: 16px;line-height: 20px;color:#000000;"></span>
 <div class="content-search4" style="margin-top:50px;margin-left:23px;">
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
<th field="spec" width="420">Item description</th>
</tr>
</thead>
</table>
</div>
<a style="color:#359DD9; text-decoration:none; width:auto; height: 47px; left:25px; top: 500px;" href="javascript:void(0)" class="button-cancel" onclick="stock();">Assign to stock</a>

  <a style="text-decoration:none; width: 88px; height: 47px; left: 625px; top: 500px;" href="javascript:void(0)" class="button-cancel" onclick="cancel2();">Cancel</a>
  <a style="text-decoration:none; width: 157px; height: 47px; left: 700px; top: 500px;" href="javascript:void(0)" class="button-submit" onclick="saveinsert();">Insert into different PO</a>
	<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
  </div>
</form>
</div>

<!-- DIALOG FORM WH -->
<div id="dialog-formwh" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
style="width:390px;height:315px;padding:5px 5px;display:none;top:100px;border-radius:8px;">
<form id="formwh" method="post">
<input type="hidden" name="popk" id="popk3b">
<input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">
<!--<input type="hidden" name="thn" value="<?php //echo $_GET['thn']; ?>">-->
<!--<div class="modal-dialog" style="width:365px; height:290px;">-->
<div class="modal-content">
<div style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">
Select warehouse to issue PO
<div><br>
<input style="width:200px; height:28px;"  name="suppk" class="easyui-combobox"
data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=suppwh',prompt:'Warehouse',panelHeight:'auto'">
</div>
<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
<a style="text-decoration:none; left:171px; top: 230px;" href="javascript:void(0)" class="button-cancel" onclick="cancelwh();">Cancel</a>
<a style="text-decoration:none; left:250px; top: 230px; width:100px;" href="javascript:void(0)" class="button-submit" onclick="savewh();">Create PO</a>
</div>
</div>
<!--</div>-->
</form>
</div>

<script type="text/javascript">
window.onscroll = function(){
myFunctiona();
myFunctionb();
myFunction2b();
myFunction1c();
myFunction2c();
myFunction3c();
myFunctionb2();
myFunctionc();
myFunctiond();
myFunctione();
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

var headerb = document.getElementById("dialog-form1b");
var stickyb = headerb.offsetTop;
function myFunctionb(){
if(window.pageYOffset > stickyb){
headerb.classList.add("sticky");
} else {
headerb.classList.remove("sticky");
}
}

var header2b = document.getElementById("dialog-form1b2");
var sticky2b = header2b.offsetTop;
function myFunction2b(){
if(window.pageYOffset > sticky2b){
header2b.classList.add("sticky");
} else {
header2b.classList.remove("sticky");
}
}

var header1c = document.getElementById("dialog-form1c");
var sticky1c = header1c.offsetTop;
function myFunction1c(){
if(window.pageYOffset > sticky1c){
header1c.classList.add("sticky");
} else {
header1c.classList.remove("sticky");
}
}

var header2c = document.getElementById("dialog-form2c");
var sticky2c = header2c.offsetTop;
function myFunction2c(){
if(window.pageYOffset > sticky2c){
header2c.classList.add("sticky");
} else {
header2c.classList.remove("sticky");
}
}

var header3c = document.getElementById("dialog-form3c");
var sticky3c = header3c.offsetTop;
function myFunction3c(){
if(window.pageYOffset > sticky3c){
header3c.classList.add("sticky");
} else {
header3c.classList.remove("sticky");
}
}

var headerb2 = document.getElementById("dialog-form2b");
var stickyb2 = headerb2.offsetTop;
function myFunctionb2(){
if(window.pageYOffset > stickyb2){
headerb2.classList.add("sticky");
} else {
headerb2.classList.remove("sticky");
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

var headere = document.getElementById("dialog-formwh");
var stickye = headere.offsetTop;
function myFunctione(){
if(window.pageYOffset > stickye){
headere.classList.add("sticky");
} else {
headere.classList.remove("sticky");
}
}
</script>
</body>
</html>