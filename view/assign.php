<?php
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
</style>

<script type="text/javascript">
var url;

$(function(){
var dg= $('#dg');
dg.datagrid();
dg.datagrid('getPanel').find('div.datagrid-header').css('display','none');
//$('#dg').datagrid('getPanel').addClass('lines-no');
//$('#dg').datagrid('getPanel').addClass('lines-no2');
//$('#dg').datagrid('getPanel').addClass('col');

//var dg3= $('#dg3');
//dg3.datagrid();
////dg.datagrid('getPanel').find('div.datagrid-header').css('display','none');
//$('#dg3').datagrid('getPanel').addClass('lines-no');
//$('#dg3').datagrid('getPanel').addClass('lines-no2');
//$('#dg3').datagrid('getPanel').addClass('col');
});

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

$(function(){
$('#dg').datagrid({
view: detailview,
detailFormatter:function(index,row){
return '<div style="padding:2px;position:relative;"><table class="ddv" id="dg-'+index+'" style="width:100%;height:auto;"></table></div>';
},
onExpandRow: function(index,row){
//var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
/*function count_row(){
	$('#myHeader').show();
    var count = $('#dg-'+index).datagrid('getChecked').length;
    if (count) {
        document.getElementById("count").innerHTML = count +" items selected";
    } else {
		document.getElementById("count").innerHTML = 0 +" items selected";
		}
	}*/

/*function menu(){
	var row = $('#dg-'+index).datagrid('getSelected');
	if(row){
		$('#myHeader').show();
  count_row();
	} else {
	$('#myHeader').hide();
	ddv.datagrid('clearSelections');
	}
}*/

/*function menu2(){
$('#myHeader').hide();
$('#dg-'+index).datagrid('clearSelections');
}*/

$('#dg-'+index).datagrid({
url:'view/get_detassign.php?user=<?php echo $_SESSION['user']; ?>&sup='+row.suppk,
fitColumns:false,
multiple:true,
rownumbers:false,
collapsible:true,
autoRowHeight:true,
border:true,
ctrlSelect:true,
checkOnSelect:true,
loadMsg:'',
height:'auto',
idField:'podtpk',
//onCheck:function(){ menu(index); },
//onUncheck:function(){ menu(index); },
onCheckAll:function(){
getSelected(index);
menu(index);
},
onUncheckAll:function(){ menu2(index); },
columns:[[
{field:'ck',title:'',checkbox:true},
{field:'pono',title:'PO',width:100},
{field:'ordno',title:'Order no',width:100},
{field:'item',title:'Item',width:125},
{field:'spec',title:'Specification',width:190},
{field:'supnm',title:'Supplier',width:175},
{field:'sizegar',title:'Size',width:100},
{field:'colname',title:'Color',width:100},
{field:'qty',title:'Qty',width:100},
{field:'pocons',title:'Total PO',width:100},
{field:'unit',title:'Unit',width:100}
]],

onResize:function(){
$('#dg').datagrid('fixDetailRowHeight',index);
},

onLoadSuccess:function(){
setTimeout(function(){
$('#dg').datagrid('fixDetailRowHeight',index);
},0);
},

onCheck: function() {
getSelected(index);
menu(index);
},

onSelect: function() {
getSelected(index);
},

onUncheck:function(){ menu(index); }
});
$('#dg').datagrid('fixDetailRowHeight',index);
//$('#dg').datagrid('getPanel').css('height','auto');
},

onLoadSuccess: function(){
var dg = $('#dg');
var count = dg.datagrid('getRows').length;
for(var i=0; i<count; i++){
dg.datagrid('expandRow',i);
}
},

onSelect: function(){
menub();
}
/*onClickRow: function(rowIndex){
var detailContainer = $(this).datagrid('getRowDetail', rowIndex);
if (detailContainer.find('div.datagrid').length){  // the detail datagrid has been created
var ddv = $('#dg-'+rowIndex);  // the detail datagrid object
var rows = ddv.datagrid('getRows');  // get the detail datagrid rows
alert(rows);
}
}*/
    
});
});

function getSelected(index){
//var row = $('#dg').datagrid('getRows');
//var drow = $('#dg-'+index).datagrid('getChecked');      
//setValue(drow);
//$('#index').val(index);
//$('#podtpk').val(drow.podtpk);
//var ids = [];
//var drow = $('#dg-'+index).datagrid('getSelections');
//alert(index);
var cek =  $('#index').val();
document.getElementById("index").value = index;
//alert(cek);
if(cek!=index){
//$('#dg-'+cek).datagrid('clearSelections');
$('#dg-'+cek).datagrid('clearChecked');
//$('#dg-'+cek).datagrid('reload');
}

//alert(drow.podtpk);

//for(var i=0; i<drow.length; i++){
//ids.push(drow[i].podtpk);
//}
//alert(ids);
/*$.each(ids, function (index, value){
alert(value);
alert(index);
document.getElementById("podtpk").value = value;   
},'json')*/
//alert(drow.podtpk);
//alert(index);
}
/*function getDelete() {
$.messager.alert('Info', 'Deletion failed!', 'info');
}
function setValue(drow) {
$('#cstand_pcode').val(drow.product_code);
$('#cstand_commitee').append('<option selected>' + drow.commitee + '</option>');
$('#cstand_name').val(drow.stand_no);
window.top.document.getElementById("footer").src = "<?php //echo ROOT_WEB ?>public/files/standUpload/"+drow.stand_link;
}*/

function menu(index){
	var row = $('#dg-'+index).datagrid('getSelected');
	if(row){
	$('#myHeader').show();
    count_row(index);
	} else {
	$('#myHeader').hide();
	$('#dg-'+index).datagrid('clearSelections');
	}
}

