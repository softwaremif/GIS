<?php
//$sql=mysqli_query($koneksi,"select po.suppk from po
//left outer join sup on sup.suppk=po.suppk
//where po.suppk>0 and po.polipk>0 group by po.suppk order by po.suppk desc");
//while($dt=mysqli_fetch_array($sql)){
//$sql2=mysqli_query($koneksi,"select suppk,polipk from po where suppk='$dt[suppk]' order by popk desc limit 1");
//$dt2=mysqli_fetch_array($sql2);
//
//$update=mysqli_query($koneksi,"update sup set local='$dt2[polipk]' where local='0' and suppk='$dt2[suppk]'");
//}
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
.datagrid-header .datagrid-cell span{
    color: rgba(0, 0, 0, 0.38);
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
.datagrid-body td{
vertical-align: text-top;
}
</style>

<script type="text/javascript">
var url;

$(function(){
//$('#dg').datagrid({
//onLoadSuccess: function(){
////$(this).datagrid('getPanel').find('.datagrid-header').css('height', '30px');
//}
//});
var dg= $('#dg');
dg.datagrid('getPanel').find('div.datagrid-header').css('display','none');
//dg.datagrid('getPanel').find('div.datagrid-header td[field="pono"]').css('display','none');
//dg.datagrid('getPanel').find('div.datagrid-header td').css('height','20px');
//dg.datagrid('getPanel').find('.datagrid-row').css('height', '50px');

$('#dg').datagrid('getPanel').addClass('lines-no');
//$('#dg').datagrid('getPanel').addClass('lines-no2');
//$('#dg').datagrid('getPanel').addClass('col');
});

function formatku(value,rows){
     return value+
    '<br><div style="width:101.2%;"><table style="margin-left:-15px;" border="1" id="hor-minimalist-a">'+
    '<thead>'+
    '<tr style="height:30px;background-color:#F1F1F1;">'+
    '<th width="135">PO</th>'+
    '<th width="105">Order no</th>'+
    '<th width="127">Item</th>'+
    '<th width="197">Specification</th>'+
    '<th width="172">Supplier</th>'+
    '<th width="105">Size</th>'+
    '<th width="105">Color</th>'+
    '<th width="105">Qty</th>'+
    '<th width="105">Total PO</th>'+
    '<th width="105">Units</th>'+
    '</tr>'+
    '</thead>'+
    '</table></div>';
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
$('#dg').datagrid('clearChecked');
$('#dg').datagrid('reload');
}

/*count*/
function count_row(){
	$('#myHeader').show();
    var count = $('#dg').datagrid('getChecked').length;
    if (count) {
        document.getElementById("count").innerHTML = count +" items selected";
    } else {
		document.getElementById("count").innerHTML = 0 +" items selected";
		}
	}
    
function canproses(){
var ids = [];
var rows = $('#dg').datagrid('getSelections');
for(var i=0; i<rows.length; i++){
ids.push(rows[i].podtpk);
}
$.messager.confirm('Confirm','Are you sure you want to reassign this material?',
function(r){
if (r){
// We loop through each project and then delete it
$.each(ids, function (index, value){
$.post('action/simpan.php?x=canproses2',{id:value},function(result){
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
$('#dg').datagrid('reload');
$('#dg').datagrid('clearSelections');
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
}
});
}

function formwh(){
var ids = [];
var rows = $('#dg').datagrid('getSelections');
for(var i=0; i<rows.length; i++){
ids.push(rows[i].podtpk);
}
//$.messager.confirm('Confirm','Are you sure you want to reassign this material?',
//function(r){
//if (r){
// We loop through each project and then delete it
$.each(ids, function (index, value){
$.post('action/simpan.php?x=formwh',{id:value},
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
$('#dg').datagrid('reload');
$('#dialog-formwh').dialog('open').dialog('setTitle','');
} else {
 alert("test");
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

function savewh(){
		var string = $("#formwh").serialize();
	 $('#formwh').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=formwh2",
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
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg').datagrid('reload');
		}
	 });
}

function cancelwh(){
var string = $("#formwh").serialize();
	 $('#formwh').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=canwh",
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
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg').datagrid('reload');
		}
	 });
}

/*function formwh2(){
$('#dialog-formwh').dialog('open').dialog('setTitle','');    
}*/

function preview(){
var cari1= $('#cari1b').val();
var cari2= $('#cari2b').val();
if(cari1==1 || cari2==1){
//alert(cari2);
/*$.ajax({
type:"POST",
url:"view/assign2b?thn=<?php //echo $_GET['thn']; ?>&cari1="+cari1+"&cari2="+cari2,
data:"user=<?php //echo $_SESSION['user']; ?>",
success:function(data){
//document.getElementById('tpur1').innerHTML =data;
//$('#dialog-formpo').dialog('open').dialog('setTitle','');
//$('#dg').datagrid('reload');
$.ajax({
type:"POST",
url:"view/assign2c?thn=<?php //echo $_GET['thn']; ?>&cari1="+cari1+"&cari2="+cari2,
data:"user=<?php //echo $_SESSION['user']; ?>",
success:function(data){
//document.getElementById('tpur1').innerHTML =data;
},
}); 
},
});
$('#dialog-formpo').dialog('open').dialog('setTitle','');
$('#dg').datagrid('reload');
*/
window.location.href="view/assign2b?user=<?php echo $_SESSION['user']; ?>&thn=<?php echo $_GET['thn']; ?>&cari1="+cari1+"&cari2="+cari2; 
} else {
$('#dialog-formpo').dialog('open').dialog('setTitle','');  
}
}

function cancelpo(){
$('#dialog-formpo').dialog('close').dialog('setTitle','');
$('#formpo').form('reset');
}

function savepreview(){
window.location.href="action/simpan?x=savepo&user=<?php echo $_SESSION['user']; ?>&thn=<?php echo $_GET['thn']; ?>";   
}

function search(){
//var cari1 = $('#cari1b').val();
//if(cari1==1){ document.getElementById('cari1b').value = 0; }
//else { document.getElementById('cari1b').value = 1; }
var cari1 = document.getElementById("cari1");
if (cari1.checked == true){
document.getElementById('cari1b').value = 1;
} else {
document.getElementById('cari1b').value = 0;
}

var cari2 = document.getElementById("cari2");
if (cari2.checked == true){
document.getElementById('cari2b').value = 1;
} else {
document.getElementById('cari2b').value = 0;
}
//var cari1b = $('#cari1b').val();
//var cari2b = $('#cari2b').val();
//alert(cari2b);
$('#dg').datagrid('load',{
cari1: $('#cari1b').val(),
cari2: $('#cari2b').val()
});   
}

/*var gview = $.extend({}, groupview, {
	onBeforeRender: function(target, rows){
		groupview.onBeforeRender.call(this, target, rows);

		var state = $.data(target, 'dg');
		var opts = state.options;
		if (opts.sortName != opts.groupField){
			return;
		}
		var groups = this.groups;
		groups.sort(function(a,b){
			var v1 = sumValue(a.rows, 'qty');
			var v2 = sumValue(b.rows, 'pocons');
			return (opts.sortOrder=='asc'?1:-1)*(v1>v2?1:-1);
		});
		var index = 0;
		var newRows = [];
		for(var i=0; i<groups.length; i++){
			var group = groups[i];
			group.startIndex = index;
			index += group.rows.length;
			newRows = newRows.concat(group.rows);
		}
		state.data.rows = newRows;
		
		function sumValue(rows,field){
			var v = 0;
			$.map(rows, function(row){
				v += row[field];
			});
			return v;
		}
	}
});*/

/*function checkClickFunc()
{
 var checkbox = document.getElementById('cek');
 if (checkbox.checked == true)
 {
  menu();
 }
}*/

/*function checkGroup(value,event){
  value = $.trim(value);
  var dg = $('#dg');
  var groups = dg.datagrid('groups');
  var group = null;
  for(var i=0; i<groups.length; i++){
    if (groups[i].value == value){
      group = groups[i];
      break;
    }
  }
  var checked = $(event.target).is(':checked');
  for(var i=group.startIndex; i<group.startIndex+group.rows.length; i++){
    dg.datagrid(checked?'checkRow':'uncheckRow',i)
  }
}*/
function cekgroup(){
	//cari = $('#cari2').val();
    var ids = [];
    var rows = $('#dg').datagrid('getSelections');
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        var aaa = row.suppk;
    }
    for(var i=0; i<rows.length; i++){
    ids.push(rows[i].suppk);
       if (ids[i]!= aaa) {
         //$.messager.alert('Warning','Handle must be same','warning');
         $('#dg').datagrid('clearChecked');
       } else {

       }
    }
}

function wrap(){
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
</script>
</head>
<body>
<div class="contenta">
<div id="frame-utama-judul" style="">
<div class="frame-arrow">
<a href="action/simpan?x=canproses&user=<?php echo $_SESSION['user']; ?>&thn=<?php echo $_GET['thn']; ?>"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>  
</div>
<div class="font-judul-atas" style="width:auto; font-size: 24px; line-height: 28px; font-weight:700;">  
Grouping your purchases
</div>
<div class="font-judul-bawah" style="left:-40%;top:40px;width:auto;text-align:left;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
See the simulated PO numbers and adjust the breakdown as you like.<br>Initial PO separation is based on suppliers
<input style="margin-left:225%;padding:5px; margin-top:-25px;" type="button" name="submit" value="Continue to preview" class="button-submit" onclick="preview();">
</div>
</div>

<!--groupFormatter:function(value, rows){-->
<!--  var s = 'Group ('+ value +')'+ ' - ' + rows.length + ' Items';-->
<!--  s = ' <input type=checkbox onclick=checkGroup(\+value+\,event)> ' + s;-->
<!--  return s;-->
<!--}-->

<div id="tabel1" onclick="menu(); cekgroup();" onmousemove="cekgroup();" style="top:210px;">
<div align="left">
<input type="checkbox" name="cari" id="cari1" onclick="search();"> Separate by item
<input type="checkbox" name="cari" id="cari2" onclick="search();"> Separate by color
<input type="hidden" id="cari1b" size="5">
<input type="hidden" id="cari2b" size="5">
</div><br>
<table id="dg" class="easyui-datagrid" style="width:100%;height:auto;" align="center"
url="view/get_assign2.php?user=<?php echo $_SESSION['user']; ?>&thn=<?php echo $_GET['thn']; ?>" multiple="true" idField="podtpk"
data-options="
AutoRowHeight: false,
onCheckAll:function(){menu();},
onUncheckAll:function(){menu2();},
ctrlSelect:true,
checkOnSelect:true,
multiSort:true,
pagination:false,
collapsible:true,
rownumbers:false,
fitColumns:false,
view:groupview,
border:true,
groupField:'supnm2',
groupFormatter:formatku,
groupStyler:function(value,rows){
return 'padding:10px;height:68px;';
},
onLoadSuccess:wrap">
<thead>
<tr>
<th data-options="field:'ck',checkbox:true"></th>
<th field="pono" width="100" style="vertical-align: text-top;">PO</th>
<th field="ordno" width="100">Order no</th>
<th field="item" width="120">Item</th>
<th field="spec" width="190">Specification</th>
<th field="supnm" width="164">Supplier</th>
<th field="sizegar" width="100">Size</th>
<th field="colname" width="100">Color</th>
<th field="pocons" width="100">Qty</th>
<th field="pocons" width="100">Total PO</th>
<th field="unit" width="100">Units</th>
</tr>
</thead>
</table>
<br>
</div>
</div>

<div class="header" id="myHeader" onclick=""  style="display:none;">
<div id="count" style="margin-right:65%;"></div>
<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="formwh();" style="color: #FFFFFF; text-decoration: none;"> Create warehouse PO </a></div>
<!--<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="canproses();" style="color: #FFFFFF; text-decoration: none;"> Reassign material </a></div>-->
<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="menu2();" style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
</div>

<!-- DIALOG FORM WH -->
<div id="dialog-formwh" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
style="width:390px;height:315px;padding:5px 5px;display:none;top:100px;">
<form id="formwh" method="post">
<input type="text" name="user" value="<?php echo $_SESSION['user']; ?>">
<input type="text" name="thn" value="<?php echo $_GET['thn']; ?>">
<!--<div class="modal-dialog" style="width:365px; height:290px;">-->
<div class="modal-content">
<div style="margin-top:10px; margin-left:25px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">
Select warehouse to issue PO
<div><br>
<input style="width:200px; height:28px;"  name="suppk" class="easyui-combobox"
data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=suppwh',prompt:'Warehouse',limitToList:'true'">
</div>
<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
<a style="text-decoration:none; left:171px; top: 230px;" href="javascript:void(0)" class="button-cancel" onclick="cancelwh();">Cancel</a>
<a style="text-decoration:none; left:250px; top: 230px; width:100px;" href="javascript:void(0)" class="button-submit" onclick="savewh();">Create PO</a>
</div>
</div>
<!--</div>-->
</form>
</div>

<!-- DIALOG FORM po -->
<div id="dialog-formpo" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
style="width:990px;height:615px;padding:5px 5px;display:none;top:15px">
<form id="formpo" method="post">
<input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">
<!--<div class="modal-dialog" style="width:965px; height:590px;">-->
<div class="modal-content">
<br>
<a href="javascript:void(0)" style="text-decoration:none; color:#000;" onclick="cancelpo();">
<div style="margin-left:30px;"><img src="css/images/Vector2.png" width="20" height="20"></div>
<div style="font-size:16px; margin-left:55px; margin-top:-18px;">Back</div>
</a>
<div style="margin-top:25px; margin-left:25px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">
PO submission review
<div><br>
    <div id="tabel2b" onclick="" style="width:95%; margin-left:25px; margin-top:70px">
    <table id="dg3" class="easyui-datagrid" title="" style="width:100%;height:425px;" align="center"
    url="view/get_assign2.php?user=<?php echo $_SESSION['user']; ?>&thn=<?php echo $_GET['thn']; ?>" idField="podtpk" toolbar="#tb" striped="false"
    pageSize="100" pageList="[100,200,300,500]" pagination="false" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" method="post"
	data-options="border:true,onLoadSuccess:wrap">
    <thead>
    <tr>
<th field="pono" width="75">PO</th>
<th field="ordno" width="75">Order no</th>
<th field="item" width="130">Item</th>
<th field="spec" width="148">Specification</th>
<th field="supnm" width=130">Supplier</th>
<th field="sizegar" width="80">Size</th>
<th field="colname" width="80">Color</th>
<th field="qty" width="80">Qty</th>
<th field="pocons" width="80">Total PO</th>
<th field="unit" width="60">Unit</th>
    </tr>
    </thead>
    </table>
<hr style="height:1px; width:100%; margin-top:20px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
<!--<div id="date1" class="easyui-calendar"  style="width:148px; height: 34px;"></div>-->
<a style="text-decoration:none; margin-left:75%; margin-top: 10px;" href="javascript:void(0)" class="button-cancel" onclick="cancelpo();">Cancel</a>
<a style="text-decoration:none; margin-left:85%; margin-top: 10px; width:150px;" href="javascript:void(0)" class="button-submit" onclick="savepreview();">Submit and Continue</a>
</div>
</div>
</div>
<!--</div>-->
</form>
</div>

<script type="text/javascript">
window.onscroll = function(){
myFunctiona1();
myFunctiona2();
myFunctiona3();
};
var headera1 = document.getElementById("myHeader");
var stickya1 = headera1.offsetTop;
function myFunctiona1(){
if(window.pageYOffset > stickya1){
headera1.classList.add("sticky");
} else {
headera1.classList.remove("sticky");
}
}

var headera2 = document.getElementById("dialog-formwh");
var stickya2 = headera2.offsetTop;
function myFunctiona2(){
if(window.pageYOffset > stickya2){
headera2.classList.add("sticky");
} else {
headera2.classList.remove("sticky");
}
}

var headera3 = document.getElementById("dialog-formpo");
var stickya3 = headera3.offsetTop;
function myFunctiona3(){
if(window.pageYOffset > stickya3){
headera3.classList.add("sticky");
} else {
headera3.classList.remove("sticky");
}
}
</script>
</body>
</html>