function menu2(index){
$('#myHeader').hide();
$('#dg-'+index).datagrid('clearSelections');
//$('#dg').datagrid('clearSelections');
}

function menub(){
var row = $('#dg').datagrid('getSelected');
var index = $('#dg').edatagrid('getRowIndex', row);
var tr = $(this).datalist('options').finder.getTr(this, index);
tr.find('input[type=radio]')._propAttr('checked', true);
}

function menu2b(){
$('#myHeader').hide();
var cek =  $('#index').val();
$('#dg-'+cek).datagrid('clearSelections');  
//$('#dg').datagrid('clearSelections');
}

/*count*/
function count_row(index){
	$('#myHeader').show();
    var count = $('#dg-'+index).datagrid('getChecked').length;
    if (count) {
    document.getElementById("count").innerHTML = count +" items selected";
    } else {
	document.getElementById("count").innerHTML = 0 +" items selected";
	}
}

function canproses(){
var ids = [];
var cek =  $('#index').val();
var drow = $('#dg-'+cek).datagrid('getSelected');  
for(var i=0; i<drow.length; i++){
ids.push(drow[i].podtpk);
}
$.messager.confirm('Confirm','Are you sure you want to reassign this material?',
function(r){
if (r){
//alert(ids);
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
$('#ddv-'+cek).datagrid('reload');
$('#ddv-'+cek).datagrid('clearSelections');
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

function createwh(){
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
$('#dialog-form').dialog('open').dialog('setTitle','');
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

function savewh(){
    
}

function cancelwh(){
$('#dialog-formwh').dialog('close').dialog('setTitle','');
$('#formwh').form('reset');
}

function formwh(){
$('#dialog-formwh').dialog('open').dialog('setTitle','');    
}

function preview(){
$('#dialog-formpo').dialog('open').dialog('setTitle','');    
}

function cancelpo(){
$('#dialog-formpo').dialog('close').dialog('setTitle','');
$('#formpo').form('reset');
}

function savepreview(){
window.location.href="action/simpan?x=savepo&user=<?php echo $_SESSION['user']; ?>&thn=<?php $_GET['thn']; ?>";   
}

function search(){
    
}
</script>
</head>
<body>
<div class="contenta">
<div id="frame-utama-judul" style="">
<input type="hidden" name="index" id="index">
<input type="hidden" name="podtpk" id="podtpk">
<div class="frame-arrow">
<a href="action/simpan?x=canproses&user=<?php echo $_SESSION['user']; ?>&thn=<?php echo $_GET['thn']; ?>"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>  
</div>
<div class="font-judul-atas" style="width:auto; font-size: 24px; line-height: 28px; font-weight:700;">  
Grouping your purchases
</div>
<div class="font-judul-bawah" style="left:-40%;top:40px;width:auto;text-align:left;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
See the simulated PO numbers and adjust the breakdown as you like.<br>Initial PO separation is based on suppliers
<input style="margin-left:225%;padding:5px;margin-top:-25px;" type="button" name="submit" value="Continue to preview" class="button-submit" onclick="preview();">
</div>
</div>
<div id="tabel1" onclick="" style="top:210px;">
<div align="left">
<input type='checkbox' name='cari' id='cari1' onclick='search();' value='1' checked> Separate by item
<input type='checkbox' name='cari' id='cari2' onclick='search();' value='2'> Separate by color
</div><br>
<table id="dg" class="easyui-datagrid" style="width:100%;height:1000px;" align="center"
url="view/get_assign.php?user=<?php echo $_SESSION['user']; ?>&thn=<?php echo $_GET['thn']; ?>" idField="suppk"
data-options="
pagination:false,
singleSelect:true,
collapsible:true,
rownumbers:false,
fitColumns:true,
border:true,
height:'auto',
autoRowHeight:true">
<thead>
<tr>
<th field="supnm2" width="140"></th>
</tr>
</thead>
</table>
</div>
</div>

<div class="header" id="myHeader" onclick=""  style="display:none;">
<div id="count" style="margin-right:65%;"></div>
<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="formwh();" style="color: #FFFFFF; text-decoration: none;"> Create warehouse PO </a></div>
<!--<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="canproses();" style="color: #FFFFFF; text-decoration: none;"> Reassign material </a></div>-->
<div class="detail" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="menu2b();" style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
</div>

<!-- DIALOG FORM WH -->
<div id="dialog-formwh" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
style="width:390px;height:315px;padding:5px 5px;display:none;top:100px;">
<form id="formwh" method="post">
<input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">
<!--<div class="modal-dialog" style="width:365px; height:290px;">-->
<div class="modal-content">
<div style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">
Select warehouse to issue PO
<div><br>
<input style="width:200px; height:28px;"  id="cari3b" class="easyui-combobox"
data-options="valueField:'supnm',textField:'supnm',url:'view/get_data.php?dt=suppwh',prompt:'Warehouse',limitToList:'true'">
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
<div style="margin-top:25px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">
PO submission review
<div><br>
    <div id="tabel2b" onclick="" style="width:95%; margin-left:25px; margin-top:70px">
    <table id="dg3" class="easyui-datagrid" title="" style="width:100%;height:425px;" align="center"
    url="view/get_assign2.php?user=<?php echo $_SESSION['user']; ?>&thn=<?php echo $_GET['thn']; ?>" idField="podtpk" toolbar="#tb" striped="false"
    pageSize="100" pageList="[100,200,300,500]" pagination="false" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" method="post"
	data-options="border:true">
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